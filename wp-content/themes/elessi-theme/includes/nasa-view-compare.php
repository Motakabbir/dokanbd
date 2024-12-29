<?php
global $product;

$products = $nasa_compare->get_products_list();
$fields = $nasa_compare->fields();
?>
<div class="nasa-wrap-table-compare">
    <?php
    if ($products) : ?>
        <table class="nasa-table-compare">
            <?php 
            foreach ($fields as $field => $name) :
                if ($field == 'title') :
                    continue;
                endif;
                ?>
                <tr class="<?php echo esc_attr($field); ?>">
                    <th>
                        <?php echo ($field == 'image') ? esc_html__('Product', 'elessi-theme') : $name; ?>
                        <?php echo ($field == 'image') ? '<div class="fixed-th"></div>' : ''; ?>
                    </th>

                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id;
                        ?>
                        <td class="<?php echo esc_attr($product_class); ?>">
                            <?php
                            switch ($field) :
                                case 'image':
                                    $nasa_title = isset($product->fields['title']) ? $product->fields['title'] : '';
                                    $href = get_permalink($product_id);
                                    echo '<a href="' . esc_url($href) . '" title="' . esc_attr($product->fields['title']) . '">';

                                    echo '<div class="image-wrap">' . $product->get_image(apply_filters('ns_img_size_compare', 'yith-woocompare-image')) . '</div>';
                                    echo ($nasa_title != '') ? '<h5 class="compare-product-title">' . $nasa_title . '</h5>' : '';
                                    echo '</a>';
                                    
                                    break;

                                case 'title':

                                    break;

                                case 'add-to-cart':
                                    woocommerce_template_loop_add_to_cart();
                                    
                                    break;

                                default:
                                    echo empty($product->fields[$field]) ? '&nbsp;' : $product->fields[$field];
                                    break;
                            endswitch;
                            ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach;
                    ?>

                </tr>

            <?php endforeach; ?>

            <?php if (get_option('yith_woocompare_price_end') == 'yes' && isset($fields['price'])) : ?>
                <tr class="price repeated">
                    <th><?php echo ($fields['price']); ?></th>

                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id
                        ?>
                        <td class="<?php echo esc_attr($product_class); ?>">
                            <?php echo ($product->fields['price']); ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach;
                    ?>

                </tr>
            <?php endif; ?>

            <?php if (get_option('yith_woocompare_add_to_cart_end') == 'yes' && isset($fields['add-to-cart'])) : ?>
                <tr class="add-to-cart repeated">
                    <th><?php echo ($fields['add-to-cart']); ?></th>
                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id
                        ?>
                        <td class="<?php echo ($product_class); ?> nasa-group-btns">
                            <?php
                            woocommerce_template_loop_add_to_cart();
                            ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach;
                    ?>
                </tr>
            <?php endif; ?>
            <tr class="remove-item">
                <th>&nbsp;</th>

                <?php
                $index = 0;
                foreach ($products as $product_id => $product) :
                    $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id
                    ?>
                    <td class="<?php echo esc_attr($product_class); ?>">
                        <a href="javascript:void(0);" class="nasa-remove-compare" data-prod="<?php echo esc_attr($product_id); ?>" rel="nofollow"><?php echo esc_html__('Remove', 'elessi-theme'); ?></a>
                    </td>
                    <?php
                    ++$index;
                endforeach;
                ?>
            </tr>
        </table>
    <?php
    else:
        echo '<p class="text-center padding-top-30 nasa-flex jc"><svg class="nasa-empty-icon" viewBox="0 0 512 512" with="215" height="215" fill="currentColor"><path d="M500.9,240.5c-6.1,0-11.1,5-11.1,11.1c0,62.3-24.3,120.9-68.3,164.9c-44.1,44-102.6,68.3-164.9,68.3 c-55.1,0-107.3-19-149.1-53.9l40.4-8c6-1.2,9.9-7,8.7-13c-1.2-6-7.1-9.9-13-8.7l-61.8,12.3c-0.7,0.1-1.3,0.4-2,0.6c0,0-0.1,0-0.1,0 c0,0,0,0,0,0c-0.9,0.4-1.7,0.9-2.5,1.5c-0.2,0.1-0.4,0.3-0.5,0.5c-0.7,0.6-1.3,1.3-1.9,2.1c0,0,0,0.1-0.1,0.1 c-0.5,0.8-0.9,1.6-1.2,2.5c-0.1,0.2-0.1,0.4-0.2,0.7c-0.3,0.9-0.4,1.9-0.4,2.9c0,0,0,0,0,0v71.6c0,6.1,5,11.1,11.1,11.1 S95,502,95,495.8v-46.6c45.5,37.3,102,57.7,161.7,57.7c68.2,0,132.3-26.6,180.5-74.8S512,319.8,512,251.6 C512,245.5,507,240.5,500.9,240.5z"/><path d="M478.2,178.4c1.5,4.7,5.9,7.6,10.5,7.6c1.1,0,2.3-0.2,3.5-0.6c5.8-1.9,9-8.2,7-14c-2.9-8.7-6.2-17.3-10-25.6 c-2.5-5.6-9.1-8-14.6-5.5c-5.6,2.5-8,9.1-5.5,14.6C472.5,162.6,475.6,170.5,478.2,178.4z"/><path d="M22.1,261.4c0-62.3,24.3-120.9,68.3-164.9c44.1-44,102.6-68.3,164.9-68.3c55.1,0,107.3,19,149.1,53.9 l-40.4,8.1c-6,1.2-9.9,7-8.7,13c1,5.3,5.7,8.9,10.8,8.9c0.7,0,1.4-0.1,2.2-0.2l61.8-12.3c0.7-0.1,1.3-0.4,2-0.6c0,0,0.1,0,0.1,0 c0,0,0,0,0,0c0.9-0.4,1.7-0.9,2.5-1.5c0.2-0.1,0.4-0.3,0.5-0.5c0.7-0.6,1.3-1.3,1.9-2.1c0,0,0-0.1,0.1-0.1c0.5-0.8,0.9-1.6,1.2-2.5 c0.1-0.2,0.1-0.4,0.2-0.7c0.3-0.9,0.4-1.9,0.4-2.9c0,0,0,0,0,0V17.2c0-6.1-5-11.1-11.1-11.1c-6.1,0-11.1,5-11.1,11.1v46.6 C371.5,26.4,315,6.1,255.3,6.1C187.1,6.1,123,32.7,74.8,80.9S0,193.2,0,261.4c0,6.1,5,11.1,11.1,11.1S22.1,267.6,22.1,261.4z"/><path d="M31,325.4c-1.7-5.9-7.8-9.3-13.7-7.6c-5.9,1.7-9.3,7.8-7.6,13.7c3.4,12.1,7.8,24.1,13,35.6 c1.9,4.1,5.9,6.5,10.1,6.5c1.5,0,3.1-0.3,4.6-1c5.6-2.5,8-9.1,5.5-14.6C38.2,347.4,34.2,336.5,31,325.4z"/></svg></p>';
        echo '<h5 class="text-center margin-bottom-30 empty woocommerce-compare__empty-message">' . esc_html__('No product added to compare !', 'elessi-theme') . '</h5>';
        echo '<p class="text-center"><a href="' . esc_url(get_permalink(wc_get_page_id('shop'))) . '" class="button nasa-sidebar-return-shop" title="' . esc_attr__('RETURN TO SHOP', 'elessi-theme') . '">' . esc_html__('RETURN TO SHOP', 'elessi-theme') . '</a></p>';
    endif;
    ?>
</div>
