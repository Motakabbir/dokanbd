<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Footer output
 * since 4.0
 */
add_action('nasa_footer_layout_style', 'elessi_footer_output');
if (!function_exists('elessi_footer_output')) :
    function elessi_footer_output() {
        global $nasa_opt;
        
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
        $footer_mode = isset($nasa_opt['footer_mode']) ? $nasa_opt['footer_mode'] : 'builder';
        $footer_mode = $footer_mode == 'builder-e' && !NASA_HF_BUILDER ? 'builder' : $footer_mode;
        
        if (!isset($nasa_opt['f_buildin']) || !$nasa_opt['f_buildin']) {
            $footer_mode = $footer_mode == 'build-in' ? 'builder' : $footer_mode;
        }
        
        /**
         * Init Footer Builder - WPBakery
         */
        $footer_builder = isset($nasa_opt['footer-type']) ? $nasa_opt['footer-type'] : false;
        $footer_builder_m = isset($nasa_opt['footer-mobile']) ? $nasa_opt['footer-mobile'] : false;
        $footer_builder_m = $footer_builder_m == 'default' ? $footer_builder : $footer_builder_m;
        
        /**
         * Init Footer Build-in - WP Widgets
         */
        $footer_buildin = isset($nasa_opt['footer_build_in']) ? $nasa_opt['footer_build_in'] : false;
        $footer_buildin_m = isset($nasa_opt['footer_build_in_mobile']) ? $nasa_opt['footer_build_in_mobile'] : false;
        $footer_buildin_m = $footer_buildin_m === '' ? $footer_buildin : $footer_buildin_m; // Ext-Desktop
        
        /**
         * Init Footer Builder - HEF Elementor
         */
        $footer_builder_e = isset($nasa_opt['footer_elm']) ? $nasa_opt['footer_elm'] : false;
        $footer_builder_e_m = isset($nasa_opt['footer_elm_mobile']) ? $nasa_opt['footer_elm_mobile'] : false;
        $footer_builder_e_m = $footer_builder_e_m ? $footer_builder_e_m : $footer_builder_e; // Ext-Desktop
        
        $footer = false;
        
        if ($footer_mode == 'builder') {
            $footer = $in_mobile ? $footer_builder_m : $footer_builder;
        }
        
        if ($footer_mode == 'builder-e') {
            $footer = $in_mobile ? $footer_builder_e_m : $footer_builder_e;
        }
        
        if ($footer_mode == 'build-in') {
            $footer = $in_mobile ? $footer_buildin_m : $footer_buildin;
        }
        
        if (!$footer) {
            return;
        }
        
        do_action('nasa_before_footer_output');
        
        if ($footer_mode == 'builder') {
            elessi_footer_builder($footer);
        }
        
        if ($footer_mode == 'builder-e') {
            elessi_footer_builder_elementor($footer);
        }
        
        if ($footer_mode == 'build-in') {
            elessi_footer_build_in($footer);
        }
        
        do_action('nasa_after_footer_output');
    }
endif;


/**
 * Open wrap Footer
 */
add_action('nasa_before_footer_output', 'elessi_before_footer_output');
if (!function_exists('elessi_before_footer_output')) :
    function elessi_before_footer_output() {
        echo '<!-- MAIN FOOTER --><footer id="nasa-footer" class="footer-wrapper nasa-clear-both">';
    }
endif;

/**
 * Close wrap Footer
 */
add_action('nasa_after_footer_output', 'elessi_after_footer_output');
if (!function_exists('elessi_after_footer_output')) :
    function elessi_after_footer_output() {
        echo '</footer><!-- END MAIN FOOTER -->';
    }
endif;

/**
 * Footer Builder
 */
if (!function_exists('elessi_footer_builder')) :
    function elessi_footer_builder($footer_slug) {
        if (!function_exists('nasa_get_footer')) {
            return;
        }

        /**
         * get footer content
         */
        echo nasa_get_footer($footer_slug);
    }
endif;

/**
 * Footer Builder Elementor
 */
if (!function_exists('elessi_footer_builder_elementor')) :
    function elessi_footer_builder_elementor($footer_id) {
        if (apply_filters('ns_hfe_template_render_focus', false)) {
            global $nasa_footer_hfe;
            
            echo $nasa_footer_hfe ? $nasa_footer_hfe : '';
        } else {
            if (!function_exists('nasa_hfe_shortcode_by_id')) {
                return;
            }

            nasa_hfe_shortcode_by_id($footer_id);
        }
    }
endif;

/**
 * Footer Build-in
 */
if (!function_exists('elessi_footer_build_in')) :
    function elessi_footer_build_in($footer) {
        $file = ELESSI_CHILD_PATH . '/footers/footer-built-in-' . $footer . '.php';
        $real_file = is_file($file) ? $file : ELESSI_THEME_PATH . '/footers/footer-built-in-' . $footer . '.php';
        
        if (is_file($real_file)) {
            include $real_file;
        }
    }
endif;

/**
 * Footer run static content
 */
add_action('wp_footer', 'elessi_run_static_content', 9);
if (!function_exists('elessi_run_static_content')) :
    function elessi_run_static_content() {
        /**
         * support Multi vendorX with Vendor Dashboard
         */
        if (function_exists('mvx_plugin_init')) {
            $is_vendor_dashboard = is_vendor_dashboard() && is_user_logged_in() && (is_user_mvx_vendor(get_current_user_id()) || is_user_mvx_pending_vendor(get_current_user_id()) || is_user_mvx_rejected_vendor(get_current_user_id())) && apply_filters('mvx_vendor_dashboard_dequeue_global_styles', true);
            if ($is_vendor_dashboard) {
                return;
            }
        }
        
        do_action('nasa_before_static_content');
        do_action('nasa_static_content');
        do_action('nasa_after_static_content');
    }
endif;

/**
 * Group static buttons
 */
add_action('nasa_static_content', 'elessi_static_group_btns', 10);
if (!function_exists('elessi_static_group_btns')) :
    function elessi_static_group_btns() {
        echo '<!-- Start static group buttons -->';
        echo '<div class="nasa-static-group-btn">';
        
        do_action('nasa_static_group_btns');
        
        echo '</div>';
        echo '<!-- End static group buttons -->';
    }
endif;

/**
 * Back to top buttons
 */
