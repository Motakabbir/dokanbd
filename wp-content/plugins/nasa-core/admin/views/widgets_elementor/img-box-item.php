<div class="nasa-image-box-item nasa-wrap-item">
    <a href="javascript:void(0);" class="nasa-image-box-title nasa-toggle-title">
        <?php echo esc_html__('Item', 'nasa-core'); ?>&nbsp;#<?php echo $order; ?>
    </a>
    
    <a href="javascript:void(0);" class="nasa-image-box-remove nasa-remove-item">
        <?php echo esc_html__('Remove', 'nasa-core'); ?>
    </a>
    
    <div class="nasa-image-box-grid-options nasa-item-options">
        <?php $this->box_item($item, $data_name, $data_id, $order); ?>
    </div>
</div>
