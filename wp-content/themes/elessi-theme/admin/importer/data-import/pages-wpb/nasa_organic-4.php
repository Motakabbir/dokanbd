<?php
function nasa_wpb_organic_4() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-banner1.jpg', '3139', array(
        'post_title' => 'organic4-banner1',
        'post_name' => 'organic4-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-banner2.jpg', '3139', array(
        'post_title' => 'organic4-banner2',
        'post_name' => 'organic4-banner2',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-banner3.jpg', '3139', array(
        'post_title' => 'organic4-banner3',
        'post_name' => 'organic4-banner3',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2023/09/organic-curve2-bg.png', '3113', array(
        'post_title' => 'organic-curve2-bg',
        'post_name' => 'organic-curve2-bg',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-vegetables.png', '3105', array(
        'post_title' => 'organic4-vegetables',
        'post_name' => 'organic4-vegetables',
    ));
    
    $box_1 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon1.png', '2915', array(
        'post_title' => 'organic4-icon1',
        'post_name' => 'organic4-icon1',
    ));
    
    $box_2 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon2.png', '2915', array(
        'post_title' => 'organic4-icon2',
        'post_name' => 'organic4-icon2',
    ));
    
    $box_3 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon3.png', '2915', array(
        'post_title' => 'organic4-icon3',
        'post_name' => 'organic4-icon3',
    ));
    
    $box_4 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-icon4.png', '2915', array(
        'post_title' => 'organic4-icon4',
        'post_name' => 'organic4-icon4',
    ));
    
    $imgs_url_1 = elessi_import_upload('/wp-content/uploads/2023/09/organic4-bg.jpg', '3151', array(
        'post_title' => 'organic4-bg',
        'post_name' => 'organic4-bg',
    ));
    $imgs_url_src_1 = $imgs_url_1 ? wp_get_attachment_image_url($imgs_url_1, 'full') : 'https://via.placeholder.com/1920x894?text=1920x894';
    
    $imgs_url_2 = elessi_import_upload('/wp-content/uploads/2022/06/organic-3-newsletter-bg.jpg', '3319', array(
        'post_title' => 'organic-3-newsletter-bg',
        'post_name' => 'organic-3-newsletter-bg',
    ));
    $imgs_url_src_2 = $imgs_url_2 ? wp_get_attachment_image_url($imgs_url_2, 'full') : 'https://via.placeholder.com/1920x170?text=1920x170';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Organic V4',
            'post_name' => 'wpb-organic-v4',
            'post_content' => '[vc_row fullwidth="1" el_class="margin-bottom-40 tablet-margin-bottom-25 mobile-margin-top-10 mobile-margin-bottom-20 mobile-padding-left-10 mobile-padding-right-10"][vc_column][nasa_rev_slider alias="slider-organic-2"][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 tablet-margin-bottom-30"][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 move_x="7%" effect_text="fadeInLeft" data_delay="100ms" hover="zoom" img_src="' . $imgs_1 . '"]
