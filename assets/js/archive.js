
jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".archiveUser", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "auth/archiveUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to archive this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { id : id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully archived"); }
				else if(data.status = false) { alert("User archived failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
