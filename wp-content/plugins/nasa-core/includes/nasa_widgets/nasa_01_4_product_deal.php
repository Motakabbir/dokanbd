<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Product_Deal_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_product_deal';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-product-deal';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Product Deal';
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
            'product_id',
            [
                'label'   => __('Product Selected', 'nasa-core'),
                'type'    => Controls_Manager::SELECT2,
                'default' => '',
                'options' => nasa_get_list_products_deal(true),
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
            'btn_shop_now',
            [
                'label'        => __('Button Store', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        
        $this->add_control(
            'btn_text',
            [
                'label'   => __('Text Button', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'SHOP NOW'
            ]
        );
        
        $this->add_control(
            'btn_url',
            [
                'label'   => __('URL button', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Default link to shop page.', 'nasa-core'),
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
            'id' => isset($settings['product_id']) ? $settings['product_id'] : '0',
            'title' => isset($settings['title']) ? $settings['title'] : '',
            'btn_shop_now' => isset($settings['btn_shop_now']) ? $settings['btn_shop_now'] : 'yes',
            'btn_text' => isset($settings['btn_text']) ? $settings['btn_text'] : 'SHOP NOW',
            'btn_url' => isset($settings['btn_url']) ? $settings['btn_url'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Product_Deal_Elm());
