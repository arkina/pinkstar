<?php
if(!empty($_REQUEST['rquest'])||$_REQUEST['rquest']!=""){
	if($_REQUEST['rquest'] == 'validateNum'){
		$host="http://pinkstarapp.com/api/api.php?rquest=validateNum";
		$mobile =explode('-',$_REQUEST['mobile']);
		$resend =$_REQUEST['resend'];
		#echo "<pre>";print_r($mobile);die;
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"stdcode\": $mobile[0],\"mobile\": $mobile[1],\"resend\": $resend}";
		}
	if($_REQUEST['rquest'] == 'optVerified'){
		$host="http://pinkstarapp.com/api/api.php?rquest=optVerified";
		$mobile =explode('-',$_REQUEST['mobile']);
		//$mobile =$_REQUEST['mobile'];
		$token =$_REQUEST['token_id'];
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\"}";
	}
	if($_REQUEST['rquest'] == 'registration_fb'){
		$host="http://pinkstarapp.com/api/api.php?rquest=registration_fb";
		$mobile =$_REQUEST['mobile'];
		#$token =$_REQUEST['token_id'];
		$registredBy = 'facebook';
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"mobile\": \"$mobile\",\"registred_by\": \"$registredBy\"}";
	}
	if($_REQUEST['rquest'] =='registrationUp'){
		#print_r($_REQUEST);die;
		$host="http://pinkstarapp.com/api/api.php?rquest=registrationUp";
		$mobile =explode('-',$_REQUEST['mobile']);
		$token =$_REQUEST['token_id'];
		$email =$_REQUEST['email'];
		//$name =explode('@',$_REQUEST['name']);
		$str_name =$_REQUEST['name'];	
		$getArr = explode(" ",$str_name);
		$lastVal =end($getArr);
		$firstVal =str_replace($lastVal," ",$str_name);
		$password =md5($_REQUEST['password']);
		$regtype =$_REQUEST['regtype'];
		$headers = array('Content-Type:application/json');
		//$payloadName="{\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\"}";
 		$payloadName="{\"stdcode\": \"$mobile[0]\",\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\",\"email\": \"$email\",\"first_name\": \"$firstVal\",\"last_name\": \"$lastVal\",\"password\": \"$password\",\"register_by\": \"$regtype\"}";
	}
	if($_REQUEST['rquest'] == 'email_signup'){
		$host="http://pinkstarapp.com/api/api.php?rquest=email_signup";
		$email =$_REQUEST['email'];
		$password =$_REQUEST['password'];
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"email\": \"$email\",\"password\": \"$password\"}";
	}
	if($_REQUEST['rquest'] == 'forget_password'){
		$host="http://pinkstarapp.com/api/api.php?rquest=forget_password";
		$email =$_REQUEST['email'];
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"email\": \"$email\"}";
	}
	if($_REQUEST['rquest'] == 'change_password'){
		$host="http://pinkstarapp.com/api/api.php?rquest=change_password";
		$email =$_REQUEST['email'];
		$oldPassword =$_REQUEST['oldpwd'];
		$newPassword =$_REQUEST['newpwd'];
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"email\": \"$email\",\"oldpwd\": \"$oldPassword\",\"newpwd\": \"$newPassword\"}";
	}
	if($_REQUEST['rquest'] == 'reffered_by'){
		$host="http://pinkstarapp.com/api/api.php?rquest=reffered_by";
		$token_id =$_REQUEST['token_id'];
		//$reffered_by =explode('-',$_REQUEST['reffered_by']);
		//$mobile =explode('-',$_REQUEST['mobile']);
		$mobile =$_REQUEST['mobile'];
		$reffered_by=$_REQUEST['reffered_by'];
		$headers = array('Content-Type:application/json');
 		//$payloadName="{\"token_id\": \"$token_id\",\"reffered_by\": \"$reffered_by\",\"mobile\": \"$mobile\",\"stdcode_reffered\": \"$reffered_by[0]\",\"stdcode\": \"$mobile[0]\"}";
		$payloadName="{\"token_id\": \"$token_id\",\"reffered_by\": \"$reffered_by\",\"mobile\": \"$mobile\"}";
	}
	// Get user & it's login details
		if($_REQUEST['rquest'] == 'user_login'){
			$host="http://pinkstarapp.com/api/api.php?rquest=user_login";
			$userName =$_REQUEST['username'];
			$userPassword = $_REQUEST['password'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"username\": \"$userName\",\"userpassword\": \"$userPassword\"}";
	}
	if($_REQUEST['rquest'] == 'latlong_register'){
		#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=latlong_register";
			$token_id = $_REQUEST['token_id'];
			$form_id = $_REQUEST['form_id'];
			$latitude = $_REQUEST['latitude'];
			$longitude = $_REQUEST['longitude'];
			$city = $_REQUEST['city'];
			$state = $_REQUEST['state'];
			$country = $_REQUEST['country'];
			$pincode = $_REQUEST['pincode'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"form_id\": \"$form_id\",\"latitude\": \"$latitude\",\"longitude\": \"$longitude\",\"city\": \"$city\",\"state\": \"$state\",\"country\": \"$country\",\"pincode\": \"$pincode\"}";
	}
	
	if($_REQUEST['rquest'] == 'verify_email'){
		#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=verify_email";
			$token_id = $_REQUEST['t'];
			$emailencode = $_REQUEST['emailencode'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"emailencode\": \"$emailencode\"}";
	}
	
	// End of code
// Offer API CODE: -
		if($_REQUEST['rquest'] == 'get_offer'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=get_offer";
			$headers = array('Content-Type:application/json');
		}	

// END
	
// get Profile Details: -
		if($_REQUEST['rquest'] == 'get_profile_details'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=get_profile_details";
			$token_id = $_REQUEST['token_id'];
			//$mobile = $_REQUEST['mobile'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\"}";
		}	

// END

// Upadet Profile Details: --
		if($_REQUEST['rquest'] == 'update_profile_details'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=update_profile_details";
			$mobile =explode('-',$_REQUEST['mobile']);
			$alt_mobile =explode('-',$_REQUEST['alt_mobile']);
			$token =$_REQUEST['token_id'];
			$first_name = $_REQUEST['first_name'];
			$last_name = $_REQUEST['last_name'];
			$dob = $_REQUEST['dob'];
			$email = $_REQUEST['email'];
			$image_name =$_REQUEST['image_name'];
			$headers = array('Content-Type:application/json');
		//$payloadName="{\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\"}";
 		$payloadName="{\"mobile\": \"$mobile[1]\",\"alt_mobile\": \"$alt_mobile[1]\",\"token_id\": \"$token\",\"email\": \"$email\",\"first_name\": \"$first_name\",\"last_name\": \"$last_name\",\"dob\": \"$dob\",\"image_name\": \"$image_name\"}";
	}
// End
	
// Coupon details:-
	if($_REQUEST['rquest'] == 'get_redeem'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=get_redeem";
			$token_id = $_REQUEST['token_id'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$coupon_code = $_REQUEST['redeemcode'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\",\"coupon\": \"$coupon_code\"}";
		}	
// End
	
	
$process = curl_init($host);
curl_setopt($process, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($process, CURLOPT_POSTFIELDS, $payloadName);
curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
curl_setopt($process, CURLOPT_HTTPHEADER,$headers);
curl_setopt($process, CURLOPT_TIMEOUT, 40);
$response=curl_exec($process);
if(!$response){
	die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}else{
	echo $response;
}
curl_close($process);
}else {
}

?>
