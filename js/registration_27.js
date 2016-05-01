$(document).ready(function() {
	$("#doj").datepicker();
	$("#dob").datepicker();
	$("#date_exist").datepicker();

	$("#empregs").submit(function(){
		var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
		var pattern = /^\d{10}$/;
		if($("#fname").val()==""){
			$("#fname_error").html("Field should not be blank");
			$("#fname").focus();
			return false;
		}if(($("#fname").val().length) < 4){
			$("#fname_error").html("First name must be 4 charchter long !");
			$("#fname").focus();
			return false;
		}
		else{
			$("#fname_error").html(" ");
		}if($("#lname").val()==""){
			$("#lname_error").html("Field should not be blank");
			$("#lname").focus();
			return false;
		}if(($("#lname").val().lenght) < 4){
			$("#lname_error").html("First name must be 4 charchter long !");
			$("#fname").focus();
			return false;
		}
		else{
			$("#lname_error").html(" ");
		}if($("#email").val()==""){
			$("#email_error").html("Field should not be blank");
			$("#email").focus();
			return false;
		}else {
			$("#email_error").html(" ");
		}if($("#email").val()==""){
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
		if($("#username").val()==""){
			$("#username_error").html("Field should not be blank");
			$("#email").focus();
			return false;
		}else{
			$("#username_error").html(" ");
		}if($("#userpassword").val()==""){
			$("#userpassword_error").html("Field should not be blank");
			$("#userpassword").focus();
			return false;
		}else{
			$("#userpassword_error").html(" ");
		}if($("#cpassword").val()==""){
			$("#cpassword_error").html("Field should not be blank");
			$("#cpassword").focus();
			return false;
		}else {
			$("#cpassword_error").html(" ");
		}if($("#userpassword").val() != $("#cpassword").val()){
			$("#cpassword_error").html("Corfirm password not matched");
			$("#cpassword").focus();
			return false;
		}else {
			$("#cpassword_error").html(" ");
		}if($("#depart").val()=="select"){
			$("#depart_error").html("Select your department");
			$("#depart").focus();
			return false;
		}else {
			$("#depart_error").html(" ");
		}if($("#doj").val()==""){
			$("#doj_error").html("Select your date of joining");
			$("#doj").focus();
			return false;
		}else {
			$("#doj_error").html(" ");
		}if($("#post_position").val()==""){
			$("#post_position_error").html("Field should not be blank");
			$("#post_position").focus();
			return false;
		}else {
			$("#post_position_error").html(" ");
		}if($("#date_exist").val()==""){
			$("#date_exist_error").html("Field should not be blank");
			$("#date_exist").focus();
			return false;
		}else{
			$("#date_exist_error").html(" ");
		}if($("#address-one").val()==""){
			$("#address-one_error").html("Field should not be blank");
			$("#address-one").focus();
			return false;
		}else{
			$("#address-one_error").html(" ");
		}if($("#alterno_per").val()==""){
			$("#alterno_per_error").html("Field should not be blank");
			$("#alterno_per").focus();
			return false;
		}else{
			$("#alterno_per_error").html(" ");
		}if(isNaN($("#alterno_per").val())){
			$("#alterno_per_error").html("Enter only numeric value");
			$("#alterno_per").focus();
			return false;
		}if (!pattern.test($("#alterno_per").val())) {
			$("#alterno_per_error").html("Mobile should be 10 digits");
			  return false;
		}else {
			$("#alterno_per_error").html(" ");
		}if($("#referral_name").val()==""){
			$("#referral_name_error").html("Field should not be blank");
			$("#referral_name").focus();
			return false;
		}else{
			$("#referral_name_error").html(" ");
		}if($("#referral_last").val()==""){
			$("#referral_last_error").html("Field should not be blank");
			$("#referral_last").focus();
			return false;
		}else{
			$("#referral_last_error").html(" ");
		}if($("#referral_email").val()==""){
			$("#referral_email_error").html("Field should not be blank");
			$("#referral_email").focus();
			return false;
		}else{
			$("#referral_email_error").html(" ");
		}if (filter.test($("#referral_email").val())) {
			 $("referral_email_error").html(" ");
     		//return true;
			}else {
				$("#referral_email_error").html("Enter valid email id");
				$("#referral_email").focus();
				return false;
			}
		
		if($("#referral_mobile").val()==""){
			$("#referral_mobile_error").html("Field should not be blank");
			$("#referral_mobile").focus();
			return false;
		}else{
			$("#referral_mobile_error").html(" ");
		}if(isNaN($("#referral_mobile").val())){
			$("#referral_mobile_error").html("Enter only numeric value");
			$("#referral_mobile").focus();
			return false;
		}if (!pattern.test($("#referral_mobile").val())) {
			$("#referral_mobile_error").html("Mobile should be 10 digits");
			$("#referral_mobile").focus();
			  return false;
		}else {
			$("#referral_mobile_error").html(" ");
		}if($("#referral_name1").val()==""){
			$("#referral_name1_error").html("Field should not be blank");
			$("#referral_name1").focus();
			return false;
		}else{
			$("#referral_name1_error").html(" ");
		}if($("#referral_last1").val()==""){
			$("#referral_last1_error").html("Field should not be blank");
			$("#referral_last1").focus();
			return false;
		}else{
			$("#referral_last1_error").html(" ");
		}if($("#referral_email1").val()==""){
			$("#referral_email1_error").html("Field should not be blank");
			$("#referral_email1").focus();
			return false;
		}else{
			$("#referral_email1_error").html(" ");
		}if (filter.test($("#referral_email1").val())) {
			 $("referral_email1_error").html(" ");
	     		//return true;
				}else {
					$("#referral_email1_error").html("Enter valid email id");
					$("#referral_email1").focus();
					return false;
				}
		
		if($("#referral_mobile1").val()==""){
			$("#referral_mobile1_error").html("Field should not be blank");
			$("#referral_mobile1").focus();
			return false;
		}else{
			$("#referral_mobile1_error").html(" ");
		}if(isNaN($("#referral_mobile1").val())){
			$("#referral_mobile1_error").html("Enter only numeric value");
			$("#referral_mobile1").focus();
			return false;
		}if (!pattern.test($("#referral_mobile1").val())) {
			$("#referral_mobile1_error").html("Mobile should be 10 digits");
			$("#referral_mobile1").focus();
			  return false;
		}else {
			$("#referral_mobile1_error").html(" ");
		}if($("#referral_mobile1").val().lenght < 10){
			$("#referral_mobile1_error").html("Mobile number must 10 digits");
			$("#referral_mobile1").focus();
			return false;
		}else{
			$("#referral_mobile1_error").html(" ");
		}if($("#person_emename").val()==""){
			$("#person_emename_error").html("Field should not be blank");
			$("#person_emename").focus();
			return false;
		}else{
			$("#person_emename_error").html(" ");
		}if($("#person_emerelation").val()==""){
			$("#person_emerelation_error").html("Field should not be blank");
			$("#person_emerelation").focus();
			return false;
		}else{
			$("#person_emerelation_error").html(" ");
		}if($("#person_emenumber").val()==""){
			$("#person_emenumber_error").html("Field should not be blank");
			$("#person_emenumber").focus();
			return false;
		}else{
			$("#person_emenumber_error").html(" ");
		}if(isNaN($("#person_emenumber").val())){
			$("#person_emenumber_error").html("Enter only numeric value");
			$("#person_emenumber").focus();
			return false;
		}if (!pattern.test($("#person_emenumber").val())) {
			$("#person_emenumber_error").html("Mobile should be 10 digits");
			$("#person_emenumber").focus();
			  return false;
		}else {
			$("#person_emenumber_error").html(" ");
		}if($("#person_emenumber").val().lenght < 10){
			$("#person_emenumber_error").html("Mobile number must be 10 digits");
			$("#person_emenumber").focus();
			return false;
		}else {
			$("#person_emenumber_error").html(" ");
		}if($("#pancard").val()==""){
			$("#pancard_error").html("Field should not be blank");
			$("#pancard").focus();
			return false;
		}else{
			$("#pancard_error").html(" ");
		}if($("#accountno").val()==""){
			$("#accountno_error").html("Field should not be blank");
			$("#accountno").focus();
			return false;
		}else{
			$("#accountno_error").html(" ");
		}if(isNaN($("#accountno").val())){
			$("#accountno_error").html("Enter only numeric value");
			$("#accountno").focus();
			return false;
		}else {
			$("#accountno_error").html(" ");
		}
		//return true;
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
