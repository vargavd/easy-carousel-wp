<?php 

    function get_table_name() {
        global $wpdb;

        return $wpdb->prefix . "ec_galleries";
    }

    function create_gallery_table() {
        global $wpdb;

        $gallery_table_name = get_table_name();

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

    function save_gallery($gallery_id, $gallery_name, $gallery_string) {
        global $wpdb;

        $gallery_table_name = get_table_name();

        if ($gallery_id === "" || $gallery_id == -1) {
            $wpdb->insert(
                $gallery_table_name,
                array(
                    "name" => $gallery_name,
                    "data" => $gallery_string
                )
            );
        } else {
            $wpdb->update(
                $gallery_table_name,
                array(
                    "name" => $gallery_name,
                    "data" => $gallery_string
                ),
                array (
                    "id" => $gallery_id
                )
            );
        }
    }

    function delete_gallery($gallery_id) {
        global $wpdb;

        $gallery_table_name = get_table_name();

        $wpdb->delete($gallery_table_name, array( 'id' => $gallery_id ) );
    }

    function get_galleries() {
        global $wpdb;

        $gallery_table_name = get_table_name();

        return $wpdb->get_results("SELECT id, name, data FROM $gallery_table_name");
    }

    function get_gallery($gallery_id) {
        global $wpdb;

        $gallery_table_name = get_table_name();

        return $wpdb->get_row("SELECT * FROM $gallery_table_name WHERE ID = $gallery_id");
    }

?>

