
jQuery(document).ready(function(){
	$("#navbarSupportedContent ul:first-child li:nth-child(3)").addClass("active");
	LoadInitialData();

	$("#save_change").on("click",function(){
		var firstname = $("#e_firstname").val();
		var lastname = $("#e_lastname").val();
		var username = $("#e_username").val();
		var email = $("#e_email").val();
		var role = $("#e_userrole").val();
		var status = $("#e_userstatus").val();
		var password = $("#e_password").val();
		var confirmpassword = $("#e_confirmpassword").val();
		if((firstname == "")||(lastname == "")||(username == "")||(email == ""))
		{
			displayAlert("warning","Warning!","You have to fill in the blank.");
			return;
		}
		if (!validateEmail(email)) 
		{
			displayAlert("warning","Warning!","Invalid email address.");
			return;
		}
		if(password != confirmpassword)
		{
			displayAlert("warning","Warning!","Please confirm changing password again.");
			return;	
		}
		jQuery.ajax({
		    url: server_url,
		    data: {"request":"edituser", id:user_id, firstname:firstname, lastname:lastname, username:username, email:email, role:role, status:status, password:password},
		    type: 'post',
			success: function(result) 
			{
				switch(result)
				{
					case "success":				
						displayAlert("success","Success!","Changes are saved.");
						break;					
					case "double":				
						displayAlert("warning","Warning!","The email or username you entered already exists.");
						break;				
					default:				
						displayAlert("warning","Warning!","It is failed to create user account. Please try again.");
						break;
				}
			}
		});
	})
});

function LoadInitialData()
{
	jQuery.ajax({
	    url: server_url,
	    data: {"request": "getuser", id: user_id},
	    type: 'post',
	    dataType: 'json',
	    success: function(result) 
		{
			$("#e_firstname").val(result.user_firstname);
			$("#e_lastname").val(result.user_lastname);
			$("#e_username").val(result.user_login);
			$("#e_email").val(result.user_email);
			$("#e_userrole").val(result.user_role);
			$("#e_userstatus").val(result.user_status);
		}
	});
}