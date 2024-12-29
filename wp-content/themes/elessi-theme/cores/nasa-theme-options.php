<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * VC SETUP
 */
add_action('init', 'elessi_vc_setup');
if (!function_exists('elessi_vc_setup')) :
    function elessi_vc_setup() {
        if (!NASA_WPB_ACTIVE){
            return;
        }
        
        global $nasa_opt;

        /**
         * Row (add fullwidth)
         */
        vc_add_param('vc_row', array(
            "type" => 'checkbox',
            "heading" => esc_html__("Fullwidth ?", 'elessi-theme'),
            "param_name" => "fullwidth",
            "value" => array(
                esc_html__('Yes, Please!', 'elessi-theme') => '1'
            )
        ));
        
        /**
         * Add param from row element
         */
        vc_add_param('vc_row', array(
            "type" => "dropdown",
            "heading" => esc_html__("Width full side", 'elessi-theme'),
            "param_name" => "width_side",
            'value' => array(
                esc_html__('None', 'elessi-theme') => '',
                esc_html__('Full width to left', 'elessi-theme') => 'left',
                esc_html__('Full width to right', 'elessi-theme') => 'right'
            ),
            'std' => '',
            "description" => esc_html__('Only use for Visual Composer Template.', 'elessi-theme'),
        ));
        
        /**
         * Add params from tab element
         */
        vc_add_param('vc_tta_tabs', array(
            "type" => "dropdown",
            "heading" => esc_html__("Font Size Title", 'elessi-theme'),
            "param_name" => "title_font_size",
            "value" => array(
                esc_html__('Not Set', 'elessi-theme') => '',
                esc_html__('X-Large', 'elessi-theme') => 'xl',
                esc_html__('Large', 'elessi-theme') => 'l',
                esc_html__('Medium', 'elessi-theme') => 'm',
                esc_html__('Small', 'elessi-theme') => 's',
                esc_html__('Tiny', 'elessi-theme') => 't'
            ),
            "std" => ''
        ));
        
        vc_add_param('vc_tta_tabs', array(
            "type" => "dropdown",
            "heading" => esc_html__("Style", 'elessi-theme'),
            "param_name" => "tabs_display_type",
            "value" => array(
                esc_html__('Classic 2D - No border', 'elessi-theme') => '2d-no-border',
                esc_html__('Classic 2D - Radius', 'elessi-theme') => '2d-radius',
                esc_html__('Classic 2D - Radius - Dash', 'elessi-theme') => '2d-radius-dashed',
                esc_html__('Classic 2D - Has BG color', 'elessi-theme') => '2d-has-bg',
                esc_html__('Classic 2D', 'elessi-theme') => '2d',
                esc_html__('Classic 3D', 'elessi-theme') => '3d',
                esc_html__('Slide', 'elessi-theme') => 'slide',
                esc_html__('Vertical', 'elessi-theme') => 'ver'
            ),
            "std" => '2d-no-border'
        ));
        
        vc_add_param('vc_tta_tabs', array(
            "type" => "colorpicker",
            "heading" => esc_html__("Tabs Background color", 'elessi-theme'),
            "param_name" => "tabs_bg_color",
            "std" => '#efefef',
            "dependency" => array(
                "element" => "tabs_display_type",
                "value" => array(
                    "2d-has-bg"
                )
            )
        ));
        
        vc_add_param('vc_tta_tabs', array(
            "type" => "colorpicker",
            "heading" => esc_html__("Tabs text color", 'elessi-theme'),
            "param_name" => "tabs_text_color",
            "std" => '',
            "dependency" => array(
                "element" => "tabs_display_type",
                "value" => array(
                    "2d-has-bg"
                )
            )
        ));
        
        vc_add_param('vc_tta_accordion', array(
            "type" => "dropdown",
            "heading" => esc_html__("Layout", 'elessi-theme'),
            "param_name" => "accordion_layout",
            'value' => array(
                esc_html__('Border Wrapper', 'elessi-theme') => 'has-border',
                esc_html__('Without Border Wrapper', 'elessi-theme') => 'no-border'
            ),
            'std' => 'has-border',
            "description" => esc_html__('Only use for Accordion.', 'elessi-theme'),
        ));
        
        vc_add_param('vc_tta_accordion', array(
            "type" => "dropdown",
            "heading" => esc_html__("Toggle Icon", 'elessi-theme'),
            "param_name" => "accordion_icon",
            'value' => array(
                esc_html__('Plus', 'elessi-theme') => 'plus',
                esc_html__('Arrow', 'elessi-theme') => 'arrow'
            ),
            'std' => 'plus',
            "description" => esc_html__('Only use for Accordion.', 'elessi-theme'),
        ));
        
        vc_add_param('vc_tta_accordion', array(
            "type" => 'checkbox',
            "heading" => esc_html__("Hide First Section ?", 'elessi-theme'),
            "param_name" => "accordion_hide_first",
            "value" => array(
                esc_html__('Yes, Please!', 'elessi-theme') => '1'
            )
        ));
        
        vc_add_param('vc_tta_accordion', array(
            "type" => 'checkbox',
            "heading" => esc_html__("Show Multi", 'elessi-theme'),
            "param_name" => "accordion_show_multi",
            "value" => array(
                esc_html__('Yes, Please!', 'elessi-theme') => '1'
            )
        ));
        
        /**
         * Add params from section tab element
         */
        vc_add_param('vc_tta_section', array(
            "type" => "textfield",
            "heading" => esc_html__("Add Icon NasaTheme (Using for Section of Tabs)", 'elessi-theme'),
            "param_name" => "section_nasa_icon",
            "std" => '',
            'readonly' => 1,
            'description' => '<a class="nasa-chosen-icon left" data-fill="section_nasa_icon" href="javascript:void(0);">Click Here to Add Icon NasaTheme</a><a class="nasa-remove-icon right" data-id="section_nasa_icon" href="javascript:void(0);">Remove Icon NasaTheme</a><p class="nasa-clearfix"></p>'
        ));
        
        /**
         * Add params image for Tab
         */
        vc_add_param('vc_tta_section', array(
            "type" => "attach_image",
            "heading" => esc_html__("Add Icon Image (Using for Section of Tabs)", 'elessi-theme'),
            "param_name" => "section_nasa_img",
            "std" => '',
            'description' => '',
            'admin_label' => true,
        ));
        
        vc_add_param('vc_tta_section', array(
            "type" => "textarea_raw_html",
            "heading" => esc_html__("Before Tabs Title (Using for Section of Tabs)", 'elessi-theme'),
            "param_name" => "before_tab_title",
            "std" => ''
        ));
        
        vc_add_param('vc_tta_section', array(
            "type" => "textarea_raw_html",
            "heading" => esc_html__("After Tabs Title (Using for Section of Tabs)", 'elessi-theme'),
            "param_name" => "after_tab_title",
            "std" => ''
        ));
        
        /**
         * For Mobile Layout
         */
        $option_mobile = !isset($nasa_opt['enable_nasa_mobile']) || $nasa_opt['enable_nasa_mobile'] ? true : false;
        
        if ($option_mobile) {
            /**
             * Hide on mobile for Row
             */
            vc_add_param('vc_row', array(
                "type" => 'checkbox',
                "heading" => esc_html__("Ignore on Mobile", 'elessi-theme'),
                "param_name" => "hide_in_mobile",
                "value" => array(
                    esc_html__('Yes, Please!', 'elessi-theme') => '1'
                )
            ));
            
            /**
             * Hide on mobile for Mobile
             */
            vc_add_param('vc_column', array(
                "type" => 'checkbox',
                "heading" => esc_html__("Ignore on Mobile", 'elessi-theme'),
                "param_name" => "hide_in_mobile",
                "value" => array(
                    esc_html__('Yes, Please!', 'elessi-theme') => '1'
                )
            ));
        }
        
        /**
         * Custom shortcode
         */
        $param_nasa_sc_icons = array(
            "name" => esc_html__("Header Icons", 'elessi-theme'),
            "base" => "nasa_sc_icons",
            'icon' => 'icon-wpb-nasatheme',
            'description' => esc_html__("Header icons Cart | Wishlist | Compare", 'elessi-theme'),
            "category" => esc_html__('Header Builder', 'elessi-theme'),
            "params" => array(
                
                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Mini Account", 'elessi-theme'),
                    "param_name" => "show_mini_acc",
                    "value" => array(
                        esc_html__('Yes', 'elessi-theme') => 'yes',
                        esc_html__('No', 'elessi-theme') => 'no'
                    ),
                    "std" => 'yes',
                    "admin_label" => true
                ),

                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Mini Cart", 'elessi-theme'),
                    "param_name" => "show_mini_cart",
                    "value" => array(
                        esc_html__('Yes', 'elessi-theme') => 'yes',
                        esc_html__('No', 'elessi-theme') => 'no'
                    ),
                    "std" => 'yes',
                    "admin_label" => true
                ),

                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Mini Compare", 'elessi-theme'),
                    "param_name" => "show_mini_compare",
                    "value" => array(
                        esc_html__('Yes', 'elessi-theme') => 'yes',
                        esc_html__('No', 'elessi-theme') => 'no'
                    ),
                    "std" => 'yes',
                    "admin_label" => true
                ),

                array(
                    "type" => "dropdown",
                    "heading" => esc_html__("Show Mini Wishlist", 'elessi-theme'),
                    "param_name" => "show_mini_wishlist",
                    "value" => array(
                        esc_html__('Yes', 'elessi-theme') => 'yes',
                        esc_html__('No', 'elessi-theme') => 'no'
                    ),
                    "std" => 'yes',
                    "admin_label" => true
                ),

                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'elessi-theme'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'elessi-theme')
                )
            )
        );
        vc_map($param_nasa_sc_icons);

        /**
         * Search form in header
         */
        $param_nasa_search = array(
            "name" => esc_html__("Header Search", 'elessi-theme'),
            "base" => "nasa_sc_search_form",
            'icon' => 'icon-wpb-nasatheme',
            'description' => esc_html__("Header search form", 'elessi-theme'),
            "category" => esc_html__('Header Builder', 'elessi-theme'),
            "params" => array(
                array(
                    "type" => "textfield",
                    "heading" => esc_html__("Extra class name", 'elessi-theme'),
                    "param_name" => "el_class",
                    "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'elessi-theme')
                )
            )
        );
        
        vc_map($param_nasa_search);
        
        // if (function_exists('nasa_header_icons_sc')) {
        //     add_shortcode('nasa_sc_icons', 'nasa_header_icons_sc');
        // }
        
        // if (function_exists('nasa_header_search_sc')) {
        //     add_shortcode('nasa_sc_search_form', 'nasa_header_search_sc');
        // }
    }
