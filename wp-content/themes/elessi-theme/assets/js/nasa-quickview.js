/**
 * global nasa_params_quickview
 */
if (typeof _single_variations === 'undefined') {
    var _single_variations = [];
}

var _quicked_gallery = true,
    _nasa_calling_gallery = 0,
    // _nasa_calling_countdown = 0,
    _lightbox_variations,
    _qv_img_loaded,
    nasa_quick_viewimg = false,
    quickview_html = [],
    setMaxHeightQVPU;

/**
 * Document Ready !!!
 */
jQuery(document).ready(function ($) {
    "use strict";

    var _nasa_in_mobile = $('body').hasClass('nasa-in-mobile') ? true : false;

    /**
     * Open Quickview Popup (No longer used as of 22/12/2023)
     */
    // $('body').on('quickview_popup_open', function (e, _wrap) {
    //     e.preventDefault();

    //     var _src_check = $('.product-lightbox .nasa-product-gallery-lightbox').attr('data-o_href');

    //     if (typeof _qv_img_loaded !== 'undefined') {
    //         clearInterval(_qv_img_loaded);
    //     }
    //     _qv_img_loaded = setInterval(function () {
    //         var _img_check = new Image();
    //         _img_check.src = _src_check;

    //         _img_check.onload = function () {
    //             $('body').trigger('ns_magnific_popup_open', [{
    //                 // mainClass: 'my-mfp-slide-bottom',
    //                 items: {
    //                     src: '#nasa-quickview-popup',
    //                     type: 'inline'
    //                 },
    //                 closeMarkup: '<a class="nasa-mfp-close nasa-stclose" href="javascript:void(0);" title="' + $('input[name="nasa-close-string"]').val() + '"></a>',
    //                 callbacks: {
    //                     beforeOpen: function() {
    //                         this.st.mainClass = this.st.mainClass + ' ' + 'nasa-left-to-right';
                            
    //                         setTimeout(function (){
    //                             $('.mfp-wrap').addClass('ns-active');
    //                         },100);
    //                     },
    //                     beforeClose: function() {
    //                         this.st.removalDelay = 500;
    //                     },
    //                     afterClose: function () {
    //                         if (typeof setMaxHeightQVPU !== 'undefined') {
    //                             clearInterval(setMaxHeightQVPU);
    //                         }
    //                     }
    //                 }
    //             }]);

    //             if ($(_wrap).length) {
    //                 $(_wrap).find('.nasa-loader, .color-overlay, .nasa-dark-fog, .nasa-light-fog').remove();
    //             }

    //             $('body').trigger('nasa_after_quickview_timeout');

    //             clearInterval(_qv_img_loaded);
    //         };
    //     }, 10);
    // });

    /**
     * Quick view
     */
    $('body').on('click', '.quick-view', function (e) {
        /**
         * Close Magnific
         */
        $('body').trigger('ns_magnific_popup_close');
        
        /**
         * Append stylesheet Off Canvas
         */
        $('body').trigger('nasa_append_style_off_canvas');
        
        /**
         * Close Exit Intent Popup
         */
        $('body').trigger('ns_exit_intent_pop_close');

         /**
         * Close Nasa Side Bar Single Product
         */
        $('.nasa-side-sidebar').removeClass('nasa-show');

        if ($('body').hasClass('nasa-mobile-app')) {
            $('#nasa-wishlist-sidebar').removeClass('nasa-active');
        }

        if ($('.ns-cart-popup-wrap').length && $('.ns-cart-popup-wrap').hasClass('nasa-active')) {
            if ($('.ns-cart-popup-wrap').find('.ns-popup-container_v2').length) {
                var _pr_item = $('.ns-cart-popup-wrap');

                $(_pr_item).addClass('ns-left-to-right');
                setTimeout(function () {
                    $(_pr_item).removeClass('ns-left-to-right nasa-active').hide();
                    $(_pr_item).find('.ns-cross-sell-lazy').removeClass('nasa-active');
                }, 350);
            } else {
                $('.ns-cart-popup-wrap .popup-cart-close').trigger('click');
            }
        }

        $('.nasa-static-sidebar').removeClass('nasa-active');

        nasa_quick_viewimg = true;

        if ($('.nasa-close-notice').length) {
            $('.nasa-close-notice').trigger('click');
        }

        if (
            typeof nasa_params_quickview !== 'undefined' &&
            typeof nasa_params_quickview.wc_ajax_url !== 'undefined'
        ) {
            var _urlAjax = nasa_params_quickview.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_quick_view');
            var _this = $(this);
            var _product_type = $(_this).attr('data-product_type');

            if (_product_type === 'woosb' && typeof $(_this).attr('data-href') !== 'undefined') {
                window.location.href = $(_this).attr('data-href');
            }

            else {
                var _wrap = $(_this).parents('.product-item'),
                    product_id = $(_this).attr('data-prod'),
                    _wishlist = ($(_this).attr('data-from_wishlist') === '1') ? '1' : '0';

                if ($(_wrap).length <= 0) {
                    _wrap = $(_this).parents('.item-product-widget');
                }

                if ($(_wrap).length <= 0) {
                    _wrap = $(_this).parents('.wishlist-item-warper');
                }

                if ($(_wrap).length) {
                    $(_wrap).append('<div class="nasa-light-fog"></div><div class="nasa-loader"></div>');
                }

                var _data = {
                    product: product_id,
                    nasa_wishlist: _wishlist
                };

                if ($('.nasa-value-gets').length && $('.nasa-value-gets').find('input').length) {
                    $('.nasa-value-gets').find('input').each(function () {
                        var _key = $(this).attr('name');
                        var _val = $(this).val();
                        _data[_key] = _val;
                    });
                }

                var sidebar_holder = $('#nasa-quickview-sidebar').length === 1 ? true : false;

                var _close = '<a class="nasa-mfp-close nasa-quickview-popup-close nasa-stclose" href="javascript:void(0);" title="' + $('input[name="nasa-close-string"]').val() + '"></a>';

                if (!sidebar_holder) {
                    var _main_img = null;

                    if ($(this).parents('.product-item').length) {
            
                        _main_img = $(this).parents('.product-item').find('.product-img .main-img img');
            
                    } else if ($(this).parents('.item-product-widget').length) {
            
                        _main_img = $(this).parents('.item-product-widget').find('.nasa-widget-img img');
            
                    } else if ($(this).parents('.nasa-tr-wishlist-item').length) {
            
                        _main_img = $(this).parents('.nasa-tr-wishlist-item').find('.image-wishlist a img');
            
                    } else if ($(this).parents('.ns-sale-notification').length) {
                        _main_img = $(this).parents('.ns-sale-notification').find('.product-image img');
                    }
            
                    if ($(_main_img)) {
                        var _width = $(_main_img).attr('width');
                        var _height = $(_main_img).attr('height');
            
                        var _img_load_height = Math.round((_height*450))/_width;
                    }
                    
                    var _html_mask_load = '<div class="ns-mask-load">' +
                        _close +
                        '<div class="product-quickview-img" style="height: '+ _img_load_height + 'px;"></div>' +
                        '<div class="nasa-quickview-fog hidden-tag" style="height: ' + _img_load_height + 'px;">' +
                            '<div class="qv-crazy-info">' +
                                '<span class="info-1"></span>' +
                                '<span class="info-2 margin-top-20"></span>' +
                                '<span class="info-3 margin-top-20"></span>' +
                                '<span class="info-4 margin-top-40"></span>' +
                                '<span class="info-5 margin-top-10"></span>' +
                                '<span class="info-6 margin-top-40"></span>' +
                                '<span class="info-6-2 margin-top-20"></span>' +
                                '<span class="info-7 nasa-flex margin-top-40">' +
                                    '<span class="info-7-1"></span>' +
                                    '<span class="info-7-2"></span>' +
                                    '<span class="info-7-3"></span>' +
                                '</span>' +
                                '<span class="info-8 margin-top-40"></span>' +
                                '<span class="info-8 margin-top-20"></span>' +
                            '</div>' +
                        '</div>'+
                    '</div>';

                    var _nasa_quickview_popup = $('#nasa-quickview-popup');

                    if ($(_nasa_quickview_popup).length < 1) {
                        $('body').append('<div id="nasa-quickview-popup" class="nasa-crazy-load qv-loading product-lightbox">' + _html_mask_load + '</div>');
                        _nasa_quickview_popup = $('#nasa-quickview-popup');
                        $(_nasa_quickview_popup).find('.row.product').prepend(_close);
                    } else {
                        $(_nasa_quickview_popup).html(_html_mask_load);
                        $(_nasa_quickview_popup).find('.row.product').prepend(_close);
                    }

                    $('.black-window').fadeIn(200).addClass('desk-window');
                    $(_nasa_quickview_popup).show();
                    $('body').addClass('ovhd');

                    setTimeout(function() {
                        $(_nasa_quickview_popup).addClass('nasa-active');
                    }, 50);
                }

                if (sidebar_holder && $('#nasa-quickview-sidebar').hasClass('nasa-crazy-load')) {
                    if (!$('#nasa-quickview-sidebar').hasClass('qv-loading')) {
                        $('#nasa-quickview-sidebar').addClass('qv-loading');
                    }
                }

                _data.quickview = sidebar_holder ? 'sidebar' : 'popup';

                var _callAjax = true;

                if (typeof quickview_html[product_id] !== 'undefined') {
                    _callAjax = false;
                }

                if (_callAjax) {
                    $.ajax({
                        url: _urlAjax,
                        type: 'post',
                        dataType: 'json',
                        data: _data,
                        cache: false,
                        beforeSend: function () {
                            if (sidebar_holder) {
                                $('#nasa-quickview-sidebar #nasa-quickview-sidebar-content').html(
                                    '<div class="nasa-loader"></div>'
                                );

                                $('.black-window').fadeIn(200).addClass('desk-window');

                                if (!$('body').hasClass('m-ovhd')) {
                                    $('body').addClass('m-ovhd');
                                }

                                $('#nasa-viewed-sidebar').removeClass('nasa-active');

                                if ($('#nasa-quickview-sidebar').length && !$('#nasa-quickview-sidebar').hasClass('nasa-active')) {
                                    $('#nasa-quickview-sidebar').addClass('nasa-active');
                                }
                            }

                            if ($('.nasa-static-wrap-cart-wishlist').length && $('.nasa-static-wrap-cart-wishlist').hasClass('nasa-active')) {
                                $('.nasa-static-wrap-cart-wishlist').removeClass('nasa-active');
                            }

                            if (typeof setMaxHeightQVPU !== 'undefined') {
                                clearInterval(setMaxHeightQVPU);
                            }
                        },
                        success: function (response) {
                            quickview_html[product_id] = response;

                            // Sidebar hoder
                            if (sidebar_holder) {
                                $('#nasa-quickview-sidebar #nasa-quickview-sidebar-content').html('<div class="product-lightbox">' + response.content + '</div>');

                                setTimeout(function () {
                                    $('#nasa-quickview-sidebar #nasa-quickview-sidebar-content .product-lightbox').addClass('nasa-loaded');
                                }, 50);

                                setTimeout(function () {
                                    if ($('#nasa-quickview-sidebar').hasClass('qv-loading')) {
                                        $('#nasa-quickview-sidebar').removeClass('qv-loading');
                                    }
                                }, 100);
                            }

                            // Popup classical
                            else {
                               $(_nasa_quickview_popup).html(response.content);
                               $(_nasa_quickview_popup).find('.row.product').prepend(_close);
                            }

                            setTimeout(function () {
                                $('body').trigger('nasa_after_quickview_timeout');
                            }, 10);

                            if ($(_wrap).length) {
                                $(_wrap).find('.nasa-loader, .color-overlay, .nasa-dark-fog, .nasa-light-fog').remove();
                            }

                            /**
                             * Init Gallery image
                             */
                            $('body').trigger('nasa_init_product_gallery_lightbox');

                            $('body').trigger('before_init_variations_form');

                            var formLightBox = $('.product-lightbox').find('.variations_form');

                            if ($(formLightBox).length) {
                                $(formLightBox).find('.single_variation_wrap').hide();

                                $(formLightBox).each(function () {
                                    var _form_var = $(this);
                                    $('body').trigger('init_quickview_variations_form', [_form_var]);

                                    $(_form_var).find('select').trigger('change');

                                    if ($(_form_var).find('.variations select option[selected="selected"]').length) {
                                        $(_form_var).find('.variations .reset_variations').css({'visibility': 'visible'}).show();
                                    }
                                });
                            }

                            if ($('.product-lightbox').find('.nasa-product-gallery-lightbox .main-image-slider').length && !$('.product-lightbox').find('.nasa-product-gallery-lightbox .main-image-slider').hasClass('nasa-nav-radius')) {
                                $('.product-lightbox').find('.nasa-product-gallery-lightbox .main-image-slider').addClass('nasa-nav-radius')
                            }

                            var groupLightBox = $('.product-lightbox').find('.woocommerce-grouped-product-list-item');
                            if ($(groupLightBox).length) {
                                $(groupLightBox).removeAttr('style');
                                $(groupLightBox).removeClass('wow');
                            }

                            if (!sidebar_holder) {
                                setMaxHeightQVPU = setInterval(function () {
                                    var _h_l = $('.product-lightbox .product-img').outerHeight();

                                    $('.product-lightbox .product-quickview-info').css({
                                        'max-height': _h_l,
                                        'overflow-y': 'auto'
                                    });

                                    if (!$('.product-lightbox .product-quickview-info').hasClass('nasa-active')) {
                                        $('.product-lightbox .product-quickview-info').addClass('nasa-active');
                                    }

                                    if (_nasa_in_mobile) {
                                        clearInterval(setMaxHeightQVPU);
                                    }
                                }, 100);
                            }

                            $('body').trigger('nasa_after_quickview');
                        }
                    });
                } 
                else {
                    var quicview_obj = quickview_html[product_id];

                    if (sidebar_holder) {
                        $('#nasa-quickview-sidebar #nasa-quickview-sidebar-content').html(
                            '<div class="nasa-loader"></div>'
                        );

                        $('.black-window').fadeIn(200).addClass('desk-window');

                        if (!$('body').hasClass('m-ovhd')) {
                            $('body').addClass('m-ovhd');
                        }

                        $('#nasa-viewed-sidebar').removeClass('nasa-active');

                        if ($('#nasa-quickview-sidebar').length && !$('#nasa-quickview-sidebar').hasClass('nasa-active')) {
                            $('#nasa-quickview-sidebar').addClass('nasa-active');
                        }
                    }

                    if ($('.nasa-static-wrap-cart-wishlist').length && $('.nasa-static-wrap-cart-wishlist').hasClass('nasa-active')) {
                        $('.nasa-static-wrap-cart-wishlist').removeClass('nasa-active');
                    }

                    if (typeof setMaxHeightQVPU !== 'undefined') {
                        clearInterval(setMaxHeightQVPU);
                    }

                    // Sidebar hoder
                    if (sidebar_holder) {
                        $('#nasa-quickview-sidebar #nasa-quickview-sidebar-content').html('<div class="product-lightbox hidden-tag">' + quicview_obj.content + '</div>');

                        setTimeout(function () {
                            $('#nasa-quickview-sidebar #nasa-quickview-sidebar-content .product-lightbox').show();
                        }, 50);

                        setTimeout(function () {
                            if ($('#nasa-quickview-sidebar').hasClass('qv-loading')) {
                                $('#nasa-quickview-sidebar').removeClass('qv-loading');
                            }
                        }, 100);
                    }

                    // Popup classical
                    else {
                        $(_nasa_quickview_popup).html(quicview_obj.content);
                        $(_nasa_quickview_popup).find('.row.product').prepend(_close);
                    }

                    setTimeout(function () {
                        $('body').trigger('nasa_after_quickview_timeout');
                    }, 10);

                    if ($(_wrap).length) {
                        $(_wrap).find('.nasa-loader, .color-overlay, .nasa-dark-fog, .nasa-light-fog').remove();
                    }

                    /**
                     * Init Gallery image
                     */
                    $('body').trigger('nasa_init_product_gallery_lightbox');

                    $('body').trigger('before_init_variations_form');

                    var formLightBox = $('.product-lightbox').find('.variations_form');

                    if ($(formLightBox).length) {
                        $(formLightBox).find('.single_variation_wrap').hide();

                        $(formLightBox).each(function () {
                            var _form_var = $(this);
                            $('body').trigger('init_quickview_variations_form', [_form_var]);

                            $(_form_var).find('select').trigger('change');

                            if ($(_form_var).find('.variations select option[selected="selected"]').length) {
                                $(_form_var).find('.variations .reset_variations').css({ 'visibility': 'visible' }).show();
                            }
                        });
                    }

                    if ($('.product-lightbox').find('.nasa-product-gallery-lightbox .main-image-slider').length && !$('.product-lightbox').find('.nasa-product-gallery-lightbox .main-image-slider').hasClass('nasa-nav-radius')) {
                        $('.product-lightbox').find('.nasa-product-gallery-lightbox .main-image-slider').addClass('nasa-nav-radius')
                    }

                    var groupLightBox = $('.product-lightbox').find('.woocommerce-grouped-product-list-item');
                    if ($(groupLightBox).length) {
                        $(groupLightBox).removeAttr('style');
                        $(groupLightBox).removeClass('wow');
                    }

                    if (!sidebar_holder) {
                        setMaxHeightQVPU = setInterval(function () {
                            var _h_l = $('.product-lightbox .product-img').outerHeight();

                            $('.product-lightbox .product-quickview-info').css({
                                'max-height': _h_l,
                                'overflow-y': 'auto'
                            });

                            if (!$('.product-lightbox .product-quickview-info').hasClass('nasa-active')) {
                                $('.product-lightbox .product-quickview-info').addClass('nasa-active');
                            }

                            if (_nasa_in_mobile) {
                                clearInterval(setMaxHeightQVPU);
                            }
                        }, 100);
                    }

                    $('body').trigger('nasa_after_quickview');
                }
            }
        }

        e.preventDefault();
    });

    $('body').on('init_quickview_variations_form', function (e, formLightBox) {
        e.preventDefault();

        if ($(formLightBox).length) {

            $(formLightBox).wc_variation_form();
            $(formLightBox).nasa_quickview_variation_form();

            $('body').trigger('nasa_init_ux_variation_form');
        }
    });

    $.fn.nasa_quickview_variation_form = function () {
        return this.each(function () {
            var _form = $(this);

            $(_form).on('found_variation', function (e, variation) {
                e.preventDefault();
                var _this_form = $(this);

                // SKU
                var _sku = $(_this_form).parents('.product-info').find('.product_meta .sku');
                if ($(_sku).length) {
                    if (variation.sku) {
                        ns_set_sku_content($, _sku, variation.sku);
                    } else {
                        ns_reset_sku_content($, _sku);
                    }
                }

                if (!$(_this_form).hasClass('variations_form-3rd')) {
                    if ($(_this_form).find('.nasa-gallery-variation-supported').length) {
                        if ($(_this_form).parents('.product-item').hasClass('ns-var-loaded')) {
                            setTimeout(function () {
                                change_image_variable_quickview($, _this_form, variation);
                            }, 10);

                        } else {
                            change_gallery_variable_quickview($, _this_form, variation);
                        }

                    } else {
                        setTimeout(function () {
                            change_image_variable_quickview($, _this_form, variation);
                        }, 10);
                    }
                }

                if ($(_this_form).find('.add-request-quote-button').length) {
                    $(_this_form).find('.add-request-quote-button').removeClass('disabled');
                }
            }).on('reset_data', function (e) {
                e.preventDefault();
                var _this_form = $(this);

                // SKU
                var _sku = $(_this_form).parents('.product-info').find('.product_meta .sku');
                if ($(_sku).length) {
                    ns_reset_sku_content($, _sku);
                }

                if (!$(_this_form).hasClass('variations_form-3rd')) {
                    if ($(_this_form).find('.nasa-gallery-variation-supported').length) {
                        if ($(_this_form).parents('.product-item').hasClass('ns-var-loaded')) {
                            setTimeout(function () {
                                change_image_variable_quickview($, _this_form, null);
                            }, 10);

                        } else {
                            change_gallery_variable_quickview($, _this_form, null);
                        }
                    } else {
                        setTimeout(function () {
                            change_image_variable_quickview($, _this_form, null);
                        }, 10);
                    }
                }

                if ($(_this_form).find('.add-request-quote-button').length && !$(_this_form).find('.add-request-quote-button').hasClass('disabled')) {
                    $(_this_form).find('.add-request-quote-button').addClass('disabled');
                }
            });
        });
    };

    /**
     * Change gallery for variation - Quick view
     */
    $('body').on('nasa_changed_gallery_variable_quickview', function () {
        var wrap = $('#cart-sidebar .ext-nodes-wrap .mini-cart-change-variation');

        $('body').trigger('nasa_load_slick_slider');
        if ($(wrap).length) {
            $('body').trigger('update-price-stock-pos', [wrap]);
        }
    });

    /**
     * Init gallery lightbox
     */
    $('body').on('nasa_init_product_gallery_lightbox', function () {
        if ($('.product-lightbox').find('.nasa-product-gallery-lightbox').length) {
            _lightbox_variations[0] = {
                'quickview_gallery': $('.product-lightbox').find('.nasa-product-gallery-lightbox').html()
            };
        }
    });

    /**
     * After Close Fog Window
     */
    $('body').on('nasa_after_close_fog_window', function () {
        if ($('#nasa-quickview-popup.product-lightbox').length < 1) {
            nasa_quick_viewimg = false;
        }
    });

    /**
     * Btn add to cart select option to quick view
     */
    $('body').on('click', '.ajax_add_to_cart_variable', function () {
        if ($(this).parent().find('.quick-view').length) {
            $(this).parent().find('.quick-view').trigger('click');

            return false;
        } else {
            return;
        }
    });

    /**
     * Support for YITH Booking and Appointment for WooCommerce Premium
     */
    $('body').on('nasa_after_quickview', function () {
        $('body').trigger('yith-wcbk-init-booking-form');
        $('body').trigger('yith-wcbk-init-fields:selector');
        $('body').trigger('yith-wcbk-init-fields:help-tip');
        $('body').trigger('yith-wcbk-init-fields:select-list');

        /**
         * Compatible with Yith WooCommerce Request a Quote
         */
        if ($('.product-lightbox .yith-ywraq-add-to-quote').length > 1) {
            var _k = 0;
            $('.product-lightbox .yith-ywraq-add-to-quote').each(function () {
                var _this = $(this);
                if (_k > 0) {
                    $(_this).remove();
                }

                _k++;
            });
        }
        
        /**
         * Compatible - WooCommerce All Products For Subscriptions - Plugin
         */
        $('body').trigger('wcsatt-initialize');
    });

    /**
     * Compatible with Yith WooCommerce Request a Quote
     */
    $('body').on('nasa_init_ux_variation_form', function () {
        $('body').trigger('qv_loader_stop');
    });
});

