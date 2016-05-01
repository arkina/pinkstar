<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
	exit();
}
include("../config/config.php");
include("include/head-inc.php");
include("include/navigation-inc.php");
?>
<!-- Page container -->
<div class="page-container">
  <!-- Content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Profile</h3>
      </div>
   </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li class="active">Profile</li>
      </ul>
    </div>
    <!-- /breadcrumbs line -->
    <!-- Profile grid -->
    <div class="row">
      <?php include("../vendor/include/profile-section.php");?>
      <div class="col-lg-10">
        <!-- Page tabs -->
        <div class="tabbable page-tabs">
          <ul class="nav nav-pills nav-justified">
            <li class="active"><a href="#activity" data-toggle="tab"><i class="icon-paragraph-justify2"></i>Company Details</a></li>
            <li><a href="#stats" data-toggle="tab"><i class="icon-stats2"></i> Reports <i class="icon-spinner7 spin pull-right"></i></a></li>
            <li><a href="#profile-messages" data-toggle="tab"><i class="icon-bubbles3"></i> Messages <span class="label label-danger">12</span></a></li>
            <li><a href="#tasks" data-toggle="tab"><i class="icon-settings"></i> Tasks <span class="label label-danger">7</span></a></li>
            <li><a href="#settings" data-toggle="tab"><i class="icon-cogs"></i> Settings</a></li>
          </ul>
          <div class="tab-content">
            <!-- First tab -->
            <div class="tab-pane active fade in" id="activity">
               <!-- Profile information -->
              <form action="#" class="block" role="form">
                <h6 class="heading-hr"><i class="icon-user"></i> Profile information:</h6>
                <div class="block-inner">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Company Name</label>
                        <input type="text" value="Eugene" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Display Name</label>
                        <input type="text" value="Kopyov" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Address line 1</label>
                        <input type="text" value="Ring street 12" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Address line 2</label>
                        <input type="text" value="building D, flat #67" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Country</label>
                        <input type="text" value="Ring street 12" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>State</label>
                        <input type="text" value="Ring street 12" class="form-control">
                      </div>
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>City</label>
                        <input type="text" value="building D, flat #67" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>ZIP code</label>
                        <input type="text" value="1031" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Alternate Email</label>
                        <input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Phone #</label>
                        <input type="text" value="+99-99-9999-9999" data-mask="+99-99-9999-9999" class="form-control">
                        <span class="help-block">+99-99-9999-9999</span> </div>
                      <div class="col-md-6">
                        <label>Upload Logo image:</label>
                        <input type="file" class="styled form-control" id="report-screenshot">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span></div>
                    </div>
                  </div>
                </div>
                <div class="text-right">
                  <input type="reset" value="Cancel" class="btn btn-default">
                  <input type="submit" value="Apply changes" class="btn btn-success">
                </div>
              </form>
              <!-- /profile information -->
             
            </div>
            <!-- /first tab -->
            <!-- Second tab -->
            <div class="tab-pane fade" id="stats">
              
            </div>
            <!-- /second tab -->
            <!-- Third tab -->
            <div class="tab-pane fade" id="profile-messages">
              
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
              <form action="#" class="block" role="form">
                <h6 class="heading-hr"><i class="icon-user"></i> Profile information:</h6>
                <div class="block-inner">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>First name</label>
                        <input type="text" value="Eugene" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Last name</label>
                        <input type="text" value="Kopyov" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Address line 1</label>
                        <input type="text" value="Ring street 12" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Address line 2</label>
                        <input type="text" value="building D, flat #67" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <label>City</label>
                        <input type="text" value="Munich" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>State/Province</label>
                        <input type="text" value="Bayern" class="form-control">
                      </div>
                      <div class="col-md-4">
                        <label>ZIP code</label>
                        <input type="text" value="1031" class="form-control">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Email</label>
                        <input type="text" readonly="readonly" value="eugene@kopyov.com" class="form-control">
                      </div>
                      <div class="col-md-6">
                        <label>Your country:</label>
                        <select data-placeholder="Choose a Country..." class="select-full" tabindex="2">
                          <option value=""></option>
                          <option value="Cambodia">Cambodia</option>
                          <option value="Cameroon">Cameroon</option>
                          <option value="Canada">Canada</option>
                          <option value="Cape Verde">Cape Verde</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Phone #</label>
                        <input type="text" value="+99-99-9999-9999" data-mask="+99-99-9999-9999" class="form-control">
                        <span class="help-block">+99-99-9999-9999</span> </div>
                      <div class="col-md-6">
                        <label>Upload profile image:</label>
                        <input type="file" class="styled form-control" id="report-screenshot">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span></div>
                    </div>
                  </div>
                </div>
                <h6 class="heading-hr"><i class="icon-lock"></i> Security information:</h6>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Username:</label>
                      <input type="text" value="Kopyov" readonly="readonly" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label>Current password:</label>
                      <input type="password" value="password" readonly="readonly" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>New password:</label>
                      <input type="password" placeholder="Enter new password" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label>Repeat password:</label>
                      <input type="password" placeholder="Repeat new password" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row">
                    <div class="col-md-6">
                      <label>Profile visibility: </label>
                      <div class="radio">
                        <label>
                          <input type="radio" name="visibility" class="styled" checked="checked">
                          Visible to everyone</label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="visibility" class="styled">
                          Visible to friends only</label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="visibility" class="styled">
                          Visible to my connections only</label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="visibility" class="styled">
                          Visible to my colleagues only</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Notifications: </label>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" class="styled" checked="checked">
                          Password expiration notification</label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" class="styled" checked="checked">
                          New message notification</label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" class="styled" checked="checked">
                          New task notification</label>
                      </div>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" class="styled">
                          New contact request notification</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-right">
                  <input type="reset" value="Cancel" class="btn btn-default">
                  <input type="submit" value="Apply changes" class="btn btn-success">
                </div>
              </form>
              <!-- /profile information -->
            </div>
            <!-- /fifth tab -->
          </div>
        </div>
        <!-- /page tabs -->
      </div>
    </div>
    <!-- /profile grid -->

<?php include('include/footer-inc.php')?>
