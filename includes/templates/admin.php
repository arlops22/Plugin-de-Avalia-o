<?php 

if ( ! class_exists( 'WP_List_Table' ) ) {

	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

}

class Avaliacoes_List extends WP_List_Table {

    public function prepare_items() {

        $orderby = isset($_GET['orderby']) ? trim($_GET['orderby']) : '';
        $order = isset($_GET['order']) ? trim($_GET['order']) : '';

        $columns  = $this->get_columns();
		$hidden   = $this->get_hidden_column();
        $sortable = $this->get_sortable_columns();
        
        $data = $this->fetch_table_data($orderby, $order);
        
        $per_page = 10;
        $current_page = $this->get_pagenum();
        $total_items = count($data);

        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page' => $per_page
        ) );

        $this->_column_headers = array( $columns, $hidden, $sortable );
        $this->items = array_slice($data, (($current_page - 1) * $per_page), $per_page);

    }

    public function get_hidden_column() {
        return array('aval_id');
    }
    

    public function fetch_table_data($orderby = '', $order = '') {

        global $wpdb;

        if ($orderby == 'rate' && $order == 'asc') {

            $query = "SELECT wp_avaliacao_site.aval_id, wp_avaliacao_site.rate, wp_avaliacao_site.message, wp_users.display_name FROM wp_avaliacao_site INNER JOIN wp_users ON wp_avaliacao_site.user_id=wp_users.ID ORDER BY wp_avaliacao_site.rate ASC";

        } else if ($order == 'desc') {

            $query = "SELECT wp_avaliacao_site.aval_id, wp_avaliacao_site.rate, wp_avaliacao_site.message, wp_users.display_name FROM wp_avaliacao_site INNER JOIN wp_users ON wp_avaliacao_site.user_id=wp_users.ID ORDER BY wp_avaliacao_site.rate DESC";

        } else {

            $query = "SELECT wp_avaliacao_site.aval_id, wp_avaliacao_site.rate, wp_avaliacao_site.message, wp_users.display_name
            FROM wp_avaliacao_site
            INNER JOIN wp_users ON wp_avaliacao_site.user_id=wp_users.ID";

        }

        $query_results = $wpdb->get_results($query, ARRAY_A);

        return $query_results;

    }
    
    public function get_columns() {

        $table_columns = array(
            'aval_id'       => 'ID',
            'display_name'  => 'Nome do Usuário',
            'rate'          => 'Classificação',
            'message'       => 'Mensagem',
        );

        return $table_columns;

    }

    public function get_sortable_columns(){

        $sortable = array(
            'rate' => array( 'rate', true ),
        );

        return $sortable;
    }

    public function column_default( $item, $column_name ){

        $star1 = '<span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-empty"></span>
                <span class="dashicons dashicons-star-empty"></span>
                <span class="dashicons dashicons-star-empty"></span>
                <span class="dashicons dashicons-star-empty"></span>';

        $star2 = '<span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-empty"></span>
                <span class="dashicons dashicons-star-empty"></span>
                <span class="dashicons dashicons-star-empty"></span>';
        
        $star3 = '<span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-empty"></span>
                <span class="dashicons dashicons-star-empty"></span>';

        $star4 = '<span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-empty"></span>';
        
        $star5 = '<span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>
                <span class="dashicons dashicons-star-filled"></span>';

        if ($column_name == 'rate') {

            if ($item[$column_name] == 5) {
                return $star5;
            } else if ($item[$column_name] == 4) {
                return $star4;
            } else if ($item[$column_name] == 3) {
                return $star3;
            } else if ($item[$column_name] == 2) {
                return $star2;
            } else if ($item[$column_name] == 1) {
                return $star1;
            }

        } else if ($column_name == 'display_name') {

            return '<strong><p class="row-title">' . $item[$column_name] . '</p></strong>';
        
        } else if ($column_name == 'message') {
        
            return '<p>' . $item[$column_name] . '</p>';
        
        }else {

            return $item[$column_name];

        }
    }

}


$avaliacao_site_table = new Avaliacoes_List();


?>

<div class="wrap">    
    <h2>Avaliações do Site</h2>
    <div id="nds-wp-list-table-demo">			
        <div id="nds-post-body">		
            <form id="nds-user-list-form" method="get">					
            <?php
                $avaliacao_site_table->prepare_items();
                $avaliacao_site_table->display(); 
            ?>					
            </form>
        </div>			
    </div>
</div>
