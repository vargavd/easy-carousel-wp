<?php 
    $gallery = get_gallery($instance["ec_gallery"]);

    $images = explode(constant("IMAGES_DELIMITER"), $gallery->data);
?>

<script>
'use strict';

jQuery(document).ready(function ($) {
    var settings = {

    };

    <?php foreach ($this->settings as $rule_name => $rule_value): ?>
        <?php if (is_string($rule_value) && $rule_value !== ""): ?>
            settings.<?php print $rule_name; ?> = "<?php print $rule_value;?>";
        <?php endif; ?>
    <?php endforeach; ?>

    console.log(settings);

    $('#<?php echo $args["widget_id"]; ?>').first().easyCarousel(settings);
});

</script>

<div class="ec-gallery-widget" id="#<?php echo $args["widget_id"]; ?>">
    <?php foreach ($images as $image): ?>
        <?php 
            $image_infos = explode(constant("IMAGEINFOS_DELIMITER"), $image);
            $image_url = $image_infos[0];
            $image_caption = $image_infos[2];

            echo "<img src='$image_url' alt='$image_caption' />";
        ?>
    <?php endforeach; ?>
</div>
