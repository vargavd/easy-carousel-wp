jQuery(document).ready(function ($) {
    "use strict";

    var 
        // DOM
        $expandCloseButtons = $("button.expand-close"),

        // events
        expandCloseGallery = function () {
            var 
                // DOM
                $button = $(this),
                $gallery = $button.closest(".gallery"),
                $galleryImages = $gallery.find(".gallery-images"),

                // helper functions
                expand = function () {
                    var
                        // DOM
                        $galleryImgWrappers = $gallery.find(".gallery-image-wrapper"),,
                        
                        // misc
                        galleryWrapperHeight = 0;

                    $button
                        .removeClass("closed")
                        .addClass("expanded")
                        .attr("title", "Close");

                    // calculate the height of the gallery wrapper
                    $galleryImgWrappers.each(function (index, elem) {
                        var
                            // DOM
                            $galleryImgWrapper = $(elem),
                            $img = $galleryImgWrapper.find("img"),

                            // misc
                            imgHeight = $img.height(),
                            wrapperHeight = 30; // padding (20) + margin (10)

                        if (imgHeight > 60) {
                            wrapperHeight = wrapperHeight + imgHeight;
                        } else {
                            wrapperHeight = wrapperHeight + 60;
                        }

                        galleryWrapperHeight = galleryWrapperHeight + wrapperHeight;
                    });

                    
                    $gallery.style("height", 0).show().animate({
                        height: galleryWrapperHeight
                    }, 500,  "swing");
                },
                close = function () {
                    $button
                        .removeClass("expanded")
                        .addClass("closed")
                        .attr("title", "Expand");

                    $gallery.animate({
                        height: 0
                    }, 500, function () { $gallery.hide(); })
                };

        };

    function handleGalleries() {
        var
            // $elems
            $addGalleryButton = $("button.add.gallery"),
            $galleryTemplate  = $(".gallery-template"),
            $getImage         = $(".select-image"),
            $imgTitle         = $(".image-title"),
            $imgUrl         = $(".image-url"),
            $imgId          = $(".image-id"),
            $currGallery,

            // misc
            galleriesCount = 0,

            // wp media modal window
            frame = wp.media({
                title: 'Select or Upload Media',
                multiple: false,
                button: {
                    text: 'Use this image'
                },
                library: {
                    type: 'image'
                }
            });

        function $getGallery(info) {
            var $gallery;

            // helper functions
            function getGallery() {

                // if info is the id
                if (typeof info === 'number') {
                    $gallery = $('.gallery[data-id="' + info + '"]');
                } else if (info instanceof jQuery) { // if info is a DOM element

                    if (!info.hasClass('gallery')) {

                        $gallery = $gallery.closest('.gallery'); // info must be a child of the .gallery

                        if ($gallery.length === 0) {
                            // no .gallery found in parents tree
                            throw new Exception('No gallery found.');
                        }
                    } else {
                        $gallery = info;
                    }
                } else { // otherwise we make a new gallery
                    $gallery = $galleryTemplate.clone().removeClass('gallery-template');
                }

            }
            function getImages() {
                 return $gallery.find('.gallery-image:not(.gallery-image-template)');
            }

            // get $gallery based in info parameter
            getGallery();

            return {
                id: $gallery.attr('data-id'),
                gallery: $gallery,
                addImgButton: $gallery.find('button.add.image-button'),
                deleteImgButton: $gallery.find('button.delete.image-button'),
                deleteGalleryButton: $gallery.find('button.delete.gallery-button'),
                imgTemplate: $gallery.find('.gallery-image-template'),
                getImgs: getImages

            };
        }
        function $getImage(id) {
            var $imgWrapper = $('.gallery-image-wrapper[data-id="' + id + '"]');

            return {
                id: id,
                imgWrapper: $imgWrapper,
                img: $imgWrapper.find('img'),
                deleteButton: $imgWrapper.find('button.delete')
            };
        }

        function getImageClicked() {
            frame.open();
        }

        function imageSelected() {
            var image = frame.state().get('selection').first().toJSON();

            $imgTitle.text(image.title);
            $imgUrl.text(image.url);
            $imgId.text(image.id);
        }

        // set events on the gallery template
        $currGallery = $getGallery($galleryTemplate);

        frame.on('select', imageSelected);

        $getImage.click(getImageClicked);
   }
    
    handleGalleries();
});