<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
//include("../config/config.php");
include("../curd/curd.php");
include('./include/head-inc.php');
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
if($_SESSION['login_as'] == '1'){
$viewEmplist = "select id,vendor_id,latitude,longitude,city,state,country,pincode,registered_date from ps_latlong where vendor_status='1'";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
}else{
	echo "hello";die;
	//$viewEmplist = "select * from ps_api";
	//$listReslt = $ObjCurd->runQueryList($viewEmplist);
}
?>
    <style>
    .dt-buttons{
        display: none;
    }
    </style>    
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
                <h3>New Vendor<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="vendor-management.php">Vendor Management</a></li>
                    <li class="active">Pending Vendor List</li>
                </ul>
            </div>
           
            <!-- END PAGE BREADCRUMBS -->
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
						
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h6 class="panel-title">View Biller List</h6>
                </div>
                <div class="panel-body">
                  <div class="datatable">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Form ID</th>
                                  <th>Location</th>
                                  <th>Area</th>
                                  <th>Registration On</th>
                                  <th>Options</th>
                              </tr>
                          </thead>
              						<tbody>
						<?php if(!empty($listReslt)){ 
							$count =1;
                  	foreach ($listReslt as $key => $listArr){ ?>
                                <tr>
                  				   <td><?php echo $count;?></td>
                                   <td><?php echo $listArr['vendor_id'];?></td>
                                   <td>
                                      Latitude:<?php echo round($listArr['latitude'],2);?><br>
                                      Longitude : <?php echo round($listArr['longitude'],2);?>
                                   </td>
                                   <td>
                                      <?php echo $listArr['city'];?>, <?php echo $listArr['state'];?><br>
                                      <?php echo $listArr['country'];?> <?php echo $listArr['pincode'];?>
                                    </td>
                                    <td>
									<?php $date = explode(" ",$listArr['registered_date']);
										  $yrdata= strtotime($date[0]);
										  echo date('d M Y', $yrdata);
										?>
									</td>
                                   <td><a href="edit-vendor.php?pid=<?=$listArr['id'];?>&formid=<?php echo $listArr['vendor_id'];?>">Edit</a></td>
                                </tr>
							<?php $count++; } }else{ ?>
										<tr><td colspan="6" align="center"><?php echo "No Record Found"; ?></td></tr>		
							<?php	}?>
                           </tbody>
                        </table>
                  </div>
                </div>
            </div>

            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
        
<?php include('include/footer-inc.php')?>