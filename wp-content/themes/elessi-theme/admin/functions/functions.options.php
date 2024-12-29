<?php

// Option elements
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_01_general_heading.php';
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_02_logo_icon_heading.php';
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_03_1_header_heading.php';
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_03_2_footer_heading.php';

/**
 * Mobile Options
 */
if (NASA_CORE_ACTIVED) {
    require_once ELESSI_THEME_PATH . '/admin/settings/nasa_03_3_mobile_heading.php';
}

require_once ELESSI_THEME_PATH . '/admin/settings/nasa_04_style_color_heading.php';
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_05_type_heading.php';

if (NASA_WOO_ACTIVED) {
    require_once ELESSI_THEME_PATH . '/admin/settings/nasa_06_breadcrumb_heading.php';
    require_once ELESSI_THEME_PATH . '/admin/settings/nasa_07_1_product_global_heading.php';
    require_once ELESSI_THEME_PATH . '/admin/settings/nasa_07_2_product_page_heading.php';
    require_once ELESSI_THEME_PATH . '/admin/settings/nasa_07_3_product_detail_heading.php';
    require_once ELESSI_THEME_PATH . '/admin/settings/nasa_07_4_product_compare_heading.php';
    
    if (NASA_DOKAN_ACTIVED) {
        require_once ELESSI_THEME_PATH . '/admin/settings/nasa_07_5_dokan_heading.php';
    }
}

require_once ELESSI_THEME_PATH . '/admin/settings/nasa_08_blog_heading.php';
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_09_promo_popup_heading.php';
// require_once ELESSI_THEME_PATH . '/admin/settings/nasa_10_portfolio_heading.php';

/**
 * Add Backup Options
 */
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_98_backup_options_heading.php';

/**
 * White Label Options
 */
require_once ELESSI_THEME_PATH . '/admin/settings/nasa_99_white_label_heading.php';
