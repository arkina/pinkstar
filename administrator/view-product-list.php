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
$viewCatlist = "SELECT * FROM `ps_product` ORDER BY `name` ASC";
$listReslt = $ObjCurd->runQueryList($viewCatlist);
function catName($cat_id){
	$ObjCurd = new Curd();
	$vcl = "SELECT * FROM `ps_categories` WHERE `status` = '1' AND `cat_id` = '".$cat_id."'";
	$rcl = $ObjCurd->runQueryList($vcl);
	return ucfirst($rcl[0]['category_name']);
}
if($_GET['product_id']!=""){
	$pcv1 = "SELECT * FROM `ps_product` WHERE `product_id` = '".base64_decode($_GET['product_id'])."'";
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
          <h3>Product List<small>Welcome
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
          <li class="active">Product List</li>
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

    <!-- /alert -->
    <!-- BEGIN PAGE CONTENT INNER -->
    <div class="panel panel-default">
      <div class="panel-heading">
        <h6 class="panel-title">View Product List</h6>
      </div>
      <div class="datatable">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Product Name </th>
              <th>Category </th>
			  <th>Sub Category</th>			  
              <th>Product Price</th>
			  <th>Discont Price</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $count =1;
					if(count($listReslt) > 0){
                  	foreach ($listReslt as $key => $listArr){ ?>
            <tr id="row_<?=$listArr['product_id'];?>">
              <td><?=$count;?></td>
              <td><?=ucfirst($listArr['name']);?></td>
              <td><?=catName($listArr['category_id']);?></td>
			  <td><?=catName($listArr['sub_category_id']);?></td>
			  <td><?=$listArr['price'];?></td>
			  <td><?=$listArr['discount_price'];?></td>
              <td><?php if($listArr['status']==1){ echo "Active";}else{ echo "Inactive";}?>
                </td>
              <td><a data-toggle="modal" role="button" href="add-product.php?product_id=<?=base64_encode($listArr['product_id']);?>" class="btn btn-default btn-xs btn-icon"><i class="fa fa-pencil" aria-hidden="true"></i> </a> <a data-toggle="modal" role="button" onclick="return deleteData(<?=$listArr['product_id'];?>)" href="#" class="btn btn-default btn-xs btn-icon"><i class="fa fa-trash" aria-hidden="true"></i> </a> </td>
            </tr>
            <?php $count++; } }else{?>
			<tr><td colspan="8">No records Found!</td></tr>
			<?php } ?>
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
	var tblname = 'ps_product';
	var tblcol = 'product_id';
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