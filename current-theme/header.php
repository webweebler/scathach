<?php
/**
 * Header template for standard pages (not front page)
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Header Section -->
    <header class="blog-header">
        <div class="header-overlay"></div>
        <div class="header-content">
            <!-- Logo Section -->
            <div class="header-logo">
                <a href="<?php echo home_url(); ?>" class="logo-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/logo2.png" alt="Scathach Logo" class="logo-image">
                    <span class="logo-text">cáthach</span>
                </a>
            </div>

            <!-- Hamburger Menu -->
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
            <!-- Navigation -->
            <nav class="header-nav">
                <a href="<?php echo home_url(); ?>" class="nav-link <?php echo (is_front_page() ? 'active' : ''); ?>">Home</a>
                <a href="<?php echo home_url('/blog/'); ?>" class="nav-link <?php echo (is_home() || is_category() || is_single() ? 'active' : ''); ?>">Blog</a>
                <a href="<?php echo home_url('/venues/'); ?>" class="nav-link <?php echo (is_page('venues') ? 'active' : ''); ?>">Venues</a>
                <a href="<?php echo home_url('/about/'); ?>" class="nav-link <?php echo (is_page('about') ? 'active' : ''); ?>">About</a>
                <a href="<?php echo home_url('/contact/'); ?>" class="nav-link <?php echo (is_page('contact') ? 'active' : ''); ?>">Contact</a>
            </nav>

            <!-- Mobile Menu Overlay -->
            <div class="mobile-menu-overlay" id="mobileMenuOverlay">
                <div class="mobile-menu-content">
                    <a href="<?php echo home_url(); ?>" class="mobile-menu-link">Home</a>
                    <a href="<?php echo home_url('/blog/'); ?>" class="mobile-menu-link">Blog</a>
                    <a href="<?php echo home_url('/venues/'); ?>" class="mobile-menu-link">Venues</a>
                    <a href="<?php echo home_url('/about/'); ?>" class="mobile-menu-link">About</a>
                    <a href="<?php echo home_url('/contact/'); ?>" class="mobile-menu-link">Contact</a>
                    
                    <div class="mobile-menu-social">
                        <a href="https://www.facebook.com/profile.php?id=61572786083629" class="mobile-social-icon" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                        </a>
                        <a href="https://www.instagram.com/scathach_official/" class="mobile-social-icon" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                        </a>
                        <a href="https://youtube.com/scathach" class="mobile-social-icon" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                        </a>
                        <a href="https://www.tiktok.com/@scathach" class="mobile-social-icon" target="_blank">
                            <img src="<?php echo get_template_directory_uri(); ?>/images/tiktokIcon.svg" alt="TikTok">
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Social Icons -->
            <div class="header-social">
                <a href="https://www.facebook.com/profile.php?id=61572786083629" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/scathach_official/" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                </a>
                <a href="https://youtube.com/scathach" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube">
                </a>
                <a href="https://www.tiktok.com/@scathach" class="social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tiktokIcon.svg" alt="TikTok">
                </a>
            </div>
            
    </header>