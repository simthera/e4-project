<?php
    namespace CSI\Sortable;
    
    
    class Sortable
    {
        public function __construct()
        {

            global $current_screen;

            wp_enqueue_script('jquery-ui-sortable');
            wp_register_script('custom-sortable_posts', get_template_directory_uri() . '/CSI/Sortable/Sortable.js', array( 'jquery' ), false, true);
            wp_enqueue_script('custom-sortable_posts');
            global $wp_filter;
            if(!$wp_filter['wp_ajax_csipostsortable']) {
                add_action('wp_ajax_csipostsortable', array( $this, 'actionSave' ));
            }

            add_filter('pre_get_posts', array( $this, 'setAdminOrder' ));


        }

        public function actionSave()
        {

            $count = count($_POST['data']);
            foreach($_POST['data'] as $key => $val) {
                $post = str_replace('post-', '', $val);
                $my_post = array(
                    'ID'         => $post,
                    'menu_order' => $count
                );
                // Update the post into the database
                wp_update_post($my_post);
                $count--;
            }


            return true;
        }

        function setAdminOrder($wp_query)
        {

            if(is_admin()) {
                if(isset($wp_query->query['post_type']) && !isset($_GET['orderby'])) {
                    $wp_query->set('orderby', 'menu_order');
                    $wp_query->set('order', 'DESC');
                }
            }
        }
    }