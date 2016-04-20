<?php
/***
* Template Name: About page
*/
get_header();
$header_image = get_post_meta($post->ID, "_cmb_header_image", true);
?>
<div id="c-inner_banner" class="c-inner_banner">
        <?php if(!empty($header_image)){?>
        <img
        class="img-responsive" src="<?php echo esc_url($header_image); ?>" alt="">
        <?php }else{?>
        <img class="img-responsive" src="<?php
        echo esc_url(get_template_directory_uri()."/assets/images/news_banner.jpg"); ?>" alt="">
        <?php }?>
        <?php capitalx_breadcrumb();?>
        </div>

<?php
while(have_posts()): the_post();
		$content= get_the_content();
		echo do_shortcode($content);
	
endwhile;?>

   
   
<?php get_footer();?>