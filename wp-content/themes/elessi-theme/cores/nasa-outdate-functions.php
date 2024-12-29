<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Get term description
 * 
 * Outdate from 2.1.4
 */
if (!function_exists('elessi_term_description')) :
    function elessi_term_description($term_id, $type_taxonomy) {
        _deprecated_function(__FUNCTION__, '2.1.4', null);
    
        if (!NASA_WOO_ACTIVED) {
            return '';
        }
        
        if ((int) $term_id < 1) {
            $shop_page = get_post(wc_get_page_id('shop'));
            $desc = $shop_page ? wc_format_content($shop_page->post_content) : '';
        } else {
            $term = get_term($term_id, $type_taxonomy);
            $desc = isset($term->description) ? $term->description : '';
        }
        
        return trim($desc) != '' ? '<div class="page-description">' . do_shortcode($desc) . '</div>' : '';
    }
endif;

/**
 * Get cat header content
 * 
 * Outdate from 2.1.4
 */
if (!function_exists('elessi_get_cat_header')):
    function elessi_get_cat_header($catId = null) {
        _deprecated_function(__FUNCTION__, '2.1.4', null);
    
        global $nasa_opt;
        
        if (isset($nasa_opt['enable_cat_header']) && $nasa_opt['enable_cat_header'] != '1') {
            return '';
        }

        $content = '<div class="cat-header nasa-cat-header padding-top-20">';
        $do_content = '';
        
        if ((int) $catId > 0) {
            $shortcode = function_exists('get_term_meta') ? get_term_meta($catId, 'cat_header', false) : get_woocommerce_term_meta($catId, 'cat_header', false);
            $do_content = isset($shortcode[0]) ? do_shortcode($shortcode[0]) : '';
        }

        if (trim($do_content) === '') {
            if (isset($nasa_opt['cat_header']) && $nasa_opt['cat_header'] != '') {
                $do_content = do_shortcode($nasa_opt['cat_header']);
            }
        }

        if (trim($do_content) === '') {
            return '';
        }

        $content .= $do_content . '</div>';

        return $content;
    }
endif;

/**
 * Deprecated
 * 
 * Language Flags
 * 
 * Not use from 4.6.2
 */
if (!function_exists('elessi_language_flages')) :
    function elessi_language_flages() {
        _deprecated_function(__FUNCTION__, '4.6.2', 'elessi_multi_languages');
        
        global $nasa_opt;
        
        if (!isset($nasa_opt['switch_lang']) || $nasa_opt['switch_lang'] != 1) {
            return;
        }
        
        $language_output = '<div class="nasa-select-languages">';
        $mainLang = '';
        $selectLang = '<ul class="nasa-list-languages">';
        
        if (function_exists('icl_get_languages')) {
            $current = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : get_option('WPLANG');
            
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if (!empty($languages)) {
                foreach ($languages as $lang) {
                    
                    /**
                     * Current Language
                     */
                    if ($current == $lang['language_code']) {
                        $mainLang .= '<a href="javascript:void(0);" class="nasa-current-lang" rel="nofollow">';
                        
                        if (isset($lang['country_flag_url'])) {
                            $mainLang .= '<img src="' . esc_url($lang['country_flag_url']) . '" alt="' . esc_attr($lang['native_name']) . '" />';
                        }
                        
                        $mainLang .= $lang['native_name'];
                        $mainLang .= '</a>';
                    }
                    
                    /**
                     * Select Languages
                     */
                    else {
                        $selectLang .= '<li class="nasa-item-lang"><a href="' . esc_url($lang['url']) . '" title="' . esc_attr($lang['native_name']) . '" rel="nofollow">';

                        if (isset($lang['country_flag_url'])) {
                            $selectLang .= '<img src="' . esc_url($lang['country_flag_url']) . '" alt="' . esc_attr($lang['native_name']) . '" />';
                        }

                        $selectLang .= $lang['native_name'];
                        $selectLang .= '</a></li>';
                    }
                }
            }
        }
        
        /**
         * have not installs WPML
         */
        else {
            $mainLang .= '<a href="javascript:void(0);" class="nasa-current-lang" rel="nofollow">';
            // $mainLang .= '<img src="' . esc_url(ELESSI_THEME_URI . '/assets/images/en.png') . '" alt="English" />';
            $mainLang .= 'Requires WPML';
            $mainLang .= '</a>';
            
            /**
             * Select Languages
             */
            // English
            $selectLang .= '<li class="nasa-item-lang"><a href="javascript:void(0);" title="English">';
            // $selectLang .= '<img src="' . esc_url(ELESSI_THEME_URI . '/assets/images/en.png') . '" alt="English" />';

            $selectLang .= 'English';
            $selectLang .= '</a></li>';
            
            // German
            $selectLang .= '<li class="nasa-item-lang"><a href="javascript:void(0);" title="Deutsch">';
            // $selectLang .= '<img src="' . esc_url(ELESSI_THEME_URI . '/assets/images/de.png') . '" alt="Deutsch" />';

            $selectLang .= 'Deutsch';
            $selectLang .= '</a></li>';
            
            // French
            $selectLang .= '<li class="nasa-item-lang"><a href="javascript:void(0);" title="Français">';
            // $selectLang .= '<img src="' . esc_url(ELESSI_THEME_URI . '/assets/images/fr.png') . '" alt="Français" />';

            $selectLang .= 'Français';
            $selectLang .= '</a></li>';
        }
        
        $selectLang .= '</ul>';
        
        $language_output .= $mainLang . $selectLang . '</div>';

        echo '<ul class="header-switch-languages left rtl-right desktop-margin-right-30 rtl-desktop-margin-right-0 rtl-desktop-margin-left-30"><li>' . $language_output . '</li></ul>';
    }
