<?php
function nasa_wpb_glasses_2() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2023/10/glasses-2-shop-men.jpg', '3094', array(
        'post_title' => 'glasses-v2-shop-men',
        'post_name' => 'glasses-v2-shop-men',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2023/10/glasses-2-shop-woman.jpg', '3094', array(
        'post_title' => 'glasses-v2-shop-woman',
        'post_name' => 'glasses-v2-shop-woman',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2023/10/glasses-2-shop-kid.jpg', '3094', array(
        'post_title' => 'glasses-v2-shop-kid',
        'post_name' => 'glasses-v2-shop-kid',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2023/10/glasses-2-banner-1.jpg', '3117', array(
        'post_title' => 'glasses-v2-banner-1',
        'post_name' => 'glasses-v2-banner-1',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2023/10/glasses-2-banner-2.jpg', '3117', array(
        'post_title' => 'glasses-v2-banner-2',
        'post_name' => 'glasses-v2-banner-2',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2023/10/glasses-2-banner-3.jpg', '3117', array(
        'post_title' => 'glasses-v2-banner-3',
        'post_name' => 'glasses-v2-banner-3',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Glasses V2',
            'post_name' => 'wpb-glasses-v2',
            'post_content' => '[vc_row][vc_column width="1/3"][nasa_banner_2 align="center" valign="middle" text_align="text-center" hover="zoom" img_src="' . $imgs_1 . '" el_class="nasa-bold-500"]
