<?php
    // Exit if accessed directly
    if(!defined('ABSPATH')) {
        exit;
    }

    /**
     * This file is used to create and load the custom post types. If you add a custom post type.
     * You will need to deactivate and re activate the theme. This will create for you the 2-3 templates you need.
     *
     * If custom tax set to false. Creates single-taxname and archive-taxname.
     *
     * If custom tax set to true. Creates single/archive and taxonomy template. Tax template is not edited it just points to archive.
     *
     * ALL URL REWRITES ARE DONE FOR YOU ## NEEDS SOME WORK
     *
     */

    /*
     * HERE IS AN EXAMPLE OF A FULLY FILLED IN CUSTOM POST ADDITION PLEASE READ UP ON WHAT IS REQUIRED AND NOT.
     * You can find a list of custom fields in the CSI/Fields directory or write your own by extending field.php
     *
     * After adding a new post. PLEASE Deactivate and re activate the theme to generate the required templates.
     * Each field has 3 functions Read more in CSI/Fields/Field.php
     */
    $bannerTest = new library\CustomPosts\CustomPosts('Banner', false, array(
        'title',
        'thumbnail'
    ), array( 'description' => 'Banner Tester', 'icon' => 'dashicons-controls-play' ));
    $bannerTest->addField('Call to Action', 'Enter a url for the call to action', 'Text', 'Additional Config', array(), false);

    $linkedPost = new library\CustomPosts\CustomPosts('Linked', false, array(
        'title',
        'editor'
    ), array( 'description' => 'Example of all Custom Fields', 'icon' => 'dashicons-controls-play' ));

    $example = new library\CustomPosts\CustomPosts('Example', false, array(
        'title',
        'editor',
        'thumbnail',
        'excerpt'
    ), array( 'description' => 'Example of all Custom Fields', 'icon' => 'dashicons-controls-play' ));
$example2 = new library\CustomPosts\CustomPosts('Example 2', false, array(
    'title',
    'editor',
    'thumbnail',
    'excerpt'
), array( 'description' => 'Example of all Custom Fields', 'icon' => 'dashicons-controls-play' ));
    $example->addField('Color Picker', 'Description Text', 'ColorPicker', 'Grouping Name', array(), false);

    $example->addField('Date Selector', 'Description Text', 'DateSelector', 'Grouping Name', array(), false);

    $example->addField('Days Checkbox', 'Description Text', 'DaysCheckbox', 'Grouping Name', array(), false);

    $example->addField('Media Selector', 'Description Text', 'MediaSelector', 'Grouping Name', array(), false);

    $example->addField('Multiple Media Selector', 'Description Text', 'MediaSelectorMultiple', 'Grouping Name', array(), false);

    $example->addField('Post Type Checkboxes', 'Description Text', 'PostTypeCheckboxes', 'Grouping Name', array( 'postType' => 'linked' ), false);

    $example->addField('Post Type Select', 'Description Text', 'PostTypeSelectBoxes', 'Grouping Name', array( 'postType' => 'linked' ), false);

    $example->addField('Radio Button', 'Description Text', 'RadioSelector', 'Grouping Name', array(), false);

    $example->addField('Single Line', 'Description Text', 'Text', 'Grouping Name', array(), false);

    $example->addField('Text Area', 'Description Text', 'TextArea', 'Grouping Name', array(), false);

    $example->addField('Time Selector', 'Description Text', 'TimeSelector', 'Grouping Name', array(), false);

    $example->addField('Wysiwyg', 'Description Text', 'WYSIWYG', 'Grouping Name', array(), false);


    $example->addField('Color Picker', 'Description Text', 'ColorPicker', 'Another Group', array(), false);

    $example->addField('Date Selector', 'Description Text', 'DateSelector', 'Another Group', array(), false);

    $example->addField('Days Checkbox', 'Description Text', 'DaysCheckbox', 'Another Group', array(), false);

    $example->addField('Media Selector', 'Description Text', 'MediaSelector', 'Another Group', array(), false);

    $example->addField('Multiple Media Selector', 'Description Text', 'MediaSelectorMultiple', 'Another Group', array(), false);

    $example->addField('Post Type Checkboxes', 'Description Text', 'PostTypeCheckboxes', 'Another Group', array( 'postType' => 'linked' ), false);

    $example->addField('Post Type Select', 'Description Text', 'PostTypeSelectBoxes', 'Another Group', array( 'postType' => 'linked' ), false);

    $example->addField('Radio Button', 'Description Text', 'RadioSelector', 'Another Group', array(), false);

    $example->addField('Single Line', 'Description Text', 'Text', 'Another Group', array(), false);

    $example->addField('Text Area', 'Description Text', 'TextArea', 'Another Group', array(), false);

    $example->addField('Time Selector', 'Description Text', 'TimeSelector', 'Another Group', array(), false);

    $example->addField('Wysiwyg', 'Description Text', 'WYSIWYG', 'Another Group', array(), false);


