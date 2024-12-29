<?php
class Elessi_DF_Page_Importer {

    /**
     * Default page WPBakery
     * 
     * @global type $nasa_current_user_id
     * @return type
     */
    public static function nasa_wpb_default_page() {
        global $nasa_current_user_id;

        if (!isset($nasa_current_user_id)) {
            $nasa_current_user_id = get_current_user_id();
            $GLOBALS['nasa_current_user_id'] = $nasa_current_user_id;
        }

        $time_now = current_time('mysql', 1);
        $time_now_int = time();

        $post_default = array(
            'post_author' => $nasa_current_user_id,
            'post_date' => $time_now,
            'post_date_gmt' => $time_now,
            'post_content' => '',
            'post_title' => 'WPB - Title Page',
            'post_excerpt' => '',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'post_name' => 'ELM - Slug Page',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => $time_now,
            'post_modified_gmt' => $time_now,
            'post_content_filtered' => '',
            'post_parent' => 0,
            'guid' => '',
            'menu_order' => 0,
            'post_type' => 'page',
            'post_mime_type' => '',
            'comment_count' => 0
        );

        $post_meta = array(
            '_edit_last' => 1,
            '_edit_lock' => $time_now_int . ':1',

            '_nasa_plus_wide_option' => '',
            '_nasa_plus_wide_width' => '',

            '_nasa_custom_logo_id' => '',
            '_nasa_custom_logo_retina_id' => '',

            '_nasa_custom_header' => '',
            '_nasa_header_transparent' => '',
            '_nasa_header_block' => '',
            '_nasa_header_beside_block'=>'',
            '_nasa_el_class_header' => '',

            '_nasa_topbar_on' => '',
            '_nasa_topbar_toggle' => '',
            '_nasa_topbar_default_show' => '',
            
            '_nasa_text_color_topbar' => '',
            '_nasa_text_color_hover_topbar' => '',
            '_nasa_bg_color_topbar' => '',
            '_nasa_text_color_header' => '',
            
            '_nasa_bg_color_main_menu' => '',
            '_nasa_text_color_main_menu' => '',
            '_nasa_bg_color_v_menu' => '',
            '_nasa_text_color_v_menu' => '',
            '_nasa_fullwidth_main_menu' => '',
            '_nasa_vertical_menu_selected' => '',
            '_nasa_vertical_menu_allways_show' => '',
            
            '_nasa_v_root' => '',
            '_nasa_v_root_limit' => '',
            
            '_nasa_fixed_nav' => '',

            '_nasa_pri_color_flag' => '',
            '_nasa_pri_color' => '',
            
            '_nasa_loop_layout_buttons' => '',

            '_nasa_footer_mode' => '',
            '_nasa_custom_footer' => '',
            '_nasa_custom_footer_mobile' => '',
            '_nasa_popup_static_block' => '',

            '_nasa_type_font_select' => '',
            '_nasa_type_headings' => '',
            '_nasa_type_banner' => '',
            '_nasa_type_nav' => '',
            '_nasa_type_price' => '',
            '_nasa_type_texts' => '',
            
            '_nasa_font_weight' => '',
            
            '_nasa_show_breadcrumb' => '',

            '_wp_page_template' => 'page-visual-composer.php',
            '_wpb_shortcodes_custom_css' => '',
            '_wpb_vc_js_status' => 'false',
            'slide_template' => 'default',
            'rs_page_bg_color' => '#ffffff',
            
            '_nasa_site_bg_dark' => '',
        );

        return array(
            'post' => $post_default,
            'post_meta' => $post_meta
        );
    }

