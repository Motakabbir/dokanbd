<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Register Ajax Actions
 */
if (!function_exists('elessi_ajax_actions')) :
    function elessi_ajax_actions($ajax_actions = array()) {
        $ajax_actions[] = 'nasa_update_wishlist';
        $ajax_actions[] = 'nasa_remove_from_wishlist';
        $ajax_actions[] = 'live_search_products';

        return $ajax_actions;
    }
endif;

/**
 * Map short code for ajax
 */
if (!function_exists('elessi_init_map_shortcode')) :
    function elessi_init_map_shortcode() {
        if (class_exists('WPBMap')) {
            WPBMap::addAllMappedShortcodes();
        }
    }
endif;

/**
 * Update Wishlist
 * Yith Wishlist
 */
add_action('wp_ajax_nasa_update_wishlist', 'elessi_update_wishlist');
add_action('wp_ajax_nopriv_nasa_update_wishlist', 'elessi_update_wishlist');
if (!function_exists('elessi_update_wishlist')) :
    function elessi_update_wishlist(){
        global $nasa_opt;
        
        $json = array(
            'list' => '',
            'count' => 0
        );
        
        $json['list'] = elessi_mini_wishlist_sidebar(true);
        $json['status_add'] = 'true';
        $count = function_exists('yith_wcwl_count_products') ? yith_wcwl_count_products() : 0;
        
        if (!isset($nasa_opt['compact_number']) || $nasa_opt['compact_number']) {
            $count = (int) $count > 9 ? '9+' : (int) $count;
        }
        
        $json['count'] = apply_filters('nasa_mini_wishlist_total_items', $count);
        
        // if (NASA_WISHLIST_NEW_VER && isset($_REQUEST['added']) && $_REQUEST['added']) {
        //     $json['mess'] = '<div id="yith-wcwl-message">' . esc_html__('Product Added!', 'elessi-theme') . '</div>';
        // }

        die(json_encode($json));
    }
endif;

/**
 * Remove From Wishlist
 * Yith Wishlist
 */
add_action('wp_ajax_nasa_remove_from_wishlist', 'elessi_remove_from_wishlist');
add_action('wp_ajax_nopriv_nasa_remove_from_wishlist', 'elessi_remove_from_wishlist');
if (!function_exists('elessi_remove_from_wishlist')) :
    function elessi_remove_from_wishlist(){
        global $nasa_opt;
        
        $json = array(
            'error' => '1',
            'list' => '',
            'count' => 0,
            'mess' => ''
        );

        if (!NASA_WISHLIST_ENABLE) {
            die(json_encode($json));
        }
        
        $detail = array();
        $detail['remove_from_wishlist'] = isset($_REQUEST['remove_from_wishlist']) ? (int) $_REQUEST['remove_from_wishlist'] : 0;
        $detail['wishlist_id'] = isset($_REQUEST['wishlist_id']) ? (int) $_REQUEST['wishlist_id'] : 0;
        $detail['pagination'] = isset($_REQUEST['pagination']) ? (int) $_REQUEST['pagination'] : 'no';
        $detail['per_page'] = isset($_REQUEST['per_page']) ? (int) $_REQUEST['per_page'] : 5;
        $detail['current_page'] = isset($_REQUEST['current_page']) ? (int) $_REQUEST['current_page'] : 1;
        $detail['user_id'] = NASA_CORE_USER_LOGGED ? get_current_user_id() : false;
        $mess_success = '<div id="yith-wcwl-message">' . esc_html__('Product successfully removed!', 'elessi-theme') . '</div>';

        if (!NASA_WISHLIST_NEW_VER) {
            $nasa_wishlist = new YITH_WCWL($detail);
            $json['error'] = elessi_remove_wishlist_item($nasa_wishlist, true) ? '0' : '1';

            if ($json['error'] == '0') {
                $json['list'] = elessi_mini_wishlist_sidebar(true);
                $count = yith_wcwl_count_products();
                
                if (!isset($nasa_opt['compact_number']) || $nasa_opt['compact_number']) {
                    $count = (int) $count > 9 ? '9+' : (int) $count;
                }
                
                $json['count'] = apply_filters('nasa_mini_compare_total_items', $count);
                $json['mess'] = $mess_success;
            }
        } else {
            try{
                YITH_WCWL()->remove($detail);
                $json['list'] = elessi_mini_wishlist_sidebar(true);
                $count = yith_wcwl_count_products();
                
                if (!isset($nasa_opt['compact_number']) || $nasa_opt['compact_number']) {
                    $count = (int) $count > 9 ? '9+' : (int) $count;
                }
                
                $json['count'] = apply_filters('nasa_mini_compare_total_items', $count);
                $json['mess'] = $mess_success;
                $json['error'] = '0';
            } catch(Exception $e) {
                $json['mess'] = $e->getMessage();
            }
        }

        die(json_encode($json));
    }
