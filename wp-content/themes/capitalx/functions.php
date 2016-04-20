<?php
/**
 * capitalx functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 */
// Enable featured image
add_theme_support( 'post-thumbnails');
// $content_width
if ( ! isset( $content_width ) )  {
    $content_width = 770; 
}
// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// Load theme languages
load_theme_textdomain( 'capitalx', get_template_directory().'/languages' );
require_once get_template_directory() . '/includes/redux/sample-config.php';

// add extra feils in autor profile
require_once get_template_directory() . '/includes/get-authos-fields.php';
//custom post filed
require_once get_template_directory() . '/includes/custom-metafield/metabox-functions.php';

// Add new image sizes
add_action( 'after_setup_theme', 'capitalx_theme_setup' );
function capitalx_theme_setup() { 
add_image_size( 'capitalx-service-thumb', 360, 255, true );
add_image_size( 'capitalx-service-single',815, 402, true );
add_image_size( 'capitalx-post-thumb', 360, 300, true );
add_image_size( 'capitalx-post-single', 750, 349, true );
add_image_size( 'capitalx-review-thumb',136, 162, true );
add_image_size( 'capitalx-post-thumb-two',555, 319, true );
/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );


}
function capitalx_global_var($keyOne = null, $keyTwo = null)
{
	global $theme_option;
	if($keyTwo != null){
		if(isset($theme_option[$keyOne][$keyTwo]))
		return $theme_option[$keyOne][$keyTwo];
	}else{
		if(isset($theme_option[$keyOne]))
		return $theme_option[$keyOne];
	}
	
}


