<?php
add_action('init', 'elessi_footer_heading');
if (!function_exists('elessi_footer_heading')) {
    function elessi_footer_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }

        $static_blocks = elessi_admin_get_static_blocks();
        
        $of_options[] = array(
            "name" => __("Footer Global", 'elessi-theme'),
            "target" => 'footer-global',
            "type" => "heading"
        );
        
        $of_options[] = array(
            "name" => __("Footer Options", 'elessi-theme'),
            "std" => "<h4>" . __("Footer Options", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        /**
         * Disable Footer Build In
         */
        $of_options[] = array(
            "name" => __("Footer Built-In Support (Widgets Builder)", 'elessi-theme'),
            "id" => "f_buildin",
            "std" => 0,
            "type" => "switch",
            "desc" => '<span class="nasa-warning red-color">' . __("Recommend Turn Off to use Builder Mode", 'elessi-theme') . '</span>',
        );
        
        $modes = array(
            "build-in" => __("Built-in - Widgets Place", 'elessi-theme'),
        );
        
        if (NASA_WPB_ACTIVE || !apply_filters('nasa_rules_upgrade', true)) {
            $modes["builder"] = __("Builder - Suport WPBakery", 'elessi-theme');
        }
        
        if (NASA_HF_BUILDER) {
            $modes["builder-e"] = __("Builder - Support HFE-Elementor", 'elessi-theme');
        }
        
        $of_options[] = array(
            "name" => __("Mode", 'elessi-theme'),
            "id" => "footer_mode",
            "std" => 'builder',
            "type" => "select",
            "options" => $modes,
            // 'class' => 'nasa-theme-option-parent'
        );
        
        /**
         * Footer Build-in Desktop
         */
        $of_options[] = array(
            "name" => __("Footer Layout", 'elessi-theme'),
            "id" => "footer_build_in",
            "type" => "select",
            'override_numberic' => true,
            "options" => array(
                '1' => __("Built-in Light 1", 'elessi-theme'),
                '2' => __("Built-in Light 2", 'elessi-theme'),
                '3' => __("Built-in Light 3", 'elessi-theme'),
                '4' => __("Built-in Dark", 'elessi-theme')
            ),
            'std' => '2',
            'class' => 'nasa-footer_mode',
            'child_of' => 'footer_mode',
            'm_target' => array('build-in'),
        );
        
        /**
         * Footer Build-in Mobile
         */
        $of_options[] = array(
            "name" => __("Footer Mobile Layout", 'elessi-theme'),
            "id" => "footer_build_in_mobile",
            "type" => "select",
            'override_numberic' => true,
            "options" => array(
                '' => __("Extends from Desktop", 'elessi-theme'),
                'm-1' => __("Build-in Mobile", 'elessi-theme')
            ),
            'std' => '',
            'class' => 'nasa-footer_mode nasa-footer_mode-build-in nasa-theme-option-child',
            'child_of' => 'footer_mode',
            'm_target' => array('build-in'),
        );
        
        /**
         * Footers Builder
         */
        $footers_options = elessi_admin_get_footer_builder();
        
        $footers_desk = array_merge(
            array('default' => __('Select the Footer Type', 'elessi-theme')),
            $footers_options
        );
        $footers_mobile = array_merge(
            array('default' => __('Extends from Desktop', 'elessi-theme')),
            $footers_options
        );
        
        /**
         * Footer Desktop
         */
        $of_options[] = array(
            "name" => __("Footer Layout", 'elessi-theme'),
            "id" => "footer-type",
            "type" => "select2id",
            'override_numberic' => true,
            "options" => $footers_desk,
            'std' => 'default',
            'select_class' => 'nasa-ad-select2',
            'class' => 'nasa-footer_mode ns-wpb-type',
            'desc' => '<a class="nswpb-edit hidden-tag" href="#" data-href="' . esc_url(admin_url('post.php?post=ns_wpb_id&action=edit')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'footer_mode',
            'm_target' => array('builder'),
        );
        
        /**
         * Footer Mobile
         */
        $of_options[] = array(
            "name" => __("Footer Mobile Layout", 'elessi-theme'),
            "id" => "footer-mobile",
            "type" => "select2id",
            'override_numberic' => true,
            "options" => $footers_mobile,
            'std' => 'default',
            'select_class' => 'nasa-ad-select2',
            'class' => 'nasa-footer_mode ns-wpb-type',
            'desc' => '<a class="nswpb-edit hidden-tag" href="#" data-href="' . esc_url(admin_url('post.php?post=ns_wpb_id&action=edit')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'footer_mode',
            'm_target' => array('builder'),
        );
        
        /**
         * Footers Elementor Builder
         */
        $footers_options = elessi_admin_get_footer_elementor();
        $footers_desk = $footers_options;
        $footers_desk['0'] = __('Select the Footer Elementor', 'elessi-theme');
        $footers_mobile = $footers_options;
        $footers_mobile['0'] = __('Extends from Desktop', 'elessi-theme');
        
        /**
         * Footer Desktop
         */
        $of_options[] = array(
            "name" => __("Footer Layout", 'elessi-theme'),
            "id" => "footer_elm",
            "type" => "select",
            'override_numberic' => true,
            "options" => $footers_desk,
            'std' => 'default',
            'select_class' => 'nasa-ad-select2',
            'class' => 'nasa-footer_mode ns-hfe-type',
            'desc' => '<a class="nshfe-edit hidden-tag" href="#" data-href="' . esc_url(admin_url('post.php?post=ns_hfe_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'footer_mode',
            'm_target' => array('builder-e'),
        );
        
        /**
         * Footer Mobile
         */
        $of_options[] = array(
            "name" => __("Footer Mobile Layout", 'elessi-theme'),
            "id" => "footer_elm_mobile",
            "type" => "select",
            'override_numberic' => true,
            "options" => $footers_mobile,
            'std' => 'default',
            'select_class' => 'nasa-ad-select2',
            'class' => 'nasa-footer_mode ns-hfe-type',
            'desc' => '<a class="nshfe-edit hidden-tag" href="#" data-href="' . esc_url(admin_url('post.php?post=ns_hfe_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'footer_mode',
            'm_target' => array('builder-e'),
        );

        $of_options[] = array(
            "name" => __("Popup Static Block", 'elessi-theme'),
            "id" => "nasa_popup_static_block",
            "type" => "select2id",
            "options" => $static_blocks,
            'select_class' => 'nasa-ad-select2',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
        );
    }
}
