<?php
namespace CSI\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;


class DateSelector implements Field {

    public static function display($post, $field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $html = '';
        $html .=  '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';
        $html .= '<input type="date" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" size="30" /><br /><span class="description">' . $field['desc'] . '</span>';
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