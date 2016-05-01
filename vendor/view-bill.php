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
        <li class="active">View Bills</li>
      </ul>
    </div>
    <!-- /breadcrumbs line -->
    <!-- Profile grid -->
    <div class="row">
      <?php include("../vendor/include/profile-section.php");?>
      <div class="col-lg-10">
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
