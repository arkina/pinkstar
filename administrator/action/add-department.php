<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../../curd/curd.php");
$objCurd = new Curd();
//$objBusiness = new Business();
#print_r($_REQUEST);die;
if(!empty($_REQUEST)){
		$isCheckData = $_REQUEST['department_name'];
			if(!empty($isCheckData)){
				$resultData= $objCurd->CheckDuplicate($isCheckData,"department_name","ps_department");
				if($resultData){
				$_SESSION['error']="Department name already exists";
					header('Location: ../view-department.php');
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
	//$temp['reg_by']=$_SESSION['userid'];
				$pu_result = $objCurd->insertData($temp,"ps_department");
				if($pu_result){
					$_SESSION['success']="Department name successfully added";
					header('Location: ../view-department.php');
					}
				}
			}else{
				$_SESSION['error']="Field should not be blank";
					header('Location: ../view-department.php');
					exit();
			}
}











?>
