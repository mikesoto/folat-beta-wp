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


}
add_action('wp_enqueue_scripts', 'folat_setup_scripts');


?>