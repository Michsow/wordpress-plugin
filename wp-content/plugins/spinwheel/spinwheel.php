<?php
/**
 * Plugin Name: Spin Wheel
 * Description: A simple spin-the-wheel game for WordPress.
 * Version: 1.0
 * Author: Your Name
 */

// Enqueue CSS and JS
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('spin-wheel-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('spin-wheel-js', plugin_dir_url(__FILE__) . 'assets/wheel.js', array('jquery'), false, true);
});

// Shortcode to display wheel
add_shortcode('spin_wheel', function() {
    $html = '
    <div id="wheel-container">
        <div id="wheel"></div>
        <button id="spin-btn">SPIN</button>
        <div id="result"></div>
    </div>
    ';

    return $html;
});
