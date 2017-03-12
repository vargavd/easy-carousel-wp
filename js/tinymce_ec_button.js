'use strict';

tinymce.PluginManager.add('tinymce_ec_button', function (editor, url) {
    var
        // misc
        galleriesRestUrl = url.split('wp-content')[0] + 'wp-json/ecgallery/v1/get_ec_infos',

        // funcs
        galleriesDownloaded = function (infos) {
            var
                // misc
                galleryOptions = [{ value: -1, text: 'Choose a gallery' }],
                galleries      = infos.galleries,
                i,

                // helper functions
                getListboxNumberValues = function (param1, param2) {
                    var values = [];

                    for (; param1 <= param2; param1++) {
                        values.push({ value: param1, text: param1.toString() });
                    }

                    return values;
                },
                getDialogBody = function () {
                    return [
                        {
                            type:  'listbox',
                            name:  'ec_gallery_id',
                            label: 'Gallery',
                            values: galleryOptions,
                        },
                        {
                            type:   'listbox',
                            name:   'visibleImgCount',
                            label:  'Number of visible images',
                            values: getListboxNumberValues(1, 10),
                        },
                        {
                            type:  'listbox',
                            name:  'secondsBetweenSlide',
                            label: 'Seconds between slides',
                            values: getListboxNumberValues(1, 10),
                        },
                    ];
                };

            for (i = 0; i < galleries.length; i++) {
                galleryOptions.push({
                    value: galleries[i].id,
                    text:  galleries[i].name,
                });
            }

            editor.setProgressState(0);

            editor.windowManager.open({
                title: 'Choose a gallery',
                body: getDialogBody(),
                onsubmit: function (e) {
                    if (e.data.ec_gallery_id === -1) {
                        e.preventDefault();
                        return;
                    }

                    editor.insertContent('[ec_gallery gallery-id="' + e.data.ec_gallery_id + '"]');
                },
            });
        };

    editor.addButton('tinymce_ec_button', {
        text: 'EC Gallery',
        title: 'Insert EC Gallery',
        icon: 'wp_more',
        onclick: function () {
            editor.setProgressState(1);

            jQuery.get(galleriesRestUrl, null, galleriesDownloaded);
        },
    });
});
