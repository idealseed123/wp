<?php 

class VE_PB_page_title{

	  /**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_page_title', array( $this, 'attr' ) );

		add_shortcode( 'page_title', array( $this, 'render' ) );





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

					

					'class' => '',
                    'id' => '',
					'title' => '',
					
					
					

					

				), $args 

			);
        //   echo '<pre>';
       //    print_r($args );
		 //  echo '</pre>';		
            
		   extract( $defaults );

			$class = $defaults['class'];

		    $id = $defaults['id'];
			$title = $defaults['title'];
			

			 

			$html='';
			
		   
		   if($id != '' && $class !=''){

			$html .='<div class="container '.$class.'" id="'.$id.'">';

			}elseif($id != ''){

			$html .='<div class="container" id="'.$id.'">';

			}

			elseif($class != ''){

			$html .='<div class="container '.$class.'">';

			}

			else{

			$html .='<div class="container">';

			}
			
		
   
        
			 $html.='<div class="row"><header class="c-page_title">';
			  $html.='<h1>'.$title.'</h1>';
			$html.='</header></div>';
			$html.='</div>';

			return $html;

	

	

		}

	

	}

new VE_PB_page_title()



?>