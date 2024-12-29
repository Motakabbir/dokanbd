<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Add Block header
 */
if (!function_exists('elessi_block_header')):
    function elessi_block_header() {
        global $nasa_opt, $wp_query;
        
        $object = $wp_query->get_queried_object();
        $page_options = isset($object->post_type) && $object->post_type == 'page' ? true : false;
        $object_id = $page_options ? $object->ID : 0;

        $custom_header = $object_id ? get_post_meta($object_id, '_nasa_custom_header', true) : '';
        
        if (!isset($nasa_opt['header-block'])) {
            $nasa_opt['header-block'] = 'default';
        }
        
        $header_block = ($custom_header !== '' && $object_id) ? get_post_meta($object_id, '_nasa_header_block', true) : $nasa_opt['header-block'];

        if ($header_block == '-1' || $header_block == 'default') {
            return;
        }
        
        $header_block = $header_block == '' ? ($nasa_opt['header-block'] != 'default' ? $nasa_opt['header-block'] : false) : $header_block;
        $header_block = $header_block ? $header_block : false;
        
        echo $header_block ? elessi_get_block($header_block) : '';
    }
endif;

if (!function_exists('elessi_block_beside_header')):
    function elessi_block_beside_header() {
        global $nasa_opt, $wp_query;
        
        $object = $wp_query->get_queried_object();
        $page_options = isset($object->post_type) && $object->post_type == 'page' ? true : false;
        $object_id = $page_options ? $object->ID : 0;

        $custom_header = $object_id ? get_post_meta($object_id, '_nasa_custom_header', true) : '';

        if (!isset($nasa_opt['header-block-type_4'])) {
            $nasa_opt['header-block-type_4'] = 'Select';
        }

        $header_block = ($custom_header !== '' && $object_id) ? get_post_meta($object_id, '_nasa_header_beside_block', true) : $nasa_opt['header-block-type_4'];

        if ($header_block == '-1' || $header_block == 'Default') {
            return false;
        }

        $header_block = $header_block == '' ? ($nasa_opt['header-block-type_4'] != 'Select' ? $nasa_opt['header-block-type_4'] : false) : $header_block;
        $header_block = $header_block ? $header_block : false;
            
        return  $header_block ? elessi_get_block($header_block) : '';
    }
endif;

/**
 * Add action header
 */
add_action('init', 'elessi_add_action_header');
if (!function_exists('elessi_add_action_header')):
    function elessi_add_action_header() {
        /* Header Promotion */
        add_action('nasa_before_header_structure', 'elessi_promotion_recent_post', 1);
        
        /* Header Default */
        add_action('nasa_header_structure', 'elessi_get_header_structure', 10);
        add_action('nasa_header_structure', 'elessi_block_header', 100);
        
        /* Breadcrumb site */
        add_action('nasa_after_header_structure', 'elessi_get_breadcrumb', 999);
        
        /* Add Breadcrumb for Header Elementor-Pro */
        if (function_exists('elementor_pro_load_plugin')) {
            add_action('elementor/theme/after_do_header', 'elessi_open_elm_breadcrumb', 80);
            add_action('elementor/theme/after_do_header', 'elessi_get_breadcrumb', 90);
            add_action('elementor/theme/after_do_header', 'elessi_close_elm_breadcrumb', 100);
        }
        
        /* Topbar */
        add_action('nasa_topbar_header', 'elessi_header_topbar');
        
        /* Topbar Mobile */
        add_action('nasa_topbar_header_mobile', 'elessi_header_topbar_mobile');
        
        /* Topbar Mobile App */
        add_action('nasa_topbar_header_mobile_app', 'elessi_header_topbar_mobile_app');
        
        /**
         * Deprecated from 4.2.6
         * Header - Responsive
         */
        if (function_exists('elessi_mobile_header')) {
            add_action('nasa_mobile_header', 'elessi_mobile_header');
        }
    }
endif;

/**
 * Remove Breadcrumb - Single Product, Archive Product Page - Mobile Layout - App
 */
add_action('template_redirect', 'elessi_products_ma_remove_breadcrumb');
if (!function_exists('elessi_products_ma_remove_breadcrumb')) :
    function elessi_products_ma_remove_breadcrumb() {
        if (!NASA_WOO_ACTIVED || !is_woocommerce()) {
            return;
        }
        
        global $nasa_opt;
        
        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
        if ($in_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app') {
            /* Remove Breadcrumb site */
            remove_action('nasa_after_header_structure', 'elessi_get_breadcrumb', 999);

            /* Remove Breadcrumb for Header Elementor-Pro */
            if (function_exists('elementor_pro_load_plugin')) {
                remove_action('elementor/theme/after_do_header', 'elessi_open_elm_breadcrumb', 80);
                remove_action('elementor/theme/after_do_header', 'elessi_get_breadcrumb', 90);
                remove_action('elementor/theme/after_do_header', 'elessi_close_elm_breadcrumb', 100);
            }
        }
    }
endif;

/**
 * Get header structure
 */
if (!function_exists('elessi_get_header_structure')):
    function elessi_get_header_structure() {
        global $nasa_opt;
        
        $has_vertical = array('4', '6');
        $not_search_icon = array('3', '4', '5', '6', '7');
        $transparent = array('1', '2', '3', '5', '7');

        $hstructure = isset($nasa_opt['header-type']) ? $nasa_opt['header-type'] : '1';
        
        /**
         * Header builder
         */
        if ($hstructure == 'nasa-custom') {
            remove_action('nasa_header_structure', 'elessi_block_header', 100);
            
            $header_slug = isset($nasa_opt['header-custom']) && $nasa_opt['header-custom'] != 'default' ?
                $nasa_opt['header-custom'] : false;
            
            if ($header_slug) {
                elessi_header_builder($header_slug);
            }
            
            return;
        }
        
        /**
         * Header Elementor builder
         */
        if ($hstructure == 'nasa-elm') {
            remove_action('nasa_header_structure', 'elessi_block_header', 100);
            
            $header_e = isset($nasa_opt['header-elm']) && $nasa_opt['header-elm'] != 'default' ?
                $nasa_opt['header-elm'] : false;
            
            if ($header_e) {
                elessi_header_elm();
            }
            
            return;
        }
        
        /**
         * Apply to fixed header
         */
        $fixed_nav_header = (!isset($nasa_opt['fixed_nav']) || $nasa_opt['fixed_nav']);
        $fixed_nav = apply_filters('nasa_header_sticky', $fixed_nav_header);
        
        $header_classes = array();
        
        /**
         * Transparent header
         */
        $header_transparent = in_array($hstructure, $transparent) && isset($nasa_opt['header_transparent']) && $nasa_opt['header_transparent'] ? true : false;
        if ($header_transparent) {
            $header_classes[] = 'nasa-header-transparent';
        }
        
        /**
         * Mobile Detect
         */
        if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) {
            $header_classes[] = 'nasa-header-mobile-layout';
            if ($fixed_nav) {
                $header_classes[] = 'nasa-header-sticky';
            }
            
            $vertical = in_array($hstructure, $has_vertical) ? true : false;
            $header_classes = !empty($header_classes) ? implode(' ', $header_classes) : '';
            $header_classes = apply_filters('nasa_header_classes', $header_classes);
            
            defined('NASA_TOP_FILTER_CATS') or define('NASA_TOP_FILTER_CATS', apply_filters('nasa_top_filter_cats_state', true));
            
            /**
             * Mobile Layout
             */
            $file_name = 'header-mobile';
            if (isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] !== 'df') {
                $file_name .= '-' . $nasa_opt['mobile_layout'];
            }
            
            $file = ELESSI_CHILD_PATH . '/headers/' . $file_name . '.php'; // File exist in child-theme
            
            if (!is_file($file)) {
                $file = ELESSI_THEME_PATH . '/headers/' . $file_name . '.php'; // File exist in main-theme
            }
            
            if (is_file($file)) {
                include $file;
            }
            
            return;
        }
        
        /**
         * Init vars
         */
        $menu_warp_class = array();
        $header_classes[] = 'header-wrapper header-type-' . $hstructure;
        
        /**
         * Extra class name
         */
        $el_class_header = isset($nasa_opt['el_class_header']) ? $nasa_opt['el_class_header'] : '';
        if ($el_class_header != '') {
            $header_classes[] = $el_class_header;
        }
        
        /**
         * Main menu style
         */
        $menu_warp_class[] = 'nasa-nav-style-1';
        $data_padding_y = apply_filters('nasa_responsive_y_menu', 15);
        $data_padding_x = apply_filters('nasa_responsive_x_menu', 35);
        
        $menu_warp_class = !empty($menu_warp_class) ? ' ' . implode(' ', $menu_warp_class) : '';
        
        /**
         * Full width main menu
         */
        $fullwidth_main_menu = isset($nasa_opt['fullwidth_main_menu']) && $nasa_opt['fullwidth_main_menu'] ? true : false;
        
        /**
         * Top filter cats
         */
        $show_icon_cat_top = isset($nasa_opt['show_icon_cat_top']) ? $nasa_opt['show_icon_cat_top'] : 'show-in-shop';
        switch ($show_icon_cat_top) :
            case 'show-all-site':
                $show_cat_top_filter = true;
                break;

            case 'not-show':
                $show_cat_top_filter = false;
                break;

            case 'show-in-shop':
            default:
                $show_cat_top_filter = NASA_WOO_ACTIVED && (is_product_taxonomy() || is_shop()) ? true : false;
                break;
        endswitch;
        
        defined('NASA_TOP_FILTER_CATS') or define('NASA_TOP_FILTER_CATS', apply_filters('nasa_top_filter_cats_state', $show_cat_top_filter));
        
        $show_product_cat = true;
        $show_cart = true;
        $show_compare = $hstructure != '7' ? true : false;
        $show_wishlist = $hstructure != '7' ? true : false;
        $icon_search = in_array($hstructure, $not_search_icon) ? false : true;
        $show_search = apply_filters('nasa_search_icon_header', $icon_search);
        
        if ($hstructure == '6') {
            add_filter('nasa_header_icons_text', 'elessi_header_icons_text');
        }
        
        $nasa_header_icons = elessi_header_icons($show_product_cat, $show_cart, $show_compare, $show_wishlist, $show_search);
        
        /**
         * Sticky header
         */
        if ($fixed_nav) {
            $header_classes[] = 'nasa-header-sticky';
        }
        
        /**
         * $header_classes to string
         */
        $header_classes = !empty($header_classes) ? implode(' ', $header_classes) : '';
        $header_classes = apply_filters('nasa_header_classes', $header_classes);
        
        /**
         * Main header include
         */
        $file = ELESSI_CHILD_PATH . '/headers/header-structure-' . ((int) $hstructure) . '.php';
        if (is_file($file)) {
            include $file;
        } else {
            $file = ELESSI_THEME_PATH . '/headers/header-structure-' . ((int) $hstructure) . '.php';
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/headers/header-structure-1.php';
        }
    }
