<?php
// Register Custom Post Types
function scathach_register_custom_post_types() {
    // Gallery Images
    register_post_type('gallery_item', array(
        'labels' => array(
            'name' => 'Gallery',
            'singular_name' => 'Gallery Image',
            'add_new' => 'Add New Image',
            'add_new_item' => 'Add New Gallery Image',
            'edit_item' => 'Edit Gallery Image',
            'view_item' => 'View Gallery Image',
            'all_items' => 'All Gallery Images'
        ),
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'supports' => array('title', 'thumbnail'),
        'menu_icon' => 'dashicons-format-gallery',
        'menu_position' => 5
    ));

    // Shows/Venues
    register_post_type('show', array(
        'labels' => array(
            'name' => 'Shows',
            'singular_name' => 'Show',
            'add_new' => 'Add New Show',
            'add_new_item' => 'Add New Show',
            'edit_item' => 'Edit Show',
            'view_item' => 'View Show',
            'all_items' => 'All Shows'
        ),
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-tickets-alt',
        'menu_position' => 6
    ));

    // Merch Items
    register_post_type('merch', array(
        'labels' => array(
            'name' => 'Merch',
            'singular_name' => 'Merch Item',
            'add_new' => 'Add New Item',
            'add_new_item' => 'Add New Merch Item',
            'edit_item' => 'Edit Merch Item',
            'view_item' => 'View Merch Item',
            'all_items' => 'All Merch'
        ),
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-cart',
        'menu_position' => 7
    ));

    // Albums
    register_post_type('album', array(
        'labels' => array(
            'name' => 'Albums',
            'singular_name' => 'Album',
            'add_new' => 'Add New Album',
            'add_new_item' => 'Add New Album',
            'edit_item' => 'Edit Album',
            'view_item' => 'View Album',
            'all_items' => 'All Albums'
        ),
        'public' => true,
        'has_archive' => false,
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_icon' => 'dashicons-album',
        'menu_position' => 8
    ));
}
add_action('init', 'scathach_register_custom_post_types');

// Add custom fields meta boxes
function scathach_add_custom_meta_boxes() {
    // Show meta box - set to 'side' for sidebar placement or 'advanced' for below editor
    add_meta_box('show_details', 'Show Details', 'scathach_show_meta_box', 'show', 'advanced', 'high');
    // Merch meta box
    add_meta_box('merch_details', 'Merch Details', 'scathach_merch_meta_box', 'merch', 'advanced', 'high');
    // Album meta box
    add_meta_box('album_details', 'Album Details', 'scathach_album_meta_box', 'album', 'advanced', 'high');
}
add_action('add_meta_boxes', 'scathach_add_custom_meta_boxes');

// Remove the block editor for post types - use classic editor
function scathach_remove_editor() {
    remove_post_type_support('show', 'editor');
    remove_post_type_support('merch', 'editor');
    remove_post_type_support('album', 'editor');
    remove_post_type_support('post', 'editor'); // Remove block editor from blog posts
}
add_action('init', 'scathach_remove_editor');

// Add simple content meta box for blog posts
function scathach_add_post_meta_box() {
    add_meta_box('post_content_box', 'Post Content', 'scathach_post_content_box', 'post', 'normal', 'high');
}
add_action('add_meta_boxes', 'scathach_add_post_meta_box');

// Post content meta box callback
function scathach_post_content_box($post) {
    wp_nonce_field('scathach_post_nonce', 'scathach_post_nonce_field');
    $content = get_post_meta($post->ID, '_post_content', true);
    
    // If no custom content, use post_content
    if (empty($content) && !empty($post->post_content)) {
        $content = $post->post_content;
    }
    ?>
    <p style="margin-bottom: 10px; color: #666;">
        <strong>Instructions:</strong> Write your blog post content below. You can use the featured image option in the sidebar to add an image.
    </p>
    <textarea name="post_content_field" rows="15" style="width:100%; font-size: 14px; padding: 10px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;"><?php echo esc_textarea($content); ?></textarea>
    <p style="margin-top: 10px; color: #666; font-size: 13px;">
        <strong>Tip:</strong> The excerpt (summary) will be auto-generated from the first 150 words, or you can set a custom excerpt in the Excerpt box below.
    </p>
    <?php
}

