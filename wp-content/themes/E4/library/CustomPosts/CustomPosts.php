<?php
    namespace library\CustomPosts;
    use library\CustomFields\CustomFields;
    use library\CustomFields\CustomTaxFields;
    // Exit if accessed directly
    if ( !defined( 'ABSPATH' ) ) exit;

    /**
     * Class CustomPosts
     *
     * Bit of a black box for now. In experimental stages so please be forgiving.
     *
     * @package CSI\CustomPosts
     */
    class CustomPosts extends CustomFields{

        private $postTypeID,$multipleName,$singularName,$addNewLabel,$description,$supports,$taxonomies,$icon,$url;
        private $taxFields = array();

        public function __construct($postTypeName,$taxonomies = false, $supports = array('title','editor'), $extra = array('description'=>'A new post type','icon'=>'dashicons-menu')){

            $this->postTypeID = strtolower(substr($postTypeName, 0, 20));
            $this->url = strtolower(str_replace(" ","-",$postTypeName));
            $this->multipleName = $postTypeName;
            $this->singularName = $postTypeName;
            $this->addNewLabel = 'Add New '.$postTypeName;
            $this->supports = $supports;
            $this->taxonomies = $taxonomies;
            $this->icon = $extra['icon'];
            $this->description = $extra['description'];

            if($taxonomies){
                add_action('init',array($this,'csiRegisterTaxonomy'));
                add_filter('post_type_link', array($this,'csiTermPermalink'), 10, 4);
                add_rewrite_rule('^'.$this->url.'/?$','index.php?post_type='.$this->postTypeID,'top');
                add_rewrite_rule('^'.$this->url.'/([^/]*)?$','index.php?'.$this->postTypeID.'category_term=$matches[1]','top');
                add_rewrite_rule('^'.$this->url.'/([^/]*)/([^/]*)?$','index.php?'.$this->postTypeID.'post_term=$matches[2]','top');
            }
            add_action('init', array($this, 'csiRegisterPostType'));
            parent::__construct($this->postTypeID);
        }

        public function csiTermPermalink($post_link, $post, $leavename, $sample){
            if ( false !== strpos( $post_link, '/%'.$this->postTypeID.'_letter%' ) ) {
                $taxonomyTerms = get_the_terms( $post->ID, $this->postTypeID.'_categories' );
                if(is_array($taxonomyTerms) && isset($taxonomyTerms[0])) {
                    $term = $taxonomyTerms[0];
                    $x = $this->getParentTerm($term);
                    $post_link = str_replace('%'.$this->postTypeID.'_letter%', $x, $post_link);
                }else{
                    $post_link = str_replace('%'.$this->postTypeID.'_letter%', $post_link, $post_link);
                }
            }
            return $post_link;
        }

        function getParentTerm($child){
            $url = $child->slug;
            if($child->parent != 0){
                $parent = get_term($child->parent,$this->postTypeID.'_categories');
                $url = $this->getParentTerm($parent).'/'.$url;
            }
            return $url;

        }

        public function csiRegisterTaxonomy(){
            register_taxonomy
            (
                $this->postTypeID.'_categories',
                array(),
                array
                (
                    'hierarchical' => true,
                    'labels' => array
                    (
                        'name' => _x($this->singularName.' Categories', 'taxonomy general name'),
                        'singular_name' => _x($this->singularName.' Category', 'taxonomy singular name')
                    ),
                    'show_ui' => true,
                    'query_var' => $this->postTypeID.'category_term',
                    'rewrite' => array(
                        'slug' => $this->url,
                    ),
                )
            );
        }

        public function csiRegisterPostType(){
            if($this->taxonomies) {
                register_post_type
                (
                    $this->postTypeID,
                    array
                    (
                        'menu_icon' => $this->icon,
                        'labels' => array
                        (
                            'name' => _x($this->multipleName, 'post type general name'),
                            'singular_name' => _x($this->singularName, 'post type singular name')
                        ),
                        'supports' => $this->supports,
                        'public' => true,
                        'rewrite' => array
                        (
                            'slug' => $this->url . '/%' . $this->postTypeID . '_letter%',
                            'with_front' => false

                        ),
                        'query_var' => $this->postTypeID . 'post_term',
                        'has_archive' => true,
                        'taxonomies' => array($this->postTypeID . '_categories'),
                        'show_in_nav_menus' => false
                    )
                );
            }else{
                register_post_type
                (
                    $this->postTypeID,
                    array
                    (
                        'menu_icon' => $this->icon,
                        'labels' => array
                        (
                            'name' => _x($this->multipleName, 'post type general name'),
                            'singular_name' => _x($this->singularName, 'post type singular name')
                        ),
                        'supports' => $this->supports,
                        'public' => true,
                        'query_var' => $this->postTypeID . 'post_term',
                        'has_archive' => true,
                        'taxonomies' => array($this->postTypeID . '_categories'),
                        'show_in_nav_menus' => false
                    )
                );
            }

        }

    }