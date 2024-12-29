/**
 * Document nasa-core ready
 */
jQuery(document).ready(function($) {
"use strict";

/**
 * Render
 */
$('body').on('nasa_rendered_template', function() {
    loading_slick_simple_item($);
    loading_slick_extra_vertical_thumbs($);
}).trigger('nasa_rendered_template');

$('body').on('nasa_before_ajax_funcs', function() {
    loading_slick_simple_item($);
    loading_slick_extra_vertical_thumbs($);
});

$('body').on('nasa_refresh_sliders', function() {
    loading_slick_simple_item($, true);
    loading_slick_extra_vertical_thumbs($, true);
});

$('body').on('click', '.nasa-slider-deal-vertical-extra-switcher .item-slick', function() {
    var _wrap = $(this).parents('.nasa-slider-deal-vertical-extra-switcher');
    var _speed = parseInt($(_wrap).attr('data-speed'));
    _speed = !_speed ? 600 : _speed;
    $(_wrap).append('<div class="nasa-slick-fog"></div>');

    setTimeout(function(){
        $(_wrap).find('.nasa-slick-fog').remove();
    }, _speed);
});

$('body').on('ns_slider_has_vertical_inited', function(e, _main, _ext, _settings) {
    var _inMobile = !$('body').hasClass('nasa-in-mobile') && $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
    
    if (!_inMobile) {
        if ($(_ext).length && $(_ext).hasClass('nasa-nav-2-items') && $(_ext).hasClass('slick-initialized')) {
            var _list = $(_ext).find('.slick-list');
            var _h = $(_list).height();
            
            var _items_actived = $(_ext).find('.slick-active');
            var _h_act = 0;
            $(_items_actived).each(function() {
                _h_act += $(this).height();
            });
            
            if (_h_act > _h) {
                $('body').trigger('nasa_unslick', [_ext]);
                $(_ext).slick(_settings);
            }
        }
    }
});
});

/**
 * 
 * Slick Simple item (images - title.dot)
 */
function loading_slick_simple_item($, restart) {
    if ($('.nasa-slick-simple-item').length > 0) {
        var _rtl = $('body').hasClass('nasa-rtl') ? true : false;
        var _restart = typeof restart === 'undefined' ? false : restart;
        
        $('body').trigger('nasa_compatible_jetpack');
        
        $('.nasa-slick-simple-item').each(function(){
            var _this = $(this);
            
            if (_restart) {
                if ($(_this).hasClass('slick-initialized')) {
                    $(_this).removeClass('nasa-inited');
                    $('body').trigger('nasa_unslick', [_this]);
                }
            }
            
            if (!$(_this).hasClass('slick-initialized')) {
                var _autoplay = $(_this).attr('data-autoplay') === 'true' ? true : false,
                    _speed = parseInt($(_this).attr('data-speed')),
                    _delay = parseInt($(_this).attr('data-delay'));

                _speed = !_speed ? 600 : _speed;
                _delay = !_delay ? 3000 : _delay;
                
                var _itemSmall = parseInt($(_this).attr('data-itemSmall')),
                    _itemTablet = parseInt($(_this).attr('data-itemTablet')),
                    _items = parseInt($(_this).attr('data-items'));
                    
                _itemSmall = _itemSmall ? _itemSmall : 1;
                _itemTablet = _itemTablet ? _itemTablet : 1;
                _items = _items ? _items : 1;
                
                var _scroll = parseInt($(_this).attr('data-scroll'));
                _scroll = _scroll ? _scroll : 1;
                
                var _center = $(_this).attr('data-center_mode') === 'true' ? true : false,
                    _centerPadding = _center && $(_this).attr('data-center_padding') ? $(_this).attr('data-center_padding') : '0';
                    
                var _switchTablet = 768;
                var _switchDesktop = 1130;
                
                if ($(_this).attr('data-switch-tablet')) {
                    _switchTablet = parseInt($(_this).attr('data-switch-tablet'));
                }
                
                if ($(_this).attr('data-switch-desktop')) {
                    _switchDesktop = parseInt($(_this).attr('data-switch-desktop'));
                }
                
                var _setting = {
                    rtl: _rtl,
                    slidesToShow: _items,
                    slidesToScroll: _scroll,
                    autoplay: _autoplay,
                    autoplaySpeed: _delay,
                    speed: _speed,
                    arrows: true,
                    infinite: true,
                    pauseOnHover: true,
                    centerMode: _center,
                    focusOnSelect: true,
                    responsive: [{
                        breakpoint: _switchDesktop,
                        settings: {
                            slidesToShow: _itemTablet
                        }
                    }, {
                        breakpoint: _switchTablet,
                        settings: {
                            slidesToShow: _itemSmall
                        }
                    }]
                };
                
                if (_centerPadding !== '0') {
                    _setting.centerPadding = _centerPadding;
                }
                
                $(_this).slick(_setting); // Main
                $(_this).addClass('nasa-inited');
            }
        });
    }
}

