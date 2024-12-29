<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * CSS override PRIMARY color
 */
if (!function_exists('elessi_get_style_primary_color')) :

    function elessi_get_style_primary_color($color_primary = '', $return = true) {
        if (trim($color_primary) == '') {
            return '';
        }
        
        $color_primary_darken = elessi_pattern_color($color_primary, -0.08);
        
        if ($return) {
            ob_start();
        }
        ?><style>
            /* Start override primary color */
            body .primary-color,
            body a:hover,
            body p a:hover,
            body .add-to-cart-grid .cart-icon strong,
            body .navigation-paging a,
            body .navigation-image a,
            body .logo a,
            body li.mini-cart .cart-icon strong,
            body .mini-cart-item .cart_list_product_price,
            body .remove:hover i,
            body .support-icon,
            body .shop_table.cart td.product-name a:hover,
            body #order_review .cart-subtotal .woocommerce-Price-amount,
            body #order_review .order-total .woocommerce-Price-amount,
            body #order_review .woocommerce-shipping-totals .woocommerce-Price-amount,
            body .cart_totals .order-total td,
            body a.shipping-calculator-button:hover,
            body .widget_layered_nav li a:hover,
            body .widget_layered_nav_filters li a:hover,
            body .copyright-footer span,
            body #menu-shop-by-category li.active.menu-parent-item .nav-top-link::after,
            body .nasa-breadcrumb.nasa-breadcrumb-has-bg .row .breadcrumb-row a:hover,
            body .nasa-breadcrumb.nasa-breadcrumb-has-bg .columns .breadcrumb-row a:hover,
            body .group-blogs .blog_info .post-date span,
            body .header-type-1 .header-nav .nav-top-link:hover,
            body .widget_layered_nav li:hover a,
            body .widget_layered_nav_filters li:hover a,
            body .remove .pe-7s-close:hover,
            body .absolute-footer .left .copyright-footer span,
            body .service-block .box .title .icon,
            body .service-block.style-3 .box .service-icon,
            body .service-block.style-2 .service-icon,
            body .service-block.style-1 .service-icon,
            body .contact-information .contact-text strong,
            body .nav-wrapper .root-item a:hover,
            body .group-blogs .blog_info .read_more a:hover,
            body #top-bar .top-bar-nav li.color a,
            body .mini-cart .cart-icon:hover:before,
            body .absolute-footer li a:hover,
            body .nasa-recent-posts li .post-date,
            body .nasa-recent-posts .read-more a,
            body .shop_table .remove-product .pe-7s-close:hover,
            body .absolute-footer ul.menu li a:hover,
            body .nasa-pagination.style-1 .page-number li span.current,
            body .nasa-pagination.style-1 .page-number li a.current,
            body .nasa-pagination.style-1 .page-number li a.nasa-current,
            body .nasa-pagination.style-1 .page-number li a:hover,
            body #vertical-menu-wrapper li.root-item:hover > a,
            body .widget.woocommerce li.cat-item a.nasa-active,
            body .widget.widget_recent_entries ul li a:hover,
            body .widget.widget_recent_comments ul li a:hover,
            body .widget.widget_meta ul li a:hover,
            body .widget.widget_categories li a.nasa-active,
            body .widget.widget_archive li a.nasa-active,
            body .nasa-filter-by-cat.nasa-active,
            body .product-info .stock.in-stock,
            body #nasa-footer .nasa-contact-footer-custom h5,
            body #nasa-footer .nasa-contact-footer-custom h5 i,
            body .group-blogs .nasa-blog-info-slider .nasa-post-date,
            body li.menu-item.nasa-megamenu > .nav-dropdown > ul > li.menu-item a:hover,
            body .nasa-tag-cloud a.nasa-active:hover,
            body .html-text i,
            body .save-note i,
            body .header-nav .active .nav-top-link,
            body ul li .nav-dropdown > ul > li:hover > a,
            body ul li .nav-dropdown > ul > li:hover > a:before,
            body ul li .nav-dropdown > ul > li .nav-column-links > ul > li a:hover,
            body ul li .nav-dropdown > ul > li .nav-column-links > ul > li:hover > a:before,
            body .topbar-menu-container > ul > li > a:hover,
            html body.nasa-dark .topbar-menu-container .header-multi-languages li ul li a:hover,
            body .header-account ul li a:hover,
            body .header-icons > li a:hover i,
            body .header-icons > li a:hover .icon-text,
            body .nasa-title span.nasa-first-word,
            body .nasa-sc-pdeal.nasa-sc-pdeal-block .nasa-sc-p-img .images-popups-gallery a.product-image .nasa-product-label-stock .label-stock,
            body .nasa-sc-pdeal.nasa-sc-pdeal-block .nasa-sc-p-info .nasa-sc-p-title h3 a:hover,
            body #nasa-footer .nasa-footer-contact .wpcf7-form label span.your-email:after,
            body .nasa-nav-sc-menu .menu-item a:hover,
            body .nasa-static-sidebar .nasa-wishlist-title:hover,
            body .nasa-static-sidebar .button-in-wishlist:hover,
            body .nasa-static-sidebar .mini-cart-info a:hover,
            body .nasa-login-register-warper #nasa-login-register-form .nasa-switch-form a,
            body .vertical-menu-container #vertical-menu-wrapper li.root-item:hover > a,
            body .vertical-menu-container .vertical-menu-wrapper li.root-item:hover > a,
            body .nasa-menu-vertical-header.vitems-root .nasa-vertical-header .vertical-menu-wrapper>li>a:hover,
            body .current-menu-item > a.nasa-title-menu,
            body .product-item .info .name:hover,
            body .nasa-item-meta .nasa-widget-title:hover,
            html body.nasa-dark .product-item .info .name:hover,
            html body.nasa-dark .nasa-item-meta .nasa-widget-title:hover,
            html body.nasa-dark .nasa-static-sidebar.style-1 .mini-cart-item .product-name:hover,
            body .nasa-compare-list-bottom .nasa-compare-mess,
            body .nasa-labels-filter-top .nasa-labels-filter-accordion .nasa-top-row-filter > li.nasa-active a,
            body .nasa-labels-filter-top .nasa-top-row-filter > li.nasa-active a,
            body .nasa-labels-filter-top .nasa-tab-push-cats.nasa-push-cat-show,
            body .nasa-wrap-slick-slide-products-title .nasa-slide-products-title-item.slick-current > a,
            body .nasa-accordions-content .nasa-accordion-title a.active,
            body .widget.widget_product_categories li a:hover,
            body .widget.woocommerce.widget_product_categories li a:hover,
            body .widget.widget_product_categories li.current-tax-item > a,
            body .widget.woocommerce.widget_product_categories li.current-tax-item > a,
            body .widget.widget_product_categories li.current-tax-item .children a:hover,
            body .widget.woocommerce.widget_product_categories li.current-tax-item .children a:hover,
            body .widget li a:hover,
            body .nasa-products-special-deal.nasa-products-special-deal-multi-2 .nasa-list-stock-status span,
            body .nasa-after-add-to-cart-subtotal-price,
            body .nasa-total-condition-desc .woocommerce-Price-amount,
            body .woocommerce-table--order-details tfoot tr:last-child td > .amount,
            body .woocommerce-MyAccount-navigation.nasa-MyAccount-navigation .woocommerce-MyAccount-navigation-link a:hover:before,
            body .woocommerce-MyAccount-navigation.nasa-MyAccount-navigation .woocommerce-MyAccount-navigation-link a:hover svg,
            body .topbar-menu-container ul ul li a:hover,
            body .shop_table tbody .product-subtotal,
            body .grid-product-category .nasa-item-wrap:hover .nasa-view-more i,
            body .nasa-slide-style li.active a,
            body #dokan-store-listing-filter-wrap .right .toggle-view .active,
            body .nasa-product-content-nasa_label-wrap .nasa-product-content-child > a:focus,
            body .nasa-product-content-nasa_label-wrap .nasa-product-content-child > a:visited,
            body .nasa-product-content-nasa_label-wrap .nasa-product-content-child > a:hover,
            body .nasa-product-content-nasa_label-wrap .nasa-product-content-child > a.nasa-active,
            body .nasa-color-small-square .nasa-attr-ux-color.selected,
            body .nasa-color-small-square .nasa-attr-ux-color:hover,
            body .nasa-label-small-square-1 .nasa-attr-ux-label.selected,
            body .nasa-label-small-square-1 .nasa-attr-ux-label:hover,
            body .nasa-products-special-deal .product-deal-special-title:hover,
            body .nasa-tab-push-cats.nasa-push-cat-show,
            body .nasa-sp-mcr .woocs_auto_switcher.nasa-layout li a:hover,
            body .elementor-element .elementor-widget-heading.primary-color .elementor-widget-container .elementor-heading-title,
            body .grid-product-category .nasa-item-wrap:hover .nasa-view-more svg,
            .nasa-product-details-page .woosb-wrap.woosb-bundled .woosb-total .woocommerce-price-suffix,
            .nasa-where-you-are-wrap .nasa-title .ns-map-lcl,
            .nasa-where-you-are-wrap .current-menu-item>a
            {
                color: <?php echo esc_attr($color_primary); ?>;
            }
            body .nasa-slide-style li.active .ns-after_title svg path,
            body .nasa-slide-style li.active .ns-before_title svg path,
            body .nasa-slide-style li:hover .ns-after_title svg path,
            body .nasa-slide-style li:hover .ns-before_title svg path
            {
                fill: <?php echo esc_attr($color_primary); ?>;
            }
            h1.entry-title a:hover,
            .blog_shortcode_item .blog_shortcode_text h3 a:hover,
            .widget-area ul li a:hover,
            .progress-bar .bar-meter .bar-number,
            .product-item .info .name a:hover,
            .wishlist_table td.product-name a:hover,
            .product-list .info .name:hover,
            .product-info .compare:hover,
            .product-info .compare:hover:before,
            .product-info .yith-wcwl-add-to-wishlist:hover:before,
            .product-info .yith-wcwl-add-to-wishlist:hover a,
            .product-info .yith-wcwl-add-to-wishlist:hover .feedback,
            .menu-item.nasa-megamenu > .nav-dropdown > ul > li.menu-item a:hover:before,
            rev-btn.elessi-Button
            {
                color: <?php echo esc_attr($color_primary); ?> !important;
            }
            body .nasa_hotspot,
            body .label-new.menu-item a:after,
            body .text-box-primary,
            body .navigation-paging a:hover,
            body .navigation-image a:hover,
            body .next-prev-nav .prod-dropdown > a:hover,
            body .widget_product_tag_cloud a:hover,
            body .nasa-tag-cloud a.nasa-active,
            body .product-img .product-bg,
            body #submit:hover,
            body button:hover,
            body .button:hover,
            body input[type="submit"]:hover,
            body .post-item:hover .post-date,
            body .blog_shortcode_item:hover .post-date,
            body .group-slider .sliderNav a:hover,
            body .support-icon.square-round:hover,
            body .entry-header .post-date-wrapper,
            body .entry-header .post-date-wrapper:hover,
            body .comment-inner .reply a:hover,
            body .header-nav .nav-top-link::before,
            body .sliderNav a span:hover,
            body .shop-by-category h3.section-title,
            body .custom-footer-1 .nasa-hr,
            body .products.list .yith-wcwl-add-button:hover,
            body .shop-by-category .widget-title,
            body .rev_slider_wrapper .type-label-2,
            body .nasa-hr.primary-color,
            body .primary-bg,
            body .nasa-bg-primary,
            body .pagination-centered .page-numbers a:hover,
            body .pagination-centered .page-numbers span.current,
            body .nasa-mini-number,
            body .load-more::before,
            body .products-arrow .next-prev-buttons .icon-next-prev:hover,
            body .widget_price_filter .ui-slider .ui-slider-handle:after,
            body .nasa-classic-style.nasa-classic-2d.nasa-tab-primary-color li.active a,
            body .nasa-classic-style.nasa-classic-2d.nasa-tab-primary-color li:hover a,
            body .collapses.active .collapses-title a:before,
            body .title-block span:after,
            body .nasa-login-register-warper #nasa-login-register-form a.login-register-close:hover i:before,
            body .products-group.nasa-combo-slider .product-item.grid .nasa-product-bundle-btns .quick-view:hover,
            body .search-dropdown.nasa-search-style-3 .nasa-show-search-form .search-wrapper form .nasa-icon-submit-page:before,
            body .nasa-search-space.nasa-search-style-3 .nasa-show-search-form .search-wrapper form .nasa-icon-submit-page:before,
            body .nasa-gift-featured-wrap .nasa-gift-featured-event:hover,
            body #nasa-popup .wpcf7 input[type="button"],
            body #nasa-popup .wpcf7 input[type="submit"],
            body .nasa-product-grid .add-to-cart-grid,
            body .nasa-product-grid .add_to_cart_text,
            body .nasa-progress-bar-load-shop .nasa-progress-per,
            body #nasa-footer .footer-contact .btn-submit-newsletters,
            body #nasa-footer .footer-light-2 .footer-contact .btn-submit-newsletters,
            body .easypin-marker > .nasa-marker-icon-wrap .nasa-marker-icon-bg,
            body .easypin-marker > .nasa-marker-icon-wrap .nasa-action-effect,
            body .vertical-menu.nasa-shortcode-menu .section-title,
            body .tp-bullets.custom .tp-bullet.selected,
            body .sr7-bullets.custom .sr7-bullet.selected,
            body #submit.small.nasa-button-banner,
            body button.small.nasa-button-banner,
            body .button.small.nasa-button-banner,
            body input[type="submit"].small.nasa-button-banner,
            body .nasa-menu-vertical-header,
            body .nasa-quickview-view-detail,
            body.nasa-in-mobile #top-bar .topbar-mobile-text,
            body .nasa-total-condition-wrap:before,
            body .nasa-pagination.style-2 .page-numbers span.current,
            body .nasa-pagination.style-2 .page-numbers a.current,
            body .nasa-pagination.style-2 .page-numbers a.nasa-current,
            body .nasa-classic-style.nasa-classic-2d.nasa-tabs-no-border.nasa-tabs-radius li.active a,
            body .nasa-meta-categories,
            body .woocommerce-pagination ul li .page-numbers.current,
            body .slick-dots li.slick-active,
            body a:hover .nasa-comment-count,
            body .nasa-close-sidebar:hover,
            body .nasa-sidebar-close a:hover,
            body .nasa-close-menu-mobile:hover,
            body .nasa-top-cat-filter-wrap-mobile .nasa-close-filter-cat:hover,
            body .nasa-item-img .quick-view:hover,
            body .nasa-product-status-widget .nasa-filter-status.nasa-active:before,
            body .nasa-product-alphabet-widget .nasa-filter-alphabet.nasa-active:before,
            body .nasa-ignore-filter-global:hover:before,
            body .nasa-modern-1 .nasa-product-grid .btn-link:hover,
            body .group-btn-in-list .add-to-cart-grid:hover .add_to_cart_text,
            body .nasa-wrap-review-thumb .nasa-item-review-thumb .svg-wrap:hover,
            body .ns-sale-notification .ns-time-countdown,
            body #dokan-seller-listing-wrap.grid-view .nasa-style.style-list-1 .nasa-dokan-badges .featured-favourite .featured-label,
            body #dokan-seller-listing-wrap.grid-view .nasa-style .store-content .store-data-container .featured-favourite .featured-label,
            body .nasa-static-sidebar .widget_shopping_cart_content .woocommerce-mini-cart>.row .cross-sells .nasa-slick-slider .slick-track .product-item .product-img-wrap:hover .nasa-product-grid.nasa-group-btns .quick-view:hover,
            body ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root:hover::after,
            body ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root .ns-cat-child li:hover::after,
            body.nasa-dark ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root:hover::after,
            body.nasa-dark ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root .ns-cat-child li:hover::after,
            ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root .ns-cat-child li:hover>.ns-cat-tree-link::before,
            ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root .ns-cat-child li:hover>.ns-cat-tree-link::after,
            body.nasa-dark ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root .ns-cat-child li:hover>.ns-cat-tree-link::after,
            ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root .ns-cat-child li:has(~ li:hover)::before,
            ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root:has(~ .ns-cat-root:hover)::before,
            ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root:hover>.ns-cat-tree-link::after,
            body.nasa-dark ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root:hover>.ns-cat-tree-link::after,
            ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-root:hover>.ns-cat-tree-link::before,
            body .nasa-category-horizontal-2 .product-category:hover .header-title:hover,
            .nasa-where-you-are-wrap .nasa-title .ns-map-lcl::after {
                background-color: <?php echo esc_attr($color_primary); ?>;
            }
            body .product-info .cart .single_add_to_cart_button:hover,
            body #cart-sidebar.style-1 a.nasa-sidebar-return-shop:hover,
            body #nasa-wishlist-sidebar.style-1 a.nasa-sidebar-return-shop:hover,
            body #nasa-popup .wpcf7 input[type="button"]:hover,
            body #nasa-popup .wpcf7 input[type="submit"]:hover,
            body #nasa-footer .footer-light-2 .footer-contact .btn-submit-newsletters:hover,
            body .nasa-product-content-select-wrap .nasa-product-content-child .nasa-toggle-content-attr-select .nasa-attr-ux-item.nasa-active
            {
                background-color: <?php echo esc_attr($color_primary_darken); ?>;
            }
            body .product-item .nasa-product-grid .add-to-cart-grid:hover .add_to_cart_text
            {
                color: #fff;
            }
            button.primary-color,
            .newsletter-button-wrap .newsletter-button,
            body .easypin-marker > .nasa-marker-icon-wrap .nasa-marker-icon-bg:hover,
            body .nasa-hoz-buttons .nasa-product-grid .add-to-cart-grid:hover
            {
                background-color: <?php echo esc_attr($color_primary); ?> !important;
            }
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout,
            body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout,
            .nasa-static-sidebar .widget_shopping_cart_content .cross-sells .nasa-slick-slider .product-item .product-info-wrap .add-to-cart-grid:hover,
            .nasa-push-cat-filter-type-3 .nasa-push-cat-filter.ns-top-bar-side-canvas .ns-top-3-side-canvas-close:hover,
            ul.ns-categories-tree-warp .ns-categories-tree-column .ns-cat-tree-link:hover .count {
                background-color: <?php echo esc_attr($color_primary); ?> !important;
                border-color: <?php echo esc_attr($color_primary); ?> !important;
            }
            body .nasa-static-sidebar .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            body .ns-cart-popup-v2 .btn-mini-cart .woocommerce-mini-cart__buttons a.checkout:hover,
            body .nasa-static-sidebar .widget_shopping_cart_content .nasa-minicart-footer > .row .cross-sells .nasa-slick-slider .slick-track .product:hover .nasa-group-btns .quick-view:hover,
            .nasa-dsc-type-2>.dsc-flex-column>.dsc-flex-column .ev-dsc-quick-add:hover
            {
                background-color: <?php echo esc_attr($color_primary_darken); ?> !important;
                border-color: <?php echo esc_attr($color_primary_darken); ?> !important;
            }
            @media only screen and (min-width: 768px) {
                body .nasa-vertical-tabs .nasa-tabs.nasa-classic-style.nasa-tabs-no-border li.active a:after {
                    background-color: <?php echo esc_attr($color_primary); ?>;
                }
                html body.nasa-dark .nasa-hoz-buttons .nasa-product-grid .btn-wishlist:hover,
                html body.nasa-dark .nasa-hoz-buttons .nasa-product-grid .quick-view:hover,
                html body.nasa-dark .nasa-hoz-buttons .nasa-product-grid .btn-compare:hover,
                html body.nasa-dark .nasa-hoz-buttons .nasa-product-grid .btn-link:hover {
                    background-color: <?php echo esc_attr($color_primary); ?>;
                    border-color: <?php echo esc_attr($color_primary); ?>;
                }
            }
            body .primary-border,
            body .text-bordered-primary,
            body .navigation-paging a,
            body .navigation-image a,
            body .post.sticky,
            body .next-prev-nav .prod-dropdown > a:hover,
            body .iosSlider .sliderNav a:hover span,
            body .woocommerce-checkout form.login,
            body li.mini-cart .cart-icon strong,
            body .post-date,
            body .remove:hover i,
            body .support-icon.square-round:hover,
            body h3.section-title span,
            body .social-icons .icon.icon_email:hover,
            body .seam_icon .seam,
            body .border_outner,
            body .pagination-centered .page-numbers a:hover,
            body .pagination-centered .page-numbers span.current,
            body .products.list .yith-wcwl-wishlistexistsbrowse a,
            body .products-arrow .next-prev-buttons .icon-next-prev:hover,
            body .search-dropdown .nasa-show-search-form .search-wrapper form .nasa-icon-submit-page,
            body .nasa-search-space .nasa-show-search-form .search-wrapper form .nasa-icon-submit-page,
            body .products-group.nasa-combo-slider .product-item.grid .nasa-product-bundle-btns .quick-view:hover,
            body .nasa-table-compare tr.stock td span,
            body .nasa-classic-style.nasa-classic-2d.nasa-tab-primary-color li.active a,
            body .nasa-classic-style.nasa-classic-2d.nasa-tab-primary-color li:hover a,
            body .nasa-slide-style li.nasa-slide-tab,
            body .nasa-wrap-table-compare .nasa-table-compare tr.stock td span,
            body .vertical-menu-container #vertical-menu-wrapper li.root-item:hover > a:before,
            body .vertical-menu-container .vertical-menu-wrapper li.root-item:hover > a:before,
            body .nasa-menu-vertical-header.vitems-root .nasa-vertical-header .vertical-menu-wrapper>li>a:hover,
            body .nasa-gift-featured-wrap .nasa-gift-featured-event:hover,
            body .nasa-title.hr-type-vertical .nasa-wrap,
            body #nasa-footer .footer-contact .btn-submit-newsletters,
            body .easypin-marker > .nasa-marker-icon-wrap .nasa-marker-icon-bg,
            body .easypin-marker > .nasa-marker-icon-wrap .nasa-marker-icon,
            body .vertical-menu.nasa-shortcode-menu .section-title,
            body .nasa-products-special-deal.nasa-products-special-deal-multi-2 .nasa-main-special,
            body .nasa-slider-deal-vertical-extra-switcher.nasa-nav-4-items .slick-slide.slick-current .item-deal-thumb,
            body .nasa-slider-deal-vertical-extra-switcher.nasa-nav-4-items .slick-slide:hover .item-deal-thumb,
            body .nasa-accordions-content .nasa-accordion-title a.active:before,
            body .nasa-accordions-content .nasa-accordion-title a.active:after,
            body .nasa-color-small-square .nasa-attr-ux-color.selected,
            body .nasa-color-small-square .nasa-attr-ux-color:hover,
            body .nasa-label-small-square-1 .nasa-attr-ux-label.selected,
            body .nasa-label-small-square-1 .nasa-attr-ux-label:hover,
            body .nasa-color-big-square .nasa-attr-ux-color.selected,
            body .nasa-label-big-square .nasa-attr-ux-label.selected,
            body .nasa-image-square-caption .nasa-attr-ux-image.selected,
            body .comment-inner .reply a:hover,
            body .nasa-close-sidebar:hover,
            body .nasa-sidebar-close a:hover,
            body .nasa-close-menu-mobile:hover,
            body .nasa-top-cat-filter-wrap-mobile .nasa-close-filter-cat:hover,
            body .nasa-item-img .quick-view:hover,
            body .nasa-anchor.active,
            body .nasa-tab-push-cats.nasa-push-cat-show i,
            body .nasa-product-status-widget .nasa-filter-status:hover:before,
            body .nasa-product-status-widget .nasa-filter-status.nasa-active:before,
            body .nasa-product-alphabet-widget .nasa-filter-alphabet:hover:before,
            body .nasa-product-alphabet-widget .nasa-filter-alphabet.nasa-active:before,
            body .nasa-ignore-filter-global:hover:before,
            body .group-btn-in-list .add-to-cart-grid:hover .add_to_cart_text,
            body .nasa-menu-vertical-header .vertical-menu-wrapper,
            body .nasa-icon-box:hover .box-img:before,
            body .nasa-reset-filters-top:hover,
            body .nasa-product-content-select-wrap .nasa-product-content-child .nasa-toggle-content-attr-select .nasa-attr-ux-item.nasa-active,
            body .nasa-labels-filter-top .nasa-top-row-filter li a.nasa-active:before,
            body .nasa-labels-filter-top .nasa-top-row-filter li a.nasa-active:after,
            body .ns-toggle-popup-static-block:hover:after,
            body .ns-toggle-popup-static-block.active:after
            {
                border-color: <?php echo esc_attr($color_primary); ?>;
            }
            @media only screen and (min-width: 768px) {
                body .nasa-hoz-buttons .nasa-product-grid .add-to-cart-grid:hover,
                body .nasa-hoz-buttons .nasa-product-grid .btn-wishlist:hover,
                body .nasa-hoz-buttons .nasa-product-grid .quick-view:hover,
                body .nasa-hoz-buttons .nasa-product-grid .btn-compare:hover {
                    border-color: <?php echo esc_attr($color_primary); ?>;
                    background-color: <?php echo esc_attr($color_primary); ?>;
                }
            }

            #nasa_customer_login .form-row .ns-show-password:hover svg path,
            #customer_login .form-row .ns-show-password:hover svg path 
            {
                stroke: <?php echo esc_attr($color_primary); ?>;
            }
            body .nasa-img-box:hover
            {
                border-color: <?php echo esc_attr($color_primary); ?>;
                background-color: <?php echo esc_attr($color_primary . '0d'); // Opacity .05 ?>;
            }
            body #cart-sidebar.style-1 a.nasa-sidebar-return-shop:hover,
            body #nasa-wishlist-sidebar.style-1 a.nasa-sidebar-return-shop:hover,
            body .product-info .cart .single_add_to_cart_button:hover
            {
                border-color: <?php echo esc_attr($color_primary_darken); ?>;
            }
            .promo .sliderNav span:hover,
            .remove .pe-7s-close:hover
            {
                border-color: <?php echo esc_attr($color_primary); ?> !important;
            }
            .collapsing.categories.list li:hover,
            #menu-shop-by-category li.active
            {
                border-left-color: <?php echo esc_attr($color_primary); ?> !important;
            }
            body .nasa-slider-deal-vertical-extra-switcher.nasa-nav-4-items .item-slick.slick-current:before
            {
                border-right-color: <?php echo esc_attr($color_primary); ?>;
            }
            html body.nasa-rtl .nasa-slider-deal-vertical-extra-switcher.nasa-nav-4-items .item-slick.slick-current:after
            {
                border-left-color: <?php echo esc_attr($color_primary); ?>;
            }
            body button,
            body .button,
            body #submit,
            body a.button,
            body p a.button,
            body input#submit,
            body .add_to_cart,
            body .checkout-button,
            body .dokan-btn-theme,
            body a.dokan-btn-theme,
            body input#place_order,
            body form.cart .button,
            body form.cart .button:focus,
            body .form-submit input,
            body input[type="submit"],
            body #payment .place-order input,
            body .footer-type-2 input.button,
            body input[type="submit"].dokan-btn-theme,
            body #nasa-footer .btn-submit-newsletters,
            body .nasa-table-compare .add-to-cart-grid,
            body .nasa-static-sidebar .nasa-sidebar-return-shop,
            body .nasa-tab-primary-color .nasa-classic-style li:hover a,
            body .nasa-tab-primary-color .nasa-classic-style li.active a,
            body .nasa-search-space .nasa-show-search-form.nasa-over-hide.nasa-modern-layout .nasa-search-all,
            body .widget.woocommerce li.current-tax-item > a .count,
            body .widget.woocommerce li.nasa-chosen > a.nasa-filter-by-variations .count,
            body .widget.woocommerce li > a:hover .count,
            body .widget.woocommerce ul li.nasa_show_manual a:hover,
            body .nasa-top-sidebar-3 .nasa-tab-filter-topbar:hover,
            body .nasa-static-sidebar .widget_shopping_cart_content .woocommerce-mini-cart>.row .cross-sells .nasa-slick-slider .product-item .product-img-wrap:hover .nasa-product-grid.nasa-group-btns .quick-view:hover
            {
                background-color: <?php echo esc_attr($color_primary); ?>;
                border-color: <?php echo esc_attr($color_primary); ?>;
                color: #FFF;
            }
            body button:hover,
            body .button:hover,
            body a.button:hover,
            body * button:hover,
            body * .button:hover,
            body * #submit:hover,
            body p a.button:hover,
            body input#submit:hover,
            body .add_to_cart:hover,
            body input#submit:hover,
            body .checkout-button:hover,
            body .dokan-btn-theme:hover,
            body a.dokan-btn-theme:hover,
            body input#place_order:hover,
            body form.cart .button:hover,
            body .form-submit input:hover,
            body * input[type="submit"]:hover,
            body #payment .place-order input:hover,
            body .footer-type-2 input.button:hover,
            body .nasa-reset-filters-top:hover:before,
            body .nasa-ignore-price-item:hover:before,
            body .nasa-ignore-variation-item:hover:before,
            body input[type="submit"].dokan-btn-theme:hover,
            body .nasa-table-compare .add-to-cart-grid:hover,
            body .nasa-static-sidebar .nasa-sidebar-return-shop:hover,
            body .product-list .product-img .quick-view.fa-search:hover,
            body .product-deal-special-buttons .nasa-product-grid .add-to-cart-grid:hover .add_to_cart_text,
            body .nasa-search-space .nasa-show-search-form.nasa-over-hide.nasa-modern-layout .nasa-search-all:hover
            {
                background-color: <?php echo esc_attr($color_primary_darken); ?>;
                border-color: <?php echo esc_attr($color_primary_darken); ?>;
                color: #FFF;
            }
            /* End Primary color =========================================== */
        </style>
        <?php
        if ($return) {
            $css = ob_get_clean();
    
            return elessi_convert_css($css);
        }
    }

