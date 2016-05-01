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

	  if($_REQUEST['stepno']==1){
		  $UploadDirectory ="../../uploads/vendor/";
		  $id=base64_decode($_REQUEST['unique_id']);
		  #echo "<pre>";print_r($_REQUEST);
		   $temp = array();
				foreach ($_REQUEST as $key => $value){
					if(($key!=""  && $value!="")){
						if($key!= 'PHPSESSID' && $key!="unique_id" && $key!="stepno"){
							$temp[$key] = $value;
						}
					}
			  }
		  #file upload
		  	if(!empty($_FILES) && !empty($_FILES['image_name']['type']) || $_FILES['image_name']['type']!=""){
		switch (strtolower($_FILES['image_name']['type'])) {
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
		$File_Name = strtolower($_FILES['image_name']['name']);
		$File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		$Random_Number = rand(0, 9999999999); //Random number to be added to name.
		$NewFileName = $Random_Number . $File_Ext; //new file name
		if (move_uploaded_file($_FILES['image_name']['tmp_name'], $UploadDirectory . $NewFileName)) {
			//die('Success! File Uploaded.');
			//$account_array['userimage_path']="";
			$temp['image_name']=$NewFileName;
		} else {
			die('error uploading File!');
			}
		} 
		  
		  # End 
		  
		 #echo "<pre>";print_r($temp);echo "<br>"."--".$id; die;
		  $pu_result = $objCurd->updateDataMultiple($temp,$id,"ps_vendor","unique_id");
				if($pu_result){
					$_SESSION['success']="Vendor details updated successfully";
					header("Location: ../edit-vendor-contact.php?formid=".$_REQUEST['unique_id']."");
				}
	  	}
		if($_REQUEST['stepno']==2){
			#echo "<pre>";echo "2";print_r($_REQUEST);die;
			if($_REQUEST['first_name']!="" && $_REQUEST['alternate_mobile']!=""){
			$temp = array();
				foreach ($_REQUEST as $key => $value){
					if(($key!=""  && $value!="")){
						if($key!= 'PHPSESSID' && $key!="stepno"){
							if($key=="vendor_id"){
								$value= base64_decode($value);
							}
							$temp[$key] = $value;
						}
					}
			  }
			#print_r($temp);die;
			$result_contact = $objCurd->insertData($temp,"ps_vendor_contact_person");
			if($result_contact){
				$_SESSION['success']="Contact details inserted successfully";
				header("Location: ../edit-vendor-commision.php?formid=".$_REQUEST['vendor_id']."");
				}
			}else{
				$_SESSION['success']="Field should not be blank";
				header("Location: ../edit-vendor-contact.php?formid=".$_REQUEST['vendor_id']."");
			}
	  }
		if($_REQUEST['stepno']==3){
			#echo "<pre>";echo "3";print_r($_REQUEST);
			if($_REQUEST['slab_min']!="" && $_REQUEST['type']!=""){
				$temp = array();
				foreach ($_REQUEST as $key => $value){
					if(($key!=""  && $value!="")){
						if($key!= 'PHPSESSID' && $key!="stepno"){
							if($key=="unique_id"){
								$value= base64_decode($value);
							}
							$temp[$key] = $value;
						}
					}
			  }
			#print_r($temp);die;
			$result_contact = $objCurd->insertData($temp,"ps_vendor_commision");
			if($result_contact){
				$_SESSION['success']="Record inserted successfully";
				header("Location: ../edit-vendor-commision.php?formid=".$_REQUEST['unique_id']."");
			}
	  }else{
				$_SESSION['success']="Field should not be blank";
				header("Location: ../edit-vendor-commision.php?formid=".$_REQUEST['unique_id']."");
			}
	}
}
?>