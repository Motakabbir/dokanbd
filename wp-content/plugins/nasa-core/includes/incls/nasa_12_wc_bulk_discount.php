<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Initialize Class Nasa_WC_Custom_Fields_Add_To_Cart
 */
add_action('init', array('Nasa_WC_Bulk_Discount', 'getInstance'));
    
/**
 * Class Nasa_WC_Bulk_Discount
 */
class Nasa_WC_Bulk_Discount {
    /**
     * instance of the class
     */
    protected static $instance = null;
    
    public $items_dsct = array();
    public $items_dsct_rules = array();
    
    /**
     * WPML - WooCommerce Multilingual
     */
    protected $_wpml_multi_currencies = false;
    
    protected $_calculated = false;

    /**
     * Instance
     */
    public static function getInstance() {
        if (!NASA_WOO_ACTIVED) {
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
        
        global $nasa_opt;
        
        if (isset($nasa_opt['bulk_dsct']) && !$nasa_opt['bulk_dsct']) {
            return null;
        }
        
        /**
         * Compatible - WPML - WooCommerce Multilingual
         */
        if (function_exists('wcml_is_multi_currency_on') && wcml_is_multi_currency_on()) {
            global $woocommerce_wpml;

            if ($woocommerce_wpml) {
                $this->_wpml_multi_currencies = $woocommerce_wpml->get_multi_currency()->prices;
            }
        }
        
        add_filter('body_class', array($this, 'add_body_classes'));
        
        /**
         * Custom fields variation
         */
        add_filter('woocommerce_available_variation', array($this, 'custom_fields_variation'));
        
        /**
         * Single Product - Simple | Variation
         */
        
        // add_action('template_redirect', array($this, 'single_product_bulk_discount_acts'), 1000);
        // change 1/26/2024 - P
        
        /**
         * (For Quickview | Single Product) Add To Cart Form -  Bulk Discount Layout Actions - Simple | Variation
         */

        $discount_layout = (isset($nasa_opt['bulk_dsct_layout']) && $nasa_opt['bulk_dsct_layout'] != 'type-1') ? $nasa_opt['bulk_dsct_layout'] : 'type-1';

        if ( $discount_layout == 'type-1') {
            add_action('woocommerce_before_add_to_cart_button', array($this, 'single_product_bulk_discount'),1);
        } else {
            add_action('woocommerce_after_add_to_cart_button', array($this, 'single_product_bulk_discount'),31);
        }

        /**
         * Change Price in Cart - Checkout
         */
        add_action('woocommerce_before_calculate_totals', array($this, 'cart_before_calculate'), 1);
        
        /**
         * For Mini Cart or Popup Cart Order
         */
        if (isset($_REQUEST['wc-ajax'])) {
            // /**
            //  * Change Price in Popup Cart
            //  */
            // if ($_REQUEST['wc-ajax'] == 'nasa_after_add_to_cart') {
            //     add_action('popup_woocommerce_before_cart', array($this, 'cart_before_calculate'), 1);
            // }
            
            /**
             * Change Price in Reload Fragments, Refreshed Fragments
             */
            if (in_array($_REQUEST['wc-ajax'], array('nasa_quantity_mini_cart', 'get_refreshed_fragments'))) {
                add_action('woocommerce_before_mini_cart', array($this, 'cart_before_calculate'), 1);
            }
        }
        
        /**
         * Badge
         */
        if (isset($nasa_opt['bulk_dsct_badge']) && $nasa_opt['bulk_dsct_badge']) {
            add_filter('nasa_badges', array($this, 'add_bulk_badge'));
        }
    }
    
    /**
     * Add Body Class support WCML
     * 
     * @param string $classes
     * @return string
     */
    public function add_body_classes($classes) {
        if (($this->_wpml_multi_currencies || function_exists('alg_wc_oma')) && !in_array('ns-spmc', $classes)) {
            $classes[] = 'ns-spmc';
        }
        
        return $classes;
    }

    /**
     * Check allow
     * 
     * @param type $product
     * @return type
     */
    protected function _check_allow($product) {
        $product_type = $product->get_type();
        
        if (!in_array($product_type, array('simple', 'variation'))) {
            return false;
        }
        
        $product_id = $product->get_id();
        
        /**
         * Simple Product
         */
        if ($product_type == 'simple') {
            $enable = nasa_get_product_meta_value($product_id, "_bulk_dsct", true);
            
            return $enable ? true : false;
        }
        
        /**
         * Variation Product
         */
        if ($product_type == 'variation') {
            $enable = nasa_get_variation_meta_value($product_id, "bulk_dsct_allow", true);
            
            return $enable ? true : false;
        }
        
        return false;
    }
    
    /**
     * 
     * @param type $product
     * @return type
     */
    public function get_discount_type($product) {
        $product_id = $product->get_id();
        
        $discount_type = $product->get_type() == 'variation' ?
            nasa_get_variation_meta_value($product_id, "bulk_dsct_type", true) :
            nasa_get_product_meta_value($product_id, "_bulk_dsct_type", true);
        
        return in_array($discount_type, array('flat', 'per')) ? $discount_type : 'flat'; 
    }
    
    /**
     * Single Product Bulk Discount actions
     * 
     * @param type $product
     * @return void
     */
    /*
    change 1/26/2024 - P
    public function single_product_bulk_discount_acts() {
        global $nasa_opt;
        
        $discount_layout = isset($nasa_opt['bulk_dsct_layout']) ? $nasa_opt['bulk_dsct_layout'] : 'type-1';

        
        $priority = 28;
        if ( $discount_layout !== 'type-1') {
            $priority = 31;
        }
        
        if (isset($nasa_opt['product_detail_layout']) && $nasa_opt['product_detail_layout'] == 'modern-1') {
            $priority = 1020;
        }
        
        add_action('woocommerce_single_product_summary', array($this, 'single_product_bulk_discount'), $priority);
    }
    */
    /**
     * Single Product Bulk Discount
     * 
     * @param type $product
     * @return void
     */
    public function single_product_bulk_discount() {
        global $product;
        

        /**
         * Return if not product
         */
        if (!$product) {
            return;
        }
        
        /**
         * Variable Product
         */
        if ($product->get_type() == 'variable') {
            echo '<div class="nasa-variation-bulk-dsct nasa-not-in-sticky hidden-tag"></div>';
            
            return;
        }
        
        /**
         * Simple - Variation Product
         */
        if (!$this->_check_allow($product)) {
            return;
        }
        
        $product_id = $product->get_id();
        $bulk_discount = get_post_meta($product_id, '_bulk_dsct_rules', true);
        
        /**
         * Empty Rules
         */
        if (empty($bulk_discount)) {
            return;
        }
        
        global $nasa_opt;
        
        /**
         * Args use in Template
         */
        $nasa_args = array(
            'product' => $product,
            'bulk_discount' => $bulk_discount,
            'discount_type' => $this->get_discount_type($product),
            'wpml_multi_currencies' => $this->_wpml_multi_currencies,
            'dsct_obj' => $this
        );
        
        /**
         * Template view
         */
        $discount_layout_opt = (isset($nasa_opt['bulk_dsct_layout']) && $nasa_opt['bulk_dsct_layout'] != 'type-1') ? '-' . $nasa_opt['bulk_dsct_layout'] : '';
        
        nasa_template('products/nasa_single_product/nasa-single-product-bulk-discount' . $discount_layout_opt . '.php', $nasa_args);
    }
    
    /**
     * Convert Price - Multi-Currencies
     * 
     * @global type $WOOCS
     * @param type $price
     * @return type
     */
    public function convert_price($price) {
        /**
         * Compatible - Multi Currency for WooCommerce
         */
        if (function_exists('wmc_get_price')) {
            $price = wmc_get_price($price);
        }
        
        /**
         * Compatible - WOOCS - WooCommerce Currency Switcher
         */
        if (class_exists('WOOCS')) {
            global $WOOCS;
            
            if ($WOOCS) {
                $price = (float) $WOOCS->woocs_exchange_value($price);
            }
        }
        
        return apply_filters('nasa_dsct_convert_price', $price);
    }
    
    /**
     * Un-Convert Price - Multi-Currencies
     * 
     * @global type $WOOCS
     * @param type $price
     * @return type
     */
    public function revert_price($price) {
        /**
         * Compatible - CURCY - Multi Currency for WooCommerce
         */
        if (function_exists('wmc_revert_price')) {
            $price = wmc_revert_price($price);
        }
        
        /**
         * Compatible - WOOCS - WooCommerce Currency Switcher
         */
        if (class_exists('WOOCS')) {
            global $WOOCS;
            
            if ($WOOCS) {
                $currencies = $WOOCS->get_currencies();
                $price = (float) $WOOCS->back_convert($price, $currencies[$WOOCS->current_currency]['rate']);
            }
        }
        
        return apply_filters('nasa_dsct_revert_price', $price);
    }

    /**
     * Custom Price for Cart - Checkout - Order
     */
    public function cart_before_calculate() {
        if (NASA_CORE_IN_ADMIN && !defined('DOING_AJAX')) {
            return;
        }
                
        if ($this->_calculated) {
            return;
        }
        
        if (!WC()->cart->is_empty()) {
            
            $variations = array();
            
            $cart_items = WC()->cart->get_cart_contents();
            
            foreach ($cart_items as $cart_item_key => $cart_item) {
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                
                /**
                 * Type not support || not Allow
                 */
                if (!$_product || !$this->_check_allow($_product)) {
                    continue;
                }
                
                if (
                    $_product->exists() &&
                    $cart_item['quantity'] > 0 &&
                    apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)
                ) {
                    /**
                     * Variation Product
                     */
                    if ($_product->get_type() == 'variation') {
                        $variation_id = $_product->get_id();
                        
                        if (!isset($variations[$variation_id])) {
                            $variations[$variation_id] = array(
                                'product' => $_product,
                                'qty' => $cart_item['quantity'],
                                'cart_items' => array($cart_item_key => $cart_item)
                            );
                        } else {
                            $variations[$variation_id]['qty'] += $cart_item['quantity'];
                            $variations[$variation_id]['cart_items'][$cart_item_key] = $cart_item;
                        }
                    }
                    
                    /**
                     * Simple Product
                     */
                    else {
                        $bulk_discount = get_post_meta($product_id, '_bulk_dsct_rules', true);

                        $rules = isset($bulk_discount['rules']) ? $bulk_discount['rules'] : array();
                        $max = isset($bulk_discount['max']) ? $bulk_discount['max'] : false;

                        if (!$max || empty($rules)) {
                            continue;
                        }

                        $type = $this->get_discount_type($_product);

                        $count = count($rules);
                        
                        for ($i = $count - 1; $i >= 0; $i--) {
                            if ($rules[$i]['dsct'] && $cart_item['quantity'] >= $rules[$i]['qty']) {
                                $price_org = floatval($_product->get_price());
                                
                                $dsct = floatval($rules[$i]['dsct']);

                                if ($type == 'flat') {
                                    /**
                                     * Compatible - WPML - WooCommerce Multilingual
                                     */
                                    if ($this->_wpml_multi_currencies) {
                                        $dsct = $this->_wpml_multi_currencies->convert_price_amount($dsct);
                                    }
                                    
                                    $price_new = $price_org - $this->convert_price($dsct);
                                } else {
                                    $price_new = $price_org - (($price_org * $dsct) / 100);
                                }
                                
                                $price_new = $this->revert_price($price_new);
                                
                                $_product->set_price(floatval($price_new));

                                $i = -1; // Break for
                            }
                        }
                    }
                }
            }
            
            /**
             * Reset price variation product
             */
            $this->_filter_variation_products($variations);
        }
        
        $this->_calculated = true;
    }
    
