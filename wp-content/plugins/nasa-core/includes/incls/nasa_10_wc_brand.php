<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Instantiate Class
 */
add_action('init', array('Nasa_WC_Brand', 'getInstance'));

/**
 * Class Nasa Woocommerce Brand
 */
class Nasa_WC_Brand {

    /**
     * instance of the class
     */
    protected static $instance = null;

    /**
     * Taxonomy slug
     */
    public static $nasa_taxonomy = 'product_brand';
    
    /**
     * Rewrite URI
     * 
     * @var type 
     */
    public static $nasa_rewrite = 'product-brand';
    
    /**
     * Brands in loops
     */
    public $loop_brands = null;

    /**
     * Instance
     */
    public static function getInstance() {
        global $nasa_opt;

        if (!isset($nasa_opt['enable_nasa_brands']) || !$nasa_opt['enable_nasa_brands']) {
            return null;
        }

        if (null == self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor.
     */
    public function __construct() {
        if (!NASA_WOO_ACTIVED) {
            return null;
        }
        
        /**
         * Register custom taxonomy Nasa Product Categories
         */
        $this->register_taxonomy();
        
        /**
         * init Item loop brands
         */
        add_action('woocommerce_before_shop_loop_item', array($this, 'loop_product_brands_init'));
        
        /**
         * End Item loop brands
         */
        add_action('woocommerce_after_shop_loop_item', array($this, 'loop_product_brands_end'));
        
        /**
         * Show in Loop
         */
        add_action('woocommerce_shop_loop_item_title', array($this, 'loop_product_brands'), 10);
        
        /**
         * Show in Single Product
         */
        add_action('woocommerce_single_product_summary', array($this, 'single_product_brands_logo'), 22);
        
        /**
         * Show in Quick view
         */
        add_action('woocommerce_single_product_lightbox_summary', array($this, 'single_product_brands_logo'), 17);
        
        /**
         * Add Shortcode [nasa_product_brands ...]
         */
        add_shortcode('nasa_product_brands', array($this, 'product_brands_sc'));
        
        /**
         * Add Shortcode [nasa_product_brands_anphabet ...]
         */
        add_shortcode('nasa_product_brands_anphabet', array($this, 'product_brands_sc_2'));
    }

    /**
     * Register taxonomy for nasa product cat
     *
     * @return void
     */
    public function register_taxonomy() {
        self::$nasa_taxonomy = apply_filters('nasa_taxonomy_brand', self::$nasa_taxonomy);
        self::$nasa_rewrite = get_option('nasa_product_brand_permalink', 'product-brand');

        $labels = array(
            'name' => _x('Brands', 'taxonomy general name', 'nasa-core'),
            'singular_name' => _x('Brand', 'taxonomy singular name', 'nasa-core'),
            'search_items' => __('Search Brands', 'nasa-core'),
            'all_items' => __('All Brands', 'nasa-core'),
            'parent_item' => __('Parent Brand', 'nasa-core'),
            'parent_item_colon' => __('Parent Brand:', 'nasa-core'),
            'edit_item' => __('Edit', 'nasa-core'),
            'update_item' => __('Update', 'nasa-core'),
            'add_new_item' => __('Add New', 'nasa-core'),
            'new_item_name' => __('New Brand', 'nasa-core'),
        );

        register_taxonomy(self::$nasa_taxonomy, array('product'), array(
            'public' => true,
            'show_admin_column' => true,
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'capabilities' => apply_filters('nasa_taxonomy_capabilities',
                array(
                    'manage_terms' => 'manage_product_terms',
                    'edit_terms'   => 'edit_product_terms',
                    'delete_terms' => 'delete_product_terms',
                    'assign_terms' => 'assign_product_terms',
                )
            ),
            'rewrite' => array(
                'slug'         => self::$nasa_rewrite,
                'with_front'   => apply_filters('nasa_brand_with_front', false),
                'hierarchical' => true,
            ),
            'update_count_callback' => '_wc_term_recount'
        ));
    }
    
    /**
     * init Loop Brands
     */
    public function loop_product_brands_init() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['loop_brands']) || !$nasa_opt['loop_brands']) {
            return;
        }
        
        global $product;
        
        if (!$product) {
            return;
        }
        
        $tax_label = '<strong>' . esc_html__('Brand:', 'nasa-core') . '&nbsp;</strong>';
        $before = apply_filters('nasa_before_custom_categories_grid', '<span class="posted_in nasa-crazy-inline">' . $tax_label);
        $sep = apply_filters('nasa_sep_custom_categories', ', ');
        $after = apply_filters('nasa_after_custom_categories', '</span>');
        
        $brands = get_the_term_list($product->get_id(), self::$nasa_taxonomy, $before, $sep, $after);
        
