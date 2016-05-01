<?php
session_start();
print_r($_SESSION);
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
        <h3>Add New Page <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li>Add New Page</li>
      </ul>
      <div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
    </div>
    <!-- /breadcrumbs line -->
    
          <div class="panel panel-default">
            <div class="panel-heading">
              <h6 class="panel-title">Add New Page</h6>
            </div>
            <div class="panel-body">
              <form class="form-horizontal">
              	<div class="form-group">
                	<label class="control-label">Page Name</label>
                    <div class="col-md-12">
                    	<input type="text">
                    </div>
                </div>
                <div class="form-group">
                	<label class="control-label">Page URL</label>
                    <div class="col-md-12">
                    	<input type="text">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10">
					</div>                	
                    <div class="col-md-2">
                    	<input type="submit" class="success" value="Add Page"></button>
                    </div>
                </div>
              </form>
            </div>
          </div>
        </div>
       </div> 
<?php include('./include/footer-inc.php');?>
