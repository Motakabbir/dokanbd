var _convert_complete = 0;
jQuery(document).ready(function ($) {
    'use strict';
    
    if (typeof wp === 'undefined') {
        var wp = window.wp;
    }
    
    $('body').on('nasa_admin_init_select2', function() {
        if ($('select.nasa-ad-select-2:not(.nasa-inited)').length) {
            $('select.nasa-ad-select-2:not(.nasa-inited)').each(function() {
                $(this).addClass('nasa-inited');
                $(this).select2();
            });
        }
    });
    
    if ($('select.nasa-ad-select-2:not(.nasa-inited)').length) {
        $('body').trigger('nasa_admin_init_select2');
    }
    
    $('body').on('click', '.nasa-clear-themes-cache', function() {
        var _this = $(this);
        var _ok = $(_this).attr('data-ok');
        var _miss = $(_this).attr('data-miss');
        var _fail = $(_this).attr('data-fail');
        if(!$(_this).hasClass('nasa-disable')) {
            $(_this).addClass('nasa-disable');
            $.ajax({
                url: ajax_admin_nasa_core,
                type: 'get',
                dataType: 'html',
                data: {
                    action: 'nasa_clear_all_cache'
                },
                beforeSend: function() {
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').show();
                    }
                },
                success: function(res){
                    $(_this).removeClass('nasa-disable');
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').hide();
                    }
                    
                    if(res === 'ok') {
                        alert(_ok);
                    } else {
                        alert(_miss);
                    }
                },
                error: function () {
                    $(_this).removeClass('nasa-disable');
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').hide();
                    }
                    
                    alert(_fail);
                }
            });
        }
    });
    
    $('body').on('click', '.nasa-clear-fake-sold-cache', function() {
        var _this = $(this);
        var _ok = $(_this).attr('data-ok');
        var _miss = $(_this).attr('data-miss');
        var _fail = $(_this).attr('data-fail');
        if(!$(_this).hasClass('nasa-disable')) {
            $(_this).addClass('nasa-disable');
            $.ajax({
                url: ajax_admin_nasa_core,
                type: 'get',
                dataType: 'html',
                data: {
                    action: 'nasa_clear_fake_sold'
                },
                beforeSend: function() {
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').show();
                    }
                },
                success: function(res){
                    $(_this).removeClass('nasa-disable');
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').hide();
                    }
                    
                    if(res === 'ok') {
                        alert(_ok);
                    } else {
                        alert(_miss);
                    }
                },
                error: function () {
                    $(_this).removeClass('nasa-disable');
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').hide();
                    }
                    
                    alert(_fail);
                }
            });
        }
    });
    
    $('body').on('click', '.nasa-clear-fake-incart-cache', function() {
        var _this = $(this);
        var _ok = $(_this).attr('data-ok');
        var _miss = $(_this).attr('data-miss');
        var _fail = $(_this).attr('data-fail');
        if(!$(_this).hasClass('nasa-disable')) {
            $(_this).addClass('nasa-disable');
            $.ajax({
                url: ajax_admin_nasa_core,
                type: 'get',
                dataType: 'html',
                data: {
                    action: 'nasa_clear_fake_incart'
                },
                beforeSend: function() {
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').show();
                    }
                },
                success: function(res){
                    $(_this).removeClass('nasa-disable');
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').hide();
                    }
                    
                    if(res === 'ok') {
                        alert(_ok);
                    } else {
                        alert(_miss);
                    }
                },
                error: function () {
                    $(_this).removeClass('nasa-disable');
                    if($('.nasa-admin-loader').length) {
                        $('.nasa-admin-loader').hide();
                    }
                    
                    alert(_fail);
                }
            });
        }
    });
    
    if ($('.term-parent-wrap select[name="parent"]').val() === '-1') {
        $('.nasa-term-root').show();
        if ($('.nasa-term-root select').length) {
            $('.nasa-term-root select').each(function () {
                var _val = $(this).val();
                var _name = $(this).attr('name');
                $('.nasa-term-root-child.' + _name).hide();
                if (_val) {
                    $('.nasa-term-root-child.nasa-term-' + _name + '-' + _val).show();
                }
            });
        }
    } else {
        $('.nasa-term-root, .nasa-term-root-child').hide();
    }

    $('body').on('change', '.term-parent-wrap select[name="parent"]', function() {
        var _val = $(this).val();
        if(_val === '-1') {
            $('.nasa-term-root').show();
            
            if ($('.nasa-term-root select').length) {
                $('.nasa-term-root select').each(function () {
                    var _val = $(this).val();
                    var _name = $(this).attr('name');
                    
                    $('.nasa-term-root-child.' + _name).hide();
                    if (_val) {
                        $('.nasa-term-root-child.nasa-term-' + _name + '-' + _val).show();
                    }
                });
            }
        } else {
            $('.nasa-term-root, .nasa-term-root-child').hide();
        }
    });
    
    $('body').on('change', '.nasa-term-root select', function() {
        var _val = $(this).val();
        var _name = $(this).attr('name');

        $('.nasa-term-root-child.' + _name).hide();
        if (_val) {
            $('.nasa-term-root-child.nasa-term-' + _name + '-' + _val).show();
        }
    });
    
    if ($('.nasa-select-main').length) {
        $('.nasa-select-main').each(function() {
            var _this = $(this);
            var _panel = $(_this).parents('.woocommerce_options_panel');
            var _selected = $(_this).val();
            
            $(_panel).find('.nasa-select-child').parents('.form-field').hide();
            $(_panel).find('.nasa-v-' + _selected).parents('.form-field').show();
        });
        
        $('body').on('change', '.nasa-select-main', function() {
            var _this = $(this);
            var _panel = $(_this).parents('.woocommerce_options_panel');
            var _selected = $(_this).val();
            
            $(_panel).find('.nasa-select-child').parents('.form-field').hide();
            $(_panel).find('.nasa-v-' + _selected).parents('.form-field').show();
        });
    }
    
    $('#woocommerce-product-data').on('woocommerce_variations_loaded', function () {
        nasa_gallery_variation($);
    }).on('woocommerce_variations_added', function () {
        nasa_gallery_variation($);
    });

    /**
     * Remove Image in Gallery variation
     */
    $('body').on('click', '.nasa-variation-gallery-images .actions a.delete', function () {
        var _this = $(this);
        var _woo_variation = $(_this).parents('.woocommerce_variation');
        var _wrap = $(_this).parents('.nasa-variation-gallery-images');
        var _variation_id = $(_wrap).attr('data-variation_id');
        $(_this).parents('li.image').remove();

        var attachment_ids = '';

        $(_wrap).find('li.image').each(function () {
            var attachment_id = $(this).attr('data-attachment_id');
            attachment_ids = attachment_ids + attachment_id + ',';
        });

        $('#nasa_variation_gallery_images-' + _variation_id).val(attachment_ids);

        $(_woo_variation).addClass('variation-needs-update');
        $('button.cancel-variation-changes, button.save-variation-changes').removeAttr('disabled');
        $('#variable_product_options').trigger('woocommerce_variations_input_changed');

        return false;
    });
    
    /**
     * Add Gallery
     * 
     * @param {type} $
     * @returns {undefined}
     */
    $('body').on('click', '.nasa-add-gallery', function(event) {
        var _this = $(this);

        event.preventDefault();

        var _wrap = $(_this).parents('.nasa-gallery-wrapper');
        var $image_gallery_ids = $(_wrap).find('.nasa-gallery-images-input');
        var $product_images = $(_wrap).find('.nasa-gallery-images-list');
        
        var product_gallery_frame;

        // If the media frame already exists, reopen it.
        if (product_gallery_frame) {
            product_gallery_frame.open();
            return;
        }

        // Create the media frame.
        product_gallery_frame = wp.media.frames.product_gallery = wp.media({
            // Set the title of the modal.
            title: $(_this).data('choose'),
            button: {
                text: $(_this).data('update')
            },
            states: [
                new wp.media.controller.Library({
                    title: $(_this).data('choose'),
                    filterable: 'all',
                    multiple: true
                })
            ]
        });

        // When an image is selected, run a callback.
        product_gallery_frame.on('select', function () {
            var selection = product_gallery_frame.state().get('selection');
            var attachment_ids = $image_gallery_ids.val();

            selection.map(function (attachment) {
                attachment = attachment.toJSON();

                if (attachment.id) {
                    attachment_ids = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
                    var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                    $product_images.append('<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="javascript:void(0);" class="delete">' + $(_this).data('text') + '</a></li></ul></li>');
                }
            });

            $image_gallery_ids.val(attachment_ids);
        });

        // Finally, open the modal.
        product_gallery_frame.open();
    });
    
    // Remove Image from Gallery
    $('body').on('click', '.nasa-gallery-images-list .actions a.delete', function () {
        var _this = $(this);
        
        var _wrap = $(_this).parents('.nasa-gallery-wrapper');
        var _list = $(_this).parents('.nasa-gallery-images-list');
        $(_this).parents('li.image').remove();

        var attachment_ids = '';

        $(_list).find('li.image').each(function () {
            var attachment_id = $(this).attr('data-attachment_id');
            attachment_ids = attachment_ids + attachment_id + ',';
        });

        $(_wrap).find('.nasa-gallery-images-input').val(attachment_ids);
        
        return false;
    });
    
    /**
     * Sort by drag and drop
     * 
     * @param {type} $
     * @returns {undefined}
     */
    nasa_gallery_images($);
    
    /**
     * Bulk Discounts
     * 
     * @param {type} $
     * @returns {undefined}
     */
    $('body').on('click', '.nasa-add-bulk-dsct', function() {
        var _tmp = $(this).find('template').html();
        
        var _list = $(this).parents('.nasa-bulk-dsct-wrapper').find('.nasa-bulk-dsct-list');
        $(_list).append(_tmp);
        
        nasa_rename_bulk_dsct($, _list);
    });
    
    $('body').on('click', '.nasa-rm-bulk-dsct', function() {
        var _this = $(this);
        var _root = $(_this).parents('.nasa-bulk-dsct-wrapper');
        var _cft = $(_this).attr('data-confirm');
        if (confirm(_cft)) {
            $(_this).parents('.nasa-bulk-dsct-item').remove();
            var _list = $(_root).find('.nasa-bulk-dsct-list');
            nasa_rename_bulk_dsct($, _list);
            
            $('body').trigger('nasa_render_bulk_value', [_root]);
        }
        
        else {
            return false;
        }
    });
    
    $('body').on('change', '.nasa-bulk-dsct-item input', function() {
        var _root = $(this).parents('.nasa-bulk-dsct-wrapper');
        $('body').trigger('nasa_render_bulk_value', [_root]);
    });
    
    $('body').on('keyup', '.nasa-bulk-dsct-item input', function() {
        $(this).trigger('change');
    });
    
    $('body').on('nasa_render_bulk_value', function(ev, _root) {
        var _wrap = $(_root).find('.nasa-bulk-dsct-list');
        
        if ($(_wrap).find('.nasa-bulk-dsct-item').length <= 0) {
            $(_root).find('input.bulk-request-values').val('').trigger('change');
        } else {
            var _val = [];
            var max = 0;
            var _has_rule = false;
            var _qty_arr = [];

            $(_wrap).find('.nasa-bulk-dsct-item').each(function() {
                var _item = $(this);
                var _qty = parseFloat($(_item).find('input.qty-name').val());
                var _dsct = $(_item).find('input.dsct-name').val();
                _dsct = _dsct !== '' ? parseFloat(_dsct) : '';

                if (_qty > 0 && _dsct !== '') {
                    if (_qty_arr.indexOf(_qty) === -1) {
                        _qty_arr.push(_qty);
                        
                        max = _qty && _qty > max ? _qty : max;
                        
                        var _it_arr = {'qty': _qty, 'dsct': _dsct};
                        _val.push(_it_arr);
                        
                        _has_rule = true;
                    }
                }
            });

            if (_has_rule) {
                var max_arr = {'max': max};
                _val.push(max_arr);

                $(_root).find('input.bulk-request-values').val(JSON.stringify(_val)).trigger('change');
            } else {
                $(_root).find('input.bulk-request-values').val('').trigger('change');
            }
        }
    });
    
    /* $('body').on('ns_bulk_dsct_toggle', function() {
        if ($('#_bulk_dsct').length) {
            var _wrap_bulk = $('#_bulk_dsct').parents('.woocommerce_options_panel');

            if ($('#_bulk_dsct').is(':checked')) {
                $(_wrap_bulk).find('.nasa-bulk-dsct-wrapper, ._bulk_dsct_type_field').show();
            } else {
                $(_wrap_bulk).find('.nasa-bulk-dsct-wrapper, ._bulk_dsct_type_field').hide();
            }
        }
        
        if ($('.vari-bulk-allow-check').length) {
            var _wrap_bulk_var = $('.vari-bulk-allow-check').parents('.nasa-variation-custom-fields-container');

            if ($('.vari-bulk-allow-check').is(':checked')) {
                $(_wrap_bulk_var).find('.vari-bulk_dsct_rules_field, .vari-bulk_dsct_type_field').show();
            } else {
                $(_wrap_bulk_var).find('.vari-bulk_dsct_rules_field, .vari-bulk_dsct_type_field').hide();
            }
        }
    }).trigger('ns_bulk_dsct_toggle');
    
    $('body').on('change', '#_bulk_dsct, .vari-bulk-allow-check', function() {
        $('body').trigger('ns_bulk_dsct_toggle');
    }); */
    
    /**
     * Bulk Discounts
     * 
     * @param {type} $
     * @returns {undefined}
     */
    $('body').on('click', '.nasa-add-ct-tab', function() {
        var _tmp = $(this).find('template').html();
        
        var _list = $(this).parents('.nasa-ct-tabs-wrapper').find('.nasa-ct-tabs-list');
        $(_list).append(_tmp);
        
        nasa_rename_nasa_ct_tabs($, _list);
        nasa_limit_ct_tabs($, _list);
        
        var _root = $(this).parents('.nasa-ct-tabs-wrapper');
        $('body').trigger('nasa_render_ct_tabs_value', [_root]);
    });
    
    $('body').on('click', '.nasa-rm-tab', function() {
        var _this = $(this);
        var _root = $(_this).parents('.nasa-ct-tabs-wrapper');
        var _cft = $(_this).attr('data-confirm');
        if (confirm(_cft)) {
            $(_this).parents('.nasa-ct-tabs-item').remove();
            var _list = $(_root).find('.nasa-ct-tabs-list');
            nasa_rename_nasa_ct_tabs($, _list);
            
            $('body').trigger('nasa_render_ct_tabs_value', [_root]);
            nasa_limit_ct_tabs($, _list);
        }
        
        else {
            return false;
        }
    });
    
    $('body').on('change', '.nasa-ct-tabs-item input, .nasa-ct-tabs-item select', function() {
        var _root = $(this).parents('.nasa-ct-tabs-wrapper');
        $('body').trigger('nasa_render_ct_tabs_value', [_root]);
    });
    
    $('body').on('keyup', '.nasa-ct-tabs-item input', function() {
        $(this).trigger('change');
    });
    
    $('body').on('nasa_render_ct_tabs_value', function(ev, _root) {
        var _wrap = $(_root).find('.nasa-ct-tabs-list');
        
        if ($(_wrap).find('.nasa-ct-tabs-item').length <= 0) {
            $(_root).find('input.tabs-request-values').val('').trigger('change');
        } else {
            var _val = [];

            $(_wrap).find('.nasa-ct-tabs-item').each(function() {
                var _item = $(this);
                var _tab = $(_item).find('.glb-tab').val();

                if (_tab !== '') {
                    _val.push(_tab);
                }
            });

            if (_val.length > 0) {
                $(_root).find('input.tabs-request-values').val(JSON.stringify(_val)).trigger('change');
            } else {
                $(_root).find('input.tabs-request-values').val('').trigger('change');
            }
        }
    });
    
    /**
     * Open Desc Zone
     */
    $('body').on('click', '#open-add-desc-zone', function() {
        if (!$('.zone-desc-content').hasClass('actived')) {
            $('.zone-desc-content').addClass('actived');
        }
    });
    
    /**
     * Close Desc Zone
     */
    $('body').on('click', '.close-wrap', function() {
        if ($('.zone-desc-content').hasClass('actived')) {
            $('.zone-desc-content').removeClass('actived');
        }
    });
    
    $('body').on('saved:methods', function() {
        
    });
    
    $('body').on('click', '.ns-advance-fields', function() {
        var _this = $(this);
        
        var opened = $(_this).hasClass('opened') ? true : false;
        
        var _form = $(_this).parents('form');
        
        if ($(_form).length && $(_form).find('.ns-advance-field').length) {
            if (opened) {
                $(_this).html($(_this).attr('data-more'));
                $(_this).removeClass('opened');
                $(_form).find('.ns-advance-field').removeClass('ns-open');
            } else {
                $(_this).html($(_this).attr('data-less'));
                $(_this).addClass('opened');
                $(_form).find('.ns-advance-field').addClass('ns-open');
            }
        }
    });
    
    if ($('body.post-type-page').length) {
        if ($('body.post-type-page').find('.ns-advance-metaboxs').length <= 0) {
            var _btn = $('#ns-advance-metaboxs-btn').length ? $('#ns-advance-metaboxs-btn').html() : '<a class="ns-advance-metaboxs button" href="javascript:void(0);">+ Advance Options</a>';
            $('#nasa_metabox_footer').after(_btn);
        }
    }
    
    $('body').on('click', '.ns-advance-metaboxs', function() {
        var _this = $(this);
        
        var opened = $(_this).hasClass('opened') ? true : false;
        
        if (opened) {
            // $(_this).html($(_this).attr('data-more'));
            $(_this).removeClass('opened');
            $('#nasa_metabox_general').removeClass('ns-open');
            $('#nasa_metabox_general').removeClass('ns-open');
            $('#nasa_metabox_font').removeClass('ns-open');
            $('#nasa_metabox_header').removeClass('ns-open');
            $('#nasa_metabox_footer').removeClass('ns-open');
        } else {
            // $(_this).html($(_this).attr('data-less'));
            $(_this).addClass('opened');
            $('#nasa_metabox_general').addClass('ns-open');
            $('#nasa_metabox_general').removeClass('hide-if-js');
            $('#nasa_metabox_font').addClass('ns-open');
            $('#nasa_metabox_font').removeClass('hide-if-js');
            $('#nasa_metabox_header').addClass('ns-open');
            $('#nasa_metabox_header').removeClass('hide-if-js');
            $('#nasa_metabox_footer').addClass('ns-open');
            $('#nasa_metabox_footer').removeClass('hide-if-js');
        }
    });
    
    /**
     * Fake Purchase
     */
    $('body').on('focus input', '.fake_purchases_input .user_name', function() {
        var name = $(this).val();
        var _wrap = $(this).parents('.fake_pc_wrap');
        $(_wrap).find('.fake_purchases_demo .wrapper-theme .noti-title .nameuser').text(name);
    });
    
    $('body').on('focus input', '.fake_purchases_input .datetime', function() {
        var day = $(this).val();
        var _wrap = $(this).parents('.fake_pc_wrap');
        $(_wrap).find('.fake_purchases_demo .wrapper-theme .noti-time .time_purchased').text(day);
    });

    $('body').on('focus', '.fake_purchases_input .ns_search', function() {
        $(this).parents('.fake_purchases_input').find('.ns_browsers').show();
    });

    $('body').on('change textInput input', '.fake_purchases_input .ns_search', function() {
        var s = $(this).val();
        var str = ''; 
        var _wrap = $(this).parents('.fake_pc_wrap');
        
        if ( s.trim().length >= 3) {

            if ($(_wrap).find('.fake_purchases_demo').hasClass('hidden-tag')) {
                $(_wrap).find('.fake_purchases_input .hidden-tag').removeClass('hidden-tag');
                $(_wrap).find('.fake_purchases_demo').removeClass('hidden-tag');
            }

            $.ajax({
                url: ns_admin_url_search,
                type: 'GET',
                dataType: 'json',
                data: {
                    term: s,
                    security: ns_admin_search_nonce,
                    rule_opt: 'elessi-options'
                },
                beforeSend: function() {
                    $(_wrap).find('.seach_pro').addClass('nasa-search-loading');
                    $(_wrap).find('.ns_browsers').html('');
                },
                success: function(data) {
                    var results = data;
                    for (var id in results) {
                        str +='<li class="product_item" data-prod="'+id+'" permalink="' + (results[id])['permalink'] + '" img_url="' + (results[id])['img_url'] + '">' + (results[id])['title'] +  '</li>';
                    }
                    
                    $(_wrap).find('.seach_pro').removeClass('nasa-search-loading');
                    $(_wrap).find('.ns_browsers').html(str);
                    
                    return {
                        results: results
                    };
                }
            });
        }
    });

    $('body').on('click', '.fake_purchases_input .product_item', function(e) {
        e.preventDefault();
        
        var _this = $(this);
        var _section = $(_this).parents('.section-fake_purchases');
        var _input_wrap = $(_section).find('.fake_purchases_input');
        
        $(_section).find('.fake_purchases_demo .nameproduct').text($(_this).html());
        $(_section).find('.fake_purchases_demo .nameproduct').attr({'href':$(_this).attr('permalink'),'data-prod':$(_this).attr('data-prod')});
        $(_section).find('.fake_purchases_demo .nameproduct').attr('title',$(_this).html());
        $(_input_wrap).find('.ns_search').val($(_this).html());
        $(_section).find('.fake_purchases_demo .tmop-product-image').attr('src', $(_this).attr('img_url'));
        $(_input_wrap).find('.ns_browsers').hide();
    });

    $('body').on('click', '.fake_purchases_input .add-list', function(e) {
        e.preventDefault();
        
        var _wrap = $(this).parents('.fake_pc_wrap');
        var _item = $(_wrap).find('.product-item-tmpl').html();
        var _src_img = $(_wrap).find('.fake_purchases_demo .tmop-product-image').attr('src');
        var _customer = $(_wrap).find('.fake_purchases_demo .nameuser').html();
        var _p_url = $(_wrap).find('.fake_purchases_demo .nameproduct').attr('href');
        var _p_name = $(_wrap).find('.fake_purchases_demo .nameproduct').html();
        var _p_id = $(_wrap).find('.fake_purchases_demo .nameproduct').attr('data-prod');
        var _time_purchase = $(_wrap).find('.fake_purchases_demo .time_purchased').html();
        
        _item = _item.replace(/{{src_img}}/g, _src_img);
        _item = _item.replace(/{{customer}}/g, _customer);
        _item = _item.replace(/{{p_url}}/g, _p_url);
        _item = _item.replace(/{{p_name}}/g, _p_name);
        _item = _item.replace(/{{time_purchase}}/g, _time_purchase);
        _item = _item.replace(/{{p_data_prod}}/g, _p_id);
        
        $('.fake_purchases_list').append(_item);
        
        nasa_add_to_list_fk($, _wrap);
    });

    $('body').on('click', '.fake_purchases_list .delete_btn', function(e) {
        e.preventDefault();
        
        var _wrap = $(this).parents('.fake_pc_wrap');

        if (confirm("Are you sure?")) {
            $(this).parents('.product_list_item').remove();
            nasa_add_to_list_fk($, _wrap);
        }
    
    });    

    $('body').on('click', '.fake_purchases_list .change_btn', function(e) {
        e.preventDefault();
        
        $(this).parents('.product_list_item').find('.user_name_change, .datetime_change').attr('type', 'text');
        $(this).parents('.product_list_item').find('.btn_wrap').removeClass('hidden-tag');
    });

    $('body').on('click', '.product_list_item .apply_change', function(e) {
        e.preventDefault();
        
        var _wrap = $(this).parents('.fake_pc_wrap');
        var par = $(this).parents('.product_list_item');
        
        var name = $(par).find('.user_name_change').val();
        var day = $(par).find('.datetime_change').val();
        
        if(name.trim().length > 0){
            $(par).find('.nameuser').text(name);
        }
        
        if (day.trim().length > 0){
            $(par).find('.noti-time .time_purchased').text(day);
        }
        
        nasa_add_to_list_fk($, _wrap);
        
        $(par).find('.close_change').trigger('click');
    }); 

    $('body').on('click', '.close_change', function(e) {
        e.preventDefault();
        
        $(this).parents('.product_list_item').find('.user_name_change, .datetime_change').attr('type', 'hidden');
        
        if (!$(this).parents('.product_list_item').find('.btn_wrap').hasClass('hidden-tag')) {
            $(this).parents('.product_list_item').find('.btn_wrap').addClass('hidden-tag');
        }
    }); 

    $('body').on('click', function(e) {
        if(e.target.className !== "of-input ns_search" && e.target.className !== "ns_browsers") {
            $('.ns_browsers').css('display', 'none');
        }
    });
    
    /**
     * Render Available Fake Purchase Items
     */
    if ($('.input_list_purchased').length) {
        $('.input_list_purchased').each(function() {
            var _wrap = $(this).parents('.fake_pc_wrap');
            
            var _val = $(this).val();
            
            if (_val !== '') {
                var _data = JSON.parse(_val);
                var _count = _data.length;
                var _temp = $(_wrap).find('.product-item-tmpl').html();
                
                for (var i=0; i<_count; i++) {
                    var _src_img = _data[i]['img_url'];
                    var _customer = _data[i]['name'];
                    var _p_url = _data[i]['pro_href'];
                    var _p_name = _data[i]['pro_name'];
                    var _p_id = _data[i]['id'];
                    var _time_purchase = _data[i]['day'];
                    
                    var _item = _temp;
                    _item = _item.replace(/{{src_img}}/g, _src_img);
                    _item = _item.replace(/{{customer}}/g, _customer);
                    _item = _item.replace(/{{p_url}}/g, _p_url);
                    _item = _item.replace(/{{p_name}}/g, _p_name);
                    _item = _item.replace(/{{time_purchase}}/g, _time_purchase);
                    _item = _item.replace(/{{p_data_prod}}/g, _p_id);
                    
                    $(_wrap).find('.fake_purchases_list').append(_item);
                }
            }
        });
    }

    /**
     * Image - Media
     */
    if (typeof wp !== 'undefined') {
        $('body').on('click', 'button.upload_image-tax', function (e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                // mutiple: true if you want to upload multiple files at once
                multiple: false
            }).open().on('select', function () {
                // This will return the selected image from the Media Uploader, the result is an object
                var uploaded_image = image.state().get('selection').first();
                // We convert uploaded_image to a JSON object to make accessing it easier
                // Output to the console uploaded_image
                var imgObj = uploaded_image.toJSON();
                // imgObj.url, imgObj.id

                // Let's assign the url value to the input field
                $('#term-nasa_image').val(imgObj.id);
                $('#nasa-attr-img-view').attr('src', imgObj.url);
                $('.remove_image-tax').show();
            });
        });

        $('body').on('click', 'button.remove_image-tax', function (e) {
            e.preventDefault();
            $('#term-nasa_image').val('');
            $('#nasa-attr-img-view').attr('src', $(this).attr('data-no_img'));
            $(this).hide();
        });

        /**
         * Custom upload
         */
        $('body').on('click', '.nasa-custom-upload', function (e) {
            var _this = $(this);
            if (!$(_this).hasClass('nasa-remove')) {
                e.preventDefault();
                var image = wp.media({
                    title: 'Upload Image',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open().on('select', function () {
                    // This will return the selected image from the Media Uploader, the result is an object
                    var uploaded_image = image.state().get('selection').first();
                    // We convert uploaded_image to a JSON object to make accessing it easier
                    // Output to the console uploaded_image
                    var imgObj = uploaded_image.toJSON();
                    // imgObj.url, imgObj.id

                    
                    if(isImage(imgObj.url)) {
                        // Let's assign the url value to the input field
                        $(_this).find('input').val(imgObj.id);
                        //var _src = typeof imgObj.sizes.thumbnail.url !== 'undefined' ? imgObj.sizes.thumbnail.url : imgObj.url;
                        $(_this).find('img').attr('src', imgObj.url);
                        $(_this).addClass('nasa-remove');
                    } else {
                        alert($(_this).attr('data-wrong'));
                    }

                });
            } else if (confirm($(_this).attr('data-confirm_remove'))) {
                $(_this).find('input').val('');
                $(_this).find('img').attr('src', $(_this).attr('data-no_img'));
                $(_this).removeClass('nasa-remove');
            }
        });

        $('body').on('click', '.nasa-custom-upload-video', function (e) {
            var _this = $(this);
            if (!$(_this).hasClass('nasa-remove')) {
                e.preventDefault();
                var video = wp.media({
                    title: 'Upload Video',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open().on('select', function () {
                    // This will return the selected image from the Media Uploader, the result is an object
                    var uploaded_video = video.state().get('selection').first();
                    // We convert uploaded_image to a JSON object to make accessing it easier
                    // Output to the console uploaded_image
                    var vdObj = uploaded_video.toJSON();
                    // vdObj.url, vdObj.id

                    if(isImage(vdObj.url)) {
                        alert($(_this).attr('data-wrong'));
                    } else {
                        // Let's assign the url value to the input field
                        $(_this).find('input').val(vdObj.id);
                        // var _src = typeof vdObj.sizes.thumbnail.url !== 'undefined' ? vdObj.sizes.thumbnail.url : ;
                        $(_this).find('video').attr('src', vdObj.url).removeClass('hidden-tag');
                        $(_this).find('img').addClass('hidden-tag');
                        $(_this).addClass('nasa-remove');
                    }
                   
                });
            } else if (confirm($(_this).attr('data-confirm_remove'))) {
                $(_this).find('input').val('');
                $(_this).find('video').attr('src', $(_this).attr('data-no_video')).addClass('hidden-tag');
                $(_this).find('img').removeClass('hidden-tag');
                $(_this).removeClass('nasa-remove');
            }
        });
    }

    /**
     * Variation Product gallery file uploads.
     */
    $('body').on('click', '.nasa-add-variation-gallery-image-wrapper a', function (event) {
        var $el = $(this);

        event.preventDefault();

        var _woo_variation = $el.parents('.woocommerce_variation');
        var product_gallery_frame;
        var _variation_id = $el.attr('data-product_variation_id');
        var $image_gallery_ids = $('#nasa_variation_gallery_images-' + _variation_id);
        var $product_images = $('#nasa-variation_gallery-' + _variation_id);

        // If the media frame already exists, reopen it.
        if (product_gallery_frame) {
            product_gallery_frame.open();
            return;
        }

        // Create the media frame.
        product_gallery_frame = wp.media.frames.product_gallery = wp.media({
            // Set the title of the modal.
            title: $el.data('choose'),
            button: {
                text: $el.data('update')
            },
            states: [
                new wp.media.controller.Library({
                    title: $el.data('choose'),
                    filterable: 'all',
                    multiple: true
                })
            ]
        });

        // When an image is selected, run a callback.
        product_gallery_frame.on('select', function () {
            var selection = product_gallery_frame.state().get('selection');
            var attachment_ids = $image_gallery_ids.val();

            selection.map(function (attachment) {
                attachment = attachment.toJSON();

                if (attachment.id) {
                    attachment_ids = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
                    var attachment_image = attachment.sizes && attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url;

                    $product_images.append('<li class="image" data-attachment_id="' + attachment.id + '"><img src="' + attachment_image + '" /><ul class="actions"><li><a href="javascript:void(0);" class="delete">' + $el.data('text') + '</a></li></ul></li>');
                }
            });

            $image_gallery_ids.val(attachment_ids);

            $(_woo_variation).addClass('variation-needs-update');
            $('button.cancel-variation-changes, button.save-variation-changes').removeAttr('disabled');
            $('#variable_product_options').trigger('woocommerce_variations_input_changed');
        });

        // Finally, open the modal.
        product_gallery_frame.open();
    });
    
    /**
     * Convert Brand
     * 
     * @param {type} url
     * @returns {Boolean}
     */
    $('body').on('click', '.ns-init-convert-brand', function() {
        var _wrap = $(this).parents('.ns-convert-brand-wrap');
        if (!$(_wrap).hasClass('no-event')) {
            $(this).addClass('hidden-tag');
            $(_wrap).find('.brand-attrs-list').removeClass('hidden-tag');
        }
    });
    
    $('body').on('click', '.ns-convert-brand-wrap .brand-attr-item', function() {
        var _this = $(this);
        var _wrap = $(_this).parents('.ns-convert-brand-wrap');
        if (!$(_wrap).hasClass('no-event')) {
            $(_wrap).find('.brand-attr-item').removeClass('selected');
            $(_this).addClass('selected');
        }
    });
    
    $('body').on('click', '.ns-convert-brand-wrap .ns-start-convert-brand', function() {
        var _this = $(this);
        var _wrap = $(_this).parents('.ns-convert-brand-wrap');
        
        if (!$(_wrap).hasClass('no-event')) {
            if ($(_wrap).find('.brand-attr-item.selected').length <= 0) {
                alert('Please select on an Attribute to Push data in!');
            } else {
                $(_wrap).addClass('no-event');
                $(_this).addClass('hidden-tag');
                $(_this).parents('span').addClass('hidden-tag');
                $(_wrap).find('.convert-process-bar').removeClass('hidden-tag');
                $(_wrap).find('.convert-process-bar-loading').removeClass('hidden-tag');

                /**
                 * ajax run Convert
                 */
                var _slug = $(_wrap).find('.brand-attr-item.selected').attr('data-slug');

                nasa_convert_brand_attr_brands(_slug, $);
            }
        }
    });
    
    $('body').on('nasa_convert_brands_to_attrs', function(e, data) {
        if (data) {
            nasa_start_convert_brand_attr_brands(data, 0, $);
        }
    });
});

function nasa_start_convert_brand_attr_brands(data, section, $) {
    var brands = data.brands;
    
    if (typeof brands[section] !== 'undefined' && brands[section]) {
        setTimeout(function() {
            $.ajax({
                url: ajax_admin_nasa_core,
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'nasa_start_convert_brands_to_attrs',
                    id: brands[section]['id'],
                    name: brands[section]['name'],
                    slug: brands[section]['slug'],
                    desc: brands[section]['desc'],
                    thumbnail_id: brands[section]['thumbnail_id'],
                    count: brands[section]['count'],
                    tax: data['attr']
                },
                beforeSend: function() {
                    
                },
                success: function(res){
                    if (brands[section]['count'] <= 0) {
                        section += 1;
                        nasa_start_convert_brand_attr_brands(data, section, $);
                    } else {
                        nasa_start_convert_brand_attr_brands_products(data, section, 0, $);
                    }
                },
                error: function () {
                    
                }
            });
        }, 100);
    } else {
        $('.convert-process-bar-loading').remove();
        $('.convert-process-bar-complete').removeClass('hidden-tag');
    }
}

