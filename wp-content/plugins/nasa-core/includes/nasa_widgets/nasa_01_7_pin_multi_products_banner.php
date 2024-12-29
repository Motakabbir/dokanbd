<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Pin_Multi_Products_Banner_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_pin_multi_products_banner';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-pin-multi-products-banner';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Pin Multi Products Banner';
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
            'pin_slug',
            [
                'label'   => __('Pin Selected', 'nasa-core'),
                'type'    => Controls_Manager::SELECT2,
                'default' => '',
                'options' => nasa_get_pin_arrays('nasa_pin_mlpb', true),
            ]
        );
        
        $this->add_control(
            'pin_effect',
            [
                'label'   => __('Effect icons', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'default' => __('Default', 'nasa-core'),
                    'yes' => __('Yes', 'nasa-core'),
                    'no' => __('No', 'nasa-core')
                ],
            ]
        );

        $this->add_control(
            'tab_slide_add_dot',
            [
                'label'   => __('Add Dot Slide', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => __('Yes', 'nasa-core'),
                    'no' => __('No', 'nasa-core')
                ],
            ]
        );

        $this->add_control(
            'pin_multi_reverse',
            [
                'label'        => __('Mutil Pin Banner Reverse', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'no',
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
            'pin_slug' => isset($settings['pin_slug']) ? $settings['pin_slug'] : '',
            'pin_effect' => isset($settings['pin_effect']) ? $settings['pin_effect'] : 'no',
            'tab_slide_add_dot' => isset($settings['tab_slide_add_dot']) ? $settings['tab_slide_add_dot'] : 'yes',
            'pin_multi_reverse' => isset($settings['pin_multi_reverse']) ? $settings['pin_multi_reverse'] : 'no',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Pin_Multi_Products_Banner_Elm());
