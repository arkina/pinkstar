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
if((!empty($_REQUEST))&& $_REQUEST['company_name']!="" && !empty($_REQUEST['company_name'])){
	$temp = array();
	foreach ($_REQUEST as $key => $value){
	if(($key!=""  && $value!="")){
		if($key!= 'PHPSESSID'){
		$temp[$key] = str_replace("'","\'",$value);
		}else {
		$ischeck = true;
		}
	}
  }
	if($ischeck == false){
	$temp['reg_by']=$_SESSION['userid'];
	$pu_result = $objCurd->insertData($temp,"ps_lead");
	if($pu_result){
		header('Location: ../view-lead.php');
		}
	}
}else{
	$_SESSION['error'] = "Field should not be blank";
header('Location: ../edit-lead.php');
}
if($ischeck){
$_SESSION['error'] = "Field should not be blank";
header('Location: ../edit-lead.php');
}











?>
