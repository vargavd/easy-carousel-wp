<?php

class EC_Gallery_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'ec_gallery_widget',
			'Easy Gallery Widget',
			array( 'description' => 'You can show your galllery in this widget', )
		);
	}

	public function widget( $args, $instance ) {
        wp_enqueue_script('ec-gallery-component');
        $options = ec_get_all_options();

        $options['visibleImgCount'] = $instance["ec_visible_img_count"];
        $options['secondsBetweenSlide'] = $instance["ec_seconds_between_slides"];

		echo $args['before_widget'];

        print ec_get_gallery_html($options, $instance["ec_gallery"], $args["id"]);

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
        <p>
		<label for="ec_visible_img_count">Number of visible images</label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ec_visible_img_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ec_visible_img_count' ) ); ?>">
            <?php for ($i = 1; $i < 20; $i++): ?>
                <?php
                    $selected_string = "";
                    if ($instance["ec_visible_img_count"] == $i) {
                        $selected_string = "selected=\"selected\"";
                    }
                ?>
                <option <?php print $selected_string; ?>>
                    <?php print $i; ?>
                </option>
            <?php endfor; ?>
        </select>
		</p>
        <p>
		<label for="ec_seconds_between_slides">Seconds between slides</label> 
		<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ec_seconds_between_slides' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ec_seconds_between_slides' ) ); ?>">
            <?php for ($i = 1; $i < 10; $i++): ?>
                <?php
                    $selected_string = "";
                    if ($instance["ec_seconds_between_slides"] == $i) {
                        $selected_string = "selected=\"selected\"";
                    }
                ?>
                <option <?php print $selected_string; ?> >
                    <?php print $i; ?>
                </option>
            <?php endfor; ?>
        </select>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ec_gallery'] = $new_instance["ec_gallery"];
        $instance['ec_visible_img_count'] = $new_instance["ec_visible_img_count"];
        $instance['ec_seconds_between_slides'] = $new_instance["ec_seconds_between_slides"];

		return $instance;
	}

}