// Save blog post content
function scathach_save_post_content($post_id) {
    // Check nonce and autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!isset($_POST['scathach_post_nonce_field'])) return;
    if (!wp_verify_nonce($_POST['scathach_post_nonce_field'], 'scathach_post_nonce')) return;
    
    // Check permissions
    if (!current_user_can('edit_post', $post_id)) return;
    
    // Save content
    if (isset($_POST['post_content_field'])) {
        $content = wp_kses_post($_POST['post_content_field']);
        
        // Update custom field
        update_post_meta($post_id, '_post_content', $content);
        
        // Remove the hook to prevent infinite loop
        remove_action('save_post_post', 'scathach_save_post_content');
        
        // Update the actual post content directly
        wp_update_post(array(
            'ID' => $post_id,
            'post_content' => $content
        ));
        
        // Re-add the hook
        add_action('save_post_post', 'scathach_save_post_content');
    }
}
add_action('save_post_post', 'scathach_save_post_content');

// Show meta box callback
function scathach_show_meta_box($post) {
    wp_nonce_field('scathach_show_nonce', 'scathach_show_nonce_field');
    $date = get_post_meta($post->ID, '_show_date', true);
    $venue = get_post_meta($post->ID, '_show_venue', true);
    $location = get_post_meta($post->ID, '_show_location', true);
    $ticket_link = get_post_meta($post->ID, '_ticket_link', true);
    $description = get_post_meta($post->ID, '_show_description', true);
    $doors_time = get_post_meta($post->ID, '_doors_time', true);
    $show_time = get_post_meta($post->ID, '_show_time', true);
    $ticket_price = get_post_meta($post->ID, '_ticket_price', true);
    $status = get_post_meta($post->ID, '_show_status', true);
    
    // Parse existing date or set defaults
    $day = '';
    $month = '';
    $year = date('Y');
    if ($date) {
        $parsed = strtotime($date);
        if ($parsed) {
            $day = date('d', $parsed);
            $month = date('m', $parsed);
            $year = date('Y', $parsed);
        }
    }
    ?>
    <p>
        <label><strong>Show Date:</strong></label><br>
        <select name="show_day" style="width:30%; display:inline-block;">
            <option value="">Day</option>
            <?php for($i = 1; $i <= 31; $i++): ?>
                <option value="<?php echo sprintf('%02d', $i); ?>" <?php selected($day, sprintf('%02d', $i)); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <select name="show_month" style="width:32%; display:inline-block;">
            <option value="">Month</option>
            <option value="01" <?php selected($month, '01'); ?>>January</option>
            <option value="02" <?php selected($month, '02'); ?>>February</option>
            <option value="03" <?php selected($month, '03'); ?>>March</option>
            <option value="04" <?php selected($month, '04'); ?>>April</option>
            <option value="05" <?php selected($month, '05'); ?>>May</option>
            <option value="06" <?php selected($month, '06'); ?>>June</option>
            <option value="07" <?php selected($month, '07'); ?>>July</option>
            <option value="08" <?php selected($month, '08'); ?>>August</option>
            <option value="09" <?php selected($month, '09'); ?>>September</option>
            <option value="10" <?php selected($month, '10'); ?>>October</option>
            <option value="11" <?php selected($month, '11'); ?>>November</option>
            <option value="12" <?php selected($month, '12'); ?>>December</option>
        </select>
        <select name="show_year" style="width:30%; display:inline-block;">
            <option value="">Year</option>
            <?php for($i = date('Y') - 2; $i <= date('Y') + 5; $i++): ?>
                <option value="<?php echo $i; ?>" <?php selected($year, $i); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </p>
    <p>
        <label><strong>Venue Name:</strong></label><br>
        <input type="text" name="show_venue" value="<?php echo esc_attr($venue); ?>" placeholder="e.g., The Academy" style="width:100%;">
    </p>
    <p>
        <label><strong>Location/City:</strong></label><br>
        <input type="text" name="show_location" value="<?php echo esc_attr($location); ?>" placeholder="e.g., Dublin, Ireland" style="width:100%;">
    </p>
    <p>
        <label><strong>Show Description:</strong></label><br>
        <textarea name="show_description" rows="4" style="width:100%;" placeholder="Brief description of the show..."><?php echo esc_textarea($description); ?></textarea>
    </p>
    <p>
        <label><strong>Doors Time:</strong></label><br>
        <?php
        // Parse existing doors time
        $doors_hour = '';
        $doors_minute = '00';
        $doors_period = 'PM';
        if ($doors_time) {
            if (preg_match('/(\d{1,2}):(\d{2})\s*(AM|PM)/i', $doors_time, $matches)) {
                $doors_hour = $matches[1];
                $doors_minute = $matches[2];
                $doors_period = strtoupper($matches[3]);
            }
        }
        ?>
        <select name="doors_hour" style="width:30%; display:inline-block;">
            <option value="">Hour</option>
            <?php for($i = 1; $i <= 12; $i++): ?>
                <option value="<?php echo $i; ?>" <?php selected($doors_hour, $i); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <select name="doors_minute" style="width:30%; display:inline-block;">
            <option value="00" <?php selected($doors_minute, '00'); ?>>00</option>
            <option value="15" <?php selected($doors_minute, '15'); ?>>15</option>
            <option value="30" <?php selected($doors_minute, '30'); ?>>30</option>
            <option value="45" <?php selected($doors_minute, '45'); ?>>45</option>
        </select>
        <select name="doors_period" style="width:30%; display:inline-block;">
            <option value="AM" <?php selected($doors_period, 'AM'); ?>>AM</option>
            <option value="PM" <?php selected($doors_period, 'PM'); ?>>PM</option>
        </select>
    </p>
    <p>
        <label><strong>Show Time:</strong></label><br>
        <?php
        // Parse existing show time
        $show_hour = '';
        $show_minute = '00';
        $show_period = 'PM';
        if ($show_time) {
            if (preg_match('/(\d{1,2}):(\d{2})\s*(AM|PM)/i', $show_time, $matches)) {
                $show_hour = $matches[1];
                $show_minute = $matches[2];
                $show_period = strtoupper($matches[3]);
            }
        }
        ?>
        <select name="show_hour" style="width:30%; display:inline-block;">
            <option value="">Hour</option>
            <?php for($i = 1; $i <= 12; $i++): ?>
                <option value="<?php echo $i; ?>" <?php selected($show_hour, $i); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <select name="show_minute" style="width:30%; display:inline-block;">
            <option value="00" <?php selected($show_minute, '00'); ?>>00</option>
            <option value="15" <?php selected($show_minute, '15'); ?>>15</option>
            <option value="30" <?php selected($show_minute, '30'); ?>>30</option>
            <option value="45" <?php selected($show_minute, '45'); ?>>45</option>
        </select>
        <select name="show_period" style="width:30%; display:inline-block;">
            <option value="AM" <?php selected($show_period, 'AM'); ?>>AM</option>
            <option value="PM" <?php selected($show_period, 'PM'); ?>>PM</option>
        </select>
    </p>
    <p>
        <label><strong>Ticket Price Range:</strong></label><br>
        <input type="text" name="ticket_price" value="<?php echo esc_attr($ticket_price); ?>" placeholder="e.g., €35-€65" style="width:100%;">
    </p>
    <p>
        <label><strong>Ticket Purchase Link:</strong></label><br>
        <input type="url" name="ticket_link" value="<?php echo esc_attr($ticket_link); ?>" placeholder="https://" style="width:100%;">
    </p>
    <p>
        <label><strong>Ticket Status:</strong></label><br>
        <select name="show_status" style="width:100%;">
            <option value="">Select Status</option>
            <option value="available" <?php selected($status, 'available'); ?>>Available</option>
            <option value="selling-fast" <?php selected($status, 'selling-fast'); ?>>Selling Fast</option>
            <option value="sold-out" <?php selected($status, 'sold-out'); ?>>Sold Out</option>
        </select>
    </p>
    <?php
}

