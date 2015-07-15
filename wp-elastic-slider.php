<?php
/* 
 *
 * Plugin Name: Wp Elastic Slider
 * Plugin URI:  http://www.themeweave.com
 * Description: Easy to use WordPress elastic slider plugin. Create SEO friendly responsive slideshows with jQuery easing effects.
 * Version:     1.1.1
 * Author:      Theme Weave
 * Author URI:  http://www.themeweave.com/
 * License:     GPL-2.0+
 * Copyright:   2015 ThemeWeave LTD
 *
 * Text Domain: themeweave
 * Domain Path: /languages/
 */

if ( ! defined( 'ABSPATH' ) )
    exit; // disable direct access


if ( ! class_exists( 'WpElasticSlideshow' ) ) :

/**
 * Register the plugin.
 * 
 */

class WpElasticSlider {


	/**
	 * Slug for the slider post type
	 *
	 * @since	1.0
	 * @access	protected
	 */ 

	protected $type_name = 'wpelasticslider';


	/**
	 * The constructor. Include classes and metaboxes and run all hooks
	 *
	 * @since	1.0
	 * @access	public
	 */ 


	public function WpElasticSlider(){

		$this->classes();
		$this->meta();
		$this->hooks(); 
	}



	/**
	 * Uses WordPress add_filter() function, see WordPress add_filter()
	 *
	 * @since	1.0
	 * @access	public
	 * @link	http://core.trac.wordpress.org/browser/trunk/wp-includes/plugin.php#L65
	 */ 


	public function hooks()
	{

		add_action( 'init', array($this, 'textdomain'));
		add_action( 'init', array($this, 'register_menu') );
		add_action( 'admin_init', array($this, 'admin_scripts')  );
		add_action( 'wp_enqueue_scripts', array($this, 'front_scripts')  );
		add_action('save_post', array($this, 'title')); 
		add_action( 'admin_menu' , array($this, 'remove_submitdiv') );
		add_action( 'manage_'.$this->type_name.'_posts_custom_column', array($this, 'sc_column'), 10, 2 );
		add_action('admin_enqueue_scripts', array($this, 'autosave') );

		add_filter( 'bulk_post_updated_messages', array($this, 'updated_message') );
		add_filter('post_updated_messages', array($this, 'notification'));
		add_filter( 'manage_'.$this->type_name.'_posts_columns', array( $this, 'create_sc_column') );

		add_shortcode( 'wpeslider', array($this, 'shortcode'));
	}



	/**
	 * Load the textdomain to make it translate able
	 *
	 * @since	1.0
	 * @access	public
	 * @link	https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
	 */ 

