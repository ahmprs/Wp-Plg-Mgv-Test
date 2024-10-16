<?php
/*
Plugin Name: WP MGV Test Auto Update GitHub
Plugin URI: https://github.com/ahmprs/Wp-Plg-Mgv-Test
Description: A WordPress plugin for auto-updating from GitHub.
Version: 1.5.0
Author: AhmPrs
Author URI: https://github.com/ahmprs
GitHub Plugin URI: https://github.com/ahmprs/Wp-Plg-Mgv-Test.git
GitHub Branch: main
*/

// Exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// Function to add menu item
function wp_mgv_test_add_settings_menu()
{
    add_options_page(
        'WP MGV Test Auto Update GitHub Settings',
        'MGV Auto Update',
        'manage_options',
        'wp-mgv-test-auto-update-github',
        'wp_mgv_test_render_settings_page'
    );
}
add_action('admin_menu', 'wp_mgv_test_add_settings_menu');

// Render the settings page
function wp_mgv_test_render_settings_page()
{
?>
    <div class="wrap">
        <h1>WP MGV Test Auto Update GitHub Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('wp_mgv_test_settings_group');
            do_settings_sections('wp_mgv_test_auto_update');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Configuration JSON</th>
                    <td>
                        <textarea name="wp_mgv_test_config" rows="10" cols="50" class="large-text"><?php echo esc_textarea(get_option('wp_mgv_test_config')); ?></textarea>
                        <p class="description">Enter your configuration in (JSON) format.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

// Register settings
function wp_mgv_test_register_settings()
{
    register_setting('wp_mgv_test_settings_group', 'wp_mgv_test_config');
}
add_action('admin_init', 'wp_mgv_test_register_settings');
