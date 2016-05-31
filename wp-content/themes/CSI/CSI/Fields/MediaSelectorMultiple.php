<?php
    namespace CSI\Fields;

    // Exit if accessed directly
    if ( !defined( 'ABSPATH' ) ) exit;

    class MediaSelectorMultiple implements Field{
        public static function display($post, $field)
        {
            $meta = get_post_meta($post->ID, $field['id'], true);
            $images = explode(',',$meta);
            $html = '';
            $html .= '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';
            $html .= '<div id="images_'.$field['id'].'">';
            if($images){

                foreach($images as $key=>$val){
                    $html .= wp_get_attachment_image( $val, array(300,100));
                }

            }
            $html .= '</div>';
            $html .= '<hr/>';
            $html .= '<input type="hidden" name="' . $field['id'] . '" id="' . $field['id'] . '" value="' . $meta . '" />';
            $html .= '<input type="button" id="meta-image-button" data-uploader_title="Add Media" data-uploader_button_text="Select File"  data-field_id="'.$field['id'].'" class="button upload_multiple_image_button" value="Add/Change Images" />';
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
                wp_register_script('custom-posts-media-multiple', get_template_directory_uri() . '/CSI/Assets/Js/custom-posts-media-multiple.js', array('jquery'));
                wp_enqueue_script('custom-posts-media-multiple');
            }
        }


    }