endif;

/**
 * filter text for header icons
 */
if (!function_exists('elessi_header_icons_text')) :
    function elessi_header_icons_text($icon_text) {
        return true;
    }
endif;

/**
 * Group header icons
 */
if (!function_exists('elessi_header_icons')) :
    function elessi_header_icons($product_cat = true, $cart = true, $compare = true, $wishlist = true, $search = true) {
        global $nasa_opt;
        
        $icons = '';
        $first = false;
        $icon_text = apply_filters('nasa_header_icons_text', false);
        
        /**
         * Hide menu in header
         */
        if (isset($nasa_opt['hide_tini_menu_acc']) && $nasa_opt['hide_tini_menu_acc']) {
            $account_icon = false;
        }
        
        else {
            /**
             * Add Account icon
             */
            $account_icon = (isset($nasa_opt['acc_pos']) && $nasa_opt['acc_pos'] == 'group') ? true : false;

            if (
                !$account_icon &&
                isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] &&
                (!isset($nasa_opt['main_screen_acc_mobile']) || $nasa_opt['main_screen_acc_mobile'])
            ) {
                $account_icon = true;
            }
        }
        
        $account_icon = apply_filters('nasa_account_sp', $account_icon);
        
        if ($account_icon) {
            $title_acc = !NASA_CORE_USER_LOGGED ? esc_attr__('Login / Register', 'elessi-theme') : esc_attr__('My Account', 'elessi-theme');

            $login_ajax = !NASA_CORE_USER_LOGGED && (!isset($nasa_opt['login_ajax']) || $nasa_opt['login_ajax'] == 1) ? '1' : '0';
            
            $links = elessi_link_account();
            $subacc = elessi_sub_account();
            
            $icon = apply_filters('nasa_mini_icon_account', '<svg width="24" height="24" viewBox="0 0 32 32" fill="currentColor"><path d="M16 3.205c-7.067 0-12.795 5.728-12.795 12.795s5.728 12.795 12.795 12.795 12.795-5.728 12.795-12.795c0-7.067-5.728-12.795-12.795-12.795zM16 4.271c6.467 0 11.729 5.261 11.729 11.729 0 2.845-1.019 5.457-2.711 7.49-1.169-0.488-3.93-1.446-5.638-1.951-0.146-0.046-0.169-0.053-0.169-0.66 0-0.501 0.206-1.005 0.407-1.432 0.218-0.464 0.476-1.244 0.569-1.944 0.259-0.301 0.612-0.895 0.839-2.026 0.199-0.997 0.106-1.36-0.026-1.7-0.014-0.036-0.028-0.071-0.039-0.107-0.050-0.234 0.019-1.448 0.189-2.391 0.118-0.647-0.030-2.022-0.921-3.159-0.562-0.719-1.638-1.601-3.603-1.724l-1.078 0.001c-1.932 0.122-3.008 1.004-3.57 1.723-0.89 1.137-1.038 2.513-0.92 3.159 0.172 0.943 0.239 2.157 0.191 2.387-0.010 0.040-0.025 0.075-0.040 0.111-0.131 0.341-0.225 0.703-0.025 1.7 0.226 1.131 0.579 1.725 0.839 2.026 0.092 0.7 0.35 1.48 0.569 1.944 0.159 0.339 0.234 0.801 0.234 1.454 0 0.607-0.023 0.614-0.159 0.657-1.767 0.522-4.579 1.538-5.628 1.997-1.725-2.042-2.768-4.679-2.768-7.555 0-6.467 5.261-11.729 11.729-11.729zM7.811 24.386c1.201-0.49 3.594-1.344 5.167-1.808 0.914-0.288 0.914-1.058 0.914-1.677 0-0.513-0.035-1.269-0.335-1.908-0.206-0.438-0.442-1.189-0.494-1.776-0.011-0.137-0.076-0.265-0.18-0.355-0.151-0.132-0.458-0.616-0.654-1.593-0.155-0.773-0.089-0.942-0.026-1.106 0.027-0.070 0.053-0.139 0.074-0.216 0.128-0.468-0.015-2.005-0.17-2.858-0.068-0.371 0.018-1.424 0.711-2.311 0.622-0.795 1.563-1.238 2.764-1.315l1.011-0.001c1.233 0.078 2.174 0.521 2.797 1.316 0.694 0.887 0.778 1.94 0.71 2.312-0.154 0.852-0.298 2.39-0.17 2.857 0.022 0.078 0.047 0.147 0.074 0.217 0.064 0.163 0.129 0.333-0.025 1.106-0.196 0.977-0.504 1.461-0.655 1.593-0.103 0.091-0.168 0.218-0.18 0.355-0.051 0.588-0.286 1.338-0.492 1.776-0.236 0.502-0.508 1.171-0.508 1.886 0 0.619 0 1.389 0.924 1.68 1.505 0.445 3.91 1.271 5.18 1.77-2.121 2.1-5.035 3.4-8.248 3.4-3.183 0-6.073-1.277-8.188-3.342z"/></svg>');
            
            $icon .= $icon_text ? '<span class="icon-text">' . esc_html__('Account', 'elessi-theme') . '</span>' : '';

            $nasa_icon_account = 
            '<a class="nasa-login-register-ajax nasa-flex" data-enable="' . $login_ajax . '" href="' . esc_url($links) . '" title="' . $title_acc . '">' .
                $icon .
            '</a>';
            
            $nasa_icon_account .= $subacc;

            $class = !$first ? 'first ' : '';
            $first = true;
            $icons .= '<li class="' . $class . 'nasa-icon-account-mobile menus-account">' . $nasa_icon_account . '</li>';
        }
        
        /**
         * List Product Categories icons
         */
        if (NASA_WOO_ACTIVED && $product_cat) {
            $show_icon_cat_top = isset($nasa_opt['show_icon_cat_top']) ? $nasa_opt['show_icon_cat_top'] : 'show-in-shop';
            
            switch ($show_icon_cat_top) {
                case 'show-all-site':
                    $show_icon = true;
                    break;
                
                case 'not-show':
                    $show_icon = false;
                    break;
                
                case 'show-in-shop':
                default:
                    $show_icon = (!is_post_type_archive('product') && !is_tax(get_object_taxonomies('product'))) ? false : true;
                    break;
            }

            $keypad = '<svg class="nasa-icon" width="28" height="28" viewBox="0 0 32 32">
            <path d="M6.937 21.865c-1.766 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM6.937 27.195c-1.176 0-2.132-0.956-2.132-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            <path d="M6.937 3.738c-1.766 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM6.937 9.069c-1.176 0-2.132-0.956-2.132-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            <path d="M6.937 12.779c-1.766 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM6.937 18.11c-1.176 0-2.132-0.957-2.132-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            <path d="M16 21.865c-1.767 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM16 27.195c-1.176 0-2.133-0.956-2.133-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            <path d="M16 3.738c-1.767 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM16 9.069c-1.176 0-2.133-0.956-2.133-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            <path d="M16 12.779c-1.767 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM16 18.11c-1.176 0-2.133-0.957-2.133-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            <path d="M25.063 21.865c-1.767 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM25.063 27.195c-1.176 0-2.133-0.956-2.133-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            <path d="M25.063 10.135c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198c-1.767 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199zM25.063 4.805c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133c-1.176 0-2.133-0.956-2.133-2.133s0.956-2.132 2.133-2.132z" fill="currentColor"/>
            <path d="M25.063 12.779c-1.767 0-3.199 1.432-3.199 3.198s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.198-3.199-3.198zM25.063 18.11c-1.176 0-2.133-0.957-2.133-2.133s0.956-2.132 2.133-2.132c1.176 0 2.133 0.956 2.133 2.132s-0.956 2.133-2.133 2.133z" fill="currentColor"/>
            </svg>';
            
            if ($show_icon) {
                $icon = apply_filters('nasa_mini_icon_filter_cats',  $keypad);
                $icon .= $icon_text ? '<span class="icon-text">' . esc_html__('Categories', 'elessi-theme') . '</span>' : '';
                
                $nasa_icon_cat = 
                    '<a class="filter-cat-icon nasa-flex nasa-hide-for-mobile" href="javascript:void(0);" title="' . esc_attr__('Product Categories', 'elessi-theme') . '" rel="nofollow">' .
                        $icon .
                    '</a>' .
                    '<a class="filter-cat-icon-mobile inline-block" href="javascript:void(0);" title="' . esc_attr__('Product Categories', 'elessi-theme') . '" rel="nofollow">' .
                        $icon .
                    '</a>';
                $class = !$first ? 'first ' : '';
                $first = true;
                $icons .= '<li class="' . $class . 'nasa-icon-filter-cat">' . $nasa_icon_cat . '</li>';
            }
        }
        
        if ($cart) {
            $nasa_mini_cart = elessi_mini_cart();
            if ($nasa_mini_cart) {
                $class = !$first ? 'first ' : '';
                $first = true;
                $icons .= '<li class="' . $class . 'nasa-icon-mini-cart">' . $nasa_mini_cart . '</li>';
            }
        }
        
        if ($wishlist) {
            $nasa_icon_wishlist = elessi_icon_wishlist();
            if ($nasa_icon_wishlist != '') {
                $class = !$first ? 'first ' : '';
                $first = true;
                $icons .= '<li class="' . $class . 'nasa-icon-wishlist">' . $nasa_icon_wishlist . '</li>';
            }
        }
        
        if ($compare && (!isset($nasa_opt['nasa-product-compare']) || $nasa_opt['nasa-product-compare'])) {
            $nasa_icon_compare = elessi_icon_compare();
            if ($nasa_icon_compare != '') {
                $class = !$first ? 'first ' : '';
                $first = true;
                $icons .= '<li class="' . $class . 'nasa-icon-compare">' . $nasa_icon_compare . '</li>';
            }
        }
        
        if ($search) {
            $icon = apply_filters('nasa_mini_icon_search', '<svg class="nasa-icon nasa-search" fill="currentColor" viewBox="0 0 80 80" width="22" height="22"><path d="M74.3,72.2L58.7,56.5C69.9,44,69,24.8,56.5,13.5s-31.7-10.3-43,2.2s-10.3,31.7,2.2,43c11.6,10.5,29.3,10.5,40.9,0 l15.7,15.7L74.3,72.2z M36.1,63.5c-15.1,0-27.4-12.3-27.4-27.4C8.7,20.9,21,8.7,36.1,8.7c15.1,0,27.4,12.3,27.4,27.4 C63.5,51.2,51.2,63.5,36.1,63.5z"/><path d="M36.1,12.8v3c11.2,0,20.3,9.1,20.3,20.3h3C59.4,23.2,49,12.8,36.1,12.8z"/></svg>');
            
            $search_icon = 
            '<a class="search-icon desk-search nasa-flex" href="javascript:void(0);" data-open="0" title="' . esc_attr__('Search', 'elessi-theme') . '" rel="nofollow">' .
                $icon .
            '</a>';
            $class = !$first ? 'first ' : '';
            $first = true;
            $icons .= '<li class="' . $class . 'nasa-icon-search nasa-hide-for-mobile">' . $search_icon . '</li>';
        }
        
        /**
         * Compatible - Yith Request a Quote Pro
         */
        if (shortcode_exists('yith_ywraq_mini_widget_quote')) {
            $class = !$first ? 'first ' : '';
            $first = true;
            $icons .= '<li class="' . $class . 'ns-yith_mini_quote nasa-icon-quote nasa-hide-for-mobile">' . do_shortcode('[yith_ywraq_mini_widget_quote]') . '</li>';
	}
        
        $icons .= apply_filters('nasa_header_custom_icons', '');
        
        $icons_wrap = ($icons != '') ? '<div class="nasa-header-icons-wrap"><ul class="header-icons">' . $icons . '</ul></div>' : '';
        
        return apply_filters('nasa_header_icons', $icons_wrap);
    }
