function saveEditedUserTable(type, where)
{
	var data = [];
	var nodata = true;
	var nullfield = false;
	$("." + where + " table tbody tr.editing").each(function(){
		var row = {};
		row["id"] = $(this).attr("user-id");
		row["username"] =  $(this).children("td").eq(1).find("input").val();
		row["firstname"] =  $(this).children("td").eq(2).find("input").val();
		row["lastname"] =  $(this).children("td").eq(3).find("input").val();
		row["email"] =  $(this).children("td").eq(4).find("input").val();
		row["role"] =  $(this).children("td").eq(5).find("select").val();
		nodata = false;
		if((row["username"] == "")||(row["firstname"] == "")||(row["lastname"] == "")||(row["email"] == ""))
		{
			nullfield = true;
			return false;
		}
		data.push(row);
	})
	if(nodata)
		return false;
	if(nullfield)
	{
		toastr.warning("There is blank field.");
		return false;
	}
	jQuery.ajax({
	    url: server_url,
	    data: {"request":"updateuserarray", data:JSON.stringify(data)},
	    type: 'post',
		success: function(result) 
		{
			if(result == "success")
			{
				toastr.success("The user information is updated.");
				var current = parseInt($("." + where + " nav ul .page-item.active .page-link").html());
				if(isNaN(current))
					current = 1;
				setUserTable(type, where, current);
			}
			else
				toastr.warning("Change failed");
		}
	});
	return true;
}
function setUserTable(type, where, page)
{
	$("." + where + "-filter .checkbox-action").removeClass("visible");
	var data = new Array();
	var page_rowcount = default_page_rowcount;
	var selected_rowcount = $("#" + where + "-rowcount").val();
	if((typeof selected_rowcount != "undefined")&&(!isNaN(selected_rowcount)))
		page_rowcount = selected_rowcount;
	jQuery.ajax({
	    url: server_url,
	    data: {"request":"getuserdata", "type":type, "page":page, filter:table_filter, sort:table_sortfield, rowcount:page_rowcount},
	    type: 'post',
	    dataType: 'json',
		success: function(result) 
		{
			var row = result["data"];
			var page_count = result["page_count"];
			$("." + where + " table tbody").html("");
			for (var i = 0; i < row.length; i++) {
				$("#checkbox-mockup .custom-control-input").attr("id","checkbox_" + row[i]["id"]);
				$("#checkbox-mockup .custom-control-label").attr("for","checkbox_" + row[i]["id"]);
				var tr = $('<tr user-id="'+row[i]["id"]+'"><td>'+$("#checkbox-mockup").html()+'</td><td>'+row[i]["user_login"]+'</td><td>'+row[i]["user_firstname"]+'</td><td>'+row[i]["user_lastname"]+'</td><td>'+row[i]["user_email"]+'</td><td>'+row[i]["user_role"]+'</td><td>'+$("#usertable-dropbox").html()+'</td></tr>');
				$("." + where + " table tbody").append(tr);
			}
			$("." + where + " table thead tr th:first-child .custom-control-input").prop("checked",false);
			setUserTablePagination(type,where,page,page_count);

			$("." + where).removeClass("hidden");
			$("." + where + "-nomessage").removeClass("hidden");
			$("." + where + "-filter").removeClass("hidden");
			if(page_count == 0)
			{
				$("." + where).addClass("hidden");
				$("." + where + "-filter").addClass("hidden");
			}
			else
				$("." + where + "-nomessage").addClass("hidden");
		}
	});
}
function setUserTablePagination(type, where, page, count)
{
	var ul = $("." + where + " nav ul");
	ul.html("");
	if(count > 1)
	{
		if(page == 1)
			var  li = $('<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>');
		else
			var  li = $('<li class="page-item"><a class="page-link" href="#" tabindex="-1">Previous</a></li>');
		ul.append(li);
		for (var i = 1; i <= count; i++) {
			if(i == page)
				li = $('<li class="page-item active"><a class="page-link" href="#">'+i+'</a></li>');
			else
				li = $('<li class="page-item"><a class="page-link" href="#">'+i+'</a></li>');
			ul.append(li);		
		}
		if(page == count)
			li = $('<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>');
		else
			li = $('<li class="page-item"><a class="page-link" href="#">Next</a></li>');
		ul.append(li);	
	}
	if(binded_event_array.indexOf(where) != -1)
		return;

	$("body").on("dblclick", "." + where + " table tbody tr td:not(:last-child)", function(e){
		$(this).parent().find(".dropdown-item[action='edit-row']").click();
	});

	$("body").on("keyup", "." + where + " table tbody tr td input", function(e){
		if(e.which == 13)
			saveEditedUserTable(type, where);
	});

	$("body").on("click", "." + where + "-filter .checkbox-action", function(){
		var checked_user_ids = [];
		$("." + where + " table tbody tr td .custom-control-input").each(function(){
			if($(this).prop("checked") == true)
				checked_user_ids.push($(this).attr("id").split("_")[1]);
		})
		if(checked_user_ids.length > 0)
		{
			var action = $(this).attr("info");
			switch(action)
			{
				case "save":
					if(saveEditedUserTable(type, where))
						$(this).removeClass("visible");
					break;
				case "delete":
					jQuery.ajax({
					    url: server_url,
					    data: {"request":"deleteuserarray", ids:checked_user_ids},
					    type: 'post',
						success: function(result) 
						{
							if(result == "success")
							{
								toastr.success("The user accounts are terminated.");
								setUserTable(type, where, 1);
							}
							else
								toastr.warning("Failed");
						}
					});
					break;
				case "remove":
					var really = window.confirm("Really delete permanently?");
					if(!really)
						return;
					jQuery.ajax({
					    url: server_url,
					    data: {"request":"removeuserarray", ids:checked_user_ids},
					    type: 'post',
						success: function(result) 
						{
							if(result == "success")
							{
								toastr.success("The user accounts are deleted.");
								setUserTable(type, where, 1);
							}
							else
								toastr.warning("Failed");
						}
					});
					break;
				case "approve":
					jQuery.ajax({
					    url: server_url,
					    data: {"request":"approveuserarray", ids:checked_user_ids},
					    type: 'post',
						success: function(result) 
						{
							if(result == "success")
							{
								toastr.success("The user accounts are approved.");
								setUserTable(type, where, 1);
							}
							else
								toastr.warning("Failed");
						}
					});
					break;
				case "pending":
					jQuery.ajax({
					    url: server_url,
					    data: {"request":"pendinguserarray", ids:checked_user_ids},
					    type: 'post',
						success: function(result) 
						{
							if(result == "success")
							{
								toastr.success("The status of user accounts are changed to Pending.");
								setUserTable(type, where, 1);
							}
							else
								toastr.warning("Failed");
						}
					});
					break;
				case "edit":
					var savebutton_visible = false;
					for (var j = 0; j < checked_user_ids.length; j++) {
						var user_id = checked_user_ids[j];
						var parent_tr = $("." + where + " table tbody tr[user-id='"+user_id+"']");
						if(!parent_tr.hasClass("editing"))
						{
							parent_tr.children("td").eq(1).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(1).html()+'" >');
							parent_tr.children("td").eq(2).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(2).html()+'" >');
							parent_tr.children("td").eq(3).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(3).html()+'" >');
							parent_tr.children("td").eq(4).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(4).html()+'" >');				
							var role_td = parent_tr.children("td").eq(5);
							var role_value = role_td.html();
							role_td.html('<select class="form-control"><option>Administrator</option><option>Subscriber</option></select>')
							role_td.find("select").val(role_value);
							parent_tr.children("td").eq(6).html($("#usertable-dropbox-editsave").html());
							parent_tr.addClass("editing");
							savebutton_visible = true;
						}
					}
					if(savebutton_visible)
						$("." + where + "-filter .checkbox-action[info='save']").addClass("visible");
					break;
			}
		}
		else
			toastr.warning("No user selected");
	})
	
	$("body").on("click", "." + where + " table thead tr th:first-child .custom-control-input", function(e){
		var checked = $(this).prop("checked");
		$("." + where + " table tbody tr td:first-child .custom-control-input").each(function(){
			$(this).prop("checked",checked);
		})
	});

	$("body").on("click", "." + where + " table .custom-control-input", function(e){
		var checked = false;
		$("." + where + " table .custom-control-input").each(function(){
			if($(this).prop("checked") == true)
				checked = true;
		})
		if(checked == true)
			$("." + where + "-filter .checkbox-action[info!='save']").addClass("visible");
		else
			$("." + where + "-filter .checkbox-action").removeClass("visible");
	});

	$("body").on("change", "#" + where + "-rowcount", function(e){
		setUserTable(type, where, 1);
	});
	
	$("body").on("click", "." + where + " thead tr th", function(e){
		var sortfield = $(this).attr("info");
		if((typeof sortfield == "undefined")||(sortfield == ""))
			return;
		if($(this).hasClass("desc"))
		{
			$(this).removeClass("desc");
			$(this).addClass("asc");
			$(this).find("i").removeClass("fa-angle-down");
			$(this).find("i").addClass("fa-angle-up");
			table_sortfield = " order by " + sortfield + " ASC";
		}
		else
		{
			$(this).addClass("desc");
			$(this).removeClass("asc");
			$(this).find("i").addClass("fa-angle-down");
			$(this).find("i").removeClass("fa-angle-up");
			table_sortfield = " order by " + sortfield + " DESC";
		}
		$("." + where + " thead tr th").removeClass("active");
		$(this).addClass("active");	
		setUserTable(type, where, 1);
	});

	$("body").on("click", "." + where + " nav .page-link", function(e){
		e.preventDefault();
		var current = parseInt($("." + where + " nav ul .page-item.active .page-link").html());
		var page = $(this).html();
		if((page == "Next")&&(current < count))
			setUserTable(type, where, current+1);
		else if((page == "Previous")&&(current > 1))
			setUserTable(type, where, current-1);
		else if(!isNaN(page))
			setUserTable(type, where, page);
	})

	$("body").on("click", "." + where + " tbody tr td .dropdown-item", function(e){
		e.preventDefault();
		var parent_tr = $(this).parent().parent().parent().parent();
		var user_id = parent_tr.attr("user-id");
		var action = $(this).attr("action");
		switch(action)
		{
			case "remove-user":
				var really = window.confirm("Really delete permanently?");
				if(!really)
					return;
				jQuery.ajax({
				    url: server_url,
				    data: {"request":"removeuser", id:user_id},
				    type: 'post',
				    success: function(result) 
					{
						if(result == "success"){
							toastr.success("The user account is deleted.");
							setUserTable(type, where, 1);
						}
						else
							toastr.warning("It is failed to delete user account.");
					}
				});	
				break;
			case "delete-user":
				jQuery.ajax({
				    url: server_url,
				    data: {"request":"deleteuser", id:user_id},
				    type: 'post',
				    success: function(result) 
					{
						if(result == "success"){
							toastr.success("The user account is terminated.");
							setUserTable(type, where, 1);
						}
						else
							toastr.warning("It is faile dto terminate user account.");
					}
				});	
				break;
			case "approve-user":
				jQuery.ajax({
				    url: server_url,
				    data: {"request":"approveuser", id:user_id},
				    type: 'post',
				    success: function(result) 
					{
						if(result == "success"){
							toastr.success("The user account is approved.");
							setUserTable(type, where, 1);
						}
						else
							toastr.warning("It is failed to approve user account.");
					}
				});	
				break;
			case "unapprove-user":
				jQuery.ajax({
				    url: server_url,
				    data: {"request":"unapproveuser", id:user_id},
				    type: 'post',
				    success: function(result) 
					{
						if(result == "success"){
							toastr.success("The user account is unapproved.");
							setUserTable(type, where, 1);
						}
						else
							toastr.warning("It is failed to unapprove user account.");
					}
				});	
				break;
			case "edit-row":
				parent_tr.children("td").eq(1).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(1).html()+'" >');
				parent_tr.children("td").eq(2).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(2).html()+'" >');
				parent_tr.children("td").eq(3).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(3).html()+'" >');
				parent_tr.children("td").eq(4).html('<input type="text" class="form-control" value="'+parent_tr.children("td").eq(4).html()+'" >');				
				var role_td = parent_tr.children("td").eq(5);
				var role_value = role_td.html();
				role_td.html('<select class="form-control"><option>Administrator</option><option>Subscriber</option></select>')
				role_td.find("select").val(role_value);
				parent_tr.children("td").eq(6).html($("#usertable-dropbox-editsave").html());
				parent_tr.addClass("editing");
				break;
			case "cancel-edit":
				var current = parseInt($("." + where + " nav ul .page-item.active .page-link").html());
				if(isNaN(current))
					current = 1;
				setUserTable(type, where, current);
				break;
			case "save-edit":
				var username = parent_tr.children("td").eq(1).find("input").val();
				var firstname = parent_tr.children("td").eq(2).find("input").val();
				var lastname = parent_tr.children("td").eq(3).find("input").val();
				var email = parent_tr.children("td").eq(4).find("input").val();
				var role = parent_tr.children("td").eq(5).find("select").val();
				if((username == "")||(firstname == "")||(lastname == "")||(email == ""))
				{
					toastr.warning("You have to fill in the blank");
					return;
				}
				jQuery.ajax({
				    url: server_url,
				    data: {"request":"updateuser", id:user_id, username:username, firstname:firstname, lastname:lastname, email:email, role:role},
				    type: 'post',
				    success: function(result) 
					{
						if(result == "success")
						{
							toastr.success("The user information is updated.");
							var current = parseInt($("." + where + " nav ul .page-item.active .page-link").html());
							if(isNaN(current))
								current = 1;
							setUserTable(type, where, current);
						}
						else if(result == "double")
							toastr.warning("That user name or email address is already existing.");
						else
							toastr.warning("Change failed");
					}
				});	
				break;
		}
	});

	$("body").on("change", "." + where + "-filter .filter-item", function(){
		$(this).parent().parent().find(".filter-group").html("");
		$(this).parent().parent().find(".filter-value").val("");
		var item = $(this).val();
		if(item == "user_role")
		{
			$(this).parent().parent().find(".filter-group").html('<option>Administrator</option><option>Subscriber</option>');
			$(this).parent().parent().find(".filter-value").css("display","none");
		}
	})
	$("." + where + "-filter .add-condition").on("click", function(e){
		e.preventDefault();
		$("." + where + "-filter .condition-rows").append($('#usertable-filtercondition').html());
	});
	$("." + where + "-filter .filter-clear").on("click", function(e){
		e.preventDefault();
		$("." + where + "-filter .condition-rows").html("");
	});
	$("." + where + "-filter .filter-apply").on("click", function(e){
		e.preventDefault();
		$(this).parent().parent().parent().parent().removeClass("show");
		table_filter = "";
		$("." + where + "-filter .condition-rows .form-row").each(function(){
			var where_clause = " AND";
			var include = $(this).find(".filter-include").val();
			var item = $(this).find(".filter-item").val();
			var group = $(this).find(".filter-group").val();
			var value = parseInt($(this).find(".filter-value").val());
			value = isNaN(value) ? 0 : value;
			if(item == "user_role")
			{
				where_clause = where_clause + " " + item;
				if(include == "Include")
					where_clause = where_clause + "=";
				else
					where_clause = where_clause + "!=";
				where_clause = where_clause + "'" + group + "'";
			}
			table_filter = table_filter + where_clause;
		})
		setUserTable(type, where, 1);
	});
	binded_event_array.push(where);
}