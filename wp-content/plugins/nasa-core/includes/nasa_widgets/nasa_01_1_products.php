<?php

namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

/**
 * Widget for Elementor
 */
class Nasa_Products_Elm extends Nasa_ELM_Widgets_Abs {
    
    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_products';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-products';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Products';
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
            'title_shortcode',
            [
                'label'   => __('Title', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Only using for Style is Slider, Simple Slide.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'title_align',
            [
                'label'   => __('Title Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                ],
                'description'  => __('Only use for Style is Slider.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'type',
            [
                'label'   => __('Type Show', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'recent_product',
                'options' => [
                    'recent_product' => __('Recent Products', 'nasa-core'),
                    'best_selling' => __('Best Selling', 'nasa-core'),
                    'featured_product' => __('Featured Products', 'nasa-core'),
                    'top_rate' => __('Top Rate', 'nasa-core'),
                    'on_sale' => __('On Sale', 'nasa-core'),
                    'recent_review' => __('Recent Review', 'nasa-core'),
                    'deals' => __('Deals', 'nasa-core'),
                    'stock_desc' => __('Quantity Stock - Descending', 'nasa-core')
                ],
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
                    'carousel' => __('Slider', 'nasa-core'),
                    'slide_slick' => __('Simple Slider', 'nasa-core'),
                    'slide_slick_2' => __('Simple Slider v2', 'nasa-core'),
                    'infinite' => __('Ajax Infinite', 'nasa-core'),
                    'list' => __('List - Widget Items', 'nasa-core'),
                    'list_carousel' => __('Slider - Widget Items', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'style_viewmore',
            [
                'label'   => __('Style View More', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('Type 1 - No Border', 'nasa-core'),
                    '2' => __('Type 2 - Border - Top - Bottom', 'nasa-core'),
                    '3' => __('Type 3 - Button - Radius - Dash', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'style_row',
            [
                'label'   => __('Rows of Slide', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __('1 Row', 'nasa-core'),
                    '2' => __('2 Rows', 'nasa-core'),
                    '3' => __('3 Rows', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'pos_nav',
            [
                'label'   => __('Position Navigation', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'both',
                'options' => [
                    'both' => __('Side Classic', 'nasa-core'),
                    'top' => __('Top - for Carousel 1 Row', 'nasa-core'),
                    'left' => __('Side', 'nasa-core')
                ],
                'description'  => __('The Top Only use for Style is Carousel.', 'nasa-core'),
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
                'default'      => '',
                'description'  => __('Only use for Style is Slider or Simple Slide.', 'nasa-core'),
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
                'description'  => __('Only use for Style is Slider or Simple Slide 2.', 'nasa-core'),
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
                'description'  => __('Only use for Style is Slider, Simple Slide 2, Slider - Widget Items.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'auto_delay_time',
            [
                'label'   => __('Delay (s)', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '6',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'number',
            [
                'label'   => __('Limit', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '8',
                // 'description'  => __('.', 'nasa-core'),
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
            'cat',
            [
                'label'   => __('Product Category', 'nasa-core'),
                'type'    => Controls_Manager::SELECT2,
                'default' => '',
                'options' => nasa_get_cat_product_array(false, true),
            ]
        );
        
        $this->add_control(
            'ns_tags',
            [
                'label'   => __('Tags', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Slug of tags, separated by ","', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'ns_brand',
            [
                'label'   => __('Nasa Brand', 'nasa-core'),
                'type'    => Controls_Manager::SELECT2,
                'default' => '',
                'options' => nasa_get_brands_product_array(false, true),
            ]
        );
        
        if (defined('PWB_PLUGIN_NAME')) {
            $this->add_control(
                'pwb_brand',
                [
                    'label'   => __('Product PWB Brand', 'nasa-core'),
                    'type'    => Controls_Manager::SELECT2,
                    'default' => '',
                    'options' => nasa_get_pwb_brands_product_array(false, true),
                ]
            );
        }
        
        $this->add_control(
            'not_in',
            [
                'label'   => __('Excludes Product Ids', 'nasa-core'),
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
            'title_shortcode' => isset($settings['title_shortcode']) ? $settings['title_shortcode'] : '',
            'type' => isset($settings['type']) ? $settings['type'] : 'recent_product',
            'style' => isset($settings['style']) ? $settings['style'] : 'grid',
            'style_viewmore' => isset($settings['style_viewmore']) ? $settings['style_viewmore'] : '1',
            'style_row' => isset($settings['style_row']) ? $settings['style_row'] : '1',
            'pos_nav' => isset($settings['pos_nav']) ? $settings['pos_nav'] : 'both',
            'title_align' => isset($settings['title_align']) ? $settings['title_align'] : 'left',
            'shop_url' => isset($settings['shop_url']) ? $settings['shop_url'] : '0',
            'arrows' => isset($settings['arrows']) && $settings['arrows'] ? $settings['arrows'] : '0',
            'dots' => isset($settings['dots']) && $settings['dots'] ? $settings['dots'] : 'false',
            'auto_slide' => isset($settings['auto_slide']) && $settings['auto_slide'] ? $settings['auto_slide'] : 'false',
            'loop_slide' => isset($settings['loop_slide']) && $settings['loop_slide'] ? $settings['loop_slide'] : 'false',
            'auto_delay_time' => isset($settings['auto_delay_time']) && $settings['auto_delay_time'] ? $settings['auto_delay_time'] : '6',
            'number' => isset($settings['number']) && $settings['number'] ? $settings['number'] : '8',
            'columns_number' => isset($settings['columns_number']) && $settings['columns_number'] ? $settings['columns_number'] : '4',
            'columns_number_small' => isset($settings['columns_number_small']) && $settings['columns_number_small'] ? $settings['columns_number_small'] : '2',
            'columns_number_small_slider' => isset($settings['columns_number_small_slider']) && $settings['columns_number_small_slider'] ? $settings['columns_number_small_slider'] : '2',
            'columns_number_tablet' => isset($settings['columns_number_tablet']) && $settings['columns_number_tablet'] ? $settings['columns_number_tablet'] : '3',
            
            'cat' => isset($settings['cat']) && $settings['cat'] ? $settings['cat'] : '',
            'ns_tags' => isset($settings['ns_tags']) && $settings['ns_tags'] ? $settings['ns_tags'] : '',
            'ns_brand' => isset($settings['ns_brand']) && $settings['ns_brand'] ? $settings['ns_brand'] : '',
            'pwb_brand' => isset($settings['pwb_brand']) && $settings['pwb_brand'] ? $settings['pwb_brand'] : '',
            
            'not_in' => isset($settings['not_in']) && $settings['not_in'] ? $settings['not_in'] : '',
            
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Products_Elm());
