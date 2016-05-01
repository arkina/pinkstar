<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Vendor Login</title>
<style>
	
#login-box {
	width:333px;
	height: 352px;
	padding: 58px 76px 0 76px;
	color: #ebebeb;
	font: 12px Arial, Helvetica, sans-serif;
	background-color:#989898;
}

#login-box img {
	border:none;
}

#login-box h2 {
	padding:0;
	margin:0;
	color: #ebebeb;
	font: bold 44px "Calibri", Arial;
}


#login-box-name {
	float: left;
	display:inline;
	width:80px;
	text-align: right;
	padding: 14px 10px 0 0;
	margin:0 0 7px 0;
}

#username {
	float: left;
	display:inline;
	width:230px;
	margin:0;
	margin:0 0 7px 0;
}


.form-login  {
	width: 205px;
	padding: 10px 4px 6px 3px;
	border: 1px solid #0d2c52;
	background-color:#1e4f8a;
	font-size: 16px;
	color: #ebebeb;
}


.login-box-options  {
	clear:both;
	padding-left:87px;
	font-size: 11px;
}

.login-box-options a {
	color: #ebebeb;
	font-size: 11px;
}
</style>
</head>
<body>
<div style="padding: 100px 0 0 250px;">
<div id="login-box">
<H2>Vendor Login</H2>
<br />
<br />
<form action="action/vlogin_details.php" method="post">
<div id="login-box-name" style="margin-top:20px;">User Name:</div><div id="username" style="margin-top:20px;"><input name="username" class="form-login" title="Username" size="30" maxlength="16" /></div>
<div id="login-box-name">Password:</div><div id="login-box-field"><input name="userpassword" type="password" class="form-login" title="Password" size="30" maxlength="16" /></div>
<br />
<span class="login-box-options"><input type="checkbox" name="1" value="1"> Remember Me <a href="#" style="margin-left:30px;">Forgot password?</a></span>
<br />
<br />
<input type="submit" value="Submit"/>
</form>
</div>
</div>
</body>
</html>
