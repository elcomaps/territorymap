var password_changing_mail;
jQuery(document).ready(function(){
	$(".new-login-register #loginform button").on("click",function(){
		var user_login = $("#login-username").val();
		var user_password = $("#login-password").val();
		if(user_login == "")
			$("#login-username").parent().addClass("errorfield");
		if(user_password == "")
			$("#login-password").parent().addClass("errorfield");
		if((user_login == "")||(user_password == ""))
			return;
		jQuery.ajax({
		    url: server_url,
		    data: {"request":"userlogin", username:user_login, userpassword:user_password},
		    type: 'post',
			success: function(result) 
			{
				if(result == "Approved")
					window.location.href = "./index";
				else if(result == "Pending")
					displayAlert("warning","Notification","Registration against this account is pending for confirmation from site admin. Please try again after sometime.");
				else if(result == "Deleted")
					displayAlert("warning","Notification","Your account has been terminated.");
				else
					displayAlert("warning","Notification","Please enter a valid username or password.");
			}
		});
	})
	$("body").on("focusout", "#loginform .form-group input", function(){
		$(this).parent().removeClass("errorfield");
		var content = $(this).val();
		if(content == "")
			$(this).parent().addClass("errorfield");
	})
	$("#to-recover").on("click", function(){
		$(".login-form-panel .active").removeClass("active");
		$(".login-form-panel #forgot-modal").addClass("active");
	})
	$("body").on("keyup", "#forgot-modal #forgot-email", function(){
		$(this).parent().removeClass("errorfield");
		var mail = $(this).val();
		if (!validateEmail(mail)) 
			$(this).parent().addClass("errorfield");
	});
	$("#forgot-modal button.send").on("click", function(){
		var mail = $("#forgot-email").val();
		if (!validateEmail(mail)) 
		{
			$("#forgot-email").parent().addClass("errorfield");
			return;
		}
		jQuery.ajax({
            url: server_url,
            data: {mail:mail, 'request':'forgotpassword'},
            type: 'post',
            success: function(result) {
                if(result == "success")
                {
                    password_changing_mail = mail;
                    $("#forgot-modal").removeClass("active");
                    $("#forgot-second-modal").addClass("active");
                }
                else if(result == "no")
                    toastr.warning("The email address you entered does not exist.");
                else
                    toastr.error("It is failed to transmit. Try again.");
            }
        });
	})
	$("body").on("click","#forgot-second-modal button.change",function(){
        var verifycode = $("#forgot-second-modal #verifycode-input").val();
        var pass = $("#forgot-second-modal #password-input").val();
        var pass_repeat = $("#forgot-second-modal #password-input2").val();
        if(verifycode == "")
			$("#forgot-second-modal .verifycode-input").parent().addClass("errorfield");
		if(pass == "")
			$("#forgot-second-modal #password-input").parent().addClass("errorfield");
		if (pass_repeat == "") 
			$("#forgot-second-modal #password-input2").parent().addClass("errorfield");
		if(pass != pass_repeat)
			$("#register-confirmpassword").parent().addClass("errorfield");

        if((verifycode == "")||(pass == "")||(pass_repeat == ""))
        	return;
        if(pass != pass_repeat)
        	return;
        jQuery.ajax({
            url: server_url,
            data: {mail:password_changing_mail,verifycode:verifycode,pass:pass, 'request':'changepassword'},
            type: 'post',
            success: function(result) {
                if(result == "success")
                {
                    toastr.success("Successfully changed.");
                    $("#forgot-second-modal").removeClass("active");
                    $("#loginform").addClass("active");
                }
                else if(result == "wrongcode")
                    toastr.warning("Incorrect code. Please try again.");
                else
                    toastr.warning("An error occurred on server.");
            }
        });
    });
    $("body").on("focusout", "#forgot-second-modal input[id!='password-input2']", function(){
		$(this).parent().removeClass("errorfield");
		var content = $(this).val();
		if(content == "")
			$(this).parent().addClass("errorfield");
	})
	$("body").on("keyup", "#forgot-second-modal #password-input2", function(){
		$(this).parent().removeClass("errorfield");
		
		var password = $("#password-input").val();
		var confirmpassword = $("#password-input2").val();
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
	$(".login-form-panel .back-btn").on("click", function(){
		$(".form-horizontal").removeClass("active");
        $("#loginform").addClass("active");
	})
});