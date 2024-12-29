<?php
defined('ABSPATH') or die();

define('ELESSI_ADMIN_PATH', ELESSI_THEME_PATH . '/admin/');
define('ELESSI_ADMIN_DIR_URI', ELESSI_THEME_URI . '/admin/');
defined('ELESSI_ADMIN_PAGE_SLUG_OLD') or define('ELESSI_ADMIN_PAGE_SLUG_OLD', 'optionsframework');
defined('NASA_ADMIN_PAGE_SLUG') or define('NASA_ADMIN_PAGE_SLUG', 'nasa-theme-options');

/**
 * 
 * @return string
 */
function elessi_latest_nasa_core_version() {
    return '6.1.9';
}

/**
 * List Plugins
 */
function elessi_list_required_plugins() {
    $imported = 'imported' === get_option('nasatheme_imported', '') ? true : false;
    
    $plugins = array();
    
    if (!$imported || (!NASA_ELEMENTOR_ACTIVE && !NASA_WPB_ACTIVE)) {
        $plugins[] = array(
            'name' => 'WPBakery Page Builder',
            'slug' => 'js_composer',
            'source' => ELESSI_ADMIN_PATH . 'plugins/js_composer.zip',
            'version' => '7.9',
            'auto' => true,
            'unchecked' => true,
            'buider' => true
        );
        
        $plugins[] = array(
            'name' => 'Elementor',
            'slug' => 'elementor',
            'auto' => true,
            'unchecked' => true,
            'buider' => true
        );
        
        $plugins[] = array(
            'name' => 'Elementor Header & Footer Builder',
            'slug' => 'header-footer-elementor',
            'auto' => true,
            'unchecked' => true,
            'parent' => 'elementor'
        );
    } else {
        if (NASA_ELEMENTOR_ACTIVE) {
            $plugins[] = array(
                'name' => 'Elementor',
                'slug' => 'elementor',
                'auto' => true,
                'unchecked' => true,
                'buider' => true
            );

            $plugins[] = array(
                'name' => 'Elementor Header & Footer Builder',
                'slug' => 'header-footer-elementor',
                'auto' => true,
                'unchecked' => true,
                'parent' => 'elementor'
            );
        } elseif (NASA_WPB_ACTIVE) {
            $plugins[] = array(
                'name' => 'WPBakery Page Builder',
                'slug' => 'js_composer',
                'source' => ELESSI_ADMIN_PATH . 'plugins/js_composer.zip',
                'version' => '7.9',
                'auto' => true,
                'unchecked' => true,
                'buider' => true
            );
        }
    }
    
    $plugins[] = array(
        'name' => 'YITH WooCommerce Compare',
        'slug' => 'yith-woocommerce-compare',
        'auto' => true
    );
    
    $plugins[] = array(
        'name' => esc_html__('Contact Form 7', 'elessi-theme'),
        'slug' => 'contact-form-7',
        'auto' => true
    );
    
    $plugins[] = array(
        'name' => 'Smash Balloon Instagram Feed',
        'slug' => 'instagram-feed',
        'auto' => true
    );
    
    $plugins[] = array(
        'name' => 'Revolution Slider',
        'slug' => 'revslider',
        'source' => ELESSI_ADMIN_PATH . 'plugins/revslider.zip',
        'version' => '6.7.20',
        'auto' => true
    );
    
    $plugins[] = array(
        'name' => 'WooCommerce',
        'slug' => 'woocommerce',
        'required' => true,
        'auto' => true
    );
    
    $plugins[] = array(
        'name' => 'Nasa Core',
        'slug' => 'nasa-core',
        'source' => ELESSI_ADMIN_PATH . 'plugins/nasa-core.zip',
        'required' => true,
        'version' => elessi_latest_nasa_core_version(),
        'auto' => true
    );
    
    return $plugins;
}

/**
 * Theme check Update Nasa Core
 */
add_action('admin_init', 'elessi_check_update_core');
function elessi_check_update_core() {
    if (isset($_REQUEST['page']) && in_array($_REQUEST['page'], array('nasa-install-demo-data', 'install-required-plugins'))) {
        return;
    }
    
    add_action('admin_footer', 'elessi_footer_admin_update_core');
}

/**
 * Template footer admin update core
 * 
 * @param type $text
 * @return type
 */
function elessi_footer_admin_update_core() {
    if (apply_filters('nasa_notices_need_update_core', true)) {
        include ELESSI_ADMIN_PATH . 'ns-need-update-core.php';
    }
}

/**
 * Required Plugins use in theme
 * 
 * In Admin
 */
