<?php
function nasa_wpb_plant_3() {
    $imgs_1 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-banner.jpg', '3318', array(
        'post_title' => 'plant3-banner',
        'post_name' => 'plant3-banner'
    ));
    
    $imgs_2 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-banner2.jpg', '3318', array(
        'post_title' => 'plant3-banner2',
        'post_name' => 'plant3-banner2'
    ));
    
    $imgs_3 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-banner3.jpg', '3108', array(
        'post_title' => 'plant3-banner3',
        'post_name' => 'plant3-banner3'
    ));
    
    $imgs_4 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-picture.jpg', '3094', array(
        'post_title' => 'plant3-picture',
        'post_name' => 'plant3-picture'
    ));
    
    $imgs_5 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-icon1.jpg', '3149', array(
        'post_title' => 'plant3-icon1',
        'post_name' => 'plant3-icon1'
    ));
    
    $imgs_6 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-icon2.jpg', '3149', array(
        'post_title' => 'plant3-icon2',
        'post_name' => 'plant3-icon2'
    ));
    
    $imgs_7 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-icon3.jpg', '3149', array(
        'post_title' => 'plant3-icon3',
        'post_name' => 'plant3-icon3'
    ));
    
    $imgs_8 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-icon4.jpg', '3149', array(
        'post_title' => 'plant3-icon4',
        'post_name' => 'plant3-icon4'
    ));
    
    $imgs_url_1 = elessi_import_upload('/elementor/wp-content/uploads/2023/09/plant3-deal-bg.jpg', '3100', array(
        'post_title' => 'plant3-deal-bg',
        'post_name' => 'plant3-deal-bg',
    ));
    $imgs_url_src_1 = $imgs_url_1 ? wp_get_attachment_image_url($imgs_url_1, 'full') : 'https://via.placeholder.com/1920x592?text=1920x592';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Plant V3',
            'post_name' => 'wpb-plant-v3',
            'post_content' => '[vc_row fullwidth="1" el_class="margin-bottom-20 tablet-margin-bottom-15 mobile-margin-bottom-10"][vc_column][nasa_rev_slider alias="slider-plant"][/vc_column][/vc_row][vc_row el_class="margin-bottom-20 mobile-margin-bottom-50"][vc_column width="2/3"][vc_row_inner el_class="margin-bottom-40 mobile-margin-bottom-0"][vc_column_inner width="1/2"][nasa_banner_2 valign="middle" effect_text="fadeInLeft" data_delay="200ms" hover="zoom" img_src="' . $imgs_1 . '"]
<h3 class="fs-28 tablet-fs-24 margin-top-0 margin-bottom-20" style="line-height: 1.2;">Ceramic
Pot &amp; Plant</h3>
<a class="fs-16" style="text-decoration: underline;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column_inner][vc_column_inner width="1/2"][nasa_banner_2 valign="middle" effect_text="fadeInLeft" data_delay="200ms" hover="zoom" img_src="' . $imgs_2 . '"]
<h3 class="fs-28 tablet-fs-24 margin-top-0 margin-bottom-20" style="line-height: 1.2;">Plants
For Interior</h3>
<a class="fs-16" style="text-decoration: underline;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column_inner][/vc_row_inner][vc_column_text el_class="hide-for-mobile"]
<p class="primary-color fs-35 mobile-fs-30 nasa-bold-500 margin-bottom-0" style="line-height: 1;">Discover</p>

