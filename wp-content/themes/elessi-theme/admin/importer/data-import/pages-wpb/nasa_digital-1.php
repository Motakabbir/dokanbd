<?php
function nasa_wpb_digital_1() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-banner1.jpg', '3103', array(
        'post_title' => 'home-digi-banner1',
        'post_name' => 'home-digi-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-banner2.jpg', '3103', array(
        'post_title' => 'home-digi-banner2',
        'post_name' => 'home-digi-banner2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-banner3.jpg', '3103', array(
        'post_title' => 'home-digi-banner3',
        'post_name' => 'home-digi-banner3',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-banner-4.jpg', '3126', array(
        'post_title' => 'home-digi-banner-4',
        'post_name' => 'home-digi-banner-4',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-banner-5.jpg', '3126', array(
        'post_title' => 'home-digi-banner-5',
        'post_name' => 'home-digi-banner-5',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Digital V1',
            'post_name' => 'wpb-digital-v1',
            'post_content' => '[vc_row][vc_column width="1/4" el_class="nasa-min-height rtl-right"][/vc_column][vc_column width="3/4" el_class="rtl-left desktop-margin-top-20 mobile-margin-top-10"][nasa_rev_slider alias="slider-digi-v1"][vc_row_inner el_class="margin-top-20 mobile-margin-top-10"][vc_column_inner width="1/3"][nasa_banner effect_text="fadeInUp" hover="fade" data_delay="300ms" img_src="' . $imgs_1 . '"]
    <h6>NEW 360 VR</h6>
    <p style="color: #888;">30% off this week</p>
    [/nasa_banner][/vc_column_inner][vc_column_inner width="1/3"][nasa_banner effect_text="fadeInUp" hover="fade" data_delay="600ms" img_src="' . $imgs_2 . '"]
    <h6>MOTO-Z</h6>
    <p style="color: #888;">Sale off 25%</p>
    [/nasa_banner][/vc_column_inner][vc_column_inner width="1/3"][nasa_banner effect_text="fadeInUp" hover="fade" data_delay="800ms" img_src="' . $imgs_3 . '"]
    <h6>NEW PHONE</h6>
    <p style="color: #888;">Exclusie offer</p>
    [/nasa_banner][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_class="margin-top-30"][vc_column width="1/4"][nasa_title title_text="Special offer" title_type="h3" font_size="m"][nasa_products_special_deal limit="3" columns_number="1" columns_number_small="1" columns_number_tablet="1" arrows="0" auto_slide="false" el_class="margin-bottom-30"][nasa_products title_shortcode="Top Rated" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][nasa_post title="Digital News" arrows="1" posts="3" columns_number="1" columns_number_small="1" columns_number_tablet="1" author_enable="no" page_blogs="no"][/vc_column][vc_column width="3/4" el_class="desktop-padding-left-30"][nasa_title title_text="Best Selling" title_type="h3" font_size="m"][nasa_products style="carousel" shop_url="0" arrows="0" number="12" columns_number="3" columns_number_small="2" columns_number_tablet="3" el_class="desktop-margin-bottom-15"][nasa_banner move_x="5%" valign="middle" effect_text="fadeInLeft" hover="zoom" data_delay="300ms" img_src="' . $imgs_4 . '"]
    <h5><span style="font-size: 150%; font-weight: 400;">Video Meeting</span>
    Meetup Conferencecam</h5>
    <h5 class="primary-color">Only $199.00</h5>
    [/nasa_banner][nasa_products title_shortcode="Deal Offer" style="carousel" pos_nav="left" shop_url="0" arrows="1" number="6" columns_number="3" columns_number_small="2" columns_number_tablet="2" el_class="desktop-margin-bottom-15 desktop-padding-top-30"][nasa_banner height="161px" align="right" move_x="5%" valign="middle" text-align="text-center" effect_text="fadeInLeft" hover="zoom" data_delay="300ms" img_src="' . $imgs_5 . '"]
    <h5><span class="primary-color" style="font-size: 150%; font-weight: 400;">BIG SALE</span>
    For all Virtual Reality Glasses</h5>
    Saving 30% Off on all online store items[/nasa_banner][nasa_products title_shortcode="On Sale" style="carousel" pos_nav="left" shop_url="0" arrows="1" number="6" columns_number="3" columns_number_small="2" columns_number_tablet="3" el_class="desktop-margin-bottom-30 desktop-padding-top-30"][/vc_column][/vc_row][vc_row fullwidth="1" css=".vc_custom_1570016227663{margin-bottom: 50px !important;padding-top: 10px !important;padding-bottom: 10px !important;background-color: #296dc1 !important;}"][vc_column][nasa_slider bullets="false" navigation="false" autoplay="true"][vc_column_text]
    <p style="font-size: 120%; text-align: center; color: #fff;">With each receipt over $150 from Digi get voucher <span style="font-size: 140%;">15% off </span>immediately.</p>
    [/vc_column_text][vc_column_text]
    <p style="font-size: 120%; text-align: center; color: #fff;">10% instant discount using <span style="font-size: 140%;">HSBC bank </span> credit cards.</p>
    [/vc_column_text][/nasa_slider][/vc_column][/vc_row][vc_row][vc_column width="1/3"][nasa_products title_shortcode="Featured" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Best Selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Recent" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][/vc_row][vc_row css=".vc_custom_1503825806783{margin-bottom: 50px !important;padding-top: 30px !important;}"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '6',
            '_nasa_vertical_menu_allways_show' => 'on',
            // '_nasa_fixed_nav' => '-1',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#296dc1',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1570016227663{margin-bottom: 50px !important;padding-top: 10px !important;padding-bottom: 10px !important;background-color: #296dc1 !important;}.vc_custom_1503825806783{margin-bottom: 50px !important;padding-top: 30px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '6',
            
            'fixed_nav' => '0',
            
            // 'plus_wide_width' => '100',
            'color_primary' => '#296dc1',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            'category_sidebar' => 'left',
            
            'product_detail_layout' => 'modern-1',
            // 'product_image_layout' => 'single',
            'tab_style_info' => 'scroll-down',
            
            'loop_layout_buttons' => 'modern-3',
            
            // 'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square',
            'nasa_attr_color_style' => 'big-square',
            'nasa_attr_label_style' => 'big-square',
            
            'breadcrumb_row' => 'single',
            'breadcrumb_type' => 'default',
            'breadcrumb_bg_color' => '#f8f8f8',
            'breadcrumb_align' => 'text-left',
            'breadcrumb_height' => '60',
        ),
    );
}
