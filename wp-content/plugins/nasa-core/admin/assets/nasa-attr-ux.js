jQuery(document).ready(function ($) {
    'use strict';
    if (typeof wp === 'undefined') {
        var wp = window.wp;
    }
    
    $('input.ns-color-picker').wpColorPicker({
        change: function () {
            setTimeout(function() {
                var _val = '';
        
                $('input.ns-color-picker').each(function () {
                    var _cval = $(this).val();
                    if (_cval !== '') {
                        _val += _val !== '' ? ',' + _cval : _cval;
                    }
                });

                $('#ns-values-colors').val(_val).trigger('change');
            }, 10);
        },
        clear: function () {
            setTimeout(function() {
                var _val = '';
        
                $('input.ns-color-picker').each(function () {
                    var _cval = $(this).val();
                    if (_cval !== '') {
                        _val += _val !== '' ? ',' + _cval : _cval;
                    }
                });

                $('#ns-values-colors').val(_val).trigger('change');
            }, 10);
        }
    });

    // Toggle add new attribute term modal
    var $modal = $('#nasa-attr-ux-modal-container'),
        $spinner = $modal.find('.spinner'),
        $msg = $modal.find('.message'),
        $metabox = null;

    $('body').on('click', '.nasa-attr-ux_add_new_attribute', function (e) {
        e.preventDefault();
        
        var $button = $(this),
            taxInputTemplate = wp.template('nasa-attr-ux-input-tax'),
            data = {
                type: $button.data('type'),
                tax: $button.closest('.woocommerce_attribute').data('taxonomy')
            };

        // Insert input
        $modal.find('.nasa-attr-ux-term-val').html($('#tmpl-nasa-attr-ux-input-' + data.type).html());
        $modal.find('.nasa-attr-ux-term-tax').html(taxInputTemplate(data));

        if ('nasa_color' === data.type) {
            $modal.find('input.nasa-attr-ux-input-color').wpColorPicker();
        }

        $metabox = $button.closest('.woocommerce_attribute.wc-metabox');
        $modal.show();
    }).on('click', '.nasa-attr-ux-modal-close, .nasa-attr-ux-modal-backdrop', function (e) {
        e.preventDefault();
        ns_close_modal();
    });

    // Send ajax request to add new attribute term
    $('body').on('click', '.nasa-attr-ux-new-attribute-submit', function (e) {
        e.preventDefault();

        var $button = $(this),
            type = $button.data('type'),
            error = false,
            data = {};

        // Validate
        $modal.find('.nasa-attr-ux-input').each(function () {
            var $this = $(this);

            if ($this.attr('name') !== 'slug' && !$this.val()) {
                $this.addClass('error');
                error = true;
            } else {
                $this.removeClass('error');
            }

            data[$this.attr('name')] = $this.val();
        });

        if (error) {
            return;
        }

        // Send ajax request
        $spinner.addClass('is-active');
        $msg.hide();
        wp.ajax.send('nasa_attr_ux_add_new_attribute', {
            data: data,
            error: function (res) {
                $spinner.removeClass('is-active');
                $msg.addClass('error').text(res).show();
            },
            success: function (res) {
                $spinner.removeClass('is-active');
                $msg.addClass('success').text(res.msg).show();

                $metabox.find('select.attribute_values').append('<option value="' + res.id + '" selected="selected">' + res.name + '</option>');
                $metabox.find('select.attribute_values').trigger('change');

                ns_close_modal();
            }
        });
    });

    /**
     * Close modal
     */
    function ns_close_modal() {
        $modal.find('.nasa-attr-ux-term-name input, .nasa-attr-ux-term-slug input').val('');
        $spinner.removeClass('is-active');
        $msg.removeClass('error success').hide();
        $modal.hide();
    }
});
