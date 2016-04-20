<?php
/***
* Template Name: Offline page
*/
get_header(offline);

?>
 
 <section id="c-offline">
   <div class="c-offline">
      <div class="c-offline_box">
        <h1><?php esc_html_e('Site is offline','capitalx')?></h1>
        <div class="c-offline_info">
                       <?php if(capitalx_global_var('logo_image','url')){?>
                        <a href="<?php echo esc_url( home_url('/') );?>" class="a_logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                        <img src="<?php echo esc_url(capitalx_global_var('logo_image','url'));?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
                        <?php }else {?>
                        <h1><?php bloginfo( 'name' ); ?></h1>
                        <?php }?>
          <ul>
            <li><span><?php esc_html_e('Free hotline','capitalx')?>  </span>
             <?php if(capitalx_global_var('header_phone') != null):?>
                        <a href="tel:<?php echo sanitize_text_field(capitalx_global_var('header_phone'))?>" class="c-header_call">
                        <i class="fa fa-phone"></i> <?php echo sanitize_text_field(capitalx_global_var('header_phone'))?></a>
                        <?php endif;?>
            </li>
            <li><span><?php esc_html_e('E-mail','capitalx')?></span>
              <?php if(capitalx_global_var('header_email') != null):?>
                        <a href="mailto:<?php echo sanitize_email(capitalx_global_var('header_email'))?>" class="c-header_mail">
                        <i class="fa fa-envelope-o"></i> &nbsp;<?php echo sanitize_email(capitalx_global_var('header_email'))?></a>
                        <?php endif;?></li>
          </ul>
        </div>
      </div>
   </div>
 </section>
<?php get_footer(offline);?>