<?php 

class VE_PB_get_advice{

	  /**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_get_advice', array( $this, 'attr' ) );

		add_shortcode( 'get_advice', array( $this, 'render' ) );





	}



		/**

		 * Render the shortcode

		 * @param  array $args	 Shortcode paramters

		 * @param  string $content Content between shortcode

		 * @return string		  HTML output

		 */

		function render( $args, $content = '') {

			global $ve_pb_data;

	            global $theme_option;

			$defaults = Vee_pb_Plugin::set_shortcode_defaults(

				array(

					
					'title' => '',
					'btn_link' => '',
					'btn_text' => '',
					
                  ), $args 

			);
       	
            
		   extract( $defaults );
        
			$title = $defaults['title'];
			$btn_link = $defaults['btn_link'];
             $btn_text = $defaults['btn_text'];


			$html='';
			
		   $html .='<div class="c-get_advice">';
	      
           $html .='<div class="container">'; 
           $html .='<div class="row">';
		   $html.='<h2>'.$title.'</h2>';
		   if(!empty($btn_link) && !empty($btn_text)){
		   $html .='<a href="'.$btn_link.'" class="c-green_but">'.$btn_text.'</a>';
		   }
           $html .='</div>';
          
		  $html.='</div>';
		   $html.='</div>';

			return $html;

	

	

		}

	

	}

new VE_PB_get_advice()



?>