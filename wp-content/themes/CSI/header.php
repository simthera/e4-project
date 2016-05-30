<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body class="<?php body_class(); ?>">
<section class="menu-wrapper">
    <div class="grid grid-pad">
        <div class="col-3-12">
            <div class="content logo">
                <a href="/">
                    <img src="<?php echo get_template_directory_uri() ?>/CSI/Assets/Images/csi-logo.png">
                </a>
            </div>
        </div>
        <div class="col-9-12 nav-wrapper">
            <div class="content">
                <div class="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
                    <a class="toggle-nav" href="#">&#9776;</a>
                </div>
            </div>
        </div>
    </div>
</section>