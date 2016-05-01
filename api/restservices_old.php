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
		$name =explode('@',$_REQUEST['name']);
		$password =md5($_REQUEST['password']);
		$regtype =$_REQUEST['regtype'];
		$headers = array('Content-Type:application/json');
		//$payloadName="{\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\"}";
 		$payloadName="{\"stdcode\": \"$mobile[0]\",\"mobile\": \"$mobile[1]\",\"token_id\": \"$token\",\"email\": \"$email\",\"first_name\": \"$name[0]\",\"last_name\": \"$name[1]\",\"password\": \"$password\",\"register_by\": \"$regtype\"}";
	}
	
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
