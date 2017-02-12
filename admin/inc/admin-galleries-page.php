<?php

?>

<div class="wrap gallery-admin">
    <h1>Galleries which you can choose in the widget to be shown.</h1>
    
    <p>
        <button class="select-image" type="button">Get Image</button>
    </p>

    <div>
        <strong>Image Title: </strong>
        <span class="image-title"></span>
    </div>
    <div>
        <strong>Image URL: </strong>
        <span class="image-url"></span>
    </div>
    <div>
        <strong>Image ID: </strong>
        <span class="image-id"></span>
    </div>

    <p class="description">Here, you can define galleries, which are collections of images. When you insert a slideshow (with shortcode, php or widget), you must define the id of the shown gallery. </p>

    <button class="add gallery-button"> 
        <span>+</span> Add Gallery 
    </button>

    <div class="gallery gallery-template" data-id="0">
        <div class="gallery-header">
            <button class="add image-button"> + Add Image </button>
            <button class="delete gallery-button" type="button"> X Delete Gallery </button>
            ID: <input type="text" class="header-id" placeholder="gallery-1" /> 
        </div>
        <div class="gallery-images">
            <div class="gallery-image-wrapper gallery-image-template" data-id="">
                <img src="" />
                <div class="img-button-wrapper">
                    <div class="img-button-wrapper">
                        <button class="delete">X</button>                  
                    </div>
                </div>
            </div>

            <?php for ($i = 0; $i < 10; $i++): ?>
                <div class="gallery-image-wrapper">
                    <img src="http://placehold.it/<?php print rand(100, 300); ?>x100" />
                    <button class="delete">X</button>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    
</div>
