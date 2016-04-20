<?php 
class VE_PB_new_services{
	
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_new_services', array( $this, 'attr' ) );
		//add_filter( 've_pb_content-box-shortcode-content-container', array( $this, 've_pb_attr_about_block' ) );
		
		add_shortcode( 'new_services', array( $this, 'render' ) );
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
				'service_content' => '',
				'image_one' => '',
				'image_two' => '',
				'image_three' => '',
				'image_four' => '',
				'image_five' => '',
				'image_six' => '',
				'short_text' => '',
				'btn_text' => '',
				'btn_link' => '',
                
				
				
			), $args 
		);
		//\print_r($args);
	
      
		extract( $defaults );
		$title = $defaults['title'];
		$service_content = $defaults['service_content'];
		$image_one = $defaults['image_one'];
		$image_two = $defaults['image_two'];
		$image_three = $defaults['image_three'];
		$image_four = $defaults['image_four'];
		$image_five = $defaults['image_five'];
		$image_six = $defaults['image_six'];
		$short_text = $defaults['short_text'];
		$btn_text = $defaults['btn_text'];
		$btn_link = $defaults['btn_link'];
				
		
		
		
		self::$args = $defaults; 
		$html ='';
		  
    
      
         
		$html .='<div class="container">';
		$html .='<div class="row">';
		$html .='<div class="c-newser_thumbs clearfix">';
		$html .='<div class="c-single_newser_thumb">';
			 $html .='<div>';
			 if($title){
				 $html .='<h2>'.$title.'</h2>';
				 }
			 $html .=''.$service_content.'';
			 $html .='</div>';
         $html .='</div>';
		 
		 if(!empty($image_one)){
		 $html .='<div class="c-single_newser_thumb">';
		 $html .='<img src="'.$image_one.'" alt="" class="img-responsive">';
		 $html .='</div>';
		 }
		 
		 if(!empty($image_two)){
		 $html .='<div class="c-single_newser_thumb">';
		 $html .='<img src="'.$image_two.'" alt="" class="img-responsive">';
		 $html .='</div>';
		 }
		 
		 if(!empty($image_three)){
		 $html .='<div class="c-single_newser_thumb">';
		 $html .='<img src="'.$image_three.'" alt="" class="img-responsive">';
		 $html .='</div>';
		 }
		 
		 if(!empty($image_four)){
		 $html .='<div class="c-single_newser_thumb">';
		 $html .='<img src="'.$image_four.'" alt="" class="img-responsive">';
		 $html .='</div>';
		 }
		 
		 if(!empty($image_five)){
		 $html .='<div class="c-single_newser_thumb">';
		 $html .='<img src="'.$image_five.'" alt="" class="img-responsive">';
		 $html .='</div>';
		 }
		 
		 if(!empty($image_six)){
		 $html .='<div class="c-single_newser_thumb">';
		 $html .='<img src="'.$image_six.'" alt="" class="img-responsive">';
		 $html .='</div>';
		 }
		 
		 if(!empty($short_text)){
		 $html .='<div class="c-single_newser_thumb">';
		 $html .='<p>'.$short_text.'</p>';
		 if(!empty($btn_text) && !empty($btn_link)){
		 $html .='<a href="'.$btn_link.'">'.$btn_text.'</a>';
			 
			 }
		 $html .='</div>';
		 }
		
		
		
		 $html .='</div>';
	    $html .='</div>';
	    $html .='</div>';
	  

		return $html;
	}
	}
new VE_PB_new_services();
?>