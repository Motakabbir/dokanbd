<?php
function nasa_elm_fashion_5() {
    $imgs_1 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner1.jpg', '3105', array(
        'post_title' => 'h2-banner1',
        'post_name' => 'h2-banner1',
    ));
    
    $imgs_2 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner1-1.jpg', '3105', array(
        'post_title' => 'h2-banner1-1',
        'post_name' => 'h2-banner1-1',
    ));
    
    $imgs_3 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner-deal1.jpg', '3106', array(
        'post_title' => 'h2-banner-deal1',
        'post_name' => 'h2-banner-deal1',
    ));
    
    $imgs_4 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner2.jpg', '3108', array(
        'post_title' => 'h2-banner2',
        'post_name' => 'h2-banner2',
    ));
    
    $imgs_5 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner2.jpg', '3108', array(
        'post_title' => 'h2-banner2',
        'post_name' => 'h2-banner2',
    ));
    
    $imgs_6 = elessi_import_upload('/wp-content/uploads/2018/03/h2-banner4.jpg', '3108', array(
        'post_title' => 'h2-banner4',
        'post_name' => 'h2-banner4',
    ));
    
    $imgs_7 = elessi_import_upload('/wp-content/uploads/2018/03/parallax_bg_6.jpg', '0', array(
        'post_title' => 'parallax_bg_6',
        'post_name' => 'parallax_bg_6',
    ));
    $imgs_7_src = $imgs_7 ? wp_get_attachment_image_url($imgs_7, 'full') : 'https://via.placeholder.com/1920x1500?text=1920x1500';
    
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
    
    $result = array(
        'post' => array(
            'post_title' => 'ELM Fashion V5',
            'post_name' => 'elm-fashion-v5'
        ),
        
        'post_meta' => array(
            '_elementor_data' => '[{"id":"56cf6c1e","elType":"section","settings":{"structure":"21","css_classes":"margin-top-10 mobile-margin-top-0 mobile-margin-bottom-10"},"elements":[{"id":"732cad5d","elType":"column","settings":{"_column_size":33,"_inline_size":66.167,"padding_mobile":{"unit":"px","top":"0","right":"10","bottom":"10","left":"10","isLinked":false}},"elements":[{"id":"3d9c9a64","elType":"widget","settings":{"wp":{"title":"","align":"left","sliders":{"1603439884809":{"img_src":"' . $imgs_1 . '","height":"570","width":"","link":"","content-width":"","align":"right","move_x":"","valign":"top","text-align":"text-right","banner_responsive":"yes","content":"<h5 style=\"color: #333; font-weight: bold; font-size: 180%;\">Autumn\r\n&amp; Winter 2019<\/h5>\r\n<h6 style=\"color: #999;\">Enjoy this fall trend<\/h6>","effect_text":"flipInX","data_delay":"","hover":"","border_inner":"no","border_outner":"no","hide_in_m":"","el_class":"mobile-font-size-150"},"1603440008793":{"img_src":"' . $imgs_2 . '","height":"570","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"<h5 style=\"color: #333; font-weight: bold; font-size: 180%;\">New Arrival 2019<\/h5>\r\n<h6 style=\"color: #999;\">Enjoy this fall trend<\/h6>","effect_text":"fadeInUp","data_delay":"","hover":"","border_inner":"no","border_outner":"no","hide_in_m":"","el_class":"mobile-font-size-150"}},"bullets":"false","bullets_pos":"","bullets_align":"center","navigation":"false","column_number":"1","column_number_small":"1","column_number_tablet":"1","padding_item":"","padding_item_small":"","padding_item_medium":"","force":"true","autoplay":"true","paginationspeed":"800","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_sliders_sc"}],"isInner":false},{"id":"7ae7ed51","elType":"column","settings":{"_column_size":66,"_inline_size":33.499,"space_between_widgets":0,"padding":{"unit":"px","top":"10","right":"5","bottom":"10","left":"10","isLinked":false},"padding_mobile":{"unit":"px","top":"0","right":"10","bottom":"0","left":"10","isLinked":false}},"elements":[{"id":"5bdafeee","elType":"widget","settings":{"wp":{"img_src":"' . $imgs_3 . '","height":"566","width":"386","link":"#","content-width":"","align":"center","move_x":"","valign":"bottom","text-align":"text-center","banner_responsive":"yes","content":"<div>\r\n\r\n&nbsp;\r\n<h5 class=\"margin-bottom-20\" style=\"font-weight: bold\">Sale Off 30%<\/h5>\r\n[nasa_countdown date=\"2025-12-30\"]\r\n\r\n<\/div>","effect_text":"fadeInLeft","data_delay":"400ms","hover":"","border_inner":"no","border_outner":"no","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_banner_sc"}],"isInner":false}],"isInner":false},{"id":"365eb4ad","elType":"section","settings":{"structure":"30"},"elements":[{"id":"21d5e101","elType":"column","settings":{"_column_size":33,"_inline_size":33.167,"padding_mobile":{"unit":"px","top":"0","right":"10","bottom":"10","left":"10","isLinked":false}},"elements":[{"id":"72ba787c","elType":"widget","settings":{"wp":{"img_src":"' . $imgs_4 . '","height":"430","width":"","link":"#","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"<h5 style=\"color: #333;font-weight: bold;font-size: 180%\">Flower Handbag<\/h5>\r\n<h6 style=\"color: #999\">Woman &amp; Bag<\/h6>","effect_text":"fadeInLeft","data_delay":"600ms","hover":"zoom","border_inner":"no","border_outner":"no","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_banner_sc"}],"isInner":false},{"id":"53938115","elType":"column","settings":{"_column_size":33,"_inline_size":33.165,"padding_mobile":{"unit":"px","top":"0","right":"10","bottom":"10","left":"10","isLinked":false}},"elements":[{"id":"283983e5","elType":"widget","settings":{"wp":{"img_src":"' . $imgs_5 . '","height":"431px","width":"","link":"#","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"<h5 style=\"color: #333;font-weight: bold;font-size: 180%\">Mesh sneakers<\/h5>\r\n<h6 style=\"color: #999\">Men &amp; Shoes<\/h6>","effect_text":"flipInX","data_delay":"600ms","hover":"zoom","border_inner":"no","border_outner":"no","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_banner_sc"}],"isInner":false},{"id":"195c24da","elType":"column","settings":{"_column_size":33,"_inline_size":null,"padding":{"unit":"px","top":"10","right":"5","bottom":"10","left":"10","isLinked":false},"padding_mobile":{"unit":"px","top":"0","right":"10","bottom":"10","left":"10","isLinked":false}},"elements":[{"id":"76d49d4","elType":"widget","settings":{"wp":{"img_src":"' . $imgs_6 . '","height":"428","width":"385","link":"#","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"<h5 style=\"color: #333;font-weight: bold;font-size: 180%\">Baseball cap<\/h5>\r\n<h6 style=\"color: #999\">Accessories<\/h6>","effect_text":"flipInX","data_delay":"600ms","hover":"zoom","border_inner":"no","border_outner":"no","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_banner_sc"}],"isInner":false}],"isInner":false},{"id":"1b59cb4","elType":"section","settings":{"css_classes":"margin-top-50 margin-bottom-50"},"elements":[{"id":"32da93cf","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"16ac8930","elType":"widget","settings":{"title":"Our Products","size":"large","header_size":"h3","align":"center","title_color":"#000000","typography_typography":"custom","typography_font_family":"Jost","typography_font_weight":"800","_css_classes":"margin-bottom-10"},"elements":[],"widgetType":"heading"},{"id":"1204dff6","elType":"widget","settings":{"wp":{"title":"","desc":"","alignment":"center","style":"2d-no-border","tabs":{"1603441276159":{"tab_title":"FEATURED","type":"recent_product","style":"grid","style_viewmore":"1","style_row":"2","pos_nav":"top","title_align":"left","shop_url":"0","arrows":"1","dots":"false","auto_slide":"false","number":"8","auto_delay_time":"6","columns_number":"4","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""},"1603441346848":{"tab_title":"BEST SELLING","type":"recent_product","style":"grid","style_viewmore":"1","style_row":"2","pos_nav":"top","title_align":"left","shop_url":"0","arrows":"0","dots":"false","auto_slide":"false","number":"8","auto_delay_time":"6","columns_number":"4","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""},"1603441402675":{"tab_title":"ON SALE","type":"recent_product","style":"grid","style_viewmore":"1","style_row":"2","pos_nav":"top","title_align":"left","shop_url":"1","arrows":"0","dots":"false","auto_slide":"false","number":"8","auto_delay_time":"6","columns_number":"4","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""},"1603441452458":{"tab_title":"TOP RATED","type":"recent_product","style":"grid","style_viewmore":"1","style_row":"2","pos_nav":"top","title_align":"left","shop_url":"1","arrows":"0","dots":"false","auto_slide":"false","number":"8","auto_delay_time":"6","columns_number":"4","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""},"1603441543001":{"tab_title":"RECENT","type":"recent_product","style":"grid","style_viewmore":"1","style_row":"1","pos_nav":"top","title_align":"left","shop_url":"0","arrows":"1","dots":"false","auto_slide":"false","number":"8","auto_delay_time":"6","columns_number":"4","columns_number_small":"2","columns_number_small_slider":"2","columns_number_tablet":"3","cat":"","not_in":"","el_class":""}},"el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_products_tabs_sc"}],"isInner":false}],"isInner":false},{"id":"5c8c0951","elType":"section","settings":{"background_background":"classic","background_image":{"id":3353,"url":' . json_encode($imgs_7_src) . '},"background_overlay_background":"classic","css_classes":"desktop-padding-left-80 margin-bottom-70 padding-top-70 padding-bottom-70 mobile-margin-bottom-50","background_position":"bottom center","background_xpos":{"unit":"px","size":-138,"sizes":[]},"background_repeat":"no-repeat","background_size":"cover"},"elements":[{"id":"63aea499","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"29810b1e","elType":"section","settings":{"structure":"20"},"elements":[{"id":"169c8260","elType":"column","settings":{"_column_size":50,"_inline_size":null},"elements":[{"id":"294dafc9","elType":"widget","settings":{"wp":{"limit":"3","cat":"","style":"for_time","title":"Deal of the week","desc_shortcode":"Sale 35% for all T-Shirt products","date_sc":"2025-12-30","columns_number":"2","columns_number_small":"2","columns_number_tablet":"2","statistic":"1","arrows":"1","auto_slide":"true","el_class":"text-color-white"}},"elements":[],"widgetType":"wp-widget-nasa_products_special_deal_sc"}],"isInner":true},{"id":"6c301b5b","elType":"column","settings":{"_column_size":50,"_inline_size":null},"elements":[],"isInner":true}],"isInner":true}],"isInner":false}],"isInner":false},{"id":"7c8e6775","elType":"section","settings":{"structure":"30"},"elements":[{"id":"50f581aa","elType":"column","settings":{"_column_size":33,"_inline_size":null},"elements":[{"id":"7257835f","elType":"widget","settings":{"title":"Top Rated","header_size":"h3","title_color":"#000000","typography_typography":"custom","typography_font_family":"Jost","typography_font_weight":"800","_css_classes":"margin-bottom-30"},"elements":[],"widgetType":"heading"},{"id":"15e9f0e1","elType":"widget","settings":{"wp":{"title_shortcode":"","type":"recent_product","style":"list","style_viewmore":"1","style_row":"3","pos_nav":"top","title_align":"left","shop_url":"1","arrows":"1","dots":"false","auto_slide":"false","number":"3","auto_delay_time":"6","columns_number":"1","columns_number_small":"1","columns_number_small_slider":"1","columns_number_tablet":"1","cat":"","not_in":"","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_products_sc"}],"isInner":false},{"id":"61643785","elType":"column","settings":{"_column_size":33,"_inline_size":null},"elements":[{"id":"288557ec","elType":"widget","settings":{"title":"Best Selling","header_size":"h3","title_color":"#000000","typography_typography":"custom","typography_font_family":"Jost","typography_font_weight":"800","_css_classes":"margin-bottom-30"},"elements":[],"widgetType":"heading"},{"id":"2bc9b26d","elType":"widget","settings":{"wp":{"title_shortcode":"","type":"recent_product","style":"list","style_viewmore":"1","style_row":"3","pos_nav":"top","title_align":"left","shop_url":"1","arrows":"1","dots":"false","auto_slide":"false","number":"3","auto_delay_time":"6","columns_number":"1","columns_number_small":"1","columns_number_small_slider":"1","columns_number_tablet":"1","cat":"","not_in":"","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_products_sc"}],"isInner":false},{"id":"fed8b97","elType":"column","settings":{"_column_size":33,"_inline_size":null},"elements":[{"id":"662cdd83","elType":"widget","settings":{"title":"On Sale","header_size":"h3","title_color":"#000000","typography_typography":"custom","typography_font_family":"Jost","typography_font_weight":"800","_css_classes":"margin-bottom-30"},"elements":[],"widgetType":"heading"},{"id":"6ca64142","elType":"widget","settings":{"wp":{"title_shortcode":"","type":"recent_product","style":"list","style_viewmore":"1","style_row":"3","pos_nav":"top","title_align":"left","shop_url":"1","arrows":"1","dots":"false","auto_slide":"false","number":"3","auto_delay_time":"6","columns_number":"1","columns_number_small":"1","columns_number_small_slider":"1","columns_number_tablet":"1","cat":"","not_in":"","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_products_sc"}],"isInner":false}],"isInner":false},{"id":"168b8b3","elType":"section","settings":{"css_classes":"margin-top-30 margin-bottom-50"},"elements":[{"id":"e73918d","elType":"column","settings":{"_column_size":100,"_inline_size":null},"elements":[{"id":"a537eea","elType":"widget","settings":{"wp":{"title":"","align":"center","sliders":{"1605886645649":{"img_src":"' . $brand_1 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886663901":{"img_src":"' . $brand_2 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886673562":{"img_src":"' . $brand_3 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886691185":{"img_src":"' . $brand_4 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886702478":{"img_src":"' . $brand_5 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""},"1605886713208":{"img_src":"' . $brand_6 . '","height":"","width":"","link":"","content-width":"","align":"left","move_x":"","valign":"top","text-align":"text-left","banner_responsive":"yes","content":"","effect_text":"none","data_delay":"","hover":"","border_inner":"no","border_outner":"no","el_class":""}},"bullets":"false","bullets_pos":"","bullets_align":"center","navigation":"true","column_number":"6","column_number_small":"3","column_number_tablet":"4","padding_item":"","padding_item_small":"","padding_item_medium":"","autoplay":"false","paginationspeed":"300","el_class":""}},"elements":[],"widgetType":"wp-widget-nasa_sliders_sc"}],"isInner":false}],"isInner":false}]',
            '_elementor_controls_usage' => 'a:8:{s:25:"wp-widget-nasa_sliders_sc";a:3:{s:5:"count";i:2;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:6:"column";a:3:{s:5:"count";i:13;s:15:"control_percent";i:0;s:8:"controls";a:2:{s:6:"layout";a:1:{s:6:"layout";a:2:{s:12:"_inline_size";i:13;s:21:"space_between_widgets";i:1;}}s:8:"advanced";a:1:{s:16:"section_advanced";a:1:{s:7:"padding";i:2;}}}}s:24:"wp-widget-nasa_banner_sc";a:3:{s:5:"count";i:4;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:7:"section";a:3:{s:5:"count";i:7;s:15:"control_percent";i:0;s:8:"controls";a:3:{s:6:"layout";a:1:{s:17:"section_structure";a:1:{s:9:"structure";i:4;}}s:8:"advanced";a:1:{s:16:"section_advanced";a:1:{s:11:"css_classes";i:4;}}s:5:"style";a:2:{s:18:"section_background";a:6:{s:21:"background_background";i:1;s:16:"background_image";i:1;s:19:"background_position";i:1;s:15:"background_xpos";i:1;s:17:"background_repeat";i:1;s:15:"background_size";i:1;}s:26:"section_background_overlay";a:1:{s:29:"background_overlay_background";i:1;}}}}s:7:"heading";a:3:{s:5:"count";i:4;s:15:"control_percent";i:4;s:8:"controls";a:3:{s:7:"content";a:1:{s:13:"section_title";a:4:{s:5:"title";i:4;s:4:"size";i:1;s:11:"header_size";i:4;s:5:"align";i:1;}}s:5:"style";a:1:{s:19:"section_title_style";a:4:{s:11:"title_color";i:4;s:21:"typography_typography";i:4;s:22:"typography_font_family";i:4;s:22:"typography_font_weight";i:4;}}s:8:"advanced";a:1:{s:14:"_section_style";a:1:{s:12:"_css_classes";i:4;}}}}s:31:"wp-widget-nasa_products_tabs_sc";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:39:"wp-widget-nasa_products_special_deal_sc";a:3:{s:5:"count";i:1;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}s:26:"wp-widget-nasa_products_sc";a:3:{s:5:"count";i:3;s:15:"control_percent";i:0;s:8:"controls";a:0:{}}}',
            '_elementor_css' => 'a:6:{s:4:"time";i:1638688748;s:5:"fonts";a:1:{i:0;s:4:"Jost";}s:5:"icons";a:0:{}s:20:"dynamic_elements_ids";a:0:{}s:6:"status";s:4:"file";i:0;s:0:"";}',
            
            // '_nasa_custom_header' => '2',
            // '_nasa_fullwidth_main_menu' => '-1',
            // '_nasa_footer_mode' => 'build-in',
            // '_nasa_footer_build_in' => '4',
            // '_nasa_footer_build_in_mobile' => 'm-1'
        ),
        
        'globals' => array(
            'header-type' => '2',
            
            'fixed_nav' => '0',
            
            'fullwidth_main_menu' => '0',
            
            'footer_mode' => 'builder-e',
            'footer_elm' => elessi_elm_fid_by_slug('hfe-footer-dark-2'),
            'footer_elm_mobile' => elessi_elm_fid_by_slug('hfe-footer-dark-2'),
            
            // 'category_sidebar' => 'left',
            
            // 'product_detail_layout' => 'modern-1',
            // 'product_image_layout' => 'single',
            // 'product_image_style' => 'slide',
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
        
        'css' => '.elementor-[inserted_id] .elementor-element.elementor-element-7ae7ed51 > .elementor-widget-wrap > .elementor-widget:not(.elementor-widget__width-auto):not(.elementor-widget__width-initial):not(:last-child):not(.elementor-absolute){margin-bottom:0px;}.elementor-[inserted_id] .elementor-element.elementor-element-7ae7ed51 > .elementor-element-populated{padding:10px 5px 10px 10px;}.elementor-[inserted_id] .elementor-element.elementor-element-195c24da > .elementor-element-populated{padding:10px 5px 10px 10px;}.elementor-[inserted_id] .elementor-element.elementor-element-16ac8930{text-align:center;}.elementor-[inserted_id] .elementor-element.elementor-element-16ac8930 .elementor-heading-title{color:#000000;font-family:"Jost", Sans-serif;font-weight:800;}.elementor-[inserted_id] .elementor-element.elementor-element-5c8c0951:not(.elementor-motion-effects-element-type-background), .elementor-[inserted_id] .elementor-element.elementor-element-5c8c0951 > .elementor-motion-effects-container > .elementor-motion-effects-layer{background-image:url("' . $imgs_7_src . '");background-position:bottom center;background-repeat:no-repeat;background-size:cover;}.elementor-[inserted_id] .elementor-element.elementor-element-5c8c0951 > .elementor-background-overlay{opacity:0.5;transition:background 0.3s, border-radius 0.3s, opacity 0.3s;}.elementor-[inserted_id] .elementor-element.elementor-element-5c8c0951{transition:background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;}.elementor-[inserted_id] .elementor-element.elementor-element-7257835f .elementor-heading-title{color:#000000;font-family:"Jost", Sans-serif;font-weight:800;}.elementor-[inserted_id] .elementor-element.elementor-element-288557ec .elementor-heading-title{color:#000000;font-family:"Jost", Sans-serif;font-weight:800;}.elementor-[inserted_id] .elementor-element.elementor-element-662cdd83 .elementor-heading-title{color:#000000;font-family:"Jost", Sans-serif;font-weight:800;}@media(min-width:768px){.elementor-[inserted_id] .elementor-element.elementor-element-732cad5d{width:66.167%;}.elementor-[inserted_id] .elementor-element.elementor-element-7ae7ed51{width:33.499%;}.elementor-[inserted_id] .elementor-element.elementor-element-21d5e101{width:33.167%;}.elementor-[inserted_id] .elementor-element.elementor-element-53938115{width:33.165%;}}@media(max-width:767px){.elementor-[inserted_id] .elementor-element.elementor-element-732cad5d > .elementor-element-populated{padding:0px 10px 10px 10px;}.elementor-[inserted_id] .elementor-element.elementor-element-7ae7ed51 > .elementor-element-populated{padding:0px 10px 0px 10px;}.elementor-[inserted_id] .elementor-element.elementor-element-21d5e101 > .elementor-element-populated{padding:0px 10px 10px 10px;}.elementor-[inserted_id] .elementor-element.elementor-element-53938115 > .elementor-element-populated{padding:0px 10px 10px 10px;}.elementor-[inserted_id] .elementor-element.elementor-element-195c24da > .elementor-element-populated{padding:0px 10px 10px 10px;}}'
    );
    
    /* if (function_exists('hfe_init')) {
        unset($result['post_meta']['_nasa_footer_build_in']);
        unset($result['post_meta']['_nasa_footer_build_in_mobile']);
        
        $result['post_meta']['_nasa_footer_mode'] = 'builder-e';
        $result['post_meta']['_nasa_footer_builder_e'] = elessi_elm_fid_by_slug('hfe-footer-dark-2');
        $result['post_meta']['_nasa_footer_builder_e_mobile'] = elessi_elm_fid_by_slug('hfe-footer-dark-2');
    } */
    
    return $result;
}
