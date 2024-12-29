<?php
namespace Nasa_Core\Nasa_Widgets;

use Elementor\Plugin;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Nasa_Core\Nasa_ELM_Widgets_Abs;

/**
 * Nasa Countdown
 */
class Nasa_Countdown_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_countdown';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-countdown';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Countdown';
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
            'date',
            [
                'label'   => __('Date', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Format: YYYY-mm-dd HH:mm:ss | YYYY/mm/dd HH:mm:ss.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'style',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'digital',
                'options' => [
                    'digital' => __('Digital', 'nasa-core'),
                    'text' => __('Text', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'align',
            [
                'label'   => __('Date alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'center',
                'options' => [
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                ],
                'description'  => __('Only use with Style: Text.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'size',
            [
                'label'   => __('Font size', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'small',
                'options' => [
                    'small' => __('Small', 'nasa-core'),
                    'large' => __('Large', 'nasa-core')
                ],
                'description'  => __('Only use with Style: Text.', 'nasa-core'),
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
            'date' => isset($settings['date']) ? $settings['date'] : '',
            'style' => isset($settings['style']) ? $settings['style'] : 'digital',
            'align' => isset($settings['align']) ? $settings['align'] : 'center',
            'size' => isset($settings['size']) ? $settings['size'] : 'small',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

/**
 * Nasa Service Box
 */
class Nasa_Service_Box_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_service_box';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-service-box';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Service Box';
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
            'service_title',
            [
                'label'   => __('Title', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'service_desc',
            [
                'label'   => __('Description', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'service_icon',
            [
                'label'   => __('Icon', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'description'  => __('Enter icon class name. Support FontAwesome, Font Pe 7 Stroke (https://themes-pixeden.com/font-demos/7-stroke/), Font Nasa (https://elessi.nasatheme.com/wp-content/themes/elessi-theme/assets/font-nasa/icons-reference.html.)', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'service_html',
            [
                'label'   => __('Icon Content', 'nasa-core'),
                'type'    => Controls_Manager::TEXTAREA,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'service_link',
            [
                'label'   => __('Link', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'service_blank',
            [
                'label'        => __('Link Target Blank', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '_blank',
                'default'      => '',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'service_style',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                    'style-1' => __('Style 1', 'nasa-core'),
                    'style-2' => __('Style 2', 'nasa-core'),
                    'style-3' => __('Style 3', 'nasa-core'),
                    'style-4' => __('Style 4', 'nasa-core')
                ],
            ]
        );
        
        $this->add_control(
            'service_hover',
            [
                'label'   => __('Hover Effect', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('None', 'nasa-core'),
                    'fly_effect' => __('Fly', 'nasa-core'),
                    'buzz_effect' => __('Buzz', 'nasa-core'),
                    'rotate_effect' => __('Rotate', 'nasa-core')
                ],
                // 'description'  => __('.', 'nasa-core'),
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
            'service_title' => isset($settings['service_title']) ? $settings['service_title'] : '',
            'service_desc' => isset($settings['service_desc']) ? $settings['service_desc'] : '',
            'service_icon' => isset($settings['service_icon']) ? $settings['service_icon'] : '',
            'service_html' => isset($settings['service_html']) ? $settings['service_html'] : '',
            'service_link' => isset($settings['service_link']) ? $settings['service_link'] : '',
            'service_blank' => isset($settings['service_blank']) ? $settings['service_blank'] : '',
            'service_style' => isset($settings['service_style']) ? $settings['service_style'] : 'style-1',
            'service_hover' => isset($settings['service_hover']) ? $settings['service_hover'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
            'vc_type' => '0'
        ];
        
        $this->render_shortcode_text($atts);
    }
}

/**
 * Nasa Icon Box
 */
class Nasa_Icon_Box_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_icon_box';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-icon-box';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Icon Box';
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
            'box_img',
            [
                'label' => __('Image', 'nasa-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'box_title',
            [
                'label'   => __('Title', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'box_desc',
            [
                'label'   => __('Description', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'box_link',
            [
                'label'   => __('Link', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'box_blank',
            [
                'label'        => __('Link Target Blank', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '_blank',
                'default'      => '',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'box_style',
            [
                'label'   => __('Style', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hoz',
                'options' => [
                    'hoz' => __('Horizontal', 'nasa-core'),
                    'ver' => __('Vertical', 'nasa-core')
                ],
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
            'box_img' => isset($settings['box_img']) && isset($settings['box_img']['id']) && $settings['box_img']['id'] ? $settings['box_img']['id'] : '',
            'box_title' => isset($settings['box_title']) ? $settings['box_title'] : '',
            'box_desc' => isset($settings['box_desc']) ? $settings['box_desc'] : '',
            'box_link' => isset($settings['box_link']) ? $settings['box_link'] : '',
            'box_blank' => isset($settings['box_blank']) ? $settings['box_blank'] : '',
            'box_style' => isset($settings['box_style']) ? $settings['box_style'] : 'hoz',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

/**
 * Nasa Image Box
 */
class Nasa_Image_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_image';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-image';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Image';
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
            'image_src',
            [
                'label' => __('Image', 'nasa-core'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $this->add_control(
            'alt',
            [
                'label'   => __('ALT - Title', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'caption',
            [
                'label'        => __('Caption', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '1',
                'default'      => '',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'link_text',
            [
                'label'   => __('Link', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'link_target',
            [
                'label'        => __('Link Target Blank', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => '_blank',
                'default'      => '',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'align',
            [
                'label'   => __('Alignment', 'nasa-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __('Default', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'center' => __('Center', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                ],
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
                // 'description'  => __('.', 'nasa-core'),
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
            'image' => isset($settings['image_src']) && isset($settings['image_src']['id']) && $settings['image_src']['id'] ? $settings['image_src']['id'] : '',
            'alt' => isset($settings['alt']) ? $settings['alt'] : '',
            'caption' => isset($settings['caption']) ? $settings['caption'] : '',
            'link_text' => isset($settings['link_text']) ? $settings['link_text'] : '',
            'link_target' => isset($settings['link_target']) ? $settings['link_target'] : '',
            'align' => isset($settings['align']) ? $settings['align'] : '',
            'hide_in_m' => isset($settings['hide_in_m']) ? $settings['hide_in_m'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

/**
 * Nasa Header Icons
 * 
 * Mini Cart
 * Mini Compare
 * Mini Wishlist
 */
class Nasa_Icons_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_sc_icons';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-sc-icons';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Header Icons';
    }
    
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['ns-header-elements'];
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
            'show_mini_acc',
            [
                'label'        => __('Mini Account', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'show_mini_cart',
            [
                'label'        => __('Mini Cart', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'show_mini_compare',
            [
                'label'        => __('Mini Compare', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        $this->add_control(
            'show_mini_wishlist',
            [
                'label'        => __('Mini Wishlist', 'nasa-core'),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __('Yes', 'nasa-core'),
                'label_off'    => __('No', 'nasa-core'),
                'return_value' => 'yes',
                'default'      => 'yes',
                // 'description'  => __('.', 'nasa-core'),
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
            'show_mini_acc' => isset($settings['show_mini_acc']) ? $settings['show_mini_acc'] : 'yes',
            'show_mini_cart' => isset($settings['show_mini_cart']) ? $settings['show_mini_cart'] : 'yes',
            'show_mini_compare' => isset($settings['show_mini_compare']) ? $settings['show_mini_compare'] : 'yes',
            'show_mini_wishlist' => isset($settings['show_mini_wishlist']) ? $settings['show_mini_wishlist'] : 'yes',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

/**
 * Nasa Contact Form 7
 */
class Nasa_CF7_Elm extends Nasa_ELM_Widgets_Abs {
    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_cf7';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-cf7';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa - Contact Form 7';
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
            'cf7',
            [
                'label' => __('CF7 Items', 'nasa-core'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'options' => nasa_get_cf7_array(),
            ]
        );
        
        $this->add_control(
            'title',
            [
                'label'   => __('Title', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                // 'description'  => __('.', 'nasa-core'),
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
        if (!shortcode_exists('contact-form-7')) {
            return;
        }
        
        $settings = $this->get_settings_for_display();
        
        if (!isset($settings['cf7']) && isset($settings['id'])) {
            $cf7 = $settings['id'];
        } else {
            $cf7 = isset($settings['cf7']) ? $settings['cf7'] : '';
        }
        
        $atts = [
            'id' => $cf7,
            'title' => isset($settings['title']) ? $settings['title'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

/**
 * Nasa Header Search products
 * 
 */
class Nasa_Search_Products_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_sc_search_form';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-sc-search-form';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Header Search';
    }
    
    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['ns-header-elements'];
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
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

/**
 * Nasa Boot Rate
 */
class Nasa_Boot_Rate_Elm extends Nasa_ELM_Widgets_Abs {

    /**
     * @return string Shortcode name.
     */
    protected function _shortcode() {
        return 'nasa_boot_rate';
    }

    /**
     * Retrieve the widget name.
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'nasa-boot-rate';
    }

    /**
     * Retrieve the widget title.
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return 'Nasa Boot Rate';
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
            'name',
            [
                'label'   => __('Customer Name', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                // 'description'  => __('.', 'nasa-core'),
            ]
        );
        
        //WYSIWYG
        $this->add_control(
            'text',
            [
                'label'   => __('Customer Says', 'nasa-core'),
                'type'    => Controls_Manager::TEXTAREA,
                'default' => '',
            ]
        );
        
        $this->add_control(
            'el_class',
            [
                'label'   => __('Extra class name', 'nasa-core'),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
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
            'name' => isset($settings['name']) ? $settings['name'] : '',
            'text' => isset($settings['text']) ? $settings['text'] : '',
            'el_class' => isset($settings['el_class']) ? $settings['el_class'] : '',
        ];
        
        $this->render_shortcode_text($atts);
    }
}

// Register Widgets.
Plugin::instance()->widgets_manager->register(new Nasa_Countdown_Elm());
Plugin::instance()->widgets_manager->register(new Nasa_Service_Box_Elm());
Plugin::instance()->widgets_manager->register(new Nasa_Icon_Box_Elm());
Plugin::instance()->widgets_manager->register(new Nasa_Image_Elm());

Plugin::instance()->widgets_manager->register(new Nasa_CF7_Elm());

Plugin::instance()->widgets_manager->register(new Nasa_Boot_Rate_Elm());

Plugin::instance()->widgets_manager->register(new Nasa_Icons_Elm());
Plugin::instance()->widgets_manager->register(new Nasa_Search_Products_Elm());
