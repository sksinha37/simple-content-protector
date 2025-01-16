<?php
//tscp-functions.php
// Function to get the current protection status
function tscp_is_protection_enabled() {
    $plugin_enabled = get_option('tscp_plugin_enabled', 'true'); // 'true' or 'false' as strings
    $disable_for_admins = (int) get_option('tscp_disable_for_admins', 0); // Ensure integer type

    // Disable for admin users if the option is set and the user is an administrator
    if ($disable_for_admins === 1 && current_user_can('administrator')) {
        return false;
    }

    // Return the plugin's general enabled status
    return ($plugin_enabled === 'true');
}