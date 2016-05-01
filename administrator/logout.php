<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../curd/curd.php");
include '../assets/helper/business.php';
$curdObj = new Curd();
$objBusiness = new Business();
if(isset($_SESSION['username'])&&($_SESSION['login_as'])=="1"){
		$user_ip =$_SERVER['REMOTE_ADDR'];
		$user_log =$objBusiness->getBrowser();
		$userlog =array();
		$userlog['user_id']=$_SESSION['userid'];
		$userlog['browser_name']=$user_log['name'];
		$userlog['browser_version']=$user_log['version'];
		$userlog['browser_platform']=$user_log['platform'];
		$userlog['user_ip']=$user_ip;
		$userlog['is_login']=1;
		$userlog['login_status']='logout';
		$puv_result = $curdObj->insertData($userlog,pul);
		if($puv_result){
			unset($_SESSION['username']);
			unset($_SESSION['login_as']);
			unset($_SESSION['userid']);
			unset($_SESSION['userimg']);
			header('Location:login.php');
			exit();
		}

}if(isset($_SESSION['username'])&&($_SESSION['login_as'])!="1"){
		$user_ip =$_SERVER['REMOTE_ADDR'];
		$user_log =$objBusiness->getBrowser();
		$userlog =array();
		$userlog['user_id']=$_SESSION['userid'];
		$userlog['browser_name']=$user_log['name'];
		$userlog['browser_version']=$user_log['version'];
		$userlog['browser_platform']=$user_log['platform'];
		$userlog['user_ip']=$user_ip;
		$userlog['is_login']=1;
		$userlog['login_status']='logout';
		$puv_result = $curdObj->insertData($userlog,pul);
		if($puv_result){
			unset($_SESSION['username']);
			unset($_SESSION['login_as']);
			unset($_SESSION['userid']);
			unset($_SESSION['userimg']);
			header('Location:login.php');
			exit();
		}

}
?>
