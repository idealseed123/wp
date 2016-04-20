<?php
/***
Template Name: Full Width Page
**/

get_header();
$capitalx_header_image = get_post_meta($post->ID, "_cmb_header_image", true);
?>
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
	<section id="c-inner_container" class="c-inner_container">
        <div class="container">
            
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            
                <div class="row">
                                    
                    <div id="post-<?php the_ID();?>" <?php post_class('a-single_full clearfix')?> >
                     <?php if ( have_posts() ) :
                    // Start the Loop.
                    while ( have_posts() ) : the_post(); ?>
                    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                    <div class="entry-thumbnail">
                    <?php the_post_thumbnail(); ?>
                    </div>
                    <?php endif; ?>
                            
                    <?php the_content();?>
                    <?php wp_link_pages(); ?>
                    <?php endwhile;
                    else: ?>
                    <p><?php esc_html_e('Sorry, no posts matched your criteria.', 'capitalx'); ?></p>
                    <?php
                    endif; ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
   </section>
<?php get_footer();?>