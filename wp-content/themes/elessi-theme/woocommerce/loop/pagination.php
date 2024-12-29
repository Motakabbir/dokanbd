<?php

/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author  NasaTheme
 * @package Elessi-theme/WooCommerce
 * @version 9.3.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $nasa_opt, $nasa_loadmore_style;

if (!isset($nasa_loadmore_style) || !is_array($nasa_loadmore_style) || empty($nasa_loadmore_style)) {
    $nasa_loadmore_style = array('infinite', 'load-more');
}

$nasa_ajax_product = (defined('NASA_AJAX_SHOP') && NASA_AJAX_SHOP) ? NASA_AJAX_SHOP : false;

$total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
$current = isset($current) ? $current : wc_get_loop_prop('current_page');
$base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));

$format  = isset($format) ? $format : '';

$pagination_style = isset($nasa_opt['pagination_style']) ? $nasa_opt['pagination_style'] : 'style-2';

if (isset($_GET['paging-style']) && in_array($_GET['paging-style'], $nasa_loadmore_style)) :
    $pagination_style = $_GET['paging-style'];
endif;

if (!$nasa_ajax_product) :
    $pagination_style = $pagination_style == 'style-2' ? 'style-2' : 'style-1';
endif;

$loadmore = in_array($pagination_style, $nasa_loadmore_style);
$loadmoreClass = 'text-center';
$loadmoreClass .= $pagination_style == 'infinite' ? ' nasa-infinite-shop' : '';

$class_wrap = 'row nasa-paginations-warp filters-container-down';
$class_wrap .= $loadmore ? ' paging-style-loadmore' : '';

if ($total <= 1) :
    return;
endif;
?>

<!-- PAGINATION -->
<div id="nasa-paging" class="<?php echo esc_attr($class_wrap); ?>">
    <div class="large-12 columns">
        <?php
        if ($loadmore) :
            echo '<div id="nasa-wrap-archive-loadmore" class="' . $loadmoreClass . '">';
            
            if ($current >= $total) :
                echo '<p>' . esc_html__('ALL PRODUCTS LOADED !', 'elessi-theme') . '</p>';
            else :
                echo '<a class="nasa-archive-loadmore" href="javascript:void(0);" rel="nofollow">';
                echo esc_html__('LOAD MORE ...', 'elessi-theme');
                echo '</a>';
            endif;
            
            echo '</div>';
        endif;
        
        if ($pagination_style == 'style-1') : ?>
            <div class="nasa-pagination nasa-pagination-store clearfix style-1">
                <div class="page-sumary">
                    <?php do_action('nasa_shop_category_count'); ?>
                </div>
                <nav class="woocommerce-pagination page-numbers-wrap" aria-label="<?php esc_attr_e('Product Pagination', 'elessi-theme'); ?>">
                    <?php
                    echo paginate_links(apply_filters('woocommerce_pagination_args', array(
                        'base' => $base,
                        'format' => $format,
                        'current' => max(1, $current),
                        'total' => $total
                    )));
                    ?>
                </nav>
            </div>
        <?php else : ?>
            <div class="nasa-pagination nasa-pagination-store style-2">
                <nav class="woocommerce-pagination page-numbers-wrap" aria-label="<?php esc_attr_e('Product Pagination', 'elessi-theme'); ?>">
                    <?php
                    echo paginate_links(apply_filters('woocommerce_pagination_args', array(
                        'base' => $base,
                        'format' => $format,
                        'current' => max(1, $current),
                        'total' => $total
                    )));
                    ?>
                </nav>
                <!-- hr /-->
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
/*!-- end PAGINATION -- */
