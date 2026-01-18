<?php
/**
 * Template for Venues page
 * Template Name: Venues Page
 */

get_header(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/venues.css">

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
                            <div class="featured-show">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic4.jpg" alt="Upcoming Show" class="featured-venue-image">
                                <div class="featured-show-content">
                                    <div class="show-date">March 15, 2026</div>
                                    <h3 class="featured-venue-name">The Celtic Crown Theatre</h3>
                                    <p class="venue-location">Dublin, Ireland</p>
                                    <p class="show-description">Join us for an unforgettable evening of Celtic fusion as we bring our latest album to life in the heart of Dublin. Experience the magic of ancient traditions woven with modern innovation in this intimate venue.</p>
                                    <div class="show-details">
                                        <span class="show-time">Doors: 7:00 PM • Show: 8:00 PM</span>
                                        <span class="ticket-price">€35-€65</span>
                                    </div>
                                    <a href="#" class="tickets-link">Get Tickets</a>
                                </div>
                            </div>

                            <!-- Upcoming Shows Sidebar -->
                            <div class="shows-sidebar-container">
                                <!-- Scroll Arrows -->
                                <button class="sidebar-scroll-arrow scroll-up" onclick="scrollSidebar('up')">
                                    <div class="arrow-up"></div>
                                </button>

                                <div class="shows-sidebar">
                                    <div class="sidebar-show" data-show-id="mar-22">
                                        <div class="sidebar-show-date">
                                            <span class="month">MAR</span>
                                            <span class="day">22</span>
                                        </div>
                                        <div class="sidebar-show-info">
                                            <h4 class="sidebar-venue">The Mystic Hall</h4>
                                            <p class="sidebar-location">Cork, Ireland</p>
                                            <span class="sidebar-status available">Available</span>
                                        </div>
                                    </div>

                                    <div class="sidebar-show" data-show-id="apr-05">
                                        <div class="sidebar-show-date">
                                            <span class="month">APR</span>
                                            <span class="day">05</span>
                                        </div>
                                        <div class="sidebar-show-info">
                                            <h4 class="sidebar-venue">Ancient Grounds Festival</h4>
                                            <p class="sidebar-location">Galway, Ireland</p>
                                            <span class="sidebar-status selling-fast">Selling Fast</span>
                                        </div>
                                    </div>

                                    <div class="sidebar-show" data-show-id="apr-18">
                                        <div class="sidebar-show-date">
                                            <span class="month">APR</span>
                                            <span class="day">18</span>
                                        </div>
                                        <div class="sidebar-show-info">
                                            <h4 class="sidebar-venue">The Emerald Theatre</h4>
                                            <p class="sidebar-location">Limerick, Ireland</p>
                                            <span class="sidebar-status available">Available</span>
                                        </div>
                                    </div>

                                    <div class="sidebar-show" data-show-id="may-10">
                                        <div class="sidebar-show-date">
                                            <span class="month">MAY</span>
                                            <span class="day">10</span>
                                        </div>
                                        <div class="sidebar-show-info">
                                            <h4 class="sidebar-venue">Celtic Legends Venue</h4>
                                            <p class="sidebar-location">Belfast, Northern Ireland</p>
                                            <span class="sidebar-status available">Available</span>
                                        </div>
                                    </div>

                                    <div class="sidebar-show" data-show-id="may-24">
                                        <div class="sidebar-show-date">
                                            <span class="month">MAY</span>
                                            <span class="day">24</span>
                                        </div>
                                        <div class="sidebar-show-info">
                                            <h4 class="sidebar-venue">Highland Music Festival</h4>
                                            <p class="sidebar-location">Edinburgh, Scotland</p>
                                            <span class="sidebar-status few-left">Few Left</span>
                                        </div>
                                    </div>

                                    <div class="sidebar-show" data-show-id="jun-07">
                                        <div class="sidebar-show-date">
                                            <span class="month">JUN</span>
                                            <span class="day">07</span>
                                        </div>
                                        <div class="sidebar-show-info">
                                            <h4 class="sidebar-venue">The Dragon's Den</h4>
                                            <p class="sidebar-location">Cardiff, Wales</p>
                                            <span class="sidebar-status available">Available</span>
                                        </div>
                                    </div>
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
                    <div class="past-show-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic2.jpg" alt="Past Performance" class="past-show-image">
                        <div class="past-show-info">
                            <h3>The Moonlight Pavilion</h3>
                            <p>Dublin, Ireland</p>
                            <span class="past-show-date">February 14, 2026</span>
                        </div>
                    </div>
                    
                    <div class="past-show-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic3.jpg" alt="Past Performance" class="past-show-image">
                        <div class="past-show-info">
                            <h3>Celtic Heritage Center</h3>
                            <p>Cork, Ireland</p>
                            <span class="past-show-date">January 28, 2026</span>
                        </div>
                    </div>
                    
                    <div class="past-show-card">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/WhatsApp Image 2025-05-20 at 20.29.22_5e77b6ad.jpg" alt="Past Performance" class="past-show-image">
                        <div class="past-show-info">
                            <h3>The Ancient Oak</h3>
                            <p>Galway, Ireland</p>
                            <span class="past-show-date">December 15, 2025</span>
                        </div>
                    </div>
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