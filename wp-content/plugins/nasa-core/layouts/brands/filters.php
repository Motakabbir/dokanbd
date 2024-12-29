<div class="nasa-brands-anphabets">
    <div class="nasa-anphabets nasa-flex flex-wrap">
        <a href="javascript:void(0);" class="button all anphabet-filters margin-right-10 rtl-margin-right-0 rtl-margin-left-10" rel="nofollow">
            <?php echo esc_html__('All Brands', 'nasa-core'); ?>
        </a>
        
        <?php foreach ($alphabet as $ab) : ?>
            <a href="javascript:void(0);" class="anphabet-item anphabet-filters nasa-bold" data-anphabet="<?php echo esc_attr(strtolower($ab)); ?>" rel="nofollow">
                <?php echo esc_html($ab); ?>
            </a>
        <?php endforeach; ?>
    </div>
    
    <div class="nasa-brands-list nasa-flex flex-wrap">
        <?php foreach ($brands as $brand) :
            
            $first = substr($brand->name, 0, 1);
        
            if (is_numeric($first)) :
                $first = '0-9';
            endif;
            ?>
            
            <a href="<?php echo esc_url(get_term_link($brand)); ?>" class="brand-item nasa-bold" data-anphabet="<?php echo esc_attr(strtolower($first)); ?>" title="<?php echo esc_attr($brand->name); ?>">
                <?php echo esc_html($brand->name); ?>&nbsp;<span class="count"><?php echo $brand->count; ?></span>
            </a>
        <?php endforeach; ?>
    </div>
</div>