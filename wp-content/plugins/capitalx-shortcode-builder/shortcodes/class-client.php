<?php 

class VE_PB_Clients{

	public static $args;



	/**

	 * Initiate the shortcode

	 */

	public function __construct() {



		add_filter( 've_pb_attr_clients', array( $this, 'attr' ) );

		

		add_shortcode( 'clients', array( $this, 'render' ) );



	}



		/**

		 * Render the shortcode

		 * @param  array $args	 Shortcode paramters

		 * @param  string $content Content between shortcode

		 * @return string		  HTML output

		 */

		function render( $args, $content = '') {

			global $ve_pb_data;

	

			$defaults = Vee_pb_Plugin::set_shortcode_defaults(

				array(

					

					'class' => '',

					'id' => '',

					'number_posts'				=> '',

					'posts_per_page'	  		=> '6',

					

					

				), $args 

			);

		

		  

			extract( $defaults );

			if( $defaults['number_posts'] ) {



	     		$defaults['posts_per_page'] = $defaults['number_posts'];



		    }

			$no_post = $defaults['posts_per_page'];

		    $class = $defaults['class'];

		    $id = $defaults['id'];

			$html='';
           $html .='<div id="c-client_logos" class="c-client_logos">';
		   
			if($id != '' && $class !=''){

			$html .='<div class="container '.$class.'" id="'.$id.'">';

			}elseif($id != ''){

			$html .='<div class="container" id="'.$id.'">';

			}

			elseif($class != ''){

			$html .='<div class="container '.$class.'">';

			}

			else{

			$html .='<div class="container">';

			}

            $html .='<div class="row ">';
			 $html .='<div class="c-client_logo_list" id="c-client_logo_list">';
         $args = array('post_type' => 'clients','posts_per_page' => $no_post, );

            $clients = new WP_Query( $args );

			 while( $clients->have_posts() ) {

			$clients->the_post();

			$clients_url = get_post_meta(get_the_ID(),"_cmb_client_url",true);
          
		     $src = wp_get_attachment_image_src( get_post_thumbnail_id($clients->ID),'full');

		    

             $html.='<div>';

			  $html.='<a href="'.$clients_url.'">';

			 $html .= sprintf( '<img  src="%s" alt=""/>', $src['0']) . "\n";

			 $html.='</a>';

			  $html.='</div>';

			 }

			$html.='</div>'; 
			$html.='<div class="c-review_nav">';
            $html.=' <div id="c-client_left" class="c-arrow_left">';
            $html.='<span>arrow left</span>';
            $html.='</div>';
			 $html.='<div id="c-client_right" class="c-arrow_right">';
			 $html.='<span>arrow right</span>';
			 $html.='</div>';
            $html.='</div>';
			
             $html.='</div>';
			$html.='</div>';
             $html.='</div>';

			return $html;

		

		

		}

	

	}



new VE_PB_Clients();



?>