<?php

// CONSTANTS
define("GALLERIES_DELIMITER",  "||||");
define("GALLERY_DELIMIETER",   "|||");
define("IMAGES_DELIMITER",     "||");
define("IMAGEINFOS_DELIMITER", "|");
define("IDS_DELIMITER",        "@");

// GALLERY STUFFS
function ec_get_all_options() {
    $options = get_option('ec_parameter_settings');

    return array(
        'visibleImgCount' => $options["ec_visible_img_count"],
        'secondsBetweenSlide' => $options["ec_seconds_between_slide"],
        'wrapperBorder' => $options["ec_wrapper_border"],
        'wrapperPadding' => $options["ec_wrapper_padding"],
        'wrapperBackground' => $options["ec_wrapper_background"],
        'imgWidth' => $options["ec_img_width"],
        'imgMaxHeight' => $options["ec_img_max_height"],
        'imgSpace' => $options["ec_img_space"],
        'imgBorder' => $options["ec_img_border"],
        'buttonWidth' => $options["ec_button_width"],
        'buttonHeight' => $options["ec_button_height"],
        'buttonBorder' => $options["ec_button_border"],
        'buttonBackground' => $options["ec_button_background"],
        'buttonHoverBackground' => $options["ec_button_hover_background"],
        'buttonHoverBorder' => $options["ec_button_hover_border"],
        'buttonColor' => $options["ec_button_color"],
        'buttonFontWeight' => $options["ec_button_font-weight"],
        'modalBackground' => $options["ec_modal_background"],
        'modalWindowBackground' => $options["ec_modal_window_background"],
        'modalWindowBorder' => $options["ec_modal_window_border"],
        'modalNumberFontSize' => $options["ec_modal_number_font_size"],
        'modalNumberColor' => $options["ec_modal_number_color"],
        'modalCaptionFontSize' => $options["ec_modal_caption_font_size"],
        'modalCaptionColor' => $options["ec_modal_caption_color"],
        'modalCaptionFontWeight' => $options["ec_modal_caption_font_weight"],
        'modalCaptionLineHeight' => $options["ec_modal_caption_line_height"],
        'modalButtonBackground' => $options["ec_modal_button_background"],
        'modalButtonHoverBackground' => $options["ec_modal_button_hover_background"],
        'modalButtonColor' => $options["ec_modal_button_color"],
        'modalButtonHoverColor' => $options["ec_modal_button_hover_color"],
        'modalButtonBorder' => $options["ec_modal_button_border"],
        'modalButtonHoverBorder' => $options["ec_modal_button_hover_border"],
        'modalButtonPadding' => $options["ec_modal_button_padding"],
        'modalButtonMargin' => $options["ec_modal_button_margin"],
        'modalButtonFontWeight' => $options["ec_modal_button_font_weight"],
    );
}
function ec_get_default_options() {
    return array(
        'visibleImgCount'            => 3,
        'secondsBetweenSlide'        => 3,
        'wrapperBorder'              => "1px solid gray",
        'wrapperPadding'             => "10px",
        'wrapperBackground'          => "black",
        'imgWidth'                   => "300px",
        'imgMaxHeight'               => "150px",
        'imgSpace'                   => "10px",
        'imgBorder'                  => "5px solid white",
        'buttonWidth'                => "50px",
        'buttonHeight'               => "25px",
        'buttonBorder'               => "1px solid #bbb",
        'buttonBackground'           => "rgba(255, 255, 255, 0.6)",
        'buttonHoverBackground'      => "white",
        'buttonHoverBorder'          => "1px solid #bbb",
        'buttonColor'                => "black",
        'buttonFontWeight'           => "bold",
        'modalBackground'            => "rgba(0, 0, 0, 0.8)",
        'modalWindowBackground'      => "white",
        'modalWindowBorder'          => "1px solid white",
        'modalNumberFontSize'        => "24px",
        'modalNumberColor'           => "#333",
        'modalCaptionFontSize'       => "20px",
        'modalCaptionColor'          => "#666",
        'modalCaptionFontWeight'     => "bold",
        'modalCaptionLineHeight'     => "30px",
        'modalButtonBackground'      => "transparent",
        'modalButtonHoverBackground' => "#666",
        'modalButtonColor'           => "#333",
        'modalButtonHoverColor'      => "white",
        'modalButtonBorder'          => "1px solid #333",
        'modalButtonHoverBorder'     => "1px solid #333",
        'modalButtonPadding'         => "3px 7px",
        'modalButtonMargin'          => "0 10px",
        'modalButtonFontWeight'      => "bold",
    );
}
function ec_get_gallery_html($options, $gallery_id, $wrapper_id) {

    $output =  "<script>\n";
    $output .= "jQuery(document).ready(function ($) {\n";
    $output .= "    var settings = {};\n";

    foreach ($options as $rule_name => $rule_value) {
        if (is_string($rule_value) && $rule_value !== "") {
            $output .= "    settings.$rule_name = '$rule_value';\n";
        }
    }

    $output .= "$('#$wrapper_id').first().easyCarousel(settings).removeClass('initial');\n";
    $output .= "});\n";
    $output .= "</script>\n";

    wp_enqueue_script( "ec-gallery-component");

    $gallery = get_gallery($gallery_id);
    $images = explode(constant("IMAGES_DELIMITER"), $gallery->data);

    $output .= "<div class='ec-gallery-widget initial' id='$wrapper_id'>";
    foreach ($images as $image) {
        $image_infos = explode(constant("IMAGEINFOS_DELIMITER"), $image);
        $image_url = $image_infos[0];
        $image_caption = $image_infos[2];

        $output .= "    <img src='$image_url' alt='$image_caption' />\n";
    }
    $output .= "</div>\n";

    return $output;
    }

// DEBUG
function vd1($var) {
    echo "\n<pre style=\"background: #FFFF99; font-size: 14px;\">\n";
    var_dump($var);
    echo "\n</pre>\n";
}
function vd2($var1, $var2) {
    echo "\n<pre style=\"background: #FFFF99; font-size: 14px;\">\n";
    var_dump($var1);
    var_dump($var2);
    echo "\n</pre>\n";
}
function vd3($var1, $var2, $var3) {
    echo "\n<pre style=\"background: #FFFF99; font-size: 14px;\">\n";
    var_dump($var1);
    var_dump($var2);
    var_dump($var3);
    echo "\n</pre>\n";
}
function pr1($var) {
    echo "\n<pre style=\"background: #FFFF99; font-size: 14px;\">\n";
    print_r($var);
    echo "\n</pre>\n";
    
}
function pr2($var1, $var2) {
    echo "\n<pre style=\"background: #FFFF99; font-size: 14px;\">\n";
    print_r($var1);
    echo "\n";
    print_r($var2);
    echo "\n</pre>\n";
}
function pr3($var1, $var2, $var3) {
    echo "\n<pre style=\"background: #FFFF99; font-size: 14px;\">\n";
    print_r($var1);
    echo "\n";
    print_r($var2);
    echo "\n";
    print_r($var3);
    echo "\n</pre>\n";
}
