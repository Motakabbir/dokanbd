var top_bar_left_df = '';
var content_custom_df = '';
var time_delay = 200;
var time_out_input = null;
var mediaUploader;

jQuery(document).ready(function($) {
    "use strict";
    
    loadListIcons($);
    
    var text_now = $('textarea#topbar_left').val();
    $('body').on('click', '.reset_topbar_left', function() {
        if ($('textarea#topbar_left').val() !== top_bar_left_df) {
            var _confirm = confirm('Are you sure to reset top bar left ?');

            if (_confirm) {
                $('textarea#topbar_left').val(top_bar_left_df);
            }
        }
        
        return false;
    });
    
    $('body').on('click', '.restore_topbar_left', function() {
        if (text_now !== $('textarea#topbar_left').val()) {
            var _confirm = confirm('Are you sure to restore top bar left ?');

            if (_confirm) {
                $('textarea#topbar_left').val(text_now);
            }
        }
        
        return false;
    });
    
    var text_content_now = $('textarea#content_custom').val();
    $('body').on('click', '.reset_content_custom', function() {
        if ($('textarea#content_custom').val() !== content_custom_df) {
            var _confirm = confirm('Are you sure to reset your content custom ?');

            if (_confirm) {
                $('textarea#content_custom').val(content_custom_df);
            }
        }
        
        return false;
    });
    
    $('body').on('click', '.restore_content_custom', function() {
        if (text_content_now !== $('textarea#content_custom').val()) {
            var _confirm = confirm('Are you sure to restore your content custom ?');

            if (_confirm) {
                $('textarea#content_custom').val(text_content_now);
            }
        }
        
        return false;
    });
    
    $('body').on('click', '.toggle-choose-icon-btn', function() {
        $(this).parents('.widget-content').find('.toggle-choose-icon').toggleClass('hidden-tag');
    });
    
    $('body').on('click', '.nasa-chosen-icon', function() {
        var _fill = $(this).attr('data-fill');
        if (_fill) {
            if ($('.nasa-list-icons-select').length < 1) {
                $.ajax({
                    url: ajaxurl,
                    type: 'get',
                    dataType: 'html',
                    data: {
                        action: 'nasa_list_fonts_admin',
                        fill: _fill
                    },
                    success: function(res) {
                        $('body').append(res);
                        $('body').append('<div class="nasa-tranparent" />');
                        $('.nasa-list-icons-select').animate({right: 0}, 300);
                    }
                });
            } else {
                $('body').append('<div class="nasa-tranparent" />');
                $('.nasa-list-icons-select').attr('data-fill', _fill);
                $('.nasa-list-icons-select').animate({right: 0}, 300);
            }
        }
        
        return false;
    });
    
    $('body').on('click', '.nasa-tranparent', function() {
        if ($('.nasa-list-icons-select').length) {
            $('.nasa-list-icons-select').animate({right: '-500px'}, 300);
        }
        $(this).remove();
    });
    
    // Search icons
    $('body').on('keyup', '.nasa-input-search-icon', function() {
        searchIcons($);
    });
    
    $('body').on('click', '.nasa-fill-icon', function() {
        var _val = $(this).attr('data-val');
        var _fill = $(this).parent().attr('data-fill');
        
        if ($('#'+_fill).length) {
            $('#'+_fill).val(_val);
        }
        
        if ($('input[name="'+_fill+'"]').length) {
            $('input[name="'+_fill+'"]').val(_val);
        }
        
        if ($('#ico-'+_fill).length) {
            $('#ico-'+_fill).html('<i class="' + _val + '"></i><a href="javascript:void(0);" class="nasa-remove-icon" data-id="' + _fill + '"><i class="fa fa-remove"></i></a>');
        }
        
        $('.nasa-tranparent').click();
    });
    
    $('body').on('click', '.nasa-remove-icon', function() {
        var _fill = $(this).attr('data-id');
        
        if ($('#'+_fill).length) {
            $('#'+_fill).val('');
        }
        
        if ($('input[name="'+_fill+'"]').length) {
            $('input[name="'+_fill+'"]').val('');
        }
        
        if ($('#ico-'+_fill).length) {
            $('#ico-'+_fill).html('');
        }
    });
    
    loadColorPicker($);
    $('.widget-control-save').ajaxComplete(function() {
        loadColorPicker($);
    });
    
    $(document).ajaxComplete(function() {
        if ($('input[name="section_nasa_icon"]').length) {
            $('input[name="section_nasa_icon"]').attr('readonly', true);
        }
        
        if ($('.vc_ui-panel-window select[name="i_type"]').length) {
            var _change = false;
            $('.vc_ui-panel-window select[name="i_type"] option').each(function() {
                if ('fontawesome' !== $(this).attr('value')) {
                    $(this).remove();
                    
                    _change = true;
                }
            });
            
            if (_change) {
                $('.vc_ui-panel-window select[name="i_type"]').val('fontawesome').trigger('change');
            }
        }
    });
    
    $('body').on('change', '.nasa-select-attr', function() {
        var _warp = $(this).parents('.widget-content');
        if ($(_warp).find('.nasa-vari-type').val() === '1') {
            var taxonomy = $(this).val(),
                num = $(this).attr('data-num'),
                instance = $(_warp).find('.nasa-widget-instance').attr('data-instance');
            loadColorDefault($, _warp, taxonomy, num, instance, false);
        }
        
        return true;
    });
    
    $('body').on('change', '.nasa-vari-type', function() {
        var _warp = $(this).parents('.widget-content'),
            taxonomy = $(_warp).find('.nasa-select-attr').val(),
            num = $(_warp).find('.nasa-select-attr').attr('data-num'),
            instance = $(_warp).find('.nasa-widget-instance').attr('data-instance');
        if ($(this).val() === '1') {  
            loadColorDefault($, _warp, taxonomy, num, instance, true);
        } else {
            unloadColor($, _warp);
        }
        
        return true;
    });
    
    // Option Breadcrumb
    if ($('.nasa-breadcrumb-flag-option input[type="checkbox"]').is(':checked')) {
	$('.nasa-breadcrumb-type-option').show();
        $('.nasa-breadcrumb-align-option').show();
	if ($('.nasa-breadcrumb-type-option').find('select').val() === 'has-background') {
	    $('.nasa-breadcrumb-bg-option').show();
            // $('.nasa-breadcrumb-bg-lax').show();
	    loadImgOpBreadcrumb($);
	}
    }
    
    $('body').on('change', '.nasa-breadcrumb-flag-option input[type="checkbox"]', function() {
	if ($(this).is(':checked')) {
	    $('.nasa-breadcrumb-type-option').fadeIn(200);
            $('.nasa-breadcrumb-align-option').fadeIn(200);
	    if ($('.nasa-breadcrumb-type-option').find('select').val() === 'has-background') {
		$('.nasa-breadcrumb-bg-option').fadeIn(200);
                // $('.nasa-breadcrumb-bg-lax').fadeIn(200);
		loadImgOpBreadcrumb($);
	    }
	} else {
	    $('.nasa-breadcrumb-type-option').fadeOut(200);
	    $('.nasa-breadcrumb-bg-option').fadeOut(200);
            // $('.nasa-breadcrumb-bg-lax').fadeOut(200);
            $('.nasa-breadcrumb-align-option').fadeOut(200);
	}
    });
    
    $('body').on('change', '.nasa-breadcrumb-type-option select', function() {
	if ($(this).val() === 'has-background') {
	    $('.nasa-breadcrumb-bg-option').fadeIn(200);
	    $('.nasa-breadcrumb-color-option').fadeIn(200);
            // $('.nasa-breadcrumb-bg-lax').fadeIn(200);
	    $('.nasa-breadcrumb-height-option').fadeIn(200);
            $('.nasa-breadcrumb-text-option').fadeIn(200);
	    loadImgOpBreadcrumb($);
	} else {
	    $('.nasa-breadcrumb-bg-option').fadeOut(200);
	    $('.nasa-breadcrumb-color-option').fadeOut(200);
            // $('.nasa-breadcrumb-bg-lax').fadeOut(200);
	    $('.nasa-breadcrumb-height-option').fadeOut(200);
	    $('.nasa-breadcrumb-text-option').fadeOut(200);
	}
    });
    
    /* if ($('.type_promotion select').length) {
        var val_promotion = $('.type_promotion select').val();
        if (val_promotion === 'custom') {
            $('.nasa-custom_content').show();
        } else if (val_promotion === 'list-posts') {
            $('.nasa-list_post').show();
        }
        $('body').on('change', '.type_promotion select', function() {
            var val_promotion = $(this).val();
            if (val_promotion === 'custom') {
                $('.nasa-custom_content').fadeIn(200);
                $('.nasa-list_post').fadeOut(200);
            } else if (val_promotion === 'list-posts') {
                $('.nasa-custom_content').fadeOut(200);
                $('.nasa-list_post').fadeIn(200);
            }
        });
    } */
    
    /* if ($('.nasa-header-type-select input[type="radio"][name="header-type"]').length > 0) {
        var _val_header = $('.nasa-header-type-select input[type="radio"][name="header-type"]:checked').val();
        $('.nasa-header-type-select-' + _val_header).slideDown(200);
        
        $('body').on('click', '.nasa-header-type-select img.of-radio-img-img', function() {
            var _val_header = $('.nasa-header-type-select input[type="radio"][name="header-type"]:checked').val();
            $('.nasa-header-type-select-' + _val_header).slideDown(200);
            $('.nasa-header-type-child').each(function() {
                if (!$(this).hasClass('nasa-header-type-select-' + _val_header)) {
                    $(this).slideUp(200);
                }
            });
        });
    } */
    
    /* if ($('.nasa-type-font select').length) {
        var _val_font = $('.nasa-type-font select').val();
        $('.nasa-type-font-' + _val_font).slideDown(200);
        
        $('body').on('change', '.nasa-type-font select', function() {
            var _val_font = $(this).val();
            $('.nasa-type-font-glb').slideUp(200);
            $('.nasa-type-font-' + _val_font).slideDown(200);
        });
    } */
    
    $('.nasa-theme-option-parent select').each(function() {
        var _val = $(this).val();
        var _id = $(this).attr('id');
        $('.nasa-' + _id + '.nasa-theme-option-child').hide();
        $('.nasa-' + _id + '-' + _val + '.nasa-theme-option-child').show();
    });
    
    $('body').on('change', '.nasa-theme-option-parent select', function() {
        var _val = $(this).val();
        var _id = $(this).attr('id');
        
        $('.nasa-' + _id + '.nasa-theme-option-child').slideUp(200);
        $('.nasa-' + _id + '-' + _val + '.nasa-theme-option-child').slideDown(200);
    });
    
    if ($('.nasa-theme-option-parent input[type="radio"]:checked').length) {
        $('.nasa-theme-option-parent input[type="radio"]:checked').each(function() {
            var _this = $(this);
            var _val = $(_this).val();
            var _id = $(_this).attr('name');

            $('.nasa-' + _id + '.nasa-theme-option-child').hide();
            $('.nasa-' + _id + '-' + _val + '.nasa-theme-option-child').show();
        });
    }
    
    $('body').on('click', '.nasa-theme-option-parent img.of-radio-img-img', function() {
        var _this = $(this);
        var _parents = $(_this).parents('.nasa-theme-option-parent');
        var _val = $(_parents).find('input[type="radio"]:checked').val();
        var _id = $(_parents).find('input[type="radio"]:checked').attr('name');

        $('.nasa-' + _id + '.nasa-theme-option-child').slideUp(200);
        $('.nasa-' + _id + '-' + _val + '.nasa-theme-option-child').slideDown(200);
    });
    
    if ($('.nasa-topbar_toggle input[type="checkbox"]').is(':checked')) {
	$('.nasa-topbar_df-show').show();
    }
    
    $('body').on('change', '.nasa-topbar_toggle input[type="checkbox"]', function() {
	if ($(this).is(':checked')) {
	    $('.nasa-topbar_df-show').slideDown(200);
	} else {
	    $('.nasa-topbar_df-show').slideUp(200);
	}
    });
    
    $('body').on('ns_main_child', function () {
        if ($('[data-child_of]').length) {
            $('[data-child_of]').each(function() {
                var _this = $(this);
                var _main = $(_this).attr('data-child_of');
                
                if (_main && $('#section-' + _main).length) {
                    var _vals_str = $(_this).attr('data-target');
                    var _vals = _vals_str ? _vals_str.split(',') : [];
                    
                    var _main_val = '';
                    
                    /**
                     * For Checkbox
                     */
                    if ($('#section-' + _main).find('input[type="checkbox"]').length) {
                        if ($('#section-' + _main).find('input[type="checkbox"]').is(':checked')) {
                            _main_val = $('#section-' + _main).find('input[type="checkbox"]').val();
                        } else {
                            _main_val = $('#section-' + _main).find('input[type="hidden"]').val();
                        }
                    }
                    
                    /**
                     * For Radio
                     */
                    if ($('#section-' + _main).find('input[type="radio"]').length) {
                        $('#section-' + _main).find('input[type="radio"]').each(function () {
                            if ($(this).is(':checked')) {
                                _main_val = $(this).val();
                            }
                        });
                    }
                    
                    /**
                     * For Select
                     */
                    if ($('#section-' + _main).find('select').length) {
                        _main_val = $('#section-' + _main).find('select').val();
                    }
                    
                    if (_vals.indexOf(_main_val) !== -1) {
                        $(_this).removeClass('ns-child-hide');
                    } else {
                        if (!$(_this).hasClass('ns-child-hide')) {
                            $(_this).addClass('ns-child-hide');
                        }
                    }
                }
            });
        }
    }).trigger('ns_main_child');
    
    $('body').on('change', '.section-switch .checkbox, .section-images .checkbox, .section-select select', function() {
        $('body').trigger('ns_main_child');
    });
    
    /**
     * Ajax field
     * 
     * @param {type} $
     * @returns {undefined}
     */
    $('body').on('click', '.nasa-init-ajax', function() {
        var _wrap = $(this).parents('.nasa-opt-ajax-wrap');
        $(_wrap).find('.nasa-info-ajax').hide();
        $(_wrap).find('.nasa-do-ajax').show();
    });
    
    $('body').on('click', '.nasa-cancel-ajax', function() {
        var _wrap = $(this).parents('.nasa-opt-ajax-wrap');
        $(_wrap).find('.nasa-info-ajax').show();
        $(_wrap).find('.nasa-do-ajax').hide();
    });
    
    $('body').on('click', '.nasa-apply-ajax', function() {
        if (!_disable_save) {
            _disable_save = true;

            var _this = $(this);
            var _wrap = $(_this).parents('.nasa-opt-ajax-wrap');
            var _action = $(_this).attr('data-action');
            var _old_val = $(_wrap).find('input.nasa-org-input').val();
            var _value = $(_wrap).find('input.nasa-do-ajax-input').val();

            if (_value && _value !== _old_val) {
                $.ajax({
                    url: ajaxurl,
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    data: {
                        action: _action,
                        data_value: _value
                    },
                    beforeSend: function() {
                        $(_wrap).addClass('nasa-loading');
                    },
                    success: function(res) {
                        if (res.success === 'ok') {
                            $(_wrap).find('.value-show').html(res.result);

                            $(_wrap).find('input.nasa-do-ajax-input').val(res.result).trigger('change');
                            $(_wrap).find('input.nasa-org-input').val(res.result).trigger('change');

                            $(_wrap).find('.nasa-ajax-mess').html(res.mess);
                            $(_wrap).find('.nasa-ajax-mess').show();
                            
                            $(_wrap).removeClass('nasa-loading');
                            
                            $(_wrap).find('.nasa-cancel-ajax').trigger('click');

                            setTimeout(function() {
                                _disable_save = false;
                            }, 100);
                            
                            setTimeout(function() {
                                $(_wrap).find('.nasa-ajax-mess').fadeOut(300);
                            }, 3000);
                        } else {
                            $(_wrap).find('.nasa-ajax-mess').html(res.mess);
                            $(_wrap).find('.nasa-ajax-mess').show();
                            
                            $(_wrap).removeClass('nasa-loading');

                            setTimeout(function() {
                                _disable_save = false;
                            }, 100);
                            
                            setTimeout(function() {
                                $(_wrap).find('.nasa-ajax-mess').fadeOut(300);
                            }, 3000);
                        }
                    },
                    error: function() {
                        $(_wrap).removeClass('nasa-loading');
                        
                        setTimeout(function() {
                            _disable_save = false;
                        }, 100);
                        
                        setTimeout(function() {
                            $(_wrap).find('.nasa-ajax-mess').fadeOut(300);
                        }, 3000);
                    }
                });
            } else {
                _disable_save = false;
            }
        }
    });
    
    $('body').on('change', '#white_lbl', function() {
        if ($(this).is(':checked')) {
            $('.nasa-online-doc').hide();
        } else {
            $('.nasa-online-doc').show();
        }
    });
    
    /**
     * 
     * Toggle Section
     */
    $('body').on('click', '.ns-toggle-section', function() {
        var _wrap = $(this).parents('.section');
        $(this).toggleClass('ns-hide');
        $(_wrap).toggleClass('ns-hide');
    });
    
    /**
     * 
     * Toggle Sections
     */
    $('body').on('click', '.ns-toggle-sections', function() {
        var _this = $(this);
        var _wrap = $(_this).parents('.section-info');
        var _show = $(_this).hasClass('ns-hide') ? true : false;
        if (_show) {
            $(_this).removeClass('ns-hide');
        }
        else {
            $(_this).addClass('ns-hide');
        }
        
        var _next = $(_wrap).next();
        ns_toggle_sections($, _next, _show);
    });
    
    /* $('body').on('ns_check_ct_categories', function() {
        if ($('#enable_nasa_custom_categories').length) {
            if ($('#enable_nasa_custom_categories').is(':checked')) {
                $('#section-nasa_custom_categories_slug').fadeIn(200);
                $('#section-archive_product_nasa_custom_categories').fadeIn(200);
                $('#section-max_level_nasa_custom_categories').fadeIn(200);
            }
            else {
                $('#section-nasa_custom_categories_slug').fadeOut(200);
                $('#section-archive_product_nasa_custom_categories').fadeOut(200);
                $('#section-max_level_nasa_custom_categories').fadeOut(200);
            }
        }
    }).trigger('ns_check_ct_categories');
    
    $('body').on('change', '#enable_nasa_custom_categories', function() {
        $('body').trigger('ns_check_ct_categories');
    }); */
    
    $('body').on('click', '.ns-show-less', function() {
        var _wrap = $(this).parents('.ns-show-less-wrap');
        if ($(_wrap).length) {
            $(_wrap).toggleClass('show-less');
        }
    });
    
    if ($('#wpwrap').length && $('.ns-need-update-core-notice').length) {
        var _padding = $('.ns-need-update-core-notice').outerHeight();
        $('#wpwrap').css({'padding-bottom': _padding});
    }

    $('body').on('keyup', '#search_otp', function(e) {
        var _str = $(this).val();
        var _expand_opts = $('body').find('#expand_options');
        var _section_info = null;

        if (typeof time_out_input !== 'undefined' && time_out_input) {
            clearTimeout(time_out_input);
        }

        time_out_input = setTimeout(function() {

            $('body').trigger('clear-search-otp');

            if (_str.trim().length >= 3) {
                if ($(_expand_opts).hasClass('expand')) {
                    $(_expand_opts).trigger('click');
                }

                $("#content .section").each(function() {
                    var _this = $(this);
                    var _pa = $(_this).parents('.group');
                    var _str2 = $(_this).find('h3.heading').text();

                    $('#content').addClass('opt-searching');

                    if ($(_this).hasClass('section-info')) {
                        _section_info = _this;
                    } else {
                        if (_str2.toUpperCase().includes(_str.toUpperCase().trim()) && !$(_this).hasClass('ns-child-hide')) {

                            $(_this).addClass('ns-opt-found');
        
                            if (!$(_pa).hasClass('ns-gr-found')) {
                                $(_pa).addClass('ns-gr-found');
                            }
        
                            if (!$(_section_info).hasClass('section-info-found') && $(_section_info).parents('.group').length) {
                                $(_section_info).addClass('section-info-found');
                                _section_info = null;
                            }
                        }
                    }
                });
            } else {
                $('#content').removeClass('opt-searching');
                
                if ($(_expand_opts).hasClass('close')) {
                    $(_expand_opts).trigger('click');
                }
            }
        },time_delay);
    });

    $('body').on('clear-search-otp', function() {
        $("#content .section").each(function() {
            var _this = $(this);
            var _pa = $(_this).parents('.group');

            if ($(_pa).hasClass('ns-gr-found')) {
                $(_pa).removeClass('ns-gr-found');
            }
            
            if ($(_this).hasClass('ns-opt-found')) {
                $(_this).removeClass('ns-opt-found');
            }

            if ($(_this).hasClass('section-info-found')) {
                $(_this).removeClass('section-info-found');
            }
        });
    });
    
    /**
     * Actived theme options menu
     */
    $('body').on('ns_check_theme_menu_current', function() {
        if ($('.toplevel_page_nasa-theme-options.wp-not-current-submenu .wp-submenu .current').length) {
            $('.toplevel_page_nasa-theme-options.wp-not-current-submenu').removeClass('wp-not-current-submenu').addClass('wp-has-current-submenu');
        }
    }).trigger('ns_check_theme_menu_current');
    
    $('body').on('ns_init_ns_hfe_type_edit', function() {
        if ($('.ns-hfe-type select').length) {
            $('.ns-hfe-type select').each(function() {
                var _this = $(this);
                var _wrap = $(_this).parents('.ns-hfe-type');
                var _href = $(_wrap).find('.nshfe-edit').length ? $(_wrap).find('.nshfe-edit').attr('data-href') : null;
                
                if (_href) {
                    var _id = $(_this).val();
                    
                    if (_id && _id !== '0') {
                        _href = _href.replace(/ns_hfe_id/g, _id);
                        $(_wrap).find('.nshfe-edit').attr('href', _href);
                        $(_wrap).find('.nshfe-edit').attr('target', '_blank');
                        $(_wrap).find('.nshfe-edit').show();
                    } else {
                        $(_wrap).find('.nshfe-edit').removeAttr('target');
                        $(_wrap).find('.nshfe-edit').attr('href', '#');
                        $(_wrap).find('.nshfe-edit').hide();
                    }
                }
                
            });
        }
    }).trigger('ns_init_ns_hfe_type_edit');
    
    $('body').on('change', '.ns-hfe-type select', function() {
        $('body').trigger('ns_init_ns_hfe_type_edit');
    });
    
    $('body').on('ns_init_ns_wpb_type_edit', function() {
        if ($('.ns-wpb-type select').length) {
            $('.ns-wpb-type select').each(function() {
                var _this = $(this);
                var _wrap = $(_this).parents('.ns-wpb-type');
                var _href = $(_wrap).find('.nswpb-edit').length ? $(_wrap).find('.nswpb-edit').attr('data-href') : null;
                
                if (_href) {
                    var _id = $(_this).find('option:selected').attr('data-id');
                    
                    if (_id && _id !== '0') {
                        _href = _href.replace(/ns_wpb_id/g, _id);
                        $(_wrap).find('.nswpb-edit').attr('href', _href);
                        $(_wrap).find('.nswpb-edit').attr('target', '_blank');
                        $(_wrap).find('.nswpb-edit').show();
                    } else {
                        $(_wrap).find('.nswpb-edit').removeAttr('target');
                        $(_wrap).find('.nswpb-edit').attr('href', '#');
                        $(_wrap).find('.nswpb-edit').hide();
                    }
                }
                
            });
        }
    }).trigger('ns_init_ns_wpb_type_edit');
    
    $('body').on('change', '.ns-wpb-type select', function() {
        $('body').trigger('ns_init_ns_wpb_type_edit');
    });
    
    $('body').on('ns_init_ns_blk_type_edit', function() {
        if ($('.ns-block-type select').length) {
            $('.ns-block-type select').each(function() {
                var _this = $(this);
                var _wrap = $(_this).parents('.ns-block-type');
                
                var _href_stb = $(_wrap).find('.nsblk-edit').length ? $(_wrap).find('.nsblk-edit').attr('data-stb-href') : null;
                var _href_ctb = $(_wrap).find('.nsblk-edit').length ? $(_wrap).find('.nsblk-edit').attr('data-ctb-href') : null;
                
                if (_href_stb && _href_ctb) {
                    var _id = $(_this).find('option:selected').attr('data-id');
                    var _type = $(_this).find('option:selected').attr('data-type');
                    
                    if (_id && _id !== '0') {
                        var _href = _type === 'nshfe' ? _href_ctb : _href_stb;
                        _href = _href.replace(/ns_blk_id/g, _id);
                        
                        $(_wrap).find('.nsblk-edit').attr('href', _href);
                        $(_wrap).find('.nsblk-edit').attr('target', '_blank');
                        $(_wrap).find('.nsblk-edit').show();
                    } else {
                        $(_wrap).find('.nsblk-edit').removeAttr('target');
                        $(_wrap).find('.nsblk-edit').attr('href', '#');
                        $(_wrap).find('.nsblk-edit').hide();
                    }
                }
                
            });
        }
    }).trigger('ns_init_ns_blk_type_edit');
    
    $('body').on('change', '.ns-block-type select', function() {
        $('body').trigger('ns_init_ns_blk_type_edit');
    });
    
    $('body').on('ns_init_ns_wpcf7_type_edit', function() {
        if ($('.ns-wpcf7-type select').length) {
            $('.ns-wpcf7-type select').each(function() {
                var _this = $(this);
                var _wrap = $(_this).parents('.ns-wpcf7-type');
                var _href = $(_wrap).find('.nswpcf7-edit').length ? $(_wrap).find('.nswpcf7-edit').attr('data-href') : null;
                
                if (_href) {
                    var _id = parseInt($(_this).val());
                    
                    if (_id) {
                        _href = _href.replace(/ns_wpcf7_id/g, _id);
                        $(_wrap).find('.nswpcf7-edit').attr('href', _href);
                        $(_wrap).find('.nswpcf7-edit').attr('target', '_blank');
                        $(_wrap).find('.nswpcf7-edit').show();
                    } else {
                        $(_wrap).find('.nswpcf7-edit').removeAttr('target');
                        $(_wrap).find('.nswpcf7-edit').attr('href', '#');
                        $(_wrap).find('.nswpcf7-edit').hide();
                    }
                }
                
            });
        }
    }).trigger('ns_init_ns_wpcf7_type_edit');
    
    $('body').on('change', '.ns-wpcf7-type select', function() {
        $('body').trigger('ns_init_ns_wpcf7_type_edit');
    });

    $('body').on('click', '.nasa-item-review-thumb .item-review-thumb-remove', function() {
        var _this = $(this),
            _pa = $(_this).parent('.nasa-item-review-thumb'),
            _input_id = $('.nasa-wrap-review-thumb').find('input[name="data-medias-id"]'),
            id_remove = $(_this).attr('data-id_media'),
            _ids = JSON.parse($(_input_id).val());
            
        _ids = _ids.filter(function(id) {
            return id != id_remove;
        });

        $(_input_id).val(JSON.stringify(_ids));

        $(_pa).remove();
    });

    $('body').on('click', '.nasa-wrap-review-thumb .media_upload_button', function(e) {
        e.preventDefault();
        var _input_id = $('.nasa-wrap-review-thumb').find('input[name="data-medias-id"]'),
            _ids = $(_input_id).val() ? JSON.parse($(_input_id).val()) : [];

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            multiple: true
        });

        mediaUploader.on('select', function() {
            var selection = mediaUploader.state().get('selection');
            var urls = [];

            selection.map(function(attachment) {
                var media = '';
                attachment = attachment.toJSON();
                _ids.push(attachment.id);
                
                if (attachment.mime.startsWith('video/')) {
                    media = '<video controls autoplay loop><source src="' + attachment.url + '" type="' + attachment.mime + '"></video>';
                } else {
                   media = '<img src="' + attachment.url + '"/>';
                }

                $('.nasa-wrap-review-thumb').find('.media_upload_button').before('<div class="nasa-item-review-thumb">' + media + '<a href="javascript:void(0);" data-id_media="' + attachment.id + '" class="item-review-thumb-remove button-primary"><svg class="ns-df-cart-svg" width="25" height="25" stroke-width="2" viewBox="0 0 24 24" fill="currentColor"><path d="M12 6V18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path><path d="M6 12H18" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path></svg></a></div>');
            });

            $(_input_id).val(JSON.stringify(_ids));
        });

        // Mở media uploader
        mediaUploader.open();
    });
    
    /* =============== End document ready !!! ================== */
});

