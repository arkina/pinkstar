<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("../curd/curd.php");
include '../assets/helper/business.php';
$curdObj = new Curd();
$objBusiness = new Business();
if(isset($_SESSION['username'])&&($_SESSION['login_as'])=="2"){
		$user_ip =$_SERVER['REMOTE_ADDR'];
		$user_log =$objBusiness->getBrowser();
		$userlog =array();
		$userlog['vendor_id']=$_SESSION['userid'];
		$userlog['browser_name']=$user_log['name'];
		$userlog['browser_version']=$user_log['version'];
		$userlog['browser_platform']=$user_log['platform'];
		$userlog['user_ip']=$user_ip;
		$userlog['is_login']=2;
		$userlog['login_status']='logout';
		$puv_result = $curdObj->insertData($userlog,pvl);
		if($puv_result){
			unset($_SESSION['username']);
			unset($_SESSION['login_as']);
			unset($_SESSION['userid']);
			header('Location:index.php');
			exit();
	}
 }
?>
