<?php
/**
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 3.5.5
 */
if (!defined('ABSPATH')) {
    exit;
}

global $product, $nasa_opt;

if (!is_a($product, 'WC_Product')) {
    return;
}

$productId = $product->get_id();
$product_type = $product->get_type();
$link = $product->get_permalink();
$title = $product->get_name();
$show_rating = isset($show_rating) ? $show_rating : true;
$animation = !isset($animation) ? true : $animation;

$class = 'item-product-widget';
$class .= $animation ? ' wow fadeInUp' : '';
$class_img = 'nasa-item-img';
$class_info = 'nasa-item-meta margin-left-20 rtl-margin-left-0 rtl-margin-right-20';

$list_type = isset($list_type) ? $list_type : '1';
$image_size = 'thumbnail';

switch ($list_type) :
    case 'list_main':
        $class .= ' nasa-list-type-main';
        $image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
        break;
    
    case 'list_extra' :
        $class .= ' nasa-list-type-extra';
        break;
    
    default:
        $list_type = '1';
        break;
endswitch;

if (!isset($delay)){
    global $delay;
    $_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
    $delay = !$delay ? 0 : $delay;
    $delay += $_delay_item;
}

$attributes = array(
    'data-wow-duration="1s"',
    'data-wow-delay="' . ((int) $delay) . 'ms"'
);

$class_warp = isset($class_column) ? ' ' . $class_column : '';
$wapper = (isset($wapper) && $wapper == 'div') ? 'div' : 'li';

$start_wapper = ($wapper == 'div') ? '<div class="' . esc_attr($class) . '" ' . implode(' ', $attributes) . '>' : '<li class="' . esc_attr($class) . '" ' . implode(' ', $attributes) . '>';

$end_warp = '</' . $wapper . '>';

echo $start_wapper;
do_action('woocommerce_widget_product_item_start', $args);
?>

<div class="<?php echo esc_attr($class_img); ?>">
    <a class="nasa-widget-img" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>">
        <?php echo $product->get_image($image_size); ?>
    </a>
    
    <?php if (!isset($nasa_opt['disable-quickview']) || !$nasa_opt['disable-quickview']) : ?>
        <a href="javascript:void(0);" class="quick-view btn-link quick-view-icon" data-prod="<?php echo esc_attr($productId); ?>" data-product_type="<?php echo esc_attr($product_type); ?>" title="<?php echo $product_type !== 'woosb' ? esc_attr__('Quick View', 'elessi-theme') : esc_attr__('View', 'elessi-theme'); ?>" data-href="<?php echo esc_url($link); ?>" rel="nofollow">
            <svg fill="currentColor" width="18" height="18" viewBox="0 0 32 32">
                <path d="M11.202 4.271v-1.066h-7.997v7.997h1.066v-6.177l7.588 7.588 0.754-0.754-7.588-7.588z"/>
                <path d="M20.798 3.205v1.066h6.177l-7.588 7.588 0.754 0.754 7.588-7.588v6.177h1.066v-7.997z"/>
                <path d="M11.859 19.387l-7.588 7.588v-6.177h-1.066v7.997h7.997v-1.066h-6.177l7.588-7.588z"/>
                <path d="M27.729 26.975l-7.588-7.588-0.754 0.754 7.588 7.588h-6.177v1.066h7.997v-7.997h-1.066z"/>
            </svg>
        </a>
    <?php endif; ?>
</div>

<div class="<?php echo esc_attr($class_info); ?>">
    <a class="product-title nasa-widget-title nasa-bold" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>">
        <?php echo $title; ?>
    </a>

    <?php echo $show_rating ? wp_kses_post(wc_get_rating_html($product->get_average_rating())) : ''; ?>

    <span class="price">
        <?php echo $product->get_price_html(); ?>
    </span>
</div>

<?php
do_action('woocommerce_widget_product_item_end', $args);

echo $end_warp;
