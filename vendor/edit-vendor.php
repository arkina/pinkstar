<?php include('../../config/config.php');
include('../include/head-inc.php');include('../include/navigation-inc.php');
?>
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> Vendor Registration</h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li>Vendor Registration</li>
      </ul>
      <div class="visible-xs breadcrumb-toggle"><a class="btn btn-link btn-lg btn-icon" data-toggle="collapse" data-target=".breadcrumb-buttons"><i class="icon-menu2"></i></a></div>
    </div>
    <!-- /breadcrumbs line -->
    <!-- Callout -->
    <div class="callout callout-success fade in">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <h5>Horizontal navigation layout</h5>
      <p>Page layout example with horizontal navigation, placed on top inside navbar.</p>
    </div>
    <!-- /callout -->
          <div class="panel panel-default">
            <div class="panel-heading">
              <h6 class="panel-title">Vendor Registration Form</h6>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" id="vendorregs" action="vendor-registration.php" enctype="multipart/form-data" method="post">
                <h3 class="text-success">Contact Details</h3>
                <hr>
                <div class="form-group">
                  <label class="control-panel col-md-2">Company Name</label>
                  <div class="col-md-4">
                    <input type="text" id="company_name" name="company_name" value="<?php (isset($_POST['company_name']) ? $_POST['company_name'] : '');?>" class="form-control" />
                      <span class="error" id="company_name_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Name on Pink Star</label>
                  <div class="col-md-4">
                    <input type="text" id="display_name_pinkstar" name="display_name_pinkstar"
                      value="<?php (isset($_POST['display_name_pinkstar']) ? $_POST['display_name_pinkstar'] : '');?>"
                      class="form-control" />
                      <span class="display_name_pinkstar_error" id="lname_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Address</label>
                  <div class="col-md-4">
                    <input type="text" id="address" name="address"
                      value="<?php (isset($_POST['address']) ? $_POST['address'] : '');?>"
                      class="form-control" />
                      <span class="address_error" id="email_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Postal Code</label>
                  <div class="col-md-4">
                    <input type="text" id="postal_code" name="postal_code"
                      value="<?php (isset($_POST['postal_code']) ? $_POST['postal_code'] : '');?>"
                      class="form-control" />
                      <span class="postal_code_error" id="username_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">State</label>
                  <div class="col-md-4">
                    <select class="form-control" name="state" id="state">
                     <!--  <option value="select">--Select One--</option> -->
                      <option value="100" disabled="disabled" selected="selected">India</option>
                    </select>
                  </div>
                  <label class="control-panel col-md-2">Country</label>
                  <div class="col-md-4">
                    <select class="form-control" id="country_dummy" name="country"></select>
                  </div>
                  <div class="col-md-4">
                    <select style="display: none;" class="form-control" id="country" name="country"></select>
                  </div>
                </div>
                <div class="form-group">
                <label class="control-panel col-md-2">City</label>
                  <div class="col-md-4">
                    <select class="form-control" id="city" name="city">
                      <option value="select">--Select One--</option>
                    </select>
                  </div>
                  <label class="control-panel col-md-2">Pin Code</label>
                  <div class="col-md-4">
                    <input type="text" maxlength="7" name="postal_code"
                      value="<?php (isset($_POST['postal_code']) ? $_POST['postal_code'] : '');?>"
                      id="postal_code" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Email Address</label>
                  <div class="col-md-4">
                    <input type="text" id="contact_preson_email" name="contact_preson_email"
                      value="<?php (isset($_POST['contact_preson_email']) ? $_POST['contact_preson_email'] : '');?>"
                      class="form-control" />
                      <span class="contact_preson_email_error" id="contact_preson_email_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Web Site</label>
                  <div class="col-md-4">
                    <input type="text" id="webside" name="webside"
                      value="<?php (isset($_POST['webside']) ? $_POST['webside'] : '');?>"
                      class="form-control" />
                      <span class="webside_error" id="webside_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Permanent address</label>
                  <div class="col-md-4">
                    <input type="text" id="correspondence_address" name="correspondence_address" value="<?php (isset($_POST['correspondence_address']) ? $_POST['correspondence_address'] : '');?>" class="form-control" />
                    <span class="error" id="correspondence_address_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Contact Person Name</label>
                  <div class="col-md-4">
                    <input type="text" id="contact_preson_name" name="contact_preson_name" value="<?php (isset($_POST['contact_preson_name']) ? $_POST['contact_preson_name'] : '');?>" class="form-control" />
                  <span class="contact_preson_name_error" id="contact_preson_name_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Telephone-1</label>
                  <div class="col-md-4">
                    <input type="text" maxlength="10" name="telephone_1"
                      value="<?php (isset($_POST['telephone_1']) ? $_POST['telephone_1'] : '');?>"
                      id="telephone_1" class="form-control" />
                      <span class="error" id="telephone_1_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Telephone-2</label>
                  <div class="col-md-4">
                    <input type="text" name="telephone_2" maxlength="10" id="telephone_2" value="<?php (isset($_POST['telephone_2']) ? $_POST['telephone_2'] : '');?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Telephone-3</label>
                  <div class="col-md-4">
                    <input type="text" maxlength="10" name="telephone_3"
                      value="<?php (isset($_POST['telephone_3']) ? $_POST['telephone_3'] : '');?>"
                      id="alterno_per" class="form-control" />
                      <span class="error" id="telephone_3_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Telephone-4</label>
                  <div class="col-md-4">
                    <input type="text" name="telephone_4" maxlength="10" id="telephone_4" value="<?php (isset($_POST['telephone_4']) ? $_POST['telephone_4'] : '');?>" class="form-control" />
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-panel col-md-2">Type of Business</label>
                  <div class="col-md-4">
                    <input type="text" id="type_of_business" name="type_of_business" value="<?php (isset($_POST['type_of_business']) ? $_POST['type_of_business'] : '');?>" class="form-control" />
                      <span class="error" id="type_of_business_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Nature of Business</label>
                  <div class="col-md-4">
                    <input type="text" id="nature_of_business" name="nature_of_business"
                      value="<?php (isset($_POST['nature_of_business']) ? $_POST['nature_of_business'] : '');?>"
                      class="form-control" />
                      <span class="nature_of_business_error" id="lname_error" style="color: red"></span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-panel col-md-2">Date Of Establishment</label>
                  <div class="col-md-4">
                    <input type="date" id="year_of_establishment" name="year_of_establishment"
                      value="<?php (isset($_POST['year_of_establishment']) ? $_POST['year_of_establishment'] : '');?>"
                      class="form-control" />
                      <span class="year_of_establishment_error" id="year_of_establishment_error" style="color: red"></span>
                  </div>
                </div>
            <div class="panel-footer">
              <div class="form-group">
                <input type="submit" class="success" value="Register"></button>
              </div>
            </div>
            </form>
            </div>
          </div>
        </div>
       </div> 
<?php include('../include/footer-inc.php');?>