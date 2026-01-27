<?php
/**
 * Template Name: Dummy Page
 * Description: A black page with Scathach logo in the background
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@200;300;400;700&family=Diplomata+SC&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body, html {
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: #000000;
        }
        
        .dummy-page {
            width: 100%;
            height: 100vh;
            background-color: #000000;
            position: relative;
        }
        
        .dummy-page::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('<?php echo get_template_directory_uri(); ?>/images/logo1.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: contain;
            opacity: 0.3;
            z-index: 1;
        }
        
        .coming-soon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
        }
        
        .coming-soon h1 {
            font-family: 'Diplomata SC', serif;
            font-size: 4rem;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.25rem;
            margin: 0;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5),
                         0 0 40px rgba(255, 255, 255, 0.3);
        }
        
        @media (max-width: 768px) {
            .coming-soon h1 {
                font-size: 2.5rem;
                letter-spacing: 0.15rem;
            }
        }
        
        @media (max-width: 480px) {
            .coming-soon h1 {
                font-size: 1.8rem;
                letter-spacing: 0.1rem;
            }
        }
    </style>
</head>
<body>
    <div class="dummy-page">
        <div class="coming-soon">
            <h1>Coming Soon</h1>
        </div>
    </div>
    <?php wp_footer(); ?>
</body>
</html>
