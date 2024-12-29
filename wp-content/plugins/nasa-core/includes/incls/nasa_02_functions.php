<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Render Time sale countdown
 * 
 * @param type $time_sale
 * @return type
 */
function nasa_time_sale($time_sale = false, $gmt = true, $wrap = true) {
    $result = '';
    
    if ($time_sale) {
        $time_sale = apply_filters('nasa_time_sale_countdown', $time_sale);
        $gmt_set = apply_filters('nasa_gmt', $gmt);
        
        $date_str = $gmt_set ?
            get_date_from_gmt(date('Y-m-d H:i:s', $time_sale), 'M j Y H:i:s O') :
            date('M j Y H:i:s O', $time_sale);
        
        $result .= $wrap ? '<div class="nasa-sc-pdeal-countdown">' : '';
        $result .= '<span class="countdown" data-countdown="' . esc_attr($date_str) . '"></span>';
        $result .= $wrap ? '</div>' : '';
    }
    
    return $result;
}

/**
 * Fix shortcode content
 * 
 * @param type $content
 * @return type
 */
function nasa_fix_shortcode($content = '') {
    $fix = array(
        '&nbsp;' => '',
        '<p>' => '',
        '</p>' => '',
        '<p></p>' => '',
        '``' => '"'
    );
    
    $content = strtr($content, $fix);
    $content = wpautop(preg_replace('/<\/?p\>/', "\n", $content) . "\n");

    return do_shortcode(shortcode_unautop($content));
}

/**
 * Do shortcode for Ajax
 */
add_action('wp_ajax_get_shortcode', 'nasa_get_shortcode');
add_action('wp_ajax_nopriv_get_shortcode', 'nasa_get_shortcode');
function nasa_get_shortcode() {
    die(do_shortcode($_POST["content"]));
}

/**
 * Do Shortcode for widget text and the excerpt ...
 */
add_action('init', 'nasa_custom_do_sc');
function nasa_custom_do_sc() {
    add_filter('widget_text', 'do_shortcode');
    add_filter('the_excerpt', 'do_shortcode');
}

/**
 * Category thumbnail
 * 
 * @param type $category
 * @param type $type
 */
function nasa_category_thumbnail($category, $type) {
    $image_src = false;
    $small_thumbnail_size = apply_filters('subcategory_archive_thumbnail_size', $type);
    $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
    
    if ($thumbnail_id) {
        $image = wp_get_attachment_image_src($thumbnail_id, $small_thumbnail_size);
        if ($image && isset($image[0])) {
            $image_src = $image[0];
            $image_width = $image[1];
            $image_height = $image[2];
        }
    } else {
        $image_src = wc_placeholder_img_src();
        $image_width = 100;
        $image_height = 100;
    }

    if ($image_src) {
        echo '<img src="' . esc_url($image_src) . '" alt="' . esc_attr($category->name) . '" width="' . $image_width . '" height="' . $image_height . '" />';
    }
}

/**
 * Get Menu options Shortcode
 */
function nasa_get_menu_options($key_first = false) {
    global $nasa_menu_options;
    
    $key = !$key_first ? 'vf' : 'kf';
    
    if (!isset($nasa_menu_options[$key])) {
        $nasa_menu_options[$key] = !$key_first ? array(__("Select menu", 'nasa-core') => '') : array('' => __("Select menu", 'nasa-core'));
        
        $menus = wp_get_nav_menus(array('orderby' => 'name'));
        
        if (!empty($menus)) {
            
            if (!$key_first) {
                foreach ($menus as $menu_option) {
                    $nasa_menu_options[$key][$menu_option->name] = $menu_option->slug;
                }
            } else {
                foreach ($menus as $menu_option) {
                    $nasa_menu_options[$key][$menu_option->slug] = $menu_option->name;
                }
            }
        }
        
        $GLOBALS['nasa_menu_options'] = $nasa_menu_options;
    }
    
    return isset($nasa_menu_options[$key]) ? $nasa_menu_options[$key] : array();
}

/**
 * Get Pins
 * 
 * @param type $type
 * @return type
 */
