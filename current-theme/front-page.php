<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div id="background"></div>
    
    <!-- Logo Header - Separate from corner menu for mobile -->
    <header id="site-header">
        <a href="<?php echo home_url(); ?>" class="logo-link">
            <img src="<?php echo get_template_directory_uri(); ?>/images/logo2.png" alt="Scathach Logo" class="logo-image">
            <span class="logo-text">cáthach</span>
        </a>
    </header>
    
    <!-- Corner Menu Items - Navigation only -->
    <div id="corner-menu-items">
        <div class="corner-link top-right">
            <a href="<?php echo home_url('/blog/'); ?>" class="menu-link">
                Blog
            </a>
        </div>
        <div class="corner-link bottom-left">
            <a href="<?php echo home_url('/about/'); ?>" class="menu-link">
                About
            </a>
        </div>
        <div class="corner-link bottom-right-upper">
            <a href="<?php echo home_url('/contact/'); ?>" class="menu-link">
                Contact
            </a>
        </div>
        <div class="corner-link bottom-right">
            <a href="<?php echo home_url('/venues/'); ?>" class="menu-link">
                Venues
            </a>
        </div>
    </div>
    
    <div class="sections">
        <section id="corner-section">
            <div id="social-icons">
                <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://www.facebook.com/profile.php?id=61572786083629')); ?>" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://www.instagram.com/scathach_official/')); ?>" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('social_youtube', 'https://youtube.com/scathach')); ?>" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('social_spotify', 'https://open.spotify.com/artist/scathach')); ?>" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/sptfyIcon.svg" alt="Spotify">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('social_apple_music', 'https://music.apple.com/us/artist/sc%C3%A1thach/1801620227')); ?>" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/applemusicIcon.svg" alt="Apple Music">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('social_tiktok', 'https://tiktok.com/@scathach')); ?>" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tiktokIcon.svg" alt="TikTok">
                </a>
            </div>
            
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <div class="mobile-menu-overlay" id="mobileMenuOverlay">
                <div class="mobile-menu-content">
                    <a href="<?php echo home_url(); ?>" class="mobile-menu-link" onclick="closeMobileMenu()">Home</a>
                    <a href="<?php echo home_url('/blog/'); ?>" class="mobile-menu-link" onclick="closeMobileMenu()">Blog</a>
                    <a href="<?php echo home_url('/venues/'); ?>" class="mobile-menu-link" onclick="closeMobileMenu()">Venues</a>
                    <a href="<?php echo home_url('/about/'); ?>" class="mobile-menu-link" onclick="closeMobileMenu()">About</a>
                    <a href="<?php echo home_url('/contact/'); ?>" class="mobile-menu-link" onclick="closeMobileMenu()">Contact</a>
                    
                    <div class="mobile-menu-social">
                        <div class="mobile-social-row mobile-social-top">
                            <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://www.facebook.com/profile.php?id=61572786083629')); ?>" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                            </a>
                            <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://www.instagram.com/scathach_official/')); ?>" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                            </a>
                            <a href="<?php echo esc_url(get_theme_mod('social_youtube', 'https://youtube.com/scathach')); ?>" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                            </a>
                        </div>
                        <div class="mobile-social-row mobile-social-bottom">
                            <a href="<?php echo esc_url(get_theme_mod('social_spotify', 'https://open.spotify.com/artist/scathach')); ?>" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sptfyIcon.svg" alt="Spotify">
                            </a>
                            <a href="<?php echo esc_url(get_theme_mod('social_apple_music', 'https://music.apple.com/us/artist/sc%C3%A1thach/1801620227')); ?>" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/applemusicIcon.svg" alt="Apple Music">
                            </a>
                            <a href="<?php echo esc_url(get_theme_mod('social_tiktok', 'https://tiktok.com/@scathach')); ?>" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/tiktokIcon.svg" alt="TikTok">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="text-boxes-container">
                <?php
                // Get customizable text box settings
                $textbox_1_title = get_theme_mod('textbox_1_title', 'Latest News');
                $textbox_1_text = get_theme_mod('textbox_1_text', 'Stay updated with our latest releases and tour announcements.');
                $textbox_1_link = get_theme_mod('textbox_1_link', '/blog/');
                
                $textbox_2_title = get_theme_mod('textbox_2_title', 'Celtic Heritage');
                $textbox_2_text = get_theme_mod('textbox_2_text', 'Exploring ancient legends through modern musical expression.');
                $textbox_2_link = get_theme_mod('textbox_2_link', '/about/');
                
                $textbox_3_title = get_theme_mod('textbox_3_title', 'Join Our Journey');
                $textbox_3_text = get_theme_mod('textbox_3_text', 'Follow Scáthach as we forge new paths in music and storytelling.');
                $textbox_3_link = get_theme_mod('textbox_3_link', '/contact/');
                
                // Convert relative URLs to absolute
                $textbox_1_url = (strpos($textbox_1_link, 'http') === 0) ? $textbox_1_link : home_url($textbox_1_link);
                $textbox_2_url = (strpos($textbox_2_link, 'http') === 0) ? $textbox_2_link : home_url($textbox_2_link);
                $textbox_3_url = (strpos($textbox_3_link, 'http') === 0) ? $textbox_3_link : home_url($textbox_3_link);
                ?>
                <a href="<?php echo esc_url($textbox_1_url); ?>" class="text-box">
                    <h3><?php echo esc_html($textbox_1_title); ?></h3>
                    <p><?php echo esc_html($textbox_1_text); ?></p>
                </a>
                <a href="<?php echo esc_url($textbox_2_url); ?>" class="text-box">
                    <h3><?php echo esc_html($textbox_2_title); ?></h3>
                    <p><?php echo esc_html($textbox_2_text); ?></p>
                </a>
                <a href="<?php echo esc_url($textbox_3_url); ?>" class="text-box text-box-large">
                    <h3><?php echo esc_html($textbox_3_title); ?></h3>
                    <p><?php echo esc_html($textbox_3_text); ?></p>
                </a>
            </div>
         </section>

         <section id="blog">
           <div class="blog-label">BLOG</div>
           <div class="blog-wrapper">
                <?php
                // Get latest 3 blog posts
                $latest_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'order' => 'DESC'
                ));
                
                if ($latest_posts->have_posts()) :
                    while ($latest_posts->have_posts()) : $latest_posts->the_post();
                        $featured_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : get_template_directory_uri() . '/images/scathachPic1.jpg';
                ?>
                <a href="<?php echo home_url('/blog/#post-' . get_the_ID()); ?>" class="blog-post-link">
                    <article class="blog-post">
                        <div class="blog-image">
                            <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </div>
                        <div class="blog-content">
                            <h3 class="blog-title"><?php the_title(); ?></h3>
                            <p class="blog-date"><?php echo get_the_date('F j, Y'); ?></p>
                            <p class="blog-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 25, '...'); ?></p>
                            <span class="read-more">Read More</span>
                        </div>
                    </article>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                <p style="color: #fff; text-align: center; padding: 40px;">No blog posts yet. Add some posts to get started!</p>
                <?php endif; ?>
            </div>
            <div class="blog-more-wrapper">
                <a href="<?php echo home_url('/blog/'); ?>" class="blog-more-btn">More</a>
            </div>
        </section>  

        <?php if (!get_theme_mod('hide_merch_section', false)) : ?>
        <section id="merch">
           <div class="merch-wrapper">
              <div class="merch-content">
                  <div class="merch-label">MERCH</div>
                  <div class="merch-scroll-container">
                      <div class="merch-item merch-button-item">
                          <a href="#" class="merch-shop-btn">Shop Merch</a>
                      </div>
                      
                      <?php
                      // Query merch items from WordPress admin
                      $merch_args = array(
                          'post_type' => 'merch',
                          'post_status' => 'publish',
                          'posts_per_page' => -1, // Get all merch items
                          'orderby' => 'date',
                          'order' => 'DESC' // Show newest first
                      );
                      $merch_query = new WP_Query($merch_args);
                      
                      if ($merch_query->have_posts()) :
                          while ($merch_query->have_posts()) : $merch_query->the_post();
                              $price = get_post_meta(get_the_ID(), '_merch_price', true);
                              $link = get_post_meta(get_the_ID(), '_merch_link', true);
                              $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                              
                              // Fallback to default image if no thumbnail
                              if (!$thumbnail) {
                                  $thumbnail = get_template_directory_uri() . '/images/default-merch.jpg';
                              }
                      ?>
                      <div class="merch-item">
                          <div class="merch-image">
                              <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                          </div>
                          <div class="merch-info">
                              <h3 class="merch-name"><?php the_title(); ?></h3>
                              <?php if ($price) : ?>
                                  <p class="merch-price"><?php echo esc_html($price); ?></p>
                              <?php endif; ?>
                              <?php if ($link) : ?>
                                  <a href="<?php echo esc_url($link); ?>" target="_blank" rel="noopener" class="merch-btn">Buy Now</a>
                              <?php else : ?>
                                  <button class="merch-btn">View</button>
                              <?php endif; ?>
                          </div>
                      </div>
                      <?php 
                          endwhile;
                          wp_reset_postdata();
                      else : 
                      ?>
                      <!-- No merch items found - show simple message -->
                      <div class="merch-item">
                          <div class="merch-info" style="text-align: center; width: 100%;">
                              <h3 class="merch-name">No merch items yet</h3>
                              <p class="merch-price">Add items in WordPress Admin → Merch</p>
                          </div>
                      </div>
                      <?php endif; ?>
                  </div>
              </div>
           </div>
        </section>
        <?php endif; ?>

        <section id="tickets">
           <div class="tickets-video-background">
               <?php 
               $venue_video = get_theme_mod('venue_video_background', get_template_directory_uri() . '/videos/scathachVideo1.mp4');
               if (!empty($venue_video)) : ?>
               <video autoplay muted loop>
                   <source src="<?php echo esc_url($venue_video); ?>" type="video/mp4">
               </video>
               <?php endif; ?>
           </div>
           <div class="tickets-wrapper">
                <div class="venues-label">VENUES</div>
                <div class="tickets-grid">
                    <?php
                    // Get upcoming shows (same logic as venues page)
                    $today = date('Y-m-d');
                    $upcoming_shows = array();
                    
                    $all_shows_query = new WP_Query(array(
                        'post_type' => 'show',
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    ));
                    
                    if ($all_shows_query->have_posts()) :
                        while ($all_shows_query->have_posts()) : $all_shows_query->the_post();
                            $show_date = get_post_meta(get_the_ID(), '_show_date', true);
                            if ($show_date) {
                                $show_timestamp = strtotime($show_date);
                                $today_timestamp = strtotime($today);
                                if ($show_timestamp >= $today_timestamp) {
                                    $upcoming_shows[] = array(
                                        'id' => get_the_ID(),
                                        'timestamp' => $show_timestamp
                                    );
                                }
                            }
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    
                    // Sort by date
                    usort($upcoming_shows, function($a, $b) {
                        return $a['timestamp'] - $b['timestamp'];
                    });
                    
                    // Get first 4 upcoming shows
                    $shows_to_display = array_slice($upcoming_shows, 0, 4);
                    $positions = array('top-left', 'top-right', 'bottom-left', 'bottom-right');
                    
                    if (!empty($shows_to_display)) :
                        foreach ($shows_to_display as $index => $show_data) :
                            $show_query = new WP_Query(array(
                                'post_type' => 'show',
                                'posts_per_page' => 1,
                                'post__in' => array($show_data['id'])
                            ));
                            
                            if ($show_query->have_posts()) :
                                while ($show_query->have_posts()) : $show_query->the_post();
                                    $date = get_post_meta(get_the_ID(), '_show_date', true);
                                    $venue = get_post_meta(get_the_ID(), '_show_venue', true);
                                    $location = get_post_meta(get_the_ID(), '_show_location', true);
                                    $position = $positions[$index];
                                    ?>
                    <a href="<?php echo home_url('/venues/#show-' . get_the_ID()); ?>" class="ticket-link">
                        <div class="ticket-corner <?php echo esc_attr($position); ?>">
                            <div class="ticket-content">
                                <h3><?php echo esc_html($venue); ?></h3>
                                <p class="date"><?php echo esc_html(date('M j, Y', strtotime($date))); ?></p>
                                <p class="venue"><?php echo esc_html($location); ?></p>
                                <span class="ticket-btn">Buy Tickets</span>
                            </div>
                        </div>
                    </a>
                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        endforeach;
                    else :
                        // Fallback if no shows
                        for ($i = 0; $i < 4; $i++) :
                            $position = $positions[$i];
                    ?>
                    <a href="<?php echo home_url('/venues/'); ?>" class="ticket-link">
                        <div class="ticket-corner <?php echo esc_attr($position); ?>">
                            <div class="ticket-content">
                                <h3>No Shows</h3>
                                <p class="date">Coming Soon</p>
                                <p class="venue">Stay Tuned</p>
                                <span class="ticket-btn">More Info</span>
                            </div>
                        </div>
                    </a>
                    <?php
                        endfor;
                    endif;
                    ?>
                </div>
                <div class="more-venues-wrapper">
                    <a href="<?php echo home_url('/venues/'); ?>" class="more-venues-btn">More Venues</a>
                </div>
            </div>
        </section>  

        <section id="gallery">
           <div class="gallery-label">GALLERY</div>
         <div class="gallery-wrapper">
                <div class="sparkle-container"></div>
                <div class="scroll-container horizontal-scroll-wrapper">
                    <?php
                    // Get images from Gallery custom post type
                    $gallery_query = new WP_Query(array(
                        'post_type' => 'gallery_item',
                        'posts_per_page' => -1,
                        'orderby' => 'menu_order date',
                        'order' => 'ASC',
                        'post_status' => 'publish'
                    ));
                    
                    if ($gallery_query->have_posts()) :
                        $count = 0;
                        $total = $gallery_query->post_count;
                        while ($gallery_query->have_posts()) : $gallery_query->the_post();
                            $count++;
                            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
                            $img_alt = get_the_title();
                            $last_class = ($count === $total) ? ' id="galleryLastImg"' : '';
                            
                            if ($img_url) :
                    ?>
                    <div class="gallery-img-wrapper"><img<?php echo $last_class; ?> src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>"></div>
                    <?php
                            endif;
                        endwhile;
                        wp_reset_postdata();
                    else :
                        // Fallback to hard-coded images if no gallery items
                    ?>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg" alt="Scathach"></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/taylorLily.jpg" alt="Scathach"></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic3.jpg" alt="Scathach"></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic2.jpg" alt="Scathach"></div>
                    <div class="gallery-img-wrapper"><img id="galleryLastImg" src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic4.jpg" alt="Scathach"></div>
                    <?php endif; ?>
                </div>
            </div>
        </section>  

        <?php if (!get_theme_mod('hide_accordion_section', false)) : ?>
        <section id="accordion">
           <div class="accordion-label">ALBUMS</div>
            <div class="horizontal-accordion">
                <?php
                // Get albums from WordPress
                $albums_query = new WP_Query(array(
                    'post_type' => 'album',
                    'posts_per_page' => 4,
                    'orderby' => 'menu_order date',
                    'order' => 'ASC',
                    'post_status' => 'publish'
                ));
                
                if ($albums_query->have_posts()) :
                    while ($albums_query->have_posts()) : $albums_query->the_post();
                        $album_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
                        $listen_link = get_post_meta(get_the_ID(), '_album_listen_link', true);
                        
                        // Use featured image or fallback
                        if (!$album_image) {
                            $album_image = get_template_directory_uri() . '/images/scathachPic1.jpg';
                        }
                ?>
                <div class="accordion-panel" data-bg="<?php echo esc_url($album_image); ?>">
                    <div class="panel-header">
                        <h3><?php echo strtoupper(get_the_title()); ?></h3>
                    </div>
                    <div class="panel-content">
                        <a href="<?php echo esc_url($listen_link ? $listen_link : '#'); ?>" class="accordion-link" <?php echo $listen_link ? 'target="_blank"' : ''; ?>>LISTEN NOW</a>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback if no albums
                ?>
                <div class="accordion-panel" data-bg="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg">
                    <div class="panel-header">
                        <h3>ECHOES</h3>
                    </div>
                    <div class="panel-content">
                        <a href="#" class="accordion-link">LISTEN NOW</a>
                    </div>
                </div>
                <div class="accordion-panel" data-bg="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic2.jpg">
                    <div class="panel-header">
                        <h3>SHADOWS</h3>
                    </div>
                    <div class="panel-content">
                        <a href="#" class="accordion-link">LISTEN NOW</a>
                    </div>
                </div>
                <div class="accordion-panel" data-bg="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic3.jpg">
                    <div class="panel-header">
                        <h3>WARRIORS</h3>
                    </div>
                    <div class="panel-content">
                        <a href="#" class="accordion-link">LISTEN NOW</a>
                    </div>
                </div>
                <div class="accordion-panel" data-bg="<?php echo get_template_directory_uri(); ?>/images/band1.jpg">
                    <div class="panel-header">
                        <h3>LEGENDS</h3>
                    </div>
                    <div class="panel-content">
                        <a href="#" class="accordion-link">LISTEN NOW</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php endif; ?>

         <section id="music">
           <div class="music-label">MUSIC</div>
           <div class="music-wrapper">
              <div class="spotify-player-container">
                  <iframe data-testid="embed-iframe" style="border-radius:0px" src="https://open.spotify.com/embed/artist/7oXD9KvMquYYDTsKG0OEdO?utm_source=generator&theme=0" width="100%" height="380" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
              </div>
              <div class="music-button-container">
                  <a href="<?php echo esc_url(get_theme_mod('social_apple_music', 'https://music.apple.com/us/artist/sc%C3%A1thach/1801620227')); ?>" target="_blank" class="music-btn">Apple Music</a>
                  <a href="<?php echo esc_url(get_theme_mod('social_youtube_music', 'https://www.youtube.com/@Scathachmusic')); ?>" target="_blank" class="music-btn">YouTube</a>
                  <a href="<?php echo esc_url(get_theme_mod('social_spotify', 'https://open.spotify.com/artist/scathach')); ?>" target="_blank" class="music-btn">Spotify</a>
              </div>
            </div>
        </section>

    </div>

    <div class="footer">
        <div class="footer-container">
            <div class="footer-left">
            </div>
            
            <div class="footer-center">
                <div class="footer-social">
                    <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://www.facebook.com/profile.php?id=61572786083629')); ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://www.instagram.com/scathach_official/')); ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('social_youtube', 'https://youtube.com/scathach')); ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('social_spotify', 'https://open.spotify.com/artist/scathach')); ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/sptfyIcon.svg" alt="Spotify">
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('social_apple_music', 'https://music.apple.com/us/artist/sc%C3%A1thach/1801620227')); ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/applemusicIcon.svg" alt="Apple Music">
                    </a>
                    <a href="<?php echo esc_url(get_theme_mod('social_tiktok', 'https://tiktok.com/@scathach')); ?>" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/tiktokIcon.svg" alt="TikTok">
                    </a>
                </div>
                <div class="footer-links">
                    <a href="<?php echo home_url('/about/'); ?>">About</a> | 
                    <a href="<?php echo home_url('/blog/'); ?>">Blog</a> | 
                    <a href="<?php echo home_url('/contact/'); ?>">Contact</a> | 
                    <a href="<?php echo home_url('/venues/'); ?>">Venues</a>
                </div>
                <p class="footer-copyright">&copy; <?php echo date('Y'); ?> Scáthach. All rights reserved.</p>
            </div>
            
            <div class="footer-right">
            </div>
        </div>
    </div>

    <script src="<?php echo get_template_directory_uri(); ?>/js/index.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/lightbox.js"></script>
    <?php wp_footer(); ?>
</body>
</html>