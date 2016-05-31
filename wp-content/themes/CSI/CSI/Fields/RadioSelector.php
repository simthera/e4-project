<?php
namespace CSI\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*
 *
 * This field type needs work. Would be great to be able to pass through args to allow any
 */

class RadioSelector implements Field{
    public static function display($post, $field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $html = '';
        $html .=  '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';

        $html .= '<input type="radio" name="' . $field['id'] . '" id="' . $field['id'] . '" '.($meta == 1 ? "checked='checked'" : "").'value="1" size="30" /><span class="description">Yes</span><br/>';
        $html .= '<input type="radio" name="' . $field['id'] . '" id="' . $field['id'] . '" '.($meta == 0 ? "checked='checked'" : "").'value="0" size="30" /><span class="description">No</span><br />';
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