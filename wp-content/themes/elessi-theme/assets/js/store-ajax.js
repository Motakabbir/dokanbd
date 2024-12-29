var shop_load = false,
    shop_load_more = false,
    infinitiAjax = false,
    _scroll_to_top = true,
    _popstate_reload = true,
    _queue_trigger = {};

var _close_svg ='<svg class="nasa-close-fillter" width="20px" height="12px" viewBox="0 0 24 24" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M19.207 6.207a1 1 0 0 0-1.414-1.414L12 10.586 6.207 4.793a1 1 0 0 0-1.414 1.414L10.586 12l-5.793 5.793a1 1 0 1 0 1.414 1.414L12 13.414l5.793 5.793a1 1 0 0 0 1.414-1.414L13.414 12l5.793-5.793z" fill="Curentcolor"/></svg>';
    
if (typeof _cookie_live === 'undefined') {
    var _cookie_live = 7;
}

/**
 * Document ready
 */
jQuery(document).ready(function($) {
"use strict";

/**
 * Crazy Loading
 */
if ($('.nasa-crazy-load.crazy-loading').length) {
    $('.nasa-crazy-load.crazy-loading').removeClass('crazy-loading');
}

/**
 * Scroll load more
 */
// var lastScrollTop = 0;
$(window).on('scroll', function() {
    var scrollTop = $(this).scrollTop();
    // var _responsive = $('.nasa-check-reponsive.nasa-switch-check').length && $('.nasa-check-reponsive.nasa-switch-check').width() === 1 ? true : false;
    // var _inMobile = $('body').hasClass('nasa-in-mobile') ? true : false;
    
    if (
        $('#nasa-wrap-archive-loadmore.nasa-infinite-shop').length &&
        $('#nasa-wrap-archive-loadmore.nasa-infinite-shop').find('.nasa-archive-loadmore').length === 1
    ) {
        var infinitiOffset = $('#nasa-wrap-archive-loadmore').offset();
        
        if (!infinitiAjax) {
            if (scrollTop + $(window).height() >= infinitiOffset.top) {
                infinitiAjax = true;
                
                $('#nasa-wrap-archive-loadmore.nasa-infinite-shop').find('.nasa-archive-loadmore').trigger('click');
            }
        }
    }

});

/**
 * Clone group btn for list layout
 */
// clone_group_btns_product_item($);
$('body').on('nasa_store_changed_layout_list', function() {
    if( $('.nasa-content-page-products >.products').hasClass('list')) {
        clone_group_btns_product_item($);

        if ($('.nasa-content-page-products').hasClass('nasa-modern-8')) {
            $('.nasa-content-page-products .product-item').each(function() {
                var _nasa_ct_variable_warp = $(this).find('.nasa-product-content-variable-warp');
                $(this).find('.product-info-wrap .product-des').before(_nasa_ct_variable_warp);
                
            });
        }
    }

}).trigger('nasa_store_changed_layout_list');

/**
 * Top filter actived
 */
$('body').on('nasa_load_actived_top', function() {
    if ($('.nasa-products-page-wrap .nasa-actived-filter').length < 1) {
        $('.nasa-products-page-wrap').prepend('<div class="nasa-actived-filter hidden-tag"></div>');
    }

    var _actived_filter = get_top_filter_actived($);
    if (_actived_filter) {
        $('.nasa-actived-filter').replaceWith(_actived_filter);
    }
}).trigger('nasa_load_actived_top');

/**
 * For updated Price slider
 */
var _first = false;
$('body').on('price_slider_updated', function() {
    if (!_first) {
        _first = true;
        $('body').trigger('nasa_load_actived_top');
    }
});

$('body').on('nasa_after_load_ajax_first', function() {
    /**
     * Topbar Actived filters
     */
    load_active_topbar($);
    
    /**
     * Toggle Sidebar classic
     */
    load_toggle_sidebar_classic($);
    
    /**
     * Clone Group Btn for listview
     */
    clone_group_btns_product_item($);
});

/**
 * Render woocommerce order
 */
$('body').on('nasa_ordering_to_list', function() {
    if ($('.woocommerce-ordering select[name="orderby"]').length) {
        $('.woocommerce-ordering select[name="orderby"]').each(function() {
            var _this = $(this);
            var _val = $(_this).val();
            var _wrap = $(_this).parents('.woocommerce-ordering');
            
            var _clbl = $(_this).find('option[selected]').length ? $(_this).find('option[selected]').html() : $(_this).find('option:first-child').html();
            var _lbl = '<a href="javascript:void(0);" class="nasa-current-orderby nasa-bold-700">' + _clbl + '</a>';
            
            var _sub = '<div class="sub-ordering">';
            
            $(_this).find('option').each(function() {
                var _op = $(this);
                var _class = 'nasa-orderby';
                var _opval = $(_op).attr('value');
                _class += _opval === _val ? ' nasa-active' : '';
                _sub += '<a href="javascript:void(0);" data-value="' + _opval + '" class="' + _class + '">';
                _sub += $(_op).html();
                _sub += '</a>';
            });
            
            _sub += '</div>';
            
            var _output = '<div class="nasa-ordering">' + _lbl + _sub + '</div>';
            $(_this).hide();
            $(_wrap).find('.nasa-ordering').remove();
            $(_this).after(_output);
        });
    }
});

$('body').on('click', '.nasa-orderby', function() {
    var _this = $(this);
    if (!$(_this).hasClass('nasa-active')) {
        var _wrap = $(_this).parents('.woocommerce-ordering'),
            _orders = $(_this).parents('.nasa-ordering'),
            _val = $(_this).attr('data-value'),
            _lbl = $(_this).html();
        
        $(_orders).find('.nasa-orderby.nasa-active').removeClass('nasa-active');
        
        $(_this).addClass('nasa-active');
        
        $(_orders).find('.nasa-current-orderby').html(_lbl);
        
        $(_wrap).find('select[name="orderby"]').val(_val).trigger('change');
        
        $('body').trigger('nasa_close_ordering');
    }
});

/**
 * Reload class for .nasa-top-row-filter a.nasa-tab-filter-topbar
 */
$('body').on('nasa_after_load_ajax', function() {
    if ($('.nasa-push-cat-filter.nasa-push-cat-show').length) {
        var _this = $('.nasa-top-row-filter a.nasa-tab-filter-topbar');
        if ($(_this).length && !$(_this).hasClass('nasa-push-cat-show')) {
            $(_this).addClass('nasa-push-cat-show');
        }
    }
    
    /**
     * Ordering
     */
    if ($('.woocommerce-ordering').length) {
        var _order = $('.woocommerce-ordering').html();
        $('.woocommerce-ordering').replaceWith('<div class="woocommerce-ordering">' + _order + '</div>');
        $('body').trigger('nasa_ordering_to_list');
    }
});

$('body').on('nasa_before_change_view', function() {
    $('body').trigger('nasa_reset_loop_gallery_carousel');
});

$('body').on('nasa_reset_loop_gallery_carousel', function() {
    if ($('.loop-gallery-carousel.inited').length) {
        $('.loop-gallery-carousel.inited').each(function() {
            var _this = $(this);
            var _main = $(_this).find('.main-img');
            $('body').trigger('nasa_unslick', [_main]);
            
            $(_main).removeClass('nasa-slick-slider');
            $(_main).removeClass('nasa-slick-nav');
            $(_main).removeClass('nasa-nav-inside');
            $(_main).removeClass('slick-initialized');
            $(_main).removeClass('slick-slider');
            
            var _img = $(_main).find('img').eq(0).clone();
            $(_main).html('');
            $(_main).append(_img);
            $(_this).removeClass('inited');
        });
    }
});

/**
 * Even change layout
 */
$('body').on('click', '.nasa-change-layout', function() {
    var _this = $(this);
    if ($(_this).hasClass('active')) {
        return false;
    } else {
        change_layout_shop_page($, _this);
    }
});

/**
 * nasa-change-layout modern 8 p-modern-8
 */
// $('body').on('nasa_change_layout_modern_8',function() {
//     var nasa_change_layout = $('body').find('.nasa-change-layout.active');

//     if ($('.nasa-content-page-products').hasClass('nasa-modern-8')) {
        
//         if( $(nasa_change_layout).hasClass('productList')) {
//             $('.nasa-content-page-products').find('.product-warp-item .nasa-product-content-variable-warp .nasa-attr-ux-item-modern-8').each(function() {
//                 $(this).addClass('nasa-attr-ux-item').removeClass('nasa-attr-ux-item-modern-8');
//                 $(this).parents('.product-item').find('.reset_variations').trigger('click');
//             });

//         }else{
//             if( !$('.nasa-content-page-products .products').hasClass('list')) {
//                 $('.nasa-content-page-products').find('.product-warp-item .nasa-product-content-variable-warp .nasa-product-content-child .nasa-attr-ux-item.nasa-active').each(function() {
//                     $(this).trigger('click');
//                 });
//             }

//             $('.nasa-content-page-products').find('.product-warp-item .nasa-attr-ux-item:not(.nasa-attr-ux-select, .nasa-attr-ux-attr_custom)').each(function() {
//                 $(this).addClass('nasa-attr-ux-item-modern-8').removeClass('nasa-attr-ux-item');
//             });

//         }
//     }
// }).trigger('nasa_change_layout_modern_8');

/**
 * Igrone price filter
 */
$('body').on('click', '.nasa-ignore-price-item', function(e) {
    e.preventDefault();
    
    if ($('.reset_price').length) {
        $('.reset_price').trigger('click');
    }
    
    return false;
});

/**
 * Igrone price list filter
 */
$('body').on('click', '.nasa-ignore-price-item-list', function(e) {
    e.preventDefault();
    
    if ($('.nasa-all-price .nasa-filter-by-price-list').length) {
        $('.nasa-all-price .nasa-filter-by-price-list').trigger('click');
    }
    
    return false;
});

/* 
 * custom widget top bar
 * 
 */
init_nasa_top_sidebar($);
$('body').on('click', '.nasa-tab-filter-topbar-categories', function(e) {
    e.preventDefault();
    
    var _this = $(this);
    $('.filter-cat-icon-mobile').trigger('click');

    if ($(_this).attr('data-top_icon') === '0') {
        var _obj = $(_this).attr('data-widget');
        var _wrap_content = $('.nasa-top-sidebar');

        var _act = $(_obj).hasClass('nasa-active') ? true : false;
        $(_this).parents('.nasa-top-row-filter').find('> li').removeClass('nasa-active');
        $(_wrap_content).find('.nasa-widget-wrap').removeClass('nasa-active').slideUp(300);

        if (!_act) {
            $(_obj).addClass('nasa-active').slideDown(300);
            $(_this).parents('li').addClass('nasa-active');
        }
    }

    else {
        $('.site-header').find('.filter-cat-icon').trigger('click');
        if ($('.nasa-header-sticky').length <= 0 || ($('.sticky-wrapper').length && !$('.sticky-wrapper').hasClass('fixed-already'))) {
            $('html, body').animate({scrollTop: 0}, 700);
        }
    }
    
    $('body').trigger('nasa_init_topbar_categories');
});

/**
 * Top sidebar
 */
$('body').on('click', '.nasa-top-row-filter a.nasa-tab-filter-topbar,.nasa-top-bar-3-content a.nasa-tab-filter-topbar', function(e) {
    e.preventDefault();
    var _this = $(this);
    if ($('.nasa-top-bar-3-content').length) {
        var _text_attr = $(_this).attr('data-text'),
            _text = $(_this).text();

        $(_this).html(_text_attr);
        $(_this).attr('data-text', _text);
    }
    top_filter_click($, _this, 'animate');
});

$('body').on('click', 'a.ns-top-3-side-canvas-close', function(e) {
    e.preventDefault();
    $('.nasa-top-bar-3-content a.nasa-tab-filter-topbar').trigger('click');
});

/**
 * Top sidebar type 2
 */
$('body').on('click', '.nasa-toggle-top-bar-click', function(e) {
    e.preventDefault();
    var _this = $(this);
    top_filter_click_2_3($, _this, 'animate');
});

/**
 * Toggle Sidebar classic
 */
load_toggle_sidebar_classic($);
$('body').on('click', '.nasa-toogle-sidebar-classic', function(e) {
    e.preventDefault();
    
    if ($('.nasa-with-sidebar-classic').length) {
        var _this = $(this);
        var _show = $(_this).hasClass('nasa-hide') ? 'show' : 'hide';
        
        /**
         * Set cookie in _cookie_live days
         */
        $.cookie('toggle_sidebar_classic', _show, {expires: _cookie_live, path: '/'});
        
        /**
         * Show sidebar
         */
        if (_show === 'show') {
            $(_this).removeClass('nasa-hide');
            $('.nasa-with-sidebar-classic').removeClass('nasa-with-sidebar-hide');
        }
        
        /**
         * Hide sidebar
         */
        else {
            $(_this).addClass('nasa-hide');
            $('.nasa-with-sidebar-classic').addClass('nasa-with-sidebar-hide');
        }
        
        /**
         * Refresh Carousel
         */
        if (typeof _refresh_carousel !== 'undefined') {
            clearTimeout(_refresh_carousel);
        }
        
        var _refresh_carousel = setTimeout(function() {
            $('body').trigger('nasa_before_refresh_carousel');
            $('body').trigger('nasa_reload_slick_slider');
            $('body').trigger('nasa_refresh_sliders');
        }, 500);
    }
    
    return false;
});

/**
 * Toggle Widget - Show more | Show Less
 */
$('body').on('click', '.nasa-widget-show-more a.nasa-widget-toggle-show', function (e) {
    var _showed = $(this).attr('data-show');
    var _text = '';

    if (_showed === '0') {
        _text = $('input[name="nasa-widget-show-less-text"]').length ? $('input[name="nasa-widget-show-less-text"]').val() : 'Less -';
        $(this).attr('data-show', '1');
        $('.nasa-widget-toggle.nasa-widget-show-less').addClass('nasa-widget-show');
    } else {
        _text = $('input[name="nasa-widget-show-more-text"]').length ? $('input[name="nasa-widget-show-more-text"]').val() : 'More +';
        $(this).attr('data-show', '0');
        $('.nasa-widget-toggle.nasa-widget-show-less').removeClass('nasa-widget-show');
    }

    $(this).html(_text);

    e.preventDefault();
});

/**
 * Filters Ajax Store
 * 
 * @type Number|min
 */
if (
    $('.nasa-widget-store.nasa-price-filter-slide').length &&
    $('.nasa-widget-store.nasa-price-filter-slide').find('.nasa-hide-price').length &&
    !$('.nasa-widget-store.nasa-price-filter-slide').hasClass('hidden-tag')
) {
    $('.nasa-widget-store.nasa-price-filter-slide').addClass('hidden-tag');
}

/**
 * After Load Ajax Complete
 */
$('body').on('nasa_after_loaded_ajax_complete', function() {
    if (
        $('.nasa-widget-store.nasa-price-filter-slide').length &&
        $('.nasa-widget-store.nasa-price-filter-slide').find('.nasa-hide-price').length &&
        !$('.nasa-widget-store.nasa-price-filter-slide').hasClass('hidden-tag')
    ) {
        $('.nasa-widget-store.nasa-price-filter-slide').addClass('hidden-tag');
    }
    
    if ($('.nasa-sort-by-action').length && $('.nasa-sort-by-action select[name="orderby"]').length <= 0) {
        $('.nasa-sort-by-action').addClass('hidden-tag');
    }
    
    /**
     * Compatible with Contact Form 7
     */
    if (typeof wpcf7 !== 'undefined' && $('.wpcf7 > form').length) {
        var _cf7_forms = document.querySelectorAll(".wpcf7 > form");
        if (typeof _cf7_forms.forEach === 'function') {
            _cf7_forms.forEach(function(e) {
                return wpcf7.init(e);
            });
        }
    }
    
    /**
     * Compatible Elementor
     */
    if ($('.elementor-invisible').length) {
        $('.elementor-invisible').removeClass('elementor-invisible');
    }
});

/**
 * Init Filters Shop
 */
$('body').on('nasa_store_filter_ajax', function(e, _url, _this) {
    e.preventDefault();
    nasa_ajax_store($, _url, _this);
});

/**
 * Events Filters Store
 */
if ($('.nasa-has-filter-ajax').length) {
    $('body').on('click',
    '.nasa-pagination a.page-numbers, ' +
    '.nasa-filter-by-tax, ' +
    '.widget_product_categories .cat-item > a:not(.accordion), ' +
    '.product-category .nasa-cat-link, ' +
    '.nasa-filter-by-attrs, ' +
    '.wc-layered-nav-term > a, ' +
    '.nasa-filter-by-price-list, ' +
    '.nasa-filter-status, ' +
    '.nasa-filter-alphabet, ' +
    '.nasa-filter-tag, ' +
    '.nasa-filter-cat, ' +
    '.widget_product_tag_cloud .tag-cloud-link, ' +
    '.nasa-tag-products-cloud .tag-cloud-link, ' +
    '.wc-layered-nav-rating a, ' +
    '.nasa-reset-filters-btn',
    function(e) {
        e.preventDefault();
        
        if (!shop_load) {
            shop_load = true;
            
            var _this = $(this);
            
            if ($(_this).hasClass('nasa-filter-by-attrs')) {
                $(_this).toggleClass('nasa-filter-var-chosen');
            }
            
            if ($(_this).hasClass('nasa-filter-status') || $(_this).hasClass('nasa-filter-tag') || $(_this).hasClass('nasa-filter-cat')) {
                $(_this).toggleClass('nasa-active');
            }

            if ($(_this).hasClass('nasa-filter-alphabet')) {
                $('.nasa-filter-alphabet').removeClass('nasa-active');
                $(_this).toggleClass('nasa-active');
            }
            
            if ($(_this).hasClass('nasa-filter-by-price-list')) {
                $(_this).parent().toggleClass('nasa-active');
            }
            
            if ($(_this).parents('.wc-layered-nav-rating').length) {
                $(_this).parents('.wc-layered-nav-rating').toggleClass('chosen');
            }

            var _url = $(_this).attr('href');
            
            $('body').trigger('nasa_store_filter_ajax', [_url, _this]);
            
        }
        
        return false;
    });
    
    /**
     * Filter by Price Slide
     */
    $('body').on("slidestop", ".price_slider", function(e) {
        e.preventDefault();

        var _this = $(this);
        var _form = $(_this).parents('form');
        
        if ($(_form).find('.nasa-filter-price-btn').length) {
            $(_form).find('.nasa-filter-price-btn').show();
        } else {
            if (!shop_load) {
                shop_load = true;

                var _url = $(_form).attr('action');

                if ($(_form).find('.price_slider_amount input').length) {
                    var patt = /\?/g;
                    var _h = patt.test(_url);

                    $(_form).find('.price_slider_amount input').each(function() {
                        var _get = $(this).attr('name');
                        var _val = $(this).val();

                        _url += _h ? '&' : '?';
                        _url += _get + '=' + _val;

                        _h = true;
                    });
                }

                $('body').trigger('nasa_store_filter_ajax', [_url, _this]);
            }
        }

        return false;
    });
    
    /**
     * Filter by Price button
     */
    $('body').on('click', '.nasa-filter-price-btn', function(e) {
        e.preventDefault();

        if (!shop_load) {
            shop_load = true;

            var _this = $(this);
            var _form = $(_this).parents('form');
            var _url = $(_form).attr('action');
            
            if ($(_form).find('.price_slider_amount input').length) {
                var patt = /\?/g;
                var _h = patt.test(_url);
                
                $(_form).find('.price_slider_amount input').each(function() {
                    var _get = $(this).attr('name');
                    var _val = $(this).val();
                    
                    _url += _h ? '&' : '?';
                    _url += _get + '=' + _val;
                    
                    _h = true;
                });
            }

            $('body').trigger('nasa_store_filter_ajax', [_url, _this]);
        }

        return false;
    });
    
    /**
     * Ordering
     */
    if ($('.woocommerce-ordering').length) {
       var _order = $('.woocommerce-ordering').html();
       $('.woocommerce-ordering').replaceWith('<div class="woocommerce-ordering">' + _order + '</div>');
       $('body').trigger('nasa_ordering_to_list');
    }

    /**
     * ORDER BY
     */
    $('body').on('change', 'select[name="orderby"]', function(e) {
        
        e.preventDefault();

        if (!shop_load) {
            shop_load = true;

            var _this = $(this);
            var _wrap = $(_this).parents('.woocommerce-ordering');
            var _url = $('.nasa-has-filter-ajax input[name="nasa_current-slug"]').val();
            
            var _default = $('.nasa-has-filter-ajax input[name="nasa_default_sort"]').val();
            
            var patt = /\?/g;
            var _h = patt.test(_url);
            
            if (_default !== $(_this).val()) {
                _url += _h ? '&' : '?';
                _url += 'orderby=' + $(_this).val();
                _h = true;
            }
            
            if ($(_wrap).find('input').length) {
                $(_wrap).find('input').each(function() {
                    var _get = $(this).attr('name');
                    if (_get !== 'paged') {
                        var _val = $(this).val();

                        _url += _h ? '&' : '?';
                        _url += _get + '=' + _val;

                        _h = true;
                    }
                });
            }

            _scroll_to_top = true;

            $('body').trigger('nasa_store_filter_ajax', [_url, _this]);
        }

        return false;
    });
    
    /**
     * LOAD MORE
     */
    $('body').on('click', '.nasa-archive-loadmore', function(e) {
        e.preventDefault();
        
        if (!shop_load) {
            shop_load = true;

            var _this = $(this);
            var _wrap = $(_this).parents('.paging-style-loadmore');
            if ($(_wrap).find('.nasa-pagination a.page-numbers.next').length) {
                var _url = $(_wrap).find('.nasa-pagination a.page-numbers.next').attr('href');

                $(_this).addClass('nasa-loading');

                shop_load_more = true;
                _scroll_to_top = false;

                $('body').trigger('nasa_store_filter_ajax', [_url, _this]);
            } else {
                shop_load = false;
            }
        }

        return false;
    });
} else {
    setTimeout(function() {
        $('body').trigger('nasa_ordering_to_list');
    }, 100);
    
    /**
     * For disable ajax shop with price
     */
    $('body').on('slidestop', '.price_slider', function(e) {
        e.preventDefault();

        var _this = $(this);
        var _form = $(_this).parents('form');
        
        if ($(_form).find('.button').length) {
            $(_form).find('.button').show();
        } else {
            var _url = $(_form).attr('action');

            if ($(_form).find('.price_slider_amount input').length) {
                var patt = /\?/g;
                var _h = patt.test(_url);

                $(_form).find('.price_slider_amount input').each(function() {
                    var _get = $(this).attr('name');
                    var _val = $(this).val();

                    _url += _h ? '&' : '?';
                    _url += _get + '=' + _val;

                    _h = true;
                });
            }
            
            window.location.href = _url;
        }
    });
}

/**
 * Reset Price
 */
$('body').on('click', '.reset_price', function(e) {
    e.preventDefault();

    if (!shop_load) {
        shop_load = true;

        var _this = $(this);
        var _form = $(_this).parents('form');
        var _url = $(_form).attr('action');

        if ($(_form).find('.price_slider_amount input').length) {
            var patt = /\?/g;
            var _h = patt.test(_url);

            $(_form).find('.price_slider_amount input').each(function() {
                var _get = $(this).attr('name');

                if (_get !== 'min_price' && _get !== 'max_price') {
                    var _val = $(this).val();

                    _url += _h ? '&' : '?';
                    _url += _get + '=' + _val;

                    _h = true;
                }
            });
        }

        $('body').trigger('nasa_store_filter_ajax', [_url, _this]);
    }

    return false;
});

/**
 * Back url with Ajax Call
 * 
 * @param {type} $
 * @param {type} _url
 * @param {type} _this
 * @returns {undefined}
 */
$(window).on('popstate', function(e) {
    if ($('.nasa-has-filter-ajax').length && _popstate_reload) {
        location.reload(true);
    }
});

/* End Document Ready */
});