function nasa_get_pin_arrays($type = 'nasa_pin_pb', $key_first = false) {
    global $nasa_pins;
    
    if (!isset($nasa_pins)) {
        $nasa_pins = array();
    }
    
    $key = $type;
    $key .= $key_first ? '_key' : '';
    
    if (!isset($nasa_pins[$key])) {
        $nasa_pins[$key] = !$key_first ? array(__('Select Item', 'nasa-core') => '') : array('' => __('Select Item', 'nasa-core'));
        
        $pins = get_posts(array(
            'posts_per_page'    => -1,
            'post_status'       => 'publish',
            'post_type'         => $type
        ));

        if ($pins) {
            if (!$key_first) {
                foreach ($pins as $pin) {
                    $nasa_pins[$key][$pin->post_title] = $pin->post_name;
                }
            } else {
                foreach ($pins as $pin) {
                    $nasa_pins[$key][$pin->post_name] = $pin->post_title;
                }
            }
        }
        
        $GLOBALS['nasa_pins'] = $nasa_pins;
    }
    
    return $nasa_pins[$key];
}

/**
 * Get Revolution Sliders
 */
function nasa_get_revsliders_arrays($key_first = false) {
    if (!class_exists('RevSlider')) {
        return array();
    }
    
    global $nasa_revsliders;
    
    if (!isset($nasa_revsliders)) {
        $nasa_revsliders = array();
    }
    
    $key = !$key_first ? 'vf' : 'kf';
    
    if (!isset($nasa_revsliders[$key])) {
        $nasa_revsliders[$key] = !$key_first ? array(__('Select Rev Slider Item', 'nasa-core') => '') : array('' => __('Select Rev Slider Item', 'nasa-core'));
        
        if (!class_exists('RevSlider')) {
            return $nasa_revsliders;
        }
        
        $slider = new RevSlider();
        $revs = $slider->get_sliders();

        if ($revs) {
            if (!$key_first) {
                foreach ($revs as $rev) {
                    $nasa_revsliders[$key][$rev->title] = $rev->alias;
                }
            } else {
                foreach ($revs as $rev) {
                    $nasa_revsliders[$key][$rev->alias] = $rev->title;
                }
            }
        }
        
        $GLOBALS['nasa_revsliders'] = $nasa_revsliders;
    }
    
    return $nasa_revsliders[$key];
}

/**
 * get HEF by id
 * 
 * @param type $id
 */
function nasa_get_hfe_by_id($id) {
    if (!class_exists('Header_Footer_Elementor')) {
        return '';
    }
    
    /**
     * Compatible with WPML
     */
    if (function_exists('icl_object_id') && (int) $id) {
        $langID = icl_object_id($id, 'elementor-hf', true);
        
        if ($langID && $langID != $id) {
            $lang = get_post($langID);
            $id = $lang && $lang->post_status == 'publish' ? $langID : $id;
        }
    }

    /**
     * Render content
     */
    $hfe_obj = Header_Footer_Elementor::instance();
    
    return $hfe_obj->render_template(array('id' => $id));
}

/**
 * get HEF by id
 * 
 * @param type $id
 */
function nasa_hfe_shortcode_by_id($id = 0, $return = false) {
    if (!shortcode_exists('hfe_template')) {
        return '';
    }
    
    /**
     * Compatible with WPML
     */
    if (function_exists('icl_object_id') && (int) $id) {
        $lang_id = icl_object_id($id, 'elementor-hf', true);
        
        if ($lang_id && $lang_id != $id) {
            $lang = get_post($lang_id);
            $id = ($lang && $lang->post_status == 'publish') ? $lang_id : $id;
        }
    }
    
    if ($return) {
        return do_shortcode('[hfe_template id="' . $id . '"]');
    }
    
    echo do_shortcode('[hfe_template id="' . $id . '"]');
}

/**
 * get Header by slug
 * 
 * @param type $slug
 */
function nasa_get_header($slug) {
    if (!$slug) {
        return;
    }

    $args = array(
        'name' => $slug,
        'posts_per_page' => 1,
        'post_type' => 'header',
        'post_status' => 'publish'
    );

    $headers_type = get_posts($args);
    $header = isset($headers_type[0]) ? $headers_type[0] : null;
    $header_id = isset($header->ID) ? (int) $header->ID : null;

    if (function_exists('icl_object_id') && (int) $header_id) {
        $header_langID = icl_object_id($header_id, 'header', true);
        
        if ($header_langID && $header_langID != $header_id) {
            $headerLang = get_post($header_langID);
            
            $header = $headerLang && $headerLang->post_status == 'publish' ? $headerLang : $header;
            $header_id = $header_langID;
        }
    }

    $content = '';
    if ($header && isset($header->post_content)) {
        $content = nasa_get_custom_style($header_id);
        $content .= do_shortcode($header->post_content);
    }
    
    return $content;
}

