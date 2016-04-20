<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */
if (!class_exists('Redux_Framework_sample_config')) {
    class Redux_Framework_sample_config {
        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;
        public function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        public function initSettings() {
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            // Create the sections and fields
            $this->setSections();
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }
        /**
          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            
        }
        /**
          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.
          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'redux-framework-demo'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );
            return $sections;
        }
        /**
          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;
            return $args;
        }
        /**
          Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }
        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);
                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }
        public function setSections() {
            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();
            if (is_dir($sample_patterns_path)) :
                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();
                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {
                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;
            ob_start();
            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf(esc_html__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','capitalx'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview','capitalx'); ?>" />
                <?php endif; ?>
                <h4><?php echo $this->theme->display('Name'); ?></h4>
                <div>
                    <ul class="theme-info">
                        <li><?php printf(esc_html__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(esc_html__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . esc_html__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','capitalx') . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
            }
            ?>
                </div>
            </div>
            <?php
            $item_info = ob_get_contents();
            ob_end_clean();
            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }
            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'icon'      => 'el el-home',
                'title'     => esc_html__('General', 'capitalx'),                
                'fields'    => array(
                    array(
                        'id'        => 'logo_image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Logo Image', 'capitalx'),
                        'subtitle'  => esc_html__('Upload a logo image here', 'capitalx'),
                        'default'   => array('url' => get_template_directory_uri().'/assets/images/logo.png')
                    ),     
                                   
                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Custom Favicon', 'capitalx'),
                        'subtitle'  => esc_html__('Upload your Favicon here,  preferred size is  16x16 or 32x32px', 'capitalx'), 
                       
                    ),
					                        
					 
					array(
                        'id'        => 'blog_banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => esc_html__('Blog Page Banner', 'capitalx'),
                        'default'   => array('url' => get_template_directory_uri().'/assets/images/news_banner.jpg')
                    ), 
					
					 array(
                        'id'        => 'color_custmoizer',
                        'type'      => 'button_set',                        
                        'title'     => esc_html__('Color Customizer', 'capitalx'),
                        'subtitle'  => esc_html__('Show Color Customizer', 'capitalx'),
                        'options'   => array('0'=>'No','1'=>'Yes'),
                        'default'   => '0'                        
                    ),
					 array(
                        'id'        => 'theme_color',
                        'type'      => 'color',                        
                        'title'     => esc_html__('Choose your color scheme', 'capitalx'),
                        'subtitle'  => esc_html__('', 'capitalx'),
                        'desc'      => esc_html__('', 'capitalx'),
                        'default'   => '#dd2342',                      
                    ),
				
				
					
					 array(
                        'id'        => 'custom_css',
                        'type'      => 'textarea',                        
                        'title'     => esc_html__('Customize CSS', 'capitalx'),
                        'subtitle'  => esc_html__('Please do not insert style tag here. For instance header{background:#ccc;}', 'capitalx')                        
                    ),
                    array(
                        'id'        => 'custom_js',
                        'type'      => 'textarea',                        
                        'title'     => esc_html__('Customize Javascript', 'capitalx'),
                        'subtitle'  => esc_html__('Please do not insert script tag here. For instance jQuery(document).ready(function($){
<br/>// insert code here<br/>
});', 'capitalx')                        
                    ),
					
                ),
            );
			$this->sections[] = array(
               'icon'      => 'el el-brush',
                'title'     => esc_html__('Appearance ', 'capitalx'),                
                'fields'    => array(
                   array(
					'id'        => 'layout_swtich', 
					'type'      => 'button_set',
					'title'     => esc_html__('Layout Style', 'capitalx'),
					'subtitle'  => esc_html__('Choose boxed or full page mode', 'capitalx'),
					'options'   => array(
						"full"  => esc_html__("Full Width", 'capitalx'),
						"boxed" => esc_html__("Boxed", 'capitalx')
					),
					'default'   => 'full'
				),
				array(
                'id'=> 'boxed_background',
                'type'     => 'media',
                'title'    => esc_html__('Body Background', 'capitalx'),
                'subtitle' => esc_html__('Body background with image, color, etc.', 'capitalx'),
                'desc'     => esc_html__('Will be used if you choose a boxed layout.', 'capitalx'),
                'required' => array('layout_swtich','equals','boxed'),
                'default'   => null
                ),
		     )
			);
			    $this->sections[] = array(
                'icon'      => 'el el-website',
                'title'     => esc_html__('Header ', 'capitalx'),                
                'fields'    => array(
                 
                    array(
                        'id'        => 'header_top',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Hide Top Header Section', 'capitalx'),
						'options'   => array(
							1        => 'Yes',
							0       => 'No',
						),
						'default' => 0
                       
                    ),
					 array(
                        'id'        => 'header_sticky',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Enable Sticky Header', 'capitalx'),
						'options'   => array(
							1        => 'Yes',
							0       => 'No',
						),
						'default' => 1
                       
                    ), 
                   
                    array(
                        'id'        => 'header_phone',
                        'type'      => 'text',
                        'title'     => esc_html__('Phone Number Here', 'capitalx'),
                        'subtitle'  => esc_html__('Your Phone Number Here', 'capitalx'),
                        'default'   => '+1234557777'
                    ),
					
                    array(
                        'id'        => 'header_email',
                        'type'      => 'text',
                        'title'     => esc_html__('Email ID Here', 'capitalx'),
                        'subtitle'  => esc_html__('Your Email ID Here', 'capitalx'),
                        'default'   => 'capitalix@yoursite.com'
                    ),
					
					array(
                        'id'        => 'header_fb_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Facebook url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
					 array(
                        'id'        => 'header_twt_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Twitter url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
						array(
                        'id'        => 'header_linkdin_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Linkedin url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
					                  
                ),
            ); 
			$this->sections[] = array(
                
                'title'     => esc_html__('Home Page & Contact Page Settings', 'capitalx'),
				'desc'      => esc_html__('Leave blank if you do not want any section', 'redux-framework-demo'), 
				'icon'      => 'el el-inbox-box',               
                'fields'    => array(
                 
                    array(
                        'id'        => 'home_contact_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add title', 'capitalx'),
                        'subtitle'  => esc_html__('Add Contact Section title here', 'capitalx'),
                        'default'   => 'contacts'
                    ),
					 array(
                        'id'        => 'home_tab_one_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Tab one Title', 'capitalx'),
                        'default'   => 'What are your company doing?'
                    ),
					 array(
                        'id'        => 'home_tab_one_content',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Add Tab one Content', 'capitalx'),
                        'default'   => 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
                    ),
					 array(
                        'id'        => 'home_tab_two_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Tab two Title', 'capitalx'),
                        'default'   => 'Where can I see your latest news?'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_one_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List one Title', 'capitalx'),
                        
                        'default'   => 'Location'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_one_content',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List one Content', 'capitalx'),
                        'subtitle'  => esc_html__('Add Address here', 'capitalx'),
                        'default'   => '2403 Bartlett Avenue Southfield, MI 48075, USA '
                    ),
					 array(
                        'id'        => 'home_tab_two_list_two_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List two Title', 'capitalx'),
                      
                        'default'   => 'Administration Phone Number'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_two_content',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Phone Number here', 'capitalx'),
                     
                        'default'   => '+1-234-555-7777'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_two_content_details',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Calling Timing here ', 'capitalx'),
                     
                        'default'   => '(from 9 am to 6 pm)'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_three_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List Three Title', 'capitalx'),
                        'default'   => 'FREE Hotline '
                    ),
					 array(
                        'id'        => 'home_tab_two_list_three_content',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Phone Number here', 'capitalx'),
                        'default'   => '+1-202-555-0181'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_three_content_details',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Calling Timing here ', 'capitalx'),
                        'default'   => '(24-hour)'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_four_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Email Title here', 'capitalx'),
                     
                        'default'   => 'Email'
                    ),
					 array(
                        'id'        => 'home_tab_two_list_four_content', 
                        'type'      => 'text',
                        'title'     => esc_html__('Add Email id  here ', 'capitalx'),
                        'default'   => 'capitalix@gmail.com'
                    ),
					
					array(
                        'id'        => 'home_tab_three_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Tab Three Title', 'capitalx'),
						 'subtitle'     => esc_html__('This tab use for add Phone number of deparments', 'capitalx'),
                          'default'   => 'financial advisors in touch'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_one_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List One Title', 'capitalx'),
                      
                        'default'   => 'Financial Analyst '
                    ),
					 array(
                        'id'        => 'home_tab_three_list_one_content',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Phone Number here', 'capitalx'),
                     
                        'default'   => '+1-202-555-0197*'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_one_content_details',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Calling Timing here ', 'capitalx'),
                     
                        'default'   => '(from 9 am to 6 pm)'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_two_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List Two Title', 'capitalx'),
                      
                        'default'   => 'Lawyer'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_two_content',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Phone Number here', 'capitalx'),
                     
                        'default'   => '+1-202-555-0197*'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_two_content_details',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Calling Timing here ', 'capitalx'),
                     
                        'default'   => '(from 9 am to 6 pm)'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_three_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List Three Title', 'capitalx'),
                      
                        'default'   => 'Personal Financial Advisor'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_three_content',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Phone Number here', 'capitalx'),
                     
                        'default'   => '+1-202-555-0181*'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_three_content_details',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Calling Timing here ', 'capitalx'),
                     
                        'default'   => '(from 9 am to 6 pm)'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_four_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add List Four Title', 'capitalx'),
                      
                        'default'   => 'Investments Expert'
                    ),
					 array(
                        'id'        => 'home_tab_three_list_four_content',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Phone Number here', 'capitalx'),
                     
                        'default'   => '+1-202-555-0107* '
                    ),
					 array(
                        'id'        => 'home_tab_three_list_four_content_details',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Calling Timing here ', 'capitalx'),
                     
                        'default'   => '(from 9 am to 6 pm)'
                    ),
					
					 array(
                        'id'        => 'home_tab_four_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Tab Four Title', 'capitalx'),
						'subtitle'     => esc_html__('This tab use for add social profile link', 'capitalx'),
                        'default'   => 'Capitalix in social networks'
                    ),
					 array(
                        'id'        => 'home_tab_four_list_title',
                        'type'      => 'text',
                        'title'     => esc_html__('Add text here', 'capitalx'),
                     
                        'default'   => 'Join us in social networks '
                    ),
					 array(
                        'id'        => 'home_tab_four_linkdin_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Linkedin url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
					
					 array(
                        'id'        => 'home_tab_four_fb_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Facebook url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
					 array(
                        'id'        => 'home_tab_four_twt_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Twitter url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
					array(
                        'id'        => 'home_tab_four_google_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Google url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
					 array(
                        'id'        => 'home_tab_four_insta_url',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Instagram url here', 'capitalx'),
                     
                        'default'   => ''
                    ),
                                    
                ),
            ); 
			$this->sections[] = array(
                'icon'      => 'el el-envelope',
                'title'     => esc_html__('Contact', 'capitalx'),                
                'fields'    => array(
                     
					array(
                        'id'        => 'contact_form',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Contact Form 7 Shortcode', 'capitalx'),
                        'subtitle'  => esc_html__('Add Contact Form 7 code here to show form at contact & home ', 'capitalx'),
                        'default'   => '[contact-form-7 id="220" title="contact us form"]'
                    ),
                    array(
                        'id'        => 'googlemap_lati',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Your Google Map Latitude', 'capitalx'),
                        'subtitle'  => esc_html__('Google Map Latitude', 'capitalx'),
                        'default'   => '52.229676'
                    ),
					 array(
                        'id'        => 'googlemap_long',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Your Google Map Longitude', 'capitalx'),
                        'subtitle'  => esc_html__('Google Map Longitude', 'capitalx'),
                        'default'   => '21.012229'
                    ),
					
                                    
                ),
            );
			
			
			$this->sections[] = array(
                'icon'      => 'el el-font',
                'title'     => esc_html__('Typography', 'capitalx'),                
                'fields'    => array(
                    array(
                        'id' => 'body-font',
                        'type' => 'typography',
                        'output' => array('body'),
                        'title' => esc_html__('Body Font', 'capitalx'),
                        'subtitle' => esc_html__('Select a primary font for site', 'capitalx'),                        
                        'google' => true,                        
                        'text-align'    => false,
                        'subsets'       => false,
                        'line-height' => false,                        
                        'font-style'    => false,
                        'default' => array(
                            'color' => '#2a2e3c',
                            'font-size' => '14px',                            
                            'font-family' => "Lato",                            
                            'font-weight'   => "400"
                        ),
                    ),
                     array(
                        'id' => 'heading-font',
                        'type' => 'typography',
                        'output' => array('h1','h2','h3','h4','h5','h6'),
                        'title' => esc_html__('Font Heading (Option)', 'capitalx'),                        
                        'desc'  => __('Select a google font heading: h1,h2,h3,h4,h5,h6. <br/> Note To use nexa_boldregular font, you have to hit Reset Section button.','capitalx'),                        
                        'google' => true,                        
                        'color' => false,
                        'font-size' => false,                        
                        'line-height' => false,
                        'font-weight'   => false,
                        'text-align'    => false,
                        'subsets'       => false,                        
                        'font-style'    => false,                        
                        'default' => array(                            
                            'font-family' => "Lato",
                        ),
                    ),                                                    
                  ),
            );        
          
            
            
			
             $this->sections[] = array(
                'icon'      => 'el el el-puzzle',
                'title'     => esc_html__('Footer ', 'capitalx'),                
                'fields'    => array(
                     array(
					'id'        => 'footer_swtich', 
					'type'      => 'button_set',
					'title'     => esc_html__('Footer Style', 'capitalx'),
					'subtitle'  => esc_html__('Choose Footer Style', 'capitalx'),
					'options'   => array(
						"st_one"  => esc_html__("Dark", 'capitalx'),
						"st_two" => esc_html__("Light", 'capitalx')
					),
					'default'   => 'st_one'
				),
                    array(
                        'id'        => 'copyrighttext',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Copyright Text Here', 'capitalx'),
                  
                        'default'   => 'Copyright &copy; capitalx, All Rights Reserved'
                    ),                   
                ),
            );        
            // Import Export
            $this->sections[] = array(
                'title'     => esc_html__('Import / Export', 'redux-framework-demo'),
                'desc'      => esc_html__('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
           
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => esc_html__('Theme Information', 'redux-framework-demo'),
                'desc'      => esc_html__('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );
        }
        public function setHelpTabs() {
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => esc_html__('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => esc_html__('Theme Information 2', 'redux-framework-demo'),
                'content'   => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );
            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }
        /**
          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {
            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'theme_option',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'capitalx'),
                'page_title'        => esc_html__('Theme Options', 'capitalx'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyByw9j_PY1meWfxVmujxzrc7HhsQMvg_e4', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE
                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );
            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => '//github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => '//www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => '//twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => '//www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
               // $this->args['intro_text'] = sprintf(esc_html__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
            } else {
                $this->args['intro_text'] = esc_html__('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            }
            // Add content after the form.
          //  $this->args['footer_text'] = esc_html__('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');
        }
    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}
/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;
/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        
        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
