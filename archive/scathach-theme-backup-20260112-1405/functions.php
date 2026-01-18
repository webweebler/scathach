<?php
// Basic WordPress theme setup
function scathach_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'scathach_theme_setup');

// Enqueue styles and scripts for front page
function scathach_theme_enqueue() {
    if (is_front_page()) {
        wp_enqueue_style('scathach-index-css', get_template_directory_uri() . '/css/index.css');
        wp_enqueue_style('scathach-mobile-css', get_template_directory_uri() . '/css/mobile-menu-uniform.css');
        wp_enqueue_script('scathach-index-js', get_template_directory_uri() . '/js/index.js', array(), false, true);
    }
    
    // Google Fonts
    wp_enqueue_style('scathach-fonts', 'https://fonts.googleapis.com/css2?family=Diplomata+SC&display=swap');
}
add_action('wp_enqueue_scripts', 'scathach_theme_enqueue');

// Remove admin bar
add_filter('show_admin_bar', '__return_false');
?>