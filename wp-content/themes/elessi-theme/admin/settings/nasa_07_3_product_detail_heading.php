<?php
add_action('init', 'elessi_product_detail_heading');
if (!function_exists('elessi_product_detail_heading')) {
    function elessi_product_detail_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Single Product Page", 'elessi-theme'),
            "target" => 'product-detail',
            "type" => "heading",
        );
        
        $of_options[] = array(
            "name" => __("Layout Option", 'elessi-theme'),
            "std" => "<h4>" . __("Layout Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Product Sidebar Position", 'elessi-theme'),
            "id" => "product_sidebar",
            "std" => "left",
            "type" => "select",
            "options" => array(
                "left" => __("Left Sidebar", 'elessi-theme'),
                "right" => __("Right Sidebar", 'elessi-theme'),
                "no" => __("No Sidebar", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Sticky Sidebar", 'elessi-theme'),
            "id" => "single_product_sticky_sidebar_classic",
            "std" => "0",
            "type" => "switch",
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-classic',
            'child_of' => 'product_detail_layout',
            'm_target' => array('classic'),
        );
        
        $of_options[] = array(
            "name" => __("Single Product Layout", 'elessi-theme'),
            "id" => "product_detail_layout",
            "std" => "new",
            "type" => "images",
            "options" => array(
                'classic'   => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-classic.jpg',
                'new'       => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-new.jpg',
                'new-2'     => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-new-2.jpg',
                'new-3'     => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-new-3.jpg',
                'full'      => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-fullwidth.jpg',
                'modern-1'  => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-modern-1.jpg',
                'modern-2'  => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-modern-2.jpg',
                'modern-3'  => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-modern-3.jpg',
                'modern-4'  => ELESSI_ADMIN_DIR_URI . 'assets/images/single-product-modern-4.jpg',
            ),
            'class' => 'flex-row flex-wrap flex-start img-max-height-100'
        );
        
        $of_options[] = array(
            "name" => __("Background Color", 'elessi-theme'),
            "id" => "sp_bgl",
            "std" => "",
            "type" => "color",
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-modern-2 nasa-product_detail_layout-modern-3',
            'child_of' => 'product_detail_layout',
            'm_target' => array('modern-2', 'modern-3', 'modern-4','new-3'),
        );
        
        $of_options[] = array(
            "name" => __("Images Columns", 'elessi-theme'),
            "id" => "product_image_layout",
            "std" => "double",
            "type" => "select",
            "options" => array(
                "double" => __("2 Columns", 'elessi-theme'),
                "single" => __("1 Column", 'elessi-theme')
            ),
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new',
            'child_of' => 'product_detail_layout',
            'm_target' => array('new','new-2'),
        );
        
        $of_options[] = array(
            "name" => __("Images Style", 'elessi-theme'),
            "id" => "product_image_style",
            "std" => "slide",
            "type" => "select",
            "options" => array(
                "slide" => __("Slide Images", 'elessi-theme'),
                "scroll" => __("Scroll Images", 'elessi-theme')
            ),
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new',
            'child_of' => 'product_detail_layout',
            'm_target' => array('new'),
        );
        
        $of_options[] = array(
            "name" => __("Thumbnail Layout", 'elessi-theme'),
            "id" => "product_thumbs_style",
            "std" => "ver",
            "type" => "select",
            "options" => array(
                "ver" => __("Vertical", 'elessi-theme'),
                "hoz" => __("Horizontal", 'elessi-theme')
            ),
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-classic',
            'desc' => '<span class="red-color">Note: This option only Apply With Slides.</span>',
            'child_of' => 'product_detail_layout',
            'm_target' => array('classic', 'modern-2', 'modern-3'),
        );
        
        $of_options[] = array(
            "name" => __("Overflows: + 0.5 items", 'elessi-theme'),
            "id" => "half_full_slide",
            "std" => "0",
            "type" => "switch",
            'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-full',
            'desc' => '<span class="red-color">Note: The Hover Zoom Image Will be Turned Off!!!</span>'
        );
        
        $of_options[] = array(
            "name" => __("Infomations Columns", 'elessi-theme'),
            "id" => "full_info_col",
            "std" => "1",
            "type" => "select",
            "options" => array(
                "1" => __("1 Column", 'elessi-theme'),
                "2" => __("2 Columns", 'elessi-theme')
            ),
            'override_numberic' => true,
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-full',
            'child_of' => 'product_detail_layout',
            'm_target' => array('full'),
        );
        
        $of_options[] = array(
            "name" => __("Auto Slide", 'elessi-theme'),
            "id" => "product_slide_auto",
            "std" => "0",
            "type" => "switch",
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new nasa-product_detail_layout-classic nasa-product_detail_layout-full nasa-product_detail_layout-modern-1 nasa-product_detail_layout-modern-2 nasa-product_detail_layout-modern-3',
            'child_of' => 'product_detail_layout',
            'm_target' => array('new', 'classic', 'full', 'modern-1', 'modern-2', 'modern-3', 'modern-4'),
        );

        $of_options[] = array(
            "name" => __("Infinite Slide", 'elessi-theme'),
            "id" => "product_slide_loop",
            "desc" => __("Only effective for style 1, style 2(Images style : slide images), style 6 and style 7", 'elessi-theme'),
            "std" => 0,
            "type" => "switch",
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new nasa-product_detail_layout-classic nasa-product_detail_layout-modern-1 nasa-product_detail_layout-modern-2 nasa-product_detail_layout-modern-3',
            'child_of' => 'product_detail_layout',
            'm_target' => array('new', 'classic', 'modern-1', 'modern-2', 'modern-3', 'modern-4'),
        );
        
        $of_options[] = array(
            "name" => __("Dots for Main Slide", 'elessi-theme'),
            "id" => "product_slide_dot",
            "std" => 0,
            "type" => "switch",
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new nasa-product_detail_layout-classic nasa-product_detail_layout-full nasa-product_detail_layout-modern-1 nasa-product_detail_layout-modern-2 nasa-product_detail_layout-modern-3',
            'child_of' => 'product_detail_layout',
            'm_target' => array('new', 'classic', 'full', 'modern-1', 'modern-2', 'modern-3', 'modern-4'),
        );
        
        $of_options[] = array(
            "name" => __("Arrows for Main Slide", 'elessi-theme'),
            "id" => "product_slide_arrows",
            "std" => 0,
            "type" => "switch",
            // 'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new nasa-product_detail_layout-classic nasa-product_detail_layout-full nasa-product_detail_layout-modern-1 nasa-product_detail_layout-modern-2 nasa-product_detail_layout-modern-3',
            'child_of' => 'product_detail_layout',
            'm_target' => array('new', 'classic', 'full', 'modern-1', 'modern-2', 'modern-3', 'modern-4'),
        );
        
        $of_options[] = array(
            "name" => __("Hover Zoom Image", 'elessi-theme'),
            "id" => "product-zoom",
            "std" => 1,
            "type" => "switch",
            'desc' => '<span class="red-color">Note: The "Hover Zoom Image" does not support for Mobile or devices that do not have a "hover cursor" event.</span>'
        );
        
        $of_options[] = array(
            "name" => __("Lightbox Image", 'elessi-theme'),
            "id" => "product-image-lightbox",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Focus Main Image", 'elessi-theme'),
            "id" => "enable_focus_main_image",
            "desc" => __("Focus main image after active variation product", 'elessi-theme'),
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Form Options", 'elessi-theme'),
            "std" => "<h4>" . __("Form Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Buy Now", 'elessi-theme'),
            "id" => "enable_buy_now",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Buy Now Background Color", 'elessi-theme'),
            "id" => "buy_now_bg_color",
            "std" => "",
            "type" => "color",
            'child_of' => 'enable_buy_now',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Buy Now Background Color Hover", 'elessi-theme'),
            "id" => "buy_now_bg_color_hover",
            "std" => "",
            "type" => "color",
            'child_of' => 'enable_buy_now',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Sticky Add To Cart", 'elessi-theme'),
            "id" => "enable_fixed_add_to_cart",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Sticky Buy Now - Desktop", 'elessi-theme'),
            "id" => "enable_fixed_buy_now_desktop",
            "std" => "0",
            "type" => "switch",
            'child_of' => 'enable_buy_now',
            'm_target' => '1',
        );
        
        $options = array(
            "no" => __("Not Show", 'elessi-theme'),
            "ext" => __("Extends Desktop", 'elessi-theme')
        );
        
        if (class_exists('Nasa_Mobile_Detect')) {
            $options['btn'] = __("Only Show Buttons", 'elessi-theme');
        }
        
        $of_options[] = array(
            "name" => __("Sticky Add To Cart In Mobile", 'elessi-theme'),
            "id" => "mobile_fixed_add_to_cart",
            "std" => "no",
            "type" => "select",
            "options" => $options,
            "desc" => __('Not use Mobile App - Simulator', 'elessi-theme'),
            'child_of' => 'enable_nasa_mobile',
            'm_target' => '1',
        );
        
        // Enable AJAX add to cart buttons on Detail OR Quickview
        $of_options[] = array(
            "name" => __("AJAX add to cart button on Single And Quickview", 'elessi-theme'),
            "id" => "enable_ajax_addtocart",
            "std" => "1",
            "type" => "switch",
            "desc" => '<span class="nasa-warning red-color">' . __('Note: Consider disabling this feature if you are using a third-party plugin developed for the Add to Cart feature in the Single Product Page!', 'elessi-theme') . '</span>'
        );
        
        $of_options[] = array(
            "name" => __("WooCommerce Tabs - Options", 'elessi-theme'),
            "std" => "<h4>" . __("WooCommerce Tabs - Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Tabs Layouts", 'elessi-theme'),
            "id" => "tab_style_info",
            "std" => "2d-no-border",
            "type" => "images",
            "options" => array(
                '2d-no-border'      => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-2d-noborder.jpg',
                '2d-radius'         => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-2d-radius.jpg',
                '2d-radius-dashed'  => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-2d-radius-dash.jpg',
                '2d'                => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-2d.jpg',
                '3d'                => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-3d.jpg',
                'slide'             => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-slide.jpg',
                'accordion'         => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-accordion.jpg',
                'accordion-2'       => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-accordion-2.jpg',
                'small-accordion'   => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-small-accordion.jpg',
                'scroll-down'       => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-scroll-down.jpg',
                'ver-1'             => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-vertical-1.jpg',
                'ver-2'             => ELESSI_ADMIN_DIR_URI . 'assets/images/single-tab-vertical-2.jpg',
            ),
            'class' => 'flex-row flex-wrap flex-start img-width-50'
        );
        
        $of_options[] = array(
            "name" => __("Tabs Align", 'elessi-theme'),
            "id" => "tab_align_info",
            "std" => "center",
            "type" => "select",
            "options" => array(
                "center" => __("Center", 'elessi-theme'),
                "left" => __("Left", 'elessi-theme'),
                "right" => __("Right", 'elessi-theme')
            ),
            // 'class' => 'nasa-tab_style_info nasa-tab_style_info-2d-no-border nasa-tab_style_info-2d-radius nasa-tab_style_info-2d-radius-dashed nasa-tab_style_info-2d nasa-tab_style_info-3d nasa-tab_style_info-slide nasa-tab_style_info-scroll-down nasa-theme-option-child',
            'child_of' => 'tab_style_info',
            'm_target' => array('2d-no-border', '2d-radius', '2d-radius-dashed', '2d', '3d', 'slide', 'scroll-down'),
        );
        
        $of_options[] = array(
            "name" => __('WooCommerce Tabs Off - Canvas in Mobile (Not use Mobile App - Simulator)', 'elessi-theme'),
            "id" => "woo_tabs_off_canvas",
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __('WooCommerce Tabs - Read more / Show less (Mobile App - Simulator)', 'elessi-theme'),
            "id" => "ns_rm_sl",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __('Product Description Wrapper - Apply with Tabs Classic', 'elessi-theme'),
            "id" => "desc_product_wrap",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Hide Additional Information Tab", 'elessi-theme'),
            "desc" => __("Yes, Please!", 'elessi-theme'),
            "id" => "hide_additional_tab",
            "std" => 0,
            "type" => "checkbox"
        );
        
        $static_blocks = elessi_admin_get_static_blocks();
        
        $of_options[] = array(
            "name" => __("Tab Global", 'elessi-theme'),
            "id" => "tab_glb",
            "type" => "select2id",
            "options" => $static_blocks,
            'class' => 'ns-block-type',
            'select_class' => 'nasa-ad-select2',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
        );
        
        $of_options[] = array(
            "name" => __("Addon Options", 'elessi-theme'),
            "std" => "<h4>" . __("Addon Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Deal Time in Single or Quickview", 'elessi-theme'),
            "id" => "single-product-deal",
            "std" => 1,
            "type" => "switch"
        );
        
        // next_prev_product
        $of_options[] = array(
            "name" => __("Next - Previous Product", 'elessi-theme'),
            "id" => "next_prev_product",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Stock Progress Bar", 'elessi-theme'),
            "id" => "enable_progess_stock",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Meta Infomations (SKU, Categories, Tags, etc...)", 'elessi-theme'),
            "id" => "pmeta_enb",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Meta Infomations Position", 'elessi-theme'),
            "id" => "pmeta_info",
            "std" => "",
            "type" => "select",
            "options" => array(
                "" => __("After WooCommerce Tabs", 'elessi-theme'),
                "df" => __("Default", 'elessi-theme')
            ),
            'child_of' => 'pmeta_enb',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Allow Comments Images upload", 'elessi-theme'),
            "id" => "comment_media",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Max files Comments Images upload", 'elessi-theme'),
            "id" => "maxfiles_comment_media",
            "std" => "3",
            "type" => "text",
            'child_of' => 'comment_media',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Max Size Comments Images upload (kb)", 'elessi-theme'),
            "id" => "maxsize_comment_media",
            "std" => "1024",
            "type" => "text",
            'child_of' => 'comment_media',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Allow Comments Video upload", 'elessi-theme'),
            "id" => "comment_media_video",
            "std" => "0",
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Max files Comments Video upload", 'elessi-theme'),
            "id" => "maxfiles_comment_media_video",
            "std" => "1",
            "type" => "text",
            'child_of' => 'comment_media_video',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Max Size Comments Video upload (kb)", 'elessi-theme'),
            "id" => "maxsize_comment_media_video",
            "std" => "1024",
            "type" => "text",
            'child_of' => 'comment_media_video',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Ajax Review Load", 'elessi-theme'),
            "id" => "single_review_ajax",
            "std" => "0",
            "type" => "switch",
            "desc" => 'Support - Load Ajax when viewing Product Reviews on the Single Product Page'
        );
        
        $of_options[] = array(
            "name" => __("Ajax Load", 'elessi-theme'),
            "id" => "single_product_ajax",
            "std" => "0",
            "type" => "switch",
            "desc" => 'Support - Load Ajax when viewing each Product on the Single Product Page'
        );

        $of_options[] = array(
            "name" => __("Layout Review Defaulf", 'elessi-theme'),
            "id" => "single_review_layout",
            "std" => "list",
            "type" => "select",
            "options" => array(
                "masonry" => __("Masonry", 'elessi-theme'),
                "list" => __("List", 'elessi-theme')
            ),
        );
        
        $of_options[] = array(
            "name" => __("Related | You may also like&hellip;", 'elessi-theme'),
            "std" => "<h4>" . __("Related | You may also like&hellip;", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __('Related Products', 'elessi-theme'),
            "id" => "relate_product",
            "std" => 1,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Number for related products", 'elessi-theme'),
            "id" => "relate_product_number",
            "std" => "12",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => __("Columns Related | You may also like&hellip;", 'elessi-theme'),
            "id" => "relate_columns_desk",
            "std" => "5-cols",
            "type" => "select",
            "options" => array(
                "6-cols" => __("6 columns", 'elessi-theme'),
                "5-cols" => __("5 columns", 'elessi-theme'),
                "4-cols" => __("4 columns", 'elessi-theme'),
                "3-cols" => __("3 columns", 'elessi-theme'),
                "2-cols" => __("2 columns", 'elessi-theme'),
            )
        );
        
        $of_options[] = array(
            "name" => __("Columns Related | You may also like&hellip; for Tablet", 'elessi-theme'),
            "id" => "relate_columns_tablet",
            "std" => "3-cols",
            "type" => "select",
            "options" => array(
                "4-cols" => __("4 columns", 'elessi-theme'),
                "3-cols" => __("3 columns", 'elessi-theme'),
                "2-cols" => __("2 columns", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Columns Related | You may also like&hellip; for Mobile", 'elessi-theme'),
            "id" => "relate_columns_small",
            "std" => "2-cols",
            "type" => "select",
            "options" => array(
                "2-cols" => __("2 columns", 'elessi-theme'),
                "1.5-cols" => __("1.5 column", 'elessi-theme'),
                "1-col" => __("1 column", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Auto Slide - Related | You may also like&hellip;", 'elessi-theme'),
            "id" => "relate_slide_auto",
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Infinite Slide", 'elessi-theme'),
            "id" => "relate_slide_loop",
             "std" => 0,
            "type" => "switch"
        );
        
        $of_options = apply_filters('nasa_theme_opts_single_product_page', $of_options);
    }
}
