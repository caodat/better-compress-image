<?php
/**
 * Plugin Name: Better Compress Image
 * Plugin URI: http://caodatblog.com
 * Description: Better compress image for wordpress
 * Version: 1.0
 * Author: Cao Dat
 * Author URI: http://caodatblog.com
 * License: latter
 */
/*
 * Include assets for page admin*/
function load_stype_compress_image() {
    // Load only on ?page=mypluginname
    if(isset($_GET['page'])){
        $current_page = $_GET['page'];
        if($current_page === "compress-image" || $current_page === "compress-image-setting" ){
            wp_enqueue_style( 'compress-bootstrap', plugins_url( 'include/bootstrap/css/bootstrap.css', __FILE__ ) );
            wp_enqueue_style( 'compress-font-awesome', plugins_url( 'include/font-awesome/font-awesome.min.css', __FILE__ ) );
            wp_enqueue_script( 'compress-bootstrap-js', plugins_url( 'include/bootstrap/js/bootstrap.js', __FILE__), array(), '3.3.7', true );
            wp_enqueue_script( 'compress-custom-js', plugins_url( 'include/js/custom.js', __FILE__), array(), '1.0', true );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'load_stype_compress_image' );
/*
 * Create menu for admin page ======================*/
add_action( 'admin_menu', 'register_page_compress_image' );
function register_page_compress_image() {
    add_menu_page(
        'Compress image',
        'Compress image',
        'manage_options',
        'compress-image',
        'compress_image_render',
        'dashicons-format-image'
    );
    add_submenu_page(
        'compress-image',
        'Setting Compress Image',
        'Setting',
        'manage_options',
        'compress-image-setting',
        'compress_image_setting_render'
    );
}

/* Ajax load data image from folder uploads */
add_action( 'wp_ajax_load_data_image_uploads', 'load_data_image_uploads_callback' );
function load_data_image_uploads_callback(){
    require plugin_dir_path( __FILE__ ) . "include/info-image.php";
    wp_die();
}

/* Ajax compress image for all image in folder uploads */
add_action( 'wp_ajax_load_data_compress_image', 'load_data_compress_image_callback' );
function load_data_compress_image_callback(){
    require plugin_dir_path( __FILE__ ) . "include/compress.php";
    wp_die();
}

/* Ajax save setting compress image ===============*/
add_action( 'wp_ajax_save_setting_compress_image', 'save_setting_compress_image_callback' );
function save_setting_compress_image_callback(){
    if($_POST['quality']){
        $quality = $_POST['quality'];
        if(get_option('compress_image_quality')){
            update_option('compress_image_quality', $quality);
            echo 1; // Save success
        }
        else {
            add_option('compress_image_quality', $quality);
            echo 1; // Save success
        }
    }
    wp_die();
}
function compress_image_render() {
    $file = plugin_dir_path( __FILE__ ) . "include/admin.php";
    if ( file_exists( $file ) ) {
        require $file;
    }
}
function compress_image_setting_render(){
    $file = plugin_dir_path( __FILE__ ) . "include/setting.php";
    if ( file_exists( $file ) ) {
        require $file;
    }
}

