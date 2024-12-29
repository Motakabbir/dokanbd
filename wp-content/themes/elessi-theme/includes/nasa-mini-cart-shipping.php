<?php

defined('ABSPATH') || exit;

/**
 * Calculate Shipping
 */
WC()->cart->calculate_shipping();
WC()->cart->calculate_totals();

/**
 * Get Packages
 */
$packages = WC()->shipping()->get_packages();

foreach ($packages as $i => $package) :
    $chosen_method = isset(WC()->session->chosen_shipping_methods[$i]) ? WC()->session->chosen_shipping_methods[$i] : '';
    
    $available_methods = isset($package['rates']) ? $package['rates'] : null;
    
    if ($available_methods) :
        $index = $i;
        ?>
        <div class="shipping-wrap ext-item-wrap nasa-flex jbw">
            <span class="shipping-label ext-item-label">
                <?php echo esc_html__('Shipping', 'elessi-theme'); ?>
            </span>

            <span class="shipping-content ext-item-content">
                <?php foreach ($available_methods as $method) :
                    if ($chosen_method == '') :
                        printf('<span data-for="shipping_method_%1$s_%2$s">%3$s</span>', $index, esc_attr(sanitize_title($method->id)), wc_cart_totals_shipping_method_label($method)); // WPCS: XSS ok.

                        do_action('woocommerce_after_shipping_rate', $method, $index);

                        break;
                    else :
                        if ($method->id !== $chosen_method) :
                            continue;
                        endif;

                        printf('<span data-for="shipping_method_%1$s_%2$s">%3$s</span>', $index, esc_attr(sanitize_title($method->id)), wc_cart_totals_shipping_method_label($method)); // WPCS: XSS ok.

                        do_action('woocommerce_after_shipping_rate', $method, $index);

                        break;
                    endif;
                endforeach; ?>
            </span>
        </div>
    <?php
    endif;
endforeach;