/**
 * get Footer by slug
 * 
 * @param type $slug
 */
function nasa_get_footer($slug) {
    if (!$slug) {
        return;
    }

    $args = array(
        'posts_per_page' => 1,
        'post_type' => 'footer',
        'post_status' => 'publish',
        'name' => $slug
    );

    $footers_type = get_posts($args);
    $footer = isset($footers_type[0]) ? $footers_type[0] : null;
    $footer_id = isset($footer->ID) ? (int) $footer->ID : null;
    $footer_pageID = $footer_id;

    /**
     * Support Multi Languages
     */
    if (function_exists('icl_object_id') && (int) $footer_id) {
        $footer_langID = icl_object_id($footer_id, 'footer', true);
        
        if ($footer_langID && $footer_langID != $footer_id) {
            $footerLang = get_post($footer_langID);
            
            $footer = $footerLang && $footerLang->post_status == 'publish' ? $footerLang : $footer;
            $footer_pageID = $footer_langID;
        }
    }

    $content = '';
    if ($footer && isset($footer->post_content)) {
        $content .= nasa_get_custom_style($footer_pageID);
        $content .= do_shortcode($footer->post_content);
    }
    
    return $content;
}

/**
 * Get Block by slug
 * 
 * @param type $slug
 * @return type
 */
function nasa_get_block($slug) {
    $elm_block = strpos($slug, 'nshfe.') === 0 ? true : false;
    
    if (!$elm_block) {
        
        $block = $slug && $slug !== 'default' ? get_posts(
            array(
                'name'              => $slug,
                'posts_per_page'    => 1,
                'post_type'         => 'nasa_block',
                'post_status'       => 'publish'
            )
        ) : null;
    
        $post = !empty($block) ? $block[0] : null;
        $real_id = $post ? $post->ID : 0;

        /**
         * With Multi Languages
         */
        if (function_exists('icl_object_id') && $real_id) {
            $post_lang_id = icl_object_id($real_id, 'nasa_block', true);

            if ($post_lang_id && $post_lang_id != $real_id) {
                $post_lang = get_post($post_lang_id);
                $post = $post_lang && $post_lang->post_status == 'publish' ? $post_lang : $post;
                $real_id = $post_lang_id;
            }
        }

        $content = '';

        if ($post && isset($post->post_content)) {
            $content .= nasa_get_custom_style($real_id);
            $content .= do_shortcode($post->post_content);
        }
    } else {
        $id = (int) str_replace('nshfe.', '', $slug);
        
        $content = nasa_hfe_shortcode_by_id($id, true);
    }

    return $content;
}

/**
 * Get Block OBJ by slug
 * 
 * @param type $slug
 * @return type
 */
function nasa_get_block_obj($slug) {
    $elm_block = strpos($slug, 'nshfe.') === 0 ? true : false;
    $result = null;
    
    /**
     * Default Nasa Block
     */
    if (!$elm_block) {
        $block = $slug && $slug !== 'default' ? get_posts(
            array(
                'name'              => $slug,
                'posts_per_page'    => 1,
                'post_type'         => 'nasa_block',
                'post_status'       => 'publish'
            )
        ) : null;

        $post = !empty($block) ? $block[0] : null;
        $real_id = $post ? $post->ID : 0;

        /**
         * With Multi Languages
         */
        if (function_exists('icl_object_id') && $real_id) {
            $post_lang_id = icl_object_id($real_id, 'nasa_block', true);

            if ($post_lang_id && $post_lang_id != $real_id) {
                $post_lang = get_post($post_lang_id);
                $post = $post_lang && $post_lang->post_status == 'publish' ? $post_lang : $post;
                $real_id = $post_lang_id;
            }
        }

        if ($post) {
            $result = array(
                'title' => $post->post_title,
                'content' => nasa_get_custom_style($real_id) . do_shortcode($post->post_content)
            );
        }
    }
    
    /**
     * For HFE Plugin
     */
    else {
        $id = (int) str_replace('nshfe.', '', $slug);
        $content = nasa_hfe_shortcode_by_id($id, true);
        
        if ($content) {
            $post = get_post($id);
            $real_id = $post ? $post->ID : 0;

            /**
             * With Multi Languages
             */
            if (function_exists('icl_object_id') && $real_id) {
                $post_lang_id = icl_object_id($real_id, 'elementor-hf', true);

                if ($post_lang_id && $post_lang_id != $real_id) {
                    $post_lang = get_post($post_lang_id);
                    $post = $post_lang && $post_lang->post_status == 'publish' ? $post_lang : $post;
                }
            }
            
            $result = array(
                'title' => $post->post_title,
                'content' => $content
            );
        }
    }

    return $result;
}

