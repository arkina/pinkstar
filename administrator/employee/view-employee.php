<?php
include('../../config/config.php');include('../include/head-inc.php');include('../include/navigation-inc.php');
include '../../curd/curd.php';
$curdObj = new Curd();
$viewEmplist = "select id,fname,register_on,depart,status from ".pu." order by register_on desc";
$listReslt = $curdObj->runQueryList($viewEmplist);
//print_r($listReslt);
?>
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Horizontal navigation <small>Horizontal navigation layout example</small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><a href="horizontal_navigation.html">Layouts</a></li>
      </ul>
      <div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
    </div>
    <!-- /breadcrumbs line -->
    <!-- Callout -->
    <div class="callout callout-success fade in">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <h5>Horizontal navigation layout</h5>
      <p>Page layout example with horizontal navigation, placed on top inside navbar.</p>
    </div>
    <!-- /callout -->
    
    
    <div class="panel panel-default">
      <div class="panel-heading">
          <h6 class="panel-title">View Department List</h6>
      </div>
      <div class="datatable">
          <table class="table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Emplyee Name</th>
                      <th>Joining Date</th>
                      <th>Department</th>
                      <th>Options</th>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                  $count =1;
                  foreach ($listReslt as $key => $listArr){ ?>
                  	<tr>
                  	<td><?php echo $count;?></td>
                  	<?php foreach ($listArr as $keyval => $value){ 
                  		if($keyval!="status" && $keyval!="id"){?>
                      		<td><?php echo ucfirst($value);?></td>
                      			<?php } }?>
                      			<?php if($listArr['status']!= 2){ ?>
             	<td><buton type="button" id="<?php echo $listArr['id'];?>" class="btn btn-success btnshow"><i class="icon-check"></i></button></td>
             				<?php }else {?>
             				<td><buton type="button" id="<?php echo $listArr['id']?>" class="btn btn-danger btnhide"><i class="icon-check"></i></button></td>
             				<?php }?>
                          <?php $count++;}?>
                      </td>
                  </tr>
               </tbody>
          </table>
      </div>
  </div>
    <?php include('../include/footer-inc.php');?>