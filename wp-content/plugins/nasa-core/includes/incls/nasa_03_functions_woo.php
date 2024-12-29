<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * WooCommerce - Function get Query - new version
 */
function nasa_woo_query($args = array()) {
    if (!NASA_WOO_ACTIVED) {
        return array();
    }
    
    global $nasa_opt;
    
    $defaults = array(
        'type' => '',
        'post_per_page' => -1,
        'paged' => '',
        'cat' => '',
        'ns_tags' => '',
        'ns_brand' => '',
        'pwb_brand' => '',
        'not' => array(),
        'deal_time' => null,
        'hide_out_of_stock' => false
    );
    
    $new_args = wp_parse_args($args, $defaults);
    
    if (!isset($nasa_opt['enable_nasa_brands']) || !$nasa_opt['enable_nasa_brands']) {
        $new_args['ns_brand'] = '';
    }
    
    if (!defined('PWB_PLUGIN_NAME')) {
        $new_args['pwb_brand'] = '';
    }
    
    $paged = $new_args['paged'];
    $new_args['paged'] = $paged == '' ? ($paged = get_query_var('paged') ? (int) get_query_var('paged') : 1) : (int) $paged;
    
    $data = nasa_woo_query_args($new_args);
    
    remove_filter('posts_clauses', 'nasa_order_by_rating_post_clauses');
    remove_filter('posts_clauses', 'nasa_order_by_recent_review_post_clauses');
    
    return $data;
}

/**
 * Build query for Nasa WooCommerce Products - New Version
 * 
 * @param type $inputs
 * @return Obj WP_Query
 */
function nasa_woo_query_args($inputs = array()) {
    if (!NASA_WOO_ACTIVED) {
        return array();
    }
    
    $defaults = array(
        'type' => '',
        'post_per_page' => -1,
        'paged' => '',
        'cat' => '',
        'ns_tags' => '',
        'ns_brand' => '',
        'pwb_brand' => '',
        'not' => array(),
        'deal_time' => null,
        'hide_out_of_stock' => false
    );
    
    $new_inputs = wp_parse_args($inputs, $defaults);

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $new_inputs['post_per_page'],
        'post_status' => 'publish',
        'paged' => $new_inputs['paged']
    );

    $args['meta_query'] = array();
    $args['meta_query'][] = WC()->query->stock_status_meta_query();
    $args['tax_query'] = array('relation' => 'AND');
    
    $visibility_terms = wc_get_product_visibility_term_ids();
    $terms_not_in = array($visibility_terms['exclude-from-catalog']);

    // Hide out of stock products.
    if ('yes' === get_option('woocommerce_hide_out_of_stock_items') || $new_inputs['hide_out_of_stock']) {
        $terms_not_in[] = $visibility_terms['outofstock'];
    }

    if (!empty($terms_not_in)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field' => 'term_taxonomy_id',
            'terms' => $terms_not_in,
            'operator' => 'NOT IN',
        );
    }
    
    switch ($new_inputs['type']) {
        case 'best_selling':
            $args['ignore_sticky_posts'] = 1;
            
            $args['meta_key']   = 'total_sales';
            $args['order']      = 'DESC';
            $args['orderby']    = 'meta_value_num';
            
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            break;
        
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            $terms_in = isset($visibility_terms['featured']) && !empty($visibility_terms['featured']) ?
                array($visibility_terms['featured']) : null;

            $args['tax_query'][] = $terms_in ? array(
                'taxonomy' => 'product_visibility',
                'field' => 'term_taxonomy_id',
                'terms' => $terms_in,
                'operator' => 'IN',
            ) : array(
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'featured'
            );
            
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            break;
        
        case 'top_rate':
            add_filter('posts_clauses', 'nasa_order_by_rating_post_clauses');
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            break;
        
        case 'recent_review':
            // nasa_order_by_recent_review_post_clauses
            add_filter('posts_clauses', 'nasa_order_by_recent_review_post_clauses');
            $args['meta_query'][] = WC()->query->visibility_meta_query();

            break;
        
        case 'on_sale':
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            $args['post__in'] = array_merge(array(0), wc_get_product_ids_on_sale());
            
            break;
        
        /**
         * Product Deal
         */
        case 'deals':
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            $args['meta_query'][] = array(
                'key' => '_sale_price_dates_from',
                'value' => NASA_TIME_NOW,
                'compare' => '<=',
                'type' => 'numeric'
            );
            
            $args['meta_query'][] = array(
                'key' => '_sale_price_dates_to',
                'value' => NASA_TIME_NOW,
                'compare' => '>',
                'type' => 'numeric'
            );
            
            $args['post_type'] = array('product', 'product_variation');

            if ($new_inputs['deal_time'] > 0) {
                $args['meta_query'][] = array(
                    'key' => '_sale_price_dates_to',
                    'value' => $new_inputs['deal_time'],
                    'compare' => '>=',
                    'type' => 'numeric'
                );
            }
            
            $args['post__in'] = array_merge(array(0), nasa_get_product_deal_ids($new_inputs['cat']));
            
            $args['orderby'] = 'date ID';
            $args['order']   = 'DESC';

            break;
        
        /**
         * Order by stock quantity
         */
        case 'stock_desc':
            $args['ignore_sticky_posts'] = 1;
            
            $args['meta_key']   = '_stock';
            $args['order']      = 'DESC';
            $args['orderby']    = 'meta_value_num';
            
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            $args['meta_query'][] = array(
                'key' => '_manage_stock',
                'value' => 'yes',
                'compare' => '=',
                'type' => 'string'
            );
            
            break;

        case 'recent_product':
        default:
            $args['orderby'] = 'date ID';
            $args['order']   = 'DESC';
            
            break;
    }

    if (!empty($new_inputs['not'])) {
        $args['post__not_in'] = $new_inputs['not'];
        
        if (!empty($args['post__in'])) {
            $args['post__in'] = array_diff($args['post__in'], $args['post__not_in']);
        }
    }

    if ($new_inputs['type'] !== 'deals' && $new_inputs['cat']) {
        // Find by cat id
        if (is_numeric($new_inputs['cat'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => array($new_inputs['cat'])
            );
        }

        // Find by cat array id
        elseif (is_array($new_inputs['cat'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $new_inputs['cat'],
                'operator' => 'IN'
            );
        }

        // Find by Cat slug
        elseif (is_string($new_inputs['cat'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $new_inputs['cat']
            );
        }
    }
    
    /**
     * With Product Tags
     */
    if (isset($new_inputs['ns_tags']) && $new_inputs['ns_tags']) {
        $tags_p = explode(',', $new_inputs['ns_tags']);
        
        if (!empty($tags_p)) {
            foreach ($tags_p as $k => $v) {
                $tag = trim($v);
                
                if ($tag) {
                    $tags_p[$k] = strtolower($tag);
                } else {
                    unset($tags_p[$k]);
                }
            }
            
            if (!empty($tags_p)) {
                $args['tax_query'][] = array(
                    'taxonomy' => 'product_tag',
                    'field' => 'slug',
                    'terms' => $tags_p,
                    'operator' => 'IN'
                );
            }
        }
    }
    
    if ($new_inputs['ns_brand']) {
        // Find by brand id
        if (is_numeric($new_inputs['ns_brand'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_brand',
                'field' => 'id',
                'terms' => array($new_inputs['ns_brand'])
            );
        }

        // Find by Brand array id
        elseif (is_array($new_inputs['ns_brand'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_brand',
                'field' => 'id',
                'terms' => $new_inputs['ns_brand'],
                'operator' => 'IN'
            );
        }

        // Find by Brand slug
        elseif (is_string($new_inputs['ns_brand'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_brand',
                'field' => 'slug',
                'terms' => $new_inputs['ns_brand']
            );
        }
    }
    
    /**
     * Compatible Perfect Brands for WooCommerce Plugin
     */
    if ($new_inputs['pwb_brand']) {
        // Find by brand id
        if (is_numeric($new_inputs['pwb_brand'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'pwb-brand',
                'field' => 'id',
                'terms' => array($new_inputs['pwb_brand'])
            );
        }

        // Find by Brand array id
        elseif (is_array($new_inputs['pwb_brand'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'pwb-brand',
                'field' => 'id',
                'terms' => $new_inputs['pwb_brand'],
                'operator' => 'IN'
            );
        }

        // Find by Brand slug
        elseif (is_string($new_inputs['pwb_brand'])) {
            $args['tax_query'][] = array(
                'taxonomy' => 'pwb-brand',
                'field' => 'slug',
                'terms' => $new_inputs['pwb_brand']
            );
        }
    }
    
    if (empty($args['orderby']) || empty($args['order'])) {
        $ordering_args   = WC()->query->get_catalog_ordering_args();
        $args['orderby'] = empty($args['orderby']) ? $ordering_args['orderby'] : $args['orderby'];
        $args['order']   = empty($args['order']) ? $ordering_args['order'] : $args['order'];
    }

    return new WP_Query(apply_filters('nasa_woocommerce_query_args', $args));
}

/**
 * WooCommerce - Function get Query
 */
function nasa_woocommerce_query($type = '', $post_per_page = -1, $cat = '', $paged = '', $not = array(), $deal_time = null) {
    if (!NASA_WOO_ACTIVED) {
        return array();
    }
    
    $page = $paged == '' ? ($paged = get_query_var('paged') ? (int) get_query_var('paged') : 1) : (int) $paged;
    
    $data = nasa_woocommerce_query_args($type, $post_per_page, $cat, $page, $not, $deal_time);
    remove_filter('posts_clauses', 'nasa_order_by_rating_post_clauses');
    remove_filter('posts_clauses', 'nasa_order_by_recent_review_post_clauses');
    
    return $data;
}

/**
 * Order by rating review
 * 
 * @global type $wpdb
 * @param type $args
 * @return array
 */
function nasa_order_by_rating_post_clauses($args) {
    global $wpdb;

    $args['fields'] .= ', AVG(' . $wpdb->commentmeta . '.meta_value) as average_rating';
    $args['where'] .= ' AND (' . $wpdb->commentmeta . '.meta_key = "rating" OR ' . $wpdb->commentmeta . '.meta_key IS null) AND ' . $wpdb->comments . '.comment_approved=1 ';
    $args['join'] .= ' LEFT OUTER JOIN ' . $wpdb->comments . ' ON(' . $wpdb->posts . '.ID = ' . $wpdb->comments . '.comment_post_ID) LEFT JOIN ' . $wpdb->commentmeta . ' ON(' . $wpdb->comments . '.comment_ID = ' . $wpdb->commentmeta . '.comment_id) ';
    $args['orderby'] = 'average_rating DESC, ' . $wpdb->posts . '.post_date DESC';
    $args['groupby'] = $wpdb->posts . '.ID';

    return $args;
}

/**
 * Order by recent review
 * 
 * @global type $wpdb
 * @param type $args
 * @return array
 */
function nasa_order_by_recent_review_post_clauses($args) {
    global $wpdb;

    $args['where'] .= ' AND ' . $wpdb->comments . '.comment_approved=1 ';
    $args['join'] .= ' LEFT JOIN ' . $wpdb->comments . ' ON(' . $wpdb->posts . '.ID = ' . $wpdb->comments . '.comment_post_ID)';
    $args['orderby'] = $wpdb->comments . '.comment_date DESC, ' . $wpdb->comments . '.comment_post_ID DESC';
    $args['groupby'] = $wpdb->posts . '.ID';

    return $args;
}

/**
 * Build query for Nasa WooCommerce Products
 * 
 * @param type $type
 * @param type $post_per_page
 * @param type $cat
 * @param type $paged
 * @param type $not
 * @param type $deal_time
 * @return type
 */
function nasa_woocommerce_query_args($type = '', $post_per_page = -1, $cat = '', $paged = 1, $not = array(), $deal_time = null) {
    if (!NASA_WOO_ACTIVED) {
        return array();
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish',
        'paged' => $paged
    );

    $args['meta_query'] = array();
    $args['meta_query'][] = WC()->query->stock_status_meta_query();
    $args['tax_query'] = array('relation' => 'AND');
    
    $visibility_terms = wc_get_product_visibility_term_ids();
    $terms_not_in = array($visibility_terms['exclude-from-catalog']);

    // Hide out of stock products.
    if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
        $terms_not_in[] = $visibility_terms['outofstock'];
    }

    if (!empty($terms_not_in)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'product_visibility',
            'field' => 'term_taxonomy_id',
            'terms' => $terms_not_in,
            'operator' => 'NOT IN',
        );
    }
    
    switch ($type) {
        case 'best_selling':
            $args['ignore_sticky_posts'] = 1;
            
            $args['meta_key']   = 'total_sales';
            $args['order']      = 'DESC';
            $args['orderby']    = 'meta_value_num';
            
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            break;
        
        case 'featured_product':
            $args['ignore_sticky_posts'] = 1;
            $terms_in = isset($visibility_terms['featured']) && !empty($visibility_terms['featured']) ?
                array($visibility_terms['featured']) : null;

            $args['tax_query'][] = $terms_in ? array(
                'taxonomy' => 'product_visibility',
                'field' => 'term_taxonomy_id',
                'terms' => $terms_in,
                'operator' => 'IN',
            ) : array(
                'taxonomy' => 'product_visibility',
                'field' => 'name',
                'terms' => 'featured'
            );
            
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            break;
        
        case 'top_rate':
            add_filter('posts_clauses', 'nasa_order_by_rating_post_clauses');
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            break;
        
        case 'recent_review':
            // nasa_order_by_recent_review_post_clauses
            add_filter('posts_clauses', 'nasa_order_by_recent_review_post_clauses');
            $args['meta_query'][] = WC()->query->visibility_meta_query();

            break;
        
        case 'on_sale':
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            $args['post__in'] = array_merge(array(0), wc_get_product_ids_on_sale());
            
            break;
        
        /**
         * Product Deal
         */
        case 'deals':
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            $args['meta_query'][] = array(
                'key' => '_sale_price_dates_from',
                'value' => NASA_TIME_NOW,
                'compare' => '<=',
                'type' => 'numeric'
            );
            
            $args['meta_query'][] = array(
                'key' => '_sale_price_dates_to',
                'value' => NASA_TIME_NOW,
                'compare' => '>',
                'type' => 'numeric'
            );
            
            $args['post_type'] = array('product', 'product_variation');

            if ($deal_time > 0) {
                $args['meta_query'][] = array(
                    'key' => '_sale_price_dates_to',
                    'value' => $deal_time,
                    'compare' => '>=',
                    'type' => 'numeric'
                );
            }
            
            $args['post__in'] = array_merge(array(0), nasa_get_product_deal_ids($cat));
            
            $args['orderby'] = 'date ID';
            $args['order']   = 'DESC';

            break;
        
        /**
         * Order by stock quantity
         */
        case 'stock_desc':
            $args['ignore_sticky_posts'] = 1;
            
            $args['meta_key']   = '_stock';
            $args['order']      = 'DESC';
            $args['orderby']    = 'meta_value_num';
            
            $args['meta_query'][] = WC()->query->visibility_meta_query();
            
            $args['meta_query'][] = array(
                'key' => '_manage_stock',
                'value' => 'yes',
                'compare' => '=',
                'type' => 'string'
            );
            
            break;

        case 'recent_product':
        default:
            $args['orderby'] = 'date ID';
            $args['order']   = 'DESC';
            
            break;
    }

    if (!empty($not)) {
        $args['post__not_in'] = $not;
        
        if (!empty($args['post__in'])) {
            $args['post__in'] = array_diff($args['post__in'], $args['post__not_in']);
        }
    }

    if ($type !== 'deals' && $cat) {
        
        // Find by cat id
        if (is_numeric($cat)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => array($cat)
            );
        }

        // Find by cat array id
        elseif (is_array($cat)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $cat
            );
        }

        // Find by slug
        elseif (is_string($cat)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $cat
            );
        }
    }
    
    if (empty($args['orderby']) || empty($args['order'])) {
        $ordering_args      = WC()->query->get_catalog_ordering_args();
        $args['orderby']    = empty($args['orderby']) ? $ordering_args['orderby'] : $args['orderby'];
        $args['order']      = empty($args['order']) ? $ordering_args['order'] : $args['order'];
    }

    return new WP_Query(apply_filters('nasa_woocommerce_query_args', $args));
}

/**
 * Get List products deal
 * @global type $product
 * @return array
 */
function nasa_get_list_products_deal($key_first = false) {
    if (!function_exists('WC')) {
        return array();
    }
    
    $key = !$key_first ? 'nasa_products_deal_in_admin' : 'nasa_products_deal_in_admin_key';
    
    $list = get_transient($key);

    if (!$list) {
        $list = array();
        
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => apply_filters('nasa_limit_admin_products_deal', 100),
            'post_status' => 'publish',
            'paged' => 1
        );

        $args['tax_query'] = array('relation' => 'AND');
        $args['meta_query'] = array();
        $args['meta_query'][] = WC()->query->stock_status_meta_query();
        $args['meta_query'][] = WC()->query->visibility_meta_query();
        $args['meta_query'][] = array(
            'key' => '_sale_price_dates_from',
            'value' => NASA_TIME_NOW,
            'compare' => '<=',
            'type' => 'numeric'
        );
        $args['meta_query'][] = array(
            'key' => '_sale_price_dates_to',
            'value' => NASA_TIME_NOW,
            'compare' => '>',
            'type' => 'numeric'
        );

        $args['post_type'] = array('product', 'product_variation');

        $args['post__in'] = array_merge(array(0), nasa_get_product_deal_ids());

        /**
         * exclude
         */
        $product_visibility_terms = wc_get_product_visibility_term_ids();
        $arr_not_in = array($product_visibility_terms['exclude-from-catalog']);

        // Hide out of stock products.
        if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
            $arr_not_in[] = $product_visibility_terms['outofstock'];
        }

        if (!empty($arr_not_in)) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field' => 'term_taxonomy_id',
                'terms' => $arr_not_in,
                'operator' => 'NOT IN',
            );
        }

        $args['orderby'] = 'date ID';
        $args['order']   = 'DESC';

        $products = new WP_Query($args);

        if ($products->have_posts()) {
            while ($products->have_posts()) {
                $products->the_post();

                global $product;
                
                if (!$product->is_visible()){
                    continue;
                }
                
                $title = html_entity_decode(get_the_title());
                if (!$key_first) {
                    $list[$title] = $product->get_id();
                } else {
                    $list[$product->get_id()] = $title;
                }
            }
        }
        
        set_transient($key, $list, DAY_IN_SECONDS);
    }

    return $list;
}

