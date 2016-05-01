<?php
include("../curd/curd.php");
include '../assets/helper/business.php';
$curdObj = new Curd();
$objBusiness = new Business();
if($_REQUEST['user']!="" && !empty($_REQUEST['user'])&& $_REQUEST['password']!="" && !empty($_REQUEST['password'])){
	
	$data = array();
	$data['username']= $_REQUEST['user'];
	$data['password']= $_REQUEST['password'];
	$is_user = 2;
	$status =$curdObj->userAuthentigation($data,"ps_user_vendor",$is_user);
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
				echo $status;
			}
			
		}else{
			echo 'Please enter valid login details';
		}
}
if($_REQUEST['id']!="" && $_REQUEST['vendor_id']!=""){
	$data = array();
	$data['primary_user']=0;
	$result = $curdObj->updateDataMultiplenew($data,$_REQUEST['vendor_id'],'ps_vendor_contact_person','vendor_id');
	if($result){
		$data['primary_user']=1;
		$result1 = $curdObj->updateDataMultiplenew($data,$_REQUEST['id'],'ps_vendor_contact_person','id');
	}
}









?>