endif;

/**
 * CSS override color for main menu
 */
if (!function_exists('elessi_get_style_main_menu_color')) :

    function elessi_get_style_main_menu_color(
        $bg_color = '',
        $text_color = '',
        $bg_color_stk = '',
        $text_color_stk = '',
        $return = true
    ) {
        if ($bg_color == '' && $text_color == '' && $bg_color_stk == '' && $text_color_stk == '') {
            return '';
        }

        if ($return) {
            ob_start();
        }
        ?><style>
            /* Start override main menu color =========================================== */
            <?php
            if ($bg_color != '') : ?>
                body .nasa-bg-dark,
                body .header-type-4 .nasa-elements-wrap-bg,
                body .header-type-6 .nasa-elements-wrap-bg
                {
                    background-color: <?php echo esc_attr($bg_color); ?>;
                }
                <?php
                $bg_color = strtolower($bg_color);
                if ($bg_color !== '#fff' && $bg_color !== '#ffffff' && $bg_color !== 'white') : ?>
                    body .header-type-4 .nasa-elements-wrap-bg,
                    body .header-type-6 .nasa-elements-wrap-bg
                    {
                        border-top: none;
                        border-bottom: none;
                    }
                <?php 
                endif;
            endif;
            
            if ($bg_color_stk != '') : ?>
                body .fixed-already .nasa-bg-dark,
                body .header-type-4 .fixed-already .nasa-elements-wrap-bg,
                body .header-type-6 .fixed-already .nasa-elements-wrap-bg
                {
                    background-color: <?php echo esc_attr($bg_color_stk); ?>;
                }
                <?php
            endif;
            
            if ($text_color != '') :
                ?>
                .nasa-beside-mm,
                .nasa-beside-mm a,
                .nasa-beside-mm a:hover,
                body .nav-wrapper .root-item > a,
                body .nav-wrapper .root-item:hover > a,
                body .nav-wrapper .root-item.current-menu-ancestor > a,
                body .nav-wrapper .root-item.current-menu-item > a,
                body .nav-wrapper .root-item:hover > a:hover,
                body .nav-wrapper .root-item.current-menu-ancestor > a:hover,
                body .nav-wrapper .root-item.current-menu-item > a:hover,
                body .nasa-bg-dark .nav-wrapper .root-item > a,
                body .nasa-bg-dark .nav-wrapper .root-item:hover > a,
                body .nasa-bg-dark .nav-wrapper .root-item.current-menu-ancestor > a,
                body .nasa-bg-dark .nav-wrapper .root-item.current-menu-item > a,
                body .nasa-bg-wrap .nasa-vertical-header h5.section-title
                {
                    color: <?php echo esc_attr($text_color); ?>;
                }
                body .nav-wrapper .root-item:hover > a:after,
                body .nav-wrapper .root-item.current-menu-ancestor > a:after,
                body .nav-wrapper .root-item.current-menu-item > a:after,
                body .nasa-bg-dark .nav-wrapper .root-item:hover > a:after,
                body .nasa-bg-dark .nav-wrapper .root-item.current-menu-ancestor > a:after,
                body .nasa-bg-dark .nav-wrapper .root-item.current-menu-item > a:after
                {
                    border-color: <?php echo esc_attr($text_color); ?>;
                }
                <?php
            endif;

            if ($text_color_stk != '') :
                ?>
                .fixed-already .nasa-beside-mm,
                .fixed-already .nasa-beside-mm a,
                .fixed-already .nasa-beside-mm a:hover,
                body .fixed-already .nav-wrapper .root-item > a,
                body .fixed-already .nav-wrapper .root-item:hover > a,
                body .fixed-already .nav-wrapper .root-item.current-menu-ancestor > a,
                body .fixed-already .nav-wrapper .root-item.current-menu-item > a,
                body .fixed-already .nav-wrapper .root-item:hover > a:hover,
                body .fixed-already .nav-wrapper .root-item.current-menu-ancestor > a:hover,
                body .fixed-already .nav-wrapper .root-item.current-menu-item > a:hover,
                body .fixed-already .nasa-bg-dark .nav-wrapper .root-item > a,
                body .fixed-already .nasa-bg-dark .nav-wrapper .root-item:hover > a,
                body .fixed-already .nasa-bg-dark .nav-wrapper .root-item.current-menu-ancestor > a,
                body .fixed-already .nasa-bg-dark .nav-wrapper .root-item.current-menu-item > a,
                body .fixed-already .nasa-bg-wrap .nasa-vertical-header h5.section-title
                {
                    color: <?php echo esc_attr($text_color_stk); ?>;
                }
                body .fixed-already .nav-wrapper .root-item:hover > a:after,
                body .fixed-already .nav-wrapper .root-item.current-menu-ancestor > a:after,
                body .fixed-already .nav-wrapper .root-item.current-menu-item > a:after,
                body .fixed-already .nasa-bg-dark .nav-wrapper .root-item:hover > a:after,
                body .fixed-already .nasa-bg-dark .nav-wrapper .root-item.current-menu-ancestor > a:after,
                body .fixed-already .nasa-bg-dark .nav-wrapper .root-item.current-menu-item > a:after
                {
                    border-color: <?php echo esc_attr($text_color_stk); ?>;
                }
                <?php
            endif; ?>
            /* End =========================================== */
        </style>
        <?php
        if ($return) {
            $css = ob_get_clean();
    
            return elessi_convert_css($css);
        }
    }

