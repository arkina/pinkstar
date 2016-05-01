<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include("./include/head-inc.php");
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
$viewEmplist = "select id,fname,register_on from ".pu." order by register_on desc limit 0,5";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
$getListEmp ="select depart,count(*) as empno from ".pu." GROUP by depart order by register_on desc limit 0,5";
$empListReslt = $ObjCurd->runQueryList($getListEmp);
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
                <h3>Employee Management <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
            <!-- /page header -->
            <!-- Breadcrumbs line -->
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">Employee Management</li>
                  </ul>
                </div>
                <!-- /breadcrumbs line -->
           	<!-- Grid buttons -->
            <div class="info-buttons">
                <div class="col-lg-12">
                  <div class="row block-inner">
                  <div class="row block">
                    <div class="col-md-2"><a href="view-employee.php"><i class="icon-user2"></i><span>Employee List</span></a></div>
                    <div class="col-md-2"><a href="view-department.php"><i class="icon-user4"></i> <span>Department List</span></a></div>
                    <div class="col-md-2"><a href="edit-employee.php"><i class="icon-users"></i> <span>Add New Employee</span></a></div>
                    <div class="col-md-2"><a href="edit-department.php"><i class="icon-settings"></i> <span>Add New Department</span></a></div>
                    <div class="col-md-2"><a href="edit-rights.php"><i class="icon-settings"></i><span>Access Rights</span></a></div>
                  </div>
                </div>
            </div>
            <!-- /grid buttons -->
        </div>
       		<!-- END PAGE CONTENT BODY -->
            <div class="row">
            	<div class="col-lg-6">
                	<div class="panel panel-default">
                    	<div class="panel-heading">
                        	<h6 class="panel-title">Employees</h6>
                            <h6 class="panel-title pull-right"><a href="view-employee.php">View All</a></h6>
                        </div>
                        <div class="panel-body">
                        	<table class="table">
                            	<thead>
                                	<tr>
                                    	<th>Sr.No.</th>
                                        <th>Name</th>
                                        <th>Last Login</th>
                                    </tr>
                                </thead>
                                <tbody>
				<?php $count=1;
				foreach ($listReslt as $key => $listArr){ ?>
                                	<tr>
				<td><?php echo $count; ?></td>
				<?php foreach ($listArr as $keyval => $value){ ?>
				<?php if($keyval!="id"){ if($value==""){ $value ='Not Found';}?>
                                    	<td><?php echo ucfirst($value);?></td>
				<?php } } $count++;?>
                                    </tr>
				<?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                	<div class="panel panel-default">
                    	<div class="panel-heading">
                        	<h6 class="panel-title">Departments</h6>
                            <h6 class="panel-title pull-right"><a href="view-department.php">View All</a></h6>
                        </div>
                        <div class="panel-body">
                        	<table class="table">
                            	<thead>
                                	<tr>
                                    	<th>Sr.No.</th>
                                        <th>Name</th>
                                        <th>Employee No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php $count=1;
											foreach ($empListReslt as $key => $listArr){ ?>
										<tr>
											<td><?php echo $count; ?></td>
											<?php foreach ($listArr as $keyval => $value){ if($value=='select'){ $value='Not Found';}?>
												<td><?php echo ucfirst($value);?></td>
											<?php } $count++;?>
										</tr>
										<?php }?>
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
