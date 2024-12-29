<?php
/**
 * The Template for displaying all single Store.
 *
 * @package dokan
 * @package dokan - 2014 1.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;

global $nasa_opt;

/**
 * Custom Hook
 */
do_action('nasa_before_store_dokan');

$store_user = dokan()->vendor->get(get_query_var('author'));
$store_info = $store_user->get_shop_info();
$map_location = $store_user->get_location();
$layout = get_theme_mod('store_layout', 'left');

$dokan_appearance = get_option('dokan_appearance');

if (!isset($nasa_opt['dokan_header']) || $nasa_opt['dokan_header'] == '') :
    $profile_layout = empty($dokan_appearance['store_header_template']) ? 'default' : $dokan_appearance['store_header_template'];
else:
    $profile_layout = $nasa_opt['dokan_header'];
endif;

if ($layout === 'no' && $profile_layout == 'ns-1') :
    $profile_layout = 'default';
endif;

get_header('shop');

if (function_exists('yoast_breadcrumb')) :
    yoast_breadcrumb('<p id="breadcrumbs">', '</p>');
endif;

do_action('woocommerce_before_main_content'); ?>

<?php 
if (in_array($profile_layout, array('ns-2', 'ns-3', 'ns-4'))) :
    dokan_get_template_part('store-header');
endif;
?>

<div class="dokan-store-wrap layout-<?php echo esc_attr($layout); ?> profile-<?php echo esc_attr($profile_layout); ?>">
    
    <?php if ('left' === $layout) :
        if ($profile_layout == 'ns-1') :
            echo '<div class="col-left-wrap dokan-col-wrap">';
            dokan_get_template_part('store-header');
        endif;
        
        dokan_get_template_part('store', 'sidebar', array(
            'store_user' => $store_user,
            'store_info' => $store_info,
            'map_location' => $map_location
        ));
        
        if ($profile_layout == 'ns-1') :
            echo '</div>';
        endif;
    endif; ?>

    <div id="dokan-primary" class="dokan-single-store">
        
        <div id="dokan-content" class="store-page-wrap woocommerce" role="main">

            <?php 
            if (!in_array($profile_layout, array('ns-1', 'ns-2', 'ns-3', 'ns-4'))) :
                dokan_get_template_part('store-header');
            endif;
            ?>

            <?php do_action('dokan_store_profile_frame_after', $store_user->data, $store_info); ?>

            <?php if (have_posts()) : ?>

                <div class="seller-items">

                    <?php woocommerce_product_loop_start(); ?>

                    <?php while (have_posts()) : the_post(); ?>

                        <?php wc_get_template_part('content', 'product'); ?>

                    <?php endwhile; // end of the loop.  ?>

                    <?php woocommerce_product_loop_end(); ?>

                </div>

                <?php dokan_content_nav('nav-below'); ?>

            <?php else : ?>

                <p class="dokan-info"><?php esc_html_e('No products were found of this vendor!', 'elessi-theme'); ?></p>

            <?php endif; ?>
        </div>

    </div><!-- .dokan-single-store -->

    <?php if ('right' === $layout) :
        if ($profile_layout == 'ns-1') :
            echo '<div class="col-right-wrap dokan-col-wrap">';
            dokan_get_template_part('store-header');
        endif;
        
        dokan_get_template_part('store', 'sidebar', array(
            'store_user' => $store_user,
            'store_info' => $store_info,
            'map_location' => $map_location
        ));
        
        if ($profile_layout == 'ns-1') :
            echo '</div>';
        endif;
    endif; ?>

</div><!-- .dokan-store-wrap -->

<?php do_action('woocommerce_after_main_content'); ?>

<?php
get_footer('shop');
