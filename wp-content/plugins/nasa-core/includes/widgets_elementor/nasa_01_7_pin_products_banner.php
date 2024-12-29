<?php
/**
 * Widget for Elementor
 */
class Nasa_Pin_Products_Banner_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_pin_products_banner';
        $this->widget_cssclass = 'nasa_pin_products_banner_wgsc';
        $this->widget_description = __('Display Pin Products Banner', 'nasa-core');
        $this->widget_id = 'nasa_pin_products_banner_sc';
        $this->widget_name = 'ELM - Nasa Pin Products Banner';
        $this->settings = array(
            'pin_slug' => array(
                'type' => 'pin_slug',
                'pin' => 'nasa_pin_pb',
                'std' => '',
                'label' => __('Slug Pin', 'nasa-core')
            ),
            
            'marker_style' => array(
                'type' => 'select',
                'std' => 'price',
                'label' => __('Marker Style', 'nasa-core'),
                'options' => array(
                    'price' => __('Price icon', 'nasa-core'),
                    'plus' => __('Plus icon', 'nasa-core')
                )
            ),
            
            'full_price_icon' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Marker Full Price', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'price_rounding' => array(
                'type' => 'select',
                'std' => 'yes',
                'label' => __('Price Rounding', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'show_img' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Show Image', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'show_price' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Show Price', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'pin_effect' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Effect icons', 'nasa-core'),
                'options' => array(
                    'default' => __('Default', 'nasa-core'),
                    'yes' => __('Yes', 'nasa-core'),
                    'no' => __('No', 'nasa-core')
                )
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
