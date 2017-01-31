jQuery(document).ready(function ($) {
    
    function handleGalleries() {
        var 
            // $elems
            $addGalleryButton = $("button.add.gallery"),
            $galleryTemplate  = $(".gallery-template"),
            $currGallery,
            
            // misc
            galleriesCount = 0,
            
            // wp media modal window
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
    
        function $getGallery(info) {
            var $gallery;
            
            // helper functions
            function getGallery() {
                
                // if info is the id
                if (typeof info === 'number') {
                    $gallery = $('.gallery[data-id="' + info + '"]');
                } else if (info instanceof jQuery) { // if info is a DOM element
                    
                    if (!info.hasClass('gallery')) {
                        
                        $gallery = $gallery.closest('.gallery'); // info must be a child of the .gallery
                        
                        if ($gallery.length === 0) {
                            // no .gallery found in parents tree
                            throw new Exception('No gallery found.');
                        }
                    }
                } else { // otherwise we make a new gallery
                    $gallery = $galleryTemplate.clone().removeClass('gallery-template');
                }
                
            }
            function getImages() {
                 return $gallery.find('.gallery-image-template:not(.gallery-image)');
            }
            
            // get $gallery based in info parameter
            getGallery();
            
            return {
                id: $gallery.attr('data-id'),
                gallery: $gallery,
                addImgButton: $gallery.find('button.add.image-button'),
                deleteImgButton: $gallery.find('button.delete.image-button'),
                deleteGalleryButton: $gallery.find('button.delete.gallery-button'),
                imgTemplate: $gallery.find('.gallery-image-template'),
                getImgs: getImages
                
            };
        }
        function $getImage(id) {
            var $imgWrapper = $('.gallery-image-wrapper[data-id="' + id + '"]');
            
            return {
                id: id,
                imgWrapper: $imgWrapper,
                img: $imgWrapper.find('img'),
                deleteButton: $imgWrapper.find('button.delete')
            };
        }
    
        function getImageClicked() {
            frame.open();
        }
        
        function imageSelected() {
            var image = frame.state().get('selection').first().toJSON();
            
            $imgTitle.text(image.title);
            $imgUrl.text(image.url);
            $imgId.text(image.id);
        }
        
        // set events on the gallery template
        $currGallery = $getGallery($galleryTemplate);
        
        
        frame.on('select', imageSelected);
        
        
   }
    
    handleGalleries();
});