/**
 * Filter Ajax
 * 
 * @param {type} $
 * @param {type} _url
 * @param {type} _this
 * @returns {undefined}
 */
function nasa_ajax_store($, _url, _this) {
    if ($('#nasa_base-url').length && $('.nasa-change-layout').length) {
        
        var _url_set = new URL(_url, $('#nasa_base-url').val());
        
        if (typeof _url_set !== 'undefined') {
        
            var _view_c = 'grid-4';
            var _view_l = 'grid-4';
            var _v_col = '4';

            if ($('.nasa-change-layout.df').length) {
                _v_col = $('.nasa-change-layout.df').attr('data-columns');
                _view_c = _v_col > 1 ? 'grid-' + _v_col : (_v_col == 'list-2' ? 'list-2' : 'list');
            }

            if ($('.nasa-change-layout.active').length) {
                _v_col = $('.nasa-change-layout.active').attr('data-columns');
                _view_l = _v_col > 1 ? 'grid-' + _v_col : (_v_col == 'list-2' ? 'list-2' : 'list');
            }

            if (_view_c !== _view_l) {
                _url_set.searchParams.set('view-layout', _view_l);
            } else {
                _url_set.searchParams.delete('view-layout');
            }

            _url = _url_set.href;
        }
    }
    
    if ($('.wcfmmp-product-geolocate-search-form').length) {
        window.location.href = _url;
    }
    
    else {
        var _scroll_loadmore = shop_load_more && $('#nasa-wrap-archive-loadmore').hasClass('nasa-infinite-shop') ? true : false;
        
        var $crazy_load = $('#nasa-ajax-store').length && $('#nasa-ajax-store').hasClass('nasa-crazy-load') && !shop_load_more ? true : false;
        
        var _push_cat_show = $('.nasa-push-cat-filter.nasa-push-cat-show').length ? true : false;
        if (_push_cat_show && $('.nasa-check-reponsive.nasa-mobile-check').length && $('.nasa-check-reponsive.nasa-mobile-check').width()) {
            _push_cat_show = false;
        }
        
        var _pos_top_2 = 0;
        if ($('.nasa-top-sidebar-2.nasa-slick-slider .slick-current').length) {
            _pos_top_2 = $('.nasa-top-sidebar-2.nasa-slick-slider .slick-current').attr('data-slick-index');
        }
        
        /**
         * Encode URL
         */
        _url = _url.replace(/,/g, '%2C');
        
        /**
         * Disable ajax shop
         */
        if ($('.nasa-has-filter-ajax').length <= 0) {
            window.location.href = _url;
        } else {
            $.ajax({
                url: _url,
                type: 'get',
                dataType: 'html',
                data: {},
                cache: true,
                beforeSend: function() {
                    $('body').trigger('nasa_before_load_ajax');

                    if (!$crazy_load) {
                        if (!_scroll_loadmore && !shop_load_more) {
                            $('.nasa-content-page-products').append('<div class="opacity-shop"></div>');
                        } else {
                            if ($('#nasa-wrap-archive-loadmore').length && $('#nasa-wrap-archive-loadmore').find('.nasa-loader').length <= 0) {
                                $('#nasa-wrap-archive-loadmore').append('<div class="nasa-loader"></div>');
                            }
                        }
                    }

                    else {
                        if (!$('#nasa-ajax-store').hasClass('crazy-loading')) {
                            $('#nasa-ajax-store').addClass('crazy-loading');
                        }
                    }

                    if ($('.nasa-progress-bar-load-shop').length === 1) {
                        $('.nasa-progress-bar-load-shop .nasa-progress-per').removeClass('nasa-loaded');
                        $('.nasa-progress-bar-load-shop').addClass('nasa-loading');
                    }

                    if ($('.col-sidebar').length) {
                        $('.col-sidebar').append('<div class="opacity-2"></div>');
                    }
                    
                    if ($('body').hasClass('nasa-mobile-app') || $('.col-sidebar').length) {
                        $('.black-window').trigger('click');
                    }

                    if ($('.nasa-filter-by-tax').length) {
                        $('.nasa-filter-by-tax').addClass('nasa-disable').removeClass('nasa-active');
                    }

                    if ($(_this).parents('ul.children').length) {
                        $(_this).parents('ul.children').show();
                    }

                    var _totop = _scroll_to_top;
                    _scroll_to_top = true;
                    
                    if (_totop && ($('.category-page').length || $('.nasa-content-page-products').length)) {
                        var _pos_obj = $('.category-page').length ? $('.category-page') : $('.nasa-content-page-products');
                        
                        if ($('.top-bar-wrap-type-1').length) {
                            _pos_obj = $('.top-bar-wrap-type-1');
                        }
                        
                        $('body').trigger('nasa_animate_scroll_to_top', [$, _pos_obj, 700]);
                    }
                },
                success: function (res) {
                    var _act_widget = $('.nasa-top-row-filter li.nasa-active > a');

                    var _act_widget_2 = false;
                    if ($('.nasa-toggle-top-bar-click').length) {
                        _act_widget_2 = $('.nasa-toggle-top-bar-click').hasClass('nasa-active') ? true : false;
                    }

                    var $html = $.parseHTML(res);

                    var $mainContent = $('#nasa-ajax-store', $html);
                    
                    /**
                     * 
                     * @type Load Paging
                     */
                    if (!shop_load_more) {
                        if ($('#header-content').length) {
                            /**
                             * Replace Header
                             */
                            var $headContent = $('#header-content', $html);
                            $('#header-content').replaceWith($headContent);
                        } else if ($('#nasa-breadcrumb-site').length) {
                            /**
                             * Replace Breadcrumb
                             */
                            var $breadcrumb = $('#nasa-breadcrumb-site', $html);
                            $('#nasa-breadcrumb-site').replaceWith($breadcrumb);
                        } else if ($('#nasa-breadcrumb-site').length < 1 && $('#header-content').length) {
                            /**
                             * Appent Breadcrumb
                             */
                            var $breadcrumb = $('#nasa-breadcrumb-site', $html);
                            if ($breadcrumb) {
                                $('#header-content').append($breadcrumb);
                            }
                        }

                        /**
                         * Replace Archive
                         */
                        $('#nasa-ajax-store').replaceWith($mainContent);
                        /* if ($('body').hasClass('nasa-mobile-app')) {
                            // nasa-top-sidebar for Mobile App
                            var _append_content = $($mainContent).find('.nasa-content-page-products ul.products').html();
                            var _top_bar = $($mainContent).find('.nasa-top-sidebar-off-canvas');
                            
                            if (!$(_top_bar).hasClass('nasa-show')) {
                                $(_top_bar).addClass('nasa-show');
                            }
                            
                            $('.nasa-top-sidebar').html($(_top_bar).html());
                            
                            $('#nasa-ajax-store').find('.nasa-content-page-products ul.products').html(_append_content);
                        } else {
                            $('#nasa-ajax-store').replaceWith($mainContent);
                        } */

                        /**
                         * Active filter cats
                         */
                        if (_push_cat_show) {
                            if ($('.nasa-has-push-cat').length) {
                                $('.nasa-has-push-cat').addClass('nasa-push-cat-show');
                            }

                            if ($('.nasa-push-cat-filter').length) {
                                $('.nasa-push-cat-filter').addClass('nasa-push-cat-show');
                            }
                        }

                        /**
                         * Replace Footer
                         */
                        if ($('#nasa-footer').length) {
                            var $footContent = $('#nasa-footer', $html);
                            
                            if ($footContent.find('.elementor-toggle').length <= 0) {
                                $('#nasa-footer').replaceWith($footContent);
                            }
                        }

                        if ($('#nasa-mobile-cat-filter').length) {
                            var _top_filter = $('#nasa-mobile-cat-filter', $html);
                            $('#nasa-mobile-cat-filter').replaceWith(_top_filter);
                        }
                    }

                    /**
                     * 
                     * @type Load More
                     */
                    else {
                        _eventMore = true;

                        var _append_content = $($mainContent).find('.nasa-content-page-products ul.products').html();

                        if ($('#nasa-ajax-store').find('.nasa-products-masonry-isotope').length && $('.nasa-products-masonry-isotope ul.products.grid').length) {
                            $('body').trigger('nasa_store_insert_content_isotope', [_append_content]);
                        } else {
                            $('#nasa-ajax-store').find('.nasa-content-page-products ul.products').append(_append_content);
                        }

                        /**
                         * Paging
                         */
                        if ($('#nasa-paging').length) {
                            var _paging = $('#nasa-paging', $html);
                            $('#nasa-paging').replaceWith(_paging);
                        }

                        if ($('.nasa-content-page-products').find('.opacity-shop').length) {
                            $('.nasa-content-page-products').find('.opacity-shop').remove();
                        }

                        if ($('.col-sidebar').length && $('.col-sidebar').find('.opacity-2').length) {
                            $('.col-sidebar').find('.opacity-2').remove();
                        }

                        if ($('.nasa-progress-bar-load-shop').length) {
                            $('.nasa-progress-bar-load-shop').removeClass('nasa-loading');
                        }

                        if ($('#nasa-wrap-archive-loadmore').length && $('#nasa-wrap-archive-loadmore').find('.nasa-loader').length) {
                            $('#nasa-wrap-archive-loadmore').find('.nasa-loader').remove();
                        }
                    }

                    $('.nasa-filter-by-tax').removeClass('nasa-disable');

                    if (shop_load_more && $('.woocommerce-result-count').length) {
                        $('.woocommerce-result-count').html($(res).find('.woocommerce-result-count').html());
                    }

                    /**
                     * Re-build Top Sidebar Type 1
                     */
                    if ($('.nasa-top-sidebar').length && !shop_load_more) {
                        init_nasa_top_sidebar($);

                        if ($(_act_widget).length) {
                            var _old_id = $(_act_widget).attr('data-old_id');
                            if ($('.nasa-top-row-filter li > a[data-old_id="' + _old_id + '"]').length) {
                                var _click = $('.nasa-top-row-filter li > a[data-old_id="' + _old_id + '"]');
                                top_filter_click($, _click, 'showhide');
                            } else {
                                var _key = $(_act_widget).attr('data-key');
                                if ($('.nasa-top-row-filter li > a[data-key="' + _key + '"]').length) {
                                    var _click = $('.nasa-top-row-filter li > a[data-key="' + _key + '"]');
                                    top_filter_click($, _click, 'showhide');
                                }
                            }
                        }
                    }

                    /**
                     * Reload Price Slide
                     */
                    if ($('.price_slider').length && !shop_load_more) {
                        $('body').trigger('init_price_filter');
                    }

                    /**
                     * Re-build Top Sidebar Type 2 Type 3
                     */
                    var top_bar_side =  $('.nasa-top-bar-2-content').length ? $('.nasa-top-sidebar-2') : $('.nasa-top-bar-3-content').length ? $('.nasa-top-sidebar-3') : null;

                    if ($(top_bar_side).length && !shop_load_more) {
                        var top_bar_content =  $('.nasa-top-bar-2-content').length ? $('.nasa-top-bar-2-content') : $('.nasa-top-bar-3-content');
                        if (_act_widget_2) {
                            var _click = $('.nasa-toggle-top-bar-click');
                            $(top_bar_content).hide();
                            top_filter_click_2_3($, _click, 'showhide', _pos_top_2, true);
                        }
                    }

                    /**
                     * Build Actived Filter - not with Topbar type 2
                     */
                    if ($('.nasa-top-sidebar-2').length < 1 && $('.nasa-top-sidebar-3').length < 1 && $('.nasa-products-page-wrap').length) {
                        $('body').trigger('nasa_load_actived_top');
                    }

                    var _destroy_masonry = false;
                    $('body').trigger('nasa_after_loaded_ajax_complete', [_destroy_masonry, shop_load_more]);

                    shop_load = false;
                    shop_load_more = false;
                    infinitiAjax = false;

                    /**
                     * Run _queue_trigger
                     */
                    $('body').trigger('nasa_after_shop_load_status', [_queue_trigger]);

                    /**
                     * 
                     * Title Page
                     */
                    var matches = res.match(/<title>(.*?)<\/title>/);
                    var _title = typeof matches[1] !== 'undefined' ? matches[1] : '';
                    if (_title) {
                        $('title').html(_title);
                    }

                    $('#nasa-ajax-store').removeClass('crazy-loading');

                    /**
                     * Fix lazy load
                     */
                    setTimeout(function() {
                        if ($('img[data-lazy-src]').length) {
                            $('img[data-lazy-src]').each(function() {
                                var _this = $(this);
                                var _src_real = $(_this).attr('data-lazy-src');
                                var _srcset = $(_this).attr('data-lazy-srcset');
                                var _size = $(_this).attr('data-lazy-sizes');
                                $(_this).attr('src', _src_real);
                                $(_this).removeAttr('data-lazy-src');

                                if (_srcset) {
                                    $(_this).attr('srcset', _srcset);
                                    $(_this).removeAttr('data-lazy-srcset');
                                }

                                if (_size) {
                                    $(_this).attr('sizes', _size);
                                    $(_this).removeAttr('data-lazy-sizes');
                                }
                            });
                        }
                    }, 100);
                },
                error: function () {
                    $('.opacity-2').remove();
                    $('.nasa-filter-by-tax').removeClass('nasa-disable');
                    $('#nasa-ajax-store').removeClass('crazy-loading');

                    shop_load = false;
                    shop_load_more = false;
                    infinitiAjax = false;
                }
            });

            if (!shop_load_more) {
                window.history.pushState(_url, '', _url);
            }
        }
    }
}

