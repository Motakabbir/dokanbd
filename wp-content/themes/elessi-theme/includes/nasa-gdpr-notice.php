<?php
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

$nasa_gdpr_policies = isset($nasa_opt['nasa_gdpr_policies']) && $nasa_opt['nasa_gdpr_policies'] ? $nasa_opt['nasa_gdpr_policies'] : false;
?>

<div class="nasa-cookie-notice-container">
    <div class="nasa-cookie-notice-centent">
        <span class="nasa-notice-text">
            <?php echo esc_html__('In order to provide you a personalized shopping experience, our site uses cookies. By continuing to use this site, you are agreeing to our', 'elessi-theme'); ?>
            <?php if ($nasa_gdpr_policies) : ?>
                <a href="<?php echo esc_url($nasa_gdpr_policies); ?>" target="_blank" class="nasa-policies-cookie" title="<?php echo esc_attr__('cookie policy', 'elessi-theme'); ?>" rel="nofollow"><?php echo esc_html__('cookie policy', 'elessi-theme'); ?>.</a>
            <?php endif; ?>
        </span>
        
        <a href="javascript:void(0);" class="nasa-accept-cookie" title="<?php echo esc_attr__('Accept', 'elessi-theme'); ?>" class="button" rel="nofollow"><?php echo esc_html__('Accept', 'elessi-theme'); ?></a>
    </div>
</div>