endif;

/**
 * CSS override color for main menu
 */
if (!function_exists('elessi_get_style_vertical_menu_color')) :

    function elessi_get_style_vertical_menu_color(
        $bg_color = '',
        $text_color = '',
        $bg_color_stk = '',
        $text_color_stk = '',
        $return = true
    ) {
        if ($bg_color == '' && $text_color == '' && $bg_color_stk == '' && $text_color_stk == '') {
            return '';
        }

        if ($return) {
            ob_start();
        }
        ?><style>
            /* Start override main menu color =========================================== */
            <?php
            if ($bg_color != '') : ?>
                html body .nasa-menu-vertical-header
                {
                    background-color: <?php echo esc_attr($bg_color); ?>;
                }
                html body .nasa-vertical-header .vertical-menu-wrapper
                {
                    border-color: <?php echo esc_attr($bg_color); ?>;
                }
                <?php
            endif;
            
            if ($bg_color_stk != '') : ?>
                html body .fixed-already .nasa-menu-vertical-header
                {
                    background-color: <?php echo esc_attr($bg_color_stk); ?>;
                }
                html body .fixed-already .nasa-vertical-header .vertical-menu-wrapper
                {
                    border-color: <?php echo esc_attr($bg_color_stk); ?>;
                }
                <?php
            endif;

            if ($text_color != '') :
                ?>
                body .nasa-bg-wrap .nasa-vertical-header h5.section-title
                {
                    color: <?php echo esc_attr($text_color); ?>;
                }
                <?php
            endif;
            
            if ($text_color_stk != '') :
                ?>
                body .fixed-already .nasa-bg-wrap .nasa-vertical-header h5.section-title
                {
                    color: <?php echo esc_attr($text_color_stk); ?>;
                }
                <?php
            endif;
            ?>
            /* End =========================================== */
        </style>
        <?php
        if ($return) {
            $css = ob_get_clean();
    
            return elessi_convert_css($css);
        }
    }

