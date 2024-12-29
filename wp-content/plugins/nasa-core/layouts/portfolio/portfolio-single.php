<?php
/**
 * The Template for displaying single portfolio project.
 *
 */
get_header();

do_action('nasa_before_single_portfolio');
?>

<div class="row">
    <div class="content large-12 columns margin-bottom-70">
        <?php if (have_posts()) :
            while (have_posts()) :
                the_post(); ?>
                <div class="portfolio-single-item">
                    <?php the_content(); ?>
                </div>
            <?php 
            endwhile;
        else : ?>
            <h3><?php esc_html_e('Not found!', 'nasa-core') ?></h3>
        <?php endif; ?>
        
        <div class="clear"></div>
        
        <?php
        if (!isset($nasa_opt['portfolio_comments']) || $nasa_opt['portfolio_comments']) :
            comments_template('', true);
        endif;
        
        if (!isset($nasa_opt['recent_projects']) || $nasa_opt['recent_projects']) :
            global $post;
            $not_in = $post->ID ? array($post->ID) : array();
            echo nasa_get_recent_portfolio(apply_filters('ns_relate_portfolio_number', 8), esc_html__('Recent Works', 'nasa-core'), $not_in);
        endif;
        ?>
    </div>
</div>
<?php

do_action('nasa_after_single_portfolio');

get_footer();
