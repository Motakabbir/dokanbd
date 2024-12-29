<?php

/**
 * Quantity Input
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 7.8.0
 */

defined('ABSPATH') || exit;

$label = !empty($args['product_name']) ? sprintf(esc_html__('%s quantity', 'elessi-theme'), wp_strip_all_tags($args['product_name'])) : esc_html__('Quantity', 'elessi-theme');

// In some cases we wish to display the quantity but not allow for it to be changed.
$type = isset($type) ? $type : 'text';
$readonly = isset($readonly) ? $readonly : false;

$quantily_class = 'quantity';
$quantily_class .= $readonly ? ' qnot' : '';
$quantily_class .= $type == 'hidden' ? ' hidden-tag' : '';

$classes = isset($classes) ? $classes : array('input-text', 'qty', 'text');

$mini_cart = isset($mini_cart) && $mini_cart ? true : false;

$input_value = $mini_cart && isset($cart_item_qty) ? $cart_item_qty : $input_value;
?>

<div class="<?php echo esc_attr($quantily_class); ?>">
    <?php
    /**
     * Hook to output something before the quantity input field.
     *
     * @since 7.2.0
     */
    do_action('woocommerce_before_quantity_input_field');
    ?>

    <label class="screen-reader-text hidden-tag" for="<?php echo esc_attr($input_id); ?>">
        <?php echo $label; ?>
    </label>

    <?php if (!$readonly && $type != 'hidden') : ?>
        <a href="javascript:void(0);" class="plus" rel="nofollow">
            <svg width="13" height="20" stroke-width="2" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    <?php endif; ?>

    <?php if ((!$mini_cart) || (!$readonly && $mini_cart)) : ?>
        <input 
            type="<?php echo esc_attr($type); ?>" 
            <?php echo $readonly ? 'readonly="readonly"' : ''; ?> 
            id="<?php echo esc_attr($input_id); ?>" 
            class="<?php echo esc_attr(join(' ', (array) $classes)); ?>" 
            name="<?php echo esc_attr($input_name); ?>" 
            aria-label="<?php echo esc_attr__('Product quantity', 'elessi-theme'); ?>" 
            value="<?php echo esc_attr($input_value); ?>" 
            data-old="<?php echo esc_attr($input_value); ?>" 
            size="4" 
            min="<?php echo esc_attr($min_value); ?>" 
            max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>" 
            <?php if (!$readonly) : ?>
                step="<?php echo esc_attr($step); ?>" 
                placeholder="<?php echo esc_attr($placeholder); ?>" 
                inputmode="<?php echo esc_attr($inputmode); ?>" 
                autocomplete="<?php echo esc_attr(isset($autocomplete) ? $autocomplete : 'on'); ?>" 
            <?php endif; ?>
        />
    <?php endif; ?>
    
    <?php
    /**
     * For Mini Cart
     */
    echo ($mini_cart && ($readonly || $type == 'hidden')) ? $input_value : '';
    ?>
    
    <?php if (!$readonly && $type != 'hidden') : ?>
        <a href="javascript:void(0);" class="minus" rel="nofollow">
            <svg width="13" height="20" stroke-width="2" viewBox="0 0 24 24" fill="currentColor">
                <!-- path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /-->
                <path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    <?php endif; ?>

    <?php
    /**
     * Hook to output something after quantity input field
     *
     * @since 3.6.0
     */
    do_action('woocommerce_after_quantity_input_field');
    ?>
</div>
