
var ns_minicart_change_html = [];

/* Document ready */
jQuery(document).ready(function($) {
    "use strict";
    $('body').on('click', '.nasa-change_variation_mini_cart:not(.nasa-cart-variation-updating) .mini-cart-item dl.variation', function (e) {

        nasa_quick_viewimg = true;
        /**
         * Append stylesheet Off Canvas
         */
        $('body').trigger('nasa_append_style_off_canvas');

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
                var _cart = $(_this).parents('.nasa-static-sidebar'),
                    _wrap = $(_this).parents('.mini-cart-item'),
                    _wishlist = ($(_this).attr('data-from_wishlist') === '1') ? '1' : '0',
                    product_id = $(_wrap).attr('data-id-product'),
                    _data_cart_item_key = $(_wrap).find('.remove_from_cart_button ').attr('data-cart_item_key'),
                    _footer_mini_cart = $(_cart).find('.nasa-minicart-footer'),
                    _quantity = $(_wrap).find('.quantity-wrap .quantity .qty').attr('value'),
                    _main_img = $(_wrap).find('.nasa-image-cart-item img');

                var _data = {
                    product: product_id,
                    nasa_wishlist: _wishlist
                };

                var _form_change_variation = '<div class="ext-node mini-cart-change-variation"></div>',
                    _close ='<a href="javascript:void(0);" title="Close" class="nasa-close-node nasa-stclose" rel="nofollow"></a>';

                if ((_main_img).length) {
                    var _width = $(_main_img).outerWidth();
                    var _height = $(_main_img).outerHeight();
                }

                _data.quickview = 'popup';

                if ($(_footer_mini_cart).find('.ext-nodes-wrap').length) {
                    if ($(_footer_mini_cart).find('.ext-nodes-wrap .mini-cart-change-variation').length <= 0) {
                        $(_footer_mini_cart).find('.ext-nodes-wrap').append(_form_change_variation);
                    }
                } else {
                    $(_footer_mini_cart).append('<div class="ext-nodes-wrap">' + _form_change_variation + '</div>');
                }

                if (!$(_cart).hasClass('ext-loading')) {
                    $(_cart).addClass('ext-loading');
                }
                
                if ($(_cart).find('.close-nodes').length < 1) {
                    $(_cart).append('<a href="javascript:void(0);" class="close-nodes"></a>');
                }

                var _callAjax = true;
                var _change_variation = $(_footer_mini_cart).find('.ext-nodes-wrap .mini-cart-change-variation');
                var _html_mask_load = _close +
                '<div class="ns-mask-load nasa-crazy-load qv-loading padding-left-35 mobile-padding-left-20 mobile-padding-right-20 padding-right-35">' + 
                    '<div class="product-quickview-img-wrap nasa-flex align-start">' +
                        '<div class="product-quickview-img margin-bottom-20" style="height:' + _height + 'px; width:' + _width + 'px;"></div>' +
                        '<div class="nasa-quickview-fog">' +
                            '<div class="qv-crazy-info">' +
                                '<span class="info-1"></span>' +
                                '<span class="info-2 margin-top-20"></span>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="nasa-quickview-fog">' +
                        '<div class="qv-crazy-info">' +
                            '<span class="info-3 margin-top-20"></span>' +
                            '<span class="info-6-2 margin-top-20"></span>' +
                            '<span class="info-3 margin-top-20"></span>' +
                            '<span class="info-6-2 margin-top-20"></span>' +
                            '<span class="info-3 margin-top-20"></span>' +
                            '<span class="info-7 nasa-flex margin-top-20">' +
                                '<span class="info-7-1"></span>' +
                                '<span class="info-7-2"></span>' +
                            '</span>' +
                        '</div>' +
                    '</div>' +
                '</div>';

                $(_change_variation).html(_html_mask_load);

                setTimeout(function () {
                    $(_change_variation).addClass('active');
                }, 100);

                if (typeof ns_minicart_change_html[product_id] !== 'undefined') {
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
                            if (typeof setMaxHeightQVPU !== 'undefined') {
                                clearInterval(setMaxHeightQVPU);
                            }
                        },
                        success: function (response) {
                            ns_minicart_change_html[product_id] = response;

                            $(_change_variation).html(_close + '<div class="product-lightbox">' + response.content + '</div>');
                            $(_change_variation).find('.product-lightbox .nasa-product-gallery-lightbox').css({'min-height':_height});
                            $('body').trigger('init-mini-cart-update-form', [_change_variation, _quantity, _data_cart_item_key, _this]);

                        }
                    });
                } else {
                    var quicview_obj = ns_minicart_change_html[product_id];

                    $(_change_variation).html(_close + '<div class="product-lightbox">' + quicview_obj.content + '</div>');
                    $(_change_variation).find('.product-lightbox .nasa-product-gallery-lightbox').css({'min-height': _height});
                    $('body').trigger('init-mini-cart-update-form', [_change_variation, _quantity, _data_cart_item_key, _this]);

                }
            }
        }

        e.preventDefault();
    });


    $('body').on('init-mini-cart-update-form', function(e, wrap, _quantity, _data_cart_item_key, _btn) {
        /**
         * Init Gallery image
         */
         $('body').trigger('nasa_init_product_gallery_lightbox');

        if ($(wrap).find('.variations_form .quantity .qty').length) {
            $(wrap).find('.variations_form .quantity .qty').val(_quantity).attr({'data-old':_quantity-1});
        }

        if ($(wrap).find('.variations_form .ns-single-add-btn').length) {
            var _text = $(wrap).parents('.nasa-static-sidebar').find('.nasa-minicart-items').attr('data-text');
            var _ns_infor_variation = $(wrap).find('.variations_form .ns-info-variants');

            if ($(_ns_infor_variation).length) {
                $(_ns_infor_variation).replaceWith($(_ns_infor_variation).html());
            }

            $(wrap).find('.variations_form .ns-single-add-btn').attr({'data-quantity': _quantity, 'data-cart_item_key': _data_cart_item_key}).addClass('btn-add-from-minicart').text(_text);
        }

        var ns_objectsToAppend = [
            $(wrap).find('.product-lightbox .product-info .product_title').clone().addClass('fs-16'),
            $(wrap).find('.product-lightbox .product-info .nasa-single-product-price').clone(),
            $(wrap).find('.variations_form .woocommerce-variation').clone()
        ];

        var variation_bulk_dsct = $(wrap).find('.product-lightbox .product-info .nasa-variation-bulk-dsct');
        
        $(wrap).find('.variations_form .variations').append(variation_bulk_dsct);

        if ($(wrap).find('.product-lightbox .product-quickview-img .ns-price').length <= 0) {
            $(wrap).find('.product-lightbox .product-quickview-img').append('<div class="ns-price flex-column nasa-flex align-start"></div>');
        }

        $(wrap).find('.product-lightbox .product-quickview-img .ns-price').append(ns_objectsToAppend);

        $(wrap).find('.product-lightbox .product-quickview-img').removeClass('padding-left-0 padding-right-0');

        setTimeout(function () {
            if ($('form.cart input[name="quantity"]').length && $('.product-lightbox .ev-dsc-qty').length) {
                $('form.cart input[name="quantity"]').trigger('change');
            }
        }, 10);

        $('body').trigger('before_init_variations_form');

        var formLightBox = $('.mini-cart-change-variation .product-lightbox').find('.variations_form');

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

        var infor_cart_item = $(_btn).parents('.nasa-info-cart-item');
        var data_variations_selected = jQuery.parseJSON($(infor_cart_item).attr('data-variations-selected'));

        for (var key in data_variations_selected) {
            var _value = data_variations_selected[key];

            if ($(wrap).find('.variations_form .variations').length) {
                var _pa = $(wrap).find('.variations_form .variations');

                var _ux = $(_pa).find('td.value .nasa-attr-ux_wrap[data-attribute_name="' + key + '"] a[data-value="' + _value + '"]');
                // console.log(_ux);
                
                if ($(_ux).length) {
                    if (!$(_ux).hasClass('selected')) {
                        $(_ux).trigger('click');
                    }
                } else {
                    _ux = $(_pa).find('td.value select[data-attribute_name="' + key + '"]');
                    $(_ux).val(_value);
                }
            }
        }
        
        $('body').trigger('nasa_changed_gallery_variable_quickview');
        $('body').trigger('nasa_after_quickview');

    });

    /*
    * Change gallery for variation - Quick view
    */
    $('body').on('nasa_changed_gallery_variable_quickview', function () {
        var wrap = $('#cart-sidebar .ext-nodes-wrap .mini-cart-change-variation');
        
        if ($(wrap).find('.product-quickview-img .nasa-slick-slider').length) {
            var img = $(wrap).find('.product-quickview-img .nasa-slick-slider img:first-child').clone().attr({'class': 'main-img', 'style': 'width:100%;'});
            
            if ($(wrap).find('.product-quickview-img .product-img .main-img').length <= 0) {
                $(wrap).find('.product-quickview-img .product-img').prepend(img);
            }else {
                $(wrap).find('.product-quickview-img .product-img .main-img').replaceWith(img);
            }
        }
        
        // /loading_slick_element($, true, '.mini-cart-change-variation .product-lightbox');
    });

    /**
     * Update Quantity mini cart change
     */
    $('body').on('ns_bulk_discount_changed', function () {
        var wrap = $('#cart-sidebar .ext-nodes-wrap .mini-cart-change-variation');
        if ($(wrap).length) {
            $('body').trigger('update-price-stock-pos',[wrap]);
        }
    });

    $('body').on('update-price-stock-pos',function(e,wrap) {
        setTimeout(function () {
            var _price_stock = $(wrap).find('.variations_form .woocommerce-variation').clone();
            if ($(wrap).find('.product-info .price.nasa-bulk-price').length) {
                _price_stock = $(wrap).find('.product-info .price.nasa-bulk-price').html();
                $(wrap).find('.product-lightbox .product-quickview-img .ns-price .woocommerce-variation .woocommerce-variation-price').html('<span class="price">' + _price_stock + '</span>');
                $(wrap).find('.product-lightbox .product-quickview-img .ns-price .woocommerce-variation').removeAttr('style');
            } else {
                $(wrap).find('.product-lightbox .product-quickview-img .ns-price .woocommerce-variation').replaceWith(_price_stock);
            }

            var _org_price = $(wrap).find('.product-lightbox .product-quickview-img .ns-price .nasa-single-product-price');
            if ($(_price_stock).find('.woocommerce-variation-price').html() != '' && !$(wrap).find('.variations_form .btn-add-from-minicart').hasClass('disabled')) {    
                $(_org_price).hide();
            }else {
                $(_org_price).show();
            }
        }, 200);
    });
});
/* End Document Ready */
