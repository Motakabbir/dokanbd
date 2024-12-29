<?php

/**
 * Product Loop Start
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 3.3.0
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $nasa_opt, $woocommerce_loop;

$data_columns_small = 1;
$data_columns_tablet = 2;

$class_wrap = '';

/**
 * Loop in Shop page
 */
if (!isset($woocommerce_loop['is_shortcode']) || !$woocommerce_loop['is_shortcode']) {
    $typeView = isset($nasa_opt['products_type_view']) && in_array($nasa_opt['products_type_view'],array('grid', 'list', 'list-2')) ? $nasa_opt['products_type_view'] : 'grid';

    switch ($typeView) :
        case 'list' :
            $class_wrap = 'list';
            break;
        
        case 'list-2' :
            $class_wrap = 'list-2 list';
            break;

        case 'grid' :
        default:
            $class_wrap = 'grid';
            break;
    endswitch;
    
    $nasa_change_view = !isset($nasa_opt['enable_change_view']) || $nasa_opt['enable_change_view'] ? true : false;
    
    $products_per_row = (isset($nasa_opt['products_type_view']) && $nasa_opt['products_type_view'] == 'list') ? 4 :
        (isset($nasa_opt['products_per_row']) && (int) $nasa_opt['products_per_row'] ? (int) $nasa_opt['products_per_row'] : 4);

    if (isset($_GET['view-layout']) && in_array($_GET['view-layout'], array('grid-2', 'grid-3', 'grid-4', 'grid-5', 'grid-6', 'list', 'list-2'))) :
        switch ($_GET['view-layout']) :
            case 'grid-2' :
                $class_wrap = 'grid';
                $products_per_row = 2;
                break;
            
            case 'grid-3' :
                $class_wrap = 'grid';
                $products_per_row = 3;
                break;

            case 'grid-5' :
                $class_wrap = 'grid';
                $products_per_row = 5;
                break;
            
            case 'grid-6' :
                $class_wrap = 'grid';
                $products_per_row = 6;
                break;

            case 'grid-4' :
                $class_wrap = 'grid';
                $products_per_row = 4;
                break;
            case 'list' :
                $products_per_row = 4;
                $class_wrap = 'list';
                break;
            case 'list-2' :
                $products_per_row = 4;
                $class_wrap = 'list-2 list';
                break;
            default:
                $class_wrap = 'grid';
                $products_per_row = 4;
                break;
        endswitch;
    endif;
}

/**
 * Loop in Short code
 */
else {
    $class_wrap = 'grid';
    $products_per_row = isset($woocommerce_loop['columns']) ? $woocommerce_loop['columns'] :
        (isset($nasa_opt['products_per_row']) && (int) $nasa_opt['products_per_row'] ? (int) $nasa_opt['products_per_row'] : 4);
}

/**
 * Columns for desktop
 */
switch ($products_per_row):
    case 2:
        $class_wrap .= ' large-block-grid-2';
        break;
    
    case 3:
        $class_wrap .= ' large-block-grid-3';
        break;

    case 5:
        $class_wrap .= ' large-block-grid-5';
        break;
    
    case 6:
        $class_wrap .= ' large-block-grid-6';
        break;

    case 4:
    default:
        $class_wrap .= ' large-block-grid-4';
        break;
endswitch;

/**
 * Columns for mobile
 */
$products_per_row_small = isset($nasa_opt['products_per_row_small']) && (int) $nasa_opt['products_per_row_small'] ? (int) $nasa_opt['products_per_row_small'] : 1;
switch ($products_per_row_small):
    case 2:
        $class_wrap .= ' small-block-grid-2';
        $data_columns_small = 2;
        break;
    case 1:
    default:
        $class_wrap .= ' small-block-grid-1';
        $data_columns_small = 1;
        break;
endswitch;

/**
 * Columns for tablet
 */
$products_per_row_tablet = isset($nasa_opt['products_per_row_tablet']) && (int) $nasa_opt['products_per_row_tablet'] ? (int) $nasa_opt['products_per_row_tablet'] : 2;
switch ($products_per_row_tablet):
    case 3:
        $class_wrap .= ' medium-block-grid-3';
        $data_columns_tablet = 3;
        break;
    case 4:
        $class_wrap .= ' medium-block-grid-4';
        $data_columns_tablet = 4;
        break;
    case 2:
    default:
        $class_wrap .= ' medium-block-grid-2';
        $data_columns_tablet = 2;
        break;
endswitch;

$loop_start_class = apply_filters('nasa_loop_start_class', $class_wrap);

$class_warp_all = 'nasa-content-page-products';
if (isset($nasa_opt['loop_layout_buttons']) && $nasa_opt['loop_layout_buttons'] != '') :
    $class_warp_all .= ' nasa-' . $nasa_opt['loop_layout_buttons'];
endif;
?>

<div class="<?php echo esc_attr($class_warp_all); ?>">
    <ul class="products <?php echo esc_attr($loop_start_class); ?>" data-columns_small="<?php echo esc_attr($data_columns_small); ?>" data-columns_medium="<?php echo esc_attr($data_columns_tablet); ?>">
