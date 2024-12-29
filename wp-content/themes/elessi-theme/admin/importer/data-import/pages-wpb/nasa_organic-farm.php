<?php
function nasa_wpb_organic_farm() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2023/09/farm-slider-bottom.png', '3657', array(
        'post_title' => 'farm-slider-bottom',
        'post_name' => 'farm-slider-bottom',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2023/09/farm-about-us.jpg', '3660', array(
        'post_title' => 'farm-about-us',
        'post_name' => 'farm-about-us',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2023/09/farm-choose-us.png', '3094', array(
        'post_title' => 'farm-choose-us',
        'post_name' => 'farm-choose-us',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2023/09/farm-icon1.png', '2914', array(
        'post_title' => 'farm-icon1',
        'post_name' => 'farm-icon1',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2023/09/farm-icon2.png', '2915', array(
        'post_title' => 'farm-icon2',
        'post_name' => 'farm-icon2',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2023/09/farm-icon3.png', '2916', array(
        'post_title' => 'farm-icon3',
        'post_name' => 'farm-icon3',
    ));
    
    $imgs_7 = elessi_import_upload('/wp-content/uploads/2023/09/farm-icon4.png', '2917', array(
        'post_title' => 'farm-icon4',
        'post_name' => 'farm-icon4',
    ));
    
    $imgs_url_1 = elessi_import_upload('/wp-content/uploads/2023/09/farm-sign.jpg', '3783', array(
        'post_title' => 'farm-sign',
        'post_name' => 'farm-sign',
    ));
    $imgs_url_src_1 = $imgs_url_1 ? wp_get_attachment_image_url($imgs_url_1, 'full') : 'https://via.placeholder.com/110x110?text=110x110';
    
    $imgs_url_2 = elessi_import_upload('/wp-content/uploads/2023/09/farm-testimonial-bg.jpg', '3197', array(
        'post_title' => 'farm-testimonial-bg',
        'post_name' => 'farm-testimonial-bg',
    ));
    $imgs_url_src_2 = $imgs_url_2 ? wp_get_attachment_image_url($imgs_url_2, 'full') : 'https://via.placeholder.com/1920x444?text=1920x444';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Organic Farm',
            'post_name' => 'wpb-organic-farm',
            'post_content' => '[vc_row fullwidth="1" el_class="margin-bottom-80 mobile-margin-bottom-30 nasa-relative"][vc_column][nasa_rev_slider alias="slider-organic-farm"][/vc_column][vc_column el_class="farm-slider-bottom"][nasa_image image="' . $imgs_1 . '" align="center"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 mobile-margin-bottom-60 tablet-padding-left-15 tablet-padding-right-15 mobile-padding-left-20 mobile-padding-right-20"][vc_column width="2/3" el_class="padding-top-30 padding-left-80 padding-right-80 tablet-padding-left-30 tablet-padding-right-30 mobile-padding-left-10 mobile-padding-right-10 mobile-margin-bottom-50" offset="vc_col-lg-8 vc_col-md-6"][vc_column_text el_class="margin-bottom-40 text-center"]
