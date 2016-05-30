<?php
namespace library\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class WYSIWYG implements Field{

    public function __construct(){

    }

    public static function display($post,$field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        echo  '';
        echo '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th>';
        echo '<td>';
        wp_editor( $meta, $field['id'] );
        echo '</td>';
        echo '</tr>';
        return '';
    }

    public static function displayColumn($post, $field)
    {
        $meta_values = get_post_meta( $post->ID, $field['id'], true );
        echo $meta_values;
    }

    static function loadScripts()
    {
    }

} 