<?php
namespace library\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class MediaSelector implements Field{
    public static function display($post, $field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $html = '';
        $html .= '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';
        if($meta){
            $attachment = wp_get_attachment_image( $meta, array(300,100));
            $html .= $attachment;
        }

        $html .= '<hr/>';
        $html .= '<input type="hidden" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" />';
        $html .= '<input type="button" id="meta-image-button" data-uploader_title="Add Media" data-uploader_button_text="Select File"  data-field_id="'.$field['id'].'" class="button upload_image_button" value="Add/Change Image" />';
        $html .= '</td>';
        $html .= '</tr>';

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
            wp_enqueue_media();
            wp_register_script('custom-posts-media', get_template_directory_uri() . '/library/Assets/Js/custom-posts-media-single.js', array('jquery'));
            wp_enqueue_script('custom-posts-media');
        }
    }


} 