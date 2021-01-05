<?php 
add_action( 'wp_enqueue_scripts', 'techvalens_child_theme_enqueue_styles' );
	function techvalens_child_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 

	wp_enqueue_style( 'font-awesome-min', get_stylesheet_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css' ); 
	wp_enqueue_style( 'bootstrap-min', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css' ); 
	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/style.css' ); 

	wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom-js.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-min', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap-min', get_stylesheet_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ) );
} 
		  

/* Disabled Guternburg Editor */
add_filter('use_block_editor_for_post', '__return_false', 10);


/* Theme Options */
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme Options',
		'menu_title'	=> 'Theme Options',
		'menu_slug' 	=> 'theme-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));		
}

/* Add Anchor Class */
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


/* Registered theme location */
function register_my_menus() {
	register_nav_menus(
	  array(
		'footer-menu' => __( 'Footer Menu' )
	  )
	);
  }
add_action( 'init', 'register_my_menus' );


/* Hide Plugin */
add_filter('acf/settings/show_admin', '__return_false');

// add_filter( 'all_plugins', 'hide_plugins');
// function hide_plugins($plugins)
// {
// 	// Hide hello dolly plugin
// 	if(is_plugin_active('advanced-custom-fields-pro/acf.php')) {
// 		unset( $plugins['advanced-custom-fields-pro/acf.php'] );
// 	}
	
// 	return $plugins;
// }

 ?>