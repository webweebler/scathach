<?php
// Basic WordPress theme setup
function scathach_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'scathach_theme_setup');

// Enqueue styles and scripts
function scathach_theme_enqueue() {
    // Dequeue WordPress default jQuery to prevent conflicts with our scripts
    wp_dequeue_script('jquery');
    wp_dequeue_script('jquery-migrate');

    if (is_front_page()) {
        wp_enqueue_style('scathach-index-css', get_template_directory_uri() . '/css/index.css');
        wp_enqueue_style('scathach-mobile-css', get_template_directory_uri() . '/css/mobile-menu-uniform.css');
        wp_enqueue_style('scathach-lightbox-css', get_template_directory_uri() . '/lightbox.css');
        wp_enqueue_script('scathach-index-js', get_template_directory_uri() . '/js/index.js', array(), false, true);
    }

    // Google Fonts
    wp_enqueue_style('scathach-fonts', 'https://fonts.googleapis.com/css2?family=Diplomata+SC&display=swap');
}
add_action('wp_enqueue_scripts', 'scathach_theme_enqueue');

// Remove WordPress default styles that might interfere with our transitions
function scathach_remove_wp_styles() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('wp-emoji-styles');
}
add_action('wp_enqueue_scripts', 'scathach_remove_wp_styles', 100);

// Also remove emoji and other WordPress scripts that add CSS
function scathach_remove_wp_scripts() {
    wp_dequeue_script('wp-emoji-release');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
}
add_action('init', 'scathach_remove_wp_scripts');

// Remove admin bar
add_filter('show_admin_bar', '__return_false');

// Include custom post types
require_once get_template_directory() . '/custom-post-types.php';
