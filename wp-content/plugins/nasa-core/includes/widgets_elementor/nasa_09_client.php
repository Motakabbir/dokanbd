<?php
/**
 * Widget for Elementor
 */
class Nasa_Client_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_client';
        $this->widget_cssclass = 'nasa_client_wgsc';
        $this->widget_description = __('Display Testimonials', 'nasa-core');
        $this->widget_id = 'nasa_client_sc';
        $this->widget_name = 'ELM - Nasa Testimonials';
        $this->settings = array(
            'img_src' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Avatar', 'nasa-core')
            ),
            
            'name' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Name', 'nasa-core')
            ),
            
            'style' => array(
                'type' => 'select',
                'std' => 'full',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'full' => __('Full', 'nasa-core'),
                    'simple' => __('Simple', 'nasa-core')
                )
            ),
            
            'company' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Job (Style => Full)', 'nasa-core')
            ),
            
            'content' => array(
                'type' => 'textarea',
                'std' => 'Some promo text',
                'label' => __('Testimonials Content Say', 'nasa-core')
            ),
            
            'text_align' => array(
                'type' => 'select',
                'std' => 'center',
                'label' => __('Align (Style => Full)', 'nasa-core'),
                'options' => array(
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core'),
                    'justify' => __('Justify', 'nasa-core'),
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
