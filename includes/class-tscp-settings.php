<?php
//class-tscp-settings.php
class TSCP_Settings {
    // Initialize the settings
    public function init() {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
    }

    // Add settings page under Settings menu
    public function add_settings_page() {
        add_options_page(
            'WP Content Protector Settings',
            'Content Protector',
            'manage_options',
            'simple-content-protector',
            array($this, 'render_settings_page')
        );
    }

    // Render the settings page
    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('WP Content Protector Settings', 'simple-content-protector'); ?></h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('wp_content_protector_options');
                do_settings_sections('simple-content-protector');
                ?>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row"><?php esc_html_e('Disable for Admin', 'simple-content-protector'); ?></th>
                        <td>
                            <input type="checkbox" name="tscp_disable_for_admins" value="1" <?php checked( get_option('tscp_disable_for_admins'), '1' ); ?> />
                            <label for="tscp_disable_for_admins"><?php esc_html_e('Disable content protection for admin.', 'simple-content-protector'); ?></label>
                        </td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    // Register the settings
    public function register_settings() {
        register_setting(
            'wp_content_protector_options',
            'tscp_disable_for_admins',
            array(
                'type' => 'integer',
                'sanitize_callback' => 'absint',
                'default' => 0,
            )
        );
    }
}
