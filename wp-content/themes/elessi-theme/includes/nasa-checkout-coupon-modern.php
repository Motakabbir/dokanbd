<?php
/**
 * Checkout coupon form Clone
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * Since 4.4.5
 */
defined('ABSPATH') || exit;

if (!wc_coupons_enabled()) :
    return;
endif;
?>
<tr><td colspan="2" class="coupon-clone-td">
<div class="nasa-flex">
    <a href="javascript:void(0);" class="showcoupon-clone nasa-flex" rel="nofollow">
        <svg class="ns-coupon-icon" width="18" height="25" viewBox="0 0 32 32" fill="currentColor"><path d="M2784 4905 c-34 -7 -77 -21 -95 -30 -19 -9 -573 -555 -1232 -1213 -893 -892 -1205 -1210 -1225 -1247 -23 -43 -27 -62 -27 -135 0 -69 4 -93 24 -130 34 -66 1848 -1882 1916 -1918 43 -23 62 -27 135 -27 73 0 92 4 135 27 37 20 355 332 1247 1225 658 659 1204 1213 1213 1231 43 87 45 122 45 1044 0 877 0 878 -22 945 -18 57 -32 79 -88 134 -57 58 -75 70 -134 88 -67 21 -81 21 -950 20 -694 0 -894 -3 -942 -14z m1844 -220 c18 -11 43 -36 55 -55 l22 -35 0 -870 c0 -669 -3 -878 -12 -905 -10 -26 -333 -355 -1197 -1219 -1073 -1073 -1187 -1184 -1216 -1184 -29 0 -119 87 -947 916 -829 828 -916 918 -916 947 0 29 110 142 1179 1211 648 649 1188 1185 1199 1191 41 23 151 26 965 24 816 -1 836 -1 868 -21z"/><path d="M3895 4396 c-70 -18 -130 -51 -186 -103 -227 -212 -138 -601 158 -693 147 -45 294 -13 407 91 172 157 178 428 13 593 -106 107 -249 147 -392 112z m183 -225 c70 -36 112 -102 112 -176 0 -154 -162 -249 -293 -172 -175 103 -107 365 96 367 28 0 63 -8 85 -19z"/></svg>
        <?php echo esc_html__('Have a coupon code?', 'elessi-theme'); ?>
    </a>

    <a href="javascript:void(0);" class="showcoupon-clone ns-add-coupon margin-left-10 rtl-margin-left-0 rtl-margin-right-10" data-close="<?php echo esc_html__('Close', 'elessi-theme'); ?>" data-add="<?php echo esc_html__('Add', 'elessi-theme'); ?>" rel="nofollow"><?php echo esc_html__('Add', 'elessi-theme'); ?></a>
</div>

<div class="form-row form-row-first margin-top-10 coupon-clone-wrap hidden-tag">
    <div class="nasa-flex">
        <input type="text" name="coupon_code_clone" class="input-text margin-right-10 rtl-margin-right-0 rtl-margin-left-10" placeholder="<?php esc_attr_e('Coupon code', 'elessi-theme'); ?>" id="coupon_code-clone" value="" />
        <button type="submit" class="button" name="apply_coupon_clone" value="<?php esc_attr_e('Apply coupon', 'elessi-theme'); ?>" id="apply_coupon_clone"><?php esc_html_e('Apply', 'elessi-theme'); ?></button>
    </div>
</div>
</td></tr>
