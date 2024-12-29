<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Instagram_Feed_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_instagram_feed';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-instagram-feed';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Instagram Feed';
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
            'username_show',
            [
                'label'   => __('Username', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'instagram_link',
            [
                'label'   => __('Link Follow', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'shortcode_txt',
            [
                'label'   => __('Shortcode Text', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'img_size',
            [
                'label'   => __('Image Size', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'full' => __('Large', 'nasa-core'),
                    'medium' => __('Medium', 'nasa-core'),
                    'thumb' => __('Thumbnail', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'disp_type',
            [
                'label'   => __('Display type', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => __('Grid', 'nasa-core'),
                    'slide' => __('Slider', 'nasa-core'),
                    'zz' => __('Zic Zac', 'nasa-core')
                ]
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
                // 'description'  => __('.', 'nasa-core'),
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
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'limit_items',
            [
                'label'   => __('Photos Limit', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'default'  => '6',
            ]
        );
        
        $this->add_control(
            'columns_number',
            [
                'label'   => __('Columns Number', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '6',
                'options' => [
                    '10' => '10',
                    '9' => '9',
                    '8' => '8',
                    '7' => '7',
                    '6' => '6',
                    '5' => '5',
                    '4' => '4',
                ],
            ]
        );
        
        $this->add_control(
            'columns_number_tablet',
            [
                'label'   => __('Columns Medium', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '2',
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
            'columns_number_small',
            [
                'label'   => __('Columns Small', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '6' => '6',
                    '5' => '5',
                    '4' => '4',
                    '3' => '3',
                    '2' => '2',
                    '1' => '1'
                ],
            ]
        );
        
        $this->add_control(
            'el_class_img',
            [
                'label'   => __('Extra Class Image', 'nasa-core'),
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
        
        $shortcode_text = isset($settings['shortcode_txt']) ? $settings['shortcode_txt'] : '';
        $shortcode_text = $shortcode_text ? str_replace(['[', ']'], ['`{`', '`}`'], $shortcode_text) : '';
        
        $atts = [
            'username_show' => isset($settings['username_show']) ? $settings['username_show'] : '',
            'instagram_link' => isset($settings['instagram_link']) ? $settings['instagram_link'] : '',
            'shortcode_txt' => $shortcode_text,
            'img_size' => isset($settings['img_size']) ? $settings['img_size'] : 'full',
            'disp_type' => isset($settings['disp_type']) ? $settings['disp_type'] : 'default',
            'auto_slide' => isset($settings['auto_slide']) ? $settings['auto_slide'] : '',
            'loop_slide' => isset($settings['loop_slide']) ? $settings['loop_slide'] : '',
            'limit_items' => isset($settings['limit_items']) ? $settings['limit_items'] : '6',
            'columns_number' => isset($settings['columns_number']) ? $settings['columns_number'] : '6',
            'columns_number_tablet' => isset($settings['columns_number_tablet']) ? $settings['columns_number_tablet'] : '2',
            'columns_number_small' => isset($settings['columns_number_small']) ? $settings['columns_number_small'] : '1',
            'el_class_img' => isset($settings['el_class_img']) ? $settings['el_class_img'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Instagram_Feed_Elm());