endif;

/**
 * Remove Wishlist item
 * Yith Wishlist
 */
if (!function_exists('elessi_remove_wishlist_item')) :
    function elessi_remove_wishlist_item($nasa_wishlist, $remove_force) {
        if (!function_exists('yith_getcookie')) {
            return false;
        }
        
        if (get_option('yith_wcwl_remove_after_add_to_cart') == 'yes' || $remove_force) {
            if (!$nasa_wishlist->details['user_id']){
                $wishlist = yith_getcookie('yith_wcwl_products');
                
                foreach ($wishlist as $key => $item){
                    if ($item['prod_id'] == $nasa_wishlist->details['remove_from_wishlist']){
                        unset($wishlist[$key]);
                    }
                }
                
                yith_setcookie('yith_wcwl_products', $wishlist);

                return true;
            }

            return $nasa_wishlist->remove();
        }

        return true;
    }
endif;

/**
 * Login Ajax
 */
add_action('wp_ajax_nopriv_nasa_process_login', 'elessi_process_login');
add_action('wp_ajax_nasa_process_login', 'elessi_process_login');
if (!function_exists('elessi_process_login')) :
    function elessi_process_login() {
        $mess = array(
            'error' => '1',
            'mess' => esc_html__('Error.', 'elessi-theme'),
            '_wpnonce' => '0'
        );
        
        if (empty($_REQUEST['data'])) {
            die(json_encode($mess));
        }
        
        $input = array();
        foreach ($_REQUEST['data'] as $values) {
            if (isset($values['name']) && isset($values['value'])) {
                $input[$values['name']] = $values['value'];
            }
        }

        if (isset($input['woocommerce-login-nonce'])) {
            $nonce_value = $input['woocommerce-login-nonce'];
        } else {
            $nonce_value = isset($input['_wpnonce']) ? $input['_wpnonce'] : '';
        }

        // Check _wpnonce
        if (!wp_verify_nonce($nonce_value, 'woocommerce-login')) {
            $mess['_wpnonce'] = 'error';
            die(json_encode($mess));
        }

        if (!empty($_REQUEST['login'])) {
            $creds    = array();
            $username = trim($input['nasa_username']);

            $validation_Obj = new WP_Error();
            $validation_error = apply_filters('woocommerce_process_login_errors', $validation_Obj, $input['nasa_username'], $input['nasa_username']);

            // Login error
            if ($validation_error->get_error_code()) {
                $mess['mess'] = '<strong>' . esc_html__('Error', 'elessi-theme') . ':</strong> ' . $validation_error->get_error_message();

                die(json_encode($mess));
            }

            // Require username
            if (empty($username)) {
                $mess['mess'] = '<strong>' . esc_html__('Error', 'elessi-theme') . ':</strong> ' . esc_html__('Username is required.', 'elessi-theme');

                die(json_encode($mess));
            }

            // Require Password
            if (empty($input['nasa_password'])) {
                $mess['mess'] = '<strong>' . esc_html__('Error', 'elessi-theme') . ':</strong> ' . esc_html__('Password is required.', 'elessi-theme');

                die(json_encode($mess));
            }

            if (is_email($username) && apply_filters('woocommerce_get_username_from_email', true)) {
                $user = get_user_by('email', $username);

                if (!isset($user->user_login)) {
                    // Email error
                    $mess['mess'] = '<strong>' . esc_html__('Error', 'elessi-theme') . ':</strong> ' . esc_html__('A user could not be found with this email address.', 'elessi-theme');

                    die(json_encode($mess));
                }

                $creds['user_login'] = $user->user_login;
            } else {
                $creds['user_login'] = $username;
            }

            $creds['user_password'] = $input['nasa_password'];
            $creds['remember'] = isset($input['nasa_rememberme']);
            $secure_cookie = is_ssl() ? true : false;
            $user = wp_signon(apply_filters('woocommerce_login_credentials', $creds), $secure_cookie);

            if (is_wp_error($user)) {
                // Other Error
                $message = $user->get_error_message();
                $mess['mess'] = str_replace(
                    '<strong>' . esc_html($creds['user_login']) . '</strong>',
                    '<strong>' . esc_html($username) . '</strong>',
                    $message
                );

                die(json_encode($mess));
            } else {
                // Login success
                $mess['error'] = '0';
                
                if (! empty($input['nasa_redirect'])) {
                    $redirect = $input['nasa_redirect'];
                } else{
                    $redirect_uri = wp_get_referer();
                    $redirect = $redirect_uri ? $redirect_uri : (NASA_WOO_ACTIVED ? wc_get_page_permalink('myaccount') : home_url('/'));
                }
                
                $svg = '<svg class="svg-login-succes" width="60px" height="60px" viewBox="0 0 24.00 24.00" fill="currentColor" stroke-width="0.552"><g stroke-width="0"></g><g stroke-linecap="round" stroke-linejoin="round"></g><g> <path d="M10.5 15.25C10.307 15.2353 10.1276 15.1455 9.99998 15L6.99998 12C6.93314 11.8601 6.91133 11.7029 6.93756 11.55C6.96379 11.3971 7.03676 11.2562 7.14643 11.1465C7.2561 11.0368 7.39707 10.9638 7.54993 10.9376C7.70279 10.9114 7.86003 10.9332 7.99998 11L10.47 13.47L19 5.00004C19.1399 4.9332 19.2972 4.91139 19.45 4.93762C19.6029 4.96385 19.7439 5.03682 19.8535 5.14649C19.9632 5.25616 20.0362 5.39713 20.0624 5.54999C20.0886 5.70286 20.0668 5.86009 20 6.00004L11 15C10.8724 15.1455 10.6929 15.2353 10.5 15.25Z" fill="currentColor" /> <path d="M12 21C10.3915 20.9974 8.813 20.5638 7.42891 19.7443C6.04481 18.9247 4.90566 17.7492 4.12999 16.34C3.54037 15.29 3.17596 14.1287 3.05999 12.93C2.87697 11.1721 3.2156 9.39921 4.03363 7.83249C4.85167 6.26578 6.1129 4.9746 7.65999 4.12003C8.71001 3.53041 9.87134 3.166 11.07 3.05003C12.2641 2.92157 13.4719 3.03725 14.62 3.39003C14.7224 3.4105 14.8195 3.45215 14.9049 3.51232C14.9903 3.57248 15.0622 3.64983 15.116 3.73941C15.1698 3.82898 15.2043 3.92881 15.2173 4.03249C15.2302 4.13616 15.2214 4.2414 15.1913 4.34146C15.1612 4.44152 15.1105 4.53419 15.0425 4.61352C14.9745 4.69286 14.8907 4.75712 14.7965 4.80217C14.7022 4.84723 14.5995 4.87209 14.4951 4.87516C14.3907 4.87824 14.2867 4.85946 14.19 4.82003C13.2186 4.52795 12.1987 4.43275 11.19 4.54003C10.193 4.64212 9.22694 4.94485 8.34999 5.43003C7.50512 5.89613 6.75813 6.52088 6.14999 7.27003C5.52385 8.03319 5.05628 8.91361 4.77467 9.85974C4.49307 10.8059 4.40308 11.7987 4.50999 12.78C4.61208 13.777 4.91482 14.7431 5.39999 15.62C5.86609 16.4649 6.49084 17.2119 7.23999 17.82C8.00315 18.4462 8.88357 18.9137 9.8297 19.1953C10.7758 19.4769 11.7686 19.5669 12.75 19.46C13.747 19.3579 14.713 19.0552 15.59 18.57C16.4349 18.1039 17.1818 17.4792 17.79 16.73C18.4161 15.9669 18.8837 15.0864 19.1653 14.1403C19.4469 13.1942 19.5369 12.2014 19.43 11.22C19.4201 11.1169 19.4307 11.0129 19.461 10.9139C19.4914 10.8149 19.5409 10.7228 19.6069 10.643C19.6728 10.5631 19.7538 10.497 19.8453 10.4485C19.9368 10.3999 20.0369 10.3699 20.14 10.36C20.2431 10.3502 20.3471 10.3607 20.4461 10.3911C20.5451 10.4214 20.6372 10.471 20.717 10.5369C20.7969 10.6028 20.863 10.6839 20.9115 10.7753C20.9601 10.8668 20.9901 10.9669 21 11.07C21.1821 12.829 20.842 14.6026 20.0221 16.1695C19.2022 17.7363 17.9389 19.0269 16.39 19.88C15.3288 20.4938 14.1495 20.8755 12.93 21C12.62 21 12.3 21 12 21Z" /></g></svg>';
                
                $mess['svg_check'] = apply_filters('ns_svg_login_congrat', $svg);
                
                $mess['redirect'] = $redirect;
                
                $mess['mess'] = sprintf(
                    wp_kses(
                        __('<h4 class="nasa-success-congrat">Congratulations!</h4><h4 class="nasa-success">You are now successfully authenticated. You can now close this tab, or visit <a class="link-your-dashboard primary-color" href="%s">your dashboard</a>.</h4>', 'elessi-theme'),
                        array(
                            'h4' => array('class' => array()),
                            'a' => array('class' => array(), 'href' => array())
                        )
                    ),
                    esc_url(wc_get_page_permalink('myaccount'))
                );
            }
        }

        die(json_encode($mess));
    }
