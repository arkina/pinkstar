<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include("./include/head-inc.php");
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
$viewEmplist = "select id,company_name,per_address,country,city,pincode from ".plead." order by reg_date desc";
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
                    <li><a href="lead-management.php">Lead Management</a></li>
                    <li class="active">View Leads</li>
                  </ul>
                </div>
                <!-- /breadcrumbs line -->
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
       		<!-- END PAGE CONTENT BODY -->
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
                                <th>Pincode</th>
								<th>State</th>
                                <th>Marketing Manager</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
							<?php $count =1;$co=0;
			#echo "<pre>";print_r($listReslt);die;
                  	foreach ($listReslt as $key => $listArr){ ?>
                            <tr>
								<td><?php echo $count;?></td>
                               <?php foreach ($listArr as $keyval => $value){ 
                  		            if($keyval!="status" && $keyval!="id" && $keyval!="country" && $keyval!="city"){ ?>
								<td><?php echo ucfirst($value);?></td>
						    	<?php } }?>
							<?php $getCountry = "SELECT name FROM `ps_location` WHERE `parent_id` = '".$listArr['country']."' and location_id= '".$listArr['city']."'";
						$listCountry = $ObjCurd->runQueryList($getCountry); //print_r($listCountry);?>
								<td><?php echo $listCountry[0]['name']; ?></td>
								<td><button class="btn btn-success btn-icon"><i class="icon-pencil2"></i></button></td>
								<td>
								<a href="edit-viewleads.php?pid=<? echo base64_encode($listReslt[$co]['id']);?>"><button class="btn btn-success btn-icon"><i class="icon-pencil2"></i></button></a>
								</td>
                            </tr>
					<?php $count++; $co++;}?>
                        </tbody>
                    </table>
                </div>
            </div> 
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<?php include('./include/footer-inc.php')?>
