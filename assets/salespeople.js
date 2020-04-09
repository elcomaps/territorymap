
jQuery(document).ready(function(){
	$("#navbarSupportedContent ul:first-child li:nth-child(2)").addClass("active");

	displayData();
});

function displayData()
{
	jQuery.ajax({
	    url: server_url,
	    data: {"request": "getdata", territory: "all"},
	    type: 'post',
	    dataType: 'json',
		success: function(result) 
		{
			for (var i = 0; i < result.length; i++) {
				var salesperson = result[i];
				var row = $('<tr><td>'+(i+1)+'</td><td>'+salesperson.sp_name+'</td><td>'+salesperson.sp_level+'</td><td>'+salesperson.sp_address+'</td><td>'+salesperson.sp_phone+'</td><td>'+salesperson.sp_fax+'</td><td>'+salesperson.sp_email+'</td><td>'+salesperson.sp_note+'</td><td>'+salesperson.salesmanager+'</td></tr>');
				row.append($('<td><a target="_blank" href="edit?id='+salesperson.id+'"><i class="fas fa-edit"></i></a></td>'));
				$("#sp_table tbody").append(row);
			}
			$('#sp_table').DataTable();
		}
	});
}