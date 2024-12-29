<?php
/**
 * Checkout Payment Section
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 8.1.0
 */
defined('ABSPATH') || exit;

if (!wp_doing_ajax()) :
    do_action('woocommerce_review_order_before_payment');
endif;
?>

<div id="payment" class="woocommerce-checkout-payment">
    <?php if (WC()->cart->needs_payment()) : ?>
        <ul class="wc_payment_methods payment_methods methods">
            <?php
            if (!empty($available_gateways)) :
                foreach ($available_gateways as $gateway) :
                    wc_get_template('checkout/payment-method.php', array('gateway' => $gateway));
                endforeach;
            else :
                echo '<li>';
                wc_print_notice(apply_filters('woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__('Sorry, it seems that there are no available payment methods. Please contact us if you require assistance or wish to make alternate arrangements.', 'elessi-theme') : esc_html__('Please fill in your details above to see available payment methods.', 'elessi-theme') ), 'notice'); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment
                echo '</li>';
            endif;
            ?>
        </ul>
    <?php endif; ?>

    <?php
    /**
     * Custom Hook for - Add our Recommend Products to your Order
     */
    do_action('ns_before_place_order_payment'); ?>

    <div class="form-row place-order">
        <noscript>
        <?php
        /* translators: $1 and $2 opening and closing emphasis tags respectively */
        printf(esc_html__('Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'elessi-theme'), '<em>', '</em>');
        ?>
        <br /><button type="submit" class="button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e('Update totals', 'elessi-theme'); ?>"><?php esc_html_e('Update totals', 'elessi-theme'); ?></button>
        </noscript>

        <?php wc_get_template('checkout/terms.php'); ?>

        <?php do_action('woocommerce_review_order_before_submit'); ?>

        <?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="button alt' . esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : '') . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr($order_button_text) . '" data-value="' . esc_attr($order_button_text) . '">' . esc_html($order_button_text) . '</button>'); // @codingStandardsIgnoreLine  ?>

        <?php do_action('woocommerce_review_order_after_submit'); ?>

        <?php wp_nonce_field('woocommerce-process_checkout', 'woocommerce-process-checkout-nonce'); ?>
    </div>
</div>
<?php
if (!wp_doing_ajax()) :
    do_action('woocommerce_review_order_after_payment');
endif;
