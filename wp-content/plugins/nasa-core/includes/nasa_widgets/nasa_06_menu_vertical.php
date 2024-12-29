<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Menu_Vertical_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_menu_vertical';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-menu-vertical';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Menu Vertical';
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
            'menu',
            [
                'label'   => __('Menu Selected', 'nasa-core'),
                'type'    => Controls_Manager::SELECT2,
                'default' => '',
                'options' => nasa_get_menu_options(true),
            ]
        );
        
        $this->add_control(
            'menu_align',
            [
                'label'   => __('Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
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
            'title' => isset($settings['title']) ? $settings['title'] : '',
            'menu' => isset($settings['menu']) ? $settings['menu'] : '',
            'menu_align' => isset($settings['menu_align']) ? $settings['menu_align'] : 'left',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Menu_Vertical_Elm());
