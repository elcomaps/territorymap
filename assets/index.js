
var last_territory = "";

jQuery(document).ready(function(){
	$("#navbarSupportedContent ul:first-child li:nth-child(1)").addClass("active");

	var region_list = $("#region_list")
	for (var region in simplemaps_countymap_mapdata.regions){
		var key = region;
		var value = simplemaps_countymap_mapdata.regions[region].name;
		 region_list.append($("<option></option>").attr("value",key).text(value)); 
	}						
	region_list.chosen();
	region_list.change(function(){
		var id = $(this).val();
		simplemaps_countymap.region_zoom(id);
	});

	////////////////////////////////////////////////////////////////////////////////

	var state_list = $("#state_list")
	for (var state in simplemaps_countymap_mapdata.state_specific){
		var key = state;
		var value = simplemaps_countymap_mapdata.state_specific[state].name;
		 state_list.append($("<option></option>").attr("value",key).text(value)); 
	}						
	state_list.chosen();
	state_list.change(function(){
		var id = $(this).val();
		simplemaps_countymap.state_zoom(id);
	});
	$("#searchby_city").hide();

	////////////////////////////////////////////////////////////////////////////////

	var zipcode = $("#zipcode");
	zipcode.keyup(function(event){
		if(event.which == 13)
		{
			var code = $(this).val();
			$.getJSON('http://api.zippopotam.us/us/' + code, function(data) {
				var state_id = "";
				for (var state in simplemaps_countymap_mapdata.state_specific){
					if(simplemaps_countymap_mapdata.state_specific[state].name == data.places[0]['place name'])
					{
						state_id = state;
						break;
					}
				}
				if(state_id != "")
					simplemaps_countymap.state_zoom(state_id);
				else
			  		simplemaps_countymap.region_zoom(data.places[0]['state abbreviation']);
			}).fail(function() {
		    	toastr.error("Zip Code is invalid or error occurred on server. Try again.");
		  	});
		}
	});

	////////////////////////////////////////////////////////////////////////////////

	$("#searchby").change(function(){
		$(".searchable_widget > div").hide();
		$("#searchby_" + $(this).val()).show();
	})

	$("body").on("click", ".sp_remove", function(event){
		event.preventDefault();
		var confirm = window.confirm("It will be removed from the database. Ok?");
		if(confirm)
		{
			var id = $(this).attr("sp_id");
			jQuery.ajax({
			    url: server_url,
			    data: {"request": "removesalesperson", id: id},
			    type: 'post',
			    success: function(result) 
				{
					if(result == "success")
					{
						displayData(last_territory);
						toastr.success("It is removed.");
					}
					else
						toastr.error("It is failed to remove because of an error on server. Try again.");
				}
			});
		}
	})

	////////////////////////////////////////////////////////////////////////////////

});

simplemaps_countymap.hooks.zooming_complete = function(){
	if(simplemaps_countymap.zoom_level_id == false)
		displayData("");
	else
		displayData(simplemaps_countymap.zoom_level_id);
}

simplemaps_countymap.hooks.back = function(){
	$("#state_list").val(''); //When you zoom out, reset the select
	$("#state_list").trigger("chosen:updated"); //update chosen

	$("#region_list").val(''); //When you zoom out, reset the select
	$("#region_list").trigger("chosen:updated"); //update chosen

	$("#zipcode").val('');
}

function displayData(territory)
{
	for (let key in simplemaps_countymap_mapdata.state_specific) {
  		delete simplemaps_countymap_mapdata.state_specific[key].color;
	}
	$("#sp_table tbody").html("");
	
	last_territory = territory;

	jQuery.ajax({
	    url: server_url,
	    data: {"request": "getdata", territory: territory},
	    type: 'post',
	    dataType: 'json',
		success: function(result) 
		{
			for (var i = 0; i < result.length; i++) {
				var salesperson = result[i];
				
				var states = JSON.parse(salesperson.sp_area);
				states.forEach(function(item){
					simplemaps_countymap_mapdata.state_specific[item.split('_')[0]].color = salesperson.sp_color;
				}); 
				var row = $('<tr><td>'+(i+1)+'</td><td>'+salesperson.sp_name+'</td><td>'+salesperson.sp_level+'</td><td>'+salesperson.sp_address+'</td><td>'+salesperson.sp_phone+'</td><td>'+salesperson.sp_fax+'</td><td>'+salesperson.sp_email+'</td><td>'+salesperson.sp_note+'</td><td>'+salesperson.salesmanager+'</td><td><div class="sp_color" style="background:'+salesperson.sp_color+'"></div></td></tr>');
				if(user_role == "Administrator")
					row.append($('<td><a target="_blank" href="edit?id='+salesperson.id+'"><i class="fas fa-edit"></i></a><a href="#" class="sp_remove" sp_id="'+salesperson.id+'"><i class="fas fa-trash-alt"></i></a></td>'));
				$("#sp_table tbody").append(row);
			}
			if(result.length)
				simplemaps_countymap.refresh();
		}
	});
}