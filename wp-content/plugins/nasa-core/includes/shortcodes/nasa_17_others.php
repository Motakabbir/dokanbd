<?php

/**
 * Shortcode [nasa_separator_link ...]
 * 
 * @param type $atts
 * @param type $content
 * @return string
 */
function nasa_sc_separator_link($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'title_text' => '',
        'link_text' => '#',
        'title_color' => '',
        'title_bg' => '',
        'title_type' => 'span',
        'title_hr' => 'simple',
        'title_desc' => '',
        'title_align' => '',
        'link_target' => '',
        'el_class' => ''
    ), $atts));
    
    if ($title_text == '' || $link_text == '') {
        return '';
    }
    
    $style_bg = array();
    $color_desc = $color_hr = '';
    if ($title_bg != '') {
        $style_bg[] = 'background: ' . $title_bg;
    }
    
    if ($title_color != '') {
        $style_bg[] = 'color: ' . $title_color;
        $color_desc = ' style="' . 'color: ' . $title_color . ';"';
        $color_hr = ' style="' . 'border-color: ' . $title_color . ';"';
    }
    
    $style_bg = !empty($style_bg) ? ' style="' . implode('; ', $style_bg) . ';"' : '';
    
    $hwrap = in_array($title_type, array('h1', 'h2', 'h3', 'h4', 'h5', 'span')) ? $title_type : 'span';
    $blank = $link_target === '_blank' ? ' target="' . $link_target . '"' : '';
    $title = $title_text ? '<a href="' . esc_url($link_text) . '" title="' . esc_attr($title_text) . '"' . $blank . $style_bg . '>' . $title_text . '</a>' : '';
    
    $title = '<' . $hwrap . ' class="nasa-heading-title"><span class="nasa-text-link-wrap nasa-title-wrap">' . $title . '</span><span class="nasa-title-hr"' . $color_hr . '></span></' . $hwrap . '>';
    
    $title_desc = trim($title_desc) != '' ? '<div class="nasa-title-desc"' . $color_desc . '>' . $title_desc . '</div>' : '';
    
    $style_output = 'nasa-title nasa-text-link clearfix';
    $style_output .= ($title_hr != '') ? ' hr-link hr-type-' . $title_hr : ''; 
    $style_output .= ($title_align != '') ? ' ' . $title_align : ''; 
    $style_output .= $el_class != '' ? ' ' . $el_class : '';
    
    return 
        '<div class="' . $style_output . '">' .
            $title .
            $title_desc .
        '</div>';
}

/**
 * Shortcode [nasa_countdown ...]
 * 
 * @param type $atts
 * @param string $content
 * @return string
 */
function nasa_countdown_time($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'date' => '',
        'style' => 'digital',
        'align' => 'center',
        'size' => 'small',
        'el_class' => ''
    ), $atts));
    
    if ($date == '') {
        return '';
    }
    
    $time_sale = strtotime($date);
    $time_sale = $time_sale < current_time('timestamp') ? false : $time_sale;
    if ($time_sale) :
        $wrap_class = array();
        
        if ($style == 'digital') {
            $wrap_class[] = 'nasa-custom-countdown';
            $wrap_class[] = 'text-' . trim($align);
            $wrap_class[] = 'nasa-' . trim($size);
        } else {
            $wrap_class[] = 'nasa-countdown-' . $style;
        }
        
        if ($el_class != '') :
            $wrap_class[] = $el_class;
        endif;
        
        $wrap_class_str = !empty($wrap_class) ? ' class="' . esc_attr(implode(' ', $wrap_class)) . '"' : '';
        
        $content =
        '<div' . $wrap_class_str . '>' .
            nasa_time_sale($time_sale, false, false) .
        '</div>';
    endif;
    
    return $content;
}

