<?php session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
error_reporting(E_ALL);
ini_set('display_errors',0);
include("../../curd/curd.php");
$objCurd = new Curd();
if(!empty($_REQUEST)){
$data1= $_REQUEST['name'];
$id = $_REQUEST['id'];
	if($_REQUEST['name']!="" && $_REQUEST['add-country']!="" && $_REQUEST['add-country']=="add-country"){
		$resultData= $objCurd->CheckDuplicateLocation($data1,$id,'name','ps_location',0);
		if($resultData){
					$_SESSION['error']="Country name already exists";
					header("Location: ../view-location.php");
					exit();
				}else{
					$data['name']=$_REQUEST['name'];
					$data['location_type']='0';$data['parent_id']='0';
			#print_r($data);die;
					$listReslt = $objCurd->insertData($data,"ps_location");
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header("Location: ../view-location.php");
						//exit();
					}else{
					$_SESSION['error']="Record not add successfully";
						header('Location: ../view-location.php');
						//exit();
					}
				}
	}elseif($_REQUEST['name']=="" && $_REQUEST['add-country']=="add-country"){
					$_SESSION['error']="Filed should not be blank";
					header("Location: ../view-location.php");
					exit();
	}
if($_REQUEST['name']!="" && $_REQUEST['add-states']!="" && $_REQUEST['add-states']=="add-states"){
	$pid = $_REQUEST['pid'];
	echo "<pre>"; print_r($_REQUEST);die;
		$resultData= $objCurd->CheckDuplicateLocation($data1,$id,'name','ps_location',1);
		if($resultData){
					$_SESSION['error']="State name already exists";
					header("Location: ../view-states.php?pid=$pid");
					exit();
				}else{
					$data['name']=$_REQUEST['name'];
					$data['location_type']='1';$data['parent_id']=$pid;
			#print_r($data);die;
					$listReslt = $objCurd->insertData($data,"ps_location");
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header("Location: ../view-states.php?pid=$pid");
						//exit();
					}else{
					$_SESSION['error']="Record not add successfully";
						header("Location: ../view-states.php?pid=$pid");
						//exit();
					}
				}
	}elseif($_REQUEST['name']!="" && $_REQUEST['add-states']=="add-states"){
					$_SESSION['error']="Field should not be blank";
					header("Location: ../view-states.php?pid=$pid");
					exit();
}
	if($_REQUEST['name']!="" && $_REQUEST['add-city']!="" && $_REQUEST['add-city']=="add-city"){
	$pid = $_REQUEST['pid'];$nid =$_REQUEST['nid']; 
		#echo "<pre>"; print_r($_REQUEST);die; 
		$resultData= $objCurd->CheckDuplicateLocation($data1,$id,'name','ps_location',2);
		if($resultData){
				$_SESSION['error']="City name already exists";
					header("Location: ../view-cities.php?pid=$pid&nid=$nid");
					exit();
				}else{
					$data['name']=$_REQUEST['name'];
					$data['location_type']='2';$data['parent_id']=$pid;
			#print_r($data);die;
					$listReslt = $objCurd->insertData($data,"ps_location");
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header("Location: ../view-cities.php?pid=$pid");
						//exit();
					}else{
					$_SESSION['error']="Record not add successfully";
						header("Location: ../view-cities.php?pid=$pid");
						//exit();
					}
				}
	}else{
	$_SESSION['error']="Field should not be blank";
	header("Location: ../view-cities.php?pid=$pid&nid=$nid");
	exit();
	}
}
?>