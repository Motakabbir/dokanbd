<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Custom Widgets
 */

add_action('widgets_init', 'nasa_cat_sidebar_override', 999);
function nasa_cat_sidebar_override() {
    $sidebar_cats = get_option('nasa_sidebars_cats');

    if (!empty($sidebar_cats)) {
        foreach ($sidebar_cats as $sidebar) {
            if (isset($sidebar['slug'])) {
                $name = esc_html__('Products Category: ', 'nasa-core') . (isset($sidebar['name']) ? ($sidebar['name'] . ' (' . $sidebar['slug'] . ')') : $sidebar['slug']);
                register_sidebar(array(
                    'name' => $name,
                    'id' => $sidebar['slug'],
                    'before_widget' => '<div id="%1$s" class="widget nasa-widget-store %2$s">',
                    'before_title' => '<span class="widget-title">',
                    'after_title' => '</span>',
                    'after_widget' => '</div>'
                ));
            }
        }
    }
}

/**
 * Includes Custom Widgets
 */
nasa_includes_files(glob(NASA_CORE_PLUGIN_PATH . 'includes/widgets/nasa_*.php'));

/**
 * Nasa Elementor Abstract Widget
 */
if (NASA_ELEMENTOR_ACTIVE) {
    /**
     * Register Widgets
     */
    require_once NASA_CORE_PLUGIN_PATH . 'elm-cores/nasa-elm-widgets-loader.php';
    
    $enable_convert_elmwp = true;
    
    /**
     * Not exists in Dashboard > widgets.php Page
     */
    if (NASA_CORE_IN_ADMIN) {
        global $pagenow;
        
        if (isset($pagenow) && $pagenow === 'widgets.php') {
            $enable_convert_elmwp = false;
        }
    }
    
    /**
     * Convert to WP Widgets
     */
    if (apply_filters('nasa_enable_convert_elmwp', $enable_convert_elmwp)) {
        require_once NASA_CORE_PLUGIN_PATH . 'elm-cores/nasa-elm-wp-widgets.php';
    }
    
    /**
     * Add custom javascript
     */
    add_action('elementor/editor/before_enqueue_scripts', 'nasa_add_script_elementor_editor');
    function nasa_add_script_elementor_editor() {
        wp_enqueue_style('nasa-elementor-style', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-elementor-style.css');
        
        wp_enqueue_script('jquery');
        wp_enqueue_script('nasa-elementor-script', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-elementor-script.js');
        
        $nasa_core_js = 'var nasa_elementor_ajax="' . esc_url(admin_url('admin-ajax.php')) . '";';
        wp_add_inline_script('nasa-elementor-script', $nasa_core_js, 'before');
    }
    
    /**
     * Ajax get list deal products
     */
    add_action('wp_ajax_nasa_products_deal_elementor', 'nasa_products_deal_elementor');
    function nasa_products_deal_elementor() {
        $ids = nasa_get_product_deal_ids();
        
        if (!empty($ids)) {
            foreach ($ids as $id) {
                $product = wc_get_product($id);
                
                if ($product) {
                    echo '<a href="javascript:void(0);" class="deal-product-item nasa-item" data-deal="' . esc_attr($product->get_id()) . '" data-name="' . esc_attr(strtolower($product->get_name())) . '">';
                    
                    echo $product->get_name();
                    
                    echo '<div class="info-content hidden-content">' .
                        '<div class="product-img">' .
                            $product->get_image('thumbnail') .
                        '</div>' .
                        '<p class="product-name">' .
                            $product->get_name() .
                        '</p>' .
                    '</div>';
                    
                    echo '</a>';
                }
            }
        }
        
        die();
    }
    
    /**
     * Ajax get list product Categories
     */
    add_action('wp_ajax_nasa_product_categories_elementor', 'nasa_product_categories_elementor');
    function nasa_product_categories_elementor() {
        $args = array(
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'hide_empty' => false
        );

        $categories = get_categories($args);

        if (!empty($categories)) {
            foreach ($categories as $category) {
                echo '<a href="javascript:void(0);" class="product-cat-item nasa-item" data-slug="' . esc_attr($category->slug) . '" data-name="' . esc_attr(strtolower($category->name)) . '">';
                    
                echo '<p class="category-name">';
                echo $category->name . ' ( ' . $category->slug . ' )';
                echo '</p>';

                echo '</a>';
            }
        }
        
        die();
    }
    
    /**
     * Ajax get list product Brands
     */
    add_action('wp_ajax_nasa_product_brands_elementor', 'nasa_product_brands_elementor');
    function nasa_product_brands_elementor() {
        global $nasa_opt;
        
        if (isset($nasa_opt['enable_nasa_brands']) && $nasa_opt['enable_nasa_brands']) {
            $args = array(
                'taxonomy' => 'product_brand',
                'orderby' => 'name',
                'hide_empty' => false
            );

            $brands = get_categories($args);

            if (!empty($brands)) {
                foreach ($brands as $brand) {
                    echo '<a href="javascript:void(0);" class="product-brand-item nasa-item" data-slug="' . esc_attr($brand->slug) . '" data-name="' . esc_attr(strtolower($brand->name)) . '">';

                    echo '<p class="brand-name">';
                    echo $brand->name . ' ( ' . $brand->slug . ' )';
                    echo '</p>';

                    echo '</a>';
                }
            }
        }
        
        die();
    }
    
    /**
     * Ajax get list product pwb-brand
     */
    add_action('wp_ajax_nasa_product_pwb_brands_elementor', 'nasa_product_pwb_brands_elementor');
    function nasa_product_pwb_brands_elementor() {
        if (defined('PWB_PLUGIN_NAME')) {
            $args = array(
                'taxonomy' => 'pwb-brand',
                'orderby' => 'name',
                'hide_empty' => false
            );

            $brands = get_categories($args);

            if (!empty($brands)) {
                foreach ($brands as $brand) {
                    echo '<a href="javascript:void(0);" class="product-pwb-brand-item nasa-item" data-slug="' . esc_attr($brand->slug) . '" data-name="' . esc_attr(strtolower($brand->name)) . '">';

                    echo '<p class="pwb-brand-name">';
                    echo $brand->name . ' ( ' . $brand->slug . ' )';
                    echo '</p>';

                    echo '</a>';
                }
            }
        }
        
        die();
    }
    
    /**
     * Ajax get list nav menus
     */
    add_action('wp_ajax_nasa_nav_menus_elementor', 'nasa_nav_menus_elementor');
    function nasa_nav_menus_elementor() {
        $menus = wp_get_nav_menus(array('orderby' => 'name'));

        if (!empty($menus)) {
            foreach ($menus as $menu) {
                echo '<a href="javascript:void(0);" class="nasa-nav-menu nasa-item" data-slug="' . esc_attr($menu->slug) . '" data-name="' . esc_attr(strtolower($menu->name)) . '">';
                    
                echo '<p class="menu-name">';
                echo $menu->name . ' ( ' . $menu->slug . ' )';
                echo '</p>';

                echo '</a>';
            }
        }
        
        die();
    }
    
    /**
     * Ajax get list Pins Banner
     */
    add_action('wp_ajax_nasa_pins_banner_elementor', 'nasa_pins_banner_elementor');
    function nasa_pins_banner_elementor() {
        $type = isset($_REQUEST['pin_type']) && in_array($_REQUEST['pin_type'], array('nasa_pin_pb', 'nasa_pin_mb','nasa_pin_mlpb')) ? $_REQUEST['pin_type'] : null;
        
        if (!$type) {
            die();
        }
        
        $pins = get_posts(array(
            'posts_per_page'    => -1,
            'post_status'       => 'publish',
            'post_type'         => $type
        ));

        if (!empty($pins)) {
            foreach ($pins as $pin) {
                echo '<a href="javascript:void(0);" class="pin-item nasa-item" data-slug="' . esc_attr($pin->post_name) . '" data-name="' . esc_attr(strtolower($pin->post_title)) . '">';
                    
                echo '<p class="pin-name">';
                echo $pin->post_title . ' ( ' . $pin->post_name . ' )';
                echo '</p>';

                echo '</a>';
            }
        }
        
        die();
    }
    
    /**
     * Ajax get list nav menus
     */
    add_action('wp_ajax_nasa_revs_elementor', 'nasa_revs_elementor');
    function nasa_revs_elementor() {
        if (!class_exists('RevSlider')) {
            echo '<a href="javascript:void(0);" class="rev-item nasa-item" data-slug="" data-name="">';
            echo '<p class="rev-name">';
            echo esc_html__('Please Install Revolution Slider Plugin to use this.', 'nasa-core');
            echo '</p>';

            echo '</a>';
            
            die();
        }
        
        $slider = new RevSlider();
        $revs = $slider->get_sliders();

        if (!empty($revs)) {
            foreach ($revs as $rev) {
                echo '<a href="javascript:void(0);" class="rev-item nasa-item" data-slug="' . esc_attr($rev->alias) . '" data-name="' . esc_attr(strtolower($rev->title)) . '">';
                    
                echo '<p class="rev-name">';
                echo $rev->title . ' ( ' . $rev->alias . ' )';
                echo '</p>';

                echo '</a>';
            }
        }
        
        die();
    }
    
    /**
     * Script in Back End
     */
    add_action('admin_enqueue_scripts', 'nasa_admin_script_wgs');
    function nasa_admin_script_wgs() {
        wp_enqueue_style('nasa-elementor-style', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-elementor-style.css');
        wp_enqueue_script('nasa-elementor-script', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-elementor-script.js');

        $nasa_core_js = 'var nasa_elementor_ajax="' . esc_url(admin_url('admin-ajax.php')) . '";';
        wp_add_inline_script('nasa-elementor-script', $nasa_core_js, 'before');
    }
    
    /**
     * For Preview Elementor Scrips
     */
    add_action('wp_enqueue_scripts', 'nasa_preview_enqueue_scripts', 999);
    function nasa_preview_enqueue_scripts() {
        if (isset($_REQUEST['elementor-preview']) && $_REQUEST['elementor-preview']) {
            /**
             * Open slick
             */
            wp_enqueue_script('nasa-open-slicks', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-open-slick.min.js', array('jquery-slick'), null, true);
            
            /**
             * Vertical slick
             */
            wp_enqueue_script('nasa-vertical-slicks', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-vertical-slick.min.js', array('jquery-slick'), null, true);
            
            /**
             * Pin Banner
             */
            wp_enqueue_script('jquery-easing', NASA_CORE_PLUGIN_URL . 'assets/js/min/jquery.easing.min.js', array('jquery'), null, true);
            wp_enqueue_script('jquery-easypin', NASA_CORE_PLUGIN_URL . 'assets/js/min/jquery.easypin.min.js', array('jquery'), null, true);
            
            /**
             * Compare images
             */
            wp_enqueue_script('hammer', NASA_CORE_PLUGIN_URL . 'assets/js/min/hammer.min.js', array('jquery'), null, true);
            wp_enqueue_script('jquery-images-compare', NASA_CORE_PLUGIN_URL . 'assets/js/min/jquery.images-compare.min.js', array('jquery'), null, true);
            
            /**
             * Nasa Instagram Feed
             */
            wp_enqueue_script('nasa-instagram-feed', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-instagram-feed.min.js', array('jquery'), null, true);
            
            /**
             * Masonry isotope
             */
            wp_enqueue_script('jquery-masonry-isotope', NASA_CORE_PLUGIN_URL . 'assets/js/min/jquery.masonry-isotope.min.js', array('jquery'), null, true);
            
            /**
             * Select 2
             */
            wp_enqueue_style('select2');
            wp_enqueue_script('select2');
            wp_enqueue_script('nasa-product-groups', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-product-groups.min.js', array('jquery'), null, true);
            
            /**
             * Live jQuery event
             */
            wp_enqueue_script('nasa-core-elementor-js', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa.script-elementor.min.js', array('nasa-core-js'), null, true);
            
            /**
             * Dequeue Contact form 7 js
             */
            if (function_exists('wpcf7')) {
                wp_deregister_script('contact-form-7');
                wp_dequeue_script('contact-form-7');
            }
            
            /**
             * Dequeue Back in stock notifier js
             */
            if (class_exists('CWG_Instock_Notifier') && NASA_WOO_ACTIVED) {
                wp_deregister_script('cwginstock_js');
                wp_dequeue_script('cwginstock_js');

                wp_deregister_script('sweetalert2');
                wp_dequeue_script('sweetalert2');

                wp_deregister_script('cwginstock_popup');
                wp_dequeue_script('cwginstock_popup');
            }
        }
    }
}
