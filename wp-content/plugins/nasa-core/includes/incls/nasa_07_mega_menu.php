<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Mega menu use front-end
 */
class Nasa_Nav_Menu extends Walker_Nav_Menu {

    const DF_MEGA_COLS = 3; // Default mega columns
    
    protected $_mega = array();
    protected $_colums = 0;
    protected $_even = true;
    protected $_in_mobile = false;
    protected $_item_key = '_nasa_menu_item';
    protected $_data = array();
    protected $_new_menu = false;
    protected $_tmpl = false;

    /**
     * Constructor
     * 
     * @global type $nasa_opt
     */
    public function __construct() {
        global $nasa_opt;
        
        if (!isset($nasa_opt['sync_nasa_menu']) || !$nasa_opt['sync_nasa_menu']) {
            $sync_nasa_menu = get_option('sync_nasa_menu', '');
            $nasa_opt['sync_nasa_menu'] = $sync_nasa_menu;
            set_theme_mod('sync_nasa_menu', $sync_nasa_menu);
        }
        
        $this->_new_menu = (bool) $nasa_opt['sync_nasa_menu'];
        $this->_in_mobile = isset($nasa_opt['nasa_in_mobile']) && $nasa_opt['nasa_in_mobile'] ? true : false;
        $this->_tmpl = isset($nasa_opt['tmpl_html']) && $nasa_opt['tmpl_html'] ? true : false;
        
        add_filter('ns_theme_sp_menu_desc', array($this, 'sp_menu_desc'));
    }
    
    /**
     * Support Menu Description
     * 
     * @global type $nasa_opt
     * @param type $enable
     * @return boolean
     */
    public function sp_menu_desc($enable) {
        global $nasa_opt;
        
        if (!isset($nasa_opt['ns_menu_desc']) || !$nasa_opt['ns_menu_desc']) {
            return false;
        }
        
        return $enable;
    }

    /**
     * get Option item
     * 
     * @param type $itemID
     * @param type $field
     * @return type
     */
    protected function _get_option($itemID = 0, $field = '') {
        /**
         * empty string if not menu
         */
        if (!$itemID) {
            return '';
        }
        
        /**
         * Old data
         */
        if (!$this->_new_menu) {
            return get_post_meta($itemID, '_menu_item_nasa_' . $field, true);
        }
        
        /**
         * New data
         */
        if (!isset($this->_data[$itemID])) {
            $this->_data[$itemID] = get_post_meta($itemID, $this->_item_key, true);
        }

        return isset($this->_data[$itemID][$field]) ? $this->_data[$itemID][$field] : '';
    }

    /**
     * Start level of item group
     * 
     * @param string $output
     * @param type $depth
     * @param type $args
     */
    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $class_names = $depth == 0 ? 'nav-dropdown' : 'nav-column-links';
        
        $clss_lvl = '';
        if ($this->_colums) {
            $clss_lvl .= ' large-block-grid-' . $this->_colums . ' medium-block-grid-' . $this->_colums . ' small-block-grid-' . $this->_colums;
        }
        
        $this->_colums = 0;
        
        if ($depth == 0 && $this->_tmpl) {
            $output .= '<template class="nasa-template-sub-menu">';
        }
        
