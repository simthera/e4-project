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
            <img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="E4">
        </div>
        <div class="main-navigation">
            <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
        </div>

    </div>






