<?php
class VE_PB_Review{
	
	
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_reviews', array( $this, 'attr' ) );
		
		add_shortcode( 'reviews', array( $this, 'render' ) );
	}
	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $ve_pb_data;
        global $theme_option;
		$defaults = Vee_pb_Plugin::set_shortcode_defaults(
			array(
				
				'class' => '',
				'id' => '',
				'title' => '',
				'number_posts'				=> '',
				'posts_per_page'	  		=> '-1',
				
				
			), $args 
		);
	
      
		extract( $defaults );
		if( $defaults['number_posts'] ) {
	     		$defaults['posts_per_page'] = $defaults['number_posts'];
		}
		$no_post = $defaults['posts_per_page'];
		$class = $defaults['class'];
		$id = $defaults['id'];
		$title = $defaults['title'];
	
		
		self::$args = $defaults; 
		$args = array('post_type' => 'reviews','posts_per_page' => $no_post, );
        $testimonials = new WP_Query( $args );
	    $html ='';
		
		
		 if($id != '' && $class !=''){
			$html .='<div class="c-customer_review container '.$class.'" id="'.$id.'">';
			}elseif($id != ''){
			$html .='<div class="c-customer_review container" id="'.$id.'">';
			}
			elseif($class != ''){
			$html .='<div class="c-customer_review container '.$class.'">';
			}
			else{
			$html .='<div class="container c-customer_review">';
			}
    
                  
       $html .='<div class="row c-section">';
        $html .='<h2 class="wow fadeInUp" data-wow-duration="0.5s">'.$title.'</h2>';
		$html .='<div class="c-review_list clearfix" id="c-review_list">';
       while( $testimonials->have_posts() ) {
			 $testimonials->the_post();
         
		  $src = wp_get_attachment_image_src( get_post_thumbnail_id($testimonials->ID), 'capitalx-review-thumb'); 
	
		 $desi = get_post_meta(get_the_ID(),'_cmb_review_designation',true);
		 
	     
		$html .='<div>';
		$html .='<div class="c-cusomer_name clearfix">';
         
		 $html .= sprintf( '<img class="img-responsive" src="%s" alt=""/>', $src['0']) . "\n";
         $html .='<div class="c-cusomer_name clearfix">';
         $html .='<h2>'.get_the_title().'</h2>';
         $html .='<span>'.$desi.'</span>';
        $html .='</div>';
       $html .='<p>'.get_the_content().'</p>';
		
		$html .='</div></div>';	  
	
		 }
		$html .='</div>';
		$html .='<div class="c-review_nav">';
        $html .='<div id="c-review_left" class="c-arrow_left">';
        $html .='<span>arrow left</span>';
        $html .='</div>';
        $html .='<div id="c-review_right" class="c-arrow_right">';
         $html .='<span>arrow right</span>';
       $html .='</div>';
       $html .=' </div>';
		$html .='</div>';
		$html .='</div>';
		
		
		return $html;
	}
}
new VE_PB_Review();
?>