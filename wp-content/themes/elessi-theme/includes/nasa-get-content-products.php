<?php
if (wc_get_loop_prop('total')) :
    global $nasa_opt;

    $_delay = $count = 0;
    $_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;

    while (have_posts()) :
        the_post();
        
        /**
         * Hook: woocommerce_shop_loop.
         */
        do_action('woocommerce_shop_loop');
        
        wc_get_template(
            'content-product.php',
            array(
                '_delay' => $_delay,
                'wrapper' => 'li'
            )
        );
        $_delay += $_delay_item;
        $count++;
        
    endwhile;
    
endif;