// Register Custom Menu Function
if (function_exists('register_nav_menus')) {
        register_nav_menus( array(
            'primary' => esc_html__( 'Capitalx Main Menu','capitalx' ),
         
        ) );
}
//add_sidebar
add_action( 'widgets_init', 'capitalx_slug_widgets_init' );
function capitalx_slug_widgets_init() {
    register_sidebar( array(
        'name' => esc_html__( 'Main Sidebar', 'capitalx' ), 
        'id' => 'sidebar-1',
        'description' => esc_html__( 'Widgets in this area will be shown on all posts and pages', 'capitalx' ),
        'before_widget' => '<div id="%1$s" class="c-side_bar_single widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
          ) 
  );
   register_sidebar( array(
        'name' => esc_html__( 'Footer Column One', 'capitalx' ), 
        'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class=" widget %2$s ">',
        'after_widget'  => '</div>',
       'before_title'  => '<h2>',
        'after_title'   => '</h2>',
          ) 
  );
   register_sidebar( array(
        'name' => esc_html__( 'Footer Column Two', 'capitalx' ), 
        'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class=" widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
          ) 
  );
   register_sidebar( array(
        'name' => esc_html__( 'Footer Column Three', 'capitalx' ), 
        'id' => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class=" widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
          ) 
  );
   register_sidebar( array(
        'name' => esc_html__( 'Footer Column Four', 'capitalx' ), 
        'id' => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class=" widget %2$s ">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>',
          ) 
  );
		  
}
// Add html5 suppost for search form and comments list
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
// TGM class 2.5.0 - neccessary plugins
include get_template_directory().'/includes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'capitalx_theme_register_required_plugins' );
function capitalx_theme_register_required_plugins() {
    $plugins = array(
        array(
            'name'                     => esc_html__( 'Redux Framework', 'capitalx' ),
            'slug'                     => esc_html__( 'redux-framework', 'capitalx' ),
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__( 'Contact Form 7', 'capitalx' ),
            'slug'                     => esc_html__( 'contact-form-7', 'capitalx' ),
            'required'                 => true,
        ),
        array(
            'name'                     => esc_html__( 'Capitalx Short Code builder', 'capitalx' ),
            'slug'                     => esc_html__( 'capitalx-shortcode-builder', 'capitalx' ),
            'required'                 => true,
			 'source'          => get_template_directory() . '/includes/plugins/capitalx-shortcode-builder.zip', // The plugin source
			//  'version'         => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
          'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
          'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
          'external_url'      => '', // If set, overrides default API URL and points to an external URL
        ),
		 array(
            'name'                     => esc_html__( 'Revolution Slider', 'capitalx' ),
            'slug'                     => esc_html__( 'revslider', 'capitalx' ),
            'required'                 => true,
			 'source'          => get_template_directory() . '/includes/plugins/revslider.zip', // The plugin source
			//  'version'         => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
          'force_activation'    => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
          'force_deactivation'  => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
          'external_url'      => '', // If set, overrides default API URL and points to an external URL
        ),
        
    );
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'default_path' => '',                      // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.
        'strings'      => array(
            'page_title'                      => esc_html__( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => esc_html__( 'Install Plugins', 'tgmpa' ),
            'installing'                      => esc_html__( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','tgmpa' ), // %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' , 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'tgmpa' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' , 'tgmpa'), // %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' , 'tgmpa'), // %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'tgmpa' ), // %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'tgmpa' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'tgmpa' ),
            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
    );
    tgmpa( $plugins, $config );
}

//load googlefonts
function capitalx_fonts_url() {
   
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';
 
    /* Translators: If there are characters in your language that are not
    * supported by Lora, translate this to 'off'. Do not translate
    * into your own language.
    */
    $Lato = _x( 'on', 'Lato font: on or off', 'capitalx' );
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
 
	$Roboto = _x( 'on', 'Roboto font: on or off', 'capitalx' );
 
        $font_families = array();
 
        if ( 'off' !== $Lato ) {
            $fonts[] = 'Lato:400,300,700';
        }
 
        
		  if ( 'off' !== $Roboto ) {
            $fonts[] = 'Roboto:400,300';
        }
 
		
	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}
 
	return $fonts_url; 
}
/*
Enqueue scripts and styles.
*/
function capitalx_scripts() {
    wp_enqueue_style( 'capitalx-google-fonts', capitalx_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'capitalx_scripts' );
// Load necessary theme scripts and styles
function capitalx_theme_scripts_styles() {
  
    // Adds JavaScript to pages with the comment form to support sites with
   
   if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
   
    wp_enqueue_script("capitalx-site-responsivemenu", get_template_directory_uri()."/assets/js/responsivemultimenu.min.js",array('jquery'),false,true);
	wp_enqueue_script("capitalx-bxslider", get_template_directory_uri()."/assets/js/jquery.bxslider.min.js",array('jquery'),false,true);
	if(is_page_template('page-template/template-contact.php')){
    wp_enqueue_script("capitalx-google-api", "//maps.googleapis.com/maps/api/js",array('jquery'),false,true);
    wp_enqueue_script("capitalx-map", get_template_directory_uri()."/assets/js/map.min.js",array('jquery'),false,true);
	}
	wp_enqueue_script("capitalx-owl", get_template_directory_uri()."/assets/js/owl.carousel.min.js",array('jquery'),false,true);
	wp_enqueue_script("capitalx-wow", get_template_directory_uri()."/assets/js/wow.min.js",array('jquery'),false,true);
    wp_enqueue_script("capitalx-custom", get_template_directory_uri()."/assets/js/custom.min.js",array('jquery'),false,true);
	 wp_enqueue_script("capitalx-colpick", get_template_directory_uri()."/assets/js/colpick.js",array('jquery'),false,true);
	 
	
    
    // Loads our main stylesheet. 
    
    
    wp_enqueue_style( 'capitalx-fontawesome', get_template_directory_uri().'/assets/css/font-awesome.min.css');
    wp_enqueue_style( 'capitalx-bootstrap-min', get_template_directory_uri().'/assets/css/bootstrap.min.css');
	 wp_enqueue_style( 'capitalx-animate', get_template_directory_uri().'/assets/css/animator.css');
    wp_enqueue_style( 'capitalx-bxsliderx', get_template_directory_uri().'/assets/css/jquery.bxslider.css');
	wp_enqueue_style( 'capitalx-reset', get_template_directory_uri().'/assets/css/reset.css');
	 wp_enqueue_style( 'capitalx-main', get_template_directory_uri().'/style.css');
	 wp_enqueue_style( 'capitalx-custom', get_template_directory_uri().'/assets/css/custom.css');
	 wp_enqueue_style( 'capitalx-colpickcss', get_template_directory_uri().'/assets/css/colpick.css');
    wp_enqueue_style( 'capitalx-theme_color', get_template_directory_uri().'/assets/css/themes/theme_color.php');   
	
}
add_action( 'wp_enqueue_scripts', 'capitalx_theme_scripts_styles' );
add_theme_support( 'post-formats', array(
         'audio', 'gallery', 'image', 'link', 'video'
    ) );
/// post navigation

if ( ! function_exists( 'capitalx_numeric_posts_nav' ) ) :

function capitalx_numeric_posts_nav() {
	 if( is_singular())
        return;
    global $wp_query;
    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
     echo '<div class="c-news_navigator clearfix">
                   <ul>' . "\n";
    /** Link to first page, plus ellipses if necessary */
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="c-nav_next">%s</li>' . "\n", get_previous_posts_link('&laquo;'),'capitalx' );
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1','capitalx' );
        if ( ! in_array( 2, $links ) )
            echo '<li>...</li>';
    }
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link,'capitalx' );
    }
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
       if ( ! in_array( $max - 1, $links ) )
            echo '<li>...</li>' . "\n";
        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max ,'capitalx');
    }
     /** Next Post Link */  
    if ( get_next_posts_link() )
        printf( '<li class="c-nav_next">%s</li>' . "\n", get_next_posts_link('&raquo;'),'capitalx');
    echo '</ul></div>' . "\n";
    
}
endif;
add_filter('comment_reply_link', 'capitalx_replace_reply_link_class');
function capitalx_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='t-single_comment_reply", $class);
    return $class;
} 
 
