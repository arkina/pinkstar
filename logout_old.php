<?php
session_start();
if(isset($_SESSION['username'])){
unset($_SESSION['username']); // will delete just the name data
session_destroy();
header('Location:administrator/index.php');
}
?>