<?php
namespace CSI\SPAdmin;

class SPAdmin {
    protected static $spadmin = null;

    public function __construct(){
        add_action( 'admin_menu', array($this,'csi_admin_menu') );
        add_action( 'admin_bar_menu', array($this,'csi_help_menu'),25);
        add_filter('mod_rewrite_rules', array($this,'csi_htaccess'));
        if(!file_exists(ABSPATH.'/wp-admin/.htaccess')){
            add_action( 'admin_notices', array($this,'csi_admin_notices') );
        }
    }

    static function spadmin(){
        if(self::$spadmin === null){
            self::$spadmin = new SPAdmin();
        }
        return self::$spadmin;
    }

    public function csi_admin_menu() {
        add_menu_page('SparkPlug Info', 'SparkPlug', 'manage_options', 'csi-sparkplug', array($this,'csi_sp_info'),'dashicons-carrot');
        add_submenu_page( 'csi-sparkplug', 'SparkPlug Security', 'Security', 'manage_options', 'csi-sparkplug-security', array($this,'csi_sp_security'));
        add_submenu_page( 'csi-sparkplug', 'SparkPlug Git', 'Git Status and Pull', 'manage_options', 'csi-sparkplug-gitoptions', array($this,'csi_gitoptions'));
        add_submenu_page( 'csi-sparkplug', 'SparkPlug DB Migrator', 'Database Migration', 'manage_options', 'csi-sparkplug-dbmigration', array($this,'csi_database_sync'));
        add_submenu_page( 'csi-sparkplug', 'Site Options', 'Site Options', 'manage_options', 'csi-sparkplug-siteoptions', array($this,'csi_site_options'));

        add_action('Spark Plug Menu','csi_admin_menu');
    }


    public function csi_sp_info() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        include ('Templates/sp_info.php');
    }


    public function csi_site_options() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        include('Templates/sp_site_options.php');
    }

    public function csi_sp_security() {
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        $current = get_option( 'csi_htlocation');
        if(isset($_POST['htoptions'])){
            if($current){
                update_option( 'csi_htlocation', $_POST['htoptions']['path'] );
                $current = get_option( 'csi_htlocation');
            }else{
                add_option( 'csi_htlocation', $_POST['htoptions']['path'], '' , $autoload = 'no' );
                $current = get_option( 'csi_htlocation');
            }
        }
        include('Templates/sp_admin_security.php');
    }

    public function csi_help_menu() {
        global $wp_admin_bar;
        if ( !is_super_admin() || !is_admin_bar_showing() )
            return;
        $wp_admin_bar->add_menu( array(
            'id' => 'csi_sp_help',
            'title' => __( 'Spark Plug'),
            'href' => __('http://www.creativespark.co.za'),
        ));
        $wp_admin_bar->add_menu( array(
            'parent' => 'csi_sp_help',
            'id'     => 'csi_sp_general',
            'title' => __( 'General CMS Help'),
            'href' => __('http://www.creativespark.co.za'),
        ));

        $wp_admin_bar->add_menu( array(
            'parent' => 'csi_sp_help',
            'id'     => 'csi_sp_site',
            'title' => __( 'Creative Spark Website'),
            'href' => __('http://www.creativespark.co.za'),
        ));
    }

    public function csi_gitoptions(){
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        $status = explode('.',shell_exec("git status 2>&1"));
        echo '<p>'.$status[0].'</p>';

    }

    public function csi_database_sync(){
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        echo 'Tool to pull database to this installation';
    }


    public function csi_admin_notices() {
        echo '<div class="error">';
        echo '<h3>SparkPlug Security</h3>';
        echo '<p>This installation has not been secured. Please <a href="admin.php?page=csi-sparkplug-security">click here</a> to find out how to secure this installation</p>';
        echo '</div>';
    }

    public function csi_htaccess( $rules )
    {
        $path = get_template_directory();
        $my_content = <<<EOT
\n# CSI Security
# Protect wpconfig.php
<Files wp-config.php>
    Order Allow,Deny
    Deny from all
</Files>\n

# Block the include-only files.
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^wp-admin/includes/ - [F,L]
RewriteRule !^wp-includes/ - [S=3]
RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]
RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]
RewriteRule ^wp-includes/theme-compat/ - [F,L]
</IfModule>
# CSI Security\n
EOT;
        return $rules. $my_content;
    }



}