add_action('nasa_static_group_btns', 'elessi_static_back_to_top_btns');
if (!function_exists('elessi_static_back_to_top_btns')) :
    function elessi_static_back_to_top_btns() {
        global $nasa_opt;
        
        if (isset($nasa_opt['back_to_top']) && !$nasa_opt['back_to_top']) {
            return;
        }
        
        $btns = '<a href="javascript:void(0);" id="nasa-back-to-top" class="nasa-tip nasa-tip-left" data-tip="' . esc_attr__('Back to Top', 'elessi-theme') . '" rel="nofollow"><svg width="38" height="45" viewBox="0 0 32 32" fill="currentColor"><path d="M16.767 12.809l-0.754-0.754-6.035 6.035 0.754 0.754 5.281-5.281 5.256 5.256 0.754-0.754-3.013-3.013z" /></svg></a>';
        
        echo apply_filters('nasa_back_to_top_button', $btns);
    }
endif;


/**
 * Located in menu - Where You are
 */
add_action('nasa_static_group_btns', 'elessi_static_where_you_are_btns');
if (!function_exists('elessi_static_where_you_are_btns')) :
    function elessi_static_where_you_are_btns() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['where_you_are']) || !$nasa_opt['where_you_are']) {
            return;
        }
        
        $btns = '<a href="javascript:void(0);" id="nasa-where-you-are" class="nasa-tip nasa-tip-left" data-tip="' . esc_attr__('Where You Are', 'elessi-theme') . '" rel="nofollow"><svg width="26" height="26" viewBox="0 0 25 32">
        <path d="M16 17.333l-3.2-1.813v-6.507c1.813-0.267 3.2-1.813 3.2-3.68 0-2.080-1.653-3.733-3.733-3.733s-3.733 1.653-3.733 3.733c0 1.867 1.387 3.413 3.2 3.68v5.867l-3.2-1.813-8.533 3.467v13.067l8.533-3.467 7.467 4.267 8.533-4.267v-13.067l-8.533 4.267zM7.467 25.44l-6.4 2.56v-10.773l6.4-2.613v10.827zM9.6 5.333c0-1.493 1.173-2.667 2.667-2.667s2.667 1.173 2.667 2.667c0 1.493-1.173 2.667-2.667 2.667s-2.667-1.173-2.667-2.667zM16 29.227l-7.467-4.267v-10.667l3.2 1.813v4.693h1.067v-4.107l3.2 1.813v10.72zM23.467 25.493l-6.4 3.2v-10.667l6.4-3.2v10.667z" fill="currentColor"/>
        </svg></a>';
        
        echo apply_filters('nasa_where_you_are', $btns);
    }
endif;

/**
 * static_content
 */
add_action('nasa_static_content', 'elessi_static_content_before', 10);
if (!function_exists('elessi_static_content_before')) :
    function elessi_static_content_before() {
        echo '<!-- Start static tags -->' .
            '<div class="nasa-check-reponsive nasa-desktop-check"></div>' .
            '<div class="nasa-check-reponsive nasa-tablet-check"></div>' .
            '<div class="nasa-check-reponsive nasa-mobile-check"></div>' .
            '<div class="nasa-check-reponsive nasa-switch-check"></div>' .
            '<div class="black-window hidden-tag"></div>' .
            '<div class="white-window hidden-tag"></div>' .
            '<div class="transparent-window hidden-tag"></div>' .
            '<div class="transparent-mobile hidden-tag"></div>' .
            '<div class="black-window-mobile"></div>';
    }
endif;

/**
 * Mobile static
 */
add_action('nasa_static_content', 'elessi_static_for_mobile', 12);
if (!function_exists('elessi_static_for_mobile')) :
    function elessi_static_for_mobile() {
        global $nasa_opt;
        
        /**
         * Search for Mobile
         */
        $search_form_file = ELESSI_CHILD_PATH . '/includes/nasa-mobile-product-searchform.php';
        if (is_file($search_form_file)) {
            include $search_form_file; // For Override old file
        } else {
            echo '<div class="warpper-mobile-search hidden-tag">';
            elessi_search_mobile();
            echo '</div>';
        }
        
        /**
         * Menu Account for Mobile
         */
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        $main_screen = isset($nasa_opt['main_screen_acc_mobile']) && !$nasa_opt['main_screen_acc_mobile'] ? false : true;
        
        if (!$main_screen || !$in_mobile) {
            if (!isset($nasa_opt['hide_tini_menu_acc']) || !$nasa_opt['hide_tini_menu_acc']) {
                $mobile_acc_file = ELESSI_CHILD_PATH . '/includes/nasa-mobile-account.php';
                include is_file($mobile_acc_file) ? $mobile_acc_file : ELESSI_THEME_PATH . '/includes/nasa-mobile-account.php';
            }
        }
    }
endif;

/**
 * Static Cart sidebar
 */
