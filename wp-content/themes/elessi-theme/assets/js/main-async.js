if (typeof _cookie_live === 'undefined') {
    var _cookie_live = 7;
}
var originalTitle = document.title;
var notificationInterval;
var currentMessageIndex = 0;

/* Document ready */
jQuery(document).ready(function ($) {
    "use strict";
    
    if (typeof _mobileView === 'undefined') {
        var _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
    }
    
    if (typeof _tabletView === 'undefined') {
        var _tabletView = $('.nasa-check-reponsive.nasa-tablet-check').length && $('.nasa-check-reponsive.nasa-tablet-check').width() === 1 ? true : false;
    }
    
    if (typeof _inMobile === 'undefined') {
        var _inMobile = $('body').hasClass('nasa-in-mobile') ? true : false;
    }

    if (typeof ns_now === 'undefined') {
        var ns_now = Date.now();
    }

    /**
     * Check if a node is blocked for processing.
     *
     * @param {JQuery Object} $node
     * @return {bool} True if the DOM Element is UI Blocked, false if not.
     */
    var nasa_is_blocked = function ($node) {
        return $node.is('.processing') || $node.parents('.processing').length;
    };

    /**
     * Block a node visually for processing.
     *
     * @param {JQuery Object} $node
     */
    var nasa_block = function ($node) {
        if (!nasa_is_blocked($node)) {
            var $color = $('body').hasClass('nasa-dark') ? '#000' : '#fff';

            $node.addClass('processing').block({
                message: null,
                overlayCSS: {
                    background: $color,
                    opacity: 0.6
                }
            });
        }
    };

    /**
     * Init menu mobile
     */
    $('body').on('click', '.nasa-mobile-menu_toggle', function () {
        $('body').trigger('nasa_append_style_mobile_menu');

        init_menu_mobile($);

        if ($('#mobile-navigation').length) {
            if ($('#mobile-navigation').attr('data-show') !== '1') {
                if ($('#nasa-menu-sidebar-content').hasClass('nasa-dark')) {
                    $('.black-window').addClass('nasa-transparent');
                }

                $('.black-window').show().addClass('desk-window');

                if (!$('body').hasClass('m-ovhd')) {
                    $('body').addClass('m-ovhd');
                }

                if ($('#nasa-menu-sidebar-content').length && !$('#nasa-menu-sidebar-content').hasClass('nasa-active')) {
                    $('#nasa-menu-sidebar-content').addClass('nasa-active');
                }

                $('#mobile-navigation').attr('data-show', '1');
            } else {
                $('.black-window').trigger('click');
            }
        }
    });

    $('body').on('click', '.nasa-close-menu-mobile, .nasa-close-sidebar', function () {
        $('.black-window').trigger('click');
    });

    /**
     * Accordion Mobile Menu
     */
    $('body').on('click', '.nasa-menu-accordion .li_accordion > a.accordion', function (e) {
        e.preventDefault();

        var _acc = $('.ns-sub-account').find('.li_accordion');
        var _this = $(this).parent();
        var _parent = $(_this).parent();

        if (!$(_this).hasClass('active')) {
            var _children = $(_parent).children('li.active');

            if ($(_acc).hasClass('active')) {
                $(_acc).find('>.nav-dropdown-mobile').slideUp(300).parent().removeClass('active');
            }

            $(_children).removeClass('active').children('.nav-dropdown-mobile').css({height: 'auto'}).slideUp(300);

            $(_this).children('.nav-dropdown-mobile').slideDown(300).parent().addClass('active');

            if ($(_acc).hasClass('active')) {
                $('.ns-sub-multilangs').find('.li_accordion >.nav-dropdown-mobile').slideUp(300).parent().removeClass('active');
            }
        } else {
            $(_this).find('>.nav-dropdown-mobile').slideUp(300).parent().removeClass('active');
        }

        return false;
    });

    /**
     * Accordion Element
     */
    $('body').on('click', '.nasa-accordion .li_accordion > a.accordion', function (e) {
        e.preventDefault();

        var _current = $(this);

        var _this = $(_current).parent();
        var _parent = $(_this).parent();

        if (!$(_this).hasClass('active')) {
            $(_parent).removeClass('nasa-current-tax-parent').removeClass('current-tax-item');
            var act = $(_parent).children('li.active');
            $(act).removeClass('active').children('.children').slideUp(300);
            $(_this).addClass('active').children('.children').slideDown(300);
        }

        else {
            $(_this).removeClass('active').children('.children').slideUp(300);
        }

        return false;
    });

    /**
     * Accordions
     */
    $('body').on('click', '.nasa-accordions-content .nasa-accordion-title a', function (e) {
        e.preventDefault();

        var _this = $(this);
        var warp = $(_this).parents('.nasa-accordions-content');

        $('body').trigger('nasa_check_template', [warp]);

        var _global = $(warp).hasClass('nasa-no-global') ? true : false;

        $(warp).removeClass('nasa-accodion-first-show');

        var _id = $(_this).attr('data-id');
        var _index = false;

        if (typeof _id === 'undefined' || !_id) {
            _index = $(_this).attr('data-index');
        }

        var _current = _index ? $(warp).find('.' + _index) : $(warp).find('#nasa-section-' + _id);

        if ($('.woocommerce-Reviews-layout').find('.masonry').length && $(_this).hasClass('nasa-accordion-reviews')) {
            if ($('.woocommerce-Reviews-layout').find('.masonry').hasClass('nasa-active')) {
                $('body').trigger('nasa_masonry_comments', [false, false, true]);
            }
        }

        if (!$(_this).hasClass('active')) {
            if (!_global) {
                $(warp).find('.nasa-accordion-title a').removeClass('active');
                $(warp).find('.nasa-panel.active').removeClass('active').slideUp(200);
            }

            $(_this).addClass('active');

            if ($(_current).length) {
                $(_current).addClass('active').slideDown(200);
            }
        } else {
            $(_this).removeClass('active');

            if ($(_current).length) {
                $(_current).removeClass('active').slideUp(200);
            }
        }

        return false;
    });
    
    /**
     * Tabs Content
     */
    $('body').on('click', '.nasa-tab a', function (e) {
        e.preventDefault();

        var _this = $(this);

        var _data_hash = null;

        /**
         * Scroll Hozinal tabable in mobile
         * @type type
         */
        var _ul = $(_this).parents('.nasa-tabs');
        if (!$('body').hasClass('nasa-rtl')) {
            if (!$(_ul).hasClass('nasa-slide-style')) {
                var _li = $(_this).parents('.nasa-tab'),
                    _first = $(_ul).find('.nasa-tab.first'),
                    _ul_w = $(_ul).width(),
                    _li_w = $(_li).width(),
                    _t_pos = $(_li).offset(),
                    _f_pos = $(_first).offset();

                $(_ul).animate({scrollLeft: _t_pos.left - _f_pos.left - (_ul_w - _li_w) / 2});
            }
        }

        var _this_li = $(_this).parents('.nasa-tab');
        var _root;

        if ($(_this_li).hasClass('nasa-single-product-tab')) {
            _root = $(_this).parents('.nasa-tabs-content.woocommerce-tabs'); // WooCommerce Tabs
        } else {
            _root = $(_this).parents('.nasa-tabs-content.nasa-wrap-all'); // WPB - Nasa Tabs
        }

        if ($(_root).length < 1) {
            _root = $(_this).parents('.nasa-tabs-content');
        }

        if ($(_root).length) {

            $('body').trigger('nasa_check_template', [_root]);

            if (!$(_this).parent().hasClass('active')) {
                var _panels = $(_root).find('> .nasa-panels');

                if ($(_panels).length < 1) {
                    _panels = $(_root).find('.nasa-panels');
                }

                _data_hash = $(_this).attr('data-hash');

                var currentTab = $(_this).attr('data-id');
                if (typeof currentTab === 'undefined' || !currentTab) {
                    var _index = $(_this).attr('data-index');
                    currentTab = $(_root).find('.' + _index);
                }

                $(_ul).find('li').removeClass('active');
                $(_this).parent().addClass('active');
                $(_panels).find('> .nasa-panel').removeClass('active');

                if ($(currentTab).length) {
                    $(currentTab).addClass('active');
                    $('body').trigger('nasa_after_changed_tab_content', [currentTab]);
                }

                if ($(_ul).hasClass('nasa-slide-style')) {
                    nasa_tab_slide_style($, _ul, 500);
                }
            }

            if (_data_hash && $('#nasa-single-product-ajax').length < 1 && $('.nasa-has-filter-ajax').length < 1) {
                window.location.hash = _data_hash;
            }
        }
    });
    
    /**
     * Show mini Cart sidebar
     */
    $('body').on('click', '.cart-link', function () {
        /**
         * For Checkout Page
         */
        if ($('body').hasClass('woocommerce-checkout') || $('form.woocommerce-checkout').length) {
            var _href = $(this).attr('href');
            window.location.href = _href;

            return false;
        }

        /**
         * For Others Page - Not Cart Page
         */
        if (!$('body').hasClass('woocommerce-cart') && $('form.woocommerce-cart-form').length <= 0) {
            $('.black-window').fadeIn(200).addClass('desk-window');

            if (!$('body').hasClass('m-ovhd')) {
                $('body').addClass('m-ovhd');
            }
            
            if ($('#cart-sidebar .cross-sells').length) {
                $('body').trigger('nasa_cross_sell_columns_setting', [$('#cart-sidebar .cross-sells').find('.nasa-slick-slider')]);
            }

            if ($('#cart-sidebar').length && !$('#cart-sidebar').hasClass('nasa-active')) {
                
                $('#cart-sidebar').addClass('nasa-active');

                if ($('#cart-sidebar').find('input[name="nasa-mini-cart-empty-content"]').length) {
                    $('#cart-sidebar').append('<div class="nasa-loader"></div>');

                    $('body').trigger('wc_fragment_refresh');
                }

                /**
                 * notification free shipping
                 */
                else {
                    init_shipping_free_notification($);
                }
            }

            $('body').trigger('nasa_opened_cart_sidebar');

            if ($('.nasa-close-notice').length) {
                $('.nasa-close-notice').trigger('click');
            }

            $('body').trigger('mini_cart_mobile_layout_change');
        }

        return false;
    });

    /**
     * Compatible elementor toggle button cart sidebar
     */
    $('body').on('click', '#elementor-menu-cart__toggle_button', function () {
        if ($('.elementor-menu-cart__container .elementor-menu-cart__main').length) {
            $('.elementor-menu-cart__container').remove();
        }

        if (!$(this).hasClass('cart-link')) {
            $(this).addClass('cart-link');
            $(this).trigger('click');
        }
    });
    
    /**
     * Compare products
     */
    $('body').on('click', '.btn-compare', function () {
        if ($('.nasa-close-notice').length) {
            $('.nasa-close-notice').trigger('click');
        }

        var _this = $(this);
        if (!$(_this).hasClass('nasa-compare')) {
            var _button = $(_this).parent();
            if ($(_button).find('.compare-button .compare').length) {
                $(_button).find('.compare-button .compare').trigger('click');
            }
        } else {
            var _id = $(_this).attr('data-prod');
            if (_id) {
                add_compare_product(_id, $);
            }
        }

        return false;
    });

    /**
     * Remove item from Compare
     */
    $('body').on('click', '.nasa-remove-compare', function () {
        if ($('.nasa-close-notice').length) {
            $('.nasa-close-notice').trigger('click');
        }

        var _id = $(this).attr('data-prod');
        if (_id) {
            remove_compare_product(_id, $);
        }

        return false;
    });

    /**
     * Remove All items from Compare
     */
    $('body').on('click', '.nasa-compare-clear-all', function () {
        if ($('.nasa-close-notice').length) {
            $('.nasa-close-notice').trigger('click');
        }

        remove_all_compare_product($);

        return false;
    });

    /**
     * Show Compare
     */
    $('body').on('click', '.nasa-show-compare', function () {
        if ($('.nasa-close-notice').length) {
            $('.nasa-close-notice').trigger('click');
        }

        if (!$(this).hasClass('nasa-showed')) {
            show_compare($);
        } else {
            hide_compare($);
        }

        load_compare($);

        $('body').trigger('nasa_after_clicked');

        return false;
    });
    
    /**
     * Wishlist icon open sidebar
     */
    $('body').on('click', '.wishlist-link', function () {
        if (!$(this).hasClass('ns-mini-yith-wcwl')) {
            /**
             * Append stylesheet Off Canvas
             */
            $('body').trigger('nasa_append_style_off_canvas');

            if ($('.nasa-close-notice').length) {
                $('.nasa-close-notice').trigger('click');
            }

            load_wishlist($);
        
            $('.black-window').fadeIn(200).addClass('desk-window');

            if (!$('body').hasClass('m-ovhd')) {
                $('body').addClass('m-ovhd');
            }

            if ($('#nasa-wishlist-sidebar').length && !$('#nasa-wishlist-sidebar').hasClass('nasa-active')) {
                $('#nasa-wishlist-sidebar').addClass('nasa-active');
            }

            $('body').trigger('nasa_after_clicked');
        } else {
            var _href = $(this).attr('href');
            window.location.href = _href;
        }
        
        return false;
    });

    /**
     * Wishlist products
     */
    $('body').on('click', '.btn-wishlist', function () {
        if ($('.nasa-close-notice').length) {
            $('.nasa-close-notice').trigger('click');
        }

        var _this = $(this);
        if (!$(_this).hasClass('nasa-disabled')) {
            
            /**
             * NasaTheme Wishlist
             */
            if ($(_this).hasClass('btn-nasa-wishlist')) {
                $('.btn-wishlist').addClass('nasa-disabled');
                
                var _pid = $(_this).attr('data-prod');

                if (!$(_this).hasClass('nasa-added')) {
                    $(_this).addClass('nasa-added');
                    $(_this).find('.nasa-tip-content').text($(_this).attr('data-added'));
                    nasa_process_wishlist($, _pid, 'nasa_add_to_wishlist');
                    $(_this).find(".nasa-icon-text-wrap").animate({ scrollTop: 24 }, 400);
                } else {
                    $(_this).removeClass('nasa-added');
                    $(_this).find('.nasa-tip-content').text($(_this).attr('data-icon-text'));
                    nasa_process_wishlist($, _pid, 'nasa_remove_from_wishlist');
                    $(_this).find(".nasa-icon-text-wrap").animate({ scrollTop: 0 }, 400);
                }
            }

            /**
             * Yith WooCommerce Wishlist
             */
            else {
                if (!$(_this).hasClass('nasa-added')) {
                    $(_this).addClass('nasa-added');
                }
                
                if ($('#tmpl-nasa-global-wishlist').length) {
                    var _pid = $(_this).attr('data-prod');
                    var _origin_id = $(_this).attr('data-original-product-id');
                    var _ptype = $(_this).attr('data-prod_type');
                    var _wishlist_tpl = $('#tmpl-nasa-global-wishlist').html();
                    if ($('.nasa-global-wishlist').length <= 0) {
                        $('body').append('<div class="nasa-global-wishlist"></div>');
                    }

                    _wishlist_tpl = _wishlist_tpl.replace(/%%product_id%%/g, _pid);
                    _wishlist_tpl = _wishlist_tpl.replace(/%%product_type%%/g, _ptype);
                    _wishlist_tpl = _wishlist_tpl.replace(/%%original_product_id%%/g, _origin_id);

                    $('.nasa-global-wishlist').html(_wishlist_tpl);
                    $('.nasa-global-wishlist').find('.add_to_wishlist').trigger('click');
                } else {
                    var _button = $(_this).parent();
                    if ($(_button).find('.add_to_wishlist').length) {
                        $(_button).find('.add_to_wishlist').trigger('click');
                    }
                }
            }
        }

        return false;
    });
    
    /* REMOVE PRODUCT WISHLIST NUMBER */
    $('body').on('click', '.nasa-remove_from_wishlist', function () {
        if (typeof nasa_ajax_params !== 'undefined' && typeof nasa_ajax_params.ajax_url !== 'undefined') {
            var _wrap_item = $(this).parents('.nasa-tr-wishlist-item');
            if ($(_wrap_item).length) {
                $(_wrap_item).css({opacity: 0.3});
            }

            /**
             * Support Yith WooCommercen Wishlist
             */
            if (!$(this).hasClass('btn-nasa-wishlist')) {
                var _data = {};
                _data.action = 'nasa_remove_from_wishlist';

                if ($('.nasa-value-gets').length && $('.nasa-value-gets').find('input').length) {
                    $('.nasa-value-gets').find('input').each(function () {
                        var _key = $(this).attr('name');
                        var _val = $(this).val();
                        _data[_key] = _val;
                    });
                }

                var _pid = $(this).attr('data-prod_id');
                _data.remove_from_wishlist = _pid;
                _data.wishlist_id = $('.wishlist_table').attr('data-id');
                _data.pagination = $('.wishlist_table').attr('data-pagination');
                _data.per_page = $('.wishlist_table').attr('data-per-page');
                _data.current_page = $('.wishlist_table').attr('data-page');

                $.ajax({
                    url: nasa_ajax_params.ajax_url,
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    data: _data,
                    beforeSend: function () {
                        /**
                         * Close Magnific
                         */
                        $('body').trigger('ns_magnific_popup_close');
                    },
                    success: function (res) {
                        if (res.error === '0') {
                            $('.wishlist_sidebar').replaceWith(res.list);
                            var _sl_wishlist = (res.count).toString().replace('+', '');
                            var sl_wislist = parseInt(_sl_wishlist);
                            $('.nasa-mini-number.wishlist-number').html(res.count);
                            if (sl_wislist > 0) {
                                $('.wishlist-number').removeClass('nasa-product-empty');
                            } else if (sl_wislist === 0 && !$('.nasa-mini-number.wishlist-number').hasClass('nasa-product-empty')) {
                                $('.nasa-mini-number.wishlist-number').addClass('nasa-product-empty');
                                $('.black-window').trigger('click');
                            }

                            if ($('.btn-wishlist[data-prod="' + _pid + '"]').length) {
                                $('.btn-wishlist[data-prod="' + _pid + '"]').removeClass('nasa-added');

                                if ($('.btn-wishlist[data-prod="' + _pid + '"]').find('.added').length) {
                                    $('.btn-wishlist[data-prod="' + _pid + '"]').find('.added').removeClass('added');
                                }
                            }
                            
                            if ($('.add-to-wishlist-' + _pid).length) {
                                $('.add-to-wishlist-' + _pid).removeClass('exists');
                            }

                            if ($('#yith-wcwl-popup-message').length && typeof res.mess !== 'undefined' && res.mess !== '') {
                                if ($('.nasa-close-notice').length) {
                                    $('.nasa-close-notice').trigger('click');
                                }

                                $('#yith-wcwl-popup-message').html(res.mess);

                                $('#yith-wcwl-popup-message').fadeIn();
                                setTimeout(function () {
                                    $('#yith-wcwl-popup-message').fadeOut();
                                }, 2000);
                            }
                        }

                        $('.btn-wishlist').removeClass('nasa-disabled');
                    },
                    error: function () {
                        $('.btn-wishlist').removeClass('nasa-disabled');
                    }
                });
            }
        }

        return false;
    });
    
    /**
     * Single add to cart from wishlist
     */
    $('body').on('click', '.nasa_add_to_cart_from_wishlist', function () {
        var _this = $(this),
            _id = $(_this).attr('data-product_id');
        if (_id && !$(_this).hasClass('loading')) {
            var _type = $(_this).attr('data-type'),
                _quantity = $(_this).attr('data-quantity'),
                _data_wishlist = {};

            if ($('.wishlist_table').length && $('.wishlist_table').find('#yith-wcwl-row-' + _id).length) {
                _data_wishlist = {
                    from_wishlist: '1',
                    wishlist_id: $('.wishlist_table').attr('data-id'),
                    pagination: $('.wishlist_table').attr('data-pagination'),
                    per_page: $('.wishlist_table').attr('data-per-page'),
                    current_page: $('.wishlist_table').attr('data-page')
                };
            }

            $('body').trigger('nasa_single_add_to_cart', [_this, _id, _quantity, _type, null, null, _data_wishlist]);
        }

        return false;
    });
    
    /**
     * After Quick view
     */
    $('body').on('nasa_after_quickview_timeout', function (e) {
        init_accordion($);

        /**
         * VC Progress bar
         */
        if ($('.product-lightbox .vc_progress_bar .vc_bar').length) {
            $('.product-lightbox .vc_progress_bar .vc_bar').each(function () {
                var _this = $(this);
                var _per = $(_this).attr('data-percentage-value');
                $(_this).css({'width': _per + '%'});
            });
        }

        e.preventDefault();
    });
    
    /**
     * Change Countdown for variation - Quick view
     */
    $('body').on('nasa_changed_countdown_variable_single', function (e) {
        $('body').trigger('nasa_load_countdown');

        e.preventDefault();
    });
    
    /**
     * Viewed Sidebar
     */
    $('body').on('click', '#nasa-init-viewed', function () {
        $('.black-window').fadeIn(200).addClass('desk-window');

        if (!$('body').hasClass('m-ovhd')) {
            $('body').addClass('m-ovhd');
        }

        if ($('#nasa-viewed-sidebar').length && !$('#nasa-viewed-sidebar').hasClass('nasa-active')) {
            $('#nasa-viewed-sidebar').addClass('nasa-active');
        }
    });
    
    /**
     * click popup-cart-close, .popup-cart-bg-close
     */
    $('body').on('click', '.popup-cart-close, .popup-cart-bg-close', function (e) {
        var _this = this;
        var _pr_item = $(_this).parents('.ns-cart-popup-wrap');

        $(_pr_item).addClass('ns-left-to-right');
        $('.black-window').fadeOut(600).removeClass('desk-window');
        $('body').removeClass('ovhd');
        
        setTimeout(function () {
            $(_pr_item).removeClass('ns-left-to-right nasa-active').hide();
            $(_pr_item).find('.ns-cross-sell-lazy').removeClass('nasa-active').html('');
        }, 350);

        e.preventDefault();
    });

    /**
     * click nasa-quickview-popup-close
     */
    $('body').on('click', '.nasa-quickview-popup-close', function (e) {
        var _this = this;
        var _pr_item = $(_this).parents('#nasa-quickview-popup');
        
        $(_pr_item).addClass('ns-left-to-right');
        $('.black-window').fadeOut(600).removeClass('desk-window');
        $('body').removeClass('ovhd');
        
        if (typeof setMaxHeightQVPU !== 'undefined') {
            clearInterval(setMaxHeightQVPU);
        }
                            
        setTimeout(function () {
            $(_pr_item).removeClass('ns-left-to-right nasa-active').hide();
        }, 350);

        e.preventDefault();
    });

    /**
     * Update Quantity mini cart
     */
    $('body').on('change', '.mini-cart-item .qty', function (e) {
        if (
            typeof nasa_ajax_params !== 'undefined' &&
            typeof nasa_ajax_params.wc_ajax_url !== 'undefined'
        ) {
            var _urlAjax = nasa_ajax_params.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_quantity_mini_cart');
            var _input = $(this);
            var _wrap = $(_input).parents('.mini-cart-item');
            var _hash = $(_input).attr('name').replace(/cart\[([\w]+)\]\[qty\]/g, "$1");
            var _max = parseFloat($(_input).attr('max'));
            var _id_pro = $(_wrap).attr('data-id-var-product');
            if (!_max) {
                _max = false;
            }

            var _quantity = parseFloat($(_input).val());

            var _old_val = parseFloat($(_input).attr('data-old'));
            if (!_old_val) {
                _old_val = _quantity;
            }

            if (_max > 0 && _quantity > _max) {
                $(_input).val(_max);
                _quantity = _max;
            }

            if (_old_val !== _quantity) {
                var _confirm = true;

                if (_quantity <= 0) {
                    var _confirm_text = $('input[name="nasa_change_value_0"]').length ? $('input[name="nasa_change_value_0"]').val() : 'Are you sure you want to remove it?';
                    _confirm = confirm(_confirm_text);
                    
                    if (_confirm) {
                        if($(_wrap).parents('.ns-cart-popup-v2').length) {
                            $('.popup-cart-bg-close').trigger('click');
                        } else {
                            $('body').trigger('animate_remove_from_mini_cart_wishlist',[_wrap,1]);
                        }
                    }
                }

                if (_confirm) {
                    $.ajax({
                        url: _urlAjax,
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: {
                            hash: _hash,
                            quantity: _quantity,
                            product_id_qty: _id_pro
                        },
                        beforeSend: function () {
                            if (!$(_wrap).hasClass('nasa-loading')) {
                                $(_wrap).addClass('nasa-loading');
                            }

                            if (!$(_wrap).parents('.widget_shopping_cart_content').hasClass('nasa-loading')) {
                                $(_wrap).parents('.widget_shopping_cart_content').addClass('nasa-loading');
                            }

                            if ($(_wrap).parents('.widget_shopping_cart_content_popup_v2').length) {
                                $(_wrap).parents('.widget_shopping_cart_content_popup_v2').find('.nasa-minicart-footer').addClass('nasa-loading');
                            }
                        },
                        success: function (data) {
                            if (data && data.fragments) {
                                $.each(data.fragments, function (key, value) {
                                    if ($(key).length) {
                                        $(key).replaceWith(value);
                                    }
                                });

                                $('body').trigger('wc_fragments_refreshed');
                                $('body').trigger('updated_data_mini_cart');
                                $('body').trigger('get_content_popup_v2', [false]);
                                $('body').trigger('wc_fragments_loaded');
                            }

                            $('#cart-sidebar').find('.nasa-loader').remove();
                        },
                        error: function () {
                            $(document.body).trigger('wc_fragments_ajax_error');
                            $('#cart-sidebar').find('.nasa-loader').remove();
                            $('#cart-sidebar').find('.nasa-loading').removeClass('nasa-loading');
                        }
                    });
                } else {
                    $(_input).val(_old_val);
                }
            }
        }

        e.preventDefault();
    });

    /**
     * 
    */

    $('body').on('change', '.product-item.nasa-modern-8-var-active .ns-modern-8-variations_button .quantity .qty', function (e){
        
        var _ns_variations_button = $(this).parents('.ns-modern-8-variations_button'),
            _add_btn = $(_ns_variations_button).find('.add_to_cart_button'),
            _quantity = $(this).val();

        $(_add_btn).attr('data-quantity',_quantity);
    });
    
    /**
     * Toggle Widget
     */
    $('body').on('click', '.nasa-toggle-widget', function (e) {
        var _this = $(this);
        var _widget = $(_this).parents('.widget');
        var _key = $(_widget).attr('id');

        if ($(_widget).length && $(_widget).find('.nasa-open-toggle').length) {
            var _hide = $(_this).hasClass('nasa-hide');
            if (!_hide) {
                $(_this).addClass('nasa-hide');
                $(_widget).find('.nasa-open-toggle').slideUp(200);
                $.cookie(_key, 'hide', {expires: _cookie_live, path: '/'});
            } else {
                $(_this).removeClass('nasa-hide');
                $(_widget).find('.nasa-open-toggle').slideDown(200);
                $.cookie(_key, 'show', {expires: _cookie_live, path: '/'});
            }
        }

        e.preventDefault();
    });

    /**
     * Close Notices
     */
    $('body').on('click', '.woocommerce-notices-wrapper .nasa-close-notice', function (e) {
        var _notices = $(this).parents('.woocommerce-notices-wrapper');
        $(_notices).html('');

        e.preventDefault();
    });

    /**
     * Close Canvas
     */
    $('body').on('click', '.nasa-close-canvas', function () {
        var _wrap = $(this).parents('.canvas-wrap');
        if ($(_wrap).length) {
            $(_wrap).removeClass('nasa-active');
        }

        $('body').removeClass('ovhd');
        $('body').removeClass('m-ovhd');
    });
    
    /**
     * Gallery images in Product item - grid
     */
    $('body').on('nasa_loop_gallery_carousel', '.product-img.loop-gallery-carousel:not(.inited)', function () {
        var _this = $(this);
        $(_this).addClass('inited');

        var _gellery = $(_this).attr('data-gellery');

        var _imgs = _gellery ? JSON.parse(_gellery) : [];

        if (_imgs.length) {
            var _wrap = $(_this).find('.main-img');

            var _first = $(_wrap).find('img').clone();

            $(_wrap).html('');
            $(_wrap).append(_first);

            $(_wrap).addClass('nasa-slick-slider nasa-slick-nav nasa-nav-inside');
            $(_wrap).attr('data-columns', '1');
            $(_wrap).attr('data-columns-small', '1');
            $(_wrap).attr('data-columns-tablet', '1');
            $(_wrap).attr('data-dot', 'false');
            $(_wrap).attr('data-disable-drag', 'true');

            for (var i = 0; i < _imgs.length; i++) {
                var _img = _imgs[i];

                $(_wrap).append('<img width="' + _img.w + '" height="' + _img.h + '" src="' + _img.src + '" />');
            }

            $('body').trigger('nasa_load_slick_slider');
        }
    });
    
    /**
     * Hover product-item in Mobile
     */
    $('body').on("touchstart", '.product-item', function () {
        $('.product-item').removeClass('nasa-mobile-hover');

        if (!$(this).hasClass('nasa-mobile-hover')) {
            $(this).addClass('nasa-mobile-hover');
        }

        if ($(this).find('.product-img.loop-gallery-carousel:not(.inited)').length) {
            $(this).find('.product-img.loop-gallery-carousel:not(.inited)').trigger('nasa_loop_gallery_carousel');
        }
    });

    $('body').on("mouseover", '.product-item', function () {
        if ($(this).find('.product-img.loop-gallery-carousel:not(.inited)').length) {
            $(this).find('.product-img.loop-gallery-carousel:not(.inited)').trigger('nasa_loop_gallery_carousel');
        }

        if ($(this).parents('.nasa-modern-2') && $(this).find('.add-to-cart-grid').length && !$(this).hasClass('has-add')) {
            $(this).addClass('has-add');
        }
    });
    
    /**
     * Remove title attribute of menu item
     */
    $('body').on('mousemove', '.menu-item > a', function () {
        if ($(this).attr('title')) {
            $(this).removeAttr('title');
        }
    });
    
    /**
     * For Main menu
     * Scroll by mouse wheel
     */
    /* $('body').on('wheel', '.nav-wrapper', function(e) {
        e.preventDefault();
        var scrollAmount = e.originalEvent.deltaY;
        
        // RTL Mode
        if ($('body').hasClass('nasa-rtl')) {
            this.scrollLeft -= scrollAmount;
        } else {
            this.scrollLeft += scrollAmount;
        }
    });

    // position center when hover
    $('body').on('hover', '#site-navigation > li', function() {
        var _this = $(this);
        var _wrap = $(_this).parents('.nav-wrapper');
        var wrapperWidth = $(_wrap).width();
        var menuWidth = $('.menu').width();
        var itemOffset = $(_this).offset().left - $(_wrap).offset().left;
        var itemWidth = $(_this).outerWidth();
        
        // Calc space item to center
        var scrollPos;
        
        // RTL Mode
        if ($('body').hasClass('nasa-rtl')) {
            scrollPos = itemOffset - (wrapperWidth / 2) + (itemWidth / 2);
            scrollPos = (menuWidth - wrapperWidth) - scrollPos;
        } else {
            scrollPos = itemOffset - (wrapperWidth / 2) + (itemWidth / 2);
        }

        // Limit scroll do not go to outsite menu
        if (scrollPos < 0) {
            scrollPos = 0;
        }
        
        if (scrollPos + wrapperWidth > menuWidth) {
            scrollPos = menuWidth - wrapperWidth;
        }

        // scroll to center with item
        $(_wrap).animate({scrollLeft: scrollPos}, 300);
    }); */

    /**
     * Captcha register form
     */
    if ($('#tmpl-captcha-field-register').length) {
        $('body').on('click', '.nasa-reload-captcha', function (e) {
            var _time = $(this).attr('data-time');
            var _key = $(this).attr('data-key');
            _time = parseInt(_time) + 1;
            $(this).attr('data-time', _time);
            var _form = $(this).parents('form');
            $(_form).find('.nasa-img-captcha').attr('src', '?nasa-captcha-register=' + _key + '&time=' + _time);

            e.preventDefault();
        });

        var _count_captcha;
        if ($('.nasa-reload-captcha').length) {
            _count_captcha = parseInt($('.nasa-reload-captcha').first().attr('data-key'));
        } else {
            _count_captcha = 0;
        }

        var _captcha_row = $('#tmpl-captcha-field-register').html();
        if (_captcha_row) {
            $('.nasa-form-row-captcha').each(function () {
                _count_captcha = _count_captcha + 1;
                var _row = _captcha_row.replace(/{{key}}/g, _count_captcha);
                $(this).replaceWith(_row);
            });
        }

        $('body').on('nasa_after_load_static_content nasa_login_register_ajax_inited', function (e) {
            if ($('.nasa-form-row-captcha').length) {
                if ($('.nasa-reload-captcha').length) {
                    _count_captcha = parseInt($('.nasa-reload-captcha').first().attr('data-key'));
                } else {
                    _count_captcha = 0;
                }

                $('.nasa-form-row-captcha').each(function () {
                    _count_captcha = _count_captcha + 1;
                    var _row = _captcha_row.replace(/{{key}}/g, _count_captcha);
                    $(this).replaceWith(_row);
                });
            }

            e.preventDefault();
        });

        $('body').on('nasa_after_process_register', function (e) {
            if ($('.nasa_register-form').find('.nasa-error').length) {
                $('.nasa_register-form').find('.nasa-reload-captcha').trigger('click');
                $('.nasa_register-form').find('.nasa-text-captcha').val('');
            }

            e.preventDefault();
        });
    }
    
    /**
     * Back to Top
     */
    $('body').on('click', '#nasa-back-to-top', function (e) {
        $('html, body').animate({scrollTop: 0}, 800);

        e.preventDefault();
    });

    /**
     * where you are
     */
    $('body').on('click', '#nasa-where-you-are', function (e) {
        var _pa = $('.nasa-static-group-btn');

        if ($('.nasa-where-you-are-wrap').length <= 0) {
            $(_pa).after('<div class="nasa-where-you-are-wrap"><a class="nasa-close-site-map nasa-stclose" href="javascript:void(0);"></a><div class="nasa-loader"></div></div>');
        } else {
            $('.nasa-where-you-are-wrap').html('<a class="nasa-close-site-map nasa-stclose" href="javascript:void(0);"></a><div class="nasa-loader"></div>');
        }  

        $('body').addClass('ovhd');

        setTimeout(function() {
            var _wrap = $('.nasa-where-you-are-wrap');

            $(_wrap).addClass('nasa-active');            
            if (
                typeof nasa_ajax_params !== 'undefined' &&
                typeof nasa_ajax_params.wc_ajax_url !== 'undefined'
            ) {
                var _urlAjax = nasa_ajax_params.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_get_site_map_and_located');
                $.ajax({
                    url: _urlAjax,
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {
    
                    },
                    success: function (data) {
                        if (data.success == 1) {

                            var url = window.location.origin + window.location.pathname;
                            $(_wrap).html(data.content);
                            var _current =  $(_wrap).find('a[href="' + url + '"]:not(.logo)');
                            var _svg = '<svg width="32" height="32" viewBox="0 0 22 32"><path d="M11.001 0.006c-5.889 0-10.663 4.775-10.663 10.663 0 1.945 0.523 3.762 1.432 5.332l9.23 15.994 9.23-15.994c0.909-1.57 1.432-3.387 1.432-5.332 0-5.888-4.774-10.663-10.662-10.663zM11.001 13.334c-1.472 0-2.666-1.193-2.666-2.665 0-1.471 1.194-2.665 2.666-2.665s2.665 1.194 2.665 2.665c0 1.472-1.193 2.665-2.665 2.665z" fill="currentColor"/></svg>';

                            if ($(_current).length) {
                                $(_current).parent().addClass('current-menu-item');
                                $(_current).append(_svg);
                            }

                            var _cur = $(_wrap).find('.current-menu-item');

                            $(_cur).each(function() {
                                if ($(this).find('.current-menu-item').length) {
                                    $(this).removeClass('current-menu-item');
                                    $(this).find('>a svg').remove();
                                }
                            });
                        }
                    },
                    error: function () {
                        
                    }
                });
            } 
        }, 20);
        
        e.preventDefault();
    });

    $('body').on('click', '.nasa-close-site-map', function () {
        $('.nasa-where-you-are-wrap').removeClass('nasa-active');
        $('body').removeClass('ovhd');

    });

    var touchstart = 0,
        touchend = 0,
        distance = 60;

    // swipe horizontal to close 
    $('body').on('touchstart', '#cart-sidebar, #nasa-wishlist-sidebar, #nasa-viewed-sidebar, #nasa-quickview-sidebar, #nasa-menu-sidebar-content, .nasa-top-cat-filter-wrap-mobile, .nasa-top-sidebar, .account-nav-wrap.vertical-tabs', function (e) {
        if (!$(e.target).hasClass('slick-active') && !$(e.target).parents('.nasa-slick-slider').length) {
            touchstart = e.touches[0].clientX;
        }
    });

    $('body').on('touchend', '#cart-sidebar, #nasa-wishlist-sidebar, #nasa-viewed-sidebar, #nasa-quickview-sidebar', function (e) {
        touchend = e.changedTouches[0].clientX;

        if (touchstart != touchend && touchstart != 0 && Math.abs(touchstart - touchend) > distance) {
            if (touchstart > touchend) {
                if ($('body').hasClass('nasa-rtl')) {
                    $('.black-window').trigger('click');
                }
            } else {
                if (!$('body').hasClass('nasa-rtl')) {
                    $('.black-window').trigger('click');
                }
            }
        }

        touchend = 0;
        touchstart = 0;
    });

    $('body').on('touchend', '#nasa-menu-sidebar-content, .nasa-top-cat-filter-wrap-mobile, .nasa-top-sidebar, .account-nav-wrap.vertical-tabs', function (e) {
        touchend = e.changedTouches[0].clientX;

        if (touchstart != touchend && touchstart != 0 && Math.abs(touchstart - touchend) > distance) {
            if (touchstart > touchend) {
                if (!$('body').hasClass('nasa-rtl')) {
                    $('.black-window').trigger('click');
                }
            } else {
                if ($('body').hasClass('nasa-rtl')) {
                    $('.black-window').trigger('click');
                }
            }
        }

        touchend = 0;
        touchstart = 0;
    });

    // swipe vertical to close 
    $('body').on('touchstart', '.warpper-mobile-search, .nasa-login-register-warper, .nasa-compare-list-bottom', function (e) {
        var scrollTop = $(this).scrollTop();

        if ($(e.target).parents('.nasa-login-register-warper').length || $(e.target).hasClass('nasa-login-register-warper')) {
            scrollTop = $(this).scrollTop();
            if (scrollTop <= 0) {
                touchstart = e.touches[0].clientY;
            }
        } else {
            if (!$(e.target).parents('.item-search').length) {
                touchstart = e.touches[0].clientY;
                // console.log($(e.target).attr('class'));
            }
        }
    });

    // swipe up
    $('body').on('touchend', '.warpper-mobile-search', function (e) {
        touchend = e.changedTouches[0].clientY;

        if (touchstart != touchend && touchstart != 0 && Math.abs(touchstart - touchend) > distance) {
            if (touchstart > touchend) {
                $('.black-window').trigger('click');
            }
        }

        touchend = 0;
        touchstart = 0;
    });

    // swipe down
    $('body').on('touchend', '.nasa-login-register-warper, .nasa-compare-list-bottom', function (e) {
        touchend = e.changedTouches[0].clientY;
        
        if (touchstart != touchend && touchstart != 0 && Math.abs(touchstart - touchend) > distance) {
            if (touchstart < touchend) {
                $('.black-window').trigger('click');
            }
        }

        touchend = 0;
        touchstart = 0;
    });

    //Remove title in product item 
    $('body').on('mouseover', '.product-item, .item-product-widget', function () {
        $(this).find('.product-img, .name, .nasa-widget-img, .product-title').removeAttr('title');
    });

    // show password in login and register
    $('body').on('click', '.ns-show-password', function () {
        var _input = $(this).parents('.form-row').find('.woocommerce-Input');
        if ($(this).hasClass('ns-pass-show')) {
            $(_input).attr('type', 'password');
            $(this).removeClass('ns-pass-show');
        } else {
            $(_input).attr('type', 'text');
            $(this).addClass('ns-pass-show');
        }
    });

    $('body').on('get_content_popup_v2', function (e, reload_cross) {
        if ($('.ns-cart-popup-wrap .ns-cart-popup-v2').length) {
            var _id = $('.ns-cart-popup-wrap .widget_shopping_cart_content_popup_v2 .ns_total_item').attr('data-id-just-added');
            var _minicart_total_checkout = $('#cart-sidebar .minicart_total_checkout').clone();
            var _btn_mini_cart = $('#cart-sidebar .btn-mini-cart').clone();
            var _popup_footer = $('.ns-cart-popup-wrap .ns-cart-popup-v2 .nasa-minicart-footer');
            
            var _woo_mini_cart = $('.ns-cart-popup-wrap .ns-cart-popup-v2 .nasa-minicart-items .woocommerce-mini-cart');
            var _items_add = '';

            $('#cart-sidebar .woocommerce-mini-cart-item').each(function () {
                if ($(this).attr('data-id-var-product') == _id) {
                    
                    var _data_variation = $('#cart-sidebar').attr('data-variation-product-adding');

                    if (_data_variation != null && $(this).attr('data-variation-product') == _data_variation) {
                        var _clone = $(this).clone();
                        $(_clone).find('.nasa-info-cart-item').removeClass('padding-left-15 rtl-padding-right-15').addClass('padding-left-20 rtl-padding-right-20');
                        
                        // $(_clone).addClass('ns-item-loading');
                        _items_add += $(_clone).wrap('<div />').parent().html();
                        // $(_woo_mini_cart).append($(_clone));
                    }
                }
            });

            $(_popup_footer).find('.minicart_total_checkout').remove();
            $(_popup_footer).find('.btn-mini-cart').remove();
            $(_popup_footer).removeClass('nasa-loading');
            
            $('.ns-cart-popup-wrap').removeClass('crazy-loading');
            $(_minicart_total_checkout).find('.nasa-total-condition').removeClass('nasa-active');

            $(_popup_footer).append($(_minicart_total_checkout));
            $(_popup_footer).append($(_btn_mini_cart));

            $(_woo_mini_cart).find('>div:not(.popup2-minicart-items-mask)').remove();
            $(_woo_mini_cart).append(_items_add);
            
            init_shipping_free_notification($, true);

            if ($('.ns-cart-popup-wrap .woocommerce-mini-cart-item').length <= 0 && $('.ns-cart-popup-wrap').hasClass('nasa-active')) {
                $('.popup-cart-bg-close').trigger('click');
                reload_cross = false;
            }
            
            $('body').trigger('nasa_get_cross_sell', [$('.ns-cart-popup-container'), reload_cross]);
            
            $('.ns-cart-popup-wrap .product-remove').remove();
            $('.ns-cart-popup-wrap .quantity .qty').attr({'id':''});
        }
    });

    $('body').on('mini_cart_mobile_layout_change', function() {
        var _side_bar = $('#cart-sidebar');
        var _cart_footer = $(_side_bar).find('.nasa-minicart-footer');
        var _total = $(_cart_footer).find('.minicart_total_checkout .total-cart-wrap');

        if ($(_cart_footer).hasClass('mini_cart_mobile_view_hidden') && $('body').hasClass('nasa-in-mobile')) {
            $(_cart_footer).find('.btn-mini-cart .woocommerce-mini-cart__buttons').prepend($(_total));
        }
    });
    
    $('body').on('click', '.remove_from_cart_popup', function (e) {
        if (!$(this).hasClass('loading')) {
            $(this).addClass('loading');
            nasa_block($('.nasa-after-add-to-cart-wrap'));

            var _id = $(this).attr('data-product_id');
            if ($('.widget_shopping_cart_content .remove_from_cart_button[data-product_id="' + _id + '"]').length) {
                $('.widget_shopping_cart_content .remove_from_cart_button[data-product_id="' + _id + '"]').trigger('click');
            } else {
                window.location.href = $(this).attt('href');
            }
        }

        e.preventDefault();
    });

    /**
     * Removed from cart
     */
    $('body').on('removed_from_cart', function (ev, fragments, cart_hash, _button) {
        if ($(_button).parents('form.after-add-to-cart-form').length) {
            if ($('.ns-cart-popup-wrap').length) {
                after_added_to_cart($);
            }
        }

        if (
            $('.ns-cart-popup-wrap.nasa-active').length &&
            $('.ns-cart-popup-wrap .woocommerce-cart-form__cart-item').length <= 0 &&
            $('.ns-cart-popup-wrap .popup-cart-close').length &&
            $('.ns-cart-popup-wrap .ns-cart-popup-v2').length <= 0
        ) {
            $('.ns-cart-popup-wrap .popup-cart-close').trigger('click');
        }

        /**
         * notification free shipping
         */
        setTimeout(function(){
            init_shipping_free_notification($);
        },100);

        ev.preventDefault();
    });

    /**
     * Update cart in popup
     */
    $('body').on('click', '.nasa-update-cart-popup', function (e) {
        var _this = $(this);

        if ($('.ns-cart-popup').length && !$(_this).hasClass('nasa-disable')) {
            var _form = $(this).parents('form');

            if ($(_form).find('input[name="update_cart"]').length <= 0) {
                $(_form).append('<input type="hidden" name="update_cart" value="Update Cart" />');
            }

            $.ajax({
                type: $(_form).attr('method'),
                url: $(_form).attr('action'),
                data: $(_form).serialize(),
                dataType: 'html',
                beforeSend: function () {
                    nasa_block($('.nasa-after-add-to-cart-wrap'));
                },
                success: function (res) {
                    $(_form).find('input[name="update_cart"]').remove();
                    $(_this).addClass('nasa-disable');
                },
                complete: function () {
                    $('body').trigger('wc_fragment_refresh');
                    after_added_to_cart($);
                }
            });
        }

        e.preventDefault();
    });
    
    $('body').on('click', '.nasa-close-magnificPopup, .nasa-mfp-close', function (e) {
        /**
         * Close Magnific
         */
        $('body').trigger('ns_magnific_popup_close');

        e.preventDefault();
    });

    $('body').on('click', '.ns-cart-popup-wrap .continue-cart', function (e) {
        if ($('.ns-cart-popup-wrap .popup-cart-close').length) {
            $('.ns-cart-popup-wrap .popup-cart-close').trigger('click');
        }

        e.preventDefault();
    });

    $('body').on('change', '.ns-cart-popup-wrap input.qty', function (e) {
        $('.ns-cart-popup-wrap .nasa-update-cart-popup').removeClass('nasa-disable');

        e.preventDefault();
    });
    
    /**
     * click ns-close-quickadd
     */
    $('body').on('click', '.ns-close-quickadd', function (e) {
        var _this = $(this);
        var _pa = $(_this).parents('.product-item');
        $(_pa).removeClass('nasa-modern-8-var-active');

        e.preventDefault();
    });

    // p-modern-8
    // $('body').on('click', '.nasa-attr-ux-item-modern-8', function (e) {
    //     var _this = this;
    //     var _data_val = $(_this).attr('data-value');
    //     var _data_pa= $(_this).attr('data-pa');
    //     var _pr_item = $(_this).parents('.product-item');
    //     var _form = $(_pr_item).find('.variations_form');
    //     var _ux_item_form = $(_form).find('.nasa-attr-ux_wrap[data-attribute_name="attribute_pa_' + _data_pa + '"] .nasa-attr-ux[data-value="' + _data_val + '"]');

    //     if (!$(_pr_item).hasClass('ns-var-loaded')) {
    //         $(_pr_item).find('.nasa-quick-add').trigger('click');
    //         $(_this).addClass('ns_pre_change_img');
    //     } else {
    //         if ($(_this).hasClass('nasa-active')) {
    //             $(_ux_item_form).trigger('click');
    //         } else {
    //             if (!$(_ux_item_form).hasClass('nasa-disable')) {
    //                 if (!$(_ux_item_form).hasClass('selected')) {
    //                     $(_ux_item_form).trigger('click');
    //                 }

    //             }
    //         }
    //     }

    //     e.preventDefault();
    // });

    /**
     * Adding to Cart - Hook
     */
    $('body').on('adding_to_cart', function(e, $thisbutton, data) {
        /**
         * Close Magnific
         */
        $('body').trigger('ns_magnific_popup_close');
        
        /**
         * Close Exit Intent Popup
         */
        $('body').trigger('ns_exit_intent_pop_close');
        /**
         * Compatible - YITH Easy Order Page for WooCommerce
         */
        if ($('.yith-wceop-cart-widget').length <= 0) {
            var _event_add = $('input[name="nasa-event-after-add-to-cart"]').length && $('input[name="nasa-event-after-add-to-cart"]').val() ? $('input[name="nasa-event-after-add-to-cart"]').val() : 'sidebar';

            var _id = data.variation_id ? data.variation_id : data.product_id,
                _data_variation = _id + '.' + $.map(data.variation, function(e){return e;}).join('.'),
                _cart_sidebar = $('#cart-sidebar'),
                _temp_footer_load = $('#ns-cart-sidebar-loading-footer'),
                _temp_item_load = $('#ns-cart-sidebar-loading-item'),
                is_update_mini_cart = $(_cart_sidebar).hasClass('nasa_update_from_mini_cart')? true : false;

            if ($('.nasa-static-sidebar.nasa-active').length && !is_update_mini_cart) {
                $('.nasa-static-sidebar.nasa-active').removeClass('nasa-active');
            }

            if ($('#nasa-quickview-popup.nasa-active').length) {
                var _pr_item = $('#nasa-quickview-popup.nasa-active');

                if (typeof setMaxHeightQVPU !== 'undefined') {
                    clearInterval(setMaxHeightQVPU);
                }

                $(_pr_item).addClass('ns-left-to-right');

                setTimeout(function () {
                    $(_pr_item).removeClass('ns-left-to-right nasa-active').hide();

                    if ($('body').hasClass('woocommerce-checkout')) {
                        if ($('.black-window').hasClass('desk-window')) {
                            $('.black-window').trigger('click');
                        }
                    }
                    
                }, 350);
            }

            if (_event_add == 'notice') {
                if ($('#nasa-quickview-popup.nasa-active').length) {
                    $('#nasa-quickview-popup.nasa-active').find('.nasa-stclose').trigger('click');
                }

                if ($('.black-window').hasClass('desk-window') && !$($thisbutton).parents('.mini-cart-change-variation').length) {
                    $('.black-window').trigger('click');
                }
            }

            $('#cart-sidebar').attr({'data-variation-product-adding':_data_variation});

            if (_event_add === 'popup_2' && $('form.nasa-shopping-cart-form, form.woocommerce-checkout').length <= 0 && !is_update_mini_cart) {
                var _cart_popup = $('#ns-cart-popup');
                // var _title = $('.ns-cart-popup-wrap').find('.nasa-title-after-add-to-cart');
                // var _text = $(_title).text();

                if ($('.ns-popup-container_v2 .ns-cross-sell-lazy').length) {
                    $('.ns-popup-container_v2 .ns-cross-sell-lazy').removeClass('nasa-active');
                }

                if ($('.ns-cart-popup-wrap').find('.nasa-slick-slider').length) {
                    $('body').trigger('nasa_reload_slick_slider_private', [$('.ns-cart-popup-wrap')]);
                }

                //$(_title).text($(_title).attr('data_text_added')).attr('data_text_added',_text);
                $(_cart_popup).find('.nasa-minicart-footer').find('*:not(.ns_total_item)').remove();
                $(_cart_popup).find('.nasa-minicart-footer').append('<span class="ns-line"></span>' + $(_temp_footer_load).html());

                $('.ns-cart-popup-wrap').show();
                $('.ns-cart-popup-wrap').addClass('crazy-loading');

                setTimeout(function() {
                    $('body').addClass('ovhd');
                    $('.ns-cart-popup-wrap').addClass('nasa-active');
                    $('.black-window').fadeIn(200).addClass('desk-window');
                }, 50);
            }

            if ($('input[name="ns-not-preload-mcart"]').length <= 0) {
                if (_event_add === 'sidebar' || is_update_mini_cart) {
                    if ($('#cart-sidebar .cross-sells').length) {
                        $('body').trigger('nasa_cross_sell_columns_setting', [$('#cart-sidebar .cross-sells').find('.nasa-slick-slider')]);
                    }

                    $('body').removeClass('ovhd');

                    if ($('.nasa-static-sidebar.nasa-active').length) {
                        $('.nasa-static-sidebar.nasa-active').removeClass('nasa-active');
                    }

                    $('.black-window').fadeIn(200).addClass('desk-window');

                    if (!$('body').hasClass('m-ovhd')) {
                        $('body').addClass('m-ovhd');
                    }

                    if ($('#cart-sidebar').length && !$('#cart-sidebar').hasClass('nasa-active')) {
                        $(_cart_sidebar).addClass('nasa-active crazy-loading');

                        if (($(_cart_sidebar).find('.widget_shopping_cart_content').length <= 0 || $(_cart_sidebar).find('.mini-cart-item').length <= 0 || $(_cart_sidebar).find('.empty').length ) && !is_update_mini_cart) {

                            $(_cart_sidebar).append('<div class="widget_shopping_cart_content_frag">'+$(_temp_item_load).html() + '<div class="nasa-minicart-footer-empty">' + $(_temp_footer_load).html() + '</div>'+'</div>');

                        } else {
                            var _cart_items = $('#cart-sidebar').find('.woocommerce-mini-cart .mini-cart-item[data-variation-product="' +_data_variation + '"]');

                            if ($(_cart_items).length) {
                                $(_cart_items).before($(_temp_item_load).html());
                                $(_cart_items).remove();
                            } else {

                                if ($(_cart_sidebar).find('.nasa-minicart-items .woocommerce-mini-cart >.row').length) {
                                    $(_cart_sidebar).find('.nasa-minicart-items .woocommerce-mini-cart >.row').before($(_temp_item_load).html());
                                } else {
                                    $(_cart_sidebar).find('.nasa-minicart-items .woocommerce-mini-cart').append($(_temp_item_load).html());
                                }
                            }
                        }
                    }
                }
            }
        }
    });
    
    $('body').on('click', '#nasa-confetti-popup, #nasa-confetti, #nasa-confetti-review', function() {
        $(this).fadeOut(100);
    });

    $('body').on('click', '.remove_from_cart_button', function(e) {
        var _this = $(this);
        
        if ($(_this).hasClass('ajax-sp_yes')) {
            var _pa = $(_this).parents('.mini-cart-item');
            $('body').trigger('animate_remove_from_mini_cart_wishlist', [_pa, 1]);

            e.preventDefault();
        }
    });

    $('body').on('click', '.nasa-remove_from_wishlist', function() {
        var _this = $(this);
        var _pa = $(_this).parents('.nasa-tr-wishlist-item');
        $(_pa).parents('.widget_shopping_wishlist_content').css('overflow', 'hidden');
        $('body').trigger('animate_remove_from_mini_cart_wishlist', [_pa, 2]);
    });

    $('body').on('animate_remove_from_mini_cart_wishlist', function(e, wrap, _items){
        var _outer_height = $(wrap).outerHeight();
        var _pa = $(wrap).parents('.nasa-minicart-items');
        $(wrap).addClass('nasa-remove-animate');

        if (_items == 2) {
            _pa = $(wrap).parents('.wishlist_table');
        }

        $(_pa).addClass('ns-disable-remove');
        
        if ($(wrap).prev().length <= 0){ 
            _outer_height += 15;
        }else if ($(wrap).next().length <= 0) {
            $(wrap).prev().addClass('nasa-border-bottom-none');
        }
        
        setTimeout(function(){
            $(wrap).css({'margin-top':-_outer_height});
            var _child = $(wrap).parent().children(':not(.row)');
            if($(_child).length -1 <= 0) {
                $(_pa).parents('.nasa-static-sidebar').find('.nasa-sidebar-close a').trigger('click');
            }
        }, 400);
    });

    $('body').on('nasa_get_cross_sell', function(e, wrap, reload_cross){
        if (reload_cross) {
            if (
                typeof nasa_ajax_params !== 'undefined' &&
                typeof nasa_ajax_params.wc_ajax_url !== 'undefined'
            ) {
                var _urlAjax = nasa_ajax_params.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_get_cross_sell_mini_cart');
                $.ajax({
                    url: _urlAjax,
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    beforeSend: function () {
    
                    },
                    success: function (data) {
                        if (data.success == 1) {
                            if ($(wrap).find('.ns-cross-sell-lazy').length) {
                                $(wrap).find('.ns-cross-sell-lazy').html(data.content);
                            } else {
                                $(wrap).append('<div class="ns-cross-sell-lazy">' + data.content + '</div>');
                            }
                            
                            $('body').trigger('nasa_load_countdown');
                            init_wishlist_icons($, true);
                            $('body').trigger('nasa_cross_sell_columns_setting', [$('.ns-popup-container_v2 .cross-sells').find('.nasa-slick-slider')]);
                            $(wrap).find('.ns-cross-sell-lazy').addClass('nasa-active');
                            $('body').trigger('nasa_cross_sell_check_img_loaded', [$('.ns-popup-container_v2 .cross-sells').find('.nasa-slick-slider')]);
                        }
                    },
                    error: function () {
                        
                    }
                });
            }
        }
    });
    
    $('body').on('nasa_cross_sell_check_img_loaded', function(e, _slick_slider){
        if ($(_slick_slider).length) {

            var nasa_cross_sell_check_img_loaded = setInterval(function(){
                var _items  = $(_slick_slider).find('.product-item:not(.nasa-cross-img-loaded)');

                if ($(_items).length) {
                    $(_items).each(function () {
                        var _this = $(this),
                            _img_wrap = $(_this).find('.product-img-wrap .product-img'),
                            _main_img = $(_img_wrap).find('.main-img  img'),
                            _back_img = $(_img_wrap).find('.back-img  img').length ? $(_img_wrap).find('.back-img  img') : null,
                            _main_img_loaded = false,
                            _back_img_loaded = false;
                            if ($(_main_img).length || $(_back_img).length) {
                                if ($(_main_img).length) {
                                   
                                    var _main_src = $(_main_img).attr('src');
                                    var _img_main = new Image();
                                    
                                    _img_main.onload = function() {
                                        $(_main_img).addClass('ns-cross-img-loaded');
                                    };
                                    _img_main.src = _main_src;

                                    if ($(_main_img).hasClass('ns-cross-img-loaded')) {
                                        _main_img_loaded = true;
                                    }
                                }
                    
                                if (_back_img) {

                                    var _back_src = $(_back_img).attr('src');
                                    var _img_back = new Image();
                                    
                                    _img_back.onload = function() {
                                        $(_back_img).addClass('ns-cross-img-loaded');
                                    };

                                    _img_back.src = _back_src;

                                    if ($(_back_img).hasClass('ns-cross-img-loaded')) {
                                        _back_img_loaded = true;
                                    }
                                } else {
                                    _back_img_loaded = true;
                                }

                                if (_main_img_loaded && _back_img_loaded) {
                                    $(_this).addClass('nasa-cross-img-loaded');
                                }
                            }
                           
                    });
                } else {
                    clearInterval(nasa_cross_sell_check_img_loaded);
                }
            },500);
        }
    });
    
    /**
     * Show more | Show less
     */
    $('body').on('click', '.nasa_show_manual > a', function (e) {
        var _this = $(this),
            _val = $(_this).attr('data-show'),
            _li = $(_this).parent(),
            _delay = $(_li).attr('data-delay') ? parseInt($(_li).attr('data-delay')) : 100,
            _fade = $(_li).attr('data-fadein') === '1' ? true : false,
            _text_attr = $(_this).attr('data-text'),
            _text = $(_this).text();

        $(_this).html(_text_attr);
        $(_this).attr('data-text', _text);

        if (_val === '1') {
            $(_li).parent().find('.nasa-show-less').each(function () {
                if (!_fade) {
                    $(this).slideDown(_delay);
                } else {
                    $(this).fadeIn(_delay);
                }
            });

            $(_this).attr('data-show', '0');
        } else {
            $(_li).parent().find('.nasa-show-less').each(function () {
                if (!$(this).hasClass('nasa-chosen') && !$(this).find('.nasa-active').length) {
                    if (!_fade) {
                        $(this).slideUp(_delay);
                    } else {
                        $(this).fadeOut(_delay);
                    }
                }
            });

            $(_this).attr('data-show', '1');
        }

        e.preventDefault();
    });
    
    /**
     * Auto Scroll to Anchor
     */
    $('body').on('click', '.nasa-anchor', function (e) {
        var _target = $(this).attr('data-target');
        if ($(this).hasClass('nasa-anchor-scroll-item')) {

            $(this).addClass('active').siblings().removeClass('active');
            $(this).parents('.nasa-scroll-titles').addClass('on-scrolling');

            animate_scroll_to_top($, _target, 500);

            setTimeout(function() {
                $('.nasa-scroll-wrap .nasa-scroll-titles').removeClass('on-scrolling');
            },500);
        } else if ($(_target).length) {
            animate_scroll_to_top($, _target, 1000);
        }

        e.preventDefault();
    });
    
    $('body').on('click', '.filter-cat-icon-mobile', function (e) {
        var _this_click = $(this);

        if (!$(_this_click).hasClass('nasa-disable')) {
            $(_this_click).addClass('nasa-disable');

            if ($('#nasa-mobile-cat-filter .nasa-tmpl').length) {
                var _content = $('#nasa-mobile-cat-filter .nasa-tmpl').html();
                $('#nasa-mobile-cat-filter .nasa-tmpl').replaceWith(_content);
            }

            $('.nasa-top-cat-filter-wrap-mobile').addClass('nasa-show');

            $('.transparent-mobile').fadeIn(300).addClass('desk-window');

            if (!$('body').hasClass('m-ovhd')) {
                $('body').addClass('m-ovhd');
            }

            setTimeout(function () {
                $(_this_click).removeClass('nasa-disable');
            }, 600);
        }

        e.preventDefault();
    });

    $('body').on('click', '.nasa-close-filter-cat, .nasa-tranparent-filter', function (e) {
        $('.nasa-elements-wrap').removeClass('nasa-invisible');
        $('#header-content .nasa-top-cat-filter-wrap').removeClass('nasa-show');
        $('.nasa-tranparent-filter').remove();
        $('.transparent-mobile').trigger('click');

        e.preventDefault();
    });
    
    $('body').on('click', '.nasa-close-search, .nasa-tranparent', function () {
        $(this).parents('.nasa-wrap-event-search').find('.desk-search').trigger('click');
    });

    $('body').on('click', '.nasa-close-search-mobile', function () {
        $('.black-window').trigger('click');
    });
    
    $('body').on('click', '.toggle-sidebar-shop', function () {
        $('.black-window').fadeIn(200).addClass('desk-window');
        var _widget  = $('.nasa-side-sidebar .nasa-sidebar-off-canvas').find('.widget');
        if (!$('body').hasClass('m-ovhd')) {
            $('body').addClass('m-ovhd');
        }

        if (!$('.nasa-side-sidebar').hasClass('nasa-show')) {
            $('.nasa-side-sidebar').addClass('nasa-show');
        }
        
        // filler side bar canvas html replace
        if ($(_widget).length) {
            $(_widget).each(function () {
          
                var _this = $(this);
                var title = $(_this).find('>.widget-title');
                var toggle = $(_this).find('>.nasa-toggle-widget');
    
                if ($(title).length && $(toggle).length) {
                    $(toggle).append($(title));
                }
            });
        }

    });
    
    $('body').on('click', '.toggle-sidebar-my-account', function () {
        $('.black-window').fadeIn(200).addClass('desk-window');

        if (!$('body').hasClass('m-ovhd')) {
            $('body').addClass('m-ovhd');
        }

        if (!$('.nasa-side-sidebar').hasClass('nasa-show')) {
            $('.nasa-side-sidebar').addClass('nasa-show');
        }
    });
    
    /**
     * For topbar type 1 Mobile
     */
    $('body').on('click', '.toggle-topbar-shop-mobile', function () {
        $('.transparent-mobile').fadeIn(200).addClass('desk-window');

        if (!$('body').hasClass('m-ovhd')) {
            $('body').addClass('m-ovhd');
        }

        if (!$('.nasa-top-sidebar').hasClass('nasa-active')) {
            $('.nasa-top-sidebar').addClass('nasa-active');
        }
    });

    $('body').on('click', '.toggle-sidebar', function () {
        $('.black-window').fadeIn(200);

        if (!$('body').hasClass('m-ovhd')) {
            $('body').addClass('m-ovhd');
        }

        if ($('.col-sidebar').length && !$('.col-sidebar').hasClass('nasa-active')) {
            $('.col-sidebar').addClass('nasa-active');
        }
    });

    /**
     * Show coupon in shopping cart
     */
    $('body').on('click', '.nasa-show-coupon', function (e) {
        if ($('.nasa-coupon-wrap').length === 1) {
            $('.nasa-coupon-wrap').toggleClass('nasa-active');
            setTimeout(function () {
                $('.nasa-coupon-wrap.nasa-active input[name="coupon_code"]').trigger('focus');
            }, 100);
        }

        e.preventDefault();
    });

    /**
     * Topbar toggle
     */
    $('body').on('click', '.nasa-topbar-wrap .nasa-icon-toggle', function (e) {
        var _wrap = $(this).parents('.nasa-topbar-wrap');
        $(_wrap).toggleClass('nasa-topbar-hide');

        e.preventDefault();
    });

    /**
     * Toggle Push Cat - Filter
     */
    $('body').on('click', '.black-window-mobile', function (e) {
        $(this).removeClass('nasa-push-cat-show');
        $('.nasa-push-cat-filter').removeClass('nasa-push-cat-show');
        $('.nasa-products-page-wrap').removeClass('nasa-push-cat-show');

        e.preventDefault();
    });

    $('body').on('click', '.nasa-mobile-icons-wrap .nasa-toggle-mobile_icons', function (e) {
        $(this).parents('.nasa-mobile-icons-wrap').toggleClass('nasa-hide-icons');
        e.preventDefault();
    });
    
    if ($('.nasa-promotion-close').length) {
        var height = $('.nasa-promotion-news').outerHeight();

        if ($.cookie('promotion') !== 'hide') {
            setTimeout(function () {
                $('.nasa-promo-bg').animate({'height': height + 'px'}, 500);
                $('.nasa-promotion-news').fadeIn(500);

                if ($('.nasa-promotion-news').find('.nasa-post-slider').length) {
                    $('.nasa-promotion-news').find('.nasa-post-slider').addClass('nasa-slick-slider');
                    $('body').trigger('nasa_load_slick_slider');
                }
                
                $('body').trigger('nasa-content-promotion-auto-slide');
            }, 1000);
        } else {
            $('.nasa-promotion-show').show();
        }
        
        $('body').on('click', '.nasa-promotion-close', function (e) {
            $.cookie('promotion', 'hide', {expires: _cookie_live, path: '/'});
            $('.nasa-promotion-show').show();
            $('.nasa-promo-bg').animate({'height': '0'}, 500);
            $('.nasa-promotion-news').fadeOut(500);

            e.preventDefault();
        });
        
        $('body').on('click', '.nasa-promotion-show', function (e) {
            $.cookie('promotion', 'show', {expires: _cookie_live, path: '/'});
            $('.nasa-promotion-show').hide();
            $('.nasa-promo-bg').animate({'height': height + 'px'}, 500);
            $('.nasa-promotion-news').fadeIn(500);

            if ($('.nasa-promotion-news').find('.nasa-post-slider').length && !$('.nasa-promotion-news').find('.nasa-post-slider').hasClass('nasa-slick-slider')) {
                $('.nasa-promotion-news').find('.nasa-post-slider').addClass('nasa-slick-slider');
                $('body').trigger('nasa_load_slick_slider');
            }
            
            $('body').trigger('nasa-content-promotion-auto-slide');

            setTimeout(function () {
                $(window).trigger('resize');
            }, 1000);

            e.preventDefault();
        });
    };
    
    /* BOTTOM BAR - MOBILE ==================================== */
    
    /**
     * Bar icons bottom in mobile
     */
    $('body').on('nasa_bottom_bar_init', function () {
        init_bottom_bar_mobile($);
    });

    /**
     * Event sidebar in bottom mobile layout
     */
    $('body').on('click', '.nasa-bot-icon-sidebar', function (e) {
        $('.toggle-topbar-shop-mobile, .nasa-toggle-top-bar-click, .toggle-sidebar-shop, .toggle-sidebar, .toggle-sidebar-dokan').trigger('click');

        if ($('.nasa-top-sidebar-2').length) {
            setTimeout(function () {
                $('body').trigger('nasa_animate_scroll_to_top', [$, '.nasa-top-sidebar-2', 300]);
            }, 300);
        }

        e.preventDefault();
    });

    /**
     * Event cart sidebar in bottom mobile layout
     */
    $('body').on('click', '.botbar-cart-link', function (e) {
        if ($('.cart-link').length) {
            $('.cart-link').trigger('click');
        }

        e.preventDefault();
    });

    /**
     * Event search in bottom mobile layout
     */
    $('body').on('click', '.botbar-mobile-search', function (e) {
        if ($('.mobile-search').length <= 0) {
            $(this).after('<a class="hidden-tag mobile-search" href="javascript:void(0);"></a>');
        }

        if ($('.mobile-search').length) {
            $('.mobile-search').trigger('click');
        }

        e.preventDefault();
    });

    /**
     * Event Wishlist sidebar in bottom mobile layout
     */
    $('body').on('click', '.botbar-wishlist-link', function (e) {
        if ($('.wishlist-link').length) {
            $('.wishlist-link').trigger('click');
        }

        e.preventDefault();
    });

    /**
     * For Mobile layout
     */
    if (_mobileView || _inMobile) {
        $('body').trigger('nasa_bottom_bar_init');
    }

    /**
     * For Desktop responsive
     */
    if ($('#tmpl-nasa-bottom-bar').length) {
        $(window).on('resize', function () {
            _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
            if (_mobileView) {
                $('body').trigger('nasa_bottom_bar_init');
            }
        });
    }
    
    /* LOGIN | REGISTER - AJAX ============================================== */
    /**
     * Login - Register
     *
     * Login Ajax
     */
    $('body').on('click', '.nasa_login-form .button[type="submit"][name="nasa_login"]', function (e) {
        e.preventDefault();

        if (typeof nasa_ajax_params !== 'undefined' && typeof nasa_ajax_params.ajax_url !== 'undefined') {
            var _form = $(this).parents('form.login');

            var _validate = true;
            $(_form).find('.form-row').each(function () {
                var _inputText = $(this).find('input.input-text');
                var _require = $(this).find('.required');
                if ($(_inputText).length) {
                    $(_inputText).removeClass('nasa-error');
                    if ($(_require).length && $(_require).height() && $(_require).width() && $(_inputText).val().trim() === '') {
                        _validate = false;

                        $(_inputText).addClass('nasa-error');
                    }
                }
            });

            if (_validate) {
                var _data = $(_form).serializeArray();
                $.ajax({
                    url: nasa_ajax_params.ajax_url,
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    data: {
                        'action': 'nasa_process_login',
                        'data': _data,
                        'login': true
                    },
                    beforeSend: function () {
                        $('#nasa-login-register-form #nasa_customer_login').css({ opacity: 0.3 });
                        $('#nasa-login-register-form #nasa_customer_login').after('<div class="nasa-loader"></div>');
                    },
                    success: function (res) {
                        $('#nasa-login-register-form #nasa_customer_login').css({ opacity: 1 });
                        $('#nasa-login-register-form').find('.nasa-loader').remove();
                        var _warning = (res.error === '0') ? 'nasa-success' : 'nasa-error';

                        $('#nasa-login-register-form .nasa-message').html('<h4 class="' + _warning + '">' + res.mess + '</h4>');

                        if (res.error === '0') {
                            $('#nasa-login-register-form .nasa-form-content').remove();
                            $('#nasa-login-register-form .nasa-message').addClass('nasa-congrat');
                            $('#nasa-login-register-form .nasa-message').html(res.svg_check + res.mess);
                            // window.location.href = res.redirect;

                            setTimeout(function () {
                                $('.login-register-close').trigger('click');
                            }, 3000);
                        } else {
                            if (res._wpnonce === 'error') {
                                setTimeout(function () {
                                    var _href = false;

                                    if ($('.nasa-login-register-ajax').length) {
                                        _href = $('.nasa-login-register-ajax').attr('href');
                                    }

                                    if (_href) {
                                        window.location.href = _href;
                                    } else {
                                        window.location.reload();
                                    }
                                }, 2000);
                            }
                        }

                        $('body').trigger('nasa_after_process_login');
                    },
                    error: function () {
                        var _href = false;

                        if ($('.nasa-login-register-ajax').length) {
                            _href = $('.nasa-login-register-ajax').attr('href');
                        }

                        if (_href) {
                            window.location.href = _href;
                        } else {
                            window.location.reload();
                        }
                    }
                });
            } else {
                $(_form).find('.nasa-error').first().focus();
            }
        }

        return false;
    });

    /**
     * Register Ajax
     */
    $('body').on('click', '.nasa_register-form .button[type="submit"][name="nasa_register"]', function (e) {
        e.preventDefault();

        if (typeof nasa_ajax_params !== 'undefined' && typeof nasa_ajax_params.ajax_url !== 'undefined') {
            var _form = $(this).parents('form.register');
            var _validate = true;
            $(_form).find('.form-row').each(function () {
                var _inputText = $(this).find('input.input-text');
                var _require = $(this).find('.required');
                if ($(_inputText).length) {
                    $(_inputText).removeClass('nasa-error');
                    if ($(_require).length && $(_require).height() && $(_require).width() && $(_inputText).val().trim() === '') {
                        _validate = false;

                        $(_inputText).addClass('nasa-error');
                    }
                }
            });

            if (_validate) {
                var _data = $(_form).serializeArray();
                $.ajax({
                    url: nasa_ajax_params.ajax_url,
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    data: {
                        'action': 'nasa_process_register',
                        'data': _data,
                        'register': true
                    },
                    beforeSend: function () {
                        $('#nasa-login-register-form #nasa_customer_login').css({opacity: 0.3});
                        $('#nasa-login-register-form #nasa_customer_login').after('<div class="nasa-loader"></div>');
                    },
                    success: function (res) {
                        $('#nasa-login-register-form #nasa_customer_login').css({opacity: 1});
                        $('#nasa-login-register-form').find('.nasa-loader').remove();
                        var _warning = (res.error === '0') ? 'nasa-success' : 'nasa-error';
                        $('#nasa-login-register-form .nasa-message').html('<h4 class="' + _warning + '">' + res.mess + '</h4>');

                        if (res.error === '0') {
                            $('#nasa-login-register-form .nasa-form-content').remove();
                            $('#nasa-login-register-form .nasa-message').addClass('nasa-congrat');
                            $('#nasa-login-register-form .nasa-message').html(res.svg_check + res.mess);
                            //window.location.href = res.redirect;

                            setTimeout(function () {
                                $('.login-register-close').trigger('click');
                            }, 3000);
                        } else {
                            if (res._wpnonce === 'error') {
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            }
                        }

                        $('body').trigger('nasa_after_process_register');
                    }
                });
            } else {
                $(_form).find('.nasa-error').first().focus();
            }
        }

        return false;
    });

    $('body').on('keyup', '#nasa-login-register-form input.input-text.nasa-error', function (e) {
        if ($(this).val() !== '') {
            $(this).removeClass('nasa-error');
        }

        e.preventDefault();
    });
    
    /**
     * Logout click
     */
    $('body').on('click', '.nasa_logout_menu a', function (e) {
        if ($('input[name="nasa_logout_menu"]').length) {
            window.location.href = $('input[name="nasa_logout_menu"]').val();
        }

        e.preventDefault();
    });

    /**
     * Switch Login | Register forms
     */
    $('body').on('click', '.nasa-switch-register', function (e) {
        $('#nasa-login-register-form .nasa-message').html('');
        $('.nasa_register-form, .register-form').animate({ 'left': '0' }, 350);
        $('.nasa_login-form, .login-form').animate({ 'left': '-100%' }, 350);

        setTimeout(function () {
            $('.nasa_register-form, .register-form').css({ 'position': 'relative' });
            $('.nasa_login-form, .login-form').css({ 'position': 'absolute' });
        }, 350);

        e.preventDefault();
    });

    /**
     * Switch Login | Register forms
     */
    $('body').on('click', '.nasa-switch-login', function (e) {
        $('#nasa-login-register-form .nasa-message').html('');
        $('.nasa_register-form, .register-form').animate({ 'left': '100%' }, 350);
        $('.nasa_login-form, .login-form').animate({ 'left': '0' }, 350);

        setTimeout(function () {
            $('.nasa_register-form, .register-form').css({ 'position': 'absolute' });
            $('.nasa_login-form, .login-form').css({ 'position': 'relative' });
        }, 350);

        e.preventDefault();
    });

    /**
     * Login / Register Popup
     */
    $('body').on('click', '.nasa-login-register-ajax', function () {
        if ($('#nasa-login-register-form').length <= 0) {
            var _content = $('#tmpl-nasa-register-form').html();
            $('.nasa-login-register-warper').html(_content);
            $('#tmpl-nasa-register-form').remove();

            $('body').trigger('nasa_login_register_ajax_inited');
        }

        if ($(this).attr('data-enable') === '1' && $('#customer_login').length <= 0) {
            $('#nasa-menu-sidebar-content').removeClass('nasa-active');
            $('#mobile-navigation').attr('data-show', '0');

            $('.black-window').fadeIn(200).removeClass('nasa-transparent').addClass('desk-window');

            if (!$('body').hasClass('m-ovhd')) {
                $('body').addClass('m-ovhd');
            }

            if (!$('.nasa-login-register-warper').hasClass('nasa-active')) {
                $('.nasa-login-register-warper').show();
                $('.nasa-login-register-warper').addClass('nasa-active');
            }

            /**
             * Refresh Login/Register nonce code
             */
            var ns_now_click = Date.now();
            if (
                ($('input[name="nasa-rflrnc"]').length && $('input[name="nasa-rflrnc"]').val() === '1') &&
                ((ns_now_click - ns_now) / 1000 / 60 < 10)
            ) {
                if (
                    $('.nasa-login-register-warper #woocommerce-login-nonce').length ||
                    $('.nasa-login-register-warper #woocommerce-register-nonce').length
                ) {

                    $('input[name="nasa-rflrnc"]').remove();

                    if (
                        typeof nasa_ajax_params !== 'undefined' &&
                        typeof nasa_ajax_params.wc_ajax_url !== 'undefined'
                    ) {
                        var _urlAjax = nasa_ajax_params.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_wc_nonce_fields_rf');

                        $.ajax({
                            url: _urlAjax,
                            type: 'post',
                            dataType: 'json',
                            cache: false,
                            data: {},
                            beforeSend: function () {

                            },
                            success: function (res) {
                                if (typeof res.success !== 'undefined' && res.success === '1') {
                                    if (
                                        $('.nasa-login-register-warper #woocommerce-login-nonce').length &&
                                        typeof res.content.rn !== 'undefined' && res.content.rn
                                    ) {
                                        $('.nasa-login-register-warper #woocommerce-login-nonce').replaceWith(res.content.ln);
                                    }

                                    if (
                                        $('.nasa-login-register-warper #woocommerce-register-nonce').length &&
                                        typeof res.content.rn !== 'undefined' && res.content.rn
                                    ) {
                                        $('.nasa-login-register-warper #woocommerce-register-nonce').replaceWith(res.content.rn);
                                    }
                                }
                            },
                            error: function () {

                            }
                        });
                    }
                }
            }

            $('body').trigger('nasa_after_clicked');

            return false;
        }
    });

    /**
     * Must login to login Ajax Popup
     */
    $('body').on('click', '.must-log-in > a', function (e) {
        if ($('.nasa-login-register-ajax[data-enable="1"]').length) {
            e.preventDefault();

            if ($('#reviews .ns-form-close').length) {
                $('#reviews .ns-form-close').trigger('click');
            }

            $('.nasa-login-register-ajax[data-enable="1"]:eq(0)').trigger('click');

            return false;
        } else {
            window.location.href = $(this).attr('href');
        }
    });
    
    /* ====================================================================== */
    
    /**
     * Delay Click yith wishlist
     */
    if ($('.nasa_yith_wishlist_premium-wrap').length && $('.nasa-wishlist-count.wishlist-number').length) {
        $(document).ajaxComplete(function () {
            setTimeout(function () {
                $('.nasa_yith_wishlist_premium-wrap').each(function () {
                    var _this = $(this);
                    if (!$(_this).parents('.wishlist_sidebar').length) {
                        var _countWishlist = $(_this).find('.wishlist_table tbody tr .wishlist-empty').length ? '0' : $(_this).find('.wishlist_table tbody tr').length;
                        $('.nasa-mini-number.wishlist-number').html(_countWishlist);

                        if (_countWishlist === '0') {
                            $('.nasa-mini-number.wishlist-number').addClass('nasa-product-empty');
                        }
                    }
                });
            }, 300);
        }).ajaxError(function () {
            console.log('Error with wishlist premium.');
        });
    }
    
    /**
     * Combo
     * Yith Woo Bundle
     */
    $('body').on('click', '.btn-combo-link', function (e) {
        var _this = $(this);
        load_combo_popup($, _this);

        e.preventDefault();
    });

    /**
     * Event nasa gift featured
     */
    $('body').on('click', '.nasa-gift-featured-event', function (e) {
        var _wrap = $(this).parents('.product-item');

        if ($(_wrap).find('.nasa-product-grid .btn-combo-link').length === 1) {
            $(_wrap).find('.nasa-product-grid .btn-combo-link').trigger('click');
        } else {
            if ($(_wrap).find('.nasa-product-list .btn-combo-link').length === 1) {
                $(_wrap).find('.nasa-product-list .btn-combo-link').trigger('click');
            }
        }

        e.preventDefault();
    });

    /**
     * Mouse leave event
     * 
     * Init Exit Intent Popup
     */
    $('body').on('mouseleave', function(){
        var ns_pexit_intent_ck = $.cookie('nasa_popup_exit_intent_ck');
        // $.cookie('nasa_popup_exit_intent_ck', '', {expires: 1, path: '/'});
        var ns_pexit_intent = $('.nasa-popup-exit-intent-wrap');

        if ($('#nasa-popup').length && $('#nasa-popup').attr('data-done') !== 'true') {
            return;
        }

        if ($(ns_pexit_intent).find('.nasa-slick-slider').length) {
            $('body').trigger('nasa_reload_slick_slider_private', $(ns_pexit_intent).find('.nasa-slick-slider').parent());
        }

        if ($('.nasa-tranparent').length || $('.checkout-modern-wrap').length || $('.mfp-s-ready').length || $('.black-window').hasClass('desk-window')) {
            return;
        }  

        if (ns_pexit_intent_ck !== 'false' && !$(ns_pexit_intent).hasClass('nasa-active') && $(ns_pexit_intent).length) {
            $(ns_pexit_intent).show();
            $('body').addClass('ovhd');
            setTimeout(function() {
                $(ns_pexit_intent).addClass('nasa-active');
                $('.black-window').fadeIn(200).addClass('desk-window');
            }, 50);
        }
    });

    /**
     * Close Exits intent, Promo
     */
    $('body').on('click', '.nasa-popup-exit-intent-close, .nasa-popup-close', function (e) {
        var ns_pexit_intent = $('.nasa-popup-exit-intent-wrap');
        var ns_promo_popup = $('.nasa-promo-popup-wrap');
        // var _this = $(this);

        if ($(ns_pexit_intent).length && $(ns_pexit_intent).hasClass('nasa-active')) {
            $('.black-window').fadeOut(500).removeClass('desk-window');
            $('body').removeClass('ovhd');

            $('body').trigger('ns_exit_intent_pop_close');
        }

        if ($(ns_promo_popup).length && $(ns_promo_popup).hasClass('nasa-active')) {
            var showagain = $('#showagain:checked').val();
            var _one_time = $(ns_promo_popup).attr('data-one_time');

            $(ns_promo_popup).addClass('ns-left-to-right').attr({'data-done':'true'});
            $('.black-window').fadeOut(500).removeClass('desk-window');
            $('body').removeClass('ovhd');

            if (showagain === 'do-not-show' || _one_time === '1') {
                $.cookie('nasa_popup_closed', 'do-not-show', {expires: _cookie_live, path: '/'});
            }

            setTimeout(function () {
                $(ns_promo_popup).removeClass('nasa-active ns-left-to-right').hide();
            }, 350);
        }
    });
    
    /**
     * Close Exit Intent - No blur
     */
    $('body').on('ns_exit_intent_pop_close', function() {
        if ($('.nasa-popup-exit-intent-wrap').length) {
            var repeat_time = parseFloat($('.nasa-popup-exit-intent-close').attr('data-repeat'));
            
            if (!repeat_time) {
                repeat_time = 1;
            }
            
            var expDate = new Date();
            
            expDate.setTime(expDate.getTime() + (repeat_time * 3600 * 1000));
            
            $('.nasa-popup-exit-intent-wrap').addClass('ns-left-to-right');
            
            $.cookie('nasa_popup_exit_intent_ck', 'false', {expires: expDate, path: '/'});

            setTimeout(function () {
                $('.nasa-popup-exit-intent-wrap').removeClass('nasa-active ns-left-to-right').hide();
            }, 350);
        }
    });

    /**
     * Coppy to Clipboard
     */
    $('body').on('click', '.nasa-copy-to-clipboard', function (e) {
        var contentToCopy = $(this).find('.ns-copy').text();
        var contentToAlert = $(this).find('.ns-copy').attr('title');
        var tempTextArea = document.createElement("textarea");
        
        tempTextArea.textContent = contentToCopy;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        
        try {
            document.execCommand('copy');
            
            if (contentToAlert !== '' && typeof contentToAlert !== 'undefined') {
                alert(contentToAlert);
            }
        } catch (ex) {
            console.warn("Unable to copy content to clipboard.");
        } finally {
            tempTextArea.remove();
        }
    });


    $('body').on('click','.ns-toggle-popup-static-block',function() {
        var _this = $(this);
        if ($('body').find('.ns-static-block-popup').length <= 0 && $('.ns-template-static-block-popup').length) {
            var content = $('.ns-template-static-block-popup').html();
            $('body').append(content);
        }

        var _static_block = $('body').find('.ns-static-block-popup');


        if ($(_static_block).length <= 0) {
            return false;
        }

        if (!$(_this).hasClass('active')) {
            var divOffsetTop = $(_this).offset().top;
            var divHeight = $(_this).outerHeight();
            var windowScrollTop = $(window).scrollTop();
            var _top = divOffsetTop + divHeight - windowScrollTop;
            
            $(_this).addClass('active');
            $(_static_block).show();
            $(_static_block).css({
                'top': _top + 10 +'px'
            });
    
            setTimeout(function () {
                $(_static_block).css({
                    'top': _top+'px'
                });
                $(_static_block).addClass('nasa-active');
    
                $(_static_block).find('.nasa-slider-wrap').each(function() {
                    $('body').trigger('nasa_unslick', [this]);
                    $('body').trigger('nasa_load_slick_slider');
                });
    
            },100); 
        } else {
            $(_this).removeClass('active');
            $(_static_block).removeClass('nasa-active');

            setTimeout(function() {
                $(_static_block).remove();
            },400);
        }
    });
    
    /**
     * Fix double touch product item redirect link in Mobile - RTL
     */
    if ($('body').hasClass('nasa-rtl')) {
        var nstouchStartX, nstouchStartY, nstouchStartTime;

        $('body').on('touchstart', ".product-item a.product-img, .product-item a.name", function(event) {
            nstouchStartX = event.originalEvent.touches[0].clientX;
            nstouchStartY = event.originalEvent.touches[0].clientY;
            nstouchStartTime = new Date().getTime();
        });

        $('body').on('touchend', ".product-item a.product-img, .product-item a.name", function(event) {
            var touchEndX = event.originalEvent.changedTouches[0].clientX;
            var touchEndY = event.originalEvent.changedTouches[0].clientY;
            var touchEndTime = new Date().getTime();

            var deltaX = touchEndX - nstouchStartX;
            var deltaY = touchEndY - nstouchStartY;
            var deltaTime = touchEndTime - nstouchStartTime;

            // Thresholds to determine swipe vs tap
            var deltaXThreshold = 30; // px
            var deltaYThreshold = 30; // px
            var timeThreshold = 500; // ms

            if (Math.abs(deltaX) < deltaXThreshold && Math.abs(deltaY) < deltaYThreshold && deltaTime < timeThreshold) {
                // This is a tap
                window.location.href = $(this).attr('href');
            }
        });
    }

    $(document).on('visibilitychange', function() {
        if (typeof show_notification_leave_tab !== 'undefined') {
            if (document.hidden) {
                notificationInterval = setInterval(function() {
                    document.title = show_notification_leave_tab[currentMessageIndex];
                    currentMessageIndex = (currentMessageIndex + 1) % show_notification_leave_tab.length;
                }, 1000);
            } else {
                clearInterval(notificationInterval);
                document.title = originalTitle;
            }
        }
    });
});