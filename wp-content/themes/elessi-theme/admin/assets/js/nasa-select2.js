jQuery(document).ready(function($){
    "use strict";
    
    $('body').on('nasa_admin_init_select2', function() {
        if ($('select.nasa-ad-select2:not(.nasa-inited)').length) {
            $('select.nasa-ad-select2:not(.nasa-inited)').each(function() {
                $(this).addClass('nasa-inited');
                $(this).select2();
            });
        }
    }).trigger('nasa_admin_init_select2');
    
    /* =============== End document ready !!! ================== */
});
