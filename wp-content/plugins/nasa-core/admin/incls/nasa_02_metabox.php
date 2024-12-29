<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Include and setup custom metaboxes and fields.
 *
 * @category nasa-core
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */
add_filter('cmb_meta_boxes', 'nasa_meta_boxes');

/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function nasa_meta_boxes(array $meta_boxes) {
    global $nasa_opt;
    
    // Start with an underscore to hide fields from custom fields list
    $prefix = '_nasa_';
    
    /**
     * Product Categories level 0
     */
    
    $categories = null;
    if (NASA_WOO_ACTIVED) {
        $args = array(
            'taxonomy' => 'product_cat',
            'parent' => 0,
            'hierarchical' => true,
            'hide_empty' => false
        );

        if (!isset($nasa_opt['show_uncategorized']) || !$nasa_opt['show_uncategorized']) {
            $args['exclude'] = get_option('default_product_cat');
        }
        
        $categories = get_terms(apply_filters('woocommerce_product_attribute_terms', $args));
    }
    
    $categories_options = array('' => __('Default', 'nasa-core'));
    if (!empty($categories)) {
        foreach ($categories as $value) {
            if ($value) {
                $categories_options[$value->slug] = $value->name;
            }
        }
    }
    
    $attr_image = array(
        "" => __("Default", 'nasa-core'),
        "round" => __("Round", 'nasa-core'),
        "square" => __("Square", 'nasa-core')
    );
    
    $custom_fonts = nasa_get_custom_fonts();
    $google_fonts = nasa_get_google_fonts();
    
    $effect_type = nasa_product_hover_effect_types();
    $card_layouts = nasa_product_card_layouts();
    
    $meta_boxes['nasa_metabox_general'] = array(
        'id' => 'nasa_metabox_general',
        'title' => __('General', 'nasa-core'),
        'pages' => array('page'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Custom width this page', 'nasa-core'),
                'id' => $prefix . 'plus_wide_option',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Yes', 'nasa-core'),
                    '-1' => __('No', 'nasa-core')
                ),
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                "name" => __("Add more width site (px)", 'nasa-core'),
                "desc" => __("The max-width your site will be INPUT + 1200 (pixel). Empty will use default theme option", 'nasa-core'),
                "id" => $prefix . "plus_wide_width",
                "default" => "",
                "type" => "text",
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'plus_wide_option core' . $prefix . 'plus_wide_option-1'
            ),
            
            array(
                'name' => __('Background Mode', 'nasa-core'),
                'id' => $prefix . 'site_bg_dark',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Dark', 'nasa-core'),
                    '2' => __('Gray', 'nasa-core'),
                    '-1' => __('Light', 'nasa-core')
                ),
                'default' => ''
            ),
            
            array(
                'name' => __('Override Logo Mode', 'nasa-core'),
                'desc' => __('Yes, Please!', 'nasa-core'),
                'id' => $prefix . 'logo_flag',
                'default' => '0',
                'type' => 'checkbox',
                'class' => 'nasa-override-root'
            ),
            
            array(
                'name' => __('Override Logo', 'nasa-core'),
                'id' => $prefix . 'custom_logo',
                'allow' => false,
                'type' => 'file',
                'class' => 'hidden-tag nasa-override-child ' . $prefix . 'logo_flag'
            ),
            
            array(
                'name' => __('Override Retina Logo', 'nasa-core'),
                'id' => $prefix . 'custom_logo_retina',
                'allow' => false,
                'type' => 'file',
                'class' => 'hidden-tag nasa-override-child ' . $prefix . 'logo_flag'
            ),
            
            array(
                'name' => __('Override Sticky Logo', 'nasa-core'),
                'id' => $prefix . 'custom_logo_sticky',
                'allow' => false,
                'type' => 'file',
                'class' => 'hidden-tag nasa-override-child ' . $prefix . 'logo_flag'
            ),
            
            array(
                'name' => __('Override Mobile Logo', 'nasa-core'),
                'id' => $prefix . 'custom_logo_m',
                'allow' => false,
                'type' => 'file',
                'class' => 'hidden-tag nasa-override-child ' . $prefix . 'logo_flag'
            ),
            
            array(
                'name' => __('Override Primary Color', 'nasa-core'),
                'desc' => __('Yes, Please!', 'nasa-core'),
                'id' => $prefix . 'pri_color_flag',
                'default' => '0',
                'type' => 'checkbox',
                'class' => 'nasa-override-root'
            ),
            
            array(
                'name' => __('Primary Color', 'nasa-core'),
                'id' => $prefix . 'pri_color',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'hidden-tag nasa-option-color nasa-override-child ' . $prefix . 'pri_color_flag'
            ),
            
            array(
                'name' => __('Root Product Category', 'nasa-core'),
                'desc' => __('Root Product Category. (Use for Multi stores)', 'nasa-core'),
                'id' => $prefix . 'root_category',
                'type' => 'select',
                'options' => $categories_options,
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                'name' => __('Attribute Image Style', 'nasa-core'),
                'id' => $prefix . 'attr_image_style',
                'type' => 'select',
                'options' => $attr_image,
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                'name' => __('Product Card Styles', 'nasa-core'),
                'id' => $prefix . 'loop_layout_buttons',
                'type' => 'select',
                'options' => $card_layouts,
                'default' => ''
            ),
            
            array(
                'name' => __('Effect Hover Product', 'nasa-core'),
                'id' => $prefix . 'effect_hover',
                'type' => 'select',
                'options' => $effect_type,
                'default' => ''
            ),
            
            array(
                "name" => __("Extra Class Page", 'nasa-core'),
                'desc' => __('Add Custom Class Page', 'nasa-core'),
                "id" => $prefix . "el_class_page",
                "default" => '',
                "type" => "text"
            ),
        )
    );
    
    $meta_boxes['nasa_metabox_font'] = array(
        'id' => 'nasa_metabox_font',
        'title' => __('Font Style', 'nasa-core'),
        'pages' => array('page'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Type Font', 'nasa-core'),
                'id' => $prefix . 'type_font_select',
                'type' => 'select',
                'options' => array(
                    "" => __("Default Font", 'nasa-core'),
                    "custom" => __("Custom Font", 'nasa-core'),
                    "google" => __("Google Font", 'nasa-core')
                ),
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                'name' => __('Headings Font (H1, H2, H3, H4, H5, H6)', 'nasa-core'),
                'id' => $prefix . 'type_headings',
                'type' => 'select',
                'options' => $google_fonts,
                'default' => isset($nasa_opt['type_headings']) ? $nasa_opt['type_headings'] : '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'type_font_select core' . $prefix . 'type_font_select-google'
            ),
            
            array(
                'name' => __('Texts Font (paragraphs, etc..)', 'nasa-core'),
                'id' => $prefix . 'type_texts',
                'type' => 'select',
                'options' => $google_fonts,
                'default' => isset($nasa_opt['type_texts']) ? $nasa_opt['type_texts'] : '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'type_font_select core' . $prefix . 'type_font_select-google'
            ),
            
            array(
                'name' => __('Main Navigation Font', 'nasa-core'),
                'id' => $prefix . 'type_nav',
                'type' => 'select',
                'options' => $google_fonts,
                'default' => isset($nasa_opt['type_nav']) ? $nasa_opt['type_nav'] : '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'type_font_select core' . $prefix . 'type_font_select-google'
            ),
            
            array(
                'name' => __('Banner Font', 'nasa-core'),
                'id' => $prefix . 'type_banner',
                'type' => 'select',
                'options' => $google_fonts,
                'default' => isset($nasa_opt['type_banner']) ? $nasa_opt['type_banner'] : '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'type_font_select core' . $prefix . 'type_font_select-google'
            ),
            
            array(
                'name' => __('Price Font', 'nasa-core'),
                'id' => $prefix . 'type_price',
                'type' => 'select',
                'options' => $google_fonts,
                'default' => isset($nasa_opt['type_price']) ? $nasa_opt['type_price'] : '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'type_font_select core' . $prefix . 'type_font_select-google'
            ),
            
            array(
                'name' => __('Custom Font', 'nasa-core'),
                'id' => $prefix . 'custom_font',
                'type' => 'select',
                'options' => $custom_fonts,
                'default' => isset($nasa_opt['custom_font']) ? $nasa_opt['custom_font'] : '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'type_font_select core' . $prefix . 'type_font_select-custom'
            ),
            
            array(
                'name' => __('Font Weight', 'nasa-core'),
                'id' => $prefix . 'font_weight',
                'type' => 'select',
                'options' => array(
                    '' => __("Default", 'nasa-core'),
                    '900' => __("Bold - 900", 'nasa-core'),
                    '800' => __("Bold - 800", 'nasa-core'),
                    '700' => __("Bold - 700", 'nasa-core'),
                    '600' => __("Bold - 600", 'nasa-core'),
                    '500' => __("Bold - 500", 'nasa-core')
                ),
                'default' => ''
            ),
        )
    );
    
    $header_type_list = array(
        '' => __('Default', 'nasa-core'),
        '1' => __('Header Type 1', 'nasa-core'),
        '2' => __('Header Type 2', 'nasa-core'),
        '3' => __('Header Type 3', 'nasa-core'),
        '4' => __('Header Type 4', 'nasa-core'),
        '5' => __('Header Type 5', 'nasa-core'),
        '6' => __('Header Type 6', 'nasa-core'),
        '7' => __('Header Type 7', 'nasa-core')
    );
    
    if (NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true)) {
        $header_type_list ['nasa-custom'] = __('Header WPBakery Builder', 'nasa-core');
    }
    
    if (NASA_HF_BUILDER) {
        $header_type_list ['nasa-elm'] = __('Header Elementor Builder', 'nasa-core');
    }
    
    $meta_boxes['nasa_metabox_header'] = array(
        'id' => 'nasa_metabox_header',
        'title' => __('Header', 'nasa-core'),
        'pages' => array('page'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Header Type', 'nasa-core'),
                'id' => $prefix . 'custom_header',
                'type' => 'select',
                'options' => $header_type_list,
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                'name' => __('Header Theme Builder', 'nasa-core'),
                'id' => $prefix . 'header_builder',
                'type' => 'select',
                'options' => nasa_get_headers_options(),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-nasa-custom'
            ),
            
            array(
                'name' => __('Header Elementor Builder', 'nasa-core'),
                'id' => $prefix . 'header_elm',
                'type' => 'select',
                'options' => nasa_get_headers_elementor(),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-nasa-elm'
            ),
            
            array(
                'name' => __("Sticky", 'nasa-core'),
                'desc' => __('Not use for Header Builder.', 'nasa-core'),
                'id' => $prefix . 'fixed_nav',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Yes', 'nasa-core'),
                    '-1' => __('No', 'nasa-core')
                ),
                'default' => ''
            ),
            
            array(
                'name' => __('Header Transparent', 'nasa-core'),
                'id' => $prefix . 'header_transparent',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Yes', 'nasa-core'),
                    // '-1' => __('No', 'nasa-core')
                ),
                'default' => '',
                'desc' => __('Apply with Header Type 1, 2, 3, 5, 7', 'nasa-core'),
                // 'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-5 core' . $prefix . 'custom_header-7 core' . $prefix . 'custom_header-'
            ),
            
            array(
                'name' => __('Main Menu Fullwidth', 'nasa-core'),
                'id' => $prefix . 'fullwidth_main_menu',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Yes', 'nasa-core'),
                    '-1' => __('No', 'nasa-core')
                ),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3'
            ),
            
            array(
                "name" => __("Extra Class Name Header", 'nasa-core'),
                'desc' => __('Custom add more class name for header page', 'nasa-core'),
                "id" => $prefix . "el_class_header",
                "default" => '',
                "type" => "text",
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3'
            ),
            
            array(
                'name' => __('Block Header', 'nasa-core'),
                'desc' => __('Add static block to Header', 'nasa-core'),
                'id' => $prefix . 'header_block',
                'type' => 'select',
                'options' => nasa_get_blocks_options(),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-5 core' . $prefix . 'custom_header-6 core' . $prefix . 'custom_header-7'
            ),

            array(
                'name' => __('The Block beside Main menu in Header Type 4, 6', 'nasa-core'),
                'desc' => __('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'),
                'id' => $prefix . 'header_beside_block',
                'type' => 'select',
                'options' => nasa_get_blocks_options(),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Top Bar', 'nasa-core'),
                'id' => $prefix . 'topbar_on',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Yes', 'nasa-core'),
                    '2' => __('No', 'nasa-core')
                ),
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                'name' => __('Toggle Top Bar', 'nasa-core'),
                'id' => $prefix . 'topbar_toggle',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Yes', 'nasa-core'),
                    '2' => __('No', 'nasa-core')
                ),
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                'name' => __('Toggle Top Bar - Initialize', 'nasa-core'),
                'id' => $prefix . 'topbar_default_show',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('Yes', 'nasa-core'),
                    '2' => __('No', 'nasa-core')
                ),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'topbar_toggle core' . $prefix . 'topbar_toggle-1'
            ),
            
            array(
                'name' => __('Header Background', 'nasa-core'),
                'id' => $prefix . 'bg_color_header',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Header Background - Sticky', 'nasa-core'),
                'id' => $prefix . 'bg_color_header_stk',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Header Text color', 'nasa-core'),
                'id' => $prefix . 'text_color_header',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Header Text color - Sticky', 'nasa-core'),
                'id' => $prefix . 'text_color_header_stk',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Header Text color hover', 'nasa-core'),
                'id' => $prefix . 'text_color_hover_header',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Header Text color hover - Sticky', 'nasa-core'),
                'id' => $prefix . 'text_color_hover_header_stk',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Top Bar Background', 'nasa-core'),
                'id' => $prefix . 'bg_color_topbar',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color'
            ),
            
            array(
                'name' => __('Top Bar Text Color', 'nasa-core'),
                'id' => $prefix . 'text_color_topbar',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color'
            ),
            
            array(
                'name' => __('Top Bar Text Color Hover', 'nasa-core'),
                'id' => $prefix . 'text_color_hover_topbar',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color'
            ),
            
            array(
                "name" => __("Vertical Menu", 'nasa-core'),
                "id" => $prefix . "vertical_menu_selected",
                "default" => "",
                "type" => "select",
                "options" => nasa_meta_get_list_menus()
            ),
            
            array(
                "name" => __("Vertical Menu Root", 'nasa-core'),
                'desc' => __('Only show root menu items - Parent - 0', 'nasa-core'),
                "id" => $prefix . "v_root",
                "default" => '0',
                "type" => "checkbox"
            ),
            
            array(
                'name' => __('Vertical Menu Root - Limit', 'nasa-core'),
                'id' => $prefix . 'v_root_limit',
                'type' => 'text',
                'default' => '',
            ),
            
            array(
                "name" => __("Vertical Menu Visible", 'nasa-core'),
                'desc' => __('Yes, Please!', 'nasa-core'),
                "id" => $prefix . "vertical_menu_allways_show",
                "default" => '0',
                "type" => "checkbox"
            ),
            
            array(
                'name' => __('Main Menu Background', 'nasa-core'),
                'id' => $prefix . 'bg_color_main_menu',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Main Menu Background - Sticky', 'nasa-core'),
                'id' => $prefix . 'bg_color_main_menu_stk',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Main Menu Text color', 'nasa-core'),
                'id' => $prefix . 'text_color_main_menu',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Main Menu Text color - Sticky', 'nasa-core'),
                'id' => $prefix . 'text_color_main_menu_stk',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-1 core' . $prefix . 'custom_header-2 core' . $prefix . 'custom_header-3 core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Vertical Menu Background - Focus', 'nasa-core'),
                'id' => $prefix . 'bg_color_v_menu',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Vertical Menu Background - Focus - Sticky', 'nasa-core'),
                'id' => $prefix . 'bg_color_v_menu_stk',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Vertical Menu Text Color - Focus', 'nasa-core'),
                'id' => $prefix . 'text_color_v_menu',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            ),
            
            array(
                'name' => __('Vertical Menu Text Color - Focus - Sticky', 'nasa-core'),
                'id' => $prefix . 'text_color_v_menu_stk',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'nasa-option-color hidden-tag nasa-core-option-child core' . $prefix . 'custom_header core' . $prefix . 'custom_header-4 core' . $prefix . 'custom_header-6'
            )
        )
    );
    
    $meta_boxes['nasa_metabox_breadcrumb'] = array(
        'id' => 'nasa_metabox_breadcrumb',
        'title' => __('Breadcrumb', 'nasa-core'),
        'pages' => array('page'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Show Breadcrumb', 'nasa-core'),
                'desc' => __('Yes, Please!', 'nasa-core'),
                'id' => $prefix . 'show_breadcrumb',
                'default' => '0',
                'type' => 'checkbox',
                'class' => 'nasa-breadcrumb-flag'
            ),
            
            array(
                'name' => __('Breadcrumb Layout', 'nasa-core'),
                'id' => $prefix . 'layout_breadcrumb',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    'multi' => __('Double Rows', 'nasa-core'),
                    'single' => __('Single Row', 'nasa-core')
                ),
                'default' => '',
                'class' => 'hidden-tag nasa-breadcrumb-layout'
            ),
            
            array(
                'name' => __('Breadcrumb Type', 'nasa-core'),
                'id' => $prefix . 'type_breadcrumb',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    '1' => __('With Background', 'nasa-core'),
                    '-1' => __('Without Background', 'nasa-core')
                ),
                'default' => '',
                'class' => 'hidden-tag nasa-breadcrumb-type'
            ),
            
            array(
                'name' => __('Background Image', 'nasa-core'),
                'id' => $prefix . 'bg_breadcrumb',
                'allow' => false,
                'type' => 'file',
                'class' => 'hidden-tag nasa-breadcrumb-bg'
            ),
            
            array(
                'name' => __('Background Image - Mobile', 'nasa-core'),
                'id' => $prefix . 'bg_breadcrumb_m',
                'allow' => false,
                'type' => 'file',
                'class' => 'hidden-tag nasa-breadcrumb-bg'
            ),
            
            array(
                'name' => __('Background Color', 'nasa-core'),
                'id' => $prefix . 'bg_color_breadcrumb',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'hidden-tag nasa-breadcrumb-bg-color'
            ),
            
            array(
                'name' => __('Text Color', 'nasa-core'),
                'id' => $prefix . 'color_breadcrumb',
                'type' => 'colorpicker',
                'default' => '',
                'class' => 'hidden-tag nasa-breadcrumb-color'
            ),
            
            array(
                'name' => __('Text Alignment', 'nasa-core'),
                'id' => $prefix . 'align_breadcrumb',
                'type' => 'select',
                'options' => array(
                    '' => __('Default', 'nasa-core'),
                    "text-center" => __("Center", 'nasa-core'),
                    "text-left" => __("Left", 'nasa-core'),
                    "text-right" => __("Right", 'nasa-core')
                ),
                'class' => 'hidden-tag nasa-breadcrumb-align'
            ),
            
            array(
                'name' => __('Height (px)', 'nasa-core'),
                'id' => $prefix . 'height_breadcrumb',
                'type' => 'text',
                'default' => '',
                'class' => 'hidden-tag nasa-breadcrumb-height'
            ),
            
            array(
                'name' => __('Height - Mobile (px)', 'nasa-core'),
                'id' => $prefix . 'height_breadcrumb_m',
                'type' => 'text',
                'default' => '',
                'class' => 'hidden-tag nasa-breadcrumb-height'
            ),
        )
    );
    
    /* Get Footers style */
    $footers_option = nasa_get_footers_options();
    $footers_desk = $footers_option;
    if (isset($footers_desk[''])) {
        unset($footers_desk['']);
    }
    
    $footers_e = nasa_get_footers_elementor();
    
    $modes = array(
        '' => __('Default', 'nasa-core')
    );
    
    if (isset($nasa_opt['f_buildin']) && $nasa_opt['f_buildin']) {
        $modes["build-in"] = __("Built-in", 'nasa-core');
    }
    
    if (NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true)) {
        $modes["builder"] = __("Builder - Support WPBakery", 'nasa-core');
    }
    
    if (NASA_HF_BUILDER) {
        $modes["builder-e"] = __("Builder - Support HFE-Elementor", 'nasa-core');
    }
    
    $meta_boxes['nasa_metabox_footer'] = array(
        'id' => 'nasa_metabox_footer',
        'title' => __('Footer', 'nasa-core'),
        'pages' => array('page'), // Post type
        'context' => 'normal',
        'priority' => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => __('Footer Mode', 'nasa-core'),
                'id' => $prefix . 'footer_mode',
                'type' => 'select',
                'options' => $modes,
                'default' => '',
                'class' => 'nasa-core-option-parent'
            ),
            
            array(
                'name' => __('Footer Built-in', 'nasa-core'),
                'id' => $prefix . 'footer_build_in',
                'type' => 'select',
                'options' => array(
                    '1' => __("Built-in Light 1", 'nasa-core'),
                    '2' => __("Built-in Light 2", 'nasa-core'),
                    '3' => __("Built-in Light 3", 'nasa-core'),
                    '4' => __("Built-in Dark", 'nasa-core')
                ),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'footer_mode core' . $prefix . 'footer_mode-build-in'
            ),
            
            array(
                'name' => __('Footer Built-in Mobile', 'nasa-core'),
                'id' => $prefix . 'footer_build_in_mobile',
                'type' => 'select',
                'options' => array(
                    '' => __("Extends from Desktop", 'nasa-core'),
                    'm-1' => __("Built-in Mobile", 'nasa-core')
                ),
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'footer_mode core' . $prefix . 'footer_mode-build-in'
            ),
            
            array(
                'name' => __('Footer Builder', 'nasa-core'),
                'id' => $prefix . 'custom_footer',
                'type' => 'select',
                'options' => $footers_desk,
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'footer_mode core' . $prefix . 'footer_mode-builder'
            ),
            
            array(
                'name' => __('Footer Builder Mobile', 'nasa-core'),
                'id' => $prefix . 'custom_footer_mobile',
                'type' => 'select',
                'options' => $footers_option,
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'footer_mode core' . $prefix . 'footer_mode-builder'
            ),
            
            array(
                'name' => __('Elementor Builder', 'nasa-core'),
                'id' => $prefix . 'footer_builder_e',
                'type' => 'select',
                'options' => $footers_e,
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'footer_mode core' . $prefix . 'footer_mode-builder-e'
            ),
            
            array(
                'name' => __('Elementor Builder - Mobile', 'nasa-core'),
                'id' => $prefix . 'footer_builder_e_mobile',
                'type' => 'select',
                'options' => $footers_e,
                'default' => '',
                'class' => 'hidden-tag nasa-core-option-child core' . $prefix . 'footer_mode core' . $prefix . 'footer_mode-builder-e'
            ),

            array(
                'name' => __('The Popup Static Block', 'nasa-core'),
                'desc' => __('Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.', 'nasa-core'),
                'id' => $prefix . 'popup_static_block',
                'type' => 'select',
                'options' => nasa_get_blocks_options(),
                'default' => '',
                'class' => 'nasa-core-option-parent'
            )
        )
    );

    return apply_filters('nasa_page_options', $meta_boxes);
}

/**
 * Initialize the metabox class.
 */
add_action('init', 'nasa_init_meta_boxes');
function nasa_init_meta_boxes() {
    if (!class_exists('cmb_Meta_Box')){
        require_once NASA_CORE_PLUGIN_PATH . 'admin/metabox/init.php';
        
        add_action('admin_footer', 'nasa_advance_metaboxs');
    }
}

/**
 * Advance Metaboxs
 */
function nasa_advance_metaboxs() {
    echo '<script type="text/template" id="ns-advance-metaboxs-btn"><a class="ns-advance-metaboxs button-primary button" href="javascript:void(0);">' . esc_html__('+ Advance Options', 'nasa-core') . '</a></script>';
}
