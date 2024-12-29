<?php
/**
 * The template for displaying the header
 *
 * @package nasatheme
 */

global $nasa_opt;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<?php /*meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" / */?>
<meta name="viewport" content="<?php echo apply_filters('nasa_viewport_content', 'width=device-width, initial-scale=1'); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if (isset($nasa_opt['site_favicon']) && $nasa_opt['site_favicon']): ?>
<link rel="shortcut icon" href="<?php echo esc_attr($nasa_opt['site_favicon']); ?>" />
<?php else:
    wp_site_icon();
endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
wp_body_open();
do_action('nasa_theme_before_load');
?>

<!-- Start Wrapper Site -->
<div id="wrapper">

<!-- Start Main Content Site -->
<main id="main-content" class="site-main light">
