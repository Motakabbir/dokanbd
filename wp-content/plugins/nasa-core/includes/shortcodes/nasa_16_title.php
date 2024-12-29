<?php
/**
 * Shortcode [nasa_title ...]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_title($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'title_text' => '',
        'title_color' => '',
        'title_bg' => '',
        'title_type' => 'h3',
        'title_hr' => 'none',
        'title_desc' => '',
        'title_align' => '',
        'first_special' => '0',
        'font_size' => '',
        'el_class' => ''
    ), $atts));
    
    if ($title_text == '') {
        return '';
    }
    
    $hwrap = in_array($title_type, array('h1', 'h2', 'h3', 'h4', 'h5')) ? $title_type : 'h3';
    $wrap = $title_hr != 'vertical' ? false : true;
    $style_bg = array();
    $style_output = $color_desc = $style_hr = '';
    
    if ($title_hr == 'none' && $first_special == '0' && $title_bg == '' && $title_color == '') {
        $title = '<' . $hwrap . ' class="nasa-heading-title">' . $title_text . '</' . $hwrap . '>';
        $style_output .= 'nasa-dft ';
    }
    
    else {
        if ($title_bg != '') {
            $style_bg[] = 'background: ' . $title_bg;
        }

        if ($title_color != '') {
            $style_bg[] = 'color: ' . $title_color;
            $color_desc = ' style="' . 'color: ' . $title_color . ';"';
            $style_hr = ' style="' . 'border-color: ' . $title_color . ';"';
        }
        
        if ($title_hr == 'baby') {
            $hr_src = apply_filters('nasa_title_baby_hr_src', get_template_directory_uri() . '/assets/images/hr-type-baby.png');
            $style_hr = ' style="' . 'background: url(' . esc_url($hr_src) . ')  0 0 no-repeat;"';
        }
        
        $style_bg = !empty($style_bg) ? ' style="' . implode('; ', $style_bg) . ';"' : '';

        $title = $title_text ? '<span' . $style_bg . '>' . $title_text . '</span>' : '';
        $title .= $title && $title_hr !== 'none' ? '<span class="nasa-title-hr"' . $style_hr . '></span>' : '';
        if ($first_special) {
            $texts = $title_text ? explode(' ', $title_text) : array('');
            $first = $texts[0];
            unset($texts[0]);
            if ($first) {
                $title = '<span' . $style_bg . '><span class="nasa-first-word">' . $first . '</span>' . (count($texts) ? ' ' . implode(' ', $texts) : '') . '</span>';
            }
        }

        $title = '<' . $hwrap . ' class="nasa-heading-title"><span class="nasa-title-wrap">' . $title . '</span></' . $hwrap . '>';
    }
    
    /**
     * Title Description
     */
    $title_desc = trim($title_desc) != '' ? '<p class="nasa-title-desc"' . $color_desc . '>' . $title_desc . '</p>' : '';
    
    /**
     * Output class
     */
    $style_output .= 'nasa-title clearfix';
    $style_output .= isset($font_size) && $font_size && $font_size ? ' nasa-' . $font_size : '';
    $style_output .= $title_hr ? ' hr-type-' . $title_hr : ''; 
    $style_output .= $title_align ? ' ' . $title_align : ''; 
    $style_output .= $el_class ? ' ' . $el_class : '';
    
    return 
    '<div class="' . $style_output . '">' .
        ($wrap ? '<div class="nasa-wrap">' : '') .
            $title .
            $title_desc .
        ($wrap ? '</div>' : '').
    '</div>';
}

/**
 * Register Params
 */
function nasa_register_title(){
    // first_special
    $nasa_title_params = array(
        "name" => "Title",
        "base" => "nasa_title",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create title of section.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title text', 'nasa-core'),
                'param_name' => 'title_text',
                'admin_label' => true,
                'value' => ''
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Color title", 'nasa-core'),
                "param_name" => "title_color",
                "value" => ""
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Title type heading', 'nasa-core'),
                "param_name" => 'title_type',
                "value" => array(
                    __('H1', 'nasa-core') => 'h1',
                    __('H2', 'nasa-core') => 'h2',
                    __('H3', 'nasa-core') => 'h3',
                    __('H4', 'nasa-core') => 'h4',
                    __('H5', 'nasa-core') => 'h5'
                ),
                'std' => 'h3',
                'admin_label' => true
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Background title", 'nasa-core'),
                "param_name" => "title_bg",
                "value" => ""
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Title HR', 'nasa-core'),
                "param_name" => 'title_hr',
                "value" => array(
                    __('None', 'nasa-core') => 'none',
                    __('Simple', 'nasa-core') => 'simple',
                    __('Full', 'nasa-core') => 'full',
                    __('Vertical', 'nasa-core') => 'vertical',
                    __('Baby', 'nasa-core') => 'baby'
                ),
                'std' => 'none',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title Description', 'nasa-core'),
                'param_name' => 'title_desc',
                'admin_label' => true,
                'value' => '',
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Title Alignment', 'nasa-core'),
                "param_name" => 'title_align',
                "value" => array(
                    __('Left', 'nasa-core') => '',
                    __('Center', 'nasa-core') => 'text-center',
                    __('Right', 'nasa-core') => 'text-right'
                ),
                "dependency" => array(
                    "element" => "title_hr",
                    "value" => array(
                        'simple', 'full', 'baby', 'none'
                    )
                ),
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Title Style', 'nasa-core'),
                "param_name" => 'first_special',
                "value" => array(
                    __('None Special First word', 'nasa-core') => '0',
                    __('Special First word', 'nasa-core') => '1'
                ),
                "std" => '0'
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Font Size', 'nasa-core'),
                "param_name" => 'font_size',
                "value" => array(
                    __('Not Set', 'nasa-core') => '',
                    __('X-Large', 'nasa-core') => 'xl',
                    __('Large', 'nasa-core') => 'l',
                    __('Medium', 'nasa-core') => 'm',
                    __('Small', 'nasa-core') => 's',
                    __('Tiny', 'nasa-core') => 't'
                ),
                "std" => ''
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    );

    vc_map($nasa_title_params);
}