endif;

/**
 * CSS override color for header
 */
if (!function_exists('elessi_get_style_header_color')) :

    function elessi_get_style_header_color(
        $bg_color = '',
        $text_color = '',
        $text_color_hover = '',
        $bg_color_stk = '',
        $text_color_stk = '',
        $text_color_hover_stk = '',
        $return = true
    ) {
        if ($bg_color == '' && $text_color == '' && $text_color_hover == '' && $bg_color_stk == '' && $text_color_stk == '' && $text_color_hover_stk == '') {
            return '';
        }

        if ($return) {
            ob_start();
        }
        ?><style>
            /* Start override header color =========================================== */
            <?php if ($bg_color != '') : ?>
                body #masthead,
                body .mobile-menu .nasa-td-mobile-icons .nasa-mobile-icons-wrap.nasa-absolute-icons .nasa-header-icons-wrap,
                body .nasa-header-sticky.nasa-header-mobile-layout.nasa-header-transparent .fixed-already #masthead
                {
                    background-color: <?php echo esc_attr($bg_color); ?>;
                }
                body .nasa-header-mobile-layout.nasa-header-transparent #masthead
                {
                    background-color: transparent;
                }
                <?php
            endif;
            
            if ($bg_color_stk != '') : ?>
                body .fixed-already #masthead,
                body .nasa-header-mobile-layout.nasa-header-transparent .fixed-already #masthead,
                body .fixed-already .mobile-menu .nasa-td-mobile-icons .nasa-mobile-icons-wrap.nasa-absolute-icons .nasa-header-icons-wrap,
                html body .nasa-header-sticky.nasa-header-mobile-layout.nasa-header-transparent .fixed-already #masthead
                {
                    background-color: <?php echo esc_attr($bg_color_stk); ?>;
                }
                <?php
            endif;

            if ($text_color != '') :
            ?>
                body #masthead .header-icons > li > a,
                body .mini-icon-mobile .nasa-icon,
                body .nasa-toggle-mobile_icons,
                body #masthead .follow-icon a i,
                body #masthead .nasa-icon
                {
                    color: <?php echo esc_attr($text_color); ?>;
                }
                .mobile-menu .nasa-td-mobile-icons .nasa-toggle-mobile_icons .nasa-icon
                {
                    border-color: transparent !important;
                }
            <?php
            endif;
            
            if ($text_color_stk != '') :
            ?>
                body .fixed-already #masthead .header-icons > li > a,
                body .fixed-already .mini-icon-mobile .nasa-icon,
                body .fixed-already .nasa-toggle-mobile_icons,
                body .fixed-already #masthead .follow-icon a i,
                body .fixed-already #masthead .nasa-icon
                {
                    color: <?php echo esc_attr($text_color_stk); ?>;
                }
            <?php
            endif;

            if ($text_color_hover != '') :
                ?>
                body #masthead .header-icons > li > a:hover i,
                body #masthead .header-icons > li > a:hover .icon-text,
                body #masthead .mini-cart .cart-icon:hover:before,
                body #masthead .follow-icon a:hover i,
                body #masthead .nasa-icon:hover
                {
                    color: <?php echo esc_attr($text_color_hover); ?>;
                }
            <?php
            endif;
            
            if ($text_color_hover_stk != '') :
                ?>
                body .fixed-already #masthead .header-icons > li > a:hover i,
                body .fixed-already #masthead .header-icons > li > a:hover .icon-text,
                body .fixed-already #masthead .mini-cart .cart-icon:hover:before,
                body .fixed-already #masthead .follow-icon a:hover i,
                body .fixed-already #masthead .nasa-icon:hover
                {
                    color: <?php echo esc_attr($text_color_hover_stk); ?>;
                }
            <?php endif; ?>
            /* End =========================================== */
        </style>
        <?php
        if ($return) {
            $css = ob_get_clean();
    
            return elessi_convert_css($css);
        }
    }

