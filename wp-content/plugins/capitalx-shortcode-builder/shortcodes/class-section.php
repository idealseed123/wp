<?php 

class VE_PB_Section{

	

	public static $args;



	/**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_section', array( $this, 'attr' ) );

		

		add_shortcode( 'section', array( $this, 'render' ) );



	}



	/**

	 * Render the shortcode

	 * @param  array $args	 Shortcode paramters

	 * @param  string $content Content between shortcode

	 * @return string		  HTML output

	 */

	function render( $args, $content = '') {

		global $ve_pb_data;



		$defaults = Vee_pb_Plugin::set_shortcode_defaults(

			array(

				

				'class' => '',

				'id' => '',

				'background_image' => '',

				

				

			), $args 

		);

	

      

		extract( $defaults );

		$sec_class = $defaults['class'];

		$sec_id = $defaults['id'];

		$background_image = $defaults['background_image'];

		

		self::$args = $defaults; 

		$html ='';

		if($sec_id != ''){

		$html .='<section  id="'.$sec_id.'">';

		}

		else{

		$html .='<section>';

		}

	   if(isset($background_image ) && !empty($background_image )) {

		$html .='<div  class="c-sec_bg '.$sec_class.'" style = "background-image:url('.$background_image.')">';

		}

		else{

			$html .='<div  class="c-sec_bg '.$sec_class.'">';	

		}

		

		$html .=do_shortcode($content);

		$html .='</div>';

		$html .='</section>';

		



		return $html;



	}



	}





new VE_PB_Section();







?>