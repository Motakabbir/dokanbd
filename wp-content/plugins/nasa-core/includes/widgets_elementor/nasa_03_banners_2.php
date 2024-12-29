<?php
/**
 * Widget for Elementor
 */
class Nasa_Banner_2_WGSC extends Nasa_Elementor_Widget {

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_banner_2';
        $this->widget_cssclass = 'nasa_banner_2_wgsc';
        $this->widget_description = __('Display Banner v2', 'nasa-core');
        $this->widget_id = 'nasa_banner_2_sc';
        $this->widget_name = 'ELM - Nasa Banner v2';
        $this->settings = array(
            'img_src' => array(
                'type' => 'attach_image',
                'std' => '',
                'label' => __('Banner Image', 'nasa-core')
            ),
            
            'link' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Link', 'nasa-core')
            ),
            
            'content_width' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Content Width (%)', 'nasa-core')
            ),
            
            'align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Horizontal Alignment', 'nasa-core'),
                'options' => array(
                    'left' => __('Left', 'nasa-core'),
                    'center' => __('Center', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'move_x' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Move Horizontal a distance (%)', 'nasa-core')
            ),
            
            'valign' => array(
                'type' => 'select',
                'std' => 'top',
                'label' => __('Vertical Alignment', 'nasa-core'),
                'options' => array(
                    'top' => __('Top', 'nasa-core'),
                    'middle' => __('Middle', 'nasa-core'),
                    'bottom' => __('Bottom', 'nasa-core')
                )
            ),
            
            'text_align' => array(
                'type' => 'select',
                'std' => 'text-left',
                'label' => __('Text Alignment', 'nasa-core'),
                'options' => array(
                    'text-left' => __('Left', 'nasa-core'),
                    'text-center' => __('Center', 'nasa-core'),
                    'text-right' => __('Right', 'nasa-core')
                )
            ),
            
            'content' => array(
                'type' => 'textarea_html',
                'std' => '',
                'label' => __('Banner Content', 'nasa-core')
            ),
            
            'effect_text' => array(
                'type' => 'select',
                'std' => 'none',
                'label' => __('Effect Banner Content', 'nasa-core'),
                'options' => array(
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
                )
            ),
            
            'data_delay' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Animation Delay', 'nasa-core'),
                'options' => array(
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
                )
            ),
            
            'hover' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Effect Image', 'nasa-core'),
                'options' => array(
                    '' => __('None', 'nasa-core'),
                    'zoom' => __('Zoom', 'nasa-core'),
                    'reduction' => __('Zoom Out', 'nasa-core'),
                    'fade' => __('Fade', 'nasa-core')
                )
            ),
            
            'border_inner' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Border Inner', 'nasa-core'),
                'options' => $this->array_bool_YN()
            ),
            
            'border_outner' => array(
                'type' => 'select',
                'std' => 'no',
                'label' => __('Border Outner', 'nasa-core'),
                'options' => $this->array_bool_YN()
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
