jQuery(document).ready(function () {

    /*Ajax get data image from folder uploads*/
    jQuery(".cacualator").click(function (e) {
        e.preventDefault();
        jQuery.ajax({
            type: 'POST',
            url: document.location.origin + '/wp-admin/admin-ajax.php',
            data: {
                action: 'load_data_image_uploads', // load function hooked to: "wp_ajax_*" action hook
            },
            success: function (result) {
                jQuery(".result").html(result);
            }
        })
    });

    /*Ajax compress image */
    jQuery(".optimize").click(function (e) {
        e.preventDefault();
        jQuery(this).addClass("disabled");
        jQuery(this).html("Đang optimize hình ảnh. Vui lòng chờ <i class='fa fa-spinner fa-spin'></i>");
        jQuery.ajax({
            type: 'POST',
            url: document.location.origin + '/wp-admin/admin-ajax.php',
            data: {
                action: 'load_data_compress_image', // load function hooked to: "wp_ajax_*" action hook
            },
            success: function (result) {
                jQuery(".optimize").removeClass("disabled");
                jQuery(".optimize").html("Bắt đầu optimizer hình ảnh");
                jQuery(".result").html(result);
            }
        })
    });

    /*Ajax save setting compress image =======================*/
    jQuery(".save-setting").click(function (e) {
        e.preventDefault();
        var quality = jQuery(".quality").val() ;
        jQuery.ajax({
            type: 'POST',
            url: document.location.origin + '/wp-admin/admin-ajax.php',
            data: {
                action: 'save_setting_compress_image', // load function hooked to: "wp_ajax_*" action hook
                quality: quality
            },
            success: function (result) {
                if(result==1){
                    console.log(result)
                    jQuery(".alert-success").removeClass("hide");
                }
            }
        })
    });

    /*Custom button close alert bootstrap ===================*/
    jQuery("#save-success .close").click(function(e){
        e.preventDefault();
        jQuery(this).parent("#save-success").addClass("hide");
    });
});