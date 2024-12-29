<?php

defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Add action dokan
 */
add_action('init', 'elessi_add_action_dokan');
if (!function_exists('elessi_add_action_dokan')) :

    function elessi_add_action_dokan() {
        global $nasa_opt;

        add_action('woocommerce_after_shop_loop_item_title', 'elessi_dokan_loop_sold_by');

        add_action('woocommerce_single_product_summary', 'elessi_dokan_loop_sold_by', 20);

        // Hide Uncategorized
        if (!isset($nasa_opt['show_uncategorized']) || !$nasa_opt['show_uncategorized']) {
            add_filter('dokan_category_widget', 'elessi_hide_uncategorized');
        }
        
        add_filter('woocommerce_get_breadcrumb', 'elessi_dokan_get_breadcrumb', 9999);
    }

endif;

/**
 * Since 5.1.8
 * 
 * Fix Breadcrumb Dokan Store
 */
if (!function_exists('elessi_dokan_loop_sold_by')) :
    function elessi_dokan_get_breadcrumb($crumbs) {
        if (!dokan_is_store_page()) {
            return $crumbs;
        }

        if (function_exists('yoast_breadcrumb') && \WPSEO_Options::get('breadcrumbs-enable')) {
            unset($crumbs);

            return;
        }
        
        $custom_store_url = dokan_get_option('custom_store_url', 'dokan_general', 'store');
        
        $author      = get_query_var($custom_store_url);
        $seller_info = get_user_by('slug', $author);

        if (!$seller_info) {
            return;
        }
		
        $store_user = dokan()->vendor->get($seller_info);
        $shop_name  = $store_user->get_shop_name();

        $crumbs[2] = [$shop_name, dokan_get_store_url($seller_info->data->ID)];

        return $crumbs;
    }
endif;

/**
 * Compatible with DOKAN plugin
 * 
 * sold-by in loop
 */
if (!function_exists('elessi_dokan_loop_sold_by')) :

    function elessi_dokan_loop_sold_by() {
        global $post, $nasa_dokan_vendors;

        if (!$post) {
            return;
        }

        if (!isset($nasa_dokan_vendors)) {
            $nasa_dokan_vendors = array();
        }

        if (!isset($nasa_dokan_vendors[$post->post_author])) {
            $author = get_user_by('id', $post->post_author);
            $store_info = dokan_get_store_info($author->ID);

            if (!empty($store_info['store_name'])) {
                $nasa_dokan_vendors[$post->post_author]['name'] = $store_info['store_name'];
                $nasa_dokan_vendors[$post->post_author]['url'] = dokan_get_store_url($author->ID);
            } else {
                $nasa_dokan_vendors[$post->post_author] = null;
            }

            $GLOBALS['nasa_dokan_vendors'] = $nasa_dokan_vendors;
        }

        if (isset($nasa_dokan_vendors[$post->post_author]) && $nasa_dokan_vendors[$post->post_author]) {
            echo '<span class="nasa-dokan-sold_by_in_loop">' .
                esc_html__('Sold By: ', 'elessi-theme') .
                '<a ' .
                'href="' . esc_url($nasa_dokan_vendors[$post->post_author]['url']) . '" ' .
                'class="nasa-dokan-sold_by_href" ' .
                'title="' . esc_attr($nasa_dokan_vendors[$post->post_author]['name']) . '">' .
                    $nasa_dokan_vendors[$post->post_author]['name'] .
                '</a>' .
            '</span>';
        }
    }

endif;

/**
 * dokan_enqueue_style
 */
add_action('nasa_before_store_dokan', 'elessi_dokan_enqueue_style');
if (!function_exists('elessi_dokan_enqueue_style')) :

    function elessi_dokan_enqueue_style() {
        global $nasa_opt;

        $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        $themeVersion = isset($nasa_opt['css_theme_version']) && $nasa_opt['css_theme_version'] ? apply_filters('nasa_version_assets', NASA_VERSION) : null;

        $prefix = elessi_prefix_theme();

        if (!$in_mobile) {
            wp_enqueue_style($prefix . '-style-products-list', ELESSI_THEME_URI . '/assets/css/style-products-list.css', array(), $themeVersion);
        }
    }

endif;

/**
 * Change view layout
 */
add_action('dokan_store_profile_frame_after', 'elessi_dokan_change_view_store', 15);
if (!function_exists('elessi_dokan_change_view_store')) :

    function elessi_dokan_change_view_store() {
        elessi_nasa_change_view('no');
    }

endif;

/**
 * Class Nasa_Stores
 * Output: Shortcode nasa-dokan-stores
 */
