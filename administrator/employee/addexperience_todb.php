<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
include("../../curd/curd.php");
//include '../../assets/helper/business.php';
$objCurd = new Curd();
//$objBusiness = new Business();

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
     }//print_r($insertdata); die;
     $insert=$objCurd->insert_multipledata($insertdata,pus);     
     print_r($insert);die();   
        
    }    
    
}