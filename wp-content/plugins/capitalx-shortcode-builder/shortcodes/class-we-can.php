<?php 
class VE_PB_we_can{
	
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_we_can', array( $this, 'attr' ) );
		
		add_shortcode( 'we_can', array( $this, 'render' ) );
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
				
				'title' => '',
				 'content' => '',
				
				
			), $args 
		);
	
      
		extract( $defaults );
		$title = $defaults['title'];
		
		$content = $defaults['content'];
		
		
		
		
		self::$args = $defaults; 
		$html ='';
		  
    
      
         
		$html .='<div class="c-we_can">';
		$html .='<div class="c-bg_strip"></div>';
		$html .='<div class="container c-we_can_text">';
		 if($title){
		$html .='<div class="row">';
        $html .='<h2>'.$title.'</h2>';
		 $html .='<p>'.$content.'</p>';
        $html .='</div>';
		}
		
		
        $html .='</div>';
	    $html .='</div>';
	  
	  

		return $html;
	}
	}
new VE_PB_we_can();
?>