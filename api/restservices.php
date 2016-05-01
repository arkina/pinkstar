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
		if(count($getArr) > 1){
			$lastVal =end($getArr);
			$firstVal =str_replace($lastVal," ",$str_name);
		}else{
			$firstVal=$getArr[0];
		}
		$password =md5($_REQUEST['password']);
		$regtype =$_REQUEST['regtype'];
		$headers = array('Content-Type:application/json');
		//$payloadName="{\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\"}";
 		$payloadName="{\"stdcode\": \"$mobile[0]\",\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\",\"email\": \"$email\",\"first_name\": \"$firstVal\",\"last_name\": \"$lastVal\",\"password\": \"$password\",\"register_by\": \"$regtype\"}";
	}
	
	if($_REQUEST['rquest'] =='registrationsocialsites'){
		#print_r($_REQUEST);die;
		$host="http://pinkstarapp.com/api/api.php?rquest=registrationsocialsites";
		$mobile =explode('-',$_REQUEST['mobile']);
		$email =$_REQUEST['email'];
		//$name =explode('@',$_REQUEST['name']);
		$str_name =$_REQUEST['name'];	
		$getArr = explode(" ",$str_name);
		$lastVal =end($getArr);
		$firstVal =str_replace($lastVal," ",$str_name);
		$regtype =$_REQUEST['regtype'];
		$headers = array('Content-Type:application/json');
		//$payloadName="{\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\"}";
 		$payloadName="{\"stdcode\": \"$mobile[0]\",\"mobile\": \"$mobile[1]\",\"email\": \"$email\",\"first_name\": \"$firstVal\",\"last_name\": \"$lastVal\",\"register_by\": \"$regtype\"}";
	}
	
	if($_REQUEST['rquest'] == 'email_signup'){
		$host="http://pinkstarapp.com/api/api.php?rquest=email_signup";
		//$email =$_REQUEST['email'];
		$mobile =explode('-',$_REQUEST['mobile']);
		$password =$_REQUEST['password'];
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"mobile\": \"$mobile[1]\",\"password\": \"$password\"}";
	}
	if($_REQUEST['rquest'] == 'forget_password'){
		$host="http://pinkstarapp.com/api/api.php?rquest=forget_password";
		//$email =$_REQUEST['email'];
		$mobile =explode('-',$_REQUEST['mobile']);
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"mobile\": \"$mobile[1]\"}";
	}
	if($_REQUEST['rquest'] == 'change_password'){
		$host="http://pinkstarapp.com/api/api.php?rquest=change_password";
		$token_id =$_REQUEST['token_id'];
		$mobile =explode('-',$_REQUEST['mobile']);
		$oldPassword =$_REQUEST['oldpwd'];
		$newPassword =$_REQUEST['newpwd'];
		$headers = array('Content-Type:application/json');
 		$payloadName="{\"email\": \"$email\",\"oldpwd\": \"$oldPassword\",\"newpwd\": \"$newPassword\",\"mobile\": \"$mobile[1]\"}";
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
			$email = $_REQUEST['email'];
			$dob = $_REQUEST['dob'];
			$gender =$_REQUEST['gender'];
			$anniversary =$_REQUEST['anniversary'];
			$image_text=$_REQUEST['image_text'];
			$headers = array('Content-Type:application/json');
		//$payloadName="{\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\"}";
 		$payloadName="{\"mobile\": \"$mobile[1]\",\"alt_mobile\": \"$alt_mobile[1]\",\"token_id\": \"$token\",\"email\": \"$email\",\"first_name\": \"$first_name\",\"last_name\": \"$last_name\",\"dob\": \"$dob\",\"image_text\": \"$image_text\",\"gender\": \"$gender\",\"anniversary\":\"$anniversary\"}";
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

// For vendor List : --
	if($_REQUEST['rquest'] == 'vendor_list'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=vendor_list";
			$token_id = $_REQUEST['token_id'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$latitude = explode('.',$_REQUEST['latitude']);
			$longitude = explode('.',$_REQUEST['longitude']);
			$latitude1 = $_REQUEST['latitude'];
			$longitude1 =$_REQUEST['longitude'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\",\"latitude\": \"$latitude[0]\",\"longitude\": \"$longitude[0]\",\"longitude1\": \"$longitude1\",\"latitude1\": \"$latitude1\"}";
		}
// End

// For Vendor Details
	  if($_REQUEST['rquest'] == 'vendor_details'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=vendor_details";
		  	$vendor_id =$_REQUEST['vendor_id'];
			$token_id = $_REQUEST['token_id'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$headers = array('Content-Type:application/json');
			$payloadName="{\"vendor_id\": \"$vendor_id\",\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\"}";
		}
// End
	
	
// For image upload
	if($_REQUEST['rquest'] == 'image_upload'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=image_upload";
		  	$vendor_id =$_REQUEST['vendor_id'];
			$token_id = $_REQUEST['token_id'];
			$mobile =explode('-',$_REQUEST['number']);
			$image_text=$_REQUEST['image_text'];
			$discount=$_REQUEST['discount'];
			$discount_type=$_REQUEST['discount_type'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"vendor_id\": \"$vendor_id\",\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\",\"image_text\": \"$image_text\",\"discount\": \"$discount\",\"discount_type\": \"$discount_type\"}";
		}
// End Here
// For user log out
	if($_REQUEST['rquest'] == 'user_logout'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=user_logout";
			$token_id = $_REQUEST['token_id'];
			//$mobile = $_REQUEST['mobile'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\"}";
		}	
// End
	
// City List
		if($_REQUEST['rquest'] == 'city_list'){
			#echo "<pre>";print_r($_REQUEST);die;exit();
			$host="http://pinkstarapp.com/api/api.php?rquest=city_list";
			$city_id = 1;
			//$mobile = $_REQUEST['mobile'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$headers = array('Content-Type:application/json');
			$payloadName="{\"city_id\": \"$city_id\"}";
		}	
// End Here

// Recharge Code : --
	if($_REQUEST['rquest'] == 'operator_list'){
		$host="http://pinkstarapp.com/api/api.php?rquest=operator_list";
		$headers = array('Content-Type:application/json');
		$operator_list =1;
		$payloadName="{\"operator_list\": \"$operator_list\"}";
	}
	
	
	if($_REQUEST['rquest'] == 'recharge_prepaid'){
		$host="http://pinkstarapp.com/api/api.php?rquest=recharge_prepaid";
			$token_id = $_REQUEST['token_id'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$rechargeno =explode('-',$_REQUEST['rechargeno']);
			$amount=$_REQUEST['amount'];
			$operator=$_REQUEST['operator'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\",\"rechargeno\": \"$rechargeno[1]\",\"amount\": \"$amount\",\"operator\": \"$operator\"}";
	}
	
	if($_REQUEST['rquest'] == 'recharge_postpaid'){
		$host="http://pinkstarapp.com/api/api.php?rquest=recharge_postpaid";
			$token_id = $_REQUEST['token_id'];
			$mobile =explode('-',$_REQUEST['mobile']);
			$rechargeno =explode('-',$_REQUEST['rechargeno']);
			$amount=$_REQUEST['amount'];
			$operator=$_REQUEST['operator'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\",\"rechargeno\": \"$rechargeno[1]\",\"amount\": \"$amount\",\"operator\": \"$operator\"}";
	}
	
	if($_REQUEST['rquest'] == 'circle_list'){
		$host="http://pinkstarapp.com/api/api.php?rquest=circle_list";
			$operator=$_REQUEST['operator'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"operator\": \"$operator\"}";
	}
	
	if($_REQUEST['rquest'] == 'recharge_list'){
		$host="http://pinkstarapp.com/api/api.php?rquest=recharge_list";
			$check=$_REQUEST['check'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"check\": \"$check\"}";
	}
	
	if($_REQUEST['rquest'] == 'plan_list'){
		$host="http://pinkstarapp.com/api/api.php?rquest=plan_list";
			$operator=$_REQUEST['operator'];
			$circle = $_REQUEST['circle'];
			$plancode = $_REQUEST['plancode'];
			$headers = array('Content-Type:application/json');
			$payloadName="{\"operator\": \"$operator\",\"circle\": \"$circle\",\"plancode\": \"$plancode\"}";
	}
	
	if($_REQUEST['rquest'] == 'my_order'){
		$host="http://pinkstarapp.com/api/api.php?rquest=my_order";
		$token_id = $_REQUEST['token_id'];
		$mobile =explode('-',$_REQUEST['mobile']);
		$headers = array('Content-Type:application/json');
		$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\"}";
	}
	
	if($_REQUEST['rquest'] == 'search_city'){
		$host="http://pinkstarapp.com/api/api.php?rquest=search_city";
		$cityname = $_REQUEST['cityname'];
		$defaultext =$_REQUEST['defaultext'];
		$index =$_REQUEST['index'];
		$lastindex =$_REQUEST['lastindex'];
		$headers = array('Content-Type:application/json');
		$payloadName="{\"cityname\": \"$cityname\",\"defaultext\": \"$defaultext\",\"index\": \"$index\",\"lastindex\": \"$lastindex\"}";
	}
	
	if($_REQUEST['rquest'] == 'search_nearby'){
		$host="http://pinkstarapp.com/api/api.php?rquest=search_nearby";
		$longitude = $_REQUEST['longitude'];
		$latitude = $_REQUEST['latitude'];
		$headers = array('Content-Type:application/json');
		$payloadName="{\"longitude\": \"$longitude\",\"latitude\": \"$latitude\"}";
	}
	

	if($_REQUEST['rquest'] == 'transferstar'){
		$host="http://pinkstarapp.com/api/api.php?rquest=transferstar";
		$token_id = $_REQUEST['token_id'];
		$mobile =explode('-',$_REQUEST['mobile']);
		$shareno =explode('-',$_REQUEST['shareno']);
		$stars = $_REQUEST['stars'];
		$headers = array('Content-Type:application/json');
		$payloadName="{\"token_id\": \"$token_id\",\"stars\": \"$stars\",\"mobile\": \"$mobile[1]\",\"shareno\": \"$shareno[1]\"}";
	}

	if($_REQUEST['rquest'] == 'estore_listing'){
			$host="http://pinkstarapp.com/api/api.php?rquest=estore_listing";
			$token_id = $_REQUEST['token_id'];
			$mobile = explode('-',$_REQUEST['mobile']);
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\"}";
	}
	if($_REQUEST['rquest'] == 'estore_product_details'){
			$host="http://pinkstarapp.com/api/api.php?rquest=estore_product_details";
			$token_id = $_REQUEST['token_id'];
			$product_id = $_REQUEST['product_id'];
			$mobile = explode('-',$_REQUEST['mobile']);
			$headers = array('Content-Type:application/json');
			$payloadName="{\"token_id\": \"$token_id\",\"mobile\": \"$mobile[1]\",\"product_id\": \"$product_id\"}";
	}
//  End Code	
	
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
