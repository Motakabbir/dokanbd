<?php
/* 
 * Age Verification
 */
defined('ABSPATH') or exit; // Exit if accessed directly
?>

<script type="text/template" id="nasa-age-verification-popup-tmp">
    <div id="nasa-age-verification-popup-wrap">
        <div class="nasa-age-verification nasa-flex jc flex-column">
            <span class="nasa-age-question nasa-bold verification-text">
                <?php echo esc_html__('Are you over 18?', 'elessi-theme'); ?>
            </span>
            
            <span class="nasa-age-notice verification-text">
                <?php echo esc_html__('You must be 18 years of age or older to view page.', 'elessi-theme'); ?><br />
                <?php echo esc_html__('Please verify your age to enter.', 'elessi-theme'); ?>
            </span>
            
            <div class="nasa-age-verification-button-wrap nasa-flex jc">
                <a href="javascript:void(0);" class="nasa-over-18 button" rel="nofollow">
                    <?php echo esc_html__('I am 18 or older', 'elessi-theme'); ?>
                </a>
                
                <a href="javascript:void(0);" class="nasa-under-18 button" rel="nofollow">
                    <?php echo esc_html__('I am under 18', 'elessi-theme'); ?>
                </a>
            </div>
        </div>

        <div class="nasa-age-verification ns-age-denied nasa-flex jc flex-column">
            <span class="nasa-age-question nasa-bold verification-text">
                <?php echo esc_html__('Access fobidden', 'elessi-theme'); ?>
            </span>
            
            <span class="nasa-age-notice verification-text">
                <?php echo esc_html__('Your access is restricted because of your age.', 'elessi-theme'); ?>
            </span>
        </div>
    </div>
</script>
