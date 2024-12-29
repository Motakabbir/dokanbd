<?php
add_action('init', 'elessi_product_global_heading');
if (!function_exists('elessi_product_global_heading')) {
    function elessi_product_global_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Product Global Options", 'elessi-theme'),
            "target" => 'product-global',
            "type" => "heading",
        );
        
        $of_options[] = array(
            "name" => __("Grid Products - Options", 'elessi-theme'),
            "std" => "<h4>" . __("Grid Products - Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        // Loop Group Buttons layout
        $of_options[] = array(
            "name" => __("Product Card Styles", 'elessi-theme'),
            "id" => "loop_layout_buttons",
            "std" => "ver-buttons",
            "type" => "images",
            "options" => array(
                'ver-buttons'   => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-df.jpg',
                'hoz-buttons'   => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-df-2.jpg',
                'modern-1'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-1.jpg',
                'modern-2'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-2.jpg',
                'modern-3'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-3.jpg',
                'modern-4'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-4.jpg',
                'modern-5'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-5.jpg',
                'modern-6'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-6.jpg',
                'modern-7'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-7.jpg',
                'modern-8'      => ELESSI_ADMIN_DIR_URI . 'assets/images/loop-product-md-8.jpg',
            ),
            'class' => 'flex-row flex-wrap flex-start img-max-height-150'
        );
        
        $of_options[] = array(
            "name" => __("Hover - Product Card Styles - Effect", 'elessi-theme'),
            "id" => "animated_products",
            "std" => "hover-fade",
            "type" => "select",
            "options" => array(
                "hover-fade" => __("Fade", 'elessi-theme'),
                "hover-zoom" => __("Zoom", 'elessi-theme'),
                "hover-to-top" => __("Move To Top", 'elessi-theme'),
                "hover-flip" => __("Flip Horizontal", 'elessi-theme'),
                "hover-bottom-to-top" => __("Bottom To Top", 'elessi-theme'),
                "hover-top-to-bottom" => __("Top To Bottom", 'elessi-theme'),
                "hover-left-to-right" => __("Left To Right", 'elessi-theme'),
                "hover-right-to-left" => __("Right To Left", 'elessi-theme'),
                "hover-carousel" => __("Gallery - Carousel", 'elessi-theme'),
                "" => __("No Effect", 'elessi-theme')
            )
        );

        $of_options[] = array(
            "name" => __("Product Spacing", 'elessi-theme'),
            "id" => "global_product_spacing",
            "std" => "medium_spacing",
            "type" => "select",
            'options' => array(
                'small_spacing' => __('Small Spacing', 'elessi-theme'),
                'medium_spacing' => __('Medium Spacing', 'elessi-theme'),
                'large_spacing' => __('Large Spacing', 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Back Image in Mobile Layout", 'elessi-theme'),
            "id" => "mobile_back_image",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Backorder Allowed Badge", 'elessi-theme'),
            "id" => "backorder_badge",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Display product Categories", 'elessi-theme'),
            "id" => "loop_categories",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Display product SKU", 'elessi-theme'),
            "id" => "loop_sku",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Show Title In Line", 'elessi-theme'),
            "id" => "cutting_product_name",
            "desc" => __("Only show title product on one line if it is too long.", 'elessi-theme'),
            "std" => "1",
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Catalog Mode - Disable Add To Cart Feature", 'elessi-theme'),
            "id" => "disable-cart",
            "std" => "0",
            "type" => "switch",
            "desc" => __('Your website will just be a product introduction website.', 'elessi-theme'),
        );
        
        $of_options[] = array(
            "name" => __("Add To Cart in Grid", 'elessi-theme'),
            "id" => "loop_add_to_cart",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Icon Add To Cart in Grid", 'elessi-theme'),
            "id" => "cart-icon-grid",
            "std" => "1",
            "type" => "images",
            "options" => array(
                // fa fa-plus - default
                '1' => ELESSI_ADMIN_DIR_URI . 'assets/images/cart-plus.jpg',
                // icon-nasa-cart-3
                '2' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-1.jpg',
                // icon-nasa-cart-2
                '3' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-2.jpg',
                // icon-nasa-cart-4
                '4' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-3.jpg',
                // pe-7s-cart
                '5' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-4.jpg',
                // fa fa-shopping-cart
                '6' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-5.jpg',
                // fa fa-shopping-bag
                '7' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-6.jpg',
                // fa fa-shopping-basket
                '8' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-7.jpg'
            )
        );
        
        if (defined('YITH_WCPB')) {
            // Enable Gift in grid
            $of_options[] = array(
                "name" => __("Enable Promotion Gifts featured icon", 'elessi-theme'),
                "id" => "enable_gift_featured",
                "std" => 1,
                "type" => "switch"
            );
        }
        
        $of_options[] = array(
            "name" => __("Mini Cart - Options", 'elessi-theme'),
            "std" => "<h4>" . __("Mini Cart - Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Icon Mini Cart in Header", 'elessi-theme'),
            "id" => "mini-cart-icon",
            "std" => "1",
            "type" => "images",
            "options" => array(
                // icon-nasa-cart-3 - default
                '1' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-1.jpg',
                // icon-nasa-cart-2
                '2' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-2.jpg',
                // icon-nasa-cart-4
                '3' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-3.jpg',
                // pe-7s-cart
                '4' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-4.jpg',
                // fa fa-shopping-cart
                '5' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-5.jpg',
                // fa fa-shopping-bag
                '6' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-6.jpg',
                // fa fa-shopping-basket
                '7' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-7.jpg'
            )
        );
        
        $of_options[] = array(
            "name" => __("Event After Add to Cart", 'elessi-theme'),
            "id" => "event-after-add-to-cart",
            "std" => "sidebar",
            "type" => "select",
            "options" => array(
                "sidebar" => __("Open Cart Sidebar", 'elessi-theme'),
                "popup" => __("Popup Your Order v1 - Not use with Mobile App Simulation", 'elessi-theme'),
                "popup_2" => __("Popup Your Order v2 - Not use with Mobile App Simulation", 'elessi-theme'),
                "notice" => __("Show Notice", 'elessi-theme'),
            ),
            // 'class' => 'nasa-theme-option-parent'
        );
        
        $of_options[] = array(
            "name" => "Preload - Add to Cart",
            "id" => "ns_preload_mcart",
            "std" => "1",
            "type" => "switch",
            'child_of' => 'event-after-add-to-cart',
            'm_target' => array('sidebar'),
        );
        
        $of_options[] = array(
            "name" => __("Mini Cart - You may be interested in…", 'elessi-theme'),
            "id" => "mini_cart_crsells",
            "std" => "0",
            "type" => "switch",
            'desc' => __("Note: This feature does not apply to mobiles or devices with small screens", 'elessi-theme')
        );

        if ('yes' === get_option('woocommerce_enable_ajax_add_to_cart')) {
            $of_options[] = array(
                "name" => __("Mini Cart - Change variation in mini cart", 'elessi-theme'),
                "id" => "mini_cart_change_variation_product",
                "std" => "0",
                "type" => "switch"
            );
        }
        
        $of_options[] = array(
            "name" => __("Mini Cart - Note", 'elessi-theme'),
            "id" => "mini_cart_note",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Mini Cart - Shipping", 'elessi-theme'),
            "id" => "mini_cart_shipping",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Mini Cart - Coupon", 'elessi-theme'),
            "id" => "mini_cart_coupon",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Public Coupons - Mini Cart (one per line)", 'elessi-theme'),
            "desc" => 'Please input the coupon code you want to publish in Mini Cart Sidebar (one per line).',
            "id" => "mini_cart_p_coupon",
            "std" => '',
            "type" => "textarea",
            'child_of' => 'mini_cart_coupon',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Quantity Input - Mini Cart", 'elessi-theme'),
            "id" => "mini_cart_qty",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Subtotal for Item - Mini Cart", 'elessi-theme'),
            "id" => "mini_cart_subtotal",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Cart Sidebar Layout", 'elessi-theme'),
            "id" => "style-cart",
            "std" => "style-1",
            "type" => "select",
            "options" => array(
                'style-1' => __('Light', 'elessi-theme'),
                'style-2' => __('Dark', 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Addon Options", 'elessi-theme'),
            "std" => "<h4>" . __("Addon Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        if (class_exists('WooCommerce_Advanced_Free_Shipping')) {
            $of_options[] = array(
                "name" => __("Free Shipping Bar - WooCommerce Advanced Free Shipping", 'elessi-theme'),
                "id" => "free_shipbar",
                "std" => "1",
                "type" => "switch"
            );
            
            $of_options[] = array(
                "name" => __("Reach Free Shipping Effect - WooCommerce Advanced Free Shipping", 'elessi-theme'),
                "id" => "free_shipping_effect",
                "std" => "0",
                "type" => "switch"
            );
        }
        
        $of_options[] = array(
            "name" => __("Compact Number - Cart, Wishlist, Compare (9+)", 'elessi-theme'),
            "id" => "compact_number",
            "std" => "1",
            "type" => "switch",
            "desc" => __('Automatically displays 9+ if the number is greater than or equal to 10', 'elessi-theme')
        );
        
        $of_options[] = array(
            "name" => __("Top Filter Categories", 'elessi-theme'),
            "id" => "show_icon_cat_top",
            "std" => "show-in-shop",
            "type" => "select",
            "options" => array(
                'show-in-shop' => __('On Archive Product Pages', 'elessi-theme'),
                'show-all-site' => __('On All Pages', 'elessi-theme'),
                'not-show' => __('Off', 'elessi-theme'),
            ),
            "img_desc" => ELESSI_ADMIN_DIR_URI . 'assets/images/icon_cat_top.jpg',
            'class' => 'img-fit-size'
        );
        
        $of_options[] = array(
            "name" => __("Max Depth Level - Top Filter Categories", 'elessi-theme'),
            "id" => "depth_cat_top",
            "std" => "0",
            "type" => "select",
            "options" => array(
                '0' => __('Unlimited', 'elessi-theme'),
                '1' => __('1 Level', 'elessi-theme'),
                '2' => __('2 Levels', 'elessi-theme'),
                '3' => __('3 Levels', 'elessi-theme')
            ),
            'override_numberic' => true
        );
        
        $of_options[] = array(
            "name" => __("Order by - Top Filter Categories", 'elessi-theme'),
            "id" => "order_cat_top",
            "std" => "name",
            "type" => "select",
            "options" => array(
                'order' => __('Category Order', 'elessi-theme'),
                'name' => __('Name', 'elessi-theme')
            )
        );
        
        // Hide categories empty product
        $of_options[] = array(
            "name" => __("Hide categories empty product - Top Filter Categories", 'elessi-theme'),
            "id" => "hide_empty_cat_top",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Disable top level of categories follow current category archive (Use for Multi stores)", 'elessi-theme'),
            "desc" => __("Yes, Please!", 'elessi-theme'),
            "id" => "disable_top_level_cat",
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => __("Uncategorized Product", 'elessi-theme'),
            "id" => "show_uncategorized",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Disable - Progress Bar loading ajax", 'elessi-theme'),
            "id" => "disable_ajax_product_progress_bar",
            // "desc" => __("Yes, Please!", 'elessi-theme'),
            "on" => __("Yes", 'elessi-theme'),
            "off" => __("No", 'elessi-theme'),
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Badge - Options", 'elessi-theme'),
            "std" => "<h4>" . __("Badge - Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __('New Badge - Automatically add Badge "NEW" for new products', 'elessi-theme'),
            "id" => "at_badge_new",
            // "desc" => __("Yes, Please!", 'elessi-theme'),
            "std" => "0",
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __('Maximum time to maintain Badge "NEW" for newly published products', 'nasa-core'),
            "id" => "max_ns_time_at_badge_new",
            "std" => "10",
            "type" => "text",
            "desc" => "Time is measured in days (Ex:10 = 10 days)",
            'child_of' => 'at_badge_new',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Featured Badge", 'elessi-theme'),
            "id" => "featured_badge",
            "std" => "0",
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Shopping Cart - Options", 'elessi-theme'),
            "std" => "<h4>" . __("Shopping Cart - Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Auto Update - Cart Page", 'elessi-theme'),
            "id" => "auto_update_cart",
            "std" => "0",
            "type" => "switch"
        );
        
        /**
         * Fake Time Limited Countdown Checkout
         */
        $of_options[] = array(
            "name" => __("Cart Countdown Timer", 'nasa-core'),
            "id" => "ns_time_limited_checkout",
            "std" => 0,
            "type" => "switch",
            "img_desc" => ELESSI_ADMIN_DIR_URI . 'assets/images/fake_limited_in_cart.png',
            "desc" => '<span class="ns-opt-notices">Be careful when using this feature, when you turn this feature on you will set a countdown time.<br /> When the customer enters the cart page it will start the countdown and when the countdown ends it will delete all products in the cart.</span>'
        );
    
        $of_options[] = array(
            "name" => __("Min - Time Limited Countdown Checkout (s)", 'nasa-core'),
            "id" => "min_ns_time_limited_checkout",
            "std" => "300",
            "type" => "text",
            "desc" => "Time is measured in seconds (Ex:5m = 300s)",
            'child_of' => 'ns_time_limited_checkout',
            'm_target' => '1',
        );
    
        $of_options[] = array(
            "name" => __("Max - Time Limited Countdown Checkout (s)", 'nasa-core'),
            "id" => "max_ns_time_limited_checkout",
            "std" => "600",
            "type" => "text",
            "desc" => "Time is measured in seconds (Ex:10m = 600s)",
            'child_of' => 'ns_time_limited_checkout',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Checkout - Options", 'elessi-theme'),
            "std" => "<h4>" . __("Checkout - Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Checkout Layout", 'elessi-theme'),
            "id" => "checkout_layout",
            "std" => "",
            "type" => "select",
            "options" => array(
                '' => __('Default', 'elessi-theme'),
                'modern' => __('Modern - No Header, No Footer', 'elessi-theme')
            ),
            //  'class' => 'nasa-theme-option-parent'
        );
        
        // Only show one Shipping Method in Cart
        $of_options[] = array(
            "name" => __("Only Show one Shipping Method in Cart Page", 'elessi-theme'),
            "id" => "cart_1_shiping",
            "std" => "1",
            "type" => "switch",
            // 'class' => 'nasa-checkout_layout nasa-checkout_layout-modern nasa-theme-option-child'
            'child_of' => 'checkout_layout',
            'm_target' => 'modern',
        );
        
        $of_options[] = array(
            "name" => __("Quantity Input - Checkout Page", 'elessi-theme'),
            "id" => "mini_checkout_qty",
            "std" => "0",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Image Product - Checkout Page", 'elessi-theme'),
            "id" => "mini_checkout_img",
            "std" => "1",
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Quickview Options", 'elessi-theme'),
            "std" => "<h4>" . __("Quickview Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Disable Quick View", 'elessi-theme'),
            "id" => "disable-quickview",
            "on" => __("Yes", 'elessi-theme'),
            "off" => __("No", 'elessi-theme'),
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Select Options button to Quickview", 'elessi-theme'),
            "id" => "slc_ops_qv",
            "std" => "1",
            "type" => "switch",
        );
        
        $of_options[] = array(
            "name" => __("Quickview Layout", 'elessi-theme'),
            "id" => "style_quickview",
            "std" => "sidebar",
            "type" => "select",
            "options" => array(
                'popup' => __('Popup Classical - Not use with Mobile App Simulation', 'elessi-theme'),
                'sidebar' => __('Off-Canvas', 'elessi-theme')
            ),
            
            // 'class' => 'nasa-theme-option-parent',
        );
        
        $of_options[] = array(
            "name" => __("Number Show Quickview Thumbnail", 'elessi-theme'),
            "id" => "quick_view_item_thumb",
            "std" => "1-item",
            "type" => "select",
            "options" => array(
                '1-item' => __('Single Thumbnail', 'elessi-theme'),
                '2-items' => __('Double Thumbnails', 'elessi-theme')
            ),
            'child_of' => 'style_quickview',
            'm_target' => 'sidebar',
            // 'class' => 'nasa-style_quickview nasa-style_quickview-sidebar nasa-theme-option-child'
        );

        $of_options[] = array(
            "name" => __("Infinite Slide In Quickview", 'elessi-theme'),
            "id" => "loop_quickview",
            "std" => "0",
            "type" => "switch",
        );
        
        $of_options[] = array(
            "name" => __("Cross-Sells Products", 'elessi-theme'),
            "std" => "<h4>" . __("You may be interested in&hellip;", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => __("Columns", 'elessi-theme'),
            "id" => "crs_columns_desk",
            "std" => "5-cols",
            "type" => "select",
            "options" => array(
                "5-cols" => __("5 columns", 'elessi-theme'),
                "4-cols" => __("4 columns", 'elessi-theme'),
                "3-cols" => __("3 columns", 'elessi-theme'),
            )
        );
        
        $of_options[] = array(
            "name" => __("Tablet Columns", 'elessi-theme'),
            "id" => "crs_columns_tablet",
            "std" => "3-cols",
            "type" => "select",
            "options" => array(
                "4-cols" => __("4 columns", 'elessi-theme'),
                "3-cols" => __("3 columns", 'elessi-theme'),
                "2-cols" => __("2 columns", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Mobile Columns", 'elessi-theme'),
            "id" => "crs_columns_small",
            "std" => "2-cols",
            "type" => "select",
            "options" => array(
                "2-cols" => __("2 columns", 'elessi-theme'),
                "1.5-cols" => __("1.5 column", 'elessi-theme'),
                "1-col" => __("1 column", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => __("Auto Slide", 'elessi-theme'),
            "id" => "crs_slide_auto",
            "std" => 0,
            "type" => "switch"
        );

        $of_options[] = array(
            "name" => __("Infinite Slide", 'elessi-theme'),
            "id" => "crs_slide_loop",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options = apply_filters('nasa_theme_opts_glb_product', $of_options);
    }
}
