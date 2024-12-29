<?php
/**
 * Widget for Elementor
 */
class Nasa_Products_Tabs_WGSC extends Nasa_Elementor_Widget {
    
    /**
     * Settings tab
     * 
     * @var type 
     */
    public $settings_tab = array();

    /**
     * 
     * Constructor
     */
    public function __construct() {
        $this->shortcode = 'nasa_products';
        $this->widget_cssclass = 'woocommerce nasa_products_tabs_wgsc';
        $this->widget_description = __('Display Products - Tabs', 'nasa-core');
        $this->widget_id = 'nasa_products_tabs_sc';
        $this->widget_name = 'ELM - Nasa Products Tabs';
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'class' => 'first',
                'label' => __('Title', 'nasa-core')
            ),  
            
            'title_font_size' => array(
                'type' => 'select',
                'std' => '',
                'label' => __('Title Font Size', 'nasa-core'),
                'options' => array(
                    '' => __('Not Set', 'nasa-core'),
                    'xl' => __('X-Large', 'nasa-core'),
                    'l' => __('Large', 'nasa-core'),
                    'm' => __('Medium', 'nasa-core'),
                    's' => __('Small', 'nasa-core'),
                    't' => __('Tiny', 'nasa-core')
                )
            ),
            
            'desc' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Description', 'nasa-core')
            ),
            
            'alignment' => array(
                'type' => 'select',
                'std' => 'center',
                'label' => __('Alignment', 'nasa-core'),
                'options' => array(
                    'center' => __('Center', 'nasa-core'),
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            'style' => array(
                'type' => 'select',
                'std' => '2d-no-border',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    "2d-no-border"      => __("Classic 2D - No Border", 'nasa-core'),
                    "2d-radius"         => __("Classic 2D - Radius", 'nasa-core'),
                    "2d-radius-dashed"  => __("Classic 2D - Radius - Dash", 'nasa-core'),
                    "2d-has-bg"         => __("Classic 2D - Background - Gray", 'nasa-core'),
                    "2d-has-bg-none"    => __("Classic 2D - Background - Transparent", 'nasa-core'),
                    "2d"                => __("Classic 2D", 'nasa-core'),
                    "3d"                => __("Classic 3D", 'nasa-core'),
                    "slide"             => __("Slide", 'nasa-core'),
                    "ver"               => __("Vertical", 'nasa-core'),
                )
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            ),
            
            'tabs' => array(
                'type' => 'tabs',
                'std' => array(),
                'label' => __('Tabs Content', 'nasa-core')
            ),
        );
        
        $this->settings_tab = array(
            'before_tab_title' => array(
                'type' => 'textarea_html',
                'std' => '',
                'label' => __('Before title', 'nasa-core')
            ),
            
            'tab_title' => array(
                'type' => 'text',
                'std' => __('TAB TITLE', 'nasa-core'),
                'label' => __('Title', 'nasa-core')
            ),

            'after_tab_title' => array(
                'type' => 'textarea_html',
                'std' => '',
                'label' => __('After title', 'nasa-core')
            ),
            
            'type' => array(
                'type' => 'select',
                'std' => 'recent_product',
                'label' => __('Type Show', 'nasa-core'),
                'options' => array(
                    'recent_product' => __('Recent', 'nasa-core'),
                    'best_selling' => __('Best Selling', 'nasa-core'),
                    'featured_product' => __('Featured', 'nasa-core'),
                    'top_rate' => __('Top Rate', 'nasa-core'),
                    'on_sale' => __('On Sale', 'nasa-core'),
                    'recent_review' => __('Recent Review', 'nasa-core'),
                    'deals' => __('Deals', 'nasa-core'),
                    'stock_desc' => __('Quantity Stock - Descending', 'nasa-core')
                )
            ),
            
            'style' => array(
                'type' => 'select',
                'std' => 'grid',
                'label' => __('Style', 'nasa-core'),
                'options' => array(
                    'grid' => __('Grid', 'nasa-core'),
                    'carousel' => __('Slider', 'nasa-core'),
                    'slide_slick' => __('Simple Slider', 'nasa-core'),
                    'slide_slick_2' => __('Simple Slider v2', 'nasa-core'),
                    'infinite' => __('Ajax Infinite', 'nasa-core'),
                    'list' => __('List - Widget Items', 'nasa-core'),
                    'list_carousel' => __('Slider - Widget Items', 'nasa-core')
                )
            ),
            
            'style_viewmore' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Style View More', 'nasa-core'),
                'options' => array(
                    '1' => __('Type 1 - No Border', 'nasa-core'),
                    '2' => __('Type 2 - Border - Top - Bottom', 'nasa-core'),
                    '3' => __('Type 3 - Button - Radius - Dash', 'nasa-core')
                )
            ),
            
            'style_row' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Rows of Slide', 'nasa-core'),
                'options' => array(
                    '1' => __('1 Row', 'nasa-core'),
                    '2' => __('2 Rows', 'nasa-core'),
                    '3' => __('3 Rows', 'nasa-core')
                )
            ),
            
            'pos_nav' => array(
                'type' => 'select',
                'std' => 'top',
                'label' => __('Position Title | Navigation (The Top Only use for Style is Carousel)', 'nasa-core'),
                'options' => array(
                    'top' => __('Top - for Carousel 1 Row', 'nasa-core'),
                    'left' => __('Side', 'nasa-core'),
                    'both' => __('Side Classic', 'nasa-core')
                )
            ),
            
            'title_align' => array(
                'type' => 'select',
                'std' => 'left',
                'label' => __('Title align (Only use for Style is Carousel)', 'nasa-core'),
                'options' => array(
                    'left' => __('Left', 'nasa-core'),
                    'right' => __('Right', 'nasa-core')
                )
            ),
            
            /* 'shop_url' => array(
                'type' => 'select',
                'std' => '0',
                'label' => __('Shop URL (Only use for Style is Carousel)', 'nasa-core'),
                'options' => $this->array_bool_number()
            ), */
            
            'arrows' => array(
                'type' => 'select',
                'std' => '1',
                'label' => __('Arrows (Only use for Style is Carousel or Simple Slide)', 'nasa-core'),
                'options' => $this->array_bool_number()
            ),
            
            'dots' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Dots (Only use for Style is Carousel)', 'nasa-core'),
                'options' => $this->array_bool_str()
            ),
            
            'auto_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Auto', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'loop_slide' => array(
                'type' => 'select',
                'std' => 'false',
                'label' => __('Slide Infinite', 'nasa-core'),
                'options' => $this->array_bool_str() 
            ),
            
            'auto_delay_time' => array(
                "type" => "text",
                "std" => '6',
                "label" => __("Delay Time (s)", 'nasa-core')
            ),
            
            'number' => array(
                'type' => 'text',
                'std' => '8',
                'label' => __('Limit', 'nasa-core')
            ),
            
            'columns_number' => array(
                'type' => 'select',
                'std' => 4,
                'label' => __('Columns Number', 'nasa-core'),
                'options' => $this->array_numbers(6)
            ),
            
            'columns_number_small' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Columns Number Small', 'nasa-core'),
                'options' => $this->array_numbers(2)
            ),
            
            'columns_number_small_slider' => array(
                'type' => 'select',
                'std' => 2,
                'label' => __('Columns Number Small for Carousel', 'nasa-core'),
                'options' => $this->array_numbers_half()
            ),
            
            'columns_number_tablet' => array(
                'type' => 'select',
                'std' => 3,
                'label' => __('Columns Number Tablet', 'nasa-core'),
                'options' => $this->array_numbers(4)
            ),
            
            'cat' => array(
                'type' => 'product_categories',
                'std' => '',
                'label' => __('Product Category (Use slug of Category)', 'nasa-core')
            ),
            
            'ns_tags' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Slug of tags, separated by ","', 'nasa-core')
            ),
            
            'not_in' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Excludes Product Ids', 'nasa-core')
            ),
            
            'el_class' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Extra class name', 'nasa-core')
            )
        );
        
        add_action('nasa_widget_field_tabs', array($this, 'tabs_content'), 10, 4);
        
        parent::__construct();
    }
    
    /**
     * Updates a particular instance of a widget.
     *
     * @see    WP_Widget->update
     * @param  array $new_instance New instance.
     * @param  array $old_instance Old instance.
     * @return array
     */
    public function update($new_instance, $old_instance) {

        $instance = $old_instance;

        if (empty($this->settings)) {
            return $instance;
        }

        // Loop settings and get values to save.
        foreach ($this->settings as $key => $setting) {
            if (!isset($setting['type'])) {
                continue;
            }
            
            $setting['std'] = isset($setting['std']) ? $setting['std'] : '';

            // Format the value based on settings type.
            switch ($setting['type']) {
                case 'textarea':
                    $instance[$key] = isset($new_instance[$key]) ? wp_kses(trim(wp_unslash($new_instance[$key])), wp_kses_allowed_html('post')) : $setting['std'];
                    break;
                
                case 'textarea_html':
                    $instance[$key] = isset($new_instance[$key]) ? trim(wp_unslash($new_instance[$key])) : $setting['std'];
                    break;

                case 'checkbox':
                    $instance[$key] = empty($new_instance[$key]) ? 0 : 1;
                    break;
                
                case 'tabs':
                    $instance[$key] = isset($new_instance[$key]) ? $new_instance[$key] : $setting['std'];
                    break;

                default:
                    $instance[$key] = isset($new_instance[$key]) ? sanitize_text_field($new_instance[$key]) : $setting['std'];
                    break;
            }

            /**
             * Sanitize the value of a setting.
             */
            $instance[$key] = apply_filters('nasa_widget_settings_sanitize_option', $instance[$key], $new_instance, $key, $setting);
        }

        return $instance;
    }

    /**
     * Tabs content
     */
    public function tabs_content($key, $value, $setting, $instance) {
        $data_id = $this->get_field_id($key);
        $data_name = $this->get_field_name($key);
        ?>
        <div class="nasa-tabs-content nasa-wrap-items">
            <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
            
            <div class="nasa-tabs-content-wrap nasa-appent-wrap" data-id="<?php echo esc_attr($data_id); ?>">
                <?php
                if (!empty($value)) {
                    foreach ($value as $order => $tab) {
                        include NASA_CORE_PLUGIN_PATH . 'admin/views/widgets_elementor/tab-content-products.php';
                    }
                }
                ?>
            </div>
            
            <a href="javascript:void(0);" class="nasa-add-item">
                <?php echo esc_html__('Add New Tab', 'nasa-core'); ?>
            </a>
            
            <?php /* Template new tab */ ?>
            <script type="text/template" class="tmpl-nasa-content">
                <?php
                $order = '{{order}}';
                $tab = array();
                include NASA_CORE_PLUGIN_PATH . 'admin/views/widgets_elementor/tab-content-products.php';
                ?>
            </script>
        </div>

        <?php
    }
    
    /**
     * Outputs the settings update form.
     *
     * @see   WP_Widget->form
     *
     * @param array $instance Instance.
     */
    public function form_tab($instance, $name_root, $id_root, $order) {
        if (empty($this->settings_tab)) {
            return;
        }

        foreach ($this->settings_tab as $key => $setting) {
            if (!isset($setting['std'])) {
                $setting['std'] = '';
            }

            $class = isset($setting['class']) ? $setting['class'] : '';
            $value = isset($instance[$key]) ? $instance[$key] : $setting['std'];
            $data_id = $id_root . '-' . $order . '-' . $key;
            $data_name = $name_root . '[' . $order . '][' . $key . ']';

            switch ($setting['type']) {

                case 'text':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>">
                            <?php echo wp_kses_post($setting['label']); ?>
                        </label>
                        
                        <input class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" type="text" value="<?php echo esc_attr($value); ?>" />
                    </p>
                    <?php
                    break;
                    
                case 'textarea':
                case 'textarea_html':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>">
                            <?php echo wp_kses_post($setting['label']); ?>
                        </label>
                        <textarea class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" cols="30" rows="10"><?php echo esc_attr($value); ?></textarea>
                    </p>
                    <?php
                    break;

                case 'select':
                    ?>
                    <p>
                        <label for="<?php echo esc_attr($data_id); ?>">
                            <?php echo wp_kses_post($setting['label']); ?>
                        </label>
                        
                        <select class="widefat <?php echo esc_attr($class); ?>" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>">
                            <?php foreach ($setting['options'] as $option_key => $option_value) : ?>
                                <option value="<?php echo esc_attr($option_key); ?>" <?php selected($option_key, $value); ?>><?php echo esc_html($option_value); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <?php
                    break;
                    
                /**
                 * Set categories field
                 */
                case 'product_categories':
                    $term = $value ? get_term_by('slug', $value, 'product_cat') : null;
                    ?>

                    <div class="nasa-categories-wrap nasa-root-wrap">
                        <span for="<?php echo esc_attr($data_id); ?>"><?php echo $setting['label']; ?></span>
                        <input class="slug-selected" type="hidden" id="<?php echo esc_attr($data_id); ?>" name="<?php echo esc_attr($data_name); ?>" value="<?php echo esc_attr($value); ?>" />

                        <div class="info-selected" data-no-selected="<?php echo esc_attr__('There is not Category selected.', 'nasa-core'); ?>">
                            <?php if ($term) : ?>
                                <p class="category-name">
                                    <?php echo $term->name; ?> ( <?php echo $term->slug; ?> )
                                </p>
                                <a href="javascript:void(0);" class="nasa-remove-selected"></a>
                            <?php else: ?>
                                <p class="no-selected">
                                    <?php echo esc_html__('There is not Category selected.', 'nasa-core'); ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <a class="select-cat-item" href="javascript:void(0);"><?php echo esc_html__('Click here to select Category ...', 'nasa-core'); ?></a>
                        <div class="list-items-wrap" data-list="0">
                            <input type="text" class="nasa-input-search" name="nasa-input-search" placeholder="<?php echo esc_attr('Search ...', 'nasa-core'); ?>" />
                            <div class="list-items"></div>
                        </div>
                    </div>

                    <?php
                    break;

                // Default: run an action.
                default:
                    
                    break;
            }
        }
    }
    
    /**
     * 
     * @param type $args
     * @param type $instance
     */
    public function widget($args, $instance) {
        if (empty($instance['tabs'])) {
            return;
        }
        
        nasa_template('widgets_elementor/nasa-products-tabs.php', array('instance' => $instance, '_this' => $this));
    }
}