endif;

/**
 * Group header icons - mobile
 */
if (!function_exists('elessi_header_icons_mobile')) :
    function elessi_header_icons_mobile() {
        global $nasa_opt;
        
        $icons = '';
        $first = false;
        
        /**
         * Login Register
         */
        if (!isset($nasa_opt['hide_tini_menu_acc']) || !$nasa_opt['hide_tini_menu_acc']) {
            $title_acc = !NASA_CORE_USER_LOGGED ? esc_attr__('Login / Register', 'elessi-theme') : esc_attr__('My Account', 'elessi-theme');

            $login_ajax = !NASA_CORE_USER_LOGGED && (!isset($nasa_opt['login_ajax']) || $nasa_opt['login_ajax'] == 1) ? '1' : '0';

            $links = elessi_link_account();

            $icon = apply_filters('nasa_mini_icon_account', '<svg width="24" height="24" viewBox="0 0 32 32" fill="currentColor"><path d="M16 3.205c-7.067 0-12.795 5.728-12.795 12.795s5.728 12.795 12.795 12.795 12.795-5.728 12.795-12.795c0-7.067-5.728-12.795-12.795-12.795zM16 4.271c6.467 0 11.729 5.261 11.729 11.729 0 2.845-1.019 5.457-2.711 7.49-1.169-0.488-3.93-1.446-5.638-1.951-0.146-0.046-0.169-0.053-0.169-0.66 0-0.501 0.206-1.005 0.407-1.432 0.218-0.464 0.476-1.244 0.569-1.944 0.259-0.301 0.612-0.895 0.839-2.026 0.199-0.997 0.106-1.36-0.026-1.7-0.014-0.036-0.028-0.071-0.039-0.107-0.050-0.234 0.019-1.448 0.189-2.391 0.118-0.647-0.030-2.022-0.921-3.159-0.562-0.719-1.638-1.601-3.603-1.724l-1.078 0.001c-1.932 0.122-3.008 1.004-3.57 1.723-0.89 1.137-1.038 2.513-0.92 3.159 0.172 0.943 0.239 2.157 0.191 2.387-0.010 0.040-0.025 0.075-0.040 0.111-0.131 0.341-0.225 0.703-0.025 1.7 0.226 1.131 0.579 1.725 0.839 2.026 0.092 0.7 0.35 1.48 0.569 1.944 0.159 0.339 0.234 0.801 0.234 1.454 0 0.607-0.023 0.614-0.159 0.657-1.767 0.522-4.579 1.538-5.628 1.997-1.725-2.042-2.768-4.679-2.768-7.555 0-6.467 5.261-11.729 11.729-11.729zM7.811 24.386c1.201-0.49 3.594-1.344 5.167-1.808 0.914-0.288 0.914-1.058 0.914-1.677 0-0.513-0.035-1.269-0.335-1.908-0.206-0.438-0.442-1.189-0.494-1.776-0.011-0.137-0.076-0.265-0.18-0.355-0.151-0.132-0.458-0.616-0.654-1.593-0.155-0.773-0.089-0.942-0.026-1.106 0.027-0.070 0.053-0.139 0.074-0.216 0.128-0.468-0.015-2.005-0.17-2.858-0.068-0.371 0.018-1.424 0.711-2.311 0.622-0.795 1.563-1.238 2.764-1.315l1.011-0.001c1.233 0.078 2.174 0.521 2.797 1.316 0.694 0.887 0.778 1.94 0.71 2.312-0.154 0.852-0.298 2.39-0.17 2.857 0.022 0.078 0.047 0.147 0.074 0.217 0.064 0.163 0.129 0.333-0.025 1.106-0.196 0.977-0.504 1.461-0.655 1.593-0.103 0.091-0.168 0.218-0.18 0.355-0.051 0.588-0.286 1.338-0.492 1.776-0.236 0.502-0.508 1.171-0.508 1.886 0 0.619 0 1.389 0.924 1.68 1.505 0.445 3.91 1.271 5.18 1.77-2.121 2.1-5.035 3.4-8.248 3.4-3.183 0-6.073-1.277-8.188-3.342z"/></svg>');

            $nasa_icon_account = 
            '<a class="nasa-login-register-ajax nasa-flex" data-enable="' . $login_ajax . '" href="' . esc_url($links) . '" title="' . $title_acc . '">' .
                $icon .
            '</a>';

            $class = !$first ? 'first ' : '';
            $first = true;
            $icons .= '<li class="' . $class . 'nasa-icon-account-mobile">' . $nasa_icon_account . '</li>';
        }
        
        /**
         * Cart Icon
         */
        $nasa_mini_cart = elessi_mini_cart();
        if ($nasa_mini_cart != '') {
            $class = !$first ? 'first ' : '';
            $first = true;
            $icons .= '<li class="' . $class . 'nasa-icon-mini-cart">' . $nasa_mini_cart . '</li>';
        }
        
        /**
         * Compatible - Yith Request a Quote Pro
         */
        if (shortcode_exists('yith_ywraq_mini_widget_quote')) {
            $class = !$first ? 'first ' : '';
            $first = true;
            $icons .= '<li class="' . $class . 'ns-yith_mini_quote nasa-icon-quote">' . do_shortcode('[yith_ywraq_mini_widget_quote]') . '</li>';
	}
        
        $icons_wrap = $icons != '' ? '<ul class="header-icons">' . $icons . '</ul>' : '';
        
        return apply_filters('nasa_header_icons_mobile', $icons_wrap);
    }
