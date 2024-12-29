<?php
function nasa_wpb_accessories_1() {
    $imgs_url = elessi_import_upload('/wp-content/uploads/2019/10/retail-banner-top.jpg', '3198', array(
        'post_title' => 'retail-banner-top',
        'post_name' => 'retail-banner-top',
    ));
    
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-2-banner-1-3.jpg', '3136', array(
        'post_title' => 'home-digi-2-banner-1-3',
        'post_name' => 'home-digi-2-banner-1-3',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-2-banner-1-2.jpg', '3136', array(
        'post_title' => 'home-digi-2-banner-1-2',
        'post_name' => 'home-digi-2-banner-1-2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2019/10/home-digi-2-banner-1-1.jpg', '3136', array(
        'post_title' => 'home-digi-2-banner-1-1',
        'post_name' => 'home-digi-2-banner-1-1',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2019/12/banner-deal-tech-acc-1.jpg', '3197', array(
        'post_title' => 'banner-deal-tech-acc-1',
        'post_name' => 'banner-deal-tech-acc-1',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2019/12/banner-deal-tech-acc-2.jpg', '3197', array(
        'post_title' => 'banner-deal-tech-acc-2',
        'post_name' => 'banner-deal-tech-acc-2',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Accessories V1',
            'post_name' => 'wpb-accessories-v1',
            'post_content' => '[vc_row parallax="content-moving" parallax_image="' . $imgs_url . '" css=".vc_custom_1576293914043{border-bottom-width: 1px !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;border-bottom-color: #ececec !important;border-bottom-style: solid !important;}" el_class="margin-bottom-20"][vc_column el_class="desktop-padding-top-100 desktop-padding-bottom-150 mobile-padding-top-50 mobile-padding-bottom-50 desktop-padding-left-100 desktop-padding-right-100"][vc_column_text]
    <h3 class="text-center nasa-ignore-margin nasa-leading" style="font-weight: 300;">Select Your <span class="primary-color" style="font-weight: bold;">Accessories</span></h3>
    <h6 class="text-center margin-bottom-40 margin-top-0">OVER 10.000 ACCESSORIES</h6>
    [/vc_column_text][nasa_product_nasa_categories hide_empty="0"][/vc_column][/vc_row][vc_row el_class="margin-bottom-20"][vc_column width="1/3"][nasa_banner valign="middle" effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_1 . '"]
    <h5 style="font-weight: bold;">Mobile<span style="font-weight: 300;">
    Accessories</span></h5>
    <h6 style="font-size: 120%;">Just <span style="font-size: 130%; color: #67981a; font-weight: bold;">$120</span></h6>
    <a class="button margin-top-15" href="#">Shop Now</a>[/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner hover="zoom" img_src="' . $imgs_2 . '"][/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner valign="middle" effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_3 . '"]
    <h5 style="font-weight: bold;">Iphone <span style="font-weight: 300;">Case</span></h5>
    <h6 style="font-size: 120%;">Sale <span style="color: #ff0000; font-weight: bold;">25%</span> Off</h6>
    <a class="button margin-top-15" title="Shop now" href="#">Shop Now</a>[/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column][nasa_title title_text="Featured Categories" title_type="h3" font_size="l" title_align="text-center"][vc_empty_space height="15px"][nasa_product_categories list_cats="grooming-men, shoes-men, clothing-woman, jewelry-woman, beauty, kid" disp_type="grid" hide_empty="0" columns_number="3" columns_number_small="1" columns_number_tablet="2"][/vc_column][/vc_row][vc_row el_class="margin-bottom-45"][vc_column][vc_tta_tabs alignment="right" tabs_display_type="2d-has-bg" tabs_bg_color="#f4f4f4" title="What we offer"][vc_tta_section title="NEW ARRIVALS" tab_id="1557397390547-4cb919ea-c730"][nasa_products style="infinite" style_viewmore="2" pos_nav="left" number="10" columns_number="5" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="FEATURED" tab_id="1557397390572-848ea0dc-90af"][nasa_products style="infinite" style_viewmore="2" pos_nav="left" number="10" columns_number="5" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="ON SALE" tab_id="1557397396400-c1a21dd7-6207"][nasa_products style="infinite" style_viewmore="2" pos_nav="left" number="10" columns_number="5" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row fullwidth="1" el_class="margin-bottom-60"][vc_column][nasa_slider navigation="false" bullets_pos="inside" bullets_type=""][nasa_banner move_x="10%" valign="middle" banner_responsive="no" img_src="' . $imgs_4 . '"]
    <h6 class="margin-top-0 desktop-margin-bottom-10 mobile-margin-bottom-5">MOBILE ACCESSORIES</h6>
    <h3 class="mobile-margin-top-5 mobile-margin-bottom-5">Apple watch Sport Band</h3>
    <div class="price font-200 nasa-bold desktop-margin-bottom-30 mobile-margin-bottom-5 mobile-margin-top-5"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>299.00</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>199.00</span></ins></div>
    [nasa_countdown date="2025-12-30" size="small" align="left" el_class="rtl-text-right"]
    <div class="margin-top-20"><a class="button small" title="Shop now" href="#">Shop Now</a></div>
    [/nasa_banner][nasa_banner move_x="10%" valign="middle" banner_responsive="no" img_src="' . $imgs_5 . '"]
    <h6 class="margin-top-0 desktop-margin-bottom-10 mobile-margin-bottom-5">MOBILE ACCESSORIES</h6>
    <h3 class="mobile-margin-top-5 mobile-margin-bottom-5">Integrated PTZ camera Stabilizes</h3>
    <div class="price font-200 nasa-bold desktop-margin-bottom-30 mobile-margin-bottom-5 mobile-margin-top-5"><del><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>290.00</span></del> <ins><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">$</span>199.00</span></ins></div>
    [nasa_countdown date="2025-12-30" size="small" align="left" el_class="rtl-text-right"]
    <div class="margin-top-20"><a class="button small" title="Shop now" href="#">Shop Now</a></div>
    [/nasa_banner][/nasa_slider][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column width="1/3"][nasa_products title_shortcode="Top Rated" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="Best Selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="On Sale" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][/vc_row][vc_row][vc_column][nasa_title title_text="Lastest news" title_desc="Featured pharecha est nec ligula efficitur" title_type="h3" font_size="l" title_align="text-center" el_class="margin-bottom-30"][nasa_post arrows="0" posts="4" columns_number="3" columns_number_small="1" columns_number_tablet="2" readmore="no"][/vc_column][/vc_row][vc_row el_class="margin-bottom-10"][vc_column][nasa_products_viewed title="Recently Viewed" columns_number="4" columns_number_small="1" columns_number_tablet="3" el_class="nasa-hide-stars"][/vc_column][/vc_row][vc_row el_class="margin-bottom-40"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '4',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#d89701',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1576293914043{border-bottom-width: 1px !important;background-position: center;background-repeat: no-repeat !important;background-size: cover !important;border-bottom-color: #ececec !important;border-bottom-style: solid !important;}'
        ),
        
        'globals' => array(
            'header-type' => '4',
            
            'fixed_nav' => '0',
            
            'color_primary' => '#d89701',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            'product_detail_layout' => 'modern-1',
            'tab_style_info' => 'scroll-down',
            'loop_layout_buttons' => 'modern-3',
            
            'animated_products' => 'hover-left-to-right',
            
            'nasa_attr_image_style' => 'square'
        ),
    );
}
