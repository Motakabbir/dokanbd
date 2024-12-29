<?php
/**
 * Widget for Elementor
 */
class Nasa_Menu_Vertical_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_menu_vertical';
        $this->widget_cssclass = 'nasa_menu_vertical_wgsc';
        $this->widget_description = __('Display Menu Vertical', 'nasa-core');
        $this->widget_id = 'nasa_menu_vertical_sc';
        $this->widget_name = 'ELM - Nasa Menu Vertical';
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title', 'nasa-core')
            ),
            
            'menu' => array(
                'type' => 'menu_list',
                'std' => '',
                'label' => __('Select Menu (Use slug of Menu)', 'nasa-core')
            ),
            
            'menu_align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Alignment', 'nasa-core'),
                'options' => array(
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
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
