<?php defined('ABSPATH') || exit; ?>

<div class="total-cart-wrap nasa-flex jbw">
    <span class="total-price-label2">
        <?php echo esc_html__('Total', 'elessi-theme'); ?>
    </span>
    
    <span class="total-price-2">
        <?php wc_cart_totals_order_total_html(); ?>
    </span>
</div>
