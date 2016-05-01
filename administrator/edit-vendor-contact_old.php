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
$viewEmplist = "select * from ps_api";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
$viewDestination = "select id,department_name from ps_department where login_as=1 order by id desc";
$listResltDestionation = $ObjCurd->runQueryList($viewDestination);
$viewContact="select first_name,last_name,email_id,mobile from ps_vendor_contact_person where vendor_id='".base64_decode($_REQUEST['formid'])."'";
$listResltContacts = $ObjCurd->runQueryList($viewContact);
	#echo "<pre>".'**';print_r($listResltContacts);die;
}else{
	$viewEmplist = "select * from ps_api";
	$listReslt = $ObjCurd->runQueryList($viewEmplist);
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
<!-- Page tabs -->
<div class="panel panel-default">
  <div class="panel-heading">
    <h6 classs="panel-title">Contact List</h6>
  </div>
  <div class="panel-body">
    <div class="datatable">
      <table class="table">
        <thead>
          <th>Sr.No.</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email Id</th>
          <th>Mobile</th>
        </thead>
        <tbody>
          <?php $count =1;
                  	foreach ($listResltContacts as $key => $listArr){ ?>
                            <tr>
								<td><?php echo $count;?></td>
                               <?php foreach ($listArr as $keyval => $value){ 
                  		if($keyval!="id"){ ?>
								<td><?php echo ucfirst($value);?></td>
							<?php } }?>
                            </tr>
					<?php $count++; }?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<form class="block" action="action/update-vendor-form.php" method="post">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h6 class="panel-title">Contact Details</h6>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>First Name</label>
             <input class="form-control" name="first_name" id="first_name" value="<?php (isset($_POST['first_name']) ? $_POST['first_name'] : '');?>"/>
          </div>
          <div class="col-md-6">
            <label>Last Name</label>
             <input class="form-control" name="last_name" id="last_name" value="<?php (isset($_POST['last_name']) ? $_POST['last_name'] : '');?>"/>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Email Address</label>
             <input class="form-control" name="email_id" id="email_id" value="<?php (isset($_POST['email_id']) ? $_POST['email_id'] : '');?>"/>
          </div>
          <div class="col-md-6">
            <label>Designation</label>
            <select class="form-control" id="designation" name="designation">
                      <option value="select">--Select One--</option>
						<?php $counter=0; foreach($listResltDestionation as $listArr){
								foreach($listArr as $key => $value){ if($key!="id"){?>
							<option value="<?php echo $listReslt[$counter]['id'];?>"><?php echo $value ?></option>
								<?php $counter++; } } }?>
                    </select>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Phone Number</label>
            <input class="form-control" name="phone" id="phone" value="<?php (isset($_POST['phone']) ? $_POST['phone'] : '');?>"/>
          </div>
          <div class="col-md-6">
            <label>Mobile Number</label>
            <input class="form-control" name="mobile" maxlength="10" id="mobile" value="<?php (isset($_POST['mobile']) ? $_POST['mobile'] : '');?>"/>
          </div>
        </div>
      </div>
	<div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Alternate mobile</label>
            <input class="form-control" maxlength="10" name="alternate_mobile" id="alternate_mobile" value="<?php (isset($_POST['alternate_mobile']) ? $_POST['alternate_mobile'] : '');?>"/>
          </div>
          <!-- <div class="col-md-6">
            <label>Email id</label>
            <input class="form-control" name="email_id" id="email_id" value="<?php (isset($_POST['email_id']) ? $_POST['email_id'] : '');?>"/>
          </div> -->
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <div class="pull-right">
          <button class="btn btn-success">Add More</button>
          <input type="submit" class="btn btn-success" value="Continue"/>
      </div>
		<input type="hidden" name="stepno" value="2"/>
	  <input type="hidden" name="vendor_id" value="<?php echo $_REQUEST['formid'];?>"/>
    </div>
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