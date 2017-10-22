<?php
/**
 * Remove admin bar
 *
 * @return bool
 */
function kalories_remove_admin_bar() {
    return false;
}
add_filter('show_admin_bar', 'kalories_remove_admin_bar');
