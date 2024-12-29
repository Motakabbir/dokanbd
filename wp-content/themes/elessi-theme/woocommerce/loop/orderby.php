<?php
/**
 * Show options for ordering
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version     3.6.0
 */
if (!defined('ABSPATH')) :
    exit;
endif;

global $nasa_opt;
?>
<form class="woocommerce-ordering" method="get">
    <span class="sort-text margin-right-5 rtl-margin-right-0 rtl-margin-left-5"><?php esc_html_e('Sort by', 'elessi-theme'); ?></span>
    
    <select name="orderby" class="orderby" aria-label="<?php esc_attr_e('Shop order', 'elessi-theme'); ?>">
        <?php foreach ($catalog_orderby_options as $id => $name) : ?>
            <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
        <?php endforeach; ?>
    </select>
    
    <?php if (!isset($nasa_opt['nasa_in_mobile']) || !$nasa_opt['nasa_in_mobile']) : ?>
        <div class="nasa-ordering"><?php esc_html_e('...', 'elessi-theme'); ?></div>
    <?php endif; ?>
    
    <input type="hidden" name="paged" value="1" />
    <?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
</form>
