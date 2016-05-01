<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include("../../curd/curd.php");
include '../../assets/helper/business.php';
$objCurd = new Curd();
$objBusiness = new Business();
if(!empty($_REQUEST)){
$temp_login =array("fname","lname","email","username","userpassword","depart","doj",'post_position','date_exist');
$temp_personal =array('dob','marital_status','address-one','address-two','alterno_per','mobileno_per','alterno_res','mobileno_res','city','state','pincode');
$temp_referral =array('referral_name','referral_last','referral_name1','referral_last1','referral_email','referral_email1','referral_mobile1','referral_mobile');
$temp_account =array('pancard','adharno','bankname','accountno','bankaddress','ifsccode');
$temp_emergncy =array('person_emename','person_emerelation','person_emenumber');
$login_array = array();$personal_array = array();$referal_array = array();$account_array = array();$emergncy_array = array();
$user_id="";
$UploadDirectory ="../../uploads/employee/";

foreach ($_REQUEST as $key => $value){
	if(($key!=""  && $value!="")){
		if(in_array($key,$temp_login)){
			$login_array[$key]=$value;
			$id=uniqid().$objCurd->random_id_gen(5);
			$login_array['user_id']=$id;
			$user_id = $id;
                        $_SESSION['user_id']=$user_id;
		}if (in_array($key,$temp_personal)){
			$personal_array[$key]=$value;
			$personal_array['user_id']= $user_id;
		}if(in_array($key,$temp_referral)){
			$referal_array[$key]=$value;
			$referal_array['user_id']= $user_id;
		}if(in_array($key,$temp_account)){
			$account_array[$key]=$value;
			$account_array['user_id']= $user_id;
		}if(in_array($key,$temp_emergncy)){
			$emergncy_array[$key]=$value;
			$emergncy_array['user_id']= $user_id;
		}
	}/*if(!empty($_REQUEST['email'])){
			$emailVal = $objCurd->error_msg("email",$_REQUEST['email']);
					if($emailVal!= 1){
				return  $error['email']=$emailVal;
					}
	}
	*/
}
$user_ip =$ip=$_SERVER['REMOTE_ADDR'];
$user_log =$objBusiness->getBrowser();
$userlog =array();
$userlog['user_id']=$user_id;
$userlog['browser_name']=$user_log['name'];
$userlog['browser_version']=$user_log['version'];
$userlog['browser_platform']=$user_log['platform'];
$userlog['user_ip']=$user_ip;
$userlog['is_login']=1;

//print_r($personal_array) ; echo "<br>"; print_r($referal_array); echo "<br>"; print_r($account_array); echo "<br>";print_r($emergncy_array);
//die;
if(!empty($login_array)){
	$pu_result = $objCurd->insertData($login_array,pu);
}
if(!empty($personal_array)){
	$pu_result = $objCurd->insertData($personal_array,pud);
}
if(!empty($referal_array)){
	$pu_result = $objCurd->insertData($referal_array,pur);
}
if(!empty($emergncy_array)){
	$pu_result = $objCurd->insertData($emergncy_array,puec);
}
if(!empty($account_array)){
	if(!empty($_FILES)){
		switch (strtolower($_FILES['userimage_name']['type'])) {
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
		
		$File_Name = strtolower($_FILES['userimage_name']['name']);
		$File_Ext = substr($File_Name, strrpos($File_Name, '.')); //get file extention
		$Random_Number = rand(0, 9999999999); //Random number to be added to name.
		$NewFileName = $Random_Number . $File_Ext; //new file name
		if (move_uploaded_file($_FILES['userimage_name']['tmp_name'], $UploadDirectory . $NewFileName)) {
			//die('Success! File Uploaded.');
			$account_array['userimage_path']="";
			$account_array['userimage_name']=$NewFileName;
		} else {
			die('error uploading File!');
			}
		} 
	}
	$pu_result_account = $objCurd->insertData($account_array,puad);
	if(!empty($userlog)){
		$pu_result = $objCurd->insertData($userlog,pul);
	}
		if($pu_result_account){
			//echo "details registred succefully";die();
			header('Location: edit-employee-experience.php');
		}else{}
}
//header("Location : view-employee.php");
?>