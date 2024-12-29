<?php
/**
 * Show messages
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 8.6.0
 */

if (!defined('ABSPATH')) :
    exit;
endif;

if (empty($notices) || !is_array($notices)) :
    return;
endif;
?>

<?php foreach ($notices as $notice) : ?>
    <div class="woocommerce-info"<?php echo wc_get_notice_data_attr($notice); ?> role="alert">
        <?php echo wc_kses_notice($notice['notice']); ?>
    </div>
<?php
endforeach;