add_action('nasa_static_content', 'elessi_static_cart_sidebar', 13);
if (!function_exists('elessi_static_cart_sidebar')) :
    function elessi_static_cart_sidebar() {
        global $nasa_opt;
        
        if (!NASA_WOO_ACTIVED || (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart'])) {
            return;
        }
        
        $nasa_cart_style = 'nasa-static-sidebar ';
        $nasa_cart_style .= isset($nasa_opt['style-cart']) ? $nasa_opt['style-cart'] : 'style-1';
        ?>
        
        <script type="text/template" id="ns-cart-sidebar-loading-item">
            <div class="nasa-minicart-items-empty">
                <div class="sidebar-minicart-items-mask nasa-flex align-start">
                    <div class="nasa-mask-lv1 ns-mask-load"></div>
                    <div class="nasa-mask-lv1">
                        <div class="nasa-mask-lv2 ns-mask-load"></div>
                        <div class="nasa-mask-lv2 ns-mask-load"></div>
                        <div class="nasa-mask-lv2 ns-mask-load"></div>
                        <div class="nasa-mask-lv2 ns-mask-load"></div>
                    </div>
                </div>
            </div>
        </script>

        <script type="text/template" id="ns-cart-sidebar-loading-footer">
            <div class="nasa-mask-lv1">
                <div class="nasa-flex ext-mini-cart-wrap-empty jsa">
                    <span class="nasa-mask-lv2 ns-mask-load"></span>
                    <span class="ns-line-ver"></span>
                    <span class="nasa-mask-lv2 ns-mask-load"></span>
                    <span class="ns-line-ver"></span>
                    <span class="nasa-mask-lv2 ns-mask-load"></span>
                </div>
                <span class="ns-line"></span>
                <div class="nasa-mask-lv2 ns-mask-load nasa-float-left nasa-block ns-width-40"></div>
                <div class="nasa-mask-lv2 ns-mask-load nasa-float-right nasa-block ns-width-30"></div>
                <span class="ns-line"></span>
                <div class="nasa-mask-lv2 ns-mask-load nasa-float-left nasa-block ns-width-35"></div>
                <div class="nasa-mask-lv2 ns-mask-load nasa-float-right nasa-block ns-width-20"></div>
            </div>
            <div class="nasa-mask-lv1 btn-mini-cart">
                <div class="nasa-mask-lv2 ns-mask-load"></div>
                <div class="nasa-mask-lv2 ns-mask-load"></div>
            </div>
        </script>
        

        <div id="cart-sidebar" data-variation-product-adding="" class="<?php echo esc_attr($nasa_cart_style); ?>">
            <!-- canvas id="nasa-confetti" style="position:absolute; top:0; left:0; display:none; z-index:99;"></canvas -->
            
            <div class="cart-close nasa-sidebar-close">
                <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>" rel="nofollow">
                    <svg width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg>
                </a>

                <span class="nasa-tit-mycart nasa-sidebar-tit text-center" data_text_adding="<?php echo esc_html__('Adding', 'elessi-theme')?>" >
                    <?php echo esc_html__('My Cart', 'elessi-theme'); ?>
                </span>
            </div>
            
            <div class="widget_shopping_cart_content">
                <input type="hidden" name="nasa-mini-cart-empty-content" />
            </div>
            
            <?php if (apply_filters('nasa_cart_sidebar_show', (isset($_REQUEST['nasa_cart_sidebar']) && $_REQUEST['nasa_cart_sidebar'] == 1 ? true : false))) : ?>
                <input type="hidden" name="nasa_cart_sidebar_show" value="1" />
            <?php endif; ?>
        </div>

        <?php
    }
endif;

/**
 * Static Cart Popup
 */
add_action('nasa_static_content', 'elessi_static_cart_popup', 13);
if (!function_exists('elessi_static_cart_popup')) :
    function elessi_static_cart_popup() {
        global $nasa_opt;

        if (!NASA_WOO_ACTIVED || (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart'])) {
            return;
        }
        
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        if ($in_mobile) {
            return;
        }
        
        //p-modern-8
        // $ns_opt_modern_8 = (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] == 'modern-8')? 'ns-opt-modern-8':'';
        $ns_opt_modern_8 ='';
        if (isset($nasa_opt['event-after-add-to-cart']) && $nasa_opt['event-after-add-to-cart'] == 'popup') {
            echo '<div class="ns-cart-popup-wrap"><a class="popup-cart-bg-close" href="javascript:void(0);" title="' . esc_attr__('Close (Esc)', 'elessi-theme') . '" rel="nofollow"></a><div class="ns-cart-popup-container"><div id="ns-cart-popup" class="ns-cart-popup"></div></div></div>';
        }

        if (isset($nasa_opt['event-after-add-to-cart']) && $nasa_opt['event-after-add-to-cart'] == 'popup_2') {

            echo '<div class="ns-cart-popup-wrap"><a class="popup-cart-bg-close" href="javascript:void(0);" title="' . esc_attr__('Close (Esc)', 'elessi-theme') . '" rel="nofollow"></a><div class="ns-cart-popup-container ns-popup-container_v2 ' . $ns_opt_modern_8 . '"><div id="ns-cart-popup" class="nasa-after-add-to-cart-wrap ns-cart-popup ns-cart-popup-v2">'.
            '<a class="nasa-stclose popup-cart-close" href="javascript:void(0);" title="' . esc_attr__('Close (Esc)', 'elessi-theme') . '" rel="nofollow"></a>'.
            
            // $cart_close .
            '<div class="widget_shopping_cart_content_popup_v2" >' .
                '<div class="nasa-minicart-items">' .
                    '<h3 class="nasa-title-after-add-to-cart" data_text_added="' . esc_attr__('Adding cart', 'elessi-theme') . '">' . esc_html__('Successfully added to your cart.', 'elessi-theme') . '</h3>'.
                    '<div class="woocommerce-mini-cart cart_list product_list_widget ">' .
                        '<div class="popup2-minicart-items-mask nasa-flex">' .
                            '<div class="nasa-mask-lv1 ns-mask-load"></div>' .
                            '<div class="nasa-mask-lv1">' .
                                '<div class="nasa-mask-lv2 ns-mask-load"></div>' .
                                '<div class="nasa-mask-lv2 ns-mask-load"></div>' .
                                '<div class="nasa-mask-lv2 ns-mask-load"></div>' .
                            '</div>' .
                        '</div>' .
                    '</div>' .
                '</div>' .
                '<div class="nasa-minicart-footer nasa-bold">'.
                '<span class="ns_total_item margin-bottom-10 nasa-bold ns-mask-load"> There are <span class="primary-color"> 0 item</span> in your cart.</span>' .
                // wp_kses(__('<span class="ns_total_item margin-bottom-10 nasa-bold ns-mask-load"> There are <span class="primary-color"> 0 item</span> in your cart.</span>', 'elessi-theme'), array('span' => array())) .
                '</div>' .
            '</div>' .
            '</div></div></div>';
        }
    }
endif;

/**
 * Static Block Popup
 */
add_action('nasa_static_content', 'elessi_static_block_popup', 33);
if (!function_exists('elessi_static_block_popup')) :
    function elessi_static_block_popup() {
        global $nasa_opt,$content_width,$wp_query;
        $content_width = !isset($content_width) ? 1200 : $content_width;
        $plus_width = (isset($nasa_opt['plus_wide_width']) && (int) $nasa_opt['plus_wide_width'] > 0) ? $nasa_opt['plus_wide_width'] : '';
        $popup = isset($nasa_opt['nasa_popup_static_block']) ? $nasa_opt['nasa_popup_static_block'] : '';

        $object = $wp_query->get_queried_object();
        if ($object) {
            $page_options = isset($object->post_type) && $object->post_type == 'page' ? true : false;
            $object_id = $page_options ? $object->ID : 0;
            $custom_popup = get_post_meta($object_id, '_nasa_popup_static_block', true);
            $popup = isset($custom_popup) && $custom_popup != '' ? $custom_popup : $popup;

            $plus_width_alow = get_post_meta($object_id, '_nasa_plus_wide_option', true);
            if ($plus_width_alow === '1') {
                $plus_width = get_post_meta($object_id, '_nasa_plus_wide_width', true);
            } elseif ($plus_width_alow === '-1') {
                $plus_width = 0; 
            }
        }

        $root_cat_id = nasa_root_term_id();
        if ($root_cat_id) {
            $custom_popup = get_term_meta($root_cat_id, 'cat_popup_static_block', true);
            $popup = isset($custom_popup) && $custom_popup != '' ? $custom_popup : $popup;

            $plus_width_alow = get_term_meta($root_cat_id, 'cat_width_more_allow', true);
            if ($plus_width_alow === '1') {
                $plus_width = get_term_meta($root_cat_id, 'cat_width_more', true);
            } elseif ($plus_width_alow === '-1') {
                $plus_width = 0;
            }
        }

        $default_width = ($plus_width != '' && (int) $plus_width >= 0) ? ($content_width + (int) $plus_width) : $content_width;

        if (!isset($popup) || in_array($popup,array('','select','default'))) {
            return;
        }

        echo '<template class="ns-template-static-block-popup"><div class="ns-static-block-popup" style="width: ' . $default_width . 'px; max-width: 100%;">' . elessi_get_block($popup) . '</div></template>';

    }
endif;

/**
 * After Added to cart Popup - v1
 */
add_filter('woocommerce_add_to_cart_fragments', 'elessi_fragments_cart_popup');
if (!function_exists('elessi_fragments_cart_popup')) :
function elessi_fragments_cart_popup($fragment) {
    global $nasa_opt;

    if (!isset($nasa_opt['event-after-add-to-cart']) || $nasa_opt['event-after-add-to-cart'] !== 'popup') {
        return $fragment;
    }
    
    $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
    if ($in_mobile) {
        return;
    }
    
    ob_start();
    $file = ELESSI_CHILD_PATH . '/includes/nasa-after-add-to-cart.php';
    $file = is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-after-add-to-cart.php';

    ob_start();
    include $file;
    
    $cart_popup = ob_get_clean();

    $fragment['.ns-cart-popup'] = '<div id="ns-cart-popup" class="nasa-after-add-to-cart-wrap ns-cart-popup ">' . $cart_popup . '</div>';
    
    return $fragment;
}
endif;

/**
 * After Added to cart Popup - v2
 */
add_filter('woocommerce_add_to_cart_fragments', 'elessi_fragments_cart_popup_v2');
if (!function_exists('elessi_fragments_cart_popup_v2')) :
    function elessi_fragments_cart_popup_v2($fragment) {
        global $nasa_opt;

        if (!isset($nasa_opt['event-after-add-to-cart']) || $nasa_opt['event-after-add-to-cart'] !== 'popup_2') {
            return $fragment;
        }

        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        if ($in_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app') {
            return $fragment;
        }
        
        $total = WC()->cart->get_cart_contents_count();
        
        $p = isset($_POST['variation_id']) && $_POST['variation_id'] ? $_POST['variation_id'] : '';
        
        if (!$p) {
            $pid = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
            $pid_sgl = isset($_POST['data-product_id']) ? $_POST['data-product_id'] : 0;
            $pid_qty = isset($_POST['product_id_qty']) ? $_POST['product_id_qty'] : 0;
            
            $p = $pid ? $pid : ($pid_sgl ? $pid_sgl : ($pid_qty ? $pid_qty : ''));
        }

        $fragment['.ns_total_item'] = 
        '<span class="ns_total_item margin-bottom-10 nasa-bold ns-mask-load" data-id-just-added="' . $p . '">' . sprintf(_n('There is <span class="primary-color"> %s item</span> in your cart.', 'There are <span class="primary-color"> %s items</span> in your cart.', $total, 'elessi-theme'), $total) . '</span>';
        
        return $fragment;
    }
endif;

/**
 * Static Wishlist sidebar
 */
add_action('nasa_static_content', 'elessi_static_wishlist_sidebar', 14);
if (!function_exists('elessi_static_wishlist_sidebar')) :
    function elessi_static_wishlist_sidebar() {
        if (!NASA_WOO_ACTIVED) {
            return;
        }
        
        global $nasa_opt;
        
        if (NASA_WISHLIST_ENABLE) {
            echo '<input type="hidden" name="nasa_yith_wishlist_actived" value="1" />';
        }
        
        if (!NASA_WISHLIST_ENABLE) {
            if (isset($nasa_opt['enable_nasa_wishlist']) && !$nasa_opt['enable_nasa_wishlist']) {
                return;
            }
            
            $nasa_wishlist = function_exists('elessi_woo_wishlist') ? elessi_woo_wishlist() : null;
            if ($nasa_wishlist) {
                echo '<input type="hidden" name="nasa_wishlist_cookie_name" value="' . $nasa_wishlist->get_cookie_name() . '" />';
            }
        }
        
        $nasa_wishlist_style = 'nasa-static-sidebar ';
        $nasa_wishlist_style .= isset($nasa_opt['style-wishlist']) ? $nasa_opt['style-wishlist'] : 'style-1';
        ?>
        
        <div id="nasa-wishlist-sidebar" class="<?php echo esc_attr($nasa_wishlist_style); ?>">
            <div class="wishlist-close nasa-sidebar-close">
                <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>" rel="nofollow">
                    <svg width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg>
                </a>
                
                <span class="nasa-tit-wishlist nasa-sidebar-tit text-center">
                    <?php echo esc_html__('Wishlist', 'elessi-theme'); ?>
                </span>
            </div>
            
            <?php echo elessi_loader_html('nasa-wishlist-sidebar-content'); ?>
        </div>
        <?php
    }
endif;

/**
 * Static Login / Register Form
 */
add_action('nasa_static_content', 'elessi_static_login_register', 15);
if (!function_exists('elessi_static_login_register')) :
    function elessi_static_login_register() {
        global $nasa_opt;
        
        if (did_action('nasa_init_login_register_form')) {
            return;
        }
        
        if (
            !NASA_CORE_USER_LOGGED &&
            shortcode_exists('woocommerce_my_account') &&
            (!isset($nasa_opt['login_ajax']) || $nasa_opt['login_ajax'] == 1)
        ) : ?>
            <?php /* if (isset($nasa_opt['tmpl_html']) && $nasa_opt['tmpl_html']) : ?>
                <div class="nasa-login-register-warper" style="display: none;"></div>
                
                <template id="tmpl-nasa-register-form">
                    <div id="nasa-login-register-form">
                        <div class="nasa-form-logo-log nasa-no-fix-size-retina">
                            <?php echo elessi_logo(); ?>

                            <a class="login-register-close nasa-stclose" href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>" rel="nofollow"></a>
                        </div>

                        <div class="nasa-message margin-top-20"></div>
                        <div class="nasa-form-content">
                            <?php do_action('nasa_login_register_form', true); ?>
                        </div>
                    </div>
                </template>
            <?php // else : */ ?>
                <div class="nasa-login-register-warper" style="display: none;">
                    <div id="nasa-login-register-form">
                        <div class="nasa-form-logo-log nasa-no-fix-size-retina margin-bottom-20">
                            <?php echo elessi_logo(); ?>

                            <a class="login-register-close nasa-stclose" href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>" rel="nofollow"></a>
                        </div>

                        <div class="nasa-message"></div>
                        <div class="nasa-form-content">
                            <?php do_action('nasa_login_register_form', true); ?>
                        </div>
                    </div>
                </div>
            <?php // endif; ?>
        <?php
        endif;
    }
endif;

/**
 * Static Quickview sidebar
 */
add_action('nasa_static_content', 'elessi_static_quickview_sidebar', 16);
if (!function_exists('elessi_static_quickview_sidebar')) :
    function elessi_static_quickview_sidebar() {
        global $nasa_opt;
        
        $style_quickview = isset($nasa_opt['style_quickview']) && in_array($nasa_opt['style_quickview'], array('sidebar', 'popup')) ? $nasa_opt['style_quickview'] : 'sidebar';
        
        if ($style_quickview == 'sidebar') :
            $crazy = false;
            
            $class = 'nasa-static-sidebar';
            
            if (isset($nasa_opt['transition_load']) && $nasa_opt['transition_load'] == 'crazy') :
                $class .= ' nasa-crazy-load qv-loading';
                $crazy = true;
            endif;
            
            $bg_version = elessi_get_bg_mode();
            $class .= $bg_version == 1 ? ' style-2' : ' style-1';
            ?>
            <div id="nasa-quickview-sidebar" class="<?php echo esc_attr($class); ?>">
                <?php if ($crazy) : ?>
                    <div class="nasa-quickview-fog hidden-tag">
                        <div class="qv-crazy-imgs"></div>
                        <div class="qv-crazy-info">
                            <!-- Loading Name -->
                            <span class="info-1"></span>
                            
                            <!-- Loading Price -->
                            <span class="info-2 margin-top-20"></span>
                            
                            <!-- Loading Other Ex Stars -->
                            <span class="info-3 margin-top-20"></span>
                            
                            <!-- Loading Desc -->
                            <span class="info-4 margin-top-40"></span>
                            <span class="info-5 margin-top-10"></span>
                            
                            <!-- Loading Variation -->
                            <span class="info-6 margin-top-40"></span>
                            <span class="info-6-2 margin-top-20"></span>
                            
                            <!-- Loading Buttons -->
                            <span class="info-7 nasa-flex margin-top-40">
                                <span class="info-7-1"></span>
                                <span class="info-7-2"></span>
                                <span class="info-7-3"></span>
                            </span>
                            
                            <span class="info-8 margin-top-40"></span>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="quickview-close nasa-sidebar-close">
                    <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>" rel="nofollow">
                        <svg width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg>
                    </a>
                </div>
                
                <?php echo elessi_loader_html('nasa-quickview-sidebar-content', false); ?>
            </div>
            <?php
        endif;
    }
endif;

/**
 * Static Compare sidebar
 */
add_action('nasa_static_content', 'elessi_static_compare_sidebar', 17);
if (!function_exists('elessi_static_compare_sidebar')) :
    function elessi_static_compare_sidebar() {
        global $nasa_opt, $yith_woocompare;
        
        if ($yith_woocompare) {
            $nasa_compare = isset($yith_woocompare->obj) ?
                $yith_woocompare->obj : $yith_woocompare;
            
            if (isset($nasa_compare->cookie_name)) {
                echo '<input type="hidden" name="nasa_woocompare_cookie_name" value="' . $nasa_compare->cookie_name . '" />';
            }
        }
        ?>
        <div class="nasa-compare-list-bottom">
            <?php
            echo isset($nasa_opt['tmpl_html']) && $nasa_opt['tmpl_html'] ? '<template id="tmpl-nasa-mini-compare">' : '';
            do_action('nasa_empty_mini_compare');
            echo isset($nasa_opt['tmpl_html']) && $nasa_opt['tmpl_html'] ? '</template>' : '';
            ?>
        </div>
        <?php
    }
endif;

/**
 * Static Compare sidebar
 */
add_action('nasa_static_content', 'elessi_fake_purchased_tmpl', 18);
if (!function_exists('elessi_fake_purchased_tmpl')) :
    function elessi_fake_purchased_tmpl() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['fake_purchase']) || !$nasa_opt['fake_purchase']) {
            return;
        }
        ?>
        <script type="text/template" id="ns-sale-notification-tml">
            <div class="wrapper-noti">
                <div class="product-image nasa-flex">
                    {{src_img}}
                </div>
                
                <div class="theme-bg"></div>

                <div class="wrapper-theme">
                
                    <div class="noti-title">{{customer}}</div>

                    <a class="noti-body nasa-bold" href="{{p_url}}" title="{{p_name}}" target="_blank">{{p_name}}</a>
                    
                    <div class="noti-time nasa-flex">
                        {{time_purchase}}
                        <span class="verify margin-left-10 rtl-margin-left-0 rtl-margin-right-10 nasa-flex">
                            <svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M16 2.672c-7.361 0-13.328 5.967-13.328 13.328s5.968 13.328 13.328 13.328c7.361 0 13.328-5.967 13.328-13.328s-5.967-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.501-12.262-12.262s5.5-12.262 12.262-12.262c6.761 0 12.262 5.501 12.262 12.262s-5.5 12.262-12.262 12.262z" /><path d="M22.667 11.241l-8.559 8.299-2.998-2.998c-0.312-0.312-0.818-0.312-1.131 0s-0.312 0.818 0 1.131l3.555 3.555c0.156 0.156 0.361 0.234 0.565 0.234 0.2 0 0.401-0.075 0.556-0.225l9.124-8.848c0.317-0.308 0.325-0.814 0.018-1.131-0.309-0.318-0.814-0.325-1.131-0.018z" /></svg>
                            <?php echo esc_html__('Verified', 'elessi-theme'); ?>
                        </span>
                    </div>
                </div>
            </div>
            
            <a href="javascript:void(0);" class="close-noti nasa-flex jc" rel="nofollow">
                <svg enable-background="new 0 0 32 32" height="20" version="1.1" viewBox="1 0 32 32" width="15" xml:space="preserve"><path d="M17.459,16.014l8.239-8.194c0.395-0.391,0.395-1.024,0-1.414c-0.394-0.391-1.034-0.391-1.428,0  l-8.232,8.187L7.73,6.284c-0.394-0.395-1.034-0.395-1.428,0c-0.394,0.396-0.394,1.037,0,1.432l8.302,8.303l-8.332,8.286  c-0.394,0.391-0.394,1.024,0,1.414c0.394,0.391,1.034,0.391,1.428,0l8.325-8.279l8.275,8.276c0.394,0.395,1.034,0.395,1.428,0  c0.394-0.396,0.394-1.037,0-1.432L17.459,16.014z" fill="currentColor"/></svg>
            </a>
            
            <a class="ns-noti-link quick-view nasa-flex jc" href="javascript:void(0);" data-prod="{{p_data_prod}}" title="<?php esc_attr_e('Quick View', 'elessi-theme'); ?> {{p_name}}" target="_blank" rel="nofollow">
                <svg version="1.1" width="20" height="20" viewBox="0 0 32 32"><path d="M16.067 11.156c0.883 0 1.599-0.716 1.599-1.599 0-0.884-0.716-1.598-1.599-1.598s-1.599 0.714-1.599 1.598c0 0.883 0.716 1.599 1.599 1.599z" fill="currentColor"/><path d="M17.153 13.289v-1.066h-3.199v1.066h1.066v9.063h-1.066v1.066h4.265v-1.066h-1.066z" fill="currentColor"/><path d="M16 2.672c-7.361 0-13.328 5.968-13.328 13.328 0 7.362 5.968 13.328 13.328 13.328s13.328-5.966 13.328-13.328c0-7.361-5.968-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.501-12.262-12.262s5.5-12.262 12.262-12.262c6.761 0 12.262 5.501 12.262 12.262s-5.5 12.262-12.262 12.262z" fill="currentColor"/></svg>
            </a>

            <div class="ns-time-countdown"></div>
        </script>
        <?php
    }