/**
 * Get ids include for deal product
 * 
 * @global type $wpdb
 * @param type $cat
 * @return type
 */
function nasa_get_product_deal_ids($cat = null) {
    if (!NASA_WOO_ACTIVED) {
        return null;
    }
    
    $key = 'nasa_products_deal';
    if ($cat) {
        if (is_numeric($cat)) {
            $key .= '_cat_' . $cat;
        }
        
        if (is_array($cat)) {
            $key .= '_cats_' . implode('_', $cat);
        }
        
        if (is_string($cat)) {
            $key .= '_catslug_' . $cat;
        }
    }
    
    $product_ids = get_transient($key);
    
    if (!$product_ids) {
        
        $onsale_ids = array_merge(array(0), wc_get_product_ids_on_sale());
        
        $args = array(
            'post_type'         => array('product', 'product_variation'),
            'numberposts'       => -1,
            'post_status'       => 'publish',
            'fields'            => 'ids'
        );

        $args['tax_query'] = array('relation' => 'AND');

        $args['post__in'] = $onsale_ids;

        // Find by cat id
        if (is_numeric($cat) && $cat) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => array($cat)
            );
        }

        // Find by cat array id
        elseif (is_array($cat) && $cat) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'id',
                'terms' => $cat
            );
        }

        // Find by slug
        elseif (is_string($cat) && $cat) {
            $args['tax_query'][] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $cat
            );
        }
        
        $args['meta_query'][] = WC()->query->visibility_meta_query();
            
        $args['meta_query'][] = array(
            'key' => '_sale_price_dates_from',
            'value' => NASA_TIME_NOW,
            'compare' => '<=',
            'type' => 'numeric'
        );

        $args['meta_query'][] = array(
            'key' => '_sale_price_dates_to',
            'value' => NASA_TIME_NOW,
            'compare' => '>',
            'type' => 'numeric'
        );

        $product_ids = get_posts($args);
        $product_ids_str = $product_ids ? implode(', ', $product_ids) : false;

        if ($product_ids_str) {
            global $wpdb;
            $variation_obj = $wpdb->get_results('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_parent IN (' . $product_ids_str . ')');

            $variation_ids = $variation_obj ? wp_list_pluck($variation_obj, 'ID') : null;

            if ($variation_ids) {
                foreach ($variation_ids as $v_id) {
                    $product_ids[] = (int) $v_id;
                }
            }
        }

        set_transient($key, $product_ids, DAY_IN_SECONDS);
    }
    
    return $product_ids;
}

/**
 * Get product_ids variation
 */
function nasa_get_deal_product_variation_ids() {
    $key = 'nasa_variation_products_deal';
    $product_ids = get_transient($key);
    
    if (!$product_ids) {
        $v_args = array(
            'post_type'         => 'product_variation',
            'numberposts'       => -1,
            'post_status'       => 'publish',
            'fields'            => 'ids'
        );

        $v_args['tax_query'] = array('relation' => 'AND');
        $v_args['post__in'] = array_merge(array(0), wc_get_product_ids_on_sale());
        
        $v_args['meta_query'][] = WC()->query->visibility_meta_query();

        $v_args['meta_query'][] = array(
            'key' => '_sale_price_dates_from',
            'value' => NASA_TIME_NOW,
            'compare' => '<=',
            'type' => 'numeric'
        );

        $v_args['meta_query'][] = array(
            'key' => '_sale_price_dates_to',
            'value' => NASA_TIME_NOW,
            'compare' => '>',
            'type' => 'numeric'
        );

        $v_ids = get_posts($v_args);
        $product_ids = array(0);
        if ($v_ids) {
            foreach ($v_ids as $v_id) {
                $product_ids[] = (int) $v_id;
            }
        }
        
        set_transient($key, $product_ids, DAY_IN_SECONDS);
    }
    
    return empty($product_ids) ? null : $product_ids;
}

/**
 * Get Products by array id
 * 
 * @param type $ids
 * @return \WP_Query
 */
function nasa_get_products_by_ids($ids = array()) {
    if (!NASA_WOO_ACTIVED || empty($ids)) {
        return null;
    }
    
    $args = array(
        'post_type' => 'product',
        'post__in' => $ids,
        'posts_per_page' => count($ids),
        'post_status' => 'publish',
        'paged' => 1
    );
    
    return new WP_Query($args);
}

/**
 * Recommended product
 * @param type $cat
 */
add_action('nasa_recommend_product', 'nasa_get_recommend_product', 10, 1);
function nasa_get_recommend_product() {
    global $nasa_opt, $wp_query;

    if (!NASA_WOO_ACTIVED || (isset($nasa_opt['enable_recommend_product']) && $nasa_opt['enable_recommend_product'] != '1')) {
        return '';
    }
    
    /**
     * get Featured from Category
     */
    $cat = 0;
    $nasa_obj = $wp_query->get_queried_object();
    if (isset($nasa_obj->term_id) && isset($nasa_obj->taxonomy) && $nasa_obj->taxonomy == 'product_cat') {
        $cat = (int) $nasa_obj->term_id;
    }

    $columns_number = isset($nasa_opt['recommend_columns_desk']) ? (int) $nasa_opt['recommend_columns_desk'] : 5;

    $columns_number_small = isset($nasa_opt['recommend_columns_small']) ? $nasa_opt['recommend_columns_small'] : 2;
    $columns_number_small_slider = $columns_number_small == '1.5-cols' ? '1.5' : (int) $columns_number_small;
    
    $columns_number_tablet = isset($nasa_opt['recommend_columns_tablet']) ? (int) $nasa_opt['recommend_columns_tablet'] : 3;

    $number = (isset($nasa_opt['recommend_product_limit']) && ((int) $nasa_opt['recommend_product_limit'] >= $columns_number)) ? (int) $nasa_opt['recommend_product_limit'] : 9;
    
    $auto_slide = isset($nasa_opt['recommend_slide_auto']) && $nasa_opt['recommend_slide_auto'] ? 'true' : 'false';

    $loop_slide = isset($nasa_opt['infinite_slide']) && $nasa_opt['infinite_slide'] ? 'true' : 'false';

    $loop = nasa_woo_query(array(
        'type' => 'featured_product',
        'post_per_page' => $number,
        'paged' => 1,
        'cat' => (int) $cat ? (int) $cat : null
    ));

    $option_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
    
    $shop_layout = !$option_mobile && isset($nasa_opt['option_change_shop_layout']) && $nasa_opt['option_change_shop_layout'] === 'shop-background-color' ? 'row'  : '';

    if ($loop->found_posts) {
        $class_wrap = 'margin-bottom-50 mobile-margin-bottom-20 nasa-recommend-product';
        if (isset($nasa_opt['recommend_product_position']) && $nasa_opt['recommend_product_position'] == 'bot') :
            $class_wrap .= ' large-12 columns';
        endif;
        ?>
        <div class="<?php echo esc_attr($class_wrap); ?>">
            <div class="woocommerce <?php echo esc_attr($shop_layout); ?>">
                <?php
                $type = null;
                $height_auto = 'false';
                $arrows = 1;
                $title_shortcode = esc_html__('Recommended Products', 'nasa-core');

                $nasa_args = array(
                    'loop' => $loop,
                    'cat' => $cat,
                    'columns_number' => $columns_number,
                    'columns_number_small_slider' => $columns_number_small_slider,
                    'columns_number_tablet' => $columns_number_tablet,
                    'number' => $number,
                    'auto_slide' => $auto_slide,
                    'loop_slide' => $loop_slide,
                    'type' => $type,
                    'height_auto' => $height_auto,
                    'arrows' => $arrows,
                    'title_shortcode' => $title_shortcode,
                    'title_align' => 'center',
                    'nav_radius' => true,
                    'pos_nav' => 'both',
                    'nasa_opt' => $nasa_opt
                );

                nasa_template('products/nasa_products/carousel.php', $nasa_args);
                ?>
            </div>
            <?php
            echo isset($nasa_opt['recommend_product_position']) && $nasa_opt['recommend_product_position'] == 'top' ? '<hr class="nasa-separator" />' : '';
            ?>
        </div>
        <?php
    }
}

/**
 * Add our Recommend Products to your Order
 */
add_action('ns_before_place_order_payment', 'nasa_recommended_product_your_order');
function nasa_recommended_product_your_order() {
    global $nasa_opt;
    
    $enable_carousel_pro_ckout = (isset($nasa_opt['enable_carousel_pro_ckout']) && (int) $nasa_opt['enable_carousel_pro_ckout']) ? true : false;

    if (!$enable_carousel_pro_ckout) {
        return;
    }
    
    $type_carousel_pro_ckout = !isset($nasa_opt['type_carousel_pro_ckout']) || $nasa_opt['type_carousel_pro_ckout'] !='' ? $nasa_opt['type_carousel_pro_ckout'] : 'best_selling';

    $limit = isset($nasa_opt['limit_pro_ckout']) && (int) $nasa_opt['limit_pro_ckout'] ? (int) $nasa_opt['limit_pro_ckout'] : 2;

    $loop = nasa_woo_query(array(
        'type' => $type_carousel_pro_ckout,
        'post_per_page' => $limit,
        'paged' => 1,
        'hide_out_of_stock' => true
    ));

    $_total = $loop->post_count;

    if (!$_total) {
        return;
    }

    $nasa_args = array(
        'number' => '2',
        'cat' => '',
        'ns_brand' => '',
        'pwb_brand' => '',
        'type' => 'recent_product',
        'style' => 'Slider',
        'style_viewmore' => '1',
        'style_row' => 'simple',
        'title_shortcode' => '',
        'pos_nav' => 'top',
        'title_align' => 'left',
        'arrows' => 1,
        'dots' => 'false',
        'auto_slide' => 'true',
        'loop_slide' => 'true',
        'auto_delay_time' => '6',
        'columns_number' => '1',
        'columns_number_small' => '1',
        'columns_number_small_slider' => '1',
        'columns_number_tablet' => '1',
        'not_in' => '',
        'el_class' => '',
        'is_deals' => 'true',
        '_total' => $_total,
        'loop' => $loop,
        'layout_buttons_class' => 'nasa-modern-1',
    );

    ?>
    <div class="ns_carousel_pro_checkout hidden-tag">
        <h3 class="nasa-box-heading">
            <?php echo esc_html__('Other Customers Also Bought', 'nasa-core') ;?>
        </h3>
        <?php nasa_template('products/nasa_products/carousel.php', $nasa_args); ?>
    </div>
    <?php
}

