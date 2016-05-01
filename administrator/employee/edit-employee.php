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
        <h3>Horizontal navigation <small>Horizontal navigation layout example</small></h3>
      </div>
    </div>
    <!-- /page header -->
    <!-- Breadcrumbs line -->
    <div class="breadcrumb-line">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li><a href="horizontal_navigation.html">Layouts</a></li>
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
              <h6 class="panel-title">Employee Registration Form</h6>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" id="empregs" action="registration.php" enctype="multipart/form-data" method="post">
                <h3 class="text-success">Login Credentials</h3>
                <hr>
                <div class="form-group">
                  <label class="control-panel col-md-2">First Name</label>
                  <div class="col-md-4">
                    <input type="text" id="fname" name="fname" value="<?php (isset($_POST['fname']) ? $_POST['fname'] : '');?>" class="form-control" />
                      <span class="error" id="fname_error" style="color: red"></span>
                  </div>
                  
                  <label class="control-panel col-md-2">Last Name</label>
                  <div class="col-md-4">
                    <input type="text" id="lname" name="lname"
                      value="<?php (isset($_POST['lname']) ? $_POST['lname'] : '');?>"
                      class="form-control" />
                      <span class="lname_error" id="lname_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Email Address</label>
                  <div class="col-md-4">
                    <input type="text" id="email" name="email"
                      value="<?php (isset($_POST['email']) ? $_POST['email'] : '');?>"
                      class="form-control" />
                      <span class="email_error" id="email_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">User Name</label>
                  <div class="col-md-4">
                    <input type="text" id="username" name="username"
                      value="<?php (isset($_POST['username']) ? $_POST['username'] : '');?>"
                      class="form-control" />
                      <span class="username_error" id="username_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Password</label>
                  <div class="col-md-4">
                    <input type="password" name="userpassword" id="userpassword"
                      class="form-control" />
                      <span class="userpasseord_error" id="userpasseord_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Confirm Password</label>
                  <div class="col-md-4">
                    <input type="password" id="cpassword" class="form-control" />
                    <span class="cpassword_error" id="cpassword_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Department</label>
                  <div class="col-md-4">
                    <select class="form-control" id="depart" name="depart">
                      <option value="select">--Select One--</option>
                      <option <?php (isset($_POST['depart'])=="hr" ? 'selected' : '');?> value="hr">HR</option>
                      <option value="ac">ACCOUNT</option>
                    </select>
                    <span class="depart_error" id="depart_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Date Of Joining</label>
                  <div class="col-md-4">
                    <input type="text" id="doj" name="doj"
                      value="<?php (isset($_POST['doj']) ? $_POST['doj'] : '');?>"
                      class="form-control" />
                      <span class="doj_error" id="doj_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                <label class="control-panel col-md-2">Post/Position</label>
                  <div class="col-md-4">
                    <input type="text" name="post_position" id="post_position"
                      class="form-control" />
                      <span class="post_position_error" id="post_position_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Date of Exit</label>
                  <div class="col-md-4">
                    <input type="text" id="date_exist" name="date_exist" class="form-control" />
                    <span class="date_exist_error" id="date_exist_error" style="color: red"></span>
                  </div>
                </div>
                <h3 class="text-success">Personel Details</h3>
                <hr>
                <span class="error" id="presonal_error" style="color: red"></span>
                <div class="form-group">
                  <label class="control-panel col-md-2">DOB</label>
                  <div class="col-md-4">
                    <input type="date" id="dob" name="dob" value="<?php (isset($_POST['dob']) ? $_POST['dob'] : '');?>" class="form-control" />
                    <span class="error" id="dob_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Marital Status</label>
                  <div class="col-md-4">
                    <select class="form-control" id="marital_status" name="marital_status">
                      <option value="select">--Select One--</option>
                      <option value="1" <?php (isset($_POST['marital_status'])=="1" ? 'selected' : '');?> >Married</option>
                      <option value="0" <?php (isset($_POST['marital_status'])=="0" ? 'selected' : '');?>>Single</option>
                    </select>
                    <span class="error" id="marital_status_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Permanent address</label>
                  <div class="col-md-4">
                    <input type="text" id="address-one" name="address-one" value="<?php (isset($_POST['address-one']) ? $_POST['address-one'] : '');?>" class="form-control" />
                    <span class="error" id="address-one_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Residential address</label>
                  <div class="col-md-4">
                    <input type="text" id="address-two" name="address-two" value="<?php (isset($_POST['address-two']) ? $_POST['address-two'] : '');?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Alternate Phone (Permanent)</label>
                  <div class="col-md-4">
                    <input type="text" maxlength="10" name="alterno_per"
                      value="<?php (isset($_POST['alterno_per']) ? $_POST['alterno_per'] : '');?>"
                      id="alterno_per" class="form-control" />
                      <span class="error" id="alterno_per_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Mobile Number (Permanent)</label>
                  <div class="col-md-4">
                    <input type="text" name="mobileno_per" maxlength="10" id="mobileno_per" value="<?php (isset($_POST['mobileno_per']) ? $_POST['mobileno_per'] : '');?>" class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Alternate Phone (Residential)</label>
                  <div class="col-md-4">
                    <input type="text" maxlength="10" name="alterno_res"
                      value="<?php (isset($_POST['alterno_res']) ? $_POST['alterno_res'] : '');?>"
                      id="alterno_res" class="form-control" />
                  </div>
                  <label class="control-panel col-md-2">Mobile Number (Residential)</label>
                  <div class="col-md-4">
                    <input type="text" name="mobileno_res" maxlength="10" id="mobileno_res" value="<?php (isset($_POST['mobileno_res']) ? $_POST['mobileno_res'] : '');?>" class="form-control" />
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
                    <input type="text" maxlength="7" name="pincode"
                      value="<?php (isset($_POST['pincode']) ? $_POST['pincode'] : '');?>"
                      id="pincode" class="form-control" />
                  </div>
                  <!--   <label class="control-panel col-md-2">Residence Number</label>
                  <div class="col-md-4">
                    <input type="text" maxlength="10" id="regsno" name="regsno"
                      value="<?php (isset($_POST['regsno']) ? $_POST['regsno'] : '');?>"
                      class="form-control" />
                  </div> -->
                </div>
                <h3 class="text-success">Referral Details</h3>
                <hr>
                <span class="error" id="referral_error" style="color: red"></span>
                <div class="form-group">
                  <label class="control-panel col-md-2">1 .Referral Name</label>
                  <div class="col-md-4">
                    <input type="text" id="referral_name" name="referral_name" value="<?php (isset($_POST['referral_name']) ? $_POST['referral_name'] : '');?>" class="form-control" />
                  	<span class="referral_name_error" id="referral_name_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Referral Last Name</label>
                  <div class="col-md-4">
                    <input type="text" id="referral_last" value="<?php (isset($_POST['referral_last']) ? $_POST['referral_last'] : '');?>" name="referral_last"
                      class="form-control" />
                      <span class="referral_last_error" id="referral_last_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Email Address</label>
                  <div class="col-md-4">
                    <input type="text" id="referral_email" name="referral_email" value="<?php (isset($_POST['referral_email']) ? $_POST['referral_email'] : '');?>" class="form-control" />
                  <span class="referral_email_error" id="referral_email_error" style="color: red"></span>
                  </div>

                  <label class="control-panel col-md-2">Mobile Number</label>
                  <div class="col-md-4">
                    <input type="text" name="referral_mobile" maxlength="10" id="referral_mobile" value="<?php (isset($_POST['referral_mobile']) ? $_POST['referral_mobile'] : '');?>" class="form-control" />
                  <span class="referral_mobile_error" id="referral_mobile_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">2. Referral Name</label>
                  <div class="col-md-4">
                    <input type="text" id="referral_name1" name="referral_name1" value="<?php (isset($_POST['referral_name1']) ? $_POST['referral_name1'] : '');?>" class="form-control" />
                  	<span class="referral_name1_error" id="referral_name1_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Referral Last Name</label>
                  <div class="col-md-4">
                    <input type="text" id="referral_last1" value="<?php (isset($_POST['referral_last1']) ? $_POST['referral_last1'] : '');?>" name="referral_last1"
                      class="form-control" />
                      <span class="referral_last1_error" id="referral_last1_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Email Address</label>
                  <div class="col-md-4">
                    <input type="text" id="referral_email1" name="referral_email1" value="<?php (isset($_POST['referral_email1']) ? $_POST['referral_email1'] : '');?>" class="form-control" />
                  <span class="referral_email1_error" id="referral_email1_error" style="color: red"></span>
                  </div>

                  <label class="control-panel col-md-2">Mobile Number</label>
                  <div class="col-md-4">
                    <input type="text" name="referral_mobile1" maxlength="10" id="referral_mobile1" value="<?php (isset($_POST['referral_mobile1']) ? $_POST['referral_mobile1'] : '');?>" class="form-control" />
                  	<span class="referral_mobile1_error" id="referral_mobile1_error" style="color: red"></span>
                  </div>
                </div>
                <h3 class="text-success">Emergency Contact</h3>
                <hr>
                <span class="error" id="emergency_error" style="color: red"></span>
                <div class="form-group">
                  <label class="control-panel col-md-2">Person Name</label>
                  <div class="col-md-4">
                    <input type="text" name="person_emename" id="person_emename" value="<?php (isset($_POST['person_emename']) ? $_POST['person_emename'] : '');?>"
                      class="form-control" />
                      <span class="person_emename_error" id="person_emename_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Relation</label>
                  <div class="col-md-4">
                    <input type="text" name="person_emerelation" id="person_emerelation" value="<?php (isset($_POST['person_emerelation']) ? $_POST['person_emerelation'] : '');?>"
                      class="form-control" />
                      <span class="person_emerelation_error" id="person_emerelation_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Mobile Number</label>
                  <div class="col-md-4">
                    <input type="text" name="person_emenumber" id="person_emenumber" value="<?php (isset($_POST['person_emenumber']) ? $_POST['person_emenumber'] : '');?>"
                      class="form-control" />
                      <span class="person_emenumber_error" id="person_emenumber_error" style="color: red"></span>
                  </div>
                </div>
                <h3 class="text-success">Accounts Details</h3>
                <hr>
                <span class="error" id="account_error" style="color: red"></span>
                <div class="form-group">
                  <label class="control-panel col-md-2">Pancard Number</label>
                  <div class="col-md-4">
                    <input type="text" name="pancard" id="pancard" value="<?php (isset($_POST['pancard']) ? $_POST['pancard'] : '');?>"
                      class="form-control" />
                      <span class="pancard_error" id="pancard_error" style="color: red"></span>
                  </div>
                  <label class="control-panel col-md-2">Adhar Card Number</label>
                  <div class="col-md-4">
                    <input type="text" name="adharno" id="adharno" value="<?php (isset($_POST['adharno']) ? $_POST['adharno'] : '');?>"
                      class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Bank Name</label>
                  <div class="col-md-4">
                    <input type="text" name="bankname" id="bankname" value="<?php (isset($_POST['bankname']) ? $_POST['bankname'] : '');?>"
                      class="form-control" />
                  </div>
                  <label class="control-panel col-md-2">Account Number</label>
                  <div class="col-md-4">
                    <input type="text" name="accountno" id="accountno" value="<?php (isset($_POST['accountno']) ? $_POST['accountno'] : '');?>"
                      class="form-control" />
                      <span class="accountno_error" id="accountno_error" style="color: red"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Bank Address</label>
                  <div class="col-md-4">
                    <input type="text" name="bankaddress" id="bankaddress" value="<?php (isset($_POST['bankaddress']) ? $_POST['bankaddress'] : '');?>"
                      class="form-control" />
                  </div>
                  <label class="control-panel col-md-2">IFSC Code</label>
                  <div class="col-md-4">
                    <input type="text" name="ifsccode" id="ifsccode" value="<?php (isset($_POST['ifsccode']) ? $_POST['ifsccode'] : '');?>"
                      class="form-control" />
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-panel col-md-2">Image</label>
                  <div class="col-md-10">
                    <input type="file"  name="userimage_name" class="form-control" />
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