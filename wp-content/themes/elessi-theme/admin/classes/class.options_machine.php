<?php

/**
 * SMOF Options Machine Class
 *
 * @package     WordPress
 * @subpackage  SMOF
 * @since       1.0.0
 * @author      Syamil MJ
 */
class Options_Machine {
    
    public $Inputs;
    public $Menu;
    public $Defaults;

    /**
     * PHP5 Contructor
     *
     * @since 1.0.0
     */
    public function __construct($options) {
        $return = self::optionsframework_machine($options);

        $this->Inputs = $return[0];
        $this->Menu = $return[1];
        $this->Defaults = $return[2];
    }

    /**
     * Sanitize option
     *
     * Sanitize & returns default values if don't exist
     * 
     * Notes:
      - For further uses, you can check for the $value['type'] and performs
      more speficic sanitization on the option
      - The ultimate objective of this function is to prevent the "undefined index"
      errors some authors are having due to malformed options array
     */
    public static function sanitize_option($value) {
        $defaults = array(
            "name" => "",
            "desc" => "",
            "id" => "",
            "std" => "",
            "mod" => "",
            "type" => ""
        );

        $value = wp_parse_args($value, $defaults);

        return $value;
    }

    /**
     * Process options data and build option fields
     *
     * @uses get_theme_mod()
     *
     * @access public
     * @since 1.0.0
     *
     * @return array
     */
    public static function optionsframework_machine($options) {
        global $smof_output, $smof_details, $smof_data;
        
        if (empty($options)) {
            return;
        }
        
        if (empty($smof_data)){
            $smof_data = of_get_options();
        }
        
        $data = $smof_data;

        $defaults = array();
        $counter = 0;
        $menu = '';
        $output = '';
        $update_data = false;

        do_action('optionsframework_machine_before', array(
            'options' => $options,
            'smof_data' => $smof_data,
        ));
        
        if ($smof_output != "") {
            $output .= $smof_output;
            $smof_output = "";
        }
        
        // $k = 0;
        // $info = false;
        foreach ($options as $value) {
            // sanitize option
            if ($value['type'] != "heading") {
                $value = self::sanitize_option($value);
            }
            
            $counter++;

            //create array of defaults		
            if ($value['type'] == 'multicheck') {
                if (is_array($value['std'])) {
                    foreach ($value['std'] as $i => $key) {
                        $defaults[$value['id']][$key] = true;
                    }
                } else {
                    $defaults[$value['id']][$value['std']] = true;
                }
            } else {
                if (isset($value['id'])) {
                    $defaults[$value['id']] = $value['std'];
                }
            }

            /* condition start */
            if (!empty($smof_data) || !empty($data)) {

                if (array_key_exists('id', $value) && !isset($smof_data[$value['id']])) {
                    $smof_data[$value['id']] = $value['std'];
                    if ($value['type'] == "checkbox" && $value['std'] == 0) {
                        $smof_data[$value['id']] = 0;
                    } else {
                        $update_data = true;
                    }
                }
                
                if (array_key_exists('id', $value) && !isset($smof_details[$value['id']])) {
                    $smof_details[$value['id']] = $smof_data[$value['id']];
                }

                //Start Heading
                if ($value['type'] != "heading") {
                    $attributes = array();
                    
                    if (isset($value['id']) && $value['id']) {
                        $attributes[] = 'id="section-' . $value['id'] . '"';
                        // $attributes[] = 'data-target="' . $value['id'] . '"';
                    }
                    
                    if (isset($value['child_of']) && $value['child_of']) {
                        $attributes[] = 'data-child_of="' . $value['child_of'] . '"';
                    }
                    
                    if (isset($value['m_target']) && $value['m_target']) {
                        $target_show = is_array($value['m_target']) ? implode(',', $value['m_target']) : $value['m_target'];
                        $attributes[] = 'data-target="' . $target_show . '"';
                    }
                    
                    $class = 'section section-' . $value['type'];
                    $class .= isset($value['class']) ? ' ' . $value['class'] : '';
                    
                    //hide items in checkbox group
                    if (array_key_exists("fold", $value)) {
                        $class .= (isset($smof_data[$value['fold']]) && $smof_data[$value['fold']]) ? " f_" . $value['fold'] . " " : " f_" . $value['fold'] . " temphide ";
                    }
                    
                    $attributes[] = 'class="' . $class . '"';
                    
                    if (isset($value['data-class_show'])) {
                        $attributes[] = 'data-class_show="' . esc_attr($value['data-class_show']) . '"';
                    }

                    $output .= '<div ' . implode(' ', $attributes) . '>' . "\n";

                    //only show header if 'name' value exists
                    if ($value['name']) {
                        $output .= '<h3 class="heading">' . $value['name'] . '</h3>' . "\n";
                    }
                    
                    $output .= $value['type'] != "info" ? '<a class="ns-toggle-section"></a>' : '<a class="ns-toggle-sections"></a>';
                    
                    $output .= '<div class="option">' . "\n" . '<div class="controls">' . "\n";
                }
                //End Heading

                //switch statement to handle various options type                              
                switch ($value['type']) {

                    //text input
                    case 'text':
                    case 'password':
                        $t_value = '';
                        $t_value = stripslashes($smof_data[$value['id']]);
                        $t_value = str_replace('"', "'", $t_value);
                        
                        $mini = '';
                        if (isset($value['mod']) && $value['mod'] == 'mini') {
                            $mini .= ' mini';
                        }

                        $output .= '<input class="of-input' . $mini . '" name="' . $value['id'] . '" id="' . $value['id'] . '" type="' . $value['type'] . '" value="' . $t_value . '" />';
                        
                        break;

                    //select option
                    case 'select':
                        $mini = '';
                        if (!isset($value['mod'])) {
                            $value['mod'] = '';
                        }
                        
                        if ($value['mod'] == 'mini') {
                            $mini = 'mini';
                        }
                        
                        $select_class = 'select of-input';
                        $select_class .= isset($value['select_class']) && $value['select_class'] ? ' ' . $value['select_class'] : '';
                        
                        $output .= '<div class="select_wrapper' . ($mini ? ' ' . $mini : '') . '">';
                        $output .= '<select class="' . $select_class . '" name="' . $value['id'] . '" id="' . $value['id'] . '">';

                        if (!empty($value['options'])) {
                            foreach ($value['options'] as $select_ID => $option) {
                                $theValue = $option;
                                
                                if (!is_numeric($select_ID) || isset($value['override_numberic'])) {
                                    $theValue = $select_ID;
                                }
                                
                                $output .= '<option value="' . $theValue . '" ' . selected($smof_data[$value['id']], $theValue, false) . '>' . $option . '</option>';
                            }
                        }
                        
                        $output .= '</select></div>';
                        
                        break;
                        
                        //select option
                    case 'select2id':
                        $mini = '';
                        if (!isset($value['mod'])) {
                            $value['mod'] = '';
                        }
                        
                        if ($value['mod'] == 'mini') {
                            $mini = 'mini';
                        }
                        
                        $select_class = 'select of-input';
                        $select_class .= isset($value['select_class']) && $value['select_class'] ? ' ' . $value['select_class'] : '';
                        
                        $output .= '<div class="select_wrapper' . ($mini ? ' ' . $mini : '') . '">';
                        $output .= '<select class="' . $select_class . '" name="' . $value['id'] . '" id="' . $value['id'] . '">';

                        if (!empty($value['options'])) {
                            foreach ($value['options'] as $key => $karr) {
                                $attr_ext = '';
                                
                                if (is_array($karr)) {
                                    $dt_tit = $karr[1];
                                    
                                    $attr_ext .= 'data-id="' . $karr[0] . '" ';
                                    $attr_ext .= isset($karr[2]) && $karr[2] ? 'data-type="' . $karr[2] . '" ' : '';
                                } else {
                                    $dt_tit = $karr;
                                    
                                    $attr_ext .= 'data-id="0" ';
                                }
                                
                                $output .= '<option ' . $attr_ext . 'value="' . $key . '" ' . selected($smof_data[$value['id']], $key, false) . '>' . $dt_tit . '</option>';
                            }
                        }
                        
                        $output .= '</select></div>';
                        
                        break;

                    //textarea option
                    case 'textarea':
                        $cols = '8';
                        $ta_value = '';

                        if (isset($value['options'])) {
                            $ta_options = $value['options'];
                            if (isset($ta_options['cols'])) {
                                $cols = $ta_options['cols'];
                            }
                        }

                        $ta_value = stripslashes($smof_data[$value['id']]);
                        $output .= '<textarea class="of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" cols="' . $cols . '" rows="8">' . $ta_value . '</textarea>';
                        
                        break;

                    //radiobox option
                    case "radio":
                        $checked = (isset($smof_data[$value['id']])) ? checked($smof_data[$value['id']], $option, false) : '';
                        foreach ($value['options'] as $option => $name) {
                            $output .= '<input class="of-input of-radio" name="' . $value['id'] . '" type="radio" value="' . $option . '" ' . checked($smof_data[$value['id']], $option, false) . ' /><label class="radio">' . $name . '</label><br />';
                        }
                        
                        break;

                    //checkbox option
                    case 'checkbox':
                        if (!isset($smof_data[$value['id']])) {
                            $smof_data[$value['id']] = 0;
                        }

                        $fold = '';
                        if (array_key_exists("folds", $value)) {
                            $fold = "fld ";
                        }

                        $output .= '<input type="hidden" class="' . $fold . 'checkbox of-input" name="' . $value['id'] . '" value="0" />';
                        $output .= '<input type="checkbox" class="' . $fold . 'checkbox of-input" name="' . $value['id'] . '" id="' . $value['id'] . '" value="1" ' . checked($smof_data[$value['id']], 1, false) . ' />';
                        
                        break;

                    //multiple checkbox option
                    case 'multicheck':
                        $multi_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $defaults[$value['id']];

                        foreach ($value['options'] as $key => $option) {
                            if (!isset($multi_stored[$key])) {
                                $multi_stored[$key] = '';
                            }
                            
                            $of_key_string = $value['id'] . '_' . $key;
                            $output .= '<input type="checkbox" class="checkbox of-input" name="' . $value['id'] . '[' . $key . ']' . '" id="' . $of_key_string . '" value="1" ' . checked($multi_stored[$key], 1, false) . ' /><label class="multicheck" for="' . $of_key_string . '">' . $option . '</label><br />';
                        }
                        
                        break;

                    // Color picker
                    case "color":
                        $default_color = '';
                        if (isset($value['std'])) {
                            $default_color = ' data-default-color="' . $value['std'] . '" ';
                        }
                        $output .= '<input name="' . $value['id'] . '" id="' . $value['id'] . '" class="of-color" type="text" value="' . $smof_data[$value['id']] . '"' . $default_color . ' />';

                        break;

                    //typography option	
                    case 'typography':
                        $typography_stored = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];

                        /* Font Size */
                        if (isset($typography_stored['size'])) {
                            $output .= '<div class="select_wrapper typography-size" original-title="' . esc_attr__('Font size', 'elessi-theme') . '">';
                            $output .= '<select class="of-typography of-typography-size select" name="' . $value['id'] . '[size]" id="' . $value['id'] . '_size">';
                            for ($i = 9; $i < 20; $i++) {
                                $test = $i . 'px';
                                $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['size'], $test, false) . '>' . $i . 'px</option>';
                            }

                            $output .= '</select></div>';
                        }

                        /* Line Height */
                        if (isset($typography_stored['height'])) {
                            $output .= '<div class="select_wrapper typography-height" original-title="Line height">';
                            $output .= '<select class="of-typography of-typography-height select" name="' . $value['id'] . '[height]" id="' . $value['id'] . '_height">';
                            for ($i = 20; $i < 38; $i++) {
                                $test = $i . 'px';
                                $output .= '<option value="' . $i . 'px" ' . selected($typography_stored['height'], $test, false) . '>' . $i . 'px</option>';
                            }

                            $output .= '</select></div>';
                        }

                        /* Font Face */
                        if (isset($typography_stored['face'])) {
                            $output .= '<div class="select_wrapper typography-face" original-title="Font family">';
                            $output .= '<select class="of-typography of-typography-face select" name="' . $value['id'] . '[face]" id="' . $value['id'] . '_face">';

                            $faces = array(
                                'arial' => __('Arial', 'elessi-theme'),
                                'verdana' => __('Verdana, Geneva', 'elessi-theme'),
                                'trebuchet' => __('Trebuchet', 'elessi-theme'),
                                'georgia' => __('Georgia', 'elessi-theme'),
                                'times' => __('Times New Roman', 'elessi-theme'),
                                'tahoma' => __('Tahoma, Geneva', 'elessi-theme'),
                                'palatino' => __('Palatino', 'elessi-theme'),
                                'helvetica' => __('Helvetica', 'elessi-theme')
                            );
                            foreach ($faces as $i => $face) {
                                $output .= '<option value="' . $i . '" ' . selected($typography_stored['face'], $i, false) . '>' . $face . '</option>';
                            }

                            $output .= '</select></div>';
                        }

                        /* Font Weight */
                        if (isset($typography_stored['style'])) {
                            $output .= '<div class="select_wrapper typography-style" original-title="Font style">';
                            $output .= '<select class="of-typography of-typography-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';
                            $styles = array(
                                'normal' => __('Normal', 'elessi-theme'),
                                'italic' => __('Italic', 'elessi-theme'),
                                'bold' => __('Bold', 'elessi-theme'),
                                'bold italic' => __('Bold Italic', 'elessi-theme')
                            );

                            foreach ($styles as $i => $style) {

                                $output .= '<option value="' . $i . '" ' . selected($typography_stored['style'], $i, false) . '>' . $style . '</option>';
                            }
                            $output .= '</select></div>';
                        }

                        /* Font Color */
                        if (isset($typography_stored['color'])) {
                            $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector typography-color"><div style="background-color: ' . $typography_stored['color'] . '"></div></div>';
                            $output .= '<input class="of-color of-typography of-typography-color" original-title="Font color" name="' . $value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $typography_stored['color'] . '" />';
                        }

                        break;

                    //border option
                    case 'border':
                        /* Border Width */
                        $border_stored = $smof_data[$value['id']];

                        $output .= '<div class="select_wrapper border-width">';
                        $output .= '<select class="of-border of-border-width select" name="' . $value['id'] . '[width]" id="' . $value['id'] . '_width">';
                        for ($i = 0; $i < 21; $i++) {
                            $output .= '<option value="' . $i . '" ' . selected($border_stored['width'], $i, false) . '>' . $i . '</option>';
                        }
                        
                        $output .= '</select></div>';

                        /* Border Style */
                        $output .= '<div class="select_wrapper border-style">';
                        $output .= '<select class="of-border of-border-style select" name="' . $value['id'] . '[style]" id="' . $value['id'] . '_style">';

                        $styles = array(
                            'none' => __('None', 'elessi-theme'),
                            'solid' => __('Solid', 'elessi-theme'),
                            'dashed' => __('Dashed', 'elessi-theme'),
                            'dotted' => __('Dotted', 'elessi-theme')
                        );

                        foreach ($styles as $i => $style) {
                            $output .= '<option value="' . $i . '" ' . selected($border_stored['style'], $i, false) . '>' . $style . '</option>';
                        }

                        $output .= '</select></div>';

                        /* Border Color */
                        $output .= '<div id="' . $value['id'] . '_color_picker" class="colorSelector"><div style="background-color: ' . $border_stored['color'] . '"></div></div>';
                        $output .= '<input class="of-color of-border of-border-color" name="' . $value['id'] . '[color]" id="' . $value['id'] . '_color" type="text" value="' . $border_stored['color'] . '" />';

                        break;

                    //images checkbox - use image as checkboxes
                    case 'images':
                        $i = 0;
                        $select_value = (isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : '';

                        foreach ($value['options'] as $key => $option) {
                            $i++;

                            $checked = '';
                            $selected = '';
                            if (null != checked($select_value, $key, false)) {
                                $checked = checked($select_value, $key, false);
                                // $selected = 'of-radio-img-selected';
                                $selected = ' ns-radio-img-selected';
                            }
                            
                            $output .= '<span class="of-radio-img-wrap">';
                            
                            $output .= '<input type="radio" id="of-radio-img-' . $value['id'] . $i . '" class="checkbox of-radio-img-radio" value="' . $key . '" name="' . $value['id'] . '" ' . $checked . ' />';
                            
                            $output .= '<div class="of-radio-img-label">' . $key . '</div>';
                            
                            $output .= '<a class="ns-radio-img-a' . $selected . '" href="javascript:void(0);">';
                            
                            $output .= '<img src="' . $option . '" class="of-radio-img-img" />';
                            
                            $output .= '</a>';
                            
                            $output .= '</span>';
                        }
                        
                        break;

                    //display a single image
                    case "image":
                        $src = $value['std'];
                        $output .= '<img src="' . $src . '" />';
                        
                        break;
                    
                    //display a button with url
                    case 'button':
                        $src = $value['std'];
                        $output .= '<button href="' . $src . '" class="button-primary" type="button">' . $value['btntext'] . '</button>';
                        $output .= '<img src="' . ELESSI_THEME_URI . '/admin/assets/images/ajax-loader.gif" style="margin-left: 5px; display: none;" />';
                        break;
                    
                    //info (for small intro box etc)
                    case "info":
                        $info_text = $value['std'];
                        $output .= '<div class="of-info">' . $info_text . '</div>';
                        
                        break;
                    
                    //tab heading
                    case 'heading':
                        if ($counter >= 2) {
                            $output .= '</div>' . "\n";
                            // $output .= $info ? '</div>' . "\n" : '';
                            // $info = false;
                        }
                        
                        //custom icon
                        $icon = '';
                        if (isset($value['icon'])) {
                            $icon = ' style="background-image: url(' . $value['icon'] . ');"';
                        }

                        $header_class = isset($value['target']) ? 'heading-' . str_replace(' ','-', strtolower($value['target'])) : str_replace(' ', '', strtolower($value['name']));
                        
                        $jquery_click_hook = "of-option-" . $header_class;

                        $menu .= '<li class="' . $header_class . '"><a title="' . $value['name'] . '" href="#' . $jquery_click_hook . '"' . $icon . '>' . $value['name'] . '</a></li>';
                        
                        $output .= '<div class="group" id="' . $jquery_click_hook . '">' . "\n";
                        break;

                    //drag & drop slide manager
                    case 'slider':
                        $output .= '<div class="slider"><ul id="' . $value['id'] . '">';
                        $slides = $smof_data[$value['id']];
                        $count = count($slides);
                        
                        if ($count < 2) {
                            $oldorder = 1;
                            $order = 1;
                            $output .= Options_Machine::optionsframework_slider_function($value['id'], $value['std'], $oldorder, $order);
                        } else {
                            $i = 0;
                            
                            foreach ($slides as $slide) {
                                $oldorder = $slide['order'];
                                $i++;
                                $order = $i;
                                $output .= Options_Machine::optionsframework_slider_function($value['id'], $value['std'], $oldorder, $order);
                            }
                        }
                        
                        $output .= '</ul>';
                        $output .= '<a href="#" class="button slide_add_button">' . esc_html__('Add New Slide', 'elessi-theme') . '</a></div>';

                        break;

                    //drag & drop block manager
                    case 'sorter':

                        // Make sure to get list of all the default blocks first
                        $all_blocks = $value['std'];

                        $temp = array(); // holds default blocks
                        $temp2 = array(); // holds saved blocks

                        foreach ($all_blocks as $blocks) {
                            $temp = array_merge($temp, $blocks);
                        }

                        $sortlists = isset($data[$value['id']]) && !empty($data[$value['id']]) ? $data[$value['id']] : $value['std'];

                        foreach ($sortlists as $sortlist) {
                            $temp2 = array_merge($temp2, $sortlist);
                        }

                        // now let's compare if we have anything missing
                        foreach ($temp as $k => $v) {
                            if (!array_key_exists($k, $temp2)) {
                                $sortlists['disabled'][$k] = $v;
                            }
                        }

                        // now check if saved blocks has blocks not registered under default blocks
                        foreach ($sortlists as $key => $sortlist) {
                            foreach ($sortlist as $k => $v) {
                                if (!array_key_exists($k, $temp)) {
                                    unset($sortlist[$k]);
                                }
                            }
                            $sortlists[$key] = $sortlist;
                        }

                        // assuming all sync'ed, now get the correct naming for each block
                        foreach ($sortlists as $key => $sortlist) {
                            foreach ($sortlist as $k => $v) {
                                $sortlist[$k] = $temp[$k];
                            }
                            
                            $sortlists[$key] = $sortlist;
                        }

                        $output .= '<div id="' . $value['id'] . '" class="sorter">';

                        if ($sortlists) {
                            foreach ($sortlists as $group => $sortlist) {

                                $output .= '<ul id="' . $value['id'] . '_' . $group . '" class="sortlist_' . $value['id'] . '">';
                                $output .= '<h3>' . $group . '</h3>';

                                foreach ($sortlist as $key => $list) {
                                    $output .= '<input class="sorter-placebo" type="hidden" name="' . $value['id'] . '[' . $group . '][placebo]" value="placebo" />';
                                    if ($key != "placebo") {
                                        $output .= '<li id="' . $key . '" class="sortee">';
                                        $output .= '<input class="position" type="hidden" name="' . $value['id'] . '[' . $group . '][' . $key . ']" value="' . $list . '" />';
                                        $output .= $list;
                                        $output .= '</li>';
                                    }
                                }

                                $output .= '</ul>';
                            }
                        }

                        $output .= '</div>';
                        
                        break;

                    //background images option
                    case 'tiles':

                        $i = 0;
                        $select_value = isset($smof_data[$value['id']]) && !empty($smof_data[$value['id']]) ? $smof_data[$value['id']] : '';
                        if (is_array($value['options'])) {
                            foreach ($value['options'] as $key => $option) {
                                $i++;

                                $checked = '';
                                $selected = '';
                                
                                if (NULL != checked($select_value, $option, false)) {
                                    $checked = checked($select_value, $option, false);
                                    $selected = 'of-radio-tile-selected';
                                }
                                
                                $output .= '<span>';
                                $output .= '<input type="radio" id="of-radio-tile-' . $value['id'] . $i . '" class="checkbox of-radio-tile-radio" value="' . $option . '" name="' . $value['id'] . '" ' . $checked . ' />';
                                $output .= '<div class="of-radio-tile-img ' . $selected . '" style="background: url(' . $option . ')" onClick="document.getElementById(\'of-radio-tile-' . $value['id'] . $i . '\').checked = true;"></div>';
                                $output .= '</span>';
                            }
                        }

                        break;

                    //backup and restore options data
                    case 'backup':

                        $instructions = $value['desc'];
                        $backup = of_get_options(ELESSI_ADMIN_BACKUPS);
                        $init = of_get_options('smof_init');

                        $log = !isset($backup['backup_log']) ? esc_html__('No backups yet.', 'elessi-theme') : $backup['backup_log'];

                        $output .= '<div class="backup-box">';
                        $output .= '<div class="instructions">' . $instructions . "\n";
                        $output .= '<p><strong>' . esc_html__('Last Backup : ', 'elessi-theme') . '<span class="backup-log">' . $log . '</span></strong></p></div>' . "\n";
                        $output .= '<a href="#" id="of_backup_button" class="button" title="' . esc_attr__('Backup Options', 'elessi-theme') . '">' . esc_html__('Backup Options', 'elessi-theme') . '</a>';
                        $output .= '<a href="#" id="of_restore_button" class="button" title="Restore Options">Restore Options</a>';
                        $output .= '</div>';

                        break;

                    //export or import data between different installs
                    case 'transfer':
                        $instructions = $value['desc'];
                        $output .= '<textarea id="export_data" rows="8">' . json_encode($smof_data) . '</textarea>' . "\n";
                        $output .= '<a href="#" id="of_import_button" class="button" title="' . esc_attr__('Import Options', 'elessi-theme') . '">' . esc_html__('Import Options', 'elessi-theme') . '</a>';

                        break;

                    // google font field
                    case 'select_google_font':
                        $output .= '<div class="select_wrapper">';
                        $output .= '<select class="select of-input google_font_select nasa-ad-select2" name="' . $value['id'] . '" id="' . $value['id'] . '">';
                        foreach ($value['options'] as $select_key => $option) {
                            $output .= '<option value="' . $select_key . '" ' . selected((isset($smof_data[$value['id']])) ? $smof_data[$value['id']] : "", $select_key, false) . ' />' . $option . '</option>';
                        }
                        
                        $output .= '</select></div>';

                        $g_text = isset($value['preview']['text']) ? $value['preview']['text'] : '0123456789 ABCDEFGHIJKLMNOPQRSTUVWXYZ abcdefghijklmnopqrstuvwxyz';
                        $g_size = isset($value['preview']['size']) ? 'style="font-size: ' . $value['preview']['size'] . ';"' : '';
                        
                        $hide = ($smof_data[$value['id']] != "none" && $smof_data[$value['id']] != "") ? "" : " hide";

                        $output .= '<p class="' . $value['id'] . '_ggf_previewer google_font_preview' . $hide . '" ' . $g_size . '>' . $g_text . '</p>';
                        
                        break;
                        
                    // Nasa upload Custom font
                    case 'nasa_upload_custom_font' :
                        $output .= '<span><form action="" method="post">';
                        $output .= '<input type="hidden" name="action" value="wp_handle_upload" />';
                        $output .= '<input type="file" name="zip_packet_font" style="width: 230px" /><button style="margin: 0 0 0 5px; width: 100px" class="button-primary" type="submit" name="upload_new_font" value="new_font">' . esc_html__('Upload', 'elessi-theme') . '</button>';
                        $output .= '</form></span>';
                        
                        break;

                    //JQuery UI Slider
                    case 'sliderui':
                        $s_val = $s_min = $s_max = $s_step = $s_edit = ''; //no errors, please
                        $s_val = stripslashes($smof_data[$value['id']]);
                        $s_min = !isset($value['min']) ? '0' : $value['min'];
                        $s_max = !isset($value['max']) ? ($s_min + 1) : $value['max'];
                        $s_step = !isset($value['step']) ? '1' : $value['step'];
                        $s_edit = !isset($value['edit']) ? ' readonly="readonly"' : '';

                        if ($s_val == '') {
                            $s_val = $s_min;
                        }
                        
                        //values
                        $s_data = 'data-id="' . $value['id'] . '" data-val="' . $s_val . '" data-min="' . $s_min . '" data-max="' . $s_max . '" data-step="' . $s_step . '"';

                        //html output
                        $output .= '<input type="text" name="' . $value['id'] . '" id="' . $value['id'] . '" value="' . $s_val . '" class="mini" ' . $s_edit . ' />';
                        $output .= '<div id="' . $value['id'] . '-slider" class="smof_sliderui" style="margin-left: 7px;" ' . $s_data . '></div>';

                        break;

                    //Switch option
                    case 'switch':
                        if (!isset($smof_data[$value['id']])) {
                            $smof_data[$value['id']] = 0;
                        }

                        $fold = '';
                        if (array_key_exists("folds", $value)) {
                            $fold = "s_fld ";
                        }
                        
                        $cb_enabled = $cb_disabled = ''; //no errors, please
                        
                        //Get selected
                        if ($smof_data[$value['id']] == 1) {
                            $cb_enabled = ' selected';
                            $cb_disabled = '';
                        } else {
                            $cb_enabled = '';
                            $cb_disabled = ' selected';
                        }

                        //Label ON
                        $on = !isset($value['on']) ? esc_html__('On', 'elessi-theme') : $value['on'];

                        //Label OFF
                        $off = !isset($value['off']) ? esc_html__('Off', 'elessi-theme') : $value['off'];

                        $output .= '<p class="switch-options">';
                        $output .= '<label class="' . $fold . 'cb-enable' . $cb_enabled . '" data-id="' . $value['id'] . '"><span>' . $on . '</span></label>';
                        $output .= '<label class="' . $fold . 'cb-disable' . $cb_disabled . '" data-id="' . $value['id'] . '"><span>' . $off . '</span></label>';

                        $output .= '<input type="hidden" class="' . $fold . 'checkbox of-input" name="' . $value['id'] . '" value="0" />';
                        $output .= '<input type="checkbox" id="' . $value['id'] . '" class="' . $fold . 'checkbox of-input main_checkbox" name="' . $value['id'] . '"  value="1" ' . checked($smof_data[$value['id']], 1, false) . ' />';

                        $output .= '</p>';

                        break;

                    // Uploader 3.5
                    case "upload":
                    case "media":

                        if (!isset($value['mod'])) {
                            $value['mod'] = '';
                        }
                        
                        $u_val = '';
                        if ($smof_data[$value['id']]) {
                            $u_val = stripslashes($smof_data[$value['id']]);
                        }

                        $output .= Options_Machine::optionsframework_media_uploader_function($value['id'], $u_val, $value['mod']);

                        break;
                    
                    /**
                     * Ajax field
                     */
                    case 'ajax_field':
                        $t_value = '';
                        $t_value = stripslashes($smof_data[$value['id']]);
                        $t_value = str_replace('"', "'", $t_value);
                        
                        $t_value = $t_value == '' ? $value['std'] : $t_value;

                        $output .= '<div  class="nasa-opt-ajax-wrap">';
                        
                        $output .= '<div class="nasa-info-ajax">';
                        
                        $output .= '<span class="label-show">' . esc_html__('Current value:', 'elessi-theme') . '&nbsp;<strong class="value-show">' . $t_value . '</strong></span>';
                        
                        $output .= '<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                        
                        $output .= '<a href="javascript:void(0);" class="button-primary nasa-init-ajax">' . esc_html__('Change', 'elessi-theme') . '</a>';
                        
                        $output .= '</div>';
                        
                        $output .= '<div class="nasa-do-ajax hidden-tag" style="display: none;">';
                        
                        $output .= '<p><input class="nasa-do-ajax-input" type="text" value="' . $t_value . '" /></p>';
                        
                        $output .= '<p><a href="javascript:void(0);" class="button-primary nasa-apply-ajax" data-action="' . $value['action'] . '">' . esc_html__('Apply', 'elessi-theme') . '</a>';
                        $output .= '<span>&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                        $output .= '<a href="javascript:void(0);" class="button reset-button nasa-cancel-ajax">' . esc_html__('Cancel', 'elessi-theme') . '</a></p>';
                        
                        $output .= '</div>';
                        
                        $output .= '<div class="nasa-ajax-mess hidden-tag"></div>';
                        
                        $output .= '<input type="hidden" name="' . $value['id'] . '" id="' . $value['id'] . '" value="' . $t_value . '" class="nasa-org-input" />';
                        
                        $output .= '</div>';
                        
                        break;
                    
                    /**
                     * Fake Purchase
                     */
                    case 'fake_purchases':
                        
                        $t_value = isset($smof_data[$value['id']]) ? $smof_data[$value['id']] : $value['std'];

                        $check_svg ='<svg width="12" height="12" viewBox="0 0 32 32">
                        <path d="M16 2.672c-7.361 0-13.328 5.967-13.328 13.328s5.968 13.328 13.328 13.328c7.361 0 13.328-5.967 13.328-13.328s-5.967-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.501-12.262-12.262s5.5-12.262 12.262-12.262c6.761 0 12.262 5.501 12.262 12.262s-5.5 12.262-12.262 12.262z" fill="currentColor"/>
                        <path d="M22.667 11.241l-8.559 8.299-2.998-2.998c-0.312-0.312-0.818-0.312-1.131 0s-0.312 0.818 0 1.131l3.555 3.555c0.156 0.156 0.361 0.234 0.565 0.234 0.2 0 0.401-0.075 0.556-0.225l9.124-8.848c0.317-0.308 0.325-0.814 0.018-1.131-0.309-0.318-0.814-0.325-1.131-0.018z" fill="currentColor"/>
                        </svg>';
                        
                        $output .= '<div class="fake_pc_wrap">';
                        
                        $output .= '
                            <div class="fake_purchases_demo hidden-tag">
                                <div class="product-image">
                                    <img class="tmop-product-image" src="' . wc_placeholder_img_src() . '" />
                                </div>
                                
                                <div class="wrapper-theme">
                                    
                                    <div class="noti-title">
                                        <span class="nameuser">' . esc_html__('Customer in country purchased a', 'elessi-theme') . '</span>
                                    </div>
                                    
                                    <div class="noti-body">
                                        <a class="nameproduct" href="javascript:void(0);">' . esc_html__('Product title', 'elessi-theme') . '</a>
                                    </div>
                                    
                                    <div class="noti-time">
                                        <span class="time_purchased">' . esc_html__('Time ago', 'elessi-theme') . '</span>
                                        <span class="verify nasa-flex">' . $check_svg . esc_html__('Verified', 'elessi-theme') . '</span>
                                    </div>
                            
                                </div>
                            </div>
                            
                            <div class="fake_purchases_input">

                                <div class="seach_pro">
                                    <input type="text" class="of-input ns_search" placeholder="' . esc_html__('Search..', 'elessi-theme') . '" id="proruct_name" />
                                    <ul class="ns_browsers"></ul>
                                </div>

                                <input class="of-input hidden-tag user_name" placeholder="Ex: John in US purchased a" type="text" />
                                <input class="of-input hidden-tag datetime" placeholder="Ex: 3 days ago, 5 hours ago, ..."  type="text" />
                                    
                                <a href="javascript:void(0);" class="button hidden-tag add-list">' . esc_html__('Add', 'elessi-theme') . '</a>
                                
                                <input class="of-input input_list_purchased" name="' . $value['id'] . '" value="' . esc_attr($t_value) . '" type="hidden" />
                            </div>
                            
                            <div class="fake_purchases_list"></div>
                        ';
                        
                        $output .= '
                            <template class="product-item-tmpl hidden-tag">
                                <div class="product_list_item">
                                    <div class="product-image">
                                        <img class="tmop-product-image" src="{{src_img}}" />
                                    </div>

                                    <div class="wrapper-theme">
                                        
                                        <div class="noti-title">
                                            <span class="nameuser">{{customer}}</span>
                                        </div>
                                        
                                        <input type="hidden" class="of-input user_name_change" placeholder="Ex: John in US purchased a" />
                                        
                                        <div class="noti-body">
                                            <a class="nameproduct" data-prod="{{p_data_prod}}" href="{{p_url}}">{{p_name}}</a>
                                        </div>
                                        
                                        <div class="noti-time">
                                            <span class="time_purchased">{{time_purchase}}</span>
                                            <span class="verify nasa-flex">' . $check_svg . esc_html__('Verified', 'elessi-theme') . '</span>
                                        </div>
                                        
                                        <input type="hidden" class="of-input datetime_change" placeholder="Ex: 3 days ago, 5 hours ago, ..." />
                                        
                                        <div class="btn_wrap hidden-tag">
                                            <a href="javascript:void(0);" class="button button-primary apply_change">' . esc_html__('Apply', 'elessi-theme') . '</a>
                                            <a href="javascript:void(0);" class="button close_change">' . esc_html__('Cancel', 'elessi-theme') . '</a>
                                        </div>
                                    </div>
                                    
                                    <a href="javascript:void(0);" class="delete_btn">
                                        <svg width="20" height="20" viewBox="0 0 32 32">
                                            <path d="M26.129 5.871h-5.331v-1.066c0-1.178-0.955-2.132-2.133-2.132h-5.331c-1.178 0-2.133 0.955-2.133 2.132v1.066h-5.331v1.066h1.099l1.067 20.259c0 1.178 0.955 2.133 2.133 2.133h11.729c1.178 0 2.133-0.955 2.133-2.133l1.049-20.259h1.051v-1.066zM12.268 4.804c0-0.588 0.479-1.066 1.066-1.066h5.331c0.588 0 1.066 0.478 1.066 1.066v1.066h-7.464v-1.066zM22.966 27.14l-0.002 0.027v0.028c0 0.587-0.478 1.066-1.066 1.066h-11.729c-0.587 0-1.066-0.479-1.066-1.066v-0.028l-0.001-0.028-1.065-20.203h15.975l-1.046 20.204z" fill="currentColor" />
                                            <path d="M15.467 9.069h1.066v17.060h-1.066v-17.060z" fill="currentColor" />
                                            <path d="M13.358 26.095l-1.091-17.027-1.064 0.068 1.091 17.027z" fill="currentColor" />
                                            <path d="M20.805 9.103l-1.064-0.067-1.076 17.060 1.064 0.067z" fill="currentColor" />
                                        </svg>
                                    </a>

                                    <a href="javascript:void(0);" class="change_btn">
                                        <svg width="20" height="20" viewBox="0 0 32 32">
                                            <path d="M30.771 5.802l-4.251-4.251-1.040 1.041-1.456-1.455c-0.208-0.208-0.546-0.208-0.754 0l-8.638 8.639c-0.208 0.208-0.208 0.546 0 0.754 0.104 0.104 0.241 0.156 0.377 0.156s0.273-0.052 0.377-0.156l8.261-8.262 1.079 1.078-18.319 18.318 1.235 1.235c-0.52-0.257-1.086-0.388-1.652-0.388-0.957 0-1.914 0.365-2.644 1.095-0.075 0.074-0.147 0.154-0.216 0.238-0.034 0.040-0.067 0.082-0.098 0.123-0.038 0.047-0.073 0.096-0.107 0.146-0.026 0.036-0.052 0.072-0.076 0.108-1.55 2.331-1.62 6.789-1.62 6.789s0.162 0.008 0.444 0.008c1.281 0 5.010-0.175 6.961-2.126 1.162-1.163 1.396-2.9 0.706-4.297l1.319 1.319 20.113-20.113zM7.879 28.139c-1.19 1.19-3.278 1.6-4.767 1.741l2.427-2.427-0.754-0.754-2.325 2.325c0.189-1.422 0.566-3.146 1.28-4.217l0.030-0.043 0.026-0.037c0.023-0.033 0.047-0.068 0.088-0.12 0.018-0.023 0.035-0.047 0.067-0.084 0.047-0.056 0.095-0.11 0.148-0.163 0.505-0.505 1.176-0.783 1.89-0.783s1.385 0.278 1.89 0.783c1.041 1.042 1.041 2.737 0 3.779zM29.264 5.802l-6.324 6.324-2.744-2.743 6.324-6.324 2.744 2.743zM19.442 10.136l2.744 2.743-11.528 11.528-2.744-2.743 11.528-11.528z" fill="currentColor" />
                                        </svg>
                                    </a>
                                </div>
                            </template>';
                        
                            $output .= '</div>';

                        break;

                    default:
                    
                        break;
                }
                
                $output = apply_filters('nasa_smof_loop_output_item', $output, $value);

                do_action('optionsframework_machine_loop', array(
                    'options' => $options,
                    'smof_data' => $smof_data,
                    'defaults' => $defaults,
                    'counter' => $counter,
                    'menu' => $menu,
                    'output' => $output,
                    'value' => $value
                ));
                
                if ($smof_output != "") {
                    $output .= $smof_output;
                    $smof_output = "";
                }

                //description of each option
                if ($value['type'] != 'heading') {
                    $img_desc = !isset($value['img_desc']) ? '' : '<div class="img-desc-wrap"><img class="explain_img_desc" src= ' . $value['img_desc'] . ' /></div>' . "\n";
                    $img_class = !isset($value['img_desc']) ? '' : ' has-img-desc';
                    $explain_value = !isset($value['desc']) ? '' : '<div class="explain' . $img_class .'">' . $value['desc'] . $img_desc . '</div>' . "\n";
                    
                    $output .= '</div>' . $explain_value . "\n";
                    $output .= '<div class="clear"> </div></div></div>' . "\n";
                }
            }
            /* condition empty end */
            
            // $k++;
        }

