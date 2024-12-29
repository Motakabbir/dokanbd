<?php
add_action('init', 'elessi_white_label_options_heading', 99999);
if (!function_exists('elessi_white_label_options_heading')) {
    function elessi_white_label_options_heading() {
        // Set the Options Array
        global $of_options;
        if (empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => "White Label",
            "target" => "white-label",
            "type" => "heading",
        );

        $of_options[] = array(
            "name" => "White Label",
            // "desc" => "Hide Online documentation",
            "id" => "white_lbl",
            "std" => 0,
            "type" => "switch"
        );
        
        $of_options[] = array(
            "name" => "Theme Name",
            "desc" => 'Replace all instances of "Default Theme"',
            "id" => "white_lbl_name",
            "std" => "",
            "type" => "text"
        );
    }
}