endif;

/**
 * CSS override color for TOPBAR
 */
if (!function_exists('elessi_get_style_topbar_color')) :

    function elessi_get_style_topbar_color(
        $bg_color = '',
        $text_color = '',
        $text_color_hover = '',
        $return = true
    ) {
        if ($bg_color == '' && $text_color == '' && $text_color_hover == '') {
            return '';
        }

        if ($return) {
            ob_start();
        }
        ?><style>
            /* Start override topbar color =========================================== */
            <?php if ($bg_color != '') : ?>
                body #top-bar,
                body .nasa-topbar-wrap.nasa-topbar-toggle .nasa-icon-toggle,
                body.nasa-in-mobile #top-bar .topbar-mobile-text
                {
                    background-color: <?php echo esc_attr($bg_color); ?>;
                }
                body #top-bar,
                body .nasa-topbar-wrap.nasa-topbar-toggle .nasa-icon-toggle
                {
                    border-color: <?php echo esc_attr($bg_color); ?>;
                }
            <?php
            endif;

            if ($text_color != '') : ?>
                body #top-bar,
                body #top-bar .topbar-menu-container .wcml-cs-item-toggle,
                body #top-bar .topbar-menu-container > ul > li:after,
                body #top-bar .topbar-menu-container > ul > li > a,
                body #top-bar .left-text,
                body.nasa-in-mobile #top-bar .topbar-mobile-text,
                body .nasa-topbar-wrap.nasa-topbar-toggle .nasa-icon-toggle
                {
                    color: <?php echo esc_attr($text_color); ?>;
                }
                <?php
            endif;

            if ($text_color_hover != '') :
                ?>
                body #top-bar .topbar-menu-container .wcml-cs-item-toggle:hover,
                body #top-bar .topbar-menu-container > ul > li > a:hover,
                body.nasa-in-mobile #top-bar .topbar-mobile-text a:hover,
                body .nasa-topbar-wrap.nasa-topbar-toggle .nasa-icon-toggle:hover
                {
                    color: <?php echo esc_attr($text_color_hover); ?>;
                }
            <?php endif; ?>
            /* End =========================================== */
        </style>
        <?php
        if ($return) {
            $css = ob_get_clean();
    
            return elessi_convert_css($css);
        }
    }

endif;

/**
 * CSS override Add more width site
 */