/**
 * Shortcode [nasa_service_box ...]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_service_box($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'service_icon' => '',
        'service_html' => '',
        'service_title' => '',
        'service_desc' => '',
        'service_link' => '',
        'service_blank' => '',
        'service_style' => 'style-1',
        'service_hover' => '',
        'vc_type' => '1',
        'el_class' => ''
    ), $atts));
    
    $shc = trim($service_html) ? $service_html : '';
    
    if ($shc) {
        $shc = $vc_type === '1' ? rawurldecode(base64_decode(wp_strip_all_tags($shc))) : html_entity_decode($shc);
    }
    
    $service_block_class = 'service-block';
    $service_block_class .= $service_style ? ' ' . $service_style : '';
    $service_block_class .= $el_class ? ' ' . $el_class : '';
    
    $service_icon_class = 'service-icon';
    $service_icon_class .= $service_hover ? ' ' . $service_hover : '';
    $service_icon_class .= $service_icon ? ' ' . $service_icon : '';
    
    $enable_link = (isset($service_link) && trim($service_link) != '') ? true : false;
    
    ob_start();
    
    if ($enable_link) {
        $attributes = $service_blank == '_blank' ? ' target="_blank"' : '';
        $attributes .= (isset($service_title) && $service_title != '') ? ' title="' . esc_attr($service_title) . '"' : '';
        echo '<a href="' . esc_url($service_link) . '"' . $attributes . '>';
    }
    ?>
    
    <div class="<?php echo esc_attr($service_block_class); ?>">
        <div class="box">
            <div class="<?php echo esc_attr($service_icon_class); ?>">
                <?php echo $shc ? $shc : ''; ?>
            </div>
            
            <div class="service-text">
                <?php if (isset($service_title) && $service_title != '') { ?>
                    <div class="service-title">
                        <?php echo $service_title; ?>
                    </div>
                <?php } ?>
                
                <?php if (isset($service_desc) && $service_desc != '') { ?>
                    <div class="service-desc">
                        <?php echo $service_desc; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    
    <?php
    echo $enable_link ? '</a>' : '';
    
    return ob_get_clean();
}

/**
 * Shortcode [nasa_icon_box ...]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_icon_box($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'box_img' => '',
        'box_title' => '',
        'box_desc' => '',
        'box_link' => '',
        'box_blank' => '',
        'box_style' => 'hoz',
        'el_class' => ''
    ), $atts));
    
    ob_start();
    
    $img = wp_get_attachment_image_src($box_img, 'full');
    
    $img_html = $img ? '<div class="box-img nasa-flex jc"><img src="' . esc_url($img[0]) . '" alt="' . esc_attr((isset($box_title) && $box_title != '') ? $box_title : '') . '" width="' . absint($img[1]) . '" height="' . absint($img[2]) . '" /></div>' : '';
    
    $enable_link = (isset($box_link) && trim($box_link) != '') ? true : false;
    
    if ($enable_link) {
        $attributes = $box_blank == '_blank' ? ' target="_blank"' : '';
        $attributes .= (isset($box_title) && $box_title != '') ? ' title="' . esc_attr($box_title) . '"' : '';
        echo '<a href="' . esc_url($box_link) . '"' . $attributes . '>';
    }
    
    $class_wrap = 'box nasa-flex';
    $class_wrap .= $box_style == 'ver' ? ' flex-column jc text-center' : ' flex-row';
    $class_wrap .= $el_class ? ' ' . $el_class : '';
    ?>
    <div class="nasa-icon-box">
        <div class="<?php echo esc_attr($class_wrap); ?>">
            <?php echo $img_html; ?>
            
            <div class="box-text">
                <?php if (isset($box_title) && $box_title != '') { ?>
                    <span class="box-title fs-22 nasa-bold margin-bottom-10 nasa-block">
                        <?php echo $box_title; ?>
                    </span>
                <?php } ?>
                <?php if (isset($box_desc) && $box_desc != '') { ?>
                    <p class="box-desc">
                        <?php echo $box_desc; ?>
                    </p>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php
    echo $enable_link ? '</a>' : '';
    
    $content = ob_get_clean();
    
    return $content;
}

/**
 * Shortcode [nasa_client ...]
 * 
 * Testimonials
 * 
 * @param type $atts
 * @param type $content
 * @return string
 */
