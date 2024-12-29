<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Class Widget Product Brands Dropdown
 */
if (NASA_WOO_ACTIVED) {
	
    /**
     * Register widget
     */
    add_action('widgets_init', 'nasa_product_brands_dropdown_widget');
    function nasa_product_brands_dropdown_widget() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['disable_ajax_product']) || !$nasa_opt['disable_ajax_product']) {
            return;
        }
        
        if (isset($nasa_opt['enable_nasa_brands']) && $nasa_opt['enable_nasa_brands']) {
            register_widget('Nasa_Product_Brands_Dropdown_Widget');
        }
    }
    
    class Nasa_Product_Brands_Dropdown_Widget extends WC_Widget {
        /**
         * taxonomy
         *
         * @var type 
         */
        public $nasa_tax = 'product_brand';

        /**
         * brand ancestors
         *
         * @var array
         */
        public $brand_ancestors;

        /**
         * Current brand
         *
         * @var bool
         */
        public $current_brand;

        /**
         * Constructor
         */
        public function __construct() {
            $this->nasa_tax = apply_filters('nasa_taxonomy_brand', Nasa_WC_Brand::$nasa_taxonomy);
            $this->widget_cssclass = 'woocommerce widget_product_brands_dropdown';
            $this->widget_description = __('Display product brands with Dropdown.', 'nasa-core');
            $this->widget_id = 'nasa_product_brands_dropdown';
            $this->widget_name = 'Nasa - Product Brands Dropdown';
            $this->settings = array(
                'title' => array(
                    'type' => 'text',
                    'std' => __('Product Brands', 'nasa-core'),
                    'label' => __('Title', 'nasa-core')
                ),
                'orderby' => array(
                    'type' => 'select',
                    'std' => 'name',
                    'label' => __('Order by', 'nasa-core'),
                    'options' => array(
                        'order' => __('Brand Order', 'nasa-core'),
                        'name' => __('Name', 'nasa-core')
                    )
                ),
                'count' => array(
                    'type' => 'checkbox',
                    'std' => 0,
                    'label' => __('Show product counts', 'nasa-core')
                ),
                'hierarchical' => array(
                    'type' => 'checkbox',
                    'std' => 1,
                    'label' => __('Show hierarchy', 'nasa-core')
                ),
                'show_children_only' => array(
                    'type' => 'checkbox',
                    'std' => 0,
                    'label' => __('Only show children of the current brand', 'nasa-core')
                ),
                'hide_empty' => array(
                    'type'  => 'checkbox',
                    'std'   => 0,
                    'label' => __('Hide empty brands', 'nasa-core'),
                ),
                'max_depth' => array(
                    'type'  => 'text',
                    'std'   => '',
                    'label' => __('Maximum depth', 'nasa-core'),
                ),
            );

            parent::__construct();
        }

        /**
         * form function.
         *
         * @see WP_Widget->form
         * @param array $instance
         */
        public function form($instance) {
            if (empty($this->settings)) {
                return;
            }

            foreach ($this->settings as $key => $setting) {
                $value = isset($instance[$key]) ? $instance[$key] : (isset($setting['std']) ? $setting['std'] : '');
                $_id = $this->get_field_id($key);
                $_name = $this->get_field_name($key);

                switch ($setting['type']) {

                    case 'text' :
                        ?>
                        <p>
                            <label for="<?php echo esc_attr($_id); ?>"><?php echo ($setting['label']); ?></label>
                            <input class="widefat" id="<?php echo esc_attr($_id); ?>" name="<?php echo esc_attr($_name); ?>" type="text" value="<?php echo esc_attr($value); ?>" />
                        </p>
                        <?php
                        break;

                    case 'number' :
                        ?>
                        <p>
                            <label for="<?php echo esc_attr($_id); ?>"><?php echo ($setting['label']); ?></label>
                            <input class="widefat" id="<?php echo esc_attr($_id); ?>" name="<?php echo esc_attr($_name); ?>" type="number" step="<?php echo esc_attr($setting['step']); ?>" min="<?php echo esc_attr($setting['min']); ?>" max="<?php echo esc_attr($setting['max']); ?>" value="<?php echo esc_attr($value); ?>" />
                        </p>
                        <?php
                        break;

                    case 'select' :
                        ?>
                        <p>
                            <label for="<?php echo esc_attr($_id); ?>"><?php echo ($setting['label']); ?></label>
                            <select class="widefat" id="<?php echo esc_attr($_id); ?>" name="<?php echo esc_attr($_name); ?>">
                                <?php foreach ($setting['options'] as $o_key => $o_value): ?>
                                    <option value="<?php echo esc_attr($o_key); ?>" <?php selected($o_key, $value); ?>><?php echo esc_html($o_value); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </p>
                        <?php
                        break;

                    case 'checkbox' :
                        ?>
                        <p>
                            <input id="<?php echo esc_attr($_id); ?>" name="<?php echo esc_attr($_name); ?>" type="checkbox" value="1" <?php checked($value, 1); ?> />
                            <label for="<?php echo esc_attr($_id); ?>"><?php echo $setting['label']; ?></label>
                        </p>
                        <?php
                        break;
                }
            }
        }

        /**
         * widget function.
         *
         * @see WP_Widget
         *
         * @param array $args
         * @param array $instance
         *
         * @return void
         */
        public function widget($args, $instance) {
            global $nasa_opt, $wp_query, $post;
            
            if (!isset($nasa_opt['disable_ajax_product']) || !$nasa_opt['disable_ajax_product']) {
                return;
            }
            
            $count = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
            $hierarchical = isset($instance['hierarchical']) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
            $show_children_only = isset($instance['show_children_only']) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
            $orderby = isset($instance['orderby']) ? $instance['orderby'] : $this->settings['orderby']['std'];
            $hide_empty = isset($instance['hide_empty']) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
            
            $dropdown_args = array(
                'taxonomy' => $this->nasa_tax,
                'name' => $this->nasa_tax,
                'class' => 'dropdown_' . $this->nasa_tax,
                'hide_empty' => $hide_empty,
                'selected' => isset($wp_query->query_vars[$this->nasa_tax] ) ? $wp_query->query_vars[$this->nasa_tax] : '',
                'show_option_none' => __('Select a brand', 'nasa-core'),
            );
            
            $max_depth = absint(isset($instance['max_depth']) ? $instance['max_depth'] : $this->settings['max_depth']['std']);

            $dropdown_args['depth'] = $max_depth;

            if ('order' === $orderby) {
                $dropdown_args['orderby']  = 'meta_value_num';
                $dropdown_args['meta_key'] = 'order';
            }

            $this->current_brand = false;
            $this->brand_ancestors = array();

            if (is_tax($this->nasa_tax)) {
                $this->current_brand = $wp_query->queried_object;
                $this->brand_ancestors = get_ancestors($this->current_brand->term_id, $this->nasa_tax);
            } elseif (is_singular('product')) {
                $terms = wc_get_product_terms(
                    $post->ID,
                    $this->nasa_tax,
                    apply_filters(
                        'woocommerce_product_brands_widget_product_terms_args',
                        array(
                            'orderby' => 'parent',
                            'order' => 'DESC',
                        )
                    )
                );

                if ($terms) {
                    $main_term = apply_filters('woocommerce_product_brands_widget_main_term', $terms[0], $terms);
                    $this->current_brand = $main_term;
                    $this->brand_ancestors = get_ancestors($main_term->term_id, $this->nasa_tax);
                }
            }

            // Show Siblings and Children Only.
            if ($show_children_only && $this->current_brand) {
                if ($hierarchical) {
                    $include = array_merge(
                        $this->brand_ancestors,
                        array($this->current_brand->term_id),
                        get_terms(
                            $this->nasa_tax,
                            array(
                                'fields' => 'ids',
                                'parent' => 0,
                                'hierarchical' => true,
                                'hide_empty' => false,
                            )
                        ),
                        get_terms(
                            $this->nasa_tax,
                            array(
                                'fields' => 'ids',
                                'parent' => $this->current_brand->term_id,
                                'hierarchical' => true,
                                'hide_empty' => false,
                            )
                        )
                    );
                    // Gather siblings of ancestors.
                    if ($this->brand_ancestors) {
                        foreach ($this->brand_ancestors as $ancestor) {
                            $include = array_merge(
                                $include,
                                get_terms(
                                    $this->nasa_tax,
                                    array(
                                        'fields' => 'ids',
                                        'parent' => $ancestor,
                                        'hierarchical' => false,
                                        'hide_empty' => false,
                                    )
                                )
                            );
                        }
                    }
                } else {
                    // Direct children.
                    $include = get_terms(
                        $this->nasa_tax,
                        array(
                            'fields' => 'ids',
                            'parent' => $this->current_brand->term_id,
                            'hierarchical' => true,
                            'hide_empty' => false,
                        )
                    );
                }

                $dropdown_args['include'] = implode(',', $include);

                if (empty($include)) {
                    return;
                }
            } elseif ($show_children_only) {
                $dropdown_args['depth'] = 1;
                $dropdown_args['child_of'] = 0;
                $dropdown_args['hierarchical'] = 1;
            }

            $this->widget_start($args, $instance);
            
            echo '<div class="nasa-wrap-select no-list">';

            wc_product_dropdown_categories(
                apply_filters(
                    'woocommerce_product_brands_widget_dropdown_args',
                    wp_parse_args(
                        $dropdown_args,
                        array(
                            'show_count' => $count,
                            'hierarchical' => $hierarchical,
                            // 'show_uncategorized' => 0,
                            'selected' => $this->current_brand ? $this->current_brand->slug : ''
                        )
                    )
                )
            );
            
            echo '</div>';

            wp_enqueue_script('selectWoo');
            wp_enqueue_style('select2');

            wc_enqueue_js("
                jQuery('.dropdown_" . $this->nasa_tax . "').on('change', function() {
                    if (jQuery(this).val() != '') {
                        var this_page = '';
                        var home_url = '" . esc_js(home_url('/')) . "';
                        if (home_url.indexOf('?') > 0) {
                            this_page = home_url + '&" . $this->nasa_tax . "=' + jQuery(this).val();
                        } else {
                            this_page = home_url + '?" . $this->nasa_tax . "=' + jQuery(this).val();
                        }
                        location.href = this_page;
                    } else {
                        location.href = '" . esc_js(wc_get_page_permalink('shop')) . "';
                    }
                });

                if (jQuery().selectWoo) {
                    var wc_product_brand_select = function() {
                        jQuery('.dropdown_" . $this->nasa_tax . "').selectWoo( {
                            placeholder: '" . esc_js(__('Select a brand', 'nasa-core')) . "',
                            minimumResultsForSearch: 5,
                            width: '100%',
                            allowClear: true,
                            language: {
                                noResults: function() {
                                    return '" . esc_js(_x('No matches found', 'enhanced select', 'nasa-core')) . "';
                                }
                            }
                        } );
                    };
                    wc_product_brand_select();
                }
            ");

            $this->widget_end($args);
        }
    }
}
