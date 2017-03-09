<?php

class EC_Gallery_Widget extends WP_Widget {

    private $settings;

	function __construct() {
		parent::__construct(
			'ec_gallery_widget',
			'Easy Gallery Widget',
			array( 'description' => 'You can show your galllery in this widget', )
		);

        $options = get_option('ec_parameter_settings');

        $this->settings = array(
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

	public function widget( $args, $instance ) {
        wp_enqueue_script('ec-gallery-component');

		echo $args['before_widget'];

        include(plugin_dir_path(__FILE__) . "../inc/ec_gallery_widget.php");

		echo $args['after_widget'];
	}

	public function form( $instance ) {
		$galleries = get_galleries();
		?>
		<p>
		<label for="ec_gallery">Choose a Gallery</label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ec_gallery' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ec_gallery' ) ); ?>">
            <?php foreach ($galleries as $gallery): ?>
                <?php
                    $selected_string = "";
                    if ($instance["ec_gallery"] == $gallery->id) {
                        $selected_string = "selected=\"selected\"";
                    }
                ?>
                <option value="<?php print $gallery->id;?>" <?php print $selected_string; ?>>
                    <?php print $gallery->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ec_gallery'] = $new_instance["ec_gallery"];

		return $instance;
	}

}

?>