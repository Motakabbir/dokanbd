<?php
$style_item = (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] != '') ? $nasa_opt['loop_layout_buttons'] : '';
$loop_cats = isset($nasa_opt['loop_categories']) && $nasa_opt['loop_categories'] ? '1' : '0';
?>
<div class="nasa-products-infinite-wrap">
    <div class="products grid products-infinite nasa-products-infinite "
        data-next-page="2"
        data-product-type="<?php echo esc_attr($type); ?>"
        data-post-per-page="<?php echo esc_attr($number); ?>"
        data-post-per-row="<?php echo esc_attr($columns_number); ?>"
        data-post-per-row-medium="<?php echo esc_attr($columns_number_tablet); ?>"
        data-post-per-row-small="<?php echo esc_attr($columns_number_small); ?>"
        data-max-pages="<?php echo esc_attr($loop->max_num_pages); ?>"
        data-loop-cat="<?php echo esc_attr($loop_cats); ?>"
        data-cat="<?php echo esc_attr($cat); ?>"
        data-style-item="<?php echo esc_attr($style_item); ?>">
        <?php nasa_template('products/globals/row_layout.php', $nasa_args); ?>
    </div>
    
    <div class="nasa-relative nasa-clear-both text-center margin-top-0 margin-bottom-30">
        <?php if ($loop->max_num_pages > 1) :
            $style_viewmore = 'nasa-more-type-' . (isset($style_viewmore) ? $style_viewmore : '1');
            ?>
            <a href="javascript:void(0);" class="load-more-btn load-more <?php echo esc_attr($style_viewmore); ?>" data-nodata="<?php esc_attr_e('ALL PRODUCTS LOADED', 'nasa-core'); ?>" rel="nofollow">
                <div class="load-more-content nasa-flex">
                    <?php if ($style_viewmore === 'nasa-more-type-1') : ?>
                        <span class="load-more-icon margin-right-10 rtl-margin-right-0 rtl-margin-left-10"><svg class="nasa-transition-200" viewBox="0 30 512 512" width="24" height="24" fill="currentColor"><path d="M276 467c0 8 6 21-2 23l-26 0c-128-7-230-143-174-284 5-13 13-23 16-36-18 0-41 23-54 5 5-15 25-18 41-23 15-5 36-7 48-15-2 10 23 95 6 100-21 5-13-39-18-57-8-5-8 8-11 13-71 126 29 297 174 274z m44 13c-8 0-10 5-20 3 0-6-3-13-3-18 5-3 13-3 18-5 2 7 5 15 5 20z m38-18c-5 3-10 8-18 10-2-7-5-12-7-18 5-2 10-7 18-7 2 5 7 7 7 15z m34-31c0-33-18-71-5-99 23 2 12 38 17 58 90-117-7-314-163-289 0-8-3-10-3-20 131-5 233 84 220 225-2 36-20 66-30 92 12 0 51-26 53-2 3 17-82 28-89 35z m-233-325c5-2 13-5 18-10 0 8 5 10 7 18-5 2-10 8-18 8 0-8-7-8-7-16z m38-18c8 0 10-5 21-5 0 5 2 13 2 18-5 3-13 3-18 5 0-5-5-10-5-18z"/></svg></span>
                    <?php endif; ?>
                    <span class="load-more-text"><?php esc_html_e('LOAD MORE ...', 'nasa-core'); ?></span>
                </div>
            </a>
        <?php endif; ?>
    </div>
</div>
