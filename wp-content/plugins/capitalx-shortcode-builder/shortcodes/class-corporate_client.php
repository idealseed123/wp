<?php 
class VE_PB_corporate_client{
	
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_about_block', array( $this, 'attr' ) );
		//add_filter( 've_pb_content-box-shortcode-content-container', array( $this, 've_pb_attr_about_block' ) );
		
		add_shortcode( 'about_block', array( $this, 'render' ) );
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
				'image' => '',
				'style_type' => '',
                'content' => '',
				
				
			), $args 
		);
	
      
		extract( $defaults );
		$title = $defaults['title'];
		$image = $defaults['image'];
		$details = $defaults['content'];
		
		
		
		
		self::$args = $defaults; 
		$html ='';
		  
    
      
         
		$html .='<div class="container">';
		$html .='<div class="row">';
		if($title){
		$html .='<header class="c-page_title">';
        $html .='<h1>'.$title.'</h1>';
        $html .='</header>';
		}
		$html .=' <div class="c-corporate_block clearfix">';
		 if($style_type == 'style_one') {
		$html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">';
		 }else{
			 
			$html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">';	 
			 }
		$html .=' <div class="row">';
	  
        $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$image); 
		
        $html .='</div>';
        $html .='</div>';
	
		$html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
        $html .=''.$details.'';
       $html .='</div>';
		
        $html .='</div>';
	    $html .='</div>';
	    $html .='</div>';
	  

		return $html;
	}
	}
new VE_PB_corporate_client();
?>