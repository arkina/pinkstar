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
#$viewEmplist2 = "update ps_department set department_name = '".$_REQUEST['department_name']."' where id ='".$_REQUEST['id']."' ";
$data['department_name']=str_replace("'","\'",$_REQUEST['department_name']);
$id = $_REQUEST['id'];
$listReslt = $objCurd->updateData($data,$id,'ps_department');
if($listReslt){
	$_SESSION['success']="Record successfully updated";
	header('Location: ../view-department.php');
}

?>
