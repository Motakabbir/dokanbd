<?php
/**
 * Widget for Elementor
 */
class Nasa_Products_By_Ids_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_products_byids';
        $this->widget_cssclass = 'nasa_products_byids_wgsc';
        $this->widget_description = __('Display Products By Ids', 'nasa-core');
        $this->widget_id = 'nasa_products_byids_sc';
        $this->widget_name = 'ELM - Nasa Products By Ids';
        $this->settings = array(
            'ids' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Product Ids', 'nasa-core')
            ),
            
            'style' => array(
                'type' => 'select',
                'std' => 'grid',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'grid' => __('Grid', 'nasa-core'),
                    'carousel' => __('Slider', 'nasa-core')
                )
            ),
            
            'arrows' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Arrows (Only use for Style is Slider)', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'dots' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Dots (Only use for Style is Slider)', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'auto_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Auto (Only use for Style is Slider)', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'loop_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Infinite (Only use for Style is Slider)', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'auto_delay_time' => array(
                "type" => "text",
                "std" => '6',
                "label" => __("Delay Time (s) (Only use for Style is Slider.)", 'nasa-core')
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
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}
