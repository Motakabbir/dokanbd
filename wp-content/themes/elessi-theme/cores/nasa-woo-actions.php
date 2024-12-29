<?php
defined('ABSPATH') or die(); // Exit if accessed directly
/**
 * Disable default Yith Woo wishlist button
 */
if (NASA_WISHLIST_ENABLE && function_exists('YITH_WCWL_Frontend')) {
    remove_action('init', array(YITH_WCWL_Frontend(), 'add_button'));
}

/**
 * Remove action woocommerce
 */
add_action('init', 'elessi_remove_action_woo');
if (!function_exists('elessi_remove_action_woo')) :
    function elessi_remove_action_woo() {
        if (!NASA_WOO_ACTIVED) {
            return;
        }
        
        global $nasa_opt, $yith_woocompare;
        
        /**
         * UNREGISTRER DEFAULT WOOCOMMERCE HOOKS
         */
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_show_messages', 10);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
        
        remove_action('woocommerce_single_product_summary', 'woocommerce_breadcrumb', 20);
        // remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        
        if (!isset($nasa_opt['pmeta_info']) || $nasa_opt['pmeta_info'] !== 'df') {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        }
        
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
        
        if (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart']) {
            // remove_action('woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30);
            remove_action('woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30);
            remove_action('woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30);
        }
        
        remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
        remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);

        remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
        
        /**
         * Remove compare default
         */
        if ($yith_woocompare) {
            $nasa_compare = isset($yith_woocompare->obj) ? $yith_woocompare->obj : $yith_woocompare;
            if ($nasa_compare instanceof YITH_Woocompare_Frontend) {
                /**
                 * Compatible Yith WooCommerce Compare 2.30.1
                 */
                if (isset($nasa_compare->version) && version_compare($nasa_compare->version, '2.30.1', '>=')) {
                    remove_action('init', array($nasa_compare, 'display_compare_button'), 20);
                } else {
                    remove_action('woocommerce_after_shop_loop_item', array($nasa_compare, 'add_compare_link'), 20);
                    remove_action('woocommerce_single_product_summary', array($nasa_compare, 'add_compare_link'), 35);
                }
            }
        }
        
        /**
         * For content-product
         */
        remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail');
        remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title');
        
        if (NASA_ELEMENTOR_ACTIVE) {
            // Loop Price
            remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
            // Loop Rating
            remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
        }
        
        /**
         * Shop page
         */
        remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
        remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
        
        /**
         * Mini Cart
         */
        remove_action('woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10);
        
        /**
         * Remove Related | Up-sell Products
         */
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
        
        /**
         * Remove product Thumbnail Mobile layout Modern
         */
        if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) {
            if (isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app') {
                remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
            }
        }
        
        /**
         * Remove Empty Cart Default Woo
         */
        remove_action('woocommerce_cart_is_empty', 'wc_empty_cart_message', 10);
    }
endif;

/**
 * Add action woocommerce
 */
add_action('init', 'elessi_add_action_woo');
if (!function_exists('elessi_add_action_woo')) :
    function elessi_add_action_woo() {
        if (!NASA_WOO_ACTIVED) {
            return;
        }
        
        global $nasa_opt, $nasa_loadmore_style;
        
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        $mobile_app = $in_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app' ? true : false;
        
        add_action('nasa_child_cat', 'elessi_get_childs_category', 10, 2);
        
        /**
         * Mini Cart considered a Cart page if the incoming call is AJAX
         */
        // add_action('woocommerce_before_mini_cart', 'elessi_mini_cart_as_cart_page');
        
        /**
         * Results count in shop page
         */
        $disable_ajax_product = (isset($nasa_opt['disable_ajax_product']) && $nasa_opt['disable_ajax_product']) ? true : false;
        
        $pagination_style = isset($nasa_opt['pagination_style']) ? $nasa_opt['pagination_style'] : 'style-2';
        
        if (isset($_REQUEST['paging-style']) && in_array($_REQUEST['paging-style'], $nasa_loadmore_style)) {
            $pagination_style = $_REQUEST['paging-style'];
        }
        
        if ($disable_ajax_product) {
            $pagination_style = $pagination_style == 'style-2' ? 'style-2' : 'style-1';
        } else {
            add_action('woocommerce_before_main_content', 'elessi_open_woo_main');
            add_action('woocommerce_after_main_content', 'elessi_close_woo_main');
        }
        
        if (in_array($pagination_style, $nasa_loadmore_style)) {
            add_action('nasa_shop_category_count', 'elessi_result_count', 20);
        } else {
            add_action('nasa_shop_category_count', 'woocommerce_result_count', 20);
        }
        
        add_action('woocommerce_archive_description', 'elessi_before_archive_description', 1);
        add_action('woocommerce_archive_description', 'elessi_get_cat_top', 5);
        add_action('woocommerce_archive_description', 'elessi_after_archive_description', 999);
        
        add_filter('woocommerce_taxonomy_archive_description_raw', 'elessi_add_wrap_archive_desc');
        
        add_action('woocommerce_after_shop_loop', 'elessi_get_cat_bottom', 1000);
        
        add_action('nasa_change_view', 'elessi_nasa_change_view', 10, 1);

        add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');
        // add_action('woocommerce_mini_cart_contents', 'woocommerce_cross_sell_display');
        add_action('popup_woocommerce_after_cart', 'woocommerce_cross_sell_display');
        add_action('popup_woocommerce_before_cart','elessi_hook_column_crs_popup');
        
        if (isset($nasa_opt['mini_cart_crsells']) && $nasa_opt['mini_cart_crsells']) {
            // remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
            // remove_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 10);
            // add_action('nasa_mini_cart_before_total', 'woocommerce_cross_sell_display', 1);
            add_action('woocommerce_mini_cart_contents', 'woocommerce_cross_sell_display', 1);
        } 

        add_action('nasa_mini_cart_before_total', 'elessi_ext_mini_cart', 5);
        
        add_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_loop_rating', 10);
        add_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_price', 15);
        add_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_excerpt', 20);
        
        /**
         * Deal time for Quickview product
         */
        if (!isset($nasa_opt['single-product-deal']) || $nasa_opt['single-product-deal']) {
            add_action('woocommerce_single_product_lightbox_summary', 'elessi_deal_time_quickview', 29);
            add_filter('woocommerce_available_variation', 'elessi_variation_deal_time');
        }
        
        // if (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart']) {
        //      add_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_add_to_cart', 30);
        // }
        add_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_add_to_cart', 30);
        
        add_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_meta', 40);
        add_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_sharing', 50);
        
        add_action('nasa_single_product_layout', 'elessi_single_product_layout', 1);
        
        /**
         * Single Product WooCommerce Tabs
         */
        if (!isset($nasa_opt['pmeta_info']) || $nasa_opt['pmeta_info'] !== 'df') {
            add_action('woocommerce_after_single_product_summary', 'elessi_clearboth', 11);
            add_action('woocommerce_after_single_product_summary', 'elessi_open_wrap_12_cols', 11);
            add_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 11);
            add_action('woocommerce_after_single_product_summary', 'elessi_close_wrap_12_cols', 11);
        }
        
        add_action('woocommerce_single_product_summary', 'elessi_next_prev_single_product', 6);

        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15);
        
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 25);
        
        /**
         * For Mobile App
         */
        if ($mobile_app) {
            add_action('woocommerce_single_product_summary', 'elessi_begin_wrap', 4);
            add_action('woocommerce_single_product_summary', 'elessi_end_wrap', 21);
            
            add_action('woocommerce_before_variations_form', 'elessi_open_variants_wrap', 1);
            add_action('woocommerce_after_variations_form', 'elessi_close_variants_wrap', 999);
        }
        
        /**
         * Deal time for Single product
         */
        if (!isset($nasa_opt['single-product-deal']) || $nasa_opt['single-product-deal']) {
            add_action('woocommerce_single_product_summary', 'elessi_deal_time_single', 29);
        }
        
        /**
         * Add WooCommerce Share
         */
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 39);
        
        /**
         * Add Up-sell Products
         */
        add_action('nasa_single_product_layout', 'woocommerce_upsell_display', 15);
        
        /**
         * Add Related Products
         */
        if (!isset($nasa_opt['relate_product']) || $nasa_opt['relate_product']) {
            add_action('nasa_single_product_layout', 'woocommerce_output_related_products', 20);
        }
        
        /**
         * Remove heading Description tab
         */
        add_filter('woocommerce_product_description_heading', '__return_false');
        
        /**
         * Add compare product
         */
        if ($mobile_app) {
            add_action('woocommerce_single_product_summary', 'elessi_add_compare_in_detail', 32);
        } else {
            add_action('nasa_single_buttons', 'elessi_add_compare_in_detail', 20);
        }
        
        if (get_option('yith_woocompare_compare_button_in_products_list') == 'yes') {
            add_action('nasa_show_buttons_loop', 'elessi_add_compare_in_list', 50);
        }
        
        /**
         * Single Product Ajax Call
         */
        add_action('woocommerce_after_single_product', 'elessi_ajax_single_product_tag');
        
        /**
         * Add to Cart in list - Loop
         */
        add_filter('woocommerce_loop_add_to_cart_args', 'elessi_loop_add_to_cart_args', 10, 2);
        
        if (
            (!isset($nasa_opt['loop_add_to_cart']) || $nasa_opt['loop_add_to_cart']) &&
            (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart'])
        ) {
            add_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 10);
        }
        
        /**
         * Classes Product Loop item - info
         */
        add_filter('ns_product_info_wrap_classes', 'elessi_product_info_wrap_classes');
        
        /**
         * Wishlist in loop
         */
        add_action('nasa_show_buttons_loop', 'elessi_add_wishlist_in_list', 20);
        
        /**
         * Quick view in loop
         */
        if (!isset($nasa_opt['disable-quickview']) || !$nasa_opt['disable-quickview']) {
            add_action('nasa_show_buttons_loop', 'elessi_quickview_in_list', 40);
        }
        
        /**
         * Notice in Archive Products Page | Single Product Page
         */
        add_action('woocommerce_before_main_content', 'woocommerce_output_all_notices', 10);
        
        /**
         * Nasa ADD BUTTON BUY NOW
         */
        add_action('woocommerce_after_add_to_cart_button', 'elessi_add_buy_now_btn');
        
        /**
         * Nasa Add Custom fields
         */
        add_action('woocommerce_after_add_to_cart_button', 'elessi_add_custom_field_detail_product', 25);
        
        /**
         * Nasa top_sidebar_shop
         */
        add_action('nasa_top_sidebar_shop', 'elessi_top_sidebar_shop', 10, 1);
        add_action('nasa_sidebar_shop', 'elessi_side_sidebar_shop', 10 , 1);
        
        /**
         * For Product content
         */
        add_action('woocommerce_before_shop_loop_item_title', 'elessi_loop_countdown');
        
        /**
         * Custom filters woocommerce_post_class
         */
        add_filter('woocommerce_post_class', 'elessi_custom_woocommerce_post_class', 10, 2);
        
        add_action('nasa_get_content_products', 'elessi_get_content_products', 10, 1);
        add_action('woocommerce_before_shop_loop_item_title', 'elessi_loop_product_content_btns', 15);
        add_action('woocommerce_before_shop_loop_item_title', 'elessi_gift_featured', 15);
        add_action('woocommerce_before_shop_loop_item_title', 'elessi_loop_product_content_thumbnail', 20);
        
        add_action('woocommerce_after_shop_loop_item', 'elessi_content_show_in_list');
        
        add_action('woocommerce_shop_loop_item_title', 'elessi_loop_product_cats', 5);
        add_action('woocommerce_shop_loop_item_title', 'elessi_loop_product_sku', 9);
        add_action('woocommerce_shop_loop_item_title', 'elessi_loop_product_content_title', 10);
        add_action('woocommerce_after_shop_loop_item_title', 'elessi_loop_product_description', 15, 1);
        
        if (NASA_ELEMENTOR_ACTIVE) {
            // Loop Price
            add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
            // Loop Rating
            add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
        }
        
        /**
         * Add to wishlist in Single Product
         */
        if ($mobile_app) {
            add_action('woocommerce_single_product_summary', 'elessi_begin_wrap_flex', 30);
            add_action('woocommerce_single_product_summary', 'elessi_end_wrap', 33);
            add_action('woocommerce_single_product_summary', 'elessi_add_wishlist_in_detail_with_label', 31);
        } else {
            add_action('nasa_single_buttons', 'elessi_add_wishlist_in_detail', 15);
        }
        
        /**
         * Hide Uncategorized
         */
        if (!isset($nasa_opt['show_uncategorized']) || !$nasa_opt['show_uncategorized']) {
            add_filter('woocommerce_product_subcategories_args', 'elessi_hide_uncategorized');
        }
        
        /**
         * Share icon in Single Product
         */
        if (!isset($nasa_opt['ns_share_spp']) || $nasa_opt['ns_share_spp']) {
            add_action('woocommerce_share', 'elessi_before_woocommerce_share', 5);
            add_action('woocommerce_share', 'elessi_woocommerce_share', 10);
            add_action('woocommerce_share', 'elessi_after_woocommerce_share', 15);
        }
        
        /**
         * Mini Cart
         */
        add_action('woocommerce_widget_shopping_cart_total', 'elessi_widget_shopping_cart_subtotal', 10);
        add_action('woocommerce_widget_shopping_cart_total', 'elessi_widget_shopping_cart_ext', 15);
        
        /**
         * Fix missing - widget_shopping_cart_content
         */
        add_filter('woocommerce_add_to_cart_fragments', 'elessi_add_widget_shopping_cart_content', 9999);

        /**
         * Add Empty Cart Default Nasa-theme
         */
        add_action('woocommerce_cart_is_empty', 'nasa_empty_cart_message', 10);
        
        /**
         * Add Popup Your order to fragments
         */
        // add_filter('woocommerce_add_to_cart_fragments', 'elessi_popup_your_orderfragments', 9999);
        
        /**
         * Add src image large for variation
         */
        add_filter('woocommerce_available_variation', 'elessi_src_large_image_single_product');
        
        /**
         * Add class Sub Categories
         */
        add_filter('product_cat_class', 'elessi_add_class_sub_categories');
        
        /**
         * Filter redirect checkout buy now
         */
        add_filter('woocommerce_add_to_cart_redirect', 'elessi_buy_now_to_checkout');
        
        /**
         * Filter Single Stock
         */
        if (!isset($nasa_opt['enable_progess_stock']) || $nasa_opt['enable_progess_stock']) {
            add_filter('woocommerce_get_stock_html', 'elessi_single_stock', 10, 2);
        }
        
        /**
         * Disable redirect Search one product to single product
         */
        add_filter('woocommerce_redirect_single_search_result', '__return_false');
        
        /**
         * Custom Tabs in Single product
         */
        add_filter('woocommerce_product_tabs', 'elessi_custom_tabs_single_product');
        
        /**
         * Checkout - Layout
         */
        add_action('nasa_checkout_form_layout', 'elessi_checkout_form_layout', 10, 1);
        
        /**
         * Actions for Checkout Modern
         */
        if (defined('NASA_CHECKOUT_LAYOUT') && NASA_CHECKOUT_LAYOUT == 'modern') {
            add_filter('woocommerce_update_order_review_fragments', 'elessi_update_order_review_fragments');
            add_filter('woocommerce_checkout_fields', 'elessi_checkout_email_first');
            
            add_action('woocommerce_checkout_after_customer_details', 'elessi_step_billing', 15);
            
            add_action('woocommerce_checkout_after_customer_details', 'elessi_checkout_shipping', 20);
            
            remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
            
            add_action('woocommerce_review_order_before_payment', 'elessi_checkout_payment_open', 5);
            add_action('woocommerce_review_order_before_payment', 'elessi_checkout_payment_headling');
            add_action('woocommerce_checkout_after_customer_details', 'woocommerce_checkout_payment', 25);
            add_action('woocommerce_review_order_after_payment', 'elessi_checkout_payment_close', 100);
            
            if (function_exists('woocommerce_gzd_template_order_submit')) {
                remove_action('woocommerce_checkout_order_review', 'woocommerce_gzd_template_order_submit', 21);
                add_action('woocommerce_review_order_after_payment', 'woocommerce_gzd_template_order_submit', 95);
            }
            
            /**
             * Case Shipping Address First
             */
            if ('shipping' === get_option('woocommerce_ship_to_destination') && !NASA_CORE_IN_ADMIN) {
                add_action('woocommerce_review_order_before_payment', 'elessi_checkout_modern_billing_detail', 4);
                add_filter('woocommerce_shipping_fields', 'elessi_checkout_add_shipping_phone');
                add_filter('woocommerce_checkout_posted_data', 'elessi_checkout_modern_posted_data');
            }
            
            // remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10);
            add_action('woocommerce_review_order_after_cart_contents', 'elessi_checkout_coupon_form_clone');
        }
        
        /**
         * Fixed Address_2 => undefined
         */
        add_filter('woocommerce_formatted_address_replacements', 'elessi_fixed_address_2_undefined');
        
        /**
         * woocommerce_form_field_args
         */
        add_filter('woocommerce_form_field_args', 'elessi_wc_form_field_args');


        /**
         * Remove Attributes in Product Name
         */
        if (isset($nasa_opt['mini_cart_change_variation_product']) && $nasa_opt['mini_cart_change_variation_product'] && 'yes' === get_option('woocommerce_enable_ajax_add_to_cart')) {
            add_filter('woocommerce_product_variation_title_include_attributes', '__return_false');
        }
    }
