<?php
/**
 * Shortcode [nasa_products_special_deal ...]
 * 
 * @global type $nasa_opt
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_sc_products_special_deal($atts = array(), $content = null) {
    global $nasa_opt, $nasa_sc;
    
    if (!NASA_WOO_ACTIVED) {
        return $content;
    }
    
    if (!isset($nasa_sc) || !$nasa_sc) {
        $nasa_sc = 1;
    }
    $GLOBALS['nasa_sc'] = $nasa_sc + 1;
    
    $dfAttr = array(
        'title' => '',
        'title_align' => '0',
        'desc_shortcode' => '',
        'limit' => '4',
        'columns_number' => '1',
        'columns_number_small' => '1',
        'columns_number_tablet' => '1',
        'cat' => '',
        'incls' => '',
        'incls_a' => '',
        'style' => 'simple',
        'date_sc' => '',
        'statistic' => '1',
        'arrows' => 1,
        'arrows_pos' => '0',
        'auto_slide' => 'true',
        'el_class' => '',
        'sc' => $nasa_sc,
        'loop_slide' => 'false'
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    $deal_time = $date_sc ? strtotime($date_sc) : 0;
    if (in_array($style, array('for_time', 'for_time-2')) && $deal_time < NASA_TIME_NOW) {
        return;
    }
    
    $style = in_array($style, array('simple', 'multi', 'multi-2', 'for_time', 'for_time-2')) ? $style : 'simple';
    
    $load_slick = in_array($style, array('multi', 'multi-2')) ? true : false;
    if ($load_slick) {
        /**
         * Open slick
         */
        wp_enqueue_script('nasa-open-slicks', NASA_CORE_PLUGIN_URL . 'assets/js/min/nasa-open-slick.min.js', array('jquery-slick'), null, true);
    }
    
    /**
     * Cache shortcode
     */
    $key = false;
    if (isset($nasa_opt['nasa_cache_shortcodes']) && $nasa_opt['nasa_cache_shortcodes']) {
        $key = nasa_key_shortcode('nasa_products_special_deal', $dfAttr, $atts);
        
        if (
            isset($nasa_opt['loop_layout_buttons']) &&
            $nasa_opt['loop_layout_buttons'] != '' &&
            in_array($style, array('simple', 'for_time', 'for_time-2'))
        ) {
            $key .= '_btns-' . $nasa_opt['loop_layout_buttons'];
        }
        
        $content = nasa_get_cache_shortcode($key);
    }
    
    if (!$content) {
        $number = (int) $limit ? (int) $limit : 4;
        
        $woo_args = array(
            'type' => 'deals',
            'post_per_page' => $number,
            'paged' => 1,
            'cat' => $cat,
            'deal_time' => $deal_time
        );
        
        if (isset($incls) && $incls === '1') {
            if (!isset($incls_a)) {
                $incls_a = array();
            }
            
            $woo_args['incls_a'] = $incls_a;
        }
        
        $specials = nasa_woo_query($woo_args);
        
        $_total = $specials->post_count;
        
        $nasa_args = array(
            'nasa_opt' => $nasa_opt,
            'title' => $title,
            'title_align' => $title_align,
            'desc_shortcode' => $desc_shortcode,
            'limit' => $limit,
            'columns_number' => $columns_number,
            'columns_number_small' => $columns_number_small,
            'columns_number_tablet' => $columns_number_tablet,
            'incls' => $incls,
            'incls_a' => $incls_a,
            'cat' => $cat,
            'style' => $style,
            'date_sc' => $date_sc,
            'statistic' => $statistic,
            'arrows' => $arrows,
            'arrows_pos' => $arrows_pos,
            'auto_slide' => $auto_slide,
            'loop_slide' => $loop_slide,
            'el_class' => $el_class,
            'number' => $number,
            'specials' => $specials,
            'deal_time' => $deal_time,
            '_total' => $_total,
            'sc' => $sc,
        );
        
        $file_include = 'products/nasa_products_deal/product_special_deal_' . $style . '.php';

        if ($_total) :
            ob_start();
            ?>
            <div class='nasa-sc woocommerce nasa-products-special-deal<?php echo ' nasa-products-special-deal-' . $style . ($el_class != '' ? ' ' . $el_class : ''); ?>'>
                <?php nasa_template($file_include, $nasa_args); ?>
            </div>
        <?php
            $content = ob_get_clean();
            wp_reset_postdata();
        endif;

        if ($content) {
            nasa_set_cache_shortcode($key, $content);
        }
    }
    
    return $content;
}

