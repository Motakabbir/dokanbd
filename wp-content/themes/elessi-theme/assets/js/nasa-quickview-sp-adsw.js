/**
 * Document Ready !!!
 */
jQuery(document).ready(function($) {
    "use strict";
    
    $('body').on('click', '.product-lightbox .adsw-attribute-option .sku-set', function() {
        var _this = $(this);

        if (!$(_this).hasClass('active') && !$(_this).hasClass('sku-disabled')) {
            var _val = $(_this).attr('data-value');
            var _wrap = $(_this).parents('td.value');
            var _select = $(_wrap).find('select');
            var _ops = $(_this).parents('.adsw-attribute-option');

            $(_ops).find('.sku-set').removeClass('active');
            $(_this).addClass('active');
            $(_select).val(_val).trigger('change');
        }
    });
			
    $('body').on("check_variations", function () {
        var _form = $('.product-lightbox form.variations_form');

        if ($(_form).length) {
            $(_form).find(".adsw-attribute-option").each(function () {
                var _adsw = $(this);
                var _wrap = $(_adsw).parents('td.value');
                var _select = $(_wrap).find('select');

                $(_adsw).find('.sku-set:not(.active)').each(function() {
                    var _item = $(this);
                    var _value = $(_item).attr('data-value');
                    var _option = $(_select).find('option[value="' + _value + '"]').attr('disabled');

                    if (
                        $(_select).find('option[value="' + _value + '"]').length <= 0 ||
                        typeof _option !== 'undefined'
                    ) {
                        if (!$(_item).hasClass('sku-disabled')) {
                            $(_item).addClass('sku-disabled');
                        }
                    }
                });
            });
        }
    });
			
    $('body').on('click', '.reset_variations', function () {
        var _wrap = $(this).parents('.product-lightbox');
        if ($(_wrap).length && $(_wrap).find('form.variations_form').length) {
            var _form = $(_wrap).find('form.variations_form');
            $(_form).find(".sku-set").removeClass("active").removeClass("sku-disabled");
        }
    });
});