<h3 class="fs-35 mobile-fs-30 margin-top-0">Our Favorites</h3>
<p class="fs-16" style="color: #afafaf;">Lorem Ipsum is simply dummy text of the printing and typesetting
industryprinting and typesetting industry</p>
[/vc_column_text][/vc_column][vc_column width="1/3"][nasa_banner_2 valign="middle" effect_text="fadeInLeft" data_delay="200ms" img_src="' . $imgs_3 . '" el_class="nasa-bold-500"]
<h3 class="fs-28 tablet-fs-22 margin-bottom-50 tablet-margin-bottom-30" style="line-height: 1.2;">Bonsai
Plants
Collections</h3>
<div class="fs-14 margin-bottom-20" style="line-height: 1.4; color: #c0c2bd;">JUST ONLY
<span class="fs-29" style="color: #ff4545;">$19.99</span></div>
<a class="primary-color button small fs-16 tablet-fs-14 mobile-fs-16 force-radius-5" style="text-transform: none; letter-spacing: 0; padding: 8px 18px;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 mobile-margin-bottom-30"][vc_column][vc_tta_tabs alignment="center" tabs_display_type="ver" el_class="letter-spacing-none"][vc_tta_section title="All Products" tab_id="1659518546031-6df5e6ba-7b43"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Plants" tab_id="1659518546035-02a0c9dc-726e"][nasa_products type="best_selling" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Outdor Plants" tab_id="1659518553850-e77e0626-2c90"][nasa_products type="featured_product" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Interior" tab_id="1659518554981-e23eaa9c-f05b"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Home Plants" tab_id="1660386216758-fd867995-925d"][nasa_products type="deals" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Growing Accessories" tab_id="1660386397056-30ddbc42-94a4"][nasa_products type="top_rate" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Interior Plants" tab_id="1660386398762-0657893e-80a7"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row css=".vc_custom_1660987359859{margin-bottom: 170px !important;background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][nasa_products_special_deal limit="6" style="multi" arrows="0" auto_slide="false" el_class="nasa-relative top-100"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 mobile-margin-bottom-30"][vc_column width="1/3" el_class="mobile-margin-bottom-30"][nasa_title title_text="Top Rated" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="top_rate" style="list" number="4" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-bottom-30"][nasa_title title_text="Best Selling" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="best_selling" style="list" number="4" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3"][nasa_title title_text="On Sale" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="on_sale" style="list" number="4" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-80 mobile-margin-bottom-50 text-center"][vc_column][vc_column_text]
<div class="primary-color fs-20 mobile-fs-20 nasa-bold-500">Welcome to Elessi Plants</div>
<h3 class="fs-35 mobile-fs-30 margin-top-0 margin-bottom-5">Garden from our heart</h3>
<p class="fs-16">Make space in your home for plants. You’ll feel better for it. Not only are that beautiful</p>
[/vc_column_text][/vc_column][/vc_row][vc_row content_placement="middle" el_class="margin-bottom-50"][vc_column width="1/3" offset="vc_col-lg-4 vc_col-md-6" el_class="mobile-margin-bottom-30"][vc_row_inner][vc_column_inner el_class="nasa-flex margin-bottom-30"][vc_single_image image="' . $imgs_5 . '" el_class="left rtl-right margin-right-25 rtl-margin-left-25 rtl-margin-right-0"][nasa_title title_text="Garden Care" title_type="h5" title_desc="Let’s find a plant combination to suit your border enjoy your time." font_size="m" el_class="nasa-clear-none"][/vc_column_inner][vc_column_inner el_class="nasa-flex margin-bottom-30"][vc_single_image image="' . $imgs_6 . '" el_class="left rtl-right margin-right-25 rtl-margin-left-25 rtl-margin-right-0"][nasa_title title_text="Plant Renovation" title_type="h5" title_desc="Add color and interest to your garden with our plants." font_size="m" el_class="nasa-clear-none"][/vc_column_inner][vc_column_inner el_class="nasa-flex margin-bottom-30"][vc_single_image image="' . $imgs_7 . '" el_class="left rtl-right margin-right-25 rtl-margin-left-25 rtl-margin-right-0"][nasa_title title_text="Seed Supply" title_type="h5" title_desc="We do not have only plants but also many seeds suit your style." font_size="m" el_class="nasa-clear-none"][/vc_column_inner][vc_column_inner el_class="nasa-flex margin-bottom-30"][vc_single_image image="' . $imgs_8 . '" el_class="left rtl-right margin-right-25 rtl-margin-left-25 rtl-margin-right-0"][nasa_title title_text="Watering Garden" title_type="h5" title_desc="Join us on one of our open days and find plants for your garden." font_size="m" el_class="nasa-clear-none"][/vc_column_inner][/vc_row_inner][/vc_column][vc_column width="1/2" el_class="nasa-clear-none tablet-margin-left-0" offset="vc_col-lg-offset-2 vc_col-md-offset-0 vc_col-md-6"][nasa_banner_2 img_src="' . $imgs_4 . '" el_class="ns-3d"][/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 mobile-margin-bottom-0"][vc_column][nasa_title title_text="From our blogs" title_desc="The freshest and most exciting news" title_align="text-center" font_size="xl" el_class="margin-bottom-30"][nasa_post arrows="1" posts="5" columns_number="3" columns_number_small_slider="1" columns_number_tablet="2" cats_enable="no" date_enable="no" author_enable="no" readmore="no" page_blogs="no"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            '_nasa_header_transparent' => '1',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#6bac0a',
            // '_nasa_footer_mode' => 'builder',
            // '_nasa_custom_footer' => 'wpb-footer-light-2-bg',
            // '_nasa_custom_footer_mobile' => 'footer-mobile',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1660987359859{margin-bottom: 170px !important;background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'fixed_nav' => '0',
            
            // 'plus_wide_width' => '400',
            'color_primary' => '#6bac0a',
            
            // 'bg_color_topbar' => '28aeb1',
            // 'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'v_root' => '1',
            // 'v_root_limit' => '10',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'wpb-footer-light-2-bg',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'left-classic',
            
            // 'product_detail_layout' => 'classic',
            'product_image_layout' => 'single',
            'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            // 'tab_style_info' => '2d-no-border',
            
            // 'single_product_thumbs_style' => 'hoz',
            
            'loop_layout_buttons' => 'modern-5',
            
            // 'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            // 'nasa_attr_color_style' => 'round',
            'nasa_attr_label_style' => 'small-square-1',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f8f8f8',
            // 'breadcrumb_align' => 'text-left',
            // 'breadcrumb_height' => '60',
        ),
    );
}
