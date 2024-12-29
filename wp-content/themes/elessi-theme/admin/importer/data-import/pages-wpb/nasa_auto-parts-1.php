<?php
function nasa_wpb_auto_parts_1() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2021/10/h4-banner1.jpg', '3117', array(
        'post_title' => 'atp1-banner1',
        'post_name' => 'atp1-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2021/10/h4-banner2.jpg', '3117', array(
        'post_title' => 'atp1-banner2',
        'post_name' => 'atp1-banner2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2021/10/car-banner-2.jpeg', '3319', array(
        'post_title' => 'car-banner-2',
        'post_name' => 'car-banner-2',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Auto Parts V1',
            'post_name' => 'wpb-auto-parts-v1',
            'post_content' => '[vc_row fullwidth="1" el_class="margin-bottom-20"][vc_column][nasa_rev_slider alias="slider-auto-part-v1" alias_m="slider-auto-part-v1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30 mobile-margin-bottom-50"][vc_column width="1/2"][nasa_banner valign="middle" hover="zoom" img_src="' . $imgs_1 . '"]
<h4 style="font-weight: 300!important;">Moteri racing</h4>
<h4 style="font-weight: 300!important;">Rally <b>Gold Custom</b></h4>
<h6 style="margin-top: 20px;">Just Only   <b style="color: #539309; font-size: 180%;">$120.00</b></h6>
<a class="button margin-top-30" style="border-radius: 5px; letter-spacing: 1.5px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner][/vc_column][vc_column width="1/2"][nasa_banner valign="middle" hover="zoom" img_src="' . $imgs_2 . '"]
<h4>Auto Repair</h4>
<h4>System <span style="font-weight: 300;">Accessories</span></h4>
<h6 style="margin-top: 20px;">Discount   <b style="color: #ff0000; font-size: 180%;">25% Off</b></h6>
<a class="button margin-top-30" style="border-radius: 5px; letter-spacing: 1.5px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-bottom-20"][vc_column][vc_tta_tabs alignment="right" tabs_display_type="2d-has-bg" tabs_bg_color="" title="What we offer" el_class="letter-spacing-none"][vc_tta_section title="New Arrivals" tab_id="1557566365886-e30e3479-8dde"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Featured" tab_id="1557566642338-a1102b84-8b1a"][nasa_products type="featured_product" style="infinite" style_viewmore="2" number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="Popular" tab_id="1557566641289-47c8444f-5192"][nasa_products type="top_rate" style="infinite" style_viewmore="2" pos_nav="left" number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="On Sale" tab_id="1557566640920-0afb96af-7762"][nasa_products type="on_sale" style="infinite" style_viewmore="2" pos_nav="left" number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-50"][vc_column][nasa_banner valign="middle" text-align="text-center" banner_responsive="no" hover="zoom" img_src="' . $imgs_3 . '" el_class="mobile-align-center"]
<h6 style="color: #1e90ff; margin-bottom: 20px; font-size: 115%;">Limited Edition</h6>
<h4 style="font-size: 250%;">Auto Audio &amp; Electronics</h4>
<h5 style="font-weight: 300;">Discount up to <b style="color: #67981a; font-size: 150%;">50% </b> Off</h5>
<a class="button margin-top-20" style="border-radius: 5px;" title="Shop now" href="#">Start Buying</a>[/nasa_banner][/vc_column][/vc_row][vc_row][vc_column][nasa_title title_text="Today Hot Deals" title_type="h3" font_size="xl" title_align="text-center"][/vc_column][/vc_row][vc_row el_class="padding-top-70 padding-bottom-20 margin-bottom-50" css=".vc_custom_1634044862558{background-color: #fbfbfb !important;}"][vc_column][nasa_products_special_deal columns_number="3" columns_number_small="1" columns_number_tablet="3" arrows="0" auto_slide="false" category_product="wheels-tires"][vc_empty_space height="35px"][vc_column_text el_class="text-center"]<a class="button margin-top-5 margin-bottom-40" title="View All Deals" href="#">View All Deals</a>[/vc_column_text][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 mobile-margin-bottom-20"][vc_column width="1/3" el_class="mobile-margin-top-20"][nasa_title title_text="Featured" title_type="h3" font_size="m" el_class="margin-bottom-30"][nasa_products type="featured_product" style="list" pos_nav="left" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-30"][nasa_title title_text="Best Selling" title_type="h3" font_size="m" el_class="margin-bottom-30"][nasa_products type="best_selling" style="list" pos_nav="left" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-top-30"][nasa_title title_text="On Sale" title_type="h3" font_size="m" el_class="margin-bottom-30"][nasa_products type="on_sale" style="list" pos_nav="left" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '4',
            // '_nasa_plus_wide_option' => '1',
            // '_nasa_plus_wide_width' => '100',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#dd3333',
            // '_nasa_bg_color_main_menu' => '#f6f6f6',
            // '_nasa_type_font_select' => 'google',
            // '_nasa_type_headings' => 'Rubik',
            // '_nasa_type_texts' => 'Rubik',
            // '_nasa_type_nav' => 'Rubik',
            // '_nasa_type_banner' => 'Rubik',
            // '_nasa_type_price' => 'Rubik',
            // '_nasa_font_weight' => '500',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1634044862558{background-color: #fbfbfb !important;}'
        ),
        
        'globals' => array(
            'header-type' => '4',
            
            'fixed_nav' => '0',
            
            'plus_wide_width' => '100',
            'color_primary' => '#dd3333',
            
            // 'fullwidth_main_menu' => '1',
            
            'bg_color_main_menu' => '#f6f6f6',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#539309',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            'category_sidebar' => 'top-2',
            
            'nasa_attr_label_style' => 'small-square-2',
            
            'product_detail_layout' => 'modern-1',
            // 'tab_style_info' => 'scroll-down',
            
            'loop_layout_buttons' => 'modern-3',
            
            // 'animated_products' => 'hover-fade',
            
            // 'nasa_attr_image_style' => 'square'
            
            'breadcrumb_row' => 'single',
            'breadcrumb_align' => 'text-left',
            'breadcrumb_height' => '60',
        ),
    );
}
