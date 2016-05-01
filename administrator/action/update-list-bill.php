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
$id = $_REQUEST['id'];
	if($_REQUEST['emp_status'] == 'reject'){
			//echo "rejected";die;
		$data=array();
		foreach($_REQUEST as $key => $value){
					if($key!="PHPSESSID" && $key!="id" && $key!="discount_amount" && $key!="discount_type"){
						$data[$key] = $value;
					}
		}
		$resultData= $objCurd->updateData($data,$id,'ps_client_bill');
		$_SESSION['error']="data successfully updated";
		header("Location: ../view-pending-bill.php");
		exit();
		#print_r($data);die;
		}if($_REQUEST['emp_status'] == 'approved'){
			$data1=array();
		foreach($_REQUEST as $key => $value){
					if($key!="PHPSESSID" && $key!="id" && $key!="discount_amount" && $key!="discount_type"){
						$data1[$key] = $value;
					}
	   }
		if($_REQUEST['discount_amount']!="" && $_REQUEST['discount_type']!="" && $_REQUEST['bill_amount']){
			$discount =$_REQUEST['discount_amount'];
			$distype=$_REQUEST['discount_type'];
			$billAmount =$_REQUEST['bill_amount'];
			if($_REQUEST['discount_type'] == "precentage"){
				$actualAmount = ($discount*$billAmount)/100;
				$query ="select redeemable_star from ps_client_star where unique_id='".$id."'";
				$getResultVal = $objCurd->runQueryList($query);
				$AddStars = $getResultVal[0]['redeemable_star'];
				$updatedStra =$actualAmount+$AddStars;
				//$data2['redeemable_star']=$updatedStra;
			$getStarquery ="update ps_client_star set redeemable_star='".$updatedStra."' where unique_id='".$id."'";
				$resultData= $objCurd->runQuery($getStarquery);
			}
		}
		$resultData= $objCurd->updateData($data,$id,'ps_client_bill');
		
		$_SESSION['error']="data successfully updated";
		header("Location: ../view-pending-bill.php");
		exit();
		#print_r($data1);die;
   }
}
?>