require_once ELESSI_ADMIN_PATH . 'classes/class-tgm-plugin-activation.php';
add_action('tgmpa_register', 'elessi_register_required_plugins');
function elessi_register_required_plugins() {
    $plugins = elessi_list_required_plugins();
    $config = array(
        'domain' => 'elessi-theme', // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'parent_slug' => NASA_ADMIN_PAGE_SLUG, // Default parent menu slug
        'menu' => 'install-required-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
    );

    tgmpa($plugins, $config);
}

/**
 * Update VC
 */
if (function_exists('vc_set_as_theme')) {
    add_action('vc_before_init', 'elessi_vc_set_as_theme');
    function elessi_vc_set_as_theme() {
        vc_set_as_theme();
    }
}

/**
 * Title	: SMOF
 * Description	: Slightly Modified Options Framework
 * Version	: 1.5.2
 * Author	: Syamil MJ
 * Author URI	: http://aquagraphite.com
 * License	: GPLv3 - http://www.gnu.org/copyleft/gpl.html

 * define( 'SMOF_VERSION', '1.5.2' );
 * Definitions
 *
 * @since 1.4.0
 */
$smof_output = '';
if (function_exists('wp_get_theme')) {
    if (is_child_theme()) {
        $temp_obj = wp_get_theme();
        $theme_obj = wp_get_theme($temp_obj->get('Template'));
    } else {
        $theme_obj = wp_get_theme();
    }

    $theme_name = $theme_obj->get('Name');
} else {
    $theme_data = wp_get_theme(ELESSI_THEME_PATH . '/style.css');
    $theme_name = $theme_data['Name'];
}

define('ELESSI_ADMIN_THEMENAME', $theme_name);
// define('ELESSI_ADMIN_SUPPORT_FORUMS', 'https://elessi.nasatheme.com/documentation/');
define('ELESSI_ADMIN_DOCS', 'https://elessi-docs.nasatheme.com');
define('ELESSI_ADMIN_BACKUPS', 'backups');

/**
 * Functions Load
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.4.0
 * @author      Syamil MJ
 */
require_once ELESSI_ADMIN_PATH . 'dynamic-style.php';
require_once ELESSI_ADMIN_PATH . 'functions/functions.interface.php';
require_once ELESSI_ADMIN_PATH . 'functions/functions.options.php';
require_once ELESSI_ADMIN_PATH . 'functions/functions.admin.php';

add_action('admin_head', 'optionsframework_admin_message');
add_action('admin_init', 'optionsframework_admin_init_redirect');
add_action('admin_init', 'optionsframework_admin_init');
add_action('admin_menu', 'optionsframework_add_admin');

/**
 * Required Files
 *
 * @since 1.0.0
 */
require_once ELESSI_ADMIN_PATH . 'classes/class.options_machine.php';

/**
 * AJAX Saving Options
 *
 * @since 1.0.0
 */
add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

/**
 * IMPORTER
 */
require_once ELESSI_ADMIN_PATH . 'importer/nasa-importer.php';

/**
 * Images in review product
 */
add_action('add_meta_boxes_comment', 'elessi_admin_review_images_comment', 10, 1);
function elessi_admin_review_images_comment($comment) {
    global $nasa_opt;
    
    if (!isset($nasa_opt['comment_media']) || !$nasa_opt['comment_media']) {
        return;
    }
        
    $attachment_ids = get_comment_meta($comment->comment_ID, 'nasa_review_images', true);

    if (!empty($attachment_ids)) {
        $attachment_ids = array_filter( $attachment_ids, function( $attachment_id ) {
            $attachment = get_post( $attachment_id );
            if ( $attachment ) {
                return true; 
            }
            return false; 
        });
    }

    ?>
    <div class="stuffbox">
            <div class="inside">
                <h2><?php echo esc_html__('Review Product By Images', 'elessi-theme'); ?></h2>
                <div class="nasa-wrap-review-thumb nasa-flex flex-wrap" id="nasa-wrap-review-<?php echo esc_attr($comment->comment_ID); ?>">
                    <input type="hidden" name="data-medias-id" value="<?php echo !empty($attachment_ids) ? esc_attr(json_encode($attachment_ids)) : '[]' ?>" />
                    <?php if (!empty($attachment_ids)) {
                        foreach ($attachment_ids as $attachment_id) {
                            $media = false;
                            $type_file = get_post_mime_type($attachment_id);
                            $url = wp_get_attachment_url($attachment_id, 'full');
                            
                            if ($url) {
                                $media = in_array($type_file, array("image/jpg", "image/jpeg", "image/bmp", "image/png", "image/gif", "image/webp")) ?
                                wp_get_attachment_image($attachment_id, apply_filters('nasa_reivew_product_thumbnail_size', 'thumbnail'), false, array('class' => 'skip-lazy attachment-thumbnail size-thumbnail')) :
                                '<video controls autoplay loop><source src="' . $url . '" type="' . $type_file . '" /></video>';
                            }
                            ?>
                        
                            <div class="nasa-item-review-thumb">
                                <?php echo $media ? apply_filters('nasa_reivew_product_thumbnail_html', $media, $attachment_id) : ''; ?>
                                <a href="javascript:void(0);" data-id_media="<?php echo esc_attr($attachment_id); ?>" class="item-review-thumb-remove button-primary"><svg class="ns-df-cart-svg" width="25" height="25" stroke-width="2" viewBox="0 0 24 24" fill="currentColor"><path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /><path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" /></svg></a>
                            </div>
                            <?php 
                        }
                    }
                    ?>
                        
                    <a href="javascript:void(0);" class="button media_upload_button">
                        <?php echo esc_html('Upload','elessi-theme'); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php
}

