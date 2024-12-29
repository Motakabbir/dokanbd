<?php
/**
 * Change view Layout
 * Archive Products page
 */

if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

$typeView = isset($nasa_opt['products_type_view']) && in_array($nasa_opt['products_type_view'],array('grid', 'list', 'list-2')) ? $nasa_opt['products_type_view'] : 'grid';

$products_per_row = isset($nasa_opt['products_per_row']) && in_array($nasa_opt['products_per_row'], array(2, 3, 4, 5, 6)) ? $nasa_opt['products_per_row'] : 4;

switch ($typeView) :
    case 'list' :
        $setup = $type_show = 'list';
        break;
    
    case 'list-2' :
        $setup = $type_show = 'list-2';
        break;

    case 'grid' :
    default:
        $setup = $type_show = 'grid-' . $products_per_row;
        break;
endswitch;

if (isset($_GET['view-layout']) && in_array($_GET['view-layout'], array('grid-2', 'grid-3', 'grid-4', 'grid-5', 'grid-6', 'list', 'list-2'))) {
    $type_show = $_GET['view-layout'];
}

$classic = in_array($nasa_sidebar, array('left-classic', 'right-classic', 'top-push-cat'));
echo $classic ? '<input type="hidden" name="nasa-data-sidebar" value="' . esc_attr($nasa_sidebar) . '" />' : '';

$col_2 = isset($nasa_opt['option_2_cols']) && $nasa_opt['option_2_cols'] ? true : false;
$col_6 = isset($nasa_opt['option_6_cols']) && $nasa_opt['option_6_cols'] ? true : false;

$class_wrap = 'filter-tabs nasa-change-view';
$layout_view = isset($nasa_opt['nasa_change_layout_view']) && in_array($nasa_opt['nasa_change_layout_view'],array('number_view', 'img_view_2', 'img_view_1')) ? $nasa_opt['nasa_change_layout_view'] : 'img_view_1';
$number_view = false;

$multicheck_option_cols_display = array();

if (isset($nasa_opt['multicheck_options_cols_display'])) {
    if (!empty($nasa_opt['multicheck_options_cols_display'])) {
        foreach ($nasa_opt['multicheck_options_cols_display'] as $key => $val) {
            if ($val && !in_array($key, $multicheck_option_cols_display)) {
                $multicheck_option_cols_display[] = $key;
            }

            if (!in_array($products_per_row . '-cols', $multicheck_option_cols_display) && $products_per_row . '-cols' === $key) {
                $multicheck_option_cols_display[] = $products_per_row.'-cols';
            }
        }
    } else {
        $multicheck_option_cols_display = array("3-cols", "4-cols", "5-cols", "list");
    }
} else {
    if ($col_2) {
        $multicheck_option_cols_display[] = '2-cols';
    }
    
    if ($col_6) {
        $multicheck_option_cols_display[] = '6-cols';
    }
}

$svg_2col = '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" viewBox="0 0 17 18" fill="none">
            <rect width="8" height="8" rx="2" fill="currentColor"/>
            <rect y="9" width="8" height="8" rx="2" fill="currentColor"/>
            <rect x="9" width="8" height="8" rx="2" fill="currentColor"/>
            <rect x="9" y="9" width="8" height="8" rx="2" fill="currentColor"/>
            </svg>';

$svg_3col = '<svg xmlns="http://www.w3.org/2000/svg" width="26" height="17" viewBox="0 0 26 18" fill="none">
            <rect width="8" height="8" rx="2" fill="currentColor"/>
            <rect y="9" width="8" height="8" rx="2" fill="currentColor"/>
            <rect x="9" width="8" height="8" rx="2" fill="currentColor"/>
            <rect x="18" width="8" height="8" rx="2" fill="currentColor"/>
            <rect x="9" y="9" width="8" height="8" rx="2" fill="currentColor"/>
            <rect x="18" y="9" width="8" height="8" rx="2" fill="currentColor"/>
            </svg>';

$svg_4col = '<svg xmlns="http://www.w3.org/2000/svg" width="23" height="17" viewBox="0 0 23 18" fill="none">
            <rect y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="6" y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="12" y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="18" y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="6" y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="12" y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="18" y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="18" width="5" height="5" rx="1" fill="currentColor"/>
            </svg>';

