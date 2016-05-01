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
						$mobileVerified ="select mobile FROM `ps_client` where mobile=$mobile and `mobile_verify`='1'";
						if($this->CheckDataExists_id($mobileVerified)){
							$queryClient = "select token_id,std_code,mobile,register_by,otp,use_otp,mobile_verify from ps_client where mobile=$mobile";
							$resultClient =$this->fetchData($queryClient);
							//echo "<pre>";print_r($resultClient);die;
							$res[udata]= 1;
							$res[result]= $resultClient;;
							$this->response($this->json($res), 200);
						}else{
							$queryClient = "select otp,token_id,register_by,mobile_verify,status,use_otp,register_on,mobile from ps_client where mobile=$mobile";
							$resultClient =$this->fetchData($queryClient);
							$res[udata]= 0;
							$res[result]= $resultClient;;
							$this->response($this->json($res), 200);
						}
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
				// for email template use
					$firstname=$bodyRequest['first_name'];
					$lastname=$bodyRequest['last_name'];
					$email=$bodyRequest['email'];
				// end here
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
							$queryClient = "select first_name,last_name,token_id,email,std_code,mobile,register_by,otp,use_otp,email_verify,mobile_verify,status from ps_client where mobile=$mobile";
							$resultClient =$this->fetchData($queryClient);
							$firstname=$resultClient[0]['first_name'];
							$lastname=$resultClient[0]['last_name'];
							$token=$resultClient[0]['token_id'];
							$email=$resultClient[0]['email'];
							$mobile=$resultClient[0]['mobile'];
						if($resultClient[0]['email_verify']==0){
							$template =$this->send_mail($firstname,$lastname,$token,$email,$mobile);
							if($template == "1"){
									$res[udata]= 1;
									$res[result]= $resultClient;
									$this->response($this->json($res), 200);
								}
							}else{
								$res[udata]= 1;
								$res[result]= $resultClient;
								$this->response($this->json($res), 200);
							  }
						}
					}else{
						#echo "<pre>";print_r($data);die;
						date_default_timezone_set('Asia/Kolkata');
						$data['register_on']=date('Y-m-d H:i:s');
						$template =$this->send_mail($firstname,$lastname,$token,$email,$mobile);
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
						$res[udata]= array('status' => "Success","data"=>$data,'valid'=>1);
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
				$validateMobile ="select mobile from `ps_client` where token_id='$token_id' and mobile=$mobile and mobile_verify='1' and status='1'";
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
				//echo "<pre>";	print_r($bodyRequest);die;
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
				//form_id => unique_id,unique_id=emp_id
					$udata['unique_id']=$bodyRequest['token_id'];
					$udata['emp_id']=$bodyRequest['form_id'];
					$this->insertData($udata,"ps_vendor");
				$res[udata]= 1;
				$this->response($this->json($res), 200);
		}else{
			$res[udata]=0;
			$this->response($this->json($res), 200);
			}
			
		}
		
		// verify email id from API
		
			private function verify_email($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
					$token_id = base64_decode($bodyRequest['token_id']);
					$emailencode = $bodyRequest['emailencode'];
					$query ="select token_id,email,mobile from `ps_client` where token_id='$token_id'";
					$resultdata =$this->fetchData($query);
					$mobile=$resultdata[0]['mobile'];
					$tokenid=$resultdata[0]['token_id'];
					$email_id=$resultdata[0]['email'];
					$matched_key=($tokenid.$mobile);
					if($matched_key == $emailencode){
						$udata['email_verify']=1;
						if($this->updateData($udata,$mobile,"ps_client")){
							$res[udata]=1;
							$this->response($this->json($res), 200);
						exit();
					 }
				}else{
					$res[udata]=0;
					$this->response($this->json($res), 200);
						exit();
					}
						
		}
		//end
	// Get offer
		private function get_offer($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
			#echo "<pre>";	print_r($bodyRequest);die;
						$query ="select * from `ps_vendor_offer` where active_status=1";
						$resultdata =$this->fetchData($query);
						if(!empty($resultdata)){
							$res[udata]= 1;
							$res[result]= $resultdata;
							$this->response($this->json($res), 200);
						}
						else{
							$res[udata]= 0;
							$this->response($this->json($res), 200);
						}	
		}
		
	// End code.
	
	// Get Profile Details : --
		private function get_profile_details($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
					#echo "<pre>";	print_r($bodyRequest);die;
					$token_id = $bodyRequest['token_id'];
					$mobile = $bodyRequest['mobile'];
					$query ="select token_id,mobile from `ps_client` where token_id='$token_id' and mobile='$mobile'";
					if($this->CheckDataExists_id($query)){
					$query ="select first_name,last_name,dob,mobile,email,email_verify,mobile_verify,register_on from `ps_client` where token_id='$token_id' and mobile=$mobile";
					$get_star = "select balance_star,redeemable_star from `ps_client_star` where unique_id='$token_id'";
					$result_query =$this->fetchData($query);
					$result_points =$this->fetchData($get_star);
					$resultdata = array_merge($result_query,$result_points);
					if(mysql_query($query)){
							$res[udata]= 1;
							$res[result]=$resultdata;
							$this->response($this->json($res), 200);
					}
				}else{
						$res[udata]=0;
						$this->response($this->json($res), 200);
				}
						
		}
	// End
	
	// Update Profile deatails: -
		private function update_profile_details($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
				#echo "<pre>";	print_r($bodyRequest);die;
					$token_id = $bodyRequest['token_id'];
					$mobile = $bodyRequest['mobile'];
					$udata['first_name'] = $bodyRequest['first_name'];
					$udata['last_name'] = $bodyRequest['last_name'];
					$udata['dob'] = $bodyRequest['dob'];
					$udata['alt_mobile'] = $bodyRequest['alt_mobile'];
					$udata['email'] = $bodyRequest['email'];
					$udata['image_name'] = $bodyRequest['image_name'];
					$query ="select token_id,mobile from `ps_client` where token_id='$token_id' and mobile='$mobile'";
					if($this->CheckDataExists_id($query)){
						if($this->updateData($udata,$mobile,"ps_client")){
							$res[udata]= 1;

							$this->response($this->json($res), 200);
							}
					}else{
						$res[udata]= 0;
						$this->response($this->json($res), 200);
							}
		}
	// End
		
	// For coupon code :-
		private function get_redeem($body){
			if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
				#echo "<pre>";	print_r($bodyRequest);die;
				$token_id = $bodyRequest['token_id'];
				$mobile = $bodyRequest['mobile'];
				$coupon = strtoupper($bodyRequest['coupon']);
			$query ="select token_id,mobile from `ps_client` where token_id='$token_id' and mobile='$mobile'";
					if($this->CheckDataExists_id($query)){
					$getCouVal = str_replace("PINKSTAROFFER"," ",$coupon);
					$checkStatus ="select `active_status` from ps_coupon where `coupon_id` = '$coupon'";
						$result_query =$this->fetchData($checkStatus);
							if($result_query[0]['active_status'] ==1){
					$getBalcnce ="select balance_star,redeemable_star from ps_client_star where `unique_id` = '$token_id'";
								$result_bal =$this->fetchData($getBalcnce);
					$udata['balance_star']=$result_bal[0]['balance_star']+$getCouVal;
					$udata['redeemable_star']=$result_bal[0]['redeemable_star']+$getCouVal;
					date_default_timezone_set('Asia/Kolkata');
					$udata['update_date']=date('Y-m-d H:i:s');
								if($this->updateDataPara($udata,'unique_id',$token_id,"ps_client_star")){
									$udata1['active_status']='0';$udata1['used_by']=$token_id;
									if($this->updateDataPara($udata1,'coupon_id',$coupon,"ps_coupon")){
									$res[udata]= 1;
									$this->response($this->json($res), 200);
										}
									}
							}else{
								$res[udata]= 3;
								$this->response($this->json($res), 200);
								exit();
							}
						
					}else{
						$res[udata]= 0;
						$this->response($this->json($res), 200);
					}
		}
	// End
		
	// Get vendor list
		private function vendor_list($body){
			if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
				$token_id = $bodyRequest['token_id'];
				$mobile = $bodyRequest['mobile'];
				$i=0;
				//$latitude = $bodyRequest['latitude'];
				//$longitude = $bodyRequest['longitude'];
				//$latitude1 = $bodyRequest['latitude1'];
				//$longitude1 = $bodyRequest['longitude1'];
			$temp = array();
				$query ="select token_id,mobile from `ps_client` where token_id='$token_id' and mobile='$mobile'";
					if($this->CheckDataExists_id($query)){
				$query_ven ="SELECT ps_vendor.unique_id,ps_vendor.emp_id,ps_vendor.username,ps_vendor.fname,ps_vendor.lname, 
							ps_vendor.email,ps_vendor.company_name,ps_vendor.company_display_name,ps_vendor.featured,ps_vendor.category, 
							ps_latlong.longitude,ps_latlong.latitude From ps_vendor INNER JOIN ps_latlong ON ps_vendor.unique_id = ps_latlong.vendor_id";
						$resultdata =$this->fetchData2($query_ven);
						//$resultdata =$this->fetchData($query_ven);
						if($resultdata){
							//$getImage =$this->fetchimage($resultdata);
							$res[udata]= 1;
							$res[result]=$resultdata;
							$this->response($this->json($res), 200);
						}
						#	echo "<pre>";	print_r($results);die;
					
					}
		}
	// End		
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
// update data on parameter basics: -
		private function updateDataPara( $data ,$col,$mobile , $tablename){
			if(!empty($data)&& !empty($mobile) && $tablename!=""){
				$query='';$que='';
				foreach ($data as $key => $value) {
					if($key!="" && $value!=""){
						$query.="$key = '$value' ,";
					}	
				}
				$que = rtrim($query,',');
				$updateQuery ="update $tablename set $que where $col ='".$mobile."'";
				$resultset =mysql_query($updateQuery);
				if($resultset){
					return true;
				}
			}
}
// End
		
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
	#*********************************#
	private function fetchimage($resultdata){
		if(!empty($resultdata)){
			$dataimage=array();
			#echo "<pre>";
			#print_r($resultdata);die;
			foreach($resultdata as $key => $valueArr){
				foreach($valueArr as $key1 => $value){
				if($key1=='unique_id'){
					echo $getImage = "select * from ps_vendor_images where vendor_id='".$valueArr['unique_id']."'";
					$resultData = mysql_query($getImage);
				while ( $row = mysql_fetch_assoc ($resultData) ) {	
						$dataimage['image'][]= $row;
						break;
					}
				}else{
					//$dataimage[$key1]=$value;
				}
			
			}
				
			}
			print_r($dataimage);die;
			return $dataimage;
		}
	}
		
		
