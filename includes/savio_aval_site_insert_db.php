<?php 

add_action( 'wp_ajax_savio_aval_site_insert_data', 'savio_aval_site_insert_data' );

function savio_aval_site_insert_data() {

    global $wpdb;

    $table_name = $wpdb->prefix . 'avaliacao_site';

    $user_id = get_current_user_id();
    $rate = $_POST['rate'];
    $message = $_POST['message'];

    $data = array(
        'user_id' => $user_id,
        'rate' => $rate,
        'message' => $message
    );
    

    $wpdb->insert($table_name, $data);

    $status = $wpdb->insert_id;

    echo $status ? json_encode($data) : var_dump($wpdb);

    wp_die();
}

?>