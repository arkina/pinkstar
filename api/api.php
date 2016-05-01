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
						//$data['otp']=$this->random_numbers(4);
						$data['otp']='1234';
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
						#echo "1";die;
						$udata['first_name']=$bodyRequest['first_name'];
						$udata['last_name']=$bodyRequest['last_name'];
						$udata['email']=$bodyRequest['email'];
						$udata['password']=$bodyRequest['password'];
						//$udata['password']=md5($bodyRequest['password']);
						$udata['mobile_verify']=1;$udata['status']=1;
						if($this->updateData($udata,$mobile,"ps_client")){
							#echo "2";die;
							$queryClient = "select id,first_name,last_name,token_id,email,std_code,mobile,register_by,otp,use_otp,email_verify,mobile_verify,status from ps_client where mobile=$mobile";
							$resultClient =$this->fetchData($queryClient);
							#echo "<pre>";print_r($resultClient);die;
							$data['firstname']=$resultClient[0]['first_name'];
							$data['lastname']=$resultClient[0]['last_name'];
							$data['token']=$resultClient[0]['token_id'];
							$data['email']=$resultClient[0]['email'];
							$data['mobile']=$resultClient[0]['mobile'];
							$stardata['unique_id']=$resultClient[0]['id'];
							$stardata['balance_star']=200;
							$stardata['redeemable_star']=$stardata['balance_star']-50;
							$stardata['created_date']=date('Y-m-d H:i:s');
						$this->insertData($stardata,"ps_client_star");
						$redeemable_star =$stardata['redeemable_star'];
						$data['balance_star']=200;
						$data['redeemable_star']=$redeemable_star;
					/* For email */
							$firstname=$resultClient[0]['first_name'];
							$lastname=$resultClient[0]['last_name'];
							$token=$resultClient[0]['token_id'];
							$email=$resultClient[0]['email'];
							$mobile=$resultClient[0]['mobile'];
						if($resultClient[0]['email_verify']==0){
							$template =$this->send_mail($firstname,$lastname,$token,$email,$mobile);
							if($template == "1"){
									$res[udata]= 1;
									$res[result]= $data;
									$this->response($this->json($res), 200);
								}
							}else{
								$res[udata]= 1;
								$res[result]= $data;
								$this->response($this->json($res), 200);
							  }
						}
					}else{
						echo "<pre>";print_r($data);die;
						date_default_timezone_set('Asia/Kolkata');
						$data['register_on']=date('Y-m-d H:i:s');
						$template =$this->send_mail($firstname,$lastname,$token,$email,$mobile);
						if($this->insertData($data,"ps_client")){
							// For new user entry ps_client_star
					$get_id ="select id from ps_client where token_id ='$token'";
						$new_id =$this->fetchData($get_id);
						#echo "<pre>";print_r($resultClient);die;
						$stardata['unique_id']=$new_id[0]['id'];
						$stardata['balance_star']=200;
						$stardata['redeemable_star']=$stardata['balance_star']-50;
						$stardata['created_date']=date('Y-m-d H:i:s');
						$this->insertData($stardata,"ps_client_star");
						$redeemable_star =$stardata['redeemable_star'];
						$data['balance_star']=200;
						$data['redeemable_star']=$redeemable_star;	
							//$retData = json_encode($data);
							unset($data['mobile']);unset($data['std_code']);
							$data['mobile']=$mobileStd.$mobile;
							$res[udata]= 1;
							$res[result]= $data;
							$this->response($this->json($res), 200);
						}
					}
				}
			
		}
			
		//
		
		// For Registration by Social Sites
		
			private function registrationsocialsites($body){
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
					$bodyRequest=(array) json_decode($body);
					#print_r($bodyRequest);die;
					$mobile =$bodyRequest['mobile'];
					$data['std_code']=$bodyRequest['stdcode'];
					$data['mobile']=$bodyRequest['mobile'];
					$data['email']=$bodyRequest['email'];
					$data['first_name']=$bodyRequest['first_name'];
					$data['last_name']=$bodyRequest['last_name'];
					$data['register_by']=$bodyRequest['register_by'];
					$data['token_id'] =$this->getToken(25);
					$userpass =$this->getToken(8);
					$data['password']= md5($userpass);
				// for email template use
					$firstname=$bodyRequest['first_name'];
					$lastname=$bodyRequest['last_name'];
					$email=$bodyRequest['email'];
					$password = $userpass;
					$token =$data['token_id'];
				// end here
					#echo "<pre>";print_r($data);die;
				$valid=$this->phoneNumbervalidation($mobile);
				if($valid){
							$res[udata]= 0;
							$res[result]= array('status' => "Registered", "msg" => "Already Registered");
							$this->response($this->json($res), 200);
						exit();
				}else{
						date_default_timezone_set('Asia/Kolkata');
						$data['register_on']=date('Y-m-d H:i:s');
						$template =$this->send_mailfb($firstname,$lastname,$token,$password,$email,$mobile);
						if($this->insertData($data,"ps_client")){
							// For new user entry ps_client_star
					$get_id ="select id from ps_client where token_id ='$token'";
						$new_id =$this->fetchData($get_id);
						#echo "<pre>";print_r($resultClient);die;
						$stardata['unique_id']=$new_id[0]['id'];
						$stardata['balance_star']=200;
						$stardata['redeemable_star']=$stardata['balance_star']-50;
						$stardata['created_date']=date('Y-m-d H:i:s');
						$this->insertData($stardata,"ps_client_star");
						$redeemable_star =$stardata['redeemable_star'];
						$data['balance_star']=200;
						$data['redeemable_star']=$redeemable_star;	
							//$retData = json_encode($data);
							unset($data['mobile']);unset($data['std_code']);
							$data['mobile']=$mobileStd.$mobile;
							$res[udata]= 1;
							$res[result]= $data;
							$this->response($this->json($res), 200);
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
			//$email_id =$bodyRequest['email'];
			$mobile =$bodyRequest['mobile'];
			$password=md5($bodyRequest['password']);
			$validQuery ="select email,password FROM `ps_client` where mobile='$mobile' and password ='$password'";
				if($this->CheckDataExists_id($validQuery)){
					$get_id = "select id FROM `ps_client` where mobile='$mobile' and password ='$password'";
					$result_id =$this->fetchData($get_id);
					$id = $result_id[0]['id'];
					$unique_id = md5(mt_rand(100000,999999).'pinkstar');
					$data['token_id']=$unique_id;
				if($this->updateData_id($data,$id,"ps_client")){
					$getDetailsQuery ="select ps_client.first_name,ps_client.last_name,ps_client.token_id,ps_client.email,
					ps_client.std_code,ps_client.mobile,ps_client.register_by,ps_client.otp,ps_client.use_otp,ps_client.mobile_verify,
					ps_client.status,ps_client_star.balance_star,ps_client_star.redeemable_star From ps_client inner join ps_client_star on ps_client_star.unique_id =ps_client.id where ps_client.id=$id";
					$resultClient =$this->fetchData($getDetailsQuery);
						$res[udata]= 1;
						$res[result]= $resultClient;
						$this->response($this->json($res), 200);
					}
				}else{
						$res[udata]=0;
						$res[result]="Login Credecical not matched";
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
				$mobile =$bodyRequest['mobile'];
				//$email_id = $bodyRequest['email'];
				$validQuery ="select mobile FROM `ps_client` where mobile='$mobile'";
				if($this->CheckDataExists_id($validQuery)){
					$pattern = $this->random_numbers(6);
					$newPassword= md5($pattern);
					$query ="update `ps_client` set password ='$newPassword' where mobile ='$mobile'";
					if(mysql_query($query)){
						$get_emailId ="select email FROM `ps_client` where mobile='$mobile'";
						$email=$this->fetchData($get_emailId);
						$email_id=$email[0]['email'];
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
				$mobile = $bodyRequest['mobile'];
				$oldPassword = md5($bodyRequest['oldpwd']);
				$newPassword = md5($bodyRequest['newpwd']);
				$validQuery ="select email,password FROM `ps_client` where mobile='$mobile' and password='$oldPassword'";
				if($this->CheckDataExists_id($validQuery)){
					$query ="update `ps_client` set password ='$newPassword' where mobile ='$mobile'";
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
				$validateMobile ="select mobile from `ps_client` where mobile=$mobile and mobile_verify='1' and status='1'";
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
					$data['vendor_id'] = $bodyRequest['form_id'];
					$data['emp_id'] = $bodyRequest['token_id'];
					$data['latitude'] = $bodyRequest['latitude'];
					$data['longitude'] = $bodyRequest['longitude'];
					$data['city'] = $bodyRequest['city'];
					$data['state'] = $bodyRequest['state'];
					$data['country'] = $bodyRequest['country'];
					$data['pincode'] = $bodyRequest['pincode'];
					date_default_timezone_set('Asia/Kolkata');
					$data['registered_date']=date('Y-m-d H:i:s');
					#echo "<pre>";print_r($data);die;
			if($this->insertData($data,"ps_latlong")){
				//form_id => unique_id,unique_id=emp_id
					$udata['emp_id']=$bodyRequest['token_id'];
					$udata['unique_id']=$bodyRequest['form_id'];
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
						//$query ="select * from `ps_vendor_offer` where active_status=1";
			$query ="select ps_vendor_offer.id,ps_vendor_offer.vendor_id,ps_vendor_offer.image_url,
					ps_vendor_offer.current_offers,ps_vendor_offer.valid_from,ps_vendor_offer.valid_to,
					ps_vendor_offer.active_status,ps_client_star.balance_star,ps_client_star.redeemable_star
					from ps_vendor_offer inner join ps_client_star ON ps_vendor_offer.id = ps_client_star.unique_id where ps_vendor_offer.active_status=1";
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
			$final = array();
				if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
					#echo "<pre>";	print_r($bodyRequest);die;
					$token_id = $bodyRequest['token_id'];
					$mobile = $bodyRequest['mobile'];
					$query ="select token_id,mobile from `ps_client` where token_id='$token_id' and mobile='$mobile'";
					if($this->CheckDataExists_id($query)){
					$get_id = "select id FROM `ps_client` where token_id='$token_id' and mobile='$mobile'";
					$result_id =$this->fetchData($get_id);
					$id = $result_id[0]['id'];
					$getDetailsQuery ="select ps_client.first_name,ps_client.last_name,ps_client.token_id,ps_client.email,ps_client.gender,ps_client.dob,ps_client.image_url,ps_client.anniversary,
					ps_client.std_code,ps_client.mobile,ps_client.register_by,ps_client.otp,ps_client.use_otp,ps_client.mobile_verify,
					ps_client.status,ps_client_star.balance_star,ps_client_star.redeemable_star,ps_client_star.offer_key From ps_client inner join ps_client_star on ps_client_star.unique_id =ps_client.id where ps_client.id=$id";
					$resultdata =$this->fetchData($getDetailsQuery);
							$res[udata]= 1;
							$res[result]=$resultdata;
							$this->response($this->json($res), 200);
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
				#echo "<pre>";print_r($bodyRequest);die;
					$token_id = $bodyRequest['token_id'];
					$mobile = $bodyRequest['mobile'];
					$udata['first_name'] = $bodyRequest['first_name'];
					$udata['last_name'] = $bodyRequest['last_name'];
					$udata['dob'] = $bodyRequest['dob'];
					$udata['alt_mobile'] = $bodyRequest['alt_mobile'];
					$udata['email'] = $bodyRequest['email'];
					$udata['gender'] = $bodyRequest['gender'];
					$udata['anniversary'] = $bodyRequest['anniversary'];
					$image_text = $bodyRequest['image_text'];
					$data = str_replace('data:image/png;base64,', '', $image_text);
					$data = str_replace(' ', '+', $data);	
					$data = base64_decode($data);
					$image_name =$mobile.rand() . '.png';
					$file = '../uploads/userprofile/'.$image_name;
					$udata['image_url']="http://pinkstarapp.com/uploads/userprofile/".$image_name;
					$success = file_put_contents($file, $data);
					// $data = str_replace('data:image/png;base64,', '', $image_name);
					// $data = str_replace(' ', '+', $data);	
					// $data = base64_decode($data);
					// $udata['image_name']=$mobile.rand() . '.png';
					// $file = '../uploads/userprofile/'.$image_name;
					if($success){
					$query ="select token_id,mobile from `ps_client` where token_id='$token_id' and mobile='$mobile'";
					if($this->CheckDataExists_id($query)){
						if($this->updateData($udata,$mobile,"ps_client")){
						$get_id = "select id FROM `ps_client` where token_id='$token_id' and mobile='$mobile'";
						$result_id =$this->fetchData($get_id);
						$id = $result_id[0]['id'];
						$get_star ="select balance_star,redeemable_star from ps_client_star where unique_id='$id'";
							$getstar=$this->fetchData($get_star);
							$res[udata]= 1;
							$res[result]=$getstar[0];
							$this->response($this->json($res), 200);
							}
					}else{
						$res[udata]= 0;
						$this->response($this->json($res), 200);
							}
					}else{
						$res[udata]= 0;
						$res[result]="uploaded file not moved";
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
					$get_id = "select id FROM `ps_client` where token_id='$token_id' and mobile='$mobile'";
					$result_id =$this->fetchData($get_id);
					$id = $result_id[0]['id'];
					$getCouVal = str_replace("PINKSTAROFFER"," ",$coupon);
					$checkStatus ="select `active_status` from ps_coupon where `coupon_id` = '$coupon'";
						$result_query =$this->fetchData($checkStatus);
							if($result_query[0]['active_status'] ==1){
					$getBalcnce ="select balance_star,redeemable_star from ps_client_star where `unique_id` =$id";
					$result_bal =$this->fetchData($getBalcnce);
					#echo "<pre>";print_r($result_bal);die;
					$udata['balance_star']=$result_bal[0]['balance_star']+$getCouVal;
					$udata['redeemable_star']=$result_bal[0]['redeemable_star']+$getCouVal;
					date_default_timezone_set('Asia/Kolkata');
					$udata['update_date']=date('Y-m-d H:i:s');
								if($this->updateDataPara($udata,'unique_id',$id,"ps_client_star")){
									$udata1['active_status']='0';$udata1['used_by']=$token_id;
									if($this->updateDataPara($udata1,'coupon_id',$coupon,"ps_coupon")){
							$getCurrentStars="select balance_star,redeemable_star from ps_client_star where `unique_id` =$id";
							$updateResult_bal =$this->fetchData($getCurrentStars);
									$res[udata]= 1;
									$res[result]=$updateResult_bal;
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
					//if($this->CheckDataExists_id($query)){
				//$query_ven ="SELECT ps_vendor.unique_id,ps_vendor.emp_id,ps_vendor.username,ps_vendor.fname,ps_vendor.lname, 
				//ps_vendor.email,ps_vendor.company_name,ps_vendor.company_display_name,ps_vendor.featured,ps_vendor.category, 
				//ps_latlong.longitude,ps_latlong.latitude From ps_vendor INNER JOIN ps_latlong ON ps_vendor.unique_id = ps_latlong.vendor_id";
				$query_ven="SELECT ps_vendor.unique_id,ps_vendor.emp_id,ps_vendor.username,ps_vendor.company_name,ps_vendor.company_display_name,ps_vendor.featured,ps_vendor.category,ps_vendor.bill_discount,ps_latlong.longitude,ps_latlong.latitude From ps_vendor INNER JOIN ps_latlong ON ps_vendor.unique_id = ps_latlong.vendor_id and ps_latlong.vendor_status='1'";		
					$resultdata =$this->fetchData_image($query_ven);
						if($resultdata){
							$res[udata]= 1;
							$res[result]=$resultdata;
							$this->response($this->json($res), 200);
						}
						#echo "<pre>";	print_r($results);die;
					
					//}
		}
	// End		

	// For Vendor details : -
		private function vendor_details($body){
			if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
			$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
				$vendor_id = $bodyRequest['vendor_id'];
				$token_id = $bodyRequest['token_id'];
				$mobile = $bodyRequest['mobile'];
				$billdata = array();
				$data = array();
			$main_query ="select ps_vendor.company_display_name,ps_vendor.category,ps_vendor_address.address,ps_vendor_address.address_second,
ps_vendor_address.country,ps_vendor_address.state,ps_vendor_address.city,ps_vendor_address.pincode,
ps_vendor_address.type,ps_latlong.latitude,ps_latlong.longitude from ps_vendor inner join ps_vendor_address on ps_vendor.unique_id = ps_vendor_address.unique_id
inner join ps_latlong on ps_latlong.vendor_id = ps_vendor_address.unique_id where ps_vendor.unique_id ='".$vendor_id."'";
			$result1['details'] =$this->fetchData($main_query);
			#echo "<pre>";print_r($result1);die;
		$query_contact ="select ps_vendor_contact.std_code,ps_vendor_contact.number,ps_vendor_contact.type
from ps_vendor_contact where unique_id='".$vendor_id."'";
			$result2['contact'] =$this->fetchData($query_contact);
			#echo "<pre>";print_r($result2);die;
	$query_count="select count(*) as count from ps_client_bill where form_id ='".$vendor_id."'";
	$result3['count'] =$this->fetchData($query_count);
	$getbill = "select sum(bill_amount) as bill from `ps_client_bill` where form_id='".$vendor_id."' and emp_status='approved' and vendor_status='approved' and  month(`bill_upload_date`) = EXTRACT(month FROM (NOW())) AND year(`bill_upload_date`) = EXTRACT(year FROM (NOW()))";
	$result_bill =$this->fetchData($getbill);
			#echo "<pre>";print_r($result_bill);
						if(empty($result_bill)){
							$getBillempty="select amount from `ps_vendor_commision` where unique_id='".$vendor_id."' and slab_min='0'";
									$resultEmpty =$this->fetchData($getBillempty);
									#print_r($result55);die;
									$get_commisionEmpty="select ps_discount,ps_vdiscount from `ps_percent_discount` where vendor_discount='".$resultEmpty[0]['amount']."'";
									$final_result =$this->fetchData($get_commisionEmpty);
									#print_r($final_result2);die;
									$billdata[]=$final_result;
									#break;
						}else{
						#echo "<pre>";print_r($result_bill);echo "<br>";die; 
					 $get_bill_slab="select slab_min,slab_max from `ps_vendor_commision` where unique_id='".$vendor_id."'";
						$result_billslab =$this->fetchData($get_bill_slab);
						#echo "<pre>";print_r($result_billslab);echo "<br>";die;
						$billCount =count($result_billslab);
							$j=1;
						for($i=0;$i<=$billCount;$i++){
							if(($billCount-1) > $i ){
								if($result_bill[0]['bill'] > $result_billslab[$i]['slab_min'] && $result_bill[0]['bill'] < $result_billslab[$i]['slab_max']){
							$query ="select amount from `ps_vendor_commision` where slab_max > ".$result_bill[0]['bill']." and slab_max < ".$result_billslab[$j]['slab_min']." and unique_id='".$vendor_id."'";
							$result66 =$this->fetchData($query);
								if($result66){
								   $get_commision ="select ps_discount,ps_vdiscount from `ps_percent_discount` where vendor_discount='".$result66[0]['amount']."'";
									$final_result =$this->fetchData($get_commision);
									#print_r($final_result);
									$billdata[]=$final_result;
								}
							}
							$j++;
							}else{
							//	unset($billdata);
								if(empty($final_result)){
									$get_new="select amount from `ps_vendor_commision` where id ='".$billCount."'";
									$result55 =$this->fetchData($get_new);
									#print_r($result55);die;
									$get_commision44="select ps_discount,ps_vdiscount from `ps_percent_discount` where vendor_discount='".$result55[0]['amount']."'";
									$final_result =$this->fetchData($get_commision44);
									#print_r($final_result2);die;
									$billdata[]=$final_result;
									break;
								}
							}
							
					}
				}
					$data[]['discount']=$billdata;unset($billdata);
	$resultdata = array_merge($result1,$result2,$result3,$data);
			if($resultdata){
				$res[udata]= 1;
				$res[result]=$resultdata;
				$this->response($this->json($res), 200);
			}else{
				$res[udata]=0;
				$this->response($this->json($res), 200);
			}
			
			#echo "<pre>";print_r($result);die;
		}
	// End Here
		
	// user logout
		private function user_logout($body){
			if($this->get_request_method() != "POST"){
				$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
				#echo "<pre>";	print_r($bodyRequest);die;
				$mobile = $bodyRequest['mobile'];
				$token_id = $bodyRequest['token_id'];
				$validQuery ="select mobile,token_id FROM `ps_client` where mobile='$mobile' and token_id='$token_id'";
				if($this->CheckDataExists_id($validQuery)){
					$query ="update `ps_client` set token_id ='null' where mobile ='$mobile'";
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
/*  Recharge Api  */
	private function operator_list($body){
		if($this->get_request_method() != "POST"){
					$this->response('',406);
		}
			$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
			$operator_list = $bodyRequest['operator_list'];
			if($operator_list == '1'){
				$optArr =array(array("operator_id"=>"AT","operator_name"=>"AIRTEL"),
   						 array("operator_id"=>"VF","operator_name"=>"VODAFONE"),
						 array("operator_id"=>"BS","operator_name"=>"BSNL"),
						 array("operator_id"=>"RL","operator_name"=>"RELIANCE CDMA"),
						 array("operator_id"=>"RG","operator_name"=>"RELIANCE GSM"),
						 array("operator_id"=>"UN","operator_name"=>"UNINOR"),
						 array("operator_id"=>"MS","operator_name"=>"MTS"),
						 array("operator_id"=>"IDX","operator_name"=>"IDEA"),
						 array("operator_id"=>"IDY","operator_name"=>"IDEA"),
						 array("operator_id"=>"AL","operator_name"=>"AIRCEL"));
			$res[udata]= 1;
			$res[result]=$optArr;
			$this->response($this->json($res), 200);
			}else{
			}
	}	
		
	private function recharge_prepaid($body){
		if($this->get_request_method() != "POST"){
					$this->response('',406);
		}
			$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
				$token_id = $bodyRequest['token_id'];
				$mobile = $bodyRequest['mobile'];
				$rechargeno = $bodyRequest['rechargeno'];
				$amount = $bodyRequest['amount'];
				$operator=$bodyRequest['operator'];
				$tax =20;
				$finalAmt = $amount+$tax;
					$get_id = "select id FROM `ps_client` where token_id='$token_id' and mobile='$mobile'";
					$result_id =$this->fetchData($get_id);
					$id = $result_id[0]['id'];
				$getBalcnce ="select redeemable_star from ps_client_star where `unique_id` =$id";
					$result_bal =$this->fetchData($getBalcnce);
					$restAmt = $result_bal[0]['redeemable_star'] -$finalAmt;
				#echo "<pre>";print_r($result_bal);die;
						if($result_bal[0]['redeemable_star'] > $finalAmt){
							$uniqueorderid = substr(number_format(time() * rand(),0,'',''),0,10);
							$ch = curl_init();
							$timeout = 100; // set to zero for no timeout
							$myHITurl ="http://joloapi.com/api/recharge.php?mode=1&userid=PinkStar&key=563904175433643&operator=$operator&service=$rechargeno&amount=$amount&orderid=$uniqueorderid";
							curl_setopt ($ch, CURLOPT_URL, $myHITurl);
							curl_setopt ($ch, CURLOPT_HEADER, 0);
							curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
							$file_contents = curl_exec($ch);
							$curl_error = curl_errno($ch);
							curl_close($ch);
							//dump output of api if you want during test
							//echo "<pre>";print_r($file_contents);die;
							$maindata = explode(",", $file_contents);
								$countdatas = count($maindata);
								if($countdatas > 2){
								//recharge is success
								$joloapiorderid = $maindata[0]; //it is joloapi.com generated order id
								$txnstatus = $maindata[1]; //it is status of recharge SUCCESS,FAILED
								$operator= $maindata[2]; //operator code
								$service= $maindata[3]; //mobile number
								$amount= $maindata[4]; //amount
								$mywebsiteorderid= $maindata[5]; //your website order id
								$errorcode= $maindata[6]; // api error code
								$operatorid= $maindata[7]; //original operator transaction id
								$myapibalance= $maindata[8]; //my joloapi.com remaining balance
								$myapiprofit= $maindata[9]; //my earning on this recharge
								$txntime= $maindata[10]; // recharge time
							$data['user_id'] = $id;
							$data['re_orderid']=$joloapiorderid;
							$data['re_status']=$txnstatus;
							$data['re_date']=$txntime;
							$data['re_amount']=$amount;
							$data['re_operator']=$operator;
							$data['error_code']=$errorcode;
							$data['re_transactionid']=$operatorid;
							$data['re_mobile']=$rechargeno;
							$data['re_clientid']=$mywebsiteorderid;
							//$data['re_type']="prepaid";
							#echo "<pre>";print_r($data);
							if($this->insertData($data,"ps_prepaid_recharge")){
								$query ="update `ps_client_star` set redeemable_star =$restAmt where `unique_id`=$id";
									if(mysql_query($query)){
										$res[udata]= 1;
										$res[result]=$data;
										$this->response($this->json($res), 200);
									}
								 }
								}else{
								//recharge is failed
									#echo "<pre>";print_r($maindata);die;
								$data['re_status'] = 'Failed'; //it is status of recharge FAILED
								$data['error_code']= $maindata[1]; // api error code
								$data['re_mobile']= $rechargeno; //mobile number
								$data['re_amount']= $amount;
								$data['re_operator']= $operator;
								$data['re_clientid']=$mywebsiteorderid;
									if($this->insertData($data,"ps_prepaid_recharge")){
										$res[udata]= 0;
										$res[result]="Faild to Recharge";
										$this->response($this->json($res), 200);
									}
								}
						}else{
						$res[udata]= 0;
						$res[result]="you have not enough balance to recharge";
						$this->response($this->json($res), 200);
						}
	}	

		private function recharge_postpaid($body){
			if($this->get_request_method() != "POST"){
						$this->response('',406);
			}
			$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
				$token_id = $bodyRequest['token_id'];
				$mobile = $bodyRequest['mobile'];
				$rechargeno = $bodyRequest['rechargeno'];
				$amount = $bodyRequest['amount'];
				$operator=$bodyRequest['operator'];
				$tax =20;
				$finalAmt = $amount+$tax;
					$get_id = "select id FROM `ps_client` where token_id='$token_id' and mobile='$mobile'";
					$result_id =$this->fetchData($get_id);
					$id = $result_id[0]['id'];
				$getBalcnce ="select redeemable_star from ps_client_star where `unique_id` =$id";
					$result_bal =$this->fetchData($getBalcnce);
					$restAmt = $result_bal[0]['redeemable_star'] -$finalAmt;
				#echo "<pre>";print_r($result_bal);die;
						if($result_bal[0]['redeemable_star'] > $finalAmt){
							$uniqueorderid = substr(number_format(time() * rand(),0,'',''),0,10);
							$ch = curl_init();
							$timeout = 0; // set to zero for no timeout
							echo $myHITurl ="http://joloapi.com/api/cbill.php?mode=1&userid=PinkStar&key=563904175433643&operator=$operator&service=$rechargeno&amount=$amount&orderid=$uniqueorderid&type=text";
							curl_setopt ($ch, CURLOPT_URL, $myHITurl);
							curl_setopt ($ch, CURLOPT_HEADER, 0);
							curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
							$file_contents = curl_exec($ch);
							$curl_error = curl_errno($ch);
							curl_close($ch);
							//dump output of api if you want during test
							//echo "<pre>";print_r($file_contents);die;
							$maindata = explode(",", $file_contents);
							echo 'Count is ==>'.$countdatas = count($maindata);
							echo "<pre>";print_r($maindata);die;
								if($countdatas > 2){
								//recharge is success
								$joloapiorderid = $maindata[0]; //it is joloapi.com generated order id
								$txnstatus = $maindata[1]; //it is status of recharge SUCCESS,FAILED
								$operator= $maindata[2]; //operator code
								$service= $maindata[3]; //mobile number
								$amount= $maindata[4]; //amount
								$mywebsiteorderid= $maindata[5]; //your website order id
								$errorcode= $maindata[6]; // api error code
								$operatorid= $maindata[7]; //original operator transaction id
								$myapibalance= $maindata[8]; //my joloapi.com remaining balance
								$myapiprofit= $maindata[9]; //my earning on this recharge
								$txntime= $maindata[10]; // recharge time
							$data['user_id'] = $id;
							$data['re_orderid']=$joloapiorderid;
							$data['re_status']=$txnstatus;
							$data['re_date']=$txntime;
							$data['re_amount']=$amount;
							$data['re_operator']=$operator;
							$data['error_code']=$errorcode;
							$data['re_transactionid']=$operatorid;
							$data['re_mobile']=$service;
							echo "<pre>";print_r($data);
							if($this->insertData($data,"ps_postpaid_recharge")){
								$query ="update `ps_client_star` set redeemable_star =$restAmt where `unique_id`=$id";
									if(mysql_query($query)){
										$res[udata]= 1;
										$res[result]=$data;
										$this->response($this->json($res), 200);
									}
								 }
								}else{
								//recharge is failed
								$udata['re_status'] = $maindata[0]; //it is status of recharge FAILED
								$data['error_code']= $maindata[1]; // api error code
								$data['re_mobile']= $maindata[3]; //mobile number
								$data['re_amount']= $maindata[4];
									if($this->insertData($data,"ps_prepaid_recharge")){
										$res[udata]= 0;
										$res[result]="Faild to Recharge";
										$this->response($this->json($res), 200);
									}
								}
						}else{
						$res[udata]= 0;
						$res[result]="you have not enough balance to recharge";
						$this->response($this->json($res), 200);
						}
	}	

		private function circle_list($body){
			if($this->get_request_method() != "POST"){
						$this->response('',406);
			}
			$bodyRequest=(array) json_decode($body);
			$operator_type =$bodyRequest['operator'];
			if($operator_type == "prepaid"){
				$list_operator_code ="select prepaid_operator_id,operator_name,operator_code from ps_operator order by id";
				$result1['operator'] =$this->fetchData($list_operator_code);
				$list_area ="select operator_location,operator_code from ps_circle_code order by operator_location";
				$result2['area'] =$this->fetchData($list_area);
				$result =array_merge($result1,$result2);
				$res[udata]= 1;
				$res[result]=$result;
				$this->response($this->json($res), 200);
				#echo "<pre>";print_r($result2);die;
			}
			if($operator_type == "postpaid"){
				$list_operator_code ="select postpaid_operator_id,operator_name,operator_code from ps_operator order by id";
				$result1['operator'] =$this->fetchData($list_operator_code);
				$list_area ="select operator_location,operator_code from ps_circle_code order by operator_location";
				$result2['area'] =$this->fetchData($list_area);
				$result =array_merge($result1,$result2);
				$res[udata]= 1;
				$res[result]=$result;
				$this->response($this->json($res), 200);
				#echo "<pre>";print_r($result2);die;
			}
			if($operator_type == "datacard"){
				$list_operator_code ="select datacard_operator,operator_name,operator_code from ps_operator order by id";
				$result1['operator'] =$this->fetchData($list_operator_code);
				$list_area ="select operator_location,operator_code from ps_circle_code order by operator_location";
				$result2['area'] =$this->fetchData($list_area);
				$result =array_merge($result1,$result2);
				$res[udata]= 1;
				$res[result]=$result;
				$this->response($this->json($res), 200);
				#echo "<pre>";print_r($result2);die;
			}
			if($operator_type == "dth"){
				$list_operator_code ="select dth_operator_name,dth_operator_id,operator_code from ps_operator order by id";
				$result1['operator'] =$this->fetchData($list_operator_code);
				$list_area ="select operator_location,operator_code from ps_circle_code order by operator_location";
				$result2['area'] =$this->fetchData($list_area);
				$result =array_merge($result1,$result2);
				$res[udata]= 1;
				$res[result]=$result;
				$this->response($this->json($res), 200);
				#echo "<pre>";print_r($result2);die;
			}
		}
		
	private function recharge_list($body){
		if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
		$bodyRequest=(array) json_decode($body);
		$check=$bodyRequest['check'];
		if($check==1){
			$list_recharge ="select recharge_type,recharge_code from ps_recharge_list order by id";
			$result['list'] =$this->fetchData($list_recharge);
			$res[udata]= 1;
			$res[result]=$result;
			$this->response($this->json($res), 200);
		}else{
			$res[udata]= 0;
			$res[result]="some thing error";
			$this->response($this->json($res), 200);
		}
	}
			
			
		private function plan_list($body){
			if($this->get_request_method() != "POST"){
						$this->response('',406);
			}
			$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
				$operator=$bodyRequest['operator'];
				$circle = $bodyRequest['circle'];
				$plancode = $bodyRequest['plancode'];
					$ch = curl_init();
					$timeout = 100; // set to zero for no timeout
					$myHITurl ="https://joloapi.com/api/findplan.php?userid=PinkStar&key=563904175433643&opt=$operator&cir=$circle&typ=$plancode&type=json";
					curl_setopt ($ch, CURLOPT_URL, $myHITurl);
					curl_setopt ($ch, CURLOPT_HEADER, 0);
					curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
					$file_contents = curl_exec($ch);
					$curl_error = curl_errno($ch);
					curl_close($ch);
			$data = json_decode($file_contents, TRUE);
//dump output of api if you want during test
					$res[udata]= 1;
					$res[result]=$data;
					$this->response($this->json($res), 200);
					#echo "<pre>";print_r($res);	
		}
/* End code here */
		
// My Order List
		private function my_order($body){
		if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
		$bodyRequest=(array) json_decode($body);
		$token_id=$bodyRequest['token_id'];
		$mobile=$bodyRequest['mobile'];
		$get_id = "select id FROM `ps_client` where token_id='$token_id' and mobile='$mobile'";
		$result_id =$this->fetchData($get_id);
		$id = $result_id[0]['id'];
		if($id!="" && $id!=null){
			$list_order ="select re_orderid,re_transactionid,re_operator,re_mobile,re_amount,re_recharge_type,re_status,re_date_system from ps_prepaid_recharge where user_id=$id order by id";
			$result =$this->fetchData_recharge($list_order);
			$res[udata]= 1;
			$res[result]=$result;
			$this->response($this->json($res), 200);
		}else{
			$res[udata]= 0;
			$res[result]="some thing error";
			$this->response($this->json($res), 200);
		}
	}
// End code here
		
// Search by city
			private function search_city($body){
			if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
				$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
				$cityname = $bodyRequest['cityname'];
				$defaultext = $bodyRequest['defaultext'];
				if($cityname !="" && $defaultext!=""){
					$query_ven="SELECT ps_vendor.unique_id,ps_vendor.emp_id,ps_vendor.username,ps_vendor.company_name,ps_vendor.company_display_name,ps_vendor.featured,ps_vendor.category,ps_vendor.bill_discount,ps_latlong.longitude,ps_latlong.latitude From ps_vendor INNER JOIN ps_latlong ON ps_vendor.unique_id = ps_latlong.vendor_id INNER JOIN ps_vendor_address ON ps_vendor_address.unique_id =ps_vendor.unique_id where ps_vendor.company_name like '$defaultext%' and ps_latlong.vendor_status='1' and ps_vendor_address.city like '$cityname%'";
					$resultdata =$this->fetchData_image($query_ven);
				}else{
					$index =$bodyRequest['index'];
					$lastindex =$bodyRequest['lastindex'];
					$query_ven="SELECT ps_vendor.unique_id,ps_vendor.emp_id,ps_vendor.username,ps_vendor.company_name,ps_vendor.company_display_name,ps_vendor.featured,ps_vendor.category,ps_vendor.bill_discount,ps_latlong.longitude,ps_latlong.latitude From ps_vendor INNER JOIN ps_latlong ON ps_vendor.unique_id = ps_latlong.vendor_id INNER JOIN ps_vendor_address ON ps_vendor_address.unique_id =ps_vendor.unique_id where ps_latlong.vendor_status='1' and ps_vendor_address.city like '%$cityname' limit $index ,$lastindex";
					$resultdata =$this->fetchData_image($query_ven);
				}
						if($resultdata){
							$res[udata]= 1;
							$res[result]=$resultdata;
							$this->response($this->json($res), 200);
						}
		}
// End here
		
		
// Code here for City List
	private function city_list($body){
		if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
		$bodyRequest=(array) json_decode($body);
			$query_getCity ="select city from ps_vendor_address where type='shop' GROUP BY city";
			$city_list=$this->fetchData($query_getCity);
			$result_city =$this->getcity_list($city_list);
			if(!empty($result_city)){
			$res[udata]= 1;
			$res[result]= $result_city;
			$this->response($this->json($res), 200);
			#echo "<pre>";print_r($result_city);die;
			}else{
			$res[udata]= 0;
			$res[result]="city list not found";
			$this->response($this->json($res), 200);
		}
	}
// End Here code
		
// Search Near By : -
		private function search_nearby($body){
		if($this->get_request_method() != "POST"){
				$this->response('',406);
			}
		$bodyRequest=(array) json_decode($body);
			$latitude =$bodyRequest['latitude'];
			$longitude=$bodyRequest['longitude'];
			#echo "<pre>";print_r($bodyRequest);die;
			$strVendorid='';
			$getVendor_id="SELECT vendor_id, ( 6371 * acos( cos( radians('".$latitude."') ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians('".$longitude."') ) + sin( radians('".$latitude."') ) * sin( radians( `latitude` ) ) ) ) AS distance FROM `ps_latlong` HAVING distance <= '100' ORDER BY distance ASC";
			$vendorId=$this->fetchData($getVendor_id);
			for($i=0;$i<count($vendorId);$i++){
				$strVendorid .=$vendorId[$i]['vendor_id'].',';
			}
			$strVendoridNew = trim($strVendorid,',');
			$getlatlon="SELECT ps_vendor.unique_id,ps_vendor.emp_id,ps_vendor.username,ps_vendor.company_name,ps_vendor.company_display_name,ps_vendor.featured,ps_vendor.category,ps_vendor.bill_discount,ps_latlong.longitude,ps_latlong.latitude From ps_vendor INNER JOIN ps_latlong ON ps_vendor.unique_id = ps_latlong.vendor_id where ps_vendor.unique_id IN (".$strVendoridNew.") and ps_latlong.vendor_status='1'";
			$resultdata =$this->fetchData_image($getlatlon);
				if(!empty($resultdata)){
					$res[udata]= 1;
					$res[result]=$resultdata;
					$this->response($this->json($res), 200);
				}else{
					$res[udata]= 0;
					$res[result]='No record found';
					$this->response($this->json($res), 200);
				}
	}
// End code here
		
		
	// For image upload 
			private function image_upload($body){
		$image_name ="";
			if($this->get_request_method() != "POST"){
					$this->response('',406);
				}
			$bodyRequest=(array) json_decode($body);
			#echo "<pre>";	print_r($bodyRequest);die;
				$vendor_id = $bodyRequest['vendor_id'];
				$token_id = $bodyRequest['token_id'];
				$mobile = $bodyRequest['mobile'];
				$image_text =$bodyRequest['image_text'];
				$discount =$bodyRequest['discount'];
				$discount_type =$bodyRequest['discount_type'];
			$data = str_replace('data:image/png;base64,', '', $image_text);
			$data = str_replace(' ', '+', $data);	
			$data = base64_decode($data);
			$image_name =$mobile.rand() . '.png';
			$file = '../uploads/billupload/'.$image_name;
			$get_id ="select id from ps_client where mobile='".$mobile."' and token_id='".$token_id."'";
			$result_id =$this->fetchData($get_id);
			$id = $result_id[0]['id'];
			$data1['form_id']=$vendor_id;
			$data1['bill_url']="http://pinkstarapp.com/uploads/billupload/".$image_name;
			date_default_timezone_set('Asia/Kolkata');
			$data1['bill_upload_date']=date('Y-m-d H:i:s');
			$data1['bill_amount']=$discount;
			$data1['star_type']=$discount_type;
			$data1['client_id']=$id;
			$success = file_put_contents($file, $data);
				if($success){
						if($this->insertData($data1,"ps_client_bill")){
							$data1['image_upload']='successfully';
							$res[udata]= 1;
							$res[result]=$data1;
							$this->response($this->json($res), 200);
						}else{
							$res[udata]= 0;
							$this->response($this->json($res), 200);
						}					
				}else{
					$data1['image_upload']='error';
				}
		}
	//  End Here
		
	//Get Estore Product
	private function estore_listing($body){
	if($this->get_request_method() != "POST"){
					$this->response('',406);
		}
			$bodyRequest=(array) json_decode($body);
			//print_r($bodyRequest);die;
			$mobile = $bodyRequest['mobile'];
			$token_id = $bodyRequest['token_id'];
			$validQuery ="select mobile,token_id FROM `ps_client` where mobile='$mobile' and token_id='$token_id'";
			if($this->CheckDataExists_id($validQuery)){
				$query = mysql_query("SELECT * FROM `ps_product` WHERE `status` = '1' ORDER BY `product_id`");
				$count = mysql_num_rows($query);
				if($count > 0){
						$res['udata']= 1;
						$res['msg']= $count.' Records Found!';
						$res['total_count']= $count;
						while($row = mysql_fetch($query)){
						$res['product_list'][] = array('product_id' => $row->product_id, 'name' => $row->name, 'description' => $row->description, 'price' => $row->price, 'discount_price' => $row->discount_price, 'category_name' => $this->catName($row->category_id), 'sub_category_name'  => $this->catName($row->sub_category_id),'product_images' => $this->productImages($row->product_id));
						}
						$this->response($this->json($res), 200);
				}else{
						$res['udata']= 0;
						$res['msg']= 'N0 Records Found!';
						$res['total_count']= $count;
						$this->response($this->json($res), 200);
				}
			}else{
					$res['udata']=0;
					$res['status']='No recod found';
					$this->response($this->json($res), 200);
			}
	}
// End Here Code
	private function estore_product_details($body){
	if($this->get_request_method() != "POST"){
					$this->response('',406);
		}
			$bodyRequest=(array) json_decode($body);
			//print_r($bodyRequest);die;
			$mobile = $bodyRequest['mobile'];
			$token_id = $bodyRequest['token_id'];
			$validQuery ="select mobile,token_id FROM `ps_client` where mobile='$mobile' and token_id='$token_id'";
			if($this->CheckDataExists_id($validQuery)){
				$query = mysql_query("SELECT * FROM `ps_product` WHERE `product_id` = '".$product_id."' AND `status` = '1'");
				$count = mysql_num_rows($query);
				if($count > 0){
						$res['udata']= 1;
						$row = mysql_fetch($query);
						$res['product_detail'] = array('product_id' => $row->product_id, 'name' => $row->name, 'description' => $row->description, 'price' => $row->price, 'discount_price' => $row->discount_price, 'category_name' => $this->catName($row->category_id), 'sub_category_name'  => $this->catName($row->sub_category_id),'product_images' => $this->productImages($row->product_id));
						$this->response($this->json($res), 200);
				}else{
					$res['udata']=0;
					$this->response($this->json($res), 200);			
				}
			}else{
					$res['udata']=0;
					$this->response($this->json($res), 200);
			}
	}
// End code here
		
// Transfer Amount
		private function transferstar($body){
			if($this->get_request_method() != "POST"){
							$this->response('',406);
				}
			$bodyRequest=(array) json_decode($body);
			//print_r($bodyRequest);die;
			$mobile = $bodyRequest['mobile'];
			$token_id = $bodyRequest['token_id'];
			$stars =$bodyRequest['stars'];
			$shareNo =$bodyRequest['shareno'];
			$validQuery ="select mobile,token_id FROM `ps_client` where mobile='$mobile' and token_id='$token_id'";
			if($this->CheckDataExists_id($validQuery)){
				$get_id = "select id FROM `ps_client` where token_id='$token_id' and mobile='$mobile'";
					$result_id =$this->fetchData($get_id);
					$id = $result_id[0]['id'];
					$getStars ="select redeemable_star from ps_client_star where unique_id=$id";
					$starCount=$this->fetchData($getStars);
						if($starCount[0]['redeemable_star'] > $stars){
							$restStars=$starCount[0]['redeemable_star'] -$stars;
							$get_id = "select id FROM `ps_client` where mobile='$shareNo'";
							$result_id =$this->fetchData($get_id);
							$id_shareNo = $result_id[0]['id'];
							$getStarsshare ="select redeemable_star from ps_client_star where unique_id=$id_shareNo";
							$starCountshare=$this->fetchData($getStarsshare);
							$updateStar =$starCountshare[0]['redeemable_star']+$stars;
						$queryupdate="update ps_client_star set redeemable_star=$updateStar where unique_id=$id_shareNo";
							if(mysql_query($queryupdate)){
								$queryupdate = mysql_query("update ps_client_star set redeemable_star=$restStars where unique_id=$id");	
								$res['udata']=1;
								$res['status']='share stars update successfully';
								$this->response($this->json($res), 200);
							}else{
								$res['udata']=0;
								$res['status']='share stars not updated';
								$this->response($this->json($res), 200);
							}
						}else{
							$res['udata']=0;
							$res['status']='No enough stars to share';
							$this->response($this->json($res), 200);
						}
			}else{
					$res['udata']=0;
					$this->response($this->json($res), 200);
			}
	}
// End Code here
		
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
// Update data on id basics
		
		private function updateData_id( $data ,$id , $tablename){
			if(!empty($data)&& !empty($id) && $tablename!=""){
				$query='';$que='';
				foreach ($data as $key => $value) {
					if($key!="" && $value!=""){
						$query.="$key = '$value' ,";
					}	
				}
				$que = rtrim($query,',');
				$updateQuery ="update $tablename set $que where id ='".$id."'";
				$resultset =mysql_query($updateQuery);
				if($resultset){
					return true;
				}
			}
}
// End
		
		
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

// Fetch result data for recharge section
		private function fetchData_recharge($query){
			if($query!=""){
				//echo $query;die;
				$resultData = mysql_query($query);
					if (mysql_num_rows($resultData)>=1) {
					$data = array ();
					$i=0;
					while ( $row = mysql_fetch_assoc ($resultData) ) {
						#print_r($row);die;
						if($row['re_operator']=="AT"){
							$image_name ='airtel.jpg';
							$row1="http://pinkstarapp.com/uploads/operator-logo/".$image_name;	
						}
						if($row['re_operator']=="BS"){
							$image_name ='bsnl.jpg';
							$row1="http://pinkstarapp.com/uploads/operator-logo/".$image_name;
						}
						if($row['re_operator']=="TS"){
							$image_name ='tatasky.png';
							$row1="http://pinkstarapp.com/uploads/operator-logo/".$image_name;
						}
						if($row['re_operator']=="DT"){
							$image_name ='dishtv.png';
							$row1="http://pinkstarapp.com/uploads/operator-logo/".$image_name;
						}
						if($row['re_operator']=="" || $row['re_operator']=="(null)"){
							$row1="";
						}
						$data [] = $row;
						$data[$i]['operator_logo'] = $row1;
						$i++;
					}
						
						return $data;
				}else {
					return 0;
					}
			}
		}
	//

// Fetch images and data also...
		private function fetchData_image($query){
			if($query!=""){
				//echo $query;die;
				$resultData = mysql_query($query);
					if (mysql_num_rows($resultData)>=1) {
					$data = array ();
					$dataimage = array();
					$billdata =array();
					while ( $row = mysql_fetch_assoc ($resultData) ) {
						//echo "<pre>";print_r($row);
						$data [] = $row;
						$getImage = "select * from ps_vendor_images where vendor_id='".$row['unique_id']."'";
						$resultData1 = mysql_query($getImage);
							while ( $row1 = mysql_fetch_assoc ($resultData1) ) {
									$dataimage[]= $row1;
							}
						
						$getbill = "select sum(bill_amount) as bill from `ps_client_bill` where form_id='".$row['unique_id']."' and 
						emp_status='approved' and vendor_status='approved' and  month(`bill_upload_date`) = EXTRACT(month FROM (NOW())) AND year(`bill_upload_date`) = EXTRACT(year FROM (NOW()))";
						$result_bill =$this->fetchData($getbill);
						if(empty($resul_bill)){
							$getBillempty="select amount from `ps_vendor_commision` where unique_id='".$row['unique_id']."' and slab_min='0'";
									$resultEmpty =$this->fetchData($getBillempty);
									#print_r($result55);die;
									$get_commisionEmpty="select ps_discount,ps_vdiscount from `ps_percent_discount` where vendor_discount='".$resultEmpty[0]['amount']."'";
									$final_result =$this->fetchData($get_commisionEmpty);
									#print_r($final_result2);die;
									$billdata[]=$final_result;
									#break;
						}else{
						#echo "<pre>";print_r($result_bill);echo "<br>"; 
						$get_bill_slab="select slab_min,slab_max from `ps_vendor_commision` where unique_id='".$row['unique_id']."'";
						$result_billslab =$this->fetchData($get_bill_slab);
							#echo "<pre>";print_r($result_billslab);echo "<br>";
						$billCount =count($result_billslab);
							$j=1;
						for($i=0;$i<=$billCount;$i++){
							if(($billCount-1) > $i ){
								if($result_bill[0]['bill'] > $result_billslab[$i]['slab_min'] && $result_bill[0]['bill'] < $result_billslab[$i]['slab_max']){
									$query ="select amount from `ps_vendor_commision` where slab_max > ".$result_bill[0]['bill']." and slab_max < ".$result_billslab[$j]['slab_min']." and unique_id='".$row['unique_id']."'";
							$result66 =$this->fetchData($query);
								if($result66){
								   $get_commision ="select ps_discount,ps_vdiscount from `ps_percent_discount` where vendor_discount='".$result66[0]['amount']."'";
									$final_result =$this->fetchData($get_commision);
									#print_r($final_result);
									$billdata[]=$final_result;
								}
							}
							$j++;
							}else{
							
							//	unset($billdata);
								if(empty($final_result)){
									$get_new="select amount from `ps_vendor_commision` where id ='".$billCount."'";
									$result55 =$this->fetchData($get_new);
									#print_r($result55);die;
									$get_commision44="select ps_discount,ps_vdiscount from `ps_percent_discount` where vendor_discount='".$result55[0]['amount']."'";
									$final_result =$this->fetchData($get_commision44);
									#print_r($final_result2);die;
									$billdata[]=$final_result;
									break;
								}
							}
							
					}
				}
					$data[]['discount']=$billdata;
					$data[]['images']=$dataimage;
						unset($billdata);unset($dataimage);
				 }
					return $data;
				}else {
					return 0;
					}
			}
		}
// End Of code
		
// Fetch City list Data
	private function getcity_list($citylist){
		if(!empty($citylist)){
			$temp = array();$temp1 = array();$temp2 = array();$main=array();
			$count = count($citylist);
		for($inner=0;$inner < $count; $inner++){
				$getCity_id ="SELECT `location_id` FROM `ps_location` WHERE `location_type` = 2 AND name like '".$citylist[$inner]['city']."'";
				$temp[]=$this->fetchData($getCity_id);
				$cityCount ="select count(*) as total from `ps_vendor_address` where city like '".$citylist[$inner]['city']."' and type='shop'";
				$temp1[]= $this->fetchData($cityCount);
				$temp2[]=$citylist[$inner]['city'];
			}
			$cityName='';$cityCount='';$cityLoc='';
			if(count($temp)==count($temp1)){
				$i=0;
				for($inner=0;$inner< count($temp1);$inner++){
					$cityName.=$temp2[$inner].',';
					$cityCount.=$temp1[$inner][$i]['total'].',';
					$cityLoc.=$temp[$inner][$i]['location_id'].',';
			}
				$cityN=explode(',',$cityName);
				$cityC=explode(',',$cityCount);
				$cityL=explode(',',$cityLoc);
				$j=0;
			for($i=0;$i< count($temp);$i++){
				$main[]=array('CityName'=>($cityN[$i]),'CityCount'=>($cityC[$i]),'CityLoc'=>($cityL[$i]));
			}
			return $main;
				
		}
	}else{
			return false;
		}
		
	}
// End Code Here
		
	// Send Mail
		
		//private function send_mail($firstname,$lastname,$email,$mobile){
			private function send_mail($firstname,$lastname,$token,$email,$mobile){
			// To send HTML mail, the Content-type header must be set
			$namefrom =" Pink Star app";$emailfrom="verify@pinkstarapp.com";
				$from = $namefrom . ' <' . $emailfrom . '>';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: ' . $from . "\r\n";
    			$headers .= 'Reply-To: ' . $from . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				// Create email headers
 			// Compose a simple HTML email message
				$first_name ='<b>Your first name is </b>:- '.$firstname; 
				$last_name ='<b>Your last name is </b>:- '.$lastname; 
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
			$subject = 'Verify the email address';
			//$from = 'verify@pinkstarapp.com';
			// Sending email
			if(mail($to, $subject, $message, $headers)){
				return "1";
			}else{
				return "2";
			}
		}
	// End
		
	// Send Mail From Social Sites
		
		//private function send_mail($firstname,$lastname,$email,$mobile){
			private function send_mailfb($firstname,$lastname,$token,$password,$email,$mobile){
			// To send HTML mail, the Content-type header must be set
			$namefrom =" Pink Star app";$emailfrom="verify@pinkstarapp.com";
				$from = $namefrom . ' <' . $emailfrom . '>';
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: ' . $from . "\r\n";
    			$headers .= 'Reply-To: ' . $from . "\r\n";
				$headers .= 'X-Mailer: PHP/' . phpversion();
				// Create email headers
 			// Compose a simple HTML email message
				$first_name ='<b>Your first name is </b>:- '.$firstname; 
				$last_name ='<b>Your last name is </b>:- '.$lastname; 
				$email_temp = '<b>Your email id is </b>:- ' .$email;
				$password = '<b>Your password is </b>:- ' .$password;
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
			$subject = 'Verify the email address';
			//$from = 'verify@pinkstarapp.com';
			// Sending email
			if(mail($to, $subject, $message, $headers)){
				return "1";
			}else{
				return "2";
			}
		}
	function catName($cat_id){
		$vcl = mysql_query("SELECT * FROM `ps_categories` WHERE `status` = '1' AND `cat_id` = '".$cat_id."'");
		if(mysql_num_rows($vcl) > 0){
			$rcl = mysql_fetch_object($vcl);
			return ucfirst($rcl['category_name']);
		}else{
			return '';
		}
	}
	function productImages($product_id){
		$vcl = mysql_query("SELECT * FROM `ps_product_image` WHERE `product_id` = '".$product_id."'");
		if(mysql_num_rows($vcl) > 0){
			$image = array();
			while($rcl = mysql_fetch_object($vcl)){
			$image[] = array("image_id" => $rcl->product_image_id, "image" => $rcl->image, "image_path" => 'http://pinkstarapp.com/uploads/product/'.$rcl->image);
			}
			return $image;
		}else{
			return '';
		}
	}


		
		
	// End
		
	// Genarate Token
		private function getToken($length){
			$key = '';
    		$keys = array_merge(range(0, 9), range('a', 'z'));
				for ($i = 0; $i < $length; $i++) {
					$key .= $keys[array_rand($keys)];
				}
		return $key;
	}
}

	// Initiiate Library
	
	$api = new API;
	$api->processApi();
?>