function nasa_start_convert_brand_attr_brands_products(data, section, offset, $) {
    var brands = data.brands;
    var _limit = $('.limit-1-time').length ? parseInt($('.limit-1-time').val()) : 50;
    _limit = !_limit ? 50 : _limit;
    
    if (typeof brands[section] !== 'undefined' && brands[section]) {
        setTimeout(function() {
            $.ajax({
                url: ajax_admin_nasa_core,
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'nasa_start_convert_brands_to_attrs_product',
                    id: brands[section]['id'],
                    name: brands[section]['name'],
                    slug: brands[section]['slug'],
                    desc: brands[section]['desc'],
                    thumbnail_id: brands[section]['thumbnail_id'],
                    count: brands[section]['count'],
                    tax: data['attr'],
                    total: data['count_p'],
                    offset: offset,
                    limit: _limit 
                },
                beforeSend: function() {
                    
                },
                success: function(res){
                    if (offset >= brands[section]['count']) {
                        section += 1;
                        nasa_start_convert_brand_attr_brands(data, section, $);
                    } else {
                        _convert_complete += res.complete;
                        var _width = Math.floor(_convert_complete / data['count_p'] * 100) + '%';
                        var _content = _convert_complete + ' / ' + data['count_p'];

                        $('.ns-convert-brand-wrap .complete-convert').html(_content);
                        $('.ns-convert-brand-wrap .complete-convert').css({'width': _width});
                        
                        offset += _limit;
                        nasa_start_convert_brand_attr_brands_products(data, section, offset, $);
                    }
                },
                error: function () {
                    
                }
            });
        }, 500);
    }
}

