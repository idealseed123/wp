<?php
/**
* The template for displaying indivisual blog post
**/

get_header();
$capitalx_header_image = get_post_meta($post->ID, "_cmb_header_image", true);
?>

<!-- ******** INNER BANNER START ******** -->
<div id="c-inner_banner" class="c-inner_banner">
        <?php if(!empty($capitalx_header_image)){?>
        <img
        class="img-responsive" src="<?php echo esc_url($capitalx_header_image); ?>" alt="">
        <?php }else{?>
        <img class="img-responsive" src="<?php
        echo esc_url(get_template_directory_uri()."/assets/images/news_banner.jpg"); ?>" alt="">
        <?php }?>
        <?php capitalx_breadcrumb();?>
</div>
<!-- ******** INNER BANNER END ******** -->
<section id="c-news_page" class="c-single_news">
    <div class="container">
           <div class="row c-news_page"> 
           <div class="c-two_col clearfix">
              <div class="row">
				 <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>      
                <div id="post-<?php the_ID(); ?>" <?php post_class('col-lg-8 col-md-8 col-sm-8 col-xs-12') ?>>
                     <div class="c-single_news_head">
                         <h2><?php the_title();?></h2>
                    <?php if(is_sticky()){?> <span class="sticky_post"><?php esc_html_e('Sticky','capitalx')?></span><?php }?>
                    <span><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo get_the_date( 'F j, Y');?></span>&nbsp; 
                     <?php if(has_category( )){ ?>
                    <span><i class="fa fa-link"></i>&nbsp;&nbsp;<?php the_category(','); ?></span>&nbsp;
                     <?php } ?>
                    <span><i class="fa fa-user"></i>&nbsp;&nbsp;<span><?php echo get_the_author( ); ?></span></span>
                       </div>
          
				<?php if(has_post_format('image')){ ?>
                <?php $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id()); ?>
                <img class="img-responsive" src="<?php
                echo esc_url($thumbnail_url); ?>" alt="">
                <?php } else if(has_post_format('audio')){ ?>
                <?php echo esc_url(wp_oembed_get(get_post_meta(get_the_id(), "_cmb_embed_media", true))); ?>
                <?php } else if(has_post_format('video')){ ?>
                <?php echo esc_url(wp_oembed_get(get_post_meta(get_the_id(), "_cmb_embed_media", true))); ?>
                <?php } else if(has_post_format('gallery')){
                $gallery = get_post_gallery( get_the_id(), false );
                if(isset($gallery['ids'])){
                $gallery_ids = $gallery['ids'];
                $img_ids = explode(",",$gallery_ids);
                $i=1;
                ?>
                <ul class="post_slider">
                <?php foreach( $img_ids as $img_id ){
                $image_src = wp_get_attachment_image_src($img_id,'');
                ?>
                <li>
                <img class="img-responsive" src="<?php echo esc_url($image_src[0]); ?>" alt="" >
                </li>
                <?php
                $i++;
                }?>
                </ul>
                <?php
                }
                } else{ ?>
                <?php $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'capitalx-post-single'); ?>
                <img class="img-responsive" src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="">
                <?php } ?>
          
            
                <div class="c-single_news_content">
                <?php the_content(); ?>
                </div>
            
                <div class="c-single_news_foot">
                <?php
                 $shortURL = get_permalink();
                $shortTitle = str_replace( ' ', '%20', get_the_title());
                                            
                // Construct sharing URL without using any script
                 $twitterURL = '//twitter.com/intent/tweet?text='.$shortTitle.'&amp;url='.$shortURL.'&amp;via=Crunchify';
                  $facebookURL = '//www.facebook.com/sharer/sharer.php?u='.$shortURL;
                  $googleURL = '//plus.google.com/share?url='.$shortURL;
                                                
                ?>
               
                <ul class="clearfix">
                <li>
                  <span><?php _e('share:','capitalx')?></span>
                  <ul>
                    <li><a href="<?php echo esc_url($facebookURL)?>" class="fa fa-facebook"></a></li>
                    <li><a href="<?php echo esc_url($twitterURL)?>" class="fa fa-twitter"></a></li>
                    <li><a href="<?php echo esc_url($googleURL)?>" class="fa fa-google-plus"></a></li>
                  </ul>
                  <?php if(has_tag()){ ?>
                  <?php the_tags( 'Tags : ', ', ', '<br />' ); ?> 
                  <?php }?>
                  <li><?php esc_html_e('COMMENTS&nbsp;','capitalx'); echo  '('.get_comments_number($post->ID).')';?>
				  </li>
                 </ul>  
              
                
                </div>
                      <!-- BLOG COMMENT START -->
         
       <!-- BLOG COMMENT END --> 
    
			   <?php endwhile; endif;  ?>
                
            </div>
                                
            
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 a-sidebar pull-right">
                         
                         <?php if( is_active_sidebar( 'sidebar-1' ) ) :?>
                                 <?php dynamic_sidebar( 'sidebar-1' ); ?>	
                             <?php endif;?>

                </div>
                
            
            </div>
            </div>
             <section id="c-news_slide">
          <div class="container latest_nw">
            <div class="row">
              <header class="c-page_title">
                 <h2><?php esc_html_e('recent news','capitalx')?></h2>
              </header>
              <div class="c-news_slider" id="c-news_slider">
                <?php   
							$args_post = array('post_type' => 'post','posts_per_page' => '-1',);
							$recentposts = new WP_Query($args_post);
                            while( $recentposts->have_posts() ) {
								$recentposts->the_post(); 
                            $src = wp_get_attachment_image_src( get_post_thumbnail_id(),'capitalx-post-thumb'); 
                            ?>
                            
                            
                <div class="c-single_news_list row clearfix home_blog1"> 
                    <div class="col-lg-4 col-md-4 col-md-4 col-xs-12">
                       <?php if($src){?>
                      <img src="<?php echo esc_url($src[0]);?>" class="img-responsive" alt="">
                      <?php }else{?>
                      <img src="<?php echo esc_url(get_template_directory_uri()."/assets/images/no-image.png");?>" class="img-responsive" alt="">
                      <?php }?>
                    </div>
                    <div class="col-lg-8 col-md-8 col-md-8 col-xs-12 c-news_list_content "> 
                      <h2><a href="<?php echo esc_url(get_the_permalink())?>"><?php echo get_the_title();?></a></h2>
                      <p><?php echo get_the_excerpt();?></p>
                      <ul class="c-blog-home">
                        <li><a href="<?php echo esc_url(get_the_permalink())?>" class="c-green_but"><?php esc_html_e('Read more','capitalx')?></a></li>
                       <li><span class="fa fa-clock-o"></span><?php echo get_the_date()?></li>
                   
                      </ul>
                    </div>
                </div>
                
               <?php } ?> 
              </div>
              <div class="c-review_nav">
                <div class="c-arrow_left" id="c-review_left">
                   <span><?php esc_html_e('arrow right','capitalx')?></span>
                </div>
                <div class="c-arrow_right" id="c-review_right">
                    <span><?php esc_html_e('arrow right','capitalx')?></span>
                </div>
              </div>
            </div>
          </div>
        </section> 
      </div>
    </div>
  </section> 
        
          </div> 
    </div>
    <?php  if ( have_posts() ) : while ( have_posts() ) : the_post(); 

		  if ( comments_open() || get_comments_number() ) {

				comments_template();

			}

    endwhile; endif;  ?>   
  
</section>
<?php get_footer(); ?>