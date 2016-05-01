var url ='http://pinkstarapp.com/administrator/employee/';
$(document).ready(function() {
    var chk=$('.styled:checked').val();
    $('.styled').click(function(){
        chk=$('.styled:checked').val();
        if(chk==1){$('#emp_exp').hide('slow');}
        else{$('#emp_exp').show('slow');}
    });
    
    
    var allTbs = document.getElementsByName("employer_name");
    var max = allTbs.length; 
    for (var i = 0; i < max; i++) {
	$("#exp_from"+i).datepicker({dateFormat:'yy-mm-dd'});
	$("#exp_to"+i).datepicker({dateFormat:'yy-mm-dd'});
	//$("#date_exist").datepicker();
    }
$(".do-something").click(function(){ 
var allTbs = document.getElementsByName("employer_name");//alert(allTbs.length); return false;
    var valid = false;
    var max = allTbs.length; 
    for (var i = 0; i < 1; i++) {
        if (allTbs[i].value) { 
           valid = true;
           $('#employer_name_error'+i).html("");
           $('#designation_error'+i).html("");
           $('#role_desc_error'+i).html("");
           $('#exp_from_error'+i).html("");
           $('#exp_to_error'+i).html("");
        }else{ 
            $('#employer_name_error'+i).html("Field should not be blank");
            $('#designation_error'+i).html("Field should not be blank");
            $('#role_desc_error'+i).html("Field should not be blank");
            $('#exp_from_error'+i).html("Field should not be blank");
            $('#exp_to_error'+i).html("Field should not be blank");
            $('#employer_name_error'+i).focus();
            return false;
        }
    }
    if(valid==true){
    var data=$('#emp_exp').serializeArray();
    var param =1;
    $.ajax({  
            type: 'POST',  
            url: url+'addexperience_todb.php', 
            data: {param:param,data:data},
            //dataType : "text/html",
            success: function(result) {
                    //location.reload();
                    if(result=='1'){
                        window.location=url+'view-employee.php';
                    }else{
                        alert(result);return false;
                    }
            }
    });
    }
  });
});