<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Categories_Tree_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_categories_tree';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-categories-tree';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa - Categories Directory';
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
            'list_cats',
            [
                'label'   => __('Categories Included', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('ID or Slug, separated by ",". Ex: 1, 2 or slug-1, slug-2.', 'nasa-core'),
            ]
        );

        $this->add_control(
            'cat_product_count',
            [
                'label'        => __('Count', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '',
            ]
        );

        $this->add_control(
            'hide_cat_empty',
            [
                'label'        => __('Hide Empty', 'nasa-core'),
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
            'title' => isset($settings['title']) ? $settings['title'] : '',
            'columns_number' => isset($settings['columns_number']) ? $settings['columns_number'] : '4',
            'columns_number_small' => isset($settings['columns_number_small']) ? $settings['columns_number_small'] : '2',
            'columns_number_tablet' => isset($settings['columns_number_tablet']) ? $settings['columns_number_tablet'] : '4',
            'list_cats' => isset($settings['list_cats']) ? $settings['list_cats'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
            'cat_product_count' => isset($settings['cat_product_count']) ? $settings['cat_product_count'] : '',
            'hide_cat_empty' => isset($settings['hide_cat_empty']) ? $settings['hide_cat_empty'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Categories_Tree_Elm());
