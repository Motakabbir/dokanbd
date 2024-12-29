<?php
$link_main = $product->get_permalink();
$class_title = 'name nasa-bold';
$class_title .= (!isset($nasa_opt['cutting_product_name']) || $nasa_opt['cutting_product_name'] == '1') ? ' nasa-show-one-line' : '';
$_delay = 0;
$_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
$total_price = (float) $product->get_price();
$total_items = count($accessories) + 1;
$accessories_wrap_class = 'nasa-modern-5';

if ((isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] == 'modern-8')) :
    $accessories_wrap_class = 'nasa-modern-8';
endif;
?>

<div class="row nasa-relative nasa-bought-together-wrap">
    <div class="large-12 columns hidden-tag nasa-message-error"></div>
    
    <div class="large-8 columns rtl-right">
        <div class="nasa-accessories-wrap <?php echo $accessories_wrap_class; ?> row nasa-flex flex-wrap align-start">
            <!-- Current product -->
            <div class="nasa-large-5-col-1 small-6 medium-4 columns nasa-current-product nasa-accessories-product wow fadeInUp grid nasa-accessories-<?php echo (int) $product->get_id(); ?> rtl-right" data-product-id="<?php echo (int) $product->get_id(); ?>" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($_delay); ?>ms" data-wow="fadeInUp">
                <?php                     
                // Product Item -->
                wc_get_template('content-product.php', array(
                    '_delay' => $_delay,
                    'wrapper' => 'div'
                ));
                // End Product Item -->
                ?>
            </div>

            <!-- Accessories of the Current Product -->
            <?php
            $call_ajax = defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT ? ' nasa-ajax-call' : '';
            
            $_delay += $_delay_item;
            foreach ($accessories as $acc) :
                if (empty($acc) || !$acc->is_visible() || $acc->get_price() == '') :
                    $total_items = $total_items - 1;
                    continue;
                endif;
                
                $product_id = $acc->get_id();
                $price_html = $acc->get_price_html();
                ?>
                <svg class="ns-accessories-add-svg" width="18" height="18" stroke-width="2" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                
                <div class="nasa-large-5-col-1 small-6 medium-4 columns nasa-accessories-product wow fadeInUp grid nasa-flex nasa-accessories-<?php echo (int) $product_id; ?> rtl-right" data-product-id="<?php echo (int) $product_id; ?>" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($_delay); ?>ms" data-wow="fadeInUp">
                    <?php
                    $post_object = get_post($product_id);
                    setup_postdata($GLOBALS['post'] = & $post_object);

                    // Product Item -->
                    wc_get_template('content-product.php', array(
                        '_delay' => $_delay,
                        'wrapper' => 'div'
                    ));
                    // End Product Item -->
                    ?>
                </div>
                
                <?php
                $total_price += (float) $acc->get_price();
                $_delay += $_delay_item;
            endforeach;
            ?>
        </div>
    </div>
    
    <div class="large-4 columns mobile-margin-bottom-20 rtl-left text-right rtl-text-left mobile-text-left rtl-mobile-text-right nasa-accessories-total-price-wrap" data-price="<?php echo($total_price); ?>">
        <div class="nasa-flex align-start flex-column nasa-accessories-total-price-bg">
            <div class="nasa-accessories-check nasa-block nasa-relative">
                <?php
                $price = $product->get_price();
                $suffix = get_option('woocommerce_price_display_suffix', '');
                $suffix = $suffix !== '' ? ' <small class="woocommerce-price-suffix">' . wp_kses_post($suffix) . '</small>' : '';
                $regular_price = $product->get_type() == 'simple'? $regular_price = (float) $product->get_regular_price() : 0;
                $min_sale_price_for_display = $product->get_type() !== 'simple'? (float) $product->get_variation_sale_price('min', true) : 0;
                ?>
                <span class="nasa-flex nasa-accessories-item-check nasa-accessories-item-check-main">
                    <input type="checkbox" value="<?php echo (int) $product->get_id(); ?>" checked disabled class="nasa-check-main-product inline-block" id="product-accessories-<?php echo (int) $product->get_id(); ?>" data-display_price="<?php echo esc_attr($price); ?>" data-display_regular_price="<?php echo esc_attr($regular_price); ?>" data-min_sale_price_for_display="<?php echo esc_attr($min_sale_price_for_display); ?>" />&nbsp;&nbsp;
                    <label class="inline-block" for="product-accessories-<?php echo (int) $product->get_id(); ?>" data_product_name="<?php echo $product->get_name();?>">
                        <?php
                        echo '<strong>' . esc_html__('This product: ', 'nasa-core') . '</strong>' . $product->get_name();
                        echo '&nbsp;&nbsp;<span class="nasa-accessories-price price">(' . wc_price($price) . $suffix . ')</span>';
                        ?>
                    </label>
                </span>
                
                <?php foreach ($accessories as $acc) :
                    if (empty($acc) || !$acc->is_visible() || $acc->get_price() == '') :
                        continue;
                    endif;
                    
                    $price = $acc->get_price();
                    $regular_price = $acc->get_type() == 'simple'? $regular_price = (float) $acc->get_regular_price() : 0;
                    $min_sale_price_for_display = $acc->get_type() !== 'simple'? (float) $acc->get_variation_sale_price('min', true) : 0;
                    ?>
                    <span class="nasa-flex nasa-accessories-item-check">
                        <input type="checkbox" value="<?php echo (int) $acc->get_id(); ?>" checked class="nasa-check-accessories-product inline-block" id="product-accessories-<?php echo (int) $acc->get_id(); ?>" data-display_price="<?php echo esc_attr($price); ?>" data-display_regular_price="<?php echo esc_attr($regular_price); ?>" data-min_sale_price_for_display="<?php echo esc_attr($min_sale_price_for_display); ?>" />&nbsp;&nbsp;
                        <label class="inline-block" for="product-accessories-<?php echo (int) $acc->get_id(); ?>" data_product_name="<?php echo $acc->get_name();?>">
                            <?php
                            echo $acc->get_name();
                            echo '&nbsp;&nbsp;<span class="nasa-accessories-price price">(' . wc_price($acc->get_price()) . $suffix . ')</span>';
                            ?>
                        </label>
                    </span>
                <?php endforeach; ?>
            </div>
            <div class="nasa-accessories-total-price nasa-flex align-baseline">
                <?php echo esc_html__('Total:&nbsp;', 'nasa-core') . '<span class="price"><ins>' . wc_price($total_price) . $suffix . '</ins></span>'; ?>
            </div>
            
            <?php if (!isset($nasa_opt['disable-cart']) || !$nasa_opt['disable-cart']) : ?>
                <div class="nasa-accessories-add-to-cart margin-top-15">
                    <a href="javascript:void(0)" rel="nofollow" class="add_to_cart_accessories button" data_text_alert ="<?php echo esc_attr__('Please complete your selection - Product ${productName} has not been selected', 'nasa-core'); ?>" title="<?php echo esc_attr__('Add selected to cart', 'nasa-core'); ?>"><?php echo sprintf(esc_html__('Add selected to cart (%s)', 'nasa-core'), $total_items); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
wp_reset_postdata();
