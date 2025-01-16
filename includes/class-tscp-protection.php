<?php
//class-tscp-protection.php
class TSCP_Protection
{
    public function init()
    {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts')); // Ensure JS and CSS load in admin too
    }

    public function enqueue_scripts()
    {
        wp_enqueue_script('jquery'); // Ensure jQuery is loaded

        // Check if content protection is enabled
        $plugin_enabled = get_option('tscp_plugin_enabled', 'true');
        $disable_for_admins = (int) get_option('tscp_disable_for_admins', 0);

        // Do not enqueue the protection script for admins if the option is enabled
        if ($plugin_enabled === 'true' && !($disable_for_admins === 1 && current_user_can('administrator'))) {
            wp_enqueue_script(
                'simple-content-protector-js',
                plugin_dir_url(__FILE__) . '../assets/js/simple-content-protector.js',
                array('jquery'),
                '1.4',
                true
            );
        }

        // Enqueue CSS (always loaded)
        wp_enqueue_style(
            'simple-content-protector-css',
            plugin_dir_url(__FILE__) . '../assets/css/simple-content-protector.css',
            array(),
            '1.0'
        );

        // Pass dynamic data to JS
        wp_localize_script('simple-content-protector-js', 'tscp_vars', array(
            'plugin_enabled' => $plugin_enabled,
            'disable_for_admins' => $disable_for_admins,
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('tscp_toggle_nonce'),
        ));

        wp_enqueue_script(
            'tscp-admin-script', // Script handle
            plugin_dir_url(__FILE__) . '../assets/js/tscp-admin.js', // Script URL
            ['jquery'], // Dependencies
            '1.0', // Version
            true // Load in footer
        );
    
        // Pass data to the script using wp_localize_script
        wp_localize_script('tscp-admin-script', 'tscpToggle', [
            'ajaxUrl' => esc_url(admin_url('admin-ajax.php')),
            'security' => wp_create_nonce('tscp_toggle_nonce'), // Nonce for security
        ]);
    
    }
}
