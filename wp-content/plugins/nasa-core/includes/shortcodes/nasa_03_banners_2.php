<?php
/**
 * Shortcode [nasa_banner_2]...[/nasa_banner_2]
 * 
 * @param type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_banners_2($atts = array(), $content = null) {
    global $nasa_opt;
    
    $dfAtts = array(
        'align' => 'left',
        'valign' => 'top',
        'move_x' => '',
        'link' => '',
        'hover' => '',
        'banner_style' => '',
        'img' => '',
        'img_src' => '',
        'text_align' => '',
        'content_width' => '',
        'effect_text' => 'fadeIn',
        'data_delay' => '0ms',
        'border_inner' => 'no',
        'border_outner' => 'no',
        'hide_in_m' => '',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAtts, $atts));
    
    if (isset($hide_in_m) && $hide_in_m == 1) {
        $el_class .= $el_class != '' ? ' hide-for-small' : 'hide-for-small';
                
        if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) {
            return '';
        }
    }
    
    $image = wp_get_attachment_image_src($img_src, 'full');
    
    if (!$image) {
        return '';
    }
    
    /**
     * Enqueue js
     */
    /* wp_enqueue_script('nasa-sc-banners', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-banners.min.js', array('jquery'), null, true); */
    
    $class_woo = (!isset($nasa_opt['disable_wow']) || !$nasa_opt['disable_wow']) ? '' : ' animated';

    $a_class = 'nasa-banner-content banner-content';
    $a_class .= $align != '' ? ' align-' . $align : '';
    $a_class .= $valign != '' ? ' valign-' . $valign : '';
    $a_class .= $text_align != '' ? ' ' . $text_align : '';
    
    $class_wrap = 'banner nasa-banner nasa-banner-v2';
    $class_wrap .= $border_outner == 'yes' ? ' has-border-outner' : '';
    $class_wrap .= $border_inner == 'yes' ? ' has-border-inner' : '';
    $class_wrap .= $hover != '' ? ' hover-' . $hover : '';
    $class_wrap .= $el_class != '' ? ' ' . $el_class : '';
    
    $data_attrs = $data_delay != '' ? ' data-wow-delay="' . $data_delay . '"' : '';
    if ($link != '') {
        $a_class .= ' cursor-pointer';
        $data_attrs .= ' onclick="window.location=\'' . esc_url($link) . '\'"';
    }
    
    $ct_attrs = array();
    
    if ($content_width != '') {
        $ct_attrs[] = 'width: ' . $content_width;
    }
    
    if ($move_x != '') {
        if ($align == 'left') {
            $ct_attrs[] = 'left: ' . $move_x;
        }
        
        if ($align == 'right') {
            $ct_attrs[] = 'right: ' . $move_x;
        }
    }
    
    $ct_attrs_str = !empty($ct_attrs) ? ' style="' . implode('; ', $ct_attrs) . '"' : '';
    
    /**
     * Image banner
     */
    $content_data = '<img class="banner-img nasa-banner-image" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . trim(strip_tags(get_post_meta($img_src, '_wp_attachment_image_alt', true))) . '" src="' . esc_url($image[0]) . '" />';
    
    /**
     * Content Banner
     */
    $content_data .= trim($content) ?
        '<div class="' . $a_class . '"' . $ct_attrs_str . '>' .
            '<div class="banner-inner nasa-transition wow ' . $effect_text . $class_woo . '" data-animation="' . $effect_text . '">' . 
                nasa_fix_shortcode($content) .
            '</div>' .
        '</div>' : '';

    /**
     * Return Banner v2
     */
    return 
    '<div class="' . $class_wrap . '"'. $data_attrs . '>' .
        $content_data .
    '</div>';
}

// **********************************************************************// 
// ! Register New Element: Banner v2
// **********************************************************************//
function nasa_register_banner_2(){
    $banner_params = array(
        'name' => 'Banner v2',
        'base' => 'nasa_banner_2',
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Display Banner v2", 'nasa-core'),
        'category' => 'Nasa Core',
        'as_parent' => array('except' => 'nasa_banner_2'),
        'params' => array(
            array(
                'type' => 'attach_image',
                "heading" => __("Banner Image", 'nasa-core'),
                "param_name" => "img_src",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Link", 'nasa-core'),
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "param_name" => "link"
            ),
            array(
                "type" => "textfield",
                "heading" => __("Content Width (%)", 'nasa-core'),
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "param_name" => "content_width",
                "value" => '',
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Horizontal Alignment", 'nasa-core'),
                "param_name" => "align",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "value" => array(
                    __("Left", 'nasa-core') => "left",
                    __("Center", 'nasa-core') => "center",
                    __("Right", 'nasa-core') => "right"
                )
            ),
            array(
                "type" => "textfield",
                "heading" => __("Move Horizontal a distance (%)", "nasa-core"),
                "param_name" => "move_x",
                "value" => "",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "dependency" => array(
                    "element" => "align",
                    "value" => array(
                        "left",
                        "right"
                    )
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Vertical Alignment", 'nasa-core'),
                "param_name" => "valign",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "value" => array(
                    __("Top", 'nasa-core') => "top",
                    __("Middle", 'nasa-core') => "middle",
                    __("Bottom", 'nasa-core') => "bottom"
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Text Alignment", "nasa-core"),
                "param_name" => "text_align",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "value" => array(
                    __("Left", 'nasa-core') => "text-left",
                    __("Center", 'nasa-core') => "text-center",
                    __("Right", 'nasa-core') => "text-right"
                )
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Banner Content", 'nasa-core'),
                "param_name" => "content",
                "value" => "",
            ),
            array(
                "type" => "animation_style",
                "heading" => __("Effect Content", 'nasa-core'),
                "param_name" => "effect_text",
                "value" => "fadeIn"
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Animation Delay', 'nasa-core'),
                "param_name" => "data_delay",
                "value" => array(
                    __('None', 'nasa-core') => '',
                    __('0.1s', 'nasa-core') => '100ms',
                    __('0.2s', 'nasa-core') => '200ms',
                    __('0.3s', 'nasa-core') => '300ms',
                    __('0.4s', 'nasa-core') => '400ms',
                    __('0.5s', 'nasa-core') => '500ms',
                    __('0.6s', 'nasa-core') => '600ms',
                    __('0.7s', 'nasa-core') => '700ms',
                    __('0.8s', 'nasa-core') => '800ms',
                    __('0.9s', 'nasa-core') => '900ms',
                    __('1.0s', 'nasa-core') => '1000ms',
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Effect Image", 'nasa-core'),
                "param_name" => "hover",
                "value" => array(
                    __('None', 'nasa-core') => '',
                    __('Zoom', 'nasa-core') => 'zoom',
                    __('Zoom Out', 'nasa-core') => 'reduction',
                    __('Fade', 'nasa-core') => 'fade'
                )
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Border Inner", 'nasa-core'),
                "param_name" => "border_inner",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                "std" => 'no'
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Border Outner", 'nasa-core'),
                "param_name" => "border_outner",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                "std" => 'no'
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Hide in Mobile - Mobile Layout', 'nasa-core'),
                "param_name" => 'hide_in_m',
                "value" => array(
                    __('No, Thanks!', 'nasa-core') => '',
                    __('Yes, Please!', 'nasa-core') => '1'
                ),
                'std' => ''
            ),

            array(
                "type" => "textfield",
                "heading" => __("Extra Class", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'nasa-core')
            )
        )
    );

    vc_map($banner_params);
}
