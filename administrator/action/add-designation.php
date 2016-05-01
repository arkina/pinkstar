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
	$isCheckData = $_REQUEST['designation_name'];
			if(!empty($isCheckData)){
				#echo "------".$_REQUEST['catid'];die;
				if(!empty($_REQUEST['catid'])){ $catid = str_replace('pink',"",base64_decode($catid));}
				$resultData= $objCurd->CheckAddDuplicate($isCheckData,$catid,"designation_name","ps_designation");
				if($resultData){
				if($_REQUEST['catid']){ $catid = $_REQUEST['catid'];}
				$_SESSION['error']="Designation name already exists";
				header("Location: ../edit-designation.php?cat=$catid");
					exit();
				}else{
	$temp = array();
	foreach ($_REQUEST as $key => $value){
	if(($key!=""  && $value!="")){
		if($key!= 'PHPSESSID' && $key!='acc' && $key!="catid"){
			$temp[$key] = str_replace("'","\'",$value);
		}if($key=='catid'){
			$temp['depart_id']=str_replace('pink',"",base64_decode($value));
		}if($key =='acc'){
			if(is_array($value)){
			$temp['access']=implode(',',$value);
			}
		}
	}
  }
	//echo "<pre>"; print_r($temp);die;
	//$temp['reg_by']=$_SESSION['userid'];
	$pu_result = $objCurd->insertData($temp,"ps_designation");
	if($pu_result){
		$cat_id =$_REQUEST['catid'];
		$_SESSION['success']="Designation add successfully";
		header("Location: ../view-designation.php?cat=$cat_id");
		}
	}
 }
}
?>
