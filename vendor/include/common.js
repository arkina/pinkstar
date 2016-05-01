function del(pageName , pageId){
	if(pageName != '' && pageName != 'undefine' && pageId!= '' && pageId!= 'undefine'){
		var pageName = pageName; var pageId = pageId;var check = 3;
		url = 'http://pinkstarapp.com/administrator/';
		$.ajax({  
				type: 'POST',  
				url: url+'getcountry.php', 
				data: {pageName : pageName,pageId : pageId , checkdata : 3},
				dataType : "html",
				success: function(data) {
				window.location=url+'view-page.php';
				}
			});
		return false;
	}
}
function activatePage(pageName , pageId){
	if(pageName != '' && pageName != 'undefine' && pageId!= '' && pageId!= 'undefine'){
		var pageName = pageName; var pageId = pageId;var check = 3;
		url = 'http://pinkstarapp.com/administrator/';
		$.ajax({  
				type: 'POST',  
				url: url+'getcountry.php', 
				data: {pageName : pageName,pageId : pageId , checkdata : 3},
				dataType : "html",
				success: function(data) {
				window.location=url+'view-page.php';
				}
			});
		return false;
	}
}

function activePage(pageName , pageid,url){
	if(pageName!="" && pageid!="" && url!=""){
		var pageName = pageName; var pageId = pageid; var newUrl =url;
		if(url == 'cuisine'){ if(newUrl){ newUrl ='view-cuisine.php';url ='cousines';}}else{newUrl ='view-category-list.php';}
		var tableName ='ps_'+url;
		url = 'http://pinkstarapp.com/administrator/';
		$.ajax({  
				type: 'POST',  
				url: url+'getcountry.php', 
				data: {pageName : pageName,pageId : pageId , checkdata : 4, pageUrl : newUrl ,tab : tableName },
				dataType : "html",
				success: function(data) {
				//alert('Data is '+data);return false;
				window.location=url+newUrl;
				}
			});
		return false;
	}
}

function deletePage(pageName,pageid,url,tableName){
	if(pageName!="" && pageid!="" && url!=""&& tableName!=""){
		var pageName = pageName; var pageId = pageid; var newUrl =url;
		if(newUrl){ newUrl =url+'.'+'php';}
		var tableName ='ps_'+tableName;
		url = 'http://pinkstarapp.com/administrator/';
		$.ajax({  
				type: 'POST',  
				url: url+'getcountry.php', 
				data: {pageName:pageName,pageId:pageId,pageUrl:newUrl,tab:tableName },
				dataType : "html",
				success: function(data) {
					window.location=url+newUrl;
				}
			});
		return false;
	}
}


function deletePremanetly(pageName,pageid,url,tableName){
	if(pageName!="" && pageid!="" && url!=""&& tableName!=""){
		var pageName = pageName; var pageId = pageid; var newUrl =url;
		if(newUrl){ newUrl =url+'.'+'php';}
		var tableName ='ps_'+tableName;
		url = 'http://pinkstarapp.com/administrator/';
		$.ajax({  
				type: 'POST',  
				url: url+'getcountry.php', 
				data: {pageName:pageName,pageId:pageId,pageUrl:newUrl,tab:tableName ,checkdata:5},
				dataType : "html",
				success: function(data) {
					window.location=url+newUrl;
				}
			});
		return false;
	}
}

function locationDel(pageName,location_id,url){
	var nid = $("#pid").val();
		if(pageName == 'locDel'){
			var existsUrl = url+'.php?pid='+location_id;
			var r = confirm("Really want to delete Country");
				if (r == true) {
    				url = 'http://pinkstarapp.com/administrator/';
					var reUrl = 'http://pinkstarapp.com/administrator/';
						$.ajax({  
								type: 'POST',  
								url: url+'location_details.php', 
								data: {pageName:pageName,pageId:location_id},
								dataType : "html",
								success: function(data) {
								$("#showajax_error").html(data);
								$("#showajax_error").show();
								setTimeout(function(){ $("#showajax_error").hide(); window.location=reUrl+existsUrl; }, 3000);
								}
							});
						return false;
				} else {
					return false;
			}
		}if(pageName == 'stateDel'){
			var existsUrl = url+'.php?pid='+location_id+'&nid='+nid;
			var r = confirm("Really want to delete State");
				if (r == true) {
    				url = 'http://pinkstarapp.com/administrator/';
					var reUrl = 'http://pinkstarapp.com/administrator/';
						$.ajax({  
								type: 'POST',  
								url: url+'location_details.php', 
								data: {pageName:pageName,pageId:location_id},
								dataType : "html",
								success: function(data) {
								//alert("Data is"+data);return false;
								$("#showajax_error").html(data);
								$("#showajax_error").show();
								setTimeout(function(){ $("#showajax_error").hide(); window.location=reUrl+existsUrl; }, 3000);
								}
							});
						return false;
				} else {
					return false;
			}
		}if(pageName == 'cityDel'){
			var existsUrl = url+'.php?pid='+location_id;
			var r = confirm("Really want to delete City");
				if (r == true) {
    				url = 'http://pinkstarapp.com/administrator/';
					var reUrl = 'http://pinkstarapp.com/administrator/';
						$.ajax({  
								type: 'POST',  
								url: url+'location_details.php', 
								data: {pageName:pageName,pageId:location_id},
								dataType : "html",
								success: function(data) {
								$("#showajax_error").html(data);
								$("#showajax_error").show();
								setTimeout(function(){ $("#showajax_error").hide(); window.location=reUrl+existsUrl; }, 3000);
								}
							});
						return false;
				} else {
					return false;
			}
		}
}

