<?php
/****
* /**
* The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
* @subpackage Capitalx
*
*/	?>


 <footer id="c-footer" class="c-footer <?php if(capitalx_global_var('footer_swtich') =="st_two") {?>c-changed_foot<?php }?>">
    <div class="container">
      <div class="row">
        <div class="c-footer_navigation clearfix">
         <?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
         <div class="c-footer_block">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </div>
        <?php } ?>
        <?php if ( is_active_sidebar( 'sidebar-3' ) ) { ?>
         <div class="c-footer_block">
            <?php dynamic_sidebar( 'sidebar-3' ); ?>
        </div>
        <?php } ?>
        <?php if ( is_active_sidebar( 'sidebar-4' ) ) { ?>
         <div class="c-footer_block">
            <?php dynamic_sidebar( 'sidebar-4' ); ?>
        </div>
        <?php } ?>
        <?php if ( is_active_sidebar( 'sidebar-5' ) ) { ?>
         <div class="c-footer_block">
            <?php dynamic_sidebar( 'sidebar-5' ); ?>
        </div>
        <?php } ?>
          
        </div>
        <div class="c-copyright">
          <p><?php echo sanitize_text_field(capitalx_global_var('copyrighttext')); ?></p>
        </div>
      </div>
    </div>
  </footer>
<?php if(sanitize_text_field(capitalx_global_var('color_custmoizer')) == '1'):
	$theme_color = capitalx_global_var('theme_color');
	$theme_color = str_replace("#","",$theme_color);
	?>
    <section id="c-customizer" class="c-customizer">
        <div class="c-selector">
              <h2><?php esc_html_e('Color Changer','capitalx')?></h2>
              <div class="c-color_section c-color_block"> 
                    <ul id="c-color_selector" class="c-color_selector">
                          <li class="c-color_1" data-color="dd2342"></li>
                          <li class="c-color_2" data-color="8cc739"></li>
                          <li class="c-color_3" data-color="ba6222"></li>
                          <li class="c-color_4" data-color="cc0000"></li>
                          <li class="c-color_5" data-color="076AFC"></li>
                          <li class="c-color_6" data-color="7aba7a"></li>
                          <li class="c-color_7" data-color="00aff0"></li>
                          <li class="c-color_8" data-color="ff9900"></li>
                       </ul>
                          <label><?php esc_html_e('Select Your Own Color','capitalx')?></label>
              			  <input type="text" value="<?php echo sanitize_text_field($theme_color);?>" class="color">
                          <label></label><button type="submit" class="e-btn e-btn_xl colorchange e-btn_block e-btn_dropIcon i-logo"><span><?php esc_html_e('Submit','capitalx')?></span></button>
                    
              </div>  
        </div>
         <i class="fa fa-cog" id="c-selector_icon"></i>
      </section>   
    <?php endif;  ?>
    
  </div>
<!--  --Wrapper div close-->
<?php wp_footer();?>
   
 </body>
</html> 	
 
   