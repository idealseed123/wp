<?php
class VE_PB_price_block_list{
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_service_price', array( $this, 'attr' ) );
		
		add_shortcode( 'service_price', array( $this, 'render' ) );
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
					'price' => '',
					'price_type' => '',
					
					'details'=> '',
					'btn_text' => '',
					'btn_link' => '',
					'style_type' => '',
					'image' => '',
					
					
				), $args
			);
		
		 
			extract( $defaults );
			
		
                $sec_head_class = $defaults['class'];
		        $sec_head_id = $defaults['id'];
			    $title = $defaults['title'];
				$price = $defaults['price'];
		        $price_type = $defaults['price_type'];
			    $short_content = $defaults['details'];
				$btn_text = $defaults['btn_text'];
		        $btn_link = $defaults['btn_link'];
			    $style_type = $defaults['style_type'];
				$image = $defaults['image'];
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
				
				$html .='<div class="c-single_service_list clearfix">';
             
				$html.='<div class="c-single_service_list clearfix">';
				 if ($style_type  == 'style_one')
				  {
				$html.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">';
				  }else{
			    $html.='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">';		  
           		
				  }
           		$html.='<div class="row">';
                if(!empty($image)){
                  $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$image); 
		             }
          		 $html.='</div>';
          		$html.='</div>';
				if ($style_type  == 'style_one')
				  {
				
			     $html.='<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 pull-right c-single_service_list_text">';
				  }else{
			      $html.='<div class="col-lg-5 col-md-5 col-sm-6 col-xs-12 c-single_service_list_text">';
                 }
        		
      			 $html.='<div class="row">';
       			$html.='<h2>'.$title.'</h2>';
				if(!empty($price) && !empty($price_type)){
				$html .='<span><span class="c-active_color">'.$price.'</span>&nbsp;'.$price_type.'</span>';
				}
				if($short_content){
					
				 $html .='<div class="c-price_list">'.$short_content.'</div>';
				}
        		if(!empty($btn_text) && !empty($btn_link)){       
         		$html.='<a href="'.$btn_link.'" class="c-green_but">'.$btn_text.'</a>';
				}
      			$html.='</div></div></div>';
			
			
			
			
			
			
			
			
			$html.='</div>';
			$html.='</div>';
			$html.='</div>';
			
			return $html;
		
		
		}
	
	
	}
new VE_PB_price_block_list();
?>