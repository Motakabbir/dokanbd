<?php

namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Products_Masonry_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_products_masonry';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-products-masonry';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Products Masonry';
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
            'type',
            [
                'label'   => __('Type Show', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'recent_product',
                'options' => [
                    'recent_product' => __('Recent', 'nasa-core'),
                    'best_selling' => __('Best Selling', 'nasa-core'),
                    'featured_product' => __('Featured', 'nasa-core'),
                    'top_rate' => __('Top Rate', 'nasa-core'),
                    'on_sale' => __('On Sale', 'nasa-core'),
                    'recent_review' => __('Recent Review', 'nasa-core'),
                    'deals' => __('Deals', 'nasa-core'),
                    'stock_desc' => __('Quantity Stock - Descending', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'layout',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Type 1 (Limit 18 items)', 'nasa-core'),
                    '2' => __('Type 2 (Limit 16 items)', 'nasa-core')
                ]
            ]
        );
        
        $this->add_control(
            'loadmore',
            [
                'label'        => __('View More', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => '',
            ]
        );
        
        $this->add_control(
            'cat',
            [
                'label'   => __('Product Category', 'nasa-core'),
                'type'    => Controls_Manager::SELECT2,
                'default' => '',
                'options' => nasa_get_cat_product_array(false, true),
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
            'type' => isset($settings['type']) ? $settings['type'] : 'recent_product',
            'layout' => isset($settings['layout']) ? $settings['layout'] : '1',
            'loadmore' => isset($settings['loadmore']) ? $settings['loadmore'] : 'yes',
            'cat' => isset($settings['cat']) && $settings['cat'] ? $settings['cat'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Products_Masonry_Elm());
        