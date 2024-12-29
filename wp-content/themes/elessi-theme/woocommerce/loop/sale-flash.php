<?php
/**
 * Product loop sale flash
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 1.6.4
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $nasa_opt, $post, $product;

if (!$product) :
    return;
endif;

$badges = '';

/**
 * Featured
 */
if (isset($nasa_opt['featured_badge']) && $nasa_opt['featured_badge'] && $product->is_featured()) :
    $badges .= '<span class="badge featured-label">' . esc_html__('Featured', 'elessi-theme') . '</span>';
endif;

/**
 * New
 */
if (isset($nasa_opt['at_badge_new']) && $nasa_opt['at_badge_new']) :
    $product_id = $product->get_type() == 'variation' ? $product->get_parent_id() : $product->get_id();
    
    $published_on = get_the_date('Y-m-d', $product_id);
    $current_date = strtotime(date('Y-m-d'));
    $target_date = strtotime($published_on);
    $diff_days = abs(floor(($target_date - $current_date) / (60 * 60 * 24)));
    
    $max_time = isset($nasa_opt['max_ns_time_at_badge_new']) && (int) $nasa_opt['max_ns_time_at_badge_new'] ? (int) $nasa_opt['max_ns_time_at_badge_new'] : 10;

    $badges .= $diff_days <= $max_time ? '<span class="badge new-label">' . esc_html__('New', 'elessi-theme') . '</span>' : '';
endif;

/**
 * On Sale Badge
 */
if ($product->is_on_sale()) :
    $badges_sale = '';
    
    if ($product->get_type() == 'variable') :
        $badges_sale = '<span class="badge sale-label sale-variable">' . esc_html__('Sale', 'elessi-theme') . '</span>';
    else :
        $maximumper = 0;
        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();
        
        if (is_numeric($sale_price)) :
            $percentage = $regular_price ? round(((($regular_price - $sale_price) / $regular_price) * 100), 0) : 0;
            
            if ($percentage > $maximumper) :
                $maximumper = $percentage;
            endif;

            $badges_sale = '<span class="badge sale-label">' . sprintf(esc_html__('&#45;%s&#37;', 'elessi-theme'), $maximumper) . '</span>';
        endif;
    endif;

    /**
     * Hook onsale WooCommerce
     */
    $badges .= apply_filters('woocommerce_sale_flash', $badges_sale, $post, $product);

    /**
     * Style show with Deal product
     */
    $badges .= '<span class="badge deal-label">' . esc_html__('Limited', 'elessi-theme') . '</span>';
endif;

/**
 * Out of stock
 */
if ("outofstock" === $product->get_stock_status()):
    $badges .= elessi_badge_outofstock();
endif;

/**
 * Backorders - Allowed
 */
if (isset($nasa_opt['backorder_badge']) && $nasa_opt['backorder_badge'] && $product->backorders_allowed()) :
    $badges .= '<span class="badge backorders-label">' . esc_html__('Backorders', 'elessi-theme') . '</span>';
endif;

/**
 * Hook to Badges
 */
$badges_content = apply_filters('nasa_badges', $badges);

if ('' !== $badges_content) :
    echo '<div class="nasa-badges-wrap">' . $badges_content . '</div>';
endif;