/**
 * Get product Deal by id
 * 
 * @param type $id
 * @return type
 */
function nasa_get_product_deal($id = null) {
    if (!(int) $id || !NASA_WOO_ACTIVED) {
        return null;
    }

    $product = wc_get_product((int) $id);

    if ($product) {
        $time_sale = get_post_meta((int) $id, '_sale_price_dates_to', true);
        $time_from = get_post_meta((int) $id, '_sale_price_dates_from', true);

        if ($time_sale > NASA_TIME_NOW && (!$time_from || $time_from < NASA_TIME_NOW)) {
            $product->time_sale = $time_sale;
            
            return $product;
        }
    }

    return null;
}

/**
 * Get products in grid
 * 
 * @param type $notid
 * @param type $catIds
 * @param type $type
 * @param type $limit
 * @return type
 */
function nasa_get_products_grid($notid = null, $catIds = null, $type = 'best_selling', $limit = 6) {
    $notIn = $notid ? array($notid) : array();
    
    return nasa_woocommerce_query($type, $limit, $catIds, 1, $notIn);
}

/**
 * Set cookie products viewed
 */
remove_action('template_redirect', 'wc_track_product_view', 25);
// add_action('template_redirect', 'nasa_set_products_viewed', 20);
function nasa_set_products_viewed() {
    global $nasa_opt;

    if (!NASA_WOO_ACTIVED || !is_singular('product') || (isset($nasa_opt['enable-viewed']) && !$nasa_opt['enable-viewed'])) {
        return;
    }

    global $post;

    $product_id = isset($post->ID) ? (int) $post->ID : 0;
    
    if ($product_id) {
        $limit = !isset($nasa_opt['limit_product_viewed']) || !(int) $nasa_opt['limit_product_viewed'] ?
            12 : (int) $nasa_opt['limit_product_viewed'];

        $list_viewed = !empty($_COOKIE[NASA_COOKIE_VIEWED]) ? explode('|', $_COOKIE[NASA_COOKIE_VIEWED]) : array();
        if (!in_array((int) $product_id, $list_viewed)) {
            $new_array = array(0 => $product_id);
            
            for ($i = 1; $i < $limit; $i++) {
                if (isset($list_viewed[$i-1])) {
                    $new_array[$i] = $list_viewed[$i-1];
                }
            }
            
            $new_array_str = !empty($new_array) ? implode('|', $new_array) : '';
            setcookie(NASA_COOKIE_VIEWED, $new_array_str, 0, COOKIEPATH, COOKIE_DOMAIN, false, false);
        }
    }
}

/**
 * Check category products page
 */
add_action('template_redirect', 'nasa_check_category_product_page');
if (!function_exists('nasa_check_category_product_page')) :
    function nasa_check_category_product_page() {
        if (NASA_WOO_ACTIVED && is_product_category()) {
            add_action('nasa_after_breadcrumb', 'nasa_cat_after_breadcrumb');
        }
    }
endif;

/**
 * After Breadcrumb for category Products
 */
if (!function_exists('nasa_cat_after_breadcrumb')) :
    function nasa_cat_after_breadcrumb() {
        global $wp_query;
            
        $current_cat = $wp_query->get_queried_object();
        
        if (!isset($current_cat->term_id) || !$current_cat->term_id) {
            return;
        }

        $brdc_blk = get_term_meta($current_cat->term_id, 'cat_bread_after', true);
        
        if ($brdc_blk) {
            $do_content = nasa_get_block($brdc_blk);
            
            if (trim($do_content) != '') {
                echo '<div class="nasa-archive-after-breadcrumb large-12 columns">';
                echo $do_content;
                echo '</div>';
            }
        }
    }
endif;

/**
 * set nasa_opt - Single Product page
 */
add_action('template_redirect', 'nasa_single_product_opts', 999);
function nasa_single_product_opts() {
    if (!NASA_WOO_ACTIVED || !is_product()) {
        return;
    }
    
    global $nasa_opt, $post;
    
    if (!isset($post->ID)) {
        return;
    }
    
    $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
    $mobile_app = ($in_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app') ? true : false;
    
    $product_id = $post->ID;
    $root_cat_id = nasa_root_term_id();
    
    $layouts_role = array('classic', 'new', 'new-2', 'new-3', 'full', 'modern-1', 'modern-2', 'modern-3', 'modern-4');
    $sidebars_role = array('left', 'right', 'no');
    
    /**
     * Layout: New | Classic
     */
    $nasa_opt['product_detail_layout'] = isset($nasa_opt['product_detail_layout']) && in_array($nasa_opt['product_detail_layout'], $layouts_role) ? $nasa_opt['product_detail_layout'] : 'new';

    $nasa_opt['product_thumbs_style'] = isset($nasa_opt['product_thumbs_style']) && $nasa_opt['product_thumbs_style'] == 'hoz' ? $nasa_opt['product_thumbs_style'] : 'ver';
    
    /**
     * Image Layout Style
     */
    $image_layout = 'single';
    $image_style = 'slide';

    if ($nasa_opt['product_detail_layout'] == 'new') {
        $image_layout = (!isset($nasa_opt['product_image_layout']) || $nasa_opt['product_image_layout'] == 'double') ? 'double' : 'single';
        $image_style = (!isset($nasa_opt['product_image_style']) || $nasa_opt['product_image_style'] == 'slide') ? 'slide' : 'scroll';
    }

    if ($nasa_opt['product_detail_layout'] == 'new-2') {
        $image_layout = 'grid-2';
        $image_style = 'grid-2';
    }

    $nasa_opt['product_image_layout'] = $image_layout;
    $nasa_opt['product_image_style'] = $image_style;
    
    /**
     * Sidebar Position
     */
    $single_sidebar = nasa_get_product_meta_value($product_id, 'nasa_sidebar');
    if ($single_sidebar) {
        if (in_array($single_sidebar, $sidebars_role)) {
            $nasa_opt['product_sidebar'] = $single_sidebar;
        }
    } elseif ($root_cat_id) {
        $single_sidebar = get_term_meta($root_cat_id, 'single_product_sidebar', true);

        if (in_array($single_sidebar, $sidebars_role)) {
            $nasa_opt['product_sidebar'] = $single_sidebar;
        }
    }
    
    /**
     * Product Layout
     */
    $single_layout = $mobile_app ? 'classic' : nasa_get_product_meta_value($product_id, 'nasa_layout');
    
    if ($single_layout) {
        if (in_array($single_layout, $layouts_role)) {
            $nasa_opt['product_detail_layout'] = $single_layout;
        }

        if ($single_layout == 'new') {
            $single_imageLayouts = nasa_get_product_meta_value($product_id, 'nasa_image_layout');
            $single_thumbStyle = nasa_get_product_meta_value($product_id, 'nasa_thumb_style');

            $nasa_opt['product_image_layout'] = $single_imageLayouts ? $single_imageLayouts : $nasa_opt['product_image_layout'];

            $single_imageStyle = nasa_get_product_meta_value($product_id, 'nasa_image_style');
            
            $nasa_opt['product_image_style'] = $single_imageStyle ? $single_imageStyle : $nasa_opt['product_image_style'];

            $nasa_opt['product_thumbs_style'] = $single_thumbStyle &&  $nasa_opt['product_image_style'] === 'slide' ? $single_thumbStyle : $nasa_opt['product_thumbs_style'];

        }

        if ($single_layout == 'new-2') {
            $nasa_opt['product_image_layout'] = 'grid-2';
            $nasa_opt['product_image_style'] = 'grid-2';
        }

        if (in_array($single_layout, array('classic', 'modern-2', 'modern-3'))) {
            $single_thumbStyle = nasa_get_product_meta_value($product_id, 'nasa_thumb_style');
            
            $nasa_opt['product_image_style'] = 'slide';
            $nasa_opt['product_thumbs_style'] = $single_thumbStyle ? $single_thumbStyle : $nasa_opt['product_thumbs_style'];
        }
        
        if ($single_layout == 'full') {
            $nasa_opt['product_image_style'] = 'slide';
            
            $half_item = nasa_get_product_meta_value($product_id, 'nasa_half_full_slide');
            $nasa_opt['half_full_slide'] = $half_item;
            
            $info_columns = nasa_get_product_meta_value($product_id, 'nasa_full_info_col');
            $nasa_opt['full_info_col'] = $info_columns;
        }
        
        if (in_array($single_layout, array('modern-2', 'modern-3','modern-4','new-3'))) {
            $_product_layout_bg = nasa_get_product_meta_value($product_id, 'nasa_layout_bg');
            if ($_product_layout_bg) {
                $nasa_opt['sp_bgl'] = $_product_layout_bg;
                
                add_action('wp_enqueue_scripts', 'nasa_single_product_css_modern', 1000);
            }
        }
        
        if (in_array($single_layout, array('modern-1', 'modern-2', 'modern-3', 'modern-4', 'new-3'))) {
            $nasa_opt['product_image_style'] = 'slide';
        }

        if (in_array($single_layout, array('modern-1', 'modern-2', 'modern-3', 'modern-4', 'classic','new'))) {
            $infinite_slide = nasa_get_product_meta_value($product_id, 'nasa_infinite_slide');

            $nasa_opt['product_slide_loop'] = $infinite_slide;
        }
    }

    /**
     * Override with root Category - Product Layout
     */
    elseif ($root_cat_id) {
        /**
         * Sidebar Layout
         */
        $_product_layout = $mobile_app ? 'classic' : get_term_meta($root_cat_id, 'single_product_layout', true);

        if (in_array($_product_layout, $layouts_role)) {
            $nasa_opt['product_detail_layout'] = $_product_layout;
        }

        if ($_product_layout == 'new') {
            $product_image_layout = get_term_meta($root_cat_id, 'single_product_image_layout', true);
            $nasa_opt['product_image_layout'] = $product_image_layout ? $product_image_layout : $nasa_opt['product_image_layout'];

            $product_image_style = get_term_meta($root_cat_id, 'single_product_image_style', true);
            $nasa_opt['product_image_style'] = $product_image_style ? $product_image_style : $nasa_opt['product_image_style'];

            $product_thumbs_style = get_term_meta($root_cat_id, 'single_product_thumbs_style', true);
            $nasa_opt['product_thumbs_style'] = $product_thumbs_style &&  $nasa_opt['product_image_style'] === 'slide' ? $product_thumbs_style : $nasa_opt['product_thumbs_style'];
        }

        if ($_product_layout == 'new-2') {
            $nasa_opt['product_image_layout'] = 'grid-2';
            $nasa_opt['product_image_style'] = 'grid-2';
        }

        if (in_array($_product_layout, array('classic', 'modern-2', 'modern-3'))) {
            $nasa_opt['product_image_style'] = 'slide';

            $product_thumbs_style = get_term_meta($root_cat_id, 'single_product_thumbs_style', true);
            
            $nasa_opt['product_thumbs_style'] = $product_thumbs_style ? $product_thumbs_style : $nasa_opt['product_thumbs_style'];
        }
        
        if ($_product_layout == 'full') {
            $nasa_opt['product_image_style'] = 'slide';
            
            $half_item = get_term_meta($root_cat_id, 'single_product_half_full_slide', true);
            $nasa_opt['half_full_slide'] = $half_item;
            
            $info_columns = get_term_meta($root_cat_id, 'single_product_full_info_col', true);
            $nasa_opt['full_info_col'] = $info_columns;
        }
        
        if (in_array($_product_layout, array('modern-2', 'modern-3','modern-4','new-3'))) {
            $_product_layout_bg = get_term_meta($root_cat_id, 'single_product_layout_bg', true);
            if ($_product_layout_bg) {
                $nasa_opt['sp_bgl'] = $_product_layout_bg;
                
                add_action('wp_enqueue_scripts', 'nasa_single_product_css_modern', 1000);
            }
        }
        
        if (in_array($_product_layout, array('modern-1', 'modern-2', 'modern-3','modern-4', 'new-3'))) {
            $nasa_opt['product_image_style'] = 'slide';
        }
    }
    
    /**
     * Single Product Info Columns
     */
    if (isset($nasa_opt['product_detail_layout'])) {
        
        /**
         * Slide Full-width 2 columns
         */
        if (
            $nasa_opt['product_detail_layout'] == 'full' &&
            isset($nasa_opt['full_info_col']) &&
            $nasa_opt['full_info_col'] == 2
        ) {
            add_action('woocommerce_single_product_summary', 'nasa_single_product_full_open_wrap', 7);
            add_action('woocommerce_single_product_summary', 'nasa_single_product_tag_close', 9999);

            add_action('woocommerce_single_product_summary', 'nasa_single_product_full_open_col', 8);
            add_action('woocommerce_single_product_summary', 'nasa_single_product_tag_close', 999);

            add_action('woocommerce_single_product_summary', 'nasa_single_product_full_open_col', 1005);
            add_action('woocommerce_single_product_summary', 'nasa_single_product_tag_close', 9998);

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 1010);

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 1020);

            remove_action('woocommerce_single_product_summary', 'nasa_after_add_to_cart_form', 50);
            add_action('woocommerce_single_product_summary', 'nasa_after_add_to_cart_form', 1030);
        }
        
        /**
         * Slide | Info | Cart form => Layout Modern #1
         */
        if ($nasa_opt['product_detail_layout'] == 'modern-1') {
            add_action('woocommerce_single_product_summary', 'nasa_single_product_md_1_open_wrap', 1);
            add_action('woocommerce_single_product_summary', 'nasa_single_product_tag_close', 9999);

            add_action('woocommerce_single_product_summary', 'nasa_single_product_md_1_open_col', 2);
            add_action('woocommerce_single_product_summary', 'nasa_single_product_tag_close', 999);

            add_action('woocommerce_single_product_summary', 'nasa_single_product_md_1_open_col', 1005);
            add_action('woocommerce_single_product_summary', 'nasa_single_product_tag_close', 9998);

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 1010);
            
            // Deal time for Single product
            if (!isset($nasa_opt['single-product-deal']) || $nasa_opt['single-product-deal']) {
                remove_action('woocommerce_single_product_summary', 'elessi_deal_time_single', 29);
                add_action('woocommerce_single_product_summary', 'elessi_deal_time_single', 1030);
            }

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 1040);
        }

        if ($nasa_opt['product_detail_layout'] == 'modern-4') {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);
            add_action('woocommerce_before_single_product_summary_modern_4', 'woocommerce_template_single_price', 20);

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
            add_action('woocommerce_before_single_product_summary_modern_4', 'woocommerce_template_single_title', 5 );

            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 15 );
            add_action('woocommerce_before_single_product_summary_modern_4', 'woocommerce_template_single_rating', 15 );

            remove_action('woocommerce_single_product_summary', 'nasa_single_attributes_brands', 16);
            add_action('woocommerce_before_single_product_summary_modern_4', 'nasa_single_attributes_brands', 16);

            if(isset($nasa_opt['breadcrumb_row']) && $nasa_opt['breadcrumb_row'] == 'multi') {
                remove_action('woocommerce_single_product_summary', 'elessi_next_prev_single_product', 6);
                add_action('woocommerce_before_single_product_summary_modern_4', 'elessi_next_prev_single_product', 1);
            }
        }

        if ($nasa_opt['product_detail_layout'] == 'new-3') {
            remove_action('nasa_single_product_layout', 'woocommerce_upsell_display', 15);
            remove_action('nasa_single_product_layout', 'woocommerce_output_related_products', 20);

            add_action('nasa_after_single_product_layout3_summary', 'woocommerce_upsell_display', 10);
            if (!isset($nasa_opt['relate_product']) || $nasa_opt['relate_product']) {
                add_action('nasa_after_single_product_layout3_summary', 'woocommerce_output_related_products', 15);
            }
        }
    }
    
    /**
     * Override in Single Product Tab style
     */
    $tab_style = $mobile_app ? 'ver-2' : nasa_get_product_meta_value($product_id, 'nasa_tab_style');
    if ($tab_style) {
        $nasa_opt['tab_style_info'] = $tab_style;
    }

    /**
     * Override in Root Category - Single Product Tab style
     */
    else {
        if ($root_cat_id) {
            $tab_style = $mobile_app ? 'small-accordion' : get_term_meta($root_cat_id, 'single_product_tabs_style', true);
            if ($tab_style) {
                $nasa_opt['tab_style_info'] = $tab_style;
            }
        }
    }
    
    /**
     * Single Product WooCommerce Tabs - Actions
     */
    if (isset($nasa_opt['tab_style_info']) && $nasa_opt['tab_style_info'] == 'small-accordion') {
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
        add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 99990);
        
        $pmeta = isset($nasa_opt['pmeta_enb']) && !$nasa_opt['pmeta_enb'] ? false : true;
        
        if ($pmeta && (!isset($nasa_opt['pmeta_info']) || $nasa_opt['pmeta_info'] !== 'df')) {
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 99999);
            
            if (function_exists('elessi_clearboth')) {
                remove_action('woocommerce_after_single_product_summary', 'elessi_clearboth', 11);
            }

            if (function_exists('elessi_open_wrap_12_cols')) {
                remove_action('woocommerce_after_single_product_summary', 'elessi_open_wrap_12_cols', 11);
            }

            remove_action('woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 11);

            if (function_exists('elessi_open_wrap_12_cols')) {
                remove_action('woocommerce_after_single_product_summary', 'elessi_close_wrap_12_cols', 11);
            }
        }
    }
    
    $GLOBALS['nasa_opt'] = $nasa_opt;
}

