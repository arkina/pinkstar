<?php
include("../../curd/curd.php");
include '../../assets/helper/business.php';
$curdObj = new Curd();
$objBusiness = new Business();
#echo "<pre>";print_r($_REQUEST);die;
if($_REQUEST['username']!="" && !empty($_REQUEST['username'])&& $_REQUEST['userpassword']!="" && !empty($_REQUEST['userpassword'])){
	$data = array();
	$data['username']= $_REQUEST['username'];
	$data['password']= md5($_REQUEST['userpassword']);
	$is_user = 2;
	$status =$curdObj->userAuthentigation($data,"ps_vendor",$is_user);
		if($status){
			$user_ip =$_SERVER['REMOTE_ADDR'];
		$user_log =$objBusiness->getBrowser();
		$userlog =array();
		$userlog['vendor_id']=$_SESSION['userid'];
		$userlog['browser_name']=$user_log['name'];
		$userlog['browser_version']=$user_log['version'];
		$userlog['browser_platform']=$user_log['platform'];
		$userlog['user_ip']=$user_ip;
		$userlog['is_login']=2;
		$userlog['login_status']='login';
		$puv_result = $curdObj->insertData($userlog,pvl);
			if($puv_result){
				$_SESSION['success']='Successfully login';
				$_SESSION['login_as']=2;
				//header("Location:../view-user-profile.php");
				header("Location:../index.php");
				exit();
			}
			
		}else{
			echo 'Please enter valid login details';
		}
}









?>
