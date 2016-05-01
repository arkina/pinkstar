<?php
header('Access-Control-Allow-Origin: *');
include '../config/config.php';
include("../curd/curd.php");
$curdObj = new Curd();

if($_REQUEST['pageName']!="" && $_REQUEST['pageId']!=""){
	#echo "<pre>";print_r($_REQUEST);die;
	if($_REQUEST['pageName']=="locDel"){
		$query ="select location_id,name FROM `ps_location` WHERE `parent_id` ='".$_REQUEST['pageId']."'";
		$result=$curdObj->CheckDataExists_id($query);
		if($result){
			$msg = "Please delete States then Country will be deleted";
			echo $msg;
			exit();
		}else{
			$query ="delete FROM `ps_location` WHERE `location_id` ='".$_REQUEST['pageId']."' and location_type=0";
			$resultset = $this->mysqli->query($query);
			if($resultset->num_rows > 0){
				$msg = "Country deleted successfully";
				echo $msg;
				exit();
			}
		}
	}if($_REQUEST['pageName']=="stateDel"){
		$query ="select location_id,name FROM `ps_location` WHERE `parent_id` ='".$_REQUEST['pageId']."'";
		$result=$curdObj->CheckDataExists_id($query);
		if($result){
			$msg = "Please delete City then States will be deleted";
			echo $msg;
			exit();
		}else{
			$query ="delete FROM `ps_location` WHERE `location_id` ='".$_REQUEST['pageId']."' and location_type=1";
			$resultset = $curdObj->runQuery($query);
			if($resultset){
				$msg = "State deleted successfully";
				echo $msg;
				exit();
			}
		}
	}
	if($_REQUEST['pageName']=="cityDel"){
	$query ="delete FROM `ps_location` WHERE `location_id` ='".$_REQUEST['pageId']."' and location_type=2";
		$resultset = $curdObj->runQuery($query);
			if($resultset){
				$msg = "City deleted successfully";
				echo $msg;
				exit();
			}
	}
	
	
}
?>
