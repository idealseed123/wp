<?php
class VE_PB_Service_list{
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_services_list', array( $this, 'attr' ) );
		
		add_shortcode( 'services_list', array( $this, 'render' ) );
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
					'number_posts'=> '',
					'posts_per_page' => '-1',
					
					
				), $args
			);
		
		
			extract( $defaults );
			if( $defaults['number_posts'] ) {
	     		$defaults['posts_per_page'] = $defaults['number_posts'];
		           }
		     $no_post = $defaults['posts_per_page'];
			
		
             $sec_head_class = $defaults['class'];
		
               $sec_head_id = $defaults['id'];
			    $title = $defaults['title'];
			$html='';
			
			
		           
                 if($sec_head_id != '' && $sec_head_class !=''){
				$html .='<div class="container '.$sec_head_class.'" id="'.$sec_head_id.'">';
				}elseif($sec_head_id != ''){
				$html .='<div class="container" id="'.$sec_head_id.'">';
				}
				elseif($sec_head_class != ''){
				$html .='<div class="container '.$sec_head_class.'">';
				}
				else{
				$html .='<div class="container">';
				}
				
				$html .='<div class="row c-services_type">';
				if($title){
				$html .='<header class="c-page_title"><h1>'.$title.'</h1></header>';
				}
				$html .='<div class="c-services_listing">';
                $args = array('post_type' => 'services','posts_per_page' => $no_post, );
				$services = new WP_Query( $args );
				$i= 1;
				 while( $services->have_posts() ) {
				 $services->the_post();
				 $title = get_the_title();
				 $short = get_post_meta(get_the_ID(),"_cmb_services_short_content",true);
				 $btn_title = get_post_meta(get_the_ID(),"_cmb_services_btn_title",true);
				 $btn_link = get_post_meta(get_the_ID(),"_cmb_services_btn_link",true);
				 $src = wp_get_attachment_image_src( get_post_thumbnail_id($services->ID), 'capitalx-service-single'); 
			 	
				$html.='<div class="c-single_service_list clearfix '.$i.'">';
				 if ($i % 2 == 0)
				  {
				$html.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right ">';
				  }else{
			    $html.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">';		  
           		
				  }
           		$html.='<div class="row">';
                if(!empty($src)){
                  $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$src['0']); 
		             }
          		 $html.='</div>';
          		$html.='</div>';
				if ($i % 2 == 0)
				  {
				
			$html.='<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-right c-single_service_list_text">';
				  }else{
			$html.='<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 c-single_service_list_text">';
            }
        		
      			 $html.='<div class="row">';
       			$html.='<h2>'.get_the_title().'</h2>';
				if($short){
				$html .='<div class="c-service_type">'.$short.'</div>';
				}
        		if(!empty($btn_title) && !empty($btn_link)){       
         		$html.='<a href="'.$btn_link.'" class="c-green_but">'.$btn_title.'</a>';
				}
      			$html.='</div></div></div>';
			
			
			
			
			
			
			
			$i++;
			}
			
			$html.='</div>';
			$html.='</div>';
			$html.='</div>';
			
			return $html;
		
		
		}
	
	
	}
new VE_PB_Service_list();
?>