endif;

/**
 * Remove Single Product Meta Info
 */
add_action('template_redirect', 'elessi_rm_single_product_meta');
if (!function_exists('elessi_rm_single_product_meta')) :
    function elessi_rm_single_product_meta() {
        if (!NASA_WOO_ACTIVED) {
            return;
        }
        
        global $nasa_opt;
        
        if (isset($nasa_opt['pmeta_enb']) && !$nasa_opt['pmeta_enb']) {
            /**
             * Remove Meta in Quickview
             */
            remove_action('woocommerce_single_product_lightbox_summary', 'woocommerce_template_single_meta', 40);
            
            /**
             * Remove Meta in Single Product page
             */
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
            // remove_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 11);
            
            remove_action('woocommerce_after_single_product_summary', 'elessi_clearboth', 11);
            remove_action('woocommerce_after_single_product_summary', 'elessi_open_wrap_12_cols', 11);
            remove_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 11);
            remove_action('woocommerce_after_single_product_summary', 'elessi_close_wrap_12_cols', 11);
        }
    }
endif;

/**
 * 3rd Plugins - Compatible
 */
add_action('init', 'elessi_plg3rd_compatible_acts');
if (!function_exists('elessi_plg3rd_compatible_acts')) :
    function elessi_plg3rd_compatible_acts() {
        if (!NASA_WOO_ACTIVED) {
            return;
        }
        
        /**
         * Compatible with YITH WooCommerce Product Bundles - Mini Cart
         */
        if (function_exists('yith_wcpb_frontend')) {
            $yith_wcpb_frontend = yith_wcpb_frontend();
            
            if ($yith_wcpb_frontend) {
                add_filter('woocommerce_mini_cart_item_class', array($yith_wcpb_frontend, 'add_cart_item_class_for_bundles'), 10, 3);
            }
        }
        
        /**
         * Yith Woo Product Bundle in Loop
         */
        add_action('nasa_show_buttons_loop', 'elessi_bundle_in_list', 60);
        
        /**
         * Compatible with WC_Vendor plugin
         */
        if (class_exists('WCV_Vendor_Shop')) {
            if (has_action('woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9)) {
                remove_action('woocommerce_after_shop_loop_item', array('WCV_Vendor_Shop', 'template_loop_sold_by'), 9);
                add_action('woocommerce_after_shop_loop_item_title', 'elessi_wc_vendor_template_loop_sold_by');
            }
            
            if (has_action('woocommerce_product_meta_start', array('WCV_Vendor_Cart', 'sold_by_meta'))) {
                remove_action('woocommerce_product_meta_start', array('WCV_Vendor_Cart', 'sold_by_meta'));
                add_action('woocommerce_product_meta_start', 'elessi_wc_vendor_sold_by_meta');
            }
        }
        
        /**
         * Compatible - WOOF - WooCommerce Products Filter
         */
        if (function_exists('woof')) {
            $woof = woof();
            
            $show = isset($woof->settings['show_images_by_attr_show']) ? $woof->settings['show_images_by_attr_show'] : false;
            if ($show) {
                remove_action('woocommerce_before_shop_loop_item_title', 'elessi_loop_product_content_thumbnail', 20);
            }
        }
    
        /**
         * WC_germanized - Compatible
         */
        if (function_exists('WC_germanized')) {
            remove_action('woocommerce_after_shop_loop_item', 'woocommerce_gzd_template_loop_shipping_costs_info', 7);
            add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_gzd_template_loop_shipping_costs_info', 99);
        }
        
        /**
         * Compatible - Yith WooCommerce Request a Quote
         */
        if (isset($_REQUEST['wc-ajax']) && $_REQUEST['wc-ajax'] === 'nasa_quick_view' && function_exists('yith_ywraq_render_button')) {
            add_action('woocommerce_after_add_to_cart_button', 'yith_ywraq_render_button', 30);
	    }

        /**
         * Before Bundle Table - WPC Product Bundles for WooCommerce
         */
        add_action('woosb_before_table', 'elessi_woosb_before_wrap_content');
    }
endif;

/**
 * Filter Classess
 */
if (!function_exists('elessi_product_info_wrap_classes')) :
    function elessi_product_info_wrap_classes($classes) {
        global $nasa_opt;
    
        if ((isset($nasa_opt['loop_categories']) && $nasa_opt['loop_categories'])) {
            $classes .= ' has-cats';
        }
        
        return $classes;
    }
endif;

/**
 * Before Bundle Table - WPC Product Bundles for WooCommerce
 */
if (!function_exists('elessi_woosb_before_wrap_content')) :
    function elessi_woosb_before_wrap_content() {
        $svg = '<svg width="18" height="19" fill="none" viewBox="0 0 18 19"><path fill="currentColor" d="M17.4375 7.49219C17.8125 8.00781 18 8.59375 18 9.25s-.1875 1.2539-.5625 1.793c-.375.5156-.8555.8789-1.4414 1.0898.2578.5625.3281 1.1719.2109 1.8281-.0937.6329-.375 1.1836-.8437 1.6524-.4688.4687-1.0195.75-1.6524.8437-.6328.1172-1.2421.0469-1.8281-.2109-.1406.3984-.3516.7383-.6328 1.0195-.2812.3047-.6211.5391-1.0195.7032-.37503.1874-.78519.2812-1.2305.2812-.65625 0-1.25391-.1875-1.79297-.5625-.51562-.375-.87891-.8555-1.08984-1.4414-.58594.2578-1.19531.3281-1.82813.2109-.63281-.0937-1.18359-.375-1.65234-.8437-.46875-.4688-.76172-1.0195-.87891-1.6524-.09375-.6562-.01172-1.2656.2461-1.8281C1.41797 11.9219.9375 11.5586.5625 11.043.1875 10.5039 0 9.90625 0 9.25s.1875-1.24219.5625-1.75781c.375-.53906.85547-.91407 1.44141-1.125-.25782-.5625-.33985-1.16016-.2461-1.79297.11719-.65625.41016-1.21875.87891-1.6875.46875-.46875 1.01953-.75 1.65234-.84375.65625-.11719 1.26563-.04688 1.82813.21094.21093-.58594.57422-1.06641 1.08984-1.44141C7.74609.4375 8.34375.25 9 .25s1.2422.1875 1.7578.5625c.5391.375.9141.85547 1.125 1.44141.5625-.25782 1.1602-.32813 1.793-.21094.6562.09375 1.2187.375 1.6875.84375.4687.46875.75 1.03125.8437 1.6875.1172.63281.0469 1.23047-.2109 1.79297.5859.21093 1.0664.58594 1.4414 1.125zM7.52344 6.22656C7.3125 5.99219 7.05469 5.875 6.75 5.875s-.57422.11719-.80859.35156C5.73047 6.4375 5.625 6.69531 5.625 7s.10547.57422.31641.80859c.23437.21094.5039.31641.80859.31641s.5625-.10547.77344-.31641C7.75781 7.57422 7.875 7.30469 7.875 7s-.11719-.5625-.35156-.77344zm-.35156 6.04684l4.85152-4.85152c.2578-.25782.2578-.51563 0-.77344l-.4218-.42188c-.2578-.25781-.5157-.25781-.7735 0L5.97656 11.0781c-.25781.2578-.25781.5157 0 .7735l.42188.4218c.25781.2578.51562.2578.77344 0zm3.26952.0352c.2344.2109.5039.3164.8086.3164.3047 0 .5625-.1055.7734-.3164.2344-.2344.3516-.5039.3516-.8086 0-.3047-.1172-.5625-.3516-.7734-.2109-.2344-.4687-.3516-.7734-.3516-.3047 0-.5742.1172-.8086.3516-.2109.2109-.3164.4687-.3164.7734 0 .3047.1055.5742.3164.8086z" /></svg>';

        $html = '<div class="woosb-text nasa-bold primary-color nasa-before-woosb-tbl nasa-flex hidden-tag">' . $svg . esc_html__('Buy this bundle and get off to ${saved}', 'elessi-theme') . '</div>';
        
        echo $html;
    }
endif;

/**
 * Fix missing div.widget_shopping_cart_content in fragments
 */
if (!function_exists('elessi_add_widget_shopping_cart_content')) :
    function elessi_add_widget_shopping_cart_content($fragments) {
        global $nasa_opt;
        
        if (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart']) {
            return $fragments;
        }
        
        // Hook fix Missing fragments[div.widget_shopping_cart_content]
        if (!isset($fragments['div.widget_shopping_cart_content']) && apply_filters('ns_fix_missing_wscc', true)) {
            ob_start();
            woocommerce_mini_cart();
            $mini_cart = ob_get_clean();

            $fragments['div.widget_shopping_cart_content'] = '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>';
        }
        
        // Hook fix Missing fragments[.cart-inner]
        if (!isset($fragments['.cart-inner']) && apply_filters('ns_fix_missing_cart_inner', true)) {
            $fragments['.cart-inner'] = elessi_mini_cart(true);
        }
        
        return $fragments;
    }
endif;

 /**
 * Add Empty Cart Default Nasa-theme
 */
if (!function_exists('nasa_empty_cart_message')):
    function nasa_empty_cart_message() {
        $notice = wc_print_notice(
            wp_kses_post(
                /**
                 * Filter empty cart message text.
                 *
                 * @since 3.1.0
                 * @param string $message Default empty cart message.
                 * @return string
                 */
                apply_filters('wc_empty_cart_message', __('Your cart is currently empty.', 'elessi-theme'))
            ),
            'notice',
            array(),
            true
        );

        $icon_empty = elessi_mini_cart_icon();
        
        $search = array(
            'class="woocommerce-info"',
            __('Your cart is currently empty.', 'elessi-theme'),
        );
        
        $replace = array(
            'class="cart-empty woocommerce-info"',
            $icon_empty . __('Your cart is currently empty.', 'elessi-theme'),
        );

        $notice = str_replace($search, $replace, $notice);
        
        echo '<div class="wc-empty-cart-message nasa-empty-shopping-cart">' . $notice . '</div>';
    }
endif;

/**
 * Add Popup Your order to fragments
 */
if (!function_exists('elessi_popup_your_orderfragments')) :
    function elessi_popup_your_orderfragments($fragments) {
        if (!isset($fragments['div.nasa-after-add-to-cart-popup'])) {
            global $nasa_opt;
            
            if (!isset($nasa_opt['event-after-add-to-cart']) || $nasa_opt['event-after-add-to-cart'] != 'popup') {
                return $fragments;
            }
            
            $nasa_cart = WC()->cart;
            $cart_items = $nasa_cart->get_cart();
            
            /**
             * Empty items
             */
            if (empty($cart_items)) {
                $fragments['div.nasa-after-add-to-cart-popup'] = '';
            }
            
            $file = ELESSI_CHILD_PATH . '/includes/nasa-after-add-to-cart.php';
            $file = is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-after-add-to-cart.php';
            
            ob_start();
            include $file;
            
            $fragments['div.nasa-after-add-to-cart-popup'] = ob_get_clean();
            
            /**
             * Clear Old Notices
             */
            wc_clear_notices();
        }
        
        return $fragments;
    }
endif;

/**
 * Group buttons in content product grid
 */
add_action('template_redirect', 'elessi_before_ct_product_grid_btns', 15);
if (!function_exists('elessi_before_ct_product_grid_btns')) :
    function elessi_before_ct_product_grid_btns() {
        do_action('nasa_ct_product_grid_btns');
    }
endif;

/**
 * Check archive product
 */
add_action('template_redirect', 'elessi_check_shop_page');
if (!function_exists('elessi_check_shop_page')) :
    function elessi_check_shop_page() {
        if (NASA_WOO_ACTIVED && is_shop()) {
            add_action('nasa_after_breadcrumb', 'elessi_shop_after_breadcrumb');
        }
    }
endif;

/**
 * After Breadcrumb for archive
 */
if (!function_exists('elessi_shop_after_breadcrumb')) :
    function elessi_shop_after_breadcrumb() {
        global $nasa_opt;
        
        if (isset($nasa_opt['shop_brdc_blk']) && $nasa_opt['shop_brdc_blk']) {
            $do_content = elessi_get_block($nasa_opt['shop_brdc_blk']);
            
            if (trim($do_content) != '') {
                echo '<div class="nasa-archive-after-breadcrumb large-12 columns">';
                echo $do_content;
                echo '</div>';
            }
        }
    }
endif;

/**
 * Custom actions loop buttons in product card style - Grid
 */
add_action('popup_woocommerce_before_cart', 'elessi_ct_product_grid_btns');
add_action('nasa_ct_product_grid_btns', 'elessi_ct_product_grid_btns');
if (!function_exists('elessi_ct_product_grid_btns')) :
    function elessi_ct_product_grid_btns() {
        global $nasa_opt;

        if (isset($nasa_opt['loop_layout_buttons'])) {
            /**
             * Product Card Styles - [style 3 | modern-1]  [style 5 | modern-3]
             */
            if (in_array($nasa_opt['loop_layout_buttons'], array('modern-1', 'modern-5'))) {
            
                /**
                 * Wishlist in loop - Yith Wishlist
                 */
                remove_action('nasa_show_buttons_loop', 'elessi_add_wishlist_in_list', 20);
                add_action('nasa_before_show_buttons_loop', 'elessi_add_wishlist_in_list');

                /**
                 * Wishlist in loop - Nasa Wishlist
                 */
                $nasa_wl = function_exists('elessi_woo_wishlist') ? elessi_woo_wishlist() : null;
                if ($nasa_wl) {
                    remove_action('nasa_show_buttons_loop', array($nasa_wl, 'btn_in_list'), 20);
                    add_action('nasa_before_show_buttons_loop', array($nasa_wl, 'btn_in_list'));
                }
            }
            
            /**
             * Product Card Styles - style 4 | modern-2
             */
            if ($nasa_opt['loop_layout_buttons'] == 'modern-2') {
                remove_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 10);
                
                if (
                    (!isset($nasa_opt['loop_add_to_cart']) || $nasa_opt['loop_add_to_cart']) &&
                    (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart'])
                ) {
                    add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 100);
                    add_action('nasa_after_special_deal_simple_action', 'woocommerce_template_loop_add_to_cart', 100);
                }
            }
            
            /**
             * Product Card Styles - style 5 | modern-3
             */
            if ($nasa_opt['loop_layout_buttons'] == 'modern-3') {
                remove_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 10);
                
                if (
                    (!isset($nasa_opt['loop_add_to_cart']) || $nasa_opt['loop_add_to_cart']) &&
                    (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart'])
                ) {
                    add_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 50);
                }
            }
            
            /**
             * Product Card Styles - style 6 | modern-4
             */
            if ($nasa_opt['loop_layout_buttons'] == 'modern-4') {
                remove_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 10);
                
                if (
                    (!isset($nasa_opt['loop_add_to_cart']) || $nasa_opt['loop_add_to_cart']) &&
                    (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart'])
                ) {
                    add_action('nasa_after_show_buttons_loop', 'woocommerce_template_loop_add_to_cart');
                }
            }
            
            /**
             * Product Card Styles - style 8 | modern-6
             */
            if ($nasa_opt['loop_layout_buttons'] == 'modern-6') {
                remove_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 10);
                
                if (
                    (!isset($nasa_opt['loop_add_to_cart']) || $nasa_opt['loop_add_to_cart']) &&
                    (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart'])
                ) {
                    add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 100);
                    add_action('nasa_after_special_deal_simple_action', 'woocommerce_template_loop_add_to_cart', 100);
                }
            }
            
            /**
             * Product Card Styles - style 9 | modern-7, style 10 | modern-8
             */
            if (in_array($nasa_opt['loop_layout_buttons'], array('modern-7', 'modern-8'))) {
                remove_action('nasa_show_buttons_loop', 'woocommerce_template_loop_add_to_cart', 10);
                
                if (
                    (!isset($nasa_opt['loop_add_to_cart']) || $nasa_opt['loop_add_to_cart']) &&
                    (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart'])
                ) {
                    add_action('nasa_after_show_buttons_loop', 'woocommerce_template_loop_add_to_cart');
                }
            }
        }
    }
