<?php
function nasa_wpb_organic_3() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-slider1.jpg', '3556', array(
        'post_title' => 'organic-3-slider1',
        'post_name' => 'organic-3-slider1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-slider2.jpg', '3556', array(
        'post_title' => 'organic-3-slider2',
        'post_name' => 'organic-3-slider2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-banner1.jpg', '3555', array(
        'post_title' => 'organic-3-banner1',
        'post_name' => 'organic-3-banner1',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-banner2.jpg', '3555', array(
        'post_title' => 'organic-3-banner2',
        'post_name' => 'organic-3-banner2',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-banner3-1.jpg', '3658', array(
        'post_title' => 'organic-3-banner3-1',
        'post_name' => 'organic-3-banner3-1',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-banner4-1.jpg', '3658', array(
        'post_title' => 'organic-3-banner4-1',
        'post_name' => 'organic-3-banner4-1',
    ));
    
    $imgs_7 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-banner5-1.jpg', '3658', array(
        'post_title' => 'organic-3-banner5-1',
        'post_name' => 'organic-3-banner5-1',
    ));
    
    $imgs_8 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-v-banner-2-1.jpg', '3153', array(
        'post_title' => 'organic-3-v-banner-2-1',
        'post_name' => 'organic-3-v-banner-2-1',
    ));
    
    $imgs_url_1 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-product-slider-bg.jpg', '3100', array(
        'post_title' => 'organic-3-product-slider-bg',
        'post_name' => 'organic-3-product-slider-bg',
    ));
    $imgs_url_src_1 = $imgs_url_1 ? wp_get_attachment_image_url($imgs_url_1, 'full') : 'https://via.placeholder.com/1920x590?text=1920x590';
    
    $imgs_url_2 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-newsletter-bg.jpg', '3319', array(
        'post_title' => 'organic-3-newsletter-bg',
        'post_name' => 'organic-3-newsletter-bg',
    ));
    $imgs_url_src_2 = $imgs_url_2 ? wp_get_attachment_image_url($imgs_url_2, 'full') : 'https://via.placeholder.com/1920x170?text=1920x170';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Organic V3',
            'post_name' => 'wpb-organic-v3',
            'post_content' => '[vc_row el_class="margin-top-60 margin-bottom-60 mobile-margin-top-10"][vc_column width="2/3" el_class="rtl-right"][nasa_slider bullets="false" bullets_pos="inside" column_number="1" column_number_small="1" column_number_tablet="1" force="true" autoplay="true" bullets_type="bullets_type_2" el_class="mobile-margin-bottom-10"][nasa_banner_2 move_x="9%" effect_text="fadeInLeft" data_delay="300ms" img_src="' . $imgs_1 . '"]
