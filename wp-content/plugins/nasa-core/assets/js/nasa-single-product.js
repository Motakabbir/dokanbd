/**
 * Document nasa-core ready
 */
jQuery(document).ready(function($) {
"use strict";

if ($('.nasa-accessories-wrap').length) {
    $('body').trigger('nasa_append_style_cross_sell_cart');
}

/**
 * Set Cookie for Product viewed
 */
$('body').on('ns_viewed_product_init', function() {
    var _viewed_name = $('input[name="ns-viewed-cookie-name"]').length ? $('input[name="ns-viewed-cookie-name"]').val() : '';
    var _viewed_id = $('input[name="ns-viewed-id"]').length ? $('input[name="ns-viewed-id"]').val() : '';
    
    if (_viewed_name && _viewed_id) {
        if (typeof _cookie_live === 'undefined') {
            var _cookie_live = 7;
        }

        if ($('input[name="nasa-cookie-time"]').length) {
            _cookie_live = parseInt($('input[name="nasa-cookie-life"]').val());
        }

        var _viewed_limit = $('input[name="ns-viewed-limit"]').length ? $('input[name="ns-viewed-limit"]').val() : 12;

        var _ns_p_viewed = $.cookie(_viewed_name);
        var _ns_p_viewed_arr = _ns_p_viewed ? _ns_p_viewed.split('|') : [];

        if (!_ns_p_viewed_arr.includes(_viewed_id)) {
            _ns_p_viewed = _viewed_id;
            if (_ns_p_viewed_arr.length > 0) {
                var i = 0;
                var _number = _viewed_limit < _ns_p_viewed_arr.length ? _viewed_limit : _ns_p_viewed_arr.length;

                for (i; i < _number; i++) {
                    _ns_p_viewed += '|' + _ns_p_viewed_arr[i];
                }
            }
        }

        var _viewed_path = $('input[name="ns-cookie-path"]').length ? $('input[name="ns-cookie-path"]').val() : '/';
        var _viewed_domain = $('input[name="ns-cookie-domain"]').length ? $('input[name="ns-cookie-domain"]').val() : '';

        $.cookie(_viewed_name, _ns_p_viewed, {expires: _cookie_live, path: _viewed_path, domain: _viewed_domain});
    }
}).trigger('ns_viewed_product_init');

/**
 * Check accessories product
 */
$('body').on('change', '.nasa-check-accessories-product,.nasa-check-main-product', function () {
    var _urlAjax = null;
    if (
        typeof nasa_ajax_params !== 'undefined' &&
        typeof nasa_ajax_params.wc_ajax_url !== 'undefined'
    ) {
        _urlAjax = nasa_ajax_params.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_refresh_accessories_price');
    }

    if (_urlAjax) {
        var _this = $(this);

        var _wrap = $(_this).parents('.nasa-accessories-check');

        var _id = $(_this).val();
        var _isChecked = $(_this).is(':checked');

        var _price = $(_wrap).find('.nasa-check-main-product').length ? parseInt($(_wrap).find('.nasa-check-main-product').attr('data-display_price')) : 0;
        var _org_price = $(_wrap).find('.nasa-check-main-product').length ? parseInt($(_wrap).find('.nasa-check-main-product').attr('data-display_regular_price')) : 0;
        var _product_total = 1;

        if ($(_wrap).find('.nasa-check-accessories-product').length) {
            $(_wrap).find('.nasa-check-accessories-product').each(function() {
                if ($(this).is(':checked')) {
                    _product_total++;
                    if ($(this).hasClass('ns-getmin')) {
                        _price += parseInt($(this).attr('data-min_sale_price_for_display'));
                        _org_price += parseInt($(this).attr('data-min_sale_price_for_display'));
                    } else {
                        _price += parseInt($(this).attr('data-display_price'));
                        _org_price += parseInt($(this).attr('data-display_regular_price'));
                    }
                   
                }
            });
        }

        setTimeout(function(){
            var price_html = $('.nasa-accessories-'+_id).find('.product-info-wrap .price').html();
            $(_this).next().find('.price').html('(' + price_html + ')');
        },200);

        $.ajax({
            url: _urlAjax,
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                total_price: _price,
                origin_price: _org_price,
                product_total:_product_total
            },
            beforeSend: function () {
                $('.nasa-accessories-total-price-wrap').append('<div class="nasa-disable-wrap"></div><div class="nasa-loader"></div>');
            },
            success: function (res) {
                if (typeof res.total_price !== 'undefined') {
                    var _prev =  $('.nasa-accessories-' + _id).prev('.ns-accessories-add-svg');
                    var _add_to_cart_accessories = $('.nasa-bought-together-wrap .add_to_cart_accessories');

                    $('.nasa-accessories-total-price .price').html(res.total_price);
                    $('.nasa-accessories-add-to-cart .add_to_cart_accessories').html(res.add_to_cart_accessories);

                    if (!_isChecked) {
                        $('.nasa-accessories-' + _id).addClass('nasa-accessories-not-selected');
                        if ($(_prev).length) {
                            $(_prev).addClass('nasa-accessories-not-selected');
                        }
                    } else {
                        $('.nasa-accessories-' + _id).removeClass('nasa-accessories-not-selected');
                        if ($(_prev).length) {
                            $(_prev).removeClass('nasa-accessories-not-selected');
                        }
                    }
                }

                if (typeof res.data_price !== 'undefined') {
                   $('.nasa-accessories-total-price').parents('.nasa-accessories-total-price-wrap').attr('data-price',res.data_price);
                }

                $('.nasa-accessories-total-price-wrap').find('.nasa-loader, .nasa-disable-wrap').remove();
            },
            error: function () {

            }
        });
    }
});

/**
 * Add To cart accessories
 */
$('body').on('click', '.add_to_cart_accessories', function() {
    var _add_to_cart_accessories = this,
        _wrap = $(_add_to_cart_accessories).parents('.nasa-bought-together-wrap'),
        _wrapCheck = $(_wrap).find('.nasa-accessories-check'),
        _check = $(_wrapCheck).find('.nasa-accessories-item-check .nasa-check-accessories-product,.nasa-accessories-item-check .nasa-check-main-product'),
        _data = [],
        _cancel = false;

    $(_check).each(function (){
        if ($(this).is(':checked')) {
            var _accessories_id = $(this).val();
            var _accessories_product = $('.nasa-accessories-wrap').find('.nasa-accessories-'+_accessories_id);
            if ($(_accessories_product).length) {
                var btn_add = $(_accessories_product).find('.add_to_cart_button');
                if ($(btn_add).hasClass('product_type_variation') || $(btn_add).hasClass('nasa-variable-add-to-cart-in-grid') || $(btn_add).hasClass('product_type_variable')) {
                    if ($(btn_add).hasClass('nasa-active')) {
                        var _type = 'variable',
                            _quantity = 1,
                            _variation_id = $(btn_add).attr('data-product_id') != null ? parseInt($(btn_add).attr('data-product_id')) : 0,
                            _variation = {},
                            _flag_adding = true;
            
                        if (_type === 'variable' && _variation_id <= 0) {
                            _flag_adding = false;
                        } else {
                            _variation = JSON.parse($(btn_add).attr('data-variation'));
                        }

                        if (_flag_adding) {
                            _data.push({
                                _id:_accessories_id,
                                _quantity:_quantity,
                                _type:_type,
                                _variation_id:_variation_id,
                                _variation:_variation,
                            });
                        } else {
                            _cancel = true;
                        }
    
                    } else {
                        _cancel = true;
                    }
                } else {
                    _data.push({
                        _id:_accessories_id,
                        _type:'simple'
                    });
                }
            }
        }

        if (_cancel == true) {
            var text = $(_add_to_cart_accessories).attr('data_text_alert');
            var name = $(this).next().attr('data_product_name').trim();
            text = text.replace('${productName}', name);
            alert(text);
            return false;
        }

    });

    if (
        typeof nasa_ajax_params !== 'undefined' &&
        typeof nasa_ajax_params.wc_ajax_url !== 'undefined' &&
        _cancel == false
    ) {
        var _urlAjax = nasa_ajax_params.wc_ajax_url.toString().replace('%%endpoint%%', 'nasa_add_to_cart_accessories');
        
        if ($(_wrap).length) {
            if ($(_wrapCheck).length) {
                var json_string = JSON.stringify(_data);
                if (json_string.length) {
                    $.ajax({
                        url: _urlAjax,
                        type: 'post',
                        dataType: 'json',
                        cache: false,
                        data: {
                            products_bag: json_string
                        },
                        beforeSend: function () {
                            $('.nasa-message-error').hide();
                            $(_add_to_cart_accessories).addClass('loading');
                        },
                        success: function (data) {
                            if (data && data.fragments) {
                                $.each(data.fragments, function(key, value) {
                                    $(key).replaceWith(value);
                                });

                                if ($('.cart-link').length) {
                                    $('.cart-link').trigger('click');
                                }
                            } else {
                                if (data && data.error && $('.nasa-message-error').length) {
                                    $('.nasa-message-error').html(data.message);
                                    $('.nasa-message-error').show();
                                }
                            }

                            $(_add_to_cart_accessories).removeClass('loading');
                        },
                        error: function () {
                            $(_add_to_cart_accessories).removeClass('loading');
                        }
                    });
                }
            }
        }
    }

    return false;
});

/**
 * Nodes Popup
 */
$('body').on('click', '.nasa-node-popup', function() {
    var _target = $(this).attr('data-target');
    
    $('body').trigger('nasa_popup_content_contact');
    if ($(_target).length) {

        if ($(_target).find('.nasa-stclose').length <= 0) {
            $(_target).prepend('<a class="ns-node-close nasa-stclose" href="javascript:void(0);"></a>');
        }
    
        $('.black-window').fadeIn(400).addClass('desk-window');

        if (!$('body').hasClass('nasa-mobile-app')) {
            var _main_class = 'my-mfp-slide-bottom nasa-mfp-max-width';

            if ($(_target).parents('.ns-sticky-scroll-sidebar').length || $(_target).parents('.nasa-layout-modern-4').length) {
                $(_target).appendTo('body');
            }
            
            if (_target == '#nasa-content-size-guide') {
                _main_class += ' ns-sg';
            }
            
            if (_target == '#nasa-content-delivery-return') {
                _main_class += ' ns-dr';
            }

            $(_target).addClass('ns-node-ready');

            setTimeout(function(){
                $(_target).addClass('ns-actived');
            },20);
            /**
             * Close old Magnific
             */
            $('body').trigger('ns_magnific_popup_close');

            $('body').trigger('init_nasa_tabs_not_set');
        } else {
            if (!$(_target).hasClass('ns-actived')) {
                $(_target).addClass('ns-actived');
            }
        }

        if (!$('body').hasClass('ovhd')) {
            $('body').addClass('ovhd');
        }
    }
});

/**
 * Close Node
 */
$('body').on('click', '.ns-node-close', function() {
    var _target = $(this).parents('.nasa-node-content');
    if ($(_target).length) {
        if (!$('body').hasClass('nasa-mobile-app')) {

            $(_target).addClass('ns-removing');
            $('.black-window').fadeOut(400).removeClass('desk-window');
            $('body').removeClass('ovhd');
        
            setTimeout(function() {
                $(_target).removeClass('ns-actived ns-removing ns-node-ready');
            },400);

        } else {
            $(_target).removeClass('ns-actived');
            
            if (!$('.nasa-single-product-in-mobile .cart.variations_form').hasClass('ns-show')) {
                $('.black-window').fadeOut(500).removeClass('desk-window');
            }
        }
    }

    $('body').removeClass('ovhd');
});

/**
 * Adding info product to contact form 7 ask a question
 * 
 * @type type
 */
$('body').on('nasa_popup_content_contact', function() {
    if ($('.nasa-popup-content-contact').length) {
        $('.nasa-popup-content-contact').each(function() {
            var _this = $(this);
            
            if (!$(_this).hasClass('nasa-inited')) {
                $(_this).addClass('nasa-inited');
                
                var _form = $(_this).find('form.wpcf7-form');

                if ($(_form).length) {
                    if ($(_this).find('.nasa-info-add-form').length) {
                        $(_form).prepend($(_this).find('.nasa-info-add-form').html());
                        $(_this).find('.nasa-info-add-form').remove();
                    }

                    if ($(_form).find('input[type="text"], input[type="email"], input[type="number"], input[type="tel"], textarea').length) {
                        $(_form).find('input[type="text"], input[type="email"], input[type="number"], input[type="tel"], textarea').each(function() {
                            var _input = $(this);
                            var _label = $(_input).parents('label');
                            if ($(_label).length) {
                                var _text = ($(_label).text()).trim();
                                $(_input).attr('placeholder', _text);
                                $(_label).addClass('hide-text');
                            }
                        });
                    }
                }
            }
        });
    }
});

/**
 * Single Attributes Brands
 */
if ($('.single-product .nasa-sa-brands').length) {
    if ($('.single-product .woocommerce-product-rating').length) {
        $('.single-product .woocommerce-product-rating').addClass('nasa-has-sa-brands');
    } else {
        $('.single-product .nasa-sa-brands').addClass('margin-top-10');
    }
    
    $('.single-product .nasa-sa-brands').addClass('nasa-inited');
}

/**
 * init Variations forms
 * 
 * @returns {undefined}
 */
setTimeout(function() {
    $('body').trigger('nasa_init_ux_variation_form');
}, 10);

/**
 * Load single product image
 */
$('body').on('nasa_load_single_product_slide', function() {
    load_slick_single_product($);
}).trigger('nasa_load_single_product_slide');

/**
 * Re-Load single product image
 */
$('body').on('nasa_reload_single_product_slide', function() {
    load_slick_single_product($, true);
});

/**
 * Change Countdown for variation - Quick view
 */
$('body').on('nasa_reload_slick_slider', function() {
    load_slick_single_product($, true);
});

/**
 * Viewing
 * 
 * @type Number|_min|_others
 */
var _current = 0,
    _change_counter;
$('body').on('nasa_counter_viewing', function() {
    if ($('#nasa-counter-viewing').length) {
        var _min = parseInt($('#nasa-counter-viewing').attr('data-min'));
        var _max = parseInt($('#nasa-counter-viewing').attr('data-max'));
        var _delay = parseInt($('#nasa-counter-viewing').attr('data-delay'));
        var _change = parseInt($('#nasa-counter-viewing').attr('data-change'));
        var _id = $('#nasa-counter-viewing').attr('data-id');
        
        if (!$('#nasa-counter-viewing').hasClass('inited')) {
            if (typeof _change_counter !== 'undefined' && _change_counter) {
                clearInterval(_change_counter);
            }
            
            _current = $.cookie('nasa_cv_' + _id);
            
            if (typeof _current === 'undefined' || !_current) {
                // get Random from min - max
                _current = Math.floor(Math.random() * _max) + _min;
            }
            
            $('#nasa-counter-viewing').addClass('inited');
            
            $.cookie('nasa_cv_' + _id, _current, {expires: 1 / 24, path: '/'}); // Live in 1 hours
            
            $('#nasa-counter-viewing .nasa-count').html(_current);
        }
        
        _change_counter = setInterval(function() {
            _current = parseInt($('#nasa-counter-viewing .nasa-count').text());
            
            if (!_current) {
                _current = _min;
            }
            
            var _pm = Math.floor(Math.random() * 2);
            var _others = Math.floor(Math.random() * _change + 1);
            _current = (_pm < 1 && _current > _others) ? _current - _others : _current + _others;
            $.cookie('nasa_cv_' + _id, _current, {expires: 1 / 24, path: '/'}); // Live in 1 hours
            
            $('#nasa-counter-viewing .nasa-count').html(_current);
            
        }, _delay);
    }
}).trigger('nasa_counter_viewing');


/**
 * last sold and in cart auto scroll
 */
var _ns_fake_sold_interval = false;
$('body').on('nasa_fake_sold_promo', function() {
    if ($('.nasa-product-details-page .nasa-last-sold').length && $('.nasa-product-details-page .nasa-in-cart').length) {
        var _last_sold = $('.nasa-product-details-page .nasa-last-sold');
        var _in_cart = $('.nasa-product-details-page .nasa-in-cart');

        if ($('.check-incart-sold .nasa-scroll').length <= 0) {
            $(_last_sold).after('<div class="check-incart-sold-wrap"><div class="check-incart-sold"><div class="nasa-scroll"></div></div></div>');
        }
        
        var _wrap = $('.check-incart-sold');
        var _scroll = $(_wrap).find('.nasa-scroll');
        
        $(_scroll).append(_last_sold);
        $(_scroll).append(_in_cart);
        $(_last_sold).addClass('nasa-show');
        $(_in_cart).addClass('nasa-show');
        
        if (_ns_fake_sold_interval) {
            clearInterval(_ns_fake_sold_interval);
        }

        _ns_fake_sold_interval = setInterval(function() {
            var _first = $(_scroll).find('> div:first-child');
            var _second = $(_scroll).find('> div:nth-child(2)');
            
            var h = $(_first).height();
            var h2 = $(_second).height();
            var i = 0;

            $(_wrap).css({'height': h2});

            var _ns_fake_sold = setInterval(function() {
                i++;
                
                $(_scroll).css({
                    '-webkit-transform': 'translateY(-' + i + 'px)',
                    '-moz-transform': 'translateY(-' + i + 'px)',
                    '-o-transform': 'translateY(-' + i + 'px)',
                    '-ms-transform': 'translateY(-' + i + 'px)',
                    'transform': 'translateY(-' + i + 'px)'
                });

                if (i >= h) {
                    clearInterval(_ns_fake_sold);
                    $(_scroll).append(_first);
                    $(_scroll).removeAttr('style');
                }
            }, 10);

        }, 6000);
    }else {
        $('.nasa-product-details-page').find('.nasa-last-sold, .nasa-in-cart').addClass('nasa-show');
    }
}).trigger('nasa_fake_sold_promo');

/**
 * After load ajax compalete
 */
$('body').on('nasa_after_loaded_ajax_complete', function() {
    if ($('.single-product .nasa-sa-brands').length) {
        if ($('.single-product .woocommerce-product-rating').length) {
            $('.single-product .woocommerce-product-rating').addClass('nasa-has-sa-brands');
        } else {
            $('.single-product .nasa-sa-brands').addClass('margin-top-10');
        }

        $('.single-product .nasa-sa-brands').addClass('nasa-inited');
    }
    
    $('body').trigger('nasa_counter_viewing');
    $('body').trigger('nasa_fake_sold_promo');
    
    if ($('form.cart input[name="quantity"]').length && $('.ev-dsc-qty').length) {
        $('form.cart input[name="quantity"]').trigger('change');
    }
});

/**
 * Bulk Discount
 * 
 * @param {type} $
 * @param {type} restart
 * @returns {undefined}
 */
if ($('form.cart input[name="quantity"]').length && $('.ev-dsc-qty').length) {
    $('form.cart input[name="quantity"]').trigger('change');
}

/**
 * Bulk Discount - Mobile App
 */
$('body').on('ns_after_variation_form_fixed', function() {
    var _form = $('.nasa-single-product-in-mobile form.cart.variations_form');
    
    if (
        $(_form).length &&
        $('.nasa-mobile-app .nasa-single-product-in-mobile .nasa-variation-bulk-dsct').length &&
        $(_form).find('.ns-info-variants').length &&
        $(_form).find('.ns-info-variants .nasa-variation-bulk-dsct').length <= 0
    ) {
        $(_form).find('.ns-info-variants').append($('.nasa-mobile-app .nasa-single-product-in-mobile .nasa-variation-bulk-dsct'));
    }
});

/* End Documend ready */
});

