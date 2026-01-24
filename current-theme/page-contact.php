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
                                    <p>Ready to connect with Scáthach? Whether you have questions, want to collaborate, 
                                    or just want to say hello, we'd love to hear from you.</p>
                                </div>
                                
                                <form class="contact-form" id="contactForm">
                                    <?php
                                    // Get customizable contact form settings
                                    $form_email = get_theme_mod('contact_form_email', 'info@scathach.com');
                                    $subject_1 = get_theme_mod('contact_subject_1', 'General Inquiry');
                                    $subject_2 = get_theme_mod('contact_subject_2', 'Collaboration');
                                    $subject_3 = get_theme_mod('contact_subject_3', 'Fan Message');
                                    $subject_4 = get_theme_mod('contact_subject_4', 'Press Inquiry');
                                    $subject_5 = get_theme_mod('contact_subject_5', '');
                                    ?>
                                    <input type="hidden" name="form_recipient" value="<?php echo esc_attr($form_email); ?>">
                                    
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
                                            <?php if ($subject_1) : ?><option value="<?php echo esc_attr(strtolower(str_replace(' ', '_', $subject_1))); ?>"><?php echo esc_html($subject_1); ?></option><?php endif; ?>
                                            <?php if ($subject_2) : ?><option value="<?php echo esc_attr(strtolower(str_replace(' ', '_', $subject_2))); ?>"><?php echo esc_html($subject_2); ?></option><?php endif; ?>
                                            <?php if ($subject_3) : ?><option value="<?php echo esc_attr(strtolower(str_replace(' ', '_', $subject_3))); ?>"><?php echo esc_html($subject_3); ?></option><?php endif; ?>
                                            <?php if ($subject_4) : ?><option value="<?php echo esc_attr(strtolower(str_replace(' ', '_', $subject_4))); ?>"><?php echo esc_html($subject_4); ?></option><?php endif; ?>
                                            <?php if ($subject_5) : ?><option value="<?php echo esc_attr(strtolower(str_replace(' ', '_', $subject_5))); ?>"><?php echo esc_html($subject_5); ?></option><?php endif; ?>
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
                                    <h3>Get in Touch</h3>
                                    <div class="contact-details">
                                        <div class="contact-item">
                                            <span class="contact-icon">📧</span>
                                            <div>
                                                <strong>General Enquiries</strong>
                                                <p>We'd love to hear from you! Send us a message using the form or reach out directly for any questions, collaborations, or just to say hello.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="social-connect">
                                    <h3>Follow Our Journey</h3>
                                    <p>Stay connected with us on social media for the latest updates, behind-the-scenes content, and exclusive announcements.</p>
                                    <div class="social-links">
                                        <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://www.facebook.com/profile.php?id=61572786083629')); ?>" class="social-link" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                                            <span>Facebook</span>
                                        </a>
                                        <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://www.instagram.com/scathach_official/')); ?>" class="social-link" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                                            <span>Instagram</span>
                                        </a>
                                        <a href="<?php echo esc_url(get_theme_mod('social_youtube', 'https://youtube.com/scathach')); ?>" class="social-link" target="_blank">
                                            <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                                            <span>YouTube</span>
                                        </a>
                                        <a href="<?php echo esc_url(get_theme_mod('social_spotify', 'https://open.spotify.com/artist/scathach')); ?>" class="social-link" target="_blank">
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