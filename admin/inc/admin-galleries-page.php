<?php

?>

<script>
jQuery(document).ready(function ($) {
    initEcAdminGalleries();
});
</script>

<div class="wrap gallery-admin">
    <h1>Galleries that can be shown in the widget</h1>

    <p class="description">Here, you can define galleries, which are collections of images. When you insert a slideshow (with shortcode, php or widget), you must define the id of the shown gallery. </p>

    <button class="save gallery-button" id="save-galleries">
        Save Changes
    </button>

    <button class="add gallery-button"> 
        <span>+</span> Add Gallery 
    </button>

    <div class="gallery-image-wrapper gallery-image-template" data-id="">
        <img src="" />
        <div class="gallery-image-infos">
            <strong>Lightbox Caption:</strong> <input type="text" /> <br />
            <button class="delete">X</button> <br />
            <input type="hidden" />
        </div>
    </div>

    <div class="gallery gallery-template" data-id="0">
        <div class="gallery-header">
            <button class="expand-close expanded" title="Close">
                <span class="plus">+</span>
                <span class="minus">-</span>
            </button>
            <button class="delete gallery-button" type="button"> X Delete Gallery </button>
            <button class="add image-button"> + Add Image </button>
            ID: <input type="text" class="header-id" placeholder="gallery-1" /> 
        </div>
        <div class="gallery-body">
            <input type="hidden" name="gallery_infos[]" />
            <?php for ($i = 0; $i < 10; $i++): ?>
                <!--<div class="gallery-image-wrapper">
                    <img src="http://placehold.it/<?php print rand(100, 300); ?>x100" />
                    <div class="gallery-image-infos">
                        <strong>Lightbox Caption:</strong> <input /> <br />
                        <button class="delete">X</button> <br />
                    </div>
                </div>-->
            <?php endfor; ?>
        </div>
    </div>

    
    
</div>