function nasa_single_product_css_modern() {
    if (!wp_style_is('elessi-style-dynamic')) {
        return;
    }
    
    global $nasa_opt;
    
    if (isset($nasa_opt['sp_bgl']) && $nasa_opt['sp_bgl']) {
        $style = '.single-product.nasa-spl-modern-2 .site-header, .single-product.nasa-spl-modern-3 .site-header, .single-product.nasa-spl-modern-4 .site-header, .single-product.nasa-spl-modern-2 .nasa-breadcrumb, .single-product.nasa-spl-modern-3 .nasa-breadcrumb, .single-product.nasa-spl-modern-4 .nasa-breadcrumb {background-color: ' . esc_attr($nasa_opt['sp_bgl']) . ';}';

        $style .=   '@media only screen and (min-width: 768px) {
                        body .nasa-product-details-page.nasa-layout-new-3 .nasa-product-details-wrap:not(.is-tab-small-accordion) {
                            background-color:' . esc_attr($nasa_opt['sp_bgl']) . ';
                            -webkit-box-shadow: 0 0 0 100vmax ' . esc_attr($nasa_opt['sp_bgl']) . ';
                            -moz-box-shadow: 0 0 0 100vmax ' . esc_attr($nasa_opt['sp_bgl']) . ';
                            box-shadow: 0 0 0 100vmax ' . esc_attr($nasa_opt['sp_bgl']) . ';
                        }
                    }';
        wp_add_inline_style('elessi-style-dynamic', $style);
    }
}

function nasa_single_product_full_open_wrap() {
    echo '<div class="nasa-wrap-flex nasa-flex text-left rtl-text-right jst">';
}

function nasa_single_product_full_open_col() {
    echo '<div class="nasa-col-flex">';
}

function nasa_single_product_md_1_open_wrap() {
    echo '<div class="nasa-wrap-flex nasa-flex info-modern-1 text-left rtl-text-right jst align-start">';
}

function nasa_single_product_md_1_open_col() {
    echo '<div class="nasa-col-flex nasa-relative">';
}

function nasa_single_product_tag_close() {
    echo '</div>';
}

/**
 * Get cookie products viewed
 */
function nasa_get_products_viewed() {
    global $nasa_opt;
    $query = null;

    if (!NASA_WOO_ACTIVED || (isset($nasa_opt['enable-viewed']) && !$nasa_opt['enable-viewed'])) {
        return $query;
    }

    $viewed_products = !empty($_COOKIE[NASA_COOKIE_VIEWED]) ? explode('|', $_COOKIE[NASA_COOKIE_VIEWED]) : array();
    if (!empty($viewed_products)) {

        $limit = !isset($nasa_opt['limit_product_viewed']) || !(int) $nasa_opt['limit_product_viewed'] ? 12 : (int) $nasa_opt['limit_product_viewed'];

        $query_args = array(
            'posts_per_page' => $limit,
            'no_found_rows' => 1,
            'post_status' => 'publish',
            'post_type' => 'product',
            'post__in' => $viewed_products,
            'orderby' => 'post__in',
        );

        if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'outofstock',
                    'operator' => 'NOT IN',
                ),
            );
        }

        $query = new WP_Query($query_args);
    }

    return $query;
}

/**
 * Static Viewed Sidebar
 */
add_action('nasa_static_content', 'nasa_static_viewed_sidebar', 15);
function nasa_static_viewed_sidebar() {
    global $nasa_opt;
    
    if (!NASA_WOO_ACTIVED || (isset($nasa_opt['enable-viewed']) && !$nasa_opt['enable-viewed'])) {
        return;
    }
    
    /**
     * Turn off Viewed Canvas
     */
    if ((isset($nasa_opt['viewed_canvas']) && !$nasa_opt['viewed_canvas'])) {
        return;
    }
    
    $nasa_viewed_style = 'nasa-static-sidebar ';
    $nasa_viewed_style .= isset($nasa_opt['style-viewed']) ? $nasa_opt['style-viewed'] : 'style-1'; ?>
    
    <!-- viewed product -->
    <div id="nasa-viewed-sidebar" class="<?php echo esc_attr($nasa_viewed_style); ?>">
        <div class="viewed-close nasa-sidebar-close">
            <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'nasa-core'); ?>" rel="nofollow">
                <svg width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg>
            </a>
            
            <span class="nasa-tit-viewed nasa-sidebar-tit text-center">
                <?php echo esc_html__("Recently Viewed", 'nasa-core'); ?>
            </span>
        </div>
        
        <div id="nasa-viewed-sidebar-content" class="nasa-absolute">
            <div class="nasa-loader"></div>
        </div>
    </div>
    
    <?php
}

/**
 * Viewed icon button
 */
add_action('nasa_static_group_btns', 'nasa_static_viewed_btns', 15);
function nasa_static_viewed_btns() {
    global $nasa_opt;
    if (!NASA_WOO_ACTIVED || (isset($nasa_opt['enable-viewed']) && !$nasa_opt['enable-viewed'])) {
        return;
    }
    
    /**
     * Turn off Viewed Canvas
     */
    if ((isset($nasa_opt['viewed_canvas']) && !$nasa_opt['viewed_canvas'])) {
        return;
    }
    ?>
    
    <?php
    $nasa_viewed_icon = 'nasa-tip nasa-tip-left style-1';
    // $nasa_viewed_icon .= isset($nasa_opt['style-viewed-icon']) ? esc_attr($nasa_opt['style-viewed-icon']) : 'style-1';
    ?>
    <a id="nasa-init-viewed" class="<?php echo esc_attr($nasa_viewed_icon); ?>" href="javascript:void(0);" data-tip="<?php esc_attr_e('Recently Viewed', 'nasa-core'); ?>" title="<?php esc_attr_e('Recently Viewed', 'nasa-core'); ?>" rel="nofollow">
        <svg width="26" height="26" viewBox="0 0 32 32" fill="currentColor">
            <path d="M16 3.205c-7.066 0-12.795 5.729-12.795 12.795s5.729 12.795 12.795 12.795 12.795-5.729 12.795-12.795c0-7.066-5.729-12.795-12.795-12.795zM16 27.729c-6.467 0-11.729-5.261-11.729-11.729s5.261-11.729 11.729-11.729 11.729 5.261 11.729 11.729c0 6.467-5.261 11.729-11.729 11.729z"/>
            <path d="M16 17.066h-6.398v1.066h7.464v-10.619h-1.066z"/>
        </svg>
    </a>
    <?php
}

/**
 * Config info - Nasa core
 */
add_action('nasa_static_content', 'nasa_static_config_info', 21);
function nasa_static_config_info() {
    global $nasa_opt;
    
    echo '<div class="hidden-tag ns-wrap-cfg">';
    
    if (NASA_WOO_ACTIVED && is_product()) {
        global $product;
        
        echo '<div id="ns-viewed-wrap-cfg" class="hidden-tag">';
        
        echo '<input type="hidden" name="ns-viewed-cookie-name" value="' . esc_attr(NASA_COOKIE_VIEWED) . '" />';
        echo '<input type="hidden" name="ns-viewed-id" value="' . esc_attr($product->get_id()) . '" />';
        
        $limit = !isset($nasa_opt['limit_product_viewed']) || !(int) $nasa_opt['limit_product_viewed'] ?
            12 : (int) $nasa_opt['limit_product_viewed'];
        echo '<input type="hidden" name="ns-viewed-limit" value="' . esc_attr($limit) . '" />';
        
        echo '</div>';
    }
    
    echo '<input type="hidden" name="ns-cookie-path" value="' . esc_attr(COOKIEPATH) . '" />';
    echo '<input type="hidden" name="ns-cookie-domain" value="' . esc_attr(COOKIE_DOMAIN) . '" />';
    
    echo '</div>';
}

/**
 * Get product meta value
 */
function nasa_get_product_meta_value($product_id = 0, $field = null) {
    $meta_value = '';
    
    if (!$product_id) {
        return $meta_value;
    }
    
    global $nasa_product_meta;
    
    if (isset($nasa_product_meta[$product_id])) {
        $meta_value = $nasa_product_meta[$product_id];
    } else {
        $get_meta_value = get_post_meta($product_id, 'wc_productdata_options', true);
        $meta_value = isset($get_meta_value[0]) ? $get_meta_value[0] : $get_meta_value;
        
        $nasa_product_meta = !isset($nasa_product_meta) || empty($nasa_product_meta) ? array() : $nasa_product_meta;
        $nasa_product_meta[$product_id] = $meta_value;
        
        $GLOBALS['nasa_product_meta'] = $nasa_product_meta;
    }
    
    if (is_array($meta_value) && $field) {
        return isset($meta_value[$field]) ? $meta_value[$field] : '';
    }

    return $meta_value;
}

/**
 * Get variation meta value
 */
function nasa_get_variation_meta_value($variation_id = 0, $field = null) {
    $meta_value = '';
    
    if (!$variation_id) {
        return $meta_value;
    }
    
    global $nasa_variation_meta;
    
    if (isset($nasa_variation_meta[$variation_id])) {
        $meta_value = $nasa_variation_meta[$variation_id];
    } else {
        $meta_value = get_post_meta($variation_id, 'wc_variation_custom_fields', true);
        
        $nasa_variation_meta = !$nasa_variation_meta ? array() : $nasa_variation_meta;
        $nasa_variation_meta[$variation_id] = $meta_value;
        
        $GLOBALS['nasa_variation_meta'] = $nasa_variation_meta;
    }
    
    if (is_array($meta_value) && $field) {
        return isset($meta_value[$field]) ? $meta_value[$field] : '';
    }

    return $meta_value;
}

