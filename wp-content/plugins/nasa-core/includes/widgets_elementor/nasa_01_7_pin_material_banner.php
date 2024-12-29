<?php
/**
 * Widget for Elementor
 */
class Nasa_Pin_Material_Banner_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_pin_material_banner';
        $this->widget_cssclass = 'nasa_pin_material_banner_wgsc';
        $this->widget_description = __('Display Pin Material Banner', 'nasa-core');
        $this->widget_id = 'nasa_pin_material_banner_sc';
        $this->widget_name = 'ELM - Nasa Pin Material Banner';
        $this->settings = array(
            'pin_slug' => array(
                'type' => 'pin_slug',
                'pin' => 'nasa_pin_mb',
                'std' => '',
                'label' => __('Slug Pin', 'nasa-core')
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