/**
 * slick multi slide has extra vertical
 */
function loading_slick_extra_vertical_thumbs($, restart){
    if ($('.nasa-slider-deal-has-vertical').length) {
        var _rtl = $('body').hasClass('nasa-rtl') ? true : false;
        var _restart = typeof restart === 'undefined' ? false : restart;
        
        $('body').trigger('nasa_compatible_jetpack');

        $('.nasa-slider-deal-has-vertical').each(function(){
            var _this = $(this);
            
            if (_restart) {
                if ($(_this).hasClass('slick-initialized')) {
                    $(_this).removeClass('nasa-inited');
                    $('body').trigger('nasa_unslick', [_this]);
                }
            }
            
            if (!$(_this).hasClass('slick-initialized')) {
                var id = $(_this).attr('data-id'),
                    _autoplay = $(_this).attr('data-autoplay') === 'true' ? true : false,
                    _speed = parseInt($(_this).attr('data-speed')),
                    _delay = parseInt($(_this).attr('data-delay')),
                    _nav_item = parseInt($(_this).attr('data-nav_items'));

                _speed = !_speed ? 600 : _speed;
                _delay = !_delay ? 3000 : _delay;
                
                if ($('.nasa-slider-deal-vertical-extra-' + id).hasClass('slick-initialized')) {
                    // $('.nasa-slider-deal-vertical-extra-' + id).slick('unslick');
                    $('body').trigger('nasa_unslick', ['.nasa-slider-deal-vertical-extra-' + id]);
                }

                var _setting = {
                    vertical: true,
                    verticalSwiping: true,
                    slidesToShow: _nav_item,
                    dots: false,
                    arrows: false,
                    autoplay: false,
                    infinite: false
                };

                _setting.asNavFor = '#nasa-slider-slick-' + id;
                _setting.slidesToScroll = 1;
                _setting.centerMode = false;
                _setting.centerPadding = '0';
                _setting.focusOnSelect = true;
                _setting.responsive = [{
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }];

                $(_this).slick({
                    rtl: _rtl,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: _autoplay,
                    autoplaySpeed: _delay,
                    speed: _speed,
                    arrows: true,
                    infinite: false,
                    pauseOnHover: true,
                    asNavFor: '.nasa-slider-deal-vertical-extra-' + id
                });

                $('.nasa-slider-deal-vertical-extra-' + id).slick(_setting);
                $('.nasa-slider-deal-vertical-extra-' + id).attr('data-speed', _speed);
                
                $(_this).addClass('nasa-inited');
                
                if ($('.nasa-slider-deal-vertical-extra-' + id).find('.item-slick').length <= _nav_item) {
                    if (!$('.nasa-slider-deal-vertical-extra-' + id).hasClass('not-full-items')) {
                        $('.nasa-slider-deal-vertical-extra-' + id).addClass('not-full-items');
                    }
                }
                
                $('body').trigger('ns_slider_has_vertical_inited', [_this, '.nasa-slider-deal-vertical-extra-' + id, _setting]);
            }

            if ($('.nasa-slider-deal-has-vertical.nasa-inited').length === $('.nasa-slider-deal-has-vertical').length) {
                $(window).trigger('resize');
            }
        });
    }
}
