<?php
/**
 * @author Creative Spark
 * CSI Wordpress Spine.
 *
 *         DO NOT EDIT
 *
 * You should not have to edit this file. Everything is in loader files.
 * Loader-Custom-Posts: Creates and Loads Custom Post Types and Custom Fields
 * Loader-Filters: Create Filters for Output
 * Loader-Menus: Creates and Loads Theme Menus
 * Loader-Scripts: Loads CSS & JS required for Theme
 * Loader-Sidebars: Creates and Loads Sidebars for Theme
 * Loader-Taxonomies: Creates and Loads Taxonmies for Theme
 */

define('SKELETON_VER', '1.2');

/**
 * SPL auto loader for CSI Theme
 * namespace eg CSI\Widgets\WidgetName
 *
 * @param $className
 */
function CSIAutoLoader($className)
{
  $className = ltrim($className, '\\');
  $fileName = '';
  if($lastNsPos = strrpos($className, '\\')) {
    $namespace = dirname(__FILE__) . '/' . substr($className, 0, $lastNsPos);
    $className = substr($className, $lastNsPos + 1);
    $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
  }
  $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
  if(file_exists($fileName)) {
    require_once $fileName;
  }
}

spl_autoload_register('CSIAutoLoader');

// Global Includes Loaders


// Client Specific Loaders
require_once('loader-sidebars.php'); // Custom Post Types
require_once('loader-scripts.php'); // Scripts for Frontend (CSS & JS)
require_once('loader-menus.php'); // Menus required for theme
require_once('loader-filters.php'); // Filters Loader (Title Styling ETC)
require_once('loader-custom-posts.php'); // Custom Post Types

require_once('loader-security.php'); // Custom Post Types
//require_once('caching.php'); // Custom Post Types

//$x = new plugins\everlyticgravityforms\everlyticgravityforms();

/**
 * Loads all widget files and registers them. To add widgets copy the example widgets
 */
function csi_load_widget()
{
  $namespace = 'CSI\Widgets\\';
  foreach(glob(get_template_directory() . '/CSI/Widgets/*.php') as $widget) {
    $widgetClass = $namespace . basename($widget, '.php');
    register_widget($widgetClass);
  }
}

add_action('widgets_init', 'csi_load_widget');

add_theme_support('post-thumbnails'); // This feature enables post-thumbnail support for a theme