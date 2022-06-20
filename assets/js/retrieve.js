

jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".retrieveUser", function(){
		var id = $(this).data("id"),
			hitURL = baseURL + "auth/retrieveUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to retrieve this user ?");
		
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
				if(data.status = true) { alert("User successfully retrieved"); }
				else if(data.status = false) { alert("User retrieving failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
