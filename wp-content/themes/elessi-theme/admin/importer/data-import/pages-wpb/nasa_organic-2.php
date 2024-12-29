<?php
function nasa_wpb_organic_2() {
    $imgs_url = elessi_import_upload('/wp-content/uploads/2023/09/organic2-slider-bg.jpg', '3198', array(
        'post_title' => 'organic2-slider-bg',
        'post_name' => 'organic2-slider-bg',
    ));
    $imgs_url_src = $imgs_url ? wp_get_attachment_image_url($imgs_url, 'full') : 'https://via.placeholder.com/1920x560?text=1920x560';
    
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2022/06/organic2-slider1.jpg', '3142', array(
        'post_title' => 'organic2-slider1',
        'post_name' => 'organic2-slider1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2022/06/organic2-slider2.jpg', '3142', array(
        'post_title' => 'organic2-slider2',
        'post_name' => 'organic2-slider2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2022/06/organic22-banner.jpg', '3108', array(
        'post_title' => 'organic22-banner',
        'post_name' => 'organic22-banner',
    ));
    
    $box_1 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon1.png', '2915', array(
        'post_title' => 'organic4-icon1',
        'post_name' => 'organic4-icon1',
    ));
    
    $box_2 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon2.png', '2915', array(
        'post_title' => 'organic4-icon2',
        'post_name' => 'organic4-icon2',
    ));
    
    $box_3 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon3.png', '2915', array(
        'post_title' => 'organic4-icon3',
        'post_name' => 'organic4-icon3',
    ));
    
    $box_4 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon4.png', '2915', array(
        'post_title' => 'organic4-icon4',
        'post_name' => 'organic4-icon4',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2022/06/organic2-v-banner1.jpg', '3153', array(
        'post_title' => 'organic2-v-banner1',
        'post_name' => 'organic2-v-banner1',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2023/09/organic2-h-banner.jpg', '3319', array(
        'post_title' => 'organic2-h-banner',
        'post_name' => 'organic2-h-banner',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2023/09/organic2-v-banner2.jpg', '3153', array(
        'post_title' => 'organic2-v-banner2',
        'post_name' => 'organic2-v-banner2',
    ));
    
    $imgs_7 = elessi_import_upload('/wp-content/uploads/2022/06/organic2-h-banner2-1.jpg', '3117', array(
        'post_title' => 'organic2-h-banner2-1',
        'post_name' => 'organic2-h-banner2-1',
    ));
    
    $imgs_8 = elessi_import_upload('/wp-content/uploads/2022/06/organic2-h-banner3-1.jpg', '3117', array(
        'post_title' => 'organic2-h-banner3-1',
        'post_name' => 'organic2-h-banner3-1',
    ));
    
    $imgs_9 = elessi_import_upload('/wp-content/uploads/2022/06/organic2-h-banner4-1.jpg', '3117', array(
        'post_title' => 'organic2-h-banner4-1',
        'post_name' => 'organic2-h-banner4-1',
    ));
    
    $imgs_10 = elessi_import_upload('/wp-content/uploads/2022/06/organic2-v-banner3.jpg', '3153', array(
        'post_title' => 'organic2-v-banner3',
        'post_name' => 'organic2-v-banner3',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Organic V2',
            'post_name' => 'wpb-organic-v2',
            'post_content' => '[vc_row el_class="margin-bottom-50 padding-top-30 padding-bottom-15 mobile-padding-top-10" css=".vc_custom_1654680760375{background-image: url(' . $imgs_url_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="2/3" el_class="mobile-margin-bottom-10"][nasa_slider bullets="false" bullets_pos="none" column_number="1" column_number_small="1" column_number_tablet="1"][nasa_banner_2 align="right" move_x="5%" valign="middle" effect_text="fadeInLeft" data_delay="200ms" img_src="' . $imgs_1 . '" el_class="nasa-radius-5"]
<h3 class="fs-37 tablet-fs-25 mobile-fs-18 margin-top-0 margin-bottom-20" style="line-height: 1.2;">Farm Fresh <span class="primary-color nasa-bold-300">Vegetables &amp;
Food </span>100% Organics</h3>
<h5 class="fs-16 mobile-fs-12 margin-bottom-30" style="color: #9c9c9c;">Alway fresh organic products for you</h5>
<a class="primary-color nasa-bold button hide-for-mobile fs-14 force-radius-5" style="text-transform: none; letter-spacing: 0; padding: 10px 20px;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][nasa_banner_2 align="right" move_x="5%" valign="middle" effect_text="fadeInLeft" data_delay="200ms" img_src="' . $imgs_2 . '" el_class="nasa-radius-5"]
<h4 class="fs-18 mobile-fs-12 margin-top-0 margin-bottom-20" style="color: #9c9c9c; letter-spacing: 4.5px;">ELESSI ORGANIC</h4>
<h3 class="fs-37 tablet-fs-25 mobile-fs-18 margin-top-0 margin-bottom-15" style="line-height: 1.2;">Welcome to <span class="primary-color">Elessi.</span>
Foods &amp; Organic Online</h3>
<h5 class="fs-16 mobile-fs-12 margin-bottom-30" style="color: #9c9c9c;">Free delivery for your first order</h5>
<a class="primary-color nasa-bold hide-for-mobile button small fs-14 force-radius-5" style="text-transform: none; letter-spacing: 0; padding: 10px 16px;" title="Start Shopping" href="#">Start Shopping</a>[/nasa_banner_2][/nasa_slider][/vc_column][vc_column width="1/3"][nasa_banner_2 hover="zoom" img_src="' . $imgs_3 . '" el_class="nasa-radius-5"]
<h3 class="margin-bottom-20 fs-28 tablet-fs-25"><span class="fs-40 tablet-fs-35 primary-color" style="font-weight: 600;">30%</span> SALE OFF</h3>
<h5 class="fs-15 margin-bottom-30" style="line-height: 1.6;">Spring Fresh Fruit
Special Offer.</h5>
<a class="fs-14 button-white nasa-bold nasa-radius-5" style="padding: 8px 20px;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-20 mobile-margin-bottom-30"][vc_column width="1/4" el_class="margin-bottom-30" offset="vc_col-lg-3 vc_col-md-6 vc_col-xs-12"][nasa_icon_box box_img="' . $box_1 . '" box_title="Always Fresh" box_desc="Lorem ipsum dolor sit amet, consectetuer adipiscing elit"][/vc_column][vc_column width="1/4" el_class="margin-bottom-30" offset="vc_col-lg-3 vc_col-md-6 vc_col-xs-12"][nasa_icon_box box_img="' . $box_2 . '" box_title="100% Organic" box_desc="Lorem ipsum dolor sit amet, consectetuer adipiscing elit"][/vc_column][vc_column width="1/4" el_class="margin-bottom-30" offset="vc_col-lg-3 vc_col-md-6 vc_col-xs-12"][nasa_icon_box box_img="' . $box_3 . '" box_title="Premium Quatily" box_desc="Lorem ipsum dolor sit amet, consectetuer adipiscing elit"][/vc_column][vc_column width="1/4" offset="vc_col-lg-3 vc_col-md-6 vc_col-xs-12" el_class="margin-bottom-30"][nasa_icon_box box_img="' . $box_4 . '" box_title="Natureal Product" box_desc="Lorem ipsum dolor sit amet, consectetuer adipiscing elit"][/vc_column][/vc_row][vc_row el_class="margin-bottom-20 mobile-margin-bottom-0"][vc_column width="1/4" hide_in_mobile="1" el_class="desktop-margin-bottom-20 desktop-padding-right-40 tablet-padding-right-10 mobile-margin-bottom-30 hide-for-medium" offset="vc_col-lg-3 vc_col-md-4"][nasa_title title_text="Recommendations" font_size="l" el_class="margin-bottom-20 mobile-margin-bottom-15"][nasa_banner_2 hover="zoom" img_src="' . $imgs_4 . '" el_class="nasa-radius-5 text-banner-org"]
<h4 class="fs-25 tablet-fs-22 margin-bottom-35" style="line-height: 1.3; color: #fff;">Organic
Vegetables
Everyday</h4>
<a class="fs-14 button-white nasa-bold nasa-radius-5" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][vc_column width="3/4" offset="vc_col-lg-9 vc_col-md-12"][vc_tta_tabs alignment="right" title_font_size="m" el_class="letter-spacing-none"][vc_tta_section title="Featured" tab_id="1653902254111-5c43bcbc-ab60"][nasa_products type="featured_product" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Popular" tab_id="1653902254119-721356d1-f371"][nasa_products title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Best Selling" tab_id="1653902256390-1182ebfe-dfd2"][nasa_products title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Popular" tab_id="1654590298302-a1a742f5-d5fb"][nasa_products type="stock_desc" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="On Sale" tab_id="1654590297121-b8addeff-1924"][nasa_products type="featured_product" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="New Added" tab_id="1654590293274-99c6ff57-1e49"][nasa_products title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-45 hide-for-medium"][vc_column][nasa_banner align="center" valign="middle" text-align="text-center" banner_responsive="no" hover="zoom" img_src="' . $imgs_5 . '" el_class="nasa-radius-5"]
<h4 class="fs-25 tablet-fs-14" style="color: #fd0e11;">20% OFF</h4>
<h5 class="fs-22 tablet-fs-14">Organic Fruit &amp; Vegetables</h5>
<a class="fs-14 tablet-fs-12 mobile-fs-12" title="Shop now" href="#">Shop now</a>[/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-bottom-20 mobile-margin-bottom-10"][vc_column width="1/4" hide_in_mobile="1" el_class="desktop-margin-bottom-20 desktop-padding-right-40 tablet-padding-right-10 mobile-margin-bottom-30 hide-for-medium" offset="vc_col-lg-3 vc_col-md-4"][nasa_title title_text="Best Selling" font_size="l" el_class="margin-bottom-20 mobile-margin-bottom-15"][nasa_banner_2 move_x="14%" effect_text="fadeInLeft" data_delay="300ms" hover="zoom" img_src="' . $imgs_6 . '" el_class="nasa-radius-5 text-banner-org"]
<h4 class="fs-25 tablet-fs-22 margin-bottom-20" style="line-height: 1.5; color: #3d3d3d;">Best Selling
Vegetables</h4>
<h5 class="fs-14 margin-bottom-40" style="color: #9c9c9c; line-height: 1.8;">Contrary to popular belief,
Lorem Ipsum is not simply random text</h5>
<a class="button small fs-14 force-radius-5" style="text-transform: none; letter-spacing: 0;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][vc_column width="3/4" offset="vc_col-lg-9 vc_col-md-12"][vc_tta_tabs alignment="right" title_font_size="m" el_class="letter-spacing-none"][vc_tta_section title="Fruits" tab_id="1653906150986-5a8edcd2-1534"][nasa_products title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Vegetables" tab_id="1653906151011-95702dfc-bd30"][nasa_products type="stock_desc" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Milk &amp; Cream" tab_id="1653906151033-5b6ea83e-dc26"][nasa_products type="featured_product" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Banana" tab_id="1654590316992-88cd8497-8991"][nasa_products type="top_rate" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="See Food" tab_id="1654590315827-a30fcbb6-74fc"][nasa_products type="featured_product" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Grape" tab_id="1654590314955-4600ed51-5f84"][nasa_products title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-50"][vc_column width="1/3"][nasa_banner_2 hover="zoom" img_src="' . $imgs_7 . '" el_class="nasa-radius-5 margin-bottom-0 mobile-margin-bottom-10"]
<h4 class="fs-22 tablet-fs-16 margin-bottom-30 tablet-margin-bottom-10" style="line-height: 1.2;">Farm Fresh
Vegetables Everyday</h4>
<h6 class="margin-bottom-30 tablet-margin-bottom-10 mobile-margin-bottom-20 fs-17 tablet-fs-14 mobile-fs-14">Sale off <span class="fs-25 tablet-fs-18 mobile-fs-15" style="color: #ff0000;">25%</span></h6>
<a class="fs-14 tablet-fs-12 mobile-fs-12" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 hover="zoom" img_src="' . $imgs_8 . '" el_class="nasa-radius-5 margin-bottom-0 mobile-margin-bottom-10"]
<h4 class="fs-22 tablet-fs-16 margin-top-10 margin-bottom-10">Elessi Apple Oil</h4>
<p class="fs-14 tablet-fs-10 tablet-margin-bottom-0 margin-bottom-40 nasa-bold" style="line-height: 1.3; color: #53524f;">Best product to make
your favor</p>

