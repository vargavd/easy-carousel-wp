var initEcAdminGalleries = function (galleriesString) {
    "use strict";

    var
        $ = jQuery,

        // constants,
        GALLERIES_DELIMITER = "||||",
        GALLERY_DELIMITER = "|||",
        IMAGES_DELIMITER = "||",
        IMAGEINFOS_DELIMITER = "|",

        // DOM
        $galleryTemplate = $(".gallery-template"),
        $imageWrapperTemplate = $(".gallery-image-template"),
        $addGalleryBtn = $(".add.gallery-button"),
        $form = $("form"),
        $sameNameAlert = $("#same-name-alert"),
        $emptyNameAlert = $("#empty-name-alert"),
        $actualGallery,

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
        }),

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
        saveGalleriesSubmit = function (e) {
            var
                // DOM
                $galleryNames = $(".gallery:not(.gallery-template) input.gallery-name"),

                // misc
                numberOfNames = $galleryNames.length,
                sameName = false,
                emptyName = false,
                i,
                j;

            for (i = 0; i < numberOfNames; i += 1) {
                if (!$galleryNames[i].value) {
                    emptyName = true;
                }

                for (j = i + 1; j < numberOfNames; j += 1) {
                    if ($galleryNames[i].value === $galleryNames[j].value) {
                        sameName = true;
                        break;
                    }
                }
            }

            if (emptyName) {
                $emptyNameAlert.show();
                e.preventDefault();
            } else {
                $emptyNameAlert.hide();
            }

            if (sameName) {
                $sameNameAlert.show();
                e.preventDefault();
            } else {
                $sameNameAlert.hide();
            }
        },
        refreshGalleryInput = function ($elem) {
            var
                // DOM
                $galleryWrapper = $elem.hasClass("gallery")
                    ? $elem
                    : $getGallery($elem),
                $galleryName = $galleryWrapper.find("input.gallery-name"),
                $hiddenInput = $galleryWrapper.find("input.gallery-string"),
                $imageWrappers = $galleryWrapper.find(".gallery-image-wrapper:not(.gallery-image-template)"),

                // misc
                value = $galleryName.val() !== ""
                    ? $galleryName.val()
                    : $galleryName.attr("placeholder"),
                imagesString = "",

                // helper functions
                getImageString = function ($imageWrapper) {
                    var
                        // DOM
                        $img = $imageWrapper.find("img"),
                        $idInput = $imageWrapper.find("input[type=hidden]"),
                        $captionInput = $imageWrapper.find("input[type=text]"),

                        // misc
                        imgSrc = $img.attr("src"),
                        id = $idInput.val(),
                        caption = $captionInput.val(),

                        // return value
                        imageInfos;

                    imageInfos = QU.String.AddToString(imageInfos, imgSrc, IMAGEINFOS_DELIMITER);
                    imageInfos = QU.String.AddToString(imageInfos, id, IMAGEINFOS_DELIMITER);
                    imageInfos = QU.String.AddToString(imageInfos, caption, IMAGEINFOS_DELIMITER);

                    return imageInfos;
                };

            $imageWrappers.each(function () {

                imagesString = QU.String.AddToString(imagesString, getImageString($(this)), IMAGES_DELIMITER);

            });

            value = QU.String.AddToString(value, imagesString, GALLERY_DELIMITER);

            $hiddenInput.val(value);
        },
        addGallery = function () {
            var
                // DOM
                $gallery = $galleryTemplate.clone(true).removeClass("gallery-template"),
                $hiddenInput = $gallery.find("input.gallery-string");

            $hiddenInput.attr("name", $hiddenInput.attr("data-name"));

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
        captionInputKeyDown = function (event) {
            var
                // DOM
                $input = $(this),

                // misc
                value = $input.val();

            return value.length <= 200 && event.which !== 220;
        },
        addImageClicked = function () {
            var $button = $(this);

            $actualGallery = $getGallery($button);

            frame.open();
        },
        addImage = function () {
            var
                // DOM
                $imgWrapper = $imageWrapperTemplate.clone(true).removeClass("gallery-image-template"),
                image = frame.state().get('selection').first().toJSON();

            $imgWrapper.find("img").attr("src", image.url);
            $imgWrapper.find("input[type=text]").val(image.title);
            $imgWrapper.find("input[type=hidden]").val(image.id);

            $actualGallery.find(".gallery-body").prepend($imgWrapper);

            refreshGalleryInput($imgWrapper);
        },
        deleteImage = function () {
            var
                // DOM
                $button = $(this),
                $imageWrapper = $button.closest(".gallery-image-wrapper"),
                $galleryWrapper = $imageWrapper.closest(".gallery");

            $imageWrapper.remove();

            refreshGalleryInput($galleryWrapper);
        },

        // main functions
        init = function () {
            var galleries;

            // set form submit event
            $form.submit(saveGalleriesSubmit);

            // set gallery events
            $galleryTemplate.find("button.expand-close").click(expandCloseGallery);
            $galleryTemplate.find("button.delete").click(deleteGallery);
            $galleryTemplate.find("button.add").click(addImageClicked);
            $("button.add.gallery-button").click(addGallery);

            // set image events
            $imageWrapperTemplate.find("input").keydown(captionInputKeyDown).keyup(refreshGalleryInput);
            $imageWrapperTemplate.find("button").click(deleteImage);

            // frame event
            frame.on('select', addImage);

            if (galleriesString) {
                galleries = QU.String.SplitByDelimiters(galleriesString,
                        [GALLERIES_DELIMITER, GALLERY_DELIMITER, IMAGES_DELIMITER],
                        ["galleries", "gallery_infos", "images"]);

                console.log(galleries);
            }
        };

    init();

    // TEST
    $addGalleryBtn.click();
};