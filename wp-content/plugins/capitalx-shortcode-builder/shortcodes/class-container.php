<?php
class Ve_PB__Container{
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_radio_graph', array( $this, 'attr' ) );
		add_shortcode( 'container', array( $this, 'render_parent' ) );
		
	}
	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
		function render_parent( $args, $content = '') {
			global $ve_pb_data;
	
			$defaults = Vee_pb_Plugin::set_shortcode_defaults(
				array(
					
					'class' => '',
					'id' => '',
					
					
					
				), $args 
			);
		
		  
			extract( $defaults );
			$sec_class = $defaults['class'];
			$sec_id = $defaults['id'];
			
			
			self::$args = $defaults; 
			$html ='';
			if($sec_id != '' && $sec_class !=''){
	        $html ='<div class="container '.$sec_class.'" id="'.$sec_id.'">';
			}elseif($sec_id != ''){
			$html ='<div class="container" id="'.$sec_id.'">';
			}
			elseif($sec_class != ''){
			$html ='<div class="container '.$sec_class.'">';
			}
			else{
			$html ='<div class="container">';
			}
			$html .='<div class="row" >'.do_shortcode($content).'</div>';
			$html .='</div>';
	
			return $html;
	  
		}
		
	
	}
 
new Ve_PB__Container();
?>