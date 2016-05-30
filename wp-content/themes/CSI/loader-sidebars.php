<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$sideBars = new \CSI\Sidebars\sideBars();

$sideBars->addSideBar(array(
    'name' => 'CSI Widgets',
    'id' => 'csi_sidebar_widgets',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h2 class="rounded">',
    'after_title' => '</h2>',
));