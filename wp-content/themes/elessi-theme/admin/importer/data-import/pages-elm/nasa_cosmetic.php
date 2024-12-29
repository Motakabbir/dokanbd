<?php
function nasa_elm_cosmetic() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2019/10/ourwork-bg.jpg', '0', array(
        'post_title' => 'ourwork-bg',
        'post_name' => 'ourwork-bg',
    ));
    $imgs_1_src = $imgs_1 ? wp_get_attachment_image_url($imgs_1, 'full') : 'https://via.placeholder.com/1920x650?text=1920x650';
    
    $brand_1 = elessi_import_upload('/wp-content/uploads/2017/09/brand-1.jpg', '3074', array(
        'post_title' => 'Brand IMG 1',
        'post_name' => 'brand-1',
    ));
    $brand_2 = elessi_import_upload('/wp-content/uploads/2017/09/brand-2.jpg', '3074', array(
        'post_title' => 'Brand IMG 2',
        'post_name' => 'brand-2',
    ));
    $brand_3 = elessi_import_upload('/wp-content/uploads/2017/09/brand-3.jpg', '3074', array(
        'post_title' => 'Brand IMG 3',
        'post_name' => 'brand-3',
    ));
    $brand_4 = elessi_import_upload('/wp-content/uploads/2017/09/brand-4.jpg', '3074', array(
        'post_title' => 'Brand IMG 4',
        'post_name' => 'brand-4',
    ));
    $brand_5 = elessi_import_upload('/wp-content/uploads/2017/09/brand-5.jpg', '3074', array(
        'post_title' => 'Brand IMG 5',
        'post_name' => 'brand-5',
    ));
    $brand_6 = elessi_import_upload('/wp-content/uploads/2017/09/brand-6.jpg', '3074', array(
        'post_title' => 'Brand IMG 6',
        'post_name' => 'brand-6',
    ));
    
    return array(
        'post' => array(
            'post_title' => 'ELM Cosmetic',
            'post_name' => 'elm-cosmetic'
        ),
        
        'post_meta' => array(
            '_elementor_data' => '[{"id":"73c558bd","elType":"section","settings":{"layout":"full_width","gap":"no"},"elements":[{"id":"2f980ef0","elType":"column","settings":{"_column_size":100,"_inline_size":null,"css_classes":"nasa-crazy-box"},"elements":[{"id":"9552d8f","elType":"widget","settings":{"revslidertitle":"Slider Cosmetic","shortcode":"[rev_slider alias=\"slider-Cosmetic\" slidertitle=\"Slider Cosmetic\"][\/rev_slider]"},"elements":[],"widgetType":"slider_revolution"}],"isInner":false}],"isInner":false},{"id":"1f071b61","elType":"section","settings":{"css_classes":"margin-top-40"},"elements":[{"id":"6354f88e","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"2b8f9ece","elType":"widget","settings":{"wp":{"title":"","text":"<h1 class=\"text-center\" style=\"font-weight: 800;\">\"Join hands with the community to defeat the Covid-19 disease.\"<\/h1>\r\n<p class=\"text-center\"><span style=\"font-weight: 900; color: #000; letter-spacing: 3px;\">JOHN DOE<\/span> \/ CEO Elessi<\/p>","filter":"on","visual":"on"}},"elements":[],"widgetType":"wp-widget-text"}],"isInner":false}],"isInner":false},{"id":"6f977756","elType":"section","settings":{"css_classes":"margin-bottom-30"},"elements":[{"id":"3d09784a","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"15dc659d","elType":"widget","settings":{"wp":{"title":"","desc":"","alignment":"center","style":"2d-radius","tabs":{"1603386304507":{"tab_title":"ALL","type":"recent_product","style":"carousel","style_viewmore":"1","style_row":"1","pos_nav":"both","title_align":"left","shop_url":"1","arrows":"1","dots":"false","auto_slide":"false","number":"6","auto_delay_time":"6","columns_number":"5","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""},"1603386427250":{"tab_title":"WOMEN","type":"recent_product","style":"carousel","style_viewmore":"1","style_row":"1","pos_nav":"both","title_align":"left","shop_url":"0","arrows":"0","dots":"false","auto_slide":"false","number":"6","auto_delay_time":"6","columns_number":"5","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""},"1603386467942":{"tab_title":"ON SALE","type":"recent_product","style":"carousel","style_viewmore":"1","style_row":"1","pos_nav":"both","title_align":"left","shop_url":"1","arrows":"0","dots":"false","auto_slide":"false","number":"6","auto_delay_time":"6","columns_number":"5","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""},"1603386510457":{"tab_title":"NEW","type":"recent_review","style":"carousel","style_viewmore":"1","style_row":"1","pos_nav":"both","title_align":"left","shop_url":"1","arrows":"0","dots":"false","auto_slide":"false","number":"6","auto_delay_time":"6","columns_number":"5","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""}},"el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_products_tabs_sc"}],"isInner":false}],"isInner":false},{"id":"3d67efb8","elType":"section","settings":[],"elements":[{"id":"29159def","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"613223be","elType":"widget","settings":{"title":"Our work","size":"large","align":"center","title_color":"#333333","typography_typography":"custom","typography_font_family":"Jost","typography_font_weight":"800","header_size":"h3","_css_classes":"margin-bottom-5"},"elements":[],"widgetType":"heading"},{"id":"16d13725","elType":"widget","settings":{"html":"<p class=\"nasa-title-desc text-center margin-bottom-0\">More than 300 makeup projects in the portfolio<\/p>"},"elements":[],"widgetType":"html"}],"isInner":false}],"isInner":false},{"id":"59596f2d","elType":"section","settings":{"structure":"30","background_background":"classic","background_image":{"id":3661,"url":' . json_encode($imgs_1_src) . '},"background_position":"top center","background_size":"cover","css_classes":"margin-top-40 padding-top-80 padding-bottom-80"},"elements":[{"id":"fa6530f","elType":"column","settings":{"_column_size":33,"_inline_size":null},"elements":[{"id":"4cd85c3b","elType":"widget","settings":{"wp":{"title":"Before - After Makeup","link":"#","desc_text":"Lorem Ipsum has been the industry\u2019s standard dummy text ever since the 1500s.","align_text":"center","before_image":"3029","after_image":"3028","el_class_img":"skip-lazy","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_compare_imgs_sc"}],"isInner":false},{"id":"1b3d0ccf","elType":"column","settings":{"_column_size":33,"_inline_size":null},"elements":[{"id":"3da63858","elType":"widget","settings":{"wp":{"title":"Before - After Makeup","link":"#","desc_text":"Lorem Ipsum has been the industry\u2019s standard dummy text ever since the 1500s.","align_text":"center","before_image":"3029","after_image":"3028","el_class_img":"skip-lazy","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_compare_imgs_sc"}],"isInner":false},{"id":"9f18962","elType":"column","settings":{"_column_size":33,"_inline_size":null},"elements":[{"id":"a543be9","elType":"widget","settings":{"wp":{"title":"Before - After Makeup","link":"#","desc_text":"Lorem Ipsum has been the industry\u2019s standard dummy text ever since the 1500s.","align_text":"center","before_image":"3029","after_image":"3028","el_class_img":"skip-lazy","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_compare_imgs_sc"}],"isInner":false}],"isInner":false},{"id":"48800053","elType":"section","settings":{"css_classes":"margin-top-50"},"elements":[{"id":"2373e67c","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"50027d1","elType":"widget","settings":{"title":"Latest blog","size":"large","header_size":"h3","align":"center","title_color":"#000000","typography_typography":"custom","typography_font_family":"Jost","typography_font_weight":"800","_css_classes":"margin-bottom-5"},"elements":[],"widgetType":"heading"},{"id":"1496e1d0","elType":"widget","settings":{"wp":{"title":"","content":"<p class=\"nasa-title-desc text-center margin-bottom-0\">The freshest and most exctings news<\/p>"}},"elements":[],"widgetType":"wp-widget-custom_html"},{"id":"5742f34a","elType":"widget","settings":{"wp":{"title":"","show_type":"slide","auto_slide":"false","arrows":"1","dots":"true","posts":"4","columns_number":"3","columns_number_small":"1","columns_number_small_slider":"1","columns_number_tablet":"2","category":"","cats_enable":"yes","date_enable":"yes","author_enable":"yes","readmore":"yes","date_author":"bot","des_enable":"no","page_blogs":"no","info_align":"left","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_post_sc"}],"isInner":false}],"isInner":false},{"id":"bcde474","elType":"section","settings":{"css_classes":"margin-top-30 margin-bottom-50"},"elements":[{"id":"0699390","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"1a7f6b4","elType":"widget","settings":{"wp":{"title":"","align":"center","sliders":{"1605886645649":{"img_src":"' . $brand_1 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886663901":{"img_src":"' . $brand_2 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886673562":{"img_src":"' . $brand_3 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886691185":{"img_src":"' . $brand_4 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886702478":{"img_src":"' . $brand_5 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886713208":{"img_src":"' . $brand_6 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""}},"bullets":"false","bullets_pos":"","bullets_align":"center","navigation":"true","column_number":"6","column_number_small":"3","column_number_tablet":"4","padding_item":"","padding_item_small":"","padding_item_medium":"","autoplay":"false","paginationspeed":"300","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_sliders_sc"}],"isInner":false}],"isInner":false}]',
            '_elementor_controls_usage' => 'a:11:{s:27:"wp-widget-rev-slider-widget";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:6:"column";a:3:{s:5:"count";i:9;s:15:"control_percent";i:0;s:8:"controls";a:1:{s:6:"layout";a:1:{s:6:"layout";a:1:{s:12:"_inline_size";i:9;}}}}s:7:"section";a:3:{s:5:"count";i:7;s:15:"control_percent";i:0;s:8:"controls";a:3:{s:6:"layout";a:2:{s:14:"section_layout";a:2:{s:6:"layout";i:1;s:3:"gap";i:1;}s:17:"section_structure";a:1:{s:9:"structure";i:1;}}s:8:"advanced";a:1:{s:16:"section_advanced";a:1:{s:11:"css_classes";i:5;}}s:5:"style";a:1:{s:18:"section_background";a:4:{s:21:"background_background";i:1;s:16:"background_image";i:1;s:19:"background_position";i:1;s:15:"background_size";i:1;}}}}s:14:"wp-widget-text";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:31:"wp-widget-nasa_products_tabs_sc";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:7:"heading";a:3:{s:5:"count";i:2;s:15:"control_percent";i:4;s:8:"controls";a:3:{s:7:"content";a:1:{s:13:"section_title";a:4:{s:5:"title";i:2;s:4:"size";i:2;s:5:"align";i:2;s:11:"header_size";i:2;}}s:5:"style";a:1:{s:19:"section_title_style";a:4:{s:11:"title_color";i:2;s:21:"typography_typography";i:2;s:22:"typography_font_family";i:2;s:22:"typography_font_weight";i:2;}}s:8:"advanced";a:1:{s:14:"_section_style";a:1:{s:12:"_css_classes";i:2;}}}}s:4:"html";a:3:{s:5:"count";i:1;s:15:"control_percent";i:1;s:8:"controls";a:1:{s:7:"content";a:1:{s:13:"section_title";a:1:{s:4:"html";i:1;}}}}s:30:"wp-widget-nasa_compare_imgs_sc";a:3:{s:5:"count";i:3;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:21:"wp-widget-custom_html";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:22:"wp-widget-nasa_post_sc";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:25:"wp-widget-nasa_sliders_sc";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}}',
            '_elementor_css' => 'a:6:{s:4:"time";i:1639648759;s:5:"fonts";a:1:{i:0;s:4:"Jost";}s:5:"icons";a:0:{}s:20:"dynamic_elements_ids";a:0:{}s:6:"status";s:4:"file";i:0;s:0:"";}',
            // '_nasa_pri_color_flag' => 'on',
            // '_nasa_pri_color' => '#d69200',
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
            
            'footer_mode' => 'builder-e',
            'footer_elm' => elessi_elm_fid_by_slug('hfe-footer-light-2'),
            'footer_elm_mobile' => elessi_elm_fid_by_slug('hfe-footer-mobile'),
            
            // 'category_sidebar' => 'top-2',
            
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

        'css' => '.elementor-[inserted_id] .elementor-element.elementor-element-613223be{text-align:center;}.elementor-[inserted_id] .elementor-element.elementor-element-613223be .elementor-heading-title{color:#333333;font-family:"Jost", Sans-serif;font-weight:800;}.elementor-[inserted_id] .elementor-element.elementor-element-59596f2d:not(.elementor-motion-effects-element-type-background), .elementor-[inserted_id] .elementor-element.elementor-element-59596f2d > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image:url("' . $imgs_1_src . '");background-position:top center;background-size:cover;}.elementor-[inserted_id] .elementor-element.elementor-element-59596f2d{transition:background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;}.elementor-[inserted_id] .elementor-element.elementor-element-59596f2d > .elementor-background-overlay{transition:background 0.3s, border-radius 0.3s, opacity 0.3s;}.elementor-[inserted_id] .elementor-element.elementor-element-50027d1{text-align:center;}.elementor-[inserted_id] .elementor-element.elementor-element-50027d1 .elementor-heading-title{color:#000000;font-family:"Jost", Sans-serif;font-weight:800;}'
    );
}