if (class_exists('WeDevs\Dokan\Abstracts\DokanShortcode')) :
    class Nasa_Stores extends WeDevs\Dokan\Abstracts\DokanShortcode {

        protected $shortcode = 'nasa-dokan-stores';

        /**
         * Displays the store lists
         *
         * @since 2.4
         *
         * @param  array $atts
         *
         * @return string
         */
        public function render_shortcode($atts) {
            $defaults = array(
                'per_page' => 10,
                'search' => 'yes',
                'per_row' => '3',
                'featured' => 'no',
                'category' => '',
                'order' => '',
                'orderby' => '',
                'store_id' => '',
                'with_products_only' => '',
                'style' => 'grid-1'
            );

            /**
             * Filter return the number of store listing number per page.
             *
             * @since 2.2
             *
             * @param array
             */
            $attr = shortcode_atts(apply_filters('dokan_store_listing_per_page', $defaults), $atts);
            $paged = (int) is_front_page() ? max(1, get_query_var('page')) : max(1, get_query_var('paged'));
            $limit = $attr['per_page'];
            $offset = ($paged - 1) * $limit;

            $seller_args = array(
                'number' => $limit,
                'offset' => $offset,
                'order' => 'DESC',
            );

            $_get_data = wp_unslash($_GET);

            // if search is enabled, perform a search
            if ('yes' === $attr['search']) {
                if (!empty($_get_data['dokan_seller_search'])) {
                    $seller_args['meta_query'] = array(
                        array(
                            'key' => 'dokan_store_name',
                            'value' => wc_clean($_get_data['dokan_seller_search']),
                            'compare' => 'LIKE',
                        ),
                    );
                }
            }

            if ('yes' === $attr['featured']) {
                $seller_args['featured'] = 'yes';
            }

            if (!empty($attr['category'])) {
                $seller_args['store_category_query'][] = array(
                    'taxonomy' => 'store_category',
                    'field' => 'slug',
                    'terms' => explode(',', $attr['category']),
                );
            }

            if (!empty($attr['order'])) {
                $seller_args['order'] = $attr['order'];
            }

            if (!empty($attr['orderby'])) {
                $seller_args['orderby'] = $attr['orderby'];
            }

            if (!empty($attr['with_products_only']) && 'yes' === $attr['with_products_only']) {
                $seller_args['has_published_posts'] = ['product'];
            }

            if (!empty($attr['store_id'])) {
                $seller_args['include'] = explode(',', $attr['store_id']);
            }

            $sellers = dokan_get_sellers(apply_filters('dokan_seller_listing_args', $seller_args, $_GET));
            
            if (!in_array($attr['style'], array('grid-1', 'grid-2', 'list-1', 'list-2', 'list-3'))) {
                $attr['style'] = 'grid-1';
            }

            /**
             * Filter for store listing args
             *
             * @since 2.4.9
             */
            $template_args = apply_filters(
                'dokan_store_list_args', array(
                    'sellers' => $sellers,
                    'limit' => $limit,
                    'offset' => $offset,
                    'paged' => $paged,
                    'image_size' => 'full',
                    'search' => $attr['search'],
                    'per_row' => in_array($attr['per_row'], array('2', '3')) ? $attr['per_row'] : 2,
                    'layout' => $attr['style']
                )
            );

            ob_start();

            dokan_get_template_part('nasa-store-lists', false, $template_args);
            $content = ob_get_clean();

            return apply_filters('nasa_dokan_seller_listing', $content, $attr);
        }

    }
endif;

/**
 * Register Shortcode nasa-dokan-stores
 * 
 */
add_filter('dokan_shortcodes', 'elessi_dokan_sc_nasa_stores');
if (!function_exists('elessi_dokan_sc_nasa_stores')) :
    function elessi_dokan_sc_nasa_stores($shortcodes) {
        $shortcodes['nasa-dokan-stores'] = new Nasa_Stores();
        
        return $shortcodes;
    }
endif;

/**
 * Get Products from seller
 */
if (!function_exists('elessi_dokan_products_from_seller')) :
    function elessi_dokan_products_from_seller($seller_id = 0, $posts_per_page = 5) {
        return new WP_Query(array(
            'post_type'         => 'product',
            'post_status'       => 'publish',
            'posts_per_page'    => (int) $posts_per_page,
            'orderby'           => apply_filters('nasa_order_by_dokan_product_from_seller', 'rand'),
            'author'            => (int) $seller_id
        ));
    }
endif;

/**
 * Filter Store Listing Page
 */
add_filter('dokan_is_store_listing', 'elessi_is_store_listing', 10, 2);
if (!function_exists('elessi_is_store_listing')) :
    function elessi_is_store_listing($found, $page_id) {
        if (!$found) {
            $post = get_post($page_id);

            if ($post && false !== strpos($post->post_content, '[nasa-dokan-stores')) {
                $found = true;
            }
        }

        return $found;
    }
endif;