// Merch meta box callback
function scathach_merch_meta_box($post) {
    wp_nonce_field('scathach_merch_nonce', 'scathach_merch_nonce_field');
    $price = get_post_meta($post->ID, '_merch_price', true);
    $link = get_post_meta($post->ID, '_merch_link', true);
    ?>
    <p>
        <label><strong>Price:</strong></label><br>
        <input type="text" name="merch_price" value="<?php echo esc_attr($price); ?>" placeholder="e.g., €25.00" style="width:100%;">
    </p>
    <p>
        <label><strong>Purchase Link:</strong></label><br>
        <input type="url" name="merch_link" value="<?php echo esc_attr($link); ?>" placeholder="https://" style="width:100%;">
    </p>
    <?php
}

// Album meta box callback
function scathach_album_meta_box($post) {
    wp_nonce_field('scathach_album_nonce', 'scathach_album_nonce_field');
    $spotify_link = get_post_meta($post->ID, '_album_spotify', true);
    $apple_link = get_post_meta($post->ID, '_album_apple', true);
    ?>
    <p>
        <label><strong>Spotify Link:</strong></label><br>
        <input type="url" name="album_spotify" value="<?php echo esc_attr($spotify_link); ?>" placeholder="https://spotify.com/..." style="width:100%;">
    </p>
    <p>
        <label><strong>Apple Music Link:</strong></label><br>
        <input type="url" name="album_apple" value="<?php echo esc_attr($apple_link); ?>" placeholder="https://music.apple.com/..." style="width:100%;">
    </p>
    <?php
}

