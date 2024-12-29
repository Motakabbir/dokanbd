<?php
function nasa_wpb_pet_accessories() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2021/01/Pet_cat_01.jpg', '3094', array(
        'post_title' => 'Pet_cat_01',
        'post_name' => 'pet_cat_01',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2021/01/Pet_cat_02.jpg', '3094', array(
        'post_title' => 'Pet_cat_02',
        'post_name' => 'pet_cat_02',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2021/01/Pet_cat_03.jpg', '3108', array(
        'post_title' => 'Pet_cat_03',
        'post_name' => 'pet_cat_03',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2021/01/Pet_cat_04.jpg', '3108', array(
        'post_title' => 'Pet_cat_04',
        'post_name' => 'pet_cat_04',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2021/01/Pet_cat_05.jpg', '3108', array(
        'post_title' => 'Pet_cat_05',
        'post_name' => 'pet_cat_05',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2021/01/Pet_banner_01.jpg', '3117', array(
        'post_title' => 'Pet_banner_01',
        'post_name' => 'pet_banner_01',
    ));
    
    $imgs_7 = elessi_import_upload('/wp-content/uploads/2021/01/Pet_banner_02.jpg', '3117', array(
        'post_title' => 'Pet_banner_02',
        'post_name' => 'pet_banner_02',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'WPB Pet Accessories',
            'post_name' => 'wpb-pet-accessories',
            'post_content' => '[vc_row fullwidth="1" el_class="margin-bottom-50"][vc_column][nasa_rev_slider slidertitle="Slider Pet Accessories" alias="slider-pet-accessories"][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column][nasa_title title_text="Featured Categories" title_type="h3" font_size="l" title_desc="The freshest and most exciting news" title_align="text-center"][/vc_column][/vc_row][vc_row][vc_column width="1/2"][nasa_banner valign="bottom" hover="zoom" img_src="' . $imgs_1 . '"]
<div><a style="background-color: #fff; font-size: 120%; padding: 10px 40px;" title="Harness" href="#"><strong>Harness</strong></a></div>
[/nasa_banner][/vc_column][vc_column width="1/2"][nasa_banner valign="bottom" hover="zoom" img_src="' . $imgs_2 . '"]
<div><a style="background-color: #fff; font-size: 120%; padding: 10px 40px;" title="Harness" href="#"><strong>Shipping Bag</strong></a></div>
[/nasa_banner][/vc_column][/vc_row][vc_row el_class="margin-bottom-30"][vc_column width="1/3"][nasa_banner valign="bottom" img_src="' . $imgs_3 . '"]
<div><a style="background-color: #fff; font-size: 120%; padding: 10px 40px;" title="Meal" href="#"><strong>Meal</strong></a></div>
[/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner valign="bottom" img_src="' . $imgs_4 . '"]
<div><a style="background-color: #fff; font-size: 120%; padding: 10px 40px;" title="Home" href="#"><strong>Home</strong></a></div>
[/nasa_banner][/vc_column][vc_column width="1/3"][nasa_banner valign="bottom" img_src="' . $imgs_5 . '"]
<div><a style="background-color: #fff; font-size: 120%; padding: 10px 40px;" title="Clothes" href="#"><strong>Clothes</strong></a></div>
[/nasa_banner][/vc_column][/vc_row][vc_row][vc_column][nasa_title title_text="Recommend For You" title_type="h3" font_size="l" title_align="text-center" el_class="margin-bottom-10"][vc_tta_tabs alignment="center" tabs_display_type="2d-radius-dashed"][vc_tta_section title="BEST SELLER" tab_id="1596708228738-17953d91-53db"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="HARNESS" tab_id="1596708230330-4a2f8401-99c3"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="MEAL" tab_id="1596708231252-34e7b24b-5d0f"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="HOME" tab_id="1596708232082-542f3886-2ffd"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="SHIPPING BAGS" tab_id="1596708232914-0ac172a9-a490"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][vc_tta_section title="CLOTHES" tab_id="1610168323962-c1815862-b931"][nasa_products columns_number="4" columns_number_tablet="3"][/vc_tta_section][/vc_tta_tabs][/vc_column][/vc_row][vc_row el_class="margin-top-20"][vc_column width="1/2"][nasa_banner align="right" valign="middle" effect_text="fadeInLeft" hover="zoom" img_src="' . $imgs_6 . '"]
<h3 style="font-size: 220%; margin-bottom: 0; font-weight: bold;">New Arrivals</h3>
<h5 style="text-decoration: underline;"><a style="font-size: 75%; font-weight: 500; margin-bottom: 0;" title="Shop More" href="#">Shop More</a></h5>
[/nasa_banner][/vc_column][vc_column width="1/2"][nasa_banner align="right" valign="middle" effect_text="fadeInDownBig" hover="reduction" img_src="' . $imgs_7 . '"]
<h3 style="font-size: 220%; margin-bottom: 0; font-weight: bold;">Accessories For Pets</h3>
<h5 style="text-decoration: underline;"><a style="font-size: 85%; font-weight: 500;" title="Shop Now" href="#">Shop now</a></h5>
[/nasa_banner][/vc_column][/vc_row][vc_row][vc_column][nasa_title title_text="Latest Blogs" title_type="h3" font_size="l" title_desc="The freshest and most exciting news" title_align="text-center" el_class="margin-top-30 mobile-margin-top-50 margin-bottom-30"][nasa_post arrows="1" posts="4" columns_number="3" columns_number_small_slider="1" columns_number_tablet="2" date_enable="no" author_enable="no" page_blogs="no" el_class="desktop-margin-bottom-80"][/vc_column][/vc_row]'
        ),
        'post_meta' => array(
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#f8ce46',
            // '_nasa_type_font_select' => 'google',
            // '_nasa_type_headings' => 'Dosis',
            // '_nasa_type_texts' => 'Dosis',
            // '_nasa_type_nav' => 'Dosis',
            // '_nasa_type_banner' => 'Dosis',
            // '_nasa_type_price' => 'Dosis',
            // '_nasa_font_weight' => '900',
        ),
        
        'globals' => array(
            'header-type' => '1',
            
            'color_primary' => '#f8ce46',
            
            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            
            // 'category_sidebar' => 'right-classic',
            
            'product_detail_layout' => 'new-2',
            // 'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
            // 'sp_bgl' => '#f6f6f6',
            'tab_style_info' => 'small-accordion',
            
            // 'single_product_thumbs_style' => 'hoz',
            
            'loop_layout_buttons' => 'modern-3',
            
            // 'animated_products' => 'hover-zoom',
            
            // 'nasa_attr_image_style' => 'square',
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
