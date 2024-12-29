<?php
$class_col = 'large-12 columns';
$post_type = get_post_type();
$post_blog = 'post' == $post_type ? true : false;
$show_comment = $show_comment_info && comments_open() ? true : false;
?>
<div class="blog-list-style blog-item">
    <article id="post-<?php echo (int) $postId; ?>" <?php post_class(); ?>>
        <div class="row">
            <?php if (has_post_thumbnail()) : ?>
                <div class="entry-image large-4 columns">
                    <a class="blog-image-attachment nasa-block" href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                        <div class="image-overlay"></div>
                    </a>
                </div>
            <?php
                $class_col = 'large-8 columns';
            endif; ?>

            <div class="<?php echo esc_attr($class_col); ?>">
                <div class="entry-content row">
                    <div class="large-12 columns">
                        <!-- Categories item -->
                        <?php
                        $categories_list = $post_blog && $show_cat_info ? get_the_category_list(', ') : false;
                        if ($categories_list) : ?>
                            <span class="cat-links-archive nasa-archive-info first">
                                <?php echo $categories_list; ?>
                            </span>
                        <?php endif; ?>

                        <h3 class="entry-title nasa-archive-info">
                            <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>" rel="bookmark">
                                <?php echo $title; ?>
                            </a>
                        </h3>
                    </div>

                    <?php if ($show_author_info || $show_date_info || $show_comment) : ?>
                        <div class="large-12 columns text-left info-wrap nasa-archive-info">
                            <?php if ($show_author_info) : ?>
                                <a href="<?php echo esc_url($link_author); ?>" title="<?php echo esc_attr($author); ?>">
                                    <span class="meta-author meta-item nasa-iflex">
                                        <svg class="margin-right-5 rtl-margin-right-0 rtl-margin-left-5" width="18" height="18" viewBox="0 0 32 32" fill="currentColor"><path d="M16 3.205c-7.067 0-12.795 5.728-12.795 12.795s5.728 12.795 12.795 12.795 12.795-5.728 12.795-12.795c0-7.067-5.728-12.795-12.795-12.795zM16 4.271c6.467 0 11.729 5.261 11.729 11.729 0 2.845-1.019 5.457-2.711 7.49-1.169-0.488-3.93-1.446-5.638-1.951-0.146-0.046-0.169-0.053-0.169-0.66 0-0.501 0.206-1.005 0.407-1.432 0.218-0.464 0.476-1.244 0.569-1.944 0.259-0.301 0.612-0.895 0.839-2.026 0.199-0.997 0.106-1.36-0.026-1.7-0.014-0.036-0.028-0.071-0.039-0.107-0.050-0.234 0.019-1.448 0.189-2.391 0.118-0.647-0.030-2.022-0.921-3.159-0.562-0.719-1.638-1.601-3.603-1.724l-1.078 0.001c-1.932 0.122-3.008 1.004-3.57 1.723-0.89 1.137-1.038 2.513-0.92 3.159 0.172 0.943 0.239 2.157 0.191 2.387-0.010 0.040-0.025 0.075-0.040 0.111-0.131 0.341-0.225 0.703-0.025 1.7 0.226 1.131 0.579 1.725 0.839 2.026 0.092 0.7 0.35 1.48 0.569 1.944 0.159 0.339 0.234 0.801 0.234 1.454 0 0.607-0.023 0.614-0.159 0.657-1.767 0.522-4.579 1.538-5.628 1.997-1.725-2.042-2.768-4.679-2.768-7.555 0-6.467 5.261-11.729 11.729-11.729zM7.811 24.386c1.201-0.49 3.594-1.344 5.167-1.808 0.914-0.288 0.914-1.058 0.914-1.677 0-0.513-0.035-1.269-0.335-1.908-0.206-0.438-0.442-1.189-0.494-1.776-0.011-0.137-0.076-0.265-0.18-0.355-0.151-0.132-0.458-0.616-0.654-1.593-0.155-0.773-0.089-0.942-0.026-1.106 0.027-0.070 0.053-0.139 0.074-0.216 0.128-0.468-0.015-2.005-0.17-2.858-0.068-0.371 0.018-1.424 0.711-2.311 0.622-0.795 1.563-1.238 2.764-1.315l1.011-0.001c1.233 0.078 2.174 0.521 2.797 1.316 0.694 0.887 0.778 1.94 0.71 2.312-0.154 0.852-0.298 2.39-0.17 2.857 0.022 0.078 0.047 0.147 0.074 0.217 0.064 0.163 0.129 0.333-0.025 1.106-0.196 0.977-0.504 1.461-0.655 1.593-0.103 0.091-0.168 0.218-0.18 0.355-0.051 0.588-0.286 1.338-0.492 1.776-0.236 0.502-0.508 1.171-0.508 1.886 0 0.619 0 1.389 0.924 1.68 1.505 0.445 3.91 1.271 5.18 1.77-2.121 2.1-5.035 3.4-8.248 3.4-3.183 0-6.073-1.277-8.188-3.342z" /></svg>

                                        <?php echo $author; ?>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if ($show_date_info) : ?>
                                <a href="<?php echo esc_url($link_date); ?>" title="<?php echo esc_attr($date_post); ?>">
                                    <span class="post-date meta-item nasa-iflex">
                                        <svg class="margin-right-5 rtl-margin-right-0 rtl-margin-left-5" width="18" height="18" viewBox="0 0 32 32" fill="currentColor"><path d="M3.205 3.205v25.59h25.59v-25.59h-25.59zM27.729 4.271v4.798h-23.457v-4.798h23.457zM4.271 27.729v-17.593h23.457v17.593h-23.457z" /><path d="M11.201 5.871h1.6v1.599h-1.6v-1.599z" /><path d="M19.199 5.871h1.599v1.599h-1.599v-1.599z" /><path d="M12.348 13.929c-0.191 1.297-0.808 1.32-2.050 1.365l-0.193 0.007v0.904h2.104v5.914h1.116v-8.361h-0.953l-0.025 0.171z" /><path d="M18.642 16.442c-0.496 0-1.005 0.162-1.408 0.433l0.38-1.955h3.515v-1.060h-4.347l-0.848 4.528h0.965l0.059-0.092c0.337-0.525 0.952-0.852 1.606-0.852 1.064 0 1.836 0.787 1.836 1.87 0 0.98-0.615 1.972-1.79 1.972-1.004 0-1.726-0.678-1.756-1.649l-0.006-0.194h-1.115l0.005 0.205c0.036 1.58 1.167 2.641 2.816 2.641 1.662 0 2.963-1.272 2.963-2.895-0-1.766-1.154-2.953-2.872-2.953z" /></svg>

                                        <?php echo $date_post; ?>
                                    </span>
                                </a>
                            <?php endif; ?>

                            <?php if ($show_comment) :
                                $count_comments = get_comments_number();
                                $class_number = 'nasa-comment-count';
                                $class_number .= !$count_comments ? ' nasa-empty' : '';
                                ?>
                                <a href="<?php echo esc_url($link); ?>#respond" title="<?php echo esc_attr__('Comments', 'elessi-theme'); ?>">
                                    <span class="post-comment-count meta-item nasa-iflex">
                                        <svg width="20" height="20" viewBox="0 -3 32 32" fill="currentColor"><path d="M26.664 4.82h-21.328c-1.178 0-2.132 0.955-2.132 2.133v13.868c0 1.178 0.955 2.133 2.132 2.133h14.968l4.226 4.226v-4.226h2.134c1.178 0 2.133-0.955 2.133-2.133v-13.868c-0-1.178-0.955-2.133-2.133-2.133zM27.73 20.821c0 0.588-0.479 1.066-1.066 1.066h-3.2v2.718l-2.718-2.718h-15.41c-0.588 0-1.066-0.478-1.066-1.066v-13.868c0-0.588 0.479-1.066 1.066-1.066h21.328c0.588 0 1.066 0.478 1.066 1.066v13.868z" /><path d="M16 12.824c-0.589 0-1.066 0.478-1.066 1.066s0.477 1.066 1.066 1.066 1.066-0.477 1.066-1.066c0-0.588-0.477-1.066-1.066-1.066z" /><path d="M20.265 12.824c-0.589 0-1.066 0.478-1.066 1.066s0.477 1.066 1.066 1.066 1.066-0.477 1.066-1.066c0-0.588-0.477-1.066-1.066-1.066z" /><path d="M11.835 12.824c-0.589 0-1.066 0.478-1.066 1.066s0.477 1.066 1.066 1.066 1.066-0.477 1.066-1.066c0-0.588-0.477-1.066-1.066-1.066z" /></svg>

                                        <span class="<?php echo esc_attr($class_number); ?>"><?php echo $count_comments; ?></span>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($post_type !== 'page' && $show_desc_blog) : ?>
                        <div class="large-12 columns entry-summary nasa-archive-info"><?php the_excerpt(); ?></div>
                    <?php endif; ?>

                    <?php if ($show_readmore) : ?>
                        <div class="large-12 columns entry-readmore nasa-archive-info">
                            <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr__('CONTINUE READING  &#10142;', 'elessi-theme'); ?>">
                                <?php echo esc_html__('CONTINUE READING  &#10142;', 'elessi-theme'); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php
                    $tags_list = $post_blog && $show_tag_info ? get_the_tag_list('', esc_html__(', ', 'elessi-theme')) : false;
                    if ($tags_list) : ?>
                        <div class="large-12 columns">
                            <!-- Tagged -->
                            <span class="tags-links nasa-archive-info">
                                <?php printf(esc_html__('Tagged %1$s', 'elessi-theme'), $tags_list); ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </article>
</div>
