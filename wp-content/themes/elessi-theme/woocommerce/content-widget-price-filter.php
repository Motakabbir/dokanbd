<?php
/**
 * The template for displaying product price filter widget.
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 7.0.1
 */
defined('ABSPATH') || exit;

$nasa_min = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$nasa_max = isset($_GET['max_price']) ? $_GET['max_price'] : '';
$has_price = ($nasa_min !== '' && $nasa_max !== '' && ($nasa_min >= 0 || $nasa_max >= $nasa_min)) ? '1' : '0';
$class_reset = $has_price == '1' ? 'reset_price nasa-stclose' : 'reset_price nasa-stclose hidden-tag';
$hide_btn = isset($hide_btn) && $hide_btn ? true : false;
$nasa_widget = isset($nasa_widget) && $nasa_widget ? true : false;

do_action('woocommerce_widget_price_filter_start', $args);
?>

<form method="get" action="<?php echo esc_url($form_action); ?>">
    <div class="price_slider_wrapper">
        <div class="price_slider" style="display:none;"></div>
        
        <div class="price_slider_amount" data-step="<?php echo esc_attr($step); ?>">
            <input type="text" id="min_price" name="min_price" value="<?php echo esc_attr($current_min_price); ?>" data-min="<?php echo esc_attr($min_price); ?>" placeholder="<?php echo esc_attr__('Min price', 'elessi-theme'); ?>" />
            
            <input type="text" id="max_price" name="max_price" value="<?php echo esc_attr($current_max_price); ?>" data-max="<?php echo esc_attr($max_price); ?>" placeholder="<?php echo esc_attr__('Max price', 'elessi-theme'); ?>" />
            
            <?php if (!$hide_btn) :
                $class_btn = 'button small';
                $class_btn .= $nasa_widget ? ' nasa-filter-price-btn' : '';
                ?>
                <button type="submit" class="<?php echo esc_attr($class_btn); ?>">
                    <?php echo esc_html__('Filter', 'elessi-theme'); ?>
                </button>
            <?php endif; ?>
            
            <div class="price_label" style="display: none;">
                <?php echo esc_html__('Price:', 'elessi-theme'); ?> <span class="from"></span> &mdash; <span class="to"></span>
                <a href="javascript:void(0);" class="<?php echo esc_attr($class_reset); ?>" data-filtered="<?php echo $has_price ? '1' : '0'; ?>" rel="nofollow"><?php echo esc_html__('Reset', 'elessi-theme'); ?></a>
            </div>
            
            <?php echo wc_query_string_form_fields(null, array('min_price', 'max_price', 'paged'), '', true); ?>
            
            <?php /* input type="hidden" class="nasa_hasPrice" name="nasa_hasPrice" value="<?php echo esc_attr($has_price); ?>" / */?>
            <div class="clear"></div>
        </div>
    </div>
</form>

<?php
do_action('woocommerce_widget_price_filter_end', $args);