<h3 class="fs-14 mobile-fs-15 margin-top-5 margin-bottom-15" style="color: #b8b7b9;">PURE AND NATURE</h3>
<h2 class="fs-35 tablet-fs-30 mobile-fs-20 margin-bottom-20 mobile-margin-bottom-10" style="line-height: 1.2;">Discover Real
Organic <span class="primary-color">Flavors</span></h2>
<h5 class="fs-14 mobile-fs-15 margin-bottom-10" style="color: #b8b7b9; line-height: 1.8;">Today discount</h5>
<h2 class="fs-45 tablet-fs-30 mobile-fs-20 margin-top-0 margin-bottom-20" style="line-height: 1.2; color: #e6480e;">30<sup>%</sup></h2>
<a class="primary-color button hide-for-mobile fs-14 tablet-fs-11 force-radius-5 hide-for-medium" style="text-transform: none; letter-spacing: 0; padding: 10px 25px;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][nasa_banner_2 move_x="9%" effect_text="fadeInLeft" data_delay="300ms" img_src="' . $imgs_2 . '"]
<h3 class="fs-12 mobile-fs-15 margin-top-5 margin-bottom-15" style="color: #b8b7b9;">FRESH AND TASTY</h3>
<h2 class="fs-35 tablet-fs-30 mobile-fs-20 margin-bottom-20 mobile-margin-bottom-10" style="line-height: 1.2;">Farm Market
Organic <span class="primary-color">Shop</span></h2>
<h5 class="fs-14 mobile-fs-15 margin-bottom-10" style="color: #b8b7b9; line-height: 1.8;">Today discount</h5>
<h2 class="fs-45 tablet-fs-30 mobile-fs-20 margin-top-0 margin-bottom-20" style="line-height: 1.2; color: #e6480e;">30<sup>%</sup></h2>
<a class="primary-color button hide-for-mobile fs-14 tablet-fs-11 force-radius-5 hide-for-medium" style="text-transform: none; letter-spacing: 0; padding: 10px 25px;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/nasa_slider][/vc_column][vc_column width="1/3" el_class="rtl-left"][nasa_banner_2 move_x="6%" effect_text="fadeInLeft" data_delay="300ms" hover="zoom" img_src="' . $imgs_3 . '"]
<h3 class="fs-14 margin-top-20 margin-bottom-10 tablet-margin-bottom-10" style="color: #499679;">GET EXTRA 50% OFF</h3>
<h4 class="fs-25 tablet-fs-16 mobile-fs-18 margin-bottom-15 tablet-margin-bottom-0 tablet-margin-bottom-0" style="line-height: 1.2; color: #f8810c;">Fresh
Everyday</h4>
<a class="fs-12 tablet-fs-12 mobile-fs-12" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][nasa_banner_2 move_x="6%" valign="middle" effect_text="fadeInLeft" data_delay="300ms" hover="zoom" img_src="' . $imgs_4 . '"]
<h3 class="fs-14 margin-top-20 margin-bottom-10" style="color: #ec8561;">HOT THIS WEEK</h3>
<h4 class="fs-25 tablet-fs-16 mobile-fs-18 margin-bottom-20 tablet-margin-bottom-0" style="line-height: 1.2;">Fresh <span class="primary-color">vegetable
&amp; Fruit</span> basket</h4>
<h5 class="fs-12" style="color: #afafaf;">Fresh Packed to order</h5>
[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 tablet-margin-bottom-40 padding-top-50 padding-bottom-30" css=".vc_custom_1655288719627{background-color: #f9f9f9 !important;}"][vc_column][nasa_product_categories list_cats="men, woman, haircare-woman, makeup-woman, nails-woman, bracelets-woman, earrings-woman, necklaces-woman" parent="false" hide_empty="0" columns_number="7" columns_number_small="2" columns_number_tablet="3" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 tablet-margin-bottom-0 mobile-margin-bottom-10"][vc_column][vc_tta_tabs title_tag="h3" alignment="right" title_font_size="l" tabs_display_type="2d-has-bg" tabs_bg_color="" title="Recommendations" el_class="letter-spacing-none"][vc_tta_section title="All" tab_id="1596708228738-17953d91-53db"][nasa_products type="featured_product" number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Fruits &amp; Vegetables" tab_id="1596708230330-4a2f8401-99c3"][nasa_products type="top_rate" number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Frozen Seafoods" tab_id="1596708231252-34e7b24b-5d0f"][nasa_products type="top_rate" number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Raw Meats" tab_id="1655095376617-b89344c5-5e42"][nasa_products number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Coffes &amp; Teas" tab_id="1655286069748-6554558a-4652"][nasa_products type="stock_desc" number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 tablet-margin-bottom-40 mobile-margin-bottom-50 padding-top-30 padding-bottom-30" css=".vc_custom_1656147452713{background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column][nasa_products type="deals" style="slide_slick_2" dots="true" number="3"][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 tablet-margin-bottom-0 mobile-margin-bottom-10"][vc_column][vc_tta_tabs title_tag="h3" alignment="right" title_font_size="l" tabs_display_type="2d-has-bg" tabs_bg_color="" title="Top Best Selling Items" el_class="letter-spacing-none"][vc_tta_section title="All" tab_id="1655111005460-9232d909-7593"][nasa_products type="featured_product" number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Fruits &amp; Vegetables" tab_id="1655111005481-b6dc6264-5520"][nasa_products type="top_rate" number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Milks &amp; Dairies" tab_id="1655111005501-5ec982bb-89d9"][nasa_products number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Pet Foods" tab_id="1655111005521-f3cb84f5-1351"][nasa_products number="6" columns_number="6" columns_number_tablet="4"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 tablet-margin-bottom-60 mobile-margin-bottom-60"][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 move_x="7%" effect_text="fadeInLeft" data_delay="100ms" hover="zoom" img_src="' . $imgs_5 . '"]
<h4 class="fs-22 tablet-fs-16 margin-bottom-20 tablet-margin-bottom-10" style="line-height: 1.2;">Fresh
Vegetable</h4>
<h6 class="fs-14 margin-bottom-15 tablet-margin-bottom-10 mobile-margin-bottom-20" style="color: #a9a9a9;">Sale off <span class="fs-25 tablet-fs-18 mobile-fs-15" style="color: #ff0000;">25%</span></h6>
<a class="fs-14 tablet-fs-12 mobile-fs-12" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 move_x="8%" effect_text="fadeInLeft" data_delay="100ms" hover="zoom" img_src="' . $imgs_6 . '"]
<h4 class="fs-14 margin-top-10 margin-bottom-10" style="color: #afaeac;">BEST CHOISE</h4>
<h4 class="fs-22 tablet-fs-16 margin-top-10 margin-bottom-35 tablet-margin-bottom-0" style="line-height: 1.2;">Discover
Real Organic Juice</h4>
<h6 class="fs-14 tablet-fs-10" style="line-height: 1.4; color: #c0c2bd;">ONLY
<span class="fs-29 tablet-fs-18 mobile-fs-15" style="color: #ff0000;">$19.00</span></h6>
[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 move_x="9%" effect_text="fadeInLeft" data_delay="100ms" hover="zoom" img_src="' . $imgs_7 . '"]
<h3 class="fs-23 tablet-fs-20 margin-bottom-60 tablet-margin-bottom-10 mobile-margin-bottom-40" style="color: #015a02;">Green Fruits
and Vegetables</h3>
<h3 class="fs-35 tablet-fs-16 mobile-fs-20 margin-bottom-0" style="color: #ff0000;">100%</h3>
<h3 class="fs-20 margin-top-5" style="color: #015a02;">ORGANIC</h3>
[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 tablet-margin-bottom-30 mobile-margin-bottom-0"][vc_column width="1/4" hide_in_mobile="1" el_class="desktop-padding-right-40 tablet-padding-right-10 mobile-margin-bottom-30 hide-for-medium"][nasa_title title_text="Essential Products" font_size="l" el_class="margin-bottom-25 mobile-margin-bottom-15"][nasa_banner_2 move_x="14%" img_src="' . $imgs_8 . '" el_class="text-banner-org"]
<h4 class="fs-30 tablet-fs-22 margin-bottom-20" style="line-height: 1.2; color: #3d3d3d;">Bring nature
into your home</h4>
<h5 class="fs-14 margin-bottom-40 nasa-bold" style="color: #7f7f7f; line-height: 1.8;">Contrary to popular belief,
Lorem Ipsum is not simply random text</h5>
<a class="primary-color nasa-bold button fs-14 force-radius-5" style="text-transform: none; letter-spacing: 0; padding: 10px 15px;" title="Shop now" href="#">Shop now</a>[/nasa_banner_2][/vc_column][vc_column width="3/4" offset="vc_col-lg-9 vc_col-md-12"][vc_tta_tabs title_tag="h3" alignment="right" title_font_size="l" tabs_display_type="2d-has-bg" tabs_bg_color="" el_class="letter-spacing-none"][vc_tta_section title="Featured" tab_id="1655095615591-34d4eb8f-0124"][nasa_products number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="Popular" tab_id="1655095615605-82862b21-9705"][nasa_products type="featured_product" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="On Sale" tab_id="1655095615619-7171fc27-f88b"][nasa_products type="stock_desc" number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][vc_tta_section title="New Added" tab_id="1655095615632-bd0b23ca-954b"][nasa_products number="10" columns_number="5" columns_number_tablet="4"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 tablet-margin-bottom-50 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Latest blog" title_desc="The freshest and most exciting news" title_align="text-center" font_size="l" el_class="margin-bottom-30"][nasa_post dots="true" arrows="1" posts="5" columns_number="4" columns_number_small_slider="1" columns_number_tablet="2" author_enable="no" page_blogs="no"][/vc_column][/vc_row][vc_row hide_in_mobile="1" el_class="margin-bottom-60 padding-top-40 padding-bottom-25 padding-left-30 padding-right-30 hide-for-medium" css=".vc_custom_1656147328763{background-image: url(' . $imgs_url_src_2 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/4" el_class="rtl-right mobile-margin-bottom-20" css=".vc_custom_1655356405494{padding-top: 12px !important;padding-right: 10px !important;padding-bottom: 12px !important;padding-left: 10px !important;}"][vc_column_text]
<h3 class="fs-25" style="margin: 0; white-space: nowrap;"><i class="icon-nasa-icons-12"></i> Sign up to Newsletter</h3>
[/vc_column_text][/vc_column][vc_column width="1/4" el_class="rtl-right text-right" css=".vc_custom_1655356414428{padding-top: 20px !important;padding-right: 10px !important;padding-bottom: 20px !important;padding-left: 10px !important;}"][vc_column_text]
<h5 class="fs-15" style="color: #666; margin: 0; white-space: nowrap;">…and receive $10 coupon for first shopping</h5>
[/vc_column_text][/vc_column][vc_column width="5/12" el_class="nasa-clear-none rtl-left organic-style-wrap" offset="vc_col-lg-offset-1"][contact-form-7 id="210"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '6',
            // '_nasa_plus_wide_option' => '1',
            // '_nasa_plus_wide_width' => '400',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#6bad0d',
            // '_nasa_footer_mode' => 'builder',
            // '_nasa_custom_footer' => 'footer-light-3',
            // '_nasa_custom_footer_mobile' => 'footer-light-3',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1655288719627{background-color: #f9f9f9 !important;}.vc_custom_1656147452713{background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1656147328763{background-image: url(' . $imgs_url_src_2 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1655356405494{padding-top: 12px !important;padding-right: 10px !important;padding-bottom: 12px !important;padding-left: 10px !important;}.vc_custom_1655356414428{padding-top: 20px !important;padding-right: 10px !important;padding-bottom: 20px !important;padding-left: 10px !important;}'
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
