<?php
namespace CSI\Fields;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

interface Field {

    public static function display($post,$field);

    public static function displayColumn($post,$field);

    static function loadScripts();
} 