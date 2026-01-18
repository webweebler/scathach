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
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>