endif;

/**
 * Add Deal time for variation
 */
if (!function_exists('elessi_variation_deal_time')) :
    function elessi_variation_deal_time($variation) {
        if (!isset($variation['deal_time'])) {
            $time_from = get_post_meta($variation['variation_id'], '_sale_price_dates_from', true);
            $time_to = get_post_meta($variation['variation_id'], '_sale_price_dates_to', true);
            
            $arrayTime = array();
            if ($time_to) {
                $arrayTime['to'] = $time_to * 1000;
                $arrayTime['html'] = elessi_time_sale($time_to);
            }
            
            if ($time_from) {
                $arrayTime['from'] = $time_from * 1000;
            }
            
            $variation['deal_time'] = $arrayTime ? $arrayTime : false;
        }

        return $variation;
    }
endif;

/**
 * Custom Content show in list view archive page
 */
if (!function_exists('elessi_content_show_in_list')) :
    function elessi_content_show_in_list($show_in_list) {
        global $product, $nasa_opt;
        
        if ($show_in_list && (!isset($nasa_opt['nasa_in_mobile']) || !$nasa_opt['nasa_in_mobile'])) {
            $availability = $product->get_availability();
            
            if (!empty($availability['availability'])) {
                $stock_class = $availability['class'];
                $stock_label = $availability['availability'];
                ?>
                <!-- Clone Group btns for layout List -->
                <div class="hidden-tag nasa-list-stock-wrap">
                    <p class="nasa-list-stock-status <?php echo esc_attr($stock_class); ?>">
                        <?php echo $stock_label; ?>
                    </p>
                </div>
                <?php
            }
        }
    }
endif;

/**
 * Custom woocommerce_post_class
 */
if (!function_exists('elessi_custom_woocommerce_post_class')) :
    function elessi_custom_woocommerce_post_class($classes, $product) {
        global $nasa_opt, $nasa_time_sale;
        
        $product_id = $product->get_id();
        
        $classes[] = 'product-item grid';
        
        /**
         * Animate class
         */
        if (isset($nasa_opt['transition_load']) && $nasa_opt['transition_load'] == 'wow') {
            if (!isset($nasa_opt['nasa_in_mobile']) || !$nasa_opt['nasa_in_mobile']) {
                $classes[] = 'wow fadeInUp';
            }
        }
        
        /**
         * Hover effect products in grid
         */
        if (isset($nasa_opt['animated_products']) && $nasa_opt['animated_products']) {
            $classes[] = $nasa_opt['animated_products'];
        }
        
        /**
         * Out of Stock
         */
        if ("outofstock" == $product->get_stock_status()) {
            $classes[] = 'out-of-stock';
        }
        
        /**
         * Deal class
         */
        if (!isset($nasa_time_sale[$product_id])) {
            $nasa_time_sale[$product_id] = false;
            
            if ($product->is_on_sale() && $product->get_type() != 'variable') {
                $time_from = get_post_meta($product_id, '_sale_price_dates_from', true);
                $time_to = get_post_meta($product_id, '_sale_price_dates_to', true);
                $nasa_time_sale[$product_id] = ((int) $time_to < NASA_TIME_NOW || (int) $time_from > NASA_TIME_NOW) ? false : (int) $time_to;
            }
            
            $GLOBALS['nasa_time_sale'] = $nasa_time_sale;
        }
        
        if ($nasa_time_sale[$product_id]) {
            $classes[] = 'product-deals';
        }
        
        return $classes;
    }
endif;

/**
 * Deal time for loop
 */
if (!function_exists('elessi_loop_countdown')) :
    function elessi_loop_countdown() {
        global $product, $nasa_time_sale;
        
        if (!$product) {
            return;
        }
        
        $product_id = $product->get_id();
        
        /**
         * Deal class
         */
        if (!isset($nasa_time_sale[$product_id])) {
            $nasa_time_sale[$product_id] = false;
            
            if ($product->is_on_sale() && $product->get_type() != 'variable') {
                $time_from = get_post_meta($product_id, '_sale_price_dates_from', true);
                $time_to = get_post_meta($product_id, '_sale_price_dates_to', true);
                $nasa_time_sale[$product_id] = ((int) $time_to < NASA_TIME_NOW || (int) $time_from > NASA_TIME_NOW) ? false : (int) $time_to;
            }
            
            $GLOBALS['nasa_time_sale'] = $nasa_time_sale;
        }
        
        echo $nasa_time_sale[$product_id] ? elessi_time_sale($nasa_time_sale[$product_id]) : '<div class="nasa-sc-pdeal-countdown hidden-tag"></div>';
    }
endif;

/**
 * Compatible with WC_Vendor plugin
 * 
 * sold-by in loop
 */
if (!function_exists('elessi_wc_vendor_template_loop_sold_by')) :
    function elessi_wc_vendor_template_loop_sold_by() {
        global $product;
        
        if (!class_exists('WCV_Vendor_Shop') || !$product) {
            return;
        }
        
        WCV_Vendor_Shop::template_loop_sold_by($product->get_id());
    }
