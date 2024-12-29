<?php

/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('ABSPATH')) :
    die('-1');
endif;

$title_top = $this->getTemplateVariable('title');
$content = '';

$title_abs = false;

if (WPBakeryShortCode_VC_Tta_Section::$section_info) :
    $alignment_class = $alignment ? ' text-' . $alignment : '';
    $el_class = (trim($el_class) != '') ? ' ' . $el_class : '';
    $tabs_slide = (isset($tabs_display_type) && $tabs_display_type == 'slide') ? true : false;
    $class_tabable = ' margin-bottom-15';
    $class_ul_tab = 'nasa-tabs';
    $class_a_click = 'nasa-a-tab nasa-flex jc flex-column';
    $tab_bg = array();
    $class_title = 'nasa-dft nasa-title clearfix';
    $style_title = '';
    $title_set_size = false;
    $tab_color = $tab_color_text = array();
    
    if (isset($title_font_size) && $title_font_size !== '') :
        $class_title .= ' nasa-' . $title_font_size;
        $title_set_size = true;
    endif;
    
    $class_title .= $alignment == 'center' ? ' text-center' : '';
    
    if ($tabs_slide) :
        $class_ul_tab .= ' nasa-slide-style';
    else :
        $tabs_type = !isset($tabs_display_type) ? '2d-no-border' : $tabs_display_type;
        switch ($tabs_type) :
            case '2d':
                $tabs_type_class = ' nasa-classic-2d';
                break;
            
            case '3d':
                $tabs_type_class = ' nasa-classic-3d';
                break;
            
            case '2d-has-bg':
                if ($title_top) :
                    if ($alignment !== 'center') :
                        $class_title .= ' nasa-title-absolute';
                        $class_title .= $alignment == 'left' ? ' d-right' : ' d-left';
                        $title_abs = true;
                    endif;
                endif;
                
                $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border nasa-tabs-has-bg';
                $class_tabable = ' margin-bottom-10';
                $class_tabable .= $alignment == 'left' ? ' mobile-text-right' : ' mobile-text-left';
                $tabs_bg_color = (!isset($tabs_bg_color) || $tabs_bg_color == '' || $tabs_bg_color == '#00000000') ?
                    'transparent' : $tabs_bg_color;
                
                $tabs_type_class .= 'transparent' == $tabs_bg_color ? ' nasa-tabs-bg-transparent' : '';
                
                if ($tabs_bg_color != 'transparent') :
                    $tab_bg[] = 'background-color: ' . $tabs_bg_color;
                endif;
                
                if (isset($tabs_text_color) && $tabs_text_color != '') :
                    $tab_color[] = 'color: ' . $tabs_text_color;
                    $tab_color_text[] = 'border-color: ' . $tabs_text_color;
                    $class_a_click .= ' nasa-custom-text-color';
                    
                    if ($class_title) :
                        $style_title .= ' style="color: ' . $tabs_text_color . '"';
                    endif;
                endif;
                
                if ($tabs_bg_color !== 'transparent') :
                    $class_title .= ' nasa-has-padding mobile-text-center';
                    
                    if (!$title_set_size) :
                        $class_title .= ' nasa-m';
                    endif;
                else :
                    $class_title .= ' mobile-margin-bottom-0 mobile-text-center';
                    
                    if (!$title_set_size) :
                        $class_title .= ' nasa-l';
                    endif;
                endif;
                
                break;
                
            case '2d-radius':
                $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border nasa-tabs-radius';
                break;
            
            case '2d-radius-dashed':
                $tabs_type_class = ' nasa-classic-2d nasa-tabs-radius-dashed';
                break;
            
            case 'ver':
                $el_class .= ' nasa-vertical-tabs';
                $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border';
                
                break;
            
            case '2d-no-border':
            default:
                $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border';
                break;
            
        endswitch;
        
        $class_ul_tab .= ' nasa-classic-style' . $tabs_type_class;
    endif;
    
    if ($title_top) :
        $title_top = '<div class="' . esc_attr($class_title) . '"' . $style_title . '>' . $title_top . '</div>';
    endif;
    
    $class_tabable .= $alignment_class ? $alignment_class : '';
    
    $content .= '<div class="nasa-wrap-all nasa-tabs-content' . esc_attr($el_class) . '">';
    
    $content .= $title_abs ? $title_top : '';
    
    $content .= '<div class="nasa-tabs-wrap' . esc_attr($class_tabable) . '">';
    $content .= '<ul class="' . esc_attr($class_ul_tab) . '"' . (!empty($tab_bg) ? ' style="' . implode(';', $tab_bg) . '"' : '') . '>';
    
    foreach (WPBakeryShortCode_VC_Tta_Section::$section_info as $k => $v) :
        $title = esc_html($v['title']);
        $custom_icon = isset($v["section_nasa_icon"]) && trim($v["section_nasa_icon"]) !== '' ? true : false;
        $vc_icon = !$custom_icon && $v['add_icon'] == 'true' ? true : false;
        $img_icon = '';
        $i_icon = '';
        
        $before_title = isset($v["before_tab_title"]) && trim($v["before_tab_title"]) !== '' ? '<span class="ns-before_title">' . rawurldecode(base64_decode(wp_strip_all_tags($v["before_tab_title"]))) . '</span>' : '';
        
        $after_title = isset($v["after_tab_title"]) && trim($v["after_tab_title"]) !== '' ? '<span class="ns-after_title">' . rawurldecode(base64_decode(wp_strip_all_tags($v["after_tab_title"]))) . '</span>' : '';
        
        $title = $before_title . $title . $after_title;
        
        if (isset($v["section_nasa_img"]) && absint($v["section_nasa_img"])) :
            $img = wp_get_attachment_image_src(absint($v["section_nasa_img"]), 'full');
            
            if ($img) :
                $img_icon = '<img src="' . esc_url($img[0]) . '" alt="' . esc_attr($v['title']) . '" width="' . absint($img[1]) . '" height="' . absint($img[2]) . '" />';
            endif;
        endif;
        
        if ($custom_icon || $img_icon || $vc_icon) :
            $icon_class = 'nasa-tab-icon ';
            $icon_class .= !$custom_icon ? 'vc_tta-icon ' . $v['i_icon_' . $v['i_type']] : $v["section_nasa_icon"];
            
            switch ($v['i_position']) :
                case 'right':
                    $img_icon = $img_icon != '' ? '<span class="tab-icon-img nasa-block padding-top-10">' . $img_icon . '</span>' : '';
                    if ($custom_icon || $vc_icon) :
                        $i_icon = '<i class="' . $icon_class . ' padding-top-10"></i>';
                    endif;
                    
                    $title = $title . $i_icon . $img_icon;
                    
                    break;
                    
                case 'left':
                default :
                    $img_icon = $img_icon != '' ? '<span class="tab-icon-img nasa-block padding-bottom-10">' . $img_icon . '</span>' : '';
                    
                    if ($custom_icon || $vc_icon) :
                        $i_icon = '<i class="' . $icon_class . ' padding-bottom-10"></i>';
                    endif;
                    
                    $title = $i_icon . $img_icon . $title ;
                    break;
            endswitch;
        endif;
        
        $class_item = 'nasa-tab text-center';
        $class_item .= $k == 0 ? ' active first' : '';
        $class_item .= ($k + 1) == WPBakeryShortCode_VC_Tta_Section::$self_count ? ' last' : '';
        
        $nasa_attr = ' class="' . $class_item . '"';
        $nasa_attr .= !empty($tab_color) ? ' style="' . implode(';', $tab_color) . '"' : '';
        
        $style = !empty($tab_color_text) ? ' style="' . implode(';', $tab_color_text) . '"' : '';
        
        $content .= '<li' . $nasa_attr . '>';
        $content .= '<a href="javascript:void(0);" data-hash="#' . esc_attr($v['tab_id']) . '" data-index="nasa-section-' . esc_attr($v['tab_id']) . '" class="' . esc_attr($class_a_click) . '"' . $style . ' rel="nofollow">' . $title . '</a></li>';
    endforeach;
    
    $content .= '</ul>';
    $content .= '</div>';
    $content .= '<div class="nasa-panels">';
    $content .= $prepareContent; // Content
    $content .= '</div>';
    $content .= '</div>';
endif;

$output = $title_abs ? $content : $title_top . $content;

echo $output;
