<?php
namespace CSI\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class TextArea implements Field{
    public static function display($post, $field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $html = '';
        $html .= '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';
        $html .= '<textarea name="' . $field['id'] . '" id="' . $field['id'] . '" rows=5 cols=80>'.$meta.'</textarea><br /><span class="description">' . $field['desc'] . '</span>';
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
        // TODO: Implement loadScripts() method.
    }


} 