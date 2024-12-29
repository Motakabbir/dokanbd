<?php
defined('ABSPATH') || exit;

/**
 * Publish Coupons
 */
$publish_couponts = elessi_wc_publish_coupons();

if (!empty($publish_couponts)) : ?>
    <p class="node-title nasa-bold fs-20 mobile-fs-18">
        <?php echo esc_html__('Select an available coupon', 'elessi-theme'); ?>
    </p>

    <div class="publish-coupons nasa-flex flex-column">
        <?php foreach ($publish_couponts as $coupon) :
            $code = $coupon->get_code();
            $amount = $coupon->get_amount();
            $discount_type = $coupon->get_discount_type();
            $discount_lbl = '';
            
            if ($discount_type == 'fixed_cart') :
                $discount_lbl = sprintf(esc_html__('%s&nbsp;Discount', 'elessi-theme'), wc_price($amount));
            endif;
            
            if ($discount_type == 'percent') :
                $discount_lbl = sprintf(esc_html__('%s&nbsp;Discount', 'elessi-theme'), $amount . '%');
            endif;
            
            if ($discount_type == 'fixed_product') :
                $discount_lbl = sprintf(esc_html__('%s&nbsp;Product Discount', 'elessi-theme'), wc_price($amount));
            endif;
            
            $date_expires = $coupon->get_date_expires();
            $date_expires_lbl = !$date_expires ? esc_html__('Never expire', 'elessi-theme') : get_date_from_gmt(date('Y-m-d H:i:s', strtotime($date_expires)), apply_filters('nasa_coupon_date_axpire_format', 'F j, Y'));
            
            $desc = $coupon->get_description();
            
            $min_amout = $coupon->get_minimum_amount();
            $min_amout_lbl = $min_amout ? sprintf(esc_html__('The minimum spend for this coupon is&nbsp;%s', 'elessi-theme'), wc_price($min_amout)) : '';
            
            $max_amout = $coupon->get_maximum_amount();
            $max_amout_lbl = $max_amout ? sprintf(esc_html__('The maximum spend for this coupon is&nbsp;%s', 'elessi-theme'), wc_price($max_amout)) : '';
            ?>
            <a href="javascript:void(0);" data-code="<?php echo esc_attr($code); ?>" class="publish-coupon fs-15" title="<?php echo esc_attr__('Click here to Apply this coupon.', 'elessi-theme'); ?>">
                <span class="discount-info fs-16 nasa-flex nasa-fullwidth nasa-bold"><?php echo $discount_lbl; ?></span>
                
                <span class="discount-code nasa-flex nasa-fullwidth flex-wrap">
                    <span class="nasa-bold nasa-uppercase margin-right-10 rtl-margin-right-0 rtl-margin-left-10"><?php echo $code; ?></span>
                    <span class="discount-exp"><?php echo $date_expires_lbl; ?></span>
                </span>
                
                <?php echo $desc ? '<span class="discount-desc nasa-flex nasa-fullwidth">' . $desc . '</span>' : ''; ?>
                <?php echo $min_amout_lbl ? '<span class="discount-min nasa-flex nasa-fullwidth">' . $min_amout_lbl . '</span>' : ''; ?>
                <?php echo $max_amout_lbl ? '<span class="discount-max nasa-flex nasa-fullwidth">' . $max_amout_lbl . '</span>' : ''; ?>
            </a>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<p class="node-title nasa-bold ns-coupon-ask fs-20 mobile-fs-18">
    <?php echo esc_html__('Have a coupon code?', 'elessi-theme'); ?>
</p>

<div class="coupon-btns nasa-flex flex-column">
    <input type="text" name="coupon_code" class="input-text nasa-uppercase nasa-bold" id="mini-cart-add-coupon_code" value="" />
    <button type="submit" class="button nasa-fullwidth margin-top-10" name="mini-cart-apply_coupon" value="<?php echo esc_attr__('Apply coupon', 'elessi-theme'); ?>" id="mini-cart-apply_coupon">
        <?php echo esc_html__('Apply', 'elessi-theme'); ?>
    </button>
</div>
