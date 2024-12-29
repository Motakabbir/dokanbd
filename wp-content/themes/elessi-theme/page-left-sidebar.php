<?php
/*
  Template name: Page Left Sidebar
 */

get_header();

if (has_excerpt()) : ?>
    <div class="page-header">
        <?php the_excerpt(); ?>
    </div>
<?php endif; ?>

<div class="container-wrap page-left-sidebar">
    <div class="row">

        <div id="content" class="large-9 desktop-padding-left-30 right columns">
            <div class="page-inner">
                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('content', 'page');
                    
                    if (comments_open() || '0' != get_comments_number()):
                        comments_template();
                    endif;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>

        <div class="large-3 columns desktop-padding-bottom-50 left col-sidebar">
            <a href="javascript:void(0);" title="<?php echo esc_attr__('Close', 'elessi-theme'); ?>" class="hidden-tag nasa-close-sidebar" rel="nofollow">
                <svg class="nasa-rotate-180" width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z" /></svg>
            </a>
            <?php get_sidebar(); ?>
        </div>

    </div>
</div>

<?php
get_footer();