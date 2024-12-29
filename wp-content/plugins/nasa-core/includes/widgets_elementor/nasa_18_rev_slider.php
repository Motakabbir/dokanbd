<?php
/**
 * Widget for Elementor
 */
class Nasa_Rev_Slider_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_rev_slider';
        $this->widget_cssclass = 'nasa_rev_slider_wgsc';
        $this->widget_description = __('Display Revolution Slider', 'nasa-core');
        $this->widget_id = 'nasa_rev_slider_sc';
        $this->widget_name = 'ELM - Nasa - Revo Slider';
        $this->settings = array(
            'alias' => array(
                'type' => 'revslider',
                'std' => '',
                'label' => __('RevSlider Item', 'nasa-core')
            ),
            
            'alias_m' => array(
                'type' => 'revslider',
                'std' => '',
                'label' => __('RevSlider Item - Mobile Layout', 'nasa-core')
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
