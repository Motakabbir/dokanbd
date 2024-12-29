<?php
add_action('init', 'elessi_dokan_settings_heading');
if (!function_exists('elessi_dokan_settings_heading')) {
    function elessi_dokan_settings_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Dokan", 'elessi-theme'),
            "target" => 'dokan-settings',
            "type" => "heading",
        );
        
        $of_options[] = array(
            "name" => __("Store Header Template", 'elessi-theme'),
            "id" => "dokan_header",
            "std" => "",
            "type" => "images",
            "options" => array(
                'ns-1' => ELESSI_ADMIN_DIR_URI . 'assets/images/dokan-header-1.jpg',
                'ns-2' => ELESSI_ADMIN_DIR_URI . 'assets/images/dokan-header-2.jpg',
                'ns-3' => ELESSI_ADMIN_DIR_URI . 'assets/images/dokan-header-3.jpg',
                'ns-4' => ELESSI_ADMIN_DIR_URI . 'assets/images/dokan-header-4.jpg',
                '' => ELESSI_ADMIN_DIR_URI . 'assets/images/dokan-default.gif',
            )
        );
        
        $of_options[] = array(
            "name" => __("Store Sidebar Position", 'elessi-theme'),
            "id" => "store_layout",
            "std" => "left",
            "type" => "select",
            "options" => array(
                "left" => __("Left Sidebar", 'elessi-theme'),
                "right" => __("Right Sidebar", 'elessi-theme'),
                "no" => __("No Sidebar", 'elessi-theme')
            )
        );
    }
}
