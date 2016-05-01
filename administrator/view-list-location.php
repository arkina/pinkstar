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
$viewEmplist = "select location_id,name from ps_location where location_type=0 order by location_id ASC";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
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
                <h3>Country List<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="settings.php">Settings</a></li>
				   <li><a href="view-location.php">Location List</a></li>
                    <li class="active">Country List</li>
                </ul>
            </div>
           
            <!-- END PAGE BREADCRUMBS -->
			<div  id="showajax_error" style="color: red;font-size: 14px;padding-bottom: 7px;text-align: center;display:none"></div>
						
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h6 class="panel-title">View Country List</h6>
                </div>
                <div class="datatable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Country Name</th>
                            </tr>
                        </thead>
						<tbody>
							<?php $count =1;
                  	foreach ($listReslt as $key => $listArr){ ?>
                            <tr>
								<td><?php echo $count;?></td>
                               <?php foreach ($listArr as $keyval => $value){ 
                  		if($keyval!="location_id"){ ?>
								<td><?php echo ucfirst($value);?></td>
							<?php } }?>
								
                            </tr>
					<?php $count++; }?>	
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
<?php include('include/footer-inc.php')?>










