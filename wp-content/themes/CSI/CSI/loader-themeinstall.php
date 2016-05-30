<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


add_action('after_switch_theme', 'csi_theme_setup');
function csi_theme_setup()
{
	$postTypes = get_post_types(array('_builtin' => false));
	foreach ($postTypes as $key => $val) {
		$newFile = get_template_directory() . '/single-' . $key . '.php';
		if (!file_exists($newFile))
			copy(__DIR__.'/Templates/single.php',$newFile);

		$newFile = get_template_directory() . '/archive-' . $key . '.php';
		if (!file_exists($newFile))
			copy(__DIR__.'/Templates/archive.php',$newFile);
		flush_rewrite_rules();
	}
	$taxonomies = get_taxonomies(array('_builtin' => false));
	if ($taxonomies) {
		foreach ($taxonomies as $key=>$val) {
			$taxObject = get_taxonomy($val);
			$postTypeArray = $taxObject->object_type;
			$taxFile = get_template_directory()."/taxonomy-".$val.".php";
			if (!file_exists($taxFile)) {
				$newFile = fopen($taxFile, "w") or die("Unable to open file!");
				if ($newFile) {
					$txt = "<?php get_template_part('archive-" . $postTypeArray[0] . "'); ?>";
					fwrite($newFile, $txt);
					fclose($newFile);
				}
			}
		}
	}

    global $wpdb;
    $table_name = $wpdb->prefix . 'taxonomy_meta';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		tax_term_id mediumint(9) NOT NULL,
		tax_term_field text NOT NULL,
		tax_term_value text NOT NULL,
		UNIQUE KEY id (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option( 'sparkplug version', SKELETON_VER );




    add_action( 'admin_notices', 'csi_succesful_setup' );
}
function csi_succesful_setup(){ ?>
    <div class="updated">
        <h3>SparkPlug Installed</h3>
        <p>SparkPlug has activated succesfully</p>
    </div>
<?php }


