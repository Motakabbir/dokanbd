<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Client_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_client';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-client';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Testimonials';
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
            'img_src',
            [
                'label' => __('Avatar', 'nasa-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'name',
            [
                'label'   => __('Name', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'full' => __('Full', 'nasa-core'),
                    'simple' => __('Simple', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'company',
            [
                'label'   => __('Job', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Only use for Style => Full.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'clien_content',
            [
                'label'   => __('Testimonial Say', 'nasa-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => 'Some promo text'
            ]
        );
        
        $this->add_control(
            'text_align',
            [
                'label'   => __('Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core'),
                    'justify' => __('Justify', 'nasa-core'),
                ],
                'description'  => __('Only use for Style => Full.', 'nasa-core'),
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
            'img_src' => isset($settings['img_src']) && isset($settings['img_src']['id']) && $settings['img_src']['id'] ? $settings['img_src']['id'] : '',
            'name' => isset($settings['name']) ? $settings['name'] : '',
            'style' => isset($settings['style']) ? $settings['style'] : 'full',
            'company' => isset($settings['company']) ? $settings['company'] : '',
            'content' => isset($settings['clien_content']) ? $settings['clien_content'] : 'Some promo text',
            'text_align' => isset($settings['text_align']) ? $settings['text_align'] : 'center',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Client_Elm());
