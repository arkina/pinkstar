<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include("./include/head-inc.php");
include("./include/navigation-inc.php");
#$ObjCurd = new Curd();
#$viewEmplist = "select id,first_name,register_by,email,mobile,register_on from ".pclient." order by register_on desc limit 0,5";
#$listReslt = $ObjCurd->runQueryList($viewEmplist);
#echo "<pre>";print_r($listReslt);die;
?>
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
                <h3>Vendor Management <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
            <!-- /page header -->
            <!-- Breadcrumbs line -->
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">Vendor Management</li>
                  </ul>
                </div>
                <!-- /breadcrumbs line -->
           	<!-- Grid buttons -->
            <div class="info-buttons">
                <div class="col-lg-12">
                  <div class="row block-inner">
                  <div class="row block">
                    <div class="col-md-2"><a href="view-pending-vendor.php"><i class="icon-user2"></i><span>View Pending Vendor</span></a></div>
                    <div class="col-md-2"><a href="view-vendor-list.php"><i class="icon-user2"></i><span>View Registered Vendor</span></a></div>
                    <div class="col-md-2"><a href="view-inactive-vendor.php"><i class="icon-user2"></i><span>View Inactive Vendor</span></a></div>
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

<?php include('./include/footer-inc.php')?>
