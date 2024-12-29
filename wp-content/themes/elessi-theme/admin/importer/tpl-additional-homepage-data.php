<?php
defined('ABSPATH') or die();

defined('NASA_ELEMENTOR_ACTIVE') or define('NASA_ELEMENTOR_ACTIVE', defined('ELEMENTOR_PATH') && ELEMENTOR_PATH);

if (get_option('nasatheme_imported') === 'imported') : ?>
    <div class="nasa-dashboard-demo-data">
        <h1 class="demo-data-heading">
            <img class="nasa-logo" src="<?php echo ELESSI_THEME_URI; ?>/assets/images/logo.png" alt="Logo" />
        </h1>
        
        <div class="additional-btns">
            <a class="button button-primary button-hero" href="<?php echo esc_url(admin_url('/')); ?>"><?php echo esc_html__('Back to Dashboard', 'elessi-theme'); ?></a>

            <a class="button button-primary button-hero" href="<?php echo esc_url(admin_url('admin.php?page=' . NASA_ADMIN_PAGE_SLUG)); ?>"><?php echo esc_html__('Go to Theme Options', 'elessi-theme'); ?></a>

            <a class="button button-primary button-hero" href="<?php echo esc_url(home_url('/')); ?>" target="_blank"><?php echo esc_html__('View your website', 'elessi-theme'); ?></a>
        </div>
        
        <p><?php echo esc_html__("Please click on the item you want to add to your site to do the Homepage.", 'elessi-theme'); ?></p>
        
        <div class="addition-demo-data">
            <?php
            /**
             * Template Homepages list
             */
            $wpb_home = class_exists('Vc_Manager') ? true : false;
            $elm_home = NASA_ELEMENTOR_ACTIVE ? true : false;
            include 'tpl-homepage-list.php';
            ?>
        </div>
    </div>
<?php
endif;
