<?php 

class VE_PB_youtube{

	  /**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_services', array( $this, 'attr' ) );

		add_shortcode( 'video_section', array( $this, 'render' ) );





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
					'details' => '',
					'btn_text' => '',
					'btn_link' => '',
					

					'background_image' => '',

					'video_id' => '',

					

				), $args 

			);
        //   echo '<pre>';
       //    print_r($args );
		 //  echo '</pre>';		
            
		   extract( $defaults );

			$class = $defaults['class'];

		    $id = $defaults['id'];
			$title = $defaults['title'];
			$details = $defaults['details'];
			$btn_text = $defaults['btn_text'];
			$btn_link = $defaults['btn_link'];

			$video_id = $defaults['video_id'];

			

		    $background_image = $defaults['background_image'];

			 

			$html='';
			
		   //$html .='<div class="c-section_content">';
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
			$html .='<div class="container">'; 
		   $html .='<div class="row">';
		   $html.='<div class="c-training_content clearfix">';
            $html.='<div class="c-training_left">';
             $html.='<h2>'.$title.'</h2>';
             $html.='<p>'.$details.'</p>';
			 
           if(!empty($btn_link) && !empty($btn_text)){
            $html.='<a href="'.$btn_link.'" class="c-green_but">'.$btn_text.'</a>';
		       }
           $html.='</div>';
          $html.='<div class="c-training_right">';
		  $html.='<video controls>';
		 // $html.='<a href="#" class="slvj-link-lightbox 1" data-videoid="'.$video_id.'" data-videosite="youtube">
		 // <i class="fa fa-play"></i></a>';
		  $html.='<source src="'.$video_id.'" type="video/mp4" />';
		  $html.='<img src="'.get_template_directory_uri().'/assets/images/title-video.jpg" alt="" title="Your browser does not support the <video> tag">';
                 
         // $html.='<a href="#" class="slvj-link-lightbox 1" data-videoid="'.$video_id.'" data-videosite="youtube"><i class="fa fa-play"></i></a>';      
		 $html.='</video>';     
         $html.='</div>';
           
			$html.='</div>';
            $html.='</div>';
			$html.='</div>';
			$html.='</div>';

			return $html;

	

	

		}

	

	}

new VE_PB_youtube()



?>