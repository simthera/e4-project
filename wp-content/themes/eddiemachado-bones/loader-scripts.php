<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function csi_scripts() {

	/* EXAMPLE OF JS REGISTER
	wp_register_script('csi-default-js', get_template_directory_uri() . '/js/default.js', array('jquery'));
	wp_enqueue_script( 'csi-default-js' );
	*/

	/* EXAMPLE of CSS REGISTER
	wp_register_style( 'csi-style-css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'csi-style-css' );
	*/

	wp_register_style( 'csi-fancybox-css', get_template_directory_uri() . '/CSI/Assets/Apps/Fancybox/jquery.fancybox.css' );
	wp_enqueue_style( 'csi-fancybox-css' );

	wp_register_script('csi-fancybox-js', get_template_directory_uri() . '/CSI/Assets/Apps/Fancybox/jquery.fancybox.pack.js', array('jquery'));
	wp_enqueue_script( 'csi-fancybox-js' );

	wp_register_script('csi-default-js', get_template_directory_uri() . '/js/general.js', array('jquery'));
	wp_enqueue_script( 'csi-default-js' );

	wp_register_style( 'csi-style-css', get_template_directory_uri() . '/style/style.css' );
	wp_enqueue_style( 'csi-style-css' );

	wp_register_style( 'csi-project-css', get_template_directory_uri() . '/style/project.css' );
	wp_enqueue_style( 'csi-project-css' );
}
add_action( 'wp_enqueue_scripts', 'csi_scripts' );