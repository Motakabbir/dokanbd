<?php
defined('ABSPATH') or die();

if (get_option('nasatheme_imported') !== 'imported') :
    
    /**
     * Required Plugins
     */
    $required_plugins = elessi_list_required_plugins();

    if (!function_exists('get_plugins')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    $keys = array_keys(get_plugins());
    
    if (!empty($keys)) {
        $actived = array();
        
        if (!empty($required_plugins)) {
            foreach ($required_plugins as $k => $plugin) {
                $file_path = $plugin['slug'];

                foreach ($keys as $key) {
                    if (preg_match('|^' . $plugin['slug'] . '/|', $key)) {
                        $file_path = $key;
                        break;
                    }
                }

                if (is_plugin_active($file_path)) {
                    unset($required_plugins[$k]);
                    $actived[] = $plugin['slug'];
                }
            }
        }
        
        if (!empty($required_plugins) && !empty($actived)) {
            foreach ($required_plugins as $k => $plugin) {
                $parent_actived = isset($plugin['parent']) && in_array($plugin['parent'], $actived) ? true : false;

                if ($parent_actived) {
                    unset($required_plugins[$k]['parent']);
                }
            }
        }
    }
    ?>
    <div class="nasa-dashboard-demo-data">
        <h1 class="demo-data-heading">
            <img class="nasa-logo" src="<?php echo ELESSI_THEME_URI; ?>/assets/images/logo.png" alt="Logo" />
        </h1>
        
        <p><?php echo esc_html__("This wizard will set up your theme, install plugins, import content. It is optional & should take only a few minutes.", 'elessi-theme'); ?></p>

        <?php
        if (!empty($required_plugins)) :
            echo '<div class="recommend-plugins">';
            
            echo '<p class="plugin-list-notice">' . esc_html__('Step 1: Install Plugins', 'elessi-theme') . '</p>';
            
            echo '<p class="plugin-note">' . esc_html__("Let's install some essential WordPress plugins to set up your site.", 'elessi-theme') . '</p>';
            
            // $builder_array = array('elementor', 'js_composer');
            
            foreach ($required_plugins as $plugin) :
                
                if (isset($plugin['auto']) && $plugin['auto']) :
                    $required = isset($plugin['required']) && $plugin['required'] ? true : false;
                
                    $class = 'recommend-plugin';
                    $class .= $required ? ' required-plugin' : '';
                    $class .= !$required && isset($plugin['unchecked']) && $plugin['unchecked'] ? '' : ' selected';
                    $class .= isset($plugin['buider']) && $plugin['buider'] ? ' builder-plugin' : '';
                    
                    $class .= ' plg-' . $plugin['slug'];
                    $class .= isset($plugin['parent']) && $plugin['parent'] ? ' child-plugin parent-plg-' . $plugin['parent'] : '';
                    
                    echo '<a href="javascript:void(0);" class="' . $class . '" data-slug="' . $plugin['slug'] . '" data-name="' . esc_attr($plugin['name']) . '">';
                    
                    echo $plugin['name'];
                    
                    echo $required ? '<span class="require-text">' . esc_html__('Required', 'elessi-theme') . '</span>' : '<span class="require-text">' . esc_html__('Recommended', 'elessi-theme') . '</span>';
                    
                    echo '</a>';
                endif;
                
            endforeach;
            
            echo '<a href="javascript:void(0);" class="confirm-selected-plugins nasa-disabled">' . esc_html__('CONTINUE', 'elessi-theme') . '</a>';
            
            echo '</div>';
        endif;
        ?>
        <div class="main-demo-data">
            <h1 class="demo-data-heading small runing-hide">
                <?php esc_html_e('Step 2: Choose Homepage Layout', 'elessi-theme'); ?>
            </h1>
            
            <p class="main-demo-data-notice"><?php echo esc_html__("Let's choose the homepage layout that you want to use on your website and click on the Start Import button.", 'elessi-theme'); ?></p>
            
            <p class="main-demo-data-notice color-gray"><?php echo esc_html__("Note: Images at demo are not included in the download package and they are replaced with placeholders in demo data.", 'elessi-theme'); ?></p>
            
            <a class="button button-hero nasa-back-step" href="javascript:void(0);"><?php echo esc_html__('BACK TO STEP 1', 'elessi-theme'); ?></a>
            
            <a class="button button-primary button-hero nasa-select-all" href="javascript:void(0);"><?php echo esc_html__('SELECT ALL HOMEPAGES', 'elessi-theme'); ?></a>
            
            <a class="button button-primary button-hero nasa-start-import" href="javascript:void(0);" data-permalink-option="<?php echo esc_url(admin_url('options-permalink.php')); ?>"><?php echo esc_html__('START IMPORT SAMPLE DATA', 'elessi-theme'); ?></a>

            <?php
            /**
             * Template Demo homepage list
             */
            include 'tpl-homepage-list.php';
            ?>
            
            <a class="button button-hero nasa-back-step" href="javascript:void(0);"><?php echo esc_html__('BACK TO STEP 1', 'elessi-theme'); ?></a>
            
            <a class="button button-primary button-hero nasa-select-all" href="javascript:void(0);"><?php echo esc_html__('SELECT ALL HOMEPAGES', 'elessi-theme'); ?></a>
            
            <a class="button button-primary button-hero nasa-start-import" href="javascript:void(0);" data-permalink-option="<?php echo esc_url(admin_url('options-permalink.php')); ?>"><?php echo esc_html__('START IMPORT SAMPLE DATA', 'elessi-theme'); ?></a>
            
            <div class="processing-demo-data">
                <h1 class="demo-data-heading small">
                    <?php esc_html_e('Step 3: Import Content', 'elessi-theme'); ?>
                </h1>
                <p class="processing-notice-first"><?php echo esc_html__('Please waiting in a few minutes, The process is running...', 'elessi-theme'); ?></p>

                <div class="process-bar-loading"><div class="process-bar-finished"></div></div>
                
                <ul class="processing-steps">
                    <li class="step processing-install-child-theme step-first" data-step="1">
                        <?php echo esc_html__('Install Elessi Theme - Child', 'elessi-theme'); ?>
                    </li>
                    <li class="step processing-data" data-step="2">
                        <?php echo esc_html__('Install Plugins', 'elessi-theme'); ?>
                        <ul class="plugins-installed" data-url_manual="<?php echo esc_url(admin_url('admin.php?page=install-required-plugins')); ?>" data-text_error="<?php echo esc_attr__('Opp! please try to install the plugins here', 'elessi-theme'); ?>"></ul>
                    </li>
                    <li class="step processing-data" data-step="3">
                        <?php echo esc_html__('Import Data (Media, Posts, Products, Categories...)', 'elessi-theme'); ?> - <span class="statistic-data">0/25</span>
                    </li>
                    <li class="step processing-widgets" data-step="4">
                        <?php echo esc_html__('Import Widgets Sidebars', 'elessi-theme'); ?>
                    </li>
                    <li class="step processing-homepage" data-step="5">
                        <?php echo esc_html__('Import Homes', 'elessi-theme'); ?> - <span class="statistic-homes"></span>
                    </li>
                    <li class="step processing-revsliders" data-step="6">
                        <?php echo esc_html__('Import Sliders', 'elessi-theme'); ?>
                    </li>
                    <li class="step processing-theme-options step-end" data-step="7">
                        <?php echo esc_html__('Setup Theme Options', 'elessi-theme'); ?>
                    </li>
                </ul>
                
                <p class="processing-notice-last nasa-bold">
                    <?php echo esc_html__("All Done. Have fun!", 'elessi-theme'); ?>
                </p>
                
                <p class="processing-notice-last">
                    <?php echo esc_html__("Your theme has been all setup. Enjoy your new theme.", 'elessi-theme'); ?>
                </p>
                
                <p class="processing-notice-last">
                    <a class="button button-primary button-hero button-complete" href="<?php echo esc_url(admin_url('admin.php?page=wc-status&tab=tools')); ?>"><?php echo esc_html__('WooCommerce Tools', 'elessi-theme'); ?></a>
                    <a class="button button-primary button-hero button-complete" href="<?php echo esc_url(admin_url('admin.php?page=' . NASA_ADMIN_PAGE_SLUG)); ?>"><?php echo esc_html__('Go to Theme Options', 'elessi-theme'); ?></a>
                    <a class="button button-primary button-hero button-complete" href="<?php echo esc_url(home_url('/')); ?>" target="_blank"><?php echo esc_html__('View your website', 'elessi-theme'); ?></a>
                </p>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="nasa-dashboard-demo-data">
        <h1 class="demo-data-heading">
            <img class="nasa-logo" src="<?php echo ELESSI_THEME_URI; ?>/assets/images/logo.png" alt="Logo" />
        </h1>
        
        <p class="processing-notice-last nasa-bold nasa-block">
            <?php echo esc_html__("All Done. Have fun!", 'elessi-theme'); ?>
        </p>

        <p class="processing-notice-last nasa-block">
            <?php echo esc_html__("Your theme has been all setup. Enjoy your new theme.", 'elessi-theme'); ?><br />
            <?php echo esc_html__("Demo data was imported. If you want import demo data again, You should need reset data of your site.", 'elessi-theme'); ?>
        </p>

        <p class="processing-notice-last nasa-block">
            <a class="button button-primary button-hero" href="<?php echo esc_url(home_url('/')); ?>" target="_blank"><?php echo esc_html__('View your website', 'elessi-theme'); ?></a>
        </p>
    </div>
<?php
endif;
