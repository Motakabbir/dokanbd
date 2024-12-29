<?php
function nasa_wpb_auto_parts_2() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2021/10/Online-Motor-Sales-Marketplace.jpeg', '0', array(
        'post_title' => 'Online-Motor-Sales-Marketplace',
        'post_name' => 'online-motor-sales-marketplace',
    ));
    $imgs_1_src = $imgs_1 ? wp_get_attachment_image_url($imgs_1, 'full') : 'https://via.placeholder.com/1920x700';
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2021/10/h5-banner1.jpg', '3117', array(
        'post_title' => 'atp2-banner1',
        'post_name' => 'atp2-banner1',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2021/10/h5-banner2.jpg', '3117', array(
        'post_title' => 'atp2-banner2',
        'post_name' => 'atp2-banner2',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2021/10/h5-banner4.jpeg', '3319', array(
        'post_title' => 'atp2-banner3',
        'post_name' => 'atp2-banner3',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Auto Parts V2',
            'post_name' => 'wpb-auto-parts-v2',
            'post_content' => '[vc_row el_class="margin-bottom-20 nasa-crazy-box" css=".vc_custom_1634028816822{background-image: url(' . $imgs_1_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column parallax="content-moving" el_class="desktop-padding-top-100 desktop-padding-bottom-150 mobile-padding-top-50 mobile-padding-bottom-50 desktop-padding-left-100 desktop-padding-right-100"][vc_column_text]