private function fetchData2($query){
			if($query!=""){
				//echo $query;die;
				$resultData = mysql_query($query);
					if (mysql_num_rows($resultData)>=1) {
					$data = array ();
					while ( $row = mysql_fetch_assoc ($resultData) ) {
						//echo "<pre>";print_r($row);
						$data [] = $row;
						$getImage = "select * from ps_vendor_images where vendor_id='".$row['unique_id']."'";
						$resultData1 = mysql_query($getImage);
							while ( $row1 = mysql_fetch_assoc ($resultData1) ) {
								echo '--->'.count($row1).'<br>';
									$data[]['image']= $row1;
									
							}
				 }
					return $data;
				}else {
					return 0;
					}
			}
		}
	#*********************************#
	
	// Send Mail
		private function send_mail($firstname,$lastname,$token,$email,$mobile){
			$user_email ='pink@star.com';
			// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				// Create email headers
				$headers .= 'From: '.$user_email."\r\n".
    			'Reply-To: '.$user_email."\r\n" .
    			'X-Mailer: PHP/' . phpversion();
 			// Compose a simple HTML email message
				$first_name ='<b>Your first name is </b>:- '.$firstname; 
				$last_name ='<b>Your last name is </b>:- '.$lastname; 
				$password = '<b>your password is </b>:-' .$token; 
				$email_temp = '<b>Your email id is </b>:-' .$email; 
				$mobileVal ="<b>Your registered mobile no is</b> :-".$mobile;
				$mobile_temp =$mobile;
				$password_temp =base64_encode($token);
				$emailencode=$token.$mobile_temp;
				$email_verify ="<a href='http://pinkstarapp.com/api/restservices.php?rquest=verify_email&emailencode=$emailencode&t=$password_temp'><b>Click to link verify your email id</b></a>";
				$message = '<!DOCTYPE HTML>'. 
				'<head>'. 
				'<meta http-equiv="content-type" content="text/html">'. 
				'<title>Email notification</title>'. 
				'</head>'. 
				'<body>'.
				'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
				   '<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
					   '<p>'.$first_name.'</p>'. 
					   '<p>'.$last_name.'</p>'. 
					   '<p>'.$password.'</p>'. 
					   '<p>'.$email_temp.'</p>'. 
					   '<p>'.$mobileVal.'</p>'.
				       '<p>'.$email_verify.'</p>';
				   '</div>'.   
				'</div>'.
				'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
				   'All rights reserved @ mysite.html 2014'. 
				'</div>'. 
				'</body>';
 			$to = "$email";
			$subject = 'Registration Details';
			$from = 'peterparker@email.com';
			// Sending email
			if(mail($to, $subject, $message, $headers)){
				return "1";
			}else{
				return "2";
			}
		}
	// End
}

	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>