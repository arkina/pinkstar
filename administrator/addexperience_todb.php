<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../curd/curd.php");
include('../config/config.php');
$objCurd = new Curd();
if(!empty($_POST['param']) && isset($_POST['param'])){
    if(!empty($_POST['data']) && isset($_POST['data']) && $_POST['param']==1){
     $insertdata[0]=  array();$i=0;
     foreach ($_POST['data'] as $key=>$value){
         //print_r($value); die;
         if(!empty($value['value']) && isset($value['value'])){
             //$insert.=$value['name'].'='.$value['value'];
             if(array_key_exists($value['name'],$insertdata[0])){
                 $insertdata[$i][$value['name']]=$value['value'];
             }else{
                 $insertdata[0][$value['name']]=$value['value'];
                 $i++;
             }
         }
     }
		
     $insert=$objCurd->insert_multipledata($insertdata,pue);     
     print_r($insert);die();   
        
    }    
    
}