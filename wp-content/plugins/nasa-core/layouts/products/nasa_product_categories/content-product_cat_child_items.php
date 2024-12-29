<?php
$columns_large = isset($columns_number) ? $columns_number : 1;
$columns_small = isset($columns_number_small) ? $columns_number_small : 1;
$columns_medium = isset($columns_number_tablet) ? $columns_number_tablet : 1;

$child_class = 'nasa-flex flex-wrap large-flex-' . esc_attr($columns_large) . ' small-flex-' . esc_attr($columns_small) . ' medium-flex-' . esc_attr($columns_medium) . ' nasa-after-clear';

$shop_now = get_term_link($root_category, 'product_cat');

$class_wrap = 'nasa-wrap-categories' . $el_class;
?>

<div class="<?php echo esc_attr($class_wrap); ?>">
    <a href="<?php echo esc_url($shop_now); ?>" class="nasa-main-cat text-center" title="<?php echo esc_attr($root_category->name); ?>">
        <p class="main-cat-title nasa-bold-700 fs-18"><?php echo $root_category->name; ?></p>
        <div class="nasa-cat-thumb">
            <?php nasa_category_thumbnail($root_category, '380x380'); ?>
        </div>
    </a>
    
    <div class="child-items-wrap margin-top-30">
        <div class="<?php echo $child_class; ?>">
            <?php foreach ($product_categories as $category) : ?>
            <p class="cat-child-item nasa-flex">
                <a class="nasa-title nasa-show-one-line nasa-transition" href="<?php echo esc_url(get_term_link($category, 'product_cat')); ?>" title="<?php echo esc_attr($category->name); ?>"><?php echo $category->name; ?></a>
            </p>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php if ($shop_url) : ?>
        <div class="text-center margin-top-50">
            <a class="button cat-shop-now force-radius-20" title="<?php echo esc_attr__('Shop now', 'nasa-core'); ?>">
                <?php echo esc_html__('Shop now', 'nasa-core'); ?>
            </a>
        </div>
    <?php endif; ?>
</div>