/**
 * get custom css by post id
 */
function nasa_get_custom_style($post_id) {
    $content = '';
    
    if (!$post_id) {
        return $content;
    }
    
    $shortcodes_custom_css = get_post_meta($post_id, '_wpb_shortcodes_custom_css', true);
    if (!empty($shortcodes_custom_css)) {
        $content .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
        $content .= strip_tags($shortcodes_custom_css);
        $content .= '</style>';
    }
    
    return $content;
}

/**
 * Label empty select nasa custom taxonomies
 * 
 * @param type $level
 * @return type
 */
function nasa_render_select_nasa_cats_empty($level = '0') {
    switch ($level) :
        case '1':
            return __('Select Level 1', 'nasa-core');
        case '2':
            return __('Select Level 2', 'nasa-core');
        case '3':
            return __('Select Level 3', 'nasa-core');
        default:
            return __('Select Model', 'nasa-core');
    endswitch;
}

/**
 * get No-Image
 */
function nasa_no_image($only_src = false) {
    $src = function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src() : apply_filters('nasa_src_no_image', NASA_CORE_PLUGIN_URL . 'assets/images/no_image.jpg');
    
    return $only_src ? esc_url($src) : '<img src="' . esc_url($src) . '" alt="' . esc_attr__('No Image', 'nasa-core') . '" />';
}

/**
 * Get relates post
 */
add_action('nasa_after_single_post', 'nasa_relate_posts');
if (!function_exists('nasa_relate_posts')) :
    function nasa_relate_posts() {
        global $nasa_opt, $post;
        
        if (isset($nasa_opt['relate_blogs']) && !$nasa_opt['relate_blogs']) {
            return;
        }
        
        $numberPost = isset($nasa_opt['relate_blogs_number']) && (int) $nasa_opt['relate_blogs_number'] ? (int) $nasa_opt['relate_blogs_number'] : 10;
        
        $relate = get_posts(
            array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'category__in' => wp_get_post_categories($post->ID),
                'numberposts' => $numberPost,
                'post__not_in' => array($post->ID),
                'orderby' => 'date',
                'order' => 'DESC'
            )
        );
        
        if ($relate) {
            nasa_template('blogs/single/nasa-blog-relate.php', array('relate' => $relate));
        }
    }
endif;

/**
 * Set nasa_opt - Header structure
 */
