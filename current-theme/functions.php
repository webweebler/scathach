<?php
// Basic WordPress theme setup
function scathach_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'scathach_theme_setup');

// Helper functions for default section content
function scathach_get_default_section_title($section_num) {
    $defaults = array(
        1 => 'Our Story',
        2 => 'Our Sound', 
        3 => 'Live Performances',
        4 => 'Our Journey',
        5 => 'Recognition',
        6 => 'The Future'
    );
    return $defaults[$section_num] ?? '';
}

function scathach_get_default_section_text($section_num) {
    $defaults = array(
        1 => 'Born from the mists of Irish mythology, Scáthach emerged in 2018 as a force that bridges ancient Celtic legends with modern metal fury. Named after the legendary warrior woman who trained heroes on the Isle of Skye, we carry forward her legacy of strength, wisdom, and fierce determination.',
        2 => 'We forge a unique path in metal by weaving traditional Irish instruments with crushing guitar riffs and thunderous drums. Our music tells stories of ancient warriors, mystical landscapes, and the eternal struggle between light and darkness that defines Celtic mythology.',
        3 => 'On stage, we transform into the warriors of old, bringing raw energy and theatrical storytelling to every performance. From intimate venues to festival stages, each show is a journey through the mystical realms of Celtic lore, complete with traditional costumes and immersive visuals.',
        4 => 'From small Dublin pubs to international festivals, our path has been one of constant growth and artistic evolution. Three albums deep into our discography, we\'ve explored themes from the Book of Invasions to modern interpretations of ancient Celtic wisdom, always pushing the boundaries of folk metal.',
        5 => 'Our dedication to authentic Celtic metal has earned recognition from critics and fans alike. From winning "Best New Metal Act" to topping Irish metal charts, we\'ve proven that traditional stories can find new life in heavy music while staying true to their mystical roots.',
        6 => 'As we look ahead, our mission remains unchanged: to keep the ancient stories alive through powerful music. With new material exploring the deeper mysteries of Celtic cosmology and plans for international tours, the legend of Scáthach continues to grow stronger with each passing season.'
    );
    return $defaults[$section_num] ?? '';
}

function scathach_get_default_section_image($section_num) {
    $defaults = array(
        1 => get_template_directory_uri() . '/images/scathachGalleryPic2.jpg',
        2 => get_template_directory_uri() . '/images/scathachGalleryPic3.jpg',
        3 => get_template_directory_uri() . '/images/scathachGalleryPic4.jpg',
        4 => get_template_directory_uri() . '/images/scathachPic1.jpg',
        5 => get_template_directory_uri() . '/images/merchimg1.jpg',
        6 => get_template_directory_uri() . '/images/merchImg2.webp'
    );
    return $defaults[$section_num] ?? '';
}

function scathach_get_default_section_layout($section_num) {
    // Alternate layouts - odd sections: text-left, even sections: text-right
    return ($section_num % 2 === 1) ? 'text-left' : 'text-right';
}

