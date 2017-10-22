/**
 * JQuery document ready
 */
jQuery(document).ready(function() {
    /**
     * Save meal
     */
    jQuery("#kalories_save_meal_table").submit(function() {
        var ajax_url = "/wp-admin/admin-ajax.php";
        var form = jQuery('#kalories_save_meal_table');

        // Validate form
        form.validate({
            rules: {
                description: {
                    required: true
                },
                date: {
                    required: true
                },
                time: {
                    required: true
                },
                calories: {
                    required: true
                }
            },
            messages: {
                description: "Please enter a valid description",
                date: "Please enter a valid date (format: 'yyyymmdd')",
                time: "Please enter a valid time (format: 'hhmm')",
                calories: "Please enter a valid calories"
            }
        });

        var is_form_valid = form.valid();
        if (is_form_valid) {
            var data = form.serializeArray();

            // Prepare post data
            data.push({
                name: 'action',
                value: 'kalories_save_meal',
                type: 'post',
                dataType: 'json'
            });

            // Post data
            jQuery.post(ajax_url, data, function(response) {
                // Manage meal list
                jQuery('#meal_rows').hide().empty().append(response).fadeIn();

                // Clean form fields
                jQuery("#kalories_save_meal_table").find('#id').val('');
                jQuery("#kalories_save_meal_table").find('#description').val('');
                jQuery("#kalories_save_meal_table").find('#date').val('');
                jQuery("#kalories_save_meal_table").find('#time').val('');
                jQuery("#kalories_save_meal_table").find('#calories').val('');
            });
        }

        return false;
    });

    /**
     * Save preferences
     */
    jQuery("#kalories_preferences_table").submit(function() {
        var ajax_url = "/wp-admin/admin-ajax.php";
        var form = jQuery('#kalories_preferences_table');

        // Validate form
        form.validate({
            rules: {
                threshold: {
                    required: true
                }
            },
            messages: {
                threshold: "Please enter a valid threshold"
            }
        });

        var is_form_valid = form.valid();
        if (is_form_valid) {
            var data = form.serializeArray();

            // Prepare data
            data.push({
                name: 'action',
                value: 'kalories_save_preferences',
                type: 'post',
                dataType: 'json'
            });

            // Post data
            jQuery.post(ajax_url, data, function(response) {
                // Update meal list
                jQuery('#meal_rows').hide().empty().append(response).fadeIn();

                alert('Operation completed');
            });
        }

        return false;
    });

    /**
     * Filter meal
     */
    jQuery("#kalories_filters_table").submit(function() {
        var ajax_url = "/wp-admin/admin-ajax.php";
        var form = jQuery('#kalories_filters_table');

        var data = form.serializeArray();

        // Prepare data
        data.push({
            name: 'action',
            value: 'kalories_filter_meal',
            type: 'post',
            dataType: 'json'
        });

        // Post data
        jQuery.post(ajax_url, data, function(response) {
            alert('Filter result: ' + response);
        });

        return false;
    });
});

/**
 * Modify meal
 */
function modify_meal(id) {
    var ajax_url = '/wp-admin/admin-ajax.php';
    var nonce = jQuery("#kalories_table").find('input#nonce').val();

    // Prepare post data
    var data = {
        name: 'action',
        action: 'kalories_get_meal',
        type: 'post',
        dataType: 'json',
        id: id,
        nonce: nonce
    };

    // Post data
    jQuery.post(ajax_url, data, function(response) {
        // Fill meal data
        jQuery("#kalories_save_meal_table").find('#id').val(response.id);
        jQuery("#kalories_save_meal_table").find('#user_id').val(response.user_id);
        jQuery("#kalories_save_meal_table").find('#description').val(response.description);
        jQuery("#kalories_save_meal_table").find('#date').val(response.date);
        jQuery("#kalories_save_meal_table").find('#time').val(response.time);
        jQuery("#kalories_save_meal_table").find('#calories').val(response.calories);
    });
}

/**
 * Delete meal
 */
function delete_meal(id) {
    var ajax_url = "/wp-admin/admin-ajax.php";
    var choice = confirm('Are you sure?');
    var nonce = jQuery("#kalories_table").find('input#nonce').val();

    if (choice === true) {
        // Prepare post data
        var data = {
            name: 'action',
            action: 'kalories_delete_meal',
            type: 'post',
            dataType: 'json',
            id: id,
            nonce: nonce
        };

        // Post data
        jQuery.post(ajax_url, data, function(response) {
            // Update meal list
            jQuery('#meal_rows').hide().empty().append(response).fadeIn();
        });
    }

    return false;
}