endif;

/**
 * Register Ajax
 */
add_action('wp_ajax_nopriv_nasa_process_register', 'elessi_process_register');
add_action('wp_ajax_nasa_process_register', 'elessi_process_register');
if (!function_exists('elessi_process_register')) :
    function elessi_process_register() {
        if (empty($_REQUEST['data'])) {
            die;
        }
        
        $mess = array(
            'error' => '1',
            'mess' => esc_html__('Error.', 'elessi-theme'),
            '_wpnonce' => '0'
        );
        $input = array();
        foreach ($_REQUEST['data'] as $values) {
            if (isset($values['name']) && isset($values['value'])) {
                $input[$values['name']] = $values['value'];
            }
        }
        
        if (isset($input['woocommerce-register-nonce'])) {
            $nonce_value = $input['woocommerce-register-nonce'];
        } else {
            $nonce_value = isset($input['_wpnonce']) ? $input['_wpnonce'] : '';
        }

        if (! empty($_REQUEST['register'])) {
            $_POST = $input;
            
            // Check _wpnonce
            if (!wp_verify_nonce($nonce_value, 'woocommerce-register')) {
                $mess['_wpnonce'] = 'error';
                die(json_encode($mess));
            }
            
            $username = 'no' === get_option('woocommerce_registration_generate_username') ? $_POST['nasa_username'] : '';
            $password = 'no' === get_option('woocommerce_registration_generate_password') ? $_POST['nasa_password'] : '';
            $email    = $_POST['nasa_email'];

            $validation_Obj = new WP_Error();
            $validation_error = apply_filters('woocommerce_process_registration_errors', $validation_Obj, $username, $password, $email);

            if ($validation_error->get_error_code()) {
                $mess['mess'] = $validation_error->get_error_message();
                die(json_encode($mess));
            }

            $new_customer = wc_create_new_customer(sanitize_email($email), wc_clean($username), $password);

            if (is_wp_error($new_customer)) {
                $mess['mess'] = $new_customer->get_error_message();
                die(json_encode($mess));
            }

            if (apply_filters('woocommerce_registration_auth_new_customer', true, $new_customer)) {
                wc_set_customer_auth_cookie($new_customer);
            }

            // Register success.
            $svg = '<svg class="svg-login-succes" width="60px" height="60px" viewBox="0 0 24.00 24.00" fill="currentColor" stroke-width="0.552"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M10.5 15.25C10.307 15.2353 10.1276 15.1455 9.99998 15L6.99998 12C6.93314 11.8601 6.91133 11.7029 6.93756 11.55C6.96379 11.3971 7.03676 11.2562 7.14643 11.1465C7.2561 11.0368 7.39707 10.9638 7.54993 10.9376C7.70279 10.9114 7.86003 10.9332 7.99998 11L10.47 13.47L19 5.00004C19.1399 4.9332 19.2972 4.91139 19.45 4.93762C19.6029 4.96385 19.7439 5.03682 19.8535 5.14649C19.9632 5.25616 20.0362 5.39713 20.0624 5.54999C20.0886 5.70286 20.0668 5.86009 20 6.00004L11 15C10.8724 15.1455 10.6929 15.2353 10.5 15.25Z" fill="currentColor" /> <path d="M12 21C10.3915 20.9974 8.813 20.5638 7.42891 19.7443C6.04481 18.9247 4.90566 17.7492 4.12999 16.34C3.54037 15.29 3.17596 14.1287 3.05999 12.93C2.87697 11.1721 3.2156 9.39921 4.03363 7.83249C4.85167 6.26578 6.1129 4.9746 7.65999 4.12003C8.71001 3.53041 9.87134 3.166 11.07 3.05003C12.2641 2.92157 13.4719 3.03725 14.62 3.39003C14.7224 3.4105 14.8195 3.45215 14.9049 3.51232C14.9903 3.57248 15.0622 3.64983 15.116 3.73941C15.1698 3.82898 15.2043 3.92881 15.2173 4.03249C15.2302 4.13616 15.2214 4.2414 15.1913 4.34146C15.1612 4.44152 15.1105 4.53419 15.0425 4.61352C14.9745 4.69286 14.8907 4.75712 14.7965 4.80217C14.7022 4.84723 14.5995 4.87209 14.4951 4.87516C14.3907 4.87824 14.2867 4.85946 14.19 4.82003C13.2186 4.52795 12.1987 4.43275 11.19 4.54003C10.193 4.64212 9.22694 4.94485 8.34999 5.43003C7.50512 5.89613 6.75813 6.52088 6.14999 7.27003C5.52385 8.03319 5.05628 8.91361 4.77467 9.85974C4.49307 10.8059 4.40308 11.7987 4.50999 12.78C4.61208 13.777 4.91482 14.7431 5.39999 15.62C5.86609 16.4649 6.49084 17.2119 7.23999 17.82C8.00315 18.4462 8.88357 18.9137 9.8297 19.1953C10.7758 19.4769 11.7686 19.5669 12.75 19.46C13.747 19.3579 14.713 19.0552 15.59 18.57C16.4349 18.1039 17.1818 17.4792 17.79 16.73C18.4161 15.9669 18.8837 15.0864 19.1653 14.1403C19.4469 13.1942 19.5369 12.2014 19.43 11.22C19.4201 11.1169 19.4307 11.0129 19.461 10.9139C19.4914 10.8149 19.5409 10.7228 19.6069 10.643C19.6728 10.5631 19.7538 10.497 19.8453 10.4485C19.9368 10.3999 20.0369 10.3699 20.14 10.36C20.2431 10.3502 20.3471 10.3607 20.4461 10.3911C20.5451 10.4214 20.6372 10.471 20.717 10.5369C20.7969 10.6028 20.863 10.6839 20.9115 10.7753C20.9601 10.8668 20.9901 10.9669 21 11.07C21.1821 12.829 20.842 14.6026 20.0221 16.1695C19.2022 17.7363 17.9389 19.0269 16.39 19.88C15.3288 20.4938 14.1495 20.8755 12.93 21C12.62 21 12.3 21 12 21Z" fill="currentColor" /></g></svg>';
            
            $mess['svg_check'] = apply_filters('ns_svg__login_congrat',$svg);
            $mess['error'] = '0';
            $redirect_uri = wp_get_referer();
            $mess['redirect'] = apply_filters('woocommerce_registration_redirect', $redirect_uri ? $redirect_uri : (NASA_WOO_ACTIVED ? wc_get_page_permalink('myaccount') : home_url('/')));
            
            $mess['mess'] = sprintf(
                wp_kses(
                    __('<h4 class="nasa-success-congrat">Congratulations!</h4><h4 class="nasa-success">Now you have successfully registered. You can now close this tab, or visit <a class="link-your-dashboard primary-color" href="%s">your dashboard</a>.</h4>', 'elessi-theme'),
                    array(
                        'h4' => array('class' => array()),
                        'a' => array('class' => array(), 'href'=>array())
                    )
                ),
                esc_url(wc_get_page_permalink('myaccount'))
            );
        }

        die(json_encode($mess));
    }