endif;

/**
 * Compatible with WC_Vendor plugin
 * 
 * Meta in single product
 */
if (!function_exists('elessi_wc_vendor_sold_by_meta')) :
    function elessi_wc_vendor_sold_by_meta() {
        if (!class_exists('WCV_Vendor_Cart')) {
            return;
        }
        
        echo '<span class="nasa-wc-vendor-single-meta">';
        WCV_Vendor_Cart::sold_by_meta();
        echo '</span>';
    }
endif;

/**
 * Single Product stock Progress bar
 */
if (!function_exists('elessi_single_stock')) :
    function elessi_single_stock($html, $product) {
        if ($html == '' || !$product) {
            return $html;
        }
        
        if ($product->get_stock_status() === 'outofstock') {
            return $html;
        }
        
        $product_id = $product->get_id();
        $stock = get_post_meta($product_id, '_stock', true);
        
        if (!$stock) {
            return $html;
        }
        
        $total_sales = get_post_meta($product_id, 'total_sales', true);
        $stock_sold = $total_sales ? round($total_sales) : 0;
        $stock_available = $stock ? round($stock) : 0;
        $percentage = $stock_available > 0 ? round($stock_available/($stock_available + $stock_sold) * 100) : 0;
        
        $new_html = '<div class="stock nasa-single-product-stock">';
        $new_html .= '<span class="stock-sold">';
        $new_html .= sprintf(esc_html__('Only %s item(s) left in stock.', 'elessi-theme'), '<b class="primary-color">' . $stock_available . '</b>');
        $new_html .= '</span>';
        $new_html .= '<div class="nasa-product-stock-progress">';
        $new_html .= '<span class="nasa-product-stock-progress-bar primary-bg" style="width:' . $percentage . '%"></span>';
        $new_html .= '</div>';
        $new_html .= '</div>';
        
        return $new_html;
    }
endif;

/**
 * Buy Now button
 */
