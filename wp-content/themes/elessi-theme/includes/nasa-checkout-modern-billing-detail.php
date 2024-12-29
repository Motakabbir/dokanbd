<?php
/**
 * Checkout Billing detail: Layout - Modern
 * Case: Shipping First
 */
if (!defined('ABSPATH')) :
    exit;
endif;
?>

<div class="checkout-group margin-bottom-30 clearfix" id="nasa-billing-detail-wrap">
    <h3 class="nasa-box-heading billing-detail-method-step padding-top-0 padding-bottom-0 margin-bottom-10">
        <?php echo esc_html__('Billing address', 'elessi-theme'); ?>
    </h3>
    <p class="nasa-box-desc billing-detail-method-step">
        <?php echo esc_html__('Select the address that matches your card or payment method.', 'elessi-theme'); ?>
    </p>
    
    <div class="ns-billing-select clearfix">
        <div class="ns-same-shipping ns-billing-select-item">
            <div class="nasa-flex ns-input-wrap">
                <input type="radio" name="ns-billing-select" id="ns-billing-same" value="same" class="input-radio" checked />
                <label for="ns-billing-same">
                    <?php echo esc_html__('Same as shipping address', 'elessi-theme'); ?>
                </label>
            </div>
        </div>
        
        <div class="ns-different-shipping ns-billing-select-item">
            <div class="nasa-flex ns-input-wrap">
                <input type="radio" name="ns-billing-select" id="ns-billing-different" value="different" class="input-radio" />
                <label for="ns-billing-different">
                    <?php echo esc_html__('Use a different billing address', 'elessi-theme'); ?>
                </label>
            </div>
            
            <div class="woocommerce-billing-fields"></div>
        </div>
    </div>
</div>
