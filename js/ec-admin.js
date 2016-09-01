console.log("faszom");

jQuery(document).ready(function ($) {
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
});