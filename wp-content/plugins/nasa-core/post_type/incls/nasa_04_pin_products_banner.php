<?php
/**
 * Post type nasa_pin_pb
 */
add_action('init', 'nasa_register_pin_products_banner');
function nasa_register_pin_products_banner() {
    $labels = array(
        'name' => __('Pin products banner', 'nasa-core'),
        'singular_name' => __('Pin products banner', 'nasa-core'),
        'add_new' => __('Add New', 'nasa-core'),
        'add_new_item' => __('Add New', 'nasa-core'),
        'edit_item' => __('Edit', 'nasa-core'),
        'new_item' => __('New', 'nasa-core'),
        'view_item' => __('View', 'nasa-core'),
        'search_items' => __('Search', 'nasa-core'),
        'not_found' => __('No items found', 'nasa-core'),
        'not_found_in_trash' => __('No items found in Trash', 'nasa-core'),
        'parent_item_colon' => __('Parent Item:', 'nasa-core'),
        'menu_name' => __('Banner Products', 'nasa-core')
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __('List items', 'nasa-core'),
        'supports' => array('title'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'menu_position' => 8,
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'rewrite' => false,
        'menu_icon' => 'dashicons-location-alt'
    );
    register_post_type('nasa_pin_pb', $args);

    if ($options = get_option('wpb_js_content_types')) {
        $check = true;
        foreach ($options as $key => $value) {
            if ($value == 'nasa_pin_pb') {
                $check = false;
                break;
            }
        }
        if ($check) {
            $options[] = 'nasa_pin_pb';
        }
    } else {
        $options = array('page', 'nasa_pin_pb');
    }
    
    update_option('wpb_js_content_types', $options);
}

/**
 * Register Menu
 */
add_action('admin_menu', 'nasa_register_pin_products_banner_menu');
function nasa_register_pin_products_banner_menu() {
    add_submenu_page(
        NASA_ADMIN_PAGE_SLUG,
        __('Banner Products', 'nasa-core'),
        __('Banner Products', 'nasa-core'),
        'edit_pages',
        'edit.php?post_type=nasa_pin_pb'
    );
}
