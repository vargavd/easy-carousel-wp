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
 * v0.2 (ez lehet kimarad)
 *  - Post contentbe ügye shortcode-dal lehet berakni: na itt kéne megcsinálni, hogy épűljön be wysiwyg editor-ba, az nagyon fasza lenne.
 */

// ADMIN INCLUDES
include plugin_dir_path(__FILE__) . "includes/admin-option-settings.php";


add_action('admin_menu', "ec_create_menu");
function ec_create_menu() {
    add_options_page('Easy Carousel Plugin', 'Easy Carousel', 'manage_options', 'easy-carousel-settings', 'ec_admin_menu_page');
}
function ec_admin_menu_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    ?>

    <div class="wrap gallery-admin">
        <h1>Easy Carousel settings</h1>

        <form method="post" action="options.php">

            <?php submit_button(null, 'primary', null, false, 'style="float: right;"'); ?>

            <p>
                <button class="select-image" type="button">Get Image</button>
            </p>

            <div>
                <strong>Image Title: </strong>
                <span class="image-title"></span>
            </div>
            <div>
                <strong>Image URL: </strong>
                <span class="image-url"></span>
            </div>
            <div>
                <strong>Image ID: </strong>
                <span class="image-id"></span>
            </div>

            <?php settings_fields('ec-parameter-settings'); ?>

            <h2 class="nav-tab-wrapper">
                <a href="#general-settings-tab" class="nav-tab nav-tab-active">General Settings</a>
                <a href="#slider-styles-tab" class="nav-tab">Slider Styles</a>
                <a href="#modal-styles-tab" class="nav-tab">Modal Styles</a>
            </h2>

            <div id="general-settings-tab" class="tab-content">
                <?php do_settings_sections('easy-carousel-settings-general'); ?>
            </div>

            <div id="slider-styles-tab" class="tab-content">
                <?php do_settings_sections('easy-carousel-settings-slider'); ?>
            </div>

            <div id="modal-styles-tab" class="tab-content">
                <?php do_settings_sections('easy-carousel-settings-modal'); ?>
            </div>

        </form>

        <h2>Galleries</h2>

        <p class="description">Here, you can define galleries, which are collections of images. When you insert a slideshow (with shortcode, php or widget), you must define the id of the shown gallery. </p>

        <button class="add gallery-button"> + Add Gallery </button>
        
        <div class="gallery-elem gallery-template" data-id="0">
            <div class="gallery-header">
                <button class="add image-button"> + Add Image </button>
                <button class="delete gallery-button" type="button"> X Delete Gallery </button>
                ID: <input type="text" class="header-id" placeholder="gallery-1" /> 
            </div>
            <div class="gallery-images">
                <div class="gallery-image-wrapper gallery-image-template" data-id="">
                    <img src="" />
                    <div class="img-button-wrapper">
                        <div class="img-button-wrapper">
                            <button class="delete">X</button>                  
                        </div>
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/10/bridgefoy.jpg" />
                    <div class="img-button-wrapper">
                        <div class="img-button-wrapper">
                            <button class="delete">X</button>                  
                        </div>
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/08/bakery-backdrop1.jpg" />
                    <div class="img-button-wrapper">
                        <div class="img-button-wrapper">
                            <button class="delete">X</button>                  
                        </div>
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/08/cheesecake.png" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/12/construction.jpg" />
                    <div class="img-button-wrapper">
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/08/corporatevent.jpg" />
                    <div class="img-button-wrapper">
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/09/slidea2.jpg" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/09/06.jpg" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/09/parallax.jpg" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/09/8.jpg" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/09/d.jpg" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/09/a1.jpg" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
                <div class="gallery-image-wrapper">
                    <img src="http://takacsb.dev/wp-content/uploads/2015/08/comingsoonback.jpg" />
                    <div class="img-button-wrapper">                      
                        <button class="delete">X</button>                  
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}

function ec_admin_scripts_and_styles($hook) {
    if (strpos($hook, 'easy-carousel-settings') === false) {
        return;
    }

    wp_enqueue_media();

    wp_enqueue_script('ec_admin_scripts', plugin_dir_url(__FILE__) . 'js/ec-admin.js', array(), '1.0');

    wp_enqueue_style('ec_admin_styles', plugin_dir_url(__FILE__) . 'css/ec-admin.css', array(), '1.0');
}

add_action('admin_enqueue_scripts', 'ec_admin_scripts_and_styles');