function nasa_register_product_special_deals(){
    // **********************************************************************// 
    // ! Register New Element: Products Deal
    // **********************************************************************//
    vc_map(array(
        'name' => 'Products Deal',
        'base' => 'nasa_products_special_deal',
        'icon' => 'icon-wpb-nasatheme',
        'description' => __('Display products deal.', 'nasa-core'),
        'class' => '',
        'category' => 'Nasa Core',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => __('Limit products', 'nasa-core'),
                'param_name' => 'limit',
                'std' => '4',
                // 'dependency' => array(
                //     'element' => 'incls',
                //     'value' => array(
                //         ''
                //     )
                // ),
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('Product Category', 'nasa-core'),
                'param_name' => 'cat',
                'value' => nasa_get_cat_product_array(),
                'admin_label' => true,
                // 'dependency' => array(
                //     'element' => 'incls',
                //     'value' => array(
                //         ''
                //     )
                // ),
            ),
            
            /* array(
                'type' => 'dropdown',
		'heading' => __('Include list products?', 'nasa-core'),
		'param_name' => 'incls',
                'value' => array(
                    __('No, Thanks!', 'nasa-core') => '',
                    __('Yes, Please!', 'nasa-core') => '1'
                ),
		'description' => __('Enter the products you want to display here', 'nasa-core'),
		// 'edit_field_class' => 'vc_col-sm-3',
            ),
            
            array(
                'type' => 'textfield',
                'heading' => __('List products', 'nasa-core'),
                'param_name' => 'incls_a',
                'std' => '',
                'dependency' => array(
                    'element' => 'incls',
                    'value' => array(
                        '1'
                    )
                ),
            ), */

            array(
                'type' => 'dropdown',
                'heading' => __('Style', 'nasa-core'),
                'param_name' => 'style',
                'value' => array(
                    __('Simple Deals', 'nasa-core') => 'simple',
                    __('Has Nav 2 Items', 'nasa-core') => 'multi',
                    __('Has Nav 4 Items', 'nasa-core') => 'multi-2',
                    __('Deal Before Time', 'nasa-core') => 'for_time',
                    __('Deal Before Time V2', 'nasa-core') => 'for_time-2'
                ),
                'std' => 'simple',
                'admin_label' => true,
            ),

            array(
                'type' => 'textfield',
                'heading' => __('Title', 'nasa-core'),
                'param_name' => 'title',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'simple',
                        'multi-2',
                        'for_time',
                        'for_time-2'
                    )
                ),
            ),
            
            array(
                'type' => 'dropdown',
                'heading' => __('Title Centered - For Deal Before Time V2', 'nasa-core'),
                'param_name' => 'title_align',
                'value' => array(
                    __('No, Thanks!', 'nasa-core') => '0',
                    __('Yes, Please!', 'nasa-core') => '1'
                ),
                'std' => '0',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'for_time-2'
                    )
                ),
            ),

            array(
                'type' => 'textfield',
                'heading' => __('Short Description', 'nasa-core'),
                'param_name' => 'desc_shortcode',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'for_time',
                        'for_time-2'
                    )
                ),
            ),

            array(
                'type' => 'textfield',
                'heading' => __('End date show deals (yyyy-mm-dd | yyyy/mm/dd)', 'nasa-core'),
                'param_name' => 'date_sc',
                'std' => '',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'for_time',
                        'for_time-2'
                    )
                ),
                'admin_label' => true
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('Columns Number', 'nasa-core'),
                'param_name' => 'columns_number',
                'value' => array(6, 5, 4, 3, 2, 1),
                'std' => 1,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'simple',
                        'for_time',
                        'for_time-2'
                    )
                ),
                'admin_label' => true
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('Columns Number Small', 'nasa-core'),
                'param_name' => 'columns_number_small',
                'value' => array('2', '1.5', '1'),
                'std' => 1,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'simple',
                        'for_time',
                        'for_time-2'
                    )
                ),
                'admin_label' => true
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('Columns Number Tablet', 'nasa-core'),
                'param_name' => 'columns_number_tablet',
                'value' => array(4, 3, 2, 1),
                'std' => 1,
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'simple',
                        'for_time',
                        'for_time-2'
                    )
                ),
                'admin_label' => true
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('Show Available - Sold', 'nasa-core'),
                'param_name' => 'statistic',
                'value' => array(
                    __('No, Thanks!', 'nasa-core') => '0',
                    __('Yes, Please!', 'nasa-core') => '1'
                ),
                'std' => '1',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'simple',
                        'multi',
                        'multi-2',
                        'for_time-2'
                    )
                )
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('Arrows', 'nasa-core'),
                'param_name' => 'arrows',
                'value' => array(
                    __('Yes, Please!', 'nasa-core') => 1,
                    __('No, Thanks!', 'nasa-core') => 0
                ),
                'std' => 1
            ),
            
            array(
                'type' => 'dropdown',
                'heading' => __('Arrows Position - Simple Deals', 'nasa-core'),
                'param_name' => 'arrows_pos',
                'value' => array(
                    __('Top', 'nasa-core') => '0',
                    __('Side', 'nasa-core') => '1'
                ),
                'std' => '0'
            ),

            array(
                'type' => 'dropdown',
                'heading' => __('Auto Slide', 'nasa-core'),
                'param_name' => 'auto_slide',
                'value' => array(
                    __('Yes, Please!', 'nasa-core') => 'true',
                    __('No, Thanks!', 'nasa-core') => 'false'
                ),
                'std' => 'true'
            ),
            
            array(
                'type' => 'dropdown',
                'heading' => __('Slide Infinite', 'nasa-core'),
                'param_name' => 'loop_slide',
                'value' => array(
                    __('Yes, Please!', 'nasa-core') => 'true',
                    __('No, Thanks!', 'nasa-core') => 'false'
                ),
                'std' => 'false',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array(
                        'simple',
                        'for_time',
                        'for_time-2'
                    )
                )
            ),

            array(
                'type' => 'textfield',
                'heading' => __('Extra class name', 'nasa-core'),
                'param_name' => 'el_class',
                'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'nasa-core')
            )
        )
    ));
}
