<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../curd/curd.php");
include '../assets/helper/business.php';
$curdObj = new Curd();
$objBusiness = new Business();
if($_REQUEST['user']!="" && !empty($_REQUEST['user'])&& $_REQUEST['password']!="" && !empty($_REQUEST['password'])){
	
	$data = array();
	$data['username']= $_REQUEST['user'];
	$data['password']= $_REQUEST['password'];
	$is_user = 1;
	//$tablename ="ps_user";
	$status =$curdObj->userAuthentigation($data,"ps_user" , $is_user);
		if($status){
		$user_ip =$_SERVER['REMOTE_ADDR'];
			$user_log =$objBusiness->getBrowser();
			$userlog =array();
			$userlog['user_id']=$_SESSION['userid'];
			$userlog['browser_name']=$user_log['name'];
			$userlog['browser_version']=$user_log['version'];
			$userlog['browser_platform']=$user_log['platform'];
			$userlog['user_ip']=$user_ip;
			$userlog['is_login']=1;
			$userlog['login_status']='login';
			$puv_result = $curdObj->insertData($userlog,pul);
			if($puv_result){
				echo $status;
			}
			
		}else{
			echo 'Please enter valid login details';
		}
}









?>
