<?php
    namespace library\CustomFields;
    if ( !defined( 'ABSPATH' ) ) exit;


    class CustomFields {
        const PREFIX = 'csi_';
        private $fields = array();
        private $taxFields = array();
        private $postTypeID;


        public function __construct($postTypeID){
            $this->postTypeID = strtolower(substr($postTypeID, 0, 20));
            $this->postTypeID = str_replace(" ","",$this->postTypeID);

            if(is_admin()) {
                add_action('add_meta_boxes', array( $this, 'csiAddMetaBox' ));
                add_action('save_post_'.$this->postTypeID, array( $this, 'csiSaveMeta' ));
                add_filter('manage_' . $this->postTypeID . '_posts_columns', array( $this, 'additional_columns' ));
                add_action('manage_' . $this->postTypeID . '_posts_custom_column', array( $this, 'custom_columns_data' ));
            }
        }

        /**
         * Adds custom fields to post type
         *
         * This function is used to create custom fields for the post type you have created.
         * To add new post types please implement CSI\Fields\Field
         *
         * @param String $label Label name for input
         * @param String $description Description of input
         * @param String $type Look in CSI\Fields For currently supported field types or implement CSI\Fields\Field to add your own.
         * @param Array $opt
         * @param bool $displayListing Can build the column view for the listing of this custom post type
         */
        public function addField($label,$description,$type = 'text',$group = 'Custom Fields', $opt = array(),$displayListing = false)
        {
            $fieldID = self::PREFIX .preg_replace('~[\W\s]~', '_', strtolower($group), -1). preg_replace('~[\W\s]~', '_', strtolower($label), -1);
            $fieldID = rtrim($fieldID,'_');
            $holder = array(
                'label' => $label,
                'desc' => $description,
                'id' => self::PREFIX .preg_replace('~[\W\s]~', '_', strtolower($group), -1). preg_replace('~[\W\s]~', '_', strtolower($label), -1),
                'type' => $type,
                'display' => $displayListing
            );
            if (!empty($opt)) {
                foreach ($opt as $key => $val) {
                    $holder[$key] = $val;
                }
            }
            $this->fields[$group][] = $holder;
        }

        public function csiAddMetaBox(){
            foreach($this->fields as $key=>$val){
                if(count($val)>0) {
                    $types = $this->postTypeID;
                    add_meta_box(
                        $this->postTypeID.$key, // $id
                        $key, // $title
                        array( $this, 'csiShowCustomMeta' ), // $callback
                        $types, // $page
                        'normal', // $context
                        'high',// Priority
                        $val);
                }
            }

        }

        public function csiShowCustomMeta($post,$fields) {
            global $post;
            // Use nonce for verification
            echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
            // Begin the field table and loop

            echo '<table class="form-table">';

            foreach($fields['args'] as $field){
                $class = 'library\Fields\\'.ucfirst($field['type']);
                echo $class::display($post,$field);
                $class::loadScripts();
            }
            echo '</table>'; // end table
        }

        public function csiSaveMeta() {
            global $post;
            if($_POST) {
                // verify nonce
                if(!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) {
                    return $post->ID;
                }


                // check autosave
                if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                    return $post->ID;
                }
                // check permissions
                if('page' == $_POST['post_type']) {
                    if(!current_user_can('edit_page', $post->ID)) {
                        return $post->ID;
                    }
                } elseif(!current_user_can('edit_post', $post->ID)) {
                    return $post->ID;
                }
                // loop through fields and save the data
                foreach($this->fields as $field) {
                    foreach($field as $key => $val) {
                        $old = get_post_meta($post->ID, $val['id'], true);
                        if(isset($_POST[$val['id']])) {
                            $new = $_POST[$val['id']];

                        }
                        if(isset($new) && $new != $old) {
                            update_post_meta($post->ID, $val['id'], $new);
                        } elseif((isset($new) && '' == $new) && $old) {
                            delete_post_meta($post->ID, $val['id'], $old);
                        }
                    }
                } // end foreach
            }
        }

        function additional_columns($columns) {
            $new_columns = null;
            foreach($this->fields as $field){
                foreach($field as $key=>$val) {
                    if ($val['display']) {
                        $new_columns[$val['id']] = $val['label'];
                    }
                }
            }
            if(is_array($new_columns)) {
                return array_merge($columns, $new_columns);
            }else{
                return $columns;
            }
        }

        function custom_columns_data($column) {
            foreach ($this->fields as $field) {
                foreach($field as $key=>$val) {
                    if ($val['id'] == $column) {
                        global $post;
                        $class = 'CSI\Fields\\' . ucfirst($val['type']);
                        echo $class::displayColumn($post, $val);
                    }
                }
            }

        }


        /*
         * CUSTOM FIELDS FOR TAXONOMIES
         */

        public function addTaxField($label,$description,$type = 'text',$opt = array()){
            $holder = array(
                'label' => $label,
                'desc' => $description,
                'id' => self::PREFIX . preg_replace('~[\W\s]~', '_', strtolower($label), -1),
                'type' => $type
            );
            if (!empty($opt)) {
                foreach ($opt as $key => $val) {
                    $holder[$key] = $val;
                }
            }
            $this->taxFields[] = $holder;
        }
    }