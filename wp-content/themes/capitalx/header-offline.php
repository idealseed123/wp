<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
   
<!-- META-DATA -->
<meta http-equiv="content-type" content="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php if (! ( function_exists( 'has_site_icon' ) && has_site_icon() )) {?>
 <?php if(capitalx_global_var('favicon','url') !=null) {?>
<link href="<?php  echo esc_url(capitalx_global_var('favicon','url')); ?>" rel="icon" />
<?php }?>
<?php }?> 

<?php wp_head();?>

</head>
<body <?php body_class(); ?>>
