<?php
function nasa_wpb_medical_1() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2021/11/m1-slide1.jpg', '3556', array(
        'post_title' => 'm1-slide1',
        'post_name' => 'm1-slide1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2021/11/m1-slide2.jpg', '3556', array(
        'post_title' => 'm1-slide2',
        'post_name' => 'm1-slide2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2021/11/m1-banner1.jpg', '3555', array(
        'post_title' => 'm1-banner1',
        'post_name' => 'm1-banner1',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2021/11/m1-banner2.jpg', '3555', array(
        'post_title' => 'm1-banner2',
        'post_name' => 'm1-banner2',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2021/11/m1-banner3.jpg', '3318', array(
        'post_title' => 'm1-banner3',
        'post_name' => 'm1-banner3',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2021/11/m1-banner4.jpg', '3318', array(
        'post_title' => 'm1-banner4',
        'post_name' => 'm1-banner14',
    ));
    
    $imgs_7 = elessi_import_upload('/wp-content/uploads/2021/11/m1-banner5.jpg', '3318', array(
        'post_title' => 'm1-banner5',
        'post_name' => 'm1-banner5',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Medical V1',
            'post_name' => 'wpb-medical-v1',
            'post_content' => '[vc_row el_class="margin-bottom-40 mobile-margin-top-10 mobile-margin-bottom-50"][vc_column width="2/3" el_class="rtl-right"][nasa_slider bullets="false" bullets_pos="inside" column_number="1" column_number_small="1" column_number_tablet="1" force="true" autoplay="true" bullets_type="bullets_type_2" el_class="mobile-margin-bottom-10"][nasa_banner_2 effect_text="fadeInLeft" img_src="' . $imgs_1 . '"]
<h3 class="desktop-margin-top-18 fs-20 mobile-fs-15 desktop-margin-bottom-15" style="color: #fff; font-weight: 300 !important;">Best choise</h3>
<h2 class="tablet-fs-30 mobile-fs-20" style="line-height: 1.2; color: #fff;">Home
<span style="font-weight: 300;">Medical Store</span></h2>
<h5 class="fs-16 mobile-fs-15 margin-bottom-20 primary-color" style="color: #fff; line-height: 1.8;">We pride ourselves in making
personalized care and service a priority.</h5>
<a class="button small fs-16 hide-for-small" style="background-color: #fed65a; text-transform: capitalize; color: #000; letter-spacing: 0;" title="Shop now" href="#">Shop Now</a>[/nasa_banner_2][nasa_banner_2 effect_text="fadeInLeft" img_src="' . $imgs_2 . '"]
<h3 class="desktop-margin-top-18 fs-20 mobile-fs-15 desktop-margin-bottom-15" style="color: #fff; font-weight: 300 !important;">Best choise</h3>
<h2 class="tablet-fs-30 mobile-fs-20" style="line-height: 1.2; color: #fff;">Digital
<span style="font-weight: 300;">Thermometer</span></h2>
<h5 class="fs-16 mobile-fs-15 margin-bottom-20 primary-color" style="color: #fff; line-height: 1.8;">Small size, easy to carry, Suitable for
daily use, measuring, your healthy at any time</h5>
<a class="button small fs-16 hide-for-small" style="background-color: #fed65a; text-transform: capitalize; color: #000; letter-spacing: 0;" title="Shop now" href="#">Shop Now</a>[/nasa_banner_2][/nasa_slider][/vc_column][vc_column width="1/3" el_class="rtl-left"][nasa_banner_2 effect_text="flipInX" hover="zoom" img_src="' . $imgs_3 . '"]
<h3 class="fs-14 margin-bottom-25 tablet-margin-bottom-10" style="color: #afafaf;">HOME MEDICAL</h3>
<h4 class="fs-20 tablet-fs-16 mobile-fs-18 margin-bottom-30 tablet-margin-bottom-0 tablet-margin-bottom-0" style="line-height: 1.2; color: #505050; font-weight: 300 !important;">Blood
Pressure
Monitor</h4>
<h5 class="fs-16" style="font-weight: 100 !important; color: #979797;">Sale Off   <span style="font-weight: 500; color: #e1663e;">50% </span></h5>
[/nasa_banner_2][nasa_banner_2 valign="middle" effect_text="flipInX" hover="zoom" img_src="' . $imgs_4 . '"]
<h3 class="fs-14 margin-bottom-25" style="color: #fff;">PERSONAL</h3>
<h4 class="fs-20 tablet-fs-16 mobile-fs-18 margin-bottom-30 tablet-margin-bottom-0 font-weight: 300 !important" style="line-height: 1.2; color: #fff;">Medical
Face Mask</h4>
<h5 class="fs-16" style="font-weight: 100 !important; color: #fff;">From   <span style="font-weight: 500;">$4.00 </span></h5>
[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 tablet-margin-bottom-40"][vc_column][nasa_title title_text="Shop by Categories" font_size="m" el_class="margin-bottom-10"][nasa_product_categories list_cats="men, woman, haircare-woman, makeup-woman, nails-woman, bracelets-woman, earrings-woman, necklaces-woman" parent="false" hide_empty="0" columns_number="7" columns_number_small="2" columns_number_tablet="3" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 tablet-margin-bottom-0 mobile-margin-bottom-10"][vc_column][vc_tta_tabs alignment="right" title_font_size="m" tabs_display_type="2d-has-bg" tabs_bg_color="" title="Healthcare Products" el_class="letter-spacing-none"][vc_tta_section title="Dental Tools" tab_id="1596708228738-17953d91-53db"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Mum &amp; Baby" tab_id="1596708230330-4a2f8401-99c3"][nasa_products type="featured_product" number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Healthy &amp; First Aids" tab_id="1596708231252-34e7b24b-5d0f"][nasa_products type="on_sale" number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-80 tablet-margin-bottom-60 mobile-margin-bottom-70"][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 valign="middle" effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_5 . '"]
<h3 class="fs-23 tablet-fs-16 mobile-fs-20 margin-bottom-30 tablet-margin-bottom-10 mobile-margin-bottom-20" style="line-height: 1.2;">Massage
&amp; Relaxation</h3>
<a class="primary-color button small fs-13 tablet-fs-11" style="text-transform: capitalize; letter-spacing: 0;" title="Shop now" href="#">Shop Now</a>[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 effect_text="flipInX" data_delay="600ms" hover="zoom" img_src="' . $imgs_6 . '"]
<h4 class="margin-bottom-30 tablet-margin-bottom-0 mobile-margin-bottom-15 fs-23 tablet-fs-16 mobile-fs-20" style="line-height: 1.2; margin-top: 14px;">Fingertip
Pulse Oximeter</h4>
<h6 class="margin-bottom-30 tablet-margin-bottom-10 mobile-margin-bottom-20 fs-16 tablet-fs-14 mobile-fs-14" style="color: #979797; line-height: 1.8;">Just only
<span class="fs-25 tablet-fs-16 mobile-fs-18 primary-color">$169.00</span></h6>
[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 valign="middle" effect_text="fadeInUp" data_delay="600ms" hover="zoom" img_src="' . $imgs_7 . '"]
<h3 class="fs-13 margin-bottom-25 tablet-margin-bottom-10" style="color: #afafaf;">HOME MEDICAL</h3>
<h4 class="fs-23 tablet-fs-16 mobile-fs-20 margin-bottom-30 tablet-margin-bottom-10" style="line-height: 1.2; color: #505050;">Baby Infrared
Temperature Gun</h4>
<a class="primary-color button small fs-13 tablet-fs-11" style="text-transform: capitalize; letter-spacing: 0;" title="Shop now" href="#">Shop Now</a>[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 tablet-margin-bottom-40 mobile-margin-bottom-20"][vc_column][nasa_products_special_deal limit="5" style="multi-2" arrows="1" auto_slide="false" el_class="nasa-demo"][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 tablet-margin-bottom-30 mobile-margin-bottom-30"][vc_column width="1/3"][nasa_products title_shortcode="Top Rated" type="featured_product" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-bottom-10"][nasa_products title_shortcode="Best Selling" type="best_selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="On Sale" type="on_sale" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 tablet-margin-bottom-50 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Advice From Health Experts" title_desc="The freshest and most exciting news" font_size="m" el_class="margin-bottom-30"][nasa_post dots="true" arrows="1" posts="5" columns_number="4" columns_number_small_slider="1" columns_number_tablet="2" readmore="no" page_blogs="no"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '1',
            // '_nasa_plus_wide_option' => '1',
            // '_nasa_plus_wide_width' => '100',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#28aeb1',
            // '_nasa_bg_color_topbar' => '#28aeb1',
            // '_nasa_text_color_topbar' => '#ffffff'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'fixed_nav' => '0',
            
            'plus_wide_width' => '100',
            'color_primary' => '#28aeb1',
            
            'bg_color_topbar' => '#28aeb1',
            'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            'category_sidebar' => 'right-classic',
            'wrapper_widgets' => '1',
            
            'product_detail_layout' => 'classic',
            // 'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            // 'tab_style_info' => '2d-no-border',
            
            'single_product_thumbs_style' => 'hoz',
            
            'loop_layout_buttons' => 'hoz-buttons',
            
            // 'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            // 'nasa_attr_color_style' => 'round',
            // 'nasa_attr_label_style' => 'round',
            
            'breadcrumb_row' => 'single',
            'breadcrumb_type' => 'default',
            'breadcrumb_bg_color' => '#f8f8f8',
            'breadcrumb_align' => 'text-left',
            'breadcrumb_height' => '60',
        ),
    );
}
