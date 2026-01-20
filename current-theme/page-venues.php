<?php
/**
 * Template for Venues page
 * Template Name: Venues Page
 */

get_header(); ?>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Venues & Tours Section -->
        <section class="venues-section">
            <div class="venues-wrapper">
                <div class="venues-content">
                    <div class="venues-container">
                        <div class="venues-header">
                            <h2 class="venues-title">UPCOMING<br>SHOWS</h2>
                        </div>

                        <div class="venues-main-content">
                            <!-- Featured Show -->
                            <?php
                            // Get all upcoming shows and filter for future dates only
                            $all_upcoming = new WP_Query(array(
                                'post_type' => 'show',
                                'posts_per_page' => -1,
                                'meta_key' => '_show_date',
                                'orderby' => 'meta_value',
                                'order' => 'ASC'
                            ));
                            
                            $upcoming_shows = array();
                            $today = strtotime(date('Y-m-d'));
                            
                            if ($all_upcoming->have_posts()) :
                                while ($all_upcoming->have_posts()) : $all_upcoming->the_post();
                                    $show_date = get_post_meta(get_the_ID(), '_show_date', true);
                                    $show_timestamp = strtotime($show_date);
                                    
                                    if ($show_timestamp && $show_timestamp >= $today) {
                                        $upcoming_shows[] = get_the_ID();
                                    }
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            
                            // Get the first upcoming show
                            if (!empty($upcoming_shows)) :
                                $featured_query = new WP_Query(array(
                                    'post_type' => 'show',
                                    'posts_per_page' => 1,
                                    'post__in' => array($upcoming_shows[0]),
                                ));
                            else :
                                $featured_query = new WP_Query(array('post_type' => 'show', 'posts_per_page' => 0));
                            endif;
                            
                            if ($featured_query->have_posts()) :
                                while ($featured_query->have_posts()) : $featured_query->the_post();
                                    $date = get_post_meta(get_the_ID(), '_show_date', true);
                                    $venue = get_post_meta(get_the_ID(), '_show_venue', true);
                                    $location = get_post_meta(get_the_ID(), '_show_location', true);
                                    $ticket_link = get_post_meta(get_the_ID(), '_ticket_link', true);
                                    $description = get_post_meta(get_the_ID(), '_show_description', true);
                                    $doors_time = get_post_meta(get_the_ID(), '_doors_time', true);
                                    $show_time = get_post_meta(get_the_ID(), '_show_time', true);
                                    $ticket_price = get_post_meta(get_the_ID(), '_ticket_price', true);
                                    $featured_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/images/scathachGalleryPic4.jpg';
                                    ?>
                                    <div class="featured-show">
                                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" class="featured-venue-image">
                                        <div class="featured-show-content">
                                            <div class="show-date"><?php echo esc_html($date); ?></div>
                                            <h3 class="featured-venue-name"><?php echo esc_html($venue); ?></h3>
                                            <p class="venue-location"><?php echo esc_html($location); ?></p>
                                            <?php if ($description) : ?>
                                            <p class="show-description"><?php echo esc_html($description); ?></p>
                                            <?php endif; ?>
                                            <?php if ($doors_time || $show_time || $ticket_price) : ?>
                                            <div class="show-details">
                                                <?php if ($doors_time || $show_time) : ?>
                                                <span class="show-time">
                                                    <?php 
                                                    $time_parts = array();
                                                    if ($doors_time) $time_parts[] = 'Doors: ' . esc_html($doors_time);
                                                    if ($show_time) $time_parts[] = 'Show: ' . esc_html($show_time);
                                                    echo implode(' • ', $time_parts);
                                                    ?>
                                                </span>
                                                <?php endif; ?>
                                                <?php if ($ticket_price) : ?>
                                                <span class="ticket-price"><?php echo esc_html($ticket_price); ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                            <a href="<?php echo $ticket_link ? esc_url($ticket_link) : '#'; ?>" class="tickets-link" <?php if ($ticket_link) echo 'target="_blank"'; ?>>Get Tickets</a>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                // Fallback featured show
                                ?>
                                <div class="featured-show">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic4.jpg" alt="Upcoming Show" class="featured-venue-image">
                                    <div class="featured-show-content">
                                        <div class="show-date">Coming Soon</div>
                                        <h3 class="featured-venue-name">Check Back Soon</h3>
                                        <p class="venue-location">New shows coming!</p>
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>

                            <!-- Upcoming Shows Sidebar -->
                            <div class="shows-sidebar-container">
                                <!-- Scroll Arrows -->
                                <button class="sidebar-scroll-arrow scroll-up" onclick="scrollSidebar('up')">
                                    <div class="arrow-up"></div>
                                </button>

                                <div class="shows-sidebar">
                                    <?php
                                    // Show ALL upcoming shows in sidebar (including featured)
                                    // Users can click any show to make it featured
                                    
                                    if (!empty($upcoming_shows)) :
                                        $sidebar_query = new WP_Query(array(
                                            'post_type' => 'show',
                                            'posts_per_page' => -1,
                                            'post__in' => $upcoming_shows,
                                            'orderby' => 'post__in',
                                            'order' => 'ASC'
                                        ));
                                    else :
                                        $sidebar_query = new WP_Query(array('post_type' => 'show', 'posts_per_page' => 0));
                                    endif;
                                    
                                    if ($sidebar_query->have_posts()) :
                                        $show_index = 0;
                                        while ($sidebar_query->have_posts()) : $sidebar_query->the_post();
                                            $date = get_post_meta(get_the_ID(), '_show_date', true);
                                            $venue = get_post_meta(get_the_ID(), '_show_venue', true);
                                            $location = get_post_meta(get_the_ID(), '_show_location', true);
                                            $ticket_link = get_post_meta(get_the_ID(), '_ticket_link', true);
                                            $status = get_post_meta(get_the_ID(), '_show_status', true);
                                            $description = get_post_meta(get_the_ID(), '_show_description', true);
                                            $doors_time = get_post_meta(get_the_ID(), '_doors_time', true);
                                            $show_time = get_post_meta(get_the_ID(), '_show_time', true);
                                            $ticket_price = get_post_meta(get_the_ID(), '_ticket_price', true);
                                            $sidebar_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/images/scathachGalleryPic4.jpg';
                                            $show_id = 'show-' . get_the_ID();
                                            
                                            // Try to parse the date for display
                                            $month_display = '';
                                            $day_display = '';
                                            if ($date) {
                                                $parsed_date = strtotime($date);
                                                if ($parsed_date) {
                                                    $month_display = strtoupper(date('M', $parsed_date));
                                                    $day_display = date('d', $parsed_date);
                                                }
                                            }
                                            
                                            // Status badge styling
                                            $status_class = '';
                                            $status_text = '';
                                            if ($status === 'available') {
                                                $status_class = 'status-available';
                                                $status_text = 'AVAILABLE';
                                            } elseif ($status === 'selling-fast') {
                                                $status_class = 'status-selling-fast';
                                                $status_text = 'SELLING FAST';
                                            } elseif ($status === 'sold-out') {
                                                $status_class = 'status-sold-out';
                                                $status_text = 'SOLD OUT';
                                            }
                                            // Build time display string
                                            $time_display = '';
                                            $time_parts = array();
                                            if ($doors_time) $time_parts[] = 'Doors: ' . $doors_time;
                                            if ($show_time) $time_parts[] = 'Show: ' . $show_time;
                                            if (!empty($time_parts)) {
                                                $time_display = implode(' • ', $time_parts);
                                            }
                                            ?>
                                            <div class="sidebar-show" 
                                                 data-show-id="<?php echo esc_attr($show_id); ?>"
                                                 data-image="<?php echo esc_url($sidebar_image); ?>"
                                                 data-date="<?php echo esc_attr($date); ?>"
                                                 data-venue="<?php echo esc_attr($venue); ?>"
                                                 data-location="<?php echo esc_attr($location); ?>"
                                                 data-description="<?php echo esc_attr($description); ?>"
                                                 data-time="<?php echo esc_attr($time_display); ?>"
                                                 data-price="<?php echo esc_attr($ticket_price); ?>"
                                                 data-ticket-link="<?php echo esc_url($ticket_link); ?>">
                                                <div class="sidebar-show-date">
                                                    <span class="month"><?php echo $month_display ? esc_html($month_display) : 'TBA'; ?></span>
                                                    <span class="day"><?php echo $day_display ? esc_html($day_display) : ''; ?></span>
                                                </div>
                                                <div class="sidebar-show-info">
                                                    <h4><?php echo esc_html($venue ? $venue : get_the_title()); ?></h4>
                                                    <p><?php echo esc_html($location); ?></p>
                                                    <?php if ($status_text) : ?>
                                                    <span class="show-status <?php echo esc_attr($status_class); ?>"><?php echo esc_html($status_text); ?></span>
                                                    <?php endif; ?>
                                                    <?php if ($ticket_link) : ?>
                                                    <a href="<?php echo esc_url($ticket_link); ?>" target="_blank">Get Tickets</a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php
                                            $show_index++;
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        // No additional shows
                                        ?>
                                        <div class="sidebar-show">
                                            <div class="sidebar-show-info">
                                                <p>More shows coming soon!</p>
                                            </div>
                                        </div>
                                        <?php
                                    endif;
                                    ?>
                                </div>
                                <button class="sidebar-scroll-arrow scroll-down" onclick="scrollSidebar('down')">
                                    <div class="arrow-down"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Past Shows Section -->
        <section class="past-shows-section">
            <div class="past-shows-container">
                <h2 class="section-title">Recent Performances</h2>
                <div class="past-shows-grid">
                    <?php
                    // Get all shows
                    $all_shows_query = new WP_Query(array(
                        'post_type' => 'show',
                        'posts_per_page' => -1,
                        'meta_key' => '_show_date',
                        'orderby' => 'meta_value',
                        'order' => 'DESC'
                    ));
                    
                    $past_shows = array();
                    $today = strtotime(date('Y-m-d'));
                    
                    // Filter for past shows only
                    if ($all_shows_query->have_posts()) :
                        while ($all_shows_query->have_posts()) : $all_shows_query->the_post();
                            $show_date = get_post_meta(get_the_ID(), '_show_date', true);
                            $show_timestamp = strtotime($show_date);
                            
                            if ($show_timestamp && $show_timestamp < $today) {
                                $past_shows[] = array(
                                    'id' => get_the_ID(),
                                    'date' => $show_date,
                                    'venue' => get_post_meta(get_the_ID(), '_show_venue', true),
                                    'location' => get_post_meta(get_the_ID(), '_show_location', true),
                                    'image' => has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/images/scathachGalleryPic4.jpg'
                                );
                            }
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    
                    // Display past shows (limit to 3 most recent)
                    $past_shows = array_slice($past_shows, 0, 3);
                    
                    if (!empty($past_shows)) :
                        foreach ($past_shows as $past_show) :
                            ?>
                            <div class="past-show-card">
                                <img src="<?php echo esc_url($past_show['image']); ?>" alt="<?php echo esc_attr($past_show['venue']); ?>" class="past-show-image">
                                <div class="past-show-info">
                                    <h3><?php echo esc_html($past_show['venue']); ?></h3>
                                    <p><?php echo esc_html($past_show['location']); ?></p>
                                    <span class="past-show-date"><?php echo esc_html($past_show['date']); ?></span>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    else :
                        // No past shows yet
                        ?>
                        <p style="grid-column: 1 / -1; text-align: center; color: #ccc;">Past performances will appear here after show dates have passed.</p>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>
        
        <!-- Venue Partnerships Section -->
        <section class="venue-partnerships-section">
            <div class="partnerships-container">
                <h2 class="section-title">Venue Partnerships</h2>
                <p class="partnerships-description">
                    We're always looking to connect with venues that share our passion for Celtic culture and live music. 
                    Whether you're a historic theatre, festival organizer, or intimate music venue, we'd love to bring 
                    our unique sound to your space.
                </p>
                <div class="partnership-benefits">
                    <div class="benefit-item">
                        <h3>Professional Production</h3>
                        <p>Complete sound and lighting technical requirements provided</p>
                    </div>
                    <div class="benefit-item">
                        <h3>Promotional Support</h3>
                        <p>Full marketing collaboration and social media promotion</p>
                    </div>
                    <div class="benefit-item">
                        <h3>Flexible Programming</h3>
                        <p>Customizable setlists to fit your venue's unique atmosphere</p>
                    </div>
                </div>
                <a href="<?php echo home_url('/contact'); ?>" class="partnership-cta">Book Us for Your Venue</a>
            </div>
        </section>
    </main>

    <script src="<?php echo get_template_directory_uri(); ?>/js/venues.js"></script>

<?php get_footer(); ?>
