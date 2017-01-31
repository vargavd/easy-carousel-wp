<?php
/*
  Plugin Name: Easy Carousel
  Description: You can insert image slideshows ('carousels') in any documents or region with widgets. Lightbox functionality is also included in the plugin.
  Version: 0.1
  Author: Varga Dániel
  License: GPLv2
 */

/*
 * v0.1 miről fog szólni
 *  - Egy widget lesz, amit ide oda be lehet szúrni. 
 *  - Lehet shortcode-dal és widget szerűen is berakni.
 *  - Shortcode-dal ügye lehet a paramétereket is állitani.
 *  - A paraméterek megegyeznek a jQuery plugin paramétereivel.
 * v0.2 (ez lehet kimarad)
 *  - Post contentbe ügye shortcode-dal lehet berakni: na itt kéne megcsinálni, hogy épűljön be wysiwyg editor-ba, az nagyon fasza lenne.
 */

// API
include plugin_dir_path(__FILE__) . "inc/helper.php";

// ADMIN
include plugin_dir_path(__FILE__) . "admin/admin.php";
