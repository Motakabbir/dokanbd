<?php
$blocks = nasa_get_blocks_options();
            
if (is_object($term) && $term) {
    ?>
    <tr class="form-field">
        <th scope="row" valign="top" colspan="2">
            <a href="javascript:void(0);" class="ns-advance-fields" data-more="<?php echo esc_attr__('Show Advanced Options', 'nasa-core'); ?>" data-less="<?php echo esc_attr__('Hide Advanced Options', 'nasa-core'); ?>">
                <?php echo esc_html__('Show Advanced Options', 'nasa-core'); ?></span>
            </a>
        </th>
    </tr>
    <?php
} else {
    ?>
    <div class="form-field">
        <a href="javascript:void(0);" class="ns-advance-fields" data-more="<?php echo esc_attr__('Show Advanced Options', 'nasa-core'); ?>" data-less="<?php echo esc_attr__('Hide Advanced Options', 'nasa-core'); ?>">
            <?php echo esc_html__('Show Advanced Options', 'nasa-core'); ?></span>
        </a>
    </div>
    <?php
}