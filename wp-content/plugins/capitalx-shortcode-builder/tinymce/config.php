<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/
// Number of posts array
function ve_pb_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 ) {
	if( $all ) {
		$number_of_posts['-1'] = 'All';
	}
	if( $default ) {
		$number_of_posts[''] = 'Default';
	}
	foreach( range( $range_start, $range ) as $number ) {
		$number_of_posts[$number] = $number;
	}
	return $number_of_posts;
}
// Taxonomies
function ve_pb_shortcodes_categories ( $taxonomy, $empty_choice = false, $empty_choice_label = 'Default' ) {
	$post_categories = array();
	if( $empty_choice == true ) {
		$post_categories[''] = $empty_choice_label;
	}
	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);
	if( ! is_wp_error( $get_categories ) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
				if( array_key_exists('slug', $cat) &&
					array_key_exists('name', $cat)
				) {
					$post_categories[$cat->slug] = $cat->name;
				}
			}
		}
		if( isset( $post_categories ) ) {
			return $post_categories;
		}
	}
}
$choices = array( 'yes' => __('Yes', 'vee-core'), 'no' => __('No', 'vee-core') );
$reverse_choices = array( 'no' => __('No', 'vee-core'), 'yes' => __('Yes', 'vee-core') );
$choices_with_default = array( '' => __('Default', 'vee-core'), 'yes' => __('Yes', 'vee-core'), 'no' => __('No', 'vee-core') );
$reverse_choices_with_default = array( '' => __('Default', 'vee-core'), 'no' => __('No', 'vee-core'), 'yes' => __('Yes', 'vee-core') );
$leftright = array( 'left' => __('Left', 'vee-core'), 'right' => __('Right', 'vee-core') );
// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = VEE_PB_TINYMCE_DIR . '/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	@$subject = file_get_contents( $fontawesome_path );
}
preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);
$icons = array();
foreach($matches as $match){
	$icons[$match[1]] = $match[2];
}
$checklist_icons = array ( 'icon-check' => '\f00c', 'icon-star' => '\f006', 'icon-angle-right' => '\f105', 'icon-asterisk' => '\f069', 'icon-remove' => '\f00d', 'icon-plus' => '\f067' );
/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);

$ve_pb_shortcodes['blog'] = array(

	'no_preview' => true,

	'params' => array(


        'title' => array(

			'std' => '',

			'type' => 'text',

			'label' => __( 'Add title here', 'vee-core' ),

			//'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core')

		),
		

		'posts_per_page' => array(

			'type' => 'select',

			'label' => __( 'Posts Per Page', 'vee-core' ),

			'desc' => __( 'Select number of posts per page.', 'vee-core' ),

			'options' => ve_pb_shortcodes_range( 25, true, true )

		),

				

		'cat_slug' => array(

			'type' => 'multiple_select',

			'label' => __( 'Categories', 'vee-core' ),

			'desc' => __( 'Select a category or leave blank for all.', 'vee-core' ),

			'options' => ve_pb_shortcodes_categories( 'category' )

		),

		
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Blog Style', 'vee-core' ),
			'desc' => __( 'Select Blog Style ', 'vee-core' ),
			'options' => array(
				'style_one' => __('Style One', 'vee-core'),
				'style_two' => __('Style Two', 'vee-core'),
				
			)
		),

		

		'class' => array(

			'std' => '',

			'type' => 'text',

			'label' => __( 'CSS Class', 'vee-core' ),

			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core')

		),

		'id' => array(

			'std' => '',

			'type' => 'text',

			'label' => __( 'CSS ID', 'vee-core' ),

			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core')

		),		

	),

	'shortcode' => '[blog title="{{title}}" number_posts="{{posts_per_page}}"  cat_slug="{{cat_slug}}"  style_type="{{style_type}}"  class="{{class}}" id="{{id}}"][/blog]',

	'popup_title' => __( 'Blog Shortcode', 'vee-core')

);

