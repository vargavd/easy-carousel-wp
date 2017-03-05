var initEcAdminGalleries = function (galleries, delimiters) {
    "use strict";

    var
        $ = jQuery,

        // DOM
        $galleryTemplate = $(".gallery-template"),
        $imageWrapperTemplate = $(".gallery-image-template"),
        $addGalleryBtn = $(".add.gallery-button"),
        $form = $("form"),
        $sameNameAlert = $("#same-name-alert"),
        $emptyNameAlert = $("#empty-name-alert"),
        $emptyGalleryAlert = $("#empty-gallery-alert"),
        $deletedGalleryIds = $("input.deleted-gallery-ids"),
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
                        galleryImagesHeight = 30;

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
                $galleries = $(".gallery:not(.gallery-template"),

                // misc
                numberOfNames = $galleryNames.length,
                sameName = false,
                emptyName = false,
                i,
                j;

            $emptyGalleryAlert.hide();
            $emptyNameAlert.hide();

            for (i = 0; i < numberOfNames; i += 1) {
                if ($galleries.eq(i).find(".gallery-image-wrapper:not(.gallery-image-template)").length === 0) {
                    $emptyGalleryAlert.show();
                    e.preventDefault();
                }

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
            }

            if (sameName) {
                $sameNameAlert.show();
                e.preventDefault();
            }
        },
        refreshGalleryInput = function (param) {
            var
                // DOM
                $elem = (param instanceof jQuery)
                    ? param
                    : $(this),
                $galleryWrapper = $elem.hasClass("gallery")
                    ? $elem
                    : $getGallery($elem),
                $galleryName = $galleryWrapper.find("input.gallery-name"),
                $galleryString = $galleryWrapper.find("input.gallery-string"),
                $galleryId = $galleryWrapper.find("input.gallery-id"),
                $imageWrappers = $galleryWrapper.find(".gallery-image-wrapper:not(.gallery-image-template)"),

                // misc
                value = QU.String.AddToString($galleryId.val(), $galleryName.val(), delimiters.GALLERY),
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

                    imageInfos = QU.String.AddToString(imageInfos, imgSrc, delimiters.IMAGEINFOS);
                    imageInfos = QU.String.AddToString(imageInfos, id, delimiters.IMAGEINFOS);
                    imageInfos = QU.String.AddToString(imageInfos, caption, delimiters.IMAGEINFOS);

                    return imageInfos;
                };

            $imageWrappers.each(function () {

                imagesString = QU.String.AddToString(imagesString, getImageString($(this)), delimiters.IMAGES);

            });

            value = QU.String.AddToString(value, imagesString, delimiters.GALLERY);

            $galleryString.val(value);
        },
        addGallery = function (galleryName, galleryId, imageString) {
            var
                // DOM
                $gallery = $galleryTemplate.clone(true).removeClass("gallery-template"),
                $hiddenInput = $gallery.find("input.gallery-string"),
                $galleryName = $gallery.find("input.gallery-name"),
                $galleryId = $gallery.find("input.gallery-id"),
                $galleryBody = $gallery.find(".gallery-body"),
                $imageWrapper,

                // misc
                imagesData,
                imageDelimiters = [
                    delimiters.IMAGES,
                    delimiters.IMAGEINFOS
                ],
                levelNames = ['images', 'imageParts'],
                i;

            $hiddenInput.attr("name", $hiddenInput.attr("data-name"));

            $gallery.insertAfter($galleryTemplate);

            if (galleryName === undefined || typeof galleryName === "object") {
                return;
            }

            if (galleryId === undefined) {
                throw "Gallery name is defined but gallery id is not.";
            }

            if (imageString === undefined) {
                throw "Gallery name and id is defined but imageString parameter not.";
            }

            $galleryName.val(galleryName);
            $galleryId.val(galleryId);

            imagesData = QU.String.SplitByDelimiters(imageString, imageDelimiters, levelNames);

            for (i = 0; i < imagesData.images.length; i += 1) {
                $imageWrapper = $imageWrapperTemplate.clone(true).removeClass("gallery-image-template");

                $imageWrapper.find("img").attr("src", imagesData.images[i].imageParts[0]);
                $imageWrapper.find("input[type=hidden]").val(imagesData.images[i].imageParts[1]);
                $imageWrapper.find("input[type=text]").val(imagesData.images[i].imageParts[2]);

                $galleryBody.append($imageWrapper);
            }

            refreshGalleryInput($gallery);
        },
        deleteGallery = function () {
            var
                // DOM
                $galleryToDelete = $getGallery(this),
                $galleryIdInput = $galleryToDelete.find("input.gallery-id"),

                // misc
                galleryId = $galleryIdInput.val(),
                deletedIdsString = $deletedGalleryIds.val();

            $galleryToDelete.remove();

            if (!galleryId) {
                return;
            }

            deletedIdsString = QU.String.AddToString(deletedIdsString, galleryId, delimiters.IDS);

            $deletedGalleryIds.val(deletedIdsString);
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
            var i;

            // set form submit event
            $form.submit(saveGalleriesSubmit);

            // set gallery events
            $galleryTemplate.find("button.expand-close").click(expandCloseGallery);
            $galleryTemplate.find("button.delete").click(deleteGallery);
            $galleryTemplate.find("button.add").click(addImageClicked);
            $galleryTemplate.find("input.gallery-name").keyup(refreshGalleryInput);
            $addGalleryBtn.click(addGallery);

            // set image events
            $imageWrapperTemplate.find("input").keydown(captionInputKeyDown).keyup(refreshGalleryInput);
            $imageWrapperTemplate.find("button").click(deleteImage);

            // frame event
            frame.on('select', addImage);

            for (i = 0; i < galleries.length; i += 1) {
                addGallery(galleries[i].name, galleries[i].id, galleries[i].data);
            }
        };

    init();
};