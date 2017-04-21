'use strict';

window.initEcOptionsPage = function ($, options) {
    var
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
        };

    handlingTabs();

    $("#modal-background").spectrum({
        color: (options.modalBackground !== "" ? options.modalBackground : "rgba(0, 0, 0, 0.8)"),
        showAlpha: true,
        showInput: true,
        showInitial: true,
        allowEmpty: false,
        preferredFormat: "rgb",
    });
};