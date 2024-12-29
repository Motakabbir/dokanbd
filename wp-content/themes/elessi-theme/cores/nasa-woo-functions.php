<?php

use function WPML\FP\apply;

defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Get product meta value
 */
if (!function_exists('elessi_get_product_meta_value')):
    function elessi_get_product_meta_value($post_id = 0, $field_id = null) {
        if ($post_id && function_exists('nasa_get_product_meta_value')) {
            return nasa_get_product_meta_value($post_id, $field_id);
        }
        
        return null;
    }
endif;

/**
 * Custom shopping cart page when empty
 */
add_filter('wc_empty_cart_message', 'elessi_empty_cart_message');
if (!function_exists('elessi_empty_cart_message')) :
    function elessi_empty_cart_message($mess) {
        $allowed_html = array(
            'span' => array(
                'class' => array()
            ),
            'br' => array()
        );
        
        $mess = wp_kses(__('Your cart is currently empty.<span class="nasa-extra-empty">Before proceed to checkout you must add some products to shopping cart.<br />You will find a lot of interesting products on our "Shop" page.</span>', 'elessi-theme'), $allowed_html);

        return $mess;
    }
endif;

/**
 * Link account
 */
if (!function_exists('elessi_link_account')) {
    function elessi_link_account() {
        $links = false;
        
        /* Active woocommerce */
        if (NASA_WOO_ACTIVED) {
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            
            if ($myaccount_page_id) {
                $links = get_permalink($myaccount_page_id);
            }
            
        } else {
            $links = !NASA_CORE_USER_LOGGED ? wp_login_url() : admin_url('profile.php');
        }
        
        return $links ? $links : home_url('/');
    }
}

/**
 * Tiny account
 */
if (!function_exists('elessi_tiny_account')) {
    function elessi_tiny_account($icon = false) {
        global $nasa_opt;
        
        if (isset($nasa_opt['hide_tini_menu_acc']) && $nasa_opt['hide_tini_menu_acc']) {
            return '';
        }
        
        $links = elessi_link_account();

        $result = '<ul class="nasa-menus-account">';
        
        $icon_user = apply_filters('nasa_mini_icon_account', '<svg width="24" height="24" viewBox="0 0 32 32" fill="currentColor"><path d="M16 3.205c-7.067 0-12.795 5.728-12.795 12.795s5.728 12.795 12.795 12.795 12.795-5.728 12.795-12.795c0-7.067-5.728-12.795-12.795-12.795zM16 4.271c6.467 0 11.729 5.261 11.729 11.729 0 2.845-1.019 5.457-2.711 7.49-1.169-0.488-3.93-1.446-5.638-1.951-0.146-0.046-0.169-0.053-0.169-0.66 0-0.501 0.206-1.005 0.407-1.432 0.218-0.464 0.476-1.244 0.569-1.944 0.259-0.301 0.612-0.895 0.839-2.026 0.199-0.997 0.106-1.36-0.026-1.7-0.014-0.036-0.028-0.071-0.039-0.107-0.050-0.234 0.019-1.448 0.189-2.391 0.118-0.647-0.030-2.022-0.921-3.159-0.562-0.719-1.638-1.601-3.603-1.724l-1.078 0.001c-1.932 0.122-3.008 1.004-3.57 1.723-0.89 1.137-1.038 2.513-0.92 3.159 0.172 0.943 0.239 2.157 0.191 2.387-0.010 0.040-0.025 0.075-0.040 0.111-0.131 0.341-0.225 0.703-0.025 1.7 0.226 1.131 0.579 1.725 0.839 2.026 0.092 0.7 0.35 1.48 0.569 1.944 0.159 0.339 0.234 0.801 0.234 1.454 0 0.607-0.023 0.614-0.159 0.657-1.767 0.522-4.579 1.538-5.628 1.997-1.725-2.042-2.768-4.679-2.768-7.555 0-6.467 5.261-11.729 11.729-11.729zM7.811 24.386c1.201-0.49 3.594-1.344 5.167-1.808 0.914-0.288 0.914-1.058 0.914-1.677 0-0.513-0.035-1.269-0.335-1.908-0.206-0.438-0.442-1.189-0.494-1.776-0.011-0.137-0.076-0.265-0.18-0.355-0.151-0.132-0.458-0.616-0.654-1.593-0.155-0.773-0.089-0.942-0.026-1.106 0.027-0.070 0.053-0.139 0.074-0.216 0.128-0.468-0.015-2.005-0.17-2.858-0.068-0.371 0.018-1.424 0.711-2.311 0.622-0.795 1.563-1.238 2.764-1.315l1.011-0.001c1.233 0.078 2.174 0.521 2.797 1.316 0.694 0.887 0.778 1.94 0.71 2.312-0.154 0.852-0.298 2.39-0.17 2.857 0.022 0.078 0.047 0.147 0.074 0.217 0.064 0.163 0.129 0.333-0.025 1.106-0.196 0.977-0.504 1.461-0.655 1.593-0.103 0.091-0.168 0.218-0.18 0.355-0.051 0.588-0.286 1.338-0.492 1.776-0.236 0.502-0.508 1.171-0.508 1.886 0 0.619 0 1.389 0.924 1.68 1.505 0.445 3.91 1.271 5.18 1.77-2.121 2.1-5.035 3.4-8.248 3.4-3.183 0-6.073-1.277-8.188-3.342z"/></svg>&nbsp;');
        
        /**
         * Not Logged in
         */
        if (!NASA_CORE_USER_LOGGED) {
            global $nasa_opt;
            
            $login_ajax = (!isset($nasa_opt['login_ajax']) || $nasa_opt['login_ajax'] == 1) ? '1' : '0';
            $span = $icon ? $icon_user : '';
            
            $result .= '<li class="menu-item"><a class="nasa-login-register-ajax inline-block" data-enable="' . $login_ajax . '" href="' . esc_url($links) . '" title="' . esc_attr__('Login / Register', 'elessi-theme') . '">' . $span . '<span class="nasa-login-title">' . esc_html__('Login / Register', 'elessi-theme') . '</span></a></li>';
        }
        
        /**
         * Logged in
         */
        else {
            $span1 = $icon ? $icon_user : '';
            $submenu = elessi_sub_account();
            
            $result .= 
                '<li class="menu-item nasa-menu-item-account menu-item-has-children root-item">' .
                    '<a href="' . esc_url($links) . '" title="' . esc_attr__('My Account', 'elessi-theme') . '">' . $span1 . esc_html__('My Account', 'elessi-theme') . '</a>' .
                    $submenu .
                '</li>';
        }
        
        $result .= '</ul>';
        
        return apply_filters('nasa_tiny_account_ajax', $result);
    }
}

/**
 * Submenu Account
 */
if (!function_exists('elessi_sub_account')) :
    function elessi_sub_account() {
        if (!NASA_CORE_USER_LOGGED) {
            return '';
        }
        
        $submenu = '<ul class="sub-menu">';
            
        /**
         * Hello Account
         */
        $current_user = wp_get_current_user();
        $submenu .= '<li class="nasa-subitem-acc nasa-hello-acc">' . sprintf(esc_html__('Hello, %s!', 'elessi-theme'), $current_user->display_name) . '</li>';

        $menu_items = NASA_WOO_ACTIVED ? wc_get_account_menu_items() : false;
        if ($menu_items) {
            foreach ($menu_items as $endpoint => $label) {
                $submenu .= '<li class="nasa-subitem-acc ' . wc_get_account_menu_item_classes($endpoint) . '"><a href="' . esc_url(wc_get_account_endpoint_url($endpoint)) . '">';
                
                /**
                 * Logout - menu
                 */
                $submenu .= $endpoint == 'customer-logout' ? '<svg width="20" height="28" viewBox="0 0 32 32" fill="currentColor"><path d="M14.389 7.956v4.374l1.056 0.010c7.335 0.071 11.466 3.333 12.543 9.944-4.029-4.661-8.675-4.663-12.532-4.664h-1.067v4.337l-9.884-7.001 9.884-7zM15.456 5.893l-12.795 9.063 12.795 9.063v-5.332c5.121 0.002 9.869 0.26 13.884 7.42 0-4.547-0.751-14.706-13.884-14.833v-5.381z" /></svg>&nbsp;' : '';
                
                $submenu .= esc_html($label);
                
                $submenu .= '</a></li>';
            }
        }

        $submenu .= '</ul>';
        
        return $submenu;
    }
endif;

/**
 * icon cart
 */
if (!function_exists('elessi_mini_cart_icon')) :
    function elessi_mini_cart_icon() {
        global $nasa_opt;
        
        $icon_number = isset($nasa_opt['mini-cart-icon']) ? $nasa_opt['mini-cart-icon'] : '1';
        
        switch ($icon_number) {
            case '2':
                $icon = '<svg class="nasa-rotate-svg nasa-icon cart-icon nasa-icon-' . $icon_number . '" viewBox="0 0 512 512" fill="currentColor" width="22" height="22"><path fill-rule="evenodd" clip-rule="evenodd" d="M511 41l-41 252c-4 32-34 59-67 59l-35 0 0 42c0 66-46 118-112 118-65 0-112-52-112-118l0-42-38 0c-33 0-63-27-67-59l-38-252c-2-13 1-24 7-31 7-7 16-10 27-10l437 0c17 0 26 6 31 12 5 5 10 14 8 29z m-335 353c0 48 33 86 80 86 48 0 80-38 80-86l0-42-160 0z m298-362l-437 0c-2 0-5 1-5 5l39 252c2 17 18 31 35 31l38 0 0-37c-10-5-16-15-16-27 0-18 14-32 32-32 18 0 32 14 32 32 0 12-6 22-16 27l0 37 160 0 0-37c-10-5-16-15-16-27 0-18 14-32 32-32 18 0 32 14 32 32 0 12-6 22-16 27l0 37 35 0c17 0 33-14 35-32l42-252c0-2-2-4-6-4z" fill="currentColor"/></svg>';
                break;
            
            case '3':
                $icon = '<svg class="nasa-rotate-svg nasa-icon cart-icon nasa-icon-' . $icon_number . '" width="24" height="24" viewBox="0 -30 512 512" fill="currentColor"><path fill="currentColor" d="M487 0c-153 0-308 0-462 0 15 125 29 252 45 375 27 0 53 0 81 0-5 66 31 110 81 120 74 17 138-42 129-120 28 0 55 0 82 0 15-125 30-249 44-375z m-235 476c-49-3-84-42-78-101 55 0 110 0 165 0 5 62-31 103-87 101z m-164-123c-13-111-26-222-39-332 138 0 276 0 413 0-12 112-26 222-38 334-22 0-43 0-63 0 0-7 0-14 0-21 6-6 10-10 10-21-2-23-43-25-43 3 0 9 8 12 11 20 1 5-1 10 0 20-56 0-111 0-166 0-6-26 10-23 10-41 0-27-43-27-42 1 0 10 7 12 10 20 1 5 0 10 0 20-20 0-41 0-63 0 0-2 0-3 0-3z"/></svg>';
                break;
            
            case '4':
                $icon = '<svg class="nasa-icon cart-icon nasa-icon-' . $icon_number . '" width="28" height="28" viewBox="0 0 32 32"><path d="M30.622 9.602h-22.407l-1.809-7.464h-5.027v1.066h4.188l5.198 21.443c-1.108 0.323-1.923 1.334-1.923 2.547 0 1.472 1.193 2.666 2.666 2.666s2.666-1.194 2.666-2.666c0-0.603-0.208-1.153-0.545-1.599h7.487c-0.337 0.446-0.545 0.997-0.545 1.599 0 1.472 1.193 2.666 2.665 2.666s2.666-1.194 2.666-2.666c0-1.473-1.193-2.665-2.666-2.666v0h-11.403l-0.517-2.133h14.968l4.337-12.795zM13.107 27.196c0 0.882-0.717 1.599-1.599 1.599s-1.599-0.717-1.599-1.599c0-0.882 0.717-1.599 1.599-1.599s1.599 0.718 1.599 1.599zM24.836 27.196c0 0.882-0.718 1.599-1.6 1.599s-1.599-0.717-1.599-1.599c0-0.882 0.717-1.599 1.599-1.599 0.882 0 1.6 0.718 1.6 1.599zM11.058 21.331l-2.585-10.662h20.662l-3.615 10.662h-14.462z" fill="currentColor"/></svg>';
                break;
            
            case '5':
                $icon = '<svg class="nasa-flip-vertical nasa-icon cart-icon nasa-icon-' . $icon_number . '" width="28" height="28" viewBox="0 0 1700 1200"><path d="M640 0q0 -52 -38 -90t-90 -38t-90 38t-38 90t38 90t90 38t90 -38t38 -90zM1536 0q0 -52 -38 -90t-90 -38t-90 38t-38 90t38 90t90 38t90 -38t38 -90zM1664 1088v-512q0 -24 -16.5 -42.5t-40.5 -21.5l-1044 -122q13 -60 13 -70q0 -16 -24 -64h920q26 0 45 -19t19 -45 t-19 -45t-45 -19h-1024q-26 0 -45 19t-19 45q0 11 8 31.5t16 36t21.5 40t15.5 29.5l-177 823h-204q-26 0 -45 19t-19 45t19 45t45 19h256q16 0 28.5 -6.5t19.5 -15.5t13 -24.5t8 -26t5.5 -29.5t4.5 -26h1201q26 0 45 -19t19 -45z" fill="currentColor"/></svg>';
                break;
            
            case '6':
                $icon = '<svg class="nasa-rotate-svg nasa-icon cart-icon nasa-icon-' . $icon_number . '" width="28" height="28" viewBox="0 0 2000 1200"><path d="M1757 128l35 -313q3 -28 -16 -50q-19 -21 -48 -21h-1664q-29 0 -48 21q-19 22 -16 50l35 313h1722zM1664 967l86 -775h-1708l86 775q3 24 21 40.5t43 16.5h256v-128q0 -53 37.5 -90.5t90.5 -37.5t90.5 37.5t37.5 90.5v128h384v-128q0 -53 37.5 -90.5t90.5 -37.5 t90.5 37.5t37.5 90.5v128h256q25 0 43 -16.5t21 -40.5zM1280 1152v-256q0 -26 -19 -45t-45 -19t-45 19t-19 45v256q0 106 -75 181t-181 75t-181 -75t-75 -181v-256q0 -26 -19 -45t-45 -19t-45 19t-19 45v256q0 159 112.5 271.5t271.5 112.5t271.5 -112.5t112.5 -271.5z" fill="currentColor"/></svg>';
                break;
            
            case '7':
                $icon = '<svg class="nasa-rotate-svg nasa-icon cart-icon nasa-icon-' . $icon_number . '" width="28" height="28" viewBox="0 0 2000 1200"><path d="M1920 768q53 0 90.5 -37.5t37.5 -90.5t-37.5 -90.5t-90.5 -37.5h-15l-115 -662q-8 -46 -44 -76t-82 -30h-1280q-46 0 -82 30t-44 76l-115 662h-15q-53 0 -90.5 37.5t-37.5 90.5t37.5 90.5t90.5 37.5h1792zM485 -32q26 2 43.5 22.5t15.5 46.5l-32 416q-2 26 -22.5 43.5 t-46.5 15.5t-43.5 -22.5t-15.5 -46.5l32 -416q2 -25 20.5 -42t43.5 -17h5zM896 32v416q0 26 -19 45t-45 19t-45 -19t-19 -45v-416q0 -26 19 -45t45 -19t45 19t19 45zM1280 32v416q0 26 -19 45t-45 19t-45 -19t-19 -45v-416q0 -26 19 -45t45 -19t45 19t19 45zM1632 27l32 416 q2 26 -15.5 46.5t-43.5 22.5t-46.5 -15.5t-22.5 -43.5l-32 -416q-2 -26 15.5 -46.5t43.5 -22.5h5q25 0 43.5 17t20.5 42zM476 1244l-93 -412h-132l101 441q19 88 89 143.5t160 55.5h167q0 26 19 45t45 19h384q26 0 45 -19t19 -45h167q90 0 160 -55.5t89 -143.5l101 -441 h-132l-93 412q-11 44 -45.5 72t-79.5 28h-167q0 -26 -19 -45t-45 -19h-384q-26 0 -45 19t-19 45h-167q-45 0 -79.5 -28t-45.5 -72z" fill="currentColor"/></svg>';
                break;
            
            case '1':
            default:
                $icon = '<svg class="nasa-icon cart-icon nasa-icon-' . $icon_number . '" width="28" height="28" viewBox="0 0 32 32" fill="currentColor"><path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 27.729h-23.457v-23.457h23.457v23.457z" /><path d="M9.068 13.334c0 3.828 3.104 6.931 6.931 6.931s6.93-3.102 6.93-6.931v-3.732h1.067v-1.066h-3.199v1.066h1.065v3.732c0 3.234-2.631 5.864-5.864 5.864-3.234 0-5.865-2.631-5.865-5.864v-3.732h1.067v-1.066h-3.199v1.066h1.065v3.732z"/></svg>';
                break;
        }

        return apply_filters('nasa_mini_icon_cart', $icon);
    }