/**
 * _act_content
 * @param {type} $
 * @returns {String}
 */
function get_top_filter_actived($) {
    var _act_content = '<div class="nasa-actived-filter">';
    var _hasActive = false;
    
    if ($('.nasa-widget-has-active, .widget_rating_filter, .widget_price_filter, .widget_layered_nav').length) {
        $('.nasa-widget-has-active, .widget_rating_filter, .widget_price_filter, .widget_layered_nav').each(function() {
            var _this = $(this);
            var _title = $(_this).find('.widget-title').length ? $(_this).find('.widget-title').html() : '';
            
            /**
             * Attributes
             */
            var _widget_act = $(_this).find('.nasa-filter-var-chosen').length ? true : false;
            if (_widget_act) {
                _hasActive = true;
                
                _act_content += '<div class="nasa-wrap-active-top">';
                _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                
                $(_this).find('.nasa-filter-var-chosen').each(function() {
                    var _href = $(this).attr('href');
                    var _class_item = 'nasa-ignore-variation-item nasa-filter-by-attrs';
                    
                    _class_item += $(this).hasClass('nasa-filter-color') ? ' nasa-ignore-color-item' : '';
                    _class_item += $(this).hasClass('nasa-filter-image') ? ' nasa-ignore-image-item' : '';
                    _class_item += $(this).hasClass('nasa-filter-brand-item') ? ' nasa-ignore-brand-item' : '';
                    
                    var _item = '<a href="' + _href + '" class="' + _class_item + '">' + _close_svg + $(this).html() + '</a>';
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';
                });
                
                _act_content += '</div>';
            }
            
            /**
             * Attributes Default
             */
            var _df_act = $(_this).find('.woocommerce-widget-layered-nav-list__item--chosen').length ? true : false;
            if (_df_act) {
                _hasActive = true;
                
                _act_content += '<div class="nasa-wrap-active-top">';
                _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                
                $(_this).find('.woocommerce-widget-layered-nav-list__item--chosen').each(function() {
                    var _href = $(this).find('a').attr('href');
                    var _class_item = 'nasa-ignore-variation-item nasa-filter-by-attrs';
                    var _text = '<span class="nasa-text-variation">' + $(this).find('a').html() + '</span>';
                    _text += $(this).find('.count').length ? '<span class="count wc-df">' + $(this).find('.count').html() + '</span>' : '';
                    
                    var _item = '<a href="' + _href + '" class="' + _class_item + '">' + _close_svg + _text + '</a>';
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';
                });
                
                _act_content += '</div>';
            }
            
            /**
             * Filter Status
             */
            var _filter_act = $(_this).find('.nasa-filter-status.nasa-active').length ? true : false;
            if (_filter_act) {
                _hasActive = true;

                _act_content += '<div class="nasa-wrap-active-top">';
                _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                
                $(_this).find('.nasa-filter-status.nasa-active').each(function() {
                    var _href = $(this).attr('href');
                    var _data_filter = $(this).attr('data-filter');
                    
                    var _item = '<a href="' + _href + '" class="nasa-ignore-filter-global nasa-filter-status nasa-ignore-filter-status" data-filter="' + _data_filter + '">' + _close_svg + $(this).html() + '</a>';
                    
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';
                });

                _act_content += '</div>';
            }

            /**
             * Filter Alphabet
             */
            var _filter_alp = $(_this).find('.nasa-filter-alphabet.nasa-active').length ? true : false;
            if (_filter_alp) {
                _hasActive = true;

                _act_content += '<div class="nasa-wrap-active-top">';
                _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                
                $(_this).find('.nasa-filter-alphabet.nasa-active').each(function() {
                    var _href = $(this).attr('href');
                    var _data_filter = $(this).attr('data-filter');
                    
                    var _item = '<a href="' + _href + '" class="nasa-ignore-filter-global nasa-filter-alphabet nasa-ignore-filter-alphabet" data-filter="' + _data_filter + '">' + _close_svg + $(this).html() + '</a>';
                    
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';
                });

                _act_content += '</div>';
            }
            
            /**
             * Nasa Price Slide
             */
            if ($(_this).find('.reset_price[data-filtered="1"]').length) {
                _hasActive = true;
                
                var _price_label = '';
                
                if ($(_this).find('.price_label .from').length) {
                    _price_label += '<span class="from">' + $(_this).find('.price_label .from').html() + '</span>';
                }
                
                if ($(_this).find('.price_label .to').length) {
                    _price_label += _price_label !== '' ? ' &mdash; ' : '';
                    _price_label += '<span class="to">' + $(_this).find('.price_label .to').html() + '</span>';
                }
                
                var _class_price = _price_label !== '' ? 'nasa-wrap-active-top' : 'nasa-price-active-init hidden-tag';
                _act_content += '<div class="' + _class_price + '">';
                
                if (_price_label !== '') {
                    _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                    var _item = '<a href="javascript:void(0);" class="nasa-ignore-price-item">' + _close_svg + _price_label + '</a>';
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';
                }
                
                _act_content += '</div>';
            }
            
            /**
             * Filter List
             */
            if ($(_this).find('.nasa-price-filter-list .nasa-active').length) {
                
                var _active_price_list = $(_this).find('.nasa-price-filter-list .nasa-active');
                
                if (!$(_active_price_list).hasClass('nasa-all-price')) {
                    _hasActive = true;

                    _act_content += '<div class="nasa-wrap-active-top">';

                    var _price_label = $(_this).find('.nasa-price-filter-list .nasa-active').find('.nasa-filter-price-text').html();

                    _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';

                    var _item = '<a href="javascript:void(0);" class="nasa-ignore-price-item-list">' + _close_svg + _price_label + '</a>';
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';

                    _act_content += '</div>';
                }
            }
            
            /**
             * Filter Tags
             */
            if ($(_this).find('.nasa-filter-tag.nasa-active').length) {
                _hasActive = true;

                _act_content += '<div class="nasa-wrap-active-top">';
                _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                
                $(_this).find('.nasa-filter-tag.nasa-active').each(function() {
                    var _href = $(this).attr('href');
                    var _data_filter = $(this).attr('data-filter');
                    
                    var _item = '<a href="' + _href + '" class="nasa-ignore-filter-global nasa-filter-tag nasa-ignore-filter-tags" data-filter="' + _data_filter + '">' + _close_svg + $(this).html() + '</a>';
                    
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';
                });

                _act_content += '</div>';
            }

            /**
             * Filter Multi Cat
             */
            if ($(_this).find('.nasa-filter-cat.nasa-active').length) {
                _hasActive = true;

                _act_content += '<div class="nasa-wrap-active-top">';
                _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                
                $(_this).find('.nasa-filter-cat.nasa-active').each(function() {
                    var _href = $(this).attr('href');
                    var _data_filter = $(this).attr('data-filter');
                    
                    var _item = '<a href="' + _href + '" class="nasa-ignore-filter-global nasa-filter-cat nasa-ignore-filter-cats" data-filter="' + _data_filter + '">' + _close_svg + $(this).html() + '</a>';
                    
                    _act_content += '<span class="nasa-active-item">' + _item + '</span>';
                });

                _act_content += '</div>';
            }
            
            /**
             * Filter Rating
             */
            if ($(_this).find('.wc-layered-nav-rating.chosen').length) {
                _hasActive = true;

                _act_content += '<div class=" 7">';
                _act_content += _title ? '<span class="nasa-active-title">' + _title + '</span>' : '';
                
                $(_this).find('.wc-layered-nav-rating.chosen').each(function() {
                    var _this = $(this).find('a');
                    var _href = $(_this).attr('href');
                    
                    var _item = '<a href="' + _href + '" class="nasa-ignore-filter-global nasa-filter-rating nasa-ignore-filter-rating">' + $(_this).html() + '</a>';
                    
                    _act_content += '<span class="wc-layered-nav-rating nasa-active-item">' + _item + '</span>';
                });

                _act_content += '</div>';
            }
        });
    }
    
    // Reset btn
    if (_hasActive && $('.nasa-widget-has-active .nasa-reset-filters-btn').length) {
        _act_content += '<div class="nasa-wrap-active-top">';
        
        $('.nasa-widget-has-active .nasa-reset-filters-btn').addClass('nasa-reset-filters-top');
        $('.nasa-widget-has-active .nasa-reset-filters-btn').wrap('<div class="nasa-reset-filters-btn-wrap"></div>');
        
        var _reset_text = $('.nasa-widget-has-active .nasa-reset-filters-btn-wrap').html();
        _act_content += _reset_text;
        _act_content += '</div>';
    }
    
    _act_content += '</div>';
    
    return _hasActive ? _act_content : '';
}

