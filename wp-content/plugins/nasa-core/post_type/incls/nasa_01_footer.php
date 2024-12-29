<?php
/**
 * Post type footer
 */
add_action('init', 'nasa_register_footer');
function nasa_register_footer() {
    /**
     * Check WPBakery active
     */
    if (!NASA_WPB_ACTIVE && apply_filters('nasa_rules_upgrade', true)) {
        return;
    }
    
    $labels = array(
        'name' => __('Footer', 'nasa-core'),
        'singular_name' => __('Footer', 'nasa-core'),
        'all_items' => __('All Footers', 'nasa-core'),
        'add_new' => __('Add New', 'nasa-core'),
        'add_new_item' => __('Add New', 'nasa-core'),
        'edit_item' => __('Edit', 'nasa-core'),
        'new_item' => __('New', 'nasa-core'),
        'view_item' => __('View', 'nasa-core'),
        'search_items' => __('Search', 'nasa-core'),
        'not_found' => __('No Footers found', 'nasa-core'),
        'not_found_in_trash' => __('No Footers found in Trash', 'nasa-core'),
        'parent_item_colon' => __('Parent Footer:', 'nasa-core'),
        'menu_name' => __('Footer Builder - WPBakery', 'nasa-core'),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'description' => __('List Footer', 'nasa-core'),
        'supports' => array('title', 'editor'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        // 'menu_position' => 5,
        'show_in_nav_menus' => false,
        'capability_type' => 'post',
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'menu_icon' => 'dashicons-editor-underline'
    );
    
    register_post_type('footer', $args);
    
    $options = get_option('wpb_js_content_types');
    
    if ($options) {
        $check = true;
        
        foreach ($options as $value) {
            if ($value == 'footer') {
                $check = false;
                break;
            }
        }
        
        if ($check) {
            $options[] = 'footer';
        }
    } else {
        $options = array('page', 'footer');
    }
    
    update_option('wpb_js_content_types', $options);
}

/**
 * Register Menu
 */
add_action('admin_menu', 'nasa_register_footer_menu');
function nasa_register_footer_menu() {
    /**
     * Check WPBakery active
     */
    if (!NASA_WPB_ACTIVE && apply_filters('nasa_rules_upgrade', true)) {
        return;
    }
    
    add_submenu_page(
        NASA_ADMIN_PAGE_SLUG,
        'Footer Builder' . (NASA_WPB_ACTIVE ? ' (WPBakery)' : ''),
        'Footer Builder' . (NASA_WPB_ACTIVE ? ' (WPBakery)' : ''),
        'edit_pages',
        'edit.php?post_type=footer'
    );
}
