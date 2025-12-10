<?php
/*
Plugin Name: Spin Wheel
Plugin URI:  https://example.com/spinwheel
Description: A simple spin wheel plugin that fetches CSGO crates as prizes.
Version:     1.0
Author:      Your Name
Author URI:  https://example.com
License:     GPL2
Text Domain: spinwheel
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/* -----------------------------------------
 * 1. ADD ADMIN MENU
 * ----------------------------------------- */
add_action('admin_menu', function () {
    add_menu_page(
        'Spin Wheel',              // Page title
        'Spin Wheel',              // Menu title
        'manage_options',          // Capability
        'spin-wheel-settings',     // Menu slug
        'spin_wheel_settings_page',// Callback
        'dashicons-randomize',     // Icon
        90                         // Position
    );
});

/* -----------------------------------------
 * 2. REGISTER SETTINGS
 * ----------------------------------------- */
add_action('admin_init', function () {
    register_setting('spin_Wheel_settings_group', 'swp_min_prizes');
    register_setting('spin_Wheel_settings_group', 'swp_max_prizes');
    register_setting('spin_Wheel_settings_group', 'swp_api_url');
});

/* -----------------------------------------
 * 3. SETTINGS PAGE
 * ----------------------------------------- */
function spin_wheel_settings_page() { ?>
    <div class="wrap">
        <h1>Spin Wheel Settings</h1>

        <form method="post" action="options.php">
            <?php settings_fields('spin_Wheel_settings_group'); ?>

            <table class="form-table">

                <tr>
                    <th scope="row">Minimum Prizes</th>
                    <td>
                        <input type="number" name="swp_min_prizes"
                               value="<?php echo esc_attr(get_option('swp_min_prizes', 3)); ?>" min="1">
                    </td>
                </tr>

                <tr>
                    <th scope="row">Maximum Prizes</th>
                    <td>
                        <input type="number" name="swp_max_prizes"
                               value="<?php echo esc_attr(get_option('swp_max_prizes', 12)); ?>" min="1">
                    </td>
                </tr>

                <tr>
                    <th scope="row">API URL</th>
                    <td>
                        <input type="text" name="swp_api_url"
                               value="<?php echo esc_attr(get_option('swp_api_url', '')); ?>"
                               style="width: 400px;">
                    </td>
                </tr>

            </table>

            <?php submit_button(); ?>
        </form>
    </div>
<?php }

/* -----------------------------------------
 * 4. FRONT-END ASSETS + LOCALIZED SETTINGS
 * ----------------------------------------- */
add_action('wp_enqueue_scripts', function () {

    wp_enqueue_style(
        'spin-wheel-style',
        plugin_dir_url(__FILE__) . 'assets/style.css'
    );

    wp_enqueue_script(
        'spin-wheel-js',
        plugin_dir_url(__FILE__) . 'assets/wheel.js',
        array('jquery'),
        false,
        true
    );

    wp_localize_script('spin-wheel-js', 'SpinWheelSettings', array(
        'apiUrl'    => get_option('swp_api_url'),
        'minPrizes' => intval(get_option('swp_min_prizes', 3)),
        'maxPrizes' => intval(get_option('swp_max_prizes', 12))
    ));
});

/* -----------------------------------------
 * 5. SHORTCODE
 * ----------------------------------------- */
add_shortcode('spin_wheel', function () {
    return '
    <div id="wheel-container">
        <div id="wheel"></div>
        <button id="spin-btn">SPIN</button>
        <div id="result"></div>
    </div>';
});
