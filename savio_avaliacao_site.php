<?php 
/*
    Plugin Name: Avaliação Site
    Description: Plugin para avaliação do site
    Version: 1.0.0
    Author: Ary Lopes
*/

if(!defined('ABSPATH')) {
    die;
}


add_action('widgets_init', 'widgets_init');

register_activation_hook( __FILE__, 'savio_aval_site_create_db' );

register_deactivation_hook( __FILE__, 'savio_aval_site_drop_db' );

function widgets_init() {

    register_widget( 'savio\widgets\Avaliacao_Site' );

}

function savio_aval_site_create_db() {
    
    global $wpdb;

    $plugin_name_db_version = '1.0';

    $charset_collate = $wpdb->get_charset_collate();
    
	$table_name = $wpdb->prefix . 'avaliacao_site';

	$sql = "CREATE TABLE $table_name (
		aval_id mediumint(9) NOT NULL AUTO_INCREMENT,
        user_id BIGINT(20) UNSIGNED NOT NULL,
        rate tinyint(1) unsigned NOT NULL,
        message longtext NOT NULL,
        created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY aval_id (aval_id),
        FOREIGN KEY (user_id) REFERENCES wp_users(ID)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    
	dbDelta( $sql );
    
}

function savio_aval_site_drop_db() {

    global $wpdb;

    $table_name = $wpdb->prefix . "avaliacao_site"; 

    $sql = $wpdb->query("DROP TABLE IF EXISTS $table_name");

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

    dbDelta( $sql );
}



require_once plugin_dir_path(__FILE__) . '/includes/savio_aval_site_widget.php';
require_once plugin_dir_path(__FILE__) . '/includes/savio_aval_site_scripts.php';
require_once plugin_dir_path(__FILE__) . '/includes/savio_aval_site_admin.php';
require_once plugin_dir_path(__FILE__) . '/includes/savio_aval_site_insert_db.php';

?>