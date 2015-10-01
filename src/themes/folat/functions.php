<?php
/**
 * Folat available functions
 *
 * @package Folat
 *
 * @since 1.0
 */

//setup additional theme features
function folat_setup() {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'folat_setup');

//redirects to homepage on logout
function folat_go_home(){
  wp_redirect( home_url() );
  exit();
}
add_action('wp_logout','folat_go_home');

//enqueue stylesheets
function folat_setup_scripts() {
	//=============== Styles ====================
	// Register bootstrap stylesheet
	wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/bootstrap/css/bootstrap.css');
	wp_enqueue_style('bootstrap-responsive-style', get_template_directory_uri() . '/bootstrap/css/bootstrap-theme.css');
	// Register general stylesheet
	wp_enqueue_style('folat-style', get_stylesheet_uri());

	//================ Scripts ==================
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.js' );
	wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/bootstrap/js/bootstrap.js', array('jquery') );
    wp_enqueue_script( 'main-script', get_template_directory_uri() . '/js/main.js', array('jquery','bootstrap-script') );


}
add_action('wp_enqueue_scripts', 'folat_setup_scripts');



/**
 * Register a slider post type.
 */
function folat_sliders_init() {
  $labels = array(
    'name'               => _x( 'Sliders', 'post type general name', 'folat' ),
    'singular_name'      => _x( 'Slider', 'post type singular name', 'folat' ),
    'menu_name'          => _x( 'Sliders', 'admin menu', 'folat' ),
    'name_admin_bar'     => _x( 'Slider', 'add new on admin bar', 'folat' ),
    'add_new'            => _x( 'Add New', 'Slider', 'folat' ),
    'add_new_item'       => __( 'Add New Slider', 'folat' ),
    'new_item'           => __( 'New Slider', 'folat' ),
    'edit_item'          => __( 'Edit Slider', 'folat' ),
    'view_item'          => __( 'View Slider', 'folat' ),
    'all_items'          => __( 'All Sliders', 'folat' ),
    'search_items'       => __( 'Search Sliders', 'folat' ),
    'parent_item_colon'  => __( 'Parent Sliders:', 'folat' ),
    'not_found'          => __( 'No Sliders found.', 'folat' ),
    'not_found_in_trash' => __( 'No Sliders found in Trash.', 'folat' )
  );

  $args = array(
    'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'slider' ),
    'capability_type'    => 'post',
    'map_meta_cap'       => true,
    'taxonomies'         => array('location'),
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' )
  );

  register_post_type( 'slider', $args );
}
add_action('init', 'folat_sliders_init' );


//Register our sidebars and widgetized areas.
function folat_widgets_init() {

    register_sidebar( array(
        'name'          => 'Home Featured Products',
        'id'            => 'home_featured',
        'before_widget' => '<div class="col-md-4">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="home-feat-widget-title">',
        'after_title'   => '</h2>',
    ) );

}
add_action( 'widgets_init', 'folat_widgets_init' );

?>