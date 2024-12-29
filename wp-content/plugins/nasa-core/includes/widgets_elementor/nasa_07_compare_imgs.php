<?php
/**
 * Widget for Elementor
 */
class Nasa_Compare_Imgs_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_compare_imgs';
        $this->widget_cssclass = 'nasa_compare_imgs_wgsc';
        $this->widget_description = __('Display Compare IMGS', 'nasa-core');
        $this->widget_id = 'nasa_compare_imgs_sc';
        $this->widget_name = 'ELM - Nasa Compare IMGS';
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title', 'nasa-core')
            ),
            
            'link' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Link', 'nasa-core')
            ),
            
            'desc_text' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Description', 'nasa-core')
            ),
            
            'align_text' => array(
                'type' => 'select',
                'std' => 'center',
                'label' => __('Alignment', 'nasa-core'),
                'options' => array(
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'before_image' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Image Before', 'nasa-core')
            ),
            
            'after_image' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Image After', 'nasa-core')
            ),
            
            'el_class_img' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class for Images', 'nasa-core')
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
