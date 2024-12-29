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
        ?>
        
        <li class="grid-product-category ns-st-grd2 wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($delay_animation_product); ?>ms">
            <a class="nasa-item-wrap nasa-flex" a href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($category->name); ?>">
                <div class="nasa-cat-thumb margin-right-15 rtl-margin-right-0 rtl-margin-left-15">
                    <?php nasa_category_thumbnail($category, '380x380'); ?>
                </div>
                
                <div class="nasa-cat-info">
                    <h3 class="margin-top-0 margin-bottom-0 fs-16 cat-title"><?php echo $category->name; ?></h3>
                    
                    <?php echo apply_filters('woocommerce_subcategory_count_html', ' <span class="count fs-14">' . $category->count . ' ' . esc_html__('products', 'nasa-core') . '</span>', $category); ?>
                </div>
            </a>
        </li>
        
        <?php
        $delay_animation_product += $_delay_item;
    endforeach;
    ?>
</ul>