<div class="fs-30 tablet-fs-25 mobile-fs-20 margin-top-10 margin-bottom-10" style="line-height: 1.2; color: #fff;">MEN 
SUNGLASSES</div>
<a class="button ns-baner_btn_zoom small fs-16 force-radius-20" style="height: 40px; text-transform: capitalize; letter-spacing: 0; background: transparent; color: #fff; border: 2px #FFF solid; margin-top: 10px; padding: 15px;" tabindex="0" title="Shop now" href="#">Shop Now <span class="fs-20 margin-left-5">→</span></a>[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 align="center" valign="middle" text_align="text-center" hover="zoom" img_src="' . $imgs_2 . '" el_class="nasa-bold-500"]
<div class="fs-30 tablet-fs-25 mobile-fs-20 margin-top-10 margin-bottom-10" style="line-height: 1.2; color: #fff;">WOMEN 
SUNGLASSES</div>
<a class="button small ns-baner_btn_zoom fs-16 force-radius-20" style="height: 40px; text-transform: capitalize; letter-spacing: 0; background: transparent; color: #fff; border: 2px #FFF solid; margin-top: 10px; padding: 15px;" tabindex="0" title="Shop now" href="#">Shop Now <span class="fs-20 margin-left-5">→</span></a>[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 align="center" valign="middle" text_align="text-center" hover="zoom" img_src="' . $imgs_3 . '" el_class="nasa-bold-500"]
<div class="fs-30 tablet-fs-25 mobile-fs-20 margin-top-10 margin-bottom-10" style="line-height: 1.2; color: #fff;">KID 
SUNGLASSES</div>
<a class="button ns-baner_btn_zoom small fs-16 force-radius-20" style="height: 40px; text-transform: capitalize; letter-spacing: 0; background: transparent; color: #fff; border: 2px #FFF solid; margin-top: 10px; padding: 15px;" tabindex="0" title="Shop now" href="#">Shop Now <span class="fs-20 margin-left-5">→</span></a>[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 mobile-margin-bottom-30 margin-top-50"][vc_column width="1/5" offset="vc_col-md-6 vc_col-xs-6" el_class="mobile-margin-bottom-10"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Free Shipping" service_icon="pe-7s-plane" service_desc="Free Shipping for all US order"][/vc_column][vc_column width="1/5" offset="vc_col-md-6 vc_col-xs-6" el_class="mobile-margin-bottom-10"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Support 24/7" service_icon="pe-7s-headphones" service_desc="We support 24h a day"][/vc_column][vc_column width="1/5" offset="vc_col-md-6 vc_col-xs-6"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Money Back" service_icon="pe-7s-refresh-2" service_desc="You have 30 days to Return"][/vc_column][vc_column width="1/5" offset="vc_col-md-6 vc_col-xs-6"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Payment Secure" service_icon="pe-7s-gift" service_desc="We ensure secure payment"][/vc_column][vc_column width="1/5" hide_in_mobile="1" el_class="mobile-align-center" offset="vc_col-md-12 vc_hidden-md vc_col-xs-12"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Discount" service_icon="pe-7s-piggy" service_desc="Up to 40% for member"][/vc_column][/vc_row][vc_row el_class="margin-top-40 mobile-margin-top-20"][vc_column][nasa_title title_text="Shop by frame" title_desc="Discover your perfect pair with our curated categories" title_align="text-center" font_size="l"][nasa_product_categories list_cats="grooming-men, shoes-men, clothing-woman, jewelry-woman, beauty, kid, accessories-men" disp_type="Horizontal6" columns_number="7" columns_number_small="2" columns_number_tablet="4" el_class="items-r50 items-padding-20px hover-box-sd"][/vc_column][/vc_row][vc_row el_class="margin-top-30 mobile-margin-top-15"][vc_column][nasa_title title_text="Best sellers, ooh la la" title_align="text-center" font_size="l" el_class="mobile-margin-bottom-20"][nasa_products style="carousel" arrows="0" number="6" columns_number="5" columns_number_tablet="3"][/vc_column][/vc_row][vc_row el_class="margin-top-30 mobile-margin-top-20"][vc_column width="1/3"][nasa_banner_2 valign="middle" hover="zoom" img_src="' . $imgs_4 . '" el_class="nasa-bold-500"]
<div class="fs-25 tablet-fs-20 mobile-fs-20 margin-bottom-10" style="line-height: 1.2; color: #333333;">Classic
Eyeglasses</div>
<a class="button ns-baner_btn_zoom small fs-16 force-radius-20" style="text-transform: capitalize; height: 40px; letter-spacing: 0; background: transparent; color: #000; border: 2px #000 solid; margin-top: 10px; padding: 0 12px;" title="Shop now" href="#">Shop Now <span class="fs-20 margin-left-5">→</span></a>[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 valign="middle" hover="zoom" img_src="' . $imgs_5 . '" el_class="nasa-bold-500"]
<div class="fs-25 tablet-fs-20 mobile-fs-20 margin-bottom-10" style="line-height: 1.2; color: #fff;">Summer
Collection</div>
<div class="fs-15 tablet-fs-25 mobile-fs-20 margin-top-10 " style="line-height: 1.2; color: #fff;">Sale off<span class="fs-25 hide-for-medium nasa-bold-500" style="color: #fff; position: relative; margin-left: 5px;">25%</span></div>
[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 align="right" valign="middle" text_align="text-right" hover="zoom" img_src="' . $imgs_6 . '" el_class="nasa-bold-500"]
<div class="fs-25 tablet-fs-20 mobile-fs-20 margin-bottom-10" style="line-height: 1.2; color: #333333;">Glasses
&amp; Sunglasses</div>
<div class="fs-15 tablet-fs-25 mobile-fs-20 nasa-flex je margin-top-10 " style="line-height: 1.2; color: #333333;">Sale off<span class="fs-25 hide-for-medium nasa-bold-500 primary-color" style="position: relative; margin-left: 5px;">25%</span></div>
[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-top-40 mobile-margin-top-35"][vc_column][nasa_title title_text="Best sellers, ooh la la" title_align="text-center" font_size="l" el_class="mobile-margin-bottom-20"][nasa_products type="featured_product" style="carousel" arrows="0" number="6" columns_number="5" columns_number_tablet="3"][/vc_column][/vc_row][vc_row el_class="brand-item-white mobile-margin-bottom-0 margin-top-30" css=".vc_custom_1698809756170{padding-top: 50px !important;padding-bottom: 50px !important;}"][vc_column][vc_column_text]
<p class="nasa-title-desc margin-bottom-0" style="text-align: center; line-height: 1;">LOREM IP SUM LORAM</p>

<h3 class="fs-29 tablet-fs-28 mobile-fs-27 margin-bottom-0 margin-bottom-15" style="text-align: center; line-height: 1.2;">Shop by Brands</h3>
[/vc_column_text][nasa_brands images="' . elessi_imp_brands_v2_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][vc_column_text]
<p style="text-align: center;"><a class="button ns-baner_btn_zoom small fs-16" style="height: 50px; text-transform: capitalize; letter-spacing: 0; background: transparent; border-radius: 100px; color: #000; border: 2px #000 solid; padding: 10px 50px; margin: 20px 0px 0px 0px;" title="See all" href="#">See all <span class="fs-20 margin-left-5">→</span></a></p>
[/vc_column_text][/vc_column][/vc_row][vc_row el_class="mobile-margin-top-25 mobile-margin-bottom-0 margin-top-35"][vc_column css=".vc_custom_1698312118227{margin-top: 20px !important;margin-bottom: 20px !important;}"][nasa_title title_text="Best sellers, ooh la la" title_align="text-center" el_class="mobile-margin-bottom-20"][nasa_products type="best_selling" style="carousel" arrows="0" number="6" columns_number="5" columns_number_tablet="3"][/vc_column][/vc_row][vc_row el_class="margin-top-10 bg_f1f1f1 padding-top-35" css=".vc_custom_1698822535070{margin-bottom: 160px !important;}"][vc_column css=".vc_custom_1698822649190{margin-bottom: -50px !important;}" el_class="mobile-padding-bottom-40"][vc_column_text]
<h3 class="fs-25 tablet-fs-28 mobile-fs-27 margin-bottom-0" style="text-align: center;">@glasses</h3>
<p class="nasa-title-desc" style="text-align: center;">Follow us on social for the latest trends</p>
[/vc_column_text][nasa_instagram_feed username_show="NasaTheme Style" instagram_link="#" disp_type="slide" loop_slide="true" columns_number="6" columns_number_tablet="3" columns_number_small="3" el_class_img="padding-left-5 padding-right-5 skip-lazy" el_class="nasa-relative top-45"][/vc_column][/vc_row][vc_row el_class="margin-bottom-70"][vc_column][vc_column_text el_class="padding-top-10 mobile-padding-top-0"]
<p class="nasa-title-desc margin-bottom-0" style="text-align: center; line-height: 1;">WHAT BUYERS SAY</p>

<h3 class="fs-29 tablet-fs-28 mobile-fs-27 margin-bottom-0" style="text-align: center; line-height: 1;">Customers Review</h3>
[/vc_column_text][nasa_slider column_number="1" column_number_small="1" column_number_tablet="1"][nasa_client text_color="#0a0a0a" el_class="nasa-flex jc client-inner-padding-10px"]
<div class="nasa-flex jc flex-column">
<h3 class="text-center margin-bottom-0 margin-bottom-15" style="width: 80%;">"Given wherein. Does not called also and air sea to make first subdue beginning.
Appear seasons the it after whose beginning. Hath can not good life."</h3>
<p class="text-center nasa-title-desc margin-bottom-0" style="text-align: center;">Darrell Baker, 18 May 2019</p>

</div>
[/nasa_client][nasa_client text_color="#0a0a0a" el_class="nasa-flex jc client-inner-padding-10px"]
<div class="nasa-flex jc flex-column">
<h3 class="text-center margin-bottom-0 margin-bottom-15" style="width: 80%;">"Given wherein. Does not called also and air sea to make first subdue beginning.
Appear seasons the it after whose beginning. Hath can not good life."</h3>
&nbsp;
<p class="text-center nasa-title-desc margin-bottom-0" style="text-align: center;">Darrell Baker, 18 May 2019</p>

</div>
[/nasa_client][/nasa_slider][/vc_column][/vc_row]'
        ),
        
        'post_meta' => array(
            // '_nasa_header_block' => 'static-header-1',
            // '_nasa_el_class_header' => 'main-home-fix',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1698809756170{padding-top: 50px !important;padding-bottom: 50px !important;}.vc_custom_1698822535070{margin-bottom: 160px !important;}.vc_custom_1698312118227{margin-top: 20px !important;margin-bottom: 20px !important;}.vc_custom_1698822649190{margin-bottom: -50px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            'plus_wide_width' => '400',
            'color_primary' => '#d89701',
            
            // 'category_sidebar' => 'left',
            
            'product_detail_layout' => 'modern-2',
            'sp_bgl' => '#f4f4f4',
            // 'product_image_layout' => 'single',
            // 'product_image_style' => 'scroll',
            // 'tab_style_info' => 'ver-2',
            
            'loop_layout_buttons' => 'modern-5',
            
            // 'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            // 'nasa_attr_color_style' => 'round',
            // 'nasa_attr_label_style' => 'round',
            
            'breadcrumb_row' => 'single',
            'breadcrumb_type' => 'default',
            'breadcrumb_bg_color' => '#f4f4f4',
            'breadcrumb_align' => 'text-left',
            'breadcrumb_height' => '60'
        ),
    );
}
