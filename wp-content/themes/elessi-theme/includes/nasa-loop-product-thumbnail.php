<?php
/**
 * Loop Product Thumbnail
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $nasa_opt, $product;

$is_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        
/**
 * Hover effect products in grid
 */
$nasa_animated_products = isset($nasa_opt['animated_products']) && $nasa_opt['animated_products'] ? $nasa_opt['animated_products'] : '';

$nasa_link = $product->get_permalink(); // permalink
$nasa_title = $product->get_name(); // Title
$attachment_ids = false;

$backImageMobile = isset($nasa_opt['mobile_back_image']) && $nasa_opt['mobile_back_image'] ? true : false;

/**
 * Mobile detect
 */
if (
    !in_array($nasa_animated_products, array('', 'hover-zoom', 'hover-to-top')) && 
    (!$is_mobile || ($is_mobile && $backImageMobile))
) :
    $attachment_ids = apply_filters('ns_sp_back_img_product_grid', true) ? $product->get_gallery_image_ids() : false;
endif;

$image_size = apply_filters('single_product_archive_thumbnail_size', 'woocommerce_thumbnail');
// $main_img = $product->get_image($image_size);

$class_wrap = 'product-img';
if (!$attachment_ids && !in_array($nasa_animated_products, array('hover-zoom', 'hover-to-top'))) :
    $class_wrap .= ' nasa-no-effect';
endif;

$gallery = array();

if (in_array($nasa_animated_products, array('hover-carousel')) && $attachment_ids) :
    $class_wrap .= ' loop-gallery-carousel';
    foreach ($attachment_ids as $attachment_id) :
        $img = wp_get_attachment_image_src($attachment_id, $image_size);
        if ($img) :
            $gallery[] = array(
                'src' => $img[0],
                'w' => $img[1],
                'h' => $img[2]
            );
        endif;
    endforeach;
endif;

$wrap = 'a';
$wrap_attrs = array();

if (!empty($gallery)) :
    $wrap = 'div';

    $gallery_json = wp_json_encode($gallery);
    $gallery_json_str = function_exists('wc_esc_json') ? wc_esc_json($gallery_json) : _wp_specialchars($gallery_json, ENT_QUOTES, 'UTF-8', true);

    $wrap_attrs = array(
        'class="' . esc_attr($class_wrap) . '"',
        'title="' . esc_attr($nasa_title) . '"',
        'data-gellery="' . $gallery_json_str . '"'
    );
else :
    $class_wrap .= defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT ? ' nasa-ajax-call' : '';

    $wrap_attrs = array(
        'class="' . esc_attr($class_wrap) . '"',
        'href="' . esc_url($nasa_link) . '"',
        'title="' . esc_attr($nasa_title) . '"'
    );
endif;
?>

<?php if ($wrap !== 'a') :
    $class_a = 'link-absolute';
    $class_a .= defined('NASA_AJAX_PRODUCT') && NASA_AJAX_PRODUCT ? ' nasa-ajax-call' : '';
    ?>
    <a href="<?php echo esc_url($nasa_link); ?>" title="<?php echo esc_attr($nasa_title); ?>" class="<?php echo esc_attr($class_a); ?>"></a>
<?php endif; ?>

<<?php echo $wrap; ?><?php echo !empty($wrap_attrs) ? ' ' . implode(' ', $wrap_attrs) : ''; ?>>
    <div class="main-img">
        <?php echo $product->get_image($image_size); ?>
    </div>

    <?php
    /**
     * Back image
     */
    if (empty($gallery) && $attachment_ids) :
        foreach ($attachment_ids as $attachment_id) :
            printf('<div class="back-img back">%s</div>', wp_get_attachment_image($attachment_id, $image_size));
            break;
        endforeach;
    endif; ?>
</<?php echo $wrap; ?>>
