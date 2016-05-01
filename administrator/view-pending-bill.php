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
if($_SESSION['login_as'] == '1'){
$viewEmplist = "select id,form_id,bill_upload_date,discount_amount,star_type,bill_url,bill_amount from ps_client_bill";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
	//echo "<pre>";print_r($listReslt);die;
}else{
	echo "hello";die;
	//$viewEmplist = "select * from ps_api";
	//$listReslt = $ObjCurd->runQueryList($viewEmplist);
}
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
                <h3>New Bill<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="bill-management.php">Bill Management</a></li>
                    <li class="active">Pending Bill List</li>
                </ul>
            </div>
           
            <!-- END PAGE BREADCRUMBS -->
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
						
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="panel panel-default">
                <div class="panel-heading">
                   <h6 class="panel-title">View Biller List</h6>
                </div>
                <div class="panel-body">
                  <div class="datatable">
                      <table class="table">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Client Name</th>
                                  <th>Vendor Nmae</th>
                                  <th>Update On</th>
                                  <th>Discount</th>
                                  <th>Options</th>
                              </tr>
                          </thead>
              						<tbody>
						<?php foreach($listReslt as $key => $ArrVal){
								$getNameQuery="select first_name,last_name from ps_client where id ='".$ArrVal['id']."'";
								$listResltName = $ObjCurd->runQueryList($getNameQuery);
						#echo "<pre>";print_r($listResltName);
								$getVendorName ="select company_display_name from ps_vendor where unique_id='".$ArrVal['form_id']."'";
							$listVendorName = $ObjCurd->runQueryList($getVendorName);
						#echo "<pre>";print_r($listVendorName);
										?>
						     <tr>
                              <td>a</td>
                              <td><?=ucfirst($listResltName[0]['first_name']).' '.$listResltName[0]['last_name'];?></td>
                              <td><?=$listVendorName[0]['company_display_name'];?></td>
                              <td><?=$ArrVal['bill_upload_date'];?></td>
								 <?php if(!empty($ArrVal['discount_amount']) && $ArrVal['discount_amount']!=""){ ?>
                              <td><?=$ArrVal['discount_amount'].' ';?><?if($ArrVal['star_type']=="precentage"){ echo "%";}else { echo $ArrVal['star_type'];}?></td>
                              	<?php }else{ ?>
								 <td>No Discount</td>
								 <? } ?>
							<td><a data-toggle="modal" role="button" href="#modal<?=$ArrVal['id'];?>" class="btn btn-default btn-xs btn-icon"><i class="icon-pencil"></i></a></td>
                          	<?php } ?>
						  </tbody>
                        </table>
                  </div>
                </div>
            </div>
<?php foreach($listReslt AS $mod){?>
    <div id="modal<?=$mod['id'];?>" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Update Country</h4>
          </div>
          <div class="panel-body">
          <form class="form-horizontal" method='post' action="action/update-list-bill.php">
            <div class="form-group">
              <div class="row">
              <div class="col-md-8">
                  <img src="<?=$mod['bill_url'];?>" />
              </div>
              <div class="col-md-4">
                  <div class="col-md-12">
                    <label>Upload Time</label>
                    <label><?=$mod['bill_upload_date'];?></label>
                  </div>
                  <div class="col-md-12">
                  <label> bill time</label>
                  <input type="date" name="emp_status_update" class="form-control">
                </div>
                <div class="col-md-12">
                  <label>Bill Ammount</label>
                  <input class="form-control" type="text" name="bill_amount" value="<?=$mod['bill_amount'];?>">
                  </div>
                <div class="col-md-12">
                  <label>Bill Status</label>
                  <select class="form-control" name="emp_status">
                    <option value="reject">Reject</option>
                    <option value="approved">Approved</option>
                  </select>
                  </div>
                <div class="col-md-12">
                  <label>Comment</label>
                  <input class="form-control" type="text" name="emp_note">
                </div>
              </div>
            </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update changes</button>
          </div>
			  <input type="hidden" name="id" value="<?=$mod['id'];?>" />
			  <input type="hidden" name="discount_amount" value="<?=$mod['discount_amount'];?>" />
			  <input type="hidden" name="discount_type" value="<?=$mod['star_type'];?>" />
          </form>
        </div>
      </div>
    </div>
            <!-- END PAGE CONTENT INNER -->
        </div>
<?php } ?>
    </div>
    <!-- END PAGE CONTENT BODY -->
</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
        
<?php include('include/footer-inc.php')?>