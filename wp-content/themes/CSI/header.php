<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body class="<?php body_class(); ?>">
    <div class="navigation-bar">
        <div class="logo">
            <img src="<?php echo get_template_directory_uri();?>/images/e4_logo.png" alt="E4" width="200">
        </div>
        <div class="main-navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>

            <div class="client-log-in">
                <a href="">CLIENT SIGN IN</a>
            </div>
        </div>
        <div class="support-info">
            <p>Support Centre:</p>
            <p>+27 86 087 7877 or</p>
            <p>support@e4.co.za</p>
        </div>

    </div>