        if ($brands) {
            $this->loop_brands = '<div class="nasa-list-brand nasa-show-one-line">' . $brands . '</div>';
            
            add_filter('ns_product_info_wrap_classes', array($this, 'loop_product_brands_info_wrap_classes'));
        }
    }
    
    /**
     * end Loop Brands
     */
    public function loop_product_brands_end() {
        $this->loop_brands = null;
        remove_filter('ns_product_info_wrap_classes', array($this, 'loop_product_brands_info_wrap_classes'));
    }

    /**
     * Show in Loop
     */
    public function loop_product_brands() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['loop_brands']) || !$nasa_opt['loop_brands']) {
            return;
        }
        
        global $product;
        
        if (!$product) {
            return;
        }
        
        echo $this->loop_brands ? $this->loop_brands : '';
    }
    
    /**
     * Classes for Product Grid - Info Wrap
     */
    public function loop_product_brands_info_wrap_classes($classes) {
        return $classes . ' has-brands';
    }

    /**
     * Show in Single product page
     */
    public function single_product_brands_logo() {
        global $product;
        
        if (!$product) {
            return;
        }
        
        $terms = get_the_terms($product->get_id(), self::$nasa_taxonomy);
        
        if (empty($terms)) {
            return;
        }
        
        $count = count($terms);
        
        $brand_label = $count > 1 ? esc_html__('Brands:', 'nasa-core') : esc_html__('Brand:', 'nasa-core');
        
        echo '<div itemprop="brand" class="nasa-single-product-brands">';
        
        echo '<span class="nasa-single-brand-label">' . $brand_label . '</span>&nbsp;';
        
        foreach ($terms as $k => $term) {
            $thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            $image = $thumb_id ? wp_get_attachment_image($thumb_id, 'full') : '';
            $image_full = $image ? '<div class="nasa-p-brand-img nasa-transition">' . $image . '</div>' : '';
            
            echo '<a class="nasa-single-brand-item primary-color" title="' . esc_attr($term->name) . '" href="' . esc_url(get_term_link($term, self::$nasa_taxonomy)) . '">' . $image_full . $term->name . '</a>';
            
            if ($k < $count-1) {
                echo '<span class="nasa-brand-sep"></span>';
            }
        }
        
        echo '</div>';
    }

    /**
     * Show in Single product page
     */
    public function single_product_brands_meta() {
        global $product;
        
        if (!$product) {
            return;
        }
        
        $taxLabel = '<strong>' . esc_html__('Brand:', 'nasa-core') . '&nbsp;</strong>';
        
        $before = apply_filters('nasa_before_custom_categories', '<span itemprop="brand" class="posted_in nasa-crazy-inline">' . $taxLabel);
        $sep = apply_filters('nasa_sep_custom_categories', ', ');
        $after = apply_filters('nasa_after_custom_categories', '</span>');
        
        $terms = get_the_term_list($product->get_id(), self::$nasa_taxonomy, $before, $sep, $after);
        
        echo $terms ? $terms : '';
    }
    
    /**
     * Short code Product Brands
     */
    public function product_brands_sc($atts = array(), $content = null) {
        $dfAttr = array(
            'columns_number' => '6',
            'columns_number_small' => '2',
            'columns_number_tablet' => '4',
            'layout' => 'carousel',
            'auto_slide' => 'false',
            'hide_empty' => 0,
            'el_class' => ''
        );
        extract(shortcode_atts($dfAttr, $atts));
        
        $brands = get_terms(
            array(
                'taxonomy'   => self::$nasa_taxonomy,
                'hide_empty' => (bool) $hide_empty,
                'menu_order' => 'asc'
            )
        );
        
        if (empty($brands)) {
            return '';
        }
        
        $placeholder_image = get_option('woocommerce_placeholder_image', 0);
        $images = array();
        $links = array();
        $names = array();
        $show_titles = array();
        $layout = !in_array($layout, array('carousel', 'grid')) ? 'carousel' : $layout;
        foreach ($brands as $term) {
            $thumb_id = get_term_meta($term->term_id, 'thumbnail_id', true);
            $images[] = $thumb_id ? $thumb_id : $placeholder_image;
            $links[] = get_term_link($term);
            $names[] = $term->name;
            $show_titles[] = $thumb_id ? false : true;
        }
        
        ob_start();
        
        $nasa_args = array(
            'images' => $images,
            'layout' => $layout,
            'auto_slide' => $auto_slide,
            'columns_number' => $columns_number,
            'columns_number_small' => $columns_number_small,
            'columns_number_tablet' => $columns_number_tablet,
            'custom_links' => $links,
            'custom_names' => $names,
            'show_titles' => $show_titles
        );
        
        nasa_template('brands/' . $layout . '.php', $nasa_args);
        
        $content = ob_get_clean();
        
        return $content;
    }
    
    /**
     * Shortcode Product Brands 2
     */
    public function product_brands_sc_2($atts = array(), $content = null) {
        $dfAttr = array(
            'hide_empty' => 0,
            'el_class' => ''
        );
        extract(shortcode_atts($dfAttr, $atts));
        
        $brands = get_terms(
            array(
                'taxonomy'   => self::$nasa_taxonomy,
                'hide_empty' => (bool) $hide_empty,
                'orderby' => 'title',
                // 'order' => 'asc'
            )
        );
        
        if (empty($brands)) {
            return '';
        }
        
        /**
         * Enqueue js
         */
        wp_enqueue_script('nasa-product-groups', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-brands-anphabet.min.js', array('jquery'), null, true);
        
        ob_start();
        
        $nasa_args = array(
            'brands'    => $brands,
            'alphabet'  => apply_filters('nasa_brands_alphabet', array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '0-9'))
        );
        
        nasa_template('brands/filters.php', $nasa_args);
        
        $content = ob_get_clean();
        
        return $content;
    }
}
