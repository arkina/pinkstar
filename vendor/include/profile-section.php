<div class="col-lg-2">
        <!-- Profile links -->
        <div class="block">
          <div class="block">
            <div class="thumbnail">
              <div class="thumb"><img alt="" src="http://placehold.it/250">
                <div class="thumb-options"><span><a href="#" class="btn btn-icon btn-success"><i class="icon-pencil"></i></a><a href="#" class="btn btn-icon btn-success"><i class="icon-remove"></i></a></span></div>
              </div>
              <div class="caption text-center">
                <h6><?php if(isset($_SESSION['username'])){echo ucfirst($_SESSION['username']);} ?></h6>
                <div class="icons-group"> 
                  <a href="#" title="Google Drive" class="tip"><i class="icon-google-drive"></i></a> 
                  <a href="#" title="Twitter" class="tip"><i class="icon-twitter"></i></a> 
                  <a href="#" title="Github" class="tip"><i class="icon-github3"></i></a> 
                </div>
              </div>
            </div>
          </div>
          <ul class="nav nav-list">
            <li class="nav-header">Bills<i class="icon-accessibility"></i></li>
            <li><a href="#">Today Bills</a></li>
            <li><a href="#">Current Months <span class="label label-danger">21</span></a></li>
            <li><a href="#">History</a></li>
          </ul>
          <ul class="nav nav-list">
            <li class="nav-header">Invoices<i class="icon-cogs"></i></li>
            <li><a href="#">Pending Invoices</a></li>
            <li><a href="#">Paid Invoices</a></li>
          </ul>
        </div>
        <!-- /profile links -->
      </div>