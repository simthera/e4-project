<?php
    /**
     * Created by PhpStorm.
     * User: stephengleave
     * Date: 15/10/13
     * Time: 13:21
     */
    
    namespace plugins\everlyticgravityforms;

    if (class_exists("GFForms")) {
        class everlyticgravityforms extends GFAddOn
        {
            protected $_version = "1";

            protected $_min_gravityforms_version = "1.8.7";

            protected $_slug = "csieverlytic";

            protected $_path = "everlyticgravityforms/everlyticgravityforms.php";

            protected $_full_path = __FILE__;

            protected $_title = "CSI Gravity Forms -> Everlytic Integration";

            protected $_short_title = "CSI Everylytic";
        }
    }