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
$data['name']= $_REQUEST['name'];
$id = $_REQUEST['id'];
$isCheckData = $_REQUEST['name'];
$resultData= $objCurd->CheckDuplicate($isCheckData,"name","ps_category");
				if($resultData){
					$_SESSION['error']="Category name already exists";
					header("Location: ../view-category-list.php");
					exit();
				}else{
					$listReslt = $objCurd->updateData($data,$id,'ps_category');
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header('Location: ../view-category-list.php');
					}
				}



?>
