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

        <?php
        // Display sections 1-10, but only if they have content
        $section_counter = 1;
        
        for ($i = 1; $i <= 10; $i++) {
            // Get default values for the first 6 sections
            $default_title = '';
            $default_text = '';
            $default_image = '';
            $default_layout = 'text-left';
            
            if ($i <= 6) {
                $defaults = array(
                    1 => array(
                        'title' => 'Our Story',
                        'text' => 'Born from the mists of Irish mythology, Scáthach emerged in 2018 as a force that bridges ancient Celtic legends with modern metal fury. Named after the legendary warrior woman who trained heroes on the Isle of Skye, we carry forward her legacy of strength, wisdom, and fierce determination.',
                        'image' => get_template_directory_uri() . '/images/scathachGalleryPic2.jpg',
                        'layout' => 'text-left'
                    ),
                    2 => array(
                        'title' => 'Our Sound',
                        'text' => 'We forge a unique path in metal by weaving traditional Irish instruments with crushing guitar riffs and thunderous drums. Our music tells stories of ancient warriors, mystical landscapes, and the eternal struggle between light and darkness that defines Celtic mythology.',
                        'image' => get_template_directory_uri() . '/images/scathachGalleryPic3.jpg',
                        'layout' => 'text-right'
                    ),
                    3 => array(
                        'title' => 'Live Performances',
                        'text' => 'On stage, we transform into the warriors of old, bringing raw energy and theatrical storytelling to every performance. From intimate venues to festival stages, each show is a journey through the mystical realms of Celtic lore, complete with traditional costumes and immersive visuals.',
                        'image' => get_template_directory_uri() . '/images/scathachGalleryPic4.jpg',
                        'layout' => 'text-left'
                    ),
                    4 => array(
                        'title' => 'Our Journey',
                        'text' => 'From small Dublin pubs to international festivals, our path has been one of constant growth and artistic evolution. Three albums deep into our discography, we\'ve explored themes from the Book of Invasions to modern interpretations of ancient Celtic wisdom, always pushing the boundaries of folk metal.',
                        'image' => get_template_directory_uri() . '/images/scathachPic1.jpg',
                        'layout' => 'text-right'
                    ),
                    5 => array(
                        'title' => 'Recognition',
                        'text' => 'Our dedication to authentic Celtic metal has earned recognition from critics and fans alike. From winning "Best New Metal Act" to topping Irish metal charts, we\'ve proven that traditional stories can find new life in heavy music while staying true to their mystical roots.',
                        'image' => get_template_directory_uri() . '/images/merchimg1.jpg',
                        'layout' => 'text-left'
                    ),
                    6 => array(
                        'title' => 'The Future',
                        'text' => 'As we look ahead, our mission remains unchanged: to keep the ancient stories alive through powerful music. With new material exploring the deeper mysteries of Celtic cosmology and plans for international tours, the legend of Scáthach continues to grow stronger with each passing season.',
                        'image' => get_template_directory_uri() . '/images/merchImg2.webp',
                        'layout' => 'text-right'
                    )
                );
                
                $default_title = $defaults[$i]['title'];
                $default_text = $defaults[$i]['text'];
                $default_image = $defaults[$i]['image'];
                $default_layout = $defaults[$i]['layout'];
            }
            
            $title = get_theme_mod("about_section_{$i}_title", $default_title);
            $text = get_theme_mod("about_section_{$i}_text", $default_text);
            $image = get_theme_mod("about_section_{$i}_image", $default_image);
            $layout = get_theme_mod("about_section_{$i}_layout", $default_layout);
            
            // Skip empty sections (no title means section is disabled)
            if (empty($title)) {
                continue;
            }
            
            // Set default image if none provided
            if (empty($image)) {
                $image = get_template_directory_uri() . '/images/scathachGalleryPic2.jpg';
            }
            ?>
            
            <!-- Section <?php echo $section_counter; ?>: <?php echo esc_html($title); ?> -->
            <section class="horizontal-section section-<?php echo $section_counter; ?>">
                <div class="section-content">
                    <button class="nav-arrow arrow-left">▲</button>
                    
                    <?php if ($layout === 'text-right'): ?>
                        <!-- Image first, then text -->
                        <div class="section-image">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                        </div>
                        <div class="section-text">
                            <h2><?php echo esc_html($title); ?></h2>
                            <p><?php echo esc_html($text); ?></p>
                        </div>
                    <?php else: ?>
                        <!-- Text first, then image -->
                        <div class="section-text">
                            <h2><?php echo esc_html($title); ?></h2>
                            <p><?php echo esc_html($text); ?></p>
                        </div>
                        <div class="section-image">
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                        </div>
                    <?php endif; ?>
                    
                    <button class="nav-arrow arrow-right">▼</button>
                </div>
            </section>
            
            <?php
            $section_counter++;
        }
        ?>
    </main>

    <script src="<?php echo get_template_directory_uri(); ?>/js/about.js"></script>

<?php get_footer(); ?>