<?php 
class VE_PB_Earn{
	
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_earn', array( $this, 'attr' ) );
		
		add_shortcode( 'already-earn', array( $this, 'render' ) );
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
				'price' => '',
                 'details' => '',
				'background_image' => '',
				
				
			), $args 
		);
	
      
		extract( $defaults );
		$title = $defaults['title'];
		$price = $defaults['price'];
		$des = $defaults['details'];
		    $background_image = $defaults['background_image'];
		
		self::$args = $defaults; 
		$html ='';
      $html .='<div id="c-already_earn" class="c-already_earn  wow fadeIn" data-wow-duration="1.5s">';  
	$html .='<div class="c-bg_strip"></div>';
    $html .='<div class="container">';
      $html .='<div class="row clearfix">';
     $html .='<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-right">';
    $html .='<div class="row">';
    $html .='<header class="c-section_header">';
   $html .='<h2><span>'.$title.'</span></h2>';
       $html .='</header>';
        $html .='<div class="c-earning_detail">';
        $html .='<div class="c-price_counter">';
      $html .='<span>'.$price.'</span>';
       $html .='</div>';
    $html .='<p>'.$des.'</p>';
             $html .='</div></div></div>
          <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
          <div class="row">';
		  if(!empty($background_image)){
    $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$background_image); 
		  }
       $html .='</div>';
	   $html .='</div>';
	   $html .='</div>';
	   $html .='</div>';
	
        
     
		
	//	$html .=do_shortcode($content);
		$html .='</div>';
		
		
		return $html;
	}
	}
new VE_PB_Earn();
?>