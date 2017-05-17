'use strict';

// TODO: translable strings!

window.initEcOptionsPage = function ($, wrapperId) {
    var
        // DOM
        $carouselWrapper     = $('#' + wrapperId),
        $testImg             = $carouselWrapper.find('img').remove(),
        $resetButton         = $('#reset-button'),
        $downArrow           = $('#ec-settings-down-arrow'),
        $adminMenuWrap       = $('#adminmenuwrap'),

        // misc
        options = {},
        resetIsInProgress = false,

        // events
        modalOpened = function () {
            $adminMenuWrap.hide();
        },
        modalClosed = function () {
            $adminMenuWrap.show();
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

        // functions
        enableSubmitButton = function () {
            $('input[type=submit]').removeAttr('disabled');
        },
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

                if (tabContentId.indexOf('general') !== -1) {
                    $downArrow.hide();
                } else {
                    $downArrow.show();
                }
            });

            $tabs.eq(0).click();
        },
        rearrangeLayout = function () {
            var
                // DOM
                $headerPanel = $('#ec-settings-header-panel'),
                $tabContents = $('#easy-carousel-settings-tab-content-scroll'),
                $carouselPanel = $('#live-preview-panel'),

                // misc
                carPanelHeight = $carouselPanel.height();

            $headerPanel.css('padding-top', carPanelHeight - 20);
            $tabContents.css('padding-top', carPanelHeight);
        },
        createNewCarousel = function () {
            var
                // misc
                i,
                imgCount,

                // helper functions
                getOptions = function () {
                    options.wrapperBorder              = wrapperBorderFieldObj.getValue();
                    options.imgBorder                  = imgBorderFieldObj.getValue();
                    options.buttonBorder               = buttonBorderFieldObj.getValue();
                    options.buttonHoverBorder          = buttonHoverBorderFieldObj.getValue();
                    options.modalWindowBorder          = modalWindowBorderFieldObj.getValue();
                    options.modalButtonBorder          = modalButtonBorderFieldObj.getValue();
                    options.modalButtonHoverBorder     = modalButtonHoverBorderFieldObj.getValue();
                    options.wrapperPadding             = wrapperPaddingFieldObj.getValue();
                    options.modalButtonPadding         = modalButtonPaddingFieldObj.getValue();
                    options.wrapperBackground          = wrapperBackgroundFieldObj.getValue();
                    options.buttonBackground           = buttonBackgroundFieldObj.getValue();
                    options.buttonColor                = buttonColorFieldObj.getValue();
                    options.buttonHoverBackground      = buttonHoverBackgroundFieldObj.getValue();
                    options.modalBackground            = modalBackgroundFieldObj.getValue();
                    options.modalWindowBackground      = modalWindowBackgroundFieldObj.getValue();
                    options.modalNumberColor           = modalNumberColorFieldObj.getValue();
                    options.modalCaptionColor          = modalCaptionColorFieldObj.getValue();
                    options.modalButtonBackground      = modalButtonBackgroundFieldObj.getValue();
                    options.modalButtonHoverBackground = modalButtonHBackgroundFieldObj.getValue();
                    options.modalButtonColor           = modalButtonColorFieldObj.getValue();
                    options.modalButtonHoverColor      = modalButtonHColorFieldObj.getValue();
                    options.modalButtonMargin          = modalButtonMarginFieldObj.getValue();
                    options.buttonFontWeight           = buttonFontWeightFieldObj.getValue();
                    options.imgWidth                   = imgWidthFieldObj.getValue();
                    options.imgMaxHeight               = imgMaxHeightFieldObj.getValue();
                    options.imgSpace                   = imgSpaceFieldObj.getValue();
                    options.buttonWidth                = buttonWidthFieldObj.getValue();
                    options.buttonHeight               = buttonHeightFieldObj.getValue();
                    options.modalNumberFontSize        = modalNumberFontSizeFieldObj.getValue();
                    options.modalCaptionFontSize       = modalCaptionFontSizeFieldObj.getValue();
                    options.modalCaptionFontWeight     = modalCaptionFontWeightFieldObj.getValue();
                    options.modalCaptionLineHeight     = modalCaptionLineHeightFieldObj.getValue();
                    options.modalButtonFontWeight      = modalButtonFontWeightFieldObj.getValue();
                    options.visibleImgCount            = visibleImgCountFieldObj.getValue();
                    options.secondsBetweenSlide        = secondsBetweenSlideFieldObj.getValue();

                    // setting up events
                    options.carouselLoaded = rearrangeLayout;
                    options.modalOpened = modalOpened;
                    options.modalClosed = modalClosed;
                };

            if (resetIsInProgress) {
                return;
            }

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
            if (confirm('You will lost every cumstomization you made. Are you sure?')) {
                wrapperBorderFieldObj.reset();
                imgBorderFieldObj.reset();
                buttonBorderFieldObj.reset();
                buttonHoverBorderFieldObj.reset();
                modalWindowBorderFieldObj.reset();
                modalButtonBorderFieldObj.reset();
                modalButtonHoverBorderFieldObj.reset();
                wrapperPaddingFieldObj.reset();
                modalButtonPaddingFieldObj.reset();
                wrapperBackgroundFieldObj.reset();
                buttonBackgroundFieldObj.reset();
                buttonColorFieldObj.reset();
                buttonHoverBackgroundFieldObj.reset();
                modalBackgroundFieldObj.reset();
                modalWindowBackgroundFieldObj.reset();
                modalNumberColorFieldObj.reset();
                modalCaptionColorFieldObj.reset();
                modalButtonBackgroundFieldObj.reset();
                modalButtonHBackgroundFieldObj.reset();
                modalButtonColorFieldObj.reset();
                modalButtonHColorFieldObj.reset();
                modalButtonMarginFieldObj.reset();
                buttonFontWeightFieldObj.reset();
                imgWidthFieldObj.reset();
                imgMaxHeightFieldObj.reset();
                imgSpaceFieldObj.reset();
                buttonWidthFieldObj.reset();
                buttonHeightFieldObj.reset();
                modalNumberFontSizeFieldObj.reset();
                modalCaptionFontSizeFieldObj.reset();
                modalCaptionFontWeightFieldObj.reset();
                modalCaptionLineHeightFieldObj.reset();
                modalButtonFontWeightFieldObj.reset();
                visibleImgCountFieldObj.reset();
                secondsBetweenSlideFieldObj.reset();

                createNewCarousel();
                enableSubmitButton();
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

                // functions
                getBorderString = function () {
                    var
                        colorObject = $colorInput.spectrum('get').toRgb(),
                        colorString = 'rgba(' + colorObject.r + ', ' + colorObject.g + ', ' + colorObject.b + ', ' + parseFloat(colorObject.a) + ')';

                    return $widthSelect.val() + ' ' + $typeSelect.val() + ' ' + colorString;
                },
                changed = function () {
                    $hiddenInput.val(getBorderString());

                    createNewCarousel();

                    enableSubmitButton();
                },
                reset = function () {
                    var
                        // DOM
                        $defaultString = $wrapper.find('.default-string'),

                        // misc
                        defaultString = $defaultString.text(),
                        defaultValues = defaultString.split(' ');

                    $widthSelect.val(defaultValues[0]);
                    $typeSelect.val(defaultValues[1]);
                    $colorInput.spectrum('set', defaultValues[2]);

                    $hiddenInput.val(getBorderString());
                };

            $widthSelect.change(changed);
            $typeSelect.change(changed);

            initColorPickerInput($colorInput, changed);

            return {
                getValue: getBorderString,
                reset: reset,
            };
        },
        marginPaddingField = function (fieldWrapperId) {
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

                    enableSubmitButton();

                    createNewCarousel();
                },
                reset = function () {
                    var
                        // DOM
                        $defaultString = $fieldWrapper.find('.default-string'),

                        // misc
                        i,
                        defaultString = $defaultString.text(),
                        defaultValues = defaultString.split(' ');

                    if (defaultValues.length === 1) {
                        defaultValues[1] = defaultValues[0];
                    }

                    if (defaultValues.length < 4) {
                        defaultValues[2] = defaultValues[0];
                        defaultValues[3] = defaultValues[1];
                    }

                    for (i = 0; i < 4; i++) {
                        $selects.eq(i).val(defaultValues[i]);
                    }

                    $hiddenInput.val(getPaddingString());
                };

            $selects.change(changed);

            return {
                getValue: getPaddingString,
                reset: reset,
            };
        },
        colorField = function (fieldWrapperId) {
            var
                // DOM
                $fieldWrapper = $('#' + fieldWrapperId),
                $input        = $fieldWrapper.find('input'),

                // events
                getColorString = function () {
                    var
                        colorObject = $input.spectrum('get').toRgb(),
                        colorString = 'rgba(' + colorObject.r + ', ' + colorObject.g + ', ' + colorObject.b + ', ' + parseFloat(colorObject.a) + ')';

                    return colorString;
                },
                changed = function () {
                    $input.val(getColorString());

                    enableSubmitButton();

                    createNewCarousel();
                },
                reset = function () {
                    var
                        // DOM
                        $defaultString = $fieldWrapper.find('.default-string'),

                        // misc
                        defaultString = $defaultString.text();

                    $input.spectrum('set', defaultString);

                    $input.val(getColorString());
                };

            initColorPickerInput($input, changed);

            return {
                getValue: getColorString,
                reset: reset,
            };
        },
        selectField = function (fieldWrapperId) {
            var
                // DOM
                $fieldWrapper = $('#' + fieldWrapperId),
                $select       = $fieldWrapper.find('select'),

                // events
                getSelectVal = function () {
                    return $select.val();
                },
                changed = function () {
                    enableSubmitButton();

                    createNewCarousel();
                },
                reset = function () {
                    var
                        // DOM
                        $defaultString = $fieldWrapper.find('.default-string'),

                        // misc
                        defaultString = $defaultString.text();

                    $select.val(defaultString);
                };

            $select.change(changed);

            return {
                getValue: getSelectVal,
                reset: reset,
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
        wrapperPaddingFieldObj         = marginPaddingField('wrapper-padding'),
        modalButtonPaddingFieldObj     = marginPaddingField('modal-button-padding'),
        wrapperBackgroundFieldObj      = colorField('wrapper-background'),
        buttonBackgroundFieldObj       = colorField('button-background'),
        buttonColorFieldObj            = colorField('button-color'),
        buttonHoverBackgroundFieldObj  = colorField('button-hover-background'),
        modalBackgroundFieldObj        = colorField('modal-background'),
        modalWindowBackgroundFieldObj  = colorField('modal-window-background'),
        modalNumberColorFieldObj       = colorField('modal-number-color'),
        modalCaptionColorFieldObj      = colorField('modal-caption-color'),
        modalButtonBackgroundFieldObj  = colorField('modal-button-background'),
        modalButtonHBackgroundFieldObj = colorField('modal-button-hover-background'),
        modalButtonColorFieldObj       = colorField('modal-button-color'),
        modalButtonHColorFieldObj      = colorField('modal-button-hover-color'),
        modalButtonMarginFieldObj      = marginPaddingField('modal-button-margin'),
        buttonFontWeightFieldObj       = selectField('button-font-weight'),
        imgWidthFieldObj               = selectField('img-width'),
        imgMaxHeightFieldObj           = selectField('img-max-height'),
        imgSpaceFieldObj               = selectField('img-space'),
        buttonWidthFieldObj            = selectField('button-width'),
        buttonHeightFieldObj           = selectField('button-height'),
        modalNumberFontSizeFieldObj    = selectField('modal-number-font-size'),
        modalCaptionFontSizeFieldObj   = selectField('modal-caption-font-size'),
        modalCaptionFontWeightFieldObj = selectField('modal-caption-font-weight'),
        modalCaptionLineHeightFieldObj = selectField('modal-caption-line-height'),
        modalButtonFontWeightFieldObj  = selectField('modal-button-font-weight'),
        visibleImgCountFieldObj        = selectField('visible-img-count'),
        secondsBetweenSlideFieldObj    = selectField('seconds-between-slide');

    handlingTabs();

    // set reset event
    $resetButton.click(resetEverything);

    // handle scroll arrow
    $downArrow.click(clickDownArrow);
    $(window).scroll(scrollEvent);

    // start preview carousel
    createNewCarousel();
};
