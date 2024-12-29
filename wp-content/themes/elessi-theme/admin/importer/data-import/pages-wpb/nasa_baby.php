<?php
function nasa_wpb_baby() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/11/baby-banner-1.jpg', '3094', array(
        'post_title' => 'baby-banner-1',
        'post_name' => 'baby-banner-1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2018/11/baby-banner-2.jpg', '3115', array(
        'post_title' => 'baby-banner-2',
        'post_name' => 'baby-banner-2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2018/11/baby-banner-3.jpg', '3115', array(
        'post_title' => 'baby-banner-3',
        'post_name' => 'baby-banner-3',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2018/11/baby-banner-4.jpg', '3117', array(
        'post_title' => 'baby-banner-4',
        'post_name' => 'baby-banner-4',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2018/11/baby-blog-bg.jpg', '0', array(
        'post_title' => 'baby-blog-bg',
        'post_name' => 'baby-blog-bg',
    ));
    $imgs_5_src = $imgs_5 ? wp_get_attachment_image_url($imgs_5, 'full') : 'https://via.placeholder.com/1920x945';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Baby',
            'post_name' => 'wpb-baby',
            'post_content' => '[vc_row fullwidth="1"][vc_column][nasa_rev_slider alias="slider-baby"][/vc_column][/vc_row][vc_row el_class="margin-top-20"][vc_column width="1/2"][nasa_banner align="right" move_x="10" valign="bottom" text-align="text-right" hover="fade" img_src="' . $imgs_1 . '"]
    <div><strong style="font-size: 200%; font-weight: 900; display: block; line-height: 1.7; color: #3ab3e8;">Family Outfits</strong><strong style="font-weight: 900; font-size: 130%;">Sale Off 50%</strong></div>
    [/nasa_banner][/vc_column][vc_column width="1/2"][vc_row_inner][vc_column_inner el_class="mobile-margin-top-20" width="1/2"][nasa_banner hover="zoom" border_outner="yes" img_src="' . $imgs_2 . '"][/nasa_banner][/vc_column_inner][vc_column_inner el_class="mobile-margin-top-20" width="1/2"][nasa_banner hover="zoom" img_src="' . $imgs_3 . '"][/nasa_banner][/vc_column_inner][/vc_row_inner][nasa_banner move_x="10" valign="middle" hover="fade" img_src="' . $imgs_4 . '"]
    <div><strong style="font-size: 200%; font-weight: 900; display: block; line-height: 1.7; color: #f06091;">Cute Babies</strong><strong style="font-weight: 900; font-size: 130%;">New Collection</strong></div>
    [/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-top-60"][vc_column][nasa_title title_text="Shop By Categories" title_type="h3" font_size="xl" title_hr="baby" title_align="text-center" el_class="margin-bottom-40"][nasa_product_categories list_cats="haircare-woman, makeup-woman, nails-woman, bracelets-woman, earrings-woman, necklaces-woman" columns_number="6" columns_number_small="2" columns_number_tablet="3" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-top-80"][vc_column][nasa_title title_text="Trendy Items" title_type="h3" font_size="xl" title_hr="baby" title_align="text-center" el_class="margin-bottom-20"][vc_tta_tabs alignment="center"][vc_tta_section hr="1" title="ALL" tab_id="1509680382542-1cd79545-bdae"][nasa_products type="featured_product" style="carousel" style_row="2" shop_url="0" arrows="0" number="12" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="1" title="WOMAN" tab_id="1509680382515-609c6f4d-fd0e"][nasa_products type="featured_product" style="carousel" style_row="2" shop_url="0" arrows="0" auto_slide="true" number="10" columns_number="4" columns_number_small="1" columns_number_tablet="2" cat="woman"][/vc_tta_section][vc_tta_section hr="1" title="MAN" tab_id="1509771354416-4988be9f-2227"][nasa_products style="carousel" style_row="2" shop_url="0" arrows="0" number="10" columns_number="4" columns_number_small="1" columns_number_tablet="2" cat="men"][/vc_tta_section][vc_tta_section hr="1" title="ON SALE" tab_id="1509957049380-e38870ed-5797"][nasa_products type="on_sale" style="carousel" style_row="2" shop_url="0" arrows="0" number="12" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="1" title="NEW" tab_id="1509957137879-8aa83829-3ba3"][nasa_products style="carousel" style_row="2" shop_url="0" arrows="0" number="12" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row css=".vc_custom_1542957169065{border-radius: 1px !important;}" el_class="margin-top-40 margin-bottom-40"][vc_column][nasa_title title_text="Latest blogs" title_type="h3" font_size="xl" title_bg="" title_hr="baby" title_align="text-center"][/vc_column][/vc_row][vc_row css=".vc_custom_1571650371288{background-image: url(' . $imgs_5_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 1px !important;}" el_class="desktop-padding-top-80 desktop-padding-bottom-80"][vc_column][nasa_post show_type="grid_2" posts="4" columns_number="2" columns_number_small="1" columns_number_tablet="1" page_blogs="no"][/vc_column][/vc_row][vc_row fullwidth="1" el_class="padding-top-30 margin-top-40"][vc_column][nasa_title title_text="Elessi Lifes" title_type="h3" font_size="xl" title_hr="baby" title_align="text-center" el_class="desktop-margin-bottom-40"][nasa_instagram_feed username_show="Street Style" instagram_link="#"][/vc_column][/vc_row][vc_row el_class="margin-top-60 margin-bottom-60"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '1',
            '_nasa_el_class_header' => 'nasa-top-bar-baby',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#3bb5e8',
            // '_nasa_type_font_select' => 'google',
            // '_nasa_type_headings' => 'Dosis',
            // '_nasa_type_texts' => 'Dosis',
            // '_nasa_type_nav' => 'Dosis',
            // '_nasa_type_banner' => 'Dosis',
            // '_nasa_type_price' => 'Dosis',
            // '_nasa_font_weight' => '900',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1542957169065{border-radius: 1px !important;}.vc_custom_1571650371288{background-image: url(' . $imgs_5_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;border-radius: 1px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'plus_wide_width' => '100',
            'color_primary' => '#3bb5e8',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'top-2',
            
            // 'nasa_attr_label_style' => 'small-square-2',
            
            // 'product_detail_layout' => 'modern-3',
            'product_image_layout' => 'single',
            // 'sp_bgl' => '#fafafa',
            'tab_style_info' => 'ver-2',
            
            'loop_layout_buttons' => 'modern-5',
            
            'animated_products' => 'hover-flip',
            
            // 'nasa_attr_image_style' => 'square'
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f6f6f6',
        ),
    );
}
