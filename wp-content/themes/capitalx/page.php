<?php


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
                    <?php
                    while ( have_posts() ) : the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class('col-lg-8 col-md-8 col-sm-8 col-xs-12') ?>>
                    <div class="c-single_news_head">
                    <h2><?php the_title();?></h2>
                    </div>
                                    
						<?php
                         if ( has_post_thumbnail() ) {
                            the_post_thumbnail();
                        }?>
                                    
                        <div class="c-single_news_content">
                        <?php the_content(); ?>
                        <?php wp_link_pages();?>
                        </div>
                        <?php endwhile;
                        ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 a-sidebar pull-right">
                        
                         <?php if( is_active_sidebar( 'sidebar-1' ) ) :?>
                                 <?php dynamic_sidebar( 'sidebar-1' ); ?>	
                             <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    while ( have_posts() ) : the_post(); ?>
    <?php
    if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }?>
    <?php endwhile;
    ?>
    </section>
<?php get_footer(); ?>