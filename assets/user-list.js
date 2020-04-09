
jQuery(document).ready(function(){
	$("#navbarSupportedContent ul:first-child li:nth-child(3)").addClass("active");

	displayData();
});

function displayData()
{
	jQuery.ajax({
	    url: server_url,
	    data: {"request": "getuserlist"},
	    type: 'post',
	    dataType: 'json',
		success: function(result) 
		{
			for (var i = 0; i < result.length; i++) {
				var t = result[i];
				var row = $('<tr><td>'+(i+1)+'</td><td>'+(t.user_firstname+' '+t.user_lastname)+'</td><td>'+t.user_role+'</td><td>'+t.user_email+'</td><td>'+t.user_status+'</td></tr>');
				row.append($('<td><a target="_blank" href="user-edit?id='+t.id+'"><i class="fas fa-edit"></i></a></td>'));
				$("#user_table tbody").append(row);
			}
			$('#user_table').DataTable();
		}
	});
}