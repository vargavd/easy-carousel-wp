<?php 
    $gallery = get_gallery($instance["ec_gallery"]);

    $images = explode(constant("IMAGES_DELIMITER"), $gallery->data);
?>

<script>
'use strict';

jQuery(document).ready(function ($) {
    $('.ec-gallery-widget').first().easyCarousel({
        imgWidth:           '200px',
        visibleImgCount:     1,
        secondsBetweenSlide: 5
    });
});

</script>

<div class="ec-gallery-widget">
    <?php foreach ($images as $image): ?>
        <?php 
            $image_infos = explode(constant("IMAGEINFOS_DELIMITER"), $image);
            $image_url = $image_infos[0];
            $image_caption = $image_infos[2];

            echo "<img src='$image_url' alt='$image_caption' />";
        ?>
    <?php endforeach; ?>
</div>
