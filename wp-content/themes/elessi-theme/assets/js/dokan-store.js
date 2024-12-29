/**
 * Document ready
 * 
 * For Dokan store
 */
    
jQuery(document).ready(function($) {
"use strict";

/**
 * Remove Crazy Load Effect
 */
if ($('.nasa-crazy-load.crazy-loading').length) {
    $('.nasa-crazy-load.crazy-loading').removeClass('crazy-loading');
}

if ($('.nasa-login-register-ajax').length && $('#nasa-login-register-form').length) {
    /**
     * Compatible with Dokan
     */
    if (typeof dokan !== 'undefined' && typeof DokanValidateMsg !== 'undefined') {
        popup_registration_dokan($);
    }
}

$('body').on('nasa_login_register_ajax_inited', function() {
    if ($('.nasa-login-register-ajax').length && $('#nasa-login-register-form').length) {
        /**
         * Compatible with Dokan
         */
        if (typeof dokan !== 'undefined' && typeof DokanValidateMsg !== 'undefined') {
            popup_registration_dokan($);
        }
    }
});

/**
 * DOKAN Sidebar
 */
if ($('.dokan-store-sidebar').length && $('.dokan-single-store').length) {
    $('body').prepend(
        '<a class="toggle-sidebar-dokan hidden-tag" href="javascript:void(0);">' +
            '<svg viewBox="0 0 32 32" width="26" height="24" fill="currentColor"><path d="M 4 7 L 4 9 L 28 9 L 28 7 Z M 4 15 L 4 17 L 28 17 L 28 15 Z M 4 23 L 4 25 L 28 25 L 28 23 Z"/></svg>' +
        '</a>'
    );
    
    $('.dokan-store-sidebar').prepend('<a href="javascript:void(0);" class="hidden-tag nasa-close-sidebar"><svg class="nasa-rotate-180" width="15" height="15" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg></a>');
    
    $('body').on('click', '.toggle-sidebar-dokan', function() {
        $('.black-window').fadeIn(200);
        
        if (!$('body').hasClass('m-ovhd')) {
            $('body').addClass('m-ovhd');
        }
        
        if (!$('.dokan-store-sidebar').hasClass('nasa-active')) {
            $('.dokan-store-sidebar').addClass('nasa-active');
        }
    });
}

if ($('#wpadminbar').length) {
    var _mobileView = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
    var _inMobile = $('body').hasClass('nasa-in-mobile') ? true : false;
    
    if (_mobileView || _inMobile) {
        var height_adminbar = $('#wpadminbar').height();
        
        if ($('.dokan-store-sidebar').length && $('.dokan-single-store').length) {
            $('.dokan-store-sidebar').css({'top' : height_adminbar});
        }
    }
}

if ($('.nasa-change-view').length && $('.dokan-store-products-filter-area').length) {
    $('.dokan-store-products-filter-area').append($('.nasa-change-view'));
}

/**
 * Even change layout
 */
$('body').on('click', '.nasa-change-layout', function() {
    var _this = $(this);
    if ($(_this).hasClass('active')) {
        return false;
    } else {
        change_layout_dokan_store($, _this);
    }
});

/**
 * Clone group btn for list layout
 */
dokan_clone_group_btns_product_item($);
$('body').on('nasa_store_changed_layout_list', function() {
    dokan_clone_group_btns_product_item($);
});

/**
 * Remove Change view in Nasa Store List
 */
if ($('.nasa-store-lists-filters .toggle-view').length) {
    setTimeout(function() {
        if ($('.nasa-store-lists-filters .toggle-view [data-view="grid-view"]').length) {
            $('.nasa-store-lists-filters .toggle-view [data-view="grid-view"]').trigger('click');
        }

        $('.nasa-store-lists-filters .toggle-view').remove();
    }, 100);
}

/* End Document Ready */
});

/**
 * Dokan Registration
 */
