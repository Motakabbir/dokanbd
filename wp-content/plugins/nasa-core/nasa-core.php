<?php
/**
 * Plugin Name: Nasa Core
 * Plugin URI: https://nasatheme.com
 * Description: Shortcodes, custom post types and more for NasaTheme (ELESSI - THEME)
 * Version: 6.1.9
 * Author: NasaTheme Team
 * Author URI: https://themeforest.net/user/nasatheme/portfolio
 * License: https://themeforest.net/licenses
 * License URI: https://themeforest.net/licenses
 * Text Domain: nasa-core
 * Domain Path: /languages
 * Requires at least: 5.6
 * Requires PHP: 5.6.0 or Higher
 * 
 * @package Nasa Core - Elessi Theme
 */
defined('ABSPATH') or exit;

/**
 * Define CONST
 */
defined('NASA_CORE_ACTIVED') or define('NASA_CORE_ACTIVED', true);

defined('NASA_CORE_VERSION') or define('NASA_CORE_VERSION', '6.1.9');

defined('NASA_CORE_IN_ADMIN') or define('NASA_CORE_IN_ADMIN', is_admin());
defined('NASA_TIME_NOW') or define('NASA_TIME_NOW', time());

define('NASA_CORE_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('NASA_CORE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('NASA_CORE_LAYOUTS', NASA_CORE_PLUGIN_PATH . 'layouts/');

define('NASA_THEME_PATH', get_template_directory());
define('NASA_THEME_CHILD_PATH', get_stylesheet_directory());

define('NASA_COOKIE_VIEWED', 'woocommerce_recently_viewed');

/**
 * Auto-load
 */
require_once NASA_CORE_PLUGIN_PATH . 'nasa-autoloader.php';

/**
 * Load Text-Domain
 */
add_action('plugins_loaded', 'nasa_core_load_textdomain');
function nasa_core_load_textdomain() {
    $locale = apply_filters('plugin_locale', determine_locale(), 'nasa-core');
    $mofile = sprintf('%1$s-%2$s.mo', 'nasa-core', $locale);
    
    // /wp-content/languages/plugins/nasa-core-{locale}.mo => Support Languages Locate
    $mofile1 = WP_LANG_DIR . '/plugins/' . $mofile;

    // /wp-content/languages/loco/plugins/nasa-core-{locale}.mo => Support Loco Locate
    $mofile2 = WP_LANG_DIR . '/loco/plugins/' . $mofile;
    
    // /wp-content/languages/plugins/nasa-core/nasa-core-{locale}.mo => Support Languages/Plugins/nasa-core Locate
    $mofile3 = WP_LANG_DIR . '/plugins/nasa-core/' . $mofile;
    
    // /wp-content/plugins/nasa-core/languages/nasa-core-{locale}.mo => Support Language Author Locate
    $mofile4 = NASA_CORE_PLUGIN_PATH . 'languages/' . $mofile;
    
    unload_textdomain('nasa-core');
    
    /**
     * Load textdomain
     */
    if (file_exists($mofile1)) {
        load_textdomain('nasa-core', $mofile1);
    } elseif (file_exists($mofile2)) {
        load_textdomain('nasa-core', $mofile2);
    } elseif (file_exists($mofile3)) {
        load_textdomain('nasa-core', $mofile3);
    } elseif (file_exists($mofile4)) {
        load_textdomain('nasa-core', $mofile4);
    } else {
        load_plugin_textdomain('nasa-core', false, NASA_CORE_PLUGIN_PATH . 'languages');
    }
}
