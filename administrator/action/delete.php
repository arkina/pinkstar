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


switch($page)
{
	case '1' : 
				$viewEmplist = "delete from ps_page where id = '".$rid."'";
				$listReslt = $ObjCurd->runQueryList($viewEmplist);
				$_SESSION['success']="Successfully deleted";
				return true;
				break;
}












?>
