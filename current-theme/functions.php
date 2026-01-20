<?php
// Basic WordPress theme setup
function scathach_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'scathach_theme_setup');

// Enqueue styles and scripts with preloading
function scathach_theme_enqueue() {
    // Dequeue WordPress default jQuery to prevent conflicts with our scripts
    wp_dequeue_script('jquery');
    wp_dequeue_script('jquery-migrate');

    // Google Fonts with preconnect for faster loading
    wp_enqueue_style('scathach-fonts', 'https://fonts.googleapis.com/css2?family=Diplomata+SC&display=swap');

    // Always enqueue mobile menu CSS first
    wp_enqueue_style('scathach-mobile-css', get_template_directory_uri() . '/css/mobile-menu-uniform.css', array(), '1.0');

    if (is_front_page()) {
        wp_enqueue_style('scathach-index-css', get_template_directory_uri() . '/css/index.css', array('scathach-mobile-css'), '1.0');
        wp_enqueue_style('scathach-lightbox-css', get_template_directory_uri() . '/css/lightbox.css', array(), '1.0');
        wp_enqueue_script('scathach-index-js', get_template_directory_uri() . '/js/index.js', array(), '1.0', true);
    } elseif (is_page('venues')) {
        wp_enqueue_style('scathach-venues-css', get_template_directory_uri() . '/css/venues.css', array('scathach-mobile-css'), '1.0');
    } elseif (is_page('about')) {
        wp_enqueue_style('scathach-about-css', get_template_directory_uri() . '/css/about.css', array('scathach-mobile-css'), '1.0');
    } elseif (is_page('contact')) {
        wp_enqueue_style('scathach-contact-css', get_template_directory_uri() . '/css/contact.css', array('scathach-mobile-css'), '1.0');
    } elseif (is_home() || is_category() || is_single()) {
        wp_enqueue_style('scathach-blog-css', get_template_directory_uri() . '/css/blog.css', array('scathach-mobile-css'), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'scathach_theme_enqueue');

// Add preload hints for critical CSS
function scathach_preload_css() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    
    // Always preload mobile menu CSS
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/css/mobile-menu-uniform.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    
    if (is_front_page()) {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/css/index.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    } elseif (is_page('venues')) {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/css/venues.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    } elseif (is_page('about')) {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/css/about.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    } elseif (is_page('contact')) {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/css/contact.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    } elseif (is_home() || is_category() || is_single()) {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/css/blog.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
    }
}
add_action('wp_head', 'scathach_preload_css', 1);

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

// WordPress Customizer - Front Page Background
function scathach_customizer_settings($wp_customize) {
    // Add section for front page settings
    $wp_customize->add_section('scathach_front_page', array(
        'title' => 'Front Page Settings',
        'priority' => 30,
        'description' => 'Customize the front page appearance'
    ));
    
    // Add setting for background image
    $wp_customize->add_setting('front_page_background_image', array(
        'default' => get_template_directory_uri() . '/images/scBackground2.jpg',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Add control for background image
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'front_page_background_image', array(
        'label' => 'Front Page Background Image',
        'description' => 'Choose a background image for the front page',
        'section' => 'scathach_front_page',
        'settings' => 'front_page_background_image'
    )));
}
add_action('customize_register', 'scathach_customizer_settings');

// Add custom CSS for dynamic background
function scathach_custom_css() {
    $background_image = get_theme_mod('front_page_background_image', get_template_directory_uri() . '/images/scBackground2.jpg');
    
    if (is_front_page()) {
        echo '<style type="text/css">';
        echo '#background { background-image: url(' . esc_url($background_image) . '); }';
        echo '</style>';
    }
}
add_action('wp_head', 'scathach_custom_css');