add_action('template_redirect', 'nasa_header_structure');
function nasa_header_structure() {
    global $nasa_opt, $post;
    
    $hstructure = isset($nasa_opt['header-type']) ? $nasa_opt['header-type'] : '1';
    $page_id = false;
    $header_override = false;
    $header_beside_block_ov = false;
    $header_slug = isset($nasa_opt['header-custom']) && $nasa_opt['header-custom'] != 'default' ?
        $nasa_opt['header-custom'] : false;
    
    $header_e = isset($nasa_opt['header-elm']) && $nasa_opt['header-elm'] != 'default' ?
        $nasa_opt['header-elm'] : false;
    
    $header_slug_ovrride = false;
    $header_e_ovrride = false;
    $fixed_nav_header = '';
    
    /**
     * Top bar
     */
    $topbar_on = !isset($nasa_opt['topbar_on']) || $nasa_opt['topbar_on'] ? true : false;
    $topbar_on_ov = '';
    
    /**
     * Menu Vertical
     */
    $vmenu = isset($nasa_opt['vertical_menu_selected']) ? $nasa_opt['vertical_menu_selected'] : false;
    $vvisible = false;
    $v_root = isset($nasa_opt['v_root']) ? $nasa_opt['v_root'] : false;
    $v_root_limit = isset($nasa_opt['v_root_limit']) ? (int) $nasa_opt['v_root_limit'] : false;

    $is_shop = $page_shop = $is_product_taxonomy = $is_product = false;
    if (NASA_WOO_ACTIVED) {
        $is_shop = is_shop();
        $is_product = is_product();
        $is_product_taxonomy = is_product_taxonomy();
        $page_shop = wc_get_page_id('shop');
    }

    /**
     * Override Header
     */
    $root_term_id = nasa_root_term_id();
    
    if (!$root_term_id) {
        /**
         * Store Page
         */
        if (($is_shop || $is_product_taxonomy) && $page_shop > 0) {
            $page_id = $page_shop;
        }

        /**
         * Page
         */
        if (!$page_id && isset($post->post_type) && $post->post_type == 'page') {
            $page_id = $post->ID;
        }

        /**
         * Blog
         */
        if (!$page_id && nasa_check_blog_page()) {
            $page_id = get_option('page_for_posts');
        }

        /**
         * Swith header structure
         */
        if ($page_id) {
            $custom_header = get_post_meta($page_id, '_nasa_custom_header', true);
            
            if (!empty($custom_header)) {
                $hstructure = $custom_header;
                
                if ($hstructure == 'nasa-custom') {
                    $header_slug_ovrride = get_post_meta($page_id, '_nasa_header_builder', true);
                }
                
                if ($hstructure == 'nasa-elm') {
                    $header_e_ovrride = get_post_meta($page_id, '_nasa_header_elm', true);
                }
            }

            if (in_array($hstructure, array('4', '6'))) {
                $header_beside_block_ov = get_term_meta($page_id, '_nasa_header_block', true);
            }

            $fixed_nav_header = get_post_meta($page_id, '_nasa_fixed_nav', true);
            $fixed_nav_header = $fixed_nav_header == '-1' ? false : $fixed_nav_header;
            
            /**
             * Top bar
             */
            $topbar_on_ov = get_post_meta($page_id, '_nasa_topbar_on', true);
            
            /**
             * Vertical Menu
             */
            $vmenu = get_post_meta($page_id, '_nasa_vertical_menu_selected', true);
            $vvisible = get_post_meta($page_id, '_nasa_vertical_menu_allways_show', true);
            $v_root = get_post_meta($page_id, '_nasa_v_root', true);
            $v_root_limit = get_post_meta($page_id, '_nasa_v_root_limit', true);
        }
    }

    else {
        /**
         * For Root category (parent = 0)
         */
        $header_override = get_term_meta($root_term_id, 'cat_header_type', true);

        if ($header_override == 'nasa-custom') {
            $hstructure = $header_override;
            $header_slug_ovrride = get_term_meta($root_term_id, 'cat_header_builder', true);
        }
        elseif ($header_override == 'nasa-elm') {
            $hstructure = $header_override;
            $header_e_ovrride = get_term_meta($root_term_id, 'cat_header_elm', true);
        } else {
            $hstructure = $header_override ? $header_override : $hstructure;
        }

        if (in_array($hstructure, array('4', '6'))) {
            $header_beside_block_ov = get_term_meta($root_term_id, 'cat_the_block_beside_main_menu_4_6', true);
        }
        
        /**
         * Top bar
         */
        $topbar_on_ov = get_term_meta($root_term_id, 'cat_topbar_on', true);
        
        /**
         * Vertical Menu
         */
        $vmenu = get_term_meta($root_term_id, 'cat_header_vertical_menu', true);
        $v_root = get_term_meta($root_term_id, 'cat_header_v_root', true);
        $v_root_limit = get_term_meta($root_term_id, 'cat_header_v_root_limit', true);
    }
    
    if ($fixed_nav_header === '') {
        $fixed_nav_header = (!isset($nasa_opt['fixed_nav']) || $nasa_opt['fixed_nav']);
    }
    
    /**
     * Transparent header
     */
    $header_transparent = $page_id ? get_post_meta($page_id, '_nasa_header_transparent', true) : '';
    $header_transparent = $header_transparent == '-1' ? '0' : $header_transparent;
    $header_transparent = $header_transparent == '' ? false : (bool) $header_transparent;
    
    /**
     * Full width main menu
     */
    $full_rule_headers = array('2', '3');
    if (in_array($hstructure, $full_rule_headers)) {
        $fullwidth_main_menu = (isset($nasa_opt['fullwidth_main_menu']) && !$nasa_opt['fullwidth_main_menu']) ? false : true;
        $fullwidth_ovr = $page_id ? get_post_meta($page_id, '_nasa_fullwidth_main_menu', true) : $fullwidth_main_menu;
        if ($fullwidth_ovr !== '') {
            $fullwidth_main_menu = $fullwidth_ovr === '-1' ? false : $fullwidth_ovr;
        }
    } else {
        $fullwidth_main_menu = false;
    }
    
    /**
     * el_class for header
     */
    $el_class_header = $page_id ? get_post_meta($page_id, '_nasa_el_class_header', true) : '';
    
    /**
     * Re-Render
     */
    $nasa_opt['header-type'] = apply_filters('nasa_header_structure_type', $hstructure);
    $nasa_opt['header-custom'] = $header_slug_ovrride ? $header_slug_ovrride : $header_slug;
    $nasa_opt['header-elm'] = $header_e_ovrride ? $header_e_ovrride : $header_e;
    $nasa_opt['fixed_nav'] = $fixed_nav_header;
    $nasa_opt['header_transparent'] = $header_transparent;
    $nasa_opt['fullwidth_main_menu'] = $fullwidth_main_menu;
    if ($el_class_header) {
        $nasa_opt['el_class_header'] = $el_class_header;
    }
    
    if ($nasa_opt['header-type'] == 'nasa-elm') {
        $nasa_opt['header-elm'] = isset($nasa_opt['header-elm']) && $nasa_opt['header-elm'] != 'default' ?
            $nasa_opt['header-elm'] : false;

        if (apply_filters('ns_hfe_template_render_focus', false)) {
            if ($nasa_opt['header-elm']) {
                $GLOBALS['nasa_header_hfe'] = nasa_get_hfe_by_id($nasa_opt['header-elm']);
            }
        }
    }

    /**
     * The Block beside Main menu in Header Type 4, 6
     */
    if ($header_beside_block_ov) {
        $nasa_opt['header-block-type_4'] = $header_beside_block_ov;
    }
    
    /**
     * Top bar
     */
    if ($topbar_on_ov !== '') {
        $topbar_on = $topbar_on_ov === '2' ? false : true;
        $nasa_opt['topbar_on'] = $topbar_on;
    }
    
    /**
     * Vertical Menu
     */
    if ($vmenu) {
        $nasa_opt['vertical_menu_selected'] = $vmenu;
    }
    
    if ($vvisible) {
        $nasa_opt['v_menu_visible'] = $vvisible;
    }
    
    if ($v_root) {
        $nasa_opt['v_root'] = $v_root;
    }
    
    if ($v_root_limit) {
        $nasa_opt['v_root_limit'] = $v_root_limit;
    }
            
    $GLOBALS['nasa_opt'] = $nasa_opt;
}

