<?php
add_action('init', 'elessi_promo_popup_heading');
if (!function_exists('elessi_promo_popup_heading')) {

    function elessi_promo_popup_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }

        $static_blocks = elessi_admin_get_static_blocks();

        $of_options[] = array(
            "name" => __("Newsletter Popup", 'elessi-theme'),
            "target" => 'promo-popup',
            "type" => "heading"
        );

        $of_options[] = array(
            "name" => __("Newsletter", 'elessi-theme'),
            "std" => "<h4>" . __("Newsletter", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );
        
        $of_options[] = array(
            "name" => __("Newsletter", 'elessi-theme'),
            "id" => "promo_popup",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => __("Hide in Mobile (width site small less 640px OR Mobile Layout)", 'elessi-theme'),
            "desc" => __("Yes, Please!", 'elessi-theme'),
            "id" => "disable_popup_mobile",
            "std" => 0,
            "type" => "checkbox",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Only Display 1 Time", 'elessi-theme'),
            "id" => "promo_popup_1_time",
            "std" => 0,
            "type" => "switch",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Popup Width", 'elessi-theme'),
            "id" => "pp_width",
            "std" => "734",
            "type" => "text",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Popup Height", 'elessi-theme'),
            "id" => "pp_height",
            "std" => "501",
            "type" => "text",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Popup Content", 'elessi-theme'),
            "id" => "pp_content",
            "std" => '<h3>Newsletter</h3><p>Be the first to know about our new arrivals, exclusive offers and the latest fashion update.</p>',
            "type" => "textarea",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Select Contact Form", 'elessi-theme'),
            "id" => "pp_contact_form",
            "type" => "select",
            'override_numberic' => true,
            "options" => elessi_get_contact_form7(),
            'class' => 'ns-wpcf7-type',
            'select_class' => 'nasa-ad-select2',
            'desc' => '<a class="nswpcf7-edit hidden-tag" href="#" data-href="' . esc_url(admin_url('admin.php?page=wpcf7&post=ns_wpcf7_id&action=edit')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Content Width", 'elessi-theme'),
            "id" => "pp_style",
            "std" => "simple",
            "type" => "select",
            "options" => array(
                "simple" => __("50%", 'elessi-theme'),
                "full" => __("Full Width", 'elessi-theme')
            ),
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Popup Background Color", 'elessi-theme'),
            "id" => "pp_background_color",
            "std" => "#fff",
            "type" => "color",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Popup Background", 'elessi-theme'),
            "id" => "pp_background_image",
            "std" => ELESSI_THEME_URI . '/assets/images/newsletter_bg.jpg',
            "type" => "media",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );
        
        $of_options[] = array(
            "name" => __("Delay time to show (seconds)", 'elessi-theme'),
            "id" => "delay_promo_popup",
            "std" => 0,
            "type" => "text",
            'child_of' => 'promo_popup',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Popup Exit Intent", 'elessi-theme'),
            "std" => "<h4>" . __("Popup Exit Intent", 'elessi-theme') . "</h4>",
            "type" => "info",
            'class' => 'first'
        );

        $of_options[] = array(
            "name" => __("Popup Exit Intent", 'elessi-theme'),
            "id" => "ns_popup_exit_intent",
            "std" => 0,
            "type" => "switch",
            "desc" => __("When you move your mouse outside the page you are interacting with, there will be a pop-up window containing the information you selected in the section (Popup Exit Intent Content).", 'elessi-theme'),
        );

        $of_options[] = array(
            "name" => __("Set Popup Repeat Time", 'elessi-theme'),
            "id" => "popup_exit_intent_repeat_time",
            "std" => 24,
            "type" => "text",
            'child_of' => 'ns_popup_exit_intent',
            'm_target' => '1',"desc" => __("The time unit in the line is calculated in hours and must be greater than 0. EX: 24, 32, 48,..", 'elessi-theme'),
        );

        $of_options[] = array(
            "name" => __("Popup Exit Intent Content", 'elessi-theme'),
            "id" => "ns_popup_exit_intent_ct",
            "type" => "select2id",
            "options" => $static_blocks,
            'select_class' => 'nasa-ad-select2',
            'class' => 'ns-block-type',
            "desc" => __("Please create Static Blocks (or Custom Block of Elementor Header & Footer Builder) and select here.", 'elessi-theme') . '<br /><a class="nsblk-edit hidden-tag" href="#" data-stb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=edit')) . '" data-ctb-href="' . esc_url(admin_url('post.php?post=ns_blk_id&action=elementor')) . '">' . esc_html__('Click here to Edit', 'elessi-theme') . '</a>',
            'child_of' => 'ns_popup_exit_intent',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Popup Exit Intent Width (Max)", 'elessi-theme'),
            "id" => "pp_ex_width",
            "std" => "900",
            "type" => "text",
            "desc" => __("This width applies to desktops and medium screens (screens with a width smaller than the width you are setting will automatically have a width of 90% of the full screen).", 'elessi-theme'),
            'child_of' => 'ns_popup_exit_intent',
            'm_target' => '1',
        );

        $of_options[] = array(
            "name" => __("Popup Exit Intent Background Color", 'elessi-theme'),
            "id" => "pp_exit_background_color",
            "std" => "#fff",
            "type" => "color",
            'child_of' => 'ns_popup_exit_intent',
            'm_target' => '1',
        );
    }
}

/**
 * Get list Contact Form 7
 * @return type
 */
function elessi_get_contact_form7() {
    $contacts_form = function_exists('nasa_get_contact_form7') ? nasa_get_contact_form7() : array();
    $contacts = array('default' => __('Select the Contact Form', 'elessi-theme'));
    
    if (!empty($contacts_form)) {
        foreach ($contacts_form as $id => $form) {
            if ($id) {
                $contacts[$id] = $form;
            }
        }
    }
    
    return $contacts;
}
