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
if(!empty($_REQUEST)&& $_REQUEST['name']!=""){
	$isCheckData = $_REQUEST['name'];
			if(!empty($isCheckData)){
				$resultData= $objCurd->CheckDuplicate($isCheckData,"name","ps_category");
				if($resultData){
				$_SESSION['error']="Category name already exists";
					header('Location: ../view-category-list.php');
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
	$pu_result = $objCurd->insertData($temp,"ps_category");
	if($pu_result){
		$_SESSION['success']= 'Category add sucessfully';
		header('Location: ../view-category-list.php');
		}
	}
 }
}else{
					$_SESSION['error']="Filed should not be blank";
					header('Location: ../view-category-list.php');
					exit();
}
?>
