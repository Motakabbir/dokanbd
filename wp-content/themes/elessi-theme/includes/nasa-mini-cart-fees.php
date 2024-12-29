<?php
defined('ABSPATH') || exit;

$fees = WC()->cart->get_fees();

if ($fees) :
    foreach ($fees as $fee) : ?>
        <div class="fees-cart-wrap ext-item-wrap nasa-flex jbw">
            <span class="fees-label ext-item-label">
                <?php echo esc_html($fee->name); ?>
            </span>

            <span class="fees-content ext-item-content">
                <?php wc_cart_totals_fee_html($fee); ?>
            </span>
        </div>
    <?php
    endforeach;
endif;