endif;

/**
 * Mini cart icon
 * 
 * @global type $nasa_opt
 * @global type $nasa_mini_cart
 * @param type $recount
 * @return type
 */
if (!function_exists('elessi_mini_cart')) {
    function elessi_mini_cart($recount = false) {
        global $nasa_opt, $nasa_mini_cart;
        
        if (!NASA_WOO_ACTIVED || (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart'])) {
            return '';
        }
        
        if (!$nasa_mini_cart) {
            $count = $recount ? WC()->cart->get_cart_contents_count() : 0;
            $class = $count ? '' : ' hidden-tag nasa-product-empty';
            
            if ($count && (!isset($nasa_opt['compact_number']) || $nasa_opt['compact_number'])) {
                $count = $count > 9 ? '9+' : $count;
            }
            
            $icon_class = elessi_mini_cart_icon();
            
            $nasa_mini_cart = 
            '<a href="' . esc_url(wc_get_cart_url()) . '" class="cart-link mini-cart cart-inner nasa-flex jc" title="' . esc_attr__('Cart', 'elessi-theme') . '" rel="nofollow">' .
                '<span class="icon-wrap">' . $icon_class .
                    '<span class="nasa-cart-count nasa-mini-number cart-number' . $class . '">' .
                        apply_filters('nasa_mini_cart_total_items', $count) .
                    '</span>' .
                '</span>' .
                '<span class="icon-text hidden-tag">' . esc_html__('Cart', 'elessi-theme') . '</span>' .
            '</a>';
            
            $nasa_mini_cart = apply_filters('nasa_mini_cart', $nasa_mini_cart);
            
            $GLOBALS['nasa_mini_cart'] = $nasa_mini_cart;
        }
        
        return $nasa_mini_cart;
    }
}

/**
 * Add to cart dropdown - Refresh mini cart content.
 */
add_filter('woocommerce_add_to_cart_fragments', 'elessi_add_to_cart_refresh');
if (!function_exists('elessi_add_to_cart_refresh')) :
    function elessi_add_to_cart_refresh($fragments) {
        $fragments['.cart-inner'] = elessi_mini_cart(true);
        
        if (isset($_REQUEST['product_id'])) {

            $svg = '<svg class="ns-check-svg" width="32" height="32" viewBox="0 0 32 32"><path d="M16 2.672c-7.361 0-13.328 5.967-13.328 13.328s5.968 13.328 13.328 13.328c7.361 0 13.328-5.967 13.328-13.328s-5.967-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.501-12.262-12.262s5.5-12.262 12.262-12.262c6.761 0 12.262 5.501 12.262 12.262s-5.5 12.262-12.262 12.262z" fill="currentColor"/><path d="M22.667 11.241l-8.559 8.299-2.998-2.998c-0.312-0.312-0.818-0.312-1.131 0s-0.312 0.818 0 1.131l3.555 3.555c0.156 0.156 0.361 0.234 0.565 0.234 0.2 0 0.401-0.075 0.556-0.225l9.124-8.848c0.317-0.308 0.325-0.814 0.018-1.131-0.309-0.318-0.814-0.325-1.131-0.018z" fill="currentColor"/></svg>';

            $fragments['.woocommerce-message'] = sprintf(
                '<div class="woocommerce-message text-center" role="alert">%s</div>',
                $svg . esc_html__('Product added to cart successfully!', 'elessi-theme')
            );
        }

        return $fragments;
    }
endif;

/**
 * Open Cart Sidebar - With disable AJAX Add To Cart - Quickview | Single Product Page
 */
add_action('wp_head', 'elessi_added_cart_event_sidebar');
if (!function_exists('elessi_added_cart_event_sidebar')) :
    function elessi_added_cart_event_sidebar() {
        global $nasa_opt;

        if (!isset($nasa_opt['enable_ajax_addtocart']) || $nasa_opt['enable_ajax_addtocart'] == '1' || (isset($nasa_opt['event-after-add-to-cart']) && $nasa_opt['event-after-add-to-cart'] !== 'sidebar')) {
            return;
        }

        if (isset($_POST['add-to-cart']) && $_POST['add-to-cart']) {
            wc_clear_notices();

            add_filter('nasa_cart_sidebar_show', function() {
                return true;
            });
        }
    }
endif;

/**
 * Mini wishlist sidebar
 */
if (!function_exists('elessi_mini_wishlist_sidebar')) {
    function elessi_mini_wishlist_sidebar($return = false) {
        if (!NASA_WOO_ACTIVED){
            return '';
        }
        
        global $nasa_opt;
        
        if (!NASA_WISHLIST_ENABLE && isset($nasa_opt['enable_nasa_wishlist']) && !$nasa_opt['enable_nasa_wishlist']) :
            return '';
        endif;
        
        if ($return) :
            ob_start();
        endif;
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-sidebar-wishlist.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-sidebar-wishlist.php';
        
        if ($return) :
            $content = ob_get_clean();
            return $content;
        endif;
    }
}

if (!function_exists('nasa_gen_categories_map_child')) {
    function nasa_gen_categories_map_child($cats) {
        if (!NASA_WOO_ACTIVED){
            return '';
        }
        
        $content_child = '';
        $args = array(
            'taxonomy' => 'product_cat',
            'hierarchical' => true,
            'parent' => $cats->term_taxonomy_id
        );
    
        $childrens = get_terms(apply_filters('woocommerce_product_attribute_terms', $args));
    
        if (count($childrens) > 0) {
            $content_child = '<ul class="ns-cat-child">';
    
            foreach ($childrens as $children) {

                $count = '<span class="count">' . $children->count .'</span>';
    
                $link = get_term_link($children, 'product_cat');
                $content_child .= '<li>';  
                $content_child .= '<a class="ns-cat-tree-link" href="' . esc_url($link) . '" title="' . esc_attr($children->name) . '">' . $children->name . $count . '</a>'; 
                $content_child .= nasa_gen_categories_map_child($children);
                $content_child .= '</li>';
            }
    
            $content_child .= '</ul>';
        }
    
        return $content_child;
    }
}

if (!function_exists('nasa_get_categories_map')) {
    function nasa_get_categories_map() {
        global $nasa_opt;
        
        if (!NASA_WOO_ACTIVED){
            return '';
        }
        
        $args = array(
            'taxonomy' => 'product_cat',
            'hierarchical' => true,
            'hide_empty' => false,
            'parent' => 0
        );
    
        $cats = get_terms(apply_filters('woocommerce_product_attribute_terms', $args));

        $columns_number = isset($nasa_opt['where_you_are_cls']) && $nasa_opt['where_you_are_cls'] ? $nasa_opt['where_you_are_cls'] : '4';
        $columns_number_small = isset($nasa_opt['where_you_are_cls_s']) && $nasa_opt['where_you_are_cls_s'] ? $nasa_opt['where_you_are_cls_s'] : '1';
        $columns_number_tablet = isset($nasa_opt['where_you_are_cls_m']) && $nasa_opt['where_you_are_cls_m'] ? $nasa_opt['where_you_are_cls_m'] : '3';
    
        $column_class = 'large-block-grid-' .  $columns_number . ' small-block-grid-' .  $columns_number_small . ' medium-block-grid-' .  $columns_number_tablet ;
    
        $content = '<ul class="ns-categories-tree-warp ' . $column_class . '" data-columns="' . $columns_number . '" data-columns-small="' . $columns_number_small . '" data-columns-tablet="' . $columns_number_tablet . '">';
    
        $number_cat_each = floor(count($cats) / $columns_number);
        $leftover_cat = count($cats) % $columns_number;
    
        for ($i = 0; $i < $columns_number; $i++) {
    
            $number_cat = ($i < $leftover_cat) ? ($number_cat_each + 1) : $number_cat_each;
            $cats_splices = array_splice($cats, 0, $number_cat);
    
            $content .= '<li class="ns-categories-tree-column">';
    
            foreach ($cats_splices as $cats_splice) {
                $count = '<span class="count">' . $cats_splice->count .'</span>';
    
                $link = get_term_link($cats_splice, 'product_cat');
                $content .= '<div class="ns-cat-root">';  
                $content .= '<a class="ns-cat-tree-link nasa-bold" title="' . esc_attr($cats_splice->name) . '" href="' . esc_url($link) . '">' . $cats_splice->name . $count . '</a>'; 
                $content .= nasa_gen_categories_map_child($cats_splice);
                $content .= '</div>';
            }
    
            $content .= '</li>';
        }
    
        $content .= '</ul>';
    
        return $content;
    }
}

if (!function_exists('nasa_get_menu_map')) {
    function nasa_get_menu_map() {
        global $nasa_opt;

        $arr_menu = array_filter(get_nav_menu_locations());
        $menu = wp_get_nav_menu_object($arr_menu['primary']);
        $menu_items = wp_get_nav_menu_items($menu->term_id, array('update_post_term_cache' => false));
        $menu_pa = array();

        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent === '0') {
                $menu_pa[] = $menu_item;
            }
        }

        $columns_number = isset($nasa_opt['where_you_are_cls']) && $nasa_opt['where_you_are_cls'] ? $nasa_opt['where_you_are_cls'] : '4';
        $columns_number_small = isset($nasa_opt['where_you_are_cls_s']) && $nasa_opt['where_you_are_cls_s'] ? $nasa_opt['where_you_are_cls_s'] : '1';
        $columns_number_tablet = isset($nasa_opt['where_you_are_cls_m']) && $nasa_opt['where_you_are_cls_m'] ? $nasa_opt['where_you_are_cls_m'] : '3';
    
        $column_class = 'large-block-grid-' .  $columns_number . ' small-block-grid-' .  $columns_number_small . ' medium-block-grid-' .  $columns_number_tablet ;
    
        $content = '<ul class="ns-categories-tree-warp ' . $column_class . '" data-columns="' . $columns_number . '" data-columns-small="' . $columns_number_small . '" data-columns-tablet="' . $columns_number_tablet . '">';
    
        $number_menu_each = floor(count($menu_pa) / $columns_number);
        $leftover_menu = count($menu_pa) % $columns_number;
    
        for ($i = 0; $i < $columns_number; $i++) {
            $number_menu = ($i < $leftover_menu) ? ($number_menu_each + 1) : $number_menu_each;
            $menu_splices = array_splice($menu_pa, 0, $number_menu);
    
            $content .= '<li class="ns-categories-tree-column">';
    
            foreach ($menu_splices as $menu_splice) {
                $content .= '<div class="ns-cat-root">';  
                $content .= '<a class="ns-cat-tree-link ns-menu-link nasa-bold" title="' . esc_attr($menu_splice->title) . '" href="' . esc_url($menu_splice->url) . '">' . $menu_splice->title . '</a>'; 
                $content .= nasa_gen_menu_map_child($menu_splice,$menu_items);
                $content .= '</div>';
            }
    
            $content .= '</li>';
        }
    
        $content .= '</ul>';
    
        return  $content;
    }
}

if (!function_exists('nasa_gen_menu_map_child')) {
    function nasa_gen_menu_map_child($menu_splice,$menu_items) {
        $content_child ='';
        $menu_children = array();

        foreach ($menu_items as $menu_item) {
            if ($menu_item->menu_item_parent == $menu_splice->ID) {
                $menu_children[] = $menu_item;
            }
        }
    
        if (count($menu_children) > 0) {
            $content_child = '<ul class="ns-cat-child">';
    
            foreach ($menu_children as $menu_child) {
                $content_child .= '<li>';  
                $content_child .= '<a class="ns-cat-tree-link ns-menu-link" href="' . esc_url($menu_child->url) . '" title="' . esc_attr($menu_child->title) . '">' . $menu_child->title . '</a>'; 
                $content_child .= nasa_gen_menu_map_child($menu_child,$menu_items);
                $content_child .= '</li>';
            }
    
            $content_child .= '</ul>';
        }
    
        return $content_child;
    }
}

/**
 * Add to cart button from wishlist
 */
