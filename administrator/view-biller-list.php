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
$viewEmplist = "select * from ps_api";
$listReslt = $ObjCurd->runQueryList($viewEmplist);
}else{
	$viewEmplist = "select * from ps_api";
	$listReslt = $ObjCurd->runQueryList($viewEmplist);
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
                <h3>Biller List<small>Welcome <?=ucfirst($_SESSION['username']);?> </small></h3>
              </div>
            </div>
         <!-- END PAGE HEAD-->
             
            <!-- BEGIN PAGE BREADCRUMBS -->
            <div class="breadcrumb-line">
               <ul class=" breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="settings.php">Settings</a></li>
                    <li class="active">Biller List</li>
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
                    <h6 class="panel-title pull-right"><a data-toggle="modal" role="button" href="#default-modal">Add Biller</a></h6>
                </div>
                <div class="panel-body">
                <div class="datatable">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Biller</th>
                                <th>Category</th>
                                <th>Options</th>
                            </tr>
                        </thead>
						<tbody>
							<?php $count =1;
                  	foreach ($listReslt as $listArr){ ?>
                      <tr>
        								<td><?php echo $count;?></td>
                         <td><?php echo $listArr['biller'];?></td>
                         <td><?php echo $listArr['category'];?></td>
                         <td><a data-toggle="modal" role="button" href="#default-modal<?=$listArr['id'];?>">Edit</a></td>
                      </tr>
					             <?php $count++; }?>	
                        </tbody>
                    </table>
                </div>
              </div>
            </div>

            <!-- END PAGE CONTENT INNER -->
        </div>
    </div>
    <!-- END PAGE CONTENT BODY -->
    <!-- Default modal -->
    <div id="default-modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add Biller</h4>
          </div>
          <!-- New invoice template -->
          <div class="modal-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <form id="addbiller" action="action/addbiller.php" method="post">
                  <div class="form-group">
                    <label>Biller Name</label>  
                        <input type="text" class="form-control" name="biller" id="biller">
                  </div>
                  <div class="form-group">
                    <label>Biller Category</label>
                     <select class="form-control" id="category" name="category">
                      <option value="select">--Select One--</option>
					  <option value="Mobile Postpaid">Mobile Postpaid</option>
					  <option value="Electricity Bill Pay">Electricity Bill Pay</option>
				    </select>
                  </div>
                  <div class="form-group">
                    <label>Biller Verification</label>  
                        <input type="text" class="form-control" id="verification" name="verification">
                  </div>
                  <div class="form-group">
                    <label>Biller Transaction</label>  
                        <input type="text" class="form-control" id="payment" name="payment">
                  </div>
                  <div class="form-group">
                    <label>Biller Status</label>  
                        <input type="text" class="form-control" id="status" name="status">
                  </div>
                  <div class="form-group">
                    <label>Note</label>  
                        <textarea class="form-control" id="note" name="note"></textarea>
                  </div>
              </div>
            </div>
          </div>
          <!-- /new invoice template -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
       </form>
        </div>
      </div>
    </div>
    <!-- /default modal -->

    <!-- Default modal -->
    <?php foreach($listReslt AS $mod){?>
    <div id="default-modal<?=$mod['id'];?>" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Update Biller</h4>
          </div>
          <!-- New invoice template -->
          <div class="modal-body">
            <div class="panel panel-default">
              <div class="panel-body">
                <form  method='post' action="action/update-biller.php">
                  <div class="form-group">
                    <label>Biller Name</label>  
                         <input type="text" class="form-control" id="biller" name="biller" value="<?=$mod['biller'];?>">
                  </div>
                  <div class="form-group">
                    <label>Biller Category</label> 
                      <select class="form-control" id="category" name="category">
                      <option value="select">--Select One--</option>
          					  <option value="Mobile Postpaid"<?=$mod['category'] == 'Mobile Postpaid' ? ' selected="selected"' : '';?>>Mobile Postpaid</option>
          					  <option value="Electricity Bill Pay"<?=$mod['category'] == 'Electricity Bill Pay' ? ' selected="selected"' : '';?>>Electricity Bill Pay</option>
          				    </select>
                  </div>
                  <div class="form-group">
                    <label>Biller Verification</label>  
                        <input type="text" class="form-control" id="verification" name="verification" value="<?=$mod['verification'];?>">
                  </div>
                  <div class="form-group">
                    <label>Biller Transaction</label>  
                        <input type="text" class="form-control" id="payment" name="payment" value="<?=$mod['payment'];?>">
                  </div>
                  <div class="form-group">
                    <label>Biller Status</label>  
                        <input type="text" class="form-control" id="status" name="status" value="<?=$mod['status'];?>">
                  </div>
                  <div class="form-group">
                    <label>Note</label>  
                        <textarea class="form-control" id="note" name="note"><?=$mod['note'];?></textarea>
                  </div>
              </div>
            </div>
          </div>
          <!-- /new invoice template -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update changes</button>
          </div>
        </div>
            <input type="hidden" name="id" value="<?=$mod['id'];?>" />
            </form>
          </div>
    </div>
    <?php } ?>
    <!-- /default modal -->
    <!-- END CONTENT BODY -->

</div>
<!-- END CONTENT -->

</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<!-- BEGIN INNER FOOTER -->
        
<?php include('include/footer-inc.php')?>