function nasa_sc_client($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        "img_src" => '',
        "name" => '',
        'style' => 'full',
        "company" => '',
        "text_color" => '',
        "content" => $content,
        'text_align' => 'center',
        'el_class' => ''
    ), $atts));

    $content = (trim($content) != '') ? nasa_fix_shortcode($content) : '';
    $el_class = (trim($el_class) != '') ? ' ' . esc_attr($el_class) : '';
    $style_mode = !isset($style) || $style !== 'simple' ? 'full' : 'simple';

    if ($style_mode !== 'simple') {
        switch ($text_align) {
            case 'right':
            case 'left':
            case 'justify':
                $el_class .= ' text-' . $text_align;
                break;

            case 'center':
            default:
                $el_class .= ' text-center';
                break;
        }
    }

    $image = '';
    if ($img_src != '') {
        $imageArr = wp_get_attachment_image_src($img_src, 'full');
        if (isset($imageArr[0])) {
            $image = '<img src="' . esc_url($imageArr[0]) . '" alt="' . esc_attr($name) . '" width="' . $imageArr[1] . '" height="' . $imageArr[2] . '" />';
        }
    }
    
    /**
     * Full style
     * 
     * Show avata - name - content - Company
     */
    if ($style_mode == 'full') {
        $style_text_color = $text_color ? ' style="color: ' . esc_attr($text_color) . '"' : '';
        
        $client = 
        '<div class="client' . $el_class . '">' .
            '<div class="client-inner"' . $style_text_color . '>' .
                '<div class="client-info wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1s">' .
                    '<div class="client-content"' . $style_text_color . '>' . $content . '</div>' .
                    '<div class="client-img-info">' .
                        '<div class="client-img">' . $image . '</div>' .
                        '<div class="client-name-post">' .
                            '<h4 class="client-name">' . $name . '</h4>' .
                            '<span class="client-pos"' . $style_text_color . '>' . $company . '</span>' .
                        '</div>' .
                    '</div>' .
                '</div>' .
            '</div>' .
        '</div>';
    }
    
    /**
     * Simple style
     * 
     * Show avata - name - content
     */
    if ($style_mode == 'simple') {
        $client = 
        '<div class="client client-simple wow fadeInUp' . $el_class . '" data-wow-delay="100ms" data-wow-duration="1s">' .
            '<div class="client-img-info">' .
                '<div class="client-img">' . $image . '</div>' .
                '<p class="client-name">' . $name . '</p>' .
            '</div>' .
            '<div class="client-content padding-left-15 rtl-padding-left-0 rtl-padding-right-15 rtl-text-right">' . $content . '</div>' .
        '</div>';
    }

    return $client;
}

