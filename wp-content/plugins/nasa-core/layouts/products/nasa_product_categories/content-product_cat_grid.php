<?php
$columns_large = isset($columns_number) ? $columns_number : 3;
$columns_small = isset($columns_number_small) ? $columns_number_small : 2;
$columns_medium = isset($columns_number_tablet) ? $columns_number_tablet : 2;

$ul_class = 'large-block-grid-' . $columns_large . ' small-block-grid-' . $columns_small . ' medium-block-grid-' . $columns_medium . ' nasa-after-clear';

$ul_class .= $el_class;
?>

<ul class="<?php echo esc_attr($ul_class); ?>">
    <?php
    foreach ($product_categories as $category) :
        $href = get_term_link($category, 'product_cat');
        $childTerms = get_terms( 
            array(
                'taxonomy' => 'product_cat',
                'parent' => $category->term_id,
                'hide_empty' => $hide_empty,
                'number' => apply_filters('nasa_cat_grid_limit_item', 3)
            )
        );
    ?>
        <li class="grid-product-category wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($delay_animation_product); ?>ms">
            <div class="nasa-item-wrap">
                <div class="nasa-cat-info left rtl-right">
                    <a class="nasa-block nasa-title nasa-transition" href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo $category->name; ?></a>
                    
                    <?php if ($childTerms) : ?>
                        <div class="nasa-child-categories">
                            <?php
                            foreach ($childTerms as $term) :
                                $hrefChild = get_term_link($term, 'product_cat'); ?>
                                <a class="nasa-block nasa-transition nasa-child-category-item" href="<?php echo esc_url($hrefChild); ?>" title="<?php echo esc_attr($term->name); ?>"><?php echo $term->name; ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <?php echo apply_filters('woocommerce_subcategory_count_html', ' <span class="count nasa-block">' . $category->count . ' ' . esc_html__('items', 'nasa-core') . '</span>', $category); ?>
                    <?php endif; ?>
                    
                    <a class="nasa-view-more nasa-transition nasa-flex" href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr__('Shop All', 'nasa-core'); ?>">
                        <?php echo esc_html__('Shop All', 'nasa-core'); ?>
                        <svg class="nasa-only-ltr margin-left-10 nasa-transition-200" viewBox="0 0 512 512" width="17" height="17">
                            <path fill="currentColor" d="M0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM281 385c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l71-71L136 280c-13.3 0-24-10.7-24-24s10.7-24 24-24l182.1 0-71-71c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0L393 239c9.4 9.4 9.4 24.6 0 33.9L281 385z"/>
                        </svg>
                        <svg class="nasa-only-rtl margin-right-10 nasa-transition-200" viewBox="0 0 512 512" width="17" height="17">
                            <path fill="currentColor" d="M512 256A256 256 0 1 0 0 256a256 256 0 1 0 512 0zM231 127c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-71 71L376 232c13.3 0 24 10.7 24 24s-10.7 24-24 24l-182.1 0 71 71c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0L119 273c-9.4-9.4-9.4-24.6 0-33.9L231 127z"/>
                        </svg>
                    </a>
                </div>
                
                <div class="nasa-cat-thumb right rtl-left">
                    <a href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($category->name); ?>"><?php nasa_category_thumbnail($category, '380x380'); ?></a>
                </div>
            </div>
        </li>
        
        <?php
        $delay_animation_product += $_delay_item;
        
    endforeach;
    ?>
</ul>
