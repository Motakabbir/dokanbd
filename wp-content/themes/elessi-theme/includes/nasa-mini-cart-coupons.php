<?php
defined('ABSPATH') || exit;

$coupons = WC()->cart->get_coupons();

if ($coupons) :
    foreach ($coupons as $code => $coupon) : ?>
        <div class="coupon-wrap ext-item-wrap nasa-flex jbw" data-code="<?php echo esc_attr($coupon->get_code()); ?>">
            <span class="coupon-label ext-item-label">
                <?php wc_cart_totals_coupon_label($coupon); ?>
            </span>

            <span class="coupon-content ext-item-content">
                <?php wc_cart_totals_coupon_html($coupon); ?>
            </span>
        </div>
    <?php
    endforeach;
endif;
