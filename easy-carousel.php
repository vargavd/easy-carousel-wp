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
//    add_settings_section('ec_css_rules_section', 'Slider styling', 'ec_css_rules_section', 'easy-carousel-settings');
//    
//    add_settings_section('ec_css_rules_section', 'Slider styling', 'ec_css_rules_section', 'easy-carousel-settings');
    
    register_setting( 'ec-css-rules', 'ec_css_rules', 'validate_ec_options');

    add_settings_section('ec_behavioral_section', 'Behavioral parameters', 'ec_behavioral_section', 'easy-carousel-settings');
    
    add_settings_field('ec_visible_img_count',     'Visible Image Count',    'ec_visible_img_count',     'easy-carousel-settings', 'ec_behavioral_section');
    add_settings_field('ec_seconds_between_slide', 'Seconds between Slides', 'ec_seconds_between_slide', 'easy-carousel-settings', 'ec_behavioral_section');
    
    add_settings_section('ec_slider_styles_section', 'Slider styling', 'ec_slider_styles_section', 'easy-carousel-settings');
    
    add_settings_field('ec_wrapper_border',          'Wrapper Border',          'ec_wrapper_border',          'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_wrapper_padding',         'Wrapper Padding',         'ec_wrapper_padding',         'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_wrapper_background',      'Wrapper Background',      'ec_wrapper_background',      'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_img_width',               'Image Border',            'ec_img_width',               'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_img_border',              'Image Border',            'ec_img_border',              'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_button_width',            'Button Width',            'ec_button_width',            'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_button_height',           'Button Height',           'ec_button_height',           'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_button_border',           'Button Border',           'ec_button_border',           'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_button_background',       'Button Background',       'ec_button_background',       'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_button_hover_background', 'Button Hover Background', 'ec_button_hover_background', 'easy-carousel-settings', 'ec_slider_styles_section');
    add_settings_field('ec_button_hover_border',     'Button Hover Border',     'ec_button_hover_border',     'easy-carousel-settings', 'ec_slider_styles_section');
    
    add_settings_section('ec_modal_styles_section', 'Modal styling', 'ec_modal_styles_section', 'easy-carousel-settings');
    
    add_settings_field('ec_modal_background',               'Modal Background',          'ec_modal_background',              'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_window_background',        'Modal Window Background',   'ec_modal_window_background',       'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_window_border',            'Modal Window Border',       'ec_modal_window_border',           'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_number_font_size',         'Modal Number Font Size',    'ec_modal_number_font_size',        'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_number_color',             'Modal Number Color',        'ec_modal_number_color',            'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_font_size',        'Modal Caption Font Size',   'ec_modal_caption_font_size',       'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_color',            'Modal Caption Color',       'ec_modal_caption_color',           'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_font_weight',      'Modal Caption Font Weight', 'ec_modal_caption_font_weight',     'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_line_height',      'Modal Caption Line Height', 'ec_modal_caption_line_height',     'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_background',        'Button Background',         'ec_modal_button_background',       'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_hover_background',  'Button Hover Background',   'ec_modal_button_hover_background', 'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_color',             'Button Color',              'ec_modal_button_color',            'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_hover_color',       'Button Hover Color',        'ec_modal_button_hover_color',      'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_border',            'Button Border',             'ec_modal_button_border',           'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_hover_border',      'Button Hover Border',       'ec_modal_button_hover_border',     'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_padding',           'Button Padding',            'ec_modal_button_padding',          'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_margin',            'Button Margin',             'ec_modal_button_margin',           'easy-carousel-settings', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_font_weight',       'Button Font Weight',        'ec_modal_button_font_weight',      'easy-carousel-settings', 'ec_modal_styles_section');
}
add_action('admin_init', 'ec_options_init');



function ec_slider_styles_section() {
    ?>
        <div><strong>Wrapper: </strong> This is the most outer wrapper of the slider.</div>
    <?php
}

function ec_modal_styles_section() {
    ?>
        <div><strong>Modal: </strong> This is the background behind the modal window. Usually dark transparent.</div>
        <div><strong>Modal Window: </strong> This is the actual "window" that pops up.</div>
        <div><strong>Modal Number: </strong> The "current img number/number of images" wrapper.</div>
        <div><strong>Modal Caption: </strong> The alt text of the image shown here.</div>
        <div><strong>Modal Button: </strong> The three button (<< X >>) in the modal window. </div>
    <?php
}

function ec_behavioral_section() {
    echo '';
}

// *** BEHAVIORAL OPTIONS ***
function ec_visible_img_count() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='number' id='visible-img-count' name='ec_css_rules[ec_visible_img_count]' value='<?php echo (isset($cssRules['ec_visible_img_count']) ? $cssRules['ec_visible_img_count'] : ''); ?>' />
    <p class="description">Default: <strong>3</strong></p>

    <?php
}
function ec_seconds_between_slide() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='number' id='seconds-between-slide' name='ec_css_rules[ec_seconds_between_slide]' value='<?php echo (isset($cssRules['ec_seconds_between_slide']) ? $cssRules['ec_seconds_between_slide'] : ''); ?>' />
    <p class="description">Default: <strong>3</strong></p>

    <?php
}

