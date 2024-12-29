<?php
$effect_type = nasa_product_hover_effect_types();
            
if (is_object($term) && $term) {
    $cat_effect_type = get_term_meta($term->term_id, $this->_cat_effect_hover, true);
    if (!isset($cat_effect_type)) {
        $cat_effect_type = add_term_meta($term->term_id, $this->_cat_effect_hover, '', true);
    }
    ?>
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_effect_hover; ?>"><?php esc_html_e('Effect Hover Product', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            $selected = isset($cat_effect_type) ? $cat_effect_type : '';
            echo '<p><select id="' . $this->_cat_effect_hover . '" name="' . $this->_cat_effect_hover . '">';
            foreach ($effect_type as $slug => $name) {
                echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
            }
            echo '</select></p>';
            ?>
        </td>
    </tr>
    
    <tr class="space-admin nasa-term-root hidden-tag ns-advance-field"><td colspan="2"></td></tr>
    
<?php } else { ?>
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_effect_hover; ?>"><?php esc_html_e('Effect Hover Product', 'nasa-core'); ?></label>
        <?php
        echo '<p><select id="' . $this->_cat_effect_hover . '" name="' . $this->_cat_effect_hover . '">';
        foreach ($effect_type as $slug => $name) {
            echo '<option value="' . $slug . '">' . $name . '</option>';
        }
        echo '</select></p>';
        ?>
    </div>
    
    <div class="space-admin nasa-term-root hidden-tag ns-advance-field"></div>
    <?php
}
