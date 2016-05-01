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
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/select2.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/inputmask.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/autosize.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/inputlimit.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/listbox.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/multiselect.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/tags.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/switch.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/validate.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/charts/sparkline.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/uploader/plupload.full.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/uploader/plupload.queue.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/wysihtml5/wysihtml5.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/forms/wysihtml5/toolbar.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/moment.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/mousewheel.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/jgrowl.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/colorpicker.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/plugins/interface/collapsible.min.js"></script>
<script type="text/javascript" src="<?php echo URL;?>assets/js/application.js"></script>
	<?php
		$iWantThisURL = substr($_SERVER['REQUEST_URI'], 0, stripos($_SERVER['REQUEST_URI'], '?'));
			if(empty($iWantThisURL)){ 	$iWantThisURL =$_SERVER['REQUEST_URI'];}
	if($iWantThisURL =="/administrator/edit-lead.php"){ ?>
	<script type="text/javascript" src="<?php echo URL;?>js/lead-registration.js"></script>
		<?php }else{ ?>
	<script type="text/javascript" src="<?php echo URL;?>js/login.js"></script>
	<script type="text/javascript" src="<?php echo URL;?>js/registration.js"></script>
	
<?php   } ?>
</head>
<body class="full-width">
<!-- Navbar -->
<div class="navbar navbar-inverse" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-icons"><span class="sr-only">Toggle right icons</span><i class="icon-grid"></i></button>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"><span class="sr-only">Toggle menu</span><i class="icon-paragraph-justify2"></i></button>
    <a class="navbar-brand" href="javascript:void(0);">Administrator</a></div>