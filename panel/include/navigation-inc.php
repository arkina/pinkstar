<ul class="nav navbar-nav collapse" id="navbar-menu">
	<?php if($_SESSION['login_as']=='1'){ ?>
    <li><a href="index.php"><i class="icon-screen2"></i> <span>Dashboard</span></a></li>
    <li class="dropdown"><a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user2"></i> <span>Employee Management</span> <b class="caret"></b></a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="edit-employee.php">Add Employee</a></li>
        <li><a href="edit-department.php">Add Departments</a></li>
        <li><a href="view-employee.php">View Employee List</a></li>
        <li><a href="view-department.php">View Department</a></li>
      </ul>
    </li>
    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-paragraph-justify2"></i> <span>Vendor Management</span> <b class="caret"></b></a>
      <ul class="dropdown-menu dropdown-menu-right">
        <li><a href="edit-employee.php">Add Vendor</a></li>
        <li><a href="edit-department.php">View Vendor</a></li>
        <li><a href="view-employee.php">View Vendor Invoice</a></li>
        <li><a href="view-department.php">View Vendor Leads</a></li>
      </ul>
    </li>
	<?php } ?>
  </ul>
  <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
    <li class="user dropdown"><a class="dropdown-toggle" data-toggle="dropdown">
	<?php if(isset($_SESSION['userimg'])){ ?>
	<img src="<?=URL.employeeimg.$_SESSION['userimg'];?>" alt="">
		<?php }else{?>
		<img src="https://placeholdit.imgix.net/~text?txtsize=33&txt=72%C3%9772&w=72&h=72" alt=""><?php } ?>
	<span>
<?php
if(isset($_SESSION['username'])){ echo $_SESSION['username'];}else{ echo $_SESSION['username']="";} ?></span><i class="caret"></i></a>
      <ul class="dropdown-menu dropdown-menu-right icons-right">
        <li><a href="#"><i class="icon-user"></i> Profile</a></li>
        <li><a href="#"><i class="icon-bubble4"></i> Messages</a></li>
        <li><a href="#"><i class="icon-cog"></i> Settings</a></li>
        <?php if(isset($_SESSION['login_as'])=="1"){?>
        <li><a href="logout.php"><i class="icon-exit"></i> Logout</a></li>
        <?php }else{ ?>
        <li><a href="../../vendor/logout.php"><i class="icon-exit"></i> Logout</a></li>
        <?php }?>
      </ul>
    </li>
  </ul>
</div>
<!-- /navbar -->