/**
 * Set nasa_opt - Header structure
 */
add_action('template_redirect', 'nasa_footer_structure');
function nasa_footer_structure() {
    global $nasa_opt, $post;
        
    $in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
    $cat_popup_static_block = false;

    $footer_mode = isset($nasa_opt['footer_mode']) ? $nasa_opt['footer_mode'] : 'builder';
    $footer_mode = $footer_mode == 'builder-e' && !NASA_HF_BUILDER ? 'builder' : $footer_mode;

    if (!isset($nasa_opt['f_buildin']) || !$nasa_opt['f_buildin']) {
        $footer_mode = $footer_mode == 'build-in' ? 'builder' : $footer_mode;
    }

    /**
     * Init Footer Builder - WPBakery
     */
    $footer_builder = isset($nasa_opt['footer-type']) ? $nasa_opt['footer-type'] : false;
    $footer_builder_m = isset($nasa_opt['footer-mobile']) ? $nasa_opt['footer-mobile'] : false;
    $footer_builder_m = $footer_builder_m == 'default' ? $footer_builder : $footer_builder_m;

    /**
     * Init Footer Builder - HEF Elementor
     */
    $footer_builder_e = isset($nasa_opt['footer_elm']) ? $nasa_opt['footer_elm'] : false;
    $footer_builder_e_m = isset($nasa_opt['footer_elm_mobile']) ? $nasa_opt['footer_elm_mobile'] : false;
    $footer_builder_e_m = $footer_builder_e_m ? $footer_builder_e_m : $footer_builder_e; // Ext-Desktop
    
    /**
     * Init Footer Build-in - WP Widgets
     */
    $footer_buildin = isset($nasa_opt['footer_build_in']) ? $nasa_opt['footer_build_in'] : false;
    $footer_buildin_m = isset($nasa_opt['footer_build_in_mobile']) ? $nasa_opt['footer_build_in_mobile'] : false;
    $footer_buildin_m = $footer_buildin_m === '' ? $footer_buildin : $footer_buildin_m; // Ext-Desktop

    $footer_override = false;
    $footer_mode_override = false;
    
    $page_id = $is_shop = $page_shop = $is_product_taxonomy = $is_product = false;
    
    if (NASA_WOO_ACTIVED) {
        $is_shop = is_shop();
        $is_product = is_product();
        $is_product_taxonomy = is_product_taxonomy();
        $page_shop = wc_get_page_id('shop');
    }
    
    $root_term_id = nasa_root_term_id();

    /*
     * For Page
     */
    if (!$root_term_id) {
        /**
         * Store Page
         */
        if (($is_shop || $is_product_taxonomy) && $page_shop > 0) {
            $page_id = $page_shop;
        }

        /**
         * Page
         */
        if (!$page_id && isset($post->post_type) && $post->post_type == 'page') {
            $page_id = $post->ID;
        }

        /**
         * Blog
         */
        if (!$page_id && nasa_check_blog_page()) {
            $page_id = get_option('page_for_posts');
        }

        /**
         * Switch footer
         */
        if ($page_id) {
            $footer_mode_override = get_post_meta($page_id, '_nasa_footer_mode', true);
            $cat_popup_static_block = get_post_meta($page_id, '_nasa_popup_static_block', true);

            if ($in_mobile) {
                switch ($footer_mode_override) :
                    case 'builder' :
                        $footer_override_m = get_post_meta($page_id, '_nasa_custom_footer_mobile', true);
                        
                        if (!$footer_override_m) {
                            $footer_override_m = get_post_meta($page_id, '_nasa_custom_footer', true);
                        }
                        
                        $footer_builder_m = $footer_override_m ? $footer_override_m : $footer_builder_m;
                        
                        break;

                    case 'builder-e' :
                        $footer_override_m = get_post_meta($page_id, '_nasa_footer_builder_e_mobile', true);
                        
                        if (!$footer_override_m) {
                            $footer_override_m = get_post_meta($page_id, '_nasa_footer_builder_e', true);
                        }
                        
                        $footer_builder_e_m = $footer_override_m ? $footer_override_m : $footer_builder_e_m;
                        
                        break;
                        
                    case 'build-in' :
                        if (isset($nasa_opt['f_buildin']) && $nasa_opt['f_buildin']) {
                            $footer_override_m = get_post_meta($page_id, '_nasa_footer_build_in_mobile', true);
                            
                            if ($footer_override_m == '') {
                                $footer_override_m = get_post_meta($page_id, '_nasa_footer_build_in', true);
                            }
                            
                            $footer_buildin_m = $footer_override_m ? $footer_override_m : $footer_buildin_m;
                        }

                        break;

                    default :

                        break;
                endswitch;
            }

            /**
             * Desktop
             */
            else {
                switch ($footer_mode_override) :
                    case 'builder' :
                        $footer_override = get_post_meta($page_id, '_nasa_custom_footer', true);
                        
                        $footer_builder = $footer_override ? $footer_override : $footer_builder;
                                
                        break;

                    case 'builder-e' :
                        $footer_override = get_post_meta($page_id, '_nasa_footer_builder_e', true);
                        
                        $footer_builder_e = $footer_override ? $footer_override : $footer_builder_e;
                        
                        break;
                    
                    case 'build-in' :
                        if (isset($nasa_opt['f_buildin']) && $nasa_opt['f_buildin']) {
                            $footer_override = get_post_meta($page_id, '_nasa_footer_build_in', true);
                            
                            $footer_buildin = $footer_override ? $footer_override : $footer_buildin;
                        }

                        break;

                    default :

                        break;
                endswitch;
            }
        }
    }

    /**
     * For Root Category
     */
    else {
        $footer_mode_override = get_term_meta($root_term_id, 'cat_footer_mode', true);
        $cat_popup_static_block = get_term_meta($root_term_id, 'cat_popup_static_block', true);

        /**
         * Mobile
         */
        if ($in_mobile) {
            switch ($footer_mode_override) :
                case 'builder' :
                    $footer_override_m = get_term_meta($root_term_id, 'cat_footer_mobile', true);
                    
                    if (!$footer_override_m) {
                        $footer_override_m = get_term_meta($root_term_id, 'cat_footer_type', true);
                    }
                    
                    $footer_builder_m = $footer_override_m ? $footer_override_m : $footer_builder_m;
                    
                    break;

                case 'builder-e' :
                    $footer_override_m = get_term_meta($root_term_id, 'cat_footer_builder_e_mobile', true);
                    
                    if (!$footer_override_m) {
                        $footer_override_m = get_term_meta($root_term_id, 'cat_footer_builder_e', true);
                    }
                    
                    $footer_builder_e_m = $footer_override_m ? $footer_override_m : $footer_builder_e_m;
                    
                    break;
                    
                case 'build-in' :
                    if (isset($nasa_opt['f_buildin']) && $nasa_opt['f_buildin']) {
                        $footer_override_m = get_term_meta($root_term_id, 'cat_footer_build_in_mobile', true);
                        
                        if ($footer_override_m == '') {
                            $footer_override_m = get_term_meta($root_term_id, 'cat_footer_build_in', true);
                        }
                        
                        $footer_buildin_m = $footer_override_m ? $footer_override_m : $footer_buildin_m;
                    }

                    break;

                default :

                    break;
            endswitch;
        }

        /**
         * Desktop
         */
        else {
            switch ($footer_mode_override) :
                case 'builder' :
                    $footer_override = get_term_meta($root_term_id, 'cat_footer_type', true);
                    
                    $footer_builder = $footer_override ? $footer_override : $footer_builder;
                    
                    break;

                case 'builder-e' :
                    $footer_override = get_term_meta($root_term_id, 'cat_footer_builder_e', true);
                    
                    $footer_builder_e = $footer_override ? $footer_override : $footer_builder_e;
                    
                    break;
                
                case 'build-in' :
                    if (isset($nasa_opt['f_buildin']) && $nasa_opt['f_buildin']) {
                        $footer_override = get_term_meta($root_term_id, 'cat_footer_build_in', true);
                        
                        $footer_buildin = $footer_override ? $footer_override : $footer_buildin;
                    }
                    
                    break;

                default :

                    break;
            endswitch;
        }
    }

    if ($cat_popup_static_block) {
        $nasa_opt['nasa_popup_static_block'] = $cat_popup_static_block;
    }
    
    $nasa_opt['footer_mode'] = $footer_mode_override ? $footer_mode_override : $footer_mode;
    
    $nasa_opt['footer-type'] = $footer_builder;
    $nasa_opt['footer-mobile'] = $footer_builder_m;
    
    $nasa_opt['footer_elm'] = $footer_builder_e;
    $nasa_opt['footer_elm_mobile'] = $footer_builder_e_m;
    
    $nasa_opt['footer_build_in'] = $footer_buildin;
    $nasa_opt['footer_build_in_mobile'] = $footer_buildin_m;
    
    if (apply_filters('ns_hfe_template_render_focus', false)) {
        if ($nasa_opt['footer_mode'] == 'builder-e') {
            if ($in_mobile) {
                $GLOBALS['nasa_footer_hfe'] = nasa_get_hfe_by_id($nasa_opt['footer_elm_mobile']);
            } else {
                $GLOBALS['nasa_footer_hfe'] = nasa_get_hfe_by_id($nasa_opt['footer_elm']);
            }
        }
    }
            
    $GLOBALS['nasa_opt'] = $nasa_opt;
}

