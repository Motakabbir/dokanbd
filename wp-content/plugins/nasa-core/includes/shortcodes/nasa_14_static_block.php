<?php
/**
 * Shortcode [nasa_get_static_block ...]
 * 
 * @param type $atts
 * @param type $content
 * @return type
 */
function nasa_get_static_block($atts = array(), $content = null) {
    global $nasa_opt;
    
    $dfAttr = array(
        'title' => '',
        'block_id' => '',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    if ($block_id) {
        /**
         * Cache shortcode
         */
        $key = false;
        if (isset($nasa_opt['nasa_cache_shortcodes']) && $nasa_opt['nasa_cache_shortcodes']) {
            $key = nasa_key_shortcode('nasa_get_static_block', $dfAttr, $atts);
            $content = nasa_get_cache_shortcode($key);
        }
        
        if (!$content) {
            ob_start();
            ?>
            <div class="nasa-static-block<?php echo $el_class != '' ? ' ' . $el_class : ''; ?>" >
                <?php if ($title) { ?>
                    <h5 class="section-title">
                        <?php echo esc_attr($title); ?>
                    </h5>
                <?php } ?>
                <div class="nasa-static-block-container">
                    <?php echo nasa_block_shortcode(array('id' => $block_id)); ?>
                </div>
            </div>
            <?php
            $content = ob_get_clean();
            
            if ($content) {
                nasa_set_cache_shortcode($key, $content);
            }
        }
        
        return $content;
    }
}

/**
 * Register Params
 */
function nasa_register_static_block() {
    $blocks = get_posts(
        array(
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'post_type' => 'nasa_block'
        )
    );
    $option_blocks = array(__("Select block", 'nasa-core') => '');
    if ($blocks) {
        foreach ($blocks as $block) {
            $option_blocks[$block->post_title] = $block->ID;
        }
    }

    $params = array(
        "name" => "Static Block",
        "base" => "nasa_get_static_block",
        'icon' => 'icon-wpb-nasatheme',
        'description' => __("Display shortcode static block.", 'nasa-core'),
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __("Title", 'nasa-core'),
                "param_name" => "title"
            ),
            array(
                'type' => 'dropdown',
                'heading' => __('Blocks', 'nasa-core'),
                'param_name' => 'block_id',
                "value" => $option_blocks,
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra Class", 'nasa-core'),
                "param_name" => "el_class",
                "description" => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'nasa-core')
            )
        )
    );
    
    vc_map($params);
}
