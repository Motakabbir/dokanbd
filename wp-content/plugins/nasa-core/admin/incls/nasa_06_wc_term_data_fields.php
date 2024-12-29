<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * Instantiate Class
 */
add_action('init', array('Nasa_WC_Term_Data_Fields', 'getInstance'), 0);

/**
 * @class 		Nasa_WC_Term_Data_Fields
 * @version		1.0
 * @author 		nasaTheme
 */
class Nasa_WC_Term_Data_Fields {
    
    /**
     * Products type_view
     */
    private $_cat_type_view = 'cat_type_view';

    /**
     * Products option_change_shop_layout
     */
    private $_cat_change_shop_layout = 'cat_change_shop_layout';

    /**
     * Products color_background_shop
     */
    private $_cat_color_background_shop = 'cat_color_background_shop';

    /**
     * Products color_background_shop_pro
     */
    private $_cat_color_background_shop_pro = 'cat_color_background_shop_pro';

    /**
     * Products type_layout
     */
    private $_cat_change_layout_type = 'cat_change_layout_type';
    
    /**
     * Products change_view
     */
    private $_cat_change_view = 'cat_change_view';

    /**
     * Products multicheck_options_cols_display
     */
    private $_cat_multicheck_options_cols_display = 'cat_multicheck_options_cols_display';
    
    /**
     * Products per row
     */
    private $_cat_per_row = 'cat_per_row';
    
    /**
     * Products per row - medium
     */
    private $_cat_per_row_medium = 'cat_per_row_medium';
    
    /**
     * Products per row - small
     */
    private $_cat_per_row_small = 'cat_per_row_small';
    
    /**
     * Products Layout Style
     */
    private $_cat_layout_style = 'cat_layout_style';
    
    /**
     * Products Masonry Mode
     */
    private $_cat_masonry_mode = 'cat_masonry_mode';
    
    /**
     * Products recommend_columns
     */
    private $_cat_recommend_columns = 'cat_recommend_columns';
    
    /**
     * Products recommend_columns medium
     */
    private $_cat_recommend_columns_medium = 'cat_recommend_columns_medium';
    
    /**
     * Products recommend_columns medium
     */
    private $_cat_recommend_columns_small = 'cat_recommend_columns_small';
    
    /**
     * Products relate_columns
     */
    private $_cat_relate_columns = 'cat_relate_columns';
    
    /**
     * Products relate_columns medium
     */
    private $_cat_relate_columns_medium = 'cat_relate_columns_medium';
    
    /**
     * Products relate_columns medium
     */
    private $_cat_relate_columns_small = 'cat_relate_columns_small';
    
    /**
     * Nasa more Width Allow
     */
    private $_cat_width_more_allow = 'cat_width_more_allow';
    
    /**
     * Nasa Add more Width site
     */
    private $_cat_width_more = 'cat_width_more';

    /**
     * Nasa Dark version in top category
     */
    private $_cat_bg_dark = 'cat_bg_dark';

    /**
     * Nasa Content in top category
     */
    private $_cat_header = 'cat_header';

    /**
     * Nasa Content in bottom category
     */
    private $_cat_footer_content = 'cat_footer_content';
    
    /**
     * Nasa Enable breadcrumb category
     */
    private $_cat_bread_allow = 'cat_breadcrumb_allow';
    
    /**
     * Nasa Enable breadcrumb category Layout
     */
    private $_cat_bread_layout = 'cat_breadcrumb_layout';
    
    /**
     * Nasa Enable breadcrumb category
     */
    private $_cat_bread_enable = 'cat_breadcrumb';

    /**
     * Nasa Background breadcrumb category
     */
    private $_cat_bread_bg = 'cat_breadcrumb_bg';
    
    /**
     * Nasa Background breadcrumb category in Mobile
     */
    private $_cat_bread_bg_m = 'cat_breadcrumb_bg_m';

    /**
     * Nasa Text color breadcrumb category
     */
    private $_cat_bread_bg_color = 'cat_breadcrumb_bg_color';
    
    /**
     * Nasa Text color breadcrumb category
     */
    private $_cat_bread_text = 'cat_breadcrumb_text_color';
    
    /**
     * Nasa Text Align breadcrumb category
     */
    private $_cat_bread_align = 'cat_breadcrumb_align';
    
    /**
     * Nasa Height breadcrumb category
     */
    private $_cat_bread_height = 'cat_breadcrumb_height';
    
    /**
     * Nasa Height mobile breadcrumb category
     */
    private $_cat_bread_height_m = 'cat_breadcrumb_height_m';
    
    /**
     * Nasa After Breadcrumb
     */
    private $_cat_bread_after = 'cat_bread_after';

    /**
     * Nasa Sidebar category
     */
    private $_cat_sidebar = 'cat_sidebar_override';

    /**
     * Nasa Sidebar category
     */
    private $_cat_sidebar_layout = 'cat_sidebar_layout';

    /**
     * Nasa Primary Color category
     */
    private $_cat_primary_color = 'cat_primary_color';

    /**
     * Nasa Logo category Flag
     */
    private $_cat_logo_flag = 'cat_logo_flag';
    
    /**
     * Nasa Logo category
     */
    private $_cat_logo = 'cat_logo';

    /**
     * Nasa Logo retina category
     */
    private $_cat_logo_retina = 'cat_logo_retina';

    /**
     * Nasa Logo sticky category
     */
    private $_cat_logo_sticky = 'cat_logo_sticky';
    
    /**
     * Nasa Logo mobile category
     */
    private $_cat_logo_m = 'cat_logo_m';

    /**
     * Nasa Header type category
     */
    private $_cat_header_type = 'cat_header_type';

    /**
     * Nasa The Block beside Main menu in Header Type 4, 6
     */
    private $_cat_the_block_beside_main_menu_4_6 = 'cat_the_block_beside_main_menu_4_6';

    /**
     * Nasa Header builder category
     */
    private $_cat_header_builder = 'cat_header_builder';
    