/**
 * Check Blog page
 * 
 * @global type $nasa_blog_page
 * @global type $post
 * @return type
 */
function nasa_check_blog_page() {
    global $nasa_blog_page;

    if (!isset($nasa_blog_page)) {
        global $post;

        $nasa_blog_page = (
            (isset($post->post_type) &&
            $post->post_type == 'post' &&
            (
                is_home() ||
                is_search() ||
                is_front_page() ||
                is_archive() ||
                is_category() ||
                is_tag() ||
                is_date() ||
                is_author() ||
                is_single()
            )) ||
            (is_search() && (!isset($_GET['post_type']) || !$_GET['post_type']))
        ) ? true : false;

        $GLOBALS['nasa_blog_page'] = $nasa_blog_page;
    }

    return $nasa_blog_page;
}

/**
 * Switch Tablet
 */
function nasa_switch_tablet() {
    return apply_filters('nasa_switch_tablet', '767');
}

/**
 * Switch Desktop
 */
function nasa_switch_desktop() {
    return apply_filters('nasa_switch_desktop', '1024');
}

/**
 * Filter hook remove smilies
 */
add_filter('smilies', 'nasa_filter_use_smilies');
function nasa_filter_use_smilies($wp_smiliessearch) {
    global $nasa_opt;
    
    return !isset($nasa_opt['enable_use_smilies']) || !$nasa_opt['enable_use_smilies'] ? array() : $wp_smiliessearch;
}
