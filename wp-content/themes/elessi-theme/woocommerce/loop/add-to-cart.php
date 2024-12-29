<?php

/**
 * Loop Add to Cart
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 9.2.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $product;

$aria_describedby = isset($args['aria-describedby_text']) ? sprintf('aria-describedby="woocommerce_loop_add_to_cart_link_describedby_%s"', esc_attr($product->get_id())) : '';

$class = isset($args['class']) ? $args['class'] : 'add-to-cart-grid btn-link nasa-tip';
$class = isset($args['modern-8-add']) && $args['modern-8-add'] == 1 ? str_replace("nasa-quick-add", "nasa-modern-8-add", $class) : $class;
echo apply_filters(
    'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
    sprintf(
        '<a href="%s" %s data-quantity="%s" class="%s" %s>' .
            '<span class="add_to_cart_text">%s</span>' .
            '%s' .
        '</a>',
        esc_url($product->add_to_cart_url()),
        $aria_describedby,
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr($class),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        esc_html($product->add_to_cart_text()),
        isset($args['icon_cart']) && $args['icon_cart'] ? '<span class="nasa-icon cart-icon nasa-flex jc">' . $args['icon_cart'] . '</span>' : '<span class="nasa-icon cart-icon nasa-flex jc"><svg width="17" height="17" viewBox="0 0 24 24" stroke-width="2" fill="currentColor"><path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/><path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/></svg></span>'
    ),
    $product,
    $args
);
