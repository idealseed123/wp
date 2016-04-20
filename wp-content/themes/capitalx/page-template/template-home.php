<?php
/***
* Template Name: Home page
*/
get_header();?>

<?php
while(have_posts()): the_post();
		$content= get_the_content();
		echo do_shortcode($content);
	
endwhile;?>

   <section id="c-contacts" class="c-contacts c-section">
           <div class="container">
            <div class="row">
            <?php if(capitalx_global_var('home_contact_title') != null) {?>
              <h2 class="wow fadeInUp" data-wow-duration="0.5s"><?php echo sanitize_text_field(capitalx_global_var('home_contact_title'))?></h2>
              <?php }?>
      <div class="c-contact_area clearfix">
        
          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 c-contact_accordian">
            <?php if(capitalx_global_var('home_tab_two_title') != null) {?>
            <div class="c-single_accordian c-open">
              <div class="c-accordian_title">
                <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_title'))?></span>
              </div>
              <div class="c-accordian_detail c-list_accordian">
                 <?php if(capitalx_global_var('home_tab_two_list_one_title') != null){?>
                <div class="c-list_accor_single clearfix">
                    
                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_one_title'))?></span>
                   </div>
                 
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                     <span class="c-addr_icon">
                      <i class="fa fa-map-marker"></i>
                      <?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_one_content'))?> 
                    </span>
                   </div>
                </div> 
                  <?php }?>
                   <?php if(capitalx_global_var('home_tab_two_list_two_title') != null){?> 
                <div class="c-list_accor_single clearfix">
                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_two_title'))?></span>
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                     <a class="c-addr_icon" href="tel:<?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_two_content'))?>">
                      <i class="fa fa-phone"></i><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_two_content'))?>
                     </a> 
                      <span class="c-small_txt"><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_two_content_details'))?></span>
                   </div>
                </div> 
                <?php }?>
                  <?php if(capitalx_global_var('home_tab_two_list_three_title') !=null){?> 
                <div class="c-list_accor_single clearfix">
                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_three_title'))?></span>
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                    <a class="c-addr_icon" href="tel:<?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_three_content'))?>">
                      <i class="fa fa-phone"></i><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_three_content'))?>
                    </a> 
                    <span class="c-small_txt"><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_three_content_details'))?></span>
                   </div>
                </div> 
                <?php }?>
                  <?php if(capitalx_global_var('home_tab_two_list_four_title') !=null){?> 
                <div class="c-list_accor_single clearfix"> 
                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_two_list_four_title'))?></span>
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                     <a class="c-email_icon" href="mailto:<?php echo sanitize_email(capitalx_global_var('home_tab_two_list_four_content'))?>">
                      <i class="fa fa-envelope-o"></i><?php echo sanitize_email(capitalx_global_var('home_tab_two_list_four_content'))?>
                     </a>
                   </div> 
                </div> 
                <?php }?>
              </div>
            </div>
            <?php } ?>
            <?php if(capitalx_global_var('home_tab_three_title') !=null) {?>
            <div class="c-single_accordian">
              <div class="c-accordian_title">
                <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_title'))?></span>
              </div>
                
              <div class="c-accordian_detail c-list_accordian">
               <?php if(capitalx_global_var('home_tab_three_list_one_title') !=null){?>
                <div class="c-list_accor_single clearfix">
                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_one_title'))?></span>
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                     <a class="c-addr_icon" href="tel:<?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_one_content'))?>">
                      <i class="fa fa-phone"></i><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_one_content'))?>
                     </a> 
                      <span class="c-small_txt"><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_one_content_details'))?></span>
                   </div>
                </div> 
                  <?php }?>
                  <?php if(capitalx_global_var('home_tab_three_list_two_title') !=null){?>
                <div class="c-list_accor_single clearfix">
                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_two_title'))?></span>
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                     <a class="c-addr_icon" href="tel:<?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_two_content'))?>">
                      <i class="fa fa-phone"></i><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_two_content'))?>
                     </a> 
                      <span class="c-small_txt"><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_two_content_details'))?></span>
                   </div>
                </div> 
                   <?php }?>
                  <?php if(capitalx_global_var('home_tab_three_list_three_title') !=null ){?>
                <div class="c-list_accor_single clearfix">
                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_three_title'))?></span>
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                     <a class="c-addr_icon" href="tel:<?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_three_content'))?>">
                      <i class="fa fa-phone"></i><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_three_content'))?>
                     </a> 
                      <span class="c-small_txt"><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_three_content_details'))?></span>
                   </div>
                </div> 
                   <?php }?>
                  <?php if(capitalx_global_var('home_tab_three_list_four_title') !=null ){?>
                <div class="c-list_accor_single clearfix">

                   <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                     <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_four_title'))?></span>
                   </div>
                   <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                     <a class="c-addr_icon" href="tel:<?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_four_content'))?>">
                      <i class="fa fa-phone"></i><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_four_content'))?>
                     </a> 
                      <span class="c-small_txt"><?php echo sanitize_text_field(capitalx_global_var('home_tab_three_list_four_content_details'))?></span>
                   </div>
                </div> 
                   <?php }?>
                 
              </div>
            </div>
            <?php } ?>
            <?php if(capitalx_global_var('home_tab_four_title') !=null ) {?>
            <div class="c-single_accordian">
              <div class="c-accordian_title">
                <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_four_title'))?></span>
              </div>
              <div class="c-accordian_detail">
                <div class="c-accordian_detail c-text_accordian c-social_accordian">
                  <span><?php echo sanitize_text_field(capitalx_global_var('home_tab_four_list_title'))?></span>
                  <ul>
                    
                     <?php if(capitalx_global_var('home_tab_four_fb_url') !=null){?>
                     <li><a href="<?php echo esc_url(capitalx_global_var('home_tab_four_fb_url'))?>"><i class="fa fa-facebook"></i></a></li>
					<?php }?>
                     <?php if(capitalx_global_var('home_tab_four_twt_url') !=null){?>
                      <li><a href="<?php echo esc_url(capitalx_global_var('home_tab_four_twt_url'))?>"><i class="fa fa-twitter"></i></a></li>
					<?php }?>
                    <?php if(capitalx_global_var('home_tab_four_google_url') !=null){?>
                      <li><a href="<?php echo esc_url(capitalx_global_var('home_tab_four_google_url'))?>"><i class="fa fa-google-plus"></i></a></li>
					<?php }?>
                    <?php if(capitalx_global_var('home_tab_four_linkdin_url') !=null ){?>
                     <li><a href="<?php echo esc_url(capitalx_global_var('home_tab_four_linkdin_url'))?>"><i class="fa fa-linkedin"></i></a></li>
					<?php }?>
                     <?php if(capitalx_global_var('home_tab_four_insta_url') !=null){?>
                      <li><a href="<?php echo esc_url(capitalx_global_var('home_tab_four_insta_url'))?>"><i class="fa fa-instagram"></i></a></li>
					<?php }?>
                   
                   
                   </ul> 
                </div>  
              </div>
            </div>
            <?php } ?>
        
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 c-ask_question">
         <?php echo do_shortcode(capitalx_global_var('contact_form'));?>
          </div>
          
        </div>
      </div>
    </div>
   </section>
<?php get_footer()?>