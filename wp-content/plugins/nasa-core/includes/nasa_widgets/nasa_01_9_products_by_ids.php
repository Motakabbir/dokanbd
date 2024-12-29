<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Products_By_Ids_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_products_byids';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-products-byids';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Products By Ids';
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
            'ids',
            [
                'label'   => __('Product Ids', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'description'  => __('Enter a list of product IDs, separated by ",".', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => __('Grid', 'nasa-core'),
                    'carousel' => __('Slider', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'arrows',
            [
                'label'        => __('Arrows', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '1',
                'description'  => __('Only use for Style is Slider.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'dots',
            [
                'label'        => __('Dots', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'true',
                'default'      => '',
                'description'  => __('Only use for Style is Slider.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'auto_slide',
            [
                'label'        => __('Slide Auto', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'true',
                'default'      => '',
                'description'  => __('Only use for Style is Slider.', 'nasa-core'),
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
                'description'  => __('Only use for Style is Slider.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'auto_delay_time',
            [
                'label'   => __('Delay Time (s)', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '6',
                'description'  => __('Only use for Style is Slider.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'columns_number',
            [
                'label'   => __('Columns Number', 'nasa-core'),
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
            'columns_number_tablet',
            [
                'label'   => __('Columns Medium', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
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
            'columns_number_small_slider',
            [
                'label'   => __('Columns Small Slider', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '3'     => '3',
                    '2'     => '2',
                    '1.5'   => '1.5',
                    '1'     => '1'
                ],
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
            'ids' => isset($settings['ids']) ? $settings['ids'] : '',
            'style' => isset($settings['style']) ? $settings['style'] : 'grid',
            'arrows' => isset($settings['arrows']) ? $settings['arrows'] : '1',
            'dots' => isset($settings['dots']) ? $settings['dots'] : '',
            'auto_slide' => isset($settings['auto_slide']) ? $settings['auto_slide'] : '',
            'loop_slide' => isset($settings['loop_slide']) ? $settings['loop_slide'] : '',
            'auto_delay_time' => isset($settings['auto_delay_time']) ? $settings['auto_delay_time'] : '6',
            'columns_number' => isset($settings['columns_number']) ? $settings['columns_number'] : '4',
            'columns_number_small' => isset($settings['columns_number_small']) ? $settings['columns_number_small'] : '2',
            'columns_number_small_slider' => isset($settings['columns_number_small_slider']) ? $settings['columns_number_small_slider'] : '2',
            'columns_number_tablet' => isset($settings['columns_number_tablet']) ? $settings['columns_number_tablet'] : '3',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Products_By_Ids_Elm());
