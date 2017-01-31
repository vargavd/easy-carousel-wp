<?php

?>

<script>
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
</script>

<div class="wrap gallery-admin">
    <h1>Easy Carousel settings</h1>

    <form method="post" action="options.php">

        <?php settings_fields('ec-parameter-settings'); ?>

        <h2 class="nav-tab-wrapper">
            <a href="#general-settings-tab" class="nav-tab nav-tab-active">General Settings</a>
            <a href="#slider-styles-tab" class="nav-tab">Slider Styles</a>
            <a href="#modal-styles-tab" class="nav-tab">Modal Styles</a>
        </h2>

        <div id="general-settings-tab" class="tab-content">
            <?php do_settings_sections('easy-carousel-settings-general'); ?>
        </div>

        <div id="slider-styles-tab" class="tab-content">
            <?php do_settings_sections('easy-carousel-settings-slider'); ?>
        </div>

        <div id="modal-styles-tab" class="tab-content">
            <?php do_settings_sections('easy-carousel-settings-modal'); ?>
        </div>

        <?php submit_button(null, 'primary', null, false, ''); ?>
        
    </form>
</div>

