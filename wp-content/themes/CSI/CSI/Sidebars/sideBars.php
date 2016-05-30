<?php
namespace CSI\Sidebars;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Class sideBars
 * @package CSI\Sidebars
 */
class sideBars {
    private $sidebars =array();

    function __construct(){
        add_action( 'widgets_init', array($this,'initSidebar'));
    }

    function initSidebar(){
        foreach($this->sidebars as $sidebar){
            register_sidebar($sidebar);
        }
    }


    /**
     * @param Array $sidebar
     * @throws \Exception
     */
    function addSideBar($sidebar){
        if(!$sidebar['name'] || !$sidebar['id']){
            throw new \Exception('No Sidebar name or ID provided');
        }
        $this->sidebars[] = $sidebar;
    }
} 