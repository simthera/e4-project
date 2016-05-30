<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 *
 * Copy and Pasted for reference later. Unknown as to what the seo needs are.
 */
function theme_name_wp_title( $title, $sep ) {
    if ( is_feed() ) {
        return $title;
    }
    global $page, $paged;

    // Add the blog name
    $title .= get_bloginfo( 'name', 'display' );
    // Add the blog description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }
    // Add a page number if necessary:
    if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
        $title .= " $sep " . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
    }
    return $title;
}
add_filter( 'wp_title', 'theme_name_wp_title', 10, 2 );


add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
function custom_image_sizes_choose( $sizes ) {
    $custom_sizes = array(
        'featured-image' => 'Featured Image'
    );
    return array_merge( $sizes, $custom_sizes );
}

// Filters for branding admin area
add_filter('admin_footer_text', 'left_admin_footer_text_output'); //left side
function left_admin_footer_text_output($text) {
    $text = '&copy; '.date('Y').' - '.get_bloginfo( 'name', 'display' );
    return $text;
}

add_filter('update_footer', 'right_admin_footer_text_output', 11); //right side
function right_admin_footer_text_output($text) {
    $text = 'Theme by <a href="http://www.creativespark.co.za">Creative Spark</a>';
    return $text;
}