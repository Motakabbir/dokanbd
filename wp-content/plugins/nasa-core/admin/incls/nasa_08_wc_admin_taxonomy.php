<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Instantiate Class
 */
add_action('init', array('Nasa_WC_Admin_Taxonomy', 'getInstance'));

/**
 * Handles Taxonomies in admin
 *
 * @class Nasa_WC_Admin_Taxonomy - Product Group
 */
class Nasa_WC_Admin_Taxonomy {

    /**
     * Class instance.
     *
     * @var WC_Admin_Taxonomies instance
     */
    protected static $instance = null;

    /**
     * Group Slug
     * 
     * @var type 
     */
    public $nasa_taxonomy = 'nasa_product_cat';

    /**
     * Default category ID.
     *
     * @var int
     */
    // private $default_cat_id = 0;

    /**
     * Get class instance
     */
    public static function getInstance() {
        global $nasa_opt;

        if (!isset($nasa_opt['enable_nasa_custom_categories']) || !$nasa_opt['enable_nasa_custom_categories']) {
            return null;
        }

        $option_taxonomy = get_option('nasa_custom_categories_slug', false);

        if (!$option_taxonomy) {
            $option_taxonomy = isset($nasa_opt['nasa_custom_categories_slug']) && $nasa_opt['nasa_custom_categories_slug'] ? $option_taxonomy : 'nasa_product_cat';
            update_option('nasa_custom_categories_slug', $option_taxonomy, 'no');
        }

        if (null == self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Constructor.
     */
    public function __construct() {
        if (!NASA_WOO_ACTIVED) {
            return null;
        }

        // $this->default_cat_id = get_option('default_product_group', 0);

        $this->nasa_taxonomy = apply_filters('nasa_taxonomy_custom_cateogory', $this->nasa_taxonomy);

        // Add form.
        add_action($this->nasa_taxonomy . '_add_form_fields', array($this, 'add_category_fields'));
        add_action($this->nasa_taxonomy . '_edit_form_fields', array($this, 'edit_category_fields'), 10);
        add_action('created_term', array($this, 'save_category_fields'), 10, 3);
        add_action('edit_term', array($this, 'save_category_fields'), 10, 3);

        // Add columns.
        add_filter('manage_edit-' . $this->nasa_taxonomy . '_columns', array($this, 'product_cat_columns'));
        add_filter('manage_' . $this->nasa_taxonomy . '_custom_column', array($this, 'product_cat_column'), 10, 3);

        // Add row actions.
        add_filter($this->nasa_taxonomy . '_row_actions', array($this, 'product_cat_row_actions'), 10, 2);
        // add_filter('admin_init', array($this, 'handle_product_cat_row_actions'));

        // Maintain hierarchy of terms.
        add_filter('wp_terms_checklist_args', array($this, 'disable_checked_ontop'));

        // Admin footer scripts for this product categories admin screen.
        add_action('admin_footer', array($this, 'scripts_at_product_cat_screen_footer'));

        add_filter('woocommerce_screen_ids', array($this, 'support_admin_style'));
        add_filter('woocommerce_sortable_taxonomies', array($this, 'support_sortable_taxonomies'));

        /**
         * Custom nasa_taxonomy
         */
        add_action('wp_ajax_nasa_change_slug_group', array($this, 'change_slug_group'));

        /**
         * Import, Export CSV
         */
        add_filter('woocommerce_product_export_column_names', array($this, 'group_exp_imp_add_columns'));
        add_filter('woocommerce_product_export_product_default_columns', array($this, 'group_exp_imp_add_columns'));
        add_filter('woocommerce_product_export_product_column_' . $this->nasa_taxonomy, array($this, 'group_export_taxonomy'), 10, 2);
        add_filter('woocommerce_csv_product_import_mapping_options', array($this, 'group_map_columns'));
        add_filter('woocommerce_csv_product_import_mapping_default_columns', array($this, 'group_add_columns_to_mapping_screen'));
        add_filter('woocommerce_product_importer_parsed_data', array($this, 'group_parse_taxonomy_data'));
        add_action('woocommerce_product_import_inserted_product_object', array($this, 'group_set_taxonomy'), 10, 2);
    }

    /**
     * Custom nasa_taxonomy
     */
    public function change_slug_group() {
        $json = array(
            'success' => 'fail',
            'result' => $this->nasa_taxonomy,
            'mess' => '<p class="nasa-error">' . esc_html__('Error!!!', 'nasa-core') . '</p>'
        );

        if (isset($_POST['data_value']) && $_POST['data_value']) {
            $new_taxonomy = sanitize_title($_POST['data_value']);

            /**
             * Check exists in DB
             */
            if (taxonomy_exists($new_taxonomy)) {
                $json['mess'] = '<p class="nasa-error">' . sprintf(esc_html__('%s was exists, please try with another string!!!', 'nasa-core'), '"' . $new_taxonomy . '"') . '</p>';
            }

            /**
             * Save Custom Taxonomy
             */ else {
                $this->_save_custom_taxonomy($new_taxonomy);

                $json = array(
                    'success' => 'ok',
                    'result' => $new_taxonomy,
                    'mess' => '<p class="nasa-success">' . esc_html__('Success!!!', 'nasa-core') . '</p>'
                );

                set_theme_mod('nasa_custom_categories_slug', $new_taxonomy);
                update_option('nasa_custom_categories_slug', $new_taxonomy, 'no');
            }
        }

        die(json_encode($json));
    }

    /**
     * _convert_taxonomy
     */
    protected function _save_custom_taxonomy($taxonomy) {
        global $wpdb;

        return $wpdb->query($wpdb->prepare(
            'UPDATE ' . $wpdb->term_taxonomy . ' SET taxonomy = %s WHERE taxonomy = %s',
            $taxonomy,
            $this->nasa_taxonomy
        ));
    }

    /**
     * Add admin css
     * @param type $screen_ids
     * @return string
     */
    public function support_admin_style($screen_ids) {
        if (!is_array($screen_ids)) {
            $screen_ids = array();
        }

        $screen_ids[] = 'edit-' . $this->nasa_taxonomy;

        return $screen_ids;
    }

    /**
     * Add Sort able
     * @param type $taxonomies
     * @return type
     */
    public function support_sortable_taxonomies($taxonomies) {
        if (!is_array($taxonomies)) {
            $taxonomies = array();
        }

        $taxonomies[] = $this->nasa_taxonomy;

        return $taxonomies;
    }

    /**
     * Thumbnail column added to category admin.
     *
     * @param mixed $columns Columns array.
     * @return array
     */
    public function product_cat_columns($columns) {
        $new_columns = array();

        if (isset($columns['cb'])) {
            $new_columns['cb'] = $columns['cb'];
            unset($columns['cb']);
        }

        $new_columns['thumb'] = esc_html__('Image', 'nasa-core');

        $columns = array_merge($new_columns, $columns);
        $columns['handle'] = '';

        return $columns;
    }

    /**
     * Adjust row actions.
     *
     * @param array  $actions Array of actions.
     * @param object $term Term object.
     * @return array
     */
    public function product_cat_row_actions($actions, $term) {
        // $default_category_id = absint(get_option('default_product_group', 0));

        /* if ($this->default_cat_id !== $term->term_id && current_user_can('edit_term', $term->term_id)) {
            $actions['make_default'] = sprintf(
                '<a href="%s" aria-label="%s">%s</a>',
                wp_nonce_url('edit-tags.php?action=make_default&amp;taxonomy=' . $this->nasa_taxonomy . '&amp;post_type=product&amp;tag_ID=' . absint($term->term_id), 'make_default_' . absint($term->term_id)),
                // translators: %s: taxonomy term name
                esc_attr(sprintf(esc_html__('Make &#8220;%s&#8221; the default category', 'nasa-core'), $term->name)),
                esc_html__('Make default', 'nasa-core')
            );
        } */

        return $actions;
    }

    /**
     * Handle custom row actions.
     */
    public function handle_product_cat_row_actions() {
        if (isset($_GET['action'], $_GET['tag_ID'], $_GET['_wpnonce']) && 'make_default' === $_GET['action']) {
            $make_default_id = absint($_GET['tag_ID']);

            if (wp_verify_nonce($_GET['_wpnonce'], 'make_default_' . $make_default_id) && current_user_can('edit_term', $make_default_id)) {
                update_option('default_product_group', $make_default_id);
            }
        }
    }

    /**
     * Thumbnail column value added to category admin.
     *
     * @param string $columns Column HTML output.
     * @param string $column Column name.
     * @param int    $id Product ID.
     *
     * @return string
     */
    public function product_cat_column($columns, $column, $id) {
        if ('thumb' === $column) {
            // Prepend tooltip for default category.
            /* $default_category_id = absint(get_option('default_product_group', 0));

            if ($this->default_cat_id === $id) {
                $columns .= wc_help_tip(esc_html__('This is the default category and it cannot be deleted. It will be automatically assigned to products with no category.', 'nasa-core'));
            } */

            $thumbnail_id = get_term_meta($id, 'thumbnail_id', true);

            if ($thumbnail_id) {
                $image = wp_get_attachment_thumb_url($thumbnail_id);
            } else {
                $image = wc_placeholder_img_src();
            }

            $image = str_replace(' ', '%20', $image);
            $columns .= '<img src="' . esc_url($image) . '" alt="' . esc_attr__('Thumbnail', 'nasa-core') . '" class="wp-post-image" height="48" width="48" />';
        }

        if ('handle' === $column) {
            $columns .= '<input type="hidden" name="term_id" value="' . esc_attr($id) . '" />';
        }

        return $columns;
    }

    /**
     * Maintain term hierarchy when editing a product.
     *
     * @param  array $args Term checklist args.
     * @return array
     */
    public function disable_checked_ontop($args) {
        if (!empty($args['taxonomy']) && $this->nasa_taxonomy === $args['taxonomy']) {
            $args['checked_ontop'] = false;
        }

        return $args;
    }

    /**
     * Admin footer scripts for the product categories admin screen
     *
     * @return void
     */
    public function scripts_at_product_cat_screen_footer() {
        if (!isset($_GET['taxonomy']) || $this->nasa_taxonomy !== $_GET['taxonomy']) {
            return;
        }

        // Ensure the tooltip is displayed when the image column is disabled on product categories.
        /* wc_enqueue_js(
                "(function($) {
                'use strict';
                var product_cat = $('tr#tag-" . absint($this->default_cat_id) . "');
                product_cat.find('th').empty();
                product_cat.find('td.thumb span').detach('span').appendTo(product_cat.find('th'));
            })(jQuery);"
        ); */
    }

    /**
     * Category thumbnail fields.
     */
    public function add_category_fields() {
        ?>
        <div class="form-field term-thumbnail-wrap">
            <label><?php esc_html_e('Thumbnail', 'nasa-core'); ?></label>
            <div id="product_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" width="60px" height="60px" /></div>
            <div style="line-height: 60px;">
                <input type="hidden" id="product_cat_thumbnail_id" name="product_cat_thumbnail_id" />
                <button type="button" class="upload_image_button button"><?php esc_html_e('Upload/Add image', 'nasa-core'); ?></button>
                <button type="button" class="remove_image_button button"><?php esc_html_e('Remove Image', 'nasa-core'); ?></button>
            </div>
            <script type="text/javascript">

                // Only show the "Remove Image" button when needed
                if (!jQuery('#product_cat_thumbnail_id').val()) {
                    jQuery('.remove_image_button').hide();
                }

                // Uploading files
                var file_frame;

                jQuery(document).on('click', '.upload_image_button', function (event) {

                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if (file_frame) {
                        file_frame.open();
                        return;
                    }

                    // Create the media frame.
                    file_frame = wp.media.frames.downloadable_file = wp.media({
                        title: '<?php esc_html_e('Choose an image', 'nasa-core'); ?>',
                        button: {
                            text: '<?php esc_html_e('Use image', 'nasa-core'); ?>'
                        },
                        multiple: false
                    });

                    // When an image is selected, run a callback.
                    file_frame.on('select', function () {
                        var attachment = file_frame.state().get('selection').first().toJSON();
                        var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                        jQuery('#product_cat_thumbnail_id').val(attachment.id);
                        jQuery('#product_cat_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                        jQuery('.remove_image_button').show();
                    });

                    // Finally, open the modal.
                    file_frame.open();
                });

                jQuery(document).on('click', '.remove_image_button', function () {
                    jQuery('#product_cat_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                    jQuery('#product_cat_thumbnail_id').val('');
                    jQuery('.remove_image_button').hide();
                    return false;
                });

                jQuery(document).ajaxComplete(function (event, request, options) {
                    if (request && 4 === request.readyState && 200 === request.status
                            && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                        var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                        if (!res || res.errors) {
                            return;
                        }
                        // Clear Thumbnail fields on submit
                        jQuery('#product_cat_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        jQuery('#product_cat_thumbnail_id').val('');
                        jQuery('.remove_image_button').hide();
                        // Clear Display type field on submit
                        jQuery('#display_type').val('');
                        return;
                    }
                });

            </script>
            <div class="clear"></div>
        </div>
        <?php
    }

    /**
     * Edit category thumbnail field.
     * 
     * @param type $term
     */
    public function edit_category_fields($term) {
        $thumbnail_id = absint(get_term_meta($term->term_id, 'thumbnail_id', true));
        $image = $thumbnail_id ? wp_get_attachment_thumb_url($thumbnail_id) : wc_placeholder_img_src();
        ?>

        <tr class="form-field term-thumbnail-wrap">
            <th scope="row" valign="top"><label><?php esc_html_e('Thumbnail', 'nasa-core'); ?></label></th>
            <td>
                <div id="product_cat_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($image); ?>" width="60px" height="60px" /></div>
                <div style="line-height: 60px;">
                    <input type="hidden" id="product_cat_thumbnail_id" name="product_cat_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>" />
                    <button type="button" class="upload_image_button button"><?php esc_html_e('Upload/Add image', 'nasa-core'); ?></button>
                    <button type="button" class="remove_image_button button"><?php esc_html_e('Remove Image', 'nasa-core'); ?></button>
                </div>
                <script type="text/javascript">
                    // Only show the "Remove Image" button when needed
                    if ('0' === jQuery('#product_cat_thumbnail_id').val()) {
                        jQuery('.remove_image_button').hide();
                    }

                    // Uploading files
                    var file_frame;

                    jQuery(document).on('click', '.upload_image_button', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame) {
                            file_frame.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php esc_html_e('Choose an image', 'nasa-core'); ?>',
                            button: {
                                text: '<?php esc_html_e('Use image', 'nasa-core'); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame.on('select', function () {
                            var attachment = file_frame.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            jQuery('#product_cat_thumbnail_id').val(attachment.id);
                            jQuery('#product_cat_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            jQuery('.remove_image_button').show();
                        });

                        // Finally, open the modal.
                        file_frame.open();
                    });

                    jQuery(document).on('click', '.remove_image_button', function () {
                        jQuery('#product_cat_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        jQuery('#product_cat_thumbnail_id').val('');
                        jQuery('.remove_image_button').hide();
                        return false;
                    });

                </script>
                <div class="clear"></div>
            </td>
        </tr>
        <?php
    }

    /**
     * Save category fields
     *
     * @param mixed  $term_id Term ID being saved.
     * @param mixed  $tt_id Term taxonomy ID.
     * @param string $taxonomy Taxonomy slug.
     */
    public function save_category_fields($term_id, $tt_id, $taxonomy) {
        if (isset($_POST['product_cat_thumbnail_id']) && $this->nasa_taxonomy === $taxonomy) {
            update_term_meta($term_id, 'thumbnail_id', absint($_POST['product_cat_thumbnail_id']));
        }
    }

    /**
     * Add CSV columns for exporting extra data.
     *
     * @param  array  $columns
     * @return array  $columns
     */
    public function group_exp_imp_add_columns($columns) {
        $columns[$this->nasa_taxonomy] = __('Product Group', 'nasa-core');

        return $columns;
    }

    /**
     * contents data column content.
     *
     * @param  mixed       $value
     * @param  WC_Product  $product
     * @return mixed       $value
     */
    public function group_export_taxonomy($value, $product) {
        $terms = get_terms(array(
            'object_ids' => $product->get_id(),
            'taxonomy' => $this->nasa_taxonomy
        ));

        if (!is_wp_error($terms) && $terms) {
            $data = array();

            foreach ((array) $terms as $term) {
                $data[] = $term->term_id;
            }

            $value = $this->format_term_ids($data);
        }

        return $value;
    }

    /**
     * Register the 'Product Group' column in the importer.
     *
     * @param  array  $columns
     * @return array  $columns
     */
    public function group_map_columns($options) {
        $options[$this->nasa_taxonomy] = __('Product Group', 'nasa-core');

        return $options;
    }

    /**
     * Add automatic mapping support for custom columns.
     *
     * @param  array  $columns
     * @return array  $columns
     */
    public function group_add_columns_to_mapping_screen($columns) {
        $columns[__('Product Group', 'nasa-core')] = $this->nasa_taxonomy;

        // Always add English mappings.
        $columns['Product Group'] = $this->nasa_taxonomy;

        return $columns;
    }

    /**
     * parse group to array ids.
     *
     * @param  array                    $parsed_data
     * @param  WC_Product_CSV_Importer  $importer
     * @return array terms ids
     */
    public function group_parse_taxonomy_data($parsed_data) {
        if (!empty($parsed_data[$this->nasa_taxonomy])) {
            $parsed_data[$this->nasa_taxonomy] = $this->parse_groups_field($parsed_data[$this->nasa_taxonomy]);
        }

        return $parsed_data;
    }

    /**
     * Set taxonomy.
     *
     * @param  array  $parsed_data
     * @return array
     */
    public function group_set_taxonomy($product, $data) {
        if (is_a($product, 'WC_Product')) {
            if (!empty($data[$this->nasa_taxonomy])) {
                wp_set_object_terms($product->get_id(), (array) $data[$this->nasa_taxonomy], $this->nasa_taxonomy);
            }
        }

        return $product;
    }

    /**
     * Format term ids to names.
     *
     * @param  array  $term_ids Term IDs to format.
     * @param  string $taxonomy Taxonomy name.
     * @return string
     */
    protected function format_term_ids($term_ids) {
        $term_ids = wp_parse_id_list($term_ids);

        if (!count($term_ids)) {
            return '';
        }

        $formatted_terms = array();

        if (is_taxonomy_hierarchical($this->nasa_taxonomy)) {
            foreach ($term_ids as $term_id) {
                $formatted_term = array();
                $ancestor_ids = array_reverse(get_ancestors($term_id, $this->nasa_taxonomy));

                foreach ($ancestor_ids as $ancestor_id) {
                    $term = get_term($ancestor_id, $this->nasa_taxonomy);
                    if ($term && !is_wp_error($term)) {
                        $formatted_term[] = $term->name;
                    }
                }

                $term = get_term($term_id, $this->nasa_taxonomy);

                if ($term && !is_wp_error($term)) {
                    $formatted_term[] = $term->name;
                }

                $formatted_terms[] = implode(' > ', $formatted_term);
            }
        } else {
            foreach ($term_ids as $term_id) {
                $term = get_term($term_id, $this->nasa_taxonomy);

                if ($term && !is_wp_error($term)) {
                    $formatted_terms[] = $term->name;
                }
            }
        }

        return $this->implode_values($formatted_terms);
    }

    /**
     * Parse a category field from a CSV.
     * Categories are separated by commas and subcategories are "parent > subcategory".
     *
     * @param string $value Field value.
     *
     * @return array of arrays with "parent" and "name" keys.
     */
    protected function parse_groups_field($value) {
        if (empty($value)) {
            return array();
        }
        
        $row_terms = $this->explode_values($value);
        $categories = array();

        foreach ($row_terms as $row_term) {
            $parent = null;
            $_terms = array_map('trim', explode('>', html_entity_decode($row_term)));
            $total = count($_terms);

            foreach ($_terms as $index => $_term) {
                // Don't allow users without capabilities to create new categories.
                if (!current_user_can('manage_product_terms')) {
                    break;
                }

                $term = wp_insert_term($_term, $this->nasa_taxonomy, array('parent' => intval($parent)));

                if (is_wp_error($term)) {
                    if ($term->get_error_code() === 'term_exists') {
                        // When term exists, error data should contain existing term id.
                        $term_id = $term->get_error_data();
                    } else {
                        break; // We cannot continue on any other error.
                    }
                } else {
                    // New term.
                    $term_id = $term['term_id'];
                }

                // Only requires assign the last category.
                if ((1 + $index) === $total) {
                    $categories[] = $term_id;
                } else {
                    // Store parent to be able to insert or query categories based in parent ID.
                    $parent = $term_id;
                }
            }
        }

        return $categories;
    }

    /**
     * Implode CSV cell values using commas by default, and wrapping values
     * which contain the separator.
     *
     * @param  array $values Values to implode.
     * @return string
     */
    protected function implode_values($values) {
        $values_to_implode = array();

        foreach ($values as $value) {
            $value = (string) is_scalar($value) ? html_entity_decode($value, ENT_QUOTES) : '';
            $values_to_implode[] = str_replace(',', '\\,', $value);
        }

        return implode(', ', $values_to_implode);
    }

    /**
     * Explode CSV cell values using commas by default, and handling escaped
     * separators.
     *
     * @param  string $value     Value to explode.
     * @param  string $separator Separator separating each value. Defaults to comma.
     * @return array
     */
    protected function explode_values($value, $separator = ',') {
        $value = str_replace('\\,', '::separator::', $value);
        $values = explode($separator, $value);
        $values = array_map(array($this, 'explode_values_formatter'), $values);

        return $values;
    }

    /**
     * Remove formatting and trim each value.
     *
     * @param  string $value Value to format.
     * @return string
     */
    protected function explode_values_formatter($value) {
        return trim(str_replace('::separator::', ',', $value));
    }
    
}