    /**
     * Default page Elementor
     * 
     * @global type $nasa_current_user_id
     * @return type
     */
    public static function nasa_elm_default_page() {
        global $nasa_current_user_id;

        if (!isset($nasa_current_user_id)) {
            $nasa_current_user_id = get_current_user_id();
            $GLOBALS['nasa_current_user_id'] = $nasa_current_user_id;
        }

        $time_now = current_time('mysql', 1);
        $time_now_int = time();

        $post_default = array(
            'post_author' => $nasa_current_user_id,
            'post_date' => $time_now,
            'post_date_gmt' => $time_now,
            'post_content' => '',
            'post_title' => 'ELM - Title Page',
            'post_excerpt' => '',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'post_name' => 'ELM - Slug Page',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => $time_now,
            'post_modified_gmt' => $time_now,
            'post_content_filtered' => '',
            'post_parent' => 0,
            'guid' => '',
            'menu_order' => 0,
            'post_type' => 'page',
            'post_mime_type' => '',
            'comment_count' => 0
        );

        $post_meta = array(
            '_edit_last' => 1,
            '_edit_lock' => $time_now_int . ':1',
            '_elementor_edit_mode' => 'builder',
            '_elementor_template_type' => 'wp-page',
            '_elementor_version' => ELEMENTOR_VERSION,
            '_wp_page_template' => 'default',
            '_elementor_data' => 'elm-data-serialize',
            'slide_template' => '',
            'rs_page_bg_color' => '',
            '_elementor_controls_usage' => '',
            '_elementor_css' => '',

            '_nasa_plus_wide_option' => '',
            '_nasa_plus_wide_width' => '',

            '_nasa_custom_logo_id' => '',
            '_nasa_custom_logo_retina_id' => '',

            '_nasa_custom_header' => '',
            '_nasa_header_transparent' => '',
            '_nasa_header_block' => '',
            '_nasa_header_beside_block'=>'',
            '_nasa_el_class_header' => '',

            '_nasa_topbar_on' => '',
            '_nasa_topbar_toggle' => '',
            '_nasa_topbar_default_show' => '',
            
            '_nasa_text_color_topbar' => '',
            '_nasa_text_color_hover_topbar' => '',
            '_nasa_bg_color_topbar' => '',
            '_nasa_text_color_header' => '',
            
            '_nasa_bg_color_main_menu' => '',
            '_nasa_text_color_main_menu' => '',
            '_nasa_bg_color_v_menu' => '',
            '_nasa_text_color_v_menu' => '',
            '_nasa_fullwidth_main_menu' => '',
            '_nasa_vertical_menu_selected' => '',
            '_nasa_vertical_menu_allways_show' => '',
            
            '_nasa_v_root' => '',
            '_nasa_v_root_limit' => '',
            
            '_nasa_fixed_nav' => '',

            '_nasa_pri_color_flag' => '',
            '_nasa_pri_color' => '',
            
            '_nasa_loop_layout_buttons' => '',

            '_nasa_footer_mode' => '',
            
            '_nasa_footer_build_in' => '',
            '_nasa_footer_build_in_mobile' => '',
            '_nasa_popup_static_block' => '',
            
            '_nasa_footer_builder_e' => '',
            '_nasa_footer_builder_e_mobile' => '',

            '_nasa_type_font_select' => '',
            '_nasa_type_headings' => '',
            '_nasa_type_banner' => '',
            '_nasa_type_nav' => '',
            '_nasa_type_price' => '',
            '_nasa_type_texts' => '',
            
            '_nasa_font_weight' => '',
            
            '_nasa_show_breadcrumb' => '',
            
            '_nasa_site_bg_dark' => '',
        );

        return array(
            'post' => $post_default,
            'post_meta' => $post_meta,
            'css' => ''
        );
    }
    
