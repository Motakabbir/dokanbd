<?php
/**
 * Exit if accessed directly
 */
defined('ABSPATH') or die();

/**
 * Check WooCommerce Active
 */
if (NASA_WOO_ACTIVED) {

    add_action('widgets_init', 'elessi_product_filter_multi_categories_widget');

    function elessi_product_filter_multi_categories_widget() {
        register_widget('Elessi_WC_Widget_Multi_Categories_Filter');
    }

    class Elessi_WC_Widget_Multi_Categories_Filter extends WC_Widget {
        
        public static $_request_name = 'product_categories';
        
        protected $_current_filters = array();

        protected $_link = '';
        
        /**
         * Constructor
         */
        public function __construct() {
            $this->widget_cssclass = 'woocommerce widget_multi_categories_filter nasa-any-filter nasa-widget-has-active';
            $this->widget_description = __('Display a list of categories to filter products.', 'elessi-theme');
            $this->widget_id = 'nasa_woocommerce_multi_categories_filter';
            $this->widget_name = 'Nasa - Filter Product with Multi Categories';
            $this->settings = array(
                'title' => array(
                    'type' => 'text',
                    'std' => 'Filter by Multi Categories',
                    'label' => __('Title', 'elessi-theme')
                ),
                'number' => array(
                    'type' => 'text',
                    'std' => 45,
                    'label' => __('Number Categories', 'elessi-theme')
                ),
                'list_cats' => array(
                    'type' => 'text',
                    'std' => '',
                    'label' => __('Categories Included List (ID or Slug, separated by ",". Ex: 1, 2 or slug-1, slug-2)', 'elessi-theme')
                ),
            );
            
            if (!empty($_REQUEST[self::$_request_name])) {
                $this->_current_filters = is_array($_REQUEST[self::$_request_name]) ?
                    $_REQUEST[self::$_request_name] : explode(',', wc_clean($_REQUEST[self::$_request_name]));
                
                $this->_current_filters = array_map('sanitize_title', $this->_current_filters);
            }
            
            add_action('woocommerce_product_query', array($this, 'filter_categories_product_query'));

            parent::__construct();
        }
        
        /**
         * Filter by status product
         * 
         * @param type $q
         */
        public function filter_categories_product_query($q){
            if (empty($this->_current_filters)) {
                return;
            }
            
            $q_tax_query = $q->get('tax_query');
            $tax_query = !empty($q_tax_query) ? $q_tax_query : array();
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $this->_current_filters,
                'operator' => 'IN'
            );

            if (!empty($tax_query)) {
                $q->set('tax_query', $tax_query);
            }
        }
        
        /**
         * Build link cat
         */
        protected function build_cat_link($cat) {
            $new_current = array();
            $class = 'nasa-filter-cat';
            
            if (!in_array($cat->slug, $this->_current_filters)) {
                $new_current = $this->_current_filters;
                $new_current[] = $cat->slug;
            } else {
                $class .= ' nasa-active';
                foreach ($this->_current_filters as $value) {
                    if ($value !== $cat->slug) {
                        $new_current[] = $value;
                    }
                }
            }
            
            $link_cat = !empty($new_current) ? add_query_arg(self::$_request_name, implode(',', $new_current), $this->_link) : $this->_link;
            
            $html = '<a title="' . esc_attr($cat->name) . '" class="' . $class . '" href="' . esc_url($link_cat) . '" data-filter="' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</a>';
            
            return $html;
        }

        /**
         * widget function.
         *
         * @see WP_Widget
         * @param array $args
         * @param array $instance
         */
        public function widget($args, $instance) {
            if (!is_shop() && !is_product_taxonomy()) {
                return;
            }

            /**
             * Number Cats show
             */
            $number = isset($instance['number']) && (int) $instance['number'] ? (int) $instance['number'] : $this->settings['number']['std'];
            
            /**
             * Slug Cats show
             */
            $list_cats = isset($instance['list_cats']) && $instance['list_cats'] ? $instance['list_cats'] : $this->settings['list_cats']['std'];

            if (trim($list_cats) !== '') {
                $product_categories = explode(',', trim($list_cats));

                if ($product_categories) {
                    foreach ($product_categories as $product_category) {
                        $product_category = trim($product_category);
                        if ($product_category != '') {
                            /**
                             * Query Cats
                             */
                            $field = is_numeric($product_category) ? 'term_id' : 'slug';
                            $term_include = get_term_by($field, $product_category, 'product_cat');
    
                            if ($term_include) {
                                $cats[] = $term_include;
                            }
                        }
                    }
                }
            } else {
                /**
                 * Query Cats
                 */
                $cats = get_terms(apply_filters('nasa_filter_cat_args', array(
                    'number' => $number,
                    'taxonomy' => 'product_cat',
                    'orderby' => 'count',
                    'order' => 'DESC'
                )));
            }
            
            if (!$cats) {
                return;
            }
            
            extract($args);
            
            $this->_link = elessi_get_origin_url();
            
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if ($key !== self::$_request_name) {
                        $this->_link = add_query_arg($key, esc_attr($value), $this->_link);
                    }
                }
            }

            if ($_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes()) {
                foreach ($_chosen_attributes as $attribute => $data) {
                    $attr_name = 0 === strpos($attribute, 'pa_') ? substr($attribute, 3) : $attribute;
                    $taxonomy_filter = 'filter_' . $attr_name;
                    $this->_link = add_query_arg(esc_attr($taxonomy_filter), esc_attr(implode(',', $data['terms'])), $this->_link);

                    if ('or' == $data['query_type']) {
                        $this->_link = add_query_arg(esc_attr(str_replace('pa_', 'query_type_', $attribute)), 'or', $this->_link);
                    }
                }
            }
            
            $output = '<div class="nasa-filter-by-cats">';
            
            foreach ($cats as $cat) {
                $output .= $this->build_cat_link($cat);
            }
            
            $output .= '</div>';

            $this->widget_start($args, $instance);
            echo $output;
            $this->widget_end($args);
        }
    }
}
