<?php 
class VE_PB_Heading{
	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 've_pb_attr_heading', array( $this, 'attr' ) );
		
		add_shortcode( 'heading', array( $this, 'render' ) );

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
					'title' => '',
			
				), $args 
			);
		
		  
			extract( $defaults );
			
		    $class = $defaults['class'];
			$title = $defaults['title'];
		   
			$html='';
			
			$html .='<header class="'.$class.' c-page_title">';
			$html .='<h2 class="wow fadeInUp" data-wow-duration="0.5s">'.$title.'</h2>';
            $html .='</header>';
			return $html;
		
		
		}
	
	}

new VE_PB_Heading();

?>