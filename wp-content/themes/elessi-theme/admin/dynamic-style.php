<?php
defined('ABSPATH') or die(); // Exit if accessed directly

function elessi_get_content_custom_css($nasa_opt = array()) {
    ob_start();
    ?><style><?php
    echo '@charset "UTF-8";' . "\n";
    
    /**
     * Start font style
     */
    $type_font_select = isset($nasa_opt['type_font_select']) ? $nasa_opt['type_font_select'] : '';
    
    $custom_font = isset($nasa_opt['custom_font']) ? $nasa_opt['custom_font'] : '';
    $custom_font_rtl = isset($nasa_opt['custom_font_rtl']) ? $nasa_opt['custom_font_rtl'] : '';
    
    $type_headings = isset($nasa_opt['type_headings']) ? $nasa_opt['type_headings'] : '';
    $type_texts = isset($nasa_opt['type_texts']) ? $nasa_opt['type_texts'] : '';
    $type_nav = isset($nasa_opt['type_nav']) ? $nasa_opt['type_nav'] : '';
    $type_banner = isset($nasa_opt['type_banner']) ? $nasa_opt['type_banner'] : '';
    $type_price = isset($nasa_opt['type_price']) ? $nasa_opt['type_price'] : '';
    
    $type_headings_rtl = isset($nasa_opt['type_headings_rtl']) ? $nasa_opt['type_headings_rtl'] : '';
    $type_texts_rtl = isset($nasa_opt['type_texts_rtl']) ? $nasa_opt['type_texts_rtl'] : '';
    $type_nav_rtl = isset($nasa_opt['type_nav_rtl']) ? $nasa_opt['type_nav_rtl'] : '';
    $type_banner_rtl = isset($nasa_opt['type_banner_rtl']) ? $nasa_opt['type_banner_rtl'] : '';
    $type_price_rtl = isset($nasa_opt['type_price_rtl']) ? $nasa_opt['type_price_rtl'] : '';
    
    echo elessi_get_font_style(
        $type_font_select,
        $type_headings,
        $type_texts,
        $type_nav,
        $type_banner,
        $type_price,
        $custom_font
    );
    
    echo elessi_get_font_style_rtl(
        $type_font_select,
        $type_headings_rtl,
        $type_texts_rtl,
        $type_nav_rtl,
        $type_banner_rtl,
        $type_price_rtl,
        $custom_font_rtl
    );
    
    // End font style
    if (isset($nasa_opt['logo_height']) && (int) $nasa_opt['logo_height']) :
        ?>
            body .logo .header_logo
            {
                height: <?php echo (int) $nasa_opt['logo_height'] . 'px'; ?>;
            }
        <?php
    endif;
    
    if (isset($nasa_opt['logo_width']) && (int) $nasa_opt['logo_width']) :
        ?>
            body .logo .header_logo
            {
                width: <?php echo (int) $nasa_opt['logo_width'] . 'px'; ?>;
            }
        <?php
    else :
        ?>
            body .logo .header_logo
            {
                width: auto;
            }
        <?php
    endif;
    
    if (isset($nasa_opt['logo_height_mobile']) && (int) $nasa_opt['logo_height_mobile']) :
        ?>
            body .mobile-menu .logo .header_logo,
            body .fixed-already .mobile-menu .logo .header_logo,
            body .nasa-login-register-warper #nasa-login-register-form .nasa-form-logo-log .header_logo,
            body .nasa-header-mobile-layout .logo .header_logo,
            body #mobile-navigation .menu-item-heading a.logo .header_logo
            {
                height: <?php echo (int) $nasa_opt['logo_height_mobile'] . 'px'; ?>;
            }
        <?php
    endif;
    
    if (isset($nasa_opt['logo_width_mobile']) && (int) $nasa_opt['logo_width_mobile']) :
        ?>
            body .mobile-menu .logo .header_logo,
            body .fixed-already .mobile-menu .logo .header_logo,
            body .nasa-login-register-warper #nasa-login-register-form .nasa-form-logo-log .header_logo,
            body .nasa-header-mobile-layout .logo .header_logo,
            body #mobile-navigation .menu-item-heading a.logo .header_logo
            {
                width: <?php echo (int) $nasa_opt['logo_width_mobile'] . 'px'; ?>;
            }
        <?php
    else :
        ?>
            body .mobile-menu .logo .header_logo,
            body .fixed-already .mobile-menu .logo .header_logo,
            body .nasa-login-register-warper #nasa-login-register-form .nasa-form-logo-log .header_logo,
            body .nasa-header-mobile-layout .logo .header_logo,
            body #mobile-navigation .menu-item-heading a.logo .header_logo
            {
                width: auto;
            }
        <?php
    endif;
    
    if (isset($nasa_opt['logo_sticky_height']) && (int) $nasa_opt['logo_sticky_height']) :
        ?>
            body .fixed-already .logo .header_logo
            {
                height: <?php echo (int) $nasa_opt['logo_sticky_height'] . 'px'; ?>;
            }
        <?php
    endif;
    
    if (isset($nasa_opt['logo_sticky_width']) && (int) $nasa_opt['logo_sticky_width']) :
        ?>
            body .fixed-already .logo .header_logo
            {
                width: <?php echo (int) $nasa_opt['logo_sticky_width'] . 'px'; ?>;
            }
        <?php
        
    else :
        ?>
            body .fixed-already .logo .header_logo
            {
                width: auto;
            }
        <?php
    endif;

    if (isset($nasa_opt['max_height_logo']) && (int) $nasa_opt['max_height_logo']) :
        ?>
            body .logo .header_logo
            {
                max-height: <?php echo (int) $nasa_opt['max_height_logo'] . 'px'; ?>;
            }
        <?php
    endif;
    
    if (isset($nasa_opt['max_height_mobile_logo']) && (int) $nasa_opt['max_height_mobile_logo']) :
        ?>
            body .mobile-menu .logo .header_logo,
            body .fixed-already .mobile-menu .logo .header_logo,
            body .nasa-login-register-warper #nasa-login-register-form .nasa-form-logo-log .header_logo,
            body .nasa-header-mobile-layout .logo .header_logo,
            body #mobile-navigation .menu-item-heading a.logo .header_logo
            {
                max-height: <?php echo (int) $nasa_opt['max_height_mobile_logo'] . 'px'; ?>;
            }
        <?php
    endif;
    
    if (isset($nasa_opt['max_height_sticky_logo']) && (int) $nasa_opt['max_height_sticky_logo']) :
        ?>
            body .fixed-already .logo .header_logo
            {
                max-height: <?php echo (int) $nasa_opt['max_height_sticky_logo'] . 'px'; ?>;
            }
        <?php
    endif;

    if (isset($nasa_opt['site_layout']) && $nasa_opt['site_layout'] == 'boxed') :
        $nasa_opt['site_bg_image'] = isset($nasa_opt['site_bg_image']) && $nasa_opt['site_bg_image'] ? str_replace(
            array(
                '[site_url]',
                '[site_url_secure]',
            ), array(
                site_url('', 'http'),
                site_url('', 'https'),
            ), $nasa_opt['site_bg_image']
        ) : false;
        ?> 
            body.boxed,
            body
            {
            <?php if ($nasa_opt['site_bg_color']) : ?>
                background-color: <?php echo esc_attr($nasa_opt['site_bg_color']); ?>;
            <?php endif; ?>
            <?php if ($nasa_opt['site_bg_image']) : ?>
                background-image: url("<?php echo esc_url(elessi_remove_protocol($nasa_opt['site_bg_image'])); ?>");
                background-attachment: fixed;
            <?php endif; ?>
            }
        <?php
    endif;
    
    // $font_size = isset($nasa_opt['font_size']) ? $nasa_opt['font_size'] : '';
    // $font_size_m = isset($nasa_opt['font_size_m']) ? $nasa_opt['font_size_m'] : '';
    
    /* Main Menu Font size */
    if (isset($nasa_opt['font_size_menu']) && absint($nasa_opt['font_size_menu']) != 100) :
        ?>
            #site-navigation,
            #nasa-menu-vertical-header
            {
                font-size: <?php echo absint($nasa_opt['font_size_menu']); ?>%;
            }
        <?php
    endif;
    
    /* Body Font size */
    if (isset($nasa_opt['font_size']) && absint($nasa_opt['font_size']) != '14.5') :
        ?>
            html body
            {
                font-size: <?php echo $nasa_opt['font_size']; ?>px;
            }
        <?php
    endif;
    
    /* Body Font size - Mobile */
    if (isset($nasa_opt['font_size_m']) && absint($nasa_opt['font_size_m']) != '14.5') :
        ?>
            @media only screen and (max-width: 767px) {
                html body
                {
                    font-size: <?php echo $nasa_opt['font_size_m']; ?>px;
                }
            }
        <?php
    endif;

    /* time countdown fake purchase */
    if (isset($nasa_opt['time_fake_purchase']) && (int) $nasa_opt['time_fake_purchase']) :
        ?>
            .ns-sale-notification .ns-time-countdown {
                animation-duration: <?php echo (int) $nasa_opt['time_fake_purchase']?>ms;
            }
        <?php
    endif;

    /* COLOR PRIMARY */
    if (isset($nasa_opt['color_primary'])) :
        echo elessi_get_style_primary_color($nasa_opt['color_primary']);
    endif;

    /* COLOR SUCCESS */
    if (isset($nasa_opt['color_success']) && $nasa_opt['color_success'] != '') :
        ?> 
            <?php /* .woocommerce-message
            {
                color: #FFF !important;
                background-color: <?php echo esc_attr($nasa_opt['color_success']); ?> !important;
            } */ ?>
            body .woocommerce-notices-wrapper .woocommerce-message,
            body .nasa-compare-list-bottom .nasa-compare-mess,
            body .page-shopping-cart .woocommerce-notices-wrapper .woocommerce-info:not(.cart-empty),
            body .page-shopping-cart .woocommerce-message:not(.cart-empty)
            {
                border-color: <?php echo esc_attr($nasa_opt['color_success']); ?>;
            }
            .added .nasa-icon,
            .nasa-added .nasa-icon
            {
                color: <?php echo esc_attr($nasa_opt['color_success']); ?> !important;
            }
            body #nasa-content-ask-a-quetion div.wpcf7-response-output.wpcf7-mail-sent-ok,
            body .woocommerce-notices-wrapper .woocommerce-info:not(.cart-empty) a.restore-item,
            body .woocommerce-message:not(.cart-empty) a.restore-item,
            body #yith-wcwl-message:not(.cart-empty) a.restore-item,
            body .page-shopping-cart .woocommerce-notices-wrapper .woocommerce-info:not(.cart-empty):before,
            body .page-shopping-cart .woocommerce-message:not(.cart-empty):before,
            body #nasa-login-register-form .nasa-message.nasa-congrat .svg-login-succes
            {
                color: <?php echo esc_attr($nasa_opt['color_success']); ?>;
            }
            body #yith-wcwl-popup-message #yith-wcwl-message
            {
                background-color: <?php echo esc_attr($nasa_opt['color_success']); ?>;
            }
        <?php
    endif;

    /* COLOR SALE */
    if (isset($nasa_opt['color_sale_label']) && $nasa_opt['color_sale_label'] != '') :
        ?>
            body .badge.sale-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_sale_label']); ?>;
            }
        <?php
    endif;

    /* COLOR HOT */
    if (isset($nasa_opt['color_hot_label']) && $nasa_opt['color_hot_label'] != '') :
        ?>
            body .badge.hot-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_hot_label']); ?>;
            }
        <?php
    endif;
    
    /* COLOR Featured */
    if (isset($nasa_opt['color_featured_label']) && $nasa_opt['color_featured_label'] != '') :
        ?>
            body .badge.featured-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_featured_label']); ?>;
            }
        <?php
    endif;
    
    /* COLOR New */
    if (isset($nasa_opt['color_new_label']) && $nasa_opt['color_new_label'] != '') :
        ?>
            body .badge.new-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_new_label']); ?>;
            }
        <?php
    endif;
    
    /* COLOR Backorders */
    if (isset($nasa_opt['color_backorders_label']) && $nasa_opt['color_backorders_label'] != '') :
        ?>
            body .badge.backorders-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_backorders_label']); ?>;
            }
        <?php
    endif;
    
    /* COLOR Bulk Discount */
    if (isset($nasa_opt['color_bulk_label']) && $nasa_opt['color_bulk_label'] != '') :
        ?>
            body .badge.bulk-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_bulk_label']); ?>;
            }
        <?php
    endif;
    
    /* COLOR VIDEO */
    if (isset($nasa_opt['color_video_label']) && $nasa_opt['color_video_label'] != '') :
        ?>
            body .badge.video-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_video_label']); ?>;
            }
        <?php
    endif;
    
    /* COLOR 360 */
    if (isset($nasa_opt['color_360_label']) && $nasa_opt['color_360_label'] != '') :
        ?>
            body .badge.b360-label
            {
                background-color: <?php echo esc_attr($nasa_opt['color_360_label']); ?>;
            }
        <?php
    endif;
    
    /* COLOR DEAL */
    if (isset($nasa_opt['color_deal_label']) && $nasa_opt['color_deal_label'] != '') :
        ?>
        body .badge.deal-label
        {
            background-color: <?php echo esc_attr($nasa_opt['color_deal_label']); ?>;
        }
        <?php
    endif;
    
    /* COLOR SALE */
    if (isset($nasa_opt['color_variants_label']) && $nasa_opt['color_variants_label'] != '') :
        ?>
            body .badge.nasa-variants
            {
                background-color: <?php echo esc_attr($nasa_opt['color_variants_label']); ?>;
            }
        <?php
    endif;

    /* COLOR PRICE */
    if (isset($nasa_opt['color_price_label']) && $nasa_opt['color_price_label'] != '') :
        ?>
        body .product-price, 
        body .price.nasa-sc-p-price,
        body .price,
        body .product-item .info .price,
        body .item-product-widget .product-meta .price,
        html body .nasa-after-add-to-cart-subtotal-price,
        html body .nasa-total-condition-desc .woocommerce-Price-amount,
        html body .woocommerce-table--order-details tfoot tr:last-child td > .amount
        {
            color: <?php echo esc_attr($nasa_opt['color_price_label']); ?>;
        }
        <?php
    endif;

    /* COLOR BUTTON */
    if (isset($nasa_opt['color_button']) && $nasa_opt['color_button'] != '') :
        ?>
            form.cart .button,
            .checkout-button,
            input#place_order,
            .btn-viewcart,
            input#submit,
            input[type="submit"],
            .add_to_cart,
            button,
            .button:not(.add-to-cart-grid),
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout,
            html body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout,
            .dokan-btn,
            .dokan-btn-theme,
            #dokan-store-listing-filter-form-wrap .apply-filter #apply-filter-btn,
            .nasa-search-all,
            .nasa-modern-2 .product-item .add-to-cart-grid,
            .nasa-modern-6 .product-item .add-to-cart-grid,
            .nasa-modern-7 .product-item .add-to-cart-grid
            {
                background-color: <?php echo esc_attr($nasa_opt['color_button']); ?> !important;
            }
        <?php
    endif;

    /* COLOR HOVER */
    if (isset($nasa_opt['color_hover']) && $nasa_opt['color_hover'] != '') :
        ?>
            form.cart .button:hover,
            .form-submit input:hover,
            #payment .place-order input:hover,
            input#submit:hover,
            input[type="submit"]:hover,
            .product-list .product-img .quick-view.fa-search:hover,
            .footer-type-2 input.button,
            button:hover,
            .button:not(.add-to-cart-grid):hover,
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            html body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            body .button:hover,
            body a.button:hover,
            .checkout-button:hover,
            input#place_order:hover,
            .btn-viewcart:hover,
            input#submit:hover,
            .add_to_cart:hover,
            .nasa-search-all:hover,
            .nasa-modern-2 .product-item .add-to-cart-grid:hover,
            .nasa-modern-6 .product-item .add-to-cart-grid:hover,
            .nasa-modern-7 .product-item .add-to-cart-grid:hover
            {
                background-color: <?php echo esc_attr($nasa_opt['color_hover']); ?>!important;
            }
            .nasa-single-btn-clone .single_add_to_cart_button.loading {
                color: transparent!important;
            }
        <?php
    endif;

    /* COLOR BORDER BUTTON ============================================================== */
    if (isset($nasa_opt['button_border_color']) && $nasa_opt['button_border_color'] != '') :
        ?>
            #submit,
            button,
            .button:not(.add-to-cart-grid),
            input[type="submit"],
            .widget.woocommerce li.nasa-li-filter-size a,
            .widget.widget_categories li.nasa-li-filter-size a,
            .widget.widget_archive li.nasa-li-filter-size a,
            .nasa-search-all,
            .nasa-modern-2 .product-item .add-to-cart-grid,
            .nasa-modern-6 .product-item .add-to-cart-grid,
            .nasa-modern-7 .product-item .add-to-cart-grid,
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout,
            html body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout
            {
                border-color: <?php echo esc_attr($nasa_opt['button_border_color']); ?> !important;
            }
            body .group-btn-in-list .add-to-cart-grid .add_to_cart_text,
            html body input[type="submit"].dokan-btn,
            html body a.dokan-btn,
            html body .dokan-btn,
            html body #dokan-store-listing-filter-form-wrap .apply-filter #apply-filter-btn,
            body input[type="submit"].dokan-btn-theme,
            body a.dokan-btn-theme,
            body .dokan-btn-theme
            {
                border-color: <?php echo esc_attr($nasa_opt['button_border_color']); ?>;
            }
        <?php
    endif;

    /* COLOR BORDER BUTTON HOVER */
    if (isset($nasa_opt['button_border_color_hover']) && $nasa_opt['button_border_color_hover'] != '') :
        ?>
            #submit:hover, 
            button:hover, 
            .button:not(.add-to-cart-grid):hover,
            input[type="submit"]:hover,
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            html body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            body .button:hover,
            body a.button:hover,
            .widget.woocommerce li.nasa-li-filter-size.chosen a,
            .widget.woocommerce li.nasa-li-filter-size.nasa-chosen a,
            .widget.woocommerce li.nasa-li-filter-size:hover a,
            .widget.widget_categories li.nasa-li-filter-size.chosen a,
            .widget.widget_categories li.nasa-li-filter-size.nasa-chosen a,
            .widget.widget_categories li.nasa-li-filter-size:hover a,
            .widget.widget_archive li.nasa-li-filter-size.chosen a,
            .widget.widget_archive li.nasa-li-filter-size.nasa-chosen a,
            .widget.widget_archive li.nasa-li-filter-size:hover a,
            .nasa-search-all:hover,
            .nasa-modern-2 .product-item .add-to-cart-grid:hover,
            .nasa-modern-6 .product-item .add-to-cart-grid:hover,
            .nasa-modern-7 .product-item .add-to-cart-grid:hover
            {
                border-color: <?php echo esc_attr($nasa_opt['button_border_color_hover']); ?> !important;
            }
            body .group-btn-in-list add-to-cart-grid:hover .add_to_cart_text,
            html body input[type="submit"].dokan-btn:hover,
            html body a.dokan-btn:hover,
            html body .dokan-btn:hover,
            html body #dokan-store-listing-filter-form-wrap .apply-filter #apply-filter-btn,
            body input[type="submit"].dokan-btn-theme:hover,
            body a.dokan-btn-theme:hover,
            body .dokan-btn-theme:hover
            {
                border-color: <?php echo esc_attr($nasa_opt['button_border_color_hover']); ?>;
            }
        <?php
    endif;

    /* COLOR TEXT BUTTON */
    if (isset($nasa_opt['button_text_color']) && $nasa_opt['button_text_color'] != '') :
        ?>
            #submit,
            button,
            .button:not(.add-to-cart-grid),
            input[type="submit"],
            body input[type="submit"].dokan-btn,
            body a.dokan-btn,
            body .dokan-btn,
            html body #dokan-store-listing-filter-form-wrap .apply-filter #apply-filter-btn,
            body input[type="submit"].dokan-btn-theme,
            body a.dokan-btn-theme,
            body .dokan-btn-theme,
            .nasa-search-all,
            .nasa-modern-2 .product-item .add-to-cart-grid .add_to_cart_text,
            .nasa-modern-6 .product-item .add-to-cart-grid .add_to_cart_text,
            .nasa-modern-7 .product-item .add-to-cart-grid .add_to_cart_text,
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout,
            html body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout
            {
                color: <?php echo esc_attr($nasa_opt['button_text_color']); ?> !important;
            }
        <?php
    endif;

    /* COLOR HOVER TEXT BUTTON */
    if (isset($nasa_opt['button_text_color_hover']) && $nasa_opt['button_text_color_hover'] != '') :
        ?>
            #submit:hover,
            button:hover,
            .button:not(.add-to-cart-grid):hover,
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            html body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            input[type="submit"]:hover,
            .nasa-search-all:hover,
            .nasa-modern-2 .product-item .add-to-cart-grid:hover .add_to_cart_text,
            .nasa-modern-6 .product-item .add-to-cart-grid:hover .add_to_cart_text,
            .nasa-modern-7 .product-item .add-to-cart-grid:hover .add_to_cart_text
            {
                color: <?php echo esc_attr($nasa_opt['button_text_color_hover']); ?> !important;
            }
            html body input[type="submit"].dokan-btn:hover,
            html body a.dokan-btn:hover,
            html body .dokan-btn:hover,
            html body #dokan-store-listing-filter-form-wrap .apply-filter #apply-filter-btn:hover,
            body input[type="submit"].dokan-btn-theme:hover,
            body a.dokan-btn-theme:hover,
            body .dokan-btn-theme:hover
            {
                color: <?php echo esc_attr($nasa_opt['button_text_color_hover']); ?>;
            }
        <?php
    endif;

    if (isset($nasa_opt['button_radius'])) :
        ?>
            body .product-item .product-deal-special-buttons .nasa-product-grid .add-to-cart-grid,
            body .wishlist_table .add_to_cart,
            body .yith-wcwl-add-button > a.button.alt,
            body #submit,
            body #submit.disabled,
            body #submit[disabled],
            body button,
            body button.disabled,
            body button[disabled],
            body .button:not(.add-to-cart-grid),
            body .button.disabled,
            body .button[disabled],
            body input[type="submit"],
            body input[type="submit"].disabled,
            body input[type="submit"][disabled],
            html body input[type="submit"].dokan-btn,
            html body a.dokan-btn,
            html body .dokan-btn,
            html body #dokan-store-listing-filter-form-wrap .apply-filter #apply-filter-btn,
            body .nasa-search-all,
            body input[type="submit"].dokan-btn-theme,
            body a.dokan-btn-theme,
            body .dokan-btn-theme,
            body .nasa-modern-2 .product-item .add-to-cart-grid,
            body .nasa-modern-6 .product-item .add-to-cart-grid,
            body .nasa-modern-7 .product-item .add-to-cart-grid,
            body .group-btn-in-list .add-to-cart-grid .add_to_cart_text
            {
                border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px;
                -webkit-border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px;
                -o-border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px;
                -moz-border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px;
            }
            body .coupon .button[name=apply_coupon] {
                border-radius: 0 <?php echo (int) $nasa_opt['button_radius']; ?>px <?php echo (int) $nasa_opt['button_radius']; ?>px 0;
                -webkit-border-radius: 0 <?php echo (int) $nasa_opt['button_radius']; ?>px <?php echo (int) $nasa_opt['button_radius']; ?>px 0;
                -o-border-radius: 0 <?php echo (int) $nasa_opt['button_radius']; ?>px <?php echo (int) $nasa_opt['button_radius']; ?>px 0;
                -moz-border-radius: 0 <?php echo (int) $nasa_opt['button_radius']; ?>px <?php echo (int) $nasa_opt['button_radius']; ?>px 0;
            }
            body.nasa-rtl .coupon .button[name=apply_coupon] {
                border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['button_radius']; ?>px;
                -webkit-border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['button_radius']; ?>px;
                -o-border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['button_radius']; ?>px;
                -moz-border-radius: <?php echo (int) $nasa_opt['button_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['button_radius']; ?>px;
            }
        <?php
    endif;

    if (isset($nasa_opt['button_border']) && (int) $nasa_opt['button_border'] > 1) :
        ?>
            body #submit,
            body button,
            body .button:not(.add-to-cart-grid),
            body input[type="submit"],
            html body input[type="submit"].dokan-btn,
            html body a.dokan-btn,
            html body .dokan-btn,
            html body #dokan-store-listing-filter-form-wrap .apply-filter #apply-filter-btn,
            body .nasa-search-all,
            body input[type="submit"].dokan-btn-theme,
            body a.dokan-btn-theme,
            body .dokan-btn-theme,
            body .nasa-modern-2 .product-item .add-to-cart-grid,
            body .nasa-modern-6 .product-item .add-to-cart-grid,
            body .nasa-modern-7 .product-item .add-to-cart-grid
            {
                border-width: <?php echo (int) $nasa_opt['button_border']; ?>px;
            }
        <?php
    endif;

    if (isset($nasa_opt['input_radius'])) :
        ?>
            body textarea,
            body select,
            body input[type="text"],
            body input[type="password"],
            body input[type="date"], 
            body input[type="datetime"],
            body input[type="datetime-local"],
            body input[type="month"],
            body input[type="week"],
            body input[type="email"],
            body input[type="number"],
            body input[type="search"],
            body input[type="tel"],
            body input[type="time"],
            body input[type="url"],
            body .category-page .sort-bar .select-wrapper,
            body form .select2-container--default .select2-selection--single,
            body #review_form_wrapper .comment-form .nasa-form-media
            {
                border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -webkit-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -o-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -moz-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px;
            }
            body .quantity .input-text.qty
            {
                border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -webkit-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -o-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -moz-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px;
            }
            body .qnot.quantity .input-text.qty
            {
                border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -webkit-border-radius:<?php echo (int) $nasa_opt['input_radius']; ?>px;
                -o-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px;
                -moz-border-radius: <?php echo (int) $nasa_opt['input_radius']; ?>px;
            }
            .quantity .plus
            {
                border-radius: 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0;
                -webkit-border-radius: 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0;
                -o-border-radius: 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0;
                -moz-border-radius: 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0 0;
            }
            .quantity .minus
            {
                border-radius: 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0;
                -webkit-border-radius: 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0;
                -o-border-radius: 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0;
                -moz-border-radius: 0 0 <?php echo (int) $nasa_opt['input_radius']; ?>px 0;
            }
        <?php
    endif;
    
    /* BG COLOR BUTTON BUY NOW */
    if (isset($nasa_opt['buy_now_bg_color']) && $nasa_opt['buy_now_bg_color'] != '') :
        ?>
            body .nasa-buy-now,
            body .ns_btn-fixed .button.nasa-buy-now
            {
                background-color: <?php echo esc_attr($nasa_opt['buy_now_bg_color']); ?> !important;
                border-color: <?php echo esc_attr($nasa_opt['buy_now_bg_color']); ?> !important;
            }
        <?php
    endif;
    
    /* BG COLOR BUTTON HOVER BUY NOW */
    if (isset($nasa_opt['buy_now_bg_color_hover']) && $nasa_opt['buy_now_bg_color_hover'] != '') :
        ?>
            body .nasa-buy-now:hover,
            body .ns_btn-fixed .button.nasa-buy-now:hover
            {
                background-color: <?php echo esc_attr($nasa_opt['buy_now_bg_color_hover']); ?> !important;
                border-color: <?php echo esc_attr($nasa_opt['buy_now_bg_color_hover']); ?> !important;
            }
        <?php
    endif;
    
    /* BG COLOR BUTTON HOVER BUY NOW */
    if (isset($nasa_opt['sp_bgl']) && $nasa_opt['sp_bgl'] != '') :
        ?>
            .single-product.nasa-spl-modern-2 .site-header,
            .single-product.nasa-spl-modern-3 .site-header,
            .single-product.nasa-spl-modern-4 .site-header,
            .single-product.nasa-spl-modern-2 .nasa-breadcrumb,
            .single-product.nasa-spl-modern-3 .nasa-breadcrumb,
            .single-product.nasa-spl-modern-4 .nasa-breadcrumb
            {
                background-color: <?php echo esc_attr($nasa_opt['sp_bgl']); ?>;
            }

            @media only screen and (min-width: 768px) {
                body .nasa-product-details-page.nasa-layout-new-3 .nasa-product-details-wrap:not(.is-tab-small-accordion)
                {
                    background-color: <?php echo esc_attr($nasa_opt['sp_bgl']); ?>;
                    -webkit-box-shadow: 0 0 0 100vmax <?php echo esc_attr($nasa_opt['sp_bgl']); ?>;
                    -moz-box-shadow: 0 0 0 100vmax <?php echo esc_attr($nasa_opt['sp_bgl']); ?>;
                    box-shadow: 0 0 0 100vmax <?php echo esc_attr($nasa_opt['sp_bgl']); ?>;
                }
            }
        <?php
    endif;
    
    /* BG COLOR PROMOTION */
    if (isset($nasa_opt['bg_promotion']) && $nasa_opt['bg_promotion'] != '') :
        ?>
            body .nasa-content-promotion-news
            {
                background-color: <?php echo esc_attr($nasa_opt['bg_promotion']); ?>;
            }
        <?php
    endif;
    
    /**
     * Color of header
     */
    $bg_color = (isset($nasa_opt['bg_color_header']) && $nasa_opt['bg_color_header']) ? $nasa_opt['bg_color_header'] : '';
    $bg_color_stk = (isset($nasa_opt['bg_color_header']) && $nasa_opt['bg_color_header_stk']) ? $nasa_opt['bg_color_header_stk'] : '';
    $text_color = (isset($nasa_opt['text_color_header']) && $nasa_opt['text_color_header']) ? $nasa_opt['text_color_header'] : '';
    $text_color_stk = (isset($nasa_opt['text_color_header_stk']) && $nasa_opt['text_color_header_stk']) ? $nasa_opt['text_color_header_stk'] : '';
    $text_color_hover = (isset($nasa_opt['text_color_hover_header']) && $nasa_opt['text_color_hover_header']) ? $nasa_opt['text_color_hover_header'] : '';
    $text_color_hover_stk = (isset($nasa_opt['text_color_hover_header_stk']) && $nasa_opt['text_color_hover_header_stk']) ? $nasa_opt['text_color_hover_header_stk'] : '';

    echo elessi_get_style_header_color($bg_color, $text_color, $text_color_hover, $bg_color_stk, $text_color_stk, $text_color_hover_stk);

    /**
     * Color of main menu
     */
    $bg_color = isset($nasa_opt['bg_color_main_menu']) ? $nasa_opt['bg_color_main_menu'] : '';
    $bg_color_stk = isset($nasa_opt['bg_color_main_menu_stk']) ? $nasa_opt['bg_color_main_menu_stk'] : '';
    $text_color = (isset($nasa_opt['text_color_main_menu']) && $nasa_opt['text_color_main_menu']) ? $nasa_opt['text_color_main_menu'] : '';
    $text_color_stk = (isset($nasa_opt['text_color_main_menu_stk']) && $nasa_opt['text_color_main_menu_stk']) ? $nasa_opt['text_color_main_menu_stk'] : '';
    // $text_color_hover = (isset($nasa_opt['text_color_hover_main_menu']) && $nasa_opt['text_color_hover_main_menu']) ? $nasa_opt['text_color_hover_main_menu'] : '';
    // $text_color_hover_stk = (isset($nasa_opt['text_color_hover_main_menu_stk']) && $nasa_opt['text_color_hover_main_menu_stk']) ? $nasa_opt['text_color_hover_main_menu_stk'] : '';

    echo elessi_get_style_main_menu_color($bg_color, $text_color, $bg_color_stk, $text_color_stk);
    
    /**
     * Color of vertical menu
     */
    $bg_color = isset($nasa_opt['bg_color_v_menu']) ? $nasa_opt['bg_color_v_menu'] : '';
    $bg_color_stk = isset($nasa_opt['bg_color_v_menu_stk']) ? $nasa_opt['bg_color_v_menu_stk'] : '';
    $text_color = (isset($nasa_opt['text_color_v_menu']) && $nasa_opt['text_color_v_menu']) ? $nasa_opt['text_color_v_menu'] : '';
    $text_color_stk = (isset($nasa_opt['text_color_v_menu_stk']) && $nasa_opt['text_color_v_menu_stk']) ? $nasa_opt['text_color_v_menu_stk'] : '';

    echo elessi_get_style_vertical_menu_color($bg_color, $text_color, $bg_color_stk, $text_color_stk);

    /**
     * Color of Top bar
     */
    if (!isset($nasa_opt['topbar_show']) || $nasa_opt['topbar_show']) {
        $bg_color = (isset($nasa_opt['bg_color_topbar']) && $nasa_opt['bg_color_topbar']) ? $nasa_opt['bg_color_topbar'] : '';
        $text_color = (isset($nasa_opt['text_color_topbar']) && $nasa_opt['text_color_topbar']) ? $nasa_opt['text_color_topbar'] : '';
        $text_color_hover = (isset($nasa_opt['text_color_hover_topbar']) && $nasa_opt['text_color_hover_topbar']) ? $nasa_opt['text_color_hover_topbar'] : '';

        echo elessi_get_style_topbar_color($bg_color, $text_color, $text_color_hover);
    }

    /**
     * Add width to site
     */
    if (isset($nasa_opt['plus_wide_width']) && (int) $nasa_opt['plus_wide_width'] > 0) :
        global $content_width;
        $content_width = !isset($content_width) ? 1200 : $content_width;
        $max_width = ($content_width + (int) $nasa_opt['plus_wide_width']);
        
        echo elessi_get_style_plus_wide_width($max_width);
    endif;
    
    /**
     * Promo Popup
     */
    if (isset($nasa_opt['promo_popup']) && $nasa_opt['promo_popup']) :
        $width = (isset($nasa_opt['pp_width']) && $nasa_opt['pp_width'])? (int) $nasa_opt['pp_width']: 724;
        ?>
            #nasa-popup
            {
                width: <?php echo($width)?>px;
                background-color: <?php echo isset($nasa_opt['pp_background_color']) ? esc_url($nasa_opt['pp_background_color']) : 'transparent' ?>;
                background-repeat: no-repeat;
                background-size: auto;
            }

            #nasa-popup,
            #nasa-popup .nasa-popup-wrap
            {
                height: <?php echo isset($nasa_opt['pp_height']) ? (int) $nasa_opt['pp_height'] : 501; ?>px;
            }
            .nasa-pp-left
            {
                min-height: 1px;
            }
        <?php
    endif;

    if (isset($nasa_opt['ns_popup_exit_intent']) && $nasa_opt['ns_popup_exit_intent']) :
        if (isset($nasa_opt['ns_popup_exit_intent_ct']) && $nasa_opt['ns_popup_exit_intent_ct'] !== 'default'):
            $width = (isset($nasa_opt['pp_ex_width']) && $nasa_opt['pp_ex_width'])? (int) $nasa_opt['pp_ex_width']: 900;
            ?>
                .nasa-popup-exit-intent-wrap {
                    width: <?php echo($width)?>px;
                    background-color: <?php echo isset($nasa_opt['pp_exit_background_color']) ? esc_url($nasa_opt['pp_exit_background_color']) : '#fff' ?>;
                }

            <?php
        endif;
    endif;

    if (isset($nasa_opt['pre_option_nasa_hide_out_of_stock_items']) && $nasa_opt['pre_option_nasa_hide_out_of_stock_items']) :
        ?>
            .nasa-attr-ux.nasa-disable,
            .nasa-attr-ux-item.nasa-disable {
                    display: none !important;
            }
        <?php
    endif;
    
    ?></style><?php
    $css = ob_get_clean();
    
    return elessi_convert_css($css);
}
