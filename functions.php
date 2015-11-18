<?php

if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}

Timber::$dirname = array('templates', 'views');

class StarterSite extends TimberSite {

	function __construct() {
		add_theme_support( 'post-formats' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'menus' );
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		add_filter( 'get_twig', array( $this, 'add_to_twig' ) );
		add_action( 'init', array( $this, 'register_post_types' ) );
		add_action( 'init', array( $this, 'register_taxonomies' ) );
		parent::__construct();
	}

	function register_post_types() {

		// Presentations
		register_post_type('presentations',
			array(
			'labels' => array(
				'name' => _x('Presentations', 'post type general name', 'preach'),
				'singular_name' => _x('Presentation', 'post type singular name', 'preach'),
				'add_new' => _x('Add New', 'Presentation', 'preach'),
				'add_new_item' => __('Add New Presentation', 'preach'),
				'edit_item' => __('Edit Presentation', 'preach'),
				'new_item' => __('New Presentation', 'preach'),
				'view_item' => __('View Presentation', 'preach'),
				'search_items' => __('Search Presentations', 'preach'),
				'not_found' => __('No Presentations found', 'preach'),
				'not_found_in_trash' => __('No Presentations found in Trash', 'preach'),
				'parent' => __('Parent Presentation', 'preach'),
			),
			'public' => true,
			'menu_icon' => 'dashicons-welcome-view-site',
			'menu_position' => 5,
			'hierarchical' => true,
			'has_archive' => false,
			'supports' => array('title','thumbnail', 'excerpt'),
			'rewrite' => array('slug' => _x('presentations', 'URL slug', 'preach'), 'with_front' => false)
			)
		);

		// Master Slides
		register_post_type('masterslides',
			array(
			'labels' => array(
				'name' => _x('Master Slides', 'post type general name', 'preach'),
				'singular_name' => _x('Master Slide', 'post type singular name', 'preach'),
				'add_new' => _x('Add New', 'Master Slide', 'preach'),
				'add_new_item' => __('Add New Master Slide', 'preach'),
				'edit_item' => __('Edit Master Slide', 'preach'),
				'new_item' => __('New Master Slide', 'preach'),
				'view_item' => __('View Master Slide', 'preach'),
				'search_items' => __('Search Master Slide', 'preach'),
				'not_found' => __('No Master Slides found', 'preach'),
				'not_found_in_trash' => __('No Master Slides found in Trash', 'preach'),
				'parent' => __('Parent Master Slide', 'preach'),
			),
			'public' => true,
			'menu_icon' => 'dashicons-slides',
			'menu_position' => 6,
			'hierarchical' => true,
			'has_archive' => false,
			'supports' => array('title','thumbnail', 'excerpt'),
			'rewrite' => array('slug' => _x('masterslides', 'URL slug', 'preach'), 'with_front' => false)
			)
		);

		// Case Studies
		register_post_type('cases',
			array(
			'labels' => array(
				'name' => _x('Case Studies', 'post type general name', 'preach'),
				'singular_name' => _x('Case Study', 'post type singular name', 'preach'),
				'add_new' => _x('Add New', 'Case Study', 'preach'),
				'add_new_item' => __('Add New Case Study', 'preach'),
				'edit_item' => __('Edit Case Study', 'preach'),
				'new_item' => __('New Case Study', 'preach'),
				'view_item' => __('View Case Study', 'preach'),
				'search_items' => __('Search Case Studies', 'preach'),
				'not_found' => __('No Case Studies found', 'preach'),
				'not_found_in_trash' => __('No Case Studies found in Trash', 'preach'),
				'parent' => __('Parent Case Study', 'preach'),
			),
			'public' => true,
			'menu_icon' => 'dashicons-media-interactive',
			'menu_position' => 7,
			'hierarchical' => true,
			'has_archive' => false,
			'supports' => array('title','thumbnail', 'excerpt'),
			'rewrite' => array('slug' => _x('cases', 'URL slug', 'preach'), 'with_front' => false)
			)
		);

		// Network
		register_post_type('network',
			array(
			'labels' => array(
				'name' => _x('Network', 'post type general name', 'preach'),
				'singular_name' => _x('Person', 'post type singular name', 'preach'),
				'add_new' => _x('Add New', 'Person', 'preach'),
				'add_new_item' => __('Add New Person', 'preach'),
				'edit_item' => __('Edit Person', 'preach'),
				'new_item' => __('New Person', 'preach'),
				'view_item' => __('View People', 'preach'),
				'search_items' => __('Search People', 'preach'),
				'not_found' => __('No People found', 'preach'),
				'not_found_in_trash' => __('No People found in Trash', 'preach'),
				'parent' => __('Parent Person', 'preach'),
			),
			'public' => true,
			'menu_icon' => 'dashicons-networking',
			'menu_position' => 8,
			'hierarchical' => true,
			'has_archive' => false,
			'supports' => array('title','thumbnail', 'excerpt'),
			'rewrite' => array('slug' => _x('network', 'URL slug', 'preach'), 'with_front' => false)
			)
		);

		


	}

	function register_taxonomies() {
		//this is where you can register custom taxonomies
	}

	function add_to_context( $context ) {
		$context['foo'] = 'lutjebroek';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::get_context();';
		$context['menu'] = new TimberMenu();
		$context['site'] = $this;
		return $context;
	}

	function add_to_twig( $twig ) {
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension( new Twig_Extension_StringLoader() );
		$twig->addFilter( 'myfoo', new Twig_Filter_Function( 'myfoo' ) );
		return $twig;
	}

}

new StarterSite();

function myfoo( $text ) {
	$text .= ' bar!';
	return $text;
}
