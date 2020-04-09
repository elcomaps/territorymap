
jQuery(document).ready(function(){
	$("#navbarSupportedContent ul:first-child li:nth-child(2)").addClass("active");
	simplemaps_select.selected_color = color_palette[0][0];

	$("#sp_color").spectrum({
	    showPaletteOnly: true,
	    change: function(color) {
	        simplemaps_select.selected_color = color.toHexString();
	    },
	    palette: color_palette
	});
	
	$("#sp_add").on("click",function(){
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
		    data: {"request":"addsalesperson", sp_name:sp_name, sp_phone:sp_phone, sp_address:sp_address, sp_fax:sp_fax, sp_email:sp_email, sp_note:sp_note, sp_level:sp_level, sp_color:sp_color, sp_area:sp_area},
		    type: 'post',
			success: function(result) 
			{
				switch(result)
				{
					case "success":				
						displayAlert("success","Success!","New sales person is added successfully!.");
						$("#sp_name").val("");
						$("#sp_phone").val("");
						$("#sp_address").val("");
						$("#sp_fax").val("");
						$("#sp_email").val("");
						$("#sp_note").val("");
						simplemaps_select.deselect_all();
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

});