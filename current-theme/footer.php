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
                    <a href="<?php echo home_url('/venues/'); ?>">Venues</a> | 
                    <a href="<?php echo home_url('/terms/'); ?>">Terms</a>
                </div>
                <p class="footer-copyright">&copy; <?php echo date('Y'); ?> Scáthach. All rights reserved.</p>
            </div>
            
            <div class="footer-right">
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>