endif;

/* add_filter('vc_map_get_attributes', 'elessi_ct_attrs_tabs', 10, 2);
if (!function_exists('elessi_ct_attrs_tabs')) :
    function elessi_ct_attrs_tabs($atts, $tag) {
        if ($tag == 'vc_tta_section') {
            $atts['before_tab_title'] = $atts['before_tab_title'] ? html_entity_decode($atts['before_tab_title']) : '';
            $atts['after_tab_title'] = $atts['after_tab_title'] ? html_entity_decode($atts['after_tab_title']) : '';
        }
        
        return $atts;
    }
endif; */

/**
 * Support Upload SVG Media
 */
add_filter('upload_mimes', 'elessi_enable_svg_upload', 10, 1);
if (!function_exists('elessi_enable_svg_upload')) :
    function elessi_enable_svg_upload($mimes) {
        global $nasa_opt;
        
        if (!isset($nasa_opt['sp_upload_svg']) || $nasa_opt['sp_upload_svg']) {
            $mimes['svg'] = 'image/svg+xml';
            $mimes['svgz'] = 'image/svg+xml';
        }
        
        return $mimes;
    }
endif;

/**
 * *.ico check
 */
add_filter('wp_check_filetype_and_ext', 'elessi_check_ico_ext', 10, 4);
if (!function_exists('elessi_check_ico_ext')) :
    function elessi_check_ico_ext($types, $file, $filename, $mimes) {
        global $nasa_opt;
        
        if (isset($nasa_opt['sp_upload_ico']) && $nasa_opt['sp_upload_ico']) {
            if (false !== strpos($filename, '.ico')) {
                $types['ext'] = 'ico';
                $types['type'] = 'image/ico';
            }
        }
        
        return $types;
    }