function loadImgOpBreadcrumb($) {
    if ($('.nasa-breadcrumb-bg-option .screenshot').length && $('.nasa-breadcrumb-bg-option #breadcrumb_bg_upload').val() !== '') {
	if ($('.nasa-breadcrumb-bg-option .screenshot').html() === '') {
	    $('.nasa-breadcrumb-bg-option .screenshot').html('<img class="of-option-image" src="' + $('.nasa-breadcrumb-bg-option #breadcrumb_bg_upload').val() + '" />');
	    $('.upload_button_div .remove-image').removeClass('hide').show();
	}
    }
}

function loadColorDefault($, _warp, _taxonomy, _num, _instance, _check) {
    if (_check && $(_warp).find('.nasa_p_color').length) {
        var _this = $(_warp).find('.nasa_p_color');
        $(_this).find('input').prop('disabled', false);
        $(_this).show();
    }else{
        _instance = _instance.toLocaleString();
        $.ajax({
	    url: ajaxurl,
	    type: 'post',
	    dataType: 'html',
	    data: {
		action: 'nasa_list_colors_admin',
                taxonomy: _taxonomy,
		num: _num,
                instance: _instance
	    },
	    success: function(res) {
                $(_warp).find('.nasa_p_color').remove();
		$(_warp).append(res);
                loadColorPicker($);
	    }
	});
    }
}