if (!function_exists('elessi_add_to_cart_in_wishlist')) :
    function elessi_add_to_cart_in_wishlist() {
        global $product, $nasa_opt;

        if (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart']) {
            return '';
        }
        
        if (!$product->is_in_stock() || !$product->is_purchasable()) {
            return '';
        }
        
        $enable_button_ajax = false;
        $product_type = $product->get_type();
        $product_id = $product->get_id();
        $url = esc_url($product->add_to_cart_url());

        if ($product_type == 'simple' || ($product_type == NASA_COMBO_TYPE && 'instock' === $product->get_bundled_items_stock_status())) {
            $enable_button_ajax = 'yes' === get_option('woocommerce_enable_ajax_add_to_cart') ? true : false;
            $url = $enable_button_ajax ? 'javascript:void(0);' : $url;
        }
        
        /**
         * Bundle product
         */
        if ($product_type == 'woosb') {
            $url = '?add-to-cart=' . $product_id;

            if (get_option('yith_wcwl_remove_after_add_to_cart') == 'yes') {
                $url .= '&remove_from_wishlist_after_add_to_cart=' . $product_id;
            }
        }
        
        $class_btn = 'button-in-wishlist small btn-from-wishlist add-to-cart-grid wishlist-fragment product_type_' . esc_attr($product_type);
        $class_btn .= $enable_button_ajax ? ' nasa_add_to_cart_from_wishlist' : '';
        
        $args = array(
            'quantity' => 1,
            'class' => $class_btn,
            'attributes' => array(
                'data-product_id'  => $product_id,
                'data-product_sku' => $product->get_sku(),
                'data-type'        => $product_type,
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );
        
        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
        
        $add_to_cart = apply_filters(
            'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
            sprintf(
                '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
                $url,
                esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
                esc_attr(isset($args['class']) ? $args['class'] : 'button'),
                isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
                esc_html($product->add_to_cart_text())
            ),
            $product,
            $args
        );
        
        if ($product_type === 'variable') {
            $add_to_cart .= sprintf('<a href="javascript:void(0);" class="quick-view nasa-view-from-wishlist hidden-tag" data-prod="%s" data-from_wishlist="1" rel="nofollow">%s</a>', $product_id, esc_html__('Quick View', 'elessi-theme'));
        }
        
        return $add_to_cart;
    }
endif;

/**
 * ARGS add to cart loop
 */
if (!function_exists('elessi_loop_add_to_cart_args')):
    function elessi_loop_add_to_cart_args($args, $product) {
        global $nasa_opt;
        
        /**
         * Custom Attributes
         */
        if (!isset($args['attributes'])) {
            $args['attributes'] = array();
        }
        
        $args['attributes']['title'] = $product->add_to_cart_text();
        
        /**
         * Custom Class
         */
        if (!isset($args['class'])) {
            $args['class'] = '';
        }
        
        $args['class'] .= ' add-to-cart-grid btn-link nasa-tip';
        
        $ajax_sp = 'yes' === get_option('woocommerce_enable_ajax_add_to_cart') ? true : false;
        
        if (!$ajax_sp) {
            $args['class'] .= ' nasa-disable-ajax';
        }
        
        if ($product->is_purchasable() && $product->is_in_stock()) {
            $product_type = $product->get_type();
            
            /**
             * Variation product
             */
            if ($product_type == 'variation') {
                $args['attributes']['data-variation_id'] = $product->get_id();
                $args['attributes']['data-variation'] = json_encode($product->get_variation_attributes());
            }
            
            /**
             * Yith Bundle product
             */
            if ($product_type == NASA_COMBO_TYPE) {
                $args['class'] .= $ajax_sp ? ' nasa_bundle_add_to_cart' : '';
                $args['attributes']['data-type'] = $product_type;
            }
        }
        
        /**
         * Custom Icon
         */
        $icon_cart = '';
        $icon_number = isset($nasa_opt['cart-icon-grid']) ? $nasa_opt['cart-icon-grid'] : '1';
        switch ($icon_number) {
            case '2':
                $icon_cart .= '<svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 27.729h-23.457v-23.457h23.457v23.457z" /><path d="M9.068 13.334c0 3.828 3.104 6.931 6.931 6.931s6.93-3.102 6.93-6.931v-3.732h1.067v-1.066h-3.199v1.066h1.065v3.732c0 3.234-2.631 5.864-5.864 5.864-3.234 0-5.865-2.631-5.865-5.864v-3.732h1.067v-1.066h-3.199v1.066h1.065v3.732z"/></svg>';
                break;
            
            case '3':
                $icon_cart .= '<svg class="nasa-rotate-svg" viewBox="0 0 512 512" fill="currentColor" width="18" height="18"><path fill-rule="evenodd" clip-rule="evenodd" d="M511 41l-41 252c-4 32-34 59-67 59l-35 0 0 42c0 66-46 118-112 118-65 0-112-52-112-118l0-42-38 0c-33 0-63-27-67-59l-38-252c-2-13 1-24 7-31 7-7 16-10 27-10l437 0c17 0 26 6 31 12 5 5 10 14 8 29z m-335 353c0 48 33 86 80 86 48 0 80-38 80-86l0-42-160 0z m298-362l-437 0c-2 0-5 1-5 5l39 252c2 17 18 31 35 31l38 0 0-37c-10-5-16-15-16-27 0-18 14-32 32-32 18 0 32 14 32 32 0 12-6 22-16 27l0 37 160 0 0-37c-10-5-16-15-16-27 0-18 14-32 32-32 18 0 32 14 32 32 0 12-6 22-16 27l0 37 35 0c17 0 33-14 35-32l42-252c0-2-2-4-6-4z" fill="currentColor" /></svg>';
                break;
            
            case '4':
                $icon_cart .= '<svg class="nasa-rotate-svg" width="18" height="18" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve" fill="currentColor"><path fill="currentColor" d="M487 0c-153 0-308 0-462 0 15 125 29 252 45 375 27 0 53 0 81 0-5 66 31 110 81 120 74 17 138-42 129-120 28 0 55 0 82 0 15-125 30-249 44-375z m-235 476c-49-3-84-42-78-101 55 0 110 0 165 0 5 62-31 103-87 101z m-164-123c-13-111-26-222-39-332 138 0 276 0 413 0-12 112-26 222-38 334-22 0-43 0-63 0 0-7 0-14 0-21 6-6 10-10 10-21-2-23-43-25-43 3 0 9 8 12 11 20 1 5-1 10 0 20-56 0-111 0-166 0-6-26 10-23 10-41 0-27-43-27-42 1 0 10 7 12 10 20 1 5 0 10 0 20-20 0-41 0-63 0 0-2 0-3 0-3z" /></svg>';
                break;
            
            case '5':
                $icon_cart .= '<svg width="18" height="18" viewBox="0 0 32 32"><path d="M30.622 9.602h-22.407l-1.809-7.464h-5.027v1.066h4.188l5.198 21.443c-1.108 0.323-1.923 1.334-1.923 2.547 0 1.472 1.193 2.666 2.666 2.666s2.666-1.194 2.666-2.666c0-0.603-0.208-1.153-0.545-1.599h7.487c-0.337 0.446-0.545 0.997-0.545 1.599 0 1.472 1.193 2.666 2.665 2.666s2.666-1.194 2.666-2.666c0-1.473-1.193-2.665-2.666-2.666v0h-11.403l-0.517-2.133h14.968l4.337-12.795zM13.107 27.196c0 0.882-0.717 1.599-1.599 1.599s-1.599-0.717-1.599-1.599c0-0.882 0.717-1.599 1.599-1.599s1.599 0.718 1.599 1.599zM24.836 27.196c0 0.882-0.718 1.599-1.6 1.599s-1.599-0.717-1.599-1.599c0-0.882 0.717-1.599 1.599-1.599 0.882 0 1.6 0.718 1.6 1.599zM11.058 21.331l-2.585-10.662h20.662l-3.615 10.662h-14.462z" fill="currentColor" /></svg>';
                break;
            
            case '6':
                $icon_cart .= '<svg class="nasa-flip-vertical" width="18" height="18" viewBox="0 0 1700 1200"><path d="M640 0q0 -52 -38 -90t-90 -38t-90 38t-38 90t38 90t90 38t90 -38t38 -90zM1536 0q0 -52 -38 -90t-90 -38t-90 38t-38 90t38 90t90 38t90 -38t38 -90zM1664 1088v-512q0 -24 -16.5 -42.5t-40.5 -21.5l-1044 -122q13 -60 13 -70q0 -16 -24 -64h920q26 0 45 -19t19 -45 t-19 -45t-45 -19h-1024q-26 0 -45 19t-19 45q0 11 8 31.5t16 36t21.5 40t15.5 29.5l-177 823h-204q-26 0 -45 19t-19 45t19 45t45 19h256q16 0 28.5 -6.5t19.5 -15.5t13 -24.5t8 -26t5.5 -29.5t4.5 -26h1201q26 0 45 -19t19 -45z" fill="currentColor" /></svg>';
                break;
            
            case '7':
                $icon_cart .= '<svg class="nasa-rotate-svg" width="18" height="18" viewBox="0 0 2000 1200"><path d="M1757 128l35 -313q3 -28 -16 -50q-19 -21 -48 -21h-1664q-29 0 -48 21q-19 22 -16 50l35 313h1722zM1664 967l86 -775h-1708l86 775q3 24 21 40.5t43 16.5h256v-128q0 -53 37.5 -90.5t90.5 -37.5t90.5 37.5t37.5 90.5v128h384v-128q0 -53 37.5 -90.5t90.5 -37.5 t90.5 37.5t37.5 90.5v128h256q25 0 43 -16.5t21 -40.5zM1280 1152v-256q0 -26 -19 -45t-45 -19t-45 19t-19 45v256q0 106 -75 181t-181 75t-181 -75t-75 -181v-256q0 -26 -19 -45t-45 -19t-45 19t-19 45v256q0 159 112.5 271.5t271.5 112.5t271.5 -112.5t112.5 -271.5z" fill="currentColor" /></svg>';
                break;
            
            case '8':
                $icon_cart .= '<svg class="nasa-rotate-svg" width="18" height="18" viewBox="0 0 2000 1200"><path d="M1920 768q53 0 90.5 -37.5t37.5 -90.5t-37.5 -90.5t-90.5 -37.5h-15l-115 -662q-8 -46 -44 -76t-82 -30h-1280q-46 0 -82 30t-44 76l-115 662h-15q-53 0 -90.5 37.5t-37.5 90.5t37.5 90.5t90.5 37.5h1792zM485 -32q26 2 43.5 22.5t15.5 46.5l-32 416q-2 26 -22.5 43.5 t-46.5 15.5t-43.5 -22.5t-15.5 -46.5l32 -416q2 -25 20.5 -42t43.5 -17h5zM896 32v416q0 26 -19 45t-45 19t-45 -19t-19 -45v-416q0 -26 19 -45t45 -19t45 19t19 45zM1280 32v416q0 26 -19 45t-45 19t-45 -19t-19 -45v-416q0 -26 19 -45t45 -19t45 19t19 45zM1632 27l32 416 q2 26 -15.5 46.5t-43.5 22.5t-46.5 -15.5t-22.5 -43.5l-32 -416q-2 -26 15.5 -46.5t43.5 -22.5h5q25 0 43.5 17t20.5 42zM476 1244l-93 -412h-132l101 441q19 88 89 143.5t160 55.5h167q0 26 19 45t45 19h384q26 0 45 -19t19 -45h167q90 0 160 -55.5t89 -143.5l101 -441 h-132l-93 412q-11 44 -45.5 72t-79.5 28h-167q0 -26 -19 -45t-45 -19h-384q-26 0 -45 19t-19 45h-167q-45 0 -79.5 -28t-45.5 -72z" fill="currentColor" /></svg>';
                break;
            
            case '1':
            default:
                $icon_cart .= '<svg class="ns-df-cart-svg" width="18" height="18" stroke-width="2" viewBox="0 0 24 24" fill="currentColor"><path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /><path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /></svg>';
                break;
        }
    
        $args['icon_cart'] = $icon_cart;
        
        $args['class'] = apply_filters('nasa_filter_add_to_cart_class', $args['class']);
        
        return $args;
    }
endif;

/**
 * Product group buttons
 */
if (!function_exists('elessi_product_group_button')):
    function elessi_product_group_button() {
        ob_start();
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-product-buttons.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-product-buttons.php';

        return ob_get_clean();
    }
endif;

/**
 * Wishlist link
 */
if (!function_exists('elessi_tini_wishlist')):
    function elessi_tini_wishlist($icon = false) {
        if (!NASA_WOO_ACTIVED || !NASA_WISHLIST_ENABLE) {
            return;
        }

        $tini_wishlist = '';
        
        $wishlist_page_id = get_option('yith_wcwl_wishlist_page_id');
        if (function_exists('icl_object_id')) {
            $wishlist_page_id = icl_object_id($wishlist_page_id, 'page', true);
        }
        
        $wishlist_page = get_permalink($wishlist_page_id);

        $span = $icon ? '<span class="icon-nasa-like"></span>' : '';
        
        $tini_wishlist .= '<a href="' . esc_url($wishlist_page) . '" title="' . esc_attr__('Wishlist', 'elessi-theme') . '">' . $span . esc_html__('Wishlist', 'elessi-theme') . '</a>';

        return $tini_wishlist;
    }
endif;

/**
 * Wishlist icons
 */
if (!function_exists('elessi_icon_wishlist')):
    function elessi_icon_wishlist() {
        if (!NASA_WOO_ACTIVED) {
            return '';
        }

        $svg_wishlist = '<svg class="nasa-icon wishlist-icon" width="28" height="28" viewBox="0 0 32 32"><path d="M21.886 5.115c3.521 0 6.376 2.855 6.376 6.376 0 1.809-0.754 3.439-1.964 4.6l-10.297 10.349-10.484-10.536c-1.1-1.146-1.778-2.699-1.778-4.413 0-3.522 2.855-6.376 6.376-6.376 2.652 0 4.925 1.62 5.886 3.924 0.961-2.304 3.234-3.924 5.886-3.924zM21.886 4.049c-2.345 0-4.499 1.089-5.886 2.884-1.386-1.795-3.54-2.884-5.886-2.884-4.104 0-7.442 3.339-7.442 7.442 0 1.928 0.737 3.758 2.075 5.152l11.253 11.309 11.053-11.108c1.46-1.402 2.275-3.308 2.275-5.352 0-4.104-3.339-7.442-7.442-7.442v0z" fill="currentColor" /></svg>';

        global $nasa_icon_wishlist;
        
        if (!isset($nasa_icon_wishlist)) {
            $show = defined('NASA_PLG_CACHE_ACTIVE') && NASA_PLG_CACHE_ACTIVE ? false : true;
            $count = elessi_get_count_wishlist($show);
            
            /**
             * Yith WooCommerce Wishlist
             */
            if (NASA_WISHLIST_ENABLE) {
                $class = 'wishlist-link nasa-flex ns-mini-yith-wcwl';
                
                $class .= ' wishlist-link-premium';
                $wishlist_page_id = get_option('yith_wcwl_wishlist_page_id');

                if (function_exists('icl_object_id') && $wishlist_page_id) {
                    $wishlist_page_id = icl_object_id($wishlist_page_id, 'page', true);
                }

                $href = $wishlist_page_id ? get_permalink($wishlist_page_id) : home_url('/');
                
                $icon = apply_filters('nasa_mini_icon_wishlist', $svg_wishlist);

                $nasa_icon_wishlist = 
                '<a class="' . $class . '" href="' . esc_url($href) . '" title="' . esc_attr__('Wishlist', 'elessi-theme') . '">' .
                    '<span class="icon-wrap">' .
                        $icon .
                        $count .
                    '</span>' .
                    '<span class="icon-text hidden-tag">' . esc_html__('Wishlist', 'elessi-theme') . '</span>' .
                '</a>';
            }
            
            /**
             * NasaTheme Wishlist
             */
            else {
                global $nasa_opt;

                if (isset($nasa_opt['enable_nasa_wishlist']) && !$nasa_opt['enable_nasa_wishlist']) {
                    return;
                }
                
                $class = 'wishlist-link nasa-wishlist-link nasa-flex';
                
                $icon = apply_filters('nasa_mini_icon_wishlist', $svg_wishlist);
                
                $nasa_icon_wishlist = 
                '<a class="' . $class . '" href="javascript:void(0);" title="' . esc_attr__('Wishlist', 'elessi-theme') . '" rel="nofollow">' .
                    '<span class="icon-wrap">' .
                        $icon .
                        $count .
                    '</span>' .
                    '<span class="icon-text hidden-tag">' . esc_html__('Wishlist', 'elessi-theme') . '</span>' .
                '</a>';
            }
            
            $GLOBALS['nasa_icon_wishlist'] = $nasa_icon_wishlist;
        }

        return isset($nasa_icon_wishlist) && $nasa_icon_wishlist ? apply_filters('nasa_mini_wishlist', $nasa_icon_wishlist) : '';
    }
endif;

/**
 * Count mini wishlist icon
 */
if (!function_exists('elessi_get_count_wishlist')) :
    function elessi_get_count_wishlist($show = true, $init_count = true) {
        if (!NASA_WOO_ACTIVED) {
            return '';
        }
        
        global $nasa_opt;
        
        $count = 0;
        if (NASA_WISHLIST_ENABLE) {
            $count = $init_count ? yith_wcwl_count_products() : 0;
        } else {
            $show = true;
        }
        
        $hasEmpty = (int) $count == 0 ? ' nasa-product-empty' : '';
        $sl = $show ? '' : ' hidden-tag';
        $class_wrap = 'nasa-wishlist-count nasa-mini-number wishlist-number' . $sl . $hasEmpty;
        
        if (!isset($nasa_opt['compact_number']) || $nasa_opt['compact_number']) {
            $count = $count > 9 ? '9+' : (int) $count;
        }
        
        return 
            '<span class="' . $class_wrap . '">' .
                apply_filters('nasa_mini_wishlist_total_items', $count) .
            '</span>';
    }
endif;

add_filter('yith_wcwl_fragment_output', function($frg) {
    $frg['.nasa-wishlist-count'] = elessi_get_count_wishlist();
            
    return $frg;
});

/**
 * Compare link
 */
if (!function_exists('elessi_icon_compare')):
    function elessi_icon_compare() {
        if (!NASA_WOO_ACTIVED || !defined('YITH_WOOCOMPARE')) {
            return;
        }

        global $nasa_icon_compare, $nasa_opt;
        
        if (!$nasa_icon_compare) {
            global $yith_woocompare;
            
            if (!isset($nasa_opt['nasa-product-compare']) || $nasa_opt['nasa-product-compare']) {
                $view_href = isset($nasa_opt['nasa-page-view-compage']) && (int) $nasa_opt['nasa-page-view-compage'] ? get_permalink((int) $nasa_opt['nasa-page-view-compage']) : home_url('/');
                $class = 'nasa-show-compare nasa-flex';
                $wrap = false;
            } else {
                $view_href = add_query_arg(array('iframe' => 'true'), $yith_woocompare->obj->view_table_url());
                $class = 'compare';
                $wrap = true;
            }
            
            $svg_compare = '<svg class="nasa-flip-vertical nasa-icon compare-icon" viewBox="0 30 512 512" width="28" height="28" fill="currentColor"><path d="M276 467c0 8 6 21-2 23l-26 0c-128-7-230-143-174-284 5-13 13-23 16-36-18 0-41 23-54 5 5-15 25-18 41-23 15-5 36-7 48-15-2 10 23 95 6 100-21 5-13-39-18-57-8-5-8 8-11 13-71 126 29 297 174 274z m44 13c-8 0-10 5-20 3 0-6-3-13-3-18 5-3 13-3 18-5 2 7 5 15 5 20z m38-18c-5 3-10 8-18 10-2-7-5-12-7-18 5-2 10-7 18-7 2 5 7 7 7 15z m34-31c0-33-18-71-5-99 23 2 12 38 17 58 90-117-7-314-163-289 0-8-3-10-3-20 131-5 233 84 220 225-2 36-20 66-30 92 12 0 51-26 53-2 3 17-82 28-89 35z m-233-325c5-2 13-5 18-10 0 8 5 10 7 18-5 2-10 8-18 8 0-8-7-8-7-16z m38-18c8 0 10-5 21-5 0 5 2 13 2 18-5 3-13 3-18 5 0-5-5-10-5-18z"/></svg>';

            $icon = apply_filters('nasa_mini_icon_compare', $svg_compare);
            
            $GLOBALS['nasa_icon_compare'] = 
            ($wrap ? '<span class="yith-woocompare-widget">' : '') .
                '<a href="' . esc_url($view_href) . '" title="' . esc_attr__('Compare', 'elessi-theme') . '" class="' . esc_attr($class) . '">' .
                    '<span class="icon-wrap">' .
                        $icon .
                        '<span class="nasa-compare-count nasa-mini-number compare-number nasa-product-empty">0</span>' .
                    '</span>' .
                    '<span class="icon-text hidden-tag">' . esc_html__('Compare', 'elessi-theme') . '</span>' .
                '</a>' .
            ($wrap ? '</span>' : '');
        }
        
        return $nasa_icon_compare ? apply_filters('nasa_mini_compare', $nasa_icon_compare) : '';
    }
endif;

/**
 * Count mini Compare icon
 */
if (!function_exists('elessi_get_count_compare')):
    function elessi_get_count_compare($show = true) {
        if (!NASA_WOO_ACTIVED || !defined('YITH_WOOCOMPARE')) {
            return '';
        }
        
        global $nasa_opt, $yith_woocompare;
        
        $count = count($yith_woocompare->obj->products_list);
        $hasEmpty = (int) $count == 0 ? ' nasa-product-empty' : '';
        
        $sl = $show ? '' : ' hidden-tag';
        $class_wrap = 'nasa-compare-count nasa-mini-number compare-number' . $sl . $hasEmpty;
        
        if (!isset($nasa_opt['compact_number']) || $nasa_opt['compact_number']) {
            $count = $count > 9 ? '9+' : (int) $count;
        }
        
        return
        '<span class="' . $class_wrap . '">' .
            apply_filters('nasa_mini_compare_total_items', $count) .
        '</span>';
    }
endif;

/**
 * Nasa root categories in Shop Top bar
 */
if (!function_exists('elessi_get_root_categories')):
    function elessi_get_root_categories() {
        global $nasa_opt;
        
        $content = '';
        
        if (isset($nasa_opt['top_filter_rootcat']) && !$nasa_opt['top_filter_rootcat']) {
            echo ($content);
            return;
        }
        
        if (!is_post_type_archive('product') && !is_tax(get_object_taxonomies('product'))) {
            echo ($content);
            return;
        }
        
        if (NASA_WOO_ACTIVED){
            $nasa_terms = get_terms(apply_filters('woocommerce_product_attribute_terms', array(
                'taxonomy' => 'product_cat',
                'parent' => 0,
                'hide_empty' => false,
                'orderby' => 'name'
            )));
            
            if ($nasa_terms) {
                $slug = get_query_var('product_cat');
                $nasa_catActive = $slug ? $slug : '';
                $content .= '<div class="nasa-transparent-topbar"></div>';
                $content .= '<div class="nasa-root-cat-topbar-warp hidden-tag"><ul class="nasa-root-cat product-categories">';
                $content .= '<li class="nasa_odd"><span class="nasa-root-cat-header">' . esc_html__('CATEGORIES', 'elessi-theme'). '</span></li>';
                $li_class = 'nasa_even';
                
                foreach ($nasa_terms as $v) {
                    $class_active = $nasa_catActive == $v->slug ? ' nasa-active' : '';
                    $content .= '<li class="cat-item cat-item-' . esc_attr($v->term_id) . ' cat-item-accessories root-item ' . $li_class . '">';
                    $content .= '<a href="' . esc_url(get_term_link($v)) . '" data-id="' . esc_attr($v->term_id) . '" class="nasa-filter-by-cat' . $class_active . '" title="' . esc_attr($v->name) . '" data-taxonomy="product_cat">' . esc_attr($v->name) . '</a>';
                    $content .= '</li>';
                    $li_class = $li_class == 'nasa_even' ? 'nasa_odd' : 'nasa_even';
                }
                
                $content .= '</ul></div>';
            }
        }
        
        $icon = $content != '' ? '<div class="nasa-icon-cat-topbar"><a href="javascript:void(0);" rel="nofollow"><i class="pe-7s-menu"></i><span class="inline-block">' . esc_html__('BROWSE', 'elessi-theme') . '</span></a></div>' : '';
        $content = $icon . $content;
        
        echo $content;
    }
endif;

/**
 * Categories thumbnail
 */
if (!function_exists('elessi_category_thumbnail')) :
    function elessi_category_thumbnail($category = null, $type = 'thumbnail') {
        if (!$category) {
            return '';
        }
    
        $img_str = '';
        $small_thumbnail_size = apply_filters('single_product_small_thumbnail_size', $type);
        $thumbnail_id = function_exists('get_term_meta') ? get_term_meta($category->term_id, 'thumbnail_id', true) : get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);

        $image_src = '';
        if ($thumbnail_id) {
            $image = wp_get_attachment_image_src($thumbnail_id, $small_thumbnail_size);
            $image_src = $image[0];
            $image_width = $image[1];
            $image_height = $image[2];
        } else {
            $image_src = wc_placeholder_img_src();
            $image_width = 100;
            $image_height = 100;
        }

        if ($image_src) {
            $image_src = str_replace(' ', '%20', $image_src);
            $img_str = '<img src="' . esc_url($image_src) . '" alt="' . esc_attr($category->name) . '" width="' . $image_width . '" height="' . $image_height . '" />';
        }

        return $img_str;
    }
