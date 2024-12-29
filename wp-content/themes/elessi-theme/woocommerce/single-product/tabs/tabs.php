<?php
/**
 * Single Product tabs / and sections
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 3.8.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($tabs)) :
    global $nasa_opt, $product;

    $tab_style = apply_filters('nasa_single_product_tabs_style', '2d-no-border');
    $off_canvas_mobile = $tab_style != 'scroll-down' && isset($nasa_opt['woo_tabs_off_canvas']) && $nasa_opt['woo_tabs_off_canvas'] ? true : false;
    
    $class_wrap = 'nasa-tabs-content woocommerce-tabs';
    $class_ul = 'nasa-tabs';

    switch ($tab_style) :
        case 'accordion':
        case 'accordion-2':
            $class_wrap = 'nasa-accordions-content fullwidth woocommerce-tabs nasa-no-global';
            $class_wrap .= $tab_style == 'accordion-2' ? ' nasa-arrow' : '';
            
            break;
        
        case 'small-accordion':
            $class_wrap = 'nasa-accordions-content nasa-no-border nasa-arrow woocommerce-tabs';
            break;

        case '2d':
            $class_ul .= ' nasa-classic-style nasa-classic-2d';
            break;

        case '2d-radius':
            $class_ul .= ' nasa-classic-style nasa-classic-2d nasa-tabs-no-border nasa-tabs-radius';
            break;
        
        case '2d-radius-dashed':
            $class_ul .= ' nasa-classic-style nasa-classic-2d nasa-tabs-radius-dashed';
            break;

        case '3d':
            $class_ul .= ' nasa-classic-style';
            break;

        case 'slide':
            $class_ul .= ' nasa-slide-style';
            break;
        
        case 'scroll-down':
            $class_wrap .= ' nasa-scroll-content';
            break;
        
        case 'ver-1':
            $class_wrap .= ' nasa-vertical-style';
            break;
        
        case 'ver-2':
            $class_wrap .= ' nasa-vertical-notabs';
            break;

        case '2d-no-border':
        default:
            $class_ul .= ' nasa-classic-style nasa-classic-2d nasa-tabs-no-border';
            break;
    endswitch;
    
    $class_wrap .= $off_canvas_mobile ? ' mobile-tabs-off-canvas nasa-transition-800' : '';

    ?>
    <div class="product-details" id="nasa-single-product-tabs">
        <?php
        echo $off_canvas_mobile ? '<a href="javascript:void(0);" class="nasa-toggle-woo-tabs hidden-tag" rel="nofollow">' . esc_html__('View Product Information', 'elessi-theme') . '</a>' : '';
        
        if (!isset($nasa_opt['ns_rm_sl']) || $nasa_opt['ns_rm_sl']) :
            echo '<script type="text/tempalte" id="tmp-read-more-tab">' .
                '<div class="ns-read-more">' .
                    '<a href="javascript:void(0);" data-show-less="' . esc_attr__("Show less", "elessi-theme") . '" data-show-more="' . esc_attr__("Read more", "elessi-theme") . '" class="ns-btn-read-more primary-color" rel="nofollow">' .
                        '<span class="ns-btn-read-more-text"> ' . esc_html__("Read more", "elessi-theme") . ' </span>'. 
                        '<svg width="30" height="30" viewBox="0 0 32 32" fill="currentColor"><path d="M15.233 19.175l0.754 0.754 6.035-6.035-0.754-0.754-5.281 5.281-5.256-5.256-0.754 0.754 3.013 3.013z" /></svg>' .
                    '</a>' .
                '</div>' .
            '</script>';
        endif;
        ?>
        
        <div class="<?php echo esc_attr($class_wrap); ?>">
            <?php
            echo $off_canvas_mobile ? '<a href="javascript:void(0);" class="nasa-toggle-woo-tabs nasa-stclose hidden-tag" rel="nofollow"></a>' : '';
            
            switch ($tab_style) :
                /**
                 * Accordion layout style
                 */
                case 'accordion':
                case 'accordion-2':
                    $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-tabs_accordion_layout.php';
                    if(!is_file($file)) :
                        $file = ELESSI_THEME_PATH . '/includes/nasa-single-product-tabs_accordion_layout.php';
                    endif;
                    break;
                    
                /**
                 * Accordion layout style
                 */
                case 'small-accordion':
                    $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-tabs_accordion_small_layout.php';
                    if(!is_file($file)) :
                        $file = ELESSI_THEME_PATH . '/includes/nasa-single-product-tabs_accordion_small_layout.php';
                    endif;
                    break;
                
                /**
                 * Scroll Down layout style
                 */
                case 'scroll-down':
                    $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-tabs_scroll_layout.php';
                    if(!is_file($file)) :
                        $file = ELESSI_THEME_PATH . '/includes/nasa-single-product-tabs_scroll_layout.php';
                    endif;
                    break;
                    
                /**
                 * Vertical layout style #1
                 */
                case 'ver-1':
                    $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-tabs_ver-1_layout.php';
                    if(!is_file($file)) :
                        $file = ELESSI_THEME_PATH . '/includes/nasa-single-product-tabs_ver-1_layout.php';
                    endif;
                    break;
                    
                /**
                 * Vertical layout style #2
                 */
                case 'ver-2':
                    $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-tabs_ver-2_layout.php';
                    if(!is_file($file)) :
                        $file = ELESSI_THEME_PATH . '/includes/nasa-single-product-tabs_ver-2_layout.php';
                    endif;
                    break;
                
                /**
                 * Tabs layout style
                 */
                default :
                    $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-tabs_tab_layout.php';
                    if(!is_file($file)) :
                        $file = ELESSI_THEME_PATH . '/includes/nasa-single-product-tabs_tab_layout.php';
                    endif;
                    break;
                    
            endswitch;
            
            /**
             * Content WooCommerce Tabs
             */
            include $file;
            ?>
        </div>
    </div>
<?php
endif;
