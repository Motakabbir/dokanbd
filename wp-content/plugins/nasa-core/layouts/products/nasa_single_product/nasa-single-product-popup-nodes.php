<?php
$content = '';
$is_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
$arrow_svg = $is_mobile? '<svg class="ns-mobile-node-arr" width="11" height="11" viewBox="0 0 512 512" fill="currentColor"><path d="M135 512c3 0 4 0 6 0 15-4 26-21 40-33 62-61 122-122 187-183 9-9 27-24 29-33 3-14-8-23-17-32-67-66-135-131-202-198-11-9-24-27-33-29-18-4-28 8-31 21 0 0 0 2 0 2 1 1 1 6 3 10 3 8 18 20 27 28 47 47 95 93 141 139 19 18 39 36 55 55-62 64-134 129-199 193-8 9-24 21-26 32-3 18 8 24 20 28z"/></svg>' :'';
/**
 * Size Guide Block
 */
if ($size_guide) :
    $content .= '<li class="nasa-popup-node-item nasa-size-guide first">';
    
    /**
     * Dom click
     */
    $content .= '<a class="nasa-node-popup" href="javascript:void(0);" data-target="#nasa-content-size-guide" rel="nofollow"><svg width="20" height="20" viewBox="0 0 25 32" fill="currentColor"><path d="M6.294 14.164h12.588v1.049h-12.588v-1.049z"/><path d="M6.294 18.36h12.588v1.049h-12.588v-1.049z"/><path d="M6.294 22.557h8.392v1.049h-8.392v-1.049z"/><path d="M15.688 3.674c-0.25-1.488-1.541-2.623-3.1-2.623s-2.85 1.135-3.1 2.623h-9.489v27.275h25.176v-27.275h-9.488zM10.49 6.082v-1.884c0-1.157 0.941-2.098 2.098-2.098s2.098 0.941 2.098 2.098v1.884l0.531 0.302c1.030 0.586 1.82 1.477 2.273 2.535h-9.803c0.453-1.058 1.243-1.949 2.273-2.535l0.53-0.302zM24.128 29.9h-23.078v-25.177h8.392v0.749c-1.638 0.932-2.824 2.566-3.147 4.496h12.588c-0.322-1.93-1.509-3.563-3.147-4.496v-0.749h8.392v25.177z"/></svg>&nbsp;' . esc_html__('Size Guide', 'nasa-core') . $arrow_svg . '</a>';
    
    /**
     * Content Popup, add class 'zoom-anim-dialog' into 'nasa-node-content' to add effect flip popup
     */
    $content .= '<div id="nasa-content-size-guide" class="nasa-node-content hidden-tag"><div class="ns-inct">' . $size_guide . '</div></div>';
    
    $content .= '</li>';
endif;

/**
 * Delivery & Return
 */
if ($delivery_return) :
    $content .= '<li class="nasa-popup-node-item nasa-delivery-return">';
    
    /**
     * Dom click
     */
    $content .= '<a class="nasa-node-popup" href="javascript:void(0);" data-target="#nasa-content-delivery-return" rel="nofollow"><svg width="20" height="20" viewBox="0 0 30 32" fill="currentColor"><path d="M29.867 8.96l-10.667-7.253v4h-19.2v24.533h24.533v-17.707l5.333-3.573zM20.267 3.733l7.68 5.173-7.68 5.227v-2.827c0 0 0 0 0 0v-1.067h-1.92c-0.053 0-0.053 0-0.107 0-1.92 0-5.867 0.373-8.907 2.88 1.44-3.52 4.747-6.293 9.76-6.293v0c0 0 0.053 0 0.053 0s0 0 0.053 0h1.067v-1.013c0 0 0 0 0-0.053v-2.027zM23.467 29.227h-22.4v-22.4h12.96c-4.267 1.867-6.56 6.133-6.56 10.56 2.453-5.44 8.16-6.133 10.773-6.133 0.373 0 0.693 0 0.96 0.053v4.8l4.267-2.88v16z"/></svg>&nbsp;' . esc_html__('Delivery &#38; Return', 'nasa-core') . $arrow_svg . '</a>';
    
    /**
     * Content Popup, add class 'zoom-anim-dialog' into 'nasa-node-content' to add effect flip popup
     */
    $content .= '<div id="nasa-content-delivery-return" class="nasa-node-content hidden-tag"><div class="ns-inct">' . $delivery_return . '</div></div>';
    
    $content .= '</li>';
endif;

/**
 * Ask a Question
 */
if ($ask_a_question) :
    $content .= '<li class="nasa-popup-node-item last nasa-ask-a-quetion">';
    
    /**
     * Dom click
     */
    $content .= '<a class="nasa-node-popup" href="javascript:void(0);" data-target="#nasa-content-ask-a-quetion" rel="nofollow"><svg width="20" height="20" viewBox="0 0 32 32" fill="currentColor" class="ns-ignore-pos"><path d="M16 2.672c-7.361 0-13.328 5.967-13.328 13.328s5.967 13.328 13.328 13.328 13.328-5.967 13.328-13.328c0-7.361-5.967-13.328-13.328-13.328zM16 28.262c-6.761 0-12.262-5.5-12.262-12.262s5.5-12.262 12.262-12.262 12.262 5.5 12.262 12.262c0 6.761-5.5 12.262-12.262 12.262z"/><path d="M15.955 9.013c-2.706 0-4.217 1.672-4.236 4.322h1.176c-0.037-1.922 0.97-3.332 3.005-3.332 1.455 0 2.668 1.026 2.668 2.519 0 0.97-0.523 1.754-1.213 2.407-1.418 1.316-1.815 1.935-1.887 3.738h1.191c0.070-1.635 0.034-1.602 1.461-3.029 0.952-0.896 1.623-1.792 1.623-3.173 0-2.164-1.717-3.452-3.787-3.452z" fill="currentColor"/><path d="M16 20.799c-0.588 0-1.066 0.477-1.066 1.066 0 0.589 0.478 1.066 1.066 1.066s1.066-0.477 1.066-1.066c0-0.588-0.477-1.066-1.066-1.066z"/></svg>&nbsp;' . esc_html__('Ask a Question', 'nasa-core') . $arrow_svg . '</a>';
    
    $content .= '</li>';
endif;

/**
 * Output
 */
$output = apply_filters('nasa_single_product_popup_nodes', $content);

/**
 * Echo Content
 */
if ($output) :
    echo '<ul class="nasa-wrap-popup-nodes">';
    echo $output;
    echo '</ul>';
endif;
