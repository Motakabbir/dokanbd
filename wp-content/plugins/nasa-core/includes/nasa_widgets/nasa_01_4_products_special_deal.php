<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Products_Special_Deal_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_products_special_deal';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-products-special-deal';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Products Special Deal';
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
            'limit',
            [
                'label'   => __('Limit', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '4',
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
            'style',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'simple',
                'options' => [
                    'simple' => __('Simple Deals', 'nasa-core'),
                    'multi' => __('Has Nav 2 Items', 'nasa-core'),
                    'multi-2' => __('Has Nav 4 Items', 'nasa-core'),
                    'for_time' => __('Deal Before Time', 'nasa-core'),
                    'for_time-2' => __('Deal Before Time V2', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Not Use for Nav 2 Items.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'title_align',
            [
                'label'        => __('Title Centered', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '',
                'description'  => __('For Deal Before Time V2.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'desc_shortcode',
            [
                'label'   => __('Description', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Only for Deal Before Time.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'date_sc',
            [
                'label'   => __('End Date', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Show deals (yyyy-mm-dd | yyyy/mm/dd) for Deal Before Time.', 'nasa-core'),
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
                    '3'     => '3',
                    '2'     => '2',
                    '1.5'   => '1.5',
                    '1'     => '1'
                ],
            ]
        );
        
        $this->add_control(
            'statistic',
            [
                'label'        => __('Available - Sold', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '1',
                // 'description'  => __('', 'nasa-core'),
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
                'default'      => '1',
                // 'description'  => __('', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'arrows_pos',
            [
                'label'   => __('Arrows Position', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '0',
                'options' => [
                    '0' => __('Top', 'nasa-core'),
                    '1' => __('Side', 'nasa-core')
                ],
                'description'  => __('For Simple Deals', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'auto_slide',
            [
                'label'        => __('Auto Slide', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'true',
                'default'      => 'true',
                // 'description'  => __('', 'nasa-core'),
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
                'description'  => __('For Deal Before Time, Simple Deals', 'nasa-core'),
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
            'limit' => isset($settings['limit']) ? $settings['limit'] : '4',
            'cat' => isset($settings['cat']) ? $settings['cat'] : '',
            'style' => isset($settings['style']) ? $settings['style'] : 'simple',
            'title' => isset($settings['title']) ? $settings['title'] : '',
            'title_align' => isset($settings['title_align']) ? $settings['title_align'] : '0',
            'desc_shortcode' => isset($settings['desc_shortcode']) ? $settings['desc_shortcode'] : '',
            'date_sc' => isset($settings['date_sc']) ? $settings['date_sc'] : '',
            'columns_number' => isset($settings['columns_number']) ? $settings['columns_number'] : '4',
            'columns_number_small' => isset($settings['columns_number_small']) ? $settings['columns_number_small'] : '2',
            'columns_number_tablet' => isset($settings['columns_number_tablet']) ? $settings['columns_number_tablet'] : '3',
            'statistic' => isset($settings['statistic']) ? $settings['statistic'] : '1',
            'arrows' => isset($settings['arrows']) ? $settings['arrows'] : '1',
            'arrows_pos' => isset($settings['arrows_pos']) ? $settings['arrows_pos'] : '0',
            'auto_slide' => isset($settings['auto_slide']) ? $settings['auto_slide'] : 'true',
            'loop_slide' => isset($settings['loop_slide']) ? $settings['loop_slide'] : 'true',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}
// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Products_Special_Deal_Elm());
