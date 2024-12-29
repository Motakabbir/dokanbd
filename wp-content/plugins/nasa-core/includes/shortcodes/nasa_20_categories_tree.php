<?php
/**
 * Shortcode [nasa_categories_tree ...]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_categories_tree($atts = array(), $content = null) {
    $dfAttr = array(
        'title' => '',
        'columns_number' => '6',
        'columns_number_small' => '2',
        'columns_number_tablet' => '4',
        'el_class' => '',
        'list_cats'=>'',
        'cat_product_count' => '0',
        'hide_cat_empty' => false
    );

    extract(shortcode_atts($dfAttr, $atts));
    
    $hide_cat_empty = isset($hide_cat_empty) && $hide_cat_empty ? true : false;
    $cat_product_count = isset($cat_product_count) && $cat_product_count ? '1' : '0';

    $args = array(
        'taxonomy' => 'product_cat',
        'hierarchical' => true,
        'hide_empty' => $hide_cat_empty,
        'parent' => 0
    );

    $all_cats = get_terms(apply_filters('woocommerce_product_attribute_terms', $args));

    $product_categories = array();
    $input_slug = array();

    if (trim($list_cats) !== '') {
        $input_cats = explode(',', trim($list_cats));

        if ($input_cats) {
            foreach ($input_cats as $cat) {
                $cat = trim($cat);
                if ($cat != '') {

                    $args = array(
                        'taxonomy' => 'product_cat',
                        'hierarchical' => true,
                        'hide_empty' => $hide_cat_empty
                    );

                    is_numeric($cat) ? $args['term_taxonomy_id'] = $cat : $args['slug'] = $cat;

                    $term_include = get_terms(apply_filters('woocommerce_product_attribute_terms', $args));

                    if ($term_include) {
                        $product_categories[] = reset($term_include);
                        $input_slug[] = reset($term_include)->slug;
                    }
                }
            }
        }
    }

    $cats = empty($product_categories)? $all_cats : $product_categories;

    $column_class = 'large-block-grid-' .  $columns_number . ' small-block-grid-' .  $columns_number_small . ' medium-block-grid-' .  $columns_number_tablet ;

    $column_class .= ($el_class && trim($el_class) !== '' ) ? ' ' . $el_class : '';

    $content = '<ul class="ns-categories-tree-warp ' . $column_class . '" data-columns="' . $columns_number . '" data-columns-small="' . $columns_number_small . '" data-columns-tablet="' . $columns_number_tablet . '">';

    $number_cat_each = floor(count($cats) / $columns_number);
    $leftover_cat = count($cats) % $columns_number;

    for ($i = 0; $i < $columns_number; $i++) {

        $number_cat = ($i < $leftover_cat) ? ($number_cat_each + 1) : $number_cat_each;
        $cats_splices = array_splice($cats, 0, $number_cat);

        $content .= '<li class="ns-categories-tree-column">';

        foreach ($cats_splices as $cats_splice ) {

            $cat_check = true;
            $count = '';

            if ($cat_product_count === '1') {
                $count = '<psan class="count">' . $cats_splice->count .'</span>';
            }

            $link = get_term_link($cats_splice, 'product_cat');
            $content .= '<div class="ns-cat-root">';  
            $content .= '<a class="ns-cat-tree-link nasa-bold" title="' . $cats_splice->slug . '" href="' . $link . '">' . $cats_splice->name . $count .  '</a>'; 
            $content .= nasa_gen_categories_tree_child($cats_splice,$input_slug,$cat_product_count,$hide_cat_empty);
            $content .= '</div>';
            
        }

        $content .= '</li>';

    }

    $content .= '</ul>';

    return $content;
    
}

function nasa_gen_categories_tree_child($cats,$input_slug,$is_count,$hide_empty) {
    $content_child ='';
    $args = array(
        'taxonomy' => 'product_cat',
        'hierarchical' => true,
        'hide_empty' => $hide_empty,
        'parent' => $cats->term_taxonomy_id
    );

    $childrens = get_terms(apply_filters('woocommerce_product_attribute_terms', $args));

    if(count($childrens) > 0 ) {
        $content_child = '<ul class="ns-cat-child">';

        foreach ($childrens as $children ) {

            $cat_check = true;
            $count = '';

            if ($is_count === '1') {
                $count = '<psan class="count">' . $children->count .'</span>';
            }

            if ($input_slug && !empty($input_slug)) {
                $hide = in_array($children->slug,$input_slug);
            }

            if (!$input_slug || empty($input_slug) || !$hide) {
                $link = get_term_link($children, 'product_cat');
                $content_child .= '<li>';  
                $content_child .= '<a class="ns-cat-tree-link" href="' . $link . '" title="' . $children->slug . '">' . $children->name . $count . '</a>'; 
                $content_child .= nasa_gen_categories_tree_child($children,$input_slug,$is_count,$hide_empty);
                $content_child .= '</li>';
            }
        }

        $content_child .= '</ul>';
    }

    return $content_child;
}

/* ==========================================================================
! Register New Element: Nasa Categories Directory
========================================================================== */  
function nasa_register_categories_tree(){
    vc_map(array(
        "name" => "Categories Directory",
        "base" => "nasa_categories_tree",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Display Categories Directory", 'nasa-core'),
        "class" => "",
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __('Title', 'nasa-core'),
                "param_name" => 'title'
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number", 'nasa-core'),
                "param_name" => "columns_number",
                "value" => array(6, 5, 4, 3, 2, 1),
                "std" => 6,
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Tablet", 'nasa-core'),
                "param_name" => "columns_number_tablet",
                "value" => array(4, 3, 2, 1),
                "std" => 3,
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Small", 'nasa-core'),
                "param_name" => "columns_number_small",
                "value" => array(3, 2, 1),
                "std" => 2,
                "admin_label" => true,
            ),

            array(
                "type" => "textfield",
                "heading" => __('Categories Included List', 'nasa-core'),
                "param_name" => 'list_cats',
                "value" => '',
                "admin_label" => true,
                "description" => __('Input list ID or Slug, separated by ",". Ex: 1, 2 or slug-1, slug-2', 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Count", 'nasa-core'),
                "param_name" => "cat_product_count",
                "value" => array(
                    __('No', 'nasa-core') => '0',
                    __('Yes', 'nasa-core') => '1'
                ),
                "std" => 'no',
                "admin_label" => true
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Hide Empty", 'nasa-core'),
                "param_name" => "hide_cat_empty",
                "value" => array(
                    __('No', 'nasa-core') => '0',
                    __('Yes', 'nasa-core') => '1'
                ),
                "std" => '0',
                "admin_label" => true
            ),

            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            ),
        )
    ));
}
