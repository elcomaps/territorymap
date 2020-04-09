
jQuery(document).ready(function(){
	$("#navbarSupportedContent ul:first-child li:nth-child(3)").addClass("active");

	$("#newsuer-register-btn").on("click",function(){
		var firstname = $("#newuser-firstname").val();
		var lastname = $("#newuser-lastname").val();
		var username = $("#newuser-username").val();
		var email = $("#newuser-email").val();
		var password = $("#newuser-password").val();
		var confirmpassword = $("#newuser-confirmpassword").val();
		var userrole = $("#newuser-userrole").val();
		if((firstname == "")||(lastname == "")||(username == "")||(email == "")||(password == "")||(confirmpassword == ""))
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
			displayAlert("warning","Warning!","Please confirm password again.");
			return;	
		}
		jQuery.ajax({
		    url: server_url,
		    data: {"request":"addnewuser", firstname:firstname, lastname:lastname, username:username, email:email, password:password, userrole:userrole},
		    type: 'post',
			success: function(result) 
			{
				switch(result)
				{
					case "success":				
						displayAlert("success","Success!","A new user account is created.");
						$("#newuser-firstname").val("");
						$("#newuser-lastname").val("");
						$("#newuser-username").val("");
						$("#newuser-email").val("");
						$("#newuser-password").val("");
						$("#newuser-confirmpassword").val("");
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