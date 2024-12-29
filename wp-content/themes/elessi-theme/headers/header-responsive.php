<?php
/**
 * Header Responsive
 */
defined('ABSPATH') or die();
?>

<div class="mobile-menu header-responsive">
    <div class="mini-icon-mobile nasa-flex">
        <?php 
        /**
         * Hook: elessi_left_header_mobile_rp
         */
        do_action('nasa_left_header_mobile_rp');
        ?>
    </div>

    <div class="logo-wrapper">
        <?php
        /**
         * Hook: elessi_center_header_mobile_rp
         */
        do_action('nasa_center_header_mobile_df');
        ?>
    </div>

    <div class="nasa-mobile-icons-wrap mini-icon-mobile">
        <?php
        /**
         * Hook: elessi_right_header_mobile_rp
         */
        do_action('nasa_right_header_mobile_rp');
        ?>
    </div>
</div>
