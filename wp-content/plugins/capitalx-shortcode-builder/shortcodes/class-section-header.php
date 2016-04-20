<?php
class Ve_PB_Section_Head{
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_section_header', array( $this, 'attr' ) );
		
		add_shortcode( 'section_header', array( $this, 'render' ) );
	}
	/**
	 * Render the shortcode
	 * @param
array $args	 Shortcode paramters
	 * @param
string $content Content between shortcode
	 * @return string		
HTML output
	 */
			function render( $args, $content = '') {
				global $ve_pb_data;
		
				$defaults = Vee_pb_Plugin::set_shortcode_defaults(
					array(
						
						'class' => '',
						'id' => '',
						'sec_title' => '',
						
						
						
					), $args
				);
			
				extract( $defaults );
		
                $sec_head_class = $defaults['class'];
				$sec_head_id = $defaults['id'];
				$sec_title = $defaults['sec_title'];
				
		
               self::$args = $defaults;
				$html ='';
				if($sec_head_id != '' && $sec_head_class !=''){
				$html .='<header class="c-section_header '.$sec_head_class.'" id="'.$sec_head_id.'">';
				}elseif($sec_head_id != ''){
				$html .='<header class="c-section_header" id="'.$sec_head_id.'">';
				}
				elseif($sec_head_class != ''){
				$html .='<header class="c-section_header '.$sec_head_class.'">';
				}
				else{
				$html .='<header class="c-section_header">';
				}
				$html .='<div class="c-blank_strip"></div>';		
				$html .='<div class="container">';
				$html .='<div class="row">';
				$html .= '<h2><span>'.$sec_title.'</span></h2>';
				$html .= '</div>';
				$html .= '</div>';
				$html .='</header>';
		
				return $html;
		
			}
	}
new Ve_PB_Section_Head();
?>