endif;

/**
 * Live search admin ajax
 */
add_action('wp_ajax_nopriv_live_search_products', 'elessi_live_search_products');
add_action('wp_ajax_live_search_products', 'elessi_live_search_products');
if (!function_exists('elessi_live_search_products')) :
    function elessi_live_search_products() {
        global $nasa_opt, $woocommerce;

        $results = array();
        if (!$woocommerce || !isset($_REQUEST['s']) || trim($_REQUEST['s']) == '') {
            die(json_encode($results));
        }
        
        $data_store = WC_Data_Store::load('product');
        $post_id_in = $data_store->search_products(wc_clean($_REQUEST['s']), '', true, true);
        
        if (empty($post_id_in)) {
            die(json_encode($results));
        }

        $query_args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => (isset($nasa_opt['limit_results_search']) && (int) $nasa_opt['limit_results_search'] > 0) ? (int) $nasa_opt['limit_results_search'] : 5,
            'no_found_rows' => true
        );

        $query_args['meta_query'] = array();
        $query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
        $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
        
        $query_args['post__in'] = array_merge($post_id_in, array(0));
        $query_args['tax_query'] = array('relation' => 'AND');
        $product_visibility_terms = wc_get_product_visibility_term_ids();
        $arr_not_in = array($product_visibility_terms['exclude-from-search']);

        // Hide out of stock products.
        if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
            $arr_not_in[] = $product_visibility_terms['outofstock'];
        }

        if (!empty($arr_not_in)) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field' => 'term_taxonomy_id',
                'terms' => $arr_not_in,
                'operator' => 'NOT IN',
            );
        }

        $search_query = new WP_Query(apply_filters('nasa_query_live_search_products', $query_args));
        if ($the_posts = $search_query->get_posts()) {
            foreach ($the_posts as $the_post) {
                if ($product = wc_get_product($the_post->ID)) {
                    $results[] = array(
                        'title' => $product->get_name(),
                        'url' => $product->get_permalink(),
                        'image' => $product->get_image('thumbnail'),
                        'price' => $product->get_price_html()
                    );
                }
            }
        }
        
        wp_reset_postdata();

        die(json_encode($results));
    }
endif;


/**
 * Support Multi currency - AJAX
 */
if (class_exists('WCML_Multi_Currency')) :
    add_filter('wcml_multi_currency_ajax_actions', 'elessi_multi_currency_ajax', 10, 1);
    if (!function_exists('elessi_multi_currency_ajax')) :
        function elessi_multi_currency_ajax($ajax_actions) {
            return elessi_ajax_actions($ajax_actions);
        }
    endif;
endif;
