<?php
class VE_PB_Latest_Blog {
	private $gridblog_class;
	private $icon_class;
	public static $args;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 've_pb_attr_latest_news_slide', array( $this, 'attr' ) );
        add_shortcode( 'latest_news_slide', array( $this, 'render' ) );
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
				'order'			   			=> 'ASC',
				'posts_per_page'	  		=> '-1',
				'taxonomy'					=> 'category'
			), $args
		);
		extract( $defaults );
		if( $defaults['number_posts'] ) {
	     		$defaults['posts_per_page'] = $defaults['number_posts'];
		}
		$sec_id = $defaults['id'];
		$sec_class = $defaults['class'];
		$title = $defaults['title'];
        
		$cat_ids ='';
		
       $defaults['cat'] = substr( $cat_ids, 0, -1 );
		self::$args = $defaults;
     $html ="";
     if($sec_id != '' && $sec_class !=''){
			$html .='<div class="container latest_nw'.$sec_class.'" id="'.$sec_id.'">';
			}elseif($sec_id != ''){
			$html .='<div class="container latest_nw" id="'.$sec_id.'">';
			}
			elseif($sec_class != ''){
			$html .='<div class="container latest_nw '.$sec_class.'">';
			}
			else{
			$html .='<div class="container latest_nw">';
			}
    $args = array('post_type' => 'post','posts_per_page' => '-1',);
       $grid_box_posts = new WP_Query( $args );
        
		 $html .='<div class="row">';
		 $html .= sprintf( '<header class="c-page_title"><h2>%s</h2></header>', $title );
		 
		 $html .='<div class="c-news_slider" id="c-news_slider">';
	     while( $grid_box_posts->have_posts() ) {
				  $grid_box_posts->the_post(); 
				  $src = wp_get_attachment_image_src( get_post_thumbnail_id($grid_box_posts->ID), 'capitalx-post-thumb'); 
				  $comment_count = get_comments_number($grid_box_posts->ID);
				   $post_title_value = get_the_title($grid_box_posts->ID);
				   $short_des = get_the_excerpt($grid_box_posts->ID);
                    $date_value  = get_the_time('j F, Y');
                    $html .= '<div class="c-single_news_list row clearfix home_blog">';
					$html .= '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
					 if($src){
                     $html .= ' <img src="'.esc_url($src[0]).'" class="img-responsive" alt="">';
                       }else{
                    $html .= '<img src="'.get_template_directory_uri().'/assets/images/no-image.png" class="img-responsive" alt="">';
                     }
                   // $html .= sprintf( '<img class="img-responsive" src="%s" alt=""/>', $src['0']) . "\n";
					
					 $html .= '</div>';
                       $html .= '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 c-news_list_content">';
					 
                       $html .='<h2><a href="'.esc_url(get_the_permalink()).'">'.$post_title_value.'</a></h2>';
					 $html .= '<p>'.$short_des.'</p>'; 
                   //$html .= '<ul class="c-blog-nav">';
		
				   $html .= '<ul class="c-blog-home">';
				   $html .= '<li><a class="c-green_but" href="'.esc_url(get_the_permalink()).'">'.__('read more','vee-core').'</a></li>';
					//$html .= '<li><a class="a-blog_read_more" href="'.esc_url(get_the_permalink()).'">'.__('read more','vee-core').'</a></li>';
//                       if(has_category( )){
//                        foreach((get_the_category()) as $category){
//                        $html.='<li><a href="'.esc_url(get_category_link($category->cat_ID)).'">'.$category->cat_name.'</a></li>';
//                          }
//                       }
                          $html .=  '<li><span class="fa fa-clock-o"></span>'.get_the_date().'</li>';
		          //   $html .= '<li><a class="a-blog_read_more" href="'.esc_url(get_the_permalink()).'">'.__('Comments&nbsp;(','vee-core').get_comments_number($grid_box_posts->ID).')'.'</a></li>';
                      $html .= '</ul>';
                     $html .= '</div>';
					 
                   $html .= '</div>';
 
                 }
				 
				 
		$html .= '</div>';		 
		$html .= '<div class="c-review_nav">';
        $html .= '<div class="c-arrow_left" id="c-review_left">';
        $html .= '<span>arrow left</span>';
        $html .= '</div>';
        $html .= '<div class="c-arrow_right" id="c-review_right">';
        $html .= '<span>arrow right</span>';
        $html .= '</div>';
        $html .= '</div>';		 
	     
		 $html .= '</div>' ;
		 $html .= '</div>';
		
          return $html;
	}
	
}
new VE_PB_Latest_Blog();