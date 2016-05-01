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
		$isCheckData = $_REQUEST['biller'];
			if(!empty($isCheckData)){
				$resultData= $objCurd->CheckAddDuplicatesBiller($isCheckData,"biller","ps_api");
				if($resultData){
				$_SESSION['error']="Biller name already exists";
					header('Location: ../view-biller-list.php');
					exit();
				}else{
				 $temp = array();
				foreach ($_REQUEST as $key => $value){
					if(($key!=""  && $value!="")){
						if($key!= 'PHPSESSID'){
						$temp[$key] = $value;
						}
					}
			  }
	//$temp['reg_by']=$_SESSION['userid'];
					#echo "<pre>";print_r($temp);die;
				$pu_result = $objCurd->insertData($temp,"ps_api");
				if($pu_result){
					$_SESSION['success']="Biller name successfully added";
					header('Location: ../view-biller-list.php');
					}
				}
			}else{
				$_SESSION['error']="Field should not be blank";
					header('Location: ../view-biller-list.php');
					exit();
			}
}











?>
