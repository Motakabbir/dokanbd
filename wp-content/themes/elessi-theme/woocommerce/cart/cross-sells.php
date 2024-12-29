<?php
/**
 * Cross-sells
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 4.4.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

if ($cross_sells) :
    global $nasa_opt;

    // echo $nasa_opt['loop_layout_buttons'];

    $_delay = 0;
    $_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
    
    $layout_buttons_class = '';
    if (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] != '') :
        $layout_buttons_class = ' nasa-' . $nasa_opt['loop_layout_buttons'];
    endif;
    
    $columns_desk = !isset($nasa_opt['crs_columns_desk']) || !(int) $nasa_opt['crs_columns_desk'] ? 5 : (int) $nasa_opt['crs_columns_desk'];
    $columns_tablet = !isset($nasa_opt['crs_columns_tablet']) || !(int) $nasa_opt['crs_columns_tablet'] ? 3 : (int) $nasa_opt['crs_columns_tablet'];
    $columns_small = isset($nasa_opt['crs_columns_small']) ? $nasa_opt['crs_columns_small'] : 2;
    $columns_small_slide = $columns_small == '1.5-cols' ? 1 : (int) $columns_small;

    $columns_desk = apply_filters('ns_crs_columns_desk', $columns_desk);
    
    if (!$columns_small) :
        $columns_small_slide = 2;
    endif;
    
    $start_row = '<div class="row">';
    $end_row = '</div>';
    $class_wrap = 'large-12 columns related related-product cross-sells products grid nasa-slider-wrap margin-top-50';
    
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
    
    if (isset($nasa_opt['crs_slide_auto']) && $nasa_opt['crs_slide_auto']) :
        $data_attrs[] = 'data-autoplay="true"';
    endif;
    
    if (isset($nasa_opt['crs_slide_loop']) && $nasa_opt['crs_slide_loop']) :
        $data_attrs[] = 'data-loop="true"';
    endif;
    
    $arr_attrs = apply_filters('nasa_attrs_cross_sell_wrap', $data_attrs);
    
    $attrs_str = !empty($arr_attrs) ? ' ' . implode(' ', $arr_attrs) : '';
    
    $heading = apply_filters('woocommerce_product_cross_sells_products_heading', esc_html__('You may be interested in&hellip;', 'elessi-theme'));
    
    $class_slider = 'ns-items-gap nasa-slick-slider nasa-slick-nav nasa-nav-radius products grid' . $layout_buttons_class;
    
    echo $start_row;
    ?>

    <div class="<?php echo esc_attr($class_wrap); ?>">
        <?php if ($heading) : ?>
            <div class="nasa-slide-style-product-carousel nasa-relative margin-bottom-20">
                <h3 class="nasa-shortcode-title-slider fs-25 mobile-fs-20 text-center">
                    <?php echo $heading; ?>
                </h3>
            </div>
        <?php endif; ?>

        <div class="<?php echo esc_attr($class_slider); ?>"<?php echo $attrs_str; ?>>
            <?php
            foreach ($cross_sells as $cross_sell) :
                $post_object = get_post($cross_sell->get_id());
                setup_postdata($GLOBALS['post'] = & $post_object);
                
                // Product Item -->
                wc_get_template('content-product.php', array(
                    '_delay' => $_delay,
                    'wrapper' => 'div'
                ));
                // End Product Item -->
                
                $_delay += $_delay_item;
            endforeach;
            ?>
        </div>
    </div>
    <?php
    
    echo $end_row;
endif;

wp_reset_postdata();
