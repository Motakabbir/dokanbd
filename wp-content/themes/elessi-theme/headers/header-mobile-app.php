<?php
/**
 * Header Mobile Layout - App
 */

defined('ABSPATH') or die(); // Exit if accessed directly

$single_product = NASA_WOO_ACTIVED && is_product() ? true : false;
$class_sticky = 'sticky-wrapper';
$class_sticky .= $single_product ? ' product-header' : '';
?>

<div class="<?php echo esc_attr($header_classes); ?> style-app">
    <?php
    /**
     * Hook - top bar header
     */
    do_action('nasa_topbar_header_mobile_app');
    ?>
    <div class="<?php echo esc_attr($class_sticky); ?>">
        <div id="masthead" class="site-header">
            
            <!-- Icons Left -->
            <div class="mini-icon-mobile left-icons elements-wrapper rtl-text-right nasa-flex">
                <?php
                /**
                 * Hook: elessi_left_header_mobile_app
                 */
                do_action('nasa_left_header_mobile_app');
                ?>
            </div>
            
            <!-- Logo -->
            <div class="logo-wrapper elements-wrapper text-center nasa-min-height">
                <?php
                /**
                 * Hook: elessi_center_header_mobile_app
                 */
                do_action('nasa_center_header_mobile_app');
                ?>
            </div>

            <!-- Icons Right -->
            <div class="right-icons elements-wrapper text-right rtl-text-left">
                <?php
                /**
                 * Hook: elessi_right_header_mobile_app
                 */
                do_action('nasa_right_header_mobile_app');
                ?>
            </div>
        </div>
    </div>
</div>

<?php if (!$single_product) : ?>
    <!-- Menu site -->
    <div class="hidden-tag">
        <?php
        elessi_get_main_menu();
        
        if ($vertical) :
            elessi_get_vertical_menu();
        endif;
        ?>
    </div>
<?php
endif;
