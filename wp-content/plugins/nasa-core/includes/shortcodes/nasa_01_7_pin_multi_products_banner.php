<?php
/**
 * Shortcode [nasa_pin_multi_products_banner ...]
 * 
 * @global type $nasa_pin_sc
 * @global type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return string
 */
function nasa_sc_pin_multi_products_banner($atts = array(), $content = null) {
    global $nasa_opt, $nasa_pin_sc;
    
    if (!isset($nasa_pin_sc) || !$nasa_pin_sc) {
        $nasa_pin_sc = 1;
    }
    $GLOBALS['nasa_pin_sc'] = $nasa_pin_sc + 1;
    
    if (!NASA_WOO_ACTIVED) {
        return $content;
    }
    
    $dfAttr = array(
        'pin_slug' => '',
        'pin_effect' => 'yes',
        'tab_slide_add_dot' => 'yes',
        'el_class' => '',
        'pin_multi_reverse' => 'no',
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    $layout_buttons_class = (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] != '') ?' nasa-' . $nasa_opt['loop_layout_buttons']: '';

    $slider_class = 'ns-items-gap nasa-slick-slider products grid' . $layout_buttons_class;
    $product_tab = '';
    $_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
    $description_info = apply_filters('nasa_loop_short_description_show', false);
    $slide_add_dot = 'true';
  

    $slide_add_dot = ($tab_slide_add_dot == 'no' && isset($tab_slide_add_dot)) ? 'false' : $slide_add_dot ;

    $data_attrs = array();
    $data_attrs[] = 'data-columns="2"';
    $data_attrs[] = 'data-columns-small="2"';
    $data_attrs[] = 'data-columns-tablet="2"';
    $data_attrs[] = 'data-autoplay="false"';
    $data_attrs[] = 'data-loop="false"';
    $data_attrs[] = 'data-slides-all="false"';
    $data_attrs[] = 'data-delay="6000"';
    $data_attrs[] = 'data-height-auto="false"';
    $data_attrs[] = 'data-dot="'.$slide_add_dot.'"';
    $data_attrs[] = 'data-switch-tablet="' . nasa_switch_tablet() . '"';
    $data_attrs[] = 'data-switch-desktop="' . nasa_switch_desktop() . '"';

    $attrs_str = !empty($data_attrs) ? ' ' . implode(' ', $data_attrs) : '';

    if ($pin_slug === '') {
        return $content;
    }
    
    $post_pin_product_banner = get_posts(array(
        'name'              => $pin_slug,
        'post_status'       => 'publish',
        'post_type'         => 'nasa_pin_mlpb',
        'numberposts'       => 1
    ));
    
    if (!$post_pin_product_banner) {
        return $content;
    }
    
    /**
     * Pin Banner
     */
    wp_enqueue_script('jquery-easing', NASA_CORE_PLUGIN_URL . 'assets/js/min/jquery.easing.min.js', array('jquery'), null, true);
    wp_enqueue_script('jquery-easypin', NASA_CORE_PLUGIN_URL . 'assets/js/min/jquery.easypin.min.js', array('jquery'), null, true);
    
    $pin = $post_pin_product_banner[0];
    
    $content = '';
    
    // Get current image.
    $attachment_id = get_post_meta($pin->ID, 'nasa_pin_mlpb_image_url', true);
    if ($attachment_id) {
        // Get image source.
        $image_src = wp_get_attachment_url($attachment_id);
        
        if (!$image_src) {
            return $content;
        }
        
        $pin_rand_id = 'nasa_pin_' . $nasa_pin_sc;
        
        $data = array(
            $pin_rand_id => array()
        );
        
        $_width = get_post_meta($pin->ID, 'nasa_pin_mlpb_image_width', true);
        $_height = get_post_meta($pin->ID, 'nasa_pin_mlpb_image_height', true);
        $_options = get_post_meta($pin->ID, 'nasa_pin_mlpb_options', true);

        $_optionsArr = json_decode($_options);

        if (!isset($marker_style) || !in_array($marker_style, array('price', 'plus'))) {
            $marker_style = 'price';
        }

        $icon = '<i class="nasa-marker-icon nasa-flex">' .
        '<svg width="20px" height="20px" viewBox="0 0 24 24" fill="none">' .
            '<path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />' .
            '<path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />' .
        '</svg></i>';

        $k = 0;
        
        if (is_array($_optionsArr) && !empty($_optionsArr)) {
            $pin_title = isset($pin->post_title) ? $pin->post_title : esc_html__('Shop The Look', 'nasa-core');

            $padding_tab = $pin_multi_reverse == 'yes' ? 'desktop-padding-right-40 rtl-desktop-padding-right-0 rtl-desktop-padding-left-40 tablet-padding-right-20 rtl-tablet-padding-right-0 rtl-tablet-padding-left-20' : 'desktop-padding-left-40 rtl-desktop-padding-left-0 rtl-desktop-padding-right-40 tablet-padding-left-20 rtl-tablet-padding-left-0 rtl-tablet-padding-right-20';
            // $image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
            $product_tab = '<div class="nasa_multi_product_pin_tab_wrap ' . $padding_tab . '">' . 
                '<div class="nasa_multi_tabs_content">';
            
            foreach ($_optionsArr as $option) {
                $pin_title = isset($option->list_title) && $option->list_title != '' ? $option->list_title : $pin_title;
                $data_id_json = json_decode($option->product_list, true);
                $curent_class = $k == 0 ? 'current-tab': '';
                $product_tab .= '<div class="nasa-relative nasa_multi_product_pin_tab nasa-slider-wrap nasa-slide-style-product-carousel nasa-warp-slide-nav-top title-align-left ' . $curent_class . '" data-key-tab="' . $k . '">';
                $product_tab .='<h3>' . $pin_title . '</h3>';
                $product_tab .= '<div class="' . $slider_class . '" ' . $attrs_str . '>';

                foreach ($data_id_json as $item) {
                    if (isset($item['product_id'])) {
                        $product_by_id = wc_get_product( $item['product_id'] );
                        
                        if ($product_by_id) {
                            global $product;

                            $post_object = get_post($item['product_id']);
                            setup_postdata($GLOBALS['post'] =& $post_object);
        
                            $GLOBALS['product'] = $product_by_id;
    
                            if (!empty($product_by_id) || $product_by_id->is_visible()) {
                                ob_start();
                                wc_get_template('content-product.php', array(
                                    'is_deals' => true,
                                    '_delay' => 0,
                                    '_delay_item' => $_delay_item,
                                    'wrapper' => 'div',
                                    'show_in_list' => false,
                                    'description_info' => $description_info
                                ));
                                $product_tab .= ob_get_clean();
                            }
                        }
                    }
                }

                $product_tab .= '</div></div>';
                
                $position_show = isset($option->position_show) ? $option->position_show : 'top';

                $title_list = isset($option->list_title) && $option->list_title != '' ? $option->list_title : '';

                $data[$pin_rand_id][$k] = array(
                    'marker_pin' => $icon,
                    'position' => 'nasa-' . $position_show,
                    'product' => $option->product_list,
                    'title_list' =>  $title_list,
                    'key_tab' => $k,
                    'coords' => $option->coords
                );

                $k++;
            }

            $product_tab .= '</div></div>';
            
            wp_reset_postdata();
        }

        $canvas = array(
            'src' => $image_src,
            'width' => $_width,
            'height' => $_height
        );

        $data[$pin_rand_id]['canvas'] = $canvas;

        $data_pin = wp_json_encode($data);

        if ($pin_effect == 'default') {
            $effect_class = isset($nasa_opt['effect_pin_product_banner']) && $nasa_opt['effect_pin_product_banner'] ? ' nasa-has-effect' : '';
        } else {
            $effect_class = $pin_effect == 'yes' ? ' nasa-has-effect' : '';
        }

        $effect_class .= $el_class != '' ? ' ' . $el_class : '';

        $effect_class .= $pin_multi_reverse == 'yes' ? ' multi-banner-slide-reverse' : '';

        $padding_img = $pin_multi_reverse == 'yes' ? 'desktop-padding-left-40 rtl-desktop-padding-left-0 rtl-desktop-padding-right-40 tablet-padding-left-20 rtl-tablet-padding-left-0 rtl-tablet-padding-right-20' : 'desktop-padding-right-40 rtl-desktop-padding-right-0 rtl-desktop-padding-left-40 tablet-padding-right-20 rtl-tablet-padding-right-0 rtl-tablet-padding-left-20';

        $content .= '<div class="nasa-inner-wrap nasa-pin-mlpb-wrap nasa-pin-wrap nasa-pin-banner-wrap' . $effect_class . '" data-pin="' . esc_attr($data_pin) . '">';

        $content .= '<span class="nasa-wrap-relative-image ' . $padding_img .  '">' .
            '<div data-width="' . $_width . '" data-height="' . $_height . '" class="nasa_pin_mlpb_image" data-src="' . esc_url($image_src) . '" data-easypin_id="' . $pin_rand_id . '" data-alt="' . esc_attr($pin->post_title) . '"></div>' .
        '</span>';
        $content .= $product_tab;
        $content .= '<div style="display:none;" id="tpl-' . $pin_rand_id . '" class="nasa-easypin-tpl">';
        $content .= 
        '<div class="nasa-popover-clone">' .
            '<div class="{[position]} popover-plus-wrap">' .
                '<div class="nasa-product-pin text-center">' .
                    '<a href="javascript:void(0);" class="pin-product-url pin-product-list" rel="nofollow">' .
                        '{[title_list]}'.
                    '</a>' .
                '</div>' .
            '</div>' .
        '</div>' .
        '<div class="nasa-marker-clone">' .
            '<div style="width:35px; height:35px;">' .
                '<span class="nasa-marker-icon-wrap nasa-marker-icon-multi-product" data-key-tab="{[key_tab]}">{[marker_pin]}<span class="nasa-action-effect"></span></span>' .
            '</div>' .
        '</div>'; 
        
        $content .= '</div>';
        $content .= '</div>';
    }
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: Products banner
// **********************************************************************//
function nasa_register_multi_products_banner(){
    $products_banner_params = array(
        "name" => "Multi Products Banner",
        "base" => "nasa_pin_multi_products_banner",
        "icon" => "icon-wpb-nasatheme",
        'description' => __("Display Multi products pin banner.", 'nasa-core'),
        "category" => "Nasa Core",
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __('Select Pin', 'nasa-core'),
                "param_name" => 'pin_slug',
                "value" => nasa_get_pin_arrays('nasa_pin_mlpb'),
                "std" => '',
                "admin_label" => true
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Effect icons", 'nasa-core'),
                "param_name" => "pin_effect",
                "value" => array(
                    __('Default', 'nasa-core') => 'default',
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                "std" => 'default'
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Add Dot Slide", 'nasa-core'),
                "param_name" => "tab_slide_add_dot",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                "std" => 'yes'
            ),

            
            array(
                "type" => "dropdown",
                "heading" => __("Mutil Pin Banner Reverse", 'nasa-core'),
                "param_name" => "pin_multi_reverse",
                "value" => array(
                    __('Yes', 'nasa-core') => 'yes',
                    __('No', 'nasa-core') => 'no'
                ),
                "std" => 'no'
            ),

            array(
                "type" => "textfield",
                "heading" => __("Extra Class", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'nasa-core')
            )
        )
    );
    
    vc_map($products_banner_params);
}