    /**
     * Default page WPB Footer Builder
     * 
     * @global type $nasa_current_user_id
     * @return type
     */
    public static function nasa_wpb_default_footer() {
        global $nasa_current_user_id;

        if (!isset($nasa_current_user_id)) {
            $nasa_current_user_id = get_current_user_id();
            $GLOBALS['nasa_current_user_id'] = $nasa_current_user_id;
        }

        $time_now = current_time('mysql', 1);
        $time_now_int = time();

        $post_default = array(
            'post_author' => $nasa_current_user_id,
            'post_date' => $time_now,
            'post_date_gmt' => $time_now,
            'post_content' => '',
            'post_title' => 'WPB - Title Footer',
            'post_excerpt' => '',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'post_name' => 'WPB - Slug Footer',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => $time_now,
            'post_modified_gmt' => $time_now,
            'post_content_filtered' => '',
            'post_parent' => 0,
            'guid' => '',
            'menu_order' => 0,
            'post_type' => 'footer',
            'post_mime_type' => '',
            'comment_count' => 0
        );

        $post_meta = array(
            '_edit_last' => 1,
            '_edit_lock' => $time_now_int . ':1',
            '_wpb_vc_js_status' => 'false',
            '_wpb_shortcodes_custom_css' => '',
        );

        return array(
            'post' => $post_default,
            'post_meta' => $post_meta
        );
    }
    
    /**
     * Default page Elementor Footer Builder
     * 
     * @global type $nasa_current_user_id
     * @return type
     */
    public static function nasa_elm_default_footer() {
        global $nasa_current_user_id;

        if (!isset($nasa_current_user_id)) {
            $nasa_current_user_id = get_current_user_id();
            $GLOBALS['nasa_current_user_id'] = $nasa_current_user_id;
        }

        $time_now = current_time('mysql', 1);
        $time_now_int = time();

        $post_default = array(
            'post_author' => $nasa_current_user_id,
            'post_date' => $time_now,
            'post_date_gmt' => $time_now,
            'post_content' => '',
            'post_title' => 'ELM - Title Footer',
            'post_excerpt' => '',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'post_name' => 'ELM - Slug Footer',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => $time_now,
            'post_modified_gmt' => $time_now,
            'post_content_filtered' => '',
            'post_parent' => 0,
            'guid' => '',
            'menu_order' => 0,
            'post_type' => 'elementor-hf',
            'post_mime_type' => '',
            'comment_count' => 0
        );

        $post_meta = array(
            '_edit_last' => 1,
            '_edit_lock' => $time_now_int . ':1',
            '_elementor_edit_mode' => 'builder',
            '_elementor_template_type' => 'wp-post',
            '_elementor_version' => ELEMENTOR_VERSION,
            '_wp_page_template' => 'default',
            '_elementor_data' => 'elm-data-serialize',
            '_elementor_page_assets' => 'a:0:{}',
            'ehf_target_include_locations' => 'a:0:{}',
            'ehf_target_exclude_locations' => 'a:0:{}',
            'ehf_target_user_roles' => 'a:1:{i:0;s:0:"";}',
            'ehf_template_type' => 'type_footer',
            '_elementor_css' => '',
        );

        return array(
            'post' => $post_default,
            'post_meta' => $post_meta,
            'css' => ''
        );
    }
    
    /**
     * Default page Elementor Header Builder
     * 
     * @global type $nasa_current_user_id
     * @return type
     */
    public static function nasa_elm_default_header() {
        global $nasa_current_user_id;

        if (!isset($nasa_current_user_id)) {
            $nasa_current_user_id = get_current_user_id();
            $GLOBALS['nasa_current_user_id'] = $nasa_current_user_id;
        }

        $time_now = current_time('mysql', 1);
        $time_now_int = time();

        $post_default = array(
            'post_author' => $nasa_current_user_id,
            'post_date' => $time_now,
            'post_date_gmt' => $time_now,
            'post_content' => '',
            'post_title' => 'ELM - Title Header',
            'post_excerpt' => '',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'post_name' => 'ELM - Slug Header',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => $time_now,
            'post_modified_gmt' => $time_now,
            'post_content_filtered' => '',
            'post_parent' => 0,
            'guid' => '',
            'menu_order' => 0,
            'post_type' => 'elementor-hf',
            'post_mime_type' => '',
            'comment_count' => 0
        );

        $post_meta = array(
            '_edit_last' => 1,
            '_edit_lock' => $time_now_int . ':1',
            '_elementor_edit_mode' => 'builder',
            '_elementor_template_type' => 'wp-post',
            '_elementor_version' => ELEMENTOR_VERSION,
            '_wp_page_template' => 'default',
            '_elementor_data' => 'elm-data-serialize',
            '_elementor_page_assets' => 'a:0:{}',
            'ehf_target_include_locations' => 'a:0:{}',
            'ehf_target_exclude_locations' => 'a:0:{}',
            'ehf_target_user_roles' => 'a:1:{i:0;s:0:"";}',
            'ehf_template_type' => 'type_header',
            '_elementor_css' => '',
        );

        return array(
            'post' => $post_default,
            'post_meta' => $post_meta,
            'css' => ''
        );
    }
    
