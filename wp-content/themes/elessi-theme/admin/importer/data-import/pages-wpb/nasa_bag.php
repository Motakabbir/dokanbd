<?php
function nasa_wpb_bag() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/12/bag-testimonial-bg-2.jpg', '0', array(
        'post_title' => 'bag-testimonial-bg-2',
        'post_name' => 'bag-testimonial-bg-2',
    ));
    $imgs_1_src = $imgs_1 ? wp_get_attachment_image_url($imgs_1, 'full') : 'https://via.placeholder.com/1920x778';
    
    return array(
        'post' => array(
            'post_title' => 'WPB Bag',
            'post_name' => 'wpb-bag',
            'post_content' => '[vc_row fullwidth="1"][vc_column][nasa_rev_slider alias="slider-bag"][/vc_column][/vc_row][vc_row fullwidth="1"][vc_column][nasa_product_categories list_cats="coats-and-jackets-woman, dresses-woman, jeans-woman, knit-woman, outerwear-woman, puffer-jackets-woman, sweaters-woman" disp_type="Horizontal5" columns_number="6" columns_number_small="2" columns_number_tablet="4" auto_slide="false"][/vc_column][/vc_row][vc_row el_class="margin-top-60 margin-bottom-60"][vc_column][nasa_title title_text="Trendy item" title_type="h3" font_size="xl" title_align="text-center"][vc_tta_tabs alignment="center"][vc_tta_section hr="1" title="BACKPACKS" tab_id="1509680382515-609c6f4d-fd0e"][nasa_products columns_number="4" columns_number_small="1" columns_number_tablet="2" cat="men"][/vc_tta_section][vc_tta_section hr="1" title="HANDBAGS" tab_id="1509771354416-4988be9f-2227"][nasa_products columns_number="4" columns_number_small="1" columns_number_tablet="2" cat="woman"][/vc_tta_section][vc_tta_section hr="1" title="ON SALE" tab_id="1509957049380-e38870ed-5797"][nasa_products type="on_sale" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][vc_tta_section hr="1" title="FEATURED" tab_id="1509957137879-8aa83829-3ba3"][nasa_products type="featured_product" columns_number="4" columns_number_small="1" columns_number_tablet="2"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row parallax="content-moving" fullwidth="1" css=".vc_custom_1571650748649{background-image: url(' . $imgs_1_src . ') !important;}"][vc_column width="1/4"][vc_empty_space height="1px"][/vc_column][vc_column width="1/2"][nasa_slider navigation="false" autoplay="true"][nasa_client text_color="#555555" img_src="2883" name="Johnny" company="CEO &amp; Founder NasaTheme"]“Vestibulum quis porttitor dui! Quisque viverra nunc mi, a pulvinar purus condimentum a. Aliquam condimentum mattis neque sed pretium”[/nasa_client][nasa_client text_color="#555555" img_src="2883" name="Tommy" company="Web Developer"]“Vestibulum quis porttitor dui! Quisque viverra nunc mi, a pulvinar purus condimentum a. Aliquam condimentum mattis neque sed pretium”[/nasa_client][/nasa_slider][/vc_column][vc_column width="1/4"][vc_empty_space height="1px"][/vc_column][/vc_row][vc_row el_class="margin-top-80"][vc_column width="1/3"][nasa_products title_shortcode="Top Rated" type="top_rate" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="Best Selling" type="best_selling" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][vc_column width="1/3"][nasa_products title_shortcode="On Sale" type="on_sale" style="list_carousel" style_row="3" arrows="1" number="6" columns_number="1" columns_number_small="1" columns_number_tablet="1"][/vc_column][/vc_row][vc_row css=".vc_custom_1520494481735{border-radius: 1px !important;}" el_class="margin-top-80"][vc_column][nasa_title title_text="Latest blog" title_type="h3" font_size="xl" title_desc="The freshest and most exciting news" title_align="text-center" el_class="margin-bottom-30"][nasa_post auto_slide="true" dots="true" arrows="0" posts="5" columns_number="3" columns_number_small="1" columns_number_tablet="2" date_enable="no" author_enable="no" page_blogs="no"][/vc_column][/vc_row][vc_row el_class="margin-bottom-50"][vc_column][nasa_brands images="' . elessi_imp_brands_str() . '" columns_number="6" columns_number_tablet="4" columns_number_small="3" custom_links="#,#,#,#,#,#,#"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_custom_header' => '1',
            // '_nasa_header_transparent' => '1',
            '_wpb_shortcodes_custom_css' => '.vc_custom_1571650748649{background-image: url(' . $imgs_1_src . ') !important;}.vc_custom_1520494481735{border-radius: 1px !important;}'
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            // 'plus_wide_width' => '100',
            // 'color_primary' => '#3bb5e8',
            
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
            
            'product_detail_layout' => 'new-2',
            // 'product_image_layout' => 'single',
            'tab_style_info' => 'small-accordion',
            
            'loop_layout_buttons' => 'modern-1',
            
            'animated_products' => 'hover-carousel',
            
            // 'nasa_attr_image_style' => 'square'
        ),
    );
}
