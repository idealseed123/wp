<?php
class VE_PB_Service{
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_services', array( $this, 'attr' ) );
		
		add_shortcode( 'services', array( $this, 'render' ) );
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
					'title' => '',
					'style_type' => '',
					'number_posts'=> '',
					'posts_per_page' => '-1',
					
					
				), $args
			);
		
		
			extract( $defaults );
			if( $defaults['number_posts'] ) {
	     		$defaults['posts_per_page'] = $defaults['number_posts'];
		           }
		     $service_style = $defaults['style_type'];
			 $title = $defaults['title'];
			
			 $sec_head_class = $defaults['class'];
		
             $sec_head_class = $defaults['class'];
		
               $sec_head_id = $defaults['id'];
			   
			  $html='';
			
			
		        if($service_style == 'style_one') { 
				
				if(!empty($title)){ 
				$html .='<header class="c-section_header"><div class="c-blank_strip" style="width: 104.5px;"></div>
				<div class="container"><div class="row"><h2><span>'.$title.'</span></h2></div></div></header>'; 
				}
				   
                 if($sec_head_id != '' && $sec_head_class !=''){
				$html .='<div class="c-section_content '.$sec_head_class.'  wow fadeIn" data-wow-duration="1.5s" id="'.$sec_head_id.'">';
				}elseif($sec_head_id != ''){
				$html .='<div class="c-section_content" id="'.$sec_head_id.'  wow fadeIn" data-wow-duration="1.5s">';
				}
				elseif($sec_head_class != ''){
				$html .='<div class="c-section_content '.$sec_head_class.'  wow fadeIn" data-wow-duration="1.5s">';
				}
				else{
				$html .='<div class="c-section_content  wow fadeIn" data-wow-duration="1.5s">';
				}
				
				$html .='<div class="c-services">';
                $html .='<div class="container">';
				$html .='<div class="row clearfix" id="c-services">';
				$args = array('post_type' => 'services','posts_per_page' => $no_post, );
				$services = new WP_Query( $args );
				 while( $services->have_posts() ) {
				 $services->the_post();
				 $title = get_the_title();
				 $sub_title = get_post_meta(get_the_ID(),"_cmb_services_sub_title",true);
				 $src = wp_get_attachment_image_src( get_post_thumbnail_id($services->ID), 'capitalx-service-thumb'); 
			 	
				$html.='<div>';
				 if(!empty($src)){
                  $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$src['0']); 
		             }
				$html.='<div class="c-service_info">';
                $html.='<a href="'.esc_url(get_the_permalink()).'">'.$title.'</a>';
                $html.='<span>'.$sub_title.'</span>';
                $html.='</div>';
				 $html.='</div>';
			
			
			
			
			
			}
			$html.='</div>';
			$html.='<div class="c-service_nav">';
            $html.=' <div class="c-arrow_left" id="c-arrow_left">';
            $html.='   <span>arrow left</span>';
            $html.=' </div>';
            $html.=' <div class="c-arrow_right" id="c-arrow_right">';
            $html.='   <span>arrow right</span>';
            $html.=' </div>';
            $html.=' </div>';
			
			
			$html.='</div>';
			$html.='</div>';
			$html.='</div>';
			
		 } 
		         else {
					    
				   
                 if($sec_head_id != '' && $sec_head_class !=''){
				$html .='<div class="wow fadeIn c-services_newt '.$sec_head_class.'" data-wow-duration="1.5s" id="'.$sec_head_id.'">';
				}elseif($sec_head_id != ''){
				$html .='<div class="wow fadeIn c-services_new" id="'.$sec_head_id.'  " data-wow-duration="1.5s">';
				}
				elseif($sec_head_class != ''){
				$html .='<div class="wow fadeIn c-services_new '.$sec_head_class.'  " data-wow-duration="1.5s">';
				}
				else{
				$html .='<div class="wow fadeIn c-services_new" data-wow-duration="1.5s">';
				}
				
				$html .=' <div class="c-services c-section">';
                $html .='<div class="container">';
				if(!empty($title)){
				$html .='<div class="row">';
				$html .='<h2 data-wow-duration="0.5s" class="wow fadeInUp">'.$title.'</h2>';
				$html .='</div>'; 
				 }
				$html .='<div class="row clearfix" id="c-services">';
				$args = array('post_type' => 'services','posts_per_page' => $no_post, );
				$services = new WP_Query( $args );
				 while( $services->have_posts() ) {
				 $services->the_post();
				 $title = get_the_title();
				 $sub_title = get_post_meta(get_the_ID(),"_cmb_services_sub_title",true);
				 $src = wp_get_attachment_image_src( get_post_thumbnail_id($services->ID), 'capitalx-service-thumb'); 
			 	
				$html.='<div>';
				 if(!empty($src)){
                  $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$src['0']); 
		             }
				$html.='<div class="c-service_info">';
                $html.='<a href="'.esc_url(get_the_permalink()).'">'.$title.'</a>';
                $html.='<span>'.$sub_title.'</span>';
                $html.='</div>';
				 $html.='</div>';
			
			
			
			
			
			}
			$html.='</div>';
			
			
			
			$html.='</div>';
			$html.='</div>';
			$html.='</div>';
			
		 
			     
				 }
			
			return $html;
		
		
		}
	
	
	}
new VE_PB_Service();
?>