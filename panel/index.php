<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
    exit();
}
include("../config/config.php");
include("./include/head-inc.php");
//include("./include/navigation-inc.php");
?>
</div>
<!-- BEGIN CONTAINER -->
     <div class="page-container">
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <!-- BEGIN PAGE CONTENT BODY -->
                <div class="page-content">
                    <!-- Page header -->
                    <div class="page-header">
                      <div class="page-title">
                        <h3>Dashboard <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
                      </div>
                    </div>
                    <!-- /page header -->
					<br>
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
                    <hr />
                   <!-- Grid buttons -->
                    <div class="info-buttons">
                        <div class="col-lg-12">
                          <div class="row block-inner">
                          <div class="row block">
                            <div class="col-md-2"><a href="employee-management.php"><i class="icon-user2"></i> <span>Employee Managemnt</span></a></div>
                            <div class="col-md-2"><a href="vendor-management.php"><i class="icon-user4"></i> <span>Vendor Management</span></a></div>
                            <div class="col-md-2"><a href="user-management.php"><i class="icon-users"></i> <span>User Mangement</span></a></div>
                            <div class="col-md-2"><a href="#"><i class="icon-settings"></i> <span>Finance</span></a></div>
                            <div class="col-md-2"><a href="#"><i class="icon-settings"></i><span>Ads Management</span></a></div>
                            <div class="col-md-2"><a href="#"><i class="icon-stats2"></i>Reports<span></span></a></div>
                            
                          </div>
                          <div class="row block">
                          	<div class="col-md-2"><a href="lead-management.php"><i class="icon-stats2"></i>Leads<span></span></a></div>
                            <div class="col-md-2"><a href="settings.php"><i class="icon-cogs"></i>Settings<span></span></a></div>
                          </div>
                        </div>
                    </div>
                    <!-- /grid buttons -->
                </div>
                <!-- END PAGE CONTENT BODY -->
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
        </div>

<?php include('include/footer-inc.php')?>