/**
 * variation gallery images
 */
add_filter('woocommerce_available_variation', 'nasa_variation_gallery_images');
function nasa_variation_gallery_images($variation) {
    global $nasa_opt;
    
    if (!isset($nasa_opt['gallery_images_variation']) || $nasa_opt['gallery_images_variation']) {
        if (!isset($variation['nasa_gallery_variation'])) {
            $variation['nasa_gallery_variation'] = array();
            // $variation['nasa_variation_back_img'] = '';
            $gallery = get_post_meta($variation['variation_id'], 'nasa_variation_gallery_images', true);

            if ($gallery) {
                $variation['nasa_gallery_variation'] = $gallery;
                
                $gallery_ids = explode(',', $gallery);
                
                $image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
                
                if ($gallery_ids) {
                    $variation['nasa_variation_back_gallery'] = array();
                    
                    foreach ($gallery_ids as $gallery_id) {
                        $img = wp_get_attachment_image_src($gallery_id, $image_size);

                        if ($img) {
                            $variation['nasa_variation_back_gallery'][] = array(
                                'src' => $img[0],
                                'w' => $img[1],
                                'h' => $img[2]
                            );

                            if (!isset($variation['nasa_variation_back_img'])) {
                                $variation['nasa_variation_back_img'] = $img[0];
                            }
                        }
                    }
                }
            }
        }
    }
    
    return $variation;
}

/**
 * Enable Gallery images variation in front-end
 */
add_action('woocommerce_after_add_to_cart_button', 'nasa_enable_variation_gallery_images', 30);
function nasa_enable_variation_gallery_images() {
    global $product, $nasa_opt;
    
    if (isset($nasa_opt['gallery_images_variation']) && !$nasa_opt['gallery_images_variation']) {
        return;
    }

    $productType = $product->get_type();
    if ($productType == 'variable' || $productType == 'variation') {
        $main_product = ($productType == 'variation') ?
            wc_get_product(wp_get_post_parent_id($product->get_id())) : $product;

        $variations = $main_product ? $main_product->get_available_variations() : null;
        if (!empty($variations)) {
            foreach ($variations as $vari) {
                if (isset($vari['nasa_gallery_variation']) && !empty($vari['nasa_gallery_variation'])) {
                    echo '<input type="hidden" name="nasa-gallery-variation-supported" class="nasa-gallery-variation-supported" value="1" />';
                    return;
                }
            }
        }
    }
}

/**
 * Size Guide Product - Delivery & Return
 */
add_action('woocommerce_single_product_summary', 'nasa_single_product_popup_nodes', 35);
function nasa_single_product_popup_nodes() {
    global $nasa_opt, $product;
    
    /**
     * Size Guide - New Feature get content from static Block
     */
    $size_guide = false;
    
    $product_id = $product->get_id();
    $p_sizeguide = nasa_get_product_meta_value($product_id, '_product_size_guide');
    
    if ($p_sizeguide == '-1') {
        $size_guide = 'not-show';
    }
    
    /**
     * Get size_guide from category
     */
    elseif ($p_sizeguide == '') {
        $term_id = nasa_root_term_id();

        if ($term_id) {
            $size_guide_cat = get_term_meta($term_id, 'cat_size_guide_block', true);
            
            if ($size_guide_cat) {
                $size_guide = $size_guide_cat != '-1' ? nasa_get_block($size_guide_cat) : 'not-show';
            }
        }
    }
    
    /**
     * For Single Product
     */
    else {
        $size_guide = nasa_get_block($p_sizeguide);
    }

    /**
     * Get size_guide from Theme Options
     */
    if (!$size_guide && isset($nasa_opt['size_guide_product']) && $nasa_opt['size_guide_product']) {
        $size_guide = nasa_get_block($nasa_opt['size_guide_product']);
    }
    
    /**
     * Not show from Category
     */
    if ($size_guide == 'not-show') {
        $size_guide = false;
    }
    
    /**
     * Delivery & Return
     */
    $delivery_return = false;
    if (isset($nasa_opt['delivery_return_single_product']) && $nasa_opt['delivery_return_single_product']) {
        $delivery_return = nasa_get_block($nasa_opt['delivery_return_single_product']);
    }
    
    /**
     * Ask a Question
     */
    $ask_a_question = false;
    if (isset($nasa_opt['ask_a_question']) && $nasa_opt['ask_a_question']) {
        $ask_a_question = shortcode_exists('contact-form-7') ? true : false;
    }
    
    /**
     * Request a Call Back
     */
    $request_a_callback = false;
    if (isset($nasa_opt['request_a_callback']) && $nasa_opt['request_a_callback']) {
        $request_a_callback = shortcode_exists('contact-form-7') ? true : false;
    }
    
    /**
     * Args Template
     */
    $nasa_args = array(
        'size_guide' => $size_guide,
        'delivery_return' => $delivery_return,
        'ask_a_question' => $ask_a_question,
        'request_a_callback' => $request_a_callback,
        'single_product' => $product
    );
    
    if ($ask_a_question || $request_a_callback) {
        add_action('wp_footer', 'nasa_single_product_nodes_cf7');
    }
    
    /**
     * Include template
     */
    nasa_template('products/nasa_single_product/nasa-single-product-popup-nodes.php', $nasa_args);
}

/**
 * Ask a Question, Request Callback
 */
function nasa_single_product_nodes_cf7() {
    global $nasa_opt, $product;
    
    /**
     * Ask a Question
     */
    $ask_a_question = false;
    if (isset($nasa_opt['ask_a_question']) && $nasa_opt['ask_a_question']) {
        $ask_a_question = shortcode_exists('contact-form-7') ? do_shortcode('[contact-form-7 id="' . ((int) $nasa_opt['ask_a_question']) . '"]') : false;
        
        if ($ask_a_question == '[contact-form-7 404 "Not Found"]') {
            $ask_a_question = false;
        }
    }
    
    /**
     * Request a Call Back
     */
    $request_a_callback = false;
    if (isset($nasa_opt['request_a_callback']) && $nasa_opt['request_a_callback']) {
        $request_a_callback = shortcode_exists('contact-form-7') ? do_shortcode('[contact-form-7 id="' . ((int) $nasa_opt['request_a_callback']) . '"]') : false;
        
        if ($request_a_callback == '[contact-form-7 404 "Not Found"]') {
            $request_a_callback = false;
        }
    }
    
    /**
     * Args Template
     */
    $nasa_args = array(
        // 'size_guide' => $size_guide,
        // 'delivery_return' => $delivery_return,
        'ask_a_question' => $ask_a_question,
        'request_a_callback' => $request_a_callback,
        'single_product' => $product
    );
    
    /**
     * Include template
     */
    nasa_template('products/nasa_single_product/nasa-single-product-popup-nodes-cf7.php', $nasa_args);
}

/**
 * Viewed icon button
 */
add_action('nasa_static_group_btns', 'nasa_static_request_callback', 12);
function nasa_static_request_callback() {
    global $nasa_opt;
    
    if (!isset($nasa_opt['request_a_callback']) || !$nasa_opt['request_a_callback'] || !NASA_WOO_ACTIVED || !is_product()) {
        return;
    }
    ?>
    
    <a class="nasa-node-popup hidden-tag nasa-tip nasa-tip-left" href="javascript:void(0);" data-target="#nasa-content-request-a-callback" data-tip="<?php echo esc_attr__('Request a Call Back', 'nasa-core'); ?>" title="<?php echo esc_attr__('Request a Call Back', 'nasa-core'); ?>" rel="nofollow">
        <svg class="nasa-flip-vertical" height="26" width="26" viewBox="0 40 512 512" fill="currentColor">
            <path d="M248 477c5 0 11 0 18 0 77-10 123-53 136-128 5-5 13-10 15-17 26-8 36-31 41-59 0-5 0-13 0-18-5-28-15-51-41-59-5-5-10-13-15-16-5-38-26-61-64-66-8 0-21 2-31 0-7-3-13-18-23-15-15 0-28 0-43 0-26 2-31 41-5 48 7 3 46 3 53 0 8-2 13-10 16-15 33-3 59 2 71 20 3 5 11 21 8 28-3 6-10 8-15 16-5 13-3 46-3 69 0 10 0 23 0 36 0 23 0 41 15 46-5 36-20 64-43 82-23 20-54 33-95 31-64-3-105-49-115-113 23-8 15-46 15-85 0-35 8-89-28-84-10 0-15 10-20 18-26 8-36 31-41 59 0 5 0 13 0 18 5 28 15 51 41 59 5 7 13 12 18 17 12 75 59 118 135 128z m-135-145c-3-31-3-70-3-103 0-10-2-23 3-33 5 0 5 0 10 0 8 8 5 20 5 31 0 33 0 71-3 102-2 5-10 5-12 3z m274 0c-3-31-3-70-3-103 0-10-3-23 3-33 5 0 5 0 10 0 5 8 2 20 2 31 0 33 0 71-2 102 0 5-8 5-10 3z m-292-118c0 33 0 69 0 102-31-15-31-89 0-102z m322 0c31 13 31 89 0 102 0-36-2-72 0-102z m-184-98c13-2 41-5 54 0 2 3 2 8 0 13-13 0-67 11-54-13z"/>
        </svg>
    </a>
    
    <?php
}

/**
 * After Add To Cart Button
 */
// add_action('woocommerce_after_add_to_cart_form', 'nasa_after_add_to_cart_form');
add_action('woocommerce_single_product_summary', 'nasa_after_add_to_cart_form', 50);
function nasa_after_add_to_cart_form() {
    global $nasa_opt;
    
    if (isset($nasa_opt['after_single_addtocart_form']) && $nasa_opt['after_single_addtocart_form']) {
        echo nasa_get_block($nasa_opt['after_single_addtocart_form']);
    }
}

/**
 * After Process To Checkout Button
 */
add_action('woocommerce_proceed_to_checkout', 'nasa_after_process_checkout_button', 100);
function nasa_after_process_checkout_button() {
    global $nasa_opt;
    
    if (isset($nasa_opt['after_process_checkout']) && $nasa_opt['after_process_checkout']) {
        echo nasa_get_block($nasa_opt['after_process_checkout']);
    }
}

/**
 * After Cart Table
 */
add_action('woocommerce_after_cart_table', 'nasa_after_cart_table');
function nasa_after_cart_table() {
    global $nasa_opt;
    
    if (isset($nasa_opt['after_cart_table']) && $nasa_opt['after_cart_table']) {
        echo nasa_get_block($nasa_opt['after_cart_table']);
    }
}

/**
 * After Cart content
 */
add_action('woocommerce_after_cart', 'nasa_after_cart', 5);
function nasa_after_cart() {
    global $nasa_opt;
    
    if (isset($nasa_opt['after_cart']) && $nasa_opt['after_cart']) {
        echo nasa_get_block($nasa_opt['after_cart']);
    }
}

/**
 * After Place Order Button
 */
add_action('woocommerce_review_order_after_payment', 'nasa_after_place_order_button');
function nasa_after_place_order_button() {
    global $nasa_opt;
    
    if (isset($nasa_opt['after_place_order']) && $nasa_opt['after_place_order']) {
        echo nasa_get_block($nasa_opt['after_place_order']);
    }
}

/**
 * After review order
 */
if (defined('NASA_THEME_ACTIVE') && NASA_THEME_ACTIVE) {
    add_action('nasa_checkout_after_order_review', 'nasa_after_review_order_payment');
} else {
    add_action('woocommerce_checkout_after_order_review', 'nasa_after_review_order_payment');
}
function nasa_after_review_order_payment() {
    global $nasa_opt;
    
    if (isset($nasa_opt['after_review_order']) && $nasa_opt['after_review_order']) {
        echo nasa_get_block($nasa_opt['after_review_order']);
    }
}

/**
 * After Checkout Customer Detail
 */
add_action('woocommerce_checkout_after_customer_details', 'nasa_checkout_after_customer_details', 100);
function nasa_checkout_after_customer_details() {
    global $nasa_opt;
    
    if (isset($nasa_opt['after_checkout_customer']) && $nasa_opt['after_checkout_customer']) {
        echo nasa_get_block($nasa_opt['after_checkout_customer']);
    }
}

/**
 * Custom Slug Nasa Custom Categories
 */
add_filter('nasa_taxonomy_custom_cateogory', 'nasa_custom_slug_categories');
function nasa_custom_slug_categories($slug) {
    global $nasa_opt;
    
    if (!NASA_WOO_ACTIVED || !isset($nasa_opt['enable_nasa_custom_categories']) || !$nasa_opt['enable_nasa_custom_categories']) {
        return $slug;
    }
    
    /**
     * Get From Option
     */
    if (!isset($nasa_opt['nasa_custom_categories_slug'])) {
        $nasa_opt['nasa_custom_categories_slug'] = get_option('nasa_custom_categories_slug', 'nasa_product_cat');
    }
    
    if (trim($nasa_opt['nasa_custom_categories_slug']) === '') {
        return $slug;
    }
    
    $new_slug = sanitize_title(trim($nasa_opt['nasa_custom_categories_slug']));
    
    return $new_slug;
}

/**
 * Custom nasa-taxonomy
 */
