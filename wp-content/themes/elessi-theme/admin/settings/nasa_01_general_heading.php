<?php
add_action('init', 'elessi_general_heading');
if (!function_exists('elessi_general_heading')) {
    function elessi_general_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("General", 'elessi-theme'),
            "target" => 'general',
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("General options", 'elessi-theme'),
            "std" => "<h4>" . __("General options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Add more width site (px)", 'elessi-theme'),
            "desc" => __("The max-width of your site will be INPUT + 1200 (pixel).", 'elessi-theme'),
            "id" => "plus_wide_width",
            "std" => "",
            "type" => "text"
        );

        $of_options[] = array(
            "name" => __("Site Layout", 'elessi-theme'),
            "id" => "site_layout",
            "std" => "wide",
            "type" => "select",
            "options" => array(
                "wide" => __("Wide", 'elessi-theme'),
                "boxed" => __("Boxed", 'elessi-theme')
            ),
            // 'class' => 'nasa-theme-option-parent'
        );

        $of_options[] = array(
            "name" => __("Site Background Color - Boxed Layout", 'elessi-theme'),
            "id" => "site_bg_color",
            "std" => "#eee",
            "type" => "color",
            'class' => 'nasa-site_layout',
            'child_of' => 'site_layout',
            'm_target' => 'boxed',
        );

        $of_options[] = array(
            "name" => __("Site Background Image - Boxed Layout", 'elessi-theme'),
            "id" => "site_bg_image",
            "std" => ELESSI_THEME_URI . "/assets/images/bkgd1.jpg",
            "type" => "media",
            'class' => 'nasa-site_layout',
            'child_of' => 'site_layout',
            'm_target' => 'boxed',
        );
        
        $of_options[] = array(
            "name" => __("Background Mode", 'elessi-theme'),
            "id" => "site_bg_dark",
            "std" => "",
            "type" => "select",
            "options" => array(
                "" => __("Light Mode", 'elessi-theme'),
                "1" => __("Dark Mode", 'elessi-theme'),
                "2" => __("Gray Mode", 'elessi-theme')
            ),
            'override_numberic' => true
        );
        
        $of_options[] = array(
            "name" => __("Advanced options", 'elessi-theme'),
            "std" => "<h4>" . __("Advanced options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Back to Top", 'elessi-theme'),
            "id" => "back_to_top",
            "std" => 1,
            "type" => "switch"
        );        
        
        /* $of_options[] = array(
            "name" => __("Where you are", 'elessi-theme'),
            "id" => "where_you_are",
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Menu map", 'elessi-theme'),
            "id" => "where_you_are_menu",
            "std" => 1,
            "type" => "switch",
            'child_of' => 'where_you_are',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Categories map", 'elessi-theme'),
            "id" => "where_you_are_cat",
            "std" => 1,
            "type" => "switch",
            'child_of' => 'where_you_are',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("where you are - Columns number", 'elessi-theme'),
            "id" => "where_you_are_cls",
            "std" => "4",
            "type" => "select",
            "options" => array(
                "1" => __("1", 'elessi-theme'),
                "2" => __("2", 'elessi-theme'),
                "3" => __("3", 'elessi-theme'),
                "4" => __("4", 'elessi-theme'),
                "5" => __("5", 'elessi-theme'),
                "6" => __("6", 'elessi-theme'),
            ),
            'child_of' => 'where_you_are',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("where you are - Medium columns number", 'elessi-theme'),
            "id" => "where_you_are_cls_m",
            "std" => "3",
            "type" => "select",
            "options" => array(
                "1" => __("1", 'elessi-theme'),
                "2" => __("2", 'elessi-theme'),
                "3" => __("3", 'elessi-theme'),
            ),
            'child_of' => 'where_you_are',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("where you are - Small columns number", 'elessi-theme'),
            "id" => "where_you_are_cls_s",
            "std" => "1",
            "type" => "select",
            "options" => array(
                "1" => __("1", 'elessi-theme'),
                "2" => __("2", 'elessi-theme'),
            ),
            'child_of' => 'where_you_are',
            'm_target' => '1',
        ); */
        
        $of_options[] = array(
            "name" => __("Transition Loading", 'elessi-theme'),
            "id" => "transition_load",
            "std" => "wow",
            "type" => "select",
            "options" => array(
                "wow" => __("Animation Effect", 'elessi-theme'),
                "crazy" => __("Gray Effect", 'elessi-theme'),
                "none" => __("None", 'elessi-theme')
            ),
            'class' => 'nasa-transition_load nasa-theme-option-parent'
        );
        
        $of_options[] = array(
            "name" => __("Delay Overlay (ms)", 'elessi-theme'),
            "id" => "delay_overlay",
            "std" => "100",
            "type" => "text",
            'class' => 'hidden-tag nasa-theme-option-child nasa-transition_load nasa-transition_load-wow nasa-delay_overlay'
        );
        
        $of_options[] = array(
            "name" => __("Effect Before Load Site", 'elessi-theme'),
            "id" => "effect_before_load",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Disable Refill - Contact Form 7", 'elessi-theme'),
            "desc" => __("Yes, Please!", 'elessi-theme'),
            "id" => "disable_wpcf7_refill",
            "std" => 1,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => __("Support Upload SVG medias", 'elessi-theme'),
            "desc" => __("Yes, Please!", 'elessi-theme'),
            "id" => "sp_upload_svg",
            "std" => 1,
            "type" => "checkbox"
        );

        $of_options[] = array(
            "name" => __("Age Verification", 'elessi-theme'),
            "id" => "nasa_age_verification",
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Inactive Tab", 'elessi-theme'),
            "id" => "show_notification_leave_tab",
            "desc" => "Show a notification on the browser tab",
            "std" => 0,
            "type" => "switch"
        );  

        $of_options[] = array(
            "name" => __("Inactive Tab Notification Content", 'elessi-theme'),
            "id" => "notification_leave_tab",
            "desc" => 'If you skip this field notification will be default "📢 Come back! | 🔥 Don\'t forget this ...". If you want to add more notifications, you just need to add "|" between notifications.',
            "std" => "📢 Come back! | 🔥 Don't forget this ...",
            "type" => "text",
            'child_of' => 'show_notification_leave_tab',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Widget Options", 'elessi-theme'),
            "std" => "<h4>" . __("Widget Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Toggle Widget Content", 'elessi-theme'),
            "id" => "toggle_widgets",
            "std" => "1",
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Toggle Widget Content - Always Close", 'elessi-theme'),
            "id" => "toggle_widgets_Alc",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Wrapper Widget - Sidebar Classic", 'elessi-theme'),
            "id" => "wrapper_widgets",
            "std" => "0",
            "type" => "switch"
        );
        
        // The block editor from managing widgets
        global $wp_version;
        if (isset($wp_version) && version_compare($wp_version, '5.8', ">=")) {
            $of_options[] = array(
                "name" => __("The block editor from managing widgets", 'elessi-theme'),
                "id" => "block_editor_widgets",
                "std" => 0,
                "type" => "switch"
            );
        }
        
        $of_options[] = array(
            "name" => __("GDPR Options", 'elessi-theme'),
            "std" => "<h4>" . __("GDPR Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("GDPR Notice", 'elessi-theme'),
            "id" => "nasa_gdpr_notice",
            "std" => 0,
            "type" => "switch",
        );
        
        $of_options[] = array(
            "name" => __("GDPR Policies Link", 'elessi-theme'),
            "id" => "nasa_gdpr_policies",
            "std" => "https://policies.google.com",
            "type" => "text",
            'child_of' => 'nasa_gdpr_notice',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => "Performance - Assets",
            "std" => "<h4>" . __("Performance - Assets", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Load Css Canvas", 'elessi-theme'),
            "id" => "css_canvas",
            "std" => 'async',
            "type" => "select",
            "options" => array(
                'async' => __('Async', 'elessi-theme'),
                'sync' => __('Sync', 'elessi-theme')
            )
        );
        
        $list_css = elessi_get_list_css_files_call();
        if (!empty($list_css)) {
            $of_options[] = array(
                "name" => __("Skip Load - Files CSS - Checkin it if you don't want your site call", 'elessi-theme'),
                "id" => "css_files",
                "std" => array(),
                "type" => "multicheck",
                "options" => $list_css,
                'class' => 'fullwidth'
            );
        }
        
        $list_js = elessi_get_list_js_files_delay();
        if (!empty($list_js)) {
            $of_options[] = array(
                "name" => __("List Files JS Delay - Delay JavaScript Execution", 'elessi-theme'),
                "id" => "js_files",
                "std" => array(),
                "type" => "multicheck",
                "options" => $list_js,
                'class' => 'fullwidth'
            );
        }
        
        $of_options[] = array(
            "name" => __("Include Theme Version when call css files", 'elessi-theme'),
            "id" => "css_theme_version",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Include Theme Version when call js files", 'elessi-theme'),
            "id" => "js_theme_version",
            "std" => 0,
            "type" => "switch"
        );
    }
}
