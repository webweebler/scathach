<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Diplomata+SC&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/index.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/mobile-menu-uniform.css">
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
            <a href="<?php echo home_url('/venues/'); ?>" class="menu-link">
                Venues
            </a>
        </div>
        <div class="corner-link bottom-right-upper">
            <a href="<?php echo home_url('/contact/'); ?>" class="menu-link">
                Contact
            </a>
        </div>
        <div class="corner-link bottom-right">
            <a href="<?php echo home_url('/about/'); ?>" class="menu-link">
                About
            </a>
        </div>
    </div>
    
    <div class="sections">
        <section id="corner-section">
            <div id="social-icons">
                <a href="https://www.facebook.com/profile.php?id=61572786083629" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/scathach_official/" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                </a>
                <a href="https://youtube.com/scathach" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                </a>
                <a href="https://open.spotify.com/artist/scathach" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/sptfyIcon.svg" alt="Spotify">
                </a>
                <a href="https://twitter.com/scathach" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/twitterIcon.svg" alt="Twitter">
                </a>
                <a href="https://tiktok.com/@scathach" class="social-icon" target="_blank">
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
                            <a href="https://www.facebook.com/profile.php?id=61572786083629" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                            </a>
                            <a href="https://www.instagram.com/scathach_official/" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                            </a>
                            <a href="https://youtube.com/scathach" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                            </a>
                        </div>
                        <div class="mobile-social-row mobile-social-bottom">
                            <a href="https://open.spotify.com/artist/scathach" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/sptfyIcon.svg" alt="Spotify">
                            </a>
                            <a href="https://twitter.com/scathach" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/twitterIcon.svg" alt="Twitter">
                            </a>
                            <a href="https://tiktok.com/@scathach" class="mobile-social-icon" target="_blank">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/tiktokIcon.svg" alt="TikTok">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div id="text-boxes-container">
                <a href="<?php echo home_url('/blog/'); ?>" class="text-box">
                    <h3>Latest News</h3>
                    <p>Stay updated with our latest releases and tour announcements.</p>
                </a>
                <a href="<?php echo home_url('/about/'); ?>" class="text-box">
                    <h3>Celtic Heritage</h3>
                    <p>Exploring ancient legends through modern musical expression.</p>
                </a>
                <a href="<?php echo home_url('/contact/'); ?>" class="text-box text-box-large">
                    <h3>Join Our Journey</h3>
                    <p>Follow Scáthach as we forge new paths in music and storytelling.</p>
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
                <a href="<?php echo get_permalink(); ?>" class="blog-post-link">
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

        <section id="merch">
           <div class="merch-wrapper">
              <div class="merch-content">
                  <div class="merch-label">MERCH</div>
                  <div class="merch-scroll-container">
                      <div class="merch-item merch-button-item">
                          <a href="#" class="merch-shop-btn">Shop Merch</a>
                      </div>
                      <div class="merch-item">
                          <div class="merch-image">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/merchImg1.jpg" alt="Band T-Shirt">
                          </div>
                          <div class="merch-info">
                              <h3 class="merch-name">Scáthach T-Shirt</h3>
                              <p class="merch-price">€23.00</p>
                              <button class="merch-btn">View</button>
                          </div>
                      </div>

                      <div class="merch-item">
                          <div class="merch-image">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/merchImg2.webp" alt="Band Hoodie">
                          </div>
                          <div class="merch-info">
                              <h3 class="merch-name">Celtic Hoodie</h3>
                              <p class="merch-price">€42.00</p>
                              <button class="merch-btn">View</button>
                          </div>
                      </div>

                      <div class="merch-item">
                          <div class="merch-image">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/merchimg3.webp" alt="Vinyl Record">
                          </div>
                          <div class="merch-info">
                              <h3 class="merch-name">Latest Album Vinyl</h3>
                              <p class="merch-price">€32.00</p>
                              <button class="merch-btn">View</button>
                          </div>
                      </div>

                      <div class="merch-item">
                          <div class="merch-image">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/merchimg4.png" alt="Band Poster">
                          </div>
                          <div class="merch-info">
                              <h3 class="merch-name">Concert Poster</h3>
                              <p class="merch-price">€14.00</p>
                              <button class="merch-btn">View</button>
                          </div>
                      </div>

                      <div class="merch-item">
                          <div class="merch-image">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg" alt="Band Mug">
                          </div>
                          <div class="merch-info">
                              <h3 class="merch-name">Warrior Mug</h3>
                              <p class="merch-price">€17.00</p>
                              <button class="merch-btn">View</button>
                          </div>
                      </div>

                      <div class="merch-item">
                          <div class="merch-image">
                              <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic2.jpg" alt="Band Cap">
                          </div>
                          <div class="merch-info">
                              <h3 class="merch-name">Celtic Cap</h3>
                              <p class="merch-price">€20.00</p>
                              <button class="merch-btn">View</button>
                          </div>
                      </div>
                  </div>
              </div>
           </div>
        </section>

        <section id="tickets">
           <div class="tickets-video-background">
               <video autoplay muted loop>
                   <source src="<?php echo get_template_directory_uri(); ?>/videos/scathachVideo1.mp4" type="video/mp4">
               </video>
           </div>
           <div class="tickets-wrapper">
                <div class="venues-label">VENUES</div>
                <div class="tickets-grid">
                    <a href="<?php echo home_url('/venues/'); ?>" class="ticket-link">
                        <div class="ticket-corner top-left">
                            <div class="ticket-content">
                                <h3>Dublin</h3>
                                <p class="date">Oct 15, 2025</p>
                                <p class="venue">The Academy</p>
                                <span class="ticket-btn">Buy Tickets</span>
                            </div>
                        </div>
                    </a>
                    
                    <a href="<?php echo home_url('/venues/'); ?>" class="ticket-link">
                        <div class="ticket-corner top-right">
                            <div class="ticket-content">
                                <h3>Cork</h3>
                                <p class="date">Oct 22, 2025</p>
                                <p class="venue">Cyprus Avenue</p>
                                <span class="ticket-btn">Buy Tickets</span>
                            </div>
                        </div>
                    </a>
                    
                    <a href="<?php echo home_url('/venues/'); ?>" class="ticket-link">
                        <div class="ticket-corner bottom-left">
                            <div class="ticket-content">
                                <h3>Galway</h3>
                                <p class="date">Oct 29, 2025</p>
                                <p class="venue">Róisín Dubh</p>
                                <span class="ticket-btn">Buy Tickets</span>
                            </div>
                        </div>
                    </a>
                    
                    <a href="<?php echo home_url('/venues/'); ?>" class="ticket-link">
                        <div class="ticket-corner bottom-right">
                            <div class="ticket-content">
                                <h3>Belfast</h3>
                                <p class="date">Nov 5, 2025</p>
                                <p class="venue">The Limelight</p>
                                <span class="ticket-btn">Buy Tickets</span>
                            </div>
                        </div>
                    </a>
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
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/taylorLily.jpg" alt="scathach image"></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic3.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic2.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic3.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic2.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic3.jpg" alt=""></div>
                    <div class="gallery-img-wrapper"><img id="galleryLastImg" src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic4.jpg" alt=""></div>
                </div>
            </div>
        </section>  

        <section id="accordion">
           <div class="accordion-label">ALBUMS</div>
            <div class="horizontal-accordion">
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
            </div>
        </section>

         <section id="music">
           <div class="music-label">MUSIC</div>
           <div class="music-wrapper">
              <div class="spotify-player-container">
                  <iframe data-testid="embed-iframe" style="border-radius:0px" src="https://open.spotify.com/embed/artist/7oXD9KvMquYYDTsKG0OEdO?utm_source=generator&theme=0" width="100%" height="380" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
              </div>
              <div class="music-button-container">
                  <a href="https://music.apple.com/us/artist/sc%C3%A1thach/1801620227" target="_blank" class="music-btn">Apple Music</a>
                  <a href="https://www.youtube.com/@Scathachmusic" target="_blank" class="music-btn">YouTube</a>
                  <a href="https://open.spotify.com/artist/scathach" target="_blank" class="music-btn">Spotify</a>
              </div>
            </div>
        </section>

    </div>

    <div class="footer">
        <div class="footer-container">
            <div class="footer-left">
                <div class="footer-social">
                    <a href="https://www.facebook.com/profile.php?id=61572786083629" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                    </a>
                    <a href="https://www.instagram.com/scathach_official/" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                    </a>
                    <a href="https://youtube.com/scathach" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                    </a>
                    <a href="https://open.spotify.com/artist/scathach" target="_blank">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/sptfyIcon.svg" alt="Spotify">
                    </a>
                </div>
            </div>
            
            <div class="footer-center">
                <div class="footer-links">
                    <a href="<?php echo home_url('/about/'); ?>">About</a> | 
                    <a href="<?php echo home_url('/blog/'); ?>">Blog</a> | 
                    <a href="#music">Music</a> | 
                    <a href="#merch">Merch</a> | 
                    <a href="<?php echo home_url('/venues/'); ?>">Venues</a>
                </div>
                <p class="footer-copyright">&copy; <?php echo date('Y'); ?> Scáthach. All rights reserved.</p>
            </div>
            
            <div class="footer-right">
                <div class="footer-contact">
                    <a href="<?php echo home_url('/contact/'); ?>">Contact</a>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo get_template_directory_uri(); ?>/js/index.js"></script>
    <?php wp_footer(); ?>
</body>
</html>