add_action('nasa_before_archive_products', 'nasa_custom_filter_taxonomies');
function nasa_custom_filter_taxonomies() {
    global $nasa_opt;
    
    if (!NASA_WOO_ACTIVED || !isset($nasa_opt['enable_nasa_custom_categories']) || !$nasa_opt['enable_nasa_custom_categories']) {
        return;
    }
    
    $root_cat_id = nasa_root_term_id();
    
    $show = '';
    if ($root_cat_id) {
        $show = get_term_meta($root_cat_id, 'nasa_custom_tax', true);
    }
    
    if ($show == '') {
        $show = isset($nasa_opt['archive_product_nasa_custom_categories']) && $nasa_opt['archive_product_nasa_custom_categories'] ? 'show' : 'hide';
    }
    
    if ($show === 'hide') {
        return;
    }

    $class = 'ns-filter-group-wrap';
    $max = isset($nasa_opt['max_level_nasa_custom_categories']) ? (int) $nasa_opt['max_level_nasa_custom_categories'] : 3;
    $max_level = $max > 3 || $max < 1 ? 3 : $max;
    
    $count = isset($nasa_opt['count_items_nasa_group']) && $nasa_opt['count_items_nasa_group'] ? '1' : '0';
    $hide_empty = isset($nasa_opt['hide_empty_nasa_group']) && $nasa_opt['hide_empty_nasa_group'] ? '1' : '0';
    
    echo '<div class="' . esc_attr($class) . '">';
    echo do_shortcode('[nasa_product_nasa_categories deep_level="' . esc_attr($max_level) . '" count_items="' . $count . '" hide_empty="' . $hide_empty . '" el_class="margin-top-15 mobile-margin-top-10"]');
    echo '</div>';
}

/**
 * 360 Degree Product Viewer
 */
add_action('nasa_single_buttons', 'nasa_360_product_viewer', 25);
function nasa_360_product_viewer() {
    global $nasa_opt, $product;
    if (isset($nasa_opt['product_360_degree']) && !$nasa_opt['product_360_degree']) {
        return;
    }
    
    /**
     * 360 Degree Product Viewer
     * 
     * jQuery lib
     */
    wp_enqueue_script('jquery-threesixty', NASA_CORE_PLUGIN_URL . 'assets/js/min/threesixty.min.js', array('jquery'), null, true);
    
    $id_imgs = nasa_get_product_meta_value($product->get_id(), '_product_360_degree');
    $id_imgs_str = $id_imgs ? trim($id_imgs, ',') : '';
    $id_imgs_arr = $id_imgs_str !== '' ? explode(',', $id_imgs_str) : array();
    
    if (empty($id_imgs_arr)) {
        return;
    }
    
    $img_src = array();
    $width = apply_filters('nasa_360_product_viewer_width_default', 500);
    $height = apply_filters('nasa_360_product_viewer_height_default', 500);
    $set = false;
    
    foreach ($id_imgs_arr as $id) {
        $image_full = wp_get_attachment_image_src($id, 'full');
        
        if (isset($image_full[0])) {
            $img_src[] = $image_full[0];
            
            if (!$set) {
                $set = true;
                $width = isset($image_full[1]) ? $image_full[1] : $width;
                $height = isset($image_full[2]) ? $image_full[2] : $height;
            }
        } else {
            $img_src[] = wp_get_attachment_url($id);
        }
    }
    
    if (!empty($img_src)) {
        $img_src_json = wp_json_encode($img_src);
        $dataimgs = function_exists('wc_esc_json') ?
            wc_esc_json($img_src_json) : _wp_specialchars($img_src_json, ENT_QUOTES, 'UTF-8', true);
        
        echo '<a id="nasa-360-degree" class="nasa-360-degree-popup nasa-tip nasa-tip-right" href="javascript:void(0);" data-close="' . esc_attr__('Close', 'nasa-core') . '" data-imgs="' . $dataimgs . '" data-width="' . $width . '" data-height="' . $height . '" data-tip="' . esc_html__('360&#176; View', 'nasa-core') . '" rel="nofollow">' . esc_html__('360&#176;', 'nasa-core')  . '</a>';
        add_action('nasa_static_content', 'elessi_nasa_popup_360_degree', 17);
    }
}

if (!function_exists('elessi_nasa_popup_360_degree')) :
    function elessi_nasa_popup_360_degree() {
        ?>
        <div class="nasa-product-360-degree"></div>
        <?php
    }
endif;

/**
 * Custom Badge
 */
add_filter('nasa_badges', 'nasa_custom_badges');
function nasa_custom_badges($badges) {
    global $nasa_opt, $product;
    
    $product_id = $product->get_id();
    
    $custom_badge = '';
    
    /**
     * Video Badge
     */
    if (isset($nasa_opt['nasa_badge_video']) && $nasa_opt['nasa_badge_video']) {
        $video_link = nasa_get_product_meta_value($product_id, '_product_video_link');
        $custom_badge .= $video_link ? '<span class="badge video-label nasa-icon pe-7s-play"></span>' : '';
    }
    
    /**
     * 360 Degree Badge
     */
    if (isset($nasa_opt['nasa_badge_360']) && $nasa_opt['nasa_badge_360']) {
        $id_imgs = nasa_get_product_meta_value($product_id, '_product_360_degree');
        $id_imgs_str = $id_imgs ? trim($id_imgs, ',') : '';
        $custom_badge .= $id_imgs_str ? '<span class="badge b360-label">' . esc_html__('360&#176;', 'nasa-core') . '</span>' : '';
    }

    /**
     * Custom Badge
     */
    $badge_hot = nasa_get_product_meta_value($product_id, '_bubble_hot');
    $custom_badge .= $badge_hot ? '<span class="badge hot-label">' . $badge_hot . '</span>' : '';
    
    return $custom_badge . $badges;
}

/**
 * Add tab Bought Together
 */
add_filter('woocommerce_product_tabs', 'nasa_accessories_product_tab');
function nasa_accessories_product_tab($tabs) {
    global $product;
    $arr_type = array('simple', 'variable');

    if ($product && in_array($product->get_type(),$arr_type,true)) {
        $productIds = get_post_meta($product->get_id(), '_accessories_ids', true);
        
        if (!empty($productIds)) {
            $GLOBALS['accessories_ids'] = $productIds;
            
            $tabs['accessories_content'] = array(
                'title'     => esc_html__('Bought Together', 'nasa-core'),
                'priority'  => apply_filters('nasa_bought_together_tab_priority', 5),
                'callback'  => 'nasa_accessories_product_tab_content'
            );
        }
    }

    return $tabs;
}

/**
 * Content Bought Together of the current Product
 */
function nasa_accessories_product_tab_content() {
    global $product, $accessories_ids, $nasa_opt;
    
    if (!$product || !$accessories_ids) {
        return;
    }
    
    $arr_type = array('simple', 'variable');
    $accessories = array();
    foreach ($accessories_ids as $accessories_id) {
        $product_acc = wc_get_product($accessories_id);
        if (
            $product_acc &&
            $product_acc->get_status() === 'publish' &&
            in_array($product_acc->get_type(), $arr_type)
        ) {
            $accessories[] = $product_acc;
        }
    }

    if (empty($accessories)) {
        return;
    }
    
    $nasa_args = array(
        'nasa_opt' => $nasa_opt,
        'product' => $product,
        'accessories_ids' => $accessories_ids,
        'accessories' => $accessories,
    );

    nasa_template('products/nasa_single_product/nasa-single-product-accessories-tab-content.php', $nasa_args);
}

/**
 * Add tab Technical Specifications
 */
add_filter('woocommerce_product_tabs', 'nasa_specifications_product_tab');
function nasa_specifications_product_tab($tabs) {
    global $nasa_specifications, $product;
    if (!$product) {
        return $tabs;
    }
    
    $product_id = $product->get_id();
    if (!isset($nasa_specifications[$product_id])) {
        $specifications = nasa_get_product_meta_value($product_id, 'nasa_specifications');
        $nasa_specifications[$product->get_id()] = $specifications;
        $GLOBALS['nasa_specifications'] = $nasa_specifications;
    }
    
    if ($nasa_specifications[$product_id] == '') {
        return $tabs;
    }
    
    $tabs['specifications'] = array(
        'title'     => esc_html__('Specifications', 'nasa-core'),
        'priority'  => apply_filters('nasa_specifications_tab_priority', 15),
        'callback'  => 'nasa_specifications_product_tab_content'
    );

    return $tabs;
}

/**
 * Content Technical Specifications of the current Product
 */
function nasa_specifications_product_tab_content() {
    global $product, $nasa_specifications;
    
    if (!$product || !isset($nasa_specifications[$product->get_id()])) {
        return;
    }

    echo do_shortcode($nasa_specifications[$product->get_id()]);
}

/**
 * Addition Custom Tabs
 */
add_filter('woocommerce_product_tabs', 'nasa_custom_product_tabs', 990);
function nasa_custom_product_tabs($tabs) {
    global $product, $nasa_ct_tabs;
    
    if (!$product) {
        return $tabs;
    }
    
    $ct_tabs = get_post_meta($product->get_id(), '_nasa_ct_tabs', true);
    
    if (!is_array($ct_tabs) || empty($ct_tabs)) {
        return $tabs;
    }
    
    $nasa_ct_tabs = array();
    
    foreach ($ct_tabs as $key => $ct_tab) {
        $tab = nasa_get_block_obj($ct_tab);
        
        if ($tab) {
            $nasa_ct_tabs[$key] = $tab['content'];
            
            $tabs['ct_tab_' . $key] = array(
                'title'     => $tab['title'],
                'priority'  => apply_filters('nasa_ct_tabs_priority', 90),
                'callback'  => 'nasa_custom_product_tab_content_' . $key
            );
        }
        
        if ($key > 4) {
            break;
        }
    }
    
    $GLOBALS['nasa_ct_tabs'] = $nasa_ct_tabs;

    return $tabs;
}

/**
 * CT Tab #0
 * 
 * @global type $product
 * @return string
 */
function nasa_custom_product_tab_content_0() {
    global $nasa_ct_tabs;
    
    if (empty($nasa_ct_tabs) || !isset($nasa_ct_tabs[0])) {
        return;
    }
    
    echo $nasa_ct_tabs[0];
}

/**
 * CT Tab #1
 * 
 * @global type $product
 * @return string
 */
function nasa_custom_product_tab_content_1() {
    global $nasa_ct_tabs;
    
    if (empty($nasa_ct_tabs) || !isset($nasa_ct_tabs[1])) {
        return;
    }
    
    echo $nasa_ct_tabs[1];
}

/**
 * CT Tab #2
 * 
 * @global type $product
 * @return string
 */
function nasa_custom_product_tab_content_2() {
    global $nasa_ct_tabs;
    
    if (empty($nasa_ct_tabs) || !isset($nasa_ct_tabs[2])) {
        return;
    }
    
    echo $nasa_ct_tabs[2];
}

/**
 * CT Tab #3
 * 
 * @global type $product
 * @return string
 */
function nasa_custom_product_tab_content_3() {
    global $nasa_ct_tabs;
    
    if (empty($nasa_ct_tabs) || !isset($nasa_ct_tabs[3])) {
        return;
    }
    
    echo $nasa_ct_tabs[3];
}

/**
 * CT Tab #4
 * 
 * @global type $product
 * @return string
 */
function nasa_custom_product_tab_content_4() {
    global $nasa_ct_tabs;
    
    if (empty($nasa_ct_tabs) || !isset($nasa_ct_tabs[4])) {
        return;
    }
    
    echo $nasa_ct_tabs[4];
}

/**
 * Category Tab
 */
add_filter('woocommerce_product_tabs', 'nasa_product_cat_global_tab', 995);
function nasa_product_cat_global_tab($tabs) {
    global $product;
    
    if (!$product) {
        return $tabs;
    }
    
    $root_cat_id = nasa_root_term_id();
    
    if (!$root_cat_id) {
        return $tabs;
    }
    
    $slug = get_term_meta($root_cat_id, 'single_product_tab_glb', true);
    
    if ($slug) {
        $tab = nasa_get_block_obj($slug);
        
        if ($tab) {
            $GLOBALS['nasa_cat_tab'] = $tab['content'];

            $tabs['glb_cat_tab'] = array(
                'title'     => $tab['title'],
                'priority'  => apply_filters('nasa_cat_tab_priority', 95),
                'callback'  => 'nasa_glb_product_cat_tab_content'
            );
        }
    }

    return $tabs;
}

/**
 * Global Cat Tab Content
 */
function nasa_glb_product_cat_tab_content() {
    global $nasa_cat_tab;
    
    echo !empty($nasa_cat_tab) ? $nasa_cat_tab : '';
}

/**
 * Addition Global Tab
 */
add_filter('woocommerce_product_tabs', 'nasa_product_global_tab', 999);
function nasa_product_global_tab($tabs) {
    global $product, $nasa_opt;
    
    if (!$product) {
        return $tabs;
    }
    
    if (!isset($nasa_opt['tab_glb']) || !$nasa_opt['tab_glb'] || $nasa_opt['tab_glb'] == 'default') {
        return $tabs;
    }
    
    $tab = nasa_get_block_obj($nasa_opt['tab_glb']);
    
    if ($tab) {
        $GLOBALS['nasa_glb_tabs'] = $tab['content'];
        $tabs['glb_tab'] = array(
            'title'     => $tab['title'],
            'priority'  => apply_filters('nasa_glb_tab_priority', 100),
            'callback'  => 'nasa_glb_product_tab_content'
        );
    }

    return $tabs;
}

/**
 * Global Tab Content
 */
function nasa_glb_product_tab_content() {
    global $nasa_glb_tabs;
    
    echo !empty($nasa_glb_tabs) ? $nasa_glb_tabs : '';
}

/**
 * Loop layout buttons
 */