    /**
     * Default page Elementor Custom Block
     * 
     * @global type $nasa_current_user_id
     * @return type
     */
    public static function nasa_elm_default_ctblock() {
        global $nasa_current_user_id;

        if (!isset($nasa_current_user_id)) {
            $nasa_current_user_id = get_current_user_id();
            $GLOBALS['nasa_current_user_id'] = $nasa_current_user_id;
        }

        $time_now = current_time('mysql', 1);
        $time_now_int = time();

        $post_default = array(
            'post_author' => $nasa_current_user_id,
            'post_date' => $time_now,
            'post_date_gmt' => $time_now,
            'post_content' => '',
            'post_title' => 'ELM - Title Block',
            'post_excerpt' => '',
            'post_status' => 'publish',
            'comment_status' => 'closed',
            'ping_status' => 'closed',
            'post_password' => '',
            'post_name' => 'ELM - Slug Block',
            'to_ping' => '',
            'pinged' => '',
            'post_modified' => $time_now,
            'post_modified_gmt' => $time_now,
            'post_content_filtered' => '',
            'post_parent' => 0,
            'guid' => '',
            'menu_order' => 0,
            'post_type' => 'elementor-hf',
            'post_mime_type' => '',
            'comment_count' => 0
        );

        $post_meta = array(
            '_edit_last' => 1,
            '_edit_lock' => $time_now_int . ':1',
            '_elementor_edit_mode' => 'builder',
            '_elementor_template_type' => 'wp-post',
            '_elementor_version' => ELEMENTOR_VERSION,
            '_wp_page_template' => 'default',
            '_elementor_data' => 'elm-data-serialize',
            '_elementor_page_assets' => 'a:0:{}',
            'ehf_target_include_locations' => 'a:0:{}',
            'ehf_target_exclude_locations' => 'a:0:{}',
            'ehf_target_user_roles' => 'a:1:{i:0;s:0:"";}',
            'ehf_template_type' => 'custom',
            '_elementor_css' => '',
        );

        return array(
            'post' => $post_default,
            'post_meta' => $post_meta,
            'css' => ''
        );
    }

    /**
     * Render data
     * 
     * @param type $type
     * @param type $data
     * @return type
     */
    public static function nasa_render_page_data($type, $data) {
        if (!in_array($type, array('wpb', 'elm', 'hfe', 'hfe-header', 'footer', 'ctblock'))) {
            return null;
        }
        
        switch ($type) {
            case 'wpb':
                $default_data = self::nasa_wpb_default_page();
                break;
            
            case 'elm':
                $default_data = self::nasa_elm_default_page();
                break;
            
            case 'hfe':
                $default_data = self::nasa_elm_default_footer();
                break;
            
            case 'hfe-header':
                $default_data = self::nasa_elm_default_header();
                break;
            
            case 'footer':
                $default_data = self::nasa_wpb_default_footer();
                break;
            
            case 'ctblock':
                $default_data = self::nasa_elm_default_ctblock();
                break;
        } 

        foreach ($default_data as $name => $res) {
            if (isset($data[$name])) {
                if ($name !== 'css') {
                    foreach ($res as $key => $value) {
                        if (isset($data[$name][$key])) {
                            $default_data[$name][$key] = $data[$name][$key];
                        }
                    }
                } else {
                    $default_data[$name] = $data[$name];
                }
            }
        }

        return $default_data;
    }