/**
 * Ajax Convert Brand to Brand Attr
 * 
 * @param {type} url
 * @returns {Boolean}
 */
function nasa_convert_brand_attr_brands(_slug, $) {
    $.ajax({
        url: ajax_admin_nasa_core,
        type: 'post',
        dataType: 'json',
        data: {
            action: 'nasa_init_convert_brands_to_attrs',
            slug: _slug
        },
        beforeSend: function() {
            
        },
        success: function(res){
            $('body').trigger('nasa_convert_brands_to_attrs', [res]);
        },
        error: function () {
            
        }
    });
}

/**
 * Check is image
 * @param {type} url
 * @returns {Boolean}
 */
function isImage(url) {
    const imageExtensions = /(jpg|jpeg|png|webp|avif|gif|svg)$/;
    return imageExtensions.test(url);
}
/**
 * Add To List Fake Purchase
 */
function nasa_add_to_list_fk($, _wrap){
    var array = [];
    
    if ($(_wrap).find('.fake_purchases_list .product_list_item').length) {
        $(_wrap).find('.fake_purchases_list .product_list_item').each(function() {
            var _this = $(this);
            
            var img_url     = $(_this).find('.product-image .tmop-product-image').attr('src').trim();
            var name        = $(_this).find('.wrapper-theme .noti-title .nameuser').text().trim();
            var pro_name    = $(_this).find('.wrapper-theme .noti-body .nameproduct').text().trim();
            var pro_href    = $(_this).find('.wrapper-theme .noti-body .nameproduct').attr('href').trim();
            var day         = $(_this).find('.wrapper-theme .noti-time .time_purchased').text().trim();
            var id          = $(_this).find('.wrapper-theme .noti-body .nameproduct').attr('data-prod').trim();

            array.push({img_url, name, pro_name, pro_href, day, id});
        });
    }
    
    var json = array.length ? JSON.stringify(array) : '';
    
    $(_wrap).find('.input_list_purchased').val(json);
}