if (!function_exists('elessi_add_buy_now_btn')) :
    function elessi_add_buy_now_btn() {
        global $nasa_opt, $product;
        
        if (
            (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart']) ||
            (isset($nasa_opt['enable_buy_now']) && !$nasa_opt['enable_buy_now']) ||
            'external' == $product->get_type() // Disable with External Product
        ) {
            return;
        }
        
        $class = 'nasa-buy-now';
        if (isset($nasa_opt['enable_fixed_buy_now_desktop']) && $nasa_opt['enable_fixed_buy_now_desktop']) {
            $class .= ' has-sticky-in-desktop';
        }
        
        echo '<input type="hidden" name="nasa_buy_now" value="0" />';
        echo '<button class="' . $class . '">' . esc_html__('Buy Now', 'elessi-theme') . '</button>';
    }
endif;

/**
 * Redirect to Checkout page after click buy now
 */
if (!function_exists('elessi_buy_now_to_checkout')) :
    function elessi_buy_now_to_checkout($redirect_url) {
        if (isset($_REQUEST['nasa_buy_now']) && $_REQUEST['nasa_buy_now'] === '1') {
            /**
             * Not show notices after added to cart
             */
            wc_clear_notices(); 
            
            /**
             * Redirect to checkout page
             */
            $redirect_url = wc_get_checkout_url();
        }

        return $redirect_url;
    }
endif;

/**
 * Add class Sub Categories
 */
if (!function_exists('elessi_add_class_sub_categories')) :
    function elessi_add_class_sub_categories($classes) {
        $classes[] = 'product-warp-item';
        
        return $classes;
    }
endif;

/**
 * Deal time in Single product page
 */
if (!function_exists('elessi_deal_time_single')) :
    function elessi_deal_time_single() {
        global $product;
        
        if (!$product || $product->get_stock_status() == 'outofstock') {
            return;
        }
        
        $product_type = $product->get_type();
        
        // For variation of Variation product
        if ($product_type == 'variable') {
            echo '<div class="countdown-label nasa-detail-product-deal-countdown-label nasa-crazy-inline hidden-tag">' .
                '<svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M15.992 5.872c-6.479 0-11.729 5.251-11.729 11.729 0 2.939 1.084 5.625 2.872 7.683l-2.744 3.363 0.826 0.674 2.659-3.258c2.107 2.021 4.965 3.265 8.116 3.265 3.158 0 6.023-1.251 8.132-3.281l2.657 3.278 0.829-0.672-2.746-3.387c1.778-2.056 2.857-4.735 2.857-7.666 0-6.478-5.252-11.729-11.729-11.729zM15.992 28.262c-5.88 0-10.662-4.782-10.662-10.661 0-5.88 4.783-10.662 10.662-10.662s10.663 4.783 10.663 10.662c0 5.879-4.783 10.661-10.662 10.661z"/><path d="M11.171 2.672h-3.168c-2.945 0-5.331 2.387-5.331 5.331v3.208h1.516l6.983-7.022v-1.517zM10.104 3.75l-6.366 6.395v-2.142c0-2.351 1.913-4.265 4.265-4.265h2.101v0.011z"/><path d="M23.997 2.672h-3.17v1.517l6.984 7.022h1.517v-3.208c-0-2.945-2.388-5.331-5.331-5.331zM28.262 10.145h-0.007l-6.361-6.395v-0.011h2.103c2.352 0 4.265 1.914 4.265 4.265v2.142z"/><path d="M15.467 17.599h-5.878v1.066h6.944v-9.596h-1.066z"/></svg>&nbsp;&nbsp;' .
                esc_html__('Hurry up! Sale end in:', 'elessi-theme') .
            '</div>';
            
            echo '<div class="nasa-detail-product-deal-countdown nasa-product-variation-countdown"></div>';
            
            return;
        }
        
        if ($product_type != 'simple' || !$product->is_on_sale()) {
            return;
        }
        
        $productId = $product->get_id();

        $time_from = get_post_meta($productId, '_sale_price_dates_from', true);
        $time_to = get_post_meta($productId, '_sale_price_dates_to', true);
        $time_sale = ((int) $time_to < NASA_TIME_NOW || (int) $time_from > NASA_TIME_NOW) ? false : (int) $time_to;
        if (!$time_sale) {
            return;
        }
        
        echo '<div class="countdown-label nasa-crazy-inline">' .
            '<svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M15.992 5.872c-6.479 0-11.729 5.251-11.729 11.729 0 2.939 1.084 5.625 2.872 7.683l-2.744 3.363 0.826 0.674 2.659-3.258c2.107 2.021 4.965 3.265 8.116 3.265 3.158 0 6.023-1.251 8.132-3.281l2.657 3.278 0.829-0.672-2.746-3.387c1.778-2.056 2.857-4.735 2.857-7.666 0-6.478-5.252-11.729-11.729-11.729zM15.992 28.262c-5.88 0-10.662-4.782-10.662-10.661 0-5.88 4.783-10.662 10.662-10.662s10.663 4.783 10.663 10.662c0 5.879-4.783 10.661-10.662 10.661z"/><path d="M11.171 2.672h-3.168c-2.945 0-5.331 2.387-5.331 5.331v3.208h1.516l6.983-7.022v-1.517zM10.104 3.75l-6.366 6.395v-2.142c0-2.351 1.913-4.265 4.265-4.265h2.101v0.011z"/><path d="M23.997 2.672h-3.17v1.517l6.984 7.022h1.517v-3.208c-0-2.945-2.388-5.331-5.331-5.331zM28.262 10.145h-0.007l-6.361-6.395v-0.011h2.103c2.352 0 4.265 1.914 4.265 4.265v2.142z"/><path d="M15.467 17.599h-5.878v1.066h6.944v-9.596h-1.066z"/></svg>&nbsp;&nbsp;' .
            esc_html__('Hurry up! Sale end in:', 'elessi-theme') .
        '</div>';
        
        echo '<div class="nasa-detail-product-deal-countdown">';
        echo elessi_time_sale($time_sale);
        echo '</div>';
    }
endif;

/**
 * Deal time in Quick view product
 */
if (!function_exists('elessi_deal_time_quickview')) :
    function elessi_deal_time_quickview() {
        global $product;
        
        if (!$product || $product->get_stock_status() == 'outofstock') {
            return;
        }
        
        $product_type = $product->get_type();
        
        // For variation of Variation product
        if ($product_type == 'variable') {
            echo '<div class="nasa-quickview-product-deal-countdown nasa-product-variation-countdown"></div>';
            return;
        }
        
        if ($product_type != 'simple') {
            return;
        }
        
        $productId = $product->get_id();

        $time_from = get_post_meta($productId, '_sale_price_dates_from', true);
        $time_to = get_post_meta($productId, '_sale_price_dates_to', true);
        $time_sale = ((int) $time_to < NASA_TIME_NOW || (int) $time_from > NASA_TIME_NOW) ? false : (int) $time_to;
        if (!$time_sale) {
            return;
        }
        
        echo '<div class="nasa-quickview-product-deal-countdown">';
        echo elessi_time_sale($time_sale);
        echo '</div>';
    }
endif;

/**
 * Main Image of Variation
 */
if (!function_exists('elessi_src_large_image_single_product')) :
    function elessi_src_large_image_single_product($variation) {
        if (!isset($variation['image_single_page'])) {
            $image = wp_get_attachment_image_src($variation['image_id'], 'woocommerce_single_image_width');
            $variation['image_single_page'] = isset($image[0]) ? $image[0] : '';
        }
        
        return $variation;
    }
endif;

/**
 * Results count in archive page in top
 */
if (!function_exists('elessi_result_count')) :
    function elessi_result_count() {
        if (! wc_get_loop_prop('is_paginated') || !woocommerce_products_will_display()) {
            return;
        }
        
        $total = wc_get_loop_prop('total');
        $per_page = wc_get_loop_prop('per_page');
        
        echo '<p class="woocommerce-result-count">';
        
        if ( $total <= $per_page || -1 === $per_page ) {
            printf(_n('1 result', '%d results', $total, 'elessi-theme'), $total);
	} else {
            $current = wc_get_loop_prop('current_page');
            $showed = $per_page * $current;
            
            if ($showed > $total) {
                $showed = $total;
            }
            
            printf(_n('1 result', '%d results', $total, 'elessi-theme'), $showed);
	}
        
        echo '</p>';
    }
endif;

/**
 * Get Top Content category products page
 */
if (!function_exists('elessi_get_cat_top')):
    function elessi_get_cat_top() {
        global $wp_query, $nasa_opt;
        
        $catId = null;
        $nasa_cat_obj = $wp_query->get_queried_object();
        if (isset($nasa_cat_obj->term_id) && isset($nasa_cat_obj->taxonomy)) {
            $catId = (int) $nasa_cat_obj->term_id;
        }
        
        $content = '<div class="nasa-cat-header">';
        $do_content = '';
        
        if ((int) $catId > 0) {
            $block = get_term_meta($catId, 'cat_header', true);
            
            if ($block === '-1') {
                return;
            }
            
            if ($block) {
                $do_content = elessi_get_block($block);
            }
        }

        if (trim($do_content) === '') {
            if (isset($nasa_opt['cat_header_content']) && $nasa_opt['cat_header_content'] != '') {
                $do_content = elessi_get_block($nasa_opt['cat_header_content']);
            }
        }

        if (trim($do_content) === '') {
            return;
        }

        $content .= $do_content . '</div>';

        echo $content;
    }
endif;

if (!function_exists('elessi_add_wrap_archive_desc')):
    function elessi_add_wrap_archive_desc($desc) {
        if (!empty($desc)) {
            $desc = '<div class="row"><div class="large-12 columns">' . $desc . '</div></div>';
        }
        
        return $desc;
    }
endif;

/**
 * Get Bottom Content category products page
 */
if (!function_exists('elessi_get_cat_bottom')):
    function elessi_get_cat_bottom() {
        global $wp_query, $nasa_opt;
        
        $catId = null;
        $nasa_cat_obj = $wp_query->get_queried_object();
        if (isset($nasa_cat_obj->term_id) && isset($nasa_cat_obj->taxonomy)) {
            $catId = (int) $nasa_cat_obj->term_id;
        }
        
        $content = '<div class="nasa-cat-footer padding-top-20 padding-bottom-50">';
        $do_content = '';
        
        if ((int) $catId > 0) {
            $block = get_term_meta($catId, 'cat_footer_content', true);
            
            if ($block === '-1') {
                return;
            }
            
            if ($block) {
                $do_content = elessi_get_block($block);
            }
        }

        if (trim($do_content) === '') {
            if (isset($nasa_opt['cat_footer_content']) && $nasa_opt['cat_footer_content'] != '') {
                $do_content = elessi_get_block($nasa_opt['cat_footer_content']);
            }
        }

        if (trim($do_content) === '') {
            return;
        }

        $content .= $do_content . '</div>';

        echo $content;
    }
endif;

/**
 * Nasa childs category in Shop Top bar
 */
if (!function_exists('elessi_get_childs_category')):
    function elessi_get_childs_category($term = null, $instance = array()) {
        $content = '';
        
        if (NASA_WOO_ACTIVED){
            global $wp_query;
            
            $term = $term == null ? $wp_query->get_queried_object() : $term;
            $parent_id = is_numeric($term) ? $term : (isset($term->term_id) ? $term->term_id : 0);
            
            $nasa_terms = get_terms(apply_filters('woocommerce_product_attribute_terms', array(
                'taxonomy' => 'product_cat',
                'parent' => $parent_id,
                'hierarchical' => true,
                'hide_empty' => false,
                'orderby' => 'name'
            )));
            
            if (!$nasa_terms) {
                $term_root = get_ancestors($parent_id, 'product_cat');
                $term_parent = isset($term_root[0]) ? $term_root[0] : 0;
                $nasa_terms = get_terms(apply_filters('woocommerce_product_attribute_terms', array(
                    'taxonomy' => 'product_cat',
                    'parent' => $term_parent,
                    'hierarchical' => true,
                    'hide_empty' => false,
                    'orderby' => 'name'
                )));
            }
            
            if ($nasa_terms) {
                $show = isset($instance['show_items']) ? (int) $instance['show_items'] : 0;
                $content .= '<ul class="nasa-children-cat product-categories nasa-product-child-cat-top-sidebar">';
                $items = 0;
                
                foreach ($nasa_terms as $v) {
                    $class_active = $parent_id == $v->term_id ? ' nasa-active' : '';
                    $class_li = ($show && $items >= $show) ? ' nasa-show-less' : '';
                    
                    $icon = '';
                    if (isset($instance['cat_' . $v->slug]) && trim($instance['cat_' . $v->slug]) != '') {
                        $icon = '<i class="' . $instance['cat_' . $v->slug] . '"></i>';
                        $icon .= '&nbsp;&nbsp;';
                    }
                    
                    $content .= '<li class="cat-item cat-item-' . esc_attr($v->term_id) . ' cat-item-accessories root-item' . $class_li . '">';
                    $content .= '<a href="' . esc_url(get_term_link($v)) . '" data-id="' . esc_attr($v->term_id) . '" class="nasa-filter-by-cat' . $class_active . '" title="' . esc_attr($v->name) . '" data-taxonomy="product_cat">';
                    $content .= '<div class="nasa-cat-warp">';
                    $content .= '<h5 class="nasa-cat-title">';
                    $content .= $icon . esc_attr($v->name);
                    $content .= '</h5>';
                    $content .= '</div>';
                    $content .= '</a>';
                    $content .= '</li>';
                    $items++;
                }
                
                if ($show && ($items > $show)) {
                    $content .= '<li class="nasa_show_manual"><a data-show="1" class="nasa-show" href="javascript:void(0);" data-text="' . esc_attr__('- Show less', 'elessi-theme') . '" rel="nofollow">' . esc_html__('+ Show more', 'elessi-theme') . '</a></li>';
                }
                
                $content .= '</ul>';
            }
        }
        
        echo $content;
    }
endif;

/**
 * Add action archive-product get content product.
 */
if (!function_exists('elessi_checkout_form_layout')) :
    function elessi_checkout_form_layout($checkout) {
        $name = defined('NASA_CHECKOUT_LAYOUT') ? NASA_CHECKOUT_LAYOUT : 'default';
        $layout = 'nasa-checkout-' . $name;
        
        $file = ELESSI_CHILD_PATH . '/includes/' . $layout . '.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/' . $layout . '.php';
    }
endif;

/**
 * Add action archive-product get content product.
 */
if (!function_exists('elessi_checkout_coupon_form_clone')) :
    function elessi_checkout_coupon_form_clone() {
        $file = ELESSI_CHILD_PATH . '/includes/nasa-checkout-coupon-modern.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-checkout-coupon-modern.php';
    }
endif;

/**
 * Add action elessi_step_billing.
 */
if (!function_exists('elessi_step_billing')) :
    function elessi_step_billing() {
        // $need_shipping = 'no' === get_option('woocommerce_enable_shipping_calc') || !WC()->cart->needs_shipping() ? false : true;
        $need_shipping = !WC()->cart->needs_shipping() ? false : true;
        
        echo '<div id="nasa-step_billing">';
        echo '<div class="nasa-checkout-step">';
        echo '<a href="' . esc_url(wc_get_cart_url()) . '" class="nasa-back-to-cart nasa-back-step" title="' . esc_attr__('Return to Cart', 'elessi-theme') . '"><svg width="30" height="30" viewBox="0 0 32 32" fill="currentColor"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z" /></svg>' . esc_html__('RETURN TO CART', 'elessi-theme') . '</a>';
        
        echo $need_shipping ? 
            '<a href="javascript:void(0);" rel="nofollow" class="button nasa-shipping-step nasa-switch-step">' . esc_html__('Continue To Shipping', 'elessi-theme') . '</a>' :
            '<a href="javascript:void(0);" rel="nofollow" class="button nasa-payment-step nasa-switch-step">' . esc_html__('Continue To Payment', 'elessi-theme') . '</a>';
        
        echo '</div>';
        echo '<p class="nasa-require-notice hidden-tag">' . esc_html__('This field is required.', 'elessi-theme') . '</p>';
        echo '<p class="nasa-email-notice hidden-tag">' . esc_html__('Email incorrect format.', 'elessi-theme') . '</p>';
        echo '<p class="nasa-phone-notice hidden-tag">' . esc_html__('Phone incorrect format.', 'elessi-theme') . '</p>';
        echo '</div>';
    }
endif;

/**
 * Add action Checkout shipping.
 */
if (!function_exists('elessi_checkout_shipping')) :
    function elessi_checkout_shipping() {
        // $need_shipping = 'no' === get_option('woocommerce_enable_shipping_calc') || !WC()->cart->needs_shipping() ? false : true;
        $need_shipping = !WC()->cart->needs_shipping() ? false : true;
    
        echo '<div id="nasa-billing-info">';
        
        echo '<div class="customer-info-wrap">';
        
        /**
         * Email Contact
         */
        echo '<div class="customer-info customer-info-email">';
        echo '<span class="customer-info-left">' . esc_html__('Contact', 'elessi-theme') . '</span>';
        echo '<span class="customer-info-right"></span>';
        echo '<a href="javascript:void(0);" class="customer-info-change nasa-billing-step rtl-text-left">' . esc_html__('Change', 'elessi-theme') . '</a>';
        echo '</div>';
        
        if ($need_shipping) {
            /**
             * Shipping
             */
            echo '<div class="customer-info customer-info-addr">';
            echo '<span class="customer-info-left">' . esc_html__('Ship to', 'elessi-theme') . '</span>';
            echo '<span class="customer-info-right"><p class="nasa-ct-info-addr"></p></span>';
            echo '<a href="javascript:void(0);" class="customer-info-change nasa-billing-step rtl-text-left">' . esc_html__('Change', 'elessi-theme') . '</a>';
            echo '</div>';

            /**
             * Method
             */
            echo '<div class="customer-info customer-info-method hidden-tag">';
            echo '<span class="customer-info-left">' . esc_html__('Method', 'elessi-theme') . '</span>';
            echo '<span class="customer-info-right"></span>';
            echo '<a href="javascript:void(0);" class="customer-info-change nasa-shipping-step rtl-text-left">' . esc_html__('Change', 'elessi-theme') . '</a>';
            echo '</div>';
        }
        
        echo '</div>';
        
        echo '</div>';
        
        /**
         * Shipping Methods
         */
        if ($need_shipping) {
            echo '<div id="nasa-shipping-methods" class="hidden-tag">';
            echo '<h3 class="nasa-box-heading">';
            echo esc_html__('Shipping Methods', 'elessi-theme');
            echo '</h3>';
            echo '<div class="shipping-wrap-moderns"></div>';
            echo '</div>';
        }
        
        /**
         * Payments
         */
        echo '<div id="nasa-step_payment">';
        echo '<div class="nasa-checkout-step">';
        echo '<a href="javascript:void(0);" rel="nofollow" class="nasa-billing-step nasa-back-step"><svg width="30" height="30" viewBox="0 0 32 32" fill="currentColor"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z" /></svg>' . esc_html__('RETURN TO INFORMATION', 'elessi-theme') . '</a>';
        echo '<a href="javascript:void(0);" rel="nofollow" class="button nasa-payment-step nasa-switch-step">' . esc_html__('Continue To Payment', 'elessi-theme') . '</a>';
        echo '</div>';
        echo '</div>';
    }
endif;

/**
 * Modern Shipping html
 */
if (!function_exists('elessi_modern_shipping_html')) :
    function elessi_modern_shipping_html() {
        ob_start();
        wc_cart_totals_shipping_html();
        $shipping = ob_get_clean();
        
        return $shipping;
    }
endif;

/**
 * Add action Payments Headling.
 */
if (!function_exists('elessi_checkout_payment_headling')) :
    function elessi_checkout_payment_headling() {
        echo '<h3 class="nasa-box-heading payment-method-step">';
        echo esc_html__('Payment Methods', 'elessi-theme');
        echo '</h3>';
        echo '<p class="nasa-box-desc payment-method-step">' . esc_html__('All transactions are secure and encrypted.', 'elessi-theme') . '</p>';
    }
endif;

/**
 * Add Filter 'woocommerce_checkout_fields'.
 */
if (!function_exists('elessi_checkout_email_first')) :
    function elessi_checkout_email_first($checkout_fields) {
        $checkout_fields['billing']['billing_email']['priority'] = 5;
        
        return $checkout_fields;
    }
endif;

/**
 * Fixed address_2 => undefined
 * 
 * Since 5.1.6
 */
if (!function_exists('elessi_fixed_address_2_undefined')) :
    function elessi_fixed_address_2_undefined($fields) {
        if ('hidden' === get_option('woocommerce_checkout_address_2_field', 'optional')) {
            $fields['{address_2}'] = null;
            $fields['{address_2_upper}'] = null;
        }

        return $fields;
    }
endif;

/**
 * Add Filter 'woocommerce_update_order_review_fragments'.
 */
if (!function_exists('elessi_update_order_review_fragments')) :
    function elessi_update_order_review_fragments($fragments) {
        // $need_shipping = 'no' === get_option('woocommerce_enable_shipping_calc') || !WC()->cart->needs_shipping() ? false : true;
        $need_shipping = !WC()->cart->needs_shipping() ? false : true;
    
        $packages = WC()->shipping->get_packages();
        
        if (isset($packages[0]) && $packages[0]['destination']) {
            $fragments['.nasa-ct-info-addr'] = '<p class="nasa-ct-info-addr">' . WC()->countries->get_formatted_address($packages[0]['destination'], ', ') . '</p>';
        }
        
        /**
         * Total price
         */
        ob_start();
        wc_cart_totals_order_total_html();
        $total = ob_get_clean();
        $fragments['.your-order-price'] = '<span class="your-order-price">' . $total . '</span>';
        
        /**
         * Shipping Method
         */
        if ($need_shipping) {
            ob_start();
            wc_cart_totals_shipping_html();
            $shipping = ob_get_clean();
            $fragments['.shipping-wrap-moderns'] = '<div class="shipping-wrap-moderns">' . $shipping . '</div>';
        }
        
        return $fragments;
    }
endif;

/**
 * Add action before Payments.
 */
if (!function_exists('elessi_checkout_payment_open')) :
    function elessi_checkout_payment_open() {
        echo '<div id="nasa-payment-wrap">';
    }
endif;

/**
 * Add action after Payments.
 */
if (!function_exists('elessi_checkout_payment_close')) :
    function elessi_checkout_payment_close() {
        echo '</div>';
    }
endif;

/**
 * Add action after Payments.
 */
if (!function_exists('elessi_checkout_modern_billing_detail')) :
    function elessi_checkout_modern_billing_detail() {
        if (true !== WC()->cart->needs_shipping_address() || 'shipping' !== get_option('woocommerce_ship_to_destination')) {
            return;
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-checkout-modern-billing-detail.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-checkout-modern-billing-detail.php';
    }
endif;

/**
 * Add Checkout Shipping Phone
 */
if (!function_exists('elessi_checkout_add_shipping_phone')) :
    function elessi_checkout_add_shipping_phone($fields) {
        if (!WC()->cart || true !== WC()->cart->needs_shipping_address()) {
            return $fields;
        }
        
        $phone_require = get_option('woocommerce_checkout_phone_field', 'required');
        
        if ('hidden' !== $phone_require) {
            $fields['shipping_phone'] = array(
                'label'        => esc_html__('Phone', 'elessi-theme'),
                'required'     => 'required' === $phone_require,
                'type'         => 'tel',
                'class'        => array('form-row-wide'),
                'validate'     => array('phone'),
                'autocomplete' => 'tel',
                'priority'     => 100,
            );
        }
        
        return $fields;
    }
endif;

/**
 * Hook Checkout Modern Process
 */
if (!function_exists('elessi_checkout_modern_posted_data')) :
    function elessi_checkout_modern_posted_data($data) {
        if (
            NASA_CORE_IN_ADMIN ||
            true !== WC()->cart->needs_shipping_address() ||
            'shipping' !== get_option('woocommerce_ship_to_destination')
        ) {
            return $data;
        }
    
        if (isset($_POST['ns-billing-select']) && $_POST['ns-billing-select'] === 'same') {
            foreach ($data as $key => $value) {
                if ($key !== 'billing_email' && 0 === strpos($key, 'billing_')) {
                    unset($data[$key]);
                }
                
                if (0 === strpos($key, 'shipping_')) {
                    $data['billing_' . substr($key, 9)] = $value;
                }
            }
            
            /**
             * Unrequired with Billing Form
             */
            $checkout = WC()->checkout();
            
            $fields = $checkout->get_checkout_fields();
            
            foreach ($fields['billing'] as $key => $field) {
                $fields['billing'][$key]['required'] = false;
            }
            
            $checkout->checkout_fields = $fields;
        }
        
        return $data;
    }
endif;

/**
 * Add action archive-product get content product.
 */
if (!function_exists('elessi_bc_checkout_modern')) :
    function elessi_bc_checkout_modern() {
        $file = ELESSI_CHILD_PATH . '/includes/nasa-get-content-products.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-get-content-products.php';
    }
endif;

/**
 * Add action archive-product get content product.
 */
if (!function_exists('elessi_get_content_products')) :
    function elessi_get_content_products($nasa_sidebar = 'top') {
        $file = ELESSI_CHILD_PATH . '/includes/nasa-get-content-products.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-get-content-products.php';
    }
endif;

/**
 * Next - Prev Single Product
 */
if (!function_exists('elessi_next_prev_single_product')) :
    function elessi_next_prev_single_product() {
        global $nasa_opt;
        
        if (isset($nasa_opt['next_prev_product']) && !$nasa_opt['next_prev_product']) {
            return;
        }
        
        echo '<div class="products-arrow">';
        do_action('next_prev_product');
        echo '</div>';
    }
endif;

/*
 * Wishlist in list
 */
if (!function_exists('elessi_add_wishlist_in_list')) :
    function elessi_add_wishlist_in_list() {
        if (NASA_WISHLIST_IN_LIST) {
            elessi_add_wishlist_button('left');
        }
    }
endif;

/*
 * Wishlist in single
 */
if (!function_exists('elessi_add_wishlist_in_detail')) :
    function elessi_add_wishlist_in_detail() {
        elessi_add_wishlist_button('right');
    }
endif;

/*
 * Wishlist in single with label
 */
if (!function_exists('elessi_add_wishlist_in_detail_with_label')) :
    function elessi_add_wishlist_in_detail_with_label() {
        elessi_add_wishlist_button('label');
    }
endif;

/**
 * Quick view in list
 */
if (!function_exists('elessi_quickview_in_list')) :
    function elessi_quickview_in_list() {
        global $product;
        
        if (!$product) {
            return;
        }
        
        $type = $product->get_type();
        
        $svg_look='<svg  class="nasa-icon" width="20" height="36" viewBox="0 0 32 32" fill="currentColor"><path d="M16 6.404c-5.847 0-10.404 3.66-15.994 9.593 4.816 5.073 8.857 9.6 15.994 9.6s12.382-5.73 15.994-9.492c-3.697-4.407-8.943-9.7-15.994-9.7zM16 24.53c-6.336 0-10.16-3.929-14.524-8.532 5.192-5.414 9.32-8.527 14.524-8.527 6.161 0 10.975 4.443 14.558 8.591-3.523 3.674-8.293 8.469-14.558 8.469z" /><path d="M16 9.603c-3.528 0-6.398 2.87-6.398 6.397s2.87 6.397 6.398 6.397 6.398-2.87 6.398-6.397-2.87-6.397-6.398-6.397zM16 21.331c-2.939 0-5.331-2.391-5.331-5.331s2.392-5.331 5.331-5.331 5.331 2.391 5.331 5.331c0 2.939-2.392 5.331-5.331 5.331z" /><path d="M16 12.268c-2.058 0-3.732 1.674-3.732 3.732s1.674 3.732 3.732 3.732c2.058 0 3.732-1.674 3.732-3.732s-1.674-3.732-3.732-3.732zM16 18.666c-1.47 0-2.666-1.196-2.666-2.666s1.196-2.666 2.666-2.666 2.666 1.196 2.666 2.666c0 1.47-1.196 2.666-2.666 2.666z" /></svg>';
        /**
         * Apply Filters Icon
         */
        $icon = apply_filters('nasa_icon_quickview',$svg_look);
        
        $quickview = '<a ' .
            'href="javascript:void(0);" ' .
            'class="quick-view btn-link quick-view-icon nasa-tip nasa-tip-left" ' .
            'data-prod="' . absint($product->get_id()) . '" ' .
            'data-icon-text="' . ($type !== 'woosb' ? esc_attr__('Quick View', 'elessi-theme') : esc_attr__('View', 'elessi-theme')) . '" ' .
            'title="' . ($type !== 'woosb' ? esc_attr__('Quick View', 'elessi-theme') : esc_attr__('View', 'elessi-theme')) . '" ' .
            'data-product_type="' . esc_attr($type) . '" ' .
            'data-href="' . esc_url($product->get_permalink()) . '" rel="nofollow">' .
            $icon .
        '</a>';
        
        echo $quickview;
    }
endif;

/**
 * Gift icon in list
 * Yith Bundle plugin
 */
if (!function_exists('elessi_bundle_in_list')) :
    function elessi_bundle_in_list() {
        global $product;
        
        if (!defined('YITH_WCPB') || !$product || $product->get_type() != NASA_COMBO_TYPE) {
            return;
        }
        ?>
        <a href="javascript:void(0);" class="btn-combo-link btn-link gift-icon nasa-tip nasa-tip-left" data-prod="<?php echo (int) $product->get_id(); ?>" data-tip="<?php esc_attr_e('Promotion Gifts', 'elessi-theme'); ?>" title="<?php esc_attr_e('Promotion Gifts', 'elessi-theme'); ?>" data-icon-text="<?php esc_attr_e('Promotion Gifts', 'elessi-theme'); ?>" rel="nofollow">
            <i class="nasa-icon pe-7s-gift"></i>
        </a>
        <?php
    }
endif;

/**
 * Gift icon Featured
 * Yith Bundle plugin
 */
if (!function_exists('elessi_gift_featured')) :
    function elessi_gift_featured() {
        global $product, $nasa_opt;
        
        if (isset($nasa_opt['enable_gift_featured']) && !$nasa_opt['enable_gift_featured']) {
            return;
        }
        
        $product_type = $product->get_type();
        if (!defined('YITH_WCPB') || $product_type != NASA_COMBO_TYPE) {
            return;
        }
        
        echo 
        '<div class="nasa-gift-featured-wrap">' .
            '<div class="nasa-gift-featured">' .
                '<div class="gift-icon">' .
                    '<a href="javascript:void(0);" class="nasa-gift-featured-event nasa-transition" title="' . esc_attr__('View the promotion gifts', 'elessi-theme') . '" rel="nofollow">' .
                        '<span class="pe-icon pe-7s-gift"></span>' .
                        '<span class="hidden-tag nasa-icon-text">' . 
                            esc_html__('Promotion Gifts', 'elessi-theme') . 
                        '</span>' .
                    '</a>' .
                '</div>' .
            '</div>' .
        '</div>';
    }
endif;

/**
 * Add compare in list
 */
if (!function_exists('elessi_add_compare_in_list')) :
    function elessi_add_compare_in_list() {
        global $yith_woocompare;
        
        if (!$yith_woocompare) {
            return;
        }
        
        global $product, $nasa_opt;
        
        $productId = $product->get_id();
        
        $nasa_compare = (!isset($nasa_opt['nasa-product-compare']) || $nasa_opt['nasa-product-compare']) ? true : false;
        
        $class_btn = 'btn-compare btn-link compare-icon nasa-tip nasa-tip-left';
        $class_btn .= $nasa_compare ? ' nasa-compare' : '';

        $svg_compare = '<svg class="nasa-icon ns-refresh nasa-flip-vertical" viewBox="0 40 512 512" width="20" height="36" fill="currentColor"><path d="M276 467c0 8 6 21-2 23l-26 0c-128-7-230-143-174-284 5-13 13-23 16-36-18 0-41 23-54 5 5-15 25-18 41-23 15-5 36-7 48-15-2 10 23 95 6 100-21 5-13-39-18-57-8-5-8 8-11 13-71 126 29 297 174 274z m44 13c-8 0-10 5-20 3 0-6-3-13-3-18 5-3 13-3 18-5 2 7 5 15 5 20z m38-18c-5 3-10 8-18 10-2-7-5-12-7-18 5-2 10-7 18-7 2 5 7 7 7 15z m34-31c0-33-18-71-5-99 23 2 12 38 17 58 90-117-7-314-163-289 0-8-3-10-3-20 131-5 233 84 220 225-2 36-20 66-30 92 12 0 51-26 53-2 3 17-82 28-89 35z m-233-325c5-2 13-5 18-10 0 8 5 10 7 18-5 2-10 8-18 8 0-8-7-8-7-16z m38-18c8 0 10-5 21-5 0 5 2 13 2 18-5 3-13 3-18 5 0-5-5-10-5-18z"/></svg>';

        $svg_check = '<svg class="nasa-icon ns-check" fill="none" height="36" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20"><polyline points="20 6 9 17 4 12"/></svg>';
        
        /**
         * Apply Filters Icon
         */
        $icon = apply_filters('nasa_icon_compare', $svg_compare . $svg_check);
        ?>
        <a href="javascript:void(0);" class="<?php echo esc_attr($class_btn); ?>" data-prod="<?php echo (int) $productId; ?>" data-icon-text="<?php esc_attr_e('Compare', 'elessi-theme'); ?>" data-added="<?php esc_attr_e('Added to Compare', 'elessi-theme'); ?>" title="<?php esc_attr_e('Compare', 'elessi-theme'); ?>" rel="nofollow">
            <?php echo $icon; ?>
        </a>
        
        <?php if (!$nasa_compare && shortcode_exists('yith_compare_button')) : ?>
            <div class="add-to-link woocommerce-compare-button hidden-tag">
                <?php echo do_shortcode('[yith_compare_button]'); ?>
            </div>
        <?php endif;
    }
endif;

/**
 * Add compare in single
 */
if (!function_exists('elessi_add_compare_in_detail')) :
    function elessi_add_compare_in_detail() {
        global $yith_woocompare;
        
        if (!$yith_woocompare || get_option('yith_woocompare_compare_button_in_product_page') != 'yes') {
            return;
        }
        
        global $product, $nasa_opt;
        
        $productId = $product->get_id();
        
        $nasa_compare = (!isset($nasa_opt['nasa-product-compare']) || $nasa_opt['nasa-product-compare']) ? true : false;
        
        $class_btn = 'btn-compare btn-link compare-icon nasa-tip nasa-tip-right ns-has-wrap';
        $class_btn .= $nasa_compare ? ' nasa-compare' : '';
        
        $svg_compare = '<svg class="nasa-icon ns-refresh nasa-flip-vertical" viewBox="0 30 512 512" width="20" height="20" fill="currentColor"><path d="M276 467c0 8 6 21-2 23l-26 0c-128-7-230-143-174-284 5-13 13-23 16-36-18 0-41 23-54 5 5-15 25-18 41-23 15-5 36-7 48-15-2 10 23 95 6 100-21 5-13-39-18-57-8-5-8 8-11 13-71 126 29 297 174 274z m44 13c-8 0-10 5-20 3 0-6-3-13-3-18 5-3 13-3 18-5 2 7 5 15 5 20z m38-18c-5 3-10 8-18 10-2-7-5-12-7-18 5-2 10-7 18-7 2 5 7 7 7 15z m34-31c0-33-18-71-5-99 23 2 12 38 17 58 90-117-7-314-163-289 0-8-3-10-3-20 131-5 233 84 220 225-2 36-20 66-30 92 12 0 51-26 53-2 3 17-82 28-89 35z m-233-325c5-2 13-5 18-10 0 8 5 10 7 18-5 2-10 8-18 8 0-8-7-8-7-16z m38-18c8 0 10-5 21-5 0 5 2 13 2 18-5 3-13 3-18 5 0-5-5-10-5-18z"/></svg>';

        $svg_check = '<svg class="nasa-icon ns-check" fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20"><polyline points="20 6 9 17 4 12"/></svg>';
        
        /**
         * Apply Filters Icon
         */
        $icon = apply_filters('nasa_icon_compare_in_detail', $svg_compare . $svg_check);
        ?>
        <a href="javascript:void(0);" class="<?php echo esc_attr($class_btn); ?>" data-prod="<?php echo (int) $productId; ?>" data-tip="<?php esc_attr_e('Compare', 'elessi-theme'); ?>" title="<?php esc_attr_e('Compare', 'elessi-theme'); ?>" rel="nofollow">
            <?php echo $icon; ?>
            <span class="nasa-icon-text-wrap">
                <span class="margin-left-5 rtl-margin-left-0 rtl-margin-right-5 nasa-icon-text"><?php esc_html_e('Add to Compare', 'elessi-theme'); ?></span>
                <span class="margin-left-5 rtl-margin-left-0 rtl-margin-right-5 nasa-icon-text"><?php esc_html_e('Added to Compare', 'elessi-theme'); ?></span>
            </span>
        </a>

        <?php if (!$nasa_compare && shortcode_exists('yith_compare_button')) { ?>
            <div class="add-to-link woocommerce-compare-button hidden-tag">
                <?php echo do_shortcode('[yith_compare_button]'); ?>
            </div>
        <?php } ?>
    <?php
    }
endif;

/**
 * custom fields single product
 */
if (!function_exists('elessi_add_custom_field_detail_product')) :
    function elessi_add_custom_field_detail_product() {
        global $product, $product_lightbox;
        
        if ($product_lightbox) {
            $product = $product_lightbox;
        }
        
        $product_type = $product->get_type();
        // 'woosb' Bundle product
        if (!in_array($product_type, array('simple', 'variable', 'variation'))) {
            return;
        }
        
        global $nasa_opt;

        $nasa_btn_ajax_value = '0';
        if (
            'yes' !== get_option('woocommerce_cart_redirect_after_add') &&
            'yes' === get_option('woocommerce_enable_ajax_add_to_cart') &&
            (!isset($nasa_opt['enable_ajax_addtocart']) || $nasa_opt['enable_ajax_addtocart'] == '1')
        ) {
            $nasa_btn_ajax_value = '1';
        }
        
        echo '<div class="nasa-custom-fields hidden-tag">';
        echo '<input type="hidden" name="nasa-enable-addtocart-ajax" value="' . $nasa_btn_ajax_value . '" />';
        echo '<input type="hidden" name="data-product_id" value="' . esc_attr($product->get_id()) . '" />';
        echo '<input type="hidden" name="data-type" value="' . esc_attr($product_type) . '" />';
        
        if (NASA_WISHLIST_ENABLE) {
            $nasa_has_wishlist = (isset($_REQUEST['nasa_wishlist']) && $_REQUEST['nasa_wishlist'] == '1') ? '1' : '0';
            echo '<input type="hidden" name="data-from_wishlist" value="' . esc_attr($nasa_has_wishlist) . '" />';
        }
        
        echo '</div>';
    }
endif;

/**
 * Images in content product
 */
if (!function_exists('elessi_loop_product_content_thumbnail')) :
    function elessi_loop_product_content_thumbnail() {
        $file = ELESSI_CHILD_PATH . '/includes/nasa-loop-product-thumbnail.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-loop-product-thumbnail.php';
    }
endif;

/**
 * Ajax Single Product Page
 */
if (!function_exists('elessi_ajax_single_product_tag')) :
    function elessi_ajax_single_product_tag() {
        // global $nasa_opt;
        echo defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT ? '<div id="nasa-single-product-ajax" class="hidden-tag"></div>' : '';
    }
endif;

/**
 * Buttons in content product
 */
if (!function_exists('elessi_loop_product_content_btns')) :
    function elessi_loop_product_content_btns() {
        echo elessi_product_group_button();
    }
endif;

/**
 * Categories in content product
 */
if (!function_exists('elessi_loop_product_cats')) :
    function elessi_loop_product_cats() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['loop_categories']) || !$nasa_opt['loop_categories']) {
            return;
        }
        
        global $product;
        
        if (!$product) {
            return;
        }
        
        $categories = wc_get_product_category_list($product->get_id(), ', ');
        
        if ($categories) {
            echo '<div class="nasa-list-category nasa-show-one-line">';
            echo $categories;
            echo '</div>';
        }
    }
