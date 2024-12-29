<?php
defined('ABSPATH') or die(); // Exit if accessed directly

$topbar_left = !isset($topbar_left) ? '' : $topbar_left;
$class_topbar = !isset($class_topbar) ? '' : $class_topbar;
$class_topbar .= trim($topbar_left) != '' ? '' : ' hide-for-mobile';
?>
<div class="nasa-topbar-wrap<?php echo esc_attr($class_topbar); ?>">
    <div id="top-bar" class="top-bar">
        <?php if (!$mobile) : ?>
            <!-- Desktop | Responsive Top-bar -->
            <div class="row">
                <div class="large-12 columns">
                    <div class="left-text left rtl-right">
                        <?php echo $topbar_left; ?>
                    </div>
                    <div class="right-text nasa-hide-for-mobile right rtl-left">
                        <div class="topbar-menu-container">
                            <?php do_action('nasa_topbar_menu'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <!-- Mobile Top-bar -->
            <?php if ($topbar_left) : ?>
                <div class="topbar-mobile-text">
                    <?php echo $topbar_left; ?>
                </div>
            <?php endif; ?>
            
            <div class="topbar-menu-container hidden-tag">
                <?php do_action('nasa_mobile_topbar_menu'); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php if (!$mobile) : ?>
        <div class="nasa-hide-for-mobile">
            <a class="nasa-icon-toggle" href="javascript:void(0);" rel="nofollow">
                <svg class="nasa-topbar-up" width="26" height="26" viewBox="0 0 32 32">
                    <path d="M16.767 12.809l-0.754-0.754-6.035 6.035 0.754 0.754 5.281-5.281 5.256 5.256 0.754-0.754-3.013-3.013z" fill="currentColor" />
                </svg>

                <svg class="nasa-topbar-down" width="26" height="26" viewBox="0 0 32 32">
                    <path d="M15.233 19.175l0.754 0.754 6.035-6.035-0.754-0.754-5.281 5.281-5.256-5.256-0.754 0.754 3.013 3.013z" fill="currentColor" />
                </svg>
            </a>
        </div>
    <?php endif; ?>
</div>