/**
 * rename input bulk discount
 * 
 * @param {type} $
 * @returns {undefined}
 */
function nasa_rename_bulk_dsct($, _wrap) {
    var _k = 0;
    
    $(_wrap).find('.nasa-bulk-dsct-item').each(function() {
        var _item = $(this);
        var _qty_name = 'qty_name_' + _k;
        var _dsct_name = 'dsct_name_' + _k;
        
        $(_item).find('input.qty-name').attr('name', _qty_name);
        $(_item).find('input.dsct-name').attr('name', _dsct_name);
        
        _k++;
    });
}

/**
 * rename input ct tabs
 * 
 * @param {type} $
 * @returns {undefined}
 */
function nasa_rename_nasa_ct_tabs($, _wrap) {
    var _k = 0;
    
    $(_wrap).find('.nasa-ct-tabs-item').each(function() {
        var _item = $(this);
        
        var _tab = 'tab_' + _k;
        var _label = $(_item).find('.tab-label').attr('data-label') + ' #' + (_k + 1);
        
        $(_item).find('.glb-tab').attr('name', _tab);
        $(_item).find('.tab-label').html(_label);
        
        _k++;
    });
    
    $('body').trigger('nasa_admin_init_select2');
}

/**
 * Check limit ct tabs
 * 
 * @param {type} $
 * @returns {undefined}
 */
