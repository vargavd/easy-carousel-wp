var initEcAdminGalleries = function (galleriesString) {
    "use strict";

    var
        $ = jQuery,

        // constants,
        GALLERIES_DELIMITER = "|||",
        GALLERY_DELIMITER = "||",
        IMAGES_DELIMITER = "|",

        // DOM
        $galleryTemplate = $(".gallery-template"),
        $imageTemplate = $(".gallery-image-template"),
        $addGalleryBtn = $(".add.gallery-button"),
        $actualGallery,

        // helper functions
        $getGallery = function (elem) {
            // DOM
            var $elem = $(elem);

            return $elem.closest(".gallery");
        },
        $getGalleries = function () {
            return $(".gallery:not(.gallery-template)");
        },

        // events
        expandCloseGallery = function () {
            var
                // DOM
                $button = $(this),
                $gallery = $button.closest(".gallery"),
                $galleryBody = $gallery.find(".gallery-body"),

                // helper functions
                expand = function () {
                    var
                        // DOM
                        $galleryImgWrappers = $gallery.find(".gallery-image-wrapper"),

                        // misc
                        galleryImagesHeight = 0;

                    $button
                        .removeClass("closed")
                        .addClass("expanded")
                        .attr("title", "Close");

                    // calculate the height of the gallery wrapper
                    $galleryImgWrappers.each(function () {
                        var
                            // DOM
                            $galleryImgWrapper = $(this),

                            // helper functions
                            getImgHeight = function () {
                                var
                                    // DOM
                                    $imgClone = $galleryImgWrapper.find("img").clone(),

                                    // misc
                                    imgHeight = 0;

                                $imgClone.css({
                                    display: "block",
                                    position: "absolute",
                                    visibility: "hidden"
                                });
                                $galleryImgWrapper.append($imgClone);

                                imgHeight = $imgClone.height();

                                $imgClone.remove();

                                return imgHeight;
                            },

                            // misc
                            imgHeight = getImgHeight(),
                            wrapperHeight = 31; // padding (20) + margin (10) + border (1)

                        if (imgHeight > 60) {
                            wrapperHeight = wrapperHeight + imgHeight;
                        } else {
                            wrapperHeight = wrapperHeight + 60;
                        }

                        galleryImagesHeight = galleryImagesHeight + wrapperHeight;
                    });


                    $galleryBody.css("height", 0).show().animate({
                        height: galleryImagesHeight - 10
                    }, 500, "swing");
                },
                close = function () {
                    $button
                        .removeClass("expanded")
                        .addClass("closed")
                        .attr("title", "Expand");

                    $galleryBody.animate({
                        height: 0
                    }, 500, "swing", function () {
                        $galleryBody.hide();
                    });
                };

            if ($button.hasClass("expanded")) {
                close();
            } else {
                expand();
            }
        },
        addGallery = function () {
            var
                // DOM
                $gallery = $galleryTemplate.clone(true).removeClass("gallery-template"),
                $galleries = $getGalleries();

            $gallery.find(".gallery-header input").attr("placeholder", "gallery-" + ($galleries.size() + 1));

            $gallery.insertAfter($galleryTemplate);
        },
        deleteGallery = function () {
            var
                // DOM
                $galleryToDelete = $getGallery(this),
                $galleries,

                // misc
                galleryCount,

                // funcs
                indexGallery = function (index, elem) {
                    var
                        // DOM
                        $gallery = $(elem),

                        // misc
                        placeholderString = "gallery-" + (galleryCount - index);

                    $gallery.find(".gallery-header input").attr("placeholder", placeholderString);
                };

            $galleryToDelete.remove();
            $galleries = $getGalleries();
            galleryCount = $galleries.size();

            $galleries.each(indexGallery);
        },
        captionChanged = function () {
            
        },
        addImageClicked = function () {
            var $button = $(this);

            $actualGallery = $getGallery($button);

            frame.open();
        },
        addImage = function () {
            var image = frame.state().get('selection').first().toJSON();

            $(".image-title").text(image.title);
            $(".image-url").text(image.url);
            $(".image-id").text(image.id);
        },
        deleteImage = function () {

        },

        init = function () {
            var galleries;

            // set gallery events
            $galleryTemplate.find("button.expand-close").click(expandCloseGallery);
            $galleryTemplate.find("button.delete").click(deleteGallery);
            $galleryTemplate.find("button.add").click(addImageClicked);
            $("button.add.gallery-button").click(addGallery);

            // set image events
            $imageTemplate.find("input").keyup(captionChanged);
            $imageTemplate.find("button").click(deleteImage);

            // frame event
            frame.on('select', addImage);

            if (galleriesString) {
                galleries = QU.String.SplitByDelimiters(galleriesString,
                        [GALLERIES_DELIMITER, GALLERY_DELIMITER, IMAGES_DELIMITER],
                        ["galleries", "gallery_infos", "images"]);

                console.log(galleries);
            }
        },

        // wp media modal window
        frame = wp.media({
            title: 'Select or Upload Media',
            multiple: false,
            button: {
                text: 'Select Image'
            },
            library: {
                type: 'image'
            }
        });

    init();
};