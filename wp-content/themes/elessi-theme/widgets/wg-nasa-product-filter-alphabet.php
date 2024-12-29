<?php
defined('ABSPATH') or die(); // Exit if accessed directly

if (NASA_WOO_ACTIVED) {

    add_action('widgets_init', 'elessi_product_filter_alphabet_widget');

    function elessi_product_filter_alphabet_widget() {
        register_widget('Elessi_WC_Widget_Alphabet_Filter');
    }

    class Elessi_WC_Widget_Alphabet_Filter extends WC_Widget {
        
        public static $_alphabet = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        public static $_request_name = 'first-letter';
        protected $_tax_query = array();
        protected $_meta_query = array();
        protected $_query = null;

        /**
         * Constructor
         */
        public function __construct() {
            $this->widget_cssclass = 'woocommerce widget_alphabet_filter nasa-any-filter nasa-widget-has-active';
            $this->widget_description = __('Display a list of alphabet to filter products.', 'elessi-theme');
            $this->widget_id = 'nasa_woocommerce_alphabet_filter';
            $this->widget_name = 'Nasa - Filter Product by Alphabet';
            $this->settings = array(
                'title' => array(
                    'type' => 'text',
                    'std' => __('Filter by Alphabet', 'elessi-theme'),
                    'label' => __('Title', 'elessi-theme')
                )
            );
            
            add_filter('woocommerce_get_filtered_term_product_counts_query', array($this, 'filter_alphabet_product_query_count'));

            add_filter('posts_where', array($this, 'fillter_by_first_character'), 10, 2);

            parent::__construct();
        }

        public function fillter_by_first_character($where, $query) {
            global $wpdb;
        
            if (NASA_CORE_IN_ADMIN || !$query->is_main_query() || !is_post_type_archive('product') || !isset($_GET[self::$_request_name])) {
                return $where;
            }

            $search_terms = $_GET[self::$_request_name];
        
            if (trim($search_terms) !== '') {
                $first_character = mb_substr($search_terms, 0, 1);
                $where .= $wpdb->prepare(' AND (' . $wpdb->posts . '.post_title LIKE %s)', $wpdb->esc_like($first_character) . '%');
            }
        
            return $where;
        }
        
        /**
         * Count
         * 
         * @param type $query
         * @return type
         */
        public function filter_alphabet_product_query_count($query) {
            global $wpdb;

            $search_terms = isset($_GET[self::$_request_name]) ? $_GET[self::$_request_name] : '';
        
            if (!empty($search_terms)) {
                $first_character = mb_substr($search_terms, 0, 1);
        
                $query['where'] .= $wpdb->prepare(' AND (' . $wpdb->posts . '.post_title LIKE %s)', $wpdb->esc_like($first_character) . '%');
            }
            
            return $query;
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
            
            extract($args);

            $link = elessi_get_origin_url();
            
            if (!empty($_GET)) {
                foreach ($_GET as $key => $value) {
                    if ($key != self::$_request_name) {
                        $link = add_query_arg($key, esc_attr($value), $link);
                    }
                }
            }
            
            $output = '<ul class="nasa-product-alphabet-widget small-block-grid-1 medium-block-grid-4 large-block-grid-6 nasa-after-clear">';
            
            $filtered_alphabet = isset($_GET[self::$_request_name]) ? $_GET[self::$_request_name] : '';
            /**
             * gen option
             */
           
            foreach (self::$_alphabet as $value) {
                $link_alphabet = $filtered_alphabet !== '' && $filtered_alphabet == $value ? $link : add_query_arg(self::$_request_name, $value, $link) ;
                $class = 'nasa-filter-alphabet';
                $class .= $filtered_alphabet == $value ? ' nasa-active' : '';
                
                $output .= '<li><a class="' . esc_attr($class) . '" href="' . esc_url($link_alphabet) . '" title="' . esc_attr($value) . '" data-filter="first-letter">' . esc_html($value) . '</a></li>';
            }
            
            $output .= '</ul>';

            $this->widget_start($args, $instance);
            echo $output;
            $this->widget_end($args);
        }
    }
}