function nasa_limit_ct_tabs($, _wrap) {
    if ($(_wrap).find('.nasa-ct-tabs-item').length > 4) {
        if (!$('.nasa-action-add-ct-tab').hasClass('hidden-tag')) {
            $('.nasa-action-add-ct-tab').addClass('hidden-tag');
        }
    } else {
        $('.nasa-action-add-ct-tab').removeClass('hidden-tag');
    }
}

/**
 * Sort by drag and drop
 * 
 * @param {type} $
 * @returns {undefined}
 */
function nasa_gallery_images($) {
    $('.nasa-gallery-images-list').each(function () {
        var _this = $(this);
        var _wrap = $(_this).parents('.nasa-gallery-wrapper');
        
        _this.sortable({
            items: 'li.image',
            cursor: 'move',
            scrollSensitivity: 40,
            forcePlaceholderSize: true,
            forceHelperSize: false,
            helper: 'clone',
            opacity: 0.65,
            placeholder: 'wc-metabox-sortable-placeholder',
            start: function (event, ui) {
                ui.item.css('background-color', '#f6f6f6');
            },
            stop: function (event, ui) {
                ui.item.removeAttr('style');
            },
            update: function () {
                var attachment_ids = '';

                $(_this).find('li.image').css('cursor', 'default').each(function () {
                    var attachment_id = $(this).attr('data-attachment_id');
                    attachment_ids = attachment_ids + attachment_id + ',';
                });

                $(_wrap).find('.nasa-gallery-images-input').val(attachment_ids);
            }
        });
    });
}

