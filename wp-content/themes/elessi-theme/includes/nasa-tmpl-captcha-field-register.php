<?php
/**
 * Template field Captcha Register form
 *
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;
?>
<script type="text/template" id="tmpl-captcha-field-register">
    <p class="form-row padding-top-10 nasa-capcha-row">
        <img src="?nasa-captcha-register={{key}}" class="nasa-img-captcha" />
        <a class="nasa-reload-captcha nasa-iflex" href="javascript:void(0);" title="<?php echo esc_attr__('Reload', 'elessi-theme'); ?>" data-time="0" data-key="{{key}}" rel="nofollow">
            <svg class="nasa-flip-vertical" viewBox="0 30 512 512" width="28" height="28" fill="currentColor"><path d="M276 467c0 8 6 21-2 23l-26 0c-128-7-230-143-174-284 5-13 13-23 16-36-18 0-41 23-54 5 5-15 25-18 41-23 15-5 36-7 48-15-2 10 23 95 6 100-21 5-13-39-18-57-8-5-8 8-11 13-71 126 29 297 174 274z m44 13c-8 0-10 5-20 3 0-6-3-13-3-18 5-3 13-3 18-5 2 7 5 15 5 20z m38-18c-5 3-10 8-18 10-2-7-5-12-7-18 5-2 10-7 18-7 2 5 7 7 7 15z m34-31c0-33-18-71-5-99 23 2 12 38 17 58 90-117-7-314-163-289 0-8-3-10-3-20 131-5 233 84 220 225-2 36-20 66-30 92 12 0 51-26 53-2 3 17-82 28-89 35z m-233-325c5-2 13-5 18-10 0 8 5 10 7 18-5 2-10 8-18 8 0-8-7-8-7-16z m38-18c8 0 10-5 21-5 0 5 2 13 2 18-5 3-13 3-18 5 0-5-5-10-5-18z"/></svg>
        </a>
        <input type="text" name="nasa-input-captcha" class="nasa-text-captcha" value="" placeholder="<?php echo esc_attr__('Captcha Code', 'elessi-theme'); ?>" />
        <input type="hidden" name="nasa-captcha-key" value="{{key}}" />
    </p>
</script>