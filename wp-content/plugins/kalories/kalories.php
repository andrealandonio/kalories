<?php
/*
Plugin Name: Kalories
Description: Setup Kalories WordPress environment (creates users, custom post type 'meal' and contains some utility functions).
Author: lando1982
Author URI: http://www.andrealandonio.it
Version: 1.0.0
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

// Path missing "__DIR__" constant on environment
if ( ! defined( '__DIR__' ) ) {
    define( '__DIR__', dirname( __FILE__ ) );
}

/**
 * Constants
 */
define( 'KAL_VERSION', '1.0.0' );
define( 'KAL_PREFIX', 'kalories' );
define( 'KAL_NONCE', 'kalories_nonce' );

/**
 * Requires
 */
require_once( __DIR__ . '/kalories-actions.php' );
require_once( __DIR__ . '/kalories-database.php' );

/**
 * Register activation hook
 */
function kalories_plugin_activation() {
	// Create test user (user1)
	$user1 = get_user_by( 'user_login', 'user1' );
	if ( empty( $user1) ) {
		wp_insert_user( array(
			'user_login' => 'user1',
			'user_pass' => 'user1'
		) ) ;
	}

	// Create test user (user2)
	$user2 = get_user_by( 'user_login', 'user2' );
	if ( empty( $user2) ) {
		wp_insert_user( array(
			'user_login' => 'user2',
			'user_pass' => 'user2'
		) );
	}

	// Create test user (user3)
	$user3 = get_user_by( 'user_login', 'user3' );
	if ( empty( $user3) ) {
		wp_insert_user( array(
			'user_login' => 'user3',
			'user_pass' => 'user3'
		) ) ;
	}
}
register_activation_hook( WP_PLUGIN_DIR . '/kalories/kalories.php', 'kalories_plugin_activation' );

/**
 * Register deactivation hook
 */
function kalories_plugin_deactivation() {
	// Delete test user (user1)
	$user1 = get_user_by( 'user_login', 'user1' );
	if ( ! empty( $user1) ) wp_delete_user( $user1->ID );

	// Delete test user (user2)
	$user2 = get_user_by( 'user_login', 'user2' );
	if ( ! empty( $user2) ) wp_delete_user( $user2->ID );

	// Delete test user (user3)
	$user3 = get_user_by( 'user_login', 'user3' );
	if ( ! empty( $user3) ) wp_delete_user( $user3->ID );
}
register_deactivation_hook( WP_PLUGIN_DIR . '/kalories/kalories.php', 'kalories_plugin_deactivation' );

/**
 * Register meal post type
 */
function kalories_setup_cpt_meal_init() {
    $args = array(
        'labels' => array(
            'name' => 'Meals',
            'singular_name' => 'Meal',
            'menu_name' => 'Meals',
            'name_admin_bar' => 'Meal',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Meal',
            'new_item' => 'New Meal',
            'edit_item' => 'Edit Meal',
            'view_item' => 'View Meal',
            'all_items'  => 'All Meals',
            'search_items' => 'Search Meals',
            'parent_item_colon' => 'Parent Meals:',
            'not_found' => 'No meals found.',
            'not_found_in_trash' => 'No meals found in Trash.'
        ),
        'description' => 'Description',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'meal' ),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor', 'excerpt' )
    );

    register_post_type( 'meal', $args );
}
add_action( 'init', 'kalories_setup_cpt_meal_init' );

/**
 * Theme setup
 */
function kalories_theme_setup() {
	// Set default timezone
	date_default_timezone_set( 'Europe/Rome' );

	// Enqueue styles
	kalories_enqueue_css();

	// Enqueue scripts
	kalories_enqueue_js();
}
add_action( 'after_setup_theme', 'kalories_theme_setup' );

/**
 * Enqueue styles
 */
function kalories_enqueue_css() {
	// Enqueue kalories CSS
	wp_enqueue_style( 'kalories_style', plugins_url( 'kalories/css/kalories.css' ) );
}

/**
 * Enqueue scripts
 */
function kalories_enqueue_js() {
	// Enqueue jQuery validate JS
	wp_enqueue_script( 'jquery-validate', plugins_url( 'kalories/js/jquery.validate.min.js' ), array( 'jquery' ), '1.10.0', true );

	// Enqueue kalories JS
	wp_register_script( 'kalories_script', plugins_url( 'kalories/js/kalories.js' ), array( 'jquery' ) );
	wp_enqueue_script( 'kalories_script' );
}