endif;

/**
 * Group header icons - mobile
 */
if (!function_exists('elessi_header_icons_mobile_app')) :
    function elessi_header_icons_mobile_app() {
        $icons = '';
        $first = false;
        
        /**
         * Cart Icon
         */
        $nasa_mini_cart = elessi_mini_cart();
        if ($nasa_mini_cart != '') {
            $class = !$first ? 'first nasa-icon-mini-cart' : 'nasa-icon-mini-cart';
            $first = true;
            $icons .= '<li class="' . $class . '">' . $nasa_mini_cart . '</li>';
        }
        
        /**
         * Compatible - Yith Request a Quote Pro
         */
        if (shortcode_exists('yith_ywraq_mini_widget_quote')) {
            $class = !$first ? 'first ' : '';
            $first = true;
            $icons .= '<li class="' . $class . 'ns-yith_mini_quote nasa-icon-quote">' . do_shortcode('[yith_ywraq_mini_widget_quote]') . '</li>';
	}
        
        /**
         * Search in mobile layout modern
         */
        $class = !$first ? 'first nasa-icon-search' : 'nasa-icon-search';
        $icons .= '<li class="' . $class . '"><a class="nasa-icon mobile-search" href="javascript:void(0);" rel="nofollow"><svg fill="currentColor" viewBox="0 0 80 80" width="22" height="22"><path d="M74.3,72.2L58.7,56.5C69.9,44,69,24.8,56.5,13.5s-31.7-10.3-43,2.2s-10.3,31.7,2.2,43c11.6,10.5,29.3,10.5,40.9,0 l15.7,15.7L74.3,72.2z M36.1,63.5c-15.1,0-27.4-12.3-27.4-27.4C8.7,20.9,21,8.7,36.1,8.7c15.1,0,27.4,12.3,27.4,27.4 C63.5,51.2,51.2,63.5,36.1,63.5z"/><path d="M36.1,12.8v3c11.2,0,20.3,9.1,20.3,20.3h3C59.4,23.2,49,12.8,36.1,12.8z"/></svg></svg></a></li>';
        
        $icons_wrap = $icons != '' ? '<ul class="header-icons">' . $icons . '</ul>' : '';
        
        return apply_filters('nasa_header_icons_mobile_app', $icons_wrap);
    }
endif;

/**
 * Get header builder custom
 */
if (!function_exists('elessi_header_builder')) :
    function elessi_header_builder($header_slug) {
        if (!function_exists('nasa_get_header')) {
            return;
        }

        $header_builder = nasa_get_header($header_slug);
        
        $file = ELESSI_CHILD_PATH . '/headers/header-builder.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/headers/header-builder.php';
    }
endif;

/**
 * Get header Elementor custom
 */
if (!function_exists('elessi_header_elm')) :
    function elessi_header_elm() {
        if (apply_filters('ns_hfe_template_render_focus', false)) {
            global $nasa_header_hfe;
        } else {
            $nasa_header_hfe = '';
            
            if (function_exists('nasa_hfe_shortcode_by_id')) {
                global $nasa_opt;

                if ($nasa_opt['header-elm']) {
                    $nasa_header_hfe = nasa_hfe_shortcode_by_id($nasa_opt['header-elm'], true);
                }
            }
        }
        
        $file = ELESSI_CHILD_PATH . '/headers/header-elementor.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/headers/header-elementor.php';
    }
endif;

/**
 * Topbar
 */
