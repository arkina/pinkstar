<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include("./include/head-inc.php");
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
$viewEmplist = "select id,first_name,register_by,email,mobile,register_on from ".pclient." order by register_on desc limit 0,5";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
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
                <h3>User Management <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
            <!-- /page header -->
            <!-- Breadcrumbs line -->
                <div class="breadcrumb-line">
                  <ul class="breadcrumb">
                    <li><a href="index.php">Dashboard</a></li>
                    <li class="active">User Management</li>
                  </ul>
                </div>
                <!-- /breadcrumbs line -->
           	<!-- Grid buttons -->
            <div class="info-buttons">
                <div class="col-lg-12">
                  <div class="row block-inner">
                  <div class="row block">
                    <div class="col-md-2"><a href="view-user-profile.php"><i class="icon-user2"></i><span>Search User</span></a></div>
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
                        	<h6 class="panel-title">User List</h6>
                        </div>
                        <div class="panel-body">
                        	<table class="table">
                            	<thead>
                                	<tr>
                                    	<th>Sr.No.</th>
                                        <th>Name</th>
                                        <th>Register BY</th>
										<th>Email-id</th>
										<th>Mobile</th>
										<th>Registred On</th>
										<th>Options</th>
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
			<td><a href="view-user-profile.php?pid=<?=base64_encode($listArr['id']);?>"><button class="btn btn-success btn-icon"><i class="icon-eye"></i></button></a></td>
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
