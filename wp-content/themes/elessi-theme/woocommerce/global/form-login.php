<?php
/**
 * Login form
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 9.2.0
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

if (NASA_CORE_USER_LOGGED) :
    return;
endif;
?>

<form class="woocommerce-form woocommerce-form-login login" method="post"<?php echo $hidden ? ' style="display:none;"' : ''; ?>>
    <div class="wrap-all">
        <?php do_action('woocommerce_login_form_start'); ?>

        <?php echo $message ? wpautop(wptexturize($message)) : ''; // @codingStandardsIgnoreLine ?>

        <p class="form-row form-row-first">
            <label for="username"><?php esc_html_e('Username or email', 'elessi-theme'); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
            <input type="text" class="input-text" name="username" id="username" autocomplete="username" required aria-required="true" />
        </p>
        
        <p class="form-row form-row-last">
            <label for="password"><?php esc_html_e('Password', 'elessi-theme'); ?>&nbsp;<span class="required" aria-hidden="true">*</span></label>
            <input class="input-text woocommerce-Input" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
        </p>
        <div class="clear"></div>

        <?php do_action('woocommerce_login_form'); ?>

        <p class="form-row submit_wrap">
            <span class="nasa-flex jbw">
                <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme none-weight">
                    <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'elessi-theme'); ?></span>
                </label>

                <span class="lost_password">
                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="none-weight"><?php esc_html_e('Lost your password?', 'elessi-theme'); ?></a>
                </span>
            </span>

            <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
            <input type="hidden" name="redirect" value="<?php echo esc_url($redirect) ?>" />

            <button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e('Login', 'elessi-theme'); ?>"><?php esc_html_e('Login', 'elessi-theme'); ?></button>
        </p>

        <div class="clear"></div>

        <?php do_action('woocommerce_login_form_end'); ?>
    </div>
</form>
