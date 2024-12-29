<?php
/**
 * Price Filter Widget and related functions
 *
 * Generates a range slider to filter products by price.
 *
 * @author   NasaThemes
 * @category Widgets
 * @version  1.0.0
 * @extends  WC_Widget
 */

defined('ABSPATH') or die(); // Exit if accessed directly

if (NASA_WOO_ACTIVED) {

    add_action('widgets_init', 'elessi_product_filter_price_widget');
    function elessi_product_filter_price_widget() {
        register_widget('Elessi_WC_Widget_Price_Filter');
    }
    
    class Elessi_WC_Widget_Price_Filter extends WC_Widget {

        /**
         * Constructor
         */
        public function __construct() {
            $this->widget_cssclass = 'woocommerce widget_price_filter nasa-price-filter-slide nasa-widget-has-active';
            $this->widget_description = __('Shows a price filter slider in a widget which lets you narrow down the list of shown products when viewing product categories.', 'elessi-theme');
            $this->widget_id = 'nasa_woocommerce_price_filter';
            $this->widget_name = __('Nasa - Filter Product by Price (slide)', 'elessi-theme');
            $this->settings = array(
                'title' => array(
                    'type' => 'text',
                    'std' => __('Filter by price', 'elessi-theme'),
                    'label' => __('Title', 'elessi-theme')
                ),
                'step' => array(
                    'type' => 'number',
                    'min' => '1',
                    'std' => '10',
                    'label' => __('Step Change', 'elessi-theme')
                ),
                'btn_filter' => array(
                    'type' => 'checkbox',
                    'std' => 0,
                    'label' => __('Enable Button Filter', 'elessi-theme')
                ),
            );
            
            $plugin_url = WC()->plugin_url();
            $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
            
            wp_register_script('accounting', $plugin_url . '/assets/js/accounting/accounting' . $suffix . '.js', array('jquery'), '0.4.2', true);
            
            wp_register_script('wc-jquery-ui-touchpunch', $plugin_url . '/assets/js/jquery-ui-touch-punch/jquery-ui-touch-punch' . $suffix . '.js', array('jquery-ui-slider'), WC_VERSION, true);
            
            wp_register_script('wc-price-slider', $plugin_url . '/assets/js/frontend/price-slider' . $suffix . '.js', array('jquery-ui-slider', 'wc-jquery-ui-touchpunch', 'accounting'), WC_VERSION, true);
            
            wp_localize_script('wc-price-slider', 'woocommerce_price_slider_params', array(
                // 'min_price' => isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : '',
                // 'max_price' => isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : '',
                'currency_format_num_decimals'  => 0,
                'currency_format_symbol'        => get_woocommerce_currency_symbol(),
                'currency_format_decimal_sep'   => esc_attr(wc_get_price_decimal_separator()),
                'currency_format_thousand_sep'  => esc_attr(wc_get_price_thousand_separator()),
                'currency_format'               => esc_attr(str_replace(array('%1$s', '%2$s'), array('%s', '%v'), get_woocommerce_price_format())),
            ));
            
            if (is_customize_preview()) {
                wp_enqueue_script('wc-price-slider');
            }

            parent::__construct();
        }

        /**
         * Output the html at the start of a widget.
         *
         * @param  array $args
         * @return string
         */
        public function current_widget_start($args, $instance) {
            echo $args['before_widget'];
        }

        /**
         * Output the html at the end of a widget.
         *
         * @param  array $args
         * @return string
         */
        public function current_widget_end($args) {
            parent::widget_end($args);
        }

        /**
         * widget function.
         *
         * @see WP_Widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget($args, $instance) {
            if (!is_shop() && !is_product_taxonomy()) {
                return;
            }
            
            wp_enqueue_script('wc-price-slider');
            
            $this->current_widget_start($args, $instance);
            
            $_title = isset($instance['title']) ? $instance['title'] : esc_html__('Price', 'elessi-theme');
            $_step = isset($instance['step']) ? (int) $instance['step'] : 10;
            if ($_step <= 0) {
                $_step = 10;
            }
            $step = max(apply_filters('woocommerce_price_filter_widget_step', $_step), 1);

            // $min_price = isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : '';
            // $max_price = isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : '';
            // $hasPrice = ($min_price !== '' && $max_price !== '' && ($min_price >= 0 || $max_price >= $min_price)) ?
                // true : false;
            // $class_reset = $hasPrice ? '' : ' hidden-tag';

            // Find min and max price in current result set
            $prices     = elessi_get_filtered_price();
            $min        = $prices->min_price;
            $max        = $prices->max_price;
            
            $tax_display_mode = get_option('woocommerce_tax_display_shop');

            if (wc_tax_enabled() && !wc_prices_include_tax() && 'incl' === $tax_display_mode) {
                // $tax_classes = array_merge(array(''), WC_Tax::get_tax_classes());
                $tax_class = apply_filters('woocommerce_price_filter_widget_tax_class', ''); // Uses standard tax class.
                $tax_rates = WC_Tax::get_rates($tax_class);
                
                if ( $tax_rates ) {
                    $min += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax($min, $tax_rates));
                    $max += WC_Tax::get_tax_total( WC_Tax::calc_exclusive_tax($max, $tax_rates) );
                }
            }
            
            $min = apply_filters('woocommerce_price_filter_widget_min_amount', floor($min / $step) * $step);
            $max = apply_filters('woocommerce_price_filter_widget_max_amount', ceil($max / $step) * $step);
            
            // WPCS: input var ok, CSRF ok.
            $min_price = isset($_GET['min_price']) ? floor(floatval(wp_unslash($_GET['min_price'])) / $step) * $step : $min;
            $max_price = isset($_GET['max_price']) ? ceil(floatval(wp_unslash($_GET['max_price'])) / $step) * $step : $max;
            
            // $has_price = ($min_price !== '' && $max_price !== '' && ($min_price >= 0 || $max_price >= $min_price)) ? '1' : '0';
            // $class_reset = $has_price ? '' : ' hidden-tag';

            if ($min_price < $min) {
                $min = $min_price;
            }

            if ($max_price > $max) {
                $max = $max_price;
            }

            if ($min == $max) {
                echo '<div id="' . $args['widget_id'] . '-ajax-wrap" class="nasa-hide-price nasa-filter-price-widget-wrap">' .
                    $args['before_title'] . $_title . $args['after_title'] .
                '</div>';
                
                $this->current_widget_end($args);
                
                return;
            }

            /**
             * Round one more time
             */
            $data_min = floor($min);
            $data_max = ceil($max);
            
            $form_action = elessi_get_origin_url();
            $hide_btn = isset($instance['btn_filter']) && $instance['btn_filter'] ? false : true;
            
            echo '<div id="' . $args['widget_id'] . '-ajax-wrap" class="nasa-filter-price-widget-wrap">';
            
            if ($_title != '') {
                echo $args['before_title'] . $_title . $args['after_title'];
            }
            
            wc_get_template(
                'content-widget-price-filter.php',
                array(
                    'form_action'       => $form_action,
                    'step'              => $step,
                    'min_price'         => $data_min,
                    'max_price'         => $data_max,
                    'current_min_price' => $min_price,
                    'current_max_price' => $max_price,
                    'hide_btn'          => $hide_btn,
                    'nasa_widget'       => true
                )
            );
            
            echo '</div>';
            
            $this->current_widget_end($args);
        }
    }
}
