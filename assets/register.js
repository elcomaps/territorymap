
jQuery(document).ready(function(){
	$("#register_btn").on("click",function(){
		$(".errorfield").removeClass("errorfield");
		var firstname = $("#register-firstname").val();
		var lastname = $("#register-lastname").val();
		var username = $("#register-username").val();
		var email = $("#register-email").val();
		var password = $("#register-password").val();
		var confirmpassword = $("#register-confirmpassword").val();

		if(firstname == "")
			$("#register-firstname").parent().addClass("errorfield");
		if(lastname == "")
			$("#register-lastname").parent().addClass("errorfield");
		if(username == "")
			$("#register-username").parent().addClass("errorfield");
		if(email == "")
			$("#register-email").parent().addClass("errorfield");
		if(password == "")
			$("#register-password").parent().addClass("errorfield");
		if(confirmpassword == "")
			$("#register-confirmpassword").parent().addClass("errorfield");
		if (!validateEmail(email)) 
			$("#register-email").parent().addClass("errorfield");
		if(password != confirmpassword)
			$("#register-confirmpassword").parent().addClass("errorfield");
		
		if((firstname == "")||(lastname == "")||(username == "")||(email == "")||(password == "")||(confirmpassword == ""))
			return;
		if (!validateEmail(email)) 
			return;
		if(password != confirmpassword)
			return;	
		jQuery.ajax({
		    url: server_url,
		    data: {"request":"register", firstname:firstname, lastname:lastname, username:username, email:email, password:password},
		    type: 'post',
			success: function(result) 
			{
				switch(result)
				{
					case "success":			
						$("#loginform .form-row:not(:last-child)").remove();	
						displayAlert("success","Congratulations!","An email has been send to the site administrator. The administrator will review the information that has been submitted and either approve or deny your request. You will get notified soon on your email.");
						setTimeout(function(){
							window.location.href = "./login";
						}, 3000);
						break;					 
					case "double":		
						displayAlert("warning","Warning","That email or username already exists.");		
						break;				
					default:				 
						displayAlert("warning","Warning","Failed to sign up. Please try again.");		
						break;
				}
			}
		});
	})
	$("body").on("focusout", "#loginform input[id!='register-confirmpassword']", function(){
		$(this).parent().removeClass("errorfield");
	
		var content = $(this).val();
		if(content == "")
			$(this).parent().addClass("errorfield");
		else if(($(this).attr("id") == "register-email")&&(!validateEmail(content)))
			$(this).parent().addClass("errorfield");
	})
	$("body").on("keyup", "#loginform #register-confirmpassword", function(){
		$(this).parent().removeClass("errorfield");
		
		var password = $("#register-password").val();
		var confirmpassword = $("#register-confirmpassword").val();
		if(confirmpassword == "")
		{
			$(this).parent().find("span").html("Please enter your password to continue.");
			$(this).parent().addClass("errorfield");
		}
		else
		{
			if(password != confirmpassword)
			{
				$(this).parent().find("span").html("The specified passwords do not match.");
				$(this).parent().addClass("errorfield");
			}
		}
	});
});