// Admin Panel settings
$.fn.AdminSettings = function (settings) {
    var myid = this.attr("id");
    // General option for vertical header 
    var defaults = {
        Layout: 'vertical',
        BoxedLayout: false
    };
    var settings = $.extend({}, defaults, settings);
    // Attribute functions 
    var AdminSettings = {
        // Settings INIT
        AdminSettingsInit: function () {
            AdminSettings.ManageThemeLayout();
            AdminSettings.ManageBoxedLayout();
        },

        //****************************
        // ManageThemeLayout functions
        //****************************
        ManageThemeLayout: function () {
            switch (settings.Layout) {
                case 'horizontal':
                    $('#' + myid).attr("data-layout", "horizontal");
                    break;
                case 'vertical':
                    $('#' + myid).attr("data-layout", "vertical");
                    $('.scroll-sidebar').perfectScrollbar({});
                    break;
                default:
            }
        },

        //****************************
        // ManageBoxedLayout functions
        //****************************
        ManageBoxedLayout: function () {
            var boxedlayout = settings.BoxedLayout;
            switch (settings.Layout) {
                case 'vertical':
                    if (boxedlayout == true) {
                        $('#' + myid).attr("data-boxed-layout", 'boxed');
                        $("#boxed-layout").prop("checked", !0);
                    } else {
                        $('#' + myid).attr("data-boxed-layout", 'full');
                        $("#boxed-layout").prop("checked", !1);
                    }
                    break;
                case 'horizontal':
                    if (boxedlayout == true) {
                        $('#' + myid).attr("data-boxed-layout", 'boxed');
                        $("#boxed-layout").prop("checked", !0);
                    } else {
                        $('#' + myid).attr("data-boxed-layout", 'full');
                        $("#boxed-layout").prop("checked", !1);
                    }
                    break;
                default:
            }
        },
    };
    AdminSettings.AdminSettingsInit();
};