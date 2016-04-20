<?php

class Ve_PB_Multilist{

	public static $args;

	/**

	 * Initiate the shortcode

	 */

	public function __construct() {

		add_filter( 've_pb_attr_achievement', array( $this, 'attr' ) );

		add_shortcode( 'multilists', array( $this, 'render_parent' ) );

		add_shortcode( 'multilist', array( $this, 'render_child' ) );

	}

	/**

	 * Render the shortcode

	 * @param  array $args	 Shortcode paramters

	 * @param  string $content Content between shortcode

	 * @return string		  HTML output

	 */

		function render_parent( $args, $content = '') {

			global $ve_pb_data;

	

			$defaults = Vee_pb_Plugin::set_shortcode_defaults(

				array(

					'class' => '',
					'id' => '',
					'title' => '',

				), $args 

			);

		
			extract( $defaults );

			$sec_class = $defaults['class'];

			$sec_id = $defaults['id'];
			$title = $defaults['title'];

			self::$args = $defaults; 

			$html ='';

			if($sec_id != '' && $sec_class !=''){

			$html .='<div class="container c-section c-multi_icon '.$sec_class.'" id="'.$sec_id.'">';

			}elseif($sec_id != ''){

			$html .='<div class="container c-section c-multi_icon" id="'.$sec_id.'">';

			}

			elseif($sec_class != ''){

			$html .='<div class="container c-section c-multi_icon '.$sec_class.'">';

			}

			else{

			$html .='<div class="container c-section c-multi_icon">';

			}
            $html .='<div  class="row">';
			if(!empty($title)){
			$html .='<h2 class="wow fadeInUp" data-wow-duration="0.5s">'.$title.'</h2>';
			}
			$html .='<div class="c-multi_icon_list clearfix">'.do_shortcode($content).'</div>';

			$html .='</div>';
			$html .='</div>';

			

			

	

			return $html;

	  

		}

		

		/**

	 * Render the child shortcode

	 * @param  array $args	 Shortcode paramters

	 * @param  string $content Content between shortcode

	 * @return string		  HTML output

	 */

	  function render_child( $args, $content = '') {

		$defaults = Vee_pb_Plugin::set_shortcode_defaults(

			array(

				

				'short_text'	=> '',

				'icon'=> '',

			

			), $args

		);

		

		extract( $defaults );

	

        $short_text = $defaults['short_text'];

		$mul_icon = $defaults['icon'];

		

		$html ='';	

		  $html.='<div class="c-single_icon">';
		  $html .='<i class="fa '.$mul_icon.'"></i>';
		  $html.='<span>'.$short_text.'</span>';
         $html.='</div>';

		  return $html; 

	}

	}

new Ve_PB_Multilist();

?>