	public function textdomain() 
	{
	  load_plugin_textdomain( 'themeweave', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}


	/**
	 * Include the WPAlchemy_MetaBox class if not exists
	 *
	 * @since	1.0
	 * @access	public
	 */ 

	public function classes ()
	{
		if ( ! class_exists( 'WPAlchemy_MetaBox' ) ){
			require_once 'wpalchemy/MetaBox.php';
		}
	}



	/**
	 * Return the labels of slider post type
	 *
	 * @since	1.0
	 * @access	public
	 * @return	array 
	 */

	public function labels()
	{
		return 	array(
				'name'               => __( 'ELastic Slider', 'themeweave' ),
				'singular_name'      => __( 'ELastic Slider', 'themeweave' ),
				'menu_name'          => __( 'ELastic Sliders', 'themeweave' ),
				'name_admin_bar'     => __( 'ELastic Slider', 'themeweave' ),
				'add_new'            => __( 'Add New', 'themeweave' ),
				'add_new_item'       => __( 'New Slider', 'themeweave' ),
				'new_item'           => __( 'New Slider', 'themeweave' ),
				'edit_item'          => __( 'Edit Slider', 'themeweave' ),
				'view_item'          => __( 'View Book', 'themeweave' ),
				'all_items'          => __( 'All Sliders', 'themeweave' ),
				'search_items'       => __( 'Search Slider', 'themeweave' ),
				'parent_item_colon'  => __( 'Parent Slider:', 'themeweave' ),
				'not_found'          => __( 'No sliders found.', 'themeweave' ),
				'not_found_in_trash' => __( 'No sliders found in Trash.', 'themeweave' )
			);
	}



	/**
	 * Get the bulk updated message and return updated version
	 *
	 * @since	1.0
	 * @access	public
	 * @param	array $message required The updated message
 	 * @param	array $count required Number of slider available
	 * @return	array 
	 */

	public function updated_message ( $message, $count = false )
	{
	    $message[ $this->type_name ] = array(
	        'updated'   => _n( '%s slider updated.', '%s sliders updated.', $count['updated'], 'themeweave' ),
	        'locked'    => _n( '%s slider not updated, somebody is editing it.', '%s sliders not updated, somebody is editing them.', $count['locked'], 'themeweave' ),
	        'deleted'   => _n( '%s slider permanently deleted.', '%s sliders permanently deleted.', $count['deleted'], 'themeweave' ),
	        'trashed'   => _n( '%s slider moved to the Trash.', '%s sliders moved to the Trash.', $count['trashed'], 'themeweave' ),
	        'untrashed' => _n( '%s slider restored from the Trash.', '%s sliders restored from the Trash.', $count['untrashed'], 'themeweave' ),
	    );

	    return $message;
	}




	/**
	 *  Register the post type using register_post_type
	 *
	 * @since	1.0
	 * @access	public
	 * @link	http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	public function register_menu()
	{
		 $args = array(
				'labels'             	=> $this->labels(),
				'public'             	=> false,
				'publicly_queryable' 	=> false,
				'show_ui'            	=> true,
				'exclude_from_search' 	=> true,
				'capability_type'		=> 'page',
				'show_in_menu'       	=> true,
				'query_var'          	=> true,
				'rewrite'            	=> array( 'slug' => $this->type_name ),
				'capability_type'    	=> 'post',
				'has_archive'        	=> false,
				'hierarchical'       	=> false,
				'supports'           	=> array( '' )
			);

		register_post_type( $this->type_name , $args );
	}


	
	/**
	 * Get the update message and return updated version
	 *
	 * @since	1.0
	 * @access	public
	 * @param	array $message required The update message array
	 * @return	array 
	 */

 	public function notification($messages)
 	{
		$messages[$this->type_name][1] 	=  	__('Slider updated.', 'themeweave');
		$messages[$this->type_name][4] 	=  	__('Slider updated', 'themeweave');
		$messages[$this->type_name][6] 	= 	__('Slider published', 'themeweave');
		$messages[$this->type_name][7] 	= 	__('Slider saved', 'themeweave');
		$messages[$this->type_name][8] 	= 	__('Slider submitted', 'themeweave');
		$messages[$this->type_name][9] 	= 	__('Slider scheduled successfully', 'themeweave');
		$messages[$this->type_name][10] = 	__('Slider draft updated', 'themeweave');

		return $messages;
	}



	/**
	 *  Remove default post publish metabox using remove_meta_box
	 *
	 * @since	1.0
	 * @access	public
	 * @link	http://codex.wordpress.org/Function_Reference/remove_meta_box
	 */

	public function remove_submitdiv()
	{
		remove_meta_box( 'submitdiv' , $this->type_name , 'normal' ); 
	}



	/**
	 *  Create a shortcode column in post type 
	 *
	 * @since	1.0
	 * @access	public
	 * @link	http://codex.wordpress.org/Plugin_API/Action_Reference/manage_posts_custom_column
	 * @return  array
	 */

	public function create_sc_column  ( $column ) 
	{
	    $column['shortcode'] = __('Shortcode', 'themeweave');
	    return $column;
	}



	/**
	 *  Show rendered shortcode in shortcode column
	 *
	 * @since	1.0
	 * @access	public
	 */

	function sc_column( $column_name, $post_id ) 
	{
	    if ( $column_name == 'shortcode')
	    	echo htmlentities('[wpeslider id='.$post_id.']');
	}



	/**
	 *  Dequeue autosave script to disable autosave
	 *
	 * @since	1.0
	 * @access	public
	 * @link 	http://codex.wordpress.org/Function_Reference/wp_dequeue_script
	 */

	public function autosave() {
	  if ( get_post_type() == $this->type_name )
	  	wp_dequeue_script('autosave');
	}



	/**
	 *  Register required metabox for slider type
	 *
	 * @since	1.0
	 * @access	public 
	 */

	public function meta()
	{
		$meta = new WPAlchemy_MetaBox(array(
			'id' 		=> '_name',
			'types' 	=> array( $this->type_name ),
			'title' 	=> __('Slide Name', 'themeweave'),
			'template' 	=> dirname ( __FILE__ ). '/templates/title.php',
		));

		$meta = new WPAlchemy_MetaBox(array(
			'id' 		=> '_slides',
			'types' 	=> array( $this->type_name ),
			'title' 	=> __('Slides', 'themeweave'),
			'template' 	=> dirname ( __FILE__ ). '/templates/slides.php',
		));

		$meta = new WPAlchemy_MetaBox(array(
			'id' 		=> '_publsh',
			'types' 	=> array( $this->type_name ),
			'title' 	=> __('Publish', 'themeweave'),
			'context' 	=> 'side',
			'priority' 	=> 'high',
			'template' 	=> dirname ( __FILE__ ). '/templates/publish.php', 
		));

		$meta = new WPAlchemy_MetaBox(array(
			'id' 		=> '_config',
			'types' 	=> array( $this->type_name ),
			'title'		=> __('Slider Configuration', 'themeweave'),
			'context' 	=> 'side',
			'priority' 	=> 'low',
			'template' 	=> dirname ( __FILE__ ). '/templates/config.php', 
		));

		$meta = new WPAlchemy_MetaBox(array(
			'id' 		=> '_uses',
			'types' 	=> array( $this->type_name ),
			'title' 	=> __('Uses', 'themeweave'), 
			'context' 	=> 'side',
			'priority' 	=> 'low',
			'template' 	=> dirname ( __FILE__ ). '/templates/uses.php',
		));

		$meta = new WPAlchemy_MetaBox(array(
			'id' 		=> '_like',
			'types' 	=> array( $this->type_name ),
			'title' 	=> __('Follow Us', 'themeweave'), 
			'context' 	=> 'side',
			'priority' 	=> 'low',
			'template' 	=> dirname ( __FILE__ ). '/templates/like.php',
		));

		$meta = new WPAlchemy_MetaBox(array(
			'id' 		=> '_styles',
			'types' 	=> array( $this->type_name ),
			'title' 	=> __('Style Editor', 'themeweave'), 
			'priority' 	=> 'low',
			'template' 	=> dirname ( __FILE__ ). '/templates/styles.php',
		));
	}


	/**
	 *  Register required scripts for slider panel in dashboard
	 *
	 * @since	1.0
	 * @access	public 
	 * @link 	http://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 */


	public function admin_scripts(){ 

		global $pagenow;

		if ( $pagenow == 'post-new.php' || $pagenow == 'post.php') {

			wp_enqueue_style( 
				'wpeslider-admin', 
				plugin_dir_url( __FILE__ ) . '/assets/css/meta.css',
				'0.1'
			); 


			wp_enqueue_style( 
				'wpeslider-tipsy-style',  
				plugin_dir_url( __FILE__ ) . 'assets/css/tipsy.css',
				'0.1'
			); 


			wp_enqueue_style( 
				'wpeslider-colorpicker-style',  
				plugin_dir_url( __FILE__ ) . 'assets/css/colorpicker.css',
				'0.1'
			);


			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-widget' );
			wp_enqueue_script( 'jquery-ui-mouse' );
			wp_enqueue_script( 'jquery-ui-sortable' ); 
			wp_enqueue_script( 'jquery-ui-slider' );
			wp_enqueue_media();  


			wp_enqueue_script( 
				'wpeslider-colorpicker-script',  
				plugin_dir_url( __FILE__ ) . 'assets/js/colorpicker.js', 
				array('jquery'),
				'0.1',
				true
			);

		 	wp_enqueue_script( 
		 		'wpeslider-metabox',  
		 		plugin_dir_url( __FILE__ ) . 'assets/js/kia-metabox.js',
		 		array('jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-sortable', 'jquery-ui-slider'),
		 		'0.1',
		 		true
	 		);

		 	wp_enqueue_script( 
		 		'wpeslider-tipsy-script',
		 		plugin_dir_url( __FILE__ ) . 'assets/js/jquery.tipsy.js',
		 		array('jquery'),
		 		'0.1',
		 		true
	 		); 

		 	wp_enqueue_script(
		 		'wpeslider-script',
		 		plugin_dir_url( __FILE__ ) . 'assets/js/eslider.js',
		 		array('wpeslider-tipsy-script', 'wpeslider-colorpicker-script'),
		 		'0.1',
		 		true
 			);
		}

	}



	/**
	 *  Register required scripts in front to work the slider
	 *
	 * @since	1.0
	 * @access	public 
	 * @link 	http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 	*/
	
	public function front_scripts(){
		wp_enqueue_script( 'jquery' ); 
		wp_enqueue_script( 'jquery-easing',  plugin_dir_url( __FILE__ ) . 'slideshow/js/jquery.easing.1.3.js', array('jquery') );
		wp_enqueue_script( 'wpeslider-front-slider',  plugin_dir_url( __FILE__ ) . 'slideshow/js/jquery.eislideshow.js', array('jquery-easing') );
		wp_enqueue_script( 'wpeslider-fonts-js',  plugin_dir_url( __FILE__ ) . 'slideshow/js/wpeslider.js', array('jquery') );

		
		wp_enqueue_style( 'roboto-font', 'http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic');
		wp_enqueue_style( 'wpeslider-front-style',  plugin_dir_url( __FILE__ ) . 'slideshow/css/style.css');
	}



	/**
	 *  Return all jquery easing effect as an array
	 *
	 * @since	1.0
	 * @access	public 
	 * @return 	array
 	*/

	public static function easing(){
		return 	array(
			'linear' 			=> 'linear',
			'swing' 			=> 'swing',
			'jswing' 			=> 'jswing',
			'easeInQuad' 		=> 'easeInQuad',
			'easeInCubic' 		=> 'easeInCubic',
			'easeInQuart' 		=> 'easeInQuart',
			'easeInQuint' 		=> 'easeInQuint',
			'easeInSine' 		=> 'easeInSine',
			'easeInExpo' 		=> 'easeInExpo',
			'easeInCirc' 		=> 'easeInCirc',
			'easeInElastic' 	=> 'easeInElastic',
			'easeInBack' 		=> 'easeInBack',
			'easeInBounce' 		=> 'easeInBounce',
			'easeOutQuad' 		=> 'easeOutQuad',
			'easeOutCubic' 		=> 'easeOutCubic',
			'easeOutQuart' 		=> 'easeOutQuart',
			'easeOutQuint' 		=> 'easeOutQuint',
			'easeOutSine' 		=> 'easeOutSine',
			'easeOutExpo' 		=> 'easeOutExpo',
			'easeOutCirc' 		=> 'easeOutCirc',
			'easeOutElastic' 	=> 'easeOutElastic',
			'easeOutBack' 		=> 'easeOutBack',
			'easeOutBounce' 	=> 'easeOutBounce',
			'easeInOutQuad' 	=> 'easeInOutQuad',
			'easeInOutCubic' 	=> 'easeInOutCubic',
			'easeInOutQuart' 	=> 'easeInOutQuart',
			'easeInOutQuint' 	=> 'easeInOutQuint',
			'easeInOutSine' 	=> 'easeInOutSine',
			'easeInOutExpo' 	=> 'easeInOutExpo',
			'easeInOutCirc' 	=> 'easeInOutCirc',
			'easeInOutElastic' 	=> 'easeInOutElastic',
			'easeInOutBack' 	=> 'easeInOutBack',
			'easeInOutBounce' 	=> 'easeInOutBounce',
	  	);
	} 



	/**
	 *  We remove WordPress default title box because we want to use our own.
	 *  First check the post request, if any title out there grab it.
	 *  Otherwise get the post meta of title and set this as title
	 * If the title still empty, default "Slider #ID" will be set
	 *
	 * @since	1.0
	 * @access	public 
 	*/

	function title( $post_id ){
		if ( get_post_type( $post_id ) == $this->type_name  ){
		 
			remove_action('save_post', array($this, 'title')); 

			$title 			= get_post_meta($post_id, '_name', true );
			$meta_title 	= ( isset( $title['name'] )  && !empty( $title['name'] )) ? $title['name'] : 'Slider #'.$post_id;
			$post_title 	= ( isset( $_POST['_name']['name'] ) && !empty( $_POST['_name']['name'] )) ? $_POST['_name']['name'] : ''; 
			$title 			= ( empty( $post_title )) ? $meta_title : $post_title;

			$my_post = array(
			  'ID'           => $post_id,
			  'post_title' => $title
			);
 
			wp_update_post( $my_post );

			add_action('save_post', array($this, 'title'));
		}
	} 



	/**
	 *  Get an array and convert into html data attribute
	 *
	 * @since	1.0
	 * @access	public 
 	 * @param	array $args required data array that need to be converted
	 * @return 	string
 	*/

	public function parse_data( $args )
	{
		$att = '';

		foreach ( (array)$args as $key => $val) {
			if ( $val != '' ){ 
				$att .= 'data-'. $key . '="' . $val . '" ';
			}
		}

		return $att;
	}



	/**
	 *  Get the slider ID and generate slider
	 *
	 * @since	1.0
	 * @access	public 
 	 * @param	int $id required the slider ID
 	*/


	public function slider( $id ) {

		$eslider = '';

		$query = new Wp_Query( array('id' => $id, 'post_type' => $this->type_name ) );
		if ( $query->have_posts() ) : $query->the_post();
			
			$slides 	= get_post_meta($id, '_slides', true);
			$config 	= get_post_meta($id, '_config', true);
			$style 		= get_post_meta($id, '_styles', true );

			$style 		= wp_parse_args( $style, array(
				'title_size' 		=> '1.1',
				'title_lh' 			=> '1.7',
				'title_color' 		=> '0,0,0',
				'title_bg' 			=> '255,255,255',
				'title_opacity' 	=> '0',
				'caption_size' 		=> 1,
				'caption_lh' 		=> '1.2',
				'caption_color' 	=> '0,0,0',
				'caption_bg' 		=> '255,255,255',
				'caption_opacity' 	=> '0'
			));

			$cfData = array(
				'animation' 	=> $config['animation'],
				'easing' 		=> $config['easing'],
				'autoplay' 		=> $config['autoplay'],
				'interval' 		=> $config['interval'],
				'titlespeed' 	=> $config['titlespeed'],
				'titleeasing' 	=> $config['titleeasing'],
				'thumb' 		=> $config['thumb']
			);

			$cfData = $this->parse_data( $cfData );

			if ( !empty($slides['slides'])) : 
				
				$height 	= ( !empty( $config['height'] )) ? $config['height'].'px' : '400px';
				$eslider 	.= '<div '.$cfData.' style="height:'.$height.'" class="ei-slider">';
				$eslider 	.= '<ul class="ei-slider-large">';
                    
				foreach ( (array)$slides['slides'] as $slide ) : 

					$img =  wp_get_attachment_image_src(  $slide['image'], 'full' );
                    $img = isset( $img[0] ) ? $img[0] : '';
                    $stt = isset( $slide['seo_title'] ) ? ' title="'.$slide['seo_title'].'"' : '';
                    $sat = isset( $slide['alt'] ) ? ' alt="'.$slide['alt'].'"' : '';

					$eslider .= '<li>';
					$eslider .= '<img src="'.$img.'" '.$stt.$sat.' />';
					$eslider .= '<div class="ei-title">';
					
					if ( isset($slide['title']) ){

						$fs = 'font-size:'.$style['title_size'].'em;';
						$lh = 'line-height:'.$style['title_lh'].'em;';
						$cl = 'color: rgb('.$style['title_color'].');';
						$bg = 'rgba( '.$style['title_bg'].' , '.$style['title_opacity'].' )';
						$bg = 'background-color : '.$bg.' ';

						$eslider .= '<h2 style="'.$fs.$lh.$cl.$bg.'" >'.$slide['title'].'</h2>';
					}
						

					if ( isset($slide['caption']) ){
						$fs = 'font-size:'.$style['caption_size'].'em;';
						$lh = 'line-height:'.$style['caption_lh'].'em;';
						$cl = 'color: rgb('.$style['caption_color'].');';
						$bg = 'rgba( '.$style['caption_bg'].' , '.$style['caption_opacity'].' )';
						$bg = 'background-color : '.$bg.' ';

						$eslider .= '<h3 class="wp-eslider-caption" style="'.$fs.$lh.$cl.$bg.'" >'.$slide['caption'].'</h3>';
					}

					$eslider .= '</div>';
					$eslider .= '</li>'; 

				endforeach;

				$eslider .= '</ul>';
				$eslider .= '<ul class="ei-slider-thumbs">';
				$eslider .= '<li class="ei-slider-element">Current</li>';
				

				foreach ( (array)$slides['slides'] as $slide ) : 

					$img =  wp_get_attachment_image_src(  $slide['image']  );
                    $img = isset( $img[0] ) ? $img[0] : '';

					$eslider .= '<li><a href="#">Slide 6</a><img src="'.$img.'" alt="thumb06" /></li>';

				endforeach;

				$eslider .= '</ul>';
				$eslider .= '</div>';

			endif; // !empty

		endif; // have_posts()

		return $eslider;
	}



	/**
	 *  Create the shortcode of the slider
	 *
	 * @since	1.0
	 * @access	public 
 	 * @param	array $atts required required atts for the shortcode
 	*/

	function shortcode( $atts ) {
	    $attr = shortcode_atts( array(
	        'id' => 0,
	    ), $atts );

	    extract($attr);

	    return $this->slider($id);
	}

}

endif;


new WpElasticSlider();

?>