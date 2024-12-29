<?php
defined('ABSPATH') or die();

$no_img_src = wc_placeholder_img_src();
$image_src_arr = $inputval ? wp_get_attachment_image_src($inputval, 'thumbnail') : false;
$image_src = isset($image_src_arr[0]) ? $image_src_arr[0] : $no_img_src;

if ($field['id'] != '_product_video_upload') : ?>
    
    <p class="form-field <?php echo esc_attr($field['id']) . '_field ' . esc_attr($field['wrapper_class']); ?>">
        <label for="<?php echo esc_attr($field['id']); ?>">
            <?php echo wp_kses_post($field['label']); ?> 
        </label>
        <a href="javascript:void(0);" class="nasa-custom-upload<?php echo ($inputval ? ' nasa-remove' : ''); ?>" data-confirm_remove="<?php echo esc_attr__('Are you sure to delete image?', 'nasa-core'); ?>" data-no_img="<?php echo esc_url($no_img_src); ?>" data-wrong="<?php echo esc_attr__('The one you just selected is a video. Please choose the right image!', 'nasa-core'); ?>">
            <img src="<?php echo esc_url($image_src); ?>" height="100" />
            <input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo esc_attr($inputval); ?>" />
        </a>

        <?php if (!empty($field['description'])) : ?>
            <?php if(isset($field['desc_tip']) && false !== $field['desc_tip']) : ?>
                <img class="help_tip" data-tip="<?php echo esc_attr($field['description']); ?>" src="<?php echo esc_url(WC()->plugin_url()); ?>'/assets/images/help.png" height="16" width="16" />
            <?php else : ?>
                <span class="description nasa-block"><?php echo wp_kses_post($field['description']); ?></span>
            <?php endif; ?>
        <?php endif; ?>
    </p>

<?php else:
    $video_url = wp_get_attachment_url($inputval) ? wp_get_attachment_url($inputval) : '';

    if ($video_url) :
        $video_class = '';
        $novideo_class = 'hidden-tag';
    else :
        $video_class = 'hidden-tag';
        $novideo_class = '';
    endif;
    ?>

    <p class="form-field <?php echo esc_attr($field['id']) . '_field ' . esc_attr($field['wrapper_class']); ?>">
        <label for="<?php echo esc_attr($field['id']); ?>">
            <?php echo wp_kses_post($field['label']); ?> 
        </label>
        
        <a href="javascript:void(0);" class="nasa-custom-upload-video<?php echo ($inputval ? ' nasa-remove' : ''); ?>" data-confirm_remove="<?php echo esc_attr__('Are you sure to delete video?', 'nasa-core'); ?>" data-no_video="<?php echo esc_url($no_img_src); ?>" data-wrong="<?php echo esc_attr__('The one you just selected is an image. Please choose the right video!', 'nasa-core'); ?>">
            <video class="<?php echo $video_class; ?>" src="<?php echo esc_url($video_url); ?>" height="200" playsinline controls></video>
            <img class="<?php echo $novideo_class; ?>" src="<?php echo esc_url($no_img_src); ?>" height="200" />

            <input type="hidden" name="<?php echo esc_attr($field['name']); ?>" value="<?php echo esc_attr($inputval); ?>" />
        </a>
        
        <?php if (!empty($field['description'])) : ?>
            <?php if(isset($field['desc_tip']) && false !== $field['desc_tip']) : ?>
                <video class="help_tip" data-tip="<?php echo esc_attr($field['description']); ?>" src="<?php echo esc_url(WC()->plugin_url()); ?>'/assets/images/help.png" height="300" playsinline autoplay loop muted></video>
            <?php else : ?>
                <span class="description nasa-block"><?php echo wp_kses_post($field['description']); ?></span>
            <?php endif; ?>
        <?php endif; ?>
    </p>

<?php
endif;
