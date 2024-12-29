<?php defined('ABSPATH') or die(); ?>

<div class="form-row nasa-wrap-inner nasa-ct-tabs-wrapper">
    <h4 class="nasa-pd-sides">
        <?php esc_html_e('Custom Tabs', 'nasa-core') ?>
    </h4>
    
    <p class="nasa-pd-sides"><?php echo esc_html__('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) to use this Feature.', 'nasa-core'); ?></p>
    
    <ul class="nasa-ct-tabs-list nasa-pd-sides">
        <?php
        
        if (!empty($ct_tabs)) :
            foreach ($ct_tabs as $key => $tab) : ?>
                <li class="nasa-ct-tabs-item">
                    <div class="row-flex">
                        <div class="col-flex flex-label tab-label" data-label="<?php esc_attr_e('Tab', 'nasa-core'); ?>">
                            <?php esc_html_e('Tab', 'nasa-core'); ?> #<?php echo $key + 1; ?>
                        </div>
                        <div class="col-flex flex-input">
                            <select class="short glb-tab nasa-ad-select-2" name="tab_<?php echo $key; ?>">
                                <?php if (!empty($blocks)) : ?>
                                    <?php foreach ($blocks as $slug => $block) : ?>
                                        <option value="<?php echo esc_attr($slug); ?>"<?php echo $tab == $slug ? ' selected' : ''; ?>><?php echo $block; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>

                    <a href="javascript:void(0);" class="nasa-rm-tab" title="<?php echo esc_attr__('Remove', 'nasa-core'); ?>" data-confirm="<?php echo esc_attr__('Are you sure you want to remove it?', 'nasa-core'); ?>"></a>
                </li>
            <?php
                if ($key > 4) :
                    break;
                endif;
                
            endforeach;
        endif;
        ?>
    </ul>
    
    <input class="tabs-request-values" type="hidden" name="<?php echo esc_attr($field_name); ?>" value="<?php echo $ct_tabs_val; ?>" />

    <p class="nasa-action-add-ct-tab hide-if-no-js<?php echo count($ct_tabs) > 4 ? ' hidden-tag' : ''; ?>">
        <a href="javascript:void(0);" class="button nasa-add-ct-tab" data-name="ct-tab">
            <?php esc_html_e('Add New Custom Tab', 'nasa-core'); ?>
            
            <template>
                <li class="nasa-ct-tabs-item">
                    <div class="row-flex">
                        <div class="col-flex flex-label tab-label" data-label="<?php esc_attr_e('Tab', 'nasa-core'); ?>">
                            <?php esc_html_e('Tab', 'nasa-core'); ?>
                        </div>
                        <div class="col-flex flex-input">
                            <select class="short glb-tab nasa-ad-select-2" name="tab">
                                <?php if (!empty($blocks)) : ?>
                                    <?php foreach ($blocks as $slug => $block) : ?>
                                        <option value="<?php echo esc_attr($slug); ?>"><?php echo $block; ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    
                    <a href="javascript:void(0);" class="nasa-rm-tab" title="<?php echo esc_attr__('Remove', 'nasa-core'); ?>" data-confirm="<?php echo esc_attr__('Are you sure you want to remove it?', 'nasa-core'); ?>"></a>
                </li>
            </template>
        </a>
    </p>
</div>
