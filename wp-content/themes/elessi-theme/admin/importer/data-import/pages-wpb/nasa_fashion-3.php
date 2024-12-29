<?php
function nasa_wpb_fashion_3() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2017/11/h2-dealoftheday-bg.jpg', '3100', array(
        'post_title' => 'h2-dealoftheday-bg',
        'post_name' => 'h2-dealoftheday-bg',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Fashion V3',
            'post_name' => 'wpb-fashion-v3',
            'post_content' => '[vc_row][vc_column][nasa_rev_slider alias="slider-03" alias_m="slider-03"][/vc_column][/vc_row][vc_row el_class="mobile-margin-bottom-15 margin-top-60 margin-bottom-50"][vc_column][nasa_title title_text="Trendy item" title_type="h3" font_size="xl" title_align="text-center"][vc_tta_tabs alignment="center"][vc_tta_section hr="1" title="ALL" tab_id="1509957049380-e38870ed-5797"][nasa_products style="carousel" style_row="2" shop_url="0" arrows="0" number="10" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="FEATURED" tab_id="1509680382542-1cd79545-bdae"][nasa_products type="featured_product" style="carousel" style_row="2" shop_url="0" arrows="0" number="10" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="BEST SELLING" tab_id="1509680382515-609c6f4d-fd0e"][nasa_products type="best_selling" style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="10" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="TOP RATED" tab_id="1509957137879-8aa83829-3ba3"][nasa_products type="top_rate" style="carousel" style_row="2" shop_url="0" arrows="0" number="10" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section hr="1" title="TRENDS" tab_id="1509771354416-4988be9f-2227"][nasa_products type="recent_review" style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="10" columns_number="4" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row fullwidth="1" el_class="padding-bottom-30"][vc_column][nasa_banner align="center" valign="middle" text-align="text-center" banner_responsive="no" effect_text="fadeInUp" img_src="' . $imgs_1 . '"]
<h3 class="margin-top-0 margin-bottom-40" style="font-weight: 800;">Deals of the day</h3>
[nasa_countdown date="2025-12-30" size="large"]
<a class="button nasa-button-banner margin-top-30" title="Shop now">SHOP NOW</a>[/nasa_banner][/vc_column][/vc_row][vc_row el_class="desktop-margin-top-20 tablet-margin-top-0"][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Top Rated" type="top_rate" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Best Selling" type="best_selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Featured" type="featured_product" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row][vc_row el_class="padding-top-15 padding-bottom-30 tablet-padding-top-20 mobile-padding-top-20"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row][vc_row][vc_column][vc_column_text]

[/vc_column_text][/vc_column][/vc_row]'
        ),
        
        'post_meta' => array(
            
        ),
        
        'globals' => array(
            'header-type' => '1',
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
