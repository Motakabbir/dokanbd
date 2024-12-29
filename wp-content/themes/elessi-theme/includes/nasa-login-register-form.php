<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

defined('ABSPATH') or exit; // Exit if accessed directly

do_action('nasa_init_login_register_form');

$login_ajax = (bool) $prefix;
$prefix = $prefix ? 'nasa_' : '';

$nasa_keyUserName = $prefix . 'username';
$nasa_keyPass = $prefix . 'password';
$nasa_keyEmail = $prefix . 'email';
$nasa_keyLogin = $prefix . 'login';
$nasa_keyRememberme = $prefix . 'rememberme';

$nasa_keyRegUsername = $prefix . 'reg_username';
$nasa_keyRegEmail = $prefix . 'reg_email';
$nasa_keyRegPass = $prefix . 'reg_password';
$nasa_keyReg = $prefix . 'register';

$nasa_register = get_option('woocommerce_enable_myaccount_registration') == 'yes' ? true : false;

$svg_eye =
'<svg width="20px" height="20px" viewBox="0 0 24 24" fill="currentColor" class="ns-svg-eye-op">
    <path d="M12 5C5.63636 5 2 12 2 12C2 12 5.63636 19 12 19C18.3636 19 22 12 22 12C22 12 18.3636 5 12 5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
    <path d="M12 15C13.6569 15 15 13.6569 15 12C15 10.3431 13.6569 9 12 9C10.3431 9 9 10.3431 9 12C9 13.6569 10.3431 15 12 15Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>';

$svg_eye_close =
'<svg width="20px" height="20px" viewBox="0 0 24 24" fill="currentColor" class="ns-svg-eye-cl">
    <path d="M20 14.8335C21.3082 13.3317 22 12 22 12C22 12 18.3636 5 12 5C11.6588 5 11.3254 5.02013 11 5.05822C10.6578 5.09828 10.3244 5.15822 10 5.23552M12 9C12.3506 9 12.6872 9.06015 13 9.17071C13.8524 9.47199 14.528 10.1476 14.8293 11C14.9398 11.3128 15 11.6494 15 12M3 3L21 21M12 15C11.6494 15 11.3128 14.9398 11 14.8293C10.1476 14.528 9.47198 13.8524 9.1707 13C9.11386 12.8392 9.07034 12.6721 9.04147 12.5M4.14701 9C3.83877 9.34451 3.56234 9.68241 3.31864 10C2.45286 11.1282 2 12 2 12C2 12 5.63636 19 12 19C12.3412 19 12.6746 18.9799 13 18.9418" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
</svg>';

$styleRegister = $styleLogin = '';
if (isset($_REQUEST['register'])) :
    $styleRegister = ' style="left: 0px; position: relative;"';
    $styleLogin = ' style="left: -100%; position: absolute;"';
endif;
?>

<?php do_action('woocommerce_before_customer_login_form'); ?>