// *** SLIDER CSS OPTIONS ***
function ec_wrapper_border() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='wrapper-border' name='ec_css_rules[ec_wrapper_border]' value='<?php echo (isset($cssRules['ec_wrapper_border']) ? $cssRules['ec_wrapper_border'] : ''); ?>' />
    <p class="description">Default: <strong>1px solid gray</strong></p>

    <?php
}
function ec_wrapper_padding() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='wrapper-padding' name='ec_css_rules[ec_wrapper_padding]' value='<?php echo (isset($cssRules['ec_wrapper_padding']) ? $cssRules['ec_wrapper_padding'] : ''); ?>' />
    <p class="description">Default: <strong>10px</strong></p>

    <?php
}
function ec_wrapper_background() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='wrapper-background' name='ec_css_rules[ec_wrapper_background]' value='<?php echo (isset($cssRules['ec_wrapper_background']) ? $cssRules['ec_wrapper_background'] : ''); ?>' />
    <p class="description">Default: <strong>black</strong></p>

    <?php
}
function ec_img_width() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='img-width' name='ec_css_rules[ec_img_width]' value='<?php echo (isset($cssRules['ec_img_width']) ? $cssRules['ec_img_width'] : ''); ?>' />
    <p class="description">Default: <strong>300px</strong></p>

    <?php
}
function ec_img_border() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='img-border' name='ec_css_rules[ec_img_border]' value='<?php echo (isset($cssRules['ec_img_border']) ? $cssRules['ec_img_border'] : ''); ?>' />
    <p class="description">Default: <strong>5px solid white</strong></p>

    <?php
}
function ec_button_width() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='button-width' name='ec_css_rules[ec_button_width]' value='<?php echo (isset($cssRules['ec_button_width']) ? $cssRules['ec_button_width'] : ''); ?>' />
    <p class="description">Default: <strong>50px</strong></p>

    <?php
}
function ec_button_height() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='button-height' name='ec_css_rules[ec_button_height]' value='<?php echo (isset($cssRules['ec_button_height']) ? $cssRules['ec_button_height'] : ''); ?>' />
    <p class="description">Default: <strong>25px</strong></p>

    <?php
}
function ec_button_border() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='button-border' name='ec_css_rules[ec_button_border]' value='<?php echo (isset($cssRules['ec_button_border']) ? $cssRules['ec_button_border'] : ''); ?>' />
    <p class="description">Default: <strong>1px solid #bbb</strong></p>

    <?php
}
function ec_button_background() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='button-background' name='ec_css_rules[ec_button_background]' value='<?php echo (isset($cssRules['ec_button_background']) ? $cssRules['ec_button_background'] : ''); ?>' />
    <p class="description">Default: <strong>rgba(255, 255, 255, 0.6)</strong></p>

    <?php
}
function ec_button_hover_background() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='button-hover-background' name='ec_css_rules[ec_button_hover_background]' value='<?php echo (isset($cssRules['ec_button_hover_background']) ? $cssRules['ec_button_hover_background'] : ''); ?>' />
    <p class="description">Default: <strong>white</strong></p>

    <?php
}
function ec_button_hover_border() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='button-hover-border' name='ec_css_rules[ec_button_hover_border]' value='<?php echo (isset($cssRules['ec_button_hover_border']) ? $cssRules['ec_button_hover_border'] : ''); ?>' />
    <p class="description">Default: <strong>1px solid #bbb</strong></p>

    <?php
}