endif;

/**
 * Mobile Menu
 */
add_action('nasa_static_content', 'elessi_static_menu_vertical_mobile', 19);
if (!function_exists('elessi_static_menu_vertical_mobile')) :
    function elessi_static_menu_vertical_mobile() {
        global $nasa_opt;
        
        $mobile_menu_layout = isset($nasa_opt['mobile_menu_layout']) ? $nasa_opt['mobile_menu_layout'] : 'light';
        
        switch ($mobile_menu_layout) {
            case 'dark':
                $class = 'nasa-standard nasa-dark';
                break;
            
            default:
                $class = 'nasa-standard';
                break;
        }
        ?>
        
        <div id="nasa-menu-sidebar-content" class="<?php echo esc_attr($class); ?>">
            <a class="nasa-close-menu-mobile ns-touch-close" href="javascript:void(0);" rel="nofollow">
                <svg class="nasa-rotate-180" width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z" /></svg>
            </a>
            <div class="nasa-mobile-nav-wrap">
                <div id="mobile-navigation"></div>
            </div>
        </div>
        
        <?php
        
        /**
         * Menus Heading for Mobile
         */
        echo '<div id="heading-menu-mobile" class="hidden-tag">' . elessi_logo() . '</div>';
    }
endif;

/**
 * Top Categories filter
 */