if (!function_exists('elessi_get_style_plus_wide_width')) :

    function elessi_get_style_plus_wide_width($max_width = '', $return = true) {
        if ($max_width == '') {
            return '';
        }

        if ($return) {
            ob_start();
        }
        ?><style>
            /* Start Override Max-width screen site */
            <?php if ($max_width != '') : ?>
                html body .row,
                html body.boxed #wrapper,
                html body.boxed .nav-wrapper .nasa-megamenu.fullwidth > .nav-dropdown,
                html body .nav-wrapper .nasa-megamenu.fullwidth > .nav-dropdown > ul,
                body .nasa-fixed-product-variations,
                body .nasa-add-to-cart-fixed .nasa-wrap-content-inner,
                html .woocommerce-account #main-content > .woocommerce,
                .elementor-section.elementor-section-boxed > .elementor-container
                {
                    max-width: <?php echo $max_width; ?>px;
                }
                .e-con.e-con-boxed > .e-con-inner
                {
                    max-width: <?php echo $max_width - 20; ?>px;
                }
                html body.boxed #wrapper .row,
                body.boxed .e-con.e-con-boxed > .e-con-inner,
                body.boxed .elementor-section.elementor-section-boxed > .elementor-container,
                html body.boxed .nav-wrapper .nasa-megamenu.fullwidth > .nav-dropdown > ul
                {
                    max-width: <?php echo $max_width - 50; ?>px;
                }
                @media only screen and (min-width: 768px) {
                    html body.dokan-store .dokan-store-wrap,
                    body.dokan-store #breadcrumbs,
                    body .wrap-ns-2 .profile-info-summery-wrapper,
                    body .wrap-ns-3 .profile-info-summery-wrapper,
                    body .yith-wcwl-form {
                        max-width: <?php echo $max_width; ?>px;
                    }
                    html body.nasa-gray .bgw > .row,
                    body .wrap-ns-2 .dokan-store-tabs ul,
                    body .wrap-ns-3 .dokan-store-tabs ul,
                    body .wrap-ns-4 .dokan-store-tabs,
                    body .profile-layout-ns-4 {
                        max-width: <?php echo ($max_width - 20); ?>px;
                    }
                    html body.boxed.nasa-gray #wrapper .bgw > .row {
                        max-width: <?php echo ($max_width - 70); ?>px;
                    }
                }
                @media only screen and (min-width: 1200px) and (max-width: <?php echo ($max_width + 60); ?>px) {
                    #main-content > .row,
                    #main-content > .section-element > .row,
                    #main-content > .container-wrap > .row,
                    #nasa-footer > .section-element > .row,
                    #top-bar > .row,
                    #masthead > .row,
                    #masthead > .section-element > .row,
                    #masthead .nasa-elements-wrap > .row,
                    .nasa_shop_description-wrap .section-element > .row,
                    .nasa-store-page.row,
                    .term-description > .row,
                    .nasa-view-compare > .row,
                    #nasa-breadcrumb-site > .row,
                    .order-steps > .row,
                    .page-checkout-modern,
                    body .nasa-add-to-cart-fixed,
                    #wrapper .related-product,
                    .modern:not(.nasa-layout-new-3) .nasa-single-product-scroll > .row,
                    .modern:not(.nasa-layout-new-3) .woocommerce-tabs > .row,
                    .modern:not(.nasa-layout-new-3) .woocommerce-tabs .nasa-scroll-content > .row,
                    .modern:not(.nasa-layout-new-3) .woocommerce-tabs.nasa-tabs-content .nasa-panel > .row,
                    .modern:not(.nasa-layout-new-3) .nasa-single-product-slide > .row,
                    .nasa-product-details-page.nasa-layout-classic,
                    .e-con.e-con-boxed > .e-con-inner,
                    .elementor-section.elementor-section-boxed > .elementor-container,
                    body.dokan-store #main-content .dokan-store-wrap,
                    .nasa-store-page.ns-shop-width-background .ns-before-archive-products .filters-container,
                    .nasa-store-page.ns-shop-width-background .nasa-recommend-product .woocommerce.row,
                    .nasa-store-page.ns-shop-width-background .nasa-archive-product-content {
                        padding-left: 30px;
                        padding-right: 30px;
                    }
                    body.nasa-gray #main-content > .section-element.bgw,
                    html .woocommerce-account #main-content > .woocommerce {
                        padding-left: 40px;
                        padding-right: 40px;
                    }
                    #wrapper .focus-info .related-product {
                        padding-left: 0;
                        padding-right: 0;
                    }
                }
            <?php endif; ?>
            /* End =========================================== */
        </style>
        <?php
        if ($return) {
            $css = ob_get_clean();
    
            return elessi_convert_css($css);
        }
    }

endif;

/**
 * CSS Override Font style
 */
if (!function_exists('elessi_get_font_style_rtl')) :
    
    function elessi_get_font_style_rtl (
        $type_font_select = '',
        $type_headings = '',
        $type_texts = '',
        $type_nav = '',
        $type_banner = '',
        $type_price = '',
        $custom_font = ''
    ) {
    
        if ($type_font_select == '') {
            return '';
        }

        ob_start();
        ?><style><?php
        
        if ($type_font_select == 'custom' && $custom_font) :
            ?>
                body.nasa-rtl,
                body.nasa-rtl p,
                body.nasa-rtl h1,
                body.nasa-rtl h2,
                body.nasa-rtl h3,
                body.nasa-rtl h4,
                body.nasa-rtl h5,
                body.nasa-rtl h6,
                body.nasa-rtl #top-bar,
                body.nasa-rtl .nav-dropdown,
                body.nasa-rtl select,
                body.nasa-rtl .top-bar-nav a.nav-top-link,
                body.nasa-rtl .megatop > a,
                body.nasa-rtl .root-item > a,
                body.nasa-rtl .nasa-tabs a,
                body.nasa-rtl .service-title,
                body.nasa-rtl .price .amount,
                body.nasa-rtl .nasa-banner,
                body.nasa-rtl .nasa-banner h1,
                body.nasa-rtl .nasa-banner h2,
                body.nasa-rtl .nasa-banner h3,
                body.nasa-rtl .nasa-banner h4,
                body.nasa-rtl .nasa-banner h5,
                body.nasa-rtl .nasa-banner h6
                {
                    font-family: "<?php echo esc_attr(ucwords($custom_font)); ?>", Arial, Helvetica, sans-serif;
                }
            <?php
        elseif ($type_font_select == 'google') :
            if ($type_headings != '') :
                ?>
                    body.nasa-rtl .service-title,
                    body.nasa-rtl .nasa-tabs a,
                    body.nasa-rtl h1,
                    body.nasa-rtl h2,
                    body.nasa-rtl h3,
                    body.nasa-rtl h4,
                    body.nasa-rtl h5,
                    body.nasa-rtl h6
                    {
                        font-family: "<?php echo esc_attr($type_headings); ?>", Arial, Helvetica, sans-serif;
                    }
                <?php
            endif;
            
            if ($type_texts != '') :
                ?>
                    body.nasa-rtl,
                    body.nasa-rtl p,
                    body.nasa-rtl #top-bar,
                    body.nasa-rtl .nav-dropdown,
                    body.nasa-rtl select,
                    body.nasa-rtl .top-bar-nav a.nav-top-link
                    {
                        font-family: "<?php echo esc_attr($type_texts); ?>", Arial, Helvetica, sans-serif;
                    }
                <?php
            endif;

            if ($type_nav != '') :
                ?>
                    body.nasa-rtl .megatop > a,
                    body.nasa-rtl .root-item a,
                    body.nasa-rtl .nasa-tabs a,
                    body.nasa-rtl .topbar-menu-container .header-multi-languages a
                    {
                        font-family: "<?php echo esc_attr($type_nav); ?>", Arial, Helvetica, sans-serif;
                    }
                <?php
            endif;

            if ($type_banner != '') :
                ?>
                    body.nasa-rtl .nasa-banner,
                    body.nasa-rtl .nasa-banner h1,
                    body.nasa-rtl .nasa-banner h2,
                    body.nasa-rtl .nasa-banner h3,
                    body.nasa-rtl .nasa-banner h4,
                    body.nasa-rtl .nasa-banner h5,
                    body.nasa-rtl .nasa-banner h6
                    {
                        font-family: "<?php echo esc_attr($type_banner); ?>", Arial, Helvetica, sans-serif;
                        letter-spacing: 0px;
                    }
                <?php
            endif;

            if ($type_price != '') :
                ?>
                    body.nasa-rtl .price,
                    body.nasa-rtl .amount
                    {
                        font-family: "<?php echo esc_attr($type_price); ?>", Arial, Helvetica, sans-serif;
                    }
                <?php
            endif;
        endif; ?></style><?php
        $css = ob_get_clean();

        return elessi_convert_css($css);
    }
    
endif;

/**
 * CSS Override Font style
 */
