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
$class_slide .= $arrows == 1 ? ' nasa-slick-nav nasa-nav-radius' : '';

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

$class_title_wrap = 'nasa-flex flex-wrap margin-bottom-15';
$class_title_wrap .= $title_align == '1' ? ' jc' : '';

$class_name = 'product-deal-special-title nasa-block text-center';
$class_name .= (!isset($nasa_opt['cutting_product_name']) || $nasa_opt['cutting_product_name']) ? ' nasa-show-one-line' : '';
?>

<div class="<?php echo esc_attr($class_title_wrap); ?>">
    <?php if (isset($title) && $title != '') : ?>
    <div class="nasa-title nasa-l margin-right-20 rtl-margin-right-0 rtl-margin-left-20">
        <h3 class="nasa-heading-title margin-top-0 margin-bottom-0">
            <?php echo esc_attr($title); ?>
        </h3>
    </div>
    <?php endif; ?>

    <div class="nasa-sc-pdeal-countdown for-time-2 primary-bg nasa-flex align-baseline margin-top-10 margin-bottom-10 nasa-crazy-box">
        <strong><?php echo esc_html__('Ends in:', 'nasa-core'); ?></strong>
        <?php echo nasa_time_sale($deal_time, false, false); ?>
    </div>
    
    <?php if ($desc_shortcode) :
        $class_desc_wrap = 'nasa-desc nasa-block nasa-fullwidth margin-bottom-10';
        $class_desc_wrap .= $title_align == '1' ? ' text-center' : '';
        ?>
        <p class="<?php echo esc_attr($class_desc_wrap); ?>">
            <?php echo $desc_shortcode; ?>
        </p>
    <?php endif; ?>
</div>

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

        $product_link = $product_error ? '#' : get_the_permalink();
        $product_name = get_the_title() . ($product_error ? esc_html__(' - Has been an error. You need to rebuild this product.', 'nasa-core') : '');
        ?>
        <div class="nasa-special-deal-item for-time-2 wow fadeInUp product-deals product-item<?php echo $nasa_animated_products ? ' ' . esc_attr($nasa_animated_products) : ''; ?>" data-wow-duration="1s" data-wow-delay="0ms">
            <div class="product-special-deals">
                <?php do_action('nasa_before_special_deal_simple_action'); ?>

                <!-- Images -->
                <div class="product-img-wrap margin-bottom-20">
                    <?php do_action('nasa_special_deal_simple_action'); ?>
                </div>

                <!-- Price -->
                <div class="product-deal-special-price price text-center margin-bottom-0 margin-top-5">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <!-- Product Name -->
                <a class="<?php echo esc_attr($class_name); ?> margin-bottom-0 margin-top-5" href="<?php echo esc_url($product_link); ?>" title="<?php echo esc_attr($product_name); ?>">
                    <?php echo $product_name; ?>
                </a>

                <?php if ($stock_available) : ?>
                    <!-- Stock Available -->
                    <div class="product-deal-special-progress margin-top-15">
                        <div class="deal-progress mini margin-bottom-10">
                            <span class="deal-progress-bar primary-bg" style="<?php echo esc_attr('width:' . $percentage . '%'); ?>"><?php echo $percentage; ?></span>
                        </div>

                        <div class="deal-stock-label mini">
                            <span class="stock-sold text-left"><?php echo esc_html__('Already Sold:', 'nasa-core');?> <strong class="primary-color"><?php echo esc_html($stock_sold); ?></strong></span>
                            <span class="stock-available text-right"><?php echo esc_html__('Available:', 'nasa-core');?> <strong><?php echo esc_html($stock_available); ?></strong></span>
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
