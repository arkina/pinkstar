<?php
include("./curd/curd.php");
include './assets/helper/business.php';
include'./config/config.php';
$curdObj = new Curd();
$objBusiness = new Business();
if(isset($_SESSION['username'])){
	if(isset($_SESSION['login_as'])=="1"){
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
			header('Location:administrator');
			exit();
		}
		
	}else{
		$user_ip =$_SERVER['REMOTE_ADDR'];
		$user_log =$objBusiness->getBrowser();
		$userlog =array();
		$userlog['user_id']=$_SESSION['userid'];
		$userlog['browser_name']=$user_log['name'];
		$userlog['browser_version']=$user_log['version'];
		$userlog['browser_platform']=$user_log['platform'];
		$userlog['user_ip']=$user_ip;
		$userlog['is_login']=2;
		$userlog['login_status']='logout';
		$puv_result = $curdObj->insertData($userlog,plv);
		if($puv_result){
			unset($_SESSION['username']);
			unset($_SESSION['login_as']);
			unset($_SESSION['userid']);
			header('Location:vendor');
			exit();
	}
 }

}
?>