endif;

/**
 * Support Upload ICO Media
 */
add_filter('upload_mimes', 'elessi_enable_ico_upload', 10, 1);
if (!function_exists('elessi_enable_ico_upload')) :
    function elessi_enable_ico_upload($mimes) {
        global $nasa_opt;
        
        if (isset($nasa_opt['sp_upload_ico']) && $nasa_opt['sp_upload_ico']) {
            $mimes['ico'] = 'image/ico';
        }
        
        return $mimes;
    }
endif;

/**
 * HTML Loader
 */
if (!function_exists('elessi_loader_html')) :
    function elessi_loader_html($id_attr = null, $relative = true) {
        $id = $id_attr != null ? ' id="' . esc_attr($id_attr) . '"' : '';
        $class = $relative ? ' class="nasa-relative nasa-fullsize"' : '';
        
        return 
            '<div' . $id . $class . '>' .
                '<div class="nasa-loader"></div>' .
            '</div>';
    }
endif;

/**
 * Start captcha
 */
if (!function_exists('elessi_start_session')) :
    function elessi_start_session() {
        if (!session_id()) {
            session_start();
        }
    }
endif;

/**
 * Captcha for Register form
 */
add_action('init', 'elessi_register_field_captcha_img');
if (!function_exists('elessi_register_field_captcha_img')) :
    function elessi_register_field_captcha_img() {
        global $nasa_opt;
        if (!isset($nasa_opt['register_captcha']) || !$nasa_opt['register_captcha']) {
            return;
        }
        
        /**
         * No support - server no support create image
         */
        if (!function_exists('imagecreatetruecolor')) {
            return;
        }
        
        if (isset($_REQUEST['nasa-captcha-register']) && $_REQUEST['nasa-captcha-register'] === '1') {
            require_once ELESSI_THEME_PATH . '/cores/nasa-captcha.php';

            $captcha = new Nasa_Captcha();
            
            if (!$captcha) {
                return;
            }
            
            $code = $captcha->get_and_show_image();

            elessi_start_session();

            // Save code session
            $_SESSION['nasa_captcha_code_' . $_REQUEST['nasa-captcha-register']] = $code;

            die();
        }

        return;
    }