/**
 * Check have items active filter topbar type 1
 * @param {type} $
 * @param {type} _widget
 * @returns {Boolean}
 */
function active_topbar_check($, _widget) {
    if (
        $(_widget).find('.nasa-act-filter-item').length ||
        $(_widget).find('.nasa-filter-var-chosen').length ||
        $(_widget).find('.nasa-filter-status.nasa-active').length ||
        $(_widget).find('.nasa-filter-alphabet.nasa-active').length ||
        $(_widget).find('.nasa-price-filter-list .nasa-active').length ||
        $(_widget).find('.nasa-filter-tag.nasa-active').length ||
        ($(_widget).find('input[name="nasa_hasPrice"]').length && $(_widget).find('input[name="nasa_hasPrice"]').val() === '1')
    ) {
        return true;
    }
    
    return false;
}

/**
 * Active Topbar
 * @param {type} $
 * @returns {undefined}
 */
function load_active_topbar($) {
    if ($('.nasa-tab-filter-topbar').length) {
        $('.nasa-tab-filter-topbar').each(function() {
            var _this = $(this);
            var _widget = $(_this).attr('data-widget');
            if ($(_widget).length) {
                if (active_topbar_check($, _widget)) {
                    if (!$(_this).hasClass('nasa-active')) {
                        $(_this).addClass('nasa-active');
                    }
                } else {
                    $(_this).removeClass('nasa-active');
                }
            }
        });
    }
    
    $('.nasa-tranparent-filter').trigger('click');
    $('.transparent-mobile').trigger('click');
}