/**
 * Gallery for variation - Sortable
 * @param {type} $
 * @returns {undefined}
 */
function nasa_gallery_variation($) {
    if ($('.woocommerce_variation').length) {
        $('.woocommerce_variation').each(function () {
            var _this = $(this);
            
            if ($(_this).find('.nasa-variation-gallery-wrapper').length) {
                var _gallery = $(_this).find('.nasa-variation-gallery-wrapper');
                $(_this).find('.upload_image').after(_gallery);
            }
        });
    }

    if ($('.nasa-variation-gallery-images').length) {
        $('.nasa-variation-gallery-images').each(function () {
            var _this = $(this);
            var _variation_id = $(_this).attr('data-variation_id');
            var _woo_variation = $(_this).parents('.woocommerce_variation');
            _this.sortable({
                items: 'li.image',
                cursor: 'move',
                scrollSensitivity: 40,
                forcePlaceholderSize: true,
                forceHelperSize: false,
                helper: 'clone',
                opacity: 0.65,
                placeholder: 'wc-metabox-sortable-placeholder',
                start: function (event, ui) {
                    ui.item.css('background-color', '#f6f6f6');
                },
                stop: function (event, ui) {
                    ui.item.removeAttr('style');
                },
                update: function () {
                    var attachment_ids = '';

                    $(_this).find('li.image').css('cursor', 'default').each(function () {
                        var attachment_id = $(this).attr('data-attachment_id');
                        attachment_ids = attachment_ids + attachment_id + ',';
                    });

                    $('#nasa_variation_gallery_images-' + _variation_id).val(attachment_ids);

                    $(_woo_variation).addClass('variation-needs-update');
                    $('button.cancel-variation-changes, button.save-variation-changes').removeAttr('disabled');
                    $('#variable_product_options').trigger('woocommerce_variations_input_changed');
                }
            });
        });
    }
}
