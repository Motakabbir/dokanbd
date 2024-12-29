<?php
/**
 * Single Product Thumbnails
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 3.5.1
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $product;

$product_id = $product->get_id();
$attachment_ids = $product->get_gallery_image_ids();

$attach_video_id = elessi_get_product_meta_value($product_id, '_product_video_upload');
$video_url = $attach_video_id ? wp_get_attachment_url($attach_video_id) : false;
$attach_video_poster_id = elessi_get_product_meta_value($product_id, '_product_video_poster_upload');
$video_load = '';

?>
<div class="nasa-thumbnail-default-wrap">
    <div class="product-thumbnails images-popups-gallery nasa-single-product-thumbnails nasa-thumbnail-default">
        <?php
        if ($product->get_image_id()) :
            $thumbId = get_post_thumbnail_id();
            $image_title = esc_attr(get_the_title($thumbId));
            $image_thumb = wp_get_attachment_image_src($thumbId, 'thumbnail');
            $thumb_src = isset($image_thumb['0']) ? $image_thumb['0'] : wc_placeholder_img_src();
            $image = get_the_post_thumbnail($product_id, apply_filters('single_product_small_thumbnail_size', 'thumbnail'), array('alt' => $image_title, 'class' => 'skip-lazy attachment-thumbnail size-thumbnail'));
            $video_load = $thumb_src;

            echo sprintf('<div class="nasa-wrap-item-thumb nasa-active" data-key="0" data-thumb_org="%s"><a href="javascript:void(0);" title="%s" class="active-thumbnail" rel="nofollow">%s</a></div>', $thumb_src, $image_title, $image);
        else :
            $noimage = wc_placeholder_img_src();
            
            $video_load = $noimage;
            
            echo sprintf('<div class="nasa-wrap-item-thumb nasa-active" data-key="0" data-thumb_org="%s"><a href="javascript:void(0);" class="active-thumbnail" rel="nofollow"><img src="%s" /></a></div>', $noimage, $noimage);
        endif;

        $loop = 0;
        if (!empty($attachment_ids)) :
            foreach ($attachment_ids as $attachment_id) :
                $image = wp_get_attachment_image($attachment_id, apply_filters('single_product_small_thumbnail_size', 'thumbnail'), false, array('alt' => $image_title, 'class' => 'skip-lazy attachment-thumbnail size-thumbnail'));
                
                if (!$image) :
                    continue;
                endif;
                
                $key = $loop + 1;

                echo '<div class="nasa-wrap-item-thumb" data-key="' . (int) $key . '">';
                echo apply_filters('single_product_small_thumbnail_size_html', sprintf('%s', $image), $attachment_id);
                echo '</div>';
                
                $loop++;
            endforeach;
        endif;

        if ($video_url) :
            $key_video = $loop + 1;
            
            $video_poster_url = $attach_video_poster_id ? wp_get_attachment_url($attach_video_poster_id) : $video_load;
            
            echo '<div class="nasa-wrap-item-thumb ns-video-poster"datwer="' . wp_get_attachment_url($attach_video_poster_id) . '" data-key="' . ((int) $key_video) . '"><img class="skip-lazy attachment-thumbnail size-thumbnail ns-video-load" src="' . esc_url($video_poster_url) . '" alt="' . esc_attr('Video Thumbnail', 'elessi-theme') . '" /><svg fill="currentColor" viewBox="-2.4 -2.4 64.80 64.80" stroke="currentColor" stroke-width="3"><path d="M45.563,29.174l-22-15c-0.307-0.208-0.703-0.231-1.031-0.058C22.205,14.289,22,14.629,22,15v30 c0,0.371,0.205,0.711,0.533,0.884C22.679,45.962,22.84,46,23,46c0.197,0,0.394-0.059,0.563-0.174l22-15 C45.836,30.64,46,30.331,46,30S45.836,29.36,45.563,29.174z M24,43.107V16.893L43.225,30L24,43.107z"/><path d="M30,0C13.458,0,0,13.458,0,30s13.458,30,30,30s30-13.458,30-30S46.542,0,30,0z M30,58C14.561,58,2,45.439,2,30 S14.561,2,30,2s28,12.561,28,28S45.439,58,30,58z" /></svg></div>';
        endif; 
        ?>
    </div>
</div>
