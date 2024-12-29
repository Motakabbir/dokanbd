<?php
function nasa_wpb_fashion_2() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/03/h1-banner1.jpg', '3094', array(
        'post_title' => 'h1-banner1',
        'post_name' => 'h1-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2018/05/h2-banner-white.jpg', '3095', array(
        'post_title' => 'h2-banner-white',
        'post_name' => 'h2-banner-white',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2018/03/h1-banner2.jpg', '3095', array(
        'post_title' => 'h1-banner2',
        'post_name' => 'h1-banner2',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2018/03/h1-banner3.jpg', '3096', array(
        'post_title' => 'h1-banner3',
        'post_name' => 'h1-banner3',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2018/03/h1-deal-bg.jpg', '0', array(
        'post_title' => 'h1-deal-bg',
        'post_name' => 'h1-deal-bg',
    ));
    $imgs_5_src = $imgs_5 ? wp_get_attachment_image_url($imgs_5, 'full') : 'https://via.placeholder.com/1920x853';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Fashion V2',
            'post_name' => 'wpb-fashion-v2',
            'post_content' => '[vc_row fullwidth="1" el_class="desktop-margin-bottom-20 mobile-margin-bottom-20"][vc_column][nasa_rev_slider alias="slider-02-1"][/vc_column][/vc_row][vc_row el_class="margin-top-10"][vc_column width="1/2" el_class="desktop-padding-right-5"][nasa_banner effect_text="fadeInLeft" hover="zoom" data_delay="300ms" img_src="' . $imgs_1 . '"]
    <h4 style="color: #333;">Bag Collection</h4>
    <h5 style="color: #999;">Sale off 50%</h5>
    [/nasa_banner][/vc_column][vc_column width="1/2" el_class="desktop-padding-left-5"][vc_row_inner css=".vc_custom_1509780350467{margin-bottom: 10px !important;}"][vc_column_inner el_class="desktop-padding-right-5" width="1/2"][nasa_banner align="center" valign="middle" text-align="text-center" hover="zoom" border_outner="yes" img_src="' . $imgs_2 . '" el_class="margin-bottom-0"]
<h6 class="tablet-fs-15 mobile-fs-15" style="letter-spacing: 10px; color: #9c9c9c;">ELESSI</h6>
<h3 class="tablet-fs-30 mobile-fs-30">Summer
Lookbook</h3>
[/nasa_banner][/vc_column_inner][vc_column_inner el_class="desktop-padding-left-5 mobile-margin-top-10" width="1/2"][nasa_banner height="260px" hover="zoom" img_src="' . $imgs_3 . '" el_class="margin-bottom-0"][/nasa_banner][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="margin-top-5"][vc_column_inner][nasa_banner height="268" width="590" effect_text="flipInX" hover="zoom" img_src="' . $imgs_4 . '"]
    <h4 style="color: #333;">Mini backpack</h4>
    <h5 style="color: #999;">Bags &amp; Accessories</h5>
    [/nasa_banner][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1509772778240{margin-top: 50px !important;margin-bottom: 50px !important;}"][vc_column][nasa_title title_text="Trendy item" title_type="h3" font_size="xl" title_align="text-center"][vc_tta_tabs alignment="center"][vc_tta_section hr="1" title="ALL" tab_id="1509680382542-1cd79545-bdae"][nasa_products type="recent_product" style="grid" style_row="2" shop_url="0" arrows="0" number="8" columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="1" title="WOMAN" tab_id="1509680382515-609c6f4d-fd0e"][nasa_products type="recent_product" style="grid" style_row="2" shop_url="0" arrows="0" number="8" columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="1" title="MAN" tab_id="1509771354416-4988be9f-2227"][nasa_products type="recent_product" style="grid" style_row="2" shop_url="0" arrows="0" number="8" columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="1" title="ON SALE" tab_id="1509957049380-e38870ed-5797"][nasa_products type="on_sale" style="grid" style_row="2" shop_url="0" arrows="0" number="8" columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="1" title="NEW" tab_id="1509957137879-8aa83829-3ba3"][nasa_products style="grid" style_row="2" shop_url="0" arrows="0" number="8" columns_number="4" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row parallax_speed="0.1" css=".vc_custom_1551100262069{margin-bottom: 170px !important;background-image: url(' . $imgs_5_src . ') !important;}"][vc_column][nasa_products_special_deal style="multi" arrows="1" auto_slide="false" el_class="nasa-relative top-100"][/vc_column][/vc_row][vc_row css=".vc_custom_1520494481735{border-radius: 1px !important;}" el_class="margin-top-80"][vc_column][nasa_title title_text="Latest blog" title_type="h3" font_size="xl" title_desc="The freshest and most exciting news" title_align="text-center" el_class="margin-bottom-30"][nasa_post auto_slide="true" dots="true" arrows="0" posts="5" columns_number="3" columns_number_small="1" columns_number_tablet="2" date_enable="no" author_enable="no" page_blogs="no"][/vc_column][/vc_row][vc_row fullwidth="1" el_class="padding-top-30"][vc_column][nasa_title title_text="Follow us on Instagram" title_type="h3" font_size="xl" title_align="text-center" el_class="desktop-margin-bottom-20"][nasa_instagram_feed username_show="Elessi Style" instagram_link="#" columns_number="6" columns_number_tablet="3" columns_number_small="3"][/vc_column][/vc_row][vc_row css=".vc_custom_1518594118728{margin-bottom: 50px !important;padding-top: 30px !important;}"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        
        'post_meta' => array(
            // '_nasa_custom_header' => '1',
            '_nasa_header_transparent' => '1',
            // '_nasa_topbar_default_show' => '2',
            // '_nasa_topbar_toggle' => '1',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1509772778240{margin-top: 50px !important;margin-bottom: 50px !important;}.vc_custom_1551100262069{margin-bottom: 170px !important;background-image: url(' . $imgs_5_src . ') !important;}.vc_custom_1520494481735{border-radius: 1px !important;}.vc_custom_1518594118728{margin-bottom: 50px !important;padding-top: 30px !important;}.vc_custom_1509780350467{margin-bottom: 10px !important;}'
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
        )
    );
}