/**
 * Toggle Sidebar classic
 * @param {type} $
 * @returns {undefined}
 */
function load_toggle_sidebar_classic($) {
    if ($('.nasa-with-sidebar-classic').length && $('.nasa-toogle-sidebar-classic').length) {
        var toggle_show = $.cookie('toggle_sidebar_classic');
        if (toggle_show === 'hide') {
            $('.nasa-toogle-sidebar-classic').addClass('nasa-hide');
            $('.nasa-with-sidebar-classic').addClass('nasa-with-sidebar-hide');
        } else {
            $('.nasa-toogle-sidebar-classic').removeClass('nasa-hide');
            $('.nasa-with-sidebar-classic').removeClass('nasa-with-sidebar-hide');
        }

        setTimeout(function() {
            $('body').trigger('nasa_after_toggle_sidebar_classic_timeout');
        }, 500);
    }
    
    if ($('.nasa-with-sidebar-classic').length && !$('.nasa-with-sidebar-classic').hasClass('nasa-inited')) {
        $('.nasa-with-sidebar-classic').addClass('nasa-inited');
    }
}

/**
 * Render top bar shop page
 * 
 * @param {type} $
 * @returns {undefined}
 */
function init_nasa_top_sidebar($) {
    if ($('.nasa-top-sidebar').length) {
        
        $('body').trigger('before_init_nasa_topsidebar');
        
        var wk = 0;

        var top_row = '<ul class="nasa-top-row-filter">';

        if ($('input[name="nasa-labels-filter-text"]').length && $('input[name="nasa-labels-filter-text"]').val() !== '') {
            top_row += '<li><span class="nasa-labels-filter-text">' + $('input[name="nasa-labels-filter-text"]').val() + '</span></li>';
        }

        var rows = '';
        
        if ($('.nasa-top-sidebar').find('.nasa-close-sidebar-wrap').length) {
            rows += $('.nasa-top-sidebar').find('.nasa-close-sidebar-wrap').html();
        }
        
        rows += '<div class="row nasa-show nasa-top-sidebar-off-canvas">';
        
        var _title, _rss;
        var _stt = 1;
        var _limit = $('input[name="nasa-limit-widgets-show-more"]').length ? parseInt($('input[name="nasa-limit-widgets-show-more"]').val()) : false;
        _limit = (!_limit || _limit < 0) ? 999999 : _limit;
        
        var _show_more = false;
        var _pcat_off = $('input[name="ns-pcat-off"]').length && $('input[name="ns-pcat-off"]').val() === '1' ? true : false; 
        
        $('.nasa-top-sidebar').find('>.widget').each(function() {
            var _this = $(this);
            
            var _widget_act = active_topbar_check($, _this);

            var _class_act = _widget_act ? ' nasa-active' : '';
            
            if ($(_this).find('.widget-title').length) {
                _title = $(_this).find('.widget-title').html();
                _rss = '';
                if ($(_this).find('.widget-title').find('a').length) {
                    _title = '';
                    $(_this).find('.widget-title').find('a').each(function() {
                        if ($(this).find('img').length) {
                            _rss += $(this).html();
                        } else {
                            _title += $(this).html();
                        }
                    });
                }
            } else {
                _title = '...';
            }

            var _widget_key = 'nasa-widget-key-' + wk.toString();
            var _old_id = $(_this).attr('id');
            var _class_row = '';
            var _filter_push_cat = false;

            var _li_class = _stt <= _limit ? ' nasa-widget-show' : ' nasa-widget-show-less';

            if ($(_this).find('.nasa-widget-filter-cats-topbar').length) {
                if ($('.nasa-push-cat-filter').length === 1) {
                    _filter_push_cat = true;
                    _class_act += ' nasa-tab-push-cats';
                    _li_class += ' nasa-widget-categories';
                    $('.nasa-push-cat-filter').html($(_this).wrap('<div>').parent().html());
                } else {
                    _class_act += ' nasa-tab-filter-cats';
                    _class_row += ' nasa-widget-cat-wrap';
                }
            }

            var _icon_before = _filter_push_cat ? '<svg class="ns-push-open" width="16" height="24" viewBox="0 2 25 32" fill="currentColor"><path d="M6.294 14.164h12.588v1.049h-12.588v-1.049z"/><path d="M6.294 18.36h12.588v1.049h-12.588v-1.049z"/><path d="M6.294 22.557h8.392v1.049h-8.392v-1.049z"/><path d="M15.688 3.674c-0.25-1.488-1.541-2.623-3.1-2.623s-2.85 1.135-3.1 2.623h-9.489v27.275h25.176v-27.275h-9.488zM10.49 6.082v-1.884c0-1.157 0.941-2.098 2.098-2.098s2.098 0.941 2.098 2.098v1.884l0.531 0.302c1.030 0.586 1.82 1.477 2.273 2.535h-9.803c0.453-1.058 1.243-1.949 2.273-2.535l0.53-0.302zM24.128 29.9h-23.078v-25.177h8.392v0.749c-1.638 0.932-2.824 2.566-3.147 4.496h12.588c-0.322-1.93-1.509-3.563-3.147-4.496v-0.749h8.392v25.177z"/></svg><svg class="ns-push-close hidden-tag" width="16" height="24" viewBox="7 7 18 18" fill="currentColor"><path d="M10.722 9.969l-0.754 0.754 5.278 5.278-5.253 5.253 0.754 0.754 5.253-5.253 5.253 5.253 0.754-0.754-5.253-5.253 5.278-5.278-0.754-0.754-5.278 5.278z"/></svg>' : '';
            var _icon_after = !_filter_push_cat ? '<svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M15.233 19.175l0.754 0.754 6.035-6.035-0.754-0.754-5.281 5.281-5.256-5.256-0.754 0.754 3.013 3.013z" /></svg>' : '';

            var _reset_btn = $(_this).find('.nasa-reset-filters-btn').length ? true : false;
            if (_reset_btn) {
                _li_class += ' nasa-widget-reset-filter nasa-widget-has-active';
                _stt = _stt-1;
            }

            top_row += '<li class="nasa-widget-toggle' + _li_class + '">';
            if (!_reset_btn) {
                top_row += '<a class="nasa-tab-filter-topbar' + _class_act + '" href="javascript:void(0);" title="' + _title + '" data-widget="#' + _widget_key + '" data-key="' + wk + '" data-old_id="' + _old_id + '">' + _icon_before + _rss + _title + _icon_after + '</a>';
            }
            else {
                top_row += $(_this).find('.nasa-reset-filters-btn').wrap('<div>').parent().html();
            }
            top_row += '</li>';

            if ($(_this).find('.nasa-reset-filters-btn').length <= 0) {
                if (!_filter_push_cat || _filter_push_cat && _pcat_off) {
                    rows += '<div class="large-12 columns nasa-widget-wrap' + _class_row + '" id="' + _widget_key + '" data-old_id="' + _old_id + '">';
                    rows += $(_this).wrap('<div>').parent().html();
                    rows += '</div>';
                }
            }

            if (_stt > _limit) {
                _show_more = true;
            }

            wk++;
            _stt++;
        });

        if (_show_more) {
            top_row += '<li class="nasa-widget-show-more">';
            top_row += '<a class="nasa-widget-toggle-show" href="javascript:void(0);" data-show="0">' + $('input[name="nasa-widget-show-more-text"]').val() + '</a>';
            top_row += '</li>';
        }

        if ($('.showing_info_top').length) {
            top_row += '<li class="last">';
            top_row += '<div class="showing_info_top">';
            top_row += $('.showing_info_top').html();
            top_row += '</div></li>';
        }

        top_row += '</ul>';
        rows += '</div>';
        
        $('.nasa-top-sidebar').html(rows).removeClass('hidden-tag');
        $('.nasa-labels-filter-accordion').html(top_row);
        $('.nasa-labels-filter-accordion').addClass('nasa-inited');

        /**
         * Show | Hide price filter
         */
        if ($('.nasa-top-sidebar .nasa-filter-price-widget-wrap').length) {
            $('.nasa-top-sidebar .nasa-filter-price-widget-wrap').each(function() {
                var _wrap_price_hide = $(this).parents('.nasa-widget-wrap');
                
                if ($(this).hasClass('nasa-hide-price')) {
                    if ($(_wrap_price_hide).length) {
                        var _tabtop = $(_wrap_price_hide).attr('id');
                        if ($('.nasa-tab-filter-topbar[data-widget="#' + _tabtop + '"]').parents('.nasa-widget-toggle').length) {
                            $('.nasa-tab-filter-topbar[data-widget="#' + _tabtop + '"]').parents('.nasa-widget-toggle').hide();
                        }
                        
                        $(_wrap_price_hide).addClass('hidden-tag');
                    }
                }
            });
        }
        
        if ($('.nasa-top-sidebar .nasa-top-sidebar-off-canvas').length && $('.nasa-top-sidebar .nasa-top-sidebar-off-canvas > *').length <= 0 && $('.nasa-in-mobile .top-bar-wrap-type-1 .toggle-topbar-shop-mobile').length) {
            $('.nasa-in-mobile .top-bar-wrap-type-1 .toggle-topbar-shop-mobile').hide();
        }
    }
}

