<?php 
/**
 * The template for displaying Archive pages
 */

get_header();?>
<!-- ******** INNER BANNER Start ******** -->
   <div id="c-inner_banner" class="c-inner_banner">
        <img class="img-responsive" src="<?php
        echo esc_url(get_template_directory_uri()."/assets/images/news_banner.jpg"); ?>" alt="">
    </div>
  <!-- ******** INNER BANNER END ******** -->
  <section id="c-news_page">
  
    <div class="container">
    
        <div class="row c-news_page">
        
           <header class="c-page_title">
                 <?php
                            the_archive_title( '<h1 class="c-page-title">', '</h1>' );
                            the_archive_description( '<div class="c-taxonomy-description">', '</div>' );
                 ?>
           </header> 
             <div class="c-two_col clearfix">   
                <div class="row">
                   <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
					   <?php  
					         while ( have_posts() ) : 
					         the_post(); 
					   ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class('c-news_block') ?>>
                             
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
                              <?php if(!empty($thumbnail_url)){?>
                            <a href="<?php echo esc_url(get_the_permalink())?>">
                            <img class="img-responsive" src="<?php echo esc_url($thumbnail_url[0]); ?>" alt=""></a>
                             <?php }?>
                              
                            <?php } ?>
                            <div class="c-news_block_detail">
                            <h2><a href="<?php echo esc_url(get_the_permalink())?>"><?php the_title();?></a></h2>
                                <?php if(is_sticky()){?> <span class="sticky_post"><?php esc_html_e('Sticky','capitalx')?></span><?php }?>
                                   <span><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo get_the_date( 'F j, Y');?></span>&nbsp; 
                              <span><i class="fa fa-user"></i>&nbsp;&nbsp;<span><?php echo get_the_author(); ?></span></span>
                            <?php the_excerpt(); ?>
                              <ul class="c-blog-home">
                                    <li><a href="<?php echo esc_url(get_the_permalink())?>" class="c-green_but"><?php esc_html_e('Read more','capitalx')?></a></li>
                                   <?php  if(has_category( )){
                                    foreach((get_the_category()) as $category){?>
                                    <li><a href="<?php echo esc_url(get_category_link($category->cat_ID))?>"><?php echo esc_html($category->cat_name) ?></a></li>
                                     <?php  }
                                   }?>
                        
                                 
                               
                              </ul>
                             </div>     
                         </div>
                      <?php endwhile;  ?>
                       <?php
                       capitalx_numeric_posts_nav(); ?>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 a-sidebar">
                          <?php if( is_active_sidebar( 'sidebar-1' ) ) :?>
                                 <?php dynamic_sidebar( 'sidebar-1' ); ?>	
                           <?php endif;?>
                   </div>
              </div>
           </div>
             
        </div>
        
    </div>
</section>
<?php
get_footer();