    /**
     * Nasa Header elm category
     */
    private $_cat_header_elm = 'cat_header_elm';

    /**
     * Nasa Header vertical menu
     */
    private $_cat_header_vertical_menu = 'cat_header_vertical_menu';
    
    /**
     * Nasa Header vertical menu only show root items
     */
    private $_cat_header_vertical_menu_root = 'cat_header_v_root';
    
    /**
     * Nasa Header vertical menu only show root items - limit
     */
    private $_cat_header_vertical_menu_root_limit = 'cat_header_v_root_limit';
    
    /**
     * Nasa Topbar category
     */
    private $_cat_topbar_on = 'cat_topbar_on';
    
    /**
     * Nasa Header BG
     */
    private $_cat_header_bg_color = 'cat_header_bg';
    private $_cat_header_bg_color_stk = 'cat_header_bg_stk';
    
    /**
     * Nasa Header text color
     */
    private $_cat_header_text_color = 'cat_header_text';
    private $_cat_header_text_color_stk = 'cat_header_text_stk';
    
    /**
     * Nasa Header text color Hover
     */
    private $_cat_header_text_color_hv = 'cat_header_text_hv';
    private $_cat_header_text_color_hv_stk = 'cat_header_text_hv_stk';
    
    /**
     * Nasa Topbar BG
     */
    private $_cat_topbar_bg_color = 'cat_topbar_bg';
    
    /**
     * Nasa Topbar text color
     */
    private $_cat_topbar_text_color = 'cat_topbar_text';
    
    /**
     * Nasa Topbar text color Hover
     */
    private $_cat_topbar_text_color_hv = 'cat_topbar_text_hv';
    
    /**
     * Nasa Main menu BG
     */
    private $_cat_main_menu_bg = 'cat_main_menu_bg';
    private $_cat_main_menu_bg_stk = 'cat_main_menu_bg_stk';
    
    /**
     * Nasa Main menu text
     */
    private $_cat_main_menu_text = 'cat_main_menu_text';
    private $_cat_main_menu_text_stk = 'cat_main_menu_text_stk';
    
    /**
     * Nasa Vertical menu BG
     */
    private $_cat_v_menu_bg = 'cat_v_menu_bg';
    private $_cat_v_menu_bg_stk = 'cat_v_menu_bg_stk';
    
    /**
     * Nasa Vertical menu text
     */
    private $_cat_v_menu_text = 'cat_v_menu_text';
    private $_cat_v_menu_text_stk = 'cat_v_menu_text_stk';

    /**
     * Nasa Footer mode category
     */
    private $_cat_footer_mode = 'cat_footer_mode';

    /**
     * Nasa Popup Static Block
     */
    private $_cat_popup_static_block = 'cat_popup_static_block';

    /**
     * Nasa Footer Built-in category
     */
    private $_cat_footer_build_in = 'cat_footer_build_in';

    /**
     * Nasa Footer Built-in Mobile category
     */
    private $_cat_footer_build_in_mobile = 'cat_footer_build_in_mobile';

    /**
     * Nasa Footer Builder category
     */
    private $_cat_footer_type = 'cat_footer_type';

    /**
     * Nasa Footer Builder for Mobile category
     */
    private $_cat_footer_mobile = 'cat_footer_mobile';

    /**
     * Nasa Footer Builder Elementor category
     */
    private $_cat_footer_builder_e = 'cat_footer_builder_e';

    /**
     * Nasa Footer Builder Elementor Mobile category
     */
    private $_cat_footer_builder_e_mobile = 'cat_footer_builder_e_mobile';

    /**
     * Nasa hover effect product category
     */
    private $_cat_effect_hover = 'cat_effect_hover';

    /**
     * Attribute Image Style
     */
    private $_cat_attr_image_style = 'cat_attr_image_style';

    /**
     * Attribute Image Style for Single - Quick view
     */
    private $_cat_attr_image_single_style = 'cat_attr_image_single_style';

    /**
     * Attribute Color Style
     */
    private $_cat_attr_color_style = 'cat_attr_color_style';

    /**
     * Attribute Label Style
     */
    private $_cat_attr_label_style = 'cat_attr_label_style';

    /**
     * Size Guide Block
     */
    private $_cat_size_guide_block = 'cat_size_guide_block';

    /**
     * Type Font Default | Custom | Google
     */
    private $_type_font = 'type_font';

    /**
     * H1 H2 H3 H4 H5 H6 Font Google
     */
    private $_headings_font = 'headings_font';

    /**
     * paragraphs, etc Font Google
     */
    private $_texts_font = 'texts_font';

    /**
     * Menu navigation Font Google
     */
    private $_nav_font = 'nav_font';

    /**
     * Banner Font Google
     */
    private $_banner_font = 'banner_font';

    /**
     * Price Font Google
     */
    private $_price_font = 'price_font';

    /**
     * Custom Font uploaded
     */
    private $_custom_font = 'custom_font';
    
    /**
     * Custom Font Weight
     */
    private $_font_weight = 'font_weight';

    /**
     * Single Product sidebar position
     */
    private $_product_sidebar = 'single_product_sidebar';
    
    /**
     * Single Product layout
     */
    private $_product_layout = 'single_product_layout';
    
    /**
     * Single Product layout BG
     */
    private $_product_layout_bg_color = 'single_product_layout_bg';

    /**
     * Single Product Image layout
     */
    private $_product_image_layout = 'single_product_image_layout';

    /**
     * Single Product Image style
     */
    private $_product_image_style = 'single_product_image_style';

    /**
     * Single Product Thumbnail style
     */
    private $_product_thumbs_style = 'single_product_thumbs_style';
    
    /**
     * Single Product Half full slide
     */
    private $_product_half_full_slide = 'single_product_half_full_slide';
    
    /**
     * Single Product Info Columns
     */
    private $_product_full_info_col = 'single_product_full_info_col';