    /**
     * Reset price variation product
     * 
     * @param type $variations
     */
    protected function _filter_variation_products($variations) {
        if (!empty($variations)) {
            foreach ($variations as $variation_id => $variation) {
                $_product = $variation['product'];
                $quatity = $variation['qty'];
                
                $bulk_discount = get_post_meta($variation_id, '_bulk_dsct_rules', true);

                $rules = isset($bulk_discount['rules']) ? $bulk_discount['rules'] : array();
                $max = isset($bulk_discount['max']) ? $bulk_discount['max'] : false;

                if (!$max || empty($rules)) {
                    continue;
                }

                $type = $this->get_discount_type($_product);

                $count = count($rules);
                
                for ($i = $count - 1; $i >= 0; $i--) {
                    if ($rules[$i]['dsct'] && $quatity >= $rules[$i]['qty']) {
                        $price_org = floatval($_product->get_price());
                        
                        $dsct = floatval($rules[$i]['dsct']);

                        if ($type == 'flat') {
                            /**
                             * Compatible - WPML - WooCommerce Multilingual
                             */
                            if ($this->_wpml_multi_currencies) {
                                $dsct = $this->_wpml_multi_currencies->convert_price_amount($dsct);
                            }
                            
                            $price_new = $price_org - $this->convert_price($dsct);
                        } else {
                            
                            $price_new = $price_org - ($price_org * $dsct / 100);
                        }

                        foreach ($variation['cart_items'] as $cart_item_key => $cart_item) {
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            
                            $price_new = $this->revert_price($price_new);
                                
                            $_product->set_price(floatval($price_new));
                        }

                        $i = -1; // Break for
                    }
                }
            }
        }
    }

