<?php 

class  VE_PB_TeamMember{

	

	public static $args;



	/**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_team_member', array( $this, 'attr' ) );

		

		add_shortcode( 'team_member', array( $this, 'render' ) );



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

		$sec_class = $defaults['class'];

		$sec_id = $defaults['id'];

		$title = $defaults['title'];

		

		self::$args = $defaults; 

		$args = array('post_type' => 'team_member','posts_per_page' => '-1', );

        $team_member= new WP_Query( $args );

	    $html ='';
		if($sec_id != '' && $sec_class !=''){

			$html .='<div class="c-our_expert '.$sec_class.'" id="'.$sec_id.'">';

			}elseif($sec_id != ''){

			$html .='<div class="c-our_expert" id="'.$sec_id.'">';

			}

			elseif($sec_class != ''){

			$html .='<div class="c-our_expert '.$sec_class.'">';

			}

			else{

			$html .='<div class="c-our_expert">';

			}

		
        $html .='<header class="c-page_title">';
        $html .='<h2>'.$title.'</h2>';
        $html .='<div class="c-bg_strip"></div>';
		$html .='<div class="expert_outer">';
		$html .='<div class="container">';
			$html .='<div class="row c-expert_list">';
			 while( $team_member->have_posts() ) {
	
				 $team_member->the_post();
	
			 $src = wp_get_attachment_image_src( get_post_thumbnail_id($team_member->ID),'full');
	
			   $fb = get_post_meta(get_the_ID(),"_cmb_member_facebook_url",true);
	
			 $twt = get_post_meta(get_the_ID(),"_cmb_member_twitter_url",true);
			   $link = get_post_meta(get_the_ID(),"_cmb_member_in_url",true);
	
		   
	
			 //$html .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';	
			 $html .='<div>'; 
	$html .='<div class="c-expert_img">';
			   $html .='<img alt="" class="img-responsive" src="'.esc_url($src['0']).'">';
	$html .='</div>';
				  $html .='<div class="c-expert_detail">';
	
					
	
				$html .='<div>';	
	
					  $html.=  '<h3>'.get_the_title().'</h3>';
	
					  $html.='<span>'.get_post_meta(get_the_ID(),"_cmb_member_Position",true).'</span>';
	
					 
	
					  $html .='<ul>';
						  if($link !=''){
	
						 $html .= '<li><a href="'.esc_url($link).'"><i class="fa fa-linkedin"></i></a></li>';}
	
						 if($fb !=''){
	
						 $html .= '<li><a href="'.esc_url($fb).'"><i class="fa fa-facebook"></i></a></li>';}
	
						 if($twt !=''){
	
						  $html .='<li><a href="'.esc_url($twt).'"><i class="fa fa-twitter"></i></a></li>';}
	
	
					 $html .= '</ul>';
					  $html .='<p>'.get_the_content().'</p>';
	$html .='</div>';
					$html .='</div>';
				   $html .='</div>';	 
	
			
			 }
	
			$html .='</div>';
		
			$html.='<div class="c-review_nav">';
				$html.='<div id="c-client_left" class="c-arrow_left">';
				$html.='<span>arrow left</span>';
				$html.='</div>';
				$html.='<div id="c-client_right" class="c-arrow_right">';
				$html.='<span>arrow right</span>';
				$html.='</div>';
			$html.='</div>';
		
		$html .='</div>';
		$html .='</div>';
        $html .='</header>';
		$html .='</div>'; 

			 

		return $html;



	}



}

new VE_PB_TeamMember();