$svg_5col = '<svg xmlns="http://www.w3.org/2000/svg" width="29" height="17" viewBox="0 0 29 18" fill="none">
            <rect y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="6" y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="12" y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="18" y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="24" y="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="6" y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="12" y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="18" y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="24" y="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="6" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="12" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="18" width="5" height="5" rx="1" fill="currentColor"/>
            <rect x="24" width="5" height="5" rx="1" fill="currentColor"/>
            </svg>';

$svg_6col = '<svg xmlns="http://www.w3.org/2000/svg" width="29" height="17" viewBox="0 0 29 18" fill="none">
            <rect width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="5" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="10" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="15" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="20" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="25" width="4" height="4" rx="1" fill="currentColor"/>
            <rect y="6.5" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="5" y="6.5" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="10" y="6.5" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="15" y="6.5" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="20" y="6.5" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="25" y="6.5" width="4" height="4" rx="1" fill="currentColor"/>
            <rect y="13" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="5" y="13" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="10" y="13" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="15" y="13" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="20" y="13" width="4" height="4" rx="1" fill="currentColor"/>
            <rect x="25" y="13" width="4" height="4" rx="1" fill="currentColor"/>
            </svg>';

$svg_list = '<svg xmlns="http://www.w3.org/2000/svg" width="21" height="17" viewBox="0 0 21 18" fill="none">
            <rect x="9" y="2" width="12" height="1" rx="0.5" fill="currentColor"/>
            <rect x="9" y="4" width="12" height="1" rx="0.5" fill="currentColor"/>
            <rect width="8" height="8" rx="1.5" fill="currentColor"/>
            <rect x="9" y="11" width="12" height="1" rx="0.5" fill="currentColor"/>
            <rect x="9" y="13" width="12" height="1" rx="0.5" fill="currentColor"/>
            <rect y="9" width="8" height="8" rx="1.5" fill="currentColor"/>
            </svg>';

$svg_list2 = '<svg xmlns="http://www.w3.org/2000/svg" width="29" height="17" viewBox="0 0 29 18" fill="none">
            <rect x="8" y="2" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect x="8" y="4" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect width="7" height="7" rx="1.5" fill="currentColor"/>
            <rect x="8" y="12" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect x="8" y="14" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect y="10" width="7" height="7" rx="1.5" fill="currentColor"/>
            <rect x="23" y="2" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect x="23" y="4" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect x="15" width="7" height="7" rx="1.5" fill="currentColor"/>
            <rect x="23" y="12" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect x="23" y="14" width="6" height="0.8" rx="0.4" fill="currentColor"/>
            <rect x="15" y="10" width="7" height="7" rx="1.5" fill="currentColor"/>
            </svg>';

switch ($layout_view):
    case 'number_view':
        $class_wrap .= ' nasa-show-number';
        $number_view = true;
        break;

    case 'img_view_2':
        $class_wrap .= ' nasa-change-layout-img-2';
        $svg_2col = '<svg xmlns="http://www.w3.org/2000/svg" width="6" height="12" viewBox="0 0 6 12" fill="none">
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 1.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 5.5 0)" fill="currentColor"/>
                    </svg>';
        $svg_3col = '<svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 10 12" fill="none">
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 1.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 5.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 9.5 0)" fill="currentColor"/>
                    </svg>';
        $svg_4col = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 1.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 5.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 9.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 13.5 0)" fill="currentColor"/>
                    </svg>';
        $svg_5col = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 1.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 4.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 7.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 10.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 13.5 0)" fill="currentColor"/>
                    </svg>';
        $svg_6col = '<svg xmlns="http://www.w3.org/2000/svg" width="17" height="12" viewBox="0 0 17 12" fill="none">
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 1.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 4.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 7.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 10.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 13.5 0)" fill="currentColor"/>
                    <rect width="1.5" height="12" rx="0.75" transform="matrix(-1 0 0 1 16.5 0)" fill="currentColor"/>
                    </svg>';
        $svg_list = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 10" fill="none">
                    <rect width="1.5" height="14" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 8)" fill="currentColor"/>
                    <rect width="1.5" height="14" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 4)" fill="currentColor"/>
                    <rect width="1.5" height="14" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 0)" fill="currentColor"/>
                    </svg>';
        $svg_list2 = '<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 10" fill="none">
                    <rect width="1.5" height="6" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 8 8)" fill="currentColor"/>
                    <rect width="1.5" height="6" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 8 4)" fill="currentColor"/>
                    <rect width="1.5" height="6" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 8 0)" fill="currentColor"/>
                    <rect width="1.5" height="6" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 8)" fill="currentColor"/>
                    <rect width="1.5" height="6" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 4)" fill="currentColor"/>
                    <rect width="1.5" height="6" rx="0.75" transform="matrix(4.37114e-08 1 1 -4.37114e-08 0 0)" fill="currentColor"/>
                    </svg>';
        break;
    
    case 'img_view_1':
    default :
        $class_wrap .= ' nasa-change-layout-img-1';
        break;
