
//	Gobal variables
var server_url = "./assets/server.php";
var user_photo_url = "./assets/images/users/";
if(typeof toastr != "undefined")
	toastr.options = {"timeOut": "2000","positionClass": "toast-bottom-right"};
var binded_event_array = [];
var table_filter = "";
var table_sortfield = "";
var default_page_rowcount = 5;
var color_palette = [
    ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
    ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
    ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
    ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
    ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
    ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
    ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
    ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
];

//	Global functions
function displayAlert(type,title,content,alert_for = "")
{
	if(alert_for == "")
	{
		$("#alert-box").attr("class",type);
		$("#alert-box .alert-title").html(title);
		$("#alert-box .alert-content").html(content);
		if(type == "success")
			$(".alert-type-icon i").attr("class","fas fa-check");
		if(type == "warning")
			$(".alert-type-icon i").attr("class","fas fa-times");
		$("#alert-box").fadeIn("slow");
		setTimeout(function(){
			$("#alert-box").fadeOut("slow");
		},3000)
	}
	else
	{
		$(alert_for + " " + "#alert-box").attr("class",type);
		$(alert_for + " " + "#alert-box .alert-title").html(title);
		$(alert_for + " " + "#alert-box .alert-content").html(content);
		if(type == "success")
			$(alert_for + " " + ".alert-type-icon i").attr("class","fas fa-check");
		if(type == "warning")
			$(alert_for + " " + ".alert-type-icon i").attr("class","fas fa-times");
		$(alert_for + " " + "#alert-box").fadeIn("slow");
		setTimeout(function(){
			$(alert_for + " " + "#alert-box").fadeOut("slow");
		},3000)
	}
}
function validateEmail(email) 
{
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
function log(e){
	console.log(e);
}