add_action('nasa_static_content', 'elessi_static_top_cat_filter', 20);
if (!function_exists('elessi_static_top_cat_filter')) :
    function elessi_static_top_cat_filter() {
        ?>
        <div class="nasa-top-cat-filter-wrap-mobile">
            <span class="nasa-tit-filter-cat">
                <?php echo esc_html__("Categories", 'elessi-theme'); ?>
            </span>
            
            <?php echo elessi_get_all_categories(); ?>

            <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>" class="nasa-close-filter-cat ns-touch-close" rel="nofollow">
                <svg class="nasa-rotate-180" width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg>
            </a>
        </div>
        <?php
    }
endif;

/**
 * Static Configurations
 */
add_action('nasa_static_content', 'elessi_static_config_info', 21);
if (!function_exists('elessi_static_config_info')) :
    function elessi_static_config_info() {
        global $nasa_opt, $nasa_loadmore_style;
        
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
        /**
         * Paging style in store
         */
        if (isset($_REQUEST['paging-style']) && in_array($_REQUEST['paging-style'], $nasa_loadmore_style)) {
            echo '<input type="hidden" name="nasa_loadmore_style" value="' . $_REQUEST['paging-style'] . '" />';
        }
        
        /**
         * Mobile Fixed add to cart in Desktop
         */
        if (!isset($nasa_opt['enable_fixed_add_to_cart']) || $nasa_opt['enable_fixed_add_to_cart']) {
            echo '<!-- Enable Fixed add to cart single product -->';
            echo '<input type="hidden" name="nasa_fixed_single_add_to_cart" value="1" />';
        }
        
        /**
         * Mobile Fixed add to cart in mobile
         */
        if (!isset($nasa_opt['mobile_fixed_add_to_cart'])) {
            $nasa_opt['mobile_fixed_add_to_cart'] = 'no';
        }
        echo '<!-- Fixed add to cart single product in Mobile layout -->';
        echo '<input type="hidden" name="nasa_fixed_mobile_single_add_to_cart_layout" value="' . esc_attr($nasa_opt['mobile_fixed_add_to_cart']) . '" />';
        
        /**
         * Event After add to cart
         */
        $after_add_to_cart = isset($nasa_opt['event-after-add-to-cart']) ? $nasa_opt['event-after-add-to-cart'] : 'sidebar';
        $after_add_to_cart =  $in_mobile && $after_add_to_cart !='notice' ? 'sidebar' : $after_add_to_cart;
        echo '<!-- Event After Add To Cart -->';
        echo '<input type="hidden" name="nasa-event-after-add-to-cart" value="' . esc_attr($after_add_to_cart) . '" />';
        if ($after_add_to_cart === 'sidebar' && isset($nasa_opt['ns_preload_mcart']) && !$nasa_opt['ns_preload_mcart']) {
            echo '<input type="hidden" name="ns-not-preload-mcart" value="1" />';
        }
        
        /**
         * Max with row
         */
        if (!$in_mobile) {
            $max_width = 1200;
            
            if (isset($nasa_opt['plus_wide_width']) && (int) $nasa_opt['plus_wide_width'] > 0) {
                global $content_width;
                
                $content_width = !isset($content_width) ? 1200 : $content_width;
                $max_width = ($content_width + (int) $nasa_opt['plus_wide_width']);
            }
            
            echo $max_width > 1200 ? '<input type="hidden" name="nsmw-theme" value="' . $max_width . '" />' : '';
        }

        if ($in_mobile) {            
            echo '<input type="hidden" name="nasa-title-bc-general" value="' . esc_attr__('General', 'elessi-theme') . '" />';
            echo '<input type="hidden" name="nasa-title-bc-recommendation" value="' . esc_attr__('Recommendation', 'elessi-theme') . '" />';
            echo '<input type="hidden" name="nasa-title-bc-review" value="' . esc_attr__('Reviews', 'elessi-theme') . '" />';
            echo '<input type="hidden" name="ns-pcat-off" value="' . (isset($nasa_opt['ns_pcat_off']) && $nasa_opt['ns_pcat_off'] ? '1' : '0') . '" />';
            echo '<input type="hidden" name="ns-add-review" value="' . esc_attr__('Write a review', 'elessi-theme') . '" />';
        }
        
        /**
         * pswpHTML
         */
        echo '<script type="text/template" id="tmpl-nasa-pswpHTML">';
        echo '<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true"><div class="pswp__bg"></div><div class="pswp__scroll-wrap"><div class="pswp__container"><div class="pswp__item"></div><div class="pswp__item"></div><div class="pswp__item"></div></div><div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar"><div class="pswp__counter"></div><button class="pswp__button pswp__button--close" title="' . esc_attr__('Close (Esc)', 'elessi-theme') . '"></button><button class="pswp__button pswp__button--share" title="' . esc_attr__('Share', 'elessi-theme') . '"></button><button class="pswp__button pswp__button--fs" title="' . esc_attr__('Toggle fullscreen', 'elessi-theme') . '"></button><button class="pswp__button pswp__button--zoom" title="' . esc_attr__('Zoom in/out', 'elessi-theme') . '"></button><div class="pswp__preloader"><div class="pswp__preloader__icn"><div class="pswp__preloader__cut"><div class="pswp__preloader__donut"></div></div></div></div></div><div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap"><div class="pswp__share-tooltip"></div></div><button class="pswp__button pswp__button--arrow--left" title="' . esc_attr__('Previous (arrow left)', 'elessi-theme') . '"></button><button class="pswp__button pswp__button--arrow--right" title="' . esc_attr__('Next (arrow right)', 'elessi-theme') . '"></button><div class="pswp__caption"><div class="pswp__caption__center"></div></div></div></div></div>';
        echo '</script>';
        ?>
        
        <!-- URL Logout -->
        <input type="hidden" name="nasa_logout_menu" value="<?php echo wp_logout_url(home_url('/')); ?>" />
        
        <!-- width toggle Add To Cart | Countdown -->
        <input type="hidden" name="nasa-toggle-width-product-content" value="<?php echo apply_filters('nasa_toggle_width_product_content', 180); ?>" />
        
        <!-- Close Pop-up string -->
        <input type="hidden" name="nasa-close-string" value="<?php echo esc_attr__('Close (Esc)', 'elessi-theme'); ?>" />
        
        <!-- Toggle Select Options Sticky add to cart single product page -->
        <input type="hidden" name="nasa_select_options_text" value="<?php echo esc_attr__('Select Options', 'elessi-theme'); ?>" />
        
        <!-- Less Total Count items Wishlist - Compare - (9+) -->
        <input type="hidden" name="nasa_less_total_items" value="<?php echo (!isset($nasa_opt['compact_number']) || $nasa_opt['compact_number']) ? '1' : '0'; ?>" />
        
        <!-- Confirm text - Value to 0 in Quantity - Cart Sidebar -->
        <input type="hidden" name="nasa_change_value_0" value="<?php echo esc_attr__('Are you sure you want to remove it?', 'elessi-theme'); ?>" />
        
        <!-- Cookie Life Time - Default 7 days -->
        <input type="hidden" name="nasa-cookie-life" value="<?php echo apply_filters('nasa_cookie_life_time', 7); ?>" />

        <?php
        if (defined('NASA_PLG_CACHE_ACTIVE') && NASA_PLG_CACHE_ACTIVE) {
            echo apply_filters('nasa_caching_plgs_enable', false) ? '<input type="hidden" name="nasa-caching-enable" value="1" />' : '';
            echo apply_filters('nasa_rflrnc_enable', true) ? '<input type="hidden" name="nasa-rflrnc" value="1" />' : '';
        }
    }
