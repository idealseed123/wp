<?php 
class VE_PB_Column{
	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 've_pb_attr_column', array( $this, 'attr' ) );
		
		add_shortcode( 'column', array( $this, 'render' ) );

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
			
				), $args 
			); 
		
			extract( $defaults );
			
		    $class = $defaults['class'];
		   
			$html='';
			
			$html .='<div class="'.$class.'">';
			$html .=do_shortcode($content);
            $html .='</div>';
			return $html;
		
		
		}
	
	}

new VE_PB_Column();

?>