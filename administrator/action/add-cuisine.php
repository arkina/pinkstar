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
#echo "<pre>";print_r($_REQUEST);die;
if(!empty($_REQUEST) && $_REQUEST['name']!=""){
	$isCheckData = $_REQUEST['name'];
			if(!empty($isCheckData)){
				$resultData= $objCurd->CheckDuplicate($isCheckData,"name","ps_cousines");
				if($resultData){
				$_SESSION['error']="Cuisine name already exists";
					header('Location: ../view-cuisine.php');
					exit();
				}else{
	$temp = array();
	foreach ($_REQUEST as $key => $value){
	if(($key!=""  && $value!="")){
		if($key!= 'PHPSESSID'){
		$temp[$key] = $value;
		}
	}
  }
	//$temp['reg_by']=$_SESSION['userid'];
	$pu_result = $objCurd->insertData($temp,"ps_cousines");
	if($pu_result){
		$_SESSION['success']= 'Cuisine add sucessfully';
		header('Location: ../view-cuisine.php');
		}
	}
 }
}else{
					$_SESSION['error']="Field should not be blank";
					header('Location: ../view-cuisine.php');
					exit();
}
?>
