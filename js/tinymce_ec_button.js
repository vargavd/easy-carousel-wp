'use strict';

tinymce.PluginManager.add('tinymce_ec_button', function (editor) {
    editor.addButton('tinymce_ec_button', {
        text: 'EC Gallery',
        title: 'Insert EC Gallery',
        icon: 'wp_more',
        onclick: function () {
            editor.windowManager.open({
                title: 'Insert h3 tag',
                body: [{
                    type: 'textbox',
                    name: 'title',
                    label: 'Your title',
                }],
                onsubmit: function (e) {
                    editor.insertContent('&lt;h3&gt;' + e.data.title + '&lt;/h3&gt;');
                },
            });
        },
    });
});
