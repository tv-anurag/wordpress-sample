<?php
//phpinfo();
add_action('wp_head', 'show_template');
 function show_template() {
    global $template;
    //print_r($template);
}
function urlbucket() {
    global $s3url;
    $s3url = get_template_directory_uri();
    return $s3url;
}


add_action( 'after_setup_theme', 'nice_setup' );
function nice_setup(){
    load_theme_textdomain( 'ni', get_template_directory() . '/languages' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    global $content_width;
    if ( ! isset( $content_width ) ) $content_width = 640;
    register_nav_menus(
    array( //'main-menu' => __( 'Main Menu', 'ni' ), 
        'main-menu-left' => __( 'Main Menu left', 'ni' ), 
        'main-menu-right' => __( 'Main Menu Right', 'ni' ),
        'footer-menu' => __( 'Footer Menu', 'ni' ),
        'mobile-menu' => __( 'Mobile Menu', 'ni' )  )
    );
}

add_action( 'comment_form_before', 'nice_enqueue_comment_reply_script' );
function nice_enqueue_comment_reply_script(){
    if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'nice_title' );
function nice_title( $title ) {
    if ( $title == '' ) {
        return '&rarr;';
        } else {
        return $title;
    }
}
add_filter( 'wp_title', 'nice_filter_wp_title' );
function nice_filter_wp_title( $title ){
    return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'nice_widgets_init' );
function nice_widgets_init(){
    register_sidebar( array (
    'name' => __( 'Sidebar Widget Area', 'ni' ),
    'id' => 'primary-widget-area',
    'before_widget' => '<div class="widgets">',
    'after_widget' => "</div>",
    'before_title' => '<h1>',
    'after_title' => '</h1>',
    ) );

    register_sidebar( array (
        'name' => __( 'Subscribe Widget Area', 'ni' ),
        'id' => 'subscribe-widget-area',
        'before_widget' => '<div class="widgets">',
        'after_widget' => "</div>",
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );

    register_sidebar( array (
        'name' => __( 'Footer Widget Area 1', 'ni' ),
        'id' => 'footer-widget-area-1',
        'before_widget' => '<div class="widgets">',
        'after_widget' => "</div>",
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );

    register_sidebar( array (
        'name' => __( 'Footer Widget Area 2', 'ni' ),
        'id' => 'footer-widget-area-2',
        'before_widget' => '<div class="widgets">',
        'after_widget' => "</div>",
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array (
        'name' => __( 'Footer Widget Area 3', 'ni' ),
        'id' => 'footer-widget-area-3',
        'before_widget' => '<div class="widgets">',
        'after_widget' => "</div>",
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array (
        'name' => __( 'Footer Widget Area 4', 'ni' ),
        'id' => 'footer-widget-area-4',
        'before_widget' => '<div class="widgets">',
        'after_widget' => "</div>",
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array (
        'name' => __( 'Footer Widget Area 5', 'ni' ),
        'id' => 'footer-widget-area-5',
        'before_widget' => '<div class="widgets">',
        'after_widget' => "</div>",
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
    register_sidebar( array (
        'name' => __( 'Bottom Footer Widget Area', 'ni' ),
        'id' => 'bottom-footer-widget-area',
        'before_widget' => '<div class="widgets">',
        'after_widget' => "</div>",
        'before_title' => '<h1>',
        'after_title' => '</h1>',
    ) );
}


function wpdocs_theme_name_scripts() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/main-style.css');


    wp_enqueue_script( 'bootstrap-min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '1.0.0', true );
    wp_enqueue_style( 'style',   get_template_directory_uri() . '/style.css');      
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );


class bootstrap_4_walker_nav_menu extends Walker_Nav_menu {    
    function start_lvl( &$output, $depth = 0, $args = array() ){
        $indent = str_repeat("\t",$depth); // indents the outputted HTML
        $submenu = ($depth > 0) ? ' sub-menu' : '';
        $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
    }
  
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ // li a span        
    $indent = ( $depth ) ? str_repeat("\t",$depth) : '';    
    $li_attributes = '';
        $class_names = $value = '';    
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;        
        $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
        $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
        $classes[] = 'nav-item';
        $classes[] = 'nav-item-' . $item->ID;
        if( $depth && $args->walker->has_children ){
            $classes[] = 'dropdown-menu';
        }        
        $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names = ' class="' . esc_attr($class_names) . '"';        
        $id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
        $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';        
        $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';        
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';        
        $attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';
        $item_output = $args->before;
        $item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

//Add Log in site identity
function grs_custom_logo_setup() {
    $defaults = array(
        'height'      => 183,
        'width'       => 139,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'grs_custom_logo_setup' );


/*
* Creating a function to create our CPT Free Illustrations
*/

/*function ni_freeillustration_post_type() {
    $labels = array(
        'name'                => _x( 'Free Illustrations', 'Post Type General Name', 'ni' ),
        'singular_name'       => _x( 'Free Illustrations', 'Post Type Singular Name', 'ni' ),
        'menu_name'           => __( 'Free Illustrations', 'ni' ),
        'parent_item_colon'   => __( 'Parent Free Illustrations', 'ni' ),
        'all_items'           => __( 'All Free Illustrations', 'ni' ),
        'view_item'           => __( 'View Free Illustrations', 'ni' ),
        'add_new_item'        => __( 'Add New Free Illustrations', 'ni' ),
        'add_new'             => __( 'Add New', 'ni' ),
        'edit_item'           => __( 'Edit Free Illustrations', 'ni' ),
        'update_item'         => __( 'Update Free Illustrations', 'ni' ),
        'search_items'        => __( 'Search Free Illustrations', 'ni' ),
        'not_found'           => __( 'Not Found', 'ni' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ni' ),
    );
    $args = array(
        'label'               => __( 'Free Illustrations', 'ni' ),
        'description'         => __( 'Free Illustrations news and reviews', 'ni' ),
        'labels'              => $labels,       
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
    
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-art',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'            => array( 'slug' => '' ),
    );
    register_post_type( 'freeillustration', $args );
}
add_action( 'init', 'ni_freeillustration_post_type', 0 );
add_action( 'init', 'ni_freeillustration_taxonomies', 0 );
function ni_freeillustration_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Category', 'textdomain' ),
        'all_items'         => __( 'All Category', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'textdomain' ),
        'menu_name'         => __( 'Category', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'free-category' ),
    );
    register_taxonomy( 'freeillustrationcat', array( 'freeillustration' ), $args );
}*/

/*
* Creating a function to create our CPT Illustration Packs
*/

function ni_illustrationpacks_post_type() {
    $labels = array(
        'name'                => _x( 'Illustration Packs', 'Post Type General Name', 'ni' ),
        'singular_name'       => _x( 'Illustration Packs', 'Post Type Singular Name', 'ni' ),
        'menu_name'           => __( 'Illustration Packs', 'ni' ),
        'parent_item_colon'   => __( 'Parent Illustration Packs', 'ni' ),
        'all_items'           => __( 'All Illustration Packs', 'ni' ),
        'view_item'           => __( 'View Illustration Packs', 'ni' ),
        'add_new_item'        => __( 'Add New Illustration Packs', 'ni' ),
        'add_new'             => __( 'Add New', 'ni' ),
        'edit_item'           => __( 'Edit Illustration Packs', 'ni' ),
        'update_item'         => __( 'Update Illustration Packs', 'ni' ),
        'search_items'        => __( 'Search Illustration Packs', 'ni' ),
        'not_found'           => __( 'Not Found', 'ni' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ni' ),
    );
    $args = array(
        'label'               => __( 'Illustration Packs', 'ni' ),
        'description'         => __( 'Illustration Packs news and reviews', 'ni' ),
        'labels'              => $labels,       
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
    
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-images-alt2',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'            => array( 'slug' => '' ),
    );
    register_post_type( 'illustrationpacks', $args );
}
add_action( 'init', 'ni_illustrationpacks_post_type', 0 );
add_action( 'init', 'ni_illustrationpacks_taxonomies', 0 );
function ni_illustrationpacks_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Category', 'textdomain' ),
        'all_items'         => __( 'All Category', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'textdomain' ),
        'menu_name'         => __( 'Category', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'packs-category' ),
    );
    register_taxonomy( 'illustrationpackscat', array( 'illustrationpacks' ), $args );
}


/*
* Creating a function to create our CPT Illustration Systems
*/

function ni_illustrationsystems_post_type() {
    $labels = array(
        'name'                => _x( 'Illustration Systems', 'Post Type General Name', 'ni' ),
        'singular_name'       => _x( 'Illustration Systems', 'Post Type Singular Name', 'ni' ),
        'menu_name'           => __( 'Illustration Systems', 'ni' ),
        'parent_item_colon'   => __( 'Parent Illustration Systems', 'ni' ),
        'all_items'           => __( 'All Illustration Systems', 'ni' ),
        'view_item'           => __( 'View Illustration Systems', 'ni' ),
        'add_new_item'        => __( 'Add New Illustration Systems', 'ni' ),
        'add_new'             => __( 'Add New', 'ni' ),
        'edit_item'           => __( 'Edit Illustration Systems', 'ni' ),
        'update_item'         => __( 'Update Illustration Systems', 'ni' ),
        'search_items'        => __( 'Search Illustration Systems', 'ni' ),
        'not_found'           => __( 'Not Found', 'ni' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ni' ),
    );
    $args = array(
        'label'               => __( 'Illustration Systems', 'ni' ),
        'description'         => __( 'Illustration Systems news and reviews', 'ni' ),
        'labels'              => $labels,       
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
    
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-list-view',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'            => array( 'slug' => '' ),
    );
    register_post_type( 'illustrationsystems', $args );
}
add_action( 'init', 'ni_illustrationsystems_post_type', 0 );
add_action( 'init', 'ni_illustrationsystems_taxonomies', 0 );
function ni_illustrationsystems_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Category', 'textdomain' ),
        'all_items'         => __( 'All Category', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'textdomain' ),
        'menu_name'         => __( 'Category', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'systems-category' ),
    );
    register_taxonomy( 'illustrationsystemscat', array( 'illustrationsystems' ), $args );
}


/*
* Creating a function to create our CPT Animated Illustration
*/

function ni_animatedillustration_post_type() {
    $labels = array(
        'name'                => _x( 'Animated Illustration', 'Post Type General Name', 'ni' ),
        'singular_name'       => _x( 'Animated Illustration', 'Post Type Singular Name', 'ni' ),
        'menu_name'           => __( 'Animated Illustration', 'ni' ),
        'parent_item_colon'   => __( 'Parent Animated Illustration', 'ni' ),
        'all_items'           => __( 'All Animated Illustration', 'ni' ),
        'view_item'           => __( 'View Animated Illustration', 'ni' ),
        'add_new_item'        => __( 'Add New Animated Illustration', 'ni' ),
        'add_new'             => __( 'Add New', 'ni' ),
        'edit_item'           => __( 'Edit Animated Illustration', 'ni' ),
        'update_item'         => __( 'Update Animated Illustration', 'ni' ),
        'search_items'        => __( 'Search Animated Illustration', 'ni' ),
        'not_found'           => __( 'Not Found', 'ni' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ni' ),
    );
    $args = array(
        'label'               => __( 'Animated Illustration', 'ni' ),
        'description'         => __( 'Animated Illustration news and reviews', 'ni' ),
        'labels'              => $labels,       
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
    
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-image-filter',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'            => array( 'slug' => '' ),
    );
    register_post_type( 'animatedillustration', $args );
}
add_action( 'init', 'ni_animatedillustration_post_type', 0 );
add_action( 'init', 'ni_animatedillustration_taxonomies', 0 );
function ni_animatedillustration_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Category', 'textdomain' ),
        'all_items'         => __( 'All Category', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'textdomain' ),
        'menu_name'         => __( 'Category', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'animated-category' ),
    );
    register_taxonomy( 'animatedillustrationcat', array( 'animatedillustration' ), $args );
}


/*
* Creating a function to create our CPT Icons
*/

function ni_icons_post_type() {
    $labels = array(
        'name'                => _x( 'Icons', 'Post Type General Name', 'ni' ),
        'singular_name'       => _x( 'Icons', 'Post Type Singular Name', 'ni' ),
        'menu_name'           => __( 'Icons', 'ni' ),
        'parent_item_colon'   => __( 'Parent Icons', 'ni' ),
        'all_items'           => __( 'All Icons', 'ni' ),
        'view_item'           => __( 'View Icons', 'ni' ),
        'add_new_item'        => __( 'Add New Icons', 'ni' ),
        'add_new'             => __( 'Add New', 'ni' ),
        'edit_item'           => __( 'Edit Icons', 'ni' ),
        'update_item'         => __( 'Update Icons', 'ni' ),
        'search_items'        => __( 'Search Icons', 'ni' ),
        'not_found'           => __( 'Not Found', 'ni' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ni' ),
    );
    $args = array(
        'label'               => __( 'Icons', 'ni' ),
        'description'         => __( 'Icons news and reviews', 'ni' ),
        'labels'              => $labels,       
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
    
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-nametag',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'            => array( 'slug' => '' ),
    );
    register_post_type( 'icons', $args );
}
add_action( 'init', 'ni_icons_post_type', 0 );
add_action( 'init', 'ni_icons_taxonomies', 0 );
function ni_icons_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Category', 'textdomain' ),
        'all_items'         => __( 'All Category', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'textdomain' ),
        'menu_name'         => __( 'Category', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'icons-category' ),
    );
    register_taxonomy( 'iconscat', array( 'icons' ), $args );
}


/*
* Creating a function to create our CPT FAQ
*/

function ni_faq_post_type() {
    $labels = array(
        'name'                => _x( 'FAQ', 'Post Type General Name', 'ni' ),
        'singular_name'       => _x( 'FAQ', 'Post Type Singular Name', 'ni' ),
        'menu_name'           => __( 'FAQ', 'ni' ),
        'parent_item_colon'   => __( 'Parent FAQ', 'ni' ),
        'all_items'           => __( 'All FAQ', 'ni' ),
        'view_item'           => __( 'View FAQ', 'ni' ),
        'add_new_item'        => __( 'Add New FAQ', 'ni' ),
        'add_new'             => __( 'Add New', 'ni' ),
        'edit_item'           => __( 'Edit FAQ', 'ni' ),
        'update_item'         => __( 'Update FAQ', 'ni' ),
        'search_items'        => __( 'Search FAQ', 'ni' ),
        'not_found'           => __( 'Not Found', 'ni' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'ni' ),
    );
    $args = array(
        'label'               => __( 'FAQ', 'ni' ),
        'description'         => __( 'FAQ news and reviews', 'ni' ),
        'labels'              => $labels,       
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        'taxonomies'          => array( 'genres' ),
    
        'hierarchical'        => false,
        'menu_icon'           => 'dashicons-align-right',
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'rewrite'            => array( 'slug' => '' ),
    );
    register_post_type( 'nifaq', $args );
}
add_action( 'init', 'ni_faq_post_type', 0 );
add_action( 'init', 'ni_faq_taxonomies', 0 );
function ni_faq_taxonomies() {
    $labels = array(
        'name'              => _x( 'Category', 'taxonomy general name', 'textdomain' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name', 'textdomain' ),
        'search_items'      => __( 'Search Category', 'textdomain' ),
        'all_items'         => __( 'All Category', 'textdomain' ),
        'parent_item'       => __( 'Parent Category', 'textdomain' ),
        'parent_item_colon' => __( 'Parent Category:', 'textdomain' ),
        'edit_item'         => __( 'Edit Category', 'textdomain' ),
        'update_item'       => __( 'Update Category', 'textdomain' ),
        'add_new_item'      => __( 'Add New Category', 'textdomain' ),
        'new_item_name'     => __( 'New Category Name', 'textdomain' ),
        'menu_name'         => __( 'Category', 'textdomain' ),
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'faqs-category' ),
    );
    register_taxonomy( 'nifaqcat', array( 'nifaq' ), $args );
}


// create shortcode to FAQ [faqs terms='free-illustrations']
add_shortcode( 'faqs', 'faqs_shortcode' );
function faqs_shortcode( $atts ) {
    ob_start();
	extract( shortcode_atts( array (
        'terms' => '',
    ), $atts ) );
    $args = array(
        'post_type' => 'nifaq',
        'posts_per_page' => -1,
        'order' => 'ASC'
    );
    if ( ! empty( $terms ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'nifaqcat',
                'field'    => 'slug',
                'terms'    => $terms,
            ),
        );
    }
    $query = new WP_Query($args);
    if ( $query->have_posts() ) { ?>
        <h1 class="section-head"><?php _e( 'Frequently Asked Questions', 'ni' ); ?></h1>
        <div class="faqbox">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="faqboxinner">
                  <h1><?php the_title(); ?></h1>
                  <p><?php the_content(); ?></p>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}

// create shortcode to freeillustraters [freeillustrater terms='free-illustrations']
add_shortcode( 'freeillustrater', 'freeillustraters_shortcode' );
function freeillustraters_shortcode( $atts ) {
    ob_start();
    extract( shortcode_atts( array (
        'terms' => '',
    ), $atts ) );
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'order' => 'ASC'
    );
    if ( ! empty( $terms ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $terms,
            ),
        );
    }
    $query = new WP_Query($args);
    if ( $query->have_posts() ) { 
        $terms = get_term_by('slug', $terms, 'category'); 
        $term_link = get_term_link( $terms );
        $id = $term->term_id;
    ?>
        <h1 class="cattitle"><a href="<?php echo esc_url( $term_link ); ?>"><?php echo  $terms->name; ?> <span><?php echo $count = $query->found_posts; ?> <?php _e( 'Illustrations', 'ni' ); ?></span></a></h1>
         <div class="row">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="col-md-4">
                  <div class="catbox">
                    <a href="<?php echo esc_url( $term_link ); ?>">
                         <?php the_post_thumbnail(array(400, 300)); ?>               
                    </a>
                  </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}

// Change dashboard Posts to News
add_action( 'init', 'cp_change_post_object' );
function cp_change_post_object() {
    $get_post_type = get_post_type_object('post');
    $labels = $get_post_type->labels;
    $labels->name = 'Free Illustration';
    $labels->singular_name = 'Free Illustration';
    $labels->add_new = 'Add Free Illustration';
    $labels->add_new_item = 'Add Free Illustration';
    $labels->edit_item = 'Edit Free Illustration';
    $labels->new_item = 'Free Illustration';
    $labels->view_item = 'View Free Illustration';
    $labels->search_items = 'Search Free Illustration';
    $labels->not_found = 'No News found';
    $labels->not_found_in_trash = 'No News found in Trash';
    $labels->all_items = 'All Free Illustration';
    $labels->menu_name = 'Free Illustration';
    $labels->name_admin_bar = 'Free Illustration';
}

function my_page_columns($columns) {
    $columns['product_price'] = 'Product price';
    return $columns;
}
function my_custom_columns($column) {
 global $post;
    if($column == 'product_price') {
      echo '$ '.get_field('product_price', $post->ID);
    } else {  echo '';   }
}
add_action("manage_icons_posts_custom_column", "my_custom_columns", 4, 2);
add_filter("manage_edit-icons_columns", "my_page_columns", 4);

add_action("manage_illustrationpacks_posts_custom_column", "my_custom_columns", 4, 2);
add_filter("manage_edit-illustrationpacks_columns", "my_page_columns", 4);

add_action("manage_illustrationsystems_posts_custom_column", "my_custom_columns", 4, 2);
add_filter("manage_edit-illustrationsystems_columns", "my_page_columns", 4);

add_action("manage_animatedillustration_posts_custom_column", "my_custom_columns", 4, 2);
add_filter("manage_edit-animatedillustration_columns", "my_page_columns", 4);

add_action("manage_post_posts_custom_column", "my_custom_columns", 4, 2);
add_filter("manage_edit-post_columns", "my_page_columns", 4);