<h4 class="fs-22 tablet-fs-16 margin-bottom-20 tablet-margin-bottom-10" style="line-height: 1.2;">Fresh
Vegetable</h4>
<h6 class="fs-14 margin-bottom-25 tablet-margin-bottom-10 mobile-margin-bottom-20" style="color: #a9a9a9;">Sale off <span class="fs-25 tablet-fs-16 mobile-fs-15" style="color: #ff0000;">25%</span></h6>
<a class="primary-color hide-for-medium nasa-bold-500 button small fs-15 tablet-fs-11 mobile-fs-12 force-radius-5" style="text-transform: capitalize; letter-spacing: 0; padding: 8px 23px;" title="Shop now" href="#">Shop Now</a>[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 move_x="8%" effect_text="fadeInLeft" data_delay="100ms" hover="zoom" img_src="' . $imgs_2 . '"]
<h4 class="fs-14 margin-top-10 margin-bottom-10" style="color: #afaeac;">BEST CHOISE</h4>
<h4 class="fs-22 tablet-fs-16 margin-top-10 margin-bottom-35 tablet-margin-bottom-0 mobile-margin-bottom-20" style="line-height: 1.2;">Discover
Real Organic Juice</h4>
<h6 class="fs-14 tablet-fs-10" style="line-height: 1.4; color: #c0c2bd;">ONLY
<span class="fs-29 tablet-fs-16 mobile-fs-15" style="color: #ff0000;">$19.00</span></h6>
[/nasa_banner_2][/vc_column][vc_column width="1/3" offset="vc_col-md-4"][nasa_banner_2 move_x="9%" effect_text="fadeInUp" data_delay="600ms" hover="zoom" img_src="' . $imgs_3 . '"]
<h3 class="fs-23 tablet-fs-14 margin-bottom-60 tablet-margin-bottom-10 mobile-margin-bottom-40" style="color: #015a02;">Green Fruits
and Vegetables</h3>
<h3 class="fs-35 tablet-fs-16 mobile-fs-20 margin-bottom-0" style="color: #ff0000;">100%</h3>
<h3 class="fs-20 tablet-fs-14 margin-top-5" style="color: #015a02;">ORGANIC</h3>
[/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 tablet-margin-bottom-30 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Featured Products" title_type="h2" title_align="text-center" font_size="xl" el_class="margin-bottom-10"][vc_tta_tabs alignment="center" title_font_size="m" tabs_display_type="2d-has-bg" tabs_bg_color="" el_class="letter-spacing-none"][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-orange" title="Fruits" tab_id="1655095615591-34d4eb8f-0124"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-fruit" title="Vegetables" tab_id="1655095615605-82862b21-9705"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-fast-food" title="Milk &amp; Cream" tab_id="1655095615619-7171fc27-f88b"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-banana" title="Banana" tab_id="1655095615632-bd0b23ca-954b"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-fish" title="Sea Food" tab_id="1655117492748-887d6bcd-c011"][nasa_products number="10" columns_number="5" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row][vc_column][nasa_image image="' . $imgs_4 . '" align="center"][/vc_column][/vc_row][vc_row el_class="desktop-padding-top-20 desktop-padding-bottom-150 desktop-margin-bottom-80 text-center" css=".vc_custom_1656223525555{background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column el_class="desktop-padding-left-100 desktop-padding-right-100 desktop-padding-bottom-100 tablet-padding-left-20 tablet-padding-right-20"][vc_column_text]
<h5 style="color: #a4a4a4;">Green Agriculture</h5>
[/vc_column_text][vc_column_text]
<h3 class="fs-30 nasa-flex jc align-start margin-bottom-80">WELCOME TO ELESSI</h3>
[/vc_column_text][vc_row_inner rtl_reverse="yes" el_class="margin-bottom-60 mobile-margin-bottom-0 tablet-margin-bottom-80"][vc_column_inner el_class="desktop-margin-top-140 tablet-margin-top-0 padding-left-30 padding-right-30 mobile-margin-bottom-50" width="1/4"][nasa_icon_box box_img="' . $box_1 . '" box_style="ver" box_title="Alway Fresh" box_desc="Having produce delivery frequently is essential to obtaion the essential daily"][/vc_column_inner][vc_column_inner el_class="padding-left-30 padding-right-30 mobile-margin-bottom-50" width="1/4"][nasa_icon_box box_img="' . $box_2 . '" box_style="ver" box_title="100% Organic" box_desc="We bring the sections best mis of 100% produce and hand-crafted"][/vc_column_inner][vc_column_inner el_class="padding-left-30 padding-right-30 mobile-margin-bottom-50" width="1/4"][nasa_icon_box box_img="' . $box_3 . '" box_style="ver" box_title="Premium Quality" box_desc="We have been growing organic produce for customers since 1980"][/vc_column_inner][vc_column_inner el_class="desktop-margin-top-140 tablet-margin-top-0 padding-left-30 padding-right-30 mobile-margin-bottom-50" width="1/4"][nasa_icon_box box_img="' . $box_4 . '" box_style="ver" box_title="Healthy Cooking" box_desc="Obtaining the recommended daily fruits and vegetables"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row css=".vc_custom_1655456184401{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}" el_class="hide-for-mobile"][vc_column css=".vc_custom_1655456174305{margin-top: -435px !important;}"][nasa_image image="' . $imgs_5 . '" align="center"][/vc_column][/vc_row][vc_row el_class="margin-top-80 margin-bottom-50 mobile-margin-top-50"][vc_column width="1/4" el_class="tablet-margin-bottom-20 mobile-margin-bottom-20" offset="vc_col-lg-3 vc_col-md-6"][nasa_title title_text="Top Rated" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="top_rate" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/4" el_class="tablet-margin-bottom-20 mobile-margin-bottom-20" offset="vc_col-lg-3 vc_col-md-6"][nasa_title title_text="Best Selling" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="best_selling" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/4" el_class="mobile-margin-bottom-20" offset="vc_col-lg-3 vc_col-md-6"][nasa_title title_text="On Sale" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="on_sale" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/4" offset="vc_col-lg-3 vc_col-md-6"][nasa_title title_text="Featured" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="featured_product" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 tablet-margin-bottom-50 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Latest blog" title_desc="The freshest and most exciting news" title_align="text-center" font_size="xl" el_class="margin-bottom-30"][nasa_post arrows="1" posts="4" columns_number="4" columns_number_small_slider="1" columns_number_tablet="2" author_enable="no" page_blogs="no"][/vc_column][/vc_row][vc_row hide_in_mobile="1" el_class="margin-bottom-60 padding-top-40 padding-bottom-25 padding-left-30 padding-right-30 hide-for-medium" css=".vc_custom_1656223311243{background-image: url(' . $imgs_url_src_2 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/4" el_class="rtl-right mobile-margin-bottom-20" css=".vc_custom_1655365681971{padding-top: 12px !important;padding-right: 10px !important;padding-bottom: 12px !important;padding-left: 10px !important;}"][vc_column_text]
<h3 class="fs-25" style="margin: 0; white-space: nowrap;"><i class="icon-nasa-icons-12"></i> Sign up to Newsletter</h3>
[/vc_column_text][/vc_column][vc_column width="1/4" el_class="rtl-right text-right" css=".vc_custom_1655365739045{padding-top: 20px !important;padding-right: 10px !important;padding-bottom: 20px !important;padding-left: 10px !important;}"][vc_column_text]
<h5 class="fs-15" style="color: #666; margin: 0; white-space: nowrap;">…and receive $10 coupon for first shopping</h5>
[/vc_column_text][/vc_column][vc_column width="5/12" el_class="nasa-clear-none rtl-left organic-style-wrap" offset="vc_col-lg-offset-1"][contact-form-7 id="210"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '6',
            // '_nasa_plus_wide_option' => '1',
            // '_nasa_plus_wide_width' => '400',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#6bad0d',
            // '_nasa_footer_mode' => 'builder',
            // '_nasa_custom_footer' => 'footer-light-3',
            // '_nasa_custom_footer_mobile' => 'footer-light-3',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1656223525555{background-image: url(' . $imgs_url_src_1 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1655456184401{background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1656223311243{background-image: url(' . $imgs_url_src_2 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1655456174305{margin-top: -435px !important;}.vc_custom_1655365681971{padding-top: 12px !important;padding-right: 10px !important;padding-bottom: 12px !important;padding-left: 10px !important;}.vc_custom_1655365739045{padding-top: 20px !important;padding-right: 10px !important;padding-bottom: 20px !important;padding-left: 10px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '6',
            
            'fixed_nav' => '0',
            
            'plus_wide_width' => '400',
            'color_primary' => '#6bad0d',
            
            // 'bg_color_topbar' => '28aeb1',
            // 'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-3',
            'footer-mobile' => 'footer-light-3',
            
            // 'category_sidebar' => 'right-classic',
            
            // 'product_detail_layout' => 'classic',
            'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            // 'tab_style_info' => '2d-no-border',
            
            // 'single_product_thumbs_style' => 'hoz',
            
            'loop_layout_buttons' => 'modern-1',
            
            'animated_products' => 'hover-zoom',
            
            'nasa_attr_image_style' => 'square',
            // 'nasa_attr_image_single_style' => 'extends',
            // 'nasa_attr_color_style' => 'round',
            // 'nasa_attr_label_style' => 'round',
            
            // 'breadcrumb_row' => 'single',
            // 'breadcrumb_type' => 'default',
            // 'breadcrumb_bg_color' => '#f8f8f8',
            // 'breadcrumb_align' => 'text-left',
            // 'breadcrumb_height' => '60',
        ),
    );
}
