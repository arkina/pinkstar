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
$viewEmplist = "select id,page_title,page_name from ps_page where page_status!=2 order by page_name ASC";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
$viewdelEmplist = "select id,page_title,page_name from ps_page where page_status!=1 order by page_name ASC";
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
                <h3>Page List<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li class="active">Pages List</li>
                </ul>
            </div>
           
            <!-- END PAGE BREADCRUMBS -->
						
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h6 class="panel-title">View Page List</h6>
                   <ul class="breadcrumb-buttons collapse">
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-plus"></i> <span>Add Page</span> <b class="caret"></b></a>
                      <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header"><a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a><span>Page Detail</span><a href="#" class="pull-right"><i class="icon-new-tab"></i></a></div>
                        <form action="action/add-page.php" class="breadcrumb-search">
                          <input type="text" placeholder="Page Name" name="page_title" class="form-control autocomplete">
                          <input type="text" placeholder="Page Url" name="page_name" class="form-control autocomplete">
                          <input type="submit" class="btn btn-block btn-success" value="Add">
                        </form>
                      </div>
                    </li>
					   <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-remove"></i> <span>Deleted Page</span> <b class="caret"></b></a>
                      <div class="popup dropdown-menu dropdown-menu-right">
                        <div class="popup-header"><a href="#" class="pull-left"><i class="icon-paragraph-justify"></i></a><span>Deleted Page Detail</span><a href="#" class="pull-right"><i class="icon-new-tab"></i></a></div>
                        	<table class="table">
								  <?php
									if(!empty($listResltDel)){
									$count =1;
							foreach ($listResltDel as $key => $listArr){ ?>
									<tr>
										<td><?php echo $count;?></td>
									   <?php foreach ($listArr as $keyval => $value){ 
								if($keyval!="status" && $keyval!="id"){ ?>
										<td><?php echo ucfirst($value);?></td>
									<?php } }?>
								<td><button class="btn btn-success btn-icon" onclick="activatePage('activePage',<?=$listArr['id'];?>)"><i class="icon-pencil2"></i></button></td>
								</tr>
								  <?php $count++;} }else { ?>
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
                                <th>Page Name</th>
                                <th>Page URL</th>
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
								<td><button class="btn btn-warning btn-icon" onclick="del('delPage',<?=$listArr['id'];?>)"><i class="icon-remove3"></i></td>
						
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

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
<?php include('include/footer-inc.php')?>










