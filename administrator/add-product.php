<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == '' && $_SESSION['userid']==""){
    header('Location: login.php');
	exit();
}
include('../config/config.php');
include("../curd/curd.php");
include('./include/head-inc.php');include('./include/navigation-inc.php');
$ObjCurd = new Curd();
$pcv = "SELECT * FROM `ps_categories` WHERE `parent_id` = '0' AND `status` = '1' ORDER BY `category_name` ASC";
$parent_data = $ObjCurd->runQueryList($pcv);
// for Region:-
$viewRegion = "select id,region_name from ps_region order by id ASC";
$listRegion = $ObjCurd->runQueryList($viewRegion);
//product Images
$pcv = "SELECT * FROM `ps_product_image` WHERE `product_id` = '".base64_decode($_REQUEST['product_id'])."'";
$pnt_data = $ObjCurd->runQueryList($pcv);
//product Details
$pr = "SELECT * FROM `ps_product` WHERE `product_id` = '".base64_decode($_REQUEST['product_id'])."'";
$product_data = $ObjCurd->runQueryList($pr);
$prdt = $product_data[0];
function catName($cat_id){
	$ObjCurd = new Curd();
	$vcl = "SELECT * FROM `ps_categories` WHERE `status` = '1' AND `cat_id` = '".$cat_id."'";
	$rcl = $ObjCurd->runQueryList($vcl);
	return ucfirst($rcl[0]['category_name']);
}
?>
<!-- Page container -->

<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3>Add New Product<small></small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.php">Home</a></li>
        <li>Add Product</li>
      </ul>
      <div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
    </div>
    <!-- /breadcrumbs line -->
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
        <h6 class="panel-title">Add Product Form</h6>
      </div>
      <div class="panel-body">
        <form class="form-horizontal" id="empregs" action="action/add-product.php" enctype="multipart/form-data" method="post">
          <h3 class="text-success">Product Information</h3>
          <hr>
          <div class="form-group">
            <label class="control-panel col-md-2">Product Name</label>
            <div class="col-md-4">
			 <input type="hidden" id="product_id" name="product_id" value="<?php if($prdt['product_id']){ echo $prdt['product_id'];}?>" />
              <input type="text" id="product_name" name="product_name"  required  title="Name Should not be Blank!"  value="<?php if($prdt['name']){ echo $prdt['name'];}?>" class="form-control" />
              <span class="error" id="fname_error" style="color: red"></span> </div>
            <label class="control-panel col-md-2">Select Category</label>
            <div class="col-md-4">
              <select class="form-control" id="cat_id" required name="cat_id" style="width:100%;">
                <option value="">Select Category</option>
               <?php  if(count($parent_data) > 0){
					 foreach($parent_data as $catD){
					 if($catD['cat_id'] == $prdt['category_id']){ $sel = 'selected="selected"';}else{ $sel = "";}
					  ?>
              <option value="<?=$catD['cat_id'];?>" <?=$sel;?>><?=ucfirst($catD['category_name']); ?></option>
              <?php }}?>
              </select>
              <span class="lname_error" id="lname_error" style="color: red"></span> </div>
          </div>
          <div class="form-group">
            <label class="control-panel col-md-2">Select Sub Category</label>
            <div class="col-md-4">
              <select class="form-control" id="sub_cat_id"  name="sub_cat_id" style="width:100%;">
			  <?php if($prdt['sub_category_id']){?><option selected="selected" value="<?=$prdt['sub_category_id'];?>"><?=catName($prdt['sub_category_id']);?></option><?php }?>
                <option value="">Select Sub Category</option>
              </select>
              <span class="email_error" id="email_error" style="color: red"></span> </div>
            <label class="control-panel col-md-2">Price</label>
            <div class="col-md-4">
              <input type="text" id="price" required name="price" pattern="[0-9]*" title="Enter only Numbers" value="<?php if($prdt['price']){ echo $prdt['price'];}?>" class="form-control" />
              <span class="username_error" id="username_error" style="color: red"></span> </div>
          </div>
          <div class="form-group">
            <label class="control-panel col-md-2">Discount Price</label>
            <div class="col-md-4">
              <input type="text" name="discount_price" id="discount_price" pattern="[0-9]*" title="Enter only Numbers" class="form-control" value="<?php if($prdt['discount_price']){ echo $prdt['discount_price'];}?>" />
              <span class="userpassword_error" id="dis_price_error" style="color: red"></span> </div>
			  <label class="control-panel col-md-2">Product Quantity</label>
            <div class="col-md-4">
              <input type="text" name="product_quantity" pattern="[0-9]*" title="Enter only Numbers" id="product_quantity" required class="form-control" value="<?php if($prdt['product_quantity']){ echo $prdt['product_quantity'];}?>" /> </div>
			  </div>
			  <div class="form-group"> 
            <label class="control-panel col-md-2">Status</label>
            <div class="col-md-4">
              <select class="form-control" id="status" required name="status" style="width:100%;">
                <option value="">Select Status</option>
                <option value="1" <?php if($prdt['status'] == 1){ echo 'selected="selected"'; }?> >Active</option>
                <option value="0" <?php if($prdt['status'] == 0){ echo 'selected="selected"'; }?>>Inactive</option>
              </select>
              <span class="cpassword_error" id="status_error" style="color: red"></span> </div>
          </div>
          <div class="form-group">
            <label class="control-panel col-md-2">Description</label>
            <div class="col-md-12">
              <textarea name="product_description" id="product_description" class="form-control" ><?php if($prdt['description']){ echo $prdt['description'];}?></textarea>
              <span class="post_position_error" id="product_description_error" style="color: red"></span> </div>
          </div>
          <h3 class="text-success">Product Images</h3>
          <hr />
          <div class="form-group">
            <label class="control-panel col-md-2">Product Images</label>
            <div class="col-md-10">
              <input type="file"  name="product_images[]" multiple="multiple" id="product_images" />
            </div>
			<div class="row col-md-12">
			<?php if(count($pnt_data) > 0 ){
			foreach($pnt_data as $image){
			?>
			<div class="col-md-2" id="row_<?=$image['product_image_id'];?>">
			<img src="../uploads/product/<?=$image['image']?>" alt="Product Image" style="padding:10px; width:100%; border:1px solid #ddd;" />
			<a href="#" onclick="return deleteData(<?=$image['product_image_id'];?>)">X</a>
			</div>
			<?php }} ?>
			</div>
          </div>
          <div class="panel-footer">
            <div class="form-group">
              <div class="col-md-10">
                <input type="submit" name="product_submit" class="success" value="Submit">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include('./include/footer-inc.php');?>
<script>
$(document).ready(function(){
$('#cat_id').change(function(){
var cat_id = $(this).val();
	$.ajax({
		type: "POST",
		url: "get_sub_category.php",
		data: 'cat_id='+cat_id, 
		cache: false,
		success: function(html) {
			$('#sub_cat_id').html(html);
		}
	});
})
})

function deleteData(rid){
	var conf = confirm("Are you Sure do you to deleted this Image");
	if(conf == true){
	var tblname = 'ps_product_image';
	var tblcol = 'product_image_id';
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