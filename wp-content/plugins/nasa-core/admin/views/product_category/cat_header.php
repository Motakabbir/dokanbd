<?php
$blocks = nasa_get_blocks_options();
            
if (is_object($term) && $term) {
    $cat_header = get_term_meta($term->term_id, $this->_cat_header, true);

    if (!isset($cat_header)) {
        $cat_header = add_term_meta($term->term_id, $this->_cat_header, '', true);
    }

    ?>
    <tr class="form-field ns-advance-field">
        <th scope="row" valign="top">
            <label for="<?php echo $this->_cat_header; ?>"><?php esc_html_e('Top Content', 'nasa-core'); ?></label>
        </th>
        <td>             
            <?php
            if ($blocks) {
                echo '<p><select id="' . $this->_cat_header . '" name="' . $this->_cat_header . '" class="nasa-ad-select-2">';
                foreach ($blocks as $slug => $name) {
                    echo '<option value="' . $slug . '"' . ($cat_header == $slug ? ' selected' : '') . '>' . $name . '</option>';
                }
                echo '</select></p>';
            }
            ?>
            <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
        </td>
    </tr>
    <?php
} else {
    ?>
    <div class="form-field term-cat_header-wrap ns-advance-field">
        <label for="<?php echo $this->_cat_header; ?>"><?php esc_html_e('Top Content', 'nasa-core'); ?></label>
        <?php
            if ($blocks) {
                echo '<p><select id="' . $this->_cat_header . '" name="' . $this->_cat_header . '" class="nasa-ad-select-2">';
                foreach ($blocks as $slug => $name) {
                    echo '<option value="' . $slug . '">' . $name . '</option>';
                }
                echo '</select></p>';
            }
            ?>
        <p class="description"><?php esc_html_e('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'); ?></p>
    </div>
    <?php
}
