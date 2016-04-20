<?php
class VEE_PB_Accordian{
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_accordians', array( $this, 'attr' ) );
		add_shortcode( 'accordians', array( $this, 'render_parent' ) );
		add_shortcode( 'accordian', array( $this, 'render_child' ) );
	}
	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
		function render_parent( $args, $content = '') {
			global $ve_pb_data;
			global $theme_option;
			$defaults = Vee_pb_Plugin::set_shortcode_defaults(
				array(
					
					'class' => '',
					'id' => '',
					'title' => '',
					'details' => '',
				
					
					
				), $args 
			);
		
		  
			extract( $defaults );
			$sec_class = $defaults['class'];
			$sec_id = $defaults['id'];
			
			self::$args = $defaults; 
			$html ='';
			//$html .='<section>';
			if($sec_id != '' && $sec_class !=''){
			$html .='<div class="c-contact_accordian '.$sec_class.'" id="'.$sec_id.'">';
			}elseif($sec_id != ''){
				$html .='<div class="c-contact_accordian" id="'.$sec_id.'">';
			}elseif($sec_class != ''){
			$html .='<div class="c-contact_accordian '.$sec_class.'" >';
			}else{
			$html .='<div class="c-contact_accordian" >';	
			}
			
			$html .='<div class="acor_d">'.do_shortcode($content).'</div>';
			
           $html .='</div>';
			return $html;
	  
		}
		
		/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	  function render_child( $args, $content = '') {
		$defaults = Vee_pb_Plugin::set_shortcode_defaults(
			array(
				
				'title'	=> '',
				'details'=> '',
			
			), $args
		);
		
		extract( $defaults );
		//self::$child_args = $defaults;
            $title = $defaults['title'];
			$details = $defaults['details'];
		
		$html ='';	
		   $html.='<div class="c-single_accordian">';
           $html.='<div class="c-accordian_title">';
           $html.='<span>'.$title.'</span>';
           $html.='</div>';
           $html.='<div class="c-accordian_detail c-text_accordian">';
           $html.='<p>'.$details.'</p>'; 
           $html.='</div>';
           $html.='</div>';
		 
		  return $html; 
	}
	}
new VEE_PB_Accordian();	
	
?>