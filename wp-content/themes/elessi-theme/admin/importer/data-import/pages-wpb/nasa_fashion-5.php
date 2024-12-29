<?php
function nasa_wpb_fashion_5() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner1.jpg', '3105', array(
        'post_title' => 'h2-banner1',
        'post_name' => 'h2-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner1-1.jpg', '3105', array(
        'post_title' => 'h2-banner1-1',
        'post_name' => 'h2-banner1-1',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner-deal1.jpg', '3106', array(
        'post_title' => 'h2-banner-deal1',
        'post_name' => 'h2-banner-deal1',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner2.jpg', '3108', array(
        'post_title' => 'h2-banner2',
        'post_name' => 'h2-banner2',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner2.jpg', '3108', array(
        'post_title' => 'h2-banner2',
        'post_name' => 'h2-banner2',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner4.jpg', '3108', array(
        'post_title' => 'h2-banner4',
        'post_name' => 'h2-banner4',
    ));
    
    $imgs_7 = elessi_import_upload('/wp-content/uploads/2018/03/parallax_bg_6.jpg', '0', array(
        'post_title' => 'parallax_bg_6',
        'post_name' => 'parallax_bg_6',
    ));
    $imgs_7_src = $imgs_7 ? wp_get_attachment_image_url($imgs_7, 'full') : 'https://via.placeholder.com/1920x1500';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Fashion V5',
            'post_name' => 'wpb-fashion-v5',
            'post_content' => '[vc_row el_class="desktop-margin-top-20 mobile-margin-top-10 mobile-margin-bottom-10"][vc_column width="2/3" el_class="nasa-min-height mobile-margin-bottom-10"][nasa_slider bullets="false" navigation="false" autoplay="true" el_class="right-now"][nasa_banner_2 align="right" text-align="text-right" img_src="' . $imgs_1 . '" el_class="mobile-font-size-150"]
    <h4>Autumn
    &amp; Winter 2019</h4>
    <h5 style="color: #999;">Enjoy this fall trend</h5>
    [/nasa_banner_2][nasa_banner_2 img_src="' . $imgs_2 . '" el_class="mobile-font-size-150"]
    <h4>New Arrival 2019</h4>
    <h5 style="color: #999;">Enjoy this fall trend</h5>
    [/nasa_banner_2][/nasa_slider][/vc_column][vc_column width="1/3"][nasa_banner_2 align="center" valign="bottom" text-align="text-center" effect_text="fadeInLeft" data_delay="400ms" img_src="' . $imgs_3 . '"]
    <div>

    &nbsp;
    <h5 class="margin-bottom-20" style="font-weight: bold;">Sale Off 30%</h5>
    [nasa_countdown date="2025-12-30"]

    </div>
    [/nasa_banner_2][/vc_column][/vc_row][vc_row][vc_column width="1/3"][nasa_banner_2 text_color="dark" effect_text="fadeInLeft" hover="zoom" data_delay="600ms" img_src="' . $imgs_4 . '"]
    <h5 style="color: #333; font-weight: bold; font-size: 180%;">Flower Handbag</h5>
    <h6 style="color: #999;">Woman &amp; Bag</h6>
    [/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 text_color="dark" effect_text="flipInX" hover="zoom" data_delay="600ms" img_src="' . $imgs_5 . '"]
    <h5 style="color: #333; font-weight: bold; font-size: 180%;">Mesh sneakers</h5>
    <h6 style="color: #999;">Men &amp; Shoes</h6>
    [/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 text_color="dark" effect_text="flipInX" hover="zoom" data_delay="600ms" img_src="' . $imgs_6 . '"]
    <h5 style="color: #333; font-weight: bold; font-size: 180%;">Baseball cap</h5>
    <h6 style="color: #999;">Accessories</h6>
    [/nasa_banner_2][/vc_column][/vc_row][vc_row css=".vc_custom_1518630214166{margin-top: 40px !important;}"][vc_column][nasa_title title_text="Our Products" title_type="h3" font_size="xl" title_align="text-center"][/vc_column][/vc_row][vc_row css=".vc_custom_1503052907620{margin-bottom: 50px !important;}"][vc_column][vc_tta_tabs alignment="center" style="classic" shape="rounded" color="grey" spacing="1" gap="" tab_position="top" autoplay="none" active_section="1" pagination_style="" pagination_color="grey" no_fill_content_area="" el_class="test-tab"][vc_tta_section hr="1" title="FEATURED" tab_id="1503045606089-3edef01b-fd71"][nasa_products style="carousel" shop_url="0" arrows="0" number="6" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="BEST SELLING" tab_id="1503045703145-638e74ae-46c0"][nasa_products style="carousel" shop_url="0" arrows="0" number="6" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="ON SALE" tab_id="1503045606096-82a40895-9f4d"][nasa_products style="carousel" shop_url="0" arrows="0" number="6" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="TOP RATED" tab_id="1503045667189-19990b27-61f8"][nasa_products style="carousel" shop_url="0" arrows="0" number="6" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="RECENT" tab_id="1503045692407-992826db-2393"][nasa_products style="carousel" shop_url="0" arrows="0" number="6" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row parallax="content-moving" parallax_speed="0.7" css=".vc_custom_1571648564371{margin-bottom: 70px !important;padding-top: 70px !important;padding-bottom: 70px !important;background-image: url(' . $imgs_7_src . ') !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="desktop-padding-left-80 margin-bottom-50 padding-top-30 padding-bottom-50"][vc_column][vc_row_inner][vc_column_inner width="1/2"][nasa_products_special_deal style="for_time" date_sc="2025-12-30" columns_number="2" columns_number_small="2" columns_number_tablet="2" arrows="1" auto_slide="false" el_class="text-color-white" title="Deal of the week" desc_shortcode="Sale 35% for all T-Shirt products"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Top Rated" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="2"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Best Selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="2"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="On Sale" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="2"][/vc_column][/vc_row][vc_row css=".vc_custom_1565681082096{margin-bottom: 50px !important;padding-top: 30px !important;}" el_class="mobile-padding-top-0 mobile-margin-bottom-25"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '2',
            // '_nasa_fullwidth_main_menu' => '-1',
            // ' _nasa_footer_mode' => 'builder',
            // '_nasa_custom_footer' => 'footer-dark',
            // '_nasa_custom_footer_mobile' => 'footer-mobile',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1518630214166{margin-top: 40px !important;}.vc_custom_1503052907620{margin-bottom: 50px !important;}.vc_custom_1571648564371{margin-bottom: 70px !important;padding-top: 70px !important;padding-bottom: 70px !important;background-image: url(' . $imgs_7_src . ') !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1565681082096{margin-bottom: 50px !important;padding-top: 30px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '2',
            
            'fixed_nav' => '0',
            
            'fullwidth_main_menu' => '0',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-dark',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'left',
            
            // 'product_detail_layout' => 'modern-1',
            // 'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            'tab_style_info' => 'ver-2',
            
            // 'loop_layout_buttons' => 'hoz-buttons',
            
            // 'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            'nasa_attr_color_style' => 'round',
            'nasa_attr_label_style' => 'round',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f8f8f8',
        ),
    );
}