endif;

/**
 * Change elessi_product_video_btn_function => elessi_product_video_btn
 */
if (function_exists('elessi_product_video_btn_function')) {
    remove_action('nasa_single_buttons', 'elessi_product_video_btn', 25);
    add_action('nasa_single_buttons', 'elessi_product_video_btn_function', 25);
}

/**
 * Change elessi_footer_layout_style_function => elessi_footer_layout
 */
if (function_exists('elessi_footer_layout_style_function')) {
    remove_action('nasa_footer_layout_style', 'elessi_footer_output');
    add_action('nasa_footer_layout_style', 'elessi_footer_layout_style_function');
}

/**
 * Change elessi_get_custom_field_value => elessi_get_product_meta_value
 * 
 * Not use from 4.6.2
 */
if (!function_exists('elessi_get_custom_field_value')) :
    function elessi_get_custom_field_value($post_id, $field_id) {
        _deprecated_function(__FUNCTION__, '4.6.2', 'elessi_get_product_meta_value');
        return elessi_get_product_meta_value($post_id, $field_id);
    }
endif;

/**
 * Add to cart button
 * 
 * Not use from 4.6.2
 */
if (!function_exists('elessi_add_to_cart_btn')):
    function elessi_add_to_cart_btn() {
        if (function_exists('woocommerce_template_loop_add_to_cart')) {
            _deprecated_function(__FUNCTION__, '4.6.2', 'woocommerce_template_loop_add_to_cart');
            woocommerce_template_loop_add_to_cart();
        }
    }
endif;


/**
 * Add to cart in list
 * 
 * Not use from 4.6.2
 */
if (!function_exists('elessi_add_to_cart_in_list')) :
    function elessi_add_to_cart_in_list() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['loop_add_to_cart']) || $nasa_opt['loop_add_to_cart']) {
            _deprecated_function(__FUNCTION__, '4.6.2', 'woocommerce_template_loop_add_to_cart');
            woocommerce_template_loop_add_to_cart();
        }
    }
endif;

/**
 * Mini Cart considered a Cart page if the incoming call is AJAX
 * 
 * Since 5.3.9
 * Not use from 6.1.7
 */
if (!function_exists('elessi_mini_cart_as_cart_page')) :
    function elessi_mini_cart_as_cart_page() {
        if (defined('DOING_AJAX') && DOING_AJAX) :
            wc_maybe_define_constant('WOOCOMMERCE_CART', true);
        endif;
    }
endif;
