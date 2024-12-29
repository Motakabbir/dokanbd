/* Document ready */
jQuery(document).ready(function($) {
    "use strict";
    
    /**
     * Images exists be checked
     * @type Array
     */
    var _ns_img_checked = [];  

    $('body').on('ns_btns_fixed', function() {
        if ($('.ns_btn-fixed').length <= 0) {
            $('body').append('<div class="ns_btn-fixed nasa-flex"></div>');
        }
        
        var has_padding_bottom = false;
    
        if ($('.nasa-single-product-in-mobile .single_add_to_cart_button').length) {
            if ($('.ns_btn-fixed').find('.single_add_to_cart_button').length <= 0) {
                var _text = $('.nasa-single-product-in-mobile .single_add_to_cart_button.ns-single-add-btn').text();
                $('.ns_btn-fixed').append('<a href="javascript:void(0);" class="single_add_to_cart_button button">' + _text + '</a>');
            }
            
            has_padding_bottom = true;
        }
    
        if ($('.nasa-single-product-in-mobile .nasa-buy-now').length) {
            if ($('.ns_btn-fixed').find('.nasa-buy-now').length <= 0) {
                var _text = $('.nasa-single-product-in-mobile .nasa-buy-now').text();
                $('.ns_btn-fixed').append('<a href="javascript:void(0);" class="nasa-buy-now button">' + _text + '</a>');
            }
            
            has_padding_bottom = true;
        }
        
        if (has_padding_bottom) {
            var _padding_bottom = $('.ns_btn-fixed').outerHeight();
            $('body').css({'padding-bottom': _padding_bottom});
        }
        
    }).trigger('ns_btns_fixed');
    
    /**
     * ADD TO CART - show in variations form
     */
    $('body').on('click', '.ns_btn-fixed .single_add_to_cart_button, .ns-open-var-form', function() {
        if ($('.nasa-single-product-in-mobile form.cart').length) {
            var _form = $('.nasa-single-product-in-mobile form.cart');
            var _btn = $(_form).find('button[type="submit"].single_add_to_cart_button');

            $('body').trigger('slick_go_to_0',[$('.main-images')]);

            if ($(_form).hasClass('variations_form')) {
                if (!$(_form).hasClass('ns-show')) {
                    $(_form).addClass('ns-show ns_add_to_cart_button_show');
                    
                    $('.black-window').fadeIn(200).addClass('desk-window');
                    
                    if (!$('body').hasClass('ovhd')) {
                        $('body').addClass('ovhd');
                    }
                }
            } else {
                if ($(_btn).length) {
                    $(_btn).trigger('click');
                }
            }
        }
    });
    
    /**
     * BUY NOW - show in variations form
     */
    $('body').on('click', '.ns_btn-fixed .nasa-buy-now', function() {
        if ($('.nasa-single-product-in-mobile form.cart').length) {
            var _this = $(this);
            
            var _form = $('.nasa-single-product-in-mobile form.cart');
            var _btn = $(_form).find('.nasa-buy-now');
            
            $('body').trigger('slick_go_to_0',[$('.main-images')]);
            
            if ($(_form).hasClass('variations_form')) {
                if (!$(_form).hasClass('ns-show')) {
                    $(_form).addClass('ns-show ns_buy_now_button_show');
                    
                    $(_this).removeClass('loading');
                    
                    $('.black-window').fadeIn(200).addClass('desk-window');
                    
                    if (!$('body').hasClass('ovhd')) {
                        $('body').addClass('ovhd');
                    }
                }
            } else {
                if ($(_btn).length) {
                    $(_btn).trigger('click');
                }
            }
        }
    });
    
    /**
     * Hide simple product - cart form
     */
    $('body').on('ns_hide_simple_cart_form', function() {
        if (
            $('.nasa-single-product-in-mobile form.cart').length &&
            $('.nasa-single-product-in-mobile form.cart').find('input[name="data-type"]').length
        ) {
            if ($('.nasa-single-product-in-mobile form.cart').find('input[name="data-type"]').val() === 'simple') {
                /**
                 * Compatible WCPA
                 */
                if ($('.nasa-single-product-in-mobile form.cart').find('.wcpa_form_outer').length) {
                    $('.nasa-single-product-in-mobile form.cart').find('>*').each(function() {
                        if (!$(this).hasClass('wcpa_form_outer')) {
                            $(this).hide();
                        }
                    });
                } else {
                    $('.nasa-single-product-in-mobile form.cart').hide();
                    if ($('.nasa-single-product-in-mobile form.cart').find('.nasa-dsc-wrap').length) {
                        var _nasa_dsc_wrap = $('.nasa-single-product-in-mobile form.cart').find('.nasa-dsc-wrap');
                        if (!$(_nasa_dsc_wrap).hasClass('nasa-dsc-type-2')) {
                            $(_nasa_dsc_wrap).addClass('nasa-dsc-mobile-quick-add');
                        }
                        $('.nasa-single-product-in-mobile form.cart').after($(_nasa_dsc_wrap));
                    }
                }
            }
        }
    }).trigger('ns_hide_simple_cart_form');
    
    /**
     * Checkout Plugins - Stripe for WooCommerce
     */
    $('body').on('ns_ppc_woo', function() {
        var _form = $('.nasa-single-product-in-mobile form.cart');
        
        if ($(_form).length && ($('#ppcp-messages').length || $('.ppc-button-wrapper').length)) {
            
            if ($('.ns-ppc-wrap').length <= 0) {
                $(_form).after('<div class="ns-ppc-wrap ns-begin-wrap nasa-crazy-box"></div>');
            }
            
            /**
             * Checkout Plugins - Stripe for WooCommerce - Mess
             */
            if ($('#ppcp-messages').length) {
                var _ppcp_mess = $('#ppcp-messages');
                $('.ns-ppc-wrap').append(_ppcp_mess);
            }

            /**
             * Checkout Plugins - Stripe for WooCommerce - Button
             */
            if ($('.ppc-button-wrapper').length) {
                var _ppc_btns = $('.ppc-button-wrapper');
                $('.ns-ppc-wrap').append(_ppc_btns);
            }
        }
    }).trigger('ns_ppc_woo');
    
    /**
     * triger price load
     */
    $('body').on('ns_add_nasa_price_loading', function(e, _form) {
        var _org_price = null,
            _sub_price = null,
            _sub_price_1st = null,
            _sub_price_2nd = null;

        if ($(_form).find('.ns-form-info .ns-info-wrap').length <= 0) {
            $(_form).find('.ns-form-info').append('<div class="ns-info-wrap"></div>');
        }
        
        $(_form).find('.ns-form-info .ns-info-wrap').html('');

        if ($(_form).find('.ns-form-info .ns-info-wrap .ns-price-wrap').length <= 0) {
            $(_form).find('.ns-form-info .ns-info-wrap').append('<div class="ns-price-wrap"></div>');
        }
        
        /**
         * nasa-single-product-price - Orgirin
         */
        if ($('.nasa-single-product-in-mobile .price.nasa-single-product-price').length) {
            if (!$('.nasa-single-product-in-mobile .price.nasa-single-product-price').hasClass('org-price')) {
                $('.nasa-single-product-in-mobile .price.nasa-single-product-price').addClass('org-price');
            }
            
            _org_price = $('.nasa-single-product-in-mobile .price.nasa-single-product-price').clone();
            
            $(_org_price).removeClass('nasa-single-product-price');
        }
        
        if (_org_price) {
            $(_form).find('.ns-form-info .ns-price-wrap').append(_org_price);
        }

        if ($(_form).find('.ns-info-variants .single_variation_wrap .woocommerce-variation-price .price').length) {
            _sub_price = $(_form).find('.ns-info-variants .single_variation_wrap .woocommerce-variation-price .price').html();
        } else if ($('.nasa-single-product-in-mobile .nasa-bulk-price').length) {
            _sub_price = $('.nasa-single-product-in-mobile .nasa-bulk-price').html();
        }
        
        if (_sub_price) {
            /**
             * For Bulk Price OUT Form
             */
            _sub_price_1st = '<p class="price nasa-bulk-price">' + _sub_price + '</p>';

            if ($('.nasa-single-product-in-mobile .nasa-bulk-price').length <= 0) {
                $('.nasa-single-product-in-mobile .nasa-single-product-price').after(_sub_price_1st);
            } else {
                $('.nasa-single-product-in-mobile .nasa-bulk-price').replaceWith(_sub_price_1st);
            }
            
            /**
             * For Bulk Price IN Form
             */
            _sub_price_2nd = '<p class="price sub-price sub-price-2nd">' + _sub_price + '</p>';
            
            if ($(_form).find('.ns-form-info .sub-price.sub-price-2nd').length <= 0) {
                $(_form).find('.ns-form-info .ns-price-wrap').append(_sub_price_2nd);
            } else {
                $(_form).find('.ns-form-info .sub-price.sub-price-2nd').replaceWith(_sub_price_2nd);
            }
            
            $('.price.org-price').hide();
        }
        
        /**
         * availability
         */
        if ($(_form).find('.ns-info-variants .single_variation_wrap .woocommerce-variation-availability').length) {
            var _availability = $(_form).find('.ns-info-variants .single_variation_wrap .woocommerce-variation-availability').html();

            if (_availability && $(_form).find('.ns-form-info .ns-info-wrap .stock').length <= 0) {
                $(_form).find('.ns-form-info .ns-info-wrap').append(_availability);
                // $(_form).find('.ns-form-info .price').append(_availability);
            }
        }
    });

    /**
     * trigger img load
     */
    $('body').on('ns_add_nasa_img_loading', function(e,_form) {

        var _img = null;

        if ($('.nasa-single-product-in-mobile .main-images .nasa-item-main-image-wrap[data-key="0"] img').length) {
            _img = $('.nasa-single-product-in-mobile .main-images .item-wrap:not(.slick-cloned) .nasa-item-main-image-wrap[data-key="0"] img').clone();
        }
        
        if (_img) {
            
            if ($(_form).find('.ns-form-info').length <= 0) {
                $(_form).prepend('<div class="ns-form-info nasa-flex align-start margin-bottom-20"></div>');
            }
            
            var _img_src = $(_img).attr('src');

            if ($(_form).find('.ns-form-info .main_min_img').length <= 0) {
                $(_form).find('.ns-form-info').prepend('<div class="main_min_img"></div>');
            }
    
            if ($.inArray(_img_src, _ns_img_checked) !== -1) {
                $(_form).find('.ns-form-info .main_min_img').html('');
                
                if ($('body').hasClass('product-zoom')) {
                    $(_form).find('.ns-form-info .main_min_img').html('<a class="ns-popup-img" href="javascript:void(0);"><svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M3,20V12a1,1,0,0,1,2,0v5.585L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L6.414,19H12a1,1,0,0,1,0,2H4A1,1,0,0,1,3,20Z"/></svg></a>');
                }

                $(_form).find('.ns-form-info .main_min_img').append(_img);

                $(_form).find('.ns-form-info .main_min_img').removeClass('nasa-img-loading');
    
            } else {
                if (!$(_form).find('.ns-form-info .main_min_img').hasClass('nasa-img-loading')) {
                    $(_form).find('.ns-form-info .main_min_img').addClass('nasa-img-loading');
                }
                
                var _interval = setInterval(function() {
                    var _main_src = _img.attr('src');
                    var _img_main = new Image();
                    _img_main.src = _main_src;
                    _img_main.onload = function() {
                        $(_form).find('.ns-form-info .main_min_img').removeClass('nasa-img-loading');
    
                        $(_form).find('.ns-form-info .main_min_img').html('');
                
                        if ($('body').hasClass('product-zoom')) {
                            $(_form).find('.ns-form-info .main_min_img').html('<a class="ns-popup-img" href="javascript:void(0);"><svg fill="currentColor" viewBox="0 0 24 24" width="20" height="20"><path d="M3,20V12a1,1,0,0,1,2,0v5.585L17.586,5H12a1,1,0,0,1,0-2h8a1,1,0,0,1,1,1v8a1,1,0,0,1-2,0V6.414L6.414,19H12a1,1,0,0,1,0,2H4A1,1,0,0,1,3,20Z"/></svg></a>');
                        }

                        $(_form).find('.ns-form-info .main_min_img').append(_img);

                        _ns_img_checked.push(_img_src);
                        
                        clearInterval(_interval);
                    };
        
                }, 1000);
                
            }
        }
    });
    
    /**
     * Fixed Variation Form
     */
    $('body').on('ns_variation_form_fixed', function() {
        if ($('.nasa-single-product-in-mobile form.cart.variations_form').length) {
            
            $('body').trigger('ns_before_variation_form_fixed');
            
            var _form = $('.nasa-single-product-in-mobile form.cart.variations_form');
            
            if ($(_form).find('.ns-form-close').length <= 0) {
                $(_form).append('<a class="ns-form-close nasa-stclose" href="javascript:void(0);" rel="nofollow"></a>');
            }
            
            if ($(_form).find('.ns-form-info').length <= 0) {
                $(_form).prepend('<div class="ns-form-info nasa-flex align-start margin-bottom-20"></div>');
            }
            
            if ($(_form).find('.ns-form-info .ns-info-wrap').length <= 0) {
                $(_form).find('.ns-form-info').append('<div class="ns-info-wrap"></div>');
            }
            
            if ($(_form).find('.ns-form-info .ns-info-wrap .ns-price-wrap').length <= 0) {
                $(_form).find('.ns-form-info .ns-info-wrap').append('<div class="ns-price-wrap"></div>');
            }
            
            /**
             * img change
             */
            $('body').trigger('ns_add_nasa_img_loading', [_form]);

            /**
             * price change
             */
            $('body').trigger('ns_add_nasa_price_loading', [_form]);
            
            /**
             * Size Guide
             */
            if ($('.nasa-single-product-in-mobile .nasa-wrap-popup-nodes .nasa-size-guide').length) {
                var _side_guide = $('.nasa-single-product-in-mobile .nasa-wrap-popup-nodes .nasa-size-guide .nasa-node-popup').clone();
                
                if (_side_guide && $(_form).find('.ns-info-variants .nasa-node-popup').length <= 0) {
                    _side_guide.text(_side_guide.text().trim());
                    $(_form).find('table.variations tbody tr:last-child .label').append(_side_guide);
                }
            }
            
            /**
             * Move Btns
             */
            if ($(_form).find('.ns-info-btns .variations_button').length <= 0) {
                if ($(_form).find('.ns-info-btns').length <= 0) {
                    $(_form).append('<div class="ns-info-btns"></div>');
                }
                
                var _btn = $(_form).find('.variations_button');
                
                if ($(_btn).length) {
                    $(_form).find('.ns-info-btns').append(_btn);
                }
                
                /**
                 * Compatible Woocommerce Custom Product Addons
                 */
                if ($(_form).find('.ns-info-btns .wcpa_form_outer').length) {
                    var _wcpa_form_outer = $(_form).find('.ns-info-btns .wcpa_form_outer');
                    
                    if ($(_form).find('.ns-info-variants').length) {
                        $(_form).find('.ns-info-variants').append(_wcpa_form_outer);
                    } else {
                        $(_form).find('.ns-info-btns').before(_wcpa_form_outer);
                    }
                }
            }
            
            /**
             * Checkout Plugins - Stripe for WooCommerce
             */
            if ($('.ns-ppc-wrap').length) {
                var _ppc = $('.ns-ppc-wrap');
                if ($(_form).find('.ns-info-variants').length) {
                    $(_form).find('.ns-info-variants').append(_ppc);
                } else {
                    $(_form).find('.ns-info-btns').before(_ppc);
                }
            }
            
            /**
             * Choose Variations
             */
            $('body').trigger('ns_variants_clone_render', [_form]);
            
            $('body').trigger('ns_after_variation_form_fixed');
        }
    }).trigger('ns_variation_form_fixed');
    
    /**
     * Variants Clone render
     */
    $('body').on('ns_variants_clone_render', function(e, _form) {
        if ($('.ns-variants-first').length <= 0) {
            $(_form).before('<div class="ns-begin-wrap ns-variants-first"></div>');
        }
        
        var _choose = '';
        
        var _tr_attrs = $('body').hasClass('app-attrs-full') ? '.variations tr' : '.variations tr:first-child';
        $(_form).find(_tr_attrs).each(function() {
            var _this = $(this);
    
            var _label = $(_this).find('th.label').length ? $(_this).find('th.label').clone() : null;
            
            if ($(_label).find('.nasa-node-popup').length) {
                $(_label).find('.nasa-node-popup').remove();
            }

            _choose += _label !== null ? '<div class="ns-variant-lbl">' + $(_label).html() + '</div>' : '';
    
            var _value = $(_this).find('td.value').length ? $(_this).find('td.value').clone() : null;
            
            if (_value !== null) {
                if ($(_value).find('.reset_variations').length) {
                    $(_value).find('.reset_variations').remove();
                }
    
                if ($(_value).find('[id]').length) {
                    $(_value).find('[id]').removeAttr('id');
                }

                if ($(_value).find('>select').length){
                    $('.ns-variants-first').addClass('nasa-attribute-select');
                }
    
                _choose += '<div class="ns-variant-val">' + $(_value).html() + '</div>';
            }
        });
        
        if (_choose !== '') {
            $('.ns-variants-first').html('<div class="ns-variants-clone"><a href="javascript:void(0);" class="ns-open-var-form" rel="nofollow"><svg width="11" height="11" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg></a>' + _choose + '</div>');
        }
        
        /**
         * Compatible - WooCommerce Dynamic Pricing & Discounts
         */
        if ($('#rp_wcdpd_pricing_table_variation_container').length && $(_form).find('.ns-info-variants #rp_wcdpd_pricing_table_variation_container').length <= 0) {
            $(_form).find('.ns-info-variants').prepend($('#rp_wcdpd_pricing_table_variation_container'));
        }
    });
    
    /**
     * Image Variation Changed
     */
    $('body').on('nasa_changed_gallery_variable_single nasa_after_changed_src_main_img', function() {
        var _form = $('.nasa-single-product-in-mobile form.cart.variations_form');
        
        /**
         * img change
         */
        $('body').trigger('ns_add_nasa_img_loading', [_form]);
        $('body').trigger('load_mini_popup');
        
        /**
         * Count items Slides
         * @type type
         */
        var _wrap = $('.nasa-main-image-default-wrap').parents('.product-images-slider');
        var _total_gallery = $('.main-images .item-wrap:not(.slick-cloned)').length;
        var _count = $(_wrap).find('.ns-img-count .ns-img-now');
        var _total = $(_wrap).find('.ns-img-count .ns-img-total');
        $(_count).text('1');
        $(_total).text(_total_gallery);
    
        if ($(_wrap).find('.nasa-single-arrow').length) {
            $(_wrap).find('.nasa-single-arrow[data-action="prev"]').addClass('nasa-disabled');
            
            if (_total_gallery > 1) {
                $(_wrap).find('.nasa-single-arrow[data-action="next"]').removeClass('nasa-disabled');
            } else {
                $(_wrap).find('.nasa-single-arrow[data-action="next"]').addClass('nasa-disabled');
            }
        }
    
    });
    
    /**
     * Form Close event
     */
    $('body').on('click', '.ns-form-close', function() {
        var _form = $(this).parents('form');
        $(_form).removeClass('ns-show');
    
        if ($(_form).hasClass('ns_add_to_cart_button_show')) {
            setTimeout(function() {
                $(_form).removeClass('ns_add_to_cart_button_show');
            }, 400);
        }
    
        if ($(_form).hasClass('ns_buy_now_button_show')) {
            setTimeout(function() {
                $(_form).removeClass('ns_buy_now_button_show');
            }, 400);
        }
        
        $('.black-window').fadeOut(400).removeClass('desk-window');

        $('body').removeClass('ovhd');
    });
    
    /**
     * Added To Cart - Then Close form
     */
    $('body').on('added_to_cart', function() {
        if ($('form.cart .ns-form-close').length) {
            $('form.cart .ns-form-close').trigger('click');
        }
        
        $('.ns_btn-fixed .single_add_to_cart_button').removeClass('loading');
    });
    
    /**
     * Change Count slide items
     */
    $('body').on('nasa_single_gallery_after_change', function(_ev, _main) {
        var _wrap = $(_main).parents('.product-images-slider');
        
        if ($(_wrap).find('.ns-img-count .ns-img-now').length) {
            var _slides = $(_wrap).find('.nasa-single-product-main-image');
            var _count = $(_wrap).find('.ns-img-count .ns-img-now');
            var _imgnow = $(_slides).find('.slick-track .item-wrap.slick-slide.slick-active');
            $(_count).text(parseInt(_imgnow.attr('data-slick-index')) + 1);
        }
    });
    
    /**
     * Zoom mini image - magnificPopup
     */
    $('body').on('load_mini_popup', function() {
        
    });
    
    /**
     * Show variation
     */
    $('body').on('show_variation', function() {
        var _form = $('.nasa-single-product-in-mobile form.cart.variations_form');
        
        /**
         * Price change
         */
        $('body').trigger('ns_add_nasa_price_loading', [_form]);
        
        /**
         * Choose Variations
         */
        $('body').trigger('ns_variants_clone_render', [_form]);
    });
    
    /**
     * Reset Variation
     */
    $('body').on('reset_data', function() {
        var _form = $('.nasa-single-product-in-mobile form.cart.variations_form');
        
        /**
         * Reset Stock
         */
        if ($(_form).find('.ns-form-info .ns-info-wrap .stock').length) {
            $(_form).find('.ns-form-info .ns-info-wrap .stock').remove();
        }
        
        /**
         * Reset Price
         */
        $('.price.org-price').show();
        $('.price.sub-price').remove();
        
        /**
         * Choose Variations
         */
        $('body').trigger('ns_variants_clone_render', [_form]);
    });
    
    /**
     * Bulk Discount price changed
     */
    $('body').on('ns_bulk_discount_changed', function() {
        var _form = $('.nasa-single-product-in-mobile form.cart.variations_form');
        
        if ($(_form).find('.nasa-variation-bulk-dsct').length <= 0 && $('.nasa-single-product-in-mobile .nasa-variation-bulk-dsct').length) {
            var _bulk = $('.nasa-single-product-in-mobile .nasa-variation-bulk-dsct');
            $(_form).find('.ns-info-variants').append(_bulk);
        }
        
        $('body').trigger('ns_variation_form_fixed');
        $('body').trigger('ns_add_nasa_price_loading', [_form]);
    });
    
    /**
     * Even Click Read more Tab content
     */
    $('body').on('click', '.ns-btn-read-more', function() {
        var _this = $(this);
        //var _row = $(_this).parents('.row:not(.nasa-product-details-page)');
        var _row = $(_this).parents('.ns-tab-item');
        // var _read =$(_row).find('.ns-read-more');
        if (!$(_row).hasClass('ns-row-active')) {
            $(_row).addClass('ns-row-active');
            $(_this).find('.ns-btn-read-more-text').html($(_this).attr('data-show-less'));
        } else {
            $(_row).removeClass('ns-row-active');
            $('body').trigger('nasa_animate_scroll_to_top', [$, _row, 500]);
            $(_this).find('.ns-btn-read-more-text').html($(_this).attr('data-show-more'));
        }
    });
    
    /**
     * Add Read more for WooCommerce Tab content
     */
    $('body').on('ns_add_read_more', function() {
        // if ($('#review_form_wrapper').length && $('.btn-add-new-review').length <= 0) {
        //     var _text = $('[name="ns-add-review"]').length ? $('[name="ns-add-review"]').val() : 'Write a review';
        //     $('#review_form_wrapper').after('<a class="button btn-add-new-review" href="javascript:void(0);" rel="nofollow">' + _text + '</a>');
        // }
        
        if ($('.woocommerce-tabs .ns-tab-item').length && $('#tmp-read-more-tab').length) {
            var _ns_readmore = $('#tmp-read-more-tab').html();
            
            $('.woocommerce-tabs .ns-tab-item').each(function() {
                var _this = $(this);
                
                if ($(_this).find('.ns-read-more').length <= 0) {
                    $(_this).append(_ns_readmore);
                }
        
                if ($(_this).find('.nasa-content-accessories_content, .nasa-content-additional_information, .cr-reviews-ajax-reviews').length) {
                    $(_this).removeClass('ns-tab-item');
                    $(_this).addClass('ns-tab-no-read-more');
                }
        
                if ($(_this).find('.nasa-content-reviews').length) {
                    $(_this).addClass('ns-tab-reviews');
                }
            });
        }
    }).trigger('ns_add_read_more');
    
    /**
     * After Loaded Ajax complete
     */
    $('body').on('nasa_after_loaded_ajax_complete', function() {
        if ($('body').find('.ns_btn-fixed').length) {
            $('body').find('.ns_btn-fixed').remove();
        }
        
        $('body').trigger('ns_btns_fixed');
        $('body').trigger('ns_hide_simple_cart_form');
        $('body').trigger('ns_variation_form_fixed');
        $('body').trigger('ns_add_read_more');
    });
    
    //swipe down to close variations_form, size-guide, delivery-return, ask-a-quetion.
    $('body').on('touchstart', '.variations_form, #nasa-content-size-guide, #nasa-content-delivery-return, #nasa-content-ask-a-quetion, #review_form_wrapper, #nasa-content-request-a-callback', function(e) {
        var scrollTop = $(this).find('.ns-inct').scrollTop();

        if ($(e.target).parents('.nasa-popup-content-contact').length) {
            scrollTop = $(this).find('.nasa-wrap').scrollTop();
            if ($(e.target).attr('name') == 'your-message') {
                var st = $(e.target).scrollTop();
                if(st > 0) {
                    scrollTop = 100;
                }
            }
        }

        if ($(e.target).parents('.variations_form').length) {
            scrollTop = $(this).find('.ns-info-variants').scrollTop();
        }

        if ($(e.target).parents('#review_form_wrapper').length) {
            scrollTop = $(this).scrollTop();

            if ($(e.target).attr('id') == 'comment') {
                var st = $(e.target).scrollTop();
                if (st > 0) {
                    scrollTop = 100;
                }
            }
        }

        if ($(e.target).hasClass('nasa-product') || $(e.target).attr('id') == 'nasa-content-size-guide' || $(e.target).attr('id') == 'nasa-content-delivery-return') {
            scrollTop = 0;
        }
        
        if (scrollTop <= 0) {
            touchstart = e.touches[0].clientY;
        }
    });
    
    $('body').on('touchend', '.variations_form, #nasa-content-size-guide, #nasa-content-delivery-return, #nasa-content-ask-a-quetion, #review_form_wrapper, #nasa-content-request-a-callback', function(e) {
        touchend = e.changedTouches[0].clientY;
        
        if (touchstart != touchend && touchstart != 0 && Math.abs(touchstart - touchend) > distance) {
            if (touchstart < touchend) {
                $(this).find('a.nasa-stclose').trigger('click');
            }
        }
        
        touchend = 0;
        touchstart = 0;
    });

    if ($('.related-product .nasa-title-relate').length) {
        $('.related-product .nasa-title-relate').removeClass('text-center');
    }

    //swipe photoswipe X
    // $('body').on('touchstart', '.pswp .comment-text',function(e) {
    //     touchstart = e.touches[0].clientX;
    // });
    
    // $('body').on('touchend', '.pswp .comment-text',function(e) {
    //     touchend  = e.changedTouches[0].clientX;
        
    //     if (touchstart != touchend && touchstart != 0 && Math.abs(touchstart - touchend) > distance) {
    //         if (touchstart > touchend) {
    //             $('.pswp__button--arrow--right').trigger('click');
    //         } else {
    //             $('.pswp__button--arrow--left').trigger('click');
    //         }
    //     }
        
    //     touchend = 0;
    //     touchstart = 0;
    // });

    $('body').on('mini_cart_mobile_layout_change_single_page',function() {
        var _nasa_product_details_page = $('.nasa-product-details-page.nasa-top-navigaton');
    
        setTimeout(function() {
            if ($(_nasa_product_details_page).length && $('body').hasClass('nasa-mobile-app')) {
                var _woocommerce_tabs = $(_nasa_product_details_page).find('.woocommerce-tabs');
                var _ns_tab_item = $(_woocommerce_tabs).find('>.row');
                var _product_header = $('body').find('.nasa-header-mobile-layout .sticky-wrapper');
                var _related_product =  $('body').find('.related-product:first');
                var _focus_info =  $(_nasa_product_details_page).find('.focus-info');
                
                var _title = '';
                var _target = '';
    
                var html = '<div class="nasa-bc-details-page-wrap"><div class="nasa-iflex flex-nowrap">';
    
                if ($(_focus_info).length) {
                    _title = $('body').find('input[name="nasa-title-bc-general"]').val();
                    _target = '.focus-info';
    
                    html += '<a href="javascript:void(0);" title="' + _title + '" rel="nofollow" class="nasa-bold-500 nasa-bc-details-step" data-target="' + _target + '">' + _title + '</a>';
                }
    
                $(_ns_tab_item).each(function() {
                    var _this = $(this);
                    var _nasa_content = $(_this).find('.nasa-content');
                    _title = $(_nasa_content).find('.ns-woo-tab-title').length ? $(_nasa_content).find('.ns-woo-tab-title').text().trim() : '';
                    var _id = $(_nasa_content).attr('id');
    
                    if (_id == 'nasa-scroll-reviews') {
                         _title = $('body').find('input[name="nasa-title-bc-review"]').val();
                    }
    
                    if (_id == 'nasa-scroll-reviews' | _id == 'nasa-scroll-description') {
                        html += '<a href="javascript:void(0);" title="'+_title+'" rel="nofollow" class="nasa-bold-500 nasa-bc-details-step" data-target="#' + _id + '">' + _title + '</a>';
                    } 
                    else if ($(_nasa_product_details_page).hasClass('nasa-top-navigaton-ctab') && _id !== 'nasa-scroll-accessories_content') {
                        html += '<a href="javascript:void(0);" title="'+_title+'" rel="nofollow" class="nasa-bold-500 nasa-bc-details-step" data-target="#' + _id + '">' + _title + '</a>';
                    }
                });
    
                if ($(_related_product).length) {
                    _title = $('body').find('input[name="nasa-title-bc-recommendation"]').val();
                    _target = '.related-product:first';
    
                    html += '<a href="javascript:void(0);" title="' + _title + '" rel="nofollow" class="nasa-bold-500 nasa-bc-details-step" data-target="' + _target + '">' + _title + '</a>';
                }
    
                html += '</div></div>';
    
                if ($(_product_header).length) {
                    $(_product_header).append(html);
                    $(_product_header).find('.nasa-bc-details-step:first-child').addClass('nasa-active');
                }
            }
        }, 1000);
    
    }).trigger('mini_cart_mobile_layout_change_single_page');
    
    $('body').on('click', '.nasa-bc-details-step', function(){
        var _this = $(this);
        var _target = $(_this).attr('data-target');
        var _nasa_ajax_store = $('#nasa-ajax-store');
        var _row = $(_nasa_ajax_store).find(_target);
        $(_this).addClass('on-scrolling nasa-active').siblings().removeClass('nasa-active');
        
        $('body').trigger('nasa_animate_scroll_to_top', [$, _row, 500]);
    
        var _first = $('.nasa-bc-details-page-wrap').find('.nasa-bc-details-step:first');
        var p_w = $('.nasa-bc-details-page-wrap').outerWidth();
        var c_w = $(_this).outerWidth();
        var _pos_left = $(_this).offset().left;
        var _f_pos = $(_first).offset().left;
    
        $('.nasa-bc-details-page-wrap').animate({scrollLeft: _pos_left - _f_pos -(p_w - c_w)/2}, 200);
        
        setTimeout(function() {
            $(_this).removeClass('on-scrolling');
        },500);
    
    });
    
    $('body').on('nasa_after_loaded_ajax_complete', function() {
        $('body').trigger('mini_cart_mobile_layout_change_single_page');
    });
});
/* End Document Ready */
    