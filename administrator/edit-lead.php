<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
include('../config/config.php');
include('./include/head-inc.php');include('./include/navigation-inc.php');
?>
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Add / Edit New Lead <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
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
	  
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="lead-management.php">Lead Management</a></li>
        <li>Add / Edit New Lead</li>
      </ul>
    </div>
    <!-- /breadcrumbs line -->
    <form class="form-horizontal" id="leadregs" action="action/add-lead.php" method="post">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h6 class="panel-title">Add / Edit New Vendor Lead</h6>
            </div>
            <div class="panel-body">
                <h3 class="text-success">Vendor Detail</h3>
                <hr>
                <div class="form-group">
                  <label class="control-panel col-md-2">Company Name</label>
                  <div class="col-md-4">
                     <input type="text" id="company_name" name="company_name" value="" class="form-control" />
                      <span class="error" id="company_name_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Contact Person</label>
                  <div class="col-md-4">
                    <input type="text" id="contact_person" name="contact_person" value="" class="form-control" />
                      <span class="error" id="contact_person_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Contact Phone</label>
                  <div class="col-md-4">
                     <input type="text" id="phone" name="phone" maxlength="10" value="" class="form-control" />
                      <span class="error" id="phone_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Contact Mobile</label>
                  <div class="col-md-4">
                    <input type="text" id="mobile" name="mobile" maxlength="10" value="" class="form-control" />
                      <span class="error" id="mobile_error" style="color: red"></span>
                  </div>
                </div>
				<div class="form-group">
                  <label class="control-panel col-md-2">Alternate Phone</label>
                  <div class="col-md-4">
                     <input type="text" id="alternate_phone" maxlength="10" name="alternate_phone" value="" class="form-control" />
                      <span class="error" id="alternate_phone_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Alternate Mobile</label>
                  <div class="col-md-4">
                    <input type="text" id="alternate_mobile" maxlength="10" name="alternate_mobile" value="" class="form-control" />
                      <span class="error" id="alternate_mobile_error" style="color: red"></span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-panel col-md-2">Website</label>
                  <div class="col-md-4">
                     <input type="text" id="website" name="website" value="" class="form-control" />
                      <span class="error" id="website_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Email Address</label>
                  <div class="col-md-4">
                    <input type="text" id="email" name="email" value="" class="form-control" />
                      <span class="error" id="email_error" style="color: red"></span>
                  </div>
                </div>
                <h3 class="text-success">Location Details</h3>
                <hr>
                <span class="error" id="presonal_error" style="color: red"></span>
                <div class="form-group">
                  <label class="control-panel col-md-2">Latitude</label>
                  <div class="col-md-4">
                     <input type="text" id="latitude" name="latitude" value="" class="form-control" />
                    <span class="error" id="latitude_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Logitiude</label>
                  <div class="col-md-4">
                   <input type="text" id="logitiude" name="logitiude" value="" class="form-control" />
                    <span class="error" id="logitiude_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Address</label>
                  <div class="col-md-4">
                     <input type="text" id="per_address" name="per_address" value="" class="form-control" />
                      <span class="per_address_error" id="per_address_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Address 2</label>
                  <div class="col-md-4">
                     <input type="text" id="alter_address" name="alter_address" value="" class="form-control" />
                      <span class="alter_address_error" id="alter_address_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Country</label>
                  <div class="col-md-4">
                    <select class="form-control" name="state" id="state">
                     <!--  <option value="select">--Select One--</option> -->
                      <option value="100" disabled="disabled" selected="selected">India</option>
                    </select>
                  </div>
                  <label class="control-panel col-md-2">State</label>
                  <div class="col-md-4">
                    <select class="form-control" id="country_dummy" name="country"></select>
                  </div>
                  <div class="col-md-4">
                    <select style="display: none;" class="form-control" id="country" name="country"></select>
                  </div>
					<span class="country_error" id="country_error" style="color: red"></span>
                </div>
                <div class="form-group">
                <label class="control-panel col-md-2">City</label>
                  <div class="col-md-4">
                    <select class="form-control" id="city" name="city">
                      <option value="select">--Select One--</option>
                    </select>
					<span class="city_error" id="city_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Pincode</label>
                  <div class="col-md-4">
                     <input type="text" id="pincode" maxlength="6" name="pincode" class="form-control" />
                    <span class="pincode_error" id="pincode_error" style="color: red"></span>
                  </div>
                </div>
             </div>  
            <div class="panel-footer">
              <div class="form-group">
              	<div class="col-md-offset-10">
                	<button type="submit" class="btn btn-success" value="Register">Next</button>
                </div>
              </div>
            </div>
            </div>
     </form>
<?php include('./include/footer-inc.php');?>
