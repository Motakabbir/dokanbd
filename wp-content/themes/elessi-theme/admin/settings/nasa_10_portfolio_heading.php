<?php
add_action('init', 'elessi_portfolio_heading');
if (!function_exists('elessi_portfolio_heading')) {
    function elessi_portfolio_heading() {
        
        if (!defined('NASA_CORE_ACTIVED') || !NASA_CORE_ACTIVED) {
            return;
        }
        
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Portfolio", 'elessi-theme'),
            "target" => 'portfolio',
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("Enable Portfolio", 'elessi-theme'),
            "id" => "enable_portfolio",
            "std" => 1,
            "type" => "switch"
        );
        
        /* $of_options[] = array(
            "name" => __("Page view Portfolio", 'elessi-theme'),
            "id" => "nasa-page-view-portfolio",
            "type" => "select",
            "options" => elessi_get_pages_temp_portfolio()
        ); */
        
        $of_options[] = array(
            "name" => __("Recent Projects", 'elessi-theme'),
            "id" => "recent_projects",
            "std" => 1,
            "type" => "switch",
            'child_of' => 'enable_portfolio',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Portfolio Comments", 'elessi-theme'),
            "id" => "portfolio_comments",
            "std" => 1,
            "type" => "switch",
            'child_of' => 'enable_portfolio',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Portfolio Count", 'elessi-theme'),
            "id" => "portfolio_count",
            "std" => 10,
            "type" => "text",
            'child_of' => 'enable_portfolio',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Project Category", 'elessi-theme'),
            "id" => "project_byline",
            "std" => 1,
            "type" => "switch",
            'child_of' => 'enable_portfolio',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Project Name", 'elessi-theme'),
            "id" => "project_name",
            "std" => 1,
            "type" => "switch",
            'child_of' => 'enable_portfolio',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Portfolio Columns", 'elessi-theme'),
            "id" => "portfolio_columns",
            "std" => "5-cols",
            "type" => "select",
            "options" => array(
                "5-cols" => __("5 columns", 'elessi-theme'),
                "4-cols" => __("4 columns", 'elessi-theme'),
                "3-cols" => __("3 columns", 'elessi-theme'),
                "2-cols" => __("2 columns", 'elessi-theme')
            ),
            'child_of' => 'enable_portfolio',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Portfolio Lightbox", 'elessi-theme'),
            "id" => "portfolio_lightbox",
            "std" => 1,
            "type" => "switch",
            'child_of' => 'enable_portfolio',
            'm_target' => '1',
        );
    }
}
