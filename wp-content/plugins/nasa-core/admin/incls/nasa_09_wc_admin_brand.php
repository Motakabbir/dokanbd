<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Init Admin Brand
 */
add_action('init', array('Nasa_WC_Admin_Brand', 'getInstance'));

/**
 * Handles taxonomies in admin
 *
 * @class Nasa_WC_Admin_Brand - Nasa Brands
 */
class Nasa_WC_Admin_Brand {

    /**
     * Class instance.
     *
     * @var WC_Admin_Brand instance
     */
    protected static $instance = null;

    /**
     * Brand Slug
     * 
     * @var type 
     */
    public $nasa_taxonomy = 'product_brand';

    /**
     * Default brand ID.
     *
     * @var int
     */
    private $default_brand_id = 0;

    /**
     * Get class instance
     */
    public static function getInstance() {
        global $nasa_opt;

        if (!isset($nasa_opt['enable_nasa_brands']) || !$nasa_opt['enable_nasa_brands']) {
            return null;
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
        
        add_action('current_screen', array($this, 'setting_permalink'));

        $this->default_brand_id = get_option('default_product_brand', 0);

        $this->nasa_taxonomy = apply_filters('nasa_taxonomy_brand', $this->nasa_taxonomy);

        // Add form.
        add_action($this->nasa_taxonomy . '_add_form_fields', array($this, 'add_brand_fields'));
        add_action($this->nasa_taxonomy . '_edit_form_fields', array($this, 'edit_brand_fields'));
        add_action('created_term', array($this, 'save_brand_fields'), 10, 3);
        add_action('edit_term', array($this, 'save_brand_fields'), 10, 3);

        // Add columns.
        add_filter('manage_edit-' . $this->nasa_taxonomy . '_columns', array($this, 'product_brand_columns'));
        add_filter('manage_' . $this->nasa_taxonomy . '_custom_column', array($this, 'product_brand_column'), 10, 3);

        // Add row actions.
        add_filter($this->nasa_taxonomy . '_row_actions', array($this, 'product_brand_row_actions'), 10, 2);
        add_filter('admin_init', array($this, 'handle_product_brand_row_actions'));

        // Maintain hierarchy of terms.
        add_filter('wp_terms_checklist_args', array($this, 'disable_checked_ontop'));

        // Admin footer scripts for this product brands admin screen.
        add_action('admin_footer', array($this, 'scripts_at_product_brand_screen_footer'));

        add_filter('woocommerce_screen_ids', array($this, 'support_admin_style'));
        add_filter('woocommerce_sortable_taxonomies', array($this, 'support_sortable_taxonomies'));
        
        /**
         * Import, Export CSV
         */
        add_filter('woocommerce_product_export_column_names', array($this, 'brand_exp_imp_add_columns'));
        add_filter('woocommerce_product_export_product_default_columns', array($this, 'brand_exp_imp_add_columns'));
        add_filter('woocommerce_product_export_product_column_' . $this->nasa_taxonomy, array($this, 'brand_export_taxonomy'), 10, 2);
        add_filter('woocommerce_csv_product_import_mapping_options', array($this, 'brand_map_columns'));
        add_filter('woocommerce_csv_product_import_mapping_default_columns', array($this, 'brand_add_columns_to_mapping_screen'));
        add_filter('woocommerce_product_importer_parsed_data', array($this, 'brand_parse_taxonomy_data'));
        add_action('woocommerce_product_import_inserted_product_object', array($this, 'brand_set_taxonomy'), 10, 2);
        
        /**
         * Convert to Attributes Brands
         */
        add_filter('nasa_smof_loop_output_item', array($this, 'convert_to_attr_brands_option'), 10, 2);
        
        add_action('wp_ajax_nasa_init_convert_brands_to_attrs', array($this, 'init_convert_brands_to_attrs'));
        
        add_action('wp_ajax_nasa_start_convert_brands_to_attrs', array($this, 'start_convert_brands_to_attrs'));
        add_action('wp_ajax_nasa_start_convert_brands_to_attrs_product', array($this, 'start_convert_brands_to_attrs_product'));
    }
    
    /**
     * Setting Permalink
     */
    public function setting_permalink() {
        $screen = get_current_screen();

        if (!$screen || $screen->id !== 'options-permalink') {
            return;
        }

        return new Nasa_WC_Admin_Brand_Permalink_Settings();
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
     * Thumbnail column added to brand admin.
     *
     * @param mixed $columns Columns array.
     * @return array
     */
    public function product_brand_columns($columns) {
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
    public function product_brand_row_actions($actions, $term) {
        $default_brand_id = absint(get_option('default_product_brand', 0));

        if ($default_brand_id !== $term->term_id && current_user_can('edit_term', $term->term_id)) {
            $actions['make_default'] = sprintf(
                '<a href="%s" aria-label="%s">%s</a>', wp_nonce_url('edit-tags.php?action=make_default&amp;taxonomy=' . $this->nasa_taxonomy . '&amp;post_type=product&amp;tag_ID=' . absint($term->term_id), 'make_default_' . absint($term->term_id)),
                /* translators: %s: taxonomy term name */ esc_attr(sprintf(esc_html__('Make &#8220;%s&#8221; the default brand', 'nasa-core'), $term->name)), esc_html__('Make default', 'nasa-core')
            );
        }

        return $actions;
    }

    /**
     * Handle custom row actions.
     */
    public function handle_product_brand_row_actions() {
        if (isset($_GET['action'], $_GET['tag_ID'], $_GET['_wpnonce']) && 'make_default' === $_GET['action']) {
            $make_default_id = absint($_GET['tag_ID']);

            if (wp_verify_nonce($_GET['_wpnonce'], 'make_default_' . $make_default_id) && current_user_can('edit_term', $make_default_id)) {
                update_option('default_product_brand', $make_default_id);
            }
        }
    }

    /**
     * Thumbnail column value added to brand admin.
     *
     * @param string $columns Column HTML output.
     * @param string $column Column name.
     * @param int    $id Product ID.
     *
     * @return string
     */
    public function product_brand_column($columns, $column, $id) {
        if ('thumb' === $column) {
            // Prepend tooltip for default brand.
            $default_brand_id = absint(get_option('default_product_brand', 0));

            if ($default_brand_id === $id) {
                $columns .= wc_help_tip(esc_html__('This is the default brand and it cannot be deleted. It will be automatically assigned to products with no brand.', 'nasa-core'));
            }

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
     * Admin footer scripts for the product brands admin screen
     *
     * @return void
     */
    public function scripts_at_product_brand_screen_footer() {
        if (!isset($_GET['taxonomy']) || $this->nasa_taxonomy !== $_GET['taxonomy']) {
            return;
        }

        // Ensure the tooltip is displayed when the image column is disabled on product brands.
        wc_enqueue_js(
            "(function($) {
                'use strict';
                var product_brand = $('tr#tag-" . absint($this->default_brand_id) . "');
                product_brand.find('th').empty();
                product_brand.find('td.thumb span').detach('span').appendTo(product_brand.find('th'));
            })(jQuery);"
        );
    }

    /**
     * Brand thumbnail fields.
     */
    public function add_brand_fields() {
        ?>
        <div class="form-field term-thumbnail-wrap">
            <label><?php esc_html_e('Thumbnail', 'nasa-core'); ?></label>
            <div id="product_brand_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" width="60" height="60" /></div>
            <div style="line-height: 60px;">
                <input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" />
                <button type="button" class="upload_image_button button"><?php esc_html_e('Upload/Add image', 'nasa-core'); ?></button>
                <button type="button" class="remove_image_button button"><?php esc_html_e('Remove Image', 'nasa-core'); ?></button>
            </div>
            <script type="text/javascript">

                // Only show the "Remove Image" button when needed
                if (!jQuery('#product_brand_thumbnail_id').val()) {
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

                        jQuery('#product_brand_thumbnail_id').val(attachment.id);
                        jQuery('#product_brand_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                        jQuery('.remove_image_button').show();
                    });

                    // Finally, open the modal.
                    file_frame.open();
                });

                jQuery(document).on('click', '.remove_image_button', function () {
                    jQuery('#product_brand_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                    jQuery('#product_brand_thumbnail_id').val('');
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
                        jQuery('#product_brand_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        jQuery('#product_brand_thumbnail_id').val('');
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
     * Edit brand thumbnail field.
     *
     * @param mixed $term Term (brand) being edited.
     */
    public function edit_brand_fields($term) {
        $thumbnail_id = absint(get_term_meta($term->term_id, 'thumbnail_id', true));

        if ($thumbnail_id) {
            $image = wp_get_attachment_thumb_url($thumbnail_id);
        } else {
            $image = wc_placeholder_img_src();
        }
        ?>

        <tr class="form-field term-thumbnail-wrap">
            <th scope="row" valign="top"><label><?php esc_html_e('Thumbnail', 'nasa-core'); ?></label></th>
            <td>
                <div id="product_brand_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url($image); ?>" width="60" height="60" /></div>
                <div style="line-height: 60px;">
                    <input type="hidden" id="product_brand_thumbnail_id" name="product_brand_thumbnail_id" value="<?php echo esc_attr($thumbnail_id); ?>" />
                    <button type="button" class="upload_image_button button"><?php esc_html_e('Upload/Add image', 'nasa-core'); ?></button>
                    <button type="button" class="remove_image_button button"><?php esc_html_e('Remove Image', 'nasa-core'); ?></button>
                </div>
                <script type="text/javascript">
                    // Only show the "Remove Image" button when needed
                    if ('0' === jQuery('#product_brand_thumbnail_id').val()) {
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

                            jQuery('#product_brand_thumbnail_id').val(attachment.id);
                            jQuery('#product_brand_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            jQuery('.remove_image_button').show();
                        });

                        // Finally, open the modal.
                        file_frame.open();
                    });

                    jQuery(document).on('click', '.remove_image_button', function () {
                        jQuery('#product_brand_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        jQuery('#product_brand_thumbnail_id').val('');
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
     * Save brand fields
     *
     * @param mixed  $term_id Term ID being saved.
     * @param mixed  $tt_id Term taxonomy ID.
     * @param string $taxonomy Taxonomy slug.
     */
    public function save_brand_fields($term_id, $tt_id = '', $taxonomy = '') {
        if (isset($_POST['product_brand_thumbnail_id']) && $this->nasa_taxonomy === $taxonomy) {
            update_term_meta($term_id, 'thumbnail_id', absint($_POST['product_brand_thumbnail_id']));
        }
        
        /**
         * Delete cache
         */
        $this->delete_cache();
    }
    
    /**
     * Delete Cache
     */
    public function delete_cache() {
        /**
         * Clear cache quickview
         */
        nasa_del_cache_quickview();
    }
    
    /**
     * Add CSV columns for exporting extra data.
     *
     * @param  array  $columns
     * @return array  $columns
     */
    public function brand_exp_imp_add_columns($columns) {
        $columns[$this->nasa_taxonomy] = __('Product Brand', 'nasa-core');

        return $columns;
    }

    /**
     * contents data column content.
     *
     * @param  mixed       $value
     * @param  WC_Product  $product
     * @return mixed       $value
     */
    public function brand_export_taxonomy($value, $product) {
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
     * Register the 'Product Brand' column in the importer.
     *
     * @param  array  $columns
     * @return array  $columns
     */
    public function brand_map_columns($options) {
        $options[$this->nasa_taxonomy] = __('Product Brand', 'nasa-core');

        return $options;
    }

    /**
     * Add automatic mapping support for custom columns.
     *
     * @param  array  $columns
     * @return array  $columns
     */
    public function brand_add_columns_to_mapping_screen($columns) {
        $columns[__('Product Brand', 'nasa-core')] = $this->nasa_taxonomy;

        // Always add English mappings.
        $columns['Product Brand'] = $this->nasa_taxonomy;

        return $columns;
    }

    /**
     * parse group to array ids.
     *
     * @param  array                    $parsed_data
     * @param  WC_Product_CSV_Importer  $importer
     * @return array terms ids
     */
    public function brand_parse_taxonomy_data($parsed_data) {
        if (!empty($parsed_data[$this->nasa_taxonomy])) {
            $parsed_data[$this->nasa_taxonomy] = $this->parse_brands_field($parsed_data[$this->nasa_taxonomy]);
        }

        return $parsed_data;
    }

    /**
     * Set taxonomy.
     *
     * @param  array  $parsed_data
     * @return array
     */
    public function brand_set_taxonomy($product, $data) {
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
    protected function parse_brands_field($value) {
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
    
    /**
     * Convert Brand to Brand Attribute
     * 
     * @param type $output
     * @param type $option
     * @return string
     */
    public function convert_to_attr_brands_option($output, $option) {
        if ($option['type'] !== 'nasa_brand_convert_attr') {
            return $output;
        }
        
        $brand_attrs = Nasa_Abstract_WC_Attr_UX::get_tax_images_to_brands();
        if (empty($brand_attrs)) {
            $output .= '<a class="red-color" target="_blank" href="' . esc_url(admin_url('edit.php?post_type=product&page=product_attributes')) . '">Please create an Attribute of Image type to push data in!</a>';
        } else {
            $output .= '<div class="ns-convert-brand-wrap">';
            
            $output .= '<a class="ns-init-convert-brand button" href="javascript:void(0);">Select Attribute to push data</a>';
            $output .= '<div class="brand-attrs-list hidden-tag">';
            
            foreach ($brand_attrs as $slug => $brand) {
                $output .= '<span><a class="brand-attr-item" data-slug="' . $slug . '" href="javascript:void(0);">' . $brand . '</a></span>';
            }
            
            $output .= '<span class="hidden-tag"><input type="number" class="limit-1-time" value="50" /> Limit Transfer</span>';
            $output .= '<span><a class="ns-start-convert-brand button button-primary" href="javascript:void(0);">Apply</a></span>';
            
            $output .= '<div class="convert-process-bar hidden-tag"><div class="complete-convert"></div></div>';
            $output .= '<div class="convert-process-bar-loading hidden-tag"></div>';
            $output .= '<div class="convert-process-bar-complete hidden-tag">Convert Data Complete!</div>';
            
            $output .= '</div>';
            $output .= '</div>';
        }
        
        return $output;
    }
    
    /**
     * Init convert
     */
    public function init_convert_brands_to_attrs() {
        $json = array(
            'count' => 0,
            'count_p' => 0,
            'attr' => $_POST['slug'],
        );
        
        /**
         * get All Brands
         */
        $tax = apply_filters('nasa_taxonomy_brand', Nasa_WC_Brand::$nasa_taxonomy);
        
        $terms = get_terms( array(
            'taxonomy' => $tax,
            'hide_empty' => false
        ));
        
        $output = array();
        
        if (!empty($terms) && !is_wp_error($terms)) {
            
            foreach ($terms as $term) {
                $output[] = array(
                    'id' => $term->term_id,
                    'name' => $term->name,
                    'slug' => $term->slug,
                    'desc' => $term->description,
                    'count' => $term->count,
                    'thumbnail_id' => get_term_meta($term->term_id, 'thumbnail_id', true),
                );
                
                $json['count']++;
                $json['count_p'] += $term->count;
            }
            
            $json['brands'] = $output;
        }
        
        die(json_encode($json));
    }
    
    /**
     * Start convert
     */
    public function start_convert_brands_to_attrs() {
        $json = array(
            'success' => '0'
        );
        
        $term_data = array(
            'name' => $_POST['name'],
            'slug' => $_POST['slug'],
            'description' => $_POST['desc'],
            'thumbnail_id' => $_POST['thumbnail_id'],
        );
        
        $taxonomy = 'pa_' . $_POST['tax'];
        
        $check_exist = get_term_by('slug', $_POST['slug'], $taxonomy);
        
        if (!$check_exist || is_wp_error($check_exist)) {
            $new_term = wp_insert_term($term_data['name'], $taxonomy, array(
                'slug' => $term_data['slug'],
                'description' => $term_data['description']
            ));
            
            if (!is_wp_error($new_term)) {
                $term_id = $new_term['term_id'];

                // Save Thumbnail ID
                update_term_meta($term_id, 'nasa_image', $term_data['thumbnail_id']);
                
                $check_exist = true;
            } else {
                // Error
                $error_message = $new_term->get_error_message();
                echo 'Error creating term: ' . $error_message;
            }
        }
        
        if ($check_exist) {
            $json['success'] = '1';
        }
        
        die(json_encode($json));
    }
    
    /**
     * Start convert product
     */
    public function start_convert_brands_to_attrs_product() {
        $json = array(
            'success' => '0',
            'complete' => 0
        );
        
        $offset = $_POST['offset'];
        
        $term_data = array(
            'name' => $_POST['name'],
            'slug' => $_POST['slug'],
            'description' => $_POST['desc'],
            'thumbnail_id' => $_POST['thumbnail_id'],
        );
        
        $taxonomy = 'pa_' . $_POST['tax'];
        
        $term_id = 0;
        $check_exist = get_term_by('slug', $_POST['slug'], $taxonomy);
        
        if (!$check_exist || is_wp_error($check_exist)) {
            $new_term = wp_insert_term($term_data['name'], $taxonomy, array(
                'slug' => $term_data['slug'],
                'description' => $term_data['description']
            ));
            
            if (!is_wp_error($new_term)) {
                $term_id = $new_term['term_id'];

                // Save Thumbnail ID
                update_term_meta($term_id, 'order_' . $taxonomy, 0);
                update_term_meta($term_id, 'nasa_image', $term_data['thumbnail_id']);
            } else {
                // Error
                $error_message = $new_term->get_error_message();
                echo 'Error creating term: ' . $error_message;
            }
        } else {
            $term_id = $check_exist->term_id;
        }
        
        if ($term_id) {
            $tax = apply_filters('nasa_taxonomy_brand', Nasa_WC_Brand::$nasa_taxonomy);
            
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => $_POST['limit'],
                'offset' => $offset,
                'tax_query' => array(
                    array(
                        'taxonomy' => $tax,
                        'field'    => 'term_id',
                        'terms'    => $_POST['id'],
                    ),
                ),
            );
            
            $complete = 0;
            $products = get_posts($args);
            $products_id = [];
            
            if (!empty($products)) {
                foreach ($products as $product) {
                    /* Set Attr for Product */
                    $product_attributes = get_post_meta($product->ID, '_product_attributes', true);
                    
                    if (empty($product_attributes)) {
                        $product_attributes = array();
                    }
                    
                    if (!isset($product_attributes[$taxonomy])) {
                        $product_attributes[$taxonomy] = array(
                            'name' => $taxonomy,
                            'value' => '',
                            'position' => count($product_attributes),
                            'is_visible' => 1,
                            'is_variation' => 0,
                            'is_taxonomy' => 1
                        );

                        update_post_meta($product->ID, '_product_attributes', $product_attributes);
                    }
                    
                    /* Set Term - Attribute for Product */
                    wp_set_object_terms($product->ID, $term_id, $taxonomy, true);
                    $complete += 1;
                    
                    $products_id[] = $product->ID;
                }
            }
            
            $json = array(
                'success' => '1',
                'complete' => $complete,
                'term_id' => $term_id,
                'tax' => $taxonomy,
                'products_id' => $products_id
            );
        }
        
        die(json_encode($json));
    }
}

/**
 * Nasa_WC_Admin_Brand_Permalink_Settings Class.
 */
class Nasa_WC_Admin_Brand_Permalink_Settings {

    /**
     * Permalink settings.
     *
     * @var array
     */
    private $_permalink = 'product-brand';

    /**
     * Hook in tabs.
     */
    public function __construct() {
        $this->_permalink = get_option('nasa_product_brand_permalink', 'product-brand');
        
        $this->settings_init();
        $this->settings_save();
    }

    /**
     * Init our settings.
     */
    public function settings_init() {
        add_settings_field(
            'nasa_product_brand_slug', esc_html__('Product brand base', 'nasa-core'), array($this, 'product_brand_slug_input'), 'permalink', 'optional'
        );
    }

    /**
     * Show a slug input box.
     */
    public function product_brand_slug_input() {
        ?>
        <input name="nasa_product_brand_slug" type="text" class="regular-text code" value="<?php echo esc_attr($this->_permalink); ?>" placeholder="<?php echo esc_attr_x('product-brand', 'slug', 'nasa-core'); ?>" />
        <?php
    }

    /**
     * Save the settings.
     */
    public function settings_save() {
        if (!NASA_CORE_IN_ADMIN) {
            return;
        }

        // We need to save the options ourselves; settings api does not trigger save for the permalinks page.
        if (isset($_POST['nasa_product_brand_slug'], $_POST['wc-permalinks-nonce']) && wp_verify_nonce(wp_unslash($_POST['wc-permalinks-nonce']), 'wc-permalinks')) { // WPCS: input var ok, sanitization ok.
            wc_switch_to_site_locale();

            // $permalink = get_option('nasa_product_brand_permalink', 'product-brand');
            $permalink = wc_sanitize_permalink(wp_unslash($_POST['nasa_product_brand_slug'])); // WPCS: input var ok, sanitization ok.

            update_option('nasa_product_brand_permalink', $permalink);
            wc_restore_locale();
        }
    }
}
