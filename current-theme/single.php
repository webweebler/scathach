<?php
/**
 * Template for single blog post
 */

get_header(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/blog.css">

    <!-- Main Content -->
    <main class="main-content">
        <section class="single-post-section">
            <div class="blog-wrapper">
                <div class="blog-content">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            $featured_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'full') : get_template_directory_uri() . '/images/scathachPic1.jpg';
                            ?>
                            <article class="single-post">
                                <div class="post-header">
                                    <div class="post-date"><?php echo get_the_date('F j, Y'); ?></div>
                                    <h1 class="post-title"><?php the_title(); ?></h1>
                                </div>
                                
                                <?php if (has_post_thumbnail()) : ?>
                                <div class="post-featured-image">
                                    <img src="<?php echo esc_url($featured_image); ?>" alt="<?php the_title(); ?>">
                                </div>
                                <?php endif; ?>
                                
                                <div class="post-content">
                                    <?php the_content(); ?>
                                </div>
                                
                                <div class="post-footer">
                                    <a href="<?php echo home_url('/blog'); ?>" class="back-to-blog">← Back to Blog</a>
                                </div>
                            </article>
                            <?php
                        endwhile;
                    else :
                        ?>
                        <p>Post not found.</p>
                        <?php
                    endif;
                    ?>
                </div>
            </div>
        </section>
    </main>

    <style>
        .single-post-section {
            padding: 120px 20px 80px;
            min-height: 100vh;
            background: linear-gradient(rgba(0, 0, 0, 0.85), rgba(0, 0, 0, 0.9));
        }
        
        .single-post {
            max-width: 900px;
            margin: 0 auto;
            background: rgba(0, 0, 0, 0.6);
            border: 1px solid rgba(255, 165, 0, 0.3);
            padding: 40px;
        }
        
        .post-header {
            margin-bottom: 30px;
            border-bottom: 2px solid rgba(255, 165, 0, 0.5);
            padding-bottom: 20px;
        }
        
        .post-date {
            color: #ffa500;
            font-size: 0.9rem;
            font-weight: 300;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .post-title {
            font-family: 'Diplomata SC', serif;
            font-size: 2.5rem;
            color: #fff;
            margin: 0;
            line-height: 1.2;
            max-width: 1400px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .post-featured-image {
            margin: 30px 0;
            overflow: hidden;
            border: 1px solid rgba(255, 165, 0, 0.3);
        }
        
        .post-featured-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .post-content {
            color: #fff;
            font-size: 1.1rem;
            line-height: 1.8;
            margin: 30px 0;
        }
        
        .post-content p {
            margin-bottom: 20px;
        }
        
        .post-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 165, 0, 0.3);
        }
        
        .back-to-blog {
            display: inline-block;
            color: #ffa500;
            text-decoration: none;
            font-weight: 500;
            padding: 10px 20px;
            border: 1px solid rgba(255, 165, 0, 0.5);
            transition: all 0.3s ease;
        }
        
        .back-to-blog:hover {
            background: rgba(255, 165, 0, 0.1);
            border-color: #ffa500;
        }
        
        @media (max-width: 768px) {
            .single-post {
                padding: 20px;
            }
            
            .post-title {
                font-size: 1.8rem;
                max-width: 100%;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            
            .post-content {
                font-size: 1rem;
            }
        }
    </style>

<?php get_footer(); ?>
