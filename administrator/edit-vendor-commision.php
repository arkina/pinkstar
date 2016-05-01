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
$viewCommList = "select id,unique_id,slab_min,slab_max,amount,type from ps_vendor_commision where unique_id='".base64_decode($_REQUEST['formid'])."'";
$listCommReslt = $ObjCurd->runQueryList($viewCommList);
	#echo "<pre>";print_r($listCommReslt);die;
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
          <th>Slab Min</th>
          <th>Slab Max</th>
          <th>Amount</th>
          <th>Type</th>
        </thead>
        <tbody>
			<?php $count =1;
                  	foreach ($listCommReslt as $key => $listArr){ ?>
                            <tr>
								<td><?php echo $count;?></td>
                               <?php foreach ($listArr as $keyval => $value){ 
                  		if($keyval!="unique_id" && $keyval!="id"){ ?>
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
      <h6 class="panel-title">Vendor Commission</h6>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Slab Min</label>
            <input class="form-control" type="text" id="slab_min" name="slab_min" value="<?php (isset($_POST['slab_min']) ? $_POST['slab_min'] : '');?>"/>
          </div>
          <div class="col-md-6">
            <label>Slab Max</label>
            <input class="form-control" type="text" id="slab_max" name="slab_max" value="<?php (isset($_POST['slab_max']) ? $_POST['slab_max'] : '');?>" />
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-md-6">
            <label>Amount</label>
            <input class="form-control" type="text" id="amount" name="amount" value="<?php (isset($_POST['amount']) ? $_POST['amount'] : '');?>" />
          </div>
          <div class="col-md-6">
			  <div class="col-md-6">
              <label>Type</label>
              <select class="form-control" name="type">
                <option>Select</option>
                <option value="percentage" <?php if ($listReslt[0]['type'] == "percentage") echo 'selected' ; ?>>Percentage</option>
                <option value="amount" <?php if ($listReslt[0]['type'] == "amount") echo 'selected' ; ?>>Amount</option>
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="panel-footer">
      <div class="pull-right">
          <!-- <button class="btn btn-success">Add More</button> -->
         <input type="submit" class="btn btn-success" value="Continue">
      </div>
    </div>
	   <input type="hidden" name="stepno" value="3"/>
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