<?php
function nasa_wpb_organic_5() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2023/09/organic5-banner1.jpg', '3139', array(
        'post_title' => 'organic5-banner1',
        'post_name' => 'organic5-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2023/09/organic5-banner2.jpg', '3139', array(
        'post_title' => 'organic5-banner2',
        'post_name' => 'organic5-banner2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2023/09/organic5-banner3.jpg', '3139', array(
        'post_title' => 'organic5-banner3',
        'post_name' => 'organic5-banner3',
    ));
    
    $imgs_url_1 = elessi_import_upload('/wp-content/uploads/2023/09/organic5-newsletter-bg.jpg', '3100', array(
        'post_title' => 'organic5-newsletter-bg',
        'post_name' => 'organic5-newsletter-bg',
    ));
    $imgs_url_src_1 = $imgs_url_1 ? wp_get_attachment_image_url($imgs_url_1, 'full') : 'https://via.placeholder.com/1580x431?text=1580x431';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Organic V5',
            'post_name' => 'wpb-organic-v5',
            'post_content' => '[vc_row el_class="margin-top-35 margin-bottom-80 tablet-margin-bottom-25 mobile-margin-top-10 mobile-margin-bottom-20"][vc_column][nasa_rev_slider alias="slider-organic-5"][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 mobile-padding-left-10 mobile-padding-right-10"][vc_column css=".vc_custom_1655539924997{padding-top: 35px !important;padding-right: 30px !important;padding-bottom: 40px !important;padding-left: 30px !important;background-color: #f9f9f9 !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 20px !important;}"][nasa_title title_text="Featured Categories" font_size="l" el_class="margin-bottom-25"][nasa_product_categories list_cats="men, woman, haircare-woman, makeup-woman, nails-woman, bracelets-woman, earrings-woman, necklaces-woman" parent="false" columns_number="7" columns_number_small="2" columns_number_tablet="3" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 tablet-margin-bottom-30 mobile-margin-bottom-20"][vc_column][vc_tta_tabs alignment="right" title_font_size="l" tabs_display_type="2d-has-bg" tabs_bg_color="" el_class="letter-spacing-none" title="Daily Best Sells"][vc_tta_section title="All" tab_id="1655095615591-34d4eb8f-0124"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Fruits &amp; Vegetables" tab_id="1655095615605-82862b21-9705"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Frozen Seafoods" tab_id="1655095615619-7171fc27-f88b"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Raw Meats" tab_id="1655095615632-bd0b23ca-954b"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Coffes &amp; Teas" tab_id="1655117492748-887d6bcd-c011"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 tablet-margin-bottom-30"][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 effect_text="fadeInLeft" data_delay="100ms" hover="zoom" img_src="' . $imgs_1 . '" el_class="nasa-radius-10"]
<h3 class="fs-23 tablet-fs-20 margin-bottom-20 tablet-margin-bottom-10 mobile-margin-bottom-40" style="color: #015a02;">Green Fruits
and Vegetables</h3>
<h6 class="fs-14 tablet-fs-10" style="line-height: 1.4; color: #78716b;">ONLY
<span class="fs-29 tablet-fs-18 mobile-fs-15" style="color: #ff0000;">$19.00</span></h6>
[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 effect_text="fadeInLeft" data_delay="100ms" hover="zoom" img_src="' . $imgs_2 . '" el_class="nasa-radius-10"]
<h3 class="fs-23 tablet-fs-15 margin-bottom-20 tablet-margin-bottom-20" style="line-height: 1.2;">Fresh
Guava Juice</h3>
<h6 class="fs-14 margin-bottom-25 tablet-margin-bottom-10 mobile-margin-bottom-20" style="color: #78716b;">Sale off <span class="fs-25 tablet-fs-16 mobile-fs-15" style="color: #ff0000;">25%</span></h6>
<a class="fs-14 tablet-fs-12 mobile-fs-12" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 valign="middle" effect_text="fadeInUp" data_delay="600ms" hover="zoom" img_src="' . $imgs_3 . '" el_class="nasa-radius-10"]
<h3 class="fs-23 tablet-fs-15 margin-bottom-20 tablet-margin-bottom-20" style="line-height: 1.2;">Fresh
Vegetables</h3>
<a class="primary-color nasa-bold-500 button small fs-15 tablet-fs-11 mobile-fs-12 force-radius-5" style="text-transform: capitalize; letter-spacing: 0; padding: 8px 23px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-80 mobile-margin-bottom-60"][vc_column][nasa_products_special_deal limit="6" columns_number="5" columns_number_small="2" columns_number_tablet="3" arrows="1" arrows_pos="1" auto_slide="false" title="Deal of the day"][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 mobile-padding-left-10 mobile-padding-right-10"][vc_column][vc_row_inner el_class="padding-top-50 padding-bottom-40 padding-left-60 padding-right-60 tablet-padding-top-60 tablet-padding-bottom-60 tablet-padding-left-50 tablet-padding-right-50 mobile-padding-bottom-30 mobile-padding-left-5 mobile-padding-right-5" css=".vc_custom_1656227225100{background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 20px !important;}"][vc_column_inner el_class="margin-bottom-30"][vc_column_text]
<h3 class="fs-25" style="margin: 0; white-space: nowrap;">Stay home &amp; get your daily
need from our shop</h3>
[/vc_column_text][/vc_column_inner][vc_column_inner el_class="margin-bottom-30"][vc_column_text]
<h5 class="fs-15" style="color: #666; margin: 0; white-space: nowrap;">…and receive $10 coupon for first shopping</h5>
[/vc_column_text][/vc_column_inner][vc_column_inner el_class="organic-style-wrap" width="5/12" offset="vc_col-lg-5 vc_col-md-7"][contact-form-7 id="210"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 mobile-margin-top-50"][vc_column width="1/3" el_class="tablet-margin-bottom-20 mobile-margin-bottom-20"][nasa_title title_text="Top Rated" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="top_rate" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="tablet-margin-bottom-20 mobile-margin-bottom-20"][nasa_title title_text="Best Selling" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="best_selling" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-bottom-20"][nasa_title title_text="On Sale" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="on_sale" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 tablet-margin-bottom-0 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Latest blog" title_desc="The freshest and most exciting news" title_align="text-center" font_size="xl" el_class="margin-bottom-30"][nasa_post arrows="1" posts="5" columns_number="4" columns_number_small_slider="1" columns_number_tablet="2" author_enable="no" page_blogs="no"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '6',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#6bad0d',
            // '_nasa_v_root' => 'on',
            // '_nasa_v_root_limit' => '10',
            // '_nasa_footer_mode' => 'builder',
            // '_nasa_custom_footer' => 'footer-light-3',
            // '_nasa_custom_footer_mobile' => 'footer-light-3',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1655539924997{padding-top: 35px !important;padding-right: 30px !important;padding-bottom: 40px !important;padding-left: 30px !important;background-color: #f9f9f9 !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 20px !important;}.vc_custom_1656227225100{background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 20px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '6',
            
            'fixed_nav' => '0',
            
            // 'plus_wide_width' => '400',
            'color_primary' => '#6bad0d',
            
            // 'bg_color_topbar' => '28aeb1',
            // 'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            'v_root' => '1',
            'v_root_limit' => '10',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-3',
            'footer-mobile' => 'footer-light-3',
            
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