/**
 * Click top filter
 * 
 * @param {type} $
 * @param {type} _this
 * @param {type} type
 * @returns {undefined}
 */
function top_filter_click($, _this, type) {
    if (!$(_this).hasClass('nasa-tab-push-cats')) {
        var _obj = $(_this).attr('data-widget');
        var _wrap_content = $('.nasa-top-sidebar');

        var _act = $(_obj).hasClass('nasa-active') ? true : false;
        $(_this).parents('.nasa-top-row-filter').find('> li').removeClass('nasa-active');
        $(_wrap_content).find('.nasa-widget-wrap').removeClass('nasa-active').slideUp(350);
        if (type === 'animate') {
            $(_wrap_content).find('.nasa-widget-wrap').removeClass('nasa-active').slideUp(350);
        } else {
            $(_wrap_content).find('.nasa-widget-wrap').removeClass('nasa-active').hide();
        }

        if (!_act) {
            if (type === 'animate') {
                $(_obj).addClass('nasa-active').slideDown(350);
            } else {
                $(_obj).addClass('nasa-active').show();
            }
            $(_this).parents('li').addClass('nasa-active');
        }

        if ($(_this).hasClass('nasa-tab-filter-cats')) {
            $('body').trigger('nasa_init_topbar_categories');
        }
    }
    
    else {
        if (!$('.nasa-push-cat-filter').hasClass('ns-top-bar-side-canvas')) {
            var _loop_gallery   = $('.nasa-products-page-wrap').find('.loop-gallery-carousel.inited');
            var _main_img       = $(_loop_gallery).find('.main-img')
    
            // if ($(_this).parents('.nasa-top-sidebar-3').length && !$(_this).hasClass('nasa-push-cat-show')) {
            //     var _pos_obj = $('.nasa-push-cat-filter ').length ? $('.nasa-push-cat-filter ') : $('.nasa-archive-product-content');
            //     $('body').trigger('nasa_animate_scroll_to_top', [$, _pos_obj, 900]);
            // }
    
            if ($('.nasa-products-page-wrap').find('.loop-gallery-carousel.inited').length) {
                $('.loop-gallery-carousel.inited').each(function() {
                    var _slide = $(this).find('.slick-initialized');
                    
                    if ($(_slide).length) {
                        $('body').trigger('nasa_unslick', [_slide]);
                    }
                });
            }
    
            $( _main_img).attr('class', 'main-img');
            
            $( _main_img).each(function() {
                var attributes = $.map(this.attributes, function(item) {
                    return item.name;
                });
                
                var img = $(this);
    
                $(this).find('img:not(.attachment-woocommerce_thumbnail)').remove();
    
                $.each(attributes, function(i, item) {
                    if(item !== 'class') {
                        img.removeAttr(item);
                    }
                });
            });
            
            $(_loop_gallery).removeClass('inited');

            $(_this).toggleClass('nasa-push-cat-show');
            $('.nasa-products-page-wrap').toggleClass('nasa-push-cat-show');
            $('.black-window-mobile').toggleClass('nasa-push-cat-show');

        } else {
            if ($('#wpadminbar').length) {
                var height_adminbar = $('#wpadminbar').height();
        
                $('.nasa-push-cat-filter.ns-top-bar-side-canvas').css({'top': height_adminbar});
            }
            
            if (!$('.nasa-push-cat-filter').hasClass('nasa-push-cat-show')) {
                $('.black-window').fadeIn(400).addClass('desk-window');
            } else {
                $('.black-window').fadeOut(400).removeClass('desk-window');
            }
        }

        $('.nasa-push-cat-filter').toggleClass('nasa-push-cat-show');
        
        setTimeout(function() {
            $('body').trigger('nasa_after_push_cats_timeout');
        }, 1000);
    }
}