add_action('template_redirect', 'nasa_loop_product_opts');
function nasa_loop_product_opts() {
    if (!NASA_WOO_ACTIVED) {
        return false;
    }
    
    global $nasa_opt;
    
    /**
     * Page Preview Elementor
     */
    if (NASA_ELEMENTOR_ACTIVE && isset($_REQUEST['elementor-preview']) && $_REQUEST['elementor-preview']) {
        $preview_id = (int) $_REQUEST['elementor-preview'];
        
        /**
         * Swith loop_layout_buttons
         */
        if ($preview_id) {
            $type_override = get_post_meta($preview_id, '_nasa_loop_layout_buttons', true);
            if (!empty($type_override)) {
                $nasa_opt['loop_layout_buttons'] = $type_override;
            }
        }
        
    } else {
        
        $root_term_id = nasa_root_term_id();

        /**
         * Category products
         */
        if ($root_term_id) {
            $type_override = get_term_meta($root_term_id, 'nasa_loop_layout_buttons', true);
            if ($type_override) {
                $nasa_opt['loop_layout_buttons'] = $type_override;
            }
            
            $effect_product = get_term_meta($root_term_id, 'cat_effect_hover', true);
            if ($effect_product == 'no') {
                $nasa_opt['animated_products'] = '';
            } elseif ($effect_product !== '') {
                $nasa_opt['animated_products'] = $effect_product;
            }
        }

        /**
         * Pages
         */
        else {
            global $wp_query;

            $page_id = false;
            $is_shop = is_shop();
            $is_product_taxonomy = is_product_taxonomy();

            /**
             * Shop
             */
            if ($is_shop || $is_product_taxonomy) {
                $pageShop = wc_get_page_id('shop');

                if ($pageShop > 0) {
                    $page_id = $pageShop;
                }
            }

            /**
             * Page
             */
            else {
                $page_id = $wp_query->get_queried_object_id();
            }

            /**
             * Swith loop_layout_buttons for page
             */
            if ($page_id) {
                $type_override = get_post_meta($page_id, '_nasa_loop_layout_buttons', true);
                if (!empty($type_override)) {
                    $nasa_opt['loop_layout_buttons'] = $type_override;
                }
                
                $effect_product = get_post_meta($page_id, '_nasa_effect_hover', true);
                if ($effect_product == 'no') {
                    $nasa_opt['animated_products'] = '';
                } elseif ($effect_product !== '') {
                    $nasa_opt['animated_products'] = $effect_product;
                }
            }
        }
    }
    
    $GLOBALS['nasa_opt'] = $nasa_opt;
}

/**
 * Attributes Brands Single Product Page
 */
add_action('woocommerce_single_product_summary', 'nasa_single_attributes_brands', 16);
add_action('woocommerce_single_product_lightbox_summary', 'nasa_single_attributes_brands', 11);
function nasa_single_attributes_brands() {
    global $nasa_opt, $product;
    
    if (!$product) {
        return;
    }
    
    $nasa_brands = isset($nasa_opt['attr_brands']) && !empty($nasa_opt['attr_brands']) ? $nasa_opt['attr_brands'] : array();
    $brands = array();
    
    if (!empty($nasa_brands)) {
        foreach ($nasa_brands as $key => $val) {
            if ($val === '1') {
                $brands[] = $key;
            }
        }
    }
    
    if (empty($brands)) {
        return;
    }
    
    $attributes = $product->get_attributes();
    if (empty($attributes)) {
        return;
    }
    
    $brands_output = array();
    foreach ($attributes as $attribute_name => $attribute) {
        $attr_name = 0 === strpos($attribute_name, 'pa_') ? substr($attribute_name, 3) : $attribute_name;
        
        if (!in_array($attr_name, $brands)) {
            continue;
        }
        
        $terms = $attribute->get_terms();
        $is_link = false;
        $this_name = false;
        if ($attribute->is_taxonomy()) {
            $attribute_taxonomy = $attribute->get_taxonomy_object();
            $is_link = $attribute_taxonomy->attribute_public ? true : false;
            $this_name = $attribute->get_name();
        }
        
        if (!empty($terms)) {
            $brands_output[$attribute_name] = array(
                'is_link' => $is_link,
                'attr_name' => $this_name,
                'terms' => $terms
            );
        }
    }
    
    $nasa_args = array(
        'brands' => $brands_output
    );
    
    nasa_template('products/nasa_single_product/nasa-single-brands.php', $nasa_args);
}

/**
 * Fake Sold
 */
add_action('woocommerce_single_product_summary', 'nasa_fake_sold', 22);
function nasa_fake_sold() {
    global $nasa_opt, $product;
    
    if (!isset($nasa_opt['fake_sold']) || !$nasa_opt['fake_sold'] || !$product || "outofstock" === $product->get_stock_status()) {
        return;
    }
    
    $product_type = $product->get_type();
    $types_allow = apply_filters('nasa_types_allow_fake', array('simple', 'variable', 'variation'));
    
    if (empty($types_allow) || in_array($product_type, $types_allow)) {
        $product_id = $product_type == 'variation' ? $product->get_parent_id() : $product->get_id();
        
        if ('-1' === nasa_get_product_meta_value($product_id, "_fake_sold")) {
            return;
        }

        $key_name = 'nasa_fake_sold_' . $product_id;
        $fake_sold = get_transient($key_name);

        if (!$fake_sold) {
            /**
             * Build sold
             */
            $min = isset($nasa_opt['min_fake_sold']) && (int) $nasa_opt['min_fake_sold'] ? (int) $nasa_opt['min_fake_sold'] : 1;
            $max = isset($nasa_opt['max_fake_sold']) && (int) $nasa_opt['max_fake_sold'] ? (int) $nasa_opt['max_fake_sold'] : 20;
            $sold = rand($min, $max);

            /**
             * Build time
             */
            $min_time = isset($nasa_opt['min_fake_time']) && (int) $nasa_opt['min_fake_time'] ? (int) $nasa_opt['min_fake_time'] : 1;
            $max_time = isset($nasa_opt['max_fake_time']) && (int) $nasa_opt['max_fake_time'] ? (int) $nasa_opt['max_fake_time'] : 1;
            $times = rand($min_time, $max_time);

            /**
             * Live time - default 10 hours
             */
            $live_time = isset($nasa_opt['fake_time_live']) && (int) $nasa_opt['fake_time_live'] ? (int) $nasa_opt['fake_time_live'] : 36000;

            $fake_sold_data = '<div class="nasa-last-sold nasa-crazy-inline">';
            
            $fake_sold_data .= '<svg class="last-sold-img" width="20" height="18" viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid" fill="#000000"><g id="SVGRepo_iconCarrier"><defs><style>.cls-3{fill: url(#linear-gradient-1);}.cls-4{fill: #fc9502;}.cls-5 {fill: #fce202;}</style><linearGradient id="linear-gradient-1" gradientUnits="userSpaceOnUse" x1="94.141" y1="255" x2="94.141" y2="0.188"><stop offset="0" stop-color="#ff4c0d"/><stop offset="1" stop-color="#fc9502"/></linearGradient></defs><g id="fire"><path d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z" id="path-1" class="cls-3" fill-rule="evenodd"/><path d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z" id="path-2" class="cls-4" fill-rule="evenodd"/> <path d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z" id="path-3" class="cls-5" fill-rule="evenodd"/></g></g></svg>';
            
            $fake_sold_data .= $times > 1 ? sprintf(
                esc_html__('%s sold in last %s hours', 'nasa-core'),
                $sold,
                $times
            ) : sprintf(
                esc_html__('%s sold in last %s hour', 'nasa-core'),
                $sold,
                $times
            );
            
            $fake_sold_data .= '</div>';

            /**
             * Apply content fake sold
             */
            $fake_sold = apply_filters('nasa_fake_sold_content', $fake_sold_data, $product_id);

            /**
             * Set transient
             */
            set_transient($key_name, $fake_sold, $live_time);
        }

        echo $fake_sold ? $fake_sold : '';
    }
}

/**
 * Fake In Cart
 */
add_action('woocommerce_single_product_summary', 'nasa_fake_in_cart', 22);
function nasa_fake_in_cart() {
    global $nasa_opt, $product;
    
    if (!isset($nasa_opt['fake_in_cart']) || !$nasa_opt['fake_in_cart'] || !$product || "outofstock" === $product->get_stock_status()) {
        return;
    }
    
    $product_type = $product->get_type();
    $types_allow = apply_filters('nasa_types_allow_fake', array('simple', 'variable', 'variation'));
    
    if (empty($types_allow) || in_array($product_type, $types_allow)) {
        $product_id = $product_type == 'variation' ? $product->get_parent_id() : $product->get_id();
        
        if ('-1' === nasa_get_product_meta_value($product_id, "_fake_in_cart")) {
            return;
        }

        $key_name = 'nasa_fake_in_cart_' . $product_id;
        $fake_in_cart = get_transient($key_name);

        if (!$fake_in_cart) {
            /**
             * Build in cart
             */
            $min = isset($nasa_opt['min_fake_in_cart']) && (int) $nasa_opt['min_fake_in_cart'] ? (int) $nasa_opt['min_fake_in_cart'] : 1;
            $max = isset($nasa_opt['max_fake_in_cart']) && (int) $nasa_opt['max_fake_in_cart'] ? (int) $nasa_opt['max_fake_in_cart'] : 20;
            $in_cart = rand($min, $max);

            /**
             * Live time - default 10 hours
             */
            $live_time = isset($nasa_opt['fake_in_cart_time_live']) && (int) $nasa_opt['fake_in_cart_time_live'] ? (int) $nasa_opt['fake_in_cart_time_live'] : 36000;

            $fake_in_cart_data = '<div class="nasa-in-cart nasa-crazy-inline">';
            
            $fake_in_cart_data .= '<svg class="last-sold-img" width="20" height="18" viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid" fill="#000000"><g id="SVGRepo_iconCarrier"> <defs> <style> .cls-3 { fill: url(#linear-gradient-1); } .cls-4 { fill: #fc9502; } .cls-5 { fill: #fce202; } </style> <linearGradient id="linear-gradient-1" gradientUnits="userSpaceOnUse" x1="94.141" y1="255" x2="94.141" y2="0.188"> <stop offset="0" stop-color="#ff4c0d"/> <stop offset="1" stop-color="#fc9502"/> </linearGradient> </defs> <g id="fire"> <path d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z" id="path-1" class="cls-3" fill-rule="evenodd"/> <path d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z" id="path-2" class="cls-4" fill-rule="evenodd"/> <path d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z" id="path-3" class="cls-5" fill-rule="evenodd"/> </g> </g></svg>';
            
            $fake_in_cart_data .= sprintf(
                esc_html__('Hurry! Over %s people have this in their carts', 'nasa-core'),
                $in_cart
            );
            
            $fake_in_cart_data .= '</div>';
            
            /**
             * Apply content fake in cart
             */
            $fake_in_cart = apply_filters('nasa_fake_in_cart_content', $fake_in_cart_data, $product_id);

            /**
             * Set transient
             */
            set_transient($key_name, $fake_in_cart, $live_time);
        }

        echo $fake_in_cart ? $fake_in_cart : '';
    }
}

/**
 * Fake Time Limited Countdown Checkout
 */
add_action('nasa_before_shopping_cart', 'nasa_time_limited_checkout');
function nasa_time_limited_checkout() {
    global $nasa_opt;
    
    if (!isset($nasa_opt['ns_time_limited_checkout']) || !$nasa_opt['ns_time_limited_checkout']) {
        return;
    }

    if (WC()->cart->is_empty()) {
        return;
    } 
    
    $min = isset($nasa_opt['min_ns_time_limited_checkout']) && (int) $nasa_opt['min_ns_time_limited_checkout'] ? (int) $nasa_opt['min_ns_time_limited_checkout'] : 300;
    $max = isset($nasa_opt['max_ns_time_limited_checkout']) && (int) $nasa_opt['max_ns_time_limited_checkout'] ? (int) $nasa_opt['max_ns_time_limited_checkout'] : 600;

    $time = $min >= $max ? $min : rand($min, $max);

    $cookieName = 'nasa_curent_seconds_count_down';

    $time_limited_checkout = (isset($_COOKIE[$cookieName]) && $_COOKIE[$cookieName] > 0) ? $_COOKIE[$cookieName] : $time;

    $hours = floor($time_limited_checkout / 3600);

    $minutes = floor(($time_limited_checkout % 3600) / 60);

    $remainingSeconds = $time_limited_checkout % 60;

    $fake_limited_checkout_data = '<div class="nasa-time-checkout-countdown mobile-margin-top-30 mobile-margin-bottom-10 mobile-padding-left-10 mobile-padding-right-10 nasa-flex jc nasa-bold">';

    $fake_limited_checkout_data .= '<span class="nasa-flex nasa-mes-cd jc"><svg class="nasa-fire-img" width="20" height="20" viewBox="-33 0 255 255" preserveAspectRatio="xMidYMid" fill="#000000"><g id="SVGRepo_iconCarrier"> <defs> <style> .cls-3 { fill: url(#linear-gradient-1); } .cls-4 { fill: #fc9502; } .cls-5 { fill: #fce202; } </style> <linearGradient id="linear-gradient-1" gradientUnits="userSpaceOnUse" x1="94.141" y1="255" x2="94.141" y2="0.188"> <stop offset="0" stop-color="#ff4c0d"/> <stop offset="1" stop-color="#fc9502"/> </linearGradient> </defs> <g id="fire"> <path d="M187.899,164.809 C185.803,214.868 144.574,254.812 94.000,254.812 C42.085,254.812 -0.000,211.312 -0.000,160.812 C-0.000,154.062 -0.121,140.572 10.000,117.812 C16.057,104.191 19.856,95.634 22.000,87.812 C23.178,83.513 25.469,76.683 32.000,87.812 C35.851,94.374 36.000,103.812 36.000,103.812 C36.000,103.812 50.328,92.817 60.000,71.812 C74.179,41.019 62.866,22.612 59.000,9.812 C57.662,5.384 56.822,-2.574 66.000,0.812 C75.352,4.263 100.076,21.570 113.000,39.812 C131.445,65.847 138.000,90.812 138.000,90.812 C138.000,90.812 143.906,83.482 146.000,75.812 C148.365,67.151 148.400,58.573 155.999,67.813 C163.226,76.600 173.959,93.113 180.000,108.812 C190.969,137.321 187.899,164.809 187.899,164.809 Z" id="path-1" class="cls-3" fill-rule="evenodd"/> <path d="M94.000,254.812 C58.101,254.812 29.000,225.711 29.000,189.812 C29.000,168.151 37.729,155.000 55.896,137.166 C67.528,125.747 78.415,111.722 83.042,102.172 C83.953,100.292 86.026,90.495 94.019,101.966 C98.212,107.982 104.785,118.681 109.000,127.812 C116.266,143.555 118.000,158.812 118.000,158.812 C118.000,158.812 125.121,154.616 130.000,143.812 C131.573,140.330 134.753,127.148 143.643,140.328 C150.166,150.000 159.127,167.390 159.000,189.812 C159.000,225.711 129.898,254.812 94.000,254.812 Z" id="path-2" class="cls-4" fill-rule="evenodd"/> <path d="M95.000,183.812 C104.250,183.812 104.250,200.941 116.000,223.812 C123.824,239.041 112.121,254.812 95.000,254.812 C77.879,254.812 69.000,240.933 69.000,223.812 C69.000,206.692 85.750,183.812 95.000,183.812 Z" id="path-3" class="cls-5" fill-rule="evenodd"/> </g> </g></svg>';

    $fake_limited_checkout_data .= esc_html__('Hurry up! these product are limited, checkout within', 'nasa-core').'</span>';

    if ($hours <= 0) {
        $fake_limited_checkout_data .= '<a href="javascript:void(0);" title="'. esc_html__('Checkout now!', 'nasa-core') .'" class="checkout-countdown mobile-margin-top-10"><span class="ns-countdown-wrap button" data_time_countdown="' . $time_limited_checkout . '">'. $minutes . 'm:' . $remainingSeconds . 's' . '<span></a>';
    } else {
        $fake_limited_checkout_data .= '<a href="javascript:void(0);" title="'. esc_html__('Checkout now!', 'nasa-core') .'" class="checkout-countdown mobile-margin-top-10"><span class="ns-countdown-wrap button" data_time_countdown="' . $time_limited_checkout . '">' . $hours . 'h:' . $minutes . 'm:' . $remainingSeconds . 's' . '<span></a>';
    }

    $fake_limited_checkout_data .= '</div>';
    /**
     * Apply content fake in cart
     */
    $fake_limited_checkout = apply_filters('nasa_time_limited_checkout', $fake_limited_checkout_data);

    echo $fake_limited_checkout ? $fake_limited_checkout : '';
}

