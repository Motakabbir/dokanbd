/**
 * Document nasa-core ready
 */
jQuery(document).ready(function($) {
    "use strict";

    $('body').on('click', '.anphabet-filters', function() {
        var _this = $(this);
        var _wrap = $(_this).parents('.nasa-brands-anphabets');
        
        if (!$(_wrap).hasClass('filtering')) {
            $(_wrap).addClass('filtering');
            
            if ($(_this).hasClass('all')) {
                $(_wrap).find('.anphabet-filters.anphabet-item').removeClass('active');
            } else {
                $(_this).toggleClass('active');
            }
            
            setTimeout(function() {
                $('body').trigger('nasa_anphabet_filtering', [_wrap]);
            }, 10);
        }
    });
    
    $('body').on('nasa_anphabet_filtering', function(e, _wrap) {
        if ($(_wrap).find('.anphabet-item.active').length === 0) {
            $(_wrap).find('.brand-item').removeClass('nasa-disabled');
        } else {
            $(_wrap).find('.brand-item').each(function() {
                var _alphabet = $(this).attr('data-anphabet');
                
                if ($(_wrap).find('.anphabet-item.active[data-anphabet="' + _alphabet + '"]').length) {
                    $(this).removeClass('nasa-disabled');
                } else {
                    if (!$(this).hasClass('nasa-disabled')) {
                        $(this).addClass('nasa-disabled');
                    }
                }
            });
        }
        
        $(_wrap).find('.brand-item:not(.nasa-disabled)').fadeIn(200);
        $(_wrap).find('.brand-item.nasa-disabled').fadeOut(200);
        
        setTimeout(function() {
            $(_wrap).removeClass('filtering');
        }, 350);
    });
});
