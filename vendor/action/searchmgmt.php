<?php 
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
#echo "<pre>";
#print_r($_FILES);die;
error_reporting(E_ALL);
ini_set('display_errors', 0);
include("../../curd/curd.php");
$objCurd = new Curd();
if(!empty($_REQUEST['pid'])){ $pid = base64_encode($_REQUEST['pid']);}
if($_REQUEST['search_content']!="" && !empty($_REQUEST['search_content'])){
	$searchData = strtolower($_REQUEST['search_content']);
	if(filter_var($searchData, FILTER_VALIDATE_EMAIL)) {
      $searchQuery = "select id from ".pclient." where email='$searchData'";
    }else {
		 $searchQuery = "select id from ".pclient." where first_name='$searchData'";
    }
	$result = $objCurd->runQueryList($searchQuery); 
	if(!empty($result)){
		$id = base64_encode($result[0]['id']);
		header("Location:../view-user-profile.php?pid=$id");
		exit();
	}else {
		$_SESSION['error']="No Record Found";
		header("Location:../view-user-profile.php");
		exit();
	}
	
}else{
	$_SESSION['error'] ="Search filed should not be blank";
	header("Location:../view-user-profile.php?pid=$pid");
	exit();
}










?>
