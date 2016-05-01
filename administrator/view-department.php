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
$viewEmplist = "select id,department_name from ps_department where login_as='1' order by department_name ASC";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
}else{
	$viewEmplist = "select id,department_name from ps_department login_as='2' order by department_name ASC";
	$listReslt = $ObjCurd->runQueryList($viewEmplist);
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
                <h3>Department List<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li class="active">Department List</li>
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
                   <h6 class="panel-title">View Department List</h6>
                   <ul class="breadcrumb-buttons collapse">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-search3"></i> <span>Add Department</span> <b class="caret"></b></a>
                      <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header"><a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a><span>Department Name</span><a href="#" class="pull-right"><i class="icon-new-tab"></i></a></div>
                        <form action="action/add-department.php" class="breadcrumb-search">
                          <input type="text" placeholder="Type and hit enter..." name="department_name" class="form-control autocomplete">
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
                                <th>Name of department</th>
                                <th>No. Of employees</th>
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
								<td>0</td>
						<td>
							<?php if($_SESSION['login_as'] == '1'){ ?>
                        	<a data-toggle="modal" role="button" href="/" disabled="disabled" class="btn btn-default btn-xs btn-icon"><i class="icon-pencil"></i></a>
                            <a href="javascript:void(0)"><button class="btn btn-success btn-icon" disabled="disabled"><i class="icon-eye"></i></button></a>
                        <?php }else{ ?>
							<a data-toggle="modal" role="button" href="#modal<?=$listArr['id'];?>" class="btn btn-default btn-xs btn-icon"><i class="icon-pencil"></i></a>
                            <a href="view-designation.php?cat=<?=base64_encode($listArr['id'].'pink');?>"><button class="btn btn-success btn-icon"><i class="icon-eye"></i></button></a>
							<?php } ?>
						</td>
                            </tr>
					<?php $count++; }?>	
                        </tbody>
                    </table>
                </div>
            </div>

 <?php foreach($listReslt AS $mod){?>
 <div id="modal<?=$mod['id'];?>" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Update Department</h4>
          </div>
          <div class="panel-body">
          <form class="form-horizontal" method='post' action="action/update-department.php">
          	<div class="form-group">
            	<div class="col-md-12">
                	<input type="text" name="department_name" class="form-control" value="<?=$mod['department_name'];?>" />
                    <input type="hidden" name="id" value="<?=$mod['id'];?>" />
                </div>
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
<?php } ?>

            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
        
<?php include('include/footer-inc.php')?>