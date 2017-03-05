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


// actions
function ec_register_widgets() {
    register_widget('EC_Gallery_Widget');
}
add_action('widgets_init', 'ec_register_widgets');


function ec_enqueue_script() {
	wp_register_script('ec-gallery-component', 'js/easy-carousel.js', false );
}
add_action( 'wp_enqueue_scripts', 'ec_enqueue_script' );