// *** MODAL CSS OPTIONS ***
function ec_modal_background() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-background' name='ec_css_rules[ec_modal_background]' value='<?php echo (isset($cssRules['ec_modal_background']) ? $cssRules['ec_modal_background'] : ''); ?>' />
    <p class="description">Default: <strong>rgba(0, 0, 0, 0.8)</strong></p>

    <?php
}
function ec_modal_window_background() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-window-background' name='ec_css_rules[ec_modal_window_background]' value='<?php echo (isset($cssRules['ec_modal_window_background']) ? $cssRules['ec_modal_window_background'] : ''); ?>' />
    <p class="description">Default: <strong>white</strong></p>

    <?php
}
function ec_modal_window_border() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-background' name='ec_css_rules[ec_modal_window_background]' value='<?php echo (isset($cssRules['ec_modal_window_background']) ? $cssRules['ec_modal_window_background'] : ''); ?>' />
    <p class="description">Default: <strong>1px solid white</strong></p>

    <?php
}
function ec_modal_number_font_size() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-number-font-size' name='ec_css_rules[ec_modal_number_font_size]' value='<?php echo (isset($cssRules['ec_modal_number_font_size']) ? $cssRules['ec_modal_number_font_size'] : ''); ?>' />
    <p class="description">Default: <strong>24px</strong></p>

    <?php
}
function ec_modal_number_color() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='img-border' name='ec_css_rules[ec_modal_number_color]' value='<?php echo (isset($cssRules['ec_modal_number_color']) ? $cssRules['ec_modal_number_color'] : ''); ?>' />
    <p class="description">Default: <strong>#333</strong></p>

    <?php
}
function ec_modal_caption_font_size() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-width' name='ec_css_rules[ec_modal_caption_font_size]' value='<?php echo (isset($cssRules['ec_modal_caption_font_size']) ? $cssRules['ec_modal_caption_font_size'] : ''); ?>' />
    <p class="description">Default: <strong>20px</strong></p>

    <?php
}
function ec_modal_caption_color() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-caption-color' name='ec_css_rules[ec_modal_caption_color]' value='<?php echo (isset($cssRules['ec_modal_caption_color']) ? $cssRules['ec_modal_caption_color'] : ''); ?>' />
    <p class="description">Default: <strong>#666</strong></p>

    <?php
}
function ec_modal_caption_font_weight() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-border' name='ec_css_rules[ec_modal_caption_font_weight]' value='<?php echo (isset($cssRules['ec_modal_caption_font_weight']) ? $cssRules['ec_modal_caption_font_weight'] : ''); ?>' />
    <p class="description">Default: <strong>bold</strong></p>

    <?php
}
function ec_modal_caption_line_height() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-caption-line-height' name='ec_css_rules[ec_modal_caption_line_height]' value='<?php echo (isset($cssRules['ec_modal_caption_line_height']) ? $cssRules['ec_modal_caption_line_height'] : ''); ?>' />
    <p class="description">Default: <strong>rgba(255, 255, 255, 0.6)</strong></p>

    <?php
}
function ec_modal_button_background() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-background' name='ec_css_rules[ec_modal_button_background]' value='<?php echo (isset($cssRules['ec_modal_button_background']) ? $cssRules['ec_modal_button_background'] : ''); ?>' />
    <p class="description">Default: <strong>transparent</strong></p>

    <?php
}
function ec_modal_button_hover_background() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-hover-background' name='ec_css_rules[ec_modal_button_hover_background]' value='<?php echo (isset($cssRules['ec_modal_button_hover_background']) ? $cssRules['ec_modal_button_hover_background'] : ''); ?>' />
    <p class="description">Default: <strong>#666</strong></p>

    <?php
}
function ec_modal_button_color() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-color' name='ec_css_rules[ec_modal_button_color]' value='<?php echo (isset($cssRules['ec_modal_button_color']) ? $cssRules['ec_modal_button_color'] : ''); ?>' />
    <p class="description">Default: <strong>#333</strong></p>

    <?php
}
function ec_modal_button_hover_color() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-hover-color' name='ec_css_rules[ec_moda_button_hover_color]' value='<?php echo (isset($cssRules['ec_moda_button_hover_color']) ? $cssRules['ec_moda_button_hover_color'] : ''); ?>' />
    <p class="description">Default: <strong>white</strong></p>

    <?php
}
function ec_modal_button_border() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-border' name='ec_css_rules[ec_modal_button_border]' value='<?php echo (isset($cssRules['ec_modal_button_border']) ? $cssRules['ec_modal_button_border'] : ''); ?>' />
    <p class="description">Default: <strong>#1px solid #333</strong></p>

    <?php
}
function ec_modal_button_hover_border() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-hover-border' name='ec_css_rules[ec_modal_button_hover_border]' value='<?php echo (isset($cssRules['ec_modal_button_hover_border']) ? $cssRules['ec_modal_button_hover_border'] : ''); ?>' />
    <p class="description">Default: <strong>1px solid #333</strong></p>

    <?php
}
function ec_modal_button_padding() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-padding' name='ec_css_rules[ec_modal_button_padding]' value='<?php echo (isset($cssRules['ec_modal_button_padding']) ? $cssRules['ec_modal_button_padding'] : ''); ?>' />
    <p class="description">Default: <strong>3px 7px</strong></p>

    <?php
}
function ec_modal_button_margin() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-margin' name='ec_css_rules[ec_modal_button_margin]' value='<?php echo (isset($cssRules['ec_modal_button_margin']) ? $cssRules['ec_modal_button_margin'] : ''); ?>' />
    <p class="description">Default: <strong>0 10px</strong></p>

    <?php
}
function ec_modal_button_font_weight() {
    $cssRules = get_option('ec_css_rules');
    ?>

    <input type='text' id='modal-button-font-weight' name='ec_css_rules[ec_modal_button_font_weight]' value='<?php echo (isset($cssRules['ec_modal_button_font_weight']) ? $cssRules['ec_modal_button_font_weight'] : ''); ?>' />
    <p class="description">Default: <strong>bold</strong></p>

    <?php
}



function validate_ec_options($input) {
    return $input;
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
                
                <?php do_settings_sections( 'easy-carousel-settings' ); ?>
                
                <?php submit_button(); ?>
                
            </form>
    </div>
    
    <?php
}