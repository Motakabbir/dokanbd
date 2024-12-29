<?php
function nasa_wpb_organic_1() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2019/01/organic-banner1.jpg', '3136', array(
        'post_title' => 'organic-banner1',
        'post_name' => 'organic-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2019/01/organic-banner2.jpg', '3136', array(
        'post_title' => 'organic-banner2',
        'post_name' => 'organic-banner2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2019/01/organic-banner3.jpg', '3136', array(
        'post_title' => 'organic-banner3',
        'post_name' => 'organic-banner3',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Organic V1',
            'post_name' => 'wpb-organic-v1',
            'post_content' => '[vc_row fullwidth="1"][vc_column][nasa_rev_slider alias="slider-organic"][/vc_column][/vc_row][vc_row el_class="desktop-margin-top-30"][vc_column width="1/4"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Free Shipping" service_icon="pe-7s-plane" service_desc="Free Shipping for all US order"][/vc_column][vc_column width="1/4"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Support 24/7" service_icon="pe-7s-headphones" service_desc="We support 24h a day"][/vc_column][vc_column width="1/4"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="100% Money Back" service_icon="pe-7s-refresh-2" service_desc="You have 30 days to Return"][/vc_column][vc_column width="1/4"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Payment Secure" service_icon="pe-7s-gift" service_desc="We ensure secure payment"][/vc_column][/vc_row][vc_row css=".vc_custom_1546577516415{background-color: #f9f9f9 !important;}" el_class="padding-top-50 padding-bottom-40 margin-top-50"][vc_column][nasa_title title_text="Top Categories" title_type="h3" font_size="l" title_align="text-center" el_class="margin-bottom-30"][nasa_product_categories list_cats="haircare-woman, makeup-woman, nails-woman, bracelets-woman, earrings-woman, necklaces-woman" margin_item="10" columns_number="6" columns_number_small="2" columns_number_tablet="4"][/vc_column][/vc_row][vc_row el_class="margin-top-80"][vc_column][nasa_products_special_deal limit="6" style="multi-2" arrows="1" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-top-60"][vc_column][nasa_title title_text="Featured Products" title_type="h3" font_size="xl" title_align="text-center" el_class="margin-bottom-10"][vc_tta_tabs alignment="center" el_class="nasa-tab-icon-organic"][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-raspberry" title="Fruits" tab_id="1546590196369-d6a77c70-0b5d"][nasa_products columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-parsley" title="Vegetables" tab_id="1546590296239-6e212219-7d50"][nasa_products columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-fast-food" title="Milk &amp; Cream" tab_id="1546590196398-8a773543-a493"][nasa_products columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-banana" title="Banana" tab_id="1546590276805-c430b606-27c2"][nasa_products columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-top-50"][vc_column width="1/3"][nasa_banner effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_1 . '"]
    <h3 class="nasa-bold-700" style="font-size: 160%; line-height: 1.2;">Joobie
    Ice Cream</h3>
    <h5 class="nasa-bold-700" style="font-size: 115%;">Sale Off <span style="color: #fc6b66;">25%</span></h5>
    <h5 style="font-size: 100%; line-height: 5;"><a title="Shop Now" href="#">Shop Now</a></h5>
    [/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_2 . '"]
    <h3 class="nasa-bold-700" style="font-size: 160%; line-height: 1.2;">Fresh
    Guava Juice</h3>
    <h5 style="font-size: 100%; line-height: 5;"><a title="Shop Now" href="#">Shop Now</a></h5>
    [/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_3 . '"]
    <h3 class="nasa-bold-700" style="font-size: 160%; line-height: 1.2;">Fresh
    Vegetables</h3>
    <h5 style="font-size: 100%; line-height: 5;"><a title="Shop Now" href="#">Shop Now</a></h5>
    [/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-top-50"][vc_column width="1/3"][nasa_products title_shortcode="Top Rated" type="top_rate" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="Best Selling" type="best_selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="On Sale" type="on_sale" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][/vc_row][vc_row el_class="padding-top-20 margin-bottom-50"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '4',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#6bad0d',
            '_nasa_vertical_menu_allways_show' => 'on',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1546577516415{background-color: #f9f9f9 !important;}'
        ),
        
        'globals' => array(
            'header-type' => '4',
            
            'fixed_nav' => '0',
            
            // 'plus_wide_width' => '200',
            'color_primary' => '#6bad0d',
            
            // 'bg_color_topbar' => '28aeb1',
            // 'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
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
