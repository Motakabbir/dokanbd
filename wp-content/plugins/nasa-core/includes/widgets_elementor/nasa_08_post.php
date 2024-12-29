<?php
/**
 * Widget for Elementor
 */
class Nasa_Posts_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_post';
        $this->widget_cssclass = 'nasa_post_wgsc';
        $this->widget_description = __('Display Post Blogs', 'nasa-core');
        $this->widget_id = 'nasa_post_sc';
        $this->widget_name = 'ELM - Nasa Posts';
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title', 'nasa-core')
            ),
            
            'title_desc' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Description', 'nasa-core')
            ),
            
            'show_type' => array(
                'type' => 'select',
                'std' => 'slide',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'slide' => __('Slider', 'nasa-core'),
                    'grid' => __('Grid 1', 'nasa-core'),
                    'grid_2' => __('Grid 2', 'nasa-core'),
                    'grid_3' => __('Grid 3 - Only show 2 posts', 'nasa-core'),
                    'list' => __('List', 'nasa-core'),
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
            
            'arrows' => array(
                'type' => 'select',
                'std' => '0',
                'label' => __('Arrows', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'dots' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Dots', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'posts' => array(
                'type' => 'text',
                'std' => '8',
                'label' => __('Posts number - Not use with Grid 3', 'nasa-core')
            ),
            
            'columns_number' => array(
                'type' => 'select',
                'std' => 3,
                'label' => __('Columns Number', 'nasa-core'),
                'options' => $this->array_numbers(6)
            ),
            
            'columns_number_small' => array(
                'type' => 'select',
                'std' => 1,
                'label' => __('Columns Number Small', 'nasa-core'),
                'options' => $this->array_numbers(2)
            ),
            
            'columns_number_small_slider' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Columns Number Small for Slider', 'nasa-core'),
                'options' => $this->array_numbers_half()
            ),
            
            'columns_number_tablet' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Columns Number Tablet', 'nasa-core'),
                'options' => $this->array_numbers(4)
            ),
            
            'category' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Categories (Input categories slug Divide with "," Ex: slug-1, slug-2 ...)', 'nasa-core')
            ),
            
            'cats_enable' => array(
                'type' => 'select',
                'std' => 'yes',
                'label' => __('Show Categories of post', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'date_enable' => array(
                'type' => 'select',
                'std' => 'yes',
                'label' => __('Show date post', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'author_enable' => array(
                'type' => 'select',
                'std' => 'yes',
                'label' => __('Show author post', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'readmore' => array(
                'type' => 'select',
                'std' => 'yes',
                'label' => __('Show read more', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'date_author' => array(
                'type' => 'select',
                'std' => 'bot',
                'label' => __('Date/Author/Readmore position with description', 'nasa-core'),
                'options' => array(
                    'bot' => __('Bottom', 'nasa-core'),
                    'top' => __('Top', 'nasa-core')
                )
            ),
            
            'des_enable' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Show description', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'page_blogs' => array(
                'type' => 'select',
                'std' => 'yes',
                'label' => __('Show button page blogs', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'info_align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Info Align - With List Style', 'nasa-core'),
                'options' => array(
                    'left' => __('Left (RTL - Right)', 'nasa-core'),
                    'right' => __('Right (RTL - Left)', 'nasa-core')
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
