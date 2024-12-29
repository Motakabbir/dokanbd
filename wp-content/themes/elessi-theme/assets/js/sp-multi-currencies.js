/**
 * Document Ready !!!
 */
jQuery(document).ready(function($) {
"use strict";
    
/**
 * Multi Currencies
 */
if ($('.nasa-currencies-3rd .nasa-currency-switcher').length) {
    /**
     * For FOX - Currency Switcher Professional for WooCommerce
     */
    if ($('.woocs_auto_switcher').length) {
        var _woocs = $('.woocs_auto_switcher');
        var _clone = '<ul class="nasa-woocs-switcher crr-switcher">';

        var _i = 0;
        $(_woocs).find('.woocs_auto_switcher_link').each(function() {
            var _this = $(this);
            $(_this).attr('data-index', _i);
            _i++;

            if (!$(_this).hasClass('woocs_curr_curr')) {
                var _item = $(_this).parents('li').clone();
                $(_item).find('a').removeClass('woocs_auto_switcher_link');
                $(_item).find('a').addClass('nasa-woocs-switcher-link');
                _clone += '<li>' + $(_item).html() + '</li>';
            }
        });

        _clone += '</ul>';

        var _cur_woocs = $(_woocs).find('.woocs_curr_curr').clone();
        $(_cur_woocs).removeClass('woocs_auto_switcher_link');
        $(_cur_woocs).removeClass('woocs_curr_curr');
        $(_cur_woocs).addClass('nasa-crc nasa-woocs-crc');
        $('.nasa-currencies-3rd').prepend(_cur_woocs);
        $('.nasa-currency-switcher').append(_clone);
        $('.nasa-currency-switcher, .nasa-currencies-3rd').removeClass('hidden-tag');
    }
    
    /**
     * For CURCY - Multi Currency for WooCommerce
     */
    if ($('.wmc-list-currencies').length) {
        var _wmc = $('.wmc-list-currencies');
        var _clone = '<ul class="nasa-wmc-switcher crr-switcher">';
        var _active = '';
        
        $(_wmc).find('.wmc-currency').each(function() {
            var _this = $(this);
            var _item = $(_this).clone();
            
            if (!$(_this).hasClass('wmc-active')) {
                if ($(_item).find('.wmc-currency-symbol').length) {
                    $(_item).find('a').prepend($(_item).find('.wmc-currency-symbol'));
                }
                
                _clone += '<li>' + $(_item).html() + '</li>';
            } else {
                var _html_act = $(_item).html();
                
                if ($(_item).find('.wmc-active-title').length) {
                    $(_item).find('.wmc-active-title').prepend($(_item).find('.wmc-currency-symbol'));
                    
                    _html_act = $(_item).find('.wmc-active-title').html();
                } else {
                    if ($(_item).find('a').length) {
                        _html_act = $(_item).find('a').html();
                    }
                }
                
                _active = '<a href="javascript:void(0);" rel="nofollow" class="wmc-active">' + _html_act + '</a>';
            }
        });
        
        _clone += '</ul>';
        
        $('.nasa-currencies-3rd').prepend(_active);
        $('.nasa-currency-switcher').append(_clone);
        $('.nasa-currency-switcher, .nasa-currencies-3rd').removeClass('hidden-tag');
        
        if ($(_wmc).parents('.woocommerce-multi-currency').length) {
            $(_wmc).parents('.woocommerce-multi-currency').addClass('hidden-tag');
        }
    }
}

/**
 * Trigger For FOX - Currency Switcher Professional for WooCommerce
 */
$('body').on('click', '.nasa-woocs-switcher-link', function(e) {
    var _index = $(this).attr('data-index');
    if ($('.woocs_auto_switcher_link[data-index="' + _index + '"]').length) {
        $('.woocs_auto_switcher_link[data-index="' + _index + '"]').trigger('click');
    }
});

/**
 * Render for Mobile menu
 */
$('body').on('nasa_after_render_currencies_switcher', function(e, _currency) {
    if ($(_currency).find('.nasa-currency-switcher').length) {
        $(_currency).addClass('menu-item-has-children root-item li_accordion');
        $(_currency).find('.nasa-currency-switcher').addClass('nav-dropdown');
    }
    
    e.preventDefault();
});

/**
 * After loaded ajax .nasa-currency-switcher
 */
var _ns_spmtcrc = '';

$('body').on('nasa_before_load_ajax', function() {
    if ($('.nasa-currencies-3rd').length) {
        var _crc = $('.nasa-currencies-3rd').clone();
        _ns_spmtcrc = $(_crc).html();
    }
});

$('body').on('nasa_after_loaded_ajax_complete', function() {
    if ($('.nasa-currencies-3rd').length) {
        $('.nasa-currencies-3rd').html(_ns_spmtcrc);
        $('.nasa-currencies-3rd').removeClass('hidden-tag');
    }
    
    _ns_spmtcrc = '';
});

$('body').on('click', 'a[data-currency]', function() {
    if (typeof _popstate_reload !== 'undefined') {
        _popstate_reload = false;
    }
});

});
