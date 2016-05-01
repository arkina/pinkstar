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
if(!empty($_REQUEST)){
	#print_r($_REQUEST);die;
	$isCheckData = $_REQUEST['designation_name'];
			if(!empty($isCheckData)){
				if(!empty($_REQUEST['catid'])){ $catid = str_replace('pink',"",base64_decode($_REQUEST['catid']));}
				#echo '&&&&&&&&'.$catid;die;
				$resultData= $objCurd->CheckDuplicate($isCheckData,$catid,"designation_name","ps_designation");
				if($resultData){
				if($_REQUEST['catid']){ $catid = $_REQUEST['catid'];}
				$_SESSION['error']="Designation name already exists";
				header("Location: ../edit-designations.php?pid='".$_REQUEST['pid']."'&cat='".$_REQUEST['catid']."'");
					exit();
				}else{
	$temp = array();$id='';
	foreach ($_REQUEST as $key => $value){
	if(($key!=""  && $value!="")){
		if($key!= 'PHPSESSID' && $key!='acc' && $key!="catid" && $key!="pid"){
			$temp[$key] = str_replace("'","\'",$value);
		}if($key=='catid'){
			$id=str_replace('pink',"",base64_decode($value));
		}if($key =='acc'){
			if(is_array($value)){
			$temp['access']=implode(',',$value);
			}
		}
	}
  }
	$pu_result = $objCurd->updateData($temp,$id,'ps_designation');
	if($pu_result){
		$_SESSION['success']="Record successfully updated";
		header("Location: ../edit-designations.php?pid='".$_REQUEST['pid']."'&cat='".$_REQUEST['catid']."'");
		}
	}
 }
}
?>
