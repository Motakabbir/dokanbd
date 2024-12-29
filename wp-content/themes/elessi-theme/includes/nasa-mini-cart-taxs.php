<?php
defined('ABSPATH') || exit;

if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) :

    $taxable_address = WC()->customer->get_taxable_address();
    $estimated_text  = '';

    if (WC()->customer->is_customer_outside_base() && !WC()->customer->has_calculated_shipping()) :
        /* translators: %s location. */
        $estimated_text = sprintf(' <small>' . esc_html__('(estimated for %s)', 'elessi-theme') . '</small>', WC()->countries->estimated_for_prefix($taxable_address[0]) . WC()->countries->countries[$taxable_address[0]]);
    endif;

    if ('itemized' === get_option('woocommerce_tax_total_display')) :
        foreach (WC()->cart->get_tax_totals() as $code => $tax) : ?>
            <div class="tax-cart-wrap ext-item-wrap nasa-flex jbw">
                <span class="tax-label ext-item-label">
                    <?php echo esc_html($tax->label) . $estimated_text; ?>
                </span>

                <span class="tax-content ext-item-content">
                    <?php echo wp_kses_post($tax->formatted_amount); ?>
                </span>
            </div>
        <?php endforeach; ?>
    <?php else : ?>
        <div class="tax-cart-wrap ext-item-wrap nasa-flex jbw">
            <span class="tax-label ext-item-label">
                <?php echo esc_html(WC()->countries->tax_or_vat()) . $estimated_text; ?>
            </span>

            <span class="tax-content ext-item-cotnent">
                <?php wc_cart_totals_taxes_total_html(); ?>
            </span>
        </div>
    <?php
    endif;
endif;