    /**
     * Insert Page
     * 
     * @global type $wpdb
     * @param type $data
     * @return string|int
     */
    public static function nasa_insert_page_data($data = array()) {
        if (!isset($data['post']) || empty($data['post'])) {
            return false;
        }

        global $wpdb;

        if (false === $wpdb->insert($wpdb->posts, $data['post'])) {
            return 0;
        }

        return (int) $wpdb->insert_id;
    }

    /**
     * Insert Meta
     * 
     * @param type $data
     * @return string|int
     */
    public static function nasa_insert_page_meta($page_id, $data = array()) {
        if (!isset($data['post_meta']) || empty($data['post_meta'])) {
            return false;
        }

        try {
            global $wpdb;

            foreach ($data['post_meta'] as $key => $value) {
                if ($value !== '') {
                    $meta_data = array(
                        'post_id' => $page_id,
                        'meta_key' => $key,
                        'meta_value' => $value
                    );

                    $wpdb->insert($wpdb->postmeta, $meta_data);
                }
            }
        } catch (Exception $exc) {
            return false;
        }

        return true;
    }

    /**
     * Get wpb data Homepage
     * 
     * @param type $page
     * @return boolean
     */
    public static function nasa_wpb_page_data($page) {
        $file = ELESSI_ADMIN_PATH . 'importer/data-import/pages-wpb/nasa_' . $page . '.php';
        if (!is_file($file)) {
            return false;
        }

        require $file;

        $data = call_user_func('nasa_wpb_' . str_replace('-', '_', $page));
        
        if (isset($data['post']['post_name'])) {
            $data['post'] = self::nasa_page_slug($data['post']);
        }
        
        return $data;
    }

    /**
     * Get elm data Homepage
     * 
     * @param type $page
     * @return boolean
     */
    public static function nasa_elm_page_data($page) {
        $file = ELESSI_ADMIN_PATH . 'importer/data-import/pages-elm/nasa_' . $page . '.php';
        if (!is_file($file)) {
            return false;
        }

        require $file;

        $data = call_user_func('nasa_elm_' . str_replace('-', '_', $page));
        
        if (isset($data['post']['post_name'])) {
            $data['post'] = self::nasa_page_slug($data['post']);
        }
        
        return $data;
    }
    
    /**
     * Get wpb data Footer
     * 
     * @param type $footer
     * @return boolean
     */
    public static function nasa_wpb_footer_data($footer) {
        $file = ELESSI_ADMIN_PATH . 'importer/data-import/footers-wpb/nasa_' . $footer . '.php';
        if (!is_file($file)) {
            return false;
        }

        require $file;

        return call_user_func('nasa_wpb_' . str_replace('-', '_', $footer));
    }
    
    /**
     * Get elm data Footer HFE
     * 
     * @param type $footer
     * @return boolean
     */
    public static function nasa_elm_footer_data($footer) {
        $file = ELESSI_ADMIN_PATH . 'importer/data-import/footers-hfe/nasa_' . $footer . '.php';
        if (!is_file($file)) {
            return false;
        }

        require $file;

        return call_user_func('nasa_hfe_' . str_replace('-', '_', $footer));
    }
    
    /**
     * Get elm data Header HFE
     * 
     * @param type $header
     * @return boolean
     */
    public static function nasa_elm_header_data($header) {
        $file = ELESSI_ADMIN_PATH . 'importer/data-import/headers-hfe/nasa_' . $header . '.php';
        if (!is_file($file)) {
            return false;
        }

        require $file;

        return call_user_func('nasa_hfe_' . str_replace('-', '_', $header));
    }
    
