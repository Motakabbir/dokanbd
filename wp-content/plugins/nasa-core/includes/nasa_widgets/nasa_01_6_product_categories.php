<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Product_Categories_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_product_categories';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-product-categories';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Product Categories';
    }
    
    /**
     * Register controls.
     *
     * @access protected
     */
    protected function register_controls() {
        if (!NASA_CORE_IN_ADMIN) {
            return;
        }
        
        $this->start_controls_section(
            'section_menu',
            [
                'label' => __('Settings', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'list_cats',
            [
                'label'   => __('Categories Included', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('ID or Slug, separated by ",". Ex: 1, 2 or slug-1, slug-2.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'number',
            [
                'label'   => __('Limit', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
                // 'description'  => __('Only using for Style is Slider, Simple Slide.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'disp_type',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'Horizontal4',
                'options' => [
                    'Horizontal1' => __('Horizontal 1', 'nasa-core'),
                    'Horizontal2' => __('Horizontal 2', 'nasa-core'),
                    'Horizontal3' => __('Horizontal 3', 'nasa-core'),
                    'Horizontal4' => __('Horizontal 4', 'nasa-core'),
                    'Horizontal5' => __('Horizontal 5', 'nasa-core'),
                    'Horizontal6' => __('Horizontal 6', 'nasa-core'),
                    'Vertical' => __('Vertical', 'nasa-core'),
                    'grid' => __('Grid 1', 'nasa-core'),
                    'grid-2' => __('Grid 2', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'parent',
            [
                'label'        => __('Only top level', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'true',
                'default'      => 'true',
            ]
        );
        
        $this->add_control(
            'root_cat',
            [
                'label'   => __('Only child of', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'description'  => __('Only show child of (Product category id or slug)', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'hide_empty',
            [
                'label'        => __('Hide Empty', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '1',
            ]
        );
        
        $this->add_control(
            'columns_number',
            [
                'label'   => __('Columns Number', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '10' => '10',
                    '9' => '9',
                    '8' => '8',
                    '7' => '7',
                    '6' => '6',
                    '5' => '5',
                    '4' => '4',
                    '3' => '3',
                    '2' => '2',
                    '1' => '1',
                ],
            ]
        );
        
        $this->add_control(
            'columns_number_tablet',
            [
                'label'   => __('Columns Medium', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '5' => '5',
                    '4' => '4',
                    '3' => '3',
                    '2' => '2',
                    '1' => '1',
                ],
            ]
        );
        
        $this->add_control(
            'columns_number_small',
            [
                'label'   => __('Columns Small', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '3' => '3',
                    '2' => '2',
                    '1' => '1',
                ],
            ]
        );
        
        $this->add_control(
            'number_vertical',
            [
                'label'   => __('Available Vertical', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '6' => '6',
                    '5' => '5',
                    '4' => '4',
                    '3' => '3',
                    '2' => '2',
                    '1' => '1',
                ],
            ]
        );
        
        $this->add_control(
            'auto_slide',
            [
                'label'        => __('Auto Slide', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'true',
                'default'      => 'true',
                // 'description'  => __('', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'loop_slide',
            [
                'label'        => __('Slide Infinite', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'true',
                'default'      => '',
                'description'  => __('Only use for Horizontal.', 'nasa-core'),
            ]
        );

        $this->add_control(
            'el_class',
            [
                'label'   => __('Extra class name', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->end_controls_section();
    }
    
    /**
     * Render output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     * 
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $atts = [
            'title' => isset($settings['title']) ? $settings['title'] : '',
            'list_cats' => isset($settings['list_cats']) ? $settings['list_cats'] : '',
            'number' => isset($settings['number']) ? $settings['number'] : '',
            'disp_type' => isset($settings['disp_type']) ? $settings['disp_type'] : 'Horizontal4',
            'parent' => isset($settings['parent']) ? $settings['parent'] : 'false',
            'root_cat' => isset($settings['root_cat']) ? $settings['root_cat'] : '',
            'hide_empty' => isset($settings['hide_empty']) ? $settings['hide_empty'] : '1',
            'columns_number' => isset($settings['columns_number']) ? $settings['columns_number'] : '4',
            'columns_number_small' => isset($settings['columns_number_small']) ? $settings['columns_number_small'] : '2',
            'columns_number_tablet' => isset($settings['columns_number_tablet']) ? $settings['columns_number_tablet'] : '4',
            'number_vertical' => isset($settings['number_vertical']) ? $settings['number_vertical'] : '4',
            'auto_slide' => isset($settings['auto_slide']) ? $settings['auto_slide'] : 'true',
            'loop_slide' => isset($settings['loop_slide']) ? $settings['loop_slide'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Product_Categories_Elm());
