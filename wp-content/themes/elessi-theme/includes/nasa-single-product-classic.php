<?php
defined('ABSPATH') or die(); // Exit if accessed directly

if (!isset($nasa_opt)) :
    global $nasa_opt;
endif;

global $product;

$slideHoz = false;
if (
    isset($nasa_opt['product_thumbs_style']) && $nasa_opt['product_thumbs_style'] === 'hoz'
) :
    $slideHoz = true; 
endif;

$main_class .= ' classic-layout medium-12';

$class_image = 'large-6 small-12 columns product-gallery rtl-right';
$class_info = 'large-6 small-12 columns product-info summary entry-summary left rtl-left';

$dots = isset($nasa_opt['product_slide_dot']) && $nasa_opt['product_slide_dot'] ? 'true' : 'false';
$auto = isset($nasa_opt['product_slide_auto']) && $nasa_opt['product_slide_auto'] ? 'true' : 'false';
$loop_slide = isset($nasa_opt['product_slide_loop']) && $nasa_opt['product_slide_loop'] ? 'true' : 'false';

$in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
$mobile_app = ($in_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app') ? true : false;

$mobile_app_navigation = ($mobile_app && (isset($nasa_opt['single_product_mobile_top_navication']) && $nasa_opt['single_product_mobile_top_navication']))? 'nasa-top-navigaton' : '';

$mobile_app_navigation .= ($mobile_app_navigation !== '' && (isset($nasa_opt['single_product_mobile_top_navication_ctab']) && $nasa_opt['single_product_mobile_top_navication_ctab']))? ' nasa-top-navigaton-ctab' : '';

$widgets_alc = '';
if (!isset($nasa_opt['toggle_widgets']) || $nasa_opt['toggle_widgets']) :
    $widgets_alc = isset($nasa_opt['toggle_widgets_Alc']) && $nasa_opt['toggle_widgets_Alc'] ? ' nasa-toggle-widgets-alc' : '';
    $widgets_alc = isset($nasa_opt['single_product_sticky_sidebar_classic']) && $nasa_opt['single_product_sticky_sidebar_classic'] ? ' nasa-toggle-widgets-alc' : $widgets_alc;
endif;

if ($slideHoz) :
    $class_image = 'large-6 small-12 columns product-gallery rtl-right desktop-padding-right-20 rtl-desktop-padding-right-10 rtl-desktop-padding-left-20';
    $class_info = 'large-6 small-12 columns product-info summary entry-summary left rtl-left';
    
    $dots = 'false';
endif;

$main_attrs = apply_filters('nasa_single_product_classic_slide_attrs', array(
    'class="' . esc_attr($main_class) . '"',
    'data-num_main="1"',
    'data-num_thumb="5"',
    'data-speed="300"',
    'data-dots="' . esc_attr($dots) . '"',
    'data-autoplay="' . esc_attr($auto) . '"',
    'data-infinite="' . esc_attr($loop_slide) . '"',
));
?>

<div id="product-<?php echo (int) $product->get_id(); ?>" <?php post_class(); ?>>
    <?php if ($nasa_actsidebar && $nasa_sidebar != 'no') : ?>
        <div class="div-toggle-sidebar center">
            <a class="toggle-sidebar" href="javascript:void(0);" rel="nofollow">
                <svg viewBox="0 0 32 32" width="26" height="24" fill="currentColor"><path d="M 4 7 L 4 9 L 28 9 L 28 7 Z M 4 15 L 4 17 L 28 17 L 28 15 Z M 4 23 L 4 25 L 28 25 L 28 23 Z" /></svg>
            </a>
        </div>
    <?php endif; ?>
    
    <div class="row nasa-product-details-page nasa-layout-classic <?php echo($mobile_app_navigation . $widgets_alc)?>">
        <div<?php echo !empty($main_attrs) ? ' ' . implode(' ', $main_attrs) : ''; ?>>
            <div class="row focus-info">
                <div class="<?php echo $class_image; ?>"> 
                    <?php do_action('woocommerce_before_single_product_summary'); ?>
                </div>
                
                <div class="<?php echo $class_info; ?>">
                    <?php do_action('woocommerce_single_product_summary'); ?>
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
