<?php
/**
 * Template for About page
 * Template Name: About Page
 */

get_header(); ?>

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
                <?php
                $section_1_title = get_theme_mod('about_section_1_title', 'Our Story');
                $section_1_text = get_theme_mod('about_section_1_text', 'Born from the mists of Irish mythology, Scáthach emerged in 2018 as a force that bridges ancient Celtic legends with modern metal fury. Named after the legendary warrior woman who trained heroes on the Isle of Skye, we carry forward her legacy of strength, wisdom, and fierce determination.');
                $section_1_image = get_theme_mod('about_section_1_image', get_template_directory_uri() . '/images/scathachGalleryPic2.jpg');
                ?>
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-text">
                    <h2><?php echo esc_html($section_1_title); ?></h2>
                    <p><?php echo esc_html($section_1_text); ?></p>
                </div>
                <div class="section-image">
                    <img src="<?php echo esc_url($section_1_image); ?>" alt="<?php echo esc_attr($section_1_title); ?>">
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 2: Our Sound -->
        <section class="horizontal-section section-2">
            <div class="section-content">
                <?php
                $section_2_title = get_theme_mod('about_section_2_title', 'Our Sound');
                $section_2_text = get_theme_mod('about_section_2_text', 'We forge a unique path in metal by weaving traditional Irish instruments with crushing guitar riffs and thunderous drums. Our music tells stories of ancient warriors, mystical landscapes, and the eternal struggle between light and darkness that defines Celtic mythology.');
                $section_2_image = get_theme_mod('about_section_2_image', get_template_directory_uri() . '/images/scathachGalleryPic3.jpg');
                ?>
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-image">
                    <img src="<?php echo esc_url($section_2_image); ?>" alt="<?php echo esc_attr($section_2_title); ?>">
                </div>
                <div class="section-text">
                    <h2><?php echo esc_html($section_2_title); ?></h2>
                    <p><?php echo esc_html($section_2_text); ?></p>
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 3: Live Performances -->
        <section class="horizontal-section section-3">
            <div class="section-content">
                <?php
                $section_3_title = get_theme_mod('about_section_3_title', 'Live Performances');
                $section_3_text = get_theme_mod('about_section_3_text', 'On stage, we transform into the warriors of old, bringing raw energy and theatrical storytelling to every performance. From intimate venues to festival stages, each show is a journey through the mystical realms of Celtic lore, complete with traditional costumes and immersive visuals.');
                $section_3_image = get_theme_mod('about_section_3_image', get_template_directory_uri() . '/images/scathachGalleryPic4.jpg');
                ?>
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-text">
                    <h2><?php echo esc_html($section_3_title); ?></h2>
                    <p><?php echo esc_html($section_3_text); ?></p>
                </div>
                <div class="section-image">
                    <img src="<?php echo esc_url($section_3_image); ?>" alt="<?php echo esc_attr($section_3_title); ?>">
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 4: Our Journey -->
        <section class="horizontal-section section-4">
            <div class="section-content">
                <?php
                $section_4_title = get_theme_mod('about_section_4_title', 'Our Journey');
                $section_4_text = get_theme_mod('about_section_4_text', 'From small Dublin pubs to international festivals, our path has been one of constant growth and artistic evolution. Three albums deep into our discography, we\'ve explored themes from the Book of Invasions to modern interpretations of ancient Celtic wisdom, always pushing the boundaries of folk metal.');
                $section_4_image = get_theme_mod('about_section_4_image', get_template_directory_uri() . '/images/scathachPic1.jpg');
                ?>
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-image">
                    <img src="<?php echo esc_url($section_4_image); ?>" alt="<?php echo esc_attr($section_4_title); ?>">
                </div>
                <div class="section-text">
                    <h2><?php echo esc_html($section_4_title); ?></h2>
                    <p><?php echo esc_html($section_4_text); ?></p>
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 5: Recognition -->
        <section class="horizontal-section section-5">
            <div class="section-content">
                <?php
                $section_5_title = get_theme_mod('about_section_5_title', 'Recognition');
                $section_5_text = get_theme_mod('about_section_5_text', 'Our dedication to authentic Celtic metal has earned recognition from critics and fans alike. From winning "Best New Metal Act" to topping Irish metal charts, we\'ve proven that traditional stories can find new life in heavy music while staying true to their mystical roots.');
                $section_5_image = get_theme_mod('about_section_5_image', get_template_directory_uri() . '/images/merchimg1.jpg');
                ?>
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-text">
                    <h2><?php echo esc_html($section_5_title); ?></h2>
                    <p><?php echo esc_html($section_5_text); ?></p>
                </div>
                <div class="section-image">
                    <img src="<?php echo esc_url($section_5_image); ?>" alt="<?php echo esc_attr($section_5_title); ?>">
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>

        <!-- Section 6: The Future -->
        <section class="horizontal-section section-6">
            <div class="section-content">
                <?php
                $section_6_title = get_theme_mod('about_section_6_title', 'The Future');
                $section_6_text = get_theme_mod('about_section_6_text', 'As we look ahead, our mission remains unchanged: to keep the ancient stories alive through powerful music. With new material exploring the deeper mysteries of Celtic cosmology and plans for international tours, the legend of Scáthach continues to grow stronger with each passing season.');
                $section_6_image = get_theme_mod('about_section_6_image', get_template_directory_uri() . '/images/merchImg2.webp');
                ?>
                <button class="nav-arrow arrow-left">▲</button>
                <div class="section-image">
                    <img src="<?php echo esc_url($section_6_image); ?>" alt="<?php echo esc_attr($section_6_title); ?>">
                </div>
                <div class="section-text">
                    <h2><?php echo esc_html($section_6_title); ?></h2>
                    <p><?php echo esc_html($section_6_text); ?></p>
                </div>
                <button class="nav-arrow arrow-right">▼</button>
            </div>
        </section>
    </main>

    <script src="<?php echo get_template_directory_uri(); ?>/js/about.js"></script>

<?php get_footer(); ?>