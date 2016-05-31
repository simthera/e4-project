<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Registering the Nav Menus.
 * Examples below
 */
register_nav_menus(array(
    'primary-menu' => __('Main Navigation'),
    'top-menu' => __('Top Navigation'),
));