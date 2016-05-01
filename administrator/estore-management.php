<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] == ''){
    header('Location: login.php');
}
include("../curd/curd.php");
include("./include/head-inc.php");
include("./include/navigation-inc.php");
$ObjCurd = new Curd();
//Get Category Data
$viewCatlist = "SELECT * FROM `ps_categories` WHERE `status` = '1' ORDER BY `cat_id` limit 0,5";
$catlistReslt = $ObjCurd->runQueryList($viewCatlist);
//Get product data
$getProductList ="SELECT * FROM `ps_product` WHERE `status` = '1' ORDER BY `product_id` limit 0,5";
$productListReslt = $ObjCurd->runQueryList($getProductList);
function catName($cat_id){
	$ObjCurd = new Curd();
	$vcl = "SELECT * FROM `ps_categories` WHERE `status` = '1' AND `cat_id` = '".$cat_id."'";
	$rcl = $ObjCurd->runQueryList($vcl);
	return ucfirst($rcl[0]['category_name']);
}
//catName(1);
?>
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
        <h3>Estore Management <small>Welcome
          <?=ucfirst($_SESSION['username']);?>
          </small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.php">Dashboard</a></li>
        <li class="active">Estore Management</li>
      </ul>
    </div>
    <!-- /breadcrumbs line -->
    <!-- Grid buttons -->
    <div class="info-buttons">
      <div class="col-lg-12">
        <div class="row block-inner">
          <div class="row block">
            <div class="col-md-2"><a href="view-product-category-list.php"><i class="icon-list"></i><span>Category List</span></a></div>
            <div class="col-md-2"><a href="view-product-list.php"><i class="icon-puzzle"></i> <span>Product List</span></a></div>
            <div class="col-md-2"><a href="add-product.php"><i class="icon-tags"></i> <span>Add New Product</span></a></div>
          </div>
        </div>
      </div>
      <!-- /grid buttons -->
    </div>
    <!-- END PAGE CONTENT BODY -->
    <div class="row">
      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h6 class="panel-title">Ctegories</h6>
            <h6 class="panel-title pull-right"><a href="view-product-category-list.php">View All</a></h6>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Category Name</th>
                  <th>Parent Category Name</th>
                </tr>
              </thead>
              <tbody>
                <?php $count=1;
				/*echo '<pre>';
				print_r($catlistReslt);
				exit();*/
				foreach ($catlistReslt as $key => $listArr){ ?>
                <tr>
                  <td><?=$count;?></td>
                  <td><?=ucfirst($listArr['category_name']);?></th>
                  <td><?php if($listArr['parent_id']!=0){ echo catName($listArr['parent_id']);}else{ echo 'No Parent'; }?></th>
                </tr>
                <?php $count++; }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h6 class="panel-title">Product</h6>
            <h6 class="panel-title pull-right"><a href="view-product-list.php">View All</a></h6>
          </div>
          <div class="panel-body">
            <table class="table">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Product Name</th>
                  <th>Category Name</th>
                </tr>
              </thead>
              <tbody>
                <?php $count=1;
					foreach ($productListReslt as $key => $listArr){ ?>
                <tr>
                  <td><?php echo $count; ?></td>
				   <td><?php echo $listArr['name']; ?></td>
				    <td><?php echo catName($listArr['category_id']); ?></td>
                </tr>
                <?php $count++;}?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- END CONTENT BODY -->
  </div>
  <!-- END CONTENT -->
  <!-- BEGIN QUICK SIDEBAR -->
</div>
<?php include('./include/footer-inc.php')?>