if (!function_exists('elessi_get_font_style')) :
    
    function elessi_get_font_style (
        $type_font_select = '',
        $type_headings = '',
        $type_texts = '',
        $type_nav = '',
        $type_banner = '',
        $type_price = '',
        $custom_font = '',
        $imprtant = false
    ) {
    
        if ($type_font_select == '') {
            return '';
        }

        ob_start();
        ?><style>
        <?php
        if ($type_font_select == 'custom' && $custom_font) :
            ?>
                body,
                p,
                h1, h2, h3, h4, h5, h6,
                #top-bar,
                .nav-dropdown,
                select,
                .top-bar-nav a.nav-top-link,
                .megatop > a,
                .root-item > a,
                .nasa-tabs a,
                .service-title,
                .price .amount,
                .nasa-banner,
                .nasa-banner h1,
                .nasa-banner h2,
                .nasa-banner h3,
                .nasa-banner h4,
                .nasa-banner h5,
                .nasa-banner h6
                {
                    font-family: "<?php echo esc_attr(ucwords($custom_font)); ?>", Arial, Helvetica, sans-serif<?php echo $imprtant ? ' !important' : ''; ?>;
                }
            <?php
        elseif ($type_font_select == 'google') :
            if ($type_headings != '') :
                ?>
                    .service-title,
                    .nasa-tabs a,
                    h1, h2, h3, h4, h5, h6
                    {
                        font-family: "<?php echo esc_attr($type_headings); ?>", Arial, Helvetica, sans-serif<?php echo $imprtant ? ' !important' : ''; ?>;
                    }
                <?php
            endif;
            
            if ($type_texts != '') :
                ?>
                    p,
                    body,
                    #top-bar,
                    .nav-dropdown,
                    select,
                    .top-bar-nav a.nav-top-link
                    {
                        font-family: "<?php echo esc_attr($type_texts); ?>", Arial, Helvetica, sans-serif<?php echo $imprtant ? ' !important' : ''; ?>;
                    }
                <?php
            endif;

            if ($type_nav != '') :
                ?>
                    .megatop > a,
                    .root-item a,
                    .nasa-tabs a,
                    .topbar-menu-container .header-multi-languages a
                    {
                        font-family: "<?php echo esc_attr($type_nav); ?>", Arial, Helvetica, sans-serif<?php echo $imprtant ? ' !important' : ''; ?>;
                    }
                <?php
            endif;

            if ($type_banner != '') :
                ?>
                    .nasa-banner,
                    .nasa-banner h1,
                    .nasa-banner h2,
                    .nasa-banner h3,
                    .nasa-banner h4,
                    .nasa-banner h5,
                    .nasa-banner h6
                    {
                        font-family: "<?php echo esc_attr($type_banner); ?>", Arial, Helvetica, sans-serif<?php echo $imprtant ? ' !important' : ''; ?>;
                        letter-spacing: 0px;
                    }
                <?php
            endif;

            if ($type_price != '') :
                ?>
                    .price,
                    .amount
                    {
                        font-family: "<?php echo esc_attr($type_price); ?>", Arial, Helvetica, sans-serif<?php echo $imprtant ? ' !important' : ''; ?>;
                    }
                <?php
            endif;
        endif; ?></style><?php
        $css = ob_get_clean();

        return elessi_convert_css($css);
    }
    
endif;

// **********************************************************************// 
// ! Dynamic - css
// **********************************************************************//
add_action('wp_enqueue_scripts', 'elessi_add_dynamic_css', 999);
if (!function_exists('elessi_add_dynamic_css')) :

    function elessi_add_dynamic_css() {
        global $nasa_upload_dir;
        
        if (!isset($nasa_upload_dir)) {
            $nasa_upload_dir = wp_upload_dir();
            $GLOBALS['nasa_upload_dir'] = $nasa_upload_dir;
        }
        
        $dynamic_path = $nasa_upload_dir['basedir'] . '/nasa-dynamic';
        
        if (is_file($dynamic_path . '/dynamic.css')) {
            global $nasa_opt;
            
            $version = isset($nasa_opt['nasa_dynamic_t']) ? $nasa_opt['nasa_dynamic_t'] : null;
            
            $prefix = elessi_prefix_theme();
            
            // Dynamic Css
            wp_enqueue_style($prefix . '-style-dynamic', elessi_remove_protocol($nasa_upload_dir['baseurl']) . '/nasa-dynamic/dynamic.css', array(), $version, 'all');
        }
    }

endif;

