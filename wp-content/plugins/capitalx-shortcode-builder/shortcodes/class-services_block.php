<?php 

class VE_PB_service_block{

	  /**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_service_block', array( $this, 'attr' ) );

		add_shortcode( 'service_block', array( $this, 'render' ) );





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

					'block_title' => '',
					'title' => '',
					'short_text' => '',
					'content' => '',
					'image' => '',
                  ), $args 

			);
       	
            
		   extract( $defaults );
           $block_title = $defaults['block_title'];
			$content_txt = $defaults['content'];
			$title = $defaults['title'];
			$short_text = $defaults['short_text'];
             $image = $defaults['image'];


			$html='';
			
		   $html .='<div class="c-conv_service">';
	       $html .='<header class="c-section_header" id="c-section_header">';
           $html .='<div class="c-blank_strip" style="width: 221.5px;"></div>';
           $html .='<div class="container">'; 
           $html .='<div class="row">';
		   $html.='<h2><span>'.$block_title.'</span></h2>';
           $html .='</div>';
           $html .='</div>';
           $html .='</header>';
	       $html .='<div class="c-section_content">';
           $html .='<div class="container">'; 
           $html .='<div class="row">';
           $html .='<div class="c-conv_service_content clearfix">';
           $html .='<div class="c-conv_service_left">';
		   
		   $html .='<h3>'.$title.'</h3>';	   
           $html .='<p>'.$short_text.'</p>';
		   $html .='<p>'.$content_txt.'</p>';
          $html.='</div>';
		   if(!empty($image)){
		   $html.='<div class="c-conv_service_right">';
		   $html .= sprintf('<img src="%s" class="img-responsive" alt="">',$image);
           $html.='</div>';
		   }
          $html.='</div></div></div></div>';
		  $html.='</div>';

			return $html;

	

	

		}

	

	}

new VE_PB_service_block()



?>