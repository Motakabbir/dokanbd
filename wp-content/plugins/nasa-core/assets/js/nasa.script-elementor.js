/**
 * Document nasa-core Elementor Preview ready
 */
jQuery(document).ready(function($) {
"use strict";

setInterval(function() {
    /**
     * Slick Slider
     */
    $('body').trigger('nasa_load_slick_slider');
    
    /**
     * loading_slick_simple_item($);
     * loading_slick_extra_vertical_thumbs($);
     */
    $('body').trigger('nasa_rendered_template');
    
    /**
     * loading Countdown
     */
    $('body').trigger('nasa_load_countdown');
    
    /**
     * loading Select2
     */
    $('body').trigger('nasa_init_select2');
    
    /**
     * Pin Banners
     */
    $('body').trigger('nasa_init_pins_banners');
    
    /**
     * Metro Products
     */
    // $('body').trigger('nasa_init_metro_products');
    // $('body').trigger('nasa_layout_metro_products');
    
    /**
     * Compare Images
     */
    $('body').trigger('nasa_init_compare_images');
    
    /**
     * Elementor Events
     */
    $('body').trigger('nasa_init_elementor_events');
}, 2000);
});
/* End Document nasa-core Elementor Preview ready */
