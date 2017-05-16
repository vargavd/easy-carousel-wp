'use strict';

window.initEcOptionsPage = function ($, wrapperId) {
    var
        // DOM
        $carouselWrapper     = $('#' + wrapperId),
        $testImg             = $carouselWrapper.find('img').remove(),
        $resetButton         = $('#reset-button'),
        $visibleImgCount     = $('#visible-img-count'),
        $secondsBetweenSlide = $('#seconds-between-slides'),
        $downArrow           = $('#ec-settings-down-arrow'),

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
        rearrangeLayout = function () {
            var
                // DOM
                $ecCarSettingsWrapper = $('#easy-carousel-settings'),
                $carouselPanel = $('#live-preview-panel'),

                // misc
                carPanelHeight = $carouselPanel.height();

            $ecCarSettingsWrapper.css('margin-top', carPanelHeight);
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

                    options.wrapperBorder          = wrapperBorderFieldObj.getValue();
                    options.imgBorder              = imgBorderFieldObj.getValue();
                    options.buttonBorder           = buttonBorderFieldObj.getValue();
                    options.buttonHoverBorder      = buttonHoverBorderFieldObj.getValue();
                    options.modalWindowBorder      = modalWindowBorderFieldObj.getValue();
                    options.modalButtonBorder      = modalButtonBorderFieldObj.getValue();
                    options.modalButtonHoverBorder = modalButtonHoverBorderFieldObj.getValue();
                    options.wrapperPadding         = wrapperPaddingFieldObj.getValue();
                    options.modalButtonPadding     = modalButtonPaddingFieldObj.getValue();

                    options.carouselLoaded = rearrangeLayout;
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
        clickDownArrow = function () {
            var
                currentTop = $('body').scrollTop();

            $('html, body').animate({ scrollTop: currentTop + 100 }, 300);
        },
        scrollEvent = function () {
            if ($(window).scrollTop() + $(window).height() === $(document).height()) {
                $downArrow.hide();
            } else {
                $downArrow.show();
            }
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

                    createNewCarousel();
                };

            $widthSelect.change(changed);
            $typeSelect.change(changed);

            initColorPickerInput($colorInput, changed);

            return {
                getValue: getBorderString,
            };
        },
        paddingField = function (fieldWrapperId) {
            var
                // DOM
                $fieldWrapper = $('#' + fieldWrapperId),
                $hiddenInput  = $fieldWrapper.find('input[type=hidden]'),
                $selects      = $fieldWrapper.find('select'),

                // events
                getPaddingString = function () {
                    return $selects.first().val() + ' ' +
                            $selects.eq(1).val() + ' ' +
                            $selects.eq(2).val() + ' ' +
                            $selects.last().val();
                },
                changed = function () {
                    $hiddenInput.val(getPaddingString());

                    createNewCarousel();
                };

            $selects.change(changed);

            return {
                getValue: getPaddingString,
            };
        },

        // field objects
        wrapperBorderFieldObj          = borderField('wrapper-border'),
        imgBorderFieldObj              = borderField('img-border'),
        buttonBorderFieldObj           = borderField('button-border'),
        buttonHoverBorderFieldObj      = borderField('button-hover-border'),
        modalWindowBorderFieldObj      = borderField('modal-window-border'),
        modalButtonBorderFieldObj      = borderField('modal-button-border'),
        modalButtonHoverBorderFieldObj = borderField('modal-button-hover-border'),
        wrapperPaddingFieldObj         = paddingField('wrapper-padding'),
        modalButtonPaddingFieldObj     = paddingField('modal-button-padding');

    handlingTabs();

    // set reset event
    $resetButton.click(resetEverything);

    // set change events
    $visibleImgCount.change(createNewCarousel);
    $secondsBetweenSlide.change(createNewCarousel);

    // handle scroll arrow
    $downArrow.click(clickDownArrow);
    $(window).scroll(scrollEvent);

    // start preview carousel
    createNewCarousel();
};
