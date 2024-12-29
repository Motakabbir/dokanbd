<?php
if (is_object($term) && $term) {
    $cat_width_allow = get_term_meta($term->term_id, $this->_cat_width_more_allow, true);
    $cat_width = get_term_meta($term->term_id, $this->_cat_width_more, true);
    ?>
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_width_more_allow; ?>"><?php _e('Custom Width', 'nasa-core'); ?></label>
        </th>
        
        <td>
            <div class="nasa_width_more_allow">
                <select name="<?php echo $this->_cat_width_more_allow; ?>" id="<?php echo $this->_cat_width_more_allow; ?>" class="postform">
                    <option value=""<?php echo $cat_width_allow == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="1"<?php echo $cat_width_allow == 1 ? ' selected' : ''; ?>><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                    <option value="-1"<?php echo $cat_width_allow == -1 ? ' selected' : ''; ?>><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>

    <tr class="form-field nasa-term-root-child <?php echo $this->_cat_width_more_allow . ' nasa-term-' . $this->_cat_width_more_allow . '-1'; ?> hidden-tag ns-advance-field">
        <th scope="row">
            <label for="<?php echo $this->_cat_width_more; ?>"><?php esc_html_e('Add More Width (px)', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_more_width">
                <input name="<?php echo $this->_cat_width_more; ?>" id="<?php echo $this->_cat_width_more; ?>" type="text" value="<?php echo $cat_width; ?>" size="40" />
            </div>
            
            <div class="clear"></div>
       </td>
    </tr>
    <?php
} else {
    ?>
    <div class="form-field term-width_more_allow-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_width_more_allow; ?>"><?php _e('Custom Width', 'nasa-core'); ?></label>
        <div class="nasa_width_more_allow">
            <select name="<?php echo $this->_cat_width_more_allow; ?>" id="<?php echo $this->_cat_width_more_allow; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="1"><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                <option value="-1"><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-more_width-wrap nasa-term-root-child <?php echo $this->_cat_width_more_allow . ' nasa-term-' . $this->_cat_width_more_allow . '-1'; ?> hidden-tag ns-advance-field">
	<label for="<?php echo $this->_cat_width_more; ?>"><?php _e('Add More Width (px)', 'nasa-core'); ?></label>
	<input name="<?php echo $this->_cat_width_more; ?>" id="<?php echo $this->_cat_width_more; ?>" type="text" value="" size="40" />
    </div>
    <?php
}
