<!doctype html>
<html>
<head>
	<meta charset="utf-8"/>
	<?php // force Internet Explorer to use the latest rendering engine available ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title><?php wp_title(''); ?></title>

	<?php // mobile meta (hooray!) ?>
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>

</head>

	<body <?php body_class(); ?> ">

		<div id="container">
<div class="navigation-bar">
	<div class="logo">
	<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="E4">
	</div>
	<div class="main-nav">
		<?php wp_nav_menu( array( 'theme_location' => 'Main Navigation', 'menu_class' => 'nav-menu', 'menu' => 'main menu', ) ); ?>
	</div>
</div>