<?php

$blocks = nasa_get_blocks_options();

/**
 * Case Edit
 */
if (is_object($term) && $term) {
    $bread_allow = get_term_meta($term->term_id, $this->_cat_bread_allow, true);

    $bread_layout = get_term_meta($term->term_id, $this->_cat_bread_layout, true);
    
    $bread_type = get_term_meta($term->term_id, $this->_cat_bread_enable, true);
    
    $thumbnail_id = get_term_meta($term->term_id, $this->_cat_bread_bg, true);
    $image = $thumbnail_id ? wp_get_attachment_thumb_url($thumbnail_id) : wc_placeholder_img_src();
    
    $thumbnail_m_id = get_term_meta($term->term_id, $this->_cat_bread_bg_m, true);
    $image_m = $thumbnail_m_id ? wp_get_attachment_thumb_url($thumbnail_id) : wc_placeholder_img_src();
    
    $bg_color = get_term_meta($term->term_id, $this->_cat_bread_bg_color, true);
    $text_color = get_term_meta($term->term_id, $this->_cat_bread_text, true);
    
    $bread_align = get_term_meta($term->term_id, $this->_cat_bread_align, true);
    
    $bread_height = get_term_meta($term->term_id, $this->_cat_bread_height, true);
    $bread_height_m = get_term_meta($term->term_id, $this->_cat_bread_height_m, true);
    
    $bread_after = get_term_meta($term->term_id, $this->_cat_bread_after, true);
    ?>
    <tr class="form-field breadcrumb_allow nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_bread_allow; ?>"><?php _e('Breadcrumb', 'nasa-core'); ?></label>
        </th>
        
        <td>
            <div class="nasa_breadcrumb_allow">
                <select name="<?php echo $this->_cat_bread_allow; ?>" id="<?php echo $this->_cat_bread_allow; ?>" class="postform">
                    <option value=""<?php echo $bread_allow == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="1"<?php echo $bread_allow == '1' ? ' selected' : ''; ?>><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                    <option value="-1"<?php echo $bread_allow == '-1' ? ' selected' : ''; ?>><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>

    <tr class="form-field breadcrumb_layout nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_bread_layout; ?>"><?php _e('Breadcrumb Layout', 'nasa-core'); ?></label>
        </th>
        
        <td>
            <div class="nasa_breadcrumb_layout">
                <select name="<?php echo $this->_cat_bread_layout; ?>" id="<?php echo $this->_cat_bread_layout; ?>" class="postform">
                    <option value=""<?php echo $bread_layout == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="multi"<?php echo $bread_layout == 'multi' ? ' selected' : ''; ?>><?php echo esc_html__('Double Rows', 'nasa-core'); ?></option>
                    <option value="single"<?php echo $bread_layout == 'single' ? ' selected' : ''; ?>><?php echo esc_html__('Single Row', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>

    <tr class="form-field breadcrumb_type nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_bread_enable; ?>"><?php _e('Breadcrumb Type', 'nasa-core'); ?></label>
        </th>
        
        <td>
            <div class="nasa_breadcrumb_type">
                <select name="<?php echo $this->_cat_bread_enable; ?>" id="<?php echo $this->_cat_bread_enable; ?>" class="postform">
                    <option value=""<?php echo $bread_type == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="1"<?php echo $bread_type == 1 ? ' selected' : ''; ?>><?php echo esc_html__('With Background', 'nasa-core'); ?></option>
                    <option value="-1"<?php echo $bread_type == -1 ? ' selected' : ''; ?>><?php echo esc_html__('Without Background', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field with-breadcrumb_type nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label><?php _e('Breadcrumb Background Image', 'nasa-core'); ?></label>
        </th>
        <td>
            <div id="breadcrumb_bg_thumbnail" style="float: left; margin-right: 10px;">
                <img src="<?php echo esc_url($image); ?>" height="60" />
            </div>
            <div style="line-height: 60px;">
                <input type="hidden" id="<?php echo $this->_cat_bread_bg; ?>" name="<?php echo $this->_cat_bread_bg; ?>" value="<?php echo $thumbnail_id; ?>" />
                <button type="button" class="upload_image_button_bread button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                <button type="button" class="remove_image_button_bread button"><?php _e('Remove Image', 'nasa-core'); ?></button>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field with-breadcrumb_type nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label><?php _e('Breadcrumb Background - Mobile', 'nasa-core'); ?></label>
        </th>
        <td>
            <div id="breadcrumb_bg_thumbnail_m" style="float: left; margin-right: 10px;">
                <img src="<?php echo esc_url($image_m); ?>" height="60" />
            </div>

            <div style="line-height: 60px;">
                <input type="hidden" id="<?php echo $this->_cat_bread_bg_m; ?>" name="<?php echo $this->_cat_bread_bg_m; ?>" value="<?php echo $thumbnail_m_id; ?>" />
                <button type="button" class="upload_image_button_bread_m button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                <button type="button" class="remove_image_button_bread_m button"><?php _e('Remove Image', 'nasa-core'); ?></button>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_bread_bg_color; ?>"><?php _e('Breadcrumb Background Color', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_bread_bg_color; ?>" name="<?php echo $this->_cat_bread_bg_color; ?>" value="<?php echo isset($bg_color) ? esc_attr($bg_color) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_bread_text; ?>"><?php _e('Breadcrumb Text Color', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_bread_text; ?>" name="<?php echo $this->_cat_bread_text; ?>" value="<?php echo isset($text_color) ? esc_attr($text_color) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_bread_align; ?>"><?php _e('Breadcrumb Text Alignment', 'nasa-core'); ?></label>
        </th>
        
        <td>
            <div class="nasa_breadcrumb_align">
                <select name="<?php echo $this->_cat_bread_align; ?>" id="<?php echo $this->_cat_bread_align; ?>" class="postform">
                    <option value=""<?php echo $bread_align == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="text-center"<?php echo $bread_align == 'text-center' ? ' selected' : ''; ?>><?php echo esc_html__('Center', 'nasa-core'); ?></option>
                    <option value="text-left"<?php echo $bread_align == 'text-left' ? ' selected' : ''; ?>><?php echo esc_html__('Left', 'nasa-core'); ?></option>
                    <option value="text-right"<?php echo $bread_align == 'text-right' ? ' selected' : ''; ?>><?php echo esc_html__('Right', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row">
            <label for="<?php echo $this->_cat_bread_height; ?>"><?php _e('Breadcrumb Height', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_breadcrumb_height">
                <input name="<?php echo $this->_cat_bread_height; ?>" id="<?php echo $this->_cat_bread_height; ?>" type="text" value="<?php echo $bread_height; ?>" size="40" />
            </div>
            
            <div class="clear"></div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row">
            <label for="<?php echo $this->_cat_bread_height_m; ?>"><?php _e('Breadcrumb Height - Mobile', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_breadcrumb_height_m">
                <input name="<?php echo $this->_cat_bread_height_m; ?>" id="<?php echo $this->_cat_bread_height_m; ?>" type="text" value="<?php echo $bread_height_m; ?>" size="40" />
            </div>
            
            <div class="clear"></div>
       </td>
    </tr>
    
    <tr class="form-field ns-advance-field">
        <th scope="row">
            <label for="<?php echo $this->_cat_bread_after; ?>"><?php esc_html_e('After Breadcrumb', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            if ($blocks) {
                echo '<p><select id="' . $this->_cat_bread_after . '" name="' . $this->_cat_bread_after . '" class="nasa-ad-select-2">';
                foreach ($blocks as $slug => $name) {
                    echo '<option value="' . $slug . '"' . ($bread_after == $slug ? ' selected' : '') . '>' . $name . '</option>';
                }
                echo '</select></p>';
            }
            ?>
            <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
        </td>
    </tr>
    
    <tr class="space-admin nasa-term-root hidden-tag ns-advance-field"><td colspan="2"></td></tr>
<?php 
}

/**
 * Case Create
 */
else { ?>
    <div class="form-field term-breadcrumb_allow-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_bread_allow; ?>"><?php _e('Breadcrumb', 'nasa-core'); ?></label>
        <div class="nasa_breadcrumb_allow">
            <select name="<?php echo $this->_cat_bread_allow; ?>" id="<?php echo $this->_cat_bread_allow; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="1"><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                <option value="-1"><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-breadcrumb_layout-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_bread_layout; ?>"><?php _e('Breadcrumb Layout', 'nasa-core'); ?></label>
        <div class="nasa_breadcrumb_layout">
            <select name="<?php echo $this->_cat_bread_layout; ?>" id="<?php echo $this->_cat_bread_layout; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="multi"><?php echo esc_html__('Double Rows', 'nasa-core'); ?></option>
                <option value="single"><?php echo esc_html__('Single Row', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-breadcrumb_type-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_bread_enable; ?>"><?php _e('Breadcrumb Type', 'nasa-core'); ?></label>
        <div class="nasa_breadcrumb_type">
            <select name="<?php echo $this->_cat_bread_enable; ?>" id="<?php echo $this->_cat_bread_enable; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="1"><?php echo esc_html__('With Background', 'nasa-core'); ?></option>
                <option value="-1"><?php echo esc_html__('Without Background', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-field term-breadcrumb_bg-wrap with-breadcrumb_type nasa-term-root hidden-tag ns-advance-field">
        <label><?php _e('Breadcrumb Background', 'nasa-core'); ?></label>
        <div id="breadcrumb_bg_thumbnail" style="float: left; margin-right: 10px;">
            <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" height="60" />
        </div>

        <div style="line-height: 60px;">
            <input type="hidden" id="<?php echo $this->_cat_bread_bg; ?>" name="<?php echo $this->_cat_bread_bg; ?>" />
            <button type="button" class="upload_image_button_bread button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
            <button type="button" class="remove_image_button_bread button"><?php _e('Remove Image', 'nasa-core'); ?></button>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-field term-breadcrumb_bg-wrap with-breadcrumb_type nasa-term-root hidden-tag ns-advance-field">
        <label><?php _e('Breadcrumb Background - Mobile', 'nasa-core'); ?></label>
        <div id="breadcrumb_bg_thumbnail_m" style="float: left; margin-right: 10px;">
            <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" height="60" />
        </div>

        <div style="line-height: 60px;">
            <input type="hidden" id="<?php echo $this->_cat_bread_bg_m; ?>" name="<?php echo $this->_cat_bread_bg_m; ?>" />
            <button type="button" class="upload_image_button_bread_m button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
            <button type="button" class="remove_image_button_bread_m button"><?php _e('Remove Image', 'nasa-core'); ?></button>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-breadcrumb_bg_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_bread_bg_color; ?>"><?php _e('Breadcrumb Background Color', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_bread_bg_color; ?>" name="<?php echo $this->_cat_bread_bg_color; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-field term-breadcrumb_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_bread_text; ?>"><?php _e('Breadcrumb Text Color', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_bread_text; ?>" name="<?php echo $this->_cat_bread_text; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-breadcrumb_align-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_bread_align; ?>"><?php _e('Breadcrumb Text Alignment', 'nasa-core'); ?></label>
        <div class="nasa_breadcrumb_type">
            <select name="<?php echo $this->_cat_bread_align; ?>" id="<?php echo $this->_cat_bread_align; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="text-center"><?php echo esc_html__('Center', 'nasa-core'); ?></option>
                <option value="text-left"><?php echo esc_html__('Left', 'nasa-core'); ?></option>
                <option value="text-right"><?php echo esc_html__('Right', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-breadcumb_height-wrap nasa-term-root hidden-tag ns-advance-field">
	<label for="<?php echo $this->_cat_bread_height; ?>"><?php _e('Breadcrumb Height', 'nasa-core'); ?></label>
	<input name="<?php echo $this->_cat_bread_height; ?>" id="<?php echo $this->_cat_bread_height; ?>" type="text" value="" size="40" />
    </div>
    
    <div class="form-field term-breadcumb_height-wrap nasa-term-root hidden-tag ns-advance-field">
	<label for="<?php echo $this->_cat_bread_height_m; ?>"><?php _e('Breadcrumb Height - Mobile', 'nasa-core'); ?></label>
	<input name="<?php echo $this->_cat_bread_height_m; ?>" id="<?php echo $this->_cat_bread_height_m; ?>" type="text" value="" size="40" />
    </div>
    
    <div class="form-field term-breadcumb_after-wrap ns-advance-field">
        <label for="<?php echo $this->_cat_bread_after; ?>"><?php esc_html_e('After Breadcrumb', 'nasa-core'); ?></label>
        <?php
        if ($blocks) {
            echo '<p><select id="' . $this->_cat_bread_after . '" name="' . $this->_cat_bread_after . '" class="nasa-ad-select-2">';
            foreach ($blocks as $slug => $name) {
                echo '<option value="' . $slug . '">' . $name . '</option>';
            }
            echo '</select></p>';
        }
        ?>
        <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
    </div>
    
    <div class="space-admin nasa-term-root hidden-tag ns-advance-field"></div>
    <?php
}
?>

<script>
    jQuery(document).ready(function ($){
        if ('1' !== $('#<?php echo $this->_cat_bread_enable; ?>').val()) {
            $('.with-breadcrumb_type').hide();
        }

        $('body').on('change', '#<?php echo $this->_cat_bread_enable; ?>', function() {
            if ('1' !== $(this).val()) {
                $('.with-breadcrumb_type').fadeOut(200);
            } else {
                $('.with-breadcrumb_type').fadeIn(200);
            }
        });

        // Only show the "Remove Image" button when needed
        if (!$('#<?php echo $this->_cat_bread_bg; ?>').val()) {
            $('.remove_image_button_bread').hide();
        }

        // Uploading files
        var file_frame_bread;

        $('body').on('click', '.upload_image_button_bread', function (event) {

            event.preventDefault();

            // If the media frame already exists, reopen it.
            if (file_frame_bread) {
                file_frame_bread.open();
                return;
            }

            // Create the media frame.
            file_frame_bread = wp.media.frames.downloadable_file = wp.media({
                title: '<?php _e("Choose an image", "nasa-core"); ?>',
                button: {
                    text: '<?php _e("Use image", "nasa-core"); ?>'
                },
                multiple: false
            });

            // When an image is selected, run a callback.
            file_frame_bread.on('select', function () {
                var attachment = file_frame_bread.state().get('selection').first().toJSON();
                var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                $('#<?php echo $this->_cat_bread_bg; ?>').val(attachment.id);
                $('#breadcrumb_bg_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                $('.remove_image_button_bread').show();
            });

            // Finally, open the modal.
            file_frame_bread.open();
        });

        $('body').on('click', '.remove_image_button_bread', function () {
            $('#breadcrumb_bg_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
            $('#<?php echo $this->_cat_bread_bg; ?>').val('');
            $('.remove_image_button_bread').hide();
            return false;
        });
        
        // Only show the "Remove Image" button when needed
        if (!$('#<?php echo $this->_cat_bread_bg_m; ?>').val()) {
            $('.remove_image_button_bread_m').hide();
        }

        // Uploading files m
        var file_frame_bread_m;

        $('body').on('click', '.upload_image_button_bread_m', function (event) {
            
            event.preventDefault();

            // If the media frame already exists, reopen it.
            if (file_frame_bread_m) {
                file_frame_bread_m.open();
                return;
            }

            // Create the media frame.
            file_frame_bread_m = wp.media.frames.downloadable_file = wp.media({
                title: '<?php _e("Choose an image", "nasa-core"); ?>',
                button: {
                    text: '<?php _e("Use image", "nasa-core"); ?>'
                },
                multiple: false
            });

            // When an image is selected, run a callback.
            file_frame_bread_m.on('select', function () {
                var attachment = file_frame_bread_m.state().get('selection').first().toJSON();
                var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                $('#<?php echo $this->_cat_bread_bg_m; ?>').val(attachment.id);
                $('#breadcrumb_bg_thumbnail_m').find('img').attr('src', attachment_thumbnail.url);
                $('.remove_image_button_bread_m').show();
            });

            // Finally, open the modal.
            file_frame_bread_m.open();
        });

        $('body').on('click', '.remove_image_button_bread_m', function () {
            $('#breadcrumb_bg_thumbnail_m').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
            $('#<?php echo $this->_cat_bread_bg_m; ?>').val('');
            $('.remove_image_button_bread_m').hide();
            
            return false;
        });
        
        <?php if ($term === null) : ?>
            $(document).ajaxComplete(function (event, request, options) {
                if (request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                    var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                    if (!res || res.errors) {
                        return;
                    }

                    // Clear Thumbnail fields on submit
                    $('#breadcrumb_bg_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                    $('#breadcrumb_bg_thumbnail_m').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                    $('#<?php echo $this->_cat_bread_bg; ?>').val('');
                    $('#<?php echo $this->_cat_bread_bg_m; ?>').val('');
                    $('.remove_image_button_bread').hide();
                    $('.remove_image_button_bread_m').hide();

                    // Clear Display type field on submit
                    $('#display_type').val('');

                    return;
                }
            });
        <?php endif; ?>
    });
</script>
