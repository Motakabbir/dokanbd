<?php
if ((isset($imageMain) && $imageMain) || (isset($attachment_ids) && !empty($attachment_ids))) :
    if (!isset($nasa_opt)) :
        global $nasa_opt;
    endif;
    
    $loop_slide = isset($nasa_opt['loop_quickview']) && $nasa_opt['loop_quickview'] ? 'true' : 'false';
    
    $attrs_arr = apply_filters('ns_qvsl_gallery_attrs', array(
        'class' => 'main-image-slider nasa-slick-slider nasa-slick-nav',
        'data-columns' => esc_attr($show_images),
        'data-columns-small' => esc_attr($show_images),
        'data-columns-tablet' => esc_attr($show_images),
        'data-items' => esc_attr($show_images),
        'data-autoplay' => 'false',
        'data-delay' => '6000',
        'data-height-auto' => 'true',
        'data-dot' => 'false',
        'data-loop' => esc_attr($loop_slide)
    ));
    
    $attrs_cvt = array();
    if (!empty($attrs_arr)) :
        foreach ($attrs_arr as $key => $val) :
            $attrs_cvt[] = $key . '="' . $val . '"';
        endforeach;
    endif;
    ?>

    <div<?php echo !empty($attrs_cvt) ? ' ' . implode(' ', $attrs_cvt) : ''; ?>>
        <?php
        /**
         * Main image
         */
        echo $imageMain ? $imageMain : '';

        /**
         * Gallry Images
         */
        if (isset($attachment_ids) && !empty($attachment_ids)) :
            foreach ($attachment_ids as $attachment_id) :
                echo wp_get_attachment_image($attachment_id, apply_filters('woocommerce_gallery_image_size', 'woocommerce_single'));
            endforeach;
        endif;
        ?>
    </div>
<?php
endif;
