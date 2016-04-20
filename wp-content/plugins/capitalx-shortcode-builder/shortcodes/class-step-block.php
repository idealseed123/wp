<?php 
class VE_PB_Step_Block{
	
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_step-block', array( $this, 'attr' ) );
		
		add_shortcode( 'step-block', array( $this, 'render' ) );
	}
	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $ve_pb_data;
		$defaults = Vee_pb_Plugin::set_shortcode_defaults(
			array(
				
				'icon_one' => '',
				'step_one' => '',
                'icon_two' => '',
				'step_two' => '',
				'icon_three' => '',
				'step_three' => '',
				'icon_four' => '',
				'step_four' => '',
				
				
			), $args 
		);
	
      
		extract( $defaults );
		$icon_one = $defaults['icon_one'];
		$step_one = $defaults['step_one'];
		$icon_two = $defaults['icon_two'];
		$step_two = $defaults['step_two'];
		$icon_three = $defaults['icon_three'];
		$step_three = $defaults['step_three'];
		$icon_four = $defaults['icon_four'];
		$step_four = $defaults['step_four'];
		
		
		self::$args = $defaults; 
		$html ='';
		  
    
      
        $html .=' <div class="c-step_blocks c-step_blocks_home wow bounceInLeft animated" data-wow-duration="1s" id="c-step_blocks">';  
		$html .='<div class="container">';
		$html .='<div class="row">';
		$html .=' <div class="c-step_top clearfix">';
		if(!empty($icon_one) && !empty($step_one)){
		$html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
		$html .=' <div class="row c-step_one">';
		$html .=' <i class="fa '.$icon_one.'"></i>';
	    $html .='<span>'.$step_one.'</span>';
        $html .='</div>';
        $html .='</div>';
		}
        $html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
		if(!empty($icon_two) && !empty($step_two  )){
        $html .='<div class="row c-step_two">';
        $html .='<i class="fa '.$icon_two.'"></i>';
        $html .='<span>'.$step_two.'</span>';
		$html .='</div>'; 
		}
        $html .='</div>';
	    $html .='</div>';
		$html .=' <div class="c-step_bottom clearfix">';
		$html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
		if(!empty($icon_three) && !empty($step_three  )){
		$html .=' <div class="row c-step_three pull-right">';
		$html .=' <i class="fa '.$icon_three.'"></i>';
	    $html .='<span>'.$step_three.'</span>';
        $html .='</div>';
		}
        $html .='</div>';
        $html .='<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">';
		if(!empty($icon_four) && !empty($step_four)){
        $html .='<div class="row c-step_four pull-right">';
        $html .='<i class="fa '.$icon_four.'"></i>';
        $html .='<span>'.$step_four.'</span>';
		$html .='</div>'; 
		}
        $html .='</div>';
	    $html .='</div>';
	    $html .='</div>';
	    $html .='</div>';
		$html .='</div>';
		return $html;
	}
	}
new VE_PB_Step_Block();
?>