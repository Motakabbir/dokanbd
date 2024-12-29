<?php
/**
 * External product add to cart
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 7.0.1
 */
defined('ABSPATH') || exit;

do_action('woocommerce_before_add_to_cart_form');
?>

<form class="cart" action="<?php echo esc_url($product_url); ?>" method="get">
    <?php do_action('woocommerce_before_add_to_cart_button'); ?>

    <button type="submit" class="ns-single-add-btn single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '' ); ?>"><?php echo esc_html($button_text); ?></button>

    <?php wc_query_string_form_fields($product_url); ?>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>
</form>

<?php
do_action('woocommerce_after_add_to_cart_form');
