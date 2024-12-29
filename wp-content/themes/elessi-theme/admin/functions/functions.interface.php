<?php

/**
 * SMOF Interface
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */

/**
 * Admin init
 * 
 * Redirect from old theme options
 */
function optionsframework_admin_init_redirect() {
    if (isset($_REQUEST['page']) && $_REQUEST['page'] === 'optionsframework') {
        wp_redirect(admin_url('admin.php?page=' . NASA_ADMIN_PAGE_SLUG));
        exit;
    }
}

/**
 * Admin Init
 *
 * @uses wp_verify_nonce()
 * @uses header()
 *
 * @since 1.0.0
 */
function optionsframework_admin_init() {
    // Rev up the Options Machine
    global $of_options, $options_machine, $smof_data, $smof_details;
    if (!isset($options_machine)) {
        $options_machine = new Options_Machine($of_options);
    }

    do_action('optionsframework_admin_init_before', array(
        'of_options' => $of_options,
        'options_machine' => $options_machine,
        'smof_data' => $smof_data
    ));

    if (empty($smof_data['smof_init'])) { // Let's set the values if the theme's already been active
        of_save_options($options_machine->Defaults);
        of_save_options(date('r'), 'smof_init');
        $smof_data = of_get_options();
        $options_machine = new Options_Machine($of_options);
    }

    do_action('optionsframework_admin_init_after', array(
        'of_options' => $of_options,
        'options_machine' => $options_machine,
        'smof_data' => $smof_data
    ));
}

/**
 * Create Options page
 *
 * @uses add_theme_page()
 * @uses add_action()
 *
 * @since 1.0.0
 */
function optionsframework_add_admin() {
    global $nasa_opt;
    
    if (isset($nasa_opt['white_lbl']) && $nasa_opt['white_lbl'] && isset($nasa_opt['white_lbl_name']) && $nasa_opt['white_lbl_name']) {
        $title_option = $nasa_opt['white_lbl_name'] . ' Options';
    } else {
        $title_option = esc_html__('Theme Options', 'elessi-theme');
    }
    
    add_theme_page(
        ELESSI_ADMIN_THEMENAME,
        $title_option,
        'edit_theme_options',
        ELESSI_ADMIN_PAGE_SLUG_OLD,
        'elessi_framework_options_page_old'
    );
    
    $of_page = add_menu_page(
        ELESSI_ADMIN_THEMENAME,
        $title_option,
        'edit_theme_options',
        NASA_ADMIN_PAGE_SLUG,
        'elessi_framework_options_page',
        ELESSI_ADMIN_DIR_URI . 'assets/images/settings-theme.svg',
        2
    );
    
    if (NASA_HF_BUILDER) {
        $hfe_admin = HFE_Admin::instance();
        
        remove_action('admin_menu', array($hfe_admin, 'register_admin_menu'), 50);
        
        add_submenu_page(
            NASA_ADMIN_PAGE_SLUG,
            __('Elementor Header & Footer Builder', 'elessi-theme'),
            __('Elementor Header & Footer Builder', 'elessi-theme'),
            'edit_pages',
            'edit.php?post_type=elementor-hf'
        );
    }

    // Add framework functionaily to the head individually
    add_action("admin_print_scripts-" . $of_page, 'of_load_only');
    add_action("admin_print_styles-" . $of_page, 'of_style_only');
}

/**
 * Build Options page - OLD
 *
 * @since 1.0.0
 */
function elessi_framework_options_page_old() {
    die;
}

/**
 * Build Options page
 *
 * @since 1.0.0
 */
function elessi_framework_options_page() {
    global $options_machine;
    include_once ELESSI_ADMIN_PATH . 'front-end/options.php';
}

/**
 * Create Options page
 *
 * @uses wp_enqueue_style()
 *
 * @since 1.0.0
 */
function of_style_only() {
    wp_enqueue_style('nasa-theme-admin-style', ELESSI_ADMIN_DIR_URI . 'assets/css/admin-style.css', array(), '6.1.7');
    wp_enqueue_style('jquery-ui-custom-admin', ELESSI_ADMIN_DIR_URI . 'assets/css/jquery-ui-custom.css');

    if (!wp_style_is('wp-color-picker', 'registered')) {
        wp_register_style('wp-color-picker', ELESSI_ADMIN_DIR_URI . 'assets/css/color-picker.min.css');
    }
    
    wp_enqueue_style('wp-color-picker');
    do_action('of_style_only_after');
}

/**
 * Create Options page
 *
 * @uses add_action()
 * @uses wp_enqueue_script()
 *
 * @since 1.0.0
 */
function of_load_only() {
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-sortable');
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('jquery-input-mask', ELESSI_ADMIN_DIR_URI . 'assets/js/jquery.maskedinput-1.2.2.js', array('jquery'));
    wp_enqueue_script('cookie', ELESSI_ADMIN_DIR_URI . 'assets/js/cookie.js', array('jquery'));
    wp_enqueue_script('smof', ELESSI_ADMIN_DIR_URI . 'assets/js/smof.js', array('jquery'));

    /**
     * Enqueue scripts for file uploader
     */
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    }

    do_action('of_load_only_after');
}

/**
 * Ajax Save Options
 *
 * @uses get_option()
 *
 * @since 1.0.0
 */
