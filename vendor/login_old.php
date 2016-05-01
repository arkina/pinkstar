<?php error_reporting(E_ALL);
ini_set('display_errors', 0);
include '../config/config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Administrator | Pink Star</title>
<link href="<?php echo URL;?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL;?>assets/css/londinium-theme.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL;?>assets/css/styles.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo URL;?>assets/css/icons.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/login.js"></script>
<script type="text/javascript" src="<?php echo URL;?>js/registration.js"></script>
</head>
    <!-- END HEAD -->
    <body class="full-width page-condensed">
<!-- Navbar -->
<div class="navbar navbar-inverse" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-right"><span class="sr-only">Toggle navbar</span><i class="icon-grid3"></i></button>
    <a class="navbar-brand" href="#"><img src="<?php echo URL;?>assets/images/logo.png" alt="Londinium"></a></div>
  
</div>
<!-- /navbar -->
<!-- Login wrapper -->
<div class="login-wrapper">
    <div class="popup-header"><a href="#" class="pull-left"><i class="icon-user-plus"></i></a><span class="text-semibold">User Login</span>
      <div class="btn-group pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i></a>
        <ul class="dropdown-menu icons-right dropdown-menu-right">
          <li><a href="#"><i class="icon-people"></i> Change user</a></li>
          <li><a href="#"><i class="icon-info"></i> Forgot password?</a></li>
          <li><a href="#"><i class="icon-support"></i> Contact admin</a></li>
          <li><a href="#"><i class="icon-wrench"></i> Settings</a></li>
        </ul>
      </div>
    </div>
    <div class="well">
    <span class="error" style="color:red"></span>
      <div class="form-group has-feedback">
        <label>Username</label>
        <input type="text" id="login-username" name="username" class="form-control" placeholder="Username" value="<?php (isset($_POST['username']) ? $_POST['username'] : " ");?>">
        <i class="icon-users form-control-feedback"></i></div>
      <div class="form-group has-feedback">
        <label>Password</label>
        <input type="password" id="login-password" name="userpassword" value="<?php (isset($_POST['userpassword']) ? $_POST['userpassword'] : " ");?>" class="form-control" placeholder="Password">
        <i class="icon-lock form-control-feedback"></i></div>
      <div class="row form-actions">
        <div class="col-xs-6">
          <div class="checkbox checkbox-success">
            <label>
              <input type="checkbox" class="styled">
              Remember me</label>
          </div>
        </div>
        <div class="col-xs-6">
          <button type="button" id="vendorLogin" class="btn btn-warning pull-right"><i class="icon-menu2"></i> Sign in</button>
        </div>
      </div>
    </div>
    <input type="hidden" class="checkAttr" value="isvendor"/>
</div>
<!-- /login wrapper -->
<!-- Footer -->
<?php include('include/footer-inc.php');?>
