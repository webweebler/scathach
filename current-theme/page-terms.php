<?php
/**
 * Template for Terms and Conditions page
 * Template Name: Terms and Conditions
 */

get_header(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/terms.css">

    <!-- Main Content -->
    <main class="main-content">
        <section class="terms-section">
            <div class="terms-wrapper">
                <div class="terms-content">
                    <div class="terms-container">
                        
                        <div class="terms-header">
                            <h1 class="terms-title">Terms and Conditions</h1>
                            <p class="terms-last-updated">Last Updated: <?php echo date('F j, Y'); ?></p>
                        </div>
                        
                        <div class="terms-main-content">
                            
                            <?php
                            $intro_text = get_theme_mod('terms_intro_text', 'Welcome to Scáthach\'s official website. These Terms and Conditions ("Terms") govern your use of our website and services. By accessing or using our website, you agree to be bound by these Terms.');
                            if (!empty($intro_text)) : ?>
                            <section class="terms-intro">
                                <p><?php echo esc_html($intro_text); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_1_title = get_theme_mod('terms_section_1_title', '1. Acceptance of Terms');
                            $section_1_content = get_theme_mod('terms_section_1_content', 'By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement. If you do not agree to abide by the above, please do not use this service.');
                            if (!empty($section_1_title) && !empty($section_1_content)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_1_title); ?></h2>
                                <p><?php echo esc_html($section_1_content); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_2_title = get_theme_mod('terms_section_2_title', '2. Use License');
                            $section_2_content = get_theme_mod('terms_section_2_content', 'Permission is granted to temporarily download one copy of the materials (information or software) on Scáthach\'s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title.');
                            if (!empty($section_2_title) && !empty($section_2_content)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_2_title); ?></h2>
                                <p><?php echo nl2br(esc_html($section_2_content)); ?></p>
                                <?php if (strpos($section_2_content, 'license') !== false) : ?>
                                <ul>
                                    <li>modify or copy the materials</li>
                                    <li>use the materials for any commercial purpose or for any public display (commercial or non-commercial)</li>
                                    <li>attempt to decompile or reverse engineer any software contained on the website</li>
                                    <li>remove any copyright or other proprietary notations from the materials</li>
                                </ul>
                                <p>This license shall automatically terminate if you violate any of these restrictions and may be terminated by Scáthach at any time.</p>
                                <?php endif; ?>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_3_title = get_theme_mod('terms_section_3_title', '3. Music and Content');
                            $music_content_text = get_theme_mod('terms_music_content', 'All music, videos, images, and other content on this website are the intellectual property of Scáthach and are protected by copyright laws. You may stream or download content only for personal, non-commercial use. Redistribution, commercial use, or unauthorized sharing of our content is strictly prohibited.');
                            if (!empty($section_3_title) && !empty($music_content_text)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_3_title); ?></h2>
                                <p><?php echo esc_html($music_content_text); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_4_title = get_theme_mod('terms_section_4_title', '4. User Conduct');
                            $section_4_content = get_theme_mod('terms_section_4_content', 'When using our website, you agree not to: use the website for any unlawful purpose, post or transmit offensive content, attempt unauthorized access, or interfere with the website.');
                            if (!empty($section_4_title) && !empty($section_4_content)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_4_title); ?></h2>
                                <p><?php echo nl2br(esc_html($section_4_content)); ?></p>
                                <?php if (strpos($section_4_content, 'agree not to') !== false) : ?>
                                <ul>
                                    <li>Use the website for any unlawful purpose or to solicit others to engage in unlawful activities</li>
                                    <li>Post or transmit any content that is offensive, inappropriate, or violates the rights of others</li>
                                    <li>Attempt to gain unauthorized access to any portion of the website</li>
                                    <li>Interfere with or disrupt the website or servers connected to the website</li>
                                </ul>
                                <?php endif; ?>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_5_title = get_theme_mod('terms_section_5_title', '5. Privacy Policy');
                            $section_5_content = get_theme_mod('terms_section_5_content', 'Your privacy is important to us. Any personal information collected through this website is governed by our Privacy Policy, which is incorporated into these Terms by reference.');
                            if (!empty($section_5_title) && !empty($section_5_content)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_5_title); ?></h2>
                                <p><?php echo esc_html($section_5_content); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_6_title = get_theme_mod('terms_section_6_title', '6. Merchandise and Sales');
                            $merchandise_text = get_theme_mod('terms_merchandise', 'All merchandise sales are final unless the item received is defective or damaged. We reserve the right to limit quantities and refuse service. Prices are subject to change without notice.');
                            if (!empty($section_6_title) && !empty($merchandise_text)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_6_title); ?></h2>
                                <p><?php echo esc_html($merchandise_text); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_7_title = get_theme_mod('terms_section_7_title', '7. Live Events and Tickets');
                            $events_text = get_theme_mod('terms_events', 'Ticket sales for live events are subject to venue-specific terms and conditions. Refunds may be available in accordance with venue policies. We are not responsible for cancelled or rescheduled events due to circumstances beyond our control.');
                            if (!empty($section_7_title) && !empty($events_text)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_7_title); ?></h2>
                                <p><?php echo esc_html($events_text); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_8_title = get_theme_mod('terms_section_8_title', '8. Disclaimer');
                            $section_8_content = get_theme_mod('terms_section_8_content', 'The materials on Scáthach\'s website are provided on an \'as is\' basis. Scáthach makes no warranties, expressed or implied, and hereby disclaims all other warranties.');
                            if (!empty($section_8_title) && !empty($section_8_content)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_8_title); ?></h2>
                                <p><?php echo esc_html($section_8_content); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_9_title = get_theme_mod('terms_section_9_title', '9. Limitations');
                            $section_9_content = get_theme_mod('terms_section_9_content', 'In no event shall Scáthach be liable for any damages arising out of the use or inability to use the materials on the website.');
                            if (!empty($section_9_title) && !empty($section_9_content)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_9_title); ?></h2>
                                <p><?php echo esc_html($section_9_content); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_10_title = get_theme_mod('terms_section_10_title', '10. Changes to Terms');
                            $section_10_content = get_theme_mod('terms_section_10_content', 'Scáthach may revise these Terms at any time without notice. By using this website, you agree to be bound by the current version of these Terms.');
                            if (!empty($section_10_title) && !empty($section_10_content)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_10_title); ?></h2>
                                <p><?php echo esc_html($section_10_content); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $section_11_title = get_theme_mod('terms_section_11_title', '11. Governing Law');
                            $governing_law_text = get_theme_mod('terms_governing_law', 'These Terms and Conditions are governed by and construed in accordance with the laws of Ireland and you irrevocably submit to the exclusive jurisdiction of the courts in that State or location.');
                            if (!empty($section_11_title) && !empty($governing_law_text)) : ?>
                            <section class="terms-section-item">
                                <h2><?php echo esc_html($section_11_title); ?></h2>
                                <p><?php echo esc_html($governing_law_text); ?></p>
                            </section>
                            <?php endif; ?>

                            <?php
                            $contact_section_title = get_theme_mod('terms_contact_section_title', 'Contact Information');
                            $contact_text = get_theme_mod('terms_contact_text', 'If you have any questions about these Terms and Conditions, please contact us through our contact page.');
                            if (!empty($contact_section_title) && !empty($contact_text)) : ?>
                            <section class="terms-contact">
                                <h2><?php echo esc_html($contact_section_title); ?></h2>
                                <p><?php echo wp_kses_post($contact_text); ?> <a href="<?php echo home_url('/contact'); ?>">Contact us here</a>.</p>
                            </section>
                            <?php endif; ?>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="<?php echo get_template_directory_uri(); ?>/js/terms.js"></script>

<?php get_footer(); ?>