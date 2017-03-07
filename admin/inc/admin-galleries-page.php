<?php
    $galleries = get_galleries();
?>

<script>
jQuery(document).ready(function ($) {
    var delimiters = {
        GALLERIES:  "<?php print constant("GALLERIES_DELIMITER"); ?>",
        GALLERY:    "<?php print constant("GALLERY_DELIMIETER"); ?>",
        IMAGES:     "<?php print constant("IMAGES_DELIMITER"); ?>",
        IMAGEINFOS: "<?php print constant("IMAGEINFOS_DELIMITER"); ?>",
        IDS:        "<?php print constant("IDS_DELIMITER"); ?>"
    };

    var galleries = [];

    <?php foreach ($galleries as $gallery): ?>
        galleries.push({
            id: "<?php print $gallery->id; ?>",
            name: "<?php print $gallery->name; ?>",
            data: "<?php print $gallery->data; ?>",
        });
    <?php endforeach; ?>

    initEcAdminGalleries(galleries, delimiters);
});
</script>

<div class="wrap gallery-admin">
    <h1>Galleries that can be shown in the widget</h1>

    <p class="description">Here, you can define galleries, which are collections of images. One of these galleries can be used in the widget you insert in the widgets menu.</p>

    <p class="description">You can reorder/sort the images by drag them with the arrow button.</p>

    <form method="POST">

        <input type="hidden" class="deleted-gallery-ids" name="deleted_gallery_ids">

        <div class="alert" id="same-name-alert">
            <span class="icon"> ! </span>
            Every gallery needs a unique name.
        </div>

        <div class="alert" id="empty-name-alert">
            <span class="icon"> ! </span>
            You must define name for every gallery.
        </div>

        <div class="alert" id="empty-gallery-alert">
            <span class="icon"> ! </span>
            You cannot save an empty gallery.
        </div>

        <button class="save gallery-button" id="save-galleries">
            Save Changes
        </button>
    
        <button type="button" class="add gallery-button"> 
            <span>+</span> Add Gallery 
        </button>
    
        <div class="gallery-image-wrapper gallery-image-template" data-id="">
            <img src="" />
            <div class="gallery-image-infos">
                <strong>Lightbox Caption:</strong> <input type="text" /> <br />
                <button type="button" class="sort"></button>
                <button type="button" class="delete">X</button>
                <input type="hidden" />
            </div>
        </div>
    
        <div class="gallery gallery-template" data-id="0">
            <div class="gallery-header">
                <button type="button" class="expand-close expanded" title="Close">
                    <span class="plus">+</span>
                    <span class="minus">-</span>
                </button>
                <button class="delete gallery-button" type="button"> X Delete Gallery </button>
                <button class="add image-button" type="button"> + Add Image </button>
                ID: <input type="text" class="gallery-name" placeholder="Gallery Name" /> 
            </div>
            <div class="gallery-body">
                <input type="hidden" class="gallery-string" data-name="gallery_strings[]" />
                <input type="hidden" class="gallery-id" name="gallery_id" value="-1" />
                
                <?php // for ($i = 0; $i < 10; $i++): ?>
                    <!--<div class="gallery-image-wrapper">
                        <img src="http://placehold.it/<?php print rand(100, 300); ?>x100" />
                        <div class="gallery-image-infos">
                            <strong>Lightbox Caption:</strong> <input /> <br />
                            <button class="delete">X</button> <br />
                        </div>
                    </div>-->
                <?php // endfor; ?>

            </div>
        </div>
    </form>

    
    
</div>
