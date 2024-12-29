<?php
/**
 * Widget for Elementor
 */
class Nasa_Products_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_products';
        $this->widget_cssclass = 'woocommerce nasa_products_wgsc';
        $this->widget_description = __('Display Products', 'nasa-core');
        $this->widget_id = 'nasa_products_sc';
        $this->widget_name = 'ELM - Nasa Products';
        $this->settings = array(
            'title_shortcode' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title (Only using for Style is Slider, Simple Slide.)', 'nasa-core')
            ),
            
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
            
            'style' => array(
                'type' => 'select',
                'std' => 'grid',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'grid' => __('Grid', 'nasa-core'),
                    'carousel' => __('Slider', 'nasa-core'),
                    'slide_slick' => __('Simple Slider', 'nasa-core'),
                    'slide_slick_2' => __('Simple Slider v2', 'nasa-core'),
                    'infinite' => __('Ajax Infinite', 'nasa-core'),
                    'list' => __('List - Widget Items', 'nasa-core'),
                    'list_carousel' => __('Slider - Widget Items', 'nasa-core')
                )
            ),
            
            'style_viewmore' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Style View More', 'nasa-core'),
                'options' => array(
                    '1' => __('Type 1 - No Border', 'nasa-core'),
                    '2' => __('Type 2 - Border - Top - Bottom', 'nasa-core'),
                    '3' => __('Type 3 - Button - Radius - Dash', 'nasa-core')
                )
            ),
            
            'style_row' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Rows of Slide', 'nasa-core'),
                'options' => array(
                    '1' => __('1 Row', 'nasa-core'),
                    '2' => __('2 Rows', 'nasa-core'),
                    '3' => __('3 Rows', 'nasa-core')
                )
            ),
            
            'pos_nav' => array(
                'type' => 'select',
                'std' => 'both',
                'label' => __('Position Title | Navigation (The Top Only use for Style is Slider)', 'nasa-core'),
                'options' => array(
                    'top' => __('Top - for Carousel 1 Row', 'nasa-core'),
                    'left' => __('Side', 'nasa-core'),
                    'both' => __('Side Classic', 'nasa-core')
                )
            ),
            
            'title_align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Title align (Only use for Style is Slider)', 'nasa-core'),
                'options' => array(
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'arrows' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Arrows (Only use for Style is Slider or Simple Slide)', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'dots' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Dots (Only use for Style is Slider or Simple Slide 2)', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'auto_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Auto', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'loop_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Infinite', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'auto_delay_time' => array(
                "type" => "text",
                "std" => '6',
                "label" => __("Delay Time (s)", 'nasa-core')
            ),
            
            'number' => array(
                'type' => 'text',
                'std' => '8',
                'label' => __('Limit', 'nasa-core')
            ),
            
            'columns_number' => array(
                'type' => 'select',
                'std' => 4,
                'label' => __('Columns Number', 'nasa-core'),
                'options' => $this->array_numbers(6)
            ),
            
            'columns_number_small' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Columns Number Small', 'nasa-core'),
                'options' => $this->array_numbers(3)
            ),
            
            'columns_number_small_slider' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Columns Number Small for Carousel', 'nasa-core'),
                'options' => $this->array_numbers_half()
            ),
            
            'columns_number_tablet' => array(
                'type' => 'select',
                'std' => 3,
                'label' => __('Columns Number Tablet', 'nasa-core'),
                'options' => $this->array_numbers(4)
            ),
            
            'cat' => array(
                'type' => 'product_categories',
                'std' => '',
                'label' => __('Product Category (Use slug of Category)', 'nasa-core')
            ),
            
            'ns_tags' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Slug of tags, separated by ","', 'nasa-core')
            )
        );
        
        $this->settings['ns_brand'] = array(
            'type' => 'product_brands',
            'std' => '',
            'label' => __('Product Brand - Nasa (Use slug of Brand)', 'nasa-core')
        );
        
        if (defined('PWB_PLUGIN_NAME')) {
            $this->settings['pwb_brand'] = array(
                'type' => 'product_pwb_brands',
                'std' => '',
                'label' => __('Product PWB Brand - (Use slug of Brand)', 'nasa-core')
            );
        }
        
        $this->settings['not_in'] = array(
            'type' => 'text',
            'std' => '',
            'label' => __('Excludes Product Ids', 'nasa-core')
        );
        
        $this->settings['el_class'] = array(
            'type' => 'text',
            'std' => '',
            'label' => __('Extra class name', 'nasa-core')
        );

        parent::__construct();
    }
}
