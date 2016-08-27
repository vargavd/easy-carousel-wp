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


function ec_options_init() {
    register_setting( 'ec-css-rules', 'ec_options', 'ec_sanitize_settings');
}
add_action('admin_init', 'ec_options_init');



function ec_sanitize_settings($data) {
    $data['wrapper-border'] = sanitize_text_field($data['wrapper-border']);
    
    return $data;
}



function ec_create_menu() {
    add_options_page('Easy Carousel Plugin', 'Easy Carousel', 'manage_options', 'easy-carousel-settings', 'ec_admin_menu_page');
}
add_action( 'admin_menu', "ec_create_menu");



function ec_admin_menu_page() {
    if ( !current_user_can( 'manage_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }
    
    ?>
    
    <div class="wrap">
      <h2>Easy Carousel settings</h2>
            
            <form method="post" action="options.php">          
                <?php settings_fields('ec-css-rules'); ?>
                <?php $ec_options = get_option('ec_options'); ?>
                
                <h3> CSS rules </h3>
                
                <table class='form-table'>
                    <tr>
                        <th scope='row'>
                            <label for='wrapper-border'>Wrapper Border</label>
                        </th>
                        <td>
                            <input type='text' 
                                   id='wrapper-border' 
                                   name='ec_options[wrapper-border]'
                                   value='<?php echo esc_attr($ec_options['wrapper-border']); ?>' />
                        </td>
                    </tr>
                </table>
                
                <?php submit_button(); ?>
                
            </form>
    </div>
    
    <?php
}