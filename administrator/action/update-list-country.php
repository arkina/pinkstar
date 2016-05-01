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
if(!empty($_REQUEST)){
$data1= $_REQUEST['name'];
$id = $_REQUEST['id'];
$data['name']=$_REQUEST['name'];
	if($_REQUEST['name']!="" && $_REQUEST['country-list']!="" && $_REQUEST['country-list']=="country-list"){
		$resultData= $objCurd->CheckDuplicateLocation($data1,$id,'name','ps_location',0);
		if($resultData){
					$_SESSION['error']="Country name already exists";
					header("Location: ../view-location.php");
					exit();
				}else{
					$listReslt = $objCurd->updateDataLocation($data,$id,'ps_location','0');
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header("Location: ../view-location.php");
						//exit();
					}else{
					$_SESSION['error']="Record not update successfully";
						header('Location: ../view-location.php');
						//exit();
					}
				}
	}
if($_REQUEST['name']!="" && $_REQUEST['states-list']!="" && $_REQUEST['states-list']=="states-list" && $_REQUEST['pid']!=""){
	$pid =$_REQUEST['pid'];
		$resultData= $objCurd->CheckDuplicateLocation($data1,$id,'name','ps_location',1);
		if($resultData){
					$_SESSION['error']="State name already exists";
					header("Location: ../view-states.php?pid=$pid");
					exit();
				}else{
					$listReslt = $objCurd->updateDataLocation($data,$id,'ps_location','1');
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header("Location: ../view-states.php?pid=$pid");
						exit();
					}else{
					$_SESSION['error']="Record not update successfully";
						header("Location: ../view-states.php?pid=$pid");
						exit();
					}
				}
	}

if($_REQUEST['name']!="" && $_REQUEST['city-list']!="" && $_REQUEST['city-list']=="city-list" && $_REQUEST['pid']!=""){
			$pid =$_REQUEST['pid'];
		$resultData= $objCurd->CheckDuplicateLocation($data1,$id,'name','ps_location',2);
		if($resultData){
					$_SESSION['error']="City name already exists";
					header("Location: ../view-cities.php?pid=$pid");
					exit();
				}else{
					$listReslt = $objCurd->updateDataLocation($data,$id,'ps_location','2');
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header("Location: ../view-cities.php?pid=$pid");
						exit();
					}else{
					$_SESSION['error']="Record not update successfully";
						header("Location: ../view-cities.php?pid=$pid");
						exit();
					}
				}
	}


}
?>