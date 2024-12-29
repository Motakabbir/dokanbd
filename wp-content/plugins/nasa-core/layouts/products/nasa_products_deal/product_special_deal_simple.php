<?php
/**
 * Hover effect products in grid
 */
$nasa_animated_products = isset($nasa_opt['animated_products']) ? $nasa_opt['animated_products'] : '';

$layout_buttons_class = '';
if (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] != '') :
    $layout_buttons_class = ' nasa-' . $nasa_opt['loop_layout_buttons'];
endif;

$arrows = isset($arrows) ? $arrows : 0;
$auto_slide = isset($auto_slide) ? $auto_slide : 'true';
$loop_slide = isset($loop_slide) ? $loop_slide : 'false';

$class_slide = 'ns-items-gap nasa-slick-slider products grid' . $layout_buttons_class;

if ($arrows == 1) {
    $class_slide .= ' nasa-slick-nav';
    $class_slide .= $arrows_pos == '1' ? ' nasa-nav-radius' : ' nasa-nav-top-right';
}

$columns_small = $columns_number_small == '1.5' ? '1' : $columns_number_small;

/**
 * Attributes sliders
 */
$data_attrs = array();
$data_attrs[] = 'data-columns="' . esc_attr($columns_number) . '"';
$data_attrs[] = 'data-columns-small="' . esc_attr($columns_small) . '"';
$data_attrs[] = 'data-columns-tablet="' . esc_attr($columns_number_tablet) . '"';
$data_attrs[] = 'data-autoplay="' . esc_attr($auto_slide) . '"';
$data_attrs[] = 'data-loop="' . esc_attr($loop_slide) . '"';
$data_attrs[] = 'data-slides-all="' . esc_attr($auto_slide) . '"';
$data_attrs[] = 'data-switch-tablet="' . nasa_switch_tablet() . '"';
$data_attrs[] = 'data-switch-desktop="' . nasa_switch_desktop() . '"';

if ($columns_number_small == '1.5') :
    $data_attrs[] = 'data-padding-small="20%"';
endif;

$attrs_str = !empty($data_attrs) ? ' ' . implode(' ', $data_attrs) : '';
?>

<?php if (isset($title) && $title != '') : ?>
    <div class="nasa-title nasa-m">
        <h3 class="nasa-heading-title margin-bottom-5">
            <?php echo esc_attr($title); ?>
        </h3>
    </div>
<?php endif; ?>

<div class="nasa-relative nasa-slider-wrap nasa-slide-style-product-deal nasa-slide-special-product-deal padding-top-10">
    <div class="<?php echo esc_attr($class_slide); ?>"<?php echo $attrs_str; ?>>
    <?php
    while ($specials->have_posts()) :
        $specials->the_post();
        
        global $product;
        if (empty($product) || !$product->is_visible()) :
            continue;
        endif;

        $product_error = false;
        $productId = $product->get_id();
        $productType = $product->get_type();
        $postId = $productType == 'variation' ? wp_get_post_parent_id($productId) : $productId;
        if (!$postId) :
            $product_error = true;
        endif;

        $stock_available = false;
        if (isset($statistic) && $statistic == '1') :
            $manager_product = get_post_meta($postId, '_manage_stock', 'no');
            $real_id = $postId;
            if ($productType == 'variation') :
                $manager = get_post_meta($productId, '_manage_stock', 'no');

                if ($manager === 'yes') :
                    $manager_product = $manager;
                    $real_id = $productId;
                endif;
            endif;

            if ($manager_product === 'yes') :
                $total_sales = get_post_meta($real_id, 'total_sales', true);
                $stock_sold = $total_sales ? round($total_sales) : 0;

                $stock = get_post_meta($real_id, '_stock', true);
                $stock_available = $stock ? round($stock) : 0;

                $percentage = $stock_available > 0 ?
                    round($stock_sold/($stock_available + $stock_sold) * 100) : 0;
            endif;
        endif;

        $time_sale = get_post_meta($productId, '_sale_price_dates_to', true);

        $product_link = $product_error ? '#' : get_the_permalink();
        $product_name = get_the_title() . ($product_error ? esc_html__(' - Has been an error. You need to rebuild this product.', 'nasa-core') : '');
        ?>
        <div class="nasa-special-deal-item wow fadeInUp product-deals product-item<?php echo $nasa_animated_products ? ' ' . esc_attr($nasa_animated_products) : ''; ?>" data-wow-duration="1s" data-wow-delay="0ms">
            <div class="product-special-deals">
                <?php do_action('nasa_before_special_deal_simple_action'); ?>

                <div class="product-img-wrap">
                    <?php do_action('nasa_special_deal_simple_action'); ?>
                </div>

                <div class="product-deal-special-price price margin-top-20 margin-bottom-0">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <a class="product-deal-special-title margin-top-10 margin-bottom-0" href="<?php echo esc_url($product_link); ?>" title="<?php echo esc_attr($product_name); ?>">
                    <?php echo $product_name; ?>
                </a>

                <div class="product-deal-special-countdown text-center margin-top-15 margin-bottom-0">
                    <?php echo nasa_time_sale($time_sale, true, false); ?>
                </div>

                <?php if ($stock_available) : ?>
                    <div class="product-deal-special-progress margin-top-15 padding-left-10 padding-right-10">
                        <div class="deal-progress">
                            <span class="deal-progress-bar primary-bg" style="<?php echo esc_attr('width:' . $percentage . '%'); ?>"><?php echo $percentage; ?></span>
                        </div>

                        <div class="deal-stock-label text-center margin-top-10">
                            <span class="stock-sold">
                                <?php echo sprintf(__('Sold: %s', 'nasa-core'), '<strong>' . $stock_sold . ' / ' . ($stock_available + $stock_sold) . '</strong>'); ?>
                            </span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php do_action('nasa_after_special_deal_simple_action'); ?>
            </div>
        </div>
    <?php
    endwhile;
    wp_reset_postdata();
    ?>
    </div>
</div>
