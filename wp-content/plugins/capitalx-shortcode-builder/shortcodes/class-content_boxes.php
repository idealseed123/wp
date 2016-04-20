<?php
class VE_PB_content_boxes { 
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_content_boxes', array( $this, 'attr' ) );
		add_shortcode( 'content_boxes', array( $this, 'render' ) );
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
					'icon' => '',
					
				), $args 
			); 
			
			extract( $defaults );
		    $class = $defaults['class'];
			$id = $defaults['id'];
			$icon = $defaults['icon'];

			$html='';
			$html .='<div class="'.$class.'">';
			if($icon){
			$html .='<i class="fa '.$icon.'"></i>';
			}
			$html .= do_shortcode( $content );
            $html .='</div>';
			return $html;
		}
	}
new VE_PB_content_boxes();