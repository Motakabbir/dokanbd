<?php
/**
 * Widget for Elementor
 */
class Nasa_Product_Categories_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_product_categories';
        $this->widget_cssclass = 'woocommerce nasa_product_categories_wgsc';
        $this->widget_description = __('Display Product Categories', 'nasa-core');
        $this->widget_id = 'nasa_product_categories_sc';
        $this->widget_name = 'ELM - Nasa Product Categories';
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title', 'nasa-core')
            ),
            
            'list_cats' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Categories Included List (ID or Slug, separated by ",". Ex: 1, 2 or slug-1, slug-2)', 'nasa-core')
            ),
            
            'number' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Limit', 'nasa-core')
            ),
            
            'disp_type' => array(
                'type' => 'select',
                'std' => 'Horizontal4',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'Horizontal1' => __('Horizontal 1', 'nasa-core'),
                    'Horizontal2' => __('Horizontal 2', 'nasa-core'),
                    'Horizontal3' => __('Horizontal 3', 'nasa-core'),
                    'Horizontal4' => __('Horizontal 4', 'nasa-core'),
                    'Horizontal5' => __('Horizontal 5', 'nasa-core'),
                    'Horizontal6' => __('Horizontal 6', 'nasa-core'),
                    'Vertical' => __('Vertical', 'nasa-core'),
                    'grid' => __('Grid 1', 'nasa-core'),
                    'grid-2' => __('Grid 2', 'nasa-core')
                )
            ),
            
            'parent' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Only Show top level', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'root_cat' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Only show child of (Product category id or slug)', 'nasa-core')
            ),
            
            'hide_empty' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Hide empty categories', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'columns_number' => array(
                'type' => 'select',
                'std' => 4,
                'label' => __('Columns Number', 'nasa-core'),
                'options' => $this->array_numbers(10)
            ),
            
            'columns_number_small' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Columns Number Small', 'nasa-core'),
                'options' => $this->array_numbers(3)
            ),
            
            'columns_number_tablet' => array(
                'type' => 'select',
                'std' => 4,
                'label' => __('Columns Number Tablet', 'nasa-core'),
                'options' => $this->array_numbers(5)
            ),
            
            'number_vertical' => array(
                'type' => 'select',
                'std' => 4,
                'label' => __('Available Vertical', 'nasa-core'),
                'options' => $this->array_numbers(6)
            ),
            
            'auto_slide' => array(
                'type' => 'select',
                'std' => 'true',
                'label' => __('Slide Auto', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'loop_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Infinite', 'nasa-core'),
                'options' => $this->array_bool_str() 
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