if (!function_exists('elessi_header_topbar')) :
    function elessi_header_topbar($mobile = false) {
        global $wp_query, $nasa_opt;
        
        /**
         * Topbar On | Off
         */
        $topbar_on = !isset($nasa_opt['topbar_on']) || $nasa_opt['topbar_on'] ? true : false;
        if (!$topbar_on) {
            return;
        }
        
        $queryObjId = $wp_query->get_queried_object_id();
        
        /**
         * Top bar Toggle
         */
        $topbar_toggle = get_post_meta($queryObjId, '_nasa_topbar_toggle', true);
        $topbar_df_show = $topbar_toggle == 1 ? get_post_meta($queryObjId, '_nasa_topbar_default_show', true) : '';

        $topbar_toggle_val = $topbar_toggle == '' ? (isset($nasa_opt['topbar_toggle']) && $nasa_opt['topbar_toggle'] ? true : false) : ($topbar_toggle == 1 ? true : false);
        $topbar_df_show_val = $topbar_df_show == '' ? (!isset($nasa_opt['topbar_default_show']) || $nasa_opt['topbar_default_show'] ? true : false) : ($topbar_df_show == 1 ? true : false);

        $class_topbar = $topbar_toggle_val ? ' nasa-topbar-toggle' : '';
        $class_topbar .= $topbar_df_show_val ? '' : ' nasa-topbar-hide';
        
        /**
         * Top bar content
         */
        $topbar_left = '';
        if (isset($nasa_opt['topbar_content']) && $nasa_opt['topbar_content']) {
            $topbar_left = elessi_get_block($nasa_opt['topbar_content']);
        }
        
        /**
         * Old data
         */
        elseif (isset($nasa_opt['topbar_left']) && $nasa_opt['topbar_left'] != '') {
            $topbar_left = do_shortcode($nasa_opt['topbar_left']);
        }
        
        $file = ELESSI_CHILD_PATH . '/headers/top-bar.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/headers/top-bar.php';
    }
endif;

/**
 * Topbar Mobile App
 */
if (!function_exists('elessi_header_topbar_mobile_app')) :
    function elessi_header_topbar_mobile_app() {
        global $nasa_opt;
        
        /**
         * Topbar On | Off
         */
        $topbar_on = !isset($nasa_opt['topbar_on']) || $nasa_opt['topbar_on'] ? true : false;
        if (!$topbar_on) {
            return;
        }
        
        $mobile = true;
        
        /**
         * Top bar content Hidden
         */
        $class_topbar = ' hidden-tag';
        
        /**
         * Top bar content empty
         */
        $topbar_left = '';
        
        $file = ELESSI_CHILD_PATH . '/headers/top-bar.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/headers/top-bar.php';
    }
endif;

/**
 * Topbar header Type 7
 */
add_action('nasa_topbar_header_7', 'elessi_topbar_t7_header_icon');
if (!function_exists('elessi_topbar_t7_header_icon')) :
    function elessi_topbar_t7_header_icon() {
        $html = '';
        
        /**
         * Support Account icon
         */
        add_filter('nasa_account_sp', 'elessi_sp_account_true');
    
        /**
         * $product_cat = false,
         * $cart = false,
         * $compare = true,
         * $wishlist = true,
         * $search = false
         */
        $html .= elessi_header_icons(false, false, true, true, false);
        
        /**
         * Remove Support Account icon
         */
        remove_filter('nasa_account_sp', 'elessi_sp_account_true');
        
        /**
         * Follow
         */
        if (shortcode_exists('nasa_follow')) :
            $html .= do_shortcode('[nasa_follow tip="right"]');
        endif;
        
        echo $html;
    }
endif;

/**
 * Support account icon
 */
if (!function_exists('elessi_sp_account_true')) :
    function elessi_sp_account_true($acc_sp) {
        return true;
    }
endif;

/**
 * Topbar mobile
 */
if (!function_exists('elessi_header_topbar_mobile')) :
    function elessi_header_topbar_mobile() {
        elessi_header_topbar(true);
    }
endif;

/**
 * Topbar menu
 */
add_action('nasa_topbar_menu', 'elessi_topbar_menu', 15);
add_action('nasa_mobile_topbar_menu', 'elessi_topbar_menu', 15);
if (!function_exists('elessi_topbar_menu')) :
    function elessi_topbar_menu() {
        elessi_get_menu('topbar-menu', 'nasa-topbar-menu', 1);
    }
endif;

/**
 * Topbar Account
 */
add_action('nasa_topbar_menu', 'elessi_topbar_account', 20);
if (!function_exists('elessi_topbar_account')) :
    function elessi_topbar_account() {
        global $nasa_opt;
        
        echo (!isset($nasa_opt['acc_pos']) || $nasa_opt['acc_pos'] == 'top') ?
            elessi_tiny_account(true) : '';
    }
endif;

/**
 * Mobile account menu
 */
if (!function_exists('elessi_mobile_account')) :
    function elessi_mobile_account() {
        $file = ELESSI_CHILD_PATH . '/includes/nasa-mobile-account.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mobile-account.php';
    }
endif;

/**
 * Shortcode group icons header
 */
add_shortcode('nasa_sc_icons', 'elessi_header_icons_sc');
if (!function_exists('elessi_header_icons_sc')) :
    function elessi_header_icons_sc($atts = array(), $content = null) {
        $dfAttr = array(
            'show_mini_acc' => 'yes',
            'show_mini_cart' => 'yes',
            'show_mini_compare' => 'yes',
            'show_mini_wishlist' => 'yes',
            'el_class' => ''
        );
        extract(shortcode_atts($dfAttr, $atts));

        $cart = $show_mini_cart == 'yes' ? true : false;
        $compare = $show_mini_compare == 'yes' ? true : false;
        $wishlist = $show_mini_wishlist == 'yes' ? true : false;
        
        $class = 'nasa-header-icons-sc';
        $class .= $el_class != '' ? ' ' . $el_class : '';
        
        if ($show_mini_acc === 'yes') {
            add_filter('nasa_account_sp', function() {
                return true;
            });
        } else {
            add_filter('nasa_account_sp', function() {
                return false;
            });
        }
        
        $content = '<div class="' . esc_attr($class) . '">' .
            elessi_header_icons(false, $cart, $compare, $wishlist, false) .
        '</div>';
        
        return $content;
    }
endif;

/**
 * Short code header search
 */
add_shortcode('nasa_sc_search_form', 'elessi_header_search_sc');
if (!function_exists('elessi_header_search_sc')) :
    function elessi_header_search_sc($atts = array(), $content = null) {
        $dfAttr = array(
            'el_class' => ''
        );
        extract(shortcode_atts($dfAttr, $atts));
        
        $class = 'nasa-header-search-sc';
        $class .= $el_class != '' ? ' ' . $el_class : '';
        
        $content = '<div class="' . esc_attr($class) . '">' .
            elessi_search('full') .
        '</div>';
        
        return $content;
    }
endif;

/**
 * Get breadcrumb
 */