    /**
     * Custom fields variation
     */
    public function custom_fields_variation($variation) {
        $variation_meta = nasa_get_variation_meta_value($variation['variation_id']);
        
        $enable = isset($variation_meta['bulk_dsct_allow']) && $variation_meta['bulk_dsct_allow'] ? true : false;

        if ($enable) {
            global $nasa_opt;
            
            if (!isset($variation['nasa_custom_fields'])) {
                $variation['nasa_custom_fields'] = array();
            }

            $variation['nasa_custom_fields']['dsct_allow'] = '1';
            
            if (isset($nasa_opt['bulk_dsct_badge']) && $nasa_opt['bulk_dsct_badge']) {
                $variation['nasa_custom_fields']['dsct_badge'] = $this->_bulk_badge();
            }
        }

        return $variation;
    }
    
    /**
     * Add Badge Bulk
     * 
     * @param type $badges
     * @return type
     */
    public function add_bulk_badge($badges) {
        global $product;
        
        if ($this->_check_allow($product)) {
            $badges .= $this->_bulk_badge();
        }
        
        return $badges;
    }
    
    /**
     * Badge content
     */
    protected function _bulk_badge() {
        return '<span class="badge bulk-label">' . esc_html__('Bulk', 'nasa-core') . '</span>';
    }
}
