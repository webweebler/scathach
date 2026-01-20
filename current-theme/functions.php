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

// WordPress Customizer - Front Page Settings
function scathach_customizer_settings($wp_customize) {
    // Add section for front page settings
    $wp_customize->add_section('scathach_front_page', array(
        'title' => 'Front Page Settings',
        'priority' => 30,
        'description' => 'Customize the front page appearance and content'
    ));
    
    // Add section for front page text boxes
    $wp_customize->add_section('scathach_front_page_textboxes', array(
        'title' => 'Front Page Text Boxes',
        'priority' => 31,
        'description' => 'Customize the text boxes on the front page'
    ));
    
    // Add setting for background image
    $wp_customize->add_setting('front_page_background_image', array(
        'default' => get_template_directory_uri() . '/images/scBackground2.jpg',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Text Box 1 Settings (Latest News)
    $wp_customize->add_setting('textbox_1_title', array(
        'default' => 'Latest News',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('textbox_1_text', array(
        'default' => 'Stay updated with our latest releases and tour announcements.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('textbox_1_link', array(
        'default' => '/blog/',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Text Box 2 Settings (Celtic Heritage)
    $wp_customize->add_setting('textbox_2_title', array(
        'default' => 'Celtic Heritage',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('textbox_2_text', array(
        'default' => 'Exploring ancient legends through modern musical expression.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('textbox_2_link', array(
        'default' => '/about/',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Text Box 3 Settings (Join Our Journey)
    $wp_customize->add_setting('textbox_3_title', array(
        'default' => 'Join Our Journey',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('textbox_3_text', array(
        'default' => 'Follow Scáthach as we forge new paths in music and storytelling.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('textbox_3_link', array(
        'default' => '/contact/',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Add section for venues page partnerships
    $wp_customize->add_section('scathach_venues_partnerships', array(
        'title' => 'Venues Page Partnerships',
        'priority' => 32,
        'description' => 'Customize the venue partnerships section on the venues page'
    ));
    
    // Venue Partnerships Settings
    $wp_customize->add_setting('partnerships_title', array(
        'default' => 'Venue Partnerships',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('partnerships_description', array(
        'default' => 'We\'re always looking to connect with venues that share our passion for Celtic culture and live music. Whether you\'re a historic theatre, festival organizer, or intimate music venue, we\'d love to bring our unique sound to your space.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('partnerships_cta_text', array(
        'default' => 'Book Us for Your Venue',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('partnerships_cta_link', array(
        'default' => '/contact/',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Benefit 1 Settings
    $wp_customize->add_setting('benefit_1_title', array(
        'default' => 'Professional Production',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('benefit_1_text', array(
        'default' => 'Complete sound and lighting technical requirements provided',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    // Benefit 2 Settings
    $wp_customize->add_setting('benefit_2_title', array(
        'default' => 'Promotional Support',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('benefit_2_text', array(
        'default' => 'Full marketing collaboration and social media promotion',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    // Benefit 3 Settings
    $wp_customize->add_setting('benefit_3_title', array(
        'default' => 'Flexible Programming',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('benefit_3_text', array(
        'default' => 'Customizable setlists to fit your venue\'s unique atmosphere',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    // Add section for about page content
    $wp_customize->add_section('scathach_about_sections', array(
        'title' => 'About Page Sections',
        'priority' => 33,
        'description' => 'Customize the content sections on the about page'
    ));
    
    // About Section 1: Our Story
    $wp_customize->add_setting('about_section_1_title', array(
        'default' => 'Our Story',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_1_text', array(
        'default' => 'Born from the mists of Irish mythology, Scáthach emerged in 2018 as a force that bridges ancient Celtic legends with modern metal fury. Named after the legendary warrior woman who trained heroes on the Isle of Skye, we carry forward her legacy of strength, wisdom, and fierce determination.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_1_image', array(
        'default' => get_template_directory_uri() . '/images/scathachGalleryPic2.jpg',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // About Section 2: Our Sound
    $wp_customize->add_setting('about_section_2_title', array(
        'default' => 'Our Sound',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_2_text', array(
        'default' => 'We forge a unique path in metal by weaving traditional Irish instruments with crushing guitar riffs and thunderous drums. Our music tells stories of ancient warriors, mystical landscapes, and the eternal struggle between light and darkness that defines Celtic mythology.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_2_image', array(
        'default' => get_template_directory_uri() . '/images/scathachGalleryPic3.jpg',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // About Section 3: Live Performances
    $wp_customize->add_setting('about_section_3_title', array(
        'default' => 'Live Performances',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_3_text', array(
        'default' => 'On stage, we transform into the warriors of old, bringing raw energy and theatrical storytelling to every performance. From intimate venues to festival stages, each show is a journey through the mystical realms of Celtic lore, complete with traditional costumes and immersive visuals.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_3_image', array(
        'default' => get_template_directory_uri() . '/images/scathachGalleryPic4.jpg',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // About Section 4: Our Journey
    $wp_customize->add_setting('about_section_4_title', array(
        'default' => 'Our Journey',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_4_text', array(
        'default' => 'From small Dublin pubs to international festivals, our path has been one of constant growth and artistic evolution. Three albums deep into our discography, we\'ve explored themes from the Book of Invasions to modern interpretations of ancient Celtic wisdom, always pushing the boundaries of folk metal.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_4_image', array(
        'default' => get_template_directory_uri() . '/images/scathachPic1.jpg',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // About Section 5: Recognition
    $wp_customize->add_setting('about_section_5_title', array(
        'default' => 'Recognition',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_5_text', array(
        'default' => 'Our dedication to authentic Celtic metal has earned recognition from critics and fans alike. From winning "Best New Metal Act" to topping Irish metal charts, we\'ve proven that traditional stories can find new life in heavy music while staying true to their mystical roots.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_5_image', array(
        'default' => get_template_directory_uri() . '/images/merchimg1.jpg',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // About Section 6: The Future
    $wp_customize->add_setting('about_section_6_title', array(
        'default' => 'The Future',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_6_text', array(
        'default' => 'As we look ahead, our mission remains unchanged: to keep the ancient stories alive through powerful music. With new material exploring the deeper mysteries of Celtic cosmology and plans for international tours, the legend of Scáthach continues to grow stronger with each passing season.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('about_section_6_image', array(
        'default' => get_template_directory_uri() . '/images/merchImg2.webp',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Add section for contact page settings
    $wp_customize->add_section('scathach_contact_form', array(
        'title' => 'Contact Form Settings',
        'priority' => 34,
        'description' => 'Customize the contact form options and email settings'
    ));
    
    // Contact form email recipient
    $wp_customize->add_setting('contact_form_email', array(
        'default' => 'info@scathach.com',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'refresh'
    ));
    
    // Contact form subject options
    $wp_customize->add_setting('contact_subject_1', array(
        'default' => 'General Inquiry',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_subject_2', array(
        'default' => 'Collaboration',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_subject_3', array(
        'default' => 'Fan Message',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_subject_4', array(
        'default' => 'Press Inquiry',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_subject_5', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    // Add control for background image
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'front_page_background_image', array(
        'label' => 'Front Page Background Image',
        'description' => 'Choose a background image for the front page',
        'section' => 'scathach_front_page',
        'settings' => 'front_page_background_image'
    )));
    
    // Text Box 1 Controls
    $wp_customize->add_control('textbox_1_title', array(
        'label' => 'Text Box 1 - Title',
        'description' => 'Title for the first text box',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('textbox_1_text', array(
        'label' => 'Text Box 1 - Content',
        'description' => 'Content for the first text box',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('textbox_1_link', array(
        'label' => 'Text Box 1 - Link URL',
        'description' => 'URL for the first text box (e.g., /blog/ or https://example.com)',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'url'
    ));
    
    // Text Box 2 Controls
    $wp_customize->add_control('textbox_2_title', array(
        'label' => 'Text Box 2 - Title',
        'description' => 'Title for the second text box',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('textbox_2_text', array(
        'label' => 'Text Box 2 - Content',
        'description' => 'Content for the second text box',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('textbox_2_link', array(
        'label' => 'Text Box 2 - Link URL',
        'description' => 'URL for the second text box (e.g., /about/ or https://example.com)',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'url'
    ));
    
    // Text Box 3 Controls
    $wp_customize->add_control('textbox_3_title', array(
        'label' => 'Text Box 3 - Title',
        'description' => 'Title for the third text box',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('textbox_3_text', array(
        'label' => 'Text Box 3 - Content',
        'description' => 'Content for the third text box',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('textbox_3_link', array(
        'label' => 'Text Box 3 - Link URL',
        'description' => 'URL for the third text box (e.g., /contact/ or https://example.com)',
        'section' => 'scathach_front_page_textboxes',
        'type' => 'url'
    ));
    
    // Venue Partnerships Controls
    $wp_customize->add_control('partnerships_title', array(
        'label' => 'Section Title',
        'description' => 'Main title for the partnerships section',
        'section' => 'scathach_venues_partnerships',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('partnerships_description', array(
        'label' => 'Section Description',
        'description' => 'Main description text for the partnerships section',
        'section' => 'scathach_venues_partnerships',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('partnerships_cta_text', array(
        'label' => 'Call to Action Button Text',
        'description' => 'Text for the main button (e.g., "Book Us for Your Venue")',
        'section' => 'scathach_venues_partnerships',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('partnerships_cta_link', array(
        'label' => 'Call to Action Button Link',
        'description' => 'URL for the main button (e.g., /contact/ or external booking form)',
        'section' => 'scathach_venues_partnerships',
        'type' => 'url'
    ));
    
    // Benefit 1 Controls
    $wp_customize->add_control('benefit_1_title', array(
        'label' => 'Benefit 1 - Title',
        'description' => 'Title for the first benefit box',
        'section' => 'scathach_venues_partnerships',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('benefit_1_text', array(
        'label' => 'Benefit 1 - Description',
        'description' => 'Description for the first benefit box',
        'section' => 'scathach_venues_partnerships',
        'type' => 'textarea'
    ));
    
    // Benefit 2 Controls
    $wp_customize->add_control('benefit_2_title', array(
        'label' => 'Benefit 2 - Title',
        'description' => 'Title for the second benefit box',
        'section' => 'scathach_venues_partnerships',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('benefit_2_text', array(
        'label' => 'Benefit 2 - Description',
        'description' => 'Description for the second benefit box',
        'section' => 'scathach_venues_partnerships',
        'type' => 'textarea'
    ));
    
    // Benefit 3 Controls
    $wp_customize->add_control('benefit_3_title', array(
        'label' => 'Benefit 3 - Title',
        'description' => 'Title for the third benefit box',
        'section' => 'scathach_venues_partnerships',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('benefit_3_text', array(
        'label' => 'Benefit 3 - Description',
        'description' => 'Description for the third benefit box',
        'section' => 'scathach_venues_partnerships',
        'type' => 'textarea'
    ));
    
    // About Page Section Controls
    // Section 1 Controls
    $wp_customize->add_control('about_section_1_title', array(
        'label' => 'Section 1 - Title',
        'description' => 'Title for the first section',
        'section' => 'scathach_about_sections',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('about_section_1_text', array(
        'label' => 'Section 1 - Content',
        'description' => 'Content text for the first section',
        'section' => 'scathach_about_sections',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_1_image', array(
        'label' => 'Section 1 - Image',
        'description' => 'Image for the first section',
        'section' => 'scathach_about_sections',
        'settings' => 'about_section_1_image'
    )));
    
    // Section 2 Controls
    $wp_customize->add_control('about_section_2_title', array(
        'label' => 'Section 2 - Title',
        'description' => 'Title for the second section',
        'section' => 'scathach_about_sections',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('about_section_2_text', array(
        'label' => 'Section 2 - Content',
        'description' => 'Content text for the second section',
        'section' => 'scathach_about_sections',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_2_image', array(
        'label' => 'Section 2 - Image',
        'description' => 'Image for the second section',
        'section' => 'scathach_about_sections',
        'settings' => 'about_section_2_image'
    )));
    
    // Section 3 Controls
    $wp_customize->add_control('about_section_3_title', array(
        'label' => 'Section 3 - Title',
        'description' => 'Title for the third section',
        'section' => 'scathach_about_sections',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('about_section_3_text', array(
        'label' => 'Section 3 - Content',
        'description' => 'Content text for the third section',
        'section' => 'scathach_about_sections',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_3_image', array(
        'label' => 'Section 3 - Image',
        'description' => 'Image for the third section',
        'section' => 'scathach_about_sections',
        'settings' => 'about_section_3_image'
    )));
    
    // Section 4 Controls
    $wp_customize->add_control('about_section_4_title', array(
        'label' => 'Section 4 - Title',
        'description' => 'Title for the fourth section',
        'section' => 'scathach_about_sections',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('about_section_4_text', array(
        'label' => 'Section 4 - Content',
        'description' => 'Content text for the fourth section',
        'section' => 'scathach_about_sections',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_4_image', array(
        'label' => 'Section 4 - Image',
        'description' => 'Image for the fourth section',
        'section' => 'scathach_about_sections',
        'settings' => 'about_section_4_image'
    )));
    
    // Section 5 Controls
    $wp_customize->add_control('about_section_5_title', array(
        'label' => 'Section 5 - Title',
        'description' => 'Title for the fifth section',
        'section' => 'scathach_about_sections',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('about_section_5_text', array(
        'label' => 'Section 5 - Content',
        'description' => 'Content text for the fifth section',
        'section' => 'scathach_about_sections',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_5_image', array(
        'label' => 'Section 5 - Image',
        'description' => 'Image for the fifth section',
        'section' => 'scathach_about_sections',
        'settings' => 'about_section_5_image'
    )));
    
    // Section 6 Controls
    $wp_customize->add_control('about_section_6_title', array(
        'label' => 'Section 6 - Title',
        'description' => 'Title for the sixth section',
        'section' => 'scathach_about_sections',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('about_section_6_text', array(
        'label' => 'Section 6 - Content',
        'description' => 'Content text for the sixth section',
        'section' => 'scathach_about_sections',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_6_image', array(
        'label' => 'Section 6 - Image',
        'description' => 'Image for the sixth section',
        'section' => 'scathach_about_sections',
        'settings' => 'about_section_6_image'
    )));
    
    // Contact Form Controls
    $wp_customize->add_control('contact_form_email', array(
        'label' => 'Form Recipient Email',
        'description' => 'Email address where form submissions will be sent',
        'section' => 'scathach_contact_form',
        'type' => 'email'
    ));
    
    $wp_customize->add_control('contact_subject_1', array(
        'label' => 'Subject Option 1',
        'description' => 'First subject option in the contact form',
        'section' => 'scathach_contact_form',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('contact_subject_2', array(
        'label' => 'Subject Option 2',
        'description' => 'Second subject option in the contact form',
        'section' => 'scathach_contact_form',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('contact_subject_3', array(
        'label' => 'Subject Option 3 (Optional)',
        'description' => 'Third subject option - leave blank to hide',
        'section' => 'scathach_contact_form',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('contact_subject_4', array(
        'label' => 'Subject Option 4 (Optional)',
        'description' => 'Fourth subject option - leave blank to hide',
        'section' => 'scathach_contact_form',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('contact_subject_5', array(
        'label' => 'Subject Option 5 (Optional)',
        'description' => 'Fifth subject option - leave blank to hide',
        'section' => 'scathach_contact_form',
        'type' => 'text'
    ));
    
    // Add setting for hiding merch section
    $wp_customize->add_setting('hide_merch_section', array(
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport' => 'refresh'
    ));
    
    // Add control for hiding merch section
    $wp_customize->add_control('hide_merch_section', array(
        'label' => 'Hide Merch Section',
        'description' => 'Check to hide the merch section from the front page',
        'section' => 'scathach_front_page',
        'type' => 'checkbox'
    ));
    
    // Add setting for hiding accordion section
    $wp_customize->add_setting('hide_accordion_section', array(
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
        'transport' => 'refresh'
    ));
    
    // Add control for hiding accordion section
    $wp_customize->add_control('hide_accordion_section', array(
        'label' => 'Hide Albums Section',
        'description' => 'Check to hide the albums accordion section from the front page',
        'section' => 'scathach_front_page',
        'type' => 'checkbox'
    ));
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

// Handle contact form submissions
function scathach_handle_contact_form() {
    if ($_POST['action'] === 'submit_contact_form') {
        // Verify nonce for security
        if (!wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
            wp_send_json_error('Security verification failed.');
            return;
        }
        
        // Sanitize form data
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = sanitize_textarea_field($_POST['message']);
        $form_recipient = sanitize_email($_POST['form_recipient']);
        
        // Basic validation
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            wp_send_json_error('All fields are required.');
            return;
        }
        
        if (!is_email($email)) {
            wp_send_json_error('Please provide a valid email address.');
            return;
        }
        
        // Prepare email
        $to = $form_recipient;
        $email_subject = 'Contact Form: ' . ucfirst(str_replace('_', ' ', $subject));
        $email_message = "New contact form submission:\n\n";
        $email_message .= "Name: $name\n";
        $email_message .= "Email: $email\n";
        $email_message .= "Subject: " . ucfirst(str_replace('_', ' ', $subject)) . "\n\n";
        $email_message .= "Message:\n$message\n";
        
        $headers = array(
            'Content-Type: text/plain; charset=UTF-8',
            'From: ' . get_bloginfo('name') . ' <noreply@' . $_SERVER['HTTP_HOST'] . '>',
            'Reply-To: ' . $name . ' <' . $email . '>'
        );
        
        // Send email
        $sent = wp_mail($to, $email_subject, $email_message, $headers);
        
        if ($sent) {
            wp_send_json_success('Thank you! Your message has been sent successfully.');
        } else {
            wp_send_json_error('Sorry, there was an error sending your message. Please try again.');
        }
    }
}
add_action('wp_ajax_submit_contact_form', 'scathach_handle_contact_form');
add_action('wp_ajax_nopriv_submit_contact_form', 'scathach_handle_contact_form');

// Add nonce to contact form pages
function scathach_add_contact_form_scripts() {
    if (is_page('contact')) {
        ?>
        <script>
        window.contactFormAjax = {
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            nonce: '<?php echo wp_create_nonce('contact_form_nonce'); ?>'
        };
        </script>
        <?php
    }
}
add_action('wp_head', 'scathach_add_contact_form_scripts');
