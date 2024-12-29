<?php
/**
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package nasatheme
 */

$nasa_sidebar = isset($nasa_opt['blog_layout']) ? $nasa_opt['blog_layout'] : 'left';
$hasSidebar = true;
$left = true;
switch ($nasa_sidebar):
    case 'right':
        $left = false;
        $attr = 'large-9 medium-12 tablet-padding-right-10 desktop-padding-right-30 left columns';
        break;
    
    case 'no':
        $hasSidebar = false;
        $left = false;
        $attr = 'large-12 columns';
        break;
    
    case 'left':
    default:
        $attr = 'large-9 medium-12 tablet-padding-left-10 desktop-padding-left-30 right columns';
        break;
endswitch;

$class_wrap = 'container-wrap mobile-padding-top-10';
$class_wrap .= $nasa_sidebar ? ' page-' . $nasa_sidebar . '-sidebar' : ' page-left-sidebar';

if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) :
    $attr .= ' nasa-blog-in-mobile';
endif;

$headling = !isset($nasa_opt['blog_heading']) || $nasa_opt['blog_heading'] ? true : false;

get_header();

/**
 * Hook: nasa_before_archive_blog.
 */
do_action('nasa_before_archive_blogs');
?>

<div class="<?php echo esc_attr($class_wrap); ?>">

    <?php if ($hasSidebar): ?>
        <div class="div-toggle-sidebar nasa-blog-sidebar center">
            <a class="toggle-sidebar" href="javascript:void(0);" rel="nofollow">
                <svg viewBox="0 0 32 32" width="26px" height="24px" fill="currentColor"><path d="M 4 7 L 4 9 L 28 9 L 28 7 Z M 4 15 L 4 17 L 28 17 L 28 15 Z M 4 23 L 4 25 L 28 25 L 28 23 Z" /></svg>
            </a>
        </div>
    <?php endif; ?>

    <div class="row">
        <div id="content" class="<?php echo esc_attr($attr); ?>">
            <?php if (have_posts()) : ?>
                <?php if ($headling) : ?>
                    <header class="page-header">
                        <h1 class="page-title">
                            <?php
                            if (is_category()) :
                                printf(esc_html__('Category Archives: %s', 'elessi-theme'), '<span>' . single_cat_title('', false) . '</span>');

                            elseif (is_tag()) :
                                printf(esc_html__('Tag Archives: %s', 'elessi-theme'), '<span>' . single_tag_title('', false) . '</span>');

                            elseif (is_author()) : the_post();
                                printf(esc_html__('Author Archives: %s', 'elessi-theme'), '<span class="vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . '</a></span>');
                                rewind_posts();

                            elseif (is_day()) :
                                printf(esc_html__('Daily Archives: %s', 'elessi-theme'), '<span>' . get_the_date() . '</span>');

                            elseif (is_month()) :
                                printf(esc_html__('Monthly Archives: %s', 'elessi-theme'), '<span>' . get_the_date('F Y') . '</span>');

                            elseif (is_year()) :
                                printf(esc_html__('Yearly Archives: %s', 'elessi-theme'), '<span>' . get_the_date('Y') . '</span>');

                            elseif (is_tax('post_format', 'post-format-aside')) :
                                esc_html_e('Asides', 'elessi-theme');

                            elseif (is_tax('post_format', 'post-format-image')) :
                                esc_html_e('Images', 'elessi-theme');

                            elseif (is_tax('post_format', 'post-format-video')) :
                                esc_html_e('Videos', 'elessi-theme');

                            elseif (is_tax('post_format', 'post-format-quote')) :
                                esc_html_e('Quotes', 'elessi-theme');

                            elseif (is_tax('post_format', 'post-format-link')) :
                                esc_html_e('Links', 'elessi-theme');

                            else :
                                esc_html_e('', 'elessi-theme');

                            endif;
                            ?>
                        </h1>
                        <?php
                        if (is_category()) :
                            $category_description = category_description();
                            if (!empty($category_description)) :
                                echo apply_filters('category_archive_meta', '<div class="taxonomy-description margin-bottom-30">' . $category_description . '</div>');
                            endif;

                        elseif (is_tag()) :
                            $tag_description = tag_description();
                            if (!empty($tag_description)) :
                                echo apply_filters('tag_archive_meta', '<div class="taxonomy-description margin-bottom-30">' . $tag_description . '</div>');
                            endif;

                        endif;
                        ?>
                    </header>
                <?php endif; ?>

                <div class="page-inner">
                    <?php get_template_part('content', get_post_format()); ?>
                </div>
            <?php else : ?>
                <?php get_template_part('no-results', 'archive'); ?>
            <?php endif; ?>
        </div>

        <?php if ($nasa_sidebar != 'no') : ?>
            <div class="large-3 columns <?php echo $left ? 'left desktop-padding-right-20' : 'right desktop-padding-left-20'; ?>  desktop-padding-bottom-50 col-sidebar">
                <a href="javascript:void(0);" title="<?php echo esc_attr__('Close', 'elessi-theme'); ?>" class="hidden-tag nasa-close-sidebar" rel="nofollow">
                    <svg class="nasa-rotate-180" width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z" /></svg>
                </a>
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php
get_footer();
