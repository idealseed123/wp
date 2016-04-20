<?php

class VE_PB_Blog {

	private $gridblog_class;

	private $icon_class;

	public static $args;

	/**

	 * Initiate the shortcode

	 */

	public function __construct() {

		add_filter( 've_pb_attr_blog', array( $this, 'attr' ) );


		add_shortcode( 'blog', array( $this, 'render' ) );

	}

	/**

	 * Render the shortcode

	 * @param  array $args	 Shortcode paramters

	 * @param  string $content Content between shortcode

	 * @return string		  HTML output

	 */

	function render( $args, $content = '') {

		$defaults = Vee_Pb_Plugin::set_shortcode_defaults(

			array(

				'class'			   			=> '',

				'id'				 		=> '',
				'title'				 		=> '',

				'cat_slug'			  		=> '',

				'number_posts'				=> '',
				'style_type'				=> '',

				'order'			   			=> 'ASC',

				'posts_per_page'	  		=> '-1',

				'taxonomy'					=> 'category'

			), $args

		);

		extract( $defaults );

		if( $defaults['number_posts'] ) {

	     		$defaults['posts_per_page'] = $defaults['number_posts'];

		}

		$no_post = $defaults['posts_per_page'];
		$title = $defaults['title'];
		$style_type = $defaults['style_type'];
        
		$cat_ids ='';

		$categories = explode( ',' , $defaults['cat_slug'] );

		if ( isset( $categories ) && 

			 $categories 

		) {

			foreach ( $categories as $category ) {

			

				$id_obj = get_category_by_slug( $category );

				

				if ( $id_obj ) {

					if ( strpos( $category, '-' ) === 0 ) {

						$cat_ids .= '-' . $id_obj->cat_ID . ',';

					} else {

						$cat_ids .= $id_obj->cat_ID . ',';

					}

				}

			}

		}

	   

       $defaults['cat'] = substr( $cat_ids, 0, -1 );

		self::$args = $defaults;
     $html ="";



    $args = array('post_type' => 'post','cat'=> $defaults['cat'],'field'=>'slug','posts_per_page' => $no_post,);

       $grid_box_posts = new WP_Query( $args );
	     
		 if($style_type == 'style_one'){
		 
         $html .='<div class="container c-section">';
		 $html .='<div class="row">';
		 $html .= sprintf( '<h2 class="wow fadeInUp" data-wow-duration="0.5s">%s</h2>', $title );
		 
		 $html .='<div class="c-news_listing">';

	     while( $grid_box_posts->have_posts() ) {

				  $grid_box_posts->the_post(); 

				  $src = wp_get_attachment_image_src( get_post_thumbnail_id($grid_box_posts->ID), 'capitalx-post-thumb'); 
				  $comment_count = get_comments_number($grid_box_posts->ID);

				   $post_title_value = get_the_title($grid_box_posts->ID);

				   $short_des = get_the_excerpt($grid_box_posts->ID);

                    $date_value  = get_the_time('j F, Y');

                    $html .= '<div class="c-single_news_list row clearfix home_blog">';

					$html .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12  wow bounceInLeft animated" data-wow-duration="1.5s">';

                    $html .= sprintf( '<img class="img-responsive" src="%s" alt=""/>', $src['0']) . "\n";

					 $html .= '</div>';

                       $html .= '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 c-news_list_content  wow fadeIn" data-wow-duration="2s">';

					 
                       $html .='<h2><a href="'.esc_url(get_the_permalink()).'">'.$post_title_value.'</a></h2>';

					 $html .= '<p>'.$short_des.'</p>'; 
					
                   $html .= '<ul class="c-blog-home">';
						
                $html .= '<li><a class="c-green_but" href="'.esc_url(get_the_permalink()).'">'.__('read more','vee-core').'</a></li>';
                      
                      $html .=  '<li><span class="fa fa-clock-o"></span>'.get_the_date().'</li>';
                    
                      $html .= '</ul>';
                     $html .= '</div>';
                   $html .= '</div>';
 
                 }
 
	     $html .= '</div>' . "\n";
		 $html .= '</div>' . "\n";
		 $html .= '</div>' . "\n";
		 
		 }else {
			 
			 
			 $html .='<div class="container c-section c-news_boxes">';
		 $html .='<div class="row">';
		 $html .= sprintf( '<h2 wow fadeInUp" data-wow-duration="0.5s"">%s</h2>', $title );
		 
		 $html .='<div class="clearfix c-news_listing  c-news_boxed">';

	     while( $grid_box_posts->have_posts() ) {

				  $grid_box_posts->the_post(); 

				  $src = wp_get_attachment_image_src( get_post_thumbnail_id($grid_box_posts->ID), 'capitalx-post-thumb-two'); 
				  $comment_count = get_comments_number($grid_box_posts->ID);

				   $post_title_value = get_the_title($grid_box_posts->ID);

				   $short_des = get_the_excerpt($grid_box_posts->ID);

                    $date_value  = get_the_time('j F, Y');

                    $html .= '<div class="c-single_news_list home_blog">';

					$html .= '<div class="wow bounceInLeft animated" data-wow-duration="1.5s">';

                    $html .= sprintf( '<img class="img-responsive" src="%s" alt=""/>', $src['0']) . "\n";
					 $html .= '<div class="c-post_date"><span>'.get_the_date().'</span></div>';

					 $html .= '</div>';
					 
					 $html .= ' <div class="c-news_list_content  wow fadeIn" data-wow-duration="2s">'; 
                    $html .= '<h2><a href="'.get_the_permalink().'">'.$post_title_value.'</a></h2>';
                    $html .= '<p>'.$short_des.'</p> ';
                   $html .= '<div class="c-read_more_but">';
                   $html .= '<a href="'.get_the_permalink().'" class="c-green_but">'.__('Read More','vee-core').'</a>';
                   $html .= '</div>'; 
                 $html .= ' </div>';
				 $html .= ' </div>';

                       
 
                 }
 
	     $html .= '</div>' . "\n";
		 $html .= '</div>' . "\n";
		 $html .= '</div>' . "\n";
		 
		 }
		 
          return $html;

	}

	

}

new VE_PB_Blog();