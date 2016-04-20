<?php 
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage capitalx
 * 
 */

get_header();?>

  <div id="c-inner_banner" class="c-inner_banner">
        
        <img class="img-responsive" src="<?php
        echo esc_url(get_template_directory_uri()."/assets/images/news_banner.jpg"); ?>" alt="">
          
  </div>
  
 <section id="c-news_page">
 
    <div class="container">
    
     <div class="row c-news_page">
       <header class="c-page_title">
         <h1 class="page-title">
		   <?php printf( esc_html__( 'Search Results for: %s', 'capitalx' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
         </h1>
        </header> 
        <div class="c-two_col clearfix"> 
          
            <div class="row">
               <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <?php if ( have_posts() ) : ?>
                 <?php
					// Start the loop.
					 while ( have_posts() ) :
					 the_post();
				 ?>
    
                <div id="post-<?php the_ID(); ?>" <?php post_class('c-news_block') ?>>
                      <?php if ( 'post' === get_post_type() ) {?>  
                        <?php 
                        if ( has_post_thumbnail() ) {
                        the_post_thumbnail();
                        }?>
                        <div class="c-news_block_detail">
                        <h2><?php the_title();?></h2>
                            <span><?php echo get_the_date( 'F j Y');?></span> 
                            <span><?php esc_html_e('BY :','capitalx')?> <span><?php echo get_the_author(); ?></span></span>
                        <?php the_excerpt(); ?>
                          <ul class="c-blog-home">
                                <li><a href="<?php echo esc_url(get_the_permalink())?>" class="c-green_but">
								<?php esc_html_e('Read more','capitalx')?></a>
                                </li>
                               <?php  if(has_category( )){
                                foreach((get_the_category()) as $category){?>
                                <li><a href="<?php echo esc_url(get_category_link($category->cat_ID))?>">
								    <?php echo esc_html($category->cat_name) ?></a>
                                </li>
                                 <?php  }
                               }?>
                              
                             
                           
                          </ul>
                         </div>  
                     <?php }else{?>
                         <div class="c-news_block_detail">
                            <h2><?php the_title();?></h2>
                            <?php the_excerpt(); ?>
                       
                         </div>  
                     <?php }?> 
                           
                     </div>
    
                <?php // End the loop.
                endwhile;
               //page navigation
              capitalx_numeric_posts_nav(); 
    
            // If no content, include the "No posts found" template.
            else :?>
                <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'capitalx'); ?></p>
    
            <?php 	endif;
            ?>
            
           
           
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
