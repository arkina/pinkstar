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
//$objBusiness = new Business();
if(!empty($_REQUEST)){
	$temp = array();
	foreach ($_REQUEST as $key => $value){
	if(($key!=""  && $value!="")){
		if($key!= 'PHPSESSID'){
		$temp[$key] = $value;
		}
	}
  }
	//$temp['reg_by']=$_SESSION['userid'];
	$pu_result = $objCurd->insertData($temp,"ps_page");
	if($pu_result){
		header('Location: ../view-page.php');
		}
}











?>