endif;

/**
 * SKU in content product
 * 
 * Since 5.1.2
 */
if (!function_exists('elessi_loop_product_sku')) :
    function elessi_loop_product_sku() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['loop_sku']) || !$nasa_opt['loop_sku']) {
            return;
        }
        
        global $product;
        
        if (!$product) {
            return;
        }
        
        $sku = $product->get_sku();
        
        if ($sku) {
            echo '<div class="nasa-sku nasa-show-one-line nasa-crazy-inline">';
            echo '<span class="ns-sku-lbl">' . esc_html__('SKU:', 'elessi-theme') . '&nbsp;</span>' . $sku;
            echo '</div>';
        }
    }
endif;

/**
 * Title in content product
 */
if (!function_exists('elessi_loop_product_content_title')) :
    function elessi_loop_product_content_title() {
        global $product, $nasa_opt;
        
        $class_title = 'name nasa-bold woocommerce-loop-product__title';
        $class_title .= (!isset($nasa_opt['cutting_product_name']) || $nasa_opt['cutting_product_name']) ? ' nasa-show-one-line' : '';
        $class_title .= defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT ? ' nasa-ajax-call' : '';
        ?>
        
        <a class="<?php echo esc_attr(apply_filters('woocommerce_product_loop_title_classes', $class_title)); ?>" href="<?php echo esc_url($product->get_permalink()); ?>" title="<?php echo esc_attr($product->get_name()); ?>">
            <?php echo get_the_title(); ?>
        </a>
    <?php
    }
