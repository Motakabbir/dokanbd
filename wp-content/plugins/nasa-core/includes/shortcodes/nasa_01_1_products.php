<?php
/**
 * Shortcode [nasa_products ...]
 * 
 * @global type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_products($atts = array(), $content = null) {
    global $nasa_opt;
    
    if (!NASA_WOO_ACTIVED) {
        return $content;
    }
    
    $dfAttr = array(
        'number' => '8',
        'cat' => '',
        'ns_tags' => '',
        'ns_brand' => '',
        'pwb_brand' => '',
        'type' => 'recent_product',
        'style' => 'grid',
        'style_viewmore' => '1',
        'style_row' => 'simple',
        'title_shortcode' => '',
        'pos_nav' => 'top',
        'title_align' => 'left',
        // 'shop_url' => 0,
        'arrows' => 1,
        'dots' => 'false',
        'auto_slide' => 'false',
        'loop_slide' => 'false',
        'auto_delay_time' => '6',
        'columns_number' => '4',
        'columns_number_small' => '2',
        'columns_number_small_slider' => '2',
        'columns_number_tablet' => '3',
        'not_in' => '',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    if ($type == '') {
        return $content;
    }
    
    /**
     * jQuery Open slick
     */
    $load_slick = in_array($style, array('slide_slick')) ? true : false;
    if ($load_slick) {
        wp_enqueue_script('nasa-open-slicks', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-open-slick.min.js', array('jquery-slick'), null, true);
    }
    
    /**
     * jQuery Ajax Load more
     */
    $load_more_js = in_array($style, array('infinite')) ? true : false;
    if ($load_more_js) {
        wp_enqueue_script('nasa-ajax-loadmore', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-ajax-loadmore.min.js', array('jquery'), null, true);
    }
    
    /**
     * Cache shortcode
     */
    $key = false;
    if (isset($nasa_opt['nasa_cache_shortcodes']) && $nasa_opt['nasa_cache_shortcodes']) {
        $key = nasa_key_shortcode('nasa_products', $dfAttr, $atts);
        
        if (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] != '') {
            $key .= '_btns-' . $nasa_opt['loop_layout_buttons'];
        }
        
        $content = nasa_get_cache_shortcode($key);
    }
    
    if (!$content) {
        $not_in = isset($not_in) ? trim(str_replace(' ', '', $not_in), ',') : '';
        if ($not_in != '') {
            $not_in = explode(',', $not_in);
        }

        $not_ids = array();
        if ($not_in) {
            foreach ($not_in as $id) {
                if (!in_array((int) $id, $not_ids)) {
                    $not_ids[] = (int) $id;
                }
            }
        }

        $is_deals = $type == 'deals' ? 'true' : 'false';
        
        if ($style == 'infinite' && ((int) $columns_number < 2 || (int) $columns_number > 6)) {
            $columns_number = 5;
        }
        
        $loop = nasa_woo_query(array(
            'type' => $type,
            'post_per_page' => $number,
            'paged' => 1,
            'cat' => $cat,
            'ns_tags' => $ns_tags,
            'ns_brand' => $ns_brand,
            'pwb_brand' => $pwb_brand,
            'not' => $not_ids,
            'deal_time' => null
        ));
        
        $_total = $loop->post_count;
        if ($_total) :
            $nasa_args = array(
                'number' => $number,
                'cat' => $cat,
                'type' => $type,
                'style' => $style,
                'style_viewmore' => $style_viewmore,
                'style_row' => $style_row,
                'title_shortcode' => $title_shortcode,
                'pos_nav' => $pos_nav,
                'title_align' => $title_align,
                // 'shop_url' => $shop_url,
                'arrows' => $arrows,
                'dots' => $dots,
                'auto_slide' => $auto_slide,
                'loop_slide' => $loop_slide,
                'auto_delay_time' => $auto_delay_time,
                'columns_number' => $columns_number,
                'columns_number_small' => $columns_number_small,
                'columns_number_small_slider' => $columns_number_small_slider,
                'columns_number_tablet' => $columns_number_tablet,
                'not_in' => $not_in,
                'el_class' => $el_class,
                'is_deals' => $is_deals,
                '_total' => $_total,
                'loop' => $loop,
            );
        
            $class_wrap = 'nasa-sc products woocommerce ns-type-' . $style;
            $class_wrap .= ($el_class != '') ? ' ' . esc_attr($el_class) : '';
            
            ob_start();
            ?>
            <div class="<?php echo esc_attr($class_wrap); ?>">
                <?php nasa_template('products/nasa_products/' . $style . '.php', $nasa_args); ?>
            </div>
            <?php
            $content = ob_get_clean();
        endif;
        
        if ($content) {
            nasa_set_cache_shortcode($key, $content);
        }
    }
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: nasa products
// **********************************************************************//
function nasa_register_product(){
    global $nasa_opt;
    
    $maps = array(
        "name" => "Products",
        "base" => "nasa_products",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Display products as many format.", 'nasa-core'),
        "class" => "",
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", 'nasa-core'),
                "param_name" => "title_shortcode",
                "value" => '',
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        "carousel", 'slide_slick', 'list_carousel'
                    )
                ),
                "description" => __("Only using for Style is Slider, Simple Slide, Slider - Widget Items.", 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Type Show", 'nasa-core'),
                "param_name" => "type",
                "value" => array(
                    __('Recent', 'nasa-core') => 'recent_product',
                    __('Best Selling', 'nasa-core') => 'best_selling',
                    __('Featured', 'nasa-core') => 'featured_product',
                    __('Top Rate', 'nasa-core') => 'top_rate',
                    __('On Sale', 'nasa-core') => 'on_sale',
                    __('Recent Review', 'nasa-core') => 'recent_review',
                    __('Deals') => 'deals',
                    __('Quantity Stock - Descending') => 'stock_desc'
                ),
                'std' => 'recent_product',
                "admin_label" => true
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Style", 'nasa-core'),
                "param_name" => "style",
                "value" => array(
                    __('Grid', 'nasa-core') => 'grid',
                    __('Slider', 'nasa-core') => 'carousel',
                    __('Simple Slider', 'nasa-core') => 'slide_slick',
                    __('Simple Slider v2', 'nasa-core') => 'slide_slick_2',
                    __('Ajax Infinite', 'nasa-core') => 'infinite',
                    __('List - Widget Items', 'nasa-core') => 'list',
                    __('Slider - Widget Items', 'nasa-core') => 'list_carousel'
                ),
                'std' => 'grid',
                "admin_label" => true
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Style View More', 'nasa-core'),
                "param_name" => 'style_viewmore',
                "value" => array(
                    __('Type 1 - No Border', 'nasa-core') => '1',
                    __('Type 2 - Border - Top - Bottom', 'nasa-core') => '2',
                    __('Type 3 - Button - Radius - Dash', 'nasa-core') => '3'
                ),
                "std" => '1',
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        'infinite'
                    )
                ),
                "description" => __("Only using for Style is Ajax Infinite.", 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Rows of Slide', 'nasa-core'),
                "param_name" => 'style_row',
                "value" => array(
                    __('1 Row', 'nasa-core') => '1',
                    __('2 Rows', 'nasa-core') => '2',
                    __('3 Rows', 'nasa-core') => '3'
                ),
                "std" => '1',
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        "carousel",
                        'list_carousel'
                    )
                ),
                "description" => __("Only using for Style is Slider.", 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Position Title | Navigation (The Top Only use for Style is Carousel)", 'nasa-core'),
                "param_name" => "pos_nav",
                "value" => array(
                    __('Top', 'nasa-core') => 'top',
                    __('Side', 'nasa-core') => 'left',
                    __('Side Classic', 'nasa-core') => 'both'
                ),
                "std" => 'top',
                "description" => __("Only using for Style is Slider 1 row.", 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Title align (Only use for Style is Slider)", 'nasa-core'),
                "param_name" => "title_align",
                "value" => array(
                    __('Left', 'nasa-core') => 'left',
                    __('Right', 'nasa-core') => 'right'
                ),
                "std" => 'left',
                "dependency" => array(
                    "element" => "pos_nav",
                    "value" => array(
                        "top"
                    )
                ),
                "description" => __("Only using for Style is Carousel.", 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Arrows', 'nasa-core'),
                "param_name" => 'arrows',
                "value" => array(
                    __('Yes, Please!', 'nasa-core') => 1,
                    __('No, Thanks!', 'nasa-core') => 0
                ),
                "std" => 1,
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        "carousel", 'list_carousel', 'slide_slick'
                    )
                ),
                "description" => __("Only using for Style is Slider or Simple Slide.", 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Dots', 'nasa-core'),
                "param_name" => 'dots',
                "value" => array(
                    __('Yes, Please!', 'nasa-core') => 'true',
                    __('No, Thanks!', 'nasa-core') => 'false'
                ),
                "std" => 'false',
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        "carousel", "slide_slick_2"
                    )
                ),
                "description" => __("Only using for Style is Slider, Simple Slider v2.", 'nasa-core')
            ),

            array(
                "type" => "dropdown",
                "heading" => __('Slide Auto', 'nasa-core'),
                "param_name" => 'auto_slide',
                "value" => array(
                    __('No, Thanks!', 'nasa-core') => 'false',
                    __('Yes, Please!', 'nasa-core') => 'true'
                ),
                "std" => 'false',
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        "carousel", "list_carousel", "slide_slick", "slide_slick_2"
                    )
                ),
                "description" => __("Only using for Slide.", 'nasa-core')
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __('Slide Infinite', 'nasa-core'),
                "param_name" => 'loop_slide',
                "value" => array(
                    __('No, Thanks!', 'nasa-core') => 'false',
                    __('Yes, Please!', 'nasa-core') => 'true'
                ),
                "std" => 'false',
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        "carousel", "list_carousel", "slide_slick_2"
                    )
                ),
                "description" => __("Only using for Slider.", 'nasa-core')
            ),

            array(
                "type" => "textfield",
                "heading" => __("Delay Time (s)", 'nasa-core'),
                "param_name" => "auto_delay_time",
                "value" => '6',
                "dependency" => array(
                    "element" => "style",
                    "value" => array(
                        "carousel", "list_carousel"
                    )
                ),
            ),

            array(
                "type" => "textfield",
                "heading" => __("Limit", 'nasa-core'),
                "param_name" => "number",
                "value" => '8',
                "std" => '8',
                "admin_label" => true,
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number", 'nasa-core'),
                "param_name" => "columns_number",
                "value" => array(6, 5, 4, 3, 2, 1),
                "std" => 4,
                "admin_label" => true,
                "dependency" => array(
                    "element" => "style",
                    "value" => array('grid', 'carousel', 'slide_slick', 'infinite', 'list', 'list_carousel')
                ),
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Tablet", 'nasa-core'),
                "param_name" => "columns_number_tablet",
                "value" => array(4, 3, 2, 1),
                "std" => 3,
                "admin_label" => true,
                "dependency" => array(
                    "element" => "style",
                    "value" => array('grid', 'carousel', 'infinite', 'list', 'list_carousel')
                ),
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Small", 'nasa-core'),
                "param_name" => "columns_number_small",
                "value" => array(3, 2, 1),
                "std" => '2',
                "admin_label" => true,
                "dependency" => array(
                    "element" => "style",
                    "value" => array('grid', 'infinite', 'list', 'list_carousel')
                )
            ),
            
            array(
                "type" => "dropdown",
                "heading" => __("Columns Number Small", 'nasa-core'),
                "param_name" => "columns_number_small_slider",
                "value" => array('3', '2', '1.5', '1'),
                "std" => '2',
                "admin_label" => true,
                "dependency" => array(
                    "element" => "style",
                    "value" => array('carousel')
                )
            ),

            array(
                "type" => "dropdown",
                "heading" => __("Product Category", 'nasa-core'),
                "param_name" => "cat",
                "admin_label" => true,
                "value" => nasa_get_cat_product_array()
            ),
            
            array(
                "type" => "textfield",
                "heading" => __('Slug of tags, separated by ","', 'nasa-core'),
                "param_name" => "ns_tags",
                "value" => ''
            ),
        )
    );
    
    if (isset($nasa_opt['enable_nasa_brands']) && $nasa_opt['enable_nasa_brands']) {
        $maps['params'][] = array(
            "type" => "dropdown",
            "heading" => __("Product Brand - Nasa", 'nasa-core'),
            "param_name" => "ns_brand",
            "admin_label" => true,
            "value" => nasa_get_brands_product_array()
        );
    }
    
    if (defined('PWB_PLUGIN_NAME')) {
        $maps['params'][] = array(
            "type" => "dropdown",
            "heading" => __("Product Brand (PWB)", 'nasa-core'),
            "param_name" => "pwb_brand",
            "admin_label" => true,
            "value" => nasa_get_pwb_brands_product_array()
        );
    }
    
    $maps['params'][] = array(
        "type" => "textfield",
        "heading" => __("Excludes Product Ids", 'nasa-core'),
        "param_name" => "not_in",
        "value" => '',
        "admin_label" => true,
    );
    
    $maps['params'][] = array(
        "type" => "textfield",
        "heading" => __("Extra class name", 'nasa-core'),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
    );
    
    vc_map($maps);
}
