<?php
/**
 * Mini-cart
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 9.2.0
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $nasa_opt;

do_action('woocommerce_before_mini_cart');

$enable_button_ajax = 'yes' === get_option('woocommerce_enable_ajax_add_to_cart') ? true : false;

$is_change_variation_mini_cart = (isset($nasa_opt['mini_cart_change_variation_product']) && $nasa_opt['mini_cart_change_variation_product'] && $enable_button_ajax) ? true : false;

$extra_mini_cart_class = 'nasa-minicart-items';

if ($is_change_variation_mini_cart) :
    $extra_mini_cart_class .= ' nasa-change_variation_mini_cart';
endif;

$in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
$mini_cart_mobile_view_hide = '';

if (!WC()->cart->is_empty()) : ?>
    <div class="<?php echo esc_attr($extra_mini_cart_class); ?>" data-text="<?php echo esc_attr__('Update Cart', 'elessi-theme'); ?>">
        <div class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
            <?php
            do_action('woocommerce_before_mini_cart_contents');

            $cart_items = WC()->cart->get_cart();
           
            if ($in_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app') :
                $mini_cart_mobile_view_hide = isset($nasa_opt['mini_cart_mobile_view_hide']) && $nasa_opt['mini_cart_mobile_view_hide'] ? ' mini_cart_mobile_view_hidden' : '';
            endif;

            foreach ($cart_items as $cart_item_key => $cart_item) :
                $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                
                if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) :
                    
                    $variations = isset($cart_item['variation']) && $cart_item['variation'] ? $cart_item['variation'] : null;
                    $_data_attr = '';
                    if (!empty($variations)) :
                        $result = array();

                        foreach ($variations as $key => $variation) :
                            $result[] = "$variation";
                        endforeach;

                        $_data_attr = implode(".", $result);
                    endif;
                    
                    /**
                     * Filter the product name.
                     *
                     * @param string $product_name Name of the product in the cart.
                     */
                    $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
                    $product_var_id = apply_filters('ns_cart_item_variation_id', $_product->get_id(), $cart_item, $cart_item_key);
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
                    $product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                    $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                    ?>
                    
                    <div class="nasa-flex align-start mini-cart-item woocommerce-mini-cart-item <?php echo esc_attr(apply_filters('woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key)); ?>" data-variation-product="<?php echo esc_attr($product_var_id . '.' . $_data_attr); ?>" data-id-var-product="<?php echo esc_attr($product_var_id); ?>" data-id-product="<?php echo esc_attr($product_id); ?>">
                        <div class="nasa-image-cart-item">
                            <?php echo $thumbnail; ?>
                        </div>

                        <div class="nasa-info-cart-item padding-left-15 rtl-padding-left-0 rtl-padding-right-15" data-variations-selected="<?php echo $is_change_variation_mini_cart && $variations != null ? htmlspecialchars(wp_json_encode($variations)): '' ?>">
                            <div class="mini-cart-info">
                                <div class="nasa-flex jbw align-start">
                                    <?php if (empty($product_permalink)) : ?>
                                        <span class="product-name nasa-bold"><?php echo wp_kses_post($product_name); ?></span>
                                    <?php else : ?>
                                        <a class="product-name nasa-bold" href="<?php echo esc_url($product_permalink); ?>" title="<?php echo esc_attr($product_name); ?>">
                                            <?php echo wp_kses_post($product_name); ?>
                                        </a>
                                    <?php endif; ?>

                                    <span class="product-remove">
                                        <?php
                                        echo apply_filters('woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="remove remove_from_cart_button item-in-cart nasa-stclose small ajax-sp_%s" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s"></a>',
                                                esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                $enable_button_ajax ? 'yes' : 'no',
                                                /* translators: %s is the product name */
                                                esc_attr(sprintf(__('Remove %s from cart', 'elessi-theme'), $product_name)),
                                                esc_attr($product_id),
                                                esc_attr($cart_item_key),
                                                esc_attr($_product->get_sku())
                                            ), $cart_item_key);
                                        ?>
                                    </span>
                                </div>

                                <?php echo wc_get_formatted_cart_item_data($cart_item); ?>
                                
                                <?php
                                if ($product_price) :
                                    echo '<div class="nasa-flex jbw align-start mini-cart-item-price margin-top-5">';
                                
                                    $wrap = false;
                                    $quantily_show = true;
                                    
                                    /**
                                     * Qty input
                                     * Elessi Theme Support
                                     */
                                    if ((!isset($nasa_opt['mini_cart_qty']) || $nasa_opt['mini_cart_qty'])) :
                                        $quantily_show = false;
                                        $wrap = true;
                                    
                                        if ($_product->is_sold_individually()) :
                                            $min_quantity = 1;
                                            $max_quantity = 1;
                                        else :
                                            $min_quantity = 0;
                                            $max_quantity = $_product->get_max_purchase_quantity();
                                        endif;
                                        
                                        $qty_args = array(
                                            'input_name'   => 'cart[' . $cart_item_key . '][qty]',
                                            'input_value'  => $cart_item['quantity'],
                                            'max_value'    => $max_quantity,
                                            'min_value'    => $min_quantity,
                                            'product_name' => $_product->get_name(),
                                            'mini_cart'    => true
                                        );
                                        
                                        $product_quantity = woocommerce_quantity_input($qty_args, $_product, false);
                                        
                                        echo '<div class="quantity-wrap nasa-flex flex-wrap">';
                                        
                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
                                    endif;

                                    echo apply_filters('woocommerce_widget_cart_item_quantity', '<div class="cart_list_product_quantity">' . ($quantily_show ? sprintf('%s &times; %s', $cart_item['quantity'], $product_price) : sprintf('&times; %s', $product_price)) . '</div>', $cart_item, $cart_item_key);

                                    echo $wrap ? '</div>' : '';
                                    
                                    /**
                                     * SubTotal
                                     * Elessi Theme Support
                                     */
                                    if ((!isset($nasa_opt['mini_cart_subtotal']) || $nasa_opt['mini_cart_subtotal'])) :
                                        echo '<div class="mini-cart-item-subtotal nasa-bold margin-left-10 rtl-margin-left-0 rtl-margin-right-10">';
                                        echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                                        echo '</div>';
                                    endif;
                                    
                                    echo '</div>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                <?php
                endif;
            endforeach;

            do_action('woocommerce_mini_cart_contents');
            ?>
        </div>
    </div>
    
    <div class="nasa-minicart-footer<?php echo $mini_cart_mobile_view_hide; ?>">
        <?php do_action('nasa_mini_cart_before_total'); ?>
        
        <div class="minicart_total_checkout woocommerce-mini-cart__total total">
            <?php
            /**
             * Woocommerce_widget_shopping_cart_total hook.
             *
             * @removed woocommerce_widget_shopping_cart_subtotal - 10
             * @hooked elessi_widget_shopping_cart_subtotal - 10
             * @hooked elessi_subtotal_free_shipping - 20
             */
            do_action('woocommerce_widget_shopping_cart_total');
            ?>
        </div>
        <div class="btn-mini-cart inline-lists text-center">
            <?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

            <p class="woocommerce-mini-cart__buttons buttons">
                <?php do_action('woocommerce_widget_shopping_cart_buttons'); ?>
            </p>

            <?php do_action('woocommerce_widget_shopping_cart_after_buttons'); ?>
        </div>
    </div>
<?php
/**
 * Empty cart
 */
else :
    $icon_empty = elessi_mini_cart_icon();
    $target_shop = apply_filters('nasa_target_return_shop', 'javascript:void(0);');
    // $str1 = array('nasa-icon cart-icon', 'width="28" height="28"');
    // $str2 = array('nasa-icon cart-icon nasa-empty-icon', ' width="100%" height="122"');
    // $icon_class = str_replace($str1, $str2, $icon_empty);
    echo
    '<p class="empty woocommerce-mini-cart__empty-message">' .
        $icon_empty .
        esc_html__('No products in the cart.', 'elessi-theme') .
        '<a href="' . esc_attr($target_shop) . '" class="button nasa-sidebar-return-shop" rel="nofollow">' . 
            esc_html__('RETURN TO SHOP', 'elessi-theme') . 
        '</a>' .
    '</p>';
endif;

do_action('woocommerce_after_mini_cart');
