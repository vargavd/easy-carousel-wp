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
    wp_enqueue_script('jquery-sortable');
    wp_enqueue_script('ec_admin_scripts');
    wp_enqueue_script('ec_qu_string');

    if (isset($_POST['gallery_strings']) && is_array($_POST["gallery_strings"])) {
        foreach ($_POST["gallery_strings"] as $gallery_string) {
            $gallery_info = explode("|||", $gallery_string);

            save_gallery($gallery_info[0], $gallery_info[1], $gallery_info[2]);
        }
    }

    if (isset($_POST['deleted_gallery_ids'])) {
        $deleted_gallery_ids = explode(constant("IDS_DELIMITER"), $_POST['deleted_gallery_ids']);
        
        foreach ($deleted_gallery_ids as $gallery_id) {
            delete_gallery($gallery_id);
        }
    }

    include plugin_dir_path(__FILE__) . "inc/admin-galleries-page.php";
}



add_action('admin_enqueue_scripts', 'ec_admin_scripts_and_styles');
function ec_admin_scripts_and_styles($hook) {
    if (strpos($hook, 'easy-carousel') === false) {
        return;
    }

    wp_enqueue_media();

    wp_register_script('ec_admin_scripts', plugin_dir_url( __FILE__ ) . 'js/ec-admin.js', false, '1.0');
    wp_register_script('ec_admin_options_scripts', plugin_dir_url( __FILE__ ) . 'js/ec-options-admin.js', false, '1.0');
    wp_register_script('ec_qu_string', plugin_dir_url( __FILE__ ) . '../js/qu-string.js', false, '1.0');
    wp_register_script('jquery-sortable', plugin_dir_url(__FILE__) . 'js/jquery-ui.min.js', false, "0.1");
    wp_register_script('color-picker', plugin_dir_url(__FILE__) . 'js/spectrum.js', false, "0.1");
    wp_register_script('ec-gallery-component', plugin_dir_url(__FILE__) . '../js/easy-carousel.js', false, "0.1" );

    wp_enqueue_style('ec_admin_styles', plugin_dir_url(__FILE__) . 'css/ec-admin.css', array(), '1.0');
    wp_enqueue_style('color-picker', plugin_dir_url(__FILE__) . 'css/spectrum.css', array(), '1.0');
}

