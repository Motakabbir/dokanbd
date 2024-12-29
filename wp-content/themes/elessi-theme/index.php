<?php
/**
 * The main template file.
 *
 * @package nasatheme
 */

$nasa_sidebar = isset($nasa_opt['blog_layout']) ? $nasa_opt['blog_layout'] : 'left';
if (!is_active_sidebar('blog-sidebar')) :
    $nasa_sidebar = 'no';
endif;

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

if (isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile']) :
    $attr .= ' nasa-blog-in-mobile';
endif;

$class_wrap = 'container-wrap mobile-padding-top-10 page-' . $nasa_sidebar . '-sidebar';

$headling = isset($nasa_opt['posts_heading']) && $nasa_opt['posts_heading'] ? true : false;

get_header();

/**
 * Hook: nasa_before_archive_blog.
 */
do_action('nasa_before_archive_blogs');
?>

<div class="<?php echo esc_attr($class_wrap); ?>">
    <?php if ($hasSidebar) : ?>
        <div class="div-toggle-sidebar nasa-blog-sidebar center">
            <a class="toggle-sidebar" href="javascript:void(0);" rel="nofollow">
                <svg viewBox="0 0 32 32" width="26" height="24" fill="currentColor"><path d="M 4 7 L 4 9 L 28 9 L 28 7 Z M 4 15 L 4 17 L 28 17 L 28 15 Z M 4 23 L 4 25 L 28 25 L 28 23 Z" /></svg>
            </a>
        </div>
    <?php endif;?>
        
    <div class="row">
        <div id="content" class="<?php echo esc_attr($attr); ?>">
            <?php if ($headling) : ?>
                <header class="page-header">
                    <h1 class="page-title text-center"><?php echo esc_html__('Blog', 'elessi-theme'); ?></h1>
                </header>
            <?php endif; ?>
            
            <div class="page-inner">
                <?php if (have_posts()) :
                    get_template_part('content', get_post_format());
                else :
                    get_template_part('no-results', 'index');
                endif; ?>
            </div>
        </div>

        <?php if ($nasa_sidebar != 'no') : ?>
            <div class="large-3 columns  <?php echo ($left) ? 'left desktop-padding-right-20' : 'right desktop-padding-left-20'; ?> desktop-padding-bottom-50 col-sidebar">
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
