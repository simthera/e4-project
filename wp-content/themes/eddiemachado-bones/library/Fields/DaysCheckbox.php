<?php
namespace library\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class DaysCheckbox implements Field{
    public static function display($post, $field)
    {
        $meta = get_post_meta($post->ID, $field['id'], true);
        $html = '';
        $html .= '<tr><th><label for="' . $field['id'] . '">' . $field['label'] . '</label></th><td>';
        $html .= '<ul>';
        $html .= '<li><input type="checkbox" name="'.$field['id'].'[mon]" '.(array_key_exists('mon',(array)$meta) ? "checked='checked'" : "").'"/>Monday</li>';
        $html .= '<li><input type="checkbox" name="'.$field['id'].'[tue]" '.(array_key_exists('tue',(array)$meta) ? "checked='checked'" : "").'"/>Tuesday</li>';
        $html .= '<li><input type="checkbox" name="'.$field['id'].'[wed]" '.(array_key_exists('wed',(array)$meta) ? "checked='checked'" : "").'"/>Wednesday</li>';
        $html .= '<li><input type="checkbox" name="'.$field['id'].'[thu]" '.(array_key_exists('thu',(array)$meta) ? "checked='checked'" : "").'"/>Thursday</li>';
        $html .= '<li><input type="checkbox" name="'.$field['id'].'[fri]" '.(array_key_exists('fri',(array)$meta) ? "checked='checked'" : "").'"/>Friday</li>';
        $html .= '<li><input type="checkbox" name="'.$field['id'].'[sat]" '.(array_key_exists('sat',(array)$meta) ? "checked='checked'" : "").'"/>Saturday</li>';
        $html .= '<li><input type="checkbox" name="'.$field['id'].'[sun]" '.(array_key_exists('sun',(array)$meta) ? "checked='checked'" : "").'"/>Sunday</li>';
        $html .= '</ul>';
        $html .= '</td></tr>';
        return $html;
    }

    public static function displayColumn($post, $field)
    {
        $meta_values = get_post_meta($post->ID, $field['id'], true);

        if(isset($meta_values) && is_array($meta_values)) {
            $last = end(array_keys($meta_values));

            $weekdays = array('mon', 'tue', 'wed', 'thu', 'fri');
            $weekends = array('sat', 'sun');
            if(count($meta_values) == 7){
                echo 'Every Day';
            }elseif (count(array_intersect_key(array_flip($weekdays), $meta_values)) === count($weekdays) && count($weekdays) == count($meta_values)) {
                echo 'Weekdays';
            }elseif(count(array_intersect_key(array_flip($weekends), $meta_values)) === count($weekends) && count($weekends) == count($meta_values)){
                echo 'Weekends';
            } else {
                foreach ($meta_values as $key => $value) {
                    switch ($key) {
                        case 'mon' :
                            echo 'Monday';
                            break;
                        case 'tue' :
                            echo 'Tuesday';
                            break;
                        case 'wed' :
                            echo 'Wednesday';
                            break;
                        case 'thu' :
                            echo 'Thursday';
                            break;
                        case 'fri' :
                            echo 'Friday';
                            break;
                        case 'sat' :
                            echo 'Saturday';
                            break;
                        case 'sun' :
                            echo 'Sunday';
                            break;
                    }
                    if ($key != $last) {
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