<h6 class="fs-14 tablet-fs-10 mobile-fs-14" style="line-height: 1.3;">ONLY
<span class="fs-24 tablet-fs-18 mobile-fs-15" style="color: #ff0000;">$19.9</span></h6>
[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 move_x="8%" hover="zoom" img_src="' . $imgs_9 . '" el_class="nasa-radius-5 margin-bottom-0 mobile-margin-bottom-10"]
<h4 class="fs-22 tablet-fs-16 margin-bottom-20" style="line-height: 1.2;">Fruits
All Summer</h4>
<h6 class="margin-bottom-40 tablet-margin-bottom-15 mobile-margin-bottom-30 fs-15 tablet-fs-14 mobile-fs-14" style="color: #6c6c6a;"><span class="fs-16 tablet-fs-18 mobile-fs-15" style="color: #ff0000;">30% OFF</span> IN JUNE-JULY</h6>
<a class="primary-color hide-for-medium nasa-bold button small fs-15 tablet-fs-11 mobile-fs-12 force-radius-5" style="text-transform: capitalize; letter-spacing: 0; padding: 8px 23px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-20 mobile-margin-bottom-0"][vc_column width="1/4" hide_in_mobile="1" el_class="desktop-margin-bottom-20 desktop-padding-right-40 tablet-padding-right-10 mobile-margin-bottom-30 hide-for-medium" offset="vc_col-lg-3 vc_col-md-4"][nasa_title title_text="Recommendations" font_size="l" el_class="margin-bottom-20 mobile-margin-bottom-15"][nasa_banner_2 effect_text="fadeInLeft" data_delay="300ms" hover="zoom" img_src="' . $imgs_10 . '" el_class="nasa-radius-5"][/nasa_banner_2][/vc_column][vc_column width="3/4" offset="vc_col-lg-9 vc_col-md-12"][vc_tta_tabs alignment="right" title_font_size="m" el_class="letter-spacing-none"][vc_tta_section title="All" tab_id="1653906252505-b8d5e52f-be45"][nasa_products type="featured_product" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Fruits &amp; Vegetables" tab_id="1654590324620-a16c6904-af47"][nasa_products title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Frozen Seafoods" tab_id="1654590325688-8bfa2a2d-b99f"][nasa_products title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Raw Meats" tab_id="1653906252518-731cf383-d0a6"][nasa_products type="stock_desc" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Coffees &amp; Teas" tab_id="1654590325153-cb4526ba-2518"][nasa_products type="top_rate" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Pet Foods" tab_id="1653906252534-37a6a149-9cc3"][nasa_products type="featured_product" title_align="right" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 tablet-margin-bottom-20 mobile-margin-bottom-10"][vc_column][nasa_title title_text="Latest Blog" title_desc="The freshest and most exciting news" title_align="text-center" font_size="xl" el_class="margin-bottom-30"][nasa_post arrows="1" columns_number="4" columns_number_small_slider="1" columns_number_tablet="2" readmore="no" page_blogs="no"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '6',
            // '_nasa_plus_wide_option' => '1',
            // '_nasa_plus_wide_width' => '400',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#6bad0d',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1654680760375{background-image: url(' . $imgs_url_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}'
        ),
        
        'globals' => array(
            'header-type' => '6',
            
            'fixed_nav' => '0',
            
            'plus_wide_width' => '400',
            'color_primary' => '#6bad0d',
            
            // 'bg_color_topbar' => '28aeb1',
            // 'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'right-classic',
            
            // 'product_detail_layout' => 'classic',
            'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            // 'tab_style_info' => '2d-no-border',
            
            // 'single_product_thumbs_style' => 'hoz',
            
            'loop_layout_buttons' => 'modern-1',
            
            'animated_products' => 'hover-zoom',
            
            'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            // 'nasa_attr_color_style' => 'round',
            // 'nasa_attr_label_style' => 'round',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f8f8f8',
            // 'breadcrumb_align' => 'text-left',
            // 'breadcrumb_height' => '60',
        ),
    );
}
