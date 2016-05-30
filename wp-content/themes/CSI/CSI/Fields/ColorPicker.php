<?php
namespace CSI\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class ColorPicker implements Field{

    public function __construct(){

    }

    public static function display($post,$field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $html = '';
        $html .=  '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';
        $html .= '<input class="color-field" type="text" style="border-color:'.$meta.';" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" /><br /><span class="description">' . $field['desc'] . '</span>';
        $html .= '</td></tr>';
        return $html;
    }

    public static function displayColumn($post, $field)
    {
        $meta_values = get_post_meta( $post->ID, $field['id'], true );
        echo $meta_values;
    }

    static function loadScripts()
    {
        if(is_admin()) {
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker');
            wp_enqueue_script( 'wp-color-picker-script-handle', get_template_directory_uri() . '/CSI/Assets/Js/custom-posts-color-picker.js', array( 'wp-color-picker' ), false, true );
        }
    }

} 