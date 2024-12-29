<?php
if (is_object($term) && $term) {
    $cat_type_view = get_term_meta($term->term_id, $this->_cat_type_view, true);

    $cat_change_shop_layout = get_term_meta($term->term_id, $this->_cat_change_shop_layout, true);
    $cat_color_background_shop_pro = get_term_meta($term->term_id, $this->_cat_color_background_shop_pro, true);
    $cat_color_background_shop = get_term_meta($term->term_id, $this->_cat_color_background_shop, true);

    $cat_change_layout_type = get_term_meta($term->term_id, $this->_cat_change_layout_type, true);
    $cat_multicheck_options_cols_display = get_term_meta($term->term_id, $this->_cat_multicheck_options_cols_display, true);
    $cat_change_view = get_term_meta($term->term_id, $this->_cat_change_view, true);
    
    $per_row = get_term_meta($term->term_id, $this->_cat_per_row, true);
    $per_row_medium = get_term_meta($term->term_id, $this->_cat_per_row_medium, true);
    $per_row_small = get_term_meta($term->term_id, $this->_cat_per_row_small, true);
    
    $cat_layout_style = get_term_meta($term->term_id, $this->_cat_layout_style, true);
    $cat_masonry_mode = get_term_meta($term->term_id, $this->_cat_masonry_mode, true);
    
    $recommend_columns = get_term_meta($term->term_id, $this->_cat_recommend_columns, true);
    $recommend_columns_medium = get_term_meta($term->term_id, $this->_cat_recommend_columns_medium, true);
    $recommend_columns_small = get_term_meta($term->term_id, $this->_cat_recommend_columns_small, true);
    
    $relate_columns = get_term_meta($term->term_id, $this->_cat_relate_columns, true);
    $relate_columns_medium = get_term_meta($term->term_id, $this->_cat_relate_columns_medium, true);
    $relate_columns_small = get_term_meta($term->term_id, $this->_cat_relate_columns_small, true);
    ?>
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_type_view; ?>">
                <?php _e('Type View', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_type_view; ?>" id="<?php echo $this->_cat_type_view; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="grid"<?php echo $cat_type_view == 'grid' ? ' selected' : ''; ?>><?php echo esc_html__('Grid View', 'nasa-core'); ?></option>
                    <option value="list"<?php echo $cat_type_view == 'list' ? ' selected' : ''; ?>><?php echo esc_html__('List View', 'nasa-core'); ?></option>
                    <option value="list-2"<?php echo $cat_type_view == 'list-2' ? ' selected' : ''; ?>><?php echo esc_html__('List View 2 Columns', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>

    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_change_shop_layout; ?>">
                <?php _e('Change Shop Layout Mode', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_change_shop_layout; ?>" id="<?php echo $this->_cat_change_shop_layout; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="shop-default" <?php echo $cat_change_shop_layout == 'shop-default' ? ' selected' : ''; ?>><?php echo esc_html__('Shop Without Background Color', 'nasa-core'); ?></option>
                    <option value="shop-background-color" <?php echo $cat_change_shop_layout == 'shop-background-color' ? ' selected' : ''; ?>><?php echo esc_html__('Shop With Background Color', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>

    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_color_background_shop; ?>"><?php _e('Shop Background Color', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa-view-mode">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_color_background_shop; ?>" name="<?php echo $this->_cat_color_background_shop; ?>" value="<?php echo isset($cat_color_background_shop) ? esc_attr($cat_color_background_shop) : ''; ?>" />
            </div>
       </td>
    </tr>

    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_color_background_shop_pro; ?>"><?php _e('Background Color Of Product Items In The Shop', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa-view-mode">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_color_background_shop_pro; ?>" name="<?php echo $this->_cat_color_background_shop_pro; ?>" value="<?php echo isset($cat_color_background_shop_pro) ? esc_attr($cat_color_background_shop_pro) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_change_view; ?>">
                <?php _e('Change View Mode', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_change_view; ?>" id="<?php echo $this->_cat_change_view; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="1"<?php echo $cat_change_view == 1 ? ' selected' : ''; ?>><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                    <option value="-1"<?php echo $cat_change_view == -1 ? ' selected' : ''; ?>><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
                </select>
            </div>
            
            <p class="description"><?php esc_html_e('Note: This option only uses with Desktop Mode.', 'nasa-core'); ?></p>
            <div class="clear"></div>
        </td>
    </tr>

    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_change_layout_type; ?>">
                <?php _e('Product Column Icon Style', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_change_layout_type; ?>" id="<?php echo $this->_cat_change_layout_type; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="number_view"<?php echo $cat_change_layout_type == 'number_view' ? ' selected' : ''; ?>><?php echo esc_html__('Column Number View', 'nasa-core'); ?></option>
                    <option value="img_view_1"<?php echo $cat_change_layout_type == 'img_view_1' ? ' selected' : ''; ?>><?php echo esc_html__('Column Icon View 1', 'nasa-core'); ?></option>
                    <option value="img_view_2"<?php echo $cat_change_layout_type == 'img_view_2' ? ' selected' : ''; ?>><?php echo esc_html__('Column Icon View 2', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>

    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_change_view; ?>">
                <?php _e('Option Product Column Select To Display', 'nasa-core'); ?>
            </label>
        </th>
        <td>
            <div class="nasa-view-mode">
                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[2-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-2-cols" value="1" <?php echo isset($cat_multicheck_options_cols_display['2-cols']) && $cat_multicheck_options_cols_display['2-cols'] === '1' ? ' checked' : ''; ?>>
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-2-cols"><?php echo esc_html__('2 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[3-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-3-cols" value="1" <?php echo isset($cat_multicheck_options_cols_display['3-cols']) && $cat_multicheck_options_cols_display['3-cols'] === '1' ? ' checked' : ''; ?>>
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-3-cols"><?php echo esc_html__('3 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[4-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-4-cols" value="1" <?php echo isset($cat_multicheck_options_cols_display['4-cols']) && $cat_multicheck_options_cols_display['4-cols'] === '1' ? ' checked' : ''; ?>>
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-4-cols"><?php echo esc_html__('4 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[5-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-5-cols" value="1" <?php echo isset($cat_multicheck_options_cols_display['5-cols']) && $cat_multicheck_options_cols_display['5-cols'] === '1' ? ' checked' : ''; ?>>
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-5-cols"><?php echo esc_html__('5 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[6-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-6-cols"  value="1" <?php echo isset($cat_multicheck_options_cols_display['6-cols']) && $cat_multicheck_options_cols_display['6-cols'] === '1' ? ' checked' : ''; ?>>
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-6-cols"><?php echo esc_html__('6 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[list]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list" value="1" <?php echo isset($cat_multicheck_options_cols_display['list']) && $cat_multicheck_options_cols_display['list'] === '1' ? ' checked' : ''; ?>>
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list"><?php echo esc_html__('List', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[list-2cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list-2cols" value="1" <?php echo isset($cat_multicheck_options_cols_display['list-2cols']) && $cat_multicheck_options_cols_display['list-2cols'] === '1' ? ' checked' : ''; ?>>
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list-2cols"><?php echo esc_html__('List 2 Columns', 'nasa-core'); ?></label><br>
            </div>
            <p class="description"><?php esc_html_e('Note: If no options are selected, this setting will default to theme options.', 'nasa-core'); ?></p>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_per_row; ?>">
                <?php _e('Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_per_row; ?>" id="<?php echo $this->_cat_per_row; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="6-cols"<?php echo $per_row == '6-cols' ? ' selected' : ''; ?>><?php echo esc_html__('6 columns', 'nasa-core'); ?></option>
                    <option value="5-cols"<?php echo $per_row == '5-cols' ? ' selected' : ''; ?>><?php echo esc_html__('5 columns', 'nasa-core'); ?></option>
                    <option value="4-cols"<?php echo $per_row == '4-cols' ? ' selected' : ''; ?>><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                    <option value="3-cols"<?php echo $per_row == '3-cols' ? ' selected' : ''; ?>><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $per_row == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                    
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_per_row_small; ?>">
                <?php _e('Mobile Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_per_row_small; ?>" id="<?php echo $this->_cat_per_row_small; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $per_row_small == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                    <option value="1-cols"<?php echo $per_row_small == '1-cols' ? ' selected' : ''; ?>><?php echo esc_html__('1 column', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_per_row_medium; ?>">
                <?php _e('Tablet Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_per_row_medium; ?>" id="<?php echo $this->_cat_per_row_medium; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="4-cols"<?php echo $per_row_medium == '4-cols' ? ' selected' : ''; ?>><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                    <option value="3-cols"<?php echo $per_row_medium == '3-cols' ? ' selected' : ''; ?>><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $per_row_medium == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_layout_style; ?>">
                <?php _e('Layout Style', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_layout_style; ?>" id="<?php echo $this->_cat_layout_style; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="grid-row"<?php echo $cat_layout_style == 'grid-row' ? ' selected' : ''; ?>><?php echo esc_html__('Grid Rows', 'nasa-core'); ?></option>
                    <option value="masonry-isotope"<?php echo $cat_layout_style == 'masonry-isotope' ? ' selected' : ''; ?>><?php echo esc_html__('Masonry Isotope', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_masonry_mode; ?>">
                <?php _e('Isotope Layout Mode', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_masonry_mode; ?>" id="<?php echo $this->_cat_masonry_mode; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="masonry"<?php echo $cat_masonry_mode == 'masonry' ? ' selected' : ''; ?>><?php echo esc_html__('Masonry', 'nasa-core'); ?></option>
                    <option value="fitRows"<?php echo $cat_masonry_mode == 'fitRows' ? ' selected' : ''; ?>><?php echo esc_html__('Fit Rows', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_recommend_columns; ?>">
                <?php _e('Recommended - Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_recommend_columns; ?>" id="<?php echo $this->_cat_recommend_columns; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="6-cols"<?php echo $recommend_columns == '6-cols' ? ' selected' : ''; ?>><?php echo esc_html__('6 columns', 'nasa-core'); ?></option>
                    <option value="5-cols"<?php echo $recommend_columns == '5-cols' ? ' selected' : ''; ?>><?php echo esc_html__('5 columns', 'nasa-core'); ?></option>
                    <option value="4-cols"<?php echo $recommend_columns == '4-cols' ? ' selected' : ''; ?>><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                    <option value="3-cols"<?php echo $recommend_columns == '3-cols' ? ' selected' : ''; ?>><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $recommend_columns == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                    
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_recommend_columns_small; ?>">
                <?php _e('Recommended - Mobile Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_recommend_columns_small; ?>" id="<?php echo $this->_cat_recommend_columns_small; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $recommend_columns_small == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                    <option value="1.5-cols"<?php echo $recommend_columns_small == '1.5-cols' ? ' selected' : ''; ?>><?php echo esc_html__('1.5 column', 'nasa-core'); ?></option>
                    <option value="1-cols"<?php echo $recommend_columns_small == '1-cols' ? ' selected' : ''; ?>><?php echo esc_html__('1 column', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_recommend_columns_medium; ?>">
                <?php _e('Recommended - Tablet Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_recommend_columns_medium; ?>" id="<?php echo $this->_cat_recommend_columns_medium; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="4-cols"<?php echo $recommend_columns_medium == '4-cols' ? ' selected' : ''; ?>><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                    <option value="3-cols"<?php echo $recommend_columns_medium == '3-cols' ? ' selected' : ''; ?>><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $recommend_columns_medium == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_relate_columns; ?>">
                <?php _e('Related - Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_relate_columns; ?>" id="<?php echo $this->_cat_relate_columns; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="6-cols"<?php echo $relate_columns == '6-cols' ? ' selected' : ''; ?>><?php echo esc_html__('6 columns', 'nasa-core'); ?></option>
                    <option value="5-cols"<?php echo $relate_columns == '5-cols' ? ' selected' : ''; ?>><?php echo esc_html__('5 columns', 'nasa-core'); ?></option>
                    <option value="4-cols"<?php echo $relate_columns == '4-cols' ? ' selected' : ''; ?>><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                    <option value="3-cols"<?php echo $relate_columns == '3-cols' ? ' selected' : ''; ?>><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $relate_columns == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                    
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_relate_columns_small; ?>">
                <?php _e('Related - Mobile Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_relate_columns_small; ?>" id="<?php echo $this->_cat_relate_columns_small; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $relate_columns_small == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                    <option value="1.5-cols"<?php echo $relate_columns_small == '1.5-cols' ? ' selected' : ''; ?>><?php echo esc_html__('1.5 column', 'nasa-core'); ?></option>
                    <option value="1-cols"<?php echo $relate_columns_small == '1-cols' ? ' selected' : ''; ?>><?php echo esc_html__('1 column', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_relate_columns_medium; ?>">
                <?php _e('Related - Tablet Columns', 'nasa-core'); ?>
            </label>
        </th>
        
        <td>
            <div class="nasa-view-mode">
                <select name="<?php echo $this->_cat_relate_columns_medium; ?>" id="<?php echo $this->_cat_relate_columns_medium; ?>" class="postform">
                    <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="4-cols"<?php echo $relate_columns_medium == '4-cols' ? ' selected' : ''; ?>><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                    <option value="3-cols"<?php echo $relate_columns_medium == '3-cols' ? ' selected' : ''; ?>><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                    <option value="2-cols"<?php echo $relate_columns_medium == '2-cols' ? ' selected' : ''; ?>><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr class="space-admin nasa-term-root hidden-tag ns-advance-field"><td colspan="2"></td></tr>
    <?php
} else {
    ?>
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_type_view; ?>">
            <?php _e('Type View', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_type_view; ?>" id="<?php echo $this->_cat_type_view; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="grid"><?php echo esc_html__('Grid View', 'nasa-core'); ?></option>
                <option value="list"><?php echo esc_html__('List View', 'nasa-core'); ?></option>
                <option value="list-2"><?php echo esc_html__('List View 2 Columns', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_type_view; ?>">
            <?php _e('Change Shop Layout Mode', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_type_view; ?>" id="<?php echo $this->_cat_type_view; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="shop-default"><?php echo esc_html__('Shop Without Background Color', 'nasa-core'); ?></option>
                <option value="shop-background-color"><?php echo esc_html__('Shop With Background Color', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_change_view; ?>">
            <?php _e('Change View Mode', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_change_view; ?>" id="<?php echo $this->_cat_change_view; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="1"><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                <option value="-1"><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
            </select>
        </div>
        
        <p class="description"><?php esc_html_e('Note: This option only uses with Desktop Mode.', 'nasa-core'); ?></p>
        <div class="clear"></div>
    </div>

    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_change_layout_type; ?>">
            <?php _e('Product Column Icon Style', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_change_layout_type; ?>" id="<?php echo $this->_cat_change_layout_type; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="number_view"><?php echo esc_html__('Column Number View', 'nasa-core'); ?></option>
                <option value="img_view_1"><?php echo esc_html__('Column Icon View 1', 'nasa-core'); ?></option>
                <option value="img_view_2"><?php echo esc_html__('Column Icon View 1', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_color_background_shop; ?>"><?php _e('Shop Background Color', 'nasa-core'); ?></label>
        <div class="nasa-view-mode">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_color_background_shop; ?>" name="<?php echo $this->_cat_color_background_shop; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_color_background_shop_pro; ?>"><?php _e('Background Color Of Product Items In The Shop', 'nasa-core'); ?></label>
        <div class="nasa-view-mode">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_color_background_shop_pro; ?>" name="<?php echo $this->_cat_color_background_shop_pro; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>

    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>">
            <?php _e('Option Product Column Select To Display', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[2-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-2-cols" value="1">
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-2-cols"><?php echo esc_html__('2 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[3-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-3-cols" value="1">
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-3-cols"><?php echo esc_html__('3 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[4-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-4-cols" value="1">
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-4-cols"><?php echo esc_html__('4 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[5-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-5-cols" value="1">
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-5-cols"><?php echo esc_html__('5 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[6-cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-6-cols"  value="1">
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-6-cols"><?php echo esc_html__('6 Columns', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[list]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list" value="1">
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list"><?php echo esc_html__('List', 'nasa-core'); ?></label><br>

                <input type="checkbox" class="postform" name="<?php echo $this->_cat_multicheck_options_cols_display; ?>[list-2cols]" id="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list-2cols" value="1">
                <label for="<?php echo $this->_cat_multicheck_options_cols_display; ?>-list-2cols"><?php echo esc_html__('List 2 Columns', 'nasa-core'); ?></label><br>
        </div>
        <p class="description"><?php esc_html_e('Note: If no options are selected, this setting will default to theme options.', 'nasa-core'); ?></p>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_per_row; ?>">
            <?php _e('Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_per_row; ?>" id="<?php echo $this->_cat_per_row; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="6-cols"><?php echo esc_html__('6 columns', 'nasa-core'); ?></option>
                <option value="5-cols"><?php echo esc_html__('5 columns', 'nasa-core'); ?></option>
                <option value="4-cols"><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                <option value="3-cols"><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_per_row_small; ?>">
            <?php _e('Mobile Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_per_row_small; ?>" id="<?php echo $this->_cat_per_row_small; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                <option value="1-cols"><?php echo esc_html__('1 column', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_per_row_medium; ?>">
            <?php _e('Tablet Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_per_row_medium; ?>" id="<?php echo $this->_cat_per_row_medium; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="4-cols"><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                <option value="3-cols"><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_layout_style; ?>">
            <?php _e('Layout Style', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_layout_style; ?>" id="<?php echo $this->_cat_layout_style; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="grid-row"><?php echo esc_html__('Grid Rows', 'nasa-core'); ?></option>
                <option value="masonry-isotope"><?php echo esc_html__('Masonry Isotope', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_masonry_mode; ?>">
            <?php _e('Isotope Layout Mode', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_masonry_mode; ?>" id="<?php echo $this->_cat_masonry_mode; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="masonry"><?php echo esc_html__('Masonry', 'nasa-core'); ?></option>
                <option value="fitRows"><?php echo esc_html__('Fit Rows', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_recommend_columns; ?>">
            <?php _e('Recommended - Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_recommend_columns; ?>" id="<?php echo $this->_cat_recommend_columns; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="6-cols"><?php echo esc_html__('6 columns', 'nasa-core'); ?></option>
                <option value="5-cols"><?php echo esc_html__('5 columns', 'nasa-core'); ?></option>
                <option value="4-cols"><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                <option value="3-cols"><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_recommend_columns_small; ?>">
            <?php _e('Recommended - Mobile Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_recommend_columns_small; ?>" id="<?php echo $this->_cat_recommend_columns_small; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                <option value="1.5-cols"><?php echo esc_html__('1.5 column', 'nasa-core'); ?></option>
                <option value="1-cols"><?php echo esc_html__('1 column', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_recommend_columns_medium; ?>">
            <?php _e('Recommended - Tablet Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_recommend_columns_medium; ?>" id="<?php echo $this->_cat_recommend_columns_medium; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="4-cols"><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                <option value="3-cols"><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_relate_columns; ?>">
            <?php _e('Related - Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_relate_columns; ?>" id="<?php echo $this->_cat_relate_columns; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="6-cols"><?php echo esc_html__('6 columns', 'nasa-core'); ?></option>
                <option value="5-cols"><?php echo esc_html__('5 columns', 'nasa-core'); ?></option>
                <option value="4-cols"><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                <option value="3-cols"><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_relate_columns_small; ?>">
            <?php _e('Related - Mobile Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_relate_columns_small; ?>" id="<?php echo $this->_cat_relate_columns_small; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
                <option value="1.5-cols"><?php echo esc_html__('1.5 column', 'nasa-core'); ?></option>
                <option value="1-cols"><?php echo esc_html__('1 column', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_relate_columns_medium; ?>">
            <?php _e('Related - Tablet Columns', 'nasa-core'); ?>
        </label>
        
        <div class="nasa-view-mode">
            <select name="<?php echo $this->_cat_relate_columns_medium; ?>" id="<?php echo $this->_cat_relate_columns_medium; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="4-cols"><?php echo esc_html__('4 columns', 'nasa-core'); ?></option>
                <option value="3-cols"><?php echo esc_html__('3 columns', 'nasa-core'); ?></option>
                <option value="2-cols"><?php echo esc_html__('2 columns', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="space-admin nasa-term-root hidden-tag ns-advance-field"></div>
    <?php
}
