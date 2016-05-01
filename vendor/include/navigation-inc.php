  <ul class="nav navbar-nav navbar-right collapse" id="navbar-icons">
    <li class="user dropdown"><a class="dropdown-toggle" data-toggle="dropdown">
	<?php if(isset($_SESSION['userimg'])){ ?>
	<img src="<?=URL.employeeimg.$_SESSION['userimg'];?>" alt="">
		<?php }else{?>
		<img src="<?=URL;?>uploads/vendor/<?=$_SESSION['image_url'];?>" alt=""><?php } ?>
	<span>
<?php
if(isset($_SESSION['username'])){ echo $_SESSION['username'];}else{ echo $_SESSION['username']="";} ?></span><i class="caret"></i></a>
      <ul class="dropdown-menu dropdown-menu-right icons-right">
        <li><a href="#"><i class="icon-user"></i> Profile</a></li>
        <?php if(isset($_SESSION['login_as'])=="1"){?>
        <li><a href="logout.php"><i class="icon-exit"></i> Logout</a></li>
        <?php }else{ ?>
        <li><a href="logout.php"><i class="icon-exit"></i> Logout</a></li>
        <?php }?>
      </ul>
    </li>
  </ul>
</div>
<!-- /navbar -->