endif;

/**
 * Description in content product
 */
if (!function_exists('elessi_loop_product_description')) :
    function elessi_loop_product_description($desc_info = true) {
        if (!$desc_info) {
            return;
        }
        
        global $post;
        
        $short_desc = apply_filters('woocommerce_short_description', $post->post_excerpt);
        
        echo $short_desc ? '<div class="info_main product-des-wrap product-des">' . $short_desc . '</div>' : '';
    }
endif;

/**
 * Top side bar shop
 */
if (!function_exists('elessi_top_sidebar_shop')) :
    function elessi_top_sidebar_shop($type = '') {
        $file = ELESSI_CHILD_PATH . '/includes/nasa-sidebar-shop-top.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-sidebar-shop-top.php';
    }
endif;

/**
 * Side bar shop
 */
if (!function_exists('elessi_side_sidebar_shop')) :
    function elessi_side_sidebar_shop($nasa_sidebar = 'left') {
        $file = ELESSI_CHILD_PATH . '/includes/nasa-sidebar-shop-side.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-sidebar-shop-side.php';
    }
endif;

/**
 * Out of Stock badge
 */
if (!function_exists('elessi_badge_outofstock')) :
    function elessi_badge_outofstock() {
        return apply_filters('nasa_badge_outofstock', '<span class="badge out-of-stock-label">' . esc_html__('Sold Out', 'elessi-theme') . '</span>');
    }
endif;

/**
 * Change View
 */