class String{
 public static function truncate($s, $l, $e = '...', $isHTML = false){
  $i = 0;
  $tags = array();
  if($isHTML){
   preg_match_all('/<[^>]+>([^<]*)/', $s, $m, PREG_OFFSET_CAPTURE | PREG_SET_ORDER);
   foreach($m as $o){
    if($o[0][1] - $i >= $l)
     break;
    $t = substr(strtok($o[0][0], " \t\n\r\0\x0B>"), 1);
    if($t[0] != '/')
     $tags[] = $t;
   elseif(end($tags) == substr($t, 1))
     array_pop($tags);
    $i += $o[1][1] - $o[0][1];
   }
  }
  return substr($s, 0, $l = min(strlen($s),  $l + $i)) . (count($tags = array_reverse($tags)) ? '</' . implode('></', $tags) . '>' : '') . (strlen($s) > $l ? $e : '');
 }
 public static function content_limit($max_char,$allow_tags='')
 {
     $content = get_the_content('');
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = strip_tags($content,$allow_tags);
     return String::truncate($content,$max_char, '', true, false);
 }
}
/*********Breadcrum*************/
function capitalx_breadcrumb() {
    global $post;
    $separator = ""; // Simply change the separator to what ever you need e.g. / or >
     echo  '<div class="c-banner_breadcrum">';
     echo  '<div class="container">';
    echo     '<div class="row">';
     echo '<ul class="a-breadcrumb">';
    if (!is_front_page()) {
        echo '<a href="';
        echo home_url() ;
        echo '">';
       echo __('Home', 'capitalx'); 
        echo "</a> ".$separator;
        
        if (is_single() ) {
            
        if ( is_single() ) {
		
		if(get_post_type() == 'services'){
		   echo '<li class="post_typename">';
		   echo esc_html__('Services','capitalx'); 
           echo '</li>';
		}
		if(get_post_type() == 'team_member'){
		   echo '<li class="post_typename">';
		   echo esc_html__(' Team Member','capitalx');  
           echo '</li>';
		}
		if(get_post_type() == 'reviews'){
		   echo '<li class="post_typename">'; 
		   echo esc_html__('Reviews','capitalx'); 
           echo '</li>';
		}
		if(get_post_type() == 'clients'){
		   echo '<li class="post_typename">'; 
		   echo esc_html__('Clients','capitalx'); 
           echo '</li>';
		}
        echo '<li>' ;
             the_title(); 
           echo '</li>';}
        } elseif ( is_page() && $post->post_parent ) {
            $home = get_page(get_option('page_on_front'));
            for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
                if (($home->ID) != ($post->ancestors[$i])) {
                    echo '<a href="';
                    echo get_permalink($post->ancestors[$i]); 
                    echo '">';
                    echo get_the_title($post->ancestors[$i]);
                    echo "</a>".$separator;
                }
            }
           echo '<li>' ;
             the_title(); 
           echo '</li>';
        } elseif (is_page()) {
           echo '<li>' ;
           echo  get_the_title(); 
           echo '</li>';
        } elseif (is_home()) {
           echo '<li>' ;
				$id = get_option( 'page_for_posts' );
				echo  get_the_title( $id ); 

           echo '</li>';
        } elseif (is_404()) {
            echo "404";
        }
    } else {
        bloginfo('name');
    }
     echo '</ul></div></div></div>';
}
 
