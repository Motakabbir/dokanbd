<?php
/**
 * Checkout Form: Layout - Modern
 */
if (!defined('ABSPATH')) :
    exit;
endif;

// If checkout registration is disabled and not logged in, the user cannot checkout
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !NASA_CORE_USER_LOGGED) :
    /**
     * Hook Login form
     */
    do_action('woocommerce_before_checkout_form', $checkout);
    
    echo apply_filters('woocommerce_checkout_must_be_logged_in_message', esc_html__('You must be logged in to checkout.', 'elessi-theme'));
    
    return;
endif;

// $need_shipping = 'no' === get_option('woocommerce_enable_shipping_calc') || !WC()->cart->needs_shipping() ? false : true;
$need_shipping = true === WC()->cart->needs_shipping() ? true : false;
?>

<!-- Checkout BG -->
<div class="checkout-modern-bg hide-for-mobile">
    <div class="checkout-modern-bg-left"></div>
    <div class="checkout-modern-bg-right"></div>
</div>

<div class="row">
    
    <!-- Checkout Wrap -->
    <div class="checkout-modern-wrap large-12 columns">
        
        <!-- Checkout Left -->
        <div class="checkout-modern-left-wrap">
            
            <!-- Checkout Breadcrumb -->
            <div class="nasa-bc-modern">
                <!--Back-->
                <a class="nasa-icon ns-check-out-back nasa-flex" href="javascript: history.go(-1);" title="Back" rel="nofollow">
                    <svg fill="currentColor" height="25" width="25" viewBox="0 0 32 32">
                        <path d="M 13.811 6.077 L 4.384 15.507 C 4.117 15.773 4.081 16.044 4.348 16.31 L 13.887 26.01 C 14.153 26.277 14.465 26.222 14.732 25.955 C 14.998 25.689 14.602 25.292 14.336 25.026 L 5.776 16.392 L 27.151 16.392 C 27.527 16.392 27.835 16.249 27.835 15.873 C 27.835 15.496 27.527 15.351 27.151 15.351 L 5.96 15.351 L 14.336 6.953 C 14.469 6.82 14.734 6.558 14.734 6.383 C 14.734 6.209 14.693 6.1 14.56 5.967 C 14.293 5.702 14.077 5.812 13.811 6.077 Z" />
                    </svg>
                </a>
                
                <!-- Checkout Logo -->
                <div class="mobile-text-center margin-bottom-30 mobile-margin-bottom-0">
                    <?php echo elessi_logo(); ?>
                </div>

                <div class="nasa-bc-modern-wrap">
                    <div class="nasa-iflex flex-nowrap">
                    <a class ="nasa-back_to_cart" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo esc_attr__('CART', 'elessi-theme'); ?>"><?php echo esc_html__('CART', 'elessi-theme'); ?></a>
                
                    <svg class="d-ltr" width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" /></svg>
                    
                    <a href="javascript:void(0);" title="<?php echo esc_attr__('INFORMATION', 'elessi-theme'); ?>" rel="nofollow" class="nasa-billing-step active"><?php echo esc_html__('INFORMATION', 'elessi-theme'); ?></a>
                    
                    <svg class="d-ltr" width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" /></svg>
                    
                    <?php if ($need_shipping) : ?>
                        <a href="javascript:void(0);" title="<?php echo esc_attr__('SHIPPING', 'elessi-theme'); ?>" rel="nofollow" class="nasa-shipping-step"><?php echo esc_html__('SHIPPING', 'elessi-theme'); ?></a>

                        <svg class="d-ltr" width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" /></svg>
                    <?php endif; ?>
                    
                    <a href="javascript:void(0);" title="<?php echo esc_attr__('PAYMENT', 'elessi-theme'); ?>" rel="nofollow" class="nasa-payment-step"><?php echo esc_html__('PAYMENT', 'elessi-theme'); ?></a>
                    </div>
                </div>
            </div>

            <!-- Checkout Mobile Your Order -->
            <a href="javascript:void(0);" class="hidden-tag your-order-mobile nasa-bold" rel="nofollow">
                <span class="your-order-title">
                    <svg class="nasa-icon margin-right-10 rtl-margin-right-0 rtl-margin-left-10" width="22" height="22" viewBox="0 0 25 32">
                        <path d="M6.294 14.164h12.588v1.049h-12.588v-1.049z" fill="currentColor" />
                        <path d="M6.294 18.36h12.588v1.049h-12.588v-1.049z" fill="currentColor" />
                        <path d="M6.294 22.557h8.392v1.049h-8.392v-1.049z" fill="currentColor" />
                        <path d="M15.688 3.674c-0.25-1.488-1.541-2.623-3.1-2.623s-2.85 1.135-3.1 2.623h-9.489v27.275h25.176v-27.275h-9.488zM10.49 6.082v-1.884c0-1.157 0.941-2.098 2.098-2.098s2.098 0.941 2.098 2.098v1.884l0.531 0.302c1.030 0.586 1.82 1.477 2.273 2.535h-9.803c0.453-1.058 1.243-1.949 2.273-2.535l0.53-0.302zM24.128 29.9h-23.078v-25.177h8.392v0.749c-1.638 0.932-2.824 2.566-3.147 4.496h12.588c-0.322-1.93-1.509-3.563-3.147-4.496v-0.749h8.392v25.177z" fill="currentColor" />
                    </svg>
                    
                    <?php echo esc_html__('Your Order', 'elessi-theme'); ?>
                    
                    <svg class="nasa-icon rtl-margin-left-0 rtl-margin-right-10 nasa-flip-vertical" width="35" height="35" viewBox="0 0 32 32" fill="currentColor">
                        <path d="M16.767 12.809l-0.754-0.754-6.035 6.035 0.754 0.754 5.281-5.281 5.256 5.256 0.754-0.754-3.013-3.013z" />
                    </svg>
                </span>
                
                <span class="your-order-price"></span>
            </a>

            <?php do_action('woocommerce_before_checkout_form', $checkout); ?>

            <!-- Checkout Form -->
            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
                <?php
                $fields = $checkout->get_checkout_fields();
                if ($fields) :

                    do_action('woocommerce_checkout_before_customer_details');

                    $billing_fields = isset($fields['billing']) ? $fields['billing'] : null;
                    $email_fields = isset($billing_fields['billing_email']) ? $billing_fields['billing_email'] : null;

                    if ($email_fields || (!NASA_CORE_USER_LOGGED && $checkout->is_registration_enabled())) : ?>
                        <!-- Custom Contact Information -->
                        <div class="checkout-group checkout-contact margin-bottom-10 clearfix" id="ns-checkout-contact">
                            <h3>
                                <?php echo esc_html__('Contact information', 'elessi-theme'); ?>
                            </h3>
                            
                            <div class="form-row-wrap">
                                <p class="form-row form-row-wide nasa-email-field">
                                    <label for="ns-email-add"><?php echo esc_html__('Email address', 'elessi-theme'); ?>&nbsp;</label>
                                    <span class="woocommerce-input-wrapper">
                                        <input id="ns-email-add" type="email" class="input-text" placeholder="Email address" value="" disabled />
                                    </span>
                                </p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="checkout-group woo-billing clearfix">
                        <div id="customer_details">
                            <?php if (true === WC()->cart->needs_shipping_address() && 'shipping' === get_option('woocommerce_ship_to_destination')) : ?>
                                <div class="ns-shipping-first">
                                    <h3>
                                        <?php echo esc_html__('Shipping address', 'elessi-theme'); ?>
                                    </h3>
                                    <?php do_action('woocommerce_checkout_shipping'); ?>
                                    <?php do_action('woocommerce_checkout_billing'); ?>
                                </div>
                            <?php else : ?>
                                <?php do_action('woocommerce_checkout_billing'); ?>
                                <?php do_action('woocommerce_checkout_shipping'); ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                <?php endif; ?>
            </form>

            <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
        </div>

        <!-- Checkout Right -->
        <div class="checkout-modern-right-wrap">
            <a href="javascript:void(0);" class="hidden-tag close-your-order-mobile nasa-stclose" rel="nofollow"></a>

            <?php
            /**
             * Custom action
             */
            do_action('nasa_checkout_before_order_review');
            ?>

            <div class="order-review order-review-modern">
                <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

                <h3 id="order_review_heading" class="order_review-heading">
                    <?php esc_html_e('Your Order', 'elessi-theme'); ?>
                </h3>

                <?php do_action('woocommerce_checkout_before_order_review'); ?>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>

                <?php do_action('woocommerce_checkout_after_order_review'); ?>
            </div>

            <?php
            /**
             * Custom action
             */
            do_action('nasa_checkout_after_order_review');
            ?>
        </div>
    </div>
</div>
