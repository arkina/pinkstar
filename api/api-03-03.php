<?php
	require_once("Rest.inc.php");
	
	class API extends REST {
	
		public $data = "";
		
		const DB_SERVER = "localhost";
		const DB_USER = "taranjee_pinksta";
		const DB_PASSWORD = "Pink@star123";
		const DB = "taranjee_pinkstar";
		
		private $db = NULL;
	
		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();					// Initiate Database connection
		}
		
		/*
		 *  Database connection 
		*/
		private function dbConnect(){
			$this->db = mysql_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD);
			if($this->db)
				mysql_select_db(self::DB,$this->db);
		}
		
		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function processApi(){
			$getAllHeaderArr=getallheaders();
			$body=file_get_contents('php://input');
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func($body);
			else
				$this->response('',404);				// If the method not exist with in this class, response would be "Page not found".
		}
		
		private function validateNum($body){
			// Cross validation if the request method is POST else it will return "Not Acceptable" status
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$bodyRequest=(array) json_decode($body);
			#print_r($bodyRequest);die;
			$mobileStd='+'.$bodyRequest['stdcode'];
			$mobile=$bodyRequest['mobile'];
			$resend = $bodyRequest['resend'];
			$valid=$this->phoneNumbervalidation($mobile);
				if($valid){
					$query ="select mobile FROM `ps_client` where mobile=$mobile";
					if($this->CheckDataExists_id($query)){
						$queryClient = "select token_id,std_code,mobile,register_by,otp,use_otp from ps_client where mobile=$mobile";
						$resultClient =$this->fetchData($queryClient);
						//echo "<pre>";print_r($resultClient);die;
						$res[udata]= 1;
						$res[result]= $resultClient;;
						$this->response($this->json($res), 200);
				}else{
					$checkOpt="select use_otp from `ps_client` where mobile =$mobile";
					$checkStatus =$this->fetchData($checkOpt);
						#echo "<pre>";print_r($checkStatus);die;
						if($checkStatus ==0){
						$data['otp']=$this->random_numbers(4);
						$data['token_id']=md5($mobile.$data['otp']);
						$data['register_by']='mobile';
						$data['mobile_verify']=0;
						$data['status']=0;
						$data['udata']=0;
						$data['use_otp']=$resend;
						$data['mobile']=$mobile;
						$data['std_code']=$mobileStd;
						$data['registered']=null;
						date_default_timezone_set('Asia/Kolkata');
						$data['register_on']=date('Y-m-d H:i:s');
						if($this->insertData($data,"ps_client")){
							//$retData = json_encode($data);
							unset($data['mobile']);unset($data['std_code']);unset($data['registered']);
							$data['mobile']=$mobileStd.$mobile;
							$res[udata]= 0;
							$res[result]= $data;
							$this->response($this->json($res), 200);
						}
					}else{
							$res[udata]= array('status' => "Failed", "msg" => "Data not inserted","valid"=>0);
							$this->response($this->json($res), 400);
						}
					}
				}else{
					$res[udata]=2;
					$res[result]= array('status' => "Failed", "msg" => "Invalid mobile number");
					$this->response($this->json($res), 400);
				}
			
		}
		
		//Verified OPT 
		
		private function optVerified($body){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$bodyRequest=(array) json_decode($body);
			if(!empty($bodyRequest['token_id'])){
				$token =$bodyRequest['token_id'];
				$mobile= $bodyRequest['mobile'];
				$query ="select token_id,mobile FROM `ps_client` where mobile=$mobile and token_id='$token'";
				if($this->CheckDataExists_id($query)){
					$data['mobile_verify']=0;$data['status']=0;
					date_default_timezone_set('Asia/Kolkata');
					$data['register_on']=date('Y-m-d H:i:s');
					$data['mobile']=$bodyRequest['mobile'];
					$data['token_id']=$bodyRequest['token_id'];
					if($this->updateData($data,$mobile,"ps_client")){
						$res[udata]=1;
						$res[result]= array('status' => "Success","data"=>$data);
						$this->response($this->json($res), 200);
					}else{
							$res[udata]=0;
							$res[udata]= array('status' => "Failed","data"=>$data);
							$this->response($this->json($res), 400);
					}
				}else{
					$res[udata]=0;
					$data['mobile']=$bodyRequest['mobile'];
					$data['token_id']=$bodyRequest['token_id'];
					$res[result]= array('status' => "Failed","data"=>$data);
					$this->response($this->json($res), 400);
				}
			}else{
					$res[udata]= 0;
					$res[result]= array('status' => "Unauthorized", "msg" => "Invalid Token id");
					$this->response($this->json($res), 400);
			}
		}
		
		// For Sign up
			private function registrationup($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
					$bodyRequest=(array) json_decode($body);
					#print_r($bodyRequest);die;
					$mobile =$bodyRequest['mobile'];
					$token = $bodyRequest['token_id'];
					$data['std_code']=$bodyRequest['stdcode'];
					$data['mobile']=$bodyRequest['mobile'];
					$data['token_id']=$bodyRequest['token_id'];
					$data['email']=$bodyRequest['email'];
					$data['first_name']=$bodyRequest['first_name'];
					$data['last_name']=$bodyRequest['last_name'];
					$data['password']=$bodyRequest['password'];
					$data['register_by']=$bodyRequest['register_by'];
					#$data['mobile_verify']=1;$data['status']=1;
				$valid=$this->phoneNumbervalidation($mobile);
				if($valid){
					$query ="select token_id,mobile FROM `ps_client` where mobile=$mobile";
					if($this->CheckDataExists_id($query)){
						$udata['first_name']=$bodyRequest['first_name'];
						$udata['last_name']=$bodyRequest['last_name'];
						$udata['email']=$bodyRequest['email'];
						$udata['password']=md5($bodyRequest['password']);
						$udata['mobile_verify']=1;$udata['status']=1;
						if($this->updateData($udata,$mobile,"ps_client")){
							$queryClient = "select first_name,last_name,token_id,email,std_code,mobile,register_by,otp,use_otp,mobile_verify,status from ps_client where mobile=$mobile";
							$resultClient =$this->fetchData($queryClient);
							$res[udata]= 1;
							$res[result]= $resultClient;
							$this->response($this->json($res), 200);
						}
					}else{
						#echo "<pre>";print_r($data);die;
						date_default_timezone_set('Asia/Kolkata');
						$data['register_on']=date('Y-m-d H:i:s');
						if($this->insertData($data,"ps_client")){
							//$retData = json_encode($data);
							unset($data['mobile']);unset($data['std_code']);
							$data['mobile']=$mobileStd.$mobile;
							$res[udata]= 0;
							$res[result]= $data;
							$this->response($this->json($res), 200);
						}
					}
				}
			
		}
			
		//
		
		// For Fb user registration
			private function registration_fb($body){
				if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$bodyRequest=(array) json_decode($body);
				#print_r($bodyRequest);die;
			$mobile = $bodyRequest['mobile'];
				if(!empty($mobile) || $mobile!=""){
					$query ="select mobile FROM `ps_client` where mobile=$mobile";
				if($this->CheckDataExists_id($query)){
					$data['otp']=$this->random_numbers(4);
					$data['token_id']=md5($mobile.$data['otp']);
					$data['mobile_verify']=0;
					date_default_timezone_set('Asia/Kolkata');
					$data['register_on']=date('Y-m-d H:i:s');
					$data['register_by']=$bodyRequest['registred_by'];
					if($this->updateData($data,$mobile,"ps_client")){
						$res[udata]= array('status' => "Success", "msg" => "Data updated successfully","data"=>$data,'valid'=>1);
						$this->response($this->json($res), 200);
					}else{
							$res[udata]= array('status' => "Failed", "msg" => "Data not inserted","valid"=>0);
							$this->response($this->json($res), 400);
					}
				}else{
					$data['otp']=$this->random_numbers(4);
					$data['token_id']=md5($mobile.$data['otp']);
					$data['mobile_verify']=0;
					$data['status']=1;
					$data['mobile']=$mobile;
					date_default_timezone_set('Asia/Kolkata');
					$data['register_on']=date('Y-m-d H:i:s');
					$data['register_by']=$bodyRequest['registred_by'];
					if($this->insertData($data,"ps_client")){
						$res[udata]= array('status' => "Success", "msg" => "Data inserted successfully","data"=>$data,'valid'=>1);
						$this->response($this->json($res), 200);
				}
			}
		}else{
						$res[udata]= array('status' => "Failed", "msg" => "Mobile number mandatory",'valid'=>0);
						$this->response($this->json($res), 200);	
			}
			
		}
		// End here code
		
		// Sign Up Again From email id & password
			private function email_signup($body){
				if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
			$bodyRequest=(array) json_decode($body);
			$email_id =$bodyRequest['email'];
			$password=md5($bodyRequest['password']);
			$validQuery ="select email,password FROM `ps_client` where email='$email_id' and password ='$password'";
				if($this->CheckDataExists_id($validQuery)){
					$getDetailsQuery ="select first_name,last_name,token_id,email,std_code,mobile,register_by,otp,use_otp,mobile_verify,status from ps_client where email='$email_id' and password = '$password'";
					$resultClient =$this->fetchData($getDetailsQuery);
							$res[udata]= 1;
							$res[result]= $resultClient;
							$this->response($this->json($res), 200);
				}else{
						$res[udata]=0;
						$res[result]="Login tredecical not matched";
						$this->response($this->json($res), 200);
						#echo "<pre>";	print_r($bodyRequest);die;
		}
	}	
		// End Code 
		
		// Forget Password
			private function forget_password($body){
				if($this->get_request_method() != "POST"){
				$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
				$email_id = $bodyRequest['email'];
				$validQuery ="select email FROM `ps_client` where email='$email_id'";
				if($this->CheckDataExists_id($validQuery)){
					$pattern = $this->random_numbers(5).$email_id;
					$newPassword= md5($pattern);
					$query ="update `ps_client` set password ='$newPassword' where email ='$email_id'";
					if(mysql_query($query)){
						$message ="Your password successfully changed.Your current password : $pattern";
						mail("$email_id","Forget Password",$message);
							$res[udata]= 1;
							$this->response($this->json($res), 200);
					}
				}else{
						$res[udata]=0;
						#$res[result]="Email id not registered";
						$this->response($this->json($res), 200);
						#echo "<pre>";	print_r($bodyRequest);die;
		}
	}
		// End Code here
		
		// Change Password
		private function change_password($body){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
				#echo "<pre>";	print_r($bodyRequest);die;
				$email = $bodyRequest['email'];
				$oldPassword = md5($bodyRequest['oldpwd']);
				$newPassword = md5($bodyRequest['newpwd']);
				$email_id = $bodyRequest['email'];
				$validQuery ="select email,password FROM `ps_client` where email='$email' and password='$oldPassword'";
				if($this->CheckDataExists_id($validQuery)){
					$query ="update `ps_client` set password ='$newPassword' where email ='$email_id'";
					if(mysql_query($query)){
							$res[udata]= 1;
							$this->response($this->json($res), 200);
					}
				}else{
						$res[udata]=0;
						$this->response($this->json($res), 200);
				}
		}
		
		
		// End Change Password
		
		//Reffered By : -
			private function reffered_by($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
				$token_id =$bodyRequest['token_id'];
				$mobile =$bodyRequest['reffered_by'];
				$data['token_id']=$bodyRequest['token_id'];
				$data['stdcode_reffered']=$bodyRequest['stdcode_reffered'];
				$data['reffered_by']=$bodyRequest['reffered_by'];
				$data['stdcode']=$bodyRequest['stdcode'];
				$data['mobile']=$bodyRequest['mobile'];
			$validateMobile ="select mobile from `ps_client` where token_id='$token_id' and mobile=$mobile and mobile_verify=1 and status=1";
				if($this->CheckDataExists_id($validateMobile)){
					date_default_timezone_set('Asia/Kolkata');
					$data['registered_on']=date('Y-m-d H:i:s');
					if($this->insertData($data,"ps_client_referal")){
						$res[udata]=1;
						$this->response($this->json($res), 200);
					}
				}else{
						$res[udata]=0;
						$this->response($this->json($res), 200);
				}
			}
		// Last here
		
		// Get User details
			private function user_login($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
				$userName = $bodyRequest['username'];
				$userPassword = md5($bodyRequest['userpassword']);
			$query_user ="select username from `ps_user` where username ='$userName'";
				if($this->CheckDataExists_id($query_user)){
					$query_status ="select status from `ps_user` where username ='$userName' and status =1";
						if($this->CheckDataExists_id($query_status)){
							$query_password ="select userpassword from `ps_user` where username ='$userName' and status =1 and userpassword='$userPassword'";
								if($this->CheckDataExists_id($query_password)){
									$get_uid = "select user_id from `ps_user` where username ='$userName' and status =1 and userpassword='$userPassword'";
									$resultUniqueid =$this->fetchData($get_uid);
									$res[udata]=4;
									$res[result]=$resultUniqueid;
									$this->response($this->json($res), 200);
								}else{
									$res[udata]=2;
									$this->response($this->json($res), 200);
								}	
						}else{
							$res[udata]=1;
							$this->response($this->json($res), 200);
						}
				}else{
					$res[udata]=0;
					$this->response($this->json($res), 200);
				}
				echo "<pre>";	print_r($bodyRequest);die;
			}
		// End here
		
		private function latlong_register($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
					$data['token_id'] = $bodyRequest['token_id'];
					$data['form_id'] = $bodyRequest['form_id'];
					$data['latitude'] = $bodyRequest['latitude'];
					$data['longitude'] = $bodyRequest['longitude'];
					$data['city'] = $bodyRequest['city'];
					$data['state'] = $bodyRequest['state'];
					$data['country'] = $bodyRequest['country'];
					$data['pincode'] = $bodyRequest['pincode'];
					date_default_timezone_set('Asia/Kolkata');
					$data['registered_date']=date('Y-m-d H:i:s');
			if($this->insertData($data,"ps_latlong")){
				$res[udata]= 1;
				$this->response($this->json($res), 200);
		}else{
			$res[udata]=0;
			$this->response($this->json($res), 200);
			}
			
		}
		/*
		 *	Encode array into JSON
		*/
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
		
		//Mobile Number Validate
		private	function phoneNumbervalidation($mobile){
			 if(preg_match('/^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1})?([0-9]{10})$/', $mobile,$matches)){
				 return true;
				}else{
				 return false;
				}
			}
		//
		
	//Check Mobile Number exists or not
	private function CheckDataExists_id($query){
		if ($resultset =mysql_query($query)){
			if (mysql_num_rows($resultset)>=1) {
				return true;
			}else{
				return 0;
			}
		}
	}	
	//
	// Generate Random 4 digits Number
		
	private	function random_numbers($digits) {
			$min = pow(10, $digits - 1);
			$max = pow(10, $digits) - 1;
			return mt_rand($min, $max);
		}
	//
	// Insert data
	public function insertData( $data,$tablename){
		if(!empty($data) && $tablename!=""){
			$query='';$que='';
			foreach ($data as $key => $value) {
				if($key!="" && $value!=""){
					$query.=" `$key` = '$value' ,";
				}
			}
			$que = rtrim($query,',');
			$updateQuery ="insert into $tablename set $que";
			$resultset =mysql_query ($updateQuery);
			if($resultset){
				return 	true;
			}
		}
     }
	//		
	// Update data when mobile number registered
		private function updateData( $data ,$mobile , $tablename){
			if(!empty($data)&& !empty($mobile) && $tablename!=""){
				$query='';$que='';
				foreach ($data as $key => $value) {
					if($key!="" && $value!=""){
						$query.="$key = '$value' ,";
					}	
				}
				$que = rtrim($query,',');
				$updateQuery ="update $tablename set $que where mobile ='".$mobile."'";
				$resultset =mysql_query($updateQuery);
				if($resultset){
					return true;
				}
			}
}
	//
		// Fetch result data
		private function fetchData($query){
			if($query!=""){
				//echo $query;die;
				$resultData = mysql_query($query);
					if (mysql_num_rows($resultData)>=1) {
					$data = array ();
					while ( $row = mysql_fetch_assoc ($resultData) ) {
						$data [] = $row;
					}
						return $data;
				}else {
					return 0;
					}
			}
		}
	//
}
	

	
	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>