if (!function_exists('elessi_get_breadcrumb')) :
    function elessi_get_breadcrumb() {
        if (!NASA_WOO_ACTIVED) {
            return;
        }

        global $post, $nasa_opt;
        
        $enable = isset($nasa_opt['breadcrumb_show']) && !$nasa_opt['breadcrumb_show'] ? false : true;
        
        $row = isset($nasa_opt['breadcrumb_row']) && $nasa_opt['breadcrumb_row'] == 'single' ? 'single' : 'multi';
        
        $is_product = is_product();
        $is_product_cat = is_product_category();
        $is_product_taxonomy = is_product_taxonomy();
        $is_shop = is_shop();
        
        $mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
        $override = false;

        // Theme option
        $has_bg = isset($nasa_opt['breadcrumb_type']) && $nasa_opt['breadcrumb_type'] == 'has-background' ?
            true : false;
        
        $bg_key = $mobile ? 'breadcrumb_bg_m' : 'breadcrumb_bg';

        $bg = isset($nasa_opt[$bg_key]) && trim($nasa_opt[$bg_key]) != '' ?
            $nasa_opt[$bg_key] : false;

        $bg_cl = isset($nasa_opt['breadcrumb_bg_color']) && $nasa_opt['breadcrumb_bg_color'] ?
            $nasa_opt['breadcrumb_bg_color'] : false;
        
        $txt_color = isset($nasa_opt['breadcrumb_color']) && $nasa_opt['breadcrumb_color'] ?
            $nasa_opt['breadcrumb_color'] : false;
        
        $bread_align = !isset($nasa_opt['breadcrumb_align']) ? 'text-center' : $nasa_opt['breadcrumb_align'];

        $h_key = $mobile ? 'breadcrumb_height_m' : 'breadcrumb_height';
        $h_bg = isset($nasa_opt[$h_key]) && (int) $nasa_opt[$h_key] ?
            (int) $nasa_opt[$h_key] : false;
        
        $bg_lax = isset($nasa_opt['breadcrumb_bg_lax']) && $nasa_opt['breadcrumb_bg_lax'] ?
            true : false;

        /**
         * Override breadcrumb
         */
        if ($is_shop || $is_product_cat || $is_product_taxonomy || $is_product) {
            $pageShop = wc_get_page_id('shop');
            $root_cat_id = elessi_get_root_term_id();

            /**
             * Check Root Category
             */
            if ($root_cat_id) {
                // cat_breadcrumb_allow
                $enable_override = get_term_meta($root_cat_id, 'cat_breadcrumb_allow', true);
                
                /**
                 * Not show breadcrumb
                 */
                if ($enable_override == -1) {
                    return;
                }
                
                if ($enable_override == 1) {
                    $enable = true;
                }
                
                /**
                 * Not show breadcrumb
                 */
                if (!$enable) {
                    return;
                }
                
                /**
                 * Bg image
                 */
                $bg_cat_enable = get_term_meta($root_cat_id, 'cat_breadcrumb', true);
                
                if ($bg_cat_enable == -1) {
                    $has_bg = false;
                }

                elseif ($bg_cat_enable) {
                    $bg_key = $mobile ? 'cat_breadcrumb_bg_m' : 'cat_breadcrumb_bg';
                    $bg_id = get_term_meta($root_cat_id, $bg_key, true);
                    if ($bg_id) {
                        $bg = wp_get_attachment_image_url($bg_id, 'full');
                        $has_bg = true;
                    }
                }
                
                $row_override = get_term_meta($root_cat_id, 'cat_breadcrumb_layout', true);
                
                $bg_cl_override = get_term_meta($root_cat_id, 'cat_breadcrumb_bg_color', true);
                $color_override = get_term_meta($root_cat_id, 'cat_breadcrumb_text_color', true);
                
                $align_override = get_term_meta($root_cat_id, 'cat_breadcrumb_align', true);
                
                $h_key = $mobile ? 'cat_breadcrumb_height_m' : 'cat_breadcrumb_height';
                $h_override = get_term_meta($root_cat_id, $h_key, true);
                
                $row = $row_override ? $row_override : $row;

                $bg_cl = $bg_cl_override ? $bg_cl_override : $bg_cl;
                $txt_color = $color_override ? $color_override : $txt_color;
                $h_bg = (int) $h_override ? (int) $h_override : $h_bg;

                $bread_align = $align_override ? $align_override : $bread_align;
            }

            /**
             * Breadcrumb shop page
             */
            elseif ($is_shop && $pageShop > 0) {
                $show_breadcrumb = get_post_meta($pageShop, '_nasa_show_breadcrumb', true);
                $enable = ($show_breadcrumb != 'on') ? false : true;
                
                if (!$enable) {
                    return;
                }
                
                $queryObj = $pageShop;
                $override = true;
            }
        }

        else {
            $pageBlog = get_option('page_for_posts');
            
            /**
             * Check page
             */
            if (isset($post->ID) && $post->post_type == 'page') {
                $queryObj = $post->ID;
                $show_breadcrumb = get_post_meta($queryObj, '_nasa_show_breadcrumb', true);
                $enable = ($show_breadcrumb != 'on') ? false : true;
                $override = true;
            }

            /**
             * Check Blog | archive post | single post
             */
            elseif ($pageBlog && isset($post->post_type) && $post->post_type == 'post' && (is_category() || is_tag() || is_date() || is_home() || is_single())) {
                $show_breadcrumb = get_post_meta($pageBlog, '_nasa_show_breadcrumb', true);
                $enable = ($show_breadcrumb != 'on') ? false : true;
                $queryObj = $pageBlog;
                $override = true;
            }

            if (!$enable) {
                return;
            }
        }
        
        // Override
        if ($override) {

            $row_override = get_post_meta($queryObj, '_nasa_layout_breadcrumb', true);
            
            $type_bg = get_post_meta($queryObj, '_nasa_type_breadcrumb', true);

            $bg_key = $mobile ? '_nasa_bg_breadcrumb_m' : '_nasa_bg_breadcrumb';
            $bg_override = get_post_meta($queryObj, $bg_key, true);

            $bg_cl_override = get_post_meta($queryObj, '_nasa_bg_color_breadcrumb', true);
            $color_override = get_post_meta($queryObj, '_nasa_color_breadcrumb', true);
            
            $align_override = get_post_meta($queryObj, '_nasa_align_breadcrumb', true);

            $h_key = $mobile ? '_nasa_height_breadcrumb_m' : '_nasa_height_breadcrumb';
            $h_override = get_post_meta($queryObj, $h_key, true);

            if ($type_bg == '-1') {
                $bg = false;
            }

            if ($type_bg == '1') {
                $bg = $bg_override ? $bg_override : $bg;
            }
            
            $row = $row_override ? $row_override : $row;

            $bg_cl = $bg_cl_override ? $bg_cl_override : $bg_cl;
            $txt_color = $color_override ? $color_override : $txt_color;
            $h_bg = (int) $h_override ? (int) $h_override : $h_bg;
            
            $bread_align = $align_override ? $align_override : $bread_align;
        }

        // set style by option breadcrumb
        $style_custom = '';
        if ($has_bg && $bg) {
            $style_custom .= 'background:url(' . esc_url($bg) . ')';
            $style_custom .= $bg_lax ? ' center center repeat-y;' : ';background-size:cover;';
        }

        $style_custom .= $bg_cl ? 'background-color:' . $bg_cl . ';' : '';
        $style_custom .= $txt_color ? 'color:' . $txt_color . ';' : '';
        $style_height = $h_bg ? 'height:' . $h_bg . 'px;' : 'height:auto;';
        
        $parallax = ($has_bg && $bg && $bg_lax) ? true : false;
        
        $class_all = array('bread nasa-breadcrumb style-' . $row);
        $attr_all = array('id="nasa-breadcrumb-site"');
        
        if ($has_bg) {
            $class_all[] = 'nasa-breadcrumb-has-bg';
        }
        
        if ($parallax) {
            $class_all[] = 'nasa-parallax nasa-parallax-stellar';
            $attr_all[] = 'data-stellar-background-ratio="0.6"';
            
            // jquery-migrate
            wp_enqueue_script('jquery-migrate', ELESSI_THEME_URI . '/assets/js/min/jquery-migrate.min.js', array('jquery'), null);
            
            // Parallax - js
            wp_enqueue_script('jquery-stellar', ELESSI_THEME_URI . '/assets/js/min/jquery.stellar.min.js', array('jquery'), null, true);
        }
        
        if ($style_custom) {
            $attr_all[] = 'style="' . esc_attr($style_custom) . '"';
        }
        
        $class_all_string = !empty($class_all) ? implode(' ', $class_all) : '';
        if ($class_all_string) {
            $attr_all[] = 'class="' . esc_attr($class_all_string) . '"';
        }
        
        $attr_all_string = !empty($attr_all) ? ' ' . implode(' ', $attr_all) : '';
        
        $delimiter = !NASA_RTL ? '<svg class="d-ltr" width="20" height="20" viewBox="0 -1 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" /></svg>' : '<svg class="d-rtl" width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z" /></svg>';
        
        $defaults = apply_filters('nasa_breadcrumb_args', array(
            'delimiter' => $delimiter,
            'wrap_before' => '<span class="breadcrumb">',
            'wrap_after' => '</span>',
            'before' => '',
            'after' => '',
            'home' => esc_html__('Home', 'elessi-theme'),
            'row' => $row
        ));
        
        $args = apply_filters('woocommerce_breadcrumb_defaults', $defaults);
        
        $wc_breadcrumbs = new WC_Breadcrumb();

        if (!empty($args['home'])) {
            $wc_breadcrumbs->add_crumb(
                $args['home'],
                apply_filters('woocommerce_breadcrumb_home_url', home_url('/'))
            );
        }
        
        $args['breadcrumb'] = $wc_breadcrumbs->generate();
        
        do_action('woocommerce_breadcrumb', $wc_breadcrumbs, $args);
        
        if (empty($args['breadcrumb'])) {
            return;
        }
        ?>
        
        <div<?php echo $attr_all_string; ?>>
            <div class="row">
                <div class="large-12 columns nasa-display-table breadcrumb-wrap <?php echo esc_attr($bread_align); ?>">
                    <nav class="breadcrumb-row"<?php echo $style_height ? ' style="' . esc_attr($style_height).'"' : ''; ?>>
                        <?php wc_get_template('global/breadcrumb.php', $args); ?>
                    </nav>
                </div>
                
                <?php do_action('nasa_after_breadcrumb'); ?>
            </div>
        </div>

        <?php
    }
