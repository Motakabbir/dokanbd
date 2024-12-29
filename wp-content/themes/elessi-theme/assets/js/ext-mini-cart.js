/* Document ready */
jQuery(document).ready(function($) {
"use strict";

/**
 * Check if a node is blocked for processing.
 *
 * @param {JQuery Object} $node
 * @return {bool} True if the DOM Element is UI Blocked, false if not.
 */
var mini_cart_ext_is_blocked = function($node) {
    return $node.is('.processing') || $node.parents('.processing').length;
};

/**
 * Block a node visually for processing.
 *
 * @param {JQuery Object} $node
 */
var mini_cart_ext_block = function($node) {
    $('body').trigger('nasa_publish_coupon_refresh');
    
    if (!mini_cart_ext_is_blocked($node)) {
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
 * Unblock a node after processing is complete.
 *
 * @param {JQuery Object} $node
 */
var mini_cart_ext_unblock = function($node) {
    $node.removeClass('processing').unblock();
    
    if ($node.find('.nasa-close-node').length) {
        $node.find('.nasa-close-node').trigger('click');
    }
    
    $('body').trigger('nasa_publish_coupon_refresh');
    
    if ($('#cart-sidebar select.country_to_state, #cart-sidebar input.country_to_state').length) {
        $('#cart-sidebar select.country_to_state, #cart-sidebar input.country_to_state').trigger('change');
        $(document.body).trigger('country_to_state_changed'); // Trigger select2 to load.
    }
};

var mini_cart_ext_url = function(endpoint) {
    return ext_mini_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', endpoint);
};

/**
 * Show mess
 * @param {type} mess
 * @returns {undefined}
 */
var _ext_remove_mess;
var mini_cart_ext_mess = function(mess) {
    $('.ext-mini-cart-wrap .mess-wrap').remove();
    $('.ext-mini-cart-wrap').append('<div class="mess-wrap">' + mess + '</div>');
    
    if (_ext_remove_mess) {
        clearTimeout(_ext_remove_mess);
    }
    
    _ext_remove_mess = setTimeout(function() {
        $('.ext-mini-cart-wrap .mess-wrap').remove();
    }, 5000);
};

$('body').on('nasa_opened_cart_sidebar', function() {
    if (!$('body').hasClass('canvas-on')) {
        $('body').addClass('canvas-on');
    }
    
    $('body').trigger('ns_render_ext_mini_cart_nonce');
    $('body').trigger('nasa_publish_coupon_refresh');
});

$('body').on('nasa_after_close_fog_window', function() {
    $('body').removeClass('canvas-on');
});

/**
 * Close Node
 */
$('body').on('click', '.nasa-close-node', function() {
    var _cart = $(this).parents('.nasa-static-sidebar');
    var _node = $(this).parents('.ext-node');

    if($(this).parents('.ns-cart-popup-wrap').length) {
        _cart = $(this).parents('.ns-cart-popup');
    }
    
    if ($(_cart).length) {
        $(_cart).removeClass('ext-loading');
    }
    
    if ($(_node).length) {
        $(_node).removeClass('active');
    }

    if ($(_node).hasClass('mini-cart-change-variation')) {
        nasa_quick_viewimg = false;
        setTimeout(function(){
            $(_node).find('.product-lightbox').remove();
        },100);
    }
    
    $(_cart).find('.close-nodes').remove();
});

/**
 * Global Close
 */
$('body').on('click', '.nasa-static-sidebar .close-nodes, .ns-cart-popup .close-nodes', function() {
    var _wrap = $(this).parents('.ns-cart-popup-wrap').length ? $(this).parents('.ns-cart-popup') : $(this).parents('.nasa-static-sidebar');;
    var _close = $(_wrap).find('.ext-nodes-wrap .ext-node.active .nasa-close-node');

    if ($(_close).length) {
        $(_close).trigger('click');
    }
});

/**
 * Open ext mini cart
 */
$('body').on('click', '.ext-mini-cart', function() {
    var _act = $(this).attr('data-act'),
        _cart = $(this).parents('.nasa-static-sidebar');

    if($(this).parents('.ns-cart-popup-wrap').length) {
        _cart = $(this).parents('.ns-cart-popup');
    }
        
    if ($(_cart).find('.ext-mini-cart-wrap').length && !$(_cart).find('.ext-mini-cart-wrap').hasClass('nasa-disable')) {
        
        if (!$('body').hasClass('canvas-on')) {
            $('body').addClass('canvas-on');
        }

        if (!$(_cart).hasClass('ext-loading')) {
            $(_cart).addClass('ext-loading');
        }
        
        if ($(_cart).find('.close-nodes').length < 1) {
            $(_cart).append('<a href="javascript:void(0);" class="close-nodes"></a>');
        }

        $(_cart).find('.ext-nodes-wrap .ext-node').removeClass('active');

        if ($(_cart).find('.ext-nodes-wrap .ext-node.mini-cart-' + _act).length) {
            $(_cart).find('.ext-nodes-wrap .ext-node.mini-cart-' + _act).addClass('active');
        }
    }
});

/**
 * ext mini cart Note
 */
$('body').on('click', '#mini-cart-save_note', function(e) {
    e.preventDefault();
    
    var _this = $(this);
    var _wnote = $(_this).parents('.ext-node');
    
    if (!$(_this).hasClass('nasa-disable')) {
        $(_this).addClass('nasa-disable');
        
        var _wrap = $(_this).parents('.nasa-static-sidebar');
        if ($(_wrap).length < 1) {
            _wrap = $(_this).parents('.widget_shopping_cart_content');
        }

        var _note = $('.mini-cart-note textarea[name="order_comments"]').val();

        mini_cart_ext_block(_wrap);
        
        $(_wnote).removeClass('active');

        $.ajax({
            url: mini_cart_ext_url('nasa_mini_cart_note'),
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {
                order_comments: _note
            },
            success: function(data) {
                $('#cart-sidebar').find('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
                $(_this).removeClass('nasa-disable');

                if (data) {
                    if (data.fragments) {
                        $.each(data.fragments, function(key, value) {
                            if ($(key).length) {
                                $(key).replaceWith(value);
                            }
                        });

                        // $('body').trigger('added_to_cart', [data.fragments, data.cart_hash, _this]);
                        $('body').trigger('wc_fragments_refreshed');
                        // $('body').trigger('wc_fragment_refresh');

                        /**
                         * notification free shipping
                         */
                        $('body').trigger('nasa_init_shipping_free_notification');
                    }

                    /**
                     * mess
                     */
                    if (data.mess) {
                        mini_cart_ext_mess(data.mess);
                    }
                }

                $('body').trigger('mini_cart_mobile_layout_change');

                mini_cart_ext_unblock(_wrap);
            },
            complete: function() {
                mini_cart_ext_unblock(_wrap);
            }
        });
    }
});

$('body').on('wc_fragments_refreshed', function() {
    if ($('#cart-sidebar select.country_to_state, #cart-sidebar input.country_to_state').length) {
        $('#cart-sidebar select.country_to_state, #cart-sidebar input.country_to_state').trigger('change');
        $(document.body).trigger('country_to_state_changed'); // Trigger select2 to load.
    }
});

/**
 * Publish Coupons
 */
$('body').on('nasa_publish_coupon_refresh', function() {
    if ($('.mini-cart-coupon .publish-coupon').length) {
        $('.mini-cart-coupon .publish-coupon').each(function() {
            var _this = $(this);
            var _code = $(_this).attr('data-code');
            
            $(_this).removeClass('nasa-actived');
            
            if ($('.coupon-wrap[data-code="' + _code + '"]').length) {
                $(_this).addClass('nasa-actived');
            }
        });
    }
});

/**
 * From Publish Coupon
 */
$('body').on('click', '.mini-cart-coupon .publish-coupon:not(.nasa-actived)', function() {
    var _this = (this);
    var _code = $(_this).attr('data-code');
    
    if ($('#mini-cart-add-coupon_code').length) {
        $('#mini-cart-add-coupon_code').val(_code).trigger('change');
        
        if ($('#mini-cart-apply_coupon').length) {
            $('#mini-cart-apply_coupon').trigger('click');
        }
    }
});

/**
 * Apply Coupon
 */
$('body').on('click', '#mini-cart-apply_coupon', function(e) {
    e.preventDefault();
    
    var _this = $(this);
    var _wnote = $(_this).parents('.ext-node');
    
    var _nonce = $('.mini-cart-ajax-nonce input[name=apply_coupon_nonce]').length ? $('.mini-cart-ajax-nonce input[name=apply_coupon_nonce]').val() : null;
    
    if (_nonce && !$(_this).hasClass('nasa-disable')) {
        $(_this).addClass('nasa-disable');
        
        var _wrap = $(_this).parents('.nasa-static-sidebar');
        if ($(_wrap).length < 1) {
            _wrap = $(_this).parents('.widget_shopping_cart_content');
        }

        var coupon = $('input#mini-cart-add-coupon_code').val();

        if (coupon) {
            mini_cart_ext_block(_wrap);
            $(_wnote).removeClass('active');

            var _data = {
                security: _nonce,
                coupon_code: coupon
            };

            $.ajax({
                type: 'POST',
                url: mini_cart_ext_url('nasa_mini_cart_apply_coupon'),
                data: _data,
                dataType: 'json',
                success: function(data) {
                    $('#cart-sidebar').find('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
                    $(_this).removeClass('nasa-disable');

                    if (data) {
                        if (data.fragments) {
                            $.each(data.fragments, function(key, value) {
                                if ($(key).length) {
                                    $(key).replaceWith(value);
                                }
                            });

                            // $('body').trigger('added_to_cart', [data.fragments, data.cart_hash, _this]);
                            $('body').trigger('wc_fragments_refreshed');
                            // $('body').trigger('wc_fragment_refresh');

                            /**
                             * notification free shipping
                             */
                            $('body').trigger('nasa_init_shipping_free_notification');
                        }

                        /**
                         * mess
                         */
                        if (data.mess) {
                            mini_cart_ext_mess(data.mess);
                        }

                        $('input#mini-cart-add-coupon_code').val('').trigger('change');
                    }

                    $('body').trigger('mini_cart_mobile_layout_change');

                    mini_cart_ext_unblock(_wrap);
                },
                complete: function() {
                    mini_cart_ext_unblock(_wrap);
                }
            });
        }
        else {
            $(_this).removeClass('nasa-disable');
        }
    }
});

/**
 * Remove Coupon
 */
$('body').on('click', '.widget_shopping_cart_content .woocommerce-remove-coupon', function(e) {
    e.preventDefault();
    
    var _this = $(this);
    
    var _nonce = $('.mini-cart-ajax-nonce input[name=remove_coupon_nonce]').length ? $('.mini-cart-ajax-nonce input[name=remove_coupon_nonce]').val() : null;
    
    if (_nonce && !$(_this).hasClass('nasa-disable')) {
        $(_this).addClass('nasa-disable');
        
        var _wrap = $(_this).parents('.nasa-static-sidebar');
        if ($(_wrap).length < 1) {
            _wrap = $(_this).parents('.widget_shopping_cart_content');
        }

        mini_cart_ext_block(_wrap);

        var coupon  = $(_this).attr('data-coupon');

        var _data = {
            security: _nonce,
            coupon: coupon
        };

        $.ajax({
            type: 'POST',
            url: mini_cart_ext_url('nasa_mini_cart_remove_coupon'),
            data: _data,
            dataType: 'json',
            success: function(data) {
                $('#cart-sidebar').find('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
                $(_this).removeClass('nasa-disable');
                
                if (data) {
                    if (data.fragments) {
                        $.each(data.fragments, function(key, value) {
                            if ($(key).length) {
                                $(key).replaceWith(value);
                            }
                        });

                        // $('body').trigger('added_to_cart', [data.fragments, data.cart_hash, _this]);
                        $('body').trigger('wc_fragments_refreshed');
                        // $('body').trigger('wc_fragment_refresh');

                        /**
                         * notification free shipping
                         */
                        $('body').trigger('nasa_init_shipping_free_notification');
                    }

                    /**
                     * mess
                     */
                    if (data.mess) {
                        mini_cart_ext_mess(data.mess);
                    }
                }

                mini_cart_ext_unblock(_wrap);
            },
            complete: function() {
                mini_cart_ext_unblock(_wrap);
            }
        });
    }
});

/**
 * Calculate Shipping Rate
 */
$('body').on('click', '.mini-cart-shipping [name="calc_shipping"]', function(e) {
    e.preventDefault();
    
    var _this = $(this);
    var _wnote = $(_this).parents('.ext-node');
    
    if (!$(_this).hasClass('nasa-disable')) {
        $(_this).addClass('nasa-disable');
    
        var _wrap = $(_this).parents('.nasa-static-sidebar');
        var $form = $(_this).parents('form');

        mini_cart_ext_block(_wrap);
        $(_wnote).removeClass('active');

        $('<input />').attr('type', 'hidden')
            .attr('name', 'calc_shipping')
            .attr('value', 'x')
            .appendTo($form);

        var _data = $form.serialize();

        $.ajax({
            type: 'POST',
            url: mini_cart_ext_url('nasa_mini_cart_calculate_shipping'),
            data: _data,
            dataType: 'json',
            success: function(data) {
                $('#cart-sidebar').find('.woocommerce-error, .woocommerce-message, .woocommerce-info').remove();
                $(_this).removeClass('nasa-disable');

                if (data) {
                    if (data.fragments) {
                        $.each(data.fragments, function(key, value) {
                            if ($(key).length) {
                                $(key).replaceWith(value);
                            }
                        });

                        // $('body').trigger('added_to_cart', [data.fragments, data.cart_hash, _this]);
                        $('body').trigger('wc_fragments_refreshed');
                        // $('body').trigger('wc_fragment_refresh');

                        /**
                         * notification free shipping
                         */
                        $('body').trigger('nasa_init_shipping_free_notification');
                    }

                    /**
                     * mess
                     */
                    if (data.mess) {
                        mini_cart_ext_mess(data.mess);
                    }
                }

                $('body').trigger('mini_cart_mobile_layout_change');

                mini_cart_ext_unblock(_wrap);
            },
            complete: function() {
                mini_cart_ext_unblock(_wrap);
            }
        });
    }
});

/**
 * Refresh nonce code
 */
var ns_ext_now = Date.now();

$('body').on('ns_render_ext_mini_cart_nonce', function() {
    if ($('#cart-sidebar select.country_to_state, #cart-sidebar input.country_to_state').length) {
        $('#cart-sidebar select.country_to_state, #cart-sidebar input.country_to_state').trigger('change');
        $(document.body).trigger('country_to_state_changed'); // Trigger select2 to load.
    }
    
    var ns_now_click = Date.now();
    
    /**
     * Accept with 10 min ago
     */
    if ($('#cart-sidebar .mini-cart-ajax-nonce').length <= 0 && (ns_now_click - ns_ext_now) / 1000 / 60 < 10) {
        $.ajax({
            url: mini_cart_ext_url('nasa_ext_cart_ajax_nonce'),
            type: 'post',
            dataType: 'json',
            cache: false,
            data: {},
            success: function(data) {
                if (data) {
                    if (data.fds) {
                        $('#cart-sidebar').append(data.fds);
                    }

                    if (data.scalc && $('input#woocommerce-shipping-calculator-nonce').length) {
                        $('input#woocommerce-shipping-calculator-nonce').val(data.scalc);
                    }
                }
            },
            complete: function() {
                
            }
        });
    }
});

});

/* End Document Ready */