/**
 * Render top bar 2 shop page
 * 
 * @param {type} $
 * @param {type} _start
 * @returns {undefined}
 */
function init_nasa_top_sidebar_2($, _start) {
    var start = typeof _start !== 'undefined' && _start ? _start : false;
    
    if ($('.nasa-top-sidebar-2').length) {
        var _wrap = $('.nasa-top-sidebar-2');
        
        if (!$(_wrap).hasClass('nasa-slick-slider')) {
            $(_wrap).addClass('nasa-slick-slider');
            $(_wrap).addClass('nasa-slick-nav');
        }
        
        $(_wrap).attr('data-autoplay', 'false');
        $(_wrap).attr('data-switch-custom', '480');
        
        var _width = $(window).width();
        var _tab = parseInt($(_wrap).attr('data-switch-tablet'));
        var _desk = parseInt($(_wrap).attr('data-switch-desktop'));
        _tab = !_tab ? 768 : _tab;
        _desk = !_desk ? 1130 : _desk;
        
        var _cols = parseInt($(_wrap).attr('data-columns'));
        var _cols_tab = parseInt($(_wrap).attr('data-columns-tablet'));
        var _cols_small = parseInt($(_wrap).attr('data-columns-small'));
        
        _cols = !_cols ? 4 : _cols;
        _cols_tab = !_cols_tab ? 3 : _cols_tab;
        _cols_small = !_cols_small ? 2 : _cols_small;
        
        var _count = $(_wrap).find('.nasa-widget-store').length;
        
        /**
         * Check start in Desktop
         */
        if (_width >= _desk && _count <= _cols) {
            start = 0;
        }
        
        /**
         * Check start in Tablet
         */
        if (_width < _desk && _width >= _cols_tab && _count <= _cols_tab) {
            start = 0;
        }
        
        /**
         * Check start in Mobile
         */
        if (_width < _cols_tab && _count <= _cols_small) {
            start = 0;
        }
        
        /**
         * Set start
         */
        if (start) {
            $(_wrap).attr('data-start', start);
        }
        
        /**
         * init Slick Slider
         */
        $('body').trigger('nasa_load_slick_slider');
        
        if (!$(_wrap).hasClass('nasa-inited')) {
            $(_wrap).addClass('nasa-inited');
        }
    }
}

