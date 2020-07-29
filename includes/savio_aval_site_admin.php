<?php 

add_action('admin_menu', 'add_admin_pages');

function add_admin_pages() {
    add_menu_page(
        'SAVIO avaliacao de site',
        'Avalição de Site',
        'manage_options',
        'savio_aval_site',
        'admin_index',
        'dashicons-star-filled',
        50
    );

    /*
    add_submenu_page(
        'savio_aval_site',
        'SAVIO avaliações',
        'Avaliações',
        'manage_options',
        'savio_aval_site_avaliacoes',
        'admin_index'
    );*/
}

function admin_index() {

    ob_start();

    require_once plugin_dir_path(__FILE__) . 'templates\admin.php';

    $template = ob_get_contents();

    ob_clean();

    echo $template;
}

?>