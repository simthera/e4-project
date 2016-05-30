<?php
namespace CSI\SPAdmin;


class SPDashboard {
    protected static $spdashboard = null;

    public function __construct(){
        add_action( 'wp_dashboard_setup', array($this,'csi_dashboard_widget') );
        add_action( 'admin_init', array($this,'remove_dashboard_meta' ));
    }

    static function spdashboard(){
        if(self::$spdashboard === null){
            self::$spdashboard = new SPDashboard();
        }
        return self::$spdashboard;
    }

    public function csi_dashboard_widget() {
        wp_add_dashboard_widget(
            'csi_dashboard_contact',         // Widget slug.
            'Contact Creative Spark',         // Title.
            array($this,'csi_dashboard_contact') // Display function.
        );
        wp_add_dashboard_widget(
            'csi_dashboard_contact_details',         // Widget slug.
            'Creative Spark Contact Details',         // Title.
            array($this,'csi_dashboard_contact_details') // Display function.
        );
    }

    public function csi_dashboard_contact() {
        include('Templates/Dashboard/dashboard-contact-form.php');
    }

    public function csi_dashboard_contact_details() {
        include('Templates/Dashboard/dashboard-contact-details.php');
    }


    public function remove_dashboard_meta() {
        remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
        remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' );
        //remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' );
        remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
        //remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//since 3.8
    }

}