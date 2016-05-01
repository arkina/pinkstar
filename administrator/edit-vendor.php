<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
//include("../config/config.php");
include("../curd/curd.php");
include('./include/head-inc.php');
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
if($_SESSION['login_as'] == '1'){
$viewEmplist = "select company_name,company_display_name,registration_type,image_name,category from ps_vendor where unique_id='".base64_decode($_REQUEST['formid'])."'";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
$getCategory ="select name from ps_category where status=1";
$categoryReslt = $ObjCurd->runQueryList($getCategory);
	#echo "<pre>";print_r($listReslt);die;
}else{
	echo "******";die;
	$viewEmplist = "select * from ps_api";
	$listReslt3 = $ObjCurd->runQueryList($viewEmplist);
}
?>
    <style>
    .dt-buttons{
        display: none;
    }
    </style>    
        <!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <!-- BEGIN PAGE CONTENT BODY -->
        <div class="page-content" style="min-height:500Px">
            <!-- Page header -->
            <div class="page-header">
              <div class="page-title">
                <h3>New Vendor<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="vendor-management.php">Vendor Management</a></li>
                    <li><a href="view-pending-vendor.php">New Vendor List</a></li>
                    <li class="active">New Vendor Registration</li>
                </ul>
            </div>
           
            <!-- END PAGE BREADCRUMBS -->
			<!-- Alert -->
<div id="hide">
    <?php if(isset($_SESSION['error']) && $_SESSION['error']!=''){?>
    <div class="alert alert-danger fade in block-inner">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="icon-cancel-circle"></i> <?php echo $_SESSION['error'];?>
    </div>
    <?php }?>
    <?php if(isset($_SESSION['success']) && $_SESSION['success']!=''){?>
    <div class="alert alert-success fade in block-inner">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <i class="icon-checkmark-circle"></i> <?php echo $_SESSION['success']; ?>
    </div>
    <?php }?>
</div>
<!-- /alerts -->
<script>
    setTimeout(function() {
    $('#hide').fadeOut();
    }, 5000 );
</script>
<?php 
$_SESSION['error']='';
$_SESSION['success']='';
?>
<!-- /alert -->
			<?php //echo "<pre>"; print_r($listReslt);die; ?>
<!-- Page tabs -->
  <form class="block" action="action/update-vendor-form.php" method="post" enctype="multipart/form-data">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h6 class="panel-title">Personal Details</h6>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Company Name</label>
              <input class="form-control" type="text" name="company_name" value="<?=$listReslt[0]['company_name'];?>">
            </div>
            <div class="col-md-6">
              <label>Display Name</label>
              <input class="form-control" type="text" name="company_display_name" value="<?=$listReslt[0]['company_display_name'];?>">
            </div>
          </div>
        </div>
       <!-- <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Address</label>
              <input class="form-control" type="text" name="company_display_name" value="<?=$listReslt[0]['company_display_name'];?>">
            </div>
            <div class="col-md-6">
              <label>Address 2</label>
              <input class="form-control">
            </div>
          </div>
        </div> -->
       <!-- <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Country</label>
              <input class="form-control" type="text" name="country" value="<?=$listReslt[0]['country'];?>">
            </div>
            <div class="col-md-6">
              <label>State</label>
              	<input class="form-control" type="text" name="state" value="<?=$listReslt[0]['state'];?>">
            </div>
          </div>
        </div> -->
       <!-- <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>City</label>
              <input class="form-control" type="text" name="city" value="<?=$listReslt[0]['city'];?>">
            </div>
            <div class="col-md-6">
              <label>Pin Code</label>
                <input class="form-control" type="text" name="pincode" value="<?=$listReslt[0]['pincode'];?>">
            </div>
          </div>
        </div> -->
        <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Registration type</label>
              <select class="form-control" name="registration_type">
                <option>Select</option>
                <option value="proprietorship" <?php if ($listReslt[0]['registration_type'] == "proprietorship") echo 'selected' ; ?>>Proprietorship</option>
                <option value="private-limited" <?php if ($listReslt[0]['registration_type'] == "private-limited") echo 'selected' ; ?>>Private Limited</option>
                <option value="partner-shop" <?php if ($listReslt[0]['registration_type'] == "partner-shop") echo 'selected' ; ?>>Partner Ship</option>
              </select>
            </div>
            <div class="col-md-6">
              <label>Logo</label>
              <input type="file" name="image_name" class="styled">
				<img src="http://pinkstarapp.com/uploads/vendor/<?php echo $listReslt[0]['image_name']; ?>" width="32" height="32"/>
            </div>
          </div>
        </div>
		   <div class="form-group">
          <div class="row">
            <div class="col-md-6">
              <label>Category type</label>
				<select class="form-control" id="category" name="category">
				  <option value="select">--Select One--</option>
					<?php foreach($categoryReslt as $listArr){
							foreach($listArr as $key => $value){ ?>
							 <option value="<?php echo strtolower($value);?>"<?php if ($listReslt[0]['category'] == strtolower($value)) echo 'selected' ; ?>><?php echo $value ?></option>
					<?php } } ?>
                </select>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <div class="pull-right">
            <input type="submit" class="btn btn-success" value="Continue">
        </div>
      </div>
    </div>
	  <input type="hidden" name="stepno" value="1"/>
	  <input type="hidden" name="unique_id" value="<?php echo $_REQUEST['formid'];?>"/>
  </form>

            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
        
<?php include('include/footer-inc.php')?>