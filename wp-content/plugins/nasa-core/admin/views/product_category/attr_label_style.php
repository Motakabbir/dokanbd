<?php
$display_type = array(
    "" => esc_html__("Default", 'nasa-core'),
    "radio" => esc_html__("Radio Style", 'nasa-core'),
    "round" => esc_html__("Round Wrapper", 'nasa-core'),
    "small-square-1" => esc_html__("Small Square 1", 'nasa-core'),
    "small-square-2" => esc_html__("Small Square 2", 'nasa-core'),
    "big-square" => esc_html__("Big Square", 'nasa-core')
);

if (is_object($term) && $term) {
    $cat_attr_display_type = get_term_meta($term->term_id, $this->_cat_attr_label_style, true);
    if (!isset($cat_attr_display_type)) {
        $cat_attr_display_type = add_term_meta($term->term_id, $this->_cat_attr_label_style, '', true);
    }
    ?>
    <tr class="form-field nasa-term-root hidden-tag ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_attr_label_style; ?>">
                <?php esc_html_e('Attribute Label Style', 'nasa-core'); ?>
            </label>
        </th>
        <td>             
            <?php
            $selected = isset($cat_attr_display_type) ? $cat_attr_display_type : '';
            echo '<p><select id="' . $this->_cat_attr_label_style . '" name="' . $this->_cat_attr_label_style . '">';
            
            foreach ($display_type as $slug => $name) {
                echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
            }
            
            echo '</select></p>';
            ?>
            
            <p class="description"><?php esc_html_e('Only Apply for Single | Quickview', 'nasa-core'); ?></p>
        </td>
    </tr>
    
    <tr class="space-admin nasa-term-root hidden-tag ns-advance-field"><td colspan="2"></td></tr>
<?php } else { ?>
    <div class="form-field nasa-term-root hidden-tag ns-advance-field">
        <label for="<?php echo $this->_cat_attr_label_style; ?>">
            <?php esc_html_e('Attribute Label Style', 'nasa-core'); ?>
        </label>
        
        <?php
        echo '<p><select id="' . $this->_cat_attr_label_style . '" name="' . $this->_cat_attr_label_style . '">';
        
        foreach ($display_type as $slug => $name) {
            echo '<option value="' . $slug . '">' . $name . '</option>';
        }
        
        echo '</select></p>';
        ?>
        
        <p class="description"><?php esc_html_e('Only Apply for Single | Quickview', 'nasa-core'); ?></p>
    </div>
    
    <div class="space-admin nasa-term-root hidden-tag ns-advance-field"></div>
    <?php
}
