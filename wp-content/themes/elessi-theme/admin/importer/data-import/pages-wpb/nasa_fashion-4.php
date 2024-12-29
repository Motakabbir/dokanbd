<?php
function nasa_wpb_fashion_4() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/03/h4-banner1.jpg', '3103', array(
        'post_title' => 'h4-banner1',
        'post_name' => 'h4-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2018/03/h4-banner22.jpg', '3103', array(
        'post_title' => 'h4-banner22',
        'post_name' => 'h4-banner22',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2018/03/h4-banner3.jpg', '3103', array(
        'post_title' => 'h4-banner3',
        'post_name' => 'h4-banner3',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Fashion V4',
            'post_name' => 'wpb-fashion-v4',
            'post_content' => '[vc_row el_class="desktop-margin-top-40"][vc_column width="1/4" el_class="rtl-column-left"][nasa_menu_vertical menu="vertical-menu" title="Shop by Categories"][/vc_column][vc_column width="3/4"][nasa_rev_slider alias="slider-04-1"][vc_row_inner css=".vc_custom_1520266283553{margin-top: 20px !important;}"][vc_column_inner width="1/3"][nasa_banner_2 valign="middle" effect_text="flipInX" data_delay="400ms" img_src="' . $imgs_1 . '"]
    <h6 class="fs-18 tablet-fs-16 mobile-fs-22">Mini backpack</h6>
    <h6 class="fs-15 tablet-fs-13 mobile-fs-18" style="color: #999;">Bags &amp; Accessories</h6>
    [/nasa_banner_2][/vc_column_inner][vc_column_inner width="1/3"][nasa_banner_2 valign="middle" effect_text="flipInX" data_delay="400ms" img_src="' . $imgs_2 . '"]
    <h6 class="fs-18 tablet-fs-16 mobile-fs-22">New handbag</h6>
    <h6 class="fs-15 tablet-fs-13 mobile-fs-18" style="color: #999;">Enjoy this fall trend</h6>
    [/nasa_banner_2][/vc_column_inner][vc_column_inner width="1/3"][nasa_banner_2 valign="middle" effect_text="flipInX" data_delay="400ms" img_src="' . $imgs_3 . '"]
    <h6 class="fs-18 tablet-fs-16 mobile-fs-22">New bag</h6>
    <h6 class="fs-15 tablet-fs-13 mobile-fs-18" style="color: #999;">Sale off 50%</h6>
    [/nasa_banner_2][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_class="home_box_wrap desktop-margin-top-30"][vc_column width="1/5"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="FREE SHIPPING" service_icon="pe-7s-plane" service_desc="Free Shipping for all US order"][/vc_column][vc_column width="1/5"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="SUPPORT 24/7" service_icon="pe-7s-headphones" service_desc="We support 24h a day"][/vc_column][vc_column width="1/5"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="MONEY BACK" service_icon="pe-7s-refresh-2" service_desc="You have 30 days to Return"][/vc_column][vc_column width="1/5"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="PAYMENT SECURE" service_icon="pe-7s-gift" service_desc="We ensure secure payment"][/vc_column][vc_column width="1/5" el_class="home_box_last"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="DISCOUNT" service_icon="pe-7s-piggy" service_desc="Up to 40% for member"][/vc_column][/vc_row][vc_row el_class="desktop-margin-top-50"][vc_column][nasa_title title_text="Trendy item" title_type="h3" font_size="xl" title_align="text-center"][/vc_column][/vc_row][vc_row][vc_column][vc_tta_tabs alignment="center"][vc_tta_section hr="" title="ALL" tab_id="1520441632519-782de787-dc04"][nasa_products style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="16" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="" title="FEATURED" tab_id="1520441632533-82e45113-2b73"][nasa_products type="featured_product" style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="16" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="" title="BEST SELLING" tab_id="1520441679136-8716a65c-fbc3"][nasa_products type="best_selling" style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="16" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="" title="TOP RATE" tab_id="1520441697799-0cc7579d-a42d"][nasa_products type="top_rate" style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="16" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="" title="TRENDS" tab_id="1520441716985-619d060e-47c6"][nasa_products type="recent_review" style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="16" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row fullwidth="1"][vc_column][nasa_pin_products_banner pin_slug="pin-products-home-4" bg_icon="#ffffff" txt_color="#333333"][/vc_column][/vc_row][vc_row el_class="desktop-margin-top-80 mobile-margin-top-40"][vc_column width="1/3"][nasa_products title_shortcode="Top Rated" type="top_rate" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="Best Selling" type="best_selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="Recent" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][/vc_row][vc_row fullwidth="1" el_class="padding-top-60"][vc_column][nasa_title title_text="Follow us on Instagram" title_type="h3" font_size="xl" title_align="text-center" el_class="desktop-margin-bottom-20"][nasa_instagram_feed username_show="Elessi Style" instagram_link="#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '2',
            // '_nasa_bg_color_topbar' => '#f16564',
            // '_nasa_bg_color_main_menu' => '#ffffff',
            // '_nasa_text_color_hover_topbar' => '#efefef',
            // '_nasa_text_color_main_menu' => '#555555',
            // '_nasa_text_color_topbar' => '#ffffff',
            '_nasa_el_class_header' => 'menu-header-margin-top-0',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1520266283553{margin-top: 20px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '2',
            
            'fixed_nav' => '0',
            
            'bg_color_topbar' => '#f16564',
            'text_color_topbar' => '#ffffff',
            'text_color_hover_topbar' => '#efefef',
            
            'bg_color_main_menu' => '#ffffff',
            'text_color_main_menu' => '#555555',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
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
