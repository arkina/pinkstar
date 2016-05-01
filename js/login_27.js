/*
 *   Here validate login terdencial
 */

$(document).ready(function(){
	$("#adminLogin").on('click',function(){
		if($("#login-username").val()==""){
			$(".error").html("Please enter user name");
			$("#login-username").focus();
		   return flase;
		}else {
			$(".error").html("");
			var user_name = $("#login-username").val();
			
		}
		
		if($("#login-password").val()==""){
			$(".error").html("Please enter your password");
			return flase;
		}else {
			$(".error").html("");
			var user_password = $("#login-password").val();
		}
		console.log('User name '+user_name+'password'+user_password);
		$.ajax({  
    		type: 'POST',  
    		url: 'login_details.php', 
    		data: {user:user_name,password:user_password},
    		dataType : "html",
    		cache: false,
    		success: function(data) {
    			if(data == "Wrong user name or password"){
    				$(".error").html(data);
    				return false;
    			}else{
					$(".error").html(data);
					redirectTime = "500";
				setTimeout(location.href="index.php",redirectTime);
    			}
    		}
	});
});
	$("#vendorLogin").on('click',function(){
		if($("#login-username").val()==""){
			$(".error").html("Please enter user name");
			$("#login-username").focus();
		   return flase;
		}else {
			$(".error").html("");
			var user_name = $("#login-username").val();
			
		}
		
		if($("#login-password").val()==""){
			$(".error").html("Please enter your password");
			return flase;
		}else {
			$(".error").html("");
			var user_password = $("#login-password").val();
		}
		$.ajax({  
    		type: 'POST',  
    		url: 'vlogin_details.php', 
    		data: {user:user_name,password:user_password},
    		dataType : "html",
    		cache: false,
    		success: function(data) {
    			if(data == "Wrong user name or password"){
    				$(".error").html(data);
    				return false;
    			}else{
				$(".error").html(data);
				redirectTime = "500";
				setTimeout(location.href="index.php",redirectTime);
    			}
    			
    			//alert("Data: " + data);
    	}
	});
});
	
});

