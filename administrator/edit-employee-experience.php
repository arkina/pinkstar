<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../curd/curd.php");
include('../administrator/include/head-inc.php');include('../administrator/include/navigation-inc.php');
?>
<div class="panel panel-default">
        <div class="panel-heading">
          <h6 class="panel-title"><i class="icon-page-break"></i> Employee Experience</h6>
        
          <div class="form-group">
          <div class="col-sm-10">
              <label class="radio-inline">
                  <input type="radio" name="inline-radio" class="styled" value="1" checked="checked">
                Fresher</label>
              <label class="radio-inline">
                  <input type="radio" name="inline-radio" class="styled" value="2">
                Experience</label>
            </div>
          </div>
          </div>
        </div>
      
<form role="form" id="emp_exp" method="POST" style="display: none;">
        <div class="panel-body">
          <div class="form-group">
              <div class="row">
                <div class="col-sm-3">
                <label>Employer Name:</label>
              </div>
              <div class="col-sm-2">
                <label>Designation:</label>
              </div>
              <div class="col-sm-3">
                <label>Role Description:</label>
              </div>
              <div class="col-sm-4">
                  <div class="col-sm-6">
                <label>From:</label>
                  </div>
                  <div class="col-sm-6">
                <label>To:</label>
                  </div>
              </div>
              </div>
          </div>
              <?php for($i=0;$i<5;$i++){ ?>
            <div class="form-group">
            <div class="row">
              <div class="col-sm-3">
                  <input type="text" class="form-control" name="employer_name" id="employer_name<?php echo $i; ?>">
                  <span class="error" id="employer_name_error<?php echo $i; ?>" style="color: red"></span>
              </div>
              <div class="col-sm-2">
                   <select class="form-control" id="designation<?php echo $i; ?>" name="designation">
                      <option value="">--Select One--</option>
                      <option value="hr">HR</option>
                      <option value="ac">ACCOUNT</option>
                    </select>
                    <span class="error" id="designation_error<?php echo $i; ?>" style="color: red"></span>
              </div>
              <div class="col-sm-3">
                  <textarea rows="5" cols="2" style="height:35px;" class="form-control" name="role_desc" id="role_desc<?php echo $i; ?>"></textarea>
                  <span class="error" id="role_desc_error<?php echo $i; ?>" style="color: red"></span>
              </div>
              <div class="col-sm-4">
                  <div class="col-sm-6">
                      <input type="text" class="form-control" height="35px;" id="exp_from<?php echo $i; ?>" name="exp_from">
                      <span class="error" id="exp_from_error<?php echo $i; ?>" style="color: red"></span>
                  </div>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="exp_to<?php echo $i; ?>" name="exp_to">
                    <span class="error" id="exp_to_error<?php echo $i; ?>" style="color: red"></span>
                </div>
              </div>
            </div>
            </div>
              <?php } ?>
          </div>
          <div class="form-actions text-right">
              <input type="button" value="Submit form" class="btn btn-primary do-something">
          </div>
        </div>
      </div>
    </form>

<?php include('../administrator/include/footer-inc.php');?>
