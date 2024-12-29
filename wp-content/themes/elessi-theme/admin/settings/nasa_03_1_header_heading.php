<?php
add_action('init', 'elessi_header_heading');
if (!function_exists('elessi_header_heading')) {
    function elessi_header_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $static_blocks = elessi_admin_get_static_blocks();
        
        $of_options[] = array(
            "name" => __("Header Global", 'elessi-theme'),
            "target" => 'header-global',
            "type" => "heading"
        );

        $of_options[] = array(
            "name" => __("Header Options", 'elessi-theme'),
            "std" => "<h4>" . __("Header Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $header_type_list = array(
            '1' => ELESSI_ADMIN_DIR_URI . 'assets/images/header-1.jpg',
            '2' => ELESSI_ADMIN_DIR_URI . 'assets/images/header-2.jpg',
            '3' => ELESSI_ADMIN_DIR_URI . 'assets/images/header-3.jpg',
            '4' => ELESSI_ADMIN_DIR_URI . 'assets/images/header-4.jpg',
            '5' => ELESSI_ADMIN_DIR_URI . 'assets/images/header-5.jpg',
            '6' => ELESSI_ADMIN_DIR_URI . 'assets/images/header-6.jpg',
            '7' => ELESSI_ADMIN_DIR_URI . 'assets/images/header-7.jpg',
        );
        
        if (NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true)) {
            $header_type_list['nasa-custom'] = ELESSI_ADMIN_DIR_URI . 'assets/images/header-builder-wpbakery.jpg';
        }
        
        if (NASA_HF_BUILDER) {
            $header_type_list['nasa-elm'] = ELESSI_ADMIN_DIR_URI . 'assets/images/header-builder-elementor.jpg';
        }
        
        $of_options[] = array(
            "name" => __("Header Layout", 'elessi-theme'),
            "id" => "header-type",
            "std" => "1",
            "type" => "images",
            "options" => $header_type_list,
            'class' => 'nasa-header-type-select'
        );
        
        /**
         * Header Builder - With WPBakery
         */
        if (NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true)) {
            $header_builder = elessi_admin_get_header_builder();
            $header_options = array_merge(
                array('default' => __('Select the Header Builder', 'elessi-theme')),
                $header_builder
            );

            $of_options[] = array(
                "name" => __("Header Theme Builder", 'elessi-theme'),
                "id" => "header-custom",
                "type" => "select2id",
                'override_numberic' => true,
                "options" => $header_options,
                'std' => '',
                // 'class' => 'hidden-tag nasa-header-type-child nasa-header-type-select-nasa-custom nasa-header-custom ns-wpb-type',
                'select_class' => 'nasa-ad-select2',
                'desc' => '<a class="nswpb-edit hidden-tag" href="#" data-href="' . esc_url(admin_url('post.php?post=ns_wpb_id&action=edit')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
                'child_of' => 'header-type',
                'm_target' => 'nasa-custom',
            );
        }
        
        /**
         * Headers Elementor Builder
         */
        if (NASA_HF_BUILDER) {
            $header_builder = elessi_admin_get_header_elementor();
            $header_builder['0'] = __('Select the Header Elementor', 'elessi-theme');
            $of_options[] = array(
                "name" => __("Header Elementor Builder", 'elessi-theme'),
                "id" => "header-elm",
                "type" => "select",
                'override_numberic' => true,
                "options" => $header_builder,
                'std' => '',
                'select_class' => 'nasa-ad-select2',
                //'class' => 'hidden-tag nasa-header-type-child nasa-header-type-select-nasa-elm nasa-header-elm ns-hfe-type',
                'desc' => '<a class="nshfe-edit hidden-tag" href="#" data-href="' . esc_url(admin_url('post.php?post=ns_hfe_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
                'child_of' => 'header-type',
                'm_target' => 'nasa-elm',
            );
        }
        
        $of_options[] = array(
            "name" => __("Menu Options", 'elessi-theme'),
            "std" => "<h4>" . __("Menu Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Flexible - Menu Resizing (Desktop and Tablet)", 'elessi-theme'),
            "id" => "flexible_menu",
            "std" => 1,
            "type" => "switch",
            'class' => 'nasa-flexible_menu',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Menu Font Size (Desktop and Tablet)", 'elessi-theme'),
            "id" => "font_size_menu",
            "std" => "100",
            "step" => "1",
            "min" => '80',
            "max" => '150',
            "type" => "sliderui"
        );
        
        $option_menu = elessi_admin_get_menu_options();
        
        $of_options[] = array(
            "name" => __("Vertical Menu", 'elessi-theme'),
            "id" => "vertical_menu_selected",
            "std" => "",
            "type" => "select",
            'override_numberic' => true,
            "options" => $option_menu,
            // 'class' => 'hidden-tag nasa-header-type-child nasa-header-type-select-4 nasa-header-type-select-6',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Vertical Root Level - Parent - 0", 'elessi-theme'),
            "id" => "v_root",
            "std" => 0,
            "type" => "switch",
            // 'class' => 'hidden-tag nasa-header-type-child nasa-header-type-select-4 nasa-header-type-select-6',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Vertical Root Level - Limit", 'elessi-theme'),
            "id" => "v_root_limit",
            "std" => '',
            "type" => "text",
            // 'class' => 'hidden-tag nasa-header-type-child nasa-header-type-select-4 nasa-header-type-select-6',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Ordering Mobile Menu", 'elessi-theme'),
            "id" => "order_mobile_menus",
            "std" => "",
            "type" => "select",
            'override_numberic' => true,
            "options" => array(
                '' => __("Main Menu > Vertical Menu", 'elessi-theme'),
                'v-focus' => __("Vertical Menu > Main Menu", 'elessi-theme'),
            ),
            // 'class' => 'hidden-tag nasa-header-type-child nasa-header-type-select-4 nasa-header-type-select-6',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Fullwidth Main Menu", 'elessi-theme'),
            "id" => "fullwidth_main_menu",
            "std" => 1,
            "type" => "switch",
            'class' => 'nasa-fullwidth_main_menu',
            'child_of' => 'header-type',
            'm_target' => array('2', '3'),
        );
        
        $of_options[] = array(
            "name" => __("Main Menu Background Color", 'elessi-theme'),
            "id" => "bg_color_main_menu",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-bg_color_main_menu',
            'child_of' => 'header-type',
            'm_target' => array('2', '3', '4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Main Menu Background Color - Sticky", 'elessi-theme'),
            "id" => "bg_color_main_menu_stk",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-bg_color_main_menu_stk',
            'child_of' => 'header-type',
            'm_target' => array('2', '3', '4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Main Menu Text Color", 'elessi-theme'),
            "id" => "text_color_main_menu",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_main_menu',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Main Menu Text Color - Sticky", 'elessi-theme'),
            "id" => "text_color_main_menu_stk",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_main_menu_stk',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Vertical Menu Background - Focus", 'elessi-theme'),
            "id" => "bg_color_v_menu",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-bg_color_v_menu',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Vertical Menu Background - Focus - Sticky", 'elessi-theme'),
            "id" => "bg_color_v_menu_stk",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-bg_color_v_menu_stk',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Vertical Menu Text Color - Focus", 'elessi-theme'),
            "id" => "text_color_v_menu",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_v_menu',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Vertical Menu Text Color - Focus - Sticky", 'elessi-theme'),
            "id" => "text_color_v_menu_stk",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_v_menu_stk',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Account Options", 'elessi-theme'),
            "std" => "<h4>" . __("Account Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Disable Login/Register", 'elessi-theme'),
            "id" => "hide_tini_menu_acc",
            "on" => __("Yes", 'elessi-theme'),
            "off" => __("No", 'elessi-theme'),
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Login/Register by Ajax form", 'elessi-theme'),
            "id" => "login_ajax",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Position Account Icon", 'elessi-theme'),
            "id" => "acc_pos",
            "std" => "top",
            "type" => "select",
            "options" => array(
                "top" => __("In Topbar - Header", 'elessi-theme'),
                "group" => __("In Group Icons - Header", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Account On Main Screen - Mobile Layout", 'elessi-theme'),
            "id" => "main_screen_acc_mobile",
            "std" => 1,
            "type" => "switch"
        );

        if (function_exists('imagecreatetruecolor')) {
            $of_options[] = array(
                "name" => __("Captcha For Register Form", 'elessi-theme'),
                "id" => "register_captcha",
                "std" => 0,
                "type" => "switch"
            );
        }
        
        $of_options[] = array(
            "name" => __("Addon Options", 'elessi-theme'),
            "std" => "<h4>" . __("Addon Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        /* $of_options[] = array(
            "name" => __("Transparent Header", 'elessi-theme'),
            "id" => "header_transparent",
            "std" => 0,
            "type" => "switch",
            'class' => 'nasa-header_transparent'
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '5', '7'),
        ); */
        
        $of_options[] = array(
            "name" => __("The Block Under Header", 'elessi-theme'),
            "id" => "header-block",
            "type" => "select2id",
            "options" => $static_blocks,
            'class' => 'nasa-header-block ns-block-type',
            'select_class' => 'nasa-ad-select2',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("The Block beside Logo in Header Type 2", 'elessi-theme'),
            "id" => "header-block-type_2",
            "type" => "select2id",
            "options" => $static_blocks,
            'select_class' => 'nasa-ad-select2',
            'class' => 'nasa-header-block-type_2 ns-block-type',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'header-type',
            'm_target' => array('2'),
        );
        
        $of_options[] = array(
            "name" => __("The Block beside Main menu in Header Type 4, 6", 'elessi-theme'),
            "id" => "header-block-type_4",
            "type" => "select2id",
            "options" => $static_blocks,
            'select_class' => 'nasa-ad-select2',
            'class' => 'ns-block-type',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'header-type',
            'm_target' => array('4', '6'),
        );

        $of_options[] = array(
            "name" => __("Sticky", 'elessi-theme'),
            "id" => "fixed_nav",
            "std" => 1,
            "type" => "switch",
            'class' => 'nasa-fixed_nav',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("Background Color Header", 'elessi-theme'),
            "id" => "bg_color_header",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-bg_color_header',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("Background Color Header - Sticky", 'elessi-theme'),
            "id" => "bg_color_header_stk",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-bg_color_header_stk',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("Header Icons", 'elessi-theme'),
            "id" => "text_color_header",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_header',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("Header Icons - Sticky", 'elessi-theme'),
            "id" => "text_color_header_stk",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_header_stk',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("Header Icons Hover", 'elessi-theme'),
            "id" => "text_color_hover_header",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_hover_header',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("Header Icons Hover - Sticky", 'elessi-theme'),
            "id" => "text_color_hover_header_stk",
            "std" => "",
            "type" => "color",
            'class' => 'nasa-text_color_hover_header_stk',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '5', '6', '7'),
        );
        
        $of_options[] = array(
            "name" => __("Search Options", 'elessi-theme'),
            "std" => "<h4>" . __("Search Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Search Bar Effect", 'elessi-theme'),
            "id" => "search_effect",
            "std" => "right-to-left",
            "type" => "select",
            "options" => array(
                "rightToLeft" => __("Right To Left", 'elessi-theme'),
                "fadeInDown" => __("Fade In Down", 'elessi-theme'),
                "fadeInUp" => __("Fade In Up", 'elessi-theme'),
                "leftToRight" => __("Left To Right", 'elessi-theme'),
                "fadeIn" => __("Fade In", 'elessi-theme'),
                "noEffect" => __("No Effect", 'elessi-theme')
            ),
            'class' => 'nasa-search_effect',
            'child_of' => 'header-type',
            'm_target' => array('1', '2'),
        );
        
        if (NASA_WOO_ACTIVED) {
            // Options live search products
            $of_options[] = array(
                "name" => __("Search Anything After Submit", 'elessi-theme'),
                "id" => "anything_search",
                "std" => 0,
                "type" => "switch",
                "desc" => '<span class="nasa-warning red-color">' . __("If Turn on, the live search Ajax feature will be lost", 'elessi-theme') . '</span>',
            );

            // Options live search products
            $of_options[] = array(
                "name" => __("Live Search Ajax Products", 'elessi-theme'),
                "id" => "enable_live_search",
                "std" => 1,
                "type" => "switch"
            );

            // Options Support search products by SKU
            $of_options[] = array(
                "name" => __("Support Search By SKU", 'elessi-theme'),
                "id" => "sp_search_sku",
                "std" => 0,
                "type" => "switch"
            );

            // limit_results_search
            $of_options[] = array(
                "name" => __("Results Ajax Search (Limit Products)", 'elessi-theme'),
                "id" => "limit_results_search",
                "std" => "5",
                "type" => "text"
            );
            
            $of_options[] = array(
                "name" => __("Live Search Layout - (Header type 1, 2, 5, 7)", 'elessi-theme'),
                "id" => "search_layout",
                "std" => "classic",
                "type" => "select",
                "options" => array(
                    "classic" => __("Classic", 'elessi-theme'),
                    "modern" => __("Modern", 'elessi-theme')
                )
            );

            $of_options[] = array(
                "name" => __("Suggested Keywords - (Header type 1, 2, 5, 7)", 'elessi-theme'),
                "desc" => 'Please input the Suggested keywords (ex: Sweater, Jacket, T-shirt ...).',
                "id" => "hotkeys_search",
                "std" => '',
                "type" => "textarea",
                'child_of' => 'search_layout',
                'm_target' => array('modern'),
            );

            $of_options[] = array(
                "name" => __("Popular Keywords - (Header type 1, 2, 5, 7)", 'elessi-theme'),
                "desc" => 'Please input the Popular Searches keywords (ex: Sweater, Jacket, T-shirt).',
                "id" => "popkeys_search",
                "std" => '',
                "type" => "textarea",
                'child_of' => 'search_layout',
                'm_target' => array('modern'),
            );
            // End Options live search products
        }
        
        $of_options[] = array(
            "name" => __("Top Bar Options", 'elessi-theme'),
            "std" => "<h4>" . __("Top Bar Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Top Bar", 'elessi-theme'),
            "id" => "topbar_on",
            "std" => 1,
            "type" => "switch",
            'class' => 'nasa-fixed_nav',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '6'),
        );

        $of_options[] = array(
            "name" => __("Toggle Top Bar", 'elessi-theme'),
            "id" => "topbar_toggle",
            "std" => 0,
            "type" => "switch",
            'class' => 'nasa-topbar_toggle nasa-fixed_nav',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Toggle Top Bar - Initialize", 'elessi-theme'),
            "id" => "topbar_default_show",
            "std" => 1,
            "type" => "switch",
            'class' => 'hidden-tag nasa-topbar_df-show'
        );

        $of_options[] = array(
            "name" => __("Languages Switcher", 'elessi-theme'),
            "id" => "switch_lang",
            "std" => 0,
            "type" => "switch",
            "desc" => '<span class="nasa-warning red-color">' . __("Requires WPML", 'elessi-theme') . '</span>',
        );
        
        $of_options[] = array(
            "name" => __("Currencies Switcher", 'elessi-theme'),
            "id" => "switch_currency",
            "std" => 0,
            "type" => "switch",
            "desc" => '<span class="nasa-warning red-color">' . __("Requires WPML | FOX - Currency Switcher Professional for WooCommerce | CURCY - Multi Currency for WooCommerce", 'elessi-theme') . '</span>',
        );
        
        //(%symbol%) %code%
        $of_options[] = array(
            "name" => __("Format Currency - Only Apply for WPML", 'elessi-theme'),
            "desc" => __("Default (%symbol%) %code%. You can custom for this. Ex (%name% (%symbol%) - %code%)", 'elessi-theme'),
            "id" => "switch_currency_format",
            "std" => "",
            "type" => "text",
        );
        
        $of_options[] = array(
            "name" => __("Top Bar Content", 'elessi-theme'),
            "id" => "topbar_content",
            "type" => "select2id",
            "options" => $static_blocks,
            'select_class' => 'nasa-ad-select2',
            'class' => 'nasa-topbar_content ns-block-type',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'header-type',
            'm_target' => array('1', '2', '3', '4', '6'),
        );
        
        $of_options[] = array(
            "name" => __("Topbar Background", 'elessi-theme'),
            "id" => "bg_color_topbar",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Topbar Text color", 'elessi-theme'),
            "id" => "text_color_topbar",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Topbar Text color hover", 'elessi-theme'),
            "id" => "text_color_hover_topbar",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Promotion News", 'elessi-theme'),
            "std" => "<h4>" . __("Promotion News", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Top Bar Promotion News", 'elessi-theme'),
            "id" => "enable_post_top",
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Type Show", 'elessi-theme'),
            "id" => "type_display",
            "std" => 'custom',
            "type" => "select",
            "options" => array(
                'custom' => __('Custom Content', 'elessi-theme'),
                'list-posts' => __('Posts', 'elessi-theme')
            ),
            'class' => 'type_promotion'
        );

        $of_options[] = array(
            "name" => __("Custom Content", 'elessi-theme'),
            "desc" => '<a href="javascript:void(0);" class="reset_content_custom"><b>Default value</b></a> for My content custom.<br /><a href="javascript:void(0);" class="restore_content_custom"><b>Restore text</b></a> for My content custom.<br />',
            "id" => "content_custom",
            "std" => '',
            'type' => 'textarea',
            'class' => 'nasa-custom_content',
            'child_of' => 'type_display',
            'm_target' => 'custom',
        );

        $of_options[] = array(
            "name" => __("Category Post", 'elessi-theme'),
            "id" => "category_post",
            "std" => '',
            "type" => "select",
            "options" => elessi_get_cats_array(),
            'select_class' => 'nasa-ad-select2',
            'class' => 'nasa-list_post',
            'child_of' => 'type_display',
            'm_target' => 'list-posts',
        );

        $of_options[] = array(
            "name" => __("Limit Posts", 'elessi-theme'),
            "id" => "number_post",
            "std" => 4,
            "type" => "text",
            'class' => 'nasa-list_post',
            'child_of' => 'type_display',
            'm_target' => 'list-posts',
        );

        $of_options[] = array(
            "name" => __("Slide Show", 'elessi-theme'),
            "id" => "number_post_slide",
            "std" => 1,
            "type" => "text",
            'class' => 'nasa-list_post',
            'child_of' => 'type_display',
            'm_target' => 'list-posts',
        );

        $of_options[] = array(
            "name" => __("Top Bar Promotion News Auto Scroll", 'elessi-theme'),
            "id" => "enable_promo_slide",
            "std" => 0,
            "type" => "switch",
            'child_of' => 'type_display',
            'm_target' => 'custom',
        );

        $of_options[] = array(
            "name" => __("Full Width", 'elessi-theme'),
            "id" => "enable_fullwidth",
            "std" => 1,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Text Promotion Color", 'elessi-theme'),
            "id" => "t_promotion_color",
            "std" => "#333",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Background Color", 'elessi-theme'),
            "id" => "bg_promotion",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Background Image", 'elessi-theme'),
            "id" => "background_area",
            "std" => ELESSI_THEME_URI . '/assets/images/promo_bg.jpg',
            "type" => "media"
        );
    }
}
