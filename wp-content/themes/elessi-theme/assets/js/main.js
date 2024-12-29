/**
 * console.log(navigator.platform);
 * console.log(navigator.appVersion);
 * console.log(navigator.userAgentData);
 */
var fullwidth = 1200,
    _lightbox_variations = [],
    _count_wishlist_items = 0,
    searchProducts = null,
    _nasa_cart = {},
    ns_close_svg = '<svg width="30" height="30" viewBox="0 0 32 32"><path d="M10.722 9.969l-0.754 0.754 5.278 5.278-5.253 5.253 0.754 0.754 5.253-5.253 5.253 5.253 0.754-0.754-5.253-5.253 5.278-5.278-0.754-0.754-5.278 5.278z" fill="currentColor"/></svg>',
    ns_check_svg = '<svg class="ns-check-svg" width="32" height="32" viewBox="0 0 32 32"><path d="M16 2.672c-7.361 0-13.328 5.967-13.328 13.328s5.968 13.328 13.328 13.328c7.361 0 13.328-5.967 13.328-13.328s-5.967-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.501-12.262-12.262s5.5-12.262 12.262-12.262c6.761 0 12.262 5.501 12.262 12.262s-5.5 12.262-12.262 12.262z" fill="currentColor"/><path d="M22.667 11.241l-8.559 8.299-2.998-2.998c-0.312-0.312-0.818-0.312-1.131 0s-0.312 0.818 0 1.131l3.555 3.555c0.156 0.156 0.361 0.234 0.565 0.234 0.2 0 0.401-0.075 0.556-0.225l9.124-8.848c0.317-0.308 0.325-0.814 0.018-1.131-0.309-0.318-0.814-0.325-1.131-0.018z" fill="currentColor"/></svg>',
    ns_arr_down ='<svg width="30" height="30" viewBox="0 0 32 32" stroke-width=".5" stroke="currentColor"><path d="M15.233 19.175l0.754 0.754 6.035-6.035-0.754-0.754-5.281 5.281-5.256-5.256-0.754 0.754 3.013 3.013z" fill="currentColor"/></svg>',
    ns_arr_up ='<svg width="30" height="30" viewBox="0 0 32 32"><path d="M16.767 12.809l-0.754-0.754-6.035 6.035 0.754 0.754 5.281-5.281 5.256 5.256 0.754-0.754-3.013-3.013z" fill="currentColor"/></svg>';

var _confetti_run = false;

if (typeof _cookie_live === 'undefined') {
    var _cookie_live = 7;
}

