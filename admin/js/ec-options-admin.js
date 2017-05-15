'use strict';

window.initEcOptionsPage = function ($, wrapperId) {
    var
        // DOM
        $carouselWrapper     = $('#' + wrapperId),
        $testImg             = $carouselWrapper.find('img').remove(),
        $resetButton         = $('#reset-button'),
        $visibleImgCount     = $('#visible-img-count'),
        $secondsBetweenSlide = $('#seconds-between-slides'),

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
                    options.visibleImgCount     = $visibleImgCount.val();
                    options.secondsBetweenSlide = $secondsBetweenSlide.val();

                    options.wrapperBorder = wrapperBorderFieldObj.getValue();
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
            // TODO: translable strings!
            if (confirm('You will lost every cumstomization you made. Are you sure?')) {
                location.href += '&reset=true';
            }
        },
        initColorPickerInput = function ($input, changed) {
            $input.spectrum({
                showAlpha: true,
                showInput: true,
                showInitial: true,
                allowEmpty: false,
                preferredFormat: 'rgb',
                change: changed,
            });
        },

        // field constructors
        borderField = function (fieldWrapperId) {
            var
                // DOM
                $wrapper     = $('#' + fieldWrapperId),
                $hiddenInput = $wrapper.find('input.db-value'),
                $widthSelect = $wrapper.find('select.width'),
                $typeSelect  = $wrapper.find('select.type'),
                $colorInput  = $wrapper.find('input[type=text]'),

                // misc,
                initialColor = $colorInput.val(),

                // functions
                getBorderString = function () {
                    var
                        colorObject = $colorInput.spectrum('get').toRgb(),
                        colorString = 'rgba(' + colorObject.r + ', ' + colorObject.g + ', ' + colorObject.b + ', ' + parseFloat(colorObject.a) + ')';

                    return $widthSelect.val() + ' ' + $typeSelect.val() + ' ' + colorString;
                },
                changed = function () {
                    var
                        borderString = getBorderString();

                    $hiddenInput.val(borderString);

                    console.log(borderString);

                    createNewCarousel();
                };

            $widthSelect.change(changed);
            $typeSelect.change(changed);

            initColorPickerInput($colorInput, changed);

            return {
                getValue: getBorderString,
            };
        },

        // field objects
        wrapperBorderFieldObj = borderField('wrapper-border', 'wrapperBorder');

    handlingTabs();


    // set reset event
    $resetButton.click(resetEverything);

    // set change events
    $visibleImgCount.change(createNewCarousel);
    $secondsBetweenSlide.change(createNewCarousel);

    // start preview carousel
    createNewCarousel();
};