function scathach_sanitize_layout($input) {
    return in_array($input, array('text-left', 'text-right')) ? $input : 'text-left';
}

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
    } elseif (is_page('terms')) {
        wp_enqueue_style('scathach-terms-css', get_template_directory_uri() . '/css/terms.css', array('scathach-mobile-css'), '1.0');
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
    } elseif (is_page('terms')) {
        echo '<link rel="preload" href="' . get_template_directory_uri() . '/css/terms.css" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
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
    // Add single consolidated section for front page settings
    $wp_customize->add_section('scathach_front_page', array(
        'title' => 'Front Page Settings',
        'priority' => 30,
        'description' => 'Customize the front page appearance, content, and text boxes'
    ));
    
    // Add section for social media settings
    $wp_customize->add_section('scathach_social_media', array(
        'title' => 'Social Media Links',
        'priority' => 29,
        'description' => 'Manage all social media URLs throughout the website'
    ));
    
    // Add section for venues settings
    $wp_customize->add_section('scathach_venues', array(
        'title' => 'Venues Page Settings',
        'priority' => 28,
        'description' => 'Customize venues page background image and partnerships section'
    ));
    
    // Social Media Settings
    $wp_customize->add_setting('social_facebook', array(
        'default' => 'https://www.facebook.com/profile.php?id=61572786083629',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('social_instagram', array(
        'default' => 'https://www.instagram.com/scathach_official/',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('social_spotify', array(
        'default' => 'https://open.spotify.com/artist/scathach',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('social_apple_music', array(
        'default' => 'https://music.apple.com/us/artist/sc%C3%A1thach/1801620227',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('social_tiktok', array(
        'default' => 'https://tiktok.com/@scathach',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('social_youtube_music', array(
        'default' => 'https://www.youtube.com/@Scathachmusic',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ));
    
    // Venues Background Image Setting
    $wp_customize->add_setting('venues_background_image', array(
        'default' => get_template_directory_uri() . '/images/scBackground.jpg',
        'sanitize_callback' => 'sanitize_url',
        'transport' => 'refresh'
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
    
    // Venue Video Background Settings
    $wp_customize->add_setting('venue_video_background', array(
        'default' => get_template_directory_uri() . '/videos/scathachVideo1.mp4',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
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
        'description' => 'Customize the content sections on the about page. Leave title blank to hide a section.'
    ));
    
    // About sections - up to 10 sections available
    for ($i = 1; $i <= 10; $i++) {
        // Section Title
        $wp_customize->add_setting("about_section_{$i}_title", array(
            'default' => $i <= 6 ? scathach_get_default_section_title($i) : '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport' => 'refresh'
        ));
        
        // Section Text
        $wp_customize->add_setting("about_section_{$i}_text", array(
            'default' => $i <= 6 ? scathach_get_default_section_text($i) : '',
            'sanitize_callback' => 'sanitize_textarea_field',
            'transport' => 'refresh'
        ));
        
        // Section Image
        $wp_customize->add_setting("about_section_{$i}_image", array(
            'default' => $i <= 6 ? scathach_get_default_section_image($i) : '',
            'sanitize_callback' => 'esc_url_raw',
            'transport' => 'refresh'
        ));
        
        // Section Layout
        $wp_customize->add_setting("about_section_{$i}_layout", array(
            'default' => $i <= 6 ? scathach_get_default_section_layout($i) : 'text-left',
            'sanitize_callback' => 'scathach_sanitize_layout',
            'transport' => 'refresh'
        ));
    }
    
    // Add section for contact page settings
    $wp_customize->add_section('scathach_contact_form', array(
        'title' => 'Contact Page Settings',
        'priority' => 34,
        'description' => 'Customize the contact page content and form options'
    ));
    
    // Contact form email recipient
    $wp_customize->add_setting('contact_form_email', array(
        'default' => 'info@scathach.com',
        'sanitize_callback' => 'sanitize_email',
        'transport' => 'refresh'
    ));
    
    // Contact page content settings
    $wp_customize->add_setting('contact_get_in_touch_text', array(
        'default' => 'We\'d love to hear from you! Send us a message using the form or reach out directly for any questions, collaborations, or just to say hello.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_follow_journey_text', array(
        'default' => 'Stay connected with us on social media for the latest updates, behind-the-scenes content, and exclusive announcements.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_intro_text', array(
        'default' => 'Ready to connect with Scáthach? Whether you have questions, want to collaborate, or just want to say hello, we\'d love to hear from you.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_main_heading', array(
        'default' => 'GET IN TOUCH',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('contact_social_heading', array(
        'default' => 'Follow Our Journey',
        'sanitize_callback' => 'sanitize_text_field',
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
    
    // Add section for Terms & Conditions page
    $wp_customize->add_section('scathach_terms_conditions', array(
        'title' => 'Terms & Conditions',
        'priority' => 35,
        'description' => 'Customize key sections of the Terms & Conditions page'
    ));
    
    // Terms & Conditions Settings
    $wp_customize->add_setting('terms_intro_text', array(
        'default' => 'Welcome to Scáthach\'s official website. These Terms and Conditions ("Terms") govern your use of our website and services. By accessing or using our website, you agree to be bound by these Terms.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    // Section headings
    $wp_customize->add_setting('terms_section_1_title', array(
        'default' => '1. Acceptance of Terms',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_2_title', array(
        'default' => '2. Use License',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_3_title', array(
        'default' => '3. Music and Content',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_4_title', array(
        'default' => '4. User Conduct',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_5_title', array(
        'default' => '5. Privacy Policy',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_6_title', array(
        'default' => '6. Merchandise and Sales',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_7_title', array(
        'default' => '7. Live Events and Tickets',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_8_title', array(
        'default' => '8. Disclaimer',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_9_title', array(
        'default' => '9. Limitations',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_10_title', array(
        'default' => '10. Changes to Terms',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_section_11_title', array(
        'default' => '11. Governing Law',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_contact_section_title', array(
        'default' => 'Contact Information',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'refresh'
    ));
    
    // Content sections
    $wp_customize->add_setting('terms_music_content', array(
        'default' => 'All music, videos, images, and other content on this website are the intellectual property of Scáthach and are protected by copyright laws. You may stream or download content only for personal, non-commercial use. Redistribution, commercial use, or unauthorized sharing of our content is strictly prohibited.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_merchandise', array(
        'default' => 'All merchandise sales are final unless the item received is defective or damaged. We reserve the right to limit quantities and refuse service. Prices are subject to change without notice.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_events', array(
        'default' => 'Ticket sales for live events are subject to venue-specific terms and conditions. Refunds may be available in accordance with venue policies. We are not responsible for cancelled or rescheduled events due to circumstances beyond our control.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_governing_law', array(
        'default' => 'These Terms and Conditions are governed by and construed in accordance with the laws of Ireland and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    $wp_customize->add_setting('terms_contact_text', array(
        'default' => 'If you have any questions about these Terms and Conditions, please contact us through our contact page.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));

    // Add content settings for sections that were missing them
    $wp_customize->add_setting('terms_section_1_content', array(
        'default' => 'By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('terms_section_2_content', array(
        'default' => 'Permission is granted to temporarily download one copy of the materials (information or software) on Scáthach\'s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('terms_section_4_content', array(
        'default' => 'When using our website, you agree not to: use the website for any unlawful purpose, post or transmit offensive content, attempt unauthorized access, or interfere with the website.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('terms_section_5_content', array(
        'default' => 'Your privacy is important to us. Any personal information collected through this website is governed by our Privacy Policy, which is incorporated into these Terms by reference.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('terms_section_8_content', array(
        'default' => 'The materials on Scáthach\'s website are provided on an \'as is\' basis. Scáthach makes no warranties, expressed or implied, and hereby disclaims all other warranties.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('terms_section_9_content', array(
        'default' => 'In no event shall Scáthach be liable for any damages arising out of the use or inability to use the materials on the website.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));

    $wp_customize->add_setting('terms_section_10_content', array(
        'default' => 'Scáthach may revise these Terms at any time without notice. By using this website, you agree to be bound by the current version of these Terms.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'refresh'
    ));
    
    // Social Media Controls
    $wp_customize->add_control('social_facebook', array(
        'label' => 'Facebook URL',
        'description' => 'Enter the full Facebook page URL',
        'section' => 'scathach_social_media',
        'type' => 'url'
    ));
    
    $wp_customize->add_control('social_instagram', array(
        'label' => 'Instagram URL',
        'description' => 'Enter the full Instagram profile URL',
        'section' => 'scathach_social_media',
        'type' => 'url'
    ));
    
    $wp_customize->add_control('social_youtube_music', array(
        'label' => 'YouTube Music Channel URL',
        'description' => 'Enter the YouTube music-specific channel URL',
        'section' => 'scathach_social_media',
        'type' => 'url'
    ));
    
    $wp_customize->add_control('social_spotify', array(
        'label' => 'Spotify Artist URL',
        'description' => 'Enter the Spotify artist page URL',
        'section' => 'scathach_social_media',
        'type' => 'url'
    ));
    
    $wp_customize->add_control('social_apple_music', array(
        'label' => 'Apple Music Artist URL',
        'description' => 'Enter the Apple Music artist page URL',
        'section' => 'scathach_social_media',
        'type' => 'url'
    ));
    
    $wp_customize->add_control('social_tiktok', array(
        'label' => 'TikTok Profile URL',
        'description' => 'Enter the TikTok profile URL',
        'section' => 'scathach_social_media',
        'type' => 'url'
    ));
    
    // Contact Page Content Controls
    $wp_customize->add_control('contact_main_heading', array(
        'label' => 'Main Contact Heading',
        'description' => 'The main "GET IN TOUCH" heading',
        'section' => 'scathach_contact_form',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('contact_intro_text', array(
        'label' => 'Contact Intro Text',
        'description' => 'The introductory paragraph above the contact form',
        'section' => 'scathach_contact_form',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('contact_get_in_touch_text', array(
        'label' => 'Get in Touch Paragraph',
        'description' => 'Text in the "Get in Touch" information card',
        'section' => 'scathach_contact_form',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('contact_social_heading', array(
        'label' => 'Social Media Section Heading',
        'description' => 'The "Follow Our Journey" heading',
        'section' => 'scathach_contact_form',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('contact_follow_journey_text', array(
        'label' => 'Follow Our Journey Paragraph',
        'description' => 'Text in the "Follow Our Journey" social media section',
        'section' => 'scathach_contact_form',
        'type' => 'textarea'
    ));
    
    // Venues Background Image Control
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'venues_background_image', array(
        'label' => 'Venues Background Image',
        'description' => 'Choose a background image for both venues sections',
        'section' => 'scathach_venues',
        'settings' => 'venues_background_image'
    )));
    
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
        'section' => 'scathach_front_page',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('textbox_1_text', array(
        'label' => 'Text Box 1 - Content',
        'description' => 'Content for the first text box',
        'section' => 'scathach_front_page',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('textbox_1_link', array(
        'label' => 'Text Box 1 - Link URL',
        'description' => 'URL for the first text box (e.g., /blog/ or https://example.com)',
        'section' => 'scathach_front_page',
        'type' => 'url'
    ));
    
    // Text Box 2 Controls
    $wp_customize->add_control('textbox_2_title', array(
        'label' => 'Text Box 2 - Title',
        'description' => 'Title for the second text box',
        'section' => 'scathach_front_page',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('textbox_2_text', array(
        'label' => 'Text Box 2 - Content',
        'description' => 'Content for the second text box',
        'section' => 'scathach_front_page',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('textbox_2_link', array(
        'label' => 'Text Box 2 - Link URL',
        'description' => 'URL for the second text box (e.g., /about/ or https://example.com)',
        'section' => 'scathach_front_page',
        'type' => 'url'
    ));
    
    // Text Box 3 Controls
    $wp_customize->add_control('textbox_3_title', array(
        'label' => 'Text Box 3 - Title',
        'description' => 'Title for the third text box',
        'section' => 'scathach_front_page',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('textbox_3_text', array(
        'label' => 'Text Box 3 - Content',
        'description' => 'Content for the third text box',
        'section' => 'scathach_front_page',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('textbox_3_link', array(
        'label' => 'Text Box 3 - Link URL',
        'description' => 'URL for the third text box (e.g., /contact/ or https://example.com)',
        'section' => 'scathach_front_page',
        'type' => 'url'
    ));
    
    // Venue Video Background Control
    $wp_customize->add_control('venue_video_background', array(
        'label' => 'Venue Section Video Background',
        'description' => 'Upload or enter the URL for the video background in the venues section. Recommended: MP4 format, under 50MB.',
        'section' => 'scathach_front_page',
        'type' => 'url'
    ));
    
    // Venue Partnerships Controls
    $wp_customize->add_control('partnerships_title', array(
        'label' => 'Section Title',
        'description' => 'Main title for the partnerships section',
        'section' => 'scathach_venues',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('partnerships_description', array(
        'label' => 'Section Description',
        'description' => 'Main description text for the partnerships section',
        'section' => 'scathach_venues',
        'type' => 'textarea'
    ));
    
    $wp_customize->add_control('partnerships_cta_text', array(
        'label' => 'Call to Action Button Text',
        'description' => 'Text for the main button (e.g., "Book Us for Your Venue")',
        'section' => 'scathach_venues',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('partnerships_cta_link', array(
        'label' => 'Call to Action Button Link',
        'description' => 'URL for the main button (e.g., /contact/ or external booking form)',
        'section' => 'scathach_venues',
        'type' => 'url'
    ));
    
    // Benefit 1 Controls
    $wp_customize->add_control('benefit_1_title', array(
        'label' => 'Benefit 1 - Title',
        'description' => 'Title for the first benefit box',
        'section' => 'scathach_venues',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('benefit_1_text', array(
        'label' => 'Benefit 1 - Description',
        'description' => 'Description for the first benefit box',
        'section' => 'scathach_venues',
        'type' => 'textarea'
    ));
    
    // Benefit 2 Controls
    $wp_customize->add_control('benefit_2_title', array(
        'label' => 'Benefit 2 - Title',
        'description' => 'Title for the second benefit box',
        'section' => 'scathach_venues',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('benefit_2_text', array(
        'label' => 'Benefit 2 - Description',
        'description' => 'Description for the second benefit box',
        'section' => 'scathach_venues',
        'type' => 'textarea'
    ));
    
    // Benefit 3 Controls
    $wp_customize->add_control('benefit_3_title', array(
        'label' => 'Benefit 3 - Title',
        'description' => 'Title for the third benefit box',
        'section' => 'scathach_venues',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('benefit_3_text', array(
        'label' => 'Benefit 3 - Description',
        'description' => 'Description for the third benefit box',
        'section' => 'scathach_venues',
        'type' => 'textarea'
    ));
    
    // About Page Section Controls
    for ($i = 1; $i <= 10; $i++) {
        // Section Title Control
        $wp_customize->add_control("about_section_{$i}_title", array(
            'label' => "Section {$i} - Title" . ($i > 6 ? ' (Optional)' : ''),
            'description' => $i > 6 ? 'Leave blank to hide this section' : 'Title for section ' . $i,
            'section' => 'scathach_about_sections',
            'type' => 'text'
        ));
        
        // Section Text Control
        $wp_customize->add_control("about_section_{$i}_text", array(
            'label' => "Section {$i} - Content",
            'description' => 'Content text for section ' . $i,
            'section' => 'scathach_about_sections',
            'type' => 'textarea'
        ));
        
        // Section Image Control
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "about_section_{$i}_image", array(
            'label' => "Section {$i} - Image",
            'description' => 'Image for section ' . $i,
            'section' => 'scathach_about_sections',
            'settings' => "about_section_{$i}_image"
        )));
        
        // Section Layout Control
        $wp_customize->add_control("about_section_{$i}_layout", array(
            'label' => "Section {$i} - Layout",
            'description' => 'Choose whether text appears on left or right',
            'section' => 'scathach_about_sections',
            'type' => 'select',
            'choices' => array(
                'text-left' => 'Text Left, Image Right',
                'text-right' => 'Image Left, Text Right'
            )
        ));
    }
    
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
    
    // Terms & Conditions Controls
    $wp_customize->add_control('terms_intro_text', array(
        'label' => 'Introduction Text',
        'description' => 'Main introduction paragraph for the terms page',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 1: Acceptance of Terms
    $wp_customize->add_control('terms_section_1_title', array(
        'label' => 'Section 1 - Heading',
        'description' => 'Title for Acceptance of Terms section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));

    $wp_customize->add_control('terms_section_1_content', array(
        'label' => 'Section 1 - Content',
        'description' => 'Text for the Acceptance of Terms section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 2: Use License
    $wp_customize->add_control('terms_section_2_title', array(
        'label' => 'Section 2 - Heading',
        'description' => 'Title for Use License section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));

    $wp_customize->add_control('terms_section_2_content', array(
        'label' => 'Section 2 - Content',
        'description' => 'Text for the Use License section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 3: Music and Content
    $wp_customize->add_control('terms_section_3_title', array(
        'label' => 'Section 3 - Heading',
        'description' => 'Title for Music and Content section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('terms_music_content', array(
        'label' => 'Section 3 - Content',
        'description' => 'Text for the music and content copyright section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 4: User Conduct
    $wp_customize->add_control('terms_section_4_title', array(
        'label' => 'Section 4 - Heading',
        'description' => 'Title for User Conduct section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));

    $wp_customize->add_control('terms_section_4_content', array(
        'label' => 'Section 4 - Content',
        'description' => 'Text for the User Conduct section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 5: Privacy Policy
    $wp_customize->add_control('terms_section_5_title', array(
        'label' => 'Section 5 - Heading',
        'description' => 'Title for Privacy Policy section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));

    $wp_customize->add_control('terms_section_5_content', array(
        'label' => 'Section 5 - Content',
        'description' => 'Text for the Privacy Policy section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 6: Merchandise and Sales
    $wp_customize->add_control('terms_section_6_title', array(
        'label' => 'Section 6 - Heading',
        'description' => 'Title for Merchandise and Sales section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('terms_merchandise', array(
        'label' => 'Section 6 - Content',
        'description' => 'Text for the merchandise sales policy section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 7: Live Events and Tickets
    $wp_customize->add_control('terms_section_7_title', array(
        'label' => 'Section 7 - Heading',
        'description' => 'Title for Live Events and Tickets section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('terms_events', array(
        'label' => 'Section 7 - Content',
        'description' => 'Text for the live events and ticket policy section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 8: Disclaimer
    $wp_customize->add_control('terms_section_8_title', array(
        'label' => 'Section 8 - Heading',
        'description' => 'Title for Disclaimer section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));

    $wp_customize->add_control('terms_section_8_content', array(
        'label' => 'Section 8 - Content',
        'description' => 'Text for the Disclaimer section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 9: Limitations
    $wp_customize->add_control('terms_section_9_title', array(
        'label' => 'Section 9 - Heading',
        'description' => 'Title for Limitations section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));

    $wp_customize->add_control('terms_section_9_content', array(
        'label' => 'Section 9 - Content',
        'description' => 'Text for the Limitations section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 10: Changes to Terms
    $wp_customize->add_control('terms_section_10_title', array(
        'label' => 'Section 10 - Heading',
        'description' => 'Title for Changes to Terms section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));

    $wp_customize->add_control('terms_section_10_content', array(
        'label' => 'Section 10 - Content',
        'description' => 'Text for the Changes to Terms section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Section 11: Governing Law
    $wp_customize->add_control('terms_section_11_title', array(
        'label' => 'Section 11 - Heading',
        'description' => 'Title for Governing Law section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('terms_governing_law', array(
        'label' => 'Section 11 - Content',
        'description' => 'Text for the governing law and jurisdiction section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
    ));
    
    // Contact Section
    $wp_customize->add_control('terms_contact_section_title', array(
        'label' => 'Contact Section - Heading',
        'description' => 'Title for Contact Information section',
        'section' => 'scathach_terms_conditions',
        'type' => 'text'
    ));
    
    $wp_customize->add_control('terms_contact_text', array(
        'label' => 'Contact Section - Content',
        'description' => 'Text for the contact information section',
        'section' => 'scathach_terms_conditions',
        'type' => 'textarea'
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

// Add custom CSS for dynamic backgrounds
function scathach_custom_css() {
    $background_image = get_theme_mod('front_page_background_image', get_template_directory_uri() . '/images/scBackground2.jpg');
    $venues_background = get_theme_mod('venues_background_image', get_template_directory_uri() . '/images/scBackground.jpg');
    
    if (is_front_page()) {
        echo '<style type="text/css">';
        echo '#background { background-image: url(' . esc_url($background_image) . '); }';
        echo '</style>';
    }
    
    if (is_page('venues')) {
        echo '<style type="text/css">';
        echo '.venues-container { background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url(' . esc_url($venues_background) . ') !important; }';
        echo '.venue-partnerships-section { background-image: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.9)), url(' . esc_url($venues_background) . ') !important; }';
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
