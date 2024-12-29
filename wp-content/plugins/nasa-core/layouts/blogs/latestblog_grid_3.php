<?php
$_delay = 0;
$_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
?>
<div class="row nasa-blog-sc blog-grid blog-grid-style">
    <?php
    $k = 0;
    while ($recentPosts->have_posts()) :
        $recentPosts->the_post();
        $title_item = get_the_title();
        $link = get_the_permalink();
        $postId = get_the_ID();
        $categories = ($cats_enable == 'yes') ? get_the_category_list(esc_html__(', ', 'nasa-core')) : '';

        if ($author_enable == 'yes') :
            $author = get_the_author();
            $author_id = get_the_author_meta('ID');
            $link_author = get_author_posts_url($author_id);
        endif;

        if ($date_enable == 'yes') :
            $day = get_the_date('d', $postId);
            $month = get_the_date('m', $postId);
            $year = get_the_date('Y', $postId);
            $link_date = get_day_link($year, $month, $day);
            $date_post = get_the_date('d F', $postId);
        endif;

        $class_item = 'small-12 medium-6 large-6 columns margin-bottom-40 wow fadeInUp nasa-item-blog-grid blog-item nasa-item-blog-grid-3';

        $class_item .= $k == 0 ? ' rtl-right padding-right-40 mobile-padding-right-10 rtl-padding-right-10 rtl-padding-left-40 rtl-mobile-padding-left-10' : ' rtl-left padding-left-40 mobile-padding-left-10 rtl-padding-left-10 rtl-padding-right-40 rtl-mobile-padding-right-10';

        echo '<div class="' . $class_item . '" data-wow-duration="1s" data-wow-delay="' . esc_attr($_delay) . 'ms">';

        if ($k == 0 && trim($title) !== '') : ?>
            <div class="nasa-title margin-bottom-50 mobile-margin-bottom-25 nasa-xl">
                <h3 class="nasa-title-heading nasa-bold-800 margin-bottom-5">
                    <?php echo esc_attr($title); ?>
                </h3>

                <?php if (trim($title_desc) != '') :
                    echo '<p class="nasa-title-desc">' . esc_html($title_desc) . '</p>';
                endif; ?>
            </div>
        <?php endif; ?>

        <a class="entry-blog" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title_item); ?>">
            <div class="blog-image-fullwidth blog-image-attachment margin-bottom-30 mobile-margin-bottom-10">
                <?php
                if (has_post_thumbnail()):
                    the_post_thumbnail('nasa-medium', array(
                        'alt' => esc_attr($title_item)
                    ));
                else:
                    echo '<img src="' . NASA_CORE_PLUGIN_URL . 'assets/images/placeholder.png" alt="' . esc_attr($title_item) . '" />';
                endif;
                ?>
            </div>
        </a>

        <div class="nasa-blog-info nasa-blog-img-top">
            <div class="nasa-blog-info-wrap info-wrap margin-top-20 mobile-margin-top-10">
                <?php echo ($cats_enable == 'yes') ? '<div class="nasa-post-cats-wrap">' . $categories . '</div>' : ''; ?>
                <a class="nasa-blog-title nasa-bold-800" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title_item); ?>"><?php echo $title_item; ?></a>

                <div class="nasa-info-short"><?php the_excerpt(); ?></div>

                <div class="nasa-date-author-wrap nasa-post-date-author-wrap nasa-flex flex-wrap">
                    <?php if ($date_enable == 'yes') : ?>
                        <a href="<?php echo esc_url($link_date); ?>" title="<?php echo esc_html__('Posts at ', 'nasa-core') . esc_attr($date_post); ?>" class="nasa-post-date-author-link">
                            <span class="nasa-post-date-author nasa-iflex">
                                <svg class="margin-right-5 rtl-margin-right-0 rtl-margin-left-5" width="18" height="18" viewBox="0 0 32 32" fill="currentColor"><path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 4.271v4.798h-23.457v-4.798h23.457zM4.271 27.729v-17.593h23.457v17.593h-23.457z" /><path d="M11.201 5.871h1.6v1.599h-1.6v-1.599z" /><path d="M19.199 5.871h1.599v1.599h-1.599v-1.599z" /><path d="M12.348 13.929c-0.191 1.297-0.808 1.32-2.050 1.365l-0.193 0.007v0.904h2.104v5.914h1.116v-8.361h-0.953l-0.025 0.171z" /><path d="M18.642 16.442c-0.496 0-1.005 0.162-1.408 0.433l0.38-1.955h3.515v-1.060h-4.347l-0.848 4.528h0.965l0.059-0.092c0.337-0.525 0.952-0.852 1.606-0.852 1.064 0 1.836 0.787 1.836 1.87 0 0.98-0.615 1.972-1.79 1.972-1.004 0-1.726-0.678-1.756-1.649l-0.006-0.194h-1.115l0.005 0.205c0.036 1.58 1.167 2.641 2.816 2.641 1.662 0 2.963-1.272 2.963-2.895-0-1.766-1.154-2.953-2.872-2.953z" /></svg>
                                
                                <?php echo $date_post; ?>
                            </span>
                        </a>
                    <?php endif; ?>

                    <?php if ($author_enable == 'yes') : ?>
                        <a href="<?php echo esc_url($link_author); ?>" title="<?php echo esc_html__('Posted By ', 'nasa-core') . esc_attr($author); ?>" class="nasa-post-date-author-link">
                            <span class="nasa-post-date-author nasa-iflex">
                                <svg class="margin-right-5 rtl-margin-right-0 rtl-margin-left-5" width="18" height="18" viewBox="0 0 32 32" fill="currentColor"><path d="M16 3.205c-7.067 0-12.795 5.728-12.795 12.795s5.728 12.795 12.795 12.795 12.795-5.728 12.795-12.795c0-7.067-5.728-12.795-12.795-12.795zM16 4.271c6.467 0 11.729 5.261 11.729 11.729 0 2.845-1.019 5.457-2.711 7.49-1.169-0.488-3.93-1.446-5.638-1.951-0.146-0.046-0.169-0.053-0.169-0.66 0-0.501 0.206-1.005 0.407-1.432 0.218-0.464 0.476-1.244 0.569-1.944 0.259-0.301 0.612-0.895 0.839-2.026 0.199-0.997 0.106-1.36-0.026-1.7-0.014-0.036-0.028-0.071-0.039-0.107-0.050-0.234 0.019-1.448 0.189-2.391 0.118-0.647-0.030-2.022-0.921-3.159-0.562-0.719-1.638-1.601-3.603-1.724l-1.078 0.001c-1.932 0.122-3.008 1.004-3.57 1.723-0.89 1.137-1.038 2.513-0.92 3.159 0.172 0.943 0.239 2.157 0.191 2.387-0.010 0.040-0.025 0.075-0.040 0.111-0.131 0.341-0.225 0.703-0.025 1.7 0.226 1.131 0.579 1.725 0.839 2.026 0.092 0.7 0.35 1.48 0.569 1.944 0.159 0.339 0.234 0.801 0.234 1.454 0 0.607-0.023 0.614-0.159 0.657-1.767 0.522-4.579 1.538-5.628 1.997-1.725-2.042-2.768-4.679-2.768-7.555 0-6.467 5.261-11.729 11.729-11.729zM7.811 24.386c1.201-0.49 3.594-1.344 5.167-1.808 0.914-0.288 0.914-1.058 0.914-1.677 0-0.513-0.035-1.269-0.335-1.908-0.206-0.438-0.442-1.189-0.494-1.776-0.011-0.137-0.076-0.265-0.18-0.355-0.151-0.132-0.458-0.616-0.654-1.593-0.155-0.773-0.089-0.942-0.026-1.106 0.027-0.070 0.053-0.139 0.074-0.216 0.128-0.468-0.015-2.005-0.17-2.858-0.068-0.371 0.018-1.424 0.711-2.311 0.622-0.795 1.563-1.238 2.764-1.315l1.011-0.001c1.233 0.078 2.174 0.521 2.797 1.316 0.694 0.887 0.778 1.94 0.71 2.312-0.154 0.852-0.298 2.39-0.17 2.857 0.022 0.078 0.047 0.147 0.074 0.217 0.064 0.163 0.129 0.333-0.025 1.106-0.196 0.977-0.504 1.461-0.655 1.593-0.103 0.091-0.168 0.218-0.18 0.355-0.051 0.588-0.286 1.338-0.492 1.776-0.236 0.502-0.508 1.171-0.508 1.886 0 0.619 0 1.389 0.924 1.68 1.505 0.445 3.91 1.271 5.18 1.77-2.121 2.1-5.035 3.4-8.248 3.4-3.183 0-6.073-1.277-8.188-3.342z" /></svg>
                                
                                <?php echo $author; ?>
                            </span>
                        </a>
                    <?php endif; ?>

                    <?php if ($readmore == 'yes') : ?>
                        <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_html__('Read more', 'nasa-core'); ?>" class="nasa-post-date-author-link hide-for-mobile nasa-post-read-more">
                            <span class="nasa-post-date-author nasa-iflex">
                                <svg class="margin-right-5 rtl-margin-right-0 rtl-margin-left-5" width="15" height="18" viewBox="0 0 32 32" fill="currentColor"><path d="M9.069 2.672v14.928h-6.397c0 0 0 6.589 0 8.718s1.983 3.010 3.452 3.010c1.469 0 16.26 0 20.006 0 1.616 0 3.199-1.572 3.199-3.199 0-1.175 0-23.457 0-23.457h-20.259zM6.124 28.262c-0.664 0-2.385-0.349-2.385-1.944v-7.652h5.331v7.192c0 0.714-0.933 2.404-2.404 2.404h-0.542zM28.262 26.129c0 1.036-1.096 2.133-2.133 2.133h-17.113c0.718-0.748 1.119-1.731 1.119-2.404v-22.12h18.126v22.391z" /><path d="M12.268 5.871h13.861v1.066h-13.861v-1.066z" /><path d="M12.268 20.265h13.861v1.066h-13.861v-1.066z" /><path d="M12.268 23.997h13.861v1.066h-13.861v-1.066z" /><path d="M26.129 9.602h-13.861v7.997h13.861v-7.997zM25.063 16.533h-11.729v-5.864h11.729v5.864z" /></svg>
                                
                                <?php echo esc_html__('Read more', 'nasa-core'); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php

        echo '</div>';
        $k++;
        $_delay += $_delay_item;
    endwhile;

    wp_reset_postdata();
    ?>
</div>

<?php
if ($page_blogs == 'yes') : ?>
    <div class="text-center margin-top-40 margin-bottom-40">
        <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" title="<?php echo esc_html__('All Blogs', 'nasa-core'); ?>" class="nasa-view-more button">
            <?php echo esc_html__('All Blogs', 'nasa-core'); ?>
        </a>
    </div>
<?php
endif;
