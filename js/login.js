/*
 *   Here validate login terdencial
 */

$(document).ready(function(){
	
	$("#login-username").keyup(function(){
    	if(($(this).val().length) == 5){
			$("#login-password").focus();
			return false;
		}
	});
	$("#login-password").keyup(function(){
    	if(($(this).val().length) == 5){
			$("#adminLogin").focus();
			return false;
		}
	});
	
	
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
					$("#login-password").val("");
					$("#login-password").focus();
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
	$('.userprimary').click(function(){
		var getData = $(this).attr('id');
		var res = getData.split("+");
		var id =res[0];
		var vendor_id =res[1];
		if (confirm('Want to set Primary User')) {
		 $.ajax({  
    		type: 'POST',  
    		url: 'http://pinkstarapp.com/vendor/vlogin_details.php', 
    		data: {id:id,vendor_id:vendor_id},
    		dataType : "html",
    		cache: false,
    		success: function(data) {
				alert('Primary user set successfully');
				location.reload();
    	}
	});
}else{
				return false;
		}
		return false;
	});
});

