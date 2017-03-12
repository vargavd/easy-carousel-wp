<?php
/*
  Plugin Name: Easy Carousel
  Description: You can insert image slideshows ('carousels') in any documents or region with widgets. Lightbox functionality is also included in the plugin.
  Version: 0.1
  Author: Varga Dániel
  License: GPLv2
 */

/*
 * v0.1 miről fog szólni
 *  - Egy widget lesz, amit ide oda be lehet szúrni. 
 *  - Lehet shortcode-dal és widget szerűen is berakni.
 *  - Shortcode-dal ügye lehet a paramétereket is állitani.
 *  - A paraméterek megegyeznek a jQuery plugin paramétereivel.
 */

// API
include plugin_dir_path(__FILE__) . "api/galleries_db.php";
include plugin_dir_path(__FILE__) . "api/helper.php";
include plugin_dir_path(__FILE__) . "api/ec_gallery_widget.php";

// ADMIN
include plugin_dir_path(__FILE__) . "admin/admin.php";

// INSTALL
include plugin_dir_path(__FILE__) . "install.php";
register_activation_hook(__FILE__, 'ec_install');



// ACTIONS
function ec_register_widgets() {
    register_widget('EC_Gallery_Widget');
}
add_action('widgets_init', 'ec_register_widgets');


function ec_enqueue_script() {
    // registering
	wp_register_script('ec-gallery-component', plugin_dir_url(__FILE__) . '/js/easy-carousel.js', false, "0.1" );

    // enquing
    wp_enqueue_style('easy-carousel-wp', plugin_dir_url(__FILE__) . '/css/easy-carousel-wp.css', false, "0.1");
}
add_action( 'wp_enqueue_scripts', 'ec_enqueue_script' );



// SHORTCODE
function ec_gallery_shortcode($atts) {
    $default_options = ec_get_all_options();

    $options = shortcode_atts($default_options, $atts);
    
    $random_id = "ec-gallery-" . rand();

    return ec_get_gallery_html($atts["gallery-id"], $random_id);
}
add_shortcode('ec_gallery', 'ec_gallery_shortcode' );



// EXTEND TINYMCE
add_action('admin_head', 'ec_add_tinymce_button');
function ec_add_tinymce_button() {
    global $typenow;

    // check user permissions
    if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
        return;
    }

    // verify the post type
    if( ! in_array( $typenow, array( 'post', 'page' ) ) )
        return;

    // check if WYSIWYG is enabled
    if (get_user_option('rich_editing') == 'true') {
        add_filter("mce_external_plugins", "ec_add_tinymce_plugin");
        add_filter('mce_buttons', 'ec_register_tc_button');
    }
}
function ec_add_tinymce_plugin($plugin_array) {
    $plugin_array['tinymce_ec_button'] = plugins_url( '/js/tinymce_ec_button.js', __FILE__ );
    return $plugin_array;
}
function ec_register_tc_button($buttons) {
    array_push($buttons, "|");
    array_push($buttons, "tinymce_ec_button");
    return $buttons;
}

// REST ENDPONT FOR TINYMCE
function get_ec_infos($number) {
    $galleries = get_galleries();

    $infos = ec_get_all_options();

    $infos['galleries'] = get_galleries();

    return $infos;
}
add_action( 'rest_api_init', function () {
  register_rest_route( 'ecgallery/v1', '/get_ec_infos', array(
    'methods' => 'GET',
    'callback' => 'get_ec_infos',
  ));
});