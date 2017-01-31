<?php

include "inc/admin-option-settings.php";


add_action('admin_menu', "ec_create_menu");
function ec_create_menu() {
    add_menu_page('Easy Carousel', 'Easy Carousel', 'manage_options', 'easy-carousel-settings', 'ec_admin_menu_page', 'dashicons-admin-generic');
    
    // sub menu item
    add_submenu_page('easy-carousel-settings', 'Galleries', 'Galleries', 'manage_options', 'easy-carousel-galleries', 'ec_galleries_page');
}
function ec_admin_menu_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    include plugin_dir_path(__FILE__) . "inc/admin-settings-page.php";
}
function ec_galleries_page() {
    wp_enqueue_script('ec_admin_scripts');
    
    include plugin_dir_path(__FILE__) . "inc/admin-galleries-page.php";
}



add_action('admin_enqueue_scripts', 'ec_admin_scripts_and_styles');
function ec_admin_scripts_and_styles($hook) {
    if (strpos($hook, 'easy-carousel') === false) {
        return;
    }

    wp_enqueue_media();

    wp_register_script( 'ec_admin_scripts', plugin_dir_url( __FILE__ ) . 'js/ec-admin.js', false, '1.0');

    wp_enqueue_style('ec_admin_styles', plugin_dir_url(__FILE__) . 'css/ec-admin.css', array(), '1.0');
}

