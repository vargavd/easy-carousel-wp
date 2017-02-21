<?php 

function ec_install() {
    global $wpdb;

    $gallery_table_name = $wpdb->prefix . "ec_galleries";

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $gallery_table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                name tinytext NOT NULL,
                data text NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
}

?>