<?php
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;
?>

<div id="dokan-seller-listing-wrap" class="grid-view">
    <div class="seller-listing-content">
        <?php if (!empty($sellers['users'])) : ?>
            <ul class="dokan-seller-wrap nasa-flex flex-column nasa-style style-list-1">
                <?php
                foreach ($sellers['users'] as $seller) :
                    $vendor = dokan()->vendor->get($seller->ID);
                    $store_name = $vendor->get_shop_name();
                    $store_url = $vendor->get_shop_url();
                    $store_rating = $vendor->get_rating();
                    $is_store_featured = $vendor->is_featured();
                    $store_phone = $vendor->get_phone();
                    $store_info = dokan_get_store_info($seller->ID);
                    $store_address = dokan_get_seller_short_address($seller->ID);
                    
                    $show_store_open_close = dokan_get_option('store_open_close', 'dokan_appearance', 'on');
                    $dokan_store_time_enabled = isset($store_info['dokan_store_time_enabled']) ? $store_info['dokan_store_time_enabled'] : '';
                    $store_open_is_on = ('on' === $show_store_open_close && 'yes' === $dokan_store_time_enabled && !$is_store_featured) ? ' store_open_is_on' : '';
                    
                    // $store_banner_id = $vendor->get_banner_id();
                    // $store_banner = $store_banner_id ? wp_get_attachment_image_src($store_banner_id, $image_size) : false;
                    // $store_banner_src = $store_banner && is_array($store_banner) ? esc_url($store_banner[0]) : false;
                    
                    $products = elessi_dokan_products_from_seller($seller->ID, 3);
                    ?>

                    <li class="dokan-single-seller woocommerce">
                        <div class="nasa-flex single-seller-wrap">
                            <div class="store-wrapper">
                                <div class="store-content">
                                    <div class="store-data-container">

                                        <div class="store-data<?php echo esc_attr($store_open_is_on); ?>">
                                            <div class="nasa-flex">
                                                <!-- Store Avatar -->
                                                <div class="seller-avatar">
                                                    <a href="<?php echo esc_url($store_url); ?>">
                                                        <img src="<?php echo esc_url($vendor->get_avatar()); ?>" alt="<?php echo esc_attr($vendor->get_shop_name()); ?>" width="68" height="68" />
                                                    </a>
                                                </div>
                                                
                                                <div class="seller-info margin-left-20 rtl-margin-left-0 rtl-margin-right-20">
                                                    <!-- Store Name -->
                                                    <h2>
                                                        <a href="<?php echo esc_attr($store_url); ?>"><?php echo esc_html($store_name); ?></a> <?php apply_filters('dokan_store_list_loop_after_store_name', $vendor); ?>
                                                    </h2>

                                                    <?php if (!empty($store_rating['count'])) : ?>
                                                        <!-- Store Rating -->
                                                        <div class="dokan-seller-rating" title="<?php echo sprintf(esc_attr__('Rated %s out of 5', 'elessi-theme'), esc_attr($store_rating['rating'])); ?>">
                                                            <?php echo wp_kses_post(dokan_generate_ratings($store_rating['rating'], 5)); ?>
                                                            <p class="rating">
                                                                <?php echo esc_html(sprintf(__('%s out of 5', 'elessi-theme'), $store_rating['rating'])); ?>
                                                            </p>
                                                        </div>
                                                    <?php endif; ?>

                                                    <?php if (!dokan_is_vendor_info_hidden('address') && $store_address) : ?>
                                                        <?php
                                                        $allowed_tags = array(
                                                            'span' => array(
                                                                'class' => array(),
                                                            ),
                                                            'br' => array()
                                                        );
                                                        ?>
                                                        <!-- Store Address -->
                                                        <p class="store-address"><?php echo wp_kses($store_address, $allowed_tags); ?></p>
                                                    <?php endif; ?>

                                                    <?php if (!dokan_is_vendor_info_hidden('phone') && $store_phone) : ?>
                                                        <!-- Store Phone -->
                                                        <p class="store-phone">
                                                            <i class="fa fa-phone"></i> <?php echo esc_html($store_phone); ?>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>

                                            <?php do_action('dokan_seller_listing_after_store_data', $seller, $store_info); ?>
                                        </div>
                                    </div>
                                </div>

                                <?php do_action('dokan_seller_listing_footer_content', $seller, $store_info); ?>
                            </div>
                            
                            <!-- Badges -->
                            <div class="nasa-dokan-badges hide-for-small">
                                <div class="featured-favourite">
                                    <?php if ($is_store_featured) : ?>
                                        <div class="featured-label"><?php esc_html_e('Featured', 'elessi-theme'); ?></div>
                                    <?php endif; ?>

                                    <?php do_action('dokan_seller_listing_after_featured', $seller, $store_info); ?>
                                </div>

                                <?php if ('on' === $show_store_open_close && 'yes' === $dokan_store_time_enabled) : ?>
                                    <!-- Open | Closed -->
                                    <?php if (dokan_is_store_open($seller->ID)) : ?>
                                        <span class="dokan-store-is-open-close-status dokan-store-is-open-status" title="<?php esc_attr_e('Store is Open', 'elessi-theme'); ?>"><?php esc_html_e('Open', 'elessi-theme'); ?></span>
                                    <?php else : ?>
                                        <span class="dokan-store-is-open-close-status dokan-store-is-closed-status" title="<?php esc_attr_e('Store is Closed', 'elessi-theme'); ?>"><?php esc_html_e('Closed', 'elessi-theme'); ?></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        
                            <?php if ($products->have_posts()) : ?>
                                <!-- Seller Products -->
                                <div class="seller-products">
                                    <div class="wrap-items nasa-flex">
                                        <?php while ($products->have_posts()) :
                                            $products->the_post();
                                            global $product;

                                            if (empty($product) || !$product->is_visible()) :
                                                continue;
                                            endif;
                                            ?>

                                            <a class="seller-product" href="<?php echo esc_url($product->get_permalink()); ?>" title="<?php echo esc_attr($product->get_name()); ?>">
                                                <?php echo $product->get_image(); ?>
                                            </a>

                                        <?php endwhile; ?>

                                        <?php wp_reset_postdata(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </li>

                <?php endforeach; ?>
            </ul> <!-- .dokan-seller-wrap -->
            
            <div class="dokan-clearfix"></div>

            <?php
            $user_count = $sellers['count'];
            $num_of_pages = ceil($user_count / $limit);

            if ($num_of_pages > 1) :
                echo '<div class="pagination-container clearfix">';

                $pagination_args = array(
                    'current' => $paged,
                    'total' => $num_of_pages,
                    'base' => $pagination_base,
                    'type' => 'array',
                    'prev_text' => __('&larr; Previous', 'elessi-theme'),
                    'next_text' => __('Next &rarr;', 'elessi-theme'),
                );

                if (!empty($search_query)) :
                    $pagination_args['add_args'] = array(
                        'dokan_seller_search' => $search_query,
                    );
                endif;

                $page_links = paginate_links($pagination_args);

                if ($page_links) :
                    $pagination_links = '<div class="pagination-wrap">';
                    $pagination_links .= '<ul class="pagination"><li>';
                    $pagination_links .= join("</li>\n\t<li>", $page_links);
                    $pagination_links .= "</li>\n</ul>\n";
                    $pagination_links .= '</div>';

                    echo $pagination_links; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
                endif;

                echo '</div>';
            endif;
            ?>

        <?php else : ?>
            <p class="dokan-error"><?php esc_html_e('No vendor found!', 'elessi-theme'); ?></p>
        <?php endif; ?>
    </div>
</div>
