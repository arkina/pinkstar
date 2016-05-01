<?php
include("../../curd/curd.php");
include '../../assets/helper/business.php';
$objCurd = new Curd();
$objBusiness = new Business();
$temp =array();
if(!empty($_REQUEST)){
	foreach ($_REQUEST as $key => $value){
		if(($key!=""  && $value!="")){
			$temp[$key] = $value;
		}
		
	}
	$temp['vendor_id']=uniqid().$objCurd->random_id_gen(5);
	$user_id =$temp['vendor_id'];
	
	if(!empty($temp)){
		$user_ip =$ip=$_SERVER['REMOTE_ADDR'];
		$user_log =$objBusiness->getBrowser();
		$userlog =array();
		$userlog['user_id']=$user_id;
		$userlog['browser_name']=$user_log['name'];
		$userlog['browser_version']=$user_log['version'];
		$userlog['browser_platform']=$user_log['platform'];
		$userlog['user_ip']=$user_ip;
		$userlog['is_login']=2;
		
		echo "<pre>";
		print_r($temp);
		echo "<br>";
		print_r($user_log);die;
		
		$pu_result = $objCurd->insertData($temp,pvd);
		$pu_result_log = $objCurd->insertData($userlog,pvl);
		if($pu_result_log){
			//echo "details registred succefully";die();
			header('Location: view-vendor.php');
		}else{}
	}
}