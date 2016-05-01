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
$viewEmplist = "select id,region_name,region_comment from ps_region where status=1 order by region_name ASC";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
$viewdelEmplist = "select id,region_name,status from ps_region where status!=1 order by cretae_date DESC  limit 0,6";
$listResltDel = $ObjCurd->runQueryList($viewdelEmplist);

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
                <h3>Region List<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li class="active">Region List</li>
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
<script type="text/javascript">
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
                   <h6 class="panel-title">View Page List</h6>
                   <ul class="breadcrumb-buttons collapse">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-plus"></i> <span>Add Region</span> <b class="caret"></b></a>
                      <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header"><a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a><span>Region Detail</span><a href="#" class="pull-right"><i class="icon-new-tab"></i></a></div>
                        <form action="action/add-region.php" class="breadcrumb-search">
                          <input type="text" placeholder="Region Name" name="region_name" class="form-control autocomplete">
						 <textarea name="region_comment" placeholder="Region Comment" style="margin: 0px; width: 269px; height: 79px;"></textarea>
                          <input type="submit" class="btn btn-block btn-success" value="Add">
                        </form>
                      </div>
                    </li>
					   <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-remove"></i> <span>Deleted Region</span> <b class="caret"></b></a>
                      <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header"><a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a><span>Deleted Region Detail</span><a href="#" class="pull-right"><i class="icon-new-tab"></i></a></div>
                        	<table class="table">
								  <?php
									if(!empty($listResltDel)){ #echo "<pre>";print_r($listResltDel);
									$count =1;$co=0;
							foreach ($listResltDel as $key => $listArr){ ?>
									<tr>
										<td><?php echo $count;?></td>
									   <?php foreach ($listArr as $keyval => $value){ 
								if($keyval!="status" && $keyval!="id"){ ?>
										<td><?php echo ucfirst($value);?></td>
									<?php } }?>
								<td><button class="btn btn-warning btn-icon" onclick="deletePremanetly('deletePage',<?php echo $listResltDel[$co]['id']; ?>,'view-region','region')"><i class="icon-remove3"></i></button>
								<?php if($listResltDel[$co]['status'] == 2){ ?>
									<button class="btn btn-warning btn-icon" onclick="deletePremanetly('activePage',<?php echo $listResltDel[$co]['id']; ?>,'view-region','region')"><i class="icon-redo2"></i></button>
								<?php }elseif($listResltDel[$co]['status']==1){?>
								<button class="btn btn-warning btn-icon" onclick="deletePremanetly('inactivePage',<?php echo $listResltDel[$co]['id']; ?>,'view-region','region')"><i class="icon-redo2"></i></button>
									<?php } ?>
								</td>
								</tr>
								  <?php $count++;$co++;} }else { ?>
								<span style="text-align: center;float: right;margin-right:149px;margin-top:10px;margin-bottom:10px;">No Record Found</span>
								<?php } ?>
						  </table>
                      </div>
                    </li>
                   </ul>
                </div>
                <div class="datatable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Region Name</th>
                                <th>Region Comment</th>
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
								<td><?php if($keyval=='region_comment'){ echo substr(ucfirst($value), 0, 140).'...';}else{echo ucfirst($value);} ?></td>
							<?php } }?>
								<td><button class="btn btn-warning btn-icon" onclick="deletePage('deletePage',<?=$listArr['id'];?>,'view-region','region')"><i class="icon-remove3"></i></button></td>
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










