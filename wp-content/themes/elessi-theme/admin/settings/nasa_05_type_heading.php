<?php
add_action('init', 'elessi_type_heading');
if (!function_exists('elessi_type_heading')) {
    function elessi_type_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $google_fonts = elessi_get_google_fonts();
        $custom_fonts = elessi_get_custom_fonts();
        
        $of_options[] = array(
            "name" => __("Typography", 'elessi-theme'),
            "target" => 'fonts',
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("Font Options", 'elessi-theme'),
            "std" => "<h4>" . __("Font Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Type Font", 'elessi-theme'),
            "id" => "type_font_select",
            "std" => "google",
            "type" => "select",
            "options" => array(
                "" => __("Default font", 'elessi-theme'),
                "custom" => __("Custom font", 'elessi-theme'),
                "google" => __("Google font", 'elessi-theme')
            ),
            'class' => 'nasa-type-font'
        );

        $of_options[] = array(
            "name" => __("Heading fonts (H1, H2, H3, H4, H5, H6)", 'elessi-theme'),
            "id" => "type_headings",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => '<strong>Heading</strong><br /><span style="font-size:60%!important">UPPERCASE TEXT</span>',
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-ltr nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );
        
        $of_options[] = array(
            "name" => __("RTL - Heading fonts (H1, H2, H3, H4, H5, H6)", 'elessi-theme'),
            "id" => "type_headings_rtl",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => '<strong>العنوان</strong><br /><span style="font-size:60%!important">نص بأحرف كبيرة</span>',
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-rtl nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );

        $of_options[] = array(
            "name" => __("Text fonts (paragraphs, etc..)", 'elessi-theme'),
            "id" => "type_texts",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => 'Lorem ipsum dosectetur adipisicing elit, sed do.Lorem ipsum dolor sit amet, consectetur Nulla fringilla purus at leo dignissim congue. Mauris elementum accumsan leo vel tempor. Sit amet cursus nisl aliquam. Aliquam et elit eu nunc rhoncus viverra quis at felis..',
                "size" => "14px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-ltr nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );
        
        $of_options[] = array(
            "name" => __("RTL - Text fonts (paragraphs, etc..)", 'elessi-theme'),
            "id" => "type_texts_rtl",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => 'سلسلة أحرف للنظر في تنفيذها لهذا الخط. جربه وشعر به. سلسلة أحرف للنظر في تنفيذها لهذا الخط. جربه وشعر به. سلسلة أحرف للنظر في تنفيذها لهذا الخط. جربه وشعر به.',
                "size" => "14px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-rtl nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );

        $of_options[] = array(
            "name" => __("Main navigation", 'elessi-theme'),
            "id" => "type_nav",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => '<span style="font-size:45%;">THIS IS THE TEXT.</span>',
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-ltr nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );
        
        $of_options[] = array(
            "name" => __("RTL - Main navigation", 'elessi-theme'),
            "id" => "type_nav_rtl",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => '<span style="font-size:45%;">هذا هو النص.</span>',
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-rtl nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );

        $of_options[] = array(
            "name" => __("Banner font", 'elessi-theme'),
            "id" => "type_banner",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => 'This is the text.',
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-ltr nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );
        
        $of_options[] = array(
            "name" => __("RTL - Banner font", 'elessi-theme'),
            "id" => "type_banner_rtl",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => 'هذا هو النص.',
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-rtl nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );
        
        $of_options[] = array(
            "name" => __("Price font", 'elessi-theme'),
            "id" => "type_price",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => "$999",
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-ltr nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );
        
        $of_options[] = array(
            "name" => __("RTL - Price font", 'elessi-theme'),
            "id" => "type_price_rtl",
            "std" => "Nunito Sans",
            "type" => "select_google_font",
            "preview" => array(
                "text" => "$999",
                "size" => "30px"
            ),
            "options" => $google_fonts,
            'class' => 'nasa-d-rtl nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );

        $of_options[] = array(
            "name" => __("Character Sub-sets", 'elessi-theme'),
            "id" => "type_subset",
            "std" => array("latin"),
            "type" => "multicheck",
            "options" => array(
                "latin"         => __("Latin", 'elessi-theme'),
                "latin-ext"     => __("Latin Extended", 'elessi-theme'),
                "arabic"        => __("Arabic", 'elessi-theme'),
                "cyrillic"      => __("Cyrillic", 'elessi-theme'),
                "cyrillic-ext"  => __("Cyrillic Extended", 'elessi-theme'),
                "greek"         => __("Greek", 'elessi-theme'),
                "greek-ext"     => __("Greek Extended", 'elessi-theme'),
                "vietnamese"    => __("Vietnamese", 'elessi-theme'),
            ),
            'class' => 'nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'google',
        );
        
        $of_options[] = array(
            "name" => __("Upload Custom Font", 'elessi-theme'),
            "std" => "",
            "type" => "nasa_upload_custom_font",
            'class' => 'nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'custom',
        );
        
        $of_options[] = array(
            "name" => __("Select Custom Font", 'elessi-theme'),
            "id" => "custom_font",
            "std" => "",
            "type" => "select",
            "options" => $custom_fonts,
            'class' => 'nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'custom',
        );
        
        $of_options[] = array(
            "name" => __("RTL - Select Custom Font", 'elessi-theme'),
            "id" => "custom_font_rtl",
            "std" => "",
            "type" => "select",
            "options" => $custom_fonts,
            'class' => 'nasa-type-font-glb',
            'child_of' => 'type_font_select',
            'm_target' => 'custom',
        );
        
        $of_options[] = array(
            "name" => __("Font Weight", 'elessi-theme'),
            "id" => "max_font_weight",
            "std" => '',
            "type" => "select",
            "options" => array(
                '' => __("Default", 'elessi-theme'),
                '800' => __("Bold - 800", 'elessi-theme'),
                '700' => __("Bold - 700", 'elessi-theme'),
                '600' => __("Bold - 600", 'elessi-theme'),
                '500' => __("Bold - 500", 'elessi-theme')
            ),
            'override_numberic' => true
        );
        
        $of_options[] = array(
            "name" => __("Font Size", 'elessi-theme'),
            "std" => "<h4>" . __("Font Size", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Font Size (px)", 'elessi-theme'),
            "id" => "font_size",
            "std" => "14.5",
            "type" => "select",
            "options" => array(
                "12" => '12px',
                "12.5" => '12.5px',
                "13" => '13px',
                "13.5" => '13.5px',
                "14" => '14px',
                "14.5" => '14.5px - Default',
                "15" => '15px',
                "15.5" => '15.5px',
                "16" => '16px',
                "16.5" => '16.5px',
                "17" => '17px',
            ),
            'override_numberic' => true
        );
        
        $of_options[] = array(
            "name" => __("Font Size (px) - Mobile", 'elessi-theme'),
            "id" => "font_size_m",
            "std" => "14.5",
            "type" => "select",
            "options" => array(
                "12" => '12px',
                "12.5" => '12.5px',
                "13" => '13px',
                "13.5" => '13.5px',
                "14" => '14px',
                "14.5" => '14.5px - Default',
                "15" => '15px',
                "15.5" => '15.5px',
                "16" => '16px',
                "16.5" => '16.5px',
                "17" => '17px',
            ),
            'override_numberic' => true
        );
        
        $of_options[] = array(
            "name" => __("Font Icons", 'elessi-theme'),
            "std" => "<h4>" . __("Font Icons", 'elessi-theme') . "</h4>",
            "type" => "info",
            // 'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Support Font Icons", 'elessi-theme'),
            "id" => "sp_font_icon",
            "std" => 1,
            "type" => "switch",
            'desc' => 'Note: Support Call Font Nasa Icons, Font Awesome 4.7.0, Font Pe-icon-7-stroke'
        );
        
        $of_options[] = array(
            "name" => __("Minify Fonts Icons", 'elessi-theme'),
            "id" => "minify_font_icons",
            "std" => 1,
            "type" => "switch",
            "desc" => "Include: Font Nasa Icons, Font Awesome 4.7.0, Font Pe-icon-7-stroke",
            'child_of' => 'sp_font_icon',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Preload Fonts Icons", 'elessi-theme'),
            "id" => "preload_font_icons",
            "std" => 1,
            "type" => "switch",
            "desc" => "Preload: Font Nasa Icons, Font Awesome 4.7.0, Font Pe-icon-7-stroke",
            'child_of' => 'sp_font_icon',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => 'Include FontAwesome 6 (Note: You only can use Free icons)',
            "id" => "include_font_awesome_new",
            "std" => 0,
            "type" => "switch",
            'child_of' => 'sp_font_icon',
            'm_target' => '1',
        );
    }
}
