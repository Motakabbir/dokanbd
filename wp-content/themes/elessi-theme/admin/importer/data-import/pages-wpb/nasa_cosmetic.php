<?php
function nasa_wpb_cosmetic() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2019/10/ourwork-bg.jpg', '0', array(
        'post_title' => 'ourwork-bg',
        'post_name' => 'ourwork-bg',
    ));
    $imgs_1_src = $imgs_1 ? wp_get_attachment_image_url($imgs_1, 'full') : 'https://via.placeholder.com/1920x650';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Cosmetic',
            'post_name' => 'wpb-cosmetic',
            'post_content' => '[vc_row fullwidth="1"][vc_column][nasa_rev_slider alias="slider-Cosmetic"][/vc_column][/vc_row][vc_row el_class="margin-top-60"][vc_column][nasa_slider align="center" bullets="false"][vc_column_text]
    <h1 class="text-center" style="font-weight: 800;">"Cubilia a nisi blandit sem cras nec
    temport adipiscing rku ullamcorper ligula."</h1>
    <p class="text-center"><span style="font-weight: 900; color: #000; letter-spacing: 3px;">JOHN DOE</span> / CEO Elessi</p>
    [/vc_column_text][vc_column_text]
    <h1 class="text-center" style="font-weight: 800;">"Cubilia a nisi blandit sem cras nec
    temport adipiscing rku ullamcorper ligula."</h1>
    <p class="text-center"><span style="font-weight: 900; color: #000; letter-spacing: 3px;">JOHN DOE</span> / CEO Elessi</p>
    [/vc_column_text][/nasa_slider][/vc_column][/vc_row][vc_row el_class="margin-top-40"][vc_column][vc_tta_tabs alignment="center" tabs_display_type="2d-radius"][vc_tta_section title="ALL" tab_id="1570508350034-495160d1-2fd6"][nasa_products style="carousel" pos_nav="both" shop_url="0" arrows="1" number="6" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="WOMEN" tab_id="1570508350051-1aa45ea6-e35d"][nasa_products style="carousel" pos_nav="both" shop_url="0" arrows="1" number="6" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="MEN" tab_id="1570508405022-0e700ad8-c662"][nasa_products style="carousel" pos_nav="both" shop_url="0" arrows="1" number="6" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="ON SALE" tab_id="1570508419137-09ceb588-3086"][nasa_products style="carousel" pos_nav="both" shop_url="0" arrows="1" number="6" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][vc_tta_section title="NEW" tab_id="1570508432796-1e7a5c2c-5327"][nasa_products style="carousel" pos_nav="both" shop_url="0" arrows="1" number="6" columns_number="5" columns_number_small="2" columns_number_tablet="2"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-top-50"][vc_column][nasa_title title_text="Our work" title_type="h3" font_size="xl" title_desc="More than 300 makeup projects in the portfolio" title_align="text-center"][/vc_column][/vc_row][vc_row el_class="margin-top-40 padding-top-80 padding-bottom-80" css=".vc_custom_1570520549620{background-image: url(' . $imgs_1_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/3" el_class="text-center"][nasa_compare_imgs title="Before - After" link="#" desc_text="Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s." before_image="3029" after_image="3028"][/vc_column][vc_column width="1/3" el_class="text-center mobile-margin-top-10 mobile-margin-bottom-10"][nasa_compare_imgs title="Before - After" link="#" desc_text="Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s." before_image="3029" after_image="3028"][/vc_column][vc_column width="1/3" el_class="text-center"][nasa_compare_imgs title="Before - After" link="#" desc_text="Lorem Ipsum has been the industry’s standard dummy text ever since the 1500s." before_image="3029" after_image="3028"][/vc_column][/vc_row][vc_row el_class="margin-top-50"][vc_column][nasa_title title_text="Latest Blog" title_type="h3" font_size="xl" title_desc="The freshest and most exctings news" title_align="text-center" el_class="margin-bottom-30"][nasa_post dots="true" arrows="0" posts="4" columns_number="3" columns_number_small="2" columns_number_tablet="2" date_enable="no" author_enable="no" page_blogs="no"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 mobile-margin-bottom-25"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        
        'post_meta' => array(
            '_wpb_shortcodes_custom_css' => '.vc_custom_1570520549620{background-image: url(' . $imgs_1_src . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'plus_wide_width' => '100',
            'color_primary' => '#87b66e',
            
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
            
            'product_detail_layout' => 'modern-2',
            // 'product_image_layout' => 'single',
            
            'tab_style_info' => 'ver-2',
            
            'loop_layout_buttons' => 'modern-5',
            
            'animated_products' => 'hover-bottom-to-top',
            
            // 'nasa_attr_image_style' => 'square'
            
            'breadcrumb_row' => 'single',
            'breadcrumb_type' => 'default',
            'breadcrumb_bg_color' => '#f8f8f8',
            'breadcrumb_align' => 'text-left',
            'breadcrumb_height' => '60',
        ),
    );
}