function popup_registration_dokan($) {
    var Popup_Dokan_Vendor_Registration = {

        init: function () {
            var form = $('form.register');

            // bind events
            $('.user-role input[type=radio]', form).on('change', this.showSellerForm);
            $('.tc_check_box', form).on('click', this.onTOC);
            $('#shop-phone', form).keydown(this.ensurePhoneNumber);
            $('#company-name', form).on('focusout', this.generateSlugFromCompany);

            $('#seller-url', form).keydown(this.constrainSlug);
            $('#seller-url', form).keyup(this.renderUrl);
            $('#seller-url', form).on('focusout', this.checkSlugAvailability);

            this.validationLocalized();
        },

        validate: function (self) {

            $('form.register').validate({
                errorPlacement: function (error, element) {
                    var form_group = $(element).closest('.form-group');
                    form_group.addClass('has-error').append(error);
                },
                success: function (label, element) {
                    $(element).closest('.form-group').removeClass('has-error');
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        },

        showSellerForm: function () {
            var value = $(this).val();

            if (value === 'seller') {
                $('.show_if_seller').find('input, select').removeAttr('disabled');
                $('.show_if_seller').slideDown();

                if ($('.tc_check_box').length > 0) {
                    $('button[name=register]').attr('disabled', 'disabled');
                }

            } else {
                $('.show_if_seller').find('input, select').attr('disabled', 'disabled');
                $('.show_if_seller').slideUp();

                if ($('.tc_check_box').length > 0) {
                    $('button[name=register]').removeAttr('disabled');
                }
            }
        },

        onTOC: function () {
            var chk_value = $(this).val();

            if ($(this).prop("checked")) {
                $('input[name=register]').removeAttr('disabled');
                $('button[name=register]').removeAttr('disabled');
                $('input[name=dokan_migration]').removeAttr('disabled');
            } else {
                $('input[name=register]').attr('disabled', 'disabled');
                $('button[name=register]').attr('disabled', 'disabled');
                $('input[name=dokan_migration]').attr('disabled', 'disabled');
            }
        },

        ensurePhoneNumber: function (e) {
            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 91, 107, 109, 110, 187, 189, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }

            // Ensure that it is a number and stop the keypress
            if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        },

        generateSlugFromCompany: function () {
            var value = $(this).val();
            
            if (!value) {
                value = "";
            }
            
            value = decodeURIComponent(value);

            $('#seller-url').val(value);
            $('#url-alart').text(value);
            $('#seller-url').focus();
        },
        
        constrainSlug: function (e) {
            var text = $(this).val();

            // Allow: backspace, delete, tab, escape, enter and .
            if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 91, 109, 110, 173, 189, 190]) !== -1 ||
                // Allow: Ctrl+A
                (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
                (e.keyCode >= 35 && e.keyCode <= 39)) {
                // let it happen, don't do anything
                return;
            }

            if ((e.shiftKey || (e.keyCode < 65 || e.keyCode > 90) && (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        },

        checkSlugAvailability: function () {
            var self = $(this),
                data = {
                    action: 'shop_url',
                    url_slug: self.val(),
                    _nonce: dokan.nonce
                };

            if (self.val() === '') {
                return;
            }

            var row = self.closest('.form-row');
            row.block({
                message: null,
                overlayCSS: {
                    background: '#fff url(' + dokan.ajax_loader + ') no-repeat center',
                    opacity: 0.6
                }
            });

            $.post(dokan.ajaxurl, data, function (resp) {

                if (resp.success === true) {
                    $('#url-alart').removeClass('text-danger').addClass('text-success');
                    $('#url-alart-mgs').removeClass('text-danger').addClass('text-success').text(dokan.seller.available);
                } else {
                    $('#url-alart').removeClass('text-success').addClass('text-danger');
                    $('#url-alart-mgs').removeClass('text-success').addClass('text-danger').text(dokan.seller.notAvailable);
                }

                row.unblock();

            });
        },

        renderUrl: function () {
            $('#url-alart').text($(this).val());
        },

        validationLocalized: function () {
            var dokan_messages = DokanValidateMsg;

            dokan_messages.maxlength = $.validator.format(dokan_messages.maxlength_msg);
            dokan_messages.minlength = $.validator.format(dokan_messages.minlength_msg);
            dokan_messages.rangelength = $.validator.format(dokan_messages.rangelength_msg);
            dokan_messages.range = $.validator.format(dokan_messages.range_msg);
            dokan_messages.max = $.validator.format(dokan_messages.max_msg);
            dokan_messages.min = $.validator.format(dokan_messages.min_msg);

            $.validator.messages = dokan_messages;
        }
    };
    
    if ($('input[name="nasa-caching-enable"]').length && $('input[name="nasa-caching-enable"]').val() === '1') {
        $('body').on('nasa_after_load_static_content', function() {
            if ($('#nasa-login-register-form form.register').length) {
                Popup_Dokan_Vendor_Registration.init();

                $('.show_if_seller').find('input, select').attr('disabled', 'disabled');

                // trigger change if there is an error while registering
                var shouldTrigger = $('.woocommerce ul').hasClass('woocommerce-error') && !$('.show_if_seller').is(':hidden');

                if (shouldTrigger) {
                    var form = $('form.register');

                    $('.user-role input[type=radio]', form).trigger('change');
                }

                // disable migration button if checkbox isn't checked
                if ($('.tc_check_box').length > 0) {
                    $('input[name=dokan_migration]').attr('disabled', 'disabled');
                    $('input[name=register]').attr('disabled', 'disabled');
                }
            }
        });
    }
    
    else {
        if ($('#nasa-login-register-form form.register').length) {
            Popup_Dokan_Vendor_Registration.init();

            $('.show_if_seller').find('input, select').attr('disabled', 'disabled');

            // trigger change if there is an error while registering
            var shouldTrigger = $('.woocommerce ul').hasClass('woocommerce-error') && !$('.show_if_seller').is(':hidden');

            if (shouldTrigger) {
                var form = $('form.register');

                $('.user-role input[type=radio]', form).trigger('change');
            }

            // disable migration button if checkbox isn't checked
            if ($('.tc_check_box').length > 0) {
                $('input[name=dokan_migration]').attr('disabled', 'disabled');
                $('input[name=register]').attr('disabled', 'disabled');
            }
        }
    }
}

/**
 * Change layout Grid | List Dokan Store
 * 
 * @param {type} $
 * @param {type} _this
 * @returns {undefined}
 */
function change_layout_dokan_store($, _this) {
    var value_view, item_row, class_items;
    
    var _url = new URL(window.location.href);
    
    var _destroy = false;
    
    if ($(_this).hasClass('productList')) {
        value_view = 'list';
        _destroy = true;
        $('.nasa-content-page-products .products').removeClass('grid').addClass('list');
        
        $('body').trigger('nasa_store_changed_layout_list');
    } else {
        var columns = $(_this).attr('data-columns');
        class_items = 'products grid';

        switch (columns) {
            case '2' :
                item_row = 2;
                value_view = 'grid-2';
                class_items += ' large-block-grid-2';
                break;
            case '3' :
                item_row = 3;
                value_view = 'grid-3';
                class_items += ' large-block-grid-3';
                break;
            
            case '5' :
                item_row = 5;
                value_view = 'grid-5';
                class_items += ' large-block-grid-5';
                break;
                
            case '6' :
                item_row = 5;
                value_view = 'grid-6';
                class_items += ' large-block-grid-6';
                break;
                
            case '4' :
            default :
                item_row = 4;
                value_view = 'grid-4';
                class_items += ' large-block-grid-4';
                break;
        }

        var count = $('.nasa-content-page-products .products').find('.product-warp-item').length;
        if (count > 0) {
            var _wrap_all = $('.nasa-content-page-products .products');
            var _col_small = $(_wrap_all).attr('data-columns_small');
            var _col_medium = $(_wrap_all).attr('data-columns_medium');
            
            switch (_col_small) {
                case '2' :
                    class_items += ' small-block-grid-2';
                    break;
                case '1' :
                default :
                    class_items += ' small-block-grid-1';
                    break;
            }
            
            switch (_col_medium) {
                case '3' :
                    class_items += ' medium-block-grid-3';
                    break;
                case '4' :
                    class_items += ' medium-block-grid-4';
                    break;
                case '2' :
                default :
                    class_items += ' medium-block-grid-2';
                    break;
            }
            
            $('.nasa-content-page-products .products').attr('class', class_items);
        }
        
        $('body').trigger('nasa_store_changed_layout_grid', [columns, class_items]);
    }

    $(".nasa-change-layout").removeClass("active");
    $(_this).addClass("active");
    
    if ($(_this).hasClass('df')) {
        _url.searchParams.delete('view-layout');
    } else {
        _url.searchParams.set('view-layout', value_view);
    }
    
    window.history.pushState(_url.href, '', _url.href);
    
    $('body').trigger('nasa_before_change_view');
    
    if (!_destroy) {
        $('body').trigger('nasa_before_change_view_timeout', [_destroy]);
    } else {
        setTimeout(function() {
            $('body').trigger('nasa_before_change_view_timeout', [_destroy]);
        }, 500);
    }
}

/**
 * clone group btn loop products
 * 
 * @param {type} $
 * @returns {undefined}
 */
function dokan_clone_group_btns_product_item($) {
    var _list = $('.products').length && $('.products').hasClass('list') ? true : false;
    
    if (_list && $('.nasa-content-page-products .product-item').length) {
        $('.nasa-content-page-products .product-item').each(function() {
            var _wrap = $(this);
            
            if (!$(_wrap).hasClass('nasa-list-cloned')) {
                $(_wrap).addClass('nasa-list-cloned');
                
                if ($(_wrap).find('.group-btn-in-list').length < 1) {
                    $(_wrap).append('<div class="group-btn-in-list nasa-group-btns hidden-tag"></div>');
                }
                    
                var _place = $(_wrap).find('.group-btn-in-list');
                var _price = '';
                if ($(_wrap).find('.price-wrap').length) {
                    _price = $(_wrap).find('.price-wrap').html();
                } else if ($(_wrap).find('.price').length) {
                    _price = $(_wrap).find('.price').clone().wrap('<div class="price-wrap"></div>').parent().html();
                }
                
                if (_price !== '') {
                    $(_place).append('<div class="price-wrap">' + _price + '</div>');
                }

                if ($(_wrap).find('.nasa-list-stock-wrap').length) {
                    $(_place).append($(_wrap).find('.nasa-list-stock-wrap').html());
                    $(_wrap).find('.nasa-list-stock-wrap').remove();
                }
                
                if ($(_wrap).find('.btn-link').length && $(_place).length) {
                    var _add = $(_wrap).find('.add-to-cart-grid').clone();
                    
                    if ($(_add).length) {
                        $(_place).append(_add);
                    }
                    
                    $(_wrap).find('.btn-link').each(function() {
                        var _btn = $(this).clone();
                        if (!$(_btn).hasClass('add-to-cart-grid')) {
                            $(_place).append(_btn);
                        }
                    });
                    
                    if ($(_place).find('.btn-link').length) {
                        $(_place).find('.btn-link').each(function() {
                            if (
                                $(this).find('.nasa-icon-text').length <= 0 &&
                                // $(this).find('.nasa-icon').length &&
                                $(this).attr('data-icon-text')
                            ) {
                                $(this).append(
                                    '<span class="nasa-icon-text">' +
                                        $(this).attr('data-icon-text') +
                                    '</span>'
                                );
                            }
                        });
                    }
                    
                    if ($(_place).find('.btn-wishlist.btn-link').length && $(_place).find('.add-to-cart-grid.btn-link').length) {
                        $(_place).find('.add-to-cart-grid.btn-link').after($(_place).find('.btn-wishlist.btn-link'));
                    }
                }
                
                /**
                 * Deal Time
                 */
                if ($(_wrap).find('.nasa-sc-pdeal-countdown .countdown').length) {
                    var _countdown = $(_wrap).find('.nasa-sc-pdeal-countdown').clone();
                    $(_countdown).find('.countdown').removeClass('is-countdown');
                    $(_countdown).find('.countdown').removeClass('countdown-rtl');
                    $(_countdown).find('.countdown').removeClass('countdown-loaded');
                    
                    $(_countdown).find('.countdown').html('');
                    
                    if ($(_wrap).find('.product-info-wrap .nasa-sc-pdeal-countdown').length) {
                        $(_wrap).find('.product-info-wrap .nasa-sc-pdeal-countdown').replaceWith(_countdown);
                    } else {
                        if ($(_wrap).find('.product-des-wrap').length) {
                            $(_wrap).find('.product-des-wrap').before(_countdown);
                        } else {
                            $(_wrap).find('.product-info-wrap').append(_countdown);
                        }
                    }
                    
                    $('body').trigger('nasa_load_countdown');
                }
            }
        });
    }
}
