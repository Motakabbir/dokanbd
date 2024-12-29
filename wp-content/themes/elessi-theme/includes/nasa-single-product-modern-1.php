<?php
defined('ABSPATH') or die(); // Exit if accessed directly

if (!isset($nasa_opt)) :
    global $nasa_opt;
endif;

global $product;

$dots = isset($nasa_opt['product_slide_dot']) && $nasa_opt['product_slide_dot'] ? 'true' : 'false';
$auto = isset($nasa_opt['product_slide_auto']) && $nasa_opt['product_slide_auto'] ? 'true' : 'false';
$loop_slide = isset($nasa_opt['product_slide_loop']) && $nasa_opt['product_slide_loop'] ? 'true' : 'false';

$style_focus = isset($nasa_opt['sp_bgl']) && $nasa_opt['sp_bgl'] ? ' style="background-color: ' . esc_attr($nasa_opt['sp_bgl']) . '"' : '';

$main_attrs = apply_filters('nasa_single_product_modern_1_slide_attrs', array(
    'class="' . esc_attr($main_class) . '"',
    'data-num_main="1"',
    'data-num_thumb="4"',
    'data-speed="300"',
    'data-dots="' . esc_attr($dots) . '"',
    'data-autoplay="' . esc_attr($auto) . '"',
    'data-infinite="' . esc_attr($loop_slide) . '"',
));
?>

<div id="product-<?php echo (int) $product->get_id(); ?>" <?php post_class(); ?>>
    <?php if ($nasa_actsidebar && $nasa_sidebar != 'no') : ?>
        <div class="nasa-toggle-layout-side-sidebar nasa-sidebar-single-product <?php echo esc_attr($nasa_sidebar); ?>">
            <div class="li-toggle-sidebar">
                <a class="toggle-sidebar-shop nasa-tip" href="javascript:void(0);" rel="nofollow">
                    <svg viewBox="0 0 24 24" width="28" height="22" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><rect x="3" y="3" width="18" height="18" rx="2" ry="2" /><line x1="9" y1="3" x2="9" y2="21" /></svg>
                    <span class="toggle-sidebar-text"><?php echo esc_attr__('Open Sidebar', 'elessi-theme'); ?></span>
                </a>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="nasa-row nasa-product-details-page modern nasa-layout-modern-1">
        <div<?php echo !empty($main_attrs) ? ' ' . implode(' ', $main_attrs) : ''; ?>>

            <div class="row focus-info">
                <div class="large-4 medium-6 small-12 columns product-gallery rtl-right"> 
                    <?php do_action('woocommerce_before_single_product_summary'); ?>
                </div>
                
                <div class="large-8 medium-6 small-12 columns product-info summary entry-summary rtl-left desktop-padding-left-20 rtl-desktop-padding-left-10 rtl-desktop-padding-right-20">
                    <div class="nasa-product-info-wrap">
                        <?php do_action('woocommerce_single_product_summary'); ?>
                    </div>
                </div>
            </div>
            
            <?php do_action('woocommerce_after_single_product_summary'); ?>

        </div>

        <?php if ($nasa_actsidebar && $nasa_sidebar != 'no') : ?>
            <div class="<?php echo esc_attr($bar_class); ?>">
                <a href="javascript:void(0);" title="<?php echo esc_attr__('Close', 'elessi-theme'); ?>" class="hidden-tag nasa-close-sidebar" rel="nofollow">
                    <svg class="nasa-rotate-180" width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z" /></svg>
                </a>
                
                <div class="nasa-sidebar-off-canvas">
                    <?php dynamic_sidebar('product-sidebar'); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>
