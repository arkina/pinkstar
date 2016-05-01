<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
include("../curd/curd.php");
include('./include/head-inc.php');include('./include/navigation-inc.php');
$ObjCurd = new Curd();
$viewEmplist = "select id,page_title from ps_page where page_status=1 order by page_title ASC";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
?>
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Add / Edit Designation <small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="view-department.php">View Department</a></li> 
        <li><a href="view-designation.php?cat=<?=$_GET['cat']?>">View Designation</a></li>        
        <li class="active">Add / Edit New Lead</li>
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

#echo "<pre>"; print_r($_REQUEST);die;
?>
<!-- /alert -->
    <form class="form-horizontal" id="leadregs" action="action/add-designation.php" method="post">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h6 class="panel-title">Add / Edit New Designation</h6>
            </div>
            <div class="panel-body">
            	<div class="form-group">
                	<label class="col-md-1 control-label">Designation Name</label>
                    <div class="col-md-11">
                    	<input type="text" name="designation_name" value="<?php if($_REQUEST['designation_name']){ echo $_REQUEST['designation_name'];} ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-1 control-label">Designation Description</label>
                    <div class="col-md-11">
                    	<textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                	<label class="col-md-1 control-label">Roles and duty</label>
                    <div class="col-md-11">
                    	<textarea name="role" class="form-control"></textarea>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-1 control-label">Access</label>
                    <div class="col-md-11">
                    	<div class="row">
                        	<div class="col-md-12">
                            	<?php
                                foreach($listReslt AS $result)
								{
								?>
                            	<div class="col-md-3">
                                	<label class="checkbox-inline">
                                      <input type="checkbox" class="styled" name="acc[]" value="<?php echo $result['id'];?>">
                                     <?php echo $result['page_title'];?></label>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="panel-footer">
              <div class="form-group">
              	<div class="col-md-offset-10">
                	<button type="submit" class="btn btn-success" value="Register">Add Designation</button>
                </div>
              </div>
            </div>
            </div>
		<input type="hidden" name="catid" value="<?php if(isset($_REQUEST['cat'])){ echo $_REQUEST['cat'];} ?>"/>
     </form>
<script src="../ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'description' );
	CKEDITOR.replace( 'role' );
</script>

<?php include('./include/footer-inc.php');?>