<h3 class="fs-45 margin-bottom-5">Our Story</h3>
<h4 class="primary-color fs-16">DISCOVER OUR BEAUTIFUL FARM</h4>
[/vc_column_text][vc_column_text el_class="text-center margin-bottom-20"]
<p class="fs-18" style="color: #acacac;"><em>Elessi Organic Limited was formed by the same family that owns it today in 1979 on our main site in Blackford, Perthshire. In the late 1970s, the market for bottled water was less than 30 million liters a year. So it is testimony to the vision the family had,
that one day bottled water and in particular.</em></p>
<p class="fs-18" style="color: #acacac;"><em>With the consumer-driven focus of the 1980s, Elessi Organic took its first foray into TV advertising. Sales continued to grow into 1990.</em></p>
[/vc_column_text][vc_column_text]
<div class="nasa-flex jc">
<div class="margin-bottom-0 margin-right-25 rtl-margin-right-0 rtl-margin-left-25"><img class="alignnone size-full wp-image" src="' . $imgs_url_src_1 . '" alt="Farm Sign" width="110" height="110" /></div>
<div>
<h5>PAUL SMITH</h5>
<h6 class="primary-color">Director Store</h6>
</div>
</div>
[/vc_column_text][/vc_column][vc_column css_animation="none" width="1/3" css=".vc_custom_1656924835214{border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 10px !important;padding-right: 10px !important;padding-bottom: 10px !important;padding-left: 10px !important;border-left-color: #ffffff !important;border-left-style: solid !important;border-right-color: #ffffff !important;border-right-style: solid !important;border-top-color: #ffffff !important;border-top-style: solid !important;border-bottom-color: #ffffff !important;border-bottom-style: solid !important;}" offset="vc_col-lg-4 vc_col-md-6" el_class="banner-farm-au"][nasa_banner_2 img_src="' . $imgs_2 . '" el_class="margin-bottom-0"][/nasa_banner_2][/vc_column][/vc_row][vc_row el_class="margin-bottom-40 tablet-margin-bottom-30 mobile-margin-bottom-20"][vc_column][nasa_title title_text="Featured Products" title_type="h2" title_align="text-center" font_size="xl" el_class="margin-bottom-10"][vc_tta_tabs alignment="center" title_font_size="l" tabs_display_type="2d-has-bg" tabs_bg_color="" el_class="letter-spacing-none"][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-orange" title="Fruits" tab_id="1655095615591-34d4eb8f-0124"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-fruit" title="Vegetables" tab_id="1655095615605-82862b21-9705"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-fast-food" title="Cream" tab_id="1655095615619-7171fc27-f88b"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-banana" title="Banana" tab_id="1655095615632-bd0b23ca-954b"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section section_nasa_icon="nasa-icon icon-nasa-fish" title="Sea Food" tab_id="1655117492748-887d6bcd-c011"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-bottom-80 mobile-margin-bottom-60 desktop-padding-top-60 desktop-padding-bottom-80 mobile-padding-top-50 mobile-padding-bottom-60" css=".vc_custom_1657011008888{background-color: #f7f6f3 !important;}"][vc_column el_class="margin-bottom-50 mobile-margin-bottom-30"][nasa_title title_text="Organic Fresh Vegetables" title_align="text-center" font_size="t" el_class="margin-bottom-0 primary-color"][nasa_title title_text="WHY PEOPLE CHOOSE US" title_align="text-center" font_size="xl"][/vc_column][vc_column css_animation="none" width="7/12" el_class="margin-top-35 mobile-margin-top-0 mobile-margin-bottom-60" offset="vc_col-lg-7 vc_col-md-5"][nasa_image image="' . $imgs_3 . '" align="center" el_class="heart-organic-farm"][/vc_column][vc_column width="5/12" el_class="nasa-clear-none mobile-padding-left-15" offset="vc_col-lg-5 vc_col-md-7"][vc_row_inner][vc_column_inner el_class="margin-bottom-30"][vc_single_image image="' . $imgs_4 . '" alignment="center" el_class="left rtl-right margin-right-20 rtl-margin-left-20 rtl-margin-right-0 margin-top-10 nasa-radius-55 primary-bg" css=".vc_custom_1657593149629{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}"][nasa_title title_text="100% Organic" title_type="h4" title_desc="Lorem Ipsum is simply dummy text of the printing and typesetting industry" font_size="l" el_class="nasa-clear-none"][/vc_column_inner][vc_column_inner el_class="margin-bottom-30"][vc_single_image image="' . $imgs_5 . '" alignment="center" el_class="left rtl-right margin-right-20 rtl-margin-left-20 rtl-margin-right-0 margin-top-10 nasa-radius-55 primary-bg" css=".vc_custom_1657593159629{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}"][nasa_title title_text="Pure Nature Juice" title_type="h4" title_desc="Lorem Ipsum is simply dummy text of the printing and typesetting industry" font_size="l" el_class="nasa-clear-none"][/vc_column_inner][vc_column_inner el_class="margin-bottom-30"][vc_single_image image="' . $imgs_6 . '" alignment="center" el_class="left rtl-right margin-right-20 rtl-margin-left-20 rtl-margin-right-0 margin-top-10 nasa-radius-55 primary-bg" css=".vc_custom_1657593170168{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}"][nasa_title title_text="Environmentally Products" title_desc="Lorem Ipsum is simply dummy text of the printing and typesetting industry" el_class="nasa-clear-none"][/vc_column_inner][vc_column_inner][vc_single_image image="' . $imgs_7 . '" alignment="center" el_class="left rtl-right margin-right-20 rtl-margin-left-20 rtl-margin-right-0 margin-top-10 nasa-radius-55 primary-bg" css=".vc_custom_1657593177132{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}"][nasa_title title_text="Food Safety" title_type="h4" title_desc="Lorem Ipsum is simply dummy text of the printing and typesetting industry" font_size="l" el_class="nasa-clear-none"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_class="margin-bottom-60 mobile-margin-top-50"][vc_column width="1/3" el_class="tablet-margin-bottom-20 mobile-margin-bottom-20"][nasa_title title_text="Top Rated" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="top_rate" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="tablet-margin-bottom-20 mobile-margin-bottom-20"][nasa_title title_text="Best Selling" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="best_selling" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][vc_column width="1/3" el_class="mobile-margin-bottom-20"][nasa_title title_text="On Sale" title_type="h4" font_size="m" el_class="margin-bottom-30"][nasa_products type="on_sale" style="list" number="3" columns_number="1" columns_number_tablet="1" columns_number_small="1"][/vc_column][/vc_row][vc_row fullwidth="1" el_class="margin-bottom-60" css=".vc_custom_1657593419152{background-image: url(' . $imgs_url_src_2 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}"][vc_column width="1/4" offset="vc_col-lg-3 vc_col-md-1" el_class="nasa-min-height"][/vc_column][vc_column width="1/2" el_class="padding-bottom-30" offset="vc_col-lg-6 vc_col-md-10"][nasa_slider navigation="false" column_number="1" column_number_small="1" column_number_tablet="1" autoplay="true"][nasa_client text_color="#555555" img_src="2883" name="John Doe" company="Web Developer"]"We connect buyers and sellers of natural, organic, environmentally sound products. The point of using Lorem Ipsum is that it has a more-or-less normal"[/nasa_client][nasa_client text_color="#555555" img_src="2883" name="Johnny" company="CEO &amp; Founder NasaTheme"]"Vestibulum quis porttitor dui! Quisque viverra nunc mi, a pulvinar purus condimentum a. Aliquam condimentum mattis neque sed pretium"[/nasa_client][/nasa_slider][/vc_column][vc_column width="1/4" offset="vc_col-lg-3 vc_col-md-1" el_class="nasa-min-height"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50 tablet-margin-bottom-0 mobile-margin-bottom-0"][vc_column][nasa_title title_text="Latest blog" title_desc="The freshest and most exciting news" title_align="text-center" font_size="xl" el_class="margin-bottom-30"][nasa_post arrows="1" posts="5" columns_number="3" columns_number_small_slider="1" columns_number_tablet="2" author_enable="no" page_blogs="no"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '1',
            // '_nasa_header_transparent' => '1',
            // '_nasa_fixed_nav' => '-1',
            // '_nasa_text_color_main_menu' => '#ffffff',
            // '_nasa_text_color_header' => '#ffffff',
            // '_nasa_topbar_on' => '2',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#6bad0d',
            // '_nasa_footer_mode' => 'builder',
            // '_nasa_custom_footer' => 'wpb-footer-light-2-bg',
            // '_nasa_custom_footer_mobile' => 'footer-mobile',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1657011008888{background-color: #f7f6f3 !important;}.vc_custom_1657593419152{background-image: url(' . $imgs_url_src_2 . ') !important;background-position: center !important;background-repeat: no-repeat !important;background-size: cover !important;}.vc_custom_1656924835214{border-top-width: 3px !important;border-right-width: 3px !important;border-bottom-width: 3px !important;border-left-width: 3px !important;padding-top: 10px !important;padding-right: 10px !important;padding-bottom: 10px !important;padding-left: 10px !important;border-left-color: #ffffff !important;border-left-style: solid !important;border-right-color: #ffffff !important;border-right-style: solid !important;border-top-color: #ffffff !important;border-top-style: solid !important;border-bottom-color: #ffffff !important;border-bottom-style: solid !important;}.vc_custom_1657593149629{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}.vc_custom_1657593159629{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}.vc_custom_1657593170168{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}.vc_custom_1657593177132{padding-top: 20px !important;padding-right: 15px !important;padding-bottom: 20px !important;padding-left: 15px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'fixed_nav' => '0',
            
            // 'plus_wide_width' => '400',
            'color_primary' => '#6bad0d',
            
            // 'bg_color_topbar' => '28aeb1',
            // 'text_color_topbar' => '#ffffff',
            
            // 'fullwidth_main_menu' => '1',
            
            // 'bg_color_main_menu' => '#e4272c',
            // 'text_color_main_menu' => '#ffffff',
            
            // 'text_color_header' => '#ffffff',
            
            // 'v_root' => '1',
            // 'v_root_limit' => '10',
            
            // 'bg_color_v_menu' => '#000000',
            // 'text_color_v_menu' => '#ffffff',
            
            'footer_mode' => 'builder',
            'footer-type' => 'wpb-footer-light-2-bg',
            'footer-mobile' => 'footer-mobile',
            
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
