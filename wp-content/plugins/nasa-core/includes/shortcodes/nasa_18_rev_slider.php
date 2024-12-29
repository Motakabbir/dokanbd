<?php

/**
 * Shortcode [nasa_rev_slider ...]
 * 
 * @param type $atts
 * @param type $content
 * @return string
 */
function nasa_sc_rev_slider($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'alias' => '',
        'alias_m' => '',
        'el_class' => ''
    ), $atts));
    
    if (!class_exists('RevSlider') || (!$alias && !$alias_m)) {
        return '';
    }
    
    global $nasa_opt;
    
    $inMobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
    
    $rev = $alias_m && $inMobile ? $alias_m : $alias;
    
    if (!$rev) {
        return '';
    }
    
    $content = do_shortcode('[rev_slider alias="' . esc_attr($rev) . '"][/rev_slider]');
    
    if (isset($nasa_opt['transition_load']) && $nasa_opt['transition_load'] == 'crazy') {
        $content = '<div class="nasa-crazy-box">' . $content . '</div>';
    }
    
    return (isset($el_class) && trim($el_class) != '') ?
        '<div class="' . esc_attr($el_class). '">' .$content . '</div>' : $content;
}

/**
 * Register Params
 */
function nasa_register_rev_slider(){
    $params = array(
        "name" => "Nasa - RevSlider",
        "base" => "nasa_rev_slider",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Revolution Slider.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __('Slider', 'nasa-core'),
                "param_name" => 'alias',
                "value" => nasa_get_revsliders_arrays(),
                "std" => '',
                "admin_label" => true
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Slider - Mobile layout', 'nasa-core'),
                "param_name" => 'alias_m',
                "value" => nasa_get_revsliders_arrays(),
                "std" => '',
                "admin_label" => true
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    );
    
    vc_map($params);
}
