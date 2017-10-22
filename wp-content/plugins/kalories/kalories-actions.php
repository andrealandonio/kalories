<?php
/**
 * Requires
 */
require_once( __DIR__ . '/kalories-database.php' );

/**
 * Get meal service callback
 */
function kalories_get_meal_callback() {
	// Check nonce
	if ( !wp_verify_nonce( $_REQUEST[ 'nonce' ], KAL_NONCE ) ) {
		die( 'No naughty business please' );
	}

	// Read data parameters
	$id = sanitize_text_field( $_POST[ 'id' ] );

	// Get meal
	$meal = kalories_get_meal( $id );

	// Return JSON response
	wp_send_json( $meal );
}
add_action( 'wp_ajax_kalories_get_meal', 'kalories_get_meal_callback' );
add_action( 'wp_ajax_nopriv_kalories_get_meal', 'kalories_get_meal_callback' );

/**
 * Save meal service callback
 */
function kalories_save_meal_callback() {
	// Check nonce
	if ( !wp_verify_nonce( $_REQUEST[ 'nonce' ], KAL_NONCE ) ) {
		die( 'No naughty business please' );
	}

	// Read data parameters
	$id = sanitize_text_field( $_POST[ 'id' ] );
	$user_id = (int) sanitize_text_field( $_POST[ 'user_id' ] );
	$description = (string) sanitize_text_field( $_POST[ 'description' ] );
	$date = (int) sanitize_text_field( $_POST[ 'date' ] );
	$time = (int) sanitize_text_field( $_POST[ 'time' ] );
	$calories = (int) sanitize_text_field( $_POST[ 'calories' ] );

	// Check id value to detect if action is an insert or an update
	if ( $id != 0 ) {
		// Modify meal
		kalories_modify_meal( $id, $user_id, $description, $date, $time, $calories );
	}
	else {
		// Add meal
		kalories_insert_meal( $user_id, $description, $date, $time, $calories );
	}

	// Get meal list
	$meal_list = kalories_get_meal_list( $user_id );

	// Show meal_list in table
	kalories_show_meal_list( $meal_list, $user_id );

	die();
}
add_action( 'wp_ajax_kalories_save_meal', 'kalories_save_meal_callback' );
add_action( 'wp_ajax_nopriv_kalories_save_meal', 'kalories_save_meal_callback' );

/**
 * Delete meal service callback
 */
function kalories_delete_meal_callback() {
	// Check nonce
	if ( !wp_verify_nonce( $_REQUEST[ 'nonce' ], KAL_NONCE ) ) {
		die( 'No naughty business please' );
	}

	// Read parameters
	$id = sanitize_text_field( $_POST[ 'id' ] );
	$user_id = (int) sanitize_text_field( $_POST[ 'user_id' ] );

	// Delete meal
	kalories_delete_meal( $id );

	// Get meal list
	$meal_list = kalories_get_meal_list( $user_id );

	// Show meal_list in table
	kalories_show_meal_list( $meal_list, $user_id );

    die();
}
add_action( 'wp_ajax_kalories_delete_meal', 'kalories_delete_meal_callback' );
add_action( 'wp_ajax_nopriv_kalories_delete_meal', 'kalories_delete_meal_callback' );

/**
 * Save preferences callback
 */
function kalories_save_preferences_callback() {
	// Check nonce
	if ( !wp_verify_nonce( $_REQUEST[ 'nonce' ], KAL_NONCE ) ) {
		die( 'No naughty business please' );
	}

	// Read parameters
	$user_id = (int) sanitize_text_field( $_POST[ 'user_id' ] );
	$threshold = (int) sanitize_text_field( $_POST[ 'threshold' ] );

	// Check user id and preferences are valid
	if ( is_int( $user_id ) && is_int( $threshold ) && $user_id != 0 && $threshold > 0 ) {
		// Modify preferences
		kalories_save_preferences( $user_id, $threshold );

		// Get meal list
		$meal_list = kalories_get_meal_list( $user_id );

		// Show meal_list in table
		kalories_show_meal_list( $meal_list, $user_id );
	}

	die();
}
add_action( 'wp_ajax_kalories_save_preferences', 'kalories_save_preferences_callback' );
add_action( 'wp_ajax_nopriv_kalories_save_preferences', 'kalories_save_preferences_callback' );

/**
 * Filter meal service callback
 */
function kalories_filter_meal_callback() {
	// Check nonce
	if ( !wp_verify_nonce( $_REQUEST[ 'nonce' ], KAL_NONCE ) ) {
		die( 'No naughty business please' );
	}

	// Read data parameters
	$user_id = (int) sanitize_text_field( $_POST[ 'user_id' ] );
	$filter_start = sanitize_text_field( $_POST[ 'filter_start' ] );
	$filter_end = sanitize_text_field( $_POST[ 'filter_end' ] );

	// Filter meal
	$amount = kalories_filter_meal( $user_id, $filter_start, $filter_end );

	// Return JSON response
	wp_send_json( $amount );
}
add_action( 'wp_ajax_kalories_filter_meal', 'kalories_filter_meal_callback' );
add_action( 'wp_ajax_nopriv_kalories_filter_meal', 'kalories_filter_meal_callback' );
