<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include('./include/head-inc.php');
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
if(isset($_REQUEST['pid'])){ $pid =base64_decode($_REQUEST['pid']);}
$viewEmplist = "select id,first_name,last_name,address_first,address_second,country_name,state_name,city_name,pincode,register_by,email,mobile,image_name,register_on from ".pclient." where id='".$pid."'";
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
                <h3>User Profile<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
				   <!-- <li><a href="user-management.php">User Management</a></li> -->
				   <li class="active">User Profile</li>
                </ul>
            </div>
           
            <!-- END PAGE BREADCRUMBS -->
            <!-- Search line -->
              <form action="action/searchmgmt.php" method="post" class="search-line block" role="form">
                <span class="subtitle"><i class="icon-pencil3"></i> Search User Profile:</span>
                <div class="input-group">
                  <div class="search-control">
                    <input type="text" name="search_content" class="form-control autocomplete" placeholder="What are you looking for?">
                  </div>
                  <span class="input-group-btn">
                  <button class="btn btn-primary" type="submit">Search</button>
                  </span>
					<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>"/>
				  </div>
              </form>
              <!-- /search line -->
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
			<?php if($_REQUEST['pid']!=""){ ?>
			<div class="row">
      <div class="col-lg-2">
        <!-- Profile links -->
        <div class="block">
          <div class="block">
            <div class="thumbnail">
              <div class="thumb"><img alt="" src="http://pinkstarapp.com/uploads/usermgmt/<?php echo $listReslt[0]['image_name'];?>">
                <div class="thumb-options"><span><a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a><a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a></span></div>
              </div>
              <div class="caption text-center">
                <h6><?php echo $listReslt[0]['first_name'];?></h6>
                <div class="icons-group">
					<?php if(strtolower($listReslt[0]['register_by']) =='mobile'){ ?>
					<a href="#" title="Mobile" class="tip"><i class="icon-mobile"></i></a>
					<?php }if(strtolower($listReslt[0]['register_by']) =='twitter'){?>
					<a href="#" title="Twitter" class="tip"><i class="icon-twitter"></i></a>
					<?php }if(strtolower($listReslt[0]['register_by']) =='facebook'){ ?>
					<a href="#" title="Facebook" class="tip"><i class="icon-facebook"></i></a>
				  	<?php } ?>
				</div>
              </div>
            </div>
          </div>
          <!--  <ul class="nav nav-list">
            <li class="nav-header">My Profile <i class="icon-accessibility"></i></li>
            <li><a href="#">General Info</a></li>
            <li><a href="#">Networks <span class="label label-danger">21</span></a></li>
            <li><a href="#">Connections</a></li>
            <li><a href="#">Messages <span class="label label-danger">14</span></a></li>
          </ul> -->
          <ul class="nav nav-list">
            <li class="nav-header">Order<i class="icon-cogs"></i></li>
            <li><a href="#">Voucher Process</a></li>
            <li><a href="#">Mobile Recharge</a></li>
            <li><a href="#">E-Shop</a></li>
          </ul>
          <ul class="nav nav-list">
            <li class="nav-header">Bill Files <i class="icon-google-drive"></i></li>
            <li><a href="view-user-bill.php?bill=<?=base64_encode(1); ?>">Approved Bill <span class="label label-success">21</span></a></li>
            <li><a href="view-user-bill.php?bill=<?=base64_encode(2); ?>">Pending Bill <span class="label label-danger">1</span></a></li>
            <li><a href="view-user-bill.php?bill=<?=base64_encode(3); ?>">Rejected Bill <span class="label label-danger">2</span></a></li>
          </ul>
        </div>
        <!-- /profile links -->
      </div>
      <div class="col-lg-10">
        <!-- Page tabs -->
        <div class="tabbable page-tabs">
          <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#activity" data-toggle="tab"><i class="icon-paragraph-justify2"></i> Activity</a></li>
            <li><a href="#stats" data-toggle="tab"><i class="icon-stats2"></i> Reports <i class="icon-spinner7 spin pull-right"></i></a></li>
            <li><a href="#profile-messages" data-toggle="tab"><i class="icon-bubbles3"></i> Messages <span class="label label-danger">12</span></a></li>
            <li><a href="#tasks" data-toggle="tab"><i class="icon-settings"></i> Tasks <span class="label label-danger">7</span></a></li>
            <li><a href="#settings" data-toggle="tab"><i class="icon-cogs"></i>User Profile</a></li>
          </ul>
          <div class="tab-content">
            <!-- First tab -->
            <div class="tab-pane active fade in" id="activity">
              <!-- Statistics -->
              <div class="block">
                <ul class="statistics list-justified">
                  <li>
                    <div class="statistics-info"> <a href="#" title="" class="bg-success"><i class="icon-user-plus"></i></a> <strong>1200.00</strong> </div>
                    <div class="progress progress-micro">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="sr-only">60% Complete</span></div>
                    </div>
                    <span>Total Purchase</span> </li>
                  <li>
                    <div class="statistics-info"> <a href="#" title="" class="bg-warning"><i class="icon-point-up"></i></a> <strong>3</strong> </div>
                    <div class="progress progress-micro">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20% Complete</span></div>
                    </div>
                    <span>Total Star</span> </li>
                  <li>
                    <div class="statistics-info"> <a href="#" title="" class="bg-info"><i class="icon-cart-plus"></i></a> <strong>10</strong> </div>
                    <div class="progress progress-micro">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"><span class="sr-only">90% Complete</span></div>
                    </div>
                    <span>Redeemable Star</span> </li>
                  <li>
                    <div class="statistics-info"> <a href="#" title="" class="bg-danger"><i class="icon-coin"></i></a> <strong>8</strong> </div>
                    <div class="progress progress-micro">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"><span class="sr-only">70% Complete</span></div>
                    </div>
                    <span>Pending For Approval Star</span> </li>
                  <li>
                    <div class="statistics-info"> <a href="#" title="" class="bg-primary"><i class="icon-people"></i></a> <strong>20</strong> </div>
                    <div class="progress progress-micro">
                      <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="sr-only">50% Complete</span></div>
                    </div>
                    <span>Redeem Star</span> </li>
                  <li>
                    <div class="statistics-info"> <a href="#" title="" class="bg-info"><i class="icon-facebook"></i></a> <strong>11</strong> </div>
                    <div class="progress progress-micro">
                      <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100" style="width: 93%;"><span class="sr-only">93% Complete</span></div>
                    </div>
                    <span>Current Star</span> </li>
                </ul>
              </div>
              <!-- /statistics -->
            </div>
            <!-- /first tab -->
            <!-- Second tab -->
            <div class="tab-pane fade" id="stats">
              <!-- Stats graphs -->
              <h6><i class="icon-bars"></i> Profile statistics</h6>
              <!-- /stats graphs -->
           </div>
            <!-- /second tab -->
            <!-- Third tab -->
            <div class="tab-pane fade" id="profile-messages">
              <div class="chat-member-heading clearfix">
                <h6 class="pull-left"><i class="icon-bubbles"></i><small>Messages</small></h6>
                <div class="pull-right"><a href="#" class="btn btn-primary btn-icon btn-xs"><i class="icon-plus-circle"></i></a></div>
              </div>
            </div>
            <!-- /third tab -->
            <!-- Fourth tab -->
            <div class="tab-pane fade" id="tasks">
              <!-- Tasks table -->
              <div class="block">
                <h6 class="heading-hr"><i class="icon-settings"></i> My Tasks</h6>
                <div class="datatable-tasks">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Task Description</th>
                        <th class="task-priority">Priority</th>
                        <th class="task-date-added">Date Added</th>
                        <th class="task-progress">Progress</th>
                        <th class="task-deadline">Deadline</th>
                        <th class="task-tools text-center">Tools</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Donec suscipit ultrices commodo. Suspendisse potenti</a> <span>General layout additions</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>September 20, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"><span class="sr-only">90% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">14</strong> hours left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Donec sagittis sit amet felis non semper</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>September 18, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">2</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Pellentesque sed nibh non neque auctor ornare ac in est</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-info">Low</span></td>
                        <td>September 2, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100" style="width: 12%;"><span class="sr-only">12% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">18</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Pellentesque habitant morbi tristique senectus et netus</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-success">Normal</span></td>
                        <td>August 21, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;"><span class="sr-only">50% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">7</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Et malesuada fames ac turpis egestas</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>August 12, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="sr-only">80% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">90</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Maecenas eros nisl, tempor vitae dolor eu</a> <span>General layout additions</span></td>
                        <td class="text-center"><span class="label label-success">Normal</span></td>
                        <td>August 7, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="41" aria-valuemin="0" aria-valuemax="100" style="width: 41%;"><span class="sr-only">41% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">62</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Nunc gravida, nunc vel condimentum mattis</a> <span>General layout additions</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>July 30, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">21</strong> hour left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Rhoncus rutrum metus neque rutrum tortor</a> <span>General layout additions</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>July 26, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"><span class="sr-only">60% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">62</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Fusce sapien velit, accumsan eget risus et</a> <span>General layout additions</span></td>
                        <td class="text-center"><span class="label label-info">Low</span></td>
                        <td>July 22, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">51</strong> day left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Suspendisse dictum vitae ante ut tempor</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-info">Low</span></td>
                        <td>July 10, 2013</td>

                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="6" aria-valuemin="0" aria-valuemax="100" style="width: 6%;"><span class="sr-only">6% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">2</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Maecenas porta augue et odio dignissim</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-info">Low</span></td>
                        <td>June 25, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%;"><span class="sr-only">65% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">3</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Morbi varius odio at quam vehicula mattis</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-success">Normal</span></td>
                        <td>June 21, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;"><span class="sr-only">20% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">89</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Quisque ultrices libero in nisl fringilla</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>June 17, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">32</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Nam fermentum ut nunc eget tristique</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>June 14, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100" style="width: 31%;"><span class="sr-only">31% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">2</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Etiam viverra porttitor auctor</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-success">Normal</span></td>
                        <td>June 3, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%;"><span class="sr-only">90% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">1</strong> day left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Curabitur quis commodo massa. Proin eget arcu eros</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>May 9, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"><span class="sr-only">10% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">2</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Maecenas sed sapien vel nisi porta sollicitudin</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>May 2, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"><span class="sr-only">40% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">37</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Nunc placerat mattis consectetur. Cras sagittis scelerisque imperdiet</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-info">Low</span></td>
                        <td>April 21, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%;"><span class="sr-only">10% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong class="text-danger">3</strong> days left</td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Nunc tincidunt consectetur quam et venenatis</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-info">Low</span></td>
                        <td>April 19, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong>Complete!</strong></td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Phasellus quis sagittis orci, vitae placerat mauris</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-info">Low</span></td>
                        <td>April 11, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong>Complete!</strong></td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Nunc sit amet arcu euismod nulla luctus pulvinar in at enim</a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>April 1, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong>Complete!</strong></td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Duis convallis ornare risus, sit amet tincidunt elit euismod vel</a> <span>HTML / CSS changes</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>March 8, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong>Complete!</strong></td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                      <tr>
                        <td class="task-desc"><a href="task_detailed.html">Cras eu mauris adipiscing massa porttitor </a> <span>Design &amp; UI concepts</span></td>
                        <td class="text-center"><span class="label label-danger">High</span></td>
                        <td>March 2, 2013</td>
                        <td><div class="progress progress-micro">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"><span class="sr-only">100% Complete</span></div>
                          </div></td>
                        <td><i class="icon-clock"></i> <strong>Complete!</strong></td>
                        <td class="text-center"><div class="btn-group">
                            <button type="button" class="btn btn-icon btn-success dropdown-toggle" data-toggle="dropdown"><i class="icon-cog4"></i></button>
                            <ul class="dropdown-menu icons-right dropdown-menu-right">
                              <li><a href="#"><i class="icon-quill2"></i> Edit task</a></li>
                              <li><a href="#"><i class="icon-share2"></i> Reassign</a></li>
                              <li><a href="#"><i class="icon-checkmark3"></i> Complete</a></li>
                              <li><a href="#"><i class="icon-stack"></i> Archive</a></li>
                            </ul>
                          </div></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /tasks table -->
            </div>
            <!-- /fourth tab -->
            <!-- Fifth tab -->
            <div class="tab-pane fade" id="settings">
              <!-- Profile information -->
              <form action="action/mgmtupdate.php"  method="post" enctype="multipart/form-data" class="block" role="form">
                <h6 class="heading-hr"><i class="icon-user"></i> Profile information:</h6>
                <div class="block-inner">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>First name</label>
                        <input type="text" name="first_name" value="<?php echo $listReslt[0]['first_name'];?>" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Last name</label>
                        <input type="text" name="last_name" value="<?php echo $listReslt[0]['last_name'];?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Address line 1</label>
                        <input type="text" name="address_first" value="<?php echo $listReslt[0]['address_first'];?>" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Address line 2</label>
                        <input type="text" name="address_second" value="<?php echo $listReslt[0]['address_second'];?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
					<div class="col-md-4">
                        <label>Country</label>
                        <input type="text" name="country_name" placeholder="Enter Country Name" value="<?php echo $listReslt[0]['country_name'];?>" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>State</label>
                        <input type="text" name="state_name" placeholder="Enter State Name" value="<?php echo $listReslt[0]['state_name'];?>" class="form-control">
                      </div>
						<div class="col-md-4">
                        <label>City</label>
                        <input type="text" name="city_name"  placeholder="Enter City Name" value="<?php echo $listReslt[0]['city_name'];?>" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>ZIP code</label>
                        <input type="text" name="pincode" placeholder="Enter Zip Code" value="<?php echo $listReslt[0]['pincode'];?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" name="email" readonly value="<?php echo $listReslt[0]['email'];?>" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Mobile #</label>
                        <input type="text" name="mobile" value="<?php echo $listReslt[0]['mobile'];?>" class="form-control">
                        <span class="help-block">+99-99-9999-9999</span> </div>
                      <div class="col-md-10">
                        <label>Upload profile image:</label>
                        <input type="file" name="image_name" class="styled form-control" id="report-screenshot" style="padding-bottom: 38px;">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span></div>
                    </div>
                  </div>	
                </div>
                <div class="text-right">
                  <input type="reset" value="Cancel" class="btn btn-default">
                  <input type="submit" value="Apply changes" class="btn btn-success">
                </div>
				 <input type="hidden" name="update_id" value="<?php if(isset($_REQUEST['pid'])){ echo $_REQUEST['pid'];} ?>"/>
              </form>
              <!-- /profile information -->
            </div>
            <!-- /fifth tab -->
          </div>
        </div>
        <!-- /page tabs -->
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










