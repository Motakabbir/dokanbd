<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Class Widget Product Brands
 */
if (NASA_WOO_ACTIVED) {
	
    /**
     * Register widget
     */
    add_action('widgets_init', 'nasa_products_widget');
    function nasa_products_widget() {
        register_widget('Nasa_Products_Widget');
    }
    
    class Nasa_Products_Widget extends WC_Widget {
        /**
         * Current Product id
         */
        protected $_current_product_id = null;

        /**
         * Constructor
         */
        public function __construct() {
            $this->widget_cssclass = 'woocommerce nasa-products-widget';
            $this->widget_description = __('Display products list.', 'nasa-core');
            $this->widget_id = 'nasa_products_widget';
            $this->widget_name = 'Nasa - Products Widget';
            $this->settings = array(
                'title' => array(
                    'type' => 'text',
                    'std' => __('Products', 'nasa-core'),
                    'label' => __('Title', 'nasa-core')
                ),
                'type' => array(
                    'type' => 'select',
                    'std' => 'recent_product',
                    'label' => __('Type Show', 'nasa-core'),
                    'options' => array(
                        'recent_product' => __('Recent', 'nasa-core'),
                        'best_selling' => __('Best Selling', 'nasa-core'),
                        'featured_product' => __('Featured', 'nasa-core'),
                        'top_rate' => __('Top Rate', 'nasa-core'),
                        'on_sale' => __('On Sale', 'nasa-core'),
                        'recent_review' => __('Recent Review', 'nasa-core')
                    )
                ),
                'number' => array(
                    'type' => 'text',
                    'std' => '3',
                    'label' => __('Limit', 'nasa-core')
                )
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
            $type = isset($instance['type']) ? $instance['type'] : $this->settings['type']['std'];
            $number = isset($instance['number']) ? (int) $instance['number'] : $this->settings['number']['std'];
            $current_cat = nasa_root_term_id();
            
            $args_sc = array(
                'type' => $type,
                'number' => $number,
                'style' => 'list',
                'columns_number' => '1',
                'columns_number_small' => '1',
                'columns_number_tablet' => '1'
            );
            
            if ($current_cat) {
                $args_sc['cat'] = $current_cat;
            }
            
            if ($this->_current_product_id) {
                $args_sc['not_in'] = $this->_current_product_id;
            }
            
            $shortcode = '[nasa_products';
            foreach ($args_sc as $key => $value) {
                $shortcode .= ' ' . $key .'="' . $value . '"';
            }
            $shortcode .= ']';

            $this->widget_start($args, $instance);
            
            echo do_shortcode($shortcode);
            
            $this->widget_end($args);
        }
    }
}
