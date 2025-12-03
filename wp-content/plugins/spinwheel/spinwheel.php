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

/* -------------------------------
   Plugin code goes here
--------------------------------- */

// Example: enqueue scripts
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_script(
        'spinwheel-js',
        plugin_dir_url(__FILE__) . 'spinwheel.js',
        ['jquery'],
        '1.0',
        true
    );
});

// Example: add shortcode
add_shortcode('spin_wheel', function() {
    return '<div id="result">Spin wheel will appear here.</div>
            <button id="spin-btn">SPIN</button>';
});

function spin_wheel_settings_page() {
    ?>
    <div class="wrap">
        <h1>Spin Wheel Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('spin_wheel_settings_group'); ?>
            <?php do_settings_sections('spin_wheel_settings_group'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Minimum Prizes</th>
                    <td><input type="number" name="spin_wheel_min_prizes" value="<?php echo esc_attr(get_option('spin_wheel_min_prizes', 1)); ?>" min="1" /></td>
                </tr>

                <tr valign="top">
                    <th scope="row">Maximum Prizes</th>
                    <td><input type="number" name="spin_wheel_max_prizes" value="<?php echo esc_attr(get_option('spin_wheel_max_prizes', 50)); ?>" min="1" /></td>
                </tr>

                <!-- API URL removed -->
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


/* -----------------------------------------
 * 4. ENQUEUE FRONT-END ASSETS + PASS SETTINGS TO JS
 * ----------------------------------------- */
add_action('wp_enqueue_scripts', function() {

    wp_enqueue_style('spin-wheel-style', plugin_dir_url(__FILE__) . 'assets/style.css');

    wp_enqueue_script('spin-wheel-js', plugin_dir_url(__FILE__) . 'assets/wheel.js', array('jquery'), false, true);

    // Pass settings to wheel.js
    wp_localize_script('spin-wheel-js', 'SpinWheelSettings', array(
        'apiUrl'      => get_option('swp_api_url'),
        'minPrizes'   => intval(get_option('swp_min_prizes', 3)),
        'maxPrizes'   => intval(get_option('swp_max_prizes', 12))
    ));
});

/* -----------------------------------------
 * 5. SHORTCODE: DISPLAY WHEEL
 * ----------------------------------------- */
add_shortcode('spin_wheel', function() {
    return '
    <div id="wheel-container">
        <div id="wheel"></div>
        <button id="spin-btn">SPIN</button>
        <div id="result"></div>
    </div>';
});
