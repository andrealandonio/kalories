<?php

get_header();

// Get current user
$current_user = wp_get_current_user();
?>

	<main class="main">
		<!-- section -->
		<section>

            <!-- save meal form -->
            <div class="form">
                <h1><?php _e( 'Save meal', KAL_PREFIX ) ?></h1>

	            <?php
	            if ( ! empty( $current_user ) && $current_user->ID != 0 ) {
	                ?>
                    <form action="" id="kalories_save_meal_table">
                        <p>
				            <?php _e( 'With this form you can add a meal.', KAL_PREFIX ) ?>
                        </p>

                        <input type="hidden" id="id" name="id" value="">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $current_user->ID ?>">
                        <input type="hidden" id="action" name="action" value="kalories_save_meal">
                        <input type="hidden" id="nonce" name="nonce" value="<?php echo wp_create_nonce( KAL_NONCE ) ?>">

                        <table class="form-table">
                            <tbody>
                            <tr>
                                <th scope="row"><label for="description"><?php _e( 'Description', KAL_PREFIX ) ?></label></th>
                                <td>
                                    <input name="description" type="text" id="description" value="" class="regular-text" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="date"><?php _e( 'Date', KAL_PREFIX ) ?></label></th>
                                <td>
                                    <input name="date" type="text" id="date" value="" placeholder="" class="regular-text" />
                                    <span class="description"><?php _e( 'Provide the date in the format "yyyymmdd"', KAL_PREFIX ) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="time"><?php _e( 'Time', KAL_PREFIX ) ?></label></th>
                                <td>
                                    <input name="time" type="text" id="time" value="" placeholder="" class="regular-text" />
                                    <span class="description"><?php _e( 'Provide the time in the format "hhmm"', KAL_PREFIX ) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="calories"><?php _e( 'Calories', KAL_PREFIX ) ?></label></th>
                                <td>
                                    <input name="calories" type="text" id="calories" value="" class="regular-text" />
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <p class="submit">
                            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save', KAL_PREFIX ) ?>" />
                        </p>

                    </form>
                    <?php
	            }
	            else {
		            ?>
		            <?php _e( 'Please login', KAL_PREFIX ) ?>
		            <?php
	            }
	            ?>
            </div>
            <!-- /save meal form -->

            <!-- preferences form -->
            <div class="form">
                <h1><?php _e( 'Preferences', KAL_PREFIX ) ?></h1>

	            <?php
	            if ( ! empty( $current_user ) && $current_user->ID != 0 ) {
	                // Retrieve user threshold
		            $threshold = get_user_meta( $current_user->ID, 'meal_daily_threshold', true );
                    ?>
                    <form action="" id="kalories_preferences_table">
                        <p>
				            <?php _e( 'With this form you can change you preferences.', KAL_PREFIX ) ?>
                        </p>

                        <input type="hidden" id="user_id" name="user_id" value="<?php echo $current_user->ID ?>">
                        <input type="hidden" id="action" name="action" value="kalories_save_preferences">
                        <input type="hidden" id="nonce" name="nonce" value="<?php echo wp_create_nonce( KAL_NONCE ) ?>">

                        <table class="form-table">
                            <tbody>
                            <tr>
                                <th scope="row"><label for="threshold"><?php _e( 'Daily threshold', KAL_PREFIX ) ?></label></th>
                                <td>
                                    <input name="threshold" type="text" id="threshold" value="<?php echo $threshold ?>" class="regular-text" />
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <p class="submit">
                            <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save', KAL_PREFIX ) ?>" />
                        </p>
                    </form>
                    <?php
	            }
	            else {
		            ?>
		            <?php _e( 'Please login', KAL_PREFIX ) ?>
		            <?php
                }
	            ?>
            </div>
            <!-- /preferences form -->

            <h1><?php _e( 'Meals list', KAL_PREFIX ) ?></h1>

            <!-- meal list -->
            <form action="" id="kalories_table">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $current_user->ID ?>">
                <input type="hidden" id="action" name="action" value="kalories_list">
                <input type="hidden" id="nonce" name="nonce" value="<?php echo wp_create_nonce( KAL_NONCE ) ?>">

                <table class="wp-list-table widefat fixed kalories_meal_list" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col" id="description" class="manage-column label-column"><?php _e( 'Description', KAL_PREFIX ) ?></th>
                            <th scope="col" id="date" class="manage-column date-column"><?php _e( 'Date & Time', KAL_PREFIX ) ?></th>
                            <th scope="col" id="calories" class="manage-column label-column"><?php _e( 'Calories', KAL_PREFIX ) ?></th>
                            <th scope="col" id="options" class="manage-column options-column"><?php _e( 'Options', KAL_PREFIX ) ?></th>
                        </tr>
                    </thead>
                    <tbody id="meal_rows">
                        <?php
                        if ( ! empty( $current_user ) && $current_user->ID != 0 ) {
	                        // Get meal list
	                        $meal_list = kalories_get_meal_list( $current_user->ID );

	                        // Show meal_list in table
	                        kalories_show_meal_list( $meal_list, $current_user->ID );
                        }
                        else {
                            ?>
                            <?php _e( 'Please login', KAL_PREFIX ) ?>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </form>
            <!-- /meal list -->

		</section>
		<!-- /section -->
	</main>

<?php get_sidebar() ?>

<?php get_footer() ?>
