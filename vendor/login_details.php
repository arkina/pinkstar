<?php
include("../curd/curd.php");
$curdObj = new Curd();
if($_REQUEST['user']!="" && !empty($_REQUEST['user'])&& $_REQUEST['password']!="" && !empty($_REQUEST['password'])){
	
	$data = array();
	$data['username']= $_REQUEST['user'];
	$data['password']= $_REQUEST['password'];
	$is_check =$_REQUEST['checkAttr'];
	//$tablename ="ps_user";
	$status =$curdObj->userAuthentigation($data,"ps_user");
		if($status){
			//print_r($status);die;
			echo $status;
		}else{
			echo 'Please enter valid login details';
		}
}









?>
