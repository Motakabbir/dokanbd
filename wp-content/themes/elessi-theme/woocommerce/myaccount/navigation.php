<?php
/**
 * My Account navigation
 * 
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 9.3.0
 */
if (!defined('ABSPATH')) :
    exit;
endif;

do_action('woocommerce_before_account_navigation');

$file = ELESSI_CHILD_PATH . '/includes/nasa-acc-nav.php';
include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-acc-nav.php';

do_action('woocommerce_after_account_navigation');
