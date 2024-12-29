<?php
/**
 * Post type header
 */
add_action('init', 'nasa_register_header');
function nasa_register_header() {
    /**
     * Check WPBakery active
     */
    if (!NASA_WPB_ACTIVE && apply_filters('nasa_rules_upgrade', true)) {
        return;
    }
    
    $labels = array(
        'name' => __('Header', 'nasa-core'),
        'singular_name' => __('Header', 'nasa-core'),
        'all_items' => __('All Headers', 'nasa-core'),
        'add_new' => __('Add New Header', 'nasa-core'),
        'add_new_item' => __('Add New Header', 'nasa-core'),
        'edit_item' => __('Edit Header', 'nasa-core'),
        'new_item' => __('New Header', 'nasa-core'),
        'view_item' => __('View Header', 'nasa-core'),
        'search_items' => __('Search Header', 'nasa-core'),
        'not_found' => __('No Headers found', 'nasa-core'),
        'not_found_in_trash' => __('No Header found in Trash', 'nasa-core'),
        'parent_item_colon' => __('Parent Header:', 'nasa-core'),
        'menu_name' => __('Header Builder - WPBakery', 'nasa-core'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => __('List Headers', 'nasa-core'),
        'supports' => array('title', 'editor'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        // 'menu_position' => 4,
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'menu_icon' => 'dashicons-editor-table'
    );
    
    register_post_type('header', $args);

    if ($options = get_option('wpb_js_content_types')) {
        $check = true;
        foreach ($options as $value) {
            if ($value == 'header') {
                $check = false;
                break;
            }
        }
        if ($check) {
            $options[] = 'header';
        }
    } else {
        $options = array('page', 'header');
    }
    
    update_option('wpb_js_content_types', $options);
}

/**
 * Register Menu
 */
add_action('admin_menu', 'nasa_register_header_menu');
function nasa_register_header_menu() {
    /**
     * Check WPBakery active
     */
    if (!NASA_WPB_ACTIVE && apply_filters('nasa_rules_upgrade', true)) {
        return;
    }
    
    add_submenu_page(
        NASA_ADMIN_PAGE_SLUG,
        'Header Builder' . (NASA_WPB_ACTIVE ? ' (WPBakery)' : ''),
        'Header Builder' . (NASA_WPB_ACTIVE ? ' (WPBakery)' : ''),
        'edit_pages',
        'edit.php?post_type=header'
    );
}