// Save custom field data
function scathach_save_custom_fields($post_id) {
    // Check nonce and autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    // Save Show fields
    if (isset($_POST['scathach_show_nonce_field']) && wp_verify_nonce($_POST['scathach_show_nonce_field'], 'scathach_show_nonce')) {
        // Build date from dropdowns
        if (isset($_POST['show_day']) && isset($_POST['show_month']) && isset($_POST['show_year'])) {
            $day = sanitize_text_field($_POST['show_day']);
            $month = sanitize_text_field($_POST['show_month']);
            $year = sanitize_text_field($_POST['show_year']);
            
            if ($day && $month && $year) {
                $date_obj = DateTime::createFromFormat('Y-m-d', "$year-$month-$day");
                if ($date_obj) {
                    $formatted_date = $date_obj->format('F d, Y'); // e.g., "March 15, 2026"
                    update_post_meta($post_id, '_show_date', $formatted_date);
                }
            }
        }
        
        // Build doors time from dropdowns
        if (isset($_POST['doors_hour']) && isset($_POST['doors_minute']) && isset($_POST['doors_period'])) {
            $hour = sanitize_text_field($_POST['doors_hour']);
            $minute = sanitize_text_field($_POST['doors_minute']);
            $period = sanitize_text_field($_POST['doors_period']);
            
            if ($hour && $minute && $period) {
                $formatted_doors_time = $hour . ':' . $minute . ' ' . $period;
                update_post_meta($post_id, '_doors_time', $formatted_doors_time);
            }
        }
        
        // Build show time from dropdowns
        if (isset($_POST['show_hour']) && isset($_POST['show_minute']) && isset($_POST['show_period'])) {
            $hour = sanitize_text_field($_POST['show_hour']);
            $minute = sanitize_text_field($_POST['show_minute']);
            $period = sanitize_text_field($_POST['show_period']);
            
            if ($hour && $minute && $period) {
                $formatted_show_time = $hour . ':' . $minute . ' ' . $period;
                update_post_meta($post_id, '_show_time', $formatted_show_time);
            }
        }
        
        if (isset($_POST['show_venue'])) update_post_meta($post_id, '_show_venue', sanitize_text_field($_POST['show_venue']));
        if (isset($_POST['show_location'])) update_post_meta($post_id, '_show_location', sanitize_text_field($_POST['show_location']));
        if (isset($_POST['show_description'])) update_post_meta($post_id, '_show_description', sanitize_textarea_field($_POST['show_description']));
        if (isset($_POST['ticket_price'])) update_post_meta($post_id, '_ticket_price', sanitize_text_field($_POST['ticket_price']));
        if (isset($_POST['ticket_link'])) update_post_meta($post_id, '_ticket_link', esc_url_raw($_POST['ticket_link']));
        if (isset($_POST['show_status'])) update_post_meta($post_id, '_show_status', sanitize_text_field($_POST['show_status']));
    }
    
    // Save Merch fields
    if (isset($_POST['scathach_merch_nonce_field']) && wp_verify_nonce($_POST['scathach_merch_nonce_field'], 'scathach_merch_nonce')) {
        if (isset($_POST['merch_price'])) update_post_meta($post_id, '_merch_price', sanitize_text_field($_POST['merch_price']));
        if (isset($_POST['merch_link'])) update_post_meta($post_id, '_merch_link', esc_url_raw($_POST['merch_link']));
    }
    
    // Save Album fields
    if (isset($_POST['scathach_album_nonce_field']) && wp_verify_nonce($_POST['scathach_album_nonce_field'], 'scathach_album_nonce')) {
        if (isset($_POST['album_spotify'])) update_post_meta($post_id, '_album_spotify', esc_url_raw($_POST['album_spotify']));
        if (isset($_POST['album_apple'])) update_post_meta($post_id, '_album_apple', esc_url_raw($_POST['album_apple']));
    }
}
add_action('save_post', 'scathach_save_custom_fields');