endif;
        
/**
 * Bottom Bar menu
 */
add_action('nasa_static_content', 'elessi_bottom_bar_menu', 22);
if (!function_exists('elessi_bottom_bar_menu')):
    function elessi_bottom_bar_menu() {
        global $nasa_opt;
        
        if (isset($nasa_opt['m_bot_bar']) && !$nasa_opt['m_bot_bar']) {
            return;
        }
        
        $stb = isset($nasa_opt['m_bot_bar_ct']) && $nasa_opt['m_bot_bar_ct'] ? $nasa_opt['m_bot_bar_ct'] : 'default';
        
        /**
         * Check Mobile Layout
         */
        $is_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
        /**
         * Open Template
         */
        echo !$is_mobile ? '<script type="text/template" id="tmpl-nasa-bottom-bar">' : '';
        
        echo '<div class="nasa-bottom-bar nasa-transition">';
        
        /**
         * Default Bottom Bar
         */
        if ($stb === 'default') {
        
            $file_name = 'nasa-mobile-bottom-bar';

            if ($is_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] !== 'df') {
                $file_name .= '-' . $nasa_opt['mobile_layout'];
            }

            /**
             * Content Template
             */
            $file = ELESSI_CHILD_PATH . '/includes/' . $file_name . '.php'; // File exist in child-theme

            if (!is_file($file)) {
                $file = ELESSI_THEME_PATH . '/includes/' . $file_name . '.php'; // File exist in main-theme
            }

            if (is_file($file)) {
                include $file;
            }
        }
        
        /**
         * Static Block
         */
        else {
            /**
             * Close with Single product and checkout page
             */
            $close = NASA_WOO_ACTIVED ? is_product() || is_checkout() : false;
            echo apply_filters('nasa_close_mobile_bottom_bar', $close) ? '' : elessi_get_block($stb);
        }
        
        echo '</div>';
        
        /**
         * Close Template
         */
        echo !$is_mobile ? '</script>' : '';
    }
