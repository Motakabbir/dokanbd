<?php
$title_top = isset($instance['title']) ? $instance['title'] : '';
$class_title = 'nasa-dft nasa-title clearfix';
$style_title = '';
$title_set_size = false;
$title_abs = false;

$alignment = isset($instance['alignment']) && in_array($instance['alignment'], array('center', 'left', 'right')) ? $instance['alignment'] : 'center';

$class_wrap = 'nasa-tabs-content nasa-not-elementor-style';
$class_wrap .= isset($instance['el_class']) && $instance['el_class'] ? ' ' . $instance['el_class'] : '';

$class_tabable = 'nasa-tabs-wrap';
$margin_tabable = ' margin-bottom-15';
$class_tabable .= ' text-' . $alignment;
$class_ul_tab = 'nasa-tabs';

$tabs_type = !isset($instance['style']) ? '2d-no-border' : $instance['style'];

if (isset($instance['title_font_size']) && $instance['title_font_size'] !== '') :
    $class_title .= ' nasa-' . $instance['title_font_size'];
    $title_set_size = true;
endif;

$class_title .= $alignment == 'center' ? ' text-center' : '';

/**
 * Optimize html
 */
$tmpl = isset($nasa_opt['tmpl_html']) && $nasa_opt['tmpl_html'] ? true : false;

/**
 * Tabs Slide
 */
if ($tabs_type == 'slide') :
    $class_ul_tab .= ' nasa-slide-style';

/**
 * Tabs Classic
 */
else:
    switch ($tabs_type) :
        case '2d':
            $tabs_type_class = ' nasa-classic-2d';
            break;

        case '3d':
            $tabs_type_class = ' nasa-classic-3d';
            break;

        case '2d-has-bg':
        case '2d-has-bg-none':
            if ($title_top) {
                if ($alignment !== 'center') {
                    $class_title .= ' nasa-title-absolute';
                    $class_title .= $alignment == 'left' ? ' d-right' : ' d-left';
                    
                    $title_abs = true;
                }
            }

            $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border nasa-tabs-has-bg';
            $tabs_type_class .= $tabs_type == '2d-has-bg-none' ? ' nasa-tabs-bg-transparent' : '';
            $margin_tabable = ' margin-bottom-10';
            $class_tabable .= $alignment == 'left' ? ' mobile-text-right' : ' mobile-text-left';
            
            if ($tabs_type !== '2d-has-bg-none') {
                $class_title .= ' nasa-has-padding mobile-text-center';

                if (!$title_set_size) {
                    $class_title .= ' nasa-m';
                }
            } else {
                $class_title .= ' mobile-margin-bottom-0 mobile-text-center';

                if (!$title_set_size) {
                    $class_title .= ' nasa-l';
                }
            }

            break;

        case '2d-radius':
            $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border nasa-tabs-radius';
            break;

        case '2d-radius-dashed':
            $tabs_type_class = ' nasa-classic-2d nasa-tabs-radius-dashed';
            break;
        
        case 'ver':
                $class_wrap .= ' nasa-vertical-tabs';
                $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border';
                
                break;

        case '2d-no-border':
        default:
            $tabs_type_class = ' nasa-classic-2d nasa-tabs-no-border';
            break;

    endswitch;
    
    $class_ul_tab .= ' nasa-classic-style' . $tabs_type_class;
endif;

$class_tabable .= $margin_tabable;

/**
 * Build array tabs
 */
$tabs_heading = $tabs_content = $before_title = $after_title = array();
$tabs_content_first = true;
foreach ($instance['tabs'] as $key => $tab) :
    /**
     * Headings
     */
    $tabs_heading[$key] = $tab['tab_title'];
    unset($tab['tab_title']);

    /**
     * Before title
     */
    $before_title[$key] = '';
    if (isset($tab['before_tab_title'])) :
        $before_title[$key] = $tab['before_tab_title'];
        unset($tab['before_tab_title']);
    endif;

    /**
     * After title
     */
    $after_title[$key] = '';
    if (isset($tab['after_tab_title'])) :
        $after_title[$key] = $tab['after_tab_title'];
        unset($tab['after_tab_title']);
    endif;
    
    /**
     * Contents
     */
    $tabs_content[$key] = $tab;
endforeach;

if ($title_top) :
    $title_description = !$title_abs && isset($instance['desc']) && $instance['desc'] ? '<p class="nasa-title-desc">' . $instance['desc'] . '</p>' : '';
    $title_top = '<div class="' . esc_attr($class_title) . '"' . $style_title . '><h3 class="nasa-heading-title">' . $title_top . '</h3>' . $title_description . '</div>';
endif;

/**
 * Title Tabs not absolute
 */
echo ($title_top && !$title_abs) ? $title_top : '';

/**
 * Start Content Tabs
 */
echo '<div class="' . esc_attr($class_wrap) . '">';

/**
 * Title Tabs - absolute
 */
echo ($title_top && $title_abs) ? $title_top : '';

echo '<div class="' . esc_attr($class_tabable) . '">';
echo '<ul class="' . esc_attr($class_ul_tab) . '">';

/**
 * Headings
 */
$total = count($tabs_heading);
$stt = 1;
foreach ($tabs_heading as $k => $heading) :
    $class = 'nasa-tab';
    $class .= $stt == 1 ? ' first active' : '';
    $class .= $stt == $total ? ' last' : '';
    
    echo '<li class="' . esc_attr($class) . '">';
    
    
    echo '<a href="javascript:void(0);" data-index="nasa-section-' . $k . '" class="nasa-flex jc flex-column nasa-a-tab" rel="nofollow">';
    
    echo empty($before_title[$k]) ? '' : '<span class="ns-before_title">' . $before_title[$k] . '</span>';
    echo $heading;
    echo empty($after_title[$k]) ? '' : '<span class="ns-after_title">' . $after_title[$k] . '</span>';
    
    echo '</a>';
    
    echo '</li>';

    $stt++;
endforeach;

echo '</ul>';
echo '</div>';

echo '<div class="nasa-panels">';

/**
 * Contents
 */
foreach ($tabs_content as $k => $content_args) :
    $class = 'nasa-panel hidden-tag';
    $class .= $tabs_content_first ? ' active first' : '';
    $class .= ' nasa-section-' . $k;
    
    echo '<div class="' . esc_attr($class) . '">';
    echo $tmpl && !$tabs_content_first ? '<template class="nasa-tmpl">' : '';
    $_this->render_shortcode_text($content_args);
    echo $tmpl && !$tabs_content_first ? '</template>' : '';
    echo '</div>';
    
    $tabs_content_first = false;
endforeach;

echo '</div>';
echo '</div>';
