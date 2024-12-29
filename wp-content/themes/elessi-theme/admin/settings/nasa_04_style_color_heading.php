<?php
add_action('init', 'elessi_style_color_heading');
if (!function_exists('elessi_style_color_heading')) {
    function elessi_style_color_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Style and Colors", 'elessi-theme'),
            "target" => 'style-color',
            "type" => "heading"
        );

        $of_options[] = array(
            "name" => __("Colors Options", 'elessi-theme'),
            "std" => "<h4>" . __("Colors Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Primary Color", 'elessi-theme'),
            "desc" => __("Change primary color. Used for primary buttons, link hover, background, etc.", 'elessi-theme'),
            "id" => "color_primary",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Success Color", 'elessi-theme'),
            "id" => "color_success",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Custom Badge Color", 'elessi-theme'),
            "id" => "color_hot_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Featured Badge Color", 'elessi-theme'),
            "id" => "color_featured_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("New Badge Color", 'elessi-theme'),
            "id" => "color_new_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Backorders Badge Color", 'elessi-theme'),
            "id" => "color_backorders_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Video Badge Color", 'elessi-theme'),
            "id" => "color_video_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("360&#176; Badge Color", 'elessi-theme'),
            "id" => "color_360_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Deal Badge Color", 'elessi-theme'),
            "id" => "color_deal_label",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Sale Badge Color", 'elessi-theme'),
            "id" => "color_sale_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Variants Badge Color", 'elessi-theme'),
            "id" => "color_variants_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Bulk Discount Badge Color", 'elessi-theme'),
            "id" => "color_bulk_label",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Price Color", 'elessi-theme'),
            "id" => "color_price_label",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Buttons Style Options", 'elessi-theme'),
            "std" => "<h4>" . __("Buttons Style Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );

        $of_options[] = array(
            "name" => __("Buttons Background Color", 'elessi-theme'),
            "id" => "color_button",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Buttons Background Color Hover", 'elessi-theme'),
            "desc" => __("Default use primary color", 'elessi-theme'),
            "id" => "color_hover",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Buttons Border Color", 'elessi-theme'),
            "id" => "button_border_color",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Buttons Border Color Hover", 'elessi-theme'),
            "id" => "button_border_color_hover",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Buttons Text Color", 'elessi-theme'),
            "id" => "button_text_color",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => __("Buttons Text Color Hover", 'elessi-theme'),
            "id" => "button_text_color_hover",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => __("Buttons Radius", 'elessi-theme'),
            "id" => "button_radius",
            "std" => "0",
            "step" => "1",
            "max" => '100',
            "type" => "sliderui"
        );

        $of_options[] = array(
            "name" => __("Buttons Border Width", 'elessi-theme'),
            "id" => "button_border",
            "std" => "1",
            "step" => "1",
            'min' => '1',
            "max" => '5',
            "type" => "sliderui"
        );

        $of_options[] = array(
            "name" => __("Inputs Radius", 'elessi-theme'),
            "id" => "input_radius",
            "std" => "0",
            "step" => "1",
            "max" => "100",
            "type" => "sliderui"
        );
    }
}