endif;

/**
 * Login Or Register Form
 */
add_action('nasa_login_register_form', 'elessi_login_register_form', 10, 1);
if (!function_exists('elessi_login_register_form')) :
    function elessi_login_register_form($prefix = false) {
        global $nasa_opt;
        
        if (!NASA_WOO_ACTIVED) {
            return;
        }
        
        if ($prefix) {
            remove_action('woocommerce_before_customer_login_form', 'woocommerce_output_all_notices', 10);
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-login-register-form.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-login-register-form.php';
    }
endif;

/**
 * Number post_per_page shop/archive_product
 */
add_filter('loop_shop_per_page', 'elessi_loop_shop_per_page', 20);
if (!function_exists('elessi_loop_shop_per_page')) :
    function elessi_loop_shop_per_page($post_per_page) {
        global $nasa_opt;
        
        return (isset($nasa_opt['products_pr_page']) && (int) $nasa_opt['products_pr_page']) ? (int) $nasa_opt['products_pr_page'] : get_option('posts_per_page');
    }
endif;

/**
 * Number relate products
 */
add_filter('woocommerce_output_related_products_args', 'elessi_output_related_products_args');
if (!function_exists('elessi_output_related_products_args')) :
    function elessi_output_related_products_args($args) {
        global $nasa_opt;
        
        $args['posts_per_page'] = (isset($nasa_opt['relate_product_number']) && (int) $nasa_opt['relate_product_number']) ? (int) $nasa_opt['relate_product_number'] : 12;
        
        return $args;
    }
endif;

/**
 * Compare list in bot site
 */
add_action('nasa_show_mini_compare', 'elessi_show_mini_compare');
if (!function_exists('elessi_show_mini_compare')) :
    function elessi_show_mini_compare() {
        global $nasa_opt, $yith_woocompare;
        
        if (!class_exists('YITH_Woocompare_Frontend') || (isset($nasa_opt['nasa-product-compare']) && !$nasa_opt['nasa-product-compare'])) {
            return;
        }
        
        $nasa_compare = isset($yith_woocompare->obj) ? $yith_woocompare->obj : $yith_woocompare;
        
        if (!$nasa_compare || !($nasa_compare instanceof YITH_Woocompare_Frontend)) {
            return;
        }
        
        if (!isset($nasa_opt['nasa-page-view-compage']) || !(int) $nasa_opt['nasa-page-view-compage']) {
            $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'page-view-compare.php'
            ));
            
            if ($pages) {
                foreach ($pages as $page) {
                    $nasa_opt['nasa-page-view-compage'] = (int) $page->ID;
                    break;
                }
            }
        }
        
        $page_compare = isset($nasa_opt['nasa-page-view-compage']) && (int) $nasa_opt['nasa-page-view-compage'] ? (int) $nasa_opt['nasa-page-view-compage'] : 0;
        
        if (function_exists('icl_object_id') && $page_compare) {
            $page_langID = icl_object_id($page_compare, 'page', true);

            if ($page_langID && $page_langID != $page_compare) {
                $page_compare = (int) $page_langID;
            }
        }
        
        $view_href = $page_compare ? get_permalink($page_compare) : home_url('/');
        
        $nasa_compare_list = $nasa_compare->get_products_list();
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-compare.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-compare.php';
    }
endif;

/**
 * Empty Compare
 */
add_action('nasa_empty_mini_compare', 'elessi_empty_mini_compare');
if (!function_exists('elessi_empty_mini_compare')) :
    function elessi_empty_mini_compare() {
        global $nasa_opt, $yith_woocompare;
        
        if (!class_exists('YITH_Woocompare_Frontend') || (isset($nasa_opt['nasa-product-compare']) && !$nasa_opt['nasa-product-compare'])) {
            return;
        }
        
        $nasa_compare = isset($yith_woocompare->obj) ? $yith_woocompare->obj : $yith_woocompare;
        
        if (!$nasa_compare || !($nasa_compare instanceof YITH_Woocompare_Frontend)) {
            return;
        }
        
        if (!isset($nasa_opt['nasa-page-view-compage']) || !(int) $nasa_opt['nasa-page-view-compage']) {
            $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'page-view-compare.php'
            ));
            
            if ($pages) {
                foreach ($pages as $page) {
                    $nasa_opt['nasa-page-view-compage'] = (int) $page->ID;
                    break;
                }
            }
        }
        
        $page_compare = isset($nasa_opt['nasa-page-view-compage']) && (int) $nasa_opt['nasa-page-view-compage'] ? (int) $nasa_opt['nasa-page-view-compage'] : 0;
        
        if (function_exists('icl_object_id') && $page_compare) {
            $page_langID = icl_object_id($page_compare, 'page', true);

            if ($page_langID && $page_langID != $page_compare) {
                $page_compare = (int) $page_langID;
            }
        }
        
        $view_href = $page_compare ? get_permalink($page_compare) : home_url('/');
        
        // $nasa_compare_list = array();
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-mini-compare.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-mini-compare.php';
    }
endif;

/**
 * Default page compare
 */
