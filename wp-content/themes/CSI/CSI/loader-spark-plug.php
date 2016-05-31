<?php
// LOAD CUSTOM CSS FOR WORDPRESS

//function csi_admin_scripts() {
//    wp_enqueue_style('csi-admin-theme', get_template_directory_uri().'/CSI/Assets/Css/admin.css');
//}
//function csi_admin_login_scripts() {
//    wp_enqueue_style('csi-admin-theme', get_template_directory_uri().'/CSI/Assets/Css/admin.css');
//    wp_enqueue_style('csi-login-theme', get_template_directory_uri().'/CSI/Assets/Css/login.css');
//}
//
//add_action('admin_enqueue_scripts', 'csi_admin_scripts');
//add_action('login_enqueue_scripts', 'csi_admin_login_scripts');
//
//// CHANGE LOGO URL FOR LOGIN SCREEN
//function loginpage_custom_link() {
//    return 'http://www.creativespark.co.za';
//}
//add_filter('login_headerurl','loginpage_custom_link');
//
//function change_title_on_logo() {
//    return 'Click here to find out more about Creative Spark';
//}
//add_filter('login_headertitle', 'change_title_on_logo');

//if(is_admin()) {
//    \CSI\SPAdmin\SPAdmin::spadmin();
//    \CSI\SPAdmin\SPDashboard::spdashboard();
//}