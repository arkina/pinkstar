<?php
header('Access-Control-Allow-Origin: *');
include '../config/config.php';
include("../curd/curd.php");
$curdObj = new Curd();
$html='';
if(!empty($_REQUEST['getCountry_id']) && ($_REQUEST['checkdata']==1)){
	$getCountry ="select location_id,name from ".pl." where parent_id ='".$_REQUEST['getCountry_id']."' and is_visible!=1";
	$getCountryRes =$curdObj->runQueryList($getCountry);
	//print_r($getCountryRes);
	asort($getCountryRes);
	$html ='<select>';
	$html = '<option value="select">select country</option>';
	$i=0;
	foreach ($getCountryRes as $key => $countryname){
		//print_r($countryname);die;
		$html .='<option value='.$getCountryRes[$i]['location_id'].'>'.$getCountryRes[$i]['name'].'</option>';
		$i++;
	}
	$html .='</select>';
	echo $html;
}

if(!empty($_REQUEST['location_id'])){
	$getCountry ="select location_id,name from ".pl." where parent_id ='".$_REQUEST['location_id']."'";
	$getCountryRes =$curdObj->runQueryList($getCountry);
	//print_r($getCountryRes);
	asort($getCountryRes);
	$html ='<select>';
	$html = '<option value="select">select country</option>';
	$i=0;
	foreach ($getCountryRes as $key => $countryname){
		//print_r($countryname);die;
		$html .='<option value='.$getCountryRes[$i]['location_id'].'>'.$getCountryRes[$i]['name'].'</option>';
		$i++;
	}
	$html .='</select>';
echo $html;
}
if($_REQUEST['upadte_id']!="" && $_REQUEST['check'] ==  '1'){
	//echo $_REQUEST['check'];die;
	$data['status']=2;
	$id =$_REQUEST['upadte_id'];
	$result =$curdObj->updateData( $data ,$id ,"ps_user");
	//echo $result;
	$_SESSION['success']=$result;
	exit();
	//echo '---------->'.$_REQUEST['upadte_id'];die;
}if($_REQUEST['upadte_id']!="" && $_REQUEST['check'] ==  '2'){
	$data['status']=1;
	$id =$_REQUEST['upadte_id'];
	$result=$curdObj->updateData( $data ,$id ,"ps_user");
	$_SESSION['success']=$result;
	exit();
}


?>