endif;

/**
 * Global wishlist template
 */
add_action('nasa_static_content', 'elessi_global_wishlist', 25);
if (!function_exists('elessi_global_wishlist')):
    function elessi_global_wishlist() {
        global $nasa_opt;
        
        if (NASA_WISHLIST_ENABLE && 
            (!isset($nasa_opt['optimize_wishlist_html']) || $nasa_opt['optimize_wishlist_html'])
        ) {
            $file = ELESSI_CHILD_PATH . '/includes/nasa-global-wishlist.php';
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-global-wishlist.php';
        }
    }
endif;

/**
 * Captcha template template
 */
add_action('nasa_after_static_content', 'elessi_tmpl_captcha_field_register');
if (!function_exists('elessi_tmpl_captcha_field_register')):
    function elessi_tmpl_captcha_field_register() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['register_captcha']) || !$nasa_opt['register_captcha']) {
            return;
        }
        
        /**
         * No support - server no support create image
         */
        if (!function_exists('imagecreatetruecolor')) {
            return;
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-tmpl-captcha-field-register.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-tmpl-captcha-field-register.php';
    }
endif;

/**
 * GDPR Message
 */
add_action('nasa_static_content', 'elessi_gdpr_notice', 30);
if (!function_exists('elessi_gdpr_notice')) :
    function elessi_gdpr_notice() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['nasa_gdpr_notice']) || !$nasa_opt['nasa_gdpr_notice'])  {
            return;
        }

        $enable = !isset($_COOKIE['nasa_gdpr_notice']) || !$_COOKIE['nasa_gdpr_notice'] ? true : false;
        if (!$enable) {
            return;
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-gdpr-notice.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-gdpr-notice.php';
    }
