<?php
    wp_enqueue_script('color-picker');
    wp_enqueue_script('ec-style-scroll');
    wp_enqueue_script('ec_admin_options_scripts');
    wp_enqueue_script('ec-gallery-component');

    $options = ec_get_all_options();

    $test_img_src = plugin_dir_url(__FILE__) . "../imgs/test_pic.jpg";
    $loading_img_src = plugin_dir_url(__FILE__) . "../imgs/loading.gif";

    $carousel_wrapper_id = "live-preview-carousel";
?>

<script>
    jQuery(document).ready(function ($) {
        var options = {};
        var pluginDir = '<?php print plugin_dir_url(__FILE__); ?>';

        <?php 
        foreach ($options as $name => $value):
            if (is_string($value) && $value !== ""):
                print "options.$name = '$value';";
            endif;
        endforeach; 
        ?>

        window.initEcOptionsPage($, "<?php print $carousel_wrapper_id; ?>");
    });
</script>

<div id="live-preview-panel" class="notice notice-info">
    <h2>Live style preview </h2>

    <div id="<?php print $carousel_wrapper_id; ?>">
        <img src="<?php print $test_img_src; ?>" alt="Image">
    </div>
</div>

<div class="wrap gallery-admin" id="easy-carousel-settings">
    <div id="ec-settings-header-panel">
        <h1>Easy Carousel settings</h1>

        <h2 class="nav-tab-wrapper">
            <a href="#general-settings-tab" class="nav-tab nav-tab-active">General Settings</a>
            <a href="#slider-styles-tab" class="nav-tab">Slider Styles</a>
            <a href="#modal-styles-tab" class="nav-tab">Modal Styles</a>
        </h2>
    </div>

    <form method="post" action="options.php">

        <?php settings_fields('ec-parameter-settings'); ?>

        <div id="easy-carousel-settings-tab-content-scroll">

            <div id="ec-settings-buttons">
                <input type="button" class="button button-secondary" value="Reset settings to default" id="reset-button">
                
                <?php submit_button(null, 'primary', null, false, ''); ?>
            </div>

            <div id="general-settings-tab" class="tab-content">
                <div>
                    <?php do_settings_sections('easy-carousel-settings-general'); ?>
                </div>
            </div>

            <div id="slider-styles-tab" class="tab-content">
                <div class="scroll-viewport">
                    <div>
                        <?php do_settings_sections('easy-carousel-settings-slider'); ?>
                    </div>
                </div>
            </div>

            <div id="modal-styles-tab" class="tab-content">
                <div>
                    <?php do_settings_sections('easy-carousel-settings-modal'); ?>
                </div>
            </div>
        </div>

    </form>

    <div id="ec-settings-down-arrow">
        <span class="dashicons dashicons-arrow-down-alt2"></span>
    </div>

</div>