endif;

/**
 * Build breadcrumb Portfolio
 */
if (!function_exists('elessi_rebuilt_breadcrumb_portfolio')) :
    function elessi_rebuilt_breadcrumb_portfolio($orgBreadcrumb = array(), $single = true) {
        global $nasa_opt;
        
        $breadcrumb = isset($orgBreadcrumb[0]) ? array($orgBreadcrumb[0]) : array();
        
        $portfolio = null;
        $terms = null;
        if (isset($nasa_opt['nasa-page-view-portfolio']) && (int) $nasa_opt['nasa-page-view-portfolio']) {
            $portfolio = get_post((int) $nasa_opt['nasa-page-view-portfolio']);
        } else {
            $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'portfolio.php'
            ));

            if ($pages) {
                foreach ($pages as $page) {
                    $portfolio = get_post((int) $page->ID);
                    break;
                }
            }
        }

        if ($portfolio) {
            $breadcrumb[] = array(
                0 => $portfolio->post_title,
                1 => get_permalink($portfolio)
            );
            
            $terms = wp_get_post_terms(
                $portfolio->ID,
                'portfolio_category',
                array(
                    'orderby' => 'parent',
                    'order' => 'DESC'
                )
            );
        }

        if ($terms) {
            $main_term = $terms[0];
            $ancestors = get_ancestors($main_term->term_id, 'portfolio_category');
            $ancestors = array_reverse($ancestors);
            if (count($ancestors)) {
                foreach ($ancestors as $ancestor) {
                    $ancestor = get_term($ancestor, 'portfolio_category');

                    if ($ancestor) {
                        $breadcrumb[] = array(
                            0 => $ancestor->name,
                            1 => get_term_link($ancestor, 'portfolio_category')
                        );
                    }
                }
            }

            if ($single) {
                $breadcrumb[] = array(
                    0 => $main_term->name,
                    1 => get_term_link($main_term, 'portfolio_category')
                );
            }
        }

        return $breadcrumb;
    }
endif;

/**
 * Open wrap Breadcrumb for Elementor Pro - Header Builder
 */
if (!function_exists('elessi_open_elm_breadcrumb')) :
    function elessi_open_elm_breadcrumb() {
        echo '<!-- Begin Breadcrumb for Elementor Pro - Header Builder --><div class="nasa-breadcrumb-wrap">';
    }
endif;

/**
 * Close wrap Breadcrumb for Elementor Pro - Header Builder
 */
if (!function_exists('elessi_close_elm_breadcrumb')) :
    function elessi_close_elm_breadcrumb() {
        echo '</div><!-- End Breadcrumb for Elementor Pro - Header Builder -->';
    }
endif;

/**
 * Since 5.0.1
 * 
 * Left Header Mobile Default
 * 
 * Hook: nasa_left_header_mobile_df
 */
add_action('nasa_left_header_mobile_df', 'elessi_left_header_mobile_df');
if (!function_exists('elessi_left_header_mobile_df')) :
    function elessi_left_header_mobile_df() {
        echo '<a href="javascript:void(0);" class="nasa-icon nasa-mobile-menu_toggle mobile_toggle nasa-mobile-menu-icon nasa-flex" rel="nofollow"><svg width="26" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12" /><line x1="3" y1="6" x2="21" y2="6" /><line x1="3" y1="18" x2="21" y2="18" /></svg></a>';
        
        echo '<a class="nasa-icon mobile-search" href="javascript:void(0);" rel="nofollow"><svg fill="currentColor" viewBox="0 0 80 80" width="24" height="24"><path d="M74.3,72.2L58.7,56.5C69.9,44,69,24.8,56.5,13.5s-31.7-10.3-43,2.2s-10.3,31.7,2.2,43c11.6,10.5,29.3,10.5,40.9,0 l15.7,15.7L74.3,72.2z M36.1,63.5c-15.1,0-27.4-12.3-27.4-27.4C8.7,20.9,21,8.7,36.1,8.7c15.1,0,27.4,12.3,27.4,27.4 C63.5,51.2,51.2,63.5,36.1,63.5z"/><path d="M36.1,12.8v3c11.2,0,20.3,9.1,20.3,20.3h3C59.4,23.2,49,12.8,36.1,12.8z"/></svg></a>';
    }
endif;

/**
 * Since 5.0.1
 * 
 * Center Header Mobile Default
 * 
 * Hook: nasa_center_header_mobile_df
 */
add_action('nasa_center_header_mobile_df', 'elessi_center_header_mobile_df');
if (!function_exists('elessi_center_header_mobile_df')) :
    function elessi_center_header_mobile_df() {
        echo elessi_logo();
    }
endif;

/**
 * Since 5.0.1
 * 
 * Right Header Mobile Default
 * Hook: nasa_right_header_mobile_df
 */
add_action('nasa_right_header_mobile_df', 'elessi_right_header_mobile_df');
if (!function_exists('elessi_right_header_mobile_df')) :
    function elessi_right_header_mobile_df() {
       echo elessi_header_icons_mobile();
    }
endif;

/**
 * Since 5.0.1
 * 
 * Left Header Mobile App
 * 
 * Hook: nasa_left_header_mobile_app
 */