function capitalx_remove_dimensions_avatars( $avatar ) {
    $avatar = preg_replace( "/(width|height)=\'\d*\'\s/", "", $avatar );
    return $avatar; 
}
add_filter( 'get_avatar', 'capitalx_remove_dimensions_avatars', 10 );
// comments 
// comments
class capitalx_walker_comment extends Walker_Comment {
     
    // init classwide variables
    var $tree_type = 'comment';
    var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
 
    /** CONSTRUCTOR
     * You'll have to use this if you plan to get to the top of the comments list, as
     * start_lvl() only goes as high as 1 deep nested comments */
    function __construct() { ?>
        <div class="c-comment_listing">         
    <?php }
    /** START_LVL 
     * Starts the list before the CHILD elements are added. */
    function start_lvl( &$output, $depth = 0, $args = array()) {       
        $GLOBALS['comment_depth'] = $depth + 1; ?>
 
                <ul class="c-single_user_cemment">
    <?php }
    /** END_LVL 
     * Ends the children list of after the elements are added. */
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1; ?>
        </ul><!-- /.children --> 
    <?php }
    /** START_EL */
    function start_el( &$output, $comment, $depth=0, $args =array(),$id = 0 ) {
        $depth++;
        $GLOBALS['comment_depth'] = $depth;
        $GLOBALS['comment'] = $comment; 
        $parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' ); ?>
        <ul <?php comment_class( ''  ); ?> id="comment-<?php comment_ID() ?>">
            <li>
            <?php
               printf('<h3 class="a-comment_user">%s</h3>', get_comment_author_link());
             ?>
            <div class="c-comment_details">
                    <?php  
					if (0 != $args['avatar_size']) 
					echo get_avatar($comment, $args['avatar_size']); ?>
                    <div class="c-comment_header">
                      <span class="c-comment_date">
                    <?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'capitalx'), get_comment_date(), get_comment_time()); ?>
                    </span>
                      <span class="c-reply"><?php comment_reply_link(array_merge($args, array(
                        'add_below' => 'div-comment',
                        'depth' => $depth,
                        'max_depth' => $args['max_depth'],
                        
                    ))); ?>
            <?php edit_comment_link(__('Edit', 'capitalx'), '<span class="c-reply">&middot;</span> <span class="edit-link">', '</span>'); ?></span>
                    </div>
                    <?php comment_text(); ?>
                  </div>
           
            
                <?php if ('0' == $comment->comment_approved): ?>
                    <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'capitalx'); ?></p>
                <?php endif; ?>
            
                    
                    
                    
                 
                <!-- .comment-author -->
                
  
    <?php }
    function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>
       </li> </ul> 
    <?php }
     
    /** DESTRUCTOR
     * I'm just using this since we needed to use the constructor to reach the top 
     * of the comments list, just seems to balance out nicely:) */
    function __destruct() { ?>
    </div><!-- /#comment-list -->
    <?php }
}



function capitalx_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'capitalx_excerpt_more');

function capitalx_map_script(){

    
    $theme_url = esc_url(get_template_directory_uri());

    print '<script>  var theme_url = "'.$theme_url.'";</script>';
    
}
add_action('wp_head', 'capitalx_map_script');

function capitalx_custom_script(){

    $capitalx_js = esc_js(capitalx_global_var('custom_js'));
    
    print '<script>jQuery(document).ready(function($){ '.$capitalx_js.' });</script>';
    
}
if(capitalx_global_var('custom_js') != null){
    add_action('wp_head', 'capitalx_custom_script');
} 


function capitalx_custom_css(){

    $capitalx_css = esc_html(capitalx_global_var('custom_css'));
    
    print '<style> '.$capitalx_css.' </style>';
    
}
if(capitalx_global_var('custom_css') != null){
    add_action('wp_head', 'capitalx_custom_css');
}

add_filter( 'body_class', 'capitalx_boxed_bg' );
function  capitalx_boxed_bg( $classes ) {
	$classes[] = 'boxed_bg';
	return $classes;
}