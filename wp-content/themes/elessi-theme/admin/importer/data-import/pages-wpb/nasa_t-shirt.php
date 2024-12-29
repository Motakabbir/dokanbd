<?php
function nasa_wpb_t_shirt() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2020/08/Banner_01.jpg', '3318', array(
        'post_title' => 'Banner_01',
        'post_name' => 'banner_01',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2020/08/Banner_02.jpg', '3318', array(
        'post_title' => 'Banner_02',
        'post_name' => 'banner_02',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2020/08/Banner_03.jpg', '3318', array(
        'post_title' => 'Banner_03',
        'post_name' => 'banner_03',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2020/08/Banner_04.jpg', '3319', array(
        'post_title' => 'Banner_04',
        'post_name' => 'banner_04',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB T-Shirt',
            'post_name' => 'wpb-t-shirt',
            'post_content' => '[vc_row fullwidth="1"][vc_column][nasa_rev_slider alias="slider-t-shirt"][/vc_column][/vc_row][vc_row el_class="padding-bottom-30 margin-top-50"][vc_column][nasa_title title_text="Feature Categories" title_type="h3" font_size="l" title_align="text-center" el_class="margin-bottom-30"][nasa_product_categories list_cats="haircare-woman, makeup-woman, nails-woman, bracelets-woman, earrings-woman, necklaces-woman" parent="false" hide_empty="0" columns_number="6" columns_number_small="2" columns_number_tablet="3" auto_slide="false"][/vc_column][/vc_row][vc_row][vc_column][nasa_title title_text="Recommend For You" title_type="h3" font_size="l" title_align="text-center" el_class="margin-bottom-10"][vc_tta_tabs alignment="center" tabs_display_type="2d-radius-dashed"][vc_tta_section title="BEST SELLER" tab_id="1596708228738-17953d91-53db"][nasa_products style="infinite" style_viewmore="3" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="WOMEN" tab_id="1596708230330-4a2f8401-99c3"][nasa_products style="infinite" style_viewmore="3" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="MAN" tab_id="1596708231252-34e7b24b-5d0f"][nasa_products style="infinite" style_viewmore="3" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="ON SALE" tab_id="1596708232082-542f3886-2ffd"][nasa_products style="infinite" style_viewmore="3" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="NEW" tab_id="1596708232914-0ac172a9-a490"][nasa_products style="infinite" style_viewmore="3" columns_number="4" columns_number_small="2" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-top-50"][vc_column width="1/3"][nasa_banner effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_1 . '"]
    <h3 style="font-size: 160%; line-height: 1.2; font-weight: 800;">Bag with
    rose pattern</h3>
    <h5 class="nasa-bold-700" style="font-size: 115%;">Sale off 25%</h5>
    <h5 style="line-height: 3; text-decoration: underline;"><a style="font-size: 65%; font-weight: 500;" title="Shop Now" href="#">Shop now</a></h5>
    [/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner effect_text="fadeInDownBig" hover="reduction" img_src="' . $imgs_2 . '"]
    <h3 style="font-size: 180%; line-height: 1.2; color: #000000; font-weight: bold;">Hello
    Summer</h3>
    <h5 style="text-decoration: underline;"><a style="font-size: 70%; font-weight: 500; color: #000000;" title="Shop now" href="#">Shop now</a></h5>
    [/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner valign="middle" effect_text="bounceInRight" hover="fade" img_src="' . $imgs_3 . '"]
    <h3 style="font-size: 180%; line-height: 1.2; color: #000000; font-weight: bold;">Let Party
    Hard Pillow</h3>
    <a class="button" style="margin-top: 10px; font-size: 12px; padding: 12px 20px; border-radius: 40px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-top-50 margin-bottom-50"][vc_column][nasa_title title_text="Featured Items" title_type="h3" font_size="l" title_desc="Find a bright ideal to suit your taste with our great selection of suspension, wall, floor and table light" title_align="text-center" el_class="margin-bottom-30"][nasa_products style="carousel" pos_nav="both" shop_url="0" arrows="1" number="9" columns_number="3" columns_number_small="2" columns_number_tablet="3"][/vc_column][/vc_row][vc_row fullwidth="1"][vc_column][nasa_banner height="280" valign="middle" banner_responsive="no" img_src="' . $imgs_4 . '"]
    <h6 style="letter-spacing: 3px; font-size: 95%; font-weight: 600; color: #000000;">NEW DESIGN</h6>
    <h4 style="margin-top: 25px; font-weight: 800; font-size: 190%; color: #727272;">Up to<span class="primary-color"> 50% Off</span></h4>
    <h4 style="font-weight: 800; font-size: 190%; line-height: 1.5; color: #727272;">All T-Shirt &amp; Accessories</h4>
    <a class="button" style="margin-top: 10px; font-size: 12px; border-radius: 40px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_footer_mode' => 'builder',
            // '_nasa_custom_footer' => 'footer-light-3',
            // '_nasa_custom_footer_mobile' => 'footer-mobile',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#0f9d8a',
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'fixed_nav' => '0',
            
            // 'plus_wide_width' => '400',
            'color_primary' => '#0f9d8a',
            
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
            'footer-type' => 'footer-light-3',
            'footer-mobile' => 'footer-light-3',
            
            // 'category_sidebar' => 'top-2',
            
            // 'product_detail_layout' => 'full',
            // 'full_info_col' => '2',
            'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            // 'tab_style_info' => 'scroll-down',
            
            // 'single_product_thumbs_style' => 'hoz',
            
            'loop_layout_buttons' => 'hoz-buttons',
            
            'animated_products' => 'hover-zoom',
            
            // 'nasa_attr_image_style' => 'square',
            'nasa_attr_image_single_style' => 'square-caption',
            'nasa_attr_color_style' => 'round',
            'nasa_attr_label_style' => 'round',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f8f8f8',
            // 'breadcrumb_align' => 'text-left',
            // 'breadcrumb_height' => '60',
        ),
    );
}
