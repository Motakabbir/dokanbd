<?php
/**
 * Widget for Elementor
 */
class Nasa_Menu_Root_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_menu';
        $this->widget_cssclass = 'nasa_menu_wgsc';
        $this->widget_description = __('Display Menu Root (Level 0)', 'nasa-core');
        $this->widget_id = 'nasa_menu_sc';
        $this->widget_name = 'ELM - Nasa Menu Root';
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
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}
