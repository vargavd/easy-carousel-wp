<?php 

    $gallery_table_suffix = "ec_galleries";

    function create_gallery_table() {
        global $wpdb;
        global $gallery_table_suffix;

        $gallery_table_name = $wpdb->prefix . $gallery_table_suffix;

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

    function save_gallery($gallery_name, $gallery_string) {
        global $wpdb;
        global $gallery_table_suffix;

        $gallery_table_name = $wpdb->prefix . $gallery_table_suffix;

        $wpdb->insert(
            $gallery_table_name,
            array(
                "name" => $gallery_name,
                "data" => $gallery_string
            )
        );
    }

?>

