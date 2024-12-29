<?php
/**
 * Widget for Elementor
 */
class Nasa_Products_Masonry_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_products_masonry';
        $this->widget_cssclass = 'woocommerce nasa_products_masonry_wgsc';
        $this->widget_description = __('Display Shortcode Nasa Products Masonry', 'nasa-core');
        $this->widget_id = 'nasa_products_masonry_sc';
        $this->widget_name = 'ELM - Nasa Products Masonry';
        $this->settings = array(
            'type' => array(
                'type' => 'select',
                'std' => 'recent_product',
                'label' => __('Type Show', 'nasa-core'),
                'options' => array(
                    'recent_product' => __('Recent', 'nasa-core'),
                    'best_selling' => __('Best Selling', 'nasa-core'),
                    'featured_product' => __('Featured', 'nasa-core'),
                    'top_rate' => __('Top Rate', 'nasa-core'),
                    'on_sale' => __('On Sale', 'nasa-core'),
                    'recent_review' => __('Recent Review', 'nasa-core'),
                    'deals' => __('Deals', 'nasa-core'),
                    'stock_desc' => __('Quantity Stock - Descending', 'nasa-core')
                )
            ),
            
            'layout' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    '1' => __('Type 1 (Limit 18 items)', 'nasa-core'),
                    '2' => __('Type 2 (Limit 16 items)', 'nasa-core')
                )
            ),
            
            'loadmore' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Style View More', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'cat' => array(
                'type' => 'product_categories',
                'std' => '',
                'label' => __('Product Category (Use slug of Category)', 'nasa-core')
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}
