<?php
/**
 * Template for Contact page
 * Template Name: Contact Page
 */

get_header(); ?>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-wrapper">
                <div class="contact-content">
                    <div class="contact-container">
                        <div class="contact-header">
                            <h2 class="contact-title">GET IN<br>TOUCH</h2>
                        </div>
                        
                        <div class="contact-main">
                            <div class="contact-form-section">
                                <div class="contact-intro">
                                    <p>Ready to connect with Scáthach? Whether you're looking to book us for your venue, 
                                    have press inquiries, or just want to say hello, we'd love to hear from you.</p>
                                </div>
                                
                                <form class="contact-form" id="contactForm">
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" id="name" name="name" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="email">Email *</label>
                                        <input type="email" id="email" name="email" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="subject">Subject *</label>
                                        <select id="subject" name="subject" required>
                                            <option value="">Select a subject...</option>
                                            <option value="booking">Booking Inquiry</option>
                                            <option value="collaboration">Collaboration</option>
                                            <option value="fan">Fan Message</option>
                                            <option value="general">General Inquiry</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="message">Message *</label>
                                        <textarea id="message" name="message" rows="6" required placeholder="Tell us what's on your mind..."></textarea>
                                    </div>
                                    
                                    <button type="submit" class="submit-btn">Send Message</button>
                                </form>
                            </div>
                            
                            <div class="contact-info-section">
                                <div class="contact-info-card">
                                    <h3>Direct Contact</h3>
                                    <div class="contact-details">
                                        <div class="contact-item">
                                            <span class="contact-icon">📧</span>
                                            <div>
                                                <strong>General Inquiries</strong>
                                                <p>info@scathach.com</p>
                                            </div>
                                        </div>
                                        
                                        <div class="contact-item">
                                            <span class="contact-icon">🎵</span>
                                            <div>
                                                <strong>Booking & Shows</strong>
                                                <p>booking@scathach.com</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="social-connect">
                                    <h3>Follow Our Journey</h3>
                                    <p>Stay connected with us on social media for the latest updates, behind-the-scenes content, and exclusive announcements.</p>
                                    <div class="social-links">
                                        <a href="https://www.facebook.com/profile.php?id=61572786083629" class="social-link" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                                            <span>Facebook</span>
                                        </a>
                                        <a href="https://www.instagram.com/scathach_official/" class="social-link" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                                            <span>Instagram</span>
                                        </a>
                                        <a href="https://youtube.com/scathach" class="social-link" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                                            <span>YouTube</span>
                                        </a>
                                        <a href="https://open.spotify.com/artist/scathach" class="social-link" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/sptfyIcon.svg" alt="Spotify">
                                            <span>Spotify</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="<?php echo get_template_directory_uri(); ?>/js/contact.js"></script>

<?php get_footer(); ?>