<?php
global $nasa_opt;

$header_builder = nasa_get_headers_options();
$header_builder_e = nasa_get_headers_elementor();
$footer_builder = nasa_get_footers_options();
$footer_builder_e = nasa_get_footers_elementor();
$menu_options = nasa_meta_get_list_menus();
$blocks = nasa_get_blocks_options();

$footer_desk = $footer_builder;
if (isset($footer_desk[''])) {
    unset($footer_desk['']);
}

if (is_object($term) && $term) {
    
    $cat_header_type = get_term_meta($term->term_id, $this->_cat_header_type, true);
    if (!isset($cat_header_type)) {
        $cat_header_type = add_term_meta($term->term_id, $this->_cat_header_type, '', true);
    }

    $cat_the_block_beside_main_menu_4_6 = get_term_meta($term->term_id, $this->_cat_the_block_beside_main_menu_4_6, true);
    if (!isset($cat_the_block_beside_main_menu_4_6)) {
        $cat_the_block_beside_main_menu_4_6 = add_term_meta($term->term_id, $this->_cat_the_block_beside_main_menu_4_6, '', true);
    }

    $cat_header_builder = get_term_meta($term->term_id, $this->_cat_header_builder, true);
    if (!isset($cat_header_builder)) {
        $cat_header_builder = add_term_meta($term->term_id, $this->_cat_header_builder, '', true);
    }
    
    $cat_header_e = get_term_meta($term->term_id, $this->_cat_header_elm, true);
    if (!isset($cat_header_e)) {
        $cat_header_e = add_term_meta($term->term_id, $this->_cat_header_elm, '', true);
    }

    $cat_header_vertical_menu = get_term_meta($term->term_id, $this->_cat_header_vertical_menu, true);
    if (!isset($cat_header_vertical_menu)) {
        $cat_header_vertical_menu = add_term_meta($term->term_id, $this->_cat_header_vertical_menu, '', true);
    }
    
    $vmenu_root = get_term_meta($term->term_id, $this->_cat_header_vertical_menu_root, true);
    if (!isset($vmenu_root)) {
        $vmenu_root = add_term_meta($term->term_id, $this->_cat_header_vertical_menu_root, '', true);
    }
    
    $vroot_limit = get_term_meta($term->term_id, $this->_cat_header_vertical_menu_root_limit, true);
    if (!isset($vroot_limit)) {
        $vroot_limit = add_term_meta($term->term_id, $this->_cat_header_vertical_menu_root_limit, '', true);
    }
    
    $cat_topbar_on = get_term_meta($term->term_id, $this->_cat_topbar_on, true);
    if (!isset($cat_topbar_on)) {
        $cat_topbar_on = add_term_meta($term->term_id, $this->_cat_topbar_on, '', true);
    }
    
    $head_bg_color = get_term_meta($term->term_id, $this->_cat_header_bg_color, true);
    if (!isset($head_bg_color)) {
        $head_bg_color = add_term_meta($term->term_id, $this->_cat_header_bg_color, '', true);
    }
    
    $head_bg_color_stk = get_term_meta($term->term_id, $this->_cat_header_bg_color_stk, true);
    if (!isset($head_bg_color_stk)) {
        $head_bg_color_stk = add_term_meta($term->term_id, $this->_cat_header_bg_color_stk, '', true);
    }
    
    $head_text_color = get_term_meta($term->term_id, $this->_cat_header_text_color, true);
    if (!isset($head_text_color)) {
        $head_text_color = add_term_meta($term->term_id, $this->_cat_header_text_color, '', true);
    }
    
    $head_text_color_stk = get_term_meta($term->term_id, $this->_cat_header_text_color_stk, true);
    if (!isset($head_text_color_stk)) {
        $head_text_color_stk = add_term_meta($term->term_id, $this->_cat_header_text_color_stk, '', true);
    }
    
    $head_text_color_hv = get_term_meta($term->term_id, $this->_cat_header_text_color_hv, true);
    if (!isset($head_text_color_hv)) {
        $head_text_color = add_term_meta($term->term_id, $this->_cat_header_text_color_hv, '', true);
    }
    
    $head_text_color_hv_stk = get_term_meta($term->term_id, $this->_cat_header_text_color_hv_stk, true);
    if (!isset($head_text_color_hv_stk)) {
        $head_text_color_stk = add_term_meta($term->term_id, $this->_cat_header_text_color_hv_stk, '', true);
    }
    
    $head_topbar_bg = get_term_meta($term->term_id, $this->_cat_topbar_bg_color, true);
    if (!isset($head_topbar_bg)) {
        $head_topbar_bg = add_term_meta($term->term_id, $this->_cat_topbar_bg_color, '', true);
    }
    
    $head_topbar_text = get_term_meta($term->term_id, $this->_cat_topbar_text_color, true);
    if (!isset($head_topbar_text)) {
        $head_topbar_text = add_term_meta($term->term_id, $this->_cat_topbar_text_color, '', true);
    }
    
    $head_topbar_text_hv = get_term_meta($term->term_id, $this->_cat_topbar_text_color_hv, true);
    if (!isset($head_topbar_text_hv)) {
        $head_topbar_text_hv = add_term_meta($term->term_id, $this->_cat_topbar_text_color_hv, '', true);
    }
    
    $head_mmemu_bg = get_term_meta($term->term_id, $this->_cat_main_menu_bg, true);
    if (!isset($head_mmemu_bg)) {
        $head_mmemu_bg = add_term_meta($term->term_id, $this->_cat_main_menu_bg, '', true);
    }
    
    $head_mmemu_bg_stk = get_term_meta($term->term_id, $this->_cat_main_menu_bg_stk, true);
    if (!isset($head_mmemu_bg_stk)) {
        $head_mmemu_bg_stk = add_term_meta($term->term_id, $this->_cat_main_menu_bg_stk, '', true);
    }
    
    $head_mmemu_text = get_term_meta($term->term_id, $this->_cat_main_menu_text, true);
    if (!isset($head_mmemu_text)) {
        $head_mmemu_text = add_term_meta($term->term_id, $this->_cat_main_menu_text, '', true);
    }
    
    $head_mmemu_text_stk = get_term_meta($term->term_id, $this->_cat_main_menu_text_stk, true);
    if (!isset($head_mmemu_text_stk)) {
        $head_mmemu_text_stk = add_term_meta($term->term_id, $this->_cat_main_menu_text_stk, '', true);
    }
    
    $head_vmemu_bg = get_term_meta($term->term_id, $this->_cat_v_menu_bg, true);
    if (!isset($head_vmemu_bg)) {
        $head_vmemu_bg = add_term_meta($term->term_id, $this->_cat_v_menu_bg, '', true);
    }
    
    $head_vmemu_bg_stk = get_term_meta($term->term_id, $this->_cat_v_menu_bg_stk, true);
    if (!isset($head_vmemu_bg_stk)) {
        $head_vmemu_bg_stk = add_term_meta($term->term_id, $this->_cat_v_menu_bg_stk, '', true);
    }
    
    $head_vmemu_text = get_term_meta($term->term_id, $this->_cat_v_menu_text, true);
    if (!isset($head_vmemu_text)) {
        $head_vmemu_text = add_term_meta($term->term_id, $this->_cat_v_menu_text, '', true);
    }
    
    $head_vmemu_text_stk = get_term_meta($term->term_id, $this->_cat_v_menu_text_stk, true);
    if (!isset($head_vmemu_text_stk)) {
        $head_vmemu_text_stk = add_term_meta($term->term_id, $this->_cat_v_menu_text_stk, '', true);
    }

    $cat_footer_mode = get_term_meta($term->term_id, $this->_cat_footer_mode, true);
    if (!isset($cat_footer_mode)) {
        $cat_footer_mode = add_term_meta($term->term_id, $this->_cat_footer_mode, '', true);
    }

    $cat_popup_static_block = get_term_meta($term->term_id, $this->_cat_popup_static_block, true);
    if (!isset($cat_popup_static_block)) {
        $cat_popup_static_block = add_term_meta($term->term_id, $this->_cat_popup_static_block, '', true);
    }
    
    $cat_footer_build_in = get_term_meta($term->term_id, $this->_cat_footer_build_in, true);
    if (!isset($cat_footer_build_in)) {
        $cat_footer_build_in = add_term_meta($term->term_id, $this->_cat_footer_build_in, '', true);
    }

    $cat_footer_build_in_mobile = get_term_meta($term->term_id, $this->_cat_footer_build_in_mobile, true);
    if (!isset($cat_footer_build_in_mobile)) {
        $cat_footer_build_in_mobile = add_term_meta($term->term_id, $this->_cat_footer_build_in_mobile, '', true);
    }
    
    $cat_footer_type = get_term_meta($term->term_id, $this->_cat_footer_type, true);
    if (!isset($cat_footer_type)) {
        $cat_footer_type = add_term_meta($term->term_id, $this->_cat_footer_type, '', true);
    }

    $cat_footer_mobile = get_term_meta($term->term_id, $this->_cat_footer_mobile, true);
    if (!isset($cat_footer_mobile)) {
        $cat_footer_mobile = add_term_meta($term->term_id, $this->_cat_footer_mobile, '', true);
    }
    
    $cat_footer_e = get_term_meta($term->term_id, $this->_cat_footer_builder_e, true);
    if (!isset($cat_footer_e)) {
        $cat_footer_e = add_term_meta($term->term_id, $this->_cat_footer_builder_e, '', true);
    }

    $cat_footer_e_mobile = get_term_meta($term->term_id, $this->_cat_footer_builder_e_mobile, true);
    if (!isset($cat_footer_e_mobile)) {
        $cat_footer_e_mobile = add_term_meta($term->term_id, $this->_cat_footer_builder_e_mobile, '', true);
    }
    ?>
    <!-- Header type -->
    <tr class="form-field nasa-term-root hidden-tag term-cat_header-type-wrap ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_type; ?>"><?php esc_html_e('Header Type', 'nasa-core'); ?></label>
        </th>
        <td>
            <?php
            $selected = isset($cat_header_type) ? $cat_header_type : '';
            echo '<p><select id="' . $this->_cat_header_type . '" name="' . $this->_cat_header_type . '">';
            
            echo '<option value="">' . esc_html__("Default", 'nasa-core') . '</option>';
            
            echo '<option value="1"' . ($selected == '1' ? ' selected' : '') . '>' . esc_html__('Header Type 1', 'nasa-core') . '</option>';
            echo '<option value="2"' . ($selected == '2' ? ' selected' : '') . '>' . esc_html__('Header Type 2', 'nasa-core') . '</option>';
            echo '<option value="3"' . ($selected == '3' ? ' selected' : '') . '>' . esc_html__('Header Type 3', 'nasa-core') . '</option>';
            echo '<option value="4"' . ($selected == '4' ? ' selected' : '') . '>' . esc_html__('Header Type 4', 'nasa-core') . '</option>';
            echo '<option value="5"' . ($selected == '5' ? ' selected' : '') . '>' . esc_html__('Header Type 5', 'nasa-core') . '</option>';
            echo '<option value="6"' . ($selected == '6' ? ' selected' : '') . '>' . esc_html__('Header Type 6', 'nasa-core') . '</option>';
            echo '<option value="7"' . ($selected == '7' ? ' selected' : '') . '>' . esc_html__('Header Type 7', 'nasa-core') . '</option>';
            
            echo NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true) ? '<option value="nasa-custom"' . ($selected == 'nasa-custom' ? ' selected' : '') . '>' . esc_html__('Header WPBakery Builder', 'nasa-core') . '</option>' : '';
            echo NASA_HF_BUILDER ? '<option value="nasa-elm"' . ($selected == 'nasa-elm' ? ' selected' : '') . '>' . esc_html__('Header Elementor Builder', 'nasa-core') . '</option>' : '';
            
            echo '</select></p>';
            ?>
        </td>
    </tr>

    <!-- The Block beside Main menu in Header Type 4, 6 -->
    <tr class="form-field hidden-tag term-cat_the_block_beside_main_menu_4_6-wrap nasa-term-root-child <?php echo $this->_cat_header_type . ' nasa-term-' . $this->_cat_header_type . '-4' . ' nasa-term-' . $this->_cat_header_type . '-6'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_the_block_beside_main_menu_4_6; ?>"><?php esc_html_e('The Block beside Main menu in Header Type 4, 6', 'nasa-core'); ?></label>
        </th>
        <td>           
            <?php
            if ($blocks) {
                $selected = isset($cat_the_block_beside_main_menu_4_6) ? $cat_the_block_beside_main_menu_4_6 : '';
                echo '<p><select id="' . $this->_cat_the_block_beside_main_menu_4_6 . '" name="' . $this->_cat_the_block_beside_main_menu_4_6 . '" class="nasa-ad-select-2">';
                foreach ($blocks as $slug => $name) {
                    echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
                }
                echo '</select></p>';
            }
            ?>
            <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
        </td>
    </tr>
    
    <tr class="form-field term-cat_header-builder-wrap nasa-term-root-child <?php echo $this->_cat_header_type . ' nasa-term-' . $this->_cat_header_type . '-nasa-custom'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_builder; ?>"><?php esc_html_e('Header Theme Builder', 'nasa-core'); ?></label>
        </th>
        <td>
            <?php
            $selected = isset($cat_header_builder[0]) ? $cat_header_builder[0] : '';
            echo '<p><select id="' . $this->_cat_header_builder . '" name="' . $this->_cat_header_builder . '">';
            foreach ($header_builder as $slug => $name) {
                echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    
    <tr class="form-field term-cat_header-builder-wrap nasa-term-root-child <?php echo $this->_cat_header_type . ' nasa-term-' . $this->_cat_header_type . '-nasa-elm'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_elm; ?>"><?php esc_html_e('Header Elementor Builder', 'nasa-core'); ?></label>
        </th>
        <td>
            <?php
            $selected = isset($cat_header_e[0]) ? $cat_header_e[0] : '';
            echo '<p><select id="' . $this->_cat_header_elm . '" name="' . $this->_cat_header_elm . '">';
            foreach ($header_builder_e as $slug => $name) {
                echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Header type -->

    <!-- Vertical Menu -->
    <tr class="form-field nasa-term-root hidden-tag term-cat_header-vertical-menu-wrap ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_vertical_menu; ?>"><?php esc_html_e('Header Vertical Menu', 'nasa-core'); ?></label>
        </th>
        <td>
            <?php
            $selected = isset($cat_header_vertical_menu) ? $cat_header_vertical_menu : '';
            echo '<p><select id="' . $this->_cat_header_vertical_menu . '" name="' . $this->_cat_header_vertical_menu . '">';
            foreach ($menu_options as $id => $name) {
                echo '<option value="' . $id . '"' . ($selected == $id ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Vertical Menu -->
    
    <!-- Vertical Menu Root -->
    <tr class="form-field vertical-menu-root nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_vertical_menu_root; ?>"><?php _e('Vertical Menu Root', 'nasa-core'); ?></label>
        </th>
        
        <td>
            <div class="nasa_vertical-menu-root ns-advance-field">
                <select name="<?php echo $this->_cat_header_vertical_menu_root; ?>" id="<?php echo $this->_cat_header_vertical_menu_root; ?>" class="postform">
                    <option value=""<?php echo $vmenu_root == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="1"<?php echo $vmenu_root == '1' ? ' selected' : ''; ?>><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                    <option value="2"<?php echo $vmenu_root == '2' ? ' selected' : ''; ?>><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    <!-- End Vertical Menu Root -->
    
    <!-- Vertical Menu Root - Limit -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row">
            <label for="<?php echo $this->_cat_header_vertical_menu_root_limit; ?>"><?php _e('Vertical Menu Root Items - Limit', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_vroot-limit">
                <input name="<?php echo $this->_cat_header_vertical_menu_root_limit; ?>" id="<?php echo $this->_cat_header_vertical_menu_root_limit; ?>" type="text" value="<?php echo $vroot_limit; ?>" size="40" />
            </div>
            
            <div class="clear"></div>
       </td>
    </tr>
    <!-- End Vertical Menu Root - Limit -->
    
    <!-- Topbar -->
    <tr class="form-field topbar_on nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_topbar_on; ?>"><?php _e('Top Bar', 'nasa-core'); ?></label>
        </th>
        
        <td>
            <div class="nasa_topbar_on">
                <select name="<?php echo $this->_cat_topbar_on; ?>" id="<?php echo $this->_cat_topbar_on; ?>" class="postform">
                    <option value=""<?php echo $cat_topbar_on == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                    <option value="1"<?php echo $cat_topbar_on == '1' ? ' selected' : ''; ?>><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                    <option value="2"<?php echo $cat_topbar_on == '2' ? ' selected' : ''; ?>><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
                </select>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    <!-- End Topbar on -->
    
    <!-- Header BG Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_bg_color; ?>"><?php _e('Header Background', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_bg_color; ?>" name="<?php echo $this->_cat_header_bg_color; ?>" value="<?php echo isset($head_bg_color) ? esc_attr($head_bg_color) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_bg_color_stk; ?>"><?php _e('Header Background - Sticky', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_bg_color_stk; ?>" name="<?php echo $this->_cat_header_bg_color_stk; ?>" value="<?php echo isset($head_bg_color_stk) ? esc_attr($head_bg_color_stk) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- End Header BG Color -->
    
    <!-- Header Text Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_text_color; ?>"><?php _e('Header Text', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color; ?>" name="<?php echo $this->_cat_header_text_color; ?>" value="<?php echo isset($head_text_color) ? esc_attr($head_text_color) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_text_color_stk; ?>"><?php _e('Header Text - Sticky', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color_stk; ?>" name="<?php echo $this->_cat_header_text_color_stk; ?>" value="<?php echo isset($head_text_color_stk) ? esc_attr($head_text_color_stk) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- End Header Text Color -->
    
    <!-- Header Text Color Hover -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_text_color_hv; ?>"><?php _e('Header Text Hover', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color_hv; ?>" name="<?php echo $this->_cat_header_text_color_hv; ?>" value="<?php echo isset($head_text_color_hv) ? esc_attr($head_text_color_hv) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header_text_color_hv_stk; ?>"><?php _e('Header Text Hover - Sticky', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color_hv_stk; ?>" name="<?php echo $this->_cat_header_text_color_hv_stk; ?>" value="<?php echo isset($head_text_color_hv_stk) ? esc_attr($head_text_color_hv_stk) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- End Header Text Color Hover -->
    
    <!-- Topbar BG Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_topbar_bg_color; ?>"><?php _e('Top Bar Background', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_topbar_bg_color; ?>" name="<?php echo $this->_cat_topbar_bg_color; ?>" value="<?php echo isset($head_topbar_bg) ? esc_attr($head_topbar_bg) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- End Topbar BG Color -->
    
    <!-- Topbar Text Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_topbar_text_color; ?>"><?php _e('Top Bar Text', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_topbar_text_color; ?>" name="<?php echo $this->_cat_topbar_text_color; ?>" value="<?php echo isset($head_topbar_text) ? esc_attr($head_topbar_text) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- Topbar Text Color -->
    
    <!-- Topbar Text Color Hover -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_topbar_text_color_hv; ?>"><?php _e('Top Bar Text Hover', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_topbar_text_color_hv; ?>" name="<?php echo $this->_cat_topbar_text_color_hv; ?>" value="<?php echo isset($head_topbar_text) ? esc_attr($head_topbar_text) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- Topbar Text Color Hover -->
    
    <!-- Main menu BG Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_main_menu_bg; ?>"><?php _e('Main Menu Background', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_bg; ?>" name="<?php echo $this->_cat_main_menu_bg; ?>" value="<?php echo isset($head_mmemu_bg) ? esc_attr($head_mmemu_bg) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_main_menu_bg_stk; ?>"><?php _e('Main Menu Background - Sticky', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_bg_stk; ?>" name="<?php echo $this->_cat_main_menu_bg_stk; ?>" value="<?php echo isset($head_mmemu_bg_stk) ? esc_attr($head_mmemu_bg_stk) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- End Main menu BG Color -->
    
    <!-- Main menu Text Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_main_menu_text; ?>"><?php _e('Main Menu Text', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_text; ?>" name="<?php echo $this->_cat_main_menu_text; ?>" value="<?php echo isset($head_mmemu_text) ? esc_attr($head_mmemu_text) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_main_menu_text_stk; ?>"><?php _e('Main Menu Text - Sticky', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_text_stk; ?>" name="<?php echo $this->_cat_main_menu_text_stk; ?>" value="<?php echo isset($head_mmemu_text_stk) ? esc_attr($head_mmemu_text_stk) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- Main menu Text Color -->
    
    <!-- Vertical menu BG Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_v_menu_bg; ?>"><?php _e('Vertical Menu Background', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_bg; ?>" name="<?php echo $this->_cat_v_menu_bg; ?>" value="<?php echo isset($head_vmemu_bg) ? esc_attr($head_vmemu_bg) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_v_menu_bg_stk; ?>"><?php _e('Vertical Menu Background - Sticky', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_bg_stk; ?>" name="<?php echo $this->_cat_v_menu_bg_stk; ?>" value="<?php echo isset($head_vmemu_bg_stk) ? esc_attr($head_vmemu_bg_stk) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- End Vertical menu BG Color -->
    
    <!-- Vertical menu Text Color -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_v_menu_text; ?>"><?php _e('Vertical Menu Text', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_text; ?>" name="<?php echo $this->_cat_v_menu_text; ?>" value="<?php echo isset($head_vmemu_text) ? esc_attr($head_vmemu_text) : ''; ?>" />
            </div>
       </td>
    </tr>
    
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_v_menu_text_stk; ?>"><?php _e('Vertical Menu Text - Sticky', 'nasa-core'); ?></label>
        </th>
        <td>
            <div class="nasa_p_color">
                <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_text_stk; ?>" name="<?php echo $this->_cat_v_menu_text_stk; ?>" value="<?php echo isset($head_vmemu_text_stk) ? esc_attr($head_vmemu_text_stk) : ''; ?>" />
            </div>
       </td>
    </tr>
    <!-- Vertical menu Text Color -->
    
    <tr class="space-admin nasa-term-root hidden-tag ns-advance-field"><td colspan="2"></td></tr>
    
    <!-- Footer Mode -->
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_footer_mode; ?>"><?php esc_html_e('Footer Mode', 'nasa-core'); ?></label>
        </th>
        <td>
            <?php
            $selected = isset($cat_footer_mode) ? $cat_footer_mode : '';
            echo '<p><select id="' . $this->_cat_footer_mode . '" name="' . $this->_cat_footer_mode . '">';
            echo '<option value="">' . esc_html__("Default", 'nasa-core') . '</option>';
            
            echo (isset($nasa_opt['f_buildin']) && $nasa_opt['f_buildin']) ? '<option value="build-in"' . ($selected == 'build-in' ? ' selected' : '') . '>' . esc_html__('Built-in', 'nasa-core') . '</option>' : '';
            
            echo NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true) ? '<option value="builder"' . ($selected == 'builder' ? ' selected' : '') . '>' . esc_html__('Builder - Support WPBakery', 'nasa-core') . '</option>' : '';
            
            echo NASA_HF_BUILDER ? '<option value="builder-e"' . ($selected == 'builder-e' ? ' selected' : '') . '>' . esc_html__('Builder - Support HFE-Elementor', 'nasa-core') . '</option>' : '';
            
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Footer mode -->

    <!-- Footer build-in -->
    <tr class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-build-in'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_footer_build_in; ?>"><?php esc_html_e('Footer Built-in', 'nasa-core'); ?></label>
        </th>
        <td>
            <?php
            $selected = isset($cat_footer_build_in) ? $cat_footer_build_in : '';
            echo '<p><select id="' . $this->_cat_footer_build_in . '" name="' . $this->_cat_footer_build_in . '">';
            echo '<option value="1"' . ($selected == '1' ? ' selected' : '') . '>' . esc_html__('Built-in Light 1', 'nasa-core') . '</option>';
            echo '<option value="2"' . ($selected == '2' ? ' selected' : '') . '>' . esc_html__('Built-in Light 2', 'nasa-core') . '</option>';
            echo '<option value="3"' . ($selected == '3' ? ' selected' : '') . '>' . esc_html__('Built-in Light 3', 'nasa-core') . '</option>';
            echo '<option value="4"' . ($selected == '4' ? ' selected' : '') . '>' . esc_html__('Built-in Dark', 'nasa-core') . '</option>';
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Footer build-in -->

    <!-- Footer build-in mobile -->
    <tr class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-build-in'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_footer_build_in_mobile; ?>"><?php esc_html_e('Footer Built-in Mobile', 'nasa-core'); ?></label>
        </th>
        <td>
            <?php
            $selected = isset($cat_footer_build_in_mobile) ? $cat_footer_build_in_mobile : '';
            echo '<p><select id="' . $this->_cat_footer_build_in_mobile . '" name="' . $this->_cat_footer_build_in_mobile . '">';
            echo '<option value="">' . esc_html__('Extends from Desktop', 'nasa-core') . '</option>';
            echo '<option value="m-1"' . ($selected == 'm-1' ? ' selected' : '') . '>' . esc_html__('Built-in Mobile', 'nasa-core') . '</option>';
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Footer build-in mobile -->

    <!-- Footer Builder -->
    <tr class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_footer_type; ?>"><?php esc_html_e('Footer Builder', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            $selected = isset($cat_footer_type) ? $cat_footer_type : '';
            echo '<p><select id="' . $this->_cat_footer_type . '" name="' . $this->_cat_footer_type . '">';
            foreach ($footer_desk as $slug => $name) {
                echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Footer Builder -->

    <!-- Footer Builder Mobile -->
    <tr class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_footer_mobile; ?>"><?php esc_html_e('Footer Builder Mobile', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            $selected = isset($cat_footer_mobile) ? $cat_footer_mobile : '';
            echo '<p><select id="' . $this->_cat_footer_mobile . '" name="' . $this->_cat_footer_mobile . '">';
            foreach ($footer_builder as $slug => $name) {
                echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Footer Builder Mobile -->
    
    <!-- Footer Builder Elementor -->
    <tr class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder-e'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_footer_builder_e; ?>"><?php esc_html_e('Footer Builder Elementor', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            $selected = isset($cat_footer_e) ? $cat_footer_e : '';
            echo '<p><select id="' . $this->_cat_footer_builder_e . '" name="' . $this->_cat_footer_builder_e . '">';
            foreach ($footer_builder_e as $fid => $name) {
                echo '<option value="' . $fid . '"' . ($selected == $fid ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    <!-- End Footer Builder Elementor -->

    <!-- Footer Builder Elementor Mobile -->
    <tr class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder-e'; ?> hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_footer_builder_e_mobile; ?>"><?php esc_html_e('Footer Builder Elementor Mobile', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            $selected = isset($cat_footer_e_mobile) ? $cat_footer_e_mobile : '';
            echo '<p><select id="' . $this->_cat_footer_builder_e_mobile . '" name="' . $this->_cat_footer_builder_e_mobile . '">';
            foreach ($footer_builder_e as $fid => $name) {
                echo '<option value="' . $fid . '"' . ($selected == $fid ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    
    <!-- Popup Static Block -->
    <tr class="form-field nasa-term-root hidden-tag term-cat_popup_static_block-wrap ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_popup_static_block; ?>"><?php esc_html_e('Popup Static Block', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            if ($blocks) {
                $selected = isset($cat_popup_static_block) ? $cat_popup_static_block : '';
                echo '<p><select id="' . $this->_cat_popup_static_block . '" name="' . $this->_cat_popup_static_block . '" class="nasa-ad-select-2">';
                foreach ($blocks as $slug => $name) {
                    echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
                }
                echo '</select></p>';
            }
            ?>
            <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
        </td>
    </tr>
    <!-- End Popup Static Block -->
    
    <tr class="space-admin nasa-term-root hidden-tag ns-advance-field"><td colspan="2"></td></tr>
    <!-- End Footer Builder Elementor Mobile -->
    <?php
} else {
    ?>
    <!-- Header type -->
    <div class="form-field term-cat_header-type-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_type; ?>"><?php esc_html_e('Header Type', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_header_type . '" name="' . $this->_cat_header_type . '">';
        
        echo '<option value="">' . esc_html__("Default", 'nasa-core') . '</option>';
        
        echo '<option value="1">' . esc_html__('Header Type 1', 'nasa-core') . '</option>';
        echo '<option value="2">' . esc_html__('Header Type 2', 'nasa-core') . '</option>';
        echo '<option value="3">' . esc_html__('Header Type 3', 'nasa-core') . '</option>';
        echo '<option value="4">' . esc_html__('Header Type 4', 'nasa-core') . '</option>';
        echo '<option value="5">' . esc_html__('Header Type 5', 'nasa-core') . '</option>';
        echo '<option value="6">' . esc_html__('Header Type 6', 'nasa-core') . '</option>';
        echo '<option value="7">' . esc_html__('Header Type 7', 'nasa-core') . '</option>';
        
        echo NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true) ? '<option value="nasa-custom">' . esc_html__('Header WPBakery Builder', 'nasa-core') . '</option>' : '';
        echo NASA_HF_BUILDER ? '<option value="nasa-elm">' . esc_html__('Header Elementor Builder', 'nasa-core') . '</option>' : '';
        
        echo '</select></p>';
        ?>
    </div>

     <!-- The Block beside Main menu in Header Type 4, 6 -->
     <div class="form-field term-cat_the_block_beside_main_menu_4_6-wrap nasa-term-root-child <?php echo $this->_cat_header_type . ' nasa-term-' . $this->_cat_header_type . '-4' . ' nasa-term-' . $this->_cat_header_type . '-6'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_the_block_beside_main_menu_4_6; ?>"><?php esc_html_e('The Block beside Main menu in Header Type 4, 6', 'nasa-core'); ?></label>
        <?php
        if ($blocks) {
            echo '<p><select id="' . $this->_cat_the_block_beside_main_menu_4_6 . '" name="' . $this->_cat_the_block_beside_main_menu_4_6 . '" class="nasa-ad-select-2">';
            foreach ($blocks as $slug => $name) {
                echo '<option value="' . $slug . '">' . $name . '</option>';
            }
            echo '</select></p>';
        }
        ?>
        <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
    </div>
    
    <div class="form-field term-cat_header-builder-wrap nasa-term-root-child <?php echo $this->_cat_header_type . ' nasa-term-' . $this->_cat_header_type . '-nasa-custom'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_builder; ?>"><?php esc_html_e('Header Builder', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_header_builder . '" name="' . $this->_cat_header_builder . '">';
        foreach ($header_builder as $slug => $name) {
            echo '<option value="' . $slug . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    
    <div class="form-field term-cat_header-builder-wrap nasa-term-root-child <?php echo $this->_cat_header_type . ' nasa-term-' . $this->_cat_header_type . '-nasa-elm'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_elm; ?>"><?php esc_html_e('Header Builder', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_header_elm . '" name="' . $this->_cat_header_elm . '">';
        foreach ($header_builder_e as $slug => $name) {
            echo '<option value="' . $slug . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    <!-- End Header type -->

    <!-- Vertical Menu -->
    <div class="form-field term-cat_header-vertical-menu-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_vertical_menu; ?>"><?php esc_html_e('Header Vertical Menu', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_header_vertical_menu . '" name="' . $this->_cat_header_vertical_menu . '">';
        foreach ($menu_options as $id => $name) {
            echo '<option value="' . $id . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    <!-- Vertical Menu -->
    
    <!-- Vertical Menu Root -->
    <div class="form-field term-cat_header-vertical-menu-root-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_vertical_menu_root; ?>"><?php esc_html_e('Vertical Menu Root', 'nasa-core'); ?></label>
        <div class="nasa_vertical-menu-root">
            <select name="<?php echo $this->_cat_header_vertical_menu_root; ?>" id="<?php echo $this->_cat_header_vertical_menu_root; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="1"><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                <option value="2"><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Vertical Menu Root -->
    
    <!-- Vertical Menu Root - Limit -->
    <div class="form-field term-breadcumb_height-wrap nasa-term-root hidden-tag ns-advance-field">
	<label for="<?php echo $this->_cat_header_vertical_menu_root_limit; ?>"><?php _e('Vertical Menu Root Items - Limit', 'nasa-core'); ?></label>
	<input name="<?php echo $this->_cat_header_vertical_menu_root_limit; ?>" id="<?php echo $this->_cat_header_vertical_menu_root_limit; ?>" type="text" value="" size="40" />
    </div>
    <!-- End Vertical Menu Root - Limit-->
    
    <!-- Topbar -->
    <div class="form-field term-topbar_on-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_topbar_on; ?>"><?php _e('Top Bar', 'nasa-core'); ?></label>
        <div class="nasa_topbar_on">
            <select name="<?php echo $this->_cat_topbar_on; ?>" id="<?php echo $this->_cat_topbar_on; ?>" class="postform">
                <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                <option value="1"><?php echo esc_html__('Yes, Please!', 'nasa-core'); ?></option>
                <option value="2"><?php echo esc_html__('No, Thanks!', 'nasa-core'); ?></option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Topbar -->
    
    <!-- Header BG Color -->
    <div class="form-field term-header_bg_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_bg_color; ?>"><?php _e('Header Background', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_bg_color; ?>" name="<?php echo $this->_cat_header_bg_color; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-header_bg_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_bg_color_stk; ?>"><?php _e('Header Background - Sticky', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_bg_color_stk; ?>" name="<?php echo $this->_cat_header_bg_color_stk; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Header BG Color -->
    
    <!-- Header Text Color -->
    <div class="form-field term-header_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_text_color; ?>"><?php _e('Header Text', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color; ?>" name="<?php echo $this->_cat_header_text_color; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-header_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_text_color_stk; ?>"><?php _e('Header Text - Sticky', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color_stk; ?>" name="<?php echo $this->_cat_header_text_color_stk; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Header Text Color -->
    
    <!-- Header Text Color Hover -->
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_text_color_hv; ?>"><?php _e('Header Text Hover', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color_hv; ?>" name="<?php echo $this->_cat_header_text_color_hv; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_header_text_color_hv_stk; ?>"><?php _e('Header Text Hover - Sticky', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_header_text_color_hv_stk; ?>" name="<?php echo $this->_cat_header_text_color_hv_stk; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Header Text Color Hover -->
    
    <!-- Topbar BG -->
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_topbar_bg_color; ?>"><?php _e('Top Bar Background', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_topbar_bg_color; ?>" name="<?php echo $this->_cat_topbar_bg_color; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Topbar BG -->
    
    <!-- Topbar Text Color -->
    <div class="form-field term-header_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_topbar_text_color; ?>"><?php _e('Top Bar Text', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_topbar_text_color; ?>" name="<?php echo $this->_cat_topbar_text_color; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Topbar Text Color -->
    
    <!-- Header Text Color Hover -->
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_topbar_text_color_hv; ?>"><?php _e('Top Bar Text Hover', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_topbar_text_color_hv; ?>" name="<?php echo $this->_cat_topbar_text_color_hv; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Topbar Text Color Hover -->
    
    <!-- Main Menu BG -->
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_main_menu_bg; ?>"><?php _e('Main Menu Background', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_bg; ?>" name="<?php echo $this->_cat_main_menu_bg; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_main_menu_bg_stk; ?>"><?php _e('Main Menu Background - Sticky', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_bg_stk; ?>" name="<?php echo $this->_cat_main_menu_bg_stk; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Main Menu BG -->
    
    <!-- Main Menu Text Color -->
    <div class="form-field term-header_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_main_menu_text; ?>"><?php _e('Main Menu Text', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_text; ?>" name="<?php echo $this->_cat_main_menu_text; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <div class="form-field term-header_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_main_menu_text_stk; ?>"><?php _e('Main Menu Text - Sticky', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_main_menu_text_stk; ?>" name="<?php echo $this->_cat_main_menu_text_stk; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Main Menu Text Color -->
    
    <!-- Vertical Menu BG -->
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_v_menu_bg; ?>"><?php _e('Vertical Menu Background', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_bg; ?>" name="<?php echo $this->_cat_v_menu_bg; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-header_text_color_hv-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_v_menu_bg_stk; ?>"><?php _e('Vertical Menu Background - Sticky', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_bg_stk; ?>" name="<?php echo $this->_cat_v_menu_bg_stk; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Vertical Menu BG -->
    
    <!-- Vertical Menu Text Color -->
    <div class="form-field term-header_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_v_menu_text; ?>"><?php _e('Vertical Menu Text', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_text; ?>" name="<?php echo $this->_cat_v_menu_text; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="form-field term-header_text_color-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_v_menu_text_stk; ?>"><?php _e('Vertical Menu Text - Sticky', 'nasa-core'); ?></label>
        <div class="nasa_p_color">
            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_v_menu_text_stk; ?>" name="<?php echo $this->_cat_v_menu_text_stk; ?>" value="" />
        </div>
        <div class="clear"></div>
    </div>
    <!-- End Vertical Menu Text Color -->
    
    <div class="space-admin nasa-term-root hidden-tag ns-advance-field"></div>
    
    <!-- Footer Mode -->
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_footer_mode; ?>"><?php esc_html_e('Footer Mode', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_footer_mode . '" name="' . $this->_cat_footer_mode . '">';
        
        echo '<option value="">' . esc_html__("Default", 'nasa-core') . '</option>';
        
        echo (isset($nasa_opt['f_buildin']) && $nasa_opt['f_buildin']) ? '<option value="build-in">' . esc_html__('Built-in', 'nasa-core') . '</option>' : '';
        
        echo NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true) ? '<option value="builder">' . esc_html__('Builder - Support WPBakery', 'nasa-core') . '</option>' : '';
        
        echo NASA_HF_BUILDER ? '<option value="builder-e">' . esc_html__('Builder - Support HFE-Elementor', 'nasa-core') . '</option>' : '';
        
        echo '</select></p>';
        ?>
    </div>
    <!-- End Footer mode -->
    
    <!-- Footer build-in -->
    <div class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-build-in'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_footer_build_in; ?>"><?php esc_html_e('Footer Built-in', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_footer_build_in . '" name="' . $this->_cat_footer_build_in . '">';
        echo '<option value="1">' . esc_html__('Built-in Light 1', 'nasa-core') . '</option>';
        echo '<option value="2">' . esc_html__('Built-in Light 2', 'nasa-core') . '</option>';
        echo '<option value="3">' . esc_html__('Built-in Light 3', 'nasa-core') . '</option>';
        echo '<option value="4">' . esc_html__('Built-in Dark', 'nasa-core') . '</option>';
        echo '</select></p>';
        ?>
    </div>
    <!-- End Footer build-in -->

    <!-- Footer build-in mobile -->
    <div class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-build-in'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_footer_build_in_mobile; ?>"><?php esc_html_e('Footer Built-in Mobile', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_footer_build_in_mobile . '" name="' . $this->_cat_footer_build_in_mobile . '">';
        echo '<option value="">' . esc_html__('Extends from Desktop', 'nasa-core') . '</option>';
        echo '<option value="m-1">' . esc_html__('Built-in Mobile', 'nasa-core') . '</option>';
        echo '</select></p>';
        ?>
    </div>
    <!-- End Footer build-in mobile -->

    <!-- Footer builder -->
    <div class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_footer_type; ?>"><?php esc_html_e('Footer Builder', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_footer_type . '" name="' . $this->_cat_footer_type . '">';
        foreach ($footer_desk as $slug => $name) {
            echo '<option value="' . $slug . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    <!-- End Footer builder -->

    <!-- Footer builder mobile -->
    <div class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_footer_mobile; ?>"><?php esc_html_e('Footer Builder Mobile', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_footer_mobile . '" name="' . $this->_cat_footer_mobile . '">';
        foreach ($footer_builder as $slug => $name) {
            echo '<option value="' . $slug . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    <!-- End Footer builder mobile -->
    
    <!-- Footer builder Elementor -->
    <div class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder-e'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_footer_builder_e; ?>"><?php esc_html_e('Footer Builder Elementor', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_footer_builder_e . '" name="' . $this->_cat_footer_builder_e . '">';
        foreach ($footer_builder_e as $fid => $name) {
            echo '<option value="' . $fid . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    <!-- End Footer builder -->

    <!-- Footer builder mobile -->
    <div class="form-field nasa-term-root-child <?php echo $this->_cat_footer_mode . ' nasa-term-' . $this->_cat_footer_mode . '-builder-e'; ?> hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_footer_builder_e_mobile; ?>"><?php esc_html_e('Footer Builder Elementor Mobile', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_footer_builder_e_mobile . '" name="' . $this->_cat_footer_builder_e_mobile . '">';
        foreach ($footer_builder_e as $fid => $name) {
            echo '<option value="' . $fid . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    
    <!-- Popup Static Block -->
    <div class="form-field term-cat_size_guide_block-wrap nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_popup_static_block; ?>"><?php esc_html_e('Popup Static Block', 'nasa-core'); ?></label>
        <?php
        if ($blocks) {
            echo '<p><select id="' . $this->_cat_popup_static_block . '" name="' . $this->_cat_popup_static_block . '" class="nasa-ad-select-2">';
            foreach ($blocks as $slug => $name) {
                echo '<option value="' . $slug . '">' . $name . '</option>';
            }
            echo '</select></p>';
        }
        ?>
        <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
    </div>
    <!-- End Popup Static Block -->
    
    <div class="space-admin nasa-term-root hidden-tag ns-advance-field"></div>
    <!-- End Footer builder Elementor mobile -->
    <?php
}