    /**
     * Get elm data Custom Block HFE
     * 
     * @param type $ctblock
     * @return boolean
     */
    public static function nasa_elm_ctblock_data($ctblock) {
        $file = ELESSI_ADMIN_PATH . 'importer/data-import/ct-block-hfe/nasa_' . $ctblock . '.php';
        if (!is_file($file)) {
            return false;
        }

        require $file;

        return call_user_func('nasa_hfe_' . str_replace('-', '_', $ctblock));
    }

    /**
     * Elementor build post CSS file
     * 
     * @global type $wp_filesystem
     * @param type $page_id
     * @param type $data
     * @return boolean
     */
    public static function nasa_build_page_css($page_id, $data) {
        if (!isset($data['css']) || trim($data['css']) == '') {
            return;
        }

        $content = str_replace('[inserted_id]', $page_id, $data['css']);

        global $wp_filesystem;

        // Initialize the WP filesystem, no more using 'file-put-contents' function
        if (empty($wp_filesystem)) {
            require_once ABSPATH . '/wp-admin/includes/file.php';
            WP_Filesystem();
        }

        $upload_dir = wp_upload_dir();
        $elementor_dir = $upload_dir['basedir'] . '/elementor';

        /**
         * Create elementor dir
         */
        if (!$wp_filesystem->is_dir($elementor_dir)) {
            if (!wp_mkdir_p($elementor_dir)){
                return false;
            }
        }

        $css_dir = $elementor_dir . '/css';
        if (!$wp_filesystem->is_dir($css_dir)) {   
            /**
             * Create css dir
             */
            if (!wp_mkdir_p($css_dir)){
                return false;
            }
        }

        /**
         * Create htaccess file
         */
        $css_file = $css_dir . '/post-' . $page_id . '.css';
        if (!is_file($css_file)) {
            if (!defined('FS_CHMOD_FILE')) {
                define('FS_CHMOD_FILE', (fileperms(ABSPATH . 'index.php') & 0777 | 0644));
            }

            if (!$wp_filesystem->put_contents($css_file, $content, FS_CHMOD_FILE)) {
                return false;
            }
        }

        return true;
    }
    
    /**
     * Push Demo Data
     * 
     * @param type $type
     * @param type $page
     * @return boolean
     */
    public static function nasa_push_data_from_file($type = '', $page = '', $home = false) {
        if (!in_array($type, array('wpb', 'elm', 'hfe', 'hfe-header', 'footer', 'ctblock'))) {
            return false;
        }
        
        switch ($type) {
            case 'wpb':
                $data = self::nasa_wpb_page_data($page);
                break;
            
            case 'elm':
                $data = self::nasa_elm_page_data($page);
                break;
            
            case 'hfe':
                $data = self::nasa_elm_footer_data($page);
                break;
            
            case 'hfe-header':
                $data = self::nasa_elm_header_data($page);
                break;
            
            case 'footer':
                $data = self::nasa_wpb_footer_data($page);
                break;
            
            case 'ctblock':
                $data = self::nasa_elm_ctblock_data($page);
                break;
        } 

        $data_push = self::nasa_render_page_data($type, $data);

        $insert_id = self::nasa_insert_page_data($data_push);

        if ($insert_id) {
            self::nasa_insert_page_meta($insert_id, $data_push);
            
            /**
             * Set Homepage
             */
            if ($home && $data_push['post']['post_type'] == 'page') {
                if (get_option('nasa_front_page') !== 'inited') {
                    update_option('page_on_front', $insert_id);
                    update_option('show_on_front', 'page');
                    update_option('nasa_front_page', 'inited');
                    
                    if (isset($data['globals']) && !get_option('nasatheme_options') !== 'inited') {
                        self::nasa_args_theme_options($data['globals']);
                        update_option('nasatheme_options', 'inited');
                    }
                }
            }

            self::nasa_build_page_css($insert_id, $data_push);
        }
    }
    
