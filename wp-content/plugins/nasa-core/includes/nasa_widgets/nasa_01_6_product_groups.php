<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Product_Groups_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_product_nasa_categories';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-product-groups';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Product Groups';
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
            'style',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hoz',
                'options' => [
                    'hoz' => __('Horizontal', 'nasa-core'),
                    'ver' => __('Vertical', 'nasa-core')
                ],
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
                'default'      => '',
            ]
        );
        
        $this->add_control(
            'count_items',
            [
                'label'        => __('Count products', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '',
            ]
        );
        
        $this->add_control(
            'deep_level',
            [
                'label'   => __('Deep Levels', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => '3',
                    '2' => '2',
                    '1' => '1',
                ],
            ]
        );
        
        $this->add_control(
            'button_text',
            [
                'label'   => __('Filter Text', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'redirect_to',
            [
                'label'   => __('Submit Redirect', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Input Slug of a Category you want, Default redirect to Shop page or Home page.', 'nasa-core'),
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
            'style' => isset($settings['style']) ? $settings['style'] : 'hoz',
            'hide_empty' => isset($settings['hide_empty']) ? $settings['hide_empty'] : '',
            'count_items' => isset($settings['count_items']) ? $settings['count_items'] : '',
            'deep_level' => isset($settings['deep_level']) ? $settings['deep_level'] : '3',
            'button_text' => isset($settings['button_text']) ? $settings['button_text'] : '',
            'redirect_to' => isset($settings['redirect_to']) ? $settings['redirect_to'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Product_Groups_Elm());
