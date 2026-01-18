<?php
/**
 * Template for Blog page (home.php is WordPress's blog template)
 */

get_header(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/blog.css">

    <!-- Main Content -->
    <main class="main-content">
        <!-- Latest News Section -->
        <section class="latest-news-section">
            <div class="blog-wrapper">
                <div class="blog-content">
                    <div class="blog-label">BLOG</div>
                    <div class="news-container">
                        <div class="news-header">
                            <h2 class="news-title" id="dynamic-news-title">
                                <?php
                                // Get first post title for header
                                $first_post = new WP_Query(array(
                                    'posts_per_page' => 1,
                                    'orderby' => 'date',
                                    'order' => 'DESC'
                                ));
                                if ($first_post->have_posts()) :
                                    while ($first_post->have_posts()) : $first_post->the_post();
                                        $short_title = strlen(get_the_title()) > 20 ? substr(get_the_title(), 0, 20) . '...' : get_the_title();
                                        echo strtoupper(str_replace(' ', '<br>', esc_html($short_title)));
                                    endwhile;
                                    wp_reset_postdata();
                                else:
                                    echo 'NEWS';
                                endif;
                                ?>
                            </h2>
                        </div>
                        
                        <div class="news-content">
                            <!-- Featured Article -->
                            <?php
                            $featured_post = new WP_Query(array(
                                'posts_per_page' => 1,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));
                            
                            if ($featured_post->have_posts()) :
                                while ($featured_post->have_posts()) : $featured_post->the_post();
                                    $featured_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/images/scathachPic1.jpg';
                                    $full_content = get_the_content();
                                    ?>
                                    <div class="featured-article" id="featured-article">
                                        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>" class="featured-image">
                                        <div class="featured-content">
                                            <div class="featured-date"><?php echo get_the_date('F j, Y'); ?></div>
                                            <h3 class="featured-title"><?php the_title(); ?></h3>
                                            <p class="featured-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 50); ?></p>
                                            <div class="featured-full-content" style="display: none;">
                                                <?php echo wpautop($full_content); ?>
                                            </div>
                                            <a href="#" class="read-more-link">....read more</a>
                                        </div>
                                    </div>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            else :
                                ?>
                                <div class="featured-article">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/scathachPic1.jpg" alt="No posts yet" class="featured-image">
                                    <div class="featured-content">
                                        <div class="featured-date"><?php echo date('F j, Y'); ?></div>
                                        <h3 class="featured-title">Coming Soon!</h3>
                                        <p class="featured-excerpt">Stay tuned for news, updates, and behind-the-scenes content from Scáthach.</p>
                                    </div>
                                </div>
                                <?php
                            endif;
                            ?>
                            
                            <!-- Sidebar Posts -->
                            <div class="news-sidebar-container">
                                <button class="sidebar-scroll-arrow scroll-up" onclick="scrollSidebar('up')">
                                    <div class="arrow-up"></div>
                                </button>
                                
                                <button class="mobile-scroll-arrow up" onclick="mobileScrollSidebar('up')">
                                    <div class="arrow"></div>
                                </button>
                                
                                <div class="news-sidebar">
                                    <?php
                                    // Get all posts for sidebar
                                    $sidebar_posts = new WP_Query(array(
                                        'posts_per_page' => -1,
                                        'orderby' => 'date',
                                        'order' => 'DESC'
                                    ));
                                    
                                    if ($sidebar_posts->have_posts()) :
                                        while ($sidebar_posts->have_posts()) : $sidebar_posts->the_post();
                                            $post_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'medium') : get_template_directory_uri() . '/images/scathachGalleryPic2.jpg';
                                            $post_excerpt = wp_trim_words(get_the_excerpt(), 15);
                                            $full_content = get_the_content();
                                            ?>
                                            <article class="news-item" 
                                                     data-post-id="post-<?php the_ID(); ?>"
                                                     data-image="<?php echo esc_url(has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/images/scathachPic1.jpg'); ?>"
                                                     data-date="<?php echo get_the_date('F j, Y'); ?>"
                                                     data-title="<?php echo esc_attr(get_the_title()); ?>"
                                                     data-excerpt="<?php echo esc_attr(wp_trim_words(get_the_excerpt(), 50)); ?>"
                                                     data-content="<?php echo esc_attr($full_content); ?>">
                                                <img src="<?php echo esc_url($post_image); ?>" alt="<?php the_title(); ?>" class="news-thumbnail">
                                                <div class="news-text">
                                                    <h4 class="news-item-title"><?php the_title(); ?></h4>
                                                    <p><?php echo $post_excerpt; ?></p>
                                                    <div class="news-date"><?php echo get_the_date('F j, Y'); ?></div>
                                                </div>
                                            </article>
                                            <?php
                                        endwhile;
                                        wp_reset_postdata();
                                    else :
                                        ?>
                                        <p style="padding: 20px; color: #ccc;">No posts yet. Add some blog posts to get started!</p>
                                        <?php
                                    endif;
                                    ?>
                                </div>
                                
                                <button class="mobile-scroll-arrow down" onclick="mobileScrollSidebar('down')">
                                    <div class="arrow"></div>
                                </button>
                                
                                <button class="sidebar-scroll-arrow scroll-down" onclick="scrollSidebar('down')">
                                    <div class="arrow-down"></div>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .featured-full-content {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 165, 0, 0.3);
            line-height: 1.8;
            color: #fff;
            font-size: 1rem;
            max-height: none;
            overflow: visible;
            margin-bottom: 30px;
        }
        
        .featured-full-content p {
            margin-bottom: 20px;
        }
        
        .featured-full-content:last-child {
            margin-bottom: 40px;
            padding-bottom: 20px;
        }
        
        .featured-content {
            min-height: auto;
            padding-bottom: 20px;
        }
        
        .read-more-link {
            display: inline-block;
            margin-top: 15px;
            margin-bottom: 20px;
        }
    </style>

    <script src="<?php echo get_template_directory_uri(); ?>/js/blog.js"></script>

<?php get_footer(); ?>
