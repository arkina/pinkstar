<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
include("../curd/curd.php");
include('./include/head-inc.php');include('./include/navigation-inc.php');
$ObjCurd = new Curd();
$viewEmplist = "select id,page_title from ps_page  where page_status=1 order by page_title ASC";
$listReslt = $ObjCurd->runQueryList($viewEmplist);

if(isset($_REQUEST['cat'])){ $catid = str_replace('pink',"",base64_decode($_REQUEST['cat']));}

$getDetails ="select * from ps_designation where id ='".$catid."'";
$listResltDetails = $ObjCurd->runQueryList($getDetails);
$accessRignt = explode(',', $listResltDetails[0]['access']);
#echo "<pre>";
#print_r($accessRignt );die;

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
?>
<!-- /alert -->
    <form class="form-horizontal" id="leadregs" action="action/update-designation.php" method="post">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h6 class="panel-title">Add / Edit New Designation</h6>
            </div>
            <div class="panel-body">
            	<div class="form-group">
                	<label class="col-md-1 control-label">Designation Name</label>
                    <div class="col-md-11">
                    	<input type="text" name="designation_name" value="<?php echo $listResltDetails[0]['designation_name']; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-1 control-label">Designation Description</label>
                    <div class="col-md-11">
                    	<textarea name="description" class="form-control"><?php echo htmlentities($listResltDetails[0]['description']); ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                	<label class="col-md-1 control-label">Roles and duty</label>
                    <div class="col-md-11">
                    	<textarea name="role" class="form-control"><?php echo htmlentities($listResltDetails[0]['role']); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                	<label class="col-md-1 control-label">Access</label>
                    <div class="col-md-11">
                    	<div class="row">
                        	<div class="col-md-12">
                            	<?php
                                foreach($listReslt AS $key => $result){ 
								?>
                            	<div class="col-md-3">
                                	<label class="checkbox-inline">
                                      <input type="checkbox" <?php if(in_array($result['id'], $accessRignt)){ echo "checked='checked'";} ?> class="styled" name="acc[]" value="<?php echo $result['id'];?>">
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
                	<button type="submit" class="btn btn-success" value="Register">Update</button>
                </div>
              </div>
            </div>
            </div>
		<input type="hidden" name="catid" value="<?php if(isset($_REQUEST['cat'])){ echo str_replace("'","",$_REQUEST['cat']);} ?>"/>
		<input type="hidden" name="pid" value="<?php if(isset($_REQUEST['pid'])){ echo str_replace("'","",$_REQUEST['pid']);} ?>"/>
     </form>
<script src="../ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'description' );
	CKEDITOR.replace( 'role' );
</script>

<?php include('./include/footer-inc.php');?>
