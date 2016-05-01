<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("../../curd/curd.php");
$objCurd = new Curd();
$ischeck = false;
//$objBusiness = new Business();
#echo "<pre>"; print_r($_REQUEST);die;
if((!empty($_REQUEST))&& $_REQUEST['region_name']!="" && !empty($_REQUEST['region_name'])){
	$isCheckData = str_replace("'","\'",$_REQUEST['region_name']);
	if(!empty($isCheckData)){
		$resultData= $objCurd->CheckAddDuplicates($isCheckData,"region_name","ps_region");
			if($resultData){
				$_SESSION['error']="Region name already exists";
					header('Location: ../view-region.php');
					exit();
			}else{
			$temp = array();
	foreach ($_REQUEST as $key => $value){
	if(($key!=""  && $value!="")){
		if($key!= 'PHPSESSID'){
		$temp[$key] = str_replace("'","\'",$value);
		}
	}
  }
	$pu_result = $objCurd->insertData($temp,"ps_region");
	if($pu_result){
		$_SESSION['success'] = "Region add successfully.";
		header('Location: ../view-region.php');
		exit();
	}
			}
	}
}else{
	$_SESSION['error'] = "Field should not be blank";
header('Location: ../view-region.php');
}
?>
