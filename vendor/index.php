<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
	exit();
}
include("../config/config.php");
include("include/head-inc.php");
include("include/navigation-inc.php");
?>
<!-- Page container -->
<div class="page-container">
  <!-- Content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Dashboard</h3>
      </div>
   </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li class="active">Dashboard</li>
      </ul>
    </div>
    <!-- /breadcrumbs line -->
    <!-- Profile grid -->
    <div class="row">
      <?php include("../vendor/include/profile-section.php");?>
      <div class="col-lg-10">
        <!-- Stats graphs -->
              <h6><i class="icon-bars"></i> Statistics</h6>
              <div class="row">
                <div class="col-md-4">
                  <div class="block">
                    <div class="bg-success realtime-stats">
                      <div id="updating-widget-1" class="graph"></div>
                    </div>
                    <div class="section-details text-center container-fluid">
                      <div class="row">
                        <div class="col-xs-4">13.5 M <span>total visits</span></div>
                        <div class="col-xs-4">12.245 <span>new visitors</span></div>
                        <div class="col-xs-4">$34.290 <span>current balance</span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="block">
                    <div class="bg-info realtime-stats">
                      <div id="updating-widget-2" class="graph"></div>
                    </div>
                    <div class="section-details text-center container-fluid">
                      <div class="row">
                        <div class="col-xs-4">431 <span>new orders</span></div>
                        <div class="col-xs-4">45.209 <span>total orders</span></div>
                        <div class="col-xs-4">$51.356 <span>total value</span></div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="block">
                    <div class="bg-danger realtime-stats">
                      <div id="updating-widget-3" class="graph"></div>
                    </div>
                    <div class="section-details text-center container-fluid">
                      <div class="row">
                        <div class="col-xs-4">35.1 Gb <span>data uploaded</span></div>
                        <div class="col-xs-4">92.56 Gb <span>data downloaded</span></div>
                        <div class="col-xs-4">104.45 Gb <span>available space</span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /stats graphs -->
        <!-- Page tabs -->
        <div class="panel panel-default">
          <div class="panel-heading">
              <h6 class="panel-title">Today's Visitors</h6>
              <h6 class="panel-title pull-right">View All</h6>
          </div>
          <div class="panel-body">
            <div class="datatable">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sr.No.</th>
                      <th>User Number</th>
                      <th>Bill Amount</th>
                      <th>Star Percentage</th>
                      <th>Bill Date Time</th>
                      <th>View Bill</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>1</td>
                        <td>+91-9811759759</td>
                        <td>1</td>
                        <td>+91-9811759759</td>
                        <td>1</td>
                        <td>+91-9811759759</td>
                        <td>pending</td>
                      </tr>
                  </tbody>
                </table>
            </div>
          </div>
        </div>
        <!-- /page tabs -->
      </div>
    </div>
    <!-- /profile grid -->

<?php include('include/footer-inc.php')?>
