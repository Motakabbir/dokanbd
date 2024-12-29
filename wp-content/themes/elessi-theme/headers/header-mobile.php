<?php
/**
 * Header Mobile Layout - Default
 */
defined('ABSPATH') or die(); // Exit if accessed directly ?>

<div class="<?php echo esc_attr($header_classes); ?>">
    <?php
    /**
     * Hook - top bar header
     */
    do_action('nasa_topbar_header_mobile');
    ?>
    
    <div class="sticky-wrapper">
        <div id="masthead" class="site-header">
            
            <!-- Icons Left -->
            <div class="mini-icon-mobile left-icons elements-wrapper rtl-text-right nasa-flex jst">
                <?php 
                /**
                 * Hook: elessi_left_header_mobile_df
                 */
                do_action('nasa_left_header_mobile_df');
                ?>
            </div>

            <!-- Logo -->
            <div class="logo-wrapper elements-wrapper text-center">
                <?php
                /**
                 * Hook: elessi_center_header_mobile_df
                 */
                do_action('nasa_center_header_mobile_df');
                ?>
            </div>

            <!-- Icons Right -->
            <div class="right-icons elements-wrapper text-right rtl-text-left nasa-flex je">
                <?php
                /**
                 * Hook: elessi_right_header_mobile_df
                 */
                do_action('nasa_right_header_mobile_df');
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Menu site -->
<div class="hidden-tag">
    <?php
    elessi_get_main_menu();
    
    if ($vertical) :
        elessi_get_vertical_menu();
    endif;
    ?>
</div>
