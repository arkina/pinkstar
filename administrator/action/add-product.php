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
if(!empty($_REQUEST)){
	$isCheckData = $_REQUEST['category_name'];
	$UploadDirectory ="../../uploads/product/";
	/*echo '<pre>';
	print_r($_FILES['product_images']);
	exit();*/
	//$product_images = $_FILES['product_images'];
	$product_id = $_REQUEST['product_id'];
	if($_REQUEST['product_id']!=''){
		extract($_REQUEST);
		$temp = array('name' => $product_name, 'description' => $product_description, 'price' => $price, 'discount_price' => $discount_price, 'category_id' => $cat_id, 'sub_category_id' => $sub_cat_id,"product_quantity" => $product_quantity, "status" => $status,"updated_date" => date("Y-m-d"));
		$listReslt = $objCurd->updateDataMultiple($temp,$product_id,'ps_product','product_id');
		if($listReslt){
			$_SESSION['success']="Record successfully updated";
		}
	}else{
		extract($_REQUEST);
		$temp = array('name' => $product_name, 'description' => $product_description, 'price' => $price, 'discount_price' => $discount_price, 'category_id' => $cat_id, 'sub_category_id' => $sub_cat_id,"product_quantity" => $product_quantity, "status" => $status,"added_date" => date("Y-m-d") );
		$pu_result = $objCurd->insertData($temp,"ps_product");
		$product_id = $objCurd->lastInsertID();
		if($pu_result){
			$_SESSION['success']= 'Product add sucessfully';
			
			}
		
	}	

	if($_FILES['product_images']['name'][0]!=""){
		$product_images = $_FILES['product_images'];
		foreach($product_images['name'] as $key => $sinImg){
			switch (strtolower($product_images['type'][$key])) {
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
			$File_Name = strtolower($sinImg);
			$File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
			$Random_Number = rand(0, 9999999999); //Random number to be added to name.
			$NewFileName = $Random_Number . $File_Ext; //new file name
			if (move_uploaded_file($product_images['tmp_name'][$key], $UploadDirectory . $NewFileName)) {
				//die('Success! File Uploaded.');
				$dta = array('product_id' => $product_id, 'image' => $NewFileName);
				$pu_result_img = $objCurd->insertData($dta,"ps_product_image");
				
			} else {
				die('error uploading File!');
				}
			}	
			
		} 	
	//echo $product_id;	
 header('Location: ../add-product.php?product_id='.base64_encode($product_id));
 //echo '<script>window.location="../add-product.php?product_id='.base64_encode($product_id).'"</script>';
}else{
		$_SESSION['error']="Filed should not be blank";
		header('Location: ../add-product.php');
		exit();
}
?>
