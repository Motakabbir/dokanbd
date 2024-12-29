<?php
function nasa_wpb_fashion_1() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner1-2.jpg', '3098', array(
        'post_title' => 'h2-banner1-2',
        'post_name' => 'h2-banner1-2',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner21.jpg', '3098', array(
        'post_title' => 'h2-banner21',
        'post_name' => 'h2-banner21',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Fashion V1',
            'post_name' => 'wpb-fashion-v1',
            'post_content' => '[vc_row fullwidth="1"][vc_column][nasa_rev_slider alias="slider-01-1"][/vc_column][/vc_row][vc_row equal_height="yes" width_side="left" el_class="margin-top-100 nasa-clear-both tablet-margin-top-70 mobile-margin-top-60"][vc_column parallax="content-moving" parallax_image="3326" parallax_speed_bg="1" css_animation="none" width="5/12" hide_in_mobile="1"][/vc_column][vc_column css_animation="none" width="7/12" el_class="right desktop-padding-left-20"][nasa_products title_shortcode="For Her" style="carousel" style_row="2" shop_url="0" arrows="1" number="10" columns_number="3" columns_number_small="2" columns_number_tablet="2" cat="woman"][nasa_separator_link title_text="Shop Now" link_text="#" title_type="h5" title_hr="full" el_class="margin-bottom-20 mobile-margin-bottom-50"][/vc_column][/vc_row][vc_row el_class="margin-top-100 tablet-margin-top-70 mobile-margin-top-20"][vc_column width="1/2"][nasa_banner height="180px" valign="middle" effect_text="fadeInLeft" hover="zoom" data_delay="500ms" img_src="' . $imgs_1 . '"]
    <h5>Mini backpack</h5>
    <h6 style="color: #999;">Bags &amp; Accessories</h6>
    [/nasa_banner][/vc_column][vc_column width="1/2"][nasa_banner height="180px" valign="middle" text_color="dark" effect_text="fadeInLeft" hover="fade" data_delay="500ms" img_src="' . $imgs_2 . '"]
    <h5>Big Sale</h5>
    <h3>50% OFF</h3>
    [/nasa_banner][/vc_column][/vc_row][vc_row equal_height="yes" width_side="right" el_class="margin-top-80 tablet-margin-top-50 mobile-margin-top-30"][vc_column width="7/12" el_class="left desktop-padding-right-20"][nasa_products title_shortcode="For Him" style="carousel" style_row="2" title_align="right" shop_url="0" arrows="1" number="12" columns_number="3" columns_number_small="2" columns_number_tablet="2" cat="men"][nasa_separator_link title_text="Shop Now" link_text="#" title_type="h5" title_hr="full" title_align="text-right" el_class="margin-bottom-20 mobile-margin-bottom-50"][/vc_column][vc_column parallax="content-moving" parallax_image="3327" parallax_speed_bg="1" css_animation="none" width="5/12" hide_in_mobile="1"][/vc_column][/vc_row][vc_row css=".vc_custom_1520435667002{background-color: #f76b6a !important;}" el_class="mobile-margin-top-40 mobile-margin-bottom-20 desktop-margin-top-80 desktop-margin-bottom-80 padding-top-15 padding-bottom-15"][vc_column][nasa_slider bullets="false" navigation="false" autoplay="true"][vc_column_text]
    <p class="color-white text-center nasa-bold" style="letter-spacing: 0.1em;">UP TO 70% OFF THE ENTRIRE STORE! - MADE WITH LOVE by <span class="nasa-underline">Nasa studio</span></p>
    [/vc_column_text][vc_column_text]
    <p class="color-white text-center nasa-bold" style="letter-spacing: 0.1em;">UP TO 70% OFF THE ENTRIRE STORE! - MADE WITH LOVE by <span class="nasa-underline">Nasa studio</span></p>
    [/vc_column_text][/nasa_slider][/vc_column][/vc_row][vc_row][vc_column width="1/3"][nasa_products title_shortcode="Top Rated" type="top_rate" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="Best Selling" type="best_selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="Recent" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][/vc_row][vc_row el_class="padding-top-50 margin-bottom-50"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        
        'post_meta' => array(
            // '_nasa_header_block' => 'static-header-1',
            '_nasa_el_class_header' => 'main-home-fix',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1520435667002{background-color: #f76b6a !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'left',
            
            // 'product_detail_layout' => 'modern-1',
            // 'product_image_layout' => 'single',
            // 'product_image_style' => 'scroll',
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
