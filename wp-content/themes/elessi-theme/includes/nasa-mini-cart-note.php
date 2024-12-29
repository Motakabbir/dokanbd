<?php
defined('ABSPATH') || exit;

if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))) :

    $checkout = WC()->checkout();

    echo '<p class="node-title nasa-bold fs-20 mobile-fs-18">' . esc_html__('Add note', 'elessi-theme') . '</p>';
    
    do_action('woocommerce_before_order_notes', $checkout);
    
    foreach ($checkout->get_checkout_fields('order') as $key => $field) :
        woocommerce_form_field($key, $field, $checkout->get_value($key));
    endforeach;

    do_action('woocommerce_after_order_notes', $checkout);
    
    ?>

    <button type="submit" class="button nasa-fullwidth" name="mini-cart-save_note" value="<?php echo esc_attr__('Note', 'elessi-theme'); ?>" id="mini-cart-save_note">
        <?php echo esc_html__('Save', 'elessi-theme'); ?>
    </button>

<?php
endif;
