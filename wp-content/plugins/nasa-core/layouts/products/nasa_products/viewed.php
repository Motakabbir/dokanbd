<?php
$_delay = 0;
$_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
$display_type = !isset($display_type) ? 'slide' : $display_type;

if ($display_type === 'slide') :
    if (isset($nasa_viewed_products->post_count) && $nasa_viewed_products->post_count > 0) :
        $auto_slide = isset($auto_slide) ? $auto_slide : 'false';
        $loop_slide = isset($loop_slide) ? $loop_slide : 'false';
        $title = $title == '' ? esc_html__("You're recently viewed", 'nasa-core') : $title;
        ?>
        <div class="nasa-viewed-product-sc nasa-slider-wrap viewed products grid">
            <?php if ($title != '') : ?>
                <div class="row">
                    <div class="viewed-block-title large-12 columns">
                        <h3 class="nasa-shortcode-title-slider">
                            <?php echo $title; ?>
                        </h3>
                        
                        <hr class="nasa-separator" />
                        
                        <div class="nasa-nav-carousel-wrap">
                            <a class="nasa-nav-icon-slider pe-7s-angle-left" href="javascript:void(0);" data-do="prev" rel="nofollow"></a>
                            <a class="nasa-nav-icon-slider pe-7s-angle-right" href="javascript:void(0);" data-do="next" rel="nofollow"></a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row nasa-content-shortcode">
                <?php if ($title == '') : ?>
                    <div class="large-12 columns nasa-nav-carousel-wrap">
                        <a class="nasa-nav-icon-slider pe-7s-angle-left" href="javascript:void(0);" data-do="prev" rel="nofollow"></a>
                        <a class="nasa-nav-icon-slider pe-7s-angle-right" href="javascript:void(0);" data-do="next" rel="nofollow"></a>
                    </div>
                <?php endif; ?>

                <div class="large-12 columns">
                    <div
                        class="ns-items-gap nasa-slick-slider"
                        data-columns="<?php echo esc_attr($columns_number); ?>"
                        data-columns-small="<?php echo esc_attr($columns_number_small); ?>"
                        data-columns-tablet="<?php echo esc_attr($columns_number_tablet); ?>"
                        data-autoplay="<?php echo esc_attr($auto_slide); ?>"
                        data-loop="<?php echo esc_attr($loop_slide); ?>"
                        data-switch-tablet="<?php echo nasa_switch_tablet(); ?>"
                        data-switch-desktop="<?php echo nasa_switch_desktop(); ?>">
                        <?php
                        while ($nasa_viewed_products->have_posts()) :
                            $nasa_viewed_products->the_post();
                        
                            global $product;
                            if (empty($product) || !$product->is_visible()) :
                                continue;
                            endif;
                            
                            echo '<div class="slider-item">';
                            
                            wc_get_template(
                                'content-widget-product.php', 
                                array(
                                    'wapper' => 'div',
                                    'delay' => $_delay,
                                    'list_type' => '1',
                                    'animation' => $animation
                                )
                            );
                            
                            echo '</div>';

                            $_delay += $_delay_item;
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    endif;
else :
    /**
     * Sidebar viewed
     */
    ?>
    <div class="nasa-viewed-product-sc margin-top-40">
        <?php
            if (isset($nasa_viewed_products->post_count) && $nasa_viewed_products->post_count > 0) :
                while ($nasa_viewed_products->have_posts()) :
                    $nasa_viewed_products->the_post();

                    wc_get_template(
                        'content-widget-product.php', 
                        array(
                            'wapper' => 'div',
                            'delay' => $_delay,
                            'list_type' => '1',
                            'animation' => false
                        )
                    );

                    $_delay += $_delay_item;
                endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="empty">
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="currentColor"><path d="M16 6.404c-5.847 0-10.404 3.66-15.994 9.593 4.816 5.073 8.857 9.6 15.994 9.6s12.382-5.73 15.994-9.492c-3.697-4.407-8.943-9.7-15.994-9.7zM16 24.53c-6.336 0-10.16-3.929-14.524-8.532 5.192-5.414 9.32-8.527 14.524-8.527 6.161 0 10.975 4.443 14.558 8.591-3.523 3.674-8.293 8.469-14.558 8.469z"/><path d="M16 9.603c-3.528 0-6.398 2.87-6.398 6.397s2.87 6.397 6.398 6.397 6.398-2.87 6.398-6.397-2.87-6.397-6.398-6.397zM16 21.331c-2.939 0-5.331-2.391-5.331-5.331s2.392-5.331 5.331-5.331 5.331 2.391 5.331 5.331c0 2.939-2.392 5.331-5.331 5.331z"/><path d="M16 12.268c-2.058 0-3.732 1.674-3.732 3.732s1.674 3.732 3.732 3.732c2.058 0 3.732-1.674 3.732-3.732s-1.674-3.732-3.732-3.732zM16 18.666c-1.47 0-2.666-1.196-2.666-2.666s1.196-2.666 2.666-2.666 2.666 1.196 2.666 2.666c0 1.47-1.196 2.666-2.666 2.666z"/></svg><?php esc_html_e('No products were viewed.', 'nasa-core'); ?><a href="javascript:void(0);" class="button nasa-sidebar-return-shop" rel="nofollow"><?php esc_html_e('RETURN TO SHOP', 'nasa-core'); ?></a></p>
            <?php
            endif;
        ?>
    </div>
    <?php
endif;