function unloadColor($, _warp) {
    var _this = $(_warp).find('.nasa_p_color');
    $(_this).find('input').prop('disabled', true);
    $(_this).hide();
}

function loadColorPicker($) {
    $('.nasa-color-field').each(function() {
        if ($(this).parents('.wp-picker-container').length < 1) {
            $(this).wpColorPicker();
        }
    });
};

function loadListIcons($) {
    if ($('.nasa-list-icons-select').length < 1) {
	$.ajax({
	    url: ajaxurl,
	    type: 'get',
	    dataType: 'html',
	    data: {
		action: 'nasa_list_fonts_admin',
		fill: ''
	    },
	    success: function(res) {
		$('body').append(res);
	    }
	});
    }
};

function searchIcons($) {
    var _textsearch = $.trim($('.nasa-input-search-icon').val());
    if (_textsearch === '') {
        $('.nasa-font-icons').fadeIn(200);
    } else {
        var patt = new RegExp(_textsearch);
        $('.nasa-font-icons').each(function() {
            var _sstext = $(this).attr('data-text');
            if (patt.test(_sstext)) {
                $(this).fadeIn(200);
            } else {
                $(this).fadeOut(200);
            }
        });
    }
}

function ns_toggle_sections($, _tag, _show) {
    if ($(_tag).length && !$(_tag).hasClass('section-info')) {
        if (_show) {
            $(_tag).slideDown(200);
        } else {
            $(_tag).slideUp(200);
        }
        
        var _next = $(_tag).next();
        
        ns_toggle_sections($, _next, _show);
    }
}
