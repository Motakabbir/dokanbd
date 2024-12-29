<?php
/**
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 1.6.4
 */
defined('ABSPATH') or exit;

/**
 * Before setup shop
 */
do_action('nasa_before_render_single_product');

global $nasa_opt;

$nasa_ajax = isset($nasa_opt['single_product_ajax']) && $nasa_opt['single_product_ajax'] ? true : false;
defined('NASA_AJAX_PRODUCT') or define('NASA_AJAX_PRODUCT', $nasa_ajax);

get_header('shop');
?>
<div class="product-page">
    <?php
    
    /**
     * woocommerce_before_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
     * @hooked woocommerce_breadcrumb - 20
     */
    do_action('woocommerce_before_main_content');
    
    while (have_posts()) :
        the_post();
        wc_get_template_part('content', 'single-product');
    endwhile;
    
    /**
     * woocommerce_after_main_content hook.
     *
     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
     */
    do_action('woocommerce_after_main_content');
    ?>
</div>
<?php
get_footer('shop');
