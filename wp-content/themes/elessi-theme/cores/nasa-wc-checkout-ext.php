<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Extended WooCommerce Checkout
 */
if (class_exists('WC_Checkout')) :

    class Elessi_WC_Checkout_Ext extends WC_Checkout {

        /**
         * The single instance of the class.
         *
         * @var Elessi_WC_Checkout_Ext|null
         */
        protected static $instance_child = null;

        /**
         * Gets the main WC_Checkout Instance.
         * 
         * @static
         * @return WC_Checkout Main instance
         */
        public static function instance_child() {
            if (is_null(self::$instance_child)) {
                self::$instance_child = new self();

                // Hook in actions once.
                add_action('woocommerce_checkout_billing', array(self::$instance_child, 'checkout_form_billing'));
                add_action('woocommerce_checkout_shipping', array(self::$instance_child, 'checkout_form_shipping'));

                // woocommerce_checkout_init action is ran once when the class is first constructed.
                do_action('woocommerce_checkout_init', self::$instance_child);
            }

            return self::$instance_child;
        }

        /**
         * Validate form checkout
         */
        public function validate_form_checkout() {
            try {
                $errors = new WP_Error();
                $posted_data = $this->get_posted_data();

                // Update session for customer and totals.
                $this->update_session($posted_data);

                // Validate posted data and cart items before proceeding.
                $this->validate_checkout_no_payment($posted_data, $errors);

                if (!empty($errors->errors)) {
                    foreach ($errors->errors as $code => $messages) {
                        $data = $errors->get_error_data($code);
                        
                        foreach ($messages as $message) {
                            wc_add_notice($message, 'error', $data);
                        }
                    }
                }
                
            } catch (Exception $e) {
                wc_add_notice($e->getMessage(), 'error');
            }

            if (wc_notice_count('error') > 0) {
                $this->send_ajax_failure_response();
            } else {
                $response = array(
                    'result' => 'success'
                );

                wp_send_json($response);
            }
        }

        /**
         * Validates that the checkout has enough info to proceed.
         *
         * @param  array    $data   An array of posted data.
         * @param  WP_Error $errors Validation errors.
         */
        protected function validate_checkout_no_payment(&$data, &$errors) {
            $this->validate_posted_data($data, $errors);
            $this->check_cart_items();

            if (WC()->cart->needs_shipping()) {
                $shipping_country = isset($data['shipping_country']) ? $data['shipping_country'] : WC()->customer->get_shipping_country();

                if (empty($shipping_country)) {
                    $errors->add('shipping', __('Please enter an address to continue.', 'elessi-theme'));
                } elseif (!in_array($shipping_country, array_keys(WC()->countries->get_shipping_countries()), true)) {
                    if (WC()->countries->country_exists($shipping_country)) {
                        /* translators: %s: shipping location (prefix e.g. 'to' + ISO 3166-1 alpha-2 country code) */
                        $errors->add('shipping', sprintf(__('Unfortunately <strong>we do not ship %s</strong>. Please enter an alternative shipping address.', 'elessi-theme'), WC()->countries->shipping_to_prefix() . ' ' . $shipping_country));
                    }
                } else {
                    $chosen_shipping_methods = WC()->session->get('chosen_shipping_methods');

                    foreach (WC()->shipping()->get_packages() as $i => $package) {
                        if (!isset($chosen_shipping_methods[$i], $package['rates'][$chosen_shipping_methods[$i]])) {
                            $errors->add('shipping', __('No shipping method has been selected. Please double check your address, or contact us if you need any help.', 'elessi-theme'));
                        }
                    }
                }
            }
            
            /**
             * Ignore validate checkbox with Germanized for WooCommerce plugin
             */
            if (class_exists('WC_GZD_Legal_Checkbox_Manager')) {
                $gzd = WC_GZD_Legal_Checkbox_Manager::instance();
                remove_action('woocommerce_after_checkout_validation', array($gzd, 'validate_checkout'), 1, 2);
            }

            /**
             * Hook after checkout validation
             */
            do_action('woocommerce_after_checkout_validation', $data, $errors);
        }

    }
    
endif;
