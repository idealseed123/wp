<?php
/**
* The template for displaying 404 pages (Not Found)
*
* @package WordPress
* @subpackage Capitalx
*
*/
get_header(offline);

?>
	 <section id="c-error">
   <div class="c-error">
      <div class="c-error_box">
        <h1><?php esc_html_e('Error','capitalx')?></h1>
        <div class="clearfix">
          <div class="pull-left">
            <h2>404</h2>
            <span><?php esc_html_e('page not found','capitalx')?></span>
          </div>
          <div class="pull-right">
            	<?php if(capitalx_global_var('logo_image','url')){?>
                        <a href="<?php echo esc_url( home_url('/') );?>" class="a_logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        <img src="<?php echo esc_url(capitalx_global_var('logo_image','url'));?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                        <?php }else {?>
                        <h1><?php bloginfo( 'name' ); ?></h1>
                        <?php }?>
          </div>
        </div> 
      </div>
   </div>
 </section>
<?php get_footer(offline); ?>