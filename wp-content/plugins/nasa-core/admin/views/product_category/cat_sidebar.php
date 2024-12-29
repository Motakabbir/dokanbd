<?php
if (is_object($term) && $term) {
    $cat_sidebar = get_term_meta($term->term_id, $this->_cat_sidebar, true);
    if (!isset($cat_sidebar)) {
        $cat_sidebar = add_term_meta($term->term_id, $this->_cat_sidebar, '0', true);
    }
    ?>
    <tr class="form-field ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_sidebar; ?>"><?php esc_html_e('Override Shop Filters', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            $checked = isset($cat_sidebar) && $cat_sidebar == '1' ? ' checked' : '';
            echo '<p><input type="checkbox" id="' . $this->_cat_sidebar . '" name="' . $this->_cat_sidebar . '" value="1"' . $checked . ' />' . '<label for="' . $this->_cat_sidebar . '" style="display: inline;">' . esc_html__('Yes, Please!', 'nasa-core') . '</label></p>';
            ?>
            <p><a target="_blank" href="<?php echo esc_url(admin_url('widgets.php')); ?>"><?php esc_html_e('Please checked, save and built the filters Category at: Appearance > Widgets', 'nasa-core'); ?></a></p>
        </td>
    </tr>
    <?php
} else {
    ?>
    <div class="form-field term-cat_header-wrap ns-advance-field">
        <label for="<?php echo $this->_cat_sidebar; ?>"><?php esc_html_e('Override Shop Filters', 'nasa-core'); ?></label>
        <p><input type="checkbox" id="<?php echo $this->_cat_sidebar; ?>" name="<?php echo $this->_cat_sidebar; ?>" value="1" /><label for="<?php echo $this->_cat_sidebar; ?>" style="display: inline;"><?php esc_html_e('Yes, Please!', 'nasa-core'); ?></label></p>
        <p><a target="_blank" href="<?php echo esc_url(admin_url('widgets.php')); ?>"><?php esc_html_e('Please checked, save and built the filters Category at: Appearance > Widgets', 'nasa-core'); ?></a></p>
    </div>
    <?php
}
