<?php
/**
 * Single Product Meta
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 3.0.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $product;

?>
<div class="product_meta">

    <?php do_action('woocommerce_product_meta_start'); ?>
    
    <?php if (wc_product_sku_enabled()) :
        $sku = $product->get_sku();
        
        if ($sku || $product->is_type('variable')) : ?>
            <span class="sku_wrapper">
                <strong><?php esc_html_e('SKU:', 'elessi-theme'); ?></strong> <span class="sku"><?php echo $sku ? $sku : esc_html__('N/A', 'elessi-theme'); ?></span>
            </span>
        <?php endif; ?>
    <?php endif; ?>

    <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="posted_in">' . _n('<strong>Category:</strong>', '<strong>Categories:</strong>', count($product->get_category_ids()), 'elessi-theme') . '&nbsp;', '</span>'); ?>

    <?php echo wc_get_product_tag_list($product->get_id(), ', ', '<span class="tagged_as">' . _n('<strong>Tag:</strong>', '<strong>Tags:</strong>', count($product->get_tag_ids()), 'elessi-theme') . '&nbsp;', '</span>'); ?>

    <?php do_action('woocommerce_product_meta_end'); ?>

</div>