// **********************************************************************// 
// ! Dynamic - Page override primary color - css
// **********************************************************************//
add_action('wp_enqueue_scripts', 'elessi_page_override_style', 1000);
if (!function_exists('elessi_page_override_style')) :
    function elessi_page_override_style() {
        $prefix = elessi_prefix_theme();
    
        if (!wp_style_is($prefix . '-style-dynamic')) {
            return;
        }

        global $post, $nasa_opt, $content_width;
        
        $post_type = isset($post->post_type) ? $post->post_type : false;
        $is_page = 'page' === $post_type ? true : false;
        $object_id = $is_page ? $post->ID : false;
        
        if (!$is_page) {
            /**
             * Shop Page
             */
            if (NASA_WOO_ACTIVED) {
                $is_shop = is_shop();
                $is_product_taxonomy = is_product_taxonomy();
                $is_product_category = is_product_category();
                $object_id = ($is_shop || $is_product_taxonomy) && !$is_product_category ? wc_get_page_id('shop') : 0;

                $is_page = $object_id ? true : false;
            }
            
            /**
             * Page post
             */
            
            if (!$is_page && elessi_check_blog_page()) {
                $object_id = get_option('page_for_posts');
                $is_page = $object_id ? true : false;
            }
        }
        
        $dinamic_css = $font_weight = $color_primary_css = $page_css = '';
        if ($is_page && $object_id) {

            /**
             * color_primary
             */
            $flag_override_color = get_post_meta($object_id, '_nasa_pri_color_flag', true);
            if ($flag_override_color) :
                $color_primary = get_post_meta($object_id, '_nasa_pri_color', true);
                $color_primary_css .= $color_primary ? elessi_get_style_primary_color($color_primary) : '';
            endif;

            /**
             * color for header
             */
            $bg_color = get_post_meta($object_id, '_nasa_bg_color_header', true);
            $bg_color_stk = get_post_meta($object_id, '_nasa_bg_color_header_stk', true);
            $text_color = get_post_meta($object_id, '_nasa_text_color_header', true);
            $text_color_stk = get_post_meta($object_id, '_nasa_text_color_header_stk', true);
            $text_color_hover = get_post_meta($object_id, '_nasa_text_color_hover_header', true);
            $text_color_hover_stk = get_post_meta($object_id, '_nasa_text_color_hover_header_stk', true);
            $page_css .= elessi_get_style_header_color($bg_color, $text_color, $text_color_hover, $bg_color_stk, $text_color_stk, $text_color_hover_stk);

            /**
             * color for top bar
             */
            if (!isset($nasa_opt['topbar_on']) || $nasa_opt['topbar_on']) {
                $bg_color = get_post_meta($object_id, '_nasa_bg_color_topbar', true);
                $text_color = get_post_meta($object_id, '_nasa_text_color_topbar', true);
                $text_color_hover = get_post_meta($object_id, '_nasa_text_color_hover_topbar', true);
                $page_css .= elessi_get_style_topbar_color($bg_color, $text_color, $text_color_hover);
            }

            /**
             * color for main menu
             */
            $bg_color = get_post_meta($object_id, '_nasa_bg_color_main_menu', true);
            $bg_color_stk = get_post_meta($object_id, '_nasa_bg_color_main_menu_stk', true);
            $text_color = get_post_meta($object_id, '_nasa_text_color_main_menu', true);
            $text_color_stk = get_post_meta($object_id, '_nasa_text_color_main_menu_stk', true);
            $page_css .= elessi_get_style_main_menu_color($bg_color, $text_color, $bg_color_stk, $text_color_stk);
            
            /**
             * color for vertical menu
             */
            $bg_color = get_post_meta($object_id, '_nasa_bg_color_v_menu', true);
            $bg_color_stk = get_post_meta($object_id, '_nasa_bg_color_v_menu_stk', true);
            $text_color = get_post_meta($object_id, '_nasa_text_color_v_menu', true);
            $text_color_stk = get_post_meta($object_id, '_nasa_text_color_v_menu_stk', true);
            $page_css .= elessi_get_style_vertical_menu_color($bg_color, $text_color, $bg_color_stk, $text_color_stk);


            /**
             * color background shop and product - shop-background-color - mode
             */
            $page_css .= elessi_get_style_background_color_shop();

            /**
             * Add width to site
             */
            $max_width = '';
            $plus_option = get_post_meta($object_id, '_nasa_plus_wide_option', true);
            switch ($plus_option) {
                case '1':
                    $plus_width = get_post_meta($object_id, '_nasa_plus_wide_width', true);
                    break;

                case '-1':
                    $plus_width = 0;
                    break;

                case '':
                default :
                    $plus_width = '';
                    break;
            }
            
            if ($plus_width !== '' && (int) $plus_width >= 0) {
                $content_width = !isset($content_width) ? 1200 : $content_width;
                $max_width = ($content_width + (int) $plus_width);
            }
            
            $page_css .= elessi_get_style_plus_wide_width($max_width);
            
            echo $max_width ? '<meta name="nsmw-page" content="' . $max_width . '" />' : '';
            
            /**
             * Font style
             */
            $type_font_select = get_post_meta($object_id, '_nasa_type_font_select', true);
            
            $type_headings = '';
            $type_texts = '';
            $type_nav = '';
            $type_banner = '';
            $type_price = '';
            $custom_font = '';

            if ($type_font_select == 'google') {
                $type_headings = get_post_meta($object_id, '_nasa_type_headings', true);
                $type_texts = get_post_meta($object_id, '_nasa_type_texts', true);
                $type_nav = get_post_meta($object_id, '_nasa_type_nav', true);
                $type_banner = get_post_meta($object_id, '_nasa_type_banner', true);
                $type_price = get_post_meta($object_id, '_nasa_type_price', true);
            }

            if ($type_font_select == 'custom') {
                $custom_font = get_post_meta($object_id, '_nasa_custom_font', true);
            }
            
            $font_css = elessi_get_font_style(
                $type_font_select,
                $type_headings,
                $type_texts,
                $type_nav,
                $type_banner,
                $type_price,
                $custom_font,
                true
            );

            $dinamic_css = $color_primary_css . $page_css . $font_css;
            
            /**
             * Font-weight
             */
            $font_weight = get_post_meta($object_id, '_nasa_font_weight', true);
        }
        
        /**
         * Override primary color for root category product
         */
        else {
            $root_cat_id = elessi_get_root_term_id();
            
            if ($root_cat_id) {
                $color_primary = get_term_meta($root_cat_id, 'cat_primary_color', true);
                $color_primary_css .= $color_primary ? elessi_get_style_primary_color($color_primary) : '';
                
                /**
                 * Color for header
                 */
                $bg_color = get_term_meta($root_cat_id, 'cat_header_bg', true);
                $bg_color_stk = get_term_meta($root_cat_id, 'cat_header_bg_stk', true);
                $text_color = get_term_meta($root_cat_id, 'cat_header_text', true);
                $text_color_stk = get_term_meta($root_cat_id, 'cat_header_text_stk', true);
                $text_color_hover = get_term_meta($root_cat_id, 'cat_header_text_hv', true);
                $text_color_hover_stk = get_term_meta($root_cat_id, 'cat_header_text_hv_stk', true);
                $page_css .= elessi_get_style_header_color($bg_color, $text_color, $text_color_hover, $bg_color_stk, $text_color_stk, $text_color_hover_stk);
                
                /**
                 * color for top bar
                 */
                if (!isset($nasa_opt['topbar_on']) || $nasa_opt['topbar_on']) {
                    $bg_color = get_term_meta($root_cat_id, 'cat_topbar_bg', true);
                    $text_color = get_term_meta($root_cat_id, 'cat_topbar_text', true);
                    $text_color_hover = get_term_meta($root_cat_id, 'cat_topbar_text_hv', true);
                    $page_css .= elessi_get_style_topbar_color($bg_color, $text_color, $text_color_hover);
                }
                
                /**
                 * color for main menu
                 */
                $bg_color = get_term_meta($root_cat_id, 'cat_main_menu_bg', true);
                $bg_color_stk = get_term_meta($root_cat_id, 'cat_main_menu_bg', true);
                $text_color = get_term_meta($root_cat_id, 'cat_main_menu_text', true);
                $text_color_stk = get_term_meta($root_cat_id, 'cat_main_menu_text', true);
                $page_css .= elessi_get_style_main_menu_color($bg_color, $text_color, $bg_color_stk, $text_color_stk);

                /**
                 * color for vertical menu
                 */
                $bg_color = get_term_meta($root_cat_id, 'cat_v_menu_bg', true);
                $bg_color_stk = get_term_meta($root_cat_id, 'cat_v_menu_bg', true);
                $text_color = get_term_meta($root_cat_id, 'cat_v_menu_text', true);
                $text_color_stk = get_term_meta($root_cat_id, 'cat_v_menu_text', true);
                $page_css .= elessi_get_style_vertical_menu_color($bg_color, $text_color, $bg_color_stk, $text_color_stk);


                /**
                 * color background shop and product - shop-background-color - mode
                 */
                $page_css .= elessi_get_style_background_color_shop($root_cat_id);
                
                /**
                 * Add width to site
                 */
                $max_width = '';
                $plus_option = get_term_meta($root_cat_id, 'cat_width_more_allow', true);
                switch ($plus_option) {
                    case '1':
                        $plus_width = get_term_meta($root_cat_id, 'cat_width_more', true);
                        break;

                    case '-1':
                        $plus_width = 0;
                        break;

                    case '':
                    default :
                        $plus_width = '';
                        break;
                }

                if ($plus_width !== '' && (int) $plus_width >= 0) {
                    $content_width = !isset($content_width) ? 1200 : $content_width;
                    $max_width = ($content_width + (int) $plus_width);
                }
                
                $page_css .= elessi_get_style_plus_wide_width($max_width);
                
                echo $max_width ? '<meta name="nsmw-cat" content="' . $max_width . '" />' : '';
                
                /**
                 * Font style
                 */
                $type_font_select = get_term_meta($root_cat_id, 'type_font', true);
                
                $type_headings = '';
                $type_texts = '';
                $type_nav = '';
                $type_banner = '';
                $type_price = '';
                $custom_font = '';
                
                if ($type_font_select == 'google') {
                    $type_headings = get_term_meta($root_cat_id, 'headings_font', true);
                    $type_texts = get_term_meta($root_cat_id, 'texts_font', true);
                    $type_nav = get_term_meta($root_cat_id, 'nav_font', true);
                    $type_banner = get_term_meta($root_cat_id, 'banner_font', true);
                    $type_price = get_term_meta($root_cat_id, 'price_font', true);
                }
                
                if ($type_font_select == 'custom') {
                    $custom_font = get_term_meta($root_cat_id, 'custom_font', true);
                }
                
                $font_css = elessi_get_font_style(
                    $type_font_select,
                    $type_headings,
                    $type_texts,
                    $type_nav,
                    $type_banner,
                    $type_price,
                    $custom_font,
                    true
                );
                
                $dinamic_css = $color_primary_css . $page_css . $font_css;
                
                /**
                 * Font-weight
                 */
                $font_weight = get_term_meta($root_cat_id, 'font_weight', true);
            }
        }
        
        $prefix = elessi_prefix_theme();
        
        /**
         * Override Font weight
         */
        if ($font_weight != '') {
            wp_dequeue_style($prefix . '-style-font-weight');

            if (in_array($font_weight, array('800', '700', '600', '500'))) {
                wp_enqueue_style($prefix . '-font-weight-override', ELESSI_THEME_URI . '/assets/css/style-font-weight-' . $font_weight . '.css', array());
            }
        }
        
        /**
         * Css inline override
         */
        if ($dinamic_css != '') {
            wp_add_inline_style($prefix . '-style-dynamic', $dinamic_css);
        }
    }
endif;

if (!function_exists('elessi_get_style_background_color_shop')) :
    
    function elessi_get_style_background_color_shop($root_cat_id = '') {
        global $nasa_opt;

        $option_change_shop_layout = get_term_meta($root_cat_id, 'cat_change_shop_layout', true) != '' ? get_term_meta($root_cat_id, 'cat_change_shop_layout', true) : (isset($nasa_opt['option_change_shop_layout']) ? $nasa_opt['option_change_shop_layout'] : 'shop-default');
    
        if ($option_change_shop_layout == '' || $option_change_shop_layout !== 'shop-background-color') {
            return '';
        }

        $color_background_shop = get_term_meta($root_cat_id, 'cat_color_background_shop', true) != '' ? get_term_meta($root_cat_id, 'cat_color_background_shop', true) : (isset($nasa_opt['color_background_shop']) ? $nasa_opt['color_background_shop'] : '');

        $color_background_shop_pro = get_term_meta($root_cat_id, 'cat_color_background_shop_pro', true) != '' ? get_term_meta($root_cat_id, 'cat_color_background_shop_pro', true) : (isset($nasa_opt['color_background_shop_pro']) ? $nasa_opt['color_background_shop_pro'] : '');

        ob_start();
        ?><style><?php
        if ($color_background_shop_pro !== '') :
            ?>
            @media only screen and (min-width: 768px) {
                body .ns-shop-width-background .nasa-archive-product-content-bg .nasa-archive-product-content .nasa-content-page-products .product-item,
                body .nasa-archive-product-content-bg .nasa-modern-2 .product-item:after,
                body .nasa-archive-product-content-bg .nasa-modern-1 .product-item:after,
                body .nasa-modern-3 .product-item:after,
                body .nasa-modern-1 .nasa-product-content-nasa_label-wrap,
                body.nasa-dark .ns-shop-width-background .nasa-archive-product-content-bg .nasa-archive-product-content .nasa-content-page-products .product-item,
                body.nasa-dark .ns-shop-width-background .nasa-archive-product-content-bg .nasa-archive-product-content .nasa-content-page-products.nasa-modern-1 .product-item:after,
                body.nasa-dark .ns-shop-width-background .nasa-archive-product-content-bg .nasa-archive-product-content .nasa-content-page-products.nasa-modern-2 .product-item:after,
                body.nasa-dark .nasa-modern-1 .nasa-product-content-nasa_label-wrap {
                    background-color: <?php echo esc_attr(ucwords($color_background_shop_pro)); ?>;
                }
            }
            <?php
        endif; 

        if ($color_background_shop !== '') :
            ?>
            @media only screen and (min-width: 768px) {
                body .ns-shop-width-background .nasa-archive-product-content-bg,
                body.nasa-dark .ns-shop-width-background .nasa-archive-product-content-bg {
                    background-color: <?php echo esc_attr(ucwords($color_background_shop)); ?>;
                }
            }
            <?php
        endif; ?>
        </style>
        <?php
        $css = ob_get_clean();

        return elessi_convert_css($css);
    }
    
endif;