    /**
     * Single Product Tabs style
     */
    private $_product_tabs_style = 'single_product_tabs_style';
    
    /**
     * Single Product Tabs global
     */
    private $_product_tabs_glb = 'single_product_tab_glb';

    /**
     * Enable Custom Tax
     */
    private $_custom_tax = 'nasa_custom_tax';

    /**
     * Enable Custom Tax
     */
    private $_loop_layout_buttons = 'nasa_loop_layout_buttons';

    /**
     * Nasa init Object category
     */
    private static $_instance = null;

    /**
     * templates
     */
    protected $_template = NASA_CORE_PLUGIN_PATH . 'admin/views/product_category/';

    /**
     * Intance start contructor
     */
    public static function getInstance() {
        if (!NASA_WOO_ACTIVED) {
            return null;
        }

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Contructor
     */
    public function __construct() {
        /**
         * Advance - fields
         */
        add_action('product_cat_add_form_fields', array($this, 'ns_advanced_settings'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'ns_advanced_settings'), 10, 1);
        
        /**
         * Cat top content
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_header'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_header'), 10, 1);

        /**
         * Cat bot content
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_footer_content'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_footer_content'), 10, 1);
        
        /**
         * Override sidebar for Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_sidebar'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_sidebar'), 10, 1);
        
        /**
         * Cat Custom Views
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_ct_view'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_ct_view'), 10, 1);
        
        /**
         * Cat Add More Width
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_width_more'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_width_more'), 10, 1);
        
        /**
         * Cat Background Dark
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_bg_dark'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_bg_dark'), 10, 1);

        /**
         * Cat Logo => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_logo_create'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_logo_edit'), 10, 1);

        /**
         * Cat breadcrumb
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_breadcrumb'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_breadcrumb'), 10, 1);

        /**
         * Override sidebar Layout for Category => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_sidebar_layout'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_sidebar_layout'), 10, 1);

        /**
         * Override primary for Category => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_primary_color'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_primary_color'), 10, 1);

        /**
         * Override Font for Category => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_font_style'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_font_style'), 10, 1);

        /**
         * Override Layout Single product for Category => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_single_product'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_single_product'), 10, 1);

        /**
         * Override Header & Footer => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_header_footer_type'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_header_footer_type'), 10, 1);
        
        /**
         * Override Enable Nasa Custom Taxonomy
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_custom_tax'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_custom_tax'), 10, 1);
        
        /**
         * Override Loop layout buttons
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_loop_layout_buttons'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_loop_layout_buttons'), 10, 1);

        /**
         * Override Effect hover product => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_effect_hover_product'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_effect_hover_product'), 10, 1);

        /**
         * Override Attribute Image display Style
         * Round | Square
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_attr_image_style'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_attr_image_style'), 10, 1);

        /**
         * Override Attribute Image display Style in Single | Quick view
         * extends - from attr_image_style
         * Square - Caption
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_attr_image_single_style'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_attr_image_single_style'), 10, 1);

        /**
         * Override Attribute Color display Style
         * Radio Style - Tooltip
         * Round Wrapper - Tooltip
         * Small Square
         * Big Square
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_attr_color_style'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_attr_color_style'), 10, 1);

        /**
         * Override Attribute Label display Style
         * Radio Style
         * Round Wrapper
         * Small Square
         * Big Square
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_attr_label_style'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_attr_label_style'), 10, 1);

        /**
         * Cat Size Guide Block => Only for Root Category
         */
        add_action('product_cat_add_form_fields', array($this, 'taxonomy_size_guide_block'), 10, 1);
        add_action('product_cat_edit_form_fields', array($this, 'taxonomy_size_guide_block'), 10, 1);

        /**
         * Save or Edit Term
         */
        add_action('created_term', array($this, 'save_taxonomy_custom_fields'), 10, 3);
        add_action('edit_term', array($this, 'save_taxonomy_custom_fields'), 10, 3);
    }

    /**
     * Create custom Override Category Sidebar Layout
     */
    public function taxonomy_custom_tax($term = null) {
        global $nasa_opt;

        if (!isset($nasa_opt['enable_nasa_custom_categories']) || !$nasa_opt['enable_nasa_custom_categories']) {
            return;
        }

        include $this->_template . 'custom_tax.php';
    }
    
    /**
     * Advanced_settings - Toggle
     */
    public function ns_advanced_settings($term = null) {
        include $this->_template . 'advanced_settings.php';
    }

    /**
     * Add More Width site
     */
    public function taxonomy_cat_ct_view($term = null) {
        include $this->_template . 'cat_ct_view.php';
    }
    
    /**
     * Add More Width site
     */
    public function taxonomy_cat_width_more($term = null) {
        include $this->_template . 'cat_width_more.php';
    }
    
    /**
     * Background Dark
     */
    public function taxonomy_cat_bg_dark($term = null) {
        include $this->_template . 'cat_bg_dark.php';
    }

    /**
     * Create custom Override Category Sidebar Layout
     */
    public function taxonomy_loop_layout_buttons($term = null) {
        include $this->_template . 'loop_layout_buttons.php';
    }

    /**
     * Create custom Override Category Sidebar Layout
     */
    public function taxonomy_cat_sidebar_layout($term = null) {
        include $this->_template . 'cat_sidebar_layout.php';
    }

    /**
     * Create custom attr image style
     */
    public function taxonomy_attr_image_style($term = null) {
        include $this->_template . 'attr_image_style.php';
    }

    /**
     * Create custom attr image single style - Single | Quick view
     */
    public function taxonomy_attr_image_single_style($term = null) {
        include $this->_template . 'attr_image_single_style.php';
    }

    /**
     * Create custom attr Color style - Single | Quick view
     */
    public function taxonomy_attr_color_style($term = null) {
        include $this->_template . 'attr_color_style.php';
    }

    /**
     * Create custom attr Label style - Single | Quick view
     */
    public function taxonomy_attr_label_style($term = null) {
        include $this->_template . 'attr_label_style.php';
    }

    /**
     * Create custom Override effect hover product
     */
    public function taxonomy_effect_hover_product($term = null) {
        include $this->_template . 'effect_hover_product.php';
    }

    /**
     * Create custom Override Header & Footer Type
     */
    public function taxonomy_cat_header_footer_type($term = null) {
        include $this->_template . 'cat_header_footer_type.php';
    }

    /**
     * _cat_primary_color
     * 
     * Custom primary color
     * @param type $term
     * Only use with Root Category
     */
    public function taxonomy_primary_color($term = null) {
        include $this->_template . 'primary_color.php';
    }

    /**
     * _type_font
     * 
     * Custom Font style
     * @param type $term
     * 
     * Only use with Root Category
     */
    public function taxonomy_font_style($term = null) {
        include $this->_template . 'font_style.php';
    }

    /**
     * 
     * Custom Single product
     * @param type $term
     * 
     * Only use with Root Category
     */
    public function taxonomy_single_product($term = null) {
        include $this->_template . 'single_product.php';
    }

    /**
     * Create custom Override sidebar
     */
    public function taxonomy_cat_sidebar($term = null) {
        include $this->_template . 'cat_sidebar.php';
    }

    /**
     * Create custom cat header
     */
    public function taxonomy_cat_header($term = null) {
        include $this->_template . 'cat_header.php';
    }

    /**
     * Custom Footer content
     */
    public function taxonomy_cat_footer_content($term = null) {
        include $this->_template . 'cat_footer_content.php';
    }

    /**
     * Create custom logo
     * Case create category
     */
    public function taxonomy_logo_create() {
        include $this->_template . 'logo_create.php';
    }

    /**
     * Edit custom logo
     * Case edit category
     */
    public function taxonomy_logo_edit($term = null) {
        include $this->_template . 'logo_edit.php';
    }

    /**
     * Create custom breadcrumb
     * Case create category
     */
    // public function taxonomy_background_breadcrumb_create() {
    //     include $this->_template . 'background_breadcrumb_create.php';
    // }

    /**
     * Edit custom breadcrumb
     * Case edit category
     */
    // public function taxonomy_background_breadcrumb_edit($term = null) {
    //     include $this->_template . 'background_breadcrumb_edit.php';
    // }
    
    /**
     * custom breadcrumb
     */
    public function taxonomy_breadcrumb($term = null) {
        include $this->_template . 'breadcrumb.php';
    }

    /**
     * Size guide Block
     */
    public function taxonomy_size_guide_block($term = null) {
        include $this->_template . 'size_guide_block.php';
    }

    /**
     * Save taxonomy custom fields
     */
    public function save_taxonomy_custom_fields($term_id, $tt_id = '', $taxonomy = '') {
        if ('product_cat' == $taxonomy) {

            /**
             * _cat_type_view
             */
            if (isset($_POST[$this->_cat_type_view])) {
                update_term_meta($term_id, $this->_cat_type_view, $_POST[$this->_cat_type_view]);
            }

            /**
             * _cat_change_shop_layout
             */
            if (isset($_POST[$this->_cat_change_shop_layout])) {
                update_term_meta($term_id, $this->_cat_change_shop_layout, $_POST[$this->_cat_change_shop_layout]);
            }

            /**
             * _cat_color_background_shop
             */
            if (isset($_POST[$this->_cat_color_background_shop])) {
                update_term_meta($term_id, $this->_cat_color_background_shop, $_POST[$this->_cat_color_background_shop]);
            }

            /**
             * _cat_color_background_shop_pro
             */
            if (isset($_POST[$this->_cat_color_background_shop_pro])) {
                update_term_meta($term_id, $this->_cat_color_background_shop_pro, $_POST[$this->_cat_color_background_shop_pro]);
            }

            /**
             * _cat_type_layout
             */
            if (isset($_POST[$this->_cat_change_layout_type])) {
                update_term_meta($term_id, $this->_cat_change_layout_type, $_POST[$this->_cat_change_layout_type]);
            }
            
            /**
             * _cat_change_view
             */
            if (isset($_POST[$this->_cat_change_view])) {
                update_term_meta($term_id, $this->_cat_change_view, $_POST[$this->_cat_change_view]);
            }

            /**
             * _cat_type_layout
             */
            if (isset($_POST[$this->_cat_multicheck_options_cols_display])) {
                $data_multicheck_options = array("2-cols" => '0', "3-cols" => '0', "4-cols" => '0', "5-cols" => '0',"6-cols" => '0', "list" => '0', "list-2cols" => '0');
                foreach ($_POST[$this->_cat_multicheck_options_cols_display] as $key => $val) {
                    if ($val && !in_array($key, $data_multicheck_options)) {
                        $data_multicheck_options[$key] = $val;
                    }
                }

                update_term_meta($term_id, $this->_cat_multicheck_options_cols_display, $data_multicheck_options);
            } else {
                $data_multicheck_options = array();
                update_term_meta($term_id, $this->_cat_multicheck_options_cols_display, $data_multicheck_options);
            }
            
            /**
             * _cat_per_row
             */
            if (isset($_POST[$this->_cat_per_row])) {
                update_term_meta($term_id, $this->_cat_per_row, $_POST[$this->_cat_per_row]);
            }
            
            /**
             * _cat_per_row_medium
             */
            if (isset($_POST[$this->_cat_per_row_medium])) {
                update_term_meta($term_id, $this->_cat_per_row_medium, $_POST[$this->_cat_per_row_medium]);
            }
            
            /**
             * _cat_per_row_small
             */
            if (isset($_POST[$this->_cat_per_row_small])) {
                update_term_meta($term_id, $this->_cat_per_row_small, $_POST[$this->_cat_per_row_small]);
            }
            
            /**
             * _cat_layout_style
             */
            if (isset($_POST[$this->_cat_layout_style])) {
                update_term_meta($term_id, $this->_cat_layout_style, $_POST[$this->_cat_layout_style]);
            }
            
            /**
             * _cat_masonry_mode
             */
            if (isset($_POST[$this->_cat_masonry_mode])) {
                update_term_meta($term_id, $this->_cat_masonry_mode, $_POST[$this->_cat_masonry_mode]);
            }
            
            /**
             * _cat_Recommend columns
             */
            if (isset($_POST[$this->_cat_recommend_columns])) {
                update_term_meta($term_id, $this->_cat_recommend_columns, $_POST[$this->_cat_recommend_columns]);
            }
            
            /**
             * _cat_Recommend columns medium
             */
            if (isset($_POST[$this->_cat_recommend_columns_medium])) {
                update_term_meta($term_id, $this->_cat_recommend_columns_medium, $_POST[$this->_cat_recommend_columns_medium]);
            }
            
            /**
             * _cat_Recommend columns small
             */
            if (isset($_POST[$this->_cat_recommend_columns_small])) {
                update_term_meta($term_id, $this->_cat_recommend_columns_small, $_POST[$this->_cat_recommend_columns_small]);
            }
            
            /**
             * _cat_relate columns
             */
            if (isset($_POST[$this->_cat_relate_columns])) {
                update_term_meta($term_id, $this->_cat_relate_columns, $_POST[$this->_cat_relate_columns]);
            }
            
            /**
             * _cat_relate columns medium
             */
            if (isset($_POST[$this->_cat_relate_columns_medium])) {
                update_term_meta($term_id, $this->_cat_relate_columns_medium, $_POST[$this->_cat_relate_columns_medium]);
            }
            
            /**
             * _cat_relate columns small
             */
            if (isset($_POST[$this->_cat_relate_columns_small])) {
                update_term_meta($term_id, $this->_cat_relate_columns_small, $_POST[$this->_cat_relate_columns_small]);
            }
            
            /**
             * More Width Allow
             */
            if (isset($_POST[$this->_cat_width_more_allow])) {
                update_term_meta($term_id, $this->_cat_width_more_allow, $_POST[$this->_cat_width_more_allow]);
            }
            
            /**
             * More Width site
             */
            if (isset($_POST[$this->_cat_width_more])) {
                update_term_meta($term_id, $this->_cat_width_more, $_POST[$this->_cat_width_more]);
            }
            
            /**
             * BG Dark
             */
            if (isset($_POST[$this->_cat_bg_dark])) {
                update_term_meta($term_id, $this->_cat_bg_dark, $_POST[$this->_cat_bg_dark]);
            }

            /**
             * Top Content
             */
            if (isset($_POST[$this->_cat_header])) {
                update_term_meta($term_id, $this->_cat_header, $_POST[$this->_cat_header]);
            }

            /**
             * Bottom Content
             */
            if (isset($_POST[$this->_cat_footer_content])) {
                update_term_meta($term_id, $this->_cat_footer_content, $_POST[$this->_cat_footer_content]);
            }

            /**
             * Logo Flag
             */
            if (isset($_POST[$this->_cat_logo_flag])) {
                update_term_meta($term_id, $this->_cat_logo_flag, $_POST[$this->_cat_logo_flag]);
            }
            
            /**
             * Logo
             */
            if (isset($_POST[$this->_cat_logo])) {
                update_term_meta($term_id, $this->_cat_logo, $_POST[$this->_cat_logo]);
            }

            /**
             * Logo retina
             */
            if (isset($_POST[$this->_cat_logo_retina])) {
                update_term_meta($term_id, $this->_cat_logo_retina, $_POST[$this->_cat_logo_retina]);
            }

            /**
             * Logo Sticky
             */
            if (isset($_POST[$this->_cat_logo_sticky])) {
                update_term_meta($term_id, $this->_cat_logo_sticky, $_POST[$this->_cat_logo_sticky]);
            }
            
            /**
             * Logo Sticky
             */
            if (isset($_POST[$this->_cat_logo_m])) {
                update_term_meta($term_id, $this->_cat_logo_m, $_POST[$this->_cat_logo_m]);
            }
            
            /**
             * Breadcrumb Allow
             */
            if (isset($_POST[$this->_cat_bread_allow])) {
                update_term_meta($term_id, $this->_cat_bread_allow, $_POST[$this->_cat_bread_allow]);
            }

            /**
             * Breadcrumb Layout
             */
            if (isset($_POST[$this->_cat_bread_layout])) {
                update_term_meta($term_id, $this->_cat_bread_layout, $_POST[$this->_cat_bread_layout]);
            }
            
            /**
             * Breadcrumb type
             */
            if (isset($_POST[$this->_cat_bread_enable])) {
                update_term_meta($term_id, $this->_cat_bread_enable, $_POST[$this->_cat_bread_enable]);
            }

            /**
             * Breadcrumb BG Image
             */
            if (isset($_POST[$this->_cat_bread_bg])) {
                update_term_meta($term_id, $this->_cat_bread_bg, $_POST[$this->_cat_bread_bg]);
            }
            
            /**
             * Breadcrumb BG Image - Mobile
             */
            if (isset($_POST[$this->_cat_bread_bg_m])) {
                update_term_meta($term_id, $this->_cat_bread_bg_m, $_POST[$this->_cat_bread_bg_m]);
            }

            /**
             * Breadcrumb BG color
             */
            if (isset($_POST[$this->_cat_bread_bg_color])) {
                update_term_meta($term_id, $this->_cat_bread_bg_color, $_POST[$this->_cat_bread_bg_color]);
            }
            
            /**
             * Breadcrumb text color
             */
            if (isset($_POST[$this->_cat_bread_text])) {
                update_term_meta($term_id, $this->_cat_bread_text, $_POST[$this->_cat_bread_text]);
            }
            
            /**
             * Breadcrumb text Align
             */
            if (isset($_POST[$this->_cat_bread_align])) {
                update_term_meta($term_id, $this->_cat_bread_align, $_POST[$this->_cat_bread_align]);
            }
            
            /**
             * Breadcrumb Height
             */
            if (isset($_POST[$this->_cat_bread_height])) {
                update_term_meta($term_id, $this->_cat_bread_height, $_POST[$this->_cat_bread_height]);
            }
            
            /**
             * Breadcrumb Height - Mobile
             */
            if (isset($_POST[$this->_cat_bread_height_m])) {
                update_term_meta($term_id, $this->_cat_bread_height_m, $_POST[$this->_cat_bread_height_m]);
            }
            
            /**
             * Breadcrumb After
             */
            if (isset($_POST[$this->_cat_bread_after])) {
                update_term_meta($term_id, $this->_cat_bread_after, $_POST[$this->_cat_bread_after]);
            }

            /**
             * Header type
             */
            if (isset($_POST[$this->_cat_header_type])) {
                update_term_meta($term_id, $this->_cat_header_type, $_POST[$this->_cat_header_type]);
            }

            /**
             * The Block beside Main menu in Header Type 4, 6
             */
            $header_has_vertical_menu = array('4', '6'); // Header use Vertical Menu
            if (isset($_POST[$this->_cat_header_type]) && in_array($_POST[$this->_cat_header_type], $header_has_vertical_menu) && isset($_POST[$this->_cat_the_block_beside_main_menu_4_6])) {
                update_term_meta($term_id, $this->_cat_the_block_beside_main_menu_4_6, $_POST[$this->_cat_the_block_beside_main_menu_4_6]);
            } else {
                update_term_meta($term_id, $this->_cat_the_block_beside_main_menu_4_6, '');
            }

            /**
             * Header Theme Builder
             */
            if (isset($_POST[$this->_cat_header_type]) && $_POST[$this->_cat_header_type] == 'nasa-custom' && isset($_POST[$this->_cat_header_builder])) {
                update_term_meta($term_id, $this->_cat_header_builder, $_POST[$this->_cat_header_builder]);
            } else {
                update_term_meta($term_id, $this->_cat_header_builder, '');
            }
            
            /**
             * Header Elementor Builder
             */
            if (isset($_POST[$this->_cat_header_type]) && $_POST[$this->_cat_header_type] == 'nasa-elm' && isset($_POST[$this->_cat_header_elm])) {
                update_term_meta($term_id, $this->_cat_header_elm, $_POST[$this->_cat_header_elm]);
            } else {
                update_term_meta($term_id, $this->_cat_header_elm, '');
            }

            /**
             * Vertical Menu
             */
            $header_has_vertical_menu = array('4', '6'); // Header use Vertical Menu
            if (isset($_POST[$this->_cat_header_type]) && in_array($_POST[$this->_cat_header_type], $header_has_vertical_menu) && isset($_POST[$this->_cat_header_vertical_menu])) {
                update_term_meta($term_id, $this->_cat_header_vertical_menu, $_POST[$this->_cat_header_vertical_menu]);
                update_term_meta($term_id, $this->_cat_header_vertical_menu_root, $_POST[$this->_cat_header_vertical_menu_root]);
                update_term_meta($term_id, $this->_cat_header_vertical_menu_root_limit, $_POST[$this->_cat_header_vertical_menu_root_limit]);
            } else {
                update_term_meta($term_id, $this->_cat_header_vertical_menu, '');
                update_term_meta($term_id, $this->_cat_header_vertical_menu_root, '');
                update_term_meta($term_id, $this->_cat_header_vertical_menu_root_limit, '');
            }
            
            /**
             * Header Top bar On | Off
             */
            if (isset($_POST[$this->_cat_topbar_on])) {
                update_term_meta($term_id, $this->_cat_topbar_on, $_POST[$this->_cat_topbar_on]);
            }
            
            /**
             * Header Background Color
             */
            if (isset($_POST[$this->_cat_header_bg_color])) {
                update_term_meta($term_id, $this->_cat_header_bg_color, $_POST[$this->_cat_header_bg_color]);
            }
            
            if (isset($_POST[$this->_cat_header_bg_color_stk])) {
                update_term_meta($term_id, $this->_cat_header_bg_color_stk, $_POST[$this->_cat_header_bg_color_stk]);
            }
            
            /**
             * Header Text Color
             */
            if (isset($_POST[$this->_cat_header_text_color])) {
                update_term_meta($term_id, $this->_cat_header_text_color, $_POST[$this->_cat_header_text_color]);
            }
            
            if (isset($_POST[$this->_cat_header_text_color_stk])) {
                update_term_meta($term_id, $this->_cat_header_text_color_stk, $_POST[$this->_cat_header_text_color_stk]);
            }
            
            /**
             * Header Text Color Hover
             */
            if (isset($_POST[$this->_cat_header_text_color_hv])) {
                update_term_meta($term_id, $this->_cat_header_text_color_hv, $_POST[$this->_cat_header_text_color_hv]);
            }
            
            if (isset($_POST[$this->_cat_header_text_color_hv_stk])) {
                update_term_meta($term_id, $this->_cat_header_text_color_hv_stk, $_POST[$this->_cat_header_text_color_hv_stk]);
            }
            
            /**
             * Topbar BG Color
             */
            if (isset($_POST[$this->_cat_topbar_bg_color])) {
                update_term_meta($term_id, $this->_cat_topbar_bg_color, $_POST[$this->_cat_topbar_bg_color]);
            }
            
            /**
             * Topbar Text Color
             */
            if (isset($_POST[$this->_cat_topbar_text_color])) {
                update_term_meta($term_id, $this->_cat_topbar_text_color, $_POST[$this->_cat_topbar_text_color]);
            }
            
            /**
             * Topbar Text Color Hover
             */
            if (isset($_POST[$this->_cat_topbar_text_color_hv])) {
                update_term_meta($term_id, $this->_cat_topbar_text_color_hv, $_POST[$this->_cat_topbar_text_color_hv]);
            }
            
            /**
             * Main Menu BG
             */
            if (isset($_POST[$this->_cat_main_menu_bg])) {
                update_term_meta($term_id, $this->_cat_main_menu_bg, $_POST[$this->_cat_main_menu_bg]);
            }
            
            if (isset($_POST[$this->_cat_main_menu_bg_stk])) {
                update_term_meta($term_id, $this->_cat_main_menu_bg_stk, $_POST[$this->_cat_main_menu_bg_stk]);
            }
            
            /**
             * Main Menu Text
             */
            if (isset($_POST[$this->_cat_main_menu_text])) {
                update_term_meta($term_id, $this->_cat_main_menu_text, $_POST[$this->_cat_main_menu_text]);
            }
            
            if (isset($_POST[$this->_cat_main_menu_text_stk])) {
                update_term_meta($term_id, $this->_cat_main_menu_text_stk, $_POST[$this->_cat_main_menu_text_stk]);
            }
            
            /**
             * Vertical Menu BG
             */
            if (isset($_POST[$this->_cat_v_menu_bg])) {
                update_term_meta($term_id, $this->_cat_v_menu_bg, $_POST[$this->_cat_v_menu_bg]);
            }
            
            if (isset($_POST[$this->_cat_v_menu_bg_stk])) {
                update_term_meta($term_id, $this->_cat_v_menu_bg_stk, $_POST[$this->_cat_v_menu_bg_stk]);
            }
            
            /**
             * Vertical Menu Text
             */
            if (isset($_POST[$this->_cat_v_menu_text])) {
                update_term_meta($term_id, $this->_cat_v_menu_text, $_POST[$this->_cat_v_menu_text]);
            }
            
            if (isset($_POST[$this->_cat_v_menu_text_stk])) {
                update_term_meta($term_id, $this->_cat_v_menu_text_stk, $_POST[$this->_cat_v_menu_text_stk]);
            }

            /**
             * Footer mode
             */
            if (isset($_POST[$this->_cat_footer_mode])) {
                update_term_meta($term_id, $this->_cat_footer_mode, $_POST[$this->_cat_footer_mode]);
            }

            /**
             * Footer Popup Static Block
             */
            if (isset($_POST[$this->_cat_popup_static_block])) {
                update_term_meta($term_id, $this->_cat_popup_static_block, $_POST[$this->_cat_popup_static_block]);
            }

            /**
             * Footer Built-in
             */
            if (isset($_POST[$this->_cat_footer_build_in])) {
                update_term_meta($term_id, $this->_cat_footer_build_in, $_POST[$this->_cat_footer_build_in]);
            }

            /**
             * Footer Built-in Mobile
             */
            if (isset($_POST[$this->_cat_footer_build_in_mobile])) {
                update_term_meta($term_id, $this->_cat_footer_build_in_mobile, $_POST[$this->_cat_footer_build_in_mobile]);
            }

            /**
             * Footer type
             */
            if (isset($_POST[$this->_cat_footer_type])) {
                update_term_meta($term_id, $this->_cat_footer_type, $_POST[$this->_cat_footer_type]);
            }

            /**
             * Footer Mobile
             */
            if (isset($_POST[$this->_cat_footer_mobile])) {
                update_term_meta($term_id, $this->_cat_footer_mobile, $_POST[$this->_cat_footer_mobile]);
            }

            /**
             * Footer Builder Elementor
             */
            if (isset($_POST[$this->_cat_footer_builder_e])) {
                update_term_meta($term_id, $this->_cat_footer_builder_e, $_POST[$this->_cat_footer_builder_e]);
            }

            /**
             * Footer Builder Elementor Mobile
             */
            if (isset($_POST[$this->_cat_footer_builder_e_mobile])) {
                update_term_meta($term_id, $this->_cat_footer_builder_e_mobile, $_POST[$this->_cat_footer_builder_e_mobile]);
            }

            /**
             * Primary color
             */
            if (isset($_POST[$this->_cat_primary_color])) {
                update_term_meta($term_id, $this->_cat_primary_color, $_POST[$this->_cat_primary_color]);
            }

            /**
             * Font Style
             */
            if (isset($_POST[$this->_type_font])) {
                update_term_meta($term_id, $this->_type_font, $_POST[$this->_type_font]);
            }

            /**
             * Headings Font
             */
            if (isset($_POST[$this->_headings_font])) {
                update_term_meta($term_id, $this->_headings_font, $_POST[$this->_headings_font]);
            }

            /**
             * Texts Font
             */
            if (isset($_POST[$this->_texts_font])) {
                update_term_meta($term_id, $this->_texts_font, $_POST[$this->_texts_font]);
            }

            /**
             * Navigation Font
             */
            if (isset($_POST[$this->_nav_font])) {
                update_term_meta($term_id, $this->_nav_font, $_POST[$this->_nav_font]);
            }

            /**
             * Banner Font
             */
            if (isset($_POST[$this->_banner_font])) {
                update_term_meta($term_id, $this->_banner_font, $_POST[$this->_banner_font]);
            }

            /**
             * Price Font
             */
            if (isset($_POST[$this->_price_font])) {
                update_term_meta($term_id, $this->_price_font, $_POST[$this->_price_font]);
            }

            /**
             * Custom Font
             */
            if (isset($_POST[$this->_custom_font])) {
                update_term_meta($term_id, $this->_custom_font, $_POST[$this->_custom_font]);
            }
            
            /**
             * Font Weight
             */
            if (isset($_POST[$this->_font_weight])) {
                update_term_meta($term_id, $this->_font_weight, $_POST[$this->_font_weight]);
            }

            /**
             * Single Product sidebar position
             */
            if (isset($_POST[$this->_product_sidebar])) {
                update_term_meta($term_id, $this->_product_sidebar, $_POST[$this->_product_sidebar]);
            }
            
            /**
             * Single Product layout
             */
            if (isset($_POST[$this->_product_layout])) {
                update_term_meta($term_id, $this->_product_layout, $_POST[$this->_product_layout]);
            }
            
            /**
             * Single Product layout BG
             */
            if (isset($_POST[$this->_product_layout_bg_color])) {
                update_term_meta($term_id, $this->_product_layout_bg_color, $_POST[$this->_product_layout_bg_color]);
            }

            /**
             * Single Product Image Layout
             */
            if (isset($_POST[$this->_product_image_layout])) {
                update_term_meta($term_id, $this->_product_image_layout, $_POST[$this->_product_image_layout]);
            }

            /**
             * Single Product Image Style
             */
            if (isset($_POST[$this->_product_image_style])) {
                update_term_meta($term_id, $this->_product_image_style, $_POST[$this->_product_image_style]);
            }

            /**
             * Single Product Thumbnail Style
             */
            if (isset($_POST[$this->_product_thumbs_style])) {
                update_term_meta($term_id, $this->_product_thumbs_style, $_POST[$this->_product_thumbs_style]);
            }
            
            /**
             * Single Product Half Full Slide
             */
            if (isset($_POST[$this->_product_half_full_slide])) {
                update_term_meta($term_id, $this->_product_half_full_slide, $_POST[$this->_product_half_full_slide]);
            }
            
            /**
             * Single Product Info Columns
             */
            if (isset($_POST[$this->_product_full_info_col])) {
                update_term_meta($term_id, $this->_product_full_info_col, $_POST[$this->_product_full_info_col]);
            }

            /**
             * Single Product Tabs Style
             */
            if (isset($_POST[$this->_product_tabs_style])) {
                update_term_meta($term_id, $this->_product_tabs_style, $_POST[$this->_product_tabs_style]);
            }
            
            /**
             * Single Product Tabs Global
             */
            if (isset($_POST[$this->_product_tabs_glb])) {
                update_term_meta($term_id, $this->_product_tabs_glb, $_POST[$this->_product_tabs_glb]);
            }

            /**
             * Effect hover product
             */
            if (isset($_POST[$this->_cat_effect_hover])) {
                update_term_meta($term_id, $this->_cat_effect_hover, $_POST[$this->_cat_effect_hover]);
            }

            /**
             * Effect hover product
             */
            if (isset($_POST[$this->_custom_tax])) {
                update_term_meta($term_id, $this->_custom_tax, $_POST[$this->_custom_tax]);
            } else {
                update_term_meta($term_id, $this->_custom_tax, '');
            }

            /**
             * Loop Layout buttons
             */
            if (isset($_POST[$this->_loop_layout_buttons])) {
                update_term_meta($term_id, $this->_loop_layout_buttons, $_POST[$this->_loop_layout_buttons]);
            } else {
                update_term_meta($term_id, $this->_loop_layout_buttons, '');
            }

            /**
             * Attribute Image Style
             */
            if (isset($_POST[$this->_cat_attr_image_style])) {
                update_term_meta($term_id, $this->_cat_attr_image_style, $_POST[$this->_cat_attr_image_style]);
            }

            /**
             * Attribute Image Style
             * Only use Single - Quick view
             */
            if (isset($_POST[$this->_cat_attr_image_single_style])) {
                update_term_meta($term_id, $this->_cat_attr_image_single_style, $_POST[$this->_cat_attr_image_single_style]);
            }

            /**
             * Attribute Color Style
             * Only use Single - Quick view
             */
            if (isset($_POST[$this->_cat_attr_color_style])) {
                update_term_meta($term_id, $this->_cat_attr_color_style, $_POST[$this->_cat_attr_color_style]);
            }

            /**
             * Attribute Label Style
             * Only use Single - Quick view
             */
            if (isset($_POST[$this->_cat_attr_label_style])) {
                update_term_meta($term_id, $this->_cat_attr_label_style, $_POST[$this->_cat_attr_label_style]);
            }

            /**
             * Size Guide Block
             */
            if (isset($_POST[$this->_cat_size_guide_block])) {
                update_term_meta($term_id, $this->_cat_size_guide_block, $_POST[$this->_cat_size_guide_block]);
            } else {
                update_term_meta($term_id, $this->_cat_size_guide_block, '');
            }

            /**
             * Sidebar Layout
             */
            if (isset($_POST[$this->_cat_sidebar_layout])) {
                update_term_meta($term_id, $this->_cat_sidebar_layout, $_POST[$this->_cat_sidebar_layout]);
            } else {
                update_term_meta($term_id, $this->_cat_sidebar_layout, '');
            }

            /**
             * Override side bar
             */
            $value = isset($_POST[$this->_cat_sidebar]) && $_POST[$this->_cat_sidebar] == '1' ? '1' : '0';
            update_term_meta($term_id, $this->_cat_sidebar, $value);

            $term = get_term($term_id , 'product_cat');
            if ($term) {
                $sidebar_cats = get_option('nasa_sidebars_cats');
                $sidebar_cats = empty($sidebar_cats) ? array() : $sidebar_cats;

                if ($value === '1' && !isset($sidebar_cats[$term->slug])) {
                    $sidebar_cats[$term->slug] = array(
                        'slug' => $term->slug,
                        'name' => $term->name
                    );
                }

                if ($value === '0' && isset($sidebar_cats[$term->slug])) {
                    unset($sidebar_cats[$term->slug]);
                }

                update_option('nasa_sidebars_cats', $sidebar_cats);
            }

            /**
             * Clear Transients deal ids
             */
            nasa_clear_transients_products_deal_ids();

            /**
             * Delete old side bar
             */
            $this->delete_sidebar_cats();
        }
    }

    /**
     * Check term and delete sidebar category not exist
     */
    protected function delete_sidebar_cats() {
        $sidebar_cats = get_option('nasa_sidebars_cats');

        if (!empty($sidebar_cats)) {
            foreach ($sidebar_cats as $sidebar) {
                if (!term_exists($sidebar['slug'])) {
                    unset($sidebar_cats[$sidebar['slug']]);
                }
            }

            update_option('nasa_sidebars_cats', $sidebar_cats);
        }
    }
}