endif;

/**
 * Age Verification
 */
add_action('nasa_static_content', 'elessi_age_verification', 31);
if (!function_exists('elessi_age_verification')) :
    function elessi_age_verification() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['nasa_age_verification']) || !$nasa_opt['nasa_age_verification'])  {
            return;
        }
        
        if (isset($_COOKIE['nasa_age_verification_ck']) && $_COOKIE['nasa_age_verification_ck'] == 'true') {
            return;
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-age-verification.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-age-verification.php';
    }
endif;

/**
 * Popup Exit Intent Content
 */
add_action('nasa_static_content', 'elessi_popup_exit_intent', 31);
if (!function_exists('elessi_popup_exit_intent')) :
    function elessi_popup_exit_intent() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['ns_popup_exit_intent']) || !$nasa_opt['ns_popup_exit_intent'])  {
            return;
        }
        
        if (isset($_COOKIE['nasa_popup_exit_intent_ck']) && $_COOKIE['nasa_popup_exit_intent_ck'] == 'false') {
            return;
        }
        
        /**
         * Check Mobile Layout
         */
        if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) {
            return;
        }
        
        $stb = isset($nasa_opt['ns_popup_exit_intent_ct']) && $nasa_opt['ns_popup_exit_intent_ct'] ? $nasa_opt['ns_popup_exit_intent_ct'] : 'default';

        /**
         * Default Popup Exit Intent Content
         */
        if ($stb === 'default') {
            return;
        }
        
        $repeat_time = isset($nasa_opt['popup_exit_intent_repeat_time']) && $nasa_opt['popup_exit_intent_repeat_time'] > 0 ? $nasa_opt['popup_exit_intent_repeat_time'] : '24';
        
        $html  = '<div class="nasa-popup-exit-intent-wrap nasa-transition-400">';
        $html .= '<a class="nasa-popup-exit-intent-close nasa-stclose" data-repeat="' . $repeat_time . '" href="javascript:void(0);" title="' . esc_attr__('Close (Esc)', 'elessi-theme') . '" rel="nofollow"></a>';
        $html .= '<div class="nasa-popup-exit-intent-content">';
        $html .= elessi_get_block($stb);
        $html .= '</div></div>';

        echo $html ;
    }
endif;

/**
 * Header Responsive
 */
add_action('nasa_after_static_content', 'elessi_script_template_responsive_header');
if (!function_exists('elessi_script_template_responsive_header')) :
    function elessi_script_template_responsive_header() {
        global $nasa_opt;
        if (!isset($nasa_opt['nasa_in_mobile']) || !$nasa_opt['nasa_in_mobile']) { ?>
            <script type="text/template" id="tmpl-nasa-responsive-header">
                <?php
                $file = ELESSI_CHILD_PATH . '/headers/header-responsive.php';
                include is_file($file) ? $file : ELESSI_THEME_PATH . '/headers/header-responsive.php';
                ?>
            </script>
            <?php
        }
    }
endif;

/**
 * Link style Off Canvas
 */
add_action('nasa_after_static_content', 'elessi_link_style_off_canvas');
if (!function_exists('elessi_link_style_off_canvas')) :
    function elessi_link_style_off_canvas() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['css_canvas']) || $nasa_opt['css_canvas'] == 'async') {
            echo  '<script type="text/template" id="nasa-style-off-canvas" data-link="' . esc_url(ELESSI_THEME_URI . '/assets/css/style-off-canvas.css') . '"></script>';

            echo '<script type="text/template" id="nasa-style-mobile-menu" data-link="' . esc_url(ELESSI_THEME_URI . '/assets/css/style-mobile-menu.css') . '"></script>';

            if (!isset($nasa_opt['loop_layout_buttons']) || $nasa_opt['loop_layout_buttons'] != 'modern-5') {
                echo '<script type="text/template" id="cross-sell-popup-cart-style" data-link="' . esc_url(ELESSI_THEME_URI . '/assets/css/style-loop-product-modern-5.css') . '"></script>';
            }

        }
    }
endif;

/**
 * Disable Refill - Contact Form 7
 */
add_action('wp_footer', 'elessi_disable_wpcf7_refill', 9999);
if (!function_exists('elessi_disable_wpcf7_refill')) :
    function elessi_disable_wpcf7_refill() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['disable_wpcf7_refill']) || $nasa_opt['disable_wpcf7_refill']) {
            echo '<script>if(typeof wpcf7 !== "undefined"){wpcf7.cached = 0;}</script>';
        }
    }
endif;

/**
 * Delay js files
 */
add_filter('script_loader_tag', 'elessi_delay_tag_js_files', 10, 2);
if (!function_exists('elessi_delay_tag_js_files')) :
    function elessi_delay_tag_js_files($tag, $handle) {
        global $nasa_opt, $nasa_js_delay;
        
        if (!isset($nasa_js_delay)) {
            $nasa_js_delay = array();
            
            if (!empty($nasa_opt['js_files'])) {
                foreach ($nasa_opt['js_files'] as $key => $val) {
                    if ($val == 1) {
                        $nasa_js_delay[] = $key;
                    }
                }
            }
            
            $GLOBALS['nasa_js_delay'] = $nasa_js_delay;
        }
        
        if (!empty($nasa_js_delay) && in_array($handle, $nasa_js_delay)) {
            $tag = str_replace(
                'text/javascript',
                'nasa_delay_script',
                $tag
            );
        }
    
        return $tag;
    }
endif;
