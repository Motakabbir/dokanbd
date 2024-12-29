<?php
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

$k_acc = 0;
$countTabs = count($tabs);
echo '<div class="nasa-small-accodion">';

foreach ($tabs as $key => $tab) :
    if (!isset($tab['title']) || !isset($tab['callback'])) :
        continue;
    endif;

    $class_node = 'nasa-single-product-tab nasa-accordion hidden-tag nasa-accordion-' . $key;
    $class_node .= $k_acc == 0 ? ' first' : '';
    $class_node .= $k_acc == $countTabs ? ' last' : '';

    $class_panel = 'hidden-tag nasa-panel nasa-content-panel nasa-content-' . $key;
    $class_panel .= $k_acc == 0 ? ' first' : '';
    ?>

    <div class="nasa-accordion-title">
        <a class="<?php echo esc_attr($class_node); ?>" href="javascript:void(0);" data-id="accordion-<?php echo esc_attr($key); ?>" rel="nofollow">
            <?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', $tab['title'], $key); ?>
            <svg class="hidden-tag nasa-transition" width="28" height="28" viewBox="0 0 32 32" fill="currentColor"><path d="M15.233 19.175l0.754 0.754 6.035-6.035-0.754-0.754-5.281 5.281-5.256-5.256-0.754 0.754 3.013 3.013z"/></svg>
        </a>
    </div>

    <div class="<?php echo esc_attr($class_panel); ?>" id="nasa-section-accordion-<?php echo esc_attr($key); ?>">
        <?php call_user_func($tab['callback'], $key, $tab); ?>
    </div>

    <?php 
    $k_acc++;
endforeach;

echo '</div>';