/*-----------------------------------------------------------------------------------*/
/*	Section
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['section'] = array(
'no_preview' => true,
	'params' => array(
	
'background_image' => array(
			'type' => 'uploader',
			'label' => __( 'Background Image', 'vee-core' ),
			"group" => __( 'Background', 'vee-core' ),
			"data"
=> array(
				"replace" => "fusion-hidden-img"
			),
			'desc' => __('Upload an image to display in the background', 'vee-core')
		),
	
'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),			
	
	
	),
	'shortcode' => '[section background_image="{{background_image}}" class="{{class}}" id="{{id}}"][/section]',
	'popup_title' => __( 'Section Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*	Section Header
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['section_header'] = array(
'no_preview' => true,
	'params' => array(
	
		
		
		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'sec_title' => array(
		
			'std' => '',
			'type' => 'text',
			'label' => __( 'Section Title', 'vee-core' ),
			'desc' => __( 'Add Section Title here.', 'vee-core' )
		),
	
	
	),
	'shortcode' => '[section_header
class="{{class}}" id="{{id}}" sec_title="{{sec_title}}" ][/section_header]',
	'popup_title' => __( 'Section Header', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*	Content Boxes Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['content_boxes'] = array(
	'params' => array(	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'fusion-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'fusion-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'fusion-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'fusion-core')
		),	
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon Step one', 'vee-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'vee-core' ),
			'options' => $icons
		),
		'details' => array(
				'std' => __('Your Content Goes Here', 'fusion-core'),
				'type' => 'textarea',
				'label' => __( 'Content Box Content', 'fusion-core' ),
				'desc' => __( 'Add content for content box', 'fusion-core' ),
			),		
	),
	'shortcode' => '[content_boxes class="{{class}}" id="{{id}}" icon="{{icon}}"]{{details}}[/content_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Content Boxes Shortcode', 'vee-core' ),
);
/*-----------------------------------------------------------------------------------*/
/*	Image
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['imageblock'] = array(
	'no_preview' => true,
	'params' => array( 
	   'class' => array(
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
	    'image' => array(
			'type' => 'uploader',
			'label' => __( 'Add image', 'vee-core' ),
			'desc' => __( 'Add image', 'vee-core' )
		),
		
	),
	'shortcode' => '[imageblock class="{{class}}" image="{{image}}"][/imageblock]',
	'popup_title' => __( 'Imageblock Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*	Image
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['heading'] = array(
	'no_preview' => true,
	'params' => array( 
	   'class' => array(
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),	
		'title' => array(
			'type' => 'text',
			'label' => __( 'Title Here', 'vee-core' ),
			'desc' => __( 'Title Here.', 'vee-core' )
		),	
	),
	'shortcode' => '[heading class="{{class}}" title="{{title}}"][/heading]',
	'popup_title' => __( 'Heading Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*	Row
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['row'] = array(
	'no_preview' => true,
	'params' => array(
	    'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
	),
	'shortcode' => '[row   class="{{class}}"][/row]',
	'popup_title' => __( 'Row Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['team_member'] = array(
	'no_preview' => true,
	'params' => array(
	 
'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Title', 'vee-core' ),
			'desc' => __( 'Add Title', 'vee-core' )
		),
		
	
      'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Number of Clients', 'vee-core' ),
			'desc' => __( 'Select Number of Clients to show', 'vee-core' ),
			'options' => ve_pb_shortcodes_range( 25, true, true )
		),			
	),
	'shortcode' => '[team_member title ="{{title}}" class="{{class}}" id="{{id}}" number_posts="{{number_posts}}"  ][/team_member]',
	'popup_title' => __( 'Team Member Shortcode', 'vee-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Clients
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['clients'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Number of Clients', 'vee-core' ),
			'desc' => __( 'Select Number of Clients to show', 'vee-core' ),
			'options' => ve_pb_shortcodes_range( 25, true, true )
		),
'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),			
	),
	'shortcode' => '[clients
class="{{class}}" id="{{id}}" number_posts="{{number_posts}}" ][/clients]',
	'popup_title' => __( 'Clients Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*	Column
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['column'] = array(
	'no_preview' => true,
	'params' => array( 
	    'columnsize' => array(
			'type' => 'select',
			'label' => __( 'Column Size', 'vee-core' ),
			'desc' => __( 'Add a Column Size.', 'vee-core' ),
			'options' => ve_pb_shortcodes_range( 12, true, true )
		),
		'class' => array(
			'type' => 'text',
			'label' => __( 'Add Your Class', 'vee-core' ),
			'desc' => __( 'Add Your Class.', 'vee-core' ),
		),
	),
	'shortcode' => '[column   class="col-md-{{columnsize}} col-sm-{{columnsize}} {{class}}"][/column]',
	'popup_title' => __( 'Column Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*	Service
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['services'] = array(
	'no_preview' => true,
	'params' => array(
	

	   'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Title', 'vee-core' ),
			//'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		
       'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Service Style', 'vee-core' ),
			'desc' => __( 'Select Service Style ', 'vee-core' ),
			'options' => array(
				'style_one' => __('Style One', 'vee-core'),
				'style_two' => __('Style Two', 'vee-core'),
				
			)
		),
		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Number of Services', 'vee-core' ),
			'desc' => __( 'Select Number of Services to show', 'vee-core' ),
			'options' => ve_pb_shortcodes_range( 25, true, true )
		),			
	),
	'shortcode' => '[services title="{{title}}" class="{{class}}" id="{{id}}" style_type="{{style_type}}" number_posts="{{number_posts}}"][/services]',
	'popup_title' => __( 'Services Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/* invetments Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['investments'] = array(
	'no_preview' => true,
	'params' => array(
	
			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Title Here', 'vee-core' )
		),
		'details' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Add Description Here', 'vee-core' ),
			//'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),		
	),
	'shortcode' => '[investments
 class="{{class}}" id="{{id}}" title="{{title}}" details="{{details}}"]{{child_shortcode}}[/investments]',
	'popup_title' => __( 'Insert Investment Shortcode', 'vee-core' ),
	'child_shortcode' => array(
		'params' => array(
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Title', 'vee-core' ),
			'desc' => __( 'Add Title.', 'vee-core' )
		),
		'value' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Numeric Value', 'vee-core' ),
			'desc' => __( 'Add Numeric Value', 'vee-core' )
		),
			
		),
		'shortcode' => '[investment name="{{name}}" value="{{value}}" ][/investment]',
		'clone_button' => __( 'Add investments', 'vee-core' )
	)
	
);

/*-----------------------------------------------------------------------------------*/
/* Add  Video
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['video_section'] = array(
	'no_preview' => true,
	'params' => array(
	       'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),   
	
	       'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add a Title Here.', 'vee-core' )
		),
	
		'details' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Details', 'vee-core' ),
			'desc' => __( 'Add a Details Here.', 'vee-core' )
		),
		'btn_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Text', 'vee-core' ),
			'desc' => __( 'Add a Button Text Here.', 'vee-core' )
		),	
	
		'btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Link', 'vee-core' ),
			'desc' => __( 'Add a Button Link Here.', 'vee-core' )
		),	
	
	
       
		'video_id' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Video ', 'vee-core' ),
			// 'desc' => __( 'Add  Show  video.', 'vee-core' )
		),		
	),
	'shortcode' => '[video_section title ="{{title}}" details ="{{details}}" btn_text ="{{btn_text}}" btn_link ="{{btn_link}}" video_id ="{{video_id}}" class="{{class}}"  id="{{id}}"][/video_section]',
	'popup_title' => __( 'Insert Video Shortcode', 'vee-core' ),
	
	
);


/*-----------------------------------------------------------------------------------*/
/* Achievements Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['achievements'] = array(
	'no_preview' => true,
	'params' => array(
	
		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'title' => array(
			'std' => 'Achievements',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Block Title here.', 'vee-core' )
		),		
	),
	'shortcode' => '[achievements
class="{{class}}" id="{{id}}" title="{{title}}"]{{child_shortcode}}[/achievements]',
	'popup_title' => __( 'Insert Achievements Shortcode', 'vee-core' ),
	'child_shortcode' => array(
		'params' => array(
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Achievements Name', 'vee-core' ),
			
		),
		'value' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Numeric Value', 'vee-core' ),
			
		),
			
		),
		'shortcode' => '[achievement name="{{name}}" value="{{value}}" ][/achievement]',
		'clone_button' => __( 'Add Achievement', 'vee-core' )
	)
	
);

/*-----------------------------------------------------------------------------------*/
/* Container Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['container'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		
'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),			
	),
	'shortcode' => '[container
class="{{class}}" id="{{id}}" ][/container]',
	'popup_title' => __( 'Container Shortcode', 'vee-core' )
	
);

/*-----------------------------------------------------------------------------------*/
/* Review Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['reviews'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		
        'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
			
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Title', 'vee-core' ),
			'desc' => __( 'Add Title', 'vee-core' )
		),
		
		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'vee-core' ),
			'desc' => __( 'Select number of posts per page.', 'vee-core' ),
			'options' => ve_pb_shortcodes_range( 25, true, true )
		),		
	),
	'shortcode' => '[reviews
class="{{class}}" id="{{id}}" title="{{title}}" title="{{title}}"  number_posts="{{number_posts}}"][/reviews]',
	'popup_title' => __( 'Reviews Shortcode', 'vee-core' )
	
);

/*-----------------------------------------------------------------------------------*/
/* Already Earn Section Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['already-earn'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Title Here.', 'vee-core' )
		),
		'price' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Price', 'vee-core' ),
			'desc' => __( 'Add Price here', 'vee-core' )
		),
		'details' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Details', 'vee-core' ),
			'desc' => __( 'Add Details here.', 'vee-core' )
		),
		'background_image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image', 'vee-core' ),
		//	'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		
	),
	'shortcode' => '[already-earn title="{{title}}" price="{{price}}" details="{{details}}" background_image="{{background_image}}"][/already-earn]',
	'popup_title' => __( 'already-earn Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/* Step Block Section Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['step-block'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		 'icon_one' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon Step one', 'vee-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'vee-core' ),
			'options' => $icons
		),
		'step_one' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Step One Text', 'vee-core' ),
			'desc' => __( 'Add Text here', 'vee-core' )
		),
		'icon_two' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon Step two', 'vee-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'vee-core' ),
			'options' => $icons
		),
		'step_two' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Step Two Text', 'vee-core' ),
			'desc' => __( 'Add Text here', 'vee-core' )
		),
		'icon_three' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon Step three', 'vee-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'vee-core' ),
			'options' => $icons
		),
		'step_three' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Step Three Text', 'vee-core' ),
			'desc' => __( 'Add Text here', 'vee-core' )
		),
		'icon_four' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon Step four', 'vee-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'vee-core' ),
			'options' => $icons
		),
		'step_four' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Step Four Text', 'vee-core' ),
			'desc' => __( 'Add Text here', 'vee-core' )
		),
		
	),
	'shortcode' => '[step-block icon_one="{{icon_one}}" step_one="{{step_one}}" icon_two="{{icon_two}}" step_two="{{step_two}}" icon_three="{{icon_three}}" step_three="{{step_three}}" icon_four="{{icon_four}}" step_four="{{step_four}}"][/step-block]',
	'popup_title' => __( 'step-block Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/* Price Block Section Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['price_block'] = array(
	'no_preview' => true,
	'params' => array(
	
	     		
         'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		 'block_one_title' => array(
			'type' => 'text',
			'label' => __( 'Block One Title', 'vee-core' ),
			'desc' => __( 'Add Title here', 'vee-core' )
			
		),
		'block_one_details' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Block One Details', 'vee-core' ),
			'desc' => __( 'Add Details here', 'vee-core' )
		),
		 'block_one_old_price' => array(
			'type' => 'text',
			'label' => __( 'Old Price', 'vee-core' ),
			'desc' => __( 'Add Price here', 'vee-core' )
			
		),
		'block_one_old_price_type' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Old Price Type ', 'vee-core' ),
			'desc' => __( 'Add Price Type here', 'vee-core' )
		),
		 'block_one_price' => array(
			'type' => 'text',
			'label' => __( 'Price', 'vee-core' ),
			'desc' => __( 'Add Price here', 'vee-core' )
			
		),
		'block_one_price_type' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Price Type', 'vee-core' ),
			'desc' => __( 'Add Price Type here', 'vee-core' )
		),
		 'block_one_btn_text' => array(
			'type' => 'text',
			'label' => __( 'Button Text', 'vee-core' ),
			'desc' => __( 'Add Text here', 'vee-core' )
			
		),
		'block_one_btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Link  ', 'vee-core' ),
			'desc' => __( 'Add Button Link here', 'vee-core' )
		),
		'block_one_image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image  ', 'vee-core' ),
			'desc' => __( 'Add Image here', 'vee-core' )
		),
		 'block_two_title' => array(
			'type' => 'text',
			'label' => __( 'Block Two Title', 'vee-core' ),
			'desc' => __( 'Add Title here', 'vee-core' )
			
		),
		'block_two_details' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Block Two Details', 'vee-core' ),
			'desc' => __( 'Add Details here', 'vee-core' )
		),
		 'block_two_old_price' => array(
			'type' => 'text',
			'label' => __( 'Old Price', 'vee-core' ),
			'desc' => __( 'Add Price here', 'vee-core' )
			
		),
		'block_two_old_price_type' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Old Price Type ', 'vee-core' ),
			'desc' => __( 'Add Price Type here', 'vee-core' )
		),
		 'block_two_price' => array(
			'type' => 'text',
			'label' => __( 'Price', 'vee-core' ),
			'desc' => __( 'Add Price here', 'vee-core' )
			
		),
		'block two_price_type' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Price Type', 'vee-core' ),
			'desc' => __( 'Add Price Type here', 'vee-core' )
		),
		 'block_two_btn_text' => array(
			'type' => 'text',
			'label' => __( 'Button Text', 'vee-core' ),
			'desc' => __( 'Add Text here', 'vee-core' )
			
		),
		'block_two_btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Link  ', 'vee-core' ),
			'desc' => __( 'Add Button Link here', 'vee-core' )
		),
		'block_two_image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image  ', 'vee-core' ),
			'desc' => __( 'Add Image here', 'vee-core' )
		),
		
	),
	'shortcode' => '[price_block class="{{class}}" id="{{id}}" block_one_title="{{block_one_title}}" block_one_details="{{block_one_details}}" block_one_old_price="{{block_one_old_price}}" block_one_old_price_type="{{block_one_old_price_type}}" block_one_price="{{block_one_price}}" block_one_price_type="{{block_one_price_type}}" block_one_btn_text="{{block_one_btn_text}}" block_one_btn_link="{{block_one_btn_link}}" block_one_image="{{block_one_image}}" block_two_title="{{block_two_title}}" block_two_details="{{block_two_details}}" block_two_old_price="{{block_two_old_price}}" block_two_old_price_type="{{block_two_old_price_type}}" block_two_price="{{block_two_price}}" block_two_price_type="{{block_two_price_type}}" block_two_btn_text="{{block_two_btn_text}}" block_two_btn_link="{{block_two_btn_link}}" block_two_image="{{block_two_image}}"][/price_block]',
	'popup_title' => __( 'price-block Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/*About block Section Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['about_block'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Title Here.', 'vee-core' )
		),
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Block Style', 'vee-core' ),
			'desc' => __( 'Select Block Style ', 'vee-core' ),
			'options' => array(
				'style_one' => __('Style One', 'vee-core'),
				'style_two' => __('Style Two', 'vee-core'),
				
			)
		),
		
		'content' => array(
			'std' => 'Enter Content Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'vee-core' ),
			'desc' => __( 'Add Content here.', 'vee-core' )
		),
		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image', 'vee-core' ),
		//	'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		
	),
	'shortcode' => '[about_block title="{{title}}" style_type="{{style_type}}" image="{{image}}" content="{{content}}" ][/about_block]',
	'popup_title' => __( 'about_block Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/*We Can Section Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['we_can'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Title Here.', 'vee-core' )
		),
		
		'content' => array(
			'std' => 'Enter Content Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'vee-core' ),
			'desc' => __( 'Add Content here.', 'vee-core' )
		),
		
		
	),
	'shortcode' => '[we_can title="{{title}}" content="{{content}}" ][/we_can]',
	'popup_title' => __( 'we can Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/*Consult Section Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['consult_block'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Title Here.', 'vee-core' )
		),
		
		'content' => array(
			'std' => 'Enter Content Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'vee-core' ),
			'desc' => __( 'Add Content here.', 'vee-core' )
		),
		'phone_text' => array(
			'std' => 'Free hotline',
			'type' => 'text',
			'label' => __( 'Enter Phone Text', 'vee-core' ),
			'desc' => __( 'Enter Phone Text Here.', 'vee-core' )
		),
		'phone' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Phone', 'vee-core' ),
			'desc' => __( 'Add Phone Number Here.', 'vee-core' )
		),
		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image', 'vee-core' ),
		//	'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		
	),
	'shortcode' => '[consult_block title="{{title}}" content="{{content}}" phone_text="{{phone_text}}" phone="{{phone}}" image="{{image}}" ][/consult_block]',
	'popup_title' => __( 'we can Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/*	Service Listing
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['services_list'] = array(
	'no_preview' => true,
	'params' => array(
	
      'title' => array(
			'std' => 'OUR SERVICES',
			'type' => 'text',
			'label' => __( 'Add Title', 'vee-core' ),  
			'desc' => __( 'Add Title', 'vee-core' )
		),
		
	
      'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'number_posts' => array(
			'type' => 'select',
			'label' => __( 'Number of Clients', 'vee-core' ),
			'desc' => __( 'Select Number of Clients to show', 'vee-core' ),
			'options' => ve_pb_shortcodes_range( 25, true, true )
		),			
	),
	'shortcode' => '[services_list title ="{{title}}" class="{{class}}" id="{{id}}" number_posts="{{number_posts}}"  ][/services_list]',
	'popup_title' => __( 'Services List Shortcode', 'vee-core' )
);
/*-----------------------------------------------------------------------------------*/
/*Convenient service Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['service_block'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		'block_title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Block Title Here.', 'vee-core' )
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add  Title Here.', 'vee-core' )
		),
		'short_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Enter Short Text', 'vee-core' ),
			
		),
		
		'content' => array(
			'std' => 'Enter Content Here',
			'type' => 'textarea',
			'label' => __( 'Content', 'vee-core' ),
			'desc' => __( 'Add Content here.', 'vee-core' )
		),
		
		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image', 'vee-core' ),
		//	'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		
	),
	'shortcode' => '[service_block block_title="{{block_title}}" title="{{title}}"  short_text="{{short_text}}" content="{{content}}" image="{{image}}" ][/service_block]',
	'popup_title' => __( 'we can Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/*Get Advice Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['get_advice'] = array(
	'no_preview' => true,
	'params' => array(
	
	
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add  Title Here.', 'vee-core' )
		),
		'btn_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Enter Button Text', 'vee-core' ),
			
		),
		
		'btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Button Link ', 'vee-core' ),
			
		),
		
		
		
	),
	'shortcode' => '[get_advice  title="{{title}}"  btn_text="{{btn_text}}" btn_link="{{btn_link}}"  ][/get_advice]',
	'popup_title' => __( 'Get Advice Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/*latest_news_slide Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['latest_news_slide'] = array(
	'no_preview' => true,
	'params' => array(
	
	    'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'title' => array(
			'std' => 'Latest News',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add  Title Here.', 'vee-core' )
		),
		
		
		
		
	),
	'shortcode' => '[latest_news_slide  class="{{class}}" id="{{id}}" title="{{title}}"][/latest_news_slide]',
	'popup_title' => __( 'latest_news_slide Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/* service Price Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['service_price'] = array(
	'no_preview' => true,
	'params' => array(
	     'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
	
		
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add  Title Here.', 'vee-core' )
		),
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Block Style', 'vee-core' ),
			'desc' => __( 'Select Block Style ', 'vee-core' ),
			'options' => array(
				'style_one' => __('Style One', 'vee-core'),
				'style_two' => __('Style Two', 'vee-core'),
				
			)
		),
		'price' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Price ', 'vee-core' ),
			'desc' => __( 'Add Price here', 'vee-core' )
		),
		 'price_type' => array(
			'type' => 'text',
			'label' => __( 'Price Type', 'vee-core' ),
			
			
		),
		'details' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Enter Short Text', 'vee-core' ),
			
		),
		'btn_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Button Text', 'vee-core' ),
			'desc' => __( 'Add Button Text', 'vee-core' )
		),
		
		'btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Button Link', 'vee-core' ),
			'desc' => __( 'Add Button Link', 'vee-core' )
		),
		
		
		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image', 'vee-core' ),
		
		),
		
	),
	'shortcode' => '[service_price class="{{class}}" id="{{id}}"  title="{{title}}" style_type="{{style_type}}" price="{{price}}" price_type="{{price_type}}"  details="{{details}}"  btn_text="{{btn_text}}" btn_link="{{btn_link}}" image="{{image}}" ][/service_price]',
	'popup_title' => __( 'we can Section Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/* New service Price Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['new_services'] = array(
	'no_preview' => true,
	'params' => array(
	   'title' => array(
			'std' => 'new services',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add  Title Here.', 'vee-core' )
		),
		
	    'service_content' => array(
		    'std' => '',
			'type' => 'textarea',
			'label' => __( 'Add Services List here ', 'vee-core' ),
		     
		),
		
		'image_one' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image one here', 'vee-core' ),
		),
		'image_two' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image two here', 'vee-core' ),
		),
		'image_three' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image three here', 'vee-core' ),
		),
		'image_four' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image four here', 'vee-core' ),
		),
		'image_five' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image five here', 'vee-core' ),
		),
		'image_six' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Add Image six here', 'vee-core' ),
		),
		
		'short_text' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Enter Short Text', 'vee-core' ),
			
		),
		'btn_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Button Text', 'vee-core' ),
			'desc' => __( 'Add Button Text', 'vee-core' )
		),
		
		'btn_link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Button Link', 'vee-core' ),
			'desc' => __( 'Add Button Link', 'vee-core' )
		),
		
	),
	'shortcode' => '[new_services title="{{title}}" service_content="{{service_content}}" image_one="{{image_one}}" image_two="{{image_two}}" image_three="{{image_three}}"  image_four="{{image_four}}" image_five="{{image_five}}" image_six="{{image_six}}" short_text="{{short_text}}" btn_text="{{btn_text}}" btn_link="{{btn_link}}" ][/new_services]',
	'popup_title' => __( ' New service Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/* New service Price Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['page_title'] = array(
	'no_preview' => true,
	'params' => array(
	   'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
	
		
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add  Title Here.', 'vee-core' )
		),
		
		
	),
	'shortcode' => '[page_title  class="{{class}}"  id="{{id}}" title="{{title}}"][/page_title]',
	'popup_title' => __( ' Page Title Shortcode', 'vee-core' )
	
);
/*-----------------------------------------------------------------------------------*/
/* Accordiann Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['accordians'] = array(
	'no_preview' => true,
	'params' => array(
	
			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
				
	),
	'shortcode' => '[accordians
 class="{{class}}" id="{{id}}" ]{{child_shortcode}}[/accordians]',
	'popup_title' => __( 'Insert accordians Shortcode', 'vee-core' ),
	'child_shortcode' => array(
		'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Add Title', 'vee-core' ),
			'desc' => __( 'Add Title.', 'vee-core' )
		),
		'details' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Add Details', 'vee-core' ),
			'desc' => __( 'Add Details Here', 'vee-core' )
		),
			
		),
		'shortcode' => '[accordian title="{{title}}" details="{{details}}" ][/accordian]',
		'clone_button' => __( 'Add accordians', 'vee-core' )
	)
	
);


/*-----------------------------------------------------------------------------------*/
/* Multilists Config
/*-----------------------------------------------------------------------------------*/
$ve_pb_shortcodes['multilists'] = array(
	'no_preview' => true,
	'params' => array(
	
		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'vee-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'vee-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'vee-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'vee-core' )
		),
		'title' => array(
			
			'type' => 'textarea',
			'label' => __( 'Title', 'vee-core' ),
			'desc' => __( 'Add Block Title here.', 'vee-core' )
		),		
	),
	'shortcode' => '[multilists
class="{{class}}" id="{{id}}" title="{{title}}"]{{child_shortcode}}[/multilists]',
	'popup_title' => __( 'Insert List Shortcode', 'vee-core' ),
	'child_shortcode' => array(
		'params' => array(
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'vee-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'vee-core' ),
			'options' => $icons
		),
		'short_text' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Add Short Description', 'vee-core' ),
			
		),
		
			
		),
		'shortcode' => '[multilist short_text="{{short_text}}" icon="{{icon}}" ][/multilist]',
		'clone_button' => __( 'Add List', 'vee-core' )
	)
	
);