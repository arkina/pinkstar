<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include('./include/head-inc.php');
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
$viewEmplist = "select location_id,name from ps_location where location_type=2 and parent_id='".$_REQUEST['pid']."' order by location_id ASC";
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
                <h3>City List<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="settings.php">Settings</a></li>
				    <li><a href="view-states.php?pid=<?php echo $_REQUEST['nid']; ?>">State List</a></li>
                    <li class="active">City List</li>
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
                   <h6 class="panel-title">View Location List</h6>
                   <ul class="breadcrumb-buttons collapse">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-plus"></i> <span>Add City</span> <b class="caret"></b></a>
                      <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header"><a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a><span>Page Detail</span><a href="#" class="pull-right"><i class="icon-new-tab"></i></a></div>
                        <form action="action/add-country.php" class="breadcrumb-search">
                          <input type="text" placeholder="City Name" name="name" class="form-control autocomplete">
						 <input type="hidden" name="add-city" value="add-city">
						  <input type="hidden" name="pid" value="<?php if(isset($_REQUEST['pid'])){ echo $_REQUEST['pid']; }?>"/>
						  <input type="hidden" name="nid" value="<?php if(isset($_REQUEST['nid'])){ echo $_REQUEST['nid']; }?>"/>
                          <input type="submit" class="btn btn-block btn-success" value="Add">
                        </form>
                      </div>
                    </li>
                   </ul>
                </div>
                <div class="datatable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>City Name</th>
                                <th>Options</th>
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
								<td><button class="btn btn-warning btn-icon" onclick="locationDel('cityDel',<?=$listArr['location_id'];?>,'view-cities')"><i class="icon-remove3"></i></button>
								<a data-toggle="modal" role="button" href="#modal<?=$listArr['location_id'];?>" class="btn btn-default btn-xs btn-icon"><i class="icon-pencil"></i></a>&nbsp;
								<a href="view-list-cities.php?pid=<?=$_REQUEST['pid'];?>"><button class="btn btn-success btn-icon"><i class="icon-eye"></i></button></a>
									</td>
									</tr>
					<?php $count++; }?>	
                        </tbody>
                    </table>
                </div>
			</div>
            <!-- END PAGE CONTENT INNER -->
        </div>
		<?php foreach($listReslt AS $mod){ ?>
	<div id="modal<?=$mod['location_id'];?>" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Update Country</h4>
          </div>
          <div class="panel-body">
          <form class="form-horizontal" method='post' action="action/update-list-country.php">
          	<div class="form-group">
            	<div class="col-md-12">
                	<input type="text" name="name" class="form-control" value="<?=$mod['name'];?>" />
                    <input type="hidden" name="id" value="<?=$mod['location_id'];?>" />
					<input type="hidden" name="city-list" value="city-list"/>
					<input type="hidden" name="pid" value="<?php if(isset($_REQUEST['pid'])){ echo $_REQUEST['pid']; }?>"/>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    </div>
	<?php } ?>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
<?php include('include/footer-inc.php')?>