/**
 * Shortcode [nasa_contact_us ...]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_contact_us($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'contact_address' => '',
        'contact_phone' => '',
        'service_desc' => '',
        'contact_email' => '',
        'contact_website' => '',
        'el_class' => ''
    ), $atts));
    
    $content = '';
    
    if (isset($contact_address) && $contact_address) {
        $content .=
        '<li class="media">' .
            '<span class="contact-text">' . $contact_address . '</span>' .
        '</li>';
    }
    
    if (isset($contact_phone) && $contact_phone) {
        $content .=
        '<li class="media">' .
            '<span class="contact-text">' . $contact_phone . '</span>' .
        '</li>';
    }
    
    if (isset($contact_email) && $contact_email) {
        $content .=
        '<li class="media">' .
            '<a class="contact-text" href="mailto:' . esc_attr($contact_email) . '" title="' . esc_attr__('Email', 'nasa-core') . '">' . $contact_email . '</a>' .
        '</li>';
    }
    
    if (isset($contact_website) && $contact_website) {
        $content .=
        '<li class="media">' .
            '<a class="contact-text" href="' . esc_url($contact_website) . '" title="' . esc_attr($contact_website) . '">' . $contact_website . '</a>' .
        '</li>';
    }
    
    if ($content) {
        $class = 'contact-information';
        $class .= $el_class ? ' ' . $el_class : '';
        $content = '<ul class="' . esc_attr($class) . '">' . $content . '</ul>';
    }
    
    return $content;
}

/**
 * Shortcode [nasa_opening_time ...]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_opening_time($atts = array(), $content = null) {
    extract(shortcode_atts(array(
        'weekdays_start' => '08:00',
        'weekdays_end' => '20:00',
        'sat_start' => '09:00',
        'sat_end' => '21:00',
        'sun_start' => '13:00',
        'sun_end' => '22:00',
        'el_class' => ''
    ), $atts));

    $class = 'nasa-opening-time';
    $class .= $el_class ? ' ' . $el_class : '';
    
    $weekdays = array();
    
    if ($weekdays_start) {
        $weekdays[] = $weekdays_start;
    }
    
    if ($weekdays_end) {
        $weekdays[] = $weekdays_end;
    }
    
    $sat = array();
    
    if ($sat_start) {
        $sat[] = $sat_start;
    }
    
    if ($sat_end) {
        $sat[] = $sat_end;
    }
    
    $sun = array();
    
    if ($sun_start) {
        $sun[] = $sun_start;
    }
    
    if ($sun_end) {
        $sun[] = $sun_end;
    }
    
    $content = '<ul class="' . $class . '">';
    
    if (!empty($weekdays)) {
        $content .= '<li><span class="nasa-day-open">' . esc_html__('Monday - Friday', 'nasa-core') . '</span><span class="nasa-time-open">' . implode(' - ', $weekdays) . '</span></li>';
    }

    if (!empty($sat)) {
        $content .= '<li><span class="nasa-day-open">' . esc_html__('Saturday', 'nasa-core') . '</span><span class="nasa-time-open">' . implode(' - ', $sat) . '</span></li>';
    }

    if (!empty($sun)) {
        $content .= '<li><span class="nasa-day-open">' . esc_html__('Sunday', 'nasa-core') . '</span><span class="nasa-time-open">' . implode(' - ', $sun) . '</span></li>';
    }
    
    $content .= '</ul>';

    return $content;
}

/**
 * Shortcode [nasa_image ...]
 * 
 * @global type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_image($atts = array(), $content = null) {
    $dfAttr = array(
        'link_text' => '',
        'link_target' => '',
        'alt' => '',
        'caption' => '',
        'image' => '',
        'align' => '',
        'hide_in_m' => '',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    if (isset($hide_in_m) && $hide_in_m == 1) {
        global $nasa_opt;
        
        if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) {
            return '';
        }
    }

    if ($image) {
        $el_class = isset($el_class) ? trim($el_class) : '';
        $img = wp_get_attachment_image_src($image, 'full');
        
        if (!$img) {
            return $content;
        }
        
        $alt = empty($alt) ? get_post_meta($img, '_wp_attachment_image_alt', true) : $alt;
        $open = $close = '';
        
        if ($link_text) {
            $blank = $link_target ? ' target="' . $link_target . '"' : '';
            $title = $alt ? ' title="' . esc_attr($alt) . '"' : '';
            
            $class_a = 'nasa-link-image';
            $open = '<a class="' . esc_attr($class_a) . '" href="' . esc_url($link_text) . '"' . $blank . $title . '>';
            $close = '</a>';
        }
        
        $class = 'nasa-image';
        $class .= isset($hide_in_m) && $hide_in_m ? ' hide-for-mobile' : '';
        $class .= $el_class ? ' ' . $el_class : '';
        $img_html = '<img class="' . esc_attr($class) . '" src="' . esc_url($img[0]) . '" alt="' . esc_attr($alt) . '" width="' . absint($img[1]) . '" height="' . absint($img[2]) . '" />';
        
        if ($alt && isset($caption) && $caption) {
            $img_html .= '<p class="margin-top-5 ns-img-cap">' . esc_html($alt) . '</p>';
        }
        
        $content = $open . $img_html . $close;
        
        if ($align != '') {
            $wrap_open = '<div class="nasa-image-wrap text-' . esc_attr($align) . '">';
            $wrap_close = '</div>';
            
            $content = $wrap_open . $content . $wrap_close;
        }
    }
    
    return $content;
}

/**
 * Boot Rate
 * 
 * Shortcode [nasa_boot_rate ...]
 * <div class="star-rating"><span></span></div>
 */
function nasa_sc_boot_rate($atts = array(), $content = null) {
    $dfAttr = array(
        'text' => '',
        'name' => '',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts, 'nasa_boot_rate'));
    
    $content = '';
    
    if (trim($text) == '' && trim($name) == '') {
        return $content;
    }
    
    /**
     * Say
     */
    if ($text) {
        $content .= '<div class="nasa-text">' . html_entity_decode($text) . '</div>';
    }
    
    /**
     * Rating
     */
    $content .= '<div class="star-rating"><span></span></div>';
    
    /**
     * Author
     */
    if ($name) {
        $content .= '<p class="nasa-customer">' . $name . '</p>';
    }
    
    $class = 'nasa-boot-rate';
    $class .= $el_class ? ' ' . $el_class : '';
    
    return '<div class="' . $class . '">' . $content . '</div>';
}

