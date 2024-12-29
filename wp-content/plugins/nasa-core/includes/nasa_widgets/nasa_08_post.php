<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

class Nasa_Posts_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_post';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-post';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Posts';
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
            'title_desc',
            [
                'label'   => __('Description', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'show_type',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __('Slider', 'nasa-core'),
                    'grid' => __('Grid 1', 'nasa-core'),
                    'grid_2' => __('Grid 2', 'nasa-core'),
                    'grid_3' => __('Grid 3 - Only show 2 posts', 'nasa-core'),
                    'list' => __('List', 'nasa-core'),
                ],
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
            'arrows',
            [
                'label'        => __('Arrows', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '',
                // 'description'  => __('.', 'nasa-core'),
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
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'number_posts',
            [
                'label'   => __('Posts number', 'nasa-core'),
                'type'    => Controls_Manager::NUMBER,
                'default' => '8',
                'description'  => __('Not use with Grid 3.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'columns_number',
            [
                'label'   => __('Columns Number', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
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
                'default' => '2',
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
                'default' => '1',
                'options' => [
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
                    '2'     => '2',
                    '1.5'   => '1.5',
                    '1'     => '1'
                ],
            ]
        );
        
        $this->add_control(
            'post_category',
            [
                'label'   => __('Categories', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Input categories slug Divide with "," Ex: slug-1, slug-2 ...', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'cats_enable',
            [
                'label'        => __('Categories Info', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'date_enable',
            [
                'label'        => __('Date Info', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'author_enable',
            [
                'label'        => __('Author Info', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'readmore',
            [
                'label'        => __('Read more', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'date_author',
            [
                'label'   => __('Position Info', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'bot',
                'options' => [
                    'bot' => __('Bottom', 'nasa-core'),
                    'top' => __('Top', 'nasa-core')
                ],
                'description'  => __('Date/Author/Readmore position with description', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'des_enable',
            [
                'label'        => __('Show description', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => '',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'page_blogs',
            [
                'label'        => __('Button page blogs', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'info_align',
            [
                'label'   => __('Alignment Info', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'bot',
                'options' => [
                    'left' => __('Left (RTL - Right)', 'nasa-core'),
                    'right' => __('Right (RTL - Left)', 'nasa-core')
                ],
                'description'  => __('Only With List Style.', 'nasa-core'),
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
            'title_desc' => isset($settings['title_desc']) ? $settings['title_desc'] : '',
            'show_type' => isset($settings['show_type']) ? $settings['show_type'] : 'slide',
            'auto_slide' => isset($settings['auto_slide']) ? $settings['auto_slide'] : '',
            'loop_slide' => isset($settings['loop_slide']) ? $settings['loop_slide'] : '',
            'arrows' => isset($settings['arrows']) ? $settings['arrows'] : '',
            'dots' => isset($settings['dots']) ? $settings['dots'] : '',
            'posts' => isset($settings['number_posts']) ? $settings['number_posts'] : '8',
            'columns_number' => isset($settings['columns_number']) ? $settings['columns_number'] : '3',
            'columns_number_small' => isset($settings['columns_number_small']) ? $settings['columns_number_small'] : '1',
            'columns_number_small_slider' => isset($settings['columns_number_small_slider']) ? $settings['columns_number_small_slider'] : '1',
            'columns_number_tablet' => isset($settings['columns_number_tablet']) ? $settings['columns_number_tablet'] : '2',
            'category' => isset($settings['post_category']) ? $settings['post_category'] : '',
            'cats_enable' => isset($settings['cats_enable']) ? $settings['cats_enable'] : 'yes',
            'date_enable' => isset($settings['date_enable']) ? $settings['date_enable'] : 'yes',
            'author_enable' => isset($settings['author_enable']) ? $settings['author_enable'] : 'yes',
            'readmore' => isset($settings['readmore']) ? $settings['readmore'] : 'yes',
            'date_author' => isset($settings['date_author']) ? $settings['date_author'] : 'bot',
            'des_enable' => isset($settings['des_enable']) ? $settings['des_enable'] : '',
            'page_blogs' => isset($settings['page_blogs']) ? $settings['page_blogs'] : 'yes',
            'info_align' => isset($settings['info_align']) ? $settings['info_align'] : 'left',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Posts_Elm());
