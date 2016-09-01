jQuery(document).ready(function ($) {
    
    function handleTabs() {
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

        $tabs.first().click();
    }
    
    function handleImages() {
        var $getImgButton = $(".select-image"),
            $imgTitle     = $(".image-title"),
            $imgUrl       = $(".image-url"),
            $imgId        = $(".image-id"),
            
            frame = wp.media({
                title: 'Select or Upload Media Of Your Chosen Persuasion',
                multiple: false,
                button: {
                    text: 'Use this image'
                },
                library: {
                    type: 'image'
                }
            });
    
        function getImageClicked() {
            frame.open();
        }
        
        function imageSelected() {
            var image = frame.state().get('selection').first().toJSON();
            
            $imgTitle.text(image.title);
            $imgUrl.text(image.url);
            $imgId.text(image.id);
        }
        
        frame.on('select', imageSelected);
        
        $getImgButton.click(getImageClicked);
    }
    
    handleTabs();
    handleImages();
});