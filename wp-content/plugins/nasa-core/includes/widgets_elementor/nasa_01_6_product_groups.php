<?php
/**
 * Widget for Elementor
 */
class Nasa_Product_Groups_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_product_nasa_categories';
        $this->widget_cssclass = 'woocommerce nasa_product_groups_wgsc';
        $this->widget_description = __('Display Product Groups', 'nasa-core');
        $this->widget_id = 'nasa_product_groups_sc';
        $this->widget_name = 'ELM - Nasa Product Groups';
        $this->settings = array(
            'style' => array(
                'type' => 'select',
                'std' => 'hoz',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'hoz' => __('Horizontal', 'nasa-core'),
                    'ver' => __('Vertical', 'nasa-core')
                )
            ),
            
            'hide_empty' => array(
                'type' => 'select',
                'std' => '0',
                'label' => __('Hide Empty', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'count_items' => array(
                'type' => 'select',
                'std' => '0',
                'label' => __('Show Count products', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'deep_level' => array(
                'type' => 'select',
                'std' => 3,
                'label' => __('Deep Levels', 'nasa-core'),
                'options' => $this->array_numbers(3)
            ),
            
            'button_text' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Filter Text', 'nasa-core')
            ),
            
            'redirect_to' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Submit Redirect To (Input Slug of a Category you want, Default redirect to Shop page or Home page)', 'nasa-core')
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
