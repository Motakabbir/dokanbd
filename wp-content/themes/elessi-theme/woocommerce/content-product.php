<?php
/**
 *
 * The template for displaying product content within loops
 *
 * 
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 3.6.0
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $product, $nasa_opt;

if (empty($product) || !$product->is_visible()) :
    return;
endif;

$show_in_list = isset($show_in_list) ? $show_in_list : true;
if (!isset($_delay)) :
    $_delay = 0;
endif;

/**
 * Show Short Description info
 */
$description_info = isset($description_info) ? $description_info : true;

/**
 * Set Before - After product
 */
$before_product = '';
$after_product = '';

if ((!isset($wrapper) || $wrapper == 'li')) :
    $wrap_item_class = 'product-warp-item';
    $wrap_item_class .= isset($wrapper_class) && $wrapper_class ? ' ' . $wrapper_class : '';
    
    $before_product = '<li class="' . esc_attr($wrap_item_class) . '">';
    $after_product = '</li>';
endif;

/**
 * Attributes content product
 */
$attrs_content = (isset($nasa_opt['transition_load']) && $nasa_opt['transition_load'] == 'wow') ? ' data-wow="fadeInUp" data-wow-duration="1s" data-wow-delay="' . esc_attr($_delay) . 'ms"' : '';

echo $before_product;
?>

<div <?php wc_product_class('', $product); ?><?php echo $attrs_content; ?>>

    <?php do_action('woocommerce_before_shop_loop_item'); ?>

    <div class="product-img-wrap">
        <?php do_action('woocommerce_before_shop_loop_item_title'); ?>
    </div>

    <div class="<?php echo esc_attr(apply_filters('ns_product_info_wrap_classes', 'product-info-wrap info')); ?>">
        <?php do_action('woocommerce_shop_loop_item_title'); ?>
        <?php do_action('woocommerce_after_shop_loop_item_title', $description_info); ?>
    </div>

    <?php do_action('woocommerce_after_shop_loop_item', $show_in_list); ?>

</div>

<?php
echo $after_product;
