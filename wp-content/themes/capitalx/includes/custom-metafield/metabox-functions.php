<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */
add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {
	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	
	
	$meta_boxes[] = array(
		'id'         => 'team_fields',
		'title'      => esc_html__('Team Member Field', 'capitalx'),
		'pages'      => array( 'team_member'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		
		'fields' => array(
			array(
                'name' => esc_html__('Position', 'capitalx'),
				'desc' => esc_html__('Position', 'capitalx'),
				'id'   => $prefix . 'member_Position',
				'type' => 'text',
            ), 
			array(
                'name' => esc_html__('Facebook Url', 'capitalx'),
				'desc' => esc_html__('Facebook Url', 'capitalx'),
				'id'   => $prefix . 'member_facebook_url',
				'type' => 'text',
            ),  
			array(
                'name' => esc_html__('Twitter Url', 'capitalx'),
				'desc' => esc_html__('Twitter Url', 'capitalx'),
				'id'   => $prefix . 'member_twitter_url',
				'type' => 'text',
            ),
            array(
                'name' => esc_html__('LinkedIn Url', 'capitalx'),
				'desc' => esc_html__('LinkedIn Url', 'capitalx'),
				'id'   => $prefix . 'member_in_url',
				'type' => 'text',
            ),   
                
        )
	);
	$meta_boxes[] = array(
		'id'         => 'services_fields',
		'title'      => esc_html__('Services Field', 'capitalx'),
		'pages'      => array( 'services'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		
		'fields' => array(
			array(
                'name' => esc_html__('Secondary Title', 'capitalx'),
				'desc' => esc_html__('Secondary Title Here', 'capitalx'),
				'id'   => $prefix . 'services_sub_title',
				'type' => 'text',
            ), 
			 array(
                'name' => esc_html__('Short Description', 'capitalx'),
				'id'   => $prefix . 'services_short_content',
				'type' => 'textarea',
            ), 
			 array(
                'name' => esc_html__('Button Title', 'capitalx'),
				'id'   => $prefix . 'services_btn_title',
				'type' => 'text',
            ), 
			 array(
                'name' => esc_html__('Button Link', 'capitalx'),
				'id'   => $prefix . 'services_btn_link',
				'type' => 'text',
            ),   
                
        )
	);
	
	$meta_boxes[] = array(
		'id'         => 'client_fields',
		'title'      => esc_html__('Client Field', 'capitalx'),
		'pages'      => array( 'capitalx_clients'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		
		'fields' => array(
            array(
                'name' => esc_html__('Enter Client Url', 'capitalx'),
				'desc' => esc_html__('Enter Client Url', 'capitalx'),
				'id'   => $prefix . 'client_url',
				'type' => 'text',
            ),        
        )
	);
	
	$meta_boxes[] = array(
		'id'         => 'embed_media',
		'title'      => esc_html__('Post Data', 'capitalx'),
		'pages'      => array( 'post'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
                'name' => esc_html__('Post Data', 'capitalx'),
				'desc' => esc_html__('oEmbed Post format media', 'capitalx'),
				'id'   => $prefix . 'embed_media',
				'type' => 'text',
            ),
            
			array(
                'name' => esc_html__('Post Link ', 'capitalx'),
				'desc' => esc_html__('Add link ', 'capitalx'),
				'id'   => $prefix . 'extern_link',
				'type' => 'text',
            ),           
		)
	);
	$meta_boxes[] = array(
		'id'         => 'header_images',
		'title'      => esc_html__('Header Images', 'capitalx'),
		'pages'      => array( 'post','page','capitalx_our_works','capitalx_portfolio'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
		
		'fields' => array(
			array(
                'name' => esc_html__('Header Image', 'capitalx'),
				'desc' => esc_html__('Header Image', 'capitalx'),
				'id'   => $prefix . 'header_image',
				'type' => 'file',
            ),                 
        )
	);
	
	
	
	
	$meta_boxes[] = array(
		'id'         => 'reviews_fields',
		'title'      => esc_html__('Review Field', 'capitalx'),
		'pages'      => array( 'reviews'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
	
		'fields' => array(
         
            array(
                'name' => esc_html__('Designation', 'capitalx'),
				'desc' => esc_html__('Add author designation here', 'capitalx'),
				'id'   => $prefix . 'review_designation',
				'type' => 'text',
            ),   
			    
        ) 
	);
	$meta_boxes[] = array(
		'id'         => 'clients_fields',
		'title'      => esc_html__('Clients Field', 'capitalx'),
		'pages'      => array( 'clients'), // Post type
		'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
	
		'fields' => array(
         
            array(
                'name' => esc_html__('Enter Client Url', 'capitalx'),
				'desc' => esc_html__('Enter Client Url', 'capitalx'),
				'id'   => $prefix . 'client_url',
				'type' => 'text',
            ),   
			    
        ) 
	);
	// Add other metaboxes as needed
	return $meta_boxes;
}
add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';
}