<div class="row" id="<?php echo esc_attr($prefix); ?>customer_login">
    <div class="large-12 columns <?php echo esc_attr($prefix); ?>login-form"<?php echo $styleLogin; ?>>
        
        <span class="nasa-form-title">
            <?php esc_html_e('Great to have you back!', 'elessi-theme'); ?>
        </span>

        <form method="post" class="woocommerce-form woocommerce-form-login login">
            
            <?php do_action('woocommerce_login_form_start'); ?>

            <p class="form-row form-row-wide">
                <span>
                    <label for="<?php echo esc_attr($nasa_keyUserName); ?>" class="inline-block left rtl-right">
                        <?php esc_html_e('Username or email', 'elessi-theme'); ?> <span class="required" aria-hidden="true">*</span>
                    </label>

                    <!-- Remember -->
                    <label for="<?php echo esc_attr($nasa_keyRememberme); ?>" class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme inline-block right rtl-left none-weight">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox margin-right-5 rtl-margin-right-0 rtl-margin-left-5" name="<?php echo esc_attr($nasa_keyRememberme); ?>" type="checkbox" id="<?php echo esc_attr($nasa_keyRememberme); ?>" value="forever" /> <?php esc_html_e('Remember', 'elessi-theme'); ?>
                    </label>
                </span>

                <!-- Username -->
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?php echo esc_attr($nasa_keyUserName); ?>" id="<?php echo esc_attr($nasa_keyUserName); ?>" autocomplete="username" value="<?php echo (!empty($_POST[$nasa_keyUserName])) ? esc_attr(wp_unslash($_POST[$nasa_keyUserName])) : ''; ?>" required aria-required="true" />
            </p>

            <p class="form-row form-row-wide">
                <span>
                    <label for="<?php echo esc_attr($nasa_keyPass); ?>" class="inline-block left rtl-right">
                        <?php esc_html_e('Password', 'elessi-theme'); ?> <span class="required" aria-hidden="true">*</span>
                    </label>
                    
                    <a class="lost_password inline-block right rtl-left none-weight" href="<?php echo esc_url(wc_lostpassword_url()); ?>"><?php esc_html_e('Lost?', 'elessi-theme'); ?></a>
                </span>
                
                <a href="javascript:void(0);" class="ns-show-password"><?php echo $svg_eye . $svg_eye_close; ?></a>
                
                <input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="<?php echo esc_attr($nasa_keyPass); ?>" id="<?php echo esc_attr($nasa_keyPass); ?>" autocomplete="current-password" required aria-required="true" />
            </p>

            <?php do_action('woocommerce_login_form'); ?>

            <p class="form-row row-submit">
                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit nasa-fullwidth margin-top-10" name="<?php echo esc_attr($nasa_keyLogin); ?>" value="<?php esc_attr_e('SIGN IN TO YOUR ACCOUNT', 'elessi-theme'); ?>"><?php esc_html_e('SIGN IN TO YOUR ACCOUNT', 'elessi-theme'); ?></button>
            </p>

            <?php do_action('woocommerce_login_form_end'); ?>
        </form>

        <?php if ($nasa_register) : ?>
            <p class="nasa-switch-form">
                <?php esc_html_e('Not a member? ', 'elessi-theme'); ?>
                
                <a class="nasa-switch-register" href="javascript:void(0);" rel="nofollow">
                    <?php esc_html_e('Create an account', 'elessi-theme'); ?>
                </a>
            </p>
        <?php endif; ?>
    </div>

    <?php if ($nasa_register) : ?>
        <div class="large-12 columns <?php echo esc_attr($prefix); ?>register-form"<?php echo $styleRegister; ?>>

            <span class="nasa-form-title">
                <?php esc_html_e('Great to see you here!', 'elessi-theme'); ?>
            </span>

            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>

                <?php do_action('woocommerce_register_form_start'); ?>

                <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>

                    <p class="form-row form-row-wide">
                        <label for="<?php echo esc_attr($nasa_keyRegUsername); ?>" class="left rtl-right">
                            <?php esc_html_e('Username', 'elessi-theme'); ?> <span class="required" aria-hidden="true">*</span>
                        </label>

                        <!-- Username -->
                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="<?php echo esc_attr($nasa_keyUserName); ?>" id="<?php echo esc_attr($nasa_keyRegUsername); ?>" autocomplete="username" value="<?php echo (!empty($_POST[$nasa_keyUserName])) ? esc_attr(wp_unslash($_POST[$nasa_keyUserName])) : ''; ?>" />
                    </p>

                <?php endif; ?>

                <p class="form-row form-row-wide">
                    <label for="<?php echo esc_attr($nasa_keyRegEmail); ?>" class="left rtl-right">
                        <?php esc_html_e('Email address', 'elessi-theme'); ?> <span class="required" aria-hidden="true">*</span>
                    </label>

                    <!-- Email -->
                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="<?php echo esc_attr($nasa_keyEmail); ?>" id="<?php echo esc_attr($nasa_keyRegEmail); ?>" autocomplete="email" value="<?php echo (!empty($_POST[$nasa_keyEmail])) ? esc_attr(wp_unslash($_POST[$nasa_keyEmail])) : ''; ?>" required aria-required="true" />
                </p>

                <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                    <p class="form-row form-row-wide">
                        <label for="<?php echo esc_attr($nasa_keyRegPass); ?>" class="left rtl-right">
                            <?php esc_html_e('Password', 'elessi-theme'); ?> <span class="required">*</span>
                        </label>

                        <!-- Password -->
                        <a href="javascript:void(0);" class="ns-show-password"><?php echo $svg_eye . $svg_eye_close; ?></a>
                        
                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="<?php echo esc_attr($nasa_keyPass); ?>" id="<?php echo esc_attr($nasa_keyRegPass); ?>" autocomplete="new-password" required aria-required="true" />
                    </p>

                <?php else : ?>

                    <p class="form-row form-row-wide">
                        <?php esc_html_e('A link to set a new password will be sent to your email address.', 'elessi-theme'); ?>
                    </p>

                <?php endif; ?>

                <?php do_action('woocommerce_register_form'); ?>

                <p class="form-row">
                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>

                    <!-- Submit button -->
                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit nasa-fullwidth" name="<?php echo esc_attr($nasa_keyReg); ?>" value="<?php esc_attr_e('SETUP YOUR ACCOUNT', 'elessi-theme'); ?>"><?php esc_html_e('SETUP YOUR ACCOUNT', 'elessi-theme'); ?></button>
                </p>

                <?php do_action('woocommerce_register_form_end'); ?>

            </form>

            <p class="nasa-switch-form">
                <?php esc_html_e('Already got an account? ', 'elessi-theme'); ?>
                
                <a class="nasa-switch-login" href="javascript:void(0);" rel="nofollow">
                    <?php esc_html_e('Sign in here', 'elessi-theme'); ?>
                </a>
            </p>

        </div>
    <?php endif; ?>
</div>

<?php
do_action('woocommerce_after_customer_login_form');
