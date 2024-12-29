<?php
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;
?>
<div class="row">
    <div class="large-12 columns nasa-v-tabs">
        
        <div class="nasa-tab-wrap">
            <ul class="<?php echo esc_attr($class_ul); ?>">
                <?php
                $k_title = 0;
                $countTabs = count($tabs);

                foreach ($tabs as $key => $tab) :
                    if (!isset($tab['title'])) :
                        continue;
                    endif;

                    $class_node = 'nasa-single-product-tab ' . $key . '_tab nasa-tab';
                    $class_node .= $k_title == 0 ? ' active first' : '';
                    $class_node .= $k_title == $countTabs-1 ? ' last' : '';
                    ?>
                    <li class="<?php echo esc_attr($class_node); ?>">
                        <a href="javascript:void(0);" data-id="#nasa-tab-<?php echo esc_attr($key); ?>" rel="nofollow">
                            <?php echo apply_filters('woocommerce_product_' . $key . '_tab_title', $tab['title'], $key); ?>
                        </a>
                    </li>
                    <?php
                    $k_title++;
                endforeach;
                ?>
            </ul>
        </div>
        
        <div class="nasa-panels">
            <?php
            $k_tab = 0;
            foreach ($tabs as $key => $tab) :
                if (!isset($tab['callback'])) :
                    continue;
                endif;

                $class_panel = 'nasa-panel nasa-content-' . $key;
                $class_panel .= $k_tab == 0 ? ' active' : '';
                ?>
                <div class="<?php echo esc_attr($class_panel); ?>" id="nasa-tab-<?php echo esc_attr($key); ?>">
                    <?php call_user_func($tab['callback'], $key, $tab); ?>
                </div>
                <?php
                $k_tab++;
            endforeach;
            ?>
        </div>
    </div>
</div>