/**
 * Support for Quick-view
 */
var _timeout_quickviewGallery;
var _prev_qv_image_id = 0;
function change_gallery_variable_quickview($, _form, variation) {
    var _crazy = true;
    if (_prev_qv_image_id && variation && variation.image_id) {
        _crazy = _prev_qv_image_id === variation.image_id ? false : true;
    }

    /**
     * Change galleries images
     */
    if (variation && variation.image && variation.image.src && variation.image.src.length > 1) {
        var _countSelect = $(_form).find('.variations .value select').length;
        var _selected = 0;
        if (_countSelect) {
            $(_form).find('.variations .value select').each(function () {
                if ($(this).val() !== '') {
                    _selected++;
                }
            });
        }

        if (_countSelect && _selected === _countSelect) {
            _quicked_gallery = false;

            if (typeof _lightbox_variations[variation.variation_id] === 'undefined') {
                if (
                    typeof nasa_params_quickview !== 'undefined' &&
                    typeof nasa_params_quickview.wc_ajax_url !== 'undefined'
                ) {
                    var _urlAjax = nasa_params_quickview.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_quickview_gallery_variation');

                    _nasa_calling_gallery = 1;

                    var _data = {
                        'variation_id': variation.variation_id,
                        'is_purchasable': variation.is_purchasable,
                        'is_in_stock': variation.is_in_stock,
                        'main_id': typeof variation.image_id !== 'undefined' ? variation.image_id : 0,
                        'gallery': typeof variation.nasa_gallery_variation !== 'undefined' ?
                            variation.nasa_gallery_variation : [],
                        'show_images': $('.product-lightbox').find('.main-image-slider').attr('data-items')
                    };

                    $.ajax({
                        url: _urlAjax,
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: {
                            data: _data
                        },
                        beforeSend: function () {
                            if (!$(_form).hasClass('nasa-processing')) {
                                $(_form).addClass('nasa-processing');
                            }

                            // $('.nasa-quickview-product-deal-countdown').html('');
                            // $('.nasa-quickview-product-deal-countdown').removeClass('nasa-show');

                            if (_crazy) {
                                if ($('#nasa-quickview-sidebar.nasa-crazy-load').length) {
                                    if (!$('.nasa-product-gallery-lightbox').hasClass('crazy-loading')) {
                                        $('.nasa-product-gallery-lightbox').addClass('crazy-loading');
                                    }
                                } else {
                                    if ($('.nasa-product-gallery-lightbox').find('.nasa-loading').length <= 0) {
                                        $('.nasa-product-gallery-lightbox').append('<div class="nasa-loading"></div>');
                                    }

                                    if ($('.nasa-product-gallery-lightbox').find('.nasa-loader').length <= 0) {
                                        $('.nasa-product-gallery-lightbox').append('<div class="nasa-loader" style="top:45%"></div>');
                                    }
                                }
                            }

                            $('.nasa-product-gallery-lightbox').css({ 'min-height': $('.nasa-product-gallery-lightbox').outerHeight() });
                        },
                        success: function (result) {
                            _nasa_calling_gallery = 0;

                            $(_form).removeClass('nasa-processing');

                            _lightbox_variations[variation.variation_id] = result;

                            /**
                             * Main image
                             */
                            if (typeof result.quickview_gallery !== 'undefined') {
                                $('.nasa-product-gallery-lightbox').find('.main-image-slider').replaceWith(result.quickview_gallery);
                            }

                            if (typeof _timeout_quickviewGallery !== 'undefined') {
                                clearTimeout(_timeout_quickviewGallery);
                            }

                            _timeout_quickviewGallery = setTimeout(function () {
                                $('.nasa-product-gallery-lightbox').find('.nasa-loading, .nasa-loader').remove();
                                $('.nasa-product-gallery-lightbox').css({ 'min-height': 'auto' });
                                $('.nasa-product-gallery-lightbox').removeClass('crazy-loading');
                            }, 200);

                            /**
                             * Trigger after changed gallery
                             */
                            $('body').trigger('nasa_changed_gallery_variable_quickview');
                        },
                        error: function () {
                            _nasa_calling_gallery = 0;
                            $(_form).removeClass('nasa-processing');
                            $('.nasa-product-gallery-lightbox').find('.nasa-loading, .nasa-loader').remove();
                            $('.nasa-product-gallery-lightbox').removeClass('crazy-loading');
                        }
                    });
                }
            } else {
                var result = _lightbox_variations[variation.variation_id];

                /**
                 * Main image
                 */
                if (typeof result.quickview_gallery !== 'undefined') {
                    if (_crazy) {
                        if ($('#nasa-quickview-sidebar.nasa-crazy-load').length) {
                            if (!$('.nasa-product-gallery-lightbox').hasClass('crazy-loading')) {
                                $('.nasa-product-gallery-lightbox').addClass('crazy-loading');
                            }
                        } else {
                            if ($('.nasa-product-gallery-lightbox').find('.nasa-loading').length <= 0) {
                                $('.nasa-product-gallery-lightbox').append('<div class="nasa-loading"></div>');
                            }

                            if ($('.nasa-product-gallery-lightbox').find('.nasa-loader').length <= 0) {
                                $('.nasa-product-gallery-lightbox').append('<div class="nasa-loader" style="top:45%"></div>');
                            }
                        }
                    }

                    $('.nasa-product-gallery-lightbox').css({ 'min-height': $('.nasa-product-gallery-lightbox').height() });

                    $('.nasa-product-gallery-lightbox').find('.main-image-slider').replaceWith(result.quickview_gallery);
                    if (typeof _timeout_quickviewGallery !== 'undefined') {
                        clearTimeout(_timeout_quickviewGallery);
                    }

                    _timeout_quickviewGallery = setTimeout(function () {
                        $('.nasa-product-gallery-lightbox').find('.nasa-loader, .nasa-loading').remove();
                        $('.nasa-product-gallery-lightbox').removeClass('crazy-loading');
                        $('.nasa-product-gallery-lightbox').css({ 'min-height': 'auto' });
                    }, 100);
                }

                _nasa_calling_gallery = 0;

                /**
                 * Trigger after changed gallery
                 */
                $('body').trigger('nasa_changed_gallery_variable_quickview');
            }
        }
    }

    /**
     * Default
     */
    else {
        if (!_quicked_gallery && typeof _lightbox_variations[0] !== 'undefined') {
            _quicked_gallery = true;
            var result = _lightbox_variations[0];

            /**
             * Main image
             */
            if (typeof result.quickview_gallery !== 'undefined') {
                $('.nasa-product-gallery-lightbox').find('.main-image-slider').replaceWith(result.quickview_gallery);
            }

            /**
             * Trigger after changed gallery
             */
            $('body').trigger('nasa_changed_gallery_variable_quickview');
        }
    }

    _prev_qv_image_id = variation && variation.image_id ? variation.image_id : null;

    /**
     * deal time
     */
    if ($('.nasa-quickview-product-deal-countdown').length) {
        $('.nasa-quickview-product-deal-countdown').html('');
        $('.nasa-quickview-product-deal-countdown').removeClass('nasa-show');

        if (variation && variation.variation_id && variation.is_in_stock && variation.is_purchasable) {
            var now = Date.now();

            if (typeof variation.deal_time !== 'undefined' && variation.deal_time && variation.deal_time.html && variation.deal_time.to > now && (typeof variation.deal_time.from === 'undefined' || variation.deal_time.from < now)) {
                $('.nasa-quickview-product-deal-countdown').html(variation.deal_time.html);
                $('body').trigger('nasa_load_countdown');
                if (!$('.nasa-quickview-product-deal-countdown').hasClass('nasa-show')) {
                    $('.nasa-quickview-product-deal-countdown').addClass('nasa-show');
                }
            }
        }
    }
}

