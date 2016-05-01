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
	$html = '<option value="select">select city</option>';
	$i=0;
	foreach ($getCountryRes as $key => $countryname){
		//print_r($countryname);die;
		$html .='<option value='.$getCountryRes[$i]['location_id'].'>'.$getCountryRes[$i]['name'].'</option>';
		$i++;
	}
	$html .='</select>';
	echo $html;
}

if(!empty($_REQUEST['getDepart_id']) && ($_REQUEST['checkdata']==1)){
	$getDepart ="select id,designation_name from ps_designation where depart_id ='".$_REQUEST['getDepart_id']."' order by id ASC";
	$getDepartRes =$curdObj->runQueryList($getDepart);
	$html ='<select>';
	$html = '<option value="select">select designation</option>';
	$i=0;
	foreach ($getDepartRes as $key => $departname){
		//print_r($countryname);die;
		$html .='<option value='.$getDepartRes[$i]['id'].'>'.$getDepartRes[$i]['designation_name'].'</option>';
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
	$html = '<option value="select">select state</option>';
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

if($_REQUEST['pageName']!="" && $_REQUEST['pageId']!=""  && $_REQUEST['checkdata'] ==  '4' && $_REQUEST['pageUrl']!="" && $_REQUEST['tab']!=""){
	if($_REQUEST['pageName']=="activePage"){
		$data['status']=2;
		$id =$_REQUEST['pageId'];
		//$tableName = 'ps_cousines';
		$tableName = $_REQUEST['tab'];
		#echo "===".$data['status'].'***'.$tableName;die;
		$result=$curdObj->updateData( $data ,$id ,$tableName);
	}if($_REQUEST['pageName']=="inactivePage"){
		$data['status']=1;
		$id =$_REQUEST['pageId'];
		$tableName = $_REQUEST['tab'];
		//$tableName = 'ps_cousines';
		#echo "===".$data['status'].'***'.$tableName;die;
		$result=$curdObj->updateData( $data ,$id ,$tableName);
	}
	$_SESSION['success']=$result;
	exit();
}


if($_REQUEST['pageName']!="" && $_REQUEST['pageId']!=""  && $_REQUEST['checkdata'] ==  '5' && $_REQUEST['pageUrl']!="" && $_REQUEST['tab']!=""){
	if($_REQUEST['pageName']=="activePage"){
		$data['status']=1;
		$id =$_REQUEST['pageId'];
		$tableName = $_REQUEST['tab'];
		$result=$curdObj->updateData( $data ,$id ,$tableName);
	}if($_REQUEST['pageName']=="inactivePage"){
		$data['status']=2;
		$id =$_REQUEST['pageId'];
		$tableName = $_REQUEST['tab'];
		$result=$curdObj->updateData( $data ,$id ,$tableName);
	}if($_REQUEST['pageName']=="deletePage"){
		#echo "delete page";die;
		$id =$_REQUEST['pageId'];
		$tableName = $_REQUEST['tab'];
		#echo "===".$id.'***'.$tableName;die;
		$result=$curdObj->deleteData($id ,$tableName);
	}
	$_SESSION['success']=$result;
	exit();
}

if($_REQUEST['pageName']!="" && $_REQUEST['pageId']!=""  && $_REQUEST['checkdata'] ==  '3'){
	if($_REQUEST['pageName']=="delPage"){
		$data['page_status']=2;
		$id =$_REQUEST['pageId'];
		$result=$curdObj->updateData( $data ,$id ,"ps_page");
	}if($_REQUEST['pageName']=="activePage"){
		$data['page_status']=1;
		$id =$_REQUEST['pageId'];
		$result=$curdObj->updateData( $data ,$id ,"ps_page");
	}
	$_SESSION['success']=$result;
	exit();
}
if($_REQUEST['pageName']!="" && $_REQUEST['pageId']!="" && $_REQUEST['pageUrl']!="" && $_REQUEST['tab']!=""){
	#echo "<pre>"; print_r($_REQUEST);die;
	if($_REQUEST['pageName']=="deletePage"){
		$data['status']=2;
		$id =$_REQUEST['pageId'];
		$tableName = $_REQUEST['tab'];
		#echo "===".$data['status'].'***'.$tableName;die;
		$result=$curdObj->deleteRecord( $data ,$id ,$tableName);
	}
	$_SESSION['success']=$result;
	exit();
}
?>
