<?php

add_action('wp_enqueue_scripts', 'savio_aval_site_add_scripts');
add_action( 'admin_enqueue_scripts', 'savio_aval_site_add_admin_scripts' );


function savio_aval_site_add_scripts() {
    wp_enqueue_style( 
        'savio_aval_site_modal_style', 
        plugins_url() . '/savio_aval_site/assets/css/savio_aval_site_modal_style.css',
        null,
        true
    );

    wp_enqueue_script(
        'savio_aval_site_modal', 
        plugins_url() . '/savio_aval_site/assets/js/savio_aval_site_modal.js',
        null,
        true
    );

}

function savio_aval_site_add_admin_scripts() {
    wp_enqueue_style( 
        'savio_aval_site_admin_style', 
        plugins_url() . '/savio_aval_site/assets/css/savio_aval_site_admin_style.css',
        null,
        true
    );
}

?>