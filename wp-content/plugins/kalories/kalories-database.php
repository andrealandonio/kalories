<?php
/**
 * Requires
 */
require_once( __DIR__ . '/classes/meal.php' );

/**
 * Retrieve meal
 *
 * @param int $id
 *
 * @return Meal
 */
function kalories_get_meal( $id ) {
	// Get meal
	$post = get_post( $id );

	// Get meal metas
	$date = get_post_meta( $id, 'meal_date', true );
	$time = get_post_meta( $id, 'meal_time', true );
	$calories  = get_post_meta( $id, 'meal_calories', true );

	// Create meal object
	$meal = new Meal( $post->ID, $post->post_author, $post->post_title, $date, $time, $calories );

	return $meal;
}

/**
 * Retrieve meal list
 *
 * @param int $user_id
 *
 * @return array
 */
function kalories_get_meal_list( $user_id ) {
	// Retrieve meal list
	$args = array(
		'post_type' => 'meal',
		'author' => $user_id,
		'meta_key' => 'meal_date',
		'orderby' => 'meta_value_num',
		'order' => 'DESC'
	);
	$query = new WP_Query( $args );

	// Loop result
    $results = array();
	while ( $query->have_posts() ) {
		$query->the_post();
        $post = get_post();

        // Get meal meta
        $date = get_post_meta( $post->ID, 'meal_date', true );
		$time = get_post_meta( $post->ID, 'meal_time', true );
		$calories = get_post_meta( $post->ID, 'meal_calories', true );

        // Create meal object
		$meal = new Meal( $post->ID, $user_id, $post->post_title, $date, $time, $calories );

		// Add meal to result array
		$results[] = $meal;
	}

	// Resets
	wp_reset_query();
	wp_reset_postdata();

	return $results;
}

/**
 * Show meal list
 *
 * @param array $meal_list
 * @param int $user_id
 */
function kalories_show_meal_list( $meal_list, $user_id ) {
	// Retrieve user threshold
	$threshold = get_user_meta( $user_id, 'meal_daily_threshold', true );

	/**
	 * @var Meal $meal
	 */
    foreach ( $meal_list as $meal ) {
        ?>
        <tr id="meal-<?php echo $meal->get_id() ?>" class="<?php echo ( $meal->get_calories() > (int) $threshold ) ? 'bad' : 'good' ?>" valign="top">
            <td class="label-column"><?php echo $meal->get_description() ?></td>
            <td class="date-column"><?php echo $meal->get_date() ?> - <?php echo $meal->get_time() ?></td>
            <td class="label-column"><?php echo $meal->get_calories() ?></td>
            <td class="options-column">
                <a href="javascript:void(0)" class="modify_row" onclick="modify_meal(<?php echo $meal->get_id() ?>)"><?php _e( 'Modify', KAL_PREFIX ) ?></a>&nbsp;
                <a href="javascript:void(0)" class="delete_row" onclick="delete_meal(<?php echo $meal->get_id() ?>)"><?php _e( 'Delete', KAL_PREFIX ) ?></a>
            </td>
        </tr>
        <?php
    }
}

/**
 * Insert meal
 *
 * @param int $user_id
 * @param string $description
 * @param int $date
 * @param int $time
 * @param int $calories
 */
function kalories_insert_meal( $user_id, $description, $date, $time, $calories ) {
    // Insert meal
	$post_id = wp_insert_post( array(
		'post_author' => $user_id,
		'post_title' => $description,
		'post_status' => 'publish',
		'post_type' => 'meal',
        'post_parent' => 0
    ) );

	// Add meal metas
	add_post_meta( $post_id, 'meal_date', $date, true );
	add_post_meta( $post_id, 'meal_time', $time, true );
	add_post_meta( $post_id, 'meal_calories', $calories, true );
}

/**
 * Modify meal
 *
 * @param int $post_id
 * @param int $user_id
 * @param string $description
 * @param int $date
 * @param int $time
 * @param int $calories
 */
function kalories_modify_meal( $post_id, $user_id, $description, $date, $time, $calories ) {
    // Update meal
	wp_update_post( array(
		'ID' => $post_id,
		'post_author' => $user_id,
		'post_title' => $description,
	) );

	// Update meal metas
	update_post_meta( $post_id, 'meal_date', $date );
	update_post_meta( $post_id, 'meal_time', $time );
	update_post_meta( $post_id, 'meal_calories', $calories );
}

/**
 * Delete meal
 *
 * @param int $id
 */
function kalories_delete_meal( $id ) {
    wp_delete_post( $id );
}

/**
 * Save preferences
 *
 * @param int $user_id
 * @param int $threshold
 */
function kalories_save_preferences( $user_id, $threshold ) {
	update_user_meta( $user_id, 'meal_daily_threshold', $threshold );
}

/**
 * Filter meal
 *
 * @param int $user_id
 * @param int $filter_start
 * @param int $filter_end
 *
 * @return int
 */
function kalories_filter_meal( $user_id, $filter_start, $filter_end ) {
	$args = array(
		'post_type' => 'meal',
		'post_status' => 'publish',
		'author' => $user_id,
		'meta_query' => array(
            'relation' => 'AND',
			array(
				'key' => 'meal_date',
				'type' => 'numeric',
				'value' => ( empty( $filter_start ) ) ? 0 : $filter_start,
				'compare' => '>='
			),
			array(
				'key' => 'meal_date',
				'type' => 'numeric',
				'value' => ( empty( $filter_end ) ) ? 99999999 : $filter_end,
				'compare' => '<='
			)
		)
	);
	$query = new WP_Query( $args );

	// Loop result
	$result = 0;
	while ( $query->have_posts() ) {
		$query->the_post();
		$post = get_post();

		// Get meal meta
		$calories = get_post_meta( $post->ID, 'meal_calories', true );

		// Add meal calories to result
		$result = $result + (int) $calories;
	}

	// Resets
	wp_reset_query();
	wp_reset_postdata();

    return $result;
}