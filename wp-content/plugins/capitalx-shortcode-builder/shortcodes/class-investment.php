<?php
class VEE_PB_Invetments{
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_invetments', array( $this, 'attr' ) );
		add_shortcode( 'investments', array( $this, 'render_parent' ) );
		add_shortcode( 'investment', array( $this, 'render_child' ) );
	}
	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
		function render_parent( $args, $content = '') {
			global $ve_pb_data;
			global $theme_option;
			$defaults = Vee_pb_Plugin::set_shortcode_defaults(
				array(
					
					'class' => '',
					'id' => '',
					'title' => '',
					'details' => '',
				
					
					
				), $args 
			);
		
		  
			extract( $defaults );
			$sec_class = $defaults['class'];
			$sec_id = $defaults['id'];
			
			self::$args = $defaults; 
			$html ='';
			//$html .='<section>';
			if($sec_id != '' && $sec_class !=''){
			$html .='<div class="c-investment '.$sec_class.'" id="c-investment '.$sec_id.'">';
			}elseif($sec_id != ''){
				$html .='<div class="c-investment" id=" c-investment'.$sec_id.'">';
			}elseif($sec_class != ''){
			$html .='<div class="c-investment '.$sec_class.'" id="c-investment">';
			}else{
			$html .='<div class="c-investment" id="c-investment">';	
			}
			if($title){
           $html .='<h2 class="wow fadeInUp" data-wow-duration="0.5s">'.$title.'</h2>';
		   $html .='<p>'.$details.'</p>';
			}
			$html .='<div class="container">';
			$html .='<div class="row c-counter_circle clearfix">'.do_shortcode($content).'</div>';
			$html .='</div>';
            $html .='</div>';
       //     $html .='</section>';
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
		//self::$child_args = $defaults;
            $fact_name = $defaults['name'];
			$fact_value = $defaults['value'];
		
		$html ='';	
		  $html.='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
		  $html.='<div class="row">';
          $html.='  <div class="c-counter_bg  wow swing center" data-wow-iteration="1" data-val="'.$fact_value.'">';
          $html.='<span class="c-cirle_half" ></span>
              <span class="c-cirle_full" ></span>';
         $html.='</div>';
         $html.='<div class="c-counter_text">';
	     $html.='<h4>'.$fact_name.'</h4>';
		 $html.='<span>'.$fact_value.'%</span>';
		 $html.='</div>';
		 $html.='</div>';
		 
		  $html.='</div>';
		  return $html; 
	}
	}
new VEE_PB_Invetments();	
	
?>