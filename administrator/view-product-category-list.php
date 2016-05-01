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
$viewCatlist = "SELECT * FROM `ps_categories` ORDER BY `category_name` ASC";
$listReslt = $ObjCurd->runQueryList($viewCatlist);
function catName($cat_id){
	$ObjCurd = new Curd();
	$vcl = "SELECT * FROM `ps_categories` WHERE `status` = '1' AND `cat_id` = '".$cat_id."'";
	$rcl = $ObjCurd->runQueryList($vcl);
	return ucfirst($rcl[0]['category_name']);
}
$pcv = "SELECT * FROM `ps_categories` WHERE `parent_id` = '0' AND `status` = '1' ORDER BY `category_name` ASC";
$parent_data = $ObjCurd->runQueryList($pcv);
if($_GET['cat_id']!=""){
	$pcv1 = "SELECT * FROM `ps_categories` WHERE `cat_id` = '".base64_decode($_GET['cat_id'])."'";
	$sel_data = $ObjCurd->runQueryList($pcv1);
}
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
<style>
    .dt-buttons{
        display: none;
    }
	.form-horizontal.cat-form {
    padding: 20px;
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
          <h3>Category List<small>Welcome
            <?=ucfirst($_SESSION['username']);?>
            </small></h3>
        </div>
      </div>
      <!-- END PAGE HEAD-->
      <!-- BEGIN PAGE BREADCRUMBS -->
      <div class="breadcrumb-line">
        <ul class=" breadcrumb">
          <li><a href="index.php">Home</a></li>
          <li><a href="estore-management.php">Estore Management</a></li>
          <li class="active">Category List</li>
        </ul>
      </div>
      <!-- END PAGE BREADCRUMBS -->
      <!-- Alert -->
      <div id="hide">
        <?php if(isset($_SESSION['error']) && $_SESSION['error']!=''){?>
        <div class="alert alert-danger fade in block-inner">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <i class="icon-cancel-circle"></i> <?php echo $_SESSION['error'];?> </div>
        <?php }?>
        <?php if(isset($_SESSION['success']) && $_SESSION['success']!=''){?>
        <div class="alert alert-success fade in block-inner">
          <button type="button" class="close" data-dismiss="alert">×</button>
          <i class="icon-checkmark-circle"></i> <?php echo $_SESSION['success']; ?> </div>
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
      <div class="panel panel-default">
      <div class="panel-heading">
        <h6 class="panel-title">View Category List</h6>
      </div>
      <form class="form-horizontal cat-form" method='post' enctype="multipart/form-data" action="action/add-product-category.php">
        <div class="form-group row">
          <div class="col-md-2">
            <select name="parent_id" class="form-control" id="parent_id" style="width:100%;">
              <option value="">-----Select Parent----</option>
              <?php  if(count($parent_data) > 0){
					 foreach($parent_data as $catD){
					 if($catD['parent_id'] == $sel_data[0]['parent_id']){ $sel = 'selected="selected"';}else{ $sel = "";}
					  ?>
              <option value="<?=$catD['cat_id'];?>" <?=$sel;?>><?=ucfirst($catD['category_name']); ?></option>
              <?php }}?>
            </select>
          </div>
          <div class="col-md-2">
            <input type="text" name="category_name" required class="form-control" value="<?=$sel_data[0]['category_name'];?>" placeholder="Category Name" />
            <input type="hidden" name="cat_id" value="<?=$sel_data[0]['cat_id'];?>" />
          </div>
          <div class="col-md-2">
            <input type="file" name="cat_image" class="form-control" value="<?=$mod['name'];?>" />
          </div>
          <div class="col-md-2">
            <select class="form-control" id="status" required name="status" style="width:100%;">
              <option value="">Select Status</option>
              <option value="1" <?php if($sel_data[0]['status'] == 1){ echo 'selected="selected"'; }?> >Active</option>
              <option value="0" <?php if($sel_data[0]['status'] == 0){ echo 'selected="selected"'; }?>>Inactive</option>
            </select>
          </div>
          <div class="col-md-2">
            <input type="submit" class="btn btn-primary" name="submit_category" value="Add Category" />
          </div>
        </div>
        </div>
      </form>
    <!-- /alert -->
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h6 class="panel-title">View Category List</h6>
      </div>
      <div class="datatable">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name of Category </th>
              <th>Parent Category </th>
              <th>Category Image</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $count =1;
                  	foreach ($listReslt as $key => $listArr){ ?>
            <tr id="row_<?=$listArr['cat_id'];?>">
              <td><?=$count;?></td>
              <td><?=ucfirst($listArr['category_name']);?></td>
              <td><?php if($listArr['parent_id']!=0){ echo catName($listArr['parent_id']);}else{ echo 'No Parent'; }?></td>
              <td><img src="../uploads/category/<?=$listArr['category_image'];?>" width="100" height="50" alt="<?=ucfirst($listArr['category_name']);?>" /></td>
              <td><?php if($listArr['status']==1){ echo "Active";}else{ echo "Inactive";}?>
                </th>
              <td><a data-toggle="modal" role="button" href="?cat_id=<?=base64_encode($listArr['cat_id']);?>" class="btn btn-default btn-xs btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i> </a> <a data-toggle="modal" role="button" href="#" onclick="return deleteData(<?=$listArr['cat_id'];?>)" class="btn btn-default btn-xs btn-icon"><i class="fa fa-trash" aria-hidden="true"></i> </a> </td>
            </tr>
            <?php $count++; }?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- END PAGE CONTENT INNER -->
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
<script>
function deleteData(rid){
	var conf = confirm("Are you Sure do you to deleted this records");
	if(conf == true){
	var tblname = 'ps_categories';
	var tblcol = 'cat_id';
	$.ajax({
		type: "POST",
		url: "delete_record.php",
		data: 'table_name='+tblname+'&table_col_name='+tblcol+'&table_col_value='+rid, 
		cache: false,
		success: function(html) {
			$('#row_'+rid).remove();
		}
	});
		return false;
	}else{
		return false;	
	}
}
</script>