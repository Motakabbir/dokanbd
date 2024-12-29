<?php
$pp_style = isset($nasa_opt['pp_style']) && $nasa_opt['pp_style'] == 'full' ? 'full' : 'simple';
$class_content = 'columns small-12 nasa-pp-right';
$class_content .= $pp_style == 'full' ? ' large-12' : ' medium-6 large-6 right';

// Disable popup on mobile
$disableMobile = (isset($nasa_opt['disable_popup_mobile']) && (int) $nasa_opt['disable_popup_mobile']) ? true : false;

$one_time = isset($nasa_opt['promo_popup_1_time']) && $nasa_opt['promo_popup_1_time'] ? '1' : '0';

$delay = (!isset($nasa_opt['delay_promo_popup']) || (int) $nasa_opt['delay_promo_popup'] <= 0) ? 0 : (int) $nasa_opt['delay_promo_popup'];

$attrwrap = array(
    'class="nasa-promo-popup-wrap nasa-transition-400"',
    'data-delay="' . $delay . '"',
    'data-disable_mobile="' . $disableMobile . '"',
    'data-one_time="' . $one_time . '"'
);

if (!isset($nasa_opt['pp_background_image'])) :
    $nasa_opt['pp_background_image'] = ELESSI_THEME_URI . '/assets/images/newsletter_bg.jpg';
endif;

$pp_background_image = $nasa_opt['pp_background_image'] ? str_replace(
    array(
        '[site_url]',
        '[site_url_secure]',
    ), array(
        site_url('', 'http'),
        site_url('', 'https'),
    ), $nasa_opt['pp_background_image']
) : false;

if ($pp_background_image) :
    $attrwrap[] = 'style="background-image: url(' . esc_url($nasa_opt['pp_background_image']) .');"';
endif;

?>
<div id="nasa-popup" <?php echo implode(' ', $attrwrap); ?>>
    <div class="row">

        <a class="nasa-popup-close nasa-stclose" href="javascript:void(0);" title="<?php echo esc_attr__('Close (Esc)', 'elessi-theme'); ?>" rel="nofollow"></a>

        <?php if ($pp_style == 'simple'): ?>
            <div class="columns large-6 medium-6 small-12 nasa-pp-left"></div>
        <?php endif; ?>
        
        
        <div class="<?php echo esc_attr($class_content); ?>">
            <div class="nasa-popup-wrap nasa-relative flex-column nasa-flex jbw ">
                <div class="nasa-popup-wrap-content">
                    <?php
                    /**
                     * Content description
                     */
                    echo isset($nasa_opt['pp_content']) ? do_shortcode($nasa_opt['pp_content']) : '';
                    
                    /**
                     * Content contact form 7
                     */
                    echo isset($nasa_opt['pp_contact_form']) ? elessi_get_newsletter_form((int) $nasa_opt['pp_contact_form']) : '';
                    ?>
                </div>
                
                <hr class="nasa-popup-hr" />
                
                <p class="checkbox-label nasa-flex jc">
                    <input type="checkbox" value="do-not-show" name="showagain" id="showagain" class="showagain" />
                    
                    <label for="showagain">
                        <?php esc_html_e("Don't show this popup again", 'elessi-theme'); ?>
                    </label>
                </p>
            </div>
        </div>
    </div>
</div>
