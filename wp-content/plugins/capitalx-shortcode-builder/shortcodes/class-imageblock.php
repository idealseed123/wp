<?php 
class VE_PB_Imageblock{
	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 've_pb_attr_imageblock', array( $this, 'attr' ) );
		
		add_shortcode( 'imageblock', array( $this, 'render' ) );

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
					'image' => '',
			
				), $args 
			);
		
			extract( $defaults );
			
		    $class = $defaults['class'];
			$image = $defaults['image'];
		   
			$html='';
			
			$html .='<div class="'.$class.'">';
			$html .='<img src="'.$image.'" class="img-responsive" alt="" />';
            $html .='</div>';
			return $html;
		
		
		}
	
	}

new VE_PB_Imageblock();

?>