if (!function_exists('elessi_products_compare_content')) :
    function elessi_products_compare_content($echo = false) {
        global $nasa_opt, $yith_woocompare;
        
        if (!class_exists('YITH_Woocompare_Frontend') || (isset($nasa_opt['nasa-product-compare']) && !$nasa_opt['nasa-product-compare'])) {
            return '';
        }
        
        $nasa_compare = isset($yith_woocompare->obj) ? $yith_woocompare->obj : $yith_woocompare;
        if (!$nasa_compare || !($nasa_compare instanceof YITH_Woocompare_Frontend)) {
            return '';
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-view-compare.php';
        if (!$echo) {
            ob_start();
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-view-compare.php';

            return ob_get_clean();
        } else {
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-view-compare.php';
        }
    }
endif;

/**
 * NEXT NAV ON SINGLE PRODUCT
 */
add_action('next_prev_product', 'elessi_next_product');
if (!function_exists('elessi_next_product')) :
    function elessi_next_product() {
        $next_post = get_next_post(true, '', 'product_cat');
        
        if (is_a($next_post, 'WP_Post')) {
            global $nasa_opt;
            
            $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
            
            $next_product = wc_get_product($next_post->ID);
            $title = $next_product->get_name();
            $link = $next_product->get_permalink();
            $class_ajax = defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT ? ' nasa-ajax-call' : '';
            ?>
            <div class="next-product next-prev-buttons">
                <a href="<?php echo esc_url($link); ?>" rel="next" class="icon-next-prev next<?php echo $class_ajax; ?>" title="<?php echo esc_attr($title); ?>">
                    <svg width="25" height="25" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z"/></svg>
                </a>
                
                <?php if (!$in_mobile) { ?>
                    <a class="dropdown-wrap<?php echo $class_ajax; ?>" title="<?php echo esc_attr($title); ?>" href="<?php echo esc_url($link); ?>">
                        <?php echo $next_product->get_image('thumbnail'); ?>
                        <div class="next-prev-info padding-left-10 rtl-padding-left-0 rtl-padding-right-10">
                            <p class="product-name"><?php echo $title; ?></p>
                            <span class="price"><?php echo $next_product->get_price_html(); ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <?php
        }
    }
endif;

/**
 * PRVE NAV ON SINGLE PRODUCT PAGE
 */
add_action('next_prev_product', 'elessi_prev_product');
if (!function_exists('elessi_prev_product')) :
    function elessi_prev_product() {
        $prev_post = get_previous_post(true, '', 'product_cat');
        
        if (is_a($prev_post, 'WP_Post')) {
            global $nasa_opt;
            
            $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
            
            $prev_product = wc_get_product($prev_post->ID);
            $title = $prev_product->get_name();
            $link = $prev_product->get_permalink();
            $class_ajax = defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT ? ' nasa-ajax-call' : '';
            ?>
            <div class="prev-product next-prev-buttons">
                <a href="<?php echo esc_url($link); ?>" rel="prev" class="icon-next-prev prev<?php echo $class_ajax; ?>" title="<?php echo esc_attr($title); ?>">
                    <svg width="25" height="25" viewBox="0 0 32 32" fill="currentColor"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z" /></svg>
                </a>
                
                <?php if (!$in_mobile) { ?>
                    <a class="dropdown-wrap<?php echo $class_ajax; ?>" title="<?php echo esc_attr($title); ?>" href="<?php echo esc_url($link); ?>">
                        <?php echo $prev_product->get_image('thumbnail'); ?>
                        <div class="next-prev-info padding-left-10 rtl-padding-left-0 rtl-padding-right-10">
                            <p class="product-name"><?php echo $title; ?></p>
                            <span class="price"><?php echo $prev_product->get_price_html(); ?></span>
                        </div>
                    </a>
                <?php } ?>
            </div>
            <?php
        }
    }
endif;

/**
 * ADD LIGHTBOX IMAGES BUTTON ON SINGLE PRODUCT PAGE
 */
add_action('nasa_single_buttons', 'elessi_product_single_lightbox_btn');
if (!function_exists('elessi_product_single_lightbox_btn')) {
    function elessi_product_single_lightbox_btn() {
        echo '<a class="product-lightbox-btn hidden-tag" href="javascript:void(0);" rel="nofollow"></a>';
    }
}

/**
 * ADD VIDEO PLAY BUTTON ON PRODUCT DETAIL PAGE
 */
add_action('nasa_single_buttons', 'elessi_product_video_btn', 9);
if (!function_exists('elessi_product_video_btn')) {
    function elessi_product_video_btn() {
        global $product;
        
        if (!$product) {
            return;
        }
        
        $id = $product->get_id();
        $video_link = elessi_get_product_meta_value($id, '_product_video_link');
 
        if ($video_link) {
            $video_link = str_replace('youtube.com/shorts/', 'youtube.com/watch?v=', $video_link);
            ?>
            <a class="nasa-icon product-video-popup nasa-tip nasa-tip-right" data-tip="<?php esc_attr_e('Play Video', 'elessi-theme'); ?>" href="<?php echo esc_url($video_link); ?>" title="<?php esc_attr_e('Play Video', 'elessi-theme'); ?>">
                <svg width="24" height="24" viewBox="0 0 28 32" fill="currentColor"><path d="M7.47 6.661l16.010 9.339-16.010 9.339v-18.678zM6.404 4.804v22.391l19.192-11.196-19.192-11.196z"/></svg>
                <?php /*i class="nasa-icon fa fa-play"></i */?>
            </a>

            <?php
            // $height = '800';
            // $width = '800';
            // $iframe_scale = '100%';
            
            $custom_size = elessi_get_product_meta_value($id, '_product_video_size');
            if ($custom_size) {
                $split = explode("x", $custom_size);
                $width = isset($split[0]) ? $split[0] : '800';
                $height = isset($split[1]) ? $split[1] : '800';
                // $iframe_scale = $width && $height ? ($width / $height * 100) . '%' : '100%';
                
                echo '<style>';
                echo '.has-product-video .mfp-iframe-holder .mfp-content {max-width: ' . $width . 'px; height: ' . $height . 'px;}';
                // echo '.has-product-video .mfp-iframe-scaler{padding-top: ' . $iframe_scale . ';}';
                echo '</style>';
                // wp_add_inline_style('product_detail_css_custom', $style);
            }
        }
    }
}

/**
 * Wishlist Button ext Yith Wishlist
 */
if (!function_exists('elessi_add_wishlist_button')) :
    function elessi_add_wishlist_button($tip = 'left') {
        if (NASA_WISHLIST_ENABLE) {
            global $product, $yith_wcwl, $nasa_opt;
            
            if (!$yith_wcwl) {
                return;
            }
            
            $variation = false;
            $productId = $product->get_id();
            $productType = $product->get_type();
            
            if ($productType == 'variation') {
                $variation_product = $product;
                $productId = wp_get_post_parent_id($productId);
                $parentProduct = wc_get_product($productId);
                $productType = $parentProduct->get_type();
                
                $GLOBALS['product'] = $parentProduct;
                $variation = true;
            }

            $class_btn = 'btn-wishlist btn-link wishlist-icon nasa-tip ns-yith-wcwl';
            $class_btn .= $tip !== 'label' ? ' nasa-tip-' . $tip : '';
            
            $exists = function_exists('YITH_WCWL') ? YITH_WCWL()->is_product_in_wishlist($productId) : false;
            $class_btn .= $exists ? ' nasa-added' : '';
            
            /**
             * Apply Filters Icon
             */
            $icon = apply_filters('nasa_icon_wishlist', '<i class="nasa-icon icon-nasa-like"></i>');
            ?>
            <a href="javascript:void(0);" class="<?php echo esc_attr($class_btn); ?>" data-prod="<?php echo (int) $productId; ?>" data-prod_type="<?php echo esc_attr($productType); ?>" data-original-product-id="<?php echo (int) $productId; ?>" data-icon-text="<?php esc_attr_e('Wishlist', 'elessi-theme'); ?>" title="<?php esc_attr_e('Wishlist', 'elessi-theme'); ?>" rel="nofollow">
                <?php echo $icon; ?>
                
                <?php if ($tip === 'label') { ?>
                    <span class="margin-left-5 rtl-margin-left-0 rtl-margin-right-5 nasa-icon-text">
                        <?php echo esc_html__('Add to wishlist', 'elessi-theme'); ?>
                    </span>
                <?php } ?>
            </a>

            <?php if (isset($nasa_opt['optimize_wishlist_html']) && !$nasa_opt['optimize_wishlist_html']) { ?>
                <div class="add-to-link hidden-tag">
                    <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?>
                </div>
            <?php } ?>

            <?php
            if ($variation) {
                $GLOBALS['product'] = $variation_product;
            }
        }
    }
endif;

/**
 * progress bar stock quantity
 */
if (!function_exists('elessi_single_availability')) :
    function elessi_single_availability() {
        global $product;
        
        if (!$product) {
            return;
        }
        
        // Availability
        $availability = $product->get_availability();

        if ($availability['availability']) {
            echo apply_filters('woocommerce_get_stock_html', '<p class="stock ' . esc_attr($availability['class']) . '">' . wp_kses(__('<span>Availability:</span> ', 'elessi-theme'), array('span' => array())) . esc_html($availability['availability']) . '</p>', $availability['availability']);
        }
    }
endif;

/**
 * Toggle coupon
 */
if (!function_exists('elessi_wrap_coupon_toggle')) :
    function elessi_wrap_coupon_toggle($content) {
        return '<div class="nasa-toggle-coupon-checkout">' . $content . '</div>';
    }
endif;

/**
 * Tab Combo Yith Bundle product
 */
if (!function_exists('elessi_combo_tab')) :
    function elessi_combo_tab($nasa_viewmore = true) {
        global $woocommerce, $nasa_opt, $product;

        if (!$woocommerce || !$product || $product->get_type() != NASA_COMBO_TYPE || !$combo = $product->get_bundled_items()) {
            return false;
        }

        $file = ELESSI_CHILD_PATH . '/includes/nasa-combo-products-in-detail.php';
        $file = is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-combo-products-in-detail.php';
        
        ob_start();
        include $file;

        return ob_get_clean();
    }
endif;

/**
 * Get All categories product filter in top
 */
if (!function_exists('elessi_get_all_categories')) :
    function elessi_get_all_categories($show_children_only = false, $main = false, $hierarchical = true) {
        if (!NASA_WOO_ACTIVED) {
            return;
        }
        
        global $nasa_opt, $wp_query, $post;
        
        $hide_empty = (isset($nasa_opt['hide_empty_cat_top']) && $nasa_opt['hide_empty_cat_top']) ? true : false;
        $list_args = array(
            'taxonomy' => 'product_cat',
            'show_count' => 0,
            'hierarchical' => $hierarchical,
            'hide_empty' => apply_filters('nasa_top_filter_cats_hide_empty', $hide_empty)
        );

        /**
         * Max depth = 0 ~ all
         */
        $depth_top = !isset($nasa_opt['depth_cat_top']) ? 0 : (int) $nasa_opt['depth_cat_top'];
        $max_depth = apply_filters('nasa_max_depth_top_filter_cats', $depth_top);

        $order = isset($nasa_opt['order_cat_top']) ? $nasa_opt['order_cat_top'] : 'name';
        $list_args['menu_order'] = false;
        
        if (apply_filters('nasa_top_filter_categories_orderby', $order) == 'order') {
            $list_args['orderby'] = 'meta_value_num';
            $list_args['meta_key'] = 'order';
        } else {
            $list_args['orderby'] = 'title';
        }

        $current_cat = false;
        $cat_ancestors = array();

        $root_id = 0;

        /**
         * post type page
         */
        if (
            isset($nasa_opt['disable_top_level_cat']) &&
            $nasa_opt['disable_top_level_cat'] &&
            isset($post->ID) &&
            $post->post_type == 'page'
        ) {
            $current_slug = get_post_meta($post->ID, '_nasa_root_category', true);

            if ($current_slug) {
                $current_cat = get_term_by('slug', $current_slug, 'product_cat');

                if ($current_cat && isset($current_cat->term_id)) {
                    $cat_ancestors = get_ancestors($current_cat->term_id, 'product_cat');
                }
            }
        }

        /**
         * Archive product category
         */
        elseif (is_tax('product_cat')) {
            $current_cat = $wp_query->queried_object;
            $cat_ancestors = get_ancestors($current_cat->term_id, 'product_cat');
        }

        /**
         * Single product page
         */
        elseif (is_singular('product')) {
            $terms = wc_get_product_terms(
                $post->ID,
                'product_cat',
                apply_filters(
                    'woocommerce_product_categories_widget_product_terms_args',
                    array(
                        'orderby' => 'parent',
                        'order'   => 'DESC',
                    )
                )
            );

            if ($terms) {
                $main_term = apply_filters('woocommerce_product_categories_widget_main_term', $terms[0], $terms);
                $current_cat = $main_term;
                $cat_ancestors = get_ancestors($main_term->term_id, 'product_cat');
            }
        }
        
        /**
         * Only Show Children
         */
        if ($show_children_only && $current_cat) {
            if ($hierarchical) {
                $include = array_merge(
                    $cat_ancestors,
                    array($current_cat->term_id),
                    get_terms(
                        'product_cat',
                        array(
                            'fields' => 'ids',
                            'parent' => 0,
                            'hierarchical' => true,
                            'hide_empty' => false,
                        )
                    ),
                    get_terms(
                        'product_cat',
                        array(
                            'fields' => 'ids',
                            'parent' => $current_cat->term_id,
                            'hierarchical' => true,
                            'hide_empty' => false,
                        )
                    )
                );

                // Gather siblings of ancestors.
                if ($cat_ancestors) {
                    foreach ($cat_ancestors as $ancestor) {
                        $include = array_merge(
                            $include,
                            get_terms(
                                'product_cat',
                                array(
                                    'fields' => 'ids',
                                    'parent' => $ancestor,
                                    'hierarchical' => false,
                                    'hide_empty' => false,
                                )
                            )
                        );
                    }
                }
            } else {
                // Direct children.
                $include = get_terms(
                    'product_cat',
                    array(
                        'fields' => 'ids',
                        'parent' => $current_cat->term_id,
                        'hierarchical' => true,
                        'hide_empty' => false,
                    )
                );
            }

            $list_args['include'] = implode(',', $include);

            if (empty($include)) {
                return;
            }
        }
        
        elseif ((isset($nasa_opt['disable_top_level_cat']) && $nasa_opt['disable_top_level_cat'])) {
            $root_id = $cat_ancestors ? end($cat_ancestors) :
                ($current_cat ? $current_cat->term_id : $root_id);
            $list_args['child_of'] = apply_filters('nasa_root_id_top_filter_cats', $root_id);
        }

        elseif ($show_children_only) {
            $list_args['child_of'] = 0;
            $list_args['depth'] = 1;
            $list_args['hierarchical'] = 1;
        }
        
        $list_args['walker']                        = new Elessi_Product_Cat_List_Walker($max_depth);
        $list_args['title_li']                      = '';
        $list_args['pad_counts']                    = 1;
        $list_args['show_option_none']              = esc_html__('No product categories exist.', 'elessi-theme');
        $list_args['current_category']              = $current_cat ? $current_cat->term_id : '';
        $list_args['current_category_ancestors']    = $cat_ancestors;
        $list_args['max_depth']                     = '';
        $list_args['echo'] = false;

        if (!isset($nasa_opt['show_uncategorized']) || !$nasa_opt['show_uncategorized']) {
            $uncategorized = get_option('default_product_cat');

            if ($uncategorized) {
                $list_args['exclude'] = $uncategorized;
            }
        }

        $nasa_top_filter = '<ul class="nasa-top-cat-filter product-categories nasa-accordion">';
        $nasa_top_filter .= wp_list_categories(apply_filters('woocommerce_product_categories_widget_args', $list_args));
        $nasa_top_filter .= '<li class="nasa-current-note"></li>';
        $nasa_top_filter .= '</ul>';
        
        $tmpl = isset($nasa_opt['tmpl_html']) && $nasa_opt['tmpl_html'] ? true : false;
        
        $result = $main ? '<div id="nasa-main-cat-filter">' : '<div id="nasa-mobile-cat-filter">';
        $result .= $tmpl ? '<template class="nasa-tmpl">' : '';
        $result .= $nasa_top_filter;
        $result .= $tmpl ? '</template>' : '';
        $result .= '</div>';
        
        return $result;
    }
endif;

/**
 * nasa_archive_get_sub_categories
 */
add_action('nasa_archive_get_sub_categories', 'elessi_archive_get_sub_categories');
if (!function_exists('elessi_archive_get_sub_categories')) :
    function elessi_archive_get_sub_categories() {
        $GLOBALS['nasa_cat_loop_delay'] = 0;
        
        echo '<div class="nasa-archive-sub-categories-wrap">';
        
        woocommerce_product_subcategories(array(
            'before' => '<div class="row"><div class="large-12 columns"><h3>' . esc_html__('Subcategories: ', 'elessi-theme') . '</h3></div></div><div class="row">',
            'after' => '</div><div class="row"><div class="large-12 columns margin-bottom-20 margin-top-20 text-center"><hr class="margin-left-20 margin-right-20" /></div></div>'
        ));
        
        echo '</div>';
    }
endif;

/**
 * Filter Paginate Links
 * 
 * Since 4.6.3
 */
add_filter('paginate_links', 'elessi_paginate_links');
if (!function_exists('elessi_paginate_links')) :
    function elessi_paginate_links($link) {
        if (!defined('NASA_AJAX_SHOP') || !NASA_AJAX_SHOP) {
            return $link;
        }
        
        if ('/page/1' === substr($link, strlen($link)-7, 7)) {
            return str_replace('/page/1', '', $link);
        }
        
        return str_replace('/page/1/', '/', $link);
    }
endif;

add_filter('paginate_links_output', 'elessi_modify_paginate_links_output', 10, 2);
if (!function_exists('elessi_modify_paginate_links_output')) :
function elessi_modify_paginate_links_output($r, $args) {
    global $nasa_opt;

    if (isset($nasa_opt['single_review_ajax']) && $nasa_opt['single_review_ajax'] && NASA_WOO_ACTIVED && is_product()) {
        // $comment_order = get_option('comment_order');
        $current  = (int) $args['current'];
        $total  = (int) $args['total'];

        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $current + 1, $link);
        $elclass = $current + 1 > $total ? 'hidden-tag' : '';

        $r = '<div class="nasa-relative text-center review-lm-btn-wrap">' .
            '<a href="' . $link . '" class="button load-more-review-btn btn-border ' . $elclass . '" data-current="' . $current . '" data-max="' . $total . '" rel="nofollow">' .
                '<span class="load-more-review-text">' . esc_html__('Load more', 'elessi-theme') . '</span>' .
            '</a>' .
        '</div>';
    }

    return $r;
}
endif;

add_filter('get_comment_date', 'elessi_custom_comment_date_format', 10, 3);
if (!function_exists('elessi_custom_comment_date_format')) :
function elessi_custom_comment_date_format($date, $format, $comment) {
    global $nasa_opt;

    $reviews_layout = isset($nasa_opt['single_review_layout']) && $nasa_opt['single_review_layout'] != '' ? $nasa_opt['single_review_layout'] : 'list';
    $reviews_layout =  isset($_GET['reviews_layout']) && $_GET['reviews_layout'] != '' ? $_GET['reviews_layout'] : $reviews_layout;

    if ($reviews_layout != 'list' && NASA_WOO_ACTIVED && is_product()) {
        return date('F Y', strtotime($comment->comment_date));
    }

    return $date;
}
endif;

add_filter('comment_text', 'elessi_custom_comment_text', 30, 3);
if (!function_exists('elessi_custom_comment_text')) :
function elessi_custom_comment_text($comment_text, $comment, $args) {
    if (NASA_WOO_ACTIVED && is_product()) {
        $comment_text .= '<a href="javascript:void(0);" class="read-more">' . apply_filters('ns_comment_text_read_more', '[...]') . '</a>';
    }
    
    return $comment_text;
}
endif;

add_action('pre_get_comments', 'elessi_filter_reviews_product');
if (!function_exists('elessi_filter_reviews_product')) :
function elessi_filter_reviews_product($query) {
    if (!NASA_WOO_ACTIVED) {
        return;
    }
    
    $sort_type =  isset($_GET['review_sort']) && $_GET['review_sort'] != '' ? $_GET['review_sort'] : 'date_DESC';

    update_option('default_comments_page', 'oldest');
    update_option('comment_order', 'asc');

    if (is_product()) {
        switch ($sort_type) {
            case 'rating_ASC':
                $query->query_vars['orderby'] = 'meta_value_num';
                $query->query_vars['meta_key'] = 'rating';
                $query->query_vars['order'] = 'ASC';
                break;
        
            case 'rating_DESC':
                $query->query_vars['orderby'] = 'meta_value_num';
                $query->query_vars['meta_key'] = 'rating';
                $query->query_vars['order'] = 'DESC';
                break;
            case 'media_DESC':
                $meta_query = array(
                    array(
                        'key'     => 'nasa_review_images',
                        'compare' => 'EXISTS',
                    ),
                );
                $query->query_vars['meta_query'] = $meta_query;
                $query->query_vars['orderby'] = 'comment_date';
                $query->query_vars['order'] = 'DESC';
                break;
        
            case 'date_ASC':
                $query->query_vars['orderby'] = 'comment_date';
                $query->query_vars['order'] = 'ASC';
                break;
        
            case 'date_DESC':
                $query->query_vars['orderby'] = 'comment_date';
                $query->query_vars['order'] = 'DESC';
                break;
        
            default:
                break;
        }
    }
}
endif;

/**
 * Filter Pagination args
 * 
 * Since 4.6.3
 */
add_filter('woocommerce_pagination_args', 'elessi_pagination_args');
if (!function_exists('elessi_pagination_args')) :
    function elessi_pagination_args($args) {
        if (empty($args)) {
            $args = array();
        }
        
        $args['prev_text'] = '<svg width="35" height="35" viewBox="0 0 32 32" fill="currentColor"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z" /></svg>';
        $args['next_text'] = '<svg width="35" height="35" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" /></svg>';
        $args['type'] = 'list';
        $args['end_size'] = 1;
        $args['mid_size'] = 1;
    
        return $args;
    }
endif;

/**
 * No paging url
 */
if (!function_exists('elessi_nopaging_url')) :
    function elessi_nopaging_url() {
        global $wp;

        if (!$wp->request) {
            return false;
        }

        $current_url = home_url($wp->request);
        $pattern = '/page(\/)*([0-9\/])*/i';
        $nopaging_url = preg_replace($pattern, '', $current_url);

        return trailingslashit($nopaging_url);
    }
endif;

/**
 * Compatible WooCommerce_Advanced_Free_Shipping
 * Only with one Rule "subtotal >= Rule"
 */
add_action('nasa_subtotal_free_shipping', 'elessi_subtotal_free_shipping');
add_action('woocommerce_widget_shopping_cart_total', 'elessi_subtotal_free_shipping', 20);
if (!function_exists('elessi_subtotal_free_shipping')) :
    function elessi_subtotal_free_shipping($return = false) {
        global $nasa_opt;
        
        $value = 0;
        $content = '';
        
        /**
         * Check active plug-in WooCommerce || WooCommerce_Advanced_Free_Shipping
         */
        if (
            (isset($nasa_opt['free_shipbar']) && !$nasa_opt['free_shipbar']) ||
            !NASA_WOO_ACTIVED ||
            !class_exists('WooCommerce_Advanced_Free_Shipping') ||
            !function_exists('WAFS')
        ) {
            return $content;
        }

        /**
         * Check setting plug-in
         */
        $wafs = WAFS();
        if (!isset($wafs->was_method)) {
            $wafs->wafs_free_shipping();
        }
        
        $wafs_method = isset($wafs->was_method) ? $wafs->was_method : null;
        if (!$wafs_method || $wafs_method->enabled === 'no') {
            return $content;
        }

        /**
         * Check has
         */
        $wafs_posts = get_posts(array(
            // 'posts_per_page'    => 2,
            'post_status'       => 'publish',
            'post_type'         => 'wafs'
        ));
        
        if (!$wafs_posts || count($wafs_posts) < 1) {
            return $content;
        }
        
        require_once ELESSI_THEME_PATH . '/cores/nasa-advanced-free-shipping.php';
        
        $out_nsafs = false;

        /**
         * Check and Rules
         */
        foreach ($wafs_posts as $wafs_post) {
            $condition_groups = get_post_meta($wafs_post->ID, '_wafs_shipping_method_conditions', true);
            
            if (!$condition_groups || count($condition_groups) < 1) {
                continue;
            }
            
            $condition_group = reset($condition_groups);
            if (!$condition_group || count($condition_group) < 1) {
                continue;
            }
            
            $nsafs = new Nasa_Advanced_Free_Shipping($condition_group);
            
            if (!$nsafs->render) {
                continue;
            }
            
            if ($out_nsafs && $out_nsafs->value > $nsafs->value) {
                $out_nsafs = $nsafs;
            }
            
            if (!$out_nsafs && $nsafs->render) {
                $out_nsafs = $nsafs;
            }
        }
        
        if ($out_nsafs) {
            $content = $out_nsafs->output_html();
        }
        
        if (!$return) {
            echo $content;
            
            return;
        }
        
        return $content;
    }
endif;

/**
 * Add Free_Shipping to Cart page
 */
add_action('woocommerce_cart_contents', 'elessi_subtotal_free_shipping_in_cart');
if (!function_exists('elessi_subtotal_free_shipping_in_cart')) :
    function elessi_subtotal_free_shipping_in_cart() {
        $content = elessi_subtotal_free_shipping(true);
        
        if ($content !== '') {
            echo '<tr class="nasa-no-border"><td colspan="6" class="nasa-subtotal_free_shipping">' . $content . '</td></tr>';
        }
    }
endif;

/**
 * Before account Navigation
 */
add_action('woocommerce_before_account_navigation', 'elessi_before_account_nav');
if (!function_exists('elessi_before_account_nav')) :
    function elessi_before_account_nav() {
        
        if (!NASA_WOO_ACTIVED || !NASA_CORE_USER_LOGGED) {
           return;
        }
        
        $current_user = wp_get_current_user();
        ?>
        <div class="account-nav-wrap vertical-tabs">
            <div class="account-nav account-user hide-for-small">
                
                <?php echo get_avatar($current_user->ID, 60); ?>
                
                <span class="wc-user">
                    <?php echo esc_html__('Welcome', 'elessi-theme'); ?>
                </span>
                
                <span class="user-name">
                    <?php echo esc_attr($current_user->display_name); ?>
                </span>
                
                <?php /*span class="logout-link">
                    <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" title="<?php esc_attr_e('Logout', 'elessi-theme'); ?>">
                        <?php esc_html_e('Logout', 'elessi-theme'); ?>
                    </a>
                </span */?>
            </div>
    <?php
    }
endif;

/**
 * After account Navigation
 */
add_action('woocommerce_after_account_navigation', 'elessi_after_account_nav');
if (!function_exists('elessi_after_account_nav')) :
    function elessi_after_account_nav() {
        if (!NASA_WOO_ACTIVED || !NASA_CORE_USER_LOGGED) {
            return;
        }
        
        echo '</div>';
    }
endif;

/**
 * Account Dashboard Square
 */
add_action('woocommerce_account_dashboard', 'elessi_account_dashboard_nav');
if (!function_exists('elessi_account_dashboard_nav')) :
    function elessi_account_dashboard_nav() {
        if (!NASA_WOO_ACTIVED || !NASA_CORE_USER_LOGGED) {
            return;
        }
        
        $extra_class = 'nasa-MyAccount-navigation';
        $file = ELESSI_CHILD_PATH . '/includes/nasa-acc-nav.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-acc-nav.php';
    }
endif;

/**
 * Custom class Single product Price
 */
add_filter('woocommerce_product_price_class', 'elessi_product_price_class');
if (!function_exists('elessi_product_price_class')) :
    function elessi_product_price_class($class) {
        $class .= ' nasa-single-product-price';
        
        return $class;
    }
endif;

/**
 * Custom class Single product tabs
 */
add_filter('nasa_single_product_tabs_style', 'elessi_single_product_tabs_class');
if (!function_exists('elessi_single_product_tabs_class')) :
    function elessi_single_product_tabs_class($class) {
        global $nasa_opt;
        
        $classes = isset($nasa_opt['tab_style_info']) ? $nasa_opt['tab_style_info'] : $class;
        
        return $classes;
    }
endif;

/**
 * Override woocommerce_catalog_orderby
 */
add_filter('woocommerce_catalog_orderby', 'elessi_wc_catalog_orderby');
if (!function_exists('elessi_wc_catalog_orderby')) :
    function elessi_wc_catalog_orderby($catalogs) {
        return array(
            'menu_order' => __('Default sorting', 'elessi-theme'),
            'popularity' => __('Popularity', 'elessi-theme'),
            'rating'     => __('Average rating', 'elessi-theme'),
            'date'       => __('Latest', 'elessi-theme'),
            'price'      => __('Price: Ascending', 'elessi-theme'),
            'price-desc' => __('Price: Descending', 'elessi-theme'),
        );
    }
endif;

/**
 * Get Root term_id
 */
if (!function_exists('elessi_get_root_term_id')) :
    function elessi_get_root_term_id() {
        return function_exists('nasa_root_term_id') ? nasa_root_term_id() : false;
    }
endif;

/**
 * Hook Before render shop
 */
add_action('nasa_before_render_shop', 'elessi_override_options_shop');
if (!function_exists('elessi_override_options_shop')) :
    function elessi_override_options_shop() {
        global $nasa_opt;
        
        $mobile_app = (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app') ? true : false;
        
        /**
         * Override for Root Category
         */
        $root_cat_id = !$mobile_app ? elessi_get_root_term_id() : false;

        if ($root_cat_id) {

            /* Override cat side-bar layout */
            $cat_sidebar_style = get_term_meta($root_cat_id, 'cat_sidebar_layout', true);
            if ($cat_sidebar_style != '') {
                $nasa_opt['category_sidebar'] = $cat_sidebar_style;
            }
            
            /**
             * Product Type view
             */
            $cat_type_view = get_term_meta($root_cat_id, 'cat_type_view', true);
            if ($cat_type_view != '') {
                $nasa_opt['products_type_view'] = $cat_type_view;
            }

            /**
             * Change Shop Layout Mode
             */
            $cat_change_shop_layout = get_term_meta($root_cat_id, 'cat_change_shop_layout', true);
            if ($cat_change_shop_layout != '') {
                $nasa_opt['option_change_shop_layout'] = $cat_change_shop_layout;
            }

            /**
             * Product Column Icon Style
             */
            $cat_change_layout_type = get_term_meta($root_cat_id, 'cat_change_layout_type', true);
            if ($cat_change_layout_type != '') {
                $nasa_opt['nasa_change_layout_view'] = $cat_change_layout_type;
            }

            /**
             * Product Change View mode
             */
            $cat_change_view = get_term_meta($root_cat_id, 'cat_change_view', true);
            if ($cat_change_view != '') {
                $nasa_opt['enable_change_view'] = $cat_change_view == -1 ? false : '1';
            }

            /**
             * Product Option Column Select To Display
             */
            $cat_multicheck_options_cols_display = get_term_meta($root_cat_id, 'cat_multicheck_options_cols_display', true);
            if (!empty($cat_multicheck_options_cols_display)) {
                $nasa_opt['multicheck_options_cols_display'] = $cat_multicheck_options_cols_display;
            }
            
            /**
             * Product Per row
             */
            $cat_per_row = get_term_meta($root_cat_id, 'cat_per_row', true);
            if ($cat_per_row != '') {
                $nasa_opt['products_per_row'] = $cat_per_row;
            }

            /**
             * Product Per row Medium
             */
            $cat_per_row_medium = get_term_meta($root_cat_id, 'cat_per_row_medium', true);
            if ($cat_per_row_medium != '') {
                $nasa_opt['products_per_row_tablet'] = $cat_per_row_medium;
            }
            
            /**
             * Product Per row Small
             */
            $cat_per_row_small = get_term_meta($root_cat_id, 'cat_per_row_small', true);
            if ($cat_per_row_small != '') {
                $nasa_opt['products_per_row_small'] = $cat_per_row_small;
            }
            
            /**
             * Products layout_style
             */
            $cat_layout_style = get_term_meta($root_cat_id, 'cat_layout_style', true);
            if ($cat_layout_style != '') {
                $nasa_opt['products_layout_style'] = $cat_layout_style;
            }
            
            /**
             * Products masonry_mode
             */
            $cat_masonry_mode = get_term_meta($root_cat_id, 'cat_masonry_mode', true);
            if ($cat_masonry_mode != '') {
                $nasa_opt['products_masonry_mode'] = $cat_masonry_mode;
            }
            
            /**
             * Products Recommended Columns
             */
            $cat_recommend_columns = get_term_meta($root_cat_id, 'cat_recommend_columns', true);
            if ($cat_recommend_columns != '') {
                $nasa_opt['recommend_columns_desk'] = $cat_recommend_columns;
            }
            
            /**
             * Products Recommend Columns Medium
             */
            $cat_recommend_columns_medium = get_term_meta($root_cat_id, 'cat_recommend_columns_medium', true);
            if ($cat_recommend_columns_medium != '') {
                $nasa_opt['recommend_columns_tablet'] = $cat_recommend_columns_medium;
            }
            
            /**
             * Products Recommended Columns Small
             */
            $cat_recommend_columns_small = get_term_meta($root_cat_id, 'cat_recommend_columns_small', true);
            if ($cat_recommend_columns_small != '') {
                $nasa_opt['recommend_columns_small'] = $cat_recommend_columns_small;
            }
        }
        
        if ($mobile_app) {
            $nasa_opt['category_sidebar'] = 'top';
        }
        
        $GLOBALS['nasa_opt'] = $nasa_opt;
    }
endif;

/**
 * Hook Before render shop
 */
add_action('nasa_before_render_single_product', 'elessi_override_options_single_product');
if (!function_exists('elessi_override_options_single_product')) :
    function elessi_override_options_single_product() {
        global $nasa_opt;
        
        /**
         * Override for Root Category
         */
        $root_cat_id = elessi_get_root_term_id();

        if ($root_cat_id) {
            /**
             * Products Relate Columns
             */
            $cat_relate_columns = get_term_meta($root_cat_id, 'cat_relate_columns', true);
            if ($cat_relate_columns != '') {
                $nasa_opt['relate_columns_desk'] = $cat_relate_columns;
            }
            
            /**
             * Products Relate Columns Medium
             */
            $cat_relate_columns_medium = get_term_meta($root_cat_id, 'cat_relate_columns_medium', true);
            if ($cat_relate_columns_medium != '') {
                $nasa_opt['relate_columns_tablet'] = $cat_relate_columns_medium;
            }
            
            /**
             * Products Relate Columns Small
             */
            $cat_relate_columns_small = get_term_meta($root_cat_id, 'cat_relate_columns_small', true);
            if ($cat_relate_columns_small != '') {
                $nasa_opt['relate_columns_small'] = $cat_relate_columns_small;
            }
        }
        
        $GLOBALS['nasa_opt'] = $nasa_opt;
    }
endif;

/**
 * Add sku to product search
 */
add_action('pre_get_posts', 'elessi_pre_get_posts_sku');
if (!function_exists('elessi_pre_get_posts_sku')) :
    function elessi_pre_get_posts_sku($query) {
        global $nasa_opt;

        // conditions - change the post type clause if you're not searching woocommerce or 'product' post type
        if (
            NASA_CORE_IN_ADMIN ||
            !isset($nasa_opt['sp_search_sku']) ||
            !$nasa_opt['sp_search_sku'] ||
            !$query->is_main_query() ||
            !$query->is_search() ||
            'product' != get_query_var('post_type')
        ){
           return;
        }

        add_filter('posts_join', 'elessi_sku_search_join');
        add_filter('posts_where', 'elessi_sku_search_where');
        add_filter('posts_groupby', 'elessi_sku_search_groupby');
    }
endif;

/**
 * Filter JOIN with _sku
 */
if (!function_exists('elessi_sku_search_join')) :
    function elessi_sku_search_join($join) {
       global $wpdb;

       // change to your meta key if not woo
       $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' nspm ON (' . $wpdb->posts . '.ID = nspm.post_id AND nspm.meta_key="_sku")';

       return $join;
    }
endif;

/**
 * Filter WHERE with _sku
 */
if (!function_exists('elessi_sku_search_where')) :
    function elessi_sku_search_where($where) {
        global $wpdb;

        return preg_replace(
            "/\(\s*{$wpdb->posts}.post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            '(' . $wpdb->posts . '.post_title LIKE $1) OR (nspm.meta_value LIKE $1)',
            $where
        );
    }
endif;

/**
 * Filter GROUP BY id with _sku
 */
if (!function_exists('elessi_sku_search_groupby')) :
    function elessi_sku_search_groupby($groupby) {
        global $wpdb;

        $nsgroupby = $wpdb->posts . '.ID';

        if (preg_match("/$nsgroupby/", $groupby)) {
            // grouping we need is already there
            return $groupby;
        }

        if (!strlen(trim($groupby))) {
            // groupby was empty, use ours
            return $nsgroupby;
        }

        // wasn't empty, append ours
        return $groupby . ', ' . $nsgroupby;
    }
endif;

/**
 * Cart Total Coupons - Label
 */
add_filter('woocommerce_cart_totals_coupon_label', 'elessi_cart_totals_coupon_label');
if (!function_exists('elessi_cart_totals_coupon_label')) :
    function elessi_cart_totals_coupon_label($label) {
        return esc_html__('Coupon', 'elessi-theme');
    }
endif;

/**
 * Cart Total Coupons - HTML
 */
add_filter('woocommerce_cart_totals_coupon_html', 'elessi_cart_totals_coupon_html', 10, 3);
if (!function_exists('elessi_cart_totals_coupon_html')) :
    function elessi_cart_totals_coupon_html($coupon_html, $coupon, $discount_amount_html) {
        $code = $coupon->get_code();
        
        $href = add_query_arg('remove_coupon', rawurlencode($code), defined('WOOCOMMERCE_CHECKOUT') ? wc_get_checkout_url() : wc_get_cart_url());
        
        $coupon_html = '<a href="' . esc_url($href) . '" class="woocommerce-remove-coupon nasa-tip nasa-flex je" data-coupon="' . esc_attr($code) . '" title="' . esc_attr__('Remove', 'elessi-theme') . '">' .
            '<svg width="18" height="18" viewBox="0 0 32 32" fill="currentColor"><path d="M10.722 9.969l-0.754 0.754 5.278 5.278-5.253 5.253 0.754 0.754 5.253-5.253 5.253 5.253 0.754-0.754-5.253-5.253 5.278-5.278-0.754-0.754-5.278 5.278z" fill="currentColor" /></svg>' .
            '<span class="cp-code nasa-bold text-center margin-right-5 rtl-margin-right-0 rtl-margin-left-5">' . $code . '</span>' .
            $discount_amount_html .
        '</a>';
        
        return $coupon_html;
    }
endif;

/**
 * get List Coupons - Publish
 */
if (!function_exists('elessi_wc_publish_coupons')) :
    function elessi_wc_publish_coupons() {
        global $nasa_opt;
        
        $coupons = array();
        
        if (isset($nasa_opt['mini_cart_p_coupon']) && $nasa_opt['mini_cart_p_coupon']) {
            $coupons_fetch = explode("\n", $nasa_opt['mini_cart_p_coupon']);
            
            if (!empty($coupons_fetch)) {
                foreach ($coupons_fetch as $coupon) {
                    $code = trim($coupon);
                    
                    $coupon_obj = new WC_Coupon($code);
                    
                    if ($coupon_obj instanceof WC_Coupon && $coupon_obj->get_id()) {
                        $coupons[] = $coupon_obj;
                    }
                }
            }
        }
        
        return $coupons;
    }
endif;

/**
 * Comment media img Template
 */
add_filter('woocommerce_product_review_comment_form_args', 'elessi_comment_media_upload', 9999);
if (!function_exists('elessi_comment_media_upload')) :
    function elessi_comment_media_upload($comment_form) {
        global $nasa_opt;
        
        if (!isset($nasa_opt['comment_media']) || !$nasa_opt['comment_media'] || !isset($comment_form['comment_field'])) {
            return $comment_form;
        }

        $svg_alert = '<svg width="12" height="12" viewBox="0 0 12 13" fill="none">
                        <path d="M6 0C2.67188 0 0 2.69531 0 6C0 9.32812 2.67188 12 6 12C9.30469 12 12 9.32812 12 6C12 2.69531 9.30469 0 6 0ZM6 10.875C3.30469 10.875 1.125 8.69531 1.125 6C1.125 3.32812 3.30469 1.125 6 1.125C8.67188 1.125 10.875 3.32812 10.875 6C10.875 8.69531 8.67188 10.875 6 10.875ZM6 7.125C6.30469 7.125 6.5625 6.89062 6.5625 6.5625V3.5625C6.5625 3.25781 6.30469 3 6 3C5.67188 3 5.4375 3.25781 5.4375 3.5625V6.5625C5.4375 6.89062 5.67188 7.125 6 7.125ZM6 7.92188C5.57812 7.92188 5.25 8.25 5.25 8.64844C5.25 9.04688 5.57812 9.375 6 9.375C6.39844 9.375 6.72656 9.04688 6.72656 8.64844C6.72656 8.25 6.39844 7.92188 6 7.92188Z" fill="currentColor"></path>
                    </svg>';
        
        $cam_img = '<svg viewBox="0 0 32 32" width="32" height="32" fill="currentColor"><g><path class="st0" d="M23,9l-1.4-2.9c-0.3-0.7-1-1.1-1.8-1.1h-7.5c-0.8,0-1.5,0.4-1.8,1.1L9,9H5c-1.1,0-2,0.9-2,2v14c0,1.1,0.9,2,2,2 h22c1.1,0,2-0.9,2-2V11c0-1.1-0.9-2-2-2H23z"/><circle class="st0" cx="16" cy="17" r="6" /></g></svg>';

        $plus_svg = '<svg viewBox="0 0 24 24" fill="currentColor"><g id="SVGRepo_iconCarrier"> <path d="M4 12H20M12 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>';
        
        $max_size = isset($nasa_opt['maxsize_comment_media']) && (int) $nasa_opt['maxsize_comment_media'] ? (int) $nasa_opt['maxsize_comment_media'] : 1024;
        $max_files = isset($nasa_opt['maxfiles_comment_media']) && (int) $nasa_opt['maxfiles_comment_media'] ? (int) $nasa_opt['maxfiles_comment_media'] : 3;
        
        $label = sprintf(esc_html__('Maximum file size is %s kB, max %s files', 'elessi-theme'), $max_size, $max_files);
        $label2 =   '<span class="upload-media-svg" >' . $cam_img . '</span>'.
                    '<span class="nasa-bold-800" > <span>' . esc_html__('Upload photos', 'elessi-theme') . ' (<span class="ns-media-count">0</span>/' . $max_files .')</span>'.
                    '<span class="nasa-flie-policy">' . $svg_alert . $label.'</span>';
        
        $media_html =   '<p class="nasa-form-media clear-both" data-max-file="' . esc_attr($max_files) . '" data-max-size="' . esc_attr($max_size) . '">
                            <label class="svg_media_upload" for="nasa-comment-media">' . $label2 . '</label>
                            <input type="file" name="ns_image_upload[]" id="nasa-comment-media" class="ns_image_upload" multiple="" accept=".jpg, .jpeg, .png, .bmp, .gif" />
                            <span class="nasa-form-media-show"> <label class="svg_media_upload" for="nasa-comment-media">' . $plus_svg . '</label></span>
                        </p>';

        if (!NASA_CORE_USER_LOGGED) {
            $comment_form['fields']['nasa-comment-media-video'] = $media_html;
        } else {
            $comment_form['comment_field'] .= $media_html;
        }
    
        return $comment_form;
    }
endif;


/**
 * Comment media video Template
 */
add_filter('woocommerce_product_review_comment_form_args', 'elessi_comment_media_upload_video', 9999);
if (!function_exists('elessi_comment_media_upload_video')) :
    function elessi_comment_media_upload_video($comment_form) {
        global $nasa_opt;
        
        if (!isset($nasa_opt['comment_media_video']) || !$nasa_opt['comment_media_video'] || !isset($comment_form['comment_field'])) {
            return $comment_form;
        }

        $svg_alert = '<svg width="12" height="12" viewBox="0 0 12 13" fill="none">
                        <path d="M6 0C2.67188 0 0 2.69531 0 6C0 9.32812 2.67188 12 6 12C9.30469 12 12 9.32812 12 6C12 2.69531 9.30469 0 6 0ZM6 10.875C3.30469 10.875 1.125 8.69531 1.125 6C1.125 3.32812 3.30469 1.125 6 1.125C8.67188 1.125 10.875 3.32812 10.875 6C10.875 8.69531 8.67188 10.875 6 10.875ZM6 7.125C6.30469 7.125 6.5625 6.89062 6.5625 6.5625V3.5625C6.5625 3.25781 6.30469 3 6 3C5.67188 3 5.4375 3.25781 5.4375 3.5625V6.5625C5.4375 6.89062 5.67188 7.125 6 7.125ZM6 7.92188C5.57812 7.92188 5.25 8.25 5.25 8.64844C5.25 9.04688 5.57812 9.375 6 9.375C6.39844 9.375 6.72656 9.04688 6.72656 8.64844C6.72656 8.25 6.39844 7.92188 6 7.92188Z" fill="currentColor"></path>
                    </svg>';

        $cam_img = '<svg viewBox="3 2 18 18" width="32" height="32" fill="none"><g id="SVGRepo_iconCarrier"> <g stroke="currentColor" stroke-width="1.2"> <path d="M16 16V8a1 1 0 00-1-1H5a1 1 0 00-1 1v8a1 1 0 001 1h10a1 1 0 001-1z"></path> <path stroke-linejoin="round" d="M20 7l-4 3v4l4 3V7z"></path> </g> </g></svg>';
        
        $plus_svg = '<svg viewBox="0 0 24 24" fill="currentColor"><g id="SVGRepo_iconCarrier"> <path d="M4 12H20M12 4V20" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>';
        
        $max_size = isset($nasa_opt['maxsize_comment_media_video']) && (int) $nasa_opt['maxsize_comment_media_video'] ? (int) $nasa_opt['maxsize_comment_media_video'] : 1024;
        $max_files = isset($nasa_opt['maxfiles_comment_media_video']) && (int) $nasa_opt['maxfiles_comment_media_video'] ? (int) $nasa_opt['maxfiles_comment_media_video'] : 1;

        
        $label = sprintf(_n('Maximum file size is %s kB, max %s file', 'Maximum file size is %s kB, max %s files', $max_files, 'elessi-theme'), $max_size,$max_files);
        $label2 =   '<span class="upload-media-svg" >' . $cam_img . '</span>'.
                    '<span class="nasa-bold-800" > <span>' . sprintf(_n('Upload video', 'Upload videos', $max_files, 'elessi-theme')) . ' (<span class="ns-media-count">0</span>/' .  $max_files . ')</span>'.
                    '<span class="nasa-flie-policy">' . $svg_alert . $label.'</span>';

        // video input
        $media_html =   '<p class="nasa-form-media clear-both" data-max-file="' . esc_attr($max_files) . '" data-max-size="' . esc_attr($max_size) . '">
                            <label class="svg_media_upload" for="nasa-comment-media-video">' . $label2 . '</label>
                            <input type="file" name="ns_video_upload[]" id="nasa-comment-media-video" class="ns_image_upload" multiple="" accept=".mp4, .avi, .mpeg, .mov" />
                            <span class="nasa-form-media-show"><label class="svg_media_upload" for="nasa-comment-media-video">' . $plus_svg . '</label></span>
                        </p>';

        if (!NASA_CORE_USER_LOGGED) {
            $comment_form['fields']['nasa-comment-media'] = $media_html;
        } else {
            $comment_form['comment_field'] .= $media_html;
        }
    
        return $comment_form;
    }
endif;

/**
 * Process comment media
 */
add_filter('preprocess_comment', 'elessi_preprocess_review_media', 10);
if (!function_exists('elessi_preprocess_review_media')) :
    function elessi_preprocess_review_media($commentdata) {
        global $nasa_opt;

        $files_img = isset($_FILES['ns_image_upload']) && !empty($_FILES['ns_image_upload']) ? $_FILES['ns_image_upload'] : array();
        $files_video = isset($_FILES['ns_video_upload']) && !empty($_FILES['ns_video_upload']) ? $_FILES['ns_video_upload'] : array();
        
        if (empty($files_img) && empty($files_video)) {
            return $commentdata;
        }
        
        if (isset($nasa_opt['comment_media']) && $nasa_opt['comment_media'] && !empty($files_img)) {
            
            $max_size = isset($nasa_opt['maxsize_comment_media']) && (int) $nasa_opt['maxsize_comment_media'] ? (int) $nasa_opt['maxsize_comment_media'] : 1024;
            $max_files = isset($nasa_opt['maxfiles_comment_media']) && (int) $nasa_opt['maxfiles_comment_media'] ? (int) $nasa_opt['maxfiles_comment_media'] : 3;
            
            /**
             * Allow maxfiles upload
             */
            if (isset($files_img['name']) && count($files_img['name']) > $max_files) {
                $mess = '<strong>' . esc_html__('Error: ', 'elessi-theme') . '</strong>' . sprintf(esc_html__('Maximum number of image files allowed is: %s file(s)', 'elessi-theme'), $max_files);
                wp_die($mess);
            }
            
            /**
             * Allow maxsize upload
             */
            if (isset($files_img['size']) && !empty($files_img['size'])) {
                foreach ($files_img['size'] as $k => $size) {
                    if (!$size) {
                        if (isset($files_img['name'][$k])) {
                            unset($files_img['name'][$k]);
                        }
                        
                        if (isset($files_img['type'][$k])) {
                            unset($files_img['type'][$k]);
                        }
                        
                        if (isset($files_img['size'][$k])) {
                            unset($files_img['size'][$k]);
                        }
                        
                        continue;
                    }
                    
                    if ($size > ($max_size * 1024)) {
                        $mess = '<strong>' . esc_html__('Error: ', 'elessi-theme') . '</strong>' . sprintf(esc_html__('Max image size allowed: %s kB', 'elessi-theme'), $max_size);
                        wp_die($mess);
                    }
                }
            }
            
            /**
             * Allow Types upload
             */
            if (isset($files_img['type']) && !empty($files_img['type'])) {
                foreach ($files_img['type'] as $type) {
                    $type_file = strtolower($type);
                    
                    if (!in_array($type_file, array("image/jpg", "image/jpeg", "image/bmp", "image/png", "image/gif" ))) {
                        wp_die(esc_html__('Only format image accepted: JPG, JPEG, BMP, PNG, GIF', 'elessi-theme'));
                    }
                }
            }
        }

        if (isset($nasa_opt['comment_media_video']) && $nasa_opt['comment_media_video'] && !empty($files_video)) {
            
            $max_size = isset($nasa_opt['maxsize_comment_media_video']) && (int) $nasa_opt['maxsize_comment_media_video'] ? (int) $nasa_opt['maxsize_comment_media_video'] : 1024;
            $max_files = isset($nasa_opt['maxfiles_comment_media_video']) && (int) $nasa_opt['maxfiles_comment_media_video'] ? (int) $nasa_opt['maxfiles_comment_media_video'] : 1;
            
            /**
             * Allow maxfiles upload
             */
            if (isset($files_video['name']) && count($files_video['name']) > $max_files) {
                $mess = '<strong>' . esc_html__('Error: ', 'elessi-theme') . '</strong>' . sprintf(esc_html__('Maximum number of video files allowed is: %s file(s)', 'elessi-theme'), $max_files);
                wp_die($mess);
            }
            
            /**
             * Allow maxsize upload
             */
            if (isset($files_video['size']) && !empty($files_video['size'])) {
                foreach ($files_video['size'] as $k => $size) {
                    if (!$size) {
                        if (isset($files_video['name'][$k])) {
                            unset($files_video['name'][$k]);
                        }
                        
                        if (isset($files_video['type'][$k])) {
                            unset($files_video['type'][$k]);
                        }
                        
                        if (isset($files_video['size'][$k])) {
                            unset($files_video['size'][$k]);
                        }
                        
                        continue;
                    }
                    
                    if ($size > ($max_size * 1024)) {
                        $mess = '<strong>' . esc_html__('Error: ', 'elessi-theme') . '</strong>' . sprintf(esc_html__('Max video size allowed: %s kB', 'elessi-theme'), $max_size);
                        wp_die($mess);
                    }
                }
            }
            
            /**
             * Allow Types upload
             */
            if (isset($files_video['type']) && !empty($files_video['type'])) {
                foreach ($files_video['type'] as $type) {
                    $type_file = strtolower($type);
                    
                    if (!in_array($type_file, array("video/mp4", "video/avi", "video/mpeg", "video/mov" ))) {
                        wp_die(esc_html__('Only format video accepted: MP4, AVI, MPEG, MOV', 'elessi-theme'));
                    }
                }
            }
        }
        
        /**
         * Allow upload images
         */
        add_action('comment_post', 'elessi_add_review_media', 10, 1);
        
        return $commentdata;
    }
endif;

/**
 * Add Review images
 */
if (!function_exists('elessi_add_review_media')) :
    function elessi_add_review_media($comment_id) {
        $comment = get_comment($comment_id);
        
        $post_id = isset($comment->comment_post_ID) ? $comment->comment_post_ID : null;

        $files_img  = $_FILES["ns_image_upload"];
        $files_video  = $_FILES["ns_video_upload"];

        $files = array();

        if (!empty($files_img) && !empty($files_video)) {
            foreach ($files_img as $key => $value) {
                $files[$key] = array_merge($files_img[$key], $files_video[$key]);
            }
        } else {
            $files = !empty($files_img) ? $files_img : $files_video;
        }

        $media_id = array();
        
        if (!empty($files['name'])) {
            require_once ABSPATH . 'wp-admin/includes/image.php';
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once ABSPATH . 'wp-admin/includes/media.php';
            
            add_filter('intermediate_image_sizes_advanced', 'elessi_comment_img_sizes');
            add_filter('big_image_size_threshold', '__return_false');
            
            foreach ($files['name'] as $key => $value) {
                if ($files['size'][$key]) {
                    $file = array(
                        'name'     => apply_filters('nasa_photo_reviews_image_file_name', $value, $comment_id, $post_id),
                        'type'     => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error'    => $files['error'][$key],
                        'size'     => $files['size'][$key]
                    );

                    $_FILES["upload_file"] = $file;
                    $attachment_id         = media_handle_upload("upload_file", $post_id);

                    if (is_wp_error($attachment_id)) {
                        wp_die($attachment_id->get_error_message());
                    } else {
                        $media_id[] = $attachment_id;
                    }
                }
            }
            
            remove_filter('intermediate_image_sizes_advanced', 'elessi_comment_img_sizes');
        }

        if (!empty($media_id)) {
            update_comment_meta($comment_id, 'nasa_review_images', $media_id);
        }
    }
endif;

if (!function_exists('get_latest_reviews_attachment_ids_with_images')) :
    function get_latest_reviews_attachment_ids_with_images($product_id, $limit = 5) {
        $attachment_ids= [];
        $k = 0;
        $args = array(
            'post_id' => $product_id,
            // 'number' => $limit,
            'status' => 'approve',
            'meta_query' => array(
                array(
                    'key' => 'nasa_review_images',
                    'compare' => 'EXISTS'
                ),
            ),
            'orderby' => 'comment_date',
            'order' => 'DESC',
        );

        $comments = get_comments($args);

        if (!empty($comments)) {
            foreach ($comments as $comment) {
        
                $review_images = get_comment_meta($comment->comment_ID, 'nasa_review_images', true);
                
                if (!empty($review_images) && is_array($review_images)) {
                    foreach ($review_images as $attachment_id) {
                        $k++;
                        if (count($attachment_ids) < 5) {
                            $attachment_ids[] = $attachment_id;
                        }
                    }
                }
            }
        }
    
        return ['attachment_ids' => $attachment_ids, 'count' => $k];
    }
endif;

/**
 * Image size upload for Images review product
 */
if (!function_exists('elessi_comment_img_sizes')) :
    function elessi_comment_img_sizes($sizes) {
        if (isset($sizes['thumbnail'])) {
            return array('thumbnail' => $sizes['thumbnail']);
        }

        return $sizes;
    }
endif;

/**
 * Show Review images
 */
add_action('woocommerce_review_before', 'elessi_review_images', 10, 1);
if (!function_exists('elessi_review_images')) :
    function elessi_review_images($comment) {
        global $nasa_opt;
        
        if (!isset($nasa_opt['comment_media']) || !$nasa_opt['comment_media']) {
            return;
        }
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-review-images.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-review-images.php';
    }
endif;


/**
 * Add Svg Account Dashboard Square
 */
if (!function_exists('elessi_add_svg_images')) :
    function elessi_add_svg_images($endpoint) {
        $svg = '';
        switch ($endpoint) {
            case 'orders':
                $svg = '<svg width="100%" height="50" viewBox="0 0 25 32"><path d="M6.294 14.164h12.588v1.049h-12.588v-1.049z" fill="currentColor"/><path d="M6.294 18.36h12.588v1.049h-12.588v-1.049z" fill="currentColor"/><path d="M6.294 22.557h8.392v1.049h-8.392v-1.049z" fill="currentColor"/><path d="M15.688 3.674c-0.25-1.488-1.541-2.623-3.1-2.623s-2.85 1.135-3.1 2.623h-9.489v27.275h25.176v-27.275h-9.488zM10.49 6.082v-1.884c0-1.157 0.941-2.098 2.098-2.098s2.098 0.941 2.098 2.098v1.884l0.531 0.302c1.030 0.586 1.82 1.477 2.273 2.535h-9.803c0.453-1.058 1.243-1.949 2.273-2.535l0.53-0.302zM24.128 29.9h-23.078v-25.177h8.392v0.749c-1.638 0.932-2.824 2.566-3.147 4.496h12.588c-0.322-1.93-1.509-3.563-3.147-4.496v-0.749h8.392v25.177z" fill="currentColor"/></svg>';
                break;
            
            case 'downloads':
                $svg = '<svg width="100%" height="50" viewBox="0 0 32 32">
                <path d="M11.335 13.315l-0.754 0.754 5.419 5.419 5.419-5.419-0.754-0.754-4.132 4.132v-16.877h-1.066v16.877z" fill="currentColor"/>
                <path d="M18.666 5.9v1.066h6.931v18.126h-19.192v-18.126h6.931v-1.066h-7.997v20.259h21.325v-20.259z" fill="currentColor"/>
                </svg>';
                break;
            
            case 'edit-address':
                $svg = '<svg width="100%" height="50" viewBox="0 0 32 32">
                <path d="M16.001 1.072c5.291 0 9.596 4.305 9.596 9.597 0 1.683-0.446 3.341-1.29 4.799l-8.307 14.394-8.308-14.395c-0.843-1.456-1.289-3.115-1.289-4.798 0-5.292 4.305-9.597 9.597-9.597zM16.001 14.4c2.058 0 3.731-1.674 3.731-3.731s-1.674-3.731-3.731-3.731c-2.058 0-3.732 1.674-3.732 3.731s1.674 3.731 3.732 3.731zM16.001 0.006c-5.889 0-10.663 4.775-10.663 10.663 0 1.945 0.523 3.762 1.432 5.332l9.23 15.994 9.23-15.994c0.909-1.57 1.432-3.387 1.432-5.332 0-5.888-4.774-10.663-10.662-10.663v0zM16.001 13.334c-1.472 0-2.666-1.193-2.666-2.665 0-1.471 1.194-2.665 2.666-2.665s2.665 1.194 2.665 2.665c0 1.472-1.193 2.665-2.665 2.665v0z" fill="currentColor"/>
                </svg>';
                break;
            
            case 'edit-account':
                $svg = '<svg width="100%" height="50" viewBox="0 0 32 32">
                <path d="M16 3.205c-7.067 0-12.795 5.728-12.795 12.795s5.728 12.795 12.795 12.795 12.795-5.728 12.795-12.795c0-7.067-5.728-12.795-12.795-12.795zM16 4.271c6.467 0 11.729 5.261 11.729 11.729 0 2.845-1.019 5.457-2.711 7.49-1.169-0.488-3.93-1.446-5.638-1.951-0.146-0.046-0.169-0.053-0.169-0.66 0-0.501 0.206-1.005 0.407-1.432 0.218-0.464 0.476-1.244 0.569-1.944 0.259-0.301 0.612-0.895 0.839-2.026 0.199-0.997 0.106-1.36-0.026-1.7-0.014-0.036-0.028-0.071-0.039-0.107-0.050-0.234 0.019-1.448 0.189-2.391 0.118-0.647-0.030-2.022-0.921-3.159-0.562-0.719-1.638-1.601-3.603-1.724l-1.078 0.001c-1.932 0.122-3.008 1.004-3.57 1.723-0.89 1.137-1.038 2.513-0.92 3.159 0.172 0.943 0.239 2.157 0.191 2.387-0.010 0.040-0.025 0.075-0.040 0.111-0.131 0.341-0.225 0.703-0.025 1.7 0.226 1.131 0.579 1.725 0.839 2.026 0.092 0.7 0.35 1.48 0.569 1.944 0.159 0.339 0.234 0.801 0.234 1.454 0 0.607-0.023 0.614-0.159 0.657-1.767 0.522-4.579 1.538-5.628 1.997-1.725-2.042-2.768-4.679-2.768-7.555 0-6.467 5.261-11.729 11.729-11.729zM7.811 24.386c1.201-0.49 3.594-1.344 5.167-1.808 0.914-0.288 0.914-1.058 0.914-1.677 0-0.513-0.035-1.269-0.335-1.908-0.206-0.438-0.442-1.189-0.494-1.776-0.011-0.137-0.076-0.265-0.18-0.355-0.151-0.132-0.458-0.616-0.654-1.593-0.155-0.773-0.089-0.942-0.026-1.106 0.027-0.070 0.053-0.139 0.074-0.216 0.128-0.468-0.015-2.005-0.17-2.858-0.068-0.371 0.018-1.424 0.711-2.311 0.622-0.795 1.563-1.238 2.764-1.315l1.011-0.001c1.233 0.078 2.174 0.521 2.797 1.316 0.694 0.887 0.778 1.94 0.71 2.312-0.154 0.852-0.298 2.39-0.17 2.857 0.022 0.078 0.047 0.147 0.074 0.217 0.064 0.163 0.129 0.333-0.025 1.106-0.196 0.977-0.504 1.461-0.655 1.593-0.103 0.091-0.168 0.218-0.18 0.355-0.051 0.588-0.286 1.338-0.492 1.776-0.236 0.502-0.508 1.171-0.508 1.886 0 0.619 0 1.389 0.924 1.68 1.505 0.445 3.91 1.271 5.18 1.77-2.121 2.1-5.035 3.4-8.248 3.4-3.183 0-6.073-1.277-8.188-3.342z" fill="currentColor"/>
                </svg>';
                break;
            
            case 'customer-logout':
                $svg = '<svg width="100%" height="50" viewBox="0 0 32 32">
                <path d="M14.389 7.956v4.374l1.056 0.010c7.335 0.071 11.466 3.333 12.543 9.944-4.029-4.661-8.675-4.663-12.532-4.664h-1.067v4.337l-9.884-7.001 9.884-7zM15.456 5.893l-12.795 9.063 12.795 9.063v-5.332c5.121 0.002 9.869 0.26 13.884 7.42 0-4.547-0.751-14.706-13.884-14.833v-5.381z" fill="currentColor"/>
                </svg>';
                break;
            
            case '1':
            default:
                $svg = '<svg width="32" height="32" viewBox="0 0 32 32">
                <path d="M3.205 12.801c-1.767 0-3.199 1.432-3.199 3.199s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.199-3.199-3.199zM3.205 18.133c-1.177 0-2.132-0.956-2.132-2.133s0.956-2.133 2.132-2.133c1.176 0 2.133 0.956 2.133 2.133s-0.957 2.133-2.132 2.133z" fill="currentColor"/>
                <path d="M28.795 12.801c-1.767 0-3.199 1.432-3.199 3.199s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.199-3.199-3.199zM28.795 18.133c-1.176 0-2.133-0.956-2.133-2.133s0.957-2.133 2.133-2.133c1.176 0 2.133 0.956 2.133 2.133s-0.957 2.133-2.133 2.133z" fill="currentColor"/>
                <path d="M16 12.801c-1.767 0-3.199 1.432-3.199 3.199s1.432 3.199 3.199 3.199c1.766 0 3.199-1.432 3.199-3.199s-1.433-3.199-3.199-3.199zM16 18.133c-1.176 0-2.133-0.956-2.133-2.133s0.957-2.133 2.133-2.133c1.176 0 2.133 0.956 2.133 2.133s-0.957 2.133-2.133 2.133z" fill="currentColor"/>
                </svg>';
                break;
        }

        return $svg;
    }
endif;

/**
 * Add Svg into post mesg
 */
add_filter( 'wp_kses_allowed_html', 'wp_kses_allowed_html_svg', 10, 2);
if (!function_exists('wp_kses_allowed_html_svg')) :
function wp_kses_allowed_html_svg( $allowedposttags, $context ) {
    if ( $context === 'post' ) {
        $allowedposttags['svg']  = array(
            'xmlns'   => true,
            'viewbox' => true,
            'width' => true,
            'height' => true,
        );
        $allowedposttags['path'] = array(
            'd'    => true,
            'fill' => true,
        );
    }
    return $allowedposttags;
}
endif;

/**
 * Ajax return json for Submit Review
 */
add_filter('comment_post_redirect', 'custom_comment_post_redirect', 10, 2);
if (!function_exists('custom_comment_post_redirect')) :
function custom_comment_post_redirect($location, $comment) {
    /**
     * No change with Customer Reviews for WooCommerce plugin
     */
    if (function_exists('cusrev_init') || $comment->comment_type !== 'review') {
        return $location;
    }

    $location = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : preg_replace('/comment-page-\d+.*$/', '', $location);

    $parsed_url = parse_url($location);
    $query_params = array();
    parse_str($parsed_url['query'] ?? '', $query_params);

    $query_params['review_sort'] = 'date_DESC';

    $parsed_url['query'] = http_build_query($query_params);

    $location = $parsed_url['scheme'] . '://' . $parsed_url['host'] . $parsed_url['path'] . '?' . $parsed_url['query'];

    $html = file_get_contents($location);
    $response = array(
        'code' => 'success',
        'html' => $html,
        'comment_id' => '#li-comment-' . $comment->comment_ID,
        'message' => esc_html__('Your review has been submitted', 'elessi-theme'),
    );

    header('Content-Type: application/json');
    
    echo json_encode($response);

    exit;
}
endif;

add_filter('comment_class', 'elessi_add_custom_class_to_review', 10, 5);
if (!function_exists('elessi_add_custom_class_to_review')) :
function elessi_add_custom_class_to_review($classes, $css_class, $comment_ID, $comment, $post) {
    // var_dump($comment);
    if (get_post_type($post) == 'product') {
        $classes[] = 'ns-product-review';
    }
    return $classes;
}
endif;

add_action('woocommerce_review_before', 'elessi_review_confetti', 10, 1);
if (!function_exists('elessi_review_confetti')) :
    function elessi_review_confetti() { 
        global $nasa_opt;
        $theme_version = isset($nasa_opt['js_theme_version']) && $nasa_opt['js_theme_version'] ? apply_filters('nasa_version_assets', NASA_VERSION) : null;
    
        wp_enqueue_script('jquery-confetti', ELESSI_THEME_URI . '/assets/js/min/jquery.confetti.min.js', array('jquery'), $theme_version, true);
    }
endif;
