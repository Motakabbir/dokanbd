<?php
/**
 * Shortcode [nasa_slider]...[/nasa_slider]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_carousel($atts = array(), $content = null) {
    $dfAttr = array(
        'title' => '',
        'align' => 'left',
        'column_number' => '1',
        'column_number_tablet' => '1',
        'column_number_small' => '1',
        'gap_items' => '',
        'padding_item' => '',
        'padding_item_small' => '',
        'padding_item_medium' => '',
        'navigation' => 'true',
        'bullets' => 'true',
        'bullets_pos' => '',
        'bullets_align' => 'center',
        'paginationspeed' => '600',
        'autoplay' => 'false',
        'loop_slide' => 'false',
        'force' => 'false',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    $text_align = $align ? 'text-' . $align : 'text-left';
    
    $class_wrap = 'nasa-sc-carousel-main';
    $class_wrap .= $bullets_pos == 'inside' ? ' nasa-bullets-inside' : '';
    $class_wrap .= $bullets_pos == 'none' ? ' nasa-bullets-inherit' : '';
    $class_wrap .= $bullets_align ? ' nasa-bullets-' . $bullets_align : '';
    $class_wrap .= $force == 'true' ? ' right-now' : '';
    $class_wrap .= $el_class != '' ? ' ' . $el_class : '';
    
    $padding_array = array();
    if ($padding_item) {
        $padding_array[] = 'data-padding="' . esc_attr($padding_item) . '"';
    }
    
    if ($padding_item_small) {
        $padding_array[] = 'data-padding-small="' . esc_attr($padding_item_small) . '"';
    }
    
    if ($padding_item_medium) {
        $padding_array[] = 'data-padding-medium="' . esc_attr($padding_item_medium) . '"';
    }

    $padding_str = !empty($padding_array) ? ' ' . implode(' ', $padding_array) : '';
    
    $class_slider = 'nasa-slick-slider nasa-not-elementor-style';
    $class_slider .= $navigation === 'true' ? ' nasa-slick-nav' : '';
    $class_slider .= isset($gap_items) && $gap_items === 'yes' ? ' ns-items-gap' : '';
    
    ob_start();
    ?>
    <div class="<?php echo esc_attr($class_wrap); ?>">
        <?php if ($title): ?>
            <h3 class="section-title <?php echo esc_attr($text_align); ?>">
                <?php echo esc_attr($title); ?>
            </h3>
        <?php endif; ?>
        <div 
            class="<?php echo $class_slider; ?>"
            data-autoplay="<?php echo esc_attr($autoplay); ?>"
            data-loop="<?php echo esc_attr($loop_slide); ?>"
            data-speed="<?php echo esc_attr($paginationspeed); ?>"
            data-dot="<?php echo esc_attr($bullets); ?>"
            data-columns="<?php echo esc_attr($column_number); ?>"
            data-columns-small="<?php echo esc_attr($column_number_small); ?>"
            data-columns-tablet="<?php echo esc_attr($column_number_tablet); ?>"
            data-switch-tablet="<?php echo nasa_switch_tablet(); ?>"
            data-switch-desktop="<?php echo nasa_switch_desktop(); ?>"
            <?php echo $padding_str; ?>>
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    
    return ob_get_clean();
}

// **********************************************************************// 
// ! Register New Element: Slider
// **********************************************************************//
function nasa_register_slider(){
    $slider_params = array(
        "name" => __("Slider", 'nasa-core'),
        "base" => "nasa_slider",
        "as_parent" => array('except' => 'nasa_slider'),
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Display slider (images, products, ...)", 'nasa-core'),
        "content_element" => true,
        'category' => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", 'nasa-core'),
                "param_name" => "title"
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Title Align", 'nasa-core'),
                "param_name" => "align",
                "value" => array(
                    __('Left', 'nasa-core') => 'left',
                    __('Center', 'nasa-core') => 'center',
                    __('Right', 'nasa-core') => 'right',
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Bullets', 'nasa-core'),
                "param_name" => "bullets",
                "value" => array(
                    __('Yes', 'nasa-core') => 'true',
                    __('No', 'nasa-core') => 'false'
                )
            ),
            
             array(
                "type" => "dropdown",
                "heading" => __('Bullets Postition', 'nasa-core'),
                "param_name" => "bullets_pos",
                "value" => array(
                    __('Outside', 'nasa-core') => '',
                    __('Inside', 'nasa-core') => 'inside',
                    __('Not Set', 'nasa-core') => 'none'
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Bullets Align', 'nasa-core'),
                "param_name" => "bullets_align",
                "std" => 'center',
                "value" => array(
                    __('Center', 'nasa-core') => 'center',
                    __('Left', 'nasa-core') => 'left',
                    __('Right', 'nasa-core') => 'right'
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Arrows', 'nasa-core'),
                "param_name" => "navigation",
                "value" => array(
                    __('Yes', 'nasa-core') => 'true',
                    __('No', 'nasa-core') => 'false'
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Columns Number', 'nasa-core'),
                "param_name" => "column_number",
                "value" => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12),
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Columns Number Small', 'nasa-core'),
                "param_name" => "column_number_small",
                "value" => array(1, 2, 3, 4, 5, 6),
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Columns Number Tablet', 'nasa-core'),
                "param_name" => "column_number_tablet",
                "value" => array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10),
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Gap Items', 'nasa-core'),
                "param_name" => "gap_items",
                "value" => array(
                    __('No', 'nasa-core') => 'no',
                    __('Yes', 'nasa-core') => 'yes'
                )
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Item Padding (px || %)", 'nasa-core'),
                "param_name" => "padding_item",
                "std" => '',
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Item Padding in Mobile (px || %)", 'nasa-core'),
                "param_name" => "padding_item_small",
                "std" => '',
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Item Padding in Tablet (px || %)", 'nasa-core'),
                "param_name" => "padding_item_medium",
                "std" => '',
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Force Initialize', 'nasa-core'),
                "param_name" => "force",
                "value" => array(
                    __('No', 'nasa-core') => 'false',
                    __('Yes', 'nasa-core') => 'true'
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Auto Play', 'nasa-core'),
                "param_name" => "autoplay",
                "value" => array(
                    __('No', 'nasa-core') => 'false',
                    __('Yes', 'nasa-core') => 'true'
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Slide Infinite', 'nasa-core'),
                "param_name" => "loop_slide",
                "value" => array(
                    __('No', 'nasa-core') => 'false',
                    __('Yes', 'nasa-core') => 'true'
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Speed Slider', 'nasa-core'),
                "param_name" => "paginationspeed",
                "std" => '600',
                "value" => array(
                    __('0.3s', 'nasa-core') => '300',
                    __('0.4s', 'nasa-core') => '400',
                    __('0.5s', 'nasa-core') => '500',
                    __('0.6s', 'nasa-core') => '600',
                    __('0.7s', 'nasa-core') => '700',
                    __('0.8s', 'nasa-core') => '800',
                    __('0.9s', 'nasa-core') => '900',
                    __('1.0s', 'nasa-core') => '1000',
                    __('1.2s', 'nasa-core') => '1200',
                    __('1.4s', 'nasa-core') => '1400',
                    __('1.6s', 'nasa-core') => '1600'
                )
            ),

            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        ),
        "js_view" => 'VcColumnView'
    );

    vc_map($slider_params);
}
