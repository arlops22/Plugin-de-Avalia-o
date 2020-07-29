<?php 

namespace savio\widgets;

/**

 * @package savio\widgets

 */



class Avaliacao_Site extends \WP_Widget {
    
    public function __construct() {


        parent::__construct(  
        
            'savio_aval_site_widget', 
            'Avaliação de Site', 
            array(
            
                'description' => 'Mostra o botão para abrir o modal do formulário de avaliação do site'
                
            )
        
        );        

    }

    /**

	 * Creating widget front-end

	 *

	 * @param array $args

	 * @param array $instance

	 */

    public function widget($args, $instance) {

        $title = apply_filters( 'widget_title', $instance['title'] );


		// before and after widget arguments are defined by themes

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {

            echo $args['before_title'] . $title . $args['after_title'];
            
            ?>

                <button id="openModal" class="btn-secondary">Clique para deixar sua opinião</button>

                <div id="myModal" class="modal">

                <div class="modal-content">
                <span id="closeModal" class="close">&times;</span>

                <form data-url="<?php echo admin_url("admin-ajax.php"); ?>" id="rate-form" method="post" class="modal-form">
                    <div class="form-control">
                        <label>Classificação:</label>
                        <div class="stars-review">
                            <input id="star5" name="rate" type="radio" value="5"><label for="star5"></label>
                            <input id="star4" name="rate" type="radio" value="4"/><label for="star4"></label>
                            <input id="star3" name="rate" type="radio" value="3"/><label for="star3"></label>
                            <input id="star2" name="rate" type="radio" value="2"/><label for="star2"></label>
                            <input checked id="star1" name="rate" type="radio" value="1"/><label for="star1"></label>
                        </div>
                    </div>
                    
                    <div class="form-control">
                        <label for="message">Envie-nos seu feedback sobre o site</label>
                        <textarea id="message" class="form-input" name="message" rows="5"></textarea>
                    </div>

                    <button name="btn-submit" class="btn-secondary" type="submit">Enviar</button>

                    <p class="form-status" data-message="status"></p>

                    <input type="hidden" name="action" value="savio_aval_site_insert_data" >

                    
                </form>
                </div>
            </div>

            <?php

		}

		echo $args['after_widget'];
        
    }


    public function form($instance) {

        if ( isset( $instance[ 'title' ] ) ) {

			$title = $instance[ 'title' ];

		} else {

			$title = __( 'Avalie o Site');

		}
        
        $titleID = esc_attr($this->get_field_id('title'));

        ?> 

        <p>
            <label for="<?php echo $titleID ?>"></label>
            <input value="<?php echo esc_attr($title) ?>" 
                    class="widefat" 
                    type="text" 
                    name="<?php echo esc_attr($this->get_field_name('title')) ?>" 
                    id="<?php echo $titleID ?>">

        </p>

        <?php

    }

    /**

	 * Updating widget replacing old instances with new

	 *

	 * @param array $new_instance

	 * @param array $old_instance

	 *

	 * @return array

	 */

    public function update($new_instance, $old_instance) {

        error_log('Valor vindo do form' . print_r($new_instance, 1));

        $instance = array();

        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';

        return $instance;

    }

    

}

?>