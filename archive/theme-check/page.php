<?php
/**
 * Generic page template
 */

get_header(); ?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/about.css">

    <!-- Main Content -->
    <main class="main-content">
        <section class="page-section">
            <div class="page-wrapper">
                <div class="page-content">
                    <div class="page-container">
                        
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post(); ?>
                                <div class="page-header">
                                    <h1 class="page-title"><?php the_title(); ?></h1>
                                </div>
                                
                                <div class="page-main-content">
                                    <?php the_content(); ?>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php get_footer(); ?>