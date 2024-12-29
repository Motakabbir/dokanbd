<?php
add_action('init', 'elessi_breadcrumb_heading');
if (!function_exists('elessi_breadcrumb_heading')) {
    function elessi_breadcrumb_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Breadcrumb", 'elessi-theme'),
            "target" => 'breadcumb',
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("General Options", 'elessi-theme'),
            "std" => "<h4>" . __("General Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );

        $of_options[] = array(
            "name" => __("Global Site", 'elessi-theme'),
            "id" => "breadcrumb_show",
            "std" => 1,
            "type" => "switch",
            'class' => 'nasa-breadcrumb-flag-option',
            'desc' => 'Note: Pages built in Dashboard > Pages - built with page builders (WPBakery, Elementor) will not be managed by this option, they will be turned on and off at Advance options of that page.'
        );

        $of_options[] = array(
            "name" => __("Layout", 'elessi-theme'),
            "desc" => __("Layout Single or Double rows.", 'elessi-theme'),
            "id" => "breadcrumb_row",
            "std" => "multi",
            "type" => "select",
            "options" => array(
                "multi" => __("Double Rows", 'elessi-theme'),
                "single" => __("Single Row", 'elessi-theme')
            ),
        );
        
        $of_options[] = array(
            "name" => __("Type", 'elessi-theme'),
            "desc" => __("With or Without Background.", 'elessi-theme'),
            "id" => "breadcrumb_type",
            "std" => "has-background",
            "type" => "select",
            "options" => array(
                "default" => __("Without Background - Default use Background Color", 'elessi-theme'),
                "has-background" => __("With Background", 'elessi-theme')
            ),
        );

        $of_options[] = array(
            "name" => __("Background Image", 'elessi-theme'),
            "id" => "breadcrumb_bg",
            "std" => ELESSI_ADMIN_DIR_URI . 'assets/images/breadcrumb-bg.jpg',
            "type" => "media"
        );
        
        $of_options[] = array(
            "name" => __("Background Image - Mobile Layout Mode", 'elessi-theme'),
            "id" => "breadcrumb_bg_m",
            "std" => '',
            "type" => "media"
        );
        
        $of_options[] = array(
            "name" => __("Background Parallax", 'elessi-theme'),
            "id" => "breadcrumb_bg_lax",
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Background Color", 'elessi-theme'),
            "id" => "breadcrumb_bg_color",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Text Color", 'elessi-theme'),
            "id" => "breadcrumb_color",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Text Align", 'elessi-theme'),
            "id" => "breadcrumb_align",
            "std" => "text-center",
            "type" => "select",
            "options" => array(
                "text-center" => __("Center", 'elessi-theme'),
                "text-left" => __("Left", 'elessi-theme'),
                "text-right" => __("Right", 'elessi-theme')
            ),
        );

        $of_options[] = array(
            "name" => __("Height", 'elessi-theme'),
            "desc" => __("Default - 130px", 'elessi-theme'),
            "id" => "breadcrumb_height",
            "std" => "130",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Height For Mobile", 'elessi-theme'),
            "id" => "breadcrumb_height_m",
            "std" => "",
            "type" => "text"
        );
        
        $of_options = apply_filters('nasa_theme_opts_breadcrumb', $of_options);
    }
}
