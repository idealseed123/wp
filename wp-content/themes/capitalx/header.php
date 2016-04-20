<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
   

<meta http-equiv="content-type" content="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php if (! ( function_exists( 'has_site_icon' ) && has_site_icon() )) {?>
 <?php if(capitalx_global_var('favicon','url') !=null) {?>
<link href="<?php  echo esc_url(capitalx_global_var('favicon','url')); ?>" rel="icon" />
<?php } }?>


<?php wp_head();?>

</head>
<body <?php body_class(); ?>>

  <div class="wrapper-<?php echo sanitize_text_field(capitalx_global_var('layout_swtich'))?>">
  
   <header id="c-header" class="c-header <?php if(sanitize_text_field(capitalx_global_var('header_sticky')) == '1'):?> c-sticky <?php endif;?>  wow fadeIn" data-wow-duration="1.5s">
         <?php 
   	     $Strip_class = "top_fix";
		 if(sanitize_text_field(capitalx_global_var('header_top')) !='1'):
		 $Strip_class = "";
		 ?>
        <div class="c-strip_header">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 c-header_info">
                        <div class="row">
                        <?php if(capitalx_global_var('header_phone')):?>
                        <a href="tel:<?php echo sanitize_text_field(capitalx_global_var('header_phone'))?>" class="c-header_call">
                        <i class="fa fa-phone"></i> <?php echo sanitize_text_field(capitalx_global_var('header_phone'))?></a>
                        <?php endif;?>
                        <?php if(capitalx_global_var('header_email') != null):?>
                        <a href="mailto:<?php echo sanitize_email(capitalx_global_var('header_email'))?>" class="c-header_mail">
                        <i class="fa fa-envelope-o"></i> <?php echo sanitize_email(capitalx_global_var('header_email'))?></a>
                        <?php endif;?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 c-header_login">
                        <div class="row">
                     <?php if(capitalx_global_var('header_fb_url') != null ){?>
                     <a href="<?php echo esc_url(capitalx_global_var('header_fb_url'))?>" target="_blank"><i class="fa fa-facebook"></i></a>
					<?php }?>
                    <?php if(capitalx_global_var('header_twt_url') != null){?>
                     <a href="<?php echo esc_url(capitalx_global_var('header_twt_url'))?>" target="_blank"><i class="fa fa-twitter"></i></a>
					 <?php }?>
                     <?php if(capitalx_global_var('header_linkdin_url') != null){?>
                     <a href="<?php echo esc_url(capitalx_global_var('header_linkdin_url'))?>" target="_blank"><i class="fa fa-linkedin"></i></a>
					 <?php }?>
  
                     </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="c-header_navbar <?php echo sanitize_text_field($Strip_class);?>">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 c-header_logo">
                    <div class="row">
                        <a href="<?php echo esc_url( home_url('/') );?>" class="a_logo" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
						<?php if(capitalx_global_var('logo_image','url')){?>
                        
                        <img src="<?php echo esc_url(capitalx_global_var('logo_image','url'));?>" alt="<?php bloginfo( 'name' ); ?>"/>
                        <?php }else {?>
                        <h1><?php bloginfo( 'name' ); ?></h1>
                        <?php }?>
                        </a>
                    </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 c-header_nav pull-right">
                    <div class="row">
                        <nav class="c-main_nav style">
                     <?php wp_nav_menu( array('menu_class' => 'c-main_nav-menu','container' => '','theme_location' => 'primary', 'depth' => 3) ); ?>
                        </nav>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</header>

