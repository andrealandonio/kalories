<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<div class="sidebar-widget">
        <?php
        $current_user = wp_get_current_user();
        if ( ! empty( $current_user ) && $current_user->ID != 0 ) {
            ?>
            <h2>Welcome <?php echo $current_user->user_login ?></h2>
            <a href="<?php echo wp_logout_url( site_url( $_SERVER['REQUEST_URI'] ) ) ?>">Logout</a>
	        <?php
        }
        else {
	        ?>
            <h2>Login</h2>

	        <?php

	        // Display login form
	        wp_login_form( array(
		        'echo' => true,
		        'redirect' => site_url( $_SERVER['REQUEST_URI'] ),
		        'form_id' => 'loginform',
		        'label_username' => __( 'Username' ),
		        'label_password' => __( 'Password' ),
		        'label_remember' => __( 'Remember Me' ),
		        'label_log_in' => __( 'Log In' ),
		        'id_username' => 'user_login',
		        'id_password' => 'user_pass',
		        'id_remember' => 'rememberme',
		        'id_submit' => 'wp-submit',
		        'remember' => true,
		        'value_username' => null,
		        'value_remember' => false
	        ) );
        }
        ?>
	</div>

    <div class="sidebar-widget filters">
        <h1><?php _e( 'Filters', KAL_PREFIX ) ?></h1>

		<?php
		if ( ! empty( $current_user ) && $current_user->ID != 0 ) {
			?>
            <form action="" id="kalories_filters_table">
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $current_user->ID ?>">
                <input type="hidden" id="action" name="action" value="kalories_filters">
                <input type="hidden" id="nonce" name="nonce" value="<?php echo wp_create_nonce( KAL_NONCE ) ?>">

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="filter_start"><?php _e( 'Start', KAL_PREFIX ) ?></label></th>
                            <td>
                                <input name="filter_start" type="text" id="filter_start" value="" class="regular-text" />&nbsp;
                                <span class="description"><?php _e( 'format: "yyyymmdd"', KAL_PREFIX ) ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="filter_end"><?php _e( 'End', KAL_PREFIX ) ?></label></th>
                            <td>
                                <input name="filter_end" type="text" id="filter_end" value="" class="regular-text" />&nbsp;
                                <span class="description"><?php _e( 'format: "yyyymmdd"', KAL_PREFIX ) ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <p class="submit">
                    <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Filter', KAL_PREFIX ) ?>" />
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

</aside>
<!-- /sidebar -->
