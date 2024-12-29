<?php

/**
 * Shortcode [nasa_image_box ...]
 * 
 * @global type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_image_box($atts = array(), $content = null) {
    $dfAttr = array(
        'link_text' => '',
        'link_target' => '',
        'alt' => '',
        'image' => '',
        'hide_in_m' => '',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    if (isset($hide_in_m) && $hide_in_m == 1) {
        global $nasa_opt;
        
        $el_class .=  $el_class != '' ? ' hide-for-small' : 'hide-for-small';
        
        if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) {
            return '';
        }
    }

    if ($image && $alt) {
        $img = wp_get_attachment_image_src($image, 'full');
        
        if (!$img) {
            return $content;
        }
        
        $open = $close = '';
        $wrap_attrs = array();
        
        $class_wrap = 'nasa-img-box nasa-flex flex-nowrap nasa-transition';
        $class_wrap .= $el_class != '' ? ' ' . trim($el_class) : '';
        $wrap_attrs[] = 'class="' . $class_wrap . '"';
        
        if ($link_text) {
            $wrap_attrs[] = 'href="' . esc_url($link_text) . '"';
            
            if ($link_target) {
               $wrap_attrs[] =  'target="' . esc_attr($link_target) . '"';
            }
            
            $wrap_attrs[] =  'title="' . esc_attr($alt) . '"';
            
            $open = '<a ' . implode(' ', $wrap_attrs) . '>';
            $close = '</a>';
        } else {
            $open = '<div ' . implode(' ', $wrap_attrs) . '>';
            $close = '</div>';
        }
        
        $inner_html = '<img src="' . esc_url($img[0]) . '" alt="' . esc_attr($alt) . '" width="' . absint($img[1]) . '" height="' . absint($img[2]) . '" />';
        $inner_html .= '<p class="img-text fs-17 nasa-bold margin-bottom-0 margin-left-10 rtl-margin-left-0 rtl-margin-right-10">' . $alt . '</p>';
        
        $content = '<div class="item-wrap">' . $open . $inner_html . $close . '</div>';
        
    }
    
    return $content;
}

/**
 * Shortcode [nasa_image_box_grid]...[/nasa_image_box_grid]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_image_box_grid($atts = array(), $content = null) {
    $dfAttr = array(
        'title' => '',
        'title_font_size' => 's',
        'glb_link' => '',
        'glb_link_text' => 'See All',
        'column_number' => '5',
        'column_number_tablet' => '4',
        'column_number_small' => '2',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    $class_wrap = 'nasa-flex flex-wrap flex-items-' . ((int) $column_number) . ' medium-flex-items-' . ((int) $column_number_tablet) . ' small-flex-items-' . ((int) $column_number_small);
    $class_wrap .= $el_class != '' ? ' ' . esc_attr($el_class) : '';
    
    ob_start();
    ?>
    <?php if ($title || $glb_link) :
        $class_title = 'nasa-dft nasa-title margin-bottom-15 nasa-flex jbw flex-wrap align-baseline nasa-' . $title_font_size;
        ?>
        <div class="<?php echo esc_attr($class_title); ?>">
            <h3 class="nasa-heading-title nasa-min-height margin-top-10">
                <?php echo $title ? esc_attr($title) : ''; ?>
            </h3>
            
            <?php if ($glb_link) : ?>
                <a href="<?php echo esc_url($glb_link); ?>" class="nasa-bold nasa-flex fs-15 margin-top-10">
                    <?php echo $glb_link_text ? $glb_link_text . '&nbsp;&nbsp;' : ''; ?><svg class="nasa-only-ltr primary-color" viewBox="0 0 512 512" width="17" height="17"><path fill="currentColor" d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM281 385c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l71-71L136 280c-13.3 0-24-10.7-24-24s10.7-24 24-24l182.1 0-71-71c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L393 239c9.4 9.4 9.4 24.6 0 33.9L281 385z"/></svg>
                    <svg class="nasa-only-rtl primary-color" viewBox="0 0 512 512" width="17" height="17"><path fill="currentColor" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/></svg>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="nasa-image-box-grid">
        <div class="<?php echo $class_wrap; ?>">
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
    <?php
    
    return ob_get_clean();
}

// **********************************************************************// 
// ! Register New Element: Slider
// **********************************************************************//
function nasa_register_image_box(){
    // **********************************************************************// 
    // ! Register New Element: nasa Image Box
    // **********************************************************************//
    $params = array(
        "name" => "Image Box",
        "base" => "nasa_image_box",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Image Box.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __('ALT - Text', 'nasa-core'),
                'param_name' => 'alt',
                'admin_label' => true,
                'value' => '',
            ),
            array(
                'type' => 'textfield',
                'heading' => __('URL', 'nasa-core'),
                'param_name' => 'link_text',
                'admin_label' => true,
                'value' => '',
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Target', 'nasa-core'),
                "param_name" => 'link_target',
                "value" => array(
                    __('Default', 'nasa-core') => '',
                    __('Blank', 'nasa-core') => '_blank'
                ),
                'std' => ''
            ),
            array(
                'type' => 'attach_image',
                'heading' => __('Image', 'nasa-core'),
                'param_name' => 'image',
                'value' => '',
                'admin_label' => true,
                'description' => __('Select images from media library.', 'nasa-core')
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
                "heading" => __("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    );
    
    vc_map($params);
    
    $params = array(
        "name" => "Images Box - Grid",
        "base" => "nasa_image_box_grid",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Grid Image Box", 'nasa-core'),
        "content_element" => true,
        "as_parent" => array('only' => 'nasa_image_box'),
        // "as_parent" => array('except' => 'nasa_image_box'),
        // "is_container" => true,
        'category' => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title', 'nasa-core'),
                'param_name' => 'title',
                'admin_label' => true,
                'value' => '',
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Title Font Size', 'nasa-core'),
                "param_name" => 'title_font_size',
                "value" => array(
                    __('X-Large', 'nasa-core') => 'xl',
                    __('Large', 'nasa-core') => 'l',
                    __('Medium', 'nasa-core') => 'm',
                    __('Small', 'nasa-core') => 's',
                    __('Tiny', 'nasa-core') => 't'
                ),
                "std" => 's'
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Global URL', 'nasa-core'),
                'param_name' => 'glb_link',
                'admin_label' => true,
                'value' => '',
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Global URL Text', 'nasa-core'),
                'param_name' => 'glb_link_text',
                'value' => 'See All',
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Columns Number', 'nasa-core'),
                "param_name" => "column_number",
                "value" => array(8, 7, 6, 5, 4, 3, 2, 1),
                "std" => 5,
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Columns Number Small', 'nasa-core'),
                "param_name" => "column_number_small",
                "value" => array(3, 2, 1),
                "std" => 2,
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Columns Number Tablet', 'nasa-core'),
                "param_name" => "column_number_tablet",
                "value" => array(5, 4, 3, 2, 1),
                "std" => 4,
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

    vc_map($params);
}