    /**
     * Push Addition Home Data
     * 
     * @param type $type
     * @param type $page
     * @return boolean
     */
    public static function nasa_addition_push_data_from_file($type = '', $page = '') {
        if (!in_array($type, array('wpb', 'elm'))) {
            return false;
        }
        
        switch ($type) {
            case 'wpb':
                $data = self::nasa_wpb_page_data($page);
                break;
            
            case 'elm':
                $data = self::nasa_elm_page_data($page);
                break;
        } 

        $data_push = self::nasa_render_page_data($type, $data);

        $insert_id = self::nasa_insert_page_data($data_push);

        if ($insert_id) {
            self::nasa_insert_page_meta($insert_id, $data_push);
            
            /**
             * Set Homepage
             */
            update_option('page_on_front', $insert_id);
            update_option('show_on_front', 'page');
            
            if (isset($data['globals'])) {
                self::nasa_args_theme_options($data['globals']);
            }

            self::nasa_build_page_css($insert_id, $data_push);
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Convert data global
     * 
     * @param type $globals
     * @return void
     */
    protected static function nasa_args_theme_options($globals = array()) {
        $default_globals = array(
            'header-type' => '',

            'fixed_nav' => '1',

            'site_bg_dark' => '',

            'plus_wide_width' => '',

            'color_primary' => '',

            'bg_color_topbar' => '',
            'text_color_topbar' => '',

            'fullwidth_main_menu' => '',
            'bg_color_main_menu' => '',
            'text_color_main_menu' => '',

            'bg_color_v_menu' => '',
            'text_color_v_menu' => '',
            'v_root' => '',
            'v_root_limit' => '',

            'footer_mode' => 'builder',
            'footer-type' => 'footer-light-2',
            'footer-mobile' => 'footer-mobile',
            'footer_elm' => '',
            'footer_elm_mobile' => '',

            'category_sidebar' => 'top',
            'product_sidebar' => 'left',
            'wrapper_widgets' => '0',

            'loop_layout_buttons' => 'ver-buttons',

            'animated_products' => 'hover-fade',

            'nasa_attr_image_style' => 'round',
            'nasa_attr_image_single_style' => 'extends',
            'nasa_attr_color_style' => 'radio',
            'nasa_attr_label_style' => 'radio',

            'product_detail_layout' => 'new',
            'sp_bgl' => '',
            'product_image_layout' => 'double',
            'product_image_style' => 'scroll',
            'single_product_thumbs_style' => 'ver',
            'tab_style_info' => '2d-no-border',
            'full_info_col' => '1',

            'breadcrumb_row' => 'multi',
            'breadcrumb_type' => 'has-background',
            'breadcrumb_bg_color' => '',
            'breadcrumb_align' => 'text-center',
            'breadcrumb_height' => '130',
        );
        
        foreach ($default_globals as $key => $value) {
            if (!isset($globals[$key])) {
                $globals[$key] = $value;
            }
        }
        
        foreach ($globals as $key => $value) {
            set_theme_mod($key, $value);
        }
        
        /**
         * Rebuild dynamic CSS
         */
        if (function_exists('nasa_theme_rebuilt_css_dynamic')) {
            nasa_theme_rebuilt_css_dynamic();
        }
    }

    /**
     * Render Post Name
     */
    public static function nasa_page_slug($data) {
        global $wpdb;
        
        $slug = $data['post_name'];
        
        $sql = $wpdb->prepare(
            'SELECT post_name FROM ' . $wpdb->posts . ' WHERE post_name = %s AND post_type = %s',
            $slug,
            'page'
        );

        $page_name = $wpdb->get_var($sql);
        
        if ($page_name) {
            $data['post_name'] = $page_name . '-' . date('Y-m-d-H-i-s');
            $data['post_title'] = $data['post_title'] . ' (' . date('Y-m-d H:i:s') . ')';
            
            return self::nasa_page_slug($data);
        } else {
            return $data;
        }
    }
}
