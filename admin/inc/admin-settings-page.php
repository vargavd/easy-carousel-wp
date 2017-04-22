<?php
    wp_enqueue_script('color-picker');
    wp_enqueue_script('ec_admin_options_scripts');
    wp_enqueue_script('ec-gallery-component');

    $options = ec_get_all_options();

    $test_img_src = plugin_dir_url(__FILE__) . "../imgs/test_pic.jpg";

    $carousel_wrapper_id = "live-preview-carousel";
?>

<script>
    jQuery(document).ready(function ($) {
        var options = {};
        var pluginDir = '<?php print plugin_dir_url(__FILE__); ?>';

        <?php foreach ($options as $name => $value): ?>
            <?php print "options.$name = '$value';"; ?>
        <?php endforeach; ?>

        window.initEcOptionsPage($, options, "<?php print $carousel_wrapper_id; ?>");
    });
</script>

<div class="wrap gallery-admin">
    <h1>Easy Carousel settings</h1>

    <div id="live-preview-panel" class="notice notice-info">
        <h2>Live Preview (with example images)</h2>

        <div id="<?php print $carousel_wrapper_id; ?>">
            <img src="<?php print $test_img_src; ?>" alt="Image">
            <img src="<?php print $test_img_src; ?>" alt="Image">
            <img src="<?php print $test_img_src; ?>" alt="Image">
            <img src="<?php print $test_img_src; ?>" alt="Image">
            <img src="<?php print $test_img_src; ?>" alt="Image">
            <img src="<?php print $test_img_src; ?>" alt="Image">
        </div>
    </div>

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