endswitch;

$list_view = isset($nasa_opt['products_layout_style']) && $nasa_opt['products_layout_style'] == 'masonry-isotope' ? false : true;
?>
<div class="<?php echo $class_wrap; ?>">
    <?php if ($number_view && !empty($multicheck_option_cols_display)) : ?>
        <span class="nasa-label-change-view margin-right-10 rtl-margin-right-0 rtl-margin-left-10 nasa-bold-700">
            <?php echo esc_html__('See', 'elessi-theme'); ?>
        </span>
    <?php endif; ?>

    <?php if (in_array('2-cols', $multicheck_option_cols_display)) : ?>
        <a href="javascript:void(0);" class="nasa-change-layout productGrid grid-2 nasa-tip<?php echo ($type_show == 'grid-2') ? ' active' : ''; ?><?php echo ($setup == 'grid-2') ? ' df' : ''; ?>" data-tip="<?php echo esc_html__('2 Columns', 'elessi-theme'); ?>" data-columns="2" rel="nofollow">
            <?php if ($number_view) : ?>
                <span class="nasa-text-number hidden-tag">
                    <?php echo esc_html__('2', 'elessi-theme'); ?>
                </span>
            <?php endif; ?>

            <?php echo ($svg_2col); ?>
            <!-- <svg width="22" height="22" viewBox="0 0 512 512" fill="currentColor">
                <path d="M333 53l0 408-67 0 0-410 67 0z m-87-2l0 410-67 0 0-410c0 0 67 0 67 0z"/>
            </svg> -->
        </a>
    <?php endif; ?>

    <?php if (in_array('3-cols', $multicheck_option_cols_display)) : ?>
    <a href="javascript:void(0);" class="nasa-change-layout productGrid grid-3 nasa-tip<?php echo ($type_show == 'grid-3') ? ' active' : ''; ?><?php echo ($setup == 'grid-3') ? ' df' : ''; ?>" data-columns="3" rel="nofollow" data-tip="<?php echo esc_html__('3 Columns', 'elessi-theme'); ?>">
        <?php if ($number_view) : ?>
            <span class="nasa-text-number hidden-tag">
                <?php echo esc_html__('3', 'elessi-theme'); ?>
            </span>
        <?php endif; ?>

        <?php echo ($svg_3col); ?>

        <!-- <svg width="22" height="22" viewBox="0 0 512 512" fill="currentColor">
            <path d="M298 53l0 408-69 0 0-410 69 0z m-87 0l0 408-69 0 0-410 69 0z m173 0l0 409-69 0 0-409z"/>
        </svg> -->
    </a>
    <?php endif; ?>

    <?php if (in_array('4-cols', $multicheck_option_cols_display)) : ?>
    <a href="javascript:void(0);" class="nasa-change-layout productGrid grid-4 nasa-tip<?php echo ($type_show == 'grid-4') ? ' active' : ''; ?><?php echo ($setup == 'grid-4') ? ' df' : ''; ?>" data-columns="4" rel="nofollow" data-tip="<?php echo esc_html__('4 Columns', 'elessi-theme'); ?>">
        <?php if ($number_view) : ?>
            <span class="nasa-text-number hidden-tag">
                <?php echo esc_html__('4', 'elessi-theme'); ?>
            </span>
        <?php endif; ?>

        <?php echo ($svg_4col); ?>
        <!-- <svg width="22" height="22" viewBox="0 0 512 512" fill="currentColor">
            <path d="M250 53l0 408-69 0 0-410 69 0z m-87-2l0 410-69 0 0-410c0 0 69 0 69 0z m173 2l0 409-69 0 0-409z m86 0l0 409-68 0 0-409z"/>
        </svg> -->
    </a>
    <?php endif; ?>

    <?php if (in_array('5-cols', $multicheck_option_cols_display)) : ?>
    <a href="javascript:void(0);" class="nasa-change-layout productGrid grid-5 nasa-tip<?php echo ($type_show == 'grid-5') ? ' active' : ''; ?><?php echo ($setup == 'grid-5') ? ' df' : ''; ?>" data-columns="5" rel="nofollow" data-tip="<?php echo esc_html__('5 Columns', 'elessi-theme'); ?>">
        <?php if ($number_view) : ?>
            <span class="nasa-text-number hidden-tag">
                <?php echo esc_html__('5', 'elessi-theme'); ?>
            </span>
        <?php endif; ?>

        <?php echo ($svg_5col); ?>

        <!-- <svg width="22" height="22" viewBox="0 0 512 512" fill="currentColor">
            <path d="M203 53l0 408-67 0 0-410 67 0z m-86-2l0 410-67 0 0-410c0 0 67 0 67 0z m174 2l0 409-69 0 0-409z m87 0l0 409-69 0 0-409z m88 0l0 409-69 0 0-409z"/>
        </svg> -->
    </a>
    <?php endif; ?>

    <?php if (in_array('6-cols', $multicheck_option_cols_display)) : ?>
        <a href="javascript:void(0);" class="nasa-change-layout productGrid grid-6 nasa-tip<?php echo ($type_show == 'grid-6') ? ' active' : ''; ?><?php echo ($setup == 'grid-6') ? ' df' : ''; ?>" data-columns="6" rel="nofollow" data-tip="<?php echo esc_html__('6 Columns', 'elessi-theme'); ?>">
            <?php if ($number_view) : ?>
                <span class="nasa-text-number hidden-tag">
                    <?php echo esc_html__('6', 'elessi-theme'); ?>
                </span>
            <?php endif; ?>

            <?php echo ($svg_6col); ?>
        </a>
    <?php endif; ?>

    <?php if ($list_view && in_array('list-2cols', $multicheck_option_cols_display)) : ?>
        <a href="javascript:void(0);" class="nasa-change-layout productList list-2 nasa-tip<?php echo ($type_show == 'list-2') ? ' active' : ''; ?><?php echo ($setup == 'list-2') ? ' df' : ''; ?>" data-columns="list-2" rel="nofollow" data-tip="<?php echo esc_html__('List 2 Columns', 'elessi-theme'); ?>">
            <?php if ($number_view) : ?>
                <span class="nasa-text-number hidden-tag">
                    <?php echo esc_html__('List 2', 'elessi-theme'); ?>
                </span>
            <?php endif; ?>

            <?php echo ($svg_list2); ?>
            <!-- <svg width="22" height="22" viewBox="0 0 512 512" fill="currentColor">
                <path d="M462 202l-300 0 0-68 302 0z m0-87l-300 0 0-67 302 0c0 0 0 67-2 67z m0 175l-300 0 0-69 300 0z m0 86l-300 0 0-69 300 0z m0 88l-300 0 0-69 300 0z m-321-262l-88 0 0-68 88 0z m0-87l-88 0 0-67 88 0c0 0 0 67 0 67z m0 175l-90 0 0-69 88 0 0 69z m0 86l-90 0 0-69 88 0 0 69z m0 88l-90 0 0-69 88 0 0 69z"/>
            </svg> -->
        </a>
    <?php endif; ?>

    <?php if ($list_view && in_array('list', $multicheck_option_cols_display)) : ?>
        <a href="javascript:void(0);" class="nasa-change-layout productList list nasa-tip<?php echo ($type_show == 'list') ? ' active' : ''; ?><?php echo ($setup == 'list') ? ' df' : ''; ?>" data-columns="1" rel="nofollow" data-tip="<?php echo esc_html__('List', 'elessi-theme'); ?>">
            <?php if ($number_view) : ?>
                <span class="nasa-text-number hidden-tag">
                    <?php echo esc_html__('List', 'elessi-theme'); ?>
                </span>
            <?php endif;?>
            
            <?php echo ($svg_list);?>
            <!-- <svg width="22" height="22" viewBox="0 0 512 512" fill="currentColor">
                <path d="M462 202l-300 0 0-68 302 0z m0-87l-300 0 0-67 302 0c0 0 0 67-2 67z m0 175l-300 0 0-69 300 0z m0 86l-300 0 0-69 300 0z m0 88l-300 0 0-69 300 0z m-321-262l-88 0 0-68 88 0z m0-87l-88 0 0-67 88 0c0 0 0 67 0 67z m0 175l-90 0 0-69 88 0 0 69z m0 86l-90 0 0-69 88 0 0 69z m0 88l-90 0 0-69 88 0 0 69z"/>
            </svg> -->
        </a>
    <?php endif; ?>
</div>
