<?php
/**
 * Cart Page
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 7.9.0
 */

defined('ABSPATH') || exit;

global $nasa_opt;

do_action('woocommerce_before_cart');
?>

<div class="row">
    
    <div class="large-8 columns rtl-right desktop-padding-right-30 rtl-desktop-padding-right-10 rtl-desktop-padding-left-30 mobile-margin-bottom-30">
        
        <form class="woocommerce-cart-form nasa-shopping-cart-form<?php echo isset($nasa_opt['auto_update_cart']) && $nasa_opt['auto_update_cart'] ? ' qty-auto-update': ''; ?>" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
            
            <?php do_action('woocommerce_before_cart_table'); ?>

            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents responsive" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name" colspan="3"><?php esc_html_e('Product', 'elessi-theme'); ?></th>
                        <th class="product-price hide-for-small"><?php esc_html_e('Price', 'elessi-theme'); ?></th>
                        <th class="product-quantity"><?php esc_html_e('Quantity', 'elessi-theme'); ?></th>
                        <th class="product-subtotal hide-for-small"><?php esc_html_e('Subtotal', 'elessi-theme'); ?></th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    do_action('woocommerce_before_cart_contents');

                    $cart_items = WC()->cart->get_cart();
                    
                    foreach ($cart_items as $cart_item_key => $cart_item) :
                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                        
                        /**
                         * Filter the product name.
                         *
                         * @since 2.1.0
                         * @param string $product_name Name of the product in the cart.
                         * @param array $cart_item The product in the cart.
                         * @param string $cart_item_key Key for the product in the cart.
                         */
                        $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
                            
                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);

                            $price_product = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                            ?>

                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                <td class="product-remove remove-product">
                                    <?php echo apply_filters(
                                        'woocommerce_cart_item_remove_link',
                                        sprintf('<a href="%s" class="remove nasa-stclose" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            /* translators: %s is the product name */
                                            esc_attr(sprintf(__('Remove %s from cart', 'elessi-theme'), $product_name)),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ), $cart_item_key
                                    ); ?>
                                </td>
                                
                                <td class="product-thumbnail">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                                    if (!$product_permalink) :
                                        echo $thumbnail;
                                    else :
                                        printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
                                    endif;
                                    ?>
                                </td>

                                <td class="product-name" data-title="<?php esc_attr_e('Product', 'elessi-theme'); ?>">
                                    <?php
                                    if (!$product_permalink):
                                    	echo wp_kses_post($product_name . '&nbsp;');
                                    else:
                                        /**
                                         * This filter is documented above.
                                         *
                                         * @since 2.1.0
                                         */
                                    	echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                    endif;

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data.
                                    echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                    // Backorder notification
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) :
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'elessi-theme') . '</p>', $product_id));
                                    endif;
                                    ?>
                                    
                                    <div class="product-price mobile-price hide-for-large hide-for-medium" data-title="<?php esc_attr_e('Price', 'elessi-theme'); ?>">
                                        <?php echo $price_product; ?>
                                    </div>
                                </td>

                                <td class="product-price hide-for-small" data-title="<?php esc_attr_e('Price', 'elessi-theme'); ?>">
                                    <?php echo $price_product; ?>
                                </td>

                                <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'elessi-theme'); ?>">
                                    <?php
                                    if ($_product->is_sold_individually()) :
                                        $min_quantity = 1;
                                        $max_quantity = 1;
                                    else :
                                        $min_quantity = 0;
                                        $max_quantity = $_product->get_max_purchase_quantity();
                                    endif;

                                    $product_quantity = woocommerce_quantity_input(
                                        array(
                                            'input_name'   => 'cart[' . $cart_item_key . '][qty]',
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $max_quantity,
                                            'min_value'    => $min_quantity,
                                            'product_name' => $product_name,
                                        ),
                                        $_product,
                                        false
                                    );
                                    
                                    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                    ?>
                                </td>

                                <td class="product-subtotal hide-for-small" data-title="<?php esc_attr_e('Total', 'elessi-theme'); ?>">
                                    <?php
                                        echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                    ?>
                                </td>
                            </tr>
                            <?php
                        endif;
                    endforeach;

                    do_action('woocommerce_cart_contents'); ?>

                    <tr class="nasa-no-border">
                        <td colspan="6" class="actions nasa-actions">
                            <div class="row desktop-margin-top-30">
                                <div class="large-7 columns mobile-margin-top-20 left rtl-right nasa-min-height">
                                    
                                    <?php if (wc_coupons_enabled()) : ?>
                                        <div class="coupon">
                                            <label class="hidden-tag" for="coupon_code">
                                                <?php esc_html_e('Coupon:', 'elessi-theme'); ?>
                                            </label>
                                            <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'elessi-theme'); ?>" />
                                            
                                            <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'elessi-theme'); ?>">
                                                <?php esc_attr_e('Apply coupon', 'elessi-theme'); ?>
                                            </button>

                                            <?php do_action('woocommerce_cart_coupon'); ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                </div>
                                
                                <div class="large-5 columns mobile-margin-top-20 text-right rtl-text-left rtl-left">
                                    <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update Cart', 'elessi-theme'); ?>">
                                        <?php esc_html_e('Update Cart', 'elessi-theme'); ?>
                                    </button>
                                </div>
                            </div>

                            <?php do_action('woocommerce_cart_actions'); ?>

                            <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                        </td>
                    </tr>

                    <?php do_action('woocommerce_after_cart_contents'); ?>
                </tbody>
            </table>

            <?php do_action('woocommerce_after_cart_table'); ?>
        </form>
    </div>
    
    <?php do_action('woocommerce_before_cart_collaterals'); ?>
            
    <div class="large-4 columns cart-collaterals rtl-left">
        <?php
        /**
         * Cart collaterals hook.
         *
         * @removed woocommerce_cross_sell_display
         * @hooked woocommerce_cart_totals - 10
         */
        do_action('woocommerce_cart_collaterals');
        ?>
    </div><!-- .large-4 -->
    
</div><!-- .row -->

<?php
/**
 * Cart after_cart hook.
 *
 * @hooked woocommerce_cross_sell_display
 */
do_action('woocommerce_after_cart');