add_action('nasa_left_header_mobile_app', 'elessi_left_header_mobile_app');
if (!function_exists('elessi_left_header_mobile_app')) :
    function elessi_left_header_mobile_app() {
        // $single_product = NASA_WOO_ACTIVED && is_product() ? true : false;
    
        echo elessi_back_history();
        
        if (NASA_WOO_ACTIVED && is_product()) {
            $url = apply_filters('nasa_back_to_shop', wc_get_page_permalink('shop'));
            
            echo apply_filters('ns_single_product_back_to_shop', '<a href="' . esc_url($url) . '" class="nasa-icon ns-icon ns-back-shop nasa-flex">
            <svg class="svg-back_shop" viewBox="0 0 32 32">
                <g transform="matrix(0.048565, 0, 0, 0.048565, 24.580261, 2.974931)">
                    <g transform="matrix(1, 0, 0, 1, -518.638794, 10.322351)">
                    <path d="M 325.775 138.986 L 325.775 3.106 L 226.224 3.106 L 206.439 139.36 C 206.645 170.27 234.133 190.889 268.991 190.889 C 303.978 190.889 325.803 170.085 325.803 139.017 C 325.803 139.007 325.803 138.997 325.803 138.986 L 325.775 138.986 Z M 184.112 137.888 L 203.681 3.106 L 97.891 3.106 L 58.284 139.43 C 58.584 170.266 86.435 190.733 121.233 190.733 C 156.222 190.733 184.07 170.085 184.07 139.017 C 184.07 138.63 184.088 138.254 184.128 137.89 L 184.112 137.888 Z M 594.367 -19.814 C 599.223 -19.831 603.454 -16.894 604.618 -12.712 L 646.637 136.813 C 646.84 137.534 646.943 138.276 646.947 139.019 C 646.947 180.185 613.869 209.926 567.511 209.926 C 531.02 209.926 499.688 193.287 489.208 175.252 C 478.646 193.118 453.202 209.443 416.701 209.443 C 380.201 209.443 352.393 193.307 341.803 175.252 C 331.352 193.145 304.741 212.29 268.25 212.29 C 231.749 212.29 205.105 193.207 194.551 175.252 C 184.058 193.315 157.589 211.144 121.098 211.144 C 74.74 211.144 36.736 180.185 36.736 139.019 C 36.741 138.277 36.843 137.534 37.048 136.813 L 79.14 -12.712 C 80.303 -16.894 84.542 -19.831 89.392 -19.814 L 594.367 -19.814 Z M 348.045 139.207 C 348.045 170.275 381.317 188.935 416.303 188.935 C 450.995 188.935 476.125 170.509 476.599 139.807 L 456.751 3.106 L 348.015 3.295 L 348.015 138.403 C 348.035 138.666 348.045 138.933 348.045 139.207 Z M 499.694 139.017 C 499.694 170.085 533.968 189.636 568.956 189.636 C 603.758 189.636 624.426 170.27 624.721 139.43 L 585.114 3.106 C 587.139 0.878 481.773 1.17 480.014 3.106 L 499.402 136.59 C 499.593 137.337 499.694 138.147 499.694 139.017 Z" style="stroke-width: 0px;"/>
                    <path d="M 84.471 189.481 L 84.471 477.433 C 84.471 477.433 84.553 498.229 93.5 514.914 C 102.449 531.6 120.513 544.603 156.583 544.603 L 527.101 544.603 C 527.101 544.603 555.31 542.288 573.205 533.941 C 591.1 525.599 599.213 510.85 599.213 477.431 L 599.213 189.48 L 577.499 189.098 L 577.499 477.049 C 577.499 501.307 570.068 508.99 557.08 515.043 C 544.094 521.099 527.101 521.66 527.101 521.66 L 156.583 521.66 C 130.839 521.66 118.528 516.699 112.038 504.589 C 105.541 492.481 105.426 477.431 105.426 477.431 L 105.426 189.48 L 84.471 189.481 Z" style="stroke-width: 0px;"/>
                    <path d="M 305.173 310.741 C 271.149 310.741 253.821 328.39 245.355 345.327 C 236.885 362.259 237.011 378.904 237.011 378.904 L 237.011 525.004 L 260 525.004 L 260 378.904 C 260 378.904 260.061 367.149 266.204 354.864 C 272.349 342.576 280.805 333.685 305.338 333.685 L 383.276 333.685 C 383.276 333.685 392.741 333.794 405.026 339.942 C 417.314 346.087 428.659 354.397 428.659 378.907 L 428.663 525.007 L 451.275 525.007 L 451.275 378.907 C 451.275 345.025 433.626 327.554 416.689 319.089 C 399.757 310.619 383.112 310.745 383.112 310.745 L 305.173 310.741 Z" style="stroke-width: 0px;"/>
                    </g>
                </g>
            </svg></a>');
        } else {
            echo '<a href="javascript:void(0);" class="nasa-icon nasa-mobile-menu_toggle mobile_toggle nasa-mobile-menu-icon nasa-flex" rel="nofollow"><svg width="26" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12" /><line x1="3" y1="6" x2="21" y2="6" /><line x1="3" y1="18" x2="21" y2="18" /></svg></a>';
        }
    }
endif;

/**
 * Since 5.0.1
 * 
 * Center Header Mobile App
 * 
 * Hook: nasa_center_header_mobile_app
 */
add_action('nasa_center_header_mobile_app', 'elessi_center_header_mobile_app');
if (!function_exists('elessi_center_header_mobile_app')) :
    function elessi_center_header_mobile_app() {
        echo elessi_logo();
    }
endif;

/**
 * Since 5.0.1
 * 
 * Right Header Mobile App
 * 
 * Hook: nasa_right_header_mobile_app
 */
add_action('nasa_right_header_mobile_app', 'elessi_right_header_mobile_app');
if (!function_exists('elessi_right_header_mobile_app')) :
    function elessi_right_header_mobile_app() {
        echo elessi_header_icons_mobile_app();
    }
endif;

/**
 * Since 5.0.3
 * 
 * Left Header Mobile Responsive
 * 
 * Hook: nasa_left_header_mobile_rp
 */
add_action('nasa_left_header_mobile_rp', 'elessi_left_header_mobile_rp');
if (!function_exists('elessi_left_header_mobile_rp')) :
    function elessi_left_header_mobile_rp() {
        // echo '<a href="javascript:void(0);" class="nasa-icon nasa-mobile-menu_toggle mobile_toggle nasa-mobile-menu-icon" rel="nofollow"><svg width="25" height="30" viewBox="0 0 26 32" fill="currentColor"><path d="M0.205 6.937h25.59v4.265h-25.59v-4.265z" /><path d="M0.205 13.867h25.59v4.265h-25.59v-4.265z" /><path d="M0.205 20.798h25.59v4.265h-25.59v-4.265z" /></svg></a>';
        
        echo '<a href="javascript:void(0);" class="nasa-icon nasa-mobile-menu_toggle mobile_toggle nasa-mobile-menu-icon nasa-flex" rel="nofollow"><svg width="26" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12" /><line x1="3" y1="6" x2="21" y2="6" /><line x1="3" y1="18" x2="21" y2="18" /></svg></a>';
        
        // echo '<a href="javascript:void(0);" class="nasa-icon mobile-search fs-23" rel="nofollow"><svg width="24" height="24" viewBox="0 0 32 32"><path d="M28.591 27.273l-7.263-7.264c1.46-1.756 2.339-4.010 2.339-6.471 0-5.595-4.535-10.129-10.129-10.129-5.594 0-10.129 4.535-10.129 10.129 0 5.594 4.536 10.129 10.129 10.129 2.462 0 4.716-0.879 6.471-2.339l7.263 7.264 1.319-1.319zM4.475 13.538c0-4.997 4.065-9.063 9.063-9.063 4.997 0 9.063 4.066 9.063 9.063s-4.066 9.063-9.063 9.063c-4.998 0-9.063-4.066-9.063-9.063z" fill="currentColor" /></svg></a>';
        echo '<a href="javascript:void(0);" class="nasa-icon mobile-search fs-23" rel="nofollow"><svg fill="currentColor" viewBox="0 0 80 80" width="22" height="22"><path d="M74.3,72.2L58.7,56.5C69.9,44,69,24.8,56.5,13.5s-31.7-10.3-43,2.2s-10.3,31.7,2.2,43c11.6,10.5,29.3,10.5,40.9,0 l15.7,15.7L74.3,72.2z M36.1,63.5c-15.1,0-27.4-12.3-27.4-27.4C8.7,20.9,21,8.7,36.1,8.7c15.1,0,27.4,12.3,27.4,27.4 C63.5,51.2,51.2,63.5,36.1,63.5z"/><path d="M36.1,12.8v3c11.2,0,20.3,9.1,20.3,20.3h3C59.4,23.2,49,12.8,36.1,12.8z" /></svg></a>';
    }
endif;

/**
 * Since 5.0.3
 * 
 * Center Header Mobile Responsive
 * 
 * Hook: nasa_center_header_mobile_rp
 */
add_action('nasa_center_header_mobile_rp', 'elessi_center_header_mobile_rp');
if (!function_exists('elessi_center_header_mobile_rp')) :
    function elessi_center_header_mobile_rp() {
        echo elessi_logo();
    }
endif;

/**
 * Since 5.0.3
 * 
 * Right Header Mobile Responsive
 * Hook: nasa_right_header_mobile_rp
 */
add_action('nasa_right_header_mobile_rp', 'elessi_right_header_mobile_rp');
if (!function_exists('elessi_right_header_mobile_rp')) :
    function elessi_right_header_mobile_rp() {
       echo elessi_header_icons_mobile();
    }
endif;
