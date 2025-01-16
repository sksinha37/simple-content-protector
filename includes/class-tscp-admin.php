<?php
// class-tscp-admin.php
class TSCP_Admin
{
    public function init()
    {
        add_action('admin_bar_menu', array($this, 'add_admin_bar_menu'), 100);
        add_action('wp_ajax_tscp_toggle_plugin_status', array($this, 'tscp_toggle_plugin_status'));
    }

    // Add admin bar menu for toggling protection
    public function add_admin_bar_menu($admin_bar)
    {
        if (current_user_can('administrator')) {
            $plugin_enabled = get_option('tscp_plugin_enabled', 'true');
            $enabled_class = ($plugin_enabled === 'true') ? 'enabled' : 'disabled';

            // Sanitize output
            $nonce = wp_create_nonce('tscp_toggle_nonce');
            $admin_bar->add_menu(array(
                'id'    => 'tscp_plugin_toggle',
                'title' => sprintf(
                    '<span class="tscp-switch %s"></span>
                    <label class="switch">
                        <input type="checkbox" id="tscp-toggle-switch" %s />
                        <span class="slider"></span>
                    </label>
                    <span id="tscp-switch-text">%s</span>',
                    esc_attr($enabled_class),
                    checked($plugin_enabled, 'true', false),
                    esc_html__('Protect Content', 'simple-content-protector')
                ),
                'href'  => '#',
                'meta'  => array(
                    'title' => esc_attr__('Toggle Prevent RightClick', 'simple-content-protector'),
                ),
            ));
            
        }
    }

    // AJAX handler to toggle plugin status
    public function tscp_toggle_plugin_status()
    {
        // Check nonce for security
        check_ajax_referer('tscp_toggle_nonce', 'security');

        // Ensure only admins can toggle the plugin status
        if (!current_user_can('manage_options')) {
            wp_send_json_error('Unauthorized');
            return;
        }

        // Get current plugin status and toggle it
        $current_status = get_option('tscp_plugin_enabled', 'true');
        $new_status = ($current_status === 'true') ? 'false' : 'true';
        update_option('tscp_plugin_enabled', $new_status);

        // Send the new status back to the JS
        wp_send_json_success($new_status);
    }
}
