<?php
/**
 * Custom Product image
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 9.0.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $product, $nasa_opt;

$product_id = $product->get_id();
$post_thumbnail_id = $product->get_image_id();
$product_post = get_post($product_id);

$attachment_ids = $product->get_gallery_image_ids();

$attach_video_id = elessi_get_product_meta_value($product_id, '_product_video_upload');
$video_url = $attach_video_id ? wp_get_attachment_url($attach_video_id) : false;

$attach_video_poster_id = elessi_get_product_meta_value($product_id, '_product_video_poster_upload');

$video_title = $attach_video_id ? get_the_title($attach_video_id) : '';
// $data_rel = '';

$image_size = apply_filters('woocommerce_gallery_image_size', 'woocommerce_single');
$full_size = apply_filters('woocommerce_gallery_full_size', apply_filters('woocommerce_product_thumbnails_large_size', 'full'));

if ($post_thumbnail_id) :
    $image_title = esc_attr(get_the_title($post_thumbnail_id));
    $alt_text = trim(wp_strip_all_tags(get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true)));

    $image_full = wp_get_attachment_image_src($post_thumbnail_id, $full_size);
    $image_link = isset($image_full[0]) ? $image_full[0] : wp_get_attachment_url($post_thumbnail_id);
    $image_large = wp_get_attachment_image_src($post_thumbnail_id, $image_size);
    $src_large = isset($image_large[0]) ? $image_large[0] : $image_link;

    $video_poster_url = $attach_video_poster_id ? wp_get_attachment_url($attach_video_poster_id) : $image_link;

    $image = wp_get_attachment_image(
        $post_thumbnail_id,
        $image_size,
        false,
        apply_filters(
            'woocommerce_gallery_image_html_attachment_image_params',
            array(
                'title'                   => _wp_specialchars(get_post_field('post_title', $post_thumbnail_id), ENT_QUOTES, 'UTF-8', true),
                'alt'                     => $alt_text,
                'data-caption'            => _wp_specialchars(get_post_field('post_excerpt', $post_thumbnail_id), ENT_QUOTES, 'UTF-8', true),
                'data-src'                => esc_url($image_full[0]),
                'data-large_image'        => esc_url($image_full[0]),
                'data-large_image_width'  => esc_attr($image_full[1]),
                'data-large_image_height' => esc_attr($image_full[2]),
                'class'                   => 'wp-post-image skip-lazy attachment-shop_single size-shop_single',
            ),
            $post_thumbnail_id,
            $image_size,
            true
        )
    );
endif;

$attachment_count = count($attachment_ids);

$slideHoz = false;
if (isset($nasa_opt['product_detail_layout']) && in_array($nasa_opt['product_detail_layout'], array('classic', 'modern-2', 'modern-3')) && isset($nasa_opt['product_thumbs_style']) && $nasa_opt['product_thumbs_style'] === 'hoz') :
    $slideHoz = true; 
endif;


if (isset($nasa_opt['product_detail_layout']) && in_array($nasa_opt['product_detail_layout'], array('new')) && isset($nasa_opt['product_thumbs_style']) && $nasa_opt['product_thumbs_style'] === 'hoz' && isset($nasa_opt['product_image_style']) && $nasa_opt['product_image_style'] === 'slide') :
    $slideHoz = true; 
endif;

if (in_array($nasa_opt['product_detail_layout'], array('modern-1', 'new-3'))) :
    $slideHoz = true;
endif;

$imageMobilePadding = 'mobile-padding-left-5 mobile-padding-right-5';
if (isset($nasa_opt['product_detail_layout']) && $nasa_opt['product_detail_layout'] == 'new' && isset($nasa_opt['product_image_style']) && $nasa_opt['product_image_style'] == 'scroll') :
    $imageMobilePadding = 'mobile-padding-left-0 mobile-padding-right-0 nasa-flex align-start';
endif;

$class_main_imgs = 'main-images nasa-single-product-main-image nasa-main-image-default';

$class_wrapimg = 'row nasa-mobile-row woocommerce-product-gallery__wrapper';

$show_thumbnail = true;
if (isset($nasa_opt['product_detail_layout']) && in_array($nasa_opt['product_detail_layout'], array('full'))) :
    $show_thumbnail = false;
    $class_wrapimg = 'nasa-row nasa-mobile-row woocommerce-product-gallery__wrapper nasa-columns-padding-0';
    $imageMobilePadding = 'mobile-padding-left-0 mobile-padding-right-0';
    
    if (isset($nasa_opt['half_full_slide']) && $nasa_opt['half_full_slide']) :
        $class_main_imgs .= ' no-easyzoom';
    endif;
endif;

if (isset($nasa_opt['product_detail_layout']) && $nasa_opt['product_detail_layout'] === 'modern-4'):
    $show_thumbnail = false;
endif;

$sliders_arrow = isset($nasa_opt['product_slide_arrows']) && $nasa_opt['product_slide_arrows'] && $nasa_opt['product_image_style'] === 'slide' ? true : false;

$in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
$mobile_app = $in_mobile && isset($nasa_opt['mobile_layout']) && $nasa_opt['mobile_layout'] == 'app' ? true : false;

$wrapper_classes = apply_filters(
    'woocommerce_single_product_image_gallery_classes',
    array(
        'woocommerce-product-gallery',
        'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
        'images',
    )
);
?>

<div class="<?php echo esc_attr(implode(' ', array_map('sanitize_html_class', $wrapper_classes))); ?>">
    <div class="<?php echo esc_attr($class_wrapimg); ?>">
        <div class="large-12 columns <?php echo $imageMobilePadding; ?>">
            
            <?php if ($show_thumbnail && !$slideHoz && !$in_mobile) : ?>
                <div class="nasa-thumb-wrap rtl-right">
                    <?php do_action('woocommerce_product_thumbnails'); ?>
                </div>
            <?php endif; ?>
            
            <div class="nasa-main-wrap rtl-left<?php echo $slideHoz ? ' nasa-thumbnail-hoz' : ''; ?>">
                <div class="product-images-slider images-popups-gallery">
                    <div class="nasa-main-image-default-wrap">
                        <?php if ($mobile_app && $attachment_count) : ?>
                            <div class="ns-img-count nasa-flex jc fs-13">
                                <span class="ns-img-now">1</span>/<span class="ns-img-total">
                                    <?php echo $video_url ? $attachment_count + 2 : $attachment_count + 1; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($sliders_arrow) : ?>
                            <div class="nasa-single-slider-arrows">
                                <a class="nasa-single-arrow nasa-disabled" data-action="prev" href="javascript:void(0);" rel="nofollow">
                                    <svg width="42" height="42" viewBox="0 0 32 32" fill="currentColor"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z"/></svg>
                                </a>
                                <a class="nasa-single-arrow nasa-disabled" data-action="next" href="javascript:void(0);" rel="nofollow">
                                    <svg width="42" height="42" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z"/></svg>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="<?php echo esc_attr($class_main_imgs); ?>">
                            <div class="item-wrap first">
                                <div class="nasa-item-main-image-wrap" data-key="0">
                                    <?php if ($post_thumbnail_id) : ?>
                                        <div class="easyzoom first">
                                            <?php
                                            echo apply_filters(
                                                'woocommerce_single_product_image_thumbnail_html',
                                                sprintf(
                                                    '<a href="%s" class="woocommerce-main-image product-image woocommerce-product-gallery__image" data-o_href="%s" data-full_href="%s" title="%s">%s</a>',
                                                    $image_link,
                                                    $src_large,
                                                    $image_link,
                                                    $image_title,
                                                    $image
                                                ),
                                                $post_thumbnail_id
                                            );
                                            ?>
                                        </div>
                                    <?php else : ?>
                                        <?php echo apply_filters(
                                            'woocommerce_single_product_image_thumbnail_html',
                                            sprintf(
                                                '<div class="woocommerce-product-gallery__image--placeholder"><img src="%s" alt="%s" class="wp-post-image" /></div>',
                                                esc_url(wc_placeholder_img_src('woocommerce_single')),
                                                esc_html__('Awaiting product image', 'elessi-theme')
                                            ),
                                            $post_thumbnail_id
                                        ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                            $_i = 0;
                            if ($attachment_count > 0) :
                                foreach ($attachment_ids as $attachment_id) :
                                    $image_full = wp_get_attachment_image_src($attachment_id, $full_size);
                                    if (!$image_full) :
                                        continue;
                                    endif;
                                    
                                    $image_link = wp_get_attachment_url($attachment_id);
                                    $image_title = esc_attr(get_the_title($attachment_id));
                                    $alt_text = trim(wp_strip_all_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true)));

                                    $image = wp_get_attachment_image(
                                        $attachment_id,
                                        $image_size,
                                        false,
                                        apply_filters(
                                            'woocommerce_gallery_image_html_attachment_image_params',
                                            array(
                                                'title'                   => _wp_specialchars(get_post_field('post_title', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                                                'alt'                     => $alt_text,
                                                'data-caption'            => _wp_specialchars(get_post_field('post_excerpt', $attachment_id), ENT_QUOTES, 'UTF-8', true),
                                                'data-src'                => esc_url($image_full[0]),
                                                'data-large_image'        => esc_url($image_full[0]),
                                                'data-large_image_width'  => esc_attr($image_full[1]),
                                                'data-large_image_height' => esc_attr($image_full[2]),
                                                'class'                   => 'skip-lazy attachment-shop_single size-shop_single',
                                            ),
                                            $post_thumbnail_id,
                                            $image_size,
                                            false
                                        )
                                    );
                                    
                                    $_i++;
                                    ?>
                                    <div class="item-wrap">
                                        <div class="nasa-item-main-image-wrap" data-key="<?php echo (int) $_i; ?>">
                                            <div class="easyzoom">
                                                <?php
                                                echo sprintf(
                                                    '<a href="%s" class="woocommerce-additional-image product-image" title="%s">%s</a>',
                                                    $image_link,
                                                    $image_title,
                                                    $image
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                            <?php if ($video_url) : ?>
                                <div class="item-wrap">
                                    <div class="nasa-item-main-video-wrap nasa-item-main-image-wrap" data-key="<?php echo (int) $_i+1; ?>">
                                        <?php $video_poster_url = $video_poster_url ? $video_poster_url : wc_placeholder_img_src();?>
                                        <?php echo do_shortcode('[video src="' . esc_url($video_url) . '" preload="auto" poster="'.$video_poster_url.'"]'); ?>
                                        <img class="ns-video-size" src="<?php echo esc_url($video_poster_url); ?>" alt="<?php echo esc_attr($video_title); ?>" />
                                        
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="product-image-btn">
                        <?php do_action('nasa_single_buttons'); ?>
                    </div>
                </div>
            </div>
            
            <?php if ($show_thumbnail && $slideHoz) : ?>
                <div class="nasa-thumb-wrap nasa-thumbnail-hoz">
                    <?php do_action('woocommerce_product_thumbnails'); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
