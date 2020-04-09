var menu_display_dealy_timer;
jQuery(document).ready(function(){
	binded_event_array = [];
	table_filter = "";
	table_sortfield = "";
	$("#user-logout").on("click",function(){
		jQuery.ajax({
		    url: server_url,
		    data: {"request":"userlogout"},
		    type: 'post',
			success: function(result) 
			{
				window.location.href = "./";
			}
		});
	})
	$("#navbarSupportedContent ul:first-child li").on("mouseenter", function(){
		if($(window).width() < 767)
			return;
		clearTimeout(menu_display_dealy_timer);
		$(".show").removeClass("show");
		$(this).addClass("show");
		$(this).find(".dropdown-menu").addClass("show");
	})
	$("#navbarSupportedContent ul:first-child li").on("mouseleave", function(){
		if($(window).width() < 767)
			return;
		menu_display_dealy_timer = setTimeout(function(){
			$(".show").removeClass("show");
		},250);
	});
});

