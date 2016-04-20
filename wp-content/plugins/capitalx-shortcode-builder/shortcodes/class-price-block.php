<?php 

class VE_PB_price_block{

	  /**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_price_block', array( $this, 'attr' ) );

		add_shortcode( 'price_block', array( $this, 'render' ) );





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
					'block_one_title' => '',
					'block_one_details' => '',
					'block_one_old_price' => '',
					'block_one_old_price_type' => '',
					'block_one_price' => '',
					'block_one_price_type' => '',
					'block_one_btn_text' => '',
					'block_one_btn_link' => '',
					'block_one_image' => '',
					
					'block_two_title' => '',
					'block_two_details' => '',
					'block_two_old_price' => '',
					'block_two_old_price_type' => '',
					'block_two_price' => '',
					'block_two_price_type' => '',
					'block_two_btn_text' => '',
					'block_two_btn_link' => '',
					'block_two_image' => '',
					
					

					

				), $args 

			);
        //   echo '<pre>';
       //    print_r($args );
		 //  echo '</pre>';		
            
		   extract( $defaults );

			$class = $defaults['class'];

		    $id = $defaults['id'];
			$title = $defaults['block_one_title'];
			$details = $defaults['block_one_details'];
			$old_price = $defaults['block_one_old_price'];
			$old_type = $defaults['block_one_old_price_type'];
            $price = $defaults['block_one_price'];
            $price_type = $defaults['block_one_price_type'];
			$btn_text = $defaults['block_one_btn_text'];
            $btn_link = $defaults['block_one_btn_link'];
			$src = $defaults['block_one_image'];
			$title1 = $defaults['block_two_title'];
			$details1 = $defaults['block_two_details'];
			$old_price1 = $defaults['block_two_old_price'];
			$old_type1 = $defaults['block_two_old_price_type'];
            $price1 = $defaults['block_two_price'];
            $price_type1 = $defaults['block_two_price_type'];
			$btn_text1 = $defaults['block_two_btn_text'];
            $btn_link1 = $defaults['block_two_btn_link'];
			$src1 = $defaults['block_two_image'];

			 

			$html='';
			
		   
		   if($id != '' && $class !=''){

			$html .='<div class="c-section_content '.$class.'" id="'.$id.'">';

			}elseif($id != ''){

			$html .='<div class="c-section_content" id="'.$id.'">';

			}

			elseif($class != ''){

			$html .='<div class="c-section_content '.$class.'">';

			}

			else{

			$html .='<div class="c-section_content">';

			}
			
		
   
        
			 $html.='<div class="c-price">';
			 $html .='<div class="container">'; 
		     $html .='<div class="row clearfix">';
		     $html.='<div class="col-lg-5 col-md-5 col-md-5 col-xs-12 c-single_price wow bounceInLeft animated" data-wow-duration="1s">';
             $html.='<div class="row">';
             $html.='<h3>'.$title.'</h3>';
             $html.='<p>'.$details.'</p>';
			 if(!empty($old_price) && !empty($old_type)){
			 $html.='<div class="c-price_info c-old_price">';
             $html.='<span class="c-price_range">'.$old_price.'</span>';
              $html.='<span class="c-price_type">'.$old_type.'</span>';
             $html.='</div>';
			 }
			 if(!empty($price) && !empty($price_type)){
             $html.='<div class="c-price_info">';
             $html.='<span class="c-price_range">'.$price.'</span>';
             $html.='<span class="c-price_type">'.$price_type.'</span>';
             $html.='</div>';
			 }
			 if(!empty($btn_text) && !empty($btn_link)){
            $html.='<div class="c-price_button clearfix">';
            $html.='<a href="'.$btn_link.'" >'.$btn_text.'</a>';
             $html.='</div>';
			 }
			$html .= sprintf( '<img class="img-responsive" src="%s" alt=""/>', $src) . "\n";
			
           $html.='</div>';
		   $html.='</div>';
		   
		    $html.='<div class="col-lg-5 col-md-5 col-md-5 col-xs-12 c-single_price wow bounceInRight animated" data-wow-duration="1.5s">';
             $html.='<div class="row">';
             $html.='<h3>'.$title1.'</h3>';
             $html.='<p>'.$details1.'</p>';
			 if(!empty($old_price1) && !empty($old_type1)){
			 $html.='<div class="c-price_info c-old_price">';
             $html.='<span class="c-price_range">'.$old_price1.'</span>';
              $html.='<span class="c-price_type">'.$old_type1.'</span>';
             $html.='</div>';
			 }
			 if(!empty($price1) && !empty($price_type1)){
             $html.='<div class="c-price_info">';
             $html.='<span class="c-price_range">'.$price1.'</span>';
             $html.='<span class="c-price_type">'.$price_type1.'</span>';
             $html.='</div>';
			 }
			 if(!empty($btn_text1) && !empty($btn_link1)){
            $html.='<div class="c-price_button clearfix">';
            $html.='<a href="'.$btn_link1.'" >'.$btn_text1.'</a>';
             $html.='</div>';
			 }
			$html .= sprintf( '<img class="img-responsive" src="%s" alt=""/>', $src1) . "\n";
			
           $html.='</div>';
		   $html.='</div>';

		  
                
         
           
			$html.='</div>';
            $html.='</div>';
			$html.='</div>';
			$html.='</div>';

			return $html;

	

	

		}

	

	}

new VE_PB_price_block()



?>