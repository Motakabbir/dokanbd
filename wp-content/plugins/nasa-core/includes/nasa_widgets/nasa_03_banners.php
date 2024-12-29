<?php

namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

/**
 * Widget for Elementor
 */
class Nasa_Banner_1_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_banner';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-banner-v1';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Banner v1';
    }
    
    /**
     * Register controls.
     *
     * @access protected
     */
    protected function register_controls() {
        
        $this->start_controls_section(
            'section_menu',
            [
                'label' => __('Settings', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'img_src',
            [
                'label' => __('Choose an image', 'nasa-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'link',
            [
                'label' => __('Link', 'nasa-core'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('https://your-link.com', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'height',
            [
                'label'   => __('Banner Height', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
            ]
        );
        
        $this->add_control(
            'width',
            [
                'label'   => __('Banner Width', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
            ]
        );
        
        $this->add_control(
            'content_width',
            [
                'label'   => __('Content Width (%)', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'align',
            [
                'label'   => __('Horizontal Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __('Left', 'nasa-core'),
                    'center' => __('Center', 'nasa-core'),
                    'right' => __('Right', 'nasa-core'),
                ]
            ]
        );
        
        $this->add_control(
            'move_x',
            [
                'label'   => __('Move (%)', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Move Horizontal a distance (%)', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'valign',
            [
                'label'   => __('Vertical Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => [
                    'top' => __('Top', 'nasa-core'),
                    'middle' => __('Middle', 'nasa-core'),
                    'bottom' => __('Bottom', 'nasa-core')
                ]
            ]
        );
        
        $this->add_control(
            'text_align',
            [
                'label'   => __('Text Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'text-left',
                'options' => [
                    'text-left' => __('Left', 'nasa-core'),
                    'text-center' => __('Center', 'nasa-core'),
                    'text-right' => __('Right', 'nasa-core')
                ]
            ]
        );
        
        $this->add_control(
            'banner_responsive',
            [
                'label'        => __('Responsive', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        //WYSIWYG
        $this->add_control(
            'content_banner',
            [
                'label'   => __('Content', 'nasa-core'),
                'type'    => Controls_Manager::WYSIWYG,
                'default' => '<h3>BANNER TEXT.</h3>',
            ]
        );
        
        $this->add_control(
            'effect_text',
            [
                'label'   => __('Effect Content', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __('None', 'nasa-core'),
                    'fadeIn' => __('fadeIn', 'nasa-core'),
                    'fadeInDown' => __('fadeInDown', 'nasa-core'),
                    'fadeInUp' => __('fadeInUp', 'nasa-core'),
                    'fadeInLeft' => __('fadeInLeft', 'nasa-core'),
                    'fadeInRight' => __('fadeInRight', 'nasa-core'),
                    'slideInDown' => __('slideInDown', 'nasa-core'),
                    'slideInUp' => __('slideInUp', 'nasa-core'),
                    'slideInLeft' => __('slideInLeft', 'nasa-core'),
                    'slideInRight' => __('slideInRight', 'nasa-core'),
                    'flipInX' => __('flipInX', 'nasa-core'),
                    'flipInY' => __('flipInY', 'nasa-core'),
                    'lightSpeedIn' => __('lightSpeedIn', 'nasa-core'),
                    'rotateInDownLeft' => __('rotateInDownLeft', 'nasa-core'),
                    'rotateInDownRight' => __('rotateInDownRight', 'nasa-core'),
                    'rotateInUpLeft' => __('rotateInUpLeft', 'nasa-core'),
                    'rotateInUpRight' => __('rotateInUpRight', 'nasa-core'),
                    'zoomIn' => __('zoomIn', 'nasa-core'),
                    'zoomInDown' => __('zoomInDown', 'nasa-core'),
                    'zoomInLeft' => __('zoomInLeft', 'nasa-core'),
                    'zoomInRight' => __('zoomInRight', 'nasa-core'),
                    'zoomInUp' => __('zoomInUp', 'nasa-core'),
                    'bounceIn' => __('bounceIn', 'nasa-core'),
                    'bounceInDown' => __('bounceInDown', 'nasa-core'),
                    'bounceInLeft' => __('bounceInLeft', 'nasa-core'),
                    'bounceInRight' => __('bounceInRight', 'nasa-core'),
                    'bounceInUp' => __('bounceInUp', 'nasa-core')
                ]
            ]
        );
        
        $this->add_control(
            'data_delay',
            [
                'label'   => __('Animation Delay', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'nasa-core'),
                    '100ms' => __('0.1s', 'nasa-core'),
                    '200ms' => __('0.2s', 'nasa-core'),
                    '300ms' => __('0.3s', 'nasa-core'),
                    '400ms' => __('0.4s', 'nasa-core'),
                    '500ms' => __('0.5s', 'nasa-core'),
                    '600ms' => __('0.6s', 'nasa-core'),
                    '700ms' => __('0.7s', 'nasa-core'),
                    '800ms' => __('0.8s', 'nasa-core'),
                    '900ms' => __('0.9s', 'nasa-core'),
                    '1000ms' => __('1s', 'nasa-core')
                ]
            ]
        );
        
        $this->add_control(
            'hover',
            [
                'label'   => __('Effect Image', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'nasa-core'),
                    'zoom' => __('Zoom', 'nasa-core'),
                    'reduction' => __('Zoom Out', 'nasa-core'),
                    'fade' => __('Fade', 'nasa-core')
                ]
            ]
        );
        
        $this->add_control(
            'border_inner',
            [
                'label'        => __('Border Inner', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );
        
        $this->add_control(
            'border_outner',
            [
                'label'        => __('Border Outner', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );
        
        $this->add_control(
            'hide_in_m',
            [
                'label'        => __('Hide in Mobile', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '',
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
            'link'              => isset($settings['link']) ? $settings['link'] : '',
            'height'            => isset($settings['height']) ? $settings['height'] : '',
            'width'             => isset($settings['width']) ? $settings['width'] : '',
            'banner_responsive' => isset($settings['banner_responsive']) ? $settings['banner_responsive'] : 'yes',
            'content-width'     => isset($settings['content_width']) ? $settings['content_width'] : '',
            'align'             => isset($settings['align']) ? $settings['align'] : 'left',
            'move_x'            => isset($settings['move_x']) ? $settings['move_x'] : '',
            'valign'            => isset($settings['valign']) ? $settings['valign'] : 'top',
            'text-align'        => isset($settings['text_align']) ? $settings['text_align'] : 'text-left',
            'content'           => isset($settings['content_banner']) ? $settings['content_banner'] : '',
            'effect_text'       => isset($settings['effect_text']) ? $settings['effect_text'] : 'none',
            'data_delay'        => isset($settings['data_delay']) ? $settings['data_delay'] : '',
            'hover'             => isset($settings['hover']) ? $settings['hover'] : '',
            'border_inner'      => isset($settings['border_inner']) ? $settings['border_inner'] : '',
            'border_outner'     => isset($settings['border_outner']) ? $settings['border_outner'] : '',
            'hide_in_m'         => isset($settings['hide_in_m']) ? $settings['hide_in_m'] : '',
            'el_class'          => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Banner_1_Elm());