/* Document ready */
jQuery(document).ready(function ($) {
    "use strict";

    if (typeof ns_now === 'undefined') {
        var ns_now = Date.now();
    }
    
    if (typeof _mobileView === 'undefined') {
        var _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
    }
    
    if (typeof _tabletView === 'undefined') {
        var _tabletView = $('.nasa-check-reponsive.nasa-tablet-check').length && $('.nasa-check-reponsive.nasa-tablet-check').width() === 1 ? true : false;
    }
    
    if (typeof _inMobile === 'undefined') {
        var _inMobile = $('body').hasClass('nasa-in-mobile') ? true : false;
    }

    if ($('input[name="nasa-cookie-time"]').length) {
        _cookie_live = parseInt($('input[name="nasa-cookie-life"]').val());
    }

    $.cookie('nasa_curent_per_shipping', 0, {expires: _cookie_live, path: '/'});

    /**
     * Before Load site
     */
    if ($('#nasa-before-load').length) {
        $('#nasa-before-load').fadeOut(100);
    }

    /**
     * Site Loaded
     */
    var _gpnf = $('.gpnf-nested-form').length ? true : false; // Compatible with GP Nested Forms Plugin
    if (!$('html').hasClass('html-ready') && !_gpnf) {
        $('html').addClass('html-ready');
    } else if (_gpnf && $('#wrapper').length) {
        $('#wrapper').addClass('html-ready');
    }

    /*
     * Remove Crazy Load Effect
     */
    $('body').removeClass('crazy-loading');

    var _hash = location.hash || null;
    if (_hash) {
        if ($('a[href="' + _hash + '"], a[data-id="' + _hash + '"], a[data-target="' + _hash + '"]').length) {
            setTimeout(function () {
                $('a[href="' + _hash + '"], a[data-id="' + _hash + '"], a[data-target="' + _hash + '"]').trigger('click');
            }, 500);
        }

        if ($(_hash).length) {
            if (($(_hash).parents('#comments').length || _hash === '#comments') && $('.woocommerce-review-link').length) {

                var rv = $('body').find('.ns-tab-item .nasa-content-reviews');
                var pr = rv.parents('.ns-tab-item');
                rv.parents('.ns-tab-item').css({ "max-height": "fit-content" });

                setTimeout(function () {
                    $('.woocommerce-review-link').trigger('click');
                    $(pr).removeAttr('style');
                }, 10);
            }

            setTimeout(function () {
                $('.ns-tab-reviews').find('.ns-btn-read-more').trigger('click');
                $('body').trigger('nasa_animate_scroll_to_top', [$, _hash, 500]);
            }, 1000);
        }

        /**
         * For tabs
         */
        var _tabhash = _hash.replace('#', '');
        if ($('a[data-index="nasa-section-' + _tabhash + '"]').length) {
            setTimeout(function () {
                $('a[data-index="nasa-section-' + _tabhash + '"]').trigger('click');
            }, 500);
        }

        if ($('.nasa-section-' + _tabhash).length) {
            setTimeout(function () {
                $('body').trigger('nasa_animate_scroll_to_top', [$, 'a[data-index="nasa-section-' + _tabhash + '"]', 500]);
            }, 1000);
        }
    }
    
    /**
     * Menu Mobile => Menu | Account + Multilangs
     */
    $('body').on('nasa_after_load_mobile_menu', function () {
        /**
         * Off Canvas Menu
         */
        if ($('.nasa-off-canvas').length) {
            $('.nasa-off-canvas').remove();
        }
        
        var _sub_mm = '';
        var _sub_mmsl = '';
        var _heading = '';

        if ($('.ns-menu-heading').length <= 0) {
            if ($('#mobile-navigation').find('.nasa-menu-heading').length) {
                _heading += '<h3 class="menu-item-heading ns-menu-heading">' + $('#mobile-navigation').find('.nasa-menu-heading').html() + '</h3>';
                $('#mobile-navigation').find('.nasa-menu-heading').remove();
            }

            if (_heading !== '') {
                $('#mobile-navigation').before(_heading);
            }
        } else {
            if ($('#mobile-navigation').find('.nasa-menu-heading').length) {
                $('#mobile-navigation').find('.nasa-menu-heading').remove();
            }
        }

        if ($('.ns-acc-langs').length <= 0) {
            if ($('#mobile-navigation').find('.nasa-m-account').length) {
                _sub_mm += '<div class="ns-sub-account">' + $('#mobile-navigation').find('.nasa-m-account').html() + '</div>';
                $('#mobile-navigation').find('.nasa-m-account').remove();
            }

            if ($('#mobile-navigation').find('.nasa-select-languages').length) {
                _sub_mmsl += '<li class="nasa-sub-select-languages li_accordion">' + $('#mobile-navigation').find('.nasa-select-languages').html() + '</li>';
                $('#mobile-navigation').find('.nasa-select-languages').remove();
                $('#mobile-navigation').find('.nasa-select-languages')
            }

            if ($('#mobile-navigation').find('.nasa-select-currencies').length) {
                _sub_mmsl += '<li class="nasa-sub-select-currencies li_accordion">' + $('#mobile-navigation').find('.nasa-select-currencies').html() + '</li>';
                $('#mobile-navigation').find('.nasa-select-currencies').remove();
            }

            if (_sub_mmsl !== '') {
                _sub_mm += '<ul class="ns-sub-multilangs">' + _sub_mmsl + '</ul>';
            }

            if (_sub_mm !== '') {
                _sub_mm = '<div class="nasa-menusub-for-mobile nasa-menu-accordion ns-acc-langs">' + _sub_mm + '</div>';

                $('#mobile-navigation').before(_sub_mm);

                if (!$('.ns-sub-multilangs .nasa-sub-select-currencies a').hasClass('accordion')) {
                    var _sub_acco = '<a href="javascript:void(0);" class="accordion" rel="nofollow"></a>';

                    $('.ns-sub-multilangs .nasa-sub-select-currencies').append(_sub_acco);
                    $('.ns-sub-multilangs .nasa-sub-select-currencies .nav-dropdown-mobile').hide();
                }
            }

            if ($('.nasa-menusub-for-mobile .li_accordion a.accordion').length) {
                $('.nasa-menusub-for-mobile .li_accordion a.accordion').append(ns_arr_up);
            }
        } else {
            if ($('#mobile-navigation').find('.nasa-m-account').length) {
                $('#mobile-navigation').find('.nasa-m-account').remove();
            }

            if ($('#mobile-navigation').find('.nasa-select-languages').length) {
                $('#mobile-navigation').find('.nasa-select-languages').remove();
            }

            if ($('#mobile-navigation').find('.nasa-select-currencies').length) {
                $('#mobile-navigation').find('.nasa-select-currencies').remove();
            }
        }
    });

    /**
     * Window Scroll
     */
    var headerHeight = $('#header-content').length ? $('#header-content').height() : 0;
    
    // var timeOutFixedHeader;
    $(window).on('scroll', function () {
        var scrollTop = $(this).scrollTop();
        var _nasa_scroll_titles_sticky = $('.woocommerce-tabs .nasa-scroll-titles');
        var _responsive = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
        var _inMobile = $('body').hasClass('nasa-in-mobile') ? true : false;
        var screen_h = $(window).height();
        var content_height = $('#nasa-footer').length ? $('#main-content').outerHeight() + $('#nasa-footer').outerHeight() : $('#main-content').outerHeight();
        var _device = $('body').attr('data-elementor-device-mode');

        if ($('body').find('.nasa-header-sticky').length && $('.sticky-wrapper').length && $(_nasa_scroll_titles_sticky).length <= 0 && screen_h < content_height) {
            var fix_top = $('#wpadminbar').length ? $('#wpadminbar').height() : 0;
            var fix_nasa_promo_bg = $('.nasa-promo-bg').length ? $('.nasa-promo-bg').height() : 0;
            var fix_nasa_topbar_wrap = $('.nasa-topbar-wrap').length ? $('.nasa-topbar-wrap').height() : 0;
            var _heightFixed = $('.sticky-wrapper').outerHeight();
            var final_height = (Math.round(fix_nasa_promo_bg+fix_nasa_topbar_wrap) > 0)? (fix_nasa_promo_bg+fix_nasa_topbar_wrap) : headerHeight;

            if (Math.round(scrollTop) > Math.round(final_height)) {
                if (!$('.sticky-wrapper').hasClass('fixed-already')) {
                    $('.sticky-wrapper').addClass('fixed-already');

                    if (!$('.sticky-wrapper').hasClass('product-header')) {
                        $('.nasa-header-sticky').css({'margin-bottom': _heightFixed});
                        
                        if (
                            $('.nasa-header-sticky').hasClass('header-type-2') ||
                            $('.nasa-header-sticky').hasClass('header-type-3') ||
                            $('.nasa-header-sticky').hasClass('header-type-4') ||
                            $('.nasa-header-sticky').hasClass('header-type-6')
                        ) {
                            setTimeout(function() {
                                _heightFixed = $('.sticky-wrapper').outerHeight();
                                $('.nasa-header-sticky').animate({'margin-bottom': _heightFixed}, 100);
                            }, 100);
                        }
                    }

                    if (fix_top > 0) {
                        $('.sticky-wrapper').css({top: fix_top});
                    }
                }
            } else {
                $('.sticky-wrapper').removeClass('fixed-already');
                $('.nasa-header-sticky').removeAttr('style');
                $('.sticky-wrapper').removeAttr('style');

                _heightFixed = $('.sticky-wrapper').outerHeight();
            }

            if ($('.nasa-product-details-page').hasClass('nasa-layout-modern-4')) {
                var _top = _device == 'mobile'? 0: fix_top + _heightFixed + 30 ;
                $('.nasa-product-details-page').find('.ns-pos-sticky').css({top: _top});
            }
        }

        var _checkout_m = $('.checkout-modern-wrap');
        if ($(_checkout_m).length) {
            var nasa_bc_modern = $(_checkout_m).find('.nasa-bc-modern');
            var _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
            
            if (_mobileView) {
                $(_checkout_m).find('.checkout-modern-left-wrap').css("padding-top", nasa_bc_modern.outerHeight() +'px' );
            }
            
            if (scrollTop > 5) { 
                if (!$(nasa_bc_modern).hasClass('fixed-already')) {
                    $(nasa_bc_modern).addClass('fixed-already');
                }
            } else {
                $(nasa_bc_modern).removeClass('fixed-already');
            }
        }

        if ($('.nasa-nav-extra-warp').length) {
            if (scrollTop > headerHeight) {
                if (!$('.nasa-nav-extra-warp').hasClass('nasa-show')) {
                    $('.nasa-nav-extra-warp').addClass('nasa-show');
                }
            } else {
                if ($('.nasa-nav-extra-warp').hasClass('nasa-show')) {
                    $('.nasa-nav-extra-warp').removeClass('nasa-show');
                }
            }
        }

        /* Back to Top */
        if ($('#nasa-back-to-top').length) {
            if (typeof intervalBTT !== 'undefined' && intervalBTT) {
                clearInterval(intervalBTT);
            }

            var intervalBTT = setInterval(function () {
                var _height_win = $(window).height() / 2;
                if (scrollTop > _height_win) {
                    if (!$('#nasa-back-to-top').hasClass('nasa-show')) {
                        $('#nasa-back-to-top').addClass('nasa-show');
                    }
                } else {
                    $('#nasa-back-to-top').removeClass('nasa-show');
                }

                clearInterval(intervalBTT);
            }, 100);
        }

        /**
         * Scroll Sticky Sidebar
         */
        if ($('.ns-sticky-scroll-sidebar').length && $('.nasa-toggle-widgets-alc').length) {
            if (!_responsive && !_inMobile) {
                var _pos = null,
                    _topfix = 0;

                if ($('.nasa-single-product-slide').length) {
                    _pos = $('.nasa-single-product-slide').offset();

                } else  if ($('.nasa-products-page-wrap').length) {
                    _pos = $('.nasa-products-page-wrap').offset();

                }

                if ($('.fixed-already').length === 1) {
                    var _fixed_height = $('.fixed-already').outerHeight();
                    _topfix += _fixed_height;
                }

                if ($('#wpadminbar').length === 1) {
                    var _admbar_height = $('#wpadminbar').outerHeight();
                    _topfix += _admbar_height;
                }

                var _start_top = _pos.top - _topfix,
                    _topbar = scrollTop - _start_top +10;

                if (_topbar >= 0) {                    
                    $('.ns-sticky-scroll-sidebar').css({'top': _topfix + 10});
                    
                } else {
                    $('.ns-sticky-scroll-sidebar').removeAttr('style');
                }

            } else {
                $('.ns-sticky-scroll-sidebar').removeAttr('style');
            }
        }

        /**
         * scroll ns-static-block-popup
         */
        if ($('.ns-static-block-popup').length && $('.ns-static-block-popup').hasClass('nasa-active')) {
            var _static_block = $('body').find('.ns-static-block-popup');
            $(_static_block).removeClass('nasa-active');
            $('.ns-toggle-popup-static-block').removeClass('active');

            setTimeout(function() {
                $(_static_block).remove();
            },400);
        }
    });

    /**
     * Window Resize
     */
    var _positionMobileMenu;
    
    $(window).on('resize', function () {
        _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;

        _inMobile = $('body').hasClass('nasa-in-mobile') ? true : false;

        _tabletView = $('.nasa-check-reponsive.nasa-tablet-check').length && $('.nasa-check-reponsive.nasa-tablet-check').width() === 1 ? true : false;

        // Fix Sidebar Mobile, Search Mobile display switch to desktop
        var desk = $('.black-window').hasClass('desk-window');
        if (!_mobileView && !desk && !_inMobile && !_tabletView) {
            if ($('.col-sidebar').length) {
                $('.col-sidebar').removeClass('nasa-active');
            }
            if ($('.warpper-mobile-search').length && !$('.warpper-mobile-search').hasClass('show-in-desk')) {
                $('.warpper-mobile-search').removeClass('nasa-active');
            }
            if ($('.black-window').length) {
                $('.black-window').hide();
            }
        }

        var _height_adminbar = $('#wpadminbar').length ? $('#wpadminbar').height() : 0;
        if (_height_adminbar > 0 && $('#mobile-navigation').length) {
            $('#nasa-menu-sidebar-content').css({ 'top': _height_adminbar });

            if ($('#mobile-navigation').attr('data-show') === '1' && !_mobileView && $('.nasa-menu-off').length <= 0) {
                var _scrollTop = $(window).scrollTop();
                var _headerHeight = $('#header-content').height() + 50;
                if (_scrollTop <= _headerHeight) {
                    $('.black-window').trigger('click');
                }
            }
        }
        
        if (_height_adminbar > 0 && $('.account-nav-wrap').length) {
            $('.account-nav-wrap').css({ 'top': _height_adminbar });
        }
        
        /**
         * Tabs Slide
         */
        if ($('.nasa-slide-style').length) {
            $('.nasa-slide-style').each(function () {
                var _this = $(this);
                nasa_tab_slide_style($, _this, 500);
            });
        }

        if (_mobileView || _inMobile) {
            if (typeof _positionMobileMenu !== 'undefined') {
                clearTimeout(_positionMobileMenu);
            }

            _positionMobileMenu = setTimeout(function () {
                position_menu_mobile($);
            }, 100);
        }
    });

    $('body').on('nasa_before_init_menu_mobile', function () {
        position_menu_mobile($);
    });

    /**
     * Check template
     */
    $('body').on('nasa_check_template', function (e, _panels) {
        if ($(_panels).find('.nasa-panel .nasa-tmpl').length) {
            $(_panels).find('.nasa-panel').each(function () {
                $('body').trigger('nasa_render_template', [this]);
            });

            $('body').trigger('nasa_rendered_template');
        }

        e.preventDefault();
    });

    /**
     * when disable WOW with Tabs
     */
    if (!$('body').hasClass('nasa-enable-wow')) {
        $('body').on('nasa_after_changed_tab_content', function (e, currentTab) {
            e.preventDefault();

            var nasa_slick_element = $(currentTab).find('.nasa-slick-slider');

            if ($(nasa_slick_element).length) {
                $('body').trigger('nasa_unslick', [nasa_slick_element]);
                $('body').trigger('nasa_load_slick_slider');
            }
        });
    }

    /*******************************************************************/
    /*! Promo popup */
    /*******************************************************************/
    var et_popup_closed = $.cookie('nasa_popup_closed');
    if (et_popup_closed !== 'do-not-show' && $('#nasa-popup').length && $('body').hasClass('open-popup')) {
        var _wrap = $('#nasa-popup');
        var _delayremoVal = parseInt($(_wrap).attr('data-delay'));
        _delayremoVal = !_delayremoVal ? 300 : _delayremoVal * 1000;
        var _disableMobile = $(_wrap).attr('data-disable_mobile') === 'true' ? true : false;
        
        if (_disableMobile && $(window).width() < 768) {
            return;
        }
        
        $(_wrap).show().addClass('ns-ongoing');
        
        setTimeout(function () {
            $('body').addClass('ovhd');
            
            $(_wrap).addClass('nasa-active');
            $('.black-window').fadeIn(200).addClass('desk-window');
        }, _delayremoVal);

        $('body').on('click', '#nasa-popup input[type="submit"]', function () {
            $(this).ajaxSuccess(function (event, request, settings) {
                if (typeof request === 'object' && request.responseJSON.status === 'mail_sent') {
                    $('body').append('<div id="nasa-newsletter-alert" class="hidden-tag"><div class="wpcf7-response-output wpcf7-mail-sent-ok">' + request.responseJSON.message + '</div></div>');

                    $.cookie('nasa_popup_closed', 'do-not-show', {expires: _cookie_live, path: '/'});

                    setTimeout(function () {
                        $('#nasa-newsletter-alert').fadeIn(300);

                        setTimeout(function () {
                            $('#nasa-newsletter-alert').fadeOut(500);
                        }, 2000);
                    }, 300);
                }
            });
        });
    }

    /* ADD PRODUCT WISHLIST NUMBER */
    $('body').on('added_to_wishlist', function () {
        if (typeof nasa_ajax_params !== 'undefined' && typeof nasa_ajax_params.ajax_url !== 'undefined') {
            var _data = {};
            _data.action = 'nasa_update_wishlist';
            _data.added = true;

            if ($('.nasa-value-gets').length && $('.nasa-value-gets').find('input').length) {
                $('.nasa-value-gets').find('input').each(function () {
                    var _key = $(this).attr('name');
                    var _val = $(this).val();
                    _data[_key] = _val;
                });
            }

            $.ajax({
                url: nasa_ajax_params.ajax_url,
                type: 'post',
                dataType: 'json',
                cache: false,
                data: _data,
                beforeSend: function () {

                },
                success: function (res) {
                    $('.wishlist_sidebar').replaceWith(res.list);
                    var _sl_wishlist = (res.count).toString().replace('+', '');
                    var sl_wislist = parseInt(_sl_wishlist);
                    $('.nasa-mini-number.wishlist-number').html(res.count);

                    if (sl_wislist > 0) {
                        $('.nasa-mini-number.wishlist-number').removeClass('nasa-product-empty');
                    } else if (sl_wislist === 0 && !$('.nasa-mini-number.wishlist-number').hasClass('nasa-product-empty')) {
                        $('.nasa-mini-number.wishlist-number').addClass('nasa-product-empty');
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

                    setTimeout(function () {
                        init_wishlist_icons($, true);
                        $('.btn-wishlist').removeClass('nasa-disabled');
                    }, 350);
                },
                error: function () {
                    $('.btn-wishlist').removeClass('nasa-disabled');
                }
            });
        }
    });
    
    /* REMOVE FROM Yith Wishlist */
    $('body').on('removed_from_wishlist', function() {
        var _table = $('.wishlist_table');
        var _count = $(_table).find('.wishlist-items-wrapper [data-row-id]').length;
        
        $('.ns-mini-yith-wcwl .nasa-wishlist-count').html(_count);
        
        if (_count <= 0) {
            $('.ns-mini-yith-wcwl .nasa-wishlist-count').addClass('nasa-product-empty');
        }
    });

    // Target quantity inputs on product pages
    $('body').find('input.qty:not(.product-quantity input.qty)').each(function () {
        var min = parseFloat($(this).attr('min'));
        if (min && min > 0 && parseFloat($(this).val()) < min) {
            $(this).val(min);
        }
    });

    $('body').on('click', '.plus, .minus', function () {
        // Get values
        var $qty = $(this).parents('.quantity').find('.qty'),
            form = $(this).parents('.cart'),
            button_add = $(form).length ? $(form).find('button[type="submit"].single_add_to_cart_button') : false,
            currentVal = parseFloat($qty.val()),
            max = parseFloat($qty.attr('max')),
            min = parseFloat($qty.attr('min')),
            step = $qty.attr('step');

        var _old_val = $qty.val();
        $qty.attr('data-old', _old_val);

        // Format values
        currentVal = !currentVal ? 0 : currentVal;
        max = !max ? '' : max;
        min = !min ? 0 : min;

        if (
            typeof step === 'undefined' ||
            step === 'any' ||
            step === '' ||
            parseFloat(step) === 'NaN'
        ) {
            step = 1;
        }

        // Change the value Plus
        if ($(this).hasClass('plus')) {
            if (max && (max == currentVal || currentVal > max)) {
                $qty.val(max);
                if (button_add && button_add.length) {
                    button_add.attr('data-quantity', max);
                }
            } else {
                $qty.val(currentVal + parseFloat(step));
                if (button_add && button_add.length) {
                    button_add.attr('data-quantity', currentVal + parseFloat(step));
                }
            }
        }

        // Change the value Minus
        else {
            if (min && (min == currentVal || currentVal < min)) {
                $qty.val(min);
                if (button_add && button_add.length) {
                    button_add.attr('data-quantity', min);
                }
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
                if (button_add && button_add.length) {
                    button_add.attr('data-quantity', currentVal - parseFloat(step));
                }
            }
        }

        // Trigger change event
        $qty.trigger('change');
    });

    /**
     * Mobile Search
     */
    $('body').on('click', '.mobile-search', function () {
        $('.black-window').fadeIn(200).addClass('desk-window');

        if (!$('body').hasClass('m-ovhd')) {
            $('body').addClass('m-ovhd');
        }

        /**
         * Build content search form
         */
        if ($('.warpper-mobile-search').length) {
            var _root_search = $('.warpper-mobile-search');

            if ($('#tmpl-nasa-mobile-search').length) {
                var _content = $('#tmpl-nasa-mobile-search').html();
                $(_root_search).html(_content);
                $('#tmpl-nasa-mobile-search').remove();
            }

            if ($(_root_search).find('.nasa-tmpl-search-mobile').length) {
                var _content = $(_root_search).find('.nasa-tmpl-search-mobile').html();
                $(_root_search).find('.nasa-tmpl-search-mobile').replaceWith(_content);
            }
        }

        var height_adminbar = $('#wpadminbar').length ? $('#wpadminbar').height() : 0;

        if (height_adminbar > 0) {
            $('.warpper-mobile-search').css({ top: height_adminbar });
        }

        if (!$('.warpper-mobile-search').hasClass('nasa-active')) {
            $('.warpper-mobile-search').addClass('nasa-active');
        }

        /**
         * Focus input
         * @returns {undefined}
         */
        setTimeout(function () {
            if ($('.warpper-mobile-search').find('label').length) {
                $('.warpper-mobile-search').find('label').trigger('click');
            }
        }, 210);
    });

    $('body').on('focus', 'input[name="s"]', function () {
        var _wrap = $(this).parents('.search-wrapper');
        var _close = $(_wrap).find('.nasa-close-search-mobile');
        if ($(_close).length && !$(_close).hasClass('nasa-active')) {
            $(_close).addClass('nasa-active');
        }
    });

    if ($('input[name="nasa_cart_sidebar_show"]').length && $('input[name="nasa_cart_sidebar_show"]').val() === '1') {
        $(window).trigger('resize');
        
        setTimeout(function () {
            $('.cart-link').trigger('click');
        }, 300);
    }

    $('body').on('nasa_processed_wishlist', function () {
        if ($('.nasa-tr-wishlist-item').length <= 0 && $('.ns-cart-popup-wrap.nasa-active').length <= 0) {
            $('.black-window').trigger('click');
        }
    });

    /**
     * Close by fog window
     */
    $('body').on('click', '.black-window, .white-window, .transparent-desktop, .transparent-mobile, .transparent-window, .nasa-close-mini-compare, .nasa-sidebar-close a, .nasa-sidebar-return-shop, .login-register-close, .nasa-close-menu-mobile', function () {

        if ($('#nasa-age-verification-popup-wrap.nasa-active').length) {
            return;
        }
        _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;

        _inMobile = $('body').hasClass('nasa-in-mobile') ? true : false;

        $('.black-window').removeClass('desk-window');
        $('.transparent-window').removeClass('desk-window');
        $('.transparent-mobile').removeClass('desk-window');

        if ($('#mobile-navigation').length && $('#mobile-navigation').attr('data-show') === '1') {
            if ($('#nasa-menu-sidebar-content').length) {
                $('#nasa-menu-sidebar-content').removeClass('nasa-active');
            }

            $('#mobile-navigation').attr('data-show', '0');
            setTimeout(function () {
                $('.black-window').removeClass('nasa-transparent');
            }, 1000);
        }

        if ($('.warpper-mobile-search').length) {
            $('.warpper-mobile-search').removeClass('nasa-active');
            if ($('.warpper-mobile-search').hasClass('show-in-desk')) {
                setTimeout(function () {
                    $('.warpper-mobile-search').removeClass('show-in-desk');
                }, 600);
            }
        }

        /**
         * Close form - single product
         */
        if ($('.nasa-single-product-in-mobile form.cart.variations_form.ns-show .ns-form-close').length) {
            if ($('.nasa-single-product-in-mobile .nasa-node-content.ns-actived').length <= 0) {
                $('.nasa-single-product-in-mobile form.cart.variations_form.ns-show .ns-form-close').trigger('click');
            } else {
                $('.black-window').addClass('desk-window');
            }
        }

        /**
         * in mobile node popup
         */
        if ($('#review_form_wrapper.ns-show .ns-form-close').length) {
            $('#review_form_wrapper.ns-show .ns-form-close').trigger('click');
        }

        if ($('.nasa-node-content.ns-actived .ns-node-close').length) {
            $('.nasa-node-content.ns-actived .ns-node-close').trigger('click');
        }

        if ($('.nasa-product-360-degree.ns-actived').length) {
            $('.nasa-product-360-degree.ns-actived .close-360-degree').trigger('click');
        }

        /**
         * close popup
         */
        if ($('.nasa-popup-exit-intent-wrap .nasa-popup-exit-intent-close').length) {
            $('.nasa-popup-exit-intent-wrap .nasa-popup-exit-intent-close').trigger('click');
        }

        if ($('.nasa-promo-popup-wrap .nasa-popup-close').length) {
            $('.nasa-promo-popup-wrap .nasa-popup-close').trigger('click');
        }

        /**
         * Close sidebar
         */
        if ($('.col-sidebar').length) {
            $('.col-sidebar').removeClass('nasa-active');
        }

        /**
        * Close sidebar my acccount
        */
        if ($('.account-nav-wrap').length) {
            $('.account-nav-wrap').removeClass('nasa-active');
        }

        /**
         * Close Dokan sidebar
         */
        if ($('.dokan-store-sidebar').length) {
            $('.dokan-store-sidebar').removeClass('nasa-active');
        }

        /**
         * Close cart popup
         */
        if ($('.ns-cart-popup-wrap').length && $('.ns-cart-popup-wrap').hasClass('nasa-active')) {
            $('.ns-cart-popup-wrap').find('.popup-cart-close').trigger('click');
        }

        /**
         * Close cart sidebar
         */
        if ($('#cart-sidebar').length) {
            $('#cart-sidebar').removeClass('nasa-active');

            /**
             * Close Ext Cart Note
             */
            if ($('#cart-sidebar .close-nodes').length) {
                $('#cart-sidebar .close-nodes').trigger('click');
            }
        }

        /**
         * Close wishlist sidebar
         */
        if ($('#nasa-wishlist-sidebar').length) {
            $('#nasa-wishlist-sidebar').removeClass('nasa-active');
        }

        /**
         * Close viewed sidebar
         */
        if ($('#nasa-viewed-sidebar').length) {
            $('#nasa-viewed-sidebar').removeClass('nasa-active');
        }

        /**
         * Close quick view sidebar
         */
        if ($('#nasa-quickview-sidebar').length) {
            $('#nasa-quickview-sidebar').removeClass('nasa-active');
        }

        /**
         * Close quick view sidebar popup
         */
        if ($('#nasa-quickview-popup').length) {
            $('#nasa-quickview-popup').find('.nasa-quickview-popup-close').trigger('click');
        }

        /**
         * Close filter categories sidebar in mobile
         */
        if ($('.nasa-top-cat-filter-wrap-mobile').length) {
            $('.nasa-top-cat-filter-wrap-mobile').removeClass('nasa-show');
        }

        /**
         * Close sidebar
         */
        if ($('.nasa-side-sidebar').length) {
            $('.nasa-side-sidebar').removeClass('nasa-show');
        }

        if ($('.nasa-top-sidebar').length) {
            $('.nasa-top-sidebar').removeClass('nasa-active');
        }

        /**
         * Close login or register
         */
        if ($('.nasa-login-register-warper').length) {
            $('.nasa-login-register-warper').removeClass('nasa-active');

            if ($('.nasa-login-register-warper').find('.nasa-congrat').length) {
                window.location.reload();
            }

            setTimeout(function () {
                $('.nasa-login-register-warper').hide();
            }, 350);
        }

        /**
         * Languages
         */
        if ($('.nasa-current-lang').length) {
            var _wrapLangs = $('.nasa-current-lang').parents('.nasa-select-languages');
            if ($(_wrapLangs).length) {
                $(_wrapLangs).removeClass('nasa-active');
            }
        }

        /**
         * Currencies
         */
        if ($('.wcml-cs-item-toggle').length) {
            var _wrapCurrs = $('.wcml-cs-item-toggle').parents('.nasa-select-currencies');
            if ($(_wrapCurrs).length) {
                $(_wrapCurrs).removeClass('nasa-active');
            }
        }

        /**
         * Check out login
        */
        if ($('.checkout-modern-wrap .woocommerce-form-login').hasClass('nasa-active')) {
            $('.checkout-modern-wrap .woocommerce-form-login-toggle .showlogin').trigger('click');
        }

        /**
         * Close .nasa-push-cat-filter-type-3 .ns-top-bar-side-canvas Cat Canvas
        */
        if ($('.nasa-push-cat-filter-type-3 .ns-top-bar-side-canvas').hasClass('nasa-push-cat-show')) {
            $('.nasa-top-bar-3-content a.nasa-tab-filter-topbar').trigger('click');
        }

        /**
         * Hide compare product
         */
        hide_compare($);

        /**
         * Remove Body Overflow - Hidden
         */
        $('body').removeClass('ovhd');
        $('body').removeClass('m-ovhd');

        $('body').trigger('nasa_after_close_fog_window');

        if ($('.nasa-mobile-app form.cart.variations_form.ns-show').length <= 0) {
            $('.white-window, .transparent-mobile, .transparent-window, .transparent-desktop').fadeOut(1000);
            $('.black-window').fadeOut(500);
        }
    });

    /**
     * ESC from keyboard
     */
    $(document).on('keyup', function (e) {
        if (e.keyCode === 27) {
            $('.nasa-tranparent').trigger('click');
            $('.nasa-tranparent-filter').trigger('click');
            $('.black-window, .white-window, .transparent-desktop, .transparent-mobile, .transparent-window, .nasa-close-mini-compare, .nasa-sidebar-close a, .login-register-close, .nasa-transparent-topbar, .nasa-close-filter-cat').trigger('click');
            $('body').trigger('nasa_after_clicked');
            
            /**
             * Close Magnific
             */
            $('body').trigger('ns_magnific_popup_close');
        }

        e.preventDefault();
    });

    /**
     * Add to cart in quick-view Or single product
     */
    $('body').on('click', 'form.cart button[type="submit"].single_add_to_cart_button', function () {
        $('.nasa-close-notice').trigger('click');

        var _flag_adding = true;
        var _this = $(this);
        var _form = $(_this).parents('form.cart');

        $('body').trigger('nasa_before_click_single_add_to_cart', [_form]);

        if ($(_form).find('#yith_wapo_groups_container').length) {
            $(_form).find('input[name="nasa-enable-addtocart-ajax"]').remove();

            if ($(_form).find('.nasa-custom-fields input[name="nasa_cart_sidebar"]').length) {
                $(_form).find('.nasa-custom-fields input[name="nasa_cart_sidebar"]').val('1');
            } else {
                $(_form).find('.nasa-custom-fields').append('<input type="hidden" name="nasa_cart_sidebar" value="1" />');
            }
        }

        var _enable_ajax = $(_form).find('input[name="nasa-enable-addtocart-ajax"]');
        if ($(_enable_ajax).length <= 0 || $(_enable_ajax).val() !== '1') {
            _flag_adding = false;
            return;
        } else {
            var _disabled = $(_this).hasClass('disabled') || $(_this).hasClass('nasa-ct-disabled') ? true : false;
            var _id = !_disabled ? $(_form).find('input[name="data-product_id"]').val() : false;
            if (_id && !$(_this).hasClass('loading')) {
                var _type = $(_form).find('input[name="data-type"]').val(),
                    _quantity = $(_form).find('.quantity input[name="quantity"]').val(),
                    _variation_id = $(_form).find('input[name="variation_id"]').length ? parseInt($(_form).find('input[name="variation_id"]').val()) : 0,
                    _variation = {},
                    _data_wishlist = {},
                    _from_wishlist = (
                        $(_form).find('input[name="data-from_wishlist"]').length === 1 &&
                        $(_form).find('input[name="data-from_wishlist"]').val() === '1'
                    ) ? '1' : '0';

                if (_type === 'variable' && !_variation_id) {
                    _flag_adding = false;
                    return false;
                } else {
                    if (_variation_id > 0 && $(_form).find('.variations').length) {
                        $(_form).find('.variations').find('select').each(function () {
                            _variation[$(this).attr('name')] = $(this).val();
                        });

                        if ($('.wishlist_table').length && $('.wishlist_table').find('tr#yith-wcwl-row-' + _id).length) {
                            _data_wishlist = {
                                from_wishlist: _from_wishlist,
                                wishlist_id: $('.wishlist_table').attr('data-id'),
                                pagination: $('.wishlist_table').attr('data-pagination'),
                                per_page: $('.wishlist_table').attr('data-per-page'),
                                current_page: $('.wishlist_table').attr('data-page')
                            };
                        }
                    }
                }

                if (_flag_adding) {
                    $('body').trigger('nasa_single_add_to_cart', [_this, _id, _quantity, _type, _variation_id, _variation, _data_wishlist]);
                }
            }

            return false;
        }
    });

    /**
     * Click bundle add to cart
     */
    $('body').on('click', '.nasa_bundle_add_to_cart', function (e) {
        var _this = $(this),
            _id = $(_this).attr('data-product_id');
        if (_id) {
            var _type = $(_this).attr('data-type'),
                _quantity = $(_this).attr('data-quantity'),
                _variation_id = 0,
                _variation = {},
                _data_wishlist = {};

            $('body').trigger('nasa_single_add_to_cart', [_this, _id, _quantity, _type, _variation_id, _variation, _data_wishlist]);
        }

        e.preventDefault();
    });

    /**
     * Click to variation add to cart
     */
    $('body').on('click', '.product_type_variation.add-to-cart-grid', function (e) {
        var _this = $(this);

        if ($(_this).hasClass('nasa-quick-add') && !$(_this).hasClass('nasa-modern-8-add')) {
            var _pa = $(_this).parents('.product-item');
            $(_pa).addClass('nasa-modern-8-var-active');
        
        } else if (!$(_this).hasClass('nasa-disable-ajax')) {
            if (!$(_this).hasClass('loading')) {
                var _id = $(_this).attr('data-product_id');
                if (_id) {
                    var _type = 'variation',
                        _quantity = $(_this).attr('data-quantity'),
                        _variation_id = 0,
                        _variation = null,
                        _data_wishlist = {};

                    if (typeof $(_this).attr('data-variation_id') !== 'undefined') {
                        _variation_id = $(_this).attr('data-variation_id');
                    }

                    if (typeof $(_this).attr('data-variation') !== 'undefined') {
                        _variation = JSON.parse($(_this).attr('data-variation'));
                    }

                    if (_variation) {
                        $('body').trigger('nasa_single_add_to_cart', [_this, _id, _quantity, _type, _variation_id, _variation, _data_wishlist]);
                    } else {
                        var _href = $(_this).attr('href');
                        window.location.href = _href;
                    }
                }
            }

            return false;
        }

        e.preventDefault();
    });

    /**
     * Click select option
     */
    $('body').on('click', '.product_type_variable', function (e) {
        e.preventDefault();
        
        var _this = $(this);
        
        if ($('body').hasClass('ns-wcdfslsops')) {
            var _href = $(_this).attr('href');
            if (_href) {
                window.location.href = _href;
            }
        } else {
            var _parent = $(_this).parents('.product-item');

            if ($('body').hasClass('nasa-quickview-on')) {
                if (
                    !$(_this).hasClass('add-to-cart-grid') ||
                    $(_this).parents('.nasa-table-compare').length ||
                    $(_this).parents('.compare-list').length ||
                    $(_this).parents('.product-deal-special-buttons').length
                ) {
                    var _href = $(_this).attr('href');
                    if (_href) {
                        window.location.href = _href;
                    }

                    return;
                }

                else {
                    if (!$(_this).hasClass('btn-from-wishlist')) {

                        if ($(_this).hasClass('nasa-before-click')) {
                            $('body').trigger('nasa_after_click_select_option', [_this]);
                        }
                        else if ($(_this).hasClass('nasa-quick-add') && !$('.nasa-content-page-products .products').hasClass('list')) {
                            if ($(_parent).hasClass('out-of-stock')) {
                                var _href = $(_this).attr('href');
                                if (_href) {
                                    window.location.href = _href;
                                }

                                return;
                            } else {
                                $('body').trigger('nasa_after_click_quick_add', [_this]);
                            }

                        } else {
                            if ($(_parent).find('.variations_form').length && !$('.nasa-content-page-products .products').hasClass('list')) {
                                $(_parent).addClass('ns-var-active');
                            } else {
                                $(_parent).find('.quick-view').trigger('click');
                            }

                        }
                    }

                    /**
                     * From Wishlist
                     */
                    else {
                        var _parent = $(_this).parents('.add-to-cart-wishlist');
                        if ($(_parent).length && $(_parent).find('.quick-view').length) {
                            $(_parent).find('.quick-view').trigger('click');
                        }
                    }

                    return false;
                }
            }

            else {
                if ($(_this).hasClass('nasa-before-click')) {
                    $('body').trigger('nasa_after_click_select_option', [_this]);

                    return false;
                } else {
                    if ($(_this).hasClass('nasa-quick-add') && !$('.nasa-content-page-products .products').hasClass('list')) {
                        if ($(_parent).hasClass('out-of-stock')) {
                            var _href = $(_this).attr('href');
                            if (_href) {
                                window.location.href = _href;
                            }

                            return;
                        } else {
                            $('body').trigger('nasa_after_click_quick_add', [_this]);
                        }
                    } else {
                        if ($(_parent).find('.variations_form').length && !$('.nasa-content-page-products .products').hasClass('list')) {
                            $(_parent).addClass('ns-var-active');
                        } else {
                            var _href = $(_this).attr('href');
                            if (_href) {
                                window.location.href = _href;
                            }

                            return;
                        }
                    }

                }
            }
        }
    });

    /**
     * After remove cart item in mini cart
     */
    $('body').on('wc_fragments_loaded', function (e) {
        if ($('#cart-sidebar .woocommerce-mini-cart-item').length <= 0) {
            _confetti_run = false;

            $('.black-window').trigger('click');
            $.cookie('nasa_curent_per_shipping', 0, {expires: _cookie_live, path: '/'});
        }

        $('body').trigger('mini_cart_mobile_layout_change');
        
        if ($('body').hasClass('woocommerce-checkout')) {
            $('body').trigger('update_checkout');
        }

        e.preventDefault();
    });

    $('body').on('updated_wc_div', function (e) {
        /**
         * notification free shipping
         */
        init_shipping_free_notification($, true);

        init_nasa_notices($);

        e.preventDefault();
    });
    
    $('body').on('click', '.ajax_add_to_cart:not(.nasa-disable-ajax)', function(e) {
        e.preventDefault();
    });

    /**
     * Before Add To Cart
     */
    var _nasa_clear_added_to_cart;
    $('body').on('adding_to_cart', function (e) {
        if ($('.nasa-close-notice').length) {
            $('.nasa-close-notice').trigger('click');
        }

        if (typeof _nasa_clear_added_to_cart !== 'undefined') {
            clearTimeout(_nasa_clear_added_to_cart);
        }

        e.preventDefault();
    });
    
    /**
     * After Add To Cart
     */
    $('body').on('added_to_cart', function (ev, fragments, cart_hash, _button) { 
        /**
         * Close quick-view
         */
        $('body').trigger('ns_magnific_popup_close');

        var _event_add = $('input[name="nasa-event-after-add-to-cart"]').length && $('input[name="nasa-event-after-add-to-cart"]').val() ? $('input[name="nasa-event-after-add-to-cart"]').val() : 'sidebar';

        var _cart_sidebar = $('#cart-sidebar');
        var is_update_mini_cart = $(_cart_sidebar).hasClass('nasa_update_from_mini_cart')? true : false;

        $('#cart-sidebar .widget_shopping_cart_content_frag').remove();
        /**
         * Not _button
         */
        if (typeof _button === 'undefined') {
            _event_add = 'sidebar';
        }

        /**
         * Only show Notice in cart or checkout page
         */
        if ($('form.woocommerce-cart-form').length) {
            _event_add = 'notice';
        }

        /**
         * Loading content After Add To Cart - Popup your order
         */
        if ((_event_add === 'popup' || _event_add === 'popup_2') && $('form.nasa-shopping-cart-form, form.woocommerce-checkout').length <= 0 && !is_update_mini_cart) {
            after_added_to_cart($);

            setTimeout(function () {
                /**
                 * notification free shipping
                 */
                init_shipping_free_notification($, true);
            }, 500);
        }

        /**
         * Show Mini Cart Sidebar
         */
        if (_event_add === 'sidebar' || is_update_mini_cart) {
            if ($('input[name="ns-not-preload-mcart"]').length) {
                $('.black-window').fadeIn(200).addClass('desk-window');
                $('#nasa-wishlist-sidebar').removeClass('nasa-active');

                if ($('#cart-sidebar').length && !$('#cart-sidebar').hasClass('nasa-active')) {
                    $('#cart-sidebar').addClass('nasa-active');
                }
            }
            
            $('body').trigger('nasa_opened_cart_sidebar');
            $('#cart-sidebar').removeClass('crazy-loading nasa_update_from_mini_cart');
            
            /**
             * notification free shipping
             */
            setTimeout(function () {
                init_shipping_free_notification($, true);
            }, 50);
        }

        /**
         * Show notice
         */
        if (_event_add === 'notice' && typeof fragments['.woocommerce-message'] !== 'undefined') {
            if ($('.nasa-close-notice').length) {
                $('.nasa-close-notice').trigger('click');
            }

            set_nasa_notice($, fragments['.woocommerce-message']);

            if (typeof _nasa_clear_added_to_cart !== 'undefined') {
                clearTimeout(_nasa_clear_added_to_cart);
            }

            _nasa_clear_added_to_cart = setTimeout(function () {
                if ($('.nasa-close-notice').length) {
                    $('.nasa-close-notice').trigger('click');
                }
            }, 5000);
        }

        ev.preventDefault();
    });

    /**
     * auto Update Cart
     */
    $('body').on('change', '.after-add-to-cart-form.qty-auto-update .qty', function () {
        var _form = $(this).parents('form.after-add-to-cart-form');

        if ($(_form).find('.nasa-update-cart-popup').length) {
            $(_form).find('.nasa-update-cart-popup').removeClass('nasa-disable');
            $(_form).find('.nasa-update-cart-popup').trigger('click');
        }
    });

    /**
     * Close header canvas - Header type 7
     */
    $('body').on('nasa_after_clicked', function () {
        if ($('.nasa-close-canvas').length) {
            $('.nasa-close-canvas').trigger('click');
        }
    });

    /**
     * Animate Scroll To Top
     */
    $('body').on('nasa_animate_scroll_to_top', function (ev, $, _dom, _ms) {
        ev.preventDefault();
        animate_scroll_to_top($, _dom, _ms);
    });

    /**
     * Buy Now for Quick view and single product page
     */
    $('body').on('click', 'form.cart .nasa-buy-now', function (e) {
        if (!$(this).hasClass('loading')) {
            $(this).addClass('loading');

            var _form = $(this).parents('form.cart');

            if ($(_form).find('button[type="submit"].single_add_to_cart_button.disabled').length) {
                $('.nasa-buy-now').removeClass('loading');
                $(_form).find('button[type="submit"].single_add_to_cart_button.disabled').trigger('click');
            } else {
                if ($(_form).find('input[name="nasa_buy_now"]').length) {
                    if ($('input[name="nasa-enable-addtocart-ajax"]').length) {
                        $('input[name="nasa-enable-addtocart-ajax"]').val('0');
                    }

                    $(_form).find('input[name="nasa_buy_now"]').val('1');

                    setTimeout(function () {
                        $(_form).find('button[type="submit"].single_add_to_cart_button').trigger('click');
                    }, 10);
                }
            }
        }

        e.preventDefault();
    });

    /**
     * notification free shipping
     */
    if ($('.nasa-total-condition').length) {
        setTimeout(function () {
            init_shipping_free_notification($);
        }, 1000);
    }

    /**
     * GDPR Notice
     */
    // $.cookie('nasa_gdpr_notice', '0', {expires: 30, path: '/'});
    if ($('.nasa-cookie-notice-container').length) {
        var nasa_gdpr_notice = $.cookie('nasa_gdpr_notice');
        
        if (typeof nasa_gdpr_notice === 'undefined' || !nasa_gdpr_notice || nasa_gdpr_notice === '0') {
            setTimeout(function () {
                $('.nasa-cookie-notice-container').addClass('nasa-active');
            }, 1000);
        }

        $('body').on('click', '.nasa-accept-cookie', function (e) {
            $.cookie('nasa_gdpr_notice', '1', {expires: _cookie_live, path: '/'});
            $('.nasa-cookie-notice-container').removeClass('nasa-active');

            e.preventDefault();
        });
    }

    /**
     * After loaded ajax store
     */
    $('body').on('nasa_after_loaded_ajax_complete', function (e, destroy_masonry, _more) {
        e.preventDefault();
        after_load_ajax_list($, destroy_masonry);
        init_accordion($);

        if (!_more) {
            init_menu_mobile($, true);
        }
    });

    /**
     * Single Product Add to cart
     */
    $('body').on('nasa_single_add_to_cart', function (_ev, _this, _id, _quantity, _type, _variation_id, _variation, _data_wishlist) {
        nasa_single_add_to_cart($, _this, _id, _quantity, _type, _variation_id, _variation, _data_wishlist);
        _ev.preventDefault();
    });

    if ($('.nasa-trigger-click').length) {
        setTimeout(function () {
            $('.nasa-trigger-click').trigger('click');
        }, 100);
    }

    /**
     * For Header Builder Icon menu mobile switcher
     */
    if ($('.header-type-builder').length && $('.nasa-nav-extra-warp').length <= 0) {
        $('body').append('<div class="nasa-nav-extra-warp nasa-show"><div class="desktop-menu-bar"><div class="mini-icon-mobile"><a href="javascript:void(0);" class="nasa-mobile-menu_toggle bar-mobile_toggle"><svg viewBox="0 0 32 32" width="26" height="24" fill="currentColor"><path d="M 4 7 L 4 9 L 28 9 L 28 7 Z M 4 15 L 4 17 L 28 17 L 28 15 Z M 4 23 L 4 25 L 28 25 L 28 23 Z"/></svg></a></div></div></div>');
    }

    /**
     * Append Style Off Canvas
     */
    $('body').on('nasa_append_style_off_canvas', function (e) {
        if ($('#nasa-style-off-canvas').length && $('#nasa-style-off-canvas-css').length <= 0) {
            var _link_style = $('#nasa-style-off-canvas').attr('data-link');
            var _stylesheet = '<link rel="stylesheet" id="nasa-style-off-canvas-css" href="' + _link_style + '" />';
            $('head').append(_stylesheet);
            $('#nasa-style-off-canvas').remove();
        }

        e.preventDefault();
    });

    /**
     * Append Style Mobile Menu
     */
    $('body').on('nasa_append_style_mobile_menu', function (e) {
        if ($('#nasa-style-mobile-menu').length && $('#nasa-style-mobile-menu-css').length <= 0) {
            var _link_style = $('#nasa-style-mobile-menu').attr('data-link');
            var _stylesheet = '<link rel="stylesheet" id="nasa-style-mobile-menu-css" href="' + _link_style + '" />';
            $('head').append(_stylesheet);
            $('#nasa-style-mobile-menu').remove();
        }

        e.preventDefault();
    });

    /**
     * Append Style Cross Sell Cart 
     */
    $('body').on('nasa_append_style_cross_sell_cart', function (e) {
        if ($('#cross-sell-popup-cart-style').length && $('#cross-sell-popup-cart-style-css').length <= 0) {
            var _link_style = $('#cross-sell-popup-cart-style').attr('data-link');
            var _stylesheet = '<link rel="stylesheet" id="cross-sell-popup-cart-style-css" href="' + _link_style + '" />';
            $('head').append(_stylesheet);
            $('#cross-sell-popup-cart-style').remove();
        }

        e.preventDefault();
    });

    /**
     * Make only 2 column in cross sells - Cart Sidebar
     */
    $('body').on('wc_fragments_refreshed wc_fragments_loaded', function () {
        $('body').trigger('nasa_cross_sell_columns_setting', [$('#cart-sidebar .cross-sells').find('.nasa-slick-slider')]);
        $('body').trigger('nasa_load_countdown');
    });

    $('body').on('nasa_cross_sell_columns_setting', function (e, _cross_sells) {

        if ($(_cross_sells).length) {
            var _modern_8 = $(_cross_sells).hasClass('nasa-modern-8') ? true : false;
            /**
             * Change Button Layout to Default
             */
            $(_cross_sells).removeClass('nasa-ver-buttons');
            $(_cross_sells).removeClass('nasa-hoz-buttons');
            $(_cross_sells).removeClass('nasa-modern-1');
            $(_cross_sells).removeClass('nasa-modern-2');
            $(_cross_sells).removeClass('nasa-modern-3');
            $(_cross_sells).removeClass('nasa-modern-4');
            $(_cross_sells).removeClass('nasa-modern-5');
            $(_cross_sells).removeClass('nasa-modern-6');
            $(_cross_sells).removeClass('nasa-modern-7');
            $(_cross_sells).removeClass('nasa-modern-8');

            if ($(_cross_sells).parents('#cart-sidebar').length) {
                if (!$(_cross_sells).hasClass('nasa-modern-1')) {
                    $(_cross_sells).addClass('nasa-modern-1');
                }
                
                var _pr = $(_cross_sells).parents('.cross-sells');
                //$(_cross_sells).removeClass('slick-initialized');
                $(_cross_sells).attr('data-columns', '1');
                $(_cross_sells).attr('data-columns-tablet', '1');
                $(_cross_sells).attr('data-columns-small', '1');
                $(_cross_sells).attr('data-padding-small', '10%');
                $(_cross_sells).attr('data-padding-medium', '20%');
                $(_cross_sells).attr('data-padding', '20%').addClass('margin-bottom-20');

                $(_pr).find('.nasa-slide-style-product-carousel').removeClass('margin-bottom-20').addClass('margin-bottom-10');
                $(_pr).find('.nasa-slide-style-product-carousel .nasa-shortcode-title-slider').removeClass('text-center fs-25');
            }

            if ($(_cross_sells).parents('.ns-popup-container_v2').length) {
                $(_cross_sells).find('.product-item').each(function() {
                    var _this = $(this);
                    var _img_wrap = $(_this).find('.product-img-wrap');
                    var _btn_wishlist =$(_img_wrap).find('.nasa-group-btns .btn-wishlist');
                    $(_img_wrap).prepend(_btn_wishlist);
                });

                if (!$(_cross_sells).hasClass('nasa-modern-5')) {
                    $(_cross_sells).addClass('nasa-modern-5');
                }

                $(_cross_sells).attr('data-columns', '4');
                $(_cross_sells).attr('data-columns-tablet', '3');
                $(_cross_sells).attr('data-columns-small', '2');
            }

            if (!$(_cross_sells).hasClass('nasa-nav-top')) {
                $(_cross_sells).addClass('nasa-nav-top');
            }

            $('body').trigger('nasa_reload_slick_slider_private', $(_cross_sells).parents('.cross-sells'));

            if ($(_cross_sells).find('.product-item').length) {
                $(_cross_sells).find('.product-item').each(function () {
                    var _this = $(this);
                    var _btn = $(_this).find('.nasa-group-btns .add-to-cart-grid:not(.nasa-modern-8-add)');
                    if ($(_btn).length <= 0 ) {
                        _btn = $(_this).find('.add-to-cart-grid:eq(0)');
                    }
                    

                    if ($(_btn).length) {
                        if ($(_cross_sells).parents('#cart-sidebar').length) {
                            $(_this).find('.product-info-wrap').append(_btn);
                        }else{
                            $(_this).find('.nasa-group-btns').append(_btn);
                        }
                    }

                    if ($(_cross_sells).parents('#cart-sidebar').length) {
                        $(_this).find('.product-img').removeClass('loop-gallery-carousel');
                    }
                });
            }

            $('body').trigger('nasa_append_style_cross_sell_cart');
        }
    });

    /**
     * Load Content Static Blocks
     */
    if (
        typeof nasa_ajax_params !== 'undefined' &&
        typeof nasa_ajax_params.wc_ajax_url !== 'undefined'
    ) {
        var _urlAjaxStaticContent = nasa_ajax_params.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_ajax_static_content');

        var _data_static_content = {};
        var _call_static_content = false;
        
        if ($('input[name="nasa_yith_wishlist_actived"]').length) {
            _data_static_content['reload_yith_wishlist'] = '1';
            _call_static_content = true;
        }

        if (_call_static_content) {
            if ($('.nasa-value-gets').length && $('.nasa-value-gets').find('input').length) {
                $('.nasa-value-gets').find('input').each(function () {
                    var _key = $(this).attr('name');
                    var _val = $(this).val();
                    _data_static_content[_key] = _val;
                });
            }

            $.ajax({
                url: _urlAjaxStaticContent,
                type: 'post',
                data: _data_static_content,
                cache: false,
                success: function (result) {
                    if (typeof result !== 'undefined' && result.success === '1') {
                        $.each(result.content, function (key, value) {
                            if ($(key).length) {
                                $(key).replaceWith(value);

                                if (key === '#nasa-wishlist-sidebar-content') {
                                    init_wishlist_icons($);
                                }
                            }
                        });
                    }

                    $('body').trigger('nasa_after_load_static_content');
                }
            });
        }
    }

    /**
     * Fix vertical mega menu
     */
    if ($('.vertical-menu-wrapper').length) {
        $('.vertical-menu-wrapper').attr('data-over', '0');

        $('.vertical-menu-container').each(function () {
            var _this = $(this);
            var _h_vertical = $(_this).height();
            $(_this).find('.nasa-megamenu >.nav-dropdown').each(function () {
                $(this).find('>.sub-menu').css({'min-height': _h_vertical});
            });
        });
    }
    
    /* $('body').trigger('ns_magnific_popup_parent', [".gallery a[href$='.jpg'], .gallery a[href$='.jpeg'], .featured-item a[href$='.jpeg'], .featured-item a[href$='.gif'], .featured-item a[href$='.jpg'], .page-featured-item .slider > a, .page-featured-item .page-inner a > img, .gallery a[href$='.png'], .gallery a[href$='.jpeg'], .gallery a[href$='.gif']", {
        delegate: 'a',
        type: 'image',
        tLoading: '<div class="nasa-loader"></div>',
        tClose: $('input[name="nasa-close-string"]').val(),
        mainClass: 'my-mfp-zoom-in',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
        }
    }]); */

    /**
     * Accordions
     */
    init_accordion($);

    /**
     * Tabs Slide
     */
    if ($('.nasa-tabs.nasa-slide-style').length) {
        setTimeout(function () {
            $('.nasa-slide-style').each(function () {
                var _this = $(this);
                nasa_tab_slide_style($, _this, 500);
            });
        }, 500);
    }

    if ($('.nasa-active').length) {
        $('.nasa-active').each(function () {
            if ($(this).parents('.nasa-show-less').length) {
                $(this).parents('.nasa-show-less').show();
            }
        });
    }

    /**
     * init Mini wishlist icon
     */
    init_mini_wishlist($);

    /**
     * init wishlist icon
     */
    init_wishlist_icons($);

    /**
     * init Compare icons
     */
    init_compare_icons($, true);

    /**
     * init Widgets
     */
    init_widgets($);

    /**
     * Refresh when page is shown after back button (Safari | Chrome)
     */
    $(window).on('pageshow', function () {
        setTimeout(function () {
            if ($('.widget_shopping_cart_content').find('>*').length <= 0) {
                $('#cart-sidebar').append('<div class="nasa-loader"></div>');
                $('body').trigger('wc_fragment_refresh');
            }
        }, 100);
    });

    /**
     * Fragments Ajax Error
     */
    var _fragments_ajax_error_callback = false;
    $('body').on('wc_fragments_ajax_error', function () {
        if (!_fragments_ajax_error_callback) {
            _fragments_ajax_error_callback = true;

            if ($('.widget_shopping_cart_content').find('>*').length <= 0) {
                $('#cart-sidebar').append('<div class="nasa-loader"></div>');
                $('body').trigger('wc_fragment_refresh');
            }
        }
    });

    /**
     * Fragments Refreshed
     */
    $('body').on('wc_fragments_refreshed', function () {
        /**
         * notification free shipping
         */
        init_shipping_free_notification($, true);

        $('body').trigger('mini_cart_mobile_layout_change');
        
        if ($('#cart-sidebar').length) {
            $('#cart-sidebar').find('.nasa-loader').remove();
        }
    });

    /**
     * init shipping free notification
     */
    $('body').on('nasa_init_shipping_free_notification', function () {
        init_shipping_free_notification($);
    });

    /**
     * Recount group icons in Header
     */
    $('body').on('nasa_before_load_ajax', function (e) {
        if ($('.cart-inner').length) {
            $('.cart-inner').each(function () {
                _nasa_cart['.cart-inner'] = $(this);

                return true;
            });
        }

        e.preventDefault();
    });

    $('body').on('nasa_after_load_ajax', function (e) {
        /**
         * Refress Cart icon
         */
        if (typeof _nasa_cart['.cart-inner'] !== 'undefined') {
            $('.cart-inner').replaceWith(_nasa_cart['.cart-inner']);
        }

        /**
         * init Mini wishlist icon
         */
        init_mini_wishlist($);

        /**
         * init Compare icons
         */
        init_compare_icons($, true);

        e.preventDefault();
    });

    /**
     * Notice Woocommerce
     */
    if (!$('body').hasClass('woocommerce-cart')) {
        $('.woocommerce-notices-wrapper').each(function () {
            var _this = $(this);

            setTimeout(function () {
                if ($(_this).find('a').length <= 0) {
                    $(_this).html('');
                }

                if ($(_this).find('.woocommerce-message').length) {
                    $(_this).find('.woocommerce-message').each(function () {
                        if ($(this).find('a').length <= 0) {
                            $(this).fadeOut(200);
                        }
                    });
                }
            }, 3000);
        });
    }

    init_nasa_notices($);
    
    /**
     * Age verification
     */
    if ($('#nasa-age-verification-popup-tmp').length) {
        $('body').on('nasa_age_verification', function() {
            var _verification = $.cookie('nasa_age_verification_ck');

            if (_verification !== 'true') {
                /**
                 * Pre load stylesheet Off Canvas
                 */
                $('body').trigger('nasa_append_style_off_canvas');
                
                if ($('#nasa-age-verification-popup-tmp').length) {
                    var tmp = $('#nasa-age-verification-popup-tmp').html();
                    $('#nasa-age-verification-popup-tmp').replaceWith(tmp);
                }
                
                setTimeout(function(){
                    if ($('#nasa-age-verification-popup-wrap').length) {
                        $('#nasa-age-verification-popup-wrap').addClass('nasa-active nasa-trs');
                        $('.black-window').fadeIn(200).addClass('desk-window');

                        if (!$('body').hasClass('ovhd')) {
                            $('body').addClass('ovhd');
                        }
                    }
                }, 1000);
            }
        }).trigger('nasa_age_verification');

        $('body').on('click', '.nasa-over-18, .nasa-under-18', function() {
            var _this = $(this);
            var _pa = $(_this).parents('#nasa-age-verification-popup-wrap');
            var _value = false;

            if ($(_this).hasClass('nasa-under-18')) {
                $(_pa).addClass('ns-restricted');
            } else {
                _value = true;
                $(_pa).removeClass('nasa-active');
                $('body').removeClass('ovhd');
                $('.black-window').fadeOut(200).removeClass('desk-window');
                
                setTimeout(function(){
                    $(_pa).remove();
                }, 400);
            }

            $.cookie('nasa_age_verification_ck', _value, {expires: _cookie_live, path: '/'});
        });
    }
    
    /**
     * Check wpadminbar
     */
    if ($('#wpadminbar').length) {
        var height_adminbar = $('#wpadminbar').height();

        $("head").append('<style>#wpadminbar {position: fixed !important;}html.html-ready {margin-top: 0!important;}html.html-ready body {padding-top: ' + height_adminbar + 'px;}</style>');

        $('#cart-sidebar, #nasa-wishlist-sidebar, #nasa-viewed-sidebar, #nasa-quickview-sidebar, .nasa-top-cat-filter-wrap-mobile, .nasa-side-sidebar, .account-nav-wrap').css({ 'top': height_adminbar });

        if (_mobileView || _inMobile || _tabletView) {
            $('.col-sidebar').css({'top': height_adminbar});
        }

        $(window).on('resize', function (e) {
            _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
            _tabletView = $('.nasa-check-reponsive.nasa-tablet-check').length && $('.nasa-check-reponsive.nasa-tablet-check').width() === 1 ? true : false;

            height_adminbar = $('#wpadminbar').height();

            $('#cart-sidebar, #nasa-wishlist-sidebar, #nasa-viewed-sidebar, #nasa-quickview-sidebar, .nasa-top-cat-filter-wrap-mobile, .nasa-side-sidebar .account-nav-wrap').css({ 'top': height_adminbar });

            if (_mobileView || _inMobile || _tabletView) {
                $('.col-sidebar').css({ 'top': height_adminbar });
            }

            e.preventDefault();
        });
    }

    // $(window).trigger('scroll').trigger('resize');

    /**
     * Unblock a node after processing is complete.
     *
     * @param {JQuery Object} $node
     */
    var nasa_unblock = function ($node) {
        $node.removeClass('processing').unblock();
    };

    /**
     * Delay js files
     * Pre load mobile menu style
     * Pre load stylesheet Off Canvas
     * 
     */
    if (!$('body').hasClass('ns-nodelay-assets')) {
        $(window).on('touchstart scroll resize mousemove', function() {
            if ($('[type=nasa_delay_script]').length) {

                var _body = document.getElementsByTagName('body')[0];

                $('[type=nasa_delay_script]').each(function () {
                    var _this = $(this);

                    var _src = $(_this).attr('src'),
                        _id = $(_this).attr('id'),
                        _text = $(_this).text(),
                        _scrt = document.createElement('script');

                    _scrt.type = 'text/javascript';
                    _scrt.text = _text;

                    if (typeof _src !== 'undefined') {
                        _scrt.src = _src;
                    }

                    if (typeof _id !== 'undefined') {
                        _scrt.id = _id;
                    }

                    _body.appendChild(_scrt);

                    $(_this).remove();
                });
            }

            /**
             * Pre load mobile menu style
             */
            $('body').trigger('nasa_append_style_mobile_menu');

            /**
             * Pre load stylesheet Off Canvas
             */
            $('body').trigger('nasa_append_style_off_canvas');
        });
    }

    /**
     * Promo auto slide 
     */
    $('body').on('nasa-content-promotion-auto-slide', function() {
        var _nasa_promo_custom = $('.nasa-content-promotion-custom');
        
        if ($(_nasa_promo_custom).length && $(_nasa_promo_custom).hasClass('nasa-promo-silde')) {
            var _main_params = {
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                infinite: true,
                autoplaySpeed: 5000,
                speed: 500,
                arrows: false,
                dots: false,
                adaptiveHeight: true,
                vertical: true,
                verticalSwiping: true
            };
            
            $('body').trigger('nasa_element_slick_params', [_nasa_promo_custom, _main_params]);

            // $(_nasa_promo_custom).slick(_main_params);
        }
    });
});
/* End Document Ready */
