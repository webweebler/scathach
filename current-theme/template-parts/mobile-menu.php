<?php
/**
 * Mobile Menu Component
 * Template part for mobile menu overlay
 */
?>

<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay" id="mobileMenuOverlay">
    <div class="mobile-menu-content">
        <a href="<?php echo home_url(); ?>" class="mobile-menu-link">Home</a>
        <a href="<?php echo home_url('/blog/'); ?>" class="mobile-menu-link">Blog</a>
        <a href="<?php echo home_url('/venues/'); ?>" class="mobile-menu-link">Venues</a>
        <a href="<?php echo home_url('/about/'); ?>" class="mobile-menu-link">About</a>
        <a href="<?php echo home_url('/contact/'); ?>" class="mobile-menu-link">Contact</a>
        
        <div class="mobile-menu-social">
            <div class="mobile-social-row mobile-social-top">
                <a href="<?php echo esc_url(get_theme_mod('social_facebook', 'https://www.facebook.com/profile.php?id=61572786083629')); ?>" class="mobile-social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/fbIcon.svg" alt="Facebook">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('social_instagram', 'https://www.instagram.com/scathach_official/')); ?>" class="mobile-social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/instaIcon.svg" alt="Instagram">
                </a>
                <a href="<?php echo esc_url(get_theme_mod('social_youtube_music', 'https://music.youtube.com/channel/UC_scathach')); ?>" class="mobile-social-icon" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/ytIcon.svg" alt="YouTube Music">
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
    <div class="mobile-menu-bottom">
        <a href="<?php echo home_url('/terms/'); ?>" class="mobile-terms-bottom-link">Terms & Conditions</a>
    </div>
</div>