function of_ajax_callback() {
    global $options_machine, $of_options;

    $nonce = $_POST['security'];

    if (!wp_verify_nonce($nonce, 'of_ajax_nonce')) {
        die('-1');
    }

    //get options array from db
    $all = of_get_options();

    $save_type = $_POST['type'];

    switch ($save_type) {
        case 'upload':
            $clickedID = $_POST['data']; // Acts as the name
            $filename = $_FILES[$clickedID];
            $filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']);

            $override['test_form'] = false;
            $override['action'] = 'wp_handle_upload';
            $uploaded_file = wp_handle_upload($filename, $override);

            // $upload_tracking[] = $clickedID;

            // update $options array w/ image URL
            // preserve current data
            $upload_image = $all;

            $upload_image[$clickedID] = $uploaded_file['url'];
            of_save_options($upload_image);
            
            // Is the Response
            echo !empty($uploaded_file['error']) ? 
                'Upload Error: ' . $uploaded_file['error'] : $uploaded_file['url'];
            break;
        
        case 'image_reset':
            $id = $_POST['data']; // Acts as the name

            $delete_image = $all; //preserve rest of data
            $delete_image[$id] = ''; //update array key with empty value	 
            of_save_options($delete_image);
            break;
        
        case 'backup_options':
            $backup = $all;
            $backup['backup_log'] = date('r');

            of_save_options($backup, ELESSI_ADMIN_BACKUPS);
            nasa_theme_rebuilt_css_dynamic();
            elessi_save_option_woo_customize();
            
            die('1');
            break;
        
        case 'restore_options':
            $smof_data = of_get_options(ELESSI_ADMIN_BACKUPS);
            of_save_options($smof_data);
            nasa_theme_rebuilt_css_dynamic();
            elessi_save_option_woo_customize();
            
            die('1');
            break;
        
        case 'import_options':
            $smof_data = json_decode(stripslashes($_POST['data']), true);
            of_save_options($smof_data);
            
            nasa_theme_rebuilt_css_dynamic();
            elessi_save_option_woo_customize();
            
            /**
             * Clear cache variations
             */
            if (function_exists('nasa_del_cache_variations')) {
                nasa_del_cache_variations();
            }
            
            die('1');
            break;
        
        case 'save':
            wp_parse_str(stripslashes($_POST['data']), $smof_data);
            unset($smof_data['security']);
            unset($smof_data['of_save']);
            of_save_options($smof_data);
            nasa_theme_rebuilt_css_dynamic();
            elessi_save_option_woo_customize();

            die('1');
            break;
        
        case 'reset':
            of_save_options($options_machine->Defaults);
            nasa_theme_rebuilt_css_dynamic();
            elessi_save_option_woo_customize();
            
            die('1'); //options reset
            break;
        
        default:
            die();
    }
}

/**
 * Rebuilt dynamic style site
 * @global type $wp_filesystem
 */
function nasa_theme_rebuilt_css_dynamic() {
    global $wp_filesystem, $nasa_upload_dir;
    
    if (!isset($nasa_upload_dir)) {
        $nasa_upload_dir = wp_upload_dir();
        $GLOBALS['nasa_upload_dir'] = $nasa_upload_dir;
    }
    
    $dynamic_path = $nasa_upload_dir['basedir'] . '/nasa-dynamic';
    
    // Initialize the WP filesystem, no more using 'file-put-contents' function
    if (empty($wp_filesystem)) {
        require_once ABSPATH . '/wp-admin/includes/file.php';
        WP_Filesystem();
    }
            
    if (!$wp_filesystem->is_dir($dynamic_path)) {
        if (!wp_mkdir_p($dynamic_path)){
            return true;
        }
    }
    
    // get the upload directory and make a dynamic.css file
    $filename = $dynamic_path . '/dynamic.css';
    
    $data = get_theme_mods();
    $css = elessi_get_content_custom_css($data);
    
    if (!defined('FS_CHMOD_FILE')) {
        define('FS_CHMOD_FILE', (fileperms(ABSPATH . 'index.php') & 0777 | 0644));
    }
    
    if (!$wp_filesystem->put_contents($filename, $css, FS_CHMOD_FILE)) {
        return true;
    }
    
    set_theme_mod('nasa_dynamic_t', NASA_TIME_NOW);
    
    return false;
}

/**
 * Save Woo Customize
 * @return type
 */
function elessi_save_option_woo_customize() {
    if (!NASA_WOO_ACTIVED) {
        return;
    }
    
    $columns = get_option('woocommerce_catalog_columns', 4);
    
    $data = get_theme_mods();
    if (isset($data['products_per_row']) && (int) $data['products_per_row'] != $columns) {
        update_option('woocommerce_catalog_columns', (int) $data['products_per_row']);
    }
}

/**
 * After save Customize sync theme options
 */
add_action('customize_save_after', 'elessi_sync_option_theme');
function elessi_sync_option_theme() {
    if (!NASA_WOO_ACTIVED) {
        return;
    }
    
    $columns = get_option('woocommerce_catalog_columns', 4);
    $data = get_theme_mods();
    
    if (!isset($data['products_per_row']) || (int) $data['products_per_row'] != $columns) {
        set_theme_mod('products_per_row', $columns . '-cols');
    }
}