/**
 * Single slick images
 * 
 * @param {type} $
 * @param {type} restart
 * @returns {undefined}
 */
function load_slick_single_product($, restart) {
    if ($('.nasa-single-product-slide .nasa-single-product-main-image').length) {
        var _root_wrap = $('.nasa-single-product-slide');
        if ($(_root_wrap).length) {
            var _restart = typeof restart === 'undefined' ? false : true;
            var _rtl = $('body').hasClass('nasa-rtl') ? true : false;
            var _main = $(_root_wrap).find('.nasa-single-product-main-image'),
                _thumb = $(_root_wrap).find('.nasa-single-product-thumbnails').length ? $(_root_wrap).find('.nasa-single-product-thumbnails') : null,

                _autoplay = $(_root_wrap).attr('data-autoplay') === 'true' ? true : false,
                _infinite = $(_root_wrap).attr('data-infinite') === 'true' ? true : false,
                _speed = parseInt($(_root_wrap).attr('data-speed')),
                _delay = parseInt($(_root_wrap).attr('data-delay')),
                _dots = $(_root_wrap).attr('data-dots') === 'true' ? true : false,
                _num_main = parseInt($(_root_wrap).attr('data-num_main'));

            _speed = !_speed ? 600 : _speed;
            _delay = !_delay ? 6000 : _delay;
            _num_main = !_num_main ? 1 : _num_main;

            if (_restart) {
                if ($(_main).length && $(_main).hasClass('slick-initialized')) {
                    $('body').trigger('nasa_unslick', [_main]);
                }

                if ($(_thumb).length && $(_thumb).hasClass('slick-initialized')) {
                    $('body').trigger('nasa_unslick', [_thumb]);
                }
            }
            
            var _padding = $(_root_wrap).attr('data-padding');
            
            var _main_params = {
                rtl: _rtl,
                slidesToShow: _num_main,
                slidesToScroll: _num_main,
                autoplay: _autoplay,
                infinite: _infinite,
                autoplaySpeed: _delay,
                speed: _speed,
                arrows: true,
                dots: _dots,
                adaptiveHeight: true,
                asNavFor: _thumb,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            };
            
            if (_infinite) {
                $('.nasa-single-product-slide .nasa-single-slider-arrows .nasa-single-arrow').removeClass('nasa-disabled');
            }

            if (_padding) {
                _main_params.centerMode = true;
                _main_params.centerPadding = _padding;
                _main_params.infinite = true;
                
                if (!$(_root_wrap).hasClass('nasa-center-mode')) {
                    $(_root_wrap).addClass('nasa-center-mode');
                }
                
                if (!$(_main).hasClass('no-easyzoom')) {
                    $(_main).addClass('no-easyzoom');
                }
                
                var _padding_small = $(_root_wrap).attr('data-padding_small');
                
                if (_padding_small) {
                    _main_params.responsive = [
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                centerPadding: _padding_small
                            }
                        }
                    ];
                }
            }

            var _interval = setInterval(function() {
                if ($(_main).find('.nasa-item-main-image-wrap[data-key="0"] img').height()) {
                    if (!$(_main).hasClass('slick-initialized')) {
                        $(_main).slick(_main_params);
                        
                        $(_main).on('afterChange', function() {
                            $('body').trigger('nasa_single_gallery_after_change', [_main]);
                        });
                    }

                    if (_thumb && !$(_thumb).hasClass('slick-initialized')) {
                        var _num_ver = parseInt($(_root_wrap).attr('data-num_thumb'));
                        _num_ver = !_num_ver ? 4 : _num_ver;

                        var _vertical = true;
                        var wrapThumb = $(_thumb).parents('.nasa-thumb-wrap');

                        if ($(wrapThumb).length && $(wrapThumb).hasClass('nasa-thumbnail-hoz')) {
                            _vertical = false;
                            _num_ver = 4;
                        }

                        if ($('.nasa-product-details-page').hasClass('nasa-layout-new') || $('.nasa-product-details-page').hasClass('nasa-layout-new-3')) {
                            _num_ver = _num_main < 2 ? 4 : 8;
                        }

                        var _setting = {
                            vertical: _vertical,
                            slidesToShow: _num_ver,
                            slidesToScroll: 1,
                            dots: false,
                            arrows: true,
                            infinite: false,
                            prevArrow: '<a href="javascript:void(0);" class="slick-prev slick-arrow ns-slick-arrow ns-up-arrow nasa-transition" rel="nofollow"></a>',
                            nextArrow: '<a href="javascript:void(0);" class="slick-next slick-arrow ns-slick-arrow ns-down-arrow nasa-transition" rel="nofollow"></a>'
                        };

                        if (!_vertical) {
                            _setting.rtl = _rtl;
                        } else {
                            _setting.verticalSwiping = true;
                        }

                        _setting.asNavFor = _main;
                        _setting.centerMode = false;
                        _setting.centerPadding = '0';
                        _setting.focusOnSelect = true;

                        $(_thumb).slick(_setting);
                        $(_thumb).attr('data-speed', _speed);
                    }

                    clearInterval(_interval);
                    
                    if ($(_main).find('.slick-slide').length <= _num_main) {
                        $(_main).addClass('nasa-no-slide');
                    }

                    $('body').trigger('nasa_after_single_product_slick_inited', [_thumb, _num_ver]);
                }
            }, 500);

            setTimeout(function() {
                if ($('.nasa-single-product-slide .nasa-single-product-main-image .slick-list').length <= 0 || $('.nasa-single-product-slide .nasa-single-product-main-image .slick-list').height() < 2) {
                    load_slick_single_product($, true);
                }
            }, 500);
        }
    }
}
