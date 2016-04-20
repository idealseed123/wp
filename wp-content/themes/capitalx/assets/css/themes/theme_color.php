<?php 

session_start();

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );
require_once( $parse_uri[0] . 'wp-config.php' );

header("Content-type: text/css; charset=utf-8");

if(isset($_SESSION['theme_color'])){

	$theme_color = $_SESSION['theme_color'];
	$theme_color = sanitize_text_field($theme_color);
	
}else {

$theme_color ='#dd2342';
$theme_color = sanitize_text_field($theme_color);



}

?>

<?php if(capitalx_global_var('layout_swtich') == 'boxed' && capitalx_global_var('boxed_background','url') != null ){?>
.boxed_bg{background-image:url(<?php echo capitalx_global_var('boxed_background','url')?>)}
<?php }?>
.c-section_header h2:after{border-color: transparent transparent transparent <?php echo $theme_color; ?>; }
a:hover {
  color: <?php echo $theme_color; ?>; }

.c-strip_header .c-header_info a:hover {
  color: <?php echo $theme_color; ?>; }
.c-changed_foot .c-footer li a:hover {
  color: <?php echo $theme_color; ?>; }
 .c-single_icon > i {color: <?php echo $theme_color; ?>; }
.c-color_box {
  background: ; }
.c-post_date::after {background: <?php echo $theme_color; ?>;}
.c-services_new .c-service_info::after {background: <?php echo $theme_color; ?>;}
.c-news_thumbs > div:last-child a:hover {
  background: <?php echo $theme_color; ?>; }

.c-news_thumbs > div:nth-child(1) a:hover {
  color: <?php echo $theme_color; ?>; }

.c-section_header .c-blank_strip {
  background: <?php echo $theme_color; ?>; }

.c-section_header h2 {
  background: <?php echo $theme_color; ?>; }

.c-service_info a:hover {
  color: <?php echo $theme_color; ?>; }

.c-price_range {
  color: <?php echo $theme_color; ?>; }

.c-open .c-accordian_title span {
  color: <?php echo $theme_color; ?>; }

.c-accordian_title span::after {
  background: <?php echo $theme_color; ?>; }

.c-contact_accordian .c-list_accor_single:hover a, .c-contact_accordian .c-list_accor_single:hover span {
  color: <?php echo $theme_color; ?>; }

.c-footer a:hover {
  color: <?php echo $theme_color; ?>; }

.c-training_left span.c-color_price {
  color: <?php echo $theme_color; ?>; }

.c-main_nav.style ul li.c-active_nav a::before,.c-main_nav.style ul li.current_page_item a::before, .c-main_nav.style ul li:hover a::before {
  background: <?php echo $theme_color; ?>; }

.c-main_nav.style ul li.c-active_nav > a,.c-main_nav.style ul li.current_page_item >a, nav.c-main_nav.style ul li a:hover {
  color: <?php echo $theme_color; ?>; }

.c-banner_breadcrum a:hover {
  color: <?php echo $theme_color; ?>; }

.c-comment .c-comment_listing .c-comment_details {
  border-top-color: <?php echo $theme_color; ?>; }

input:focus, textarea:focus {
  border-color: <?php echo $theme_color; ?>; }

.c-news_list_content ul li a:hover {
  color: <?php echo $theme_color; ?>; }

.c-single_price .c-price_button a:hover,
.c-newser_thumbs > div:last-child a:hover,
.c-ask_question button:hover,
.c-green_but:hover,#c-submit:hover {
  background: <?php echo $theme_color; ?>;
  color: #FFFFFF; }

.fa.fc-user:hover {
  color: <?php echo $theme_color; ?>; }

.c-active_color {
  color: <?php echo $theme_color; ?>; }

.c-newser_thumbs > div:nth-child(1) a:hover {
  color: <?php echo $theme_color; ?>; }

.c-our_expert .c-expert_detail ul li:hover, .c-single_news_foot > ul > li:first-child li:hover {
  background: <?php echo $theme_color; ?>;
  color: #FFFFFF; }

.c-news_list_content h2 a:hover {
  color: <?php echo $theme_color; ?>; }

.c-strip_header a.c-header_sign:hover, .c-strip_header .c-header_login a:hover {
  background-color: <?php echo $theme_color; ?>;
  border-color: <?php echo $theme_color; ?>; }

.c-contact_accordian .c-social_accordian li:hover {
  background: <?php echo $theme_color; ?>; }
input.color {
    background: <?php echo $theme_color; ?>;
}
.c-color_box {
  background: <?php echo $theme_color; ?> none repeat scroll 0 0;
}
.c-trans_box_txt p span{ color: <?php echo $theme_color; ?>;}

.c-green_but,.c-newser_thumbs > div:last-child a,#c-submit {background:<?php echo $theme_color; ?>;}