        $output .= '<div class="' . $class_names . '"><ul class="sub-menu' . $clss_lvl . '">';
    }

    /**
     * End level of item group
     * 
     * @param string $output
     * @param type $depth
     * @param type $args
     */
    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul></div>';
        
        if ($depth == 0 && $this->_tmpl) {
            $output .= '</template>';
        }
    }
    
    /**
     * Start Tag Item
     * 
     * @param type $output
     * @param type $item
     * @param type $depth
     * @param type $args
     * @param type $id
     * @return type
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        if ($item->post_type != 'nav_menu_item') {
            return;
        }
        
        $megamenu_class = $megacolumns = $mega_top = $hr = '';
        $megamenu = false;
        $class_even_odd = '';
        
        if ($depth == 0) {
            $this->_colums = 0;
            $megamenu = $this->_get_option($item->ID, 'enable_mega');
            $megamenu_class = ' default-menu root-item';
            $class_even_odd = $this->_even ? ' nasa_even' : ' nasa_odd';
            $this->_even = !$this->_even;
        }

        if ($megamenu) {
            $megamenu_class = ' nasa-megamenu root-item';
            $megacolumnsfix = $this->_get_option($item->ID, 'columns_mega');
            $megacolumns = !$megacolumnsfix ? ' cols-' . self::DF_MEGA_COLS : ' cols-' . $megacolumnsfix;
            $this->_colums = !$megacolumnsfix ? self::DF_MEGA_COLS : $megacolumnsfix;
            $full = $this->_get_option($item->ID, 'enable_fullwidth');
            $class_mega_type = $full == '1' ? 'fullwidth' : $full;
            $megacolumns .= $class_mega_type !== '' ? ' ' . $class_mega_type : '';
            $this->_mega[] = $item->ID;
        }
        
        if ($depth == 0 && $this->_tmpl) {
            $megamenu_class .= ' nasa-has-tmpl';
        }

        $image_mega_id = $position = $bg = $image_mega = '';
        
        /** This filter is documented in wp-includes/post-template.php */
        $title_menu = apply_filters('the_title', $item->title, $item->ID);
        
        /**
         * Filters a menu item's title.
         *
         * @since 4.4.0
         *
         * @param string   $title     The menu item's title.
         * @param WP_Post  $menu_item The current menu item object.
         * @param stdClass $args      An object of wp_nav_menu() arguments.
         * @param int      $depth     Depth of menu item. Used for padding.
         */
        $title_menu = apply_filters('nav_menu_item_title', $title_menu, $item, $args, $depth);
        
        $title_disable = false;
        
        if ($this->_get_option($item->ID, 'image_mega_enable')) {
            $image_mega_id = $this->_get_option($item->ID, 'image_mega');
            
            if ($image_mega_id) {
                $title_disable = $this->_get_option($item->ID, 'disable_title_image_mega');
                $position = $this->_get_option($item->ID, 'position_image_mega');
                $dimentions = $image_mega_src = '';
                
                if (is_numeric($image_mega_id)) {
                    $image = wp_get_attachment_image_src($image_mega_id, 'full');
                    if (isset($image[0])) {
                        $image_mega_src = $image[0];
                        $dimentions .= isset($image[1]) ? ' width="' . $image[1] . '"' : '';
                        $dimentions .= isset($image[2]) ? ' height="' . $image[2] . '"' : '';
                    }
                } else {
                    $image_mega_src = $image_mega_id;
                }
                
                if ($image_mega_src) {
                    if ($position == 'bg') {
                        $bg = ' style="background: url(\'' . esc_url($image_mega_src) . '\') center center no-repeat"';
                    } else {
                        $image_mega = '<img class="nasa-mega-img" src="' . esc_url($image_mega_src) . '" alt="' . esc_attr($title_menu) . '"' . $dimentions . ' />';
                    }
                }
            }
        }

        $menu_icon = $this->_get_option($item->ID, 'icon_menu');
        $menu_svg = $this->_get_option($item->ID, 'svg_menu');
        $icon = $menu_icon ? '<i class="nasa-menu-item-icon ' . esc_attr($menu_icon) . '"></i>' : '';
        $icon .= $menu_svg ? $menu_svg: '';

        if ($depth == 1 && in_array($item->menu_item_parent, $this->_mega)) {
            $mega_top = ' megatop';
        }

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $has_child = in_array('menu-item-has-children', $classes);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        
        $el_class = trim($this->_get_option($item->ID, 'el_class'));
        $class_names .= $el_class != '' ? ' ' . $el_class : '';
        
        $class_names = ' class="' . esc_attr($class_names) . $megamenu_class . $megacolumns . $mega_top . $class_even_odd . '"';
        $item_output = '<li' . $class_names . $bg . '>';

        $attributes = ' title="' . (!empty($item->attr_title) ? esc_attr($item->attr_title) : esc_attr($title_menu)) . '"';
        
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        
        $_href = !empty($item->url) ? esc_url($item->url) : 'javascript:void(0);';
        $attributes .= ' href="' . $_href . '"';

        $description = apply_filters('ns_theme_sp_menu_desc', true) && !empty($item->description) ? '<span class="nasa-menu-description">' . do_shortcode($item->description) . '</span>' : '';

        $prepend = '';
        $prepend .= !empty($item->menu_icon) ? '<span class="' . esc_attr($item->menu_icon) . ' nasa-menu_icon"></span>' : '';

        $item_output .= ($position == 'before' && $image_mega) ? '<a class="nasa-img-menu"' . $attributes . '>' . $image_mega . '</a>' : '';

        $item_output .= isset($args->before) ? $args->before : '';
        
        $classItem = !$title_disable ? ' class="nasa-title-menu"' : ' class="hidden-tag"';
        
        $item_output .= '<a' . $attributes . $classItem . '>';
        $item_output .= $icon;
        
        $item_output .= $depth == 0 && !$this->_in_mobile ? '<svg class="nasa-open-child" width="20" height="20" viewBox="0 0 32 32" fill="currentColor"><path d="M15.233 19.175l0.754 0.754 6.035-6.035-0.754-0.754-5.281 5.281-5.256-5.256-0.754 0.754 3.013 3.013z" /></svg>' : '';
        
        $item_output .= ($position == 'inline' && $image_mega) ? $image_mega : '';
        
        $item_output .= isset($args->link_before) ? $args->link_before . $prepend . $title_menu : '';
        
        $item_output .= $has_child && !$this->_in_mobile ? '<svg class="nasa-has-items-child" width="25" height="25" viewBox="0 0 32 32" fill="currentColor"><path d="M19.159 16.767l0.754-0.754-6.035-6.035-0.754 0.754 5.281 5.281-5.256 5.256 0.754 0.754 3.013-3.013z" /></svg>' : '';
        $item_output .= '</a>';

        $item_output .= isset($args->link_after) ? $args->link_after : '';
        $item_output .= !$title_disable ? $hr : '';
        $item_output .= isset($args->after) ? $args->after : '';
        $item_output .= ($position == 'after' && $image_mega) ? '<a class="nasa-img-menu"' . $attributes . '>' . $image_mega . '</a>' : '';
        $item_output .= $description;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id);
    }
    
    /**
     * End tag item
     * 
     * @param type $output
     * @param type $item
     * @param type $depth
     * @param type $args
     * @return type
     */
    public function end_el(&$output, $item, $depth = 0, $args = array()) {
        if ($item->post_type != 'nav_menu_item') {
            return;
        }
        
        $n = "\n";
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $n = '';
        }
        
        $output .= "</li>{$n}";
    }

}
