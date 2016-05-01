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
#$viewEmplist2 = "update ps_department set department_name = '".$_REQUEST['department_name']."' where id ='".$_REQUEST['id']."' ";
if(!empty($_REQUEST)){
$id = $_REQUEST['id'];
	/*
$isCheckData = $_REQUEST['biller'];
	if(!empty($isCheckData)){
				$resultData= $objCurd->CheckAddDuplicatesBiller($isCheckData,"biller","ps_api");
				if($resultData){
				$_SESSION['error']="Biller name already exists";
					header('Location: ../view-biller-list.php');
					exit();
				}else{
				*/
				 $temp = array();
				foreach ($_REQUEST as $key => $value){
					if(($key!=""  && $value!="")){
						if($key!= 'PHPSESSID' && $key!="id"){
						$temp[$key] = $value;
						}
					}
			  }
	//$temp['reg_by']=$_SESSION['userid'];
					#echo "<pre>";print_r($temp);die;
				$pu_result = $objCurd->updateData($temp,$id,"ps_api");
				if($pu_result){
					$_SESSION['success']="Biller details updated successfully";
					header('Location: ../view-biller-list.php');
					}
				//}
			}else{
				$_SESSION['error']="Field should not be blank";
					header('Location: ../view-biller-list.php');
					exit();
			}
//}


?>
