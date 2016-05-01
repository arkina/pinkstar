$(document).ready(function() {
	$("#leadregs").submit(function(){
		var pattern = /^[a-zA-Z ]*$/;
		var pattern_mobile = /^\d{10}$/;
		var regexpurl = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var companyName = $("#company_name").val();	
			if(companyName == ""){
				$("#company_name_error").html('Filed should not be blank');
				$("#company_name").focus();
				return false;
			}
		if(!pattern.test($("#company_name").val())){
			$("#company_name_error").html("Enter only character");
			$("#company_name").focus();
			  return false;
			}else{
				$("#company_name_error").html(' ');
			}
		if($("#contact_person").val() == ""){
			$("#contact_person_error").html('Filed should not be blank');
				return false;
			}
		if(!pattern.test($("#contact_person").val())){
			$("#contact_person_error").html("Enter only character");
			  return false;
			}else{
				$("#contact_person_error").html(' ');
			}
		if($("#phone").val()==""){
				$("#phone_error").html("Field should not be blank");
				$("#phone").focus();
				return false;
			}if(isNaN($("#phone").val())){
				$("#phone_error").html("Enter only numeric value");
				$("#phone").focus();
				return false;
			}if (!pattern_mobile.test($("#phone").val())) {
				$("#phone_error").html("Mobile should be 10 digits");
			  	return false;
			}else {
			$("#phone_error").html(" ");
			}
		if($("#mobile").val()==""){
				$("#mobile_error").html("Field should not be blank");
				$("#mobile").focus();
				return false;
			}
		if(isNaN($("#mobile").val())){
				$("#mobile_error").html("Enter only numeric value");
				$("#mobile").focus();
				return false;
			}if(!pattern_mobile.test($("#mobile").val())) {
				$("#mobile_error").html("Mobile should be 10 digits");
			  	return false;
			}else {
				$("#mobile_error").html(" ");
			}
		if($("#alternate_phone").val()==""){
				$("#alternate_phone_error").html("Field should not be blank");
				$("#alternate_phone").focus();
				return false;
			}if(isNaN($("#alternate_phone").val())){
				$("#alternate_phone_error").html("Enter only numeric value");
				$("#alternate_phone").focus();
				return false;
			}if (!pattern_mobile.test($("#alternate_phone").val())) {
				$("#alternate_phone_error").html("Mobile should be 10 digits");
			  	return false;
			}else {
				$("#alternate_phone_error").html(" ");
			}
		if($("#alternate_mobile").val()==""){
				$("#alternate_mobile_error").html("Field should not be blank");
				$("#alternate_mobile").focus();
				return false;
			}
		if(isNaN($("#alternate_mobile").val())){
				$("#alternate_mobile_error").html("Enter only numeric value");
				$("#alternate_mobile").focus();
				return false;
			}
		if (!pattern_mobile.test($("#alternate_mobile").val())) {
				$("#alternate_mobile_error").html("Mobile should be 10 digits");
			  	return false;
			}else {
				$("#alternate_mobile_error").html(" ");
			}
		if($("#website").val()==""){
				$("#website_error").html("Field should not be blank");
				$("#website").focus();
				return false;
			}else{
				$("#website_error").html(' ');
			}
		if($("#email").val()==""){
			$("#email_error").html("Field should not be blank");
			$("#email").focus();
			return false;
		}else {
			$("#email_error").html(" ");
		}
		if($("#email").val()==""){
			$("email_error").html("Field should not be blank");
			$("#email").focus();
			return false;
		}else {
			$("#email_error").html(" ");
		}if(filter.test($("#email").val())) {
			 $("email_error").html(" ");
        		//return true;
        }else {
        $("#email_error").html("Enter valid email id");
			$("#email").focus();
			return false;
    	}
		if($("#latitude").val()==""){
			$("#latitude_error").html("Field should not be blank");
			$("#latitude").focus();
			return false;
		}else{
			$("#latitude_error").html(" ");
		}
		if($("#logitiude").val()==""){
			$("#logitiude_error").html("Field should not be blank");
			$("#logitiude").focus();
			return false;
		}else{
			$("#logitiude_error").html(" ");
		}
		if($("#per_address").val()==""){
			$("#per_address_error").html("Field should not be blank");
			$("#per_address").focus();
			return false;
		}else{
			$("#per_address_error").html(" ");
		}
		if($("#alter_address").val()==""){
			$("#alter_address_error").html("Field should not be blank");
			$("#alter_address").focus();
			return false;
		}else{
			$("#alter_address_error").html(" ");
		}
		
		if($("#country").val()=="select"){
			$("#country_error").html("select state");
			$("#country").focus();
			return false;
		}else{
			$("#country_error").html(" ");
		}
		if($("#city").val()=="select"){
			$("#city_error").html("select state");
			$("#city").focus();
			return false;
		}else{
			$("#city_error").html(" ");
		}
		if($("#pincode").val()==""){
			$("#pincode_error").html("Field should not be blank");
			$("#pincode").focus();
			return false;
		}
		if(isNaN($("#pincode").val())){
		$("#pincode_error").html("Only numeric value");
			$("#pincode").focus();
			return false;
		}
		else{
			$("#pincode_error").html(" ");
		}
		return false;
	});
	
var location_id =$("#state option:selected").val();
		if(location_id!="" && location_id!= "undefined"){
			var url ='http://pinkstarapp.com/administrator/';
			$.ajax({  
				type: 'POST',  
				url: url+'getcountry.php', 
				data: {location_id:location_id},
				dataType : "html",
				success: function(data) {
					$("#country").html(data);
					$("#country_dummy").hide();
					$("#country").show();
				}
			});
}	

$("#country").change(function(){
	var getCountry_id = $(this).val();
	if(getCountry_id!="" && getCountry_id!= "undefined"){
		var url ='http://pinkstarapp.com/administrator/';
		$.ajax({  
			type: 'POST',  
			url: url+'getcountry.php', 
			data: {getCountry_id:getCountry_id,checkdata:1},
			dataType : "html",
			success: function(data) {
				$("#city").html(data);
				//$("#country_dummy").hide();
				//$("#country").show();
			}
		});
	}	
 });

	$(".btnshow").on('click',function(){
		var upadte_id =$(this).attr('id');
		var check ='1'
		var isuser = confirm("Are you sure you want to leave?");
		    if (isuser == true) {
			var url ='http://pinkstarapp.com/administrator/';
				$.ajax({  
					type: 'POST',  
					url: url+'getcountry.php', 
					data: {upadte_id:upadte_id,check:check},
					dataType : "html",
					success: function(data) {
					console.log("Data is"+data);
					location.reload();
					}
				});
		}
			
	});
	$(".btnhide").on('click',function(){
		var upadte_id =$(this).attr('id');
		var check =2;
		var isuser = confirm("Are you sure you want to leave?");
		    if (isuser == true) {
			var url ='http://pinkstarapp.com/administrator/';
			$.ajax({  
				type: 'POST',  
				url: url+'getcountry.php', 
				data: {upadte_id:upadte_id,check:check},
				dataType : "html",
				success: function(data) {
				console.log("Data is"+data);
				location.reload();
				}
			});
		}
	});

});