<h3 class="text-center nasa-ignore-margin nasa-leading" style="color: #fff;"><span style="font-weight: 100;">Select Your</span> Vehicle</h3>
<h6 class="text-center margin-bottom-40 margin-top-0" style="font-weight: 400 !important; color: #fff; letter-spacing: 3px;">OVER 100.000 AUTO AND TRUCK PARTS</h6>
[/vc_column_text][nasa_product_nasa_categories count_items="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row][vc_row el_class="margin-bottom-20"][vc_column width="1/2"][nasa_banner valign="middle" hover="zoom" img_src="' . $imgs_2 . '"]
<h4 style="font-weight: 200 !important;">Moteri racing</h4>
<h4 style="font-weight: 200 !important;">Rally <b>Gold Custom</b></h4>
<h6 style="margin-top: 20px; font-weight: 200 !important;">Just Only <b style="color: #539309; font-size: 180%;">  $120.00</b></h6>
<a class="button margin-top-30" style="font-size: 12px; border-radius: 5px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner][/vc_column][vc_column width="1/2"][nasa_banner valign="middle" hover="zoom" img_src="' . $imgs_3 . '"]
<h4>Auto Repair</h4>
<h4>System <span style="font-weight: 200;">Accessories</span></h4>
<h6 style="margin-top: 20px; font-weight: 200 !important;">Discount <b style="color: #ff0000; font-size: 180%;">  25% Off</b></h6>
<a class="button margin-top-30" style="font-size: 12px; border-radius: 5px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-bottom-35"][vc_column][vc_tta_tabs alignment="right" tabs_display_type="2d-has-bg" tabs_bg_color="" title="What we offer" el_class="letter-spacing-none"][vc_tta_section title="New Arrival" tab_id="1557566365886-e30e3479-8dde"][nasa_products style="infinite" style_viewmore="2" number="10" columns_number="5" columns_number_tablet="3" el_class="padding-top-5"][/vc_tta_section][vc_tta_section title="Featured" tab_id="1557566642338-a1102b84-8b1a"][nasa_products type="featured_product" style="infinite" style_viewmore="2" number="10" columns_number="5" columns_number_tablet="3" el_class="padding-top-5"][/vc_tta_section][vc_tta_section title="Popular" tab_id="1557566641289-47c8444f-5192"][nasa_products type="top_rate" style="infinite" style_viewmore="2" pos_nav="left" number="10" columns_number="5" columns_number_tablet="3" el_class="padding-top-5"][/vc_tta_section][vc_tta_section title="On Sale" tab_id="1557566640920-0afb96af-7762"][nasa_products type="on_sale" style="infinite" style_viewmore="2" pos_nav="left" number="10" columns_number="5" columns_number_tablet="3" el_class="padding-top-5"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-40"][vc_column][nasa_banner align="right" valign="middle" text-align="text-center" banner_responsive="no" effect_text="flipInX" img_src="' . $imgs_4 . '" el_class="mobile-align-center"]
<h6 style="color: #0062bd; margin-bottom: 20px; font-size: 115%;">Special Offer</h6>
<h4 class="font-200-per">SHELL MOTOR OILS</h4>
<h5 style="font-weight: 300 !important;">Discount up to <b style="color: #67981a;">30% </b> Off</h5>
<a class="button margin-top-20" style="border-radius: 5px;" title="Shop now" href="#">Start Buying</a>[/nasa_banner][/vc_column][/vc_row][vc_row parallax="content-moving" el_class="margin-bottom-30"][vc_column][nasa_products_special_deal limit="6" style="multi-2" arrows="1" auto_slide="false" category_product="auto-accessories-bags" el_class="hide-stars"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 mobile-margin-bottom-20"][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Featured" type="featured_product" style="list_carousel" style_row="3" pos_nav="left" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-30"][nasa_products title_shortcode="Best Selling" type="best_selling" style="list_carousel" style_row="3" pos_nav="left" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-30"][nasa_products title_shortcode="Best Selling" type="On Sale" style="list_carousel" style_row="3" pos_nav="left" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 mobile-margin-bottom-0"][vc_column width="1/4" offset="vc_col-xs-12" el_class="mobile-margin-bottom-30"][nasa_service_box service_hover="buzz_effect" service_title="Free Delivery" service_desc="Free Shipping for all Order" service_icon="icon-nasa-car-2"][/vc_column][vc_column width="1/4" offset="vc_col-xs-12" el_class="mobile-margin-bottom-30"][nasa_service_box service_hover="buzz_effect" service_title="Support 24/7" service_desc="We support 24h a day" service_icon="icon-nasa-headphone"][/vc_column][vc_column width="1/4" offset="vc_col-xs-12" el_class="mobile-margin-bottom-30"][nasa_service_box service_hover="buzz_effect" service_title="100% Money Back" service_desc="You have 30 days to Return" service_icon="icon-nasa-refresh"][/vc_column][vc_column width="1/4" offset="vc_col-xs-12" el_class="mobile-margin-bottom-30"][nasa_service_box service_hover="buzz_effect" service_title="Payment Secure" service_desc="We ensure secure payment" service_icon="icon-nasa-credit"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '4',
            // '_nasa_plus_wide_option' => '1',
            // '_nasa_plus_wide_width' => '100',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#dd3333',
            // '_nasa_bg_color_main_menu' => '#f6f6f6',
            // '_nasa_type_font_select' => 'google',
            // '_nasa_type_headings' => 'Rubik',
            // '_nasa_type_texts' => 'Rubik',
            // '_nasa_type_nav' => 'Rubik',
            // '_nasa_type_banner' => 'Rubik',
            // '_nasa_type_price' => 'Rubik',
            // '_nasa_font_weight' => '500',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1634028816822{background-image: url(' . $imgs_1_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}'
        ),
        
        'globals' => array(
            'header-type' => '4',
            
            'fixed_nav' => '0',
            
            'plus_wide_width' => '100',
            'color_primary' => '#dd3333',
            
            // 'fullwidth_main_menu' => '1',
            
            'bg_color_main_menu' => '#f6f6f6',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#539309',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            'category_sidebar' => 'top-2',
            
            'nasa_attr_label_style' => 'small-square-2',
            
            'product_detail_layout' => 'modern-1',
            // 'tab_style_info' => 'scroll-down',
            
            'loop_layout_buttons' => 'modern-3',
            
            // 'animated_products' => 'hover-fade',
            
            // 'nasa_attr_image_style' => 'square'
            
            'breadcrumb_row' => 'single',
            'breadcrumb_align' => 'text-left',
            'breadcrumb_height' => '60',
        ),
    );
}
