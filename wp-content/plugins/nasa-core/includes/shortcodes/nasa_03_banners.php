<?php
/**
 * Shortcode [nasa_banner]...[/nasa_banner]
 * 
 * @param type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_banners($atts = array(), $content = null) {
    global $nasa_opt;
    
    $dfAtts = array(
        'align' => 'left',
        'valign' => 'top',
        'move_x' => '',
        'link' => '',
        'hover' => '',
        'banner_style' => '',
        'img_src' => '',
        'height' => '',
        'width' => '',
        'banner_responsive' => 'yes',
        'text-align' => '',
        'content-width' => '',
        'effect_text' => '',
        'data_delay' => '0ms',
        'border_inner' => 'no',
        'border_outner' => 'no',
        'hide_in_m' => '',
        'el_class' => ''
    );
    $a = shortcode_atts($dfAtts, $atts);
    
    if (isset($a['hide_in_m']) && $a['hide_in_m'] == 1) {
        $a['el_class'] .=  $a['el_class'] != '' ? ' hide-for-small' : 'hide-for-small';
                
        if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) {
            return '';
        }
    }
    
    /**
     * Enqueue js
     */
    wp_enqueue_script('nasa-sc-banners', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-banners.min.js', array('jquery'), null, true);
    
    $class_woo = (!isset($nasa_opt['disable_wow']) || !$nasa_opt['disable_wow']) ? '' : ' animated';
    
    $move_x = '';
    if ($a['move_x'] != '') {
        if ($a['align'] == 'left') {
            $move_x = ' left: ' . $a['move_x'] . ';';
        } elseif ($a['align'] == 'right') {
            $move_x = ' right: ' . $a['move_x'] . ';';
        }
    }

    $a_class = '';
    $a_class .= ($a['align'] != '') ? ' align-' . $a['align'] : '';
    $a_class .= ($a['valign'] != '') ? ' valign-' . $a['valign'] : '';

    $onclick = '';
    if ($a['link'] != '') {
        $a_class .= ' cursor-pointer';
        $onclick = ' onclick="window.location=\'' . esc_url($a['link']) . '\'"';
    }

    $src = '';
    $image = '';
    if ($a['img_src'] != '') {
        $image = wp_get_attachment_image_src($a['img_src'], 'full');
        $src = isset($image[0]) ? $image[0] : '';
    }

    if ($src == '') {
        return '';
    }
    
    $a['height'] = !(int) $a['height'] ? (isset($image[2]) ? $image[2] : 200) : (int) $a['height'];
    $ratio = isset($image[2]) ? $a['height'] / $image[2] : false;
    $a['width'] = !(int) $a['width'] ? (isset($image[1]) && $ratio ? ($ratio * $image[1]) : 200) : (int) $a['width'];
    
    $height = 'height: ' . (int) $a['height'] . 'px;';
    $text_align = ($a['text-align'] != '') ? ' ' . $a['text-align'] : '';
    $hover_effect = ($a['hover'] != '') ? ' hover-' . $a['hover'] : '';
    $content_width = ($a['content-width'] != '') ? 'width: ' . $a['content-width'] . ';' : '';
    $effect_text = ($a['effect_text'] != '') ? $a['effect_text'] : 'fadeIn';
    $data_delay = ($a['data_delay'] != '') ? $a['data_delay'] : '';
    $el_class = ($a['el_class'] != '') ? ' ' . $a['el_class'] : '';
    $el_class .= $a['border_outner'] == 'yes' ? ' has-border-outner' : '';
    $el_class .= $a['border_inner'] == 'yes' ? ' has-border-inner' : '';
    $el_class .= $a['banner_responsive'] != 'yes' ? ' nasa-not-responsive' : '';
    
    $content = trim($content) ?
        '<div class="banner-content-warper"><div class="nasa-banner-content banner-content' . $a_class . $text_align . '" style="' . $content_width . $move_x . '">' .
            '<div class="banner-inner nasa-transition wow ' . $effect_text . $class_woo . '" data-animation="' . $effect_text . '">' . 
                nasa_fix_shortcode($content) .
            '</div>' .
        '</div></div>' : '';

    $banner_bg = 'background-image: url(' . esc_url($src) . ');';
    $banner_bg .= 'background-position: center center;';

    return 
    '<div class="banner nasa-banner' . $hover_effect . $el_class . '" data-wow-delay="' . $data_delay . '"' . $onclick . ' style="' . $height . '">' .
        '<div class="banner-image nasa-banner-image ns-banner-bg" style="' . $banner_bg . '" data-height="' . $a['height'] . '" data-width="' . $a['width'] . '"></div>' .
        $content .
    '</div>';
}

// **********************************************************************// 
// ! Register New Element: Banner 
// **********************************************************************//
function nasa_register_banner(){
    $banner_params = array(
        'name' => 'Banner',
        'base' => 'nasa_banner',
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Display Banner", 'nasa-core'),
        'category' => 'Nasa Core',
        'as_parent' => array('except' => 'nasa_banner'),
        'params' => array(
            array(
                'type' => 'attach_image',
                "heading" => __("Banner Image", 'nasa-core'),
                "param_name" => "img_src",
                "admin_label" => true
            ),
            array(
                'type' => 'textfield',
                "heading" => __("Banner Height", 'nasa-core'),
                "param_name" => "height",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "value" => ""
            ),
            array(
                'type' => 'textfield',
                "heading" => __("Banner Width", 'nasa-core'),
                "param_name" => "width",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "value" => ""
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
                "param_name" => "content-width",
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
                "param_name" => "text-align",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "value" => array(
                    __("Left", 'nasa-core') => "text-left",
                    __("Center", 'nasa-core') => "text-center",
                    __("Right", 'nasa-core') => "text-right"
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Responsive", 'nasa-core'),
                "param_name" => "banner_responsive",
                "edit_field_class" => "vc_col-sm-6 vc_column",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                "std" => 'yes',
                "admin_label" => true
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Banner Text", 'nasa-core'),
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