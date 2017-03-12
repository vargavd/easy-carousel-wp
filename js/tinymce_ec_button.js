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
                getListboxNumberValues = function (param1, param2, firstElemText) {
                    var values = [{ text: firstElemText, value: -1 }];

                    for (; param1 <= param2; param1++) {
                        values.push({ value: param1, text: param1.toString() });
                    }

                    return values;
                },
                getDialogBody = function () {
                    return [
                        {
                            type:   'listbox',
                            name:   'ec_gallery_id',
                            label:  'Gallery',
                            values: galleryOptions,
                        },
                        {
                            type:   'listbox',
                            name:   'visibleImgCount',
                            label:  'Number of visible images',
                            values: getListboxNumberValues(1, 20, 'Choose a number'),
                        },
                        {
                            type:   'listbox',
                            name:   'secondsBetweenSlide',
                            label:  'Seconds between slides',
                            values: getListboxNumberValues(1, 10, 'Choose a number'),
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
                title: 'Carousel settings',
                body: getDialogBody(),
                onsubmit: function (e) {
                    var shortcodeString;

                    if (e.data.ec_gallery_id === -1) {
                        e.preventDefault();
                        editor.windowManager.alert('You have to select the gallery!');
                        return;
                    }

                    if (e.data.visibleImgCount === -1) {
                        e.preventDefault();
                        editor.windowManager.alert('You have to select how many image should be visible az once!!');
                        return;
                    }

                    if (e.data.secondsBetweenSlide === -1) {
                        e.preventDefault();
                        editor.windowManager.alert('You have to select how many seconds should be between slides!');
                        return;
                    }

                    shortcodeString =  '[ec_gallery';
                    shortcodeString += ' gallery-id="' + e.data.ec_gallery_id + '"';
                    shortcodeString += ' visibleImgCount="' + e.data.visibleImgCount + '"';
                    shortcodeString += ' secondsBetweenSlide="' + e.data.secondsBetweenSlide + '"';
                    shortcodeString += ']';

                    editor.insertContent(shortcodeString);
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