/**
 * Estimated Delivery
 */
add_action('woocommerce_single_product_summary', 'nasa_estimated_delivery', 35);
function nasa_estimated_delivery() {
    global $nasa_opt, $product;
    
    if (!isset($nasa_opt['est_delivery']) || !$nasa_opt['est_delivery'] || !$product || "outofstock" === $product->get_stock_status()) {
        return;
    }
    
    $now = get_date_from_gmt(date('Y-m-d H:i:s'), 'Y-m-d');
    $est_days = array();
    
    if (!isset($nasa_opt['est_delivery_excl_2']) && isset($nasa_opt['est_delivery_excl']) && $nasa_opt['est_delivery_excl']) {
        $excl_sat = $excl_sun = true;
    } else {
        $excl_sat = isset($nasa_opt['est_delivery_excl_2']) && $nasa_opt['est_delivery_excl_2']['sat'] ? true : false;
        $excl_sun = isset($nasa_opt['est_delivery_excl_2']) && $nasa_opt['est_delivery_excl_2']['sun'] ? true : false;
    }
    
    $format = apply_filters('nasa_estimated_delivery_fomart', 'D, M d');
    
    $product_id = (int) $product->get_id();
    
    $min = isset($nasa_opt['min_est_delivery']) && (int) $nasa_opt['min_est_delivery'] ? (int) $nasa_opt['min_est_delivery'] : 0;
    $from = '+' . $min;
    $from .= ' ' . ($min == 1 ? 'day' : 'days');
    
    $max = isset($nasa_opt['max_est_delivery']) && (int) $nasa_opt['max_est_delivery'] ? (int) $nasa_opt['max_est_delivery'] : 7;
    $to = '+' . $max;
    $to .= ' ' . ($max == 1 ? 'day' : 'days');
    
    /**
     * Exclude Sat and Sun
     */
    if ($excl_sat || $excl_sun) {
        $ranger_sat = $excl_sat && $excl_sun ? 2 : 1;
        
        /**
         * Excl - From day
         */
        $from_day = date('D', strtotime($now . $from));
        if ($from_day == 'Sat' && $excl_sat) {
            $from = '+' . ($min + $ranger_sat) . ' days';
        }
        
        if ($from_day == 'Sun' && $excl_sun) {
            $from = '+' . ($min + 1) . ' days';
        }
        
        /**
         * Excl - To day
         */
        $to_day = date('D', strtotime($now . $to));
        if ($to_day == 'Sat' && $excl_sat) {
            $to = '+' . ($max + $ranger_sat) . ' days';
        }
        
        if ($to_day == 'Sun' && $excl_sun) {
            $to = '+' . ($max + 1) . ' days';
        }
        
        /**
         * Add to 1 day when $from == $to
         */
        if ($from == $to) {
            $to .= ' + 1 day';
        }
    }
    
    $str_from = strtotime($now . $from);
    $str_to = strtotime($now . $to);
    
    $est_days[] = date_i18n($format, $str_from, true);
    
    if ($str_from < $str_to) {
        $est_days[] = date_i18n($format, $str_to, true);
    }
    
    if (!empty($est_days)) {
        $est_view = '<div class="nasa-est-delivery nasa-promote-sales nasa-crazy-inline">';
        $est_view .= '<svg class="nasa-flip-vertical" fill="currentColor" height="22" width="22" viewBox="0 0 512 512"><path d="M508 202c0 19 3 43 0 59-3 24-23 45-36 63-14 19-26 42-46 50-28 14-78 0-112 4-2 27 7 63-17 71-7 4-23 3-34 3-87 0-178 0-259 0-2 0-2-3-2-3 0-3 0-7 0-11 84 0 172 0 255 0 12 0 28 3 35-1 15-5 9-49 9-69 0-77 1-158-2-230-35-2-74-2-109 0-6 27-23 49-51 52-34 3-59-22-65-52-20 2-50-6-58 8-3 30 2 68-3 97-2 0-6 0-9 0-2-16-2-33-2-51 0-17-2-36 3-50 8-24 41-15 69-18 6-39 50-65 87-44 15 8 25 25 30 44 51 2 108 2 159 0 7-27 28-50 57-52 31-1 55 23 62 52 20 0 35 5 38 21 5 14 1 39 1 57z m-372-117c-58-4-65 83-10 91 21 3 39-9 45-19 21-34-7-70-35-72z m252 278c3 3 20 4 29 2 19-5 33-33 45-49 15-20 32-38 33-62-22-3-49-2-76-2-13 0-28-2-31 9-6 11-3 31-3 51 0 19 0 43 3 51z m25-278c-27-2-47 21-48 45 0 26 17 43 37 46 30 5 53-18 53-46 0-24-19-43-42-45z m56 53c-7 25-23 48-51 52-24 2-48-11-59-33-4-6-4-12-8-19-10 0-26-2-36 0-1 71 0 145-1 216 5 18 39 9 58 11 8-39-15-114 20-125 15-5 35-1 54-1 16 0 35 3 50-1 2-12 0-29 0-46 0-30 6-60-27-54z m-288 273c-59 0-118 0-176 0-1 0-1-3-1-3 0-3 0-7 0-11 59 0 118 0 177 0 0 5 0 10 0 14z m-177-56c48 0 97 0 146 0 0 5 0 8 0 13-49 0-97 0-145 0-3-2-1-8-1-13z m0-42c38 0 76 0 114 0 0 5 0 8 0 13-37 0-76 0-113 0-3-2-1-8-1-13z m0-41c27 0 56 0 84 0 0 5 0 8 0 13-28 0-55 0-83 0-3-2-1-10-1-13z"/></svg>&nbsp;&nbsp;';
        $est_view .= '<strong>' . esc_html__('Estimated Delivery:', 'nasa-core') . '</strong>&nbsp;';
        $est_view .= '<span class="ns-est-txt">' . implode(' &ndash; ', $est_days) . '</span>';
        
        $text_excl = '';
        
        if ($excl_sat || $excl_sun) {
            $text_excl = '&nbsp;&nbsp;<small class="ns-est-txt ns-est-excl">(' . esc_html__('Excl Sat, Sun', 'nasa-core') . ')</small>';
            
            if ($excl_sat && !$excl_sun) {
                $text_excl = '&nbsp;&nbsp;<small class="ns-est-txt ns-est-excl">(' . esc_html__('Excl Sat', 'nasa-core') . ')</small>';
            }
            
            if (!$excl_sat && $excl_sun) {
                $text_excl = '&nbsp;&nbsp;<small class="ns-est-txt ns-est-excl">(' . esc_html__('Excl Sun', 'nasa-core') . ')</small>';
            }
        }
        
        $est_view .= $text_excl;
        $est_view .= '</div>';
    
        /**
         * Output content estimated delivery view
         */
        echo apply_filters('nasa_estimated_delivery_content', $est_view, $product_id);
    }
}

/**
 * Fake Viewing
 */
add_action('woocommerce_single_product_summary', 'nasa_fake_view', 35);
function nasa_fake_view() {
    global $nasa_opt, $product;
    
    if ((isset($nasa_opt['fake_view']) && !$nasa_opt['fake_view']) || !$product) {
        return;
    }
    
    $product_id = (int) $product->get_id();
    
    if ('-1' === nasa_get_product_meta_value($product_id, "_fake_view")) {
        return;
    }
    
    $min = isset($nasa_opt['min_fake_view']) ? (int) $nasa_opt['min_fake_view'] : 10;
    $max = isset($nasa_opt['max_fake_view']) ? (int) $nasa_opt['max_fake_view'] : 50;
    $delay = isset($nasa_opt['delay_time_view']) ? (int) $nasa_opt['delay_time_view'] : 15;
    $change = isset($nasa_opt['max_change_view']) ? (int) $nasa_opt['max_change_view'] : 5;
    
    $allowed_html = array(
        'strong' => array()
    );
    
    $fake_view = '<div id="nasa-counter-viewing" class="nasa-viewing nasa-promote-sales nasa-crazy-inline" data-min="' . $min . '" data-max="' . $max . '" data-delay="' . ($delay * 1000) . '" data-change="' . $change . '" data-id="' . $product_id . '">';
    $fake_view .= '<svg width="20" height="22" viewBox="0 0 26 32" fill="currentColor"><path d="M12.8 3.2c-7.093 0-12.8 5.707-12.8 12.8s5.707 12.8 12.8 12.8c7.093 0 12.8-5.707 12.8-12.8s-5.707-12.8-12.8-12.8zM12.8 27.733c-6.453 0-11.733-5.28-11.733-11.733s5.28-11.733 11.733-11.733c6.453 0 11.733 5.28 11.733 11.733s-5.28 11.733-11.733 11.733z"/><path d="M19.467 19.040c-0.267-0.107-0.587-0.053-0.693 0.213-1.173 2.293-3.467 3.68-5.973 3.68-2.56 0-4.8-1.387-5.973-3.68-0.107-0.267-0.427-0.373-0.693-0.213-0.267 0.107-0.373 0.427-0.267 0.693 1.333 2.613 3.947 4.267 6.933 4.267 2.933 0 5.6-1.653 6.88-4.267 0.16-0.267 0.053-0.587-0.213-0.693z"/><path d="M10.133 13.333c0 0.884-0.716 1.6-1.6 1.6s-1.6-0.716-1.6-1.6c0-0.884 0.716-1.6 1.6-1.6s1.6 0.716 1.6 1.6z"/><path d="M18.667 13.333c0 0.884-0.716 1.6-1.6 1.6s-1.6-0.716-1.6-1.6c0-0.884 0.716-1.6 1.6-1.6s1.6 0.716 1.6 1.6z"/></svg>&nbsp;&nbsp;<strong class="nasa-count">...</strong>&nbsp;';
    $fake_view .= wp_kses(__('<strong>people</strong>&nbsp;are viewing this right now', 'nasa-core'), $allowed_html);
    $fake_view .= '</div>';
    
    /**
     * Output content fake view
     */
    echo apply_filters('nasa_fake_view_content', $fake_view, $product_id);
}

/**
 * Get Root Term id
 * 
 * @global type $wp_query
 * @global type $nasa_root_term_id
 * @global type $product
 * @global type $post
 * @return boolean
 */
function nasa_root_term_id() {
    if (!NASA_WOO_ACTIVED) {
        return false;
    }
    
    global $nasa_root_term_id;
    
    if (!isset($nasa_root_term_id)) {
        $is_product = is_product();
        $is_product_cat = is_product_category();
        $current_cat = null;
        
        /**
         * For Quick view
         */
        if (isset($_REQUEST['wc-ajax']) && $_REQUEST['wc-ajax'] === 'nasa_quick_view') {
            global $product;
            
            if (!$product) {
                return false;
            }

            $is_product = true;
        }

        $root_cat_id = 0;
        
        if ($is_product) {
            global $post;

            $product_cats = get_the_terms($post->ID, 'product_cat');
            if ($product_cats) {
                foreach ($product_cats as $cat) {
                    $current_cat = $cat;
                    if ($cat->parent == 0) {
                        break;
                    }
                }
            }
        }

        elseif ($is_product_cat) {
            global $wp_query;
            
            $current_cat = $wp_query->get_queried_object();
        }

        if ($current_cat && isset($current_cat->term_id)) {
            if (isset($current_cat->parent) && $current_cat->parent == 0) {
                $root_cat_id = $current_cat->term_id;
            } else {
                $ancestors = get_ancestors($current_cat->term_id, 'product_cat');
                $root_cat_id = end($ancestors);
            }
        }

        $GLOBALS['nasa_root_term_id'] = $root_cat_id ? $root_cat_id : 0;
        $nasa_root_term_id = $root_cat_id;
    }
    
    return $nasa_root_term_id;
}