/**
 * Change image variable Single product
 * 
 * @param {type} $
 * @param {type} _form
 * @param {type} variation
 * @returns {undefined}
 */
function change_image_variable_quickview($, _form, variation) {

    var _pa = $(_form).parents('.product-item');
    /**
     * Change gallery for single product variation
     */
    if (variation && variation.image && variation.image.src && variation.image.src.length > 1) {
        var _countSelect = $(_form).find('.variations .value select').length;
        var _selected = 0;
        if (_countSelect) {
            $(_form).find('.variations .value select').each(function () {
                if ($(this).val() !== '') {
                    _selected++;
                }
            });
        }

        if (_countSelect && _selected === _countSelect) {
            var src_thumb = false;

            /**
             * Support Bundle product
             */
            if ($('.product-lightbox .woosb-product').length) {
                if (variation.image.thumb_src !== 'undefined' || variation.image.gallery_thumbnail_src !== 'undefined') {
                    src_thumb = variation.image.gallery_thumbnail_src ? variation.image.gallery_thumbnail_src : variation.image.thumb_src;
                }

                if (src_thumb) {
                    $(_form).parents('.woosb-product').find('.woosb-thumb-new').html('<img src="' + src_thumb + '" />');
                    $(_form).parents('.woosb-product').find('.woosb-thumb-ori').hide();
                    $(_form).parents('.woosb-product').find('.woosb-thumb-new').show();
                }
            }

            else {
                var _src_large = typeof variation.image_single_page !== 'undefined' ?
                    variation.image_single_page : variation.image.url;

                var _src_large_back = typeof variation.nasa_variation_back_img !== 'undefined' ?
                variation.nasa_variation_back_img : null;
                $('.main-image-slider img.nasa-first').attr('src', _src_large).removeAttr('srcset');
                if ($(_form).parents('.product-item').length) {
                    $(_form).parents('.product-item').find('.main-img img:first-child').attr('src', _src_large).removeAttr('srcset');

                    if(_src_large_back !== null && $(_form).parents('.product-item').find('.back-img').length ) {
                        $(_form).parents('.product-item').find('.back-img img:first-child').attr('src', _src_large_back).removeAttr('srcset');
                    }
                }
            }
        }

    } else {
        /**
         * Support Bundle product
         */
        if ($('.product-lightbox .woosb-product').length) {
            $(_form).parents('.woosb-product').find('.woosb-thumb-ori').show();
            $(_form).parents('.woosb-product').find('.woosb-thumb-new').hide();
        } else {
            var image_large = $('.nasa-product-gallery-lightbox').attr('data-o_href');
            $('.main-image-slider img.nasa-first').attr('src', image_large).removeAttr('srcset');

            if ($(_pa).length) {
                var _src_large = $(_pa).find('.main-img img:first-child').attr('data-o_href');
                $(_pa).find('.main-img img:first-child').attr('src', _src_large);
            }
        }
    }

    if ($('body').hasClass('nasa-focus-main-image')) {
        var _main_slide = $('.main-image-slider');
        $('body').trigger('slick_go_to_0', [_main_slide]);
    }

    /**
     * deal time
     */
    if ($('.nasa-quickview-product-deal-countdown').length) {

        $('.nasa-quickview-product-deal-countdown').html('');
        $('.nasa-quickview-product-deal-countdown').removeClass('nasa-show');

        if (variation && variation.variation_id && variation.is_in_stock && variation.is_purchasable) {
            var now = Date.now();

            if (typeof variation.deal_time !== 'undefined' && variation.deal_time && variation.deal_time.html && variation.deal_time.to > now && (typeof variation.deal_time.from === 'undefined' || variation.deal_time.from < now)) {
                $('.nasa-quickview-product-deal-countdown').html(variation.deal_time.html);
                $('body').trigger('nasa_load_countdown');
                if (!$('.nasa-quickview-product-deal-countdown').hasClass('nasa-show')) {
                    $('.nasa-quickview-product-deal-countdown').addClass('nasa-show');
                }
            }
        }
    }


/**
 * p-modern-8
 * */ 
    // if ($(_pa).parents('.nasa-modern-8').length) {
    //     if ($(_pa).find('.ns_pre_change_img').length) {
    //         var _pre_change = $(_pa).find('.ns_pre_change_img');
    //         var _data_val = $(_pre_change).attr('data-value');
    //         var _data_pa= $(_pre_change).attr('data-pa');
    //         var _ux_item_form = $(_form).find('.nasa-attr-ux_wrap[data-attribute_name="attribute_pa_'+_data_pa+'"] .nasa-attr-ux[data-value="' + _data_val + '"]');

    //         if (!$(_ux_item_form).hasClass('nasa-disable') && !$(_ux_item_form).hasClass('selected')) {
    //             $(_ux_item_form).trigger('click');

    //             $(_pre_change).addClass('nasa-active').siblings().removeClass('nasa-active');
    //         }

    //         $(_pre_change).removeClass('ns_pre_change_img');
    //     } else {
    //         var _ux = $(_form).find('.nasa-attr-ux_wrap .nasa-attr-ux.selected, .nasa-attr-ux_wrap .nasa-attr-ux.nasa-disable');
    //         $(_pa).find('.nasa-product-content-color-image-wrap.ns-modern-8 .nasa-attr-ux-item-modern-8').removeClass('nasa-active');
    //         $(_pa).find('.nasa-product-content-color-image-wrap.ns-modern-8 .nasa-attr-ux-item-modern-8').removeClass('nasa-disable');
    //         $(_ux).each(function () {
    //             var _this = $(this);
    //             var _attribute_name = $(_this).parents('.nasa-attr-ux_wrap').attr('data-attribute_name');
    //             var _ux_item = $(_pa).find('.nasa-product-content-color-image-wrap.ns-modern-8 .nasa-attr-ux-item-modern-8[data-value="' + $(_this).attr('data-value') + '"][data-pa="'+_attribute_name.replace('attribute_pa_','')+'"]');

    //             if ($(_this).hasClass('selected')) {
    //                 $(_ux_item).addClass('nasa-active');
    //             }

    //             if ($(_this).hasClass('nasa-disable')) {
    //                 $(_ux_item).addClass('nasa-disable');
    //             }
                
    //         });
    //     }
    // }
}

/**
 * Set Content Sku
 * 
 * @param {type} $
 * @param {type} _sku
 * @param {type} _content
 * @returns void
 */
function ns_set_sku_content($, _sku, _content) {
    var _ogc = $(_sku).attr('data-o_content');
    if (typeof _ogc === 'undefined') {
        $(_sku).attr('data-o_content', $(_sku).text());
    }

    $(_sku).text(_content);
}

/**
 * Reset Content Sku
 * 
 * @param {type} $
 * @param {type} _sku
 * @returns void
 */
function ns_reset_sku_content($, _sku) {
    var _ogc = $(_sku).attr('data-o_content');
    if (typeof _ogc !== 'undefined') {
        $(_sku).text(_ogc);
    }
}
