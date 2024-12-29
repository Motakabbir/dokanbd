<?php
add_action('init', 'elessi_product_compare_heading');
if (!function_exists('elessi_product_compare_heading')) {
    function elessi_product_compare_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => __("Compare and Wishlist", 'elessi-theme'),
            "target" => 'product-compare-wishlist',
            "type" => "heading",
        );
        
        $of_options[] = array(
            "name" => __("Compare Options", 'elessi-theme'),
            "std" => "<h4>" . __("Compare Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        global $yith_woocompare;
        if ($yith_woocompare) {
            $of_options[] = array(
                "name" => __("Layout", 'elessi-theme'),
                "id" => "nasa-product-compare",
                "std" => '1',
                "type" => "select",
                "options" => array(
                    '' => __('Default - Yith WooCommerce Compare', 'elessi-theme'),
                    '1' => __('Modern - As demo Site', 'elessi-theme'),
                ),
                'override_numberic' => true,
                // 'class' => 'nasa-theme-option-parent'
            );
            
            $of_options[] = array(
                "name" => __("Page view compare products", 'elessi-theme'),
                "id" => "nasa-page-view-compage",
                "type" => "select",
                "options" => elessi_get_pages_temp_compare(),
                // 'class' => 'nasa-nasa-product-compare nasa-nasa-product-compare-1 nasa-theme-option-child',
                'child_of' => 'nasa-product-compare',
                'm_target' => '1',
            );

            $of_options[] = array(
                "name" => __("Max products compare", 'elessi-theme'),
                "id" => "max_compare",
                "std" => "4",
                "type" => "select",
                "options" => array("2" => "2", "3" => "3", "4" => "4"),
                // 'class' => 'nasa-nasa-product-compare nasa-nasa-product-compare-1 nasa-theme-option-child',
                'child_of' => 'nasa-product-compare',
                'm_target' => '1',
            );
        } else {
            $of_options[] = array(
                "name" => __("Please Install Yith WooCommerce Compare Plugin", 'elessi-theme'),
                "std" => '<h4 style="color: red">' . __("Please, Install Yith WooCommerce Compare Plugin!", 'elessi-theme') . "</h4>",
                "type" => "info"
            );
        }
        
        /**
         * Wishlist
         */
        $of_options[] = array(
            "name" => __("Wishlist Options", 'elessi-theme'),
            "std" => "<h4>" . __("Wishlist Options", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        if (NASA_WISHLIST_ENABLE) {
            $of_options[] = array(
                "name" => __("Optimize HTML - Yith WooCommerce Wishlist", 'elessi-theme'),
                "id" => "optimize_wishlist_html",
                "std" => 1,
                "type" => "switch"
            );
        }
        
        /**
         * Nasa Wishlist
         */
        else {
            $of_options[] = array(
                "name" => __("NasaTheme Wishlist Feature", 'elessi-theme'),
                "id" => "enable_nasa_wishlist",
                "std" => 1,
                "type" => "switch"
            );
            
            $of_options[] = array(
                "name" => __("Wishlist Sidebar Layout", 'elessi-theme'),
                "id" => "style-wishlist",
                "std" => "style-1",
                "type" => "select",
                "options" => array(
                    'style-1' => __('Light', 'elessi-theme'),
                    'style-2' => __('Dark', 'elessi-theme')
                )
            );
        }
    }
}
