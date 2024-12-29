<?php
function nasa_wpb_jewelry() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2016/06/je-banner1.jpg', '3094', array(
        'post_title' => 'je-banner1',
        'post_name' => 'je-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2016/06/je-banner2.jpg', '3117', array(
        'post_title' => 'je-banner2',
        'post_name' => 'je-banner2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2016/06/je-banner3.jpg', '3115', array(
        'post_title' => 'je-banner3',
        'post_name' => 'je-banner3',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2019/09/je-banner45.jpg', '3115', array(
        'post_title' => 'je-banner45',
        'post_name' => 'je-banner45',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2016/06/je-banner5.jpg', '3100', array(
        'post_title' => 'je-banner5',
        'post_name' => 'je-banner5',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Jewelry',
            'post_name' => 'wpb-jewelry',
            'post_content' => '[vc_row fullwidth="1"][vc_column][nasa_rev_slider alias="slider-jewelry"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 margin-top-20"][vc_column width="1/2"][nasa_banner banner_responsive="no" effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_1 . '"]
    <h4 class="padding-bottom-10;" style="font-weight: 300;">Collections for
    Love That Rings True</h4>
    <p style="color: #a4a4a4; font-size: 15px;">From $199.00</p>
    <a class="button medium margin-top-20" style="color: #000000; font-weight: 300;" href="#">Discover now</a>[/nasa_banner][/vc_column][vc_column width="1/2"][vc_row_inner][vc_column_inner][nasa_banner align="right" text-align="text-right" banner_responsive="no" effect_text="fadeInRight" hover="zoom" img_src="' . $imgs_2 . '"]
    <h4 class="margin-top-10 margin-bottom-10" style="font-weight: 300;">Gift
    for her</h4>
    <p style="color: #a4a4a4; font-size: 15px;">from $99.00</p>
    [/nasa_banner][/vc_column_inner][/vc_row_inner][vc_row_inner][vc_column_inner width="1/2"][nasa_banner hover="zoom" img_src="' . $imgs_3 . '"][/nasa_banner][/vc_column_inner][vc_column_inner width="1/2"][nasa_banner hover="zoom" img_src="' . $imgs_4 . '"][/nasa_banner][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row][vc_column][nasa_title title_text="Featured Products" title_type="h3" font_size="l" title_align="text-center"][vc_tta_tabs alignment="center"][vc_tta_section title="ALL" tab_id="1566879815728-a242a12b-3cf2"][nasa_products number="12" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="BEST SELLER" tab_id="1566879815759-ec6017a4-1d5c"][nasa_products number="12" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="ON SALE" tab_id="1566879818820-4d7b620c-85eb"][nasa_products number="12" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="NEW ARRIVALS" tab_id="1566879820387-16fbe7b4-f3f8"][nasa_products number="12" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row fullwidth="1" el_class="margin-bottom-50 margin-top-80 mobile-margin-top-30"][vc_column][nasa_banner valign="middle" banner_responsive="no" effect_text="fadeInDown" img_src="' . $imgs_5 . '"]
    <h1 style="font-weight: 300;">Necklaces Collection</h1>
    <p style="font-size: 15px; margin-top: 10px; font-weight: 500;">Give you neckline something to boast about, from delicate chains to striking</p>
    pendants and dramatic link necklaces.
    <p style="font-weight: 500; font-size: 15px;">Discover Now</p>
    [/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-bottom-50"][vc_column][nasa_title title_text="Shop By Category" title_type="h3" font_size="l" title_desc="Visit our shop to see amazing creations from our desiginers" title_align="text-center" el_class="margin-bottom-20"][nasa_product_categories list_cats="necklaces-pendants, bracelets, earrings, rings, charms, brooches" number="5" disp_type="Horizontal6" margin_item="0" hide_empty="0" columns_number="5" columns_number_small="2" columns_number_tablet="3" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-top-30"][vc_column][nasa_title title_text="Our Instagram" title_type="h3" title_desc="The freshest and most exciting news" font_size="l" title_align="text-center" el_class="margin-bottom-50"][nasa_instagram_feed disp_type="zz" limit_items="5" columns_number="5" columns_number_tablet="5" columns_number_small="3"][/vc_column][/vc_row][vc_row el_class="padding-top-40 margin-bottom-50 tablet-padding-top-30 mobile-padding-top-0 mobile-margin-bottom-25"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#82d9d1',
            // '_nasa_type_font_select' => 'google',
            // '_nasa_type_headings' => 'Marcellus',
            // '_nasa_type_texts' => 'Marcellus',
            // '_nasa_type_nav' => 'Marcellus',
            // '_nasa_type_banner' => 'Marcellus',
            // '_nasa_type_price' => 'Marcellus',
            // '_nasa_font_weight' => '900',
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'fixed_nav' => '0',
            
            // 'plus_wide_width' => '200',
            'color_primary' => '#82d9d1',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'left',
            
            // 'product_detail_layout' => 'modern-3',
            'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            // 'tab_style_info' => '2d-no-border',
            
            'loop_layout_buttons' => 'modern-6',
            
            // 'animated_products' => 'hover-carousel',
            
            'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            // 'nasa_attr_color_style' => 'round',
            // 'nasa_attr_label_style' => 'round',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f6f6f6',
        ),
    );
}