/**
 * update_nasa_review_images_meta
 */
add_action('edit_comment', 'update_nasa_review_images_meta');
function update_nasa_review_images_meta($comment_id) {
    $new_nasa_review_media =  (isset($_POST['data-medias-id']) && $_POST['data-medias-id']) ? $_POST['data-medias-id'] : null;

    if ($new_nasa_review_media != null && $new_nasa_review_media !='') {
        $new_nasa_review_media = json_decode($new_nasa_review_media);
        $attachment_ids = get_comment_meta($comment_id, 'nasa_review_images', true);

        update_comment_meta($comment_id, 'nasa_review_images', $new_nasa_review_media);
    }
}

/**
 * Search Products in theme options
 */
add_filter('woocommerce_json_search_found_products', 'elessi_theme_options_search_products');
function elessi_theme_options_search_products($products){
    if (!isset($_REQUEST['rule_opt']) || $_REQUEST['rule_opt'] !== 'elessi-options') {
        return $products;
    }

    $products_new = array();
    
    if ($products){
        $image_size = apply_filters('nasa_product_sale_notification_size', 'thumbnail');
        
        foreach($products as $k => $v) {
            $product_object = wc_get_product($k);
            
            $products_new[$k] = array(
                'permalink' => $product_object->get_permalink(),
                'title'     => $product_object->get_title(),
                'img_url'   => wp_get_attachment_image_url($product_object->get_image_id(), $image_size)
            );
        }

        $products = $products_new;
    }
    
    return $products;
}

/**
 * Add Column Type of Elementor - Header and Footer Builder
 */
add_filter('manage_elementor-hf_posts_columns', 'elessi_admin_hf_column_type');
function elessi_admin_hf_column_type($columns) {
    $columns['type'] = __('Type of Template', 'elessi-theme');
    
    if (isset($columns['date'])) {
        $date_column = $columns['date'];
        unset($columns['date']);
        $columns['date'] = $date_column;
    }
    
    return $columns;
}

/**
 * Type of Elementor - Header and Footer Builder
 */
add_action('manage_elementor-hf_posts_custom_column', 'elessi_admin_hf_column_type_content', 10, 2);
function elessi_admin_hf_column_type_content($column, $post_id) {
    if ($column !== 'type') {
        return;
    }
    
    $type = get_post_meta($post_id, 'ehf_template_type', true);
    
    switch ($type) {
        case 'type_header':
            echo '<span class="nshfe-type-header">' . esc_html__('Header', 'elessi-theme') . '</span>';
            break;
        
        case 'type_footer':
            echo '<span class="nshfe-type-footer">' . esc_html__('Footer', 'elessi-theme') . '</span>';
            break;
        
        case 'type_before_footer':
            echo '<span class="nshfe-type-bfooter">' . esc_html__('Before Footer', 'elessi-theme') . '</span>';
            break;
        
        case 'custom':
            echo '<span class="nshfe-type-ctblock">' . esc_html__('Custom Block', 'elessi-theme') . '</span>';
            break;
        
        default:
            echo '<span class="nshfe-type-df">' . esc_html__('Unknown', 'elessi-theme') . '</span>';
            break;
    }
}
/**
 * Delete permanently review meta data and media atach
*/
add_action( 'delete_comment', 'nasa_custom_action_on_delete_review' );
if(!function_exists('nasa_custom_action_on_delete_review')):
function nasa_custom_action_on_delete_review( $comment_id ) {
    $comment = get_comment( $comment_id );

    if ( $comment && $comment->comment_type == 'review' ) {
        $attachment_ids = get_comment_meta($comment_id, 'nasa_review_images', true);

        if ( ! empty( $attachment_ids ) && is_array( $attachment_ids ) ) {
            foreach ( $attachment_ids as $attachment_id ) {
                wp_delete_attachment( $attachment_id, true );
            }
    
            delete_comment_meta( $comment_id, 'nasa_review_images' );
        }
    }
}
endif;