        if ($update_data == true) {
            of_save_options($smof_data);
        }

        $output .= '</div>';

        do_action('optionsframework_machine_after', array(
            'options' => $options,
            'smof_data' => $smof_data,
            'defaults' => $defaults,
            'counter' => $counter,
            'menu' => $menu,
            'output' => $output,
            'value' => $value
        ));
        
        if ($smof_output != "") {
            $output .= $smof_output;
            $smof_output = "";
        }

        return array($output, $menu, $defaults);
    }

    /**
     * Native media library uploader
     *
     * @uses get_theme_mod()
     *
     * @access public
     * @since 1.0.0
     *
     * @return string
     */
    public static function optionsframework_media_uploader_function($id, $std, $mod) {
        $smof_data = of_get_options();

        $uploader = '';
        $upload = "";
        if (isset($smof_data[$id])) {
            $upload = $smof_data[$id];
        }
        $val = $upload != "" ? $upload : $std;
        
        if (is_numeric($upload)) {
            $image = wp_get_attachment_image_src($upload, 'full');
            
            if (isset($image[0])) {
                $upload = $image[0];
            }
        }
        
        $hide = '';
        if ($mod == "min") {
            $hide = 'hide';
        }

        $uploader .= '<input class="' . $hide . ' upload of-input" name="' . $id . '" id="' . $id . '_upload" value="' . $val . '" />';

        //Upload controls DIV
        $uploader .= '<div class="upload_button_div">';
        //If the user has WP3.5+ show upload/remove button
        if (function_exists('wp_enqueue_media')) {
            $uploader .= '<a href="javascript:void(0);" class="button media_upload_button" id="' . $id . '">' . esc_html__('Upload', 'elessi-theme') . '</a>';

            if (!empty($upload)) {
                $hide = '';
            } else {
                $hide = 'hide';
            }
            $uploader .= '<a href="javascript:void(0);"  class="button remove-image ' . $hide . '" id="reset_' . $id . '" title="' . $id . '">' . esc_html__('Remove', 'elessi-theme') . '</a>';
        } else {
            $uploader .= '<p class="upload-notice"><i>' . esc_html__('Upgrade your version of WordPress for full media support.', 'elessi-theme') . '</i></p>';
        }

        $uploader .= '</div>' . "\n";

        //Preview
        $uploader .= '<div class="screenshot">';
        if (!empty($upload)) {
            $uploader .= '<a class="of-uploaded-image" href="javascript:void(0);">';
            $uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $upload . '" />';
            $uploader .= '</a>';
        } else {
            if ($val) {
                $uploader .= '<a class="of-uploaded-image" href="javascript:void(0);">';
                $uploader .= '<img class="of-option-image" id="image_' . $id . '" src="' . $val . '" />';
                $uploader .= '</a>';
            }
        }
        
        $uploader .= '</div>';
        $uploader .= '<div class="clear"></div>' . "\n";

        return $uploader;
    }

    /**
     * Drag and drop slides manager
     *
     * @uses get_theme_mod()
     *
     * @access public
     * @since 1.0.0
     *
     * @return string
     */
    public static function optionsframework_slider_function($id, $std, $oldorder, $order) {
        $smof_data = of_get_options();

        $slider = '';
        $slide = isset($smof_data[$id]) ? $smof_data[$id] : array();
        $val = isset($slide[$oldorder]) ? $slide[$oldorder] : $std;

        //initialize all vars
        $slidevars = array('title', 'url', 'link', 'description');

        foreach ($slidevars as $slidevar) {
            if (!isset($val[$slidevar])) {
                $val[$slidevar] = '';
            }
        }

        //begin slider interface	
        $slider .= !empty($val['title']) ?
            '<li><div class="slide_header"><strong>' . stripslashes($val['title']) . '</strong>' :
            '<li><div class="slide_header"><strong>' . esc_html__('Slide', 'elessi-theme') . ' ' . $order . '</strong>';

        $slider .= '<input type="hidden" class="slide of-input order" name="' . $id . '[' . $order . '][order]" id="' . $id . '_' . $order . '_slide_order" value="' . $order . '" />';

        $slider .= '<a class="slide_edit_button" href="#">' . esc_html__('Edit', 'elessi-theme') . '</a></div>';

        $slider .= '<div class="slide_body">';

        $slider .= '<label>' . esc_html__('Title', 'elessi-theme') . '</label>';
        $slider .= '<input class="slide of-input of-slider-title" name="' . $id . '[' . $order . '][title]" id="' . $id . '_' . $order . '_slide_title" value="' . stripslashes($val['title']) . '" />';

        $slider .= '<label>' . esc_html__('Image URL', 'elessi-theme') . '</label>';
        $slider .= '<input class="upload slide of-input" name="' . $id . '[' . $order . '][url]" id="' . $id . '_' . $order . '_slide_url" value="' . $val['url'] . '" />';

        $slider .= '<div class="upload_button_div"><a href="javascript:void(0);" class="button media_upload_button" id="' . $id . '_' . $order . '">' . esc_html__('Upload', 'elessi-theme') . '</a>';

        $hide = !empty($val['url']) ? '' : 'hide';
        
        $slider .= '<a href="javascript:void(0);" class="button remove-image ' . $hide . '" id="reset_' . $id . '_' . $order . '" title="' . $id . '_' . $order . '">' . esc_html__('Remove', 'elessi-theme') . '</a>';
        $slider .= '</div>' . "\n";
        $slider .= '<div class="screenshot">';
        
        if (!empty($val['url'])) {
            $slider .= '<a class="of-uploaded-image" href="' . $val['url'] . '">';
            $slider .= '<img class="of-option-image" id="image_' . $id . '_' . $order . '" src="' . esc_url($val['url']) . '" />';
            $slider .= '</a>';
        }
        
        $slider .= '</div>';
        $slider .= '<label>' . esc_html__('Link URL (optional)', 'elessi-theme') . '</label>';
        $slider .= '<input class="slide of-input" name="' . $id . '[' . $order . '][link]" id="' . $id . '_' . $order . '_slide_link" value="' . $val['link'] . '" />';

        $slider .= '<label>' . esc_html__('Description (optional)', 'elessi-theme') . '</label>';
        $slider .= '<textarea class="slide of-input" name="' . $id . '[' . $order . '][description]" id="' . $id . '_' . $order . '_slide_description" cols="8" rows="8">' . stripslashes($val['description']) . '</textarea>';

        $slider .= '<a class="slide_delete_button" href="#">Delete</a>';
        $slider .= '<div class="clear"></div>' . "\n";

        $slider .= '</div>';
        $slider .= '</li>';

        return $slider;
    }

}

//end Options Machine class