/**
 * Toggle Top Side bar type 2
 * 
 * @param {type} $
 * @param {type} _this
 * @param {type} type
 * @param {type} _start
 * @param {type} _active_top
 * @returns {undefined}
 */
function top_filter_click_2_3($, _this, type, _start, _active_top) {

    var top_bar_content =  $('.nasa-top-bar-2-content').length ? $('.nasa-top-bar-2-content') : $('.nasa-top-bar-3-content');
    var top_bar_side =  $('.nasa-top-bar-2-content').length ? $('.nasa-top-sidebar-2') : $('.nasa-top-sidebar-3');

    if ($(top_bar_content).length) {
        if (typeof _active_top !== 'undefined' && _active_top) {
            $('body').trigger('nasa_load_actived_top');
        }
        
        var _act = $(_this).hasClass('nasa-active') ? true : false;
        
        if (!_act) {
            var start = typeof _start !== 'undefined' && _start ? _start : false;
            var _cat_wrap = $(top_bar_side).find('.widget_product_categories');
            var _cat_side = $('.nasa-push-cat-filter').find('.widget_product_categories');
            
            if ($(_cat_wrap).length && $(top_bar_side).hasClass('nasa-top-sidebar-3') && $(_cat_side).length <= 0) {
                $('.nasa-push-cat-filter').html($(_cat_wrap).clone()).find('.widget_product_categories').removeAttr('id');
                $(_cat_wrap).find($('.nasa-product-categories-widget')).remove();
                $('.nasa-push-cat-filter').find('.nasa-tab-filter-topbar').html('<svg width="45" height="45" version="1.1" width="32" height="32" viewBox="0 0 32 32"><path d="M12.792 15.233l-0.754 0.754 6.035 6.035 0.754-0.754-5.281-5.281 5.256-5.256-0.754-0.754-3.013 3.013z" fill="currentColor"/></svg>').removeAttr('data-text').addClass('ns-top-3-side-canvas-close');

                $('.nasa-push-cat-filter').prepend($('.nasa-push-cat-filter .nasa-tab-filter-topbar'));
            }
            
            if (type === 'animate') {
                init_nasa_top_sidebar_2($, start);
                $(top_bar_content).addClass('nasa-active').slideDown(350);
                
                setTimeout(function() {
                    if ($('.nasa-top-sidebar-2').find('.slick-slide.slick-current').length && $('.nasa-top-sidebar-2').find('.slick-slide.slick-current').width() === 0) {
                        var _top_slide = $('.nasa-top-sidebar-2');
                        $('body').trigger('nasa_refresh_slick', [_top_slide]);
                    }
                }, 350);
            }
            
            else {
                $(top_bar_content).addClass('nasa-active').show();
                
                init_nasa_top_sidebar_2($, start);
                
                if (!$(top_bar_side).hasClass('nasa-transition-none')) {
                    $(top_bar_side).addClass('nasa-transition-none');
                }
                
                if (!$(top_bar_side).hasClass('nasa-inited')) {
                    $(top_bar_side).addClass('nasa-inited');
                }
                
                setTimeout(function() {
                    $(top_bar_side).removeClass('nasa-transition-none');
                }, 200);
            }
                
            $(_this).addClass('nasa-active');
        }
        
        else {
            $(top_bar_content).slideUp(350);
            $(_this).removeClass('nasa-active');
        }
    }
}


/**
 * Change layout Grid | List shop page
 * 
 * @param {type} $
 * @param {type} _this
 * @returns {undefined}
 */
function change_layout_shop_page($, _this) {
    var value_view, item_row, class_items,class_list;
    
    var _url = new URL(window.location.href);
    
    var _destroy = false;
    
    if ($(_this).hasClass('productList')) {
        value_view = $(_this).hasClass('list-2') ?'list-2':'list';
        _destroy = true;
        class_list = $(_this).hasClass('list-2') ?'list-2 list':'list';

        $('.nasa-content-page-products .products').removeClass('grid list-2').addClass(class_list);

        $('body').trigger('nasa_store_changed_layout_list');

        if ($(_this).parents('.nasa-change-view-mobile').length) {
            if (!$('.nasa-store-page').hasClass('nasa-mobile-store-in-list')) {
                $('.nasa-store-page').addClass('nasa-mobile-store-in-list');
            }
        }

    } else {
        var columns = $(_this).attr('data-columns');
        class_items = 'products grid';

        if ($(_this).parents('.nasa-change-view-mobile').length) {
            $('.nasa-store-page').removeClass('nasa-mobile-store-in-list');
        }

        if ($('.nasa-content-page-products').hasClass('nasa-modern-8')) {
            $('.nasa-content-page-products .product-item').each(function() {
                var _nasa_ct_variable_warp = $(this).find('.nasa-product-content-variable-warp');
                $(_nasa_ct_variable_warp).appendTo($(this).find('.product-img-wrap'));
                
            });
        }

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

        // console.log(columns);

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
// nasa-modern-8
    // $('body').trigger('nasa_change_layout_modern_8');
}

/**
 * clone group btn loop products
 * 
 * @param {type} $
 * @returns {undefined}
 */
function clone_group_btns_product_item($) {
    var _list = $('.products').length && $('.products').hasClass('list') ? true : false;

    var _list_2 = _list && $('.products').hasClass('list-2') ? true : false;
    
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

                    if( $(_wrap).find('.nasa-modern-8-add').length) {
                        _add = $(_wrap).find('.add-to-cart-grid.nasa-modern-8-add').clone();
                    }

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
                            var _this = $(this);
                            if (
                                $(_this).find('.nasa-icon-text').length <= 0 &&
                                // $(this).find('.nasa-icon').length &&
                                $(_this).attr('data-icon-text')
                            ) {

                                var _span_text = $(_this).attr('data-icon-text');

                                if ($(_this).hasClass('btn-wishlist') || $(_this).hasClass('btn-compare') ) {
                                    var _span_text_2 = $(_this).attr('data-added');

                                    $(_this).addClass('ns-has-wrap');
                                    $(_this).append(
                                        '<span class="nasa-icon-text-wrap"><span class="nasa-icon-text">' + _span_text + '</span><span class="nasa-icon-text">' + _span_text_2 + '</span></span>'
                                    );

                                    if ($(_this).hasClass('nasa-added')) {
                                        $(_this).find(".nasa-icon-text-wrap").animate({scrollTop: 24}, 400);
                                    }

                                } else {
                                    _span_text = $(_this).attr('data-icon-text');
                                    
                                    $(_this).append(
                                        '<span class="nasa-icon-text">' + _span_text + '</span>'
                                    );
                                }
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

            if ($(_wrap).find('.group-btn-in-list').length) {
                var _place = $(_wrap).find('.group-btn-in-list');

                if (_list_2) {
                    $(_wrap).find('.product-info-wrap').append($(_place));

                    if ($('.nasa-content-page-products').hasClass('nasa-hoz-buttons')) {
                        var btn_w = $(_wrap).find('.nasa-product-grid .btn-wishlist').clone();
                        $(btn_w).addClass('ns-wl-list-2');
                        if ((_wrap).find('.product-img-wrap .ns-wl-list-2').length <= 0) {
                            $(_wrap).find('.product-img-wrap').prepend($(btn_w));
                        }
                        
                    }
                } else {
                    $(_wrap).find('.product-info-wrap').after($(_place));
                }
            }
            
        });
    }
}
