'use strict';

window.initEcOptionsPage = function ($, wrapperId) {
    var
        // DOM
        $carouselWrapper     = $('#' + wrapperId),
        $testImg             = $carouselWrapper.find('img').remove(),
        options              = {},
        $visibleImgCount     = $('#visible-img-count'),
        $secondsBetweenSlide = $('#seconds-between-slides'),
        $modalBackground     = $('#modal-background'),

        // functions
        handlingTabs = function () {
            var $tabs = $('.nav-tab'),
                $tabContents = $('.tab-content');

            $tabs.click(function (event) {
                var $tab = $(this),
                    tabContentId = $tab.attr('href');

                $tabContents.hide();
                $(tabContentId).show();

                $tabs.removeClass('nav-tab-active');
                $tab.addClass('nav-tab-active');

                event.preventDefault();
            });

            $tabs.eq(0).click();
        },
        createNewCarousel = function () {
            var
                // misc
                i,
                imgCount = options.visibleImgCount ? (options.visibleImgCount + 3) : 6,

                // helper functions
                getOptions = function () {
                    var
                        // misc
                        modalBackground = $modalBackground.val();

                    options.visibleImgCount     = $visibleImgCount.val();
                    options.secondsBetweenSlide = $secondsBetweenSlide.val();

                    if (modalBackground) {
                        options.modalBackground = modalBackground;
                    }
                };

            // remove the old carousel
            $carouselWrapper.children().remove();

            // build the new carousel initialization html
            for (i = 0; i < imgCount; i++) {
                $carouselWrapper.append(
                    $testImg
                        .clone()
                        .attr('alt', 'Image ' + i));
            }

            // load options from html
            getOptions();

            // start carousel
            $carouselWrapper.easyCarousel(options);
        },
        initColorPickerInput = function ($input, value, defaultValue) {
            $input.spectrum({
                color: (value !== '' ? value : defaultValue),
                showAlpha: true,
                showInput: true,
                showInitial: true,
                allowEmpty: false,
                preferredFormat: 'rgb',
                change: createNewCarousel,
            });
        };

    handlingTabs();

    // init color pickers
    initColorPickerInput($('#modal-background'), options.modalBackground, 'rgba(0, 0, 0, 0.8)');

    // set change events
    $visibleImgCount.change(createNewCarousel);
    $secondsBetweenSlide.change(createNewCarousel);

    // start preview carousel
    createNewCarousel();
};
