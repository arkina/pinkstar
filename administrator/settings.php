<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include("./include/head-inc.php");
include("./include/navigation-inc.php");
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
                <h3>Settings <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
            <!-- /page header -->
            <!-- Breadcrumbs line -->
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">Settings</li>
                  </ul>
                </div>
                <!-- /breadcrumbs line -->
           	<!-- Grid buttons -->
            <div class="info-buttons">
                <div class="col-lg-12">
                  <div class="row block-inner">
                    <div class="row block">
                      <div class="col-md-2"><a href="view-department.php"><i class="icon-user2"></i><span>Department List</span></a></div>
                      <div class="col-md-2"><a href="view-page.php"><i class="icon-user2"></i><span>Page List</span></a></div>
                      <div class="col-md-2"><a href="view-cuisine.php"><i class="icon-user2"></i><span>Cuisine</span></a></div>
          					  <div class="col-md-2"><a href="view-location.php"><i class="icon-user2"></i><span>Location</span></a></div>
          					  <div class="col-md-2"><a href="view-region.php"><i class="icon-user2"></i><span>Region</span></a></div>
          					  <div class="col-md-2"><a href="view-category-list.php"><i class="icon-user2"></i><span>Category list</span></a></div>
                    </div>
                    <div class="row block">
                      <div class="col-md-2"><a href="view-biller-list.php"><i class="icon-user2"></i><span>Cyber Plat</span></a></div>
  					  
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
