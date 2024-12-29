<?php
function nasa_wpb_face_mask() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2020/05/face_mask_banner_1.jpg', '3136', array(
        'post_title' => 'face_mask_banner_1',
        'post_name' => 'face_mask_banner_1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2020/05/face_mask_banner_2.jpg', '3136', array(
        'post_title' => 'face_mask_banner_2',
        'post_name' => 'face_mask_banner_2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2020/05/face_mask_banner_3.jpg', '3136', array(
        'post_title' => 'face_mask_banner_3',
        'post_name' => 'face_mask_banner_3',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Face Mask',
            'post_name' => 'wpb-face-mask',
            'post_content' => '[vc_row fullwidth="1" el_class="margin-bottom-70"][vc_column][nasa_rev_slider alias="slider-face-mask"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column][nasa_slider align="center" column_number="1" column_number_small="1" column_number_tablet="1"][vc_column_text]
    <h1 class="text-center" style="font-weight: 800;">"Cubilia a nisi blandit sem cras nec
    temport adipiscing rku ullamcorper ligula."</h1>
    <p class="text-center"><span style="font-weight: 900; color: #000; letter-spacing: 3px;">JOHN DOE</span> / CEO Elessi</p>
    [/vc_column_text][vc_column_text]
    <h1 class="text-center" style="font-weight: 800;">"Cubilia a nisi blandit sem cras nec
    temport adipiscing rku ullamcorper ligula."</h1>
    <p class="text-center"><span style="font-weight: 900; color: #000; letter-spacing: 3px;">JOHN DOE</span> / CEO Elessi</p>
    [/vc_column_text][/nasa_slider][/vc_column][/vc_row][vc_row css=".vc_custom_1588665742891{background-color: #f9f9f9 !important;}" el_class="padding-top-50 padding-bottom-40 margin-top-50 margin-bottom-50"][vc_column][nasa_title title_text="Top Categories" title_type="h3" font_size="xl" title_align="text-center" el_class="margin-bottom-30"][nasa_product_categories list_cats="haircare-woman, makeup-woman, nails-woman, bracelets-woman, earrings-woman, necklaces-woman" columns_number="6" columns_number_small="2" columns_number_tablet="3" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column][nasa_title title_text="Recommend for you" title_type="h3" font_size="xl" title_align="text-center"][vc_tta_tabs alignment="center" tabs_display_type="2d-radius"][vc_tta_section title="ALL" tab_id="1588650447372-edc101f8-611b"][nasa_products style="infinite" style_viewmore="3" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="CLOTH" tab_id="1588650447423-b4b2190d-2c6a"][nasa_products columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="MEDICAL" tab_id="1588650450285-6ded35ef-f31e"][nasa_products columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="PREMIUM" tab_id="1588650451399-7d1c69de-390d"][nasa_products columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row fullwidth="1" el_class="margin-bottom-10"][vc_column][nasa_products title_shortcode="Featured Face Mask" style="slide_slick" shop_url="0" arrows="1" number="4" columns_number="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 margin-top-50"][vc_column width="1/3"][nasa_banner text_color="dark" img_src="' . $imgs_1 . '"]
    <h5 style="font-size: 180%;">Face mask
    with rose pattern</h5>
    <span style="font-size: 110%; margin-top: 15px; font-weight: bold; color: #fff;">Sale off 25%</span>
    <a class="margin-top-30" style="text-decoration: underline; color: #fff; display: block; font-size: 90%;" href="#">Shop Now</a>[/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner img_src="' . $imgs_2 . '"]
    <h5 style="font-size: 180%;">Face mask
    with cute pattern</h5>
    <a class="margin-top-10" style="text-decoration: underline; color: #323232; display: block;" href="#">Shop Now</a>[/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner img_src="' . $imgs_3 . '"]
    <h5 style="font-size: 180%;">Cloth
    Face mask</h5>
    <a class="margin-top-10" style="text-decoration: underline; color: #323232; display: block;" href="#">Shop Now</a>[/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_title title_text="Top Rated" title_type="h3" font_size="m" el_class="margin-bottom-30"][nasa_products title_shortcode="Top Rated" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="Best Selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_products title_shortcode="On Sale" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column][nasa_title title_text="Latest blog" title_type="h3" font_size="xl" title_desc="The freshest and most exciting news" title_align="text-center" el_class="margin-bottom-30"][nasa_post dots="true" arrows="0" posts="4" columns_number="3" columns_number_small="1" columns_number_tablet="3" date_enable="no" author_enable="no" page_blogs="no"][/vc_column][/vc_row]'
        ),
        
        'post_meta' => array(
            '_wpb_shortcodes_custom_css' => '.vc_custom_1588665742891{background-color: #f9f9f9 !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'fixed_nav' => '0',
            
            // 'plus_wide_width' => '200',
            // 'color_primary' => '#296dc1',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'left',
            
            // 'product_detail_layout' => 'modern-1',
            'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            'tab_style_info' => '2d-radius',
            
            // 'loop_layout_buttons' => 'hoz-buttons',
            
            // 'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square',
            // 'nasa_attr_color_style' => 'big-square',
            // 'nasa_attr_label_style' => 'big-square',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f8f8f8',
        ),
    );
}
