
simplemaps_countymap.hooks.complete = function(){
	LoadInitialData();
}

jQuery(document).ready(function(){
	$("#navbarSupportedContent ul:first-child li:nth-child(2)").addClass("active");

	$("#sp_save").on("click",function(){
		var sp_level = $("#sp_level").val();
		if((sp_level != "Sales Manager") && (simplemaps_select.selected.length == 0))
		{
			toastr.warning("Please select the regions.");
			return;
		}
		var t_array = [];	
		for (var i = 0; i < simplemaps_select.selected.length; i++) {
			for (var region in simplemaps_countymap_mapdata.regions){
				if(simplemaps_countymap_mapdata.regions[region].states.indexOf(simplemaps_select.selected[i]) != -1)
				{
					t_array.push(simplemaps_select.selected[i] + "_" + region);
					break;
				}
			}
		}
		var sp_area = JSON.stringify(t_array);
		var sp_name = $("#sp_name").val();
		var sp_phone = $("#sp_phone").val();
		var sp_address = $("#sp_address").val();
		var sp_fax = $("#sp_fax").val();
		var sp_email = $("#sp_email").val();
		var sp_note = $("#sp_note").val();
		var sp_manager = $("#sp_manager").val();
		if(sp_level == "Sales Manager")
			sp_manager = "";
		var sp_color = simplemaps_select.selected_color;

		if(sp_name == "")
		{
			displayAlert("warning","Warning!","You have to fill in the Name.");
			return;
		}
		if((sp_email != "") && (!validateEmail(sp_email))) 
		{
			displayAlert("warning","Warning!","Invalid email address.");
			return;
		}

		jQuery.ajax({
		    url: server_url,
		    data: {"request":"updatesalesperson", id:sp_id, sp_name:sp_name, sp_phone:sp_phone, sp_address:sp_address, sp_fax:sp_fax, sp_email:sp_email, sp_note:sp_note, sp_manager:sp_manager, sp_level:sp_level, sp_color:sp_color, sp_area:sp_area},
		    type: 'post',
			success: function(result) 
			{
				switch(result)
				{
					case "success":				
						displayAlert("success","Success!","Changes are saved.");
						break;					
					case "double":				
						displayAlert("warning","Warning!","The email you entered already exists.");
						break;				
					default:				
						displayAlert("warning","Warning!","Failed. Please try again later.");
						break;
				}
			}
		});
	})

	$("#sp_level").change(function(){
		if($(this).val() == "Sales Manager")
			$("#sp_manager").parent().hide();
		else
			$("#sp_manager").parent().show();
	})

});

function LoadInitialData()
{
	jQuery.ajax({
	    url: server_url,
	    data: {"request": "getsalesperson", id: sp_id},
	    type: 'post',
	    dataType: 'json',
	    success: function(result) 
		{
			var salesperson = result.salesperson;
			var sm_list = result.salesmanager;
			$("#sp_name").val(salesperson.sp_name);
			$("#sp_level").val(salesperson.sp_level);
			$("#sp_phone").val(salesperson.sp_phone);
			$("#sp_address").val(salesperson.sp_address);
			$("#sp_fax").val(salesperson.sp_fax);
			$("#sp_email").val(salesperson.sp_email);
			$("#sp_note").val(salesperson.sp_note);
			sm_list.forEach(function(item){
				$("#sp_manager").append($('<option value="' + item.id + '">' + item.sp_name  + '</option>'));
			}); 
			if(salesperson.sp_level != "Sales Manager")
			{
				$("#sp_manager").val(salesperson.sp_manager);
				$("#sp_manager").parent().show();
			}
			$("#sp_color").spectrum({
				color: salesperson.sp_color,
			    showPaletteOnly: true,
			    change: function(color) {
			        simplemaps_select.selected_color = color.toHexString();
			    },
			    palette: color_palette
			});

			simplemaps_select.selected_color = salesperson.sp_color;
			var sp_area = JSON.parse(salesperson.sp_area);
			sp_area.forEach(function(item){
				simplemaps_select.select(item.split('_')[0]);
			});
		}
	});
}