if (!function_exists('elessi_nasa_change_view')) :
    function elessi_nasa_change_view($nasa_sidebar = 'no') {
        global $nasa_opt;
        
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
        if ($in_mobile) {
            return;
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-change-view.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-change-view.php';
    }
endif;

/**
 * Single Product Layout
 */
if (!function_exists('elessi_single_product_layout')) :
    function elessi_single_product_layout() {
        global $nasa_opt;

        $sticky_sidebar_classic = isset($nasa_opt['single_product_sticky_sidebar_classic']) && $nasa_opt['single_product_sticky_sidebar_classic'] ? ' ns-sticky-scroll-sidebar':'';
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
        if ($in_mobile && isset($nasa_opt['single_product_mobile']) && $nasa_opt['single_product_mobile']) {
            $nasa_actsidebar = false;
        } else {
            $nasa_actsidebar = is_active_sidebar('product-sidebar');
        }
        
        $nasa_sidebar = isset($nasa_opt['product_sidebar']) ? $nasa_opt['product_sidebar'] : 'no';
        
        if (!isset($nasa_opt['product_detail_layout'])) {
            $nasa_opt['product_detail_layout'] = 'new';
        }

        // Class
        switch ($nasa_sidebar) :
            case 'right' :
                if ($nasa_opt['product_detail_layout'] == 'classic') {
                    $main_class = 'large-9 columns left';
                    $bar_class = 'large-3 columns col-sidebar desktop-padding-left-20 product-sidebar-right right' . $sticky_sidebar_classic;
                } else {
                    $main_class = '';
                    $bar_class = 'nasa-side-sidebar nasa-sidebar-right';
                }

                break;

            case 'no' :
                $main_class = $nasa_opt['product_detail_layout'] == 'classic' ? 'large-12 columns' : '';
                $bar_class = '';
                break;

            default:
            case 'left' :
                if ($nasa_opt['product_detail_layout'] == 'classic') {
                    $main_class = 'large-9 columns right';
                    $bar_class = 'large-3 columns col-sidebar desktop-padding-right-20 product-sidebar-left left' . $sticky_sidebar_classic;
                } 
                else {
                    $main_class = '';
                    $bar_class = 'nasa-side-sidebar nasa-sidebar-left';
                }

                break;

        endswitch;
        
        $main_class .= $main_class != '' ? ' ' : '';
        $main_class .= 'nasa-single-product-' . $nasa_opt['product_image_style'];
        $main_class .= $nasa_opt['product_image_style'] == 'scroll' && $nasa_opt['product_image_layout'] == 'double' ? ' nasa-single-product-2-columns': '';
        
        $main_class .= $in_mobile ? ' nasa-single-product-in-mobile' : '';
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-' . $nasa_opt['product_detail_layout'] . '.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-single-product-' . $nasa_opt['product_detail_layout'] . '.php';
    }
endif;

/**
 * Custom Tabs
 */
if (!function_exists('elessi_custom_tabs_single_product')) :
    function elessi_custom_tabs_single_product($tabs) {
        global $nasa_opt;

        /**
         * Remove Additional tab
         */
        if (
            isset($tabs['additional_information']) &&
            isset($nasa_opt['hide_additional_tab']) &&
            $nasa_opt['hide_additional_tab']
        ) {
            unset($tabs['additional_information']);
        }

        return $tabs;
    }
endif;

/**
 * Hide Uncategorized
 */
if (!function_exists('elessi_hide_uncategorized')) :
    function elessi_hide_uncategorized($args) {
        $args['exclude'] = get_option('default_product_cat');
        return $args;
    }
endif;

/**
 * Before Share WooCommerce
 */
if (!function_exists('elessi_before_woocommerce_share')) :
    function elessi_before_woocommerce_share() {
        echo '<hr class="nasa-single-hr" /><div class="nasa-single-share">';
    }
endif;

/**
 * Custom Share WooCommerce
 */
if (!function_exists('elessi_woocommerce_share')) :
    function elessi_woocommerce_share() {
        echo shortcode_exists('nasa_share') ? do_shortcode('[nasa_share label="1"]') : '';
    }
endif;

/**
 * After Share WooCommerce
 */
if (!function_exists('elessi_after_woocommerce_share')) :
    function elessi_after_woocommerce_share() {
        echo '</div>';
    }
endif;

/**
 * Before desc of Archive
 */
if (!function_exists('elessi_before_archive_description')) :
    function elessi_before_archive_description() {
        echo '<div class="nasa_shop_description page-description padding-top-20">';
    }
endif;

/**
 * After desc of Archive
 */
if (!function_exists('elessi_after_archive_description')) :
    function elessi_after_archive_description() {
        echo '</div>';
    }
endif;

/**
 * Open wrap 12 columns
 */
if (!function_exists('elessi_open_wrap_12_cols')) :
    function elessi_open_wrap_12_cols() {
        echo '<div class="row"><div class="large-12 columns">';
    }
endif;

/**
 * Close wrap 12 columns
 */
if (!function_exists('elessi_close_wrap_12_cols')) :
    function elessi_close_wrap_12_cols() {
        echo '</div></div>';
    }
endif;

/**
 * Begin wrap in Mobile App
 */
if (!function_exists('elessi_begin_wrap')) :
    function elessi_begin_wrap() {
        echo '<div class="ns-begin-wrap nasa-crazy-box">';
    }
endif;

/**
 * Begin wrap Flex in Mobile App
 */
if (!function_exists('elessi_begin_wrap_flex')) :
    function elessi_begin_wrap_flex() {
        echo '<div class="ns-begin-wrap nasa-crazy-box nasa-flex">';
    }
endif;

/**
 * End wrap in Mobile App
 */
if (!function_exists('elessi_end_wrap')) :
    function elessi_end_wrap() {
        echo '</div>';
    }
endif;

/**
 * shopping cart subtotal
 */
if (!function_exists('elessi_widget_shopping_cart_subtotal')) :
    function elessi_widget_shopping_cart_subtotal() {
        echo '<span class="total-price-label">' . esc_html__('Subtotal', 'elessi-theme') . '</span>';
        echo '<span class="total-price right">' . WC()->cart->get_cart_subtotal() . '</span>';
    }
endif;

/**
 * shopping cart ext
 */
if (!function_exists('elessi_widget_shopping_cart_ext')) :
    function elessi_widget_shopping_cart_ext() {
        global $nasa_opt;
        
        $coupon_enable = $shipping_enable = false;
        
        if ((isset($nasa_opt['mini_cart_coupon']) && $nasa_opt['mini_cart_coupon']) && wc_coupons_enabled()) {
            $coupon_enable = true;
        }
        
        if (isset($nasa_opt['mini_cart_shipping']) && $nasa_opt['mini_cart_shipping']) {
            $shipping_enable = 'no' === get_option('woocommerce_enable_shipping_calc') || !WC()->cart->needs_shipping() ? false : true;
        }
        
        $total_enable = $coupon_enable || $shipping_enable ? true : false;
        if (!$total_enable) {
            return;
        }
        
        /**
         * Coupon
         */
        if ($coupon_enable) {
            $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-cart-coupons.php';
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-cart-coupons.php';
        }
        
        /**
         * Shipping
         */
        if ($shipping_enable) {
            $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-cart-shipping.php';
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-cart-shipping.php';
        }
        
        /**
         * Fees
         */
        $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-cart-fees.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-cart-fees.php';

        /**
         * Tax
         */
        $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-cart-taxs.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-cart-taxs.php';

        /**
         * Total
         */
        $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-cart-total.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-cart-total.php';
    }
endif;

/**
 * Extend Mini Cart From Cart
 */
if (!function_exists('elessi_ext_mini_cart')) :
    function elessi_ext_mini_cart() {
        global $nasa_opt;
        
        $ext_content = '';
        $content_notes = '';
        
        /**
         * Add Note
         */
        if (isset($nasa_opt['mini_cart_note']) && $nasa_opt['mini_cart_note'] && apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))) {
            $ext_content .= '<a href="javascript:void(0);" class="ext-mini-cart mini-cart-note nasa-bold" data-act="note" rel="nofollow"><svg width="22" height="25" viewBox="0 0 32 32" fill="currentColor"><path d="M27.78 4.198c-0.312-0.312-0.722-0.468-1.131-0.468s-0.819 0.156-1.131 0.468l-4.706 4.705v-0.891h-17.060v20.259h20.259v-17.060h-0.981l4.75-4.751c0.625-0.624 0.625-1.637 0-2.262zM22.944 27.204h-18.126v-18.126h15.819l-8.356 8.355v2.307h2.219l8.444-8.445v15.908zM27.026 5.706l-12.967 12.968h-0.711v-0.8l12.924-12.924c0.135-0.135 0.294-0.155 0.376-0.155s0.242 0.020 0.377 0.156c0.136 0.136 0.157 0.295 0.157 0.377s-0.020 0.24-0.157 0.377z"/></svg>' . esc_html__('Note', 'elessi-theme') . '</a>';
            
            /**
             * Content Note
             */
            $content_notes .= '<div class="ext-node mini-cart-note">';
            $content_notes .= '<a href="javascript:void(0);" title="Close" class="nasa-close-node nasa-stclose" rel="nofollow"></a>';

            ob_start();
            $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-cart-note.php';
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-cart-note.php';
            $content_notes .= ob_get_clean();

            $content_notes .= '</div>';
        }
        
        /**
         * Add Shipping
         */
        if (
            isset($nasa_opt['mini_cart_shipping']) &&
            $nasa_opt['mini_cart_shipping']
        ) {
            $shipping_enable = 'no' === get_option('woocommerce_enable_shipping_calc') || ! WC()->cart->needs_shipping() ? false : true;
            if ($shipping_enable) {
                $ext_content .= '<span class="nssp"></span>';
                $ext_content .= '<a href="javascript:void(0);" class="ext-mini-cart mini-cart-shipping nasa-bold" data-act="shipping" rel="nofollow"><svg class="nasa-flip-vertical" fill="currentColor" height="25" width="22" viewBox="0 0 512 512"><path d="M508 202c0 19 3 43 0 59-3 24-23 45-36 63-14 19-26 42-46 50-28 14-78 0-112 4-2 27 7 63-17 71-7 4-23 3-34 3-87 0-178 0-259 0-2 0-2-3-2-3 0-3 0-7 0-11 84 0 172 0 255 0 12 0 28 3 35-1 15-5 9-49 9-69 0-77 1-158-2-230-35-2-74-2-109 0-6 27-23 49-51 52-34 3-59-22-65-52-20 2-50-6-58 8-3 30 2 68-3 97-2 0-6 0-9 0-2-16-2-33-2-51 0-17-2-36 3-50 8-24 41-15 69-18 6-39 50-65 87-44 15 8 25 25 30 44 51 2 108 2 159 0 7-27 28-50 57-52 31-1 55 23 62 52 20 0 35 5 38 21 5 14 1 39 1 57z m-372-117c-58-4-65 83-10 91 21 3 39-9 45-19 21-34-7-70-35-72z m252 278c3 3 20 4 29 2 19-5 33-33 45-49 15-20 32-38 33-62-22-3-49-2-76-2-13 0-28-2-31 9-6 11-3 31-3 51 0 19 0 43 3 51z m25-278c-27-2-47 21-48 45 0 26 17 43 37 46 30 5 53-18 53-46 0-24-19-43-42-45z m56 53c-7 25-23 48-51 52-24 2-48-11-59-33-4-6-4-12-8-19-10 0-26-2-36 0-1 71 0 145-1 216 5 18 39 9 58 11 8-39-15-114 20-125 15-5 35-1 54-1 16 0 35 3 50-1 2-12 0-29 0-46 0-30 6-60-27-54z m-288 273c-59 0-118 0-176 0-1 0-1-3-1-3 0-3 0-7 0-11 59 0 118 0 177 0 0 5 0 10 0 14z m-177-56c48 0 97 0 146 0 0 5 0 8 0 13-49 0-97 0-145 0-3-2-1-8-1-13z m0-42c38 0 76 0 114 0 0 5 0 8 0 13-37 0-76 0-113 0-3-2-1-8-1-13z m0-41c27 0 56 0 84 0 0 5 0 8 0 13-28 0-55 0-83 0-3-2-1-10-1-13z"/></svg>' . esc_html__('Shipping', 'elessi-theme') . '</a>';
                
                /**
                 * Content Shipping
                 */
                $content_notes .= '<div class="ext-node mini-cart-shipping">';
                $content_notes .= '<a href="javascript:void(0);" title="Close" class="nasa-close-node nasa-stclose" rel="nofollow"></a>';
                $content_notes .= '<p class="node-title nasa-bold fs-20 mobile-fs-18">' . esc_html__('Estimate shipping rates', 'elessi-theme') . '</p>';

                ob_start();
                woocommerce_shipping_calculator();
                $content_notes .= ob_get_clean();

                $content_notes .= '</div>';
            }
        }
        
        /**
         * Add Coupon
         */
        if (isset($nasa_opt['mini_cart_coupon']) && $nasa_opt['mini_cart_coupon'] && wc_coupons_enabled()) {
            $ext_content .= '<span class="nssp"></span>';
            $ext_content .= '<a href="javascript:void(0);" class="ext-mini-cart mini-cart-coupon nasa-bold" data-act="coupon" rel="nofollow"><svg class="ns-coupon-icon" width="18" height="25" viewBox="0 0 32 32" fill="currentColor"><path d="M2784 4905 c-34 -7 -77 -21 -95 -30 -19 -9 -573 -555 -1232 -1213 -893 -892 -1205 -1210 -1225 -1247 -23 -43 -27 -62 -27 -135 0 -69 4 -93 24 -130 34 -66 1848 -1882 1916 -1918 43 -23 62 -27 135 -27 73 0 92 4 135 27 37 20 355 332 1247 1225 658 659 1204 1213 1213 1231 43 87 45 122 45 1044 0 877 0 878 -22 945 -18 57 -32 79 -88 134 -57 58 -75 70 -134 88 -67 21 -81 21 -950 20 -694 0 -894 -3 -942 -14z m1844 -220 c18 -11 43 -36 55 -55 l22 -35 0 -870 c0 -669 -3 -878 -12 -905 -10 -26 -333 -355 -1197 -1219 -1073 -1073 -1187 -1184 -1216 -1184 -29 0 -119 87 -947 916 -829 828 -916 918 -916 947 0 29 110 142 1179 1211 648 649 1188 1185 1199 1191 41 23 151 26 965 24 816 -1 836 -1 868 -21z"/><path d="M3895 4396 c-70 -18 -130 -51 -186 -103 -227 -212 -138 -601 158 -693 147 -45 294 -13 407 91 172 157 178 428 13 593 -106 107 -249 147 -392 112z m183 -225 c70 -36 112 -102 112 -176 0 -154 -162 -249 -293 -172 -175 103 -107 365 96 367 28 0 63 -8 85 -19z"/></svg>' . esc_html__('Coupon', 'elessi-theme') . '</a>';
            
            /**
             * Content Coupon
             */
            $content_notes .= '<div class="ext-node mini-cart-coupon">';
            $content_notes .= '<a href="javascript:void(0);" title="Close" class="nasa-close-node nasa-stclose" rel="nofollow"></a>';

            ob_start();
            $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-cart-add-coupon.php';
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-cart-add-coupon.php';
            $content_notes .= ob_get_clean();

            $content_notes .= '</div>';
        }
        
        /**
         * Output
         */
        if ($ext_content) {
            echo '<div class="nasa-flex flex-wrap jse ext-mini-cart-wrap">' . $ext_content . '</div>';
            
            if ($content_notes !== '') {
                echo '<div class="ext-nodes-wrap">' . $content_notes . '</div>';
                // echo '<div class="mini-cart-ajax-nonce hidden"></div>';
            }
        }
    }
endif;

/**
 * Get orders_comments from session
 */
add_filter('default_checkout_order_comments', 'elessi_order_comments_session');
if (!function_exists('elessi_order_comments_session')) :
    function elessi_order_comments_session($value) {
        $note = WC()->session->get('nasa_order_comments');
        return $note ? $note : $value;
    }
endif;

/**
 * Clear session nasa_order_comments
 */
add_action('woocommerce_thankyou', 'elessi_order_comments_session_clear');
if (!function_exists('elessi_order_comments_session_clear')) :
    function elessi_order_comments_session_clear() {
        WC()->session->set('nasa_order_comments', null);
    }
endif;

/**
 * elessi_wc_form_field_args
 */
if (!function_exists('elessi_wc_form_field_args')) :
    function elessi_wc_form_field_args($args) {
        if (isset($args['label']) && (!isset($args['placeholder']) || $args['placeholder'] == '')) {
            $args['placeholder'] = strip_tags($args['label']);
        }
    
        return $args;
    }
endif;

/**
 * Hook woocommerce_before_main_content
 */
if (!function_exists('elessi_open_woo_main')) :
    function elessi_open_woo_main() {
        global $nasa_opt;

        $class = 'nasa-ajax-store-content';
        
        if (isset($nasa_opt['transition_load']) && $nasa_opt['transition_load'] == 'crazy') :
            $class .= ' nasa-crazy-load crazy-loading';
        endif;

        echo '<!-- Begin Ajax Store Wrap --><div class="nasa-ajax-store-wrapper"><div id="nasa-ajax-store" class="' . $class . '">';
        
        if (!isset($nasa_opt['disable_ajax_product_progress_bar']) || $nasa_opt['disable_ajax_product_progress_bar'] != 1) :
            echo '<div class="nasa-progress-bar-load-shop"><div class="nasa-progress-per"></div></div>';
        endif;
        
        /**
         * For Ajax in Single Product Page
         */
        if (defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT) :
            wp_enqueue_script('wc-add-to-cart-variation');
        endif;
    }
endif;

/**
 * Hook woocommerce_after_main_content
 */
if (!function_exists('elessi_close_woo_main')) :
    function elessi_close_woo_main() {
        echo '</div></div><!-- End Ajax Store Wrap -->';
    }
endif;

/**
 * Hook woocommerce_before_variations_form
 */
if (!function_exists('elessi_open_variants_wrap')) :
    function elessi_open_variants_wrap() {
        echo '<div class="ns-info-variants">';
    }
endif;

/**
 * Hook woocommerce_after_variations_form
 */
if (!function_exists('elessi_close_variants_wrap')) :
    function elessi_close_variants_wrap() {
        echo '</div>';
    }
endif;

/**
 * Hook elessi_hook_column_crs_popup
 */
if (!function_exists('elessi_hook_column_crs_popup')) :
    function elessi_hook_column_crs_popup() {
        add_filter('ns_crs_columns_desk', function($column){
            return ($column > 4) ? 4 : $column;
        });
    }
endif;
