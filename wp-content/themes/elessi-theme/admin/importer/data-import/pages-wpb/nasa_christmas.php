<?php
function nasa_wpb_christmas() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2020/12/Christmas_banner_01.jpg', '3318', array(
        'post_title' => 'Christmas_banner_01',
        'post_name' => 'christmas_banner_01',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2020/12/Christmas_banner_02.jpg', '3318', array(
        'post_title' => 'Christmas_banner_02',
        'post_name' => 'christmas_banner_02',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2020/12/Christmas_banner_03.jpg', '3318', array(
        'post_title' => 'Christmas_banner_03',
        'post_name' => 'christmas_banner_03',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Christmas',
            'post_name' => 'wpb-christmas',
            'post_content' => '[vc_row fullwidth="1" el_class="margin-bottom-20 mobile-margin-bottom-5"][vc_column][nasa_rev_slider alias="Slider-Christmas"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 mobile-margin-bottom-40"][vc_column width="1/3"][nasa_banner_2 align="right" effect_text="fadeInLeft" hover="zoom" height="212" img_src="' . $imgs_1 . '"]
<h4 class="fs-27 mobile-fs-25" style="line-height: 1.4; margin-top: 30px;">Golden Bell</h4>
<h5 class="fs-17 mobile-fs-15" style="text-decoration: underline;"><a style="color: #000000;" title="Shop now" href="#">Shop now</a></h5>
[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 align="right" effect_text="fadeInLeft" hover="zoom" height="212" img_src="' . $imgs_2 . '"]
<h4 class="fs-27 mobile-fs-25" style="line-height: 1.4; margin-top: 30px;">Ornaments
Ball</h4>
<h5 class="fs-17 mobile-fs-15" style="text-decoration: underline;"><a style="color: #000000;" title="Shop now" href="#">Shop now</a></h5>
[/nasa_banner_2][/vc_column][vc_column width="1/3"][nasa_banner_2 move_x="45%" effect_text="fadeInLeft" hover="zoom" height="212" img_src="' . $imgs_3 . '"]
<h4 class="fs-27 mobile-fs-25" style="line-height: 1.4; margin-top: 30px;">Shatterproof Christmas beels</h4>
<h5 class="fs-17 mobile-fs-15" style="text-decoration: underline;"><a style="color: #000000;" title="Shop now" href="#">Shop now</a></h5>
[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column width="1/5" offset="vc_col-xs-6"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Free Shipping" service_desc="Free Shipping for all US order" service_icon="pe-7s-plane"][/vc_column][vc_column width="1/5" offset="vc_col-xs-6"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Support 24/7" service_desc="We support 24h a day" service_icon="pe-7s-headphones"][/vc_column][vc_column width="1/5" offset="vc_col-xs-6"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="100% Money Back" service_desc="You have 30 days to Return" service_icon="pe-7s-refresh-2"][/vc_column][vc_column width="1/5" offset="vc_col-xs-6"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Payment Secure" service_desc="We ensure secure payment" service_icon="pe-7s-gift"][/vc_column][vc_column width="1/5" hide_in_mobile="1" offset="vc_col-xs-12"][nasa_service_box service_style="style-3" service_hover="buzz_effect" service_title="Discount" service_desc="Up to 40% for Member" service_icon="pe-7s-piggy"][/vc_column][/vc_row][vc_row fullwidth="1" el_class="margin-bottom-50 mobile-margin-bottom-30"][vc_column][nasa_products type="featured_product" style="slide_slick" shop_url="0" arrows="0" number="4" columns_number="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Recommended for you" title_align="text-center" font_size="xl"][vc_tta_tabs alignment="center" tabs_display_type="2d-radius-dashed"][vc_tta_section title="BEST SELLER" tab_id="1608656085917-2272473a-8975"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="TREE" tab_id="1608656085969-77ae9f3d-cc37"][nasa_products type="best_selling" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="LIGHT" tab_id="1608656088189-3a128462-4027"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="CHRISTMAS BAUBLES" tab_id="1608656089474-c6de03f3-dbb5"][nasa_products type="featured_product" columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="WREATHS &amp; GARLANDS" tab_id="1608656090393-d7a5cf01-a0f9"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Latest blog" title_desc="The freshest and most exciting news" title_align="text-center" font_size="xl" el_class="margin-bottom-30"][nasa_post arrows="1" posts="4" columns_number="3" columns_number_small_slider="1" columns_number_tablet="3" page_blogs="no"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '1',
            // '_nasa_header_transparent' => '1',
            // '_nasa_fixed_nav' => '-1',
            // '_nasa_topbar_default_show' => '2',
            // '_nasa_topbar_toggle' => '1',
            // '_nasa_bg_color_topbar' => '#3f5763',
            // '_nasa_text_color_topbar' => '#ffffff',
            // '_nasa_text_color_main_menu' => '#ffffff',
            // '_nasa_text_color_header' => '#ffffff',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#3f5763'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'plus_wide_width' => '100',
            'color_primary' => '#3f5763',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#ffffff',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'text_color_header' => '#ffffff',
            
            'bg_color_topbar' => '#3f5763',
            'text_color_topbar' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'top-2',
            
            // 'nasa_attr_label_style' => 'small-square-2',
            
            // 'product_detail_layout' => 'new-2',
            'product_image_layout' => 'single',
            
            'tab_style_info' => 'small-accordion',
            
            'loop_layout_buttons' => 'modern-1',
            
            'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square'
        ),
    );
}
