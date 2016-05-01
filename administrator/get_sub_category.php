<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
//include("../config/config.php");
include("../curd/curd.php");
$ObjCurd = new Curd();
$cat_id = $_REQUEST['cat_id'];
$allData = $ObjCurd->runQueryList("SELECT * FROM `ps_categories` WHERE `parent_id` = '$cat_id'");
echo '<option value="">Select Sub Category</option>';
foreach($allData as $value){
echo '<option value="'.$value['cat_id'].'">'.$value['category_name'].'</option>';
}
?>










