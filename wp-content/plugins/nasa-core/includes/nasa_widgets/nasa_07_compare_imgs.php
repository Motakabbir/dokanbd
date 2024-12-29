<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Compare_Imgs_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_compare_imgs';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-compare-imgs';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Compare IMGS';
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
            'link',
            [
                'label'   => __('Link', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'desc_text',
            [
                'label'   => __('Description', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'align_text',
            [
                'label'   => __('Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'before_image',
            [
                'label' => __('Image Before', 'nasa-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'after_image',
            [
                'label' => __('Image After', 'nasa-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'el_class_img',
            [
                'label'   => __('Extra Class Images', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
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
            'link' => isset($settings['link']) ? $settings['link'] : '',
            'desc_text' => isset($settings['desc_text']) ? $settings['desc_text'] : '',
            'align_text' => isset($settings['align_text']) ? $settings['align_text'] : 'center',
            
            'before_image' => isset($settings['before_image']) && isset($settings['before_image']['id']) && $settings['before_image']['id'] ? $settings['before_image']['id'] : '',
            'after_image' => isset($settings['after_image']) && isset($settings['after_image']['id']) && $settings['after_image']['id'] ? $settings['after_image']['id'] : '',
            
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Compare_Imgs_Elm());