endif;

/**
 * Add field captcha for Register form
 */
add_action('woocommerce_register_form', 'elessi_register_form_field_captcha');
if (!function_exists('elessi_register_form_field_captcha')) :
    function elessi_register_form_field_captcha() {
        global $nasa_opt;
        if (!isset($nasa_opt['register_captcha']) || !$nasa_opt['register_captcha']) {
            return;
        }
        
        /**
         * No support - server no support create image
         */
        if (!function_exists('imagecreatetruecolor')) {
            return;
        }
        
        echo '<p class="nasa-form-row-captcha hidden-tag"></p>';
    }
endif;

/**
 * Check error Captcha
 */
add_filter('woocommerce_registration_errors', 'elessi_check_captcha_registration_errors', 10, 3);
if (!function_exists('elessi_check_captcha_registration_errors')) :
    function elessi_check_captcha_registration_errors($errors, $username, $email) {
        global $nasa_opt;
        
        /**
         * Disable check Captcha
         */
        if (!isset($nasa_opt['register_captcha']) || !$nasa_opt['register_captcha']) {
            return $errors;
        }
        
        /**
         * No support - server no support create image
         */
        if (!function_exists('imagecreatetruecolor')) {
            return $errors;
        }
        
        /**
         * Ignore when Create Account in Checkout page
         */
        if (isset($_REQUEST['wc-ajax']) && $_REQUEST['wc-ajax'] == 'checkout') {
            return $errors;
        }

        /**
         * Init check
         */
        $input = array();

        /**
         * For Ajax form
         */
        if (isset($_REQUEST['data']) && $_REQUEST['data']) {
            foreach ($_REQUEST['data'] as $values) {
                if (isset($values['name']) && isset($values['value'])) {
                    $input[$values['name']] = $values['value'];
                }
            }
        }

        /**
         * For Default form
         */
        else {
            if (isset($_REQUEST['nasa-captcha-key'])) {
                $input['nasa-captcha-key'] = $_REQUEST['nasa-captcha-key'];
            }

            if (isset($_REQUEST['nasa-input-captcha'])) {
                $input['nasa-input-captcha'] = $_REQUEST['nasa-input-captcha'];
            }
        }
        
        /**
         * Check error Captcha
         */
        elessi_start_session();
        if (
            !isset($input['nasa-captcha-key']) ||
            !isset($input['nasa-input-captcha']) ||
            !isset($_SESSION['nasa_captcha_code_' . $input['nasa-captcha-key']]) ||
            $_SESSION['nasa_captcha_code_' . $input['nasa-captcha-key']] != strtolower($input['nasa-input-captcha'])) {
            
            $errors->add('nasa-captcha-register', esc_html__('Captcha Error!', 'elessi-theme'));
        }

        return $errors;
    }
endif;
