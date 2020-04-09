
jQuery(document).ready(function(){
	$("#user-update").on("click",function(){
		var newusername = $("#settings-username").val();
		var newemail = $("#settings-email").val();
		var newfirstname = $("#settings-firstname").val();
		var newlastname = $("#settings-lastname").val();
		var newpassword = $("#settings-newpassword").val();
		var confirmpassword = $("#settings-confirmpassword").val();
		var oldpassword = $("#settings-oldpassword").val();

		if(oldpassword == "")
		{
			displayAlert("warning","Warning!","You have to enter the old password.");
			return;
		}
		if((newusername == "")&&(newemail == "")&&(newfirstname == "")&&(newlastname == "")&&(newpassword == ""))
		{
			displayAlert("warning","Warning!","You have to fill any field.");
			return;
		}
		if ((newemail != "")&&(!validateEmail(newemail))) 
		{
			displayAlert("warning","Warning!","Invalid email address.");
			return;
		}
		if(newpassword != confirmpassword)
		{
			displayAlert("warning","Warning!","Please confirm password again.");
			return;	
		}
		jQuery.ajax({
		    url: server_url,
		    data: {"request":"userupdate", oldpassword:oldpassword, newusername:newusername, newfirstname:newfirstname, newlastname:newlastname, newemail:newemail, newpassword:newpassword},
		    type: 'post',
			success: function(result) 
			{
				switch(result)
				{
					case "success":				
						displayAlert("success","Congratulations!","updated successfully.");
						setTimeout(function(){
							window.location.href = "./user-profile";
						}, 1000);
						break;					
					case "double":				
						displayAlert("warning","Warning!","The email address or username alreay exists.");
						break;				
					default:				
						displayAlert("warning","Warning!","Update failed.");
						break;
				}
			}
		});
	})
	$('#settings-box-picture-change').on("change", function(){    
	    formdata = new FormData();
	    if($(this).prop('files').length > 0)
	    {
	        file =$(this).prop('files')[0];
	        formdata.append("usericon", file);
	        formdata.append("request", "changeusericon");
	        jQuery.ajax({
			    url: server_url,
			    type: "POST",
			    data: formdata,
			    processData: false,
			    contentType: false,
			    success: function (result) {
			    	var data = JSON.parse(result);
			        if(data.result == "formaterror")
			        	displayAlert("warning","Warning!","You have to upload jpg or png file.");
			        else if(data.result == "sizeerror")
			        	displayAlert("warning","Warning!","File size must be less than 5MB.");
			        else if(data.result == "success")
			        {
			        	var photo_url = user_photo_url + data.filename;
			        	$(".card-body .user-photo").attr("src",photo_url);
			        	$(".nav-item .user-photo").attr("src",photo_url);
			        	displayAlert("success","Congratulations!","Photo changed.");
			        }
			        else
			        	displayAlert("warning","Warning!","Update failed.");
			    }
			});
	    }
	})
});