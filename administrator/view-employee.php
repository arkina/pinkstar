<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
#print_r($_SESSION);
error_reporting(E_ALL);
ini_set('display_errors', 0);
include('../config/config.php');include('./include/head-inc.php');include('./include/navigation-inc.php');
include '../curd/curd.php';
$curdObj = new Curd();
$viewEmplist = "select id,fname,register_on,depart,status from ".pu." order by register_on desc";
$listReslt = $curdObj->runQueryList($viewEmplist);
//print_r($listReslt);
//echo "hello";die;
?>
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Employee Lists <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="employee-management.php">Employee Management</a></li>
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
    
    <div class="panel panel-default">
      <div class="panel-heading">
          <h6 class="panel-title">View Employee List</h6>
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
                  		if($keyval!="status" && $keyval!="id"){
								if($value =='select'){
									$value = 'Not Selected';
								}if($keyval == "fname"){ if($value ==""){ $value='Not Found';}}?>
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