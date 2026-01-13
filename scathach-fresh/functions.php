<?php
// Simple WordPress theme setup
function scathach_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    // Add menu support
    add_theme_support('menus');
    
    // Create required pages
    scathach_create_pages();
}
add_action('after_setup_theme', 'scathach_setup');

// Create sample blog posts on theme activation
function scathach_create_sample_posts() {
    $blog_posts = array(
        array(
            'title' => 'This the latest! What a show we have in store for you!',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'date' => '2025-11-01 10:00:00',
            'featured_image' => 'scathachPic1.jpg'
        ),
        array(
            'title' => 'Behind the Scenes',
            'content' => 'Check out our latest news right here to see whats ahead. Get an exclusive look at what happens when the cameras aren\'t rolling and discover the magic behind our performances. From rehearsal preparations to the intimate moments between band members, this behind-the-scenes glimpse reveals the dedication and passion that drives our Celtic metal sound.',
            'date' => '2025-10-30 15:30:00',
            'featured_image' => 'scathachGalleryPic2.jpg'
        ),
        array(
            'title' => 'Live Performance Energy',
            'content' => 'Check out our latest news right here to see whats ahead. Experience the raw energy and passion that flows through every live performance as we bring our Celtic heritage to life on stage. From the thunderous drums to the haunting melodies of traditional instruments, every show is a journey through ancient myths and modern metal mastery.',
            'date' => '2025-10-28 14:15:00',
            'featured_image' => 'scathachGalleryPic3.jpg'
        )
    );
    
    foreach ($blog_posts as $post_data) {
        // Check if post already exists by title using WP_Query
        $existing_posts = new WP_Query(array(
            'post_type' => 'post',
            'title' => $post_data['title'],
            'post_status' => 'publish',
            'numberposts' => 1
        ));
        
        if (!$existing_posts->have_posts()) {
            $post_id = wp_insert_post(array(
                'post_title' => $post_data['title'],
                'post_content' => $post_data['content'],
                'post_status' => 'publish',
                'post_type' => 'post',
                'post_date' => $post_data['date'],
                'post_author' => 1 // Admin user
            ));
            
            // Set featured image reference
            if ($post_id && !is_wp_error($post_id)) {
                update_post_meta($post_id, '_scathach_featured_image', $post_data['featured_image']);
            }
        }
        wp_reset_postdata();
    }
}

// Run this when WordPress is fully loaded
add_action('wp_loaded', 'scathach_create_sample_posts');

// Create required pages if they don't exist
function scathach_create_pages() {
    $pages = array(
        'about' => array(
            'title' => 'About',
            'template' => 'page-about.php'
        ),
        'contact' => array(
            'title' => 'Contact',
            'template' => 'page-contact.php'
        ),
        'venues' => array(
            'title' => 'Venues',
            'template' => 'page-venues.php'
        ),
        'blog' => array(
            'title' => 'Blog',
            'template' => 'home.php'
        )
    );
    
    foreach ($pages as $slug => $page_data) {
        // Check if page exists
        $page = get_page_by_path($slug);
        if (!$page) {
            // Create the page
            $page_id = wp_insert_post(array(
                'post_title' => $page_data['title'],
                'post_name' => $slug,
                'post_content' => '',
                'post_status' => 'publish',
                'post_type' => 'page'
            ));
            
            // Set page template
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        }
    }
    
    // Set blog page as posts page
    $blog_page = get_page_by_path('blog');
    if ($blog_page) {
        update_option('page_for_posts', $blog_page->ID);
    }
}

// Enqueue styles and scripts based on page
function scathach_enqueue() {
    // Always include mobile menu CSS
    wp_enqueue_style('scathach-mobile', get_template_directory_uri() . '/css/mobile-menu-uniform.css');
    
    // Page-specific CSS
    if (is_front_page()) {
        wp_enqueue_style('scathach-index-css', get_template_directory_uri() . '/css/index.css');
        wp_enqueue_script('scathach-index-js', get_template_directory_uri() . '/js/index.js', array(), false, true);
    } elseif (is_home() || is_single()) {
        wp_enqueue_style('scathach-blog-css', get_template_directory_uri() . '/css/blog.css');
        wp_enqueue_script('scathach-blog-js', get_template_directory_uri() . '/js/blog.js', array(), false, true);
    } elseif (is_page('about')) {
        wp_enqueue_style('scathach-about-css', get_template_directory_uri() . '/css/about.css');
        wp_enqueue_script('scathach-about-js', get_template_directory_uri() . '/js/about.js', array(), false, true);
    } elseif (is_page('contact')) {
        wp_enqueue_style('scathach-contact-css', get_template_directory_uri() . '/css/contact.css');
        wp_enqueue_script('scathach-contact-js', get_template_directory_uri() . '/js/contact.js', array(), false, true);
    } elseif (is_page('venues')) {
        wp_enqueue_style('scathach-venues-css', get_template_directory_uri() . '/css/venues.css');
        wp_enqueue_script('scathach-venues-js', get_template_directory_uri() . '/js/venues.js', array(), false, true);
    } else {
        // Default to index styles for other pages
        wp_enqueue_style('scathach-index-css', get_template_directory_uri() . '/css/index.css');
        wp_enqueue_script('scathach-index-js', get_template_directory_uri() . '/js/index.js', array(), false, true);
    }
    
    // Fonts
    wp_enqueue_style('scathach-fonts', 'https://fonts.googleapis.com/css2?family=Diplomata+SC&display=swap');
}
add_action('wp_enqueue_scripts', 'scathach_enqueue');

// Handle contact form submission
function handle_contact_form_submission() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_die('Security check failed');
    }
    
    // Sanitize form data
    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);
    
    // Send email (you can customize this)
    $to = get_option('admin_email'); // Send to site admin email
    $email_subject = 'Contact Form: ' . $subject;
    $email_body = "Name: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Subject: $subject\n\n";
    $email_body .= "Message:\n$message";
    
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    if (wp_mail($to, $email_subject, $email_body, $headers)) {
        // Redirect back to contact page with success message
        wp_redirect(add_query_arg('contact', 'success', wp_get_referer()));
    } else {
        // Redirect back to contact page with error message
        wp_redirect(add_query_arg('contact', 'error', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_contact_form_submit', 'handle_contact_form_submission');
add_action('admin_post_nopriv_contact_form_submit', 'handle_contact_form_submission');

// Remove WordPress admin bar
add_filter('show_admin_bar', '__return_false');
?>