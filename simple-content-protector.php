<?php
/*
Plugin Name: Simple Content Protector
Plugin URI: https://techarchers.in/plugins/simple-content-protector
Description: Secure your WordPress website content with Simple Content Protector. Prevent unauthorized copying of text, images, and source code by disabling right-click, text selection, and keyboard shortcuts like CTRL+C and F12 Developer Tools. Protect your content today!
Version: 1.0
Author: Suraj Kumar Sinha
Author URI: https://techarchers.in
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: simple-content-protector
Domain Path: /languages
Tags: content protection, prevent right-click, disable copy-paste, secure content, content security plugin, protect images, stop content theft, WordPress security, anti-plagiarism
Requires at least: 6.5
Tested up to: 6.7.1
Stable tag: 1.0
*/

/*
|--------------------------------------------------------------------------
| Plugin Overview
|--------------------------------------------------------------------------
| Simple Content Protector is a lightweight, easy-to-use WordPress plugin
| designed to protect your website content. It prevents unauthorized copying
| by disabling right-click, keyboard shortcuts, and Developer Tools (F12).
|
| Features:
| - Disable right-click to prevent copying text and images.
| - Block keyboard shortcuts like CTRL+C, CTRL+U, and CTRL+S.
| - Stop image dragging for added visual content security.
| - Allow administrators to bypass protection for editing.
|
| Optimize your content security today with Simple Content Protector!
|--------------------------------------------------------------------------
*/

// Include core plugin files
require_once plugin_dir_path(__FILE__) . 'includes/tscp-functions.php'; // Helper functions
require_once plugin_dir_path(__FILE__) . 'includes/class-tscp-settings.php'; // Plugin settings management
require_once plugin_dir_path(__FILE__) . 'includes/class-tscp-protection.php'; // Core protection features
require_once plugin_dir_path(__FILE__) . 'includes/class-tscp-admin.php'; // Admin interface functionality

/**
 * Initialize the Simple Content Protector plugin.
 *
 * This function sets up the plugin by initializing key components:
 * - Settings module for user-configurable options.
 * - Protection module for applying content security features.
 * - Admin module for backend management tools.
 */
function tscp_init() {
    // Initialize settings module
    $settings = new TSCP_Settings();
    $settings->init();

    // Initialize protection module
    $protection = new TSCP_Protection();
    $protection->init();

    // Initialize admin module
    $admin = new TSCP_Admin();
    $admin->init();
}
add_action('plugins_loaded', 'tscp_init');
