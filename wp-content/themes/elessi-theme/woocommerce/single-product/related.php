<?php
/**
 * Single Product - Related Products
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author      NasaTheme
 * @package     Elessi-theme/WooCommerce
 * @version     3.9.0
 */
if (!defined('ABSPATH')) :
    exit;
endif;

if ($related_products) :
    global $nasa_opt;
    
    $_delay = 0;
    $_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
    
    $layout_buttons_class = '';
    
    if (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] != '') :
        $layout_buttons_class = ' nasa-' . $nasa_opt['loop_layout_buttons'];
    endif;

    $columns_desk = !isset($nasa_opt['relate_columns_desk']) || !(int) $nasa_opt['relate_columns_desk'] ? 5 : (int) $nasa_opt['relate_columns_desk'];
    $columns_tablet = !isset($nasa_opt['relate_columns_tablet']) || !(int) $nasa_opt['relate_columns_tablet'] ? 3 : (int) $nasa_opt['relate_columns_tablet'];
    $columns_small = isset($nasa_opt['relate_columns_small']) ? $nasa_opt['relate_columns_small'] : 2;
    $columns_small_slide = $columns_small == '1.5-cols' ? 1 : (int) $columns_small;
    
    if (!$columns_small) :
        $columns_small_slide = 2;
    endif;

    $ex_class = '';
    $head_class = '';
    if (isset($nasa_opt['product_detail_layout']) && $nasa_opt['product_detail_layout'] == 'new-3') {
        $ex_class = ' title-align-left';
        $layout_buttons_class .= ' nasa-nav-top';
        $head_class = ' padding-left-0 padding-right-0';
    } else {
        $layout_buttons_class .= ' nasa-nav-radius';
        $ex_class = ' margin-bottom-30';
        $head_class = ' text-center';
    }
    
    $data_attrs = array(
        'data-columns="' . esc_attr($columns_desk) . '"',
        'data-columns-small="' . esc_attr($columns_small_slide) . '"',
        'data-columns-tablet="' . esc_attr($columns_tablet) . '"',
        'data-switch-tablet="' . elessi_switch_tablet() . '"',
        'data-switch-desktop="' . elessi_switch_desktop() . '"',
    );

    if ($columns_small == '1.5-cols') :
        $data_attrs[] = 'data-padding-small="20%"';
    endif;
    
    if (isset($nasa_opt['relate_slide_auto']) && $nasa_opt['relate_slide_auto']) :
        $data_attrs[] = 'data-autoplay="true"';
    endif;

    if (isset($nasa_opt['relate_slide_loop']) && $nasa_opt['relate_slide_loop']) :
        $data_attrs[] = 'data-loop="true"';
    endif;
    
    $arr_attrs = apply_filters('nasa_attrs_relate_wrap', $data_attrs);
    
    $attrs_str = !empty($arr_attrs) ? ' ' . implode(' ', $arr_attrs) : '';
    
    $class_slider = 'ns-items-gap nasa-slick-slider nasa-slick-nav products grid' . $layout_buttons_class;
    ?>
    <div class="row related-product nasa-slider-wrap related products grid nasa-relative mobile-margin-bottom-20<?php echo $ex_class;?>">
        <div class="large-12 columns">
            <h3 class="nasa-title-relate<?php echo $head_class;?>">
                <?php echo apply_filters('woocommerce_product_related_products_heading', esc_html__('Related Products&hellip;', 'elessi-theme')); ?>
            </h3>
        </div>
        
        <div class="large-12 columns">
            <div class="<?php echo esc_attr($class_slider); ?>"<?php echo $attrs_str; ?>>
                <?php
                foreach ($related_products as $related_product) :
                    $post_object = get_post($related_product->get_id());
                    setup_postdata($GLOBALS['post'] = & $post_object);

                    // Product Item
                    wc_get_template('content-product.php', array(
                        '_delay' => $_delay,
                        'wrapper' => 'div'
                    ));
                    // End Product Item

                    $_delay += $_delay_item;
                endforeach;
                ?>
            </div>
        </div>
    </div>
    <?php
endif;

wp_reset_postdata();
