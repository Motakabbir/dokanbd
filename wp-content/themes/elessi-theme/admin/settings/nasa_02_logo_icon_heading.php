<?php
add_action('init', 'elessi_logo_icon_heading');
if (!function_exists('elessi_logo_icon_heading')) {
    function elessi_logo_icon_heading() {
        /**
         * The Options Array
         * Set the Options Array
         */
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Logo and Favicon", 'elessi-theme'),
            "target" => 'logo-icons',
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("Logo Options", 'elessi-theme'),
            "std" => "<h4>" . __("Logo Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );

        $of_options[] = array(
            "name" => __("Logo", 'elessi-theme'),
            "id" => "site_logo",
            "std" => ELESSI_THEME_URI . "/assets/images/logo.jpg",
            "type" => "media"
        );
        
        $of_options[] = array(
            "name" => __("Retina Logo", 'elessi-theme'),
            "id" => "site_logo_retina",
            "std" => ELESSI_THEME_URI . "/assets/images/logo-retina.jpg",
            "type" => "media"
        );
        
        $of_options[] = array(
            "name" => __("Width - Logo", 'elessi-theme'),
            "id" => "logo_width",
            "std" => "",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Height - Logo", 'elessi-theme'),
            "id" => "logo_height",
            "std" => "",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Max Height - Logo", 'elessi-theme'),
            "id" => "max_height_logo",
            "std" => "40px",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Sticky Logo Options", 'elessi-theme'),
            "std" => "<h4>" . __("Sticky Logo Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Sticky Logo", 'elessi-theme'),
            "id" => "site_logo_sticky",
            "std" => '',
            "type" => "media"
        );
        
        $of_options[] = array(
            "name" => __("Width - Sticky Logo", 'elessi-theme'),
            "id" => "logo_sticky_width",
            "std" => "",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Height - Sticky Logo", 'elessi-theme'),
            "id" => "logo_sticky_height",
            "std" => "",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Max Height - Sticky Logo", 'elessi-theme'),
            "id" => "max_height_sticky_logo",
            "std" => "25px",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Mobile Logo Options", 'elessi-theme'),
            "std" => "<h4>" . __("Mobile Logo Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Mobile Logo", 'elessi-theme'),
            "id" => "site_logo_m",
            "std" => '',
            "type" => "media"
        );
        
        $of_options[] = array(
            "name" => __("Width - Mobile Logo", 'elessi-theme'),
            "id" => "logo_width_mobile",
            "std" => "",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Height - Mobile Logo", 'elessi-theme'),
            "id" => "logo_height_mobile",
            "std" => "",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Max Height Logo - Mobile", 'elessi-theme'),
            "id" => "max_height_mobile_logo",
            "std" => "25px",
            "type" => "text"
        );

        $of_options[] = array(
            "name" => __("Favicon Options", 'elessi-theme'),
            "std" => "<h4>" . __("Favicon Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Support Upload ICO medias", 'elessi-theme'),
            // "desc" => __("Yes, Please!", 'elessi-theme'),
            "id" => "sp_upload_ico",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Favicon", 'elessi-theme'),
            "desc" => __("Add your custom Favicon image. 16x16 - 32x32 *.ico or *.png required. (Recommended 16x16 *.ico)", 'elessi-theme'),
            "id" => "site_favicon",
            "std" => "",
            "type" => "media"
        );
    }
}
