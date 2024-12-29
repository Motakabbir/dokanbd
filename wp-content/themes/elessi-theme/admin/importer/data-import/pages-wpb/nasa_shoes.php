<?php
function nasa_wpb_shoes() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/06/h9-banner-1.jpg', '3139', array(
        'post_title' => 'h9-banner-1',
        'post_name' => 'h9-banner-1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2018/06/h9-banner-3.jpg', '3139', array(
        'post_title' => 'h9-banner-3',
        'post_name' => 'h9-banner-3',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2018/06/h9-banner-2.jpg', '3139', array(
        'post_title' => 'h9-banner-2',
        'post_name' => 'h9-banner-2',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Shoes',
            'post_name' => 'wpb-shoes',
            'post_content' => '[vc_row fullwidth="1" css=".vc_custom_1528394118934{margin-top: 50px !important;margin-bottom: 50px !important;}" el_class="padding-bottom-40"][vc_column][nasa_products style="slide_slick" shop_url="0" arrows="0" auto_slide="true" number="4" columns_number="1"][/vc_column][/vc_row][vc_row el_class="margin-top-40"][vc_column width="1/3"][nasa_banner valign="bottom" effect_text="fadeInLeft" hover="zoom" data_delay="500ms" img_src="' . $imgs_1 . '"]
    <h5 style="font-weight: bold;">New
    season 2018</h5>
    <h6 style="color: #999; font-size: 120%;">Shoes &amp; Accessories</h6>
    [/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner effect_text="fadeInLeft" hover="zoom" data_delay="500ms" img_src="' . $imgs_2 . '"]
    <h5 style="font-weight: bold;">Classic Colections</h5>
    <h6 style="color: #999; font-size: 120%;">Sale off 50%</h6>
    [/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner valign="middle" effect_text="fadeInLeft" hover="zoom" data_delay="500ms" img_src="' . $imgs_3 . '"]
    <h5 style="font-weight: bold; color: #fff;">Spring
    Arrivals</h5>
    <h6 style="color: #fff; font-size: 120%;">Shoes Conlections</h6>
    [/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-top-60"][vc_column][nasa_title title_text="Trendy Item" title_type="h3" font_size="xl" title_align="text-center"][/vc_column][/vc_row][vc_row][vc_column][vc_tta_tabs alignment="center"][vc_tta_section title="ALL" tab_id="1522470900973-d871a7d2-56c6"][nasa_products number="10" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="FEATURED" tab_id="1522470900986-ff82e869-052c"][nasa_products type="featured_product" number="10" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="BEST SELLING" tab_id="1522470934792-a4cb37a0-7758"][nasa_products type="best_selling" number="10" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="TOP RATED" tab_id="1522470952512-42e6b5ad-abce"][nasa_products type="top_rate" number="108" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="TRENDS" tab_id="1522470969867-e41eb93a-e70e"][nasa_products type="recent_review" number="10" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-top-20"][vc_column width="5/12" el_class="margin-top-30 padding-top-100 padding-bottom-40 desktop-padding-left-150"][nasa_separator_link title_text="Pink Platform Sneakers" link_text="#" title_type="h1" title_hr="none"][vc_column_text]
    <div class="margin-top-20 margin-bottom-40" style="font-size: 200%;">$29 <del style="font-size: 90%;">$39</del></div>
    [/vc_column_text][nasa_countdown date="2025-12-30" align="left"][vc_column_text]<a class="button nasa-button-banner margin-top-50" title="Shop now" href="#">SHOP NOW</a>[/vc_column_text][/vc_column][vc_column width="7/12"][nasa_pin_products_banner pin_slug="pin-products-home-9"][/vc_column][/vc_row][vc_row el_class="margin-top-60"][vc_column][nasa_title title_text="Latest blog" title_type="h3" font_size="xl" title_desc="The freshest and most exciting news" title_align="text-center" el_class="margin-bottom-30"][nasa_post arrows="0" posts="6" columns_number="4" columns_number_small="1" columns_number_tablet="2" date_enable="no" author_enable="no" page_blogs="no"][/vc_column][/vc_row][vc_row css=".vc_custom_1518594118728{margin-bottom: 50px !important;padding-top: 30px !important;}"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '1',
            // '_nasa_plus_wide_option' => '1',
            // '_nasa_plus_wide_width' => '400',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1528394118934{margin-top: 50px !important;margin-bottom: 50px !important;}.vc_custom_1518594118728{margin-bottom: 50px !important;padding-top: 30px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'fixed_nav' => '0',
            
            'plus_wide_width' => '400',
            // 'color_primary' => '#d69200',
            
            // 'bg_color_topbar' => '28aeb1',
            // 'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'v_root' => '1',
            // 'v_root_limit' => '10',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            'category_sidebar' => 'top-2',
            
            'product_detail_layout' => 'full',
            'full_info_col' => '2',
            // 'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            // 'tab_style_info' => 'scroll-down',
            
            // 'single_product_thumbs_style' => 'hoz',
            
            // 'loop_layout_buttons' => 'modern-5',
            
            // 'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            'nasa_attr_color_style' => 'round',
            'nasa_attr_label_style' => 'small-square-1',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f8f8f8',
            // 'breadcrumb_align' => 'text-left',
            // 'breadcrumb_height' => '60',
        ),
    );
}
