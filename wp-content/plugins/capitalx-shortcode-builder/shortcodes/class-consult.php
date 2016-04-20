<?php 

class VE_PB_consult_block{

	  /**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_cunsolt_block', array( $this, 'attr' ) );

		add_shortcode( 'consult_block', array( $this, 'render' ) );





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

					

					
					'title' => '',
					'content' => '',
					'phone_text' => '',
					'phone' => '',
					'image' => '',


					

				), $args 

			);
       	
            
		   extract( $defaults );
           $title = $defaults['title'];
			$content = $defaults['content'];
			$phone_text = $defaults['phone_text'];
			$phone = $defaults['phone'];
             $image = $defaults['image'];

			 

			$html='';
			
		   $html .='<div class="c-training_video c-free_consult">';
	       $html .='<header class="c-section_header" id="c-section_header">';
           $html .='<div class="c-blank_strip" style="width: 221.5px;"></div>';
           $html .='<div class="container">'; 
           $html .='<div class="row">';
		   $html.='<h2><span>'.$title.'</span></h2>';
           $html .='</div>';
           $html .='</div>';
           $html .='</header>';
	       $html .='<div class="c-section_content">';
           $html .='<div class="container">'; 
           $html .='<div class="row">';
           $html .='<div class="c-training_content clearfix">';
           $html .='<div class="c-training_left">'; 
           $html .='<p>'.$content.'</p>';
           $html .='<div class="c-consult_call">
                 <span>'.$phone_text.'</span> 
                 <a class="c-call_box" href="tel:'.$phone.'"><i class="fa fa-phone"></i>'.$phone.'</a>';
           $html .='</div>';
           $html .='</div>';
		   if(!empty($image)){
		   $html.='<div class="c-training_right">';
		   $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$image);
           $html.='</div>';
		   }
          $html.='</div></div></div></div>';
		  $html.='</div>';

			return $html;

	

	

		}

	

	}

new VE_PB_consult_block()



?>