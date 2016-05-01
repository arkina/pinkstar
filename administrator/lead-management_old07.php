<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include("./include/head-inc.php");
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
$viewEmplist = "select company_name,per_address,state,pincode from ".plead." order by reg_date desc limit 0 , 5";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
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
                <h3>Lead Management <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
            <!-- /page header -->
            <!-- Breadcrumbs line -->
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">Lead Management</li>
                  </ul>
                </div>
                <!-- /breadcrumbs line -->
           	<!-- Grid buttons -->
            <div class="info-buttons">
                <div class="col-lg-12">
                  <div class="row block-inner">
                  <div class="row block">
                    <div class="col-md-2"><a href="edit-lead.php"><i class="icon-user2"></i><span>Add New Lead</span></a></div>
                    <div class="col-md-2"><a href="edit-bulk-lead.php"><i class="icon-user4"></i> <span>Add Bulk Lead</span></a></div>
                    <div class="col-md-2"><a href="view-lead.php"><i class="icon-user2"></i><span>View Lead</span></a></div>
                  </div>
                </div>
            </div>
            <!-- /grid buttons -->
        </div>
       		<!-- END PAGE CONTENT BODY -->
            <div class="row">
                <div class="col-lg-12">
                	<div class="panel panel-default">
                    	<div class="panel-heading">
                        	<h6 class="panel-title">Leads</h6>
                            <h6 class="panel-title pull-right"><a href="view-department.php">View All</a></h6>
                        </div>
                        <div class="panel-body">
                        	<table class="table">
                            	<thead>
                                	<tr>
                                    	<th>Sr.No.</th>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Pincode</th>
                                        <th>Marketing Manager</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                 <tbody>
							<?php $count =1;
                  	foreach ($listReslt as $key => $listArr){ ?>
                            <tr>
								<td><?php echo $count;?></td>
                               <?php foreach ($listArr as $keyval => $value){ 
                  		if($keyval!="status" && $keyval!="id"){ ?>
								<td><?php echo ucfirst($value);?></td>
							<?php } }?>
                            </tr>
					<?php $count++; }?>
                        </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
</div>

<?php include('./include/footer-inc.php')?>
