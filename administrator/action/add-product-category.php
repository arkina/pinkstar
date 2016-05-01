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
//$objBusiness = new Business();
if(!empty($_REQUEST)&& $_REQUEST['category_name']!=""){
	$isCheckData = $_REQUEST['category_name'];
	$UploadDirectory ="../../uploads/category/";
	
	if(!empty($isCheckData)){
	if(!empty($_FILES) && !empty($_FILES['cat_image']['type']) || $_FILES['cat_image']['type']!=""){
		switch (strtolower($_FILES['cat_image']['type'])) {
			//allowed file types
			case 'image/png':
			case 'image/gif':
			case 'image/jpeg':
			case 'image/pjpeg':
			case 'text/plain':
			case 'text/html': //html file
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
				break;
			default:
				die('Unsupported File!'); //output error
		}
		$File_Name = strtolower($_FILES['cat_image']['name']);
		$File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		$Random_Number = rand(0, 9999999999); //Random number to be added to name.
		$NewFileName = $Random_Number . $File_Ext; //new file name
		if (move_uploaded_file($_FILES['cat_image']['tmp_name'], $UploadDirectory . $NewFileName)) {
			//die('Success! File Uploaded.');
			$temp['category_image']="";
			$temp['category_image']=$NewFileName;
		} else {
			die('error uploading File!');
			}
		} 
	if($_REQUEST['cat_id']!=''){
		extract($_REQUEST);
		if($NewFileName!=''){
		$img = array("category_image" => $NewFileName);
		}
		$temp = array_merge(array("category_name" => $category_name,"parent_id" => $parent_id,"status" => $status,"updated_date" => date("Y-m-d")),$img);

		$listReslt = $objCurd->updateDataMultiple($temp,$cat_id,'ps_categories','cat_id');
		if($listReslt){
			$_SESSION['success']="Record successfully updated";
			header('Location: ../view-product-category-list.php');
		}
	}else{
		$resultData = $objCurd->CheckAddDuplicatesBiller($isCheckData,"category_name","ps_categories");
		if($resultData){
					$_SESSION['error']="Category name already exists";
						header('Location: ../view-product-category-list.php');
						exit();
		}else{
		extract($_REQUEST);

		$temp = array("category_name" => $category_name,"parent_id" => $parent_id,"category_image" => $NewFileName, "status" => $status,"added_date" => date("Y-m-d") );
		$pu_result = $objCurd->insertData($temp,"ps_categories");
		if($pu_result){
			$_SESSION['success']= 'Category add sucessfully';
			header('Location: ../view-product-category-list.php');
			}
		}
	}	
		
 }
}else{
		$_SESSION['error']="Filed should not be blank";
		header('Location: ../view-product-category-list.php');
		exit();
}
?>
