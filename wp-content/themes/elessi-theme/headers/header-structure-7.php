<?php defined('ABSPATH') or die(); // Exit if accessed directly ?>

<div class="<?php echo esc_attr($header_classes); ?>">
    <div class="sticky-wrapper">
        <div id="masthead" class="site-header">
            <?php do_action('nasa_mobile_header'); ?>
            
            <div class="row nasa-hide-for-mobile">
                <div class="large-12 columns nasa-wrap-event-search">
                    <div class="nasa-header-flex nasa-elements-wrap">
                        <!-- Group icon header -->
                        <div class="nasa-flex-item-1-3 first-columns nasa-flex">
                            <a class="nasa-header-off nasa-icon margin-right-10 rtl-margin-right-0 rtl-margin-left-10 nasa-flex" href="javascript:void(0);" rel="nofollow">
                                <svg viewBox="0 0 32 32" width="28" height="28" fill="currentColor"><path d="M 4 7 L 4 9 L 28 9 L 28 7 Z M 4 15 L 4 17 L 28 17 L 28 15 Z M 4 23 L 4 25 L 28 25 L 28 23 Z"/></svg>
                            </a>
                            
                            <a class="search-icon desk-search nasa-icon nasa-search nasa-flex fs-26" href="javascript:void(0);" data-open="0" title="Search" rel="nofollow">
                                <svg fill="currentColor" viewBox="0 0 80 80" width="28" height="28"><path d="M74.3,72.2L58.7,56.5C69.9,44,69,24.8,56.5,13.5s-31.7-10.3-43,2.2s-10.3,31.7,2.2,43c11.6,10.5,29.3,10.5,40.9,0 l15.7,15.7L74.3,72.2z M36.1,63.5c-15.1,0-27.4-12.3-27.4-27.4C8.7,20.9,21,8.7,36.1,8.7c15.1,0,27.4,12.3,27.4,27.4 C63.5,51.2,51.2,63.5,36.1,63.5z"/><path d="M36.1,12.8v3c11.2,0,20.3,9.1,20.3,20.3h3C59.4,23.2,49,12.8,36.1,12.8z"/></svg>
                                </svg>
                            </a>
                        </div>

                        <!-- Logo -->
                        <div class="nasa-flex-item-1-3 text-center">
                            <?php echo elessi_logo(); ?>
                        </div>

                        <!-- Group icon header -->
                        <div class="nasa-flex-item-1-3">
                            <?php echo $nasa_header_icons; ?>
                        </div>
                    </div>
                    
                    <div class="nasa-header-search-wrap">
                        <?php echo elessi_search('icon'); ?>
                    </div>
                </div>
            </div>
            
            <?php if (defined('NASA_TOP_FILTER_CATS') && NASA_TOP_FILTER_CATS) : ?>
                <div class="nasa-top-cat-filter-wrap">
                    <?php echo elessi_get_all_categories(false, true); ?>
                    <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>" class="nasa-close-filter-cat nasa-stclose nasa-transition" rel="nofollow"></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Canvas -->
<div class="nasa-header-canvas canvas-wrap nasa-flex align-stretch nasa-hide-for-mobile nasa-transition-350">
    <div class="nasa-flex flex-column jbw wrap-1nd padding-top-50">
        <a href="javascript:void(0);" title="<?php echo esc_attr__('Close', 'elessi-theme'); ?>" class="nasa-close-canvas nasa-stclose" rel="nofollow"></a>
        
        <?php do_action('nasa_topbar_header_7'); ?>
    </div>
    <div class="nasa-flex flex-column jbw wrap-2nd margin-top-50 margin-bottom-50 padding-left-30 padding-right-0 rtl-padding-left-0 rtl-padding-right-30">
        <?php elessi_get_main_menu(); ?>
        <?php do_action('nasa_multi_lc'); ?>
    </div>
</div>
