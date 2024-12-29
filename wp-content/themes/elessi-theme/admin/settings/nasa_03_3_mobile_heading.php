<?php
add_action('init', 'elessi_mobile_heading');
if (!function_exists('elessi_mobile_heading')) {
    function elessi_mobile_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $static_blocks = elessi_admin_get_static_blocks();
        
        $of_options[] = array(
            "name" => __("Mobile Layout", 'elessi-theme'),
            "target" => "mobile-layout",
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("Global Options", 'elessi-theme'),
            "std" => "<h4>" . __("Global Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __('Enable Mobile Layout', 'elessi-theme'),
            "id" => "enable_nasa_mobile",
            "std" => 0,
            "type" => "switch",
            // 'class' => 'ns-main',
            'desc' => __('Not only is layout responsive, but also the theme uses the device detect technology to switch the web layout compatible on each type of user device', 'elessi-theme') . '<br /><span class="ns-opt-notices">Be careful when using this feature when your site is using a Cache plugin.<br />Please view more the documentation about this <a href="https://elessi-docs.nasatheme.com/mobile-layouts/about-mobile-layout/mobile-layout-cache-plugins/" target="_blank">HERE</a></span>',
        );

        $of_options[] = array(
            "name" => __("Mobile Layout Mode", 'elessi-theme'),
            "id" => "mobile_layout",
            "std" => "df",
            "type" => "select",
            "options" => array(
                "df" => __("Web Mobile", 'elessi-theme'),
                "app" => __("App Simulation", 'elessi-theme')
            ),
            'child_of' => 'enable_nasa_mobile',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Mobile Menu Layout", 'elessi-theme'),
            "id" => "mobile_menu_layout",
            "std" => "light",
            "type" => "select",
            "options" => array(
                "light" => __("Light", 'elessi-theme'),
                "dark" => __("Dark", 'elessi-theme')
            ),
        );
        
        $of_options[] = array(
            "name" => __("Mobile Bottom Bar Options", 'elessi-theme'),
            "std" => "<h4>" . __("Mobile Bottom Bar Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        /**
         * On | Off Mobile Bottom Bar
         */
        $of_options[] = array(
            "name" => __("Mobile Bottom Bar", 'elessi-theme'),
            "id" => "m_bot_bar",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Mobile Bottom Bar Content", 'elessi-theme'),
            "id" => "m_bot_bar_ct",
            "type" => "select2id",
            "options" => $static_blocks,
            'select_class' => 'nasa-ad-select2',
            'class' => 'ns-block-type',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'm_bot_bar',
            'm_target' => '1',
        );

        /**
         * Mobile Single Product Options
         */
        $of_options[] = array(
            "name" => __("Mobile Single Product Options", 'elessi-theme'),
            "std" => "<h4>" . __("Mobile Single Product Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );

        $of_options[] = array(
            "name" => __("Single Product - Mobile - Top Navigation", 'elessi-theme'),
            "id" => "single_product_mobile_top_navication",
            "std" => "0",
            "type" => "switch",
            "desc" =>  __("The mobile top navigation will only appears when the website is in mobile app mode", 'elessi-theme')
        );

        $of_options[] = array(
            "name" => __("Single Product - Mobile - Top Navigation - Custom Tabs", 'elessi-theme'),
            "id" => "single_product_mobile_top_navication_ctab",
            "std" => "0",
            "type" => "switch",
            "desc" =>  __("When this option is enabled, all custom tabs will be displayed", 'elessi-theme'),
            'child_of' => 'single_product_mobile_top_navication',
            'm_target' => "1",
        );

        $of_options[] = array(
            "name" => __('Turn Off Sidebar on Mobile Device', 'elessi-theme'),
            "desc" => __("Yes, Please!", 'elessi-theme'),
            "id" => "single_product_mobile",
            "std" => 0,
            "type" => "checkbox"
        );

        /**
         * Mobile Mini Cart Options
         */
        $of_options[] = array(
            "name" => __("Mobile Mini Cart Options", 'elessi-theme'),
            "std" => "<h4>" . __("Mobile Mini Cart Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );

        $of_options[] = array(
            "name" => __("Mini Cart - Simple", 'elessi-theme'),
            "id" => "mini_cart_mobile_view_hide",
            "std" => "0",
            "type" => "switch",
            "img_desc" => ELESSI_ADMIN_DIR_URI . 'assets/images/mobile_simple_mini_cart.png',
            'desc' => __('Hide "View Cart" Button in Mini Cart', 'elessi-theme'),
            'class' => 'img-max-height-150'
        );
    }
}
