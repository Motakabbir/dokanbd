<?php
/**
 * Widget for Elementor
 */
class Nasa_Instagram_Feed_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_instagram_feed';
        $this->widget_cssclass = 'nasa_instagram_feed_wgsc';
        $this->widget_description = __('Display Instagram Feed', 'nasa-core');
        $this->widget_id = 'nasa_instagram_feed_sc';
        $this->widget_name = 'ELM - Nasa Instagram Feed';
        $this->settings = array(
            'username_show' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('User name for display show', 'nasa-core')
            ),
            
            'instagram_link' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Link Follow', 'nasa-core')
            ),
            
            'shortcode_txt' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Shortcode Text', 'nasa-core')
            ),
            
            'img_size' => array(
                'type' => 'select',
                'std' => 'full',
                'label' => __('Image Size', 'nasa-core'),
                'options' => array(
                    'full' => __('Large', 'nasa-core'),
                    'medium' => __('Medium', 'nasa-core'),
                    'thumb' => __('Thumbnail', 'nasa-core')
                )
            ),
            
            'disp_type' => array(
                'type' => 'select',
                'std' => 'defalut',
                'label' => __('Display type', 'nasa-core'),
                'options' => array(
                    'default' => __('Grid', 'nasa-core'),
                    'slide' => __('Slider', 'nasa-core'),
                    'zz' => __('Zic Zac', 'nasa-core')
                )
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
            
            'limit_items' => array(
                'type' => 'text',
                'std' => '6',
                'label' => __('Photos Limit', 'nasa-core')
            ),
            
            'columns_number' => array(
                'type' => 'select',
                'std' => 6,
                'label' => __('Show on DeskTop', 'nasa-core'),
                'options' => $this->array_numbers(10, 4)
            ),
            
            'columns_number_tablet' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Show on Tablet', 'nasa-core'),
                'options' => $this->array_numbers(6)
            ),
            
            'columns_number_small' => array(
                'type' => 'select',
                'std' => 1,
                'label' => __('Show on Mobile', 'nasa-core'),
                'options' => $this->array_numbers(6)
            ),
            
            'el_class_img' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra Class Image', 'nasa-core')
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
