<?php
/**
 * Widget for Elementor
 */
class Nasa_Products_Special_Deal_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_products_special_deal';
        $this->widget_cssclass = 'woocommerce nasa_products_special_deal_wgsc';
        $this->widget_description = __('Display Products Special Deal', 'nasa-core');
        $this->widget_id = 'nasa_products_special_deal_sc';
        $this->widget_name = 'ELM - Nasa Products Special Deal';
        $this->settings = array(
            'limit' => array(
                'type' => 'text',
                'std' => '4',
                'label' => __('Limit products', 'nasa-core')
            ),
            
            'cat' => array(
                'type' => 'product_categories',
                'std' => '',
                'label' => __('Product Category (Use slug of Category)', 'nasa-core')
            ),
            
            'style' => array(
                'type' => 'select',
                'std' => 'simple',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'simple' => __('Simple Deals', 'nasa-core'),
                    'multi' => __('Has Nav 2 Items', 'nasa-core'),
                    'multi-2' => __('Has Nav 4 Items', 'nasa-core'),
                    'for_time' => __('Deal Before Time', 'nasa-core'),
                    'for_time-2' => __('Deal Before Time V2', 'nasa-core')
                )
            ),
            
            'title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title - Not Use for Nav 2 Items', 'nasa-core')
            ),
            
            'title_align' => array(
                'type' => 'select',
                'std' => '0',
                'label' => __('Title Centered - For Deal Before Time V2', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'desc_shortcode' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Description - for Deal Before Time', 'nasa-core')
            ),
            
            'date_sc' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('End date show deals (yyyy-mm-dd | yyyy/mm/dd) for Deal Before Time', 'nasa-core')
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
                'options' => $this->array_numbers_half()
            ),
            
            'columns_number_tablet' => array(
                'type' => 'select',
                'std' => 3,
                'label' => __('Columns Number Tablet', 'nasa-core'),
                'options' => $this->array_numbers(4)
            ),
            
            'statistic' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Show Available - Sold', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'arrows' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Arrows', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'arrows_pos' => array(
                'type' => 'select',
                'std' => '0',
                'label' => __('Arrows Position - Simple Deals', 'nasa-core'),
                'options' => array(
                    '0' => __('Top', 'nasa-core'),
                    '1' => __('Side', 'nasa-core')
                )
            ),
            
            'auto_slide' => array(
                'type' => 'select',
                'std' => 'true',
                'label' => __('Auto Slide', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'loop_slide' => array(
                'type' => 'select',
                'std' => 'true',
                'label' => __('Slide Infinite - for Deal Before Time, Simple Deals', 'nasa-core'),
                'options' => $this->array_bool_str() 
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
