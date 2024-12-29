<?php

/**
 * Displayed when no products are found matching the current query
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 7.8.0
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

?>
<div class="woocommerce-info woocommerce-no-products-found">    
    <img src="<?php echo apply_filters('nasa_no_products_found_src', ELESSI_THEME_URI.'/assets/images/not-found-dark-icon.png'); ?>" alt="<?php esc_attr_e('Not Found Products', 'elessi-theme'); ?>" class="not-found-img" width="100" height="115" />
    
    <?php esc_html_e('No products were found matching your selection.', 'elessi-theme'); ?>
</div>
