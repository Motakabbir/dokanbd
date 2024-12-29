<?php
/**
 * Widget for Elementor
 */

/**
 * Nasa Countdown
 */
class Nasa_Countdown_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_countdown';
        $this->widget_cssclass = 'nasa_countdown_wgsc';
        $this->widget_description = __('Display Countdown Time', 'nasa-core');
        $this->widget_id = 'nasa_countdown_sc';
        $this->widget_name = 'ELM - Nasa Countdown';
        $this->settings = array(
            'date' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Date (Format: YYYY-mm-dd HH:mm:ss | YYYY/mm/dd HH:mm:ss)', 'nasa-core')
            ),
            
            'style' => array(
                'type' => 'select',
                'std' => 'digital',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'digital' => __('Digital', 'nasa-core'),
                    'text' => __('Text', 'nasa-core')
                )
            ),
            
            'align' => array(
                'type' => 'select',
                'std' => 'center',
                'label' => __('Date align (with Style: Text)', 'nasa-core'),
                'options' => array(
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'size' => array(
                'type' => 'select',
                'std' => 'small',
                'label' => __('Font size (with Style: Text)', 'nasa-core'),
                'options' => array(
                    'small' => __('Small', 'nasa-core'),
                    'large' => __('Large', 'nasa-core')
                )
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}

/**
 * Nasa Service Box
 */
class Nasa_Service_Box_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_service_box';
        $this->widget_cssclass = 'nasa_service_box_wgsc';
        $this->widget_description = __('Display Service Box', 'nasa-core');
        $this->widget_id = 'nasa_service_box';
        $this->widget_name = 'ELM - Nasa Service Box';
        $this->settings = array(
            'service_title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Service Title', 'nasa-core')
            ),
            
            'service_desc' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Service Description', 'nasa-core')
            ),
            
            'service_icon' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Service Icon. Enter icon class name. Support FontAwesome, Font Pe 7 Stroke (https://themes-pixeden.com/font-demos/7-stroke/), Font Nasa (https://elessi.nasatheme.com/wp-content/themes/elessi-theme/assets/font-nasa/icons-reference.html)', 'nasa-core')
            ),
            
            'service_html' => array(
                'type' => 'textarea_html',
                'std' => '',
                'label' => __('Icon Content', 'nasa-core')
            ),
            
            'service_link' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Service link', 'nasa-core')
            ),
            
            'service_blank' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Link Target', 'nasa-core'),
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '_blank' => __('Blank - New Window', 'nasa-core')
                )
            ),
            
            'service_style' => array(
                'type' => 'select',
                'std' => 'style-1',
                'label' => __('Service Style', 'nasa-core'),
                'options' => array(
                    'style-1' => __('Style 1', 'nasa-core'),
                    'style-2' => __('Style 2', 'nasa-core'),
                    'style-3' => __('Style 3', 'nasa-core'),
                    'style-4' => __('Style 4', 'nasa-core')
                )
            ),
            
            'service_hover' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Service Hover Effect', 'nasa-core'),
                'options' => array(
                    '' => __('None', 'nasa-core'),
                    'fly_effect' => __('Fly', 'nasa-core'),
                    'buzz_effect' => __('Buzz', 'nasa-core'),
                    'rotate_effect' => __('Rotate', 'nasa-core')
                )
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}

/**
 * Nasa Icon Box
 */
class Nasa_Icon_Box_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_icon_box';
        $this->widget_cssclass = 'nasa_icon_box_wgsc';
        $this->widget_description = __('Display Icon Box', 'nasa-core');
        $this->widget_id = 'nasa_icon_box';
        $this->widget_name = 'ELM - Nasa Icon Box';
        $this->settings = array(
            'box_img' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Box Image', 'nasa-core')
            ),
            
            'box_title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Box Title', 'nasa-core')
            ),
            
            'box_desc' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Box Description', 'nasa-core')
            ),
            
            'box_link' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Box Link', 'nasa-core')
            ),
            
            'box_blank' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Link Target', 'nasa-core'),
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '_blank' => __('Blank - New Window', 'nasa-core')
                )
            ),
            
            'box_style' => array(
                'type' => 'select',
                'std' => 'hoz',
                'label' => __('Box Style', 'nasa-core'),
                'options' => array(
                    'hoz' => __('Horizontal', 'nasa-core'),
                    'ver' => __('Vertical', 'nasa-core')
                )
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}

/**
 * Nasa Image Box
 */
class Nasa_Image_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_image';
        $this->widget_cssclass = 'nasa_image_wgsc';
        $this->widget_description = __('Display Image', 'nasa-core');
        $this->widget_id = 'nasa_image';
        $this->widget_name = 'ELM - Nasa Image';
        $this->settings = array(
            'image' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Image', 'nasa-core')
            ),
            
            'alt' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('ALT - Title', 'nasa-core')
            ),
            
            'caption' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Caption', 'nasa-core'),
                'options' => array(
                    '' => __('No, Thanks!', 'nasa-core'),
                    '1' => __('Yes, Please!', 'nasa-core')
                )
            ),
            
            'link_text' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('URL', 'nasa-core')
            ),
            
            'link_target' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Link Target', 'nasa-core'),
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '_blank' => __('Blank - New Window', 'nasa-core')
                )
            ),
            
            'align' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Align', 'nasa-core'),
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'center' => __('Center', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'hide_in_m' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Hide in Mobile - Mobile Layout', 'nasa-core'),
                'options' => array(
                    '' => __('No, Thanks!', 'nasa-core'),
                    '1' => __('Yes, Please!', 'nasa-core')
                )
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}

/**
 * Nasa Header Icons
 * 
 * Mini Cart
 * Mini Compare
 * Mini Wishlist
 */
class Nasa_Icons_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_sc_icons';
        $this->widget_cssclass = 'nasa_icons_wgsc';
        $this->widget_description = __('Display Header Icons', 'nasa-core');
        $this->widget_id = 'nasa_sc_icons';
        $this->widget_name = 'ELM - Nasa Header Icons';
        $this->settings = array(
            
            'show_mini_acc' => array(
                'type' => 'select',
                'std' => 'yes',
                'options' => $this->array_bool_YN(),
                'label' => __('Account', 'nasa-core')
            ),
            
            'show_mini_cart' => array(
                'type' => 'select',
                'std' => 'yes',
                'options' => $this->array_bool_YN(),
                'label' => __('Cart', 'nasa-core')
            ),
            
            'show_mini_compare' => array(
                'type' => 'select',
                'std' => 'yes',
                'options' => $this->array_bool_YN(),
                'label' => __('Compare', 'nasa-core')
            ),
            
            'show_mini_wishlist' => array(
                'type' => 'select',
                'std' => 'yes',
                'options' => $this->array_bool_YN(),
                'label' => __('Wishlist', 'nasa-core')
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}

/**
 * Nasa Header Search products
 * 
 */
class Nasa_Search_Products_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_sc_search_form';
        $this->widget_cssclass = 'nasa_sc_search_form_wgsc';
        $this->widget_description = __('Live Search Products', 'nasa-core');
        $this->widget_id = 'nasa_sc_search_form';
        $this->widget_name = 'ELM - Nasa Header Search';
        $this->settings = array(
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );

        parent::__construct();
    }
}
