'use strict';

window.initEcOptionsPage = function ($, options, wrapperId) {
    var
        // DOM
        $livePreviewPanel = $('#live-preview-panel'),
        $carouselWrapper  = $('#' + wrapperId),
        $testImg          = $carouselWrapper.find('img'),

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

            $tabs.last().click();
        },
        initColorPickerInput = function ($input, value, defaultValue, changeEvent) {
            $input.spectrum({
                color: (value !== '' ? value : defaultValue),
                showAlpha: true,
                showInput: true,
                showInitial: true,
                allowEmpty: false,
                preferredFormat: 'rgb',
                change: changeEvent,
            });
        },
        createNewCarousel = function () {
            var
                // misc
                i;

            // // remove the old carousel
            // $oldLivePreviewCar.remove();

            // // build the new carousel initialization html
            // $livePreviewCarousel.attr('id', carouselWrapperID);
            // for (i = 0; i < options.visibleImgCount + 3; i++) {
            //     $livePreviewCarousel.append(
            //         $('<img>')
            //             .attr('src', pluginDir + '../imgs/test_pic.jpg')
            //             .attr('alt', 'Image ' + i));
            // }
            // $livePreviewPanel.append($livePreviewCarousel);

            // start carousel
            $carouselWrapper.easyCarousel(options);
        };

    handlingTabs();

    // init color pickers
    initColorPickerInput($('#modal-background'), options.modalBackground, 'rgba(0, 0, 0, 0.8)', null);

    // start preview carousel
    createNewCarousel();
};
