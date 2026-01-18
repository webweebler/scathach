<?php
/**
 * Template for About page
 * Template Name: About Page
 */

get_header(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/about.css">

    <!-- Main Content -->
    <main class="main-content">
        <!-- About Section -->
        <section class="about-section">
            <div class="about-container">
            </div>
        </section>

        <!-- Section 1: Our Story -->
        <section class="horizontal-section section-1">
            <div class="section-content">
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-text">
                    <h2>Our Story</h2>
                    <p>Born from the mists of Irish mythology, Scáthach emerged in 2018 as a force that bridges ancient Celtic legends with modern metal fury. Named after the legendary warrior woman who trained heroes on the Isle of Skye, we carry forward her legacy of strength, wisdom, and fierce determination.</p>
                </div>
                <div class="section-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic2.jpg" alt="Scáthach Band Formation">
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 2: Our Sound -->
        <section class="horizontal-section section-2">
            <div class="section-content">
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic3.jpg" alt="Celtic Instruments">
                </div>
                <div class="section-text">
                    <h2>Our Sound</h2>
                    <p>We forge a unique path in metal by weaving traditional Irish instruments with crushing guitar riffs and thunderous drums. Our music tells stories of ancient warriors, mystical landscapes, and the eternal struggle between light and darkness that defines Celtic mythology.</p>
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 3: Live Performances -->
        <section class="horizontal-section section-3">
            <div class="section-content">
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-text">
                    <h2>Live Performances</h2>
                    <p>On stage, we transform into the warriors of old, bringing raw energy and theatrical storytelling to every performance. From intimate venues to festival stages, each show is a journey through the mystical realms of Celtic lore, complete with traditional costumes and immersive visuals.</p>
                </div>
                <div class="section-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/scathachGalleryPic4.jpg" alt="Live Performance">
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 4: Our Journey -->
        <section class="horizontal-section section-4">
            <div class="section-content">
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg" alt="Band Journey">
                </div>
                <div class="section-text">
                    <h2>Our Journey</h2>
                    <p>From small Dublin pubs to international festivals, our path has been one of constant growth and artistic evolution. Three albums deep into our discography, we've explored themes from the Book of Invasions to modern interpretations of ancient Celtic wisdom, always pushing the boundaries of folk metal.</p>
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 5: Recognition -->
        <section class="horizontal-section section-5">
            <div class="section-content">
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-text">
                    <h2>Recognition</h2>
                    <p>Our dedication to authentic Celtic metal has earned recognition from critics and fans alike. From winning "Best New Metal Act" to topping Irish metal charts, we've proven that traditional stories can find new life in heavy music while staying true to their mystical roots.</p>
                </div>
                <div class="section-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/merchimg1.jpg" alt="Awards and Recognition">
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 6: The Future -->
        <section class="horizontal-section section-6">
            <div class="section-content">
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/merchImg2.webp" alt="Future Vision">
                </div>
                <div class="section-text">
                    <h2>The Future</h2>
                    <p>As we look ahead, our mission remains unchanged: to keep the ancient stories alive through powerful music. With new material exploring the deeper mysteries of Celtic cosmology and plans for international tours, the legend of Scáthach continues to grow stronger with each passing season.</p>
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>
    </main>

    <script src="<?php echo get_template_directory_uri(); ?>/js/about.js"></script>

<?php get_footer(); ?>