/**
 * Contact Form 7
 * 
 * Shortcode [nasa_cf7 ...]
 */
function nasa_sc_cf7($atts = array(), $content = null) {
    if (!shortcode_exists('contact-form-7')) {
        return '';
    }
    
    $dfAttr = array(
        'id' => '',
        'title' => '',
        'el_class' => '' // html_class
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    $content = '';
    
    if (!(int) $id && trim($title) === '') {
        return $content;
    }
    
    $shortcode = '[contact-form-7 id="' . ((int) $id) . '" title="' . esc_attr($title) . '" html_class="' . esc_attr($el_class) . '"]';
    
    return do_shortcode($shortcode);
}

/**
 * Register Params
 */
function nasa_register_others(){
    // **********************************************************************// 
    // ! Register New Element: Service Box
    // **********************************************************************//
    $params = array(
        "name" => "Service Box",
        "base" => "nasa_service_box",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create sevice box.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Service Title", 'nasa-core'),
                "param_name" => "service_title",
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => __("Service Description", 'nasa-core'),
                "param_name" => "service_desc",
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => __("Icon", 'nasa-core'),
                "param_name" => "service_icon",
                "description" => __("Enter icon class name. Support FontAwesome, Font Pe 7 Stroke (https://themes-pixeden.com/font-demos/7-stroke/), Font Nasa (https://elessi.nasatheme.com/wp-content/themes/elessi-theme/assets/font-nasa/icons-reference.html)", 'nasa-core')
            ),
            array(
                "type" => "textarea_raw_html",
                "holder" => "div",
                "heading" => __("Icon Content", 'nasa-core'),
                "param_name" => "service_html",
                "value" => "",
                // "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => __("Service link", 'nasa-core'),
                "param_name" => "service_link",
                "admin_label" => true,
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Link Target", 'nasa-core'),
                "param_name" => "service_blank",
                "description" => __("Target", 'nasa-core'),
                "value" => array(
                    __('Default', 'nasa-core') => '',
                    __('Blank - New Window', 'nasa-core') => '_blank'
                )
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Service Style", 'nasa-core'),
                "param_name" => "service_style",
                "value" => array(
                    __('Style 1', 'nasa-core') => 'style-1',
                    __('Style 2', 'nasa-core') => 'style-2',
                    __('Style 3', 'nasa-core') => 'style-3',
                    __('Style 4', 'nasa-core') => 'style-4'
                ),
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Service Hover Effect", 'nasa-core'),
                "param_name" => "service_hover",
                "value" => array(
                    __('None', 'nasa-core') => '',
                    __('Fly', 'nasa-core') => 'fly_effect',
                    __('Buzz', 'nasa-core') => 'buzz_effect',
                    __('Rotate', 'nasa-core') => 'rotate_effect',
                )
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
    
    // **********************************************************************// 
    // ! Register New Element: Icon Box
    // **********************************************************************//
    $params = array(
        "name" => "Icon Box",
        "base" => "nasa_icon_box",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create icon box.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'attach_image',
                'heading' => __('Box Image', 'nasa-core'),
                'param_name' => 'box_img',
                'value' => '',
                'admin_label' => true,
                'description' => __('Select images from media library.', 'nasa-core')
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Box Title", 'nasa-core'),
                "param_name" => "box_title",
                "admin_label" => true,
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Box Description", 'nasa-core'),
                "param_name" => "box_desc",
                "admin_label" => true,
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Box link", 'nasa-core'),
                "param_name" => "box_link",
                "admin_label" => true,
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Link Target", 'nasa-core'),
                "param_name" => "box_blank",
                "description" => __("Target", 'nasa-core'),
                "value" => array(
                    __('Default', 'nasa-core') => '',
                    __('Blank - New Window', 'nasa-core') => '_blank'
                )
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Box Style", 'nasa-core'),
                "param_name" => "box_style",
                "value" => array(
                    __('Horizontal', 'nasa-core') => 'hoz',
                    __('Vertical', 'nasa-core') => 'ver'
                ),
                "admin_label" => true,
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

    // **********************************************************************// 
    // ! Register New Element: Testimonials
    // **********************************************************************//
    $params = array(
        "name" => "Testimonials",
        "base" => "nasa_client",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Ex: Customers say about us.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "attach_image",
                "heading" => __("Avatar", 'nasa-core'),
                "param_name" => "img_src",
            ),
            array(
                "type" => "textfield",
                "heading" => __("Name", 'nasa-core'),
                "param_name" => "name",
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Style', 'nasa-core'),
                "param_name" => 'style',
                "value" => array(
                    __('Full', 'nasa-core') => "full",
                    __('Simple', 'nasa-core') => "simple"
                ),
                'std' => 'full'
            ),
            array(
                "type" => "textfield",
                "heading" => __("Job", 'nasa-core'),
                "param_name" => "company",
                "dependency" => array(
                    "element" => "style",
                    "value" => array('full')
                )
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Testimonials Text Color", 'nasa-core'),
                "param_name" => "text_color",
                "value" => "#fff",
                "dependency" => array(
                    "element" => "style",
                    "value" => array('full')
                )
            ),
            array(
                "type" => "textarea_html",
                "holder" => "div",
                "heading" => __("Testimonials Content Say", 'nasa-core'),
                "param_name" => "content",
                "value" => "Some promo text",
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Align', 'nasa-core'),
                "param_name" => 'text_align',
                "value" => array(
                    __('Center', 'nasa-core') => 'center',
                    __('Left', 'nasa-core') => 'left',
                    __('Right', 'nasa-core') => 'right',
                    __('Justify', 'nasa-core') => 'justify'
                ),
                'std' => 'center',
                
                "dependency" => array(
                    "element" => "style",
                    "value" => array('full')
                )
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

    // **********************************************************************// 
    // ! Register New Element: Contact Footer
    // **********************************************************************//
    $params = array(
        "name" => "Contact info",
        'base' => 'nasa_contact_us',
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create info contact, introduce.", 'nasa-core'),
        'category' => 'Nasa Core',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => __("Address", 'nasa-core'),
                "param_name" => "contact_address",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Phone", 'nasa-core'),
                "param_name" => "contact_phone",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Email", 'nasa-core'),
                "param_name" => "contact_email",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Website", 'nasa-core'),
                "param_name" => "contact_website",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra Class", 'nasa-core'),
                "param_name" => "el_class"
            )
        )
    );
    
    vc_map($params);

    // **********************************************************************// 
    // ! Register New Element: Opening Time
    // **********************************************************************//
    $params = array(
        "name" => "Opening time",
        "base" => "nasa_opening_time",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create info opening time of shop.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __('Weekdays Start Time', 'nasa-core'),
                "param_name" => 'weekdays_start',
                "std" => '08:00'
            ),
            array(
                "type" => "textfield",
                "heading" => __('Weekdays End Time', 'nasa-core'),
                "param_name" => 'weekdays_end',
                "std" => '20:00'
            ),
            array(
                "type" => "textfield",
                "heading" => __('Saturday Start Time', 'nasa-core'),
                "param_name" => 'sat_start',
                "std" => '09:00'
            ),
            array(
                "type" => "textfield",
                "heading" => __('Saturday End Time', 'nasa-core'),
                "param_name" => 'sat_end',
                "std" => '21:00'
            ),
            array(
                "type" => "textfield",
                "heading" => __('Sunday Start Time', 'nasa-core'),
                "param_name" => 'sun_start',
                "std" => '13:00'
            ),
            array(
                "type" => "textfield",
                "heading" => __('Sunday End Time', 'nasa-core'),
                "param_name" => 'sun_end',
                "std" => '22:00'
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

    // **********************************************************************// 
    // ! Register New Element: nasa Text link
    // **********************************************************************//
    $params = array(
        "name" => "Text Link",
        "base" => "nasa_separator_link",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create text link custom.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __('Title text', 'nasa-core'),
                'param_name' => 'title_text',
                'admin_label' => true,
                'value' => '',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Link text', 'nasa-core'),
                'param_name' => 'link_text',
                'admin_label' => true,
                'value' => '',
                'description' => ''
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Color title", 'nasa-core'),
                "param_name" => "title_color",
                "value" => ""
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Title heading', 'nasa-core'),
                "param_name" => 'title_type',
                "value" => array(
                    __('No heading', 'nasa-core') => 'span',
                    __('H1', 'nasa-core') => 'h1',
                    __('H2', 'nasa-core') => 'h2',
                    __('H3', 'nasa-core') => 'h3',
                    __('H4', 'nasa-core') => 'h4',
                    __('H5', 'nasa-core') => 'h5'
                ),
                'std' => 'span',
                'admin_label' => true
            ),
            array(
                "type" => "colorpicker",
                "heading" => __("Background title", 'nasa-core'),
                "param_name" => "title_bg",
                "value" => "#FFFFFF"
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Title HR', 'nasa-core'),
                "param_name" => 'title_hr',
                "value" => array(
                    __('Simple', 'nasa-core') => 'simple',
                    __('Full', 'nasa-core') => 'full',
                    __('None', 'nasa-core') => 'none'
                ),
                'std' => 'simple',
                'admin_label' => true
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Title Description', 'nasa-core'),
                'param_name' => 'title_desc',
                'admin_label' => true,
                'value' => '',
                'description' => ''
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
                        'simple', 'full', 'none'
                    )
                ),
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
                "type" => "textfield",
                "heading" => __("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    );
    
    vc_map($params);

    // **********************************************************************// 
    // ! Register New Element: nasa Countdown
    // **********************************************************************//
    $params = array(
        "name" => "Countdown Time",
        "base" => "nasa_countdown",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create Countdown time.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __('Date text', 'nasa-core'),
                'param_name' => 'date',
                'admin_label' => true,
                'value' => '',
                'description' => 'Format: YYYY-mm-dd HH:mm:ss | YYYY/mm/dd HH:mm:ss'
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Style', 'nasa-core'),
                "param_name" => 'style',
                "value" => array(
                    __('Digital', 'nasa-core') => 'digital',
                    __('Text', 'nasa-core') => 'text'
                ),
                'std' => 'digital',
                'admin_label' => true
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Date align', 'nasa-core'),
                "param_name" => 'align',
                "value" => array(
                    __('Center', 'nasa-core') => 'center',
                    __('Left', 'nasa-core') => 'left',
                    __('Right', 'nasa-core') => 'right'
                ),
                'std' => 'center',
                'admin_label' => true,
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        'digital'
                    )
                ),
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Font size', 'nasa-core'),
                "param_name" => 'size',
                "value" => array(
                    __('Small', 'nasa-core') => 'small',
                    __('Large', 'nasa-core') => 'large'
                ),
                'std' => 'small',
                'admin_label' => true,
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        'digital'
                    )
                ),
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
    
    // **********************************************************************// 
    // ! Register New Element: nasa Image
    // **********************************************************************//
    $params = array(
        "name" => "Image",
        "base" => "nasa_image",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Create image.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => __('ALT - Title', 'nasa-core'),
                'param_name' => 'alt',
                'admin_label' => true,
                'value' => '',
            ),
            array(
                "type" => "dropdown",
                "heading" => __('Caption', 'nasa-core'),
                "param_name" => 'caption',
                "value" => array(
                    __('No, Thanks!', 'nasa-core') => '',
                    __('Yes, Please!', 'nasa-core') => '1'
                ),
                'std' => ''
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
                "heading" => __('Align', 'nasa-core'),
                "param_name" => 'align',
                "value" => array(
                    __('Default', 'nasa-core') => '',
                    __('Left', 'nasa-core') => 'left',
                    __('Center', 'nasa-core') => 'center',
                    __('Right', 'nasa-core') => 'right',
                ),
                'std' => ''
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
    
    // **********************************************************************// 
    // ! Register New Element: nasa Boot rate
    // **********************************************************************//
    $params = array(
        "name" => "Boot Rate",
        "base" => "nasa_boot_rate",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Boot Rate", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textarea',
                'heading' => __('Customer Says', 'nasa-core'),
                'param_name' => 'text',
                'admin_label' => true,
                'value' => '',
            ),
            array(
                'type' => 'textfield',
                'heading' => __('Customer Name', 'nasa-core'),
                'param_name' => 'name',
                'admin_label' => true,
                'value' => '',
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
