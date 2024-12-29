<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Get Role Filter Price
 */
if (!function_exists('elessi_get_filtered_price')) :
    function elessi_get_filtered_price() {
        global $wpdb;

        $args       = WC()->query->get_main_query()->query_vars;
        $tax_query  = isset($args['tax_query']) ? $args['tax_query'] : array();
        $meta_query = isset($args['meta_query']) ? $args['meta_query'] : array();

        if (!is_post_type_archive('product') && !empty($args['taxonomy']) && !empty($args['term'])) {
            $tax_query[] = WC()->query->get_main_tax_query();
        }

        foreach ($meta_query + $tax_query as $key => $query) {
            if (!empty($query['price_filter']) || ! empty($query['rating_filter'])) {
                unset($meta_query[$key]);
            }
        }

        $meta_query = new WP_Meta_Query($meta_query);
        $tax_query  = new WP_Tax_Query($tax_query);
        $search     = WC_Query::get_main_search_query_sql();

        $meta_query_sql   = $meta_query->get_sql('post', $wpdb->posts, 'ID');
        $tax_query_sql    = $tax_query->get_sql($wpdb->posts, 'ID');
        $search_query_sql = $search ? ' AND ' . $search : '';

        $sql = "
            SELECT min(min_price) as min_price, MAX(max_price) as max_price
            FROM {$wpdb->wc_product_meta_lookup}
            WHERE product_id IN (
                SELECT ID FROM {$wpdb->posts}
                " . $tax_query_sql['join'] . $meta_query_sql['join'] . "
                WHERE {$wpdb->posts}.post_type IN ('" . implode("','", array_map('esc_sql', apply_filters('woocommerce_price_filter_post_type', array('product')))) . "')
                AND {$wpdb->posts}.post_status = 'publish'
                " . $tax_query_sql['where'] . $meta_query_sql['where'] . $search_query_sql . '
            )';

        $sql = apply_filters('woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql);

        return $wpdb->get_row($sql); // WPCS: unprepared SQL ok.
    }
endif;

/**
 * Variation content widget
 */
if (!function_exists('elessi_get_content_widget_variation')) :
    function elessi_get_content_widget_variation($args, $instance) {
        $args = array('widget_id' => $args['widget_id']);

        $hide_widget = false;
        $hide_empty = isset($instance['hide_empty']) && $instance['hide_empty'] ? true : false;
        $var_exist = $hide_empty ? false : true;
        
        $columns_classic = isset($instance['cols']) && in_array($instance['cols'], array('1', '2')) ? $instance['cols'] : '2';
        $columns_classic_class = ' ns-cols-' . $columns_classic;

        $taxonomy = isset($instance['attribute']) ? wc_attribute_taxonomy_name($instance['attribute']) : '';

        if (!taxonomy_exists($taxonomy)) {
            $hide_widget = true;
            return array('hide_widget' => $hide_widget, 'content' => '');
        }

        $content = '<div id="' . esc_attr($args['widget_id']) . '-ajax-wrap" class="nasa-filter-variations-widget-wrap">';

        $query_type = isset($instance['query_type']) ? $instance['query_type'] : 'or';
        $terms_args = array('taxonomy' => $taxonomy, 'hide_empty' => $hide_empty);
        $orderby = wc_attribute_orderby($taxonomy);

        switch ($orderby) {
            case 'name' :
                $terms_args['orderby'] = 'name';
                $terms_args['menu_order'] = false;
                break;
            
            case 'id' :
                $terms_args['orderby'] = 'id';
                $terms_args['order'] = 'ASC';
                $terms_args['menu_order'] = false;
                break;
            
            case 'menu_order' :
            default:
                $terms_args['menu_order'] = 'ASC';
                break;
        }

        $terms = get_terms(apply_filters('woocommerce_product_attribute_terms', $terms_args));

        $hasResult = false;
        $count_terms = $terms ? count($terms) : 0;
        if (0 < $count_terms) {
            $term_counts = elessi_get_filtered_term_product_counts(wp_list_pluck($terms, 'term_id'), $taxonomy, $query_type);

            $attr_name = 0 === strpos($taxonomy, 'pa_') ? substr($taxonomy, 3) : $taxonomy;
            $filter_name = 'filter_' . $attr_name;
            $current_filter = array();
            
            if (isset($_GET[$filter_name]) && $_GET[$filter_name] != '') {
                $current_filter = is_array($_GET[$filter_name]) ?
                    $_GET[$filter_name] : explode(',', wc_clean($_GET[$filter_name]));
            }

            $current_filter = !empty($current_filter) ? array_map('sanitize_title', $current_filter) : $current_filter;
            
            $vari_type = 'default';
            $taxonomyObj = null;
            $color_size = false;

            $color_switch = 'color';
            $label_switch = 'label';
            $image_switch = 'image';
            
            if ($nasa_attr_ux_exist = class_exists('Nasa_Abstract_WC_Attr_UX')) {
                $taxonomyObj = Nasa_Abstract_WC_Attr_UX::get_tax_attribute($taxonomy);
                $color_switch = Nasa_Abstract_WC_Attr_UX::_NASA_COLOR;
                $label_switch = Nasa_Abstract_WC_Attr_UX::_NASA_LABEL;
                $image_switch = Nasa_Abstract_WC_Attr_UX::_NASA_IMAGE;
            }

            $class_ul = ' small-block-grid-1 medium-block-grid-4 large-block-grid-5';
            
            $brand_items = false;
            
            if ($taxonomyObj && isset($taxonomyObj->attribute_type)) {
                $color_size = true;
                
                switch ($taxonomyObj->attribute_type) {
                    case $color_switch:
                        $vari_type = 'color';
                        $class_ul = ' small-block-grid-2 medium-block-grid-4 large-block-grid-7';
                        break;

                    case $label_switch:
                        $vari_type = 'size';
                        $class_ul = ' small-block-grid-2 medium-block-grid-4 large-block-grid-7';
                        break;

                    case $image_switch:
                        $vari_type = 'image';
                        
                        global $nasa_opt;
                        
                        $brands = array();
                        
                        $nasa_brands = isset($nasa_opt['attr_brands']) && !empty($nasa_opt['attr_brands']) ?
                            $nasa_opt['attr_brands'] : array();
                        
                        if (!empty($nasa_brands)) {
                            foreach ($nasa_brands as $key => $val) {
                                if ($val === '1') {
                                    $brands[] = $key;
                                }
                            }
                        }
                        
                        if (!empty($brands) && in_array($attr_name, $brands)) {
                            $class_ul = ' nasa-variation-filters-brands small-block-grid-2 medium-block-grid-4 large-block-grid-6';
                            $brand_items = true;
                        }
                        
                        break;

                    default :
                        $color_size = false;
                        break;
                }
            }
            
            $class_ul .= $columns_classic_class;

            $show_items = isset($instance['show_items']) ? (int) $instance['show_items'] : 0;

            // Current term
            $queryObj = get_queried_object();
            $current_term_slug = absint((is_tax() && isset($queryObj->slug)) ? $queryObj->slug : 0);

            $_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();
            $content_li = '';
            
            foreach ($terms as $k => $term) {
                $count = isset($term_counts[$term->term_id]) ? $term_counts[$term->term_id] : 0;
                $term_meta = $color_size ? get_term_meta($term->term_id, $taxonomyObj->attribute_type, true) : null;
                $vari_txt = ($vari_type == 'size' && trim($term_meta) != '') ? $term_meta : $term->name;
                
                $content_text = '<span class="nasa-text-variation nasa-text-variation-' . $vari_type . '">';
                $content_text .= $vari_txt;
                $content_text .= '</span>';

                /**
                 * Link
                 */
                $current_filter_term = $current_filter;
                $current_values = isset($_chosen_attributes[$taxonomy]['terms']) ? $_chosen_attributes[$taxonomy]['terms'] : array();
                $option_is_set = in_array($term->slug, $current_values);

                if (!in_array($term->slug, $current_filter_term)) {
                    $current_filter_term[] = $term->slug;
                }
                
                $link = elessi_get_page_base_url($taxonomy);

                // Add current filters to URL.
                foreach ($current_filter_term as $key => $value) {
                    // Exclude query arg for current term archive term
                    if ($value === $current_term_slug) {
                        unset($current_filter_term[$key]);
                    }

                    // Exclude self so filter can be unset on click.
                    if ($option_is_set && $value === $term->slug) {
                        unset($current_filter_term[$key]);
                    }
                }

                if (!empty($current_filter_term)) {
                    $link = add_query_arg($filter_name, implode(',', $current_filter_term), $link);

                    // Add Query type Arg to URL
                    if ('or' === $query_type && !(1 === sizeof($current_filter_term) && $option_is_set)) {
                        $attr_name = 0 === strpos($taxonomy, 'pa_') ? substr($taxonomy, 3) : $taxonomy;
                        $link = add_query_arg('query_type_' . sanitize_title($attr_name), 'or', $link);
                    }
                    
                    // $link = str_replace('%2C', ',', $link);
                }

                if ($count > 0 || $option_is_set) {
                    $link = apply_filters('woocommerce_layered_nav_link', $link, $term, $taxonomy);
                }

                /**
                 * Current Filter = this widget
                 */
                $aclass = 'nasa-filter-by-variations nasa-filter-by-attrs';
                $class = '';
                if (isset($current_filter) && is_array($current_filter) && in_array($term->slug, $current_filter)) {
                    $class .= ' chosen nasa-chosen';
                    $aclass .= ' nasa-filter-var-chosen';
                }

                $countClss = 'count';
                if ($vari_type != '') {
                    $class .= ' nasa-li-filter-' . $vari_type;
                    $aclass .= ' nasa-filter-' . $vari_type;
                    $countClss .= ' nasa-count-filter-' . $vari_type;
                }
                
                $aclass .= $brand_items ? ' nasa-filter-brand-item' : '';

                if ($count) {
                    $hasResult = true;
                    $var_exist = true;
                } elseif (!$count && $hide_empty) {
                    $class .= ' nasa-empty-hidden';
                    $show_items = $show_items > 0 ? $show_items += 1 : $show_items;
                }

                $attr_name = 0 === strpos($term->taxonomy, 'pa_') ? substr($term->taxonomy, 3) : $term->taxonomy;
                $attr = esc_attr(sanitize_title($attr_name));
                $liClass = ($k % 2 == 0) ? 'nasa-odd' : 'nasa-even';

                $liClass .= ' no-hidden';
                // $style = ($vari_type == 'color') ? ' style="background:' . esc_attr($term_meta) . '"' : '';

                $liClass .= ($show_items > 0 && $k >= $show_items) ? ' nasa-show-less' : '';

                $content_li .= '<li class="' . $liClass . $class . ' nasa-attr-' . $attr . ' nasa_' . $attr . '_' . esc_attr($term->term_id) . '">';

                $content_li .= 
                '<a ' .
                    'class="' . $aclass . '" ' .
                    'title="' . esc_attr($vari_txt) . '" ' .
                    'href="' . esc_url($link) . '"' .
                '>';
                
                if (($vari_type == 'color')) {
                    $colors = $term_meta ? explode(',', $term_meta) : array();
                    $colors = apply_filters('ns_attr_color_arr', $colors);
                    
                    $color_html = '<span class="nasa-filter-color-span nasa-flex ns-colors-wrap">';

                    if (isset($colors[0])) {
                        $color_html .= '<span style="background-color:' . esc_attr($colors[0]) . ';"></span>';
                    }

                    if (isset($colors[1])) {
                        $color_html .= '<span style="background-color:' . esc_attr($colors[1]) . ';"></span>';
                    }

                    $color_html .= '</span>';
                    
                    $content_li .= $color_html;
                }

                // $content_li .= $vari_type == 'color' ? '<span class="nasa-filter-color-span" ' . $style . '></span>' : '';

                if ($vari_type == 'image' && $nasa_attr_ux_exist) {
                    if (class_exists('Nasa_Abstract_WC_Attr_UX')) {
                        $image_size = $brand_items ? 'full' : 28;
                        $img_html = Nasa_Abstract_WC_Attr_UX::get_image_preview($term_meta, false, $image_size, 28, $vari_txt);
                    } else {
                        $img_html = wp_get_attachment_image($term_meta, 'thumbnail', false, array('alt' => $vari_txt, 'class' => 'attr-image-preview'));
                    }
                    
                    $img_html = $img_html ? $img_html : wc_placeholder_img();
                    
                    $content_li .= '<span class="nasa-filter-image-span">' . $img_html . '</span>';
                }

                $content_li .= $content_text;
                
                if (isset($instance['count']) && $instance['count']) {
                    $content_li .= ' <span class="' . $countClss . '">' . $count . '</span>';
                }
                
                $content_li .= '</a>';
                
                $content_li .= '</li>';
            }

            $hide_widget = !$hasResult && $hide_empty ? true : false;
            if (!$hide_widget && !$var_exist) {
                $hide_widget = true;
            }

            if ($hide_widget) {
                return array('hide_widget' => $hide_widget, 'content' => '');
            }

            $content_ul = '<ul class="nasa-variation-filters nasa-variations-' . $vari_type . $class_ul . '">';

            $fadeIn = (isset($instance['effect']) && $instance['effect'] == 'fade') ? '1' : '0';
            $content_li .= ($show_items && ($count_terms > $show_items)) ?
                '<li class="nasa_show_manual" data-fadein="' . $fadeIn . '">' .
                    '<a data-show="1" class="nasa-show-more" href="javascript:void(0);" data-text="' . esc_attr__('- Show less', 'elessi-theme') . '" rel="nofollow">' .
                        esc_html__('+ Show more', 'elessi-theme') .
                    '</a>' .
                '</li>' : '';

            $content .= $content_ul . $content_li . '</ul></div>';

            return array('hide_widget' => $hide_widget, 'content' => $content);
        }

        return array('hide_widget' => true, 'content' => '');
    }
endif;

/**
 * Get term count variations
 */
if (!function_exists('elessi_get_filtered_term_product_counts')) :
    function elessi_get_filtered_term_product_counts($term_ids, $taxonomy, $query_type) {
        if (function_exists('wc_get_container') && class_exists('Automattic\WooCommerce\Internal\ProductAttributesLookup\Filterer')) {
            return wc_get_container()->get(Automattic\WooCommerce\Internal\ProductAttributesLookup\Filterer::class)->get_filtered_term_product_counts($term_ids, $taxonomy, $query_type);
        }
    
        global $wpdb;

        $meta_query = WC_Query::get_main_meta_query();
        $tax_query = WC_Query::get_main_tax_query();

        if ('or' === $query_type) {
            foreach ($tax_query as $key => $query) {
                if (isset($query['taxonomy']) && $taxonomy === $query['taxonomy']) {
                    unset($tax_query[$key]);
                }
            }
        }

        $meta_query = new WP_Meta_Query($meta_query);
        $tax_query = new WP_Tax_Query($tax_query);
        $meta_query_sql = $meta_query->get_sql('post', $wpdb->posts, 'ID');
        $tax_query_sql = $tax_query->get_sql($wpdb->posts, 'ID');

        // Generate query
        $query = array();
        $query['select'] = 'SELECT COUNT(DISTINCT ' . $wpdb->posts . '.ID) as term_count, terms.term_id as term_count_id';

        $query['from'] = 'FROM ' . $wpdb->posts;

        $query['join'] = 'INNER JOIN ' . $wpdb->term_relationships . ' AS term_relationships ON ' . $wpdb->posts . '.ID = term_relationships.object_id ' .
            'INNER JOIN ' . $wpdb->term_taxonomy . ' AS term_taxonomy USING(term_taxonomy_id) ' .
            'INNER JOIN ' . $wpdb->terms . ' AS terms USING(term_id) ' .
            $tax_query_sql['join'] . $meta_query_sql['join'];

        $query['where'] = 'WHERE ' . $wpdb->posts . '.post_type LIKE "product" ' .
            'AND ' . $wpdb->posts . '.post_status LIKE "publish" ' .
            $tax_query_sql['where'] . $meta_query_sql['where'] . ' ' .
            'AND terms.term_id IN (' . implode(',', array_map('absint', $term_ids)) . ')';

        // For search case
        if (isset($_GET['s']) && $_GET['s']) {
            $s = esc_sql(str_replace(array("\r", "\n"), '', stripslashes($_GET['s'])));

            $query['where'] .= ' AND (' . $wpdb->posts . '.post_title LIKE "%' . $s . '%" OR ' . $wpdb->posts . '.post_excerpt LIKE "%' . $s . '%" OR ' . $wpdb->posts . '.post_content LIKE "%' . $s . '%")';
        }

        $query['group_by'] = "GROUP BY terms.term_id";
        $queryString = implode(' ', apply_filters('woocommerce_get_filtered_term_product_counts_query', $query));
        $results = $wpdb->get_results($queryString);

        return wp_list_pluck($results, 'term_count', 'term_count_id');
    }
endif;

/**
 * Return the currently viewed term slug.
 * @return int
 */
if (!function_exists('elessi_get_current_term_slug')) :
    function elessi_get_current_term_slug() {
        return absint(is_tax() ? get_queried_object()->slug : 0);
    }
endif;

/**
 * Get current page URL for layered nav items.
 * @return string
 */
if (!function_exists('elessi_get_page_base_url')) :
    function elessi_get_page_base_url($taxonomy) {
        if (defined('SHOP_IS_ON_FRONT')) {
            $link = home_url('/');
        } elseif (is_post_type_archive('product') || is_page(wc_get_page_id('shop'))) {
            $link = get_post_type_archive_link('product');
        } elseif (is_product_category()) {
            $link = get_term_link(get_query_var('product_cat'), 'product_cat');
        } elseif (is_product_tag()) {
            $link = get_term_link(get_query_var('product_tag'), 'product_tag');
        } else {
            $queried_object = get_queried_object();
            $link = get_term_link($queried_object, $queried_object->taxonomy);
        }

        /**
         * Custom taxonomy
         */
        if (class_exists('Nasa_WC_Taxonomy')) {
            $nasa_taxonomy = apply_filters('nasa_taxonomy_custom_cateogory', Nasa_WC_Taxonomy::$nasa_taxonomy);
            if (isset($_GET[$nasa_taxonomy])) {
                $link = add_query_arg($nasa_taxonomy, wc_clean(wp_unslash($_GET[$nasa_taxonomy])), $link);
            }
        }

        /**
         * Min
         */
        if (isset($_GET['min_price'])) {
            $link = add_query_arg('min_price', wc_clean(wp_unslash($_GET['min_price'])), $link);
        }

        /**
         * Max
         */
        if (isset($_GET['max_price'])) {
            $link = add_query_arg('max_price', wc_clean(wp_unslash($_GET['max_price'])), $link);
        }

        /**
         * Orderby
         */
        if (isset($_GET['orderby'])) {
            $link = add_query_arg('orderby', wc_clean(wp_unslash($_GET['orderby'])), $link);
        }

        /**
         * Search Arg.
         * To support quote characters, first they are decoded from &quot; entities, then URL encoded.
         */
        if (get_search_query()) {
            $link = add_query_arg('s', rawurlencode(wp_specialchars_decode(get_search_query())), $link);
        }

        /**
         * Post Type Arg
         */
        if (isset($_GET['post_type'])) {
            $link = add_query_arg('post_type', wc_clean(wp_unslash($_GET['post_type'])), $link);
            
            /**
             * Prevent post type and page id when pretty permalinks are disabled.
             */
            if (is_shop()) {
                $link = remove_query_arg('page_id', $link);
            }
        }

        /**
         * Min Rating Arg
         */
        if (isset($_GET['rating_filter'])) {
            $link = add_query_arg('rating_filter', wc_clean(wp_unslash($_GET['rating_filter'])), $link);
        }
        
        /**
         * Filter Status
         */
        if (class_exists('Elessi_WC_Widget_Status_Filter')) {
            foreach (Elessi_WC_Widget_Status_Filter::$_status as $status) {
                if (isset($_GET[$status]) && $_GET[$status] === '1') {
                    $link = add_query_arg($status, '1', $link);
                }
            }
        }

        /**
         * Filter Alphabet
         */
        if (class_exists('Elessi_WC_Widget_Alphabet_Filter')) {
            $alpha_rq = Elessi_WC_Widget_Alphabet_Filter::$_request_name;
            if (isset($_GET[$alpha_rq]) && in_array($_GET[$alpha_rq], Elessi_WC_Widget_Alphabet_Filter::$_alphabet)) {
                $link = add_query_arg($alpha_rq, wc_clean(wp_unslash($_GET[$alpha_rq])), $link);
            }
        }
        
        /**
         * Filter Multi Tags
         */
        if (class_exists('Elessi_WC_Widget_Tags_Filter')) {
            if (isset($_GET[Elessi_WC_Widget_Tags_Filter::$_request_name]) && !empty($_GET[Elessi_WC_Widget_Tags_Filter::$_request_name])) {
                $link = add_query_arg(Elessi_WC_Widget_Tags_Filter::$_request_name, wc_clean(wp_unslash($_GET[Elessi_WC_Widget_Tags_Filter::$_request_name])), $link);
            }
        }

        /**
         * Filter Multi Categories
         */
        if (class_exists('Elessi_WC_Widget_Multi_Categories_Filter')) {
            if (isset($_GET[Elessi_WC_Widget_Multi_Categories_Filter::$_request_name]) && !empty($_GET[Elessi_WC_Widget_Multi_Categories_Filter::$_request_name])) {
                $link = add_query_arg(Elessi_WC_Widget_Multi_Categories_Filter::$_request_name, wc_clean(wp_unslash($_GET[Elessi_WC_Widget_Multi_Categories_Filter::$_request_name])), $link);
            }
        }

        /**
         * All current filters
         */
        if ($_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes()) {
            $taxonomy = wc_attribute_taxonomy_slug($taxonomy);
            
            foreach ($_chosen_attributes as $name => $data) {
                $filter_name = wc_attribute_taxonomy_slug($name);
                if ($taxonomy == $filter_name) {
                    continue;
                }
                
                if (!empty($data['terms'])) {
                    $link = add_query_arg('filter_' . $filter_name, implode(',', $data['terms']), $link);
                }
                if ('or' === $data['query_type']) {
                    $link = add_query_arg('query_type_' . $filter_name, 'or', $link);
                }
            }
        }
        
        return apply_filters('nasa_page_base_url', $link);
    }
endif;

/**
 * Get current page URL Origin Not Request GET.
 * @return string
 */
if (!function_exists('elessi_get_origin_url')) :
    function elessi_get_origin_url($remove_query = array('page', 'paged', 'product-page')) {
        global $wp;
        
        $nasa_origin_url = get_option('permalink_structure') == '' ?
            remove_query_arg($remove_query, add_query_arg($wp->query_string, '', home_url(trailingslashit($wp->request)))) :
            preg_replace('%\/page/[0-9]+%', '', home_url(trailingslashit($wp->request)));
        
        return apply_filters('nasa_origin_url', $nasa_origin_url);
    }
endif;

/**
 * Get current page URL Origin Not Request GET But Has Paged.
 * @return string
 */
if (!function_exists('elessi_get_origin_url_paging')) :
    function elessi_get_origin_url_paging($exc = array()) {
        global $wp, $nasa_origin_url_paging;
        
        if (!isset($nasa_origin_url_paging)) {
            $nasa_origin_url_paging = get_option('permalink_structure') == '' ?
                add_query_arg($wp->query_string, '', home_url(trailingslashit($wp->request))) :
                home_url(trailingslashit($wp->request));

            $GLOBALS['nasa_origin_url_paging'] = $nasa_origin_url_paging;
        }
        
        /**
         * Exclude
         */
        if (!empty($exc)) {
            foreach ($exc as $get) {
                if (isset($_GET[$get])) {
                    $nasa_origin_url_paging = add_query_arg($get, esc_attr($_GET[$get]), $nasa_origin_url_paging);
                }
            }
        }
        
        return apply_filters('nasa_origin_url_paging', $nasa_origin_url_paging);
    }
endif;

/**
 * Remove defaults widgets of Woocommerce
 */
// add_action('init', 'elessi_remove_default_wg_woo');
if (!function_exists('elessi_remove_default_wg_woo')) :
    function elessi_remove_default_wg_woo() {
        global $nasa_opt;

        if ((!isset($nasa_opt['disable_ajax_product']) || !$nasa_opt['disable_ajax_product'])) {
            unregister_widget('WC_Widget_Price_Filter');
            unregister_widget('WC_Widget_Layered_Nav');
            unregister_widget('WC_Widget_Layered_Nav_Filters');
            unregister_widget('WC_Widget_Rating_Filter');
            unregister_widget('WC_Widget_Product_Search');
        }
    }
endif;
