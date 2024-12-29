<?php

namespace Nasa_Core;

use Elementor\Widget_Base;

abstract class Nasa_ELM_Widgets_Abs extends Widget_Base {
    
    abstract protected function _shortcode();
    
    /**
     * Retrieve the widget icon.
     * 
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'ns-elm-icon';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['ns-widgets'];
    }
    
    /**
     * 
     * @param type $atts
     */
    protected function render_shortcode_text($atts = array()) {
        if (!$this->_shortcode() || !shortcode_exists($this->_shortcode())) {
            return;
        }

        $atts_sc = array();
        $content = '';
        $text = '';
        if (!empty($atts)) {
            foreach ($atts as $key => $value) {
                if ($key === 'title_widget') {
                    continue;
                }

                if ($key !== 'content') {
                    if (!is_array($value) && !is_object($value)) {
                        $value = (string) $value;
                        $atts_sc[] = $key . '="' . esc_attr($value) . '"';
                    }
                } else {
                    $content = $value;
                }
            }
        }

        $text .= '[' . $this->_shortcode();
        $text .= !empty($atts_sc) ? ' ' . implode(' ', $atts_sc) : '';
        $text .= trim($content) != '' ? ']' . $content . '[/' . $this->_shortcode() : '';
        $text .= ']';

        echo do_shortcode($text);
    }
}
