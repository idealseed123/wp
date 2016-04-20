<?php

class Ve_PB_Achievement{

	public static $args;

	/**

	 * Initiate the shortcode

	 */

	public function __construct() {

		add_filter( 've_pb_attr_achievement', array( $this, 'attr' ) );

		add_shortcode( 'achievements', array( $this, 'render_parent' ) );

		add_shortcode( 'achievement', array( $this, 'render_child' ) );

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

			$html .='<div class="container c-achivment '.$sec_class.'" id="'.$sec_id.'">';

			}elseif($sec_id != ''){

			$html .='<div class="container c-achivment" id="'.$sec_id.'">';

			}

			elseif($sec_class != ''){

			$html .='<div class="container c-achivment '.$sec_class.'">';

			}

			else{

			$html .='<div class="container c-achivment">';

			}

			$html .='<div class="row"><header class="c-page_title"><h2>'.$title.'</h2></header></div>';
			$html .='<div class="c-achivment_list"><div class="row clearfix">'.do_shortcode($content).'</div></div>';

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

				

				'name'	=> '',

				'value'=> '',

			

			), $args

		);

		

		extract( $defaults );

	

        $name = $defaults['name'];

		$value = $defaults['value'];

		

		$html ='';	

		  $html.='<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">';
		  $html.='<div class="row c-achivment_box">';

		  $html .='<span class="c-achivment_number">'.$value.'</span>';

		  $html.=' <span class="c-achivment_name">'.$name.'</span>';
           $html.='</div>';
         $html.='</div>';

		  return $html; 

	}

	}

new Ve_PB_Achievement();

?>