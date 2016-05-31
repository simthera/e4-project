<?php
namespace CSI\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class PostTypeSelectBoxes implements Field{
    /**
     * Please pass in $opt postType = The post type you would like to list here
     * @param $post
     * @param $field
     * @return string
     */
    public static function display($post, $field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $html = '';
        $html .= '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';

        $args = array(
            'posts_per_page' => -1,
            'orderby'          => 'post_title',
            'order'            => 'DESC',
            'post_type'        => $field['postType'],
            'post_status'      => 'publish',
            'suppress_filters' => true );
        $holder = get_posts($args);

        $html .=  '<select name="'.$field['id'].'">';
        if($holder) {
            foreach($holder as $individual) {
                $html .= '<option value="' . $individual->ID . '" ' . ($meta == $individual->ID ? "selected='selected'" : "") . '/>' . $individual->post_title . '</option>';
            }
        }
        $html .=  '</select>';

        $html .= '</td></tr>';
        return $html;
    }

    public static function displayColumn($post, $field)
    {
        $meta_values = get_post_meta( $post->ID, $field['id'], true );
        if($meta_values) {
            if(isset($meta_values) && is_array($meta_values)) {
                $last = end(array_keys($meta_values));
                foreach ($meta_values as $key => $value) {
                    $holder = get_post($key);
                    echo $holder->post_title;
                    if ($last != $key) {
                        echo ' | ';
                    }
                }
            }
        }
    }

    static function loadScripts()
    {
        // TODO: Implement loadScripts() method.
    }


}