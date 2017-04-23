'use strict';

window.initEcOptionsPage = function ($, wrapperId) {
    var
        // DOM
        $carouselWrapper     = $('#' + wrapperId),
        $testImg             = $carouselWrapper.find('img').remove(),
        $resetButton         = $('#reset-button'),
        $visibleImgCount     = $('#visible-img-count'),
        $secondsBetweenSlide = $('#seconds-between-slides'),
        $modalBackground     = $('#modal-background'),
        $wrapperBorder       = $('#wrapper-border'),

        // misc
        options = {},

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

            $tabs.eq(1).click();
        },
        createNewCarousel = function () {
            var
                // misc
                i,
                imgCount,

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

            // load options from html
            getOptions();

            // build the new carousel initialization html
            imgCount = options.visibleImgCount ? (parseInt(options.visibleImgCount) + 3) : 6;
            for (i = 0; i < imgCount; i++) {
                $carouselWrapper.append(
                    $testImg
                        .clone()
                        .attr('alt', 'Image ' + i));
            }

            // start carousel
            $carouselWrapper.easyCarousel(options);
        },
        resetEverything = function () {
            $visibleImgCount.val(3);
            $secondsBetweenSlide.val(3);
            $modalBackground.spectrum('set', 'rgba(0, 0, 0, 0.8)');

            createNewCarousel();
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
        },
        handleBorder = function ($hiddenInput) {
            var
                // dom
                $cell        = $hiddenInput.closest('td'),
                $widthSelect = $cell.find('.width'),
                $typeSelect  = $cell.find('.type'),
                $colorText   = $cell.find('.color-text');
        };

    handlingTabs();

    // init color pickers
    initColorPickerInput($modalBackground, options.modalBackground, 'rgba(0, 0, 0, 0.8)');

    // set reset event
    $resetButton.click(resetEverything);

    // set change events
    $visibleImgCount.change(createNewCarousel);
    $secondsBetweenSlide.change(createNewCarousel);

    // start preview carousel
    createNewCarousel();
};
