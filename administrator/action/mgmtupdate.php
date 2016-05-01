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
$UploadDirectory ="../../uploads/usermgmt/";
$temp = array();
if(!empty($_FILES) && $_FILES['image_name']['name']!="" && $_FILES['image_name']['type']!=""){
		switch (strtolower($_FILES['image_name']['type'])) {
			//allowed file types
			case 'image/png':
			case 'image/gif':
			case 'image/jpeg':
			case 'image/pjpeg':
				break;
			default:
				die('Unsupported File!'); //output error
		}
		
		$File_Name = strtolower($_FILES['image_name']['name']);
		$File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		$Random_Number = rand(0, 9999999999); //Random number to be added to name.
		$NewFileName = $Random_Number . $File_Ext; //new file name
		if (move_uploaded_file($_FILES['image_name']['tmp_name'], $UploadDirectory . $NewFileName)) {
			//die('Success! File Uploaded.');
			$temp['image_path']="";
			$temp['image_name']=$NewFileName;
		} else {
			#$_SESSION['error']="error uploading File!";
			die('error uploading File!');
			}
		}
	if(!empty($_REQUEST)){
		$id= $_REQUEST['update_id'];
	foreach ($_REQUEST as $key => $value){
		if(($key!=""  && $value!="")){
			if($key!= 'PHPSESSID' && $key!="update_id"){
			$temp[$key] = $value;
			}
		}else{
			$_SESSION['error']="Field should not be blank";
					header("Location: ../view-user-profile.php?pid=$id");
					exit();
		}
  	}
		$listReslt = $objCurd->updateData($temp,$id,'ps_client');
					if($listReslt){
						$_SESSION['success']="Record successfully updated";
						header("Location: ../view-user-profile.php?pid=$id");
						exit();
					}
	}





?>