<?php

add_action('admin_init', 'ec_options_init');
function ec_options_init() {
    register_setting('ec-parameter-settings', 'ec_parameter_settings', 'reset_ec_settings');

    add_settings_section('ec_general_section', '', 'ec_general_section', 'easy-carousel-settings-general');

    add_settings_field('ec_visible_img_count', 'Visible Image Count', 'ec_visible_img_count', 'easy-carousel-settings-general', 'ec_general_section');
    add_settings_field('ec_seconds_between_slide', 'Seconds between Slides', 'ec_seconds_between_slide', 'easy-carousel-settings-general', 'ec_general_section');

    add_settings_section('ec_slider_styles_section', '', 'ec_slider_styles_section', 'easy-carousel-settings-slider');

    add_settings_field('ec_wrapper_border', 'Wrapper Border', 'ec_wrapper_border', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_wrapper_padding', 'Wrapper Padding', 'ec_wrapper_padding', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_wrapper_background', 'Wrapper Background', 'ec_wrapper_background', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_img_width', 'Image Width', 'ec_img_width', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_img_max_height', 'Image Max Height', 'ec_img_max_height', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_img_space', 'Space Between Images', 'ec_img_space', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_img_border', 'Image Border', 'ec_img_border', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_width', 'Button Width', 'ec_button_width', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_height', 'Button Height', 'ec_button_height', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_border', 'Button Border', 'ec_button_border', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_background', 'Button Background', 'ec_button_background', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_color', 'Button Color', 'ec_button_color', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_font_weight', 'Button Font Weight', 'ec_button_font_weight', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_hover_background', 'Button Hover Background', 'ec_button_hover_background', 'easy-carousel-settings-slider', 'ec_slider_styles_section');
    add_settings_field('ec_button_hover_border', 'Button Hover Border', 'ec_button_hover_border', 'easy-carousel-settings-slider', 'ec_slider_styles_section');

    add_settings_section('ec_modal_styles_section', '', 'ec_modal_styles_section', 'easy-carousel-settings-modal');

    add_settings_field('ec_modal_background', 'Modal Background', 'ec_modal_background', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_window_background', 'Modal Window Background', 'ec_modal_window_background', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_window_border', 'Modal Window Border', 'ec_modal_window_border', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_number_font_size', 'Modal Number Font Size', 'ec_modal_number_font_size', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_number_color', 'Modal Number Color', 'ec_modal_number_color', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_font_size', 'Modal Caption Font Size', 'ec_modal_caption_font_size', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_color', 'Modal Caption Color', 'ec_modal_caption_color', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_font_weight', 'Modal Caption Font Weight', 'ec_modal_caption_font_weight', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_caption_line_height', 'Modal Caption Line Height', 'ec_modal_caption_line_height', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_background', 'Modal Button Background', 'ec_modal_button_background', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_hover_background', 'Modal Button Hover Background', 'ec_modal_button_hover_background', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_color', 'Modal Button Color', 'ec_modal_button_color', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_hover_color', 'Modal Button Hover Color', 'ec_modal_button_hover_color', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_border', 'Modal Button Border', 'ec_modal_button_border', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_hover_border', 'Modal Button Hover Border', 'ec_modal_button_hover_border', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_padding', 'Modal Button Padding', 'ec_modal_button_padding', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_margin', 'Modal Button Margin', 'ec_modal_button_margin', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
    add_settings_field('ec_modal_button_font_weight', 'Modal Button Font Weight', 'ec_modal_button_font_weight', 'easy-carousel-settings-modal', 'ec_modal_styles_section');
}

// SECTION DESCRIPTIONS
function ec_slider_styles_section() {
    ?>
    <p><strong>Wrapper: </strong> This is the most outer wrapper of the slider.</p>
    <?php
}
function ec_modal_styles_section() {
    ?>
    <p>
    <div><strong>Modal: </strong> This is the background behind the modal window. Usually dark transparent.</div>
    <div><strong>Modal Window: </strong> This is the actual "window" that pops up.</div>
    <div><strong>Modal Number: </strong> The "current img number/number of images" wrapper.</div>
    <div><strong>Modal Caption: </strong> The alt text of the image shown here.</div>
    <div><strong>Modal Button: </strong> The three button (<< X >>) in the modal window. </div>
    </p>
    <?php
}
function ec_general_section() {
    echo '';
}

// GENERAL FIELDS (USED LATER)
function border_field($option_id, $default_border_string, $div_id) {
    $css_rules = get_option('ec_parameter_settings');

    
    $border_string = $css_rules[$option_id];


    if (!is_string($border_string) || empty($border_string)) {
        $border_string = $default_border_string;
    }
    
    $border_parts = explode(" ", $border_string);

    $border_width = str_replace("px", "", $border_parts[0]);
    $border_type  = $border_parts[1];
    $border_color = substr($border_string, strpos($border_string, "rgba"));
    
    ?>

    <div id='<?php print $div_id; ?>' class='border-field'>

        <input type="hidden" class="db-value" name='ec_parameter_settings[<?php print $option_id; ?>]' value='<?php echo $border_string; ?>' />

        <select class="width">
            <?php for ($i = 1; $i < 50; $i++) {
                if ($i == $border_width) {
                    print "<option selected='selected'>" . $i . "px</option>";
                } else {
                    print "<option>" . $i . "px</option>";
                }
            } ?>
        </select>
        <select class="type">
            <option <?php print ($border_type === "solid") ? "selected='selected'" : ""; ?>>solid</option>
            <option <?php print ($border_type === "none") ? "selected='selected'" : ""; ?>>none</option>
            <option <?php print ($border_type === "dashed") ? "selected='selected'" : ""; ?>>dashed</option>
            <option <?php print ($border_type === "dotted") ? "selected='selected'" : ""; ?>>dotted</option>
            <option <?php print ($border_type === "double") ? "selected='selected'" : ""; ?>>double</option>
        </select>
        
        <input type="text" class="color-text" value='<?php print $border_color; ?>'/>

        <p class="description">Default: 
            <strong class="default-string"><?php print $default_border_string; ?></strong>
        </p>

    </div>

    <?php
}
function margin_padding_field($option_id, $default_padding_string, $div_id) {
    $css_rules = get_option('ec_parameter_settings');

    $padding_string = $css_rules[$option_id];

    if (!is_string($padding_string) || empty($padding_string)) {
        $padding_string = $default_padding_string;
    }
    
    if (!strpos($padding_string, " ")) {
        $padding_parts = array($padding_string, $padding_string, $padding_string, $padding_string);
    } else {
        $padding_parts = explode(" ", $padding_string);

        if (sizeof($padding_parts) == 2) {
            $padding_parts[2] = $padding_parts[0];
            $padding_parts[3] = $padding_parts[1];
        }
    }
    
    ?>

    <div id='<?php print $div_id; ?>' class='padding-field'>

        <input type="hidden" class="db-value" name='ec_parameter_settings[<?php print $option_id; ?>]' value='<?php echo $padding_string; ?>' />

        <select>
            <?php for ($i = 0; $i < 50; $i++) {
                if ($i == $padding_parts[0]) {
                    print "<option selected='selected'>" . $i . "px</option>";
                } else {
                    print "<option>" . $i . "px</option>";
                }
            } ?>
        </select>

        <select>
            <?php for ($i = 0; $i < 50; $i++) {
                if ($i == $padding_parts[1]) {
                    print "<option selected='selected'>" . $i . "px</option>";
                } else {
                    print "<option>" . $i . "px</option>";
                }
            } ?>
        </select>

        <select>
            <?php for ($i = 0; $i < 50; $i++) {
                if ($i == $padding_parts[2]) {
                    print "<option selected='selected'>" . $i . "px</option>";
                } else {
                    print "<option>" . $i . "px</option>";
                }
            } ?>
        </select>

        <select>
            <?php for ($i = 0; $i < 50; $i++) {
                if ($i == $padding_parts[3]) {
                    print "<option selected='selected'>" . $i . "px</option>";
                } else {
                    print "<option>" . $i . "px</option>";
                }
            } ?>
        </select>

        <p class="description">Default: 
            <strong class="default-string"><?php print $default_padding_string; ?></strong>
        </p>

    </div>

    <?php
}
function color_field($option_id, $default_color_string, $div_id) {
    $cssRules = get_option('ec_parameter_settings');

    $color_string = $cssRules[$option_id];

    if (!is_string($color_string) || empty($color_string)) {
        $color_string = $default_color_string;
    }

    ?>

    <div id='<?php print $div_id; ?>' class='color-field'>

        <input type="hidden" class="db-value" name='ec_parameter_settings[<?php print $option_id; ?>]' value='<?php echo $color_string; ?>' />

        <p class="description">Default: 
            <strong class="default-string"><?php print $default_color_string; ?></strong>
        </p>

    </div>

    <?php
}
function select_field($option_id, $default_select_string, $div_id, $options, $comment = "") {
    $cssRules = get_option('ec_parameter_settings');

    $select_string = $cssRules[$option_id];

    if (!is_string($select_string) || empty($select_string)) {
        $select_string = $default_select_string;
    }
    ?>

    <div id='<?php print $div_id; ?>' class='select-field'>

        <select name='ec_parameter_settings[<?php print $option_id; ?>]'>
            <?php 
                foreach($options as $option) {
                    $selectedString = ($option[0] == $select_string) ? "selected='selected'" : "";                

                    print "<option $selectedString value='" . $option[0] . "'>" . $option[1] . "</option>";
                }
            ?>
        </select>

        <p class="description">Default: 
            <strong class="default-string"><?php print $default_select_string; ?></strong>
        </p>

    </div>

    <?php

    print $comment;
}

// BEHAVIORAL OPTIONS (HTML FIELDS)
function ec_visible_img_count() {
    $options = array();

    for ($i = 1; $i <= 20; $i++) {
        array_push($options, [$i, $i]);
    }

    select_field('ec_visible_img_count', ec_get_default_options()['visibleImgCount'], 'visible-img-count', $options);
}
function ec_seconds_between_slide() {
    $options = array();

    for ($i = 1; $i <= 20; $i++) {
        array_push($options, [$i, $i]);
    }

    select_field('ec_seconds_between_slide', ec_get_default_options()['secondsBetweenSlide'], 'seconds-between-slide', $options);
}


// SLIDER CSS OPTIONS (HTML FIELDS)
function ec_wrapper_border() {
    border_field('ec_wrapper_border', ec_get_default_options()['wrapperBorder'], 'wrapper-border');
}
function ec_wrapper_padding() {
    margin_padding_field('ec_wrapper_padding', ec_get_default_options()['wrapperPadding'], 'wrapper-padding');
}
function ec_wrapper_background() {
    color_field('ec_wrapper_background', ec_get_default_options()['wrapperBackground'], 'wrapper-background');
}
function ec_img_width() {
    $options = array();

    for ($i = 60; $i <= 500; $i += 10) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    $comment = "<p><strong>Note:</strong> this can be overwritten if the selected max height needs smaller width. So the Max Height option has greater priority.";

    select_field('ec_img_width', ec_get_default_options()['imgWidth'], 'img-width', $options, $comment);
}
function ec_img_max_height() {
    $options = array();

    for ($i = 60; $i <= 500; $i += 10) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    select_field('ec_img_max_height', ec_get_default_options()['imgMaxHeight'], 'img-max-height', $options);
}
function ec_img_space() {
    $options = array();

    for ($i = 5; $i <= 100; $i += 5) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    select_field('ec_img_space', ec_get_default_options()['imgSpace'], 'img-space', $options);
}
function ec_img_border() {
    border_field('ec_img_border', ec_get_default_options()['imgBorder'], 'img-border');
}
function ec_button_width() {
    $options = array();

    for ($i = 20; $i <= 200; $i += 5) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    select_field('ec_button_width', ec_get_default_options()['buttonWidth'], 'button-width', $options);
}
function ec_button_height() {
    $options = array();

    for ($i = 10; $i <= 150; $i += 5) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    select_field('ec_button_height', ec_get_default_options()['buttonHeight'], 'button-height', $options);
}
function ec_button_border() {
    border_field('ec_button_border', ec_get_default_options()['buttonBorder'], 'button-border');
}
function ec_button_background() {
    color_field('ec_button_background', ec_get_default_options()['buttonBackground'], 'button-background');
}
function ec_button_color() {
    color_field('ec_button_color', ec_get_default_options()['buttonColor'], 'button-color');
}
function ec_button_font_weight() {
    $options = array(
        [100, '100'],
        [200, '200'],
        [300, '300'],
        [400, '400 (normal)'],
        [500, '500'],
        [600, '600'],
        [700, '700 (bold)'],
        [800, '800'],
        [900, '900'],
    );

    select_field('ec_button_font_weight', ec_get_default_options()['buttonFontWeight'], 'button-font-weight', $options);
}
function ec_button_hover_background() {
    color_field('ec_button_hover_background', ec_get_default_options()['buttonHoverBackground'], 'button-hover-background');
}
function ec_button_hover_border() {
    border_field('ec_button_hover_border', ec_get_default_options()['buttonHoverBorder'], 'button-hover-border');
}

// MODAL CSS OPTIONS (HTML FIELDS)
function ec_modal_background() {
    color_field('ec_modal_background', ec_get_default_options()['modalBackground'], 'modal-background');
}
function ec_modal_window_background() {
    color_field('ec_modal_window_background', ec_get_default_options()['modalWindowBackground'], 'modal-window-background');
}
function ec_modal_window_border() {
    border_field('ec_modal_window_border', ec_get_default_options()['modalWindowBorder'], 'modal-window-border');
}
function ec_modal_number_font_size() {
    $options = array();

    for ($i = 8; $i <= 128; $i += 2) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    select_field('ec_modal_number_font_size', ec_get_default_options()['modalNumberFontSize'], 'modal-number-font-size', $options);
}
function ec_modal_number_color() {
    color_field('ec_modal_number_color', ec_get_default_options()['modalNumberColor'], 'modal-number-color');
}
function ec_modal_caption_font_size() {
    $options = array();

    for ($i = 8; $i <= 128; $i += 2) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    select_field('ec_modal_caption_font_size', ec_get_default_options()['modalCaptionFontSize'], 'modal-caption-font-size', $options);
}
function ec_modal_caption_color() {
    color_field('ec_modal_caption_color', ec_get_default_options()['modalCaptionColor'], 'modal-caption-color');
}
function ec_modal_caption_font_weight() {
    $options = array(
        [100, '100'],
        [200, '200'],
        [300, '300'],
        [400, '400 (normal)'],
        [500, '500'],
        [600, '600'],
        [700, '700 (bold)'],
        [800, '800'],
        [900, '900'],
    );

    select_field('ec_modal_caption_font_weight', ec_get_default_options()['modalCaptionFontWeight'], 'modal-caption-font-weight', $options);
}
function ec_modal_caption_line_height() {
    $options = array();

    for ($i = 8; $i <= 128; $i += 2) {
        $px_string = $i . "px";
        array_push($options, [$px_string, $px_string]);
    }

    select_field('ec_modal_caption_line_height', ec_get_default_options()['modalCaptionFontSize'], 'modal-caption-line-height', $options);
}
function ec_modal_button_background() {
    color_field('ec_modal_button_background', ec_get_default_options()['modalButtonBackground'], 'modal-button-background');
}
function ec_modal_button_hover_background() {
    color_field('ec_modal_button_hover_background', ec_get_default_options()['modalButtonHoverBackground'], 'modal-button-hover-background');
}
function ec_modal_button_color() {
    color_field('ec_modal_button_color', ec_get_default_options()['modalButtonColor'], 'modal-button-color');
}
function ec_modal_button_hover_color() {
    color_field('ec_modal_button_hover_color', ec_get_default_options()['modalButtonHoverColor'], 'modal-button-hover-color');
}
function ec_modal_button_border() {
    border_field('ec_modal_button_border', ec_get_default_options()['modalButtonBorder'], 'modal-button-border');
}
function ec_modal_button_hover_border() {
    border_field('ec_modal_button_hover_border', ec_get_default_options()['modalButtonHoverBorder'], 'modal-button-hover-border');
}
function ec_modal_button_padding() {
    margin_padding_field('ec_modal_button_padding', ec_get_default_options()['modalButtonPadding'], 'modal-button-padding');
}
function ec_modal_button_margin() {
    margin_padding_field('ec_modal_button_margin', ec_get_default_options()['modalButtonMargin'], 'modal-button-margin');
}
function ec_modal_button_font_weight() {
        $options = array(
            [100, '100'],
            [200, '200'],
            [300, '300'],
            [400, '400 (normal)'],
            [500, '500'],
            [600, '600'],
            [700, '700 (bold)'],
            [800, '800'],
            [900, '900'],
        );

    select_field('ec_modal_button_font_weight', ec_get_default_options()['modalButtonFontWeight'], 'modal-button-font-weight', $options);
}
function reset_ec_settings($input) {
    // if (in_array("ec_visible_img_count", $input)) {
    //     $input["ec_visible_img_count"] = "10";
    // }

    return $input;
}