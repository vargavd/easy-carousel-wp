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

		echo $args['before_widget'];

        print ec_get_gallery_html($instance["ec_gallery"], $args["id"]);

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