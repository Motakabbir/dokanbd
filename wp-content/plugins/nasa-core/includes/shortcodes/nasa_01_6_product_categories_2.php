<?php
/**
 * Shortcode [nasa_product_categories_2 ...]
 * 
 * @global type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_product_categories_2($atts = array(), $content = null) {
    global $nasa_opt;
    
    if (!NASA_WOO_ACTIVED) {
        return $content;
    }
    
    $dfAttr = array(
        'root_cat' => '',
        'number' => '7',
        'orderby' => 'menu_order',
        'hide_empty' => 1,
        'columns_number' => '1',
        'columns_number_small' => '1',
        'columns_number_tablet' => '1',
        'shop_url' => '1',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    if (trim($root_cat) == '') {
        return '';
    }

    /**
     * Cache short-code
     */
    $key = false;
    if (isset($nasa_opt['nasa_cache_shortcodes']) && $nasa_opt['nasa_cache_shortcodes']) {
        $key = nasa_key_shortcode('nasa_product_categories_2', $dfAttr, $atts);
        $content = nasa_get_cache_shortcode($key);
    }
    
    if (!$content) {
        $root_category = get_term_by('slug', $root_cat, 'product_cat');
        
        if ($root_category) {
            $el_class = trim($el_class) != '' ? ' ' . esc_attr($el_class) : '';
            
            $hide_empty = (bool) $hide_empty ? 1 : 0;

            $args = array(
                'taxonomy' => 'product_cat',
                'parent' => $root_category->term_id,
                'hide_empty' => $hide_empty,
                'pad_counts' => true,
                'number' => apply_filters('nasa_cat_grid_limit_item', (int) $number)
            );

            if ($orderby == 'menu_order') {
                $args['menu_order'] = 'asc';
            } else {
                $args['orderby'] = 'title';
            }

            if (!isset($nasa_opt['show_uncategorized']) || !$nasa_opt['show_uncategorized']) {
                $args['exclude'] = get_option('default_product_cat');
            }

            $product_categories = get_terms(apply_filters('nasa_sc_product_categories_args', $args));
            
            $template = 'products/nasa_product_categories/content-product_cat_child_items.php';
            $nasa_args = array(
                'number' => $number,
                'orderby' => $orderby,
                'hide_empty' => $hide_empty,
                'columns_number' => $columns_number,
                'columns_number_small' => $columns_number_small,
                'columns_number_tablet' => $columns_number_tablet,
                'shop_url' => $shop_url,
                'el_class' => $el_class,
                'root_category' => $root_category,
                'product_categories' => $product_categories
            );

            nasa_template($template, $nasa_args);
            $content = ob_get_clean();
            
            if ($content) {
                nasa_set_cache_shortcode($key, $content);
            }
        }
    }
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: Product Categories V2
// **********************************************************************//    
function nasa_register_product_categories_2(){
    $params = array(
        "name" => "Product Categories - Child Items",
        "base" => "nasa_product_categories_2",
        "icon" => "icon-wpb-nasatheme",
        'description' => __("Display Child of Product Categories.", 'nasa-core'),
        "category" => "Nasa Core",
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __("Root Product Category", 'nasa-core'),
                "param_name" => "root_cat",
                "admin_label" => true,
                "value" => nasa_get_cat_product_array()
            ),

            array(
                "type" => "textfield",
                "heading" => __('Limit Child Items to display', 'nasa-core'),
                "param_name" => 'number',
                "value" => '7'
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Order By', 'nasa-core'),
                "param_name" => 'orderby',
                "value" => array(
                    __('Menu Order', 'nasa-core') => 'menu_order',
                    __('Name', 'nasa-core') => 'name'
                ),
                "std" => 'menu_order'
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Hide empty categories', 'nasa-core'),
                "param_name" => 'hide_empty',
                "value" => array(
                    __('Yes, Please!', 'nasa-core') => '1',
                    __('No, Thanks!', 'nasa-core') => '0'
                ),
                "std" => '1'
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Columns Number', 'nasa-core'),
                "param_name" => 'columns_number',
                "value" => array(4, 3, 2, 1),
                "std" => 1
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Small", 'nasa-core'),
                "param_name" => "columns_number_small",
                "value" => array(2, 1),
                "std" => 1
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Tablet", 'nasa-core'),
                "param_name" => "columns_number_tablet",
                "value" => array(3, 2, 1),
                "std" => 1
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Shop URL', 'nasa-core'),
                "param_name" => 'shop_url',
                "value" => array(
                    __('Yes, Please!', 'nasa-core') => '1',
                    __('No, Thanks!', 'nasa-core') => '0'
                ),
                "std" => '1'
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Extra Class", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'nasa-core')
            )
        )
    );

    vc_map($params);
}
